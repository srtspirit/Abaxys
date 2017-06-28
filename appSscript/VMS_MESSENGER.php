<?php


class vms_usrmess extends dbMaster
{

	function vms_usrmess($schema)
	{
		$this->dbMaster("vms_usrmess",$schema);
		
	}

	function dbUpdRec($dtaObj)
	{
		$this->dbFnct = "dbUpdRec";
		$this->localPost = $dtaObj;
		$this->vmsUpdateFlag = $dtaObj["vmsUpdateFlag"];
		$this->vmsUpdateId = $dtaObj["vmsUpdateId"];
		
		$readObj = array();
		$readObj["PROCESS"] = $dtaObj["PROCESS"];
		$readObj["SESSION"] = $dtaObj["SESSION"];
		$readObj["TBLNAME"] = $dtaObj["TBLNAME"];
		$readObj["idVMS_USRMESS"] = $dtaObj["vmsUpdateId"];
		
	  	$wTbls = new dbMaster("vms_usrmess",$this->tblInfo->schema);
		$wTbls->dbFindMatch($readObj);	
		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}		
		
		if ($this->errorCode == 0 && count($this->result)>0)
		{
			$condition = $this->result[0]["VMS_USRMESS_CONVID"];
		
			$trig = "UPDATE messenger.vms_usrmess SET VMS_USRMESS_READ='0' WHERE VMS_USRMESS_CONVID = '" . $condition . "' ;";
			$wTbls->result[0]{"VMS_USRMESS_READ"} = "0";
			if ($this->vmsUpdateFlag!="OPEN")
			{
				$trig = "UPDATE messenger.vms_usrmess SET VMS_USRMESS_READ='1' WHERE VMS_USRMESS_CONVID = '" . $condition . "' ;";
				$wTbls->result[0]{"VMS_USRMESS_READ"} = "1";
			}
	
		  	$updTbls = new dbMaster("vms_usrmess",$this->tblInfo->schema);
			$updTbls->dbProcessTransactionPdo($trig);
			foreach($updTbls as $name => $value)
			{
				 $this->$name = $value;
			}		
			$this->result = $wTbls->result;
			$this->trigger = $trig;
		}
		
		
	}


}


?>
