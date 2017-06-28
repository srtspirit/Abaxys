<div class="hidden">
<?php 
session_start();
ob_clean();
?>
</div>
​<div class="hidden">
<!-- require_once "../appCscript/VIT_ISSUES.php"; --> 
​
<?php 
require_once "../stdSscript/stdAppobjGen.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
require_once "../appCscript/HIS_REPORTS.php";


$locParm = array();
$locParm["searchTable"] = "vin_item";
$locParm["searchJoin"] = "vin_lshe:VIN_LSHE_SOLDO='0' AND VIN_LSHE_ITMID = idVIN_ITEM";
$locParm["searchJoin"] .= ",vin_ssit:VIN_SSIT_ITMID = VIN_LSHE_ITMID";
$locParm["searchJoin"] .= ",vin_ssma:idVIN_SSMA = VIN_SSIT_SPESQ ";
$locParm["searchJoin"] .= ",vin_sslt:VIN_SSLT_ITMID = VIN_LSHE_ITMID AND VIN_SSLT_LOTID = idVIN_LSHE";



$tFnc = new AB_querySession;
$dtaObj = array();$dtaObj['PROCESS'] = "HIS_REPORTS";$dtaObj['SESSION'] = "ORHE_HIST_VSL";
$VSLApp = $tFnc->hasPriviledge($dtaObj,"vsl_orhe","View");
$dtaObj = array();$dtaObj['PROCESS'] = "HIS_REPORTS";$dtaObj['SESSION'] = "ORHE_HIST_VPU";
$VPUApp = $tFnc->hasPriviledge($dtaObj,"vpu_orhe","View");

?>



​
</div>
<style>


.ACdropdown {
    display: none;
}

.ACdropdown-content {

    display: block;
    position: absolute;
    min-width:250px;
    background-color:white;
    color:black;
    
    box-shadow: 8px 8px 8px 8px rgba(0,0,0,0.2);

    z-index:1;
}


</style>


<script>
	
	function closeFlt()
	{
		$("[id^='flt']").addClass("ACdropdown")
	}

</script>  


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
	ng-click="selectRec(acc,'custFilter');" 
	
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

<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VIN_ITEM_ITMID_ABR";
$sparm["searchTable"] = "vin_item";
$sparm["searchJoin"] = "vin_ityp:idVIN_ITYP = VIN_ITEM_SEAR1 ";
$sparm["searchJoin"] .= ",vin_grou:idVIN_GROU = VIN_ITEM_ITGRP";
$sparm["orderBy"] = "VIN_ITEM_ITMID ASC";

$sparm["searchResult"] = "vin_itemList";
$sparm["searchFilter"] = "ab-spaceless";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VIN_ITEM_ITMID,VIN_ITEM_LOTCT,VIN_ITEM_INVIT,VIN_ITYP_ITYPE,VIN_GROU_ITGRP";
$sparm["callBack"] = "";

$itemSearch = $xtmp->setSearchMaster($sparm);

$itemLister = <<<EOC
<div id="vsl_itemView" class=" ab-container ab-border " >
<div class="ab-wrapper-div">
<table class="ab-border ab-spaceless" style="width:100%;" >
<tr class="well text-primary ab-strong">
<td style="width:5%;" ></td>
<td style="width:65%;white-space:nowrap;" >{$itemSearch}</td>
<td style="width:5%;" ></td>
<td style="width:10%;" ><span class="btn btn-success btn-md ab-spaceless ab-pointer ab-strong" ng-click="selectRec(0,'itemFilter');">
&nbsp;<span ab-label="STD_CLR_ALL">Clear</span>&nbsp;
</span></td>
<td style="width:10%;" ><span class="btn btn-success btn-md ab-spaceless ab-pointer ab-strong" ng-click="selectRecAll('itemFilter','vin_itemList','idVIN_ITEM');">
&nbsp;<span ab-label="STD_SEL_ALL">All</span>&nbsp;
</span></td>
<td style="width:5%;" ></td>
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
<td style="width:25%;" >Item Id</td>
<td style="width:2%;" ></td>
<td style="width:4%;" ></td>
<td style="width:40%;" >Description</td>
<td style="width:14%;" >Type</td>
<td style="width:12%;" >Group</td>
<td style="width:2%;" ></td>

</tr>
<tr 	class="ab-pointer"
	ng-repeat="acc in vin_itemList | AB_noDoubles:'idVIN_ITEM' " 
	ng-click="selectRec(acc,'itemFilter');" 
	
	onmouseover="$(this).addClass('text-primary ab-strong')"
	onmouseout="$(this).removeClass('text-primary ab-strong')"
	>
<td>&nbsp;</td>	
<td>{{acc.VIN_ITEM_ITMID}}</td>
<td>&nbsp;</td>
<td>
<span class="{{isRecSelected(acc.idVIN_ITEM,'itemFilter')?'':'invisible'}}" >
	<span class="glyphicon glyphicon-ok" title=""></span>
</span>
</td>
<td >{{acc.VIN_ITEM_DESC1}}</td>
<td>{{acc.VIN_ITYP_ITYPE}}</td>
<td>{{acc.VIN_GROU_ITGRP}}</td>
</tr>
</table>
</div>

</div>


EOC;


?>



<div class="hidden" id="dtaSelect" >
<table style="width:100%;">
<tr>
<td style="width:10%;"></td>
<td>
	<div class="well ab-spaceless ab-pointer {{<?php echo $VSLApp; ?>==1?'':'hidden'}}" ng-init="OrheFormPg=0;ABsearchTbl='vsl_history' " 
		ng-click="OrheFormPg=0;ABsearchTbl='vsl_history'" 
		onclick="$('.OrheFormPg1').addClass('hidden');$('.OrheFormPg0').removeClass('hidden');" >
		
		<span class=" {{OrheFormPg==0?'text-primary ab-strong':''}}" >
			<span class="glyphicon glyphicon-ok {{OrheFormPg==0?'text-primary':'invisible'}}" ></span>
			&nbsp;
			Sales 
			</span>
		</span>
	</div>
</td>
<td>	
	<div class="well ab-spaceless ab-pointer {{<?php echo $VPUApp; ?>==1?'':'hidden'}}" 
		ng-click="OrheFormPg=1;ABsearchTbl='vpu_history'" 
		<?php 
		if ($VSLApp!=1){echo 'ng-init="OrheFormPg=1;ABsearchTbl=' . "'vpu_history'" .' " ';}
		?>
		onclick="$('.OrheFormPg0').addClass('hidden');
		$('.OrheFormPg1').removeClass('hidden');" >
		
		<span class=" {{OrheFormPg==1?'text-primary ab-strong':''}}" >
			<span class="glyphicon glyphicon-ok {{OrheFormPg==1?'text-primary':'invisible'}}" ></span>
			&nbsp;Purchase
		</span>




	</div>
</td>
<td >	
	<div class="well ab-spaceless ab-pointer {{<?php echo $VPUApp; ?>==1?'':'hidden'}}" 
		ng-click="OrheFormPg=2;ABsearchTbl='vpu_history';" 
		<?php 
		if ($VSLApp!=1){echo 'ng-init="OrheFormPg=1;ABsearchTbl=' . "'vpu_history'" .' " ';}
		?>
		onclick="$('.OrheFormPg0').addClass('hidden');
		$('.OrheFormPg1').removeClass('hidden');" >
		
		<span class=" {{OrheFormPg==2?'text-primary ab-strong':''}}" >
			<span class="glyphicon glyphicon-ok {{OrheFormPg==2?'text-primary':'invisible'}}" ></span>
			&nbsp;Sales MTD-YTD
		</span>




	</div>
</td>
</tr>
</table>
</div>


<div class="col-lg-12 ab-spaceless">
    <?php require_once "../stdCscript/stdFormButtons.php"; ?>
    <script>
        $('#ab-buttonPad').html($("#dtaSelect").html());
        $('#ab-new').html('');
    </script>
    
</div>






<div class="row " ng-init="SESSION_DESCR='History Details';" >

<div class="col-sm-12 {{OrheFormPg==0?'':'hidden'}}" >   
<div style="font-size:4pt;">&nbsp;</div>
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VSL_ORDERS_vsl_orhe";
$sparm["searchTable"] = "vsl_orhe";

$sparm["searchJoin"] = "vgb_cust:idVGB_CUST = VSL_ORHE_BTCUS";
$sparm["searchJoin"] .= ",vgb_bpar:idVGB_BPAR = VGB_CUST_BPART";
$sparm["searchJoin"] .= ",vgb_addr:idVGB_ADDR = VSL_ORHE_BTADD OR idVGB_ADDR = VSL_ORHE_STADD";
$sparm["searchJoin"] .= ",vsl_orde:idVSL_ORHE = VSL_ORDE_ORNUM";
$sparm["searchJoin"] .= ",vsl_orst:idVSL_ORDE = VSL_ORST_ORLIN";
$sparm["searchJoin"] .= ",vsl_lstr:idVSL_ORST = VSL_LSTR_STPSQ";
$sparm["searchJoin"] .= ",vin_lshe:idVIN_LSHE = VSL_LSTR_LOTSQ";
$sparm["searchJoin"] .= ",vin_item:idVIN_ITEM = VSL_ORDE_ITMID";


$sparm["orderBy"] = "VSL_ORHE_CDATE DESC, VSL_ORDE_ORLIN ASC, VSL_ORST_STPSQ ASC ";

$sparm["searchResult"] = "vsl_history";
$sparm["searchFilter"] = "ab-spaceless";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VGB_BPAR_BPART,VIN_ITEM_ITMID,VSL_ORST_STEPS,VIN_LSHE_LOTID";
$sparm["callBack"] = "$"."scope.execVSLQuery();";

$hardCode = $xtmp->setSearchMaster($sparm);
if ($VSLApp==1)
{
	echo $hardCode;
}

?>
<div style="font-size:4pt;">&nbsp;</div>
</div>

<div class="col-sm-12 {{OrheFormPg==1?'':'hidden'}}">   
<div style="font-size:4pt;">&nbsp;</div>
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VPU_ORDERS_vpu_orhe";
$sparm["searchTable"] = "vpu_orhe";

$sparm["searchJoin"] = "vgb_supp:idVGB_SUPP = VPU_ORHE_BTCUS";
$sparm["searchJoin"] .= ",vgb_bpar:idVGB_BPAR = VGB_SUPP_BPART";
$sparm["searchJoin"] .= ",vgb_addr:idVGB_ADDR = VPU_ORHE_BTADD OR idVGB_ADDR = VPU_ORHE_STADD";
$sparm["searchJoin"] .= ",vpu_orde:idVPU_ORHE = VPU_ORDE_ORNUM";
$sparm["searchJoin"] .= ",vpu_orst:idVPU_ORDE = VPU_ORST_ORLIN";
$sparm["searchJoin"] .= ",vpu_lstr:idVPU_ORST = VPU_LSTR_STPSQ";
$sparm["searchJoin"] .= ",vin_lshe:idVIN_LSHE = VPU_LSTR_LOTSQ";
$sparm["searchJoin"] .= ",vin_item:idVIN_ITEM = VPU_ORDE_ITMID";

$sparm["orderBy"] = "VPU_ORHE_CDATE DESC, VPU_ORDE_ORLIN ASC, VPU_ORST_STPSQ ASC ";

$sparm["searchResult"] = "vpu_history";
$sparm["searchFilter"] = "ab-spaceless";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VGB_BPAR_BPART,VIN_ITEM_ITMID,VPU_ORST_STEPS,VIN_LSHE_LOTID";
$sparm["callBack"] = "$"."scope.execVPUQuery();";
$hardCode = $xtmp->setSearchMaster($sparm);
if ($VPUApp==1)
{
	echo $hardCode;
}
?>
<div style="font-size:4pt;">&nbsp;</div>
</div>

<div class="col-sm-12 {{OrheFormPg==2?'':'hidden'}} ">   

<div ab-report-title="MTD_History" >
<div ab-rpt-tbl="font-size:10pt;" >
	<table class="" ab-rpt-row="detail" >
		<tr><td style="font-size:4pt;">&nbsp;</td></tr>
		<tr>
			<td colspan=2>
			<input class="hidden" ng-model="yearSelected" />
			<input class="hidden" ng-model="monthSelected" />
			</td>
			<td>
				
			</td>
			<td>
			</td>
			<td>
				
			</td>
		</tr>	
		<tr>
			<td>
			&nbsp;&nbsp;&nbsp;
			</td>
			<td  class="ab-border well ab-spaceless">
				&nbsp;
				<span class="ab-pointer text-primary ab-strong" onclick='$("#openCustSelection").click();'>
					
					<span ab-rpt-col="" >
					Customers
					(
					<span class="{{custFilter.length==0?'':'hidden'}}" ab-label="STD_ALL">tous</span>
					<span class="{{custFilter.length>0?'':'hidden'}}" >{{custFilter.length}}</span>
					)
					</span>
					<span class="caret"></span>
				</span>			
				&nbsp;
			</td>			
			<td>
			&nbsp;&nbsp;&nbsp;
			</td>
			<td  class="ab-border well ab-spaceless">
				&nbsp;
				<span class="ab-pointer text-primary ab-strong" onclick='$("#openItemSelection").click();'>
					<span ab-rpt-col="" >
					Items
					(
					<span class="{{itemFilter.length==0?'':'hidden'}}" ab-label="STD_ALL">tous</span>
					<span class="{{itemFilter.length>0?'':'hidden'}}" >{{itemFilter.length}}</span>
					)
					</span>
					<span class="caret"></span>
				</span>	
				&nbsp;		
			</td>			
			<td>
			&nbsp;&nbsp;&nbsp;
			</td>
			<td class="ab-border well ab-spaceless">
				<table >
					<tr>
						<td>
							<span class="text-primary ab-strong" ab-label="STD_SELECT" ></span>
							<span class="text-primary ab-strong" ab-label="STD_YEAR" ></span>
							&nbsp;&nbsp;
						</td>
						<td ng-if="OrheFormPg==2">
							<ul class="nav  ab-spaceless " role="tablist">
								<li class="dropdown ab-spaceless"  >
									<span data-toggle="dropdown" class="ab-strong ab-pointer" 
									ng-repeat="date in rptYear " 
									ng-if="date.YEAR == yearSelected">
									
										<span ab-rpt-col="" class="ab-hidden" >
											<span class="ab-strong" ab-label="STD_YEAR" ></span>:
										</span>
										<span ab-rpt-col="" >
											{{date.YEAR}}
										</span>	
										<span class="caret"></span>
									</span>
									<ul class="dropdown-menu ab-spaceless" ab-flst="" role="menu">
										<li ng-repeat="fDta in rptYear  "  >
											<span class="text-primary ab-pointer" ng-click="setPeriod('YEAR',fDta.YEAR);">
												&nbsp;&nbsp;{{fDta.YEAR}}
											</span>
										</li>
									</ul>
								</li>
							</ul>
						</td>
						<td>&nbsp;<span ab-rpt-col=""></span></td>
					</tr>
				</table>
			</td>
			<td >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td  class="ab-border well ab-spaceless" >
				<table >
					<tr>
						<td>
							&nbsp;
							<span class="text-primary ab-strong" ab-label="STD_SELECT" ></span>
							<span class="text-primary ab-strong" ab-label="STD_MONTH" ></span>
							&nbsp;&nbsp;
						</td>
						<td ng-if="OrheFormPg==2">
							<ul class="nav  ab-spaceless " role="tablist">
								<li class="dropdown ab-spaceless"  >
									<span data-toggle="dropdown" class="ab-strong ab-pointer" 
									ng-repeat="date in rptMonth" 
									ng-if="date.MONTH == monthSelected">
										<span ab-rpt-col="" class="ab-hidden" >									
											<span class="text-primary ab-strong" ab-label="STD_MONTH" ></span>:
										</span>
										<span ab-rpt-col="">
										{{date.DESCR}}
										</span>
										<span class="caret"></span>
									</span>
									<ul class="dropdown-menu ab-spaceless" ab-flst="" role="menu">
										<li ng-repeat="fDta in rptMonth"  >
											<span class="text-primary ab-pointer" ng-click="setPeriod('MONTH',fDta.MONTH);">
												&nbsp;&nbsp;{{fDta.DESCR}}
											</span>
										</li>
									</ul>
								</li>
							</ul>
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>

			<td>
				<span  >&nbsp;&nbsp;&nbsp;</span>
				<span abb-report-hide="MTD_History" class="btn btn-success btn-md ab-spaceless" ab-label="STD_SUBMIT" ng-click="salesMTD_YTD();" >GO</span>
			</td>			
		</tr>
		<tr><td style="font-size:4pt;">&nbsp;</td></tr>
	</table>
</div>
</div>

</div>
<div class="col-sm-12 hidden"	abb-report-foot="MTD_History" >


	<table><tr><td><span class="ab-border ab-strong" ab-label="STD_LEGEND"></span></td></tr></table>
	<table >
		
		<tr>
			
			<td style="vertical-align:top;">
				<table class="ab-border" >
					<tr>
						<td>
							<span class="text-primary ab-strong" ab-label="STD_SELECTED" ></span>
							<span class="text-primary ab-strong" ab-label="STD_YEAR" ></span>
							&nbsp;&nbsp;
						</td>
						<td>
							<span  class="ab-strong ab-pointer" 
							ng-repeat="date in rptYear " 
							ng-if="date.YEAR == currentYearSelected">
								{{date.YEAR}}
							</span>
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>	
			<td style="vertical-align:top;">

				<table  class="ab-border" >
					<tr>
						<td>
							&nbsp;
							<span class="text-primary ab-strong" ab-label="STD_SELECTED" ></span>
							<span class="text-primary ab-strong" ab-label="STD_MONTH" ></span>
							&nbsp;&nbsp;
						</td>
						<td >
							<span class="ab-strong ab-pointer" 
							ng-repeat="date in rptMonth" 
							ng-if="date.MONTH == currentMonthSelected">
								{{date.DESCR}}
							</span>
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>		
	</table>

	<table style="width:100%;" >
		<tr>
			<td style="width:45%;vertical-align:top;" ng-if="currentCustFilter.length>0">
				<table style="width:100%;" >
				<tr><td>&nbsp;</td></tr>
				<tr class="ab-border" >
					<td>&nbsp;</td>	
					<td colspan=3 class="ab-strong ab-underline" >
						<span class="text-primary ab-strong" ab-label="VGB_PARTNERS_vgb_cust" ></span>
						<span class="text-primary ab-strong" ab-label="STD_SELECTED" ></span>
					</td>
				</tr>
				<tr 	class="ab-pointer"
					ng-repeat="acc in vgb_custList | AB_noDoubles:'idVGB_CUST' " 
					ng-if=" isRecSelected(acc.idVGB_CUST,'currentCustFilter')"
					>
					<td>&nbsp;</td>	
					<td>{{acc.VGB_BPAR_BPART}}&nbsp;({{acc.VGB_CURR_CURID}})</td>
					<td>&nbsp;</td>
					<td >{{acc.VGB_CUST_BPNAM}}</td>
				</tr>
				</table>
			</td>	
			<td style="width:10%;vertical-align:top;"  ng-if="currentCustFilter.length>0">
			</td>

			<td style="width:45%;vertical-align:top;" ng-if="currentItemFilter.length>0">
				<table style="width:100%;" >
				<tr><td>&nbsp;</td></tr>
				<tr  class="ab-border" >
					<td>&nbsp;</td>	
					<td colspan=3 class="ab-strong ab-underline" >
						<span class="text-primary ab-strong" ab-label="VIN_ITEMS_vin_item" ></span>
						<span class="text-primary ab-strong" ab-label="STD_SELECTED" ></span>
					</td>
				</tr>
				<tr 	class="ab-pointer"
					ng-repeat="acc in vin_itemList | AB_noDoubles:'idVIN_ITEM' " 
					ng-if="isRecSelected(acc.idVIN_ITEM,'currentItemFilter')"
					>
						<td>&nbsp;</td>	
						<td>{{acc.VIN_ITEM_ITMID}}</td>
						<td>&nbsp;</td>
						<td >{{acc.VIN_ITEM_DESC1}}</td>
				</tr>		
				</table>
			</td>
		</tr>		
	</table>

</div>	

<div class="col-sm-12">   
   <form id="mainForm" name="mainForm"   ab-view="vsl_orhe" ab-main="vsl_orhe"  >
<?php
  $xtmp = new appForm("ORHE_HISTORY"); 

$vin_sales = <<<EOC


<div >
	<table style="width:100%;">
	<tr>
		<td style="width:40%;"></td>
		<td style="width:30%;"></td>
		<td style="width:30%;"></td>
	</tr>
	<tr ng-repeat="main in rawResult.VSL_DETAIL | AB_noDoubles:'idVIN_ITEM' | AB_Sorted:'VIN_ITEM_ITMID' " 
		ng-if="main.idVIN_ITEM==sales.idVIN_ITEM" >
		<td style="vertical-align:top;" >
			<div>
				<table style="width:100%;" >
					<tr class="ab-strong" >
					<td >
					<span ab-label="VIN_ITEM_ITMID" class="text-primary ab-strong">Item</span>
					</td>
					<td>
					{{main.VIN_ITEM_ITMID}}	
					</td>
					<td class="small" >
					{{main.VIN_ITEM_DESC1}}
					</td>
					</tr>
				</table>
				<table style="width:100%;" >
					<tr>
					<td>
					<span ab-label="VIN_ITEM_PINFO" class="text-primary ab-strong">Pack</span>
					{{main.VIN_ITEM_PINFO}}	
					</td>
					<td ng-repeat="mainunit in rawResult.vin_units" ng-if="main.VIN_ITEM_UNITM == mainunit.idVIN_UNIT">
					<span ab-label="VIN_ITEM_UNITM1" class="text-primary ab-strong">U/M</span>
					{{mainunit.VIN_UNIT_DESCR}}	
					</td>	
					<td ng-if="main.VIN_ITEM_LOTCT==1">
					<span ab-label="VIN_ITEM_DOMOS1" class="text-primary ab-strong">Method</span>
					{{main.VIN_ITEM_DOMOS}}	
					</td>
					<td>
					<span ab-label="VIN_ITEM_SHLIF1" class="text-primary ab-strong">Life</span>
					{{main.VIN_ITEM_SHLIF}}	
					</td>	
					</tr>
				</table>
			</div>
			<div style="width:95%;" class="ab-border ab-spaceless" ></div>
			<div class="{{main.VIN_ITEM_INVIT=='0'?'':'hidden'}} text-center">
				<span ab-label="STD_SERVICE_ITEM" class="ab-strong"> Service </span>
			</div>
			<div class="{{main.VIN_ITEM_INVIT=='1'?'':'hidden'}}">
				<table  style="width:100%;">
					<tr class="small text-primary ab-strong">
					<td>
					<span ab-label=""  class="text-primary ab-strong">Warehouse</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">Location</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">U/M</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">On Hand</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">Allo.</span>	
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">ON PO</span>
					</td>
					
					
					</tr>
					<tr ng-repeat="inve in rawResult.VSL_DETAIL_INV | AB_noDoubles:'idVIN_INVE'" ng-if="main.idVIN_ITEM == inve.idVIN_ITEM">
					
					<td title="{{invewar.VIN_WARS_DESCR}}" ng-repeat="invewar in rawResult.vin_warss" ng-if="inve.VIN_INVE_WARID == invewar.idVIN_WARS">
					{{invewar.VIN_WARS_WARID}}	
					</td>
					<td title="{{inveloc.VIN_LOCS_DESCR}}"  ng-repeat="inveloc in rawResult.vin_locss" ng-if="inve.VIN_INVE_LOCID == inveloc.idVIN_LOCS">
					{{inveloc.VIN_LOCS_LOCID}}
					</td>
					<td ng-repeat="inveunit in rawResult.vin_units" ng-if="inve.VIN_INVE_UNITM == inveunit.idVIN_UNIT">
					{{inveunit.VIN_UNIT_DESCR}}	
					</td>
					<td>
					{{inve.VIN_INVE_BOHQT}}
					</td>
					<td>
					{{inve.VIN_INVE_ALOQT}}
					</td>
					<td>
					{{inve.VIN_INVE_PURQT}}	
					</td>
					</tr>
				</table>
			</div>
			<div style="width:95%;" class="ab-border ab-spaceless" ></div>
			<div >
				<table  style="width:100%;">
					<tr class="small text-primary ab-strong">
					<td>
					<span ab-label=""  class="text-primary ab-strong">Supplier</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">Name</span>
					</td>
					
					</tr>
					<tr ng-repeat="inve in rawResult.VSL_DETAIL_INV | AB_noDoubles:'idVIN_SUPP'" 
						ng-if="main.idVIN_ITEM == inve.VIN_SUPP_ITMID">
					<td>
					{{inve.VGB_BPAR_BPART}}	
					</td>
					<td>
					{{inve.VGB_SUPP_BPNAM}}
					</td>
					</tr>
				</table>
			</div>
			<div style="width:95%;" class="ab-border ab-spaceless" ></div>
			<div class="{{OrheFormPg==0?'':'hidden'}}" >
				<table  style="width:100%;">
					<tr class="small ab-strong">
					<td>
					<span ab-label=""  class="text-primary ab-strong">Last Price paid</span>
					</td>
					<td>
						<span ab-label="" class="text-primary ab-strong">Quote</span>
						<span ng-repeat="inve in rawResult.VSL_DETAIL_INV | AB_noDoubles:'idVIN_CUST'" 
						ng-if="inve.VIN_CUST_EXPYN=='1' && main.idVIN_ITEM == inve.VIN_CUST_ITMID && inve.VIN_CUST_BPART==sales.idVGB_CUST">
						<span class="text-primary ab-strong">Expires</span>
						{{inve.VIN_CUST_EXPIR}}
						</span>					
					
					</td>
					
					</tr>
					<tr ng-repeat="inve in rawResult.VSL_DETAIL_INV | AB_noDoubles:'idVIN_CUST'" 
					ng-if="main.idVIN_ITEM == inve.VIN_CUST_ITMID && inve.VIN_CUST_BPART==sales.idVGB_CUST">
					
					<td >
					$ {{inve.VIN_CUST_LPPAID}}&nbsp;&nbsp;({{inve.VIN_CUST_LPDATE}})
					</td>
					<td >
						<span class="{{ABisEmpty(inve.VIN_CUST_QUONU)?'':'hidden'}}">
							No quote 
						</span>
						<span class="{{ABisEmpty(inve.VIN_CUST_QUONU)?'hidden':''}}">
							<span class="text-primary">Price:</span>
							$ {{inve.VIN_CUST_SELLP}}&nbsp;<span class="text-primary">Q#:</span>{{inve.VIN_CUST_QUONU}}
							<span class="{{inve.VIN_CUST_ACTYP!='SUPP'?'hidden':''}}">
							<span class="text-primary">Supplier:</span>
								<span ng-repeat="suppQ in rawResult.VSL_DETAIL_INV | AB_noDoubles:'idVGB_SUPP'"
								ng-if="suppQ.idVGB_SUPP == inve.VIN_CUST_SUPPL" >
								{{suppQ.VGB_SUPP_BPNAM}}
								</span>
							</span>
						</span>
					</td>
					</tr>
				</table>
			</div>			
						
		</td>
		<td style="vertical-align:top;" >
			
			<div ng-if="main.VIN_ITEM_LOTCT>0">
				<table  style="width:100%;" >
					<tr class="small text-primary ab-strong">
						<td style="width:35%;">
							<span ab-label="" class="text-primary ab-strong">LotId</span>
						</td>
						<td style="width:25%;">
							<span ab-label="" class="text-primary ab-strong">{{main.VIN_ITEM_DOMOS}}</span>
							<span ab-label="" class="text-primary ab-strong">Ends</span>
						</td>
						<!--
						<td style="width:20%;">
							<span ab-label="" class="text-primary ab-strong">Shelf</span>
						</td>
						-->
						<td style="width:40%;">
							<table style="width:100%;">
								<tr>
									<td style="width:33%;">
									Hand
									</td>	
									<td style="width:33%;">
									Allo
									</td>	
									<td style="width:34%;">
									Purc
									</td>	
								</tr>
							</table>
						</td>
						

					</tr>
					<tr>
						<td colspan=100>
						<div style="width:95%;" class="ab-border ab-spaceless" ></div>
						</td>
					</tr>
					<tr class="small" ng-repeat="Lots in rawResult.VSL_DETAIL | AB_noDoubles:'idVIN_LSHE'" 
						ng-if="main.idVIN_ITEM == Lots.idVIN_ITEM">
						<td>
						{{Lots.VIN_LSHE_LOTID}}<span ng-if="Lots.VIN_LSHE_SERNO!='0'"> - {{Lots.VIN_LSHE_SERNO}} </span>
						</td>
						<!--
						<td>
						{{Lots.VIN_LSHE_DOMDA}}
						</td>
						-->
						<td>
						{{Lots.VIN_LSHE_DATES}}
						</td>
						
						<td>
							<table style="width:100%;">
								<tr>
									<td style="width:33%">
									</td>	
									<td style="width:33%">
									</td>	
									<td style="width:34%">
									</td>	
								</tr>
								<tr ng-repeat="lotQty in VSL_DETAIL_INV |  AB_noDoubles:'VIN_LSLQ_LOTSQ'"
									ng-if="lotQty.VIN_LSLQ_LOTSQ==Lots.idVIN_LSHE"
									class="ab-strong" >
									<td>
									{{lotQty.VIN_LSLQ_BOHQT}}
									</td>	
									<td>
									{{lotQty.VIN_LSLQ_ALOQT}}
									</td>	
									<td>
									{{lotQty.VIN_LSLQ_PURQT}}
									</td>	
								</tr>
							</table>
						</td>		
						
					</tr>
				</table>
			</div>
		</td>
		<td style="vertical-align:top;" >
			<div ng-if="main.VIN_ITEM_LOTCT>0">
				<table style="width:100%;">
					<tr class="small text-primary ab-strong">
						<td>
							<span ab-label="" class="text-primary ab-strong">Spec</span>
						</td>
						<td>
							<span ab-label="" class="text-primary ab-strong">DelTime</span>
						</td>
						<td>
							<span ab-label="" class="text-primary ab-strong">Shelf</span>
						</td>
					</tr>
				
					<tr>
						<td colspan=100>
							<div style="width:95%;" class="ab-border ab-spaceless" ></div>
						</td>
					</tr>
					<tr ng-repeat="Spec in rawResult.VSL_DETAIL | AB_noDoubles:'idVIN_SSMA'" 
						ng-if="main.idVIN_ITEM == Spec.idVIN_ITEM">
						<td title="{{Spec.VIN_SSMA_DESCR}}">
							{{Spec.VIN_SSMA_SPEID}}	
						</td>
						<td>
							{{Spec.VIN_SSMA_SUETA}}	
						</td>
						<td>
							{{Spec.VIN_SSMA_SHLIF}}	
						</td>
					
					
					</tr>
				</table>
			</div>			
		</td>
	</tr>
	</table>
</div>


EOC;


$vin_purchases = <<<EOC


<div >
	<table style="width:100%;">
	<tr>
		<td style="width:40%;"></td>
		<td style="width:30%;"></td>
		<td style="width:30%;"></td>
	</tr>
	<tr ng-repeat="main in rawResult.VPU_DETAIL | AB_noDoubles:'idVIN_ITEM' | AB_Sorted:'VIN_ITEM_ITMID' " 
		ng-if="main.idVIN_ITEM==purchase.idVIN_ITEM" >
		<td style="vertical-align:top;" >
			<div>
				<table style="width:100%;" >
					<tr class="ab-strong" >
					<td >
					<span ab-label="VIN_ITEM_ITMID" class="text-primary ab-strong">Item</span>
					</td>
					<td>
					{{main.VIN_ITEM_ITMID}}	
					</td>
					<td class="small" >
					{{main.VIN_ITEM_DESC1}}
					</td>
					</tr>
				</table>
				<table style="width:100%;" >
					<tr>
					<td>
					<span ab-label="VIN_ITEM_PINFO" class="text-primary ab-strong">Pack</span>
					{{main.VIN_ITEM_PINFO}}	
					</td>
					<td ng-repeat="mainunit in rawResult.vin_units" ng-if="main.VIN_ITEM_UNITM == mainunit.idVIN_UNIT">
					<span ab-label="VIN_ITEM_UNITM1" class="text-primary ab-strong">U/M</span>
					{{mainunit.VIN_UNIT_DESCR}}	
					</td>	
					<td ng-if="main.VIN_ITEM_LOTCT==1">
					<span ab-label="VIN_ITEM_DOMOS1" class="text-primary ab-strong">Method</span>
					{{main.VIN_ITEM_DOMOS}}	
					</td>
					<td>
					<span ab-label="VIN_ITEM_SHLIF1" class="text-primary ab-strong">Life</span>
					{{main.VIN_ITEM_SHLIF}}	
					</td>	
					</tr>
				</table>
			</div>
			<div style="width:95%;" class="ab-border ab-spaceless" ></div>
			<div class="{{main.VIN_ITEM_INVIT=='0'?'':'hidden'}} text-center">
				<span ab-label="STD_SERVICE_ITEM" class="ab-strong"> Service </span>
			</div>
			<div class="{{main.VIN_ITEM_INVIT=='1'?'':'hidden'}}">
				<table  style="width:100%;">
					<tr class="small text-primary ab-strong">
					<td>
					<span ab-label=""  class="text-primary ab-strong">Warehouse</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">Location</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">U/M</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">On Hand</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">Allo.</span>	
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">ON PO</span>
					</td>
					
					
					</tr>
					<tr ng-repeat="inve in rawResult.VPU_DETAIL_INV | AB_noDoubles:'idVIN_INVE'" ng-if="main.idVIN_ITEM == inve.idVIN_ITEM">
					
					<td title="{{invewar.VIN_WARS_DESCR}}" ng-repeat="invewar in rawResult.vin_warss" ng-if="inve.VIN_INVE_WARID == invewar.idVIN_WARS">
					{{invewar.VIN_WARS_WARID}}	
					</td>
					<td title="{{inveloc.VIN_LOCS_DESCR}}"  ng-repeat="inveloc in rawResult.vin_locss" ng-if="inve.VIN_INVE_LOCID == inveloc.idVIN_LOCS">
					{{inveloc.VIN_LOCS_LOCID}}
					</td>
					<td ng-repeat="inveunit in rawResult.vin_units" ng-if="inve.VIN_INVE_UNITM == inveunit.idVIN_UNIT">
					{{inveunit.VIN_UNIT_DESCR}}	
					</td>
					<td>
					{{inve.VIN_INVE_BOHQT}}
					</td>
					<td>
					{{inve.VIN_INVE_ALOQT}}
					</td>
					<td>
					{{inve.VIN_INVE_PURQT}}	
					</td>
					</tr>
				</table>
			</div>
			<div style="width:95%;" class="ab-border ab-spaceless" ></div>
			<div >
				<table  style="width:100%;">
					<tr class="small text-primary ab-strong">
					<td>
					<span ab-label=""  class="text-primary ab-strong">Supplier</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">Name</span>
					</td>
					
					</tr>
					<tr ng-repeat="inve in rawResult.VPU_DETAIL_INV | AB_noDoubles:'idVIN_SUPP'" 
						ng-if="main.idVIN_ITEM == inve.VIN_SUPP_ITMID">
					
					<td>
					{{inve.VGB_BPAR_BPART}}	
					</td>
					<td>
					{{inve.VGB_SUPP_BPNAM}}
					</td>
					</tr>
				</table>
			</div>
			<div style="width:95%;" class="ab-border ab-spaceless" ></div>
			<div class="{{OrheFormPg==0?'':'hidden'}}" >
				<table  style="width:100%;">
					<tr class="small ab-strong">
					<td>
					<span ab-label=""  class="text-primary ab-strong">Last Price paid</span>
					</td>
					<td>
						<span ab-label="" class="text-primary ab-strong">Quote</span>
						<span ng-repeat="inve in rawResult.VPU_DETAIL_INV | AB_noDoubles:'idVIN_CUST'" 
						ng-if="inve.VIN_CUST_EXPYN=='1' && main.idVIN_ITEM == inve.VIN_CUST_ITMID && inve.VIN_CUST_BPART==purchase.idVGB_CUST">
						<span class="text-primary ab-strong">Expires</span>
						{{inve.VIN_CUST_EXPIR}}
						</span>					
					
					</td>
					
					</tr>
					<tr ng-repeat="inve in rawResult.VPU_DETAIL_INV | AB_noDoubles:'idVIN_CUST'" 
					ng-if="main.idVIN_ITEM == inve.VIN_CUST_ITMID && inve.VIN_CUST_BPART==purchase.idVGB_CUST">
					
					<td >
					$ {{inve.VIN_CUST_LPPAID}}&nbsp;&nbsp;({{inve.VIN_CUST_LPDATE}})
					</td>
					<td >
						<span class="{{ABisEmpty(inve.VIN_CUST_QUONU)?'':'hidden'}}">
							No quote 
						</span>
						<span class="{{ABisEmpty(inve.VIN_CUST_QUONU)?'hidden':''}}">
							<span class="text-primary">Price:</span>
							$ {{inve.VIN_CUST_SELLP}}&nbsp;<span class="text-primary">Q#:</span>{{inve.VIN_CUST_QUONU}}
							<span class="{{inve.VIN_CUST_ACTYP!='SUPP'?'hidden':''}}">
							<span class="text-primary">Supplier:</span>
								<span ng-repeat="suppQ in rawResult.VPU_DETAIL_INV | AB_noDoubles:'idVGB_SUPP'"
								ng-if="suppQ.idVGB_SUPP == inve.VIN_CUST_SUPPL" >
								{{suppQ.VGB_SUPP_BPNAM}}
								</span>
							</span>
						</span>
					</td>
					</tr>
				</table>
			</div>			
						
		</td>
		<td style="vertical-align:top;" >
			
			<div ng-if="main.VIN_ITEM_LOTCT>0">
				<table  style="width:100%;" >
					<tr class="small text-primary ab-strong">
					<td>
					<span ab-label="" class="text-primary ab-strong">LotId</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">{{main.VIN_ITEM_DOMOS}}</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">Shelf</span>
					</td>
					</tr>
					<tr><td colspan=100>
					<div style="width:95%;" class="ab-border ab-spaceless" ></div>
					</td></tr>
					
					<tr ng-repeat="Lots in rawResult.VPU_DETAIL | AB_noDoubles:'idVIN_LSHE'" ng-if="main.idVIN_ITEM == Lots.idVIN_ITEM">
					<td>
					{{Lots.VIN_LSHE_LOTID}}<span ng-if="Lots.VIN_LSHE_SERNO!='0'"> - {{Lots.VIN_LSHE_SERNO}} </span>
					</td>
					<td>
					{{Lots.VIN_LSHE_DOMDA}}
					</td>
					<td>
					{{Lots.VIN_LSHE_DATES}}	
					</td>	
					</tr>
				</table>
			</div>
		</td>
		<td style="vertical-align:top;" >
			<div ng-if="main.VIN_ITEM_LOTCT>0">
				<table style="width:100%;">
					<tr class="small text-primary ab-strong">
					<td>
					<span ab-label="" class="text-primary ab-strong">Spec</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">DelTime</span>
					</td>
					<td>
					<span ab-label="" class="text-primary ab-strong">Shelf</span>
					</td>
					</tr>
					
					<tr><td colspan=100>
					<div style="width:95%;" class="ab-border ab-spaceless" ></div>
					</td></tr>
					
					
					
					<tr ng-repeat="Spec in rawResult.VPU_DETAIL | AB_noDoubles:'idVIN_SSMA'" ng-if="main.idVIN_ITEM == Spec.idVIN_ITEM">
					<td title="{{Spec.VIN_SSMA_DESCR}}">
					{{Spec.VIN_SSMA_SPEID}}	
					</td>
					<td>
					{{Spec.VIN_SSMA_SUETA}}	
					</td>
					<td>
					{{Spec.VIN_SSMA_SHLIF}}	
					</td>
					
					
					</tr>
				</table>
			</div>			
		</td>
	</tr>
	</table>
</div>


EOC;



?>



<div class="col-sm-12 {{OrheFormPg==0?'':'hidden'}}" ab-report="Sales_History" ab-report-off="{{OrheFormPg==0?'':'1'}}" >


<div class="hidden" ab-report-title="Sales_History" >
<div ab-rpt-tbl="width:100%;font-size:20pt;">
<div ab-rpt-row="header">
<div ab-rpt-col="width:100%;">
Sales History 
</div>
</div>
</div>
</div>


<div class="hidden" ab-report-foot="Sales_History" >
	<div ab-rpt-tbl="width:100%;font-size:10pt;" >
		<div ab-rpt-row="header">
			<div ab-rpt-col="width:5%;">
				Legend: 
			</div>
			<div ab-rpt-col="width:15%;">
				Type 
			</div>
			<div ab-rpt-col="width:15%;">
				Time Stamp 
			</div>
			<div ab-rpt-col="width:15%;">
				Recset Length 
			</div>
			<div ab-rpt-col="width:50%;text-align:left;">
			Clause 
			</div>

		</div>
		<div ab-rpt-row="detail">
			<div ab-rpt-col="">
			</div>
			<div ab-rpt-col="">
				{{ABMasterInfo.vsl_history.clauseType}}
				<span ng-if="ABMasterInfo.vsl_history.clauseType=='LIKE'">
				 = '{{ABMasterInfo.vsl_history.searchPattern}}'
				</span>
			</div>

			<div ab-rpt-col="">
				{{ABMasterInfo.vsl_history.pdoTimeStmp}}
			</div>

			<div ab-rpt-col="">
				{{ABMasterInfo.vsl_history.rowCount}}
			</div>
			<div ab-rpt-col="font-size:8pt;" ng-if="ABMasterInfo.vsl_history.clauseType!='LIKE'" >
				<span>
					{{ABMasterInfo.vsl_history.whereClause}}
				</span>	
			</div>
							
			
		</div>
	</div>

</div>

<!-- ABMasterInfo  -->

<div ab-report-detail="Sales_History" >
<div ab-rpt-tbl="width:100%;font-size:10pt;" >
<div class="ab-wrapper-div"  >	
		

<table  class=" ab-spaceless" style="width:100%;" ng-init="sortBy='';VSLextraSort='';" >

<tr class="text-primary ab-border ab-strong" ab-rpt-row="header">
<td style="width:8%;" ab-rpt-col="width:8%;" class="ab-pointer {{VSLextraSort=='VSL_ORHE_ORNUM'?'text-danger':''}}" ng-click="localSetSortby('VSLextraSort','VSL_ORHE_ORNUM')">Order<span class="caret"></span>{{sortBy}}</td>
<td style="width:12%;" ab-rpt-col="width:12%;" class="ab-pointer {{VSLextraSort=='VGB_CUST_BPNAM'?'text-danger':''}}"  ng-click="localSetSortby('VSLextraSort','VGB_CUST_BPNAM')">Customer<span class="caret"></span></td>
<td style="width:10%;" ab-rpt-col="width:10%;" >PO#</td>
<td style="width:5%;" ab-rpt-col="width:5%;font-weight:800;" >Line</td>
<td style="width:13%;" ab-rpt-col="width:13%;font-weight:800;" class="ab-pointer {{VSLextraSort=='VIN_ITEM_ITMID'?'text-danger':''}}"  ng-click="localSetSortby('VSLextraSort','VIN_ITEM_ITMID')">Item Code<span class="caret"></span></td>
<td style="width:20%;" ab-rpt-col="width:20%;font-weight:800;" >Description</td>
<td style="width:5%;" ab-rpt-col="width:5%;font-weight:800;" >Qty</td>
<td style="width:5%;" ab-rpt-col="width:5%;font-weight:800;" >Price</td>
<td style="width:5%;" ab-rpt-col="width:5%;font-weight:800;" >Unit</td>

<td style="width:10%;" ab-rpt-col="width:10%;font-weight:800;"  class="ab-pointer {{VSLextraSort=='VSL_ORST_STEPS'?'text-danger':''}}" ng-click="localSetSortby('VSLextraSort','VSL_ORST_STEPS')">Steps<span class="caret"></span></td>
<td style="width:7%;" ab-rpt-col="width:7%;font-weight:800;" class="ab-pointer {{VSLextraSort=='VSL_ORST_PDATE'?'text-danger':''}}" ng-click="localSetSortby('VSLextraSort','VSL_ORST_PDATE')">Del Date<span class="caret"></span></td>
	
</tr>	




</table>
</div>
<div class="ab-wrapper-div"   >
<input class="hidden" id="queryVSL" value="<?php echo $locParm["searchJoin"];?>"  />
<table  class="table-striped " style="width:100%;" 
ng-repeat="sales in rawResult.vsl_history | AB_noDoubles:'idVSL_ORHE,idVSL_ORDE,idVSL_ORST'  | AB_Sorted:VSLextraSort " >
<tr class="text-primary" ab-rpt-row="detail">
<td style="width:8%;"  ab-rpt-col="width:8%;"  ></td>
<td style="width:12%;" ab-rpt-col="width:12%;" ></td>
<td style="width:10%;" ab-rpt-col="width:10%;" ></td>
<td style="width:5%;"  ab-rpt-col="width:5%;"  ></td>
<td style="width:13%;" ab-rpt-col="width:13%;" ></td>
<td style="width:20%;" ab-rpt-col="width:20%;" ></td>
<td style="width:5%;"  ab-rpt-col="width:5%;" ></td>
<td style="width:5%;"  ab-rpt-col="width:5%;" ></td>
<td style="width:5%;"  ab-rpt-col="width:5%;" ></td>
<td style="width:10%;" ab-rpt-col="width:10%;" ></td>
<td style="width:7%;"  ab-rpt-col="width:7%;" ></td>
	
</tr>	




<!-- Added AB_noDoubles A.C. 20161017 -->
<tr  ab-rpt-row="detail"   >

<td style="vertical-align:top;"  >
<input ng-model="sales.sPattern" class="hidden"  ng-init="sales.sPattern='[=SPE=](VIN_ITEM_ITMID = '+qua+sales.VIN_ITEM_ITMID+qua+')' "  />

<label line="#line{{$index}}" onclick="$($(this).attr('line')).toggleClass('hidden');" ab-report-hide="Sales_History" class=" ab-pointer text-primary glyphicon glyphicon-th-list"></label>
&nbsp;
<span ab-rpt-col="width:8%;font-size:8pt;">
{{sales.VSL_ORHE_ORNUM}}
</span>
</td>
<td style="vertical-align:top;" ab-rpt-col="width:12%;font-size:8pt;" title="{{sales.VGB_BPAR_BPART}}"  >{{sales.VGB_CUST_BPNAM}}</td>
<td style="vertical-align:top;" ab-rpt-col="width:10%;font-size:8pt;" >{{sales.VSL_ORHE_CUSPO}}</td>
<td style="vertical-align:top;" ab-rpt-col="width:5%;font-size:8pt;"  >{{sales.VSL_ORDE_ORLIN}}-{{sales.VSL_ORST_STPSQ}}</td>
<td style="vertical-align:top;" ab-rpt-col="width:13%;font-size:8pt;" ><input class="hidden" ng-model="sales.VIN_ITEM_ITMID" />{{sales.VIN_ITEM_ITMID}}</td>
<td style="vertical-align:top;" ab-rpt-col="width:20%;font-size:8pt;" >{{sales.VSL_ORDE_DESCR}}</td>
<td style="vertical-align:top;" ab-rpt-col="width:5%;font-size:8pt;"  >{{sales.VSL_ORST_ORDQT}}</td>
<td style="vertical-align:top;" ab-rpt-col="width:5%;font-size:8pt;"  >{{sales.VSL_ORDE_OUNET}}</td>
<td style="vertical-align:top;" ab-rpt-col="width:5%;font-size:8pt;"  >{{getUnitDescr(sales.VSL_ORDE_SAUOM)}}</td>
<td style="vertical-align:top;" ab-rpt-col="width:10%;font-size:8pt;" >{{AB_CPARM["VSL_STEPS_DESCR"][sales.VSL_ORST_STEPS]}}</td>
<td style="vertical-align:top;" ab-rpt-col="width:7%;font-size:8pt;"  >

{{sales.VSL_ORST_PDATE}}

<span ng-if="$last==true" ><!--<span ng-init="execVSLQuery();"></span>--></span>
</td>
</tr>
<tr>
<td colspan=100>
	<div class=" hidden ab-border" id="line{{$index}}"   >
		<table style="width:100%;" >
		<tr>
			<td style="width:20%;"></td>
			<td style="width:80%;"></td>
		</tr>
		<tr>
			<td style="vertical-align:top;" >
				<div dspid="VGB_CUST_BTADD{{sales.VSL_ORHE_BTADD}}" >
				<div class="ab-spaceless" id="VGB_CUST_BTADD{{addr.idVGB_ADDR}}"
					ng-repeat="addr in rawResult.vsl_history | AB_noDoubles:'idVGB_ADDR' " 
					ng-if="sales.VSL_ORHE_BTADD==addr.idVGB_ADDR"  >
		       			<span ab-label='STD_BILL_TO' class='ab-strong text-primary'>Bill to</span>
		       			<label class="small" >{{addr.VGB_ADDR_ADDID}} - {{addr.VGB_ADDR_DESCR}} </label>
		       			<span>&nbsp;</span>
		       			<div class="small ab-spaceless" >
			       			<table >
				       			<tr ng-if="addr.VGB_ADDR_ADD01!='' "  >
					       			<td style="text-align:left;" >{{ addr.VGB_ADDR_ADD01 }}
					       			
					       			</td>
				       			</tr>
				       			<tr ng-if="addr.VGB_ADDR_ADD02!='' "   >
								<td style="text-align:left;"  >{{ addr.VGB_ADDR_ADD02 }}</td>
							</tr>
							<tr   >
								<td style="text-align:left;"  >
									<span ng-if="addr.VGB_ADDR_CITYN!='' "> {{ addr.VGB_ADDR_CITYN }} </span>
									<span ng-if="addr.VGB_ADDR_POSTC!='' "> ,{{ addr.VGB_ADDR_POSTC }}</span>
								</td>
							</tr>
						</table>
					</div>	      
				</div>
				</div>
				<div dspid="VGB_CUST_STADD{{sales.VSL_ORHE_STADD}}" >
				<div class="ab-spaceless" 
					ng-repeat="addr in rawResult.vsl_history | AB_noDoubles:'idVGB_ADDR' " 
					ng-if="sales.VSL_ORHE_STADD==addr.idVGB_ADDR"  >
					<span ng-if="sales.VSL_ORHE_BTADD==sales.VSL_ORHE_STADD" >
					<span ab-label='STD_SHIP_TO' class='ab-strong text-primary'>Ship to</span> same
					</span>
					<span ng-if="sales.VSL_ORHE_BTADD!=sales.VSL_ORHE_STADD" >
		       			<span ab-label='STD_SHIP_TO' class='ab-strong text-primary'>Ship to</span>
		       			<label class="small" >{{addr.VGB_ADDR_ADDID}} - {{addr.VGB_ADDR_DESCR}} </label>
		       			<span>&nbsp;</span>
		       			<div class="small ab-spaceless">
			       			<table>
				       			<tr ng-if="addr.VGB_ADDR_ADD01!='' ">
					       			<td style="text-align:left;">{{ addr.VGB_ADDR_ADD01 }}</td>
				       			</tr>
				       			<tr ng-if="addr.VGB_ADDR_ADD02!='' ">
								<td style="text-align:left;">{{ addr.VGB_ADDR_ADD02 }}</td>
							</tr>
							<tr>
								<td style="text-align:left;">
									<span ng-if="addr.VGB_ADDR_CITYN!='' "> {{ addr.VGB_ADDR_CITYN }} </span>
									<span ng-if="addr.VGB_ADDR_POSTC!='' "> ,{{ addr.VGB_ADDR_POSTC }}</span>
								</td>
							</tr>
						</table>
					</div>
				</div>
				</div>
			</td>
			<td style="vertical-align:top;" >
				<div >
				<?php  echo $vin_sales; ?>
				</div>
			</td>
		<tr>
		</table>	


	</div>	

</td>
</tr>
</table>


</div>
</div>
</div>
</div>
</div>
</div>




<div class="col-sm-12 {{OrheFormPg==1?'':'hidden'}}" ab-report="Purchase_History" ab-report-off="{{OrheFormPg==1?'':'1'}}">



<div class="hidden" ab-report-title="Purchase_History" >
<div ab-rpt-tbl="width:100%;font-size:20pt;">
<div ab-rpt-row="header">
<div ab-rpt-col="width:100%;">
Purchase History 
</div>
</div>
</div>
</div>



<div class="hidden" ab-report-foot="Purchase_History" >
	<div ab-rpt-tbl="width:100%;font-size:10pt;" >
		<div ab-rpt-row="header">
			<div ab-rpt-col="width:5%;">
				Legend: 
			</div>
			<div ab-rpt-col="width:15%;">
				Type 
			</div>
			<div ab-rpt-col="width:15%;">
				Time Stamp 
			</div>
			<div ab-rpt-col="width:15%;">
				Recset Length 
			</div>
			<div ab-rpt-col="width:50%;text-align:left;">
			Clause 
			</div>

		</div>
		<div ab-rpt-row="detail">
			<div ab-rpt-col="">
			</div>
			<div ab-rpt-col="">
				{{ABMasterInfo.vpu_history.clauseType}}
				<span ng-if="ABMasterInfo.vpu_history.clauseType=='LIKE'">
				 = '{{ABMasterInfo.vpu_history.searchPattern}}'
				</span>
			</div>

			<div ab-rpt-col="">
				{{ABMasterInfo.vpu_history.pdoTimeStmp}}
			</div>

			<div ab-rpt-col="">
				{{ABMasterInfo.vpu_history.rowCount}}
			</div>
			<div ab-rpt-col="font-size:8pt;" ng-if="ABMasterInfo.vpu_history.clauseType!='LIKE'" >
				<span>
					{{ABMasterInfo.vpu_history.whereClause}}
				</span>	
			</div>
							
			
		</div>
	</div>

</div>

<div ab-report-detail="Purchase_History" >
<div ab-rpt-tbl="width:100%;font-size:10pt;" >
<div class="ab-wrapper-div" >	
		

<table  class=" ab-spaceless" style="width:100%;" ng-init="sortBy='';VPUextraSort='';"  >
<tr class="text-primary ab-border ab-strong" ab-rpt-row="header">
<td ab-rpt-col="width:10%;" class="ab-pointer {{VPUextraSort=='VPU_ORHE_ORNUM'?'text-danger':''}}" style="width:10%;" ng-click="localSetSortby('VPUextraSort','VPU_ORHE_ORNUM')">Order<span class="caret"></span></td>
<td ab-rpt-col="width:12%;" class="ab-pointer {{VPUextraSort=='VGB_SUPP_BPNAM'?'text-danger':''}}" style="width:12%;" ng-click="localSetSortby('VPUextraSort','VGB_SUPP_BPNAM')">Supplier<span class="caret"></span></td>
<td ab-rpt-col="width:5%;"  style="width:5%;" >Line</td>
<td ab-rpt-col="width:13%;" class="ab-pointer {{VPUextraSort=='VIN_ITEM_ITMID'?'text-danger':''}}" style="width:13%;"  ng-click="localSetSortby('VPUextraSort','VIN_ITEM_ITMID')">Item Code<span class="caret"></span></td>
<td ab-rpt-col="width:20%;" style="width:20%;" >Description</td>
<td ab-rpt-col="width:5%;"  style="width:5%;" >Qty</td>
<td ab-rpt-col="width:5%;"  style="width:5%;" >Price</td>
<td ab-rpt-col="width:5%;"  style="width:5%;" >Unit</td>

<td ab-rpt-col="width:15%;" class="ab-pointer {{VPUextraSort=='VPU_ORST_STEPS'?'text-danger':''}}" style="width:15%;" ng-click="localSetSortby('VPUextraSort','VPU_ORST_STEPS')">Steps<span class="caret"></span></td>
<td ab-rpt-col="width:10%;" class="ab-pointer {{VPUextraSort=='VPU_ORST_PDATE'?'text-danger':''}}" style="width:10%;" ng-click="localSetSortby('VPUextraSort','VPU_ORST_PDATE')">Del Date<span class="caret"></span>

</td>
	
</tr>	




</table>
</div>
<div class="ab-wrapper-div"  >
<input class="hidden" id="queryVPU" value="<?php echo $locParm["searchJoin"];?>"  />
<table  style="width:100%;" ng-repeat="purchase in rawResult.vpu_history | AB_noDoubles:'idVPU_ORHE,idVPU_ORDE,idVPU_ORST'  | AB_Sorted:VPUextraSort ">
<tr class="text-primary" >
<td ab-rpt-col="width:10%;" style="width:10%;" ></td>
<td ab-rpt-col="width:12%;" style="width:12%;" ></td>
<td ab-rpt-col="width:5%;"  style="width:5%;" ></td>
<td ab-rpt-col="width:13%;" style="width:13%;" ></td>
<td ab-rpt-col="width:20%;" style="width:20%;" ></td>
<td ab-rpt-col="width:5%;"  style="width:5%;" ></td>
<td ab-rpt-col="width:5%;"  style="width:5%;" ></td>
<td ab-rpt-col="width:5%;"  style="width:5%;" ></td>
                           
<td ab-rpt-col="width:15%;" style="width:15%;" ></td>
<td ab-rpt-col="width:10%;" style="width:10%;" ></td>
	
</tr>	




<!-- Added AB_noDoubles A.C. 20161017 -->
<tr  ab-rpt-row="detail" >

<td style="vertical-align:top;" >
<input ng-model="purchase.sPattern" class="hidden"  ng-init="purchase.sPattern='[=SPE=](VIN_ITEM_ITMID = '+qua+purchase.VIN_ITEM_ITMID+qua+')' "  />
<label line="#VPUline{{$index}}" onclick="$($(this).attr('line')).toggleClass('hidden');" abb-report-hide="Purchase_History" class="ab-pointer text-primary glyphicon glyphicon-th-list"></label>
&nbsp;
<span ab-rpt-col="">
{{purchase.VPU_ORHE_ORNUM}}</td>
<td ab-rpt-col="" style="vertical-align:top;" title="{{purchase.VGB_BPAR_BPART}}" >{{purchase.VGB_SUPP_BPNAM}}</td>
<td ab-rpt-col="" style="vertical-align:top;" >{{purchase.VPU_ORDE_ORLIN}}-{{purchase.VPU_ORST_STPSQ}}</td>
<td ab-rpt-col="" style="vertical-align:top;" >{{purchase.VIN_ITEM_ITMID}}</td>
<td ab-rpt-col="" style="vertical-align:top;" >{{purchase.VPU_ORDE_DESCR}}</td>
<td ab-rpt-col="" style="vertical-align:top;" >{{purchase.VPU_ORST_ORDQT}}</td>
<td ab-rpt-col="" style="vertical-align:top;" >{{purchase.VPU_ORDE_OUNET}}</td>
<td ab-rpt-col="" style="vertical-align:top;" >{{getUnitDescr(purchase.VPU_ORDE_SAUOM)}}</td>

<td ab-rpt-col="" style="vertical-align:top;" >{{ AB_CPARM["VPU_STEPS_DESCR"][purchase.VPU_ORST_STEPS]}}</td>
<td ab-rpt-col="" style="vertical-align:top;" >{{purchase.VPU_ORST_PDATE}}
<span ng-if="$last==true" ><!--<span ng-init="execVPUQuery();"></span>--></span>
</td>
</tr>
<tr>
<td colspan=100>
	<div class=" hidden ab-border" id="VPUline{{$index}}"   >
		<table style="width:100%;" >
		<tr>
			<td style="width:20%;"></td>
			<td style="width:80%;"></td>
		</tr>
		<tr>
			<td style="vertical-align:top;" >
				<div class="ab-spaceless" 
					ng-repeat="addr in rawResult.vpu_history | AB_noDoubles:'idVGB_ADDR' " 
					ng-if="purchase.VPU_ORHE_BTADD==addr.idVGB_ADDR"  >
		       			<span ab-label='STD_BILL_TO' class='ab-strong text-primary'>Pay to</span>
		       			<label class="small" >{{addr.VGB_ADDR_ADDID}} - {{addr.VGB_ADDR_DESCR}} </label>
		       			<span>&nbsp;</span>
		       			<div class="small ab-spaceless">
			       			<table>
				       			<tr ng-if="addr.VGB_ADDR_ADD01!='' ">
					       			<td style="text-align:left;">{{ addr.VGB_ADDR_ADD01 }}</td>
				       			</tr>
				       			<tr ng-if="addr.VGB_ADDR_ADD02!='' ">
								<td style="text-align:left;">{{ addr.VGB_ADDR_ADD02 }}</td>
							</tr>
							<tr>
								<td style="text-align:left;">
									<span ng-if="addr.VGB_ADDR_CITYN!='' "> {{ addr.VGB_ADDR_CITYN }} </span>
									<span ng-if="addr.VGB_ADDR_POSTC!='' "> ,{{ addr.VGB_ADDR_POSTC }}</span>
								</td>
							</tr>
						</table>
					</div>	      
				</div>
				<div class="ab-spaceless" 
					ng-repeat="addr in rawResult.vpu_history | AB_noDoubles:'idVGB_ADDR' " 
					ng-if="purchase.VPU_ORHE_STADD==addr.idVGB_ADDR"  >
					<span ng-if="purchase.VPU_ORHE_BTADD==purchase.VPU_ORHE_STADD" >
					<span ab-label='STD_SHIP_TO' class='ab-strong text-primary'>Ship to</span> same
					</span>
					<span ng-if="purchase.VPU_ORHE_BTADD!=purchase.VPU_ORHE_STADD" >
		       			<span ab-label='STD_SHIP_TO' class='ab-strong text-primary'>Ship to</span>
		       			<label class="small" >{{addr.VGB_ADDR_ADDID}} - {{addr.VGB_ADDR_DESCR}} </label>
		       			<span>&nbsp;</span>
		       			<div class="small ab-spaceless">
			       			<table>
				       			<tr ng-if="addr.VGB_ADDR_ADD01!='' ">
					       			<td style="text-align:left;">{{ addr.VGB_ADDR_ADD01 }}</td>
				       			</tr>
				       			<tr ng-if="addr.VGB_ADDR_ADD02!='' ">
								<td style="text-align:left;">{{ addr.VGB_ADDR_ADD02 }}</td>
							</tr>
							<tr>
								<td style="text-align:left;">
									<span ng-if="addr.VGB_ADDR_CITYN!='' "> {{ addr.VGB_ADDR_CITYN }} </span>
									<span ng-if="addr.VGB_ADDR_POSTC!='' "> ,{{ addr.VGB_ADDR_POSTC }}</span>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</td>
			<td style="vertical-align:top;" >
				<div >
				<?php  echo $vin_purchases; ?>
				</div>
			</td>
		<tr>
		</table>	


	</div>	

</td>
</tr>

</table>

</div>
</div>
</div>
</div>

<div id="MTDYTD"  class="col-sm-12 {{OrheFormPg==2?'':'hidden'}}" ab-report="MTD_History" ab-report-off="{{OrheFormPg==2?'':'1'}}">


<div ab-report-detail="MTD_History" >
<div ab-rpt-tbl="width:100%;font-size:10pt;" >

	<div class="ab-wrapper-div"  >	

		<table  class=" ab-spaceless" style="width:95%;" ng-init="sortBy='';MTDextraSort='';" >
			<tr class="text-primary ab-border ab-strong small" ab-rpt-row="header" >
				<td ab-rpt-col="width:10%;font-size:8pt;" class="ab-pointer {{MTDextraSort=='id'?'text-danger':''}}" style="width:10%;" ng-click="localSetSortby('MTDextraSort','id')">
					Customer Id
					<span class="caret"></span>
				</td>
				<td ab-rpt-col="width:15%;font-size:8pt;" class="ab-pointer {{MTDextraSort=='name'?'text-danger':''}}" style="width:15%;" ng-click="localSetSortby('MTDextraSort','name')">
					Name
					<span class="caret"></span>
				</td>
				<td ab-rpt-col="width:10%;font-size:8pt;" class="ab-pointer {{MTDextraSort=='item'?'text-danger':''}}" style="width:10%;"  ng-click="localSetSortby('MTDextraSort','item')">
					Item Code
					<span class="caret"></span>
				</td>
				<td ab-rpt-col="width:15%;font-size:8pt;" style="width:15%;" >
					Description
				</td>
				<td ab-rpt-col="width:8%;font-size:8pt;" style="width:8%;"  class="text-right" >This Year MTD</td>
				<td ab-rpt-col="width:8%;font-size:8pt;" style="width:8%;"  class="text-right" >Last Year MTD</td>
				
				<td ab-rpt-col="width:5%;font-size:8pt;" style="width:5%;"  class="text-right" >Diff. MTD</td>
				<td ab-rpt-col="width:8%;font-size:8pt;" style="width:8%;"  class="text-right" >This Year YTD</td>
				<td ab-rpt-col="width:8%;font-size:8pt;" style="width:8%;"  class="text-right" >Last Year YTD</td>
				<td ab-rpt-col="width:5%;font-size:8pt;" style="width:5%;"  class="text-right" >Diff. YTD</td>
				
				<td ab-rpt-col="width:8%;font-size:8pt;" style="width:8%;"  class="text-right" >Last Year Total</td>
			</tr>
		</table>		
	</div>
	<div class="ab-wrapper-div" >	
		<table  class=" ab-spaceless" style="width:95%;" ng-init="sortBy='';MTDextraSort='';" >
			<tr >
				<td style="width:10%;" ></td>
				<td style="width:15%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:15%;" ></td>
				<td style="width:8%;" ></td>
				<td style="width:8%;" ></td>
				
				<td style="width:5%;" ></td>
				<td style="width:8%;" ></td>
				<td style="width:8%;" ></td>
				<td style="width:5%;" ></td>
				
				<td style="width:8%;" ></td>
			</tr>			
			<tr ng-repeat="YMrec in vsl_MTD_YTD | AB_Sorted:MTDextraSort "  ab-rpt-row="detail" >
				<td ab-rpt-col="font-size:8pt;" >{{YMrec.id}}</td>
				<td ab-rpt-col="font-size:8pt;" >{{YMrec.name}}</td>
				<td ab-rpt-col="font-size:8pt;" >{{YMrec.item}}</td>
				<td ab-rpt-col="font-size:8pt;" >{{YMrec.idesc}}</td>
				<td ab-rpt-col="font-size:8pt;text-align:right;" class="text-right" ><b>$</b>{{ABGetNumberFn("fmt-curr",YMrec.THISYEAR_MTD)}}</td>
				<td ab-rpt-col="font-size:8pt;text-align:right;"  class="text-right" ><b>$</b>{{ABGetNumberFn("fmt-curr",YMrec.LASTYEAR_MTD)}}</td>
				<td ab-rpt-col="font-size:8pt;text-align:right;" class="text-right" >{{YMrec.percMTDamt}}</td>
				<td ab-rpt-col="font-size:8pt;text-align:right;" class="text-right" ><b>$</b>{{ABGetNumberFn("fmt-curr",YMrec.THISYEAR_YTD)}}</td>
				<td ab-rpt-col="font-size:8pt;text-align:right;" class="text-right" ><b>$</b>{{ABGetNumberFn("fmt-curr",YMrec.LASTYEAR_YTD)}}</td>
				<td ab-rpt-col="font-size:8pt;text-align:right;" class="text-right" >{{YMrec.percYTDamt}}</td>
				<td ab-rpt-col="font-size:8pt;text-align:right;" class="text-right" ><b>$</b>{{ABGetNumberFn("fmt-curr",YMrec.LASTYEAR_TOTAL)}}</td>
				
			</tr>
		</table>
		

	</div>
</div>
</div>
</div>



    </form>
</div> 
<div class="hidden"  >
<input class='text-muted' ab-mpp onchange="getMaxPerPage();" value="0" />
</div>
   </div>
 
 
<div ab-report-foot="MTD_History" class="hidden" >   

<table ab-rpt-tbl="font-size:8pt;" >
	<tr >
		<td >
			<span ab-rpt-row="header" >
				<span ab-rpt-col="" ng-if="custFilter.length>0">
					Customer Filters
					(
					<span class="{{custFilter.length==0?'':'hidden'}}" ab-label="STD_ALL">tous</span>
					<span class="{{custFilter.length>0?'':'hidden'}}" >{{custFilter.length}}</span>
					)
				</span>
			</span>		
			<span ng-repeat="cust in custFilterList" ng-if="isRecSelected(cust.recId,'custFilter')==true">
				<span ab-rpt-row="detail">
					<span ab-rpt-col="">
						{{cust.recDescr}}
					</span>
				</span>	
			</span>
		</td>
		
		<td>
			<span ab-rpt-row="header" >
				<span ab-rpt-col="" ng-if="itemFilter.length>0" >
					Item Filters
					(
					<span class="{{itemFilter.length==0?'':'hidden'}}" ab-label="STD_ALL">tous</span>
					<span class="{{itemFilter.length>0?'':'hidden'}}" >{{itemFilter.length}}</span>
					)
				</span>
			</span>		

			<span ng-repeat="item in itemFilterList" ng-if="isRecSelected(item.recId,'itemFilter')==true">
				<span ab-rpt-row="detail">
					<span ab-rpt-col="">
						{{item.recDescr}}
					</span>
				</span>	
			</span>
		</td>
	</tr>
</table>

</div>
 
<span class="hidden" id="openCustSelection" data-toggle="modal" data-target="#custselect" ></span>	
<div id="custselect" class="modal fade" role="dialog" >
  <div class="modal-dialog" style="width:60%;">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span  >Customer selection </span> </h4>
      </div>
      <div class="modal-body">
		<?php echo $custLister; ?>
      </div>

    </div>

  </div>
</div>

<span class="hidden" id="openItemSelection" data-toggle="modal" data-target="#itemselect" ></span>	
<div id="itemselect" class="modal fade" role="dialog" >
  <div class="modal-dialog" style="width:60%;">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span  >Item selection </span> </h4>
        
      </div>
      <div class="modal-body">
		<?php echo $itemLister; ?>
      </div>

    </div>

  </div>
</div>


<!--
var debug = "";
var chkStr = "";
var sstr = "125"
var tmp = "";
var occ = 0;
var fff = 0
var rec = dDta.ABMaster.vsl_history.result
while (occ < rec.length)
{
fff +=1
chkStr = showProps(rec[occ],occ).toUpperCase(0)
if (chkStr.indexOf(sstr) >-1)
{
tmp = chkStr.slice(chkStr.indexOf(sstr)-18)
tmp = tmp.slice(0,tmp.indexOf("\n"))
debug +=rec[occ].VPU_ORHE_ORNUM + " = " + tmp + "\n"
}

occ += 1
}
$("#focusGrid").val(occ + " = " + fff + "\n" +debug)

				
-->
