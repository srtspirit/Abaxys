<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>

<div class="hidden">
<?php require_once "../appCscript/VGB_PARTNERS.php"; ?>
</div>
<div class="container" ng-init="SESSION_DESCR='Maintain Suppliers'">
<div class="row ab-spaceless ">
	<div class="col-sm-12 ab-spaceless" ng-model="vgb_supp" >
		<?php require_once "../stdCscript/stdFormButtons.php"; ?>
	</div>
	<div class="col-sm-5" style="padding:0px;padding-top:5px;">
	<ul class="nav nav-tabs " >
		<li class="ab-tabs ab-tab-on ab-pointer">
			
			<small  ab-menu="vgb_supp" name="mainForm" class="text-primary">&nbsp;<span  ab-label="VGB_SUPPCT"> Supplier </span>&nbsp;&nbsp;</small> 
		</li>

		<li class="ab-tabs ab-pointer">
			
			<small ab-menu="vgb_addr"  name="mainForm" ng-click="supportTBL()">&nbsp;<span ab-label="VGB_ADDRCT"> Addresses </span>&nbsp;&nbsp;</small>
		</li>
		<li>
			<span class="text-warning" ng-model="isPartnerOther" >&nbsp;&nbsp;{{isPartnerOther}}</span>
		</li>

	</ul>
	</div>

	<div class="col-sm-7">
		<label class="btn-xs"   ab-label="STD_CDATE" >VGB_SUPP_CDATE</label>
		<span  value="">{{VGB_SUPP_CDATE}} </span>
	</div>
		
</div>

<div class="row mygrid-wrapper-div ab-borderless" style="margin:0px;padding:0px;">
<a class="hidden" id="VGB_PARTNERrfs" onclick="abLink(this);" href="#VGB_PARTNERS/VGB_SUPPCT/idVGB_BPAR:{{idVGB_BPAR}},idVGB_ADDR:{{idVGB_ADDR}}updType:UPDATE,Session:VGB_SUPPCT,Process:VGB_PARTNERS" >Link</a>
<form id="mainForm" name="mainForm"  ab-view="vgb_supp" ab-main="vgb_supp"  >


<?php

$xtmp = new appForm("VGB_SUPPCT");


echo '<div class="col-sm-3 ab-borderless">';

 
// idVGB_CUST
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";

$xtmp->setFieldWrapper("view01","0.0","vgb_supp","idVGB_SUPP","",$grAttr,$laAttr,$inAttr,"");




// VGB_SUPP_BPART if new
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] .= " {{VGB_SUPP_BPART>0?'hidden':'';}} ";
$laAttr['ab-label'] = "VGB_SUPP_BPART";
$inAttr['ng-blur'] = "VGB_BPAR_BPART = VGB_BPAR_BPART.toUpperCase();val_new_bpar();";
$xtmp->setFieldWrapper("view01","1.01","vgb_bpar","VGB_BPAR_BPART","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


// VGB_SUPP_BPART if exist
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] .= " {{VGB_SUPP_BPART>0?'':'hidden';}} ";
$laAttr['ab-label'] = "VGB_SUPP_BPART";
$xtmp->setFieldWrapper("view01","1.02","vgb_bpar","VGB_BPAR_BPART","",$grAttr,$laAttr,$inAttr,"<label  >{{VGB_BPAR_BPART}}&nbsp;&nbsp;&nbsp;</label>");
echo $xtmp->currHtml;


// VGB_SUPP_BPNAM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "STD_NAME";
$xtmp->setFieldWrapper("view01","2.1","vgb_supp","VGB_SUPP_BPNAM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;



// VGB_SUPP_BTADD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_SUPP_PTADD";
	$keepOrg = 1; 
	$repeatIn = "vgb_supp";
	$searchIn = "";
	$refName = "vgb_addrBT"; // unique
	$refModel = "VGB_SUPP_BTADD"; // unique
	$repeatInRef = "idVGB_ADDR"; //Unique
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_ADDR_ADDID}}","{{ab_rloop.VGB_ADDR_DESCR}}"));
	$searchRefDesc = "";
	$refDetail = implode("<br>",array("{{ab_rloop.VGB_ADDR_ADNAM}}","{{ab_rloop.VGB_ADDR_ADD01}}, {{ab_rloop.VGB_ADDR_ADD02}}","{{ab_rloop.VGB_ADDR_CITYN}}, {{ab_rloop.VGB_ADDR_POSTC}}","{{ab_rloop.VGB_ADDR_CONT1}} - {{ab_rloop.VGB_ADDR_TEL01}}"));
	$refDetailLink = "";
	$ignTrig = "";
	$tmp = new AB_objGen;
	echo "<!-- ";
	$htmlOut = $tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	echo " --> ";
$xtmp->setFieldWrapper("view01","2.2","vgb_supp","VGB_SUPP_BTADD","",$grAttr,$laAttr,$inAttr,$htmlOut);
echo $xtmp->currHtml;



// VGB_SUPP_STADD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_SUPP_SFADD";
	$keepOrg = 1; 
	$repeatIn = "vgb_supp";
	$searchIn = "";
	$refName = "vgb_addrST"; // unique
	$refModel = "VGB_SUPP_STADD"; // unique
	$repeatInRef = "idVGB_ADDR"; //Unique
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_ADDR_ADDID}}","{{ab_rloop.VGB_ADDR_DESCR}}"));
	$searchRefDesc = "";
	$refDetail = implode("<br>",array("{{ab_rloop.VGB_ADDR_ADNAM}}","{{ab_rloop.VGB_ADDR_ADD01}}, {{ab_rloop.VGB_ADDR_ADD02}}","{{ab_rloop.VGB_ADDR_CITYN}}, {{ab_rloop.VGB_ADDR_POSTC}}","{{ab_rloop.VGB_ADDR_CONT1}} - {{ab_rloop.VGB_ADDR_TEL01}}"));
	$refDetailLink = "";
	$ignTrig = "";
	$tmp = new AB_objGen;
	
	echo " <!-- ";
	$htmlOut = $tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	echo " --> ";
$xtmp->setFieldWrapper("view01","2.2","vgb_supp","VGB_SUPP_STADD","",$grAttr,$laAttr,$inAttr,$htmlOut);
echo $xtmp->currHtml;



echo '</div><div class="col-sm-3">';





// VGB_SUPP_CRELI
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CRELI";
$xtmp->setFieldWrapper("view01","2.4","vgb_supp","VGB_SUPP_CRELI","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;



// VGB_SUPP_TERID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_TERM_TERID";
	$keepOrg = 0; 
	$repeatIn = "vgb_term";
	$searchIn = "";
	$refName = "vgb_term"; // unique
	$refModel = "VGB_SUPP_TERID"; // unique
	$repeatInRef = "idVGB_TERM"; //Unique
	$searchRefDesc = "";//implode("&nbsp;&nbsp;",array("{{VGB_TERM_TERID}}","{{VGB_TERM_DESCR}}"));
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_TERM_TERID}}","{{ab_rloop.VGB_TERM_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VGB_TERM_TERID;VGB_TERM_TERID='';VGB_TERM_TERID_F='';kPress('VGB_TERM_TERID','VGB_TERM_TERID','vgb_term',0);VGB_TERM_TERID=hold;".'"';
	$tmp = new AB_objGen;
	echo "<!-- ";
	$htmlOut = $tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	echo "--> ";
$xtmp->setFieldWrapper("view01","2.5","vgb_supp","VGB_SUPP_TERID","",$grAttr,$laAttr,$inAttr,$htmlOut);
echo $xtmp->currHtml;



// VGB_SUPP_CURID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CURID";
	$keepOrg = 0; 
	$repeatIn = "vgb_curr";
	$searchIn = "VGB_CURR_CURID";
	$refName = "vgb_curr"; // unique
	$refModel = "VGB_SUPP_CURID"; // unique
	$repeatInRef = "idVGB_CURR"; //Unique
	$searchRefDesc = "";//implode("&nbsp;&nbsp;",array("{{VGB_CURR_CURID}}","{{VGB_CURR_DESCR}}"));
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_CURR_CURID}}","{{ab_rloop.VGB_CURR_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VGB_CURR_CURID;VGB_CURR_CURID='';VGB_CURR_CURID_F='';kPress('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0);VGB_CURR_CURID=hold;".'"';
	$tmp = new AB_objGen;
	echo "<!-- ";
	$htmlOut = $tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	echo "--> ";
$xtmp->setFieldWrapper("view01","2.6","vgb_supp","VGB_SUPP_CURID","",$grAttr,$laAttr,$inAttr,$htmlOut);
echo $xtmp->currHtml;



// VGB_SUPP_ORFOB
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VSL_ORHE_ORFOB";
$xtmp->setFieldWrapper("view01","2.6","vgb_supp","VGB_SUPP_ORFOB","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;





echo '</div>';


?>

	
</form>
<?php require_once "../appHtml/VGB_ADDRCT.php"; ?>
</div>
</div>
