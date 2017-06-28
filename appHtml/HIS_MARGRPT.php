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


<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VGB_PARTNERS_vgb_cust";
$sparm["searchTable"] = "vgb_cust";
$sparm["searchJoin"] = "vgb_bpar:idVGB_BPAR = VGB_CUST_BPART";
$sparm["searchJoin"] .= ",vgb_addr:VGB_ADDR_BPART = VGB_CUST_BPART";
$sparm["searchJoin"] .= ",vgb_mark:idVGB_MARK = VGB_CUST_MRKID ";
$sparm["searchJoin"] .= ",vgb_ctyp:idVGB_CTYP = VGB_CUST_CUTYP ";
$sparm["searchJoin"] .= ",vgb_curr:idVGB_CURR = VGB_CUST_CURID";
$sparm["orderBy"] = "VGB_BPAR_BPART ASC";

$sparm["searchResult"] = "vgb_custList";
$sparm["searchFilter"] = "ab-spaceless";
$sparm["filterExclude"] = "VGB_BPAR_BPNAM,VGB_BPAR_CDATE";
$sparm["filterAuto"] = "VGB_BPAR_BPART,VGB_CTYP_CUTYP,VGB_MARK_MRKID,VGB_CUST_CSTAT";
$sparm["callBack"] = "";

$custSearch = $xtmp->setSearchMaster($sparm);
$custLister = <<<EOC
<div id="vsl_custView" class=" ab-border " >
<div class="ab-wrapper-div">
<table class="ab-border ab-spaceless" style="width:100%;" >
<tr class="well text-primary ab-strong">
<td style="width:5%;" ></td>
<td style="width:65%;white-space:nowrap;" >{$custSearch}</td>
<td style="width:5%;" ></td>
<td style="width:10%;" ><span class="btn btn-success btn-md ab-spaceless ab-pointer ab-strong" ng-click="selectRec(0,'custFilter');">
&nbsp;<span ab-label="STD_CLR_ALL">Clear</span>&nbsp;
</span></td>
<td style="width:10%;" ><span class="btn btn-success btn-md ab-spaceless ab-pointer ab-strong" ng-click="selectRecAll('custFilter','vgb_custList','idVGB_CUST');">
&nbsp;<span ab-label="STD_SEL_ALL">All</span>&nbsp;
</span></td>
<td style="width:5%;"></td>
</tr>
</table>
</div>



<table class="table-striped" style="width:100%;" >
<tr>
<td style="width:1%;" ></td>
<td style="width:25%;" ></td>
<td style="width:4%;" ></td>
<td style="width:4%;" ></td>
<td style="width:40%;" ></td>
<td style="width:10%;" ></td>
<td style="width:10%;" ></td>
<td style="width:6%;" ></td>

</tr>
</table>

<div class="ab-wrapper-div ">
<table class="table-striped" style="width:100%;" >
<tr class="text-primary ab-strong">
<td style="width:1%;" ></td>
<td style="width:25%;" >Cust Id</td>
<td style="width:4%;" ></td>
<td style="width:4%;" ></td>
<td style="width:40%;" >Name</td>
<td style="width:10%;" >Type</td>
<td style="width:10%;" >Market</td>
<td style="width:6%;" ></td>

</tr>
<tr 	class="ab-pointer"
	ng-repeat="acc in vgb_custList | AB_noDoubles:'idVGB_CUST' " 
	ng-click="selectRec(acc.idVGB_CUST,'custFilter');" 
	
	onmouseover="$(this).addClass('text-primary ab-strong')"
	onmouseout="$(this).removeClass('text-primary ab-strong')"
	>
<td>&nbsp;</td>	
<td>{{acc.VGB_BPAR_BPART}}&nbsp;({{acc.VGB_CURR_CURID}})</td>
<td>&nbsp;</td>
<td>
<span class="{{isRecSelected(acc.idVGB_CUST,'custFilter')?'':'invisible'}}" >
<span class="glyphicon glyphicon-ok" title=""></span>
</span>
</td>
<td >{{acc.VGB_CUST_BPNAM}}</td>
<td>{{acc.VGB_CTYP_CUTYP}}</td>
<td>{{acc.VGB_MARK_MRKID}}</td>
</tr>
</table>
</div>

</div>


EOC;


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
	<div class="row text-primary ab-strong">
		<div class="col-lg-2">
			<span class="ab-pointer text-primary ab-strong" onclick='$("#openCustSelection").click();'>
							Customers
							(
							<span class="{{custFilter.length==0?'':'hidden'}}" ab-label="STD_ALL">tous</span>
							<span class="{{custFilter.length>0?'':'hidden'}}" >{{custFilter.length}}</span>
							)
							<span class="caret"></span>
			</span>	
		</div>
		<div class="col-lg-2">
			Aging Date: 
		</div>
		<div class="col-lg-2">
			<?php
				$hardCode = $xtmp->setDatePick("agingDate");
				echo  $hardCode;
			?>
		</div>
		<div class="col-lg-2">
			<span class="btn btn-success btn-md ab-spaceless" ab-label="STD_SUBMIT" ng-click="doAgingReport();" >GO</span>
		</div>
	</div>
	<span class="hidden" id="openCustSelection" data-toggle="modal" data-target="#custselect" ></span>
	<div id="custselect" class="modal fade" role="dialog" >
  <div class="modal-dialog" style="width:60%;">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span  >Customer selection </span> </h4>
        <button>nothing</button>
        <button  data-dismiss="modal" >something</button>
      </div>
      <div class="modal-body">
		<?php echo $custLister; ?>
      </div>

    </div>

  </div>
</div>
	
	<div class="container">
		<div class="row bg-primary">
			<div class="col-lg-2">Name</div>
			<div class="col-lg-10">
				<div class="row">
					<div class="col-lg-2">Invice number and date/total debt</div>
					<div class="col-lg-2">1 -30 days</div>
					<div class="col-lg-2">31 - 60 days</div>
					<div class="col-lg-2">61 - 90 days</div>
					<div class="col-lg-2">91 - 120 days</div>
					<div class="col-lg-2">Old</div>
				</div>
			</div>
		</div>
		<div class="row" ng-repeat="curr in dummyTable">
			<div class="col-lg-2">
				<span pt="#id{{curr.custId}}" class="btn-link glyphicon glyphicon-th-list collapsed" onclick="$($(this).attr('pt')).toggleClass('hidden');"/>
				<span>{{curr.name}}</span></div>
			<div class="col-lg-10">
				<div class="row">
					<div class="col-lg-2">{{curr.totalDebt}}</div>
					<div class="col-lg-2">{{curr.total30}}</div>
					<div class="col-lg-2">{{curr.total60}}</div>
					<div class="col-lg-2">{{curr.total90}}</div>
					<div class="col-lg-2">{{curr.total120}}</div>
					<div class="col-lg-2">{{curr.totalOld}}</div>
				</div>
				
				<div id="id{{curr.custId}}" class="hidden">
					<div class="row ab-border" ng-repeat="currInv in curr.invoices">
						<div class="col-lg-2">
							<div>{{currInv[0]}}</div>
							<div>{{currInv[1]}}</div>
						</div>
						<div class="col-lg-2">{{currInv[2]}}</div>
						<div class="col-lg-2">{{currInv[3]}}</div>
						<div class="col-lg-2">{{currInv[4]}}</div>
						<div class="col-lg-2">{{currInv[5]}}</div>
						<div class="col-lg-2">{{currInv[6]}}</div>
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

