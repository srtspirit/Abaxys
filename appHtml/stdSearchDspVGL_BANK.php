<!-- 	vgl_bank -->

<div ab-params="vgl_bank" class="hidden"></div>

<div ng-if="ABorgDimensions"  class="{{ABsearchTbl=='ABsearchvgl_bank'?'':'hidden'}}" >
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "STD_MENU";
$sparm["searchTable"] = "vgl_bank";
 
$sparm["searchJoin"] = "vgl_chart,vgb_curr";
$sparm["searchResult"] = "ABsearchvgl_bank";
$sparm["searchFilter"] = "hidd2en";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "";
$hardCode = $xtmp->setSearchMaster($sparm);
// echo $hardCode;


$chartDsp =<<<EOC

<div class="ab-wrapper-divsm" >
<table style="width:100%;" >
<tr class="ab-hover {{ glDta.idVGL_CHART==repDet.VGL_PACC_GLIDN?'ab-strong text-primary ab-underline':'' }}" ng-click="repDet.VGL_PACC_GLIDN_new=glDta.idVGL_CHART;repDet.VGL_CHART_GLIDN_new=glDta.VGL_CHART_GLIDN;repDet.VGL_CHART_GLDES_new=glDta.VGL_CHART_GLDES;"  ng-repeat="glDta in ABsearchvgl_chart | AB_Sorted:'VGL_CHART_GLIDN' " >
<td class="" >{{glDta.VGL_CHART_GLIDN}}</td>
<td>{{glDta.VGL_CHART_GLDES}}</td>
<td class="{{ glDta.idVGL_CHART==repDet.VGL_PACC_GLIDN?'small text-right':'hidden' }}" >
<span class="ab-border" ab-label="STD_ORIGINAL" > Org.</span> </td>
</tr>
</table>
</div>

EOC;

$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "hidden";
$sparm["searchTable"] = "vgl_chart";
 
$sparm["searchJoin"] = "";
$sparm["searchResult"] = "ABsearchvgl_chart";
$sparm["searchFilter"] = "hidden";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VGL_CHART_GLIDN";
$sparm["dspViewer"] = $chartDsp;
$chartCode = $xtmp->setSearchMaster($sparm);




$chartDsp =<<<EOC

<div class="ab-wrapper-divsm" >
<table style="width:100%;" >
<tr class="ab-hover {{ glDta.idVGL_CHART==repDet.VGL_PACC_GLIDN?'ab-strong text-primary ab-underline':'' }}" ng-click="repDet.VGL_PACC_GLIDN_new=glDta.idVGL_CHART;repDet.VGL_CHART_GLIDN_new=glDta.VGL_CHART_GLIDN;repDet.VGL_CHART_GLDES_new=glDta.VGL_CHART_GLDES;"  ng-repeat="glDta in ABsearchvgl_chart | AB_Sorted:'VGL_CHART_GLIDN' " >
<td class="" >{{glDta.VGL_CHART_GLIDN}}</td>
<td>{{glDta.VGL_CHART_GLDES}}</td>
<td class="{{ glDta.idVGL_CHART==repDet.VGL_PACC_GLIDN?'small text-right':'hidden' }}" >
<span class="ab-border" ab-label="STD_ORIGINAL" > Org.</span> </td>
</tr>
</table>
</div>

EOC;

$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "hidden";
$sparm["searchTable"] = "vgl_chart";
 
$sparm["searchJoin"] = "";
$sparm["searchResult"] = "ABsearchvgl_chart";
$sparm["searchFilter"] = "hidden";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VGL_CHART_GLIDN";
$sparm["dspViewer"] = $chartDsp;
$chartCode = $xtmp->setSearchMaster($sparm);


?>


<table ng-init="" >
<tr>
<td class="hidden" >
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvgl_bank'" ng-init="ABsearchAlias('vgl_bank','vgl_chart,vgb_curr',ABsPatternABsearchvgl_bank,'ABsearchvgl_bank','','','','')">
	<span id="ab-org-master-mess"></span>
</td>
</tr>
</table>

	
	<div class="ab-wrapper-div">
		<div class="row text-primary ab-strong" style="width:100%;" >
				
				<div class="col-lg-1" ><span ab-label="VGL_BRCH_GLBID">Branch</span></div>
				<div class="col-lg-2" ><span ab-label="STD_SOURCE">STD_SOURCE</span></div>
				<div class="col-lg-7" style="vertical-align:top;" >

					<div class="row">
						<div class="col-lg-2" ><span ab-label="STD_ID_CODE">Code</span></div>
						<div class="col-lg-2" ><span ab-label="STD_DESCRIPTION">Desc.</span></div>
						<div class="col-lg-2" ><span ab-label="">Sub Id</span></div>
						<div class="col-lg-3" ><span ab-label="VGL_CHART_GLIDN">Chart Id</span></div>
						<div class="col-lg-2" ><span ab-label="">Next Ctrl#</span></div>
						<div class="col-lg-1" ><span ab-label="">Confirm</span></div>
						
					</div>
				</div>
				
				
		</div>
	</div>
	<div class="ab-wrapper-div">
		
			<div class="row  ab-border ab-spaceless" ng-repeat="rep in ABsearchvgl_bank | AB_noDoubles:'VGL_BANK_SOURC,VGB_CURR_CURID,VGL_BANK_AB_DILEVEL' | AB_Sorted:'VGL_BANK_SOURC,VGL_BANK_CURID,VGB_BANK_PMTTY,VGL_BANK_AB_DILEVEL' " >
				<div class="col-lg-1" style="vertical-align:top;" >
		
					<span ng-repeat="org in ABorgDimensions" >
						<span class="text-muted ab-border ab-spaceless small"  
						ng-if="rep.VGL_BANK_AB_DILEVEL.indexOf(',' + org.levelId )!=-1">
							<span class="ab-pointer" >
								&nbsp;{{org.levelDescr}}
							</span>	
							&nbsp;
						</span>
					</span>
				</div>
				<div class="col-lg-2" >
					<span title="{{ rep.VGL_BANK_SOURC}}" aab-label="VGL_SOURCE_{{rep.VGL_BANK_SOURC}}" >
						{{ rep.VGL_BANK_SOURC}}&nbsp;&nbsp;&nbsp;{{rep.VGB_CURR_CURID}}-{{rep.VGB_CURR_DESCR}} 
					</span>
				</div>
				
				<div class="col-lg-7" style="vertical-align:top;" >
					<div class="row">

					</div>
				</div>
				<div ng-if="1==1" class="col-lg-7" style="vertical-align:top;" >
				
				
					<div class="row  ab-underline ab-spaceless"  ng-repeat="repDet in ABsearchvgl_bank | AB_Sorted:'VGL_BANK_TYDET' " 
					ng-if="rep.VGL_BANK_SOURC==repDet.VGL_BANK_SOURC && rep.VGB_CURR_CURID==repDet.VGB_CURR_CURID&& rep.VGL_BANK_AB_DILEVEL==repDet.VGL_BANK_AB_DILEVEL"
					>

						<div class="col-lg-2">
							{{repDet.VGL_BANK_TYDET}}
						</div>	
						<div class="col-lg-2">
							{{repDet.VGL_BANK_PMTDE}}
						</div>	
						<div class="col-lg-2">
							{{repDet.VGL_BANK_TDESC}}
						</div>	
						<div class="col-lg-3">
							{{repDet.VGL_CHART_GLIDN}}-{{repDet.VGL_CHART_GLDES}}
						</div>	
						<div class="col-lg-2">
							{{repDet.VGL_BANK_NEXCK }}
						</div>	
						<div class="col-lg-1">
							<span ab-label="{{repDet.VGL_BANK_CTRLV==1?'STD_YES':'STD_NO'}}" class="{{repDet.VGL_BANK_CTRLV==1?'ab-strong':''}}">
							</span>							
						</div>	
												
					</div>
				
				</div>
				
				<div class="col-lg-1" style="" >

					<span ng-if="$last==true"><span ng-init="ABgetLabels();"></span></span>
				</div>
			</div>
		
	</div>
</div>
