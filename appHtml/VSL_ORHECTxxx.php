<?php require_once "../stdSscript/stdAppobjGen.php"; ?>

<style>
.boxwrapper label {
	min-width: 25px !important;
}
</style>
<script>

function stepInsert(obj)
{
	var newObj = "<tr ab-formlist='orstep_list' ng-repeat='y in vsl_orhe' ab-new='1' ab-dirty-step='on'>"
	newObj += $(obj).parent().parent().next().html() + "</tr>";
	
	$(obj).parent().parent().parent().append(newObj)
var debug = ""
	
	$("[ab-dirty-step='on']").find("[ng-model]").each(function()
	{
		debug += "=" + $(this).attr("ab-orgval")
		$(this).attr("ab-orgval","")
		debug += "=" + $(this).attr("ab-orgval") + "\n"
	
	});
	
	$("[ab-dirty-step='on']").attr("ab-dirty-step","done");
	
	
	
//	$(obj).parent().parent().next().after('<tr>' + $(obj).parent().parent().next().html() + '</tr>');
//	$(obj).parent().parent().next().attr('ab-formlist','orstep_list');
//	$(obj).parent().parent().next().attr('ng-repeat','y in vsl_orhe');
//	$(obj).parent().parent().next().attr('ab-new','1');

}

</script>

<div class="hidden">
<?php 
session_start();
ob_clean();
require_once "../appCscript/VSL_ORDERS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>

<textarea class="hidden" ab-updSuccess="" >
if (data['posts'].requestMethod == 'DELETE')
{
	$("#ab-back").click(); 
}
else
{

	if ($scope.opts.updType == "CREATE")
	{
		location.href="#VSL_ORDERS/VSL_ORHECT/idVSL_ORHE:" + data['posts'].insertId + ",updType:UPDATE,Session:VSL_ORHECT,Process:VSL_ORDERS"
	}
	else
	{
		$scope.initOrder();
	}


}

</textarea>

</div>
<div class="hidden" ng-init="SESSION_DESCR='Sales Order Control'">
	<span ab-label="VSL_ORHECT"></span>
</div>
<div id="ab-new" class="hidden" >
	<label  title="CREATE" class="{{opts.updType!='CREATE'?'':'hidden'}}">
		 <a 
	href="#VSL_ORDERS/VSL_ORHECT/Process:VSL_ORDERS,Session:VSL_ORHECT,tblName:vsl_orhe,updType:CREATE,idVSL_ORHE:0,tbData:{{tbData}}" 
	>
		<span >New</span>
		<span  class="glyphicon glyphicon-pencil" ></span>
	</a>			
	</label>
	
</div>
	<script>
		$('#ab-appOpt').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
		
		
		$('#ab-delete').find("[ng-click]").attr("ng-click","delSet();")
		
	</script>
							
<div style="margin-left:5px;">
	<!-- <div id="mainForm" ab-main="vin_unit" style="margin:0px;"> -->
	  			
		<div class="row">
			<div class="col-sm-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>

			<form id="mainForm" name="mainForm"  ab-context="1" ab-view="vsl_orhe" ab-main="vsl_orhe"  >			
			<div class="col-sm-2 ">

				<input  class="hidden" ab-btrigger="vsl_orhe" ng-model="idVSL_ORHE" /> 
<?php

	// 1,040" VSL_ORHE_ORNUM 
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_ORNUM";
	$inAttr = $xtmp->inAttrib;
	$inAttr["size"] = "10";
	$xtmp->setFieldWrapper("view01","1.040","vsl_orhe","VSL_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;	
	
	// 2,010	 	VSL_ORHE_USLNA
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] .= " hidden ";
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_USLNA";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.010","VSL_ORHE_USLNA","VSL_ORHE_USLNA","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;


$hardCode =<<<EOC
	
<span>
<input class="hidden" id="VGB_CUSTsearch" 
ng-click="
VSL_ORHE_BTCUS = abSessionResponse.idVGB_CUST;
VSL_ORHE_STCUS = abSessionResponse.idVGB_CUST;
VSL_ORHE_OBCUS = abSessionResponse.idVGB_CUST;
VSL_ORHE_BTADD = abSessionResponse.VGB_CUST_BTADD;
VSL_ORHE_STADD = abSessionResponse.VGB_CUST_STADD;
VGB_CUST_BPNAM = abSessionResponse.VGB_CUST_BPNAM;
VSL_ORHE_BAORA = abSessionResponse.VGB_CUST_BAORA;
VSL_ORHE_CRHOL = abSessionResponse.VGB_CUST_CRHOL;
VSL_ORHE_TERID = abSessionResponse.VGB_CUST_TERID;
VSL_ORHE_SLSRP = abSessionResponse.VGB_CUST_SLSRP;
VSL_ORHE_CFCAT = abSessionResponse.VGB_CUST_CFCAT;
" />
<a class="ab-pointer" ng-click="ABsessionLink('#/VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_cust','#VGB_CUSTsearch');" >

<span class="glyphicon glyphicon-search" ></span>

</span>
</a>	
<label>&nbsp{{ VGB_CUST_BPNAM }}</label>		
EOC;

		
	//2,030	 	VSL_ORHE_BTCUS
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_BTCUS";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.030","VSL_ORHE_BTCUS","VSL_ORHE_BTCUS","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;

	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] = "hidden";
	$laAttr = $xtmp->laAttrib;
	$laAttr["class"] = "hidden";
	$inAttr = $xtmp->inAttrib;
	$inAttr["class"] = "hidden";
	$xtmp->setFieldWrapper("view01","2.030","VSL_ORHE_BTCUS","VSL_ORHE_BTCUS","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;	
		
	// 2,035 VSL_ORHE_STCUS <- Always default to VSL_ORHE_BTCUS (Hidden) (sys Parameter)
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] .= " hidden ";
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_STCUS";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.035","vsl_orhe","VSL_ORHE_STCUS","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
		

	// 2,037	 	VSL_ORHE_OBCUS <- Always default to VSL_ORHE_BTCUS (Hidden) (sys Parameter)
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] .= " hidden ";
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_OBCUS";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.037","vsl_orhe","VSL_ORHE_OBCUS","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
		

	/*//2,050	 	VSL_ORHE_BTADD
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_BTADD";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.050","vsl_orhe","VSL_ORHE_BTADD","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
		

	//2,060	 	VSL_ORHE_STADD
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_STADD";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.060","vsl_orhe","VSL_ORHE_STADD","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;*/
	
	//2,050	 	VSL_ORHE_BTADD
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "STD_ADDRESS";
	$keepOrg = 1; 
	$repeatIn = "vsl_orhe | AB_noDoubles:'idVGB_ADDR'";
	$searchIn = "";
	$refName = "VSL_ORHE_BTADD"; // unique
	$refModel = "VSL_ORHE_BTADD"; // unique
	$repeatInRef = "idVGB_ADDR"; //Unique
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_ADDR_ADDID}}","{{ab_rloop.VGB_ADDR_DESCR}}"));
	$searchRefDesc = "";
	$refDetail = implode("<br>",array("{{ab_rloop.VGB_ADDR_ADNAM}}","{{ab_rloop.VGB_ADDR_ADD01}}, {{ab_rloop.VGB_ADDR_ADD02}}","{{ab_rloop.VGB_ADDR_CITYN}}, {{ab_rloop.VGB_ADDR_POSTC}}","{{ab_rloop.VGB_ADDR_CONT1}} - {{ab_rloop.VGB_ADDR_TEL01}}"));
	$refDetailLink = "";
	$ignTrig = "";

	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$hardCode = "<table  class='small'><tr><td ab-label='STD_BILL_TO' class='small text-primary' style='white-space:nowrap;width:40px;max-width:50px;font-size:small;'>Bill to:</td><td>:</td><td>" . $hardCode . "</td></tr></table>"; 	
   $xtmp->setFieldWrapper("view01","2.050","vsl_orhe","VSL_ORHE_BTADD","",$grAttr,$laAttr,$inAttr,$hardCode);
   echo $xtmp->currHtml;
   
	//2,060	 	VSL_ORHE_STADD
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "STD_SHIP_TO";

	$keepOrg = 1; 
	$repeatIn = "vsl_orhe | AB_noDoubles:'idVGB_ADDR'";
	$searchIn = "";
	$refName = "VSL_ORHE_STADD"; // unique
	$refModel = "VSL_ORHE_STADD"; // unique
	$repeatInRef = "idVGB_ADDR"; //Unique
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_ADDR_ADDID}}","{{ab_rloop.VGB_ADDR_DESCR}}"));
	//$hardCode = '<span ab-menu="vgb_addr" name="mainForm"  class="ab-pointer btn-primary text-primary" ng-click="supportTBL()">&nbsp;';
	//$hardCode .= '<span class="glyphicon glyphicon-pencil"></span>&nbsp;';
	//$hardCode .= '</span>';
	$searchRefDesc = "";
	$refDetail = $hardCode . implode("<br>",array("{{ab_rloop.VGB_ADDR_ADNAM}}","{{ab_rloop.VGB_ADDR_ADD01}}, {{ab_rloop.VGB_ADDR_ADD02}}","{{ab_rloop.VGB_ADDR_CITYN}}, {{ab_rloop.VGB_ADDR_POSTC}}","{{ab_rloop.VGB_ADDR_CONT1}} - {{ab_rloop.VGB_ADDR_TEL01}}"));
	$refDetailLink = "";
	$ignTrig = "";
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$hardCode = "<table  class='small'><tr><td ab-label='STD_SHIP_TO' class='small text-primary' style='white-space:nowrap;width:45px;max-width:50px;font-size:small;' >Ship To:</td><td>:</td><td>" . $hardCode . "</td></tr></table>"; 	
	$laAttr['class'] .= " hidden ";
	
	$xtmp->setFieldWrapper("view01","2.060","vsl_orhe","VSL_ORHE_STADD","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
	
	
	//2,080	 	VSL_ORHE_CUSPO
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_CUSPO";
	$inAttr = $xtmp->inAttrib;
	$inAttr["size"] = "20";
	$xtmp->setFieldWrapper("view01","2.080","vsl_orhe","VSL_ORHE_CUSPO","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
		
	//2,120	 	VSL_ORHE_ORFOB
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_ORFOB";
	$inAttr = $xtmp->inAttrib;
	$inAttr["size"] = "10";
	$xtmp->setFieldWrapper("view01","2.120","vsl_orhe","VSL_ORHE_ORFOB","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
		

	//2,130	 	VSL_ORHE_ORVIA
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_ORVIA";
	$inAttr = $xtmp->inAttrib;
	$inAttr["size"] = "10";
	$xtmp->setFieldWrapper("view01","2.130","vsl_orhe","VSL_ORHE_ORVIA","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;		
	
	// Spacer
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$grAttr['class'] += " invisible ";
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.105","vsl_orhe","","",$grAttr,$laAttr,$inAttr," ");
	echo $xtmp->currHtml;


	//2,070	 	VSL_ORHE_CURID
	$xtmp = new appForm("VSL_ORDERS");
	/*$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_CURRENCY";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.070","vsl_orhe","VSL_ORHE_CURID","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;*/
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "STD_CURRENCY";

	$keepOrg = 0; 
	$repeatIn = "vgb_curr";
	$searchIn = "";
	$refName = "VSL_ORHE_CURID"; // unique
	$refModel = "VSL_ORHE_CURID"; // unique
	$repeatInRef = "idVGB_CURR"; //Unique
	$searchRefDesc = "{{" . "VGB_CURR_CURID}}" . " {{" . "VGB_CURR_DESCR}}";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_CURR_CURID}}","{{ab_rloop.VGB_CURR_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VGB_CURR_CURID;VGB_CURR_CURID='';VGB_CURR_CURID_F='';ABlstAlias('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0);VGB_CURR_CURID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$xtmp->setFieldWrapper("view01","2.070","vsl_orhe","VSL_ORHE_CURID","",$grAttr,$laAttr,$inAttr,$hardCode);
  	echo $xtmp->currHtml;

	echo '</div><div class="col-sm-2 ">';

	// Spacer
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$grAttr['class'] += " invisible ";
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.105","vsl_orhe","","",$grAttr,$laAttr,$inAttr,"<br>");
	echo $xtmp->currHtml;
	

	//2,090	 	VSL_ORHE_ODATE
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_ODATE";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setDatePick("VSL_ORHE_ODATE");
	$xtmp->setFieldWrapper("view01","2.090","vsl_orhe","VSL_ORHE_ODATE","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;

	
	//2,085	 	VSL_ORHE_PRLEV
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_PRIORITY";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.085","vsl_orhe","VSL_ORHE_PRLEV","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
	
	//2,105	 	VSL_ORHE_CFCAT
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VIN_ITEM_CFCAT";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setYesNoField("VSL_ORHE_CFCAT");
	$xtmp->setFieldWrapper("view01","2.105","vsl_orhe","VSL_ORHE_CFCAT","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
		

	//2,110	 	VSL_ORHE_BAORA
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VGB_CUST_BAORA";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setYesNoField("VSL_ORHE_BAORA");
	$xtmp->setFieldWrapper("view01","2.110","vsl_orhe","VSL_ORHE_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
		

	//2,115	 	VSL_ORHE_CRHOL
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VGB_CUST_CRHOL";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setYesNoField("VSL_ORHE_CRHOL");
	$xtmp->setFieldWrapper("view01","2.115","vsl_orhe","VSL_ORHE_CRHOL","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
		
	//2,140	 	VSL_ORHE_SLSRP
	$xtmp = new appForm("VSL_ORDERS");
	/*$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VGB_SLRP_SLSRP";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.140","vsl_orhe","VSL_ORHE_SLSRP","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;*/
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr["ab-label"] = "VGB_SLRP_SLSRP";

	$keepOrg = 0; 
	$repeatIn = "vgb_slrp";
	$searchIn = "";
	$refName = "vgb_slrp"; // unique
	$refModel = "VSL_ORHE_SLSRP"; // unique
	$repeatInRef = "idVGB_SLRP"; //Unique
	$searchRefDesc = "";
	$searchRefDesc = "{{" . "VGB_SLRP_SLSRP}}" . " {{" . "VGB_SLRP_SRNAM}}";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_SLRP_SLSRP}}","{{ab_rloop.VGB_SLRP_SRNAM}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VGB_SLRP_SLSRP;VGB_SLRP_SLSRP='';VGB_SLRP_SLSRP_F='';ABlstAlias('VGB_SLRP_SLSRP','VGB_SLRP_SLSRP','vgb_slrp',0);VGB_CURR_CURID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$xtmp->setFieldWrapper("view01","2.140","vsl_orhe","VSL_ORHE_SLSRP","",$grAttr,$laAttr,$inAttr,$hardCode);
   echo $xtmp->currHtml;
		

	//2,150	 	VSL_ORHE_TERID	

	$xtmp = new appForm("VSL_ORDERS");
	/*$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VGB_CUST_TEIDC";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.150","vsl_orhe","VSL_ORHE_TERID","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;*/
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "VGB_CUST_TEIDC";

	$keepOrg = 0; 
	$repeatIn = "vgb_term";
	$searchIn = "";
	$refName = "vgb_term"; // unique
	$refModel = "VSL_ORHE_TERID"; // unique
	$repeatInRef = "idVGB_TERM"; //Unique
	$searchRefDesc = "";//implode("&nbsp;&nbsp;",array("{{VGB_TERM_TERID}}","{{VGB_TERM_DESCR}}"));
	$searchRefDesc = "{{" . "VGB_TERM_TERID}}" . " {{" . "VGB_TERM_DESCR}}";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_TERM_TERID}}","{{ab_rloop.VGB_TERM_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VGB_TERM_TERID;VGB_TERM_TERID='';VGB_TERM_TERID_F='';ABlstAlias('VGB_TERM_TERID','VGB_TERM_TERID','vgb_term',0);VGB_TERM_TERID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
$xtmp->setFieldWrapper("view01","2.150","vsl_orhe","VSL_ORHE_TERID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
		
echo '<div>';

require_once "../appHtml/VIN_ITEMS.model.php";

echo '</div>';


?>

<input type="hidden" id="VIEW_ITEMS" ng-click="FLT_ITEM_ITMID=VIN_ITEM_ITMID;VIN_ITEM_ITMID=' ';ABlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,FLT_ITEM_LOTCT,FLT_ITEM_ITMID','vin_item');VIN_ITEM_ITMID=FLT_ITEM_ITMID;" />
<input class="hidden" onclick='$("input").removeAttr("ab-search-target");$(this).attr("ab-search-target","on");$("#VIEW_ITEMS").click();$("#ab-sessionBoardVIN_ITEMS").click();' value="Click" />			
		</div>
</form>

		<div class="col-sm-8 ">
			<div class="row">
				<div class="col-sm-12">
				
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-sm-12">
				  	<table   class="table-condensed {{opts.updType!='CREATE'?'':'hidden'}}">
				  	
					<tr class="bg-primary ">
						<td class=" ab-spaceless" style="vertical-align:top;" >
							
								<span class="ab-pointer"
									ng-click="insertInDetail();" 
								>
									<span class="small" >Insert</span>
									<span  class="glyphicon glyphicon-pencil small" ></span>
								</span>			
							
	
						</td>					
						<td class=" ab-spaceless">
					
							
							<?php

// $xtmp = new appForm("VIN_USETS");

$xtmp->inAttrib["class"] = "invisible";


$xtmp->grAttrib["class"] = "ab-spaceless small";
$xtmp->laAttrib["class"] = "";
$xtmp->grAttrib["style"] = "height:20px;";
//VSL_ORDE_ORLIN
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "5";
$laAttr["ab-label"] = "STD_ORLIN_SH";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","VSL_ORDE_ORLIN","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';


echo '<td>';
// VSL_ORDE_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "10";

$laAttr["ab-label"] = "VIN_ITEM_ITMID";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","VSL_ORDE_ITMID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td>';
// VSL_ORDE_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "15";

$laAttr["ab-label"] = "STD_DESCR";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td>';
// VSL_ORDE_ODATE
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "5";
$laAttr["ab-label"] = "VSL_ORHE_ODATE";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ODATE","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td>';
// VSL_ORDE_DDATE
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "6";
$laAttr["ab-label"] = "VSL_ORHE_DDATE_10";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_DDATE","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td>';
// VSL_ORDE_ORDQT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "5";
$laAttr["ab-label"] = "STD_QUANTITY_SHORT";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ORDQT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td>';
// VSL_ORDE_OUNET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["ab-label"] = "STD_PRICE";
$inAttr["size"] = "5";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.STD_PRICE","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td>';
// VSL_ORDE_SAUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "5";

$laAttr["ab-label"] = "STD_UOM_SHORT";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_SAUOM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

$xtmp = new appForm("VSL_ORHE");

							?>
					
						
						</tr>	
					</table>
				</div>
			</div>		
			<div class="mygrid-wrapper-div"  style="margin:0px;padding:0px;">
			<div class="row">
				<div class="col-sm-12">
				  	<table   class="table-condensed {{opts.updType!='CREATE'?'':'hidden'}}">
				

		  						<tr ab-formlist="order_list"   ab-rowset="{{$index}}"   ab-new="{{ x.idVSL_ORDE < 1?'1':'0' }}"
		  						
		  						role="presentation" ng-repeat="x in vsl_orhe | AB_noDoubles:'VSL_ORDE_ORLIN' " 
		  						ng-if="x.VSL_ORDE_ORLIN > 0"
		  						class="{{x.VSL_ORDE_ORLIN > 0?'':'hidden'}}"
		  						 >
								<td colspan=100 class="ab-spaceless">
								<div>
								
									<form ab-view="vsl_orde" ab-main="vsl_orde" ab-context="0" >
									<table  class="table-condensed {{x.trash==1?'text-danger':''}}" style="width:100%;" >
									<tr>

									<td class="{{x.trash==1?'text-danger':'text-primary'}}" >
									
									<input type="checkbox" value="0" onclick="$(this).val(1-$(this).val());" ng-model="x.trash" class="text-primary" />
									<span  class="glyphicon glyphicon-trash small" ></span>
									&nbsp;&nbsp;&nbsp;
									</td>

		  							<td>

		  							<input class="hidden" ng-model="idVSL_ORHE" />
		  							<input class="hidden" ab-btrigger="vsl_orhe"  ng-model="x.idVSL_ORDE" /> 
		  							<input class="hidden" ng-model="x.VSL_ORDE_ORNUM" /> 
		  							<input class="hidden" ng-model="x.VSL_ORDE_WARID" /> 
		  							<input class="hidden" ng-model="x.VSL_ORDE_LOCID" /> 
<?php 
// 									



//		1,020	 	VSL_ORDE_ORLIN 5
//		2,010	 	VSL_ORDE_ITMID 10
//		2,020	 	VSL_ORDE_DESCR 25
//		2,030	 	VSL_ORDE_ODATE 6
//		2,035	 	VSL_ORDE_DDATE 6
//		2,050	 	VSL_ORDE_SAUOM 5
//		2,060	 	VSL_ORDE_WARID
//		2,070	 	VSL_ORDE_LOCID
//		2,040	 	VSL_ORDE_ORDQT 5 --> for each ORST_MAIN_STPSQ



// $xtmp = new appForm("VIN_USETS");
$xtmp->laAttrib["class"] .= " hidden ";
$xtmp->grAttrib["class"] = "ab-spaceless";
$xtmp->grAttrib["style"] = "";
//VSL_ORDE_ORLIN
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "5";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ORLIN","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td>';
?>
<span>
<input class="hidden" id="VIN_ITEMsearch{{x.VSL_ORDE_ORLIN}}"
ng-click="
x.VIN_ITEM_ITMID = abSessionResponse.VIN_ITEM_ITMID;
x.VSL_ORDE_ITMID = abSessionResponse.idVIN_ITEM;
x.VSL_ORDE_DESCR = abSessionResponse.VIN_ITEM_DESC1;
x.VSL_ORDE_OUNET = abSessionResponse.VIN_ITEM_LISTP;
x.VSL_ORDE_SAUOM = abSessionResponse.VIN_ITEM_UNITM;
x.VSL_ORDE_QTUOM = abSessionResponse.VIN_ITEM_UNITM;
x.VSL_ORDE_LISTP = abSessionResponse.VIN_ITEM_LISTP;
" />

<a class="ab-pointer" ng-click="ABsessionLink('#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item','#VIN_ITEMsearch'+ x.VSL_ORDE_ORLIN);" >


<span class="glyphicon glyphicon-search" ></span>

</span>
</a>	
<span >{{ x.VIN_ITEM_ITMID }}</span>		
<?php


// VSL_ORDE_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "10";
$inAttr["class"] = "hidden";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ITMID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

echo '</td>';

echo '<td>';
// VSL_ORDE_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "15";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td style="width:100px; font-size:70%;">';
// VSL_ORDE_ODATE

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "6";
$hardCode = $xtmp->setDatePick("x.VSL_ORDE_ODATE");
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ODATE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</td>';

echo '<td style="width:100px; font-size:70%;">';
// VSL_ORDE_DDATE
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "6";
$hardCode = $xtmp->setDatePick("x.VSL_ORDE_DDATE");
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_DDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</td>';

echo '<td>';
// VSL_ORDE_ORDQT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "4";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ORDQT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';


echo '<td>';
// VSL_ORDE_OUNET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "4";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_OUNET","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td>';
// VSL_ORDE_SAUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "4";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_SAUOM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';


?>
						
  			


	</tr>
	<tr>
		<td colspan=100 class="ab-spaceless" >
			<!- ab-label will updated with required label for ng-repeats -->
			<span class="hidden">
				<span ab-label="VGB_CUST_BAORA_SHO" ></span>
				<span ab-label="VIN_ITEM_PICKP" ></span>
				<span ab-label="VIN_ITEM_PACKP" ></span>
				
			
			</span>
		


			<table  class=" small {{x.trash==1?'text-danger':''}}" style="width:100%;vertical-align:top;" >
			<tr>
			<td style="width:20%;" ></td>
			<td style="width:20%;" ></td>
			<td style="width:60%;" ></td>
			</tr>

<?php 			
$xtmp = new appForm("VSL_ORHE");
$xtmp->grAttrib["class"] = "ab-spaceless small";
$xtmp->grAttrib["style"] = "";

echo '<td style="vertical-align:top;" ><table ><tr><td>';
// VSL_ORDE_BAORA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "VGB_CUST_BAORA_SHO";
$inAttr = $xtmp->inAttrib;
$inAttr["class"] = "hidden";
$xtmp->setFieldWrapper("view01","0.111","vsl_orde","VSL_ORDE_BAORA","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td class="boxwrapper" style="vertical-align:top;width:80px;">';
// VSL_ORDE_BAORA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$hardCode = $xtmp->setYesNoField("x.VSL_ORDE_BAORA");
$xtmp->setFieldWrapper("view01","0.122","vsl_orde","x.VSL_ORDE_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</td>';

	
echo '</tr><tr>';

echo '<td>';
// VSL_ORDE_PICKP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "VIN_ITEM_PICKP";
$inAttr = $xtmp->inAttrib;
$inAttr["class"] = "hidden";
$xtmp->setFieldWrapper("view01","0.111","vsl_orde","VIN_ITEM_PICKP","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td class="boxwrapper">';
// VSL_ORDE_PICKP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$hardCode = $xtmp->setYesNoField("x.VSL_ORDE_PICKP");
$xtmp->setFieldWrapper("view01","0.122","vsl_orde","x.VSL_ORDE_PICKP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</td>';

	
echo '</tr></tr>';

echo '<td>';
// VSL_ORDE_PACKP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "VIN_ITEM_PACKP";
$inAttr = $xtmp->inAttrib;
$inAttr["class"] = "hidden";
$xtmp->setFieldWrapper("view01","0.111","vsl_orde","VIN_ITEM_PACKP","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td class="boxwrapper">';
// VSL_ORDE_PACKP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$hardCode = $xtmp->setYesNoField("x.VSL_ORDE_PACKP");
$xtmp->setFieldWrapper("view01","0.122","vsl_orde","x.VSL_ORDE_PACKP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

echo '</td></tr></table></td>';
	
echo '<td rowspan="100" style="vertical-align:top;">';
// VSL_ORDE_DTEXT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";

$hardCode = '<textarea rows="4" cols="20" ng-model="x.VSL_ORDE_ITEXT" class="ab-borderless" ng-init="x.VSL_ORDE_ITEXT=\'This field will need to be added in vsl_orde  to replace legacy table vsl_ordr.\'"> </textarea>';


$xtmp->setFieldWrapper("view01","0.122","vsl_orde","x.VSL_ORDE_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</td>';

$stepCode = <<<EOC

<td rowspan=100 class="ab-spaceless  small " style="vertical-align:top;font-weight:900;">

	<table class=" ab-spaceless" style="width:100%;vertical-align:top;">
		<tr class="bg-primary" >
		
			<td class="ab-spaceless" style="vertical-align:top;padding-left:2px;width:60px;">
										
								<span class="ab-pointer" ng-click="insertInStep(x.VSL_ORDE_ORLIN);" onklick="stepInsert(this);" >
									<span class="small" >Insert</span>
									<span  class="glyphicon glyphicon-pencil small" ></span>
								</span>			
			</td>
			<td style="font-weight:700;width:40px;" ab-label="VSL_ORST_STPSQxxx">				
			Seq.</td>
			<td style="font-weight:700;width:80px;" ab-label="VSL_ORST_PDATE">Plan Date</td> 
			<td style="font-weight:700;width:80px;" ab-label="STD_QUANTITY_SHORT">Quantity</td>
			<td style="font-weight:700;"><span ab-label="VSL_ORST_STEPS">Seq. Steps&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			
			
			</td>
		
		
		</tr>
		
		<tr  ab-formlist="orstep_list"  
			ab-new="{{ x.idVSL_ORDE < 1 || idVSL_ORST < 1?'1':'0' }}"
			ordline="{{x.VSL_ORDE_ORLIN}}" 
			ng-repeat="y in vsl_orhe | AB_Sorted:VSL_ORST_STPSQ "
			 cqwelass="{{x.VSL_ORDE_ORLIN==y.VSL_ORDE_ORLIN?'':'hidden'}}"
			ng-if="x.VSL_ORDE_ORLIN==y.VSL_ORDE_ORLIN"
		>
		
<td colspan=100 class="ab-spaceless {{wid==1?'text-danger':''}}">
<div class="ab-spaceless">
<table  class="table-condensed ab-spaceless  {{wid==1?'text-danger':'text-primary'}}"" style="width:100%">
<tr>


EOC;

// var debug = "\n--================-----\n" + $("#focusGrid").val();
// $("#focusGrid").val(showProps(dDta.dbUpd.out.RECSET[1],"s")+debug)

$stepCode .= <<<EOC
	<td style="min-width:50px;">
		<input type="checkbox" value="0" onclick="$(this).val(1-$(this).val());" ng-model="y.trash" class="text-primary" />
		<span  class="glyphicon glyphicon-trash small" ></span>
		&nbsp;&nbsp;&nbsp;
	</td>
EOC;

// VSL_ORST_STPSQ
$stepCode .= '<td>';

		
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["class"] = "hidden";


$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.idVSL_ORST","",$grAttr,$laAttr,$inAttr,"");
$stepCode .= $xtmp->currHtml;

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "2";


$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_STPSQ","",$grAttr,$laAttr,$inAttr,"");
$stepCode .= $xtmp->currHtml;
$stepCode .= '</td>';

// VSL_ORST_PDATE
$stepCode .= '<td style="min-width:100px;">';
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$hardCode = $xtmp->setDatePick("y.VSL_ORST_PDATE");
$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_PDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
$stepCode .= $xtmp->currHtml;
$stepCode .= '</td>';

// VSL_ORST_ORDQT
$stepCode .= '<td>';
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$inAttr["title"] = "VSL_ORST_ORDQT.{{" . "y.idVSL_ORST" . "}}";


$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_ORDQT","",$grAttr,$laAttr,$inAttr,"");
$stepCode .= $xtmp->currHtml;
$stepCode .= '</td>';

$stepCode .= '<td class="ab-spaceless "><input class="hidden" ng-model=" y.VSL_ORST_WARID" /><input class="hidden" ng-model=" y.VSL_ORST_LOCID" /></td>';

// VSL_ORST_STEPS
$stepCode .= '<td>';
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "10";


$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_STEPS","",$grAttr,$laAttr,$inAttr,"");
$stepCode .= $xtmp->currHtml;
$stepCode .= '</td>';

$stepCode .= <<<EOC

</tr>




</table>
</div>
</td>
</tr>
</table>
</td>

EOC;

echo $stepCode;


//			2,550	 	VSL_ORDE_OUNET
//			2,600	 	VSL_ORDE_CMETH
//			2,610	 	VSL_ORDE_COSTP
//			2,620	 	VSL_ORDE_BAORA
//			2,630	 	VSL_ORDE_PICKP
//			2,640	 	VSL_ORDE_PACKP
?>
			</tr>
			
		</td>
	</tr>
	</table>
	</form>	
	</div>
	</td>
	
	  	</tr>
		

	  	  </table>
	</div>

</div>
</div>
</div>
</div>
<!--
<table class=" ">
	  <tr class="ab-spaceless">
	  		<td>
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vin_item'?'vin_item':'Yes'}}"
			class="hidden{{ tbData=='vin_item'?'xxx':''}} text-primary" >
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',1)"  > </span>
			</span>
			</td>
	</tr>
	<tr>		  
	  	<td> 
		  <div class="visible-lg">
			&nbsp;
			<span ng-repeat="org in AB_DUSA.orgLevels |AB_Selected:AB_DUSA.usrLevels.CurrentAffect:'levelId' " class=" {{org.isSelected}} " >{{org.levelDescr}}</span>	
			
		  <div>
	  	</td>
	  </tr>
</table>
-->	
</div>
</div>
</tr>
</table>
</div>



</div>	


</div>
<div class='btn-sm ab-body-buttons hidden' >
	<span class='hidden'>
		Records per page:&nbsp;
		<select class='text-muted' ab-mpp onchange="getMaxPerPage();" value="100" >
		  <option value="10">10</option>
		  <option value="20" >20</option>
		  <option value="40"  >40</option>
		  <option value="100" selected >100</option>
		</select>

	</span>
</div>

<div class='ab-border'></div>

