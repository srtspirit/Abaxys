
<div  class="row bg-primary ">

	<div class="col-sm-2 ab-spaceless small">
		&nbsp;<label ab-label="VIN_ITEM_ITMID" ></label> <button ng-click="ABupd('UPDATE');" >Save</button>
		<input class=" bg-primary ab-borderless ab-pointer hidden" 
		onmouseover="$(this).attr('title','Set dates to today');" readonly ng-model="today_PDATE" size="8" 
		onclick="$('[vsl_pdate]').click();" 
		ng-init="today_PDATE=ABGetDateFn('get-year','')+'-'+ABGetDateFn('get-month','')+'-'+ABGetDateFn('get-day','')"			
		/>
		
	</div>

	<div class="col-sm-3 ab-spaceless small ">
		<div class="row">
			<div class="col-sm-6 ab-spaceless text-left">
				
				<label ab-label="VSL_ORST_STPSQxxx">				
					Line/Step
				</label>
				&nbsp;&nbsp;
				<label ab-label="VSL_ORST_PDATE">
				Plan Date
				</label> 
				
			</div>	
			<div class="col-sm-6 ab-spaceless  text-left">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label ab-label="STD_QUANTITY_SHORT">
				Quantity
				</label>

			</div>

		</div>
	</div>	
	<div  class="col-sm-6 small ab-border" >

		<ul class="nav nav-pills ab-spaceless" role="tablist" ng-init="initAllocDashBoard()" >
		<li class="dropdown ab-spaceless bg-warning" >
		<a class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;min-width:75px;padding:0px;">
		<span class="caret"></span>
		<span>
			&nbsp;
			 {{stpSel}}
			 &nbsp;&nbsp;&nbsp;
		</span>
		
		</a>
		<ul class="dropdown-menu ab-spaceless" role="menu"  >
		<li class="bg-warning" ng-if="vsl_orhe[0].OrderStatus.IV_VSL_STEPS_VALID.indexOf(step.name)>-1" ng-repeat="step in VSL_STEP_LIST"  >
		<a class="small" ng-click="initAllocDashBoard(step.name,step.labeltext)" style="white-space:nowrap;max-width:150px;padding:0px;">
			
			<span >
		        	&nbsp;&nbsp;{{step.labeltext}}
		        	<span class="glyphicon glyphicon-triangle-right text-primary " ></span>
		       	</span>
			
		</a>
		
		</li>
		<li class="bg-warning" ng-if="stpSelName!=''"  >
		        <a class="small" ng-click="initAllocDashBoard()" style="white-space:nowrap;max-width:150px;padding:0px;">
			Reset step selection
			</a>
		</li>		
		</ul>
		</li>
		</ul>
		<input class="hidden" ng-model="DOC_STEPS" style="color:black" />
		<input class="hidden" ng-model="DOC_ORST" style="color:black" />

	</div>
	<div  class="col-sm-1 small">
		<button id="doccset" class="hid2den" 
		onclick="
		deflectValText(localSetDocDta($('[tcpdform]').text()),'htmlText');
		deflectVal(1,'formSubmit');
		$('[fosub]').click();
		deflectVal(0,'formSubmit');
		" >
		Form
		</button>

	</div>
</div>


	
<div class="row ab-border " role="presentation" ng-repeat="xItm in vsl_orhe | AB_noDoubles:'idVIN_ITEM' | AB_Sorted:'VIN_ITEM_ITMID' " ng-if="xItm.idVSL_ORDE > 0" >

	<div class="col-sm-12">
		<div  class="row small">
			<div class="col-sm-2 ab-spaceless" >
				<div>
					<label >{{ xItm.VIN_ITEM_ITMID }}</label>
					
					<span>{{ xItm.VSL_ORDE_DESCR }}</span>
					<input vsl_pdate="" class="hidden" ng-model="xItm.VSL_PDATE" ng-click="xItm.VSL_PDATE = today_PDATE" ng-init="xItm.VSL_PDATE=xItm.VSL_ORST_PDATE" />
					<input vsl_psel="" class="hidden" ng-model="xItm.sel_idVSL_ORST" />
				</div>
		


				<div ng-repeat="invQ in vin_inve | AB_noDoubles:'idVIN_INVE'  " ng-if="vin_inve.length>0 && invQ.VIN_INVE_ITMID == xItm.idVIN_ITEM" >
			
					<span class="small">
					<label>
					
						<span class="text-primary"><em>On&nbsp;hand:</em></span>{{ invQ.VIN_INVE_BOHQT.length>0?invQ.VIN_INVE_BOHQT:'0' }}&nbsp;
						<span class="text-primary"><em>Allocated:</em></span>{{invQ.VIN_INVE_ALOQT>0?invQ.VIN_INVE_ALOQT:'0'}}&nbsp;
						&nbsp;<span class="text-primary"><em>On&nbsp;PO:</em></span>{{invQ.VIN_INVE_PURQT>0?invQ.VIN_INVE_PURQT:'0'}}&nbsp;
					
					</label>
					</span>	
				</div>			

			</div>
			<div class="col-sm-3 ab-spaceless text-right">

				<div class="row ab-spaceless  {{ABGetDateFn('diff-today',yStep.VSL_ORST_PDATE)<ABGetDateFn('diff-today',today_PDATE)?'text-danger':''}}"  
				ng-repeat="xLine in vsl_orhe | AB_noDoubles:'idVSL_ORDE,idVSL_ORST' | AB_Sorted:'VSL_ORST_PDATE' " 
				ng-if="xLine.idVIN_ITEM == xItm.idVIN_ITEM && xLine.idVSL_ORDE > 0 && xLine.idVSL_ORST > 0 " ng-in2it="xItm.VSL_PDATE = xItm.VSL_PDATE>xLine.VSL_ORST_PDATE?xLine.VSL_ORST_PDATE:xItm.VSL_PDATE" 
				>
					<div class="col-sm-2">
						<table style="width:100%;">
							<tr>
								<td style="width:49%;" class="ab-spaceless" >
								{{xLine.VSL_ORDE_ORLIN}}
								</td>
								<td style="width:2%;text-align:center;" class="text-primary ">
									<span>&#124;
									</span>
								</td>
								<td style="width:49%;" class="ab-spaceless" >
								{{xLine.VSL_ORST_STPSQ}}
								</td>
							</tr>
						</table>					
					</div>
					<div class="col-sm-4">

						<span class="ab-pointer" title="Change delivery date" 
						ng-click="xItm.VSL_PDATE=xLine.VSL_ORST_PDATE;"
						neg-if="ABGetDateFn('diff-today',xLine.VSL_ORST_PDATE)!=ABGetDateFn('diff-today',xItm.VSL_PDATE)"  >
							{{xLine.VSL_ORST_PDATE}}
						</span>
				
					</div>
					<div class="col-sm-1">
					  {{xLine.VSL_ORST_ORDQT}}
					</div>
					<div class="col-sm-3">

						<span  ng-repeat="step in VSL_STEP_LIST" ng-if="step.name==xLine.VSL_ORST_STEPS" >
							&nbsp;{{step.labeltext}}&nbsp;
						</span>

					</div>
					<div class="col-sm-1">

						<span class="ab-pointer" 
							ng-if="xLine.VSL_ORST_STEPS<stpSelName || xLine.VSL_ORST_STEPS==stpSelName"  
							ng-click="toggleAllocStepSel(xLine.idVSL_ORST);" 
						>
							<input type="checkbox"	class="glyph2icon glyphic2on-unchecked" style="font-size:medium;"
								ng-if="(',' + DOC_ORST + ',').indexOf(','+xLine.idVSL_ORST+',')==-1" />
								
							<input  type="checkbox"	checked class="glyp2hicon glyph2icon-expand " style="font-size:medium;"
								ng-if="(',' + DOC_ORST + ',').indexOf(','+xLine.idVSL_ORST+',')>-1" />
						</span>	
		
					</div>
						
				</div>
			
			</div>
			<div class="col-sm-5 ab-spaceless ">
				
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
				</div>
				
				<div ng-if="xItm.VIN_ITEM_LOTCT > 0" id="LotAll{{xItm.idVIN_ITEM}}" class="hiddden ab-spaceless small ">
					<input class="hidden" ng-model="lotAlloQt.allocDirty" />
					<div class="row  ab-spaceless" 
					style="border-color:transparent;border:none;border-left:solid;border-width:5px;border-color:{{lotAlloQt.lifeColor}};"
					ng-repeat="lotAlloQt in vin_inve  | AB_noDoubles:'idVIN_LSHE' | AB_sortReverse:'VIN_LSHE_DOMDA'  " 
					ng-if="xItm.idVIN_ITEM == lotAlloQt.VIN_LSHE_ITMID && lotAlloQt.VIN_LSHE_SOLDO == 0" >
					 	
						<div class="col-sm-2 ab-border ab-spaceless text-right">
						<input class="hidden" ng-model="lotAlloQt.lifeColor" size=5 />
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
						<div class="col-sm-2 ab-spaceless text-center small">
								<table class="text-center" style="width:100%;font-weight:900;" >
								<tr>
								<td class="ab-border ab-spaceless text-center">
									{{ ABGetDateFn('get-year',lotAlloQt.VIN_LSHE_DOMDA) }}-{{ ABGetDateFn('get-month',lotAlloQt.VIN_LSHE_DOMDA) }}
								</td>
								<td class="ab-border ab-spaceless text-center">
									{{ ABGetDateFn('get-year',lotAlloQt.VIN_LSHE_DATES) }}-{{ ABGetDateFn('get-month',lotAlloQt.VIN_LSHE_DATES) }}
								</td>
								</tr>
								</table>
							
						</div>
						<div ng-if="!xItm.specCurrent" class="col-sm-2  ab-spaceless" >			
						
							<table 
							style="width:100%;border-color:transparent;border:none;border-bottom:solid;border-width:2px;border-color:{{lotAlloQt.lifeColor}};" 
							 >
							<tr>
							<td style="width:33%;"  class=" ab-border ab-spaceless text-center small"
							ng-init="lotAlloQt.lifeColor = setLifeColors(ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + ',' + lotAlloQt.VIN_LSHE_DATES))" 
							>
								{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + lotAlloQt.VIN_LSHE_DATES) }}%
							</td>			
							<td style="width:33%;"  class=" ab-border ab-spaceless text-center small">
								{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + lotAlloQt.VIN_LSHE_DATES + "," + xItm.VSL_PDATE) }}%
							</td>								
							
							<td style="width:34%;"  class=" ab-border ab-spaceless text-center small">
								<span ng-if="ABGetDateFn('diff-today',lotAlloQt.VIN_LSHE_DATES) > 0" >
								{{ (ABGetDateFn('diff-today',lotAlloQt.VIN_LSHE_DATES)/12).toFixed(1) }}
								</span>
								<span ng-if="ABGetDateFn('diff-today',lotAlloQt.VIN_LSHE_DATES) < 0.0000001 " >
								0
								</span>

							</td>	
							</tr>
							</table>

						</div>				
						<div ng-if="xItm.specCurrent" class="col-sm-2  ab-spaceless" >
							
							
							<table 
							style="width:100%;border-color:transparent;border:none;border-bottom:solid;border-width:2px;border-color:{{lotAlloQt.lifeColor}};" >
							
								<tr class="r" ng-repeat="sp in specSheet[xItm.idVIN_ITEM] | AB_noDoubles:'idVIN_LSHE,idVIN_SSMA' " 
								
								ng-if="lotAlloQt.idVIN_LSHE==sp.idVIN_LSHE && sp.idVIN_SSMA==xItm.specCurrent" >
								
								<td class=" ab-border ab-spaceless text-center small" style="width:33%;" 
								ng-init="lotAlloQt.lifeColor = setLifeColors(ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + ',' + sp.VIN_LSHE_DATES))" 
								>
									{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + sp.VIN_LSHE_DATES) }}%
								</td>
			
								<td class=" ab-border ab-spaceless text-center small" style="width:33%;" >
									{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + sp.VIN_LSHE_DATES + "," + xItm.VSL_PDATE) }}%
								</td>
								<td class="ab-border ab-spaceless text-center small " style="width:34%;" >
									<span ng-if="ABGetDateFn('diff-today',sp.VIN_LSHE_DATES) > 0" >
									{{ (ABGetDateFn('diff-today',sp.VIN_LSHE_DATES)/12).toFixed(1) }}
									</span>
									<span ng-if="ABGetDateFn('diff-today',sp.VIN_LSHE_DATES) < 0.0000001 " >
									0
									</span>						
								</td>									
								</tr>
							</table>	
							
						
						</div>
					
					
						<div  ng-if="xItm.sel_idVSL_ORST>0" class="col-sm-2  ab-spaceless text-left " >

							<table class="ab-spaceless " style="width:100%;" >
							<tr>
							<td style="width:50%;" class=" ab-spaceless text-center">
								
							<span ng-repeat="xlSel in vin_inve  | AB_noDoubles:'idVSL_LSTR,VSL_LSTR_STPSQ' " 
							ng-if="xItm.sel_idVSL_ORST == xlSel.VSL_LSTR_STPSQ " >
							
								<span class="hidden" ng-init="lotAlloQt.newALOQT=0">.</span>
								<span class="hidden" ng-init="lotAlloQt.orgval=0">.</span>
								
							</span>
															
							<span ng-repeat="xlSel in vin_inve  | AB_noDoubles:'idVSL_LSTR,VSL_LSTR_STPSQ' " 
							ng-if="xItm.sel_idVSL_ORST == xlSel.VSL_LSTR_STPSQ  && xlSel.VSL_LSTR_LOTSQ == lotAlloQt.idVIN_LSHE" >
								&nbsp;[&nbsp;<label ng-init="lotAlloQt.newALOQT=xlSel.VSL_LSTR_ALOQT;lotAlloQt.orgval=xlSel.VSL_LSTR_ALOQT" >
								{{xlSel.VSL_LSTR_ALOQT}}
								</label>&nbsp;]
								<input class="hidden" ng-model="xlSel.VSL_LSTR_ALOQT" />
							</span>
							</td>
							<td style="width:50%;" class="ab-spaceless text-center small">
							<input  ng-model="lotAlloQt.newALOQT" size=2 
							
							id="lotAlloQt{{xItm.sel_idVSL_ORST}}-{{lotAlloQt.idVIN_LSHE}}"
							vsl_orst="{{xItm.sel_idVSL_ORST}}"
							class="small ab-spaceless {{ lotAlloQt.newALOQT!=lotAlloQt.orgval?'bg-warning':''}}"
							onchange="$('#lotSel' + $(this).attr('vsl_orst')).click();"
							/>
							<input class="hidden" size=2 ng-model="lotAlloQt.orgval" />
							</td>
							</tr>
							</table>

							
						</div>


					</div>
				
				</div>	
			
			</div>
			<div class="col-sm-2 ab-spaceless">
				<div class="row" ng-if="xItm.VIN_ITEM_LOTCT > 0" >
					
					<div class="col-sm-8" >
						Spec. selection:
						<label >
						      <select ng-options="spc.idVIN_SSMA as spc.VIN_SSMA_SPEID for spc in specSheet[xItm.idVIN_ITEM] | AB_noDoubles:'idVIN_SSMA' " 
						      ng-model="xItm.specCurrent" >
						        <option  value="">
						        	None			        	
						        </option>
						       
						      </select>			
						</label>      
					</div>	
					<div class="col-sm-4" >
						Lots Selected
					</div>
				</div>		
			</div>	
			
		</div>	
	</div>	
	<div class="col-sm-2 ab-spaceless small">



		
	</div>

	<div  class="col-sm-3 ">
	</div>
			
				<div  class="col-sm-6 ab-border">

					

					<div ng-if="xItm.VIN_ITEM_LOTCT > 0" id="LotAll{{xItm.idVIN_ITEM}}" class="hiddden ab-spaceless small ">
						<input class="hidden" ng-model="lotAlloQt.allocDirty" />
						<div class="row ab-border ab-spaceless" 
						style="border-color:transparent;border:none;border-left:solid;border-width:5px;border-color:{{lotAlloQt.lifeColor}};"
						ng-repeat="lotAlloQt in vin_inve  | AB_noDoubles:'idVIN_LSHE' | AB_sortReverse:'VIN_LSHE_DOMDA'  " 
						ng-if="xItm.idVIN_ITEM == lotAlloQt.VIN_LSHE_ITMID && lotAlloQt.VIN_LSHE_SOLDO == 0" >
						 	
							<div class="col-sm-2 ab-border ab-spaceless text-right">
							<input class="hidden" ng-model="lotAlloQt.lifeColor" size=5 />
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
							<div class="col-sm-2 ab-spaceless text-center small">
									<table class="text-center" style="width:100%;font-weight:900;" >
									<tr>
									<td class="ab-border ab-spaceless text-center">
										{{ ABGetDateFn('get-year',lotAlloQt.VIN_LSHE_DOMDA) }}-{{ ABGetDateFn('get-month',lotAlloQt.VIN_LSHE_DOMDA) }}
									</td>
									<td class="ab-border ab-spaceless text-center">
										{{ ABGetDateFn('get-year',lotAlloQt.VIN_LSHE_DATES) }}-{{ ABGetDateFn('get-month',lotAlloQt.VIN_LSHE_DATES) }}
									</td>
									</tr>
									</table>
								
							</div>
							<div ng-if="!xItm.specCurrent" class="col-sm-2  ab-spaceless" >			
							
								<table 
								style="width:100%;border-color:transparent;border:none;border-bottom:solid;border-width:2px;border-color:{{lotAlloQt.lifeColor}};" 
								 >
								<tr>
								<td style="width:33%;"  class=" ab-border ab-spaceless text-center small"
								ng-init="lotAlloQt.lifeColor = setLifeColors(ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + ',' + lotAlloQt.VIN_LSHE_DATES))" 
								>
									{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + lotAlloQt.VIN_LSHE_DATES) }}%
								</td>			
								<td style="width:33%;"  class=" ab-border ab-spaceless text-center small">
									{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + lotAlloQt.VIN_LSHE_DATES + "," + xItm.VSL_PDATE) }}%
								</td>								
								
								<td style="width:34%;"  class=" ab-border ab-spaceless text-center small">
									<span ng-if="ABGetDateFn('diff-today',lotAlloQt.VIN_LSHE_DATES) > 0" >
									{{ (ABGetDateFn('diff-today',lotAlloQt.VIN_LSHE_DATES)/12).toFixed(1) }}
									</span>
									<span ng-if="ABGetDateFn('diff-today',lotAlloQt.VIN_LSHE_DATES) < 0.0000001 " >
									0
									</span>
	
								</td>	
								</tr>
								</table>

							</div>				
							<div ng-if="xItm.specCurrent" class="col-sm-2  ab-spaceless" >
								
								
								<table 
								style="width:100%;border-color:transparent;border:none;border-bottom:solid;border-width:2px;border-color:{{lotAlloQt.lifeColor}};" >
								
									<tr class="r" ng-repeat="sp in specSheet[xItm.idVIN_ITEM] | AB_noDoubles:'idVIN_LSHE,idVIN_SSMA' " 
									
									ng-if="lotAlloQt.idVIN_LSHE==sp.idVIN_LSHE && sp.idVIN_SSMA==xItm.specCurrent" >
									
									<td class=" ab-border ab-spaceless text-center small" style="width:33%;" 
									ng-init="lotAlloQt.lifeColor = setLifeColors(ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + ',' + sp.VIN_LSHE_DATES))" 
									>
										{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + sp.VIN_LSHE_DATES) }}%
									</td>
				
									<td class=" ab-border ab-spaceless text-center small" style="width:33%;" >
										{{ ABGetDateFn('diff-perc',lotAlloQt.VIN_LSHE_DOMDA + "," + sp.VIN_LSHE_DATES + "," + xItm.VSL_PDATE) }}%
									</td>
									<td class="ab-border ab-spaceless text-center small " style="width:34%;" >
										<span ng-if="ABGetDateFn('diff-today',sp.VIN_LSHE_DATES) > 0" >
										{{ (ABGetDateFn('diff-today',sp.VIN_LSHE_DATES)/12).toFixed(1) }}
										</span>
										<span ng-if="ABGetDateFn('diff-today',sp.VIN_LSHE_DATES) < 0.0000001 " >
										0
										</span>						
									</td>									
									</tr>
								</table>	
								
							
							</div>
						
						
							<div  ng-if="xItm.sel_idVSL_ORST>0" class="col-sm-2  ab-spaceless text-left " >

								<table class="ab-spaceless " style="width:100%;" >
								<tr>
								<td style="width:50%;" class=" ab-spaceless text-center">
									
								<span ng-repeat="xlSel in vin_inve  | AB_noDoubles:'idVSL_LSTR,VSL_LSTR_STPSQ' " 
								ng-if="xItm.sel_idVSL_ORST == xlSel.VSL_LSTR_STPSQ " >
								
									<span class="hidden" ng-init="lotAlloQt.newALOQT=0">.</span>
									<span class="hidden" ng-init="lotAlloQt.orgval=0">.</span>
									
								</span>
																
								<span ng-repeat="xlSel in vin_inve  | AB_noDoubles:'idVSL_LSTR,VSL_LSTR_STPSQ' " 
								ng-if="xItm.sel_idVSL_ORST == xlSel.VSL_LSTR_STPSQ  && xlSel.VSL_LSTR_LOTSQ == lotAlloQt.idVIN_LSHE" >
									&nbsp;[&nbsp;<label ng-init="lotAlloQt.newALOQT=xlSel.VSL_LSTR_ALOQT;lotAlloQt.orgval=xlSel.VSL_LSTR_ALOQT" >
									{{xlSel.VSL_LSTR_ALOQT}}
									</label>&nbsp;]
									<input class="hidden" ng-model="xlSel.VSL_LSTR_ALOQT" />
								</span>
								</td>
								<td style="width:50%;" class="ab-spaceless text-center small">
								<input  ng-model="lotAlloQt.newALOQT" size=2 
								
								id="lotAlloQt{{xItm.sel_idVSL_ORST}}-{{lotAlloQt.idVIN_LSHE}}"
								vsl_orst="{{xItm.sel_idVSL_ORST}}"
								class="small ab-spaceless {{ lotAlloQt.newALOQT!=lotAlloQt.orgval?'bg-warning':''}}"
								onchange="$('#lotSel' + $(this).attr('vsl_orst')).click();"
								/>
								<input class="hidden" size=2 ng-model="lotAlloQt.orgval" />
								</td>
								</tr>
								</table>

								
							</div>

<!--
							<div  ng-if="xItm.sel_idVSL_ORST>0" class="col-sm-2  ab-spaceless text-left ab-pointer " >	
							</div>									
-->							

						</div>
					
					</div>	

					<div id="invItm{{xItm.idVIN_ITEM}}" idtarget="1" class="hidden"  ng-init="xItm.totalCount=0">
	
							<div><input class="hidden" ng-model="xItm.totalCount" /><div>
	
							<div class="row" >
				
								<div class="col-sm-3 text-left text-primary" >
									<span ab-label="STD_ORNUM_SH" >Order</span>
					
								</div>
								<div class="col-sm-4 text-left">
									<span class="text-primary"><em ab-label="VSL_ORHE_CUSPO" >Ref</em>:</span>
									
								</div>
								<div class="col-sm-4 text-left text-primary small ">
									Planned Date
								</div>
								
							</div>
						
						<div class="row small" style="font-weight:700;" ng-repeat="invQrec in vin_inve | AB_noDoubles:'idVSL_ORDE' " ng-if="vin_inve.length>0 &&  invQrec.VIN_INVE_ITMID == xItm.idVIN_ITEM"  >
							
	
							<div class="row"  ng-repeat="invQ in invQrec.rowSet   | AB_Sorted:'VSL_ORHE_ORNUM,VSL_ORDE_ORLIN' " ng-if="invQ.idVSL_ORHE != idVSL_ORHE && invQ.VSL_ORST_STEPS > 'EE_SCED' && invQ.VSL_ORST_STEPS < 'JJ_INVO' " >
				
								<div class="col-sm-3 text-left" recount="1" ng-init="xItm.totalCount=xItm.totalCount+1" >
								{{ invQ.VSL_ORHE_ORNUM  }}&nbsp;{{invQ.VGB_CUST_BPNAM}}
								</div>
								<div class="col-sm-3 text-left">
									{{ invQ.VSL_ORHE_CUSPO  }}
								</div>
								<div class="col-sm-4 text-left">
									{{ invQ.VSL_ORST_PDATE }}&nbsp;
									&nbsp;&nbsp;<span class="text-primary"><em ab-label="STD_QUANTITY_SHORT" >Qty</em>:</span>
									&nbsp;{{ invQ.VSL_ORST_ORDQT  }}&nbsp;
				
									<span ng-repeat="stp in VSL_STEP_LIST" ng-if="stp.name == invQ.VSL_ORST_STEPS">
				 					{{stp.labeltext}} 
				 					</span>
								</div>
								
							</div>
						
						</div>
					
					</div>


-->
				</div>

			</div>
		</div>
</div>

EOC;
echo $stepCode;
 require_once "VSL_ORDER_FORMS.php";
