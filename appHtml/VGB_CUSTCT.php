<?php // require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
	<?php require_once "../appCscript/VGB_PARTNERS.php"; ?>


<script>

function addClassHidden(oAttr,oVal,trig)
{
	if (trig == true)
	{
		$("[" + oAttr + "='" + oVal + "']").addClass("hidden")
		$("[" + oAttr + "='" + oVal + "']").attr("context","0")
		
	}
	else
	{
		$("[" + oAttr + "='" + oVal + "']").removeClass("hidden")
		$("[" + oAttr + "='" + oVal + "']").attr("context","1")

	}
	
	
}

function openLocalBoard(forced)
{
	$("#ab-localBoard").click();	
	
}



</script>


</div>

<div style="margin-left:5px;" ng-init="SESSION_DESCR='Maintain Customers'">

	<div class="ab-spaceless"  >

		<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		
	</div>
	
<div class="hidden">

<?php require_once "../appHtml/VGB_PARTNERS_RIGHTS.php"; ?>

<textarea class="hidden" ab-updSuccess="" >

// if (data['posts'].tblInfo.tblName == "vgb_cust")
// {
	
	if (data['posts'].requestMethod == 'DELETE' && data['posts'].tblInfo.tblName == "vgb_cust" )
	{
		$("#ab-back").click(); 
	}
	else
	{

		if( data['posts'].tblInfo.tblName == "vgb_addr" )
		{
			$scope.flipHidden('.collps',false);$scope.flipHidden('.collps-on',true)
		}

		
		if ($scope.opts.updType == "CREATE" )
		{
			$scope.createdCustInit(data['posts']);
		}
		else
		{
			
//			if (data['posts'].requestMethod == 'DELETE')
//			{
//				// location.reload();
//			}
//			else
//			{
				$scope.custInit();
//			}
		}
	};
	
	
// }
// else
// {
// }




</textarea>


</div>	
	<div  class="row" style="padding:0px;padding-top:5px;">
		<div class="col-sm-2" >
			<ul  class="nav  nav-tabs" >
	
				<li >
				<span class="text-warning" ng-model="isPartnerOther" >&nbsp;&nbsp;{{isPartnerOther}}</span>
	
				<label class="btn-xs"   ab-label="STD_CDATE" >VGB_CUST_CDATE</label>
				<span  value="">{{VGB_CUST_CDATE}} </span>
	
				</li>
			</ul>
		</div>
		<div class="col-sm-2 small" >	
			<a target="VGB_SVIACT"  class="ab-border ab-strong {{idVGB_CUST>0?'':'hidden'}}" 
			href="#/VGB_PARTNERS/VGB_SVIACT/Process:VGB_PARTNERS,Session:VGB_SVIACT,tblName:vgb_svia,idVGB_CUST:{{idVGB_CUST}}">
				&nbsp;
				<span ab-label="VGB_SVIACT"></span>
				&nbsp;
			</a>	
		</div>
	</div>
	

	<div class="hidden" id="ab-new">
					<label ng-if="rightsCust.new>0" title="CREATE" >
	 				 		
	 				 		<a 
							abl-first={{$first}}
							abl-last={{$last}}
							
							href="#VGB_PARTNERS/VGB_CUSTCT/Process:VGB_PARTNERS,Session:VGB_CUSTCT,tblName:vgb_cust,updType:CREATE,idVGB_BPAR:0,VGB_BPAR_BPART:,tbData:{{tbData}}" 
							>
								<span >New</span>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>
											
					</label>
	
	</div>
	<script>
		var outB = "<span class=" + '"' + "{{opts.updType!='CREATE'?'':'hidden'}}" + '" >'+ $('#ab-new').html() + "</span>";
		$('#ab-appOpt').html(outB);
		$('#ab-new').html('');
	</script>


<div class="row " style="margin:0px;padding:0px;">
<a class="hidden" id="VGB_PARTNERrfs" onclick="abLink(this);" href="#VGB_PARTNERS/VGB_CUSTCT/idVGB_BPAR:{{idVGB_BPAR}},idVGB_ADDR:{{idVGB_ADDR}}updType:UPDATE,Session:VGB_CUSTCT,Process:VGB_PARTNERS" >Link</a>
<form id="mainForm" name="mainForm" ab-context="1" ab-view="vgb_cust" ab-main="vgb_cust"  >
<input class="hidden" ng-model="VGB_CUST_BPART" />



<?php

$xtmp = new appForm("VGB_CUSTCT");
echo '<div class="col-sm-2 ab-borderless">';
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
$inAttr["ng-blur"] = "VGB_ADDR_ADNAM=(VGB_ADDR_ADNAM==''?VGB_CUST_BPNAM:VGB_ADDR_ADNAM)";
$laAttr['ab-label'] = "STD_NAME";


$xtmp->setFieldWrapper("view01","2.1","vgb_cust","VGB_CUST_BPNAM","",$grAttr,$laAttr,$inAttr,"");

echo $xtmp->currHtml;


// newer
// <span type="button" class="btn-link" data-toggle="modal" data-target="#modalVgbAddr">?</span>

$harderCode = <<<EOB

        <table>
        <tr>
        	<td rowspan=100 style="text-align:middle;vertical-align:top;">
        	<input class="hidden" ng-model="VGB_CUST_BTADD" />
        	<input class="hidden" ng-model="VGB_CUST_STADD" />
        	
        	<span class="hidden btn btn-link glyphicon glyphicon-search ab-spaceless" data-toggle="modal" data-target="#modalVgbAddr" ng-click="initAddress();" ></span>
        	<span>&nbsp;</span>
        	</td>
        </tr>

 	<tr ng-repeat="adrs in VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR'" >
 	
        	<td style="text-align:right;">
		
        		<span ng-if="adrs.idVGB_ADDR==VGB_CUST_BTADD" >
        			<span ab-label='STD_BILL_TO' class='small text-primary'>Bill</span>
        			<label class="small" >{{adrs.VGB_ADDR_ADDID}} - {{adrs.VGB_ADDR_DESCR}} </label>
        			<span>&nbsp;</span>
        		</span>
	        	
        	</td>
        </tr>
 	<tr ng-repeat="adrs in VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR'" >
 	
        	<td style="text-align:right;">
        		
        		<span ng-if="adrs.idVGB_ADDR==VGB_CUST_STADD" >
        			<span ab-label='STD_SHIP_TO' class='small text-primary'>Ship</span>
        			<label class="small" >{{adrs.VGB_ADDR_ADDID}} - {{adrs.VGB_ADDR_DESCR}} </label>
        			<span>&nbsp;</span>
        		</span>
	        	
        	</td>
        </tr>        
        </table>
        
EOB;


$laAttr["ab-label"]="STD_ADDRESS_SHORT";	 
   $xtmp->setFieldWrapper("view01","2.050","vgb_addr","STD_ADDRESS_SHORT","",$grAttr,$laAttr,$inAttr,$harderCode);

$hardCode = "";


echo "<table ng-if='idVGB_BPAR>0' ><tr><td>" . $xtmp->currHtml . "</td></tr></table>";
  
//   echo $xtmp->currHtml;
   




//	// new VGB_CUST_BTADD
//	$grAttr = $xtmp->grAttrib;
//	$grAttr["class"] = "";$grAttr["style"] = "";
//	$laAttr = $xtmp->laAttrib;
//	$inAttr = $xtmp->inAttrib;
//	$inAttr["class"] = "hidden";
//	$laAttr['ab-label'] = "STD_ADDRESS";
//	$xtmp->setFieldWrapper("view01","2.2","vgb_cust","VGB_CUST_BTADD","",$grAttr,$laAttr,$inAttr,'');
//	
//	$addrEdit = <<<AED
//	<span 
//	<span>
//	<input class="hidden" id="VGB_ADDRedit" ng-click="initNewCustomer();" />
//	<a class="ab-pointer" ng-click="ABsessionLink('#/VGB_PARTNERS/VGB_ADDRCT/Process:VGB_PARTNERS,Session:VGB_ADDRCT,tblName:vgb_addr,idVGB_BPAR:{{VGB_CUST_BPART}}','#VGB_ADDRedit');" >
//	<span class="glyphicon glyphicon-search" ></span>
//	</a>
//	</span>
//	
//	AED;
//	
//	$grAttr = $xtmp->grAttrib;
//	$laAttr = $xtmp->laAttrib;
//	$inAttr = $xtmp->inAttrib;
//	$laAttr["class"] = "hidden";
//	echo $xtmp->currHtml;
	


// xxx VGB_CUST_BTADD
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

$addrEdit = <<<AED

<span>
<input class="hidden" id="VGB_ADDRedit" ng-click="initNewCustomer();" />
<a class="ab-pointer" ng-click="ABsessionLink('#/VGB_PARTNERS/VGB_ADDRCT/Process:VGB_PARTNERS,Session:VGB_ADDRCT,tblName:vgb_addr,idVGB_BPAR:{{VGB_CUST_BPART}}','#VGB_ADDRedit');" >
<span class="glyphicon glyphicon-search" ></span>
</a>
</span>

AED;
	
	
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$hardCode = "<table><tr><td ab-label='STD_BILL_TO' class='small text-muted' style='white-space:nowrap;width:75px;max-width:75px;font-size:small;'>Bill to:</td><td>" . $hardCode . "</td></tr></table>"; 	
	
$xtmp->setFieldWrapper("view01","2.2","vgb_cust","VGB_CUST_BTADD","",$grAttr,$laAttr,$inAttr,$hardCode);



// STD_BANK INfo 

$hardCode = "<table >";

// VAR_OIHE_BPBNK
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['class'] = "hidden";
$grAttr['class'] = "ab-spaceless";

	$keepOrg = 1; 
	$repeatIn = "vgb_bank";
	$searchIn = "";
	$refName = "vgb_bank"; // unique
	$refModel = "VGB_CUST_BPBNK"; // unique
	$repeatInRef = "idVGB_BANK"; //Unique
	$searchRefDesc = ""; //implode("&nbsp;&nbsp;",array("{{VGB_BANK_BNKID}}","{{VGB_BANK_DESCR}}"));
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_BANK_BNKID}}","{{ab_rloop.VGB_BANK_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VGB_BANK_BNKID;VGB_BANK_BNKID='';VGB_BANK_BNKID_F='';kPress('VGB_BANK_BNKID','VGB_BANK_BNKID','vgb_bank',0);VGB_BANK_BNKID=hold;".'"';
	$hardCoded = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);

	
$xtmp->setFieldWrapper("view02","2.5","vgb_cust","VGB_CUST_BPBNK","",$grAttr,$laAttr,$inAttr,$hardCoded);
$bankId= $xtmp->currHtml;



$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "20";
$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";

$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_CUBNK","",$grAttr,$laAttr,$inAttr,"");
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td colspan=2 class='small' >" . $bankId . "</td></tr>";
$hardCode .= "<tr><td ab-label='STD_NAME' class='" . $laAttr['class'] . "' ></td>";
$hardCode .= "<td>" . $xtmp->currHtml . "</td></tr>";


// VGB_CUST_CREDR 
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "20";
$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";

$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_CREDR","",$grAttr,$laAttr,$inAttr,"");
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
$searchRefDesc = ""; //implode("&nbsp;&nbsp;",array("{{VGB_MARK_MRKID}}","{{VGB_MARK_DESCR}}"));
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
$searchRefDesc = ""; //implode("&nbsp;&nbsp;",array("{{VGB_CTYP_CUTYP}}","{{VGB_CTYP_DESCR}}"));
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_CTYP_CUTYP}}","{{ab_rloop.VGB_CTYP_DESCR}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_CTYP_CUTYP;VGB_CTYP_CUTYP='';VGB_CTYP_CUTYP_F='';kPress('VGB_CTYP_CUTYP','VGB_CTYP_CUTYP','vgb_ctyp',0);VGB_CTYP_CUTYP=hold;".'"';
$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
$xtmp->setFieldWrapper("view04","0.0","vgb_cust","VGB_CUST_CUTYP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;





 echo '</div><div class="col-sm-2">';

// VGB_CUST_CRELI
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CRELI";
$inAttr['size'] = "8";
$inAttr['ab-ft'] = "amt";
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






//VGB_CUST_CRHOL
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VGB_CUST_CRHOL");
$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_CRHOL","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


//VGB_CUST_STATM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VGB_CUST_STATM");
$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_STATM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


//VGB_CUST_STBFW
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VGB_CUST_STBFW");
$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_STBFW","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


 echo '</div><div class="col-sm-2">';

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
$searchRefDesc = ""; //implode("&nbsp;&nbsp;",array("{{VGB_SLRP_SLSRP}}","{{VGB_SLRP_SRNAM}}"));
$repeatInRef = "idVGB_SLRP"; //Unique
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_SLRP_SLSRP}}","{{ab_rloop.VGB_SLRP_SRNAM}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_SLRP_SLSRP;VGB_SLRP_SLSRP='';VGB_SLRP_SLSRP_F='';kPress('VGB_SLRP_SLSRP','VGB_SLRP_SLSRP','vgb_slrp',0);VGB_SLRP_SLSRP=hold;".'"';
$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
$xtmp->setFieldWrapper("view04","0.0","vgb_cust","VGB_CUST_STBFW","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

// Debug echo "<textarea>" . $xtmp->currHtml . "</textarea>";

//VGB_CUST_CSTAT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CSTAT";
$hardCode =  $xtmp->setEnumField('vgb_cust','VGB_CUST_CSTAT');

	


$xtmp->setFieldWrapper("view04","2.4","vgb_cust","VGB_CUST_CSTAT","",$grAttr,$laAttr,$inAttr,$hardCode);

echo $xtmp->currHtml;


//VGB_CUST_BAORA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VGB_CUST_BAORA");
$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;



//VGB_CUST_CFCAT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "STD_SHELFLIFE_PMIN";
// $hardCode = $xtmp->setYesNoField("VGB_CUST_CFCAT");
$hardCode = <<< EOC


			<table>

			<tr>
				<td>
					<input class="hidden" ng-model="VGB_CUST_LLIFE" />
					<input type="number" class="btn-xm ab-borderless" style="font-size:large;font-weight:900;" name="points" min="0" max="99" step="5" value=""  nng-val="{{VGB_CUST_LLIFE}}" 
					onfocus="$(this).val($(this).attr('nng-val'));"
					placeholder="{{VGB_CUST_LLIFE}}" ng-blur="VGB_CUST_LLIFE=(VGB_CUST_LLIFEx>0?VGB_CUST_LLIFEx:'0')" ng-model="VGB_CUST_LLIFEx" />
					
				</td>
			</tr>
			</table>
				

EOC;


$xtmp->setFieldWrapper("view05","0.0","vgb_cust","VGB_CUST_LLIFE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


//VGB_CUST_CFCAT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = <<<HHTM
<table>
<tr>
<td>
<input  class="hidden" ng-click="rfs('VGB_CUST_DELCO')" ng-model="VGB_CUSqqqT_DELCO" value="" />
HHTM;


	$hardCode .=  $xtmp->setEnumField('vgb_cust','VGB_CUST_DELCO');
	
	
$hardCode .= <<<HHTM
	
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


//VSL_ORHE_ORVIA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["ab-label"] = "VSL_ORHE_ORVIA";

$hardCode =<<< EOC

	<span class="glyphicon glyphicon-th-list text-primary"
	ng-click="detCustomerDetail(idVGB_CUST)" >
	</span>
	
	<span class="{{vgb_cust_svia.length>0?'':'hidden'}} text-primary small" >
		&nbsp;&nbsp;&nbsp;&nbsp;
		<span ab-label="STD_DEFAULT"></span>
		<span class="glyphicon glyphicon-ok"></span>
	</span>
	

	<div >
		<table style="width:100%;">
			<tr class="{{vgb_cust_svia.length>0?'':'hidden'}} text-primary small ab-strong">
				<td style="width:60%;" >
					<span ab-label="VGB_PARTNERS_vgb_supp">Supp</span>
				</td>
				<td style="width:30%;" >
					<span ab-label="STD_ACCOUNT_NO">Acc&</span>
				</td>
				<td style="width:10%;" >
				</td>
			</tr>
		</table>
		<table style="width:100%;">
			<tr ng-repeat="custdet in vgb_cust_svia " class="small {{custdet.VGB_SVIA_DEFAULT=='1'?'ab-strong':''}}" >
				<td style="width:60%;" >
					<span class="text-primary" ng-if="custdet.VGB_SVIA_DEFAULT=='1'">
						<span class="glyphicon glyphicon-ok"></span>
					</span>
					{{custdet.VGB_SUPP_BPNAM}}

				</td>
				<td style="width:30%;" >
					{{custdet.VGB_SVIA_ACCNO}}
				</td>								
				<td style="width:10%;" class="text-right" >
					<a class="text-primary  ab-pointer ab-strong" 
					href="#/VGB_PARTNERS/VGB_SVIACT/Process:VGB_PARTNERS,Session:VGB_SVIACT,tblName:vgb_svia,idVGB_SVIA:{{custdet.idVGB_SVIA}}"
					>Edit</a>
				</td>
			</tr>
		</table>
	</div>
							
EOC;
							
$xtmp->setFieldWrapper("view05","0.0","vgb_cust","VGB_CUST_ORFOB","",$grAttr,$laAttr,$inAttr,$hardCode);
// Ship Via remove 20170315 (not usefull)
// echo $xtmp->currHtml;




//VGB_CUST_ORFOB
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["ab-label"] = "VSL_ORHE_ORFOB";
$xtmp->setFieldWrapper("view05","0.0","vgb_cust","VGB_CUST_ORFOB","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// echo '</div>';

//		$xtmp->formData[$view][$seq]['Html'] = $fieldHtml;
//		$xtmp->formData[$view][$seq]['tableName'] = $tableName;
//		$xtmp->formData[$view][$seq]['fieldName'] = $fieldName;
//		$xtmp->formData[$view][$seq]['fieldType'] = $fieldType;

	$obj = $xtmp->formData;
	ksort($obj);
	
	$ret = array();

echo "<!-- ";
	
	foreach($obj as $func => $result)
	{
		
		foreach($obj[$func] as $name => $value)
		{
			echo $value['Html'];
		}
	}

echo " -->";

?>

	</div>
	

<div class="col-sm-6">	
<?php require_once "../appHtml/VGB_ADDRCT.php"; ?>	
</div>

	
</form>

<div id="modalVgbAddr" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" ng-init="new_BTADD='';new_STADD=''">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span ab-label="STD_ADDRESS" >Order Address Selection </span> - <label>{{VGB_CUST_BPNAM}}</label></h4>
       
        <table>
        <tr 	ng-repeat="adrs in VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR'" >
        
        	<td >
        		
			<span ng-if="adrs.idVGB_ADDR==VGB_CUST_BTADD" >
				<span class="text-primary">Bill to&nbsp;&nbsp; : </span>
				{{adrs.VGB_ADDR_ADDID}} - {{adrs.VGB_ADDR_DESCR}} 
			</span>
	        	
        	</td>

        </tr>
        <tr 	ng-repeat="adrs in VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR'" >
        
        	<td >
        		
	        	
	        	<span ng-if="adrs.idVGB_ADDR==VGB_CUST_STADD">
        			<span class="text-primary">Ship to : </span>
        			{{adrs.VGB_ADDR_ADDID}} - {{adrs.VGB_ADDR_DESCR}} 
        		
        		</span>

        	</td>


        </tr>
        </table>
        
      </div>
      <div class="modal-body">
        <table  style="width:100%;font-weight:600;" class="small">
        	<tr>
        
        	<td>
        		<table class="table" style="width:100%;" >
        			<tr>
        			
        				<td class="text-primary small" style="width:20%;">
        				Bill To&nbsp;&nbsp;-&nbsp;
        				Ship To&nbsp;
        				</td>
        				<td class="text-primary small" style="width:10%;">Add Id&nbsp;&nbsp;</td>
        				<td class="text-primary" style="width:35%;">Description</td>
        				<td class="text-primary" style="width:35%;">Contact</td>
        				
        			</tr>
        		
	        		<tr  ng-repeat="ad in VGB_ADDRCT | AB_Sorted:'VGB_ADDR_ADDID' | AB_noDoubles:'idVGB_ADDR'"  >	
	        		
	        			<td >
	        				<input type="radio" checked name="btcust" ng-if="ad.idVGB_ADDR==VGB_CUST_BTADD" />
	        				<input type="radio" rval='{{ad.idVGB_ADDR}}' onclick="deflectVal($(this).attr('rval'),'VGB_CUST_BTADD');" onKlick="$('#new_BTADD').val($(this).attr('rval'));" name="btcust" ng-if="ad.idVGB_ADDR!=VGB_CUST_BTADD" />
	        				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        				<input type="radio" checked name="stcust" ng-if="ad.idVGB_ADDR==VGB_CUST_STADD" />
	        				<input type="radio" rval='{{ad.idVGB_ADDR}}' onclick="deflectVal($(this).attr('rval'),'VGB_CUST_STADD');" onKlick="$('#new_STADD').val($(this).attr('rval'));" name="stcust" ng-if="ad.idVGB_ADDR!=VGB_CUST_STADD" />
						

	        			</td>
	        			
	        			
		        		<td>
		        			{{ad.VGB_ADDR_ADDID}} 
		        		</td>
		        		<td>
						<span>{{ad.VGB_ADDR_ADNAM}}</span>
						<span ng-if="ad.VGB_ADDR_ADD01!='' "> <br> {{ ad.VGB_ADDR_ADD01 }}</span>
						<span ng-if="ad.VGB_ADDR_ADD02!='' "> <br> {{ ad.VGB_ADDR_ADD02 }}</span>
						<br>
						<span ng-if="ad.VGB_ADDR_CITYN!='' "> {{ ad.VGB_ADDR_CITYN }} </span>
						<span ng-if="ad.VGB_ADDR_POSTC!='' "> ,{{ ad.VGB_ADDR_POSTC }}</span>
					</td>
					<td>	
						<span ng-if="ad.VGB_ADDR_CONT1!='' ">{{ ad.VGB_ADDR_CONT1 }}<br></span>
						<span ng-if="ad.VGB_ADDR_TEL01!='' "> <small class="text-primary">Tel: </small>   {{ ad.VGB_ADDR_TEL01 }}<br></span>
						<span ng-if="ad.VGB_ADDR_EMAIL!='' "> <small class="text-primary">Email: </small> {{ ad.VGB_ADDR_EMAIL }}</span>
			
					
			        	
			        	</td>		        		

		        	</tr>
	        	</table>
        	</td>
        
        </tr>
        </table>
        
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div>

	
	
	
	
	
	
	
	<div class="">
	<?php // require_once "../appHtml/VGB_ADDRCT.php"; ?>
	</div>
	
	
	
	
	

</div>

<script>
//	var debug = "";
//	var td = ""
//	$("[ab-pview]").each(function()
//	{
//		$(this).addClass("ab-border")
//	if (debug.indexOf( $(this).attr("ab-pview")) == -1 && $(this).hasClass("hidden") == false)
//	{
//		
//	 debug += "<button ab-flipper='" + $(this).attr("ab-pview") + "' >" + $(this).attr("ab-pview") +"</button>"
//	}
//	});
//	$("#mainForm").prepend(debug)
//	$("[ab-flipper]").on("click",function()
//	{
//		$("[ab-pview]").addClass("ab-hidden");
//		$("[ab-pview='" + $(this).attr("ab-flipper") + "']").removeClass("ab-hidden");
//	});

</script>