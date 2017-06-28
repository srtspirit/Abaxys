<?php

class vgb_bpar extends dbMaster
{
	function vgb_bpar($schema)
	{
		$this->dbMaster("vgb_bpar",$schema);
	}

	function dbInsRec($dtaObj)
	{
		
		$this->dbFnct = 'dbInsRec';
		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
  		$wret = array();
  		
  		// Bpar;
  		
  		$wTbls = array();
  		$wTbls[0] = new dbMaster("vgb_bpar",$this->tblInfo->schema);

  		$insertSet = $this->dbInsertSet($wTbls,$this->tblInfo->schema,$dtaObj);
  		  		
  		$this->insertSet = $insertSet;
  		$wret[0] = $this->dbGenPrep($wTbls[0],$insertSet[0],$dtaObj);
		
		$this->updErrCode = $wTbls[0];
		$updErr = $wret[0]->errorCode;
		
		if ($updErr == 0)
		{
			$this->updErrCodeRe = $wret[0]->result[0]["idVGB_BPAR"];
			$dtaObj["idVGB_BPAR"] = $wret[0]->result[0]["idVGB_BPAR"];
			$dtaObj["VGB_ADDR_BPART"] = $dtaObj["idVGB_BPAR"];
			$dtaObj["VGB_CUST_BPART"] = $dtaObj["idVGB_BPAR"];
			$dtaObj["VGB_SUPP_BPART"] = $dtaObj["idVGB_BPAR"];
		}

		
		// ADDR;
  		$wTbls = array();
		$wTbls[0] = new dbMaster("vgb_addr",$this->tblInfo->schema);
		if ($updErr == 0)
		{
			
			

	  		$insertSet = $this->dbInsertSet($wTbls,$this->tblInfo->schema,$dtaObj);
	  		$wret[1] = $this->dbGenPrep($wTbls[0],$insertSet[0],$dtaObj);
	  		$updErr = $wret[1]->errorCode;
			if ($updErr == 0)
			{
				$dtaObj["idVGB_ADDR"] = $wret[1]->result[0]["idVGB_ADDR"];
				$dtaObj["VGB_CUST_BTADD"] = $dtaObj["idVGB_ADDR"];
				$dtaObj["VGB_CUST_STADD"] = $dtaObj["idVGB_ADDR"];
				$dtaObj["VGB_SUPP_BTADD"] = $dtaObj["idVGB_ADDR"];
				$dtaObj["VGB_SUPP_STADD"] = $dtaObj["idVGB_ADDR"];
				
			}
			else
	  		{
	  			$wret[0]->dbDelRec($dtaObj);
	  		}
	  	}
	  	else
	  	{
			$wTbls[0]->dbValidConstraints($dtaObj);
			$wret[1] = $wTbls[0];	  		
	  	}

		// CUST OR SUPP;
  		$wTbls = array(); $wwT = $E_POST["SESSION"]!="VGB_CUSTCT"?"vgb_supp":"vgb_cust";
		$wTbls[0] = new dbMaster($wwT,$this->tblInfo->schema);
		if ($updErr == 0)
		{
			
	  		// $this->dbInsertSet is not clear why it exist
	  		// Must be validated. May be a method not used see stdMasterClasses
	  		
	  		$insertSet = $this->dbInsertSet($wTbls,$this->tblInfo->schema,$dtaObj);
	  		$wret[2] = $this->dbGenPrep($wTbls[0],$insertSet[0],$dtaObj);
	  		$updErr = $wret[2]->errorCode;
	  		if ($updErr != 0)
	  		{
	  			$wret[1]->dbDelRec($dtaObj);
	  			$wret[0]->dbDelRec($dtaObj);
	  		}
	  		
		}		
	  	else
	  	{
			$wTbls[0]->dbValidConstraints($dtaObj);
			$wret[2] = $wTbls[0];	  		
	  	}

		if ($updErr == 0)
		{
		
			$this->result = array();
			$this->result[0] = $wret[0]->result[0];
			$this->result[1] = $wret[1]->result[0];
			$this->result[2] = $wret[2]->result[0];
			$this->errorCode = 0;
			$this->insertId = $this->result[0]["idVGB_BPAR"];
			$this->ADDRinsertId = $this->result[1]["idVGB_ADDR"];
			$this->MAINinsertId = $this->result[2]["id" . strtoupper($wwT) ];
		}
		else
		{
			$this->errorCode = $updErr;
			$this->result = "";		
		}
		
		$this->invalidConstraints = array();
		$occ = 0;
		$seq = 0;
		while ($occ < 3)
		{
			$wocc = 0;
			while ($wocc < count($wret[$occ]->invalidConstraints))
			{
				$this->invalidConstraints[$seq] = $wret[$occ]->invalidConstraints[$wocc];
				$seq  += 1;
				$wocc += 1;
			}
			$occ += 1;
		}
		
		// $this->result = $wret;
		
	}
	
	function dbSetTrig()
	{



$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgb_bpar WHERE [=WHERE=] [=COND:vgb_bpar=][=ORDBY=] [=LIMIT=] ) t1

			
			LEFT JOIN vgb_cust t2 ON t2.VGB_CUST_BPART = idVGB_BPAR [=COND:vgb_cust=]
			 
			LEFT JOIN vgb_supp t3 ON t3.VGB_SUPP_BPART = idVGB_BPAR [=COND:vgb_supp=]
			
			LEFT JOIN vgb_addr t4 ON t4.VGB_ADDR_BPART = idVGB_BPAR	[=COND:vgb_addr=]		
			
			 
			 	
			 
		
EOD;

		return $trig;
		
	}

}

class vgb_bpar_ext extends dbMaster
{
	function vgb_bpar_ext($schema)
	{
		$this->dbMaster("vgb_bpar",$schema);
	}


	function dbSetTrig()
	{



$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgb_bpar WHERE [=WHERE=] [=COND:vgb_bpar=][=ORDBY=] LIMIT 1 ) t1

			
			LEFT JOIN vgb_cust t2 ON t2.VGB_CUST_BPART = idVGB_BPAR [=COND:vgb_cust=]
			LEFT JOIN vgb_supp t3 ON t3.VGB_SUPP_BPART = idVGB_BPAR [=COND:vgb_supp=]
			LEFT JOIN vgb_addr t4 ON t4.VGB_ADDR_BPART = idVGB_BPAR	[=COND:vgb_addr=]		
			
			
			 	
			 
		
EOD;

		return $trig;
		
	}

}



class vgb_addr extends dbMaster
{
	function vgb_addr($schema)
	{
		$this->dbMaster("vgb_addr",$schema);
	}



		
	function dbSetTrig()
	{

$trig = <<<EOD
			SELECT * FROM 
			 
		 	( SELECT * FROM vgb_addr WHERE [=WHERE=] [=COND:vgb_addr=] [=ORDBY=] [=LIMIT=] ) t1
		 	
		LEFT JOIN vgb_bpar ON idVGB_BPAR = t1.VGB_ADDR_BPART [=COND:vgb_bpar=]
		LEFT JOIN vtx_schh ON idVTX_SCHH = t1.VGB_ADDR_SCHID OR idVTX_SCHH = t1.VGB_ADDR_PCHID 
		LEFT JOIN vgb_cntr ON idVGB_CNTR = t1.VGB_ADDR_CNTID
		LEFT JOIN vgb_prst ON idVGB_PRST = t1.VGB_ADDR_PRSID 
				

		
EOD;

		return $trig;
		
	}


}	

class vgb_cust extends dbMaster
{
	
	
	function vgb_cust($schema)
	{
		$this->dbMaster("vgb_cust",$schema);
	}

	function onInitNewRec($tbl,$pr)
	{
		$tmpObj = array();
		$tmpObj["idVGB_BPAR"]= $tbl["VGB_CUST_BPART"];
		$bpar = new vgb_bpar_ext($this->tblInfo->schema); 
		$bpar->dbFindMatch($tmpObj);
		if (count($bpar->result) > 0)
		{
			$tbl["VGB_CUST_BPNAM"] = $bpar->result[0]["VGB_BPAR_BPNAM"];
			$tbl["VGB_CUST_BTADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_CUST_STADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_CUST_SLSRP"] = $bpar->result[0]["idVGB_SLRP"];

		}

//			foreach($bpar->result[0] as $name => $value)
//			{
//				if (!$tbl[$name]) 
//				{
//					$tbl[$name] = $bpar->result[0][$name];
//				}
//				
//			}
			
		
		
		$this->onInitNewRecX['vgb_cust'] = $tbl;

		return $tbl;
	}


	function dbDelRec($dtaObj)
	{
		$this->dbFnct = 'dbDelRec';
		
		$recSet = setEpost($this->tblInfo->schema,$dtaObj);
		$idVGB_BPAR = $recSet["VGB_CUST_BPART"];
		
		$customer = new dbMaster("vgb_cust",$this->tblInfo->schema);
		$customer->dbDelRec($dtaObj);
		$this->errorCode = $customer->errorCode;
		
		$this->customer = $customer;
		$this->currentPartner = $idVGB_BPAR;
		// Check if partner is supplier
		
		$partner = new vgb_bpar($this->tblInfo->schema);
		$objChk = array();
		$objChk["PROCESS"] = $recSet["PROCESS"];
		$objChk["SESSION"] = $recSet["SESSION"];
		$objChk["TBLNAME"] = $recSet["TBLNAME"];			
		
		$objChk['idVGB_BPAR'] = $idVGB_BPAR;
		$partner->dbChkMatch($objChk);
		if ($partner->fetchResult[0]['idVGB_CUST'] == null && $partner->fetchResult[0]['idVGB_SUPP'] == null )
		{
			$addresses = array();
			$addr = new dbMaster("vgb_addr",$this->tblInfo->schema); //new vgb_addr($this->tblInfo->schema);

			$occ = 0;
			while ($occ < count($partner->fetchResult))
			{
				if ($partner->fetchResult[$occ]['idVGB_ADDR'] != null)
				{
					$objChk['idVGB_ADDR'] = $partner->fetchResult[$occ]['idVGB_ADDR'];
					$objChk['VGB_ADDR_BPART'] = $idVGB_BPAR;
					$addr->dbDelRec($objChk);
					$this->delrecs = $objChk['idVGB_ADDR'];
					$addresses[count($addresses)] = $addr;
				}
				$occ += 1;
				
			}
			
			$partner->dbDelRec($objChk);
			$this->addresses = $addresses;

		};

		$this->partner = $partner;
		
		
		
		// Will only be allowed if last address was deleted (no constraints
		// $partner = $this->dbMaster("vgb_bpar",$this->tblInfo->schema);
		// $partner->dbDelRec($dtaObj);
	
	}	
				

	function dbSetTrig()
	{


		if (($this->sessionId && $this->sessionId == "VGB_PARTNERS") ||( $this->E_POST["VGB_PARTNERS_DRILL"] > "" ))
		{
			
			$inTrig = "";
//			if ($this->E_POST["VGB_PARTNERS_DRILL"] > "0" )
//			{
				$inTrig .= " LEFT JOIN vsl_orhe ON VSL_ORHE_BTCUS = idVGB_CUST [=COND:vsl_orhe=] ";
				$inTrig .= " LEFT JOIN vsl_orde ON VSL_ORDE_ORNUM = idVSL_ORHE  [=COND:vsl_orde=] ";
				$inTrig .= " LEFT JOIN vin_item ON VSL_ORDE_ITMID = idVIN_ITEM  [=COND:vin_item=] ";
				$inTrig .= " LEFT JOIN vin_unit ON VSL_ORDE_SAUOM = idVIN_UNIT  [=COND:vin_unit=] ";
				$inTrig .= " LEFT JOIN vsl_orst ON VSL_ORST_ORLIN = idVSL_ORDE  [=COND:vsl_orst=] ";
				$inTrig .= " LEFT JOIN vtx_sche ON VTX_SCHE_SCHID = VGB_PRST_SCHID AND idVGB_ADDR = VSL_ORHE_STADD  [=COND:vtx_sche=] ";
				
//			}
			
			
$trig = <<<EOD

			SELECT * FROM
			 
		 	( SELECT * FROM vgb_cust 

		
		LEFT JOIN vgb_bpar ON idVGB_BPAR = VGB_CUST_BPART [=COND:vgb_bpar=]
		LEFT JOIN vgb_addr ON VGB_ADDR_BPART = VGB_CUST_BPART [=COND:vgb_addr=]
		LEFT JOIN vgb_prst ON idVGB_PRST = VGB_ADDR_PRSID [=COND:vgb_prst=]
		LEFT JOIN vgb_cntr ON idVGB_CNTR = VGB_ADDR_CNTID [=COND:vgb_cntr=]
		LEFT JOIN vgb_ctyp ON idVGB_CTYP = VGB_CUST_CUTYP [=COND:vgb_ctyp=]
		LEFT JOIN vgb_curr ON idVGB_CURR = VGB_CUST_CURID [=COND:vgb_curr=]
		LEFT JOIN vgb_mark ON idVGB_MARK = VGB_CUST_MRKID [=COND:vgb_mark=]
		LEFT JOIN vgb_slrp ON idVGB_SLRP = VGB_CUST_SLSRP [=COND:vgb_slrp=]
		LEFT JOIN vgb_term ON idVGB_TERM = VGB_CUST_TERID [=COND:vgb_term=]
		
EOD;

$trig .= $inTrig;


$trig .= <<<EOD

								
		WHERE [=WHERE=]  [=COND:vgb_cust=]  [=LIMIT=] ) tx		

		
EOD;
		
		}
		else
		{
			
		
$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgb_cust 

		
		LEFT JOIN vgb_bpar ON idVGB_BPAR = VGB_CUST_BPART [=COND:vgb_bpar=]
		
		LEFT JOIN vgb_ctyp ON idVGB_CTYP = VGB_CUST_CUTYP [=COND:vgb_ctyp=]
		LEFT JOIN vgb_curr ON idVGB_CURR = VGB_CUST_CURID [=COND:vgb_curr=]
		LEFT JOIN vgb_mark ON idVGB_MARK = VGB_CUST_MRKID [=COND:vgb_mark=]
		LEFT JOIN vgb_slrp ON idVGB_SLRP = VGB_CUST_SLSRP [=COND:vgb_slrp=]
		LEFT JOIN vgb_term ON idVGB_TERM = VGB_CUST_TERID [=COND:vgb_term=]
								
		WHERE [=WHERE=]  [=COND:vgb_cust=]  [=LIMIT=] ) tx		

		
EOD;

		}
	
		return $trig;
		
		
		
	}

}	

class vgb_supp extends dbMaster
{
	function vgb_supp($schema)
	{
		$this->dbMaster("vgb_supp",$schema);
	}

	function onInitNewRec($tbl,$pr)
	{
		$tmpObj = array();
		$tmpObj["idVGB_BPAR"]= $tbl["VGB_SUPP_BPART"];
		$bpar = new vgb_bpar_ext($this->tblInfo->schema); 
		$bpar->dbFindMatch($tmpObj);
		if (count($bpar->result) > 0)
		{
			$tbl["VGB_SUPP_BPNAM"] = $bpar->result[0]["VGB_BPAR_BPNAM"];
			$tbl["VGB_SUPP_BTADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_SUPP_STADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_SUPP_SLSRP"] = $bpar->result[0]["idVGB_SLRP"];

		}

//		foreach($bpar->result[0] as $name => $value)
//		{
//			if (!$tbl[$name]) 
//			{
//				$tbl[$name] = $bpar->result[0][$name];
//			}
//			
//		}
//			
		
		
		$this->onInitNewRecX['vgb_supp'] = $tbl;

		return $tbl;
	}
	
	
	function dbDelRec($dtaObj)
	{
		$this->dbFnct = 'dbDelRec';
		$this->dbFnctPlus = "Made to measure";
		$recSet = setEpost($this->tblInfo->schema,$dtaObj);
		$idVGB_BPAR = $recSet["VGB_SUPP_BPART"];
		
		$supplier = new dbMaster("vgb_supp",$this->tblInfo->schema);
		$supplier->dbDelRec($dtaObj);

		$this->supplier = $supplier;
		$this->currentPartner = $idVGB_BPAR;
		
		$this->errorCode = $supplier->errorCode;
		if ($this->errorCode > 0)
		{
			return;
		}
		
		// Step 2 Check if Customer
//		$partner = new dbMaster("vgb_cust",$this->tblInfo->schema);
//		
//		$objChk = array();
//		$objChk['VGB_CUST_BPART'] = $idVGB_BPAR;
//		$partner->dbChkMatch($objChk);
//		
//		$this->partner = $partner;
//		if ($partner->erroCode > 0)
//		{
//			$addr = new dbMaster("vgb_addr",$this->tblInfo->schema);
//			$objChk = array();
//			$objChk['VGB_ADDR_BPART'] = $idVGB_BPAR;
//			$addr->dbDelRec($objChk);
//			
//			$bproot = new dbMaster("vgb_bpar",$this->tblInfo->schema);
//			$objChk = array();
//			$objChk['idVGB_BPAR'] = $idVGB_BPAR;
//			$bproot->dbDelRec($objChk);
//		}
//


		// Check if partner is supplier
		$partner = new vgb_bpar($this->tblInfo->schema);
		$objChk = array();
		$objChk["PROCESS"] = $recSet["PROCESS"];
		$objChk["SESSION"] = $recSet["SESSION"];
		$objChk["TBLNAME"] = $recSet["TBLNAME"];			
		
		$objChk['idVGB_BPAR'] = $idVGB_BPAR;
		$partner->dbChkMatch($objChk);

		$this->partner = $partner;


		if ($partner->fetchResult[0]['idVGB_CUST'] == null && $partner->fetchResult[0]['idVGB_SUPP'] == null )
		{
			$addresses = array();
			$addr = new dbMaster("vgb_addr",$this->tblInfo->schema); //new vgb_addr($this->tblInfo->schema);

			$occ = 0;
			while ($occ < count($partner->fetchResult))
			{
				if ($partner->fetchResult[$occ]['idVGB_ADDR'] != null)
				{
					$objChk['idVGB_ADDR'] = $partner->fetchResult[$occ]['idVGB_ADDR'];
					$objChk['VGB_ADDR_BPART'] = $idVGB_BPAR;
					$addr->dbDelRec($objChk);
					$this->delrecs = $objChk['idVGB_ADDR'];
					$addresses[count($addresses)] = $addr;
				}
				$occ += 1;
				
			}
			
			$partner->dbDelRec($objChk);
			$this->addresses = $addresses;

		};

		
		
		
		
		// Will only be allowed if last address was deleted (no constraints
		// $partner = $this->dbMaster("vgb_bpar",$this->tblInfo->schema);
		// $partner->dbDelRec($dtaObj);
	
	}	


	function dbSetTrig()
	{


$trig = <<<EOD
			SELECT * FROM 
			 
		 	( SELECT * FROM vgb_supp 
		 	
		LEFT JOIN vgb_bpar ON VGB_SUPP_BPART = idVGB_BPAR  [=COND:vgb_bpar=]
		LEFT JOIN vgb_addr ON VGB_ADDR_BPART = VGB_SUPP_BPART [=COND:vgb_addr=]
		LEFT JOIN vgb_curr ON idVGB_CURR = VGB_SUPP_CURID [=COND:vgb_curr=]
		LEFT JOIN vgb_term ON idVGB_TERM = VGB_SUPP_TERID [=COND:vgb_term=]
		
		WHERE [=WHERE=] AND idVGB_SUPP [=COND:vgb_supp=] [=LIMIT=] ) tx		

		
EOD;

//		$trig = <<<EOD
//					SELECT * FROM 
//					 
//				 	( SELECT * FROM vgb_bpar 
//				 	
//				LEFT JOIN vgb_supp t1 ON VGB_SUPP_BPART = idVGB_BPAR  [=COND:vgb_supp=]
//				LEFT JOIN vgb_addr t2 ON t2.VGB_ADDR_BPART = t1.VGB_SUPP_BPART [=COND:vgb_addr=]
//				LEFT JOIN vgb_curr ON idVGB_CURR = t1.VGB_SUPP_CURID [=COND:vgb_curr=]
//				LEFT JOIN vgb_term ON idVGB_TERM = t1.VGB_SUPP_TERID [=COND:vgb_term=]
//				
//				WHERE [=WHERE=] AND idVGB_SUPP [=COND:vgb_bpar=] [=LIMIT=] ) tx		
//		
//				
//		EOD;






		return $trig;
		
	}

}	

?>