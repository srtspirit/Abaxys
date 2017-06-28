<?php

class vin_uset extends dbMaster
{
	function vin_uset($schema)
	{
		$this->dbMaster("vin_uset",$schema);
	}
	
	

	function dbSetTrig()
	{


$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vin_uset 

		LEFT JOIN vin_unit  ON idVIN_USET = VIN_UNIT_UNSET  [=COND:vin_unit=] 
								
		WHERE [=WHERE=]  [=COND:vin_uset=]  [=LIMIT=] ) tx		

		
EOD;


		return $trig;
		
		
		
	}	
	



// Testing 20160123
//		$this->dbPdoBeginTransac();
//		if ($this->brTrConn != null)
//		{
//			$this->hasWorked = true;
//			$this->dbPdoEndTransac(0);
//		}
//		else
//		{
//			$this->hasWorked = false;
//		}

			
			
	function dbInsRec($dtaObj)
	{
		
//		$this->dbPdoBeginTransac();
//		$wTbls[0]->rollBackConn = $this->brTrConn;
//		$this->dbPdoEndTransac(0);
			
				
		// Step One is insert idVIN_USET
  		$wTbls = array();
  		$wTbls[0] = new dbMaster("vin_uset",$this->tblInfo->schema);
		$wTbls[0]->dbInsRec($dtaObj);
		
		foreach($wTbls[0] as $name => $value)
		{
			 $this->$name = $value;
		}
		$this->E_POST = $E_POST;
				
		// $this->errorCode = $wTbls[0]->errorCode;
		
		$this->rbc = $wTbls[0];
		return;
		
		
	}


	function dbUpdRec($dtaObj)
	{

  		$wTbls = array();
  		$wTbls[0] = new dbMaster("vin_uset",$this->tblInfo->schema);
		$wTbls[0]->dbUpdRec($dtaObj);

	
		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		$this->errorCode = $wTbls[0]->errorCode;
		$this->recBad = "";
		$this->recMod = "";
		$this->recNew = "";
		foreach($wTbls[0] as $name => $value)
		{
			 $this->$name = $value;
		}
		$this->E_POST = $E_POST;
		
		
		$recSet = $E_POST["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet))
		{
			if ( $recSet[$occ]["idVIN_UNIT"] || $recSet[$occ]["ab-new"] == 1 )
			{
				$dbCount = count($wTbls);
				$recSet[$occ]["PROCESS"] = "VIN_USETS";
				$recSet[$occ]["SESSION"] = "VIN_USETS";
				$recSet[$occ]["TBLNAME"] = "vin_unit";			

				if($E_POST["VIN_USET_UVACT"] = 0 || $recSet[$occ]["VIN_UNIT_FACTO"] < 1 )
				{
					$recSet[$occ]["VIN_UNIT_FACTO"] = 1;
				}
				
				if ($recSet[$occ]["ab-new"] == 1)
				{
					
					if ($recSet[$occ]["trash"] == 1)
					{
						// Nothing;
					}
					else
					{
				  		$wTbls[$dbCount] = new dbMaster("vin_unit",$this->tblInfo->schema);
				  		$recSet[$occ]["VIN_UNIT_UNSET"] = $E_POST["idVIN_USET"];
						$wTbls[$dbCount]->dbInsRec($recSet[$occ]);
						
					}
				}
				else
				{
					if ($recSet[$occ]["trash"] == 1)
					{
				  		$wTbls[$dbCount] = new dbMaster("vin_unit",$this->tblInfo->schema);
						$wTbls[$dbCount]->dbDelRec($recSet[$occ]);

						
					}
					else
					{
				  		$wTbls[$dbCount] = new dbMaster("vin_unit",$this->tblInfo->schema);
						$wTbls[$dbCount]->dbUpdRec($recSet[$occ]);
						
					}
				}
			}
			else
			{
			}
			
			$occ += 1;
		}
		
		$this->pstRecset = $recSet;
		$this->RSresults = $wTbls;
		$this->Mresults = $wTbls[0];
		return;

	}
	function dbDelRec($dtaObj)
	{
		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
  		$wTbls = array();
		$recSet = $E_POST["RECSET"];
		
		$occ = 0;
		while ($occ < count($recSet))
		{
			if ( $recSet[$occ]["idVIN_UNIT"])
			{
				$dbCount = count($wTbls);
				$recSet[$occ]["PROCESS"] = "VIN_USETS";
				$recSet[$occ]["SESSION"] = "VIN_USETS";
				$recSet[$occ]["TBLNAME"] = "vin_unit";			

				if ($recSet[$occ]["trash"] == 1)
				{
			  		$wTbls[$dbCount] = new dbMaster("vin_unit",$this->tblInfo->schema);
					$wTbls[$dbCount]->dbDelRec($recSet[$occ]);
						
				}
			}
			$occ += 1;
		}

		$dbCount = count($wTbls);
  		$wTbls[$dbCount] = new dbMaster("vin_uset",$this->tblInfo->schema);
		$wTbls[$dbCount]->dbDelRec($dtaObj);
		
		$this->errorCode = $wTbls[$dbCount]->errorCode;
		foreach($wTbls[$dbCount] as $name => $value)
		{
			 $this->$name = $value;
		}
		$this->E_POST = $E_POST;

		$this->rbc = $wTbls[0];
		return;


	}

			
	
	
}


class vin_unit extends dbMaster
{
	function vin_unit($schema)
	{
		$this->dbMaster("vin_unit",$schema);
	}
	
	

	function dbSetTrig()
	{

$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vin_unit

		LEFT JOIN vin_uset  ON idVIN_USET = VIN_UNIT_UNSET  [=COND:vin_uset=] 
								
		WHERE [=WHERE=]  [=COND:vin_unit=]  [=LIMIT=] ) tx		

		
EOD;


		return $trig;
		
		
		
	}	
	
	




	
}

?>