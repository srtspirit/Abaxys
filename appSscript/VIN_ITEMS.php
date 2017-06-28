<?php


class vin_service extends dbMaster
{

// New approach after detecting problem with have manu joins in statement 

	function vin_service($schema)
	{
		$this->dbMaster("vin_item",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}

	function dbSetTrig()
	{

		
$trig = <<<EOD
			SELECT  * FROM   
			 
		 	( SELECT  * FROM vin_item  
		 	
		WHERE VIN_ITEM_INVIT='0' AND [=WHERE=]  [=COND:vin_item=]  [=LIMIT=] ) tx	  
		
EOD;

		return $trig;
	}


}


class vin_item extends dbMaster
{

// New approach after detecting problem with have manu joins in statement 

	function vin_item($schema)
	{
		$this->dbMaster("vin_item",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}

	function dbInsRec($dtaObj)
	{
		$dtaObj = $this->setCorrectFieldVal($dtaObj);
	  	$wTbls = new dbMaster("vin_item",$this->tblInfo->schema);
	  	
	  	$this->ck_updateValid = true;
	  	$this->ck_updateValid = $this->isItemFieldsValid($dtaObj);

		if ($this->ck_updateValid == true)
		{
			$wTbls->dbInsRec($dtaObj);			
		}
		else
		{
			$wTbls->errorCode = 99101;
			$wTbls->rowCount = 0;
			$wTbls->dbFnct = "dbInsRec";
			
		}
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
				
	}
	
	function dbUpdRec($dtaObj)
	{
		$this->errorCodeText = array();
		
		$orgPost = array();
		$orgPost["idVIN_ITEM"] = $dtaObj["idVIN_ITEM"];
	  	$wTblsOrg = new dbMaster("vin_item",$this->tblInfo->schema);
		$wTblsOrg->dbFindMatch($orgPost);
		$this->orgVals = $wTblsOrg->result[0];
		
		$this->ck_VIN_ITEM_UNSET = $this->fieldHasChanged("VIN_ITEM_UNSET",$dtaObj);
		$this->ck_VIN_ITEM_DOMOS = $this->fieldHasChanged("VIN_ITEM_DOMOS",$dtaObj);
		$this->ck_VIN_ITEM_LOTCT = $this->fieldHasChanged("VIN_ITEM_LOTCT",$dtaObj);
		$this->ck_VIN_ITEM_INVIT = $this->fieldHasChanged("VIN_ITEM_INVIT",$dtaObj);

		$dtaObj = $this->setCorrectFieldVal($dtaObj);
		
		$this->ck_isvalidUnitSet = $this->isvalidUnitSet($dtaObj);
		$this->ck_updateValid = $this->ck_isvalidUnitSet;
		$this->ck_updateValid = $this->isupdateValid($dtaObj);
		$this->ck_updateValid = $this->isItemFieldsValid($dtaObj);
		
		
		$this->localPost = $dtaObj;
		
		if ($this->ck_updateValid == true)
		{
		  	$wTbls = new dbMaster("vin_item",$this->tblInfo->schema);
			$wTbls->dbUpdRec($dtaObj);
			if ($wTbls->errorCode > 0)
			{
				$this->errorCodeText[count($this->errorCodeText)] = $wTbls->errorInfo;
				$wTbls->rowCount = 0;
				$wTbls->dbFnct = "dbUpdRec";
			}
							
		}
		else
		{
			
			$wTbls->errorCode = 99107;
			$wTbls->rowCount = 0;
			
			
			$wTbls->dbFnct = "dbUpdRec";
		}
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}

		
	}

	function isvalidUnitSet($dtaObj)
	{
		$unitPost = array();
		$unitPost["PROCESS"] = $dtaObj["PROCESS"];
		$unitPost["SESSION"] = $dtaObj["SESSION"];
		$unitPost["TBLNAME"] = "vin_unit";
		$unitPost["SPATTERN"] = "[=SPE=] VIN_UNIT_UNSET='" . $dtaObj["VIN_ITEM_UNSET"] . "' " ;
		$wTblsUnit = new dbSearchMaster($this->tblInfo->schema,$unitPost);
		$unitVals = $wTblsUnit->result;	
		$this->unitVals = $wTblsUnit->result;	
		$unSearch = "x,";
		$occ = 0;
		while ($occ < count($unitVals))
		{
			$unSearch .= $unitVals[$occ]["idVIN_UNIT"] . ",";
			$occ += 1;
		}
		$ff = "";
		$ret = true;
		if (strpos($unSearch,"," . $dtaObj["VIN_ITEM_ACUOM"] .",") < 1){$ret=false;$ff.="_ACUOM";}
		if (strpos($unSearch,"," . $dtaObj["VIN_ITEM_CPUOM"] .",") < 1){$ret=false;$ff.="_CPUOM";}
		if (strpos($unSearch,"," . $dtaObj["VIN_ITEM_LPUOM"] .",") < 1){$ret=false;$ff.="_LPUOM";}
		if (strpos($unSearch,"," . $dtaObj["VIN_ITEM_PUUOM"] .",") < 1){$ret=false;$ff.="_PUUOM";}
		if (strpos($unSearch,"," . $dtaObj["VIN_ITEM_SAUOM"] .",") < 1){$ret=false;$ff.="_SAUOM";}
		if (strpos($unSearch,"," . $dtaObj["VIN_ITEM_SCUOM"] .",") < 1){$ret=false;$ff.="_SCUOM";}
		if (strpos($unSearch,"," . $dtaObj["VIN_ITEM_UNITM"] .",") < 1){$ret=false;$ff.="_UNITM";}
		
		if ($ret == false){$this->errorCodeText[count($this->errorCodeText)] = "9907 - Unit set not valid " . $ff;}
		return $ret;
			
 	}
	
	function isItemFieldsValid($dtaObj)
	{
		$ret = $this->ck_updateValid;
		
		$this->VIN_ITEM_SHLIF = $dtaObj["VIN_ITEM_SHLIF"];
		$this->VIN_ITEM_LOTCT = $dtaObj["VIN_ITEM_LOTCT"];
		
		if ($dtaObj["VIN_ITEM_SHLIF"] == 0 && $dtaObj["VIN_ITEM_LOTCT"] == '1' )
		{
			$ret = false;
			$this->errorCodeText[count($this->errorCodeText)] = " You must enter a valid shelf life ";
		}
		if ($dtaObj["VIN_ITEM_LOTCT"] == '1' && $dtaObj["VIN_ITEM_INVIT"] == '0' )
		{
			$ret = false;
			$this->errorCodeText[count($this->errorCodeText)] = " You cannot have Lot control for a non-inventory item ";
		}

		return $ret;
			
	}
	
	function isupdateValid($dtaObj)
	{
		$ret = $this->ck_updateValid;
		if ($this->ck_VIN_ITEM_UNSET== false 
			&& $this->ck_VIN_ITEM_DOMOS== false 
			&& $this->ck_VIN_ITEM_INVIT == false 
			&& $this->ck_VIN_ITEM_LOTCT== false)
		{
			return $ret;
		}
		
		$updaPost = array();
		$updaPost["PROCESS"] = $dtaObj["PROCESS"];
		$updaPost["SESSION"] = $dtaObj["SESSION"];
		$updaPost["TBLNAME"] = "vin_orde";
		$updaPost["SPATTERN"] = "[=SPE=] VIN_ORDE_ITMID='" . $dtaObj["idVIN_ITEM"] . "' " ;
		$updaPost["ORDERBY"] = " idVIN_ORDE LIMIT 1";
		$wTblsupda = new dbSearchMaster($this->tblInfo->schema,$updaPost);
		$updaVals = $wTblsupda->result;		
		if (count($updaVals) > 0)
		{
			$ret = false;
			$this->errorCodeText[count($this->errorCodeText)] = " You have inventory orders for this Item";
		}
		$updaPost = array();
		$updaPost["PROCESS"] = $dtaObj["PROCESS"];
		$updaPost["SESSION"] = $dtaObj["SESSION"];
		$updaPost["TBLNAME"] = "vsl_orde";
		$updaPost["SPATTERN"] = "[=SPE=] VSL_ORDE_ITMID='" . $dtaObj["idVIN_ITEM"] . "' " ;
		$updaPost["ORDERBY"] = " idVSL_ORDE LIMIT 1";
		$wTblsupda = new dbSearchMaster($this->tblInfo->schema,$updaPost);
		$updaVals = $wTblsupda->result;		
		if (count($updaVals) > 0)
		{
			$ret = false;
			$this->errorCodeText[count($this->errorCodeText)] = " You have Sales orders for this Item";
		}		
		$updaPost = array();
		$updaPost["PROCESS"] = $dtaObj["PROCESS"];
		$updaPost["SESSION"] = $dtaObj["SESSION"];
		$updaPost["TBLNAME"] = "vpu_orde";
		$updaPost["SPATTERN"] = "[=SPE=] VPU_ORDE_ITMID='" . $dtaObj["idVIN_ITEM"] . "' " ;
		$updaPost["ORDERBY"] = " idVPU_ORDE LIMIT 1";
		$wTblsupda = new dbSearchMaster($this->tblInfo->schema,$updaPost);
		$updaVals = $wTblsupda->result;		
		if (count($updaVals) > 0)
		{
			$ret = false;
			$this->errorCodeText[count($this->errorCodeText)] = " You have Purchase orders for this Item";
		}		
		
		if ($ret==false)
		{
			if ($this->ck_VIN_ITEM_UNSET== true){$this->errorCodeText[count($this->errorCodeText)] = " 9907(1)= Change Unit Set Not allowed ";}
			if ($this->ck_VIN_ITEM_DOMOS== true){$this->errorCodeText[count($this->errorCodeText)] = " 9906 - Change Date DOS/DOM Not allowed ";}
			if ($this->ck_VIN_ITEM_INVIT== true){$this->errorCodeText[count($this->errorCodeText)] = " 9904 - Change Inventory Not allowed ";}
			if ($this->ck_VIN_ITEM_LOTCT== true){$this->errorCodeText[count($this->errorCodeText)] = " 9903 - Change Lot Control Not allowed ";}
		}	
			
		return $ret;
		
		
	}
	
	function fieldHasChanged($fName,$dtaObj)
	{
		$ret = false;
		if ($this->orgVals[$fName] != $dtaObj[$fName])
		{
			$ret = true;
			
		}
		
		return $ret;
	}
	
	function setCorrectFieldVal($dtaObj)
	{
		$dtaObj["VIN_ITEM_SUETA"] = abs($dtaObj["VIN_ITEM_SUETA"] * 1);
		$dtaObj["VIN_ITEM_MINQT"] = abs($dtaObj["VIN_ITEM_MINQT"] * 1);
		$dtaObj["VIN_ITEM_MAXQT"] = abs($dtaObj["VIN_ITEM_MAXQT"] * 1);
		$dtaObj["VIN_ITEM_MINSD"] = abs($dtaObj["VIN_ITEM_MINSD"] * 1);
		$dtaObj["VIN_ITEM_MAXSD"] = abs($dtaObj["VIN_ITEM_MAXSD"] * 1);
		$dtaObj["VIN_ITEM_PUMIN"] = abs($dtaObj["VIN_ITEM_PUMIN"] * 1);
		$dtaObj["VIN_ITEM_PURND"] = abs($dtaObj["VIN_ITEM_PURND"] * 1);
		$dtaObj["VIN_ITEM_SHLIF"] = abs($dtaObj["VIN_ITEM_SHLIF"] * 1);
		$dtaObj["VIN_ITEM_OVAGE"] = abs($dtaObj["VIN_ITEM_OVAGE"] * 1);
		$dtaObj["VIN_ITEM_LPCDA"] = trim($dtaObj["VIN_ITEM_LPCDA"]);
		
		return $dtaObj;
	}

	function dbSetTrig()
	{


	if ($this->sessionId == "VIN_ITEMS" )
	{

		if (!$this->dbSuppTbl)
		{
			$this->dbSuppTbl = array();
		}
		$pObj = $_SESSION["lastPost"];



		$wTbls = new vin_item_lots($this->tblInfo->schema);
		$wTbls->dbFindFrom($pObj);
		$this->dbSuppTbl["vin_item_vin_lshe"] = $wTbls;

		$wTbls = new vin_item_specs($this->tblInfo->schema);
		$wTbls->dbFindFrom($pObj);
		$this->dbSuppTbl["vin_item_vin_ssma"] = $wTbls;
		


$trig = <<<EOD
			SELECT  * FROM   
			 
		 	( SELECT  * FROM vin_item  
		 	
		LEFT JOIN vin_grou  ON idVIN_GROU = VIN_ITEM_ITGRP  [=COND:vin_grou=] 
		LEFT JOIN vin_ityp  ON idVIN_ITYP = VIN_ITEM_SEAR1  [=COND:vin_ityp=]
		LEFT JOIN vin_unit  ON idVIN_UNIT = VIN_ITEM_UNITM  [=COND:vin_unit=]
		LEFT JOIN vin_inve  ON VIN_INVE_ITMID = idVIN_ITEM  [=COND:vin_inve=]
		LEFT JOIN vin_lshe  ON VIN_LSHE_ITMID = idVIN_ITEM  [=COND:vin_lshe=]
								
		WHERE [=WHERE=]  [=COND:vin_item=]  [=LIMIT=] ) tx	  
		
EOD;
		
	}
	else
	{
	
$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vin_item 
		LEFT JOIN vin_unit  ON idVIN_UNIT = VIN_ITEM_ACUOM  [=COND:vgl_unit=]
		LEFT JOIN vgl_schh  ON idVGL_SCHH = VIN_ITEM_ISCID  [=COND:vgl_schh=] 
		LEFT JOIN vin_grou  ON idVIN_GROU = VIN_ITEM_ITGRP  [=COND:vin_grou=] 
		LEFT JOIN vin_ityp  ON idVIN_ITYP = VIN_ITEM_SEAR1  [=COND:vin_ityp=] 
		LEFT JOIN vin_uset  ON idVIN_USET = VIN_ITEM_UNSET  [=COND:vin_uset=] 
		LEFT JOIN vin_wars  ON idVIN_WARS = VIN_ITEM_WARID  [=COND:vin_wars=] 
		LEFT JOIN vin_lshe  ON VIN_LSHE_ITMID = idVIN_ITEM  [=COND:vin_lshe=]
		LEFT JOIN vin_ssit  ON VIN_SSIT_ITMID = idVIN_ITEM  [=COND:vin_ssit=]
		LEFT JOIN vin_ssma  ON idVIN_SSMA = VIN_SSIT_SPESQ  [=COND:vin_ssma=]
		LEFT JOIN vgb_supp  ON VIN_LSHE_BPART = idVGB_SUPP  [=COND:vgb_supp=]			
		WHERE [=WHERE=]  [=COND:vin_item=]  [=LIMIT=] ) tx		
		
EOD;

	}

	return $trig;
	
	
//		LEFT JOIN vin_ssit  ON VIN_SSIT_ITMID = idVIN_ITEM  [=COND:vin_ssit=]
//		LEFT JOIN vin_ssma  ON idVIN_SSMA = VIN_SSIT_SPESQ  [=COND:vin_ssma=]
//		LEFT JOIN vin_inve  ON VIN_INVE_ITMID = idVIN_ITEM  [=COND:vin_inve=]
//		LEFT JOIN vgb_supp  ON VIN_LSHE_BPART = idVGB_SUPP  [=COND:vgb_supp=]
		
	}
}


class vin_item_lots extends dbMaster
{

	function vin_item_lots($schema)
	{
		$this->dbMaster("vin_item",$schema);
	}


	function dbSetTrig()
	{


		$localWhere = "";
		// $this->E_POST = $_SESSION["lastPost"];
		
		if ($this->E_POST["vin_item_lots"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["vin_item_lots"]);
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

		
$trig = <<<EOD
			SELECT  * FROM   
			 
		 	( SELECT  * FROM vin_item  
		 	
		LEFT JOIN vin_lshe  ON VIN_LSHE_ITMID = idVIN_ITEM  [=COND:vin_lshe=]
		LEFT JOIN vin_ssit  ON VIN_SSIT_ITMID = VIN_LSHE_ITMID  [=COND:vin_ssit=]
		LEFT JOIN vin_ssma  ON idVIN_SSMA = VIN_SSIT_SPESQ  [=COND:vin_ssma=]
		LEFT JOIN vin_sslt  ON VIN_SSLT_ITMID = VIN_LSHE_ITMID AND VIN_SSLT_LOTID = idVIN_LSHE   [=COND:vin_sslt=]
		LEFT JOIN vgb_supp  ON VIN_LSHE_BPART = idVGB_SUPP  [=COND:vgb_supp=]
		WHERE $localWhere [=WHERE=]  [=COND:vin_item=]  [=LIMIT=] ) tx	  
		
EOD;

		return $trig;
	}

}

class vin_item_specs extends dbMaster
{

	function vin_item_specs($schema)
	{
		$this->dbMaster("vin_item",$schema);
	}


	function dbSetTrig()
	{
		$localWhere = "";
		// $this->E_POST = $_SESSION["lastPost"];
		
		if ($this->E_POST["vin_item_specs"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["vin_item_specs"]);
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
		


		
$trig = <<<EOD
			SELECT  * FROM   
			 
		 	( SELECT  * FROM vin_item  
		 	
		LEFT JOIN vin_ssit  ON VIN_SSIT_ITMID = idVIN_ITEM  [=COND:vin_ssit=]
		LEFT JOIN vin_ssma  ON idVIN_SSMA = VIN_SSIT_SPESQ  [=COND:vin_ssma=]
		LEFT JOIN vin_sslt  ON VIN_SSLT_ITMID = idVIN_ITEM  [=COND:vin_sslt=]
								
		WHERE $localWhere [=WHERE=]  [=COND:vin_item=]  [=LIMIT=] ) tx	  
		
EOD;


		return $trig;
	}

		


}




class vin_item_replenish extends dbMaster
{
	function vin_item_replenish($schema)
	{
		$this->dbMaster("vin_item",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}
	
	function dbSetTrig()
	{

				
$trig = <<<EOD

			SELECT * FROM
			 
		 	( SELECT * FROM vin_item 
		LEFT JOIN vin_inve  ON VIN_INVE_ITMID = idVIN_ITEM  [=COND:vin_inve=]		 	
							
		WHERE [=WHERE=]  [=COND:vin_item=]  [=LIMIT=] ) tx		
		
EOD;

		return $trig;
	}
	
	function dbFindFrom($dtaObj)
	{
		
		$E_POST = $dtaObj;
	  	// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
	  	
		$E_POST["MAXREC_OUT"] = 0;
		
		
	  	$wTbls = new vin_item_replen_inv($this->tblInfo->schema);
		$wTbls->dbFindFrom($E_POST);		
		
		$this->orgFind = $wTbls;
		
		$filterRec = $wTbls->result;
		$itemList = array();
		
		$occ = 0;
		while ($occ < count($filterRec))
		{
			if (!$itemList[$filterRec[$occ]["idVIN_ITEM"]])
			{
				$itemList[$filterRec[$occ]["idVIN_ITEM"]] = array();
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["maxQty"] = $filterRec[$occ]["VIN_ITEM_MINQT"];
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["invQty"] = 0;
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["BOHQty"] = 0;
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["ALOQty"] = 0;
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["PURQty"] = 0;
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["hasLot"] = $filterRec[$occ]["idVIN_LSHE"];
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["hasSpecs"] = $filterRec[$occ]["idVIN_SSMA"].":".$filterRec[$occ]["idVIN_LSHE"];
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["hasQuo"] = $filterRec[$occ]["idVIN_CUST"];
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["required"] = 0;
				
			}
			if ($filterRec[$occ]["idVIN_INVE"])
			{
				$qtyTmp = $filterRec[$occ]["VIN_INVE_BOHQT"] - $filterRec[$occ]["VIN_INVE_ALOQT"] + $filterRec[$occ]["VIN_INVE_PURQT"];
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["invQty"] += $qtyTmp;
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["BOHQty"] += $filterRec[$occ]["VIN_INVE_BOHQT"];
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["ALOQty"] += $filterRec[$occ]["VIN_INVE_ALOQT"];
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["PURQty"] += $filterRec[$occ]["VIN_INVE_PURQT"];
			}
			
			if ($filterRec[$occ]["idVIN_LSHE"])
			{
				if (strpos("x," . $itemList[$filterRec[$occ]["idVIN_ITEM"]]["hasLot"] . "," , ",". $filterRec[$occ]["idVIN_LSHE"] . "," ) < 1 )
				{
					$itemList[$filterRec[$occ]["idVIN_ITEM"]]["hasLot"] .= "," . $filterRec[$occ]["idVIN_LSHE"];
				}
			}
				
			if ($filterRec[$occ]["idVIN_SSMA"])
			{
				if (strpos("x," . $itemList[$filterRec[$occ]["idVIN_ITEM"]]["hasSpecs"] . "," , ",". $filterRec[$occ]["idVIN_SSMA"].":".$filterRec[$occ]["idVIN_LSHE"] . "," ) < 1 )
				{
					$itemList[$filterRec[$occ]["idVIN_ITEM"]]["hasSpecs"] .= "," . $filterRec[$occ]["idVIN_SSMA"].":".$filterRec[$occ]["idVIN_LSHE"];
				}
			}

			if ($filterRec[$occ]["idVIN_CUST"])
			{
				if (strpos("x," . $itemList[$filterRec[$occ]["idVIN_ITEM"]]["hasQuo"] . "," , ",". $filterRec[$occ]["idVIN_CUST"] . "," ) < 1 )
				{
					$itemList[$filterRec[$occ]["idVIN_ITEM"]]["hasQuo"] .= "," . $filterRec[$occ]["idVIN_CUST"];
				}
			}

			$occ += 1;
		}
		
		$newRec = "";
		$fs = "";
		$occ = 0;
		while ($occ < count($filterRec))
		{
			if ($itemList[$filterRec[$occ]["idVIN_ITEM"]]["maxQty"] < $itemList[$filterRec[$occ]["idVIN_ITEM"]]["invQty"])
			{
				if ( ($itemList[$filterRec[$occ]["idVIN_ITEM"]]["hasLot"] && $itemList[$filterRec[$occ]["idVIN_ITEM"]]["ALOQty"] > 0)
				|| ($itemList[$filterRec[$occ]["idVIN_ITEM"]]["hasQuo"] && $itemList[$filterRec[$occ]["idVIN_ITEM"]]["ALOQty"] > 0) )
				{
					if (strpos("x," . $newRec . "," , ",". $filterRec[$occ]["idVIN_ITEM"] . "," ) < 1 )
					{
						$newRec .= $fs  . $filterRec[$occ]["idVIN_ITEM"];
						$fs = ",";
					}
					
				} 
			}
			else
			{
				if (!$itemList[$filterRec[$occ]["idVIN_ITEM"]]["maxQty"] && $itemList[$filterRec[$occ]["idVIN_ITEM"]]["invQty"] == 0)
				{
				}
				else
				{
					$itemList[$filterRec[$occ]["idVIN_ITEM"]]["required"] = 1;
					if (strpos("x," . $newRec . "," , ",". $filterRec[$occ]["idVIN_ITEM"] . "," ) < 1 )
					{
						$newRec .= $fs  . $filterRec[$occ]["idVIN_ITEM"];
						$fs = ",";
					}
				}
			}
				
			$occ += 1;
		}
		
		$E_POST["MAXREC_OUT"] = 0;
		$E_POST["vin_item_vslvpu"] = $newRec;
		
	  	$wTbls = new vin_item_replen_sp($this->tblInfo->schema);
		$wTbls->dbFindFrom($E_POST);		

		$mainResult = $wTbls->result;
		$occ = 0;
		while ($occ < count($mainResult))
		{
			$wTMP = $itemList[$mainResult[$occ]["idVIN_ITEM"]];

			foreach($wTMP as $name => $value)
			{
				 $mainResult[$occ][$name] = $value;
			}				
			
			$occ += 1;
		}
		
		$wTbls->result = $mainResult;
		$this->itemList = $itemList;	
		

		
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
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
	

	function dbFindMatch($objDta)
	{
		$this->localdbFnct = "Procedure Replenish";
		$this->localE_POST = $objDta;
		
		
		
		$trigObj = array();
		
		$td = getdate();
		$month = strval($td['mon'] + 100);
		$mday = strval($td['mday'] + 100);
		$year = $td['year']-1;
		$newDay = $year . "-" . substr($month,1) . "-" . substr($mday,1);		
		
		$trigObj["compareDate"] = $newDay;
		$this->compareDate = $trigObj["compareDate"];
		
		$trig = $this->setTrigRepl($trigObj);
		$this->trigger = $trig;

		$tFnc = new AB_querySession;
		$trig = $tFnc->tblAccessCond($objDta,$trig,true,"onaccess,onaccess.USR");
		
		$this->triggerAfterTblAccessCond= $trig;
			
	  	$mtdTbls = new dbMaster("vsl_orst",$this->tblInfo->schema);
		$mtdTbls->dbProcessTransactionPdo($trig);
		
		

		
		$occ = 0;
		$specList = "";
		if ($mtdTbls->result)
		{
			while($occ < count($mtdTbls->result))
			{
				$specTmp = explode(",",$mtdTbls->result[$occ]["specs"]);
				$wocc = 0;
				while ($wocc < count($specTmp))
				{
					if ($specTmp[$wocc] && strpos('x,' . $specList . ',',','.$specTmp[$wocc].',') < 1)
					{
						$specList .= $specTmp[$wocc] . ",";
					}
					$wocc += 1;
				}
				$occ +=1;
			}
		}
		$occ = 0;
		$specList = "";
		if ($mtdTbls->result)
		{
			while($occ < count($mtdTbls->result))
			{
				$specTmp = $mtdTbls->result[$occ]["idVIN_ITEM"];
				if ($specTmp && strpos('x,' . $specList . ',',','.$specTmp.',') < 1)
				{
					$specList .= $specTmp . ",";
				}
				$occ +=1;
			}
		}
		
		$mtdTbls->specList = $specList;
		if ($specList)
		{
			// Get Orders
			$trig = $this->setTrigOrders($specList);
			$this->orderTrigger = $trig;
	
			$tFnc = new AB_querySession;
			$trig = $tFnc->tblAccessCond($objDta,$trig,true,"onaccess,onaccess.USR");
			
			$this->orderTriggerAfterTblAccessCond= $trig;
				
		  	$specTbls = new dbMaster("vsl_orde",$this->tblInfo->schema);
			$specTbls->dbProcessTransactionPdo($trig);
			
			$this->ordersResult = $specTbls;	
			

			if (!$mtdTbls->dbSuppTbl)
			{
				$mtdTbls->dbSuppTbl = array();
			}
			$mtdTbls->dbSuppTbl["vsl_replOrders"] = $specTbls;


			// Get Lot specs
			$trig = $this->setTrigSpecs($specList);
			$this->specTrigger = $trig;
	
			$tFnc = new AB_querySession;
			$trig = $tFnc->tblAccessCond($objDta,$trig,true,"onaccess,onaccess.USR");
			
			$this->specTriggerAfterTblAccessCond= $trig;
				
		  	$specTbls = new dbMaster("vin_item",$this->tblInfo->schema);
			$specTbls->dbProcessTransactionPdo($trig);
			
			$this->specResult = $specTbls;	
			if (!$mtdTbls->dbSuppTbl)
			{
				$mtdTbls->dbSuppTbl = array();
			}
			$mtdTbls->dbSuppTbl["vin_replSpecs"] = $specTbls;

			$vslTbls = new vsl_DEL_EVAL($this->tblInfo->schema);
			$vslTbls->dbFindMatch($objDta);
			$this->vslTbls = $vslTbls;

	
		}
		
		
		foreach($mtdTbls as $name => $value)
		{
			 $this->$name = $value;
		}		
	}
	

	function setTrigRepl($objDta)
	{

		$startDate = $objDta["compareDate"];

$trig =<<<EOC


SELECT *

FROM
 
(
SELECT VIN_INVE_ITMID as idVIN_ITEM, VIN_ITEM_ITMID, VIN_ITEM_DESC1, VIN_ITEM_SUETA, VIN_ITEM_MINQT, VIN_ITEM_MINSD, 
VIN_INVE_BOHQT, VIN_INVE_ALOQT, VIN_INVE_PURQT,
(@xx:= '') as xxxx,
SUM(VIN_INVE_BOHQT) as BOHQT,
SUM(VIN_INVE_ALOQT) as ALOQT,
SUM(VIN_INVE_PURQT) as PURQT,
(@ab:= 0) as ACKQT,
(@dd:= '') as FIRSTD,
(@aa:='vin_inve') as rTable,
(@bb:='') as lotId,
(@bx:='') as idVIN_LSHE,
(@rr:= '') as specs

FROM vin_item 
LEFT JOIN vin_inve  ON VIN_INVE_ITMID = idVIN_ITEM [=COND:vin_inve=]
WHERE idVIN_ITEM IS NOT NULL AND VIN_ITEM_INVIT = '1' [=COND:vin_item=]
GROUP BY VIN_ITEM_ITMID

UNION

SELECT VIN_LSLQ_ITMID as idVIN_ITEM, VIN_ITEM_ITMID, VIN_ITEM_DESC1, VIN_ITEM_SUETA, VIN_ITEM_MINQT, VIN_ITEM_MINSD, 
VIN_LSLQ_BOHQT, VIN_LSLQ_ALOQT, VIN_LSLQ_PURQT,
(@xx:= '') as xxxx,
SUM(VIN_LSLQ_BOHQT) as BOHQT,
SUM(VIN_LSLQ_ALOQT) as ALOQT,
SUM(VIN_LSLQ_PURQT) as PURQT,
(@ab:= 0) as ACKQT,
(@dd:= '') as FIRSTD,
(@aa:='vin_lslq') as rTable,
VIN_LSHE_LOTID as lotId,
idVIN_LSHE,
(@rr:= '') as specs
FROM vin_item 
LEFT JOIN vin_lslq  ON VIN_LSLQ_ITMID = idVIN_ITEM [=COND:vin_lslq=]
LEFT JOIN vin_lshe  ON VIN_LSLQ_LOTSQ = idVIN_LSHE [=COND:vin_lshe=]
WHERE idVIN_ITEM IS NOT NULL AND VIN_ITEM_INVIT = '1' [=COND:vin_item=]
GROUP BY VIN_ITEM_ITMID,idVIN_LSLQ


UNION

SELECT idVIN_ITEM, 
VIN_SSMA_SPEID as VIN_ITEM_ITMID, 
VIN_SSMA_DESCR as VIN_ITEM_DESC1, 
VIN_SSMA_SUETA as VIN_ITEM_SUETA, 
VIN_ITEM_MINQT, VIN_ITEM_MINSD, 
VIN_LSLQ_BOHQT, VIN_LSLQ_ALOQT, VIN_LSLQ_PURQT,
(@xx:= '') as xxxx,
SUM(VIN_LSLQ_BOHQT) as BOHQT,
SUM(VIN_LSLQ_ALOQT) as ALOQT,
SUM(VIN_LSLQ_PURQT) as PURQT,
(@ab:= 0) as ACKQT,
(@dd:= '') as FIRSTD,
(@aa:='vin_specqty') as rTable,
idVIN_SSMA as lotId,
idVIN_LSHE,
(@rr:= '') as specs
FROM vin_item 
LEFT JOIN vin_ssit ON VIN_SSIT_ITMID = idVIN_ITEM [=COND:vin_ssit=]
LEFT JOIN vin_ssma ON idVIN_SSMA = VIN_SSIT_SPESQ [=COND:vin_ssma=]
LEFT JOIN vin_sslt ON VIN_SSLT_ITMID = idVIN_ITEM AND idVIN_SSMA = VIN_SSLT_SPESQ [=COND:vin_sslt=]
LEFT JOIN vin_lslq  ON VIN_LSLQ_LOTSQ = VIN_SSLT_LOTID [=COND:vin_lslq=]
LEFT JOIN vin_lshe  ON VIN_LSLQ_LOTSQ = idVIN_LSHE [=COND:vin_lshe=]
WHERE idVIN_ITEM IS NOT NULL AND VIN_ITEM_INVIT = '1' [=COND:vin_item=]
GROUP BY idVIN_ITEM,idVIN_SSMA



UNION

SELECT VSL_ORDE_ITMID as idVIN_ITEM, VIN_ITEM_ITMID, VIN_ITEM_DESC1, VIN_ITEM_SUETA, VIN_ITEM_MINQT, VIN_ITEM_MINSD, 
VSL_ORDE_LSPEC,
(@ba:= '') as nothingA,
(@bb:= '') as nothingB,
(@bc:= '') as nothingC,
(@aa:= 0) as BOHQT,
(@ab:= 0) as ALOQT,
(@ac:= 0) as PURQT,
sum(CASE WHEN VSL_ORST_STEPS = 'FF_PICK'  THEN (VSL_ORST_ORDQT) ELSE 0 END ) as ACKQT,
(@dd:= '') as FIRSTD,
(@ax:='vsl_orst') as rTable,
(@zz:='') as lotId,
(@bx:='') as idVIN_LSHE,
GROUP_CONCAT(VSL_ORDE_LSPEC) as specs

FROM vsl_orst
left join vsl_orde ON VSL_ORST_ORLIN = idVSL_ORDE [=COND:vsl_orde=]
left join vin_item ON VSL_ORDE_ITMID = idVIN_ITEM [=COND:vin_item=]
left join vsl_orhe ON VSL_ORST_ORNUM = idVSL_ORHE [=COND:vsl_orhe=]
WHERE VSL_ORST_STEPS BETWEEN  'FF_PICK' AND 'II_DELI' AND idVIN_ITEM IS NOT NULL AND VIN_ITEM_INVIT = '1' AND idVSL_ORDE IS NOT NULL AND idVSL_ORHE IS NOT NULL [=COND:VSL_ORST=]
GROUP BY VIN_ITEM_ITMID


UNION

SELECT VPU_ORDE_ITMID as idVIN_ITEM, VIN_ITEM_ITMID, VIN_ITEM_DESC1, VIN_ITEM_SUETA, VIN_ITEM_MINQT, VIN_ITEM_MINSD, 
VPU_ORDE_LSPEC,
(@ba:= '') as nothingA,
(@bb:= '') as nothingB,
(@bc:= '') as nothingC,
(@aa:= 0) as BOHQT,
(@ab:= 0) as ALOQT,
(@ac:= 0) as PURQT,
sum(CASE WHEN VPU_ORST_STEPS = 'FF_PICK'  THEN (VPU_ORST_ORDQT) ELSE 0 END ) as ACKQT,
(@dd:= '') as FIRSTD,
(@ax:='vpu_orst') as rTable,
(@zz:='') as lotId,
(@bx:='') as idVIN_LSHE,
GROUP_CONCAT(VPU_ORDE_LSPEC) as specs

FROM vpu_orst
left join vpu_orde ON VPU_ORST_ORLIN = idVPU_ORDE [=COND:vpu_orde=]
left join vin_item ON VPU_ORDE_ITMID = idVIN_ITEM [=COND:vin_item=]
left join vpu_orhe ON VPU_ORST_ORNUM = idVPU_ORHE [=COND:vpu_orhe=]
WHERE VPU_ORST_STEPS BETWEEN  'FF_PICK' AND 'II_DELI' AND idVIN_ITEM IS NOT NULL AND VIN_ITEM_INVIT = '1' AND idVPU_ORDE IS NOT NULL AND idVPU_ORHE IS NOT NULL [=COND:VPU_ORST=]
GROUP BY VIN_ITEM_ITMID


UNION

SELECT VSL_ORDE_ITMID as idVIN_ITEM, VIN_ITEM_ITMID, VIN_ITEM_DESC1, VIN_ITEM_SUETA, VIN_ITEM_MINQT, VIN_ITEM_MINSD,
VSL_ORDE_LSPEC,
(@ba:= '') as nothingA,
(@bb:= '') as nothingB,
(@bc:= '') as nothingC,
(@aa:= 0) as BOHQT,
(@ab:= 0) as ALOQT,
(@ac:= 0) as PURQT,
sum(VSL_ORST_ORDQT) as ACKQT,
MIN(VSL_ORST_DDATE) as FIRSTD,
(@ax:='vin_qtys') as rTable,
(@zz:='') as lotId,
(@bx:='') as idVIN_LSHE,
GROUP_CONCAT(VSL_ORDE_LSPEC) as specs

FROM vsl_orst
left join vsl_orde ON VSL_ORST_ORLIN = idVSL_ORDE [=COND:vsl_orde=]
left join vin_item ON VSL_ORDE_ITMID = idVIN_ITEM [=COND:vin_item=]
left join vsl_orhe ON VSL_ORST_ORNUM = idVSL_ORHE [=COND:vsl_orhe=]
WHERE VSL_ORST_STEPS > 'II_DELI' AND VSL_ORDE_DDATE >= '{$startDate}' AND idVIN_ITEM IS NOT NULL AND VIN_ITEM_INVIT = '1' AND idVSL_ORDE IS NOT NULL AND idVSL_ORHE IS NOT NULL [=COND:VSL_ORST=]
GROUP BY VIN_ITEM_ITMID

) tx		


ORDER BY VIN_ITEM_ITMID 


EOC;

	return $trig;

	}

	function setTrigOrders($objDta)
	{
		$specChk = explode(",", $objDta);
		$itemCond = " AND ( ";
		
		$OR = "";
		$occ = 0;
		while ($occ < count($specChk))
		{
			if ($specChk[$occ])
			{
				$itemCond .= $OR . " idVIN_ITEM = '" . $specChk[$occ] . "' ";
				$OR = " OR ";
			}
			$occ +=1;
		}


		$itemCond .= " ) ";

$trig =<<<EOC


SELECT 	idVSL_ORHE as ORDID, VSL_ORHE_ORNUM as ORNUM, 
VSL_ORHE_ODATE as ODATE, 
VSL_ORHE_CUSPO as CUSPO, 
VSL_ORDE_ORLIN as ORLIN, 
VSL_ORDE_DDATE as DDATE, 
VSL_ORDE_DESCR as DESCR, 
VSL_ORDE_LSPEC as LSPEC, 
VSL_ORST_STPSQ as STPSQ, 
VSL_ORST_ORDQT as ORDQT,
VSL_ORST_STEPS as STEPS,
VGB_CUST_BPNAM as BPNAM,
idVSL_LSTR as LSTID,
VSL_LSTR_ALOQT as LOTQT,
idVIN_ITEM,
VIN_ITEM_ITMID,
VIN_ITEM_DESC1,
VIN_ITEM_SUETA,
VSL_ORHE_USLNA as USLNA,
CFG_USERS_DESIGNATION,
idVIN_SSMA,
VIN_SSMA_SPEID,
VIN_SSMA_SUETA,
VIN_LSHE_LOTID,
VIN_LSHE_SERNO,
idVIN_LSHE,
(@ax:='sales') as rTable

FROM vsl_orde
left join vsl_orhe ON idVSL_ORHE = VSL_ORDE_ORNUM [=COND:vsl_orhe=]
left join vgb_cust ON idVGB_CUST = VSL_ORHE_BTCUS [=COND:vgb_cust=]
left join vin_item ON idVIN_ITEM = VSL_ORDE_ITMID [=COND:vin_item=]
left join vin_ssma ON CONCAT(",",VSL_ORDE_LSPEC) LIKE CONCAT('%,',idVIN_SSMA,',%')  [=COND:vin_ssma=]
left join org_dimension.cfg_users ON CFG_USERS_CODE = VSL_ORHE_USLNA 	
left join vsl_orst ON VSL_ORST_ORLIN = idVSL_ORDE  [=COND:vsl_orst=]
left join vsl_lstr ON VSL_LSTR_STPSQ = idVSL_ORST  [=COND:vsl_lstr=]
left join vin_lshe ON VSL_LSTR_LOTSQ = idVIN_LSHE  [=COND:vin_lshe=]

WHERE idVIN_ITEM IS NOT NULL AND idVSL_ORDE IS NOT NULL AND idVSL_ORHE IS NOT NULL AND 
VSL_ORST_STEPS BETWEEN  'FF_PICK' AND 'II_DELI' {$itemCond}  [=COND:vsl_orde=]


UNION

SELECT 	idVPU_ORHE as ORDID, VPU_ORHE_ORNUM as ORNUM, 
VPU_ORHE_ODATE as ODATE, 
VPU_ORHE_CUSPO as CUSPO, 
VPU_ORDE_ORLIN as ORLIN, 
VPU_ORDE_DDATE as DDATE, 
VPU_ORDE_DESCR as DESCR, 
VPU_ORDE_LSPEC as LSPEC, 
VPU_ORST_STPSQ as STPSQ, 
VPU_ORST_ORDQT as ORDQT,
VPU_ORST_STEPS as STEPS,
VGB_SUPP_BPNAM as BPNAM,
idVPU_LSTR as LSTID,
VPU_LSTR_ALOQT as LOTQT,
idVIN_ITEM,
VIN_ITEM_ITMID,
VIN_ITEM_DESC1,
VIN_ITEM_SUETA,
VPU_ORHE_USLNA as USLNA,
CFG_USERS_DESIGNATION,
idVIN_SSMA,
VIN_SSMA_SPEID,
VIN_SSMA_SUETA,
VIN_LSHE_LOTID,
VIN_LSHE_SERNO,
idVIN_LSHE,
(@ax:='purch') as rTable

FROM vpu_orde
left join vpu_orhe ON idVPU_ORHE = VPU_ORDE_ORNUM [=COND:vpu_orhe=]
left join vgb_supp ON idVGB_SUPP = VPU_ORHE_BTCUS [=COND:vgb_supp=]
left join vin_item ON idVIN_ITEM = VPU_ORDE_ITMID [=COND:vin_item=]
left join vin_ssma ON CONCAT(",",VPU_ORDE_LSPEC) LIKE CONCAT('%,',idVIN_SSMA,',%')  [=COND:vin_ssma=]
left join org_dimension.cfg_users ON CFG_USERS_CODE = VPU_ORHE_USLNA 	
left join vpu_orst ON VPU_ORST_ORLIN = idVPU_ORDE  [=COND:vpu_orst=]
left join vpu_lstr ON VPU_LSTR_STPSQ = idVPU_ORST  [=COND:vpu_lstr=]
left join vin_lshe ON VPU_LSTR_LOTSQ = idVIN_LSHE  [=COND:vin_lshe=]

WHERE idVIN_ITEM IS NOT NULL AND idVPU_ORDE IS NOT NULL AND idVPU_ORHE IS NOT NULL AND 
VPU_ORST_STEPS BETWEEN  'FF_PICK' AND 'II_DELI' {$itemCond}  [=COND:vpu_orde=]


EOC;
	
		return $trig;	
	}
	

	function setTrigSpecs($objDta)
	{
		$specChk = explode(",", $objDta);
		$itemCond = " AND ( ";
		
		$OR = "";
		$occ = 0;
		while ($occ < count($specChk))
		{
			if ($specChk[$occ])
			{
				$itemCond .= $OR . " idVIN_ITEM = '" . $specChk[$occ] . "' ";
				$OR = " OR ";
			}
			$occ +=1;
		}


		$itemCond .= " ) ";

$trig =<<<EOC


SELECT idVIN_ITEM, idVIN_LSHE,idVIN_SSMA, VIN_SSMA_SPEID, VIN_SSMA_DESCR, VIN_SSMA_SUETA

FROM vin_ssma
LEFT JOIN vin_sslt ON VIN_SSLT_SPESQ = idVIN_SSMA 
LEFT JOIN vin_lshe ON idVIN_LSHE = VIN_SSLT_LOTID AND VIN_LSHE_SOLDO = '0' 
LEFT JOIN vin_item ON idVIN_ITEM = VIN_SSLT_ITMID {$itemCond}

WHERE idVIN_ITEM IS NOT NULL AND idVIN_LSHE IS NOT NULL
ORDER BY idVIN_ITEM


EOC;
	
		return $trig;	
	}
	
}



class vin_item_replen_inv extends dbMaster
{
	function vin_item_replen_inv($schema)
	{
		$this->dbMaster("vin_item",$schema);
	}
	
	function dbSetTrig()
	{

				
$trig = <<<EOD
	
	SELECT * FROM
	 
	( SELECT * FROM vin_item 
		LEFT JOIN vin_inve  ON VIN_INVE_ITMID = idVIN_ITEM  [=COND:vin_inve=]		 	
		LEFT JOIN vin_lshe  ON VIN_LSHE_ITMID = idVIN_ITEM AND VIN_LSHE_SOLDO = '0' [=COND:vin_lshe=]
		LEFT JOIN vin_sslt  ON VIN_SSLT_ITMID = idVIN_ITEM AND VIN_SSLT_LOTID = idVIN_LSHE  [=COND:vin_sslt=]
		LEFT JOIN vin_ssma  ON idVIN_SSMA = VIN_SSLT_SPESQ [=COND:vin_ssma=]
		LEFT JOIN vin_cust  ON VIN_CUST_ITMID = idVIN_ITEM AND VIN_CUST_ACTYP = 'SUPP' [=COND:vin_cust=]
					
	WHERE [=WHERE=]  [=COND:vin_item=] ORDER BY VIN_ITEM_ITMID ASC [=LIMIT=] ) tx		
		
EOD;

		return $trig;
	}
}


class vin_item_replen_sp extends dbMaster
{
// Sales & Purchase
	
	function vin_item_replen_sp($schema)
	{
		$this->dbMaster("vin_item",$schema);
	}
	
	function dbSetTrig()
	{

		if ($this->E_POST["vin_item_vslvpu"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["vin_item_vslvpu"]);
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
		$this->IQ = $localWhere;
				
$trig = <<<EOD

			SELECT * FROM
			 
		 	( SELECT * FROM vin_item 

		LEFT JOIN vsl_orde  ON VSL_ORDE_ITMID = idVIN_ITEM  [=COND:vsl_orde=]
		LEFT JOIN vsl_orhe  ON VSL_ORDE_ORNUM = idVSL_ORHE  [=COND:vsl_orhe=]
		LEFT JOIN vsl_orst  ON VSL_ORST_ORLIN = idVSL_ORDE AND VSL_ORST_STEPS > 'FF_A' AND VSL_ORST_STEPS < 'II_DELX' [=COND:vsl_orst=]
		LEFT JOIN vsl_lstr  ON VSL_LSTR_STPSQ = idVSL_ORST  [=COND:vsl_lstr=]
		LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=] 
		 	
		LEFT JOIN vpu_orde  ON VPU_ORDE_ITMID = idVIN_ITEM  [=COND:vpu_orde=]
		LEFT JOIN vpu_orhe  ON VPU_ORDE_ORNUM = idVPU_ORHE  [=COND:vpu_orhe=]
		LEFT JOIN vpu_orst  ON VPU_ORST_ORLIN = idVPU_ORDE AND VPU_ORST_STEPS > 'FF_A' AND VPU_ORST_STEPS < 'II_DELX' [=COND:vpu_orst=]
		LEFT JOIN vpu_lstr  ON VPU_LSTR_STPSQ = idVPU_ORST  [=COND:vpu_lstr=]
		LEFT JOIN vgb_supp  ON idVGB_SUPP = VPU_ORHE_BTCUS  [=COND:vgb_supp=] 
		
		LEFT JOIN vin_lshe  ON idVIN_LSHE = VPU_LSTR_LOTSQ OR idVIN_LSHE = VSL_LSTR_LOTSQ [=COND:vin_lshe=]		
								
		WHERE $localWhere [=WHERE=]  [=COND:vin_item=]  [=LIMIT=] ) tx		
		
EOD;

		return $trig;
	}
}




// END

class vin_item_vsl extends dbMaster
{
	function vin_item_vsl($schema)
	{
		$this->dbMaster("vin_item",$schema);
	}
	
	function dbSetTrig()
	{

		if ($this->E_POST["vin_item_vsl"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["vin_item_vsl"]);
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
		$this->IQ = $localWhere;
				
$trig = <<<EOD

			SELECT * FROM
			 
		 	( SELECT * FROM vin_item 
		LEFT JOIN vsl_orde  ON VSL_ORDE_ITMID = idVIN_ITEM  [=COND:vsl_orde=]
		LEFT JOIN vsl_orhe  ON VSL_ORDE_ORNUM = idVSL_ORHE  [=COND:vsl_orhe=]
		LEFT JOIN vsl_orst  ON VSL_ORST_ORLIN = idVSL_ORDE  [=COND:vsl_orst=]
		LEFT JOIN vsl_lstr  ON VSL_LSTR_STPSQ = idVSL_ORST  [=COND:vsl_lstr=]
		LEFT JOIN vin_lshe  ON idVIN_LSHE = VSL_LSTR_LOTSQ  [=COND:vin_lshe=]
		
		LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=] 
								
		WHERE $localWhere [=WHERE=]  [=COND:vin_item=]  [=LIMIT=] ) tx		
		
EOD;

		return $trig;
	}
}
	
class vin_item_vpu extends dbMaster
{
	function vin_item_vpu($schema)
	{
		$this->dbMaster("vin_item",$schema);
	}
	
	function dbSetTrig()
	{

		if ($this->E_POST["vin_item_vpu"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["vin_item_vpu"]);
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
		$this->IQ = $localWhere;
				
$trig = <<<EOD

			SELECT * FROM
			 
		 	( SELECT * FROM vin_item 
		LEFT JOIN vpu_orde  ON VPU_ORDE_ITMID = idVIN_ITEM  [=COND:vpu_orde=]
		LEFT JOIN vpu_orhe  ON VPU_ORDE_ORNUM = idVPU_ORHE  [=COND:vpu_orhe=]
		LEFT JOIN vpu_orst  ON VPU_ORST_ORLIN = idVPU_ORDE  [=COND:vpu_orst=]
		LEFT JOIN vpu_lstr  ON VPU_LSTR_STPSQ = idVPU_ORST  [=COND:vpu_lstr=]
		LEFT JOIN vin_lshe  ON idVIN_LSHE = VPU_LSTR_LOTSQ  [=COND:vin_lshe=]		
		
		LEFT JOIN vgb_supp  ON idVGB_SUPP = VPU_ORHE_BTCUS  [=COND:vgb_supp=] 
								
		WHERE $localWhere [=WHERE=]  [=COND:vin_item=]  [=LIMIT=] ) tx		
		
EOD;

		return $trig;
	}
}




class vin_cust extends dbMaster
{

	function vin_cust($schema)
	{
		$this->dbMaster("vin_cust",$schema);

	}


	function dbSetTrig()
	{

		//$localWhere = " AND VSL_ORST_STEPS < 'II_DELI' ";

		$trig = <<<EOD
			SELECT * FROM

		 	( SELECT * FROM vin_cust
       				LEFT JOIN vin_item  ON idVIN_ITEM = VIN_CUST_ITMID  [=COND:vin_item=]
				LEFT JOIN vgb_cust  ON idVGB_CUST = VIN_CUST_BPART  [=COND:vgb_cust=]
				LEFT JOIN vgb_supp  ON idVGB_SUPP = VIN_CUST_SUPPL  [=COND:vgb_supp=]
	    			LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_CUST_BPART [=COND:vgb_bpar=]			
		
         


		WHERE [=WHERE=]  [=COND:vin_cust=]    [=LIMIT=]  )  tx


EOD;


		return $trig;
	}

	function vin_cust_lastPrice($dtaObj)
	{
		
		$tObj = array();
		$tObj["PROCESS"] = $dtaObj["PROCESS"];
		$tObj["SESSION"] = $dtaObj["SESSION"];
		
		$tObj["VIN_CUST_BPART"] = $dtaObj["VIN_CUST_BPART"];
		$tObj["VIN_CUST_ITMID"] = $dtaObj["VIN_CUST_ITMID"];
		
		$wTbls = new dbMaster("vin_cust",$this->tblInfo->schema);
		$wTbls->dbFindMatch($tObj);
		
		$this->getVIN_CUST = $wTbls;
		
		
		$newObj = $wTbls->result[0];
		$newObj["PROCESS"] = $dtaObj["PROCESS"];
		$newObj["SESSION"] = $dtaObj["SESSION"];
		$newObj["VIN_CUST_BPART"] = $dtaObj["VIN_CUST_BPART"];
		$newObj["VIN_CUST_ITMID"] = $dtaObj["VIN_CUST_ITMID"];
			
		$newObj["VIN_CUST_LPPAID"] = $dtaObj["VIN_CUST_LPPAID"];
		$newObj["VIN_CUST_LPDATE"] = $dtaObj["VIN_CUST_LPDATE"];
		
		if (!$newObj["idVIN_CUST"])
		{
			$wTbls->dbInsRec($newObj);
		}
		else
		{
			$wTbls->dbUpdRec($newObj);
		}
		
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
		
	}

}

class vin_cust_item extends dbMaster
{

	function vin_cust_item($schema)
	{
		$this->dbMaster("vin_item",$schema);

	}


	function dbSetTrig()
	{

		//$localWhere = " AND VSL_ORST_STEPS < 'II_DELI' ";

		$trig = <<<EOD
			SELECT * FROM

		 	( SELECT * FROM vin_item
			        LEFT JOIN vin_cust  ON idVIN_ITEM = VIN_CUST_ITMID  [=COND:vin_cust=]
				LEFT JOIN vgb_cust  ON idVGB_CUST = VIN_CUST_BPART  [=COND:vgb_cust=]
				LEFT JOIN vgb_supp  ON idVGB_SUPP = VIN_CUST_SUPPL  [=COND:vgb_supp=]
				LEFT JOIN vgb_bpar  ON  idVGB_BPAR = VGB_CUST_BPART [=COND:vgb_bpar=]			
	
			WHERE [=WHERE=]  [=COND:vin_item=]   )  tx


EOD;


		return $trig;
	}

}

class vin_supp extends dbMaster
{

	function vin_supp($schema)
	{
		$this->dbMaster("vin_supp",$schema);

	}


	function dbSetTrig()
	{

		$localWhere = "";
		// $this->E_POST = $_SESSION["lastPost"];
		
		if ($this->E_POST["vin_supp_items"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["vin_supp_items"]);
			if(count($wClause)>0)
			{
				$localWhere = " ( ";
				$orVal = "";
				$occ = 0;
				while ($occ < count($wClause))
				{
					$localWhere .= $orVal . "VIN_SUPP_ITMID = '" . $wClause[$occ] . "' ";
					$orVal = " OR  ";
					$occ += 1;
				} 

				$localWhere .= " ) AND ";

			}

		}
		
		$this->localWhere = $localWhere;
		
		$trig = <<<EOD
			SELECT * FROM

		 	( SELECT * FROM vin_supp
       				LEFT JOIN vin_item  ON idVIN_ITEM = VIN_SUPP_ITMID  [=COND:vin_item=]
				LEFT JOIN vgb_supp  ON idVGB_SUPP = VIN_SUPP_BPART  [=COND:vgb_supp=]
	    			LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_SUPP_BPART  [=COND:vgb_bpar=]

     


		WHERE $localWhere [=WHERE=]  [=COND:vin_supp=]    [=LIMIT=]  )  tx


EOD;


		return $trig;
	}

}


class vin_supp_item extends dbMaster
{

	function vin_supp_item($schema)
	{
		$this->dbMaster("vin_item",$schema);

	}


	function dbSetTrig()
	{

		//$localWhere = " AND VSL_ORST_STEPS < 'II_DELI' ";

		$trig = <<<EOD
			SELECT * FROM

		 	( SELECT * FROM vin_item
		 	LEFT JOIN vin_supp  ON idVIN_ITEM = VIN_SUPP_ITMID  [=COND:vin_supp=]
   			LEFT JOIN vgb_supp  ON idVGB_SUPP = VIN_SUPP_BPART [=COND:vgb_supp=]
	    		LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_SUPP_BPART [=COND:vgb_bpar=]			
		
         


		WHERE [=WHERE=]  [=COND:vin_item=]   )  tx


EOD;


		return $trig;
	}

}


class vin_lshe extends dbMaster
{
	function vin_lshe($schema)
	{
		$this->dbMaster("vin_lshe",$schema);
		$this->isUnique = "Yes";
	}
	
	function dbSetTrig()
	{
		
		$trig = <<<EOD

			SELECT * FROM
		 	( SELECT vin_lshe.*, vin_item.idVIN_ITEM, vin_item.VIN_ITEM_ITMID FROM vin_item 
		 	
		LEFT JOIN vin_lshe  ON idVIN_ITEM = VIN_LSHE_ITMID  [=COND:vin_lshe=]
		LEFT JOIN vgb_supp ON idVGB_SUPP = VIN_LSHE_BPART  [=COND:vgb_supp=]
		LEFT JOIN  vin_ssit  ON idVIN_ITEM = VIN_SSIT_ITMID  [=COND:vin_ssit=]
		LEFT JOIN  vin_ssma   ON idVIN_SSMA = VIN_SSIT_SPESQ  [=COND:vin_ssma=]	
							
		WHERE [=WHERE=]  [=COND:vin_item=] AND VIN_ITEM_LOTCT = "1"  [=LIMIT=] ) tx		
	
EOD;
		return $trig;
	}

	function dbInsRec($dtaObj)
	{

		$dtaObj["VIN_LSHE_LOTSQ"] = 0;

	  	$wTbls = new dbMaster("vin_lshe",$this->tblInfo->schema);
		$wTbls->dbInsRec($dtaObj);			
		
		$this->localExted = "VIN_ITEMS-vin_lshe";
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}

		$dtaObj["idVIN_LSHE"]= $this->insertId;
		
		$E_POST = $dtaObj;
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		$this->SpecLinks = $this->setSslt($E_POST);
		
	}
	
	function dbUpdRec($dtaObj)
	{
		$this->dateTime  = idate("U");
	  	
	  	// You must fix this
	  	if ($dtaObj["cloneLot"] == '1')
	  	{

			$findObj = array();
			$findObj["PROCESS"] = $dtaObj["PROCESS"];
			$findObj["SESSION"] = $dtaObj["SESSION"];
			$findObj["VIN_LSHE_LOTID"] = $dtaObj["VIN_LSHE_LOTID"];
		  	$wfTbls = new dbMaster("vin_lshe",$this->tblInfo->schema);
			$wfTbls->dbFindMatch($findObj);	
			$lastSerno = 0;
			$occ = 0;
			while ($occ < count($wfTbls->result))
			{
				if ($lastSerno < $wfTbls->result[$occ]["VIN_LSHE_SERNO"] * 1)
				{
					$lastSerno = $wfTbls->result[$occ]["VIN_LSHE_SERNO"] * 1;
				}
				
				$occ += 1;
			}
			$lastSerno += 1;		
			  		
	  		$dtaObj["idVIN_LSHE"]="";
	  		$dtaObj["VIN_LSHE_CDATE"] = "";
	  		$dtaObj["VIN_LSHE_SERNO"] = $lastSerno;
	  		$this->dbInsRec($dtaObj);
	  		return;
	  	}
	  	
	  		
	  	
	  	$E_POST = $dtaObj;
	  	// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
	  	
	  	$wTbls = new dbMaster("vin_lshe",$this->tblInfo->schema);
		$wTbls->dbUpdRec($dtaObj);		
		
		$this->localExted = "VIN_ITEMS-vin_lshe1";
			
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
		$this->SpecLinks = $this->setSslt($E_POST);
		
		if ($this->rowCount == 0 && $this->SpecLinks["equal"] == false)
		{
			$this->rowCount = 1;
		}
		
	}

	function dbDelRec($dtaObj)
	{
		
		$E_POST = $dtaObj;
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		$E_POST["idVIN_SSMA_LIST"] = "";
		$this->SpecLinks = $this->setSslt($E_POST);
				
	  	$wTbls = new dbMaster("vin_lshe",$this->tblInfo->schema);
		$wTbls->dbDelRec($dtaObj);
		
		$this->localExted = "VIN_ITEMS-vin_lshe";
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
	}


	
	function setSslt($dtaObj)
	{
		$orgList = explode(",",$dtaObj["idVIN_SSMA_LISTorg"]);
		$lotOlist = array();
		
		$newList = explode(",",$dtaObj["idVIN_SSMA_LIST"]);
		$lotNlist = array();
		
		$occ = 0;
		while ($occ < count($orgList))
		{
			
			if($orgList[$occ] != "")
			{
				$lotOlist[count($lotOlist)] = $orgList[$occ];
			}
				
			$occ += 1;
		}
		sort($lotOlist);
		
		$occ = 0;
		while ($occ < count($newList))
		{
			
			if($newList[$occ] != "")
			{
				$lotNlist[count($lotNlist)] = $newList[$occ]; 
			}
				
			$occ += 1;
		}
		sort($lotNlist);
		
		$retVal = array();
		$retVal["org"] = $lotOlist;
		$retVal["new"] = $lotNlist;
		$retVal["equal"] = false;
		
		if ( implode(",",$lotOlist) ==  implode(",",$lotNlist) )
		{
			$retVal["equal"] = true;
			return $retVal;
			
			// nothing before or after or the same no change
		}
		
		

	  	$obj = array();
		$obj["PROCESS"] = $dtaObj["PROCESS"];
		$obj["SESSION"] = $dtaObj["SESSION"];
		$obj["TBLNAME"] = "vin_sslt";
		$obj["VIN_SSLT_ITMID"] = $dtaObj["VIN_LSHE_ITMID"];
		$obj["VIN_SSLT_LOTID"] = $dtaObj["idVIN_LSHE"];
				
		$wTbls = new dbMaster("vin_sslt",$this->tblInfo->schema); 
		$wTbls->dbFindMatch($obj);
		
		$orgResult = $wTbls->result;
		
		$retVal["findMatch"] = $wTbls;
		
		
	  	$wTbls = new dbMaster("vin_sslt",$this->tblInfo->schema);
	  	
	  	$obj = array();
		$obj["PROCESS"] = $dtaObj["PROCESS"];
		$obj["SESSION"] = $dtaObj["SESSION"];
		$obj["TBLNAME"] = "vin_sslt";
		$obj["VIN_SSLT_ITMID"] = $dtaObj["VIN_LSHE_ITMID"];
		$obj["VIN_SSLT_LOTID"] = $dtaObj["idVIN_LSHE"];

		// Step One - Remove org not in new
		$occ = 0;
		while ($occ < count($lotOlist))
		{
			if (strpos("x," . implode(",",$lotNlist) . "," , $lotOlist[$occ]) < 1 )
			{
				$obj["idVIN_SSLT"] = $this->getidVIN_SSLT($lotOlist[$occ],$orgResult);
				if ($obj["idVIN_SSLT"] > 0)
				{
					$wTbls->dbDelRec($obj);
				}	
			}
			
			$occ += 1;
		}

		// Step two - Add new links
		$occ = 0;
		while ($occ < count($lotNlist))
		{
			$obj["idVIN_SSLT"] = $this->getidVIN_SSLT($lotNlist[$occ],$orgResult);
			
			$retVal["idval"] = $obj["idVIN_SSLT"];
			
			if ($obj["idVIN_SSLT"] == 0)
			{
				$obj["VIN_SSLT_SERSQ"] = $lotNlist[$occ];
				$obj["VIN_SSLT_SPESQ"] = $lotNlist[$occ];
				
				$wTbls->dbInsRec($obj);
				$retVal["idvalwTbls"] = $wTbls; 
			}	
			
			$occ += 1;
		}
	
		return $retVal;

			
	}
	
	
	function getidVIN_SSLT($idVIN_SSMA,$currResult)
	{
		
		$retId = 0;
		$occ = 0;
		while ($occ < count($currResult) && $retId == 0)
		{
			if ($currResult[$occ]["VIN_SSLT_SPESQ"] == $idVIN_SSMA)
			{
				$retId = $currResult[$occ]["idVIN_SSLT"];
			}
			
			$occ += 1;
		}
		
		return $retId;
		
	}
	
}

class vin_ssma extends dbMaster
{
	function vin_ssma($schema)
	{
		$this->dbMaster("vin_ssma",$schema);
	}
	
	function dbSetTrig()
	{	
$trig = <<<EOD
			SELECT * FROM
		 	( SELECT vin_lshe.*, vin_ssma.*, vin_item.idVIN_ITEM, vin_item.VIN_ITEM_ITMID, vin_item.VIN_ITEM_DESC1 FROM vin_ssma 
		LEFT JOIN  vin_ssit  ON idVIN_SSMA = VIN_SSIT_SPESQ  [=COND:vin_ssit=]
		LEFT JOIN  vin_item ON idVIN_ITEM = VIN_SSIT_ITMID  [=COND:vin_item=] 
		LEFT JOIN vin_lshe  ON idVIN_ITEM = VIN_LSHE_ITMID  [=COND:vin_lshe=]								
		WHERE [=WHERE=]  [=COND:vin_item=] AND VIN_ITEM_LOTCT = "1"  [=LIMIT=] ) tx		
	
EOD;
		return $trig;
	}
	
	function dbInsRec($dtaObj)
	{
  		$wTbls = new dbMaster("vin_ssma",$this->tblInfo->schema);
		$wTbls->dbInsRec($dtaObj);
      
      $this->localExted = "VIN_ITEMS-vin_ssma";
      
      
      foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		if(($wTbls->insertId!=0) && ($wTbls->insertId!="")) {
			$arr = array(	
			 "utype"=>"CREATE",
			 "idVIN_SSIT"=>0,
			 "VIN_SSIT_ITMID"=>$dtaObj['VIN_SSIT_ITMID'],
			 "VIN_SSIT_SPESQ"=>$wTbls->insertId,
			 "PROCESS"=>"VIN_ITEMS",
			 "SESSION"=>"VIN_SSITCT",
			 "METHOD"=>"CREATE",
			 "SCHEMA"=>$this->tblInfo->schema);
			$sTbls = new dbMaster("vin_ssit",$this->tblInfo->schema);
		   $val = $sTbls->dbInsRec($arr);
		}
		
		$dtaObj["idVIN_SSMA"]= $this->insertId;
		
		$E_POST = $dtaObj;
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		$this->LotLinks = $this->setSspec($E_POST);

	}

	function dbUpdRec($dtaObj)
	{	
	
	  	$E_POST = $dtaObj;
	  	// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
	  	
	  	$wTbls = new dbMaster("vin_ssma",$this->tblInfo->schema);
		$wTbls->dbUpdRec($dtaObj);		
		
		$this->localExted = "VIN_ITEMS-vin_ssma";
			
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
		$this->LotLinks = $this->setSspec($E_POST);
		if ($this->rowCount == 0 && $this->LotLinks["equal"] == false)
		{
			$this->rowCount = 1;
		}
	}
	function dbDelRec($dtaObj)
	{
		$E_POST = $dtaObj;
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
  		$E_POST["idVIN_LSHE_LIST"] = "";
		$this->SpecLinks = $this->setSspec($E_POST);
		
		if(($dtaObj['idVIN_SSMA']!=0) && ($dtaObj['idVIN_SSMA']!="") ) {
				$spec = new dbMaster("vin_ssit",$this->tblInfo->schema);
				$objChk = array();
				$objChk["PROCESS"] = 'VIN_ITEMS';
				$objChk["SESSION"] = 'VIN_SSITCT';
				$objChk["TBLNAME"] = 'vin_ssit';
				$objChk['VIN_SSIT_SPESQ'] = $dtaObj['idVIN_SSMA'];
				$spec->dbChkMatch($objChk);
				if($spec->fetchResult[0]['idVIN_SSIT']!=0 && $spec->fetchResult[0]['idVIN_SSIT']!="") {
					$objChk["idVIN_SSIT"] = $spec->fetchResult[0]['idVIN_SSIT'];
					$spec->dbDelRec($objChk);
				}
		}
		$ssma = new dbMaster("vin_ssma",$this->tblInfo->schema);
		$ssma->dbDelRec($dtaObj);
		
		$this->errorCode = $ssma->errorCode;
		$this->localExted = "VIN_ITEMS-vin_ssma";
		
		foreach($ssma as $name => $value)
		{
			 $this->$name = $value;
		}
		
	}
	
	function setSspec($dtaObj)
	{
		$orgList = explode(",",$dtaObj["idVIN_LSHE_LISTorg"]);
		$lotOlist = array();
		
		$newList = explode(",",$dtaObj["idVIN_LSHE_LIST"]);
		$lotNlist = array();
		
		$occ = 0;
		while ($occ < count($orgList))
		{
			
			if($orgList[$occ] != "")
			{
				$lotOlist[count($lotOlist)] = $orgList[$occ];
			}
				
			$occ += 1;
		}
		sort($lotOlist);
		
		$occ = 0;
		while ($occ < count($newList))
		{
			
			if($newList[$occ] != "")
			{
				$lotNlist[count($lotNlist)] = $newList[$occ]; 
			}
				
			$occ += 1;
		}
		sort($lotNlist);
		
		$retVal = array();
		$retVal["org"] = $lotOlist;
		$retVal["new"] = $lotNlist;
		$retVal["equal"] = false;
		
		if ( implode(",",$lotOlist) ==  implode(",",$lotNlist) )
		{
			$retVal["equal"] = true;
			return $retVal;
			// nothing before or after or the same no change
		}
		
		

	  	$obj = array();
		$obj["PROCESS"] = $dtaObj["PROCESS"];
		$obj["SESSION"] = $dtaObj["SESSION"];
		$obj["TBLNAME"] = "vin_sslt";
		$obj["VIN_SSLT_ITMID"] = $dtaObj["idVIN_ITEM"];
		$obj["VIN_SSLT_SPESQ"] = $dtaObj["idVIN_SSMA"];
			
		$wTbls = new dbMaster("vin_sslt",$this->tblInfo->schema); 
		$wTbls->dbFindMatch($obj);
		
		$orgResult = $wTbls->result;
		
		$retVal["findMatch"] = $wTbls;
		
		
	  	$wTbls = new dbMaster("vin_sslt",$this->tblInfo->schema);
	  	
	  	$obj = array();
		$obj["PROCESS"] = $dtaObj["PROCESS"];
		$obj["SESSION"] = $dtaObj["SESSION"];
		$obj["TBLNAME"] = "vin_sslt";
		$obj["VIN_SSLT_ITMID"] = $dtaObj["idVIN_ITEM"];
		$obj["VIN_SSLT_SPESQ"] = $dtaObj["idVIN_SSMA"];
		
		
		// Step One - Remove org not in new
		
		$occ = 0;
		while ($occ < count($lotOlist))
		{		
			if (strpos("x," . implode(",",$lotNlist) . "," , $lotOlist[$occ]) < 1 )
			{
				$obj["idVIN_SSLT"] = $this->getidVIN_SSPEC($lotOlist[$occ],$orgResult);
				if ($obj["idVIN_SSLT"] > 0)
				{
					$wTbls->dbDelRec($obj);
				}	
			}
			
			$occ += 1;
		}
		// Step two - Add new links
		$occ = 0;
		
		while ($occ < count($lotNlist))
		{
					
			$obj["idVIN_SSLT"] = $this->getidVIN_SSPEC($lotNlist[$occ],$orgResult);
		
			$retVal["idval"] = $obj["idVIN_SSLT"];
			
			if ($obj["idVIN_SSLT"] == 0)
			{ 
				$obj["VIN_SSLT_SERSQ"] = $lotNlist[$occ];
				$obj["VIN_SSLT_LOTID"] = $lotNlist[$occ];
				$wTbls->dbInsRec($obj);
				$retVal["idvalwTbls"] = $wTbls; 
			}	

			$occ += 1;
		}
	
		return $retVal;
	}
	
	function getidVIN_SSPEC($idVIN_LSHE,$currResult)
	{
		
		$retId = 0;
		$occ = 0;
		while ($occ < count($currResult) && $retId == 0)
		{		
			if ($currResult[$occ]["VIN_SSLT_LOTID"] == $idVIN_LSHE)
			{
				$retId = $currResult[$occ]["idVIN_SSLT"];
			}
			
			$occ += 1;
		}
		return $retId;
	}
	
}

require_once "VGB_PARTNERS.php";
require_once "HIS_REPORTS_DEVAL.php";
require_once "HIS_REPORTS_POS.php";

/*
class vin_ssit extends dbMaster
{
	function vin_ssit($schema)
	{
		$this->dbMaster("vin_ssit",$schema);
	}

	function dbSetTrig()
	{

$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT vin_ssit.* ,vin_item.idVIN_ITEM, vin_item.VIN_ITEM_ITMID, vin_ssma.idVIN_SSMA, vin_ssma.VIN_SSMA_SPEID FROM vin_ssit 
		LEFT JOIN vin_item  ON idVIN_ITEM = VIN_SSIT_ITMID  [=COND:vin_item=]
		LEFT JOIN vin_ssma  ON idVIN_SSMA = VIN_SSIT_SPESQ  [=COND:vin_ssma=] 								
		WHERE [=WHERE=]  [=COND:vin_ssit=]  [=LIMIT=] ) tx		

EOD;

		return $trig;
		
	}
}


class vin_sslt extends dbMaster
{
	function vin_sslt($schema)
	{
		$this->dbMaster("vin_sslt",$schema);
	}

	function dbSetTrig()
	{

$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT vin_sslt.* ,vin_item.idVIN_ITEM, vin_item.VIN_ITEM_ITMID, vin_ssma.idVIN_SSMA, vin_ssma.VIN_SSMA_SPEID, vin_lshe.idVIN_LSHE, vin_lshe.VIN_LSHE_LOTID FROM vin_ssit 
		LEFT JOIN vin_item  ON idVIN_ITEM = VIN_SSLT_ITMID  [=COND:vin_item=]
		LEFT JOIN vin_ssma  ON idVIN_SSMA = VIN_SSLT_SPESQ  [=COND:vin_ssma=]
		LEFT JOIN vin_lshe  ON idVIN_LSHE = VIN_SSLT_LOTID  [=COND:vin_lshe=] 								
		WHERE [=WHERE=]  [=COND:vin_sslt=]  [=LIMIT=] ) tx		

		
EOD;

		return $trig;
		
	}
}

class vin_lotct extends dbMaster
{
	function vin_lotct($schema)
	{
		$this->dbMaster("vin_lshe",$schema);
		
	}
	
	// AC20160302 - Fix
	function dbSetTrig()
	{

$trig = <<<EOD
			SELECT * FROM
		 	( SELECT vin_lshe.*, vin_item.idVIN_ITEM, vin_item.VIN_ITEM_ITMID  FROM vin_lshe 

		LEFT JOIN vin_item  ON idVIN_ITEM = VIN_LSHE_ITMID  [=COND:vin_item=]
		LEFT JOIN vgb_supp ON VGB_SUPP_BPART = VIN_LSHE_BPART  [=COND:vgb_supp=] 	

		WHERE [=WHERE=]  [=COND:vin_lshe=]  [=LIMIT=] ) tx		
	
EOD;

		return $trig;
	}
}


// IV_ = Information values
// TV_ = Transaction values 

	GOSUB TV_VIN_TRN_INIT_ERR_VAR

	LET TV_VIN_TRN_PROCESS_W = FNA_FSET_A_PD(0); REM Load Parameter Data

	GOSUB TV_VIN_TRN_ITCK_OCC
	IF II_PROCESS_ERR THEN GOTO TV_VIN_TRN_PROCESS_EOP

TV_VIN_TRN_ITCK_OCC: REM Check if all rows have same Item

	IF A_BD.INVTR_TTMAX = 0 THEN
:		LET II_PROCESS_ERR = II_PROCESS_ERR + 1;
:		LET TV_VIN_TRN_ERRMESS = 0;
:		GOSUB TV_VIN_TRN_ERRMESS
:	FI

	LET II_PROCESS_ITCK_OCC = A_BD.INVTR_TTMAX
	LET II_PROCESS_ITCK_STP = 1
	LET II_PROCESS_ITCK_ITEMID$ = $$
	WHILE II_PROCESS_ITCK_STP <= II_PROCESS_ITCK_OCC AND II_PROCESS_ERR = 0

		LET A_BD.INVTR_CURRE = II_PROCESS_ITCK_STP
		LET W = FNA_SDISP_SELAREA("INVTR","/GREC","",""); GOSUB A_SDISP_SELAREA
		IF A_TD.VIN_VRTRANII_ITMID$ <> II_PROCESS_ITCK_ITEMID$ AND II_PROCESS_ITCK_ITEMID$ <> $$ THEN
:			LET II_PROCESS_ERR = II_PROCESS_ERR + 16;
:			LET TV_VIN_TRN_ERRMESS = 16;
:			GOSUB TV_VIN_TRN_ERRMESS
:		FI

		LET II_PROCESS_ITCK_ITEMID$ = A_TD.VIN_VRTRANII_ITMID$

		LET II_PROCESS_ITCK_STP = II_PROCESS_ITCK_STP + 1

	WEND

TV_VIN_TRN_ITCK_OCC_END: RETURN
	


	GOSUB TV_VIN_TRN_ITEM_GET
	IF II_PROCESS_ERR THEN GOTO TV_VIN_TRN_PROCESS_EOP

TV_VIN_TRN_ITEM_GET: REM Get and Check Item exists

	LET A_TD.VIN_ITEMII_ITMID$ = II_PROCESS_ITCK_ITEMID$
	LET W=FNA_FMAKEKEY(A_TP.VIN_ITEMII,0)
	LET A_VNO$ = FNA_FSET_HANDLE$(A_TP.VIN_ITEMII);GOSUB A_SDB_RDIRECT

	IF FNA_FDB_ERROR(A_TP.VIN_ITEMII) THEN 
:		LET II_PROCESS_ERR =  II_PROCESS_ERR + 4;
:		LET TV_VIN_TRN_ERRMESS = 4;
:		GOSUB TV_VIN_TRN_ERRMESS
:	FI

TV_VIN_TRN_ITEM_GET_END: RETURN

	GOSUB TV_VIN_TRN_UNIT_GET
	IF II_PROCESS_ERR THEN GOTO TV_VIN_TRN_PROCESS_EOP

II_VIN_TRN_UNIT_GET: REM Get and Check Unit record set for Unit set

	LET II_UNIT_GET$ = $$

	LET W = FNA_FSET_DBCOMPARE(A_TP.VIN_UNITII,0,A_TD.VIN_ITEMII_UNSET$) 
	LET A_VNO$ = FNA_FSET_HANDLE$(A_TP.VIN_UNITII);GOSUB A_SDB_RSIMILAR
	WHILE FNA_FDB_ERROR(A_TP.VIN_UNITII)=0

		LET II_UNIT_GET$ = II_UNIT_GET$ + A_TD.VIN_UNITII_UNITM$

		LET A_VNO$ = FNA_FSET_HANDLE$(A_TP.VIN_UNITII);GOSUB A_SDB_RSIMILAR
	WEND

	IF II_UNIT_GET$ = $$ THEN
:		LET II_PROCESS_ERR =  II_PROCESS_ERR + 32;
:		LET II_VIN_TRN_ERRMESS = 32;
:		GOSUB II_VIN_TRN_ERRMESS
:	FI

II_VIN_TRN_UNIT_GET_END: RETURN

	GOSUB TV_VIN_TRN_EVAL_TRANS
	IF II_PROCESS_ERR THEN GOTO TV_VIN_TRN_PROCESS_EOP
	REM Evaluate Transactions
	Does it balance is transfers


	LET TV_VIN_GET_TRAN_NUMBER = 0
	GOSUB TV_VIN_TRN_UPD





TV_VIN_TRN_UPD: Inventory Update

	GOSUB TV_VIN_TRN_SORT_LOCAT

	LET TV_VIN_UPD_TRNQT_G = 0
	LET TV_VIN_UPD_ALOQT_G = 0
	LET TV_VIN_UPD_PURQT_G = 0

	LET TV_VIN_UPD_OCC = A_BD.INVTR_TTMAX
	LET TV_VIN_UPD_STEP = 1
	LET TV_VIN_UPD_ITMID$ = $$
	LET TV_VIN_UPD_WARID$ = $$
	LET TV_VIN_UPD_LOCID$ = $$
	LET TV_VIN_UPD_UNITM$ = $$
	LET TV_VIN_UPD_LOTSQ$ = $00$
	LET TV_VIN_UPD_SERSQ$ = $00$

	WHILE TV_VIN_UPD_STEP <= TV_VIN_UPD_OCC AND II_PROCESS_ERR = 0

		LET A_BD.INVTR_CURRE = TV_VIN_UPD_STEP
		LET W = FNA_SDISP_SELAREA("INVTR","/GREC","",""); GOSUB A_SDISP_SELAREA

		SWITCH FNTV_VIN_UPD_NEW_LOCAT(0)
		CASE 1; REM True
		
			IF TV_VIN_UPD_ITMID$ <> $$ THEN
:				LET TV_VIN_UPD_HOLD_REC$ = FNA_FREC_COPY$(A_TP.VIN_VRTRANII);
:				LET W = FNA_FREC_PASTE(A_TP.VIN_VRTRANII,TV_VIN_UPD_LAST_REC$);
:				LET A_TD.VIN_VRTRANII_TRNQT = TV_VIN_UPD_TRNQT;
:				LET A_TD.VIN_VRTRANII_ALOQT = TV_VIN_UPD_ALOQT;
:				LET A_TD.VIN_VRTRANII_PURQT = TV_VIN_UPD_PURQT;
:				GOSUB  TV_VIN_TRN_UPD_TRANII;
:				LET W = FNA_FREC_PASTE(A_TP.VIN_VRTRANII,TV_VIN_UPD_HOLD_REC$)
:			FI; REM ACJan2204New Position 
			
			LET TV_VIN_UPD_LAST_REC$ = FNA_FREC_COPY$(A_TP.VIN_VRTRANII)
			
			GOSUB TV_VIN_TRN_UPD_INVEII
			
			LET TV_VIN_UPD_ITMID$ = A_TD.VIN_VRTRANII_ITMID$
			LET TV_VIN_UPD_WARID$ = A_TD.VIN_VRTRANII_WARID$
			LET TV_VIN_UPD_LOCID$ = A_TD.VIN_VRTRANII_LOCID$
			LET TV_VIN_UPD_UNITM$ = A_TD.VIN_VRTRANII_UNITM$
			LET TV_VIN_UPD_LOTSQ$ = A_TD.VIN_VRTRANII_LOTSQ$
			LET TV_VIN_UPD_SERSQ$ = A_TD.VIN_VRTRANII_SERSQ$
			
			LET TV_VIN_UPD_TRNQT = 0
			LET TV_VIN_UPD_ALOQT = 0
			LET TV_VIN_UPD_PURQT = 0

		BREAK
		SWEND

		REM ACCUMULATE TRNQT (Only if Inventory Item (Not Service)
		IF A_TD.VIN_ITEMII_INVIT THEN
:			LET TV_VIN_UPD_TRNQT_G = TV_VIN_UPD_TRNQT_G + A_TD.VIN_VRTRANII_TRNQT;
:			LET TV_VIN_UPD_TRNQT = TV_VIN_UPD_TRNQT + A_TD.VIN_VRTRANII_TRNQT
:		FI
		REM ACCUMULATE ALOQT
		LET TV_VIN_UPD_ALOQT_G = TV_VIN_UPD_ALOQT_G + A_TD.VIN_VRTRANII_ALOQT
		LET TV_VIN_UPD_ALOQT = TV_VIN_UPD_ALOQT + A_TD.VIN_VRTRANII_ALOQT
		REM ACCUMULATE PURQT
		LET TV_VIN_UPD_PURQT_G = TV_VIN_UPD_PURQT_G + A_TD.VIN_VRTRANII_PURQT
		LET TV_VIN_UPD_PURQT = TV_VIN_UPD_PURQT + A_TD.VIN_VRTRANII_PURQT

		LET  TV_VIN_UPD_STEP  =  TV_VIN_UPD_STEP  + 1

	WEND

 REM ACJan2204New Position 
	IF II_PROCESS_ERR = 0 THEN
:		IF TV_VIN_UPD_ITMID$ <> $$ THEN
:			LET TV_VIN_UPD_HOLD_REC$ = FNA_FREC_COPY$(A_TP.VIN_VRTRANII);
:			LET W = FNA_FREC_PASTE(A_TP.VIN_VRTRANII,TV_VIN_UPD_LAST_REC$);
:			LET A_TD.VIN_VRTRANII_TRNQT = TV_VIN_UPD_TRNQT;
:			LET A_TD.VIN_VRTRANII_ALOQT = TV_VIN_UPD_ALOQT;
:			LET A_TD.VIN_VRTRANII_PURQT = TV_VIN_UPD_PURQT;
:			GOSUB  TV_VIN_TRN_UPD_TRANII;
:			LET W = FNA_FREC_PASTE(A_TP.VIN_VRTRANII,TV_VIN_UPD_HOLD_REC$)
:		FI;
:		LET TV_VIN_UPD_LAST_REC$ = FNA_FREC_COPY$(A_TP.VIN_VRTRANII);
:		GOSUB TV_VIN_TRN_UPD_INVEII;
:		GOSUB TV_VIN_TRN_UPD_ITEMII
:	FI


REM BEGIN Internal function to simplify location change check 
TV_VIN_UPD_NEW_LOCAT:
DEF FNTV_VIN_UPD_NEW_LOCAT(W)
	LET TV_VIN_UPD_NEW_LOCAT_RET = 0
	IF TV_VIN_UPD_ITMID$ <> A_TD.VIN_VRTRANII_ITMID$ THEN LET  TV_VIN_UPD_NEW_LOCAT_RET = 1
	IF TV_VIN_UPD_WARID$ <> A_TD.VIN_VRTRANII_WARID$ THEN LET  TV_VIN_UPD_NEW_LOCAT_RET = 1
	IF TV_VIN_UPD_LOCID$ <> A_TD.VIN_VRTRANII_LOCID$ THEN LET  TV_VIN_UPD_NEW_LOCAT_RET = 1
	IF TV_VIN_UPD_UNITM$ <> A_TD.VIN_VRTRANII_UNITM$ THEN LET  TV_VIN_UPD_NEW_LOCAT_RET = 1
	IF TV_VIN_UPD_LOTSQ$ <> A_TD.VIN_VRTRANII_LOTSQ$ THEN LET  TV_VIN_UPD_NEW_LOCAT_RET = 1
	IF TV_VIN_UPD_SERSQ$ <> A_TD.VIN_VRTRANII_SERSQ$ THEN LET  TV_VIN_UPD_NEW_LOCAT_RET = 1

TV_VIN_UPD_NEW_LOCAT_END: RETURN TV_VIN_UPD_NEW_LOCAT_RET
FNEND
REM END Internal function to simplify location change check
TV_VIN_TRN_UPD_END: RETURN
*/



?>
