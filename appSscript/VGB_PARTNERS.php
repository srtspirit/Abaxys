<?php

class vgb_bpar extends dbMaster
{
	function vgb_bpar($schema)
	{
		$this->dbMaster("vgb_bpar",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}

	function dbInsRec($dtaObj)
	{
		// Partner
		$this->dbFnct = 'dbInsRec';
		$E_POST = $dtaObj;
  		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
  		
  		$wret = array();
  		
  		$dtaObj["VGB_BPAR_BPART"] = trim($dtaObj["VGB_BPAR_BPART"]);
  		

  		
  		// Bpar;
  		
  		$wTbls = array();
  		$wTbls[0] = new dbMaster("vgb_bpar",$this->tblInfo->schema);
		$mainTbls = $wTbls[0];

		$this->invalidConstraints = array();
  		$this->errorCodeText = array();
  		
  		if (strpos("x". $dtaObj["VGB_BPAR_BPART"] , $this->AB_CPARM["VGB_COMPANY"]["BPART"])==1
  		&& $dtaObj["VGB_BPAR_BPART"] != trim($this->AB_CPARM["VGB_COMPANY"]["BPART"] . $this->AB_CPARM["VGB_COMPANY"]["DIV"]) )
  		{
			$this->errorCode = 8900;
			$this->errorCodeText[count($this->errorCodeText)] = "Insert failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Cannot create partner if code begins with ".$this->AB_CPARM["VGB_COMPANY"]["BPART"];
			$this->rowCount  = 0;	
			$tFnc = new AB_querySession;
			$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
			return;			

  		}

  		$insertSet = $this->dbInsertSet($wTbls,$this->tblInfo->schema,$dtaObj);
  		$this->insertSet = $insertSet;
		$wret[0] = $this->dbGenPrep($wTbls[0],$insertSet[0],$dtaObj);
		
		$this->updErrCode = $wTbls[0];
		$updErr = $wret[0]->errorCode;
		
		if ($updErr == 0)
		{
			$this->updErrCodeRe = $wret[0]->result[0]["idVGB_BPAR"];
			$dtaObj["idVGB_BPAR"] = $wret[0]->result[0]["idVGB_BPAR"];
			$dtaObj["VGB_ADDR_BPART"] = $dtaObj["idVGB_BPAR"];
			$dtaObj["VGB_CUST_BPART"] = $dtaObj["idVGB_BPAR"];
			$dtaObj["VGB_SUPP_BPART"] = $dtaObj["idVGB_BPAR"];
		}

		
		// ADDR;
  		$wTbls = array();
		$wTbls[0] = new dbMaster("vgb_addr",$this->tblInfo->schema);
		if ($updErr == 0)
		{
			
			

	  		$insertSet = $this->dbInsertSet($wTbls,$this->tblInfo->schema,$dtaObj);
	  		$wret[1] = $this->dbGenPrep($wTbls[0],$insertSet[0],$dtaObj);
	  		$updErr = $wret[1]->errorCode;
			if ($updErr == 0)
			{
				$dtaObj["idVGB_ADDR"] = $wret[1]->result[0]["idVGB_ADDR"];
				$dtaObj["VGB_CUST_BTADD"] = $dtaObj["idVGB_ADDR"];
				$dtaObj["VGB_CUST_STADD"] = $dtaObj["idVGB_ADDR"];
				$dtaObj["VGB_SUPP_BTADD"] = $dtaObj["idVGB_ADDR"];
				$dtaObj["VGB_SUPP_STADD"] = $dtaObj["idVGB_ADDR"];
				
			}
			else
	  		{
	  			$wret[0]->dbDelRec($dtaObj);
	  		}
	  	}
	  	else
	  	{
			$wTbls[0]->dbValidConstraints($dtaObj);
			$wret[1] = $wTbls[0];	  		
	  	}

		// CUST OR SUPP;
  		$wTbls = array(); $wwT = $E_POST["SESSION"]!="VGB_CUSTCT"?"vgb_supp":"vgb_cust";
		$wTbls[0] = new dbMaster($wwT,$this->tblInfo->schema);
		if ($updErr == 0)
		{
			
	  		// $this->dbInsertSet is not clear why it exist
	  		// Must be validated. May be a method not used see stdMasterClasses
	  		
	  		$insertSet = $this->dbInsertSet($wTbls,$this->tblInfo->schema,$dtaObj);
	  		$wret[2] = $this->dbGenPrep($wTbls[0],$insertSet[0],$dtaObj);
	  		$updErr = $wret[2]->errorCode;
	  		if ($updErr != 0)
	  		{
	  			$wret[1]->dbDelRec($dtaObj);
	  			$wret[0]->dbDelRec($dtaObj);
	  		}
	  		
		}		
	  	else
	  	{
			$wTbls[0]->dbValidConstraints($dtaObj);
			$wret[2] = $wTbls[0];	  		
	  	}

		if ($updErr == 0)
		{
		
			$this->result = array();
			$this->result[0] = $wret[0]->result[0];
			$this->result[1] = $wret[1]->result[0];
			$this->result[2] = $wret[2]->result[0];
			$this->errorCode = 0;
			$this->insertId = $this->result[0]["idVGB_BPAR"];
			$this->ADDRinsertId = $this->result[1]["idVGB_ADDR"];
			$this->MAINinsertId = $this->result[2]["id" . strtoupper($wwT) ];
		}
		else
		{
			$this->errorCode = $updErr;
			$this->result = "";		
		}
		
		
		$occ = 0;
		$seq = 0;
		while ($occ < 3)
		{
			$wocc = 0;
			while ($wocc < count($wret[$occ]->invalidConstraints))
			{
				$this->invalidConstraints[$seq] = $wret[$occ]->invalidConstraints[$wocc];
				$seq  += 1;
				$wocc += 1;
			}
			$occ += 1;
		}



		$tFnc = new AB_querySession;
		$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
		$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
		$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
		
		if (!$dtaObj["VGB_BPAR_BPART"] || $dtaObj["VGB_BPAR_BPART"] =='')
		{
			if (!$this->invalidConstraints)
			{
				$this->invalidConstraints = array();
			}
			$this->invalidConstraints[count($this->invalidConstraints)]->field = "VGB_BPAR_BPART";
			$this->invalidConstraints[count($this->invalidConstraints)-1]->mess = "Err: You must supply a valid code";
			$this->invalidConstraints[count($this->invalidConstraints)-1]->table = "vgb_bpar";
			$this->invalidConstraints[count($this->invalidConstraints)-1]->constraint = "valid code error";
		}
		
		if (!$dtaObj["VGB_ADDR_ADDID"] || $dtaObj["VGB_BPAR_BPART"] =='' || $dtaObj["VGB_ADDR_ADDID"] < 1)
		{
			if (!$this->invalidConstraints)
			{
				$this->invalidConstraints = array();
			}
			$this->invalidConstraints[count($this->invalidConstraints)]->field = "VGB_ADDR_ADDID";
			$this->invalidConstraints[count($this->invalidConstraints)-1]->mess = "Err: You must supply a valid code";
			$this->invalidConstraints[count($this->invalidConstraints)-1]->table = "vgb_addr";
			$this->invalidConstraints[count($this->invalidConstraints)-1]->constraint = "valid code error";
		}
		

			
		$this->dbFnct = 'dbInsRec';
		
		// $this->result = $wret;
		
	}
	
	function dbSetTrig()
	{



$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgb_bpar WHERE [=WHERE=] [=COND:vgb_bpar=][=ORDBY=] [=LIMIT=] ) t1

			
			LEFT JOIN vgb_cust t2 ON t2.VGB_CUST_BPART = idVGB_BPAR [=COND:vgb_cust=]
			 
			LEFT JOIN vgb_supp t3 ON t3.VGB_SUPP_BPART = idVGB_BPAR [=COND:vgb_supp=]
			
			LEFT JOIN vgb_addr t4 ON t4.VGB_ADDR_BPART = idVGB_BPAR	[=COND:vgb_addr=]		
			
			 
			 	
			 
		
EOD;

		return $trig;
		
	}

}

class vgb_bpar_ext extends dbMaster
{
	function vgb_bpar_ext($schema)
	{
		$this->dbMaster("vgb_bpar",$schema);
	}


	function dbSetTrig()
	{



$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgb_bpar WHERE [=WHERE=] [=COND:vgb_bpar=][=ORDBY=] LIMIT 1 ) t1

			
			LEFT JOIN vgb_cust t2 ON t2.VGB_CUST_BPART = idVGB_BPAR [=COND:vgb_cust=]
			LEFT JOIN vgb_supp t3 ON t3.VGB_SUPP_BPART = idVGB_BPAR [=COND:vgb_supp=]
			LEFT JOIN vgb_addr t4 ON t4.VGB_ADDR_BPART = idVGB_BPAR	[=COND:vgb_addr=]		
			
			
			 	
			 
		
EOD;

		return $trig;
		
	}

}

class vgb_svia extends dbMaster
{
	function vgb_svia($schema)
	{
		$this->dbMaster("vgb_svia",$schema);
	}

	function dbInsRec($dtaObj)
	{
  		$wTbls = new dbMaster("vgb_svia",$this->tblInfo->schema);
		$wTbls->dbInsRec($dtaObj);			

		$recId = $wTbls->insertId;
		$defaultVal = $dtaObj["VGB_SVIA_DEFAULT"];
		$customerId = $dtaObj["VGB_SVIA_CUSTID"];
		
		if ($this->errorCode == 0 && $recId > 0 && $defaultVal == '1' )
		{
			$this->updateDefault_vgb_svia($recId,$customerId);
		}
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}  			
		$this->localPost = $dtaObj;			
		
	}

	function dbUpdRec($dtaObj)
	{

  		$wTbls = new dbMaster("vgb_svia",$this->tblInfo->schema);
		$wTbls->dbUpdRec($dtaObj);			

		$recId = $dtaObj["idVGB_SVIA"];
		$defaultVal = $dtaObj["VGB_SVIA_DEFAULT"];
		$customerId = $dtaObj["VGB_SVIA_CUSTID"];
		
		if ($this->errorCode == 0 && $recId > 0 && $defaultVal == '1' )
		{
			$this->updateDefault_vgb_svia($recId,$customerId);
		}
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}  	
		$this->localPost = $dtaObj;
				
	}

	function updateDefault_vgb_svia($recId,$custId)
	{

$trig = <<<EOC

UPDATE `dev_erp`.`vgb_svia`
SET
VGB_SVIA_DEFAULT = '0'
WHERE VGB_SVIA_CUSTID = {$custId} AND idVGB_SVIA <> {$recId} ;

EOC;

	$this->dbProcessTransactionPdo($trig);				
		
	}


}


class vgb_addr extends dbMaster
{
	function vgb_addr($schema)
	{
		$this->dbMaster("vgb_addr",$schema);
		// $this->AB_CPARM = $this->dbGetCparm();
	}

	function dbInsRec($dtaObj)
	{
		$this->dbFnct = 'dbInsRec';
		// Address
  		if (strpos("x". $dtaObj["VGB_BPAR_BPART"] , $this->AB_CPARM["VGB_COMPANY"]["BPART"])==1
  		&& $dtaObj["VGB_BPAR_BPART"] != trim($this->AB_CPARM["VGB_COMPANY"]["BPART"] . $this->AB_CPARM["VGB_COMPANY"]["DIV"]) )
  		{
			$this->errorCode = 8900;
			$this->errorCodeText[count($this->errorCodeText)] = "Insert failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Cannot create address for partner  ". $dtaObj["VGB_BPAR_BPART"];
			$this->rowCount  = 0;	
			$tFnc = new AB_querySession;
			$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
			return;			

  		}
  		
  		
  		// Address Chk
  		$wTbls = new dbMaster("vgb_addr",$this->tblInfo->schema);
		$wTbls->dbInsRec($dtaObj);			

		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}  		
  				
	}

	function dbDelRec($dtaObj)
	{
		// Address
		$this->dbFnct = 'dbDelRec';
  		if (strpos("x". $dtaObj["VGB_BPAR_BPART"] , $this->AB_CPARM["VGB_COMPANY"]["BPART"])==1
  		&& $dtaObj["VGB_BPAR_BPART"] != trim($this->AB_CPARM["VGB_COMPANY"]["BPART"] . $this->AB_CPARM["VGB_COMPANY"]["DIV"]) )
  		{
			$this->errorCode = 8900;
			$this->errorCodeText[count($this->errorCodeText)] = "Delete failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Cannot delete address for partner  ". $dtaObj["VGB_BPAR_BPART"];
			$this->rowCount  = 0;	
			$tFnc = new AB_querySession;
			$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
			return;			

  		}
  		
  		$wTbls = new dbMaster("vgb_addr",$this->tblInfo->schema);
		$wTbls->dbDelRec($dtaObj);			

		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}  		
				
	}

	function dbUpdRec($dtaObj)
	{
		$this->dbFnct = 'dbUpdRec';
		// Address
  		if (strpos("x". $dtaObj["VGB_BPAR_BPART"] , $this->AB_CPARM["VGB_COMPANY"]["BPART"])==1
  		&& $dtaObj["VGB_BPAR_BPART"] != trim($this->AB_CPARM["VGB_COMPANY"]["BPART"] . $this->AB_CPARM["VGB_COMPANY"]["DIV"]) )
  		{
			$this->errorCode = 8900;
			$this->errorCodeText[count($this->errorCodeText)] = "Update failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Cannot update address for partner  ". $dtaObj["VGB_BPAR_BPART"];
			$this->rowCount  = 0;	
			$tFnc = new AB_querySession;
			$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
			return;			

  		}
  		
  		// Address Chk
  		$wTbls = new dbMaster("vgb_addr",$this->tblInfo->schema);
		$wTbls->dbUpdRec($dtaObj);			

		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}  		
				
	}		
	
	function dbSetTrig()
	{



		$localWhere = "";
		// $this->E_POST = $_SESSION["lastPost"];
		
		if ($this->E_POST["vgb_bpar_list"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["vgb_bpar_list"]);
			if(count($wClause)>0)
			{
				$localWhere = " ( ";
				$orVal = "";
				$occ = 0;
				while ($occ < count($wClause))
				{
					$localWhere .= $orVal . "VGB_ADDR_BPART = '" . $wClause[$occ] . "' ";
					$orVal = " OR  ";
					$occ += 1;
				} 

				$localWhere .= " ) AND ";

			}

		}




$trig = <<<EOD
			SELECT * FROM 
			 
		 	( SELECT * FROM vgb_addr 
		 	
		LEFT JOIN vgb_bpar ON idVGB_BPAR = VGB_ADDR_BPART [=COND:vgb_bpar=]
		LEFT JOIN vtx_schh ON idVTX_SCHH = VGB_ADDR_SCHID OR idVTX_SCHH = VGB_ADDR_PCHID [=COND:vtx_schh=]
		LEFT JOIN vgb_cntr ON idVGB_CNTR = VGB_ADDR_CNTID [=COND:vgb_cntr=]
		LEFT JOIN vgb_prst ON idVGB_PRST = VGB_ADDR_PRSID [=COND:vgb_prst=]
		
		WHERE $localWhere [=WHERE=] [=COND:vgb_addr=]  [=LIMIT=] ) t1
				

		
EOD;

		return $trig;
		
	}


}	

class vgb_cust extends dbMaster
{
	
	
	function vgb_cust($schema)
	{
		$this->dbMaster("vgb_cust",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}

	function onInitNewRec($tbl,$pr)
	{
		$tmpObj = array();
		$tmpObj["idVGB_BPAR"]= $tbl["VGB_CUST_BPART"];
		$bpar = new vgb_bpar_ext($this->tblInfo->schema); 
		$bpar->dbFindMatch($tmpObj);
		if (count($bpar->result) > 0)
		{
			$tbl["VGB_CUST_BPNAM"] = $bpar->result[0]["VGB_BPAR_BPNAM"];
			$tbl["VGB_CUST_BTADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_CUST_STADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_CUST_SLSRP"] = $bpar->result[0]["idVGB_SLRP"];

		}
		else
		{
			$tbl["VGB_ADDR_ADDID"] = "10";
			$tbl["VGB_ADDR_ADNAM"] = "";
		}

		
//			foreach($bpar->result[0] as $name => $value)
//			{
//				if (!$tbl[$name]) 
//				{
//					$tbl[$name] = $bpar->result[0][$name];
//				}
//				
//			}
			
		
		
		$this->onInitNewRecX['vgb_cust'] = $tbl;

		return $tbl;
	}

	function dbInsRec($dtaObj)
	{
		$this->dbFnct = 'dbInsRec';
		// Customer
  		if (strpos("x". $dtaObj["VGB_BPAR_BPART"] , $this->AB_CPARM["VGB_COMPANY"]["BPART"])==1
  		&& $dtaObj["VGB_BPAR_BPART"] != trim($this->AB_CPARM["VGB_COMPANY"]["BPART"] . $this->AB_CPARM["VGB_COMPANY"]["DIV"]) )
  		{
			$this->errorCode = 8900;
			$this->errorCodeText[count($this->errorCodeText)] = "Insert failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Cannot Customer for partner  ". $dtaObj["VGB_BPAR_BPART"];
			$this->rowCount  = 0;	
			$tFnc = new AB_querySession;
			$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
			return;			

  		}
  		
  		$wTbls = new dbMaster("vgb_cust",$this->tblInfo->schema);
		$wTbls->dbInsRec($dtaObj);			

		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}  		
  				
	}


	function dbUpdRec($dtaObj)
	{
		$this->dbFnct = 'dbUpdRec';
		// Customer
  		if (strpos("x". $dtaObj["VGB_BPAR_BPART"] , $this->AB_CPARM["VGB_COMPANY"]["BPART"])==1
  		&& $dtaObj["VGB_BPAR_BPART"] != trim($this->AB_CPARM["VGB_COMPANY"]["BPART"] . $this->AB_CPARM["VGB_COMPANY"]["DIV"]) )
  		{
			$this->errorCode = 8900;
			$this->errorCodeText[count($this->errorCodeText)] = "Update failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Cannot update customer for partner  ". $dtaObj["VGB_BPAR_BPART"];
			$this->rowCount  = 0;	
			$tFnc = new AB_querySession;
			$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
			return;			

  		}
  		
  		$wTbls = new dbMaster("vgb_cust",$this->tblInfo->schema);
		$wTbls->dbUpdRec($dtaObj);			

		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}  		
				
	}		
	
	function dbDelRec($dtaObj)
	{
		
		// Customer
		$this->dbFnct = 'dbDelRec';
		
		$recSet = $dtaObj;
		// $recSet = setEpost($this->tblInfo->schema,$dtaObj);
		
		$idVGB_BPAR = $recSet["VGB_CUST_BPART"];


  		if (strpos("x". $dtaObj["VGB_BPAR_BPART"] , $this->AB_CPARM["VGB_COMPANY"]["BPART"])==1
  		&& $dtaObj["VGB_BPAR_BPART"] != trim($this->AB_CPARM["VGB_COMPANY"]["BPART"] . $this->AB_CPARM["VGB_COMPANY"]["DIV"]) )
  		{
			$this->errorCode = 8900;
			$this->errorCodeText[count($this->errorCodeText)] = "Delete failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Cannot delete  customer for partner  ". $dtaObj["VGB_BPAR_BPART"];
			$this->rowCount  = 0;	
			$tFnc = new AB_querySession;
			$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
			return;			

  		}
		
		$customer = new dbMaster("vgb_cust",$this->tblInfo->schema);
		$customer->dbDelRec($dtaObj);
		$this->errorCode = $customer->errorCode;
		
		$this->customer = $customer;
		$this->currentPartner = $idVGB_BPAR;
		// Check if partner is supplier
		
		$partner = new vgb_bpar($this->tblInfo->schema);
		$objChk = array();
		$objChk["PROCESS"] = $recSet["PROCESS"];
		$objChk["SESSION"] = $recSet["SESSION"];
		$objChk["TBLNAME"] = $recSet["TBLNAME"];			
		
		$objChk['idVGB_BPAR'] = $idVGB_BPAR;
		$partner->dbChkMatch($objChk);
		if ($partner->fetchResult[0]['idVGB_CUST'] == null && $partner->fetchResult[0]['idVGB_SUPP'] == null )
		{
			$addresses = array();
			$addr = new dbMaster("vgb_addr",$this->tblInfo->schema); //new vgb_addr($this->tblInfo->schema);

			$occ = 0;
			while ($occ < count($partner->fetchResult))
			{
				if ($partner->fetchResult[$occ]['idVGB_ADDR'] != null)
				{
					$objChk['idVGB_ADDR'] = $partner->fetchResult[$occ]['idVGB_ADDR'];
					$objChk['VGB_ADDR_BPART'] = $idVGB_BPAR;
					$addr->dbDelRec($objChk);
					$this->delrecs = $objChk['idVGB_ADDR'];
					$addresses[count($addresses)] = $addr;
				}
				$occ += 1;
				
			}
			
			$partner->dbDelRec($objChk);
			$this->addresses = $addresses;

		};

		$this->partner = $partner;
		
		
		
		// Will only be allowed if last address was deleted (no constraints
		// $partner = $this->dbMaster("vgb_bpar",$this->tblInfo->schema);
		// $partner->dbDelRec($dtaObj);
	
	}	
				

	function dbSetTrig()
	{


		if (($this->sessionId && $this->sessionId == "VGB_PARTNERS") ||( $this->E_POST["VGB_PARTNERS_DRILL"] > "" ))
		{
			
			$inTrig = "";
//			if ($this->E_POST["VGB_PARTNERS_DRILL"] > "0" )
//			{
				$inTrig .= " LEFT JOIN vsl_orhe ON VSL_ORHE_BTCUS = idVGB_CUST [=COND:vsl_orhe=] ";
				$inTrig .= " LEFT JOIN vsl_orde ON VSL_ORDE_ORNUM = idVSL_ORHE  [=COND:vsl_orde=] ";
				$inTrig .= " LEFT JOIN vin_item ON VSL_ORDE_ITMID = idVIN_ITEM  [=COND:vin_item=] ";
				$inTrig .= " LEFT JOIN vsl_orst ON VSL_ORST_ORLIN = idVSL_ORDE  [=COND:vsl_orst=] ";
//			}
			
			
$trig = <<<EOD

			SELECT * FROM
			 
		 	( SELECT * FROM vgb_cust 

		
		LEFT JOIN vgb_bpar ON idVGB_BPAR = VGB_CUST_BPART [=COND:vgb_bpar=]
		LEFT JOIN vgb_addr ON VGB_ADDR_BPART = VGB_CUST_BPART [=COND:vgb_addr=]
		LEFT JOIN vgb_prst ON idVGB_PRST = VGB_ADDR_PRSID [=COND:vgb_prst=]
		LEFT JOIN vgb_cntr ON idVGB_CNTR = VGB_ADDR_CNTID [=COND:vgb_cntr=]
		LEFT JOIN vgb_ctyp ON idVGB_CTYP = VGB_CUST_CUTYP [=COND:vgb_ctyp=]
		LEFT JOIN vgb_curr ON idVGB_CURR = VGB_CUST_CURID [=COND:vgb_curr=]
		LEFT JOIN vgb_mark ON idVGB_MARK = VGB_CUST_MRKID [=COND:vgb_mark=]
		LEFT JOIN vgb_slrp ON idVGB_SLRP = VGB_CUST_SLSRP [=COND:vgb_slrp=]
		LEFT JOIN vgb_term ON idVGB_TERM = VGB_CUST_TERID [=COND:vgb_term=]
		
EOD;

$trig .= $inTrig;


$trig .= <<<EOD

								
		WHERE [=WHERE=]  [=COND:vgb_cust=] ORDER BY VGB_BPAR_BPART ASC [=LIMIT=] ) tx		

		
EOD;
		
		}
		else
		{
			
		
$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgb_cust 

		
		LEFT JOIN vgb_bpar ON idVGB_BPAR = VGB_CUST_BPART [=COND:vgb_bpar=]
		
		LEFT JOIN vgb_ctyp ON idVGB_CTYP = VGB_CUST_CUTYP [=COND:vgb_ctyp=]
		LEFT JOIN vgb_curr ON idVGB_CURR = VGB_CUST_CURID [=COND:vgb_curr=]
		LEFT JOIN vgb_mark ON idVGB_MARK = VGB_CUST_MRKID [=COND:vgb_mark=]
		LEFT JOIN vgb_slrp ON idVGB_SLRP = VGB_CUST_SLSRP [=COND:vgb_slrp=]
		LEFT JOIN vgb_term ON idVGB_TERM = VGB_CUST_TERID [=COND:vgb_term=]
		LEFT JOIN vgb_bank ON idVGB_bank = VGB_CUST_BPBNK [=COND:vgb_bank=]
								
		WHERE [=WHERE=]  [=COND:vgb_cust=]  [=LIMIT=] ) tx		

		
EOD;

		}
	
		return $trig;
		
		
		
	}

}	

class vgb_supp extends dbMaster
{
	function vgb_supp($schema)
	{
		$this->dbMaster("vgb_supp",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}

	function onInitNewRec($tbl,$pr)
	{
		$tmpObj = array();
		$tmpObj["idVGB_BPAR"]= $tbl["VGB_SUPP_BPART"];
		$bpar = new vgb_bpar_ext($this->tblInfo->schema); 
		$bpar->dbFindMatch($tmpObj);
		if (count($bpar->result) > 0)
		{
			$tbl["VGB_SUPP_BPNAM"] = $bpar->result[0]["VGB_BPAR_BPNAM"];
			$tbl["VGB_SUPP_BTADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_SUPP_STADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_SUPP_SLSRP"] = $bpar->result[0]["idVGB_SLRP"];

		}
		else
		{
			$tbl["VGB_ADDR_ADDID"] = "10";
			$tbl["VGB_ADDR_ADNAM"] = "";
		}

//		foreach($bpar->result[0] as $name => $value)
//		{
//			if (!$tbl[$name]) 
//			{
//				$tbl[$name] = $bpar->result[0][$name];
//			}
//			
//		}
//			
		
		
		$this->onInitNewRecX['vgb_supp'] = $tbl;

		return $tbl;
	}
	
	function dbInsRec($dtaObj)
	{
		$this->dbFnct = 'dbInsRec';
		// Supplier
  		if (strpos("x". $dtaObj["VGB_BPAR_BPART"] , $this->AB_CPARM["VGB_COMPANY"]["BPART"])==1
  		&& $dtaObj["VGB_BPAR_BPART"] != trim($this->AB_CPARM["VGB_COMPANY"]["BPART"] . $this->AB_CPARM["VGB_COMPANY"]["DIV"]) )
  		{
			$this->errorCode = 8900;
			$this->errorCodeText[count($this->errorCodeText)] = "Insert failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Cannot create Supplier for partner  ". $dtaObj["VGB_BPAR_BPART"];
			$this->rowCount  = 0;	
			$tFnc = new AB_querySession;
			$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
			return;			

  		}
  		
  		$wTbls = new dbMaster("vgb_supp",$this->tblInfo->schema);
		$wTbls->dbInsRec($dtaObj);			

		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}  		
  				
	}


	function dbUpdRec($dtaObj)
	{
		$this->dbFnct = 'dbUpdRec';
		// Supplier
  		if (strpos("x". $dtaObj["VGB_BPAR_BPART"] , $this->AB_CPARM["VGB_COMPANY"]["BPART"])==1
  		&& $dtaObj["VGB_BPAR_BPART"] != trim($this->AB_CPARM["VGB_COMPANY"]["BPART"] . $this->AB_CPARM["VGB_COMPANY"]["DIV"]) )
  		{
			$this->errorCode = 8900;
			$this->errorCodeText[count($this->errorCodeText)] = "Update failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Cannot update supplier for partner  ". $dtaObj["VGB_BPAR_BPART"];
			$this->rowCount  = 0;	
			$tFnc = new AB_querySession;
			$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
			return;			

  		}
  		
  		$wTbls = new dbMaster("vgb_supp",$this->tblInfo->schema);
		$wTbls->dbUpdRec($dtaObj);			

		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}  		
				
	}		
		
	function dbDelRec($dtaObj)
	{
		// Supplier
		$this->dbFnct = 'dbDelRec';
		$this->dbFnctPlus = "Made to measure";
		
		$recSet = $dtaObj;
		// $recSet = setEpost($this->tblInfo->schema,$dtaObj);
		
		$idVGB_BPAR = $recSet["VGB_SUPP_BPART"];

  		if (strpos("x". $dtaObj["VGB_BPAR_BPART"] , $this->AB_CPARM["VGB_COMPANY"]["BPART"])==1
  		&& $dtaObj["VGB_BPAR_BPART"] != trim($this->AB_CPARM["VGB_COMPANY"]["BPART"] . $this->AB_CPARM["VGB_COMPANY"]["DIV"]) )
  		{
			$this->errorCode = 8900;
			$this->errorCodeText[count($this->errorCodeText)] = "Delete failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Cannot delete supplier for partner  ". $dtaObj["VGB_BPAR_BPART"];
			$this->rowCount  = 0;	
			$tFnc = new AB_querySession;
			$this->canCreate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"New");		
			$this->canUpdate = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Upd");
			$this->canDelete = $tFnc->hasPriviledge($dtaObj,$this->tblInfo->tblName,"Del");
			return;			

  		}
  				
		$supplier = new dbMaster("vgb_supp",$this->tblInfo->schema);
		$supplier->dbDelRec($dtaObj);

		$this->supplier = $supplier;
		$this->currentPartner = $idVGB_BPAR;
		
		$this->errorCode = $supplier->errorCode;
		if ($this->errorCode > 0)
		{
			return;
		}
		
		// Step 2 Check if Customer
//		$partner = new dbMaster("vgb_cust",$this->tblInfo->schema);
//		
//		$objChk = array();
//		$objChk['VGB_CUST_BPART'] = $idVGB_BPAR;
//		$partner->dbChkMatch($objChk);
//		
//		$this->partner = $partner;
//		if ($partner->erroCode > 0)
//		{
//			$addr = new dbMaster("vgb_addr",$this->tblInfo->schema);
//			$objChk = array();
//			$objChk['VGB_ADDR_BPART'] = $idVGB_BPAR;
//			$addr->dbDelRec($objChk);
//			
//			$bproot = new dbMaster("vgb_bpar",$this->tblInfo->schema);
//			$objChk = array();
//			$objChk['idVGB_BPAR'] = $idVGB_BPAR;
//			$bproot->dbDelRec($objChk);
//		}
//


		// Check if partner is supplier
		$partner = new vgb_bpar($this->tblInfo->schema);
		$objChk = array();
		$objChk["PROCESS"] = $recSet["PROCESS"];
		$objChk["SESSION"] = $recSet["SESSION"];
		$objChk["TBLNAME"] = $recSet["TBLNAME"];			
		
		$objChk['idVGB_BPAR'] = $idVGB_BPAR;
		$partner->dbChkMatch($objChk);

		$this->partner = $partner;


		if ($partner->fetchResult[0]['idVGB_CUST'] == null && $partner->fetchResult[0]['idVGB_SUPP'] == null )
		{
			$addresses = array();
			$addr = new dbMaster("vgb_addr",$this->tblInfo->schema); //new vgb_addr($this->tblInfo->schema);

			$occ = 0;
			while ($occ < count($partner->fetchResult))
			{
				if ($partner->fetchResult[$occ]['idVGB_ADDR'] != null)
				{
					$objChk['idVGB_ADDR'] = $partner->fetchResult[$occ]['idVGB_ADDR'];
					$objChk['VGB_ADDR_BPART'] = $idVGB_BPAR;
					$addr->dbDelRec($objChk);
					$this->delrecs = $objChk['idVGB_ADDR'];
					$addresses[count($addresses)] = $addr;
				}
				$occ += 1;
				
			}
			
			$partner->dbDelRec($objChk);
			$this->addresses = $addresses;

		};

		
		
		
		
		// Will only be allowed if last address was deleted (no constraints
		// $partner = $this->dbMaster("vgb_bpar",$this->tblInfo->schema);
		// $partner->dbDelRec($dtaObj);
	
	}	


	function dbSetTrig()
	{

		$inTrig = "";

		if (($this->sessionId && $this->sessionId == "VGB_PARTNERS") ||( $this->E_POST["VGB_PARTNERS_DRILL"] > "" ))
		{
			
			$inTrig = "";
//			if ($this->E_POST["VGB_PARTNERS_DRILL"] > "0" )
//			{
				$inTrig .= " LEFT JOIN vpu_orhe ON VPU_ORHE_BTCUS = idVGB_SUPP [=COND:vpu_orhe=] ";
				$inTrig .= " LEFT JOIN vpu_orde ON VPU_ORDE_ORNUM = idVPU_ORHE  [=COND:vpu_orde=] ";
				$inTrig .= " LEFT JOIN vin_item ON VPU_ORDE_ITMID = idVIN_ITEM  [=COND:vin_item=] ";
				$inTrig .= " LEFT JOIN vpu_orst ON VPU_ORST_ORLIN = idVPU_ORDE  [=COND:vpu_orst=] ";
//			}
		}

		


$trig = <<<EOD
			SELECT * FROM 
			 
		 	( SELECT * FROM vgb_supp 
		 	
		LEFT JOIN vgb_bpar ON VGB_SUPP_BPART = idVGB_BPAR  [=COND:vgb_bpar=]
		LEFT JOIN vgb_addr ON VGB_ADDR_BPART = VGB_SUPP_BPART [=COND:vgb_addr=]
		LEFT JOIN vgb_curr ON idVGB_CURR = VGB_SUPP_CURID [=COND:vgb_curr=]
		LEFT JOIN vgb_term ON idVGB_TERM = VGB_SUPP_TERID [=COND:vgb_term=]
		
		{$inTrig}
		 
		WHERE [=WHERE=] AND idVGB_SUPP [=COND:vgb_supp=] [=LIMIT=] ) tx		

		
EOD;



//		$trig = <<<EOD
//					SELECT * FROM 
//					 
//				 	( SELECT * FROM vgb_bpar 
//				 	
//				LEFT JOIN vgb_supp t1 ON VGB_SUPP_BPART = idVGB_BPAR  [=COND:vgb_supp=]
//				LEFT JOIN vgb_addr t2 ON t2.VGB_ADDR_BPART = t1.VGB_SUPP_BPART [=COND:vgb_addr=]
//				LEFT JOIN vgb_curr ON idVGB_CURR = t1.VGB_SUPP_CURID [=COND:vgb_curr=]
//				LEFT JOIN vgb_term ON idVGB_TERM = t1.VGB_SUPP_TERID [=COND:vgb_term=]
//				
//				WHERE [=WHERE=] AND idVGB_SUPP [=COND:vgb_bpar=] [=LIMIT=] ) tx		
//		
//				
//		EOD;






		return $trig;
		
	}

}	

?>