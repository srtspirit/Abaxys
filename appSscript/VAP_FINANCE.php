<?php



class vap_purch extends dbMaster
{

	function vap_purch($schema)
	{
		$this->dbMaster("vap_oihe",$schema);
		
	}

	function dbSetTrig()
	{

		$localWhere = "";
		// $this->E_POST = $_SESSION["lastPost"];
		
		if ($this->E_POST["vap_idList"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["vap_idList"]);
			if(count($wClause)>0)
			{
				$localWhere = " ( ";
				$orVal = "";
				$occ = 0;
				while ($occ < count($wClause))
				{
					$localWhere .= $orVal . "idVAP_OIHE = '" . $wClause[$occ] . "' ";
					$orVal = " OR  ";
					$occ += 1;
				} 

				$localWhere .= " ) AND ";

			}

		}

// ((vpu.VPU_ORDE_OUNET_REV*1) * (vpu.VPU_ORST_ORDQT_REV*1) / (vpu.VPU_ORDE_FACTO*1)).toFixed(2)
		
		$this->localWhere = $localWhere;
		

$trig = <<<EOD
			SELECT *,
			(@aa:= ROUND(VPU_ORDE_OUNET * VPU_ORST_ORDQT / GREATEST(VPU_ORDE_FACTO,1),2)) as EXTENTION  FROM
			 
		 	( SELECT * FROM vap_oihe 

			
			
			LEFT JOIN vpu_orsi ON VAP_OIHE_INVOI = VPU_ORSI_GRPID AND VPU_ORSI_STEPS = 'JJ_INVO' [=COND:vpu_orsi=]
			LEFT JOIN vpu_orst ON VPU_ORST_WINVO = idVPU_ORSI [=COND:vpu_orst=]
			LEFT JOIN vpu_orde ON VPU_ORST_ORLIN = idVPU_ORDE [=COND:vpu_orde=]
			LEFT JOIN vin_item ON VPU_ORDE_ITMID = idVIN_ITEM [=COND:vin_item=]
			LEFT JOIN vpu_orhe ON VPU_ORST_ORNUM = idVPU_ORHE [=COND:vpu_orhe=]
			LEFT JOIN vgb_addr  ON idVGB_ADDR = VPU_ORHE_STADD  [=COND:vgb_addr=] 
			LEFT JOIN vtx_schh  ON idVTX_SCHH = VGB_ADDR_SCHID  [=COND:vtx_schh=] 
			LEFT JOIN vtx_sche  ON VTX_SCHE_SCHID = idVTX_SCHH  [=COND:vtx_sche=] 
			
			WHERE $localWhere [=WHERE=] [=COND:vap_oihe=][=ORDBY=] [=LIMIT=] ) t1
			 	
			 
		
EOD;

		return $trig;


	}

}


class vap_payment extends dbMaster
{

	function vap_payment($schema)
	{
		$this->dbMaster("vap_oihe",$schema);
		
	}

	function dbFindMatch($dtaObj)
	{
  		
  		
  		$wTbls = new vap_oihe_pmt($this->tblInfo->schema);
		$wTbls->dbFindMatch($dtaObj);
		$E_POST = $dtaObj;
		
 	
 		$amtWord = new abAmountWords;
			
 		$oiheObj = array();
 		$oiheRecSet = array();
 		$objList = "x";
		$occ = 0;
		while ($occ < count($wTbls->result))
		{
			$wTbls->result[$occ]["amtWord"] = $amtWord->evalAmt(abs($wTbls->result[$occ]["VAP_OIHE_AMUNT"]));
			if (strpos($objList,"," . $wTbls->result[$occ]["VAP_OIDE_TRNID"] . "," ) < 1)
			{
				$objList .= "," . $wTbls->result[$occ]["VAP_OIDE_TRNID"] . ",";
				$oiheObj["VAP_OIDE_TRNID"] = $wTbls->result[$occ]["VAP_OIDE_TRNID"];
				$oiheRead = new vap_oide($this->tblInfo->schema);
				$oiheRead->dbFindMatch($oiheObj);
				$wocc = 0;
				while ($wocc < count($oiheRead->result))
				{
					$oiheRecSet[count($oiheRecSet)] = $oiheRead->result[$wocc];
					$wocc += 1;
				}
			}
			$occ += 1;
		}
		
		if (count($oiheRecSet) > 0)
		{
			$oiheRead->result = $oiheRecSet;
	 		if (!$this->dbSuppTbl)
	 		{
	 			$this->dbSuppTbl = array();
	 		}
	 		$this->dbSuppTbl["vap_oihe_paid"] = $oiheRead;			
		}		
 		
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}

 		if (!$this->dbSuppTbl)
 		{
 			$this->dbSuppTbl = array();
 		}
 		$this->dbSuppTbl["vap_oihe_pmt"] = $wTbls;
 		
	}	
 		
}





class vap_oihe_pmt extends dbMaster
{
	function vap_oihe_pmt($schema)
	{
		$this->dbMaster("vap_oihe",$schema);
		
	}

	
	function dbSetTrig()
	{



		$localWhere = "";
		$orderBy = "";
		
		if ($this->E_POST["checkRun"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["checkRun"]);
			if(count($wClause)>0)
			{
				$localWhere = " ( ";
				$orVal = "";
				$occ = 0;
				while ($occ < count($wClause))
				{
					$localWhere .= $orVal . "VAP_OIHE_CHKID = '" . $wClause[$occ] . "' ";
					$orVal = " OR  ";
					$occ += 1;
				} 

				$localWhere .= " ) AND ";

			}
			
			$orderBy = " ORDER BY VAP_OIHE_CHKID ASC ";

		}
		
		
		$this->localWhere = $localWhere;



$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vap_oihe 
			
			LEFT JOIN vgb_supp ON idVGB_SUPP = VAP_OIHE_BSUPP [=COND:vgb_supp=]
			LEFT JOIN vgb_addr ON idVGB_ADDR = VAP_OIHE_BTADD [=COND:vgb_addr=]
			LEFT JOIN vgb_prst ON idVGB_PRST = VGB_ADDR_PRSID [=COND:vgb_prst=]
			LEFT JOIN vgl_bank ON idVGL_BANK = VAP_OIHE_BNKID [=COND:vgl_bank=]			
			LEFT JOIN vap_oide ON idVAP_OIHE = VAP_OIDE_OITID [=COND:vap_oide=]			
			
			WHERE $localWhere [=WHERE=] [=COND:vap_oihe=] $orderBy [=LIMIT=] ) t1
			 	
			 
		
EOD;

		return $trig;


	}

}
	

class vap_oihe_items extends dbMaster
{
	function vap_oihe_items($schema)
	{
		$this->dbMaster("vgb_bpar",$schema);
		
	}

	
	function dbSetTrig()
	{


$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT *  FROM vgb_bpar 

			
			
			LEFT JOIN vgb_supp ON VGB_SUPP_BPART = idVGB_BPAR [=COND:vgb_supp=]
			LEFT JOIN vap_oihe ON VAP_OIHE_BSUPP = idVGB_SUPP [=COND:vap_oihe=]
			LEFT JOIN vap_oihe_itm ON VAP_OIHE_ITM_OITID = idVAP_OIHE [=COND:vap_oihe_itm=]
			LEFT JOIN vin_item ON VAP_OIHE_ITM_ITMID = idVIN_ITEM [=COND:vin_item=]
			LEFT JOIN vgl_jnhe ON idVGL_JNHE = VAP_OIHE_TRNID [=COND:vgl_jnhe=]			
			LEFT JOIN vap_oide ON idVAP_OIHE = VAP_OIDE_OITID [=COND:vap_oide=]			
			
			WHERE [=WHERE=] [=COND:vgb_bpar=][=ORDBY=] [=LIMIT=] ) t1
			 	
			 
		
EOD;

		return $trig;


	}

}

class vap_supp extends dbMaster
{
	function vap_supp($schema)
	{
		$this->dbMaster("vgb_bpar",$schema);
		
	}

	


	function dbSetTrig()
	{


$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgb_bpar 

			
			LEFT JOIN vgb_supp ON VGB_SUPP_BPART = idVGB_BPAR [=COND:vgb_supp=]
			LEFT JOIN vgb_addr ON idVGB_ADDR = VGB_SUPP_BTADD [=COND:vgb_addr=]		
			LEFT JOIN vgb_term ON idVGB_TERM = VGB_SUPP_TERID [=COND:vgb_term=]
			LEFT JOIN vgb_curr ON idVGB_CURR = VGB_SUPP_CURID [=COND:vgb_curr=]
			
			
			WHERE [=WHERE=] [=COND:vgb_bpar=][=ORDBY=] [=LIMIT=] ) t1
			 	
			 
		
EOD;

		return $trig;


	}

}





class vap_items extends dbMaster
{
	function vap_items($schema)
	{
		$this->dbMaster("vgb_bpar",$schema);
		
	}
	
	function dbFindMatch($dtaObj)
	{
  		
  		
  		$wTbls = new vap_supp($this->tblInfo->schema);
		$wTbls->dbFindMatch($dtaObj);
		$E_POST = $dtaObj;

	
  		$wTblsVar = new vap_oihe_items($this->tblInfo->schema);
  		$wTblsVar->dbFindMatch($dtaObj);
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
 		$wTbls->dbSuppTbl["vap_open_items"] = $wTblsVar;
 		
		if ($wTbls->errorCode == 0 && count($wTbls->result) > 0)
		{
	 		$wTblsBnk = new vgl_bank_info($this->tblInfo->schema);
	 		$objBnk = array();
	 		$objBnk["PROCESS"] = $E_POST["PROCESS"];
	 		$objBnk["SESSION"] = $E_POST["SESSION"];
	 		$objBnk["MAXREC_OUT"] = 0; // No limit
	 		$objBnk["idVGL_BANK"] = '0';
	 		$objBnk["vgl_filters"] = array();
	 		$objBnk["vgl_filters"]["CURID"] = $wTbls->result[0]["VGB_SUPP_CURID"];
	 		$objBnk["vgl_filters"]["SOURC"] = "PURCH";
	 		$wTblsBnk->dbFindFrom($objBnk);
	 		if (!$wTbls->dbSuppTbl)
	 		{
	 			$wTbls->dbSuppTbl = array();
	 		}
			$wTbls->dbSuppTbl["vgl_bank_info"] = $wTblsBnk;	
		}

		// General Ledger
		$vglObj = array();
		$vglObj["vgl_trnid"] = "";
		$commas = "";
		$occ = 0;
		while ($occ < count($wTblsVar->result))
		{
			$vglObj["vgl_trnid"] .= $commas . $wTblsVar->result[$occ]["VAP_OIHE_TRNID"];
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

		// Purchases
		$vpuObj = array();
		$vpuObj["vap_idList"] = "";
		$commas = "";
		$occ = 0;
		while ($occ < count($wTblsVar->result))
		{
			if ($wTblsVar->result[$occ]["VAP_OIHE_TRTYP"] != "STD" )
			{
				$vpuObj["vap_idList"] .= $commas . $wTblsVar->result[$occ]["idVAP_OIHE"];
				$commas = ",";
			}
			$occ += 1;
		}
		
		if (strlen($vpuObj["vap_idList"])>0)
		{
			$vpuObj["PROCESS"] = $E_POST["PROCESS"];
			$vpuObj["SESSION"] = $E_POST["SESSION"];
	 		$vpuObj["MAXREC_OUT"] = 0; // No limit
	 		$vpuObj["idVAP_OIHE"] = '0';
	 		$wTblsVpu = new vap_purch($this->tblInfo->schema);
	 		$wTblsVpu->dbFindFrom($vpuObj);
	 		if (!$wTbls->dbSuppTbl)
	 		{
	 			$wTbls->dbSuppTbl = array();
	 		}
			$wTbls->dbSuppTbl["vpu_purch"] = $wTblsVpu;	
		}	 	


				
		$wTblsTax = new vgl_taxscheme($this->tblInfo->schema);
 		$objTax = array();
 		$objTax["PROCESS"] = $E_POST["PROCESS"];
 		$objTax["SESSION"] = $E_POST["SESSION"];
 		$objTax["idVTX_SCHH"] = $wTbls->result[0]["VGB_ADDR_PCHID"]; 
 		$wTblsTax->dbFindMatch($objTax);
	 	
 		if (!$wTbls->dbSuppTbl)
 		{
 			$wTbls->dbSuppTbl = array();
 		}
		$wTbls->dbSuppTbl["vgl_taxscheme"] = $wTblsTax;		 		
		
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



class vap_banks extends dbMaster
{
	// Payment Banks
	function vap_banks($schema)
	{
		$this->dbMaster("vgl_bank",$schema);
		
	}
	
	function dbSetTrig()
	{
		

$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgl_bank 

			
			
			LEFT JOIN vgb_curr ON idVGB_CURR = VGL_BANK_CURID [=COND:vgb_curr=]
			
			WHERE [=WHERE=] [=COND:vgl_bank=][=ORDBY=] [=LIMIT=] ) t1
			 	
			 
		
EOD;

		return $trig;		
	}
	
}

class vap_checks extends dbMaster
{
	// Payment Vouchers
	function vap_checks($schema)
	{
		$this->dbMaster("vap_oide",$schema);
		
	}
	
	function dbFindMatch($dtaObj)
	{
		
		$chkr = array();
		$chkr[0] = "217";
		$chkr[1] = "218";
		$chkr[2] = "219";
		$this->setCheckRun($chkr);
	}
	
	function dbUpdRec($dtaObj)
	{

		$this->dbFnct = "dbUpdRec";
		$this->localE_POST = $dtaObj;
		
		$this->timeStp = $this->getDateTimeStamp();
		
		
		
		// Get User
		$tFnc = new AB_querySession;
		$currUser = $tFnc->getUserData();
		$wTblCurrency = new dbMaster("vgb_curr",$this->tblInfo->schema);
		
		// Get Currency
		$currObj = array();
		$currObj["idVGB_CURR"] = $dtaObj["CURRENCYID"];
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


		$this->ignored = array();
		
		$VAP_OIHE_CHKID = $dtaObj['VGL_BANK_NEXCK'] * 1;
		$occ = $dtaObj["ignored"] * 1;
		while ($occ > 0 && $dtaObj["cancelTransaction"] != 1)
		{
			
			$payObj = array();
			$payObj["PROCESS"] = $dtaObj["PROCESS"];
			$payObj["SESSION"] = $dtaObj["SESSION"];
			
			
			$payObj["VGL_PAYCTRL_SOURC"] = "PURCH";
			$payObj["VGL_PAYCTRL_PMTTY"] = $dtaObj["currentBank.VGL_BANK_PMTTY"];
			$payObj["VGL_PAYCTRL_TYDET"] = $dtaObj["currentBank.VGL_BANK_TYDET"];
			$payObj["VGL_PAYCTRL_CURID"] = $dtaObj["currentBank.VGL_BANK_CURID"]; 

			$payObj["VGL_PAYCTRL_CTRLN"] = $VAP_OIHE_CHKID - $occ;
			
			$payObj["VGL_PAYCTRL_AMOUNT"] = "0";
			$payObj["VGL_PAYCTRL_STATUS"] = "SKIPPED";
			$payObj["VGL_PAYCTRL_REFER"] = $dtaObj["ignore_refer"]; 
			$payObj["VGL_PAYCTRL_CDATE"] =  $this->timeStp;
			$payObj["VGL_PAYCTRL_USLNA"] = $currUser["userCode"];
			
			$payctrl = new dbMaster("vgl_payctrl",$this->tblInfo->schema);
			
			$payctrl->brTrConn = $this->masterTranConn;
			$payctrl->dbInsRec($payObj);

			$this->ignored[count($this->ignored)] = $payctrl;
			
			$occ = $occ - 1;
		}

		$workRemain = 0;
		$dbObj = array();
		$dbObj["PROCESS"] = $dtaObj["PROCESS"];
		$dbObj["SESSION"] = $dtaObj["SESSION"];
		
		$wTblArr = array();
		
		$this->payctrl = array();
		
		
		$checkRun = array();
		
		$recSet = $dtaObj["RECSET"];
		$occ = 1; // Always ignore first occurence
		while ($occ < count($recSet) && $this->errorCode == 0)
		{
			if ($recSet[$occ]["SELECT"] > 0 && $recSet[$occ]["idVAP_OIHE"] > 0 && $recSet[$occ]["VAP_OIHE_AMUNT"]!=0)
			{


				$updObj = array();
				$updObj["PROCESS"] = $dtaObj["PROCESS"];
				$updObj["SESSION"] = $dtaObj["SESSION"];
				$updObj["idVAP_OIHE"] = $recSet[$occ]["idVAP_OIHE"];
				
				if ($dtaObj["cancelTransaction"] == 1)
				{
					$updObj["VAP_OIHE_APPROVED"] = "0";
					$updObj["VAP_OIHE_APPRBY"] = $currUser["userCode"];
					$updObj["VAP_OIHE_APPRDATE"] = $this->timeStp;					

				}
				else
				{
					$updObj["VAP_OIHE_CHKID"] = $VAP_OIHE_CHKID;
					
					$updObj["VAP_OIHE_ISSUED"] = "1";
					$updObj["VAP_OIHE_ISSUEDBY"] = $currUser["userCode"];
					$updObj["VAP_OIHE_ISSUEDDATE"] = $this->timeStp;
				}
				
				
				$dbCount = count($wTblArr);
				$wTblArr[$dbCount] = new dbMaster("vap_oihe",$this->tblInfo->schema);
				
				$wTblArr[$dbCount]->brTrConn = $this->masterTranConn;
				$wTblArr[$dbCount]->dbUpdRec($updObj);
				$wTblArr[$dbCount]->brTrConn = null;
				$this->errorCode += $wTblArr[$dbCount]->errorCode;
				$this->errorCodeText = $wTblArr[$dbCount]->errorCodeText;

				if ($this->errorCode == 0 && $dtaObj["cancelTransaction"] != 1)
				{
						
					$payObj = array();
					$payObj["PROCESS"] = $dtaObj["PROCESS"];
					$payObj["SESSION"] = $dtaObj["SESSION"];
					
					$payObj["VGL_PAYCTRL_SOURC"] = "PURCH";
					$payObj["VGL_PAYCTRL_PMTTY"] = $dtaObj["currentBank.VGL_BANK_PMTTY"];
					$payObj["VGL_PAYCTRL_TYDET"] = $dtaObj["currentBank.VGL_BANK_TYDET"];
					$payObj["VGL_PAYCTRL_CURID"] = $dtaObj["currentBank.VGL_BANK_CURID"]; 
		
					$payObj["VGL_PAYCTRL_CTRLN"] = $VAP_OIHE_CHKID;
					
					$payObj["VGL_PAYCTRL_AMOUNT"] =  $recSet[$occ]["VAP_OIHE_AMUNT"];
					$payObj["VGL_PAYCTRL_STATUS"] = "OUTSTD";
					$payObj["VGL_PAYCTRL_CDATE"] =  $this->timeStp;
					$payObj["VGL_PAYCTRL_USLNA"] = $currUser["userCode"];
					$payctrl = new dbMaster("vgl_payctrl",$this->tblInfo->schema);
				
					$payctrl->brTrConn = $this->masterTranConn;
					$payctrl->dbInsRec($payObj);
					
					$this->payctrl[count($this->payctrl)] = $payctrl;
				}
				
				$checkRun[count($checkRun)] = $VAP_OIHE_CHKID;
				$VAP_OIHE_CHKID += 1;
						 
				
			}
			
			$occ += 1;
		}

		if ($wTblArr && $this->errorCode == 0 )
		{
			foreach($wTblArr[0] as $name => $value)
			{
				if ($name!="errorCode" && $name!="errorCodeText")
				{
					$this->$name = $value;
				}
			}

			if ($dtaObj["cancelTransaction"] != 1)
			{
				$bnkObj = array();
				$bnkObj["PROCESS"] = $dtaObj["PROCESS"];
				$bnkObj["SESSION"] = $dtaObj["SESSION"];
				
				$bnkObj["idVGL_BANK"] = $dtaObj["currentBank.idVGL_BANK"];
				$bnkObj["VGL_BANK_NEXCK"] = $VAP_OIHE_CHKID;
				$bnkctrl = new dbMaster("vgl_bank",$this->tblInfo->schema);
				$bnkctrl->brTrConn = $this->masterTranConn;
				$bnkctrl->dbUpdRec($bnkObj);
				
				$this->bnkctrl = $bnkctrl;
			}
			
		}
		
		$this->dbFnct = "dbUpdRec";
		
		if ($this->errorCode == 0 )
		{		
			$this->dbPdoEndTransac(true);

			if ($dtaObj["cancelTransaction"] != 1)
			{

				$this->setCheckRun($checkRun);
			}
			
		}
		else
		{	
			$this->errorCode =+ 3000;	
			$this->dbPdoEndTransac(false);
			$this->errorCodeText[count($this->errorCodeText)] = "Insert Transaction Aborted ";
		}	

		
		$this->applyTrans = $wTblArr;
		
	}
	
	function setCheckRun($checkRun)
	{
		 // Returns check numbers succesfully updated 
		if (count($checkRun) > 0)
		{
			$this->checkRun = array();
			
			$chkr = implode(",",$checkRun);
			$runObj = array();
			$runObj["PROCESS"] = $dtaObj["PROCESS"];
			$runObj["SESSION"] = $dtaObj["SESSION"];
			$runObj["MAXREC_OUT"] = 0; // No limit
			$runObj["TBLNAME"] = "vap_oihe";
			$runObj["idVAP_OIHE"] = "0";
			
			$runObj["checkRun"] = $chkr;
			
	 		$runTbls = new vap_oihe_pmt($this->tblInfo->schema);
			$runTbls->dbFindFrom($runObj);
			
			
			$paidRun = "";
			$separator = "";
			
			$amtWord = new abAmountWords;
			 		
			$occ = 0;
			while ($occ < count($runTbls->result) )
			{

				$oiheId = $runTbls->result[$occ]["VAP_OIDE_TRNID"];

				$runTbls->result[$occ]["amtWord"] = $amtWord->evalAmt(abs($runTbls->result[$occ]["VAP_OIHE_AMUNT"]));	
				
				if (strpos("x," . $paidRun . "," , "," . $oiheId . "," ) < 1)
				{
					$paidRun .= $separator . $oiheId;
					$separator = ",";
				}
					
				$occ += 1;
			}			

			$this->checkRun[0] = $runTbls->result;
			

			$paidObj = array();
			$paidObj["PROCESS"] = $dtaObj["PROCESS"];
			$paidObj["SESSION"] = $dtaObj["SESSION"];
			$paidObj["MAXREC_OUT"] = 0; // No limit
			$paidObj["TBLNAME"] = "vap_oide";
			$paidObj["idVAP_OIDE"] = "0";
			
			$paidObj["paidRun"] = $paidRun;
			
	 		$paidTbls = new vap_oide($this->tblInfo->schema);
			$paidTbls->dbFindFrom($paidObj);	
			$this->checkRun[1] = $paidTbls->result;		
			
		}
		
	}
}


class vap_outstanding extends dbMaster
{
	// Payment Approval
	function vap_outstanding($schema)
	{
		$this->dbMaster("vap_oide",$schema);
		
	}
	
	function dbUpdRec($dtaObj)
	{

		$this->dbFnct = "dbUpdRec";
		$this->localE_POST = $dtaObj;
		$this->timeStp = $this->getDateTimeStamp();
		
		// Get User
		$tFnc = new AB_querySession;
		$currUser = $tFnc->getUserData();
		
		
		$this->dbMasterTransac();
		$this->errorCodeText = array();
		if ($this->transactionError > 0)
		{
			$this->errorCode = 9300;
			$this->errorCodeText[count($this->errorCodeText)] = "Transaction failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Could not connect ";
			return;
		}

		$dbObj = array();
		$dbObj["PROCESS"] = $dtaObj["PROCESS"];
		$dbObj["SESSION"] = $dtaObj["SESSION"];
		
		$wTblArr = array();
		$recSet = $dtaObj["RECSET"];
		$occ = 1; // Always ignore first occurence
		while ($occ < count($recSet) && $this->errorCode == 0)
		{
			if ($recSet[$occ]["SELECT"] > 0 && $recSet[$occ]["idVAP_OIHE"] > 0 && $recSet[$occ]["VAP_OIHE_AMUNT"]!=0)
			{
				$updObj = array();
				$updObj["PROCESS"] = $dtaObj["PROCESS"];
				$updObj["SESSION"] = $dtaObj["SESSION"];
				$updObj["idVAP_OIHE"] = $recSet[$occ]["idVAP_OIHE"];

				if ($dtaObj["cancelTransaction"] == 1)
				{	
					$updObj["VAP_OIHE_PSTAT"] = "OUTSTD";
				}
				else
				{
					$updObj["VAP_OIHE_PSTAT"] = "RECONC";
				}
				
				$dbCount = count($wTblArr);
				$wTblArr[$dbCount] = new dbMaster("vap_oihe",$this->tblInfo->schema);
				
				$wTblArr[$dbCount]->brTrConn = $this->masterTranConn;
				$wTblArr[$dbCount]->dbUpdRec($updObj);
				$wTblArr[$dbCount]->brTrConn = null;
				$this->errorCode += $wTblArr[$dbCount]->errorCode;
				$this->errorCodeText = $wTblArr[$dbCount]->errorCodeText;
				
				
			}
			
			$occ += 1;
		}
		
		if ($wTblArr && $this->errorCode == 0 )
		{
			foreach($wTblArr[0] as $name => $value)
			{
				if ($name!="errorCode" && $name!="errorCodeText")
				{
					$this->$name = $value;
				}
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


class vap_approval extends dbMaster
{
	// Payment Approval
	function vap_approval($schema)
	{
		$this->dbMaster("vap_oide",$schema);
		
	}
	
	function dbUpdRec($dtaObj)
	{

		$this->dbFnct = "dbUpdRec";
		$this->localE_POST = $dtaObj;
		$this->timeStp = $this->getDateTimeStamp();
		
		// Get User
		$tFnc = new AB_querySession;
		$currUser = $tFnc->getUserData();
		
		
		$this->dbMasterTransac();
		$this->errorCodeText = array();
		if ($this->transactionError > 0)
		{
			$this->errorCode = 9300;
			$this->errorCodeText[count($this->errorCodeText)] = "Transaction failed ";
			$this->errorCodeText[count($this->errorCodeText)] = "Could not connect ";
			return;
		}

		$dbObj = array();
		$dbObj["PROCESS"] = $dtaObj["PROCESS"];
		$dbObj["SESSION"] = $dtaObj["SESSION"];
		
		$wTblArr = array();
		
		$this->cancelList = array();
		
		$recSet = $dtaObj["RECSET"];
		$occ = 1; // Always ignore first occurence
		while ($occ < count($recSet) && $this->errorCode == 0)
		{
			if ($recSet[$occ]["SELECT"] > 0 && $recSet[$occ]["idVAP_OIHE"] > 0 && $recSet[$occ]["VAP_OIHE_AMUNT"]!=0)
			{
				

				$updObj = array();
				$updObj["PROCESS"] = $dtaObj["PROCESS"];
				$updObj["SESSION"] = $dtaObj["SESSION"];
				$updObj["idVAP_OIHE"] = $recSet[$occ]["idVAP_OIHE"];
	
				if ($dtaObj["cancelTransaction"] == 1)
				{
					$this->vap_approvalCancel($recSet[$occ],$dtaObj);

					$updObj["VAP_OIHE_PSTAT"] = "CANCEL";
					// $updObj["VAP_OIHE_BALAN"] = "0";
				}
				else
				{
					$updObj["VAP_OIHE_APPROVED"] = "1";
					$updObj["VAP_OIHE_APPRBY"] = $currUser["userCode"];
					$updObj["VAP_OIHE_APPRDATE"] = $this->timeStp;
				}
				
				$dbCount = count($wTblArr);
				$wTblArr[$dbCount] = new dbMaster("vap_oihe",$this->tblInfo->schema);
				
				$wTblArr[$dbCount]->brTrConn = $this->masterTranConn;
				$wTblArr[$dbCount]->dbUpdRec($updObj);
				$wTblArr[$dbCount]->brTrConn = null;
				$this->errorCode += $wTblArr[$dbCount]->errorCode;
				$this->errorCodeText = $wTblArr[$dbCount]->errorCodeText;
				
				
			}
			
			$occ += 1;
		}

		$this->cancelListCount = count($this->cancelList);
		$this->vap_approvalCancelExec();
		
		
		if ($wTblArr && $this->errorCode == 0 )
		{
			foreach($wTblArr[0] as $name => $value)
			{
				if ($name!="errorCode" && $name!="errorCodeText")
				{
					$this->$name = $value;
				}
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
	
	function vap_approvalCancel($record,$dtaObj)
	{
		
		$rec = $record["RECSET"];
		$recList = "x,";
		
		$occ = 0;
		while ($occ < count($rec) && $this->errorCode == 0)
		{
			if ($rec[$occ]["idVAP_OIDE"] && strpos($recList,",".$rec[$occ]["idVAP_OIDE"],",") < 1)
			{
				$recList .= $rec[$occ]["idVAP_OIDE"] . ",";

				$readObj = array();
				$readObj["PROCESS"] = $dtaObj["PROCESS"];
				$readObj["SESSION"] = $dtaObj["SESSION"];
				$readObj["idVAP_OIDE"] = $rec[$occ]["idVAP_OIDE"];
				
				$xTblOIDE = new dbMaster("vap_oide",$this->tblInfo->schema);
				$xTblOIDE->dbFindMatch($readObj);
				
				if (!$this->cancelList[$xTblOIDE->result[0]["VAP_OIDE_OITID"]])
				{
					$this->cancelList[$xTblOIDE->result[0]["VAP_OIDE_OITID"]] = 0;
				}
				
				$this->cancelList[$xTblOIDE->result[0]["VAP_OIDE_OITID"]] += ($xTblOIDE->result[0]["VAP_OIDE_AMUNT"] * -1);
				
				$delObj = array();
				$delObj["PROCESS"] = $dtaObj["PROCESS"];
				$delObj["SESSION"] = $dtaObj["SESSION"];
				$delObj["idVAP_OIDE"] = $rec[$occ]["idVAP_OIDE"];
				$wTblOIDE = new dbMaster("vap_oide",$this->tblInfo->schema);
				$wTblOIDE->brTrConn = $this->masterTranConn;
				$wTblOIDE->dbDelRec($delObj);
				$wTblOIDE->brTrConn = null;
				$this->errorCode += $wTblOIDE->errorCode;
				$this->errorCodeText = $wTblOIDE->errorCodeText;					
				
			}
			$occ += 1;
		}

		
		
	}
	

	function vap_approvalCancelExec()
	{
		$this->cancelListExe = array();
		$this->cancelListTrig = "";

		if (count($this->cancelList)>0 && $this->errorCode == 0 )
		{
			$trig = "";
			
			foreach($this->cancelList as $name => $value)
			{
$trig = <<<EOC

			UPDATE vap_oihe SET VAP_OIHE_BALAN = VAP_OIHE_BALAN + {$value}  WHERE idVAP_OIHE = {$name};	

EOC;

				$tblOIHE = new dbMaster("vap_oihe",$this->tblInfo->schema);
				$tblOIHE->brTrConn = $this->masterTranConn;
				$this->cancelListExe[count($this->cancelListExe)] = $tblOIHE->dbProcessTransactionPdo($trig);
				$this->cancelListTrig .= $trig;

			}
			
			
			
		}
		

	}
	

}

class vap_paypost extends dbMaster
{
	// Payment Posting
	function vap_paypost($schema)
	{
		$this->dbMaster("vap_oide",$schema);
		
	}
	
	function dbUpdRec($dtaObj)
	{

		$this->dbFnct = "dbUpdRec";
		$this->localE_POST = $dtaObj;
		$this->timeStp = $this->getDateTimeStamp();
		
		// Get User
		$tFnc = new AB_querySession;
		$currUser = $tFnc->getUserData();
		$wTblCurrency = new dbMaster("vgb_curr",$this->tblInfo->schema);
		
		// Get Currency
		$currObj = array();
		$currObj["idVGB_CURR"] = $dtaObj["CURRENCYID"];
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

		
		if ($dtaObj["cancelTransaction"] != 1)
		{
			$nfnu = new vgl_getNextFreeNumber($this->tblInfo->schema,"VGL_TRJN_TRNID" ,$dtaObj,$this->masterTranConn);
			$VGL_JNHE_TRNID = $nfnu->vgl_nextNumber * 1;
		}

		$workRemain = 0;
		$dbObj = array();
		$dbObj["PROCESS"] = $dtaObj["PROCESS"];
		$dbObj["SESSION"] = $dtaObj["SESSION"];
		
		$wTblArr = array();
		
		
		$recSet = $dtaObj["RECSET"];
		$occ = 1; // Always ignore first occurence
		while ($occ < count($recSet) && $this->errorCode == 0 && $dtaObj["cancelTransaction"] != 1)
		{
			if ($recSet[$occ]["SELECT"] > 0 && $recSet[$occ]["idVAP_OIHE"] > 0 && $recSet[$occ]["VAP_OIHE_AMUNT"]!=0)
			{
				
				$ePost = array();
				$ePost["PROCESS"] = $dtaObj["PROCESS"];
				$ePost["SESSION"] = $dtaObj["SESSION"];

				// $nfnu = new vgl_getNextFreeNumber($this->tblInfo->schema,"VGL_TRJN_TRNID" ,$dtaObj,$this->masterTranConn);
				// $ePost["VGL_JNHE_TRNID"] = $nfnu->vgl_nextNumber;
				$ePost["VGL_JNHE_TRNID"] = $VGL_JNHE_TRNID;

				$ePost["paccTrans"] = array();
				$ePost["paccTrans"]["VGL_JNHE_TRNID"] = $ePost["VGL_JNHE_TRNID"];
				$ePost["paccTrans"]["VGL_JNHE_DOCDA"] = $dtaObj["POSTDATE"];
				$ePost["paccTrans"]["VGL_JNHE_CURID"] = $currency["idVGB_CURR"];
				$ePost["paccTrans"]["VGL_JNHE_CURAT"] = $currency["VGB_CURR_CURAT"];
				$ePost["paccTrans"]["VGL_JNHE_USLNA"] = $currUser["userCode"];
				$ePost["paccTrans"]["VGL_JNHE_PSOUR"] = "VAP_PAY";
		

				//  Must be payment
				$paccAccounts = array();
				$paccAccounts["PURCH_PAYABLE"] = $recSet[$occ]["VAP_OIHE_AMUNT"];
				$bankTbl = new dbMaster("vgl_bank",$this->tblInfo->schema);
				$bnkObj = array();
				$bnkObj["idVGL_BANK"] = $dtaObj["BANKID"];
				$bankTbl->dbFindMatch($bnkObj);
				$paccAccounts["BANK"] = $bankTbl->result[0];
				$paccAccounts["BANK"]["GLAMT"] = $recSet[$occ]["VAP_OIHE_AMUNT"];
				$ePost["paccAccounts"] = $paccAccounts;

				$vgl_trans = new vgl_posting($this->tblInfo->schema);
				$vgl_trans->brTrConn = $this->masterTranConn;
				$vgl_trans->vgl_postTransaction($ePost);
				$this->vgl_trans = $vgl_trans;
				$this->errorCode = $vgl_trans->errorCode;
				$this->errorCodeText = $vgl_trans->errorCodeText;
				
				$VGL_JNHE_TRNID += 1;		


				if ($this->errorCode == 0 && $vgl_trans->insertId > 0)
				{

					$updObj = array();
					$updObj["PROCESS"] = $dtaObj["PROCESS"];
					$updObj["SESSION"] = $dtaObj["SESSION"];
					$updObj["idVAP_OIHE"] = $recSet[$occ]["idVAP_OIHE"];
	
					$updObj["VAP_OIHE_POSTED"] = "1";
					$updObj["VAP_OIHE_POSTEDBY"] = $currUser["userCode"];
					$updObj["VAP_OIHE_POSTEDDATE"] = $this->timeStp;
					
					$updObj["VAP_OIHE_TRNID"] = $vgl_trans->insertId;
	
					
					$dbCount = count($wTblArr);
					$wTblArr[$dbCount] = new dbMaster("vap_oihe",$this->tblInfo->schema);
					
					$wTblArr[$dbCount]->brTrConn = $this->masterTranConn;
					$wTblArr[$dbCount]->dbUpdRec($updObj);
					$wTblArr[$dbCount]->brTrConn = null;
					$this->errorCode += $wTblArr[$dbCount]->errorCode;
					$this->errorCodeText = $wTblArr[$dbCount]->errorCodeText;
					
					
						 
				}
				
			}
			
			$occ += 1;
		}

		if ($dtaObj["cancelTransaction"] == 1)
		{
			$this->vap_paypostCancel($dtaObj,$currUser);
		}
		
		if ($wTblArr && $this->errorCode == 0 )
		{
			foreach($wTblArr[0] as $name => $value)
			{
				if ($name!="errorCode" && $name!="errorCodeText")
				{
					$this->$name = $value;
				}
			}
			
			if ($dtaObj["cancelTransaction"] != 1)
			{
				$dtaObj["NEXTFREENUMBER"] = $VGL_JNHE_TRNID;
				$nfnu = new vgl_setNextFreeNumber($this->tblInfo->schema,"VGL_TRJN_TRNID" ,$dtaObj,$this->masterTranConn);
				$this->vgl_nfnu = $nfnu;
				$this->vgl_nfnuNEXTFREENUMBER = $dtaObj["NEXTFREENUMBER"];
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
	
	function vap_paypostCancel($dtaObj,$currUser)
	{
		$recSet = $dtaObj["RECSET"];
		$occ = 1; // Always ignore first occurence
		while ($occ < count($recSet) && $this->errorCode == 0)
		{
			if ($recSet[$occ]["SELECT"] > 0 && $recSet[$occ]["idVAP_OIHE"] > 0 && $recSet[$occ]["VAP_OIHE_AMUNT"]!=0)
			{


				$readObj = array();
				$readObj["PROCESS"] = $dtaObj["PROCESS"];
				$readObj["SESSION"] = $dtaObj["SESSION"];
				$readObj["idVAP_OIHE"] = $recSet[$occ]["idVAP_OIHE"];
				$wTblRead = new dbMaster("vap_oihe",$this->tblInfo->schema);
				$wTblRead->dbFindMatch($readObj);
				

				$updObj = array();
				$updObj["PROCESS"] = $dtaObj["PROCESS"];
				$updObj["SESSION"] = $dtaObj["SESSION"];
				$updObj["idVAP_OIHE"] = $recSet[$occ]["idVAP_OIHE"];
				
				$updObj["VAP_OIHE_ISSUED"] = "0";
				$updObj["VAP_OIHE_ISSUEDBY"] = $currUser["userCode"];
				$updObj["VAP_OIHE_ISSUEDDATE"] = $this->timeStp;
				$updObj["VAP_OIHE_CHKID"] = "0";					
				
				$dbCount = count($wTblArr);
				$wTblArr = new dbMaster("vap_oihe",$this->tblInfo->schema);
				
				$wTblArr->brTrConn = $this->masterTranConn;
				$wTblArr->dbUpdRec($updObj);
				$wTblArr->brTrConn = null;
				$this->errorCode += $wTblArr->errorCode;
				$this->errorCodeText = $wTblArr->errorCodeText;

				if ($this->errorCode == 0)
				{
					$readPay = array();
					$readPay["PROCESS"] = $dtaObj["PROCESS"];
					$readPay["SESSION"] = $dtaObj["SESSION"];
					$readPay["VGL_PAYCTRL_SOURC"] = "PURCH";
					$readPay["VGL_PAYCTRL_PMTTY"] = $dtaObj["currentBank.VGL_BANK_PMTTY"];
					$readPay["VGL_PAYCTRL_TYDET"] = $dtaObj["currentBank.VGL_BANK_TYDET"];
					$readPay["VGL_PAYCTRL_CURID"] = $dtaObj["currentBank.VGL_BANK_CURID"]; 					
					$readPay["VGL_PAYCTRL_CTRLN"] = $wTblRead->result[0]["VAP_OIHE_CHKID"];
					$wTblPay = new dbMaster("vgl_payctrl",$this->tblInfo->schema);
					$wTblPay->dbFindMatch($readPay);
				
					$payObj = array();
					$payObj["PROCESS"] = $dtaObj["PROCESS"];
					$payObj["SESSION"] = $dtaObj["SESSION"];
					
					$payObj["idVGL_PAYCTRL"] = $wTblPay->result[0]["idVGL_PAYCTRL"];
					$payObj["VGL_PAYCTRL_STATUS"] = "CANCEL";
					$payObj["VGL_PAYCTRL_STATUSBY"] = $currUser["userCode"];
					$payObj["VGL_PAYCTRL_STATUSDATE"] = $this->timeStp;
					$payObj["VGL_PAYCTRL_REFER"] = $dtaObj["ignore_refer"]; 
					
					$payctrl = new dbMaster("vgl_payctrl",$this->tblInfo->schema);
					$payctrl->brTrConn = $this->masterTranConn;
					$payctrl->dbUpdRec($payObj);
					
				}
				
			}
			
			$occ += 1;
		}		
	}
	
}

class vap_oide extends dbMaster
{
	function vap_oide($schema)
	{
		$this->dbMaster("vap_oide",$schema);
		
	}


	function dbSetTrig()
	{	

		$localWhere = "";
		
		
		if ($this->E_POST["paidRun"])
		{
			$localWhere = "";
			$wClause = explode(",",$this->E_POST["paidRun"]);
			if(count($wClause)>0)
			{
				$localWhere = " ( ";
				$orVal = "";
				$occ = 0;
				while ($occ < count($wClause))
				{
					$localWhere .= $orVal . "VAP_OIDE_TRNID = '" . $wClause[$occ] . "' ";
					$orVal = " OR  ";
					$occ += 1;
				} 

				$localWhere .= " ) AND ";

			}
			
		}		


$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vap_oide 
		
			LEFT JOIN vap_oihe ON idVAP_OIHE = VAP_OIDE_OITID [=COND:vap_oihe=]
			WHERE $localWhere [=WHERE=] [=COND:vap_oide=] $orderBy [=LIMIT=] ) t1
			 	
			 
		
EOD;

		return $trig;
	}
		
}

class vap_oihe extends dbMaster
{
	function vap_oihe($schema)
	{
		$this->dbMaster("vap_oihe",$schema);
		
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
		$dtaObj["VAP_OIHE_USLNA"] = $currUser["userCode"];		
		
		// Local or Booking post data
		$this->ePost = array();
		$this->ePost["VAP_OIHE_BSUPP"] = $dtaObj["VAP_OIHE_BSUPP"];
		$this->ePost["VAP_OIHE_BTADD"] = $dtaObj["VAP_OIHE_BTADD"];
		$this->ePost["VAP_OIHE_OITTY"] = $dtaObj["VAP_OIHE_OITTY"];
		$this->ePost["VAP_OIHE_CURID"] = $dtaObj["VAP_OIHE_CURID"];
		$this->ePost["VAP_OIHE_CURAT"] = $dtaObj["VAP_OIHE_CURAT"];
		$this->ePost["VAP_OIHE_DOCDA"] = $dtaObj["VAP_OIHE_DOCDA"];
		$this->ePost["VAP_OIHE_AMUNT"] = $dtaObj["VAP_OIHE_AMUNT"];
		$this->ePost["VAP_OIHE_AMUNT"] = $dtaObj["VAP_OIHE_AMUNT"];
		$this->ePost["VAP_OIHE_USLNA"] = $dtaObj["VAP_OIHE_USLNA"];
		$this->ePost["VAP_BOOKING"] = $dtaObj["VAP_BOOKING"];
		
		$this->postingDetail = array();
		
		$this->rSet = array();
		$recs = $dtaObj["RECSET"];
		$occ = 1;
		while ($occ < count($recs))
		{
			if ($recs[$occ]["SELECT"] == "1")
			{
				$xocc = count($this->rSet);
				$this->rSet[$xocc] = array();
				$this->rSet[$xocc]["idVAP_OIHE"] = $recs[$occ]["idVAP_OIHE"];
				$this->rSet[$xocc]["NEWPOST"] = $recs[$occ]["NEWPOST"];
				$this->rSet[$xocc]["VAP_OIHE_DOCDA"] = $recs[$occ]["VAP_OIHE_DOCDA"];
				$this->rSet[$xocc]["VAP_OIHE_TRNID"] = $recs[$occ]["VAP_OIHE_TRNID"];
				$this->rSet[$xocc]["VAP_OIHE_AMUNT"] = $recs[$occ]["VAP_OIHE_AMUNT"];
				$this->rSet[$xocc]["idVTX_SCHH"] = $recs[$occ]["vpu.idVTX_SCHH"];
				
				$this->rSet[$xocc]["VREC"] = array();
				$subRec = $recs[$occ]["RECSET"];
				// You are here
				$wocc = 0;
				while ($wocc < count($subRec))
				{
					$wlist = "";
					$wcomma = "";
					foreach($subRec[$wocc] as $name => $value)
					{
						 $wlist .= $wcomma . $name;
						 $wcomma = ",";
					}
					$wls = explode(",",$wlist);
					if (count($wls) > 1)
					{
						if ($subRec[$wocc]["idVIN_ITEM"] && $subRec[$wocc]["idVIN_ITEM"] > 0)
						{
							$vrecCount = count($this->rSet[$xocc]["VREC"]);
							
							$this->rSet[$xocc]["VREC"][$vrecCount]["newItem"] = $subRec[$wocc]["newItem"];
							$this->rSet[$xocc]["VREC"][$vrecCount]["idVIN_ITEM"] = $subRec[$wocc]["idVIN_ITEM"];
							$this->rSet[$xocc]["VREC"][$vrecCount]["VPU_ORDE_DESCR"] = $subRec[$wocc]["VPU_ORDE_DESCR"];
							$this->rSet[$xocc]["VREC"][$vrecCount]["VIN_ITEM_INVIT"] = $subRec[$wocc]["VIN_ITEM_INVIT"];
							$this->rSet[$xocc]["VREC"][$vrecCount]["VPU_ORST_ORDQT"] = $subRec[$wocc]["VPU_ORST_ORDQT_REV"];
							$this->rSet[$xocc]["VREC"][$vrecCount]["VPU_ORDE_OUNET"] = $subRec[$wocc]["VPU_ORDE_OUNET_REV"];
							$this->rSet[$xocc]["VREC"][$vrecCount]["ext"] = $subRec[$wocc]["ext"];
							$this->rSet[$xocc]["VREC"][$vrecCount]["VPU_ORST_ORDQT_ORG"] = $subRec[$wocc]["VPU_ORST_ORDQT_ORG"];
							$this->rSet[$xocc]["VREC"][$vrecCount]["VPU_ORDE_OUNET_ORG"] = $subRec[$wocc]["VPU_ORDE_OUNET_ORG"];
							$this->rSet[$xocc]["VREC"][$vrecCount]["ext_ORG"] = $subRec[$wocc]["ext_ORG"];
							$this->rSet[$xocc]["VREC"][$vrecCount]["VIN_ITEM_ITTXT"] = $subRec[$wocc]["VIN_ITEM_ITTXT"];
							$this->rSet[$xocc]["VREC"][$vrecCount]["VPU_ORDE_OLTYP"] = $subRec[$wocc]["VPU_ORDE_OLTYP"];
						}
					}	
					
					$wocc += 1;
				}				
				
			}	
			
			$occ += 1;
		}
		
		$this->localE_POST = $dtaObj;
//		if ($dtaObj["VAP_OIHE_OITTY"] != "PMT" && $externCall == false)
//		{
//			$this->localPosting(0);
//			return;
//		}
		// Local or Booking post data		
		

		
		// Currency
		$wTblCurrency = new dbMaster("vgb_curr",$this->tblInfo->schema);
		$currObj = array();
		$currObj["idVGB_CURR"] = $dtaObj["VAP_OIHE_CURID"];
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
		$termObj["idVGB_TERM"] = $dtaObj["VAP_OIHE_TERID"];
		$wTblTerm->dbFindMatch($termObj);
		if (count($wTblTerm->result) >0)
		{
			$dtaObj["VAP_OIHE_NETDA"] = $wTblTerm->result[0]["VGB_TERM_NETDA"];
			$dtaObj["VAP_OIHE_DISDA"] = $wTblTerm->result[0]["VGB_TERM_DISDA"];
			$dtaObj["VAP_OIHE_DISCN"] = $wTblTerm->result[0]["VGB_TERM_DISCN"];
			
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
		
		if ($E_POST["VAP_OIHE_OITTY"] != "INV")
		{
			unset($E_POST["idVAP_OIHE"]);
			$E_POST["VAP_OIHE_AMUNT"] = abs($E_POST["VAP_OIHE_AMUNT"]) * -1;
			$E_POST["VAP_OIHE_CUSPO"] = "";
			if ($E_POST["VAP_OIHE_OITTY"] == "CRN")
			{
				$E_POST["VAP_OIHE_CONNU"] = "";
				unset($E_POST["VAP_OIHE_BPBNK"]);
				unset($E_POST["VAP_OIHE_PMTDA"]);
				unset($E_POST["VAP_OIHE_BNKID"]);
			}
						
		}
		else
		{
			$E_POST["VAP_OIHE_BPBNK"] = "8"; // REM AC 20170615 What is 8 = Partner Bank ID
			unset($E_POST["idVAP_OIHE"]);
			unset($E_POST["VAP_OIHE_BPBNK"]);
			unset($E_POST["VAP_OIHE_PMTDA"]);
			unset($E_POST["VAP_OIHE_BNKID"]);
			$E_POST["VAP_OIHE_AMUNT"] = abs($E_POST["VAP_OIHE_AMUNT"]);
			$E_POST["VAP_OIHE_CONNU"] = "";
		}
		
		$E_POST["VAP_OIHE_BALAN"] = $E_POST["VAP_OIHE_AMUNT"];
		$E_POST["VAP_OIHE_CURID"] = $currency["idVGB_CURR"];
		$E_POST["VAP_OIHE_CURAT"] = $currency["VGB_CURR_CURAT"];
					
		$insertId = 0;
		

		if ($E_POST["VAP_OIHE_OITTY"] == "INV" || $E_POST["VAP_OIHE_OITTY"] == "CRN")
		{
			$nfnu = new vgl_getNextFreeNumber($this->tblInfo->schema,"VGL_TRJN_TRNID" ,$E_POST,$this->masterTranConn);
			$E_POST["VGL_JNHE_TRNID"] = $nfnu->vgl_nextNumber;
			$this->vgl_nfnu = $nfnu->vgl_nextNumberWR;

			$nfnu = new vgb_getNextFreeNumber($this->tblInfo->schema,"VAP_INVOICE" ,$E_POST,$this->masterTranConn);
			$E_POST["VAP_OIHE_INVOI"] = $nfnu->vgb_nextNumber;
			$this->vgb_nfnu = $nfnu->vgb_nextNumberWR;
		}

		$E_POST["paccTrans"] = array();
		$E_POST["paccTrans"]["VGL_JNHE_TRNID"] = $E_POST["VGL_JNHE_TRNID"];
		$E_POST["paccTrans"]["VGL_JNHE_DOCDA"] = $E_POST["VAP_OIHE_DOCDA"];
		$E_POST["paccTrans"]["VGL_JNHE_CURID"] = $E_POST["VAP_OIHE_CURID"];
		$E_POST["paccTrans"]["VGL_JNHE_CURAT"] = $E_POST["VAP_OIHE_CURAT"];
		$E_POST["paccTrans"]["VGL_JNHE_USLNA"] = $E_POST["VAP_OIHE_USLNA"];
		$E_POST["paccTrans"]["VGL_JNHE_PSOUR"] = $E_POST["VGL_JNHE_PSOUR"];
		
		// For step final update if source = VPU_INV
		$this->VGL_JNHE_TRNID = $E_POST["VGL_JNHE_TRNID"];
		$this->VAP_OIHE_INVOI = $E_POST["VAP_OIHE_INVOI"];

		if ($E_POST["VAP_OIHE_OITTY"] == "PMT")
		{
			//  Must be payment
//				$paccAccounts = array();
//				$E_POST["paccTrans"]["VGL_JNHE_PSOUR"] = "VAP_PAY";
//				$paccAccounts["PURCH_PAYABLE"] = $E_POST["VAP_OIHE_AMUNT"];
//				$bankTbl = new dbMaster("vgl_bank",$this->tblInfo->schema);
//				$bnkObj = array();
//				$bnkObj["idVGL_BANK"] = $dtaObj["VAP_OIHE_BNKID"];
//				$bankTbl->dbFindMatch($bnkObj);
//				$paccAccounts["BANK"] = $bankTbl->result[0];
//				$paccAccounts["BANK"]["GLAMT"] = $E_POST["VAP_OIHE_AMUNT"];
//				$E_POST["paccAccounts"] = $paccAccounts;
		}
		else
		{	
			
			if ($externCall == false)
			{
				// Local or Booking post data
				$E_POST["paccTrans"]["VGL_JNHE_PSOUR"] = "VAP_INV";
				$E_POST["paccAccounts"] = $this->localPosting($this->masterTranConn);
				
			}
			$vgl_trans = new vgl_posting($this->tblInfo->schema);
			$vgl_trans->brTrConn = $this->masterTranConn;
			$vgl_trans->vgl_postTransaction($E_POST);
			$this->vgl_trans = $vgl_trans;
			$this->errorCode = $vgl_trans->errorCode;
			$this->errorCodeText = $vgl_trans->errorCodeText;			
		}
			
		

		
		if ($this->errorCode == 0 )
		{
			$wTbls = new dbMaster("vap_oihe",$this->tblInfo->schema);
			$E_POST["VAP_OIHE_TRNID"] = $vgl_trans->insertId;
	 		$wTbls->brTrConn = $this->masterTranConn;
			$wTbls->dbInsRec($E_POST);
			$insertId = $wTbls->insertId; 
			foreach($wTbls as $name => $value)
			{
				 $this->$name = $value;
			}
			
			if ( $this->errorCode != 0  || $this->insertId == 0)
			{
				$this->errorCodeText[count($this->errorCodeText)] = "vap_oihe:" . $jndeTbls->errorInfo;
				$this->errorEPOST = $E_POST;
				if ($this->errorCode == 0)
				{
					$this->errorCode = 11;
					$this->errorCodeText[count($this->errorCodeText)] = "vap_oihe:" . " Could not insert " ;
				}
			}
			
			
		  	if ($this->ePost["VAP_BOOKING"] == "1")
		  	{

				$bookSet = $this->rSet;
				$occ = 0;
				while ($occ <  count($bookSet) && $externCall == false && $this->errorCode == 0)
				{
		 			if ($bookSet[$occ]["NEWPOST"] == "0" && $this->masterTranConn != 0)
		 			{
		 				$updObj = array();
		 				$updObj["PROCESS"] = $this->localE_POST["PROCESS"];
						$updObj["SESSION"] = $this->localE_POST["SESSION"];				
		 				$updObj["idVAP_OIHE"] = $bookSet[$occ]["idVAP_OIHE"];
		 				$updObj["VAP_OIHE_BOOKID"] = $insertId;
			 			$wTblvap_oihe = new dbMaster("vap_oihe",$this->tblInfo->schema);
			 			$wTblvap_oihe->brTrConn = $this->masterTranConn;
			 			$wTblvap_oihe->dbUpdRec($updObj);
			 		}
			 		$occ += 1;
			 	}
			}
 						
			
	 	}
	
		$this->repairedE_POST = $E_POST;
		$this->E_RECSET = $E_POST["RECSET"];

		if ($this->errorCode == 0 && $dtaObj["VAP_DISTRIBUTE"] == "1")
		{
			$newRec = array();
			$newRec["idVAP_OIHE"] = $insertId;
			$newRec["VAP_OIHE_DOCDA"] = $dtaObj["VAP_OIHE_DOCDA"];
			$newRec["SELECT"] = '1';
			$newRec["ADJAMOUT"] = $E_POST["VAP_OIHE_AMUNT"];
			$newRec["VAP_OIHE_TRNID"] = $vgl_trans->insertId;
			$newRec["VAP_OIHE_OITTY"] = 'PMT';
			$newRec["VAP_OIHE_AMUNT"] = $E_POST["VAP_OIHE_AMUNT"];
			$newRec["VAP_OIHE_BALAN"] = $E_POST["VAP_OIHE_AMUNT"]; 
			$dtaObj["RECSET"][count($dtaObj["RECSET"])] = $newRec;
			$this->dbUpdRec($dtaObj);
		}		
		
		if ($this->postingDetail && count($this->postingDetail)>0)
		{
			$this->rpoUpd = array();
			$occ = 0;
			while ($occ <  count($this->postingDetail))
			{
				$newRec = array();
				$newRec["PROCESS"] = $dtaObj["PROCESS"];
				$newRec["SESSION"] = $dtaObj["SESSION"];
				if($this->ePost["VAP_BOOKING"] == "1")
				{
					$newRec["VAP_OIHE_ITM_OITID"] = $this->postingDetail[$occ]["idVAP_OIHE"];
				}
				else
				{
					$newRec["VAP_OIHE_ITM_OITID"] = $insertId;
				}
				

				$newRec["VAP_OIHE_ITM_ITMID"] = $this->postingDetail[$occ]["idVIN_ITEM"];
				$newRec["VAP_OIHE_ITM_DESCR"] = $this->postingDetail[$occ]["VPU_ORDE_DESCR"];
				$newRec["VAP_OIHE_ITM_ORDQT"] = $this->postingDetail[$occ]["VPU_ORST_ORDQT"];
				$newRec["VAP_OIHE_ITM_OUNET"] = $this->postingDetail[$occ]["VPU_ORDE_OUNET"];
				$newRec["VAP_OIHE_ITM_EXTEN"] = $this->postingDetail[$occ]["ext"];

				$newRec["VAP_OIHE_ITM_ORDQT_ORG"] = $this->postingDetail[$occ]["VPU_ORST_ORDQT_ORG"];
				$newRec["VAP_OIHE_ITM_OUNET_ORG"] = $this->postingDetail[$occ]["VPU_ORDE_OUNET_ORG"];
				$newRec["VAP_OIHE_ITM_EXTEN_ORG"] = $this->postingDetail[$occ]["ext_ORG"];
				
	 			$wTblrpo_oihe = new dbMaster("vap_oihe_itm",$this->tblInfo->schema);
	 			$wTblrpo_oihe->brTrConn = $this->masterTranConn;
	 			$wTblrpo_oihe->dbInsRec($newRec);				
	 			$this->rpoUpd[count($this->rpoUpd)] = $wTblrpo_oihe;


				
				$occ += 1;
			}
		}
		
		// $this->errorCode = 11;
		
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


 		
	}
	
	
	function localPosting($matrco)
	{
		// $this->ePost
		
		
		
		$recSet = $this->rSet;
		$paccAccount = array();
		$paccAccount[0]["VGL_JNHE_PSOUR"] = "VAP_INV";
		$paccAccount[0]["PURCH_PAYABLE"] = 0;
	 	$paccAccount[0]["PURCH_EXPENSE"] = 0;
	 	$paccAccount[0]["EXPENSE_REIM"] = 0;
	 	$paccAccount[0]["VARIANCE"] = 0;
	  	$paccAccount[0]["COST_SALES"] = 0;
	  	$paccAccount[0]["PROV_EXPENSE"] = 0;
	  	$paccAccount[0]["INVENTORY"] = 0;
	  	$paccAccount[0]["ACCR_EXPENSE"] = 0;
	  	$paccAccount[0]["TAXES"] = array();
	  	if ($this->ePost["VAP_BOOKING"] == "1")
	  	{
			$paccAccount[1]["VGL_JNHE_PSOUR"] = "VPU_INV";
			$paccAccount[1]["PURCH_PAYABLE"] = 0;
		 	$paccAccount[1]["PURCH_EXPENSE"] = 0;
		 	$paccAccount[1]["EXPENSE_REIM"] = 0;
		 	$paccAccount[1]["VARIANCE"] = 0;
		  	$paccAccount[1]["COST_SALES"] = 0;
		  	$paccAccount[1]["PROV_EXPENSE"] = 0;
		  	$paccAccount[1]["INVENTORY"] = 0;
		  	$paccAccount[1]["ACCR_EXPENSE"] = 0;
		  	$paccAccount[1]["TAXES"] = array();
	  	}

		$PURCH_PAYABLE = array();
		$PURCH_PAYABLE[0] = 0;
		$PURCH_PAYABLE[1] = 0;
 
		$EXPENSE_REIM = array();
		$EXPENSE_REIM[0] = 0;
		$EXPENSE_REIM[1] = 0;
			
		$VARIANCE = array();
		$VARIANCE[0] = 0;
		$VARIANCE[1] = 0;

		$INVENTORY = array();
		$INVENTORY[0] = 0;
		$INVENTORY[1] = 0;
		
		$TAXES = array();
		$TAXES[0] = array();
		$TAXES[1] = array();
	  	
	  	$occ = 0;
	  	while ($occ < count($recSet))
	  	{
	  		$taxObj = array();
	  		$taxObj["idVTX_SCHH"] = $recSet[$occ]["idVTX_SCHH"];
	  		$taxScheme = new vgl_taxscheme($this->tblInfo->schema);
 	 		$taxScheme->dbFindMatch($taxObj);
 			$taxRecSet = $taxScheme->result;
 			
 			if ($recSet[$occ]["NEWPOST"] == "0" && $matrco!=0)
 			{
 				$updObj = array();
 				$updObj["PROCESS"] = $this->localE_POST["PROCESS"];
				$updObj["SESSION"] = $this->localE_POST["SESSION"];				
 				$updObj["idVAP_OIHE"] = $recSet[$occ]["idVAP_OIHE"];
 				$updObj["VAP_OIHE_TRTYP"] = "BOOKED";
 				$updObj["VAP_OIHE_BALAN"] = "0";
	 			$wTblvap_oihe = new dbMaster("vap_oihe",$this->tblInfo->schema);
	 			$wTblvap_oihe->brTrConn = $matrco;
	 			$wTblvap_oihe->dbUpdRec($updObj);
	 		}
 			
 			
 			$taxable = array();
 			$taxable[0] = 0;
 			$taxable[1] = 0;
			
			$taxRecSet = $this->initTaxAmt($taxRecSet);
		
			
	  		$wocc = 0;
		  	while ($wocc < count($recSet[$occ]["VREC"]))
		  	{
		  		$recSet[$occ]["VREC"][$wocc]["idVAP_OIHE"] = $recSet[$occ]["idVAP_OIHE"];
		  		$this->postingDetail[count($this->postingDetail)] = $recSet[$occ]["VREC"][$wocc];
		  		if ($recSet[$occ]["VREC"][$wocc]["VIN_ITEM_ITTXT"] != "NOTAX")
		  		{
		  			$taxable[0] += ($recSet[$occ]["VREC"][$wocc]["ext"]*1);
		  			if ($this->ePost["VAP_BOOKING"]=="1" && $recSet[$occ]["VREC"][$wocc]["newItem"]!="1")
		  			{
		  				$taxable[1] += ($recSet[$occ]["VREC"][$wocc]["ext_ORG"]*1);
		  			}
		  		}
		  		
		  		
		  		if ($recSet[$occ]["VREC"][$wocc]["VPU_ORDE_OLTYP"] == "STD" || $recSet[$occ]["VREC"][$wocc]["VPU_ORDE_OLTYP"] == "EXP" )
		  		{
		  			$PURCH_PAYABLE[0] += ($recSet[$occ]["VREC"][$wocc]["ext"]*1);
		  			if ($this->ePost["VAP_BOOKING"]=="1" && $recSet[$occ]["VREC"][$wocc]["newItem"]!="1")
		  			{
		  				$PURCH_PAYABLE[1] += ($recSet[$occ]["VREC"][$wocc]["ext_ORG"]*-1);
		  			}
		  		}
		  		if ($recSet[$occ]["VREC"][$wocc]["VPU_ORDE_OLTYP"] == "STD" )
		  		{
		  			if ($this->ePost["VAP_BOOKING"]=="1")
		  			{
			  			$VARIANCE[0] += ($recSet[$occ]["VREC"][$wocc]["ext"]*1);
			  		}
			  		else
			  		{
			  			$INVENTORY[0] += ($recSet[$occ]["VREC"][$wocc]["ext"]*1);
			  		}
		  			
		  			if ($this->ePost["VAP_BOOKING"]=="1" && $recSet[$occ]["VREC"][$wocc]["newItem"]!="1")
		  			{
		  				// $INVENTORY[1] += ($recSet[$occ]["VREC"][$wocc]["ext_ORG"]*-1);
		  				$VARIANCE[1] += ($recSet[$occ]["VREC"][$wocc]["ext_ORG"]*-1);
		  			}
		  		}		  		
		  		if ($recSet[$occ]["VREC"][$wocc]["VPU_ORDE_OLTYP"] == "EXP" )
		  		{
		  			if ($this->ePost["VAP_BOOKING"]=="1")
		  			{
		  				if ($recSet[$occ]["VREC"][$wocc]["newItem"]!="1")
		  				{
				  			$VARIANCE[0] += ($recSet[$occ]["VREC"][$wocc]["ext"]*1);
				  		}
				  		else
				  		{
				  			$EXPENSE_REIM[0] += ($recSet[$occ]["VREC"][$wocc]["ext"]*1);
				  		}
			  		}
			  		else
			  		{
			  			$EXPENSE_REIM[0] += ($recSet[$occ]["VREC"][$wocc]["ext"]*1);
			  		}
			  			
		  			if ($this->ePost["VAP_BOOKING"]=="1" && $recSet[$occ]["VREC"][$wocc]["newItem"]!="1")
		  			{
		  				$VARIANCE[1] += ($recSet[$occ]["VREC"][$wocc]["ext_ORG"]*-1);
		  				// $EXPENSE_REIM[1] += ($recSet[$occ]["VREC"][$wocc]["ext_ORG"]*-1);
		  			}
		  		}
		  				  		
		  		$wocc += 1;
		  	}

 			$taxCalc = new vgl_taxing($this->tblInfo->schema);

 			$taxRecSet = $this->initTaxAmt($taxRecSet);
		  	$taxRecSet = $taxCalc->vgl_taxCalculate($taxable[0],$taxRecSet);
		  	
			$txocc = 0;
			while ($txocc < count($taxRecSet))
			{
				$PURCH_PAYABLE[0] += ($taxRecSet[$txocc]["GLAMT"]*1); // D
				if (!$TAXES[0][$taxRecSet[$txocc]["idVTX_SCHE"]])
				{
					$TAXES[0][$taxRecSet[$txocc]["idVTX_SCHE"]] = $taxRecSet[$txocc];
					$TAXES[0][$taxRecSet[$txocc]["idVTX_SCHE"]]["GLAMT"] = 0;
				}
				$TAXES[0][$taxRecSet[$txocc]["idVTX_SCHE"]]["GLAMT"] += ($taxRecSet[$txocc]["GLAMT"]*1); // D
				$txocc += 1;
			}		  			
			  	
  			if ($this->ePost["VAP_BOOKING"]=="1")
  			{
	 			$taxRecSet = $this->initTaxAmt($taxRecSet);
			  	$taxRecSet = $taxCalc->vgl_taxCalculate($taxable[1],$taxRecSet);
				$txocc = 0;
				while ($txocc < count($taxRecSet))
				{
					$PURCH_PAYABLE[1] += ($taxRecSet[$txocc]["GLAMT"]*-1); // D
					if (!$TAXES[1][$taxRecSet[$txocc]["idVTX_SCHE"]])
					{
						$TAXES[1][$taxRecSet[$txocc]["idVTX_SCHE"]] = $taxRecSet[$txocc];
						$TAXES[1][$taxRecSet[$txocc]["idVTX_SCHE"]]["GLAMT"] = 0;
					}
					$TAXES[1][$taxRecSet[$txocc]["idVTX_SCHE"]]["GLAMT"] += ($taxRecSet[$txocc]["GLAMT"]*-1); // D
					$txocc += 1;
				}		  			
			  	
			}
			
		  	
	  		$occ += 1;
	  	}
	  	
	  	// Taxes have been removed from RPO-Locin Invoice detail because it cannot be linked 
		// $this->postingDetail[count($this->postingDetail)] = $TAXES[0];	  	
	  	
		$paccAccount[0]["PURCH_PAYABLE"] = $PURCH_PAYABLE[0];
	 	$paccAccount[0]["EXPENSE_REIM"] = $EXPENSE_REIM[0];
	 	$paccAccount[0]["VARIANCE"] = $VARIANCE[0];
	  	$paccAccount[0]["INVENTORY"] = $INVENTORY[0];
	  	
	  	
	  	$tax = array();
		foreach($TAXES[0] as $name => $value)
		{
			 $tax[count($tax)] = $value;
		}	  	
	  	$paccAccount[0]["TAXES"] = $tax;
			  	
  		if ($this->ePost["VAP_BOOKING"]=="1")
  		{
			$paccAccount[1]["PURCH_PAYABLE"] = $PURCH_PAYABLE[1];
		 	$paccAccount[1]["EXPENSE_REIM"] = $EXPENSE_REIM[1];
		 	$paccAccount[1]["VARIANCE"] = $VARIANCE[1];
		  	$paccAccount[1]["INVENTORY"] = $INVENTORY[1];
		  	$tax = array();
			foreach($TAXES[1] as $name => $value)
			{
				 $tax[count($tax)] = $value;
			}	  	
		  	$paccAccount[1]["TAXES"] = $tax;
		}
	  		  	
	  	$this->paccAccount = $paccAccount;
	  	return $paccAccount;
		
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
		$currObj["idVGB_CURR"] = $dtaObj["VAP_OIHE_CURID"];
		$wTblCurrency->dbFindMatch($currObj);
		$currency = array();
		if (count($wTblCurrency->result) >0)
		{
			$currency["idVGB_CURR"] = $wTblCurrency->result[0]["idVGB_CURR"];
			$currency["VGB_CURR_CURAT"] = $wTblCurrency->result[0]["VGB_CURR_CURAT"];
		}
		
		$externCall = true;
		if (!$this->masterTranConn)
		{
			$externCall = false;		
		
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

		// AC 20161218 New Control Number for Adjustments
		$nfnu = new vgb_getNextFreeNumber($this->tblInfo->schema,"VAP_ADJUST" ,$dtaObj,$this->masterTranConn);
		$dtaObj["VAP_OIDE_TRNID"] = $nfnu->vgb_nextNumber;
		

		$workRemain = 0;
		$dbObj = array();
		$dbObj["PROCESS"] = $dtaObj["PROCESS"];
		$dbObj["SESSION"] = $dtaObj["SESSION"];
		
		$wTblArr = array();
		
		
		$recSet = $dtaObj["RECSET"];
		$occ = 1; // Always ignore first occurence
		while ($occ < count($recSet) && $this->errorCode == 0)
		{
			if ($recSet[$occ]["SELECT"] > 0 && $recSet[$occ]["idVAP_OIHE"] > 0 && $recSet[$occ]["ADJAMOUT"]!=0)
			{
				$dbCount = count($wTblArr);
				$dbObj["idVAP_OIHE"] = $recSet[$occ]["idVAP_OIHE"];
				$wTblArr[$dbCount] = new dbMaster("vap_oihe",$this->tblInfo->schema);
				$wTblArr[$dbCount]->brTrConn = $this->masterTranConn;
				$wTblArr[$dbCount]->dbFindMatch($dbObj);
				$wTblArr[$dbCount]->brTrConn = null;
				if (!$wTblArr[$dbCount]->result[0]["VAP_OIHE_BALAN"] 
					|| abs($wTblArr[$dbCount]->result[0]["VAP_OIHE_BALAN"] ) < abs($recSet[$occ]["ADJAMOUT"])
					|| abs($wTblArr[$dbCount]->result[0]["VAP_OIHE_BALAN"] * $recSet[$occ]["ADJAMOUT"]) <= 0)
				{
					$this->errorCode += 1;
				}
				else
				{
					$updObj = array();
					$updObj["PROCESS"] = $dtaObj["PROCESS"];
					$updObj["SESSION"] = $dtaObj["SESSION"];
					$updObj["idVAP_OIHE"] = $recSet[$occ]["idVAP_OIHE"];
					$updObj["VAP_OIHE_BALAN"] = $wTblArr[$dbCount]->result[0]["VAP_OIHE_BALAN"] - $recSet[$occ]["ADJAMOUT"];
					$dbCount = count($wTblArr);
					$wTblArr[$dbCount] = new dbMaster("vap_oihe",$this->tblInfo->schema);
					
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
						$insObj["VAP_OIDE_OITID"] = $updObj["idVAP_OIHE"];
						
						// AC 20161218 New Control Number to group Adjustments
						$insObj["VAP_OIDE_TRNID"] = $dtaObj["VAP_OIDE_TRNID"];
						$insObj["VAP_OIDE_OITTY"] = "ADJ";
						$insObj["VAP_OIDE_TRNDA"] = $dtaObj["VAP_OIHE_DOCDA"];
						$insObj["VAP_OIDE_AMUNT"] = ($recSet[$occ]["ADJAMOUT"]*-1);
						$insObj["VAP_OIDE_CURID"] = $currency["idVGB_CURR"];
						$insObj["VAP_OIDE_CURAT"] = $currency["VGB_CURR_CURAT"];
						$insObj["VAP_OIDE_USLNA"] = $currUser["userCode"];						
						$dbCount = count($wTblArr);
						$wTblArr[$dbCount] = new dbMaster("vap_oide",$this->tblInfo->schema);;
						
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
		
		if ($externCall == false)
		{
			if ($this->errorCode == 0 )
			{		
				$this->dbPdoEndTransac(true);
			}
			else
			{	
				$this->errorCode =+ 3001;	
				$this->dbPdoEndTransac(false);
				$this->errorCodeText[count($this->errorCodeText)] = "Update Transaction Aborted ";
			}	
		}
	
		
		$this->applyTrans = $wTblArr;
		
	}	

}

class vap_financial extends dbMaster
{
	function vap_financial($schema)
	{
		$this->dbMaster("vap_oihe",$schema);
		
	}
	
	
	function vap_sales($source,$dtaSet)
	{
		// Expecting
		// - vpu_orhe (Header) for Partner-Reference-Currency
		// - POST_DATE - Posting date
		// - TOTPURCH Total of sales (Items)
		// - EXPCHARGED Expense Charged (Services)
		// - EXPBORNED Expense Not Charged (Services)
		// - TAXES (by state/province) (vtx_sche  + GLAMT
		// - AVGCOST (Total average cost Items)
		$this->postdtaSet = $dtaSet;
		$paccAccounts = array();
		

		// 1 Accounts Payables A + B + D
		$paccAccounts["PURCH_PAYABLE"] = $dtaSet["TOTPURCH"]; // A
		$paccAccounts["PURCH_PAYABLE"] += $dtaSet["EXPCHARGED"]; // B
		$occ = 0;
		while ($occ < count($dtaSet["TAXES"]))
		{
			$paccAccounts["PURCH_PAYABLE"] += $dtaSet["TAXES"][$occ]["GLAMT"]; // D
			$occ += 1;
		}
		
		// 2 Purchase  (Not Purchase)
		// $paccAccounts["PURCH_EXPENSE"] = $dtaSet["TOTPURCH"]; // A
		
		// 3 Expense Reimburse 
		$paccAccounts["EXPENSE_REIM"] = $dtaSet["EXPCHARGED"]; // B
		// 4 Tax Payable
		$paccAccounts["TAXES"] = $dtaSet["TAXES"];

		// 5 Cost of Sale (Not Purchase)
		// $paccAccounts["COST_SALES"] = $dtaSet["AVGCOST"]; // E
		
		// 6 Provisional Expense 
		$paccAccounts["PROV_EXPENSE"] = $dtaSet["EXPBORNED"]; // C

		// 7 Inventory
		$paccAccounts["INVENTORY"] = $dtaSet["TOTPURCH"];// + $dtaSet["EXPCHARGED"] + $dtaSet["EXPBORNED"]; // A + B + C
		// 8 Expense Accrual
		$paccAccounts["ACCR_EXPENSE"] = $dtaSet["EXPBORNED"]; // C
		
		$objIns = array();
		$objIns["VGL_JNHE_PSOUR"] = $source;
		$objIns["VAP_OIHE_BSUPP"] = $dtaSet["vpu_orhe"]["VPU_ORHE_BTCUS"];
		$objIns["VAP_OIHE_BTADD"] = $dtaSet["vpu_orhe"]["VPU_ORHE_BTADD"];
		if ($paccAccounts["PURCH_PAYABLE"] >= 0)
		{
			$objIns["VAP_OIHE_OITTY"] = "INV";
		}
		else
		{
			$objIns["VAP_OIHE_OITTY"] = "CRN";
		}
		
		$objIns["VAP_OIHE_TRTYP"] = "RPO";
		$objIns["VAP_OIHE_DOCDA"] = $dtaSet["POST_DATE"];
		$objIns["VAP_OIHE_TERID"] = $dtaSet["vpu_orhe"]["VPU_ORHE_TERID"];
		$objIns["VAP_OIHE_AMUNT"] = $paccAccounts["PURCH_PAYABLE"];
		$objIns["VAP_OIHE_CURID"] = $dtaSet["vpu_orhe"]["VPU_ORHE_CURID"];
		$objIns["VAP_OIHE_BALAN"] = $paccAccounts["PURCH_PAYABLE"];
		$objIns["VAP_OIHE_CUSPO"] = $dtaSet["vpu_orhe"]["VPU_ORHE_CUSPO"];
		$objIns["VAP_OIHE_REFER"] = $dtaSet["vpu_orhe"]["VPU_ORHE_ORNUM"];

//		$this->mytrans = $this->brTrConn;
//		return;

		
		$objIns["PROCESS"] = "VAP_FINANCE";
		$objIns["SESSION"] = "VAP_OITEMCT";
		$objIns["paccAccounts"] = $paccAccounts;
		$varTbl = new vap_oihe($this->tblInfo->schema);
		$varTbl->brTrConn = $this->brTrConn;
		$varTbl->dbInsRec($objIns);

		foreach($varTbl as $name => $value)
		{
			 $this->$name = $value;
		}

		
	}
	
}


class vap_agedreport extends dbMaster
{
	function vap_agedreport($schema)
	{
		$this->dbMaster("vap_oihe",$schema);
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
		
			
		
	  	$ageTbls = new dbMaster("vap_oihe",$this->tblInfo->schema);
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
		
			
		
	  	$ageTbls = new dbMaster("vap_oihe",$this->tblInfo->schema);
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
	
		if (count($objDta["suppFilter"]) > 0)
		{
			$supp = " AND '," . implode(",",$objDta["suppFilter"]) . ",' ";
			$supp .= "LIKE CONCAT('%,',idVGB_SUPP,',%') ";
		}
		$trig =<<<EOC
		
SELECT
		VGB_SUPP_BPNAM
		,idVGB_SUPP
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
		VGB_SUPP_BPNAM
		,idVGB_SUPP
		,VGB_CURR_DESCR
		,invoice
		,VAP_OIHE_DOCDA
		,balance
		,VGB_CURR_CURID
		,CASE
			WHEN :agingDate - interval 30 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS thirty
		,CASE
			WHEN :agingDate - interval 30 day > VAP_OIHE_DOCDA AND :agingDate - interval 60 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS sixty
		,CASE
			WHEN :agingDate - interval 60 day > VAP_OIHE_DOCDA AND :agingDate - interval 90 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS ninety
		,CASE
			WHEN :agingDate - interval 90 day > VAP_OIHE_DOCDA AND :agingDate - interval 120 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS oneTwenty
		,CASE
			WHEN :agingDate - interval 120 day > VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS old
	FROM
		(SELECT
			VGB_SUPP_BPNAM
			,idVGB_SUPP
			,VGB_CURR_DESCR
			,VAP_OIHE_INVOI AS invoice
			,VAP_OIHE_DOCDA
			,CASE
				WHEN VAP_OIDE_AMUNT IS NULL THEN VAP_OIHE_AMUNT
				ELSE (MAX(VAP_OIHE_AMUNT) + SUM(VAP_OIDE_AMUNT))
			END AS balance
			,VGB_CURR_CURID
		
		FROM vap_oihe
		LEFT JOIN vap_oide ON VAP_OIDE_OITID = idVAP_OIHE [=COND:vap_oide=]
		JOIN vgb_supp ON idVGB_SUPP = VAP_OIHE_BSUPP [=COND:vgb_supp=]
		JOIN vgb_curr ON idVGB_CURR = VAP_OIHE_CURID
		WHERE  VAP_OIHE_DOCDA < :agingDate AND VAP_OIHE_TRTYP = 'STD'
			{$supp}
			AND (VAP_OIDE_TRNDA < :agingDate OR VAP_OIDE_TRNDA IS NULL)  [=COND:vap_oihe=]
			
			
 

		GROUP BY VAP_OIHE_BSUPP, idVAP_OIHE
		HAVING balance != 0) x
	) y
	GROUP BY VGB_SUPP_BPNAM
    
UNION
    
SELECT  
		VGB_SUPP_BPNAM
		,idVGB_SUPP
		,VGB_CURR_DESCR
		,invoice
		,VAP_OIHE_DOCDA as invDate
		,VGB_CURR_CURID as currency
		,0 as balance
		,CASE
			WHEN :agingDate - interval 30 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS thirty
		,CASE
			WHEN :agingDate - interval 30 day > VAP_OIHE_DOCDA AND :agingDate - interval 60 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS sixty
		,CASE
			WHEN :agingDate - interval 60 day > VAP_OIHE_DOCDA AND :agingDate - interval 90 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS ninety
		,CASE
			WHEN :agingDate - interval 90 day > VAP_OIHE_DOCDA AND :agingDate - interval 120 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS oneTwenty
		,CASE
			WHEN :agingDate - interval 120 day > VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS old
FROM
	(SELECT 
		VGB_SUPP_BPNAM
		,idVGB_SUPP
		,VGB_CURR_DESCR
		,VAP_OIHE_INVOI AS invoice
		,VAP_OIHE_DOCDA
		,CASE
			WHEN VAP_OIDE_AMUNT IS NULL THEN VAP_OIHE_AMUNT
			ELSE (MAX(VAP_OIHE_AMUNT) + SUM(VAP_OIDE_AMUNT))
		END AS balance
		,VGB_CURR_CURID
		
	FROM vap_oihe
	LEFT JOIN vap_oide ON VAP_OIDE_OITID = idVAP_OIHE [=COND:vap_oide=]
    JOIN vgb_supp ON idVGB_SUPP = VAP_OIHE_BSUPP [=COND:vgb_supp=]
	JOIN vgb_curr ON idVGB_CURR = VAP_OIHE_CURID
	WHERE VAP_OIHE_DOCDA < :agingDate AND VAP_OIHE_TRTYP = 'STD'
		{$supp}
		AND (VAP_OIDE_TRNDA < :agingDate OR VAP_OIDE_TRNDA IS NULL) [=COND:vap_oihe=]
	GROUP BY VAP_OIHE_BSUPP, idVAP_OIHE
	HAVING balance != 0) x
ORDER BY VGB_SUPP_BPNAM, invoice;


	
EOC;

		return $trig;
	}
	
	function buildTotalTrigger($objDta)
	{
	
		if (count($objDta["suppFilter"]) > 0)
		{
			$supp = " AND '," . implode(",",$objDta["suppFilter"]) . ",' ";
			$supp .= "LIKE CONCAT('%,',idVGB_SUPP,',%') ";
		}
		$trig =<<<EOC
		
SELECT
		VGB_CURR_CURID as VGB_SUPP_BPNAM
		,(@ab:=0) as idVGB_SUPP
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
		(@aa:='rpt_total') as VGB_SUPP_BPNAM
		,idVGB_SUPP
		,VGB_CURR_DESCR
		,invoice
		,VAP_OIHE_DOCDA
		,balance
		,VGB_CURR_CURID
		,CASE
			WHEN :agingDate - interval 30 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS thirty
		,CASE
			WHEN :agingDate - interval 30 day > VAP_OIHE_DOCDA AND :agingDate - interval 60 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS sixty
		,CASE
			WHEN :agingDate - interval 60 day > VAP_OIHE_DOCDA AND :agingDate - interval 90 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS ninety
		,CASE
			WHEN :agingDate - interval 90 day > VAP_OIHE_DOCDA AND :agingDate - interval 120 day <= VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS oneTwenty
		,CASE
			WHEN :agingDate - interval 120 day > VAP_OIHE_DOCDA THEN balance
			ELSE 0
		END AS old
	FROM
		(SELECT
			(@aa:='rpt_total') as VGB_SUPP_BPNAM
			,idVGB_SUPP
			,VGB_CURR_DESCR
			,VAP_OIHE_INVOI AS invoice
			,VAP_OIHE_DOCDA
			,CASE
				WHEN VAP_OIDE_AMUNT IS NULL THEN VAP_OIHE_AMUNT
				ELSE (MAX(VAP_OIHE_AMUNT) + SUM(VAP_OIDE_AMUNT))
			END AS balance
			,VGB_CURR_CURID
		
		FROM vap_oihe
		LEFT JOIN vap_oide ON VAP_OIDE_OITID = idVAP_OIHE [=COND:vap_oide=]
		JOIN vgb_supp ON idVGB_SUPP = VAP_OIHE_BSUPP [=COND:vgb_supp=]
		JOIN vgb_curr ON idVGB_CURR = VAP_OIHE_CURID
		WHERE  VAP_OIHE_DOCDA < :agingDate AND VAP_OIHE_TRTYP = 'STD'
			{$supp}
			AND (VAP_OIDE_TRNDA < :agingDate OR VAP_OIDE_TRNDA IS NULL)  [=COND:vap_oihe=]
			
			
 

		GROUP BY VAP_OIHE_BSUPP, idVAP_OIHE
		HAVING balance != 0) x
	) 
	GROUP BY VGB_SUPP_BPNAM,VGB_CURR_CURID

EOC;

		return $trig;
	}
		
	
}




require_once "VGB_PARTNERS.php";
require_once "VGB_GETNFNU.php";
require_once "VGL_FINANCE.php";
require_once "VIN_ITEMS.php";


?>

