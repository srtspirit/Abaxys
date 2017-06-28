<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
	<?php require_once "../appCscript/VGB_NFNUS.php"; ?>
</div>
<div style="margin-left:5px;" ng-init="SESSION_DESCR='Maintain Next free number'">
	<div class="row ab-spaceless ">
		<div class="col-sm-12 ab-spaceless" ng-model="vgb_nfnu" >
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		</div>
		<div class="col-sm-5" style="padding:0px;padding-top:5px;">
			
		</div>
		<div class="col-sm-7">
		</div>
	</div>
	<div class="row mygrid-wrapper-div ab-borderless" style="margin:0px;padding:0px;">
		<form id="mainForm" name="mainForm"  ab-view="vgb_nfnu" ab-main="vgb_nfnu">
		<?php
$xtmp = new appForm("VGB_NFNUCT");
echo '<div class="col-sm-3 ab-borderless">';
 
// idVGB_NFNU	
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vgb_nfnu";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("System","0.0","vgb_nfnu","idVGB_NFNU","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VGB_NFNU_NFNCO
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.1","vgb_nfnu","VGB_NFNU_NFNCO","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

/*// VGB_NFNU_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "STD_DESCR";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.2","vgb_nfnu","VGB_NFNU_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
*/
// VGB_NFNU_NFNVA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.1","vgb_nfnu","VGB_NFNU_NFNVA","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

echo '</div>';
  ?>
		</form>
	</div>
</div>