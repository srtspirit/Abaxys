<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
	<?php require_once "../appCscript/VIN_ITEMStmpAlain.php"; ?>
</div>
<div style="margin-left:5px;" ng-init="SESSION_DESCR='Item Control'">
	<div class="row ab-spaceless ">
		<div class="col-sm-12 ab-spaceless" >
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		</div>
	</div>
	<div class="row mygrid-wrapper-div ab-borderless" style="margin:0px;padding:0px;">
	
	<form id="mainForm" name="mainForm"  ab-view="vin_item" ab-main="vin_item">
			<br>
		<?php

$xtmp = new appForm("VIN_ITEMCT");
echo '<div class="col-sm-3 ab-borderless">';
// idVIN_ITEM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vin_item";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vin_item","idVIN_ITEM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


// VIN_ITEM_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_ITMID";
$xtmp->setFieldWrapper("view01","1.1","","VIN_ITEM_ITMID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

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
	$ignTrig = 'ng-click="' . "hold=VIN_ITYP_ITYPE;VIN_ITYP_ITYPE='';VIN_ITYP_ITYPE_F='';kPress('VIN_ITYP_ITYPE','VIN_ITYP_ITYPE','vin_ityp',0);VIN_ITYP_ITYPE=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view01","1.2","vin_item","VIN_ITEM_SEAR1","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

// VIN_ITEM_DESC1
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_DESC1";
$xtmp->setFieldWrapper("view01","1.1","","VIN_ITEM_DESC1","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_DESC2
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_DESC2";
$xtmp->setFieldWrapper("view01","1.1","","VIN_ITEM_DESC2","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_DESC3
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_DESC3";
$xtmp->setFieldWrapper("view01","1.1","","VIN_ITEM_DESC3","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_PINFO
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_PINFO";
$xtmp->setFieldWrapper("view01","1.1","","VIN_ITEM_PINFO","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

//VIN_ITEM_UNSET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_UNSET";

	$keepOrg = 0; 
	$repeatIn = "vin_uset";
	$searchIn = "";
	$refName = "vin_uset"; // unique
	$refModel = "VIN_ITEM_UNSET"; // unique
	$repeatInRef = "idVIN_USET"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_USET_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VIN_USET_UNSET;VIN_USET_UNSET='';VIN_USET_UNSET_F='';kPress('VIN_USET_UNSET','VIN_USET_UNSET','vin_uset',0);VIN_USET_UNSET=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view01","1.2","vin_item","VIN_ITEM_UNSET","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


// VIN_ITEM_UNITM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_UNITM";
$xtmp->setFieldWrapper("view01","1.1","","VIN_ITEM_UNITM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

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
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_WARS_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VIN_WARS_WARID;VIN_WARS_WARID='';VIN_WARS_WARID_F='';kPress('VIN_WARS_WARID','VIN_WARS_WARID','vin_wars',0);VIN_WARS_WARID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view01","1.2","vin_item","VIN_ITEM_WARID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_ITEM_ITGRP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_ITGRP";

	$keepOrg = 0; 
	$repeatIn = "vin_grou";
	$searchIn = "";
	$refName = "vin_grou"; // unique
	$refModel = "VIN_ITEM_ITGRP"; // unique
	$repeatInRef = "idVIN_GROU"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_GROU_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VIN_GROU_ITGRP;VIN_GROU_ITGRP='';VIN_GROU_ITGRP_F='';kPress('VIN_GROU_ITGRP','VIN_GROU_ITGRP','vin_grou',0);VIN_GROU_ITGRP=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view01","1.2","vin_item","VIN_ITEM_ITGRP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

// VIN_ITEM_INVID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_INVID";
$xtmp->setFieldWrapper("view01","1.1","","VIN_ITEM_INVID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_HRZID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_HRZID";
$xtmp->setFieldWrapper("view01","1.1","","VIN_ITEM_HRZID","",$grAttr,$laAttr,$inAttr,"");
echo '</div><div class="col-sm-3">';
echo $xtmp->currHtml;

// VIN_ITEM_UPCID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_UPCID";
$xtmp->setFieldWrapper("view01","1.1","","VIN_ITEM_UPCID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


//VIN_ITEM_CFCAT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_CFCAT");
$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_CFCAT","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_ITEM_BAORA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_BAORA");
$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_ITEM_COMMI
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_COMMI");
$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_COMMI","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_ITEM_INVIT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_INVIT");
$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_INVIT","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_ITEM_PICKP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_PICKP");
$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_PICKP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_ITEM_PACKP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_PACKP");
$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_PICKP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_ITEM_POITM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_POITM");
$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_POITM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_ITEM_REITM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_REITM");
$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_REITM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_ITEM_VSFPR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_VSFPR");
$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_VSFPR","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

// VIN_ITEM_SAUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_SAUOM";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_SAUOM","",$grAttr,$laAttr,$inAttr,"");
echo '</div><div class="col-sm-3">';
echo $xtmp->currHtml;

// VIN_ITEM_PUUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_PUUOM";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_PUUOM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_PUMIN
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_PUMIN";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_PUMIN","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_PURND
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_PURND";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_PURND","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


//VIN_ITEM_MMCAL
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_MMCAL");
$xtmp->setFieldWrapper("view02","0.0","vin_item","VIN_ITEM_MMCAL","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_ITEM_PUMRP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_PUMRP");
$xtmp->setFieldWrapper("view02","0.0","vin_item","VIN_ITEM_PUMRP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

// VIN_ITEM_OVAGE
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_OVAGE";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_OVAGE","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_SUETA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_SUETA";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_SUETA","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_MINQT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_MINQT";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_MINQT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_MAXQT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_MAXQT";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_MAXQT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_MINSD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_MINSD";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_MINSD","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_MAXSD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_MAXSD";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_MAXSD","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_SHLIF
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_SHLIF";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_SHLIF","",$grAttr,$laAttr,$inAttr,""); 
echo $xtmp->currHtml;

//VIN_ITEM_LOTCT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_LOTCT");
$xtmp->setFieldWrapper("view02","0.0","vin_item","VIN_ITEM_LOTCT","",$grAttr,$laAttr,$inAttr,$hardCode);
echo '</div><div class="col-sm-3">';
echo $xtmp->currHtml;

// VIN_ITEM_STDCP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_STDCP";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_STDCP","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_SCUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_SCUOM";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_SCUOM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_AVGCP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_AVGCP";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_AVGCP","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_ACUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_ACUOM";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_ACUOM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_COSTP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_COSTP";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_COSTP","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_CPUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_CPUOM";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_CPUOM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_LISTP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_LISTP";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_LISTP","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_LPUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_LPUOM";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_LPUOM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

//VIN_ITEM_LPCDA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_ITEM_LPCDA");
$xtmp->setFieldWrapper("view02","0.0","vin_item","VIN_ITEM_LPCDA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

// VIN_ITEM_ITTXT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_ITTXT";
$xtmp->setFieldWrapper("view02","1.1","","VIN_ITEM_ITTXT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

//VIN_ITEM_ISCID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_ISCID";

	$keepOrg = 0; 
	$repeatIn = "vgl_schh";
	$searchIn = "";
	$refName = "vgl_schh"; // unique
	$refModel = "VIN_ITEM_ISCID"; // unique
	$repeatInRef = "idVGL_SCHH"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGL_SCHH_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VGL_SCHH_ISCID;VGL_SCHH_ISCID='';VGL_SCHH_ISCID_F='';kPress('VGL_SCHH_ISCID','VGL_SCHH_ISCID','vgl_schh',0);VGL_SCHH_ISCID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view02","1.2","vin_item","VIN_ITEM_ISCID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

echo '</div>';

echo '</form></div></div><div>';
?>
</div>
</div>