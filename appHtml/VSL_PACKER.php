<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VSL_ORDERS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;

$tFnc = new AB_querySession;
$isAdmin = $tFnc->isUserAdmin();
$currUsr = $tFnc->getUserData();

?>
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


.ADdropdown {
    display: none;
}

.ADdropdown-content {

    display: block;
    position: absolute;
    min-width:350px;
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


</div>
<div class="hidden" 
	ng-init="
		SESSION_DESCR='Sales Packing';
		getVSL_PACK();
	" >
<!--
		idVSL_ORHE=0;ABlstAlias('idVSL_ORHE','idVSL_ORHE','vsl_packerChk','vsl_pack');
		getUsers();


-->
	<input class="hidden" ng-model="idVSL_ORHE" />
	<input class="hidden" ng-model="vin_inveQuery" />
	<input class="hidden" ng-model="vin_item_specs" />
	<input class="hidden" ng-model="vin_item_lots" />
	<input class="hidden" ng-model="orderSelected"  />
	<input class="hidden" ng-model="packPrint" ng-init="packPrint=0" />
	
	<span ab-label="VSL_VARIANCES"></span>
	
	
<textarea class="hidden" ab-updSuccess="" >

$scope.initPackOrder($scope.idVSL_ORHE,$scope.VSL_ORST_PAKID)
$scope.packPrint = $scope.VSL_ORST_PAKID;

//	$scope.setFormPackOff($scope.VSL_ORST_PAKID);
//	$scope.idVSL_ORHE=0;
//	$scope.ABlstAlias('idVSL_ORHE','idVSL_ORHE','vsl_packerChk','vsl_pack');
	
	
	
	

</textarea>	
</div>

<div style="margin-left:5px;"   >

	<div style="margin:0px;"  >
	
		<div class="row ">
			<div class="col-lg-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
				
			</div>
			<div class="col-lg-12">
				<table style="width:100%;" >
					<tr>
					  	<td class="hidden"  style="width:15%;" >
					  		<div title="" ng-init="collaps=0">
					  			<span  onclick="$('#bcollaps').click();collapseall(0);" class="btn-link " title="">
					  				<span class="glyphicon glyphicon-zoom-out " title=""></span>
					  			</span>
								<span onclick="$('#bcollapsIn').click();collapseall(1);" class="btn-lg btn-link " title="">
									<span class="glyphicon glyphicon-zoom-in " title="">
									</span>
								</span>
								<input class="hidden" id="bcollaps" ng-model="collaps" ng-click="collaps = 0;" size=2 />
								<input class="hidden" id="bcollapsIn" ng-model="collaps" ng-click="collaps = 1;" size=2 />
							</div>
						</td>
						<td id="ab-new"   style="width:80%;" >
							<label  title="CREATE" class="">
	 				 			 <a  class="bg=danger" 
							href="#VSL_ORDERS/VSL_ORHECT/Process:VSL_ORDERS,Session:VSL_ORHECT,tblName:vsl_orhe,updType:CREATE,idVSL_ORHE:0,tbData:{{tbData}}" 
							>
								<span ab-label="VSL_ORHE">Order</span>
								<span ab-label="STD_NEW">New</span>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>			
							</label>
						</td>
					<td class="hidden"  style="width:5%;" >	  
<?php
	$xtmp = new appForm("VSL_ORDERS");
	$hardCode = <<<BOD
			<div>
				<span ab-empty="{{tbData=='vsl_orhe'?'vsl_orhe':'Yes'}}"
				class="" >
				<input a_iref="02-60"
							size=15
							lval=""
							ng-change="FLT_ORHE_ORNUM=VSL_ORHE_ORNUM;VSL_ORHE_ORNUM=' ';ABlstAlias('VSL_ORHE_ORNUM','VSL_ORHE_ORNUM,FLT_ORHE_ORNUM','vsl_orhe',0);VSL_ORHE_ORNUM=FLT_ORHE_ORNUM;"
							ng-model="VSL_ORHE_ORNUM" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>

				</span>
			</div>
			<input class="hidden"  id="FLT_ORHE" ab-filter="vsl_orhe" ab-filter-cond="CONTAINS" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  

				ab-filter-model="VSL_ORHE_ORNUM,VSL_ORHE_CUSPO,VSL_ORHE_USLNA,VGB_CUST_BPNAM,VGB_ADDR_DESCR,VGB_SLRP_SLSRP,VIN_ITEM_ITMID,VIN_ITEM_DESC1,VSL_ORDE_ODATE,VSL_ORDE_DDATE"

				ng-model="FLT_ORHE_ORNUM" />
BOD;
$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="STD_SEARCH";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;

$xtmp->setFieldWrapper("view01","0.0","vsl_orhe","VSL_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>
					</td>
				</tr>
				</table>
				<table style="width:100%;" >
				<tr>
					<td style="width:10%;padding-top:10px;vertical-align:top;">&nbsp;
						
						<button ab-label="STD_REFRESH" 
							ng-click="packPrint=0;setFormPackOff(VSL_ORST_PAKID);idVSL_ORHE=0;ABlstAlias('idVSL_ORHE','idVSL_ORHE','vsl_packerChk','vsl_pack');"
						>Sales</button>
						
								
					</td>	
					<td style="width:65%;padding:0px;padding-top:10px;padding-left:100px;" >

					<div ng-if="packPrint!=0">
					<span ng-init="initOrderORSI();"></span>
				<button  ng-repeat="docs in vsl_orheOrsi[0].rowSet | AB_noDoubles:'idVSL_ORSI'"  ng-if="docs.VSL_ORSI_ORNUM==idVSL_ORHE && docs.idVSL_ORSI == packPrint" >
				
				<span class="small ab-pointer" 
				ng-repeat="step in VSL_STEP_LIST" ng-if="step.name==docs.VSL_ORSI_STEPS && step.shade!='hidden' && step.form.length>0"
				ng-click="selectCurrentForm(step,docs.VSL_ORSI_GRPID,docs.idVSL_ORSI )"
				style="white-space:nowrap;max-width:150px;padding:0px;">
					
					<span  >
						Print
				        	&nbsp;&nbsp;{{step.labeltext}}
				        	<span class="glyphicon glyphicon-triangle-right text-primary " ></span>
				        	#{{ docs.VSL_ORSI_GRPID }}
				       	</span>
					
				</span>
				
				</button>
					
					</div>
					
		<div class="row well ab-spaceless  {{packPrint!=0||orderSelected==0||orderSelected==varRow.VSL_ORST_PAKID?'hidden':''}}  " style="border-color:RoyalBlue;" >
		<form id="mainForm" name="mainForm"  ab-context="1" ab-view="vsl_orhe" ab-main="vsl_orhe"  >
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left " >
				<table  style="width:100%">
				<tr>
				<td style="width:5%;" >
		
		
	
					<input type="button" 
					 	class="ab-pointer small"
						ng-click="setFormPackOff(varRow.VSL_ORST_PAKID);"
					 	value="Cancel"
					/>
					
				</td>
				<td style="width:65%;">	
				&nbsp;	
					
					<input type="button" ng-if="allPicksSelected==true&&VSL_ORSI_REISS==0&&stpSelName!=''" ng-init="VSL_ORSI_PROCE='1'" 
					 class="ab-pointer small"
					 ng-click="ABupd('UPDATE');" value="All confirmed. Process" />
					
					<input type="button" ng-if="VSL_ORSI_REISS!=0" ng-init="VSL_ORSI_PROCE='0';stpSelName='';initAllocDashBoard();" 
					class="ab-pointer small"   
					ng-click="initAllocDashBoard();ABupd('UPDATE');" value="Save and re-issue" />		
					
				</td>
				<td style="width:30%;white-space:nowrap;">
				
<?php
$xtmp = new appForm("VSL_ORHE");
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr["class"] .= " small ";
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$hardCode = $xtmp->setYesNoField("VSL_ORSI_REISS");
// $xtmp->setFieldWrapper("view01","0.122","vsl_orde","x.VSL_ORDE_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo "<div><table><tr><td class='small'>Re-Issue&nbsp;</td><td class='small' >" . $hardCode . "</td></tr></table></div>";
 
?>
<input class="hidden" ng-if="allPicksSelected==true&&VSL_ORSI_REISS==0&&stpSelName!=''"  size=5 ng-model="VSL_ORSI_PROCE" ng-init="VSL_ORSI_PROCE=1"  />		
				
				
				<span class="hidden" ng-if="stpSelName!=''">
					&nbsp;
					<small ng-if="stpSelName!=''" ng-init="DOC_ORST=''" class="{{stepRetract!=true?'':'bg-danger'}} text-primary ab-pointer ab-border ab-spaceless" onclick="deflectVal('','DOC_ORST');$('[xlineSel]').click();" >
						Select&nbsp;All&nbsp;
					</small>
					&nbsp;			
					<small ng-if="DOC_ORST.length>0" 
					class="{{stepRetract!=true?'':'bg-danger'}} text-primary ab-pointer ab-border ab-spaceless" 
					onclick="deflectVal('','DOC_ORST');$('[xlineSel]').val(false);" >
						&nbsp;Clear&nbsp;
					</small>
		
				</span>
				
				</td>
				</tr>
				<tr>
					
					<td  colspan=3 class="small"  ng-if="allPicksSelected==true&&VSL_ORSI_REISS==0&&stpSelName!=''" >
					
						<div class="well ab-spaceless" style="padding-top:10px;" >
							<table style="width:100%;padding-top:10px;" >
							<tr>
							<td  style="white-space:nowrap;" >
								<input class="hidden" id="VGB_SUPPsearch" 
									ng-click="								
									VGB_SUPP_BPNAM = abSessionResponse.VGB_SUPP_BPNAM;
									VSL_ORSI_BPART = abSessionResponse.idVGB_SUPP;
									SUPPLIER_BPART = abSessionResponse.VGB_BPAR_BPART
									"

								/>
								<a class="ab-pointer" 
								ng-click="ABsessionLink('#/VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_supp,SourceProcess:VSL_SALES','#VGB_SUPPsearch');" >
							
								<span class="glyphicon glyphicon-search" ></span>
								Transporter
								</a>&nbsp;
								<input class="hidden" ng-model="VSL_ORHE_BTCUS" />

							</td>
							<td   style="white-space:nowrap;">	
								<input class="hidden" ng-model="VSL_ORSI_BPART" />
								<span class="ab-strong" >{{ VGB_SUPP_BPNAM }}</span>	
							</td>
							<td  style="white-space:nowrap;" class="text-primary ab-strong" >	
								&nbsp;&nbsp;Waybill#&nbsp;
							</td>
							<td   style="white-space:nowrap;">
								<input size=15 ng-model="VSL_ORSI_REFER" /> 
							</td>
							</tr>
							</table>
						</div>
					</td>
						
					
				</tr>
				
				</table>
			</div>

			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 small text-right"  >
				
		
				<ul class="nav nav-pills   ab-pointer {{VSL_ORSI_REISS!=0?'hidden':''}}" role="tablist" ng-init="initAllocDashBoard()" >
				<li class="dropdown ab-spaceless {{stepRetract!=true?'':'bg-danger'}} " >
				<a class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;min-width:75px;padding:0px;">
				<span class="caret"></span>
				<span>
					&nbsp;
					 {{stpSel}}
					 &nbsp;&nbsp;&nbsp;
				</span>
				
				</a>
				<ul class="dropdown-menu " role="menu"  >
				<li class="bg-warning" 
				ng-if="vsl_orhe[0].IV_VSL_STEPS_VALID.indexOf(step.name)>-1 && step.shade!='hidden' && step.name == 'II_DELI' " 
				ng-repeat="step in VSL_STEP_LIST"  >
				<a class=" ab-pointer" ng-click="initAllocDashBoard(step.name,step.labeltext)" style="white-space:nowrap;max-width:150px;padding:0px;">
					
					<span >
									
				        	&nbsp;&nbsp;
				        	<span ng-if="stepRetract==true" class="glyphicon glyphicon-triangle-left text-danger " ></span>
				        	{{step.labeltext}}
				        	<span ng-if="stepRetract!=true" class="glyphicon glyphicon-triangle-right text-primary " ></span>
				       	</span>
					
				</a>
				
				</li>
				<li class="bg-warning" ng-if="stpSelName!=''"  >
				        <a class="ab-pointer" ng-click="initAllocDashBoard();" style="white-space:nowrap;max-width:150px;padding:0px;">
					Reset step selection
					</a>
				</li>		
				</ul>
				</li>
				</ul>
		
		
		
			</div>

			<div  class="col-lg-2 col-md-2 col-sm-12 col-xs-12 small text-right"  >
			
			<span class="hidden" data-toggle="modal" data-target="#ORHE_ALLOC" ng-init="vin_inveQuery=''" >GO</span>
		
				<ul class="nav nav-pills  ab-pointer" role="tablist" >
				<li class="dropdown ab-spaceless " >
				<a class="dropdown-toggle " data-toggle="dropdown"
				 ng-click="initOrderORSI();" 
				 style="white-space:nowrap;min-width:75px;padding:0px;">
				
				<span class="caret"></span>
				<span >
					&nbsp;
					 {{formSel}}
					 &nbsp;&nbsp;
				</span>
				
				</a>
				
				<ul class="dropdown-menu " role="menu"   ng-init="selectCurrentForm();">
				<li class="bg-warning" ng-repeat="docs in vsl_orheOrsi[0].rowSet | AB_noDoubles:'idVSL_ORSI'"  ng-if="docs.VSL_ORSI_ORNUM==idVSL_ORHE" >
				
				<a class="small ab-pointer" 
				ng-repeat="step in VSL_STEP_LIST" ng-if="step.name==docs.VSL_ORSI_STEPS && step.shade!='hidden' && step.form.length>0"
				ng-click="selectCurrentForm(step,docs.VSL_ORSI_GRPID,docs.idVSL_ORSI )"
				style="white-space:nowrap;max-width:150px;padding:0px;">
					
					<span  >
				        	&nbsp;&nbsp;{{step.labeltext}}
				        	<span class="glyphicon glyphicon-triangle-right text-primary " ></span>
				        	#{{ docs.VSL_ORSI_GRPID }}
				       	</span>
					
				</a>
				
				</li>
				<li class="bg-warning" ng-if="formSelName!=''"  >
				        <a class="small" ng-click="selectCurrentForm();" style="white-space:nowrap;max-width:150px;padding:0px;">
					Reset Document selection
					</a>
				</li>		
				</ul>
				</li>
				</ul>
		
		
			
				<button id="doccset" class="hidden" 
				onclick="
				deflectValText(localSetDocDta($('[tcpdform]').text()),'htmlText');
				deflectVal(1,'formSubmit');
				$('[fosub]').click();
				deflectVal(0,'formSubmit');
				" >
				Form
				</button>
		
			</div>				
			</form> 
		</div>		
					
					</td>
					<td style="width:25%;">
					</td>
									
				</tr>
			</table>
			</div>
		</div>
		
	<script>
		$('#ab-buttonPad').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
	</script>
<?php





function setRowDspField($name,$size,$text,$filter,$sort,$label,$class)
{

//        ng-init= "varRow.on=(ACVarColSetIsOn('" . $name . "',varRow." . $name . ")!=true?'hidden':'')"
	$retVal = "<input ng-init=" . '"' . "varRow.on=(ACVarColSetIsOn('" . $name . "',varRow." . $name . ")!=true?'hidden':'')".'"'." readOnly class='ab-borderless ". $class . " ' ";
	$retVal .= "title='{{" . $name ."}}' ";
	$retVal .= "size=" . $size . " ";
	$retVal .= "ab-ilabel='" . $label . "'  ";
	$retVal .= " style='background-color:inherit;' ";
	$retVal .= "ng-model='" . $name . "'  ";
	
	$retVal .= "/>";
	
	
	
	// $retVal = "<table style='width:99%' title='{{" . $name ."}}'  ><tr><td style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;min-width:40px;max-width:80%;' >" . $retVal . "{{ " . $name . "}} </td></tr></table>";
	
	return $retVal ;

	
}

function setHeadField($name,$size,$text,$filter,$sort,$label,$class)
{
	$ngif="1<0";
	$ngelse="1<0";
	$ngclick="";
	$abpointer = "";


	$trn = array();
	$filterSwitch = '<span class="small glyphicon glyphicon-filter invisible "  ></span>';
	
	if ($filter!="")
	{
		$filterSwitch = '<span ng-click='. "'" . 'ACVarFilterToggle("' . $name . '")' . "'" . ' class="bg-primary ab-border ab-pointer ab-spaceless " >&nbsp;X&nbsp;</span>';
		
		$trn[count($trn)] = '<div id="flt' . $name . '" class=" ACdropdown "  >';
		$trn[count($trn)] = '<div class="ACdropdown-content" >';
		$trn[count($trn)] = '<table style="width:95%;margin:10px;padding:3px;" class="table-striped  ab-spaceless bg-success " role="tablist" >';
		$trn[count($trn)] = ' 	<tr>';


		$trn[count($trn)] = ' 		<td  class="text-top ab-pointer " ';
		$trn[count($trn)] = ' 		ng-click="list' . $name . "='';ACVarFilterInit('" . $name . "','');" . '" >';
		$trn[count($trn)] = ' 		<div  class="ab-pointer" title="Clear all" >&nbsp;&#9744;&nbsp;</div></td>';
//		$trn[count($trn)] = ' 		<td></td>';
		$trn[count($trn)] = ' 		<td title="Select all" class="text-top ab-pointer" ';
		$trn[count($trn)] = ' 		ng-click="list' . $name . "='-1';ACVarFilterInit('" . $name . "','');" . '" >';

//		$trn[count($trn)] = ' 		ng-click="list' . $name . '=Orglist' . $name . ';ACVarFilterInit();" >';

		$trn[count($trn)] = ' 		<span class="ab-pointer " >&nbsp;&#9745;&nbsp;</span></td>';
		$trn[count($trn)] = ' 		<td>&nbsp;</td>';
		$trn[count($trn)] = ' 		<td colspan=3 class="text-center" >';
		$trn[count($trn)] = ' 			<input readonly class="ab-borderless" size=15 value="Filter selection" />';
		$trn[count($trn)] = ' 			<input ng-model="list' . $name . '" ng-init="list' . $name . "=''" . '" class="hidden" />';
		$trn[count($trn)] = ' 			<input ng-model="Orglist' . $name . '" ng-init="Orglist' . $name . "=''" . '" class="hidden" />';
		$trn[count($trn)] = ' 		</td>';
		
		$trn[count($trn)] = ' 		<td class="text-top" rowspan=2000 style="vertical-align:top;" >'. $filterSwitch . '</td>';
		$trn[count($trn)] = ' 	</tr>';
		$trn[count($trn)] = ' 	<tr><td class="ab-border ab-spaceless" colspan=100></td></tr>';
		$trn[count($trn)] = '<tr class=""'; 
		$trn[count($trn)] = '	ng-repeat="varRow in  rawResult.vsl_pack | AB_noDoubles:'. "'". $name. "'" .' | AB_Sorted:'."'".$name."'".'  " >';
		$trn[count($trn)] = ' 		<td class="text-center ab-pointer ab-border ab-spaceless" ';
		$trn[count($trn)] = ' 		ng-init="list' . $name . '=list' . $name . " + ',' + varRow." . $name . "+ ','" . '" ';
		$trn[count($trn)] = ' 		>';
//		$trn[count($trn)] = ' 		</td>';
//		$trn[count($trn)] = '		<td class="text-left ab-pointer ab-border ab-spaceless"  >';
		
//		$trn[count($trn)] = '		{{ACVarColSetIsOn('. "'" . $name ."',varRow.".$name.')}}';

		$trn[count($trn)] = '			<span ng-click="ACVarColSelToggle('. "'" . $name ."',varRow.".$name.');" class="{{ACVarColSetIsOn('. "'" . $name ."',varRow.".$name.')==true?'."'':'hidden'}}".'" checked type="checkbox" >';
		$trn[count($trn)] = '			<span class="glyphicon glyphicon-ok"></span></span>';
		$trn[count($trn)] = '			<span ng-click="ACVarColSelToggle('. "'" . $name ."',varRow.".$name.');" class="{{ACVarColSetIsOn('. "'" . $name ."',varRow.".$name.')!=true?'."'':'hidden'}}".'" type="checkbox" >';
		$trn[count($trn)] = '			<span class="glyphicon glyphicon-ok invisible"></span></span>';
		$trn[count($trn)] = '	        </td>';
		$trn[count($trn)] = ' 		<td>&nbsp;</td>';
		$trn[count($trn)] = ' 		<td>&nbsp;</td>';
		$trn[count($trn)] = '	        <td class="text-left">';
		$trn[count($trn)] = '	        	<span  >';
		$trn[count($trn)] = '	        	<input class="hidden" ng-model="varRow.' . $name . '"  ng-init="ACVarColSelToggle('. "'" . $name ."',varRow.".$name.');" />';
		$trn[count($trn)] = '	        		{{varRow.'. $name. '}}';
		$trn[count($trn)] = '	        	</span>';
		$trn[count($trn)] = '	        </td>';
		$trn[count($trn)] = '	</tr>';
		$trn[count($trn)] = '</table>';
		$trn[count($trn)] = '<div class="text-center bg-primary ab-pointer ab-spaceless " ng-click="ACVarFilterHide();" >close</div>';
		$trn[count($trn)] = '</div>';
		
		$trn[count($trn)] = '</div>';
		
		$dspColor='{{list' . $name . ".length!=Orglist" . $name . ".length && Orglist" . $name . "!=''?'bg-warning text-primary':''}} "; 
		// $filterSwitch = '<span onclick='. "'" . '$("#flt' . $name . '").toggleClass("ACdropdown");'."'".' class="small glyphicon glyphicon-filter" ></span>';
		$filterSwitch = '<span ng-click='. "'" . 'ACVarFilterToggle("' . $name . '")' . "'" . ' class="ab-pointer small glyphicon glyphicon-filter ' . $dspColor . ' " ></span>';

	}
	
	$filterHtml = implode("",$trn);
	$inputStyle = "style='background-color:inherit;'";
	
	if ($sort != "")
	{
		$ngif='(","+extraSort+sortBy+",").indexOf(",' . $name . ',")>-1';
		$ngelse="(','+extraSort+sortBy+',').indexOf('," . $name . ",')==-1";

		$abpointer=" ab-pointer ";
		
		if ($sort > 0)
		{
			$ngclick = "ng-click='extraSort=". '"' . $name . ',";' . "'";
			// $class .= " {{" . $ngif . '?"bg-info text-primary":""}} ';
		}
		if ($sort < 0)
		{
			$ngclick = "ng-click='extraSort=". '"' . '";' . "' ";
		}
		
		$inputStyle= "style='background-color:inherit;margin-left:10px;border-bottom:double;border-width:3px;" . " {{" . $ngif . '?"color:gold;":""}}' ."'";
	}
	

	
	
		
	$retVal = "<table><tr><td style='width:20px;text-align:center;' >" . $filterSwitch . "</td><td >";
	$retVal .= "<input title='sort by' readOnly class='ab-borderless small ". $class . $abpointer . " ' ";
	$retVal .= "value='" . $text ."' ";
	$retVal .= "size=" . $size . " ";
	$retVal .= "ab-ilabel='" . $label . "'  ";
	$retVal .= "ab-model='" . $name . "'  " . $inputStyle;

	$retVal .= $ngclick;

	
	$retVal .= "/></td></tr><tr><td colspan=100>". $filterHtml ."</td></tr></table>";
	
	return $retVal ;
	
}

?>


	<div class="row bg-primary " ng-init="extraSort='';sortBy='VSL_ORST_PDATE';" >
	
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless" ><?php echo setHeadField("VSL_ORHE_USLNA","5","C.S.R.","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless" ><?php echo setHeadField("VGB_BPAR_BPART","10","Customer","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3   hidden-xs hidden-md  hidden-sm ab-spaceless" ><?php echo setHeadField("VGB_CUST_DESCR","5","Name","","","","bg-primary "); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless" ><?php echo setHeadField("VSL_ORHE_ORNUM","5","Order #","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3  hidden-xs hidden-md  hidden-sm ab-spaceless" ><?php echo setHeadField("VSL_ORHE_CUSPO","5","Cust. Ref.","","","","bg-primary "); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 hidden-xs hidden-md  hidden-sm  ab-spaceless" ><?php echo setHeadField("VSL_ORST_PAKID","5","Packing Id.","","","","bg-primary "); ?>
		
			<!-- 

			-->
		</div>

		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless hidden-xs hidden-md  hidden-sm " ><?php echo setHeadField("VSL_ORSI_CDATE","8","Created","","","","bg-primary "); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless hidden-xs hidden-md  hidden-sm " ><?php echo setHeadField("VSL_ORSI_PROCE","5","Processed","","","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless hidden-xs hidden-md  hidden-sm " ><?php echo setHeadField("VSL_ORSI_REISS","5","Re-Issue","","","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless hidden-xs hidden-md  hidden-sm " ><?php echo setHeadField("VSL_ORSI_PDATE","5","Trans. Date","","","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless " ><?php echo setHeadField("VSL_ORST_PDATE","10","Planned Date","1","-1","","bg-primary"); ?></div>
		
<!--		
-->

	</div>	


	<div class="row">
 		<div ng-if="pickCheck==1" class="col-lg-2 well text-center" style="position:fixed;z-index:1;" >
 			<span class="text-danger" >One moment please</span>
 		</div>
 		<div ng-if="pickCheck!=1 && rawResult.vsl_pack.length==0" class="col-lg-2 well text-center" style="position:fixed;z-index:1;" >
 			<span class="text-primary" >Nothing to pack</span>
 		</div>						
 								
	</div>
		
	
		<div class="row {{orderSelected==0||orderSelected==varRow.VSL_ORST_PAKID?'':'hidden'}} ab-odd ab-border ab-spaceless" id="rNum{{varRow.abIndex}}" 
			ng-repeat="varRow in  rawResult.vsl_pack | AB_noDoubles:'idVSL_ORHE,VSL_ORST_PAKID' | AB_Sorted:extraSort+sortBy " 
			
		>	

			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  "  >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORHE_USLNA","5","C.S.R.","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<?php echo setRowDspField("varRow.VSL_ORHE_USLNA","5","C.S.R.","","","","  "); ?>
							
						</td>
					</tr>
				</table>
			</div>
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12   " >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VGB_BPAR_BPART","10","Customer","","",""," text-primary visible-xs visible-md  visible-sm "); ?>
							
						</td>
						
						<td>			
							<?php echo setRowDspField("varRow.VGB_BPAR_BPART","15","Customer","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12   " >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VGB_CUST_DESCR","10","Name","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<?php echo setRowDspField("varRow.VGB_CUST_BPNAM","12","Name","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>


			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12   " >

				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORHE_ORNUM","5","Order #","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<div class="text-primary ab-pointer"
								ng-click="initPackOrder(varRow.idVSL_ORHE,varRow.VSL_ORST_PAKID);" > 
								<table>
									<tr>
									<td>
										<span class="glyphicon glyphicon-pencil text-primary"></span>
									</td>
									<td>							
										<?php echo setRowDspField("varRow.VSL_ORHE_ORNUM","10","Order #www as","","","","ab-pointer"); ?>
									</td>
		
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12   " >
				<table style="width:100%;" >
					<tr >
						<td style="width:30%;"  class="text-left ab-spaceless visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORHE_CUSPO","5","Cust. Ref.","","","","  text-primary visible-xs visible-md  visible-sm "); ?> 						
						</td>
						<td>			
							<?php echo setRowDspField("varRow.VSL_ORHE_CUSPO","15","Cust. Ref.","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12   " >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;" class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORST_PAKID","5","Pick Id","","","","text-primary visible-xs visible-md  visible-sm "); ?> 
						</td>
						
						<td style="width:5%;">
							<?php echo setRowDspField("varRow.VSL_ORSI_GRPID","5","Pick","","","","  "); ?>
						</td>
						<td></td>
					</tr>
				</table>
			</div>


			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORSI_CDATE","8","Created","","","","text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<?php echo setRowDspField("varRow.VSL_ORSI_CDATE","15","Created","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>


			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >

				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORSI_PROCE","10","Processed","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<span class="{{ varRow.VSL_ORSI_PROCE==1?'':'hidden' }}" >
								<?php echo setHeadField("VSL_ORSI_PROCE","5","Yes","","","",""); ?>						
							</span>
							<span class="{{ varRow.VSL_ORSI_PROCE==1?'hidden':'' }}" >
								<?php echo setHeadField("VSL_ORSI_PROCE","5","No","","","",""); ?>
							</span>
						</td>
					</tr>
				</table>
			</div>

		
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >

				<table style="width:100%;" >
					<tr>

						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORSI_REISS","10","Re-Issued","","","","text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>									
							<span class="{{ varRow.VSL_ORSI_REISS==1?'':'hidden' }}" >
								<?php echo setHeadField("VSL_ORSI_REISS","5","Yes","","","",""); ?>						
							</span>
							<span class="{{ varRow.VSL_ORSI_REISS==1?'hidden':'' }}" >
								<?php echo setHeadField("VSL_ORSI_REISS","5","No","","","",""); ?>
							</span>
						</td>
					</tr>
				</table>
			</div>

		
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >


				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORSI_PDATE","10","Picked Date","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>			
							<?php echo setRowDspField("varRow.VSL_ORSI_PDATE","10","Picked Date","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >


				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORST_PDATE","10","Planned Date","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>			
							<?php echo setRowDspField("varRow.VSL_ORST_PDATE","15","Planned Date","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

		

		

<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12   ">


	
	<div class="row text-primary text-left" ng-if="orderSelected==varRow.VSL_ORST_PAKID">
		<!-- orderSelected==0||orderSelected==varRow.VSL_ORST_PAKID -->
		
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  hidden-xs hidden-md  hidden-sm  ab-spaceless">
			<?php echo setHeadField("VSL_ORDE_ORLIN","5","Line","","","","text-primary"); ?>
		</div>

								

		<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 ab-spaceless  hidden-xs hidden-md  hidden-sm  ab-strong" ><?php echo setHeadField("VIN_ITEM_DESC1","10","Item","","","","text-primary"); ?></div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless  hidden-xs hidden-md  hidden-sm  ab-strong" ><?php echo setHeadField("VSL_ORDE_ORLIN","10","Step","","","","text-primary"); ?></div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless  hidden-xs hidden-md  hidden-sm  ab-strong" ><?php echo setHeadField("VSL_ORST_STPSQ","10","Qty","","","","text-primary"); ?></div>

<!--BGN-->

			



<!--END-->


	</div>
	<div 
		class="row hidden" 
		ng-repeat="rowDetail in  rawResult.vsl_pack | AB_noDoubles:'idVSL_ORST,idVSL_LSTR' | AB_Sorted:sortBy " 
		ng-if="rowDetail.VSL_ORST_PAKID==varRow.VSL_ORST_PAKID"
	 >
	
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" ></div>
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;" class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORDE_ORLIN","5","Line","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
						</td>
						
						<td style="width:5%;">
							<?php echo setRowDspField("rowDetail.VSL_ORDE_ORLIN","5","Line","","","","  "); ?>
						</td>
						<td style="width:5%;">	
							<?php echo setRowDspField("rowDetail.VSL_ORST_STPSQ","5","Step","","","","  "); ?>
						</td>
						<td></td>
					</tr>
				</table>
			</div>


			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VIN_ITEM_ITMID","10","Item","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<?php echo setRowDspField("rowDetail.VIN_ITEM_ITMID","15","Item","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>


			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 " >

				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VIN_ITEM_DESC1","10","Description","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<?php echo setRowDspField("rowDetail.VIN_ITEM_DESC1","30","Description","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

		
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >

				<table style="width:100%;" >
					<tr>

						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORST_ORDQT","10","Ord. Qty","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>									
							<?php echo setRowDspField("rowDetail.VSL_ORST_ORDQT","15","Ord. Qty","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

		
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >


				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORST_PDATE","10","Planned Date","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>			
							<?php echo setRowDspField("rowDetail.VSL_ORST_PDATE","15","Planned Date","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

		
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  ">
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VARIANCE","15","Variance","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>			
							{{ (ABGetDateFn('diff-today',rowDetail.VSL_ORST_PDATE )*-1) }}
						</td>
					</tr>
				</table>
			</div>
		</div>
</div>

			

		</div>
	
	
	
	<div id="formPick" class="row  ab-border {{orderSelected>0?'':'hidden'}}" ng-init="vslFormPg=2"  >	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
		------------------------------------------------
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
			<?php  require_once "VSL_ORHECT_PACK.php"; ?>
			
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
		------------------------------------------------
		</div>
	</div> 
	


</div>

<table class="table table-condensed hidden ">
	  <tr class="ab-spaceless">
	  		<td>
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vsl_orhe'?'vsl_orhe':'Yes'}}"
			class="hidden{{ tbData=='vsl_orhe'?'xxx':''}} text-primary" >
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vsl_orhe',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vsl_orhe',1)"  > </span>
			</span>
			</td>
	</tr>
	<tr>		  
	  	<td> 
		  <div class="visible-lg">
			&nbsp;
			<span ng-repeat="org in AB_DUSA.orgLevels |AB_Selected:AB_DUSA.usrLevels.CurrentAffect:'levelId' " class=" {{org.isSelected}} " >{{org.levelDescr}}</span>	
			
		  <div>
	  	</td>
	  </tr>
</table>	
</div>

<div class="hidden">

<?php require_once "VSL_ORDER_FORMS.php"; ?>

</div>

	
<div class='btn-sm ab-body-buttons hidden' >
	<span class='hidden'>
		Records per page:&nbsp;
		<input ab-mpp value="0" / >
		
		<select>
		  <option value="10">10</option>
		  <option value="20" >20</option>
		  <option value="40"  >40</option>
		  <option value="100" selected >100</option>
		</select>

	</span>
</div>

<script>

function collapseall(dir)
{
		
	$("[exp-list]").each(function()
	{
		if ($(this).hasClass("in"))
		{
			if (dir==0)
			{
				$("[data-target='#" + $(this).attr("id") + "']").click();
				
			}
		}
		else
		{
			if (dir==1)
			{
				$("[data-target='#" + $(this).attr("id") + "']").click();
				
			}
		}
		
	});
	
	
}
</script>

