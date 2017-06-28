<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VSL_ORDERS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>
</div>

<div class="hidden" ng-init="SESSION_DESCR='Sales Orders'">
	<span ab-label="VSL_ORHECT"></span>
</div>
<div style="margin-left:5px;">
	<div id="mainForm" ab-main="vsl_orhe" style="margin:0px;">
		<div class="row">
			<div class="col-sm-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
			<div class="col-sm-12">
				<table>
					<tr>
					  	<td>
					  		<div title="" ng-init="collaps=0">
					  			<span  onclick="$('#bcollaps').click();collapseall(0);" class="btn-link " title="">
					  				<span class="glyphicon glyphicon-zoom-out " title=""></span>
					  			</span>
								<span onclick="$('#bcollapsIn').click();collapseall(1);" class="btn-lg btn-link " title="">
									<span class="glyphicon glyphicon-zoom-in " title="">
									</span>
								</span>
								<input class="hidden" id="bcollaps" ng-model="collaps" ng-click="collaps = 0;" size=2 />
								<input class="hidden" id="bcollapsIn" ng-model="collaps" ng-click="collaps = 1;" size=2 />
							</div>
						</td>
						<td id="ab-new" >
							<label  title="CREATE" class="">
	 				 			 <a 
							href="#VSL_ORDERS/VSL_ORHECT/Process:VSL_ORDERS,Session:VSL_ORHECT,tblName:vsl_orhe,updType:CREATE,idVSL_ORHE:0,tbData:{{tbData}}" 
							>
								<span >New</span>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>			
							</label>
						</td>
					<td>	  
<?php
	$xtmp = new appForm("VSL_ORDERS");
	$hardCode = <<<BOD
			<div>
				<span ab-empty="{{tbData=='vsl_orhe'?'vsl_orhe':'Yes'}}"
				class="" >
				<input a_iref="02-60"
							size=15
							lval=""
							ng-change="FLT_ORHE_ORNUM=VSL_ORHE_ORNUM;VSL_ORHE_ORNUM=' ';ABlstAlias('VSL_ORHE_ORNUM','VSL_ORHE_ORNUM,FLT_ORHE_ORNUM,vsl_orheHasStepsCurrent','vsl_orhe','vsl_orhe');VSL_ORHE_ORNUM=FLT_ORHE_ORNUM;"
							ng-model="VSL_ORHE_ORNUM" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>
				</span>

	

			</div>
			<input class="hidden"  id="FLT_ORHE" ab-filter="vsl_orhe" ab-filter-cond="CONTAINS" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  

				ab-filter-model="VSL_ORHE_ORNUM,VSL_ORHE_CUSPO,VSL_ORHE_USLNA,VGB_CUST_BPNAM,VGB_ADDR_DESCR,VGB_SLRP_SLSRP,VIN_ITEM_ITMID,VIN_ITEM_DESC1,VSL_ORDE_ODATE,VSL_ORDE_DDATE"

				ng-model="FLT_ORHE_ORNUM" />
BOD;
$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="STD_SEARCH";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;

$xtmp->setFieldWrapper("view01","0.0","vsl_orhe","VSL_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>
					</td>

					<td style="vertical-align:top;padding-left:5px;text-align:right;" >
						<div style="vertical-align:top;padding-left:10px;" class="small ab-strong" >
							<a href="#/VSL_ORDERS/VSL_VARIANCES/Process:VSL_ORDERS,Session:VSL_VARIANCES,tblName:vsl_orhe" >
							<span ab-label="VSL_VARIANCES" >Sales  Variance</span>
							</a>
						</div>
						<div style="height:10px;">
						&nbsp;
						</div>
						<div class="btn-link ab-pointer" ng-click="vsl_orheHasStepsCurrent=1-vsl_orheHasStepsCurrent;FLT_ORHE_ORNUM=VSL_ORHE_ORNUM;VSL_ORHE_ORNUM=' ';ABlstAlias('VSL_ORHE_ORNUM','VSL_ORHE_ORNUM,FLT_ORHE_ORNUM,vsl_orheHasStepsCurrent','vsl_orhe','vsl_orhe');VSL_ORHE_ORNUM=FLT_ORHE_ORNUM;">
							<input type="checkBox" ng-if="vsl_orheHasStepsCurrent==0" checked />
							<input type="checkBox" ng-if="vsl_orheHasStepsCurrent==1" />
							<span ab-label="STD_SHOW_COMPLETED" class="text-primary" >Show completed </span>
							<input class="hidden"  ng-model="vsl_orheHasStepsCurrent" size=2 />
						</div>
					</td>

				</tr>
			</table>
		</div>
	</div>
	<script>
		$('#ab-buttonPad').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
	</script>
	<div>
	
	<!--
	ng-repeat="lev1 in vsl_orhe "
	1,010	 	lev1.VSL_ORHE_ORNUM
	1,020	 	lev1.VSL_ORHE_USLNA
	1,030	 	lev1.VSL_ORHE_BTCUS
	1,040	 	lev1.VSL_ORHE_BTADD
	1,045	 	lev1.VSL_ORHE_STADD
	1,050	 	lev1.VSL_ORHE_CUSPO
	1,060	 	lev1.VSL_ORHE_ODATE
	1,070	 	lev1.VSL_ORHE_SLSRP
	-->
	
  	<table class="table table-condensed" style="width:95%;">
	<tr>
		<td class=" ab-spaceless">
			<div class="row bg-primary"  >
			<?php
			
			
			$xtmp = new appForm("VSL_ORDERS");
			$xtmp->grAttrib["style"]="";
			$xtmp->grAttrib["class"]="ab-spaceless ";
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-1";
			$laAttr = $xtmp->laAttrib;
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.10","vsl_orhe","","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
						
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="STD_ORNUM";
			$laAttr["class"] .= "bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.20","vsl_orhe","VSL_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VGB_CUST_BPART";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.40","vsl_orhe","VGB_CUST_BPART","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			$xtmp = new appForm("VSL_ORDERS");
			
	// lev1.VSL_ORHE_ODATE
			
			/*$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VSL_ORHE_ODATE";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.60","vsl_orhe","VSL_ORHE_ODATE","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-3";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="STD_ADDRESS";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.60","vsl_orhe","VSL_ORHE_ODATE","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;	*/
						
			?>
			</div>
		</td>
		</tr>	
	</table>
</div>
<!--
	<div>
	<textarea>
var debug = "";
debug += showProps(dDta.xcList.VSL_ALAIN.E_POST ,"upd")
$("#focusGrid").val(debug)
</textarea>
<table><tr><td>
<input ng-model="aabb" />
</td><td>
<div class="ab-border ab-pointer ab-spaceless" ng-click="ABlstAlias('idVSL_ORHE',aabb,'vsl_orheXXX','VSL_ALAIN');" >AAA</div>
</td></tr></table>
</div>
-->			
	<div class="mygrid-wrapper-div  ab-borderless ab-spaceless" >
	
		<table class="table table-condensed table-striped" >
	  		<!-- <tr role="presentation" class="" ng-repeat="x in vsl_orhe " > -->
	  		<tr role="presentation" ng-repeat="x in rawResult.vsl_orhe | AB_noDoubles:'idVSL_ORHE'  | AB_sortReverse:'VSL_ORHE_CDATE'" >		
	  		<form id="mainForm" name="mainForm"  ab-rowset="{{$index}}" ab-view="vsl_orhe" ab-main="vsl_orhe">
	  			<td ng-if="abSessionModal==true" class="small">
	  				<a  ng-click="ABsessionSetResponse(x)" > Select </a>&nbsp;
	  			</td>
	  			<!--
	  			to be used later
				<td style="min-width:10px;max-width:10px;" >	
					<span ng-if="!ABSelectors.idVGB_CUST[x.idVGB_CUST]" ng-click="ABRecSelectors('idVGB_CUST',x.idVGB_CUST,'add',x.VGB_BPAR_BPART + ':' + x.VGB_CUST_BPNAM);">
						<span class="ab-pointer glyphicon glyphicon-plus text-muted small" title="add to tagged list" ></span>
						
					</span>
					<span ng-if="ABSelectors.idVGB_CUST[x.idVGB_CUST]" ng-click="ABRecSelectors('idVGB_CUST',x.idVGB_CUST,'delete',x.VGB_BPAR_BPART + ':' + x.VGB_CUST_BPNAM);" >
						<span class="btn-link glyphicon glyphicon-tag" title="remove from tagged list" ></span>
					</span>
					
				</td>
	  			-->
	  			<td class=" ab-spaceless">
					<div class="row">
						<div class="col-sm-1">
							<a href="#{{opts.Process}}/VSL_ORHECT/idVSL_ORHE:{{x.idVSL_ORHE}},updType:UPDATE,Session:VSL_ORHECT,Process:{{opts.Process}}"
							target="{{ABtarget}}" >
								<?php
						$tFnc = new AB_querySession;
						$dtaObj = array();
						$dtaObj['PROCESS'] = "VSL_ORDERS";
						$dtaObj['SESSION'] = "VSL_ORHECT";
						$chk = 0;
						$chk += $tFnc->hasPriviledge($dtaObj,"vsl_orhe","New");
						$chk += $tFnc->hasPriviledge($dtaObj,"vsl_orhe","Upd");
						$chk += $tFnc->hasPriviledge($dtaObj,"vsl_orhe","Del");

						if ($chk > 0)
						{
							echo "<span >Edit</span>";
						}
						else
						{
							echo "<span >View</span>";
						}
						?>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>
							<span style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{x.idVSL_ORHE}}" class="btn-link glyphicon glyphicon-th-list"></span>
							
							
						</div>							
<?php

// idVSL_ORHE
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("","0.0","vsl_orhe","x.idVSL_ORHE","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

$xtmp = new appForm("VSL_ORDERS");

echo '<div class="col-sm-2 ">';

// VSL_ORHE_ORNUM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = " hidden ";

$inAttr = $xtmp->inAttrib;
$hardCode = '<div><label>&nbsp{{ x.VSL_ORHE_ORNUM }}</label></div><div ><label><em  ab-label="VSL_ORHE_ODATE" class="text-primary">Order Date :</em>&nbsp;{{ x.VSL_ORHE_ODATE }}</label></div> ';
$xtmp->setFieldWrapper("header","0.0","vsl_orhe","x.VSL_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</div><div class="col-sm-2">';


// VGB_CUST_BPNAM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = " hidden ";
$inAttr = $xtmp->inAttrib;
$hardCode = '<div><label>&nbsp{{ x.VGB_CUST_BPNAM }}</label></div><div class="small"><label><em  ab-label="VSL_ORHE_CUSPO" class="text-primary">Customer PO number:</em><small>&nbsp;{{x.VSL_ORHE_CUSPO}}</small></label></div>';
$xtmp->setFieldWrapper("header","0.0","vsl_orhe","x.VGB_CUST_BPNAM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</div><div style="clear:both;"></div>';

/* collapse in body section atart */


echo '<div exp-list="1" id="exp_{{x.idVSL_ORHE}}" class="collapse {{' . "collaps!=1?'':'in'}}" . '">';

echo '<div class="col-sm-1 "></div>';

/* Left side VSL_ORHE data Section start */

echo '<div class="col-sm-4">';
   echo '<div class="col-sm-6">';
// VSL_ORHE_SLSRP
$xtmp->grAttrib["class"] = "ab-spaceless small";
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = " hidden ";
$inAttr = $xtmp->inAttrib;
$hardCode = '<div ng-repeat="y in vsl_orhe | AB_noDoubles:\'idVGB_SLRP\'"><div class="small" ng-if="y.idVGB_SLRP == x.VSL_ORHE_SLSRP"><label><em  ab-label="VGB_SLRP_SLSRP" class="text-primary">Sales Rep ID :</em><small>&nbsp;{{y.VGB_SLRP_SLSRP}} {{ y.VGB_SLRP_SRNAM}}</small></label></div></div>
            <div ng-repeat="y in vsl_orhe | AB_noDoubles:\'idVGB_TERM\'"><div class="small" ng-if="y.idVGB_TERM == x.VSL_ORHE_TERID"><label><em  ab-label="VGB_TERM_TERID" class="text-primary">Term I.D. code:</em><small>&nbsp;{{y.VGB_TERM_TERID}} {{ y.VGB_TERM_DESCR}}</small></label></div></div>';
$xtmp->setFieldWrapper("toggle","2.1","vsl_orhe","x.VSL_ORHE_SLSRP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</div><div class="col-sm-6">';

$xtmp->grAttrib["class"] = "ab-spaceless small";
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = " hidden ";
$inAttr = $xtmp->inAttrib;
$hardCode = '<div ng-repeat="y in x.rowSet | AB_noDoubles:\'idVGB_ADDR\'">
                 <div class="small" ng-if="y.idVGB_ADDR == x.VSL_ORHE_BTADD">
	                 <label><em  ab-label="STD_BILL_TO" class="text-primary">Bill to:</em>&nbsp;{{y.VGB_ADDR_ADDID}}&nbsp;<small>{{y.VGB_ADDR_DESCR}}</small></label>
	              </div>
		           <div class="small" ng-if="y.idVGB_ADDR == x.VSL_ORHE_STADD">
		             <label><em ab-label="STD_SHIP_TO" class="text-primary">Ship-to :</em>&nbsp; {{y.VGB_ADDR_ADDID}}&nbsp;<small>{{y.VGB_ADDR_DESCR}}</small></label>
		            </div>
		       </div>';
$xtmp->setFieldWrapper("toggle","2.1","vsl_orhe","x.VSL_ORHE_STADD","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</div>
     <div style="clear:both;"></div>
     <div class="col-sm-6">';


 // VSL_ORHE_CURID
$xtmp->grAttrib["class"] = "ab-spaceless small";
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = " hidden ";
$inAttr = $xtmp->inAttrib;
$hardCode = '<div ng-repeat="y in vsl_orhe | AB_noDoubles:\'idVGB_CURR\'"><div class="small" ng-if="y.idVGB_CURR == x.VSL_ORHE_CURID"><label><em  ab-label="STD_CURRENCY" class="text-primary">Currency:</em><small>&nbsp;{{y.VGB_CURR_CURID}} {{ y.VGB_CURR_DESCR}}</small></label></div></div>
             <div class="small"><label><em  ab-label="VIN_ITEM_CFCAT" class="text-primary">C of C Attached :</em><small>&nbsp;{{x.VSL_ORHE_CFCAT === "1" ? "Yes" : "No"}} </small></label></div>';
$xtmp->setFieldWrapper("toggle","2.1","vsl_orhe","x.VSL_ORHE_CURID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

echo '</div>
     <div style="clear:both;"></div>
     </div>';

/* Left side VSL_ORHE data Section End */


/* Right side VSL_ORDE data Section Start */
echo '<div class="col-sm-6">';

 echo '<table class="table table-condensed ab-spaceless" width="95%;">
      	 <tr>
				<td><label class="small"><em  ab-label="VIN_ITEM_ITMID" class="text-primary">Line-Seq#</em></lable></td>  
				<td><label class="small"><em  ab-label="VIN_ITEM_ITMID" class="text-primary">Item Code</em></lable></td>  
				<td><label class="small"><em  ab-label="STD_DESCR" class="text-primary">Description</em></lable></td>
				<td><label class="small"><em  ab-label="VSL_ORHE_DDATE_10" class="text-primary">Del.Date </em></lable></td>
				<td><label class="small"><em  ab-label="STD_QUANTITY_SHORT" class="text-primary">Qty </em></lable></td>
				<td><label class="small"><em  ab-label="STD_PRICE" class="text-primary">Price </em></lable></td>     
				<td><label class="small"><em  ab-label="VSL_ORST_STEPS" class="text-primary">Step </em></lable></td>     
       	</tr>';
       	
       	
        echo '<tr class="ab-spaceless" ng-repeat="k in x.rowSet | AB_noDoubles:\'idVSL_ORDE,idVSL_ORST\'">';
        echo '<td class="small"><label>{{k.VSL_ORDE_ORLIN}}-{{k.VSL_ORST_STPSQ}}</label></td>';
echo '<td  class="ab-spaceless">';
// VSL_ORDE_ITMID
//	$grAttr = $xtmp->grAttrib;
//	$grAttr["class"]="ab-spaceless ab-border";
//	$laAttr = $xtmp->laAttrib;
//	$inAttr = $xtmp->inAttrib;
$hardCode = '<span class="ab-spaceless" ng-repeat="y in x.rowSet | AB_noDoubles:\'idVIN_ITEM\'"  ng-if="y.idVIN_ITEM == k.VSL_ORDE_ITMID" ><label class="small">&nbsp;{{y.VIN_ITEM_ITMID}}</label></span>';
// $xtmp->setFieldWrapper("toggle-item","3.1","vsl_orhe","k.VSL_ORDE_ITMID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
// echo $xtmp->currHtml;
echo  '</td><td  class="ab-spaceless">';

// VIN_ITEM_DESC1
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div ng-repeat="y in x.rowSet | AB_noDoubles:\'idVIN_ITEM\'"><div class="small" ng-if="y.idVIN_ITEM == k.VSL_ORDE_ITMID"><label>&nbsp;{{y.VIN_ITEM_DESC1}}</label></div></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vsl_orhe","k.VIN_ITEM_DESC1","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
// echo $xtmp->currHtml;
echo '</td><td  class="ab-spaceless">';

 // VSL_ORDE_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label><small>&nbsp;{{k.VSL_ORST_PDATE}}</small></label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vsl_orhe","k.VSL_ORST_PDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
// echo $xtmp->currHtml;
echo '</td><td  class="ab-spaceless">';


 // VSL_ORDE_ORDQT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label><small>&nbsp;{{k.VSL_ORST_ORDQT}}</small></label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vsl_orhe","k.VSL_ORST_ORDQT","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
// echo $xtmp->currHtml;
echo '</td><td class="ab-spaceless">';

 // VSL_ORDE_OUNET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label><small>&nbsp;{{k.VSL_ORDE_OUNET}}</small></label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vsl_orhe","k.VSL_ORDE_OUNET","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
// echo $xtmp->currHtml;
echo '</td>';
echo '<td class="small"> &nbsp; {{ AB_CPARM["VSL_STEPS_DESCR"][k.VSL_ORST_STEPS]}}</td></tr></table>';
echo '</div>';
/* Right side VSL_ORDE data Section End */

echo '</div>
      <div style="clear:both;"></div>';

	/*$obj = $xtmp->formData;
	ksort($obj);
	$ret = array();
	foreach($obj as $func => $result){
		
		// column space condition
		
		if($func=='header' || $func=='toggle-item')  { $columnclass = 'col-sm-2'; } elseif($func=='toggle') {  $columnclass = 'col-sm-6'; } 
		
		if($func=='toggle') 
		{ 
		   $dispHtml .= '<div ab-panel="1" id="{{x.idVSL_ORHE}}" class="collapse">'; 
		   $dispHtml .= '<div style="clear:both;"></div><div class="col-sm-1 "></div><div class="col-sm-4">';
		}
		
		if($func=='toggle-item') { $dispHtml .= '<div class="col-sm-6">
		<div class="col-sm-2 small"><label><em  ab-label="VIN_ITEM_ITMID" class="text-primary">Item Code</em></lable></div>
       <div class="col-sm-2 small"><label><em  ab-label="STD_DESCR" class="text-primary">Description</em></lable></div>
       <div class="col-sm-2 small"><label><em  ab-label="VSL_ORHE_ODATE" class="text-primary">Order Date </em></lable></div>
       <div class="col-sm-2 small"><label><em  ab-label="VSL_ORHE_DDATE_10" class="text-primary">Del.Date </em></lable></div>
       <div class="col-sm-2 small"><label><em  ab-label="STD_QUANTITY_SHORT" class="text-primary">Qty </em></lable></div>
       <div class="col-sm-2 small"><label><em  ab-label="STD_PRICE" class="text-primary">Price </em></lable></div></div>		
		<div ng-repeat="k in x.rowSet | AB_noDoubles:\'idVSL_ORDE\'"><div class="col-sm-6">'; }
		
      $xObj = $obj[$func];
		ksort($xObj);
		$objCount = 0;
		
		$dispHtml .= '<div class="'.$columnclass.' ">';
		foreach($xObj as $name => $value)
		{
			$dispHtml .= $value['Html'];
			$dispHtml .= '</div><div class="'.$columnclass.'">';	
      }
     $dispHtml .= '</div>';
     
     if($func=='toggle') {  $dispHtml .= '</div>'; }
     
     if($func=='toggle-item') {  $dispHtml .= '</div></div></div>'; }
     $newObj[$func] = $dispHtml;
	  $dispHtml = ""; 
	  
   }
 echo implode($newObj);
   
   echo "<div class='hidden' ><pre>" . $dispHtml . "</pre></div>";
   */
?>	
					
					 </div>	  			
	  			 </td>
	  			</form>
	  		</tr>
	  	  </table>
	  	</div>	
</div>

<table class="table table-condensed hidden ">
	  <tr class="ab-spaceless">
	  		<td>
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vsl_orhe'?'vsl_orhe':'Yes'}}"
			class="hidden{{ tbData=='vsl_orhe'?'xxx':''}} text-primary" >
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vsl_orhe',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vsl_orhe',1)"  > </span>
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
</div>



	
<div class='btn-sm ab-body-buttons hidden' >
	<span class='hidden'>
		Records per page:&nbsp;
		<select class='text-muted' ab-mpp onchange="getMaxPerPage();" value="1000" >
		  <option value="10">10</option>
		  <option value="20" >20</option>
		  <option value="40"  >40</option>
		  <option value="1000" selected >100</option>
		</select>

	</span>
</div>

<script>

function collapseall(dir)
{
		
	$("[exp-list]").each(function()
	{
		if ($(this).hasClass("in"))
		{
			if (dir==0)
			{
				$("[data-target='#" + $(this).attr("id") + "']").click();
				
			}
		}
		else
		{
			if (dir==1)
			{
				$("[data-target='#" + $(this).attr("id") + "']").click();
				
			}
		}
		
	});
	
	
}
</script>