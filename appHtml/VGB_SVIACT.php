<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
	<?php require_once "../appCscript/VGB_PARTNERS.php"; ?>
</div>


<div style="margin-left:5px;" ng-init="SESSION_DESCR='Maintain Transporters'">

	<div class="ab-spaceless"  >

		<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		
	</div>

<div id="ab-new" class="hidden" >
	<label  title="CREATE" ng-if="idVGB_SVIA>0">
		 <a ng-click="editVgb_svia(0,'');" >
			<span >New</span>
			<span  class="glyphicon glyphicon-pencil" ></span>
		</a>			
	</label>
</div>



	<script>
		$('#ab-appOpt').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
	</script>
	
<div class="hidden">
<textarea class="hidden" ab-updSuccess="" >

if (data['posts'].requestMethod == 'DELETE')
{
	$scope.recDefault = new Object();
	A_Scope.callBack = "$scope.editVgb_svia(0,$scope.recDefault);";
	$scope.initDisplayData();
}
else
{

	if (data['posts'].requestMethod == "CREATE")
	{
		$scope.recDefault = new Object();
		A_Scope.callBack = "$scope.editVgb_svia(" + data["posts"].insertId + ",$scope.recDefault);";
		$scope.initDisplayData();

	}
	else
	{
	}

}

$scope.vgb_cust_svia = new Array();


</textarea>
</div>


<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VGB_PARTNERS_vgb_supp";
$sparm["searchTable"] = "vgb_supp";
$sparm["searchJoin"] = "vgb_bpar:idVGB_BPAR = VGB_SUPP_BPART";


$sparm["orderBy"] = "VGB_SUPP_BPNAM ASC";

$sparm["searchResult"] = "vgb_suppliers";
$sparm["searchFilter"] = "hidden";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "";
$sparm["callBack"] = "";

$supplierSearch = $xtmp->setSearchMaster($sparm);

$supplierLister = <<<EOC
<div id="vgb_suppView" class=" ab-container ab-border hidden" style="position:fixed;z-index:1;">
<div class="ab-wrapper-div">
<table class="ab-border ab-spaceless" style="width:100%;" >
<tr class="well text-primary ab-strong">
<td style="width:5%;" ></td>
<td style="width:80%;white-space:nowrap;" class="text-center">{$supplierSearch}</td>

<td style="width:5%;" ></td>
<td style="width:10%;" onclick="$('#vgb_suppView').addClass('hidden');" class="bg-primary text-center" >X</td>
</tr>
</table>
</div>

<div class="ab-wrapper-div ">

<table class="table-striped" style="width:100%;" >
<tr>
<td style="width:1%;" ></td>
<td style="width:30%;" ></td>
<td style="width:3%;" ></td>
<td style="width:65%;" ></td>
<td style="width:1%;" ></td>

</tr>
<tr 	class="ab-pointer"
	ng-repeat="sacc in vgb_suppliers" 
	onclick='$("#vgb_suppView").addClass("hidden");'
	ng-click="updVal('VGB_SVIA_SUPPID',sacc.idVGB_SUPP,sacc);"
	
	onmouseover="$(this).addClass('text-primary ab-strong')"
	onmouseout="$(this).removeClass('text-primary ab-strong')"
	>
<td>&nbsp;</td>	
<td>{{sacc.VGB_BPAR_BPART}}&nbsp;</td>
<td>&nbsp;</td>
<td >{{sacc.VGB_SUPP_BPNAM}}</td>
<td>&nbsp;</td>
</tr>
</table>
</div>
</div>

<script>
$("[ng-model='ABsPattern{$sparm["searchResult"]}']").focus(function()
{
	$("#vgb_suppView").removeClass("hidden");
	$("#vgb_custView").addClass("hidden");

	// $(this).select()
});


</script>

EOC;


?>


<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VGB_PARTNERS_vgb_cust";
$sparm["searchTable"] = "vgb_cust";
$sparm["searchJoin"] = "vgb_bpar:idVGB_BPAR = VGB_CUST_BPART";


$sparm["orderBy"] = "VGB_CUST_BPNAM ASC";

$sparm["searchResult"] = "vgb_customers";
$sparm["searchFilter"] = "hidden";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "";
$sparm["callBack"] = "";

$customerSearch = $xtmp->setSearchMaster($sparm);

$customerLister = <<<EOC
<div id="vgb_custView" class=" ab-container ab-border hidden" style="position:fixed;z-index:1;">
<div class="ab-wrapper-div">
<table class="ab-border ab-spaceless" style="width:100%;" >
<tr class="well text-primary ab-strong">
<td style="width:5%;" ></td>
<td style="width:80%;white-space:nowrap;" class="text-center"> {$customerSearch}</td>

<td style="width:5%;" ></td>
<td style="width:10%;" onclick="$('#vgb_custView').addClass('hidden');" class="bg-primary text-center" >X</td>
</tr>
</table>
</div>

<div class="ab-wrapper-div ">

<table class="table-striped" style="width:100%;" >
<tr>
<td style="width:1%;" ></td>
<td style="width:30%;" ></td>
<td style="width:3%;" ></td>
<td style="width:65%;" ></td>
<td style="width:1%;" ></td>

</tr>
<tr 	class="ab-pointer"
	ng-repeat="cacc in vgb_customers" 
	onclick='$("#vgb_custView").addClass("hidden");'
	ng-click="updVal('VGB_SVIA_CUSTID',cacc.idVGB_CUST,cacc);"
	onmouseover="$(this).addClass('text-primary ab-strong')"
	onmouseout="$(this).removeClass('text-primary ab-strong')"
	>
<td>&nbsp;</td>	
<td>{{cacc.VGB_BPAR_BPART}}&nbsp;</td>
<td>&nbsp;</td>
<td >{{cacc.VGB_CUST_BPNAM}}</td>
<td>&nbsp;</td>
</tr>
</table>
</div>
</div>

<script>
$("[ng-model='ABsPattern{$sparm["searchResult"]}']").focus(function()
{
	$("#vgb_custView").removeClass("hidden");
	$("#vgb_suppView").addClass("hidden");
	// $(this).select()
});


</script>

EOC;


?>



	<div class="row">
		<div class="col-lg-2 ab-spaceless" style="padding-left:10px;margin-top:20px;" >
		<div ng-init="optionView=0;" >
			<table style="width:100%;">
			<tr ng-click="ABdbTblList();" >
				<td colspan=2 class="ab-underline text-center text-primary ab-strong" ng-click="callLister();" >Sort By</td>
			</tr>
			<tr>
				<td style="width:50%;" class="ab-border ab-spaceless" >
					<span >
						<span class="{{optionView==0?'':'invisible'}} text-primary">
							<span class="glyphicon glyphicon-ok"></span>
						</span>
						<span ng-click="initDisplayData();optionView=0;" ab-label="VGB_SVIACT" class="text-primary ab-pointer">Supplier</span>
					</span>
				</td>
				<td style="width:50%;" class="ab-border ab-spaceless">
					<span >
						<span class="{{optionView==1?'':'invisible'}} text-primary">
							<span class="glyphicon glyphicon-ok"></span>
						</span>
						<span ng-click="initDisplayCust();optionView=1;" ab-label="VGB_PARTNERS_vgb_cust" class="text-primary ab-pointer">Customer</span>
					</span>
				</td>
			<tr>
			<tr class="ab-border" >
				<td colspan=2></td>
			</tr>
			</table>
		</div>
			
		<div class="ab-wrapper-div {{optionView==0?'':'hidden'}}">
			<table class="table-striped" style="width:100%;" 
			ng-repeat="stat in vgb_supp_stats  | AB_Sorted:'VGB_SUPP_BPNAM' ">
				<tr>
					<td style="width:10%;">
					</td>
					<td style="width:60%;">
					</td>	
					<td style="width:15%;">
					</td>	
					
					<td style="width:15%;">
					</td>	
				</tr>
				<tr>
					<td colspan=2 class="ab-strong" >
						<span class="text-primary ab-pointer"   ng-click="detSuppierDetail(stat.VGB_SVIA_SUPPID);" >
							<span class="caret"></span>&nbsp;
							{{stat.VGB_SUPP_BPNAM }}
						</span>
					</td>
					<td>
					(<span class="ab-strong">{{stat.recCountSupp}}</span>)
					</td>
					<td>
						<span class="text-primary ab-pointer" ng-click="editVgb_svia(0,stat);">Add</span>
					</td>	
				</tr>
				<tr ng-repeat="det in vgb_supp_detail" ng-if="det.VGB_SVIA_SUPPID==stat.VGB_SVIA_SUPPID">
					
					<td colspan=3 class="text-right">
						<span class="text-primary small" ng-if="det.VGB_SVIA_DEFAULT=='1'">(default) &nbsp;</span>
						<span ng-if="det.VGB_SVIA_CUSTID!=0">
						{{det.VGB_CUST_BPNAM}}
						</span>
						<span ng-if="det.VGB_SVIA_CUSTID==0">
						-----------------
						</span>
					</td>
					<td class="text-center" >
						<span class="text-primary  ab-pointer" ng-click="editVgb_svia(det.idVGB_SVIA,det);">Edit</span>
					</td>	

				</tr>
				<tr>
					<td style="font-size:2pt;">&nbsp;</td>
				</tr>			
			</table>
		</div>	
		<div class="ab-wrapper-div {{optionView==1?'':'hidden'}}">
			<table class="table-striped" style="width:100%;" 
			ng-if="stat.VGB_SVIA_CUSTID!=0"
			ng-repeat="stat in vgb_cust_stats | AB_Sorted:'VGB_CUST_BPNAM' ">
				<tr>
					<td style="width:10%;">
					</td>
					<td style="width:60%;">
					</td>	
					<td style="width:15%;">
					</td>	
					
					<td style="width:15%;">
					</td>	
				</tr>
				<tr>
					<td colspan=2 class="ab-strong" >
						<span class="text-primary ab-pointer"   ng-click="detCustomerDetail(stat.VGB_SVIA_CUSTID);" >
							<span class="caret"></span>&nbsp;
							{{stat.VGB_CUST_BPNAM }}
						</span>
					</td>
					<td>
					(<span class="ab-strong">{{stat.recCountCust}}</span>)
					</td>
					<td>
						<span class="text-primary ab-pointer" ng-click="editVgb_svia(0,stat);">Add</span>
					</td>	
				</tr>
				<tr ng-repeat="det in vgb_cust_svia" ng-if="det.VGB_SVIA_CUSTID==stat.VGB_SVIA_CUSTID">
					
					<td colspan=3 class="text-right">
						<span class="text-primary small" ng-if="det.VGB_SVIA_DEFAULT=='1'">(default) &nbsp;</span>
						{{det.VGB_SUPP_BPNAM}}
					</td>
					<td class="text-center" >
						<span class="text-primary  ab-pointer" ng-click="editVgb_svia(det.idVGB_SVIA,det);">Edit</span>
					</td>	

				</tr>
				<tr>
					<td style="font-size:2pt;">&nbsp;</td>
				</tr>			
			</table>
		</div>	

		</div>	
		<div class="col-lg-8 ab-spaceless " style="margin-top:20px;" >
		<div class="well">

				<table class=" table ab-borderless" style="width:100%;" >
					<tr >
						<td style="width:10%;vertical-align:top;">
							
						</td>
						<td style="width:30%;vertical-align:top;">
							<input class="hidden" ng-model="idVGB_SVIA" />
						</td>
						<td style="width:70%;vertical-align:top;" rowspan=20 > 
							<?php echo $supplierLister; ?>
							<?php echo $customerLister; ?>
						</td>
					</tr>
					<tr >
						<td class="text-right small ab-strong"  >
							<span class="{{idVGB_SVIA<1?'':'hidden'}}">
								<span class="text-primary ab-pointer" onclick='$("#vgb_suppView").toggleClass("hidden");$("#vgb_custView").addClass("hidden");' >
									<span class="glyphicon glyphicon-search"></span>
									<span ab-label="VGB_SVIACT_SUPP" ></span>
								</span>
							</span>
							<span class="{{idVGB_SVIA>0?'':'hidden'}}">
								<span class="text-primary"  >
									<span ab-label="VGB_PARTNERS_vgb_supp" ></span>
								</span>
							</span>
								
							<input class="hidden" ng-model="VGB_SVIA_SUPPID" />
							&nbsp;:
						</td>
						<td class="ab-strong" style="white-space:nowrap;">
							<span ng-repeat="partsupp in vgb_bpar_data | AB_noDoubles:'idVGB_SUPP' " 
							ng-if="VGB_SVIA_SUPPID>0&&partsupp.idVGB_SUPP==VGB_SVIA_SUPPID" >
							{{partsupp.VGB_BPAR_BPART}}&nbsp;&nbsp;-&nbsp;{{partsupp.VGB_SUPP_BPNAM}}
							</span>
						</td>
					</tr>
					<tr >
						<td class="text-right small ab-strong" >
							<span class="{{idVGB_SVIA<1?'':'hidden'}}">
								<span class="text-primary ab-pointer" onclick='$("#vgb_custView").toggleClass("hidden");$("#vgb_suppView").addClass("hidden");' >
									<span class="glyphicon glyphicon-search"></span>
									<span ab-label="VGB_PARTNERS_vgb_cust" ></span>
								</span>
							</span>	
							<span class="{{idVGB_SVIA>0?'':'hidden'}}">
								<span class="text-primary"  >
									<span ab-label="VGB_PARTNERS_vgb_cust" ></span>
								</span>
							</span>							
							<input class="hidden" ng-model="VGB_SVIA_CUSTID" />
							&nbsp;:
						</td>
						<td class="ab-strong" style="white-space:nowrap;" >
							
							<span ng-repeat="partcust in vgb_bpar_data | AB_noDoubles:'idVGB_CUST' "
							 ng-if="VGB_SVIA_CUSTID>0&&partcust.idVGB_CUST==VGB_SVIA_CUSTID" >
							{{partcust.VGB_BPAR_BPART}}&nbsp;&nbsp;-&nbsp;{{partcust.VGB_CUST_BPNAM}}
							&nbsp;&nbsp;
						</td>
					</tr>
					<tr>
						<td class="text-right small ab-strong" >
							<span class="text-primary" ab-label="STD_DESCR" ></span>&nbsp;:
						</td>
						<td  class="ab-strong" >
							<input ng-model="VGB_SVIA_DESCR" />
						</td>
					</tr>
					<tr>
						<td class="text-right small ab-strong" >
							<span class="text-primary" ab-label="STD_ACCOUNT_NO" ></span>&nbsp;:
						</td>
						<td  class="ab-strong" >
							<input ng-model="VGB_SVIA_ACCNO" />

						</td>
					</tr>
					<tr>
						<td class="text-right small ab-strong" >
						<span class="text-primary" ab-label="STD_DEFAULT" ></span>&nbsp;;
						</td>
						<td  class="ab-strong" >
							<?php
							$hardCode = $xtmp->setYesNoField("VGB_SVIA_DEFAULT");
							echo $hardCode;
							?>
						</td>
					</tr>
					<tr>
						<td class="text-right small ab-strong" >
							<span class="text-primary" ab-label="VSL_ORHE_ORVIA" ></span>
							<span class="text-primary" ab-label="STD_TEXT" ></span>&nbsp;;
						</td>
						<td  class="ab-strong" >
							<input ng-model="VGB_SVIA_VIATXT" />	
						</td>
					</tr>
				</table>				
			<form id="mainForm" name="mainForm"   ab-view="vgb_svia" ab-main="vgb_svia" ab-context="1" >
				<input  class="hidden" ab-btrigger="vgb_svia" ng-model="idVGB_SVIA"   /> 
			</form>				
		</div>
		</div>
		<div class="col-lg-2 ab-spaceless" >
		
		</div>
	</div>
	