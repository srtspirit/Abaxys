<script>
var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vin_ssma"] = "dbMain";
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}

A_LocalAgularFn.prototype.VIN_SSMACT = function($scope,$http,$routeParams) 
{
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype = $scope.opts.updType;
	
	if (!$scope.opts.idVIN_SSMA)
	{
		A_LocalAgular.setOpts($scope,"idVIN_SSMA");
	}

	$scope.getItemLots = function ()	
	{
		$scope.idVIN_ITEM = $scope.opts.idVIN_ITEM;
		A_Scope.callBack = "$scope.initLot();";
		$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM','vin_item',"vin_ssmaList")
	}

	$scope.initLot = function()
	{
		if ($scope.idVIN_SSMA < 1)
		{
			$scope.idVIN_SSMA='';
			$scope.VIN_SSMA_SPEID='';
			$scope.VIN_SSMA_DESCR='';
			$scope.VVIN_SSMA_SUETA='';
			$scope.VIN_SSMA_SHLIF='';
			$scope.VIN_SSMA_REVIS='';
			$scope.VIN_SSMA_SUPER='';
			$scope.VIN_SSMA_LINKS='';
			$scope.VIN_SSIT_ITMID= $scope.opts.idVIN_ITEM;
			$scope.idVIN_ITEM = $scope.vin_ssmaList[0].idVIN_ITEM;
			$scope.VIN_ITEM_ITMID = $scope.vin_ssmaList[0].VIN_ITEM_ITMID;
			$scope.VIN_ITEM_DESC1 = $scope.vin_ssmaList[0].VIN_ITEM_DESC1;
		}
	}
	
	$scope.initEditLot =function () 
	{
		$scope.ABinitTbl("vin_ssma","idVIN_SSMA");
		$scope.ABupdChkObj("idVIN_SSMA",$scope.opts.idVIN_SSMA,true);
		A_Scope.callBack = "$scope.getItemLots();";
		$scope.ABchkMain();
	}

	$scope.setUpdType = function(idNumber)
	{ 
		if (idNumber == 0)
		{
			$scope.opts.updType = "CREATE";
			$scope.opts.idVIN_SSMA = 0;
			$scope.initEditLot();
		}
		else
		{
			$scope.opts.updType = "UPDATE";
			$scope.opts.idVIN_SSMA = idNumber;
			$scope.initEditLot();	
		}
	}
	
	$scope.initEditLot();
}

</script>
