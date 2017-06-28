﻿<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<textarea class="hidden" ab-updSuccess="" >
$scope.flipHidden('.collps',false);
$scope.flipHidden('.collps-on',true);
</textarea>

	<div class="row ">
			<div class="col-sm-3 bg-primary">
				Locations
			</div>	
	</div>
		<div class="row  collps-on {{idVIN_WARS>0?'hidden':''}} ">
		  <div class="col-sm-4" style="padding:5px 0 0 20px;">
				<span data-dismiss="modal"  class="ab-pointer btn-primary text-primary  {{idVIN_WARS>0?'':'hidden'}}" ng-click="flipHidden('.collps',false);flipHidden('.collps-on',true);ABContext('vin_locs',0);">&nbsp;
					<span class="glyphicon glyphicon-backward"></span>&nbsp;
					<span ab-label="">Locations List</span>&nbsp;
				</span>
			</div>
		    <div id="local-sysOpt" class="col-sm-8" style="padding:5px 0px;" >
				<span class="glyphicon glyphicon-floppy-disk ab-pointer text-primary" ng-if="idVIN_LOCS>0"
				 ng-click="locsABupd('UPDATE');" type="button" 
				value="Save" ></span>
				&nbsp;&nbsp;
				<span class="glyphicon glyphicon-trash ab-pointer text-primary" ng-if="idVIN_LOCS>0"
				 ng-click="locsABupd('DELETE');" type="button" value="Delete"></span>
				
				<span class="btn-link ab-pointer text-primary" ng-if="idVIN_LOCS<1"  ng-click="locsABupd('CREATE');" type="button" value="Create" >
					<span class="text-primary" ab-label="STD_NEW" >Add</span> 
					<span class="glyphicon glyphicon-floppy-disk"></span>
				</span>
			</div>
			<div class="col-sm-6">
				<div class="well">
				<input class="hidden" ng-model="idVIN_LOCS" /> 
<?php
	$xtmp = new appForm("VIN_LOCASCT");
							
	/*$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$inAttr['ab-btrigger'] = "vin_locs";
	$grAttr['class'] = "hidden";
	$xtmp->setFieldWrapper("","0.0","vin_locs","idVIN_LOCS","",$grAttr,$laAttr,$inAttr,"");
   echo $xtmp->currHtml;*/
   
// VIN_LOCS_WARID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("VIEW01","0.0","vin_locs","VIN_LOCS_WARID","idVIN_WARS",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_LOCS_LOCID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "VIN_LOCS_LOCID";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.1","vin_locs","VIN_LOCS_LOCID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_LOCS_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "VIN_LOCS_DESCR";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.2","vin_locs","VIN_LOCS_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['id'] = "dfLoc_fld";
$laAttr['ab-label'] = "Default_location";
$hardCode = $xtmp->setYesNoField("Default_location");
$xtmp->setFieldWrapper("view01","1.1","vin_locs","Default_location","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

$hardCode  = '<div id="dfLoc_lbl" style="padding-top:5px;display:none;padding-bottom:10px;" ab-fgroup="Default_location" ab-pseq="1.1" ab-pview="view01" ab-pform="VIN_LOCASCT" title="">';
$hardCode .= '<div class="text-primary " ab-label="Default_location" style="font-weight:700;" ab-fgrlab="Default_location" title="{ab=Default_location)">';
$hardCode .= '<span ab-label="Default_location" title="{ab=Default_location)">Default_location</span></div>';
$hardCode .= '<div style="margin-left:3px;" ab-fgrinp="Default_location" title="">';
$hardCode .= '<div title="">';
$hardCode .= '<div class="hiddenxx" title="">';
$hardCode .= '<span title="">';
$hardCode .= '<label style="min-width:40px;" ab-label="STD_YES" title="{ab=STD_YES)"> Yes </label>';
$hardCode .= '</span></div></div></div></div>';
echo $hardCode;

					?>				
				</div>
			</div>
		</div>	
		
		<div class="row collps {{idVIN_WARS>0?'':'hidden'}}" style="padding-top:5px;">
			<div class="col-sm-12">	
				<div class="row">
					<div class="col-sm-1 ab-spaceless small">	
						<a data-dismiss="modal" ng-click="flipHidden('.collps',true);flipHidden('.collps-on',false);ABContext('vin_locs',1);serNewLocId(idVIN_WARS);initYNfld((VIN_WARS_MALOC !='' && VIN_WARS_MALOC !=0)?0:1,(VIN_WARS_MALOC !='' && VIN_WARS_MALOC !=0)?VIN_WARS_MALOC:'OK');" >
							<span class="glyphicon glyphicon-pencil ab-pointer text-primary" ></span>
							<span ab-label="STD_NEW" >New</span>
						</a>													
					</div>	
					<div class="col-sm-2 ab-spaceless">
							<label  ab-label="VIN_LOCS_LOCID">Location ID</label>		
					</div>
					<div class="col-sm-6">
						<label  ab-label="STD_DESCR">Description</label>
					</div>	
				</div>
		<!--	<div class="row " ng-repeat="x in VIN_LOCAS | orderBy:'x.VIN_LOCS_LOCID'" >
					<div class="col-sm-1 ab-spaceless">	
						<a data-dismiss="modal" ng-click="flipHidden('.collps',true);flipHidden('.collps-on',false);ABContext('vin_locs',1);ABupdChkObj('idVIN_LOCS',x.idVIN_LOCS,true);ABchk(null,'vin_locs');" >
							<span  class="ab-pointer glyphicon glyphicon-pencil" ></span>
							<span ab-label="" >Edit</span>
						</a>																	
					</div>	
					<div class="col-sm-2 ab-spaceless">{{x.VIN_LOCS_LOCID}}</div>
					<div class="col-sm-6">{{x.VIN_LOCS_DESCR}}</div>
				</div> -->
				
				<div class="row " ng-repeat="x in vin_wars | orderBy:'x.VIN_LOCS_LOCID'" ng-if="x.VIN_LOCS_LOCID.length > 0">
					<div class="col-sm-1 ab-spaceless small">	
						<a data-dismiss="modal" ng-click="flipHidden('.collps',true);flipHidden('.collps-on',false);ABContext('vin_locs',1);ABupdChkObj('idVIN_LOCS',x.idVIN_LOCS,true);ABchk(null,'vin_locs');initYNfld((x.idVIN_LOCS ==x.VIN_WARS_MALOC && VIN_WARS_MALOC !=0)?1:0,(x.idVIN_LOCS ==x.VIN_WARS_MALOC && VIN_WARS_MALOC !=0)?'OK':x.VIN_WARS_MALOC)" >
							<span  class="ab-pointer glyphicon glyphicon-pencil" ></span>
							<span ab-label="" >Edit</span>
						</a>																	
					</div>	
					<div class="col-sm-2 ab-spaceless">{{x.VIN_LOCS_LOCID}}</div>
					<div class="col-sm-6">{{x.VIN_LOCS_DESCR}}</div>
				</div>
				
			</div>	
		</div>