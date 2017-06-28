<?php


class cfg_pro extends dbMaster
{

// New approach after detecting problem with have manu joins in statement 

	function cfg_pro($schema)
	{
		$this->dbMaster("cfg_pelements",$schema);
		
	}

	function dbSetTrig()
	{

		
$trig = <<<EOD
			SELECT  * FROM   
			 
		 	( SELECT  * FROM cfg_pelements  
		 	
		LEFT JOIN cfg_process  ON CFG_PROCESS_ID = CFG_PELEMENTS_PROCESS  
		LEFT JOIN cfg_session  ON CFG_SESSION_ID = CFG_PELEMENTS_SESSION 

		 	
		WHERE [=WHERE=]  [=COND:cfg_pelements=] [=ORDBY=] [=LIMIT=] ) tx	  
		
EOD;

		return $trig;
	}


}


class cfg_process_session extends dbMaster
{
	
	function cfg_process_session($schema)
	{
		$this->dbMaster("cfg_pelements",$schema);
		
	}
	
	
	function dbFindMatch($dtaObj)
	{

		
		$dtaObj["MAXREC_OUT"] = 0; // No limit
		$dtaObj['SORTED'] = "CFG_PROCESS_CODE";
		$dtaObj["CFG_PELEMENTS_ID"] = "0";
  		$wTbls = new cfg_pro($this->tblInfo->schema);
		$wTbls->dbFindFrom($dtaObj);		

		foreach($wTbls as $name => $value)
		{
			 $this->$name = $value;
		}
		
		
	}	
}