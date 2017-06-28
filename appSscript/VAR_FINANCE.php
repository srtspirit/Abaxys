<?php


class var_oihe_items extends dbMaster
{
	function var_oihe_items($schema)
	{
		$this->dbMaster("vgb_bpar",$schema);
		
	}

	
	function dbSetTrig()
	{


$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgb_bpar 

			
			
			LEFT JOIN vgb_cust ON VGB_CUST_BPART = idVGB_BPAR [=COND:vgb_cust=]
			LEFT JOIN var_oihe ON VAR_OIHE_BCUST = idVGB_CUST [=COND:var_oihe=]
			LEFT JOIN vgl_jnhe ON idVGL_JNHE = VAR_OIHE_TRNID [=COND:vgl_jnhe=]
			LEFT JOIN var_oide ON idVAR_OIHE = VAR_OIDE_OITID [=COND:var_oide=]			
			
			WHERE [=WHERE=] [=COND:vgb_bpar=][=ORDBY=] [=LIMIT=] ) t1
			 	
			 
		
EOD;

		return $trig;


	}

}

class var_cust extends dbMaster
{
	function var_cust($schema)
	{
		$this->dbMaster("vgb_bpar",$schema);
		
	}

	


	function dbSetTrig()
	{


$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgb_bpar 

			
			LEFT JOIN vgb_cust ON VGB_CUST_BPART = idVGB_BPAR [=COND:vgb_cust=]
			LEFT JOIN vgb_addr ON idVGB_ADDR = VGB_CUST_BTADD [=COND:vgb_addr=]		
			LEFT JOIN vgb_term ON idVGB_TERM = VGB_CUST_TERID [=COND:vgb_term=]
			LEFT JOIN vgb_curr ON idVGB_CURR = VGB_CUST_CURID [=COND:vgb_curr=]
			
			
			WHERE [=WHERE=] [=COND:vgb_bpar=][=ORDBY=] [=LIMIT=] ) t1
			 	
			 
		
EOD;

		return $trig;


	}

}

class var_items extends dbMaster
{
	function var_items($schema)
	{
		$this->dbMaster("vgb_bpar",$schema);
		
	}
	
	function dbFindMatch($dtaObj)
	{
  		
  		
  		$wTbls = new var_cust($this->tblInfo->schema);
		$wTbls->dbFindMatch($dtaObj);
		$E_POST = $dtaObj;

	
  		$wTblsVar = new var_oihe_items($this->tblInfo->schema);
  		$wTblsVar->dbFindMatch($dtaObj);
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
 		$wTbls->dbSuppTbl["var_open_items"] = $wTblsVar;
 		
 		

		if ($wTbls->errorCode == 0 && count($wTbls->result) > 0)
		{
	 		$wTblsBnk = new vgl_bank_info($this->tblInfo->schema);
	 		$objBnk = array();
	 		$objBnk["PROCESS"] = $E_POST["PROCESS"];
	 		$objBnk["SESSION"] = $E_POST["SESSION"];
	 		$objBnk["MAXREC_OUT"] = 0; // No limit
	 		$objBnk["idVGL_BANK"] = '0';
	 		$objBnk["vgl_filters"] = array();
	 		$objBnk["vgl_filters"]["CURID"] = $wTbls->result[0]["VGB_CUST_CURID"];
	 		$objBnk["vgl_filters"]["SOURC"] = "SALES";
	 		$wTblsBnk->dbFindFrom($objBnk);
	 		if (!$wTbls->dbSuppTbl)
	 		{
	 			$wTbls->dbSuppTbl = array();
	 		}
			$wTbls->dbSuppTbl["vgl_bank_info"] = $wTblsBnk;	
		}
		
		$vglObj = array();
		$vglObj["vgl_trnid"] = "";
		$commas = "";
		$occ = 0;
		while ($occ < count($wTblsVar->result))
		{
			$vglObj["vgl_trnid"] .= $commas . $wTblsVar->result[$occ]["VAR_OIHE_TRNID"];
			$commas = ",";
			$occ += 1;
		}
		if (strlen($vglObj["vgl_trnid"])>0)
		{
			$vglObj["PROCESS"] = $E_POST["PROCESS"];
			$vglObj["SESSION"] = $E_POST["SESSION"];
	 		$vglObj["MAXREC_OUT"] = 0; // No limit
	 		$vglObj["idVGL_JNHE"] = '0';
	 		$wTblsJrn = new vgl_journal($this->tblInfo->schema);
	 		$wTblsJrn->dbFindFrom($vglObj);
	 		if (!$wTbls->dbSuppTbl)
	 		{
	 			$wTbls->dbSuppTbl = array();
	 		}
			$wTbls->dbSuppTbl["vgl_journal"] = $wTblsJrn;	
		}	 		


		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}


	}	

}

class vgl_bank_info extends dbMaster
{
	function vgl_bank_info($schema)
	{
		$this->dbMaster("vgl_bank",$schema);
		
	}

	function dbSetTrig()
	{	
	
		$localWhere = "";
		
		if ($this->E_POST["vgl_filters"])
		{
			$localWhere = "";
			$and = "";
			if($this->E_POST["vgl_filters"]["CURID"])
			{
				$localWhere .= "VGL_BANK_CURID = '" . $this->E_POST["vgl_filters"]["CURID"] . "' ";
				$and = " AND ";
				
			}
			if($this->E_POST["vgl_filters"]["SOURC"])
			{
				$localWhere .= $and . "VGL_BANK_SOURC = '" . $this->E_POST["vgl_filters"]["SOURC"] . "' ";

			}
			if ($localWhere != "")
			{
				$localWhere = "( " . $localWhere . " ) AND ";
			}

		}
		
		$this->localWhere = $localWhere;	


$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgl_bank 
		
			
			WHERE {$localWhere} [=WHERE=] [=COND:vgl_bank=][=ORDBY=] [=LIMIT=] ) t1
			 	
			 
		
EOD;

		return $trig;
	}
}



    

class var_oihe extends dbMaster
{
	function var_oihe($schema)
	{
		$this->dbMaster("var_oihe",$schema);
		
	}
	
	function dbInsRec($dtaObj)
	{

		$this->dbFnct = "dbInsRec";
		$this->masterTranConn = $this->brTrConn;
		
		// If called from other process masterTranConn is not null true else false local rollback
		$externCall = true;
		if (!$this->masterTranConn)
		{
			$externCall = false;
		}
		$this->externCall = $externCall;

		$tFnc = new AB_querySession;
		$currUser = $tFnc->getUserData();
		$dtaObj["VAR_OIHE_USLNA"] = $currUser["userCode"];
		
		// Currency
		$wTblCurrency = new dbMaster("vgb_curr",$this->tblInfo->schema);
		$currObj = array();
		$currObj["idVGB_CURR"] = $dtaObj["VAR_OIHE_CURID"];
		$wTblCurrency->dbFindMatch($currObj);
		$currency = array();
		if (count($wTblCurrency->result) >0)
		{
			$currency["idVGB_CURR"] = $wTblCurrency->result[0]["idVGB_CURR"];
			$currency["VGB_CURR_CURAT"] = $wTblCurrency->result[0]["VGB_CURR_CURAT"];
		}
		
		// Terms
		$wTblTerm = new dbMaster("vgb_term",$this->tblInfo->schema);
		$termObj = array();
		$termObj["idVGB_TERM"] = $dtaObj["VAR_OIHE_TERID"];
		$wTblTerm->dbFindMatch($termObj);
		if (count($wTblTerm->result) >0)
		{
			$dtaObj["VAR_OIHE_NETDA"] = $wTblTerm->result[0]["VGB_TERM_NETDA"];
			$dtaObj["VAR_OIHE_DISDA"] = $wTblTerm->result[0]["VGB_TERM_DISDA"];
			$dtaObj["VAR_OIHE_DISCN"] = $wTblTerm->result[0]["VGB_TERM_DISCN"];
			
		}
		
		if ($externCall == false)
		{
			$this->dbMasterTransac();
			$this->errorCodeText = array();
			if ($this->transactionError > 0)
			{
				$this->errorCode = 9300;
				$this->errorCodeText[count($this->errorCodeText)] = "Transaction failed ";
				$this->errorCodeText[count($this->errorCodeText)] = "Could not connect ";
				return;
			}
		}


		$this->localE_POST = $dtaObj;
		
		$E_POST = $dtaObj;
		
		if ($E_POST["VAR_OIHE_OITTY"] != "INV")
		{
			unset($E_POST["idVAR_OIHE"]);
			$E_POST["VAR_OIHE_AMUNT"] = abs($E_POST["VAR_OIHE_AMUNT"]) * -1;
			$E_POST["VAR_OIHE_CUSPO"] = "";
			if ($E_POST["VAR_OIHE_OITTY"] == "CRN")
			{
				$E_POST["VAR_OIHE_CONNU"] = "";
				unset($E_POST["VAR_OIHE_BPBNK"]);
				unset($E_POST["VAR_OIHE_PMTDA"]);
				unset($E_POST["VAR_OIHE_BNKID"]);
			}
						
		}
		else
		{
			
			$E_POST["VAR_OIHE_AMUNT"] = abs($E_POST["VAR_OIHE_AMUNT"]) * 1;
			$E_POST["VAR_OIHE_CONNU"] = "";
		}
		
		$E_POST["VAR_OIHE_BALAN"] = $E_POST["VAR_OIHE_AMUNT"];
		$E_POST["VAR_OIHE_CURID"] = $currency["idVGB_CURR"];
		$E_POST["VAR_OIHE_CURAT"] = $currency["VGB_CURR_CURAT"];
					
		$insertId = 0;
		
		$nfnu = new vgl_getNextFreeNumber($this->tblInfo->schema,"VGL_TRJN_TRNID" ,$E_POST,$this->masterTranConn);
		$E_POST["VGL_JNHE_TRNID"] = $nfnu->vgl_nextNumber;
		
		if ($E_POST["VAR_OIHE_OITTY"] == "INV" || $E_POST["VAR_OIHE_OITTY"] == "CRN")
		{
			$nfnuVSL = new vgb_getNextFreeNumber($this->tblInfo->schema,"VAR_INVOICE" ,$E_POST,$this->masterTranConn);
			$E_POST["VAR_OIHE_INVOI"] = $nfnuVSL->vgb_nextNumber;
			$this->nfnuVSL = $nfnuVSL;
		}			
		
		$E_POST["paccTrans"] = array();
		$E_POST["paccTrans"]["VGL_JNHE_TRNID"] = $E_POST["VGL_JNHE_TRNID"];
		$E_POST["paccTrans"]["VGL_JNHE_DOCDA"] = $E_POST["VAR_OIHE_DOCDA"];
		$E_POST["paccTrans"]["VGL_JNHE_CURID"] = $E_POST["VAR_OIHE_CURID"];
		$E_POST["paccTrans"]["VGL_JNHE_CURAT"] = $E_POST["VAR_OIHE_CURAT"];
		$E_POST["paccTrans"]["VGL_JNHE_USLNA"] = $E_POST["VAR_OIHE_USLNA"];
		$E_POST["paccTrans"]["VGL_JNHE_PSOUR"] = $E_POST["VGL_JNHE_PSOUR"];
		
		// For step final update if source = VSL_INV
		$this->VGL_JNHE_TRNID = $E_POST["VGL_JNHE_TRNID"];
		$this->VAR_OIHE_INVOI = $E_POST["VAR_OIHE_INVOI"];
		
		if ($E_POST["VAR_OIHE_OITTY"] == "PMT")
		{
			//  Must be payment
			$paccAccounts = array();
			$E_POST["paccTrans"]["VGL_JNHE_PSOUR"] = "VAR_PAY";
			$paccAccounts["SALES_RECEV"] = $E_POST["VAR_OIHE_AMUNT"];
			$bankTbl = new dbMaster("vgl_bank",$this->tblInfo->schema);
			$bnkObj = array();
			$bnkObj["idVGL_BANK"] = $dtaObj["VAR_OIHE_BNKID"];
			$bankTbl->dbFindMatch($bnkObj);
			$paccAccounts["BANK"] = $bankTbl->result[0];
			$paccAccounts["BANK"]["GLAMT"] = $E_POST["VAR_OIHE_AMUNT"];
			$E_POST["paccAccounts"] = $paccAccounts;
		}
		
		$vgl_trans = new vgl_posting($this->tblInfo->schema);
		$vgl_trans->brTrConn = $this->masterTranConn;
		$vgl_trans->vgl_postTransaction($E_POST);
		$this->vgl_trans = $vgl_trans;
		$this->errorCode = $vgl_trans->errorCode;
		$this->errorCodeText = $vgl_trans->errorCodeText;
		
		if ($this->errorCode == 0 )
		{
			$wTbls = new dbMaster("var_oihe",$this->tblInfo->schema);
			$E_POST["VAR_OIHE_TRNID"] = $vgl_trans->insertId;
	 		$wTbls->brTrConn = $this->masterTranConn;
			$wTbls->dbInsRec($E_POST);
			$insertId = $wTbls->insertId; 
			foreach($wTbls as $name => $value)
			{
				 $this->$name = $value;
			}
			if ( $this->errorCode != 0  || $this->insertId == 0)
			{
				$this->errorCodeText[count($this->errorCodeText)] = "var_oihe:" . $jndeTbls->errorInfo;
				if ($this->errorCode == 0)
				{
					$this->errorCode = 11;
					$this->errorCodeText[count($this->errorCodeText)] = "var_oihe:" . " Could not insert " ;
				}
			}
	 	}
		
		$this->repairedE_POST = $E_POST;
		$this->E_RECSET = $E_POST["RECSET"];
		
		if ($externCall == false)
		{
			if ($this->errorCode == 0 )
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
		if ($this->errorCode == 0 && $dtaObj["VAR_DISTRIBUTE"] == "1")
		{
			$newRec = array();
			$newRec["idVAR_OIHE"] = $insertId;
			$newRec["VAR_OIHE_DOCDA"] = $dtaObj["VAR_OIHE_DOCDA"];
			$newRec["SELECT"] = '1';
			$newRec["ADJAMOUT"] = $E_POST["VAR_OIHE_AMUNT"];
			$newRec["VAR_OIHE_TRNID"] = $vgl_trans->insertId;
			$newRec["VAR_OIHE_OITTY"] = 'PMT';
			$newRec["VAR_OIHE_AMUNT"] = $E_POST["VAR_OIHE_AMUNT"];
			$newRec["VAR_OIHE_BALAN"] = $E_POST["VAR_OIHE_AMUNT"]; 
			$dtaObj["RECSET"][count($dtaObj["RECSET"])] = $newRec;
			$this->dbUpdRec($dtaObj);
		}
 		 		
	}
	
	
	function dbUpdRec($dtaObj)
	{

		$this->dbFnct = "dbUpdRec";
		$this->localE_POST = $dtaObj;
		
		// Get User
		$tFnc = new AB_querySession;
		$currUser = $tFnc->getUserData();
		$wTblCurrency = new dbMaster("vgb_curr",$this->tblInfo->schema);
		
		// Get Currency
		$currObj = array();
		$currObj["idVGB_CURR"] = $dtaObj["VAR_OIHE_CURID"];
		$wTblCurrency->dbFindMatch($currObj);
		$currency = array();
		if (count($wTblCurrency->result) >0)
		{
			$currency["idVGB_CURR"] = $wTblCurrency->result[0]["idVGB_CURR"];
			$currency["VGB_CURR_CURAT"] = $wTblCurrency->result[0]["VGB_CURR_CURAT"];
		}
		
		$this->dbMasterTransac();
		$this->errorCodeText = array();
		if ($this->transactionError > 0)
		{
			$this->errorCode = 9300;
			$this->errorCodeText[count($this->errorCodeText)] = "Transaction failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Could not connect ";
			return;
		}

		$nfnu = new vgl_getNextFreeNumber($this->tblInfo->schema,"VGL_TRJN_TRNID" ,$dtaObj,$this->masterTranConn);
		$dtaObj["VAR_OIHE_TRNID"] = $nfnu->vgl_nextNumber;
		

		$workRemain = 0;
		$dbObj = array();
		$dbObj["PROCESS"] = $dtaObj["PROCESS"];
		$dbObj["SESSION"] = $dtaObj["SESSION"];
		
		$wTblArr = array();
		
		
		$recSet = $dtaObj["RECSET"];
		$occ = 1; // Always ignore first occurence
		while ($occ < count($recSet) && $this->errorCode == 0)
		{
			if ($recSet[$occ]["SELECT"] > 0 && $recSet[$occ]["idVAR_OIHE"] > 0 && $recSet[$occ]["ADJAMOUT"]!=0)
			{
				$dbCount = count($wTblArr);
				$dbObj["idVAR_OIHE"] = $recSet[$occ]["idVAR_OIHE"];
				$wTblArr[$dbCount] = new dbMaster("var_oihe",$this->tblInfo->schema);
				
				$wTblArr[$dbCount]->dbFindMatch($dbObj);
				if (!$wTblArr[$dbCount]->result[0]["VAR_OIHE_BALAN"] 
					|| abs($wTblArr[$dbCount]->result[0]["VAR_OIHE_BALAN"] ) < abs($recSet[$occ]["ADJAMOUT"])
					|| abs($wTblArr[$dbCount]->result[0]["VAR_OIHE_BALAN"] * $recSet[$occ]["ADJAMOUT"]) <= 0)
				{
					$this->errorCode += 1;
				}
				else
				{
					$updObj = array();
					$updObj["PROCESS"] = $dtaObj["PROCESS"];
					$updObj["SESSION"] = $dtaObj["SESSION"];
					$updObj["idVAR_OIHE"] = $recSet[$occ]["idVAR_OIHE"];
					$updObj["VAR_OIHE_BALAN"] = $wTblArr[$dbCount]->result[0]["VAR_OIHE_BALAN"] - $recSet[$occ]["ADJAMOUT"];
					$dbCount = count($wTblArr);
					$wTblArr[$dbCount] = new dbMaster("var_oihe",$this->tblInfo->schema);
					
					$wTblArr[$dbCount]->brTrConn = $this->masterTranConn;
					$wTblArr[$dbCount]->dbUpdRec($updObj);
					$wTblArr[$dbCount]->brTrConn = null;
					$this->errorCode += $wTblArr[$dbCount]->errorCode;
					if ($this->errorCode == 0)
					{
						$workRemain += $recSet[$occ]["ADJAMOUT"];
						$insObj = array();
						$insObj["PROCESS"] = $dtaObj["PROCESS"];
						$insObj["SESSION"] = $dtaObj["SESSION"];
						$insObj["VAR_OIDE_OITID"] = $updObj["idVAR_OIHE"];
						$insObj["VAR_OIDE_TRNID"] = $dtaObj["VAR_OIHE_TRNID"];
						$insObj["VAR_OIDE_OITTY"] = "ADJ";
						$insObj["VAR_OIDE_TRNDA"] = $dtaObj["VAR_OIHE_DOCDA"];
						$insObj["VAR_OIDE_AMUNT"] = ($recSet[$occ]["ADJAMOUT"]*-1);
						$insObj["VAR_OIDE_CURID"] = $currency["idVGB_CURR"];
						$insObj["VAR_OIDE_CURAT"] = $currency["VGB_CURR_CURAT"];
						$insObj["VAR_OIDE_USLNA"] = $currUser["userCode"];						
						$dbCount = count($wTblArr);
						$wTblArr[$dbCount] = new dbMaster("var_oide",$this->tblInfo->schema);;
						
						$wTblArr[$dbCount]->brTrConn = $this->masterTranConn;
						$wTblArr[$dbCount]->dbInsRec($insObj);
						$wTblArr[$dbCount]->brTrConn = null;
						$this->errorCode += $wTblArr[$dbCount]->errorCode;
					}						
				}
					 
				
			}
			$occ += 1;
		}


		foreach($wTblArr[0] as $name => $value)
		{
			if ($name!="errorCode" && $name!="errorCodeText")
			{
				$this->$name = $value;
			}
		}
		$this->dbFnct = "dbUpdRec";
		
		if ($this->errorCode == 0 )
		{		
			$this->dbPdoEndTransac(true);
		}
		else
		{	
			$this->errorCode =+ 3000;	
			$this->dbPdoEndTransac(false);
			$this->errorCodeText[count($this->errorCodeText)] = "Insert Transaction Aborted ";
		}	

		
		$this->applyTrans = $wTblArr;
		
	}	

}



class var_financial extends dbMaster
{
	function var_financial($schema)
	{
		$this->dbMaster("var_oihe",$schema);
		
	}
	
	
	function var_sales($source,$dtaSet)
	{
		// Expecting
		// - vsl_orhe (Header) for Partner-Reference-Currency
		// - POST_DATE - Posting date
		// - TOTSALES Total of sales (Items)
		// - EXPCHARGED Expense Charged (Services)
		// - EXPBORNED Expense Not Charged (Services)
		// - TAXES (by state/province) (vtx_sche  + GLAMT
		// - AVGCOST (Total average cost Items)
		$this->postdtaSet = $dtaSet;
		$paccAccounts = array();
		

		// 1 Accounts Receivables A + B + D
		$paccAccounts["SALES_RECEV"] = $dtaSet["TOTSALES"]; // A
		$paccAccounts["SALES_RECEV"] += $dtaSet["EXPCHARGED"]; // B
		$occ = 0;
		while ($occ < count($dtaSet["TAXES"]))
		{
			$paccAccounts["SALES_RECEV"] += $dtaSet["TAXES"][$occ]["GLAMT"]; // D
			$occ += 1;
		}
		// 2 Sales
		$paccAccounts["SALES_REVENU"] = $dtaSet["TOTSALES"]; // A
		// 3 Expense Reimburse
		$paccAccounts["EXPENSE_REIM"] = $dtaSet["EXPCHARGED"]; // B
		// 4 Tax Payable
		$paccAccounts["TAXES"] = $dtaSet["TAXES"];
//		$paccAccounts["TAXES"] = array();
//		$occ = 0;
//		while ($occ < count($dtaSet["TAXES"]))
//		{
//			$paccAccounts["TAXES"][$occ] = $dtaSet["TAXES"][$occ]; // D
//			$occ += 1;
//		}
		// 5 Cost of Sale
		$paccAccounts["COST_SALES"] = $dtaSet["AVGCOST"]; // E
		// 6 Provisional Expense
		$paccAccounts["PROV_EXPENSE"] = $dtaSet["EXPBORNED"]; // C

		// 7 Inventory
		$paccAccounts["INVENTORY"] = $dtaSet["AVGCOST"]; // E
		// 8 Expense Accrual
		$paccAccounts["ACCR_EXPENSE"] = $dtaSet["EXPBORNED"]; // C
		
		$objIns = array();
		$objIns["VGL_JNHE_PSOUR"] = $source;
		$objIns["VAR_OIHE_BCUST"] = $dtaSet["vsl_orhe"]["VSL_ORHE_BTCUS"];
		$objIns["VAR_OIHE_BTADD"] = $dtaSet["vsl_orhe"]["VSL_ORHE_BTADD"];
		if ($paccAccounts["SALES_RECEV"] >= 0)
		{
			$objIns["VAR_OIHE_OITTY"] = "INV";
		}
		else
		{
			$objIns["VAR_OIHE_OITTY"] = "CRN";
		}
		
		$objIns["VAR_OIHE_DOCDA"] = $dtaSet["POST_DATE"];
		$objIns["VAR_OIHE_TERID"] = $dtaSet["vsl_orhe"]["VSL_ORHE_TERID"];
		$objIns["VAR_OIHE_AMUNT"] = $paccAccounts["SALES_RECEV"];
		$objIns["VAR_OIHE_CURID"] = $dtaSet["vsl_orhe"]["VSL_ORHE_CURID"];
		$objIns["VAR_OIHE_BALAN"] = $paccAccounts["SALES_RECEV"];
		$objIns["VAR_OIHE_CUSPO"] = $dtaSet["vsl_orhe"]["VSL_ORHE_CUSPO"];
		$objIns["VAR_OIHE_REFER"] = $dtaSet["vsl_orhe"]["VSL_ORHE_ORNUM"];

//		$this->mytrans = $this->brTrConn;
//		return;

		
		$objIns["PROCESS"] = "VAR_FINANCE";
		$objIns["SESSION"] = "VAR_OITEMCT";
		$objIns["paccAccounts"] = $paccAccounts;
		$varTbl = new var_oihe($this->tblInfo->schema);
		$varTbl->brTrConn = $this->brTrConn;
		$varTbl->dbInsRec($objIns);

		foreach($varTbl as $name => $value)
		{
			 $this->$name = $value;
		}

		
	}
	
}


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

		$trig = $this->buildTotalTrigger($objDta);
		
		$tFnc = new AB_querySession;
		$trig = $tFnc->tblAccessCond($objDta,$trig,true,"onaccess,onaccess.USR");
		
		$dta = array();
		$dtaType = array();
		
		$dta["agingDate"] = $objDta["agingDate"];
		$dtaType["agingDate"] = PDO::PARAM_STR;
		
			
		
	  	$ageTbls = new dbMaster("var_oihe",$this->tblInfo->schema);
		//$ageTbls->dbProcessTransactionPdo($trig);
		$ageTbls->dbPdoPrep($trig,$dta,$dtaType);		
		
		$occ = 0;
		while ($occ < count($ageTbls->result))
		{
			$this->result[count($this->result)] = $ageTbls->result[$occ];
			$occ +=1;
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
		,VGB_CURR_DESCR
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
		,VGB_CURR_DESCR
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
			,VGB_CURR_DESCR
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
		WHERE  VAR_OIHE_DOCDA < :agingDate
			{$cust}
			AND (VAR_OIDE_TRNDA < :agingDate OR VAR_OIDE_TRNDA IS NULL)  [=COND:var_oihe=]
			
			
 

		GROUP BY VAR_OIHE_BCUST, idVAR_OIHE
		HAVING balance != 0) x
	) y
	GROUP BY VGB_CUST_BPNAM
    
UNION
    
SELECT  
		VGB_CUST_BPNAM
		,idVGB_CUST
		,VGB_CURR_DESCR
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
		,VGB_CURR_DESCR
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
	WHERE VAR_OIHE_DOCDA < :agingDate
		{$cust}
		AND (VAR_OIDE_TRNDA < :agingDate OR VAR_OIDE_TRNDA IS NULL) [=COND:var_oihe=]
	GROUP BY VAR_OIHE_BCUST, idVAR_OIHE
	HAVING balance != 0) x
ORDER BY VGB_CUST_BPNAM, invoice;


	
EOC;

		return $trig;
	}
	
	function buildTotalTrigger($objDta)
	{
	
		if (count($objDta["custFilter"]) > 0)
		{
			$cust = " AND '," . implode(",",$objDta["custFilter"]) . ",' ";
			$cust .= "LIKE CONCAT('%,',idVGB_CUST,',%') ";
		}
		$trig =<<<EOC
		
SELECT
		VGB_CURR_CURID as VGB_CUST_BPNAM
		,(@ab:=0) as idVGB_CUST
		,VGB_CURR_DESCR
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
		(@aa:='rpt_total') as VGB_CUST_BPNAM
		,idVGB_CUST
		,VGB_CURR_DESCR
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
			(@aa:='rpt_total') as VGB_CUST_BPNAM
			,idVGB_CUST
			,VGB_CURR_DESCR
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
		WHERE  VAR_OIHE_DOCDA < :agingDate
			{$cust}
			AND (VAR_OIDE_TRNDA < :agingDate OR VAR_OIDE_TRNDA IS NULL)  [=COND:var_oihe=]
			
			
 

		GROUP BY VAR_OIHE_BCUST, idVAR_OIHE
		HAVING balance != 0) x
	) y
	GROUP BY VGB_CUST_BPNAM,VGB_CURR_CURID

EOC;

		return $trig;
	}
		
	
}




require_once "VGB_PARTNERS.php";
require_once "VGB_GETNFNU.php";
require_once "VGL_FINANCE.php";

?>