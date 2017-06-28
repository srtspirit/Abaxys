<?php
/* [= User Session Var function =]*/
$DB = new DB();


class Session_Query {
	function __construct()
	{
		global $DB;
		
		$this->db = $DB;
	}
	
	function isMaster($userID) {
		
		$User_Info = $this->hasUserDetails($userID);
		$usrLevels["DfltLevel"] = $User_Info[0]['CFG_USERS_DFTLEVEL'];
		$usrLevels["DfltGroup"] = $User_Info[0]['CFG_USERS_DFTGROUP'];
		$this->db->select('*');
		$this->db->where(array('CFG_GROUPS_CODE' => 'MASTER'));	
		$grouplevel = $this->db->get('cfg_groups',3);
		$row = $grouplevel['row'];
		$list = $row[0]['CFG_GROUPS_LEVEL'];
		$listData = explode(",",$list);
	   $listData = array_values( array_filter($listData) );
		for($i=0;$i<count($listData);$i++) {
		   $levelDescr = $this->orglevelName($listData[$i]);
			$userdat['levelId'] = $listData[$i];
                        if($usrLevels["DfltLevel"]==$userdat['levelId']) {
			   $userdat['levelDescr'] = $levelDescr[0]['CFG_ORGLEVEL_CODE']."*";
			} else {
  			   $userdat['levelDescr'] = $levelDescr[0]['CFG_ORGLEVEL_CODE'];
			}
			$userdat['groupId'] = $row[0]['CFG_GROUPS_ID'];
			$userdat['groupDescr'] = $row[0]['CFG_GROUPS_DESIGNATION'];
			$usrLevels['Affectations'][$i] = $userdat; 
		}
		$usrLevels["CurrentAffect"] = $User_Info[0]['CFG_USERS_DFTLEVEL'];
		
		return $usrLevels;
	} 
	
	function isAdmin($userID) {
		
		$User_Info = $this->hasUserDetails($userID);
		$usrLevels["DfltLevel"] = $User_Info[0]['CFG_USERS_DFTLEVEL'];
		$usrLevels["DfltGroup"] = $User_Info[0]['CFG_USERS_DFTGROUP'];
		$this->db->select('*');
		$this->db->where(array('CFG_GROUPS_CODE' => 'ADM'));	
		$grouplevel = $this->db->get('cfg_groups',3);
		$row = $grouplevel['row'];
		$list = $row[0]['CFG_GROUPS_LEVEL'];
		$listData = explode(",",$list);
	   $listData = array_values( array_filter($listData) );
		for($i=0;$i<count($listData);$i++) {
		   $levelDescr =  $this->orglevelName($listData[$i]);
			$userdat['levelId'] = $listData[$i];
			if($usrLevels["DfltLevel"]==$userdat['levelId']) {
			   $userdat['levelDescr'] = $levelDescr[0]['CFG_ORGLEVEL_CODE']."*";
			} else {
  			   $userdat['levelDescr'] = $levelDescr[0]['CFG_ORGLEVEL_CODE'];
			}
			$userdat['groupId'] = $row[0]['CFG_GROUPS_ID'];
			$userdat['groupDescr'] = $row[0]['CFG_GROUPS_DESIGNATION'];
			$usrLevels['Affectations'][$i] = $userdat; 
		}
		$usrLevels["CurrentAffect"] = $User_Info[0]['CFG_USERS_DFTLEVEL'];
		
		return $usrLevels;
	}
	
	function isStd($userID) {
		$User_Info = $this->hasUserDetails($userID);
		$usrLevels["DfltLevel"] = $User_Info[0]['CFG_USERS_DFTLEVEL'];
		$usrLevels["DfltGroup"] = $User_Info[0]['CFG_USERS_DFTGROUP'];
	
		$defaultlevelDescr =  $this->orglevelName($User_Info[0]['CFG_USERS_DFTLEVEL']);
		$defaultgroupId =  $this->groupName($User_Info[0]['CFG_USERS_DFTGROUP']);
	   $userdefaultdat['levelId'] =  $User_Info[0]['CFG_USERS_DFTLEVEL'];;
	   $userdefaultdat['levelDescr'] = $defaultlevelDescr[0]['CFG_ORGLEVEL_CODE'];
		$userdefaultdat['groupId'] = $User_Info[0]['CFG_USERS_DFTGROUP'];
		$userdefaultdat['groupDescr'] = $defaultgroupId[0]['CFG_GROUPS_DESIGNATION'];
		$usrLevels['Affectations'][0] = $userdefaultdat;
		    
		 $this->db->select('CFG_GRPUSRLEVEL_ID,CFG_GRPUSRLEVEL_USER,CFG_GRPUSRLEVEL_LEVEL,CFG_GRPUSRLEVEL_GROUP');
		 $this->db->where(array('CFG_GRPUSRLEVEL_USER' => $userID));
		 $grpusrLevels = $this->db->get('cfg_grpusrlevel',3);
					if($grpusrLevels['num_rows'] > 0){
						$row = $grpusrLevels['row'];
						$j=1;
						for($i=0;$i<count($row);$i++) {
						
							$levelDescr =  $this->orglevelName($row[$i]['CFG_GRPUSRLEVEL_LEVEL']);
							$groupId =  $this->groupName($row[$i]['CFG_GRPUSRLEVEL_GROUP']);
			            $userdat['levelId'] = $row[$i]['CFG_GRPUSRLEVEL_LEVEL'];
			            $userdat['levelDescr'] = $levelDescr[0]['CFG_ORGLEVEL_CODE'];
			            $userdat['groupId'] = $groupId[0]['CFG_GROUPS_ID'];
			            $userdat['groupDescr'] = $groupId[0]['CFG_GROUPS_DESIGNATION'];
			            $usrLevels['Affectations'][$j] = $userdat;
			            $j++;
						}
					}
			$usrLevels["CurrentAffect"] = $User_Info[0]['CFG_USERS_DFTLEVEL'];
			
		return $usrLevels;
	}
	
	function hasAdmin($userId,$userType) {
	   if($userType=='MASTER') {
	      $hasAdmin = 'TRUE';
	   } elseif($userType=='ADM') {
	   	$hasAdmin = 'TRUE';
	   } else {
			$this->db->select('CFG_GROUPS_ID');
			$this->db->where(array('CFG_GROUPS_CODE' => 'ADM'));
			$GroupIDS = $this->db->get('cfg_groups',3);
			$GroupIDS = $GroupIDS['row'];	
			$Affectations = $this->hasAffectation($userId);	
			for($i=0;$i<count($Affectations['Affectations']);$i++) {
				$Affection_groupID[] =  $Affectations["Affectations"][$i]['groupId'];
			}
			if(in_array($GroupIDS[0]['CFG_GROUPS_ID'],$Affection_groupID)) {
				$hasAdmin = 'TRUE';
			} else {
				$hasAdmin = 'FALSE';
			}		
	   }
	   return $hasAdmin;
	}
	
	function hasAffectation($userID) {
		
		 $User_Info = $this->hasUserDetails($userID);	
		$defaultlevelDescr =  $this->orglevelName($User_Info[0]['CFG_USERS_DFTLEVEL']);
		$defaultgroupId =  $this->groupName($User_Info[0]['CFG_USERS_DFTGROUP']);
	   $userdefaultdat['levelId'] =  $User_Info[0]['CFG_USERS_DFTLEVEL'];;
	   $userdefaultdat['levelDescr'] = $defaultlevelDescr[0]['CFG_ORGLEVEL_CODE'];
		$userdefaultdat['groupId'] = $User_Info[0]['CFG_USERS_DFTGROUP'];
		$userdefaultdat['groupDescr'] = $defaultgroupId[0]['CFG_GROUPS_DESIGNATION'];
		$usrLevels['Affectations'][0] = $userdefaultdat;
		    
		 $this->db->select('CFG_GRPUSRLEVEL_ID,CFG_GRPUSRLEVEL_USER,CFG_GRPUSRLEVEL_LEVEL,CFG_GRPUSRLEVEL_GROUP');
		 $this->db->where(array('CFG_GRPUSRLEVEL_USER' => $userID));
		 $grpusrLevels = $this->db->get('cfg_grpusrlevel',3);
					if($grpusrLevels['num_rows'] > 0){
						$row = $grpusrLevels['row'];
						$j=1;
						for($i=0;$i<count($row);$i++) {
						
							$levelDescr =  $this->orglevelName($row[$i]['CFG_GRPUSRLEVEL_LEVEL']);
							$groupId =  $this->groupName($row[$i]['CFG_GRPUSRLEVEL_GROUP']);
			            $userdat['levelId'] = $row[$i]['CFG_GRPUSRLEVEL_LEVEL'];
			            $userdat['levelDescr'] = $levelDescr[0]['CFG_ORGLEVEL_CODE'];
			            $userdat['groupId'] = $groupId[0]['CFG_GROUPS_ID'];
			            $userdat['groupDescr'] = $groupId[0]['CFG_GROUPS_DESIGNATION'];
			            $usrLevels['Affectations'][$j] = $userdat;
			            $j++;
						}
					}
			
			
		return $usrLevels;
	}
	function hasUserType($userID) {
		
		$this->db->select("CFG_USERS_TYPE");
		$this->db->where(array('CFG_USERS_ID' => $userID));
		$r = $this->db->get('cfg_users',3);
		if($r['num_rows'] > 0){
			$row = $r['row'];
			return $row[0]['CFG_USERS_TYPE'];
		}
		return FALSE;
	}
	
	function hasUserDetails($userID) {
		
		$this->db->select("*");
		$this->db->where(array('CFG_USERS_ID' => $userID));
		$r = $this->db->get('cfg_users',3);
		if($r['num_rows'] > 0){
			$row = $r['row'];
			return $row;
		}
		return FALSE;
	}
	
	function orglevelName($id) {
		$this->db->select('*');
		$this->db->where(array('CFG_ORGLEVEL_ID' => $id));
		$r = $this->db->get('cfg_orglevel',3);
		if($r['num_rows'] > 0){
			$row = $r['row'];
			return $row;
		}
		return FALSE;
	}
	
	function groupName($id) {
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
