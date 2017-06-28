<script>
var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vgb_amhe"] = "dbMain";
	 
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}
A_LocalAgularFn.prototype.VGB_AMHE = function($scope,$http,$routeParams) 
{
	// I included this below to comply with your current HTML. But you must modify VIN_ITEMS to directly call ABlstAlias in $inTrig kPress statements
	// You must rewrite the function to specify "vin_item"  in reference to ng-repeat="x in vgb_amhe"
	// Will give same resuls and will comply to naming convention.
	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		$scope.ABlstAlias(ce,obj,tbl,"vgb_amhe")
	}

	$scope.VGB_AMHE_MESID = "";
	$scope.kPress('VGB_AMHE_MESID','VGB_AMHE_MESID','vgb_amhe',0);
}

A_LocalAgularFn.prototype.VGB_AMHECT = function($scope,$http,$routeParams) 
{
	$scope.errno = 0;
	$scope.error = "";
	
//$scope.localABupd = function ()
//{
	
//	$scope.datecheck();
		
//}

	$scope.datecheck = function()
	{
		$scope["vgb_amhe_localError"] = "";
		
	if($scope.VGB_AMHE_ALWAY<1)
		{
		try {
			  	 
			var dtfr = $scope.ABGetDateFn('get-year',$scope.VGB_AMHE_DATFR)+'-'+$scope.ABGetDateFn('get-month',$scope.VGB_AMHE_DATFR)+'-'+$scope.ABGetDateFn('get-day',$scope.VGB_AMHE_DATFR);
			var dtto = $scope.ABGetDateFn('get-year',$scope.VGB_AMHE_DATTO)+'-'+$scope.ABGetDateFn('get-month',$scope.VGB_AMHE_DATTO)+'-'+$scope.ABGetDateFn('get-day',$scope.VGB_AMHE_DATTO);
	    
			if($scope.VGB_AMHE_ALWAY<1&&($scope.VGB_AMHE_DATFR<1||$scope.DATTO<1))
			{
				$scope["vgb_amhe_localError"] ='Date is mandatory kindly enter';
				$scope.ABupdCancel = true;
			}	
			else if($scope.VGB_AMHE_ALWAY<1&&dtfr>dtto)
			{
				$scope["vgb_amhe_localError"] ='From date should not be greater than to date';
				$scope.ABupdCancel = true;
			}
		}catch(er)
		{
			$scope["vgb_amhe_localError"] = 'You have bad dates';
			$scope.ABupdCancel = true;
		}
	}
	
	}

	$scope.setStepList = function()
	{
		
		$scope.VGB_AMHE_STEPLIST = "";
		var comma = "";
		
		$("[steps='"+$scope.VGB_AMHE_SOURC+"']").each(function()
		{
			if ($(this).prop("checked") == true)
			{
				$scope.VGB_AMHE_STEPLIST += comma + $(this).val();
				comma = ",";
			}
			
		}
		
		);
		
		

		// $("[ng-model='VGB_AMHE_STEPLIST']").val(stepList);
		
		
		//$scope.ABupdCancel = true;

		
	}
	
	$scope.getCPARMdta = function()
	{
		var chkList = "";
		if ($scope.VGB_AMHE_STEPLIST)
		{
			chkList=$scope.VGB_AMHE_STEPLIST;
		}
		
	
		$($("[steps='"+$scope.VGB_AMHE_SOURC+"']")).each(function()
		{   
			$(this).prop("checked",false);
			if((chkList.indexOf($(this).val()))>-1)
			{
				$(this).prop("checked",true);
			}
			else
			{
				$(this).prop("checked",false);	
			}	
			
		});
		
	}
	
	$scope.getCPARM = function()
	{

		A_Scope.callBack = "$scope.initCPARM();";
		$scope.idVBP_CPARM =0;
		$scope.ABlstAlias('idVBP_CPARM','idVBP_CPARM',"vbp_cparm","vbp_cparm")
	}
	
	$scope.initCPARM = function()
	{
		try
		{
			var vpuList = "";
			var vslList = "";
			
		
			$scope["vpuSteps"] = new Array();
			$scope["vslSteps"] = new Array();
			
			var occ = 0;
			while (occ < $scope.vbp_cparm.length)
			{
				if($scope.vbp_cparm[occ]["VBP_CPARM_PRMID"]=="VPU_STEPS")
				{	
					if($scope.vbp_cparm[occ]["VBP_CPARM_PRMVA"]!="")
					{	
						vpuList += "-" + $scope.vbp_cparm[occ]["VBP_CPARM_PRMNA"] + "-";
					}
				}
					
				if($scope.vbp_cparm[occ]["VBP_CPARM_PRMID"]=="VSL_STEPS")
				{	
					if($scope.vbp_cparm[occ]["VBP_CPARM_PRMVA"]!="")
					{	
						vslList += "-" + $scope.vbp_cparm[occ]["VBP_CPARM_PRMNA"] + "-";
					}
				}
				
				occ += 1;
			}
			
			var occ = 0
			while (occ < $scope.vbp_cparm.length)
			{
				if($scope.vbp_cparm[occ]["VBP_CPARM_PRMID"]=="VPU_STEPS_DESCR")
				{	
					if (vpuList.indexOf($scope.vbp_cparm[occ]["VBP_CPARM_PRMNA"]) > -1)
					{
						var recCount = $scope["vpuSteps"].length
						$scope["vpuSteps"][recCount] = new Object();
						$scope["vpuSteps"][recCount] = $scope.vbp_cparm[occ]
					}
				}
			
				if($scope.vbp_cparm[occ]["VBP_CPARM_PRMID"]=="VSL_STEPS_DESCR")
				{	
					if (vslList.indexOf($scope.vbp_cparm[occ]["VBP_CPARM_PRMNA"]) > -1)
					{
						var recCount = $scope["vslSteps"].length
						$scope["vslSteps"][recCount] = new Object();
						$scope["vslSteps"][recCount] = $scope.vbp_cparm[occ]
					}
				}
				occ += 1;
			}
			
		}
		catch(er){alert(er)}	
	}
	
	$scope.getMessageList = function()
	{
		$scope.idVGB_AMHE = 0;
		$scope.ABlstAlias('idVGB_AMHE','idVGB_AMHE','vgb_amhe',"lister");   	
	}
	
	$scope.initDocMsgdta = function(holdId,source)
    	{
		
		$scope.source = source;
		$scope.ABinitTbl('vgb_amhe','idVGB_AMHE');	
		$scope.ABupdChkObj('idVGB_AMHE',holdId,true);   	
		A_Scope.callBack = "$scope.VGB_AMHE_SOURC=$scope.source;$scope.getCPARMdta();";		
		$scope.ABchk();	
  
	}
	
	$scope.getMessageList();
	$scope.source = "SALES";
	$scope.orgId = 0;
	$scope.initDocMsgdta($scope.orgId,$scope.source);
	$scope.getCPARM();

	
	

}
</script>


