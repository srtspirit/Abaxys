<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vin_uset"] = "dbMain";
	 
	
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}
A_LocalAgularFn.prototype.VIN_USETS = function($scope,$http,$routeParams) 
{

	// I included this below to comply with your current HTML. But you must modify VIN_ITEMS to directly call ABlstAlias in $inTrig kPress statements
	// You must rewrite the function to specify "vin_item"  in reference to ng-repeat="x in vin_item"
	// Will give same resuls and will comply to naming convention.
	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		
		$scope.ABlstAlias(ce,obj,tbl,"vin_uset")
	}


	$scope.initSpace = function()
	{
		
		A_Scope.callBack = "$scope['idVIN_USET']=$scope.vin_uset[0]['idVIN_USET'];$scope.ckMain();"
		$scope.kPress('VIN_USET_UNSET','VIN_USET_UNSET','vin_uset',0)
	}		

	$scope.ckMain = function (ce,obj,tbl,dir)	
	{	
		var obj = new Object();
		obj["idVIN_USET"] = $scope.idVIN_USET
		$("[ab-new='1']").remove();
		A_Scope.callBack = "$scope['uset_list'] = $scope['vin_uset'];$scope['orgVIN_USET_UNSET'] = $scope.VIN_USET_UNSET;"
		$scope.ABchkMain(obj,"vin_uset")
	}

	$scope.insertIn = function()
	{
		var debug="";
		
		var rep = "<tr ng-repeat='x in uset_list'  ab-new='1' ab-rowset='' >";

		$("[ab-formlist='uset_list']").each(function()
		{
			if ($(this).attr("ab-rowset") == 0)
			{
				$(this).before(rep + $(this).html() + "</tr>");
			}
		});
		
		var occ = -1;
		$("[ab-new='1']").each(function()
		{
			$(this).attr("ab-rowset",occ);
			occ = occ - 1;
			
		});
		
		// alert(debug)
		
		// find("[ab-rowset='1']").html())
	}
	
	$scope.delSet = function()
	{
		$("[ng-model='x.trash']").val("1")
		$("[ng-model='x.trash']").attr("checked",true);
		$("[ng-model='x.trash']").parent("td").addClass("text-danger");
		$("[ng-model='x.trash']").parents("tr").find("[ng-model]").addClass("text-danger");
		// A_Scope.callBack = "$scope.VIN_USET_UNSET = '';$scope.initSpace();";
		$scope.ABupd('DELETE');
		
	}
	
	
	
	if (!$scope.opts.updType)
	{
		$scope.VIN_USET_UNSET = "";
		$scope.initSpace()
	}
	else
	{
	
		$scope["idVIN_USET"] = $scope.opts.idVIN_USET;
		$scope.ABinitTbl("vin_uset","idVIN_USET")
		$scope.ABchk();
	
	}

}

A_LocalAgularFn.prototype.VIN_UNITCT = function($scope,$http,$routeParams)
{
	
	
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype = $scope.opts.updType;
	if (!$scope.opts.idVIN_USET)
	{
		A_LocalAgular.setOpts($scope,"idVIN_USET");

	}
	if (!$scope.opts.idVIN_UNIT)
	{
		A_LocalAgular.setOpts($scope,"idVIN_UNIT");

	}
	
	
	// I included this below to comply with your current HTML. But you must modify VIN_ITEMCT to directly call ABlst  in $inTrig kPress statements
	// Will give same resuls and will comply to naming convention.
	$scope.kPress = function(ce,obj,tbl,dir)
	{
		$scope.ABlst(ce,obj,tbl,dir)
	}
	
	// This routine refreshes form with all data	Below this function it is executed as a callBack
	$scope.vin_itemSupportTbl = function()
	{
	}

	// Please review your VIN_ITEMS in appSscript. I have taken the liberty of creating a new Select Query for vin_item.
	// replacing dbMaster dbSetTrig() method with this one.
	// It is not necesary for this session but I wanted to show you an example.
	// The complete join if this query is available in $scope
	// ie $scope.VIN_ITYPE_DESCR or {{VIN_ITYPE_DESCR}}

	$scope.ABinitTbl('vin_unit','idVIN_UNIT');
	$scope.ABupdChkObj('idVIN_UNIT', $scope.opts.idVIN_UNIT,true);
	
	
	$scope.ABchkMain();
	
	
	
}
	

</script>
