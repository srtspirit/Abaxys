<?php

class vin_orheFindMatch extends dbMaster
{
	function vin_orheFindMatch($schema)
	{
		$this->dbMaster("vin_orhe",$schema);
		$this->dual = "vin_orheFindMatch";
	}

	function dbSetTrig()
	{

		$this->ABselect = $this->ABsetField("vin_orhe,vin_orde,vin_lstr,vin_item,vin_wars,vin_itmwar,vin_locs,vin_uset,vin_unit");
		// SELECT {$this->ABselect} FROM


$trig = <<<EOD
			
			 
		 	 SELECT {$this->ABselect} FROM vin_orhe 
		LEFT JOIN vin_orde  ON idVIN_ORHE = VIN_ORDE_ORNUM  [=COND:vin_orde=] 
		LEFT JOIN vin_lstr  ON idVIN_ORHE = VIN_LSTR_ORNUM AND idVIN_ORDE = VIN_LSTR_ORLIN  [=COND:vin_lstr=]
		LEFT JOIN vin_item  ON idVIN_ITEM = VIN_ORDE_ITMID  [=COND:vin_item=]
		LEFT JOIN vin_wars  ON idVIN_WARS = VIN_ORDE_WARID  [=COND:vin_wars=]
		LEFT JOIN vin_itmwar  ON VIN_ITMWAR_ITMID = VIN_ORDE_ITMID AND VIN_ITMWAR_WARID = VIN_ORDE_WARID  [=COND:vin_itmwar=]
		LEFT JOIN vin_locs  ON idVIN_LOCS = VIN_ORDE_LOCID  [=COND:vin_locs=]
		LEFT JOIN vin_uset  ON idVIN_USET = VIN_ORDE_UNSET  [=COND:vin_uset=]
		LEFT JOIN vin_unit  ON idVIN_UNIT = VIN_ORDE_QTUOM  [=COND:vin_unit=]
								
		WHERE [=WHERE=]  [=COND:vin_orhe=]  [=LIMIT=] 		
	

		
EOD;

		
		
		return $trig;
		
	}
	
}



class vin_orheOriginalVal extends dbMaster
{
	function vin_orheOriginalVal($schema)
	{
		$this->dbMaster("vin_orhe",$schema);
	}

	


	function dbSetTrig()
	{

$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vin_orhe 
		LEFT JOIN vin_orde  ON idVIN_ORHE = VIN_ORDE_ORNUM  [=COND:vin_orde=]
		LEFT JOIN vin_lstr  ON idVIN_ORHE = VIN_LSTR_ORNUM AND idVIN_ORDE = VIN_LSTR_ORLIN  [=COND:vin_lstr=] 
								
		WHERE [=WHERE=]  [=COND:vin_orhe=]  [=LIMIT=] ) tx		

		
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
		$this->dbSuppTbl["vin_users_process"] = $wTbls;
		$proc = $wTbls->result[0]["CFG_PROCESS_ID"];

		$pObj["CFG_SESSION_CODE"] = $pObj["SESSION"];
		$wTbls = new dbMaster("cfg_session",$this->tblInfo->schema);
		$wTbls->dbFindMatch($pObj);
		$this->dbSuppTbl["vin_users_session"] = $wTbls;
		$sess = $wTbls->result[0]["CFG_SESSION_ID"];
		
		$pObj["CFG_GRPCONFIG_PROCESS"] = $proc;
		$pObj["CFG_GRPCONFIG_SESSION"] = $sess;
		$wTbls = new dbMaster("cfg_grpconfig",$this->tblInfo->schema);
		$wTbls->dbFindMatch($pObj);
		$this->dbSuppTbl["vin_users_config"] = $wTbls;
		
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
		$this->dbSuppTbl["vin_users_group"] = $wTbls;
		
		
		$occ = 0;
		
		

$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM cfg_users  
		
								
		WHERE [=WHERE=]  AND {$localWhere}  [=COND:cfg_users=] ORDER BY CFG_USERS_DESIGNATION ASC  [=LIMIT=] )  tx		

		
EOD;


		return $trig;		
		
	}
	
	
}


class vin_uset_inv extends dbMaster
{
	function vin_uset_inv($schema)
	{
		$this->dbMaster("vin_uset",$schema);
	}
	
	

	function dbSetTrig()
	{


$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vin_uset 

		LEFT JOIN vin_unit  ON idVIN_USET = VIN_UNIT_UNSET  [=COND:vin_unit=] 
								
		WHERE [=WHERE=]  [=COND:vin_uset=]  [=LIMIT=] ) tx		

		
EOD;


		return $trig;
		
		
		
	}	

}

class vin_wars_inv extends dbMaster
{
	function vin_wars_inv($schema)
	{
		$this->dbMaster("vin_wars",$schema);
	}

		function dbSetTrig()
	{

$trig = <<<EOD


		SELECT * FROM

		(SELECT * FROM vin_wars 

		LEFT JOIN vin_locs ON VIN_LOCS_WARID = idVIN_WARS [=COND:vin_locs=] 					
		
		WHERE [=WHERE=] [=COND:vin_wars=] [=LIMIT=] ) tx		
		
EOD;
	
	return $trig;
	
  }
  
}


class vin_orhe extends dbMaster
{
	function vin_orhe($schema)
	{
		$this->dbMaster("vin_orhe",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}


	function dbSetTrig()
	{

		$this->ABselect = $this->ABsetField("vin_orhe,vin_orde,vin_lstr,vin_item,vin_lshe,vin_wars,vin_itmwar,vin_locs,vin_uset,vin_unit");
		// SELECT * FROM  
		
$trig = <<<EOD
			
			 
		SELECT {$this->ABselect} FROM vin_orhe  

		LEFT JOIN vin_orde  ON idVIN_ORHE = VIN_ORDE_ORNUM  [=COND:vin_orde=] 
		LEFT JOIN vin_lstr  ON idVIN_ORHE = VIN_LSTR_ORNUM AND idVIN_ORDE = VIN_LSTR_ORLIN  [=COND:vin_lstr=]
		LEFT JOIN vin_item  ON idVIN_ITEM = VIN_ORDE_ITMID  [=COND:vin_item=]
		LEFT JOIN vin_lshe  ON idVIN_LSHE = VIN_LSTR_LOTSQ  [=COND:vin_lshe=]
		LEFT JOIN vin_wars  ON idVIN_WARS = VIN_ORDE_WARID  [=COND:vin_wars=]
		LEFT JOIN vin_itmwar  ON VIN_ITMWAR_ITMID = VIN_ORDE_ITMID AND VIN_ITMWAR_WARID = VIN_ORDE_WARID  [=COND:vin_itmwar=]
		LEFT JOIN vin_locs  ON idVIN_LOCS = VIN_ORDE_LOCID  [=COND:vin_locs=]
		LEFT JOIN vin_uset  ON idVIN_USET = VIN_ORDE_UNSET  [=COND:vin_uset=]
		LEFT JOIN vin_unit  ON idVIN_UNIT = VIN_ORDE_QTUOM  [=COND:vin_unit=]
								
		WHERE [=WHERE=]  [=COND:vin_orhe=]  [=LIMIT=] 

		
EOD;


		return $trig;
		
	}

	
	function dbFindMatch($dtaObj)
	{
  		
  		
  		$wTbls = new vin_orheFindMatch($this->tblInfo->schema);
		$wTbls->dbFindMatch($dtaObj);
		
		$this->localPost = $dtaObj;
		$E_POST = $dtaObj;

		if ($wTbls->errorCode == 0 && $E_POST["PROCESS"] == "VIN_TRANSAC" && $E_POST["SESSION"] == "VIN_ORHECT")
		{
		
	
			$occ = 0;
			while ($occ < count($wTbls->result) )
			{

				if($wTbls->result[$occ]["idVIN_ITEM"])
				{
					$wItmId = $wTbls->result[$occ]["idVIN_ITEM"];
					// Get inventory for all Items
					if (strpos("x," . $vinItemListInv . "," , "," . $wItmId . "," ) < 1)
					{
						if(!$vinItemListInv)
						{
							$vinItemListInv = $wItmId;
						}
						else
						{
							$vinItemListInv .= "," . $wItmId;
						}
					}
					
					// Get lots for all Lot Items
					if (strpos("x," . $vinItemListLots . "," , "," . $wItmId . "," ) < 1 && $wTbls->result[$occ]["VIN_ITEM_LOTCT"] == 1)
					{
						if(!$vinItemListLots)
						{
							$vinItemListLots = $wItmId;
						}
						else
						{
							$vinItemListLots .= "," . $wItmId;
						}
					}
				}
						
				$occ += 1;
				
			}
			
	  		if (strlen($vinItemListLots)>0)
	  		{
	 	 		$wTblsLots = new vin_item_lots($this->tblInfo->schema);
	 	 		$objLots = array();
	 	 		$objLots["PROCESS"] = $E_POST["PROCESS"];
	 	 		$objLots["SESSION"] = $E_POST["SESSION"];
	 	 		$objLots["MAXREC_OUT"] = 0; // No limit
	 	 		$objLots["idVIN_ITEM"] = '0';
	 	 		$objLots["vin_item_lots"] = $vinItemListLots;
	 	 		$wTblsLots->dbFindFrom($objLots);
	 	 		if (!$wTbls->dbSuppTbl)
	 	 		{
	 	 			$wTbls->dbSuppTbl = array();
	 	 		}
				$wTbls->dbSuppTbl["vin_item_lots"] = $wTblsLots;	 	 		
	 	 	}
 	 		
	  		if (strlen($vinItemListInv)>0)
	  		{
	 	 		$wTblsInv = new vin_item_inv($this->tblInfo->schema);
	 	 		$objInv = array();
	 	 		$objInv["PROCESS"] = $E_POST["PROCESS"];
	 	 		$objInv["SESSION"] = $E_POST["SESSION"];
	 	 		$objInv["MAXREC_OUT"] = 0; // No limit
	 	 		$objInv["idVIN_ITEM"] = '0';
	 	 		$objInv["vin_item_inv"] = $vinItemListInv;
	 	 		$wTblsInv->dbFindFrom($objInv);
	 	 		if (!$wTbls->dbSuppTbl)
	 	 		{
	 	 			$wTbls->dbSuppTbl = array();
	 	 		}
				$wTbls->dbSuppTbl["vin_item_inv"] = $wTblsInv;
	 	 	}
 	 		

			if ($wTbls->result[0]["VIN_ORHE_TRNID"])
			{			
				// General Ledger
				$vglObj = array();
				$vglObj["PROCESS"] = $E_POST["PROCESS"];
				$vglObj["SESSION"] = $E_POST["SESSION"];
		 		$vglObj["idVGL_JNHE"] = $wTbls->result[0]["VIN_ORHE_TRNID"];
		 		$wTblsJrn = new vgl_journal($this->tblInfo->schema);
		 		$wTblsJrn->dbFindMatch($vglObj);
		 		if (!$wTbls->dbSuppTbl)
		 		{
		 			$wTbls->dbSuppTbl = array();
		 		}
				$wTbls->dbSuppTbl["vgl_journal"] = $wTblsJrn;	
			}
			
			
			if(count($wTbls->result) > 0)
			{
				
				$occ = 0;
				while ($occ < 10)
				{
					$newRec = $wTbls->result[0];
					$newRec["idVIN_ORDE"] = 0;
					$newRec["VIN_ORDE_ORNUM"] = $newRec["idVIN_ORHE"];
					$newRec["VIN_ORDE_ORLIN"] = ($occ+1) * -1;
					$wTbls->result[count($wTbls->result)] = $newRec;
					$occ += 1;
				}
			}
		}
		
  		//Get Unit of Measure
  		$wTblsUset = new vin_uset_inv($this->tblInfo->schema);
 		$objUOM = array();
 		$objUOM["PROCESS"] = $E_POST["PROCESS"];
 		$objUOM["SESSION"] = $E_POST["SESSION"];
 		$objUOM["MAXREC_OUT"] = '0'; // No limit
 		$objUOM["idVIN_USET"] = '0';
  		$wTblsUset->dbFindFrom($objUOM);		
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vin_item_UOM"] = $wTblsUset;

		// Get Warehouse / Locations
  		$wTblsWars = new vin_wars_inv($this->tblInfo->schema);
 		$objwar = array();
 		$objwar["PROCESS"] = $E_POST["PROCESS"];
 		$objwar["SESSION"] = $E_POST["SESSION"];
 		$objwar["MAXREC_OUT"] = '0'; // No limit
 		$objwar["idVIN_WARS"] = '0';
  		$wTblsWars->dbFindFrom($objwar);		
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vin_item_WAR"] = $wTblsWars;	
	
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
	

		
	}	
	
	function groupObjById()
	{

		$occ = 0;
		while ($occ < count($this->ordeOrg) )
		{
			if(!$this->OriginalData["vin_orhe"][$this->ordeOrg[$occ]["idVIN_ORHE"]] )
			{
				$this->OriginalData["vin_orhe"][$this->ordeOrg[$occ]["idVIN_ORHE"]] = $this->extractTableField("VIN_ORHE",$this->ordeOrg[$occ]);
			}
			
			if(!$this->OriginalData["vin_orde"][$this->ordeOrg[$occ]["idVIN_ORDE"]])
			{
				$this->OriginalData["vin_orde"][$this->ordeOrg[$occ]["idVIN_ORDE"]] = $this->extractTableField("VIN_ORDE",$this->ordeOrg[$occ]);
			}
			
			if($this->ordeOrg[$occ]["idVIN_LSTR"]  && !$this->OriginalData["vin_lstr"][$this->ordeOrg[$occ]["idVIN_ORDE"]."-".$this->ordeOrg[$occ]["idVIN_LSTR"]])
			{
				$this->OriginalData["vin_lstr"][$this->ordeOrg[$occ]["idVIN_ORDE"]."-".$this->ordeOrg[$occ]["idVIN_LSTR"]] = $this->extractTableField("VIN_LSTR",$this->ordeOrg[$occ]);
			}			
			
			$occ += 1;
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
		
		return $newObj;
	}
	
	function objAreEqual($objB,$fMatch,$keyName)
	{
		$result = true;
		
		
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
				
			}
		}		
		
		return $result;
		
	}


	function dbInsRec($dtaObj)
	{
		$tFnc = new AB_querySession;
		$cUser = $tFnc->getUserData();
		
		$dtaObj["VIN_ORHE_USLNA"] = $cUser["userCode"];
		
		$this->dbMasterTransac();
		$this->errorCodeText = array();
		if ($this->transactionError > 0)
		{
			$this->errorCode = 9300;
			$this->errorCodeText[count($this->errorCodeText)] = "Transaction failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Could not connect ";
			$this->dbFnct = "dbInsRec";

			return;
		}

		$E_POST = $dtaObj;
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		$this->E_POST = $E_POST;
		
		$nfnu = new vgb_getNextFreeNumber($this->tblInfo->schema,"VIN_ORHE" ,$this->E_POST,$this->masterTranConn);
		$dtaObj["VIN_ORHE_ORNUM"] = $nfnu->vgb_nextNumber;

	  	$wTbls = new dbMaster("vin_orhe",$this->tblInfo->schema);
	  	$wTbls->brTrConn = $this->masterTranConn;
	  	if ($dtaObj["idVIN_ORHE"] == '0')
	  	{
	  		$dtaObj["idVIN_ORHE"] = '';
	  	}
	  		
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
	
	function dbProcessTransaction()
	{
		
		// Currently processing only one type of trancation (Inventory Adjustments)
		// Sales - Purchase - Tranfers  
		// Need to accumulate byItem,Lot,wars,location,
		
		$orheRec = $this->OriginalData["vin_orhe"];
		if ($orheRec["VIN_ORHE_PROCESS"] == "1")
		{
			$this->errorCode="9988";
			$this->errorCodeText[count($this->errorCodeText)] = "Transaction already processed";
			return;
		}
		
		$ordeRec = $this->OriginalData["vin_orde"];
		$lstrRec = $this->OriginalData["vin_lstr"];
		
		$this->updateDataSet = array();
		
		
		foreach($ordeRec as $tblName => &$ordeObj)
		{
			$IWL_id = $ordeObj['VIN_ORDE_ITMID']."-".$ordeObj['VIN_ORDE_WARID']."-".$ordeObj['VIN_ORDE_LOCID'];
			if (!$this->updateDataSet[$IWL_id])
			{
				$this->updateDataSet[$IWL_id] = array();
				$this->updateDataSet[$IWL_id]["tblName"] = "vin_inve";
				
				$this->updateDataSet[$IWL_id]["VIN_INVE_ITMID"] = $ordeObj['VIN_ORDE_ITMID'];
				$this->updateDataSet[$IWL_id]["VIN_INVE_WARID"] = $ordeObj['VIN_ORDE_WARID'];
				$this->updateDataSet[$IWL_id]["VIN_INVE_LOCID"] = $ordeObj['VIN_ORDE_LOCID'];

				$this->updateDataSet[$IWL_id]["VIN_INVE_BOHQT"] = 0;
				$this->updateDataSet[$IWL_id]["VIN_INVE_ALOQT"] = 0;
				$this->updateDataSet[$IWL_id]["VIN_INVE_PURQT"] = 0;
			}
			
			$this->updateDataSet[$IWL_id]["VIN_INVE_BOHQT"] += ($ordeObj['VIN_ORDE_ORDQT']*1);
			
			if ($lstrRec)
			{
				foreach($lstrRec as $lstName => $lstrObj)
				{
					if ($lstrObj["VIN_LSTR_ORLIN"] == $ordeObj["idVIN_ORDE"])
					{
						$ILWL_id = $ordeObj['VIN_ORDE_ITMID']."-".$lstrObj['VIN_LSTR_LOTSQ']."-".$ordeObj['VIN_ORDE_WARID']."-".$ordeObj['VIN_ORDE_LOCID'];
						if (!$this->updateDataSet[$ILWL_id])
						{
							$this->updateDataSet[$ILWL_id] = array();
							$this->updateDataSet[$ILWL_id]["tblName"] = "vin_lslq";
							
							
							$this->updateDataSet[$ILWL_id]["VIN_LSLQ_ITMID"] = $ordeObj['VIN_ORDE_ITMID'];
							$this->updateDataSet[$ILWL_id]["VIN_LSLQ_WARID"] = $ordeObj['VIN_ORDE_WARID'];
							$this->updateDataSet[$ILWL_id]["VIN_LSLQ_LOCID"] = $ordeObj['VIN_ORDE_LOCID'];
							
							$this->updateDataSet[$ILWL_id]["VIN_LSLQ_LOTSQ"] = $lstrObj['VIN_LSTR_LOTSQ'];
							$this->updateDataSet[$ILWL_id]["VIN_LSLQ_BOHQT"] = 0;
							$this->updateDataSet[$ILWL_id]["VIN_LSLQ_ALOQT"] = 0;
							$this->updateDataSet[$ILWL_id]["VIN_LSLQ_PURQT"] = 0;
						}			
						
						$this->updateDataSet[$ILWL_id]["VIN_LSLQ_BOHQT"] += ($lstrObj['VIN_LSTR_ALOQT']*1);
					}
					
				}
			}
					
		}	

		$wTbls = new vin_inventory($this->tblInfo->schema);
		$wTbls->masterTranConn = $this->masterTranConn;
		$wTbls->TV_VIN_TRANSACTION("adjust",$this->updateDataSet);
		$this->errorCode += $wTbls->errorCode;
		$this->updateDataUpd = $wTbls;
	}



	function dbUpdRec($dtaObj)
	{

		$tFnc = new AB_querySession;
		$cUser = $tFnc->getUserData();
						
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
			
		$E_POST = $dtaObj;
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		$this->E_POST = $E_POST;

		// We need a current record list of all VIN_ORST 
		$tmpObj["PROCESS"] = $E_POST["PROCESS"];
		$tmpObj["SESSION"] = $E_POST["SESSION"];
		$tmpObj["TBLNAME"] = "vin_orhe";			
		$tmpObj["idVIN_ORHE"] = $dtaObj["idVIN_ORHE"];  		

  		$ordeOrg = new vin_orheOriginalVal($this->tblInfo->schema);
		$ordeOrg->dbFindMatch($tmpObj);
		
		$this->ordeOrg = $ordeOrg->result;
		
		$this->groupObjById();
		
		if ($E_POST["dbProcessTransaction"] == '1')
		{
			$this->dbProcessTransaction();
			$E_POST["VIN_ORHE_PROCESS"] = "1";
			$E_POST["VIN_ORHE_PROCDATE"] = $this->getDateFormed();
			$E_POST["VIN_ORHE_PROCBY"] = $cUser["userCode"];
			$dtaObj = $E_POST;
		}
		
		$wTbls = array();

		$this->validChange = "";


 		
//		if ($this->objAreEqual($E_POST,"vin_orhe","idVIN_ORHE") != true)
//  		{
//  			$this->headerUpd = $dtaObj;
//	  		$wTbls[0] = new dbMaster("vin_orhe",$this->tblInfo->schema);
//	  		$wTbls[0]->brTrConn = $this->masterTranConn;
//			$wTbls[0]->dbUpdRec($dtaObj);
//			
//		}
//		else
//		{
			$wTbls[0] = $ordeOrg;
			$wTbls[0]->fetchResult = $this->ordeOrg;
//		}		
//	
			
//		if(!$this->errorCode)
//		{
//			$this->errorCode = 10;
//			$this->errorInfo = "000000";
//		}
//		else
//		{
//			$this->errorCode = 20;
//		}

		

		
	
		$this->recBad = "";
		$this->recMod = "";
		$this->recNew = "";
				
		
		$recSet = $E_POST["RECSET"];
		
		$this->recSetPost = $recSet;
		
		$this->rsCount = array();

		// Validate all lots before. Aborts all if one not valid 
		$occ = 1;
		$lotValid = true;		
		
		while ($occ < count($recSet) && $lotValid == true)
		{
			if ($recSet[$occ]["idVIN_ORDE"] || $this->isNewId($recSet[$occ]["idVIN_ORDE"]) )
			{
				if ($recSet[$occ]["VIN_ITEM_LOTCT"] && $recSet[$occ]["VIN_ITEM_LOTCT"] >0 && $recSet[$occ]["trash"] != 1)
				{
					// $recSet[$occ]["VIN_ORDE_ORDQT"] = $this->getQtyVIN_LSTR($recSet[$occ]);
					// lot Item
				}
				$recSet[$occ]["lotValid"] = $lotValid;
				if($lotValid == false)
				{
					$this->errorCode = "9902";
					
					$orlin=$recSet[$occ]["VIN_ORDE_ORLIN"];
					$item =$recSet[$occ]["VIN_ITEM_ITMID"];
										
					$this->errorCodeText[count($this->errorCodeText)] = "9902 - Lot Qty not valid ";
					$this->rowCount  = 0;
					$this->dbFnct = "Lot Qty Validation ";
				}
			}
			
			$occ += 1;
		}
						
		$this->dimResult = array();
		$this->paccAccounts = array();
		$this->paccAccounts["INVENTORY"] = 0;
		$this->paccAccounts["INVENTADJ"] = 0;
		
		$occ = 1;
		while ($occ < count($recSet) && $this->errorCode == 0 )
		{
			$subwTbls = array();
			
			
			if ($recSet[$occ]["idVIN_ORDE"] || $this->isNewId($recSet[$occ]["idVIN_ORDE"]) )
			{
				$dbCount = count($wTbls);
				$recSet[$occ]["PROCESS"] = $E_POST["PROCESS"];
				$recSet[$occ]["SESSION"] = $E_POST["SESSION"];
				$recSet[$occ]["TBLNAME"] = "vin_orde";			
				
				$this->recSetPost[$occ] = $recSet[$occ];
				
				if ( $this->isNewId($recSet[$occ]["idVIN_ORDE"]) || $recSet[$occ]["ab-new"] == 1)
				{
					
					if ($recSet[$occ]["trash"] == 1)
					{
						// Nothing;
					}
					else
					{
				  		$wTbls[$dbCount] = new dbMaster("vin_orde",$this->tblInfo->schema);
				  		$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				  		$recSet[$occ] = $this->setDfltVIN_ORDE($recSet[$occ]);
				  		$this->defaultVIN_ORDE = $recSet[$occ];
				  		
						$wTbls[$dbCount]->dbInsRec($recSet[$occ]);
						$this->errorCode += $wTbls[$dbCount]->errorCode;
						
						$recSet[$occ]["idVIN_ORDE"] = $wTbls[$dbCount]->insertId;
						$this->recSetPost[$occ]["idVIN_ORDE"] = $recSet[$occ]["idVIN_ORDE"];
					
					}
				}
				else
				{
					if ($recSet[$occ]["trash"] == 1)
					{
						$delLstr = $this->deleteVIN_LSTR($recSet[$occ]);
				  		$wTbls[$dbCount] = new dbMaster("vin_orde",$this->tblInfo->schema);
				  		$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
						$wTbls[$dbCount]->dbDelRec($recSet[$occ]);
						$this->errorCode += $wTbls[$dbCount]->errorCode;
						$wTbls[$dbCount]->delLstr = $delLstr;

					}
					else
					{
				  		$wTbls[$dbCount] = new dbMaster("vin_orde",$this->tblInfo->schema);
				  		$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
						if ($this->objAreEqual($recSet[$occ],"vin_orde","idVIN_ORDE") != true)
				  		{				  		
							$wTbls[$dbCount]->dbUpdRec($recSet[$occ]);
							$this->errorCode += $wTbls[$dbCount]->errorCode;
						}
						
					}
				}
				 
				$lotUpdate = array();
				
				if ($recSet[$occ]["VIN_ITEM_LOTCT"] >0 && $recSet[$occ]["trash"] == 0)
				{
					
					// $lotUpdate = $this->updateVIN_LSTR($this->recSetPost[$occ]);
					$lotUpdate = $this->updateVIN_LSTR($recSet[$occ]);

					if (!$this->lotUpdate)
					{
						$this->lotUpdate = array();
					}
					$this->lotUpdate[count($this->lotUpdate)] = $lotUpdate;
					// lot Item
				}

				if ($E_POST["dbProcessTransaction"] == '1')
				{			
					$this->updateInventValue($recSet[$occ],$E_POST);
				}				
			}
			else
			{
			}
			if (count($lotUpdate) > 0)
			{
				$wTbls[$dbCount]->RSLotUpdate = $lotUpdate;
			}
			$this->rsCount[$occ-1] = $recSet[$occ];

			
			$occ += 1;
		}
	
		if ($E_POST["dbProcessTransaction"] == '1' && $this->paccAccounts["INVENTORY"] != 0)
		{
			$this->updateFinancial($E_POST);
		}

		if ($this->objAreEqual($E_POST,"vin_orhe","idVIN_ORHE") != true && $this->errorCode == 0)
  		{
  			$this->headerUpd = $dtaObj;
  			$dbCount = count($wTbls);
	  		$wTbls[$dbCount] = new dbMaster("vin_orhe",$this->tblInfo->schema);
	  		$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
	  		if ($this->vgl_trans->insertId)
	  		{
	  			$dtaObj["VIN_ORHE_TRNID"] = $this->vgl_trans->insertId;
	  		}
	  		
			$wTbls[$dbCount]->dbUpdRec($dtaObj);
			$this->errorCode = $wTbls[$dbCount]->errorCode;
			foreach($wTbls[$dbCount] as $name => $value)
			{
				 $this->$name = $value;
			}
			
			$this->Mresults = $wTbls[$dbCount];
		}
		else
		{
			if ($this->errorCode == 0)
			{
				$dbCount = count($wTbls);
				$wTbls[$dbCount] = $ordeOrg;
				$wTbls[$dbCount]->fetchResult = $this->ordeOrg;
				foreach($wTbls[$dbCount] as $name => $value)
				{
					 $this->$name = $value;
				}
	
				$this->Mresults = $wTbls[$dbCount];
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
		
		$this->pstRecset = $recSet;
		$this->RSresults = $wTbls;
		
		
		$this->dbFnct = "dbUpdRec";
		
		return;

	}

	function updateInventValue($record,$E_POST)
	{
		$invDim = new vin_inventory($this->tblInfo->schema);
		$dimObj = array();
		$dimObj["PROCESS"] = $E_POST["PROCESS"];
		$dimObj["SESSION"] = $E_POST["SESSION"];
		$dimObj["idVIN_ITEM"] = $record["VIN_ORDE_ITMID"];
		$invDim->dbFindMatch($dimObj);

		$costDim = new dbMaster("vin_itmwar",$this->tblInfo->schema); 
		$acpObj = array();
		$acpObj["PROCESS"] = $E_POST["PROCESS"];
		$acpObj["SESSION"] = $E_POST["SESSION"];
		$acpObj["VIN_ITMWAR_ITMID"] = $record["VIN_ORDE_ITMID"];
		$acpObj["VIN_ITMWAR_WARID"] = $record["VIN_ORDE_WARID"];
		$costDim->dbFindMatch($acpObj);
		
		$iocc = 0;
		$iqty = 0;
		$mqty = 0;
		
		while ($iocc < count($invDim->result))
		{
			if ($invDim->result[$iocc]["VIN_INVE_WARID"] == $record["VIN_ORDE_WARID"])
			{
				$iqty += ($invDim->result[$iocc]["VIN_INVE_BOHQT"] *1);
			}
			$iocc += 1;
		}
		
		$invDim->adjustQty = ($record["VIN_ORDE_ORDQT"]*1);
		$invDim->totalQty = $iqty + $invDim->adjustQty;			
		if ($record["VIN_ORDE_UPDCP"] == "1" && $record["VIN_ORDE_AVGCP"] > 0)
		{
			$costDim->result[0]["VIN_ITMWAR_AVGCP"] = $record["VIN_ORDE_AVGCP"];
		}
		$invDim->avgCost = ($costDim->result[0]["VIN_ITMWAR_AVGCP"]*1);
		$newCost = $invDim->avgCost;
		if ($invDim->totalQty > 0 )
		{
			// Avoid devide by zero or negative
			$newCost = (( $invDim->totalQty * $invDim->avgCost) + ($record["VIN_ORDE_ADJCP"]*1)) / $invDim->totalQty;
		}
		
		$newCost = round($newCost,2);
		$invDim->newCost = $newCost; 
		
		$avgCost = new dbMaster("vin_itmwar",$this->tblInfo->schema); 
		$avgObj = array();
		$avgObj["PROCESS"] = $E_POST["PROCESS"];
		$avgObj["SESSION"] = $E_POST["SESSION"];
		$avgObj["VIN_ITMWAR_ITMID"] = $record["VIN_ORDE_ITMID"];
		$avgObj["VIN_ITMWAR_WARID"] = $record["VIN_ORDE_WARID"];
		$avgCost->dbFindMatch($avgObj);		
		if ($avgCost->rowCount == 0 || $avgCost->result[0]["idVIN_ITMWAR"] == 0)
		{
			// insert
			$avgCostUpd = new dbMaster("vin_itmwar",$this->tblInfo->schema);
			$avgCostUpd->brTrConn = $this->masterTranConn;
			$avgUpd = array();
			$avgUpd["PROCESS"] = $E_POST["PROCESS"];
			$avgUpd["SESSION"] = $E_POST["SESSION"];
			$avgUpd["VIN_ITMWAR_ITMID"] = $record["VIN_ORDE_ITMID"];
			$avgUpd["VIN_ITMWAR_WARID"] = $record["VIN_ORDE_WARID"];
			$avgUpd["VIN_ITMWAR_AVGCP"] = $invDim->newCost;
			$avgCostUpd->dbInsRec($avgUpd);					
		}
		else
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

		$this->paccAccounts["INVENTORY"] += ($invDim->adjustQty * $invDim->newCost)*1;
		$this->paccAccounts["INVENTADJ"] += ($invDim->adjustQty * $invDim->newCost)*1;

		$this->dimResult[count($this->dimResult)] = $invDim;
		$this->dimResult[count($this->dimResult)] = $avgCostUpd;
		$this->dimResult[count($this->dimResult)] = $avgCost;
		$this->dimResult[count($this->dimResult)] = $costDim;
		
		$this->AB_CPARM = $invDim->dbGetCparm();		
	}
	
	function updateFinancial($fPost)
	{

		$adjCurr = new dbMaster("vgb_curr",$this->tblInfo->schema);
		$currObj = array();
		$currObj["PROCESS"] = $fPost["PROCESS"];
		$currObj["SESSION"] = $fPost["SESSION"];
		$currObj["idVGB_CURR"] = $this->AB_CPARM["VGB_COMPANY"]["vgb_cust"][0]["VGB_CUST_CURID"];
		$adjCurr->dbFindMatch($currObj);		

		$nfnu = new vgl_getNextFreeNumber($this->tblInfo->schema,"VGL_TRJN_TRNID" ,$fPost,$this->masterTranConn);

		$glPost = array();
		$glPost["PROCESS"] = $fPost["PROCESS"];
		$glPost["SESSION"] = $fPost["SESSION"];
		$glPost["VGL_JNHE_TRNID"] = $nfnu->vgl_nextNumber;
		$glPost["paccAccounts"] = $this->paccAccounts;

		$glPost["paccTrans"] = array();
		$glPost["paccTrans"]["VGL_JNHE_TRNID"] = $glPost["VGL_JNHE_TRNID"];
		$glPost["paccTrans"]["VGL_JNHE_DOCDA"] = $this->getDateFormed();
		$glPost["paccTrans"]["VGL_JNHE_CURID"] = $adjCurr->result[0]["idVGB_CURR"];
		$glPost["paccTrans"]["VGL_JNHE_CURAT"] = $adjCurr->result[0]["VGB_CURR_CURAT"];
		
		$tFnc = new AB_querySession;
		$cUser = $tFnc->getUserData();
		$glPost["paccTrans"]["VGL_JNHE_USLNA"] = $cUser["userCode"];
		$glPost["paccTrans"]["VGL_JNHE_PSOUR"] = "VIN_ADJ";
		$glPost["paccTrans"]["VGL_JNHE_REFER"] = $fPost["VIN_ORHE_TEXT"];

		$vgl_trans = new vgl_posting($this->tblInfo->schema);
		$vgl_trans->brTrConn = $this->masterTranConn;
		$vgl_trans->vgl_postTransaction($glPost);
		$this->vgl_trans = $vgl_trans;
		$this->errorCode = $vgl_trans->errorCode;
		$this->errorCodeText = $vgl_trans->errorCodeText;		

		$this->glPost = $glPost;

	}

	
	function updateOrsiData($ePost,$trCon)
	{
		
		$wTbls = array();
		$wTbls["errorCode"] = 0;
		
		if ($ePost["SESSION"] != "VIN_PICKER" && $ePost["SESSION"] != "VIN_PACKER")
		{
			return $wTbls;
		}
		
		$ePost["VIN_ORSI_PDATE"] =  $this->getDateFormed();
  		$wTbls = new dbMaster("vin_orsi",$this->tblInfo->schema);
  		$wTbls->brTrConn = $trCon;
		$wTbls->dbUpdRec($ePost);		
		
		return $wTbls;
	}
	
	function cleanOrsiData($id,$trCon)
	{
	  	$wTbls = new dbMaster("vin_orsi",$this->tblInfo->schema);
	  	$wTbls->brTrConn = $trCon;
	  	
	  	$obj = array();
		$obj["PROCESS"] = $this->processId;
		$obj["SESSION"] = $this->sessionId;
		$obj["TBLNAME"] = "vin_orsi";
		


	  	$obj["VIN_ORSI_ORNUM"] = $id;
		$wTbls->dbFindMatch($obj);
		$this->delAll = $wTbls->result;
		$this->delRset = array();
		
		$occ = 0;
		while ($occ < count($wTbls->result))
		{
			$wrec = $wTbls->result[$occ];
		  	$wwTbls = new dbMaster("vin_orsi",$this->tblInfo->schema);
		  	$wwTbls->brTrConn = $trCon;
		  	
		  	$wobj = array();
			$wobj["PROCESS"] = $this->processId;
			$wobj["SESSION"] = $this->sessionId;
			$wobj["TBLNAME"] = "vin_orsi";

		  	$wobj["idVIN_ORSI"] = $wrec["idVIN_ORSI"];
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
	
	
	function setDfltVIN_ORDE($dtaObj)
	{
  		$dtaObj["VIN_ORDE_ORNUM"] = $this->E_POST["idVIN_ORHE"];
  		
  		if ($dtaObj["idVIN_ORDE"] < 1)
  		{
  			$dtaObj["idVIN_ORDE"] = "";
  		}

		if (!$dtaObj["VIN_ORDE_BTCUS"] || $dtaObj["VIN_ORDE_BTCUS"] == "" ) 
		{
			$dtaObj["VIN_ORDE_BTCUS"] = $this->E_POST["VIN_ORHE_BTCUS"];
			$dtaObj["VIN_ORDE_STCUS"] = $this->E_POST["VIN_ORHE_STCUS"];
			$dtaObj["VIN_ORDE_BTADD"] = $this->E_POST["VIN_ORHE_BTADD"];
			$dtaObj["VIN_ORDE_STADD"] = $this->E_POST["VIN_ORHE_STADD"];

			$dtaObj["VIN_ORDE_SLSRP"] = $this->E_POST["VIN_ORHE_SLSRP"];
			$dtaObj["VIN_ORDE_TERID"] = $this->E_POST["VIN_ORHE_TERID"];

		}

		if (!$dtaObj["VIN_ORDE_WARID"] || $dtaObj["VIN_ORDE_WARID"] == "")
		{
			if ($dtaObj["VIN_ORDE_ITMID"] && $dtaObj["VIN_ORDE_ITMID"] > 0)
			{
				$tmpObj = array();
				
				$tmpObj["PROCESS"] = "VIN_ITEMS";
				$tmpObj["SESSION"] = "VIN_ITEMS";
				$tmpObj["TBLNAME"] = "vin_item";			
				
				$tmpObj["idVIN_ITEM"] = $dtaObj["VIN_ORDE_ITMID"];
				
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
					$dtaObj["VIN_ORDE_WARID"] = $wWars->result[0]["idVIN_WARS"];
				}
				
			}
			
		}
		
		if (!$dtaObj["VIN_ORDE_LOCID"] || $dtaObj["VIN_ORDE_LOCID"] == "")
		{
			if ($dtaObj["VIN_ORDE_WARID"] && $dtaObj["VIN_ORDE_WARID"] > 0)
			{
				$tmpObj = array();
				
				$tmpObj["PROCESS"] = "VIN_ITEMS";
				$tmpObj["SESSION"] = "VIN_ITEMS";
				$tmpObj["TBLNAME"] = "vin_wars";			
				
				$tmpObj["idVIN_WARS"] = $dtaObj["VIN_ORDE_WARID"];
				
		  		$wItem = new dbMaster("vin_wars",$this->tblInfo->schema);
				$wItem->dbFindMatch($tmpObj);
				if (count($wItem->result) > 0 )
				{
					$dtaObj["VIN_ORDE_LOCID"] = $wItem->result[0]["VIN_WARS_MALOC"];
				}
				
			}
			
		}						

		return $dtaObj;
	}
	
		
	function insertVIN_ORST($dtaObj,$sTbls,$seq)
	{
	
		$wTbls = $sTbls;	
		
		$recSet = $dtaObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet))
		{
			
			
			if ($recSet[$occ]["trash"] != 1)
			{
				
				$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
				$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
				$recSet[$occ]["TBLNAME"] = "vin_orst";			
				$recSet[$occ]["idVIN_ITEM"] = $dtaObj["VIN_ORDE_ITMID"];
				
				
				if ($recSet[$occ]["VIN_ORST_PDATE"] == '')
				{
					$theDay = $this->getDateFormed();
					if ($dtaObj["VIN_ORDE_DDATE"] < $theDay)
					{
						$recSet[$occ]["VIN_ORST_PDATE"] = $theDay;
					}
					else
					{
						$recSet[$occ]["VIN_ORST_PDATE"] = $dtaObj["VIN_ORDE_DDATE"];
					}
					
					
				}
				
			
				// New record may not have documents numbers
				$recSet[$occ] = $this->IV_VIN_initStepIdFields($recSet[$occ]);
				
				$recSet[$occ]["idVIN_ORST"] = "";				
				$recSet[$occ]["VIN_ORST_ORNUM"] = $dtaObj["idVIN_ORHE"];
				$recSet[$occ]["VIN_ORST_ORLIN"] = $dtaObj["idVIN_ORDE"];
				$recSet[$occ]["VIN_ORST_STEPS"] = $this->IV_VIN_FIRST_STEP("",$this->fetchResult[0]);
				$recSet[$occ]["VIN_ORST_WARID"] = $dtaObj["VIN_ORDE_WARID"];
				$recSet[$occ]["VIN_ORST_LOCID"] = $dtaObj["VIN_ORDE_LOCID"];

				$dbCount = count($wTbls);
				$wTbls[$dbCount] = new dbMaster("vin_orst",$this->tblInfo->schema);
				$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				$wTbls[$dbCount]->dbInsRec($recSet[$occ]);
				$this->errorCode += $wTbls[$dbCount]->errorCode;
				
				$recSet[$occ]["idVIN_ORST"] = $wTbls[$dbCount]->insertId;				
				
				$this->setItemQtyAdj($recSet[$occ]);
			}
			
			$occ += 1;
			
		}
		$this->recSetPost[$seq]["RECSET"] = $recSet;
		return $wTbls;
		
	}


	function deleteVIN_LSTR($dtaObj)
	{
	// lotDel
		$wTbls = array();	
		
		$recSet = $dtaObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet))
		{
			
			$dbCount = count($wTbls);
			
			if ($recSet[$occ]["idVIN_LSTR"] > 0  )
			{
				$delLotObj = array();
				$delLotObj["PROCESS"] = $dtaObj["PROCESS"];
				$delLotObj["SESSION"] = $dtaObj["SESSION"];
				$delLotObj["TBLNAME"] = "vin_lstr"; // ??? This may be an error;
				$delLotObj["idVIN_LSTR"] = $recSet[$occ]["idVIN_LSTR"];
				
				$wTbls[$dbCount] = new dbMaster("vin_lstr",$this->tblInfo->schema);
				$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				$wTbls[$dbCount]->dbDelRec($delLotObj);		
				$this->errorCode += $wTbls[$dbCount]->errorCode;

				
				
			}
			
			$occ += 1;
			
		}
		
		return $wTbls;
		
	}	
	
	

	function ORGdeleteVIN_LSTR($dtaObj)
	{
			
		$wTblsLstr = "";
		
		if ($dtaObj["idVIN_ORDE"] > 0 )
		{
			$delObj = array();
			$delObj["PROCESS"] = $dtaObj["PROCESS"];
			$delObj["SESSION"] = $dtaObj["SESSION"];
			$delObj["TBLNAME"] = "vin_lstr";
			$delObj["VIN_LSTR_ORNUM"] = $dtaObj["VIN_ORDE_ORNUM"];
			$delObj["VIN_LSTR_ORLIN"] = $dtaObj["idVIN_ORDE"];
							
			$wTblsLstr = new dbMaster("vin_lstr",$this->tblInfo->schema);
			$wTblsLstr->brTrConn = $this->masterTranConn;
			$wTblsLstr->dbDelRec($delObj);		
			$this->errorCode += $wTblsLstr->errorCode;

		}
		
		return $wTblsLstr;
		
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
			$retObj["LOTQT"] = 0;//$dtaObj["VIN_ORST_ORDQT"];
		}
			
		// BOHQT Beyond II_DELI
		if ($dtaObj["VIN_ORST_STEPS"] > "II_DELI")
		{
			// return $dtaObj["VIN_ORST_ORDQT"];
			$retObj["BOHQT"] = $dtaObj["VIN_ORST_ORDQT"];
		}

		// ALOQT includes II_DELI & GG_RELE
		if ($dtaObj["VIN_ORST_STEPS"] < "II_DELx" && $dtaObj["VIN_ORST_STEPS"] >"GG_REL" )
		{
			// return $dtaObj["VIN_ORST_ORDQT"];
			$retObj["ALOQT"] = $dtaObj["VIN_ORST_ORDQT"] * -1;
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

		if(!$this->OriginalData["vin_orst"][$dtaObj["idVIN_ORST"]])
		{ 
			$this->OriginalData["vin_orst"][$dtaObj["idVIN_ORST"]]["VIN_ORST_ORDQT"] = 0;
			$this->OriginalData["vin_orst"][$dtaObj["idVIN_ORST"]]["VIN_ORST_STEPS"] = "";
		}
		
		$orgORST = $this->OriginalData["vin_orst"][$dtaObj["idVIN_ORST"]];
		
		$orgQtySgn = 1;
		if ($orgORST["VIN_ORST_ORDQT"] < 0)
		{
			$ordQtySgn = -1;
		}		
		
		$qtySgn = 1;
		if ($dtaObj["VIN_ORST_ORDQT"] < 0)
		{
			$qtySgn = -1;
		}		

		$newUpdObj = array();
		$newLotSel = explode(",",$dtaObj["lotSel"]);
		
		$orgRec = $this->OriginalData["vin_lstr"];
		if (count($orgRec)>0)
		{
			foreach($orgRec as $name => $value)
			{
				if (strpos( "xx" . $name,$dtaObj["idVIN_ORST"] . "-" ) > 0 )
				{
					if ($value["VIN_LSTR_LOTSQ"] > 0 && $value["VIN_LSTR_ALOQT"] != 0 )
					{
						$newUpdObj[$value["VIN_LSTR_LOTSQ"]]["orgQT"] = abs($value["VIN_LSTR_ALOQT"]) * $orgQtySgn;	
						$newUpdObj[$value["VIN_LSTR_LOTSQ"]]["newQT"] = 0;
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
				$orgORST["VIN_ORST_ORDQT"] = $value["orgQT"];
				$qtyOrg = $this->setInventoryQty($orgORST);
				$workObj["VIN_ORST_ORDQT"] = $value["newQT"];
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
					$rowRec["VIN_ADJLOT_BOHQT"] = $result["BOHQT"];
					$rowRec["VIN_ADJLOT_ALOQT"] = $result["ALOQT"];
					$rowRec["VIN_ADJLOT_PURQT"] = $result["PURQT"];
					$rowRec["VIN_ADJLOT_LOTQT"] = $qtyNew["LOTQT"];
					
					$rowRec["idVIN_WARS"] = $dtaObj["VIN_ORST_WARID"];
					$rowRec["idVIN_LOCS"] = $dtaObj["VIN_ORST_LOCID"];
					
					$rowRec["idVIN_LSHE"] = $lotId;
					// Will need to provide multiple lot selections per ORST record
					
					$rowRec["idVIN_UNIT"] = $dtaObj["VIN_ORST_QTUOM"];
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
		
		
		if(!$this->OriginalData["vin_orst"][$dtaObj["idVIN_ORST"]])
		{ 
			$this->OriginalData["vin_orst"][$dtaObj["idVIN_ORST"]]["VIN_ORST_ORDQT"] = 0;
			$this->OriginalData["vin_orst"][$dtaObj["idVIN_ORST"]]["VIN_ORST_STEPS"] = "";
		}
		
		$orgRec = $this->OriginalData["vin_orst"][$dtaObj["idVIN_ORST"]];
		
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
			
			$rowRec["VIN_ADJUST_BOHQT"] = $result["BOHQT"];
			$rowRec["VIN_ADJUST_ALOQT"] = $result["ALOQT"];
			$rowRec["VIN_ADJUST_PURQT"] = $result["PURQT"];
			$rowRec["VIN_ADJUST_LOTQT"] = $qtyNew["LOTQT"];
			
			$rowRec["idVIN_WARS"] = $dtaObj["VIN_ORST_WARID"];
			$rowRec["idVIN_LOCS"] = $dtaObj["VIN_ORST_LOCID"];
			
			$rowRec["idVIN_LSHE"] = $dtaObj["lotSel"];
			// Will need to provide multiple lot selections per ORST record
			
			$rowRec["idVIN_UNIT"] = $dtaObj["VIN_ORST_QTUOM"];
			$this->InventoryUpdRec[$rNum] = $rowRec;
		}
		
		
		
		
		
				
	}
	
	function updateVIN_ORST($dtaObj,$sTbls,$seq)
	{
	
		$wTbls = $sTbls;	
		
		$recSet = $dtaObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet))
		{
			$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
			$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
			$recSet[$occ]["TBLNAME"] = "vin_orst";	
			$recSet[$occ]["idVIN_ITEM"] = $dtaObj["VIN_ORDE_ITMID"];
			$recSet[$occ]["VIN_ITEM_LOTCT"] = $dtaObj["VIN_ITEM_LOTCT"];
			
			$recSet[$occ]["VIN_ORST_WARID"] = $dtaObj["VIN_ORDE_WARID"];
			$recSet[$occ]["VIN_ORST_LOCID"] = $dtaObj["VIN_ORDE_LOCID"];
			$recSet[$occ]["VIN_ORST_QTUOM"] = $dtaObj["VIN_ORDE_SAUOM"];
					
			$dbCount = count($wTbls);
			
			if ($recSet[$occ]["trash"] != 1)
			{
				$wTbls[$dbCount] = new dbMaster("vin_orst",$this->tblInfo->schema);
				$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				
				
				if ($recSet[$occ]["idVIN_ORST"] > 0 )
				{
					

					if ($recSet[$occ]["VIN_ORST_PDATE"] == '')
					{
						$theDay = $this->getDateFormed();
						if ($dtaObj["VIN_ORDE_DDATE"] < $theDay)
						{
							$recSet[$occ]["VIN_ORST_PDATE"] = $theDay;
						}
						else
						{
							$recSet[$occ]["VIN_ORST_PDATE"] = $dtaObj["VIN_ORDE_DDATE"];
						}
						
						
					}

					
					$recSet[$occ] = $this->TV_NEWDOC_CONTROL($recSet[$occ]);
					$wTbls[$dbCount]->obj =$recSet[$occ];
					$wTbls[$dbCount]->objAreEqual = $this->objAreEqual($recSet[$occ],"vin_orst","idVIN_ORST");
					$wTbls[$dbCount]->objvalid = $this->IV_STEP_VALID($recSet[$occ]);



					
					if ($this->objAreEqual($recSet[$occ],"vin_orst","idVIN_ORST") != true)
			  		{
			  			if ($this->IV_STEP_VALID($recSet[$occ]) == true)
			  			{	
			  				
							$wTbls[$dbCount]->dbUpdRec($recSet[$occ]);
							
							$wTbls[$dbCount]->E_POST = $recSet[$occ];
							$this->debugRetract = $wTbls[$dbCount];
							
							$this->errorCode += $wTbls[$dbCount]->errorCode;
						}
						else
						{
							$this->errorCode += 2000;
					
							$orlin=$dtaObj["VIN_ORDE_ORLIN"];
							$stpsq=$recSet[$occ]["VIN_ORST_STPSQ"];
							
						
							$this->errorCodeText[count($this->errorCodeText)] = "2000 - Step not valid for Line:(" . $orlin . ") Step:" .  $stpsq;
						}
						
						$this->setItemQtyAdj($recSet[$occ]);		
					}
					
				}
				else
				{
					if ($recSet[$occ]["idVIN_ORST"] < 0 )
					{					
						$recSet[$occ]["idVIN_ORST"] = "";
						$recSet[$occ]["VIN_ORST_ORNUM"] = $dtaObj["VIN_ORDE_ORNUM"];
						$recSet[$occ]["VIN_ORST_ORLIN"] = $dtaObj["idVIN_ORDE"];
						$recSet[$occ]["VIN_ORST_STEPS"] = $this->IV_VIN_FIRST_STEP("",$this->fetchResult[0]);
						
						// New record may not have documents numbers
						$recSet[$occ] = $this->IV_VIN_initStepIdFields($recSet[$occ]);
						
						
						$wTbls[$dbCount]->dbInsRec($recSet[$occ]);		
						$this->errorCode += $wTbls[$dbCount]->errorCode;
						$recSet[$occ]["idVIN_ORST"] = $wTbls[$dbCount]->insertId;
						$wTbls[$dbCount]->RS = $recSet[$occ];
						$this->setItemQtyAdj($recSet[$occ]);
					}
				}		
			}
			else
			{
				if ($recSet[$occ]["idVIN_ORST"] > 0 )
				{
					$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
					$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
					$recSet[$occ]["TBLNAME"] = "vin_orst";			
				
					$wTbls[$dbCount] = new dbMaster("vin_orst",$this->tblInfo->schema);
					$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
					$wTbls[$dbCount]->dbDelRec($recSet[$occ]);
					$this->errorCode += $wTbls[$dbCount]->errorCode;
					
					$recSet[$occ]["VIN_ORST_ORDQT"] = 0;	
					$recSet[$occ]["lotSel"] = "";	
					$this->setItemQtyAdj($recSet[$occ]);
				}
				
			}

			$occ += 1;
			
		}
		
		$this->recSetPost[$seq]["RECSET"] = $recSet;
		return $wTbls;
	}

	function getQtyVIN_LSTR($dtaObj)
	{
	
		$lineQty = 0;
		
		$occ = 0;
		while ( $occ < count($recSet) )
		{
			if (!$recSet[$occ]["idVIN_LSTR"] && !$recSet[$occ]["idVIN_LSTR"])
			{
				// Nothing
			}
			else
			{
			
				$lineQty += ($recSet[$occ]["VIN_LSTR_ALOQT"]*1); 
			}
			$occ += 1;
		}
		
		return $lineQty;
			
	}
							
	function validateVIN_LSTR($dtaObj)
	{
		// not used
		$recValid = true;
		
		$recSet = $dtaObj;
		$occ = 0;
		if ($recSet["idVIN_ORDE"])
		{
			$lotAccum = 0;
			$selList = explode(",",$recSet["lotSel"]);
			$wocc = 0;
			while ($wocc < count($selList)-1)
			{
				$SL = explode(":",$selList[$wocc]);
				
				$lotAccum += $SL[1];
				$wocc += 1;
			};
			
			if ( ($lotAccum * 1) != ($recSet["VIN_ORDE_ORDQT"] * 1) )
			{
				$recValid = false;
				$recSet["lotAccum"] = $lotAccum;
				$this->lotValid = $recSet;
			}
		}
		
		
		return $recValid;
		
	}
	
	function updateVIN_LSTR($dtaObj)
	{
			// receives ORDER LINE RECSET
			$debugret = array();
			$this->lotlist = array();
			
			
			$wTbls = array();
	
			// $wTbls[0] = new dbMaster("vin_lstr",$this->tblInfo->schema);
			// $wTbls[0] Representsresult info on the all updates in  $dtaObj["RECSET"];
			
			
			$recSet = $dtaObj["RECSET"];
			$PR = $dtaObj["PROCESS"];
			$SE = $dtaObj["SESSION"];
			$TB = "vin_lstr";			
	
			
			
			$occ = 0;
			while ( $occ < count($recSet) )
			{
				if (!$recSet[$occ]["idVIN_LSTR"] && !$recSet[$occ]["idVIN_LSTR"])
				{
					// Nothing
				}
				
				if ($recSet[$occ]["idVIN_LSTR"] > 0 )
				{
					$orgDta = $this->OriginalData["vin_lstr"][$dtaObj["idVIN_ORDE"]."-".$recSet[$occ]["idVIN_LSTR"]];
					if ($orgDta["VIN_LSTR_ALOQT"] != $recSet[$occ]["VIN_LSTR_ALOQT"])
					{
						
					
						$updRec["PROCESS"] = $PR;
						$updRec["SESSION"] = $SE;
						$updRec["TBLNAME"] = $TB;			
						$updRec["idVIN_LSTR"] = $recSet[$occ]["idVIN_LSTR"]; 
						$updRec["VIN_LSTR_ALOQT"] = $recSet[$occ]["VIN_LSTR_ALOQT"]; 

						$dbCount = count($wTbls);
						$wTbls[$dbCount] = new dbMaster("vin_lstr",$this->tblInfo->schema);
						$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
						
						if (($recSet[$occ]["VIN_LSTR_ALOQT"]*1)!= 0)
						{
							$wTbls[$dbCount]->dbUpdRec($updRec);
							$updRec["method"]="dbUpdRec";
						}
						else
						{
							$wTbls[$dbCount]->dbDelRec($updRec);
							$updRec["method"]="dbDelRec";
						}
																	
						$this->errorCode += $wTbls[$dbCount]->errorCode;
	
					}
					
				}
				else
				{
					if (($recSet[$occ]["VIN_LSTR_ALOQT"]*1)!= 0)
					{
						$updRec = array();
						$updRec["PROCESS"] = $PR;
						$updRec["SESSION"] = $SE;
						$updRec["TBLNAME"] = $TB;			
						
						$updRec["VIN_LSTR_ORNUM"] = $dtaObj["VIN_ORDE_ORNUM"];
						$updRec["VIN_LSTR_ORLIN"] = $dtaObj["idVIN_ORDE"];
						$updRec["VIN_LSTR_ITMID"] = $dtaObj["VIN_ORDE_ITMID"];
						$updRec["VIN_LSTR_LOTSQ"] = $recSet[$occ]["VIN_LSTR_LOTSQ"];
						$updRec["VIN_LSTR_ALOQT"] = $recSet[$occ]["VIN_LSTR_ALOQT"];

						$dbCount = count($wTbls);
						$wTbls[$dbCount] = new dbMaster("vin_lstr",$this->tblInfo->schema);
						$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
						$wTbls[$dbCount]->dbInsRec($updRec);
						$this->errorCode += $wTbls[$dbCount]->errorCode;
						$updRec["method"]="dbInsRec";
						$updRec["idVIN_LSTR"] = $wTbls[$dbCount]->insertId;					
					}
				}					
					
				$occ += 1;
			}	
			
			return $wTbls;	
		}
					


// Always use these prefix for your function names
// IV_ = Information functions
// TV_ = Transaction functions 

//		$this->setNewDocument = $E_POST["DOC_STEPS"]; // step
//		$this->setDocOrst = $E_POST["DOC_ORST"]; // orst list
//		$this->setDocOrstp = $E_POST["VIN_ORHE_ORSTP"]; // Order Scheme defines valid steps 

//		$recSet[$occ] = $this->TV_NEWDOC_CONTROL($recSet[$occ]:
//		
//		if ($this->objAreEqual($recSet[$occ],"vin_orst","idVIN_ORST") != true)
//  		{
//  			if ($this->IV_STEP_VALID($recSet[$occ]) == true)
//

	function TV_NEWDOC_CONTROL($objRec)
	{
		$x = count($this->IV_ND);
		
		if (!$this->setNewDocument || strpos("x,".$this->setDocOrst."," , "," . $objRec["idVIN_ORST"] . ",") < 1)
		{
			return $objRec;
		}
		// If object not of concern simply return the object
		
		if ($this->setNewDocument >= $objRec["VIN_ORST_STEPS"])
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
			$nfnu = new vgb_getNextFreeNumber($this->tblInfo->schema,"VIN_ORSI_GRPID" ,$this->E_POST,$this->masterTranConn);
			$this->setDocNFNU = $nfnu->vgb_nextNumber;

		}
		
		$objRec["VIN_ORHE_ORNUM" ] = $this->E_POST["idVIN_ORHE"];
		$objRec["VIN_ORHE_ORSTP" ] = $this->E_POST["VIN_ORHE_ORSTP"];
		$objRec["VIN_ORHE_BTCUS" ] = $this->E_POST["VIN_ORHE_BTCUS"];
		
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
					$vin_orsi = array();
					$vin_orsi["idVIN_ORSI"] = "";
					$vin_orsi["VIN_ORSI_STEPS"] = $validSteps[$occ];
					
					$vin_orsi["VIN_ORSI_GRPID"] = $this->setDocNFNU;
					$vin_orsi["VIN_ORSI_ORNUM"] = $objRec["VIN_ORHE_ORNUM"];
					$vin_orsi["VIN_ORSI_PROCE"] = "0";
					// $vin_orsi["VIN_ORSI_BPART"] = $objRec["VIN_ORHE_BTCUS"];
					$vin_orsi["VIN_ORSI_REISS"] = "0";
					$vin_orsi["VIN_ORSI_RESEQ"] = "0";
					
					$wTbls = new dbMaster("vin_orsi",$this->tblInfo->schema);
					$wTbls->brTrConn = $this->masterTranConn;
		
					$vin_orsi["PROCESS"] = $this->processId;
					$vin_orsi["SESSION"] = $this->sessionId;
					
					if (!$this->setDocOrsi[$vin_orsi["VIN_ORSI_STEPS"]])
					{
						$wTbls->dbInsRec($vin_orsi);
						$this->setDocOrsi[$vin_orsi["VIN_ORSI_STEPS"]] = $wTbls->insertId;
						$vin_Id = $wTbls->insertId;
					}
					else
					{
						$vin_Id = $this->setDocOrsi[$vin_orsi["VIN_ORSI_STEPS"]];
					}
					
					$objRec = $this->TV_SetDocNumber($validSteps[$occ],$objRec,$vin_Id);
					
					if (!$this->errorCodexx)
					{
						$this->errorCodexx = array();
					}
					$wTbls->posted = $vin_orsi;
					$wTbls->objRec = $objRec;
					$wTbls->validSteps = $occ . "=" . $validSteps[$occ];
					$this->errorCodexx[count($this->errorCodexx)] = $wTbls;
				}
					
			}
			else
			{
				// $objRec["VIN_ORST_STEPS"] = $validStep[$occ];
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
		
		if ($objRec["VIN_ORST_STEPS"] > $this->setNewDocument)
		{
			$this->IV_ND[$x] = $objRec["VIN_ORST_STEPS"] . ">";
			return false;
		}
		$objRec["VIN_ORHE_ORSTP"] = $this->setNewDocument;
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
				$docNumber =  $objRec["VIN_ORST_ARCID"] * 1;
			break;
			case 'JJ_INVO':
				$docNumber =  $objRec["VIN_ORST_WINVO"] * 1;
			break;
			case 'II_DELI':
				$docNumber =  $objRec["VIN_ORST_DELID"] * 1;
			break;
			case 'HH_PACK':
				$docNumber =  $objRec["VIN_ORST_PAKID"] * 1;
			break;
			case 'GG_RELE':
				$docNumber =  $objRec["VIN_ORST_RELID"] * 1;
			break;
			case 'FF_PICK':
				$docNumber =  $objRec["VIN_ORST_PICID"] * 1;
			break;
			case 'EE_SCED':
				$docNumber =  $objRec["VIN_ORST_SCEID"] * 1;
			break;
			case 'DE_AOKN':
				$docNumber =  $objRec["VIN_ORST_AOKID"] * 1;
			break;
			case 'DD_ACKN':
				$docNumber =  $objRec["VIN_ORST_ACKID"] * 1;
			break;
			
		}

		return $docNumber;
		
	}	
		

	function TV_SetDocNumberClear($objRec)
	{

		$recId = "";
		$sep = "";
		
		$objRec["VIN_ORST_STEPS"] = $this->setNewDocument;

		switch ($this->setNewDocument)
		{

			case 'DD_ACKN':                          	                
				$recId .= $sep . "VIN_ORST_ACKID";$objRec["VIN_ORST_ACKID"]=0;
				$sep = ",";
			case 'DE_AOKN':                          	                
				$recId .= $sep . "VIN_ORST_AOKID";$objRec["VIN_ORST_AOKID"]=0;
				$sep = ",";                      	                
			case 'EE_SCED':                          	                
				$recId .= $sep . "VIN_ORST_SCEID";$objRec["VIN_ORST_SCEID"]=0;
				$sep = ",";                      	                
			case 'FF_PICK':                          	                
				$recId .= $sep . "VIN_ORST_PICID";$objRec["VIN_ORST_PICID"]=0;
				$sep = ",";                      	                
			case 'GG_RELE':                          	                
				$recId .= $sep . "VIN_ORST_RELID";$objRec["VIN_ORST_RELID"]=0;
				$sep = ",";                      	                
			case 'HH_PACK':                          	                
				$recId .= $sep . "VIN_ORST_PAKID";$objRec["VIN_ORST_PAKID"]=0;
				$sep = ",";                      	                
			case 'II_DELI':                          	                
				$recId .= $sep . "VIN_ORST_DELID";$objRec["VIN_ORST_DELID"]=0;
				$sep = ",";                      	                
			case 'JJ_INVO':                          	                
				$recId .= $sep . "VIN_ORST_WINVO";$objRec["VIN_ORST_WINVO"]=0;
				$sep = ",";                      	                
			case 'KK_PURG':
				$recId .= $sep . "VIN_ORST_ARCID";$objRec["VIN_ORST_ARCID"]=0;
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
				$docNumber =  $objRec["VIN_ORST_ARCID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VIN_ORST_ARCID"] = $recId;
					$objRec["VIN_ORST_STEPS"] = "QQ_PURG";
				}
			break;
			case 'JJ_INVO':
				$docNumber =  $objRec["VIN_ORST_WINVO"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VIN_ORST_WINVO"] = $recId;
					$objRec["VIN_ORST_STEPS"] = "KK_PURG";
				}
			break;
			case 'II_DELI':
				$docNumber =  $objRec["VIN_ORST_DELID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VIN_ORST_DELID"] = $recId;
					$objRec["VIN_ORST_STEPS"] = "JJ_INVO";
				}
			break;
			case 'HH_PACK':
				$docNumber =  $objRec["VIN_ORST_PAKID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VIN_ORST_PAKID"] = $recId;
					$objRec["VIN_ORST_STEPS"] = "II_DELI";
					
					
				}
			break;
			case 'GG_RELE':
				$docNumber =  $objRec["VIN_ORST_RELID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VIN_ORST_RELID"] = $recId;
					$objRec["VIN_ORST_STEPS"] = $this->IV_VIN_NEXT_STEP($objRec["VIN_ORST_STEPS"],$objRec);
				}
			break;
			case 'FF_PICK':
				$docNumber =  $objRec["VIN_ORST_PICID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VIN_ORST_PICID"] = $recId;
					$objRec["VIN_ORST_STEPS"] = $this->IV_VIN_NEXT_STEP($objRec["VIN_ORST_STEPS"],$objRec);
				}
			break;
			case 'EE_SCED':
				$docNumber =  $objRec["VIN_ORST_SCEID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VIN_ORST_SCEID"] = $recId;
					$objRec["VIN_ORST_STEPS"] = $this->IV_VIN_NEXT_STEP($objRec["VIN_ORST_STEPS"],$objRec);
				}
			break;
			case 'DE_AOKN':
				$docNumber =  $objRec["VIN_ORST_AOKID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VIN_ORST_AOKID"] = $recId;
					$objRec["VIN_ORST_STEPS"] = $this->IV_VIN_NEXT_STEP($objRec["VIN_ORST_STEPS"],$objRec);
				}
			break;
			case 'DD_ACKN':
				$docNumber =  $objRec["VIN_ORST_ACKID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VIN_ORST_ACKID"] = $recId;
					$objRec["VIN_ORST_STEPS"] = $this->IV_VIN_NEXT_STEP($objRec["VIN_ORST_STEPS"],$objRec);
				}
			break;
			
		}
		return $objRec;
		
	}
	
	function IV_STEP_VALID($objRec)
	{
	
		
		if(!$this->OriginalData["vin_orst"][$objRec["idVIN_ORST"]])
		{
			return true;
		}
		
		$orgDta = $this->OriginalData["vin_orst"][$objRec["idVIN_ORST"]];
	
		$this->IV_STEP_VALIDORG = $orgDta["VIN_ORST_STEPS"]; 
		$this->IV_STEP_VALIDCUR = $objRec["VIN_ORST_STEPS"];
		
	
		if($orgDta["VIN_ORST_STEPS"] != $objRec["VIN_ORST_STEPS"] )
		{
			if (strpos("x,".$this->setDocOrst."," , "," . $objRec["idVIN_ORST"] . ",") < 1)
			{
				return false;
			}
			else
			{
				// $this->IV_getDocNumber = $this->IV_getDocNumber($objRec["VIN_ORST_STEPS"],$objRec);
				if ($this->IV_getDocNumber($objRec["VIN_ORST_STEPS"],$objRec) > 0)
				{
					return false;
				}
			}
		}
		
		
		return true;
		

	}



	function IV_VIN_FIRST_STEP($SCEME ,$ATD)
	{
		$RET="";
		$SEQ  = $this->IV_GET_SCEME_SEQ($SCEME ,$ATD);
		$RET = explode(",",$SEQ);
		return $RET[0];
		
	}
	
	function IV_GET_SCEME_SEQ($SCEME,$ATD)
	{
	
		switch ($ATD["VIN_ORHE_ORSTP"])
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
	
	function IV_VIN_initStepIdFields($obj)
	{

		$obj["VIN_ORST_ACKID"] = null;
		$obj["VIN_ORST_AOKID"] = null;
		$obj["VIN_ORST_ARCID"] = null;
		$obj["VIN_ORST_DELID"] = null;
		$obj["VIN_ORST_PAKID"] = null;
		$obj["VIN_ORST_PICID"] = null;
		$obj["VIN_ORST_RELID"] = null;
		$obj["VIN_ORST_SCEID"] = null;
		$obj["VIN_ORST_WINVO"] = null;		
		
		return $obj;

	}
	
	
	
	function IV_VIN_NEXT_STEP($steps,$objRec)
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
	
	
	function IV_VIN_STEP_EVAL($SCEME,$A_TD)
	{
		
	// Always use these prefix for your variable names
	// IV_ = Information values
	// TV_ = Transaction values 
		
		
		$qRsp = array();
		$qRsp["IV_VIN_STEP_MULT"] = 0;
		$qRsp["IV_VIN_STEP_RELEASED"] = 0;
		$qRsp["IV_VIN_STEP_DELIVERED"] = 0;
		$qRsp["IV_VIN_STEP_INVOICED"] = 0;
		$qRsp["IV_VIN_STEP_FIRST_QTY"] = 0;
		$qRsp["IV_VIN_HAS_TO_INVOICE"] = 0;
		$qRsp["IV_VIN_HAS_TO_RELEASE"] = 0;
		$qRsp["IV_VIN_HAS_TO_DELIVER"] = 0;
		$qRsp["IV_VIN_HAS_ALOCATED_QTY"] = 0;
		$qRsp["IV_VIN_HAS_IN_WIP"] = 0;
		$qRsp["IV_VIN_STEP_MULT_CHECK"] = 0;
		$qRsp["IV_VIN_STEP_QTY"] = array();
		$qRsp["IV_VIN_STEPS_VALID"] = $this->IV_GET_SCEME_SEQ($SCEME ,$A_TD[0]);
		
		$qRspInit = $qRsp;
		
		$listidORHE = "";
		$listidORDE = "";
		$listidORST = "";
		
		$occ = 0;
		
		while ($occ < count($A_TD))
		{
			
			if (strpos(" ," . $listidORST , "," . $A_TD[$occ]["idVIN_ORST"] . "," ) < 1)
			{
				$listidORST .= $A_TD[$occ]["idVIN_ORST"] . ",";
			
				if ($A_TD[$occ]["VIN_ORST_STEPS"] == $this->IV_VIN_FIRST_STEP($SCEME,$A_TD[$occ]))
				{
					$qRsp["IV_VIN_STEP_FIRST_QTY"] += $A_TD[$occ]["VIN_ORST_ORDQT"];
				}
				
		
				if ($A_TD[$occ]["VIN_ORST_STEPS"] > "JJ_INVO" )
				{
					
					
					$qRsp["IV_VIN_STEP_INVOICED"]  += $A_TD[$occ]["VIN_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VIN_ORST_STEPS"] > "II_DELI" && $A_TD[$occ]["VIN_ORST_STEPS"] < "JJ_INVO_x")
				{
					$qRsp["IV_VIN_HAS_TO_INVOICE"] += $A_TD[$occ]["VIN_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VIN_ORST_STEPS"] > "II_DELI" )
				{
					
					$qRsp["IV_VIN_STEP_DELIVERED"]  += $A_TD[$occ]["VIN_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VIN_ORST_STEPS"] > "GG_RELE" && $A_TD[$occ]["VIN_ORST_STEPS"] < "II_DELI_x")
				{
					$qRsp["IV_VIN_HAS_TO_DELIVER"] += $A_TD[$occ]["VIN_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VIN_ORST_STEPS"] > "GG_REL " && $A_TD[$occ]["VIN_ORST_STEPS"] < "II_DELI_x")
				{
					$qRsp["IV_VIN_HAS_ALOCATED"] = 1;
					$qRsp["IV_VIN_HAS_ALOCATED_QTY"] += $A_TD[$occ]["VIN_ORST_ORDQT"];
				}
		
		
		
				if ($A_TD[$occ]["VIN_ORST_STEPS"] > "GG_RELE")
				{
					$qRsp["IV_VIN_STEP_RELEASED"]  += $A_TD[$occ]["VIN_ORST_ORDQT"];
				}
				else
				{
					$qRsp["IV_VIN_HAS_TO_RELEASE"] += $A_TD[$occ]["VIN_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VIN_ORST_STEPS"] == "KK_PURG")
				{
					$qRsp["IV_VIN_HAS_IN_WIP"] += $A_TD[$occ]["VIN_ORST_ORDQT"];
				}
		
				
		
				if (!$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]])
				{
					$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]] = $qRspInit;
				}
	
				if (!$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_STEP_QTY"][$A_TD[$occ]["VIN_ORST_STEPS"]])
				{
					$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_STEP_QTY"][$A_TD[$occ]["VIN_ORST_STEPS"]] = $A_TD[$occ]["VIN_ORST_ORDQT"];		
				}
				else
				{
					$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_STEP_QTY"][$A_TD[$occ]["VIN_ORST_STEPS"]] += $A_TD[$occ]["VIN_ORST_ORDQT"];
				}
				$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_STEP_RELEASED"] += $qRsp["IV_VIN_STEP_RELEASED"];
				$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_STEP_DELIVERED"] += $qRsp["IV_VIN_STEP_DELIVERED"];
				$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_STEP_INVOICED"] += $qRsp["IV_VIN_STEP_INVOICED"];
				$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_STEP_FIRST_QTY"] +=	$qRsp["IV_VIN_STEP_FIRST_QTY"];
				$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_HAS_TO_INVOICE"] += $qRsp["IV_VIN_HAS_TO_INVOICE"];
				$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_HAS_TO_RELEASE"] += $qRsp["IV_VIN_HAS_TO_RELEASE"];
				$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_HAS_TO_DELIVER"] += $qRsp["IV_VIN_HAS_TO_DELIVER"];
				$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_HAS_ALOCATED_QTY"] += $qRsp["IV_VIN_HAS_ALOCATED_QTY"];
				$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_HAS_IN_WIP"] += $qRsp["IV_VIN_HAS_IN_WIP"];
				$qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]]["IV_VIN_STEP_MULT_CHECK"] += 1;
								
				$qRsp = $qRspInit;
			
			}
					
			$occ += 1;
		}
	
		$occ = 0;
		while ($occ < count($A_TD))
		{
			$A_TD[$occ]["OrderStatus"] = $qResponse["qR".$A_TD[$occ]["idVIN_ORDE"]];
			
			$occ += 1;
		}
	
	
		return  $A_TD; 
	
	}


}

require_once "VIN_ITEMS.php"; 
require_once "VIN_INVENTORY.php";
require_once "VGB_GETNFNU.php";
require_once "VGL_FINANCE.php";

?>