<?php

class vsl_POS_RPT extends dbMaster
{
	function vsl_POS_RPT($schema)
	{
		$this->dbMaster("vsl_orst",$schema);
	}


	
	function dbFindMatch($objDta)
	{
		$this->localdbFnct = "Procedure Point of Sales";
		$this->localE_POST = $objDta;
		
		$trig = $this->setTrigger($objDta);
		$this->trigger = $trig;

		$tFnc = new AB_querySession;
		$trig = $tFnc->tblAccessCond($objDta,$trig,true,"onaccess,onaccess.USR");
		$this->triggerAfterTblAccessCond= $trig;
			
		$dta = array();
		$dtaType = array();
		
		$dta["reportFromDate"] = $objDta["reportFromDate"];
		$dtaType["reportFromDate"] =  PDO::PARAM_STR;

		$dta["reportToDate"] = $objDta["reportToDate"];
		$dtaType["reportToDate"] =  PDO::PARAM_STR;

		$dta["reportSupplierId"] = $objDta["reportSupplierId"];	
		$dtaType["reportSupplierId"] =  PDO::PARAM_INT ;
	

	  	$posTbls = new dbMaster("vsl_orst",$this->tblInfo->schema);
	  	$posTbls->dbPdoPrep($trig,$dta,$dtaType);


		
		foreach($posTbls as $name => $value)
		{
			 $this->$name = $value;
		}		
	}
	
	function setTrigger($objDta)
	{
		
		$cond = "";
		$and = "";
		if ($objDta["reportFromDate"])
		{
			$cond = " VSL_ORST_DDATE >= :reportFromDate " ;
			$and = " AND ";
		}
		
		if ($objDta["reportToDate"])
		{
			$cond .= $and . " VSL_ORST_DDATE <= :reportToDate " ;
		}
		
		if ($cond!="")
		{
			$cond = " AND ( " . $cond . " ) ";
		}



$trig =<<<EOC


SELECT 
(@aa:= 'AB') as PREFIX,
(@ab:= '91') as CODE,
VGB_BPAR_BPART AS CustId,
VGB_CUST_BPNAM AS Name,
(@ae:= CONCAT(CASE WHEN VGB_ADDR_ADD01 IS NOT NULL THEN VGB_ADDR_ADD01 ELSE '' END ,' ',CASE WHEN VGB_ADDR_ADD02 IS NOT NULL THEN VGB_ADDR_ADD02 ELSE '' END )) as Address,
VGB_ADDR_CITYN AS City,
VGB_PRST_PRSID AS Prov,
(@aH:= REPLACE(VGB_ADDR_POSTC,' ','') ) AS POSTAL_C,
VGB_CNTR_CNTID AS Country,
(@aJ:=NULL) AS J,
(@aK:=NULL) AS K,
(@aL:=NULL) AS L,
(@aM:=NULL) AS M,
(@aN:=NULL) AS N,
(@aO:=NULL) AS O,
(@aP:=NULL) AS P,
(@aQ:=NULL) AS Q,
(@aR:= CASE WHEN VIN_SUPP_UBPCO = '1' AND TRIM(VIN_SUPP_ITMBP) <> '' THEN VIN_SUPP_ITMBP ELSE VIN_ITEM_ITMID END ) as ITEM_ID,
(@aS:=NULL) AS S,
(@aT:=NULL) AS T,
(@aU:= CASE WHEN VIN_SUPP_UBPDE = '1' AND TRIM(VIN_SUPP_BPITD) <> '' THEN VIN_SUPP_BPITD ELSE VIN_ITEM_DESC1 END ) as ITEM_DESC,
(@aV:=NULL) AS V,
(@aW:= DATE_FORMAT(VSL_ORST_DDATE,'%Y%m%d')) AS INV_DATE,
(@aX:=NULL) AS X,
SUM(VSL_ORST_ORDQT) AS ORDQT,
VIN_UNIT_UNITM AS UOM,
VIN_SUPP_STDCP AS Cost,
SUM(VSL_ORST_ORDQT * VIN_SUPP_STDCP) AS EXTENSION

FROM vsl_orst
LEFT JOIN vsl_orde ON idVSL_ORDE =  VSL_ORST_ORLIN
LEFT JOIN vin_supp ON VIN_SUPP_BPART = :reportSupplierId AND VIN_SUPP_ITMID = VSL_ORDE_ITMID
LEFT JOIN vin_item ON idVIN_ITEM =  VSL_ORDE_ITMID AND idVIN_SUPP IS NOT NULL
LEFT JOIN vsl_orhe ON idVSL_ORHE =  VSL_ORST_ORNUM AND idVIN_SUPP IS NOT NULL
LEFT JOIN vgb_cust ON idVGB_CUST =  VSL_ORHE_BTCUS AND idVIN_SUPP IS NOT NULL
LEFT JOIN vgb_addr ON idVGB_ADDR =  VSL_ORHE_STADD AND idVIN_SUPP IS NOT NULL
LEFT JOIN vgb_bpar ON idVGB_BPAR =  VGB_ADDR_BPART AND idVIN_SUPP IS NOT NULL
LEFT JOIN vin_unit ON idVIN_UNIT =  VSL_ORDE_SAUOM AND idVIN_SUPP IS NOT NULL
LEFT JOIN vgb_cntr ON idVGB_CNTR =  VGB_ADDR_CNTID AND idVIN_SUPP IS NOT NULL
LEFT JOIN vgb_prst ON idVGB_PRST =  VGB_ADDR_PRSID AND idVIN_SUPP IS NOT NULL

WHERE VSL_ORST_STEPS = 'QQ_PURG' 
{$cond} 
AND idVIN_SUPP IS NOT NULL
AND VIN_SUPP_STDCP > 0 AND VSL_ORST_ORDQT <> 0
GROUP BY VSL_ORST_ORNUM,VSL_ORST_ORLIN

EOC;

	return $trig;
		
	}
	
}

