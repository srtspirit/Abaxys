<?php

class vsl_orheFindMatch extends dbMaster
{
	function vsl_orheFindMatch($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
	}

	function dbSetTrig()
	{





$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vsl_orhe 
		LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=]
		LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_CUST_BPART  [=COND:vgb_bpar=]

		LEFT JOIN vgb_addr  ON idVGB_ADDR = VSL_ORHE_BTADD OR idVGB_ADDR = VSL_ORHE_STADD  [=COND:vgb_addr=] 
		LEFT JOIN vgb_curr  ON idVGB_CURR = VSL_ORHE_CURID  [=COND:vgb_curr=] 
		LEFT JOIN vgb_slrp  ON idVGB_SLRP = VSL_ORHE_SLSRP  [=COND:vgb_slrp=] 
		LEFT JOIN vgb_term  ON idVGB_TERM = VSL_ORHE_TERID  [=COND:vgb_term=] 
		LEFT JOIN vsl_orde  ON idVSL_ORHE = VSL_ORDE_ORNUM  [=COND:vsl_orde=] 
		LEFT JOIN vsl_orst  ON idVSL_ORDE = VSL_ORST_ORLIN  [=COND:vsl_orst=]
		
		
		LEFT JOIN vsl_orsi  ON idVSL_ORHE = VSL_ORSI_ORNUM  AND ( VSL_ORST_ACKID = idVSL_ORSI OR VSL_ORST_AOKID = idVSL_ORSI OR VSL_ORST_SCEID = idVSL_ORSI OR VSL_ORST_PICID = idVSL_ORSI OR VSL_ORST_RELID = idVSL_ORSI OR VSL_ORST_PAKID = idVSL_ORSI OR VSL_ORST_DELID = idVSL_ORSI ) [=COND:vsl_orsi=]
		LEFT JOIN vsl_lstr  ON idVSL_ORST = VSL_LSTR_STPSQ  [=COND:vsl_lstr=]
		LEFT JOIN vin_item  on idVIN_ITEM = VSL_ORDE_ITMID  [=COND:vin_item=]
								
		WHERE [=WHERE=]  [=COND:vsl_orhe=]  ORDER BY VSL_ORHE_ORNUM ASC, VSL_ORDE_ORLIN ASC, VSL_ORST_STPSQ ASC [=LIMIT=] ) tx		

		
EOD;

		return $trig;
		
	}
	
}



class vsl_orheOriginalVal extends dbMaster
{
	function vsl_orheOriginalVal($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
	}

	


	function dbSetTrig()
	{

$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vsl_orhe 
		LEFT JOIN vsl_orde  ON idVSL_ORHE = VSL_ORDE_ORNUM  [=COND:vsl_orde=] 
		LEFT JOIN vsl_orst  ON idVSL_ORDE = VSL_ORST_ORLIN  [=COND:vsl_orst=]
		LEFT JOIN vsl_lstr  ON idVSL_ORST = VSL_LSTR_STPSQ  [=COND:vsl_lstr=]
								
		WHERE [=WHERE=]  [=COND:vsl_orhe=]  ORDER BY VSL_ORHE_ORNUM ASC, VSL_ORDE_ORLIN ASC, VSL_ORST_STPSQ ASC [=LIMIT=] ) tx		

		
EOD;


		return $trig;
		
	}
	
}

class vsl_orheLstr extends dbMaster
{
	function vsl_orheLstr($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
	}

	function dbSetTrig()
	{

$this->gotTrigger="yes";

$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vsl_orhe 

		LEFT JOIN vsl_orst  ON VSL_ORST_ORNUM = idVSL_ORHE  [=COND:vsl_orst=] 
		LEFT JOIN vsl_lstr  ON VSL_LSTR_STPSQ = idVSL_ORST  [=COND:vsl_lstr=] 
								
		WHERE [=WHERE=] [=COND:vsl_orhe=]   [=LIMIT=] ) tx		

		
EOD;

		return $trig;
		
	}
	
}


class vsl_orheOrsi extends dbMaster
{
	function vsl_orheOrsi($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
	}

	function dbSetTrig()
	{



$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vsl_orhe 

		LEFT JOIN vsl_orsi  ON VSL_ORSI_ORNUM = idVSL_ORHE  [=COND:vsl_orsi=] 
								
		WHERE [=WHERE=] [=COND:vsl_orhe=]  ORDER BY VSL_ORSI_STEPS DESC  [=LIMIT=] ) tx		

		
EOD;

		return $trig;
		
	}
	
}





class vsl_orheTax extends dbMaster
{
	function vsl_orheTax($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
	}

	function dbSetTrig()
	{



$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vsl_orhe 
		LEFT JOIN vgb_addr  ON idVGB_ADDR = VSL_ORHE_STADD  [=COND:vgb_addr=] 
		LEFT JOIN vtx_schh  ON idVTX_SCHH = VGB_ADDR_SCHID  [=COND:vtx_schh=] 
		LEFT JOIN vtx_sche  ON VTX_SCHE_SCHID = idVTX_SCHH  [=COND:vtx_sche=] 
								
		WHERE [=WHERE=]  [=COND:vsl_orhe=]  [=LIMIT=] ) tx		

		
EOD;

		return $trig;
		
	}
	

}



class vsl_ItmSupport extends dbMaster
{

	function vsl_ItmSupport($schema)
	{
		// not used
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


class vsl_pickerChk extends dbMaster
{

	function vsl_pickerChk($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
		
	}


	function dbSetTrig()
	{


$trig = <<<EOD

		Local Routine intercepts dbFindMatch
		to read only orders with VSL_ORST_STEPS = GG_RELE
		after it will read vsl_order with all data from order selected
		set as support table
		
		
EOD;


		return $trig;	
	}		

	function dbFindFrom($dtaObj)
	{
		
		$this->Explain = $this->dbSetTrig();
		
 		$wTbls = new vsl_picker($this->tblInfo->schema);
		$dtaObj["MAXREC_OUT"] = 0; // No limit
	 	$dtaObj["idVSL_ORHE"] = '0'; 		
		$wTbls->dbFindFrom($dtaObj);
		$E_POST = $dtaObj;
		
		$orderList = "";
		$separator = "";

		if ($wTbls->errorCode == 0 )
		{
			
			$occ = 0;
			while ($occ < count($wTbls->result) )
			{

				$orderId = $wTbls->result[$occ]["idVSL_ORHE"];
				if (strpos("x," . $orderList . "," , "," . $orderId . "," ) < 1)
				{
					// Should this not be .= below error error error
					$orderList .= $orderId . $separator;
					$separator = ",";
				}
					
				$occ += 1;
			}
			
			$this->orderList = $orderList;
		
	  		if (strlen($orderList)>0)
	  		{
	 	 		$wTblsOrds = new vsl_orhe($this->tblInfo->schema);
	 	 		$objOrds = array();
	 	 		$objOrds["PROCESS"] = $E_POST["PROCESS"];
	 	 		$objOrds["SESSION"] = $E_POST["SESSION"];
	 	 		$objOrds["MAXREC_OUT"] = 0; // No limit
	 	 		$objOrds["idVSL_ORHE"] = '0';
	 	 		$objOrds["vsl_ppck_ords"] = $orderList;
	 	 		$wTblsOrds->dbFindFrom($objOrds);
	 	 		if (!$wTbls->dbSuppTbl)
	 	 		{
	 	 			$wTbls->dbSuppTbl = array();
	 	 		}
				$wTbls->dbSuppTbl["vsl_orhe"] = $wTblsOrds;	 	 		
	 	 	}				
	 	}
	 	 
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
				
	}

}


class vsl_picker extends dbMaster
{

	function vsl_picker($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
		
	}


	function dbSetTrig()
	{

		$localWhere = " AND VSL_ORST_STEPS = 'GG_RELE' ";

$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vsl_orhe  

		LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=]
		LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_CUST_BPART  [=COND:vgb_bpar=]
		
		LEFT JOIN vsl_orde  ON idVSL_ORHE = VSL_ORDE_ORNUM  [=COND:vsl_orde=] 
		LEFT JOIN vsl_orst  ON idVSL_ORDE = VSL_ORST_ORLIN  [=COND:vsl_orst=]
		LEFT JOIN vsl_orsi  ON idVSL_ORSI = VSL_ORST_PICID  [=COND:vsl_orsi=]
		LEFT JOIN vsl_lstr  ON idVSL_ORST = VSL_LSTR_STPSQ  [=COND:vsl_lstr=]
		LEFT JOIN vin_item  ON idVIN_ITEM = VSL_ORDE_ITMID  [=COND:vin_item=]
	
								
		WHERE [=WHERE=] {$localWhere} [=COND:vsl_orhe=]   )  tx		

		
EOD;


		return $trig;	
	}		



}



class vsl_packerChk extends dbMaster
{

	function vsl_packerChk($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
		
	}


	function dbSetTrig()
	{


$trig = <<<EOD

		Local Routine intercepts dbFindMatch
		to read only orders with VSL_ORST_STEPS = GG_RELE
		after it will read vsl_order with all data from order selected
		set as support table
		
		
EOD;


		return $trig;	
	}		

	function dbFindFrom($dtaObj)
	{
		
		$this->Explain = $this->dbSetTrig();
		
 		$wTbls = new vsl_packer($this->tblInfo->schema);
		$dtaObj["MAXREC_OUT"] = 0; // No limit
	 	$dtaObj["idVSL_ORHE"] = '0'; 		
		$wTbls->dbFindFrom($dtaObj);
		$E_POST = $dtaObj;
		
		$orderList = "";
		$separator = "";

		if ($wTbls->errorCode == 0 )
		{
			
			$occ = 0;
			while ($occ < count($wTbls->result) )
			{

				$orderId = $wTbls->result[$occ]["idVSL_ORHE"];
				if (strpos("x," . $orderList . "," , "," . $orderId . "," ) < 1)
				{
					$orderList = $orderId . $separator;
					$separator = ",";
				}
					
				$occ += 1;
			}
			
			$this->orderList = $orderList;
		
	  		if (strlen($orderList)>0)
	  		{
	 	 		$wTblsOrds = new vsl_orhe($this->tblInfo->schema);
	 	 		$objOrds = array();
	 	 		$objOrds["PROCESS"] = $E_POST["PROCESS"];
	 	 		$objOrds["SESSION"] = $E_POST["SESSION"];
	 	 		$objOrds["MAXREC_OUT"] = 0; // No limit
	 	 		$objOrds["idVSL_ORHE"] = '0';
	 	 		$objOrds["vsl_ppck_ords"] = $orderList;
	 	 		$wTblsOrds->dbFindFrom($objOrds);
	 	 		if (!$wTbls->dbSuppTbl)
	 	 		{
	 	 			$wTbls->dbSuppTbl = array();
	 	 		}
				$wTbls->dbSuppTbl["vsl_orhe"] = $wTblsOrds;	 	 		
	 	 	}				
	 	}
	 	 
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
				
	}

}

class vsl_invDoc extends dbMaster
{

	function vsl_invDoc($schema)
	{
		$this->dbMaster("vsl_orsi",$schema);
		
	}


	function dbSetTrig()
	{

		
		$localWhere = " AND VSL_ORSI_STEPS = 'JJ_INVO' ";
		if ($this->E_POST["SESSION"] == "VSL_INVOCT")
		{
			$localWhere = " AND VSL_ORSI_STEPS = 'II_DELI' ";
		}			
			
		if ($this->E_POST["vsl_invDoc"])
		{
			foreach($this->E_POST["vsl_invDoc"] as $name => $value)
			{
				if ($name=="VSL_ORSI_CDATE")
				{
					$val = explode(",",$value);
					$localWhere .= " AND " . $name . " >= '" . $val[0] . "' ";
					$localWhere .= " AND " . $name . " <= '" . $val[1] . "' ";
				}
				else
				{
					$localWhere .= " AND " . $name . " = '" . $value . "' ";
				}
			}			
			
		}


$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vsl_orsi  

		LEFT JOIN vsl_orhe  ON idVSL_ORHE = VSL_ORSI_ORNUM  [=COND:vsl_orhe=] 
		LEFT JOIN vsl_orst  ON VSL_ORST_WINVO = idVSL_ORSI  [=COND:vsl_orst=]
		LEFT JOIN vsl_orde  ON VSL_ORST_ORLIN = idVSL_ORDE  [=COND:vsl_orde=]
		LEFT JOIN vin_item  ON VSL_ORDE_ITMID = idVIN_ITEM  [=COND:vin_item=]
		LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=]
		LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_CUST_BPART  [=COND:vgb_bpar=]
								
		WHERE [=WHERE=] {$localWhere} AND idVSL_ORHE > 0 [=COND:vsl_orsi=]   )  tx		

		
EOD;

		return $trig;	
	}		



}




class vsl_packer extends dbMaster
{

	function vsl_packer($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
		
	}


	function dbSetTrig()
	{

		$localWhere = " AND VSL_ORST_STEPS = 'II_DELI' ";

$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vsl_orhe  

		LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=]
		LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_CUST_BPART  [=COND:vgb_bpar=]
		
		LEFT JOIN vsl_orde  ON idVSL_ORHE = VSL_ORDE_ORNUM  [=COND:vsl_orde=] 
		LEFT JOIN vsl_orst  ON idVSL_ORDE = VSL_ORST_ORLIN  [=COND:vsl_orst=]
		LEFT JOIN vsl_orsi  ON idVSL_ORSI = VSL_ORST_PAKID  [=COND:vsl_orsi=]
		LEFT JOIN vsl_lstr  ON idVSL_ORST = VSL_LSTR_STPSQ  [=COND:vsl_lstr=]
		LEFT JOIN vin_item  ON idVIN_ITEM = VSL_ORDE_ITMID  [=COND:vin_item=]
	
								
		WHERE [=WHERE=] {$localWhere} [=COND:vsl_orhe=]   )  tx		

		
EOD;


		return $trig;	
	}		



}



class vsl_userVariance extends dbMaster
{

	function vsl_userVariance($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
		
	}


	function dbSetTrig()
	{

		$localWhere = " AND VSL_ORST_STEPS < 'II_DELI' ";

$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vsl_orhe  

		LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=]
		LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_CUST_BPART  [=COND:vgb_bpar=]

		LEFT JOIN vgb_addr  ON idVGB_ADDR = VSL_ORHE_BTADD OR idVGB_ADDR = VSL_ORHE_STADD  [=COND:vgb_addr=] 
		LEFT JOIN vgb_curr  ON idVGB_CURR = VSL_ORHE_CURID  [=COND:vgb_curr=] 
		LEFT JOIN vgb_slrp  ON idVGB_SLRP = VSL_ORHE_SLSRP  [=COND:vgb_slrp=] 
		LEFT JOIN vgb_term  ON idVGB_TERM = VSL_ORHE_TERID  [=COND:vgb_term=] 
		
		LEFT JOIN vsl_orde  ON idVSL_ORHE = VSL_ORDE_ORNUM  [=COND:vsl_orde=] 
		LEFT JOIN vsl_orst  ON idVSL_ORDE = VSL_ORST_ORLIN  [=COND:vsl_orst=]
		LEFT JOIN vin_item  ON idVIN_ITEM = VSL_ORDE_ITMID  [=COND:vin_item=]
	
								
		WHERE [=WHERE=] {$localWhere} [=COND:vsl_orhe=]   )  tx		

		
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
		$this->dbSuppTbl["vsl_users_process"] = $wTbls;
		$proc = $wTbls->result[0]["CFG_PROCESS_ID"];

		$pObj["CFG_SESSION_CODE"] = $pObj["SESSION"];
		$wTbls = new dbMaster("cfg_session",$this->tblInfo->schema);
		$wTbls->dbFindMatch($pObj);
		$this->dbSuppTbl["vsl_users_session"] = $wTbls;
		$sess = $wTbls->result[0]["CFG_SESSION_ID"];
		
		$pObj["CFG_GRPCONFIG_PROCESS"] = $proc;
		$pObj["CFG_GRPCONFIG_SESSION"] = $sess;
		$wTbls = new dbMaster("cfg_grpconfig",$this->tblInfo->schema);
		$wTbls->dbFindMatch($pObj);
		$this->dbSuppTbl["vsl_users_config"] = $wTbls;
		
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
		$this->dbSuppTbl["vsl_users_group"] = $wTbls;
		
		
		$occ = 0;
		
		

$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM cfg_users  
		
								
		WHERE [=WHERE=]  AND {$localWhere}  [=COND:cfg_users=] ORDER BY CFG_USERS_DESIGNATION ASC  [=LIMIT=] )  tx		

		
EOD;


		return $trig;		
		
	}
	
	
}


class vsl_orhe extends dbMaster
{

	function vsl_orhe($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}


	function dbSetTrig()
	{


		if ($this->E_POST["vsl_ppck_ords"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["vsl_ppck_ords"]);
			if(count($wClause)>0)
			{
				$localWhere = " ( ";
				$orVal = "";
				$occ = 0;
				while ($occ < count($wClause))
				{
					$localWhere .= $orVal . "idVSL_ORHE = '" . $wClause[$occ] . "' ";
					$orVal = " OR  ";
					$occ += 1;
				} 

				$localWhere .= " ) AND ";

			}

		}
		
		$this->localWhere = $localWhere;

		$orderCondition = "";
		if ($this->E_POST["vsl_orheHasStepsCurrent"] == "1")
		{
			$orderCondition = " ( ( VSL_ORST_STEPS < 'JJ_X' ) OR idVSL_ORDE IS NULL ) AND ";
		}



$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vsl_orhe  
		LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=]
		LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_CUST_BPART  [=COND:vgb_bpar=]
		LEFT JOIN vgb_addr  ON idVGB_ADDR = VSL_ORHE_BTADD OR idVGB_ADDR = VSL_ORHE_STADD  [=COND:vgb_addr=] 
		LEFT JOIN vgb_curr  ON idVGB_CURR = VSL_ORHE_CURID  [=COND:vgb_curr=] 
		LEFT JOIN vgb_slrp  ON idVGB_SLRP = VSL_ORHE_SLSRP  [=COND:vgb_slrp=] 
		LEFT JOIN vgb_term  ON idVGB_TERM = VSL_ORHE_TERID  [=COND:vgb_term=] 
		LEFT JOIN vsl_orde  ON idVSL_ORHE = VSL_ORDE_ORNUM  [=COND:vsl_orde=] 
		LEFT JOIN vsl_orst  ON idVSL_ORDE = VSL_ORST_ORLIN  [=COND:vsl_orst=]
		
		LEFT JOIN vin_item  ON idVIN_ITEM = VSL_ORDE_ITMID  [=COND:vin_item=]
		
		
								
		WHERE {$localWhere} {$orderCondition} [=WHERE=]  [=COND:vsl_orhe=] ORDER BY VSL_ORHE_CDATE DESC, VSL_ORDE_ORLIN ASC, VSL_ORST_STPSQ ASC   [=LIMIT=] )  tx		

		
EOD;






		return $trig;
		
	}

	
	function dbFindMatch($dtaObj)
	{
  		
  		$this->fffff = "ALAIN";
  		
  		$wTbls = new vsl_orheFindMatch($this->tblInfo->schema);
		$wTbls->dbFindMatch($dtaObj);
		
		$E_POST = $dtaObj;
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		if ($wTbls->errorCode == 0 && $E_POST["PROCESS"] == "VSL_ORDERS" && $E_POST["SESSION"] == "VSL_ORHECT")
		{
			if(count($wTbls->result) > 0)
			{
				
				$occ = 0;
				while ($occ < 10)
				{
					$newRec = $wTbls->result[0];
					$newRec["idVSL_ORDE"] = 0;
					$newRec["VSL_ORDE_ORLIN"] = ($occ+1) * -1;
					$newRec["idVSL_ORST"] = ($occ+1) * -1;
					$newRec["VSL_ORST_ORLIN"] = 0;
					$newRec["VSL_ORST_STPSQ"] = 10;
					$wTbls->result[count($wTbls->result)] = $newRec;
					$occ += 1;
				}
			}
		}
		
		// Set order Step status
		$wTbls->dbFnct = 'localdbFindMatch';
		$wTbls->dbEVAL= $this->IV_VSL_STEP_EVAL($wTbls->result[0]["VSL_ORHE_ORSTP"],$wTbls->result);

		$occ = 0;
		while ($occ < count($wTbls->result))
		{
			$wTbls->result[$occ]["IV_VSL_STEPS_VALID"] = $wTbls->dbEVAL[0]["OrderStatus"]["IV_VSL_STEPS_VALID"] ;
			
			$occ += 1;
		}

//		if (!$wTbls->dbSuppTbl)
//		{
//			$wTbls->dbSuppTbl = array();
//		}
//				
//		$wTblsTax = new vsl_orheTax($this->tblInfo->schema);
//		$wTblsTax->dbFindFrom($dtaObj);
//		$wTbls->dbSuppTbl["vsl_orheTax"] = $wTblsTax;
//		
//		$wTblsLstr = new vsl_orheLstr($this->tblInfo->schema);
//		$wTblsLstr->dbFindFrom($dtaObj);
//		$wTbls->dbSuppTbl["vsl_orheLSTR"] = $wTblsLstr;
		
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
			if(!$this->OriginalData["vsl_orhe"][$this->orstOrg[$occ]["idVSL_ORHE"]] )
			{
				$this->OriginalData["vsl_orhe"][$this->orstOrg[$occ]["idVSL_ORHE"]] = $this->extractTableField("VSL_ORHE",$this->orstOrg[$occ]);
			}
			
			if(!$this->OriginalData["vsl_orde"][$this->orstOrg[$occ]["idVSL_ORDE"]])
			{
				$this->OriginalData["vsl_orde"][$this->orstOrg[$occ]["idVSL_ORDE"]] = $this->extractTableField("VSL_ORDE",$this->orstOrg[$occ]);
			}
			
			if(!$this->OriginalData["vsl_orst"][$this->orstOrg[$occ]["idVSL_ORST"]])
			{
				$this->OriginalData["vsl_orst"][$this->orstOrg[$occ]["idVSL_ORST"]] = $this->extractTableField("VSL_ORST",$this->orstOrg[$occ]);
			}
			
			if($this->orstOrg[$occ]["idVSL_LSTR"]  && !$this->OriginalData["vsl_lstr"][$this->orstOrg[$occ]["idVSL_ORST"]."-".$this->orstOrg[$occ]["idVSL_LSTR"]])
			{
				$this->OriginalData["vsl_lstr"][$this->orstOrg[$occ]["idVSL_ORST"]."-".$this->orstOrg[$occ]["idVSL_LSTR"]] = $this->extractTableField("VSL_LSTR",$this->orstOrg[$occ]);
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
		
		$this->validChangeFields = array(); 
		// This will be used to know what fields were changed. 
		// Specificly VSL_ORDE_ORDQT because modification of this field will be allowed for Completed lines.
		
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
		
		$dtaObj["VSL_ORHE_USLNA"] = $cUser["userCode"];
		
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

		if ($dtaObj["VSL_ORHE_ODATE"] == '')
		{
			$dtaObj["VSL_ORHE_ODATE"] = $this->getDateFormed();
			$E_POST["VSL_ORHE_ODATE"] = $dtaObj["VSL_ORHE_ODATE"];
		}

		
		$nfnu = new vgb_getNextFreeNumber($this->tblInfo->schema,"VSL_ORHE" ,$this->E_POST,$this->masterTranConn);
		$dtaObj["VSL_ORHE_ORNUM"] = $nfnu->vgb_nextNumber;

	  	$wTbls = new dbMaster("vsl_orhe",$this->tblInfo->schema);
	  	
	  	$wTbls->brTrConn = $this->masterTranConn;
	  	if ($dtaObj["idVSL_ORHE"] == '0')
	  	{
	  		$dtaObj["idVSL_ORHE"] = '';
	  	}
		
		$dtaObj["VSL_ORHE_ORSTP"] = $this->AB_CPARM["VSL_STEPS_SC"]["DFLT"];
	  		
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
			$this->dbPdoEndTransac(false);
			$this->errorCode =+ 3000;
			// $this->rowCount = 0;
			$this->result = array();	
			$this->errorCodeText[count($this->errorCodeText)] = "Insert Transaction Aborted ";
			$this->dbFnct = "dbInsRec";
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
		if ($dtaObj["VSL_INVOICE"] == "vsl_invoice")
		{
			$this->localPost = $dtaObj;
	 		$wTblsInvoice = new vsl_invoice($this->tblInfo->schema);
	  		$wTblsInvoice->dbUpdRec($dtaObj);
			foreach($wTblsInvoice as $name => $value)
			{
				 $this->$name = $value;
			}
			return;			
		}
		
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
		
		// AC 20170613 New logic Credit hold
		// if customer on credit hold set order on credit hold
		$custObj = array();
		$custObj["PROCESS"] = $dtaObj["PROCESS"];
		$custObj["SESSION"] = $dtaObj["SESSION"];
		$custObj["idVGB_CUST"] = $dtaObj["VSL_ORHE_BTCUS"];		
		$cust = new dbMaster("vgb_cust",$this->tblInfo->schema);
		$cust->dbFindMatch($custObj);
		if ($cust->errorCode > 0 || count($cust->result) == 0)
		{
			$this->errorCode = 6677;
			$this->errorCodeText[count($this->errorCodeText)] = "6677 - Customer not found ";
		}
		else
		{
			if ($cust->result[0]["VGB_CUST_CRHOL"] == 1 && $dtaObj["VSL_ORHE_CRHOL"] != 1)
			{
				$dtaObj["VSL_ORHE_CRHOL"] = 1;
				$this->errorCodeText[count($this->errorCodeText)] = "8976 - Order has been set on credit hold ";
			}
		}		
			
		$E_POST = $dtaObj;
		// $E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		$this->E_POST = $E_POST;
		$this->local_POST = $E_POST;

		// We need a current record list of all VSL_ORST 
		$tmpObj["PROCESS"] = $E_POST["PROCESS"];
		$tmpObj["SESSION"] = $E_POST["SESSION"];
		$tmpObj["TBLNAME"] = "vsl_orhe";			
		$tmpObj["idVSL_ORHE"] = $dtaObj["idVSL_ORHE"];  		
  		$orstOrg = new vsl_orheOriginalVal($this->tblInfo->schema);
		$orstOrg->dbFindMatch($tmpObj);
		

		
		
		$this->orstOrg = $orstOrg->result;
		
		$this->groupObjById();
		$wTbls = array();

		$this->validChange = "";
		
		// Simple post for new Document step advance
		$this->setNewDocument = $E_POST["DOC_STEPS"]; // step
		$this->setDocOrst = $E_POST["DOC_ORST"]; // orst list
		$this->setDocOrsi = array(); // [steps] = id
		
$this->VSL_ORHE_ODATE = ($dtaObj["VSL_ORHE_ODATE"]!=""?"Has":"Not");

		if ($dtaObj["VSL_ORHE_ODATE"] == '')
		{
			$dtaObj["VSL_ORHE_ODATE"] = $this->getDateFormed();
			$E_POST["VSL_ORHE_ODATE"] = $dtaObj["VSL_ORHE_ODATE"];
		}

$this->VSL_ORHE_ODATE .= $dtaObj["VSL_ORHE_ODATE"];
 		
//		if ($this->objAreEqual($E_POST,"vsl_orhe","idVSL_ORHE") != true)
//  		{
  			$this->headerUpd = $dtaObj;
	  		$wTbls[0] = new dbMaster("vsl_orhe",$this->tblInfo->schema);
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
		
			
		
		
		// AC 20170613 New logic Credit hold advance to PACK or beyond not valid
		if ($this->setNewDocument >= "HH_PACK" && $E_POST["VSL_ORHE_CRHOL"] == "1")
		{
			$this->errorCode = 8977;
			$this->errorCodeText[count($this->errorCodeText)] = "8977 - Customer on credit hold ";
			$this->errorCodeText[count($this->errorCodeText)] = "........ Cannot advance beyond " . $this->AB_CPARM["VSL_STEPS_DESCR"]["GG_RELE"];
			$this->dbFnct = "dbUpdRec";

			return;
		}
						
		
		while ($occ < count($recSet) && $lotValid == true)
		{
			if ($recSet[$occ]["idVSL_ORDE"] || $this->isNewId($recSet[$occ]["idVSL_ORDE"]) )
			{
				if ($recSet[$occ]["VIN_ITEM_LOTCT"] && $recSet[$occ]["VIN_ITEM_LOTCT"] >0 )
				{
					$lotValid = $this->validateVSL_LSTR($recSet[$occ]);
					$this->lotValid = $lotValid;
					// lot Item
				}
				$recSet[$occ]["lotValid"] = $lotValid;
				if($lotValid == false)
				{
					$this->errorCode = "9902";
					
					$orlin=$recSet[$occ]["VSL_ORDE_ORLIN"];
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
			
			
			if ($recSet[$occ]["idVSL_ORDE"] || $this->isNewId($recSet[$occ]["idVSL_ORDE"]) )
			{
				$dbCount = count($wTbls);
				$recSet[$occ]["PROCESS"] = $E_POST["PROCESS"];
				$recSet[$occ]["SESSION"] = $E_POST["SESSION"];
				$recSet[$occ]["TBLNAME"] = "vsl_orde";			
				
				if ($recSet[$occ]["VSL_ORDE_DDATE"] == '')
				{
					$theDay = $this->getDateFormed();
					if ($dtaObj["VSL_ORHE_ODATE"] < $theDay)
					{
						$recSet[$occ]["VSL_ORDE_DDATE"] = $theDay;
					}
					else
					{
						$recSet[$occ]["VSL_ORDE_DDATE"] = $dtaObj["VSL_ORHE_ODATE"];
					}
					
					
				}

				
				$this->recSetPost[$occ] = $recSet[$occ];
				
				// $recSet[$occ] = $this->setDfltVSL_ORDE($recSet[$occ]);
				
				if ( $this->isNewId($recSet[$occ]["idVSL_ORDE"]) || $recSet[$occ]["ab-new"] == 1)
				{
					
					if ($recSet[$occ]["trash"] == 1)
					{
						// Nothing;
					}
					else
					{
				  		$wTbls[$dbCount] = new dbMaster("vsl_orde",$this->tblInfo->schema);
				  		$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				  		$recSet[$occ] = $this->setDfltVSL_ORDE($recSet[$occ]);
				  		$this->defaultVSL_ORDE = $recSet[$occ];
				  		
						$wTbls[$dbCount]->dbInsRec($recSet[$occ]);
						$this->errorCode += $wTbls[$dbCount]->errorCode;
						
						$recSet[$occ]["idVSL_ORDE"] = $wTbls[$dbCount]->insertId;
						$this->recSetPost[$occ]["idVSL_ORDE"] = $recSet[$occ]["idVSL_ORDE"];
						
						$subwTbls = $this->insertVSL_ORST($recSet[$occ],$subwTbls,$occ);
						
						$tmpObj = $recSet[$occ];
						$tmpObj["VIN_CUST_BPART"] = $E_POST["VSL_ORHE_BTCUS"];	
						$tmpObj["VIN_CUST_ITMID"] = $tmpObj["VSL_ORDE_ITMID"];
						if ($this->setNewDocument > "JJ_INVO")
						{ 	
							$tmpObj["VIN_CUST_LPPAID"] = $tmpObj["VSL_ORDE_OUNET"];	
							$tmpObj["VIN_CUST_LPDATE"] = $this->getDateFormed();
						}
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
						$subwTbls = $this->deleteVSL_ORST($recSet[$occ],$subwTbls,$occ);
				  		$wTbls[$dbCount] = new dbMaster("vsl_orde",$this->tblInfo->schema);
				  		$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
						$wTbls[$dbCount]->dbDelRec($recSet[$occ]);
						$this->errorCode += $wTbls[$dbCount]->errorCode;
						

					}
					else
					{
				  		$wTbls[$dbCount] = new dbMaster("vsl_orde",$this->tblInfo->schema);
				  		$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
						if ($this->objAreEqual($recSet[$occ],"vsl_orde","idVSL_ORDE") != true)
				  		{	
				  			if ($this->hasCompletedSteps($recSet[$occ]) == true && implode($this->validChangeFields) != "VSL_ORDE_ORDQT" )
				  			{
				  				$this->errorCode += 99;
				  				$this->errorCodeText[count($this->errorCodeText)] = "Error 99 - Line cannot be modified (Has invoiced steps";
				  			}
				  			else
				  			{
								$wTbls[$dbCount]->dbUpdRec($recSet[$occ]);
								$this->errorCode += $wTbls[$dbCount]->errorCode;
	
								$tmpObj = $recSet[$occ];
								$tmpObj["VIN_CUST_BPART"] = $E_POST["VSL_ORHE_BTCUS"];	
								$tmpObj["VIN_CUST_ITMID"] = $tmpObj["VSL_ORDE_ITMID"];	
								if ($this->setNewDocument > "JJ_INVO")
								{ 	
									$tmpObj["VIN_CUST_LPPAID"] = $tmpObj["VSL_ORDE_OUNET"];	
									$tmpObj["VIN_CUST_LPDATE"] = $this->getDateFormed();
								}
								$wT = new vin_cust($this->tblInfo->schema);
								$wT->brTrConn = $this->masterTranConn;
								$wT->vin_cust_lastPrice($tmpObj);
								$wTbls[$dbCount]->vin_cust = $wT;
							}
							
						}
						
						
						$subwTbls = $this->updateVSL_ORST($recSet[$occ],$subwTbls,$occ);
						
					}
				}
				 
				$lotUpdate = array();
				
				if ($recSet[$occ]["VIN_ITEM_LOTCT"] >0 )
				{
					
					$lotUpdate = $this->updateVSL_LSTR($this->recSetPost[$occ]);
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
		$wTbls[$dbCount]->TV_VIN_TRN_PROCESS("vsl_orhe",$this->InventoryUpdRec);
		
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
		$this->allocationQtys = $wTbls[$dbCount]->allocationQtys;
		
		$errOcc = 0;
		while ($errOcc < count($this->allocationQtys))
		{
			$this->errorCodeText[count($this->errorCodeText)] = $this->allocationQtys[$errOcc];
			$errOcc += 1;
		}
			
		
		if ($this->errorCode == 0)
		{
			// try to remove vsl_orsi records
			// if permitted it is because nothing is attached
			$this->cleanOrsiData($this->local_POST["idVSL_ORHE"],$this->masterTranConn);
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
			if ($recSet[$occ]["VSL_ORST_STEPS"] > "JJ_INVO")
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
		
		if ($ePost["SESSION"] != "VSL_PICKER" && $ePost["SESSION"] != "VSL_PACKER" )
		{
			return $wTbls;
		}
		
		$ePost["VSL_ORSI_PDATE"] =  $this->getDateFormed();
  		$wTbls = new dbMaster("vsl_orsi",$this->tblInfo->schema);
  		$wTbls->brTrConn = $trCon;
		$wTbls->dbUpdRec($ePost);		
		
		return $wTbls;
	}
	
	function cleanOrsiData($id,$trCon)
	{
	  	$wTbls = new dbMaster("vsl_orsi",$this->tblInfo->schema);
	  	$wTbls->brTrConn = $trCon;
	  	
	  	$obj = array();
		$obj["PROCESS"] = $this->processId;
		$obj["SESSION"] = $this->sessionId;
		$obj["TBLNAME"] = "vsl_orsi";
		


	  	$obj["VSL_ORSI_ORNUM"] = $id;
		$wTbls->dbFindMatch($obj);
		$this->delAll = $wTbls->result;
		$this->delRset = array();
		
		$occ = 0;
		while ($occ < count($wTbls->result))
		{
			$wrec = $wTbls->result[$occ];
		  	$wwTbls = new dbMaster("vsl_orsi",$this->tblInfo->schema);
		  	$wwTbls->brTrConn = $trCon;
		  	
		  	$wobj = array();
			$wobj["PROCESS"] = $this->processId;
			$wobj["SESSION"] = $this->sessionId;
			$wobj["TBLNAME"] = "vsl_orsi";

		  	$wobj["idVSL_ORSI"] = $wrec["idVSL_ORSI"];
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
	
	
	function setDfltVSL_ORDE($dtaObj)
	{
  		$dtaObj["VSL_ORDE_ORNUM"] = $this->local_POST["idVSL_ORHE"];
  		
  		if ($dtaObj["idVSL_ORDE"] < 1)
  		{
  			$dtaObj["idVSL_ORDE"] = "";
  		}

		if (!$dtaObj["VSL_ORDE_BTCUS"] || $dtaObj["VSL_ORDE_BTCUS"] == "" ) 
		{
			$dtaObj["VSL_ORDE_BTCUS"] = $this->local_POST["VSL_ORHE_BTCUS"];
			$dtaObj["VSL_ORDE_STCUS"] = $this->local_POST["VSL_ORHE_STCUS"];
			$dtaObj["VSL_ORDE_BTADD"] = $this->local_POST["VSL_ORHE_BTADD"];
			$dtaObj["VSL_ORDE_STADD"] = $this->local_POST["VSL_ORHE_STADD"];

			$dtaObj["VSL_ORDE_SLSRP"] = $this->local_POST["VSL_ORHE_SLSRP"];
			$dtaObj["VSL_ORDE_TERID"] = $this->local_POST["VSL_ORHE_TERID"];

		}

		if (!$dtaObj["VSL_ORDE_WARID"] || $dtaObj["VSL_ORDE_WARID"] == "")
		{
			if ($dtaObj["VSL_ORDE_ITMID"] && $dtaObj["VSL_ORDE_ITMID"] > 0)
			{
				$tmpObj = array();
				
				$tmpObj["PROCESS"] = "VIN_ITEMS";
				$tmpObj["SESSION"] = "VIN_ITEMS";
				$tmpObj["TBLNAME"] = "vin_item";			
				
				$tmpObj["idVIN_ITEM"] = $dtaObj["VSL_ORDE_ITMID"];
				
		  		$wItem = new dbMaster("vin_item",$this->tblInfo->schema);
				$wItem->dbFindMatch($tmpObj);

				$warObj = array();
				$warObj["PROCESS"] = "VIN_ITEMS";
				$warObj["SESSION"] = "VIN_ITEMS";
				$warObj["TBLNAME"] = "vin_wars";
				
				// $warObj["idVIN_WARS"] = 0;
				$warObj["idVIN_WARS"] = "0";
				
				$wWars = new dbMaster("vin_wars",$this->tblInfo->schema);
				$wWars->dbFindFrom($warObj);
				$this->wWars = $wWars;
								
				$occ = 0;
				while ($occ < count($wWars->result))
				{
					if ($occ == 0 )
					{
						$dtaObj["VSL_ORDE_WARID"] = $wWars->result[$occ]["idVIN_WARS"];
						$dtaObj["VSL_ORDE_LOCID"] = $wWars->result[$occ]["VIN_WARS_MALOC"];
						// if no records set to default will use first
					}
					if ($wWars->result[$occ]["VIN_WARS_SFWAR"] == "1")
					{
						$dtaObj["VSL_ORDE_WARID"] = $wWars->result[$occ]["idVIN_WARS"];
						$dtaObj["VSL_ORDE_LOCID"] = $wWars->result[$occ]["VIN_WARS_MALOC"];
						$occ = count($wWars->result);
						
						// if record set to default will use this and stop looping
					}
					
					$occ += 1;
				}
								
			}
			
		}
		
		if (!$dtaObj["VSL_ORDE_LOCID"] || $dtaObj["VSL_ORDE_LOCID"] == "")
		{
			if ($dtaObj["VSL_ORDE_WARID"] && $dtaObj["VSL_ORDE_WARID"] > 0)
			{
				$tmpObj = array();
				
				$tmpObj["PROCESS"] = "VIN_ITEMS";
				$tmpObj["SESSION"] = "VIN_ITEMS";
				$tmpObj["TBLNAME"] = "vin_wars";			
				
				$tmpObj["idVIN_WARS"] = $dtaObj["VSL_ORDE_WARID"];
				
		  		$wItem = new dbMaster("vin_wars",$this->tblInfo->schema);
				$wItem->dbFindMatch($tmpObj);
				if (count($wItem->result) > 0 )
				{
					$dtaObj["VSL_ORDE_LOCID"] = $wItem->result[0]["VIN_WARS_MALOC"];
				}
				
			}
			
		}						

		return $dtaObj;
	}
	
		
	function insertVSL_ORST($dtaObj,$sTbls,$seq)
	{
	
		$wTbls = $sTbls;	
		
		$recSet = $dtaObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet))
		{
			
			
			if ($recSet[$occ]["trash"] != 1  && $recSet[$occ]["VSL_ORST_STPSQ"] > 0)
			{
				
				$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
				$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
				$recSet[$occ]["TBLNAME"] = "vsl_orst";			
				$recSet[$occ]["idVIN_ITEM"] = $dtaObj["VSL_ORDE_ITMID"];
				
				
				if ($recSet[$occ]["VSL_ORST_PDATE"] == '')
				{
					$theDay = $this->getDateFormed();
					if ($dtaObj["VSL_ORDE_DDATE"] < $theDay)
					{
						$recSet[$occ]["VSL_ORST_PDATE"] = $theDay;
					}
					else
					{
						$recSet[$occ]["VSL_ORST_PDATE"] = $dtaObj["VSL_ORDE_DDATE"];
					}
					
					
				}
				
			
				// New record may not have documents numbers
				$recSet[$occ] = $this->IV_VSL_initStepIdFields($recSet[$occ]);
				
				$recSet[$occ]["idVSL_ORST"] = "";				
				$recSet[$occ]["VSL_ORST_ORNUM"] = $dtaObj["idVSL_ORHE"];
				$recSet[$occ]["VSL_ORST_ORLIN"] = $dtaObj["idVSL_ORDE"];
				$recSet[$occ]["VSL_ORST_STEPS"] = $this->IV_VSL_FIRST_STEP("",$this->fetchResult[0]);
				$recSet[$occ]["VSL_ORST_WARID"] = $dtaObj["VSL_ORDE_WARID"];
				$recSet[$occ]["VSL_ORST_LOCID"] = $dtaObj["VSL_ORDE_LOCID"];

	  			if ($recSet[$occ]["VSL_ORST_ORDQT"] == 0)
	  			{
	  				$this->errorCode += 200;
	  				$this->errorCodeText[count($this->errorCodeText)] = "Cannot create zero order quantity";
	  			}

				$dbCount = count($wTbls);
				$wTbls[$dbCount] = new dbMaster("vsl_orst",$this->tblInfo->schema);
				$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				$wTbls[$dbCount]->dbInsRec($recSet[$occ]);
				$this->errorCode += $wTbls[$dbCount]->errorCode;
				
				$recSet[$occ]["idVSL_ORST"] = $wTbls[$dbCount]->insertId;				
				
				$this->setItemQtyAdj($recSet[$occ]);
			}
			
			$occ += 1;
			
		}
		$this->recSetPost[$seq]["RECSET"] = $recSet;
		return $wTbls;
		
	}
	
	
	function deleteVSL_ORST($dtaObj,$sTbls,$seq)
	{
	
		$wTbls = $sTbls;	
		
		$recSet = $dtaObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet) && $this->errorCode == 0)
		{
			
			$dbCount = count($wTbls);
			
			if ($recSet[$occ]["idVSL_ORST"] > 0 && $recSet[$occ]["VSL_ORST_STEPS"] < "JJ_X" )
			{
				$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
				$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
				$recSet[$occ]["TBLNAME"] = "vsl_orst";
				$recSet[$occ]["idVIN_ITEM"] = $dtaObj["VSL_ORDE_ITMID"];
				
				$wTbls[$dbCount] = new dbMaster("vsl_orst",$this->tblInfo->schema);
				$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				$wTbls[$dbCount]->dbDelRec($recSet[$occ]);
				$this->errorCode += $wTbls[$dbCount]->errorCode;

				$recSet[$occ]["VSL_ORST_ORDQT"] = 0;
				$recSet[$occ]["lotSel"] = "";
							
				$this->setItemQtyAdj($recSet[$occ]);

				
			}
			else
			{
				if ($recSet[$occ]["VSL_ORST_STEPS"] > "JJ_INVO" )
				{
					$this->errorCode += 99;
					$this->errorCodeText[count($this->errorCodeText)] = "error 99 : Sales step has been invoiced - cannot be deleted";
				}
			}
			
			$occ += 1;
			
		}
		$this->recSetPost[$seq]["RECSET"] = $recSet;
		return $wTbls;
		
	}	

	function deleteVSL_LSTR($dtaObj,$sTbls)
	{
	// lotSel
		$wTbls = $sTbls;	
		
		$recSet = $dtaObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet))
		{
			
			$dbCount = count($wTbls);
			
			if ($recSet[$occ]["idVSL_ORST"] > 0 )
			{
				$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
				$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
				$recSet[$occ]["TBLNAME"] = "vsl_orst"; // ??? This may be an error;
				$recSet[$occ]["idVIN_ITEM"] = $dtaObj["VSL_ORDE_ITMID"];
				
				$wTbls[$dbCount] = new dbMaster("vsl_lstr",$this->tblInfo->schema);
				$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				$wTbls[$dbCount]->dbDelRec($recSet[$occ]);		
				$this->errorCode += $wTbls[$dbCount]->errorCode;

				$recSet[$occ]["VSL_ORST_ORDQT"] = 0;			
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
			$retObj["LOTQT"] = 0;//$dtaObj["VSL_ORST_ORDQT"];
		}
			
		// BOHQT Beyond II_DELI
		if ($dtaObj["VSL_ORST_STEPS"] > "II_DELI")
		{
			// return $dtaObj["VSL_ORST_ORDQT"];
			$retObj["BOHQT"] = $dtaObj["VSL_ORST_ORDQT"];
		}

		// ALOQT includes II_DELI & GG_RELE
		if ($dtaObj["VSL_ORST_STEPS"] < "II_DELx" && $dtaObj["VSL_ORST_STEPS"] >"GG_REL" )
		{
			// return $dtaObj["VSL_ORST_ORDQT"];
			$retObj["ALOQT"] = $dtaObj["VSL_ORST_ORDQT"] * -1;
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

		if(!$this->OriginalData["vsl_orst"][$dtaObj["idVSL_ORST"]])
		{ 
			$this->OriginalData["vsl_orst"][$dtaObj["idVSL_ORST"]]["VSL_ORST_ORDQT"] = 0;
			$this->OriginalData["vsl_orst"][$dtaObj["idVSL_ORST"]]["VSL_ORST_STEPS"] = "";
		}
		
		$orgORST = $this->OriginalData["vsl_orst"][$dtaObj["idVSL_ORST"]];
		
		$orgQtySgn = 1;
		if ($orgORST["VSL_ORST_ORDQT"] < 0)
		{
			$ordQtySgn = -1;
		}		
		
		$qtySgn = 1;
		if ($dtaObj["VSL_ORST_ORDQT"] < 0)
		{
			$qtySgn = -1;
		}		

		$newUpdObj = array();
		$newLotSel = explode(",",$dtaObj["lotSel"]);
		
		$orgRec = $this->OriginalData["vsl_lstr"];
		if (count($orgRec)>0)
		{
			foreach($orgRec as $name => $value)
			{
				if (strpos( "xx" . $name,$dtaObj["idVSL_ORST"] . "-" ) > 0 )
				{
					if ($value["VSL_LSTR_LOTSQ"] > 0 && $value["VSL_LSTR_ALOQT"] != 0 )
					{
						$newUpdObj[$value["VSL_LSTR_LOTSQ"]]["orgQT"] = abs($value["VSL_LSTR_ALOQT"]) * $orgQtySgn;	
						$newUpdObj[$value["VSL_LSTR_LOTSQ"]]["newQT"] = 0;
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
				$orgORST["VSL_ORST_ORDQT"] = $value["orgQT"];
				$qtyOrg = $this->setInventoryQty($orgORST);
				$workObj["VSL_ORST_ORDQT"] = $value["newQT"];
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
					
					$rowRec["idVIN_WARS"] = $dtaObj["VSL_ORST_WARID"];
					$rowRec["idVIN_LOCS"] = $dtaObj["VSL_ORST_LOCID"];
					
					$rowRec["idVIN_LSHE"] = $lotId;
					// Will need to provide multiple lot selections per ORST record
					
					$rowRec["idVIN_UNIT"] = $dtaObj["VSL_ORST_QTUOM"];
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
		
		
		if(!$this->OriginalData["vsl_orst"][$dtaObj["idVSL_ORST"]])
		{ 
			$this->OriginalData["vsl_orst"][$dtaObj["idVSL_ORST"]]["VSL_ORST_ORDQT"] = 0;
			$this->OriginalData["vsl_orst"][$dtaObj["idVSL_ORST"]]["VSL_ORST_STEPS"] = "";
		}
		
		$orgRec = $this->OriginalData["vsl_orst"][$dtaObj["idVSL_ORST"]];
		
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
			
			$rowRec["idVIN_WARS"] = $dtaObj["VSL_ORST_WARID"];
			$rowRec["idVIN_LOCS"] = $dtaObj["VSL_ORST_LOCID"];
			
			$rowRec["idVIN_LSHE"] = $dtaObj["lotSel"];
			// Will need to provide multiple lot selections per ORST record
			
			$rowRec["idVIN_UNIT"] = $dtaObj["VSL_ORST_QTUOM"];
			$this->InventoryUpdRec[$rNum] = $rowRec;
		}
		
		
		
		
		
				
	}
	
	function updateVSL_ORST($dtaObj,$sTbls,$seq)
	{
	
		$wTbls = $sTbls;	
		$dbCount = count($wTbls);
		
		// Last price paid
		$tmpObj = $dtaObj;
		$tmpObj["VIN_CUST_BPART"] = $this->local_POST ["VSL_ORHE_BTCUS"];	
		$tmpObj["VIN_CUST_ITMID"] = $tmpObj["VSL_ORDE_ITMID"];	
		if ($this->setNewDocument > "JJ_INVO")
		{ 	
			$tmpObj["VIN_CUST_LPPAID"] = $tmpObj["VSL_ORDE_OUNET"];	
			$tmpObj["VIN_CUST_LPDATE"] = $this->getDateFormed();
		}
		$wT = new vin_cust($this->tblInfo->schema);
		$wT->brTrConn = $this->masterTranConn;
		$wT->vin_cust_lastPrice($tmpObj);
		$wTbls[$dbCount]->vin_cust = $wT;
		
		
		$recSet = $dtaObj["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet) && $this->errorCode == 0)
		{
			$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
			$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
			$recSet[$occ]["TBLNAME"] = "vsl_orst";	
			$recSet[$occ]["idVIN_ITEM"] = $dtaObj["VSL_ORDE_ITMID"];
			$recSet[$occ]["VIN_ITEM_LOTCT"] = $dtaObj["VIN_ITEM_LOTCT"];
			
			$recSet[$occ]["VSL_ORST_WARID"] = $dtaObj["VSL_ORDE_WARID"];
			$recSet[$occ]["VSL_ORST_LOCID"] = $dtaObj["VSL_ORDE_LOCID"];
			$recSet[$occ]["VSL_ORST_QTUOM"] = $dtaObj["VSL_ORDE_SAUOM"];
			$recSet[$occ]["VSL_ORST_FACTO"] = $dtaObj["VSL_ORDE_FACTO"];
					
			$dbCount = count($wTbls);
			
			
			if ($recSet[$occ]["trash"] != 1)
			{
				$wTbls[$dbCount] = new dbMaster("vsl_orst",$this->tblInfo->schema);
				$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
				
				
				if ($recSet[$occ]["idVSL_ORST"] > 0 )
				{
					

					if ($recSet[$occ]["VSL_ORST_PDATE"] == '')
					{
						$theDay = $this->getDateFormed();
						if ($dtaObj["VSL_ORDE_DDATE"] < $theDay)
						{
							$recSet[$occ]["VSL_ORST_PDATE"] = $theDay;
						}
						else
						{
							$recSet[$occ]["VSL_ORST_PDATE"] = $dtaObj["VSL_ORDE_DDATE"];
						}
						
						
					}

					
					$recSet[$occ] = $this->TV_NEWDOC_CONTROL($recSet[$occ]);
					$wTbls[$dbCount]->obj =$recSet[$occ];
					$wTbls[$dbCount]->objAreEqual = $this->objAreEqual($recSet[$occ],"vsl_orst","idVSL_ORST");
					$wTbls[$dbCount]->objvalid = $this->IV_STEP_VALID($recSet[$occ]);



					
					if ($this->objAreEqual($recSet[$occ],"vsl_orst","idVSL_ORST") != true)
			  		{
			  			if ($recSet[$occ]["VSL_ORST_ORDQT"] == 0)
			  			{
			  				$this->errorCode += 200;
			  				$this->errorCodeText[count($this->errorCodeText)] = "Cannot update zero order quantity";
			  			}
			  			
			  			if ($this->IV_STEP_VALID($recSet[$occ]) == true && $recSet[$occ]["VSL_ORST_STEPS"] < "JJ_X" )
			  			{	
			  				
							$wTbls[$dbCount]->dbUpdRec($recSet[$occ]);
							
							$wTbls[$dbCount]->E_POST = $recSet[$occ];
							$this->debugRetract = $wTbls[$dbCount];
							
							$this->errorCode += $wTbls[$dbCount]->errorCode;
						}
						else
						{
							$this->errorCode += 2000;
					
							$orlin=$dtaObj["VSL_ORDE_ORLIN"];
							$stpsq=$recSet[$occ]["VSL_ORST_STPSQ"];
							
						
							$this->errorCodeText[count($this->errorCodeText)] = "2000 - Step not valid for Line:(" . $orlin . ") Step:" .  $stpsq;
							if ($recSet[$occ]["VSL_ORST_STEPS"] > "JJ_INVO" )
							{
								$this->errorCodeText[count($this->errorCodeText)] = "Sales step has been invoiced - cannot be modified";
							}
						}
						
						$this->setItemQtyAdj($recSet[$occ]);		
					}
					
				}
				else
				{
					if ($recSet[$occ]["idVSL_ORST"] < 0 )
					{					
			  			if ($recSet[$occ]["VSL_ORST_ORDQT"] == 0)
			  			{
			  				$this->errorCode += 200;
			  				$this->errorCodeText[count($this->errorCodeText)] = "Cannot create zero order quantity";
			  			}

						$recSet[$occ]["idVSL_ORST"] = "";
						$recSet[$occ]["VSL_ORST_ORNUM"] = $dtaObj["VSL_ORDE_ORNUM"];
						$recSet[$occ]["VSL_ORST_ORLIN"] = $dtaObj["idVSL_ORDE"];
						$recSet[$occ]["VSL_ORST_STEPS"] = $this->IV_VSL_FIRST_STEP("",$this->fetchResult[0]);
						
						// New record may not have documents numbers
						$recSet[$occ] = $this->IV_VSL_initStepIdFields($recSet[$occ]);
						
						$wTbls[$dbCount]->dbInsRec($recSet[$occ]);		
						$this->errorCode += $wTbls[$dbCount]->errorCode;
						$recSet[$occ]["idVSL_ORST"] = $wTbls[$dbCount]->insertId;
						$wTbls[$dbCount]->RS = $recSet[$occ];
						$this->setItemQtyAdj($recSet[$occ]);
					}
				}		
			}
			else
			{
				if ($recSet[$occ]["idVSL_ORST"] > 0 && $recSet[$occ]["VSL_ORST_STEPS"] < "JJ_X")
				{
					$recSet[$occ]["PROCESS"] = $dtaObj["PROCESS"];
					$recSet[$occ]["SESSION"] = $dtaObj["SESSION"];
					$recSet[$occ]["TBLNAME"] = "vsl_orst";			
				
					$wTbls[$dbCount] = new dbMaster("vsl_orst",$this->tblInfo->schema);
					$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
					$wTbls[$dbCount]->dbDelRec($recSet[$occ]);
					$this->errorCode += $wTbls[$dbCount]->errorCode;
					
					$recSet[$occ]["VSL_ORST_ORDQT"] = 0;	
					$recSet[$occ]["lotSel"] = "";	
					$this->setItemQtyAdj($recSet[$occ]);
				}
				else
				{
					if ($recSet[$occ]["VSL_ORST_STEPS"] > "JJ_INVO" )
					{
						$this->errorCode += 99;
						$this->errorCodeText[count($this->errorCodeText)] = "error 99 : Sales step has been invoiced - cannot be deleted";
					}					
				}
				
			}

			$occ += 1;
			
		}
		
		$this->recSetPost[$seq]["RECSET"] = $recSet;
		return $wTbls;
	}

	function validateVSL_LSTR($dtaObj)
	{
		
		$recValid = true;
		
		$recSet = $dtaObj["RECSET"];
		$occ = 0;
		while ( $occ < count($recSet) && $recValid == true)
		{
			if ($recSet[$occ]["idVSL_ORST"])
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
				&& $lotAccum != abs($recSet[$occ]["VSL_ORST_ORDQT"])
				&& strpos("x," . $this->setDocOrst . ",",",".$recSet[$occ]["idVSL_ORST"].",") > 0
				)
				{
					$recValid = false;
				}
				if ( abs($lotAccum) > abs($recSet[$occ]["VSL_ORST_ORDQT"]) )
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
	
	function updateVSL_LSTR($dtaObj)
	{
			// receives ORDER LINE RECSET
	$debugret = array();
	$this->lotlist = array();
			
			
			$wTbls = array();
	
			// $wTbls[0] = new dbMaster("vsl_lstr",$this->tblInfo->schema);
			// $wTbls[0] Representsresult info on the all updates in  $dtaObj["RECSET"];
			
			
			$recSet = $dtaObj["RECSET"];
			$PR = $dtaObj["PROCESS"];
			$SE = $dtaObj["SESSION"];
			$TB = "vsl_lstr";			
	
			
			
			$occ = 0;
			while ( $occ < count($recSet) )
			{
				if ($recSet[$occ]["idVSL_ORST"] && $recSet[$occ]["VSL_ORST_STEPS"] < "JJ_X" )
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
					 
					$orgLSTR = $this->OriginalData["vsl_lstr"];
					$qtySgn = 1;
					if ($recSet[$occ]["VSL_ORST_ORDQT"] < 0)
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
							if (strpos( "xx" . $name,$recSet[$occ]["idVSL_ORST"] . "-" ) > 0 && $recSet[$occ]["idVSL_ORST"] > 0)
							{
								// Current idVSL_ORST 
								$updRec = $value;
								$updRec["VSL_LSTR_ALOQT"] = 0;
							
								$updRec["PROCESS"] = $PR;
								$updRec["SESSION"] = $SE;
								$updRec["TBLNAME"] = $TB;			
								
								$updRec["selList"] = $selList;
								
								$lotFound = false;
								$wocc = 0;
								
								while ($wocc < count($selList)-1 && $lotFound == false)
								{
									$SL = explode(":",$selList[$wocc]);
									$updRec["bef"] = trim($SL[0])  . "==" . $updRec["VSL_LSTR_LOTSQ"];
									if (trim($SL[0]) == $updRec["VSL_LSTR_LOTSQ"])
									{
										$updRec["VSL_LSTR_ALOQT"] = abs($SL[1]) * $qtySgn;
										$lotFound = true;
										$selList[$wocc] = "0:0";
										$updRec["selList"] = $selList; 
										$updRec["value_ALOQT"] = $value["VSL_LSTR_ALOQT"];
										if ($updRec["VSL_LSTR_ALOQT"] != $value["VSL_LSTR_ALOQT"])
										{
											$dbCount = count($wTbls);
											$wTbls[$dbCount] = new dbMaster("vsl_lstr",$this->tblInfo->schema);
											$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
											$wTbls[$dbCount]->dbUpdRec($updRec);
											$this->errorCode += $wTbls[$dbCount]->errorCode;
											$updRec["method"]="dbUpdRec";
											
											// $this->lotlist[count($this->lotlist)] = $updRec;
										}
										
										
										
									}
									$wocc +=1 ;
								}
								$updRec["recount"] = $recSet[$occ]["idVSL_ORST"];
								$updRec["orgName"] = $name;
								$updRec["lotLength"] = count($selList);
								$updRec["lotFound"] = $lotFound;
								// $this->lotlist[count($this->lotlist)] = $updRec;
								
								if ($lotFound == false && $updRec["idVSL_LSTR"] > 0)
								{
									$dbCount = count($wTbls);
									$wTbls[$dbCount] = new dbMaster("vsl_lstr",$this->tblInfo->schema);
									$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
									$wTbls[$dbCount]->dbDelRec($updRec);
									$this->errorCode += $wTbls[$dbCount]->errorCode;
									$updRec["method"]="dbDelRec";
									$updRec["VSL_LSTR_ALOQT"] = 0;
									
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
							
							$updRec["VSL_LSTR_ORNUM"] = $dtaObj["VSL_ORDE_ORNUM"];
							$updRec["VSL_LSTR_ORLIN"] = $dtaObj["idVSL_ORDE"];
							$updRec["VSL_LSTR_STPSQ"] = $recSet[$occ]["idVSL_ORST"];
							$updRec["VSL_LSTR_ITMID"] = $dtaObj["VSL_ORDE_ITMID"];
							$updRec["VSL_LSTR_LOTSQ"] = $SL[0];
							$updRec["VSL_LSTR_ALOQT"] = abs($SL[1]) * $qtySgn;
			
					$this->lotlist[count($this->lotlist)] = $dtaObj;
					$this->lotlist[count($this->lotlist)] = $recSet[$occ];

							$dbCount = count($wTbls);
							$wTbls[$dbCount] = new dbMaster("vsl_lstr",$this->tblInfo->schema);
							$wTbls[$dbCount]->brTrConn = $this->masterTranConn;
							$wTbls[$dbCount]->dbInsRec($updRec);
							$this->errorCode += $wTbls[$dbCount]->errorCode;
							$updRec["method"]="dbInsRec";
							$updRec["idVSL_LSTR"] = $wTbls[$dbCount]->insertId;
							
							
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
//		$this->setDocOrstp = $E_POST["VSL_ORHE_ORSTP"]; // Order Scheme defines valid steps 

//		$recSet[$occ] = $this->TV_NEWDOC_CONTROL($recSet[$occ]:
//		
//		if ($this->objAreEqual($recSet[$occ],"vsl_orst","idVSL_ORST") != true)
//  		{
//  			if ($this->IV_STEP_VALID($recSet[$occ]) == true)
//

	function TV_NEWDOC_CONTROL($objRec)
	{
		$x = count($this->IV_ND);
		
		if (!$this->setNewDocument || strpos("x,".$this->setDocOrst."," , "," . $objRec["idVSL_ORST"] . ",") < 1)
		{
			return $objRec;
		}
		// If object not of concern simply return the object
		if ($objRec["VSL_ORST_STEPS"] > "JJ_INVO")
		{
			$this->errorCodeText[count($this->errorCodeText)] = "Error 99: Step has been incoiced - step not valid";
			$this->errorCode += 2000;
			return $objRec;
		}
		
		
		
		if ($this->setNewDocument >= $objRec["VSL_ORST_STEPS"])
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
			
			
		$this->howdidyouevergethere = "GOT HERE";
			
		if (!$this->setDocNFNU)
		{
			$nfnu = new vgb_getNextFreeNumber($this->tblInfo->schema,"VSL_ORSI_GRPID" ,$this->local_POST,$this->masterTranConn);
			$this->setDocNFNU = $nfnu->vgb_nextNumber;

		}
		
		$objRec["VSL_ORHE_ORNUM" ] = $this->local_POST["idVSL_ORHE"];
		$objRec["VSL_ORHE_ORSTP" ] = $this->local_POST["VSL_ORHE_ORSTP"];
		$objRec["VSL_ORHE_BTCUS" ] = $this->local_POST["VSL_ORHE_BTCUS"];
		
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
					$vsl_orsi = array();
					$vsl_orsi["idVSL_ORSI"] = "";
					$vsl_orsi["VSL_ORSI_STEPS"] = $validSteps[$occ];
					
					$vsl_orsi["VSL_ORSI_GRPID"] = $this->setDocNFNU;
					$vsl_orsi["VSL_ORSI_ORNUM"] = $objRec["VSL_ORHE_ORNUM"];
					$vsl_orsi["VSL_ORSI_PROCE"] = "0";
					// $vsl_orsi["VSL_ORSI_BPART"] = $objRec["VSL_ORHE_BTCUS"];
					$vsl_orsi["VSL_ORSI_REISS"] = "0";
					$vsl_orsi["VSL_ORSI_RESEQ"] = "0";
					
					$wTbls = new dbMaster("vsl_orsi",$this->tblInfo->schema);
					$wTbls->brTrConn = $this->masterTranConn;
		
					$vsl_orsi["PROCESS"] = $this->processId;
					$vsl_orsi["SESSION"] = $this->sessionId;
					
					if (!$this->setDocOrsi[$vsl_orsi["VSL_ORSI_STEPS"]])
					{
						$wTbls->dbInsRec($vsl_orsi);
						$this->setDocOrsi[$vsl_orsi["VSL_ORSI_STEPS"]] = $wTbls->insertId;
						$vsl_Id = $wTbls->insertId;
					}
					else
					{
						$vsl_Id = $this->setDocOrsi[$vsl_orsi["VSL_ORSI_STEPS"]];
					}
					
					$objRec = $this->TV_SetDocNumber($validSteps[$occ],$objRec,$vsl_Id);
					
					if (!$this->errorCodexx)
					{
						$this->errorCodexx = array();
					}
					$wTbls->posted = $vsl_orsi;
					$wTbls->objRec = $objRec;
					$wTbls->validSteps = $occ . "=" . $validSteps[$occ];
					$this->errorCodexx[count($this->errorCodexx)] = $wTbls;
				}
					
			}
			else
			{
				// $objRec["VSL_ORST_STEPS"] = $validStep[$occ];
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
		
		if ($objRec["VSL_ORST_STEPS"] > "JJ_INVO")
		{
			$this->IV_ND[$x] = $objRec["VSL_ORST_STEPS"] . ">";
			return false;
		}
				
		if ($objRec["VSL_ORST_STEPS"] > $this->setNewDocument)
		{
			$this->IV_ND[$x] = $objRec["VSL_ORST_STEPS"] . ">";
			return false;
		}
		$objRec["VSL_ORHE_ORSTP"] = $this->setNewDocument;
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
				$docNumber =  $objRec["VSL_ORST_ARCID"] * 1;
			break;
			case 'JJ_INVO':
				$docNumber =  $objRec["VSL_ORST_WINVO"] * 1;
			break;
			case 'II_DELI':
				$docNumber =  $objRec["VSL_ORST_DELID"] * 1;
			break;
			case 'HH_PACK':
				$docNumber =  $objRec["VSL_ORST_PAKID"] * 1;
			break;
			case 'GG_RELE':
				$docNumber =  $objRec["VSL_ORST_RELID"] * 1;
			break;
			case 'FF_PICK':
				$docNumber =  $objRec["VSL_ORST_PICID"] * 1;
			break;
			case 'EE_SCED':
				$docNumber =  $objRec["VSL_ORST_SCEID"] * 1;
			break;
			case 'DE_AOKN':
				$docNumber =  $objRec["VSL_ORST_AOKID"] * 1;
			break;
			case 'DD_ACKN':
				$docNumber =  $objRec["VSL_ORST_ACKID"] * 1;
			break;
			
		}

		return $docNumber;
		
	}	
		

	function TV_SetDocNumberClear($objRec)
	{

		$recId = "";
		$sep = "";
		
		$objRec["VSL_ORST_STEPS"] = $this->setNewDocument;

		switch ($this->setNewDocument)
		{

			case 'DD_ACKN':                          	                
				$recId .= $sep . "VSL_ORST_ACKID";$objRec["VSL_ORST_ACKID"]=0;
				$sep = ",";
			case 'DE_AOKN':                          	                
				$recId .= $sep . "VSL_ORST_AOKID";$objRec["VSL_ORST_AOKID"]=0;
				$sep = ",";                      	                
			case 'EE_SCED':                          	                
				$recId .= $sep . "VSL_ORST_SCEID";$objRec["VSL_ORST_SCEID"]=0;
				$sep = ",";                      	                
			case 'FF_PICK':                          	                
				$recId .= $sep . "VSL_ORST_PICID";$objRec["VSL_ORST_PICID"]=0;
				$sep = ",";                      	                
			case 'GG_RELE':                          	                
				$recId .= $sep . "VSL_ORST_RELID";$objRec["VSL_ORST_RELID"]=0;
				$sep = ",";                      	                
			case 'HH_PACK':                          	                
				$recId .= $sep . "VSL_ORST_PAKID";$objRec["VSL_ORST_PAKID"]=0;
				$sep = ",";                      	                
			case 'II_DELI':                          	                
				$recId .= $sep . "VSL_ORST_DELID";$objRec["VSL_ORST_DELID"]=0;
				$sep = ",";                      	                
			case 'JJ_INVO':                          	                
				$recId .= $sep . "VSL_ORST_WINVO";$objRec["VSL_ORST_WINVO"]=0;
				$sep = ",";                      	                
			case 'KK_PURG':
				$recId .= $sep . "VSL_ORST_ARCID";$objRec["VSL_ORST_ARCID"]=0;
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
				$docNumber =  $objRec["VSL_ORST_ARCID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VSL_ORST_ARCID"] = $recId;
					$objRec["VSL_ORST_STEPS"] = "QQ_PURG";
				}
			break;
			case 'JJ_INVO':
				$docNumber =  $objRec["VSL_ORST_WINVO"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VSL_ORST_WINVO"] = $recId;
					$objRec["VSL_ORST_STEPS"] = "KK_PURG";
				}
			break;
			case 'II_DELI':
				$docNumber =  $objRec["VSL_ORST_DELID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VSL_ORST_DELID"] = $recId;
					$objRec["VSL_ORST_STEPS"] = "JJ_INVO";
				}
			break;
			case 'HH_PACK':
				$docNumber =  $objRec["VSL_ORST_PAKID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VSL_ORST_PAKID"] = $recId;
					$objRec["VSL_ORST_STEPS"] = "II_DELI";
					
					
				}
			break;
			case 'GG_RELE':
				$docNumber =  $objRec["VSL_ORST_RELID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VSL_ORST_RELID"] = $recId;
					$objRec["VSL_ORST_STEPS"] = $this->IV_VSL_NEXT_STEP($objRec["VSL_ORST_STEPS"],$objRec);
				}
			break;
			case 'FF_PICK':
				$docNumber =  $objRec["VSL_ORST_PICID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VSL_ORST_PICID"] = $recId;
					$objRec["VSL_ORST_STEPS"] = $this->IV_VSL_NEXT_STEP($objRec["VSL_ORST_STEPS"],$objRec);
				}
			break;
			case 'EE_SCED':
				$docNumber =  $objRec["VSL_ORST_SCEID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VSL_ORST_SCEID"] = $recId;
					$objRec["VSL_ORST_STEPS"] = $this->IV_VSL_NEXT_STEP($objRec["VSL_ORST_STEPS"],$objRec);
				}
			break;
			case 'DE_AOKN':
				$docNumber =  $objRec["VSL_ORST_AOKID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VSL_ORST_AOKID"] = $recId;
					$objRec["VSL_ORST_STEPS"] = $this->IV_VSL_NEXT_STEP($objRec["VSL_ORST_STEPS"],$objRec);
				}
			break;
			case 'DD_ACKN':
				$docNumber =  $objRec["VSL_ORST_ACKID"] * 1;
				if ($docNumber == 0)
				{
					$objRec["VSL_ORST_ACKID"] = $recId;
					$objRec["VSL_ORST_STEPS"] = $this->IV_VSL_NEXT_STEP($objRec["VSL_ORST_STEPS"],$objRec);
				}
			break;
			
		}
		return $objRec;
		
	}
	
	function IV_STEP_VALID($objRec)
	{
	
		
		if(!$this->OriginalData["vsl_orst"][$objRec["idVSL_ORST"]])
		{
			return true;
		}
		
		$orgDta = $this->OriginalData["vsl_orst"][$objRec["idVSL_ORST"]];
	
		$this->IV_STEP_VALIDORG = $orgDta["VSL_ORST_STEPS"]; 
		$this->IV_STEP_VALIDCUR = $objRec["VSL_ORST_STEPS"];
		
	
		if($orgDta["VSL_ORST_STEPS"] != $objRec["VSL_ORST_STEPS"] )
		{
			if (strpos("x,".$this->setDocOrst."," , "," . $objRec["idVSL_ORST"] . ",") < 1)
			{
				return false;
			}
			else
			{
				// $this->IV_getDocNumber = $this->IV_getDocNumber($objRec["VSL_ORST_STEPS"],$objRec);
				if ($this->IV_getDocNumber($objRec["VSL_ORST_STEPS"],$objRec) > 0)
				{
					return false;
				}
			}
		}
		
		
		return true;
		

	}



	function IV_VSL_FIRST_STEP($SCEME ,$ATD)
	{
		$RET="";
		$SEQ  = $this->IV_GET_SCEME_SEQ($SCEME ,$ATD);
		$RET = explode(",",$SEQ);
		return $RET[0];
		
	}
	
	function IV_GET_SCEME_SEQ($SCEME,$ATD)
	{
	
		switch ($ATD["VSL_ORHE_ORSTP"])
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
	
	function IV_VSL_initStepIdFields($obj)
	{

		$obj["VSL_ORST_ACKID"] = null;
		$obj["VSL_ORST_AOKID"] = null;
		$obj["VSL_ORST_ARCID"] = null;
		$obj["VSL_ORST_DELID"] = null;
		$obj["VSL_ORST_PAKID"] = null;
		$obj["VSL_ORST_PICID"] = null;
		$obj["VSL_ORST_RELID"] = null;
		$obj["VSL_ORST_SCEID"] = null;
		$obj["VSL_ORST_WINVO"] = null;		
		
		return $obj;

	}
	
	
	
	function IV_VSL_NEXT_STEP($steps,$objRec)
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
	
	
	function IV_VSL_STEP_EVAL($SCEME,$A_TD)
	{
		
	// Always use these prefix for your variable names
	// IV_ = Information values
	// TV_ = Transaction values 
		
		
		$qRsp = array();
		$qRsp["IV_VSL_STEP_MULT"] = 0;
		$qRsp["IV_VSL_STEP_RELEASED"] = 0;
		$qRsp["IV_VSL_STEP_DELIVERED"] = 0;
		$qRsp["IV_VSL_STEP_INVOICED"] = 0;
		$qRsp["IV_VSL_STEP_FIRST_QTY"] = 0;
		$qRsp["IV_VSL_HAS_TO_INVOICE"] = 0;
		$qRsp["IV_VSL_HAS_TO_RELEASE"] = 0;
		$qRsp["IV_VSL_HAS_TO_DELIVER"] = 0;
		$qRsp["IV_VSL_HAS_ALOCATED_QTY"] = 0;
		$qRsp["IV_VSL_HAS_IN_WIP"] = 0;
		$qRsp["IV_VSL_STEP_MULT_CHECK"] = 0;
		$qRsp["IV_VSL_STEP_QTY"] = array();
		$qRsp["IV_VSL_STEPS_VALID"] = $this->IV_GET_SCEME_SEQ($SCEME ,$A_TD[0]);
		
		$qRspInit = $qRsp;
		
		$listidORHE = "";
		$listidORDE = "";
		$listidORST = "";
		
		$occ = 0;
		
		while ($occ < count($A_TD))
		{
			
			if (strpos(" ," . $listidORST , "," . $A_TD[$occ]["idVSL_ORST"] . "," ) < 1)
			{
				$listidORST .= $A_TD[$occ]["idVSL_ORST"] . ",";
			
				if ($A_TD[$occ]["VSL_ORST_STEPS"] == $this->IV_VSL_FIRST_STEP($SCEME,$A_TD[$occ]))
				{
					$qRsp["IV_VSL_STEP_FIRST_QTY"] += $A_TD[$occ]["VSL_ORST_ORDQT"];
				}
				
		
				if ($A_TD[$occ]["VSL_ORST_STEPS"] > "JJ_INVO" )
				{
					
					
					$qRsp["IV_VSL_STEP_INVOICED"]  += $A_TD[$occ]["VSL_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VSL_ORST_STEPS"] > "II_DELI" && $A_TD[$occ]["VSL_ORST_STEPS"] < "JJ_INVO_x")
				{
					$qRsp["IV_VSL_HAS_TO_INVOICE"] += $A_TD[$occ]["VSL_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VSL_ORST_STEPS"] > "II_DELI" )
				{
					
					$qRsp["IV_VSL_STEP_DELIVERED"]  += $A_TD[$occ]["VSL_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VSL_ORST_STEPS"] > "GG_RELE" && $A_TD[$occ]["VSL_ORST_STEPS"] < "II_DELI_x")
				{
					$qRsp["IV_VSL_HAS_TO_DELIVER"] += $A_TD[$occ]["VSL_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VSL_ORST_STEPS"] > "GG_REL " && $A_TD[$occ]["VSL_ORST_STEPS"] < "II_DELI_x")
				{
					$qRsp["IV_VSL_HAS_ALOCATED"] = 1;
					$qRsp["IV_VSL_HAS_ALOCATED_QTY"] += $A_TD[$occ]["VSL_ORST_ORDQT"];
				}
		
		
		
				if ($A_TD[$occ]["VSL_ORST_STEPS"] > "GG_RELE")
				{
					$qRsp["IV_VSL_STEP_RELEASED"]  += $A_TD[$occ]["VSL_ORST_ORDQT"];
				}
				else
				{
					$qRsp["IV_VSL_HAS_TO_RELEASE"] += $A_TD[$occ]["VSL_ORST_ORDQT"];
				}
		
				if ($A_TD[$occ]["VSL_ORST_STEPS"] == "KK_PURG")
				{
					$qRsp["IV_VSL_HAS_IN_WIP"] += $A_TD[$occ]["VSL_ORST_ORDQT"];
				}
		
				
		
				if (!$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]])
				{
					$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]] = $qRspInit;
				}
	
				if (!$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_STEP_QTY"][$A_TD[$occ]["VSL_ORST_STEPS"]])
				{
					$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_STEP_QTY"][$A_TD[$occ]["VSL_ORST_STEPS"]] = $A_TD[$occ]["VSL_ORST_ORDQT"];		
				}
				else
				{
					$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_STEP_QTY"][$A_TD[$occ]["VSL_ORST_STEPS"]] += $A_TD[$occ]["VSL_ORST_ORDQT"];
				}
				$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_STEP_RELEASED"] += $qRsp["IV_VSL_STEP_RELEASED"];
				$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_STEP_DELIVERED"] += $qRsp["IV_VSL_STEP_DELIVERED"];
				$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_STEP_INVOICED"] += $qRsp["IV_VSL_STEP_INVOICED"];
				$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_STEP_FIRST_QTY"] +=	$qRsp["IV_VSL_STEP_FIRST_QTY"];
				$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_HAS_TO_INVOICE"] += $qRsp["IV_VSL_HAS_TO_INVOICE"];
				$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_HAS_TO_RELEASE"] += $qRsp["IV_VSL_HAS_TO_RELEASE"];
				$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_HAS_TO_DELIVER"] += $qRsp["IV_VSL_HAS_TO_DELIVER"];
				$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_HAS_ALOCATED_QTY"] += $qRsp["IV_VSL_HAS_ALOCATED_QTY"];
				$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_HAS_IN_WIP"] += $qRsp["IV_VSL_HAS_IN_WIP"];
				$qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]]["IV_VSL_STEP_MULT_CHECK"] += 1;
								
				$qRsp = $qRspInit;
			
			}
					
			$occ += 1;
		}
	
		$occ = 0;
		while ($occ < count($A_TD))
		{
			$A_TD[$occ]["OrderStatus"] = $qResponse["qR".$A_TD[$occ]["idVSL_ORDE"]];
			
			$occ += 1;
		}
	
	
		return  $A_TD; 
	
	}


// Replace with central vgl_taxing - > vgl_taxCalculate
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
//			$taxRec[$occ]["GLAMT"] += $taxAmt;
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
		$invoiceObj["idVSL_ORHE"] = "0";
		$invoiceObj["deliveryID"] = $ePost["deliveryID"];
		
		if (trim($invoiceObj["deliveryID"]) != "") 
		{
			$invoiceTbl = new vsl_invoiceRead($this->tblInfo->schema);
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
		
		if(trim($invoiceObj["deliveryID"])!="" && count($recSet)>0)
		{
			$occ = 0;
			while ($occ < count($delID) && $this->errorCode == 0 )
			{
				$dtaSet["TOTSALES"] = 0;
				$dtaSet["EXPCHARGED"] = 0;
				$dtaSet["EXPBORNED"] = 0;
				$dtaSet["TAXES"] = array();
				$lastId = "";
				$dtaSet["AVGCOST"] = 0;
				$taxable = 0;
				
				$wocc = 0;
				while ($wocc < count($recSet))
				{
					if ( $recSet[$wocc]["VSL_ORST_DELID"] == $delID[$occ] )
					{
						if ($lastId == "")
						{
							$lastId = "DONE";
							$dtaSet["vsl_orhe"] = $recSet[$wocc];
							// Orhe Taxes
							$wTblsTax = new vsl_orheTax($this->tblInfo->schema);
							$taxPost = array();
					 		$taxPost["idVSL_ORHE"] = $recSet[$wocc]["idVSL_ORHE"];
					 		$wTblsTax->dbFindMatch($taxPost);
							$dtaSet["TAXES"] = $wTblsTax->result;
							$taxOcc = 0;
							while ($taxOcc < count($dtaSet["TAXES"]))
							{
								$dtaSet["TAXES"][$taxOcc]["GLAMT"] = 0;
								$taxOcc += 1;
							}
						}
						if ($recSet[$wocc]["VSL_ORDE_OLTYP"] == "STD")
						{
							// Must take care of Facto
							$totAmt = $recSet[$wocc]["VSL_ORDE_OUNET"] * $recSet[$wocc]["VSL_ORST_ORDQT"];
							$dtaSet["TOTSALES"] += $totAmt; //A
							$dtaSet["AVGCOST"] += ($recSet[$wocc]["VIN_ITMWAR_AVGCP"] * $recSet[$wocc]["VSL_ORST_ORDQT"] ); //E
							if ($recSet[$wocc]["VIN_ITEM_ITTXT"] != "NOTAX")
							{
								
								$taxable += ($totAmt*1);
							}
							
							
							// Update vsl_orde if average cost changed
							if ($recSet[$wocc]["VIN_ITMWAR_AVGCP"] != $recSet[$wocc]["VSL_ORDE_COSTP"])
							{
								$recSet[$wocc]["PROCESS"] = $ePost["PROCESS"];
								$recSet[$wocc]["SESSION"] = $ePost["SESSION"];
								
								$recSet[$wocc]["VSL_ORDE_COSTP"] = $recSet[$wocc]["VIN_ITMWAR_AVGCP"];
						  		$wTbls = new dbMaster("vsl_orde",$this->tblInfo->schema);
						  		$wTbls->brTrConn = $this->masterTranConn;
								$wTbls->dbUpdRec($recSet[$wocc]);
								
							}
								
						}
						if ($recSet[$wocc]["VSL_ORDE_OLTYP"] == "EXP")
						{
							// Must take care of Facto
							$totAmt = $recSet[$wocc]["VSL_ORDE_OUNET"] * $recSet[$wocc]["VSL_ORST_ORDQT"];
							$dtaSet["EXPCHARGED"] += $totAmt; //B 
							if ($recSet[$wocc]["VIN_ITEM_ITTXT"] != "NOTAX")
							{
								
								$taxable += ($totAmt*1);
							}

						}

						if ($recSet[$wocc]["VSL_ORDE_OLTYP"] == "BOR")
						{
							$dtaSet["EXPBORNED"] = ($recSet[$wocc]["VSL_ORDE_OUNET"] * $recSet[$wocc]["VSL_ORST_ORDQT"] ); //C
						}

						if ($recSet[$wocc]["VSL_ORDE_OLTYP"] != "BOR")
						{
							// Last price paid
							$tmpObj = array();
							$tmpObj["PROCESS"] = $ePost["PROCESS"];
							$tmpObj["SESSION"] = $ePost["SESSION"];
							$tmpObj["VIN_CUST_BPART"] = $recSet[$wocc]["VSL_ORHE_BTCUS"];	
							$tmpObj["VIN_CUST_ITMID"] = $recSet[$wocc]["VSL_ORDE_ITMID"];	
							$tmpObj["VIN_CUST_LPPAID"] = $recSet[$wocc]["VSL_ORDE_OUNET"];	
							$tmpObj["VIN_CUST_LPDATE"] = $this->getDateFormed();
							$wT = new vin_cust($this->tblInfo->schema);
							$wT->brTrConn = $this->masterTranConn;
							$wT->vin_cust_lastPrice($tmpObj);
							$this->lastPricePaid = $wT;
						}

						
						
					}
					
					$wocc += 1;
				}
				
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
					
					$finTbls = new var_financial($this->tblInfo->schema);
					$finTbls->brTrConn = $this->masterTranConn;
					$finTbls->var_sales("VSL_INV",$dtaSet);
					$resultSet[$occ]["finSet"] = $finTbls;
					$this->errorCode = $finTbls->errorCode;
					$this->errorCodeText = $finTbls->errorCodeText;
					$this->VGL_JNHE_TRNID = $finTbls->VGL_JNHE_TRNID;
					$this->VAR_OIHE_INVOI = $finTbls->VAR_OIHE_INVOI;

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
		// - vsl_orhe (Header) for Partner-Reference-Currency
		// - POST_DATE - Posting date
		// - TOTSALES Total of sales (Items)
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

	
	function updateFinalSteps($delID)
	{

		$tFnc = new AB_querySession;
		$cUser = $tFnc->getUserData();
				
		$recSet = $this->invoices->result;
		$orheObj = $recSet[0];
		$orheObj["PROCESS"] = $this->processId;
		$orheObj["SESSION"] = $this->sessionId;
		
  		$wTbls = new dbMaster("vsl_orhe",$this->tblInfo->schema);
  		$wTbls->brTrConn = $this->masterTranConn;
		$wTbls->dbUpdRec($orheObj);
		$this->errorCode = $wTbls->errorCode;
		if ($this->errorCode != 0)
		{
			$this->errorCodeText[count($this->errorCodeText)] = $this->errorCode . " Someone updated order " . $orheObj["VSL_ORHE_ORNUM"] . " during update";
			return;
		}


		$orsiObj = array();
		$orsiObj["PROCESS"] = $this->processId;
		$orsiObj["SESSION"] = $this->sessionId;

		
		$orsiObj["VSL_ORSI_STEPS"] = "JJ_INVO";
		$orsiObj["VSL_ORSI_GRPID"] = $this->VAR_OIHE_INVOI;
		$orsiObj["VSL_ORSI_USLNC"] = $cUser["userCode"];
		$orsiObj["VSL_ORSI_ORNUM"] = $recSet[0]["idVSL_ORHE"];
		$orsiObj["VSL_ORSI_PROCE"] = "1";
		$insertId = array();
		
  		$wTbls = new dbMaster("vsl_orsi",$this->tblInfo->schema);
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
			$this->errorCodeText[count($this->errorCodeText)] = $this->errorCode . " error updating vsl_orsi";
		}
		else
		{
			$orsiObj["VSL_ORSI_STEPS"] = "KK_PURG";
			$orsiObj["VSL_ORSI_GRPID"] = $this->VGL_JNHE_TRNID;

	  		$wTbls = new dbMaster("vsl_orsi",$this->tblInfo->schema);
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
				$this->errorCodeText[count($this->errorCodeText)] = $this->errorCode . " error updating vsl_orsi";
			}
		}
		
		
		$orstObj = array();
		$orstObj["PROCESS"] = $this->processId;
		$orstObj["SESSION"] = $this->sessionId;
		
		$orstList = "";
		$occ = 0;
		while ($occ < count($recSet) && $insertId > 0 && $this->errorCode == 0)
		{
			if (strpos("x," . $orstList . "," , "," . $recSet[$occ]["idVSL_ORST"] . ",") < 1 && $recSet[$occ]["VSL_ORST_DELID"] == $delID && $recSet[$occ]["VSL_ORST_STEPS"] == "JJ_INVO")
			{
				$orstList .= "," . $recSet[$occ]["idVSL_ORST"];
				
				$orstObj["idVSL_ORST"] = $recSet[$occ]["idVSL_ORST"];
				$orstObj["VSL_ORST_STEPS"] = "QQ_PURG";
				$orstObj["VSL_ORST_DDATE"] = $this->getDateFormed();
				$orstObj["VSL_ORST_WINVO"] = $insertId[0];
				// $orstObj["VSL_ORST_ARCID"] = $insertId[1];
		  		$wTbls = new dbMaster("vsl_orst",$this->tblInfo->schema);
		  		$wTbls->brTrConn = $this->masterTranConn;
				$wTbls->dbUpdRec($orstObj);		
				$this->errorCode = $wTbls->errorCode;
				
				if ($this->errorCode!=0 )
				{
					$this->orstPost = $orstObj;
					$this->orstTbl = $wTbls;
					$this->errorCodeText[count($this->errorCodeText)] = $this->errorCode . " error updating vsl_orst";
				}
			}
		
			$occ += 1;
		}
		
		
		
	}
	

}


class vsl_invoice extends dbMaster
{
	function vsl_invoice($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
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
			
	  		$wTblsORHE = new vsl_orhe($this->tblInfo->schema);
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
		$dtaObj["idVSL_ORHE"] = "0";
  		$wTbls = new vsl_invoiceRead($this->tblInfo->schema);
		$wTbls->dbFindFrom($dtaObj);
		
		
		$comma = "";
		$rString = "";
		$occ = 0;
		while ($occ < count($wTbls->result))
		{
			if (strpos("x," . $rString . "," , "," . $wTbls->result[$occ]["VSL_ORST_DELID"] . ",") < 1)
			{
				$rString .= $comma . $wTbls->result[$occ]["VSL_ORST_DELID"];
				$comma = ",";
			}
			$occ += 1;
		}
		
		$dtaObj["getTotals"] = true;
		$dtaObj["deliveryID"] = $rString;
  		$wTblsORHE = new vsl_orhe($this->tblInfo->schema);
  		$wTblsORHE->updDelivery($dtaObj);
		$wTbls->postingSet = $wTblsORHE;
		
 		$pSet = $wTbls->postingSet->updResult;
 		$pSetResult = array();
 		$occ = 0;
 		while ($occ < count($pSet))
 		{
 			$pSetResult[$occ]["VSL_ORST_DELID"] = $pSet[$occ]["dtaSet"]["vsl_orhe"]["VSL_ORST_DELID"];
 			$pSetResult[$occ]["TOTSALES"] = $pSet[$occ]["dtaSet"]["TOTSALES"] + $pSet[$occ]["dtaSet"]["EXPCHARGED"];
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
		$wTbls->dbSuppTbl["vsl_totals"]["result"] = $pSetResult;
		
		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
		
		
	}
}


class vsl_delivered extends dbMaster
{
	function vsl_delivered($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
		$this->AB_CPARM = $this->dbGetCparm();
	}

	function supportTbl($dtaObj)
	{

		$vslOrheList = $dtaObj["idVSL_ORHE"];
		$vgbBparList = $dtaObj["idVGB_BPAR"];
		$vgbCustList = $dtaObj["VSL_ORHE_BTCUS"];
		
		
		$suppTbl = array();

 		$objPost = array();
 		$objPost["PROCESS"] = $dtaObj["PROCESS"];
 		$objPost["SESSION"] = $dtaObj["SESSION"];
 		$objPost["MAXREC_OUT"] = 0; // No limit
 
		// Orhe Taxes
		$wTblsObj = new vsl_orheTax($this->tblInfo->schema);
 		$objPost["idVSL_ORHE"] = $vslOrheList;
 		$wTblsObj->dbFindMatch($objPost);
 		$suppTbl["vsl_orheTax"] = $wTblsObj;

		// Customer Address
		$wTblsObj = new vgb_addr($this->tblInfo->schema);
 		$objPost["VGB_ADDR_BPART"] = $vgbBparList;
 		$wTblsObj->dbFindMatch($objPost);
 		$suppTbl["vgb_addr"] = $wTblsObj;

		// Customer Items
		$wTblsObj = new vin_cust($this->tblInfo->schema);
 		$objPost["VIN_CUST_BPART"] = $vgbCustList;
 		$wTblsObj->dbFindMatch($objPost);
 		$suppTbl["vin_cust"] = $wTblsObj;
		
		return $suppTbl;
	}


	function dbFindMatch($dtaObj)
	{

		if ($dtaObj["doc_process"])
		{
			
			$proObj = explode(",",$dtaObj["doc_process"]);
			$occ = 0;
			while ($occ < count ($proObj))
			{
				$proTbls =  new vsl_invDoc($this->tblInfo->schema);
				$vsl_orsiObj = array();
				$vsl_orsiObj["PROCESS"] = $dtaObj["PROCESS"];
				$vsl_orsiObj["SESSION"] = $dtaObj["SESSION"];
				$vsl_orsiObj["MAXREC_OUT"] = 0;
				$vsl_orsiObj["idVSL_ORSI"] = $proObj[$occ]; 
				$proTbls->dbFindMatch($vsl_orsiObj);
				
				if ($proTbls->result[0]["VSL_ORSI_DOCPR"] == "0" && $vsl_orsiObj["SESSION"] == "VSL_INVOPR")
				{
					$updTbls =  new dbMaster("vsl_orsi",$this->tblInfo->schema);
					$vsl_orsiUpd = array();
					$vsl_orsiUpd["PROCESS"] = $dtaObj["PROCESS"];
					$vsl_orsiUpd["SESSION"] = $dtaObj["SESSION"];
					$vsl_orsiUpd["MAXREC_OUT"] = 0;
					$vsl_orsiUpd["idVSL_ORSI"] = $proTbls->result[0]["idVSL_ORSI"]; 
					$vsl_orsiUpd["VSL_ORSI_DOCPR"] = "1";
					$updTbls->dbUpdRec($vsl_orsiUpd);
					
				}
				
	 	 		if (!$this->dbSuppTbl)
	 	 		{
	 	 			$this->dbSuppTbl = array();
	 	 		}
	 	 		
	 	 	
				$this->dbSuppTbl["vsl_orhe" . $occ . "main"] = $proTbls;	

				$sTables = $this-> supportTbl($proTbls->result[0]);

				foreach($sTables as $name => $value)
				{
					$this->dbSuppTbl["vsl_orhe" . $occ . $name] = $value;
				}	
				
				$occ += 1;
			}

		}
		


		
		$this->loPost = $dtaObj;
		$invObj = array();
		$invObj["PROCESS"] = $dtaObj["PROCESS"];
		$invObj["SESSION"] = $dtaObj["SESSION"];
		$invObj["MAXREC_OUT"] = 0;
		$invObj["idVSL_ORSI"] = "0"; 
		
		// Addition filter
		$invObj["vsl_invDoc"] = array();
		
		// Printed (yes/no)
		$invObj["vsl_invDoc"]["VSL_ORSI_DOCPR"] = $dtaObj["doc_printed"];

		// Specific date range
		if ($dtaObj["date_range"])
		{
			$invObj["vsl_invDoc"]["VSL_ORSI_CDATE"] = $dtaObj["date_range"];
		}
		// Specific Customer
		if ($dtaObj["idVGB_CUST"] && $dtaObj["idVGB_CUST"] > 0)
		{
			$invObj["vsl_invDoc"]["VSL_ORHE_BTCUS"] = $dtaObj["idVGB_CUST"];
		}
		
//		$invObj["vsl_invDoc"]["VSL_ORHE_BTCUS"] = "110";
		

  		$wTbls =  new vsl_invDoc($this->tblInfo->schema);
		$wTbls->dbFindFrom($invObj);
		
		$comma = "";
		$rString = "";
		$occ = 0;
		while ($occ < count($wTbls->result))
		{
			if (strpos("x," . $rString . "," , "," . $wTbls->result[$occ]["VSL_ORST_DELID"] . ",") < 1)
			{
				$rString .= $comma . $wTbls->result[$occ]["VSL_ORST_DELID"];
				$comma = ",";
			}
			$occ += 1;
		}
		
		$dtaObj["getTotals"] = true;
		$dtaObj["deliveryID"] = $rString;
  		$wTblsORHE = new vsl_orhe($this->tblInfo->schema);
  		$wTblsORHE->updDelivery($dtaObj);
		$wTbls->postingSet = $wTblsORHE;


 		$pSet = $wTbls->postingSet->updResult;
 		$pSetResult = array();
 		$occ = 0;
 		while ($occ < count($pSet))
 		{
 			$pSetResult[$occ]["VSL_ORST_DELID"] = $pSet[$occ]["dtaSet"]["vsl_orhe"]["VSL_ORST_DELID"];
 			$pSetResult[$occ]["TOTSALES"] = $pSet[$occ]["dtaSet"]["TOTSALES"] + $pSet[$occ]["dtaSet"]["EXPCHARGED"];
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
		
 		if (!$this->dbSuppTbl)
 		{
 			$this->dbSuppTbl = array();
 		}
		$this->dbSuppTbl["vsl_totals"]["result"] = $pSetResult;
		

		// Unit of Measure Items
 		$objPost = array();
 		$objPost["PROCESS"] = $dtaObj["PROCESS"];
 		$objPost["SESSION"] = $dtaObj["SESSION"];
 		$objPost["MAXREC_OUT"] = 0; // No limit			
		$wTblsObj = new dbMaster("vin_unit",$this->tblInfo->schema);
 		$objPost["idVIN_UNIT"] = "0";
 		$wTblsObj->dbFindFrom($objPost);

 		if (!$this->dbSuppTbl)
 		{
 			$this->dbSuppTbl = array();
 		}
 		$this->dbSuppTbl["vin_unit"] = $wTblsObj;


		// Messages
 		$objPost = array();
 		$objPost["PROCESS"] = $dtaObj["PROCESS"];
 		$objPost["SESSION"] = $dtaObj["SESSION"];
 		$objPost["MAXREC_OUT"] = 0; // No limit			
		$wTblsObj = new dbMaster("vgb_amhe",$this->tblInfo->schema);
 		$objPost["idVGB_AMHE"] = "0";
 		$wTblsObj->dbFindFrom($objPost);

 		if (!$this->dbSuppTbl)
 		{
 			$this->dbSuppTbl = array();
 		}
 		$this->dbSuppTbl["vgb_amhe"] = $wTblsObj;


		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
		
		
	}
}

class vsl_invoiceRead extends dbMaster
{
	function vsl_invoiceRead($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
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
					$localWhere .= $orVal . "VSL_ORST_DELID = '" . $wClause[$occ] . "' ";
					$orVal = " OR  ";
					$occ += 1;
				} 

				$localWhere .= " ) AND ";

			}

		}
		else
		{

$localJoin = <<<EOD
	
			LEFT JOIN vgb_cust  ON idVGB_CUST = VSL_ORHE_BTCUS  [=COND:vgb_cust=]
			LEFT JOIN vgb_bpar  ON idVGB_BPAR = VGB_CUST_BPART  [=COND:vgb_bpar=]
			LEFT JOIN vsl_orsi  ON idVSL_ORSI = VSL_ORST_PAKID  [=COND:vsl_orsi=]
			
EOD;

		}

$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vsl_orhe  
		LEFT JOIN vsl_orde  ON idVSL_ORHE = VSL_ORDE_ORNUM  [=COND:vsl_orde=]
		LEFT JOIN vin_item  ON idVIN_ITEM = VSL_ORDE_ITMID  [=COND:vin_item=] 
		LEFT JOIN vin_itmwar  ON VIN_ITMWAR_ITMID = VSL_ORDE_ITMID && VIN_ITMWAR_WARID = VSL_ORDE_WARID [=COND:vin_itmwar=] 
		LEFT JOIN vsl_orst  ON idVSL_ORDE = VSL_ORST_ORLIN  [=COND:vsl_orst=]
	
		$localJoin
								
		WHERE $localWhere VSL_ORST_STEPS = 'JJ_INVO' AND [=WHERE=]  [=COND:vsl_orhe=] ORDER BY VSL_ORST_DELID [=LIMIT=] )  tx		

		
EOD;


		return $trig;
		
	}
	
}


class vsl_orheXXX extends dbMaster
{

	function vsl_orheXXX($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
	}

	
	function dbFindMatch($dtaObj)
	{
  		
  		$dtaObj["MAXREC_OUT"] = 0; // No limit
  		$wTbls = new vsl_orhe($this->tblInfo->schema);
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

		
		if ($wTbls->errorCode == 0 && $E_POST["PROCESS"] == "VSL_ORDERS")
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
				
				// Item Suppliers
				$wTblsSupp = new vin_supp($this->tblInfo->schema);
				$objPost["idVIN_SUPP"] = 0;
	 	 		$objPost["vin_supp_items"] = $vinItemList;
	 	 		$wTblsSupp->dbFindFrom($objPost);
	 	 		if (!$wTbls->dbSuppTbl)
	 	 		{
	 	 			$wTbls->dbSuppTbl = array();
	 	 		}
				$wTbls->dbSuppTbl["vin_supp"] = $wTblsSupp;
				
					 	 		
	 	 	}
			
		}

		// vsl_orheLSTR
		$wTblsLstr = new vsl_orheLstr($this->tblInfo->schema);
 		$objPost["idVSL_ORHE"] = $wTbls->result[0]["idVSL_ORHE"];;
 		$wTblsLstr->dbFindMatch($objPost);
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vsl_orheLSTR"] = $wTblsLstr;
		
		// Orhe Taxes
		$wTblsTax = new vsl_orheTax($this->tblInfo->schema);
 		$objPost["idVSL_ORHE"] = $wTbls->result[0]["idVSL_ORHE"];;
 		$wTblsTax->dbFindMatch($objPost);
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vsl_orheTax"] = $wTblsTax;



		// Customer Address
		$wTblsAddr = new vgb_addr($this->tblInfo->schema);
 		$objPost["VGB_ADDR_BPART"] = $wTbls->result[0]["idVGB_BPAR"];;
 		$wTblsAddr->dbFindMatch($objPost);
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vgb_addr"] = $wTblsAddr;

		// Customer Items
		$wTblsCitm = new vin_cust($this->tblInfo->schema);
 		$objPost["VIN_CUST_BPART"] = $wTbls->result[0]["VSL_ORHE_BTCUS"];;
 		$wTblsCitm->dbFindMatch($objPost);
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vin_cust"] = $wTblsCitm;
		
		// Supplier Transport
		$occ = 0;
		$suppList = "x,";
		$suppSet = array();
		while ($occ < count($tmp["result"]))
		{
			if ($tmp["result"][$occ]["VSL_ORSI_BPART"] > 0 && strpos($suppList,",".$tmp["result"][$occ]["VSL_ORSI_BPART"],",") < 1)
			{
				$suppList .= $tmp["result"][$occ]["VSL_ORSI_BPART"] . ",";
				$wTblsSupp = new vgb_supp($this->tblInfo->schema);
		 		$objPost["idVGB_SUPP"] = $tmp["result"][$occ]["VSL_ORSI_BPART"];
		 		$wTblsSupp->dbFindMatch($objPost);
		 		$wocc = 0;
		 		while ($wocc < count($wTblsSupp->result))
		 		{
		 			$suppSet[count($suppSet)] = $wTblsSupp->result[$wocc];
		 			$wocc += 1;
		 		}
			}
			$occ +=1 ;
		}
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vgb_supp"]["result"] = $suppSet;
		$wTbls->dbSuppTbl["vgb_supp"]["count"] = $tmp["result"];
		$wTbls->dbSuppTbl["vgb_supp"]["list"] = $suppList;

				
		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vsl_orhe"] = $tmp;
		

		
		// Set order Step status
//		$wTbls->dbEVAL= $this->IV_VSL_STEP_EVAL($wTbls->result[0]["VSL_ORHE_ORSTP"],$wTbls->result);
//
//		$occ = 0;
//		while ($occ < count($wTbls->result))
//		{
//			$wTbls->result[$occ]["IV_VSL_STEPS_VALID"] = $wTbls->dbEVAL[0]["OrderStatus"]["IV_VSL_STEPS_VALID"] ;
//			
//			$occ += 1;
//		}

		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
	

		
	}
}

class vsl_orheYYY extends dbMaster
{

	function vsl_orheYYY($schema)
	{
		$this->dbMaster("vsl_orhe",$schema);
	}


	function dbSetTrig()
	{


$trig = <<<EOD
			SELECT * FROM  
			 
		 	( SELECT * FROM vsl_orhe  
		LEFT JOIN vsl_orde  ON idVSL_ORHE = VSL_ORDE_ORNUM  [=COND:vsl_orde=] 
		LEFT JOIN vsl_orst  ON idVSL_ORDE = VSL_ORST_ORLIN  [=COND:vsl_orst=]
		LEFT JOIN vsl_lstr  ON idVSL_ORST = VSL_LSTR_STPSQ  [=COND:vsl_lstr=]
								
		WHERE [=WHERE=]  [=COND:vsl_orhe=] [=LIMIT=] )  tx		

		
EOD;


		return $trig;
		
	}

}
require_once "VGB_PARTNERS.php";
require_once "VIN_ITEMS.php"; 
require_once "VIN_INVENTORY.php";
require_once "VGB_GETNFNU.php";
require_once "VAR_FINANCE.php";

?> 


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                