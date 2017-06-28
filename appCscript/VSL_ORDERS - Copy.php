<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vsl_orhe"] = "dbMain";

	$scope.initStepList = function()
	{

		$scope["VSL_STEP_LIST"] = new Array();
	
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();						                                             
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "DD_ACKN";                                             
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";                                             
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_ACKID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_DD_ACKN";                         
	 	$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Quote"; 
	        
	                                                   
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();                                           
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "DE_AOKN";                                   
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "example_ACKN.php";                                   
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_AOKID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_DE_AOKN";                         
	        $scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Acknowledge"; 
	                                                                                                                                
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();                                           
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "EE_SCED";                                   
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";                                   
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_SCEID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_EE_SCED";  
	        $scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Reserve";  	                                           
	                                                                   
	                                                                                                                                                                     
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "FF_PICK";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "example_PICK.php";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_PICID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_FF_PICK";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Picking";  
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "GG_RELE";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_RELID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_GG_RELE";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Release";     
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "HH_PACK";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "example_PACK.php";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_PAKID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_HH_PACK";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Pack";           
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "II_DELI";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_DELID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_II_DELI";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Deliver";        
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "JJ_INVO";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_JJ_INVO";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Confirm Del.";     
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "KK_PURG";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_KK_PURG";
	        $scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Invoicing";            
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "QQ_PURG";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_QQ_PURG";
	        $scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Completed";         

	}
	
	$scope.initStepList();
	




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
	
		if (xSearch && xSearch.indexOf("'" + chkVal + "'") > -1)
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

A_LocalAgularFn.prototype.VSL_VARIANCES = function($scope,$http,$routeParams) 
{

	$scope.ACVarFilterInit = function(colName,colVal)
	{
		// colVal = $scope["list"+colName];
		
		var occ = 0;
		while (occ < $scope["rawResult"]["vsl_varie"].length)
		{	
			if ( !$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["hidden"] = "  ";
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
			}
			
			$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vsl_varie"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vsl_varie"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
	
}	


A_LocalAgularFn.prototype.VSL_PICKER = function($scope,$http,$routeParams) 
{

	$scope.pickCheck = 1;
	$scope.orderSelected = 0;
	$scope.idVSL_ORHE = 0;
	$scope.VSL_ORHE_ORNUM = "";
	A_LocalAgular["VSL_ORHECT"]($scope,$http,$routeParams);

	$scope.initPickOrder = function(idOrd,idPic)
	{
		
		$scope.pickCheck = 1;
		
		$scope.ABinitTbl("vsl_orhe","idVSL_ORHE")
		$scope.ABupdChkObj("idVSL_ORHE",idOrd,true);
		
		A_Scope.callBack = "$scope.setOrhePick("+idPic+");"
		$scope.ABchk();
		$scope.DOC_ORST = "";
		$scope.allPicksSelected = false;		
		
	}	
	
	$scope.countCheckBox = function(objAttr)
	{
		var vVal = 1
		
		$("[" + objAttr + "]").each(function()
		{
			if ($(this).prop("checked")==false)
			{
				vVal = 0
			} 
		});
		
		if (vVal == 0)
		{
			$scope.allPicksSelected = false;
		}
		else
		{
			$scope.allPicksSelected = true;
		}
		
		
		
	}


	
	$scope.setOrhePick = function(pickId)
	{
		$scope["tmpORHE"] = new Array();
		var occ = 0;
		
		while (occ < $scope["vsl_orhe"].length)
		{
			if ($scope["vsl_orhe"][occ]["VSL_ORST_PICID"] == pickId)
			{
				$scope["tmpORHE"][$scope["tmpORHE"].length] = $scope["vsl_orhe"][occ];
			}
			occ += 1;
		}
		
		dDta["tmpORHE"] = $scope["tmpORHE"];
		$scope["vsl_orhe"] = $scope["tmpORHE"];
		
		
		$scope.pickCheck = 0;
		$scope.orderSelected = pickId;
		
		
	}
	
	$scope.setFormPickOn = function(pickId)
	{

		$scope.inveRefresh();
		$scope.orderQuery();
		
		setTimeout(function()
		{
			$scope.pickCheck = 0;
			// 
			
		},100);
		
			
	}	
	
	$scope.setFormPickOff = function(pickId)
	{
		$scope.orderSelected = 0;	
	}	
	
	

	$scope.ACVarFilterInit = function(colName,colVal)
	{
		// colVal = $scope["list"+colName];
		
		var occ = 0;
		while (occ < $scope["rawResult"]["vsl_pick"].length)
		{	
			if ( !$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["hidden"] = "  ";
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
			}
			
			$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vsl_pick"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vsl_pick"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
	
}	

// Begin


A_LocalAgularFn.prototype.VSL_PACKER = function($scope,$http,$routeParams) 
{

	$scope.pickCheck = 1;
	$scope.orderSelected = 0;
	$scope.idVSL_ORHE = 0;
	$scope.VSL_ORHE_ORNUM = "";
	A_LocalAgular["VSL_ORHECT"]($scope,$http,$routeParams);

	$scope.initPackOrder = function(idOrd,idPic)
	{
		
		$scope.pickCheck = 1;
		
		$scope.ABinitTbl("vsl_orhe","idVSL_ORHE")
		$scope.ABupdChkObj("idVSL_ORHE",idOrd,true);
		
		A_Scope.callBack = "$scope.setOrhePack("+idPic+");"
		$scope.ABchk();
		$scope.DOC_ORST = "";
		$scope.allPicksSelected = false;		
		
	}	
	
	$scope.countCheckBox = function(objAttr)
	{
		var vVal = 1
		
		$("[" + objAttr + "]").each(function()
		{
			if ($(this).prop("checked")==false)
			{
				vVal = 0
			} 
		});
		
		if (vVal == 0)
		{
			$scope.allPicksSelected = false;
		}
		else
		{
			$scope.allPicksSelected = true;
		}
		
		
		
	}


	
	$scope.setOrhePack = function(pickId)
	{
		$scope["tmpORHE"] = new Array();
		var occ = 0;
		
		while (occ < $scope["vsl_orhe"].length)
		{
			if ($scope["vsl_orhe"][occ]["VSL_ORST_PAKID"] == pickId)
			{
				$scope["tmpORHE"][$scope["tmpORHE"].length] = $scope["vsl_orhe"][occ];
			}
			occ += 1;
		}
		
		dDta["tmpORHE"] = $scope["tmpORHE"];
		$scope["vsl_orhe"] = $scope["tmpORHE"];
		
		
		$scope.pickCheck = 0;
		$scope.orderSelected = pickId;
		
		
	}
	
	$scope.setFormPackOn = function(pickId)
	{

		$scope.inveRefresh();
		$scope.orderQuery();
		
		setTimeout(function()
		{
			$scope.pickCheck = 0;
		 	// $scope.orderQuery();
			
		},100);
		
			
	}	
	
	$scope.setFormPackOff = function(pickId)
	{
		$scope.orderSelected = 0;	
	}	
	
	

	$scope.ACVarFilterInit = function(colName,colVal)
	{
		// colVal = $scope["list"+colName];
		
		var occ = 0;
		while (occ < $scope["rawResult"]["vsl_pack"].length)
		{	
			if ( !$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["hidden"] = "  ";
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
			}
			
			$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vsl_pack"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vsl_pack"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
	
}	


// END






A_LocalAgularFn.prototype.VSL_ORHECT = function($scope,$http,$routeParams) 
{



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
		$("#mainForm").addClass('invisible');
		A_Scope.callBack += "$scope.resetOrheForm();";
		if (!A_Scope.cancelBack)
		{
			A_Scope.cancelBack = "";
		}
		A_Scope.cancelBack += "$scope.resetOrheForm();";
		
	}

	$scope.resetOrheForm = function()
	{	
		setTimeout(function()
		{
			$("#mainForm").removeClass('invisible');
		
		},500);
	}
	
	
	
	$scope.ABsessionUrl ="#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item";

	$scope.toggleSpecList = function(specId,specList,orde)
	{
		// alert($scope.getSpecColorSet(orde));
		
		specList = "," + specList.trim()
		
		var debug = "ID:"+specId+"\nLIST:"+specList
		
		if (specList.indexOf("," + specId + ",") == -1)
		{
			specList += specId + ",";
		}
		else
		{
			specList = specList.slice(0,specList.indexOf("," + specId + ",")) + specList.slice(specList.indexOf("," + specId + ",")+ 1 + specId.length)
		}

		// alert($scope.rawResult.vin_item_ssma)
		specList=specList.slice(1)
		
		
		if (specList.length<1)
		{
			specList = " "
		}		

		
		return specList;
	}
	
	
	
	$scope.setupSpecSheets = function()
	{
		$scope["specSheet"] = new Object();
		var wipINVE = $scope.vin_item_vin_lshe;
		var tmpDate = "";
		
		
		var count = 0;
		var occ = 0;
		var wocc = 0;
		
		while (occ < wipINVE.length)
		{
			if (wipINVE[occ].VIN_SSIT_ITMID > 0)
			{
				
				if (!$scope["specSheet"][wipINVE[occ].VIN_SSIT_ITMID])
				{
					$scope["specSheet"][wipINVE[occ].VIN_SSIT_ITMID] = new Array();
				}

				wocc = 0;
				var wipINVErows = wipINVE[occ].rowSet
				while (wocc < wipINVErows.length)
				{

					// wipINVErows[occ]["VIN_LSHE_SMDATES"] = ""
					
					if (wipINVErows[wocc].VIN_SSIT_ITMID > 0)
					{
						// wipINVErows[wocc].VIN_LSHE_DATES = $scope.ABGetDateFn('add-days',wipINVErows[wocc].VIN_LSHE_DOMDA + "," + wipINVErows[wocc].VIN_SSMA_SHLIF);
						
						// wipINVErows[occ]["VIN_LSHE_SMDATES"] = $scope.ABGetDateFn('add-days',wipINVErows[wocc].VIN_LSHE_DOMDA + "," + wipINVErows[wocc].VIN_SSMA_SHLIF);
						
						count = $scope["specSheet"][wipINVE[occ].VIN_SSIT_ITMID].length;
						$scope["specSheet"][wipINVE[occ].VIN_SSIT_ITMID][count]= wipINVErows[wocc];
						// $scope["specSheet"][wipINVE[occ].VIN_SSIT_ITMID][count]["VIN_LSHE_SMDATES"] = tmpDate;
					}
					
					wocc += 1;
				}
				
			}	

			occ += 1;

		}
		
		dDta["specSheet"] = $scope["specSheet"];
		dDta["wipINVE"] = wipINVErows;
		dDta["vin_item_vin_lshe"] = wipINVE;

	}

	$scope.inveRefresh = function()
	{
		// This function is access with ng-click in appHtml
		// Some scope code clicks this object on a timeout count
		
		$scope.inveQuery();
		$scope.idVIN_ITEM = 0; //$scope.VSL_ORDE_ITMID;
		A_Scope.callBack = "$scope.setupSpecSheets();$scope.countPending();"
		
		$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_inveQuery','vin_inveQuery','vin_inve');	
		$scope.ABlstAlias('idVSL_ORHE','idVSL_ORHE','vsl_orheLstr','vsl_orheLSTR');	 
	}
	
	$scope.inveQuery = function ()
	{
		var nL = "";
		$("[ng-model='x.VSL_ORDE_ITMID']").each(function()
		{ 
			
			if (nL.indexOf($(this).val() + ",") == -1)
			{
				// $scope.VSL_ORDE_ITMID = Math.min($(this).val(),$scope.VSL_ORDE_ITMID) 
				nL += $(this).val() + ",";
			}
		});
		$scope["vin_inveQuery"] = nL; 
		
		
	}

	$scope.countPending = function ()
	{
		try
		{
		
		setTimeout(function()
		{
			$("[ng-model='x.totalCount']").each(function()
			{ 
				
				$(this).val($(this).parent().find("[recount]").length);
				var resp = $(this).val();
				if ($(this).val() < 1)
				{
					var resp = "none"
				} 
				$(this).parent().parent().find("[ng-model='x.recCount']").val("(" + resp +")")
			});
			
			$("[lotaccumulator]").each(function()
			{
				$(this).click();
			});
			
			
		},500);
		}catch(er){alert(er)}
			
	
	}

    	$scope.updLotSel = function()
    	{
    		// alert ("HERE" + $("[ng-model$='.lotSel']").parentsUntil('table').find("[ng-model='y.selCountDsp']").val())
    		// alert($(this).parentsUntil("div").find("[ng-model='y.selCountDsp']").attr('ng-model'));
		$("[ng-model='y.lotSel']").each(function()
		{
			try{
				$(this).val($(this).parentsUntil('table').find('[lotselected]').val())
				
				var selList = $(this).val().split(',');
				var selCount = 0;
				var occ = 0;
				while (occ < selList.length-1)
				{
					selCount += Number(selList[occ].slice(selList[occ].indexOf(':')+1));
					occ += 1;
				};
			
				$(this).parentsUntil('table').find("[ng-model='y.selCountDsp']").val(selCount);
			
			}
			catch(er){alert($(this).val()+er)}
			
		}); 
		
		
    	}
    

	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		
		$scope.ABlstAlias(ce,obj,tbl,"vsl_orhe")
	}

	$scope.chkCurrMain = function()
	{

		var currMain = $("#mainForm").attr("ab-main");
		$("#mainForm").attr("ab-main","vsl_orst");
		tblInfo($scope,$http);
		$("#mainForm").attr("ab-main",currMain );
			
		
	}

	$scope.initSpace = function()
	{
		
		A_Scope.callBack = "$scope['idVSL_ORHE']=$scope.vsl_orhe[0]['idVSL_ORHE'];$scope.ckMain();"
		$scope.kPress('VSL_ORHE_ORNUM','VSL_ORHE_ORNUM','vsl_orhe',0)
	}		

	$scope.ckMain = function (ce,obj,tbl,dir)	
	{	
		var obj = new Object();
		obj["idVSL_ORHE"] = $scope.idVSL_ORHE
		$("[ab-new='1']").remove();
		A_Scope.callBack = "$scope['order_list'] = $scope['vsl_orhe'];$scope['orgVSL_ORHE_ORNUM'] = $scope.VSL_ORHE_ORNUM;"
		$scope.ABchkMain(obj,"vsl_orhe")
	}

	$scope.insertInDetail = function()
	{
		var nextLine = 0;
		var occ = 0;
		var newLine = 0;
		var newCount = 0;
		var nlFound = false;
		while (occ < $scope.vsl_orhe.length)
		{
			
			if (nextLine <  Number($scope.vsl_orhe[occ].VSL_ORDE_ORLIN))
			{
				nextLine = Number($scope.vsl_orhe[occ].VSL_ORDE_ORLIN);
			}
			if ($scope.vsl_orhe[occ].VSL_ORDE_ORLIN < 0 && nlFound == false)
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
		
		if ($scope.vsl_orhe[newLine].VSL_ORDE_ORLIN < 0)
		{
			$scope.vsl_orhe[newLine].idVSL_ORDE = $scope.vsl_orhe[newLine].VSL_ORDE_ORLIN;
			$scope.vsl_orhe[newLine].VSL_ORDE_ORLIN = nextLine
			$scope.vsl_orhe[newLine].VSL_ORDE_ORDQT = 0;
			$scope.vsl_orhe[newLine].VSL_ORST_ORDQT = 0;
			$scope.vsl_orhe[newLine].VSL_ORDE_CFCAT = $scope.VSL_ORHE_CFCAT;
			$scope.vsl_orhe[newLine].VSL_ORDE_ITMID = 0;
			$scope.vsl_orhe[newLine].VSL_ORDE_DESCR = "";
			$scope.vsl_orhe[newLine].VSL_ORDE_ITEXT = "";
			$scope.vsl_orhe[newLine].VSL_ORDE_OTEXT = "";
			$scope.vsl_orhe[newLine].VIN_ITEM_ITMID = "";
			$scope.vsl_orhe[newLine].VIN_ITEM_LOTCT = 0;
			$scope.vsl_orhe[newLine].VSL_ORST_PDATE = $scope.ABGetDateFn('get-year','')+'-'+$scope.ABGetDateFn('get-month','')+'-'+$scope.ABGetDateFn('get-day','');
			$scope.vsl_orhe[newLine].VSL_ORST_STEPS = ""; 
			$scope.vsl_orhe[newLine].VSL_ORDE_OUNET = 0;
			newCount += 1; 
		}
		$scope.accum();
		$scope.chkCurrMain();
		setTimeout("ABsetDatepickers();",50)	
		
	}
	

	$scope.insertInStep = function(ordLine,ordQty)
	{
		var nextLine = 0;
		var nextId = 0;
		var nextStep = 0;
		
		var occ = 0;
		var newLine = 0;
		var nlFound = false;
		while (occ < $scope.vsl_orhe.length)
		{
			if (ordLine == $scope.vsl_orhe[occ].VSL_ORDE_ORLIN)
			{
				nextId = Number($scope.vsl_orhe[occ].idVSL_ORDE);
				nextLine = Number($scope.vsl_orhe[occ].VSL_ORDE_ORLIN);
				nextStep = Number($scope.vsl_orhe[occ].VSL_ORST_STPSQ);
			}
				
			if ($scope.vsl_orhe[occ].VSL_ORDE_ORLIN < 0 && nlFound == false)
			{
				newLine = occ;
				nlFound = true;
				
			}
						
			occ += 1;
		}
		
		
		
		if (nextLine < 1)
		{
			return;
		}

		if (nextStep < 1)
		{
			nextStep = 10;
		}
		else
		{
			nextStep += 10;
		}
		
		
		if ($scope.vsl_orhe[newLine].VSL_ORDE_ORLIN < 0)
		{
			$scope.vsl_orhe[newLine].idVSL_ORDE = nextId;
			$scope.vsl_orhe[newLine].VSL_ORDE_ORLIN = nextLine;
			$scope.vsl_orhe[newLine].VSL_ORST_STPSQ = nextStep;
			$scope.vsl_orhe[newLine].VSL_ORST_ORDQT = ordQty;
			$scope.vsl_orhe[newLine].VSL_ORST_STEPS = "";
			
			$scope.vsl_orhe[newLine].newStepMess = "New"
			if (ordQty >0)
			{
				$scope.vsl_orhe[newLine].newStepMess = "Back-order";
			}
			
			// $scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VSL_ORDE_ORDQT','y.VSL_ORST_ORDQT');
		}
		
		$scope.accum();
		setTimeout("ABsetDatepickers();",50)	
		
	}
	
	$scope.insertIn22Step = function(attrName,attrValue,ordLine)
	{
		var debug="";
		
		var rep = "<tr ordline='0' ab-formlist='orstep_list' ng-repeat='y in vsl_orhe'  ab-new='2' ab-rowset='dirty' >";

		var occ = 0;
		$("[" + attrName + "='" + attrValue + "']").each(function()
		{
			
			if (occ == 0 && $(this).attr("ordline") == ordLine)
			{
				$(this).before(rep + $(this).html() + "</tr>");
				occ +=1
			}
			
			
		});
		
		$("[ab-rowset='dirty']").find("[ng-model]").each(function()
		{
			$(this).val("");
			$(this).attr("ab-orgval","")
			
		});
		
		$("[ab-rowset='dirty']").attr("ab-rowset","0")
		
		var occ = -1;
		$("[ab-new='2']").each(function()
		{
			$(this).attr("ab-rowset",occ);
			occ = occ - 1;
			
		});
		
		// alert(debug)
		
		// find("[ab-rowset='1']").html())
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
	
	
	$scope.initNewCustomer = function()
	{
		if ($scope.idVSL_ORHE < 1 || $scope.VSL_ORHE_BTCUS == $scope.abSessionResponse.idVGB_CUST)
		{
			$scope.VSL_ORHE_BTCUS = $scope.abSessionResponse.idVGB_CUST;
			$scope.VSL_ORHE_STCUS = $scope.abSessionResponse.idVGB_CUST;
			$scope.VSL_ORHE_OBCUS = $scope.abSessionResponse.idVGB_CUST;
			$scope.VSL_ORHE_BTADD = $scope.abSessionResponse.VGB_CUST_BTADD;
			$scope.VSL_ORHE_STADD = $scope.abSessionResponse.VGB_CUST_STADD;
			$scope.VGB_CUST_BPNAM = $scope.abSessionResponse.VGB_CUST_BPNAM;
			$scope.VSL_ORHE_BAORA = $scope.abSessionResponse.VGB_CUST_BAORA;
			$scope.VSL_ORHE_CRHOL = $scope.abSessionResponse.VGB_CUST_CRHOL;
			$scope.VSL_ORHE_TERID = $scope.abSessionResponse.VGB_CUST_TERID;
			$scope.VSL_ORHE_SLSRP = $scope.abSessionResponse.VGB_CUST_SLSRP;
			$scope.VSL_ORHE_CURID = $scope.abSessionResponse.VGB_CUST_CURID;
			$scope.VSL_ORHE_CFCAT = $scope.abSessionResponse.VGB_CUST_CFCAT;
			$scope.VGB_CUST_BPART = $scope.abSessionResponse.VGB_CUST_BPART;
			$scope.initAddress();
			$scope.initSupport();
		}

	}	
	
	$scope.getSpecColorSet = function (orde)
	{

		// finds the selected spec with the least of shelf life.
		specLink = "";

		if (orde["VSL_ORDE_LSPEC"].trim() != "" && $scope["specSheet"][orde["VSL_ORDE_ITMID"]])
		{
			var specList = "," + orde["VSL_ORDE_LSPEC"].trim() + ","
			var recSet = $scope["specSheet"][orde["VSL_ORDE_ITMID"]];
			var dayCount = 0;
			var occ = 0;
			while (occ < recSet.length)
			{
				if (specList.indexOf("," + recSet[occ]["idVIN_SSMA"] + ",") > -1)
				{
					
					if (dayCount == 0 || dayCount > Number(recSet[occ]["VIN_SSMA_SHLIF"]))
					{
						specLink = recSet[occ]["idVIN_SSMA"];
						dayCount = Number(recSet[occ]["VIN_SSMA_SHLIF"]);
					}
				}	
				
				occ += 1;
			}
			
		}
		
		
		return specLink;
		
	}
	
	$scope.setLifeColors = function(val,dta,orde)
	{
		
		
		if (!orde["VSL_ORDE_LLINK"])
		{
			var specId = orde;
		}
		else
		{
			var specId = orde["VSL_ORDE_LLINK"];
		}
		
		if (!dDta.colors)
		{
			dDta.colors = new Array();
		}
		
		dcl = dDta.colors.length
		dDta.colors[dcl] = new Object();
		
		dDta.colors[dcl]["val"] = val;
		dDta.colors[dcl]["dta"] = dta;
		dDta.colors[dcl]["specId"] = specId;
		dDta.colors[dcl]["orde"] = orde;
		dDta.colors[dcl]["item"] = orde["VSL_ORDE_DESCR"];
		
		var rColor = "green";
		
		var level_0 = 1;
		var level_1 = $scope["VSL_ORHE_LLIFE"];
		
		if (val < level_0)
		{
			rColor = "red";
		}
		else
		{
			if (val < level_1)
			{
				rColor = "yellow";
			}
		}
		
		dDta.colors[dcl]["rColor"] = rColor;
		var speColor = rColor;
		
		
		var isToSpec = true;
		
		if (specId >0)
		{
			
			isToSpec = false;
			var itmList = $scope["vin_item_ssma"];
			speColor = "red";
			
			var occ = 0;
			var wocc = 0;
			while (occ < itmList.length)
			{
				wocc =0;
				while (wocc < itmList[occ].rowSet.length && itmList[occ].idVIN_ITEM == dta.VIN_LSHE_ITMID )
				{
					if (itmList[occ]["rowSet"][wocc].VIN_SSLT_LOTID == dta.idVIN_LSHE && itmList[occ]["rowSet"][wocc].VIN_SSLT_SPESQ == specId)
					{
						speColor = rColor;
						isToSpec = true;
						dDta.colors[dcl]["orde"] = orde;
					}

					
					
					wocc += 1;
				}
				
				occ += 1;
			}
			
			
		}
		
		dDta.colors[dcl]["speColor"] = speColor;
		if (isToSpec == false && rColor.toUpperCase() != "RED")
		{
			speColor = "yellow"
		}
		
		// $scope["vin_item_ssma"]
		
		dDta.colors[dcl]["retColor"] = speColor;
		
		rColor = speColor;
		
			
		return rColor;
		
	}

	$scope.chkOrstQtyUnset = function()
	{
		$('#orstQtyModal').off('hidden.bs.modal')
	}	

	$scope.chkOrstQtySet = function()
	{
		$scope.chkOrstQtyUnset();
		$('#orstQtyModal').on('hidden.bs.modal', function () {
    			
    			$("#orstQtyModalCMD").click();
		})		
	}	
	
	$scope.backOrderInsert = function(ordeId,backOrderOptionQty)
	{
		
		if (backOrderOptionQty > 0 && $scope.orheBckOrd > 0)
		{
			$scope.insertInStep(ordeId,backOrderOptionQty)
		}
		
	}
	
	$scope.chkOrstQty = function(ordeId,orstId,orstSteps)
	{

		$scope.retractRequired = 0;
		$scope.backOrderOption = 0;
		$scope.ordeId = ordeId;
		$scope.orstId = orstId;
		$scope.orstLotCount = 0;
		$scope.orstLotMess = "";
		$scope.chkOrstQtyUnset();
		
		// alert(orstId + "--" + $("#lotStpSum"+orstId).val() + "||" + orstSteps )
		if ($("#lotStpSum"+orstId))
		{
			
			$scope.orstLotCount = $("#lotStpSum"+orstId).val()
//			$("#lotStpSum"+orstId).click();
//			alert(orstId)
		}
		
		
		
		$scope.orheBckOrd = $scope.VSL_ORHE_BAORA * 1;
		
		var qty = $("#VSL_ORST_ORDQT"+$scope.orstId).val();
		
		var orgQty = $("#VSL_ORST_ORDQT"+$scope.orstId).attr("chkqty");
		if (orgQty == "init")
		{
			orgQty = $("#VSL_ORST_ORDQT"+$scope.orstId).attr("ab-orgval");
			$("#VSL_ORST_ORDQT"+$scope.orstId).attr("chkqty",orgQty);
		}
		
		$scope.orstOrgQty = orgQty;
		$scope.orstNewQty = qty;
		
		
		
		try
		{
			
			$scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VSL_ORDE_ORDQT','y.VSL_ORST_ORDQT');
		
			if (orstSteps < "FF_PICK")
			{ 
				return qty;
			}
			
			if (orstSteps > "FF_PICK" && qty != orgQty)
			{
				$scope.retractRequired = 1;
				$('[data-target="#orstQtyModal"]').click();
				$scope.chkOrstQtyUnset();
				// $("#VSL_ORST_ORDQT"+orstId).focus();
				qty = orgQty;
				$scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VSL_ORDE_ORDQT','y.VSL_ORST_ORDQT');
				
	
	
			}
			else
			{
				if (Number(qty) < Number(orgQty))
				{
					
					
					if ($scope.orstLotCount && $scope.orstLotCount.length > 0)
					{
						$scope.orstLotMess = "You must adjust lot quantities";
					} 
					$scope.backOrderOption = 1;
					$scope.backOrderOptionQty = orgQty - qty;
					$("#VSL_ORST_ORDQT"+$scope.orstId).attr("chkqty",qty);
					$('[data-target="#orstQtyModal"]').click();
//					if ($scope.orheBckOrd > 0)
//					{
						$scope.chkOrstQtySet();
//					}
					
					$scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VSL_ORDE_ORDQT','y.VSL_ORST_ORDQT');
					
				}
				
			}
		
			$scope.setOrderDates();
		
		}catch(er){alert( "AA" + er)}
	
		return qty;
		
		// alert(qty + " --was " + orgQty + $scope.currentOrst["steps"])
	}
	
	$scope.setOrderDates = function()
	{
		
		if ($scope.VSL_ORHE_ODATE == "")
		{
			var d = new Date();
			var m = String(d.getMonth() + 1);
			if (m.length<2)
			{
				m = "0" + m;
			}
			if (d.getDate() < 10)
			{
				m += "0";
			}
			 
			$scope.VSL_ORHE_ODATE = d.getFullYear()+ m + d.getDate();
		}
		
		var DDATE = "";
		
		$("[ab-formlist='order_list']").each(function()
		{
			if ($(this).find("[ng-model='x.VSL_ORDE_ODATE']").val()=='')
			{
				$(this).find("[ng-model='x.VSL_ORDE_ODATE']").val($scope.VSL_ORHE_ODATE);
			}
			if ($(this).find("[ng-model='x.VSL_ORDE_DDATE']").val()=='')
			{
				$(this).find("[ng-model='x.VSL_ORDE_DDATE']").val($(this).find("[ng-model='x.VSL_ORDE_ODATE']").val());
			}
			
			DDATE = $(this).find("[ng-model='x.VSL_ORDE_DDATE']").val();
			
			$(this).find("[ab-formlist='orstep_list']").each(function()
			{

				if ($(this).find("[ng-model='y.VSL_ORST_PDATE']").val()=='')
				{
					$(this).find("[ng-model='y.VSL_ORST_PDATE']").val(DDATE);
				}

				
			});

		});
		
//		if(x.VSL_ORDE_ODATE == ''){x.VSL_ORDE_ODATE = x.VSL_ORHE_ODATE;};
//		if(x.VSL_ORDE_DDATE == ''){x.VSL_ORDE_DDATE = x.VSL_ORDE_ODATE;};
//		if(y.VSL_ORST_DDATE == ''){x.VSL_ORST_DDATE = x.VSL_ORDE_DDATE;};
	}

	$scope.initOrder = function()
	{
		
		$scope.ABinitTbl("vsl_orhe","idVSL_ORHE")
		$scope.ABupdChkObj("idVSL_ORHE",$scope.opts.idVSL_ORHE,true);
		
		A_Scope.callBack = "$scope.copyOrg();$scope.chkCurrMain();$scope.initAddress();$scope.setOrderDocuments();$scope.getOrderTax();$scope.orderFormRefresh();setTimeout('ABsetDatepickers();',600);"
		A_Scope.callBack += "setTimeout('" + '$("#inveRefr").click();' + "',300);";
		$scope.ABchk();
		
	}

	$scope.orderFormRefresh = function()
	{
		try
		{
		
		setTimeout(function()
		{
			$scope.abBindRefresh()
			
		},100);
		}catch(er){alert(er)}
	
	}		

	$scope.initOrderORSI = function()
	{

		$scope.ABlstAlias('idVSL_ORHE','idVSL_ORHE','vsl_orheOrsi','vsl_orheOrsi');
		
	}
	
	
	
	$scope.orderQuery = function ()
	{
		var nL = ",";
		$("[ng-model='x.VSL_ORDE_ITMID']").each(function()
		{ 
			
			if (nL.indexOf("," + $(this).val() + ",") == -1)
			{
				nL += $(this).val() + ",";
			}

		});
		
		nL = nL.slice(1);
		
		$scope["vin_item_specs"] = nL; 
		$scope["vin_item_lots"] = nL;

		$scope.idVIN_ITEM = 0
		$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_item_specs','vin_item_specs','vin_item_ssma');

		$scope.idVIN_ITEM = 0
		$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_item_lots','vin_item_lots','vin_item_vin_lshe');
	
		$scope["vin_item_lots"] = ""; 
		$scope["vin_item_specs"] = ""; 

	}


	
	$scope.getUsers = function()
	{
		$scope["CFG_USERS_CODE"] = " "; 
		$scope.ABlstAlias('CFG_USERS_CODE','CFG_USERS_CODE','cfg_users','vsl_users');
		
	}
	
	
		
	$scope.setOrderDocuments = function()
	{
 		$scope["vsl_orsi"] = new Array();
 		
 		var orsiList=""; // NO doubles "[idVSL_ORST,idVSL_ORSI]"
 		var tmpKey = "";
		
		var occ = 0;
		while (occ < $scope.vsl_orhe.length)
		{
			if ($scope.vsl_orhe[occ].idVSL_ORST > 0)
			{
				if ($scope.vsl_orhe[occ].idVSL_ORSI < 1)
				{
					$scope.vsl_orhe[occ].idVSL_ORSI = 0;
				}
				
				if (orsiList.indexOf("["+$scope.vsl_orhe[occ].idVSL_ORST+","+$scope.vsl_orhe[occ].idVSL_ORSI +"]") == -1 )
				{
					// $scope.vsl_orsi[$scope.vsl_orsi.length] = $scope.vsl_orhe[occ];
					 
					tmpKey = $scope.vsl_orhe[occ].VSL_ORST_STEPS;
					tmpKey += String(1000000 + $scope.vsl_orhe[occ].VSL_ORDE_ORLIN ) + "-" ;
					tmpKey += String(1000000 + $scope.vsl_orhe[occ].VSL_ORST_STPSQ );
					
					orsiList += tmpKey + "[" + $scope.vsl_orhe[occ].idVSL_ORST + "," + $scope.vsl_orhe[occ].idVSL_ORSI + "][" + occ + "\t";
				}
			}
			occ += 1;
		}
		
		var oTemp = orsiList.split("\t");
		oTemp.sort()
		var wocc = 0;
		var occ = 0;
		while (occ < oTemp.length)
		{
			if (oTemp[occ].indexOf("][") > -1)
			{
				wocc = oTemp[occ].slice(oTemp[occ].indexOf("][")+2);
				$scope.vsl_orsi[$scope.vsl_orsi.length] = $scope.vsl_orhe[wocc];
			}
			
			occ += 1;
		}
		
		
		dDta.alain = orsiList; //$scope["vsl_orsi"]
		
	}


	
	$scope.initAddress = function()
	{
		// alert($scope.idVGB_BPAR + "-" + $scope.VGB_BPAR_BPART + "-" + $scope.VSL_ORHE_BTCUS)
			$scope.VGB_ADDR_BPART = $scope.idVGB_BPAR; //$scope.VSL_ORHE_BTCUS;
			$scope.idVGB_ADDR='';
			$scope.ABlstAlias('VGB_ADDR_BPART','VGB_ADDR_BPART','vgb_addr',0);
			

			$scope.VIN_CUST_BPART = $scope.VSL_ORHE_BTCUS;
			$scope.idVIN_CUST='';
			$scope.ABlstAlias('VIN_CUST_BPART','VIN_CUST_BPART','vin_cust','vin_cust');
	    		
//	    		$scope.ABinitTbl('vin_cust','VIN_CUST_BPART');
//	    		$scope.ABupdChkObj('supportChk',true,true);	   
//	    	   	$scope.ABupdChkObj('VIN_CUST_BPART',$scope.VSL_ORHE_BTCUS,true);
//	    		$scope.ABchk();   
	    					
//			$scope.VIN_CUST_BPART = $scope.VSL_ORHE_BTCUS;
//			$scope.ABlstAlias('VIN_CUST_BPART','VIN_CUST_BPART','vin_cust',0);
		
//		var obj = new Object();
//		obj["VGB_ADDR_BPART"] = $scope.VSL_ORHE_BTCUS;
//		$scope.ABchk(obj,"vgb_addr")
		
		
		
		
	}


	$scope.getOrderTax = function()
	{	
		var obj = new Object();
		$scope.ABlstAlias("idVSL_ORHE","idVSL_ORHE","vsl_orheTax","vsl_orheTax");

		
	}
	
	$scope.initSupport = function()
	{
		var obj = new Object();
		obj["idVGB_CURR"] = $scope.VSL_ORHE_CURID;
		$scope.ABchk(obj,"vgb_curr")

		var obj = new Object();
		obj["idVGB_TERM"] = $scope.VSL_ORHE_TERID;
		$scope.ABchk(obj,"vgb_term")

		var obj = new Object();
		obj["idVGB_SLRP"] = $scope.VSL_ORHE_SLSRP;
		$scope.ABchk(obj,"vgb_slrp")

	}	

	$scope.AAVSL_ORHECT_BEGIN = function(){}
	
	if (!$scope.opts.updType)
	{
		$scope.VSL_ORHE_ORNUM = "";
		$scope.initSpace()
	}
	else
	{
	
		$scope.initOrder();
						
	
	}
	$scope["idVSL_ORHE"] = 0;
	
	// $scope.ABlstAlias('idVSL_ORHE','idVSL_ORHE',"vsl_userVariance","vsl_varie")
		
	$scope.selectCurrentForm = function(val,grpId,docId)
	{
		
		if (!val)
		{
			$scope.formSel = "Current document(s)";
			$scope.formSelName = '';
			$scope.formSelField = '';
			$scope.formSelDocId = 0;
			$scope.formSelGrpId = 0;
			
		}
		else
		{
			
			$scope.formSel = val.labeltext + " #-" + grpId;
			$scope.formSelName = val.name;
			$scope.formSelField = val.field;
			$scope.formSelDocId = docId;
			$scope.formSelGrpId = grpId;
			// $scope.tmpexe = "example_" + $scope.formSelName.slice($scope.formSelName.indexOf("_") + 1) + ".php" ;
			$scope.tmpexe = $scope["AB_CPARM"]["VSL_STEPS"][$scope.formSelName] + ".php";
			$scope.selexe= $scope.tmpexe
			$("#doccset").click();
			
		}
		
		// $scope.DOC_STEPS = $scope.formSelName
	}

	$scope.docStepValid = function(rSet)
	{
		
		if($scope.formSelName && $scope.formSelName !="")
		{ 
			if (!rSet[$scope.formSelField] ||$scope.formSelDocId != rSet[$scope.formSelField])
			{
				// alert($scope.formSel + "\n" + rSet[$scope.formSelField] + " - " + $scope.formSelField);
				return false;
			}
		}
		
		return true;
	}
	
	$scope.initAllocDashBoard = function(val,txt)
	{
		if (!val)
		{
			$scope.stpSel = "Select New Document";
			$scope.stpSelName = '';
		}
		else
		{
			
			$scope.stpSel = txt ;
			$scope.stpSelName = val;
		}
		$scope.DOC_STEPS = $scope.stpSelName
	}
	
	$scope.toggleAllocStepSel = function(stepId)
	{
		if (!$scope.DOC_ORST)
		{
			$scope.DOC_ORST = "";
		}
		var tmp = "," + $scope.DOC_ORST + ",";
		var fstr = "," + stepId + ",";
		
	try
	{
		
		if (tmp.indexOf(fstr) > -1)
		{
			tmp = tmp.slice(0,tmp.indexOf(fstr)) + tmp.slice( tmp.indexOf(fstr) + fstr.length - 1);
		}
		else
		{
			tmp = tmp + fstr;
		}
		
		while (tmp.indexOf(",,") > -1)
		{
			tmp = tmp.slice(0,tmp.indexOf(",,")) + tmp.slice(tmp.indexOf(",,")+1);
		}
		if (tmp.indexOf(",") == 0)
		{
			tmp = tmp.slice(1);
		}
		if (tmp.lastIndexOf(",") == tmp.length-1)
		{
			tmp = tmp.slice(0,tmp.length-1);
		}
		$scope.DOC_ORST = tmp;

	}
	catch(er)
	{
		alert(tmp + "\n" + er)
	}		
		
	}
	
	$scope.copyOrg = function()
	{
		setTimeout("A_Scope.initModels();",100)
		$scope.accum();
		
	}
	$scope.accum = function()
	{
		$scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VSL_ORDE_ORDQT','y.VSL_ORST_ORDQT');
	}
	
	
	$scope.newRecord = new Array();

	
	
	
}

A_LocalAgularFn.prototype.VSL_ORDERS = function($scope,$http,$routeParams)
{
	
	

	// I included this below to comply with your current HTML. But you must modify VIN_ITEMS to directly call ABlstAlias in $inTrig kPress statements
	// You must rewrite the function to specify "vin_item"  in reference to ng-repeat="x in vin_item"
	// Will give same resuls and will comply to naming convention.
	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		
		$scope.ABlstAlias(ce,obj,tbl,"vsl_orhe")
	}
	
	$scope.VSL_ORHE_ORNUM = ""
	$scope.kPress('VSL_ORHE_ORNUM','VSL_ORHE_ORNUM','vsl_orhe',0)
	
	
	
}
	





</script>



