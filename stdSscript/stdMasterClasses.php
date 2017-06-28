<?php

class dbMaster
{
	
	
	
	function dbMaster($tblName,$schema)
	{
		$this->help = "Master table function" ;
		$this->help .= " Table main access";
		$this->mess = "";
		$this->stdTable = false;
		$this->stdSchema = $schema;
		
		$this->tblInfo = new dbTblInfo($tblName,$schema);
		$this->tblPrimary = new dbTblPrimary($tblName,$schema);
		$this->tblUnique = new dbTblUnique($tblName,$schema);
		$this->tblCtrts = new dbTblConstraints($tblName,$schema);
		$this->tblFlds = new dbTblFields($tblName,$schema);
		$this->brTrConn = null;
		
		$tFnc = new AB_querySession;
		$this->canCreate = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"New");		
		$this->canUpdate = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"Upd");
		$this->canDelete = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"Del");
		$worgLevel = $tFnc->isOrgLevel($this->tblInfo->tblName);
		$this->orgLevelType = $worgLevel["type"];
					
		
		
		$this->processId = $_SESSION["lastPost"]["PROCESS"];
		$this->sessionId = $_SESSION["lastPost"]["SESSION"];
		
		
		//$this->sqlSelect = $this->dbSetTrig();
	}
	
	function ABsetField($tbList)
	{
		$tbl = explode(",",$tbList);
		$ret = "";
		$comma = "";
		$occ = 0;
		while ($occ < count($tbl))
		{
			$tblFlds = new dbTblFields($tbl[$occ],$this->tblInfo->schema);
			$flds = array();
			$wocc = 0;
			while ($wocc < count($tblFlds->dta))
			{
				$flds[$wocc] = $tblFlds->dta[$wocc]["name"];
				$wocc += 1;
			}
			$ret .= $comma . implode(",",$flds);
			$comma = ",";
			
			
			$occ += 1;
		}
		return $ret;
	}


	function ABCountTableRecords($flag)
	{
		
		$localWhere = "";
		if(!$this->ABmasterTable || $this->ABmasterTable == "")
		{
			$this->ABmasterTable = $this->tblInfo->tblName;
		}
		
		$prefix = "(@xx:='AB') ";
		$rtnRecAll = false;
		
		$fl = explode(",",$flag);
		$occ = 0;
		while ($occ < count($fl) && $rtnRecAll == false)
		{
			if (strpos("x" . strtoupper($fl[$occ]),"FILTER:"))
			{
				$tmpCel = explode(",",$fl[$occ]);
				if ($tmpCel[1] > "" && $tmpCel[2] > 0)
				{
					$prefix = "(@xx:= SUBSTRING(" . $tmpCel[1] .",1," . $tmpCel[2] . ")) "; 
					$rtnRecAll = true;
				}
				
			}
			
			$occ += 1;
		}


		
		if (strpos("x" . strtoupper($flag),"LOCAL:"))
		{
			 $localWhere = "WHERE 1=1 [=COND:" . $this->ABmasterTable . "=] ";
		}
		
		
		
		$recCount = new dbMaster($this->ABmasterTable,$this->tblInfo->schema);
			
		
$trig = <<<EOC

SELECT 
{$prefix} AS PREFIX,
count({$recCount->tblPrimary->dta[0]["colName"]}) as totalRecs

FROM {$this->ABmasterTable}  {$localWhere}
GROUP BY PREFIX


EOC;


		$tFnc = new AB_querySession;
		$trig = $tFnc->tblAccessCond($objDta,$trig,true,"onaccess,onaccess.USR");
		
		
		$recCount->dbProcessTransactionPdo($trig);
		if (count($recCount->result) > 0)
		{
			$recCount->result[0]["tblInfo"] = $recCount->tblInfo;
			$recCount->result[0]["trigger"] = $trig;
		}

		return $recCount->result[0];
	}



	function dbMasterTransac()
	{
		$this->transactionError = 0;
		
		
		if ($this->masterTranConn == null)
		{
			$this->dbPdoBeginTransac();
			
		}
		
		if ($this->masterTranConn == null)
		{
			$this->transactionError = 1;
		}
	}	

		
	function dbGetCparm()
	{
	
		$wTbls = new dbMaster("vbp_cparm",$this->tblInfo->schema);
		$dObj = array();
		$dObj["VBP_CPARM_PRMID"] = " ";
		$wTbls->dbFindFrom($dObj);
		
		$retObj = array();
		$occ = 0;
		
		while ($wTbls->result && $occ < count($wTbls->result) )
		{	
			$retObj[$wTbls->result[$occ]["VBP_CPARM_PRMID"]][$wTbls->result[$occ]["VBP_CPARM_PRMNA"]] = $wTbls->result[$occ]["VBP_CPARM_PRMVA"];
			$occ += 1;
		}		
		
		// Get Home Addresses
		$partnerKey = $retObj["VGB_COMPANY"]["BPART"] . $retObj["VGB_COMPANY"]["DIV"];
		$dObj = array();
		$dObj["VGB_BPAR_BPART"] = $partnerKey;
		$wTbls = new dbMaster("vgb_bpar",$this->tblInfo->schema);
		$wTbls->dbFindMatch($dObj);
		
		if (count($wTbls->result)>0 && $wTbls->errorCode == 0)
		{
			$retObj["VGB_COMPANY"]["vgb_bpar"] = $wTbls->result[0];
			$dObj = array();
			$dObj["VGB_ADDR_BPART"] = $wTbls->result[0]["idVGB_BPAR"];
			$wAddr = new vgb_addrHome($this->tblInfo->schema);
			$wAddr->dbFindMatch($dObj);
			$retObj["VGB_COMPANY"]["vgb_addr"] = $wAddr->result;
			
		}			
		
		if (count($wTbls->result)>0 && $wTbls->errorCode == 0)
		{
			// Get Customer Info
			$dObj = array();
			$dObj["VGB_CUST_BPART"] = $wTbls->result[0]["idVGB_BPAR"];
			$wCust = new dbMaster("vgb_cust",$this->tblInfo->schema);
			$wCust->dbFindMatch($dObj);
			$retObj["VGB_COMPANY"]["vgb_cust"] = $wCust->result;
		
			// Get Supplier Info
			$dObj = array();
			$dObj["VGB_SUPP_BPART"] = $wTbls->result[0]["idVGB_BPAR"];
			$wSupp = new dbMaster("vgb_supp",$this->tblInfo->schema);
			$wSupp->dbFindMatch($dObj);
			$retObj["VGB_COMPANY"]["vgb_supp"] = $wSupp->result;
			
		}
		
		return $retObj;
				
	}	


	function getDateFormed()
	{
		$td = getdate();
		$month = strval($td['mon'] + 100);
		$mday = strval($td['mday'] + 100);
		
		$toDay = $td['year'] . "-" . substr($month,1) . "-" . substr($mday,1);
		
		return $toDay;
		
	}

	function getDateTimeStamp()
	{
	
		$wDate = getdate();
		$wTimeStamp = $wDate["year"] . "-" . $wDate["mon"] . "-" .$wDate["mday"] . "  " . $wDate["hours"] . ":" . $wDate["minutes"] . ":" . $wDate["seconds"];
		return $wTimeStamp;
	}



	function onInitNewRec($tbl,$pr)
	{
			
		$tblDocu  = "Function call on event. Set new record Init"; 
		return $tbl;
	}

	
	function dbOrgShare($objdta)
	{
		
		$E_POST = $objdta;
		// $E_POST = setEpost($this->tblInfo->schema,$objdta);
		
  		$nObj = array();
  		$nObj["PROCESS"] = $E_POST["PROCESS"];
		$nObj["SESSION"] = $E_POST["SESSION"];
		
  		$occ = 0;
  		while ($occ < count($this->tblPrimary->dta))
  		{
  			if ($E_POST[$this->tblPrimary->dta[$occ]['colName']] != "" )
  			{
  				
  				$nObj[$this->tblPrimary->dta[$occ]['colName']] = $E_POST[$this->tblPrimary->dta[$occ]['colName']];
  				
  			}
  			$occ += 1;
  		}
  		
  		$occ = 0;
  		while ($occ < count($this->tblUnique->dta))
  		{
  			if ($E_POST[$this->tblUnique->dta[$occ]['fieldName']] != "" )
  			{
  				
  				$nObj[$this->tblUnique->dta[$occ]['fieldName']] = $E_POST[$this->tblUnique->dta[$occ]['fieldName']];
  				
  			}
  			$occ += 1;
  		}
  		$this->orgShare = $nObj;  				
		$this->dbChkMatch($nObj);
		$this->dbFnct = 'dbOrgShare';
	}
	
	function dbChkMatch($objdta)
	{
		$this->dbFnct = 'dbChkMatch';
		$E_POST = $objdta;
		// $E_POST = setEpost($this->tblInfo->schema,$objdta);
		$this->E_POST = $E_POST;
  		$occ = 0;
  		$compare = array();
  		$compVal = array();
		  		
   		$keyName = "";
  		while ($occ < count($this->tblFlds->dta))
  		{
  			
  			
  			
  			if (strlen($E_POST[$this->tblFlds->dta[$occ]['name']]) > 0 )
  			{
  				
  				$compare[count($compare)] = $this->tblFlds->dta[$occ]['name'];
  				$compVal[count($compVal)] = $E_POST[$this->tblFlds->dta[$occ]['name']];
  				
  			}
  			$occ += 1;
  		}
   		
		
  		
  		
  		
		if (count($compare) > 0)
		{  				

			$trig = $this->dbSetTrig();
				
			$whereClause = "";	
			$occ = 0;
			while ($occ < count($compare))
			{

				if ($occ > 0)
				{
					$whereClause .= " AND";
				}
				$whereClause .= " " . $compare[$occ]." = :" .$compare[$occ];
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;

				$occ += 1;
			}
			
			
			$wcp = strpos($trig,"[=WHERE=]");
			$trig = substr($trig,0,$wcp) . $whereClause . substr($trig,$wcp+9);

			$wcp = strpos($trig,"[=LIMIT=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . substr($trig,$wcp+9);
				$limit = "";
			}
			
			$wcp = strpos($trig,"[=ORDBY=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . substr($trig,$wcp+9);
			}
			
			
			$holdTrig = $trig; // Re-use holdTrig for each tbsAccessCond

			$tFnc = new AB_querySession;

			if ($this->RAWBORROW == true)
			{

				// $trig = tbsAccessCond($holdTrig,true,"onupdateUSR");
				$trig = $tFnc->tblAccessCond($objdta,$holdTrig,true,"");
				$this->dbPdoPrep($trig,$vobj,$tobj);
				if ($this->rowCount > 0)
				{
					
					$this->RawUpd = $this->result[0];
					$this->RawUpd["PROCESS"] = $E_POST["PROCESS"];
					$this->RawUpd["SESSION"] = $E_POST["SESSION"];
					$this->dbRawUpd($this->RawUpd);
				}
				$this->shareCount = $this->rowCount;
				$this->shareCountTrig = $trig;
			}		

// New
			$this->canCreate = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"Del");
// Old
//				$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
//				$this->canCreate = strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"New");
//				$this->canUpdate = strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"Upd");
//				$this->canDelete = strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"Del");

	  		// tableName.condition
			// old $trig = tbsAccessCond($holdTrig,true,"onupdate,onupdateUSR");
			$trig = $tFnc->tblAccessCond($objdta,$holdTrig,true,"onupdate,onupdate.USR");

			$this->dbPdoPrep($trig,$vobj,$tobj);
			$this->result = array();
			$this->updCountHelp = "Includes Dimension & user onupdate restrictions";
			$this->updCount =  $this->canUpdate?$this->rowCount:0;
			$this->updCountTrig = $trig;
			
			// OLD $trig = tbsAccessCond($holdTrig,true,"ondelete,ondeleteUSR");
			$trig = $tFnc->tblAccessCond($objdta,$holdTrig,true,"ondelete,ondelete.USR");
			
			$this->dbPdoPrep($trig,$vobj,$tobj);
			$this->result = array();
			$this->delCountHelp = "Includes Dimension & user onupdate restrictions";
			$this->delCount =  $this->canDelete?$this->rowCount:0;
			$this->delCountTrig = $trig;


			// $trig = tbsAccessCond($holdTrig,true,"onupdateUSR");
			$trig = $tFnc->tblAccessCond($objdta,$holdTrig,true,"onupdate.USR");
			$this->dbPdoPrep($trig,$vobj,$tobj);
			$this->result = array();
			$this->usrCountHelp = "Only user onupdate restrictions";
			$this->usrCount = $this->canUpdate?$this->rowCount:0;
			$this->usrCountTrig = $trig;
			
						
			// $trig = tbsAccessCond($holdTrig,false,"");
			$trig = $tFnc->tblAccessCond($objdta,$holdTrig,false,"");
			$this->dbPdoPrep($trig,$vobj,$tobj);
			$this->result = array();
			$this->rawCountHelp = "no restrictions";
			$this->rawCount = $this->rowCount;
			$this->rawCountTrig = $trig;
			
			
			if ($this->RAWBORROW == true)
			{
				$this->result = array();
				$this->result[0] = $this->RawUpd;

			}			
		}
		
	}	

	function dbRawUpd($ePost)
	{
		// $ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
		
		$tFnc = new AB_querySession;
		$tObj = $tFnc->isOrgLevel($this->tblInfo->tblName);
		
		// if ($ab_Dusa[$this->tblInfo->tblName]['dimvalue'])
		if ($tObj != false)
		{
			// $wtmp = $ab_Dusa[$this->tblInfo->tblName]['dimvalue'];
			$wtmp = $tObj["oncreate"];
			$wCol = substr($wtmp,0,strpos($wtmp,":"));
			$wVal = substr($wtmp,strpos($wtmp,":")+1);
			$wOva = $ePost[$wCol];
			$this->orgDim = $wOva;
			$this->newDim = $wVal;
			$this->dimIsNew = strpos($wOva,$wVal);
			if (strpos(",".$wOva,$wVal)==false)
			{
				if (strlen($wOva))
				{
					$wOva .= ",";
				}
				$wOva .= $wVal;
				$ePost[$wCol] = $wOva;
				$this->dbUpdRec($ePost);
				$this->dbUpdRecEpost = $ePost;
			}
			

			
		}
		
		
	}

	function dbFindMatch($objdta)
	{

		$this->dbFnct = 'dbFindMatch';
		$this->objin = $objdta;
		
		$E_POST = $objdta;
		// $E_POST = setEpost($this->tblInfo->schema,$objdta);
		$this->E_POST = $E_POST;
		
		$tFnc = new AB_querySession;
				
		$this->canCreate = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"New");		
		$this->canUpdate = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"Upd");
		$this->canDelete = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"Del");
  		$occ = 0;
  		
  		$repeatPointer = -1; // = -1 no repeat field
  		
  		$compare = array();
  		$compVal = array();
		  		
   		$keyName = "";
  		while ($occ < count($this->tblFlds->dta))
  		{
  			
  			
  			
  			if (strlen($E_POST[$this->tblFlds->dta[$occ]['name']]) > 0 )
  			{
  				
  				$compare[count($compare)] = $this->tblFlds->dta[$occ]['name'];
  				if (!is_array($E_POST[$this->tblFlds->dta[$occ]['name']]))
  				{
	  				$compVal[count($compVal)] = $E_POST[$this->tblFlds->dta[$occ]['name']];
	  			}
	  			else
  				{
  					// Set repeat field once only if -1
  					if ($repeatPointer == -1)
  					{
  						$repeatPointer = count($compVal);
  					}
	  				$compVal[count($compVal)] = $E_POST[$this->tblFlds->dta[$occ]['name']][0];
	  			}
	  			
  				
  			}
  			$occ += 1;
  		}
   		
		
  		
  		
  		
		if (count($compare) > 0)
		{  				

			$trig = $this->dbSetTrig();
				
			$whereClause = "";	
			$occ = 0;
			while ($occ < count($compare))
			{

				if ($occ > 0)
				{
					$whereClause .= " AND";
				}
				$whereClause .= " " . $compare[$occ]." = :" .$compare[$occ];
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;

				$occ += 1;
			}
			
			
			$wcp = strpos($trig,"[=WHERE=]");
			$trig = substr($trig,0,$wcp) . $whereClause . substr($trig,$wcp+9);

			$wcp = strpos($trig,"[=LIMIT=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . substr($trig,$wcp+9);
				$limit = "";
			}
			
			$wcp = strpos($trig,"[=ORDBY=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . substr($trig,$wcp+9);
			}

			
	  		// tableName.condition
			// $trig = tbsAccessCond($trig,true,"onaccess,onaccessUSR");
			$tFnc = new AB_querySession;
			$trig = $tFnc->tblAccessCond($objdta,$trig,true,"onaccess,onaccess.USR");
			
			
			
			$this->canCreate = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($objdta,$this->tblInfo->tblName,"Del");

			
			// $trig .= "; " . $trig;
			
			if (!$E_POST["RECSET"] || count($E_POST["RECSET"]) == 0)
			{
				$this->dbPdoPrep($trig,$vobj,$tobj);
			}
			else
			{
				$aTrig = $E_POST["RECSET"];
				array_unshift($aTrig,$trig);
				//$this->recSet = $aTrig;
				$this->dbPdoRecSet($aTrig,$vobj,$tobj);
			}

			$this->AAssssAA = $this->result;
			
			if ($this->rowCount == 0)
			{
				if (!$this->result)
				{
					$this->result = array();
				}
				$this->result[0] = $this->dbInitNewRec($objdta);
				
			}

			
			//$this->trig = $trig;
			$this->clause = $vobj;
			$this->process = "Match";
		}
		
	}	

	function dbInitNewRec($objdta)
	{
		// Under construction
		
		$E_POST = $objdta;
		// $E_POST = setEpost($this->tblInfo->schema,$objdta);
		$occ = 0;
  		while ($occ < count($this->tblFlds->dta))
  		{
  			
			$ret[$this->tblFlds->dta[$occ]['name']] = $E_POST[$this->tblFlds->dta[$occ]['name']];
	  		if ($ret[$this->tblFlds->dta[$occ]['name']] == "")
	  		{
	  			if ($this->tblFlds->dta[$occ]['default'] != "CURRENT_TIMESTAMP")
	  			{
	  				$ret[$this->tblFlds->dta[$occ]['name']] = $this->tblFlds->dta[$occ]['default'];
	  			}
	  		}
	  		
  			$occ += 1;
  		}
  		
  		$ret = $this->onInitNewRec($ret,"");		
  		return $ret;		
	}
	
	function dbFindLike($objdta)
	{

		$E_POST = $objdta;
		// $E_POST = setEpost($this->tblInfo->schema,$objdta);
		$this->E_POST = $E_POST;
		
  		$occ = 0;
  		$compare = array();
  		$compVal = array();
  		
  		while ($occ < count($this->tblFlds->dta))
  		{
  			if (strlen($E_POST[$this->tblFlds->dta[$occ]['name']]) > 0 )
  			{
  				$compare[count($compare)] = $this->tblFlds->dta[$occ]['name'];
  				$compVal[count($compVal)] = $E_POST[$this->tblFlds->dta[$occ]['name']];
  			}
  			$occ += 1;
  		}


		if (count($compare) > 0)
		{  				

			$trig = $this->dbSetTrig();
				
			$whereClause = "";	
			$occ = 0;
			while ($occ < count($compare))
			{

				if ($occ > 0)
				{
					$whereClause .= " AND";
				}
				$whereClause .= " " . $compare[$occ]." LIKE :" .$compare[$occ];
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;

				$occ += 1;
			}

			$wcp = strpos($trig,"[=WHERE=]");
			$trig = substr($trig,0,$wcp) . $whereClause . substr($trig,$wcp+9);
			
		
			$orderDir = " ASC ";
			$limit = "";
			if ($objdta['MAXREC_OUT'])
			{
				$max = $objdta['MAXREC_OUT'];
				if ($max < 0)
				{
					$orderDir = " desc ";
					$max = $max *-1;
					
				}
				if ($max != 0)
				{
					$limit = " LIMIT :RLIMIT ";
					$vobj['RLIMIT']=intval($max);
					$tobj['RLIMIT']=PDO::PARAM_INT;
				}
					
			}

			$occ = 0;
			$ob = " ";
			while ($occ < count($this->tblUnique->dta))
			{
				if ($occ == 0)
				{
					$ob .= "ORDER BY ";
					$lastIndex = $this->tblUnique->dta[$occ]['keyName'];
				}
				
				if ($lastIndex == $this->tblUnique->dta[$occ]['keyName'])
				{
					if ($occ > 0)
					{
						$ob .= ", ";
					}
					$ob .= $this->tblUnique->dta[$occ]['fieldName'] . $orderDir;
					$orderDir = " ASC ";
				}
				else
				{
					$occ = count($this->tblUnique->dta);
				}
				
				$occ += 1;
			}
			
			$wcp = strpos($trig,"[=LIMIT=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . $limit . substr($trig,$wcp+9);
				$limit = "";
			}
			
			$wcp = strpos($trig,"[=ORDBY=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . $ob . substr($trig,$wcp+9);
			}
			
			$trig .= $ob . $limit;


	  		// tableName.condition
			// OLD $trig = tbsAccessCond($trig,true,"onaccess,onaccessUSR");
			$tFnc = new AB_querySession;
			$trig = $tFnc->tblAccessCond($objdta,$trig,true,"onaccess,onaccess.USR");
			
			$this->dbPdoPrep($trig,$vobj,$tobj);
			
			//$this->trig = $trig;
			$this->clause = $vobj;
			$this->process = "Like";
		}
		
	}
	
	function dbSetTrig()
	{
		$this->stdTable = true;
		
		
$trig = <<<EOD
			SELECT * FROM {$this->tblInfo->tblName} WHERE [=WHERE=] [=COND:{$this->tblInfo->tblName}=]  
EOD;
		return $trig;		
	}
	
	function dbFindFrom($objdta)
	{
		$this->dbFnct = 'dbFindFrom';

		$E_POST = $objdta;
		// $E_POST = setEpost($this->tblInfo->schema,$objdta);
		
		$this->process = "From";
		$this->E_POST = $E_POST;
		
  		$occ = 0;
  		$compare = array();
  		$compVal = array();
  		
  		$keyName = "";
  		
		$trig = $this->dbSetTrig();
		
		while (strpos($trig,"[=COND:"))
		{
			$wcp = strpos($trig,"[=COND:");
			$wtb = substr($trig,$wcp+7);
			$wtb = substr($wtb,0,strpos($wtb,"=]"));
			
			$wTbl = new dbMaster($wtb,$this->tblInfo->schema); 

			$occ = 0;
			
			
			
			
	 		while ($occ < count($wTbl->tblFlds->dta))
	  		{
	  			// 
	  			
	  				
	  			if ($E_POST[$wTbl->tblFlds->dta[$occ]['name']] != "" )
	  			{
	  				$compare[count($compare)] = $wTbl->tblFlds->dta[$occ]['name'];
	  				$compVal[count($compVal)] = $E_POST[$wTbl->tblFlds->dta[$occ]['name']];
	  				$this->cond[$wTbl->tblFlds->dta[$occ]['name']] = $E_POST[$wTbl->tblFlds->dta[$occ]['name']];
	  			}
	  			
	  			$occ += 1;
	  		}
	  		
	  		$trig = substr($trig,0,$wcp) .  substr($trig,$wcp+9+strlen($wtb));	
		}	
		
		$trig = $this->dbSetTrig();
		
		
		$this->qFilters = array();
		$this->qFiltersCond = array();
		$this->qFiltersList = array();
		
		foreach($E_POST as $name => $value)
		{
			if (strpos($trig,":".$name))
			{			
				$compare[count($compare)] = $name;
				$compVal[count($compVal)] = $value;
			}
			else
			{
				if(strpos("x" . $name,"qFilters.")!=false)
				{
					$this->qFilters[substr($name,9)] = $value;
					if (!$this->qFiltersCond[substr($name,9)])
					{
						$this->qFiltersCond[substr($name,9)] = "";
					}
				}
				
				if(strpos("x" . $name,"qFiltersCond.")!=false)
				{
					$this->qFiltersCond[substr($name,13)] = $value;
				}
				if(strpos("x" . $name,"qFiltersList.")!=false)
				{
					$this->qFiltersList[substr($name,13)] = $value;
				}
				
			}
		}
		$this->pretrig = $trig;
		$this->precount = count($compare);
		if (count($compare) > 0)
		{  				

			$trig = $this->dbSetTrig();
			
			
			$orderDir = " ASC ";
			$limit = "";
			
			$compareSign = ">";
			
			
			if ($objdta['MAXREC_OUT'])
			{
				$max = $objdta['MAXREC_OUT'];
				if ($max < 0)
				{
					$compareSign = "<";
					$orderDir = " desc ";
					$max = $max *-1;
					
				}
				if ($max != 0)
				{
					$limit = " LIMIT :RLIMIT ";
					$vobj['RLIMIT']=intval($max);
					$tobj['RLIMIT']=PDO::PARAM_INT;
				}
					
			}
			
			
				
			$whereClause = "(";	
			$occ = 0;
			while ($occ < count($compare))
			{
				// First one
				if ($occ == 0)
				{
					$whereClause .= " ( " . $compare[$occ] . " " . $compareSign . " :" . $compare[$occ];
					if ($objdta['GETMATCH'] == "1" || count($compare) > 1 )
					{
						$whereClause .= " ) OR ( " . $compare[$occ]. " " . $compareSign ."= :" .$compare[$occ];
					}
				}
				else
				{
					if ($objdta['GETMATCH'] == "1" || count($compare) > $occ + 1 )
					{
						$whereClause .= " AND " . $compare[$occ]. " " . $compareSign . "= :" .$compare[$occ];
					}
					else
					{
						$whereClause .= " AND " . $compare[$occ]. " " . $compareSign . " :" .$compare[$occ];
					}
				}
										
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;
				$occ += 1;
			}
			$whereClause .=   " ) )";
			
			$mb = explode(",",$E_POST['REQUIRED']);
			$occ = 0;
			while ($occ < count($mb))
			{
				if ($mb[$occ])
				{		
					$whereClause .= " AND " . $mb[$occ] . " = " . "'" . $E_POST[$mb[$occ]] . "' " ; 
				}
				$occ += 1;
			}

			$whereClause .= $this->setDbFilters();
			
	
			$this->whereClause = $whereClause;
			
			
			
			$wcp = strpos($trig,"[=WHERE=]");
			$trig = substr($trig,0,$wcp) . $whereClause . substr($trig,$wcp+9);
			

			$occ = 0;
			$ob = " ";
			$mainOb = "";
			
			if ($E_POST['SORTED'])
			{
				$ob .= "ORDER BY " . $E_POST['SORTED']  . $orderDir;
				$orderDir = " ASC ";
				$mainOb .= "ORDER BY " . $E_POST['SORTED']  . $orderDir;
			}
				
				
			// Never true 1==0 AC2016-12-27 removed
			while ($occ < count($this->tblUnique->dta) && !$E_POST['SORTED'] )
			{

				if ($occ == 0)
				{
					$ob .= "ORDER BY ";
					$mainOb .= "ORDER BY ";
					
					$lastIndex = $this->tblUnique->dta[$occ]['keyName'];
				}
				
				if ($lastIndex == $this->tblUnique->dta[$occ]['keyName'])
				{
					if ($occ > 0)
					{
						$ob .= ", ";
						$mainOb .= ", ";
					}
					$ob .= $this->tblUnique->dta[$occ]['fieldName'] . $orderDir;
					$orderDir = " ASC ";
					$mainOb .= $this->tblUnique->dta[$occ]['fieldName'] . $orderDir;
				}
				else
				{
					$occ = count($this->tblUnique->dta);
				}
				
				$occ += 1;
			}
			
			$wcp = strpos($trig,"[=LIMIT=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . $limit . substr($trig,$wcp+9);
				$limit = "";
			}
			
			$this->ob = $ob;
			$this->mainOb = $mainOb;
			
			$wcp = strpos($trig,"[=ORDBY=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . $ob . substr($trig,$wcp+9);
				$ob = $mainOb;
				
			}
			
			$trig .= $ob . $limit;
			
			if ($this->stdTable == true)
			{
				$trig = " SELECT * FROM ( " . $trig . ") xx " . $mainOb;
			}
			
	  		// tableName.condition
			// OLD $trig = tbsAccessCond($trig,true,"onaccess,onaccessUSR");
			
			$this->trigBefAccessCond = $trig;
			
			$tFnc = new AB_querySession;
			$trig = $tFnc->tblAccessCond($objdta,$trig,true,"onaccess,onaccess.USR");
			$this->conditions = $tFnc->conditions;
			
			$this->trig = $trig;
			$this->clause = $vobj;
			
			$this->dbPdoPrep($trig,$vobj,$tobj);
		}
		
	}

	function setDbFilters()
	{
		
		$wCl = "";
		$wAnd = " ";
		
		foreach($this->qFilters as $name => $value)
		{
			
			$wCl .= $wAnd . $this->setDbFiltersCond($name,$value);
			$wAnd = " AND ";
		}
		
		if ($wCl != "")
		{
			$wCl = " AND ( " . $wCl . " ) ";
		}
		
		return $wCl;
	}
	
	function setDbFiltersCond($wName,$wValue)
	{

		$condReturn = "";
				
		$cond = explode(",",$this->qFiltersCond[$wName]);
		$wOr = "";
		
		// ab-filter-cond-examaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ" 
		
		$occ = 0;
		$this->qFiltersCondCount = $wName . "==" .  count($cond) . "=" . strtoupper($cond[$occ]);
		
		while ($occ < count($cond))
		{
			switch ( strtoupper($cond[$occ]) )
			{
				case "EQ":
					$condReturn .= $wOr . $this->setDbFiltersBuild($wName,$wValue, " = '","' ");
				break;
				case "GR":
					$condReturn .= $wOr . $this->setDbFiltersBuild($wName,$wValue, " > '","' ");
//					$condReturn .= $wOr . $wName . " > '" . $wValue . "' ";
				break;
				case "SM":
					$condReturn .= $wOr . $this->setDbFiltersBuild($wName,$wValue, " < '","' ");
//					$condReturn .= $wOr . $wName . " < '" . $wValue . "' ";
				break;
				case "NE":
					$condReturn .= $wOr . $this->setDbFiltersBuild($wName,$wValue, " <> '","' ");
//					$condReturn .= $wOr . $wName . " <> '" . $wValue . "' ";
				break;
				case "STARTS":
					$condReturn .= $wOr . $this->setDbFiltersBuild($wName,$wValue, " LIKE '","%' ");
//					$condReturn .= $wOr . $wName . " LIKE '" . $wValue . "%' ";
				break;
				case "CONTAINS":
					$condReturn .= $wOr . $this->setDbFiltersBuild($wName,$wValue, " LIKE '%","%' ");
//					$condReturn .= $wOr . $wName . " LIKE '%" . $wValue . "%' ";
				break;
				case "ENDS":
					$condReturn .= $wOr . $this->setDbFiltersBuild($wName,$wValue, " LIKE '%","' ");
//					$condReturn .= $wOr . $wName . " LIKE '%" . $wValue . "' ";
				break;
				
				default:
					
					// $condReturn .= $wOr . $wName . " = '" . $wValue . "' ";
				
			}
		
			$wOr = " OR ";
			$occ += 1;
		}
		
		return $condReturn;
		
	}
	
	
	function setDbFiltersBuild($oName,$oValue,$lead,$trail)
	{
		
		if (!$this->qFiltersList[$oName])
		{
			$result = $oName . $lead . $oValue . $trail;
			return $result;
		}
		
		$wOr = "";
		$wFields = explode(",",$this->qFiltersList[$oName]);
		$occ = 0;
		
		$result = " ( ";

		while ($occ < count($wFields))
		{
			$result .= $wOr . $wFields[$occ] . $lead . $oValue . $trail;
			$wOr = " OR ";
			$occ += 1;
		}
		
		$result .= " ) ";
		
		return $result;
		
		
		
		
	}
	
	function dbPdoBeginTransac()
	{
		$servername = "localhost";
		
		$tFnc = new AB_querySession;
		$tObj = $tFnc->getschemaReference($this->tblInfo->tblName);
		$username = $tObj['GSRresult'][0]['CFG_DBREF_DBUSER'];
		$password = $tObj['GSRresult'][0]['CFG_DBREF_DBUSERPWD'];
		$dbname = $this->tblInfo->schema;
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 	

		try 
		{
			
			$this->PDOhasExecuted = false;					
			$this->PDObegin = $this->PDOhasExecuted;
			
			$this->masterTranConn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
			$this->masterTranConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$this->PDOhasExecuted = true;
			$this->PDObegin = $this->PDOhasExecuted;
			
			$this->masterTranConn->beginTransaction();
			
		}
		catch(PDOException $e)
		{
			
			$this->masterTranConn = null;
			
		}
		
		
		
	}

	function dbPdoEndTransac($commit)
	{
		
		if ($commit == true )
		{
			$this->masterTranConn->commit();
			
		}
		else
		{
			$this->masterTranConn->rollback();
			
		}
		
		$this->masterTranConn = null;
		$this->brTrConn = null;
	}
	
	function dbProcessTransactionPdo($trig)
	{
	
		$servername = "localhost";
		
		// NEW
		$tFnc = new AB_querySession;
		$tObj = $tFnc->getschemaReference($this->tblInfo->tblName);
		$username = $tObj['GSRresult'][0]['CFG_DBREF_DBUSER'];
		$password = $tObj['GSRresult'][0]['CFG_DBREF_DBUSERPWD'];
		

		$dbname = $this->tblInfo->schema;

		try
		{

			$this->PDOhasExecuted = false;
			$this->PDOprocessTransaction = $this->PDOhasExecuted;
			
			if ($this->brTrConn != null)
			{
				$conn = $this->brTrConn;
				$this->pdoSeesIt = true;
			}
			else
			{
				$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 				
				$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
	
				$this->pdoSeesIt = false;
			}
			
			$this->PDOhasExecuted = true;
			$this->PDOprocessTransaction = $this->PDOhasExecuted;
			
			$stmt = $conn->prepare($trig);
			$err = $stmt->execute();
			
			$wDate = getdate();
			$this->pdoTimeStmp = $wDate["year"] . "-" . $wDate["mon"] . "-" .$wDate["mday"] . "  " . $wDate["hours"] . ":" . $wDate["minutes"] . ":" . $wDate["seconds"];
			
			$this->pdoErrorCode = $stmt->errorCode();
			
			$this->errorInfo = $stmt->errorInfo();
			$this->errCount = count($this->errorInfo);
			if ($this->errCount > 1)
			{
				$this->errorCode = $this->errorInfo[1];
			}
			else
			{
				$this->errorCode = 0;
			}
			
			$this->rowCount = $stmt->rowCount();
			
			
			$result = $stmt->fetchAll();
			
		}
		catch(PDOException $e)
		{
			$this->PDOException = $e;

			if ($this->PDOhasExecuted == false)
			{
				$this->errorInfo = array();
			}
			else
			{
				$this->errorInfo = $stmt->errorInfo();
			}
			$this->errCount = count($this->errorInfo);
			if ($this->errCount > 1)
			{
				$this->errorCode = $this->errorInfo[1];
			}
			else
			{
//				$this->errorCode = 0;
			}
			
		}
				
		$this->fetchResult = $result;

		$occ = 0;
		while (count($result) > $occ)
		{
			$result[$occ] =  seturlDecode($result[$occ]);	
	
			$occ += 1;
		}
		
		$this->result = $result;


		if ($this->brTrConn == null)
		{
			$conn = null;
			$stmt = null;
		}
		else
		{
			// Under observation
			$conn = null;
			$stmt = null;
			$this->brTrConn = null;
		}
		
		$xxx = array();
		$xxx["PDOException"] = $this->PDOException;
		$xxx["errorInfo"] = $this->errorInfo;
		$xxx["errCount"] = $this->errCount;
		
		$xxx["rowCount"] = $this->rowCount;
		$xxx["result"] = $this->result;	
		return $xxx;	
		
	}
	
	function dbPdoPrep($trig,$dta,$dtaType)
	{
		ob_start();

		$conn = null;
		
		$servername = "localhost";
		
		// NEW
		$tFnc = new AB_querySession;
		$tObj = $tFnc->getschemaReference($this->tblInfo->tblName);
		$username = $tObj['GSRresult'][0]['CFG_DBREF_DBUSER'];
		$password = $tObj['GSRresult'][0]['CFG_DBREF_DBUSERPWD'];
		

		$dbname = $this->tblInfo->schema;
		
		$this->PDOtrig = $trig;

		try
		{

			$this->PDOhasExecuted = false;
			$this->PDOprep = $this->PDOhasExecuted;
			
			if ($this->brTrConn != null)
			{
				$conn = $this->brTrConn;
				$this->pdoSeesIt = true;
			}
			else
			{
				$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 				
				$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
	
				$this->pdoSeesIt = false;
			}
			$this->PDOhasExecuted = true;
			$this->PDOprep = $this->PDOhasExecuted;
			
			$stmt = $conn->prepare($trig);
			foreach($dta as $name => $value)
			{
	
				$keyName = $name;
				$keyVal = $value;
				$keyType = $dtaType[$name];
				$stmt->bindValue(":" . $keyName,$keyVal,$keyType);
				
			}	


			$err = $stmt->execute();

			
				
			if (stripos("  " . $trig,"insert") > 0)	
			{
				echo  "\n--errorCode:" . $stmt->errorCode() . "\n--\n";
				$ter = $stmt->errorInfo();
				echo  "\n--Info Count:" . count($ter);
				$occ = 0;
				while ($occ < count($ter))
				{
					echo  "\n--Info" . $occ . ":" . $ter[$occ];
					$occ += 1;
				}
				echo "\n--\n";
				foreach($dta as $name => $value)
				{
			
		
					echo "keyName =".$name;
					echo "=". $value;
					echo "=keyType=" . $dtaType[$name];
					echo "\n";
					
					
				}	
					
			}		
			
			$wDate = getdate();
			$this->pdoTimeStmp = $wDate["year"] . "-" . $wDate["mon"] . "-" .$wDate["mday"] . "  " . $wDate["hours"] . ":" . $wDate["minutes"] . ":" . $wDate["seconds"];
			
			$this->pdoErrorCode = $stmt->errorCode();
			
			$this->errorInfo = $stmt->errorInfo();
			$this->errCount = count($this->errorInfo);
			if ($this->errCount > 1)
			{
				$this->errorCode = $this->errorInfo[1];
			}
			else
			{
				$this->errorCode = 0;
			}
			
			$this->rowCount = $stmt->rowCount();
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			
			
		}
		catch(PDOException $e)
		{
			$this->PDOException = $e;

			if ($this->PDOhasExecuted == false)
			{
				$this->errorInfo = array();
				$this->errorInfo[0] = "Server Timed out";
				$this->errorInfo[1] = 10;
				$this->errorCode = 10;
				return;
				
			}
			else
			{
				$this->errorInfo = $stmt->errorInfo();
			}
			$this->errCount = count($this->errorInfo);
			if ($this->errCount > 1)
			{
				$this->errorCode = $this->errorInfo[1];
			}
			else
			{
				$this->errorCode = 0;
			}
			
		}
				
		$this->fetchResult = $result;

		$occ = 0;
		while (count($result) > $occ)
		{
			$result[$occ] =  seturlDecode($result[$occ]);	
	
			$occ += 1;
		}
		
		$this->result = $result;

		//$this->trig = $trig;
		$this->lastId = $conn->lastInsertId();

		if ($this->brTrConn == null)
		{
			$conn = null;
			$stmt = null;
		}
		else
		{
			// Under observation
			$conn = null;
			$stmt = null;
			$this->brTrConn = null;
		}

// Test logout action			
//			$this->PDOhasExecuted = false;
//			$this->errorInfo = array();
//			$this->errorInfo[0] = "Server Timed out";
//			$this->errorInfo[1] = 10;
//			$this->errorCode = 10;
							
		
		ob_end_clean();
	}
	
	
	
	
	function dbPdoRecSet($trig,$dta,$dtaType)
	{
		
		$this->recSetCount = 0;
		$recSetResult = array();
		
		$occ = 1;		
		while ($occ < count($trig))
		{
			$dta = $trig[$occ];
			
			$this->dbPdoPrep($trig[0],$dta,$dtaType);
			$this->recSetCount += $this->rowCount;
			
			$wocc = 0;
			while ($wocc < count($this->result) )
			{
				$recSetResult[count($recSetResult)] = $this->result[$wocc];
				$wocc += 1;
			}
			
			$occ += 1;
		}
		
		$this->recSetResult = $recSetResult;


		
	}

	function dbGenPrep($wTbls,$dtaObj,$ePost)
	{
		
		$this->dbFnct = 'dbGenPrep';
		// Old
		// $ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
		// if (strpos(",".$ab_Dusa[$wTbls->tblInfo->tblName]['allow'],"New") == true)
		
		// New
		$tFnc = new AB_querySession;
		if ($tFnc->hasPriviledge($ePost,$wTbls->tblInfo->tblName,"New") != false)
		{
			$tri = $dtaObj["trig"];
			$vob = $dtaObj["vobj"];
			$tob = $dtaObj["tobj"];
			
			$wTbls->dbPdoPrep($tri,$vob,$tob);

			if ($wTbls->lastId > 0)
			{
				
				$wTbls->inserted = $wTbls->tblPrimary->dta[0]["colName"];
				$rid = array();
				$rid[$wTbls->tblPrimary->dta[0]["colName"]] = $wTbls->lastId;
				$wTbls->dbChkMatch($rid);
				$wTbls->dbFindMatch($rid);
			}
			
		}
		else
		{
			$wTbls->allowErr = 901;
			$wTbls->allowMess = "No permission to to Create";
			$wTbls->allow = $tFnc->hasPriviledge($ePost,$wTbls->tblInfo->tblName,""); // Get Priviledges
		}
			

		
		$wTbls->clause = $vobj;					
		

		if ($wTbls->errorCode != 0)
		{
			$wTbls->dbValidConstraints($dtaObj);
			$wTbls->success = false;
		}
		else
		{
			 $wTbls->dbFindMatch($dtaObj);
			 $wTbls->success = true;
		}		
		
		return $wTbls;
	}
	
	
	function dbInsertSet($wTbls,$schema,$dtaObj)
	{
		
		$this->dbFnct = 'dbInsertSet';
		
		$E_POST = $dtaObj;
		// $E_POST = setEpost($schema,$dtaObj);
		
		$insertSet = array();
		
		$tblOcc = 0;
		while ($tblOcc < count($wTbls))
		{
			
	  		$occ = 0;
	  		
	  		$compare = array();
	  		$compVal = array();

			$vobj = array();
			$tobj = array();
	
			$trig = " INSERT INTO ". $wTbls[$tblOcc]->tblInfo->tblName . " ";
	
			$wFields = array();
			$wClause = array();
			while ($occ < count($wTbls[$tblOcc]->tblFlds->dta))
			{
				if ($dtaObj[$wTbls[$tblOcc]->tblFlds->dta[$occ]['name']] != "" )
				{
					$wFields[count($wFields)] = $wTbls[$tblOcc]->tblFlds->dta[$occ]['name'];
					$wClause[count($wClause)] = " :" . $wTbls[$tblOcc]->tblFlds->dta[$occ]['name'] . " ";
	  				$compare[count($compare)] = $wTbls[$tblOcc]->tblFlds->dta[$occ]['name'];
					$compVal[count($compVal)] = $E_POST[$wTbls[$tblOcc]->tblFlds->dta[$occ]['name']];
					
				}
				$occ += 1;
			}
			
			if (count($wClause) == 0)
			{
				// $xxthis->errno = 1;
				// $xxthis->mess = "No data to insert in " . $wTbls[$tblOcc]->tblInfo->tblName ;
			}
			else
			{
				$wtmp = "";
				
				// $ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
				// if ($ab_Dusa[$wTbls[$tblOcc]->tblInfo->tblName]['dimvalue'])
				$tFnc = new AB_querySession;
				$tObj = $tFnc->isOrgLevel($wTbls[$tblOcc]->tblInfo->tblName);
		
				
				if ($tObj != false)				
				{
					// $wtmp = $ab_Dusa[$wTbls[$tblOcc]->tblInfo->tblName]['dimvalue'];
					$wtmp = $tObj["oncreate"];
					$wFields[count($wFields)] = substr($wtmp,0,strpos($wtmp,":"));	
					$wClause[count($wClause)] = " :" . substr($wtmp,0,strpos($wtmp,":")). " ";
					$compare[count($compare)] = substr($wtmp,0,strpos($wtmp,":"));	
					$compVal[count($compVal)] = "," . substr($wtmp,strpos($wtmp,":")+1);	
				}
	
							
				$trig .= "(" . implode(",",$wFields) . ") VALUES (".implode(",",$wClause).")";
				// echo $trig . "\nWTMP= " . $wtmp;
				//$this->trigger = $trig;
				
				$occ = 0;
				while ($occ < count($compare))
				{
					$vobj[$compare[$occ]]= $compVal[$occ];
					$tobj[$compare[$occ]]=PDO::PARAM_STR;
					$occ += 1;
				}
			}
			
			$insertSet[$tblOcc]["trig"] = $trig;
			$insertSet[$tblOcc]["vobj"] = $vobj;
			$insertSet[$tblOcc]["tobj"] = $tobj;	
			
			$tblOcc += 1;
		}		
		
		return $insertSet;		
		
		
	}

	function dbValidConstraints($dtaObj)
	{
		$wcon = $this->tblCtrts;
		$fieldDta = $this->tblFlds->dta;
		
		$occ = 0;
		
		$this->invalidConstraintsTrig = array();
		
		$this->invalidConstraints = array();
				
		while ($occ < count($wcon->dta))
		{
			
			
			$trig = "SELECT * FROM " . $wcon->dta[$occ]['refTbl'] . " WHERE ";

			$wClause = array();
			$wocc = 0;
			$wField = "";
			
			foreach($wcon->dta[$occ]['refFields'] as $name => $value)
			{
		    		$wClause[count($wClause)] = $value . " = '" . $dtaObj[$name] ."' " ;
		    		// Get first field of where clause
		    		if ($wField == "")
		    		{
					$wField = $name;
				};
			}
			
			$wFieldDesc = $wField;
			$focc = 0;
			while($focc < count($fieldDta))
			{
				if($fieldDta[$focc]["name"] == $wField)
				{
					$wFieldDesc = $fieldDta[$focc]["comment"];
					$focc = count($fieldDta);
				}
				
				$focc += 1;
			}
			
			
			$trig .= implode(" AND ",$wClause);
			
			$wTbls = new dbMaster($wcon->dta[$occ]['refTbl'],$this->tblInfo->schema);
			$wTbls->dbProcessTransactionPdo($trig);
//			$this->invalidConstraintsTrig[occ] = array();
//			foreach($wTbls as $name => $value)
//			{
//				 $this->invalidConstraintsTrig[$occ][$name] = $value;
//			}			
			if ($wTbls->rowCount == 0)
			{
				$this->invalidConstraints[count($this->invalidConstraints)]->field = $wField;
				$this->invalidConstraints[count($this->invalidConstraints)-1]->mess = "<label>".$wFieldDesc."</label> not found " ;
				$this->invalidConstraints[count($this->invalidConstraints)-1]->mess = "Not found " ;
				$this->invalidConstraints[count($this->invalidConstraints)-1]->table = $wcon->dta[$occ]['refTbl'];
				$this->invalidConstraints[count($this->invalidConstraints)-1]->constraint = $wcon->dta[$occ]['name'];
			}

			
//			$valRet = new valQuery($this->tblInfo->schema,$trig);
//			if ($valRet->success == false)
//			{
//				$this->invalidConstraints[count($this->invalidConstraints)]->field = $wField;
//				$this->invalidConstraints[count($this->invalidConstraints)-1]->mess = $valRet->ret;
//				$this->invalidConstraints[count($this->invalidConstraints)-1]->table = $wcon->dta[$occ]['refTbl'];
//				$this->invalidConstraints[count($this->invalidConstraints)-1]->constraint = $wcon->dta[$occ]['name'];
//			}
			
			$occ += 1;
		}
		
		
		
	}
	
	function dbDelRec($dtaObj)
	{
		
		$this->dbFnct = 'dbDelRec';
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";


		$E_POST = $dtaObj;
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
  		$occ = 0;
  		$compare = array();
  		$compVal = array();
  		
		$trig = " DELETE  FROM ". $this->tblInfo->tblName . " WHERE ";
		$occ = 0;
		$wClause = array();
		while ($occ < count($this->tblPrimary->dta))
		{
			if (!$E_POST[$this->tblPrimary->dta[$occ]['colName']] || $E_POST[$this->tblPrimary->dta[$occ]['colName']] == "" )
			{
				$wClause = array();
				$occ = count($this->tblPrimary->dta);
			}
			else
			{
				$wClause[count($wClause)] = $this->tblPrimary->dta[$occ]['colName'] . " = :" . $this->tblPrimary->dta[$occ]['colName'] . " ";
				$compare[count($compare)] = $this->tblPrimary->dta[$occ]['colName'];
				$compVal[count($compVal)] = $E_POST[$this->tblPrimary->dta[$occ]['colName']];

			}
			$occ += 1;
		}
		
		if (count($wClause) == 0)
		{
			$this->errno = 1;
			$this->mess = "You must supply the Primary key to delete a record";
		}
		else
		{
			$trig .= implode(" AND ",$wClause);

//			$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
//			if ($ab_Dusa[$this->tblInfo->tblName]['ondelete'])

			$tFnc = new AB_querySession;
			$tObj = $tFnc->isOrgLevel($wTbls[$tblOcc]->tblInfo->tblName);
			if ($tObj != false)				
			{
				 $trig .= " AND " . $tObj['ondelete'] . " ";
			
			}
			
			$occ = 0;
			while ($occ < count($compare))
			{
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;
				$occ += 1;
			}
						
			
//			if (strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"Del") == true)
			if ($tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del") != false)
			{
				$this->dbPdoPrep($trig,$vobj,$tobj);
				if ($this->errorCode == 0 && $this->rowCount >0)
				{

					$rid = array();
					$rid[$this->tblPrimary->dta[0]["colName"]] = null;
					$this->result = array();
					$this->result[0] = $rid;
				}
					
			}
			else
			{
				$this->allowErr = 903;
				$this->allowMess = "No permission to Delete ";
				// $this->allow = $ab_Dusa[$this->tblInfo->tblName]['allow'];
				$this->allow = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"");
				$this->allowObj = $dtaObj;
			}

			$holdFnct = $this->dbFnct;
			$holdCode =$this->errorCode;
			$holdInfo =$this->errorInfo;
			$holdRow = $this->rowCount;

			$rid = array();
			$rid["PROCESS"] = $dtaObj["PROCESS"];
			$rid["SESSION"] = $dtaObj["SESSION"];
			
			$rid[$this->tblPrimary->dta[0]["colName"]] = $E_POST[$this->tblPrimary->dta[0]["colName"]];
			$this->dbChkMatch($rid);

			
			$this->errorCode = $holdCode;
			$this->errorInfo = $holdInfo;
			$this->rowCount = $holdRow;
			$this->dbFnct = $holdFnct;

			$this->clause = $vobj;		


		}
			
		
		
			
	}

	function isToSetNull($flName,$toNull)
	{

		$ret = false;
		
		if($toNull && strpos("x,".$toNull."," , ",".$flName.",") > 0)
		{
			$ret = true;
		}
		
		
		return $ret;
		
	}

	function dbUpdRec($dtaObj)
	{

		$this->dbFnct = 'dbUpdRec';
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";

		$E_POST = $dtaObj;
		$this->E_POST = $E_POST;
		$this->formalPOST = $dtaObj;
		
		
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
  		$occ = 0;
  		$compare = array();
  		$compVal = array();


		$trig = "UPDATE ". $this->tblInfo->tblName . " ";

		$occ = 0;
		$wClause = array();
		while ($occ < count($this->tblPrimary->dta))
		{
			
			if (!$E_POST[$this->tblPrimary->dta[$occ]['colName']] || $E_POST[$this->tblPrimary->dta[$occ]['colName']] == "" )
			{
				$wClause = array();
				$occ = count($this->tblPrimary->dta);
			}
			else
			{
				$wClause[count($wClause)] = $this->tblPrimary->dta[$occ]['colName'] . " = :" . $this->tblPrimary->dta[$occ]['colName'] . " ";
  				$compare[count($compare)] = $this->tblPrimary->dta[$occ]['colName'];
				$compVal[count($compVal)] = $E_POST[$this->tblPrimary->dta[$occ]['colName']];

			}

			$occ += 1;
		}
		

		if (count($wClause) == 0)
		{
			$this->errno = 1;
			$this->mess = "You must supply the Primary key to update a record";
		}
		else
		{	
			$occ = 0;
			$wFields = array();
			while ($occ < count($this->tblFlds->dta))
			{

				if ($this->isToSetNull($this->tblFlds->dta[$occ]['name'],$E_POST["dbSetToNull"]))
				{
					$wFields[count($wFields)] = $this->tblFlds->dta[$occ]['name'] . " = :" . $this->tblFlds->dta[$occ]['name'] . " ";
		  			$compare[count($compare)] = $this->tblFlds->dta[$occ]['name'];
					$compVal[count($compVal)] = null;


					
				}
				else
				{	
					if ($this->tblFlds->dta[$occ]['name']=="VIN_INVE_ALOQT")
					{
						$this->E_POST_IF = (!$E_POST[$this->tblFlds->dta[$occ]['name']]);
					}

					// Warning AC 20150516 Field not part of update
					if (strlen($E_POST[$this->tblFlds->dta[$occ]['name']]) > 0 )
					{
						$wwval = $E_POST[$this->tblFlds->dta[$occ]['name']];
						
						$wFields[count($wFields)] = $this->tblFlds->dta[$occ]['name'] . " = :" . $this->tblFlds->dta[$occ]['name'] . " ";
		  				$compare[count($compare)] = $this->tblFlds->dta[$occ]['name'];
		  				
						$compVal[count($compVal)] = $wwval;  // $E_POST[$this->tblFlds->dta[$occ]['name']];
					}
				
				}

				$occ += 1;
			}
			
			
			
			if (count($wFields) == 0)
			{
				$this->errno = 1;
				$this->mess = "No data to update ";
			}
			else
			{
	
				$trig .= " SET " . implode(",",$wFields) . " WHERE ".implode(" AND ",$wClause);
// you are here AC20151016
// old				$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
// New
				// Dimension  Org Level if not RAWBorrow
				$tFnc = new AB_querySession;
				$ab_Dusa = $tFnc->isOrgLevel($this->tblInfo->tblName); // Dimension 
				if ($ab_Dusa['onupdate'] && $this->RAWBORROW != true)
				{
					 $trig .= " AND " . $ab_Dusa['onupdate'] . " ";
				}

				// User Table Security and access  (Not implemented yet
				$ab_Dusa = $tFnc->hasTblCtrts("",$this->tblInfo->tblName);
				if ($ab_Dusa['onupdate'] )
				{
					 $trig .= " AND " . $ab_Dusa['onupdate'] . " ";
				}
				
				// User Process Session Table Security and access
				$ab_Dusa = $tFnc->hasTblCtrts($dtaObj,$this->tblInfo->tblName);
				if ($ab_Dusa['onupdate'] )
				{
					 $trig .= " AND " . $ab_Dusa['onupdate'] . " ";
				}

				

				$occ = 0;
				while ($occ < count($compare))
				{
					$vobj[$compare[$occ]]= $compVal[$occ];
					$tobj[$compare[$occ]]=PDO::PARAM_STR;
					$occ += 1;
				}
			
			$hthis = array();	
			$hthis['canCreate'] = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
			$hthis['canUpdate'] = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
			$hthis['canDelete'] = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
			
				// $ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
				
				// Old if (strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"Upd") != false)
				if ($tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd"))
				{
					$this->dbPdoPrep($trig,$vobj,$tobj);
					$holdCode =$this->errorCode;
					$holdInfo =$this->errorInfo;
					$holdRow = $this->rowCount;

					$rid = array();
					$rid[$this->tblPrimary->dta[0]["colName"]] = $E_POST[$this->tblPrimary->dta[0]["colName"]];
					$this->dbChkMatch($rid);
					$this->errorCode = $holdCode;
					$this->errorInfo = $holdInfo;
					$this->rowCount = $holdRow;
					
				}
				else
				{
					$this->allowErr = 902;
					$this->allowMess = "No permission to Update ";
					// OLD $this->allow = $ab_Dusa[$this->tblInfo->tblName]['allow'];
					$this->allow = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"");
				}				
				$this->clause = $vobj;
									

				if ($this->errorCode != 0)
				{
					$this->dbValidConstraints($dtaObj);
				}
				//$this->trig = $trig;		
				$this->success = true;
				$this->dbFnct = 'dbUpdRec';
				$this->canCreate = $hthis['canCreate'];
				$this->canUpdate = $hthis['canUpdate'];
				$this->canDelete = $hthis['canDelete'];

			}
			
		};
		
		
			
	}

	function dbInsRec($dtaObj)
	{
		$this->dbFnct = 'dbInsRec';

		$tFnc = new AB_querySession;
		$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
		$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
		$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
		
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";

		$E_POST = $dtaObj;
		//$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
  		$occ = 0;
  		
  		$compare = array();
  		$compVal = array();

		$trig = " INSERT INTO ". $this->tblInfo->tblName . " ";
		$this->dbgTrig = $trig;
		
		$this->chkClause = array();

		$wFields = array();
		$wClause = array();
		while ($occ < count($this->tblFlds->dta))
		{
			if (strlen($dtaObj[$this->tblFlds->dta[$occ]['name']]) > 0  )
			{
				$this->chkClause[$this->tblFlds->dta[$occ]['name']] = strlen($dtaObj[$this->tblFlds->dta[$occ]['name']])."-".$dtaObj[$this->tblFlds->dta[$occ]['name']]."-";
				$wFields[count($wFields)] = $this->tblFlds->dta[$occ]['name'];
				$wClause[count($wClause)] = " :" . $this->tblFlds->dta[$occ]['name'] . " ";
  				$compare[count($compare)] = $this->tblFlds->dta[$occ]['name'];
				$compVal[count($compVal)] = $E_POST[$this->tblFlds->dta[$occ]['name']];
				
			}
			$occ += 1;
		}
		
		if (count($wClause) == 0)
		{
			$this->errno = 1;
			$this->mess = "No data to insert ";
		}
		else
		{
			$wtmp = "";
			
// OLD			$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
// New			// Dimension  Org Level
			$tFnc = new AB_querySession;
			$ab_Dusa = $tFnc->isOrgLevel($this->tblInfo->tblName); // Dimension 

// OLD			if ($ab_Dusa[$this->tblInfo->tblName]['dimvalue'])
			if ($ab_Dusa['oncreate'])			
			{
				// OLD $wtmp = $ab_Dusa[$this->tblInfo->tblName]['dimvalue'];
				$wtmp = $ab_Dusa['oncreate'];
				$wFields[count($wFields)] = substr($wtmp,0,strpos($wtmp,":"));	
				$wClause[count($wClause)] = " :" . substr($wtmp,0,strpos($wtmp,":")). " ";
				$compare[count($compare)] = substr($wtmp,0,strpos($wtmp,":"));	
				$compVal[count($compVal)] = "," . substr($wtmp,strpos($wtmp,":")+1);	

				
			}

						
			$trig .= "(" . implode(",",$wFields) . ") VALUES (".implode(",",$wClause).")";
			// echo $trig . "\nWTMP= " . $wtmp;
			$this->trigger = $trig;
			
			$occ = 0;
			while ($occ < count($compare))
			{
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;
				$occ += 1;
			}
			

// OLD			$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
// OLD			if (strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"New") == true)

// echo "ERROR----\n";
$this->eTrig = $trig;
$this->eVal = $vobj;
$this->fNam =$tobj;

$holdNewId = 0;
			$this->prepTrig = $trig;
			$this->prepTrigV = $vobj;
			$this->prepTrigT = $tobj;
			
			if ($tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New"))
			{
				
				
				$this->dbPdoPrep($trig,$vobj,$tobj);
				
				
				
				$holdNewId = $this->lastId;

				if ($this->lastId > 0)
				{
					$this->inserted = $this->tblPrimary->dta[0]["colName"];
					$rid = array();
					$rid[$this->tblPrimary->dta[0]["colName"]] = $this->lastId;
					$this->dbChkMatch($rid);

					$this->dbFindMatch($rid);
				}
				

			}
			else
			{
				$this->allowErr = 901;
				$this->allowMess = "No permission to Create";
				// OLD $this->allow = $ab_Dusa[$this->tblInfo->tblName]['allow'];
				$this->allow = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"");
			}
				


			$this->clause = $vobj;					
			
						

			if ($this->errorCode != 0)
			{
				$this->dbValidConstraints($dtaObj);
				$this->success = false;
			}
			else
			{
				 $this->dbFindMatch($dtaObj);
				 $this->success = true;
			}
		
								
			

		}
		
		$this->insertId = $holdNewId;
			
		$this->dbFnct = 'dbInsRec';
		// return $ret;
			
	}

}


class ORGdbTblInfo
{
	public $tblName;
	public $tblComment;

	function ORGdbTblInfo($tname,$schema)
	{

		$this->help = "Table General Information";
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";


	
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{
			$trig ="
			 SELECT *  FROM INFORMATION_SCHEMA.TABLES  
			  WHERE TABLE_SCHEMA='" . $schema . "' AND TABLE_NAME='" .$tname."'
			 ";
		  
			$result = mysqli_query($g->con,$trig);

			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;		
			
			if($row = mysqli_fetch_array($result)) 
			{
				$this->success = true;
				$this->schema = $row['TABLE_SCHEMA'];
				$this->tblName = $row['TABLE_NAME'];
				$this->tblComment = $row['TABLE_COMMENT'];
			
			}
			
			
			closeConnection($g->con);
		};		
	
	}
}

class dbTblInfo
{
	public $tblName;
	public $tblComment;

	function dbTblInfo($tname,$schema)
	{


		if (!$_SESSION["dbTblInfo"][$tname."_".$schema])
		{
			$this->help = "Table General Information";
			$this->errno = 0;
			$this->success = false;
			$this->mess = "";
	
		
			$trig ="
			 SELECT *  FROM INFORMATION_SCHEMA.TABLES  
			  WHERE TABLE_SCHEMA='" . $schema . "' AND TABLE_NAME='" .$tname."'
			 ";
	
			$row = localPDO($schema,$trig);
	
	
				
			$this->success = true;
			$this->schema = $row[0]['TABLE_SCHEMA'];
			$this->tblName = $row[0]['TABLE_NAME'];
			$this->tblComment = $row[0]['TABLE_COMMENT'];
			
			$this->PDOrow = $row;
			
			$trig = "SHOW CREATE TABLE " .$tname;
			$create = localPDO($schema,$trig);
			$this->Create = $create;

//			$trig = "SHOW TRIGGERS " ;
//			$triggers = localPDO($schema,$trig);
//			$this->Triggers = $triggers;
						
			if ($this->errno == 0)
			{
				$_SESSION["dbTblInfo"][$tname."_".$schema] = array();
				$_SESSION["dbTblInfo"][$tname."_".$schema]["help"] = $this->help;
				$_SESSION["dbTblInfo"][$tname."_".$schema]["errno"] = $this->errno;
				$_SESSION["dbTblInfo"][$tname."_".$schema]["success"] = $this->success;
				$_SESSION["dbTblInfo"][$tname."_".$schema]["schema"] =  $row[0]['TABLE_SCHEMA'];
				$_SESSION["dbTblInfo"][$tname."_".$schema]["tblName"] = $row[0]['TABLE_NAME'];
				$_SESSION["dbTblInfo"][$tname."_".$schema]["tblComment"] = $row[0]['TABLE_COMMENT'];
				$_SESSION["dbTblInfo"][$tname."_".$schema]["PDOrow"] = $row;
				$_SESSION["dbTblInfo"][$tname."_".$schema]["Create"] = $create;
//				$_SESSION["dbTblInfo"][$tname."_".$schema]["Triggers"] = $triggers;
			}
			
		}
		else
		{
			foreach($_SESSION["dbTblInfo"][$tname."_".$schema] as $name => $value)
			{
				 $this->$name = $value;
			}

		}
	}
}


function localPDO($schema,$trig)
{
		ob_start();
		$_SESSION["PDO_ERR"] = "none";

		$servername = "localhost";
		// Was main administrator before mod
		$username = "devUser";
		$password = "Nesh792ab";	
		$dbname = $schema;		






		try
		{
			
			$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 				
			$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password, $options);


			$stmt = $conn->prepare($trig);
			$stmt->execute();
			
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			$_SESSION["PDO_ERR"] = $e->getMessage();
//			$this->PDOException = $e;
//			$this->errorInfo = $stmt->errorInfo();
//			$this->errCount = count($this->errorInfo);
//			if ($this->errCount > 1)
//			{
//				$this->errorCode = $this->errorInfo[1];
//			}

		}		
		$stmt = null;
		$conn = null;	
		ob_end_clean();

		return $row;		
	
}

class dbTblPrimary
{

	function dbTblPrimary($tname,$schema)
	{

		if(!$_SESSION["dbTblPrimary"][$tname."_".$schema])
		{
			$this->help = "Table Primary Key Fields";
			$this->errno = 0;
			$this->success = false;
			$this->mess = "";
			
			$trig ="SHOW INDEX FROM " . $tname . " FROM " . $schema . " WHERE Key_Name='PRIMARY' ";
			
			
			$row = localPDO($schema,$trig);
			
			
			$occ = 0;
			$this->dta = array();
			while($this->errno == 0 && $occ < count($row)) 
			{
				$this->success = true;
				$this->dta[count($this->dta)]['colName'] = $row[$occ]['Column_name'];
				$occ += 1;
				
			}
			
			$this->PDOrow = $row;
			
			if ($this->errno == 0)
			{
				$_SESSION["dbTblPrimary"][$tname."_".$schema] = array();
				$_SESSION["dbTblPrimary"][$tname."_".$schema]["help"] = $this->help;
				$_SESSION["dbTblPrimary"][$tname."_".$schema]["errno"] = $this->errno;
				$_SESSION["dbTblPrimary"][$tname."_".$schema]["mess"] = $this->mess;
				$_SESSION["dbTblPrimary"][$tname."_".$schema]["success"] = $this->success;
				$_SESSION["dbTblPrimary"][$tname."_".$schema]["dta"] = $this->dta;
			}
			
			
		}
		else
		{
			foreach($_SESSION["dbTblPrimary"][$tname."_".$schema] as $name => $value)
			{
				 $this->$name = $value;
			}

		}			
			
	}
	
}

class ORGdbTblPrimary
{

	function ORGdbTblPrimary($tname,$schema)
	{

		$this->help = "Table Primary Key Fields";
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";
		
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{
			$trig ="SHOW INDEX FROM " . $tname . " FROM " . $schema . " WHERE Key_Name='PRIMARY' ";
			
			$result = mysqli_query($g->con,$trig);
			
			
			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;
			$this->dta = array();
			while($this->errno == 0 && $row = mysqli_fetch_array($result)) 
			{
				$this->success = true;
				$this->dta[count($this->dta)]['colName'] = $row['Column_name'];
			}
			
			closeConnection($g->con);
		};
		
			
	}
	
}

class dbTblUnique
{

	function dbTblUnique($tname,$schema)
	{
		
		if(!$_SESSION["dbTblUnique"][$tname."_".$schema])
		{
	
			$this->help = "Table Unique Key Fields ";
			$this->errno = 0;
			$this->success = false;
			$this->mess = "";
			
			$trig ="SHOW INDEX FROM " . $tname . " FROM " . $schema . " WHERE Key_Name !='PRIMARY' AND Non_unique = 0";
			
			$row = localPDO($schema,$trig);
			
			$occ = 0;
			while($this->errno == 0 && $occ < count($row)) 
			{
				$this->success = true;
				$tmp['keyName'] = $row[$occ]['Key_name'];
				$tmp['seq'] = $row[$occ]['Seq_in_index'];
				$tmp['fieldName'] = $row[$occ]['Column_name'];
				
				$this->dta[count($this->dta)] = $tmp;
				
				$occ += 1;
			}
			
			$this->PDOrow = $row;

			if ($this->errno == 0)
			{
				$_SESSION["dbTblUnique"][$tname."_".$schema] = array();
				$_SESSION["dbTblUnique"][$tname."_".$schema]["help"] = $this->help;
				$_SESSION["dbTblUnique"][$tname."_".$schema]["errno"] = $this->errno;
				$_SESSION["dbTblUnique"][$tname."_".$schema]["mess"] = $this->mess;
				$_SESSION["dbTblUnique"][$tname."_".$schema]["success"] = $this->success;
				$_SESSION["dbTblUnique"][$tname."_".$schema]["dta"] = $this->dta;
			}
			
		}
		else
		{
			foreach($_SESSION["dbTblUnique"][$tname."_".$schema] as $name => $value)
			{
				 $this->$name = $value;
			}

		}				
			
	}
	
}


class ORGdbTblUnique
{

	function ORGdbTblUnique($tname,$schema)
	{

		$this->help = "Table Unique Key Fields ";
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";
		
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{
			$trig ="SHOW INDEX FROM " . $tname . " FROM " . $schema . " WHERE Key_Name !='PRIMARY' AND Non_unique = 0";
			
			$result = mysqli_query($g->con,$trig);
			
			
			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;
			
			
			while($this->errno == 0 && $row = mysqli_fetch_array($result)) 
			{
				$this->success = true;
				$tmp['keyName'] = $row['Key_name'];
				$tmp['seq'] = $row['Seq_in_index'];
				$tmp['fieldName'] = $row['Column_name'];
				
				$this->dta[count($this->dta)] = $tmp;
				
			}
			
			closeConnection($g->con);
		};
		
			
	}
	
}



class dbTblConstraints 
{
	
	function dbTblConstraints($tname,$schema)
	{
		
		
		if (!$_SESSION["dbTblConstraints"][$tname."_".$schema])
		{
		
			$this->help = "Table Constraints";
			$this->errno = 0;
			$this->success = false;
			$this->mess = "";
			
	
			$trig ="
			 SELECT * 
			     FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
			      WHERE REFERENCED_TABLE_SCHEMA = '" . $schema . "' AND TABLE_NAME = '".$tname."' 
			      ORDER BY TABLE_NAME,CONSTRAINT_NAME,ORDINAL_POSITION	
				";
			$row = localPDO($schema,$trig);
			
			$this->dta = array();	
	
			$wocc = 0;				
			$occ = 0;	
			$consName = "";	
			while($wocc < count($row))
			{
				$this->success = true;
		
				$outName = "";
				if ($consName != $row[$wocc]['CONSTRAINT_NAME'])
				{
					if ($consName != "")
					{
						$this->dta[$occ-1]['refFields'] = $fld;
					}
					$fld = array();
					$consName = $row[$wocc]['CONSTRAINT_NAME'];
					$this->dta[$occ]['name']= $row[$wocc]['CONSTRAINT_NAME'];
					$this->dta[$occ]['refTbl'] =  $row[$wocc]['REFERENCED_TABLE_NAME'];	
					
					$occ += 1;
					
				}
				
				$fld[$row[$wocc]['COLUMN_NAME']] = $row[$wocc]['REFERENCED_COLUMN_NAME'];
				
				$wocc += 1;
				
			};

			if ($consName != "")
			{
				$this->dta[$occ-1]['refFields'] = $fld;
			}
			
			$this->PDOrow = $row;

			if ($this->errno == 0)
			{
				$_SESSION["dbTblConstraints"][$tname."_".$schema] = array();
				$_SESSION["dbTblConstraints"][$tname."_".$schema]["help"] = $this->help;
				$_SESSION["dbTblConstraints"][$tname."_".$schema]["errno"] = $this->errno;
				$_SESSION["dbTblConstraints"][$tname."_".$schema]["success"] = $this->success;
				$_SESSION["dbTblConstraints"][$tname."_".$schema]["dta"] = $this->dta;
			}
			
		}
		else
		{
			foreach($_SESSION["dbTblConstraints"][$tname."_".$schema] as $name => $value)
			{
				 $this->$name = $value;
			}

		}		
	
		
	}

}


class ORGdbTblConstraints 
{
	
	function ORGdbTblConstraints($tname,$schema)
	{
		
		$this->help = "Table Constraints";
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";
		
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{
		
			$trig ="
			 SELECT * 
			     FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
			      WHERE REFERENCED_TABLE_SCHEMA = '" . $schema . "' AND TABLE_NAME = '".$tname."' 
			      ORDER BY TABLE_NAME,CONSTRAINT_NAME,ORDINAL_POSITION	
				";
			
			$result = mysqli_query($g->con,$trig);
			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;
			$this->dta = array();	
			
			$occ = 0;	
			$consName = "";	
			while($row = mysqli_fetch_array($result)) 
			{
				$this->success = true;
		
				$outName = "";
				if ($consName != $row['CONSTRAINT_NAME'])
				{
					if ($consName != "")
					{
						$this->dta[$occ-1]['refFields'] = $fld;
					}
					$fld = array();
					$consName = $row['CONSTRAINT_NAME'];
					$this->dta[$occ]['name']= $row['CONSTRAINT_NAME'];
					$this->dta[$occ]['refTbl'] =  $row['REFERENCED_TABLE_NAME'];	
					$occ += 1;
					
				}
				
				$fld[$row['COLUMN_NAME']] = $row['REFERENCED_COLUMN_NAME'];
				
				
				
			};

			if ($consName != "")
			{
				$this->dta[$occ-1]['refFields'] = $fld;
			}
		
			closeConnection($g->con);
		
		};
		
	}

}


class dbTblFields
{

	function dbTblFields($tname,$schema)
	{


		if (!$_SESSION["dbTblFields"][$tname."_".$schema])
		{
			
			$this->help = "Table Fields Information";
			$this->errno = 0;
			$this->success = false;
			$this->mess = "";
			
		
			$trig ="
			 SELECT *  FROM INFORMATION_SCHEMA.COLUMNS  
			  WHERE TABLE_SCHEMA='". $schema ."' AND TABLE_NAME='" .$tname."'
			  
			  ORDER BY TABLE_NAME, ORDINAL_POSITION";
		  
			
			$row = localPDO($schema,$trig);
			
		 
			
			$occ = 0;
			while($occ < count($row)) 
			{
				
				$this->success = true;
	
				$cons = array();
				$cons['name'] 		= $row[$occ]['COLUMN_NAME'];
				$cons['type'] 		= $row[$occ]['COLUMN_TYPE'];
				$cons['default'] 	= $row[$occ]['COLUMN_DEFAULT'];
				$cons['auto'] 		= $row[$occ]['EXTRA'];
				$cons['comment']	= $row[$occ]['COLUMN_COMMENT'];
				
				$this->dta[$occ] = $cons;
				
				$occ += 1;
			}
			
			$this->PDOrow = $row;
			
			if($this->errno == 0)
			{
				$_SESSION["dbTblFields"][$tname."_".$schema] = array();
				$_SESSION["dbTblFields"][$tname."_".$schema]["help"] = $this->help;
				$_SESSION["dbTblFields"][$tname."_".$schema]["errno"] = $this->errno;
				$_SESSION["dbTblFields"][$tname."_".$schema]["success"] = $this->success;
				$_SESSION["dbTblFields"][$tname."_".$schema]["dta"] = $this->dta;
			}
			
		}
		else
		{
			foreach($_SESSION["dbTblFields"][$tname."_".$schema] as $name => $value)
			{
				 $this->$name = $value;
			}
			
		}
		

	
	}

}


class ORGdbTblFields
{

	function ORGdbTblFields($tname,$schema)
	{

		$this->help = "Table Fields Information";
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";
		
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{	
			$trig ="
			 SELECT *  FROM INFORMATION_SCHEMA.COLUMNS  
			  WHERE TABLE_SCHEMA='". $schema ."' AND TABLE_NAME='" .$tname."'
			  
			  ORDER BY TABLE_NAME, ORDINAL_POSITION";
		  
			$result = mysqli_query($g->con,$trig);
			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;
			 
			
			$occ = 0;
			while($row = mysqli_fetch_array($result)) 
			{
		

				$cons = array();
				$cons['name'] 		= $row['COLUMN_NAME'];
				$cons['type'] 		= $row['COLUMN_TYPE'];
				$cons['default'] 	= $row['COLUMN_DEFAULT'];
				$cons['auto'] 		= $row['EXTRA'];
				$cons['comment']	= $row['COLUMN_COMMENT'];
				
				$this->dta[$occ] = $cons;
				
				$occ += 1;
			}
	
			
		
		
				
				

		
			closeConnection($g->con);
		};
	
	}

}



class vgb_addrHome extends dbMaster
{
	function vgb_addrHome($schema)
	{
		$this->dbMaster("vgb_addr",$schema);
		// $this->AB_CPARM = $this->dbGetCparm();
	}
	

	function dbSetTrig()
	{


$trig = <<<EOD
			SELECT * FROM 
			 
		 	( SELECT * FROM vgb_addr 
		 	
		LEFT JOIN vgb_bpar ON idVGB_BPAR = VGB_ADDR_BPART [=COND:vgb_bpar=]
		LEFT JOIN vtx_schh ON idVTX_SCHH = VGB_ADDR_SCHID OR idVTX_SCHH = VGB_ADDR_PCHID [=COND:vtx_schh=]
		LEFT JOIN vgb_cntr ON idVGB_CNTR = VGB_ADDR_CNTID [=COND:vgb_cntr=]
		LEFT JOIN vgb_prst ON idVGB_PRST = VGB_ADDR_PRSID [=COND:vgb_prst=]
		
		WHERE [=WHERE=] [=COND:vgb_addr=]  [=LIMIT=] ) t1
				

		
EOD;

		return $trig;
		
	}
		
}

class vbp_ssnhist extends dbMaster
{

	function vbp_ssnhist($schema)
	{
		$this->dbMaster("vbp_ssnhist",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}
	
	
	function dbSetTrig()
	{

		$localWhere = "";
		if ($this->E_POST["VBP_SSNHIST_USERID"] && $this->E_POST["VBP_SSNHIST_USERID"] > 0)
		{
			$localWhere .= " ( VBP_SSNHIST_USERID = '" . $this->E_POST["VBP_SSNHIST_USERID"] . "' ) AND ";
		}
		
				
$trig = <<<EOD

			SELECT * FROM
			 
		 	( SELECT * FROM vbp_ssnhist 
				 	
							
		WHERE $localWhere [=WHERE=]  [=COND:vbp_ssnhist=] [=LIMIT=] ) tx		
		
EOD;

		return $trig;
	}
	
	function dbInsRec($objDta)
	{

	  	$E_POST = $objDta;
	  	//$E_POST = setEpost($this->tblInfo->schema,$objDta);
	  	
		$E_POST["VBP_SSNHIST_LASTTIME"] = date("Ymdahis");
		if ($E_POST["ABfavorite"] == "1")
		{
			$E_POST["VBP_SSNHIST_ETYPE"] = "favor";
		}
	  	$wTbls = new dbMaster("vbp_ssnhist",$this->tblInfo->schema);
		$wTbls->dbInsRec($E_POST);
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}

		// $this->cleanUpUlist($E_POST);
	}


	function dbUpdRec($objDta)
	{

	  	$E_POST = $objDta;
	  	// $E_POST = setEpost($this->tblInfo->schema,$objDta);
	  	
		if ($E_POST["ABfavorite"] == "1")
		{
			$E_POST["VBP_SSNHIST_ETYPE"] = "both";
		}
		else
		{
			$E_POST["VBP_SSNHIST_LASTTIME"] = date("Ymdahis");
		}

	  	$wTbls = new dbMaster("vbp_ssnhist",$this->tblInfo->schema);
	  	
		$wTbls->dbUpdRec($E_POST);
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		// $this->cleanUpUlist($E_POST);

				
	}
	
	function cleanUpUlist($objDta)
	{
		$nObj = array();
		$nObl["idVBP_SSNHIST"] = "0";
		$nObl["VBP_SSNHIST_USERID"] = $objDta["VBP_SSNHIST_USERID"];
		$wTbls = new dbMaster("vbp_ssnhist",$this->tblInfo->schema);
		$wTbls->dbFindFrom($nObj);		
		
		
	}
		
}


function dspTblInfo($tblQ)
{
//[=DOC=]Sets Table schema Post information 

	$tblParam['tblName'] = $tblQ->tblInfo->tblName;
	$tblParam['tblDesc'] = $tblQ->tblInfo->tblComment;
	$tblParam['tblFields'] = $tblQ->tblFlds;
	$tblParam['tblPrimary'] = $tblQ->tblPrimary;
	$tblParam['tblUnique'] = $tblQ->tblUnique;
	$tblParam['tblConstraints'] = $tblQ->tblCtrts;
	
	return $tblParam;
}

		




function tbsAccessCond($trig,$condOn,$cond)
{
// $con should be "onaccess" or "onupdate" for checks

	$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
	
	$condList = explode(",",$cond);
	
	while (strpos($trig,"[=COND:"))
	{
		$wcp = strpos($trig,"[=COND:");
		$wtb = substr($trig,$wcp+7);
		$wtb = substr($wtb,0,strpos($wtb,"=]"));
		
		$wCond = "";
		$occ = 0;
		while ($occ < count($condList) && $condOn)
		{	
			if ($ab_Dusa[$wtb][$condList[$occ]])
			{
				$wCond .= " AND " . $ab_Dusa[$wtb][$condList[$occ]] . " ";
			}
		
			$occ += 1;
		}
	
		$trig = substr($trig,0,$wcp) . $wCond . substr($trig,$wcp+9+strlen($wtb));

	}	

	return $trig;

}


function TESTsetEpost($schema,$post)
{

	
	foreach($post as $name => $value)
	{
		if (!is_array($value) )
		{
			 $ret[$name] = $value;
		}
		else
		{
			$occ = 0;
			while ($occ < count($value))
			{
				$ret[$name][$occ] = $value[$occ]; 
				$occ += 1;
			}
		}
	}
	
	return $ret;

}



function setEpost($schema,$post)
{


	// $g = openConnection($schema);
	
	foreach($post as $name => $value)
	{
		if (!is_array($value))
		{
			 // $ret[$name] = mysqli_real_escape_string($g->con,$value);
			 $ret[$name] = $value;
		}
		else
		{
			$occ = 0;
			while ($occ < count($value))
			{
				$ret[$name][$occ] = $value[$occ]; 
				

				$occ += 1;
			}
		}
			
	}
	
	// closeConnection($g->con);
	
	return $ret;

}

function seturlDecode($obj)
{
	// AC 2016-10-22 turning off this function to see result
//		foreach($obj as $name => $value)
//		{
//			 $ret[$name] = urldecode($value);
//		}
//	
//		return $ret;

	return $obj;
}



class valQuery 
{
	public $query;
	public $ferr; 
	public $errno;
	public $error;
	public $ret;
	
	
	
	function valQuery($schema,$trig)
	{
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";
		
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{			
			$result = mysqli_query($g->con,$trig);
			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;

			$ret = "";
			$ferr = 0;
			$this->ferr = 0;
			
			if (mysqli_errno($g->con) != 0)
			{
				$ret = "CHKALL:1 - Err:". mysqli_errno($g->con) . " - " .  mysqli_error($g->con); 			
		
			}
			else
			{
				if ($row = mysqli_fetch_array($result))
				{
					$this->success = true;
					$ret = "";
				}
				else
				{
					$ret =  "Err:Not found";
					$ferr = 1;
				}
			}
		
			$this->ferr = $ferr;
			$this->ret = $ret;
			
			closeConnection($g->con);	
		};
	}

}

class abAmountWords
{
	function evalAmt($amt)
	{
		
		// 1005 IF AMT>999999.99 THEN LET AMT$=$$; GOTO 1090
		if ($amt > 999999.99)
		{
			return "** " . $amt . " **" ;
		}
		$amtWords = $this->setAmtWords();
		// 1010 LET AMOUNT$=STR(INT(AMT):"000000")
		$amount = "000000" . intval($amt);
		$amount = substr($amount, strlen($amount)-6,6);
		
		$amtDescr = "** ";
		
		if (substr($amount,0,1)*1 > 0)
		{
			$amtDescr = $this->singles($amtDescr, substr($amount,0,1) , $amtWords);
		}
		
		$amtDescr = $this->doubles($amtDescr, substr($amount,1,2) , $amtWords);
	
		if (substr($amount,0,3)*1 > 0)
		{
			$amtDescr .= $amtWords["thousand"];
		}
	
		if (substr($amount,3,1)*1 > 0)
		{
			$amtDescr = $this->singles($amtDescr, substr($amount,3,1) , $amtWords);
		}
	
		$amtDescr = $this->doubles($amtDescr, substr($amount,4,2) , $amtWords);
	
		if ($amt != 0)
		{	
			
			$cents = "00" . round((($amt*1) - intval($amt*1)),2)*100 ;
			$cents = substr($cents, strlen($cents)-2,2);
			$amtDescr .= $amtWords["and"] . $cents . "/100";
		}
		
		$amtDescr .= " **";
		
		return $amtDescr;
		
			
	
	}
	
	// Hundreds 
	function singles($amt,$val,$amtWords)
	{
		
		
		$amt .= $amtWords["single"][$val*1] . $amtWords["hundred"];
		
		return $amt;
	}
	
	function doubles($amt,$val,$amtWords)
	{
		if ($val*1 < 20)
		{
			if ($val*1 > 0)
			{
				$amt .= $amtWords["single"][$val*1];
			}
		}
		else
		{
			$amt .= $amtWords["double"][substr($val,0,1)*1];	
			if (substr($val,1,1)*1 > 0)
			{
				$amt .= " " . $amtWords["single"][substr($val,1,1)*1*1];
			}
		}
		
		return $amt;
	}
	
	
	
	
	// 3000 REM 3000 Set Dollar Sets - DSET1 & DSET2
	function setAmtWords()
	{
		
		$single = array();
		$single[count($single)] = "";
		$single[count($single)] = "ONE";
		$single[count($single)] = "TWO";
		$single[count($single)] = "THREE";
		$single[count($single)] = "FOUR";
		$single[count($single)] = "FIVE";
		$single[count($single)] = "SIX";
		$single[count($single)] = "SEVEN";
		$single[count($single)] = "EIGHT";
		$single[count($single)] = "NINE";
		$single[count($single)] = "TEN";
		$single[count($single)] = "ELEVEN";
		$single[count($single)] = "TWELVE";
		$single[count($single)] = "THIRTEEN";
		$single[count($single)] = "FOURTEEN";
		$single[count($single)] = "FIFTEEN";
		$single[count($single)] = "SIXTEEN";
		$single[count($single)] = "SEVENTEEN";
		$single[count($single)] = "EIGHTEEN";
		$single[count($single)] = "NINETEEN";
		
		$double = array();
		$double[count($double)] = "";
		$double[count($double)] = "";
		$double[count($double)] = "TWENTY";
		$double[count($double)] = "THIRTY";
		$double[count($double)] = "FORTY";
		$double[count($double)] = "FIFTY";
		$double[count($double)] = "SIXTY";
		$double[count($double)] = "SEVENTY";
		$double[count($double)] = "EIGHTY";
		$double[count($double)] = "NINETY";
		
		$amtWords = array();
		$amtWords["single"] = $single;
		$amtWords["double"] = $double;
		$amtWords["thousand"] = " THOUSAND ";
		$amtWords["hundred"] = " HUNDRED ";
		$amtWords["and"] = " AND ";
		$amtWords["andOne"] = "";
			
		return $amtWords;
	}
		
	function setAmtWordsFr()
	{
		// Not yet working
		
		$single = array();
		$single[count($single)] = "";
		$single[count($single)] = "ET UN";
		$single[count($single)] = "DEUX";
		$single[count($single)] = "TROIS";
		$single[count($single)] = "QUATRE";
		$single[count($single)] = "CINQ";
		$single[count($single)] = "SIX";
		$single[count($single)] = "SEPT";
		$single[count($single)] = "HUIT";
		$single[count($single)] = "NEUF";
		$single[count($single)] = "DIX";
		$single[count($single)] = "ONZE";
		$single[count($single)] = "DOUZE";
		$single[count($single)] = "TREIZE";
		$single[count($single)] = "QUATORZE";
		$single[count($single)] = "QUINZE";
		$single[count($single)] = "SEIZE";
		$single[count($single)] = "DIX-SEPT";
		$single[count($single)] = "DIX-HUIT";
		$single[count($single)] = "DIX-NEUF";
		
		$double = array();
		$double[count($double)] = "";
		$double[count($double)] = "";
		$double[count($double)] = "VINGT";
		$double[count($double)] = "TRENTE";
		$double[count($double)] = "QUARANTE";
		$double[count($double)] = "CINQUANTE";
		$double[count($double)] = "SOIXANTE";
		$double[count($double)] = "SOIXANTE-DIX";
		$double[count($double)] = "QUATRE-VINGTS";
		$double[count($double)] = "QUATRE-VINGT-DIX";
		
		$amtWords = array();
		$amtWords["single"] = $single;
		$amtWords["double"] = $double;
		$amtWords["thousand"] = " MILLE ";
		$amtWords["hundred"] = " CENT ";
		$amtWords["and"] = " ET ";
		$amtWords["andOne"] = "";
			
		return $amtWords;
	}
	
}	




function openConnection($schema)
{
	
	
	$ret->errno = 0;
	$ret->success = false;
	$ret->mess = "";
	
	
	// $username = $_SESSION['dbUser'];
	// $password = $_SESSION['dbUserPwd'];
	
	// $servername = "127.0.0.1";
	$servername = "localhost";
	// Was main administrator before mod
	$username = "devUser";
	$password = "Nesh792ab";	


	
	$ret->con=mysqli_connect($servername,$username,$password,$schema);
	if (mysqli_connect_errno($ret->con)) 
	{
		$_SESSION["setEpost"] .= mysqli_connect_errno($ret->con) .  mysqli_connect_error($ret->con);
		$ret->errno = mysqli_connect_errno();
		$ret->mess = mysqli_connect_error();
	}
	else
	{
		$_SESSION["setEpost"] .= "not me at all";
		$ret->success = true;
	};
	
	return $ret;	
}

function closeConnection($con)
{
	mysqli_close($con);
}




?>