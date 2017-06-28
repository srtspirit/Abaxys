<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vin_orhe"] = "dbMain";


	$scope.ACVarFilterHide = function()
	{
	
		$("[id^='flt']").addClass("ACdropdown");
	}
	

	$scope.ACVarFilterToggle = function(colName)
	{
		
		
		if ( !$scope["Orglist"+colName] || $scope["Orglist"+colName]== "")
		{
			 $scope["Orglist"+colName] =  $scope["list"+colName];
		}
			
		$("[id^='flt']").each(function()
		{
			if ($(this).attr("id") != "flt"+colName)
			{
				$(this).addClass("ACdropdown")
			}
		});
		
		$("#flt"+colName).toggleClass("ACdropdown");
	}	
	
	$scope.ACVarColSelToggle = function(colName,colVal)
	{

		var xSearch = $scope["list"+colName];
		var chkVal = encodeURI(colVal)
	
		// alert(colName +"="+colVal+"="+chkVal+"=="+xSearch.indexOf("'" + chkVal + "'"))

		if (xSearch.indexOf("'" + chkVal + "'") > -1)
		{
			// Remove
			xSearch = xSearch.slice(0,xSearch.indexOf("'" + chkVal + "'")) + xSearch.slice(xSearch.indexOf("'" + chkVal + "'")+chkVal.length+2)
		}
		else
		{
			//Add
			xSearch += "'" + chkVal + "'"
		}

		$scope["list"+colName] = xSearch;

		$scope.ACVarFilterInit(colName,xSearch);

		
	}
	
	$scope.ACVarColSetIsOn = function(colName,colVal)
	{
		var xSearch = $scope["list"+colName];
		var chkVal = encodeURI(colVal)
	
		if (xSearch.indexOf("'" + chkVal + "'") > -1)
		{
			return true;
		}	
		else
		{
			return false;
		}
	}
	
	
	A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}




A_LocalAgularFn.prototype.VIN_ORHECT = function($scope,$http,$routeParams) 
{

	$scope.utype = $scope.opts.updType;

	$scope.ACVarDivHide = function()
	{
	
		$("[id^='flt']").addClass("ADdropdown");
	}
	

	$scope.ACVarDivToggle = function(colName)
	{
		
			
		$("[id^='flt']").each(function()
		{
			if ($(this).attr("id") != "flt"+colName)
			{
				$(this).addClass("ADdropdown")
			}
		});
		
		$("#flt"+colName).toggleClass("ADdropdown");
	}	
	


	// alert(showProps($scope.opts,"op"))

	// I included this below to comply with your current HTML. But you must modify VIN_ITEMS to directly call ABlstAlias in $inTrig kPress statements
	// You must rewrite the function to specify "vin_item"  in reference to ng-repeat="x in vin_item"
	// Will give same resuls and will comply to naming convention.
	
	// If you write in your prototype a function called $scope.localABupd()
	// ABUpd() function will call this function with the option variable "UPDATE,CREATE,DELETE"
	// If you want to cancel the operation the set variable $scope.ABupdCancel = true
	// In your code you can prepare data for the update 

	$scope.localABupd = function(opt)
	{
		if (!A_Scope.cancelBack)
		{
			A_Scope.cancelBack = "";
		}
		// A_Scope.cancelBack += "$scope.resetOrheForm(10);";

	}

	$scope.setOrheFormInvisible = function()
	{
		$("#ab-buttonPad").addClass('invisible');
	}
	
	$scope.resetOrheForm = function(tCount)
	{	
		if (!dDta["timeout"])
		{
			dDta["timeout"] = "";
		}
		
		dDta["timeout"] += "=" + tCount;
		
		dDta["timer"] = setTimeout(function()
		{
			$("#ab-buttonPad").removeClass('invisible');
			dDta["timeout"] += "doneOrg--";
		
		},tCount);
	}
	

	$scope.ABsessionUrl ="#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item";

	$scope.saveForProcess = function(flag)
	{

		if (flag && flag.toUpperCase()=="PROCESS")
		{
			$scope.dbProcessTransaction = 1;
			setTimeout(function()
			{
				A_Scope.callBack="$scope.formChange();$scope.dbProcessTransaction = 0;"
				$scope.ABupd("UPDATE");

			},100);
			$('#openUdateConfirm').click();	
			return;
		}
			
		if ($scope.dbProcessTransaction == 0)
		{
			setTimeout(function()
			{
				A_Scope.callBack="if(data['posts'].errorCode==0){$('#openUdateConfirm').click();$('#ab-main-rec-mess').html('');}"
				$scope.ABupd("UPDATE");

			},100);	
		}
		else
		{
			$scope.processReady='';			
			$scope.dbProcessTransaction=0;
		}
		
	}
	
	$scope.formChange = function()
	{
		$scope.processReady='';			
		$scope.dbProcessTransaction=0;
		
	}
	

	$scope.saveNewLine = function(INVIT,ord)
	{
		
		if (INVIT == "1")
		{
			var newRecValid = true;
			var occ = 0;
			var record = $scope.rawResult.vin_orhe;
			
			while (occ < record.length && newRecValid == true)
			{
				if (record[occ]["VIN_ORDE_ORLIN"] > 0)
				{
					if (record[occ]["idVIN_ITEM"] == ord["VIN_ORDE_ITMID"])
					{
						ord.VIN_ITEM_ITMID = "";
						ord.VIN_ORDE_ITMID = "";
						ord.VIN_ORDE_UNSET = 0;
						ord.VIN_ORDE_QTUOM = 0;
						ord.VIN_ORDE_FACTO = 0;
						ord.VIN_ORDE_WARID = 0;
						ord.VIN_ITEM_DESC1 = "*** Item [" + record[occ]["VIN_ITEM_ITMID"] + "] already on this order *** ";						
						newRecValid = false;
					}
				}
				
				occ += 1;
			}
			
			if (newRecValid == true)
			{
				
				setTimeout(function()
				{
					$scope.ABupd("UPDATE");
					
				
				},100);	
			}
		}
		else
		{
	
			ord.VIN_ITEM_ITMID = "";
			ord.VIN_ORDE_ITMID = "";
			ord.VIN_ORDE_UNSET = 0;
			ord.VIN_ORDE_QTUOM = 0;
			ord.VIN_ORDE_FACTO = 0;
			ord.VIN_ORDE_WARID = 0;
			ord.VIN_ITEM_DESC1 = "*** NOT AN INVENTORY ITEM *** ";
			
		}
			
	}
	






	$scope.insertInDetail = function()
	{
		var nextLine = 0;
		var occ = 0;
		var newLine = 0;
		var newCount = 0;
		var nlFound = false;
		
		while (occ < $scope.rawResult.vin_orhe.length)
		{
			
			if (nextLine <  Number($scope.rawResult.vin_orhe[occ].VIN_ORDE_ORLIN))
			{
				nextLine = Number($scope.rawResult.vin_orhe[occ].VIN_ORDE_ORLIN);
			}
			if ($scope.rawResult.vin_orhe[occ].VIN_ORDE_ORLIN < 0 && nlFound == false)
			{
				newLine = occ;
				nlFound = true;
			}
			occ += 1;
		}
		
		if (nextLine < 1)
		{
			nextLine = 10;
		}
		else
		{
			nextLine += 10;
		}
		if (Math.floor(nextLine) != nextLine)
		{
			nextLine = Math.floor(nextLine+10)
		}
		
		if ($scope.rawResult.vin_orhe[newLine].VIN_ORDE_ORLIN < 0)
		{
			$scope.rawResult.vin_orhe[newLine].idVIN_ORDE = $scope.rawResult.vin_orhe[newLine].VIN_ORDE_ORLIN;
			$scope.rawResult.vin_orhe[newLine].VIN_ORDE_ORLIN = nextLine
			$scope.rawResult.vin_orhe[newLine].VIN_ORDE_ORDQT = 0;
			$scope.rawResult.vin_orhe[newLine].VIN_ORDE_ITMID = 0;
			$scope.rawResult.vin_orhe[newLine].VIN_ORDE_OUNET = 0;
			$scope.rawResult.vin_orhe[newLine].VIN_ORDE_WARID = 0;
			$scope.rawResult.vin_orhe[newLine].VIN_ORDE_LOCID = 0;

			$scope.rawResult.vin_orhe[newLine].VIN_ITEM_ITMID = "";
			$scope.rawResult.vin_orhe[newLine].VIN_ITEM_DESC1 = "";
			$scope.rawResult.vin_orhe[newLine].VIN_ITEM_LOTCT = 0;


			newCount += 1; 
		}
		
		// $scope.chkCurrMain();
		setTimeout("ABsetDatepickers();",50)	
		
	}

	$scope.lotQtyIn = function(orLin)
	{
		var debug = "" 
		var occ = 0
		var tQty  = 0;
		$("#ordeLine" + orLin).find("[ng-model='lstr.VIN_LSTR_ALOQT']").each(function()
		{
			tQty += ($(this).val() * 1)
			occ += 1
			debug += occ +"= " +  $(this).val() + " for " + tQty + "\n"
		});
		
		debug += "\n-----\n" + $("#ordeLine" + orLin).html() 
		$("#focusGrid").val(debug)
		return tQty;
		
	}
	
	$scope.hasToProcess = function()
	{
		var ret = false;
		if ($scope.idVIN_ORHE > 0)
		{
			var recSet = $scope.rawResult.vin_orhe;
			var occ = 0;
			while (occ < recSet.length && ret==false)
			{
				if (recSet[occ].idVIN_ORDE > 0 && (recSet[occ].VIN_ORDE_ORDQT != 0 || recSet[occ].VIN_LSTR_ALOQT != 0 ))
				{
					ret = true;
				}
				occ += 1;
				
			}
	
		}
		
		return ret;
		
	}
	
	$scope.lotNotIn = function(recSet,orLin,lotId)
	{
		
		var ret = true;
		var occ = 0;
		while (occ < recSet.length && ret==true)
		{
			if (recSet[occ].idVIN_ORDE == orLin && recSet[occ].VIN_LSTR_LOTSQ == lotId)
			{
				ret = false;
			}
			occ += 1;
			
		}
		
		return ret;
		
	}



	$scope.delSet = function()
	{
		$("[ng-model$='.trash']").val("1")
		$("[ng-model$='.trash']").attr("checked",true);
		$("[ng-model$='.trash']").parent("td").addClass("text-danger");
		$("[ng-model$='.trash']").parents("tr").find("[ng-model]").addClass("text-danger");
	
		A_Scope.callBack = "$scope.unDelSet();";
		$scope.ABupd('DELETE');
		
		if (A_Scope.callBack == "//cancel;")
		{
			A_Scope.callBack = "";
			$scope.unDelSet();
		}
		
	}
	
	
	
	$scope.unDelSet = function()
	{
		
		$("[ng-model$='.trash']").val("0")
		$("[ng-model$='.trash']").removeAttr("checked");
		$("[ng-model$='.trash']").parent("td").removeClass("text-danger");
		$("[ng-model$='.trash']").parents("tr").find("[ng-model]").removeClass("text-danger");
		
	} 
	
	
	
	

	


	$scope.initOrder = function(flag)
	{
		$scope.ABinitTbl("vin_orhe","idVIN_ORHE")
		$scope.ABupdChkObj("idVIN_ORHE",$scope.opts.idVIN_ORHE,true);
		A_Scope.callBack = "$scope.chkOrderProcessed();";
		if (flag && flag=="all")
		{
			A_Scope.callBack += "$scope.initSupportTblUnit();";
		}
		$scope.ABchk();
	}

	$scope.initSupportTblUnit = function()
	{
		// alert("initSupportTblUnit")
		// ABsearchAlias = function(mainTbl,suppTbls,pattern,alias,orderBy,callBack)
		
		$scope.ABsearchAlias('vin_unit','','[=SPE=] idVIN_UNIT > 0','vin_unit','','$scope.initSupportTblCurr();')
		
	}

	$scope.initSupportTblCurr = function()
	{
		// alert("initSupportTblCurr")
		// $scope.ABsearchAlias('vgb_curr','','[=SPE=] idVGB_CURR > 0','vin_curr','','$scope.initSupportTblUsr();')
		$scope.ABsearchAlias('vgb_curr','','[=SPE=] idVGB_CURR > 0','vin_curr','','$scope.getUsers();')
		
	}

	$scope.initSupportTblUsr = function()
	{
		// alert("initSupportTblUsr")
		$scope.ABsearchAlias('cfg_users','','[=SPE=] CFG_USERS_ID > 0','vin_users','','')
	}
	
	$scope.getSource = function()
	{
		var ret = "adjust";
		if ($scope.idVIN_ORHE > 0)
		{
			ret = $scope.VIN_ORHE_OTYPE;
		}
			
		return ret;	
	}

	$scope.chkOrderProcessed = function()
	{
		if ($scope.VIN_ORHE_PROCESS == 1)
		{
			$("#ab-sysOpt").html('');
		}
		// alert("chkOrderProcessed")
	}


	
	$scope.getUsers = function()
	{
		$scope["CFG_USERS_CODE"] = " "; 
		$scope.ABlstAlias('CFG_USERS_CODE','CFG_USERS_CODE','cfg_users','vin_users');
		
	}

	$scope.AAVIN_ORHECT_BEGIN = function(){}
	
	$scope.formChange();
	$scope.initOrder("all");
	
	// $scope.initSupportTblUnit();
	
	$scope.newRecord = new Array();

	
	
	
}

A_LocalAgularFn.prototype.VIN_ORDERS = function($scope,$http,$routeParams)
{
	
	

	// I included this below to comply with your current HTML. But you must modify VIN_ITEMS to directly call ABlstAlias in $inTrig kPress statements
	// You must rewrite the function to specify "vin_item"  in reference to ng-repeat="x in vin_item"
	// Will give same resuls and will comply to naming convention.
	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		
		$scope.ABlstAlias(ce,obj,tbl,"vin_orhe")
	}
	
	$scope.VIN_ORHE_ORNUM = ""
	$scope.kPress('VIN_ORHE_ORNUM','VIN_ORHE_ORNUM','vin_orhe',0)
	
	
	
}
	





</script>



