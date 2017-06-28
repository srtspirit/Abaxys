<!-- 	vbp_cparm -->

<div ab-params="vbp_cparm" class="hidden"></div>

<div ng-if="ABorgDimensions"  class="{{ABsearchTbl=='ABsearchvbp_cparm'?'':'hidden'}}" >
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "STD_MENU";
$sparm["searchTable"] = "vbp_cparm";
 
// $sparm["searchJoin"] = "vgl_chart";
$sparm["searchResult"] = "ABsearchvbp_cparm";
$sparm["searchFilter"] = "hidd2en";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VBP_CPARM_PRMID";
$hardCode = $xtmp->setSearchMaster($sparm);
// echo $hardCode;


$chartDsp =<<<EOC

<div class="ab-wrapper-divsm" >
<table style="width:100%;" >
<tr class="ab-hover {{ glDta.idVGL_CHART==repDet.VBP_CPARM_GLIDN?'ab-strong text-primary ab-underline':'' }}" ng-click="repDet.VBP_CPARM_GLIDN_new=glDta.idVGL_CHART;repDet.VGL_CHART_GLIDN_new=glDta.VGL_CHART_GLIDN;repDet.VGL_CHART_GLDES_new=glDta.VGL_CHART_GLDES;"  ng-repeat="glDta in ABsearchvgl_chart | AB_Sorted:'VGL_CHART_GLIDN' " >
<td class="" >{{glDta.VGL_CHART_GLIDN}}</td>
<td>{{glDta.VGL_CHART_GLDES}}</td>
<td class="{{ glDta.idVGL_CHART==repDet.VBP_CPARM_GLIDN?'small text-right':'hidden' }}" >
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
$chartCode = "";
$chartDsp = "";

?>


<table ng-init="" >
<tr>
<td class="hidden" >
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvbp_cparm'" ng-init="ABsearchAlias('vbp_cparm','',ABsPatternABsearchvbp_cparm,'ABsearchvbp_cparm','','','','')">
	<span id="ab-org-master-mess"></span>
	
</td>
</tr>
</table>

	
	<div class="ab-wrapper-div">
		<div class="row text-primary ab-strong" style="width:100%;" >
				
				<div class="col-lg-1" ><span ab-label="VGL_BRCH_GLBID">Branch</span></div>
				<div class="col-lg-9" style="vertical-align:top;" >

					<div class="row">
						<div class="col-lg-3" ><span ab-label="">Parameter Name</span></div>
						<div class="col-lg-3" ><span ab-label="STD_ID_CODE">Code</span></div>
						<div class="col-lg-2" ><span ab-label="STD_REFERENCE">Value</span></div>
						<div class="col-lg-1" ></div>
						<div class="col-lg-1" ><span ab-label="">Format</span></div>
					</div>
				</div>
				
				
		</div>
	</div>
	<div class="ab-wrapper-div">
		
			<div class="row  ab-border ab-spaceless" ng-repeat="rep in ABsearchvbp_cparm | AB_noDoubles:'VBP_CPARM_PRMID,VBP_CPARM_AB_DILEVEL'  | AB_Sorted:'VBP_CPARM_AB_DILEVEL,VBP_CPARM_PRMID' " >
				<div class="col-lg-1" style="vertical-align:top;" >
		
					<span ng-repeat="org in ABorgDimensions" >
						<span class="text-muted ab-border ab-spaceless small"  
						ng-if="rep.VBP_CPARM_AB_DILEVEL.indexOf(',' + org.levelId )!=-1">
							<span class="ab-pointer" >
								&nbsp;{{org.levelDescr}}
							</span>	
							&nbsp;
						</span>
					</span>
				</div>
				<div class="col-lg-9" style="vertical-align:top;" >
				
				
					<div title="{{ rep.VBP_CPARM_PRMID}}"
					class="row  ab-underline ab-spaceless"  ng-repeat="repDet in ABsearchvbp_cparm | AB_noDoubles:'idVBP_CPARM'  | AB_Sorted:'VBP_CPARM_PRMNA' " 
					ng-if="rep.VBP_CPARM_PRMID==repDet.VBP_CPARM_PRMID && rep.VBP_CPARM_AB_DILEVEL==repDet.VBP_CPARM_AB_DILEVEL"
					>
						<div class="col-lg-3" style="vertical-align:top;" >
					<span class="small" ab-label="VBP_CPARM_{{rep.VBP_CPARM_PRMID}}" >
						 {{repDet.VBP_CPARM_DESCR}}
					</span>
						
						
						</div>
						<div class="col-lg-3" style="vertical-align:top;" >

						<div ng-if="ABsearchvbp_cparm[0].idSelect!=repDet.idVBP_CPARM" >

						<input class="hidden" ng-model="repDet.VBP_CPARM_PRMVA_new" ng-init="repDet.VBP_CPARM_PRMVA_new=repDet.VBP_CPARM_PRMVA" />
						
						</div>

							
							{{ repDet.VBP_CPARM_PRMNA }}
						</div>
						<div class="col-lg-3" style="vertical-align:top;" >
						

						<form id="mainForm" ab-main="vbp_cparm" ng-if="ABsearchvbp_cparm[0].idSelect==repDet.idVBP_CPARM" >
						<table>
						<tr>
							<td>
								
								<textarea class="hidden" ab-updSuccess="" >
									$scope.ABsearchAlias('vbp_cparm','',$scope.ABsPatternABsearchvbp_cparm,'ABsearchvbp_cparm','','$scope.ABsearchvbp_cparm[0].idSelect=0;','','')
								</textarea>	
								
								<input class="hidden" ng-model="idVBP_CPARM" ng-bind="idVBP_CPARM=repDet.idVBP_CPARM" />
								<input class="hidden" ng-model="VBP_CPARM_PRMVA" ng-bind="VBP_CPARM_PRMVA=repDet.VBP_CPARM_PRMVA_new" />
		
								<input class="hid2den" ng-model="repDet.VBP_CPARM_PRMVA_new" ng-init="repDet.VBP_CPARM_PRMVA_new=repDet.VBP_CPARM_PRMVA" />
								<input class="hidden" ng-model="repDet.idVBP_CPARM" />
							</td>	
							<td>
								<div class="btn btn-success ab-spaceless" ng-click="ABupd('UPDATE');"
									ng-if="repDet.VBP_CPARM_PRMVA_new!=repDet.VBP_CPARM_PRMVA"
								>
									Update
								</div>
							</td>
						</tr>	
						</table>

						</form>
						

							<div ng-if="ABsearchvbp_cparm[0].idSelect!=repDet.idVBP_CPARM" >

							<span  ng-click="ABsearchvbp_cparm[0].idSelect = repDet.idVBP_CPARM" 
							class="ab-pointer text-primary" tid="$('#PARM{{idVBP_CPARM}}').focus()" oncl2ick="setTimeout($(this).attr('tid'),500);">	
							&nbsp;						
								<span class="glyphicon glyphicon-pencil"></span>
								{{ repDet.VBP_CPARM_PRMVA}} 

							&nbsp;	
							</span>

							</div>
														
						</div>

						<div class="col-lg-2 small" style="" >
							{{repDet.VBP_CPARM_PSEUD.slice(3)}}
						</div>
						<div class="col-lg-1" style="" >
							
						</div>
					</div>
				
				</div>
				
				<div class="col-lg-1" style="" >

					<span ng-if="$last==true"><span ng-init="ABgetLabels();"></span></span>
				</div>
			</div>
		
	</div>
</div>

