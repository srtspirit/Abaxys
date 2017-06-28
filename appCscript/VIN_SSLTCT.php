<script>
var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vin_sslt"] = "dbMain"; 
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
}
A_LocalAgularFn.prototype.VIN_SSLTCT = function($scope,$http,$routeParams) 
{
		$scope.errno = 0;
	   $scope.error = "";
	   $scope.utype = $scope.opts.updType;
	
	$scope.kPress = function(ce,obj,tbl,dir)
	{
		if(tbl=="vin_item") {
			var obj = new Object();
			obj["VIN_ITEM_LOTCT"] = 1;
			$scope.ABchkMain(obj,"vin_item");
		} else {
			$scope.ABlst(ce,obj,tbl,dir);
		} 
	}
	
	/*$scope.ckMain = function (ce,obj,tbl,dir)	
	{	
		var obj = new Object();
		obj["idVIN_SSLT"] = $scope.idVIN_SSLT;
		A_Scope.callBack = "$scope['vin_sslt'] = $scope['vin_sslt'];$scope.ckMain();"
		$scope.ABchkMain(obj,"vin_sslt")
	}*/
	if (!$scope.opts.updType)
	{ 
			$scope.VIN_SSLT_ITMID = "";
			$scope.kPress('VIN_SSLT_ITMID','VIN_SSLT_ITMID','vin_sslt',0);
	}
	/*$scope.vin_itemSupportTbl = function()
	{
		if($scope.idVIN_SSLT == undefined || $scope.idVIN_SSLT!="0") {
		$scope.VIN_ITEM_ITMID = "";
		$scope.ABlst('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',0);
		$scope.VIN_SSMA_SPEID = "";
		$scope.ABlst('VIN_SSMA_SPEID','VIN_SSMA_SPEID','vin_ssma',0);
		}
	}*/
   	if (($scope.opts.updType) && ($scope.idVIN_SSLT!=0))
      {
	      $scope.ABinitTbl('vin_sslt','idVIN_SSLT');
	      $scope.ABupdChkObj('idVIN_SSLT', $scope.opts.idVIN_SSLT,true);
	   }  else {
	   	$("#ab-sysOpt").addClass("hidden");
	   }
	  // A_Scope.callBack = "$scope.vin_itemSupportTbl();";
	   $scope.ABchkMain();
	   
	    $scope.delSet = function()
		{
			A_Scope.callBack = "$('#ab-back').click();";
			$scope.ABupd('DELETE');
		}	
}
</script>


