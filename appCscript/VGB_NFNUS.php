<script>
var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vgb_nfnu"] = "dbMain";
	 
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}
A_LocalAgularFn.prototype.VGB_NFNUS = function($scope,$http,$routeParams) 
{
		// I included this below to comply with your current HTML. But you must modify VIN_ITEMS to directly call ABlstAlias in $inTrig kPress statements
	// You must rewrite the function to specify "vin_item"  in reference to ng-repeat="x in vgb_nfnu"
	// Will give same resuls and will comply to naming convention.
	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		$scope.ABlstAlias(ce,obj,tbl,"vgb_nfnu")
	}

	$scope.VGB_NFNU_NFNCO = "";
	$scope.kPress('VGB_NFNU_NFNCO','VGB_NFNU_NFNCO','vgb_nfnu',0);
}
A_LocalAgularFn.prototype.VGB_NFNUCT = function($scope,$http,$routeParams) 
{
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype = $scope.opts.updType;
	if (!$scope.opts.idVGB_NFNU)
	{
		A_LocalAgular.setOpts($scope,"idVGB_NFNU");

	}
	if (!$scope.opts.idVGB_NFNU)
	{
		A_LocalAgular.setOpts($scope,"idVGB_NFNU");

	}
	$scope.kPress = function(ce,obj,tbl,dir)
	{
		$scope.ABlst(ce,obj,tbl,dir)
	}
	

	$scope.ABinitTbl('vgb_nfnu','idVGB_NFNU');
	$scope.ABupdChkObj('idVGB_NFNU', $scope.opts.idVGB_NFNU,true);
	$scope.ABchkMain();
	
	$scope.ABupd = function (opt) {
		if ($scope.idVGB_NFNU > 0){
			A_Scope.callBack = "if (data['posts'].errorCode==0){ $('#ab-back').click();}"
			A_Scope.dbUpd($scope,$http,opt);
		 } else {
			 $scope.saveAll(opt)
		 }
	 }
	 $scope.saveAll = function(opt){
		 A_Scope.callBack = "if (data['posts'].errorCode==0){  $('#ab-back').click(); }"
		 var docs = A_Scope.dbUpd($scope,$http,opt);
	 }	
}
</script>


