<div class="hidden">
<?php session_start(); ob_clean(); ?>
</div>



<?php 
require_once "../stdSscript/stdAppobjGen.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
require_once "../appCscript/VAR_FINANCE.php";

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
				<td style="width:10%;" >
					<span class="btn btn-success btn-md ab-spaceless ab-pointer ab-strong" ng-click="selectRec(0,'custFilter');">
						&nbsp;
						<span ab-label="STD_CLR_ALL">Clear</span>
						&nbsp;
					</span>
				</td>
				<td style="width:10%;" >
					<span class="btn btn-success btn-md ab-spaceless ab-pointer ab-strong" 
						ng-click="selectRecAll('custFilter','vgb_custList','idVGB_CUST');">
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
				<td style="width:25%;" >Cust Id</td>
				<td style="width:4%;" ></td>
				<td style="width:4%;" ></td>
				<td style="width:40%;" >Name</td>
				<td style="width:10%;" >Type</td>
				<td style="width:10%;" >Market</td>
				<td style="width:6%;" ></td>

			</tr>
			<tr class="ab-pointer"
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
<div class="row "  >
	<div class="col-lg-12 ab-spaceless ">
	    <?php require_once "../stdCscript/stdFormButtons.php"; ?>
	    <script>
	        $('#ab-sysOpt').html("");
	    </script>
	    
	</div>
</div>	
<div class="row ab-strong" ng-init="SESSION_DESCR='Receivable Aged Report';">
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

<span class="hidden" id="openCustSelection" data-toggle="modal" data-target="#custselect" ng-click="custSel=1" ></span>
<span class="hidden" id="openCustViewer" data-toggle="modal" data-target="#custselect"  ng-click="custSel=0" ></span>
<span class="hidden" id="leavingCustViewer"  ng-click="testCapture(idVGB_CUST);" ></span>
<div id="custselect" class="modal fade" role="dialog" ng-click="testCapture($event);">
	<div class="modal-dialog" style="width:40%;">
	 <!-- Modal content-->

		<div class="modal-content"  >
			<div class="modal-header">
				<span class="{{custSel==1?'':'hidden'}}">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title"><span  >Customer selection </span> </h4>
			        </span>
			        <span class="{{custSel==0?'':'hidden'}}">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">
						<span ab-label="STD_ADD22RESS" >Partner Information</span>
						 - <label>{{VGB_BPAR_BPART}} {{VGB_CUST_BPNAM}}</label>
					</h4>
					
			        </span>
			</div>
			<div class="modal-body">
				<span class="{{custSel==1?'':'hidden'}}">
					<?php echo $custLister; ?>
				</span>
				<span class="{{custSel==0?'':'hidden'}}">	
					<?php require_once "VGB_CUST_FINDISPLAY.php"; ?>
				</span>
				<button type="button" class="table btn btn-default ab-spaceless " data-dismiss="modal">Close</button>
			</div>
		</div>




	</div>
</div>

<div class="row bg-primary">
	<div class="col-lg-2">Customer</div>
	<div class="col-lg-10">
		<div class="row">
			<div class="col-lg-3 text-right">Total--{{custSel}}</div>
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

<div class="row ab-border ab-spaceless" ng-repeat="curr in dummyTable" ng-if="curr.custId>0 && curr.currency==rec.currency">
	<div class="col-lg-2">
		<span 	pt="#id{{curr.custId}}" class="text-primary ab-pointer glyphicon glyphicon-th-list " 
			onclick="$($(this).attr('pt')).toggleClass('hidden');" >
		
		</span>
		&nbsp;&nbsp;
		<span class="btn btn-default btn-xs" 
		onclick="$('#openCustViewer').click();" 
		ng-click="readPartnerCust(curr.custId);">
			
			<span >{{curr.name}}</span>
			<span class="small">
				<span class="text-primary ab-strong glyphicon glyphicon-triangle-bottom"></span>
			</span>
		<span>
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
		
		<div id="id{{curr.custId}}" class="hidden">
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
<div class="row ab-well" ng-repeat="curr in dummyTable" ng-if="curr.custId==0  && curr.currency==rec.currency">
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

