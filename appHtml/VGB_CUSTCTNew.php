<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>

<div class="hidden">
<?php require_once "../appCscript/VGB_PARTNERS.php"; ?>
</div>

<div style="margin-left:5px;" ng-init="SESSION_DESCR='Maintain Customers'">

	<div class="row ab-spaceless ">
		<div class="col-sm-12 ab-spaceless" ng-model="vgb_cust" >
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		</div>
		<div class="col-sm-5" style="padding:0px;padding-top:5px;">
			<ul class="nav nav-tabs " >


				<li>
					<span class="text-warning" ng-model="isPartnerOther" >&nbsp;&nbsp;{{isPartnerOther}}</span>
			<label class="btn-xs"   ab-label="STD_CDATE" >VGB_CUST_CDATE</label>
			<span  value="">{{VGB_CUST_CDATE}} </span>

				</li>
		
			</ul>
		</div>
	
		<div class="col-sm-7">
		</div>
			
	</div>

	<div class="row mygrid-wrapper-div ab-borderless" style="margin:0px;padding:0px;">
		<form id="mainForm" name="mainForm"  ab-view="vgb_cust" ab-main="vgb_cust"  >


<?php

$xtmp = new appForm("VGB_CUSTCT");
echo '<div class="col-sm-3 ab-borderless">';
// idVGB_CUST
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vgb_cust";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vgb_cust","idVGB_CUST","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;



// VGB_CUST_BPART if new
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] .= " {{VGB_CUST_BPART>0?'hidden':'';}} ";

$inAttr['ng-blur'] = "VGB_BPAR_BPART = VGB_BPAR_BPART.toUpperCase();val_new_bpar();";
$xtmp->setFieldWrapper("view01","1.01","vgb_bpar","VGB_BPAR_BPART","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


// VGB_CUST_BPART if exist
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] .= " {{VGB_CUST_BPART>0?'':'hidden';}} ";

$xtmp->setFieldWrapper("view01","1.02","vgb_bpar","VGB_BPAR_BPART","",$grAttr,$laAttr,$inAttr,"<label  >{{VGB_BPAR_BPART}}&nbsp;&nbsp;&nbsp;</label>");
echo $xtmp->currHtml;


// VGB_CUST_BPNAM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "STD_NAME";
$xtmp->setFieldWrapper("view01","2.1","vgb_cust","VGB_CUST_BPNAM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;



// VGB_CUST_BTADD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "STD_ADDRESS";
	$keepOrg = 1; 
	$repeatIn = "vgb_cust";
	$searchIn = "";
	$refName = "vgb_addrBT"; // unique
	$refModel = "VGB_CUST_BTADD"; // unique
	$repeatInRef = "idVGB_ADDR"; //Unique
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_ADDR_ADDID}}","{{ab_rloop.VGB_ADDR_DESCR}}"));
	$searchRefDesc = "";
	$refDetail = implode("<br>",array("{{ab_rloop.VGB_ADDR_ADNAM}}","{{ab_rloop.VGB_ADDR_ADD01}}, {{ab_rloop.VGB_ADDR_ADD02}}","{{ab_rloop.VGB_ADDR_CITYN}}, {{ab_rloop.VGB_ADDR_POSTC}}","{{ab_rloop.VGB_ADDR_CONT1}} - {{ab_rloop.VGB_ADDR_TEL01}}"));
	$refDetailLink = "";
	$ignTrig = "";
	
	
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$hardCode = "<table><tr><td ab-label='STD_BILL_TO' class='small text-muted' style='white-space:nowrap;width:75px;max-width:75px;font-size:small;'>Pay :</td><td>" . $hardCode . "</td></tr></table>"; 	
	
$xtmp->setFieldWrapper("view01","2.2","vgb_cust","VGB_CUST_BTADD","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;



// VGB_CUST_STADD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr['ab-label'] = "VGB_CUST_STADD";
	$keepOrg = 1; 
	$repeatIn = "vgb_cust";
	$searchIn = "";
	$refName = "vgb_addrST"; // unique
	$refModel = "VGB_CUST_STADD"; // unique
	$repeatInRef = "idVGB_ADDR"; //Unique
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_ADDR_ADDID}}","{{ab_rloop.VGB_ADDR_DESCR}}"));
	$searchRefDesc = "";
	$refDetail = implode("<br>",array("{{ab_rloop.VGB_ADDR_ADNAM}}","{{ab_rloop.VGB_ADDR_ADD01}}, {{ab_rloop.VGB_ADDR_ADD02}}","{{ab_rloop.VGB_ADDR_CITYN}}, {{ab_rloop.VGB_ADDR_POSTC}}","{{ab_rloop.VGB_ADDR_CONT1}} - {{ab_rloop.VGB_ADDR_TEL01}}"));
	$refDetailLink = "";
	$ignTrig = "";
	
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$hardCode = "<table><tr><td ab-label='STD_SHIP_TO' class='small text-muted' style='white-space:nowrap;width:75px;max-width:75px;font-size:small;' >Pay :</td><td>" . $hardCode . "</td></tr></table>"; 	

$laAttr['class'] .= " hidden ";
	
$xtmp->setFieldWrapper("view01","2.2","vgb_cust","VGB_CUST_STADD","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

	// $hardCode = '<small ab-menu="vgb_addr"  name="mainForm" ng-click="supportTBL()">&nbsp;<span class="btn-link ab-pointer glyphicon glyphicon-pencil" style="font-size:large;"></span>&nbsp;&nbsp;</small>';
	$hardCode = '<span  ab-menu="vgb_addr" name="mainForm" class="ab-pointer btn-primary text-primary" ng-click="supportTBL()">&nbsp;';
	$hardCode .= '<span class="glyphicon glyphicon-pencil"></span>&nbsp;';
	$hardCode .= '<span ab-label="VGB_ADDRESS">Addresses</span>&nbsp;';
	$hardCode .= '</span>';
$xtmp->setFieldWrapper("view01","2.2","vgb_cust","VGB_ADDRCT","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

			

		
//		echo '<div>';
//		include "../appHtml/VGB_ADDRCT.php";
//		echo '</div></div><div class="col-sm-3">';
//


// VGB_SUPP_CRELI
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CRELI";
$xtmp->setFieldWrapper("view01","2.4","vgb_supp","VGB_SUPP_CRELI","",$grAttr,$laAttr,$inAttr,"");
echo '</div><div class="col-sm-3">';
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
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view01","2.5","vgb_supp","VGB_SUPP_TERID","",$grAttr,$laAttr,$inAttr,$hardCode);
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
	
	
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view01","2.6","vgb_supp","VGB_SUPP_CURID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;



// VGB_SUPP_ORFOB
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VSL_ORHE_ORFOB";
$xtmp->setFieldWrapper("view01","2.6","vgb_supp","VGB_SUPP_ORFOB","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

echo '</div>';



echo '</form></div></div><div>';
//<iframe src="" name="ab-frm.VGB_ADDRCT" class="ab-borderless ab-spaceless" style="overflow:hidden;width:100%;height:600px;" ></iframe></div>';
include "../appHtml/VGB_ADDRCT.php";
echo '</div>';





?>

	
		
	</div>
</div>
