<?php


class AB_objGen
{
	
	
function setListerFieldTest($lf)
{

$keepOrg      	 = $lf["keepOrg"]; // 0 or 1 false will hide - 1 will keep visible
$repeatIn     	 = $lf["repeatIn"];// table or alias name ei: ng-repeat="xx in ????
$searchIn     	 = $lf["searchIn"];// not used
$refName      	 = $lf["refName"];
$refModel     	 = $lf["refModel"];
$searchInRef     = $lf["searchInRef"];
$searchRefDesc   = $lf["searchRefDesc"];
$repeatInRef 	 = $lf["repeatInRef"];
$refDesc      	 = $lf["refDesc"];
$refDetail    	 = $lf["refDetail"];
$refDetailLink	 = $lf["refDetailLink"];
$ignTrig      	 = $lf["ignTrig"];
	
$this->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);	


}

// Example from VGB_CNTRCT session

//	$keepOrg = 1; 			// 0 or 1    0 will hide - 1 will keep visible
//	$repeatIn = "vgb_curr"; 	// table or alias name ei: ng-repeat
//	$searchIn = ""; 		// Not used 
//	$refName = "vgb_curr"; 		// unique 
//	$refModel = "VGB_CNTR_CURID"; 	// unique
//	$repeatInRef = "idVGB_CURR"; 	//Unique
//	$searchRefDesc = "";		//Not in use yet 
//	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_CURR_CURID}}","{{ab_rloop.VGB_CURR_DESCR}}"));
//	$refDetail = "";
//	$refDetailLink = "";
//	$ignTrig = 'ng-click="' . "hold=VGB_CURR_CURID;VGB_CURR_CURID='';VGB_CURR_CURID_F='';ABlst('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0);VGB_CURR_CURID=hold;".'"';

function setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig)
{	


$refHead = "<span id='" . $refName . "{{" . "$" . "index" ."}}' >";
$refValue = "'" . $refName . "{{" . "$" . "index" ."}}'";


$refDescTop = $refDesc;
if ($searchRefDesc != "")
{
	$refDescTop = $searchRefDesc;
}


$refDetailDeflect = 'onclick="' . "$('#{$refModel}main').html($(this).find('label').html());deflectFlds(this.getAttribute('value'));" . '"';
if (strlen($refDetailLink) > 0)
{
	$refDetailDeflect .= " " .  $refDetailLink;
}

if (strlen($refDetail) > 0)
{
	
$refDetailDisp = <<<BOD
				
	&nbsp;&nbsp;<span  ab-flst="ab-lister-{$refName}" class='btn glyphicon glyphicon-th-list hidden' onclick="$('[ab-fx{$refModel}de]').toggleClass('hidden');"></span>
BOD;

};


if ($searchRefDesc != "")
{
	$dispHtml = "";
}
else
{

$refDetailDeflect = 'dflval="{' . '{ab_rloop.' . $repeatInRef . '}}"';
$refDetailDeflect .= ' onclick="deflectVal($(this).attr(' . "'dflval'),'" . $refModel . "');" . '"'; 

// $refDetailDeflect = 'ng-click="' . $refModel . " = ab_rloop." . $repeatInRef . ';"';

$dispHtml = <<<BOD


	<span  ng-repeat="ab_rloop in {$repeatIn}"  > 

		<span class="text-muted {{ab_rloop.{$repeatInRef}!={$refModel}?'hidden':''}}">
		{$refDescTop} 	
		</span>
	</span>

BOD;


}

$divHtml = <<<BOD



				<div  class="  "  {$ignTrig} ab-objLister="ab-lister-{$refName},{$keepOrg}"  >
					<span style="border:none;border-bottom:solid;border-width:1px;border-color:CornflowerBlue;"   >
						<input id="{$refModel}" ng-model="{$refModel}"  class="ab-hidden" size=5 />
						<span class="  text-primary " id="{$refModel}main" >
						{$searchRefDesc}
						{$dispHtml}
							
						</span>
						<span class="caret text-primary "></span>
					</span>
					
				{$refDetailDisp}				
	
				</div>
				<div class="hidden " ab-flst="ab-lister-{$refName}" >
					
					<div class="mygrid-wrapper-divSm" >
					<table class=" table-bordered" >
					<tr ng-repeat="ab_rloop in {$repeatIn}" >
					<td>
						{$refHead}
							<input type="hidden"  name="{$refModel}" value="{{ab_rloop.{$repeatInRef}}}" />
							
							
						</span>
						<div class="btn btn-xs {{ab_rloop.{$repeatInRef}!={$refModel}?'hidden':''}}" >

							<span class="ab-border">
								
								&radic; 
								
							</span>
							&nbsp;
							
							<label>
							{$refDesc}
							</label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
						</div>

									
						
						
						<div class="btn btn-xs {{ab_rloop.{$repeatInRef}!={$refModel}?'':'hidden'}}"
							value={$refValue}
							{$refDetailDeflect} 
						>	

							<span class="ab-border" style="color:transparent;">
								&radic; 
							</span>
							&nbsp;
							<span >
							<label>
							{$refDesc}
							</label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</span>
						</div>
						
						
						
						<div ab-fx{$refModel}de class='btn-xs disabled hidden' style="padding-left:20px;" >
							<div class="well well-sm">
							<strong>
							{$refDetail}
							</strong>
							</div>
							
					      	</div>
						
					</td>
					</tr>
					
					</table>
					</div>
				</div>


BOD;

echo $divHtml;
return 	$divHtml;

}


function setYesNoField($fieldName)
{

$classSetOff = 	"hidden{{" . $fieldName . "!=0?'xx':''}}" ;
$classSetOn = 	"hidden{{" . $fieldName . "!=0?'':'xx'}}" ;

$divHtml = <<<BOD
		
	<div>		
		<table class=" {$classSetOn}" >
		<tr>
			<td>
				<span class="ab-border">
					&radic; 
				</span>
				&nbsp;
				<label ab-label="STD_NO" >
				No
				</label>
				&nbsp;&nbsp;&nbsp;
			</td>
			<td ng-click="{$fieldName}=1;" class="ab-pointer">
				<span class="ab-border" style="color:transparent;">
					&radic; 
				</span>
				&nbsp;
				
				<span ab-label="STD_YES" >
				Yes&nbsp;
				</span>	
				&nbsp;&nbsp;
			</td>
		</tr>
		</table>

		<table class=" {$classSetOff}" >
		<tr>
			<td>
				<span class="ab-border">
					&radic; 
				</span>
				&nbsp;
				<label ab-label="STD_YES" >
				Yes
				</label>
				&nbsp;&nbsp;
			</td>
			<td ng-click="{$fieldName}=0;" class="ab-pointer">
				<span class="ab-border" style="color:transparent;">
					&radic; 
				</span>
				&nbsp;
				
				<span ab-label="STD_NO">
				No
				</span>	
				&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		</table>
	</div>

BOD;

echo $divHtml;						

}


function setDatePick($fieldName)
{

$divHtml = <<<BOD
<script>
	$(function() {
		$( "[ab-datepick]" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,			
			showOn: "button",
			buttonText: "<span class='glyphicon glyphicon-th-list'></span>",
			dateFormat: "yymmdd"
		});		
	});
</script>

 <input ab-datepick type="text" size=7 placeholder="yyyymmdd" ng-model="{$fieldName}"   title="default settings" >
	
BOD;

echo $divHtml;						


}

}

?>