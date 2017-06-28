<?php require_once "../stdSscript/stdAppobjGen.php"; ?>

<div class="hidden">
<?php require_once "../appCscript/VIN_USETS.php"; ?>
</div>

<div style="margin-left:5px;" ng-init="SESSION_DESCR='Maintain Units Of Measure'">

	<div class="row ab-spaceless ">
		<div class="col-sm-12 ab-spaceless" ng-model="vgb_supp" >
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
		<form id="mainForm" name="mainForm"  ab-view="vin_unit" ab-main="vin_unit"  >


<?php

$xtmp = new appForm("VIN_UNITCT");
echo '<div class="col-sm-3 ab-borderless">';

// idVIN_USET	
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vin_uset","idVIN_USET","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_USET_UNSET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","2.1","vin_uset","VIN_USET_UNSET","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_USET_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "STD_DESCR";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","2.1","vin_uset","VIN_USET_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


// VIN_USET_UVACT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_USET_UVACT");
$xtmp->setFieldWrapper("view01","2.1","vin_uset","VIN_USET_UVACT","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;






// idVIN_UNIT	
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vin_unit";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vin_unit","idVIN_UNIT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_UNIT_UNSET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vin_unit","VIN_UNIT_UNSET","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

//VIN_UNIT_UNITM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","0.0","vin_unit","VIN_UNIT_UNITM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_UNIT_FACTO
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{VIN_USET_UVACT > 0?'':'hidden'}} ";
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","0.0","vin_unit","VIN_UNIT_FACTO","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_UNIT_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","0.0","vin_unit","VIN_UNIT_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;







echo '</div>';



echo '</form></div></div>';





?>

	
		
	</div>
</div>
