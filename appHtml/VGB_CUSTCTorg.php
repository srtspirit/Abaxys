<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
	<?php require_once "../appCscript/VGB_PARTNERS.php"; ?>
</div>

<div style="margin-left:5px;" ng-init="SESSION_DESCR='Maintain Customers'">

	<div  class="row ab-spaceless " >
		<div class="col-sm-12 ab-spaceless"  >
	
			<?php  // require_once "../stdCscript/stdFormButtons.php"; ?>
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			
		</div>
		<div  class="col-sm-5 " style="padding:0px;padding-top:5px;">
		<ul  class="nav nav-tabs" >
			<li  class="ab-tabs ab-tab-on ab-pointer" >
				<small ab-menu="vgb_cust" name="mainForm" class="text-primary">&nbsp;<span  ab-label="VGB_CUSTCT"> Customer </span>&nbsp;&nbsp;</small> 
			</li>
	
			<li  class="ab-tabs ab-pointer" >
				<small ab-menu="vgb_addr"  name="mainForm" ng-click="supportTBL()">&nbsp;<span ab-label="VGB_ADDRCT"> Addresses </span>&nbsp;&nbsp;</small>
			</li>
			<li >
				<span class="text-warning" ng-model="isPartnerOther" >&nbsp;&nbsp;{{isPartnerOther}}</span>
			</li>
			<li >
				<b><span id="formSaveSuccess" style="color:transparent;" >Successfull</span></b>	
			</li>
		</ul>	
		</div>
	
		<div class="col-sm-7 ab-spaceless">
			<label class="btn-xs"   ab-label="STD_CDATE" >VGB_CUST_CDATE</label>
			<span  value="">{{VGB_CUST_CDATE}} </span>
			
			
		</div>
			
	</div>

<div class="row mygrid-wrapper-div" style="margin:0px;padding:0px;">
<a class="hidden" id="VGB_PARTNERrfs" onclick="abLink(this);" href="#VGB_PARTNERS/VGB_CUSTCT/idVGB_BPAR:{{idVGB_BPAR}},idVGB_ADDR:{{idVGB_ADDR}}updType:UPDATE,Session:VGB_CUSTCT,Process:VGB_PARTNERS" >Link</a>
<form id="mainForm" name="mainForm"  ab-view="vgb_cust" ab-main="vgb_cust"  >
<br>

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
	$hardCode = "<table><tr><td ab-label='STD_BILL_TO' class='small text-muted' style='white-space:nowrap;width:75px;max-width:75px;font-size:small;'>Bill to:</td><td>" . $hardCode . "</td></tr></table>"; 	
	
$xtmp->setFieldWrapper("view01","2.2","vgb_cust","VGB_CUST_BTADD","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;



// VGB_CUST_STADD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr['ab-label'] = "STD_SHIP_TO";
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
	$hardCode = "<table><tr><td ab-label='STD_SHIP_TO' class='small text-muted' style='white-space:nowrap;width:75px;max-width:75px;font-size:small;' >Ship To:</td><td>" . $hardCode . "</td></tr></table>"; 	

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








// VGB_CUST_CRELI
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CRELI";
$inAttr['size'] = 10;
$xtmp->setFieldWrapper("view02","2.4","vgb_cust","VGB_CUST_CRELI","",$grAttr,$laAttr,$inAttr,"");

echo $xtmp->currHtml;


// VGB_CUST_OVERD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr['ab-label'] = "STD_OVERDUE_DAYS";
$inAttr['size'] = 2;

$xtmp->setFieldWrapper("view02","2.4","vgb_cust","VGB_CUST_OVERD","",$grAttr,$laAttr,$inAttr,"");

echo $xtmp->currHtml;


// VGB_CUST_TERID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_TERM_TERID";

	$keepOrg = 0; 
	$repeatIn = "vgb_term";
	$searchIn = "";
	$refName = "vgb_term"; // unique
	$refModel = "VGB_CUST_TERID"; // unique
	$repeatInRef = "idVGB_TERM"; //Unique
	$searchRefDesc = "";//implode("&nbsp;&nbsp;",array("{{VGB_TERM_TERID}}","{{VGB_TERM_DESCR}}"));
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_TERM_TERID}}","{{ab_rloop.VGB_TERM_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VGB_TERM_TERID;VGB_TERM_TERID='';VGB_TERM_TERID_F='';kPress('VGB_TERM_TERID','VGB_TERM_TERID','vgb_term',0);VGB_TERM_TERID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view02","2.5","vgb_cust","VGB_CUST_TERID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;



// VGB_CUST_CURID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CURID";
	$keepOrg = 0; 
	$repeatIn = "vgb_curr";
	$searchIn = "VGB_CURR_CURID";
	$refName = "vgb_curr"; // unique
	$refModel = "VGB_CUST_CURID"; // unique
	$repeatInRef = "idVGB_CURR"; //Unique
	$searchRefDesc = "";//implode("&nbsp;&nbsp;",array("{{VGB_CURR_CURID}}","{{VGB_CURR_DESCR}}"));
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_CURR_CURID}}","{{ab_rloop.VGB_CURR_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VGB_CURR_CURID;VGB_CURR_CURID='';VGB_CURR_CURID_F='';kPress('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0);VGB_CURR_CURID=hold;".'"';
	
	
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view02","2.6","vgb_cust","VGB_CUST_CURID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

echo '</div><div class="col-sm-3">';


// STD_BANK INfo 

$hardCode = "<table>";

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";

$xtmp->setFieldWrapper("view03","0.0","vgb_cust","VGB_CUST_CUBNK","",$grAttr,$laAttr,$inAttr,"");
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td ab-label='STD_NAME' class='" . $laAttr['class'] . "' ></td>";
$hardCode .= "<td>" . $xtmp->currHtml . "</td></tr>";


// VGB_CUST_CREDR 
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";

$xtmp->setFieldWrapper("view03","0.0","vgb_cust","VGB_CUST_CREDR","",$grAttr,$laAttr,$inAttr,"");
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td ab-label='STD_REF' class='" . $laAttr['class'] . "' ></td>";
$hardCode .= "<td>" . $xtmp->currHtml . "</td></tr>";



$hardCode .= "</table>";

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["ab-label"] = "STD_BANK";

$xtmp->setFieldWrapper("view02","0.0","vgb_cust","STD_BANK","",$grAttr,$laAttr,$inAttr,$hardCode);

echo $xtmp->currHtml;


//VGB_CUST_CRHOL
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VGB_CUST_CRHOL");
$xtmp->setFieldWrapper("view03","0.0","vgb_cust","VGB_CUST_CRHOL","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VGB_CUST_STATM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VGB_CUST_STATM");
$xtmp->setFieldWrapper("view03","0.0","vgb_cust","VGB_CUST_STATM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


//VGB_CUST_STBFW
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VGB_CUST_STBFW");
$xtmp->setFieldWrapper("view03","0.0","vgb_cust","VGB_CUST_STBFW","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


echo '</div><div class="col-sm-3">';

// VGB_SLRP_SLSRP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_SLRP_SLSRP";

$keepOrg = 1; 
$repeatIn = "vgb_slrp";
$searchIn = "";
$refName = "vgb_slrp"; // unique
$refModel = "VGB_CUST_SLSRP"; // unique
$searchInRef = "";
$searchRefDesc = implode("&nbsp;&nbsp;",array("{{VGB_SLRP_SLSRP}}","{{VGB_SLRP_SRNAM}}"));
$repeatInRef = "idVGB_SLRP"; //Unique
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_SLRP_SLSRP}}","{{ab_rloop.VGB_SLRP_SRNAM}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_SLRP_SLSRP;VGB_SLRP_SLSRP='';VGB_SLRP_SLSRP_F='';kPress('VGB_SLRP_SLSRP','VGB_SLRP_SLSRP','vgb_slrp',0);VGB_SLRP_SLSRP=hold;".'"';
$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
$xtmp->setFieldWrapper("view04","0.0","vgb_cust","VGB_CUST_STBFW","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


// VGB_CUST_MRKID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_MRKID";
$keepOrg = 1; 
$repeatIn = "vgb_mark";
$searchIn = "";
$refName = "vgb_mark"; // unique
$refModel = "VGB_CUST_MRKID"; // unique
$repeatInRef = "idVGB_MARK"; //Unique
$searchRefDesc = implode("&nbsp;&nbsp;",array("{{VGB_MARK_MRKID}}","{{VGB_MARK_DESCR}}"));
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_MARK_MRKID}}","{{ab_rloop.VGB_MARK_DESCR}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_MARK_MRKID;VGB_MARK_MRKID='';VGB_MARK_MRKID_F='';kPress('VGB_MARK_MRKID','VGB_MARK_MRKID','vgb_mark',0);VGB_MARK_MRKID=hold;".'"';

$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
$xtmp->setFieldWrapper("view04","0.0","vgb_cust","VGB_CUST_MRKID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;






// VGB_CUST_CUTYP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CUTYP";
$keepOrg = 1; 
$repeatIn = "vgb_ctyp";
$searchIn = "VGB_CTYP_CUTYP";
$refName = "vgb_ctyp"; // unique
$refModel = "VGB_CUST_CUTYP"; // unique
$repeatInRef = "idVGB_CTYP"; //Unique
$searchRefDesc = implode("&nbsp;&nbsp;",array("{{VGB_CTYP_CUTYP}}","{{VGB_CTYP_DESCR}}"));
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_CTYP_CUTYP}}","{{ab_rloop.VGB_CTYP_DESCR}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_CTYP_CUTYP;VGB_CTYP_CUTYP='';VGB_CTYP_CUTYP_F='';kPress('VGB_CTYP_CUTYP','VGB_CTYP_CUTYP','vgb_ctyp',0);VGB_CTYP_CUTYP=hold;".'"';
$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
$xtmp->setFieldWrapper("view04","0.0","vgb_cust","VGB_CUST_CUTYP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;



//VGB_CUST_CSTAT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CSTAT";
$xtmp->setFieldWrapper("view04","2.4","vgb_cust","VGB_CUST_CSTAT","",$grAttr,$laAttr,$inAttr,"");

echo $xtmp->currHtml;


//VGB_CUST_BAORA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VGB_CUST_BAORA");
$xtmp->setFieldWrapper("view03","0.0","vgb_cust","VGB_CUST_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;



//VGB_CUST_CFCAT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_CFCAT";
$hardCode = $xtmp->setYesNoField("VGB_CUST_CFCAT");
$xtmp->setFieldWrapper("view05","0.0","vgb_cust","VGB_CUST_CFCAT","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


//VGB_CUST_CFCAT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = <<<HHTM
<table>
<tr>
<td>
	<input  ng-click="rfs('VGB_CUST_DELCO')" ng-model="VGB_CUST_DELCO" value="" />
</td>
<td>	
	<label class='btn-sm {{VGB_CUST_DELCO=="CONDITIO"?"":"ab-hidden"}}'   ab-label="VGB_CUST_COLLE">VGB_CUST_COLLE</label>
</td>
</tr>
<tr>
<td>
</td>
<td >
	<label class='btn-sm {{VGB_CUST_DELCO=="CONDITIO"?"":"ab-hidden"}}'   ab-label="LF_DELCO_PREPAID" >  </label>
	<input class='{{VGB_CUST_DELCO=="CONDITIO"?"":"ab-hidden"}}' type="text" size="8" ng-model="VGB_CUST_COLLE" value="" />
</td>
</tr>
</table>
HHTM;
$xtmp->setFieldWrapper("view05","0.0","vgb_cust","VGB_CUST_DELCO","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;



//VGB_CUST_ORFOB
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["ab-label"] = "VSL_ORHE_ORFOB";
$xtmp->setFieldWrapper("view05","0.0","vgb_cust","VGB_CUST_ORFOB","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

echo '</div>';

?>

	</div>
	

<!--

	<div class="col-sm-6">
		<table class="table table-striped" >
		<tr>
		<td>
			<label class="btn-md"  ab-label="VGB_CUST_BPART">Partner</label>
			
			
		
				
		</td>
		<td>

				<div>
					
			
						<Input class="ab-hidden" type="text" ng-model="idVGB_CUST" size=3 />		
						<input 
						lval="" 
						auto-main="YES" 
						ab-autolabel="VGB_CUST_BPNAM" 
						ng-model="VGB_CUST_BPART"
						id="VGB_CUST_BPART"
						class="ab-hidden" 
						ab-autocomplete
						
						value="" />

							
						<span class="{{VGB_CUST_BPART>0?'':'hidden';}}">
							<label>{{ VGB_BPAR_BPART }}</label>
						</span>
				</div>			
			
				<div class="row {{VGB_CUST_BPART>0?'hidden':'';}}">
					<div class="col-sm-9">
						<input  a_iref="02-60"
							size=15
							lval=""
							ng-blur="VGB_BPAR_BPART = VGB_BPAR_BPART.toUpperCase();val_new_bpar();"
							ng-model="VGB_BPAR_BPART" 
							name="VGB_BPAR_BPART" 
							value="" 
						/>
						<span class="text-danger">{{VGB_BPAR_BPART_newMess}}</span>
						
					</div>
				</div>

		
			
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="STD_NAME">VGB_CUST_BPNAM</label>
			<div class="{{VGB_CUST_BPART>0?'hidden':'';}}">
				<input a_iref="02-60"
					size=25
					lval=""
					ng-keyup="VGB_CUST_BPNAM=VGB_BPAR_BPNAM;VGB_ADDR_ADNAM=VGB_BPAR_BPNAM;VGB_ADDR_DESCR=VGB_BPAR_BPNAM;"
					ng-model="VGB_BPAR_BPNAM" 
					name="VGB_BPAR_BPNAM" 
					value="" 
				/>
			
			</div>	
		</td>
		<td>		
			<div class="{{VGB_CUST_BPART>0?'':'hidden';}}">
				<input a_iref="02-10" type="text" size="25" ng-model="VGB_CUST_BPNAM" value="" />
			</div>	
		</td>
		</tr>

		<tr class="{{idVGB_CUST>0?'':'hidden';}}">
			<td  >
			
				<label class="btn-md" ab-label="VGB_CUST_BTADD">VGB_CUST_BTADD</label>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				
			</td>

	
			<td>


<?php
$keepOrg = 1; 
$repeatIn = "VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR' ";
$searchIn = "";
$refName = "vgb_addrBT"; // unique
$refModel = "VGB_CUST_BTADD"; // unique
$repeatInRef = "idVGB_ADDR"; //Unique
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_ADDR_ADDID}}","{{ab_rloop.VGB_ADDR_DESCR}}"));
$searchRefDesc = "";
$refDetail = implode("<br>",array("{{ab_rloop.VGB_ADDR_ADNAM}}","{{ab_rloop.VGB_ADDR_ADD01}}, {{ab_rloop.VGB_ADDR_ADD02}}","{{ab_rloop.VGB_ADDR_CITYN}}, {{ab_rloop.VGB_ADDR_POSTC}}","{{ab_rloop.VGB_ADDR_CONT1}} - {{ab_rloop.VGB_ADDR_TEL01}}"));
$refDetailLink = "";
$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>

			</td>


		</tr>


		<tr class="{{idVGB_CUST>0?'':'hidden';}}">
			<td  >
			
				<label class="btn-md" ab-label="VGB_CUST_STADD">VGB_CUST_STADD</label>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				
			</td>



	
			<td>


<?php
$keepOrg = 1; 
$repeatIn = "VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR' ";
$searchIn = "";
$refName = "vgb_addrST"; // unique
$refModel = "VGB_CUST_STADD"; // unique
$repeatInRef = "idVGB_ADDR"; //Unique
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_ADDR_ADDID}}","{{ab_rloop.VGB_ADDR_DESCR}}"));
$searchRefDesc = "";
$refDetail = implode("<br>",array("{{ab_rloop.VGB_ADDR_ADNAM}}","{{ab_rloop.VGB_ADDR_ADD01}}, {{ab_rloop.VGB_ADDR_ADD02}}","{{ab_rloop.VGB_ADDR_CITYN}}, {{ab_rloop.VGB_ADDR_POSTC}}","{{ab_rloop.VGB_ADDR_CONT1}} - {{ab_rloop.VGB_ADDR_TEL01}}"));
$refDetailLink = "";
$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>




			</td>
		</tr>

		
		<tr>
		<td>
			<label class="btn-md"  ab-label="VGB_CUST_BAORA">VGB_CUST_BAORA</label>
		</td>
<td>
		
<?php 
$tmp = new AB_objGen;
$tmp->setYesNoField("VGB_CUST_BAORA"); 
?>

			<input class="hidden" ng-click="rfs('VGB_CUST_BAORA')" ng-model="VGB_CUST_BAORA"  value="" />
			
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VIN_ITEM_CFCAT">VGB_CUST_CFCAT</label>
		</td>
		<td >
<?php 
$tmp = new AB_objGen;
$tmp->setYesNoField("VGB_CUST_CFCAT");
?>		
			<input  class="hidden" ng-click="rfs('VGB_CUST_CFCAT')" ng-model="VGB_CUST_CFCAT" value="" />
			

		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_DELCO">VGB_CUST_DELCO</label>
		</td>
		<td>
			<div>
			<table>
			<tr>
			<td>
			
				<input  ng-click="rfs('VGB_CUST_DELCO')" ng-model="VGB_CUST_DELCO" value="" />
			</td>
			<td>	
				<label class='btn-sm {{VGB_CUST_DELCO=="CONDITIO"?"":"ab-hidden"}}'   ab-label="VGB_CUST_COLLE">VGB_CUST_COLLE</label>
			</td>
			</tr>
			<tr>
			<td>
			</td>
			<td >
				<label class='btn-sm {{VGB_CUST_DELCO=="CONDITIO"?"":"ab-hidden"}}'   ab-label="LF_DELCO_PREPAID" >f  </label>
				<input class='{{VGB_CUST_DELCO=="CONDITIO"?"":"ab-hidden"}}' type="text" size="8" ng-model="VGB_CUST_COLLE" value="" />
				
			</td>
			</tr>
			</table>
			</div>
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VSL_ORHE_ORFOB">VGB_CUST_ORFOB</label>
		</td>
		<td>
			<input a_iref="02-65" type="text" size="30" ng-model="VGB_CUST_ORFOB" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md" ab-label="VGB_SLRP_SLSRP" >VGB_CUST_SLSRP</label>
		</td>

		<td>
		
<?php
$lf = array();
$lf["keepOrg"] = 1; 
$lf["repeatIn"] = "vgb_slrp";
$lf["searchIn"] = "";
$lf["refName"] = "vgb_slrp"; // unique
$lf["refModel"] = "VGB_CUST_SLSRP"; // unique
$lf["searchInRef"] = "";
$lf["searchRefDesc"] = implode("&nbsp;&nbsp;",array("{{VGB_SLRP_SLSRP}}","{{VGB_SLRP_SRNAM}}"));
$lf["repeatInRef"] = "idVGB_SLRP"; //Unique
$lf["refDesc"] = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_SLRP_SLSRP}}","{{ab_rloop.VGB_SLRP_SRNAM}}"));
$lf["refDetail"] = "";
$lf["refDetailLink"] = "";
$lf["ignTrig"] = 'ng-click="' . "hold=VGB_SLRP_SLSRP;VGB_SLRP_SLSRP='';VGB_SLRP_SLSRP_F='';kPress('VGB_SLRP_SLSRP','VGB_SLRP_SLSRP','vgb_slrp',0);VGB_SLRP_SLSRP=hold;".'"';
$tmp = new AB_objGen;
$tmp->setListerFieldTest($lf)

?>
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_MRKID">VGB_CUST_MRKID</label>
		</td>
		<td>
		
<?php
$keepOrg = 1; 
$repeatIn = "vgb_mark";
$searchIn = "";
$refName = "vgb_mark"; // unique
$refModel = "VGB_CUST_MRKID"; // unique
$repeatInRef = "idVGB_MARK"; //Unique
$searchRefDesc = implode("&nbsp;&nbsp;",array("{{VGB_MARK_MRKID}}","{{VGB_MARK_DESCR}}"));
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_MARK_MRKID}}","{{ab_rloop.VGB_MARK_DESCR}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_MARK_MRKID;VGB_MARK_MRKID='';VGB_MARK_MRKID_F='';kPress('VGB_MARK_MRKID','VGB_MARK_MRKID','vgb_mark',0);VGB_MARK_MRKID=hold;".'"';
$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>

			
		</td>
				
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CUTYP">VGB_CUST_CUTYP</label>
		</td>
		<td>

<?php
$keepOrg = 1; 
$repeatIn = "vgb_ctyp";
$searchIn = "VGB_CTYP_CUTYP";
$refName = "vgb_ctyp"; // unique
$refModel = "VGB_CUST_CUTYP"; // unique
$repeatInRef = "idVGB_CTYP"; //Unique
$searchRefDesc = implode("&nbsp;&nbsp;",array("{{VGB_CTYP_CUTYP}}","{{VGB_CTYP_DESCR}}"));
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_CTYP_CUTYP}}","{{ab_rloop.VGB_CTYP_DESCR}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_CTYP_CUTYP;VGB_CTYP_CUTYP='';VGB_CTYP_CUTYP_F='';kPress('VGB_CTYP_CUTYP','VGB_CTYP_CUTYP','vgb_ctyp',0);VGB_CTYP_CUTYP=hold;".'"';
$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>

		</td>
		</tr>
			
		</table>
	</div>

	<div class="col-sm-6"  >
		<table class="table table-striped" >
		<tr>				
		<td>
			<label class="btn-md"   ab-label="STD_BANK">VGB_CUST_CUBNK</label>
		</td>
		<td>
			<input a_iref="02-10" type="text" size="30" ng-model="VGB_CUST_CUBNK" value="" />
		</td>
		</tr>

		<tr class="{{VGB_CUST_BPART>0?'':'hidden';}}">
			<td  >
			
				<label class="btn-md" ab-label="VGB_CUST_BKADD">VGB_CUST_BKADD</label>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				
			</td>
			<td >




<?php
$keepOrg = 1; 
$repeatIn = "vgb_cust";
$searchIn = "";
$refName = "vgb_addrBK"; // unique
$refModel = "VGB_CUST_BKADD"; // unique
$repeatInRef = "idVGB_ADDR"; //Unique
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_ADDR_ADDID}}","{{ab_rloop.VGB_ADDR_DESCR}}"));
$searchRefDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_ADDR_ADDID}}","{{ab_rloop.VGB_ADDR_DESCR}}"));;
$refDetail = implode("<br>",array("{{ab_rloop.VGB_ADDR_ADNAM}}","{{ab_rloop.VGB_ADDR_ADD01}}, {{ab_rloop.VGB_ADDR_ADD02}}","{{ab_rloop.VGB_ADDR_CITYN}}, {{ab_rloop.VGB_ADDR_POSTC}}","{{ab_rloop.VGB_ADDR_CONT1}} - {{ab_rloop.VGB_ADDR_TEL01}}"));
$refDetailLink = "";
$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>

	



			</td>
			
		</tr>

		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CREDR">VGB_CUST_CREDR</label>
		</td>
		<td>
			<input a_iref="02-30" type="text" size="30" ng-model="VGB_CUST_CREDR" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CRHOL">VGB_CUST_CRHOL</label>
		</td>
		<td>
<?php 
$tmp = new AB_objGen;
$tmp->setYesNoField("VGB_CUST_CRHOL");
 ?>		
			<input class="hidden" ng-click="rfs('VGB_CUST_CRHOL')" ng-model="VGB_CUST_CRHOL" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_STATM">VGB_CUST_STATM</label>
		</td>
		<td>
<?php 
$tmp = new AB_objGen;
$tmp->setYesNoField("VGB_CUST_STATM"); 
?>		
			<input class="hidden"  ng-click="rfs('VGB_CUST_STATM')" ng-model="VGB_CUST_STATM" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_STBFW">VGB_CUST_STBFW</label>
		</td>
		<td>
<?php 
$tmp = new AB_objGen;
$tmp->setYesNoField("VGB_CUST_STBFW"); 
?>	
	
			<input class="hidden"  ng-model="VGB_CUST_STBFW" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_TERM_TERID"	>VGB_CUST_TERID</label>
		</td>
		<td>


<?php
$keepOrg = 1; 
$repeatIn = "vgb_term";
$searchIn = "VGB_TERM_TERID";
$refName = "vgb_term"; // unique
$refModel = "VGB_CUST_TERID"; // unique
$repeatInRef = "idVGB_TERM"; //Unique
$searchRefDesc = ""; //implode("&nbsp;&nbsp;",array("{{VGB_TERM_TERID}}","{{VGB_TERM_DESCR}}"));
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_TERM_TERID}}","{{ab_rloop.VGB_TERM_DESCR}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_TERM_TERID;VGB_TERM_TERID='';VGB_TERM_TERID_F='';kPress('VGB_TERM_TERID','VGB_TERM_TERID','vgb_term',0);VGB_TERM_TERID=hold;".'"';
$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>


		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CRELI">VGB_CUST_CRELI</label> 
		</td>
		<td>
			<Input a_iref="02-80" class="A_input" type="text" size="13" ng-model="VGB_CUST_CRELI" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="STD_OVERDUE_DAYS" >VGB_CUST_OVERD</label>
		</td>
		<td>
			<input a_iref="02-90" class="A_input" type="text" size="2" ng-model="VGB_CUST_OVERD" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CURID">VGB_CUST_CURID</label>
		</td>
		<td>


<?php
$keepOrg = 1; 
$repeatIn = "vgb_curr";
$searchIn = "VGB_CURR_CURID";
$refName = "vgb_curr"; // unique
$refModel = "VGB_CUST_CURID"; // unique
$repeatInRef = "idVGB_CURR"; //Unique
$searchRefDesc = "";//implode("&nbsp;&nbsp;",array("{{VGB_CURR_CURID}}","{{VGB_CURR_DESCR}}"));
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_CURR_CURID}}","{{ab_rloop.VGB_CURR_DESCR}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_CURR_CURID;VGB_CURR_CURID='';VGB_CURR_CURID_F='';kPress('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0);VGB_CURR_CURID=hold;".'"';
$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CSTAT">VGB_CUST_CSTAT</label>
		</td>
		<td>
			<input ng-click="rfs('VGB_CUST_CSTAT')" ng-model="VGB_CUST_CSTAT" value="" />
		</td>
		</tr>
		</table>
	</div>
-->
</form>
</div>

	<div>
	<?php require_once "../appHtml/VGB_ADDRCT.php"; ?>
	</div>

</div>