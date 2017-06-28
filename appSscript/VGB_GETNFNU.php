<?php



class vgb_getNextFreeNumber extends dbMaster
{
	function vgb_getNextFreeNumber($schema,$NFNCO,$E_POST,$rollBack)
	{

		$nfnuTbls = new dbMaster("vgb_nfnu",$schema);
		$nfnuObj = array();
		$nfnuObj["PROCESS"] = $E_POST["PROCESS"];
		$nfnuObj["SESSION"] = $E_POST["SESSION"];
		$nfnuObj["VGB_NFNU_NFNCO"] = $NFNCO; // ie "VSL_ORSI_GRPID";
		$nfnuTbls->dbFindMatch($nfnuObj);		
		
		$tObj = $nfnuTbls->result[0];
		$this->vgb_nextNumber = $tObj["VGB_NFNU_NFNVA"];
		
		if (count($nfnuTbls->result) > 0 )
		{
			$tObj["VGB_NFNU_NFNVA"] += 1;
			$tObj["PROCESS"] = $E_POST["PROCESS"];
			$tObj["SESSION"] = $E_POST["SESSION"];

			$nfnuTbls = new dbMaster("vgb_nfnu",$schema);
			$nfnuTbls->brTrConn = $rollBack;
			$nfnuTbls->dbUpdRec($tObj);			
		}	
		
		$this->vgb_nextNumberWR = $nfnuTbls;
	
	
	}
	
}

class vgb_setNextFreeNumber extends dbMaster
{	
	function vgb_setNextFreeNumber($schema,$NFNCO,$E_POST,$rollBack)
	{

		$nfnuTbls = new dbMaster("vgb_nfnu",$schema);
		$nfnuObj = array();
		$nfnuObj["PROCESS"] = $E_POST["PROCESS"];
		$nfnuObj["SESSION"] = $E_POST["SESSION"];
		$nfnuObj["VGB_NFNU_NFNCO"] = $NFNCO; // ie "VSL_ORSI_GRPID";
		$nfnuTbls->dbFindMatch($nfnuObj);		
		
		$tObj = $nfnuTbls->result[0];		
		if ($E_POST["NEXTFREENUMBER"])
		{
			$tObj["VGB_NFNU_NFNVA"] = $E_POST["NEXTFREENUMBER"];
			$tObj["PROCESS"] = $E_POST["PROCESS"];
			$tObj["SESSION"] = $E_POST["SESSION"];

			$nfnuTbls = new dbMaster("vgb_nfnu",$schema);
			$nfnuTbls->brTrConn = $rollBack;
			$nfnuTbls->dbUpdRec($tObj);			
		}	
		
		$this->vgb_nextNumberWR = $nfnuTbls;
	
	
	}
			
}

class vgl_getNextFreeNumber extends dbMaster
{
	function vgl_getNextFreeNumber($schema,$NFNCO,$E_POST,$rollBack)
	{

		$nfnuTbls = new dbMaster("vgl_nfnu",$schema);
		$nfnuObj = array();
		$nfnuObj["PROCESS"] = $E_POST["PROCESS"];
		$nfnuObj["SESSION"] = $E_POST["SESSION"];
		$nfnuObj["VGL_NFNU_NFNCO"] = $NFNCO; // ie "VGL_TRJN_TRNID";
		$nfnuTbls->dbFindMatch($nfnuObj);		
		
		$tObj = $nfnuTbls->result[0];
		$this->vgl_nextNumber = $tObj["VGL_NFNU_NFNVA"];
		
		if (count($nfnuTbls->result) > 0)
		{
			$tObj["VGL_NFNU_NFNVA"] += 1;
			$tObj["PROCESS"] = $E_POST["PROCESS"];
			$tObj["SESSION"] = $E_POST["SESSION"];

			$nfnuTbls = new dbMaster("vgl_nfnu",$schema);
			$nfnuTbls->brTrConn = $rollBack;
			$nfnuTbls->dbUpdRec($tObj);			
		}	
		
		$this->vgl_nextNumberWR = $nfnuTbls;
	
	
	}
}


class vgl_setNextFreeNumber extends dbMaster
{
	
	function vgl_setNextFreeNumber($schema,$NFNCO,$E_POST,$rollBack)
	{

		$nfnuTbls = new dbMaster("vgl_nfnu",$schema);
		$nfnuObj = array();
		$nfnuObj["PROCESS"] = $E_POST["PROCESS"];
		$nfnuObj["SESSION"] = $E_POST["SESSION"];
		$nfnuObj["VGL_NFNU_NFNCO"] = $NFNCO; // ie "VGL_TRJN_TRNID";
		$nfnuTbls->dbFindMatch($nfnuObj);
		$tObj = $nfnuTbls->result[0];		
		
		if ($E_POST["NEXTFREENUMBER"])
		{
			$tObj["VGL_NFNU_NFNVA"] = $E_POST["NEXTFREENUMBER"];
			$tObj["PROCESS"] = $E_POST["PROCESS"];
			$tObj["SESSION"] = $E_POST["SESSION"];
		
			$nfnuTbls = new dbMaster("vgl_nfnu",$schema);
			$nfnuTbls->brTrConn = $rollBack;
			$nfnuTbls->dbUpdRec($tObj);			
		}	
		
		$this->vgl_nextNumberWR = $nfnuTbls;
	
	
	}
		
}



?>
