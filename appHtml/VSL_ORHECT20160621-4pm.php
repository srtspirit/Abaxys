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
		$scope.DOC_ORST = "";
		$scope.initAllocDashBoard();
		$scope.selectCurrentForm();

		$scope.initOrder();
		

		
	}


}

</textarea>

</div>
<div class="hidden" ng-init="SESSION_DESCR='Sales Order Control'">
	<span ab-label="VSL_ORHECT"></span>
</div>
<div id="ab-new" class="hidden" ng-init="tdDates = ABGetDateFn('','');" >

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
			<div class="col-sm-12  ac">

				<input  class="hidden" ab-btrigger="vsl_orhe" ng-model="idVSL_ORHE" /> 
				<input  class="hidden" ng-init="VIN_UNIT_UNITM = ' ';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);" ng-model="VIN_UNIT_UNITM" />
				<input  class="hidden" ng-init="VGB_CURR_CURID = ' ';ABlstAlias('VGB_CURR_CURID','VGB_CURR_CURID','vin_curr',0);" ng-model="VGB_CURR_CURID" />
				<input  class="hidden ab-flipped" ab-bind="VSL_ORHE_ORSTP" ng-model="VSL_ORHE_ORSTP" />
				
				
<?php

	// 1,040" VSL_ORHE_ORNUM 
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_ORNUM";
	$inAttr = $xtmp->inAttrib;
	$inAttr["class"] = "hidden";
	
	$xtmp->setFieldWrapper("view01","1.040","vsl_orhe","VSL_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,"");
	$hardC0 = $xtmp->currHtml;	

	// 1,040" VSL_ORHE_ORNUM 
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_ORNUM";
	$laAttr["class"] = "hidden";
	$inAttr = $xtmp->inAttrib;
	$inAttr["size"] = "10";
	$inAttr["class"] .= " text-center text-primary";
	$inAttr["disabled"] = "disabled";
	$xtmp->setFieldWrapper("view01","1.040","vsl_orhe","VSL_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,"");
	$hardC1 = $xtmp->currHtml;	
	
	echo "<table><tr><td>" . $hardC0 . "</td><td>" .  $hardC1 . "</td></tr></table>";

	echo '<div class="col-sm-2  ac">';

	//2,090	 	VSL_ORHE_ODATE
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_ODATE";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setDatePick("VSL_ORHE_ODATE");
	$xtmp->setFieldWrapper("view01","2.090","vsl_orhe","VSL_ORHE_ODATE","",$grAttr,$laAttr,$inAttr,$hardCode);
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
<input class="hidden" id="VGB_CUSTsearch" ng-click="initNewCustomer();" />
<a class="ab-pointer" 
ng-click="ABsessionLink('#/VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_cust,SourceProcess:VSL_ORDERS','#VGB_CUSTsearch');" >

<span class="glyphicon glyphicon-search" ></span>
</a>
</span>
<input class="hidden" ng-model="VSL_ORHE_BTCUS" />
	
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

//	$grAttr = $xtmp->grAttrib;
//	$grAttr["class"] = "hidden";
//	$laAttr = $xtmp->laAttrib;
//	$laAttr["class"] = "hidden";
//	$inAttr = $xtmp->inAttrib;
//	$inAttr["class"] = "hidden";
//	$xtmp->setFieldWrapper("view01","2.030","VSL_ORHE_BTCUS","VSL_ORHE_BTCUS","",$grAttr,$laAttr,$inAttr,"");
//	echo $xtmp->currHtml;	
		
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

        <table  >
        <tr>
        	<td rowspan=100 style="text-align:middle;vertical-align:top;">
        	<input class="hidden" ng-model="VSL_ORHE_BTADD" />
        	<input class="hidden" ng-model="VSL_ORHE_STADD" />
        	
        	<span class="btn btn-link glyphicon glyphicon-search ab-spaceless" data-toggle="modal" data-target="#myModal11" ng-click="initAddress();" ></span>
        	<span>&nbsp;</span>
        	</td>
        </tr>
         <tr 	ng-repeat="add in vgb_addr  | AB_noDoubles:'VGB_ADDR_BPART'" 
        	n2g-if="add.isSelected==''| AB_Selected:VGB_CUST_BPART:'VGB_ADDR_BPART'"
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
         <tr 	ng-repeat="add in vgb_addr | AB_noDoubles:'VGB_ADDR_BPART'" 
        	n2g-if="add.isSelected=='' | AB_Selected:VGB_CUST_BPART:'VGB_ADDR_BPART'"
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
        <tr 	ng-repeat="add in vgb_addr | AB_noDoubles:'VGB_ADDR_BPART'" 
        	n2g-if="add.isSelected==''| AB_Selected:VGB_CUST_BPART:'VGB_ADDR_BPART' "
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
        <tr 	ng-repeat="add in vgb_addr  | AB_noDoubles:'VGB_ADDR_BPART'" 
        	n2g-if="add.isSelected==''| AB_Selected:VGB_CUST_BPART:'VGB_ADDR_BPART'"
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
        <table  style="width:100%;">
        <tr 	ng-repeat="add in vgb_addr | AB_Selected:VGB_CUST_BPART:'VGB_ADDR_BPART' | AB_noDoubles:'VGB_ADDR_BPART'" 
        	ng-if="add.isSelected==''" 
        >
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
        		
	        		<tr ng-repeat="ad in add.rowSet"  >	
	        		
	        			<td >
	        				<input type="radio" checked name="btcust" ng-if="ad.idVGB_ADDR==VSL_ORHE_BTADD" />
	        				<input type="radio" rval='{{ad.idVGB_ADDR}}' onclick="deflectVal($(this).attr('rval'),'VSL_ORHE_BTADD');" onKlick="$('#new_BTADD').val($(this).attr('rval'));" name="btcust" ng-if="ad.idVGB_ADDR!=VSL_ORHE_BTADD" />
	        				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        				<input type="radio" checked name="stcust" ng-if="ad.idVGB_ADDR==VSL_ORHE_STADD" />
	        				<input type="radio" rval='{{ad.idVGB_ADDR}}' onclick="deflectVal($(this).attr('rval'),'VSL_ORHE_STADD');" onKlick="$('#new_STADD').val($(this).attr('rval'));" name="stcust" ng-if="ad.idVGB_ADDR!=VSL_ORHE_STADD" />

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
	
	//2,080	 	VSL_ORHE_CUSPO
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "VSL_ORHE_CUSPO";
	$inAttr = $xtmp->inAttrib;
	$inAttr["size"] = "20";
	$xtmp->setFieldWrapper("view01","2.080","vsl_orhe","VSL_ORHE_CUSPO","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;

echo '</div><div class="col-sm-2  ac-tog ">';

	// Spacer
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$grAttr['class'] += " invisible ";
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.105","vsl_orhe","","",$grAttr,$laAttr,$inAttr,"<br>");
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
	$ignTrig = 'ng-click="' . "hold=VGB_CURR_CURID;VGB_CURR_CURID=' ';VGB_CURR_CURID_F='';ABlstAlias('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0);VGB_CURR_CURID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	$xtmp->setFieldWrapper("view01","2.070","vsl_orhe","VSL_ORHE_CURID","",$grAttr,$laAttr,$inAttr,$hardCode);
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
		


	echo '</div><div class="col-sm-2  ac-tog ">';


	// Spacer
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$grAttr['class'] += " invisible ";
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.105","vsl_orhe","","",$grAttr,$laAttr,$inAttr,"<br>");
	echo $xtmp->currHtml;
	
	//2,085	 	VSL_ORHE_PRLEV
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_PRIORITY";
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.085","vsl_orhe","VSL_ORHE_PRLEV","",$grAttr,$laAttr,$inAttr,"");
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


echo '</div><div class="col-sm-2  ac-tog ">';
	
	// Spacer
	$xtmp = new appForm("VSL_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$grAttr['class'] += " invisible ";
	$laAttr = $xtmp->laAttrib;
	$inAttr = $xtmp->inAttrib;
	$xtmp->setFieldWrapper("view01","2.105","vsl_orhe","","",$grAttr,$laAttr,$inAttr,"<br>");
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
		

echo '<div>';

require_once "../appHtml/VIN_ITEMS.model.php";

echo '</div>';


?>

<input type="hidden" id="VIEW_ITEMS" ng-click="FLT_ITEM_ITMID=VIN_ITEM_ITMID;VIN_ITEM_ITMID=' ';ABlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,FLT_ITEM_LOTCT,FLT_ITEM_ITMID','vin_item');VIN_ITEM_ITMID=FLT_ITEM_ITMID;" />
<input class="hidden" onclick='$("input").removeAttr("ab-search-target");$(this).attr("ab-search-target","on");$("#VIEW_ITEMS").click();$("#ab-sessionBoardVIN_ITEMS").click();' value="Click" />			
<input class="hidden" ng-mo5del="idVIN_ITEM" />


		</div>
</form>

		<div class="col-sm-10 ">
			<div class="row">
				<div class="col-sm-6 center-block">
					  		<div title="" class="{{ opts.updType!='CREATE'?'':'hidden' }}" ng-init="collaps=1" style="padding-left:100px;" >
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
				<div class="col-sm-6 text-primary ab-pointer" ng-click="orderQuery();" data-toggle="modal" data-target="#ORHE_ALLOC" ng-init="vin_inveQuery=''" >
					Order Dashboard:
					<span 	
						class="btn btn-link glyphicon glyphicon-search ab-spaceless" 
						  title="">
					</span>	
					<input class="hidden" ng-model="vin_inveQuery"  />
					<input class="hidden" ab-mpp="limit" value="0" />			
					
					<input class="hidden" ng-click="idVIN_ITEM=VSL_ORDE_ITMID;ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_inveQuery','vin_inveQuery','vin_inve');" />
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-sm-12">
				  	<table style="width:96%;" class=" {{opts.updType!='CREATE'?'':'hidden'}}">

					<tr  >
						<td  class=" ab-spaceless" style="vertical-align:top;" >
							
								<span class="btn-link ab-pointer" ng-click="insertInDetail();" ">
									<span>Insert</span>
									<span  class="glyphicon glyphicon-pencil" ></span>
								</span>			
							
	
						</td>


<?php


$headTd = '<td class="bg-primary" style="vertical-align:bottom;padding-left:4px;" >';
						
echo $headTd;
$xtmp->laAttrib["class"] = ""; 
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
$inAttr["size"] = "22";
$laAttr["ab-label"] = "STD_DESCR";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","xxVSL_ORDE_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';


// Removed Odate to replace with On hand - allo and PO
//		echo $headTd;
//		// echo '<td style="vertical-align:bottom;min-width:100px;" >';
//		// VSL_ORDE_ODATE
//		
//		$grAttr = $xtmp->grAttrib;
//		$laAttr = $xtmp->laAttrib;
//		$inAttr = $xtmp->inAttrib;
//		$inAttr["size"] = "10";
//		$laAttr["ab-label"] = "VSL_ORHE_ODATE";
//		$hardCode = "<div  class='invisible'>" . $xtmp->setDatePick("xxVSL_ORDE_ODATE"). "</div>";
//		$xtmp->setFieldWrapper("view01","0.0","vsl_orde","xxVSL_ORDE_ODATE","",$grAttr,$laAttr,$inAttr,$hardCode);
//		echo $xtmp->currHtml;
//		echo '</td>';




echo $headTd;
// echo '<td style="vertical-align:bottom;min-width:100px;" >';
// VSL_ORDE_DDATE

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "15";
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



// $hardCode = '<span ><label class="text-primary small" ab-label="STD_QUANTITY_SHORT" ></label></span>';
// $hardCode .= '<span id="inveRefr" class="btn glyphicon glyphicon-refresh text-primary " style="font-size:8pt;" ng-click="initAddress();inveRefresh();"></span></span>';
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","xxVSL_ORDE_ORDQT","",$grAttr,$laAttr,$inAttr,"");
echo $headTd;
echo '<table><tr><td><span id="inveRefr" title="refresh" class="glyphicon glyphicon-refresh ab-pointer" style="font-size:8pt;" ng-click="inveRefresh();initAddress();orderQuery();"></span>&nbsp;</td><td>';
// echo '<td style="vertical-align:bottom;" >';
echo $xtmp->currHtml;
echo '</td></tr></table></td>';



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
			</div>		
			<div class="mygrid-wrapper-div"  style="margin:0px;padding:0px;">
			<div class="row">
				<div class="col-sm-12">
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
									<table  class=" {{x.trash==1?'text-danger':''}}" style="width:100%;" >
									
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

<input class="hidden" id="VIN_ITEMsearch{{x.VSL_ORDE_ORLIN}}" ng-if="x.idVSL_ORDE < 1"
ng-click="

x.VIN_ITEM_ITMID = abSessionResponse.VIN_ITEM_ITMID;
x.VSL_ORDE_ITMID = abSessionResponse.idVIN_ITEM;
x.VSL_ORDE_DESCR = abSessionResponse.VIN_ITEM_DESC1;
x.VSL_ORDE_ITEXT = abSessionResponse.VIN_ITEM_DESC2 + ' ' + abSessionResponse.VIN_ITEM_DESC3;
x.VSL_ORDE_OUNET = abSessionResponse.VIN_ITEM_LISTP;
x.VSL_ORDE_SAUOM = abSessionResponse.VIN_ITEM_UNITM;
x.VSL_ORDE_QTUOM = abSessionResponse.VIN_ITEM_UNITM;
x.VSL_ORDE_LISTP = abSessionResponse.VIN_ITEM_LISTP;

x.VSL_ORDE_WARID = abSessionResponse.VIN_ITEM_WARID;
x.VSL_ORDE_LOTCT = abSessionResponse.VIN_ITEM_LOTCT;


VIN_INVE_ITMID = x.VIN_ITEM_ITMID;

$('#inveRefr').click();

" />


<span class="small" >
	<a class="ab-pointer" vin_items="" ng-click="ABsessionLink('#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item,SourceProcess:VSL_ORDERS','#VIN_ITEMsearch'+ x.VSL_ORDE_ORLIN);" >
	
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
$inAttr["size"] = "22";
$laAttr["ab-label"] = "STD_DESCR";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</strong>';
?>

	
	<div ng-repeat="invQ in vin_inve | AB_noDoubles:'idVIN_INVE'  " ng-if="vin_inve.length>0 && invQ.VIN_INVE_ITMID == x.VSL_ORDE_ITMID" >

		<span class="small">
		<label>
			<table>
			<tr>
				<td class="small">
					<span class="text-primary"><em>On&nbsp;hand:</em></span>
				</td>
				<td style="min-width:35px;" >
		
				
				&nbsp;{{ invQ.VIN_INVE_BOHQT.length>0?invQ.VIN_INVE_BOHQT:'0' }}&nbsp;
		
				</td>
				<td class="small">
					<span class="text-primary"><em>Allocated:</em></span>
				</td>
				<td>
					&nbsp;{{invQ.VIN_INVE_ALOQT>0?invQ.VIN_INVE_ALOQT:'0'}}&nbsp;
				</td>
				<td class="small">
					&nbsp;&nbsp;<span class="text-primary"><em>On&nbsp;PO:</em></span>
				</td>
				<td >
					&nbsp;{{invQ.VIN_INVE_PURQT>0?invQ.VIN_INVE_PURQT:'0'}}&nbsp;
				</td>
			</tr>
		
			</table>
		
		</label>
		</span>	
	</div>
</td>

<?php


// Removed ODATE
//		echo '<td style="width:120px;"><strong>';
//		// VSL_ORDE_ODATE
//		
//		$grAttr = $xtmp->grAttrib;
//		$laAttr = $xtmp->laAttrib;
//		$inAttr = $xtmp->inAttrib;
//		$inAttr["size"] = "6";
//		$laAttr["ab-label"] = "VSL_ORHE_ODATE";
//		$hardCode = "<div style='font-size:90%;'>" . $xtmp->setDatePick("x.VSL_ORDE_ODATE"). "</div>";
//		$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ODATE","",$grAttr,$laAttr,$inAttr,$hardCode);
//		echo $xtmp->currHtml;
//		echo '</strong></td>';

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
// $inAttr["readonly"] = '';
$inAttr["class"] .= " text-center text-primary";
$inAttr["disabled"] = "disabled";
$inAttr["size"] = "4";
$laAttr["ab-label"] = "STD_QUANTITY_SHORT";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ORDQT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</strong>';


echo '</td>';


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
		


			<table  class=" small {{x.trash==1?'text-danger':''}}" style="width:100%;vertical-align:top;" >
			<tr>
			<td style="width:15%;" ></td>
			<td style="width:22%;" ></td>
			<td style="width:63%;" ></td>
			
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
$grAttr["class"] .= " small ";
$inAttr = $xtmp->inAttrib;
$inAttr["class"] = "hidden";
$xtmp->setFieldWrapper("view01","0.111","vsl_orde","VSL_ORDE_BAORA","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td class="boxwrapper" style="padding-left:10px;vertical-align:top;">';
// VSL_ORDE_BAORA
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " small ";
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
$grAttr["class"] .= " small ";
$inAttr = $xtmp->inAttrib;
$inAttr["class"] = "hidden";
$xtmp->setFieldWrapper("view01","0.111","vsl_orde","VIN_ITEM_PICKP","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td class="boxwrapper" style="padding-left:10px;" >';
// VSL_ORDE_PICKP
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " small ";
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
$grAttr["class"] .= " small ";
$inAttr = $xtmp->inAttrib;
$inAttr["class"] = "hidden";
$xtmp->setFieldWrapper("view01","0.111","vsl_orde","VIN_ITEM_PACKP","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td class="boxwrapper" style="padding-left:10px;">';
// VSL_ORDE_PACKP
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " small ";
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$hardCode = $xtmp->setYesNoField("x.VSL_ORDE_PACKP");
$xtmp->setFieldWrapper("view01","0.122","vsl_orde","x.VSL_ORDE_PACKP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '<input class="hidden" ng-model="x.VIN_ITEM_LOTCT" />';
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
		
			<td class="ab-spaceless" style="vertical-align:top;padding-left:2px;width:10%;">
										
			<span class="ab-pointer" ng-click="insertInStep(x.VSL_ORDE_ORLIN);" onklick="stepInsert(this);" >
				<span class="small" >Insert</span>
				<span  class="glyphicon glyphicon-pencil small" ></span>
			</span>	
		      	<input class="hidden text-primary" ng-model="x.VSL_ORDE_LLINK"   title="Spec Link"  />{{x.VSL_ORDE_LLINK}}

										
			</td>
			<td style="font-weight:700;width:10%;">
				<span ab-label="VSL_ORST_STPSQxxx">				
					Seq.
				</span>
			</td>
			<td style="font-weight:700;width:20%;" ab-label="VSL_ORST_PDATE">Plan Date</td> 
			<td style="font-weight:700;width:15%;" ab-label="STD_QUANTITY_SHORT">Quantity</td>
			<td style="font-weight:700;width:15%;">
			<span ab-label="VSL_ORST_STEPS">Seq. Steps&nbsp;&nbsp;</span>
			</td>
			
			<td style="font-weight:700;width:30%;" class="text-right  " >&nbsp;
			 <span ng-if="x.VIN_ITEM_LOTCT > 0">
				Spec.:<input class="hidden" ng-model="search.idVIN_ITEM" ng-init="search.idVIN_ITEM=x.VSL_ORDE_ITMID" />	
			      <select class=" text-primary"  
			      ng-change="x.VSL_ORDE_LLINK=(x.specCurrent.length>0?x.specCurrent:'000');orderQuery();" 
			      ng-options="spc.idVIN_SSMA as spc.VIN_SSMA_SPEID for spc in specSheet[x.VSL_ORDE_ITMID] | AB_noDoubles:'idVIN_SSMA' | AB_Sorted:'VIN_SSMA_SPEID' | filter:search:true " 
			      ng-model="x.specCurrent"  >
			        <option  value="">None Selected</option>
			      </select>			
				<span ng-init="x.specCurrent=x.VSL_ORDE_LLINK" ></span>
			      
			</span>      
			</td>			
		</tr>
		
		<tr  ab-formlist="orstep_list"  
			ab-new="{{ x.idVSL_ORDE < 1 || idVSL_ORST < 1?'1':'0' }}"
			ordline="{{x.VSL_ORDE_ORLIN}}" 
			ng-repeat="y in vsl_orhe   | AB_noDoubles:'idVSL_ORDE,idVSL_ORST'  "
			 cqwelass="{{x.VSL_ORDE_ORLIN==y.VSL_ORDE_ORLIN?'':'hidden'}}"
			ng-if="x.idVSL_ORDE==y.idVSL_ORDE"
			
		>
		
		
<td colspan=100 class="ab-spaceless {{wid==1?'text-danger':''}} ">

<input class="hidden" ng-model="y.VSL_ORST_ACKID" />
<input class="hidden" ng-model="y.VSL_ORST_AOKID" />
<input class="hidden" ng-model="y.VSL_ORST_SCEID" />
<input class="hidden" ng-model="y.VSL_ORST_PICID" />
<input class="hidden" ng-model="y.VSL_ORST_RELID" />
<input class="hidden" ng-model="y.VSL_ORST_PAKID" />
<input class="hidden" ng-model="y.VSL_ORST_DELID" />
<input class="hidden" ng-model="y.VSL_ORST_WINVO" />
<input class="hidden" ng-model="y.VSL_ORST_ARCID" />




<div class="ab-spaceless">
<table class=" ab-spaceless  {{wid==1?'text-danger':''}}" style="width:100%">
<tr>


EOC;

// var debug = "\n--================-----\n" + $("#focusGrid").val();
// $("#focusGrid").val(showProps(dDta.dbUpd.out.RECSET[1],"s")+debug)

$stepCode .= <<<EOC
	<td style="width:10%;">
		<input type="checkbox" value="0" onclick="$(this).val(1-$(this).val());" ng-model="y.trash" class="text-primary" />
		<span  class="glyphicon glyphicon-trash small" ></span>
		&nbsp;&nbsp;&nbsp;
	</td>
EOC;

// VSL_ORST_STPSQ
$stepCode .= '<td style="width:10%;">';

		
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
$stepCode .= '<td style="width:20%;">';
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
$stepCode .= '<td style="width:15%;">';
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$inAttr["title"] = "VSL_ORST_ORDQT.{{" . "y.idVSL_ORST" . "}}";


$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_ORDQT","",$grAttr,$laAttr,$inAttr,"");
$stepCode .= $xtmp->currHtml;
$stepCode .= '<input class="hidden" ng-model=" y.VSL_ORST_WARID" /><input class="hidden" ng-model="y.VSL_ORST_STEPS" /><input class="hidden" ng-model=" y.VSL_ORST_LOCID" /></td>';

// VSL_ORST_STEPS


$stepCode .= '<td style="width:15%;">';


//	<select class="ab-flipped" ab-bind="VSL_ORST_STEPS" ng-model="y.VSL_ORST_STEPS" >
//	<option value="">Select Step</option>
//	<option ab-label="LF_STEPS_DD_ACKN" value="DD_ACKN">To Quote</option>
//	<option ab-label="LF_STEPS_DE_AOKN" value="DE_AOKN">To Acknowledge quota</option>
//	<option ab-label="LF_STEPS_EE_SCED" value="EE_SCED">To Reserve</option>
//	<option ab-label="LF_STEPS_FF_PICK" value="FF_PICK">(pick-up)</option>
//	<option ab-label="LF_STEPS_GG_RELE" value="GG_RELE">To Release</option>
//	<option ab-label="LF_STEPS_HH_PACK" value="HH_PACK">To Pack</option>
//	<option ab-label="LF_STEPS_II_DELI" value="II_DELI">To Deliver</option>
//	<option ab-label="LF_STEPS_JJ_INVO" value="JJ_INVO">Submit to WIP</option>
//	<option ab-label="LF_STEPS_KK_PURG" value="KK_PURG">In Wip</option>
//	<option ab-label="LF_STEPS_QQ_PURG" value="QQ_PURG">Invoiced &amp; Completed</option>
//	</select>



$stepCode .= <<<EOC

  <ul class="nav nav-pills ab-spaceless" role="tablist" ng-if="y.idVSL_ORST>0">
    <li class="dropdown ab-spaceless">
      <a class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;width:150px;max-width:150px;padding:0px;">
	<span class="ca2ret"></span>
	<span  ng-repeat="step in VSL_STEP_LIST" ng-if="step.name==y.VSL_ORST_STEPS" >
		{{step.labeltext}}
	</span>
      	
      </a>
      <!--
      <ul class="dropdown-menu ab-spaceless" role="menu">
        <li ng-if="x.OrderStatus.IV_VSL_STEPS_VALID.indexOf(step.name)>-1" ng-repeat="step in VSL_STEP_LIST" >
        <a class="small" ng-click="y.VSL_ORST_STEPS=step.name;" style="white-space:nowrap;width:150px;max-width:150px;padding:0px;">
        	
        	<span ng-if="step.name>y.VSL_ORST_STEPS" >
        	&nbsp;&nbsp;{{step.labeltext}}
        	<span class="glyphicon glyphicon-triangle-right text-primary " ></span>
        	</span>
        	<span ng-if="step.name<y.VSL_ORST_STEPS" >
        	&nbsp;<span class="glyphicon glyphicon-triangle-left text-primary " ></span>&nbsp;{{step.labeltext}}
        	</span>
        	<span class="text-primary " ng-if="step.name==y.VSL_ORST_STEPS" >
        	&nbsp;&nbsp;&nbsp;&nbsp;{{step.labeltext}}
        	</span>
        	
        </a>
        </li>
      </ul>
      -->
    </li>
  </ul>
  <ul class="nav nav-pills ab-spaceless" role="tablist" ng-if="y.idVSL_ORST<0">
    <li class="dropdown ab-spaceless">
      <a class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;width:150px;max-width:150px;padding:0px;">
	
	<span>
	&nbsp;
	</span>
      	
      </a>

    </li>
  </ul>





EOC;

//	$grAttr = $xtmp->grAttrib;
//	$laAttr = $xtmp->laAttrib;
//	$inAttr = $xtmp->inAttrib;
//	$laAttr["class"] = "hidden";
//	$inAttr["size"] = "21";
//	$inAttr["class"] = " {{". "y.idVSL_ORST>0?'':'invisible'}} ";
//	
//	$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_STEPS","",$grAttr,$laAttr,$inAttr,"");
//	$stepCode .= $xtmp->currHtml;
$stepCode .= '</td>';

$stepCode .= <<<EOC

<td style="width:30%;"  >

	
<div lot-links="on" ng-if="y.VIN_ITEM_LOTCT > 0" >
	
	<span lotlist="0"  >
		<span  class="hidden" ng-repeat="lot in vsl_orhe   | AB_noDoubles:'idVSL_LSTR'  " ng-if="y.idVSL_ORST == lot.VSL_LSTR_STPSQ" >
		{{lot.idVSL_LSTR}}:{{lot.VSL_LSTR_ALOQT}},
		</span>
	</span>
	
	<input class="hidden"  ng-model="y.lotSel" size=5 />
	
	<input id="lotSel{{ y.idVSL_ORST }}"  lid="{{y.idVSL_ORST}}" class="hidden" 
		onclick="
			var lotUniqueId = '';
			var lotOrstId = '';
			$(this).parentsUntil('table').find('[lotallo]').each(function()
			{
				if (lotOrstId != $(this).attr('lotallo') || lotUniqueId != $(this).attr('lotuniqueid') )
				{
					lotUniqueId = $(this).attr('lotuniqueid');
					lotOrstId = $(this).attr('lotallo');
					$(this).val($('#lotAlloQt' + lotOrstId +'-'+ lotUniqueId).val());
				}
				
			});
			
			$('#lotAccum'+$(this).attr('lid')).click()
			"
			/>		
	
	
	<input class="hidden" lotaccumulator="0" value="" 
		id="lotAccum{{ y.idVSL_ORST }}" 
		onclick="
			var newSels = '';
			
			$(this).parentsUntil('table').find('[lotallo]').each(function()
			{
				if (isNaN($(this).val()) == true )
				{
					$(this).val($(this).attr('lastval'));
				}
				$(this).val(Math.abs($(this).val()))
				$(this).val($(this).val()=='0'?'':$(this).val())
				$(this).attr('lastval',$(this).val())
				if ($(this).val() > 0)
				{
					var lotUniqueId = $(this).attr('lotuniqueid'); // $(this).parentsUntil('div').find('[lotuniqueid]').val();
					newSels += lotUniqueId + ':' + Number($(this).val()) + ',';
				}
					
			});
			
			
			$(this).parentsUntil('table').find('[lotselected]').val(newSels);
			
			$(this).parentsUntil('table').find('[lotselected]').attr('lotSelected','1');
			$(this).parentsUntil('table').find('[lotselected]').click();
			
			
			"
	
	/>
	<input updlotsel="0" class="hidden" ng-click="updLotSel()" />
		
	<input class="hidden" lotselected="0" value="" totalOrd="{{y.VSL_ORST_ORDQT}}"
		onclick="
		$(this).parent().find('[ng-model]').val($(this).parent().find('[lotlist]').text());
		var selCount = 0;
		if ($(this).attr('lotselected') == '0')
		{
			$(this).parentsUntil('table').find('[lotallo]').each(function()
			{
				$(this).attr('lastval',Number($(this).val()))
				$(this).attr('orgval',Number($(this).val()))
			});

			$(this).val($(this).parent().find('[ng-model]').val().trim());
			$(this).attr('lotSelected','1')
		}
		var selList = $(this).val().split(',');
		var occ = 0;
		while (occ < selList.length-1)
		{
			selCount += Number(selList[occ].slice(selList[occ].indexOf(':')+1));
			occ += 1;
		};
		
		$(this).parentsUntil('table').find('[selCountDsp]').html(selCount);
		
		if (Number($(this).attr('totalOrd')) != selCount)
		{
			$(this).parentsUntil('table').find('[lid]').addClass('text-danger');
		}
		else
		{
			$(this).parentsUntil('table').find('[lid]').removeClass('text-danger');
		}
		
		$(this).parent().find('[updlotsel]').click();
		
		// alert('LOT:' + $(this).parent().find('[updlotsel]').attr('updlotsel'));
		// $(this).parentsUntil('table').find('[ng-click]').click();	
	" />
	 
	<input class="hidden" ng-model="y.selCountDsp" />
	
	<span lid="#LotQt{{y.idVSL_ORST}}"  class="btn-sm ab-pointer small text-primary"  orst="{{y.VSL_ORST}}"
	onclick="	
	$($(this).attr('lid')).toggleClass('hidden');
	$(this).parent().find('[lotSelected]').click();
	" >
	<span class="glyphicon glyphicon-th-list small"></span>
	<span selCountDsp="on"></span>
	</span>
	
</div>


</td>
</tr>

<tr ng-if="x.VIN_ITEM_LOTCT > 0" id="LotQt{{y.idVSL_ORST}}" class="hidden ab-spaceless ">
	
	<td colspan=100 style="vertical-align:top;margin:0px;padding-left:15px;" id="LotQt{{x.idVSL_ORDE}}" class="small ab-spaceless" ng-app=""  >
		
		<div class="row text-primary ab-spaceless "  >
			<div class="col-sm-2 ab-spaceless text-center ">
			Lot
			</div>
			<div class="col-sm-1 ab-spaceless text-center">
			Qty
			</div>
			<div class="col-sm-1 ab-spaceless text-center">
			Allo
			</div>
			<div class="col-sm-1 ab-spaceless text-center">
			PO
			</div>
			<div class="col-sm-1 ab-spaceless text-center">
			Date
			</div>
			<div class="col-sm-1 ab-spaceless text-center">
			Exp.
			</div>

			<div class="col-sm-2 ab-spaceless text-left">
				<table style="width:100%;" ><tr>
				<td style="width:33%;"  class="ab-spaceless small">
					Life
				</td>			
				<td style="width:32%;"  class=" ab-spaceless small">
					Del.
				</td>								
				
				<td style="width:35%;"  class=" ab-spaceless small">
					Months
				</td>	
				</tr></table>							
			</div>				
			
			<div class="col-sm-1 ab-spaceless text-center">
			
			<span>Qty</span>
			</div>					
			
		</div>

		<div  
		 	ng-r2epeat="rowlotQt in vin_item_vin_lshe  | AB_noDoubles:'idVIN_LSHE'  | AB_sortReverse:'VIN_LSHE_DOMDA' "
		 	ng-repeat="rowlotQt in vin_item_vin_lshe  | AB_noDoubles:'idVIN_ITEM' "
		 	n1g-if="x.idVIN_ITEM == lotQt.VIN_LSHE_ITMID && lotQt.VIN_LSHE_SOLDO == 0"
		 	ng-if="x.idVIN_ITEM == rowlotQt.VIN_LSHE_ITMID" >
		 <div  class="row " ng-repeat="lotQt in rowlotQt.rowSet   | AB_noDoubles:'idVIN_LSHE'  | AB_sortReverse:'VIN_LSHE_DOMDA' "   ng-if="lotQt.VIN_LSHE_SOLDO == 0">
		 	
			<div class="col-sm-2 ab-border ab-spaceless text-right">
				<input class="hidden" ng-model="lotQt.idVIN_LSHE" />
				<input class="hidden" ng-model="lotQt.hasSpecs" ng-init="lotQt.hasSpecs=0" />	
				<span ng-if="lotQt.hasSpecs==0" class="text-primary small">
					{{lotQt.VIN_LSHE_LOTID}}&nbsp;&nbsp;
				</span>

				<ul class="nav  ab-spaceless " role="tablist" 
					ng-repeat="sma in vin_item_ssma | AB_noDoubles:'idVIN_ITEM' " 
					ng-if="sma.idVIN_ITEM==x.VSL_ORDE_ITMID" 
				 >
				<li class="dropdown ab-spaceless" >
				<a ng-if="lotQt.hasSpecs>0" title="has specs linked to lot" class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;padding:0px;">
					<span>
						{{lotQt.VIN_LSHE_LOTID}}&nbsp;
					</span>
					<span  class="caret small"></span>
				
				</a>
				<ul class="dropdown-menu ab-spaceless text-right" role="menu"  >
					
				<li class="bg-warning" 
					ng-repeat="smaRows in sma.rowSet "
					ng-if="smaRows.VIN_SSLT_LOTID == lotQt.idVIN_LSHE && smaRows.VIN_SSLT_SPESQ == smaRows.idVIN_SSMA" 
				 >
				<a class="small"  style="white-space:nowrap;padding-left:2px;min-width:200px;text-align:right;">
					<span ng-init="lotQt.hasSpecs=1" >
						<table style="width:100%">
						<tr class=" ab-border" >
						<td colspan=2 class="text-left">
							<span class="text-primary" >Spec Id:</span>
							<label>
							&nbsp;&nbsp;
					        	{{smaRows.VIN_SSMA_SPEID}}
					        	&nbsp;&nbsp;
					        	</label>
					        </td>
					        <td class="text-right">
					        	<span ng-if="smaRows.VIN_SSMA_DESCR" >
					        		{{smaRows.VIN_SSMA_DESCR}}
					        		&nbsp;&nbsp;
					        	</span>
					        </td>
					        </tr>
					        <tr>
					        <td style="width:50%;" class="text-right" >	
							<span class="text-primary" >Expires:</span>
						</td>
					        <td style="width:50%;" class="text-left" >	
							<label class="" >&nbsp;
							{{ABGetDateFn('add-days', lotQt.VIN_LSHE_DOMDA + "," + smaRows.VIN_SSMA_SHLIF)}}
							</label>
						</td>	
					        </tr>
					        <tr>
					        <td style="width:50%;" class="text-right">	
							<span class="text-primary" >Exp. Months:</span>
						</td>
					        <td style="width:50%;" class="text-left" >	
							<label class="" >&nbsp;
							{{ (ABGetDateFn('diff-today',ABGetDateFn('add-days', lotQt.VIN_LSHE_DOMDA + "," + smaRows.VIN_SSMA_SHLIF))/30 ).toFixed(1) }}
							</label>
					        </td>
					        </tr>
					        <tr>
					        <td style="width:50%;" class="text-right" >	
							<span class="text-primary" >Life %:</span>
						</td>
					        <td style="width:50%;" class="text-left" >	
							<label class="" >&nbsp;
							{{ (ABGetDateFn('diff-perc', lotQt.VIN_LSHE_DOMDA + "," + (ABGetDateFn('add-days', lotQt.VIN_LSHE_DOMDA + "," + smaRows.VIN_SSMA_SHLIF)) )) }}
							</label>
							
						</td>
						</tr>
						</table>
					
				       	</span>
				</a>
				</li>
				</ul>
				</li>
				</ul>
					
			</div>
			<div class="col-sm-1 ab-border ab-spaceless text-right">
				<span ng-repeat="lotAlo in vin_inve  | AB_noDoubles:'idVIN_LSLQ' " ng-if="lotAlo.VIN_LSLQ_LOTSQ == lotQt.idVIN_LSHE" >
					{{ lotAlo.VIN_LSLQ_BOHQT }} 
				</span>
				&nbsp;
			
			</div>
			<div class="col-sm-1 ab-border ab-spaceless text-right">
				<span ng-repeat="lotAlo in vin_inve  | AB_noDoubles:'idVIN_LSLQ' " ng-if="lotAlo.VIN_LSLQ_LOTSQ == lotQt.idVIN_LSHE" >
					{{ lotAlo.VIN_LSLQ_ALOQT }} 
				</span>
				&nbsp;
			
			</div>
			<div class="col-sm-1 ab-border ab-spaceless text-right">
				<span ng-repeat="lotAlo in vin_inve  | AB_noDoubles:'idVIN_LSLQ' " ng-if="lotAlo.VIN_LSLQ_LOTSQ == lotQt.idVIN_LSHE" >
					{{ lotAlo.VIN_LSLQ_PURQT }} 
				</span>
				&nbsp;
			
			</div>
			<div class="col-sm-1 ab-border ab-spaceless text-center">
				{{ ABGetDateFn('get-year',lotQt.VIN_LSHE_DOMDA) }}-{{ ABGetDateFn('get-month',lotQt.VIN_LSHE_DOMDA) }}
			</div>
			<div class="col-sm-1 ab-border ab-spaceless text-center" style="font-weight:700;" >
			
				<span ng-if="x.VSL_ORDE_LLINK < 1 " >
					{{ ABGetDateFn('get-year',lotQt.VIN_LSHE_DATES) }}-{{ ABGetDateFn('get-month',lotQt.VIN_LSHE_DATES) }}
				</span>
				
				<span class="text-primary" ng-repeat="tcSpec in specSheet[x.VSL_ORDE_ITMID] | AB_noDoubles:'idVIN_LSHE,idVIN_SSMA'"
				ng-if="tcSpec.idVIN_SSMA == x.VSL_ORDE_LLINK && lotQt.idVIN_LSHE == tcSpec.idVIN_LSHE" 
				>				
					{{ ABGetDateFn('get-year',tcSpec.VIN_LSHE_DATES) }}-{{ ABGetDateFn('get-month',tcSpec.VIN_LSHE_DATES) }}
				</span>
			</div>	




							<div ng-if="x.VSL_ORDE_LLINK<1" class="col-sm-2  ab-spaceless" ng-init="x.specCurrent=''">			
							
								<table  
								style="width:100%;border-color:transparent;border:none;border-bottom:solid;border-width:2px;border-color:{{lotQt.lifeColor}};" 
								>
								<tr>
								<td style="width:33%;"  
								ng-init="lotQt.lifeColor = setLifeColors(ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + ',' + lotQt.VIN_LSHE_DATES),lotQt,x.VSL_ORDE_LLINK)"
								class=" ab-border ab-spaceless text-center small">
									{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + lotQt.VIN_LSHE_DATES) }}%
								</td>			
								<td style="width:33%;"  class=" ab-border ab-spaceless text-center small">
									{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + lotQt.VIN_LSHE_DATES + "," + y.VSL_ORST_PDATE) }}%
								<td style="width:34%;"  class=" ab-border ab-spaceless text-center small">
									<span ng-if="ABGetDateFn('diff-today',lotQt.VIN_LSHE_DATES) > 0" >
									{{ (ABGetDateFn('diff-today',lotQt.VIN_LSHE_DATES)/30).toFixed(1) }}
									</span>
									<span ng-if="ABGetDateFn('diff-today',lotQt.VIN_LSHE_DATES) < 0.0000001 " >
									0
									</span>
	
								</td>
								</tr></table>

							</div>				
			
<!--					
			<div class="col-sm-1 ab-border ab-spaceless text-center small">
				{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + lotQt.VIN_LSHE_DATES) }}%
			</div>			
			<div class="col-sm-1 ab-border ab-spaceless text-center small">
				{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + lotQt.VIN_LSHE_DATES + "," + y.VSL_ORST_PDATE) }}%
			</div>								
-->

			<div ng-if="x.VSL_ORDE_LLINK>0" class="col-sm-2  ab-spaceless" ng-init="x.specCurrent=x.VSL_ORDE_LLINK" >
				
				
				<table style="width:100%;;border-color:transparent;border:none;border-bottom:solid;border-width:2px;border-color:{{lotQt.lifeColor}};" >
					<tr class="r" ng-repeat="sp in specSheet[x.VSL_ORDE_ITMID] | AB_noDoubles:'idVIN_LSHE,idVIN_SSMA' " 
					ng-if="lotQt.idVIN_LSHE==sp.idVIN_LSHE && sp.idVIN_SSMA==x.VSL_ORDE_LLINK " >
					<td class="ab-border ab-spaceless text-center small" style="width:34%;"
					ng-init="lotQt.lifeColor = setLifeColors(ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + ',' + sp.VIN_LSHE_DATES),lotQt,x.VSL_ORDE_LLINK)"  >
						{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + sp.VIN_LSHE_DATES) }}%
					</td>
					<td class="ab-border ab-spaceless text-center small" style="width:33%;" >
						{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + sp.VIN_LSHE_DATES + "," + y.VSL_ORST_PDATE) }}%
					</td>
					<td class="ab-border ab-spaceless text-center small" style="width:33%;" >
						<span ng-if="ABGetDateFn('diff-today',sp.VIN_LSHE_DATES) > 0" >
						{{ (ABGetDateFn('diff-today',sp.VIN_LSHE_DATES)/30).toFixed(1) }}
						</span>
						<span ng-if="ABGetDateFn('diff-today',sp.VIN_LSHE_DATES) < 0.0000001 " >
						0
						</span>						
					</td>
					</tr>
				</table>	
			
			</div>
			<div class="col-sm-1  ab-spaceless text-center ab-pointer" 
				onclick="$(this).find('#newId').removeClass($(this).find('#lotId').html()?'':'hidden');$(this).find('input').focus();" 
			>
				<input class="hidden" lotuniqueid="0" ng-model="lotQt.VSL_LSTR_LOTSQ" />
				<span id="lotId" 
				ng-repeat="lotSel in vin_inve  | AB_noDoubles:'idVSL_LSTR' " ng-if="y.idVSL_ORST == lotSel.VSL_LSTR_STPSQ  && lotSel.VSL_LSTR_LOTSQ == lotQt.idVIN_LSHE" >
					<input size=2 class="small ab-borderless" 
						lotallo="{{lotSel.VSL_LSTR_STPSQ}}"
						lastval="0"
						orgval="0"
						lotuniqueid="{{lotQt.idVIN_LSHE}}"					
						onchange="$(this).parentsUntil('table').find('[lotaccumulator]').click();"
						
						ng-model="lotSel.VSL_LSTR_ALOQT"
					/>
					

					
				</span>
				
				<span id="newId" class="hidden"  >
					<input size=2  class="small ab-borderless"
						lotallo="{{y.idVSL_ORST}}"
						lotuniqueid="{{lotQt.idVIN_LSHE}}"
						lastval="0"
						orgval="0"
						onchange="$(this).parentsUntil('table').find('[lotaccumulator]').click();"
						
						ng-model="newSel.VSL_LSTR_ALOQT"
					/>
						
				</span>
				&nbsp;
			</div>	
		</div>			
		</div>

		
	</td>
</tr>	





</table>
</div>

</td>
</tr>


<tr>
	<td colspan=100 style="vertical-align:top;" class="ab-spaceless" ng-app=""  >
	
	
	<div class="row" style="vertical-align:top;"  >

		<div class="col-sm-1 " >
			<span class="ab-pointer text-primary glyphicon glyphicon-th-list " idlink="{{x.idVSL_ORDE}}"  onclick="$('#invQ'+$(this).attr('idlink')).toggleClass('hidden');">
			</span>
		</div>	

		<div class="col-sm-8 " >
			<span class="small"  >
				<strong>Total order lines pending for {{x.VIN_ITEM_ITMID }} <input size=2 readOnly class="ab-borderless" ng-model="x.recCount" /></strong>
				{{x.recCount}}
			</span>
			<span class="small" ng-if="x.recCount < 1" >
				<strong>No orders pending for {{x.VIN_ITEM_ITMID }}</strong>
			</span>
			
		</div>	
		
		<div class="col-sm-2 text-primary" >
			All 
			<span title="closed" class="ab-pointer glyphicon glyphicon-zoom-out" style="font-size:8pt;" onclick="$('[idtarget]').addClass('hidden');" >
			</span>
		&nbsp;&nbsp;
			<span title="opened" class="ab-pointer glyphicon glyphicon-zoom-in " style="font-size:10pt;" onclick="$('[idtarget]').removeClass('hidden');">
			</span>
		</div>	
	</div>	
	<div id="invQ{{x.idVSL_ORDE}}" idtarget="1" class="hidden"  >
		
		<input class="hidden" ng-model="x.totalCount" />
		<div class="small" style="font-weight:700;" ng-repeat="invQrec in vin_inve | AB_noDoubles:'idVSL_ORDE' " ng-if="vin_inve.length>0 &&  invQrec.VIN_INVE_ITMID == x.VSL_ORDE_ITMID"  >
			
			
			<div class="row"  ng-repeat="invQ in invQrec.rowSet | AB_noDoubles:'idVSL_ORDE,idVSL_ORST'  | AB_Sorted:'VSL_ORHE_ORNUM,VSL_ORDE_ORLIN' " 
			ng-if="invQ.idVSL_ORHE != idVSL_ORHE && invQ.VSL_ORST_STEPS > 'EE_SCED' && invQ.VSL_ORST_STEPS < 'JJ_INVO' " >

				<div class="col-sm-6 " recount="1" >
					<span class="text-primary" target="_blank" href="#/VSL_ORDERS/VSL_ORHECT/Process:VSL_ORDERS,Session:VSL_ORHECT,updType:UPDATE,idVSL_ORHE:{{invQ.idVSL_ORHE}}" >
						<span class="glyphicon glyphi21con-search" ></span>
						<span><em ab-label="STD_ORNUM_SH" >Order</em>:</span>
					</span>
		
				&nbsp;{{ invQ.VSL_ORHE_ORNUM  }}&nbsp; {{invQ.VGB_CUST_BPNAM}}&nbsp;
		
				</div>
				<div class="col-sm-3 ">
					<span class="text-primary"><em ab-label="VSL_ORHE_CUSPO_10" >Ref</em>:</span>
					&nbsp;{{ invQ.VSL_ORHE_CUSPO  }}&nbsp;
				</div>
				<div class="col-sm-3 text-left">
					&nbsp;&nbsp;<span class="text-primary"><em ab-label="STD_QUANTITY_SHORT" >Qty</em>:</span>
					&nbsp;{{ invQ.VSL_ORST_ORDQT  }}&nbsp;

					<span ng-repeat="stp in VSL_STEP_LIST" ng-if="stp.name == invQ.VSL_ORST_STEPS">
 					{{stp.labeltext}} 
 					</span>
				</div>
				
			</div>
		
		</div>
	
	</div>
	


	</td>
	

</tr>

</table>
</td>

EOC;

echo $stepCode;

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
<tr>
	<td>
	<br><br>
<!--	
	<div ng-init="vsl_form_dta=vsl_orhe" >
<?php require_once "../appPdf/VSL_ORHE_FORMS.php"; ?>
	</div>
-->	
	<br><br>
	</td>
</tr>

<tr>
	<td>

	</td>
</tr>


<tr>
	<td>
	<span onclick="$('#debugStat').toggleClass('hidden');">.</span>&nbsp;
	</td>
</tr>
<tr>
<td>
<table  id="debugStat" class="hidden" ><tr>

<td  class="ab-border">
<input type="text" size=5  class="ab-flipped" ab-bind="VSL_ORHE_ORSTP" ng-model="VSL_ORHE_ORSTP" />
Valid steps for this order are: {{vsl_orhe[0].OrderStatus.IV_VSL_STEPS_VALID}}
</td>
</tr>
<tr>
<td>
<div class="row small text-primary"  ng-repeat="x in vsl_orhe | AB_noDoubles:'idVSL_ORDE' "   >

<div class="col-sm-12 " >
{{x.VSL_ORDE_ORLIN}} = &nbsp;
<span ng-repeat="(zz,xx) in x.OrderStatus.IV_VSL_STEP_QTY" >
<b>[{{zz}}]</b>({{xx}})&nbsp;
</span>
 
</div>
<div class="col-sm-12 hidden" >
<?php
$val = array();
$val[count($val)] = "7,3";
$val[count($val)] = "3,7";
$val[count($val)] = "-3,7";
$val[count($val)] = "7,-3";
$val[count($val)] = "-7,-3";
$val[count($val)] = "-3,-7";
$val[count($val)] = "0,-7";
$val[count($val)] = "-7,0";
$val[count($val)] = "0,7";
$val[count($val)] = "7,0";
$occ = 0;
while ($occ < count($val))
{
	$result = 0;
	
	$qt = explode(",",$val[$occ]);
	if ($qt[0] < $qt[1])
	{
		$result = ($qt[1] - $qt[0]) * -1; 
	} 
	else
	{
		if ($qt[0] > $qt[1]) 
		{
			$result = ($qt[0] - $qt[1]);
		}
	}
	echo "Org: " . $qt[0] . " New: " . $qt[1] . " = " . $result . "<br>";
		
	$occ += 1;
}


?>
</div>
<div class="col-sm-2 small" >
STEP_MULT: <b>{{x.OrderStatus.IV_VSL_STEP_MULT}}</b>
</div>
<div class="col-sm-2 small" >
STEP_RELEASED: <b>{{x.OrderStatus.IV_VSL_STEP_RELEASED}}</b>
</div>
<div class="col-sm-2 small" >
STEP_DELIVERED: <b>{{x.OrderStatus.IV_VSL_STEP_DELIVERED}}</b>
</div>
<div class="col-sm-2 small" >
STEP_INVOICED: <b>{{x.OrderStatus.IV_VSL_STEP_INVOICED}}</b>
</div>
<div class="col-sm-2 small" >
STEP_FIRST_QTY: <b>{{x.OrderStatus.IV_VSL_STEP_FIRST_QTY}}</b>
</div>
<div class="col-sm-2 small" >
HAS_TO_INVOICE: <b>{{x.OrderStatus.IV_VSL_HAS_TO_INVOICE}}</b>
</div>
<div class="col-sm-2 small" >
HAS_TO_RELEASE: <b>{{x.OrderStatus.IV_VSL_HAS_TO_RELEASE}}</b>
</div>
<div class="col-sm-2 small" >
HAS_TO_DELIVER: <b>{{x.OrderStatus.IV_VSL_HAS_TO_DELIVER}}</b>
</div>
<div class="col-sm-2 small" >
HAS_ALOCATED_QTY: <b>{{x.OrderStatus.IV_VSL_HAS_ALOCATED_QTY}}</b>
</div>
<div class="col-sm-2 small" >
HAS_IN_WIP: <b>{{x.OrderStatus.IV_VSL_HAS_IN_WIP}}</b>
</div>
<div class="col-sm-2 small" >
STEP_MULT_CHECK: <b>{{x.OrderStatus.IV_VSL_STEP_MULT_CHECK}}</b>
</div>

</div>

</td></tr>
</table>
</td></tr>
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

<div class='ab-borderr' id="accumY" ng-click="ABSetNgAccum('#accumY','[ORDE-repeat]','x.VSL_ORDE_ORDQT','y.VSL_ORST_ORDQT');setOrderDates();" ></div>

</div>
</div>

<div id="ORHE_ALLOC" class="modal fade" role="dialog" >
  <div class="modal-dialog"  style="min-width:1200px;" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span ab-label="STD_ADD22RESS" >Order Allocation</span> - <label>{{VSL_ORHE_ORNUM}} {{VGB_CUST_BPNAM}}</label></h4>
       
		<input class=" ab-borderless ab-pointer" 
		onmouseover="$(this).attr('title','Set dates to today');" readonly ng-model="today_PDATE" size="8" 
		onclick="$('[vsl_pdate]').click();" 
		ng-init="today_PDATE=ABGetDateFn('get-year','')+'-'+ABGetDateFn('get-month','')+'-'+ABGetDateFn('get-day','')"			
		/>



      </div>
      <div class="modal-body ab-spaceless">


<div class="container" >
<?php require_once "VSL_ORHE_ALLOCATION.php"; ?>
</div>
      
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 