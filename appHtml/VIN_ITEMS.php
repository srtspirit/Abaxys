<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VIN_ITEMS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;


function setHeadField($rePeat,$name,$size,$text,$filter,$sort,$label,$class)
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
		$trn[count($trn)] = '	ng-repeat="varRow in  rawResult.' . $rePeat . ' | AB_noDoubles:'. "'". $name. "'" .' | AB_Sorted:'."'".$name."'".'  " >';
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

<style>

.ACdropdown {
    position: relative;
    display: inline-block;
}

.ACdropdown-content {
    display: none;
    position: absolute;
    background-color:white;
    min-width: 350px;
    box-shadow: 8px 8px 8px 8px rgba(0,0,0,0.2);
    padding: 5px 5px;
    z-index:1;
}

.ACdropdown:hover .ACdropdown-content {
    display: block;
}

</style>


</div>
<div class="hidden" ng-init="SESSION_DESCR='Item Control';FLT_ITEM_FIELD='VIN_ITEM_ITMID';">
	<span ab-label="VIN_ITEMCT"></span>
</div>

<div id="ab-new" >
	<label  title="CREATE" class="">
		 <a  target="{{ABtarget}}" href="#VIN_ITEMS/VIN_ITEMCT/Process:VIN_ITEMS,Session:VIN_ITEMCT,tblName:vin_item,updType:CREATE,idVIN_ITEM:0" >
			<span >New</span>
			<span  class="glyphicon glyphicon-pencil" ></span>
		</a>			
	</label>
</div>

<div style="margin-left:5px;">
	<div id="mainForm" ab-main="vin_item" style="margin:0px;padding:0px;">
		<div class="row">
			<div class="col-sm-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
		</div>
		<div class="ab-spaceless  " style="vertical-align:top;padding:0px;margin:0px;" >
				<table style="width:80%;vertical-align:top;" class="ab-spaceless  " >
					<tr>
						<td style="width:15%;vertical-align:top;"></td>
					</tr>
					<tr>
						<td>
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
						<td>

							<span class="text-primary">
									<span ab-label="STD_SEARCH">Search In</span>&nbsp;
							</span>
								

						</td>
						<td>
						
						 
						</td>
					</tr>
										
					<tr>
			  
			<td>
			<div>
				<span ab-empty="{{tbData=='vin_item'?'vin_item':'Yes'}}"
				class="" >
				<!-- AC20160426 -->
					<input a_iref="02-60"
							size=15
							lval=""
							gng-keyup="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',0);"
							ng-change="FLT_ITEM_ITMID=VIN_ITEM_ITMID;VIN_ITEM_ITMID=' ';VIN_ITEMSlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,FLT_ITEM_LOTCT,FLT_ITEM_ITMID','vin_item','vin_item');VIN_ITEM_ITMID=FLT_ITEM_ITMID;"
							
							gng-blur="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',0);"
							ng-model="VIN_ITEM_ITMID" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>
	
				</span>
			</div>
			</td>
			<td>
				<div style="font-size:4pt;">&nbsp;</div>

				<span class="text-primary">
					
					<input type="radio"  name="LOTCT" ng-click="FLT_ITEM_LOTCT='1';VIN_ITEM_ITMID=' ';VIN_ITEMSlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,FLT_ITEM_LOTCT,FLT_ITEM_ITMID','vin_item');VIN_ITEM_ITMID=FLT_ITEM_ITMID;" />&nbsp;Lot Only
					&nbsp;&nbsp;
					<input type="radio"  name="LOTCT" ng-click="FLT_ITEM_LOTCT='0';VIN_ITEM_ITMID=' ';VIN_ITEMSlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,FLT_ITEM_LOTCT,FLT_ITEM_ITMID','vin_item');VIN_ITEM_ITMID=FLT_ITEM_ITMID;" />&nbsp;Non Lot Only
					&nbsp;&nbsp;
					<input type="radio"  name="LOTCT"  checked ng-click="FLT_ITEM_LOTCT='';VIN_ITEM_ITMID=' ';VIN_ITEMSlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,FLT_ITEM_LOTCT,FLT_ITEM_ITMID','vin_item');VIN_ITEM_ITMID=FLT_ITEM_ITMID;" />&nbsp;All
					&nbsp;&nbsp;
					
					
					<input class="hidden" ab-filter="vin_item" ab-filter-cond="EQ" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  ab-filter-model="VIN_ITEM_LOTCT" ng-model="FLT_ITEM_LOTCT" />

					<input class="hidden" id="FLT_ITEM" ab-filter="vin_item" ab-filter-cond="CONTAINS" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  
						ab-filter-model="VIN_ITEM_ITMID,VIN_ITEM_DESC1,VIN_ITEM_DESC2,VIN_ITEM_DESC3,VIN_ITEM_PINFO,VIN_ITEM_INVID,VIN_ITYP_ITYPE,VIN_ITYP_DESCR,VIN_GROU_ITGRP,VIN_GROU_DESCR,VIN_LSHE_LOTID" 
						ng-model="FLT_ITEM_ITMID" />
					<!-- <input  class="hidden" ng-model="FLT_ITEM_FIELD" /> -->
					<!-- AC20160426 -->
					<input class="hidden" ng-model="vin_item_vsl"  />
					<input class="hidden" ng-model="vin_item_vpu"  />
					
				</span>
				
			</td>
<td class="text-left" >
<input ng-model="lot_item" class="hidden" />
<input ng-model="lot_ident" class="hidden" />

<select ng-model="AllvslL2otIds" 
onchange='
var grpT = $(this).val().split(",")
deflectVal(grpT[1],"lot_item");
deflectVal(grpT[2],"lot_ident");
// location.hash = "achor_" + grpT[1];
var trgt = grpT[0];
$("[data-target]").each(function()
{
	if($(this).attr("data-target") == trgt && $(this).attr("aria-expanded")!="true" )
{
	
	$(this).click();	
}
});
' >
										
	<option class="small" ng-repeat="lot in rawResult.vsl_item | AB_noDoubles:'idVIN_LSHE' | AB_Sorted:'VIN_LSHE_LOTID' " 
	value="#exp_{{lot.VIN_LSHE_ITMID}},{{lot.VIN_LSHE_ITMID}},{{lot.VIN_LSHE_LOTID}}" 
	ng-if="lot.VIN_LSHE_LOTID.length>0" 
	row-target="#exp_{{lot.VIN_LSHE_ITMID}}"
	ng-click="lot_item=lot.VIN_LSHE_ITMID;lot_ident=lot.VIN_LSHE_LOTID"
	>
	{{lot.VIN_LSHE_LOTID}}&nbsp-&nbspItem:({{lot.VIN_ITEM_ITMID}})
	</option>
	<option class="small" ng-click="lot_item='';lot_ident=''" value="">All Lots on page </option>
											
</select>									

</td>
					
				</tr>
			</table>

	</div>
	<script>
		$('#ab-buttonPad').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
	</script>
	<div>
  	<table class="table table-condensed" style="width:95%;">
	<tr>
		<td class=" ab-spaceless">
		
			<div class="row bg-primary"  >
			<?php
			$xtmp = new appForm("VIN_ITEMS");
			$xtmp->grAttrib["style"]="";
			$xtmp->grAttrib["class"]="ab-spaceless ";
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-1";
			$laAttr = $xtmp->laAttrib;
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_item","","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
						
			// $xtmp = new appForm("VIN_ITEMS");
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="{{tbData=='vin_item'?'VIN_ITEM_ITMID':'VIN_ITEM_ITMID'}}";
			$laAttr["class"] .= "bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_ITMID","",$grAttr,$laAttr,$inAttr," ");
			echo $xtmp->currHtml;
			
			// $xtmp = new appForm("VIN_ITEM");
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_ITEM_DESC1";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_DESC1","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;

			$xtmp = new appForm("VIN_ITEMS");
			?>
			</div>
		</td>
		</tr>	
	</table>
</div>
<div class="mygrid-wrapper-div"  style="margin:0px;padding:0px;">
	<div>
		<table class="table table-condensed table-striped">
	  		<tr role="presentation" ng-repeat="x in vin_item" class="{{!lot_item||lot_item==x.idVIN_ITEM?'':'hidden'}}" >	
	  		<form id="mainForm" name="mainForm"  ab-rowset="{{$index}}" ab-view="vin_item" ab-main="vin_item">
	  			<td ng-if="abSessionModal==true" class="small">
	  				<a  ng-click="ABsessionSetResponse(x)" > Select </a>&nbsp;
	  			</td>
	  			<!--
	  			to be used later
  			
				<td style="min-width:10px;max-width:10px;" >	
					<span ng-if="!ABSelectors.idVIN_ITEM[x.idVIN_ITEM]" ng-click="ABRecSelectors('idVIN_ITEM',x.idVIN_ITEM,'add',x.VIN_ITEM_ITMID + ':' + x.VIN_ITEM_DESC1);">
						<span class="ab-pointer glyphicon glyphicon-plus text-muted small" title="add to tagged list" ></span>
					</span>
					<span ng-if="ABSelectors.idVIN_ITEM[x.idVIN_ITEM]" ng-click="ABRecSelectors('idVIN_ITEM',x.idVIN_ITEM,'delete',x.VIN_ITEM_ITMID + ':' + x.VIN_ITEM_DESC1);" >
						<span class="btn-link glyphicon glyphicon-tag" title="remove from tagged list" ></span>
					</span>
				</td>
				-->
	  			<td class=" ab-spaceless" >
					<div class="row">
						<div class="col-sm-1">
							&nbsp;
							<a  target="{{ABtarget}}" href="#{{opts.Process}}/VIN_ITEMCT/idVIN_ITEM:{{x.idVIN_ITEM}},updType:UPDATE,Session:VIN_ITEMCT,Process:{{opts.Process}}" >
							
								<?php
									$tFnc = new AB_querySession;
									$dtaObj = array();
									$dtaObj['PROCESS'] = "VIN_ITEMS";
									$dtaObj['SESSION'] = "VIN_ITEMCT";
									$chk = 0;
									$chk += $tFnc->hasPriviledge($dtaObj,"vin_item","New");
									$chk += $tFnc->hasPriviledge($dtaObj,"vin_item","Upd");
									$chk += $tFnc->hasPriviledge($dtaObj,"vin_item","Del");
			
									if ($chk > 0)
									{
										echo "<span >Edit</span>";
									}
									else
									{
										echo "<span >View</span>";
									}
									?>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>
							<a name="achor_{{x.idVIN_ITEM}}" >
							<span style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{x.idVIN_ITEM}}" class="btn-link glyphicon glyphicon-th-list"></span>
							</a>
						</div>	
												
						<div class="col-sm-2 ab-spaceless">
							<input class="hidden" ng-model="x.idVIN_ITEM" />
							<input class="hidden" ng-model="x.VIN_ITEM_ITMID" />
							<input class="hidden" ng-model="x.VIN_ITEM_DESC1" />
							<label>
								{{x.VIN_ITEM_ITMID}} 
								<small>
									<br>&nbsp;{{x.VIN_ITEM_DESC1}}
								</small>
							
								<span ng-if="x.VIN_ITEM_LOTCT>0" class="small" >
									<br> 
									<a target="{{ABtarget}}"
									 href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:0,idVIN_ITEM:{{ x.idVIN_ITEM }},updType:CREATE,Session:VIN_LOTCT,Process:VIN_ITEMS" >
									Maintain Lots <span class="glyphicon glyphicon-pencil" ></span>
									</a>
								</span>
									
							</label>
						
						</div>
						<div class="col-sm-2 ab-spaceless small">
						
							<span class="small">
							<label>
							
								<span>{{x.VIN_ITEM_DESC2}}</span> 
								<span>{{x.VIN_ITEM_DESC3}}</span> 
							
								<span>
									<small class="text-primary" ng-if="x.VIN_ITEM_PINFO.length>0" >
										<em><br>Packaging:</em>
									</small>
									{{x.VIN_ITEM_PINFO}}
								</span>
								<span>
									<small class="text-primary" ng-if="x.VIN_ITEM_INVID.length>0" >
										<em><br>Invoicing Code:</em>
									</small>
									{{x.VIN_ITEM_INVID}}
								</span>
							
							</label>
							</span>	
							
						</div>


						<div class="col-sm-1 ab-spaceless small">
							
							<span class="small">
							<label>
								<table>
								<tr>
									<td class="small">
										<span class="text-primary"><em>On&nbsp;hand:</em></span>
									</td>
									<td style="min-width:35px;" >
										&nbsp;{{ x.VIN_INVE_BOHQT.length>0?x.VIN_INVE_BOHQT:'0' }}&nbsp;
									</td>
								</tr>
								<tr>
									<td class="small">
										<span class="text-primary"><em>Allocated:</em></span>
									</td>
									<td>
										&nbsp;{{x.VIN_INVE_ALOQT>0?x.VIN_INVE_ALOQT:'0'}}&nbsp;
									</td>
								</tr>
								<tr>
									<td class="small">
										<span class="text-primary"><em>On&nbsp;PO:</em></span>
									</td>
									<td >
										&nbsp;{{x.VIN_INVE_PURQT>0?x.VIN_INVE_PURQT:'0'}}&nbsp;
									</td>
								</tr>
							
								</table>
							
							</label>
							</span>	
							
						</div>
						<div class="col-sm-2 ab-spaceless small">
						
							<span class="small">
							<label>
								<table>
								<tr>
									<td>
										
										<em class="text-primary" ab-label="STD_UOM_SHORT" >UM</em>:&nbsp;{{ x.VIN_UNIT_DESCR }}<br>
										<span class="small" ng-if="x.VIN_ITYP_ITYPE.length>0" >
											<em class="text-primary">Type:</em>&nbsp;{{x.VIN_ITYP_ITYPE}}&nbsp;<small>{{x.VIN_ITYP_DESCR}}<br></small>
										</span>
											
										<span class="small" ng-if="x.VIN_GROU_ITGRP.length>0" >
											<em class="text-primary">Group:</em>&nbsp;{{x.VIN_GROU_ITGRP}}&nbsp;<small>{{x.VIN_GROU_DESCR}}</small>
										</span>
									</td>
								</tr>
								</table>
							</label>
							</span>		
								
							
							
						</div>
						<div class="col-sm-2 ab-spaceless small">

						</div>
					</div>

					<div exp-list="1" id="exp_{{x.idVIN_ITEM}}" class="row ab-border collapse {{' . "collaps!=1?'':'in'}}" . '" style="padding-left:10px;">
						<div class="col-sm-7 ">
							<div class="ab-border well">
								<label class="ng-binding small " ng-init="">Sales Order:</label>
								
								&nbsp;<input ng-model="x.noSlsOrd" class="hidden" readonly ng-init="x.noSlsOrd='No sales orders!'" />
									<span class="ng-binding text-primary small ng-scope"  ng-click="x.vslLotId='';x.showLots=1-x.showLots">
									<span class="glyphicon glyphicon-check" ng-if="x.showLots==1" ></span>
									<b>{{ x.noSlsOrd }}</b>
									<input class="hidden" ng-model="x.vslLotId"  />
									</span>
									<span class="{{x.showLots==1?'':'hidden'}}" >
									<span ng-if="order.idVIN_ITEM == x.idVIN_ITEM"
									ng-repeat="order in vsl_item  | AB_noDoubles:'idVIN_ITEM'" 
									 >
										<select ng-model="x.vslLotId" >
											<option class="small {{lot_ident==lot.VIN_LSHE_LOTID?'text-danger':''}} " 
											ng-repeat="lot in order.rowSet | AB_noDoubles:'idVIN_LSHE' | AB_Sorted:'VIN_LSHE_LOTID' " 
											value="{{lot.VIN_LSHE_LOTID}}" ng-click="x.vslLotId=lot.VIN_LSHE_LOTID"
											ng-if="lot.idVIN_LSHE>0"
											 >
											{{lot.VIN_LSHE_LOTID}}
											</option>
											<option class="small" value=""  >Show all lots </option>
											
										</select>	
										
									</span>
									</span>
									
								<div ng-repeat="order in vsl_item  | AB_noDoubles:'idVIN_ITEM'" 
								ng-if="order.idVIN_ITEM == x.idVIN_ITEM"
								ng-init="x.showLots=0"  >

									<div ng-if="x.idVIN_ITEM == order.VSL_ORDE_ITMID && order.idVSL_ORHE > 0">
								
										<span ng-if="order.rowSet.length>0" >
											<span ng-if="x.VIN_ITEM_LOTCT>0" ng-init="x.noSlsOrd='View Lot Info'"></span>
											<span ng-if="x.VIN_ITEM_LOTCT==0" ng-init="x.noSlsOrd=''"></span>
										 </span> 
										<table class="table table-condensed ab-spaceless " >
											<tr class="{{x.showLots!=1?'':'hidden'}}">
											<td  ng-if="ABiframe!='VSL_ORDERS'"></td>
											<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_ORNUM" >Order No.#</em></label></td>
																	
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_CUSPO">Customer</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_CUSPO">PO number</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_ODATE">Delivery Date</em></label> </td>
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORDE_ORDQT">Qty</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORDE_OUNET">Price</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_ORNUM">Step</em></label></td>
											</tr>
								
											<tr class="{{x.showLots!=1?'':'hidden'}}" ng-repeat="orlin in order.rowSet  | AB_noDoubles:'idVSL_ORST' " 
											class="{{!orlin.idVSL_ORHE?'hidden':''}}" ng-if="orlin.idVSL_ORHE>0" >
												<td  ng-if="ABiframe!='VSL_ORDERS'" >
												<a  target="{{ABtarget}}" href="#/VSL_ORDERS/VSL_ORHECT/idVSL_ORHE:{{orlin.idVSL_ORHE}},updType:UPDATE,Session:VSL_ORHECT,Process:VSL_ORDERS" >
												<span class="text-primary small">
												Edit
												<span class="glyphicon glyphicon-pencil" ></span>
												</span>
												</a>
												</td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VSL_ORHE_ORNUM}}-{{orlin.VSL_ORDE_ORLIN}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VGB_CUST_BPNAM}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VSL_ORHE_CUSPO}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VSL_ORST_PDATE}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VSL_ORST_ORDQT}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VSL_ORDE_OUNET}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{AB_CPARM["VSL_STEPS_DESCR"][orlin.VSL_ORST_STEPS]}}</label></td>
												
												<!--
												<td class="small" ><label class="small">&nbsp;{{(orlin.VSL_ORST_ORDQT * orlin.VSL_ORDE_OUNET)}}</label></td>
												-->
											</tr>
											<tr class="{{x.showLots==1?'':'hidden'}}"  >
											<td  ng-if="ABiframe!='VSL_ORDERS'"></td>
											<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_ORNUM" >Order No.#</em></label></td>
																	
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_CUSPO">Customer</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_CUSPO">PO number</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_ODATE">Delivery Date</em></label> </td>
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORDE_ORDQT">Qty</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORDE_OUNET">Lot Id</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_ORNUM">Lot Expires</em></label></td>
											</tr>
								
											<tr 	class="{{x.showLots==1?'':'hidden'}}" ng-if="(!x.vslLotId   || orlin.VIN_LSHE_LOTID==x.vslLotId ) && orlin.idVSL_ORHE>0 " 
												ng-repeat="orlin in order.rowSet  | AB_noDoubles:'idVSL_LSTR' | AB_Sorted:'VIN_LSHE_LOTID'  " 
												class="{{!orlin.idVSL_ORHE?'hidden':''}}"   >
												<td  ng-if="ABiframe!='VSL_ORDERS'" >
								
												</td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VSL_ORHE_ORNUM}}-{{orlin.VSL_ORDE_ORLIN}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VGB_CUST_BPNAM}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VSL_ORHE_CUSPO}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VSL_ORST_PDATE}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VSL_ORST_ORDQT}}</label></td>
												<td class="  {{lot_ident==orlin.VIN_LSHE_LOTID?'text-primary':'small'}}" ><label class="small">&nbsp;{{orlin.VIN_LSHE_LOTID}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VIN_LSHE_DATES}}</label></td>
												
												<!--
												<td class="small" ><label class="small">&nbsp;{{(orlin.VSL_ORST_ORDQT * orlin.VSL_ORDE_OUNET)}}</label></td>
												-->
											</tr>
											
									</table>
									</div>
								</div>
							</div>

						</div>
						<div class="col-sm-7">
						
							<div class="ab-border  well">
								<label class="ng-binding small ">Purchase Order:</label>
								&nbsp;<input ng-model="x.noPurOrd" class="hidden" readonly ng-init="x.noPurOrd='No Purchase orders!'" />
									<span class="ng-binding text-primary small ng-scope">
									<b>{{ x.noPurOrd }}</b>
									<input class="hidden" ng-model="x.vpuLotId"  />
									</span>
									<span class="{{x.showLots==1?'':'hidden'}}" >
									<span ng-if="order.idVIN_ITEM == x.idVIN_ITEM"
									ng-repeat="order in vpu_item  | AB_noDoubles:'idVIN_ITEM'" 
									 >
										<select ng-model="x.vpuLotId" >
											<option class="small" ng-repeat="lot in order.rowSet | AB_noDoubles:'idVIN_LSHE' | AB_Sorted:'VIN_LSHE_LOTID' " 
											value="{{lot.VIN_LSHE_LOTID}}" ng-click="x.vpuLotId=lot.VIN_LSHE_LOTID" >
											{{lot.VIN_LSHE_LOTID}}
											</option>
											<option class="small" value="">Show all lots </option>
											
										</select>	
										
									</span>
									</span>
								<div ng-repeat="order in vpu_item  | AB_noDoubles:'idVIN_ITEM'" ng-if="order.idVIN_ITEM == x.idVIN_ITEM"
									ng-init="x.showLots=0" >

									<div ng-if="x.idVIN_ITEM == order.VPU_ORDE_ITMID && order.idVPU_ORHE > 0">
								
										<span ng-if="order.rowSet.length>0" >
											<span ng-if="x.VIN_ITEM_LOTCT>0" ng-init="x.noPurOrd='View Lot Info'"></span>
											<span ng-if="x.VIN_ITEM_LOTCT==0" ng-init="x.noPurOrd=''"></span>
										 </span> 

										<table class="table table-condensed ab-spaceless "  >
											<tr class="{{x.showLots!=1?'':'hidden'}}">
											<td  ng-if="ABiframe!='VPU_ORDERS'"></td>
											<td  class="small"><label><em class="text-primary" ab-label="VPU_ORHE_ORNUM" >Order No.#</em></label></td>
																	
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORHE_CUSPO">Supplier</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORHE_CUSPO">Reference</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORHE_ODATE">Receipt Date</em></label> </td>
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORDE_ORDQT">Qty</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORDE_OUNET">Step</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORHE_ORNUM"></em></label></td>
											</tr>
								
											<tr class="{{x.showLots!=1?'':'hidden'}}" ng-repeat="orlin in order.rowSet  | AB_noDoubles:'idVPU_ORST' " ng-if="orlin.idVPU_ORHE > 0" >
												<td  ng-if="ABiframe!='VPU_ORDERS'" >
												<a  target="{{ABtarget}}" href="#/VPU_ORDERS/VPU_ORHECT/idVPU_ORHE:{{orlin.idVPU_ORHE}},updType:UPDATE,Session:VPU_ORHECT,Process:VPU_ORDERS" >
									<span class="text-primary small">
									Edit
									<span class="glyphicon glyphicon-pencil" ></span>
									</span>
									</a></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VPU_ORHE_ORNUM}}-{{orlin.VPU_ORDE_ORLIN}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VGB_SUPP_BPNAM}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VPU_ORHE_CUSPO}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VPU_ORST_PDATE}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VPU_ORST_ORDQT}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{AB_CPARM["VPU_STEPS_DESCR"][orlin.VPU_ORST_STEPS]}}</label></td>
												<td class="small" ><label class="small">&nbsp;</label></td>
											</tr>
											<tr class="{{x.showLots==1?'':'hidden'}}"  >
											<td  ng-if="ABiframe!='VSL_ORDERS'"></td>
											<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_ORNUM" >Order No.#</em></label></td>
																	
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORHE_CUSPO">Customer</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORHE_CUSPO">PO number</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORHE_ODATE">Delivery Date</em></label> </td>
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORDE_ORDQT">Qty</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORDE_OUNET">Lot Id</em></label></td>
												<td  class="small"><label><em class="text-primary" ab-label="VPU_ORHE_ORNUM">Lot Expires</em></label></td>
											</tr>
								
											<tr 	class="{{x.showLots==1?'':'hidden'}}" ng-if="(!x.vpuLotId && !AllvpuLotIds || orlin.VIN_LSHE_LOTID==x.vpuLotId || orlin.VIN_LSHE_LOTID==AllvpuLotIds)" 
												ng-repeat="orlin in order.rowSet  | AB_noDoubles:'idVPU_LSTR' | AB_Sorted:'VIN_LSHE_LOTID'  " 
												class="{{!orlin.idVPU_ORHE?'hidden':''}}" >
												<td  ng-if="ABiframe!='VSL_ORDERS'" >
												<a  target="{{ABtarget}}" href="#/VPU_ORDERS/VPU_ORHECT/idVPU_ORHE:{{orlin.idVPU_ORHE}},updType:UPDATE,Session:VPU_ORHECT,Process:VPU_ORDERS" >
												<span class="text-primary small">
												Edit
												<span class="glyphicon glyphicon-pencil" ></span>
												</span>
												</a>
												</td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VPU_ORHE_ORNUM}}-{{orlin.VPU_ORDE_ORLIN}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VGB_SUPP_BPNAM}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VPU_ORHE_CUSPO}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VPU_ORST_PDATE}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VPU_ORST_ORDQT}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VIN_LSHE_LOTID}}</label></td>
												<td class="small" ><label class="small">&nbsp;{{orlin.VIN_LSHE_DATES}}</label></td>
												
												<!--
												<td class="small" ><label class="small">&nbsp;{{(orlin.VSL_ORST_ORDQT * orlin.VSL_ORDE_OUNET)}}</label></td>
												-->
											</tr>											
									</table>
									</div>
								</div>
							</div>

						</div>


						<div class="col-sm-12 " ng-if="x.VIN_ITEM_LOTCT>0 " > 
							<div class="row ">			
								<div class=" col-sm-6 ab-border well">
									<label class="ng-binding small">
									Item Lot:{{order.VIN_LSHE_ITMID}}
									</label>
									<span class="ng-binding small">
										<a target="{{ABtarget}}"  href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:0,idVIN_ITEM:{{ x.idVIN_ITEM }},updType:CREATE,Session:VIN_LOTCT,Process:VIN_ITEMS" >
											<span>New</span>
											<span class="glyphicon glyphicon-pencil" ></span>
										</a>
									</span>

									&nbsp;<input ng-model="x.noLotsDef" class="hidden" readonly ng-init="x.noLotsDef='No lots defined for Item!'" />
									<span class="ng-binding text-primary small ng-scope">
									<b>{{ x.noLotsDef }}</b>
									</span>
									<div ng-repeat="tk in vin_item_vin_lshe |AB_noDoubles:'idVIN_ITEM'" ng-if="tk.idVIN_ITEM == x.idVIN_ITEM && tk.VIN_LSHE_SOLDO == '0'" >
																					
											<span ng-if="tk.rowSet.length>0">
											<span ng-init="x.noLotsDef=''"></span>
										</span>

										<div ng-repeat="k in tk.rowSet | filter: {VIN_LSHE_SOLDO:'0'}" ng-if="k.idVIN_LSHE.length > 0" ng-show="$first">
											<table class="table table-condensed ab-spaceless " width="95%;">
											       <tr>
													<td></td>  
													<td class="small"><label class="small"><em  ab-label="VIN_LSHE_LOTID" class="text-primary">Lot Identification</em></label></td>
													<td class="small"><label class="small"><em  ab-label="STD_DATE_SLIFE" class="text-primary">VIN_LSHE_DOMDA </em></label></td>
													<td class="small"><label class="small"><em  ab-label="VIN_LSHE_DOMOS" class="text-primary">VIN_LSHE_DOMOS </em></label></td>
													<td class="small"><label class="small"><em  ab-label="VIN_LSHE_DATES" class="text-primary">VIN_LSHE_DATES</em></label></td>  
												<!--	<td class="small"><label class="small"><em  ab-label="VIN_LSHE_BPART" class="text-primary">VIN_LSHE_BPART</em></label></td> -->
												</tr>
											      
											        <tr class="ab-spaceless" ng-repeat="k in  tk.rowSet |AB_noDoubles:'idVIN_LSHE'" ng-if="k.idVIN_LSHE>0 && k.VIN_LSHE_SOLDO == 0">
											        
											       		<td  class="ab-spaceless">
											       			<a  target="{{ABtarget}}" href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:{{k.idVIN_LSHE}},idVIN_ITEM:{{  tk.idVIN_ITEM }},updType:UPDATE,Session:VIN_LOTCT,Process:VIN_ITEMS" >
															<span class="text-primary small">
														Edit
														<span class="glyphicon glyphicon-pencil" ></span>
														</a>
													</td>
													<td>
														<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_LOTID}}</label></div>
													</td>
													<td>
														<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_DOMDA}}</label></div>
													</td>
													<td>
														<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_DOMOS}}</label></div>
													</td>
													<td>
												
														<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_DATES}}</label></div>
												
													</td>
													<!--<td>
														<div class="small"><label class="small">&nbsp;{{k.VGB_SUPP_BPNAM}}</label></div>
													</td> -->
												
												</tr>
											</table>
										
										</div>
		 							</div> 
								</div>
							</div>
							<div class="row ">			
								
								<div  class="col-sm-6 ab-border well" ng-if="x.VIN_ITEM_LOTCT>0">
									<label class="ng-binding small">Product Spec Sheet:</label>
									<span class="ng-binding small">
										<a target="{{ABtarget}}"  href="#/VIN_ITEMS/VIN_SSMACT/idVIN_SSMA:0,idVIN_ITEM:{{ x.idVIN_ITEM }},updType:CREATE,Session:VIN_SSMACT,Process:VIN_ITEMS">
											<span>New</span>
											<span class="glyphicon glyphicon-pencil" ></span>
										</a>
										
									</span>
		
									&nbsp;<input ng-model="x.noSpecsDef" class="hidden" readonly ng-init="x.noSpecsDef='No spec defined for Item!'" />
									<span class="small text-primary">
											<b>{{x.noSpecsDef}} </b>
									</span>
									<div ng-repeat="tk in vin_item_vin_ssma |AB_noDoubles:'idVIN_ITEM' " ng-if="tk.idVIN_ITEM == x.idVIN_ITEM && tk.idVIN_SSMA>0" >
										<span ng-if="tk.rowSet.length>0">
											<span ng-init="x.noSpecsDef=''"></span>
										</span>
										
										<table class="table table-condensed ab-spaceless" width="95%;">

											<tr ng-if="tk.rowSet.length > 0" >
												<td></td>  
												<td class="small">
													<label class="small">
														<em  ab-label="VIN_SSMA_SPEID" class="text-primary">
															Spec. Sheet ID Code
														</em>
													</label>
												</td>
												<td class="small">
													<label class="small">
														<em  ab-label="VIN_SSMA_DESCR" class="text-primary">
															VIN_SSMA_DESCR 
														</em>
													</label>
												</td>
												<td class="small">
													<label class="small">
														<em  ab-label="VIN_SSMA_SUETA" class="text-primary">
															Delivery Lead Time Days 
														</em>
													</label>
												</td>
												<td class="small">
													<label class="small">
														<em  ab-label="VIN_SSMA_SHLIF" class="text-primary">
															Shelf Life Days 
														</em>
													</label>
												</td>
											</tr>
									
											<tr ng-repeat="spec in tk.rowSet|AB_noDoubles:'idVIN_SSMA' " ng-if='spec.idVIN_SSMA>0'>
									        		<td  class="ab-spaceless">
													<a target="{{ABtarget}}"
													href="#/VIN_ITEMS/VIN_SSMACT/idVIN_SSMA:{{spec.idVIN_SSMA}},idVIN_ITEM:{{spec.idVIN_ITEM}},updType:UPDATE,Session:VIN_SSMACT,Process:VIN_ITEMS" >
														<span class="text-primary small">
															Edit
															<span class="glyphicon glyphicon-pencil" ></span>
														</span>
													</a>
												</td>
									        		<td  class="ab-spaceless">
													<div class="small">
														<label class="small">
														&nbsp;{{spec.VIN_SSMA_SPEID}}
														</label>
													</div>
												</td>
									        		<td  class="ab-spaceless">
													<div class="small">
														<label class="small">
														&nbsp;{{spec.VIN_SSMA_DESCR}}
														</label>
													</div>
												</td>
												<td  class="ab-spaceless">
													<div class="small">
														<label class="small">
														&nbsp;{{spec.VIN_SSMA_SUETA}}
														</label>
													</div>
												</td>
												<td  class="ab-spaceless">
													<div class="small">
														<label class="small">
														&nbsp;{{spec.VIN_SSMA_SHLIF}}
														</label>
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

			
				</div>
							

			</div>
 			</td>
  			</form>
  			
	  		</tr>
	  	  </table>
<!--End of -->
	</div> 
</div>
</div>
<table class="table table-condensed ">
	  <tr class="ab-spaceless">
	  		<td>
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vin_item'?'vin_item':'Yes'}}"
			class="{{ tbData=='vin_item'?'xxx':''}} text-primary" >
		
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="ABlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,VIN_ITEM_LOTCT','vin_item')"  > </span>
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
<div class='btn-sm ab-body-buttons hidden' >
	<span class='hidden'>
		Records per page:&nbsp;
		<select class='text-muted' ab-mpp onchange="getMaxPerPage();" value="1000" >
		  <option value="10">10</option>
		  <option value="20" >20</option>
		  <option value="40"  >40</option>
		  <option value="1000" selected >100</option>
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


