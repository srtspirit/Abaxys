<div class="col-sm-12">
<script>

function toggleAllOrders(partId)
{
	var tOpen = true;
	$("[pname='partner_" + partId + "']").each(function()
	{
		if ($(this).hasClass("hidden")==false)
		{
			tOpen = false;
		}
		$(this).addClass("hidden");
		
	});
	$("[pname='partner_" + partId + "']").each(function()
	{
		if (tOpen == true)
		{
			$(this).removeClass("hidden");
		}
	});
	
}

</script>


<table class="table table-condensed ab-spaceless" >
      	 <tr>
		<td>
			<div class="col-sm-1 ab-spaceless">
			<span style="padding-left:5px;" partner="{{x.idVGB_CUST}} " onclick="toggleAllOrders($(this).attr('partner'));" class="btn-link glyphicon glyphicon-th-list small"></span>
			</div>  
			<div class="col-sm-1 ab-spaceless">&nbsp;</div>
			<div class="col-sm-3">
				<label class="small">
					<em  ab-label="VSL_ORHE_ORNUM" class="text-primary">Order No.#</em>
				</label>
			</div>  
			<div class="col-sm-4">
				<label class="small">
					<em  ab-label="VSL_ORHE_CUSPO" class="text-primary">Purchase Order</em>
				</label>
			</div>
			<div class="col-sm-3">
				<label class="small">
					<em  ab-label="VSL_ORHE_ODATE" class="text-primary">Order Date </em>
				</label>
			</div>
		</td>
	</tr>
	       	
        <tr class="ab-spaceless" ng-repeat="k in rawResult.vgb_bpar | AB_noDoubles:'idVSL_ORHE'" ng-if="k.VSL_ORHE_BTCUS==x.idVGB_CUST" >
        	<td  class="ab-spaceless">
        		<div class="col-sm-1 ab-spaceless">
        			<span style="padding-left:5px;" onclick="$('#innerexp_'+$(this).attr('vval')).toggleClass('hidden');" vval="{{k.idVSL_ORHE}}" class="btn-xs ab-pointer glyphicon glyphicon-th-list">
        			</span>
        		</div>        

	               <div ng-if="ABiframe!='VSL_ORDERS'" class="col-sm-1 ab-spaceless">
	               		<a target="{{ABtarget}}" href="#/VSL_ORDERS/VSL_ORHECT/idVSL_ORHE:{{k.idVSL_ORHE}},updType:UPDATE,Session:VSL_ORHECT,Process:VSL_ORDERS" >
					<span class="text-primary small">Edit<span class="glyphicon glyphicon-pencil" ></span>
				</a>
			</div>
			<div class="col-sm-3">

<?php
// VSL_ORHE ORDER ID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label>&nbsp;{{k.VSL_ORHE_ORNUM}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vsl_orhe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</div><div  class="col-sm-4">';

// VSL_ORHE PURCHASE ID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label>&nbsp;{{k.VSL_ORHE_CUSPO}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vsl_orhe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</div><div  class="col-sm-3">';

 // VSL_ORHE DATE
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label><small>&nbsp;{{k.VSL_ORHE_ODATE}}</small></label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vsl_orhe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</div>';
?>

<div id="innerexp_{{k.idVSL_ORHE}}"  pname="partner_{{x.idVGB_CUST}}" class="hidden">
<div class="row" exp-list="1"  >
	<div class="col-sm-1">
		<label class="small"><em  ab-label="xxVSL_ORDE_ORLIN" class="text-primary">Line</em></label>
	</div>
	<div class="col-sm-2">
		<label class="small"><em  ab-label="VIN_ITEM_ITMID" class="text-primary">Item</em></label>
	</div>
	<div class="col-sm-4">
		<label class="small"><em  ab-label="VSL_ORDE_DESCR" class="text-primary">Description</em></label>
	</div>
	<div class="col-sm-1 text-right">
		<label class="small"><em  ab-label="xxVSL_ORDE_DESCR" class="text-primary">Qty</em></label>
	</div>
	<div class="col-sm-2 text-right">
		<label class="small"><em  ab-label="xxVSL_ORDE_DESCR" class="text-primary">Price</em></label>
	</div>
	<div class="col-sm-2 text-right">
		<label class="small"><em  ab-label="xxVSL_ORDE_DESCR" class="text-primary">Total</em></label>
	</div>
</div>
<div class="row" ng-repeat="y in rawResult.vgb_bpar | AB_noDoubles:'idVSL_ORDE'" ng-if="y.idVSL_ORHE == k.idVSL_ORHE" >
	<div class="col-sm-1"><label class="small"> {{y.VSL_ORDE_ORLIN}}</label></div>
	<div class="col-sm-2"><label class="small"> {{y.VIN_ITEM_ITMID}}</label></div>
	<div class="col-sm-4"><label class="small"> {{y.VSL_ORDE_DESCR}}</label></div>
	<div class="col-sm-1 text-right"><label class="small"> {{y.VSL_ORDE_ORDQT}}</label></div>
	<div class="col-sm-2 text-right"><label class="small"> {{ABGetNumberFn('fmt-curr',y.VSL_ORDE_OUNET)}}</label></div>
	<div class="col-sm-2 text-right" ><label class="small">{{ABGetNumberFn('fmt-curr',(y.VSL_ORDE_ORDQT * y.VSL_ORDE_OUNET)) }}</label></div>
</div>
</div>
</td></tr></table>
</div>