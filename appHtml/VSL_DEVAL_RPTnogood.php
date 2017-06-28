<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/HIS_REPORTS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>
</div>
<div class="hidden" rtp="ABlstAlias('idVIN_ITEM','idVIN_ITEM','vin_item_replenish','vin_rpln');" 
ng-init="SESSION_DESCR='Items replenish';idVIN_ITEM=0;initReplenish();" >
	<span ab-label="VIN_CUSTITEM"></span>
</div>
<div class="ab-session-div">

	<div class="row ab-spaceless hidden">

		<div class="col-lg-12 ab-spaceless" >
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		</div>

	</div>
	<div class="row ab-spaceless ">

		<div class="col-lg-12 ab-spaceless " >
			<table  >
			<tr>
				<td class="bg-primary">
				<h4>
					&nbsp;&nbsp;{{SESSION_DESCR}}&nbsp;&nbsp;
				</h4>
				</td>
				<td class="bg-primary">&nbsp;&nbsp;</td>
				<td class="bg-primary" >
					<span  >
						<button class="bg-primary ab-spaceless ab-strong" ng-click="initReplenish();" >
						&nbsp;Refresh&nbsp;
						</button>
					</span>
				</td>
				<td class="bg-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td class="bg-primary" >
					<span class='ab-pointer' onclick='$(".rpl_detail").addClass("hidden");' >
						<span class='glyphicon glyphicon-zoom-out '></span>
					</span>
				</td>
				<td class="bg-primary">&nbsp;&nbsp;</td>
				<td class="bg-primary" >
					<span class='ab-pointer btn-lg ' onclick='$(".rpl_detail").removeClass("hidden");' >
						<span class='glyphicon glyphicon-zoom-in '></span>
					</span>
				</td>
				<td class="bg-primary" ng-init="ordersAll=0;mainSearchOrder='';" >
					<span  >
						<!--<input ng-model="mainSearchOrder" size=5 ng-init="" /> -->
						{{mainSearchOrder}}
						<button class="bg-primary ab-spaceless ab-strong"  ng-click="ordersAll=1-ordersAll;" >
						&nbsp;
						<span ng-if="ordersAll==0">View</span>
						<span ng-if="ordersAll==1">Hide</span>
						&nbsp;Orders
						&nbsp;
						</button>
					</span>
				</td>	
				<td class="bg-primary">&nbsp;&nbsp;</td>
				<td>
					<div id="ab-wait-display" >
					</div>
				</td>
				<td class="bg-primary" onmouseover="chkWindowSize();" >
					<span class="ab-window-size" ></span>
					<span class="visible-xs" >&nbsp;XS&nbsp;</span>
					<span class="visible-sm" >&nbsp;SM&nbsp;</span>
					<span class="visible-md" >&nbsp;MD&nbsp;</span>
					<span class="visible-lg" >&nbsp;LG&nbsp;</span>
					
				</td>
			</tr>
			</table>
		</div>
					
	</div>	

<script>
$('#ab-sysOpt').html("")
$('ab-wait-display').remove();

</script>


<div class="row ab-session-div">
	<div class="ab-wrapper-div">		
		<div class="col-lg-1">

		</div>	
		
		<div class="col-lg-10">
			<div class="row text-primary ab-strong visible-lg" >
					<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12  ">
						<span ab-label="VIN_ITEM_ITMID"></span>
					</div>
					<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12  ">
						<span ab-label="STD_DESCR"></span>
					</div>
					<div class="col-lg-1 col-md-3 col-sm-4 col-xs-6  ">
						<span ab-label="VIN_ITEM_BOHQT_S"></span>
					</div>
					<div class="col-lg-1 col-md-3 col-sm-4 col-xs-6  ">
						<span ab-label="VIN_ITEM_ALOQT"></span>
					</div>
					<div class="col-lg-1 col-md-3 col-sm-4 col-xs-6  ">
						<span ab-label="VIN_ITEM_PURQT_SH1"></span>
					</div>	
					<div class="col-lg-1 col-md-3 col-sm-4 col-xs-6  ">
						<span ab-label="VIN_ITEM_SUETA"></span>
					</div>	
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12  ">	
						<span ab-label="STD_INST2RUCTIONS">Recommendation</span>
					</div>
				</tr>
			</table>
		</div>
		<div class="col-lg-1">
		</div>
	</div>
</div>
		
<?php require_once "../appHtml/VIN_REPLENISHTMP.php"; ?>


</div>
	 
<div class='btn-sm ab-body-buttons hidden' >
	<span class='hidden'>
		Records per page:&nbsp;
		<select class='text-muted' ab-mpp onchange="getMaxPerPage();" value="100" >
		
		  <option value="10">10</option>
		  <option value="20" >20</option>
		  <option value="40"  >40</option>
		  <option value="100" selected >100</option>
		</select>

	</span>
</div>
