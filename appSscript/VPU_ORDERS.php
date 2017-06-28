<?php

class vpu_orheFindMatch extends dbMaster
{
	function vpu_orheFindMatch($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
	}

	function dbSetTrig()
	{





$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vpu_orhe 
		LEFT JOIN vgb_supp  ON idVGB_SUPP = VPU_ORHE_BTCUS  [=COND:vgb_supp=]
		LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_SUPP_BPART  [=COND:vgb_bpar=]

		LEFT JOIN vgb_addr  ON idVGB_ADDR = VPU_ORHE_BTADD OR VGB_ADDR_BPART = idVGB_BPAR  [=COND:vgb_addr=] 
		LEFT JOIN vgb_curr  ON idVGB_CURR = VPU_ORHE_CURID  [=COND:vgb_curr=] 
		LEFT JOIN vgb_slrp  ON idVGB_SLRP = VPU_ORHE_SLSRP  [=COND:vgb_slrp=] 
		LEFT JOIN vgb_term  ON idVGB_TERM = VPU_ORHE_TERID  [=COND:vgb_term=] 
		LEFT JOIN vpu_orde  ON idVPU_ORHE = VPU_ORDE_ORNUM  [=COND:vpu_orde=] 
		LEFT JOIN vpu_orst  ON idVPU_ORDE = VPU_ORST_ORLIN  [=COND:vpu_orst=]
		
		
		LEFT JOIN vpu_orsi  ON idVPU_ORHE = VPU_ORSI_ORNUM  AND ( VPU_ORST_ACKID = idVPU_ORSI OR VPU_ORST_AOKID = idVPU_ORSI OR VPU_ORST_SCEID = idVPU_ORSI OR VPU_ORST_PICID = idVPU_ORSI OR VPU_ORST_RELID = idVPU_ORSI OR VPU_ORST_PAKID = idVPU_ORSI OR VPU_ORST_DELID = idVPU_ORSI ) [=COND:vpu_orsi=]
		LEFT JOIN vpu_lstr  ON idVPU_ORST = VPU_LSTR_STPSQ  [=COND:vpu_lstr=]
		LEFT JOIN vin_item  on idVIN_ITEM = VPU_ORDE_ITMID  [=COND:vin_item=]
		LEFT JOIN vin_itmwar  ON VIN_ITMWAR_ITMID = VPU_ORDE_ITMID && VIN_ITMWAR_WARID = VPU_ORDE_WARID [=COND:vin_itmwar=]
								
		WHERE [=WHERE=]  [=COND:vpu_orhe=]  ORDER BY VPU_ORHE_ORNUM ASC, VPU_ORDE_ORLIN ASC, VPU_ORST_STPSQ ASC [=LIMIT=] ) tx		

		
EOD;

		return $trig;
		
	}
	
}



class vpu_orheOriginalVal extends dbMaster
{
	function vpu_orheOriginalVal($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
	}

	


	function dbSetTrig()
	{

$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vpu_orhe 
		LEFT JOIN vpu_orde  ON idVPU_ORHE = VPU_ORDE_ORNUM  [=COND:vpu_orde=] 
		LEFT JOIN vpu_orst  ON idVPU_ORDE = VPU_ORST_ORLIN  [=COND:vpu_orst=]
		LEFT JOIN vpu_lstr  ON idVPU_ORST = VPU_LSTR_STPSQ  [=COND:vpu_lstr=]
								
		WHERE [=WHERE=]  [=COND:vpu_orhe=]  ORDER BY VPU_ORHE_ORNUM ASC, VPU_ORDE_ORLIN ASC, VPU_ORST_STPSQ ASC [=LIMIT=] ) tx		

		
EOD;


		return $trig;
		
	}
	
}

class vpu_orheLstr extends dbMaster
{
	function vpu_orheLstr($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
	}

	function dbSetTrig()
	{

$this->gotTrigger="yes";

$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vpu_orhe 

		LEFT JOIN vpu_orst  ON VPU_ORST_ORNUM = idVPU_ORHE  [=COND:vpu_orst=] 
		LEFT JOIN vpu_lstr  ON VPU_LSTR_STPSQ = idVPU_ORST  [=COND:vpu_lstr=] 
								
		WHERE [=WHERE=] [=COND:vpu_orhe=]   [=LIMIT=] ) tx		

		
EOD;

		return $trig;
		
	}
	
}


class vpu_orheOrsi extends dbMaster
{
	function vpu_orheOrsi($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
	}

	function dbSetTrig()
	{



$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vpu_orhe 

		LEFT JOIN vpu_orsi  ON VPU_ORSI_ORNUM = idVPU_ORHE  [=COND:vpu_orsi=] 
								
		WHERE [=WHERE=] [=COND:vpu_orhe=]  ORDER BY VPU_ORSI_STEPS DESC  [=LIMIT=] ) tx		

		
EOD;

		return $trig;
		
	}
	
}





class vpu_orheTax extends dbMaster
{
	function vpu_orheTax($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
	}

	function dbSetTrig()
	{

	// MOD 20170117
	// It has been determined that the tax scheme in purchasing should use the BILL TO Address
	// It is assumed that delivery will be in local area of ORG DIM
	// OLD: LEFT JOIN vgb_addr  ON idVGB_ADDR = VPU_ORHE_STADD  [=COND:vgb_addr=] 
	// NEW: LEFT JOIN vgb_addr  ON idVGB_ADDR = VPU_ORHE_BTADD  [=COND:vgb_addr=] 

$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vpu_orhe 
		LEFT JOIN vgb_addr  ON idVGB_ADDR = VPU_ORHE_BTADD  [=COND:vgb_addr=] 
		LEFT JOIN vtx_schh  ON idVTX_SCHH = VGB_ADDR_SCHID  [=COND:vtx_schh=] 
		LEFT JOIN vtx_sche  ON VTX_SCHE_SCHID = idVTX_SCHH  [=COND:vtx_sche=] 
								
		WHERE [=WHERE=]  [=COND:vpu_orhe=]  [=LIMIT=] ) tx		

		
EOD;

		return $trig;
		
	}
	
}



class vpu_ItmSupport extends dbMaster
{
	
	function vpu_ItmSupport($schema)
	{
		// Not used
		$this->dbMaster("vin_item",$schema);
		
	}
	

	function dbSetTrig()
	{

		$localWhere = "";
		$this->E_POST = $_SESSION["lastPost"];
		if ($this->E_POST["vin_item_specs"])
		{
			$ePost["itemList"] = $this->E_POST["vin_item_specs"];
		}
		else
		{
			if ($this->E_POST["vin_item_lots"])
			{
				$ePost["itemList"] = $this->E_POST["vin_item_lots"];
			}
		}
			
				
		if ($ePost["itemList"])
		{
			$localWhere = "";
			$wClause = explode(",",$ePost["itemList"]);
			if(count($wClause)>0)
			{
				$localWhere = " ( ";
				$orVal = "";
				$occ = 0;
				while ($occ < count($wClause))
				{
					$localWhere .= $orVal . "idVIN_ITEM = '" . $wClause[$occ] . "' ";
					$orVal = " OR  ";
					$occ += 1;
				} 

				$localWhere .= " ) AND ";

			}

		}
		
		$this->localWhere = $localWhere;
		if (!$this->dbSuppTbl)
		{
			$this->dbSuppTbl = array();
		}
		
		$pObj = $_SESSION["lastPost"];
		if ($ePost["itemList"])
		{
			$pObj["vin_item_lots"] = $ePost["itemList"];
			$pObj["vin_item_specs"] = $ePost["itemList"];
		}

		$wTbls = new vin_item_lots($this->tblInfo->schema);
		$wTbls->dbFindFrom($pObj);
		$this->dbSuppTbl["vin_item_vin_lshe"] = $wTbls;

		$wTbls = new vin_item_specs($this->tblInfo->schema);
		$wTbls->dbFindFrom($pObj);
		$this->dbSuppTbl["vin_item_vin_ssma"] = $wTbls;
		


$trig = <<<EOD
			SELECT  * FROM   
			 
		 	( SELECT  * FROM vin_item  
		 	
		LEFT JOIN vin_unit  ON idVIN_UNIT = VIN_ITEM_UNITM  [=COND:vin_unit=]
								
		WHERE $localWhere [=WHERE=]  [=COND:vin_item=]  [=LIMIT=] ) tx	  
		
EOD;
		
	}




}


class vpu_receipt extends dbMaster
{

	function vpu_receipt($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
		
	}


	function dbSetTrig()
	{

		$localWhere = " AND VPU_ORST_STEPS = 'II_DELI' ";

$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vpu_orhe  

		LEFT JOIN vgb_supp  ON idVGB_SUPP = VPU_ORHE_BTCUS  [=COND:vgb_supp=]
		LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_SUPP_BPART  [=COND:vgb_bpar=]
		
		LEFT JOIN vpu_orde  ON idVPU_ORHE = VPU_ORDE_ORNUM  [=COND:vpu_orde=] 
		LEFT JOIN vpu_orst  ON idVPU_ORDE = VPU_ORST_ORLIN  [=COND:vpu_orst=]
		LEFT JOIN vpu_orsi  ON idVPU_ORSI = VPU_ORST_PAKID  [=COND:vpu_orsi=]
		LEFT JOIN vpu_lstr  ON idVPU_ORST = VPU_LSTR_STPSQ  [=COND:vpu_lstr=]
		LEFT JOIN vin_item  ON idVIN_ITEM = VPU_ORDE_ITMID  [=COND:vin_item=]
	
								
		WHERE [=WHERE=] {$localWhere} [=COND:vpu_orhe=]   )  tx		

		
EOD;


		return $trig;	
	}		



}



class vpu_userVariance extends dbMaster
{

	function vpu_userVariance($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
		
	}


	function dbSetTrig()
	{

		$localWhere = " AND VPU_ORST_STEPS < 'II_DELI' ";

$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vpu_orhe  

		LEFT JOIN vgb_supp  ON idVGB_SUPP = VPU_ORHE_BTCUS  [=COND:vgb_supp=]
		LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_SUPP_BPART  [=COND:vgb_bpar=]

		LEFT JOIN vgb_addr  ON idVGB_ADDR = VPU_ORHE_BTADD OR VGB_ADDR_BPART = idVGB_BPAR  [=COND:vgb_addr=] 
		LEFT JOIN vgb_curr  ON idVGB_CURR = VPU_ORHE_CURID  [=COND:vgb_curr=] 
		LEFT JOIN vgb_slrp  ON idVGB_SLRP = VPU_ORHE_SLSRP  [=COND:vgb_slrp=] 
		LEFT JOIN vgb_term  ON idVGB_TERM = VPU_ORHE_TERID  [=COND:vgb_term=] 
		
		LEFT JOIN vpu_orde  ON idVPU_ORHE = VPU_ORDE_ORNUM  [=COND:vpu_orde=] 
		LEFT JOIN vpu_orst  ON idVPU_ORDE = VPU_ORST_ORLIN  [=COND:vpu_orst=]
		LEFT JOIN vin_item  ON idVIN_ITEM = VPU_ORDE_ITMID  [=COND:vin_item=]
	
								
		WHERE [=WHERE=] {$localWhere} [=COND:vpu_orhe=]   )  tx		

		
EOD;


		return $trig;	
	}		
	
}




class cfg_users extends dbMaster
{
	function cfg_users($schema)
	{
		$this->dbMaster("cfg_users",$schema);
		
	}

	

	


	function dbSetTrig()
	{
		
		if (!$this->dbSuppTbl)
		{
			$this->dbSuppTbl = array();
		}
		$pObj = $_SESSION["lastPost"];


		$pObj["CFG_PROCESS_CODE"] = $pObj["PROCESS"];
		$wTbls = new dbMaster("cfg_process",$this->tblInfo->schema);
		$wTbls->dbFindMatch($pObj);
		$this->dbSuppTbl["vpu_users_process"] = $wTbls;
		$proc = $wTbls->result[0]["CFG_PROCESS_ID"];

		$pObj["CFG_SESSION_CODE"] = $pObj["SESSION"];
		$wTbls = new dbMaster("cfg_session",$this->tblInfo->schema);
		$wTbls->dbFindMatch($pObj);
		$this->dbSuppTbl["vpu_users_session"] = $wTbls;
		$sess = $wTbls->result[0]["CFG_SESSION_ID"];
		
		$pObj["CFG_GRPCONFIG_PROCESS"] = $proc;
		$pObj["CFG_GRPCONFIG_SESSION"] = $sess;
		$wTbls = new dbMaster("cfg_grpconfig",$this->tblInfo->schema);
		$wTbls->dbFindMatch($pObj);
		$this->dbSuppTbl["vpu_users_config"] = $wTbls;
		
		$tFnc = new AB_querySession;
		$this->currentAffect = $tFnc->getCurrentAffect();
		
		$groupList = ",";
		$occ = 0;
		while ($occ < count($wTbls->result))
		{
			// Check if minimun right to Create
			if (strpos(strtoupper($wTbls->result[$occ]["CFG_GRPCONFIG_PRIVILEDGE"]),"NEW"))
			{
				if (strpos("x" . $groupList.",",",".$wTbls->result[$occ]["CFG_GRPCONFIG_GROUP"].",")<1)
				{
					$groupList .= $wTbls->result[$occ]["CFG_GRPCONFIG_GROUP"] . "," ;
				}
			}
			
			$occ +=1;
		}
		
		$this->groupList = $groupList;
		
		$groupArr = explode(",",$groupList);
		$groupResults = array();
		$localWhere = "" ;
		$or = "";
		
		$occ = 0;
		while ($occ < count($groupArr))
		{		
			if ($groupArr[$occ] > 0)
			{
				$pObj["CFG_GRPUSRLEVEL_LEVEL"] = $this->currentAffect["levelId"];
				$pObj["CFG_GRPUSRLEVEL_GROUP"] = $groupArr[$occ];
				$localWhere .= $or . " ( CFG_USERS_DFTLEVEL='" . $this->currentAffect["levelId"] . "' AND  CFG_USERS_DFTGROUP='" . $groupArr[$occ] . "' ) ";
				$or = " OR ";

				$wTbls = new dbMaster("cfg_grpusrlevel",$this->tblInfo->schema);
				$wTbls->dbFindMatch($pObj);
				$wocc = 0;
				while ($wocc < count($wTbls->result))
				{
					$localWhere .= $or . "CFG_USERS_ID='". $wTbls->result[$wocc]["CFG_GRPUSRLEVEL_USER"] . "' ";
					$groupResults[count($groupResults)] = $wTbls->result[$wocc];
					$wocc += 1;
				}
			}
			$occ += 1;
		}
		
		
		$localWhere .= "  ";
		$this->localWhere = $localWhere;
		
		$wTbls->result = $groupResults;
		$this->dbSuppTbl["vpu_users_group"] = $wTbls;
		
		
		$occ = 0;
		
		

$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM cfg_users  
		
								
		WHERE [=WHERE=]  AND {$localWhere}  [=COND:cfg_users=] ORDER BY CFG_USERS_DESIGNATION ASC  [=LIMIT=] )  tx		

		
EOD;


		return $trig;		
		
	}
	
	
}


class vpu_orhe extends dbMaster
{
	function vpu_orhe($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}


	function dbSetTrig()
	{


		$orderCondition = "";
		if ($this->E_POST["vpu_orheHasStepsCurrent"] == "1")
		{
			$orderCondition = " ( ( VPU_ORST_STEPS < 'JJ_X' ) OR idVPU_ORDE IS NULL ) AND ";
		}




$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vpu_orhe  
		LEFT JOIN vgb_supp  ON idVGB_SUPP = VPU_ORHE_BTCUS  [=COND:vgb_supp=]
		LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_SUPP_BPART  [=COND:vgb_bpar=]
		LEFT JOIN vgb_addr  ON idVGB_ADDR = VPU_ORHE_BTADD OR VGB_ADDR_BPART = idVGB_BPAR  [=COND:vgb_addr=] 
		LEFT JOIN vgb_curr  ON idVGB_CURR = VPU_ORHE_CURID  [=COND:vgb_curr=] 
		LEFT JOIN vgb_slrp  ON idVGB_SLRP = VPU_ORHE_SLSRP  [=COND:vgb_slrp=] 
		LEFT JOIN vgb_term  ON idVGB_TERM = VPU_ORHE_TERID  [=COND:vgb_term=] 
		LEFT JOIN vpu_orde  ON idVPU_ORHE = VPU_ORDE_ORNUM  [=COND:vpu_orde=] 
		LEFT JOIN vpu_orst  ON idVPU_ORDE = VPU_ORST_ORLIN  [=COND:vpu_orst=]
		
		LEFT JOIN vin_item  ON idVIN_ITEM = VPU_ORDE_ITMID  [=COND:vin_item=]
		
		
		
								
		WHERE  {$orderCondition}  [=WHERE=]  [=COND:vpu_orhe=] ORDER BY VPU_ORHE_CDATE DESC, VPU_ORDE_ORLIN ASC, VPU_ORST_STPSQ ASC   [=LIMIT=] )  tx		

		
EOD;


		return $trig;
		
	}

	
	function dbFindMatch($dtaObj)
	{
  		
  		
  		
  		$wTbls = new vpu_orheFindMatch($this->tblInfo->schema);
		$wTbls->dbFindMatch($dtaObj);
		
		$E_POST = $dtaObj;
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		if ($wTbls->errorCode == 0 && $E_POST["PROCESS"] == "VPU_ORDERS" && $E_POST["SESSION"] == "VPU_ORHECT")
		{
			if(count($wTbls->result) > 0)
			{
				
				$occ = 0;
				while ($occ < 10)
				{
					$newRec = $wTbls->result[0];
					$newRec["idVPU_ORDE"] = 0;
					$newRec["VPU_ORDE_ORLIN"] = ($occ+1) * -1;
					$newRec["idVPU_ORST"] = ($occ+1) * -1;
					$newRec["VPU_ORST_ORLIN"] = 0;
					$newRec["VPU_ORST_STPSQ"] = 10;
					$wTbls->result[count($wTbls->result)] = $newRec;
					$occ += 1;
				}
			}
		}
		
		// Set order Step status
		$wTbls->dbFnct = 'localdbFindMatch';
		$wTbls->dbEVAL= $this->IV_VPU_STEP_EVAL($wTbls->result[0]["VPU_ORHE_ORSTP"],$wTbls->result);

		$occ = 0;
		while ($occ < count($wTbls->result))
		{
			$wTbls->result[$occ]["IV_VPU_STEPS_VALID"] = $wTbls->dbEVAL[0]["OrderStatus"]["IV_VPU_STEPS_VALID"] ;
			
			$occ += 1;
		}
		
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
	

		
	}	
	
	function groupObjById()
	{

		$occ = 0;
		while ($occ < count($this->orstOrg) )
		{
			if(!$this->OriginalData["vpu_orhe"][$this->orstOrg[$occ]["idVPU_ORHE"]] )
			{
				$this->OriginalData["vpu_orhe"][$this->orstOrg[$occ]["idVPU_ORHE"]] = $this->extractTableField("VPU_ORHE",$this->orstOrg[$occ]);
			}
			
			if(!$this->OriginalData["vpu_orde"][$this->orstOrg[$occ]["idVPU_ORDE"]])
			{
				$this->OriginalData["vpu_orde"][$this->orstOrg[$occ]["idVPU_ORDE"]] = $this->extractTableField("VPU_ORDE",$this->orstOrg[$occ]);
			}
			
			if(!$this->OriginalData["vpu_orst"][$this->orstOrg[$occ]["idVPU_ORST"]])
			{
				$this->OriginalData["vpu_orst"][$this->orstOrg[$occ]["idVPU_ORST"]] = $this->extractTableField("VPU_ORST",$this->orstOrg[$occ]);
			}
			
			if($this->orstOrg[$occ]["idVPU_LSTR"]  && !$this->OriginalData["vpu_lstr"][$this->orstOrg[$occ]["idVPU_ORST"]."-".$this->orstOrg[$occ]["idVPU_LSTR"]])
			{
				$this->OriginalData["vpu_lstr"][$this->orstOrg[$occ]["idVPU_ORST"]."-".$this->orstOrg[$occ]["idVPU_LSTR"]] = $this->extractTableField("VPU_LSTR",$this->orstOrg[$occ]);
			}			
			
			$occ += 1;
		}		
		$this->setLastStepSequence();
	}
	
	
	function setLastStepSequence()
	{
		if (!$this->OriginalData["vpu_orst"])
		{
			return;
		}	
		
		$rec = $this->OriginalData["vpu_orst"];
		
		foreach($rec as $name => $value)
		{
			if ($value["VPU_ORST_STPSQ"] > $this->OriginalData["vpu_orde"][$value["VPU_ORST_ORLIN"]]["nextStepSequence"])
			{
				$this->OriginalData["vpu_orde"][$value["VPU_ORST_ORLIN"]]["nextStepSequence"] = $value["VPU_ORST_STPSQ"];
			}
		}		
		
	}
	
	function extractTableField($fMatch,$rec)
	{
		$newobj = array();
		
		foreach($rec as $name => $value)
		{
			if (strpos(" " . $name , $fMatch) > 0 )
			{
				$newObj[$name] = $value;
			}
		}
		if ($fMatch == "VPU_ORDE")
		{
			$newObj["nextStepSequence"] = 0;
		}
		
		return $newObj;
	}
	
	

	function objAreEqual($objB,$fMatch,$keyName)
	{
		$result = true;
		
		$this->validChangeFields = array(); 
		// This will be used to know what fields were changed. 
		// Specificly VPU_ORDE_ORDQT because modification of this field will be allowed for Completed lines.
				
		if(!$this->OriginalData[$fMatch][$objB[$keyName]])
		{ 
			$this->validChange .= "(" . $fMatch ."='".$keyName."'".$objB[$keyName] . "--". $this->OriginalData[$fMatch][$objB[$keyName]] . ")";
			return false;
		}
		
		$orgRec = $this->OriginalData[$fMatch][$objB[$keyName]];
		foreach($orgRec as $name => $value)
		{
			if (strlen($objB[$name]) > 0 && $objB[$name] != $value)
			{
				$result = false;
				$this->validChange .= "(" . $name ."='".$value."')";
				$this->validChangeFields[count($this->validChangeFields)] = $name;
				
			}
				
		}		
		
		return $result;
		
	}


	function dbInsRec($dtaObj)
	{
		$tFnc = new AB_querySession;
		$cUser = $tFnc->getUserData();
		
		$dtaObj["VPU_ORHE_USLNA"] = $cUser["userCode"];
		
		$this->dbMasterTransac();
		$this->errorCodeText = array();

		$E_POST = $dtaObj;
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		$this->E_POST = $E_POST;

		if ($dtaObj["VPU_ORHE_ODATE"] == '')
		{
			$dtaObj["VPU_ORHE_ODATE"] = $this->getDateFormed();
			$E_POST["VPU_ORHE_ODATE"] = $dtaObj["VPU_ORHE_ODATE"];
		}

		
		$nfnu = new vgb_getNextFreeNumber($this->tblInfo->schema,"VPU_ORHE" ,$this->E_POST,$this->masterTranConn);
		$dtaObj["VPU_ORHE_ORNUM"] = $nfnu->vgb_nextNumber;

	  	$wTbls = new dbMaster("vpu_orhe",$this->tblInfo->schema);
	  	$wTbls->brTrConn = $this->masterTranConn;
	  	if ($dtaObj["idVPU_ORHE"] == '0')
	  	{
	  		$dtaObj["idVPU_ORHE"] = '';
	  	}
	  	
	  	$dtaObj["VPU_ORHE_ORSTP"] = $this->AB_CPARM["VPU_STEPS_SC"]["DFLT"];
	  		
		$wTbls->dbInsRec($dtaObj);			

		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}


		if ($this->errorCode == 0 && $this->insertId > 0)
		{		
			$this->dbPdoEndTransac(true);
		}
		else
		{	
			$this->errorCode =+ 3000;	
			$this->dbPdoEndTransac(false);
			$this->errorCodeText[count($this->errorCodeText)] = "Insert Transaction Aborted ";
		}		
		

	}
	
	function getDateFormed()
	{
		$td = getdate();
		$month = strval($td['mon'] + 100);
		$mday = strval($td['mday'] + 100);
		
		$toDay = $td['year'] . "-" . substr($month,1) . "-" . substr($mday,1);
		
		return $toDay;
		
	}
	
	function updDelivery($dtaObj)
	{
		$this->masterTranConn = $this->brTrConn;
		$this->updateInvoice($dtaObj);
		
	}	

	function dbUpdRec($dtaObj)
	{

		if ($dtaObj["VPU_INVOICE"] == "vpu_invoice")
		{
			$this->localPost = $dtaObj;
			
	 		$wTblsInvoice = new vpu_invoice($this->tblInfo->schema);
	  		$wTblsInvoice->dbUpdRec($dtaObj);
			foreach($wTblsInvoice as $name => $value)
			{
				 $this->$name = $value;
			}
			return;			
		}



		$this->dbMasterTransac();
		$this->errorCodeText = array();
		
			
		$E_POST = $dtaObj;	
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		$this->E_POST = $E_POST;
		$this->local_POST = $E_POST;
		$this->updMethod = "dbUpdRec";
		

		// We need a current record list of all VPU_ORST 
		$tmpObj["PROCESS"] = $E_POST["PROCESS"];
		$tmpObj["SESSION"] = $E_POST["SESSION"];
		$tmpObj["TBLNAME"] = "vpu_orhe";			
		$tmpObj["idVPU_ORHE"] = $dtaObj["idVPU_ORHE"];  		
  		$orstOrg = new vpu_orheOriginalVal($this->tblInfo->schema);
		$orstOrg->dbFindMatch($tmpObj);
		

		

		
		$this->orstOrg = $orstOrg->result;
		
		$this->groupObjById();
		$wTbls = array();

		$this->validChange = "";
		
		// Simple post for new Document step advance
		$this->setNewDocument = $E_POST["DOC_STEPS"]; // step
		$this->setDocOrst = $E_POST["DOC_ORST"]; // orst list
		$this->setDocOrsi = array(); // [steps] = id
		
$this->VPU_ORHE_ODATE = ($dtaObj["VPU_ORHE_ODATE"]!=""?"Has":"Not");

		if ($dtaObj["VPU_ORHE_ODATE"] == '')
		{
			$dtaObj["VPU_ORHE_ODATE"] = $this->getDateFormed();
			$E_POST["VPU_ORHE_ODATE"] = $dtaObj["VPU_ORHE_ODATE"];
		}
		
$this->VPU_ORHE_ODATE .= $dtaObj["VPU_ORHE_ODATE"];
 		
//		if ($this->objAreEqual($E_POST,"vpu_orhe","idVPU_ORHE") != true)
// 		{
  			$this->headerUpd = $dtaObj;
  			$wTbls[0] = new dbMaster("vpu_orhe",$this->tblInfo->schema);
	  		$wTbls[0]->brTrConn = $this->masterTranConn;
			$wTbls[0]->dbUpdRec($dtaObj);
			
//		}
//		else
//		{
//			$wTbls[0] = $orstOrg;
//			$wTbls[0]->fetchResult = $this->orstOrg;
//		}		
	
		
		
			
		if(!$this->errorCode)
		{
			$this->errorCode = 10;
			$this->errorInfo = "000000";
			
			
			
		}
		else
		{
			$this->errorCode = 20;
		}

		
		
		foreach($wTbls[0] as $name => $value)
		{
			 $this->$name = $value;
		}

		
	
		$this->recBad = "";
		$this->recMod = "";
		$this->recNew = "";
				
		$this->InventoryUpdRec = array();
		
		$recSet = $E_POST["RECSET"];
		
		$this->recSetPost = $recSet;
		
		$this->rsCount = array();

		// Validate all lots before. Aborts all if one not valid 
		$occ = 1;
		$lotValid = true;		
		
		
		while ($occ < count($recSet) && $lotValid == true)
		{
			if ($recSet[$occ]["idVPU_ORDE"] || $this->isNewId($recSet[$occ]["idVPU_ORDE"]) )
			{
				if ($recSet[$occ]["VIN_ITEM_LOTCT"] && $recSet[$occ]["VIN_ITEM_LOTCT"] >0 )
				{
					$lotValid = $this->validateVPU_LSTR($recSet[$occ]);
					// lot Item
				}
				$recSet[$occ]["lotValid"] = $lotValid;
				if($lotValid == false)
				{
					$this->errorCode = "9902";
					
					$orlin=$recSet[$occ]["VPU_ORDE_ORLIN"];
					$item =$recSet[$occ]["VIN_ITEM_ITMID"];
										
					$this->errorCodeText[count($this->errorCodeText)] = "9902 - Lot Qty not valid ";
					$this->rowCount  = 0;
					$this->dbFnct = "Lot Qty Validation ";
				}
			}
			
			$occ += 1;
		}
						
		 
		
		$occ = 1;
		while ($occ < count($recSet) && $this->errorCode == 0 )
		{
			$subwTbls = array();
			
			
			if ($recSet[$occ]["idVPU_ORDE"] || $this->isNewId($recSet[$occ]["idVPU_ORDE"]) )
			{
				$dbCount = count($wTbls);
				$recSet[$occ]["PROCESS"] = $E_POST["PROCESS"];
				$recSet[$occ]["SESSION"] = $E_POST["SESSION"];
				$recSet[$occ]["TBLNAME"] = "vpu_orde";			
				
				if ($recSet[$occ]["VPU_ORDE_DDATE"] == '')
				{
					$theDay = $this->getDateFormed();
					if ($dtaObj["VPU_ORHE_ODATE"] < $theDay)
					{
						$recSet[$occ]["VPU_ORDE_DDATE"] = $theDay;
					}
					else
					{
						$recSet[$occ]["VPU_ORDE_DDATE"] = $dtaObj["VPU_ORHE_ODATE"];
					}
					
					
				}

				
				$this->recSetPost[$occ] = $recSet[$occ];
				
				// $recSet[$occ] = $this->setDfltVPU_ORDE($recSet[$occ]);
				
				if ( $this->isNewId($recSet[$occ]["idVPU_ORDE"]) || $recSet[$occ]["ab-new"] == 1)
				{
					
					if ($recSet[$occ]["trash"] == 1)
					{
						// Nothing;
					}
					else
					{
				  		$wTbls[$dbCount] = new dbMaster("vpu_orde",$this->tblInfo->schema);
				  		$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				  		$recSet[$occ] = $this->setDfltVPU_ORDE($recSet[$occ]);
				  		$this->defaultVPU_ORDE = $recSet[$occ];
				  		
						$wTbls[$dbCount]->dbInsRec($recSet[$occ]);
						$this->errorCode += $wTbls[$dbCount]->errorCode;
						
						
						$recSet[$occ]["idVPU_ORDE"] = $wTbls[$dbCount]->insertId;
						$this->recSetPost[$occ]["idVPU_ORDE"] = $recSet[$occ]["idVPU_ORDE"];
						
						$subwTbls = $this->insertVPU_ORST($recSet[$occ],$subwTbls,$occ);
						
						$tmpObj = $recSet[$occ];
						$tmpObj["VIN_CUST_BPART"] = $E_POST["VPU_ORHE_BTCUS"];	
						$tmpObj["VIN_CUST_ITMID"] = $tmpObj["VPU_ORDE_ITMID"];	
						$tmpObj["VIN_CUST_LPPAID"] = $tmpObj["VPU_ORDE_OUNET"];	
						$tmpObj["VIN_CUST_LPDATE"] = $this->getDateFormed();
						$wT = new vin_cust($this->tblInfo->schema);
						$wT->brTrConn = $this->masterTranConn;
						$wT->vin_cust_lastPrice($tmpObj);
						$wTbls[$dbCount]->vin_cust = $wT;
						
						
					
					}
				}
				else
				{
					if ($recSet[$occ]["trash"] == 1)
					{
						$subwTbls = $this->deleteVPU_ORST($recSet[$occ],$subwTbls,$occ);
				  		$wTbls[$dbCount] = new dbMaster("vpu_orde",$this->tblInfo->schema);
				  		$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
						$wTbls[$dbCount]->dbDelRec($recSet[$occ]);
						$this->errorCode += $wTbls[$dbCount]->errorCode;
						

					}
					else
					{
				  		$wTbls[$dbCount] = new dbMaster("vpu_orde",$this->tblInfo->schema);
				  		$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
						if ($this->objAreEqual($recSet[$occ],"vpu_orde","idVPU_ORDE") != true)
				  		{
				  			if ($this->hasCompletedSteps($recSet[$occ]) == true && implode($this->validChangeFields) != "VPU_ORDE_ORDQT" )
				  			{
				  				$this->errorCode += 99;
				  				$this->errorCodeText[count($this->errorCodeText)] = "Error 99 - Line cannot be modified (Has received steps)";
				  			}
				  			else
				  			{				  							  		
								$wTbls[$dbCount]->dbUpdRec($recSet[$occ]);
								$this->errorCode += $wTbls[$dbCount]->errorCode;
							
// 								AC 2016113 Has been remove must come from copy paste of VSL_ORDERS
// 								Does not make sense as VIN_CUST refers to customer not suppliers VPU_ORHE_BTCUS
//								$tmpObj = $recSet[$occ];
//								$tmpObj["VIN_CUST_BPART"] = $E_POST["VPU_ORHE_BTCUS"];	
//								$tmpObj["VIN_CUST_ITMID"] = $tmpObj["VPU_ORDE_ITMID"];	
//								$tmpObj["VIN_CUST_LPPAID"] = $tmpObj["VPU_ORDE_OUNET"];	
//								$tmpObj["VIN_CUST_LPDATE"] = $this->getDateFormed();
//								$wT = new vin_cust($this->tblInfo->schema);
//								$wT->brTrConn = $this->masterTranConn;
//								$wT->vin_cust_lastPrice($tmpObj);
//								$wTbls[$dbCount]->vin_cust = $wT;

							}
							
						}
						
						$subwTbls = $this->updateVPU_ORST($recSet[$occ],$subwTbls,$occ);
						
					}
				}
				 
				$lotUpdate = array();
				
				if ($recSet[$occ]["VIN_ITEM_LOTCT"] >0 )
				{
					
					$lotUpdate = $this->updateVPU_LSTR($this->recSetPost[$occ]);
					if (!$this->lotUpdate)
					{
						$this->lotUpdate = array();
					}
					$this->lotUpdate[count($this->lotUpdate)] = $lotUpdate;
					// lot Item
					
				}


				
			}
			else
			{
			}
			
			if (count($subwTbls) > 0)
			{
				$wTbls[$dbCount]->RSresults = $subwTbls;
			}

			if (count($lotUpdate) > 0)
			{
				$wTbls[$dbCount]->RSLotUpdate = $lotUpdate;
			}
			
			
			$this->rsCount[$occ-1] = $recSet[$occ];
			
			$occ += 1;
		}
		
		
		/* Update Inventory VIN_INVENTORY.php
		Always use these prefix for your function names
		IV_ = Information functions
		TV_ = Transaction functions 

		Here we need to know before committing  that we have no errors.
		If no error we pass all $this->InventoryUpdRec records if any to inventory
		
		$this->InventoryUpdRec
		$dbCount = count($wTbls);
		$wTbls[$dbCount] = new dbMaster("vin_inventory",$this->tblInfo->schema);
		$wTbls[$dbCount]->TV_VIN_TRN_PROCESS("vpu_orhe",$this->InventoryUpdRec);
		
		*/
	
		$occ = 0;
		while ($occ < count($wTbls))
		{
			
			$occ += 1;
		}
		
		$dbCount = count($wTbls);
		$wTbls[$dbCount] = new vin_inventory($this->tblInfo->schema);
		$wTbls[$dbCount]->masterTranConn = $this->masterTranConn;
		$wTbls[$dbCount]->TV_VIN_TRN_PROCESS($E_POST,$this->InventoryUpdRec);
		$this->errorCode += $wTbls[$dbCount]->errorCode;
		
		

		if ($this->errorCode == 0)
		{
			// try to remove vpu_orsi records
			// if permitted it is because nothing is attached
			$this->cleanOrsiData($this->local_POST["idVPU_ORHE"],$this->masterTranConn);
			$this->orsiChk = $this->updateOrsiData($this->local_POST,$this->masterTranConn);
			
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
		
		$this->INVENT = $wTbls[$dbCount];
		$this->pstRecset = $recSet;
		$this->RSresults = $wTbls;
		$this->Mresults = $wTbls[0];
		
		$this->dbFnct = "dbUpdRec";
		
		return;

	}


	function hasCompletedSteps($chkObj)
	{
			
		$ret = false;
		
		$recSet = $chkObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet) && $ret==false)		
		{
			if ($recSet[$occ]["VPU_ORST_STEPS"] > "JJ_INVO")
			{
				$ret = true;
			}
			$occ += 1;
		}
		
		return $ret;
		
	}
	
	function updateOrsiData($ePost,$trCon)
	{
		
		$wTbls = array();
		$wTbls["errorCode"] = 0;
		
		if ($ePost["SESSION"] != "VPU_RECEIPT")
		{
			return $wTbls;
		}
		
		$ePost["VPU_ORSI_PDATE"] =  $this->getDateFormed();
  		$wTbls = new dbMaster("vpu_orsi",$this->tblInfo->schema);
  		$wTbls->brTrConn = $trCon;
		$wTbls->dbUpdRec($ePost);		
		
		return $wTbls;
	}
	
	function cleanOrsiData($id,$trCon)
	{
	  	$wTbls = new dbMaster("vpu_orsi",$this->tblInfo->schema);
	  	$wTbls->brTrConn = $trCon;
	  	
	  	$obj = array();
		$obj["PROCESS"] = $this->processId;
		$obj["SESSION"] = $this->sessionId;
		$obj["TBLNAME"] = "vpu_orsi";
		


	  	$obj["VPU_ORSI_ORNUM"] = $id;
		$wTbls->dbFindMatch($obj);
		$this->delAll = $wTbls->result;
		$this->delRset = array();
		
		$occ = 0;
		while ($occ < count($wTbls->result))
		{
			$wrec = $wTbls->result[$occ];
		  	$wwTbls = new dbMaster("vpu_orsi",$this->tblInfo->schema);
		  	$wwTbls->brTrConn = $trCon;
		  	
		  	$wobj = array();
			$wobj["PROCESS"] = $this->processId;
			$wobj["SESSION"] = $this->sessionId;
			$wobj["TBLNAME"] = "vpu_orsi";

		  	$wobj["idVPU_ORSI"] = $wrec["idVPU_ORSI"];
			$wwTbls->dbDelRec($wobj);
			
			$this->delRset[count($this->delRset)] = $wwTbls;	
			$occ += 1;
		}
			
	}
	
	function isNewId($id)
	{
		$ret = true;
	
		if ($id > 0)
		{
			$ret = false;
		}
	
		return $ret;
	}
	
	
	function setDfltVPU_ORDE($dtaObj)
	{
  		$dtaObj["VPU_ORDE_ORNUM"] = $this->local_POST["idVPU_ORHE"];
  		
  		if ($dtaObj["idVPU_ORDE"] < 1)
  		{
  			$dtaObj["idVPU_ORDE"] = "";
  		}

		if (!$dtaObj["VPU_ORDE_BTCUS"] || $dtaObj["VPU_ORDE_BTCUS"] == "" ) 
		{
			$dtaObj["VPU_ORDE_BTCUS"] = $this->local_POST["VPU_ORHE_BTCUS"];
			$dtaObj["VPU_ORDE_STCUS"] = $this->local_POST["VPU_ORHE_STCUS"];
			$dtaObj["VPU_ORDE_BTADD"] = $this->local_POST["VPU_ORHE_BTADD"];
			$dtaObj["VPU_ORDE_STADD"] = $this->local_POST["VPU_ORHE_STADD"];

			$dtaObj["VPU_ORDE_SLSRP"] = $this->local_POST["VPU_ORHE_SLSRP"];
			$dtaObj["VPU_ORDE_TERID"] = $this->local_POST["VPU_ORHE_TERID"];

		}

		if (!$dtaObj["VPU_ORDE_WARID"] || $dtaObj["VPU_ORDE_WARID"] == "")
		{
			if ($dtaObj["VPU_ORDE_ITMID"] && $dtaObj["VPU_ORDE_ITMID"] > 0)
			{
				$tmpObj = array();
				
				$tmpObj["PROCESS"] = "VIN_ITEMS";
				$tmpObj["SESSION"] = "VIN_ITEMS";
				$tmpObj["TBLNAME"] = "vin_item";			
				
				$tmpObj["idVIN_ITEM"] = $dtaObj["VPU_ORDE_ITMID"];
				
		  		$wItem = new dbMaster("vin_item",$this->tblInfo->schema);
				$wItem->dbFindMatch($tmpObj);

				$warObj = array();
				$warObj["PROCESS"] = "VIN_ITEMS";
				$warObj["SESSION"] = "VIN_ITEMS";
				$warObj["TBLNAME"] = "vin_wars";
				
				// $warObj["idVIN_WARS"] = 0;
				$warObj["VIN_WARS_SFWAR"] = "0";
				
				$wWars = new dbMaster("vin_wars",$this->tblInfo->schema);
				$wWars->dbFindFrom($warObj);
				$this->wWars = $wWars;
								
				if (count($wWars->result) > 0 )
				{
					$dtaObj["VPU_ORDE_WARID"] = $wWars->result[0]["idVIN_WARS"];
				}
				
			}
			
		}
		
		if (!$dtaObj["VPU_ORDE_LOCID"] || $dtaObj["VPU_ORDE_LOCID"] == "")
		{
			if ($dtaObj["VPU_ORDE_WARID"] && $dtaObj["VPU_ORDE_WARID"] > 0)
			{
				$tmpObj = array();
				
				$tmpObj["PROCESS"] = "VIN_ITEMS";
				$tmpObj["SESSION"] = "VIN_ITEMS";
				$tmpObj["TBLNAME"] = "vin_wars";			
				
				$tmpObj["idVIN_WARS"] = $dtaObj["VPU_ORDE_WARID"];
				
		  		$wItem = new dbMaster("vin_wars",$this->tblInfo->schema);
				$wItem->dbFindMatch($tmpObj);
				if (count($wItem->result) > 0 )
				{
					$dtaObj["VPU_ORDE_LOCID"] = $wItem->result[0]["VIN_WARS_MALOC"];
				}
				
			}
			
		}						

		return $dtaObj;
	}
	
		
	function insertVPU_ORST($dtaObj,$sTbls,$seq)
	{
	
		$wTbls = $sTbls;	
		
		$recSet = $dtaObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet))
		{
			
			
			if ($recSet[$occ]["trash"] != 1   && $recSet[$occ]["VPU_ORST_STPSQ"] > 0)
			{
				
				$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
				$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
				$recSet[$occ]["TBLNAME"] = "vpu_orst";			
				$recSet[$occ]["idVIN_ITEM"] = $dtaObj["VPU_ORDE_ITMID"];
				
				
				if ($recSet[$occ]["VPU_ORST_PDATE"] == '')
				{
					$theDay = $this->getDateFormed();
					if ($dtaObj["VPU_ORDE_DDATE"] < $theDay)
					{
						$recSet[$occ]["VPU_ORST_PDATE"] = $theDay;
					}
					else
					{
						$recSet[$occ]["VPU_ORST_PDATE"] = $dtaObj["VPU_ORDE_DDATE"];
					}
					
					
				}
				
			
				// New record may not have documents numbers
				$recSet[$occ] = $this->IV_VPU_initStepIdFields($recSet[$occ]);
				
				$recSet[$occ]["idVPU_ORST"] = "";				
				$recSet[$occ]["VPU_ORST_ORNUM"] = $dtaObj["idVPU_ORHE"];
				$recSet[$occ]["VPU_ORST_ORLIN"] = $dtaObj["idVPU_ORDE"];
				$recSet[$occ]["VPU_ORST_STEPS"] = $this->IV_VPU_FIRST_STEP("",$this->fetchResult[0]);
				$recSet[$occ]["VPU_ORST_WARID"] = $dtaObj["VPU_ORDE_WARID"];
				$recSet[$occ]["VPU_ORST_LOCID"] = $dtaObj["VPU_ORDE_LOCID"];

				$dbCount = count($wTbls);
				$wTbls[$dbCount] = new dbMaster("vpu_orst",$this->tblInfo->schema);
				$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				$wTbls[$dbCount]->dbInsRec($recSet[$occ]);
				$this->errorCode += $wTbls[$dbCount]->errorCode;
				
				$recSet[$occ]["idVPU_ORST"] = $wTbls[$dbCount]->insertId;				
				
				$this->setItemQtyAdj($recSet[$occ]);
			}
			
			$occ += 1;
			
		}
		$this->recSetPost[$seq]["RECSET"] = $recSet;
		return $wTbls;
		
	}
	
	
	function deleteVPU_ORST($dtaObj,$sTbls,$seq)
	{
	
		$wTbls = $sTbls;	
		
		$recSet = $dtaObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet) && $this->errorCode == 0)
		{
			
			$dbCount = count($wTbls);
			
			if ($recSet[$occ]["idVPU_ORST"] > 0 && $recSet[$occ]["VPU_ORST_STEPS"] < "JJ_X"  )
			{
				$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
				$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
				$recSet[$occ]["TBLNAME"] = "vpu_orst";
				$recSet[$occ]["idVIN_ITEM"] = $dtaObj["VPU_ORDE_ITMID"];
				
				$wTbls[$dbCount] = new dbMaster("vpu_orst",$this->tblInfo->schema);
				$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				$wTbls[$dbCount]->dbDelRec($recSet[$occ]);
				$this->errorCode += $wTbls[$dbCount]->errorCode;

				$recSet[$occ]["VPU_ORST_ORDQT"] = 0;
				$recSet[$occ]["lotSel"] = "";
							
				$this->setItemQtyAdj($recSet[$occ]);

				
			}
			else
			{
				if ($recSet[$occ]["VPU_ORST_STEPS"] > "JJ_INVO" )
				{
					$this->errorCode += 99;
					$this->errorCodeText[count($this->errorCodeText)] = "error 99 : Purchase step has been received - cannot be deleted";
				}
			}
						
			$occ += 1;
			
		}
		$this->recSetPost[$seq]["RECSET"] = $recSet;
		return $wTbls;
		
	}	

	function deleteVPU_LSTR($dtaObj,$sTbls)
	{
	// lotSel
		$wTbls = $sTbls;	
		
		$recSet = $dtaObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet))
		{
			
			$dbCount = count($wTbls);
			
			if ($recSet[$occ]["idVPU_ORST"] > 0 )
			{
				$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
				$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
				$recSet[$occ]["TBLNAME"] = "vpu_orst";
				$recSet[$occ]["idVIN_ITEM"] = $dtaObj["VPU_ORDE_ITMID"];
				
				$wTbls[$dbCount] = new dbMaster("vpu_lstr",$this->tblInfo->schema);
				$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				$wTbls[$dbCount]->dbDelRec($recSet[$occ]);		
				$this->errorCode += $wTbls[$dbCount]->errorCode;

				$recSet[$occ]["VPU_ORST_ORDQT"] = 0;			
				$this->setItemQtyAdj($recSet[$occ]);

				
			}
			
			$occ += 1;
			
		}
		
		return $wTbls;
		
	}	

	// extract from string  idVIN_LSHE:lotQty, pairs
	function accumLotQty($dtaStr)
	{
		$qty = 0;
		$tq = explode(",",$dtaStr);
		$occ = 0;
		while ($occ < count($tq))
		{
			
			if(strpos($tq[$occ],":") > 0)
			{
				$q = explode(":",$tq[$occ]);
				$qty += $q[1];
			}
				
			
			$occ += 1;
			
		}
		
		return $qty;
	}
	

	// if step is not after Delivery stock is not affected returns 0
	function setInventoryQty($dtaObj)
	{
		$retObj = array();
		$retObj["BOHQT"] =  0; // Purchasing
		$retObj["ALOQT"] =  0; // Purchasing
		$retObj["PURQT"] =  0; // Purchasing
		$retObj["LOTQT"] =  0; // Qty by lot
		
		if ($dtaObj["VIN_ITEM_LOTCT"] > 0)
		{
			// $retObj["LOTQT"] = $this->accumLotQty($dtaObj["lotSel"]);
			$retObj["LOTQT"] = 0;
			
		}
		else
		{
			$retObj["LOTQT"] = 0;//$dtaObj["VPU_ORST_ORDQT"];
		}
			
		// BOHQT Beyond II_DELI
		if ($dtaObj["VPU_ORST_STEPS"] > "II_DELI")
		{
			// return $dtaObj["VPU_ORST_ORDQT"];
			$retObj["BOHQT"] = $dtaObj["VPU_ORST_ORDQT"];
		}

		// PURQT includes II_DELI & GG_RELE
		if ($dtaObj["VPU_ORST_STEPS"] < "II_DELx" && $dtaObj["VPU_ORST_STEPS"] >"GG_REL" )
		{
			// return $dtaObj["VPU_ORST_ORDQT"];
			$retObj["PURQT"] = $dtaObj["VPU_ORST_ORDQT"] * -1;
		}
		
		return $retObj;
		
	}
	
	
	// Updates the Inventory Lots adjust value idVIN_ITEM,Qty to adjust pair
	function setItemQtyAdjLot($dtaObj)
	{
		if(!$this->countItemQtyAdj)
		{
			$this->countItemQtyAdj = 0;
			$this->TotalItemQtyAdj = "";
		}

		if(!$this->OriginalData["vpu_orst"][$dtaObj["idVPU_ORST"]])
		{ 
			$this->OriginalData["vpu_orst"][$dtaObj["idVPU_ORST"]]["VPU_ORST_ORDQT"] = 0;
			$this->OriginalData["vpu_orst"][$dtaObj["idVPU_ORST"]]["VPU_ORST_STEPS"] = "";
		}
		
		$orgORST = $this->OriginalData["vpu_orst"][$dtaObj["idVPU_ORST"]];
		
		$orgQtySgn = 1;
		if ($orgORST["VPU_ORST_ORDQT"] < 0)
		{
			$ordQtySgn = -1;
		}		
		
		$qtySgn = 1;
		if ($dtaObj["VPU_ORST_ORDQT"] < 0)
		{
			$qtySgn = -1;
		}		

		$newUpdObj = array();
		$newLotSel = explode(",",$dtaObj["lotSel"]);
		
		$orgRec = $this->OriginalData["vpu_lstr"];
		if (count($orgRec)>0)
		{
			foreach($orgRec as $name => $value)
			{
				if (strpos( "xx" . $name,$dtaObj["idVPU_ORST"] . "-" ) > 0 )
				{
					if ($value["VPU_LSTR_LOTSQ"] > 0 && $value["VPU_LSTR_ALOQT"] != 0 )
					{
						$newUpdObj[$value["VPU_LSTR_LOTSQ"]]["orgQT"] = abs($value["VPU_LSTR_ALOQT"]) * $orgQtySgn;	
						$newUpdObj[$value["VPU_LSTR_LOTSQ"]]["newQT"] = 0;
					}
					
				}
			}
		}
		
		$occ = 0;
		while ($occ < count($newLotSel)-1)
		{
			$war = explode(":",$newLotSel[$occ]);
			if (count($war)>1 && ($war[0]>0 && abs($war[1])>0) )
			{
				if(!$newUpdObj[$war[0]])
				{
					$newUpdObj[$war[0]]["orgQT"] = 0;
					$newUpdObj[$war[0]]["newQT"] = 0;
				}
				$newUpdObj[$war[0]]["newQT"] = abs($war[1]) * $qtySgn;
				
			}
			$occ += 1;
		}
		
		$this->newUpdObj = array();
		if (count($newUpdObj)>0)
		{
			$workObj = $dtaObj;
			foreach($newUpdObj as $name => $value)
			{
				$orgORST["VPU_ORST_ORDQT"] = $value["orgQT"];
				$qtyOrg = $this->setInventoryQty($orgORST);
				$workObj["VPU_ORST_ORDQT"] = $value["newQT"];
				$qtyNew = $this->setInventoryQty($workObj);
				
				$lotId = $name;
		
				$result = array();
				$result["BOHQT"] =  0; // On hane
				$result["ALOQT"] =  0; // Sales
				$result["PURQT"] =  0; // Purchasing
				$result["LOTQT"] =  0; // Lots
				
				$hasResults = 0;
			
				$rep = array();
				$rep["orgORST"] = $orgORST;
				$rep["orgQty"] = $value["orgQT"];
				$rep["newORST"] = $workObj;
				$rep["newQty"] = $value["orgQT"];
				
				$this->newUpdObj[count($this->newUpdObj)] = $rep;
				
				foreach($qtyOrg as $wname => $value)
				{
					
				
					if ($value < $qtyNew[$wname])
					{
						$result[$wname] = ($qtyNew[$wname] - $value) * -1; 
					} 
					else
					{
						if ($value > $qtyNew[$wname]) 
						{
							$result[$wname] = ($value - $qtyNew[$wname]);
						}
					}
					if ($result[$wname] != 0)
					{
						$hasResults += 1;
					}
					
				}
				$this->newUpdObj[count($this->newUpdObj)-1]["RESULT"] = $hasResults;
				if ($hasResults >0)
				{
					
					
					$rNum = count($this->InventoryUpdRec);
//					$rowRec = $orgRec;
//					foreach($dtaObj as $wname => $value)
//					{
//						 $rowRec[$wname] = $value;
//					}
					
					$rowRec = array();
					$rowRec["idVIN_ITEM"] = $dtaObj["idVIN_ITEM"];
					$rowRec["VIN_ADJLOT_BOHQT"] = $result["BOHQT"] * -1;
					$rowRec["VIN_ADJLOT_ALOQT"] = $result["ALOQT"];
					$rowRec["VIN_ADJLOT_PURQT"] = $result["PURQT"];
					$rowRec["VIN_ADJLOT_LOTQT"] = $qtyNew["LOTQT"];
					
					$rowRec["idVIN_WARS"] = $dtaObj["VPU_ORST_WARID"];
					$rowRec["idVIN_LOCS"] = $dtaObj["VPU_ORST_LOCID"];
					
					$rowRec["idVIN_LSHE"] = $lotId;
					// Will need to provide multiple lot selections per ORST record
					
					$rowRec["idVIN_UNIT"] = $dtaObj["VPU_ORST_QTUOM"];
					$this->InventoryUpdRec[$rNum] = $rowRec;
					$this->countItemQtyAdj += 1;
					
				}				
						
			}
			
		}
		
	}
	

	
	// Updates the Inventory adjust value idVIN_ITEM,Qty to adjust pair
	function setItemQtyAdj($dtaObj)
	{
		if(!$this->countItemQtyAdj)
		{
			$this->countItemQtyAdj = 0;
			$this->TotalItemQtyAdj = "";
		}
		$this->countItemQtyAdj += 1;
		
		
		if(!$this->OriginalData["vpu_orst"][$dtaObj["idVPU_ORST"]])
		{ 
			$this->OriginalData["vpu_orst"][$dtaObj["idVPU_ORST"]]["VPU_ORST_ORDQT"] = 0;
			$this->OriginalData["vpu_orst"][$dtaObj["idVPU_ORST"]]["VPU_ORST_STEPS"] = "";
		}
		
		$orgRec = $this->OriginalData["vpu_orst"][$dtaObj["idVPU_ORST"]];
		
		$qtyOrg = $this->setInventoryQty($orgRec);
		$qtyNew = $this->setInventoryQty($dtaObj);
		
		
		$result = array();
		$result["BOHQT"] =  0; // On hane
		$result["ALOQT"] =  0; // Sales
		$result["PURQT"] =  0; // Purchasing
		$result["LOTQT"] =  0; // Lots
		
		$hasResults = 0;
	
		
		
		foreach($qtyOrg as $name => $value)
		{
			
		
			if ($value < $qtyNew[$name])
			{
				$result[$name] = ($qtyNew[$name] - $value) * -1; 
			} 
			else
			{
				if ($value > $qtyNew[$name]) 
				{
					$result[$name] = ($value - $qtyNew[$name]);
				}
			}
			if ($result[$name] != 0)
			{
				$hasResults += 1;
			}
			
		}

		if ($hasResults >0)
		{
			
			
			$rNum = count($this->InventoryUpdRec);
			$rowRec = $orgRec;
			foreach($dtaObj as $name => $value)
			{
				 $rowRec[$name] = $value;
			}
			
			$rowRec["VIN_ADJUST_BOHQT"] = $result["BOHQT"] * -1;
			$rowRec["VIN_ADJUST_ALOQT"] = $result["ALOQT"];
			$rowRec["VIN_ADJUST_PURQT"] = $result["PURQT"];
			$rowRec["VIN_ADJUST_LOTQT"] = $qtyNew["LOTQT"];
			
			$rowRec["idVIN_WARS"] = $dtaObj["VPU_ORST_WARID"];
			$rowRec["idVIN_LOCS"] = $dtaObj["VPU_ORST_LOCID"];
			
			$rowRec["idVIN_LSHE"] = $dtaObj["lotSel"];
			// Will need to provide multiple lot selections per ORST record
			
			$rowRec["idVIN_UNIT"] = $dtaObj["VPU_ORST_QTUOM"];
			$this->InventoryUpdRec[$rNum] = $rowRec;
		}
		
		
		
		
		
				
	}
	
	
	function updateVPU_ORST($dtaObj,$sTbls,$seq)
	{
	
		$wTbls = $sTbls;	
		
		$recSet = $dtaObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet)  && $this->errorCode == 0)
		{
			$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
			$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
			$recSet[$occ]["TBLNAME"] = "vpu_orst";	
			$recSet[$occ]["idVIN_ITEM"] = $dtaObj["VPU_ORDE_ITMID"];
			$recSet[$occ]["VIN_ITEM_LOTCT"] = $dtaObj["VIN_ITEM_LOTCT"];
			
			$recSet[$occ]["VPU_ORST_WARID"] = $dtaObj["VPU_ORDE_WARID"];
			$recSet[$occ]["VPU_ORST_LOCID"] = $dtaObj["VPU_ORDE_LOCID"];
			$recSet[$occ]["VPU_ORST_QTUOM"] = $dtaObj["VPU_ORDE_SAUOM"];
					
			$dbCount = count($wTbls);
			
			if ($recSet[$occ]["trash"] != 1)
			{
				$wTbls[$dbCount] = new dbMaster("vpu_orst",$this->tblInfo->schema);
				$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				
				
				if ($recSet[$occ]["idVPU_ORST"] > 0 )
				{
					

					if ($recSet[$occ]["VPU_ORST_PDATE"] == '')
					{
						$theDay = $this->getDateFormed();
						if ($dtaObj["VPU_ORDE_DDATE"] < $theDay)
						{
							$recSet[$occ]["VPU_ORST_PDATE"] = $theDay;
						}
						else
						{
							$recSet[$occ]["VPU_ORST_PDATE"] = $dtaObj["VPU_ORDE_DDATE"];
						}
						
						
					}

					
					$recSet[$occ] = $this->TV_NEWDOC_CONTROL($recSet[$occ]);
					$wTbls[$dbCount]->obj =$recSet[$occ];
					$wTbls[$dbCount]->objAreEqual = $this->objAreEqual($recSet[$occ],"vpu_orst","idVPU_ORST");
					$wTbls[$dbCount]->objvalid = $this->IV_STEP_VALID($recSet[$occ]);



					
					if ($this->objAreEqual($recSet[$occ],"vpu_orst","idVPU_ORST") != true)
			  		{
			  			if ($this->IV_STEP_VALID($recSet[$occ]) == true && $recSet[$occ]["VPU_ORST_STEPS"] < "JJ_X" )
			  			{	
			  				
							$wTbls[$dbCount]->dbUpdRec($recSet[$occ]);
							$wTbls[$dbCount]->E_POST = $recSet[$occ];
							$this->errorCode += $wTbls[$dbCount]->errorCode;
							
							if ($recSet[$occ]["SESSION"]=="VPU_RECEIPT" && $recSet[$occ]["VPU_ORST_BACKORDQT"] && $recSet[$occ]["VPU_ORST_BACKORDQT"] > 0)
							{
								$this->OriginalData["vpu_orde"][$dtaObj["idVPU_ORDE"]]["nextStepSequence"] += 10;
								
								$newSeq = array();
								$newSeq["PROCESS"] = $dtaObj["PROCESS"];
								$newSeq["SESSION"] = $dtaObj["SESSION"];
								$newSeq["TBLNAME"] = "vpu_orst";
								$newSeq["VPU_ORST_WARID"] = $dtaObj["VPU_ORDE_WARID"];
								$newSeq["VPU_ORST_LOCID"] = $dtaObj["VPU_ORDE_LOCID"];
								$newSeq["VPU_ORST_QTUOM"] = $dtaObj["VPU_ORDE_SAUOM"];
																	
								$newSeq["idVPU_ORST"] = "";
								$newSeq["VPU_ORST_ORNUM"] = $dtaObj["VPU_ORDE_ORNUM"];
								$newSeq["VPU_ORST_ORLIN"] = $dtaObj["idVPU_ORDE"];
								$newSeq["VPU_ORST_STPSQ"] = $this->OriginalData["vpu_orde"][$dtaObj["idVPU_ORDE"]]["nextStepSequence"];
								$newSeq["VPU_ORST_STEPS"] = "II_DELI";
								$newSeq["VPU_ORST_USLNA"] = $recSet[$occ]["VPU_ORST_USLNA"];
								$newSeq["VPU_ORST_PDATE"] = $recSet[$occ]["VPU_ORST_PDATE"];
								$newSeq["VPU_ORST_DDATE"] = $recSet[$occ]["VPU_ORST_DDATE"];
								$newSeq["VPU_ORST_QTUOM"] = $recSet[$occ]["VPU_ORST_QTUOM"];
								$newSeq["VPU_ORST_FACTO"] = $recSet[$occ]["VPU_ORST_FACTO"];

								if ($recSet[$occ]["VPU_ORST_ACKID"])
								{
									$newSeq["VPU_ORST_ACKID"] = $recSet[$occ]["VPU_ORST_ACKID"];
								}
								
								if ($recSet[$occ]["VPU_ORST_AOKID"])
								{
									$newSeq["VPU_ORST_AOKID"] = $recSet[$occ]["VPU_ORST_AOKID"];
								}

								if ($recSet[$occ]["VPU_ORST_SCEID"])
								{
									$newSeq["VPU_ORST_SCEID"] = $recSet[$occ]["VPU_ORST_SCEID"];
								}

								if ($recSet[$occ]["VPU_ORST_PICID"])
								{
									$newSeq["VPU_ORST_PICID"] = $recSet[$occ]["VPU_ORST_PICID"];
								}
								
								if ($recSet[$occ]["VPU_ORST_RELID"])
								{
									$newSeq["VPU_ORST_RELID"] = $recSet[$occ]["VPU_ORST_RELID"];
								}

								if ($recSet[$occ]["VPU_ORST_PAKID"])
								{
									$newSeq["VPU_ORST_PAKID"] = $recSet[$occ]["VPU_ORST_PAKID"];
								}

								$newSeq["VPU_ORST_ORDQT"] = $recSet[$occ]["VPU_ORST_BACKORDQT"];
								$newSeq["VPU_ORST_CANCE"] = "0";
								$newSeq["VPU_ORST_CURAT"] = $recSet[$occ]["VPU_ORST_CURAT"];

								$dbCount = count($wTbls);
				
								$wTbls[$dbCount] = new dbMaster("vpu_orst",$this->tblInfo->schema);
								$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
								$wTbls[$dbCount]->dbInsRec($newSeq);		
								$this->errorCode += $wTbls[$dbCount]->errorCode;
								if ($this->errorCode == 0)
								{
									$newSeq["idVPU_ORST"] = $wTbls[$dbCount]->insertId;
									$this->setItemQtyAdj($newSeq);
								}
								
								$this->boRec = $newSeq;
								$this->boRecOcc = $recSet[$occ];
								$this->boRecDta = $wTbls[$dbCount];
							}
							
							
							
						}
						else
						{
							$this->errorCode += 2000;
					
							$orlin=$dtaObj["VPU_ORDE_ORLIN"];
							$stpsq=$recSet[$occ]["VPU_ORST_STPSQ"];
							
						
							$this->errorCodeText[count($this->errorCodeText)] = "2000 - Step not valid for Line:(" . $orlin . ") Step:" .  $stpsq;
							if ($recSet[$occ]["VPU_ORST_STEPS"] > "JJ_INVO" )
							{
								$this->errorCodeText[count($this->errorCodeText)] = "Purchase step has been received - cannot be modified";
							}							
						}
						
						$this->setItemQtyAdj($recSet[$occ]);		
					}
					
				}
				else
				{
					if ($recSet[$occ]["idVPU_ORST"] < 0 )
					{					
						$recSet[$occ]["idVPU_ORST"] = "";
						$recSet[$occ]["VPU_ORST_ORNUM"] = $dtaObj["VPU_ORDE_ORNUM"];
						$recSet[$occ]["VPU_ORST_ORLIN"] = $dtaObj["idVPU_ORDE"];
						$recSet[$occ]["VPU_ORST_STEPS"] = $this->IV_VPU_FIRST_STEP("",$this->fetchResult[0]);
						
						// New record may not have documents numbers
						$recSet[$occ] = $this->IV_VPU_initStepIdFields($recSet[$occ]);
						
						
						
						$wTbls[$dbCount]->dbInsRec($recSet[$occ]);		
						$this->errorCode += $wTbls[$dbCount]->errorCode;
						$recSet[$occ]["idVPU_ORST"] = $wTbls[$dbCount]->insertId;
						$wTbls[$dbCount]->RS = $recSet[$occ];
						$this->setItemQtyAdj($recSet[$occ]);
					}
				}		
			}
			else
			{
				if ($recSet[$occ]["idVPU_ORST"] > 0&& $recSet[$occ]["VPU_ORST_STEPS"] < "JJ_X" )
				{
					$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
					$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
					$recSet[$occ]["TBLNAME"] = "vpu_orst";			
				
					$wTbls[$dbCount] = new dbMaster("vpu_orst",$this->tblInfo->schema);
					$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
					$wTbls[$dbCount]->dbDelRec($recSet[$occ]);
					$this->errorCode += $wTbls[$dbCount]->errorCode;
					
					$recSet[$occ]["VPU_ORST_ORDQT"] = 0;	
					$recSet[$occ]["lotSel"] = "";	
					$this->setItemQtyAdj($recSet[$occ]);
				}
				else
				{
					if ($recSet[$occ]["VPU_ORST_STEPS"] > "JJ_INVO" )
					{
						$this->errorCode += 99;
						$this->errorCodeText[count($this->errorCodeText)] = "error 99 : Purchase step has been received - cannot be deleted";
					}					
				}				
			}

			$occ += 1;
			
		}
		
		$this->recSetPost[$seq]["RECSET"] = $recSet;
		return $wTbls;
	}

	function validateVPU_LSTR($dtaObj)
	{
		
		$recValid = true;
		
		$recSet = $dtaObj["RECSET"];
		$occ = 0;
		while ( $occ < count($recSet) && $recValid == true)
		{
			if ($recSet[$occ]["idVPU_ORST"])
			{
				$lotAccum = 0;
				$selList = explode(",",$recSet[$occ]["lotSel"]);
				$wocc = 0;
				while ($wocc < count($selList)-1)
				{
					$SL = explode(":",$selList[$wocc]);
					
					$lotAccum += abs($SL[1]);
					$wocc += 1;
				};
				
				
				// BOHQT Beyond II_DELI or Equal
				if ($this->setNewDocument >= "II_DELI" 
				&& $lotAccum != abs($recSet[$occ]["VPU_ORST_ORDQT"])
				&& strpos("x," . $this->setDocOrst . ",",",".$recSet[$occ]["idVPU_ORST"].",") > 0
				)
				{
					$recValid = false;
				}
				if ( abs($lotAccum) > abs($recSet[$occ]["VPU_ORST_ORDQT"]) )
				{
					$recValid = false;
					$recSet[$occ]["lotAccum"] = $lotAccum;
					$this->lotValid = $recSet[$occ];
				}
			}
			
			$occ +=1;
		}
		
		return $recValid;
		
	}
	
	function updateVPU_LSTR($dtaObj)
	{
			// receives ORDER LINE RECSET
	$debugret = array();
	$this->lotlist = array();
			
			
			$wTbls = array();
	
			// $wTbls[0] = new dbMaster("vpu_lstr",$this->tblInfo->schema);
			// $wTbls[0] Representsresult info on the all updates in  $dtaObj["RECSET"];
			
			
			$recSet = $dtaObj["RECSET"];
			$PR = $dtaObj["PROCESS"];
			$SE = $dtaObj["SESSION"];
			$TB = "vpu_lstr";			
	
			
			
			$occ = 0;
			while ( $occ < count($recSet) )
			{
				if ($recSet[$occ]["idVPU_ORST"] && $recSet[$occ]["VPU_ORST_STEPS"] < "JJ_X" )
				{
									
					$selList = explode(",",$recSet[$occ]["lotSel"]);
					$wocc = 0;
					
					$recSet[$occ]["lotSel"] = "";
					while ($wocc < count($selList)-1)
					{
						$selList[$wocc] = trim($selList[$wocc],"\t");
						$recSet[$occ]["lotSel"] .= $selList[$wocc] . ",";
						$wocc += 1;
					}
					
					$debugret[count($debugret)] = $recSet[$occ];
					$dbBase = array_merge($dtaObj,$recSet[$occ]);
					 
					$orgLSTR = $this->OriginalData["vpu_lstr"];
					$qtySgn = 1;
					if ($recSet[$occ]["VPU_ORST_ORDQT"] < 0)
					{
						$qtySgn = -1;
					}
					
	
					 
					if (count($orgLSTR)>0)
					{
						foreach($orgLSTR as $name => $value)
						{
							
							// the xx is to insure a value > 0 if found 
							// strpos return 0 for first char and false if not found (confusing)
							// This avoids confusion
							if (strpos( "xx" . $name,$recSet[$occ]["idVPU_ORST"] . "-" ) > 0 && $recSet[$occ]["idVPU_ORST"] > 0)
							{
								// Current idVPU_ORST 
								$updRec = $value;
								$updRec["VPU_LSTR_ALOQT"] = 0;
							
								$updRec["PROCESS"] = $PR;
								$updRec["SESSION"] = $SE;
								$updRec["TBLNAME"] = $TB;			
								
								$updRec["selList"] = $selList;
								
								$lotFound = false;
								$wocc = 0;
								
								while ($wocc < count($selList)-1 && $lotFound == false)
								{
									$SL = explode(":",$selList[$wocc]);
									$updRec["bef"] = trim($SL[0])  . "==" . $updRec["VPU_LSTR_LOTSQ"];
									if (trim($SL[0]) == $updRec["VPU_LSTR_LOTSQ"])
									{
										$updRec["VPU_LSTR_ALOQT"] = abs($SL[1]) * $qtySgn;
										$lotFound = true;
										$selList[$wocc] = "0:0";
										$updRec["selList"] = $selList; 
										$updRec["value_PURQT"] = $value["VPU_LSTR_ALOQT"];
										if ($updRec["VPU_LSTR_ALOQT"] != $value["VPU_LSTR_ALOQT"])
										{
											$dbCount = count($wTbls);
											$wTbls[$dbCount] = new dbMaster("vpu_lstr",$this->tblInfo->schema);
											$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
											$wTbls[$dbCount]->dbUpdRec($updRec);
											$this->errorCode += $wTbls[$dbCount]->errorCode;
											$updRec["method"]="dbUpdRec";
											
											// $this->lotlist[count($this->lotlist)] = $updRec;
										}
										
										
										
									}
									$wocc +=1 ;
								}
								$updRec["recount"] = $recSet[$occ]["idVPU_ORST"];
								$updRec["orgName"] = $name;
								$updRec["lotLength"] = count($selList);
								$updRec["lotFound"] = $lotFound;
								// $this->lotlist[count($this->lotlist)] = $updRec;
								
								if ($lotFound == false && $updRec["idVPU_LSTR"] > 0)
								{
									$dbCount = count($wTbls);
									$wTbls[$dbCount] = new dbMaster("vpu_lstr",$this->tblInfo->schema);
									$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
									$wTbls[$dbCount]->dbDelRec($updRec);
									$this->errorCode += $wTbls[$dbCount]->errorCode;
									$updRec["method"]="dbDelRec";
									$updRec["VPU_LSTR_ALOQT"] = 0;
									
									//$this->lotlist[count($this->lotlist)] = $updRec;
								}
								
								
								$dbCount = count($wTbls);
								
							}
							
							
						}
					}
					
					// Remain new lot selections
					$wocc = 0;
					while ($wocc < count($selList)-1)
					{
						
						$SL = explode(":",$selList[$wocc]);
						if ($SL[0]>0 && $SL[1] > 0)
						{
							$updRec = array();
							$updRec["PROCESS"] = $PR;
							$updRec["SESSION"] = $SE;
							$updRec["TBLNAME"] = $TB;			
							
							$updRec["VPU_LSTR_ORNUM"] = $dtaObj["VPU_ORDE_ORNUM"];
							$updRec["VPU_LSTR_ORLIN"] = $dtaObj["idVPU_ORDE"];
							$updRec["VPU_LSTR_STPSQ"] = $recSet[$occ]["idVPU_ORST"];
							$updRec["VPU_LSTR_ITMID"] = $dtaObj["VPU_ORDE_ITMID"];
							$updRec["VPU_LSTR_LOTSQ"] = $SL[0];
							$updRec["VPU_LSTR_ALOQT"] = abs($SL[1]) * $qtySgn;
			
					$this->lotlist[count($this->lotlist)] = $dtaObj;
					$this->lotlist[count($this->lotlist)] = $recSet[$occ];

							$dbCount = count($wTbls);
							$wTbls[$dbCount] = new dbMaster("vpu_lstr",$this->tblInfo->schema);
							$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
							$wTbls[$dbCount]->dbInsRec($updRec);
							$this->errorCode += $wTbls[$dbCount]->errorCode;
							
							$updRec["method"]="dbInsRec";
							$updRec["idVPU_LSTR"] = $wTbls[$dbCount]->insertId;
							
							
							// $this->lotlist[count($this->lotlist)] = $dtaObj;
						}
		
						$wocc += 1;				
					}
					$this->setItemQtyAdjLot($recSet[$occ]);
				}
				
				$occ +=1;
			}
			$this->lotlist[count($this->lotlist)-1]["dbUpd"] = $wTbls;
			return $wTbls;
		
	}


// Always use these prefix for your function names
// IV_ = Information functions
// TV_ = Transaction functions 

//		$this->setNewDocument = $E_POST["DOC_STEPS"]; // step
//		$this->setDocOrst = $E_POST["DOC_ORST"]; // orst list
//		$this->setDocOrstp = $E_POST["VPU_ORHE_ORSTP"]; // Order Scheme defines valid steps 

//		$recSet[$occ] = $this->TV_NEWDOC_CONTROL($recSet[$occ]:
//		
//		if ($this->objAreEqual($recSet[$occ],"vpu_orst","idVPU_ORST") != true)
//  		{
//  			if ($this->IV_STEP_VALID($recSet[$occ]) == true)
//

	function TV_NEWDOC_CONTROL($objRec)
	{
		$x = count($this->IV_ND);
		
		if (!$this->setNewDocument || strpos("x,".$this->setDocOrst."," , "," . $objRec["idVPU_ORST"] . ",") < 1)
		{
			return $objRec;
		}
		// If object not of concern simply return the object
		if ($objRec["VPU_ORST_STEPS"] > "JJ_INVO")
		{
			$this->errorCodeText[count($this->errorCodeText)] = "Error 99: Step has been received - step not valid";
			$this->errorCode += 2000;
			return $objRec;
		}
				
		if ($this->setNewDocument >= $objRec["VPU_ORST_STEPS"])
		{
			if ($this->IV_NEWDOC_StepValid($objRec) == false )
			{
				$this->errorCodeText[count($this->errorCodeText)] = "Step advance not valid";
				$this->errorCode += 2000;
				return $objRec;
			}
		}
		else
		{
			if ($this->IV_NEWDOC_StepValid($objRec) == true )
			{
				$this->errorCodeText[count($this->errorCodeText)] = "Step retract not valid";
				$this->errorCode += 2000;
				return $objRec;
			}
			else
			{
				$objRec = $this->TV_SetDocNumberClear($objRec);
				return $objRec;
			}
		}
			
			
		
			
		if (!$this->setDocNFNU)
		{
			$nfnu = new vgb_getNextFreeNumber($this->tblInfo->schema,"VPU_ORSI_GRPID" ,$this->local_POST,$this->masterTranConn);
			$this->setDocNFNU = $nfnu->vgb_nextNumber;

		}
		
		$objRec["VPU_ORHE_ORNUM" ] = $this->local_POST["idVPU_ORHE"];
		$objRec["VPU_ORHE_ORSTP" ] = $this->local_POST["VPU_ORHE_ORSTP"];
		$objRec["VPU_ORHE_BTCUS" ] = $this->local_POST["VPU_ORHE_BTCUS"];
		
		$validSteps = explode(",",$this->IV_GET_SCEME_SEQ("",$objRec));
		
		if (!$this->chkstep)
		{
			 $this->chkstep = array();
		}
				
		$occ = 0;
		while ($occ < count($validSteps) )
		{
			if ($validSteps[$occ] <= $this->setNewDocument  )
			{
				$this->chkstep[count($this->chkstep)]["valid"] = $validSteps[$occ] . "(" . $this->IV_getDocNumber($validSteps[$occ],$objRec) . ")";
				$this->chkstep[count($this->chkstep)-1]["rec"] = $objRec;
				
				if ($this->IV_getDocNumber($validSteps[$occ],$objRec) == 0)
				{
					$vpu_orsi = array();
					$vpu_orsi["idVPU_ORSI"] = "";
					$vpu_orsi["VPU_ORSI_STEPS"] = $validSteps[$occ];
					
					$vpu_orsi["VPU_ORSI_GRPID"] = $this->setDocNFNU;
					$vpu_orsi["VPU_ORSI_ORNUM"] = $objRec["VPU_ORHE_ORNUM"];
					$vpu_orsi["VPU_ORSI_PROCE"] = "0";
					// $vpu_orsi["VPU_ORSI_BPART"] = $objRec["VPU_ORHE_BTCUS"];
					$vpu_orsi["VPU_ORSI_REISS"] = "0";
					$vpu_orsi["VPU_ORSI_RESEQ"] = "0";
					
					$wTbls = new dbMaster("vpu_orsi",$this->tblInfo->schema);
					$wTbls->brTrConn = $this->masterTranConn;
		
					$vpu_orsi["PROCESS"] = $this->processId;
					$vpu_orsi["SESSION"] = $this->sessionId;
					
					if (!$this->setDocOrsi[$vpu_orsi["VPU_ORSI_STEPS"]])
					{
						$wTbls->dbInsRec($vpu_orsi);
						$this->setDocOrsi[$vpu_orsi["VPU_ORSI_STEPS"]] = $wTbls->insertId;
						$vpu_Id = $wTbls->insertId;
					}
					else
					{
						$vpu_Id = $this->setDocOrsi[$vpu_orsi["VPU_ORSI_STEPS"]];
					}
					
					$objRec = $this->TV_SetDocNumber($validSteps[$occ],$objRec,$vpu_Id);
					
					if (!$this->errorCodexx)
					{
						$this->errorCodexx = array();
					}
					$wTbls->posted = $vpu_orsi;
					$wTbls->objRec = $objRec;
					$wTbls->validSteps = $occ . "=" . $validSteps[$occ];
					$this->errorCodexx[count($this->errorCodexx)] = $wTbls;
				}
					
			}
			else
			{
				// $objRec["VPU_ORST_STEPS"] = $validStep[$occ];
				// $occ = count($validSteps);
			}		
					
					
			$occ += 1;
		}
		
		
		return $objRec;
		
	}
	
	function IV_NEWDOC_StepValid($objRec)
	{

		if (!$this->IV_ND)
		{
			$this->IV_ND = array();
		}
		$x = count($this->IV_ND);

		if ($objRec["VPU_ORST_STEPS"] > "JJ_INVO")
		{
			$this->IV_ND[$x] = $objRec["VPU_ORST_STEPS"] . ">";
			return false;
		}
				
		if ($objRec["VPU_ORST_STEPS"] > $this->setNewDocument)
		{
			$this->IV_ND[$x] = $objRec["VPU_ORST_STEPS"] . ">";
			return false;
		}
		$objRec["VPU_ORHE_ORSTP"] = $this->setNewDocument;
		$validSteps = explode(",",$this->IV_GET_SCEME_SEQ("",$objRec));
		
		$stepValid = true;
		$occ = 0;
		while ($occ < count($validSteps) && stepValid == true)
		{
			if ($validSteps[$occ] <  $this->setNewDocument)
			{
				// check nothing
			}
			else
			{
				if ($this->IV_getDocNumber($validSteps[$occ],$objRec) > 0)
				{
					$this->IV_ND[$x] = $this->IV_getDocNumber($validSteps[$occ],$objRec) . "for" . $validSteps[$occ];
					$stepValid = false;
				}					
			
			}
			
			$occ += 1;
		}
		
		return $stepValid;
	}
	
	function IV_getDocNumber($docStep,$objRec)
	{
		$docNumber = 0;


		switch ( $docStep )
		{
			case 'KK_PURG':
				$docNumber =  $objRec["VPU_ORST_ARCID"] * 1;
			break;
			case 'JJ_INVO':
				$docNumber =  $objRec["VPU_ORST_WINVO"] * 1;
			break;
			case 'II_DELI':
				$docNumber =  $objRec["VPU_ORST_DELID"] * 1;
			break;
			case 'HH_PACK':
				$docNumber =  $objRec["VPU_ORST_PAKID"] * 1;
			break;
			case 'GG_RELE':
				$docNumber =  $objRec["VPU_ORST_RELID"] * 1;
			break;
			case 'FF_PICK':
				$docNumber =  $objRec["VPU_ORST_PICID"] * 1;
			break;
			case 'EE_SCED':
				$docNumber =  $objRec["VPU_ORST_SCEID"] * 1;
			break;
			case 'DE_AOKN':
				$docNumber =  $objRec["VPU_ORST_AOKID"] * 1;
			break;
			case 'DD_ACKN':
				$docNumber =  $objRec["VPU_ORST_ACKID"] * 1;
			break;
			
		}

		return $docNumber;
		
	}	
		

	function TV_SetDocNumberClear($objRec)
	{

		$recId = "";
		$sep = "";
		
		$objRec["VPU_ORST_STEPS"] = $this->setNewDocument;

		switch ($this->setNewDocument)
		{

			case 'DD_ACKN':                          	                
				$recId .= $sep . "VPU_ORST_ACKID";$objRec["VPU_ORST_ACKID"]=0;
				$sep = ",";
			case 'DE_AOKN':                          	                
				$recId .= $sep . "VPU_ORST_AOKID";$objRec["VPU_ORST_AOKID"]=0;
				$sep = ",";                      	                
			case 'EE_SCED':                          	                
				$recId .= $sep . "VPU_ORST_SCEID";$objRec["VPU_ORST_SCEID"]=0;
				$sep = ",";                      	                
			case 'FF_PICK':                          	                
				$recId .= $sep . "VPU_ORST_PICID";$objRec["VPU_ORST_PICID"]=0;
				$sep = ",";                      	                
			case 'GG_RELE':                          	                
				$recId .= $sep . "VPU_ORST_RELID";$objRec["VPU_ORST_RELID"]=0;
				$sep = ",";                      	                
			case 'HH_PACK':                          	                
				$recId .= $sep . "VPU_ORST_PAKID";$objRec["VPU_ORST_PAKID"]=0;
				$sep = ",";                      	                
			case 'II_DELI':                          	                
				$recId .= $sep . "VPU_ORST_DELID";$objRec["VPU_ORST_DELID"]=0;
				$sep = ",";                      	                
			case 'JJ_INVO':                          	                
				$recId .= $sep . "VPU_ORST_WINVO";$objRec["VPU_ORST_WINVO"]=0;
				$sep = ",";                      	                
			case 'KK_PURG':
				$recId .= $sep . "VPU_ORST_ARCID";$objRec["VPU_ORST_ARCID"]=0;
				$sep = ",";                      	                
			break;
			
		}
		
		$objRec["dbSetToNull"] = $recId;
		
		return $objRec;
		
	}
	
	function TV_SetDocNumber($vStep,$objRec,$recId)
	{

		switch ($vStep )
		{
			case 'KK_PURG':
				$docNumber =  $objRec["VPU_ORST_ARCID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VPU_ORST_ARCID"] = $recId;
					$objRec["VPU_ORST_STEPS"] = "QQ_PURG";
				}
			break;
			case 'JJ_INVO':
				$docNumber =  $objRec["VPU_ORST_WINVO"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VPU_ORST_WINVO"] = $recId;
					$objRec["VPU_ORST_STEPS"] = "KK_PURG";
				}
			break;
			case 'II_DELI':
				$docNumber =  $objRec["VPU_ORST_DELID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VPU_ORST_DELID"] = $recId;
					$objRec["VPU_ORST_STEPS"] = "JJ_INVO";
				}
			break;
			case 'HH_PACK':
				$docNumber =  $objRec["VPU_ORST_PAKID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VPU_ORST_PAKID"] = $recId;
					$objRec["VPU_ORST_STEPS"] = "II_DELI";
					
					
				}
			break;
			case 'GG_RELE':
				$docNumber =  $objRec["VPU_ORST_RELID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VPU_ORST_RELID"] = $recId;
					$objRec["VPU_ORST_STEPS"] = $this->IV_VPU_NEXT_STEP($objRec["VPU_ORST_STEPS"],$objRec);
				}
			break;
			case 'FF_PICK':
				$docNumber =  $objRec["VPU_ORST_PICID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VPU_ORST_PICID"] = $recId;
					$objRec["VPU_ORST_STEPS"] = $this->IV_VPU_NEXT_STEP($objRec["VPU_ORST_STEPS"],$objRec);
				}
			break;
			case 'EE_SCED':
				$docNumber =  $objRec["VPU_ORST_SCEID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VPU_ORST_SCEID"] = $recId;
					$objRec["VPU_ORST_STEPS"] = $this->IV_VPU_NEXT_STEP($objRec["VPU_ORST_STEPS"],$objRec);
				}
			break;
			case 'DE_AOKN':
				$docNumber =  $objRec["VPU_ORST_AOKID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VPU_ORST_AOKID"] = $recId;
					$objRec["VPU_ORST_STEPS"] = $this->IV_VPU_NEXT_STEP($objRec["VPU_ORST_STEPS"],$objRec);
				}
			break;
			case 'DD_ACKN':
				$docNumber =  $objRec["VPU_ORST_ACKID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VPU_ORST_ACKID"] = $recId;
					$objRec["VPU_ORST_STEPS"] = $this->IV_VPU_NEXT_STEP($objRec["VPU_ORST_STEPS"],$objRec);
				}
			break;
			
		}
		return $objRec;
		
	}
	
	function IV_STEP_VALID($objRec)
	{
	
		
		if(!$this->OriginalData["vpu_orst"][$objRec["idVPU_ORST"]])
		{
			return true;
		}
		
		$orgDta = $this->OriginalData["vpu_orst"][$objRec["idVPU_ORST"]];
	
		$this->IV_STEP_VALIDORG = $orgDta["VPU_ORST_STEPS"]; 
		$this->IV_STEP_VALIDCUR = $objRec["VPU_ORST_STEPS"];
		
	
		if($orgDta["VPU_ORST_STEPS"] != $objRec["VPU_ORST_STEPS"] )
		{
			if (strpos("x,".$this->setDocOrst."," , "," . $objRec["idVPU_ORST"] . ",") < 1)
			{
				return false;
			}
			else
			{
				// $this->IV_getDocNumber = $this->IV_getDocNumber($objRec["VPU_ORST_STEPS"],$objRec);
				if ($this->IV_getDocNumber($objRec["VPU_ORST_STEPS"],$objRec) > 0)
				{
					return false;
				}
			}
		}
		
		
		return true;
		

	}



	function IV_VPU_FIRST_STEP($SCEME ,$ATD)
	{
		$RET="";
		$SEQ  = $this->IV_GET_SCEME_SEQ($SCEME ,$ATD);
		$RET = explode(",",$SEQ);
		return $RET[0];
		
	}
	
	function IV_GET_SCEME_SEQ($SCEME,$ATD)
	{
	
		switch ($ATD["VPU_ORHE_ORSTP"])
		{
			case 'DD000':
			// REM Mandatory Only
	       		$seq= "GG_RELE,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'EE001':
			// REM MAN + (ACKN)
	       		$seq= "DD_ACKN,DE_AOKN,GG_RELE,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'FF010':
			// MAN  + (PICK)
	       		$seq= "FF_PICK,GG_RELE,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'GG011':
			// MAN  + (ACKN) + (PICK)
	       		$seq= "DD_ACKN,DE_AOKN,FF_PICK,GG_RELE,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'HH100':
			// MAN  + (PACK)
	       		$seq= "GG_RELE,HH_PACK,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'II101':
			// MAN  + (ACKN) + (PACK)
	       		$seq= "DD_ACKN,DE_AOKN,GG_RELE,HH_PACK,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'JJ110':
			// MAN  + (PICK) + (PACK)
	       		$seq= "FF_PICK,GG_RELE,HH_PACK,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'KK111':
			// All Steps
	       		$seq= "DD_ACKN,DE_AOKN,EE_SCED,FF_PICK,GG_RELE,HH_PACK,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'LL200':
			// LL200   Man. + (ACKN)+(PICK)+(PACK)
	       		$seq= "DD_ACKN,DE_AOKN,FF_PICK,GG_RELE,HH_PACK,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'MM200':
			// MM200	Man. + (ACKN)+(SCED)
	       		$seq= "DD_ACKN,DE_AOKN,EE_SCED,GG_RELE,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'NN200':
			// NN200	Man. + (ACKN)+(SCED)+(PICK)	
	       		$seq= "DD_ACKN,DE_AOKN,EE_SCED,FF_PICK,GG_RELE,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'OO200':
			// OO200	Man. + (ACKN)+(SCED)+(PACK)
	       		$seq= "DD_ACKN,DE_AOKN,EE_SCED,GG_RELE,HH_PACK,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'PP200':
			// PP200	Man. + (SCED)  
	       		$seq= "EE_SCED,GG_RELE,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'QQ200':
			// QQ200	Man. + (SCED)+(PICK)
	       		$seq= "EE_SCED,FF_PICK,GG_RELE,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'RR200':
			// RR200	Man. + (SCED)+(PACK)
	       		$seq= "EE_SCED,GG_RELE,HH_PACK,II_DELI,JJ_INVO,KK_PURG";
	       		break;
			case 'SS200':
			// SS200	Man. + (SCED)+(PICK)+(PACK)
			$seq= "EE_SCED,FF_PICK,GG_RELE,HH_PACK,II_DELI,JJ_INVO,KK_PURG";
			break;
		default:
			$seq= "";
		
		}
	
		return $seq;
	}
	
	function IV_VPU_initStepIdFields($obj)
	{

		$obj["VPU_ORST_ACKID"] = null;
		$obj["VPU_ORST_AOKID"] = null;
		$obj["VPU_ORST_ARCID"] = null;
		$obj["VPU_ORST_DELID"] = null;
		$obj["VPU_ORST_PAKID"] = null;
		$obj["VPU_ORST_PICID"] = null;
		$obj["VPU_ORST_RELID"] = null;
		$obj["VPU_ORST_SCEID"] = null;
		$obj["VPU_ORST_WINVO"] = null;		
		
		return $obj;

	}
	
	
	
	function IV_VPU_NEXT_STEP($steps,$objRec)
	{
		$stpReturn = $steps;
		
		$validSteps = explode(",",$this->IV_GET_SCEME_SEQ("",$objRec));
		
		$occ = 0;
		while ($occ < count($validSteps))
		{
			if ($validSteps[$occ] > $steps)
			{
				$stpReturn = $validSteps[$occ];
				$occ = count($validSteps); // Force end of loop
			}
			$occ += 1;
		}
		
		return $stpReturn;
		
	}
	
	
	function IV_VPU_STEP_EVAL($SCEME,$A_TD)
	{
		
	// Always use these prefix for your variable names
	// IV_ = Information values
	// TV_ = Transaction values 
		
		
		$qRsp = array();
		$qRsp["IV_VPU_STEP_MULT"] = 0;
		$qRsp["IV_VPU_STEP_RELEASED"] = 0;
		$qRsp["IV_VPU_STEP_DELIVERED"] = 0;
		$qRsp["IV_VPU_STEP_INVOICED"] = 0;
		$qRsp["IV_VPU_STEP_FIRST_QTY"] = 0;
		$qRsp["IV_VPU_HAS_TO_INVOICE"] = 0;
		$qRsp["IV_VPU_HAS_TO_RELEASE"] = 0;
		$qRsp["IV_VPU_HAS_TO_DELIVER"] = 0;
		$qRsp["IV_VPU_HAS_ALOCATED_QTY"] = 0;
		$qRsp["IV_VPU_HAS_IN_WIP"] = 0;
		$qRsp["IV_VPU_STEP_MULT_CHECK"] = 0;
		$qRsp["IV_VPU_STEP_QTY"] = array();
		$qRsp["IV_VPU_STEPS_VALID"] = $this->IV_GET_SCEME_SEQ($SCEME ,$A_TD[0]);
		
		$qRspInit = $qRsp;
		
		$listidORHE = "";
		$listidORDE = "";
		$listidORST = "";
		
		$occ = 0;
		
		while ($occ < count($A_TD))
		{
			
			if (strpos(" ," . $listidORST , "," . $A_TD[$occ]["idVPU_ORST"] . "," ) < 1)
			{
				$listidORST .= $A_TD[$occ]["idVPU_ORST"] . ",";
			
				if ($A_TD[$occ]["VPU_ORST_STEPS"] == $this->IV_VPU_FIRST_STEP($SCEME,$A_TD[$occ]))
				{
					$qRsp["IV_VPU_STEP_FIRST_QTY"] += $A_TD[$occ]["VPU_ORST_ORDQT"];
				}
				
		
				if ($A_TD[$occ]["VPU_ORST_STEPS"] > "JJ_INVO" )
				{
					
					
					$qRsp["IV_VPU_STEP_INVOICED"]  += $A_TD[$occ]["VPU_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VPU_ORST_STEPS"] > "II_DELI" && $A_TD[$occ]["VPU_ORST_STEPS"] < "JJ_INVO_x")
				{
					$qRsp["IV_VPU_HAS_TO_INVOICE"] += $A_TD[$occ]["VPU_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VPU_ORST_STEPS"] > "II_DELI" )
				{
					
					$qRsp["IV_VPU_STEP_DELIVERED"]  += $A_TD[$occ]["VPU_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VPU_ORST_STEPS"] > "GG_RELE" && $A_TD[$occ]["VPU_ORST_STEPS"] < "II_DELI_x")
				{
					$qRsp["IV_VPU_HAS_TO_DELIVER"] += $A_TD[$occ]["VPU_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VPU_ORST_STEPS"] > "GG_REL " && $A_TD[$occ]["VPU_ORST_STEPS"] < "II_DELI_x")
				{
					$qRsp["IV_VPU_HAS_ALOCATED"] = 1;
					$qRsp["IV_VPU_HAS_ALOCATED_QTY"] += $A_TD[$occ]["VPU_ORST_ORDQT"];
				}
		
		
		
				if ($A_TD[$occ]["VPU_ORST_STEPS"] > "GG_RELE")
				{
					$qRsp["IV_VPU_STEP_RELEASED"]  += $A_TD[$occ]["VPU_ORST_ORDQT"];
				}
				else
				{
					$qRsp["IV_VPU_HAS_TO_RELEASE"] += $A_TD[$occ]["VPU_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VPU_ORST_STEPS"] == "KK_PURG")
				{
					$qRsp["IV_VPU_HAS_IN_WIP"] += $A_TD[$occ]["VPU_ORST_ORDQT"];
				}
		
				
		
				if (!$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]])
				{
					$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]] = $qRspInit;
				}
	
				if (!$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_STEP_QTY"][$A_TD[$occ]["VPU_ORST_STEPS"]])
				{
					$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_STEP_QTY"][$A_TD[$occ]["VPU_ORST_STEPS"]] = $A_TD[$occ]["VPU_ORST_ORDQT"];		
				}
				else
				{
					$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_STEP_QTY"][$A_TD[$occ]["VPU_ORST_STEPS"]] += $A_TD[$occ]["VPU_ORST_ORDQT"];
				}
				$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_STEP_RELEASED"] += $qRsp["IV_VPU_STEP_RELEASED"];
				$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_STEP_DELIVERED"] += $qRsp["IV_VPU_STEP_DELIVERED"];
				$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_STEP_INVOICED"] += $qRsp["IV_VPU_STEP_INVOICED"];
				$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_STEP_FIRST_QTY"] +=	$qRsp["IV_VPU_STEP_FIRST_QTY"];
				$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_HAS_TO_INVOICE"] += $qRsp["IV_VPU_HAS_TO_INVOICE"];
				$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_HAS_TO_RELEASE"] += $qRsp["IV_VPU_HAS_TO_RELEASE"];
				$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_HAS_TO_DELIVER"] += $qRsp["IV_VPU_HAS_TO_DELIVER"];
				$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_HAS_ALOCATED_QTY"] += $qRsp["IV_VPU_HAS_ALOCATED_QTY"];
				$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_HAS_IN_WIP"] += $qRsp["IV_VPU_HAS_IN_WIP"];
				$qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]]["IV_VPU_STEP_MULT_CHECK"] += 1;
								
				$qRsp = $qRspInit;
			
			}
					
			$occ += 1;
		}
	
		$occ = 0;
		while ($occ < count($A_TD))
		{
			$A_TD[$occ]["OrderStatus"] = $qResponse["qR".$A_TD[$occ]["idVPU_ORDE"]];
			
			$occ += 1;
		}
	
	
		return  $A_TD; 
	
	}


//	function taxCalculate($wAmt,$taxRec)
//	{
//		
//		$occ = 0;
//		$taxAmt = 0;
//		while ($occ < count($taxRec))
//		{
//				
//			$tmpAmt = $wAmt;
//			if ($taxRec[$occ]["VTX_SCHE_TPREV"] == 1)
//			{
//				$tmpAmt += $taxAmt;
//			}
//			
//			$taxAmt =  $tmpAmt * $taxRec[$occ]["VTX_SCHE_TAXPE"] / 100;
//			$taxRec[$occ]["GLAMT"] += round($taxAmt,2);
//			$occ += 1;
//		}
//		
//		return $taxRec;
//		
//	}
	
	function updateInvoice($ePost)
	{
		
		$invoiceObj["PROCESS"] = $ePost["PROCESS"];
		$invoiceObj["SESSION"] = $ePost["SESSION"];
		$invoiceObj["idVPU_ORHE"] = "0";
		$invoiceObj["deliveryID"] = $ePost["deliveryID"];
		
		if (trim($invoiceObj["deliveryID"]) != "") 
		{
			$invoiceTbl = new vpu_invoiceRead($this->tblInfo->schema);
			$invoiceTbl->dbFindFrom($invoiceObj);
			foreach($invoiceTbl as $name => $value)
			{
				 $this->$name = $value;
			}		
			$this->invoices = $invoiceTbl;
		}
		
		$this->errorCode = 0;
		$this->errorCodeText = array();		
		
		$resultSet = array();
		$dtaSet = array();
		$dtaSet["PROCESS"] = $ePost["PROCESS"];
		$dtaSet["SESSION"] = $ePost["SESSION"];
		$dtaSet["POST_DATE"] = $ePost["POST_DATE"];
		// $dtaSet["POST_DATE"] = $this->getDateFormed(); // Should this be supplied by user????
		
		if (!$ePost["getTotals"])
		{
			if (!$dtaSet["POST_DATE"] || trim($dtaSet["POST_DATE"]) == "" )
			{
				$this->errorCode = 66;
				$this->errorCodeText[count($this->errorCodeText)] = " Posting date not supplied (required) ";
			}
		}

		$delID = explode(",",$invoiceObj["deliveryID"]);
		$recSet = $invoiceTbl->result;

		if (trim($invoiceObj["deliveryID"])=="")
		{
			$this->errorCode = 67;
			$this->errorCodeText[count($this->errorCodeText)] = " delivery ID's are invalid ";
		}

		if (count($recSet)==0)
		{
			$this->errorCode = 68;
			$this->errorCodeText[count($this->errorCodeText)] = " no records found for delivery ID's";
		}

		
		$dtaSet["result"] = $recSet;
		$dtaSet["delID"] = $ePost;

		$this->updateAvgComp = array();
		
		if(trim($invoiceObj["deliveryID"])!="" && count($recSet)>0)
		{
			$occ = 0;
			while ($occ < count($delID) && $this->errorCode == 0 )
			{
				$dtaSet["TOTPURCH"] = 0;
				$dtaSet["EXPCHARGED"] = 0;
				$dtaSet["EXPBORNED"] = 0;
				$dtaSet["TAXES"] = array();
				$lastId = "";
				$dtaSet["AVGCOST"] = 0;
				$taxable = 0;
				
				// Will be used to distribute EXP - BOR over products on qty%
				$avgCostComp = array();
				
				$wocc = 0;
				while ($wocc < count($recSet))
				{
					if ( $recSet[$wocc]["VPU_ORST_DELID"] == $delID[$occ] )
					{
						if ($lastId == "")
						{
							$lastId = "DONE";
							$dtaSet["vpu_orhe"] = $recSet[$wocc];
							// Orhe Taxes
							$wTblsTax = new vpu_orheTax($this->tblInfo->schema);
							$taxPost = array();
					 		$taxPost["idVPU_ORHE"] = $recSet[$wocc]["idVPU_ORHE"];
					 		$wTblsTax->dbFindMatch($taxPost);
							$dtaSet["TAXES"] = $wTblsTax->result;
							$taxOcc = 0;
							while ($taxOcc < count($dtaSet["TAXES"]))
							{
								$dtaSet["TAXES"][$taxOcc]["GLAMT"] = 0;
								$taxOcc += 1;
							}
						}
						if ($recSet[$wocc]["VPU_ORDE_OLTYP"] == "STD")
						{
							// Must take care of Facto
							$totAmt = $recSet[$wocc]["VPU_ORDE_OUNET"] * $recSet[$wocc]["VPU_ORST_ORDQT"];
							$dtaSet["TOTPURCH"] += $totAmt; //A
							$dtaSet["AVGCOST"] += ($recSet[$wocc]["VIN_ITMWAR_AVGCP"] * $recSet[$wocc]["VPU_ORST_ORDQT"] ); //E
							if ($recSet[$wocc]["VIN_ITEM_ITTXT"] != "NOTAX")
							{
								
								$taxable += ($totAmt*1);
							}
							
							// Will be used to distribute EXP - BOR over products on qty%
							if (!$avgCostComp[ $recSet[$wocc]["VPU_ORDE_ITMID"] . "-" . $recSet[$wocc]["VIN_ITMWAR_WARID"] ])
							{
								$avgCostComp[ $recSet[$wocc]["VPU_ORDE_ITMID"] . "-" . $recSet[$wocc]["VIN_ITMWAR_WARID"] ] = array();
								$avgCostComp[ $recSet[$wocc]["VPU_ORDE_ITMID"] . "-" . $recSet[$wocc]["VIN_ITMWAR_WARID"] ]["qty"] = 0;
								$avgCostComp[ $recSet[$wocc]["VPU_ORDE_ITMID"] . "-" . $recSet[$wocc]["VIN_ITMWAR_WARID"] ]["total"] = 0;
							}
							$avgCostComp[ $recSet[$wocc]["VPU_ORDE_ITMID"] . "-" . $recSet[$wocc]["VIN_ITMWAR_WARID"] ]["qty"] += ($recSet[$wocc]["VPU_ORST_ORDQT"]*1);
							$avgCostComp[ $recSet[$wocc]["VPU_ORDE_ITMID"] . "-" . $recSet[$wocc]["VIN_ITMWAR_WARID"] ]["total"] += ($totAmt*1);
							
							// Update vpu_orde if average cost changed
							if ($recSet[$wocc]["VIN_ITMWAR_AVGCP"] != $recSet[$wocc]["VPU_ORDE_COSTP"])
							{
								$recSet[$wocc]["PROCESS"] = $ePost["PROCESS"];
								$recSet[$wocc]["SESSION"] = $ePost["SESSION"];
								
								$recSet[$wocc]["VPU_ORDE_COSTP"] = $recSet[$wocc]["VIN_ITMWAR_AVGCP"];
						  		$wTbls = new dbMaster("vpu_orde",$this->tblInfo->schema);
						  		$wTbls->brTrConn = $this->masterTranConn;
								$wTbls->dbUpdRec($recSet[$wocc]);
								
							}
								
						}
						if ($recSet[$wocc]["VPU_ORDE_OLTYP"] == "EXP")
						{
							// Must take care of Facto
							$totAmt = $recSet[$wocc]["VPU_ORDE_OUNET"] * $recSet[$wocc]["VPU_ORST_ORDQT"];
							$dtaSet["EXPCHARGED"] += $totAmt; //B 
							if ($recSet[$wocc]["VIN_ITEM_ITTXT"] != "NOTAX")
							{
								
								$taxable += ($totAmt*1);
							}

						}

						if ($recSet[$wocc]["VPU_ORDE_OLTYP"] == "BOR")
						{
							$dtaSet["EXPBORNED"] = ($recSet[$wocc]["VPU_ORDE_OUNET"] * $recSet[$wocc]["VPU_ORST_ORDQT"] ); //C
						}
						
						
					}
					
					$wocc += 1;
				}
				
				// Compute new average cost
				$this->updateAvgCost($avgCostComp,$dtaSet["EXPCHARGED"],$dtaSet["EXPBORNED"],$ePost);
				
				// Add Taxes Central Tax calculate Taxes calculated on total taxable
				$taxCalc = new vgl_taxing($this->tblInfo->schema);
	 			$dtaSet["TAXES"] = $this->initTaxAmt($dtaSet["TAXES"]);
			  	$dtaSet["TAXES"] = $taxCalc->vgl_taxCalculate($taxable,$dtaSet["TAXES"]);
				
				$taxOcc = 0;
				while ($taxOcc < count($dtaSet["TAXES"]))
				{
					$dtaSet["TAXES"][$taxOcc]["GLAMT"] = round($dtaSet["TAXES"][$taxOcc]["GLAMT"],2);
					$taxOcc += 1;
				}
				
				$resultSet[$occ] = array();
				$resultSet[$occ]["dtaSet"] = $dtaSet;
				
				if (!$ePost["getTotals"])
				{
					
					$finTbls = new vap_financial($this->tblInfo->schema);
					$finTbls->brTrConn = $this->masterTranConn;
					$finTbls->vap_sales("VPU_INV",$dtaSet);
					$resultSet[$occ]["finSet"] = $finTbls;
					$this->errorCode = $finTbls->errorCode;
					$this->errorCodeText = $finTbls->errorCodeText;
					$this->VGL_JNHE_TRNID = $finTbls->VGL_JNHE_TRNID;
					$this->VAP_OIHE_INVOI = $finTbls->VAP_OIHE_INVOI;

					if ($this->errorCode == 0)
					{
						 $this->updateFinalSteps($delID[$occ]);
					}
				}
				

				
				$occ += 1;
			} 

			

		}

		
		$this->updResult = $resultSet;

		
		
		// Expecting
		// - vpu_orhe (Header) for Partner-Reference-Currency
		// - POST_DATE - Posting date
		// - TOTPURCH Total of sales (Items)
		// - EXPCHARGED Expense Charged (Services)
		// - EXPBORNED Expense Not Charged (Services)
		// - TAXES (by state/province) (vtx_sche  + GLAMT
		// - AVGCOST (Total average cost Items)
		
		
	}
	
	function initTaxAmt($txRec)
	{
		$occ = 0;
		while ($occ < count($txRec))
		{
			$txRec[$occ]["GLAMT"] = '0';
			$occ += 1;
		}
		
		return $txRec;
	}
		
	function updateAvgCost($avgCostDta,$exp,$bor,$ePost)
	{
		if (count($avgCostDta) > 0)
		{
			$totalQty = 0;
			foreach($avgCostDta as $name => $value)
			{
				$totalQty += ($avgCostDta[$name]["qty"]*1);
			}
			$totalQty = abs($totalQty);
			if ($totalQty>0)
			{
				foreach($avgCostDta as $name => $value)
				{
					$itemQty = abs(($avgCostDta[$name]["qty"]*1));
					$avgCostDta[$name]["per"] = $itemQty * 100 / $totalQty;
					$this->updateInventValue($name,$avgCostDta[$name],$exp,$bor,$ePost);
				}
				
			}
			$this->updateAvgComp[count($this->updateAvgComp)] = $avgCostDta; 
		}
		
		
	}


	function updateInventValue($nameId,$record,$exp,$bor,$E_POST)
	{
		$objId = explode("-",$nameId);
		
		$invDim = new dbMaster("vin_inve",$this->tblInfo->schema); 
		$dimObj = array();
		$dimObj["PROCESS"] = $E_POST["PROCESS"];
		$dimObj["SESSION"] = $E_POST["SESSION"];
		$dimObj["VIN_INVE_ITMID"] = $objId[0];
		$dimObj["VIN_INVE_WARID"] = $objId[1];
		$invDim->dbFindMatch($dimObj);

		$costDim = new dbMaster("vin_itmwar",$this->tblInfo->schema); 
		$acpObj = array();
		$acpObj["PROCESS"] = $E_POST["PROCESS"];
		$acpObj["SESSION"] = $E_POST["SESSION"];
		$acpObj["VIN_ITMWAR_ITMID"] = $objId[0];
		$acpObj["VIN_ITMWAR_WARID"] = $objId[1];
		$costDim->dbFindMatch($acpObj);
		
		$iocc = 0;
		$iqty = 0;
		$mqty = 0;
		
		while ($iocc < count($invDim->result))
		{
			$iqty += ($invDim->result[$iocc]["VIN_INVE_BOHQT"] *1);
			$iocc += 1;
		}
		
		$invDim->adjustQty = ($record["qty"]*1);
		$invDim->poPrice = ($record["total"]*1) / $invDim->adjustQty;
		$invDim->totalQty = $iqty;			
		$invDim->avgCost = ($costDim->result[0]["VIN_ITMWAR_AVGCP"]*1);
		
		$adjCp = ($exp+$bor) * ($record["per"]*1) / 100;
		
		$newCost = (( ($iqty-$invDim->adjustQty) * $invDim->avgCost) + ( $invDim->adjustQty * $invDim->poPrice ) + ($adjCp *1) ) / $invDim->totalQty;
		$newCost = round($newCost,2);
		$invDim->newCost = $newCost; 
		
		$avgCost = new dbMaster("vin_itmwar",$this->tblInfo->schema); 
		$avgObj = array();
		$avgObj["PROCESS"] = $E_POST["PROCESS"];
		$avgObj["SESSION"] = $E_POST["SESSION"];
		$avgObj["VIN_ITMWAR_ITMID"] = $objId[0];
		$avgObj["VIN_ITMWAR_WARID"] = $objId[1];
		$avgCost->dbFindMatch($avgObj);		
		if ($avgCost->rowCount == 0 || $avgCost->result[0]["idVIN_ITMWAR"] == 0)
		{
			// insert
			$avgCostUpd = new dbMaster("vin_itmwar",$this->tblInfo->schema);
			$avgCostUpd->brTrConn = $this->masterTranConn;
			$avgUpd = array();
			$avgUpd["PROCESS"] = $E_POST["PROCESS"];
			$avgUpd["SESSION"] = $E_POST["SESSION"];
			$avgUpd["VIN_ITMWAR_ITMID"] = $objId[0];
			$avgUpd["VIN_ITMWAR_WARID"] = $objId[1];
			$avgUpd["VIN_ITMWAR_AVGCP"] = $invDim->newCost;
			$avgCostUpd->dbInsRec($avgUpd);					
		}
		else
		{
			if ($avgCost->result[0]["VIN_ITMWAR_AVGCP"] !=  $invDim->newCost)
			{
				// Update
				$avgCostUpd = new dbMaster("vin_itmwar",$this->tblInfo->schema); 
				$avgCostUpd->brTrConn = $this->masterTranConn;
				$avgUpd = array();
				$avgUpd["PROCESS"] = $E_POST["PROCESS"];
				$avgUpd["SESSION"] = $E_POST["SESSION"];
				$avgUpd["idVIN_ITMWAR"] = $avgCost->result[0]["idVIN_ITMWAR"];
				$avgUpd["VIN_ITMWAR_AVGCP"] = $invDim->newCost;
				$avgCostUpd->dbUpdRec($avgUpd);					
			}

		}

		$this->errorCode = $avgCostUpd->errorCode;
		if ($this->errorCode != 0)
		{
			$this->errorCodeText[count($this->errorCodeText)] = $this->errorCode . " Avergage cost error " . $nameId . " during update";
			
		}
		$this->invDim = $invDim;
		$this->avgCostUpd = $avgCostUpd;
	
	}
	
	function updateFinalSteps($delID)
	{

		$tFnc = new AB_querySession;
		$cUser = $tFnc->getUserData();
				
		$recSet = $this->invoices->result;
		$orheObj = $recSet[0];
		$orheObj["PROCESS"] = $this->processId;
		$orheObj["SESSION"] = $this->sessionId;
		
  		$wTbls = new dbMaster("vpu_orhe",$this->tblInfo->schema);
  		$wTbls->brTrConn = $this->masterTranConn;
		$wTbls->dbUpdRec($orheObj);
		$this->errorCode = $wTbls->errorCode;
		if ($this->errorCode != 0)
		{
			$this->errorCodeText[count($this->errorCodeText)] = $this->errorCode . " Someone updated order " . $orheObj["VPU_ORHE_ORNUM"] . " during update";
			return;
		}


		$orsiObj = array();
		$orsiObj["PROCESS"] = $this->processId;
		$orsiObj["SESSION"] = $this->sessionId;

		
		$orsiObj["VPU_ORSI_STEPS"] = "JJ_INVO";
		$orsiObj["VPU_ORSI_GRPID"] = $this->VAP_OIHE_INVOI;
		$orsiObj["VPU_ORSI_USLNC"] = $cUser["userCode"];
		$orsiObj["VPU_ORSI_ORNUM"] = $recSet[0]["idVPU_ORHE"];
		$orsiObj["VPU_ORSI_PROCE"] = "1";
		$insertId = array();
		
  		$wTbls = new dbMaster("vpu_orsi",$this->tblInfo->schema);
  		$wTbls->brTrConn = $this->masterTranConn;
		$wTbls->dbInsRec($orsiObj);		
		$insertId[0] = $wTbls->insertId;
		$this->errorCode = $wTbls->errorCode;
		
		// $this->errorCode = 222; // test
		
		if ($this->errorCode != 0 || $wTbls->insertId == 0)
		{
			if ($this->errorCode == 0)
			{
				$this->errorCode = 12;
			}
			$this->errorCodeText[count($this->errorCodeText)] = $this->errorCode . " error updating vpu_orsi";
		}
		else
		{
			$orsiObj["VPU_ORSI_STEPS"] = "KK_PURG";
			$orsiObj["VPU_ORSI_GRPID"] = $this->VGL_JNHE_TRNID;

	  		$wTbls = new dbMaster("vpu_orsi",$this->tblInfo->schema);
	  		$wTbls->brTrConn = $this->masterTranConn;
			$wTbls->dbInsRec($orsiObj);		
			$insertId[1] = $wTbls->insertId;
	
			$this->errorCode = $wTbls->errorCode;
			if ($this->errorCode != 0 || $wTbls->insertId == 0)
			{
				if ($this->errorCode == 0)
				{
					$this->errorCode = 12;
				}
				$this->errorCodeText[count($this->errorCodeText)] = $this->errorCode . " error updating vpu_orsi";
			}
		}
		
		
		$orstObj = array();
		$orstObj["PROCESS"] = $this->processId;
		$orstObj["SESSION"] = $this->sessionId;
		
		$orstList = "";
		$occ = 0;
		while ($occ < count($recSet) && $insertId > 0 && $this->errorCode == 0)
		{
			if (strpos("x," . $orstList . "," , "," . $recSet[$occ]["idVPU_ORST"] . ",") < 1 && $recSet[$occ]["VPU_ORST_DELID"] == $delID && $recSet[$occ]["VPU_ORST_STEPS"] == "JJ_INVO")
			{
				$orstList .= "," . $recSet[$occ]["idVPU_ORST"];
				
				$orstObj["idVPU_ORST"] = $recSet[$occ]["idVPU_ORST"];
				$orstObj["VPU_ORST_STEPS"] = "QQ_PURG";
				$orstObj["VPU_ORST_DDATE"] = $this->getDateFormed();
				$orstObj["VPU_ORST_WINVO"] = $insertId[0];
				// $orstObj["VPU_ORST_ARCID"] = $insertId[1];
		  		$wTbls = new dbMaster("vpu_orst",$this->tblInfo->schema);
		  		$wTbls->brTrConn = $this->masterTranConn;
				$wTbls->dbUpdRec($orstObj);		
				$this->errorCode = $wTbls->errorCode;
				
				if ($this->errorCode!=0 )
				{
					$this->orstPost = $orstObj;
					$this->orstTbl = $wTbls;
					$this->errorCodeText[count($this->errorCodeText)] = $this->errorCode . " error updating vpu_orst";
				}
			}
		
			$occ += 1;
		}
		
		
		
	}


}


class vpu_invoice extends dbMaster
{
	function vpu_invoice($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
	}


	function dbUpdRec($dtaObj)
	{

		$this->mainPost = $dtaObj;
		
		$deliveryID = explode(",",$dtaObj["deliveryID"]);
		if (trim($dtaObj["deliveryID"])=="")
		{
			$this->errorCode = 67;
			$this->errorCodeText[count($this->errorCodeText)] = " delivery ID's are invalid ";
		}		
		
		$this->postRecords = array();
		
		$postOcc = 0;
		while ($postOcc < count($deliveryID) && $this->errorCode == 0)
		{
		
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
			
			// One at a time 	
			$dtaObj["deliveryID"] = $deliveryID[$postOcc];
			$this->postRecords[$postOcc] = $dtaObj;
			
	  		$wTblsORHE = new vpu_orhe($this->tblInfo->schema);
	  		$wTblsORHE->brTrConn = $this->masterTranConn;
	  		$wTblsORHE->updDelivery($dtaObj);
			foreach($wTblsORHE as $name => $value)
			{
				 $this->$name = $value;
			}
			$this->postingSet = $wTblsORHE;				
			$this->dbFnct = "dbUpdRec";
			
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
		
			$postOcc += 1;
			
		}		
		
	}

	function dbFindMatch($dtaobj)
	{
		
		
		$dtaObj["MAXREC_OUT"] = 0; // No limit
		$dtaObj["idVPU_ORHE"] = "0";
  		$wTbls = new vpu_invoiceRead($this->tblInfo->schema);
		$wTbls->dbFindFrom($dtaObj);
		
		
		$comma = "";
		$rString = "";
		$occ = 0;
		while ($occ < count($wTbls->result))
		{
			if (strpos("x," . $rString . "," , "," . $wTbls->result[$occ]["VPU_ORST_DELID"] . ",") < 1)
			{
				$rString .= $comma . $wTbls->result[$occ]["VPU_ORST_DELID"];
				$comma = ",";
			}
			$occ += 1;
		}
		
		$dtaObj["getTotals"] = true;
		$dtaObj["deliveryID"] = $rString;
  		$wTblsORHE = new vpu_orhe($this->tblInfo->schema);
  		$wTblsORHE->updDelivery($dtaObj);
		$wTbls->postingSet = $wTblsORHE;
		
 		$pSet = $wTbls->postingSet->updResult;
 		$pSetResult = array();
 		$occ = 0;
 		while ($occ < count($pSet))
 		{
 			$pSetResult[$occ]["VPU_ORST_DELID"] = $pSet[$occ]["dtaSet"]["vpu_orhe"]["VPU_ORST_DELID"];
 			$pSetResult[$occ]["TOTPURCH"] = $pSet[$occ]["dtaSet"]["TOTPURCH"] + $pSet[$occ]["dtaSet"]["EXPCHARGED"];
 			$pSetResult[$occ]["TAXES"] = "";
 			$wocc = 0;
 			while($wocc < count($pSet[$occ]["dtaSet"]["TAXES"]))
 			{
 				$pSetResult[$occ]["TAXES"] .= "[" . $pSet[$occ]["dtaSet"]["TAXES"][$wocc]["VTX_SCHE_SEQDE"] . ":" . $pSet[$occ]["dtaSet"]["TAXES"][$wocc]["GLAMT"] . "]";
 				
 				$wocc += 1;
 			}
 			
 			$occ += 1;
 		}
		$wTbls->pSetResult = $pSetResult;
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vpu_totals"]["result"] = $pSetResult;
		
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
		
		
	}
}


class vpu_invoiceRead extends dbMaster
{
	function vpu_invoiceRead($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
	}
	
	function dbSetTrig()
	{

		$localWhere = "";
		$localJoin = "";
		
		if ($this->E_POST["deliveryID"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["deliveryID"]);
			if(count($wClause)>0)
			{
				$localWhere = " ( ";
				$orVal = "";
				$occ = 0;
				while ($occ < count($wClause))
				{
					$localWhere .= $orVal . "VPU_ORST_DELID = '" . $wClause[$occ] . "' ";
					$orVal = " OR  ";
					$occ += 1;
				} 

				$localWhere .= " ) AND ";

			}

		}
		else
		{

$localJoin = <<<EOD
	
			LEFT JOIN vgb_supp  ON idVGB_SUPP = VPU_ORHE_BTCUS  [=COND:vgb_supp=]
			LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_SUPP_BPART  [=COND:vgb_bpar=]
			LEFT JOIN vpu_orsi  ON idVPU_ORSI = VPU_ORST_PAKID  [=COND:vpu_orsi=]
			
EOD;

		}

$trig = <<<EOD
			SELECT *, (@aa:= VPU_ORST_ORDQT * VPU_ORDE_OUNET) as EXTENSION FROM  
			 
		 	( SELECT * FROM vpu_orhe  
		LEFT JOIN vpu_orde  ON idVPU_ORHE = VPU_ORDE_ORNUM  [=COND:vpu_orde=]
		LEFT JOIN vin_item  ON idVIN_ITEM = VPU_ORDE_ITMID  [=COND:vin_item=]
		LEFT JOIN vin_itmwar  ON VIN_ITMWAR_ITMID = VPU_ORDE_ITMID && VIN_ITMWAR_WARID = VPU_ORDE_WARID [=COND:vin_itmwar=] 
		LEFT JOIN vpu_orst  ON idVPU_ORDE = VPU_ORST_ORLIN  [=COND:vpu_orst=]
	
		$localJoin
								
		WHERE $localWhere VPU_ORST_STEPS = 'JJ_INVO' AND [=WHERE=]  [=COND:vpu_orhe=] ORDER BY VPU_ORST_DELID [=LIMIT=] )  tx		

		
EOD;


		return $trig;
		
	}
	



	
}




class vpu_orheXXX extends dbMaster
{

	function vpu_orheXXX($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
	}

	
	function dbFindMatch($dtaObj)
	{
  		
  		$dtaObj["MAXREC_OUT"] = 0; // No limit
  		$wTbls = new vpu_orhe($this->tblInfo->schema);
		$wTbls->dbFindMatch($dtaObj);
		
		$E_POST = $dtaObj;
		$this->E_POST = $E_POST;
		
		$tmp = array();
		foreach($wTbls as $name => $value)
		{
			 $tmp[$name] = $value;
		}

 

		/*
		Step: vin_inventory from VIN_INVENTORY object vin_invent_items [idVIN_ITEM]
		Step: vin_item_lots from VIN_ITEMS object vin_item_lots [idVIN_ITEM]
		Step: vin_item_specs from VIN_ITEMS object vin_item_specs [idVIN_ITEM]
		*/

		
		if ($wTbls->errorCode == 0 && $E_POST["PROCESS"] == "VPU_ORDERS")
		{
		
	
			$occ = 0;
			while ($occ < count($wTbls->result) )
			{

				if($wTbls->result[$occ]["VPU_ORDE_ITMID"])
				{
					$wItmId = $wTbls->result[$occ]["VPU_ORDE_ITMID"];
					// Get inventory for all Items
					if (strpos("x," . $vinItemList . "," , "," . $wItmId . "," ) < 1)
					{
						if(!$vinItemList)
						{
							$vinItemList = $wItmId;
						}
						else
						{
							$vinItemList .= "," . $wItmId;
						}
					}
					

				}
						
				$occ += 1;
				
			}
			
			$this->vinItemList = $vinItemList;

 	 		$objPost = array();
 	 		$objPost["PROCESS"] = $E_POST["PROCESS"];
 	 		$objPost["SESSION"] = $E_POST["SESSION"];
 	 		$objPost["MAXREC_OUT"] = 0; // No limit
 	 		$objPost["idVIN_ITEM"] = '0';
			
	  		if (strlen($vinItemList)>0)
	  		{
	 	 		
	 	 		// Inventory
	 	 		$wTblsInve = new vin_inveQuery($this->tblInfo->schema);
	 	 		$objPost["vin_inveQuery"] = $vinItemList;
	 	 		$wTblsInve->dbFindFrom($objPost);
	 	 		if (!$wTbls->dbSuppTbl)
	 	 		{
	 	 			$wTbls->dbSuppTbl = array();
	 	 		}
				$wTbls->dbSuppTbl["vin_inve"] = $wTblsInve;


	 	 		// Lots
	 	 		$wTblsLots = new vin_item_lots($this->tblInfo->schema);
	 	 		$objPost["vin_item_lots"] = $vinItemList;
	 	 		$wTblsLots->dbFindFrom($objPost);
	 	 		if (!$wTbls->dbSuppTbl)
	 	 		{
	 	 			$wTbls->dbSuppTbl = array();
	 	 		}
				$wTbls->dbSuppTbl["vin_item_vin_lshe"] = $wTblsLots;
				
				// Specs
				$wTblsSpecs = new vin_item_specs($this->tblInfo->schema);
	 	 		$objPost["vin_item_specs"] = $vinItemList;
	 	 		$wTblsSpecs->dbFindFrom($objPost);
	 	 		if (!$wTbls->dbSuppTbl)
	 	 		{
	 	 			$wTbls->dbSuppTbl = array();
	 	 		}
				$wTbls->dbSuppTbl["vin_item_ssma"] = $wTblsSpecs;
				

				
					 	 		
	 	 	}
			
		}

		// vpu_orheLSTR
		$wTblsLstr = new vpu_orheLstr($this->tblInfo->schema);
 		$objPost["idVPU_ORHE"] = $wTbls->result[0]["idVPU_ORHE"];;
 		$wTblsLstr->dbFindMatch($objPost);
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vpu_orheLSTR"] = $wTblsLstr;
		
		// Orhe Taxes
		$wTblsTax = new vpu_orheTax($this->tblInfo->schema);
 		$objPost["idVPU_ORHE"] = $wTbls->result[0]["idVPU_ORHE"];;
 		$wTblsTax->dbFindMatch($objPost);
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vpu_orheTax"] = $wTblsTax;



		// Supplier Address
		$wTblsAddr = new vgb_addr($this->tblInfo->schema);
 		// $objPost["VGB_ADDR_BPART"] = $wTbls->result[0]["idVGB_BPAR"];
 		$objPost["VGB_ADDR_BPART"] = "0";
 		$objPost["vgb_bpar_list"] = $wTbls->result[0]["idVGB_BPAR"].",".$wTbls->result[0]["VPU_ORHE_STCUS"];
 		$wTblsAddr->dbFindFrom($objPost);
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vgb_addr"] = $wTblsAddr;

		// Customer Items
		$wTblsCitm = new vin_cust($this->tblInfo->schema);
 		$objPost["VIN_CUST_SUPPL"] = $wTbls->result[0]["VPU_ORHE_BTCUS"];;
 		$wTblsCitm->dbFindMatch($objPost);
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vin_cust"] = $wTblsCitm;		 
				
		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vpu_orhe"] = $tmp;
		

		
		// Set order Step status
//		$wTbls->dbEVAL= $this->IV_VPU_STEP_EVAL($wTbls->result[0]["VPU_ORHE_ORSTP"],$wTbls->result);
//
//		$occ = 0;
//		while ($occ < count($wTbls->result))
//		{
//			$wTbls->result[$occ]["IV_VPU_STEPS_VALID"] = $wTbls->dbEVAL[0]["OrderStatus"]["IV_VPU_STEPS_VALID"] ;
//			
//			$occ += 1;
//		}

		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
	

		
	}
}

class vpu_orheYYY extends dbMaster
{

	function vpu_orheYYY($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
	}


	function dbSetTrig()
	{


$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vpu_orhe  
		LEFT JOIN vpu_orde  ON idVPU_ORHE = VPU_ORDE_ORNUM  [=COND:vpu_orde=] 
		LEFT JOIN vpu_orst  ON idVPU_ORDE = VPU_ORST_ORLIN  [=COND:vpu_orst=]
		LEFT JOIN vpu_lstr  ON idVPU_ORST = VPU_LSTR_STPSQ  [=COND:vpu_lstr=]
								
		WHERE [=WHERE=]  [=COND:vpu_orhe=] [=LIMIT=] )  tx		

		
EOD;


		return $trig;
		
	}

}


require_once "VGB_PARTNERS.php";
require_once "VIN_ITEMS.php"; 
require_once "VIN_INVENTORY.php";
require_once "VGB_GETNFNU.php";
require_once "VAP_FINANCE.php";

?>