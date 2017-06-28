<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
	<?php require_once "../appCscript/VIN_SSITCT.php"; ?>
</div>
<div style="margin-left:5px;" ng-init="SESSION_DESCR=' Product Spec Sheet Main'">
	<div class="row ab-spaceless ">
		<div class="col-sm-12 ab-spaceless" ng-model="vin_ssma" >
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		</div>
		<div class="col-sm-5" style="padding:0px;padding-top:5px;">
			<ul class="nav nav-tabs " >
				<li>
					<span class="text-warning" >&nbsp;&nbsp;</span>
					<label class="btn-xs"   ab-label="" ></label>
					<span  value=""></span>
				</li>
			</ul>
		</div>
		<div class="col-sm-7">
		</div>
	</div>
	<div class="row mygrid-wrapper-div ab-borderless" style="margin:0px;padding:0px;">
		
		
		<form id="" name="mainForm"  ab-view="vin_ssit" ab-main="vin_ssit">
		<?php $xtmp = new appForm("VIN_SSITCT");
      echo '<div class="col-sm-3 ab-borderless">';

// idVIN_SSIT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vin_ssit";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("VIEW01","0.0","vin_ssit","idVIN_SSIT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "";
$xtmp->setFieldWrapper("VIEW01","0.0","vin_ssit","VIN_SSIT_ITMID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_SSIT_SPESQ
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "";
$xtmp->setFieldWrapper("VIEW01","0.0","vin_ssit","VIN_SSIT_SPESQ","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

echo '</div>';
?>
		</form>
	</div>
</div>