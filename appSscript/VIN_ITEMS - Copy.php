<?php



class vin_item extends dbMaster
{

// New approach after detecting problem with have manu joins in statement 

	function vin_item($schema)
	{
		$this->dbMaster("vin_item",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
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
		$this->E_POST = $_SESSION["lastPost"];
		
		if ($this->E_POST["vin_item_lots"])
		{
			$localWhere = "[=WHERE=]";
			$wClause = explode(",",$this->E_POST["vin_item_lots"]);
			if(count($wClause)>1)
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
		$this->E_POST = $_SESSION["lastPost"];
		
		if ($this->E_POST["vin_item_specs"])
		{
			$localWhere = "[=WHERE=]";
			$wClause = explode(",",$this->E_POST["vin_item_specs"]);
			if(count($wClause)>1)
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
		
	  	$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		$E_POST["MAXREC_OUT"] = 0;
	  	$wTbls = new vin_item_replen_inv($this->tblInfo->schema);
		$wTbls->dbFindFrom($E_POST);		
		$this->timeIn = $wTbls->pdoTimeStmp;
		$filterRec = $wTbls->result;
		
		$orheList = array();
		$inveList = array();
		$itemList = array();
		
		$occ = 0;
		while ($occ < count($filterRec))
		{
			// Set Item Accumalator
			if (!$itemList[$filterRec[$occ]["idVIN_ITEM"]])
			{
				$itemList[$filterRec[$occ]["idVIN_ITEM"]] = array();
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["maxQty"] = $filterRec[$occ]["VIN_ITEM_MINQT"];
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["invQty"] = 0;
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["BOHQty"] = 0;
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["ALOQty"] = 0;
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["PURQty"] = 0;
			}
			
			// Check if Sales Orders and step valid
			if ($filterRec[$occ]["idVSL_ORHE"] && !$orheList[$filterRec[$occ]["idVSL_ORHE"]])
			{
				// Check if Step and Specs Required
				if ($filterRec[$occ]["idVSL_ORST"] && $filterRec[$occ]["VSL_ORDE_LSPEC"] && trim($filterRec[$occ]["VSL_ORDE_LSPEC"]) != "" )
				{
					$itemList[$filterRec[$occ]["idVIN_ITEM"]]["idVSL_ORHE"] = $filterRec[$occ]["idVSL_ORHE"];
					$orheList[$filterRec[$occ]["idVSL_ORHE"]] = "done";
				}
			}

			if ($filterRec[$occ]["idVIN_INVE"] && !$inveList[$filterRec[$occ]["idVIN_INVE"]])
			{
				$inveList[$filterRec[$occ]["idVIN_INVE"]] = "done";
				$qtyTmp = $filterRec[$occ]["VIN_INVE_BOHQT"] - $filterRec[$occ]["VIN_INVE_ALOQT"] + $filterRec[$occ]["VIN_INVE_PURQT"];
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["invQty"] += $qtyTmp;
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["BOHQty"] += $filterRec[$occ]["VIN_INVE_BOHQT"];
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["ALOQty"] += $filterRec[$occ]["VIN_INVE_ALOQT"];
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["PURQty"] += $filterRec[$occ]["VIN_INVE_PURQT"];
				

			}
				
			$occ += 1;
		}
		
		$this->itemList = $itemList;
		$newRec = "";
		$fs = "";
		$occ = 0;
		while ($occ < count($filterRec))
		{
			if (
				$itemList[$filterRec[$occ]["idVIN_ITEM"]]["maxQty"] < $itemList[$filterRec[$occ]["idVIN_ITEM"]]["invQty"]
				&& !$itemList[$filterRec[$occ]["idVIN_ITEM"]]["idVSL_ORHE"]
				)
			{
			}
			else
			{
				if (
					!$itemList[$filterRec[$occ]["idVIN_ITEM"]]["maxQty"] && $itemList[$filterRec[$occ]["idVIN_ITEM"]]["invQty"] == 0
					&& !$itemList[$filterRec[$occ]["idVIN_ITEM"]]["idVSL_ORHE"]
					
					)
				{
				}
				else
				{
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
			$mainResult[$occ]["BOHQty"] = $wTMP["BOHQty"];
			$mainResult[$occ]["ALOQty"] = $wTMP["ALOQty"];
			$mainResult[$occ]["PURQty"] = $wTMP["PURQty"];
			
			$occ += 1;
		}
		
		$lotRec = "";
		$fs = "";
		$occ = 0;
		while ($occ < count($mainResult))
		{		
			if (strpos("x," . $lotRec . "," , ",". $mainResult[$occ]["idVIN_ITEM"] . "," ) < 1 && $mainResult[$occ]["VIN_ITEM_LOTCT"] = '1' )
			{
		
				$lotRec .= $fs  . $mainResult[$occ]["idVIN_ITEM"];
				$fs = ",";
			}

			$occ += 1;
		}
		
		if ($lotRec != "")
		{
			$E_POST["MAXREC_OUT"] = 0;
			$E_POST["vin_item_lots"] = $lotRec;
			
		  	$wTblsLots = new vin_item_replen_lots($this->tblInfo->schema);
			$wTblsLots->dbFindFrom($E_POST);		
		}
		
		$this->dbSuppTbl["vin_item_replen_lots"] = $wTblsLots;
		$this->lotResults = $wTblsLots->result;
		$this->timeOut = $wTblsLots->pdoTimeStmp;
		
		$wTbls->result = $mainResult;
		$this->itemList = $itemList;	
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}			
		
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
		LEFT JOIN vsl_orde  ON VSL_ORDE_ITMID = idVIN_ITEM  [=COND:vsl_orde=]
		LEFT JOIN vsl_orhe  ON VSL_ORDE_ORNUM = idVSL_ORHE  [=COND:vsl_orhe=]
		LEFT JOIN vsl_orst  ON VSL_ORST_ORLIN = idVSL_ORDE AND VSL_ORST_STEPS > 'FF_A' AND VSL_ORST_STEPS < 'II_DELX' [=COND:vsl_orst=]
							
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
			$localWhere = "[=WHERE=]";
			$wClause = explode(",",$this->E_POST["vin_item_vslvpu"]);
			if(count($wClause)>1)
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
		
		LEFT JOIN vin_lshe  ON VIN_LSHE_ITMID = idVIN_ITEM [=COND:vin_lshe=]		
								
		WHERE $localWhere [=WHERE=]  [=COND:vin_item=]  [=LIMIT=] ) tx		
		
EOD;

		return $trig;
	}
}


class vin_item_replen_lots extends dbMaster
{

	function vin_item_replen_lots($schema)
	{
		$this->dbMaster("vin_item",$schema);
	}


	function dbSetTrig()
	{


		$localWhere = "";
		$this->E_POST = $_SESSION["lastPost"];
		
		if ($this->E_POST["vin_item_lots"])
		{
			$localWhere = "[=WHERE=]";
			$wClause = explode(",",$this->E_POST["vin_item_lots"]);
			if(count($wClause)>1)
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
		 	
		LEFT JOIN vin_lshe  ON VIN_LSHE_ITMID = idVIN_ITEM  AND VIN_LSHE_SOLDO = '0' [=COND:vin_lshe=]
		LEFT JOIN vin_lslq  ON VIN_LSLQ_ITMID = VIN_LSHE_ITMID AND VIN_LSLQ_LOTSQ = idVIN_LSHE  [=COND:vin_lslq=]
		
		LEFT JOIN vin_ssit  ON VIN_SSIT_ITMID = VIN_LSHE_ITMID  [=COND:vin_ssit=]
		LEFT JOIN vin_ssma  ON idVIN_SSMA = VIN_SSIT_SPESQ  [=COND:vin_ssma=]
		LEFT JOIN vin_sslt  ON VIN_SSLT_ITMID = VIN_LSHE_ITMID AND VIN_SSLT_LOTID = idVIN_LSHE   [=COND:vin_sslt=]
		LEFT JOIN vgb_supp  ON VIN_LSHE_BPART = idVGB_SUPP  [=COND:vgb_supp=]
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
			$localWhere = "[=WHERE=]";
			$wClause = explode(",",$this->E_POST["vin_item_vsl"]);
			if(count($wClause)>1)
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
			$localWhere = "[=WHERE=]";
			$wClause = explode(",",$this->E_POST["vin_item_vpu"]);
			if(count($wClause)>1)
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

		//$localWhere = " AND VSL_ORST_STEPS < 'II_DELI' ";

		$trig = <<<EOD
			SELECT * FROM

		 	( SELECT * FROM vin_supp
       				LEFT JOIN vin_item  ON idVIN_ITEM = VIN_SUPP_ITMID  [=COND:vin_item=]
				    LEFT JOIN vgb_supp  ON idVGB_SUPP = VIN_SUPP_BPART  [=COND:vgb_supp=]
	    			LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_SUPP_BPART  [=COND:vgb_bpar=]

     


		WHERE [=WHERE=]  [=COND:vin_supp=]    [=LIMIT=]  )  tx


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
		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		$this->SpecLinks = $this->setSslt($E_POST);
		
	}
	
	function dbUpdRec($dtaObj)
	{
	  	$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
	  	
	  	$wTbls = new dbMaster("vin_lshe",$this->tblInfo->schema);
		$wTbls->dbUpdRec($dtaObj);		
		
		$this->localExted = "VIN_ITEMS-vin_lshe";
			
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
		
		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
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
		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		$this->LotLinks = $this->setSspec($E_POST);

	}

	function dbUpdRec($dtaObj)
	{	
	
	  	$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
	  	
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
		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
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
