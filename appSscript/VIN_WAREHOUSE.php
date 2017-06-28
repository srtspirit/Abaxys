<?php

class vin_wars extends dbMaster
{
	function vin_wars($schema)
	{
		$this->dbMaster("vin_wars",$schema);
	}

		function dbSetTrig()
	{

$trig = <<<EOD


		SELECT * FROM

		(SELECT * FROM vin_wars 

		LEFT JOIN vin_locs ON VIN_LOCS_WARID = idVIN_WARS [=COND:vin_locs=] 					
		
		WHERE [=WHERE=] [=COND:vin_wars=] [=LIMIT=] ) tx		
		
EOD;
	
	return $trig;
	
  }
  


  
  /*	function dbUpdRec($dtaObj)
	{
		
      $wTbls = array();
		$wars = array();
      $recSet = array();
  		$occ = 0;
  		$recSet = $dtaObj['RECSET'];
		$spec = new dbMaster("vin_locs",$this->tblInfo->schema);
		while ($occ < count($dtaObj['RECSET'])) {
		
		if($occ != 0 && $dtaObj['RECSET'][$occ]['trash'] == 1){
			
			   $recSet[$occ]["PROCESS"] = 'VIN_WAREHOUSE';
				$recSet[$occ]["SESSION"] = 'VIN_LOCSCT';
				$recSet[$occ]["TBLNAME"] = "vin_locs";
				$recSet[$occ]['idVIN_LOCS'] = $dtaObj['RECSET'][$occ]['idVIN_LOCS'] ;
				//$spec->dbChkMatch($recSet[$occ]);	
		      $spec->dbDelRec($recSet[$occ]);

		}
		else {
			
				if ($occ > 0 )
				{
					$recSet[$occ]["PROCESS"] = 'VIN_WAREHOUSE';
					$recSet[$occ]["SESSION"] = 'VIN_LOCSCT';
					$recSet[$occ]["TBLNAME"] = "vin_locs";
					$recSet[$occ]['idVIN_LOCS'] = $dtaObj['RECSET'][$occ]['idVIN_LOCS'];
					$recSet[$occ]['VIN_LOCS_LOCID'] = $dtaObj['RECSET'][$occ]['VIN_LOCS_LOCID'];
					$recSet[$occ]['VIN_LOCS_DESCR'] = $dtaObj['RECSET'][$occ]['VIN_LOCS_DESCR'];
					$recSet[$occ]['VIN_LOCS_WARID'] = $dtaObj['RECSET'][0]['idVIN_WARS'];
					$locs[$occ] = new dbMaster("vin_locs",$this->tblInfo->schema);
					$locs[$occ]->dbUpdRec($recSet[$occ]);
				}
		}
		
		$occ += 1;
		
		}
		
				
		$wars[0] = new dbMaster("vin_wars",$this->tblInfo->schema);
		$wars[0]->dbUpdRec($dtaObj);
		
		
		$this->errorCode = $wars[0]->errorCode;
		foreach($wars[0] as $name => $value)
		{
			 $this->$name = $value;
		}
			$this->E_POST = $E_POST;

/*		$this->errorCode = $locs[0]->errorCode;
		foreach($locs[0] as $name => $value)
		{
			 $this->$name = $value;
		}

		
		$this->E_POST = $E_POST;

		$this->rbc = $wars[0];
		$this->lcs = $locs;
		return;
	}*/
}



class vin_locs extends dbMaster
{
	function vin_locs($schema)
	{
		$this->dbMaster("vin_locs",$schema);
	}
	
	function dbSetTrig()
	{	
$trig = <<<EOD
			SELECT * FROM
		 	( SELECT * FROM vin_locs 
			LEFT JOIN  vin_wars ON idVIN_WARS = VIN_LOCS_WARID  [=COND:vin_wars=] 								
			WHERE [=WHERE=]  [=COND:vin_locs=] [=LIMIT=] ) tx		
	
EOD;
		return $trig;
	}

	
	function dbInsRec($dtaObj)
	{
		$wTbls = array();
		$sTbls = array();
  		$wTbls[0] = new dbMaster("vin_locs",$this->tblInfo->schema);
		$wTbls[0]->dbInsRec($dtaObj);
			
		if(($wTbls[0]->insertId!=0) && ($wTbls[0]->insertId!="") && ($dtaObj['Default_location'] == 1)) {
			$arr = array(	
			 "utype"=>"UPDATE",
			 "idVIN_WARS"=>$dtaObj['idVIN_WARS'],
			 "VIN_WARS_MALOC"=>$wTbls[0]->insertId,
			 "PROCESS"=>"VIN_WAREHOUSE",
			 "SESSION"=>"VIN_WARSCT",
			 "METHOD"=>"UPDATE",
			 "SCHEMA"=>$this->tblInfo->schema);
			$sTbls[0] = new dbMaster("vin_wars",$this->tblInfo->schema);
		   $val = $sTbls[0]->dbUpdRec($arr);
		}
		
		foreach($wTbls[0] as $name => $value)
		{
			 $this->$name = $value;
		}
		$this->AEE_POST = $E_POST;
		
		$this->rbc = $wTbls[0];
		return;
	}
	
	function dbUpdRec($dtaObj)
	{
		$wTbls = array();
		$sTbls = array();
  		$wTbls[0] = new dbMaster("vin_locs",$this->tblInfo->schema);
		$wTbls[0]->dbUpdRec($dtaObj);
			
		if($dtaObj['Default_location'] == 1) {
			$arr = array(	
			 "utype"=>"UPDATE",
			 "idVIN_WARS"=>$dtaObj['idVIN_WARS'],
			 "VIN_WARS_MALOC"=>$dtaObj['idVIN_LOCS'],
			 "PROCESS"=>"VIN_WAREHOUSE",
			 "SESSION"=>"VIN_WARSCT",
			 "METHOD"=>"UPDATE",
			 "SCHEMA"=>$this->tblInfo->schema);
			$sTbls[0] = new dbMaster("vin_wars",$this->tblInfo->schema);
		   $val = $sTbls[0]->dbUpdRec($arr);
		}
		
		foreach($wTbls[0] as $name => $value)
		{
			 $this->$name = $value;
		}
		$this->AEE_POST = $E_POST;
		
		$this->rbc = $wTbls[0];
		return;
	}
	
	function dbDelRec($dtaObj)
	{
		$wTbls = array();
		$sTbls = array();
		
		$wTbls[0] = new dbMaster("vin_locs",$this->tblInfo->schema);
		$wTbls[0]->dbDelRec($dtaObj);
		
		if($dtaObj['Default_location'] == 1)
		{
			 $arr = array(	
			 "utype"=>"UPDATE",
			 "idVIN_WARS"=>$dtaObj['idVIN_WARS'],
			 "VIN_WARS_MALOC"=>'0',
			 "PROCESS"=>"VIN_WAREHOUSE",
			 "SESSION"=>"VIN_WARSCT",
			 "METHOD"=>"UPDATE",
			 "SCHEMA"=>$this->tblInfo->schema);
			 $sTbls[0] = new dbMaster("vin_wars",$this->tblInfo->schema);
		    $val = $sTbls[0]->dbUpdRec($arr);
		}
		
		foreach($wTbls[0] as $name => $value)
		{
			 $this->$name = $value;
		}
		$this->AEE_POST = $E_POST;
		
		$this->rbc = $wTbls[0];
return;
	}	
}

?>
