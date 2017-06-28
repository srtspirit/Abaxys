<?php

class vit_issue extends dbMaster
{
	function vit_issue($schema)
	{
		$this->dbMaster("vit_issue",$schema);
	}

	function dbSetTrig()
	{
     
	// $localWhere = " OR idVIT_ISSUE>0 ";
  
$trig = <<<EOD
			SELECT  * FROM   
			 
		 	( SELECT  * FROM vit_issue  
		 	
		LEFT JOIN vit_issdet ON idVIT_ISSUE = VIT_ISSDET_ISSUEID  [=COND:vit_issdet=] 
								
		WHERE [=WHERE=]  [=COND:vit_issue=]  [=LIMIT=] ) tx	  
		
EOD;
		
	return $trig;
	
	}
}
?>
