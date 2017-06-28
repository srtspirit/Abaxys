<?php // require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<?php require_once "../appCscript/VIN_ITEMS.php"; ?>




<div class="row ab-spaceless ">

		<div class="col-sm-12 ab-spaceless" >
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		</div>

	</div>
	
	
	
	
<div class="ab-spaceless" >









<textarea class="hidden" ab-updSuccess="" >


if (data['posts'].requestMethod == 'DELETE')
{
	$scope.orgId=0;
	$scope.initCustItmdta(0);
}
else
{
	
	var tmpId = $scope.idVIN_CUST
	if (data['posts'].requestMethod == 'CREATE')
	{

		tmpId=data['posts'].insertId;
	    
	}

	$scope.orgItemId = $scope.VIN_CUST_ITMID;
	$scope.orgCustId = $scope.VIN_CUST_BPART;

	$scope.initCustItmdta(tmpId)
 	
 	
 	
	
	


}


</textarea>

<div class="hidden" ng-init="SESSION_DESCR='Customer Item'">
	<span ab-label="VIN_CUSTCT"></span>
</div>
<div id="ab-new" class="hidden" ng-init="tdDates = ABGetDateFn('','');" >

	<label  title="CREATE" class="{{idVIN_CUST>0?'':'hidden'}}">
		 <a ng-click="orgId=0;initCustItmdta(0);"
	hrssef="#VIN_ITEMS/VIN_CUSTCT/Process:VIN_ITEMS,Session:VIN_CUSTCT,tblName:vin_cust,updType:CREATE,idVIN_CUST:0,tbData:{{tbData}},idVIN_ITEM:{{VIN_CUST_ITMID}},idVGB_CUST:{{VIN_CUST_BPART}}" 
	>
		<span >New</span>
		<span  class="glyphicon glyphicon-pencil" ></span>
	</a>			
	</label>
	
</div>
	<script>
		$('#ab-appOpt').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
		
		
		// $('#ab-delete').find("[ng-click]").attr("ng-click","delSet();")
		
	</script>
<!--
Attribute ab-updSuccess - Optional
If present and ABupd is successfull
ABupd() will execute (eval) the value of the object

Note that $scope needs to be in the code as opposed to data-ng-init= above
-->
</div>
	
	<div class="row ab-borderless ab-spaceless" style="margin:0px;padding:0px;">
	
	<form id="mainForm" name="mainForm"  ab-view="vin_cust" ab-main="vin_cust">
	
	<input  class="hidden" ab-btrigger="vin_cust" ng-model="idVIN_CUST"  /> 
	
	
 	
 	
 	
	<div class="col-sm-4">
	
	<input type="text" class="hidden" ng-model="VIN_CUST_BPART" />
  	<input type="text" class="hidden" ng-model="VIN_CUST_ITMID" />	
 	<input type="text" class="hidden" ng-model="VIN_CUST_ITMBP" />
 	<input type="text" class="hidden" ng-model="VIN_CUST_BPITD" /> 	
 	<input type="text" class="hidden" ng-model="VIN_CUST_UBPDE" />
 	<input type="text" class="hidden" ng-model="VIN_CUST_UBPCO" />
 	<input type="text" class="hidden" ng-model="VIN_CUST_QUONU" />
 	
 	
	<?php
	$hardCode =<<<EOC

<div><table class="table" >
<tr>
	<td class="text-primary " style="width:25%;">
		<span class="btn-link ab-pointer ab-strong" ng-click="ABsearchTbl='vgb_cust';ABsessionLink('','#VGB_CUSTsearch','vgb_cust');" >
			<span ab-label="VGB_CUST_BPART"></span>
			<span class="" vgb_cust=""  >
				<span class="glyphicon glyphicon-search" ></span>
			</span>
		</span>
	</td>
	<td style="width:75%;">	
		<span>
			<input class="hidden" id="VGB_CUSTsearch" ng-click="initNewCustomer();" />
			<label>{{VGB_BPAR_BPART}}</label>
			<input class="hidden" ng-model="VIN_CUST_BPART" />
			<span ng-if="VGB_BPAR_BPART" >&nbsp-&nbsp&nbsp</span>
			<label>{{ VGB_CUST_BPNAM }}</label>
		</span>
	</td>
</tr>
	
EOC;
	
	

	
	//VIN_CUST_BPART
	$xtmp = new appForm("VIN_CUSTCT");
	$grAttr = $xtmp->grAttrib;
	// $grAttr["class"] .= " col-sm-3 ";
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VGB_CUST_BPART";
	$laAttr["class"] = "hidden";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.030","VIN_CUST_BPART","VIN_CUST_BPART","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
	


// echo '</div><div class="col-sm-3 ">';
	
	$harderCode =<<<EOC



<tr>
	<td class="text-primary">
		<span  class="btn-link ab-pointer ab-strong" ng-click="ABsearchTbl='vin_item';ABsessionLink('','#VIN_ITEMsearch','vin_item');">
			<span ab-label="VIN_ITEM_ITMID"></span>
			<span class="ab-pointer" vin_item="" >
				<span class="glyphicon glyphicon-search text-primary" ></span>
			</span>

	</td>
	<td>		
		<span>
			<input class="hidden" id="VIN_ITEMsearch" ng-click="initNewItem();" />
			<label >{{VIN_ITEM_ITMID}}</label>
			<input class="hidden" ng-model="VIN_ITEM_ITMID" />
			<span ng-if="VIN_ITEM_ITMID" >&nbsp-&nbsp&nbsp</span>
			<label>{{ VIN_ITEM_DESC1 }}</label>
		</span>
		
	</td>
</tr>
</table></div>




EOC;
	
	//VIN_CUST_BPART
	$xtmp = new appForm("VIN_CUSTCT");
	$grAttr = $xtmp->grAttrib;
	// $grAttr["class"] .= " col-sm-3 ";
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VIN_ITEM_ITMID";
	$laAttr["class"]="hidden";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.030","VIN_CUST_ITMID","VIN_CUST_ITMID","",$grAttr,$laAttr,$inAttr,$harderCode);
	echo $xtmp->currHtml;
	
echo '</div><div class="text-center col-sm-1 ab-spaceless">';


	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] = "ab-spaceless";
	$grAttr["style"] = "";
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="STD_LAST_PRICE_PAID";
	$inAttr = $xtmp->inAttrib;
	$inAttr["ab-ft"] = "amt";
	$inAttr["readonly"] = "1";
	$inAttr["size"] = "6";
	
	$grAttr["class"] .= " {{VIN_CUST_LPDATE>''?'':'hidden'}}";
	$xtmp->setFieldWrapper("view01","0.0","vin_cust","VIN_CUST_LPPAID","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;


	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$grAttr["class"] = "ab-spaceless";
	$laAttr["class"] = " hidden ";
	$inAttr = $xtmp->inAttrib;
	$grAttr["class"] .= " {{VIN_CUST_LPDATE>''?'hidden':''}}";
	$xtmp->setFieldWrapper("view01","0.0","vin_cust","VIN_CUST_LPPAID","",$grAttr,$laAttr,$inAttr,"<span class='text-primary'> Never purchased </span>");
	echo $xtmp->currHtml;

	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] = "ab-spaceless";
	$laAttr = $xtmp->laAttrib;
	$laAttr["class"] .= " hidden ";
	$inAttr = $xtmp->inAttrib;
	
	$inAttr["readonly"] = "1";
	$inAttr["size"] = "8";
	$grAttr["class"] .= " {{VIN_CUST_LPDATE>''?'':'hidden'}}";
	$xtmp->setFieldWrapper("view01","0.0","vin_cust","VIN_CUST_LPDATE","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;


echo '</div><div class="text-center col-sm-1 ab-spaceless">';

	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] = "ab-spaceless";
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="VIN_ITEM_LISTP";
	$inAttr = $xtmp->inAttrib;
	$inAttr["ab-ft"] = "amt";
	$inAttr["readonly"] = "1";
	$inAttr["size"] = "6";
	$xtmp->setFieldWrapper("view01","0.0","vin_cust","VIN_ITEM_LISTP","",$grAttr,$laAttr,$inAttr,"");
	// echo '<div ab-label="VIN_ITEM_ITMID_ABR" class="text-primary ab-strong"></div>';
	echo $xtmp->currHtml;


echo '</div></div><div class="row"><div class="col-sm-1" ></div><div class="col-sm-2 ">';
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="VIN_CUST_ITMBP";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","0.0","vin_cust","VIN_CUST_ITMBP","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="VIN_CUST_BPITD";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","0.0","vin_cust","VIN_CUST_BPITD","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
	
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="VIN_CUST_UBPDE";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setYesNoField("VIN_CUST_UBPDE");
	$xtmp->setFieldWrapper("view02","0.0","vin_cust","VIN_CUST_UBPDE","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="VIN_CUST_UBPCO";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setYesNoField("VIN_CUST_UBPCO");
	$xtmp->setFieldWrapper("view02","0.0","vin_cust","VIN_CUST_UBPCO","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
	

    
		
      
	?>

	</div>

	<div class="col-sm-2 text-top">
	<input type="text" class="hidden" ng-model="VIN_CUST_EXPYN" />
	<input type="text" class="hidden" ng-model="VIN_CUST_EXPIR" />	
	<input type="text" class="hidden" ng-model="VIN_CUST_STDCP" />
	<input type="text" class="hidden" ng-model="VIN_CUST_SELLP" />
    <input type="text" class="hidden" ng-model="VIN_CUST_SUPPL" />	
    
	
	<?php 

	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="VIN_CUST_QUONU";
	$inAttr = $xtmp->inAttrib;
	$inAttr["title"] = "Enter a QuoteId to activate special pricing";
	$xtmp->setFieldWrapper("view01","0.0","vin_cust","VIN_CUST_QUONU","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
	
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="STD_EXPIRES";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setYesNoField("VIN_CUST_EXPYN");
	$xtmp->setFieldWrapper("view01","1.1","vin_cust","VIN_CUST_EXPYN","",$grAttr,$laAttr,$inAttr,$hardCode);

	$exp1 = $xtmp->currHtml;

	
	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] .= " {{VIN_CUST_EXPYN>0?'':'invisible'}} ab-spaceless"; 
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="STD_DATE_END_SH";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setDatePick("VIN_CUST_EXPIR");
	$xtmp->setFieldWrapper("view01","1.1","vin_cust","VIN_CUST_EXPIR","",$grAttr,$laAttr,$inAttr,$hardCode);
	
	$exp2 = $xtmp->currHtml;
	
	echo "<div class=" . '"{{VIN_CUST_QUONU && VIN_CUST_QUONU.trim()!='  . "''?'':'hidden'}} ". '"' . " ><table style='width:100%;' class='ab-spaceless'><tr><td>" . $exp1 . "</td><td>" . $exp2 . "</td></tr></table></div>";
	

	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] .= " {{VIN_CUST_QUONU && VIN_CUST_QUONU.trim()!=''?'':'hidden'}} ";
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "VIN_BPIT_SELLP";
	$inAttr['size']="8";
	$inAttr['ab-ft'] = "amt";
	$xtmp->setFieldWrapper("view01","1.1","","VIN_CUST_SELLP","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;





$hardCode =<<<EOC

	</div><div class="col-sm-3 text-top {{VIN_CUST_QUONU && VIN_CUST_QUONU.trim()!=''?'':'hidden'}}"  >


EOC;

	echo $hardCode;

	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "VIN_CUST_ACTYP";	
	
	$hardCode =  $xtmp->setEnumField('vin_cust','VIN_CUST_ACTYP');
	$xtmp->setFieldWrapper("view01","1.1","vin_cust","VIN_CUST_ACTYP","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
	
	//echo $hardCode;

$hardCode =<<<EOC

	<div class="well {{VIN_CUST_ACTYP=='SUPP'?'':'hidden'}} ab-spaceless">
	

EOC;

	echo $hardCode;
	

	$hardestCode =<<<EOC

<table>
<tr>
<td>	
	<input class="hidden" id="VGB_SUPPsearch" ng-click="initNewSupp();" />
	
	<span class="btn-link ab-pointer text-primary ab-strong" vgb_supp=""
	ng-click="ABsessionLink('#/VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_supp,SourceProcess:VIN_ITEMS','#VGB_SUPPsearch','vgb_supp');" 
	>
		<span ab-label="VGB_PARTNERS_vgb_supp" ></span>
		<span class="glyphicon glyphicon-search" ></span>

	</span>
</td>
</tr>
<tr>
<td>	
	<span>		
		<label>{{VGB_BPAR_BPARTS}}</label>
		<input class="hidden" ng-model="VIN_CUST_SUPPL" />
		<span ng-if="VGB_BPAR_BPARTS" >&nbsp-&nbsp&nbsp</span>
		<label>{{ VGB_SUPP_BPNAM }}</label>
	</span>
</td>
</tr>
</table>

EOC;
	
	//VIN_CUST_BPART
	$xtmp = new appForm("VIN_CUSTCT");
	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] .= " ab-spaceless ";
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VGB_PARTNERS_vgb_supp";
	$laAttr["class"] = "hidden";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.030","VIN_CUST_ITMID","VIN_CUST_SUPPL","",$grAttr,$laAttr,$inAttr,$hardestCode);
	echo $xtmp->currHtml;
	
		
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "VIN_CUST_STDCP";
	$inAttr['size']="8";
	$inAttr['ab-ft'] = "amt";
	$xtmp->setFieldWrapper("view01","1.1","","VIN_CUST_STDCP","",$grAttr,$laAttr,$inAttr,"");
	$exp1 = $xtmp->currHtml;
	
	
	//$grAttr = $xtmp->grAttrib;
	//$laAttr = $xtmp->laAttrib;
	//$inAttr = $xtmp->inAttrib;
	//$laAttr['ab-label'] = "VIN_ITEM_STDCP";
	//$inAttr['size']="8";
	//$inAttr['ab-ft'] = "amt";
	//$xtmp->setFieldWrapper("view01","1.1","","VIN_CUST_STDCP","",$grAttr,$laAttr,$inAttr,"");
	//$exp2 = $xtmp->currHtml;
	
	//echo "<div ><table class='table'><tr><td>" . $exp1 . "</td><td>" . $exp2 . "</td></tr></table></div>";
	echo "<div ><table class='table'><tr><td>" . $exp1 . "</td></tr></table></div>";
	
	?>
	
	
	</div>	
	</div>
	
	
	</form>
	</div>
	