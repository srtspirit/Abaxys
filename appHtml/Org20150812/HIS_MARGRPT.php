<div class="hidden">
<?php 
session_start();
ob_clean();
?>
</div>
​<style>

td 
{
	
}

</style>
<!-- require_once "../appCscript/VIT_ISSUES.php"; --> 
​<div class="hidden">
<?php 
require_once "../stdSscript/stdAppobjGen.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
require_once "../appCscript/HIS_REPORTS_TEST.php";

?>
​
</div>
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->


<div class="row " ng-init="SESSION_DESCR='Profit Margin Report';" >

	<!--div class="col-lg-12 ab-spaceless">
	
	    <!--?php require_once "../stdCscript/stdFormButtons.php"; ?>
	    <script>
	        $('#ab-buttonPad').html('');
	        $('#ab-new').html('');
	    </script>
	    
	</div-->
	<div class="col-md-12"> 
		<input type="checkbox" ng-model="ALL" ng-init="ALL=0"/>
	</div>

	<div class="col-md-12 {{ALL==0?'':'hidden'}}"> 
	


<?php

$xtmp = new appForm("Andrey_cdc");
$sparm = array();
$sparm["searchLabel"] = "VGB_CUST_BPART";
$sparm["searchTable"] = "vgb_cust";
$sparm["searchJoin"] = "";
$sparm["searchJoin"] .= ",vgb_bpar:idVGB_BPAR = VGB_CUST_BPART";
$sparm["searchJoin"] .= ",vgb_addr:VGB_ADDR_BPART = idVGB_BPAR";
#$sparm["searchJoin"] .= ",vgb_oihe:idVAR_OIHE = VAR_OIDE_OITID";
#$sparm["searchJoin"] .= ",vsl_orhe:idVGB_CUST = VSL_ORHE_BTCUS";
$sparm["searchPattern"] = "[=SPE=]VAR_OIHE_DOCDA <= STR_TO_DATE('2017-02-01', '%y-%m-%d')";
$sparm["objFunctions"] = "";
$sparm["objGroupBy"] = "";


#$sparm["orderBy"] = "idVAR_OIHE";

$sparm["searchResult"] = "userFilter";
$sparm["searchFilter"] = "";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VGB_BPAR_BPART";
$sparm["callBack"] = "$" . "scope.readVarItems();";
$hardCode = $xtmp->setSearchMaster($sparm);
echo $hardCode;

?>	

	</div>​
	<!--div class="container"> 
	
	
		<div class="row text-primary visible-md visible-lg" >
			<div class="col-md-2 col-lg-2">Name</div>
			<div class="col-md-2 col-lg-2">0-30 Days</div>	
			<div class="col-md-2 col-lg-2">31-60 Days</div>	
			<div class="col-md-2 col-lg-2">61-90 Days</div>	
			<div class="col-md-2 col-lg-2">91-120 Days</div>
			<div class="col-md-2 col-lg-2">>120 Days</div>
		</div>			

		<div class="row" ng-repeat="curr in table">
			<div class="text-primary col-sm-6 col-xs-6 visible-sm visible-xs">Name</div>
			<div class="col-md-2 col-lg-2 col-sm-6 col-xs-6"><span class="btn-link glyphicon glyphicon-th-list collapsed"/>{{curr.VGB_CUST_BPNAM}}</div>
			
			<div class="col-sm-6 col-xs-6 text-primary visible-sm visible-xs">before30</div>
			<div class="col-md-2 col-lg-2 col-xs-6 col-sm-6">
				<div class="row" ng-repeat="det in curr.before30">
					<div class="col-xs-12">{{det.balance}}</div>	
				</div>
			</div>
			<div class="clearfix visible-xs visible-sm"></div>
			
			<div class="col-sm-6 col-xs-6 text-primary visible-sm visible-xs">before60</div>
			<div class="col-md-2 col-lg-2 col-xs-6 col-sm-6">
				<div class="row" ng-repeat="det in curr.before60">
					<div>{{det.balance}}</div>	
				</div>
			</div>
			
			<div class="clearfix visible-xs visible-sm"></div>
			<div class="col-sm-6 col-xs-6 text-primary visible-sm visible-xs">before90</div>
			<div class="col-md-2 col-lg-2 col-xs-6 col-sm-6">
				<div ng-repeat="det in curr.before90">
					<div>{{det.balance}}</div>	
				</div>
			</div>
			
			<div class="clearfix visible-xs visible-sm"></div>
			<div class="col-sm-6 col-xs-6 text-primary visible-sm visible-xs">before120</div>
			<div class="col-md-2 col-lg-2 col-xs-6 col-sm-6">
				<div ng-repeat="det in curr.before120">
					<div>{{det.balance}}</div>	
				</div>
			</div>
			
			<div class="clearfix visible-xs visible-sm"></div>
			<div class="col-sm-6 col-xs-6 text-primary visible-sm visible-xs">after120</div>
			<div class="col-md-2 col-lg-2 col-xs-6 col-sm-6">
				<div ng-repeat="det in curr.after120">
					<div>{{det.balance}}</div>	
				</div>
			</div>
		</div>			
					
		
	</div-->
	
	<div class="container">
		<div class="row text-primary">
			<div class="col-lg-3">Name</div>
			<div class="col-lg-9">
				<div class="col-lg-7">Invice number and date/total debt</div>
				<div class="col-lg-1">1 -30 days</div>
				<div class="col-lg-1">31 - 60 days</div>
				<div class="col-lg-1">61 - 90 days</div>
				<div class="col-lg-1">91 - 120 days</div>
				<div class="col-lg-1">Old</div>
			</div>
		</div>
		<div class="row" ng-repeat="curr in dummyTable">
			<div class="col-lg-3">
				<span pt="#id{{curr.custId}}" class="btn-link glyphicon glyphicon-th-list collapsed" onclick="$($(this).attr('pt')).toggleClass('hidden');"/>
				<span>{{curr.name}}</span></div>
			<div class="col-lg-9">
				<div class="col-lg-7" style="align:right">{{curr.totalDebt}}</div>
				<div class="col-lg-1">{{curr.total30}}</div>
				<div class="col-lg-1">{{curr.total60}}</div>
				<div class="col-lg-1">{{curr.total90}}</div>
				<div class="col-lg-1">{{curr.total120}}</div>
				<div class="col-lg-1">{{curr.totalOld}}</div>
				
				<div id="id{{curr.custId}}" class="hidden">
					<div class="row" ng-repeat="currInv in curr.invoices">
						<div class="col-lg-7">{{currInv[0]}}</div>
						<div class="col-lg-1">{{currInv[1]}}</div>
						<div class="col-lg-1">{{currInv[2]}}</div>
						<div class="col-lg-1">{{currInv[3]}}</div>
						<div class="col-lg-1">{{currInv[4]}}</div>
						<div class="col-lg-1">{{currInv[5]}}</div>
					</div>
				</div>
				
				<!--script>
					$("#{{curr.name}}").onClick = function()
						{
							$("#{{curr.name}}details").toggleClass("hidden");
						};
				</script-->
			</div>
			
		</div>
	</div>
</div>

