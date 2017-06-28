
<div  class="row bg-primary small">

	<div class="col-sm-1 ab-spaceless">
		&nbsp;
		<label ab-label="VIN_ITEM_ITMID" >
		
		</label>			
	</div>

	<div class="col-sm-4 ab-spaceless ">
		<div class="row">
			<div class="col-sm-7 ab-spaceless text-right">
				
				<label ab-label="VSL_ORST_STPSQxxx">				
					Line/Step
				</label>
				&nbsp;&nbsp;
				<label ab-label="VSL_ORST_PDATE">
				Plan Date
				</label> 
				&nbsp;&nbsp;&nbsp;&nbsp;
			</div>	
			<div class="col-sm-4 ab-spaceless">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label ab-label="STD_QUANTITY_SHORT">
				Quantity
				</label>
				&nbsp;&nbsp;
				<label ab-label="VSL_ORST_STEPS">
				Seq. Steps;
				</label>
			</div>

		</div>
	</div>	
	<div  class="col-sm-6">

	</div>
	<div  class="col-sm-1">

	</div>
</div>


	
<div class="row ab-border small" role="presentation" ng-repeat="xItm in vsl_orhe | AB_noDoubles:'idVIN_ITEM' | AB_Sorted:'VIN_ITEM_ITMID' " ng-if="xItm.idVSL_ORDE > 0" >

<div class="col-sm-12">
<div  class="row small">

	<div class="col-sm-5 ab-spaceless text-primary text-right">
		<div ng-if="xItm.VIN_ITEM_LOTCT > 0" >
			<label >
			      <select ng-options="spc.idVIN_SSMA as spc.VIN_SSMA_SPEID for spc in specSheet[xItm.idVIN_ITEM] | AB_noDoubles:'idVIN_SSMA' " 
			      ng-model="xItm.specCurrent" >
			        <option ng-if="!xItm.specCurrent" value="">Select Spec Sheet</option>
			      </select>			
			</label>      
		</div>		
	</div>
	<div class="col-sm-6 ab-spaceless">
						
						<div ng-if="xItm.VIN_ITEM_LOTCT > 0" class="row text-primary ab-spaceless "  >
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
							<div class="col-sm-1 ab-spaceless text-center">
							Life%
							</div>					
							<div class="col-sm-1 ab-spaceless text-center">
							Del.%
							</div>					
							<div class="col-sm-3 ab-spaceless text-left">
							<span class="ab-border ab-spaceless" >Life%</span><span class="ab-border ab-spaceless" >Months</span><span class="ab-border ab-spaceless" >Del.%</span>
							<span>Qty</span>
							</div>					
							
						</div>
	</div>
</div>	
</div>	
	<div class="col-sm-2 ab-spaceless small">

		<div>
			<label >{{ xItm.VIN_ITEM_ITMID }}</label>
			
			<span>{{ xItm.VSL_ORDE_DESCR }}</span>
			
		</div>



		<div ng-repeat="invQ in vin_inve | AB_noDoubles:'idVIN_INVE'  " ng-if="vin_inve.length>0 && invQ.VIN_INVE_ITMID == xItm.idVIN_ITEM" >
	
			<span class="small">
			<label>
				<table>
				<tr>
					<td class="">
						<span class="text-primary"><em>On&nbsp;hand:</em></span>
					</td>
					<td style="min-width:35px;" >
			
					
					{{ invQ.VIN_INVE_BOHQT.length>0?invQ.VIN_INVE_BOHQT:'0' }}&nbsp;
			
					</td>
					<td class="">
						<span class="text-primary"><em>Allocated:</em></span>
					</td>
					<td>
						{{invQ.VIN_INVE_ALOQT>0?invQ.VIN_INVE_ALOQT:'0'}}&nbsp;
					</td>
					<td class="">
						&nbsp;<span class="text-primary"><em>On&nbsp;PO:</em></span>
					</td>
					<td >
						{{invQ.VIN_INVE_PURQT>0?invQ.VIN_INVE_PURQT:'0'}}&nbsp;
					</td>
					<td class=" text-primary">
					
						<span ng-if="xItm.totalCount > 0" >
							<span class="ab-pointer text-primary glyphicon glyphicon-th-list " 
							idlink="{{xItm.idVIN_ITEM}}"  
							onclick="$('#invItm'+$(this).attr('idlink')).toggleClass('hidden');">
							</span>
							
						</span>
					
					</td>
				</tr>
			
				</table>
			
			</label>
			</span>	
		</div>			


		
	</div>

	<div  class="col-sm-3 ">

		<div class="row ab-spaceless " ng-repeat="x in vsl_orhe | AB_noDoubles:'idVSL_ORDE,idVSL_ORST' " 
		ng-if="x.idVIN_ITEM == xItm.idVIN_ITEM && x.idVSL_ORDE > 0 && x.idVSL_ORST > 0 "
		>


		<div class="row" role="presentation" 
			ng-repeat="y in vsl_orhe   | AB_noDoubles:'idVSL_ORDE,idVSL_ORST'  "
			ng-if="x.idVSL_ORDE==y.idVSL_ORDE && x.idVSL_ORST==y.idVSL_ORST"
		>
		
		

<?php 
$stepCode = <<<EOC
			<div  class="col-sm-2 small" >
			
EOC;

// VSL_ORST_STPSQ

		
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


$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_STPSQ","",$grAttr,$laAttr,$inAttr,"");


// $stepCode .= $xtmp->currHtml;
$stepCode .= <<<EOC

<table style="width:100%;">
	<tr>
		<td style="width:50%;" class="ab-border ab-spaceless" >
		{{y.VSL_ORDE_ORLIN}}
		</td>
		<td>&nbsp;</td>
		<td style="width:50%;" class="ab-border ab-spaceless" >
		{{y.VSL_ORST_STPSQ}}
		</td>
	</tr>
</table>

EOC;

$stepCode .= '</div>';

// VSL_ORST_PDATE
$stepCode .= '<div  class="col-sm-4 small" >';
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$hardCode = $xtmp->setDatePick("y.VSL_ORST_PDATE");
$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_PDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
// $stepCode .= $xtmp->currHtml;
$stepCode .= "{{y.VSL_ORST_PDATE}}";
$stepCode .= '</div>';

// VSL_ORST_ORDQT
$stepCode .= '<div  class="col-sm-6 small" ><table style="width:100%;" ><tr>';
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$inAttr["title"] = "VSL_ORST_ORDQT.{{" . "y.idVSL_ORST" . "}}";


$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_ORDQT","",$grAttr,$laAttr,$inAttr,"");

$stepCode .= '<td style="width:15%;text-align:right;" class="ab-border"><strong>';
$stepCode .= '{{y.VSL_ORST_ORDQT}}&nbsp;&nbsp;';
$stepCode .= '</strong></td>';

$stepCode .= '<td style="width:1%;"><input class="hidden" ng-model=" y.VSL_ORST_WARID" /><input class="hidden" ng-model="y.VSL_ORST_STEPS" /><input class="hidden" ng-model=" y.VSL_ORST_LOCID" /></td>';

// VSL_ORST_STEPS


$stepCode .= '<td  style="width:84%;">';


$stepCode .= <<<EOC

  <ul class="nav nav-pills ab-spaceless" role="tablist" ng-if="y.idVSL_ORST>0">
    <li class="dropdown ab-spaceless">
      <a class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;width:150px;max-width:150px;padding:0px;">
	<span class="caret"></span>
	<span  ng-repeat="step in VSL_STEP_LIST" ng-if="step.name==y.VSL_ORST_STEPS" >
		{{step.labeltext}}
	</span>
      	
      </a>
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
$stepCode .= '</td></tr></table></div>';

$stepCode .= <<<EOC


	</div>
		</div>
			</div>
				<div  class="col-sm-6">

					

					<div ng-if="xItm.VIN_ITEM_LOTCT > 0" id="LotAll{{xItm.idVIN_ITEM}}" class="hiddden ab-spaceless small ">
						
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
							<div class="col-sm-1 ab-spaceless text-center">
							Life%
							</div>					
							<div class="col-sm-1 ab-spaceless text-center">
							Del.%
							</div>					
							<div class="col-sm-3 ab-spaceless text-left">
							<span class="ab-border ab-spaceless" >Life%</span><span class="ab-border ab-spaceless" >Months</span><span class="ab-border ab-spaceless" >Del.%</span>
							<span>Qty</span>
							</div>					
							
						</div>
				
						<div class="row " ng-repeat="lotAlloQt in vin_inve  | AB_noDoubles:'idVIN_LSHE' " 
						ng-if="xItm.idVIN_ITEM == lotAlloQt.VIN_LSHE_ITMID && lotAlloQt.VIN_LSHE_SOLDO == 0" >
						 	
							<div class="col-sm-2 ab-border ab-spaceless text-right">
							<input class="hidden" ng-model="lotAlloQt.idVIN_LSHE" />
								{{lotAlloQt.VIN_LSHE_LOTID}}&nbsp;
							</div>
							<div class="col-sm-1 ab-border ab-spaceless text-right">
								<span ng-repeat="lotAlo in vin_inve  | AB_noDoubles:'idVIN_LSLQ' " ng-if="lotAlo.VIN_LSLQ_LOTSQ == lotAlloQt.idVIN_LSHE" >
									{{ lotAlo.VIN_LSLQ_BOHQT }} 
								</span>
								&nbsp;
							
							</div>
							<div class="col-sm-1 ab-border ab-spaceless text-right">
								<span ng-repeat="lotAlo in vin_inve  | AB_noDoubles:'idVIN_LSLQ' " ng-if="lotAlo.VIN_LSLQ_LOTSQ == lotAlloQt.idVIN_LSHE" >
									{{ lotAlo.VIN_LSLQ_ALOQT }} 
								</span>
								&nbsp;
							
							</div>
							<div class="col-sm-1 ab-border ab-spaceless text-right">
								<span ng-repeat="lotAlo in vin_inve  | AB_noDoubles:'idVIN_LSLQ' " ng-if="lotAlo.VIN_LSLQ_LOTSQ == lotAlloQt.idVIN_LSHE" >
									{{ lotAlo.VIN_LSLQ_PURQT }} 
								</span>
								&nbsp;
							
							</div>
							<div class="col-sm-1 ab-border ab-spaceless text-center">
								{{ ABGetDateFn('get-year',lotAlloQt.VIN_LSHE_DOMDA) }}-{{ ABGetDateFn('get-month',lotAlloQt.VIN_LSHE_DOMDA) }}
							</div>
							<div class="col-sm-1 ab-border ab-spaceless text-center">
								{{ ABGetDateFn('get-year',lotAlloQt.VIN_LSHE_DATES) }}-{{ ABGetDateFn('get-month',lotAlloQt.VIN_LSHE_DATES) }}
				
							</div>			
							<div class="col-sm-1 ab-border ab-spaceless text-center small">
								{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + lotAlloQt.VIN_LSHE_DATES) }}%
							</div>			
							<div class="col-sm-1 ab-border ab-spaceless text-center small">
								{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + lotAlloQt.VIN_LSHE_DATES + "," + y.VSL_ORST_PDATE) }}%
							</div>								
				
							<div class="col-sm-2  ab-spaceless" >
								
								<span  ng-if="xItm.specCurrent">
								<table style="width:100%;" >
									<tr class="r" ng-repeat="sp in specSheet[xItm.idVIN_ITEM] | AB_noDoubles:'idVSL_ORST,idVIN_LSHE,idVIN_SSMA' " 
									ng-if="lotAlloQt.idVIN_LSHE==sp.idVIN_LSHE && sp.idVIN_SSMA==xItm.specCurrent && sp.idVSL_ORST==y.idVSL_ORST" >
									<td class="ab-border ab-spaceless text-right" style="width:34%;" >
										{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + sp.VIN_LSHE_DATES) }}%
									</td>
									<td class="ab-border ab-spaceless text-right" style="width:33%;" >
										<span ng-if="ABGetDateFn('diff-today',sp.VIN_LSHE_DATES) > 0" >
										{{ (ABGetDateFn('diff-today',sp.VIN_LSHE_DATES)/12).toFixed(1) }}
										</span>
										<span ng-if="ABGetDateFn('diff-today',sp.VIN_LSHE_DATES) < 0.0000001 " >
										0
										</span>						
									</td>
									<td class="ab-border ab-spaceless text-right" style="width:33%;" >
										{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + sp.VIN_LSHE_DATES + "," + y.VSL_ORST_PDATE) }}%
									</td>
									</tr>
								</table>	
								</span>
							
							</div>
							<div class="col-sm-1  ab-spaceless text-center ab-pointer" 
								onclick="$(this).find('#newId').removeClass($(this).find('#lotId').html()?'':'hidden');$(this).find('input').focus();" 
							>
								<input class="hidden" lotuniqueid="0" ng-model="lotAlloQt.VSL_LSTR_LOTSQ" />
								<span id="lotId" 
								ng-repeat="lotSel in vin_inve  | AB_noDoubles:'idVSL_LSTR' " ng-if="y.idVSL_ORST == lotSel.VSL_LSTR_STPSQ  && lotSel.VSL_LSTR_LOTSQ == lotAlloQt.idVIN_LSHE" >
									<input size=2 class="small ab-borderless" 
										lotallo="0"
										lastval="0"
										orgval="0"
										lotuniqueid="{{lotAlloQt.idVIN_LSHE}}"					
										onchange="$(this).parentsUntil('table').find('[lotaccumulator]').click();"
										
										ng-model="lotSel.VSL_LSTR_ALOQT"
									/>
									
				
									
								</span>
								
								<span id="newId" class="hidden"  >
									<input size=2  class="small ab-borderless"
										lotallo="0"
										lotuniqueid="{{lotAlloQt.idVIN_LSHE}}"
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

					<div id="invItm{{xItm.idVIN_ITEM}}" idtarget="1" class="hidden"  ng-init="xItm.totalCount=0">
						
						<input class="hidden" ng-model="xItm.totalCount" />
						<div class="small" style="font-weight:700;" ng-repeat="invQrec in vin_inve | AB_noDoubles:'idVSL_ORDE' " ng-if="vin_inve.length>0 &&  invQrec.VIN_INVE_ITMID == xItm.idVIN_ITEM"  >
							
	
							<div class="row"  ng-repeat="invQ in invQrec.rowSet   | AB_Sorted:'VSL_ORHE_ORNUM,VSL_ORDE_ORLIN' " ng-if="invQ.idVSL_ORHE != idVSL_ORHE && invQ.VSL_ORST_STEPS > 'EE_SCED' && invQ.VSL_ORST_STEPS < 'JJ_INVO' " >
				
								<div class="col-sm-6 " recount="1" ng-init="xItm.totalCount=xItm.totalCount+1" >
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



				</div>

</div>
<br>
<br>
<br>
<br>
<br>



EOC;

echo $stepCode;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 