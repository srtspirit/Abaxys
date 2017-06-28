<div class="hidden">
<?php session_start(); ob_clean(); ?>
</div>



<?php 
require_once "../stdSscript/stdAppobjGen.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
require_once "../appCscript/VAP_FINANCE.php";

?>


<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VGB_PARTNERS_vgb_supp";
$sparm["searchTable"] = "vgb_supp";
$sparm["searchJoin"] = "vgb_bpar:idVGB_BPAR = VGB_SUPP_BPART";
$sparm["searchJoin"] .= ",vgb_addr:VGB_ADDR_BPART = VGB_SUPP_BPART";
$sparm["searchJoin"] .= ",vgb_curr:idVGB_CURR = VGB_SUPP_CURID";
$sparm["orderBy"] = "VGB_BPAR_BPART ASC";

$sparm["searchResult"] = "vgb_suppList";
$sparm["searchFilter"] = "ab-spaceless";
$sparm["filterExclude"] = "VGB_BPAR_BPNAM,VGB_BPAR_CDATE";
$sparm["filterAuto"] = "VGB_BPAR_BPART";
$sparm["callBack"] = "";

$suppSearch = $xtmp->setSearchMaster($sparm);
$suppLister = <<<EOC


<div id="vsl_suppView" class=" ab-border " >
	<div class="ab-wrapper-div">
		<table class="ab-border ab-spaceless" style="width:100%;" >
			<tr class="well text-primary ab-strong">
				<td style="width:5%;" ></td>
				<td style="width:65%;white-space:nowrap;" >{$suppSearch}</td>
				<td style="width:5%;" ></td>
				<td style="width:10%;" >
					<span class="btn btn-success btn-md ab-spaceless ab-pointer ab-strong" ng-click="selectRec(0,'suppFilter');">
						&nbsp;
						<span ab-label="STD_CLR_ALL">Clear</span>
						&nbsp;
					</span>
				</td>
				<td style="width:10%;" >
					<span class="btn btn-success btn-md ab-spaceless ab-pointer ab-strong" 
						ng-click="selectRecAll('suppFilter','vgb_suppList','idVGB_SUPP');">
						&nbsp;
						<span ab-label="STD_SEL_ALL">All</span>
						&nbsp;
					</span>
				</td>
				<td style="width:5%;"></td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div ">
		<table class="table-striped" style="width:100%;" >
			<tr class="text-primary ab-strong">
				<td style="width:1%;" ></td>
				<td style="width:25%;" >Supplier Id</td>
				<td style="width:4%;" ></td>
				<td style="width:4%;" ></td>
				<td style="width:40%;" >Name</td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:6%;" ></td>

			</tr>
			<tr class="ab-pointer"
			ng-repeat="acc in vgb_suppList | AB_noDoubles:'idVGB_SUPP' " 
			ng-click="selectRec(acc.idVGB_SUPP,'suppFilter');" 
			onmouseover="$(this).addClass('text-primary ab-strong')"
			onmouseout="$(this).removeClass('text-primary ab-strong')"
			>
				<td>&nbsp;</td>	
				<td>{{acc.VGB_BPAR_BPART}}&nbsp;({{acc.VGB_CURR_CURID}})</td>
				<td>&nbsp;</td>
				<td>
					<span class="{{isRecSelected(acc.idVGB_SUPP,'suppFilter')?'':'invisible'}}" >
						<span class="glyphicon glyphicon-ok" title=""></span>
					</span>
				</td>
				<td >{{acc.VGB_SUPP_BPNAM}}</td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>

</div>


EOC;


?>
<div class="row "  >
	<div class="col-lg-12 ab-spaceless ">
	    <?php require_once "../stdCscript/stdFormButtons.php"; ?>
	    <script>
	        $('#ab-sysOpt').html("");
	    </script>
	    
	</div>
</div>	
<div class="row ab-strong" ng-init="SESSION_DESCR='Payable Aged Report';">
	<div class="col-lg-2">
		<span class="ab-pointer text-primary ab-strong" onclick='$("#openSuppSelection").click();'>
			Suppliers
			(
			<span class="{{suppFilter.length==0?'':'hidden'}}" ab-label="STD_ALL">tous</span>
			<span class="{{suppFilter.length>0?'':'hidden'}}" >{{suppFilter.length}}</span>
			)
			<span class="caret"></span>
		</span>	
	</div>
	<div class="col-lg-3">
		<table>
			<tr>
				<td class="text-primary ">
					Aging Date
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					<?php
						$hardCode = $xtmp->setDatePick("agingDate");
						echo  $hardCode;
					?>
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					<span class="btn btn-success btn-md ab-spaceless" ab-label="STD_SUBMIT" ng-click="doAgingReport();" >GO</span>
				</td>


			</tr>
		</table>
		
	</div>
</div>

<span class="hidden" id="openSuppSelection" data-toggle="modal" data-target="#suppselect" ></span>
<div id="suppselect" class="modal fade" role="dialog" >
	<div class="modal-dialog" style="width:60%;">
	 <!-- Modal content-->
		<div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title"><span  >Supplier selection </span> </h4>
			</div>
			<div class="modal-body">
				<?php echo $suppLister; ?>
			</div>

		</div>

	</div>
</div>

<div class="row bg-primary">
	<div class="col-lg-2">Suppplier</div>
	<div class="col-lg-10">
		<div class="row">
			<div class="col-lg-3 text-right">Total</div>
			<div class="col-lg-1 text-right">1-30</div>
			<div class="col-lg-1 text-right">31-60</div>
			<div class="col-lg-1 text-right">61-90</div>
			<div class="col-lg-1 text-right">91-120</div>
			<div class="col-lg-1 text-right">121+</div>
		</div>
	</div>
</div>

<div class="row " ng-repeat="rec in dummyTable | AB_Sorted:'currency' | AB_noDoubles:'currency' " >
	<div class="col-lg-12 ab-strong ">
		<div class="ab-underline">
			{{rec.currency}}&nbsp;-&nbsp;{{rec.currDesc}}
		</div>	
	</div>

<div class="row ab-border ab-spaceless" ng-repeat="curr in dummyTable" ng-if="curr.suppId>0 && curr.currency==rec.currency">
	<div class="col-lg-2">
		<span pt="#id{{curr.suppId}}" class="btn-link glyphicon glyphicon-th-list collapsed" onclick="$($(this).attr('pt')).toggleClass('hidden');"/>
		<span>{{curr.name}}</span></div>
	<div class="col-lg-10">
		<div class="row">
			<div class="col-lg-3 text-right ab-strong">{{setAmtDisplay(curr.totalDebt)}}</div>
			<div class="col-lg-1 text-right">{{setAmtDisplay(curr.total30)}}</div>
			<div class="col-lg-1 text-right">{{setAmtDisplay(curr.total60)}}</div>
			<div class="col-lg-1 text-right">{{setAmtDisplay(curr.total90)}}</div>
			<div class="col-lg-1 text-right">{{setAmtDisplay(curr.total120)}}</div>
			<div class="col-lg-1 text-right">{{setAmtDisplay(curr.totalOld)}}</div>
		</div>
		
		<div id="id{{curr.suppId}}" class="hidden">
			<div class="row ab-well" ng-repeat="currInv in curr.invoices">
				<div class="col-lg-3 ab-strong">
					<table style="width:100%;">
						<tr>
							<td style="width:50%;">
								{{setTransacType(currInv)}}
							</td>
							<td style="width:50%;">
								{{currInv[1]}}
							</td>
						</tr>
					</table>
				</div>
				<div class="col-lg-1 text-right">{{setAmtDisplay(currInv[2])}}</div>
				<div class="col-lg-1 text-right">{{setAmtDisplay(currInv[3])}}</div>
				<div class="col-lg-1 text-right">{{setAmtDisplay(currInv[4])}}</div>
				<div class="col-lg-1 text-right">{{setAmtDisplay(currInv[5])}}</div>
				<div class="col-lg-1 text-right">{{setAmtDisplay(currInv[6])}}</div>
			</div>
		</div>
	</div>
</div>

<div class="row ">
	<div class="col-lg-12">&nbsp;</div>
</div>
<div class="row ab-well" ng-repeat="curr in dummyTable" ng-if="curr.suppId==0  && curr.currency==rec.currency">
	<div class="col-lg-2 text-center">
		<span>Report Totals</span>&nbsp;
		<span class="ab-strong" >{{ rec.currency }}&nbsp;-&nbsp;{{rec.currDesc}}</span>
	</div>
	<div class="col-lg-10">
		<div class="row">
			<div class="col-lg-3 text-right ab-strong">{{setAmtDisplay(curr.totalDebt)}}</div>
			<div class="col-lg-1 text-right">{{setAmtDisplay(curr.total30)}}</div>
			<div class="col-lg-1 text-right">{{setAmtDisplay(curr.total60)}}</div>
			<div class="col-lg-1 text-right">{{setAmtDisplay(curr.total90)}}</div>
			<div class="col-lg-1 text-right">{{setAmtDisplay(curr.total120)}}</div>
			<div class="col-lg-1 text-right">{{setAmtDisplay(curr.totalOld)}}</div>
		</div>
	</div>
</div>
<div class="row ">
	<div class="col-lg-12">&nbsp;</div>
</div>
</div>