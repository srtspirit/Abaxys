<?php

class vsl_DEL_EVAL extends dbMaster
{
	function vsl_DEL_EVAL($schema)
	{
		$this->dbMaster("vsl_orst",$schema);
	}


	
	function dbFindMatch($objDta)
	{
		$this->localdbFnct = "Procedure Delivery Evaluation []";
		$this->localE_POST = $objDta;
		
		$trig = $this->setTrigger($objDta);
		$this->trigger = $trig;

		$tFnc = new AB_querySession;
		$trig = $tFnc->tblAccessCond($objDta,$trig,true,"onaccess,onaccess.USR");
			
		$this->triggerAfterTblAccessCond= $trig;
			
	  	$evalTbls = new dbMaster("vsl_orst",$this->tblInfo->schema);
		$evalTbls->dbProcessTransactionPdo($trig);
		
		foreach($evalTbls as $name => $value)
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
			$cond = " VSL_ORST_DDATE >= '" . $objDta["reportFromDate"] . "'" ;
			$and = " AND ";
		}
		
		if ($objDta["reportToDate"])
		{
			$cond .= $and . " VSL_ORST_DDATE <= '" . $objDta["reportToDate"] . "'" ;
		}
		
		if ($cond!="")
		{
			$cond = " AND ( " . $cond . " ) ";
		}


// 	TLREC
//	TREAD
//	TMAXL
//	LEADT


//	No at the  moment. 
//	However  dbPdoPrep (also member of dbMaster) returns results and must be passed parameters (data object and data type object)
//	would look like this
//	$data = array = fieldNames
//	$data Type = array = field type (constants)
//	
//	example (we use PDO::PARAM_STR most of the time)
//	
//	$dta[0] = "VGB_CUST_BPNAM"
//	$dtaType[0] =  PDO::PARAM_STR 
//	$dta[0] = "idVGB_CUST"
//	$dtaType[0] =  PDO::PARAM_INT 
//	
//	$evalTbls = new dbMaster("vgb_cust",$this->tblInfo->schema);
//	$evalTbls->dbPdoPrep($trig,$dta,$dtaType);
//	
//	
//	
//	field type constants are:
//	1- PDO::PARAM_INT
//	2- PDO::PARAM_STR
//	3- PDO::PARAM_BOOL 
//	
//	





$trig =<<<EOC


select 
idVSL_ORHE AS ORDID,
VSL_ORHE_ORNUM AS ORNUM,
VSL_ORDE_ORLIN AS ORLIN,
VGB_BPAR_BPART AS BTCUS,
VGB_CUST_BPNAM AS BPNAM,
VIN_ITEM_ITMID AS ITMID,
VIN_ITEM_DESC1 AS DESC1,
SUM(CASE WHEN VSL_ORST_DDATE >= VSL_ORST_PDATE  THEN DATEDIFF(VSL_ORST_DDATE,VSL_ORST_PDATE) ELSE 0 END ) AS TLDAY,
SUM(CASE WHEN VSL_ORST_DDATE >= VSL_ORST_PDATE  THEN 1 ELSE 0 END ) AS TLREC,
COUNT(VSL_ORST_STPSQ) AS TREAD,
MAX(CASE WHEN VSL_ORST_DDATE >= VSL_ORST_PDATE  THEN DATEDIFF(VSL_ORST_DDATE,VSL_ORST_PDATE) ELSE 0 END ) AS TMAXL,
SUM(CASE WHEN VSL_ORST_DDATE >= VSL_ORHE_ODATE  THEN DATEDIFF(VSL_ORST_DDATE,VSL_ORHE_ODATE) ELSE 0 END ) AS LEADT,
VSL_ORHE_USLNA AS USLNA,
VSL_ORST_PDATE AS PDATE,
VSL_ORST_DDATE AS DDATE



from VSL_ORST 
left join vsl_orde ON VSL_ORST_ORLIN = idVSL_ORDE [=COND:vsl_orde=]
left join vin_item ON VSL_ORDE_ITMID = idVIN_ITEM [=COND:vin_item=]
left join vsl_orhe ON VSL_ORST_ORNUM = idVSL_ORHE [=COND:vsl_orhe=]
left join vgb_cust ON VSL_ORHE_BTCUS = idVGB_CUST [=COND:vgb_cust=]
left join vgb_bpar ON VGB_CUST_BPART = idVGB_BPAR [=COND:vgb_bpar=]

WHERE VSL_ORST_STEPS > 'JJ_INVO' {$cond}  
 AND (idVSL_ORDE IS NOT NULL AND idVIN_ITEM IS NOT NULL AND idVSL_ORHE IS NOT NULL AND idVGB_CUST IS NOT NULL AND idVGB_BPAR IS NOT NULL) [=COND:vsl_orst=]


GROUP BY idVSL_ORHE,idVSL_ORDE

EOC;

	return $trig;
		
	}
	
}

