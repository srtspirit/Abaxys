


<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>
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

	$scope.initSuppItmdta(0);
}
else
{
	
	var tmpId = $scope.idVIN_SUPP
	if (data['posts'].requestMethod == 'CREATE')
	{

		tmpId=data['posts'].insertId;
	    
	}

	$scope.orgItemId = $scope.VIN_SUPP_ITMID;
	$scope.orgSuppId = $scope.VIN_SUPP_BPART;

	$scope.initSuppItmdta(tmpId)
 	
 	}


</textarea>

<div class="hidden" ng-init="SESSION_DESCR='Supplier Item'">
	<span ab-label="VIN_SUPPCT"></span>
</div>
<div id="ab-new" class="hidden" ng-init="tdDates = ABGetDateFn('','');" >

	<label  title="CREATE" class="{{idVIN_SUPP>0?'':'hidden'}}">
		 <a ng-click="orgeId=0;initSuppItmdta(0);"
	hrssef="#VIN_ITEMS/VIN_SUPPCT/Process:VIN_ITEMS,Session:VIN_SUPPCT,tblName:vin_supp,updType:CREATE,idVIN_SUPP:0,tbData:{{tbData}},idVIN_ITEM:{{VIN_SUPP_ITMID}},idVGB_SUPP:{{VIN_SUPP_BPART}}" 
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
	
	<form id="mainForm" name="mainForm"  ab-view="vin_supp" ab-main="vin_supp">
	
	<input  class="hidden" ab-btrigger="vin_supp" ng-model="idVIN_SUPP"  /> 
	
	
 	
 	
 	
	<div class="col-sm-3">
	
	<input type="text" class="hidden" ng-model="VIN_SUPP_BPART" />
  	<input type="text" class="hidden" ng-model="VIN_SUPP_ITMID" />	
 	<input type="text" class="hidden" ng-model="VIN_SUPP_ITMBP" />
 	<input type="text" class="hidden" ng-model="VIN_SUPP_BPITD" /> 	
 	<input type="text" class="hidden" ng-model="VIN_SUPP_UBPDE" />
 	<input type="text" class="hidden" ng-model="VIN_SUPP_UBPCO" />
 	
 	
	<?php
	$hardestCode =<<<EOC
	
<table>
<tr>
<td>	
	<input class="hidden" id="VGB_SUPPsearch" ng-click="initNewSupp();" />
	<span class="btn-link ab-pointer text-primary ab-strong" vgb_supp=""
	ng-click="ABsearchTbl='vgb_supp';ABsessionLink('','#VGB_SUPPsearch','vgb_supp');"
	>
		<span ab-label="VGB_SUPP_BPART"></span>
		<span class="glyphicon glyphicon-search text-primary" ></span>
	</span>
</td>
</tr>
<td>		
	&nbsp&nbsp<label>{{VGB_BPAR_BPART}}</label>
	<input class="hidden" ng-model="VIN_SUPP_BPART" />
	<span ng-if="VGB_BPAR_BPART" >&nbsp-&nbsp&nbsp</span>
	<label>{{ VGB_SUPP_BPNAM }}</label>
</td>
</tr>
</table>

EOC;
	
	//VIN_SUPP_BPART
	$xtmp = new appForm("VIN_SUPPCT");
	$grAttr = $xtmp->grAttrib;
	// $grAttr["class"] .= " col-sm-3 ";
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VGB_SUPP_BPART";
	$laAttr["class"] .= " hidden ";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.030","VIN_SUPP_BPART","VIN_SUPP_BPART","",$grAttr,$laAttr,$inAttr,$hardestCode);
	echo $xtmp->currHtml;
	
	
	
	
	
	
	

echo '</div><div class="col-sm-3 ">';
	
	$harderCode =<<<EOC

<table>
<tr>
<td>	
	<input class="hidden" id="VIN_ITEMsearch" ng-click="initNewItem();" />
	<span class="btn-link ab-pointer text-primary ab-strong" vin_item=""
	ng-click="ABsearchTbl='vin_item';ABsessionLink('','#VIN_ITEMsearch','vin_item');"
	>
		<span ab-label="VIN_ITEM_ITMID"></span>
		<span class="glyphicon glyphicon-search text-primary" ></span>
	</span>
</td>
</tr>
<td>		
	<label>{{VIN_ITEM_ITMID}}</label>
	<input class="hidden" ng-model="VIN_ITEM_ITMID" />
	<span ng-if="VIN_ITEM_ITMID" >&nbsp-&nbsp&nbsp</span>
	<label>{{ VIN_ITEM_DESC1 }}</label>
</td>
</tr>
</table>


EOC;
	
	//VIN_SUPP_BPART
	$xtmp = new appForm("VIN_SUPPCT");
	$grAttr = $xtmp->grAttrib;
	// $grAttr["class"] .= " col-sm-3 ";
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VIN_ITEM_ITMID";
	$laAttr["class"] .= " hidden ";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.030","VIN_SUPP_ITMID","VIN_SUPP_ITMID","",$grAttr,$laAttr,$inAttr,$harderCode);
	echo $xtmp->currHtml;
	
echo '</div></div><div class="row"><div class="col-sm-1" ></div><div class="col-sm-2 ">';
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="VIN_SUPP_ITMBP";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","0.0","vin_supp","VIN_SUPP_ITMBP","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="VIN_SUPP_BPITD";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","0.0","vin_supp","VIN_SUPP_BPITD","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
	
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="VIN_SUPP_UBPDE";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setYesNoField("VIN_SUPP_UBPDE");
	$xtmp->setFieldWrapper("view02","0.0","vin_supp","VIN_SUPP_UBPDE","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="VIN_SUPP_UBPCO";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setYesNoField("VIN_SUPP_UBPCO");
	$xtmp->setFieldWrapper("view02","0.0","vin_supp","VIN_SUPP_UBPCO","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
	
   
		
      
	?>

	</div>

	<div class="col-sm-3 text-top">

	<input type="text" class="hidden" ng-model="VIN_SUPP_STDCP" />
	<input type="text" class="hidden" ng-model="VIN_SUPP_PUMIN" />
	<input type="text" class="hidden" ng-model="VIN_SUPP_PURND" />
   
	
	<?php 
	
		

	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "VIN_ITEM_STDCP";
	$inAttr['size']="8";
	$inAttr['ab-ft'] = "amt";
	$xtmp->setFieldWrapper("view01","1.1","","VIN_SUPP_STDCP","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "VIN_ITEM_PUMIN";
	$inAttr['size']="8";
	//$inAttr['ab-ft'] = "amt";
	$xtmp->setFieldWrapper("view01","1.1","","VIN_SUPP_PUMIN","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
	
	
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "VIN_ITEM_PURND";
	$inAttr['size']="8";
	//$inAttr['ab-ft'] = "amt";
	$xtmp->setFieldWrapper("view01","1.1","","VIN_SUPP_PURND","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
	
	
	
	?>	
	</div>
	
	
	</form>
	</div>
	