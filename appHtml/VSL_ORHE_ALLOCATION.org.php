<div class="row" role="presentation" ng-repeat="xItm in vsl_orhe | AB_noDoubles:'idVIN_ITEM' | AB_Sorted:'VIN_ITEM_ITMID' " ng-if="xItm.idVSL_ORDE > 0" >

	<div  class="col-sm-12 >
		<div  class="row bg-primary small">
		
			<div class="col-sm-2 ab-spaceless">
				
				<label ab-label="VIN_ITEM_ITMID" >
					 {{ xItm.VIN_ITEM_ITMID }}
				</label>			
			</div>
	

			<div class="col-sm-1 ab-spaceless">
				<label ab-label="VSL_ORST_STPSQxxx">				
					Seq.
				</label>
			</div>
			<div class="col-sm-2 ab-spaceless">
				<label ab-label="VSL_ORST_PDATE">
				Plan Date
				</label> 
			</div>	
			<div class="col-sm-2 ab-spaceless">
				<label ab-label="STD_QUANTITY_SHORT">
				Quantity
				</label>
			</div>	
			<div class="col-sm-2 ab-spaceless">
				<label ab-label="VSL_ORST_STEPS">
				Seq. Steps;
				</label>
			</div>
			<div  class="col-sm-2 ab-border " >&nbsp;</div>		
		
		</div>
	</div>
	
	<div class="col-sm-2 ab-spaceless">
		<div>
			<label >
				 {{ xItm.VIN_ITEM_ITMID }}222
			</label>			
			<span>
				 {{ xItm.VSL_ORDE_DESCR }}
			</span>
			
		</div>

		<div >
			<label ng-if="xItm.VIN_ITEM_LOTCT > 0">
			      <select ng-options="spc.idVIN_SSMA as spc.VIN_SSMA_SPEID for spc in specSheet[xItm.idVIN_ITEM] | AB_noDoubles:'idVIN_SSMA' " 
			      ng-model="xItm.specCurrent" >
			        <option ng-if="!xItm.specCurrent" value="">Select Spec Sheet</option>
			      </select>			
			</label>      
		</div>	
		
	</div>

	<div  class="col-sm-8">
	<div class="rowb-spaceless  ab-border " ng-repeat="x in vsl_orhe | AB_noDoubles:'idVSL_ORDE.idVSL_ORST' " 
						ng-if="x.idVIN_ITEM == xItm.idVIN_ITEM && x.idVSL_ORDE > 0 && x.idVSL_ORST > 0 "
	>


		<div class="row" role="presentation" 
			ng-repeat="y in vsl_orhe   | AB_noDoubles:'idVSL_ORDE,idVSL_ORST'  "
			ng-if="x.idVSL_ORDE==y.idVSL_ORDE"
		>
		
		

<?php 
$stepCode = <<<EOC
			<div  class="col-sm-1" >
			
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
$inAttr["size"] = "2";


$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_STPSQ","",$grAttr,$laAttr,$inAttr,"");
$stepCode .= $xtmp->currHtml;
$stepCode .= '</div>';

// VSL_ORST_PDATE
$stepCode .= '<div  class="col-sm-2" >';
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$hardCode = $xtmp->setDatePick("y.VSL_ORST_PDATE");
$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_PDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
$stepCode .= $xtmp->currHtml;
$stepCode .= '</div>';

// VSL_ORST_ORDQT
$stepCode .= '<div  class="col-sm-1" >';
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$inAttr["title"] = "VSL_ORST_ORDQT.{{" . "y.idVSL_ORST" . "}}";


$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_ORDQT","",$grAttr,$laAttr,$inAttr,"");
$stepCode .= $xtmp->currHtml;
$stepCode .= '</div>';

$stepCode .= '<div  class="col-sm-2" ><input class="hidden" ng-model=" y.VSL_ORST_WARID" /><input class="hidden" ng-model="y.VSL_ORST_STEPS" /><input class="hidden" ng-model=" y.VSL_ORST_LOCID" /></div>';

// VSL_ORST_STEPS


$stepCode .= '<div  class="col-sm-2" >';


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
$stepCode .= '</div>';

$stepCode .= <<<EOC

	<div  class="col-sm-2"  ng-if="y.VIN_ITEM_LOTCT > 0" class="small" >

	
		<div lot-links="on" >
		
			<span lotlist="0"  >
				<span  class="hidden" ng-repeat="lot in vsl_orhe   | AB_noDoubles:'idVSL_LSTR'  " ng-if="y.idVSL_ORST == lot.VSL_LSTR_STPSQ" >
				{{lot.idVSL_LSTR}}:{{lot.VSL_LSTR_ALOQT}},
				</span>
			</span>
			
			<input class="hidden" ng-model="y.lotSel" size=5 />
			
			<input class="hidden" lotaccumulator="0" value="" 
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
			
			<span lid="#LotQt{{y.idVSL_ORST}}" class="btn-sm ab-pointer small text-primary"  orst="{{y.VSL_ORST}}"
			onclick="	
			$($(this).attr('lid')).toggleClass('hidden');
			$(this).parent().find('[lotSelected]').click();
			" >
			<span class="glyphicon glyphicon-th-list small"></span>
			<span selCountDsp="on"></span>
			</span>
			
		</div>

	</div>
	
	<div ng-if="x.VIN_ITEM_LOTCT > 0" id="LotQt{{y.idVSL_ORST}}" class=" row hidden ab-spaceless ">
		
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

		<div class="row "   
			
		 	ng-repeat="lotQt in vin_inve  | AB_noDoubles:'idVIN_LSHE' " ng-if="x.idVIN_ITEM == lotQt.VIN_LSHE_ITMID && lotQt.VIN_LSHE_SOLDO == 0" >
		 	
			<div class="col-sm-2 ab-border ab-spaceless text-right">
			<input class="hidden" ng-model="lotQt.idVIN_LSHE" />
				{{lotQt.VIN_LSHE_LOTID}}&nbsp;
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
			<div class="col-sm-1 ab-border ab-spaceless text-center">
				{{ ABGetDateFn('get-year',lotQt.VIN_LSHE_DATES) }}-{{ ABGetDateFn('get-month',lotQt.VIN_LSHE_DATES) }}

			</div>			
			<div class="col-sm-1 ab-border ab-spaceless text-center small">
				{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + lotQt.VIN_LSHE_DATES) }}%
			</div>			
			<div class="col-sm-1 ab-border ab-spaceless text-center small">
				{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + lotQt.VIN_LSHE_DATES + "," + y.VSL_ORST_PDATE) }}%
			</div>								

			<div class="col-sm-2  ab-spaceless" >
				
				<span  ng-if="x.specCurrent">
				<table style="width:100%;" >
					<tr class="r" ng-repeat="sp in specSheet[x.idVIN_ITEM] | AB_noDoubles:'idVSL_ORST,idVIN_LSHE,idVIN_SSMA' " 
					ng-if="lotQt.idVIN_LSHE==sp.idVIN_LSHE && sp.idVIN_SSMA==x.specCurrent && sp.idVSL_ORST==y.idVSL_ORST" >
					<td class="ab-border ab-spaceless text-right" style="width:34%;" >
						{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + sp.VIN_LSHE_DATES) }}%
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
						{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + sp.VIN_LSHE_DATES + "," + y.VSL_ORST_PDATE) }}%
					</td>
					</tr>
				</table>	
				</span>
			
			</div>
			<div class="col-sm-1  ab-spaceless text-center ab-pointer" 
				onclick="$(this).find('#newId').removeClass($(this).find('#lotId').html()?'':'hidden');$(this).find('input').focus();" 
			>
				<input class="hidden" lotuniqueid="0" ng-model="lotQt.VSL_LSTR_LOTSQ" />
				<span id="lotId" 
				ng-repeat="lotSel in vin_inve  | AB_noDoubles:'idVSL_LSTR' " ng-if="y.idVSL_ORST == lotSel.VSL_LSTR_STPSQ  && lotSel.VSL_LSTR_LOTSQ == lotQt.idVIN_LSHE" >
					<input size=2 class="small ab-borderless" 
						lotallo="0"
						lastval="0"
						orgval="0"
						lotuniqueid="{{lotQt.idVIN_LSHE}}"					
						onchange="$(this).parentsUntil('table').find('[lotaccumulator]').click();"
						
						ng-model="lotSel.VSL_LSTR_ALOQT"
					/>
					

					
				</span>
				
				<span id="newId" class="hidden"  >
					<input size=2  class="small ab-borderless"
						lotallo="0"
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

</div>
d<v class="col-sm-1i>Avll</div>>>




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
			
			
			<div class="row"  ng-repeat="invQ in invQrec.rowSet   | AB_Sorted:'VSL_ORHE_ORNUM,VSL_ORDE_ORLIN' " ng-if="invQ.idVSL_ORHE != idVSL_ORHE && invQ.VSL_ORST_STEPS > 'EE_SCED' && invQ.VSL_ORST_STEPS < 'JJ_INVO' " >

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


EOC;

echo $stepCode;

?>




			
</div>
</div>
