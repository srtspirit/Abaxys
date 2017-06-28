<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>

<?php require_once "../appHtml/VGB_PARTNERS_RIGHTS.php"; ?>

<div class="hidden">
<?php require_once "../appCscript/VGB_PARTNERS.php"; ?>
</div>

<div style="margin-left:5px;" ng-init="SESSION_DESCR='Maintain Suppliers'">

	<div class="row ab-spaceless ">
		<div class="col-sm-12 ab-spaceless" ng-model="vgb_supp" >
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		</div>

<div class="hidden">
<textarea class="hidden" ab-updSuccess="" >



	if (data['posts'].requestMethod == 'DELETE' && data['posts'].tblInfo.tblName == "vgb_supp" )
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
			
			$scope.createdSuppInit(data['posts'])
		}
		else
		{
			
			
			if (data['posts'].requestMethod == 'DELETE')
			{
				// $scope.createdSuppInit(tmpObj); // location.reload();
			}
			else
			{
				$scope.suppInit();
			}
		}
	};
	
	
</textarea>


</div>	
		
		<div class="col-sm-5" style="padding:0px;padding-top:5px;">
			<ul class="nav nav-tabs " >

<!--			
				<li class="ab-tabs ab-tab-on ab-pointer">
					
					<small  ab-menu="vgb_supp" name="mainForm" class="text-primary">&nbsp;<span  ab-label="VGB_SUPPCT"> Supplier </span>&nbsp;&nbsp;</small> 
				</li>
		
				<li class="ab-tabs ab-pointer">
					

						<a  
						target="ab-frm.VGB_ADDRCT"
						
						href="#VGB_PARTNERS/VGB_ADDRCT/Process:VGB_PARTNERS,Session:VGB_ADDRCT,tblName:vgb_addr"
						
						xhref="#VGL_PARAMS01/VGL_BRCHCT/Process:VGL_PARAMS01,Session:VGL_BRCHCT,tblName:vgl_brch"
						xhref="#{{opts.Process}}/VGB_ADDRCT/idVGB_BPAR:{{idVGB_BPAR}},updType:UPDATE,Session:VGB_ADDRCT,Process:{{opts.Process}}" >
						Adresses
						</a>


					


				</li>
-->

				<li>
					<span class="text-warning" ng-model="isPartnerOther" >&nbsp;&nbsp;{{isPartnerOther}}</span>
			<label class="btn-xs"   ab-label="STD_CDATE" >VGB_SUPP_CDATE</label>
			<span  value="">{{VGB_SUPP_CDATE}} </span>

				</li>
		
			</ul>
		</div>
		<div class="hidden" id="ab-new">
			<label  title="CREATE" >
		 		
		 		<a 
				abl-first={{$first}}
				abl-last={{$last}}
				
				href="#VGB_PARTNERS/VGB_SUPPCT/Process:VGB_PARTNERS,Session:VGB_SUPPCT,tblName:vgb_supp,updType:CREATE,idVGB_BPAR:0,VGB_BPAR_BPART:,tbData:{{tbData}}" 
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
	
		<div class="col-sm-7">
		</div>
			
	</div>

	<div class="row ab-borderless" style="margin:0px;padding:0px;">
<!--
<a class="hidden" id="VGB_PARTNERrfs" onclick="abLink(this);" href="#VGB_PARTNERS/VGB_SUPPCT/idVGB_BPAR:{{idVGB_BPAR}},idVGB_ADDR:{{idVGB_ADDR}}updType:UPDATE,Session:VGB_SUPPCT,Process:VGB_PARTNERS" >Link</a>
-->
		<form id="mainForm" name="mainForm"  ab-view="vgb_supp" ab-main="vgb_supp"  >
<input class="hidden" ng-model="VGB_SUPP_BPART" />


<?php

$xtmp = new appForm("VGB_SUPPCT");
echo '<div class="col-sm-2 ab-borderless">';
// idVGB_CUST
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vgb_supp";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vgb_supp","idVGB_SUPP","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;



// VGB_SUPP_BPART if new
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] .= " {{VGB_SUPP_BPART>0?'hidden':'';}} ";

$inAttr['ng-blur'] = "VGB_BPAR_BPART = VGB_BPAR_BPART.toUpperCase();val_new_bpar();";
$xtmp->setFieldWrapper("view01","1.01","vgb_bpar","VGB_BPAR_BPART","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


// VGB_SUPP_BPART if exist
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] .= " {{VGB_SUPP_BPART>0?'':'hidden';}} ";

$xtmp->setFieldWrapper("view01","1.02","vgb_bpar","VGB_BPAR_BPART","",$grAttr,$laAttr,$inAttr,"<label  >{{VGB_BPAR_BPART}}&nbsp;&nbsp;&nbsp;</label>");
echo $xtmp->currHtml;


// VGB_SUPP_BPNAM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["ng-blur"] = "VGB_ADDR_ADNAM=(VGB_ADDR_ADNAM==''?VGB_SUPP_BPNAM:VGB_ADDR_ADNAM)";
$laAttr['ab-label'] = "STD_NAME";
$xtmp->setFieldWrapper("view01","2.1","vgb_supp","VGB_SUPP_BPNAM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;



$harderCode = <<<EOB

        <table>
        <tr>
        	<td rowspan=100 style="text-align:middle;vertical-align:top;">
        	<input class="hidden" ng-model="VGB_SUPP_BTADD" />
        	<input class="hidden" ng-model="VGB_SUPP_STADD" />
        	
        	<span class="hidden btn btn-link glyphicon glyphicon-search ab-spaceless" data-toggle="modal" data-target="#modalVgbAddr" ng-click="initAddress();" ></span>
        	<span>&nbsp;</span>
        	</td>
        </tr>

 	<tr ng-repeat="adrs in VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR'" >
 	
        	<td style="text-align:right;">
		
        		<span ng-if="adrs.idVGB_ADDR==VGB_SUPP_BTADD" >
        			<span ab-label='STD_BILL_TO' class='small text-primary'>Bill</span>
        			<label class="small" >{{adrs.VGB_ADDR_ADDID}} - {{adrs.VGB_ADDR_DESCR}} </label>
        			<span>&nbsp;</span>
        		</span>
	        	
        	</td>
        </tr>
 	<tr ng-repeat="adrs in VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR'" >
 	
        	<td style="text-align:right;">
        		
        		<span ng-if="adrs.idVGB_ADDR==VGB_SUPP_STADD" >
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


echo "<table><tr><td style='vertical-align:top;' >". $hardCode . "</td><td>" . $xtmp->currHtml . "</td></tr></table>";
  
echo "<!--";


// VGB_SUPP_BTADD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "STD_ADDRESS";
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
	
	
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$hardCode = "<table><tr><td ab-label='VGB_SUPP_PTADD' class='small text-muted' style='white-space:nowrap;width:75px;max-width:75px;font-size:small;'>Pay :</td><td>" . $hardCode . "</td></tr></table>"; 	
	
$xtmp->setFieldWrapper("view01","2.2","vgb_supp","VGB_SUPP_BTADD","",$grAttr,$laAttr,$inAttr,$hardCode);
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
	
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$hardCode = "<table><tr><td ab-label='VGB_SUPP_SFADD' class='small text-muted' style='white-space:nowrap;width:75px;max-width:75px;font-size:small;' >Pay :</td><td>" . $hardCode . "</td></tr></table>"; 	

$laAttr['class'] .= " hidden ";
	
$xtmp->setFieldWrapper("view01","2.2","vgb_supp","VGB_SUPP_STADD","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

	// $hardCode = '<small ab-menu="vgb_addr"  name="mainForm" ng-click="supportTBL()">&nbsp;<span class="btn-link ab-pointer glyphicon glyphicon-pencil" style="font-size:large;"></span>&nbsp;&nbsp;</small>';
	$hardCode = '<span  ab-menu="vgb_addr" name="mainForm" class="ab-pointer btn-primary text-primary" ng-click="supportTBL()">&nbsp;';
	$hardCode .= '<span class="glyphicon glyphicon-pencil"></span>&nbsp;';
	$hardCode .= '<span ab-label="VGB_ADDRESS">Addresses</span>&nbsp;';
	$hardCode .= '</span>';
$xtmp->setFieldWrapper("view01","2.2","vgb_supp","VGB_ADDRCT","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

echo "-->";			

		
//		echo '<div>';
//		include "../appHtml/VGB_ADDRCT.php";
//		echo '</div></div><div class="col-sm-3">';
//


// VGB_SUPP_CRELI
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CRELI";
$inAttr['ab-ft'] = "amt";
$inAttr['size'] = "8";
$xtmp->setFieldWrapper("view01","2.4","vgb_supp","VGB_SUPP_CRELI","",$grAttr,$laAttr,$inAttr,"");
echo '</div><div class="col-sm-2">';
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


//	//2,130	 	Transporter
//	$xtmp = new appForm("VSL_ORDERS");
//	$grAttr = $xtmp->grAttrib;
//	$grAttr["class"] .= " ab-spaceless";
//	$laAttr = $xtmp->laAttrib;
//	$laAttr["ab-label"] = "VGB_SVIACT";
//	$laAttr["class"] .= " ab-spaceless";
//	$inAttr = $xtmp->inAttrib;
//	$inAttr["class"] .= " hidden";
//	// $inAttr["size"] = "10";
//	$xtmp->setFieldWrapper("view01","2.130","vsl_orhe","VGB_SUPP_SHIPID","",$grAttr,$laAttr,$inAttr,"");
////	echo $xtmp->currHtml;		

$hardCode =<<< EOC

	<table style="width:100%" >
		<tr class="text-primary ab-strong" >
			<td style="width:80%" >
				<span ab-label="STD_DEFAULT"></span>
				<span ab-label="VGB_SVIACT"></span>
				<input class="hidden" ng-model="VGB_SUPP_SHIPID" />
			</td>
			<td style="width:20%">	
				<span class="glyphicon glyphicon-th-list text-primary"
				ng-click="initSupportSVIA();"
				onclick="$('#SHIPVIALIST').toggleClass('hidden');" >
				</span>
			</td>			
		</tr>
		<tr>
			<td colspan=2 class="ab-strong" >
				<span ng-repeat="custdet in vgb_cust_svia | AB_noDoubles:'idVGB_SVIA' " 
					ng-if="custdet.idVGB_SVIA == VGB_SUPP_SHIPID" >
					{{custdet.VGB_SUPP_BPNAM}} - {{custdet.VGB_SVIA_ACCNO}}
				</span>	
			</td>
			

		</tr>
	</table>
	<div id="SHIPVIALIST" class="hidden">
		<table style="width:100%;" class="{{vgb_cust_svia.length>0?'':'hidden'}} text-primary small ab-strong">
			<tr >
				<td style="width:60%;" >
					<span ab-label="VGB_PARTNERS_vgb_supp">Supp</span>
				</td>
				<td style="width:30%;" >
					<span ab-label="STD_ACCOUNT_NO">Acc&</span>
				</td>
				<td style="width:10%;" >
					<span class="btn-link ab-pointer" 
					ng-click="setSelectOrheSVIA(0);"
					onclick="$('#SHIPVIALIST').addClass('hidden');">Reset</span>
				</td>
			</tr>
			
		</table>
		<table style="width:100%;" class="table-striped" >
			<tr ng-repeat="custdet in vgb_cust_svia | AB_noDoubles:'VGB_SVIA_SUPPID,VGB_SVIA_CUSTID' " 
			ng-if="custdet.VGB_SVIA_CUSTID > 0"
			class="small ab-border ab-spaceless {{custdet.idVGB_SVIA==VSL_ORHE_SHIPID?'ab-strong':''}}" >
				<td style="width:60%;" >
					<span class="text-primary" ng-if="custdet.idVGB_SVIA==VGB_SUPP_SHIPID">
						<span class="glyphicon glyphicon-ok"></span>
					</span>
					<span >{{custdet.VGB_SUPP_BPNAM}}</span>
					
					<span class="small">[{{custdet.VGB_SVIA_VIATXT}}]</span>

				</td>
				<td style="width:30%;" >
					{{custdet.VGB_SVIA_ACCNO}}
				</td>								
				<td style="width:10%;" class="text-right" >
					<span class="text-primary  ab-pointer ab-strong" 
					ng-click="setSelectOrheSVIA(custdet.idVGB_SVIA);"
					onclick="$('#SHIPVIALIST').addClass('hidden');">Select</span>
				</td>
			</tr>
			<tr ng-repeat="custdet in vgb_cust_svia | AB_noDoubles:'VGB_SVIA_SUPPID,VGB_SVIA_CUSTID' " 
			ng-if="custdet.VGB_SVIA_CUSTID == 0"
			class="small ab-border ab-spaceless {{custdet.idVGB_SVIA==VSL_ORHE_SHIPID?'ab-strong':''}}" >
				<td style="width:60%;" >
					<span class="text-primary" ng-if="custdet.idVGB_SVIA==VSL_ORHE_SHIPID">
						<span class="glyphicon glyphicon-ok"></span>
					</span>
					<span >{{custdet.VGB_SUPP_BPNAM}}</span>
					
					<span class="small">[{{custdet.VGB_SVIA_VIATXT}}]</span>

				</td>
				<td style="width:30%;" >
					{{custdet.VGB_SVIA_ACCNO}}
				</td>								
				<td style="width:10%;" class="text-right" >
					<span class="text-primary  ab-pointer ab-strong" 
					ng-click="setSelectOrheSVIA(custdet.idVGB_SVIA);"
					onclick="$('#SHIPVIALIST').addClass('hidden');">Select</span>
				</td>
			</tr>
			
		</table>
	</div>
							
EOC;


echo  $hardCode;





?>
<!--
<table>
<tr>
<td>
	<input ng-model="TTTvgb_curr" size=2 placeholder="Select" 
	ng-click="hold=VGB_CURR_CURID;VGB_CURR_CURID='';VGB_CURR_CURID_F='';ABlstAlias('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr');VGB_CURR_CURID=hold;" 
	ng-change="ABfindRec(TTTvgb_curr,rawResult.vgb_curr,'VGB_SUPP_CURID','idVGB_CURR');" 
	onfocus="$(this).click();"
	id="390556055556"
	value=""   class="small ab-spaceless text-primary" 
	onblur="$(this).val('');"  /> 
						
</td>
<td>&nbsp;</td>
<td >

<ul class="nav  ab-spaceless small" role="tablist"    >
	<li class="dropdown ab-spaceless" >
		<span data-toggle="dropdown" class="text-primary btn-link" style="white-space:nowrap;padding:0px;" onclick="$('#390556055556').click()">
			<span ng-repeat="rH in vgb_curr" ng-if="rH.idVGB_CURR==VGB_SUPP_CURID"  >
				{{rH.VGB_CURR_CURID}}-{{rH.VGB_CURR_DESCR}}
			</span>
			
			&nbsp;&nbsp;<span class="caret" ></span>
		</span>

		<ul class="dropdown-menu ab-spaceless"  role="menu"  >
			<li class="dropdown ab-border ab-spaceless ab-pointer" 
			ng-repeat="rD in vgb_curr"
			ng-click="ABsetField('VGB_SUPP_CURID',rD.idVGB_CURR);"  >
			
				<span ng-if="rD.idVGB_CURR!=VGB_SUPP_CURID"
				class="small "  >
					<span class="invisible">
						<span class="glyphicon glyphicon-ok"></span>
					</span>
					{{rD.VGB_CURR_CURID}}-{{rD.VGB_CURR_DESCR}} 
				</span>
				<span ng-if="rD.idVGB_CURR==VGB_SUPP_CURID"
				class="small ab-strong text-primary"  >
					<span class="glyphicon glyphicon-ok"></span>
					{{rD.VGB_CURR_CURID}}-{{rD.VGB_CURR_DESCR}}
				</span>
			</li>

		</ul>
	</li>
</ul>

</td>
</tr>
</table>
-->

<?php




echo '</div>';

echo '<div class="col-sm-6">';
require_once "../appHtml/VGB_ADDRCT.php";
echo '</div>';
echo '</form>';

echo '</div></div><div>';
//<iframe src="" name="ab-frm.VGB_ADDRCT" class="ab-borderless ab-spaceless" style="overflow:hidden;width:100%;height:600px;" ></iframe></div>';

echo '</div>';





?>


		
	</div>
</div>
<div id="modalVgbAddr" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" ng-init="new_BTADD='';new_STADD=''">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span ab-label="STD_ADDRESS" >Order Address Selection </span> - <label>{{VGB_SUPP_BPNAM}}</label></h4>
       
        <table>
        <tr 	ng-repeat="adrs in VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR'" >
        
        	<td >
        		
			<span ng-if="adrs.idVGB_ADDR==VGB_SUPP_BTADD" >
				<span class="text-primary">Bill to&nbsp;&nbsp; : </span>
				{{adrs.VGB_ADDR_ADDID}} - {{adrs.VGB_ADDR_DESCR}} 
			</span>
	        	
        	</td>

        </tr>
        <tr 	ng-repeat="adrs in VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR'" >
        
        	<td >
        		
	        	
	        	<span ng-if="adrs.idVGB_ADDR==VGB_SUPP_STADD">
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
	        				<input type="radio" checked name="btcust" ng-if="ad.idVGB_ADDR==VGB_SUPP_BTADD" />
	        				<input type="radio" rval='{{ad.idVGB_ADDR}}' onclick="deflectVal($(this).attr('rval'),'VGB_SUPP_BTADD');" onKlick="$('#new_BTADD').val($(this).attr('rval'));" name="btcust" ng-if="ad.idVGB_ADDR!=VGB_SUPP_BTADD" />
	        				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        				<input type="radio" checked name="stcust" ng-if="ad.idVGB_ADDR==VGB_SUPP_STADD" />
	        				<input type="radio" rval='{{ad.idVGB_ADDR}}' onclick="deflectVal($(this).attr('rval'),'VGB_SUPP_STADD');" onKlick="$('#new_STADD').val($(this).attr('rval'));" name="stcust" ng-if="ad.idVGB_ADDR!=VGB_SUPP_STADD" />
						

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




