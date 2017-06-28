<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vsl_orhe"] = "dbMain";
	 
	
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}
A_LocalAgularFn.prototype.VSL_ORHECT = function($scope,$http,$routeParams) 
{

	// alert(showProps($scope.opts,"op"))

	// I included this below to comply with your current HTML. But you must modify VIN_ITEMS to directly call ABlstAlias in $inTrig kPress statements
	// You must rewrite the function to specify "vin_item"  in reference to ng-repeat="x in vin_item"
	// Will give same resuls and will comply to naming convention.
	
	
	$scope.ABsessionUrl ="#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item";
    
   	$scope.ABsessionResponsed = function ()	
	{
		
		var rep = $("#ab-sessionResponse").val();
		var wrep = "";
		$scope.abSessionResponse = new Object();
		
		while ( rep.indexOf("\t")>-1 && rep.indexOf(":") > -1 && rep.indexOf("\t") > rep.indexOf(":") )
		{
			wrep = rep.slice(0,rep.indexOf("\t"))
			rep = rep.slice(rep.indexOf("\t")+1)
			
			$scope["abSessionResponse"][wrep.slice(0,wrep.indexOf(":"))] =  wrep.slice(wrep.indexOf(":")+1)
		}
			
		
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
		var debug="";
		
		var tObj = $scope.vsl_orhe;
		$("#focusGrid").val($scope.vsl_orhe.length + " =\n" + showProps(tObj[tObj.length-1],"*"))
		
		var nObj = tObj[tObj.length-1]
		nObj['VSL_ORDE_ORLIN'] = "100"
		nObj['idVSL_ORDE'] = "0";
		nObj['VSL_ORST_ORLIN'] = "0";
		delete nObj['$$hashKey']
		
		$scope.vsl_orhe.push(nObj)
		
		
		// $("#focusGrid").val($("#focusGrid").val() + " \n------------------\n" + showProps(tObj[tObj.length-1],"*"))
		
		// $scope.vsl_orhe = "";
		$scope.$apply();
		
		
		// $scope.vsl_orhe = tObj;
		
		
		
//		var rep = "<tr ng-repeat='x in order_list'  ab-new='1' ab-rowset='' >";
//
//		$("[ab-formlist='order_list']").each(function()
//		{
//			if ($(this).attr("ab-rowset") == 0)
//			{
//				$(this).before(rep + $(this).html() + "</tr>");
//			}
//		});
		
		var occ = -1;
		$("[ab-new='1']").each(function()
		{
			$(this).attr("ab-rowset",occ);
			occ = occ - 1;
			
		});
		
		// alert(debug)
		
		// find("[ab-rowset='1']").html())
	}
	
	$scope.insertInStep = function(attrName,attrValue,ordLine)
	{
		var debug="";
		
		var rep = "<tr ordline='0' ab-formlist='orstep_list' ng-repeat='y in vsl_orhe'  ab-new='2' ab-rowset='dirty' >";

		var occ = 0;
//		alert(ordLine + "\n" + $("[" + attrName + "='" + attrValue + "']").html())
		$("[" + attrName + "='" + attrValue + "']").each(function()
		{
			
			// if ($(this).attr("ab-rowset") == "0" )
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
	
	
	$scope.initOrder = function()
	{
		
		$scope.ABinitTbl("vsl_orhe","idVSL_ORHE")
		$scope.ABupdChkObj("idVSL_ORHE",$scope.opts.idVSL_ORHE,true);
		A_Scope.callBack = "$scope.copyOrg();$scope.chkCurrMain();"
		$scope.ABchk();
		
	}
	
	if (!$scope.opts.updType)
	{
		$scope.VSL_ORHE_ORNUM = "";
		$scope.initSpace()
	}
	else
	{
	
		$scope.initOrder();		
	
	}
	
	$scope.copyOrg = function()
	{
		setTimeout("A_Scope.initModels();",100)
	}
	
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
