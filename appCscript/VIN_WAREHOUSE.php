<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vin_wars"] = "dbMain";

	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}

A_LocalAgularFn.prototype.VIN_WAREHOUSE = function($scope,$http,$routeParams)
{

		$scope.initWarDta = function(opt)
  		{
 		$scope.VIN_WARS_WARID = " ";
		$scope.ABlstAlias('VIN_WARS_WARID','VIN_WARS_WARID','vin_wars',0);
		}
		
		$scope.initWarDta();
}
A_LocalAgularFn.prototype.VIN_WARSCT = function($scope,$http,$routeParams)
{
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype = $scope.opts.updType;
	
	if (!$scope.opts.idVIN_WARS)
	{
		A_LocalAgular.setOpts($scope,"idVIN_WARS");
   }

	
	$scope.serNewLocId = function(opt)
 	{
 		$scope.VIN_LOCS_WARID = opt;
		$scope.idVIN_LOCS = "";
		$scope.VIN_LOCS_LOCID = "";
		$scope.VIN_LOCS_DESCR = "";
		//alert($scope.VIN_LOCS_WARID);
   }
	
 
	$scope.locsABupd = function(opt)
   {
    	$("#mainForm").attr("ab-main","vin_locs");
    	$scope.ABupd(opt);
    	$("#mainForm").attr("ab-main","vin_wars");
   }
   
   $scope.initWarsctDta = function(opt)
   {
   	$scope.ABinitTbl('vin_wars','idVIN_WARS');
		$scope.ABupdChkObj('idVIN_WARS',opt,true);
		$scope.ABchkMain();
   }
/************************ Set YES/NO field value ****************/
   $scope.initYNfld = function(opt,mnLoc)
   {
   		if(mnLoc == "OK")
   		{
   			$("#dfLoc_lbl").css('display','block');
   			$("#dfLoc_fld").css('display','none');
   		}
   		else
   		{
   			$("#dfLoc_lbl").css('display','none');
   			$("#dfLoc_fld").css('display','block');
   		}
   		
			$scope.Default_location = opt;
   }
  
	$scope.initWarsctDta($scope.opts.idVIN_WARS);
}

</script>
