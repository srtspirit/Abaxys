<?php



class var_agedreport extends dbMaster
{
	function var_agedreport($schema)
	{
		$this->dbMaster("var_oihe",$schema);
	}
	
	function dbFindMatch($objDta)
	{
		$this->localdbFnct = "Produre aged report";
		$this->localE_POST = $objDta;
			
		$trig = $this->buildTrigger($objDta);
		
		$tFnc = new AB_querySession;
		$trig = $tFnc->tblAccessCond($objDta,$trig,true,"onaccess,onaccess.USR");
		
		$dta = array();
		$dtaType = array();
		
		$dta["agingDate"] = $objDta["agingDate"];
		$dtaType["agingDate"] = PDO::PARAM_STR;
		
			
		
	  	$ageTbls = new dbMaster("var_oihe",$this->tblInfo->schema);
		//$ageTbls->dbProcessTransactionPdo($trig);
		$ageTbls->dbPdoPrep($trig,$dta,$dtaType);		

		foreach($ageTbls as $name => $value)
		{
			 $this->$name = $value;
		}		
		
	}
	
	function buildTrigger($objDta)
	{
	
		if (count($objDta["custFilter"]) > 0)
		{
			$cust = " AND '," . implode(",",$objDta["custFilter"]) . ",' ";
			$cust .= "LIKE CONCAT('%,',idVGB_CUST,',%') ";
		}
		$trig =<<<EOC
		
SELECT
		VGB_CUST_BPNAM
		,idVGB_CUST
		,0 as invoice
		,0 as invDate
		,MAX(VGB_CURR_CURID) as currency
        ,SUM(balance) as totalDebt
        ,SUM(thirty) as total30
        ,SUM(sixty) as total60
        ,SUM(ninety) as total90
        ,SUM(oneTwenty) as total120
        ,SUM(old) as totalOld
FROM
	(SELECT
		VGB_CUST_BPNAM
		,idVGB_CUST
		,invoice
		,VAR_OIHE_DOCDA
		,balance
		,VGB_CURR_CURID
		,CASE
			WHEN :agingDate - interval 30 day <= VAR_OIHE_DOCDA THEN balance
			ELSE 0
		END AS thirty
		,CASE
			WHEN :agingDate - interval 30 day > VAR_OIHE_DOCDA AND :agingDate - interval 60 day <= VAR_OIHE_DOCDA THEN balance
			ELSE 0
		END AS sixty
		,CASE
			WHEN :agingDate - interval 60 day > VAR_OIHE_DOCDA AND :agingDate - interval 90 day <= VAR_OIHE_DOCDA THEN balance
			ELSE 0
		END AS ninety
		,CASE
			WHEN :agingDate - interval 90 day > VAR_OIHE_DOCDA AND :agingDate - interval 120 day <= VAR_OIHE_DOCDA THEN balance
			ELSE 0
		END AS oneTwenty
		,CASE
			WHEN :agingDate - interval 120 day > VAR_OIHE_DOCDA THEN balance
			ELSE 0
		END AS old
	FROM
		(SELECT
			VGB_CUST_BPNAM
			,idVGB_CUST
			,VAR_OIHE_INVOI AS invoice
			,VAR_OIHE_DOCDA
			,CASE
				WHEN VAR_OIDE_AMUNT IS NULL THEN VAR_OIHE_AMUNT
				ELSE (MAX(VAR_OIHE_AMUNT) + SUM(VAR_OIDE_AMUNT))
			END AS balance
			,VGB_CURR_CURID
		
		FROM var_oihe
		LEFT JOIN var_oide ON VAR_OIDE_OITID = idVAR_OIHE [=COND:var_oide=]
		JOIN vgb_cust ON idVGB_CUST = VAR_OIHE_BCUST [=COND:vgb_cust=]
		JOIN vgb_curr ON idVGB_CURR = VAR_OIHE_CURID
		WHERE VAR_OIHE_AMUNT >= 0
			AND VAR_OIHE_DOCDA < :agingDate
			{$cust}
			AND (VAR_OIDE_TRNDA < :agingDate OR VAR_OIDE_TRNDA IS NULL)  [=COND:var_oihe=]
			
			
 

		GROUP BY VAR_OIHE_BCUST, idVAR_OIHE
		HAVING balance > 0) x
	) y
	GROUP BY VGB_CUST_BPNAM
    
UNION
    
SELECT  
		VGB_CUST_BPNAM
		,idVGB_CUST
		,invoice
		,VAR_OIHE_DOCDA as invDate
		,VGB_CURR_CURID as currency
		,0 as balance
		,CASE
			WHEN :agingDate - interval 30 day <= VAR_OIHE_DOCDA THEN balance
			ELSE 0
		END AS thirty
		,CASE
			WHEN :agingDate - interval 30 day > VAR_OIHE_DOCDA AND :agingDate - interval 60 day <= VAR_OIHE_DOCDA THEN balance
			ELSE 0
		END AS sixty
		,CASE
			WHEN :agingDate - interval 60 day > VAR_OIHE_DOCDA AND :agingDate - interval 90 day <= VAR_OIHE_DOCDA THEN balance
			ELSE 0
		END AS ninety
		,CASE
			WHEN :agingDate - interval 90 day > VAR_OIHE_DOCDA AND :agingDate - interval 120 day <= VAR_OIHE_DOCDA THEN balance
			ELSE 0
		END AS oneTwenty
		,CASE
			WHEN :agingDate - interval 120 day > VAR_OIHE_DOCDA THEN balance
			ELSE 0
		END AS old
FROM
	(SELECT 
		VGB_CUST_BPNAM
		,idVGB_CUST
		,VAR_OIHE_INVOI AS invoice
		,VAR_OIHE_DOCDA
		,CASE
			WHEN VAR_OIDE_AMUNT IS NULL THEN VAR_OIHE_AMUNT
			ELSE (MAX(VAR_OIHE_AMUNT) + SUM(VAR_OIDE_AMUNT))
		END AS balance
		,VGB_CURR_CURID
		
	FROM var_oihe
	LEFT JOIN var_oide ON VAR_OIDE_OITID = idVAR_OIHE [=COND:var_oide=]
    JOIN vgb_cust ON idVGB_CUST = VAR_OIHE_BCUST [=COND:vgb_cust=]
	JOIN vgb_curr ON idVGB_CURR = VAR_OIHE_CURID
	WHERE VAR_OIHE_AMUNT >= 0
		AND VAR_OIHE_DOCDA < :agingDate
		{$cust}
		AND (VAR_OIDE_TRNDA < :agingDate OR VAR_OIDE_TRNDA IS NULL) [=COND:var_oihe=]
	GROUP BY VAR_OIHE_BCUST, idVAR_OIHE
	HAVING balance > 0) x
ORDER BY VGB_CUST_BPNAM, invoice;
	
EOC;

		return $trig;
	}
	
}


class vsl_MTD_YTD extends dbMaster
{
	function vsl_MTD_YTD($schema)
	{
		$this->dbMaster("vsl_orst",$schema);
	}


	
	function dbFindMatch($objDta)
	{
		$this->localdbFnct = "Procedure MTD report";
		$this->localE_POST = $objDta;
		
		$trigObj = array();
		$trigObj["yearSelected"] = $objDta["yearSelected"];
		$trigObj["monthSelected"] = $objDta["monthSelected"];
		$trigObj["custFilter"] = $objDta["custFilter"];
		$trigObj["itemFilter"] = $objDta["itemFilter"];
			
		$trig = $this->setTrigger($trigObj);
		$this->trigger = $trig;

		$tFnc = new AB_querySession;
		$trig = $tFnc->tblAccessCond($objDta,$trig,true,"onaccess,onaccess.USR");
			
		$this->triggerAfterTblAccessCond= $trig;
			
	  	$mtdTbls = new dbMaster("vsl_orst",$this->tblInfo->schema);
		$mtdTbls->dbProcessTransactionPdo($trig);
		
		$occ = 0;
		while ($occ < count($mtdTbls->result))
		{
			$rec = $mtdTbls->result[$occ];
			$mtdTbls->result[$occ]["percMTDamt"] = $this->computePerc($rec["LASTYEAR_MTD"],$rec["THISYEAR_MTD"]);
			$mtdTbls->result[$occ]["percYTDamt"] = $this->computePerc($rec["LASTYEAR_YTD"],$rec["THISYEAR_YTD"]);
			$occ += 1;
		}

		foreach($mtdTbls as $name => $value)
		{
			 $this->$name = $value;
		}		
	}
	
	function computePerc($last,$curr)
	{
		$diff = "0";
		$neg = "";
		if ($last > $curr)
		{
			$neg = "-";
		}
		if ($last == 0 || $curr == 0 )
		{
			if ($last!=$curr)
			{
				$diff = $neg . "100";
			}
				
		}
		else
		{
			$diff = $neg . floor(abs($last/$curr)*100);
		}
		
		$diff .= "%";
		
		return $diff;
		
	}
	function setTrigger($objDta)
	{
		$year = $objDta["yearSelected"];
		$lastYear = $objDta["yearSelected"] -1;
		$month = $objDta["monthSelected"];
		$montUntil = $objDta["monthSelected"] + 1;
		if (strlen($montUntil) < 2)
		{
			$montUntil = "0" . $montUntil;
		}
		$cust = "";
		if (count($objDta["custFilter"]) > 0)
		{
			$cust = " AND '," . implode(",",$objDta["custFilter"]) . ",' ";
			$cust .= "LIKE CONCAT('%,',idVGB_CUST,',%') ";
		}
		$item = "";
		if (count($objDta["itemFilter"]) > 0)
		{
			$item = " AND '," . implode(",",$objDta["itemFilter"]) . ",' ";
			$item .= "LIKE CONCAT('%,',idVIN_ITEM,',%') ";
		}

$trig =<<<EOC


select (id), (name),(item), (idesc) ,
sum(CASE WHEN VSL_ORST_PDATE > '{$year}-{$month}' AND VSL_ORST_PDATE < '{$year}-{$montUntil}' THEN (REC_QTY*REC_AMT) ELSE 0 END ) as THISYEAR_MTD,
sum(CASE WHEN VSL_ORST_PDATE > '{$year}-{$month}' AND VSL_ORST_PDATE < '{$year}-{$montUntil}' THEN REC_QTY ELSE 0 END ) as THISYEAR_QTY,
sum(CASE WHEN VSL_ORST_PDATE > '{$lastYear}-{$month}' AND VSL_ORST_PDATE < '{$lastYear}-{$montUntil}' THEN (REC_QTY*REC_AMT) ELSE 0 END ) as LASTYEAR_MTD,
sum(CASE WHEN VSL_ORST_PDATE > '{$lastYear}-{$month}' AND VSL_ORST_PDATE < '{$lastYear}-{$montUntil}' THEN REC_QTY ELSE 0 END ) as LASTYEAR_QTY,
sum(CASE WHEN VSL_ORST_PDATE > '{$year}' AND VSL_ORST_PDATE < '{$year}-{$montUntil}' THEN (REC_QTY*REC_AMT) ELSE 0 END ) as THISYEAR_YTD,
sum(CASE WHEN VSL_ORST_PDATE > '{$lastYear}' AND VSL_ORST_PDATE < '{$lastYear}-{$montUntil}' THEN (REC_QTY*REC_AMT) ELSE 0 END ) as LASTYEAR_YTD,
sum(CASE WHEN VSL_ORST_PDATE > '{$lastYear}' AND VSL_ORST_PDATE < '{$year}' THEN (REC_QTY*REC_AMT)  ELSE 0 END ) as LASTYEAR_TOTAL
from(
( select 
VSL_ORST_PDATE,
vgb_bpar.VGB_BPAR_BPART as id,
vgb_cust.VGB_CUST_BPNAM as name, 
vin_item.VIN_ITEM_ITMID as item ,
vin_item.VIN_ITEM_DESC1 as idesc ,
VSL_ORST_ORDQT as REC_QTY, 
VSL_ORDE_OUNET as REC_AMT 
from vsl_orst
left join vsl_orde ON VSL_ORST_ORLIN = idVSL_ORDE [=COND:vsl_orde=]
left join vin_item ON VSL_ORDE_ITMID = idVIN_ITEM [=COND:vin_item=]
left join vsl_orhe ON VSL_ORST_ORNUM = idVSL_ORHE [=COND:vsl_orhe=]
left join vgb_cust ON VSL_ORHE_BTCUS = idVGB_CUST [=COND:vgb_cust=]
left join vgb_bpar ON VGB_CUST_BPART = idVGB_BPAR [=COND:vgb_bpar=]


WHERE VSL_ORST_STEPS > 'JJ_INVO' {$cust} {$item} 
 AND (idVSL_ORDE IS NOT NULL AND idVIN_ITEM IS NOT NULL AND idVSL_ORHE IS NOT NULL AND idVGB_CUST IS NOT NULL AND idVGB_BPAR IS NOT NULL) [=COND:vsl_orst=] ) as x   
)

GROUP BY name, item

EOC;

	return $trig;
		
	}
	
}


class his_prft_marg extends dbMaster
{
	function his_prft_marg($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
	}


	
	function dbFindMatch($objDta)
	{
		$this->localdbFnct = "Profit Margin report";
		$this->localE_POST = $objDta;
		
		$objSales = array();
		$objSales["PROCESS"] = $objDta["PROCESS"];
		$objSales["SESSION"] = $objDta["SESSION"];
  		$objSales["MAXREC_OUT"] = '0'; // No limit
  		$objSales["idVSL_ORHE"] = '0'; 
  		
  		$wTbls = new his_prft_report($this->tblInfo->schema);
		$wTbls->dbFindFrom($objSales);
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}		
		
	}
	
	
}

class his_prft_report extends dbMaster
{
	function his_prft_report($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
	}




	function dbSetTrig()
	{
     
	$localWhere = " (VSL_ORST_PDATE > '20160701') AND  ";
  
$trig = <<<EOD
			SELECT  * FROM   
			 
		 	( SELECT  * FROM vsl_orhe  
		 	
		LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=]
		LEFT JOIN vgb_slrp  ON idVGB_SLRP = VSL_ORHE_SLSRP  [=COND:vgb_slrp=] 
		LEFT JOIN vgb_mark  ON idVGB_MARK = VGB_CUST_MRKID  [=COND:vgb_mark=] 
		LEFT JOIN vgb_ctyp  ON idVGB_CTYP = VGB_CUST_CUTYP  [=COND:vgb_ctyp=] 
		LEFT JOIN vsl_orde  ON idVSL_ORHE = VSL_ORDE_ORNUM  [=COND:vsl_orde=] 
		LEFT JOIN vsl_orst  ON idVSL_ORDE = VSL_ORST_ORLIN  [=COND:vsl_orst=]
		LEFT JOIN vin_item  ON idVIN_ITEM = VSL_ORDE_ITMID  [=COND:vin_item=]
		LEFT JOIN vin_grou  ON idVIN_GROU = VIN_ITEM_ITGRP  [=COND:vin_grou=] 
		LEFT JOIN vin_ityp  ON idVIN_ITYP = VIN_ITEM_SEAR1  [=COND:vin_ityp=] 
			 
								
		WHERE {$localWhere} [=WHERE=]  [=COND:vsl_orhe=]  [=LIMIT=] ) tx	  
		
EOD;
		
	return $trig;
	
	}

	
}


class vsl_history extends dbMaster
{
	function vsl_history($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}


	
	function dbFindMatch($objDta)
	{
		$this->localdbFnct = "Sales History ----";
		$this->localE_POST = $objDta;
		
		
		$objSales = array();
		$objSales["PROCESS"] = $objDta["PROCESS"];
		$objSales["SESSION"] = $objDta["SESSION"];
  		$objSales["MAXREC_OUT"] = '0'; // No limit
  		$objSales["whereObj"] = array();

  		if ($objDta["idVSL_ORHE"] > 0)
  		{
  			$objSales["whereObj"]["idVSL_ORHE"] = $objDta["idVSL_ORHE"];
  		}
  		if ($objDta["idVGB_CUST"] > 0)
  		{
  			$objSales["whereObj"]["VSL_ORHE_BTCUS"] = $objDta["idVGB_CUST"];
  		}
  		
  		if ($objDta["idVIN_ITEM"] > 0)
  		{
  			$objSales["whereObj"]["VSL_ORDE_ITMID"] = $objDta["idVIN_ITEM"];
  		}
  		
  		
  		if (trim($objDta["VSL_ORHE_ORNUM"]) != "")
  		{
  			$objSales["whereObj"]["VSL_ORHE_ORNUM"] = $objDta["VSL_ORHE_ORNUM"];
  		}
  		if (trim($objDta["VSL_ORHE_CUSPO"]) != "")
  		{
  			$objSales["whereObj"]["VSL_ORHE_CUSPO"] = $objDta["VSL_ORHE_CUSPO"];
  		}
  		
  		$objSales["idVSL_ORHE"] = '0'; 
  		$wTbls = new vsl_detail($this->tblInfo->schema);
		$wTbls->dbFindFrom($objSales);

		$tmp = array();
		foreach($wTbls as $name => $value)
		{
			 $tmp[$name] = $value;
		}
		
		
		
		if ($wTbls->errorCode == 0 )
		{
	
			$occ = 0;
			while ($occ < count($wTbls->result) )
			{

				if($wTbls->result[$occ]["VSL_ORDE_ITMID"])
				{
					$wItmId = $wTbls->result[$occ]["VSL_ORDE_ITMID"];
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


 	 		$objPost = array();
 	 		$objPost["PROCESS"] = $E_POST["PROCESS"];
 	 		$objPost["SESSION"] = $E_POST["SESSION"];
 	 		$objPost["MAXREC_OUT"] = 0; // No limit
 	 		$objPost["idVIN_ITEM"] = '0';			
 	 		// Inventory
 	 		$wTblsInve = new vin_inventory($this->tblInfo->schema);
 	 		$objPost["vin_invent_items"] = $vinItemList;
 	 		$wTblsInve->dbFindFrom($objPost);
 	 		if (!$wTbls->dbSuppTbl)
 	 		{
 	 			$wTbls->dbSuppTbl = array();
 	 		}
			$wTbls->dbSuppTbl["vin_inve"] = $wTblsInve;

 	 		$objPost = array();
 	 		$objPost["PROCESS"] = $E_POST["PROCESS"];
 	 		$objPost["SESSION"] = $E_POST["SESSION"];
 	 		$objPost["MAXREC_OUT"] = 0; // No limit
 	 		$objPost["idVIN_ITEM"] = '0';			
 	 		// Inventory
 	 		$wTblsLots = new vin_item_lots($this->tblInfo->schema);
 	 		$objPost["vin_item_lots"] = $vinItemList;
 	 		$wTblsLots->dbFindFrom($objPost);
 	 		if (!$wTbls->dbSuppTbl)
 	 		{
 	 			$wTbls->dbSuppTbl = array();
 	 		}
			$wTbls->dbSuppTbl["vin_specs"] = $wTblsLots;

		}


		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}		
		
	}
	
	
}


class vsl_detail extends dbMaster
{
	function vsl_detail($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
	}


	function dbSetTrig()
	{
     
		$localWhere = "";
		$xxAnd = "";
		$whereObj = $this->E_POST["whereObj"];
		foreach($whereObj as $name => $value)
		{
			 $localWhere .= $xxAnd . $name . " = '" . $value . "' ";
			 $xxAnd = " AND ";
			 
		}
		if (trim($localWhere) != "")
		{
			$localWhere = " ( " . $localWhere . " ) AND ";
		}
				
						
  
$trig = <<<EOD
			SELECT  * FROM   
			 
		 	( SELECT  * FROM vsl_orhe  
		 	
			LEFT JOIN vsl_orde  ON idVSL_ORHE = VSL_ORDE_ORNUM  [=COND:vsl_orde=] 
			LEFT JOIN vsl_orst  ON idVSL_ORDE = VSL_ORST_ORLIN  [=COND:vsl_orst=]
			LEFT JOIN vin_unit  ON idVIN_UNIT = VSL_ORDE_QTUOM  [=COND:vin_unit=]
			LEFT JOIN vin_item  ON idVIN_ITEM = VSL_ORDE_ITMID  [=COND:vin_item=]
			LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=]
			LEFT JOIN vgb_addr  ON idVGB_ADDR = VSL_ORHE_BTADD OR idVGB_ADDR = VSL_ORHE_STADD  [=COND:vgb_addr=]
			WHERE {$localWhere} [=WHERE=]  [=COND:vsl_orhe=]  [=LIMIT=] ) tx	  
		
EOD;
		
	return $trig;
	
	}
}


class vpu_history extends dbMaster
{
	function vpu_history($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}


	
	function dbFindMatch($objDta)
	{
		$this->localdbFnct = "Purchase History ----";
		$this->localE_POST = $objDta;
		
		$objSales = array();
		$objSales["PROCESS"] = $objDta["PROCESS"];
		$objSales["SESSION"] = $objDta["SESSION"];
  		$objSales["MAXREC_OUT"] = '0'; // No limit
  		$objSales["whereObj"] = array();

  		if ($objDta["idVPU_ORHE"] > 0)
  		{
  			$objSales["whereObj"]["idVPU_ORHE"] = $objDta["idVPU_ORHE"];
  		}
  		if ($objDta["idVGB_SUPP"] > 0)
  		{
  			$objSales["whereObj"]["VPU_ORHE_BTCUS"] = $objDta["idVGB_SUPP"];
  		}
  		
  		if ($objDta["idVIN_ITEM"] > 0)
  		{
  			$objSales["whereObj"]["VPU_ORDE_ITMID"] = $objDta["idVIN_ITEM"];
  		}
  		
  		
  		if (trim($objDta["VPU_ORHE_ORNUM"]) != "")
  		{
  			$objSales["whereObj"]["VPU_ORHE_ORNUM"] = $objDta["VPU_ORHE_ORNUM"];
  		}
  		if (trim($objDta["VPU_ORHE_CUSPO"]) != "")
  		{
  			$objSales["whereObj"]["VPU_ORHE_CUSPO"] = $objDta["VPU_ORHE_CUSPO"];
  		}
  		
  		$objSales["idVPU_ORHE"] = '0'; 
  		$wTbls = new vpu_detail($this->tblInfo->schema);
		$wTbls->dbFindFrom($objSales);

		$tmp = array();
		foreach($wTbls as $name => $value)
		{
			 $tmp[$name] = $value;
		}
		
		if ($wTbls->errorCode == 0 )
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
      
			

 	 		$objPost = array();
 	 		$objPost["PROCESS"] = $E_POST["PROCESS"];
 	 		$objPost["SESSION"] = $E_POST["SESSION"];
 	 		$objPost["MAXREC_OUT"] = 0; // No limit
 	 		$objPost["idVIN_ITEM"] = '0';			
 	 		// Inventory
 	 		$wTblsInve = new vin_inventory($this->tblInfo->schema);
 	 		$objPost["vin_invent_items"] = $vinItemList;
 	 		$wTblsInve->dbFindFrom($objPost);
 	 		if (!$wTbls->dbSuppTbl)
 	 		{
 	 			$wTbls->dbSuppTbl = array();
 	 		}
			$wTbls->dbSuppTbl["vin_inve"] = $wTblsInve;

 	 		$objPost = array();
 	 		$objPost["PROCESS"] = $E_POST["PROCESS"];
 	 		$objPost["SESSION"] = $E_POST["SESSION"];
 	 		$objPost["MAXREC_OUT"] = 0; // No limit
 	 		$objPost["idVIN_ITEM"] = '0';			
 	 		// Inventory
 	 		$wTblsLots = new vin_item_lots($this->tblInfo->schema);
 	 		$objPost["vin_item_lots"] = $vinItemList;
 	 		$wTblsLots->dbFindFrom($objPost);
 	 		if (!$wTbls->dbSuppTbl)
 	 		{
 	 			$wTbls->dbSuppTbl = array();
 	 		}
			$wTbls->dbSuppTbl["vin_specs"] = $wTblsLots;

		}

		
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}		
		
	}
	
	
}

class vpu_detail extends dbMaster
{
	function vpu_detail($schema)
	{
		$this->dbMaster("vpu_orhe",$schema);
	}


	function dbSetTrig()
	{
     
		$localWhere = "";
		$xxAnd = "";
		$whereObj = $this->E_POST["whereObj"];
		foreach($whereObj as $name => $value)
		{
			 $localWhere .= $xxAnd . $name . " = '" . $value . "' ";
			 $xxAnd = " AND ";
			 
		}
		if (trim($localWhere) != "")
		{
			$localWhere = " ( " . $localWhere . " ) AND ";
		}
				
						
  
$trig = <<<EOD
			SELECT  * FROM   
			 
		 	( SELECT  * FROM vpu_orhe  
		 	
			LEFT JOIN vpu_orde  ON idVPU_ORHE = VPU_ORDE_ORNUM  [=COND:vpu_orde=] 
			LEFT JOIN vpu_orst  ON idVPU_ORDE = VPU_ORST_ORLIN  [=COND:vpu_orst=]
			LEFT JOIN vin_unit  ON idVIN_UNIT = VPU_ORDE_QTUOM  [=COND:vin_unit=]
			LEFT JOIN vin_item  ON idVIN_ITEM = VPU_ORDE_ITMID  [=COND:vin_item=]
			LEFT JOIN vgb_supp  ON idVGB_SUPP = VPU_ORHE_BTCUS  [=COND:vgb_supp=]				
			LEFT JOIN vgb_addr  ON idVGB_ADDR = VPU_ORHE_BTADD OR idVGB_ADDR = VPU_ORHE_STADD  [=COND:vgb_addr=]
			WHERE {$localWhere} [=WHERE=]  [=COND:vpu_orhe=]  [=LIMIT=] ) tx	  
		
EOD;
		
	return $trig;
	
	}
}



require_once "VGB_PARTNERS.php";
require_once "VIN_ITEMS.php";
require_once "VIN_INVENTORY.php";
require_once "HIS_REPORTS_DEVAL.php";
require_once "HIS_REPORTS_POS.php";


?>
