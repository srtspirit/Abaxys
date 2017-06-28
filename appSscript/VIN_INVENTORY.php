<?php

/*
			Transaction Source	8-LIST FIELD	0	N		
			INVENT	Inventory		
			INVPHY	Physical Inventory	
			PROORD	Production Order	
			PROREC	Production Receipt	
			PURORD	Purchase Order		
			PURQCR	Quality Control		
			PURREC	Purchase Receipt	
			PURRET	Purchase Return		
			SLSDEL	Sales Delivery		
			SLSORD	Sales Order		
			SLSREL	Sales Release		
			SLSRTN	Sales Return			

*/	




class vin_itemLotQuery extends dbMaster
{
	function vin_itemLotQuery($schema)
	{
		$this->dbMaster("vin_item",$schema);
		
	}

	


	function dbSetTrig()
	{



$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vin_item  

		LEFT JOIN vin_lshe  ON VIN_LSHE_ITMID = idVIN_ITEM  [=COND:vin_lshe=]
		LEFT JOIN vin_ssit  ON VIN_SSIT_ITMID = VIN_LSHE_ITMID  [=COND:vin_ssit=]
		LEFT JOIN vin_ssma  ON idVIN_SSMA = VIN_SSIT_SPESQ  [=COND:vin_ssma=]

		WHERE {$this->localWhere} [=WHERE=] [=COND:vin_item=] ORDER BY idVIN_ITEM ASC  [=LIMIT=] )  tx		

		
EOD;

		return $trig;


	}

}


class vin_item_inv extends dbMaster
{
	function vin_item_inv($schema)
	{
		$this->dbMaster("vin_item",$schema);
		
	}

	


	function dbSetTrig()
	{
		
	
		if ($this->E_POST["vin_item_inv"])
		{
			$localWhere = "[=WHERE=]";
			$wClause = explode(",",$this->E_POST["vin_item_inv"]);
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
		LEFT JOIN vin_inve  ON VIN_INVE_ITMID = idVIN_ITEM  [=COND:vin_inve=]
		LEFT JOIN vin_lslq  ON VIN_LSLQ_ITMID = idVIN_ITEM  [=COND:vin_lslq=]
								
		WHERE $localWhere [=WHERE=] [=COND:vin_item=] [=LIMIT=] )  tx		

		
EOD;


		return $trig;
		
	}
}



class vin_inveQuery extends dbMaster
{
	function vin_inveQuery($schema)
	{
		$this->dbMaster("vin_item",$schema);
		
	}

	


	function dbSetTrig()
	{
		
	
		if ($this->E_POST["vin_inveQuery"])
		{
			$localWhere = "[=WHERE=]";
			$wClause = explode(",",$this->E_POST["vin_inveQuery"]);
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

$localJoin =<<<EOC

		LEFT JOIN vsl_orde  ON idVIN_ITEM = VSL_ORDE_ITMID  [=COND:vsl_orde=]
		LEFT JOIN vsl_orhe  ON idVSL_ORHE = VSL_ORDE_ORNUM  [=COND:vsl_orhe=]
		LEFT JOIN vsl_orst  ON VSL_ORST_ORLIN = idVSL_ORDE  [=COND:vsl_orst=]
		LEFT JOIN vsl_lstr  ON VSL_LSTR_STPSQ = idVSL_ORST  [=COND:vsl_lstr=]
		LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=]
		
EOC;

		if ($this->processId == "VPU_ORDERS" )
		{
		
$localJoin =<<<EOC

		LEFT JOIN vpu_orde  ON idVIN_ITEM = VPU_ORDE_ITMID  [=COND:vpu_orde=]
		LEFT JOIN vpu_orhe  ON idVPU_ORHE = VPU_ORDE_ORNUM  [=COND:vpu_orhe=]
		LEFT JOIN vpu_orst  ON VPU_ORST_ORLIN = idVPU_ORDE  [=COND:vpu_orst=]
		LEFT JOIN vpu_lstr  ON VPU_LSTR_STPSQ = idVPU_ORST  [=COND:vpu_lstr=]
		LEFT JOIN vgb_supp  ON idVGB_SUPP = VPU_ORHE_BTCUS  [=COND:vgb_supp=]
		
EOC;
		
			
		}
		
		
		if (!$this->dbSuppTbl)
		{
			$this->dbSuppTbl = array();
		}
		
		
		$pObj = $this->E_POST;



		$wTbls = new vin_itemLotQuery($this->tblInfo->schema);
		$wTbls->localWhere = $localWhere;

		$wTbls->dbFindFrom($pObj);
		$this->dbSuppTbl["vin_item_vin_lshe"] = $wTbls;

				

$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vin_item  
		LEFT JOIN vin_inve  ON VIN_INVE_ITMID = idVIN_ITEM  [=COND:vin_inve=]
		LEFT JOIN vin_lslq  ON VIN_LSLQ_ITMID = idVIN_ITEM  [=COND:vin_lslq=]
		LEFT JOIN vin_lshe  ON idVIN_LSHE = VIN_LSLQ_LOTSQ  [=COND:vin_lshe=]
		
		{$localJoin}
		
		
								
		WHERE $localWhere [=WHERE=] [=COND:vin_item=] ORDER BY idVIN_ITEM ASC  [=LIMIT=] )  tx		

		
EOD;


		return $trig;
		
	}
}



class vin_inventoryDim extends dbMaster
{
	// Will retreive inventory from all DIM Level
	// Not used yet
	function vin_inventoryDim($schema)
	{
		$this->dbMaster("vin_item",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}

	function dbSetTrig()
	{
		
	
				

$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vin_item  
		LEFT JOIN vin_inve  ON VIN_INVE_ITMID = idVIN_ITEM  
								
		WHERE [=WHERE=]  [=LIMIT=] )  tx		

		
EOD;


		return $trig;
		
	}
	
}


class vin_inventory extends dbMaster
{
	function vin_inventory($schema)
	{
		$this->dbMaster("vin_item",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}

	


	function dbSetTrig()
	{


		$localWhere = "";
		// $this->E_POST = $_SESSION["lastPost"];
		
		if ($this->E_POST["vin_invent_items"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["vin_invent_items"]);
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
			SELECT * FROM  
			 
		 	( SELECT * FROM vin_item  
		LEFT JOIN vin_inve  ON VIN_INVE_ITMID = idVIN_ITEM  [=COND:vin_inve=]
		LEFT JOIN vin_lslq  ON VIN_LSLQ_ITMID = idVIN_ITEM  [=COND:vin_lslq=]
		LEFT JOIN vin_lshe  ON idVIN_LSHE = VIN_LSLQ_LOTSQ  [=COND:vin_lshe=] 
		
		
								
		WHERE {$localWhere} [=WHERE=]  [=COND:vin_item=] ORDER BY idVIN_ITEM ASC  [=LIMIT=] )  tx		

		
EOD;


		return $trig;
		
	}

	
	function setTransacSource($source)
	{
		switch ($source["PROCESS"])
		{
			case "VSL_ORDERS":
				return "SLSORD"; // Sales Order
			break;
			case "VPU_ORDERS":
				return "PURORD"; // Purchase Order
			break;
			default:
		}

	
	}


	function TV_VIN_TRANSACTION($source,$dtaSet)
	{

		// Get current affectation dimOrg
		$tFnc = new AB_querySession;
		$orgAffect = $tFnc->getCurrentAffect();
		$currAffect = "," . $orgAffect["levelId"];
		
		$this->updateDataSet = $dtaSet;
		$this->updateDataUpd = array();
		$trig = "";
		foreach($this->updateDataSet as $lstName => $updObj)
		{

			if ($updObj["tblName"] == "vin_inve"  )
			{
				

				$tmpObj = array();
				$tmpObj["idVIN_ITEM"] = $updObj["VIN_INVE_ITMID"];
				$this->dbFindMatch($tmpObj);					
				if ($this->result[0]["VIN_ITEM_INVIT"]=="1")
				{

$trig = <<<EOC

			INSERT INTO {$updObj["tblName"]} (VIN_INVE_ITMID,VIN_INVE_WARID,VIN_INVE_LOCID,VIN_INVE_BOHQT,VIN_INVE_ALOQT,VIN_INVE_PURQT,VIN_INVE_AB_DILEVEL)
			 VALUES ('{$updObj["VIN_INVE_ITMID"]}','{$updObj["VIN_INVE_WARID"]}','{$updObj["VIN_INVE_LOCID"]}','{$updObj["VIN_INVE_BOHQT"]}','0','0','{$currAffect}')
			ON DUPLICATE KEY 
			UPDATE VIN_INVE_BOHQT = VIN_INVE_BOHQT +  {$updObj["VIN_INVE_BOHQT"]}
			,VIN_INVE_ALOQT = VIN_INVE_ALOQT + {$updObj["VIN_INVE_ALOQT"]}, VIN_INVE_PURQT = VIN_INVE_PURQT + {$updObj["VIN_INVE_PURQT"]};	
				


EOC;
	
				$this->updateDataUpd[count($this->updateDataUpd)] = $this->dbProcessTransactionPdo($trig);
		
				}

			}			
			
		}
		
		$trig = "";
		foreach($this->updateDataSet as $lstName => $updObj)
		{


			if ($updObj["tblName"] == "vin_lslq"  )
			{
			
				$tmpObj = array();
				$tmpObj["idVIN_ITEM"] = $updObj["VIN_LSLQ_ITMID"];
				$this->dbFindMatch($tmpObj);					
				if ($this->result[0]["VIN_ITEM_INVIT"]=="1")
				{					
			
$trig = <<<EOC

			INSERT INTO {$updObj["tblName"]} (VIN_LSLQ_ITMID,VIN_LSLQ_LOTSQ,VIN_LSLQ_WARID,VIN_LSLQ_LOCID,VIN_LSLQ_BOHQT,VIN_LSLQ_ALOQT,VIN_LSLQ_PURQT,VIN_LSLQ_AB_DILEVEL)
			 VALUES ('{$updObj["VIN_LSLQ_ITMID"]}','{$updObj["VIN_LSLQ_LOTSQ"]}','{$updObj["VIN_LSLQ_WARID"]}','{$updObj["VIN_LSLQ_LOCID"]}','{$updObj["VIN_LSLQ_BOHQT"]}','0','0','{$currAffect}')
			ON DUPLICATE KEY 
			UPDATE VIN_LSLQ_BOHQT = VIN_LSLQ_BOHQT + {$updObj["VIN_LSLQ_BOHQT"]}
			,VIN_LSLQ_ALOQT = VIN_LSLQ_ALOQT + {$updObj["VIN_LSLQ_ALOQT"]},VIN_LSLQ_PURQT = VIN_LSLQ_PURQT + {$updObj["VIN_LSLQ_PURQT"]};
				
EOC;


				$this->updateDataUpd[count($this->updateDataUpd)] = $this->dbProcessTransactionPdo($trig);
		
				}

			
			}

			
			
		}
		
		$this->updSelect = $trig . $trig2;
		// $this->pass0 = $this->dbProcessTransactionPdo($trig);
		
		// $this->pass1 = $this->dbProcessTransactionPdo($trig2);
		
	}


	function dbProcessTransactionPdo($trig)
	{
		
		$this->brTrConn = $this->masterTranConn;
		
		$servername = "localhost";
		
		// NEW
		$tFnc = new AB_querySession;
		$tObj = $tFnc->getschemaReference($this->tblInfo->tblName);
		$username = $tObj['GSRresult'][0]['CFG_DBREF_DBUSER'];
		$password = $tObj['GSRresult'][0]['CFG_DBREF_DBUSERPWD'];
		

		$dbname = $this->tblInfo->schema;

		try
		{


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

			$this->errorInfo = $stmt->errorInfo();
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





	function TV_VIN_TRN_PROCESS($source,$dtaObj)
	{
	
		// Main init error var
		$this->TV_VIN_TEJ_INIT_ERR_VAR();
		$this->transactionSource = $this->setTransacSource($source);
		$initVIN_TEJ = $this->VIN_TEJ;

		$this->allocationQtys = array();
		$this->trnErrorCode = 0;

		if(!$this->ALINERR)
		{
			$this->ALINERR = array();
		}
		// $this->ALINERR .= "[bgn]";
		
		$this->TV_VIN_TRN_INIT_DATASET($dtaObj);
		
		// loop by item for tranfers to balance before
		foreach($this->trnRecSet as $name => $value)
		{
			$this->VIN_TEJ["ITEM_COUNT"] += 1;
			$occ = 0;
			while ($occ < count($value))
			{
				$this->VIN_TEJ["TRANS_COUNT"] += 1;
				$value[$occ]["VIN_TEJ"] = $initVIN_TEJ;
				$occ += 1;
			}

			if (strpos("xx" . $name,"L")< 1)
			{
				
				$this->TV_VIN_TRN_PROCESS_RecSet($name,$value,$source);
				
				// $this->ALINERR[count($this->ALINERR)] = "[RecSet]" . $this->errorCode;
				$this->ALINERR[count($this->ALINERR)] = $this->wT;
			}
			else
			{
				$this->TV_VIN_TRN_PROCESS_RecSetLots($name,$value,$source);
				// $this->ALINERR[count($this->ALINERR)] = "[LotSet]" . $this->errorCode;
				$this->ALINERR[count($this->ALINERR)] = $this->wT;
			}
			
		}
		
		$this->errorCode = $this->trnErrorCode;
	}
	
	function setNullVal($qVal)
	{
		
		if ($qVal != null)
		{
			return $qVal;
		}
		else
		{
			return 0;
		}
	}
		
	// One item all transaction
	function TV_VIN_TRN_PROCESS_RecSet($name,$dtaObj,$source)
	{
	
		$tmpObj = array();
		$tmpObj["idVIN_ITEM"] = $name;
		$this->dbFindMatch($tmpObj);	
		$this->invRecSet = $this->result; 

		$itemDesc = "<span class='text-primary ab-strong'>".$this->result[0]["VIN_ITEM_ITMID"] . " - " .  $this->result[0]["VIN_ITEM_DESC1"] . "</span><br>";
		$occ = 0;
		while($occ < count($dtaObj) && $this->invRecSet[0]["VIN_ITEM_INVIT"]=="1" )
		{
			$tmpObj = array();
			$tmpObj["PROCESS"] = $source["PROCESS"];
			$tmpObj["SESSION"] = $source["SESSION"];
			$tmpObj["TBLNAME"] = "vin_inve";	
			
			$tmpObj["VIN_INVE_ITMID"] = $dtaObj[$occ]["idVIN_ITEM"];
			$tmpObj["VIN_INVE_WARID"] = $dtaObj[$occ]["idVIN_WARS"];
			$tmpObj["VIN_INVE_LOCID"] = $dtaObj[$occ]["idVIN_LOCS"];
			
			// Unit not used always default base 1 qty - $tmpObj["VIN_INVE_UNITM"] = $dtaObj[$occ]["idVIN_UNIT"];
			$wTbls = new dbMaster("vin_inve",$this->tblInfo->schema);
			$wTbls->brTrConn = !$this->masterTranConn?null:$this->masterTranConn;
			$wTbls->dbFindMatch($tmpObj);
			
			if (!$this->inveOrgVals)
			{
				$this->inveOrgVals = array();
			}
			
			$this->inveOrgVals[count($this->inveOrgVals)] = $wTbls;
			
			if ($wTbls->rowCount == 0)
			{
				$tmpObj["VIN_INVE_BOHQT"] = $dtaObj[$occ]["VIN_ADJUST_BOHQT"];
				$tmpObj["VIN_INVE_ALOQT"] = $dtaObj[$occ]["VIN_ADJUST_ALOQT"];
				$tmpObj["VIN_INVE_PURQT"] = $dtaObj[$occ]["VIN_ADJUST_PURQT"];
				$tmpObj["VIN_INVE_UNITM"] = $this->invRecSet[0]["VIN_ITEM_UNITM"];
				$tmpObj["VIN_INVE_FACTO"] = 1;
				$wTblsT = new dbMaster("vin_inve",$this->tblInfo->schema);
				$wTblsT->brTrConn = !$this->masterTranConn?null:$this->masterTranConn;
				$wTblsT->dbInsRec($tmpObj);
				$this->trnErrorCode += $wTblsT->errorCode;
			}
			else
			{
				$tmpObj["VIN_INVE_BOHQT"] = $wTbls->result[0]["VIN_INVE_BOHQT"] + $dtaObj[$occ]["VIN_ADJUST_BOHQT"];
				$tmpObj["VIN_INVE_ALOQT"] = $wTbls->result[0]["VIN_INVE_ALOQT"] + $dtaObj[$occ]["VIN_ADJUST_ALOQT"];
				$tmpObj["VIN_INVE_PURQT"] = $wTbls->result[0]["VIN_INVE_PURQT"] + $dtaObj[$occ]["VIN_ADJUST_PURQT"];
				$tmpObj["idVIN_INVE"] = $wTbls->result[0]["idVIN_INVE"];

				
				if ($this->setNullVal($tmpObj["VIN_INVE_BOHQT"]) != 0 || $this->setNullVal($tmpObj["VIN_INVE_ALOQT"]) != 0 || $this->setNullVal($tmpObj["VIN_INVE_PURQT"]) != 0 )
				{  
					$wTblsT = new dbMaster("vin_inve",$this->tblInfo->schema);
					$wTblsT->brTrConn = !$this->masterTranConn?null:$this->masterTranConn;
					$wTblsT->dbUpdRec($tmpObj);
					$this->trnErrorCode += $wTblsT->errorCode;
				}
				else
				{
					$wTblsT = new dbMaster("vin_inve",$this->tblInfo->schema);
					$wTblsT->brTrConn = !$this->masterTranConn?null:$this->masterTranConn;
					$wTblsT->dbDelRec($tmpObj);
					$this->trnErrorCode += $wTblsT->errorCode;
				}
			}

			if ($this->setNullVal($tmpObj["VIN_INVE_BOHQT"]) < 0)
			{
				$this->trnErrorCode += 1;
				$this->allocationQtys[count($this->allocationQtys)] = "<div class='ab-border'>".$itemDesc  . " No on hand Qty Available </div>";
			}
			else
			{
				if ($this->setNullVal($tmpObj["VIN_INVE_BOHQT"]) - $this->setNullVal($tmpObj["VIN_INVE_ALOQT"]) < 0)
				{
					$this->trnErrorCode += 1;
					$this->allocationQtys[count($this->allocationQtys)] = "<div class='ab-border'>".$itemDesc . " No Qty Available to allocate </div>";
				}
			}
			 
			$this->wT = $wTblsT;
			
			$dtaObj[$occ]["dbResult"] = $wTblsT;
			$occ += 1;
		}
		
		$this->trnRecSet[$name] = $dtaObj;

/*
		GOSUB TV_VIN_TRN_ITEM_GET
		IF II_PROCESS_ERR THEN GOTO TV_VIN_TRN_PROCESS_EOP
	
		GOSUB TV_VIN_TRN_UNIT_GET
		IF II_PROCESS_ERR THEN GOTO TV_VIN_TRN_PROCESS_EOP
	
		GOSUB TV_VIN_TRN_EVAL_TRANS
		IF II_PROCESS_ERR THEN GOTO TV_VIN_TRN_PROCESS_EOP
	
		LET TV_VIN_GET_TRAN_NUMBER = 0;
		GOSUB TV_VIN_TRN_UPD
*/
	
	}	
		
		
	// One item all transaction
	function TV_VIN_TRN_PROCESS_RecSetLots($name,$dtaObj,$source)
	{

		$tmpObj = array();
		$tmpObj["idVIN_ITEM"] = substr($name,1);
		$this->dbFindMatch($tmpObj);	
		
		$this->invRecSet = $this->result; 
		$itemDesc = "<span class='text-primary ab-strong'>".$this->result[0]["VIN_ITEM_ITMID"] . " - " .  $this->result[0]["VIN_ITEM_DESC1"] . "</span><br>";
		
		$occ = 0;
		while($occ < count($dtaObj) && $this->invRecSet[0]["VIN_ITEM_INVIT"]=="1" )
		{

			$tmpObj = array();
			$tmpObj["PROCESS"] = $source["PROCESS"];
			$tmpObj["SESSION"] = $source["SESSION"];
			$tmpObj["TBLNAME"] = "vin_lshe";
			$tmpObj["idVIN_LSHE"] = $dtaObj[$occ]["idVIN_LSHE"];
			$wTbls = new dbMaster("vin_lshe",$this->tblInfo->schema);
			$wTbls->dbFindMatch($tmpObj);
									
			$lotDesc = "<span class='text-success'>Lot Id: ". $wTbls->result[0]["VIN_LSHE_LOTID"];
			if ($wTbls->result[0]["VIN_LSHE_SERNO"])
			{
				$lotDesc .= " - " . $wTbls->result[0]["VIN_LSHE_SERNO"];
			}	
			$lotDesc .= "</span><br>";

			$tmpObj = array();
			$tmpObj["PROCESS"] = $source["PROCESS"];
			$tmpObj["SESSION"] = $source["SESSION"];
			$tmpObj["TBLNAME"] = "vin_lslq";	
			
			$tmpObj["VIN_LSLQ_ITMID"] = $dtaObj[$occ]["idVIN_ITEM"];
			$tmpObj["VIN_LSLQ_LOTSQ"] = $dtaObj[$occ]["idVIN_LSHE"];
			$tmpObj["VIN_LSLQ_WARID"] = $dtaObj[$occ]["idVIN_WARS"];
			$tmpObj["VIN_LSLQ_LOCID"] = $dtaObj[$occ]["idVIN_LOCS"];
			
			// Unit not used always default base 1 qty - $tmpObj["VIN_INVE_UNITM"] = $dtaObj[$occ]["idVIN_UNIT"];
			$wTbls = new dbMaster("vin_lslq",$this->tblInfo->schema);
			$wTbls->brTrConn = !$this->masterTranConn?null:$this->masterTranConn;
			$wTbls->dbFindMatch($tmpObj);
			
				
			if ($wTbls->rowCount == 0)
			{
				
				$tmpObj["VIN_LSLQ_BOHQT"] = $dtaObj[$occ]["VIN_ADJLOT_BOHQT"];
				$tmpObj["VIN_LSLQ_ALOQT"] = $dtaObj[$occ]["VIN_ADJLOT_ALOQT"];
				$tmpObj["VIN_LSLQ_PURQT"] = $dtaObj[$occ]["VIN_ADJLOT_PURQT"];
				$tmpObj["VIN_LSLQ_UNITM"] = $this->invRecSet[0]["VIN_ITEM_UNITM"];
				$tmpObj["VIN_LSLQ_FACTO"] = 1;
				$wTblsT = new dbMaster("vin_lslq",$this->tblInfo->schema);
				$wTblsT->brTrConn = !$this->masterTranConn?null:$this->masterTranConn;
				$wTblsT->dbInsRec($tmpObj);
				$this->trnErrorCode += $wTblsT->errorCode;
				
			}
			else
			{
				
				$tmpObj["VIN_LSLQ_BOHQT"] = $wTbls->result[0]["VIN_LSLQ_BOHQT"] + $dtaObj[$occ]["VIN_ADJLOT_BOHQT"];
				$tmpObj["VIN_LSLQ_ALOQT"] = $wTbls->result[0]["VIN_LSLQ_ALOQT"] + $dtaObj[$occ]["VIN_ADJLOT_ALOQT"];
				$tmpObj["VIN_LSLQ_PURQT"] = $wTbls->result[0]["VIN_LSLQ_PURQT"] + $dtaObj[$occ]["VIN_ADJLOT_PURQT"];
				$tmpObj["idVIN_LSLQ"] = $wTbls->result[0]["idVIN_LSLQ"];
				
				
				if ($this->setNullVal($tmpObj["VIN_LSLQ_BOHQT"]) != 0 || $this->setNullVal($tmpObj["VIN_LSLQ_ALOQT"]) != 0 || $this->setNullVal($tmpObj["VIN_LSLQ_PURQT"]) != 0 )
				{  
					$wTblsT = new dbMaster("vin_lslq",$this->tblInfo->schema);
					$wTblsT->brTrConn = !$this->masterTranConn?null:$this->masterTranConn;
					$wTblsT->dbUpdRec($tmpObj);
					$this->trnErrorCode += $wTblsT->errorCode;
				}
				else
				{
					$wTblsT = new dbMaster("vin_lslq",$this->tblInfo->schema);
					$wTblsT->brTrConn = !$this->masterTranConn?null:$this->masterTranConn;
					$wTblsT->dbDelRec($tmpObj);
					$this->trnErrorCode += $wTblsT->errorCode;
				}
			}
			 
			if ($this->setNullVal($tmpObj["VIN_LSLQ_BOHQT"]) < 0)
			{
				$this->trnErrorCode += 1;
				$this->allocationQtys[count($this->allocationQtys)] = "<div class='ab-border'>".$itemDesc  . $lotDesc . " No on hand Qty Available </div>";
			}
			else
			{
				if ($this->setNullVal($tmpObj["VIN_LSLQ_BOHQT"]) - $this->setNullVal($tmpObj["VIN_LSLQ_ALOQT"]) < 0)
				{
					$this->trnErrorCode += 1;
					$this->allocationQtys[count($this->allocationQtys)] = "<div class='ab-border'>".$itemDesc . $lotDesc . " No Qty Available to allocate </div>";
				}
			}
			
			$dtaObj[$occ]["dbResult"] = $wTblsT;
			$occ += 1;
		}
		$this->wT = $wTblsT;
		$this->trnRecSet[$name] = $dtaObj;

/*
		GOSUB TV_VIN_TRN_ITEM_GET
		IF II_PROCESS_ERR THEN GOTO TV_VIN_TRN_PROCESS_EOP
	
		GOSUB TV_VIN_TRN_UNIT_GET
		IF II_PROCESS_ERR THEN GOTO TV_VIN_TRN_PROCESS_EOP
	
		GOSUB TV_VIN_TRN_EVAL_TRANS
		IF II_PROCESS_ERR THEN GOTO TV_VIN_TRN_PROCESS_EOP
	
		LET TV_VIN_GET_TRAN_NUMBER = 0;
		GOSUB TV_VIN_TRN_UPD
*/
	
	}	

	function TV_VIN_TEJ_INIT_ERR_VAR()
	{
		
		// Transaction Error Journal
		$this->VIN_TEJ = array();
		
		$this->VIN_TEJ["ERRMESS_ID"] = 0;
		$this->VIN_TEJ["PROCESS_ERR"] = 0;
		$this->VIN_TEJ["TRANS_GENERAL_ERROR"] = 0;
		$this->VIN_TEJ["TRANS_TRTYPE_ERROR"] = 0;
		$this->VIN_TEJ["TRANS_TRBAL_ERROR"] = 0;
		$this->VIN_TEJ["TRNTY_NOT_VALID"] = 0;
		$this->VIN_TEJ["TRBAL_NOT"] = 0;
		$this->VIN_TEJ["TRANS_AVAILQ_ERROR"] = 0;
		$this->VIN_TEJ["AVAILQ_NOT"] = 0;
		$this->VIN_TEJ["TRANS_UNIT_ERROR"] = 0; 
		$this->VIN_TEJ["UNITM_NOT"] = 0;
		$this->VIN_TEJ["TRANS_LOCAT_ERROR"] = 0;
		$this->VIN_TEJ["LOCAT_NOT"] = 0;
		$this->VIN_TEJ["ITEM_COUNT"] = 0;
		$this->VIN_TEJ["TRANS_COUNT"] = 0;
	}
	
	function TV_VIN_TRN_INIT_DATASET($dtaObj)
	{
		$this->trnRecWtf = array();
		$this->trnRecSet = array();
		$occ = 0;
		while ( $occ < count ($dtaObj))
		{
			if ($dtaObj[$occ]["idVIN_ITEM"])
			{
				$this->trnRecWtf[count($this->trnRecWtf)] = $dtaObj[$occ]["VIN_ADJLOT_BOHQT"];
						
				if (array_key_exists("VIN_ADJLOT_BOHQT",$dtaObj[$occ])!=true)
				{
					$item = $dtaObj[$occ]["idVIN_ITEM"];
				}
				else
				{
					$item = "L" . $dtaObj[$occ]["idVIN_ITEM"];
				}
				
				if (!$this->trnRecSet[$item])
				{
					$this->trnRecSet[$item] = array();
				}
				$wCount = count($this->trnRecSet[$item]);
				
				$this->trnRecSet[$item][$wCount] = $dtaObj[$occ];
				
			}
			$occ += 1;
		}		
		
	}




	// REM Evaluate Transactions
	function TV_VIN_TRN_EVAL_TRANS($dtaObj)
	{

		$occ = 0;
	}
	
//	
//			while ($occ < count($dtaObj))
//			{
//	
//				GOSUB II_VIN_TRN_ACCU_TRBAL
//	
//			GOSUB II_VIN_TRN_EVAL_UNITM
//			IF  II_EVAL_UNITM_NOT THEN
//	:			LET II_EVAL_TRANS_UNIT_ERROR = 2;
//	:			LET II_VIN_TRN_ERRMESS = 10002;
//	:			GOSUB II_VIN_TRN_ERRMESS
//	:		FI		
//	
//			GOSUB II_VIN_TRN_EVAL_LOCAT
//			IF  II_EVAL_LOCAT_NOT THEN
//	:			LET II_EVAL_TRANS_LOCAT_ERROR = 1;
//	:			LET II_VIN_TRN_ERRMESS = 10001;
//	:			GOSUB II_VIN_TRN_ERRMESS
//	:		FI		
//	
//	REM		PRINT "ERR11:",II_VIN_TRN_EVAL_UNITM," ERR12:",II_VIN_TRN_EVAL_LOCAT," GERR:",II_PROCESS_ERR,;INPUT *
//			
//			GOSUB II_VIN_TRN_ERR_UPD
//	
//			LET II_EVAL_TRANS_STEP = II_EVAL_TRANS_STEP + 1
//			
//			
//			
//			$occ += 1;
//		}
//	
//		GOSUB II_VIN_TRN_EVAL_TRNTY
//	
//		IF II_EVAL_TRNTY_NOT_VALID THEN
//	:		LET II_EVAL_TRANS_TRTYPE_ERROR = 4;
//	:		LET II_VIN_TRN_ERRMESS = 10004;
//	:		GOSUB II_VIN_TRN_ERRMESS
//	:	FI
//	
//		IF II_EVAL_TRBAL_NOT THEN
//	:		LET II_EVAL_TRANS_TRBAL_ERROR = 8;
//	:		LET II_VIN_TRN_ERRMESS = 10008;
//	:		GOSUB II_VIN_TRN_ERRMESS
//	:	FI
//	
//		SWITCH (II_EVAL_TRANS_UNIT_ERROR +  II_EVAL_TRANS_LOCAT_ERROR = 0)
//		CASE 1; REM True
//			
//			GOSUB II_VIN_TRN_EVAL_AVAILQ
//			
//			IF  II_EVAL_AVAILQ_NOT THEN
//	:			LET II_EVAL_TRANS_GENERAL_ERROR = 1
//	:		FI
//		BREAK
//		SWEND
//	
//	REM	PRINT "ERR21:",II_EVAL_TRNTY_NOT_VALID," ERR22:",II_EVAL_TRBAL_NOT," ERR23:",II_EVAL_AVAILQ_NOT," GERR:",II_PROCESS_ERR,;INPUT *
//	
//		LET II_PROCESS_ERR = II_PROCESS_ERR + II_EVAL_TRANS_TRBAL_ERROR
//		LET II_PROCESS_ERR = II_PROCESS_ERR + II_EVAL_TRANS_GENERAL_ERROR
//	
//	REM	PRINT "General Error:",II_PROCESS_ERR,;input *
//	
//	II_VIN_TRN_EVAL_TRANS_END: RETURN














}




?>