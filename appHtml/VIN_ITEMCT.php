<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
	<?php require_once "../appCscript/VIN_ITEMS.php"; ?>
</div>
<div style="margin-left:5px;" ng-init="SESSION_DESCR='Item Control'">

	<div class="row ab-spaceless ">

		<div class="col-lg-12 ab-spaceless" >
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		</div>

	</div>
	
<div class="ab-spaceless" >


<div id="ab-new" >
	<label  title="CREATE" class="{{opts.updType=='CREATE'?'hidden':''}}">
		 <a href="#VIN_ITEMS/VIN_ITEMCT/Process:VIN_ITEMS,Session:VIN_ITEMCT,tblName:vin_item,updType:CREATE,idVIN_ITEM:0" >
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

if (data['posts'].requestMethod == 'DELETE')
{
	location.href="#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item";
}
else
{

	if ($scope.opts.updType == "CREATE")
	{
		location.href="#VIN_ITEMS/VIN_ITEMCT/idVIN_ITEM:" + data['posts'].insertId + ",updType:UPDATE,Session:VIN_ITEMCT,Process:VIN_ITEMS"
	}
	else
	{
		$scope.ABinitTbl('vin_item','idVIN_ITEM');
		$scope.ABupdChkObj('idVIN_ITEM', $scope.opts.idVIN_ITEM,true);
	
		$scope.ABchkMain();
	
	}

}


</textarea>
<!--
Attribute ab-updSuccess - Optional
If present and ABupd is successfull
ABupd() will execute (eval) the value of the object

Note that $scope needs to be in the code as opposed to data-ng-init= above
-->
</div>
	
	<div class="row ab-borderless" style="margin:0px;padding:0px;">
	
	<form id="mainForm" name="mainForm"  ab-view="vin_item" ab-main="vin_item">
	<input class="hidden" ng-model="VIN_ITEM_WARID" />
			<br>
		
		<?php

$xtmp = new appForm("VIN_ITEMCT");
// echo '<div class="col-lg-3 ab-borderless">';
// idVIN_ITEM
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$inAttr['ab-btrigger'] = "vin_item";
	$grAttr['class'] = "hidden";
	$xtmp->setFieldWrapper("","0.0","vin_item","idVIN_ITEM","",$grAttr,$laAttr,$inAttr,"");
// echo $xtmp->currHtml;

// idVIN_ITEM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vin_unit";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("","0.0","vin_uset","idVIN_USET","",$grAttr,$laAttr,$inAttr,"");
//echo $xtmp->currHtml;


// VIN_ITEM_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["ng-blur"] = "itmidDefaults();";
$laAttr['ab-label'] = "VIN_ITEM_ITMID";
$laAttr['class'] = "hidden";
$grAttr['class'] .= " ab-spaceless ";
$xtmp->setFieldWrapper("General","","","VIN_ITEM_ITMID","",$grAttr,$laAttr,$inAttr,"");
$onClick = <<<EOC
<span class='btn-link ' onclick='flipPanels(0);' ><span class='glyphicon glyphicon-zoom-out '></span></span>
<span class='btn-lg btn-link ' onclick='flipPanels(1);' ><span class='glyphicon glyphicon-zoom-in '></span></span>

EOC;

$external = <<<EOC

<div class='row '  >
	<div class='col-lg-3' >
		<table style="width:100%">
			<tr>
				<td>
					{$onClick}
					&nbsp;
					
				</td>
				<td class="text-right">
					<span class="text-primary ab-strong" ab-label="VIN_ITEM_ITMID"></span>
					&nbsp;
				</td>
				<td>
					{$xtmp->currHtml}
				</td>
			</tr>
		</table>
					
	</div>
	<div class='col-lg-2' >
		<span class="ab-strong" >&nbsp;{{ VIN_ITEM_DESC1 }}</span>
	</div>
	<div class='col-lg-3' style='vertical-align:bottom;'  >
	<table>
	<tr>
	<td>
		<div ng-if ='idVIN_ITEM>0' class='ab-strong  '>
			<ul class="nav  ab-spaceless " role="tablist"    >
			<li class="dropdown ab-spaceless " >
				<span ng-click="getVinSuppliers()" data-toggle="dropdown" class="text-primary ab-strong ab-pointer" style="white-space:nowrap;padding:0px;" >
					Suppliers
					<span class="caret" ></span>
				</span>
				<ul class="dropdown-menu ab-spaceless" ab-flst="" role="menu"  >
					<li class="dropdown ab-spaceless " 
					ng-repeat="supp in vin_suppliers" >
						<a href='#/VIN_ITEMS/VIN_SUPPCT/idVIN_SUPP:{{supp.idVIN_SUPP}},tblName:vin_supp,updType:UPDATE,Session:VIN_SUPPCT,Process:VIN_ITEMS,idVIN_ITEM:{{idVIN_ITEM}},idVGB_SUPP,{{supp.idVGB_SUPP}}' >
							<span class="text-primary" >
								<span class='glyphicon glyphicon-pencil' ></span>
								&nbsp;
								{{supp.VGB_SUPP_BPNAM}}
							</span>	
						</a>
					</li>
					<li>
						<a  href='#/VIN_ITEMS/VIN_SUPPCT/idVIN_SUPP:0,tblName:vin_supp,updType:CREATE,Session:VIN_SUPPCT,Process:VIN_ITEMS,idVIN_ITEM:{{idVIN_ITEM}},idVGB_SUPP' >
							<span class="text-primary" >						
								<span class='glyphicon glyphicon-pencil' ></span>
								&nbsp;
								New Supplier
							</span>
						</a>		
					</li>
				</ul>
			</li>
			</ul>
			
		</div>
	</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
		<div ng-if ='VIN_ITEM_LOTCT > 0&&idVIN_ITEM>0' class='ab-strong'>
			&nbsp;
			<a  href='#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:0,idVIN_ITEM:{{ opts.idVIN_ITEM }},updType:CREATE,Session:VIN_LOTCT,Process:VIN_ITEMS' >
				Maintain Lots 
				<span class='glyphicon glyphicon-pencil' ></span>
			</a>
		</div>
	</td>
	</tr>
	</table>		
	</div>

</div>

EOC;


echo $external;

// <!-- #/VIN_ITEMS/VIN_SUPPCT/idVIN_SUPP:0,tblName:vin_supp,updType:CREATE,Session:VIN_SUPPCT,Process:VIN_ITEMS,idVIN_ITEM:2,idVGB_SUPP: -->

//VIN_ITEM_SEAR1
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_SEAR1";

	$keepOrg = 0; 
	$repeatIn = "vin_ityp";
	$searchIn = "";
	$refName = "vin_ityp"; // unique
	$refModel = "VIN_ITEM_SEAR1"; // unique
	$repeatInRef = "idVIN_ITYP"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_ITYP_ITYPE}}","{{ab_rloop.VIN_ITYP_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'nil-click="' . "hold=VIN_ITYP_ITYPE;VIN_ITYP_ITYPE='';VIN_ITYP_ITYPE_F='';ABlstAlias('VIN_ITYP_ITYPE','VIN_ITYP_ITYPE','vin_ityp',0);VIN_ITYP_ITYPE=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("General","1.2","vin_item","VIN_ITEM_SEAR1","",$grAttr,$laAttr,$inAttr,$hardCode);

// echo $xtmp->currHtml;

// VIN_ITEM_DESC1 

$hardCode = "<table>";

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";
$xtmp->setFieldWrapper("General","","vin_item","VIN_ITEM_DESC1","",$grAttr,$laAttr,$inAttr,"");
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td>" . $xtmp->currHtml . "</td></tr>";


// VIN_ITEM_DESC2 
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";
$xtmp->setFieldWrapper("General","","vin_item","VIN_ITEM_DESC2","",$grAttr,$laAttr,$inAttr,"");
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td>" . $xtmp->currHtml . "</td></tr>";


// VIN_ITEM_DESC3 
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";
$xtmp->setFieldWrapper("General","","vin_item","VIN_ITEM_DESC3","",$grAttr,$laAttr,$inAttr,"");
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td>" . $xtmp->currHtml . "</td></tr>";
$hardCode .= "</table>";

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["ab-label"] = "STD_DESC";

$xtmp->setFieldWrapper("General","0.0","vin_item","VIN_ITEM_DESC1","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo $xtmp->currHtml;


// VIN_ITEM_PINFO
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_PINFO";
$xtmp->setFieldWrapper("General","1.1","","VIN_ITEM_PINFO","",$grAttr,$laAttr,$inAttr,"");
// echo $xtmp->currHtml;

//VIN_ITEM_UNSET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_USET_UNSET";

	$keepOrg = 0; 
	$repeatIn = "vin_uset | AB_noDoubles:'idVIN_USET'";
	$searchIn = "";
	$refName = "vin_uset"; // unique
	$refModel = "VIN_ITEM_UNSET"; // unique
	$repeatInRef = "idVIN_USET"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_USET_UNSET}}","{{ab_rloop.VIN_USET_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "ng-click=" . '"' . "eraseUnitOfMeasure();" . '" ';
	$ignTrig = 'nil-click="' . "hold=VIN_USET_UNSET;VIN_USET_UNSET='';VIN_USET_UNSET_F='';ABlstAlias('VIN_USET_UNSET','VIN_USET_UNSET','vin_uset',0);VIN_USET_UNSET=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("Inventory","0.1","vin_item","VIN_ITEM_UNSET","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo $xtmp->currHtml;


// VIN_ITEM_UNITM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_UNITM";

	$keepOrg = 0; 
	$repeatIn = "vin_unit";
	$searchIn = "";
	$refName = "VIN_ITEM_UNITM"; // unique
	$refModel = "VIN_ITEM_UNITM"; // unique
	$repeatInRef = "idVIN_UNIT"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_UNIT_UNITM}}","{{ab_rloop.VIN_UNIT_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "ng-click=" . '"' . "copyUnitOfMeasure(ab_rloop.idVIN_UNIT);" . '" ';
	$ignTrig = 'nil-click="' . "hold=VIN_UNIT_UNITM;VIN_UNIT_UNITM='';VIN_UNIT_UNITM_F='';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);VIN_UNIT_UNITM=hold;".'"';
	$ignTrig = 'ng-click="vin_itemUnits();"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("Inventory","0.2","vin_item","VIN_ITEM_UNITM","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo $xtmp->currHtml;

//VIN_ITEM_WARID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_WARID";

	$keepOrg = 0; 
	$repeatIn = "vin_wars";
	$searchIn = "";
	$refName = "vin_wars"; // unique
	$refModel = "VIN_ITEM_WARID"; // unique
	$repeatInRef = "idVIN_WARS"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_WARS_WARID}}","{{ab_rloop.VIN_WARS_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'nil-click="' . "hold=VIN_WARS_WARID;VIN_WARS_WARID='';VIN_WARS_WARID_F='';ABlstAlias('VIN_WARS_WARID','VIN_WARS_WARID','vin_wars',0);VIN_WARS_WARID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
// $xtmp->setFieldWrapper("Inventory","0.3","vin_item","VIN_ITEM_WARID","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_ITGRP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_GROU_ITGRP";

	$keepOrg = 0; 
	$repeatIn = "vin_grou";
	$searchIn = "";
	$refName = "vin_grou"; // unique
	$refModel = "VIN_ITEM_ITGRP"; // unique
	$repeatInRef = "idVIN_GROU"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_GROU_ITGRP}}","{{ab_rloop.VIN_GROU_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'nil-click="' . "hold=VIN_GROU_ITGRP;VIN_GROU_ITGRP='';VIN_GROU_ITGRP_F='';ABlstAlias('VIN_GROU_ITGRP','VIN_GROU_ITGRP','vin_grou',0);VIN_GROU_ITGRP=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("General","1.2","vin_item","VIN_ITEM_ITGRP","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

// VIN_ITEM_INVID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_INVID";
$xtmp->setFieldWrapper("General","1.1","","VIN_ITEM_INVID","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_HRZID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_HRZID";
$xtmp->setFieldWrapper("General","1.1","","VIN_ITEM_HRZID","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_UPCID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_UPCID";
$xtmp->setFieldWrapper("General","1.1","","VIN_ITEM_UPCID","",$grAttr,$laAttr,$inAttr,"");
// // echo  '</div><div class="col-lg-3">';
// echo  $xtmp->currHtml;


//VIN_ITEM_CFCAT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_CFCAT");
$xtmp->setFieldWrapper("Orders","0.0","vin_item","VIN_ITEM_CFCAT","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_BAORA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "STD_ACCEPT_BACK_ORDE";
$hardCode = $xtmp->setYesNoField("VIN_ITEM_BAORA");
$xtmp->setFieldWrapper("Orders","0.0","vin_item","VIN_ITEM_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_COMMI
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_COMMI");
$xtmp->setFieldWrapper("Orders","0.0","vin_item","VIN_ITEM_COMMI","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_INVIT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_INVIT");
$xtmp->setFieldWrapper("Inventory","0.7","vin_item","VIN_ITEM_INVIT","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_PICKP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_PICKP");
$xtmp->setFieldWrapper("Orders","0.0","vin_item","VIN_ITEM_PICKP","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_PACKP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_PACKP");
$xtmp->setFieldWrapper("Orders","0.0","vin_item","VIN_ITEM_PACKP","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_POITM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_POITM");
$xtmp->setFieldWrapper("Orders","0.0","vin_item","VIN_ITEM_POITM","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_REITM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_REITM");
$xtmp->setFieldWrapper("Orders","0.0","vin_item","VIN_ITEM_REITM","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_VSFPR Mod Alain 20160204 not needed
//	$grAttr = $xtmp->grAttrib;
//	$laAttr = $xtmp->laAttrib;
//	$inAttr = $xtmp->inAttrib;
//	$hardCode = $xtmp->setYesNoField("VIN_ITEM_VSFPR");
//	$xtmp->setFieldWrapper("Orders","0.0","vin_item","VIN_ITEM_VSFPR","",$grAttr,$laAttr,$inAttr,$hardCode);
//	echo $xtmp->currHtml;

// VIN_ITEM_SAUOM
/*$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";
//$laAttr['ab-label'] = "VIN_ITEM_SAUOM";
$xtmp->setFieldWrapper("Orders","1.1","","VIN_ITEM_SAUOM","",$grAttr,$laAttr,$inAttr,"");
// echo '</div><div class="col-lg-3">';
$hardCode = "<table>";
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td ab-label='STD_SALES' class='" . $laAttr['class'] . "' ></td>";
$hardCode .= "<td>" . $xtmp->currHtml . "</td></tr>";
//echo $xtmp->currHtml;*/
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_SAUOM";

	$keepOrg = 0; 
	$repeatIn = "vin_unit";
	$searchIn = "";
	$refName = "VIN_ITEM_SAUOM"; // unique
	$refModel = "VIN_ITEM_SAUOM"; // unique
	$repeatInRef = "idVIN_UNIT"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_UNIT_UNITM}}","{{ab_rloop.VIN_UNIT_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "ng-click=" . '"' . "copyUnitOfMeasure(ab_rloop.idVIN_UNIT);" . '" ';
	$ignTrig = 'nil-click="' . "hold=VIN_UNIT_UNITM;VIN_UNIT_UNITM='';VIN_UNIT_UNITM_F='';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);VIN_UNIT_UNITM=hold;".'"';
	$ignTrig = 'ng-click="vin_itemUnits();"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
	$xtmp->setFieldWrapper("Cost","2.1","vin_item","VIN_ITEM_SAUOM","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo '</div><div class="col-lg-3">';
// echo  $xtmp->currHtml;

// VIN_ITEM_PUUOM
/*$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";
//$laAttr['ab-label'] = "VIN_ITEM_PUUOM";
$xtmp->setFieldWrapper("Inventory","1.1","","VIN_ITEM_PUUOM","",$grAttr,$laAttr,$inAttr,"");
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td ab-label='STD_PURCHASE' class='" . $laAttr['class'] . "' ></td>";
$hardCode .= "<td>" . $xtmp->currHtml . "</td></tr>";
$hardCode .= "</table>";

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("Orders","0.0","vin_item","STD_UOM","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;*/

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_PUUOM";

	$keepOrg = 0; 
	$repeatIn = "vin_unit";
	$searchIn = "";
	$refName = "VIN_ITEM_PUUOM"; // unique
	$refModel = "VIN_ITEM_PUUOM"; // unique
	$repeatInRef = "idVIN_UNIT"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_UNIT_UNITM}}","{{ab_rloop.VIN_UNIT_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "ng-click=" . '"' . "copyUnitOfMeasure(ab_rloop.idVIN_UNIT);" . '" ';
	$ignTrig = 'nil-click="' . "hold=VIN_UNIT_UNITM;VIN_UNIT_UNITM='';VIN_UNIT_UNITM_F='';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);VIN_UNIT_UNITM=hold;".'"';
	$ignTrig = 'ng-click="vin_itemUnits();"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("Cost","2.2","vin_item","VIN_ITEM_PUUOM","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;


// VIN_ITEM_PUMIN
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_PUMIN";
$inAttr['size'] = 5;
$xtmp->setFieldWrapper("Inventory","1.1","","VIN_ITEM_PUMIN","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_PURND
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_PURND";
$inAttr['size'] = 5;
$xtmp->setFieldWrapper("Inventory","1.1","","VIN_ITEM_PURND","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;


//VIN_ITEM_MMCAL
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_MMCAL");
$xtmp->setFieldWrapper("Inventory","1.0","vin_item","VIN_ITEM_MMCAL","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_PUMRP DIcountable remove 20170227
//	$grAttr = $xtmp->grAttrib;
//	$laAttr = $xtmp->laAttrib;
//	$inAttr = $xtmp->inAttrib;
//	$hardCode = $xtmp->setYesNoField("VIN_ITEM_PUMRP");
//	$xtmp->setFieldWrapper("Orders","0.0","vin_item","VIN_ITEM_PUMRP","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

// VIN_ITEM_OVAGE
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_OVAGE";
$xtmp->setFieldWrapper("Orders","1.1","","VIN_ITEM_OVAGE","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_SUETA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_SUETA";
$inAttr['size'] = 5;
$xtmp->setFieldWrapper("Inventory","1.1","","VIN_ITEM_SUETA","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_MINQT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_MINQT";
$inAttr['size'] = 5;
$xtmp->setFieldWrapper("Inventory","1.1","","VIN_ITEM_MINQT","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_MAXQT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_MAXQT";
$inAttr['size'] = 5;
$xtmp->setFieldWrapper("Inventory","1.1","","VIN_ITEM_MAXQT","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_MINSD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_MINSD";
$inAttr['size'] = 5;
$xtmp->setFieldWrapper("Inventory","1.1","","VIN_ITEM_MINSD","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_MAXSD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_MAXSD";
$inAttr['size'] = 5;
$xtmp->setFieldWrapper("Inventory","1.1","","VIN_ITEM_MAXSD","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_SHLIF
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_SHLIF";
$inAttr['size'] = 5;
$xtmp->setFieldWrapper("Inventory","0.85","","VIN_ITEM_SHLIF","",$grAttr,$laAttr,$inAttr,""); 
// echo  $xtmp->currHtml;


// VIN_ITEM_DOMOS
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "STD_DOS_OR_DOM";
$inAttr['size'] = 5;
$hardCode =  $xtmp->setEnumField('vin_item','VIN_ITEM_DOMOS');

$xtmp->setFieldWrapper("Inventory","0.86","","VIN_ITEM_DOMOS","",$grAttr,$laAttr,$inAttr,$hardCode); 
// echo  $xtmp->currHtml;



//VIN_ITEM_LOTCT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_LSHECT";
$hardCode = $xtmp->setYesNoField("VIN_ITEM_LOTCT");
$xtmp->setFieldWrapper("Inventory","0.8","vin_item","VIN_ITEM_LOTCT","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo '</div><div class="col-lg-3">';
// echo  $xtmp->currHtml;

// VIN_ITEM_STDCP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_STDCP";
$inAttr['size']="8";
$inAttr['ab-ft'] = "amt";
$xtmp->setFieldWrapper("Cost","1.3","","VIN_ITEM_STDCP","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_SCUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_SCUOM";

	$keepOrg = 0; 
	$repeatIn = "vin_unit";
	$searchIn = "";
	$refName = "VIN_ITEM_SCUOM"; // unique
	$refModel = "VIN_ITEM_SCUOM"; // unique
	$repeatInRef = "idVIN_UNIT"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_UNIT_UNITM}}","{{ab_rloop.VIN_UNIT_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "ng-click=" . '"' . "copyUnitOfMeasure(ab_rloop.idVIN_UNIT);" . '" ';
	$ignTrig = 'nil-click="' . "hold=VIN_UNIT_UNITM;VIN_UNIT_UNITM='';VIN_UNIT_UNITM_F='';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);VIN_UNIT_UNITM=hold;".'"';
	$ignTrig = 'ng-click="vin_itemUnits();"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("Cost","2.4","","VIN_ITEM_SCUOM","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

// VIN_ITEM_AVGCP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_AVGCP";
$inAttr['size']="8";
$inAttr['ab-ft'] = "amt";
$xtmp->setFieldWrapper("Cost","1.4","","VIN_ITEM_AVGCP","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_ACUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_ACUOM";

	$keepOrg = 0; 
	$repeatIn = "vin_unit";
	$searchIn = "";
	$refName = "vin_unit"; // unique
	$refModel = "VIN_ITEM_ACUOM"; // unique
	$repeatInRef = "idVIN_UNIT"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_UNIT_UNITM}}","{{ab_rloop.VIN_UNIT_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "ng-click=" . '"' . "copyUnitOfMeasure(ab_rloop.idVIN_UNIT);" . '" ';
	$ignTrig = 'nil-click="' . "hold=VIN_UNIT_UNITM;VIN_UNIT_UNITM='';VIN_UNIT_UNITM_F='';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);VIN_UNIT_UNITM=hold;".'"';
	$ignTrig = 'ng-click="vin_itemUnits();"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("Cost","2.6","vin_item","VIN_ITEM_ACUOM","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

// VIN_ITEM_COSTP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_COSTP";
$inAttr['size']="8";
$inAttr['ab-ft'] = "amt";
$xtmp->setFieldWrapper("Cost","1.2","","VIN_ITEM_COSTP","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_CPUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_CPUOM";

	$keepOrg = 0; 
	$repeatIn = "vin_unit";
	$searchIn = "";
	$refName = "VIN_ITEM_CPUOM"; // unique
	$refModel = "VIN_ITEM_CPUOM"; // unique
	$repeatInRef = "idVIN_UNIT"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_UNIT_UNITM}}","{{ab_rloop.VIN_UNIT_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "ng-click=" . '"' . "copyUnitOfMeasure(ab_rloop.idVIN_UNIT);" . '" ';
	$ignTrig = 'nil-click="' . "hold=VIN_UNIT_UNITM;VIN_UNIT_UNITM='';VIN_UNIT_UNITM_F='';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);VIN_UNIT_UNITM=hold;".'"';
	$ignTrig = 'ng-click="vin_itemUnits();"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("Cost","2.3","","VIN_ITEM_CPUOM","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

// VIN_ITEM_LISTP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_LISTP";
$inAttr['size']="8";
$inAttr['ab-ft'] = "amt";
$xtmp->setFieldWrapper("Cost","1.1","","VIN_ITEM_LISTP","",$grAttr,$laAttr,$inAttr,"");
// echo  $xtmp->currHtml;

// VIN_ITEM_LPUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_LPUOM";

	$keepOrg = 0; 
	$repeatIn = "vin_unit";
	$searchIn = "";
	$refName = "VIN_ITEM_LPUOM"; // unique
	$refModel = "VIN_ITEM_LPUOM"; // unique
	$repeatInRef = "idVIN_UNIT"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_UNIT_UNITM}}","{{ab_rloop.VIN_UNIT_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "ng-click=" . '"' . "copyUnitOfMeasure(ab_rloop.idVIN_UNIT);" . '" ';
	$ignTrig = 'nil-click="' . "hold=VIN_UNIT_UNITM;VIN_UNIT_UNITM='';VIN_UNIT_UNITM_F='';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);VIN_UNIT_UNITM=hold;".'"';
	$ignTrig = 'ng-click="vin_itemUnits();"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("Cost","2.5","","VIN_ITEM_LPUOM","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_LPCDA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setDatePick("VIN_ITEM_LPCDA");
$xtmp->setFieldWrapper("Cost","2.7","vin_item","VIN_ITEM_LPCDA","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

// VIN_ITEM_ITTXT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_ITXT";
$hardCode =  $xtmp->setEnumField('vin_item','VIN_ITEM_ITTXT');
$xtmp->setFieldWrapper("Tax","1.1","","VIN_ITEM_ITTXT","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

//VIN_ITEM_ISCID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGL_SCHE_ISCID";

	$keepOrg = 0; 
	$repeatIn = "vgl_schh";
	$searchIn = "";
	$refName = "vgl_schh"; // unique
	$refModel = "VIN_ITEM_ISCID"; // unique
	$repeatInRef = "idVGL_SCHH"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGL_SCHH_ISCID}}","{{ab_rloop.VGL_SCHH_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'nil-click="' . "hold=VGL_SCHH_ISCID;VGL_SCHH_ISCID='';VGL_SCHH_ISCID_F='';ABlstAlias('VGL_SCHH_ISCID','VGL_SCHH_ISCID','vgl_schh',0);VGL_SCHH_ISCID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("Tax","1.2","vin_item","VIN_ITEM_ISCID","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;


// VIN_ITEM_TCAID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VTX_ITTA_TCAID";

	$keepOrg = 0; 
	$repeatIn = "vtx_itta";
	$searchIn = "";
	$refName = "vtx_itta"; // unique
	$refModel = "VIN_ITEM_TCAID"; // unique
	$repeatInRef = "idVTX_ITTA"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VTX_ITTA_TCAID}}","Non Applicable"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'nil-click="' . "hold=VTX_ITTA_TCAID;VTX_ITTA_TCAID='';VTX_ITTA_TCAID_F='';ABlstAlias('VTX_ITTA_TCAID','VTX_ITTA_TCAID','vtx_itta',0);VTX_ITTA_TCAID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);

// Not in use AC20160220	
// $xtmp->setFieldWrapper("Tax","1.3","vin_item","VIN_ITEM_TCAID","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo  $xtmp->currHtml;

// echo '</div>';



	$newObj = array();
	$newObj['General'] = "";
	$newObj['Inventory'] = "";
	$newObj['Cost'] = "";
	$newObj['Orders'] = "";
//	$newObj['Others'] = "";
	$newObj['Tax'] = "";

	$obj = $xtmp->formData;
	ksort($obj);
	
	$ret = array();

// echo "<!-- ";


echo '<div class="mygrid-wrapper-div  ab-borderless ab-spaceless" ><div class="panel-group " id="accordion">';


$detailHtml = "";
$dispHtml = "";
	$grCount = 0;


	foreach($obj as $func => $result)
	{


$isHidden = "";
if (strlen($func) == 0)
{
	$isHidden = "hidden";
}
else
{
	$grCount += 1;
}

$dispHtml .= '<div class="panel panel-default row ' . $isHidden . ' ">';
$dispHtml .= '<div class="panel-heading col-lg-1">';
$dispHtml .= '<h4 class="panel-title">&nbsp;';
$dispHtml .= '<span class="btn-link" data-toggle="collapse"  href="#' . $func .'" >';
$dispHtml .= $func . '</span>';
$dispHtml .= '</h4></div>';



if ($func != "General")
{
	$clin = 'class=" col-lg-11 panel-collapse collapse"';
}
else
{
	$clin = 'class=" col-lg-11 panel-collapse collapse in"';
}
//AC 20160220 all panels opened
$clin = 'ab-panel="1" class=" col-lg-11 panel-collapse collapse in"';

$dispHtml .= '<div id="' . $func . '" ' . $clin .' ><div class="panel-body row">';


$detailHtml .= "\n Func=(" . $func . ")";

		$xObj = $obj[$func];
		ksort($xObj);
		$objCount = 0;
		$dispHtml .= '<div class="col-lg-3 ">';
		
		foreach($xObj as $name => $value)
		{
			$detailHtml .= "\n(" . $name . ") tableName:" . $value['tableName'];  
			$detailHtml .= " -fieldName:" . $value['fieldName'];  
			$detailHtml .= " -fieldType:" . $value['fieldType'];  

			$dispHtml .= $value['Html'];
			$objCount += 1;
			if ($objCount > 2)
			{
				$dispHtml .= '</div><div class="col-lg-3 ">';
				$objCount = 0;

			}		
		
		}
		$dispHtml .= '</div>';


// $detailHtml .= $dispHtml;
// $detailHtml .= "</div></div>";

$dispHtml .= "</div></div></div>";

$newObj[$func] = $dispHtml;
$dispHtml = "";    	
    	
	}

echo implode($newObj);

// echo "</td><td>" . $detailHtml . "</td></tr></table>";
echo "</div>";
echo "<div class='hidden' ><pre>" . $detailHtml . "</pre></div>";


// echo " -->";

echo '</form></div></div><div>';

?>
</div>
</div>

<script>

function flipPanels(dir)
{
	
	$("[ab-panel]").each(function()
	{
		
		if ($(this).hasClass("in"))
		{
			if (dir==0)
			{
				$("[href='#" + $(this).attr("id") + "']").click();
				
			}
		}
		else
		{
			if (dir==1)
			{
				$("[href='#" + $(this).attr("id") + "']").click();
				
			}
		}
		
	});

}
</script>
