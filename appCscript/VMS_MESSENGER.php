
<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}


A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{
    
	 
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}		


A_LocalAgularFn.prototype.VMS_MESSENGER = function($scope,sName)
{
	
	
	$scope.conditionSend = function()
	{
		var ret = true;
		$scope.updateConfirmMessage = "Can not be sent";
		$scope.updateConfirmError = new Array();
		var occ = 0
		
		if (!$scope.VMS_USRMESS_DSTUSR || $scope.VMS_USRMESS_DSTUSR < 1)
		{
			ret = false;
			occ = $scope.updateConfirmError.length;
			$scope.updateConfirmError[occ] = new Object();
			$scope.updateConfirmError[occ]["text"] = "- You must supply destination user Id";
		}
		if (!$scope.VMS_USRMESS_ORGUSR || $scope.VMS_USRMESS_ORGUSR < 1)
		{
			ret = false;
			occ = $scope.updateConfirmError.length;
			$scope.updateConfirmError[occ] = new Object();
			$scope.updateConfirmError[occ]["text"] = "- You must supply sender user Id";
		}
		
		var text = $scope.VMS_USRMESS_MTEXT;
		if (!text || text.trim() == "")
		{
			ret = false;
			occ = $scope.updateConfirmError.length;
			$scope.updateConfirmError[occ] = new Object();
			$scope.updateConfirmError[occ]["text"] = "- Your text is empty";
		}
		
		if (ret == false)
		{
			
			$scope.messUpdateMethod = "ERROR";
			$("#openUdateConfirm").click();
			
		}
		else
		{
			$scope.ABupd('CREATE');
		}
		
	}
	
	$scope.localupd = function(flag)
	{
		$scope.vmsUpdateFlag = flag;
		$scope.vmsUpdateId = $scope.original["idVMS_USRMESS"] 
		
		if (flag!="" && $scope.vmsUpdateId > 0)
		{
			setTimeout(function()
			{
				$scope.ABupd('UPDATE');				
				
			},100);
				

		}

		
	}
	
	$scope.setUpdate = function()
	{
		if ($scope.VMS_USRMESS_READ=='0')
		{
			$scope.messUpdateMethod = "Complete";
			$scope.updateConfirmMessage = "Confirm completion of notification";
		}
		else
		{
			$scope.messUpdateMethod = "Open";
			$scope.updateConfirmMessage = "Confirm re-opening of notification";
		}
		
		$("#openUdateConfirm").click();
		
	}

	$scope.updUsrVal = function(vVal)
	{
		$scope["VMS_USRMESS_DSTUSR"] = vVal;

	}	

	$scope.isNewMessage = function()
	{
		var ret = false;
		if ($scope["idVMS_USRMESS"] == "" && $scope["VMS_USRMESS_CONVID"] == "" && $scope["VMS_USRMESS_TSTAMP"] =="")
		{
			ret = true;
		}
		
		return ret;
		
	}

	$scope.setNewMessage = function(currUsrId)
	{
		var objRead = new Object();
		objRead["idVMS_USRMESS"] = 0;
		A_Scope.callBack = "$scope.setNewMessageFields(" + currUsrId + " );";
		$scope.ABchk(objRead,"vms_usrmess");
	}
	
	$scope.setNewMessageFields = function(userId)
	{
		$scope["idVMS_USRMESS"] = "";
		$scope["VMS_USRMESS_CONVID"] = "";
		$scope["VMS_USRMESS_TSTAMP"] ="";
		$scope["VMS_USRMESS_ORGUSR"] = userId;
		$scope["VMS_USRMESS_READ"] = '0';
		$scope["VMS_USRMESS_MTEXT"] = '';
		$scope["VMS_USRMESS_PRLEV"] = "C01";
	}
		
	$scope.getUsers = function()
	{
		
		if (!$scope["sys_users"] )
		{
			var mainTbl = "cfg_users";
			var suppTbls = "cfg_orglevel:CFG_ORGLEVEL_ID = CFG_USERS_DFTLEVEL ";
			var alias = "sys_users";
			var pattern = "[=SPE=]CFG_USERS_TYPE = 'STD' ";
			var orderBy = " CFG_USERS_DESIGNATION ";
			var objFunctions = "";
			var objGroupBy = "";
			$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"$scope.calledEdit();",objFunctions,objGroupBy);			
		}
		
	}
	
	$scope.initDisplayData = function(userId)
	{
		$scope.userMainId = userId;
		var mainTbl = "vms_usrmess";
		var suppTbls = "";
		var alias = "vms_usrmess_lst";
		var pattern = "[=SPE=](VMS_USRMESS_DSTUSR = " + userId + " OR VMS_USRMESS_ORGUSR = " + userId + ") " + $scope.messWhere;
		var orderBy = "VMS_USRMESS_CONVID DESC ";
		var objFunctions = ""; //" COUNT(idVMS_USRMESS) as recCountMess ";
		var objGroupBy = ""; //"idVMS_USRMESS";
		$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"$scope.getUsers();" + A_Scope.callBack ,objFunctions,objGroupBy);
		
	}

	$scope.setUserFilter= function(userId)
	{
		if (userId == 0)
		{
			$scope.userFilter = new Array();
			return;
		}
		var userList = "," + $scope.userFilter.join(",") + ",";
		if (userList.indexOf("," + userId + ",") > -1)
		{
			userList = userList.replace("," + userId + "," , ",");
		}
		else
		{
			userList += userId + ","
		}
		
		userList = userList.replace(",," ,",")
		
		if (userList.indexOf(",") == 0)
		{
			userList = userList.slice(1);
		}
		if (userList.lastIndexOf(",") == userList.length-1)
		{
			userList = userList.slice(0,userList.length-1);
		}
		
		if (userList.length == 0)
		{
			$scope.userFilter = new Array();
		}
		else
		{
			$scope.userFilter = userList.split(",");
		}
		
		
	}

	$scope.isUserSelected= function(userId)
	{
		var ret = false;
		var userList = "," + $scope.userFilter.join(",") + ",";
		if (userList.indexOf("," + userId + ",") > -1)
		{
			ret = true;
		}		
		
		return ret;
	}

	$scope.searchHistoryData = function(userId)
	{
		var tPattern = $scope.searchPattern;
		var sPattern = "";
		
		tPattern = tPattern.trim();
		if (tPattern.length>0)
		{
			sPattern = "  AND ( VMS_USRMESS_TSTAMP LIKE '%" + tPattern + "%' OR VMS_USRMESS_MTEXT LIKE '%" + tPattern  + "%' ) ";
		}
		if ($scope.userFilter.length>0)
		{
			sPattern += " AND ( ";
			var xOr = "";
			var occ = 0;
			while (occ < $scope.userFilter.length)
			{
				sPattern += xOr + "VMS_USRMESS_DSTUSR = " + $scope.userFilter[occ] + " OR VMS_USRMESS_ORGUSR = " + $scope.userFilter[occ];
				xOr = " OR ";
				occ += 1;
			}
			sPattern += " )";

		}
		
		var mainTbl = "vms_usrmess";
		var suppTbls = "";// "org_dimension.cfg_users:CFG_USERS_ID=VMS_USRMESS_ORGUSR OR CFG_USERS_ID=VMS_USRMESS_DSTUSR ";
		var alias = "vms_usrmess_tmp";
		var pattern = "[=SPE=](VMS_USRMESS_DSTUSR = " + userId + " OR VMS_USRMESS_ORGUSR = " + userId + ") AND VMS_USRMESS_READ = '1' " + sPattern ;
		
		var orderBy = "VMS_USRMESS_CONVID DESC ";
		var objFunctions = "";
		var objGroupBy = "";
		$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"$scope.filterHistoryData();",objFunctions,objGroupBy);
	}
	
	$scope.filterHistoryData = function()
	{
		delete $scope.vms_usrmess_hist;
		var tPattern = ""
		var tOr = ""
		var occ = 0;
		while ($scope.vms_usrmess_tmp && occ < $scope.vms_usrmess_tmp.length)
		{
			if (tPattern.indexOf("'" + $scope.vms_usrmess_tmp[occ]["VMS_USRMESS_CONVID"] + "'") == -1)
			{
				tPattern += tOr + " VMS_USRMESS_CONVID = '" + $scope.vms_usrmess_tmp[occ]["VMS_USRMESS_CONVID"] + "' ";
				tOr = " OR ";
			}
			occ += 1;
		}
		if (tPattern.length > 0)
		{
			var mainTbl = "vms_usrmess";
			var suppTbls = "";// "org_dimension.cfg_users:CFG_USERS_ID=VMS_USRMESS_ORGUSR OR CFG_USERS_ID=VMS_USRMESS_DSTUSR ";
			var alias = "vms_usrmess_hist";
			var pattern = "[=SPE=]" + tPattern
			
			var orderBy = "VMS_USRMESS_CONVID DESC ";
			var objFunctions = "";
			var objGroupBy = "";
			$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"",objFunctions,objGroupBy);			
		}
		
	}
	
	
	$scope.initSearchType = function(flag)
	{
		$scope.messWhere = " AND VMS_USRMESS_READ = '" + flag + "' ";
	}

	$scope.userFilter = new Array();
	$scope.searchPattern = "";
	$scope.initSearchType(0);
	
	if ($scope.opts.VMS_USRMESS_CONVID)
	{
		$scope.specsWhere = " VMS_USRMESS_CONVID = " + $scope.opts.VMS_USRMESS_CONVID + " AND  VMS_USRMESS_ORIGIN = '1' ";
	}
	
	$scope.calledEdit = function()
	{

		if (!$scope.specsWhere)
		{
			return;
		}

		var mainTbl = "vms_usrmess";
		var suppTbls = "";
		var alias = "vms_usrmess_get";
		var pattern = "[=SPE=]" + $scope.specsWhere;
		var orderBy = "VMS_USRMESS_CONVID DESC ";
		var objFunctions = "";
		var objGroupBy = "";
		$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"$scope.calledEditPrep();",objFunctions,objGroupBy);		

		delete $scope.specsWhere;
		
	}

	$scope.calledEditPrep = function()
	{
		if ($scope.vms_usrmess_get.length > 0)
		{
			var messId = $scope.vms_usrmess_get[0]["idVMS_USRMESS"];
			$scope.editUsrmess(messId,$scope.userMainId);
		}
	}

	
	$scope.editUsrmess = function(vms_usrmessId,currUsrId)
	{
		var objRead = new Object();
		objRead["idVMS_USRMESS"] = vms_usrmessId;
		A_Scope.callBack = "$scope.setRecDefault(" + currUsrId + " );";
		$scope.ABchk(objRead,"vms_usrmess");
	}
	
	$scope.setRecDefault = function(currUsrId)
	{
		$scope.vmsUpdateFlag = "";
		$scope.vmsUpdateId = 0;
		
		delete $scope.original;
		if ($scope.idVMS_USRMESS < 1)
		{
		}
		else
		{
			$scope.original = new Object();
			
			$scope.original["idVMS_USRMESS"] 	= $scope["idVMS_USRMESS"];
			$scope.original["VMS_USRMESS_CONVID"] 	= $scope["VMS_USRMESS_CONVID"];
			$scope.original["VMS_USRMESS_DSTUSR"] 	= $scope["VMS_USRMESS_DSTUSR"];
			$scope.original["VMS_USRMESS_ORGUSR"] 	= $scope["VMS_USRMESS_ORGUSR"];
			$scope.original["VMS_USRMESS_TSTAMP"] 	= $scope["VMS_USRMESS_TSTAMP"];
			$scope.original["VMS_USRMESS_READ"] 	= $scope["VMS_USRMESS_READ"];
			$scope.original["VMS_USRMESS_PRLEV"] 	= $scope["VMS_USRMESS_PRLEV"];
			$scope.originalText = $scope.ABdisplayText($scope["VMS_USRMESS_MTEXT"]);
			
			
			$scope["idVMS_USRMESS"] = "";
			if ($scope["VMS_USRMESS_ORGUSR"] != currUsrId)
			{
				$scope["VMS_USRMESS_DSTUSR"] = $scope.original["VMS_USRMESS_ORGUSR"];
				$scope["VMS_USRMESS_ORGUSR"] = $scope.original["VMS_USRMESS_DSTUSR"];
			}
			// $scope["VMS_USRMESS_READ"] = '0';
			$scope["VMS_USRMESS_MTEXT"] = '';
			
			var mainTbl = "vms_usrmess";
			var suppTbls = "";
			var alias = "vms_usrmess_detail";
			var pattern = "[=SPE=]VMS_USRMESS_CONVID = '" + $scope["VMS_USRMESS_CONVID"] + "' ";
			pattern += " AND (VMS_USRMESS_DSTUSR = " + $scope["VMS_USRMESS_ORGUSR"] + " OR VMS_USRMESS_ORGUSR = " + $scope["VMS_USRMESS_ORGUSR"] + ") "; 
			var orderBy = "VMS_USRMESS_TSTAMP ASC ";
			var objFunctions = "";
			var objGroupBy = ""; 
			$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"",objFunctions,objGroupBy);			
			
		}
	}
	

}



</script>
