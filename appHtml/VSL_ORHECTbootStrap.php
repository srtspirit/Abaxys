<?php require_once "../stdSscript/stdAppobjGen.php"; ?>

<div class="ab-spaceless" 
ng-init="
abastract='Completelty abstart as a concept';
SESSION_DESCR = 'Grid Alignement examples';
VGB_CURR_CURID = 'CAD';
VGB_CURR_DESCR = 'Canadian Dollar';
VGB_ORHE_ORNUM = 99999;
VGB_CUST_BPNAM = 'A big corp. Inc.';
VGB_ADDR_DESCR = 'A big corp. Address';

" >
      


</div>

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
	  
<div class="text-left ab-spaceless">    
  <div class="row text-left">
  <div class="col-sm-12 ab-spaceless">
		<?php require_once "../stdCscript/stdFormButtons.php"; ?>
  </div>

    <div class="col-sm-4 ab-border">
	<div class="row">
			<form id="mainForm" name="mainForm"  ab-context="1" ab-view="vsl_orhe" ab-main="vsl_orhe"  >			
			<div class="col-sm-6 text-left">

				<input  class="hidden" ab-btrigger="vsl_orhe" ng-model="idVSL_ORHE" /> 
				<input  class="hidden" ng-init="VIN_UNIT_UNITM = ' ';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);" ng-model="VIN_UNIT_UNITM" />
				<input  class="hidden" ng-init="VGB_CURR_CURID = ' ';ABlstAlias('VGB_CURR_CURID','VGB_CURR_CURID','vin_curr',0);" ng-model="VGB_CURR_CURID" />
				
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
	echo '</div><div class="col-sm-6 text-left">';

$hardCode =<<<EOC
	
<span>
<input class="hidden" id="VGB_CUSTsearch" ng-click="initNewCustomer();" />
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
echo '</div><div class="col-sm-6 text-left">';		

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
	
	// <span type="button" class="btn-link" data-toggle="modal" data-target="#myModal11"></span>
	//2,050	 	VSL_ORHE_BTADD
	$grAttr = $xtmp->grAttrib;
	// $grAttr['class'] = "hidden";
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "STD_ADDRESS";
	$xtmp->setFieldWrapper("view01","2.050","vsl_orhe","VSL_ORHE_BTADD","",$grAttr,$laAttr,$inAttr," ");
	$hardCode = "<table><tr><td>".$xtmp->currHtml."</td><td>".'<span type="button" class="btn-link" data-toggle="modal" data-target="#myModal11">?</span></td></tr></table>';
//	$laAttr['data-toggle'] = "modal";
//	$laAttr['data-target'] = "#myModal11";
//	$laAttr['class'] = "btn btn-link";

 

$harderCode = <<<EOB

        <table>
        <tr>
        	<td rowspan=100 style="text-align:middle;vertical-align:top;">
        	<input class="hidden" ng-model="VSL_ORHE_BTADD" />
        	<input class="hidden" ng-model="VSL_ORHE_STADD" />
        	
        	<span class="btn btn-link glyphicon glyphicon-search ab-spaceless" data-toggle="modal" data-target="#myModal11" ng-click="initAddress();" ></span>
        	<span>&nbsp;</span>
        	</td>
        </tr>
         <tr 	ng-repeat="add in vgb_addr | AB_Selected:VGB_CUST_BPART:'VGB_ADDR_BPART' | AB_noDoubles:'VGB_ADDR_BPART'" 
        	ng-if="add.isSelected==''"
        >
        	<td style="text-align:right;">
        		
        		<span ng-repeat="adrs in add.rowSet" >
	        		<span ng-if="adrs.idVGB_ADDR==VSL_ORHE_BTADD" >
	        			<span ab-label='STD_BILL_TO' class='small text-primary'>Bill</span>
	        			<label class="small" >{{adrs.VGB_ADDR_ADDID}} - {{adrs.VGB_ADDR_DESCR}} </label>
	        			<span>&nbsp;</span>
	        		</span>
	        	</span>
	        	
        	</td>
        </tr>
         <tr 	ng-repeat="add in vgb_addr | AB_Selected:VGB_CUST_BPART:'VGB_ADDR_BPART' | AB_noDoubles:'VGB_ADDR_BPART'" 
        	ng-if="add.isSelected==''"
        >
        	<td style="text-align:right;">
        		
        		<span ng-repeat="adrs in add.rowSet" >
	        		<span ng-if="adrs.idVGB_ADDR==VSL_ORHE_STADD" >
	        			<span ab-label='STD_SHIP_TO' class='small text-primary'>Ship</span>
	        			<label class="small" >{{adrs.VGB_ADDR_ADDID}} - {{adrs.VGB_ADDR_DESCR}} </label>
	        		</span>
	        	</span>
	        	
        	</td>
        </tr>        
        </table>
        
EOB;


	$hardCode = "<table  class='small'><tr><td ab-label='STD_BILL_TO' class='small text-primary' style='white-space:nowrap;width:40px;max-width:50px;font-size:small;'>Bill to:</td><td>:</td><td>" . $harderCode . "</td></tr></table>"; 	
	 
   $xtmp->setFieldWrapper("view01","2.050","vsl_orhe","VSL_ORHE_BTADD","",$grAttr,$laAttr,$inAttr,$harderCode);
   echo $xtmp->currHtml;
   
	//2,060	 	VSL_ORHE_STADD
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$laAttr['ab-label'] = "STD_SHIP_TO";

$harderCode = <<<EOB

<div id="myModal11" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" ng-init="new_BTADD='';new_STADD=''">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span ab-label="STD_ADDRESS" >Order Address Selection </span> - <label>{{VGB_CUST_BPNAM}}</label></h4>
       
        <table>
        <tr 	ng-repeat="add in vgb_addr | AB_Selected:VGB_CUST_BPART:'VGB_ADDR_BPART' | AB_noDoubles:'VGB_ADDR_BPART'" 
        	ng-if="add.isSelected==''"
        >
        	<td >
        		
        		<span ng-repeat="adrs in add.rowSet" >
	        		<span ng-if="adrs.idVGB_ADDR==VSL_ORHE_BTADD" >
	        			<span class="text-primary">Bill to&nbsp;&nbsp; : </span>
	        			{{adrs.VGB_ADDR_ADDID}} - {{adrs.VGB_ADDR_DESCR}} 
	        		</span>
	        	</span>
	        	
        	</td>

        </tr>
        <tr 	ng-repeat="add in vgb_addr | AB_Selected:VGB_CUST_BPART:'VGB_ADDR_BPART' | AB_noDoubles:'VGB_ADDR_BPART'" 
        	ng-if="add.isSelected==''"
        >
        	<td >
        		
	        	
	        	<span ng-repeat="adrs in add.rowSet" >
		        	<span ng-if="adrs.idVGB_ADDR==VSL_ORHE_STADD">
	        			<span class="text-primary">Ship to : </span>
	        			{{adrs.VGB_ADDR_ADDID}} - {{adrs.VGB_ADDR_DESCR}} 
	        		
	        		</span>
	        	</span>
        	</td>

        </tr>
        </table>
        
      </div>
      <div class="modal-body">
        <table>
        <tr 	ng-repeat="add in vgb_addr | AB_Selected:VGB_CUST_BPART:'VGB_ADDR_BPART' | AB_noDoubles:'VGB_ADDR_BPART'" 
        	ng-if="add.isSelected==''" 
        >
        	<td>
        		<table class="table-striped" >
        			<tr>
        				<td class="text-primary">Bill To&nbsp;&nbsp;</td>
        				<td class="text-primary">Ship To&nbsp;&nbsp;</td>
        				<td class="text-primary">Add Id&nbsp;&nbsp;</td>
        				<td class="text-primary">Description</td>
        				
        			</tr>
        		
	        		<tr ng-repeat="ad in add.rowSet" >	
	        		
	        			<td>
	        				<input type="radio" checked name="btcust" ng-if="ad.idVGB_ADDR==VSL_ORHE_BTADD" />
	        				<input type="radio" rval='{{ad.idVGB_ADDR}}' onclick="deflectVal($(this).attr('rval'),'VSL_ORHE_BTADD');" onKlick="$('#new_BTADD').val($(this).attr('rval'));" name="btcust" ng-if="ad.idVGB_ADDR!=VSL_ORHE_BTADD" />
	        			</td>
	        			
	        			<td>
	        				<input type="radio" checked name="stcust" ng-if="ad.idVGB_ADDR==VSL_ORHE_STADD" />
	        				<input type="radio" rval='{{ad.idVGB_ADDR}}' onclick="deflectVal($(this).attr('rval'),'VSL_ORHE_STADD');" onKlick="$('#new_STADD').val($(this).attr('rval'));" name="stcust" ng-if="ad.idVGB_ADDR!=VSL_ORHE_STADD" />

	        			</td>
	        			
	        			
		        		<td>
		        			{{ad.VGB_ADDR_ADDID}} 
		        		</td>
		        		<td>
		        			{{ad.VGB_ADDR_DESCR}} 
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
EOB;


	$keepOrg = 1; 
	$repeatIn = "vgb_addr | AB_Selected:VGB_CUST_BPART:'VGB_ADDR_BPART' | AB_noDoubles:'idVGB_ADDR'";
	$searchIn = "";
	$refName = "VSL_ORHE_STADD"; // unique
	$refModel = "VSL_ORHE_STADD"; // unique
	$repeatInRef = "idVGB_ADDR"; //Unique
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.isSelected}}---{{VGB_CUST_BPART}}={{ab_rloop.VGB_ADDR_BPART}}","{{ab_rloop.VGB_ADDR_ADDID}}","{{ab_rloop.VGB_ADDR_DESCR}}"));
	//$hardCode = '<span ab-menu="vgb_addr" name="mainForm"  class="ab-pointer btn-primary text-primary" ng-click="supportTBL()">&nbsp;';
	//$hardCode .= '<span class="glyphicon glyphicon-pencil"></span>&nbsp;';
	//$hardCode .= '</span>';
	$searchRefDesc = "";
	$refDetail = $hardCode . implode("<br>",array("{{ab_rloop.VGB_ADDR_ADNAM}}","{{ab_rloop.VGB_ADDR_ADD01}}, {{ab_rloop.VGB_ADDR_ADD02}}","{{ab_rloop.VGB_ADDR_CITYN}}, {{ab_rloop.VGB_ADDR_POSTC}}","{{ab_rloop.VGB_ADDR_CONT1}} - {{ab_rloop.VGB_ADDR_TEL01}}"));
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "VGB_ADDR_BPART=VSL_ORHE_BTCUS;idVGB_ADDR='';ABlstAlias('VGB_ADDR_BPART','VGB_ADDR_BPART','vgb_addr',0);".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$hardCode = "<table  class='small'><tr><td ab-label='STD_SHIP_TO' class='small text-primary' style='white-space:nowrap;width:45px;max-width:50px;font-size:small;' >Ship To:</td><td>:</td><td>" . $hardCode . "</td></tr></table>"; 	
	$laAttr['class'] .= " hidden ";

	// $harderCode = "<table  class='small'><tr><td ab-label='STD_SHIP_TO' class='small text-primary' style='white-space:nowrap;width:45px;max-width:50px;font-size:small;' >Ship To:</td><td>:</td><td>" . $harderCode. "</td></tr></table>"; 	

	// $xtmp->setFieldWrapper("view01","2.060","vsl_orhe","VSL_ORHE_STADD","",$grAttr,$laAttr,$inAttr,$harderCode);
	// echo $xtmp->currHtml;
	echo $harderCode;
echo '</div><div class="col-sm-6 text-left">';	
	//2,080	 	VSL_ORHE_CUSPO
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_CUSPO";
	$inAttr = $xtmp->inAttrib;
	$inAttr["size"] = "20";
	$xtmp->setFieldWrapper("view01","2.080","vsl_orhe","VSL_ORHE_CUSPO","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
echo '</div><div class="col-sm-6 text-left">';		
	//2,120	 	VSL_ORHE_ORFOB
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_ORFOB";
	$inAttr = $xtmp->inAttrib;
	$inAttr["size"] = "10";
	$xtmp->setFieldWrapper("view01","2.120","vsl_orhe","VSL_ORHE_ORFOB","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
echo '</div><div class="col-sm-6 text-left">';		

	//2,130	 	VSL_ORHE_ORVIA
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_ORVIA";
	$inAttr = $xtmp->inAttrib;
	$inAttr["size"] = "10";
	$xtmp->setFieldWrapper("view01","2.130","vsl_orhe","VSL_ORHE_ORVIA","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;		
echo '</div><div class="col-sm-6 text-left">';	
	// Spacer
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$grAttr['class'] += " invisible ";
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.105","vsl_orhe","","",$grAttr,$laAttr,$inAttr," ");
	echo $xtmp->currHtml;
echo '</div><div class="col-sm-6 text-left">';

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
	$ignTrig = 'ng-click="' . "hold=VGB_CURR_CURID;VGB_CURR_CURID=' ';VGB_CURR_CURID_F='';ABlstAlias('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0);VGB_CURR_CURID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$xtmp->setFieldWrapper("view01","2.070","vsl_orhe","VSL_ORHE_CURID","",$grAttr,$laAttr,$inAttr,$hardCode);
  	echo $xtmp->currHtml;

	echo '</div><div class="col-sm-6 text-left">';

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
echo '</div><div class="col-sm-6 text-left">';
	
	//2,085	 	VSL_ORHE_PRLEV
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_PRIORITY";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.085","vsl_orhe","VSL_ORHE_PRLEV","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;
echo '</div><div class="col-sm-6 text-left">';	
	//2,105	 	VSL_ORHE_CFCAT
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VIN_ITEM_CFCAT";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setYesNoField("VSL_ORHE_CFCAT");
	$xtmp->setFieldWrapper("view01","2.105","vsl_orhe","VSL_ORHE_CFCAT","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
echo '</div><div class="col-sm-6 text-left">';		

	//2,110	 	VSL_ORHE_BAORA
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VGB_CUST_BAORA";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setYesNoField("VSL_ORHE_BAORA");
	$xtmp->setFieldWrapper("view01","2.110","vsl_orhe","VSL_ORHE_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
echo '</div><div class="col-sm-6 text-left">';		

	//2,115	 	VSL_ORHE_CRHOL
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VGB_CUST_CRHOL";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setYesNoField("VSL_ORHE_CRHOL");
	$xtmp->setFieldWrapper("view01","2.115","vsl_orhe","VSL_ORHE_CRHOL","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
echo '</div><div class="col-sm-6 text-left">';		
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
echo '</div><div class="col-sm-6 text-left">';		

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

	</div>

    </div>
    
    <div class="col-sm-8">
    
			<div class="row">
				<div class="col-sm-12 center-block">
					  		<div title="" ng-init="collaps=0" style="padding-left:100px;" >
					  			<span  onclick="$('#bcollaps').click();collapseall(0);" class="btn-link ab-pointer" title="">
					  				<span class="glyphicon glyphicon-zoom-out " title=""></span>
					  			</span>
								<span onclick="$('#bcollapsIn').click();collapseall(1);" class="btn-lg btn-link ab-pointer" title="">
									<span class="glyphicon glyphicon-zoom-in " title="">
									</span>
								</span>
								<input class="hidden" id="bcollaps" ng-model="collaps" ng-click="collaps = 0;" size=2 />
								<input class="hidden" id="bcollapsIn" ng-model="collaps" ng-click="collaps = 1;" size=2 />
							</div>				
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-sm-11">
				  	<table style="width:96%;" class=" {{opts.updType!='CREATE'?'':'hidden'}}">

					<tr >
						<td class=" ab-spaceless" style="vertical-align:top;" >
							
								<span class="btn-link ab-pointer" ng-click="insertInDetail();" >
									<span>Insert</span>
									<span  class="glyphicon glyphicon-pencil" ></span>
								</span>			
							
	
						</td>
							


<?php


$headTd = '<td style="vertical-align:bottom;padding-left:4px;" >';
						
echo $headTd;
$xtmp->laAttrib["class"] .= ""; 
$xtmp->laAttrib["class"] .= " small ";
$xtmp->grAttrib["class"] = "ab-spaceless";
$xtmp->grAttrib["style"] = "overflow:hidden;max-height:15px;";

$xtmp->inAttrib["class"] = "invisible";
//VSL_ORDE_ORLIN
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "STD_ORLIN_SH";
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "7";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","xxVSL_ORDE_ORLIN","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo $headTd;


$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "15";
$laAttr["ab-label"] = "VIN_ITEM_ITMID";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","xxVSL_ORDE_ITMID","",$grAttr,$laAttr,$inAttr,'');
echo $xtmp->currHtml;
echo '</td>';

echo $headTd;
// VSL_ORDE_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "15";
$laAttr["ab-label"] = "STD_DESCR";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","xxVSL_ORDE_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td style="vertical-align:bottom;min-width:100px;" >';
// VSL_ORDE_ODATE

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "10";
$laAttr["ab-label"] = "VSL_ORHE_ODATE";
$hardCode = "<div  class='invisible'>" . $xtmp->setDatePick("xxVSL_ORDE_ODATE"). "</div>";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","xxVSL_ORDE_ODATE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</td>';

echo '<td style="vertical-align:bottom;min-width:100px;" >';

// VSL_ORDE_DDATE



$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "10";
$laAttr["ab-label"] = "VSL_ORHE_DDATE_10";
$hardCode = "<div class='invisible'>" . $xtmp->setDatePick("xxVSL_ORDE_DDATE"). "</div>";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","xxVSL_ORDE_DDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</td>';

echo $headTd;// VSL_ORDE_ORDQT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["readonly"] = '';
$inAttr["size"] = "4";
$laAttr["ab-label"] = "STD_QUANTITY_SHORT";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","xxVSL_ORDE_ORDQT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';


echo $headTd;// VSL_ORDE_OUNET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
// $laAttr["class"] = "hidden";
$inAttr["size"] = "4";
$laAttr["ab-label"] = "STD_PRICE";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","xxVSL_ORDE_OUNET","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo $headTd;// VSL_ORDE_SAUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "4";


// VIN_ITEM_LPUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "5";
$laAttr["ab-label"] = "STD_UOM_SHORT";

//	x.VIN_ITEM_UNSET

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","xxVSL_ORDE_SAUOM","",$grAttr,$laAttr,$inAttr,"");



// $xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_SAUOM","",$grAttr,$laAttr,$inAttr,"");






echo $xtmp->currHtml;
echo '</td>';


?>
						
  			
						
						</tr>	
					</table>
				</div>
				<div class="col-sm-1"></div>
			</div>		
			
			<div class="row ">
			
				<div class="col-sm-11">
				 <div class="mygrid-wrapper-div"  style="margin:0px;padding:0px;">
				  	<table   style="width:100%;" class=" table {{opts.updType!='CREATE'?'':'hidden'}}">
				

		  						<tr ab-formlist="order_list"   ab-rowset="{{$index}}"   ab-new="{{ x.idVSL_ORDE < 1?'1':'0' }}"
		  						ORDE-repeat="1"
		  						role="presentation" ng-repeat="x in vsl_orhe | AB_noDoubles:'idVSL_ORDE' " 
		  						
		  						ng-if="x.idVSL_ORDE != 0"
		  						ceelass="{{x.VSL_ORDE_ORLIN > 0?'':'hidden'}}"
		  						 >
								<td colspan=100 class="ab-spaceless">
								<div style="padding-top:4px;">
								
									<form ab-view="vsl_orde" ab-main="vsl_orde" ab-context="0" >
									<table class=" {{x.trash==1?'text-danger':''}}" style="width:100%;" >
									<tr>
										<td class="small  {{x.trash==1?'text-danger':'text-primary'}}" >
											<input type="checkbox" value="0" onclick="$(this).val(1-$(this).val());" ng-model="x.trash" class="text-primary" />
											<span  class="glyphicon glyphicon-trash " ></span>
											&nbsp;&nbsp;
											<span style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{x.idVSL_ORDE}}" class="btn-link glyphicon glyphicon-th-list small"></span>
											&nbsp;
										</td>

		  							<td >
<strong>
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

$xtmp = new appForm("VSL_ORDERS");
$xtmp->laAttrib["class"] .= " hidden "; 
$xtmp->laAttrib["class"] .= " small ";
$xtmp->grAttrib["class"] = "ab-spaceless";
$xtmp->grAttrib["style"] = "";
//VSL_ORDE_ORLIN
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "STD_ORLIN_SH";


$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "3";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ORLIN","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</strong></td>';

echo '<td><strong>';

$itemDsp = <<<EOH

<input class="hidden" id="VIN_ITEMsearch{{x.VSL_ORDE_ORLIN}}"
ng-click="
x.VIN_ITEM_ITMID = abSessionResponse.VIN_ITEM_ITMID;
x.VSL_ORDE_ITMID = abSessionResponse.idVIN_ITEM;
x.VSL_ORDE_DESCR = abSessionResponse.VIN_ITEM_DESC1;
x.VSL_ORDE_ITEXT = abSessionResponse.VIN_ITEM_DESC2 + ' ' + abSessionResponse.VIN_ITEM_DESC3;
x.VSL_ORDE_OUNET = abSessionResponse.VIN_ITEM_LISTP;
x.VSL_ORDE_SAUOM = abSessionResponse.VIN_ITEM_UNITM;
x.VSL_ORDE_QTUOM = abSessionResponse.VIN_ITEM_UNITM;
x.VSL_ORDE_LISTP = abSessionResponse.VIN_ITEM_LISTP;
" />


<span class="small" >
	<a class="ab-pointer" ng-click="ABsessionLink('#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item','#VIN_ITEMsearch'+ x.VSL_ORDE_ORLIN);" >
		<span class="glyphicon glyphicon-search" ></span>
	</a>	
</span>
&nbsp;
	
EOH;

//	$laAttr["ab-label"] = "STD_DESCR";
//	$laAttr["ab-label"] = "VSL_ORHE_ODATE";
//	$laAttr["ab-label"] = "VSL_ORHE_DDATE_10";
//	$laAttr["ab-label"] = "STD_QUANTITY_SHORT";
//	$laAttr["ab-label"] = "STD_PRICE";
//	$laAttr["ab-label"] = "STD_UOM_SHORT";

// VSL_ORDE_ITMID


$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "10";
$inAttr["class"] = "hidden";
$laAttr["ab-label"] = "VIN_ITEM_ITMID";
$laAttr["class"] .= " {{"."$"."index>0?'hidden':''}} "; 
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ITMID","",$grAttr,$laAttr,$inAttr,'');
echo "<table ><td colspan='2' >".$xtmp->currHtml."</td></tr>";

echo "<tr><td>".$itemDsp."</td><td><input class='ab-borderless' readonly size=12 value='{{ x.VIN_ITEM_ITMID }}' /></td></tr></table>";
// echo $xtmp->currHtml;
echo '</strong></td>';

echo '<td><strong>';
// VSL_ORDE_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "15";
$laAttr["ab-label"] = "STD_DESCR";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</strong></td>';

echo '<td style="width:120px;"><strong>';
// VSL_ORDE_ODATE

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "6";
$laAttr["ab-label"] = "VSL_ORHE_ODATE";
$hardCode = "<div style='font-size:90%;'>" . $xtmp->setDatePick("x.VSL_ORDE_ODATE"). "</div>";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ODATE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</strong></td>';

echo '<td style="width:120px;"><strong>';
// VSL_ORDE_DDATE



$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "6";
$laAttr["ab-label"] = "VSL_ORHE_DDATE_10";
$hardCode = "<div style='font-size:90%;'>" . $xtmp->setDatePick("x.VSL_ORDE_DDATE"). "</div>";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_DDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</strong></td>';

echo '<td><strong>';
// VSL_ORDE_ORDQT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["readonly"] = '';
$inAttr["size"] = "4";
$laAttr["ab-label"] = "STD_QUANTITY_SHORT";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ORDQT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</strong></td>';


echo '<td><strong>';
// VSL_ORDE_OUNET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
// $laAttr["class"] = "hidden";
$inAttr["size"] = "4";
$laAttr["ab-label"] = "STD_PRICE";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_OUNET","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</strong></td>';

echo '<td><strong>';
// VSL_ORDE_SAUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "4";


// VIN_ITEM_LPUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr["ab-label"] = "STD_UOM_SHORT";

	$keepOrg = 0; 
	$repeatIn = "vin_unit";
	$searchIn = "";
	$refName = "x.VSL_ORDE_SAUOM"; // unique
	$refModel = "x.VSL_ORDE_SAUOM"; // unique
	$repeatInRef = "idVIN_UNIT"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_UNIT_UNITM}}","{{ab_rloop.VIN_UNIT_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "VIN_UNIT_UNITM='A ';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$hardCode = '<div class="small" ><input class="hidden" size=2 ng-model="x.VSL_ORDE_SAUOM" /><select class="small" onchange="$(this).parent().find('."'input')".'.val($(this).val());">';
	$hardCode .= '<option class="small" ng-repeat="uom in vin_unit" value="{{'.'uom.idVIN_UNIT}}" ng-if="uom.idVIN_UNIT==x.VSL_ORDE_SAUOM"  >';
	$hardCode .= '{{' . 'uom.VIN_UNIT_UNITM}}';
	$hardCode .= '</option>';
	$hardCode .= '<option class="small" ng-repeat="uom in vin_unit"  value="{{'.'uom.idVIN_UNIT}}" ng-model="uom.idVIN_UNIT" ng-if="uom.idVIN_UNIT!=x.VSL_ORDE_SAUOM && uom.VIN_UNIT_UNSET==x.VIN_ITEM_UNSET"  >';
	$hardCode .= '{{' . 'uom.VIN_UNIT_UNITM}}';
	$hardCode .= '</option>';
	$hardCode .= '</select></div>';
	
//	x.VIN_ITEM_UNSET
	
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_SAUOM","",$grAttr,$laAttr,$inAttr,$hardCode);



// $xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_SAUOM","",$grAttr,$laAttr,$inAttr,"");






echo $xtmp->currHtml;
echo '</strong></td>';




// <span style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{x.idVSL_ORHE}}" class="btn-link glyphicon glyphicon-th-list"></span>
// echo '<div exp-list="1" id="exp_{{x.idVSL_ORHE}}" class="collapse {{' . "collaps!=1?'':'in'}}" . '">';


?>
						
  			


	</tr>
	<tr exp-list="1" id="exp_{{x.idVSL_ORDE}}" class="collapse {{collaps!=1?'':'in'}}" >
		<td colspan=100 class="ab-spaceless" style="padding-top:4px;" >
			<!- ab-label will updated with required label for ng-repeats -->
			<span class="hidden">
				<span ab-label="VGB_CUST_BAORA_SHO" ></span>
				<span ab-label="VIN_ITEM_PICKP" ></span>
				<span ab-label="VIN_ITEM_PACKP" ></span>
				
			
			</span>
		


			<table   class=" small {{x.trash==1?'text-danger':''}}" style="width:100%;vertical-align:top;" >
			<tr>
			<td style="width:20%;" ></td>
			<td style="width:25%;" ></td>
			<td style="width:55%;" ></td>
			</tr>

<?php 			
$xtmp = new appForm("VSL_ORHE");
$xtmp->grAttrib["class"] = "ab-spaceless medium";
$xtmp->grAttrib["style"] = "";

echo '<td style="vertical-align:top;" ><table><tr><td>';
// VSL_ORDE_BAORA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "VGB_CUST_BAORA_SHO";
$inAttr = $xtmp->inAttrib;
$inAttr["class"] = "hidden";
$xtmp->setFieldWrapper("view01","0.111","vsl_orde","VSL_ORDE_BAORA","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td class="boxwrapper" style="padding-left:10px;vertical-align:top;width:80px;">';
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

echo '<td class="boxwrapper" style="padding-left:10px;" >';
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

echo '<td class="boxwrapper" style="padding-left:10px;">';
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

$focus = ' onfocus="' . "$(this).attr('rows','4');$(this).attr('cols','30');$(this).css('width','');$(this).css('height','');$(this).css('overflow','auto');" . '" ';

$blur = ' onblur="' . "$(this).css('width','140px');$(this).css('height','20px');$(this).css('overflow','hidden');" . '" ';

$hardCode = '<table><tr>';
$hardCode .= '<td style="text-align:right;" ><label class="text-primary" ab-label="STD_TEXT" >Text:</label> &nbsp;&nbsp;<textarea style="overflow:hidden;font-size:9pt;" rows="1" cols="18" ' . $focus . $blur . ' ng-model="x.VSL_ORDE_ITEXT"  > </textarea></td><td>&nbsp;&nbsp;&nbsp;</td>';
$hardCode .= '</tr><tr>';
$hardCode .= '<td style="text-align:right;" ><label class="text-primary small" ab-label="STD_INSTRUCTIONS" >Instruc.</label>:<textarea style="overflow:hidden;font-size:9pt;" rows="1" cols="18" ' .  $focus . $blur  . '" ng-model="x.VSL_ORDE_OTEXT"  > </textarea></td>';
$hardCode .= '</tr></table>';
$xtmp->setFieldWrapper("view01","0.122","vsl_orde","x.VSL_ORDE_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</td>';

$stepCode = <<<EOC

<td rowspan=100 class="ab-spaceless   " style="vertical-align:top;">

	<table class=" ab-spaceless" style="width:100%;vertical-align:top;">
		<tr class="bg-primary small" >
		
			<td class="ab-spaceless" style="vertical-align:top;padding-left:2px;width:60px;">
										
								<span class="ab-pointer" ng-click="insertInStep(x.VSL_ORDE_ORLIN);" onklick="stepInsert(this);" >
									<span class="small" >Insert</span>
									<span  class="glyphicon glyphicon-pencil small" ></span>
								</span>			
			</td>
			<td style="font-weight:700;width:80px;">
				<span ab-label="VSL_ORST_STPSQxxx">				
					Seq.
				</span>
			</td>
			<td style="font-weight:700;width:120px;" ab-label="VSL_ORST_PDATE">Plan Date</td> 
			<td style="font-weight:700;width:80px;" ab-label="STD_QUANTITY_SHORT">Quantity</td>
			<td style="font-weight:700;"><span ab-label="VSL_ORST_STEPS">Seq. Steps&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			
			
			</td>
		
		
		</tr>
		
		<tr  ab-formlist="orstep_list"  
			ab-new="{{ x.idVSL_ORDE < 1 || idVSL_ORST < 1?'1':'0' }}"
			ordline="{{x.VSL_ORDE_ORLIN}}" 
			ng-repeat="y in vsl_orhe   | AB_noDoubles:'idVSL_ORDE,idVSL_ORST'  "
			 cqwelass="{{x.VSL_ORDE_ORLIN==y.VSL_ORDE_ORLIN?'':'hidden'}}"
			ng-if="x.idVSL_ORDE==y.idVSL_ORDE"
			
		>
		
		
<td colspan=100 class="ab-spaceless {{wid==1?'text-danger':''}}">




<div class="ab-spaceless">
<table  class=" ab-spaceless  {{wid==1?'text-danger':''}}" style="width:100%">
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
$inAttr["size"] = "21";
$inAttr["class"] = " {{". "y.idVSL_ORST>0?'':'invisible'}} ";

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

</table>			
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
<div class="col-sm-1"></div>
</div>

    
    
    <!--
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default text-left">
            <div class="panel-body">
              <p contenteditable="true">Status: Feeling Blue</p>
              <button type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-thumbs-up"></span> Like
              </button>     
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>John</p>
           <img src="bird.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>Bo</p>
           <img src="bandmember.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>Jane</p>
           <img src="bandmember.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>Anja</p>
           <img src="bird.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
          </div>
        </div>
      </div> 
      -->    
    </div>
        </div>
  </div>
</div>


<footer class="container-fluid text-left">
  <p>Footer Text</p>
</footer>

