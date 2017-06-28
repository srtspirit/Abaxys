<style>
.col-sm-5 input[type='text']
{
padding-left: 12px;
}
</style>
<?php require_once "../stdSscript/stdAppobjGen.php";?>
<div class="hidden">
	<?php require_once "../appCscript/VIN_WAREHOUSE.php";?>
</div>
<div style="margin-left:5px;" ng-init="SESSION_DESCR='Warehouse Control'">
	<div class="row ab-spaceless ">
		<div class="col-sm-12 ab-spaceless" ng-model="vin_wars" >
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		</div>
	</div>
	
<div class="ab-spaceless" >

<div id="ab-new" >
	<label  title="CREATE" class="{{opts.updType=='CREATE'?'hidden':''}}">
		 <a href="#VIN_WAREHOUSE/VIN_WARSCT/Process:VIN_WAREHOUSE,Session:VIN_WARSCT,tblName:vin_wars,updType:CREATE,idVIN_WARS:0" >
			<span >New</span>
			<span  class="glyphicon glyphicon-pencil" ></span>
		</a>			
	</label>
</div>

	<script>
		$('#ab-appOpt').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
	</script>

<textarea class="hidden" ab-updSuccess="" >

if (data['posts'].requestMethod == 'DELETE' && data['posts'].tblInfo.tblName == 'vin_wars')
{
	$("#ab-back").click();
}
else
{
	
	if ($scope.opts.updType == "CREATE" && data['posts'].tblInfo.tblName == 'vin_wars')
	{
		$scope.initWarsctDta(data['posts'].insertId);
	}
	else if ($scope.opts.updType == "CREATE" && data['posts'].tblInfo.tblName == 'vin_locs')
	{
		$scope.initWarsctDta(data['posts'].clause.VIN_LOCS_WARID);
	}
	else
	{
		$scope.initWarsctDta($scope.opts.idVIN_WARS);
	}
}
</textarea>

</div>

	<div class="ab-borderless" style="margin:0px;padding:0px;">
	<form id="mainForm" name="mainForm"  ab-view="vin_wars" ab-main="vin_wars" ab-main-support="vin_locs" >
	<div class="col-sm-3 ab-borderless">
<?php
$xtmp = new appForm("VIN_WARSCT");
 
// idvin_wars	
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vin_wars";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("System","0.0","vin_wars","idVIN_WARS","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// vin_wars_WARID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "VIN_WARS_WARID";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.2","vin_wars","VIN_WARS_WARID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// vin_wars_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "STD_DESCR";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.2","vin_wars","VIN_WARS_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// vin_wars_INVWA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "VIN_WARS_INVWA";
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_WARS_INVWA");
$xtmp->setFieldWrapper("view01","1.1","vin_wars","VIN_WARS_INVWA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
	
// vin_wars_MESID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "VIN_WARS_ADDID";
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = 'hidden';
$xtmp->setFieldWrapper("view01","1.2","vin_wars","VIN_WARS_ADDID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// vin_wars_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['value'] = "0";
$inAttr['ab-orgval'] = "0";
$grAttr['class'] = 'hidden';
$xtmp->setFieldWrapper("view01","1.1","vin_wars","VIN_WARS_MALOC","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
// AC 20160704
// $hardCode  = '<div ng-repeat="x in vin_wars" ng-if="VIN_WARS_MALOC == x.idVIN_LOCS && idVIN_WARS != 0 && VIN_WARS_MALOC != \'\' "><div class="text-primary "><label ab-label="VIN_WARS_MALOC">&nbsp;VIN_WARS_MALOC</label></div>';
// $hardCode .= '<div class="small"><label>&nbsp;{{x.VIN_LOCS_LOCID}}-{{x.VIN_LOCS_DESCR}}</label></div></div>';
// echo $hardCode;

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "VIN_WARS_SFWAR";
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidfden";
$hardCode = $xtmp->setYesNoField("VIN_WARS_SFWAR");
$xtmp->setFieldWrapper("view01","1.1","vin_wars","VIN_WARS_SFWAR","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "VIN_WARS_SILOC";
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$hardCode = $xtmp->setYesNoField("VIN_WARS_SILOC");
$xtmp->setFieldWrapper("view01","1.1","vin_wars","VIN_WARS_SILOC","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
?>
		</div>
		<div class="col-sm-6">
			<?php require_once "../appHtml/VIN_LOCSCT.php"; ?>	
		</div>
		</form>
	</div>
</div>
