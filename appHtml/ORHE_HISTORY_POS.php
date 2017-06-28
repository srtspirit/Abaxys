<div class="hidden">
<?php 
session_start();
ob_clean();
?>
</div>
<div class="hidden">
<!-- require_once "../appCscript/VIT_ISSUES.php"; --> 

<?php 
require_once "../stdSscript/stdAppobjGen.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
require_once "../appCscript/HIS_REPORTS.php";

?>

</div>



<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VGB_PARTNERS_vgb_supp";
$sparm["searchTable"] = "vgb_supp";
$sparm["searchJoin"] = "vgb_bpar:idVGB_BPAR = VGB_SUPP_BPART";
$sparm["searchJoin"] .= ",vgb_addr:VGB_ADDR_BPART = VGB_SUPP_BPART";
$sparm["searchJoin"] .= ",vgb_mark:idVGB_MARK = VGB_SUPP_MRKID ";
$sparm["searchJoin"] .= ",vgb_ctyp:idVGB_CTYP = VGB_SUPP_CUTYP ";
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
<td style="width:25%;"></td>
</tr>
</table>
</div>



<table class="table-striped" style="width:100%;" >
<tr>
<td style="width:1%;" ></td>
<td style="width:25%;" ></td>
<td style="width:4%;" ></td>
<td style="width:4%;" ></td>
<td style="width:60%;" ></td>
<td style="width:6%;" ></td>

</tr>
</table>

<div class="ab-wrapper-div ">
<table class="table-striped" style="width:100%;" >
<tr class="text-primary ab-strong">
<td style="width:1%;" ></td>
<td style="width:25%;" >Supplier Id</td>
<td style="width:4%;" ></td>
<td style="width:4%;" ></td>
<td style="width:60%;" >Name</td>
<td style="width:6%;" ></td>

</tr>
<tr 	class="ab-pointer"  data-dismiss="modal" 
	ng-repeat="acc in vgb_suppList | AB_noDoubles:'idVGB_SUPP' " 
	ng-click="setReportSupplierId(acc);clearData('vsl_POS_RPT');" 
	
	onmouseover="$(this).addClass('text-primary ab-strong')"
	onmouseout="$(this).removeClass('text-primary ab-strong')"
	>
<td>&nbsp;</td>	
<td>{{acc.VGB_BPAR_BPART}}&nbsp;({{acc.VGB_CURR_CURID}})</td>
<td>&nbsp;</td>
<td>
</td>
<td >{{acc.VGB_SUPP_BPNAM}}</td>
</tr>
</table>
</div>

</div>


EOC;


?>


<div class="hidden" id="" ab-repor22t="PDF" >
<div ab-report-title="PDF" >
	<div class="row" ab-rpt-row="width:100%;">
		<div class="col-lg-3" ab-rpt-col="width:25%;">Hello How you going </div>
		<div class="col-lg-2" ab-rpt-col="width:20%;"> How you go </div>
		<div class="col-lg-3" ab-rpt-col="width:25%;">When he you going?? </div>
		<div class="col-lg-1" ab-rpt-col="width:15%;"> Whoing</div>
		<div class="col-lg-3" ab-rpt-col="width:15%;">When you </div>
	</div>
</div>
<div ab-report-head="PDF" >
	<div class="row" ab-rpt-row="width:100%;">
		<div class="col-lg-3" ab-rpt-col="width:25%;">Hello How you going </div>
		<div class="col-lg-2" ab-rpt-col="width:20%;"> How you go </div>
		<div class="col-lg-3" ab-rpt-col="width:25%;">When he you going?? </div>
		<div class="col-lg-1" ab-rpt-col="width:15%;"> Whoing</div>
		<div class="col-lg-3" ab-rpt-col="width:15%;">When you </div>
	</div>
</div>
<div ab-report-detail="PDF" >
	<div class="row" ab-rpt-row="width:100%;">
		<div class="col-lg-3" ab-rpt-col="width:25%;">Hello How you going </div>
		<div class="col-lg-2" ab-rpt-col="width:20%;"> How you go </div>
		<div class="col-lg-3" ab-rpt-col="width:25%;">When he you going?? </div>
		<div class="col-lg-1" ab-rpt-col="width:15%;"> Whoing</div>
		<div class="col-lg-3" ab-rpt-col="width:15%;">When you </div>
	</div>
</div>	
</div>




<div class="hidden" id="reportFilterDisplay" ab-report="" >
	<div class="row ">
		<div class="col-lg-1" >
		</div>
		<div class="col-lg-11"  ab-report-title=""  >
			<table style="width:100%;" class="ab-well ab-border ab-spaceless {{!vsl_POS_RPT?'hidden':''}}" ab-rpt-tbl="width:100%;" > 
				<tr ab-rpt-row="">
					<td ab-rpt-col="width:15%;font-size:12pt;" >&nbsp;</td>
					<td class="text-primary ab-strong" ab-rpt-col="width:25%;font-size:12pt;">
						<span class="text-primary ab-strong" ab-label="STD_CURRENT">Current Display</span>
						<span class="text-primary ab-strong" ab-label="VGB_SUPP_BPART">Current Display</span>
					</td>
					<td class="text-primary ab-strong" ab-rpt-col="width:25%;font-size:12pt;">
						<span class="text-primary ab-strong" ab-label="STD_PERIOD">Current Date</span>
					</td>
					<td ab-rpt-col="width:35%;font-size:12pt;">&nbsp;</td>
				</tr>
				<tr ab-rpt-row="" >
					<td ab-rpt-col="font-size:12pt;">&nbsp;</td>
					<td class="ab-strong" ab-rpt-col="font-size:12pt;">
						{{currentReport.SupplierCode}}&nbsp;&nbsp;{{currentReport.SupplierName}}
					</td>
					<td class="ab-strong" ab-rpt-col="font-size:12pt;">
						{{currentReport.yearSelected}}{{currentReport.monthSelected}}
					</td>
					<td ab-rpt-col="font-size:12pt;">&nbsp;</td>
				</tr>
			</table>
		</div>
	</div>	
</div>


<div class="hidden" id="reportFilterExport" >
	<div class="row ">
		<div class="col-lg-4 text-center" >
			<div class="{{columnList.length>0?'':'hidden'}}" >
				 <span class="btn btn-success btn-md ab-spaceless"  onclick="$('#openExportSelection').click();" >Export</span>			
			</div>
			
		</div>
	</div>
</div>


<div class="col-lg-12 ab-spaceless" ng-init="SESSION_DESCR='Point of Sales';">
    <?php require_once "../stdCscript/stdFormButtons.php"; ?>
    <script>
        $('#ab-buttonPad').html($("#reportFilterDisplay").html());
        $("#reportFilterDisplay").html("")
        $('#ab-sysMess').html($("#reportFilterExport").html());
        $('#ab-new').html('');
    </script>
    
</div>






<div class="col-sm-12">   
	<table class="" >
		<tr><td style="font-size:4pt;">&nbsp;</td></tr>
		<tr>
			<td colspan=2>
			<input class="hidden" ng-model="yearSelected" />
			<input class="hidden" ng-model="monthSelected" />
			<input class="hidden" ng-model="reportSupplierId" />
			
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
			<td class="ab-border well ab-spaceless">
				&nbsp;
				<span class="ab-pointer ab-strong" onclick='$("#openSuppSelection").click();'>
					<span class=" text-primary ">
						Supplier:
					</span>	
					<span 	ng-repeat="acc in vgb_suppList | AB_noDoubles:'idVGB_SUPP' " 
						ng-if="reportSupplierId==acc.idVGB_SUPP" > 
						<input class="hidden" id="supplierCode" value="{{acc.VGB_BPAR_BPART+yearSelected+monthSelected}}" />
						{{acc.VGB_BPAR_BPART}}&nbsp;({{acc.VGB_CURR_CURID}})&nbsp;{{acc.VGB_SUPP_BPNAM}}
					</span>
					<span class=" text-primary ">
						<span class="caret"></span>
					</span>
					
				</span>			
				&nbsp;
			</td>			
			<td>
			&nbsp;&nbsp;&nbsp;
			</td>
			<td class="ab-border well ab-spaceless {{reportSupplierId>0?'':'hidden'}}">
				<table  >
					<tr>
						<td>
							<span class="text-primary ab-strong" ab-label="STD_SELECT" ></span>
							<span class="text-primary ab-strong" ab-label="STD_YEAR" ></span>
							&nbsp;&nbsp;
						</td>
						<td>
							<ul class="nav  ab-spaceless " role="tablist">
								<li class="dropdown ab-spaceless"  >
									<span data-toggle="dropdown" class="ab-strong ab-pointer" 
									ng-repeat="date in rptYear " 
									ng-if="date.YEAR == yearSelected">
										{{date.YEAR}}
										<span class="caret"></span>
									</span>
									<ul class="dropdown-menu ab-spaceless" ab-flst="" role="menu">
										<li ng-repeat="fDta in rptYear  "  >
											<span ng-if="date.YEAR != yearSelected" class="text-primary ab-pointer"  ng-click="setPeriod('YEAR',fDta.YEAR);clearData('vsl_POS_RPT');">
												&nbsp;&nbsp;{{fDta.YEAR}}
											</span>
											<span ng-if="date.YEAR == yearSelected" class="text-primary ab-pointer"  >
												&nbsp;&nbsp;{{fDta.YEAR}}
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
			<td >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td class="ab-border well ab-spaceless {{reportSupplierId>0?'':'hidden'}}" >
				<table>
					<tr>
						<td>
							&nbsp;
							<span class="text-primary ab-strong" ab-label="STD_SELECT" ></span>
							<span class="text-primary ab-strong" ab-label="STD_MONTH" ></span>
							&nbsp;&nbsp;
						</td>
						<td>
							<ul class="nav  ab-spaceless " role="tablist">
								<li class="dropdown ab-spaceless"  >
									<span data-toggle="dropdown" class="ab-strong ab-pointer" 
									ng-repeat="date in rptMonth" 
									ng-if="date.MONTH == monthSelected">
										{{date.DESCR}}
										<span class="caret"></span>
									</span>
									<ul class="dropdown-menu ab-spaceless" ab-flst="" role="menu">
										<li ng-repeat="fDta in rptMonth"  >
											<span  ng-if="date.MONTH != monthSelected"  class="text-primary ab-pointer" ng-click="setPeriod('MONTH',fDta.MONTH);clearData('vsl_POS_RPT');">
												&nbsp;&nbsp;{{fDta.DESCR}}
											</span>
											<span ng-if="date.MONTH == monthSelected"  class="text-primary ab-pointer" >
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

			<td class="{{reportSupplierId>0?'':'hidden'}} ">
				&nbsp;&nbsp;&nbsp;
				<span class="btn btn-success btn-md ab-spaceless {{currentReport.noChange!=true?'':'hidden'}}" ab-label="STD_SUBMIT" ng-click="getvsl_POS_RPT();" >GO</span>
				<span class="btn btn-success btn-md ab-spaceless {{currentReport.noChange==true?'':'hidden'}}" ab-label="STD_REFRESH" ng-click="getvsl_POS_RPT();" >GO</span>
			</td>			
			<td >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td class="ab-border well ab-spaceless {{columnList.length>0?'':'hidden'}}" >
				<ul class="nav  ab-spaceless " role="tablist">
					<li class="dropdown ab-spaceless"  >
						<span data-toggle="dropdown" class="text-primary ab-strong ab-pointer" >
							Column Selection{{countColumnSelect()}}
							<span class="caret"></span>
						</span>
						<ul class="dropdown-menu ab-spaceless" ab-flst="" role="menu">
							<li ng-repeat="col in columnList" class="ab-border ab-spaceless"  >
								
								<span class="text-primary ab-pointer" ng-click="columnSelect[col.colName]=1-columnSelect[col.colName]">
									<span class="{{columnSelect[col.colName]==1?'':'hidden'}}">
										<span class="glyphicon glyphicon-ok" ></span>
									</span>
									&nbsp;&nbsp;{{col.colName}}
								</span>
							</li>
						</ul>
					</li>
				</ul>
			
			</td>
		</tr>
		<tr><td style="font-size:4pt;">&nbsp;</td></tr>
	</table>

</div>

<div class="col-sm-12"> 
<div class="ab-wrapper-div"  ab-report-detail="">
	<table style="width:100%:"  ab-rpt-tbl="width:100%;" >
		<tr class="rptHeading text-primary" ab-rpt-row="header">
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['PREFIX']==1" 	>PREFIX</TD>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['CODE']==1" 	>CODE</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['CustId']==1" 	>CustId</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['Name']==1" 	>Name</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['Address']==1" 	>Address</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['City']==1" 	>City</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['Prov']==1" 	>Prov</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['POSTAL_C']==1"	>POSTAL_C</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['Country']==1" 	>Country</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['J']==1" 	>J</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['K']==1" 	>K</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['L']==1" 	>L</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['M']==1" 	>M</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['N']==1" 	>N</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['O']==1" 	>O</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['P']==1" 	>P</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['Q']==1" 	>Q</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['ITEM_ID']==1" 	>ITEM_ID</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['S']==1" 	>S</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['T']==1" 	>T</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['ITEM_DESC']==1">ITEM_DESC</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['V']==1" 	>V</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['INV_DATE']==1"	>INV_DATE</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['X']==1" 	>X</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['ORDQT']==1" 	>ORDQT</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['UOM']==1" 	>UOM</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['Cost']==1" 	>Cost</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['EXTENSION']==1">EXTENSION</td>
		
		</tr>
		<tr class="rptDetail" ng-repeat="pos in vsl_POS_RPT" ab-rpt-row="detail">
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['PREFIX']==1" 	>{{pos.PREFIX}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['CODE']==1" 	>{{pos.CODE}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['CustId']==1" 	>{{pos.CustId}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['Name']==1" 	>{{pos.Name}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['Address']==1" 	>{{pos.Address}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['City']==1" 	>{{pos.City}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['Prov']==1" 	>{{pos.Prov}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['POSTAL_C']==1"	>{{pos.POSTAL_C}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['Country']==1" 	>{{pos.Country}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['J']==1" 	>{{pos.J}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['K']==1" 	>{{pos.K}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['L']==1" 	>{{pos.L}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['M']==1" 	>{{pos.M}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['N']==1" 	>{{pos.N}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['O']==1" 	>{{pos.O}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['P']==1" 	>{{pos.P}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['Q']==1" 	>{{pos.Q}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['ITEM_ID']==1" 	>{{pos.ITEM_ID}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['S']==1" 	>{{pos.S}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['T']==1" 	>{{pos.T}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['ITEM_DESC']==1">{{pos.ITEM_DESC}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['V']==1" 	>{{pos.V}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['INV_DATE']==1"	>{{pos.INV_DATE}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['X']==1" 	>{{pos.X}}</td>
			<td ab-rpt-col="font-size:8pt;text-align:center;" ng-if="columnSelect['ORDQT']==1" 	>{{pos.ORDQT}}</td>
			<td ab-rpt-col="font-size:8pt;" ng-if="columnSelect['UOM']==1" 	>{{pos.UOM}}</td>
			<td ab-rpt-col="font-size:8pt;text-align:right;" ng-if="columnSelect['Cost']==1" 	>{{pos.Cost}}</td>
			<td ab-rpt-col="font-size:8pt;text-align:right;" ng-if="columnSelect['EXTENSION']==1">{{pos.EXTENSION}}</td>
			
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


<span class="hidden" id="openExportSelection" data-toggle="modal" data-target="#exportselect" ></span>	
<div id="exportselect" class="modal fade" role="dialog" >
  <div class="modal-dialog" style="width:40%;">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span  >Export report </span> </h4>
      </div>
      <div class="modal-body">
	<div class="row ">
		<div class="col-lg-6 text-center" >
			<div class="{{columnList.length>0?'':'hidden'}}" >
				 <span class="btn btn-success btn-md ab-spaceless"  onclick="doDoc(1);" >Export with column titles</span>			
			</div>
		</div>
		<div class="col-lg-6  text-center" >
			<div class="{{columnList.length>0?'':'hidden'}}" >
				 <span class="btn btn-success btn-md ab-spaceless" onclick="doDoc(0);" >Export no column titles</span>			
			</div>
		</div>
		<div class="col-lg-12" >
			&nbsp;
		</div>
		
	</div>      
      
      </div>

    </div>

  </div>
</div>

<script>

function doDoc( flag )
{
	
$("#downloadName").val($("#supplierCode").val()+".tsv");

var dhtml = "";
var tab = "";
if (flag > 0)
{
	$(".rptHeading").find("td").each(function(){
	dhtml += tab + $(this).html();
	tab = "\t";
	});
	dhtml += "\n"
}

$(".rptDetail").each(function(){
tab = "";
$(this).find("td").each(function(){
	dhtml += tab + $(this).html();
	tab = "\t";
});	
dhtml += "\n"
});

if (dhtml=="")
{
	alert ("Nothing to export");
	return;
}

$("#txt").val(dhtml)
$("#go").click();

}





</script>   
<div class="hidden">
<form action="unlinkFile.php" method="post" >
<input id="fName" name="fName" value="PosData.tsv" />
<input id="downloadName" name="downloadName" />

<textarea id="txt" name="txt"></textarea>
<input type="submit" id="go" value="go" />

</form>

</div>
