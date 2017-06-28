<script>
var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vin_ssit"] = "dbMain"; 
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}
A_LocalAgularFn.prototype.VIN_SSITCT = function($scope,$http,$routeParams) 
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
	$scope.VIN_SSIT_ITMID = $scope.opts.VIN_SSIT_ITMID;
			$scope.VIN_SSIT_SPESQ = $scope.opts.VIN_SSIT_SPESQ;
	$scope.ABupd = function (opt) {
		if (opt == "CREATE"){
			
			alert($scope.VIN_SSIT_SPESQ);
			A_Scope.dbUpd($scope,$http,opt);
		}
	}
	/*$scope.ckMain = function (ce,obj,tbl,dir)	
	{	
		var obj = new Object();
		obj["idVIN_SSIT"] = $scope.idVIN_SSIT;
		A_Scope.callBack = "$scope['vin_ssit'] = $scope['vin_ssit'];$scope.ckMain();"
		$scope.ABchkMain(obj,"vin_ssit")
	}*/
	/*if (!$scope.opts.updType)
	{ 
			$scope.VIN_SSIT_ITMID = "";
			$scope.kPress('VIN_SSIT_ITMID','VIN_SSIT_ITMID','vin_ssit',0);
	}
	
	
   	if (($scope.opts.updType) && ($scope.idVIN_SSIT!=0))
      {
	      $scope.ABinitTbl('vin_ssit','idVIN_SSIT');
	      $scope.ABupdChkObj('idVIN_SSIT', $scope.opts.idVIN_SSIT,true);
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
	 
	$('#ab-back').attr("href","#VIN_ITEMS/VIN_SSITCT/Process:VIN_ITEMS,Session:VIN_SSITCT,tblName:vin_ssit")  
	*/
}
</script>


