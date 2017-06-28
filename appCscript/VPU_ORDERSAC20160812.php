<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	A_Scope.setProcess($scope);
	$scope.ABunloadExe["vpu_orhe"] = "dbMain";

	$scope.initStepList = function()
	{

		$scope["VPU_STEP_LIST"] = new Array();
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();						                                             
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "DD_ACKN";                                             
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = ""; // $scope.getValOfForm("DD_ACKN");                                             
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_ACKID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_DD_ACKN";                         
	 	$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Quote"; 
	        
	                                                   
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();                                           
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "DE_AOKN";                                   
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = ""; // $scope.getValOfForm("DE_AOKN");                                   
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_AOKID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_DE_AOKN";                         
	        $scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Accept-Quote"; 
	                                                                                                                                
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();                                           
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "EE_SCED";                                   
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = ""; // $scope.getValOfForm("EE_SCED");                                   
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_SCEID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_EE_SCED";  
	        $scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Scedule";  	                                           
	                                                                   
	                                                                                                                                                                     
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "FF_PICK";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "VPU_PICK_OF"; //$scope.getValOfForm("FF_PICK");
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_PICID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_FF_PICK";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Purchase-Order";  
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "GG_RELE";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = ""; // $scope.getValOfForm("GG_RELE");
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_RELID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_GG_RELE";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Receive Goods";     
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "HH_PACK";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "VPU_PACK_OF"; //$scope.getValOfForm("HH_PACK");
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_PAKID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_HH_PACK";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Receipt List";           
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "II_DELI";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = ""; // $scope.getValOfForm("II_DELI");
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_DELID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_II_DELI";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Quality control";        
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "JJ_INVO";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = ""; // $scope.getValOfForm("JJ_INVO");
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_JJ_INVO";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Confirm Received Goods";     
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "KK_PURG";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = ""; // $scope.getValOfForm("KK_PURG");
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_KK_PURG";
	        $scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Inv. Match";            
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "QQ_PURG";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_QQ_PURG";
	        $scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Completed";         

	}
	
	$scope.initStepList();
	
	$scope.getValOfForm = function(step)
	{
		var ret="";
		
		if ($scope["AB_CPARM"]["VPU_STEPS"][step])
		{
			ret = $scope["AB_CPARM"]["VPU_STEPS"][step];
		}
		
		return ret;
	}
	

	$scope.ACVarFilterInit = function(colName,colVal)
	{
		// colVal = $scope["list"+colName];
		
		var occ = 0;
		while (occ < $scope["rawResult"]["vpu_varie"].length)
		{	
			if ( !$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["hidden"] = "  ";
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
			}
			
			$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vpu_varie"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vpu_varie"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}


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
A_LocalAgularFn.prototype.VPU_ORHECT = function($scope,$http,$routeParams) 
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
		$scope.accum();
		$("#mainForm").addClass('invisible');
		A_Scope.callBack += "$('#mainForm').removeClass('invisible');";
		if (!A_Scope.cancelBack)
		{
			A_Scope.cancelBack = "";
		}
		A_Scope.cancelBack += "$('#mainForm').removeClass('invisible');";		

	}
	
	
	
	$scope.ABsessionUrl ="#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item";

	$scope.toggleSpecList = function(specId,specList)
	{
		specList = "," + specList.trim()
		if (specList.indexOf("," + specId + ",") == -1)
		{
			specList += specId + ",";
		}
		else
		{
			specList = specList.slice(0,specList.indexOf("," + specId + ",")) + specList.slice(specList.indexOf("," + specId + ",")+ 1 + specId.length)
		}

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
		$scope.idVIN_ITEM = 0; //$scope.VPU_ORDE_ITMID;
		A_Scope.callBack = "$scope.setupSpecSheets();$scope.countPending();"
		
		$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_inveQuery','vin_inveQuery','vin_inve');	
		$scope.ABlstAlias('idVPU_ORHE','idVPU_ORHE','vpu_orheLstr','vpu_orheLSTR');	 
	}
	
	$scope.inveQuery = function ()
	{
		var nL = "";
		$("[ng-model='x.VPU_ORDE_ITMID']").each(function()
		{ 
			
			if (nL.indexOf($(this).val() + ",") == -1)
			{
				// $scope.VPU_ORDE_ITMID = Math.min($(this).val(),$scope.VPU_ORDE_ITMID) 
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
		
		$scope.ABlstAlias(ce,obj,tbl,"vpu_orhe")
	}

	$scope.chkCurrMain = function()
	{

		var currMain = $("#mainForm").attr("ab-main");
		$("#mainForm").attr("ab-main","vpu_orst");
		tblInfo($scope,$http);
		$("#mainForm").attr("ab-main",currMain );
			
		
	}

	$scope.initSpace = function()
	{
		
		A_Scope.callBack = "$scope['idVPU_ORHE']=$scope.vpu_orhe[0]['idVPU_ORHE'];$scope.ckMain();"
		$scope.kPress('VPU_ORHE_ORNUM','VPU_ORHE_ORNUM','vpu_orhe',0)
	}		

	$scope.ckMain = function (ce,obj,tbl,dir)	
	{	
		var obj = new Object();
		obj["idVPU_ORHE"] = $scope.idVPU_ORHE
		$("[ab-new='1']").remove();
		A_Scope.callBack = "$scope['order_list'] = $scope['vpu_orhe'];$scope['orgVPU_ORHE_ORNUM'] = $scope.VPU_ORHE_ORNUM;"
		$scope.ABchkMain(obj,"vpu_orhe")
	}

	$scope.insertInDetail = function()
	{
		var nextLine = 0;
		var occ = 0;
		var newLine = 0;
		var newCount = 0;
		var nlFound = false;
		while (occ < $scope.vpu_orhe.length)
		{
			
			if (nextLine <  Number($scope.vpu_orhe[occ].VPU_ORDE_ORLIN))
			{
				nextLine = Number($scope.vpu_orhe[occ].VPU_ORDE_ORLIN);
			}
			if ($scope.vpu_orhe[occ].VPU_ORDE_ORLIN < 0 && nlFound == false)
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
		
		if ($scope.vpu_orhe[newLine].VPU_ORDE_ORLIN < 0)
		{
			$scope.vpu_orhe[newLine].idVPU_ORDE = $scope.vpu_orhe[newLine].VPU_ORDE_ORLIN;
			$scope.vpu_orhe[newLine].VPU_ORDE_ORLIN = nextLine
			$scope.vpu_orhe[newLine].VPU_ORDE_ORDQT = 0;
			$scope.vpu_orhe[newLine].VPU_ORST_ORDQT = 0;
			$scope.vpu_orhe[newLine].VPU_ORDE_CFCAT = $scope.VPU_ORHE_CFCAT;
			$scope.vpu_orhe[newLine].VPU_ORDE_ITMID = 0;
			$scope.vpu_orhe[newLine].VPU_ORDE_DESCR = "";
			$scope.vpu_orhe[newLine].VPU_ORDE_ITEXT = "";
			$scope.vpu_orhe[newLine].VPU_ORDE_OTEXT = "";
			$scope.vpu_orhe[newLine].VIN_ITEM_ITMID = "";
			$scope.vpu_orhe[newLine].VIN_ITEM_LOTCT = 0;
			$scope.vpu_orhe[newLine].VPU_ORST_PDATE = $scope.ABGetDateFn('get-year','')+'-'+$scope.ABGetDateFn('get-month','')+'-'+$scope.ABGetDateFn('get-day','');
			$scope.vpu_orhe[newLine].VPU_ORST_STEPS = ""; 
			$scope.vpu_orhe[newLine].VPU_ORDE_OUNET = 0;
			
			
			newCount += 1; 
		}
		$scope.accum();
		$scope.chkCurrMain();
		setTimeout("ABsetDatepickers();",50)	
		
	}
	

	$scope.insertInStep = function(ordLine)
	{
		
		var nextLine = 0;
		var nextId = 0;
		var nextStep = 0;
		
		var occ = 0;
		var newLine = 0;
		var nlFound = false;
		while (occ < $scope.vpu_orhe.length)
		{
			if (ordLine == $scope.vpu_orhe[occ].VPU_ORDE_ORLIN)
			{
				nextId = Number($scope.vpu_orhe[occ].idVPU_ORDE);
				nextLine = Number($scope.vpu_orhe[occ].VPU_ORDE_ORLIN);
				nextStep = Number($scope.vpu_orhe[occ].VPU_ORST_STPSQ);
			}
				
			if ($scope.vpu_orhe[occ].VPU_ORDE_ORLIN < 0 && nlFound == false)
			{
				newLine = occ;
				nlFound = true;
				
			}
						
			occ += 1;
		}
		
		
		if (nextLine < 1)
		{
			exit;
		}

		if (nextStep < 1)
		{
			nextStep = 10;
		}
		else
		{
			nextStep += 10;
		}
		
		
		if ($scope.vpu_orhe[newLine].VPU_ORDE_ORLIN < 0)
		{
			$scope.vpu_orhe[newLine].idVPU_ORDE = nextId;
			$scope.vpu_orhe[newLine].VPU_ORDE_ORLIN = nextLine;
			$scope.vpu_orhe[newLine].VPU_ORST_STPSQ = nextStep;
			$scope.vpu_orhe[newLine].VPU_ORST_ORDQT = 0;
			// $scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VPU_ORDE_ORDQT','y.VPU_ORST_ORDQT');
		}
		
		$scope.accum();
		setTimeout("ABsetDatepickers();",50)	
		
	}
	
	$scope.insertIn22Step = function(attrName,attrValue,ordLine)
	{
		var debug="";
		
		var rep = "<tr ordline='0' ab-formlist='orstep_list' ng-repeat='y in vpu_orhe'  ab-new='2' ab-rowset='dirty' >";

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
	
	
	$scope.initNewSupplier = function()
	{
		if ($scope.idVPU_ORHE < 1 || $scope.VPU_ORHE_BTCUS == $scope.abSessionResponse.idVGB_SUPP)
		{
			$scope.VPU_ORHE_BTCUS = $scope.abSessionResponse.idVGB_SUPP;
			$scope.VPU_ORHE_STCUS = $scope.abSessionResponse.idVGB_SUPP;
			$scope.VPU_ORHE_OBCUS = $scope.abSessionResponse.idVGB_SUPP;
			$scope.VPU_ORHE_BTADD = $scope.abSessionResponse.VGB_SUPP_BTADD;
			$scope.VPU_ORHE_STADD = $scope.abSessionResponse.VGB_SUPP_STADD;
			$scope.VGB_SUPP_BPNAM = $scope.abSessionResponse.VGB_SUPP_BPNAM;
			$scope.VPU_ORHE_BAORA = $scope.abSessionResponse.VGB_SUPP_BAORA;
			$scope.VPU_ORHE_CRHOL = $scope.abSessionResponse.VGB_SUPP_CRHOL;
			$scope.VPU_ORHE_TERID = $scope.abSessionResponse.VGB_SUPP_TERID;
			$scope.VPU_ORHE_SLSRP = $scope.abSessionResponse.VGB_SUPP_SLSRP;
			$scope.VPU_ORHE_CURID = $scope.abSessionResponse.VGB_SUPP_CURID;
			$scope.VPU_ORHE_CFCAT = $scope.abSessionResponse.VGB_SUPP_CFCAT;
			$scope.VGB_SUPP_BPART = $scope.abSessionResponse.VGB_SUPP_BPART;
			$scope.initAddress();
			$scope.initSupport();
		}

	}	
	

	$scope.getSpecColorSet = function (orde)
	{

		// finds the selected spec with the least of shelf life.
		specLink = "";

		if (orde["VPU_ORDE_LSPEC"].trim() != "" && $scope["specSheet"][orde["VPU_ORDE_ITMID"]])
		{
			var specList = "," + orde["VPU_ORDE_LSPEC"].trim() + ","
			var recSet = $scope["specSheet"][orde["VPU_ORDE_ITMID"]];
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
		
		if (!orde["VPU_ORDE_LLINK"])
		{
			var specId = orde;
		}
		else
		{
			var specId = orde["VPU_ORDE_LLINK"];
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
		dDta.colors[dcl]["item"] = orde["VPU_ORDE_DESCR"];
		
		var rColor = "green";
		
		var level_0 = 1;
		var level_1 = $scope["VPU_ORHE_LLIFE"];
		
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
	
	$scope.setOrderDates = function()
	{
		if ($scope.VPU_ORHE_ODATE == "")
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
			 
			$scope.VPU_ORHE_ODATE = d.getFullYear()+ m + d.getDate();
		}
		
		var DDATE = "";
		
		$("[ab-formlist='order_list']").each(function()
		{
			if ($(this).find("[ng-model='x.VPU_ORDE_ODATE']").val()=='')
			{
				$(this).find("[ng-model='x.VPU_ORDE_ODATE']").val($scope.VPU_ORHE_ODATE);
			}
			if ($(this).find("[ng-model='x.VPU_ORDE_DDATE']").val()=='')
			{
				$(this).find("[ng-model='x.VPU_ORDE_DDATE']").val($(this).find("[ng-model='x.VPU_ORDE_ODATE']").val());
			}
			
			DDATE = $(this).find("[ng-model='x.VPU_ORDE_DDATE']").val();
			
			$(this).find("[ab-formlist='orstep_list']").each(function()
			{

				if ($(this).find("[ng-model='y.VPU_ORST_PDATE']").val()=='')
				{
					$(this).find("[ng-model='y.VPU_ORST_PDATE']").val(DDATE);
				}

				
			});

		});
		
//		if(x.VPU_ORDE_ODATE == ''){x.VPU_ORDE_ODATE = x.VPU_ORHE_ODATE;};
//		if(x.VPU_ORDE_DDATE == ''){x.VPU_ORDE_DDATE = x.VPU_ORDE_ODATE;};
//		if(y.VPU_ORST_DDATE == ''){x.VPU_ORST_DDATE = x.VPU_ORDE_DDATE;};
	}

	$scope.initOrder = function()
	{
		
		$scope.ABinitTbl("vpu_orhe","idVPU_ORHE")
		$scope.ABupdChkObj("idVPU_ORHE",$scope.opts.idVPU_ORHE,true);
		
		A_Scope.callBack = "$scope.copyOrg();$scope.chkCurrMain();$scope.initAddress();$scope.setOrderDocuments();$scope.getOrderTax();$scope.orderFormRefresh();setTimeout('ABsetDatepickers();',600);"
		A_Scope.callBack += "setTimeout('" + '$("#inveRefr").click();' + "',300);$scope.initStepList();";
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

		$scope.ABlstAlias('idVPU_ORHE','idVPU_ORHE','vpu_orheOrsi','vpu_orheOrsi');
		
	}
	
	
	
	$scope.orderQuery = function ()
	{
			var nL = ",";
			$("[ng-model='x.VPU_ORDE_ITMID']").each(function()
			{ 
				
				if (nL.indexOf("," + $(this).val() + ",") == -1)
				{
					nL += $(this).val() + ",";
				}
	
			});
			
			nL = nL.slice(1);
			
			$scope.idVIN_ITEM = 0
			$scope["vin_item_specs"] = nL; 
			$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_item_specs','vin_item_specs','vin_item_ssma');
			$scope["vin_item_specs"] = ""; 
		
		
	}
	
	$scope.getUsers = function()
	{
		$scope["CFG_USERS_CODE"] = " "; 
		$scope.ABlstAlias('CFG_USERS_CODE','CFG_USERS_CODE','cfg_users','vpu_users');
		
	}
	
	
		
	$scope.setOrderDocuments = function()
	{
 		$scope["vpu_orsi"] = new Array();
 		
 		var orsiList=""; // NO doubles "[idVPU_ORST,idVPU_ORSI]"
 		var tmpKey = "";
		
		var occ = 0;
		while (occ < $scope.vpu_orhe.length)
		{
			if ($scope.vpu_orhe[occ].idVPU_ORST > 0)
			{
				if ($scope.vpu_orhe[occ].idVPU_ORSI < 1)
				{
					$scope.vpu_orhe[occ].idVPU_ORSI = 0;
				}
				
				if (orsiList.indexOf("["+$scope.vpu_orhe[occ].idVPU_ORST+","+$scope.vpu_orhe[occ].idVPU_ORSI +"]") == -1 )
				{
					// $scope.vpu_orsi[$scope.vpu_orsi.length] = $scope.vpu_orhe[occ];
					 
					tmpKey = $scope.vpu_orhe[occ].VPU_ORST_STEPS;
					tmpKey += String(1000000 + $scope.vpu_orhe[occ].VPU_ORDE_ORLIN ) + "-" ;
					tmpKey += String(1000000 + $scope.vpu_orhe[occ].VPU_ORST_STPSQ );
					
					orsiList += tmpKey + "[" + $scope.vpu_orhe[occ].idVPU_ORST + "," + $scope.vpu_orhe[occ].idVPU_ORSI + "][" + occ + "\t";
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
				$scope.vpu_orsi[$scope.vpu_orsi.length] = $scope.vpu_orhe[wocc];
			}
			
			occ += 1;
		}
		
		
		dDta.alain = orsiList; //$scope["vpu_orsi"]
		
	}


	
	$scope.initAddress = function()
	{
		
//			A_Scope.setAlertUser("["+$scope.VPU_ORHE_BTCUS+"]","niala")
			$scope.VGB_ADDR_BPART = $scope.idVGB_BPAR; //$scope.VPU_ORHE_BTCUS;
			// alert($scope.VGB_ADDR_BPART)
			$scope.idVGB_ADDR='';
			$scope.ABlstAlias('VGB_ADDR_BPART','VGB_ADDR_BPART','vgb_addr',0);
			
			$scope.VIN_CUST_SUPPL = $scope.VPU_ORHE_BTCUS;
			$scope.idVIN_CUST='';
			$scope.ABlstAlias('VIN_CUST_SUPPL','VIN_CUST_SUPPL','vin_cust','vin_cust');
			
			
			$scope.VIN_SUPP_BPART = $scope.VPU_ORHE_BTCUS;
			$scope.idVIN_SUPP='';
			$scope.ABlstAlias('VIN_SUPP_BPART','VIN_SUPP_BPART','vin_supp','vin_supp');
		
//		var obj = new Object();
//		obj["VGB_ADDR_BPART"] = $scope.VPU_ORHE_BTCUS;
//		$scope.ABchk(obj,"vgb_addr")
		
		
		
		
	}


	$scope.getOrderTax = function()
	{	
		var obj = new Object();
		$scope.ABlstAlias("idVPU_ORHE","idVPU_ORHE","vpu_orheTax","vpu_orheTax");

		
	}
	
	$scope.initSupport = function()
	{
		var obj = new Object();
		obj["idVGB_CURR"] = $scope.VPU_ORHE_CURID;
		$scope.ABchk(obj,"vgb_curr")

		var obj = new Object();
		obj["idVGB_TERM"] = $scope.VPU_ORHE_TERID;
		$scope.ABchk(obj,"vgb_term")

		var obj = new Object();
		obj["idVGB_SLRP"] = $scope.VPU_ORHE_SLSRP;
		$scope.ABchk(obj,"vgb_slrp")

	}	

	$scope.AAVPU_ORHECT_BEGIN = function(){}
	
	if (!$scope.opts.updType)
	{
		$scope.VPU_ORHE_ORNUM = "";
		$scope.initSpace()
	}
	else
	{
	
		$scope.initOrder();
						
	
	}
	$scope["idVPU_ORHE"] = 0;
	
	$scope.ABlstAlias('idVPU_ORHE','idVPU_ORHE',"vpu_userVariance","vpu_varie")
		
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
			$scope.tmpexe = "example_" + $scope.formSelName.slice($scope.formSelName.indexOf("_") + 1) + ".php" ;
			// $scope.tmpexe = $scope["AB_CPARM"]["VPU_STEPS"][$scope.formSelName.slice($scope.formSelName.indexOf("_") + 1)] + ".php";
			$scope.tmpexe = $scope["AB_CPARM"]["VPU_STEPS"][$scope.formSelName] + ".php";
			$scope.selexe= $scope.tmpexe
			
			$("#doccset").click();
			
			
			
		}
		
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
			$scope.stpSel = "Select Step";
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
		$scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VPU_ORDE_ORDQT','y.VPU_ORST_ORDQT');
		
	}
	
	
	$scope.newRecord = new Array();

	
	
	
}

A_LocalAgularFn.prototype.VPU_RECEIPT = function($scope,$http,$routeParams) 
{

	$scope.pickCheck = 1;
	$scope.orderSelected = 0;
	$scope.idVPU_ORHE = 0;
	$scope.VPU_ORHE_ORNUM = "";
	A_LocalAgular["VPU_ORHECT"]($scope,$http,$routeParams);


	$scope.initPackOrder = function(idOrd,idPic)
	{
		
		$scope.pickCheck = 1;
		
		$scope.ABinitTbl("vpu_orhe","idVPU_ORHE")
		$scope.ABupdChkObj("idVPU_ORHE",idOrd,true);
		
		A_Scope.callBack = "$scope.setOrhePack("+idPic+");"
		$scope.ABchk();
		
		
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
		
		while (occ < $scope["vpu_orhe"].length)
		{
			if ($scope["vpu_orhe"][occ]["VPU_ORST_PAKID"] == pickId)
			{
				$scope["tmpORHE"][$scope["tmpORHE"].length] = $scope["vpu_orhe"][occ];
			}
			occ += 1;
		}
		
		dDta["tmpORHE"] = $scope["tmpORHE"];
		$scope["vpu_orhe"] = $scope["tmpORHE"];
		
		
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
		while (occ < $scope["rawResult"]["vpu_pack"].length)
		{	
			if ( !$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["hidden"] = "  ";
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
			}
			
			$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vpu_pack"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vpu_pack"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
	
}	




A_LocalAgularFn.prototype.VPU_ORDERS = function($scope,$http,$routeParams)
{
	
	

	// I included this below to comply with your current HTML. But you must modify VIN_ITEMS to directly call ABlstAlias in $inTrig kPress statements
	// You must rewrite the function to specify "vin_item"  in reference to ng-repeat="x in vin_item"
	// Will give same resuls and will comply to naming convention.
	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		
		$scope.ABlstAlias(ce,obj,tbl,"vpu_orhe")
	}
	
	$scope.VPU_ORHE_ORNUM = ""
	$scope.kPress('VPU_ORHE_ORNUM','VPU_ORHE_ORNUM','vpu_orhe',0)
	
	
	
}
	





</script>
