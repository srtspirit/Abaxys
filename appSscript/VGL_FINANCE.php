<?php

class vgl_jnentry extends dbMaster
{
	function vgl_jnentry($schema)
	{
		$this->dbMaster("vgl_chart",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}
	
	function dbFindMatch($dtaObj)
	{
		if ($dtaObj["VGL_FISCAL_DATE"] && $dtaObj["VGL_FISCAL_DATE"] != "")
		{
			$newRecord = array();
			$newRecord[0]["idVGL_JNHE"] = 0;
			$newRecord[0]["VGL_JNHE_TRNID"] = 0;
			$newRecord[0]["VGL_JNHE_GLFIS"] = $this->fiscalYear($dtaObj["VGL_FISCAL_DATE"]);
			$newRecord[0]["VGL_JNHE_GLPER"] = $this->fiscalPeriod($dtaObj["VGL_FISCAL_DATE"]);
			$newRecord[0]["VGL_JNHE_DOCDA"] = $dtaObj["VGL_FISCAL_DATE"];
			$newRecord[0]["VGL_JNHE_PSOUR"] = "VGL_JRN";
			$newRecord[0]["VGL_JNHE_REFER"] = "";
			$newRecord[0]["VGL_JNHE_CURID"] = "";
			$newRecord[0]["VGL_JNHE_CURAT"] = 1;
			$newRecord[0]["VGL_JNHE_DILEVEL"] = "";
			$newRecord[0]["VGL_JNHE_USLNA"] = "";
			
			$this->result = $newRecord;
		}


		$tFnc = new AB_querySession;
		$cUser = $tFnc->getUserData();
		
		$tdPost = array();
		$tdPost["idVGL_JNHE"] = "0";
		$tdPost["CDATE_LIKE"] = $this->getDateFormed();
		$tdPost["FIND_USLNA"] = $cUser["userCode"];
		$tdPost["FIND_SOURCE"] = "VGL_JRN";
				
		$tdPost["MAXREC_OUT"] = "0";
		$tdTrhe = new vgl_journal($this->tblInfo->schema);
		$tdTrhe->dbFindFrom($tdPost);
 		if (!$this->dbSuppTbl)
 		{
 			$this->dbSuppTbl = array();
 		}
		$this->dbSuppTbl["todayPost"] = $tdTrhe;	
		
		
		
	}

	function getDateFormed()
	{
		$td = getdate();
		$month = strval($td['mon'] + 100);
		$mday = strval($td['mday'] + 100);
		
		$toDay = $td['year'] . "-" . substr($month,1) . "-" . substr($mday,1);
		
		return $toDay;
		
	}	
	
	function fiscalYear($docda)
	{
		$docda = str_replace("-","",$docda);
		
		$ret = substr($docda,0,4) * 1;
		return $ret;
	}
	
	function fiscalPeriod($docda)
	{
		$docda = str_replace("-","",$docda);
		$ret = substr($docda,4,2) * 1;
		return $ret;		
	}	
}



class vgl_posting extends dbMaster
{
	
	function vgl_posting($schema)
	{
		$this->dbMaster("vgl_chart",$schema);
	}
	
	function dbUpdRec($dtaObj)
	{

		if ($dtaObj["glUpdateMethod"] == "UPDATE" && $dtaObj["VGL_JOHE_TRNOR"] == 0)
		{
			$this->insertVGL_JOHE($dtaObj);
		}
		if ($dtaObj["glUpdateMethod"] == "UPDATE" && $dtaObj["VGL_JOHE_TRNOR"] > 0)
		{
			$this->updateVGL_JOHE($dtaObj);
		}
		if ($dtaObj["glUpdateMethod"] == "POSTING" || $dtaObj["glUpdateMethod"] == "DELETE" )
		{
			$this->updateVGL_JNHE($dtaObj);
		}
		
	}
	
	function insertVGL_JOHE($dtaObj)
	{
		// New GL ORDER
		
		$this->E_POST = $dtaObj;
		$this->AB_CPARM = $this->dbGetCparm();
		$this->localPost = $dtaObj;
		
		$this->mainRecSet = array();
		$recSet = $dtaObj["RECSET"][0]["RECSET"];
		$occ = 0;
		while ($occ < count($recSet))
		{
			if($recSet[$occ]["idVGL_CHART"])
			{
				$this->mainRecSet[count($this->mainRecSet)] = $recSet[$occ];		
			}
			$occ += 1;
		}
		// Lock for rollback
		$this->dbMasterTransac();
		
		$this->errorCodeText = array();
		if ($this->transactionError > 0)
		{
			$this->errorCode = 9300;
			$this->errorCodeText[count($this->errorCodeText)] = "Transaction failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Could not connect ";
			$this->dbFnct = "dbUpdRec";

			return;
		}
		
		// Get next Trna nmber
		$nfnu = new vgl_getNextFreeNumber($this->tblInfo->schema,"VGL_TRJN_TRNOR" ,$this->E_POST,$this->masterTranConn);
		$dtaObj["VGL_JOHE_TRNOR"] = $nfnu->vgl_nextNumber;
		$this->vgl_nextNumberWR = $nfnu->vgl_nextNumberWR;
		$tFnc = new AB_querySession;
		$cUser = $tFnc->getUserData();
		$dtaObj["VGL_JOHE_USLNA"] = $cUser["userCode"];
		
		
		// Get Currency
		$currObj = array();
		$currObj["PROCESS"] = $dtaObj["PROCESS"];
		$currObj["SESSION"] = $dtaObj["SESSION"];
		$currObj["idVGB_CURR"] = $this->AB_CPARM["VGB_COMPANY"]["vgb_cust"][0]["VGB_CUST_CURID"];
		$currTbls = new dbMaster("vgb_curr",$this->tblInfo->schema);		
		$currTbls->dbFindMatch($currObj);
		
		$this->currTbls = $currTbls->result[0];
		$this->BefcurrTbls = $currTbls;
		
		
		
		$jnheObj = array();
		$jnheObj["PROCESS"] = $dtaObj["PROCESS"];
		$jnheObj["SESSION"] = $dtaObj["SESSION"];
		$jnheObj["VGL_JOHE_TRNOR"] = $dtaObj["VGL_JOHE_TRNOR"];
		$jnheObj["VGL_JOHE_GLFIS"] = $this->fiscalYear($dtaObj["VGL_JOHE_DOCDA"]);
		$jnheObj["VGL_JOHE_GLPER"] = $this->fiscalPeriod($dtaObj["VGL_JOHE_DOCDA"]);
		$jnheObj["VGL_JOHE_DOCDA"] = $dtaObj["VGL_JOHE_DOCDA"];
		$jnheObj["VGL_JOHE_PSOUR"] = $dtaObj["VGL_JOHE_PSOUR"];
		$jnheObj["VGL_JOHE_REFER"] = $dtaObj["VGL_JOHE_REFER"];
		$jnheObj["VGL_JOHE_CURID"] = $this->AB_CPARM["VGB_COMPANY"]["vgb_cust"][0]["VGB_CUST_CURID"];
		$jnheObj["VGL_JOHE_CURAT"] = $currTbls->result[0]["VGB_CURR_CURAT"];
		$jnheObj["VGL_JOHE_DILEVEL"] = $this->getDILEVEL();
		$jnheObj["VGL_JOHE_USLNA"] = $dtaObj["VGL_JOHE_USLNA"];
		$jnheObj["VGL_JOHE_ORTYPE"] = $dtaObj["VGL_JOHE_ORTYPE"];
		$jnheObj["VGL_JOHE_NAME"] = $dtaObj["VGL_JOHE_NAME"];
		$jnheTbls = new dbMaster("vgl_johe",$this->tblInfo->schema);
 		$jnheTbls->brTrConn = $this->masterTranConn;
		$jnheTbls->dbInsRec($jnheObj);
		$insertId = $jnheTbls->insertId; 
		
		$this->jnheTbls = $jnheTbls;
		$this->jnheObj = $jnheObj;
		
		if ($this->allowErr > 0)
		{
			$this->errorCode = $this->allowErr;
		}
		
		$postBalance = 0;
		$exchBalance = array();
		$glPost = array();
		$glTrans = "";
		
		$occ = 0;
		while ($occ < count($this->mainRecSet) && $insertId > 0 && $this->errorCode == 0)
		{
			
			$jndeObj = array();
			$jndeObj["VGL_JODE_TRNOR"] = $jnheTbls->insertId;
			$jndeObj["VGL_JODE_GLIDN"] = $this->mainRecSet[$occ]["idVGL_CHART"];
			$jndeObj["VGL_JODE_CUAMT"] = 0;
			$jndeObj["VGL_JODE_GLAMT"] = 0;
			
			
			if ($currObj["idVGB_CURR"] != $this->mainRecSet[$occ]["VGL_CHART_CURID"])
			{
				$currObj["idVGB_CURR"] = $this->mainRecSet[$occ]["VGL_CHART_CURID"];
				$currTbls = new dbMaster("vgb_curr",$this->tblInfo->schema);		
				$currTbls->dbFindMatch($currObj);
				$this->currTbls = $currTbls->result[0];
				$this->AftcurrTbls =  $currTbls->result[0];
			}
			
			$glAmount = $this->mainRecSet[$occ]["VGL_JODE_DEB_AMT"];
			if ($this->mainRecSet[$occ]["VGL_JODE_CRE_AMT"] > 0 )
			{
				$glAmount = $this->mainRecSet[$occ]["VGL_JODE_CRE_AMT"] * -1;
			}
			
			$jndeObj["VGL_JODE_CUAMT"] = $glAmount;
			$jndeObj["VGL_JODE_GLAMT"] = $glAmount;
			$this->VGL_JODE_CURA = $this->currTbls["VGB_CURR_CURAT"];
			$jndeObj["VGL_JODE_CURAT"] = $this->currTbls["VGB_CURR_CURAT"];

			
						
			$amt = round($glAmount * $jndeObj["VGL_JODE_CURAT"],2) ; // Amount in Account currency
			$jndeObj["VGL_JODE_GLAMT"] = round($amt,2);
			$postBalance += round($amt,2);
			$glAmount = round($glAmount,2) - round($amt,2);
			
			if (!$exchBalance[$currObj["idVGB_CURR"]])
			{
				$exchBalance[$currObj["idVGB_CURR"]] = 0;
			}
			$exchBalance[$currObj["idVGB_CURR"]] += $glAmount;
			

			$glTrans .= "<br>(" . $jndeObj["VGL_JODE_GLIDN"] .")-". $jndeObj["VGL_JODE_CUAMT"]."-". $jndeObj["VGL_JODE_GLAMT"] ."=". round($postBalance,2);
			
			if ($jndeObj["VGL_JODE_GLAMT"] != 0 || $jnheObj["VGL_JOHE_ORTYPE"] == "TMPL")
			{
				if (!$glPost[$jndeObj["VGL_JODE_GLIDN"]])
				{
					$glPost[$jndeObj["VGL_JODE_GLIDN"]] = $jndeObj;
					$glPost[$jndeObj["VGL_JODE_GLIDN"]]["PROCESS"] = $dtaObj["PROCESS"];
					$glPost[$jndeObj["VGL_JODE_GLIDN"]]["SESSION"] = $dtaObj["SESSION"];
					$glPost[$jndeObj["VGL_JODE_GLIDN"]]["VGL_JOHE_ORTYPE"] = $jnheObj["VGL_JOHE_ORTYPE"];
					
				}
				else
				{
					$glPost[$jndeObj["VGL_JODE_GLIDN"]]["VGL_JODE_CUAMT"] += $jndeObj["VGL_JODE_CUAMT"];
					$glPost[$jndeObj["VGL_JODE_GLIDN"]]["VGL_JODE_GLAMT"] += $jndeObj["VGL_JODE_GLAMT"];

				}
			}


			
				
			$occ += 1;
		}
		
		$postBalance = round($postBalance,2);
		$this->postBalance = $postBalance;
		if ($postBalance==0 && count($glPost)>0)
		{
			if ($this->errorCode == 0)
			{
				$this->glPostDetailOrd($glPost);
			}
		}
		else
		{
			if ($this->errorCode == 0)
			{
				if (!$this->errorCodeText)
				{
					$this->errorCodeText = array();
				}
				
				$this->errorCode = "223344";
				$postSide = "Debit";
				if ($this->postBalance>0)
				{
					$postSide = "Credit";
				}
				$this->trapTrigger = "<span class='text-danger' >Posting( ".$postBalance.") not in balance  of </span>$" .  abs(round($this->postBalance ,2)) . "&nbsp;" . $postSide;
				$this->errorCodeText[count($this->errorCodeText)] = "Out of balance";
			}
		}
		
		
		if ($this->errorCode == 0)
		{		
			$this->dbPdoEndTransac(true);

			foreach($jnheTbls as $name => $value)
			{
				 $this->$name = $value;
			}
						
		}
		else
		{		
			$this->dbPdoEndTransac(false);
			$this->errorCodeText[count($this->errorCodeText)] = "Transaction Aborted ";
			
			if ($this->allowMess)
			{
				$this->errorCodeText[count($this->errorCodeText)] = $this->allowMess;
			}
		}
		$this->tblInfo->tblName = "vgl_posting";		
		// $this->pdoEndError = $this->dbPdoEndTransac(false);
		
	}

	function updateVGL_JOHE($dtaObj)
	{
		// Modify GL ORDER
		
		$this->E_POST = $dtaObj;
		$this->AB_CPARM = $this->dbGetCparm();
		$this->localPost = $dtaObj;
		
		$this->mainRecSet = array();
		$recSet = $dtaObj["RECSET"][0]["RECSET"];
		$occ = 0;
		while ($occ < count($recSet))
		{
			if($recSet[$occ]["idVGL_CHART"])
			{
				$this->mainRecSet[count($this->mainRecSet)] = $recSet[$occ];		
			}
			$occ += 1;
		}
		$joheObj = array();
		$joheObj["PROCESS"] = $dtaObj["PROCESS"];
		$joheObj["SESSION"] = $dtaObj["SESSION"];
		$joheObj["VGL_JOHE_TRNOR"] = $dtaObj["VGL_JOHE_TRNOR"];
		$joheTbls = new dbMaster("vgl_johe",$this->tblInfo->schema);		
		$joheTbls->dbFindMatch($joheObj);
		
		if ($joheTbls->errorCode > 0 || $joheTbls->result[0]["VGL_JOHE_TRNOR"] != $dtaObj["VGL_JOHE_TRNOR"])
		{
			foreach($joheTbls as $name => $value)
			{
				 $this->$name = $value;
			}
			if ($this->errorCode == 0)
			{
				$this->errorCode = 12;
			}
			return;
		}			
		
		// Lock for rollback
		$this->dbMasterTransac();
		
		$this->errorCodeText = array();
		if ($this->transactionError > 0)
		{
			$this->errorCode = 9300;
			$this->errorCodeText[count($this->errorCodeText)] = "Transaction failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Could not connect ";
			$this->dbFnct = "dbUpdRec";

			return;
		}


		// Get Currency
		$currObj = array();
		$currObj["PROCESS"] = $dtaObj["PROCESS"];
		$currObj["SESSION"] = $dtaObj["SESSION"];
		$currObj["idVGB_CURR"] = $this->AB_CPARM["VGB_COMPANY"]["vgb_cust"][0]["VGB_CUST_CURID"];
		$currTbls = new dbMaster("vgb_curr",$this->tblInfo->schema);		
		$currTbls->dbFindMatch($currObj);
		
		$this->currTbls = $currTbls->result[0];
		$this->BefcurrTbls = $currTbls;
				
		$jnheObj = array();
		$jnheObj["PROCESS"] = $dtaObj["PROCESS"];
		$jnheObj["SESSION"] = $dtaObj["SESSION"];
		$jnheObj["idVGL_JOHE"] = $joheTbls->result[0]["idVGL_JOHE"];
		$jnheObj["VGL_JOHE_TRNOR"] = $joheTbls->result[0]["VGL_JOHE_TRNOR"];
		$jnheObj["VGL_JOHE_GLFIS"] = $this->fiscalYear($dtaObj["VGL_JOHE_DOCDA"]);
		$jnheObj["VGL_JOHE_GLPER"] = $this->fiscalPeriod($dtaObj["VGL_JOHE_DOCDA"]);
		$jnheObj["VGL_JOHE_DOCDA"] = $dtaObj["VGL_JOHE_DOCDA"];
		$jnheObj["VGL_JOHE_PSOUR"] = $joheTbls->result[0]["VGL_JOHE_PSOUR"];
		$jnheObj["VGL_JOHE_REFER"] = $dtaObj["VGL_JOHE_REFER"];
		$jnheObj["VGL_JOHE_CURID"] = $this->AB_CPARM["VGB_COMPANY"]["vgb_cust"][0]["VGB_CUST_CURID"];
		$jnheObj["VGL_JOHE_CURAT"] = $currTbls->result[0]["VGB_CURR_CURAT"];
		$jnheObj["VGL_JOHE_DILEVEL"] = $joheTbls->result[0]["VGL_JOHE_DILEVEL"];
		$jnheObj["VGL_JOHE_USLNA"] = $joheTbls->result[0]["VGL_JOHE_USLNA"];
		$jnheObj["VGL_JOHE_ORTYPE"] = $joheTbls->result[0]["VGL_JOHE_ORTYPE"];
		$jnheObj["VGL_JOHE_NAME"] = $dtaObj["VGL_JOHE_NAME"];
		$jnheObj["VGL_JOHE_REVISION"] = $joheTbls->result[0]["VGL_JOHE_REVISION"]+1;
		$jnheTbls = new dbMaster("vgl_johe",$this->tblInfo->schema);
 		$jnheTbls->brTrConn = $this->masterTranConn;
		$jnheTbls->dbUpdRec($jnheObj);
		$insertId = $joheTbls->result[0]["idVGL_JOHE"]; 

		foreach($jnheTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
		$this->jnheTbls = $jnheTbls;
		$this->jnheObj = $jnheObj;
		
		if ($this->allowErr > 0)
		{
			$this->errorCode = $this->allowErr;
		}
		
		if ($this->errorCode == 0)
		{
			
			$jodeObj = array();
			$jodeObj["PROCESS"] = $dtaObj["PROCESS"];
			$jodeObj["SESSION"] = $dtaObj["SESSION"];
			$jodeObj["VGL_JODE_TRNOR"] = $joheTbls->result[0]["idVGL_JOHE"];
			$jodeTbls = new dbMaster("vgl_jode",$this->tblInfo->schema);
			$jodeTbls->dbFindMatch($jodeObj);
			$occ = 0;
			$jodelTbls = new dbMaster("vgl_jode",$this->tblInfo->schema);
			$jodelTbls->errorCode = 0;
			while ($occ < count($jodeTbls->result) && $jodelTbls->errorCode == 0)
			{
				$jodelObj = array();
				$jodelObj["PROCESS"] = $dtaObj["PROCESS"];
				$jodelObj["SESSION"] = $dtaObj["SESSION"];
				$jodelObj["idVGL_JODE"] = $jodeTbls->result[$occ]["idVGL_JODE"];
				
				$jodelTbls->brTrConn = $this->masterTranConn;
				$jodelTbls->dbDelRec($jodelObj);
	
				$occ += 1;
			}
		
			$this->errorCode = $jodelTbls->errorCode;
		}

				
		$postBalance = 0;
		$exchBalance = array();
		$glPost = array();
		$glTrans = "";
		
		$occ = 0;
		while ($occ < count($this->mainRecSet) && $insertId > 0 && $this->errorCode == 0)
		{
			
			$jndeObj = array();
			$jndeObj["VGL_JODE_TRNOR"] = $insertId;
			$jndeObj["VGL_JODE_GLIDN"] = $this->mainRecSet[$occ]["idVGL_CHART"];
			$jndeObj["VGL_JODE_CUAMT"] = 0;
			$jndeObj["VGL_JODE_GLAMT"] = 0;
			
			
			if ($currObj["idVGB_CURR"] != $this->mainRecSet[$occ]["VGL_CHART_CURID"])
			{
				$currObj["idVGB_CURR"] = $this->mainRecSet[$occ]["VGL_CHART_CURID"];
				$currTbls = new dbMaster("vgb_curr",$this->tblInfo->schema);		
				$currTbls->dbFindMatch($currObj);
				$this->currTbls = $currTbls->result[0];
				$this->AftcurrTbls =  $currTbls->result[0];
			}
			
			$glAmount = $this->mainRecSet[$occ]["VGL_JODE_DEB_AMT"];
			if ($this->mainRecSet[$occ]["VGL_JODE_CRE_AMT"] > 0 )
			{
				$glAmount = $this->mainRecSet[$occ]["VGL_JODE_CRE_AMT"] * -1;
			}
			
			$jndeObj["VGL_JODE_CUAMT"] = $glAmount;
			$jndeObj["VGL_JODE_GLAMT"] = $glAmount;
			$this->VGL_JODE_CURA = $this->currTbls["VGB_CURR_CURAT"];
			$jndeObj["VGL_JODE_CURAT"] = $this->currTbls["VGB_CURR_CURAT"];

			
						
			$amt = round($glAmount * $jndeObj["VGL_JODE_CURAT"],2) ; // Amount in Account currency
			$jndeObj["VGL_JODE_GLAMT"] = round($amt,2);
			$postBalance += round($amt,2);
			$glAmount = round($glAmount,2) - round($amt,2);
			
			if (!$exchBalance[$currObj["idVGB_CURR"]])
			{
				$exchBalance[$currObj["idVGB_CURR"]] = 0;
			}
			$exchBalance[$currObj["idVGB_CURR"]] += $glAmount;
			

			$glTrans .= "<br>(" . $jndeObj["VGL_JODE_GLIDN"] .")-". $jndeObj["VGL_JODE_CUAMT"]."-". $jndeObj["VGL_JODE_GLAMT"] ."=". round($postBalance,2);
			
			if ($jndeObj["VGL_JODE_GLAMT"] != 0  || $jnheObj["VGL_JOHE_ORTYPE"] == "TMPL")
			{
				if (!$glPost[$jndeObj["VGL_JODE_GLIDN"]])
				{
					$glPost[$jndeObj["VGL_JODE_GLIDN"]] = $jndeObj;
					$glPost[$jndeObj["VGL_JODE_GLIDN"]]["PROCESS"] = $dtaObj["PROCESS"];
					$glPost[$jndeObj["VGL_JODE_GLIDN"]]["SESSION"] = $dtaObj["SESSION"];
					$glPost[$jndeObj["VGL_JODE_GLIDN"]]["VGL_JOHE_ORTYPE"] = $jnheObj["VGL_JOHE_ORTYPE"];
					
				}
				else
				{
					$glPost[$jndeObj["VGL_JODE_GLIDN"]]["VGL_JODE_CUAMT"] += $jndeObj["VGL_JODE_CUAMT"];
					$glPost[$jndeObj["VGL_JODE_GLIDN"]]["VGL_JODE_GLAMT"] += $jndeObj["VGL_JODE_GLAMT"];

				}
			}


			
				
			$occ += 1;
		}
		
		$postBalance = round($postBalance,2);
		$this->postBalance = $postBalance;
		if ($postBalance==0 && count($glPost)>0)
		{
			if ($this->errorCode == 0)
			{
				$this->glPostDetailOrd($glPost);
			}
		}
		else
		{
			if ($this->errorCode == 0)
			{
				if (!$this->errorCodeText)
				{
					$this->errorCodeText = array();
				}
				
				$this->errorCode = "223344";
				$postSide = "Debit";
				if ($this->postBalance>0)
				{
					$postSide = "Credit";
				}
				$this->trapTrigger = "<span class='text-danger' >Posting( ".$postBalance.") not in balance  of </span>$" .  abs(round($this->postBalance ,2)) . "&nbsp;" . $postSide;
				$this->errorCodeText[count($this->errorCodeText)] = "Out of balance";
			}
		}
		
		
		if ($this->errorCode == 0)
		{		
			$this->dbPdoEndTransac(true);
		}
		else
		{		
			$this->dbPdoEndTransac(false);
			$this->errorCodeText[count($this->errorCodeText)] = "Transaction Aborted ";
			
			if ($this->allowMess)
			{
				$this->errorCodeText[count($this->errorCodeText)] = $this->allowMess;
			}
		}
		$this->tblInfo->tblName = "vgl_posting";		
		// $this->pdoEndError = $this->dbPdoEndTransac(false);
		
	}

	function updateVGL_JNHE($dtaObj)
	{
		// Modify GL ORDER
		
		$this->E_POST = $dtaObj;
		$this->AB_CPARM = $this->dbGetCparm();
		$this->localPost = $dtaObj;
		
		$this->mainRecSet = array();
		$recSet = $dtaObj["RECSET"][0]["RECSET"];
		$occ = 0;
		while ($occ < count($recSet))
		{
			if($recSet[$occ]["GL_ORDER"] == 1 && $recSet[$occ]["selected"] == 1)
			{
				$this->mainRecSet[count($this->mainRecSet)] = $recSet[$occ];		
			}
			$occ += 1;
		}
		
		if (count($this->mainRecSet)==0)
		{
			$this->errorCode = 9;
			$this->errorCodeText[count($this->errorCodeText)] = "Nothing to update";

			$this->rowCount = 0;
			$this->dbFnct = "dbUpdRec";
			return;
			
		}
		// Lock for rollback
		$this->dbMasterTransac();
		
		$this->errorCodeText = array();
		if ($this->transactionError > 0)
		{
			$this->errorCode = 9300;
			$this->errorCodeText[count($this->errorCodeText)] = "Transaction failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Could not connect ";
			$this->dbFnct = "dbUpdRec";

			return;
		}

		if ($dtaObj["glUpdateMethod"] == "POSTING")
		{
			// Get next Trna nmber
			$nfnu = new vgl_getNextFreeNumber($this->tblInfo->schema,"VGL_TRJN_TRNID" ,$dtaObj,$this->masterTranConn);
			$VGL_TRNID = $nfnu->vgl_nextNumber;
			$this->vgl_nextNumberWR = $nfnu->vgl_nextNumberWR;
			$tFnc = new AB_querySession;
			$cUser = $tFnc->getUserData();
			$dtaObj["VGL_JNHE_USLNA"] = $cUser["userCode"];
		}
		
		$occ = 0;
		while($occ < count($this->mainRecSet) && $this->errorCode == 0)		
		{
			$joheObj = array();
			$joheObj["PROCESS"] = $dtaObj["PROCESS"];
			$joheObj["SESSION"] = $dtaObj["SESSION"];
			$joheObj["idVGL_JOHE"] = $this->mainRecSet[$occ]["idVGL_JOHE"];
			$joheTbls = new dbMaster("vgl_johe",$this->tblInfo->schema);		
			$joheTbls->dbFindMatch($joheObj);
		
			if ($joheTbls->errorCode > 0 || $joheTbls->result[0]["idVGL_JOHE"] != $this->mainRecSet[$occ]["idVGL_JOHE"])
			{
				foreach($joheTbls as $name => $value)
				{
					 $this->$name = $value;
				}
				if ($this->errorCode == 0)
				{
					$this->errorCode = 12;
				}
				
			}			
			
			if ($this->errorCode == 0 && $dtaObj["glUpdateMethod"] == "POSTING" )
			{
				$mainRecUpd = $this->updateVGL_JNHEprocess($dtaObj,$joheTbls->result[0],$VGL_TRNID);
				$insertId = $mainRecUpd->insertId;
				$VGL_TRNID += 1;
			}
			
			if ($this->errorCode == 0 && $dtaObj["glUpdateMethod"] == "POSTING")
			{
				$this->updateVGL_JNDEprocess($dtaObj,$joheTbls->result[0],$insertId);

			}

			if ($this->errorCode == 0)
			{
				
				$jodeObj = array();
				$jodeObj["PROCESS"] = $dtaObj["PROCESS"];
				$jodeObj["SESSION"] = $dtaObj["SESSION"];
				$jodeObj["VGL_JODE_TRNOR"] = $joheTbls->result[0]["idVGL_JOHE"];
				$jodeTbls = new dbMaster("vgl_jode",$this->tblInfo->schema);
				$jodeTbls->dbFindMatch($jodeObj);
				$wocc = 0;
				$jodelTbls = new dbMaster("vgl_jode",$this->tblInfo->schema);
				$jodelTbls->errorCode = 0;
				while ($wocc < count($jodeTbls->result) && $jodelTbls->errorCode == 0)
				{
					$jodelObj = array();
					$jodelObj["PROCESS"] = $dtaObj["PROCESS"];
					$jodelObj["SESSION"] = $dtaObj["SESSION"];
					$jodelObj["idVGL_JODE"] = $jodeTbls->result[$wocc]["idVGL_JODE"];
					$jodelTbls->brTrConn = $this->masterTranConn;
					$jodelTbls->dbDelRec($jodelObj);
					
					$wocc += 1;
				}
			
				$this->errorCode = $jodelTbls->errorCode;
			}			
			if ($this->errorCode == 0)
			{
				$joheObj = array();
				$joheObj["PROCESS"] = $dtaObj["PROCESS"];
				$joheObj["SESSION"] = $dtaObj["SESSION"];
				$joheObj["idVGL_JOHE"] = $this->mainRecSet[$occ]["idVGL_JOHE"];
				$joheTbls = new dbMaster("vgl_johe",$this->tblInfo->schema);
				$joheTbls->brTrConn = $this->masterTranConn;		
				$joheTbls->dbDelRec($joheObj);
				if ($dtaObj["glUpdateMethod"] == "DELETE")
				{
					$mainRecUpd = $joheTbls;
				}	
				
			}
			
			$occ += 1;
		}				

		// Set next Trna nmber
		if ($this->errorCode == 0 && $dtaObj["glUpdateMethod"] == "POSTING")
		{		
			$dtaObj["NEXTFREENUMBER"] = $VGL_TRNID;
			$nfnu = new vgl_setNextFreeNumber($this->tblInfo->schema,"VGL_TRJN_TRNID" ,$dtaObj,$this->masterTranConn);
			$this->errorCode = $nfnu->errorCode;
		}

		if ($this->errorCode == 0)
		{		
			$this->dbPdoEndTransac(true); 
			foreach($mainRecUpd as $name => $value)
			{
				$this->$name = $value;
			}
		}
		else
		{		
			$this->dbPdoEndTransac(false);
			$this->errorCodeText[count($this->errorCodeText)] = "Transaction Aborted ";
			
			if ($this->allowMess)
			{
				$this->errorCodeText[count($this->errorCodeText)] = $this->allowMess;
			}
		}
		$this->tblInfo->tblName = "vgl_posting";	

	}

	function updateVGL_JNHEprocess($dtaObj,$dbObj,$VGL_TRNID)
	{

		$jnheObj = array();
		$jnheObj["PROCESS"] = $dtaObj["PROCESS"];
		$jnheObj["SESSION"] = $dtaObj["SESSION"];
		
		$jnheObj["VGL_JNHE_TRNID"] = $VGL_TRNID;
		$jnheObj["VGL_JNHE_GLFIS"] = $this->fiscalYear($dbObj["VGL_JOHE_DOCDA"]);
		$jnheObj["VGL_JNHE_GLPER"] = $this->fiscalPeriod($dbObj["VGL_JOHE_DOCDA"]);
		$jnheObj["VGL_JNHE_DOCDA"] = $dbObj["VGL_JOHE_DOCDA"];
		$jnheObj["VGL_JNHE_PSOUR"] = $dbObj["VGL_JOHE_PSOUR"];
		$jnheObj["VGL_JNHE_REFER"] = $dbObj["VGL_JOHE_REFER"];
		$jnheObj["VGL_JNHE_CURID"] = $dbObj["VGL_JOHE_CURID"];
		$jnheObj["VGL_JNHE_CURAT"] = $dbObj["VGL_JOHE_CURAT"];
		$jnheObj["VGL_JNHE_DILEVEL"] = $dbObj["VGL_JOHE_DILEVEL"];
		$jnheObj["VGL_JOHE_USLNA"] =  $dtaObj["VGL_JNHE_USLNA"]; // New user
		$jnheTbls = new dbMaster("vgl_jnhe",$this->tblInfo->schema);
 		$jnheTbls->brTrConn = $this->masterTranConn;
		$jnheTbls->dbInsRec($jnheObj);
		
		
		foreach($jnheTbls as $name => $value)
		{
			 $this->$name = $value;
		}		
		if ($this->allowErr > 0)
		{
			$this->errorCode = $this->allowErr;
		}
		return $jnheTbls;
	}

	function updateVGL_JNDEprocess($dtaObj,$dbObj,$insertId)
	{

		$jodeObj = array();
		$jodeObj["PROCESS"] = $dtaObj["PROCESS"];
		$jodeObj["SESSION"] = $dtaObj["SESSION"];
		$jodeObj["VGL_JODE_TRNOR"] = $dbObj["idVGL_JOHE"];
		$jodeTbls = new dbMaster("vgl_jode",$this->tblInfo->schema);		
		$jodeTbls->dbFindMatch($jodeObj);
		foreach($jodeTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		if (count($jodeTbls->result) == 0)
		{
			$this->errorCode = 1;
		}

		$jndeTbls = new dbMaster("vgl_jnde",$this->tblInfo->schema);
		$jndeObj = array();
		$jndeObj["PROCESS"] = $dtaObj["PROCESS"];
		$jndeObj["SESSION"] = $dtaObj["SESSION"];
				
		$occ = 0;
		while (	$occ <	count($jodeTbls->result) && $this->errorCode == 0)
		{
			$jndeObj["VGL_JNDE_TRNID"] = $insertId;
			$jndeObj["VGL_JNDE_GLIDN"] = $jodeTbls->result[$occ]["VGL_JODE_GLIDN"];
			$jndeObj["VGL_JNDE_GLAMT"] = $jodeTbls->result[$occ]["VGL_JODE_GLAMT"];
			$jndeObj["VGL_JNDE_CUAMT"] = $jodeTbls->result[$occ]["VGL_JODE_CUAMT"];
 			$jndeTbls->brTrConn = $this->masterTranConn;
			$jndeTbls->dbInsRec($jndeObj);
			$this->errorCode = $jndeTbls->errorCode;

			$occ += 1;
		}
	}

	function glPostDetailOrd($glPost)
	{
		
		$this->postDetail = array();
		
		if (count($glPost)>0)
		{
			$this->glPost = $glPost;
			foreach($glPost as $name => $value)
			{
			
				if ( ( $value["VGL_JODE_GLAMT"] != 0 || $value["VGL_JOHE_ORTYPE"]=="TMPL" ) && $this->errorCode == 0)
				{
					$jndeTbls = new dbMaster("vgl_jode",$this->tblInfo->schema);
			 		$jndeTbls->brTrConn = $this->masterTranConn;
					$jndeTbls->dbInsRec($value);
					$this->postDetail[count($this->postDetail)] = $value;
					
					if ($jndeTbls->errorCode != 0 || $jndeTbls->insertId == 0)
					{
						$this->errorCode = $jndeTbls->errorCode;
						$this->errorCodeText[count($this->errorCodeText)] = "vgl_jode:" . $name . "-" . $jndeTbls->errorInfo;
						if ($this->errorCode == 0)
						{
							$this->errorCode = 11;
							$this->errorCodeText[count($this->errorCodeText)] = "vgl_jode:" . " Could not insert " . $name;
						}
					}
					
					// $jndeTbls->pacc = $paccTbls;
					$this->vgl_jode[count($this->vgl_jode)] = $jndeTbls;			
				}
				
				
			}			
		}
		
	}
	
	function glPostDetail($glPost)
	{
		
		$this->postDetail = array();
		
		if (count($glPost)>0)
		{
			$this->glPost = $glPost;
			foreach($glPost as $name => $value)
			{
			
				if ($value["VGL_JNDE_GLAMT"] != 0 && $this->errorCode == 0)
				{
					$jndeTbls = new dbMaster("vgl_jnde",$this->tblInfo->schema);
			 		$jndeTbls->brTrConn = $this->masterTranConn;
					$jndeTbls->dbInsRec($value);
					$this->postDetail[count($this->postDetail)] = $value;
					
					if ($jndeTbls->errorCode != 0 || $jndeTbls->insertId == 0)
					{
						$this->errorCode = $jndeTbls->errorCode;
						$this->errorCodeText[count($this->errorCodeText)] = "vgl_jnde:" . $name . "-" . $jndeTbls->errorInfo;
						if ($this->errorCode == 0)
						{
							$this->errorCode = 11;
							$this->errorCodeText[count($this->errorCodeText)] = "vgl_jnde:" . " Could not insert " . $name;
						}
					}
					
					// $jndeTbls->pacc = $paccTbls;
					$this->vgl_jnde[count($this->vgl_jnde)] = $jndeTbls;			
				}
				
				
			}			
		}
		
	}
	

	
	function vgl_postTransaction($ePost)
	{
		$this->masterTranConn = $this->brTrConn;
		$this->errorCodeText = array();
		$this->ePost = $ePost;
		$jnheObj = array();
		$jnheObj["PROCESS"] = $ePost["PROCESS"];
		$jnheObj["SESSION"] = $ePost["SESSION"];
		$jnheObj["VGL_JNHE_TRNID"] = $ePost["paccTrans"]["VGL_JNHE_TRNID"];
		$jnheObj["VGL_JNHE_GLFIS"] = $this->fiscalYear($ePost["paccTrans"]["VGL_JNHE_DOCDA"]);
		$jnheObj["VGL_JNHE_GLPER"] = $this->fiscalPeriod($ePost["paccTrans"]["VGL_JNHE_DOCDA"]);
		$jnheObj["VGL_JNHE_DOCDA"] = $ePost["paccTrans"]["VGL_JNHE_DOCDA"];
		$jnheObj["VGL_JNHE_PSOUR"] = $ePost["paccTrans"]["VGL_JNHE_PSOUR"];
		$jnheObj["VGL_JNHE_REFER"] = $ePost["paccTrans"]["VGL_JNHE_REFER"];
		$jnheObj["VGL_JNHE_CURID"] = $ePost["paccTrans"]["VGL_JNHE_CURID"];
		$jnheObj["VGL_JNHE_CURAT"] = $ePost["paccTrans"]["VGL_JNHE_CURAT"];
		$jnheObj["VGL_JNHE_DILEVEL"] = $this->getDILEVEL();
		$jnheObj["VGL_JNHE_USLNA"] = $ePost["paccTrans"]["VGL_JNHE_USLNA"];
		$jnheTbls = new dbMaster("vgl_jnhe",$this->tblInfo->schema);
 		$jnheTbls->brTrConn = $this->masterTranConn;
		$jnheTbls->dbInsRec($jnheObj);
		$insertId = $jnheTbls->insertId; 

		foreach($jnheTbls as $name => $value)
		{
			 $this->$name = $value;
		}

		if ($jnheTbls->errorCode != 0 || $insertId == 0)
		{
			$this->errorCode = $jnheTbls->errorCode;
			$this->errorCodeText[count($this->errorCodeText)] = "vgl_jnhe:" . $jnheTbls->errorInfo[2];
			if ($this->errorCode == 0)
			{
				$this->errorCode = 11;
				$this->errorCodeText[count($this->errorCodeText)] = "vgl_jnhe:" . " Could not insert";
			}
			return;
		}
		
		// return; // Debug mode
		
		
		$this->vgl_jnde = array();
		$this->vgl_pacc = array();
		
		$jndeObj["PROCESS"] = $ePost["PROCESS"];
		$jndeObj["SESSION"] = $ePost["SESSION"];
		$jndeObj["VGL_JNDE_TRNID"] = $insertId;
		
		$paccAcc = array();
		if (!$ePost["paccAccounts"][0])
		{
			$paccAcc[0] = $ePost["paccAccounts"];
			$paccAcc[0]["VGL_JNHE_PSOUR"] = $jnheObj["VGL_JNHE_PSOUR"];
		}
		else
		{
			$occ = 0;
			while ($occ < count($ePost["paccAccounts"]))
			{
				$paccAcc[$occ] = $ePost["paccAccounts"][$occ];
				$occ += 1;
			}
		}
		
		$glPost = array();
		
		$occPacc = 0;
		while ($occPacc < count($paccAcc))
		{
			$currPaccAcc = $paccAcc[$occPacc];

		
			foreach($currPaccAcc as $name => $value)
			{
	
				$paccObj = array();
				$paccObj["PROCESS"] = $ePost["PROCESS"];
				$paccObj["SESSION"] = $ePost["SESSION"];
				$paccObj["VGL_PACC_SOURCE"] = $currPaccAcc["VGL_JNHE_PSOUR"];
				$paccObj["VGL_PACC_SCHCO"] = $name;
				
				$paccTbls = new dbMaster("vgl_pacc",$this->tblInfo->schema);
				$paccTbls->dbFindMatch($paccObj);
				
				
				$jndeObj["sourceName"] = $paccObj["VGL_PACC_SOURCE"] . "=" . $paccObj["VGL_PACC_SCHCO"];
				
				$this->vgl_pacc[count($this->vgl_pacc)] = $paccTbls;
				
				if ($name != "TAXES" && $name != "BANK" && $this->errorCode == 0)
				{
					if ($this->errorCode == 0)
					{
						if (count($paccTbls->result) > 0)
						{
							$jndeObj["VGL_JNDE_GLIDN"] = $paccTbls->result[0]["VGL_PACC_GLIDN"];
							$jndeObj["VGL_JNDE_CUAMT"] = $value * $paccTbls->result[0]["VGL_PACC_DBCRT"]; // Amount in tr currency
							$jndeObj["VGL_JNDE_GLAMT"] = round($jndeObj["VGL_JNDE_CUAMT"] * $jnheObj["VGL_JNHE_CURAT"],2) ; // Amount in Home currency
	
							if ($jndeObj["VGL_JNDE_GLAMT"] != 0)
							{
								if (!$glPost[$jndeObj["VGL_JNDE_GLIDN"]])
								{
									$glPost[$jndeObj["VGL_JNDE_GLIDN"]] = $jndeObj;
								}
								else
								{
									$glPost[$jndeObj["VGL_JNDE_GLIDN"]]["VGL_JNDE_CUAMT"] += $jndeObj["VGL_JNDE_CUAMT"];
									$glPost[$jndeObj["VGL_JNDE_GLIDN"]]["VGL_JNDE_GLAMT"] += $jndeObj["VGL_JNDE_GLAMT"];

								}

							}
						}
						else
						{
							
							$this->errorCode = 9898;
							$this->errorCodeText[count($this->errorCodeText)] = "vgl_jnde:" . "VGL_PACC_SCHCO:" . $name . " error";
						}
					}
				}
				else
				{
					$occ = 0;
					while ($occ < count($currPaccAcc["TAXES"]) && $this->errorCode == 0 && count($paccTbls->result) > 0)
					{
						if ($paccTbls->result[0]["VGL_PACC_ACCRU"]=="1")
						{
							$jndeObj["VGL_JNDE_GLIDN"] = $currPaccAcc["TAXES"][$occ]["VTX_SCHE_GLACR"];
						}
						else
						{
							$jndeObj["VGL_JNDE_GLIDN"] = $currPaccAcc["TAXES"][$occ]["VTX_SCHE_GLIDN"];
						}
						
						$jndeObj["VGL_JNDE_CUAMT"] = $currPaccAcc["TAXES"][$occ]["GLAMT"] * $paccTbls->result[0]["VGL_PACC_DBCRT"];
						$jndeObj["VGL_JNDE_GLAMT"] = round($jndeObj["VGL_JNDE_CUAMT"] * $jnheObj["VGL_JNHE_CURAT"],2) ; // Amount in Home currency
						
						if ($jndeObj["VGL_JNDE_GLAMT"] != 0)
						{

							if (!$glPost[$jndeObj["VGL_JNDE_GLIDN"]])
							{
								$glPost[$jndeObj["VGL_JNDE_GLIDN"]] = $jndeObj;
							}
							else
							{
								$glPost[$jndeObj["VGL_JNDE_GLIDN"]]["VGL_JNDE_CUAMT"] += $jndeObj["VGL_JNDE_CUAMT"];
								$glPost[$jndeObj["VGL_JNDE_GLIDN"]]["VGL_JNDE_GLAMT"] += $jndeObj["VGL_JNDE_GLAMT"];

							}							


						}
						$occ += 1;
					}
					if ($name == "BANK")
					{
						$jndeObj["VGL_JNDE_GLIDN"] = $currPaccAcc["BANK"]["VGL_BANK_GLIDN"];
						$jndeObj["VGL_JNDE_CUAMT"] = $currPaccAcc["BANK"]["GLAMT"] * $paccTbls->result[0]["VGL_PACC_DBCRT"];
						$jndeObj["VGL_JNDE_GLAMT"] = round($jndeObj["VGL_JNDE_CUAMT"] * $jnheObj["VGL_JNHE_CURAT"],2) ; // Amount in Home currency
	
						if ($jndeObj["VGL_JNDE_GLAMT"] != 0)
						{
							if (!$glPost[$jndeObj["VGL_JNDE_GLIDN"]])
							{
								$glPost[$jndeObj["VGL_JNDE_GLIDN"]] = $jndeObj;
							}
							else
							{
								$glPost[$jndeObj["VGL_JNDE_GLIDN"]]["VGL_JNDE_CUAMT"] += $jndeObj["VGL_JNDE_CUAMT"];
								$glPost[$jndeObj["VGL_JNDE_GLIDN"]]["VGL_JNDE_GLAMT"] += $jndeObj["VGL_JNDE_GLAMT"];

							}

						}
						
					}
						
				}
							
				 
			}
			
			
			$occPacc += 1;
		}			

		$this->glPost = $glPost;
		foreach($glPost as $name => $value)
		{
		
			if ($value["VGL_JNDE_GLAMT"] != 0 && $this->errorCode == 0)
			{
				$jndeTbls = new dbMaster("vgl_jnde",$this->tblInfo->schema);
		 		$jndeTbls->brTrConn = $this->masterTranConn;
				$jndeTbls->dbInsRec($value);
				
				if ($jndeTbls->errorCode != 0 || $jndeTbls->insertId == 0)
				{
					$this->errorCode = $jndeTbls->errorCode;
					$this->errorCodeText[count($this->errorCodeText)] = "vgl_jnde:" . $name . "-" . $jndeTbls->errorInfo;
					if ($this->errorCode == 0)
					{
						$this->errorCode = 11;
						$this->errorCodeText[count($this->errorCodeText)] = "vgl_jnde:" . " Could not insert " . $name;
					}
				}
				
				// $jndeTbls->pacc = $paccTbls;
				$this->vgl_jnde[count($this->vgl_jnde)] = $jndeTbls;			
			}
			
			
		}			
	
	}


	
	function fiscalYear($docda)
	{
		$docda = str_replace("-","",$docda);
		
		$ret = substr($docda,0,4) * 1;
		return $ret;
	}
	
	function fiscalPeriod($docda)
	{
		$docda = str_replace("-","",$docda);
		$ret = substr($docda,4,2) * 1;
		return $ret;		
	}

	function getDILEVEL()
	{
		$ret = "," . $_SESSION["AB_DUSA"]['usrLevels']['CurrentAffect'];
		return $ret;		
	}
	
		
}

class vgl_journal extends dbMaster
{
	
	function vgl_journal($schema)
	{
		$this->dbMaster("vgl_jnhe",$schema);
	}
	
	function dbSetTrig()
	{	
	
		$localWhere = "";
		// $this->E_POST = $_SESSION["lastPost"];
		
		if ($this->E_POST["vgl_trnid"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["vgl_trnid"]);
			if(count($wClause)>0)
			{
				$localWhere = " ( ";
				$orVal = "";
				$occ = 0;
				while ($occ < count($wClause))
				{
					$localWhere .= $orVal . "idVGL_JNHE = '" . $wClause[$occ] . "' ";
					$orVal = " OR  ";
					$occ += 1;
				} 

				$localWhere .= " ) AND ";

			}

		}
		if ($this->E_POST["CDATE_LIKE"])
		{
			$localWhere .= "VGL_JNHE_CDATE LIKE '" . $this->E_POST["CDATE_LIKE"] . "%' AND ";
		}
		
		if ($this->E_POST["FIND_USLNA"])
		{
			$localWhere .= "VGL_JNHE_USLNA = '" . $this->E_POST["FIND_USLNA"] . "' AND ";
		}
		
		if ($this->E_POST["FIND_SOURCE"])
		{
			$localWhere .= "VGL_JNHE_PSOUR = '" . $this->E_POST["FIND_SOURCE"] . "' AND ";
		}
		
		
		$this->localWhere = $localWhere;


$trig = <<<EOD
			SELECT  * FROM   
			 
		 	( SELECT  * FROM vgl_jnhe  
		 	
		LEFT JOIN vgl_jnde  ON VGL_JNDE_TRNID = idVGL_JNHE  [=COND:vgl_jnde=]
		LEFT JOIN vgl_chart ON idVGL_CHART = VGL_JNDE_GLIDN  [=COND:vgl_chart=]
		WHERE $localWhere [=WHERE=]  [=COND:vgl_jnhe=]  [=LIMIT=] ) tx	  
			 	
			 
		
EOD;

		return $trig;
	}
	
}	
	

class vgl_taxing extends dbMaster
{

	function vgl_taxing($schema)
	{
		$this->dbMaster("vgl_chart",$schema);
	}
	
	
	function dbFindFrom($dtaObj)
	{
		
		$workAmt = $dtaObj["item_amt"];
		$taxRec = $dtaObj["tax_records"];
		
		$taxRec = $this->vgl_taxCalculate($workAmt,$taxRec);
		

		$this->result = $taxRec;
	
	}
	
	function vgl_taxCalculate($wAmt,$taxRec)
	{
		
		$occ = 0;
		$taxAmt = 0;
		while ($occ < count($taxRec))
		{
				
			$tmpAmt = $wAmt;
			if ($taxRec[$occ]["VTX_SCHE_TPREV"] == 1)
			{
				$tmpAmt += $taxAmt;
			}
			
			$taxAmt =  $tmpAmt * $taxRec[$occ]["VTX_SCHE_TAXPE"] / 100;
			$taxRec[$occ]["GLAMT"] += round($taxAmt,2);
			$occ += 1;
		}
		
		return $taxRec;
		
	}

}

class vgl_taxscheme extends dbMaster
{
	function vgl_taxscheme($schema)
	{
		$this->dbMaster("vtx_schh",$schema);
	}

	function dbSetTrig()
	{



$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vtx_schh 
		LEFT JOIN vtx_sche  ON VTX_SCHE_SCHID = idVTX_SCHH  [=COND:vtx_sche=] 
		LEFT JOIN vgl_chart ON idVGL_CHART = VTX_SCHE_GLIDN   [=COND:vgl_chart=] 					
		WHERE [=WHERE=]  [=COND:vtx_schh=]  [=LIMIT=] ) tx		

		
EOD;

		return $trig;
		
	}


	
}


require_once "VGB_GETNFNU.php";


?>
