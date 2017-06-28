<div  class="row bg-primary ">


	<div class="col-sm-3  ab-spaceless" >
		<table>
		<tr>
			<td class="bg-warning ab-spaceless" style="padding-top:2px;" >
				&nbsp;
				<span class="glyphicon glyphicon-floppy-disk ab-pointer text-primary ab-spaceless" 
					ng-click="ABupd('UPDATE');" 
				>
				</span>
				&nbsp;
			</td>
			<td class="ab-spaceless small" style="padding-top:2px;" >
				&nbsp;<label ab-label="VIN_ITEM_ITMID" ></label> 
				<input class=" bg-primary ab-borderless ab-pointer hidden" 
				onmouseover="$(this).attr('title','Set dates to today');" readonly ng-model="today_PDATE" size="8" 
				onclick="$('[vsl_pdate]').click();" 
				ng-init="today_PDATE=ABGetDateFn('get-year','')+'-'+ABGetDateFn('get-month','')+'-'+ABGetDateFn('get-day','')"			
				/>
				
			</td>			
		</tr>
		</table>	
	</div>


	<div class="col-sm-3 ab-spaceless small ">
		<div class="row">
			<div class="col-sm-6 ab-spaceless text-left" style="padding-top:2px;">
				
				<label ab-label="VSL_ORST_STPSQxxx">				
					Line/Step
				</label>
				&nbsp;&nbsp;
				<label ab-label="VSL_ORST_PDATE">
				Plan Date
				</label> 
				
			</div>	
			<div class="col-sm-4 ab-spaceless  text-left" style="padding-top:2px;">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label ab-label="STD_QUANTITY_SHORT">
				Quantity
				</label>

			</div>
			<div class="col-sm-2 ab-spaceless  text-left" style="padding-top:2px;">
				&nbsp;<label ng-if="stpSelName!=''" class="bg-warning text-primary ab-pointer ab-spaceless" onclick="deflectVal('','DOC_ORST');$('[xlineSel]').click();" >&nbsp;All&nbsp;</label>
			</div>

		</div>
	</div>	
	<div  class="col-sm-2 small text-right" style="padding-top:2px;" >
		

		<ul class="nav nav-pills ab-spaceless " role="tablist" ng-init="initAllocDashBoard()" >
		<li class="dropdown ab-spaceless {{stepRetract!=true?'bg-warning':'bg-danger'}} " >
		<a class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;min-width:75px;padding:0px;">
		<span class="caret"></span>
		<span>
			&nbsp;
			 {{stpSel}}
			 &nbsp;&nbsp;&nbsp;
		</span>
		
		</a>
		<ul class="dropdown-menu ab-spaceless" role="menu"  >
		<li class="bg-warning" 
		ng-if="vsl_orhe[0].IV_VSL_STEPS_VALID.indexOf(step.name)>-1 && step.shade!='hidden' " 
		ng-repeat="step in VSL_STEP_LIST"  >
		<a class="small" ng-click="initAllocDashBoard(step.name,step.labeltext)" style="white-space:nowrap;max-width:150px;padding:0px;">
			
			<span >
							
		        	&nbsp;&nbsp;
		        	<span ng-if="stepRetract==true" class="glyphicon glyphicon-triangle-left text-danger " ></span>
		        	{{step.labeltext}}
		        	<span ng-if="stepRetract!=true" class="glyphicon glyphicon-triangle-right text-primary " ></span>
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
	<div  class="col-sm-1 small text-left" style="padding-top:2px;" >
		 Retract 
	
	</div>

	<div  class="col-sm-1 small" style="padding-top:2px;">
	
	

		<ul class="nav nav-pills ab-spaceless" role="tablist" >
		<li class="dropdown ab-spaceless bg-warning" >
		<a class="dropdown-toggle " data-toggle="dropdown"
		 ng-click="initOrderORSI();" 
		 style="white-space:nowrap;min-width:75px;padding:0px;">
		
		<span class="caret"></span>
		<span >
			&nbsp;
			 {{formSel}}
			 &nbsp;&nbsp;
		</span>
		
		</a>
		
		<ul class="dropdown-menu ab-spaceless" role="menu"   ng-init="selectCurrentForm();">
		<li class="bg-warning" ng-repeat="docs in vsl_orheOrsi[0].rowSet | AB_noDoubles:'idVSL_ORSI'"  ng-if="docs.VSL_ORSI_ORNUM==idVSL_ORHE" >
		
		<a class="small" 
		ng-repeat="step in VSL_STEP_LIST" ng-if="step.name==docs.VSL_ORSI_STEPS && step.shade!='hidden' && step.form.length>0"
		ng-click="selectCurrentForm(step,docs.VSL_ORSI_GRPID,docs.idVSL_ORSI )"
		style="white-space:nowrap;max-width:150px;padding:0px;">
			
			<span  >
		        	&nbsp;&nbsp;{{step.labeltext}}
		        	<span class="glyphicon glyphicon-triangle-right text-primary " ></span>
		        	#{{ docs.VSL_ORSI_GRPID }}
		       	</span>
			
		</a>
		
		</li>
		<li class="bg-warning" ng-if="formSelName!=''"  >
		        <a class="small" ng-click="selectCurrentForm();" style="white-space:nowrap;max-width:150px;padding:0px;">
			Reset form selection
			</a>
		</li>		
		</ul>
		</li>
		</ul>


	
		<button id="doccset" class="hidden" 
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


	
<div class="row ab-border small" role="presentation" ng-repeat="xItm in vsl_orhe | AB_noDoubles:'idVIN_ITEM' | AB_Sorted:'VIN_ITEM_ITMID' " ng-if="xItm.idVSL_ORDE > 0" >

			





<!--
	<div class="col-sm-12">
		<div  class="row small">
		
-->
			<div class="col-sm-3 ab-spaceless" >
				<div>
					<label >{{ xItm.VIN_ITEM_ITMID }}</label>
					
					<span>{{ xItm.VSL_ORDE_DESCR }}</span>
					<input vsl_pdate="" class="hidden" ng-model="xItm.VSL_PDATE" ng-click="xItm.VSL_PDATE = today_PDATE" ng-init="xItm.VSL_PDATE=xItm.VSL_ORST_PDATE" />
					<input vsl_psel="" class="hidden" ng-model="xItm.sel_idVSL_ORST" />
					<input class="hidden" ng-model="xItm.sel_VSL_ORDE_LLINK" ng-init="xItm.sel_VSL_ORDE_LLINK=0"  />
				</div>
		


				<div ng-repeat="invQ in vin_inve | AB_noDoubles:'idVIN_INVE'  " ng-if="vin_inve.length>0 && invQ.VIN_INVE_ITMID == xItm.idVIN_ITEM" >
			
					<span class="small">
					<label>
					
						<span class="text-primary"><em>On&nbsp;hand:</em></span>{{ invQ.VIN_INVE_BOHQT.length>0?invQ.VIN_INVE_BOHQT:'0' }}&nbsp;
						<span class="text-primary"><em>Allocated:</em></span>{{invQ.VIN_INVE_ALOQT>0?invQ.VIN_INVE_ALOQT:'0'}}&nbsp;
						&nbsp;<span class="text-primary"><em>On&nbsp;PO:</em></span>{{invQ.VIN_INVE_PURQT>0?invQ.VIN_INVE_PURQT:'0'}}&nbsp;
					
					</label>
					</span>	
					
					<div class="row" style="vertical-align:top;"  >
									
						<div class="col-sm-12 text-primary" >
							
							<span  ng-if="xItm.hasPending > 0"   class="ab-pointer"
							idlink="{{xItm.idVSL_ORDE}}" 
							onclick="$('#invAlloQ'+$(this).attr('idlink')).toggleClass('hidden');" >
							 
								<span class="glyphicon glyphicon-th-list "  >
								</span>
	
								<span class="small"  ng-if="xItm.hasPending > 0"  >
									<strong>Has order lines pending</strong>
									
								</span>
							</span>	
							
							<span class="small" ng-if="xItm.hasPending < 1" >
								<strong>No orders pending</strong>
							</span>
							
						</div>	
				
					</div>	

					



				<!-- end of pending -->
									
				</div>			

			</div>
			<div class="col-sm-3 ab-spaceless text-right">

				<div class="row  ab-spaceless {{xItm.sel_idVSL_ORST==xLine.idVSL_ORST?'text-primary':'' }} " 
				tba="[ng-model='lotAlloQt.newALOQT']" 
				onclick="$($(this).attr('tba')).val(0)" 
				ng-click="xItm.sel_idVSL_ORST = xLine.idVSL_ORST;xItm.specCurrent=xLine.VSL_ORDE_LLINK" 
				ng-repeat="xLine in vsl_orhe | AB_noDoubles:'idVSL_ORDE,idVSL_ORST' | AB_Sorted:'VSL_ORST_PDATE' " 
				ng-if="xLine.idVIN_ITEM == xItm.idVIN_ITEM && xLine.idVSL_ORDE > 0 && xLine.idVSL_ORST > 0 " 
				>
					<div class="col-sm-2 ab-border ab-spaceless text-center">
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

						<input   class="hidden"  ng-model="xLine.VSL_ORDE_LLINK" />

					</div>
					<div class="col-sm-4 ab-border ab-spaceless text-center">

						<span class="ab-pointer" title="Change delivery date" 
						ng-click="xItm.VSL_PDATE=xLine.VSL_ORST_PDATE;"
						neg-if="ABGetDateFn('diff-today',xLine.VSL_ORST_PDATE)!=ABGetDateFn('diff-today',xItm.VSL_PDATE)"  >
							{{xLine.VSL_ORST_PDATE}}
						</span>
				
					</div>
					<div class="col-sm-1 ab-border ab-spaceless text-center">
					  {{xLine.VSL_ORST_ORDQT}}
					</div>
					<div class="col-sm-3 ab-border ab-spaceless text-left">

						<span  ng-repeat="step in VSL_STEP_LIST" ng-if="step.name==xLine.VSL_ORST_STEPS" >
							&nbsp;{{step.labeltext}}&nbsp;
						</span>

					</div>
					<div class="col-sm-1">
						<span ng-if="stepRetract!=true" >
							<span class="ab-pointer" 
								ng-if="xLine.VSL_ORST_STEPS<stpSelName || xLine.VSL_ORST_STEPS==stpSelName"  
								ng-click="toggleAllocStepSel(xLine.idVSL_ORST);" 
							>
								<input type="checkbox"	xlinesel="" class="glyph2icon glyphic2on-unchecked" style="font-size:medium;"
									ng-if="(',' + DOC_ORST + ',').indexOf(','+xLine.idVSL_ORST+',')==-1" />
									
								<input  type="checkbox"	checked xlinesel="" class="glyp2hicon glyph2icon-expand " style="font-size:medium;"
									ng-if="(',' + DOC_ORST + ',').indexOf(','+xLine.idVSL_ORST+',')>-1" />
							</span>	
						</span>
						<span ng-if="stepRetract==true" >
							<span class="ab-pointer" 
								ng-if="xLine.VSL_ORST_STEPS>stpSelName && stpSelName!=''"  
								ng-click="toggleAllocStepSel(xLine.idVSL_ORST);" 
							>
								<input type="checkbox" xlinesel="" class="glyph2icon glyphic2on-unchecked" style="font-size:medium;"
									ng-if="(',' + DOC_ORST + ',').indexOf(','+xLine.idVSL_ORST+',')==-1" />
									
								<input  type="checkbox"	checked xlinesel="" class="glyp2hicon glyph2icon-expand " style="font-size:medium;"
									ng-if="(',' + DOC_ORST + ',').indexOf(','+xLine.idVSL_ORST+',')>-1" />
							</span>	
						</span>
					
					</div>
						
				</div>
			
			</div>

			<div class="col-sm-5 ab-spaceless ab-border ">
				
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
					
					<div class="col-sm-2 ab-spaceless text-center">
						Lots selected
					</div>
					
				</div>
				
				<div ng-if="xItm.VIN_ITEM_LOTCT > 0" id="LotAll{{xItm.idVIN_ITEM}}" class=" ab-spaceless small ">
					<input class="hidden" ng-model="lotAlloQt.allocDirty" />
					<div class="row  ab-spaceless" 
					sttyle="border-color:transparent;border:none;border-left:solid;border-width:5px;border-color:{{lotAlloQt.lifeColor}};"
					ng-repeat="lotAlloQt in vin_inve  | AB_noDoubles:'idVIN_LSHE' | AB_sortReverse:'VIN_LSHE_DOMDA'  " 
					ng-if="xItm.idVIN_ITEM == lotAlloQt.VIN_LSHE_ITMID && lotAlloQt.VIN_LSHE_SOLDO == 0" >
					 	
						<div class="col-sm-2  ab-spaceless text-right">
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
								
				<span ng-if="xItm.specCurrent < 1 " >
					{{ ABGetDateFn('get-year',lotAlloQt.VIN_LSHE_DATES) }}-{{ ABGetDateFn('get-month',lotAlloQt.VIN_LSHE_DATES) }}
				</span>
				
				<span class="text-primary" ng-repeat="tcSpec in specSheet[xItm.VSL_ORDE_ITMID] "
				ng-if="xItm.specCurrent && tcSpec.idVIN_SSMA == xItm.VSL_ORDE_LLINK && lotAlloQt.idVIN_LSHE == tcSpec.idVIN_LSHE" 
				>				
					{{ ABGetDateFn('get-year',tcSpec.VIN_LSHE_DATES) }}-{{ ABGetDateFn('get-month',tcSpec.VIN_LSHE_DATES) }}
				</span>								
								
								
									
								</td>
								</tr>
								</table>
							
						</div>
						<div ng-if="xItm.specCurrent < 1" class="col-sm-2  ab-spaceless" >			
						
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

							<td style="width:50%;" class="ab-spaceless text-center small">
								<input ng-model="lotAlloQt.newALOQT" size=2 
								
								id="lotAlloQt{{xItm.sel_idVSL_ORST}}-{{lotAlloQt.idVIN_LSHE}}"
								vsl_orst="{{xItm.sel_idVSL_ORST}}"
								class="hidden small ab-spaceless {{ lotAlloQt.newALOQT!=lotAlloQt.orgval?'bg-warning':''}}"
								onchange="$('#lotSel' + $(this).attr('vsl_orst')).click();"
								/>
								<input class="hidden" size=2 ng-model="lotAlloQt.orgval" />
							
							</td>

							<td style="width:50%;" class=" ab-spaceless text-center">

								<span ng-repeat="xlSel in vin_inve  | AB_noDoubles:'idVSL_LSTR,VSL_LSTR_STPSQ' " 
								ng-if="xItm.sel_idVSL_ORST == xlSel.VSL_LSTR_STPSQ " >
								
									<span class="hidden" ng-init="lotAlloQt.newALOQT=0">.</span>
									<span class="hidden" ng-init="lotAlloQt.orgval=0">.</span>
									
								</span>
																
								<span class="ab-spaceless small" ng-repeat="xlSel in vin_inve  | AB_noDoubles:'idVSL_LSTR,VSL_LSTR_STPSQ' " 
								ng-if="xItm.sel_idVSL_ORST == xlSel.VSL_LSTR_STPSQ  && xlSel.VSL_LSTR_LOTSQ == lotAlloQt.idVIN_LSHE" >
									[&nbsp;<span ng-init="lotAlloQt.newALOQT=xlSel.VSL_LSTR_ALOQT;lotAlloQt.orgval=xlSel.VSL_LSTR_ALOQT" >
									{{xlSel.VSL_LSTR_ALOQT}}
									</span>&nbsp;]
									<input class="hidden" ng-model="xlSel.VSL_LSTR_ALOQT" />
								</span>


							</td>
							
							</tr>
							</table>

							<span class="hidden" ng-init="lotAlloQt.newALOQT=0">.</span>
							<span class="hidden" ng-init="lotAlloQt.orgval=0">.</span>
	
							
						</div>


					</div>
				
				</div>	
			
			</div>
			<div class="col-sm-1 ab-spaceless">
				<div class="row" ng-if="xItm.VIN_ITEM_LOTCT > 0" >
					
					<div class="col-sm-12 text-center" >
					
						<span class="text-primary">
							Spec. selection
						</span>
						<br>
						<label >
						      <span ng-if="xItm.specCurrent < 1 " >
						      		None
						      </span>
						      <span ng-if="xItm.specCurrent > 0 && spc.idVIN_SSMA == xItm.specCurrent" 
						      	ng-repeat="spc in specSheet[xItm.idVIN_ITEM] | AB_noDoubles:'idVIN_SSMA' " >
						      	{{spc.VIN_SSMA_SPEID}}
						      </span>
						      
						      		
						</label>      
					</div>	

				</div>		
			</div>	
			
			<div  class=" small hidden" id="invAlloQ{{xItm.idVSL_ORDE}}" idtarget="1"  >
				<div class="col-sm-12"></div>
				
				<div class="col-sm-3">
				<input class="hidden" ng-model="xItm.hasPending" />
				<input class="hidden" ng-model="xItm.specCurrent" ng-init="xItm.specCurrent=0" />
				
				<span ng-init="xItm.hasPending=0" ></span>
				
					<span class="text-primary" target="_blank" href="#/VSL_ORDERS/VSL_ORHECT/Process:VSL_ORDERS,Session:VSL_ORHECT,updType:UPDATE,idVSL_ORHE:{{invQ.idVSL_ORHE}}" >
						<span class="glyphicon glyphi21con-search" ></span>&nbsp;&nbsp;
						<span><em ab-label="STD_ORNUM_SH" >Order</em>:</span>
					</span>
				</div>
				<div class="col-sm-2 ">
					<span class="text-primary text-center"><em ab-label="VSL_ORHE_CUSPO_10" >Ref</em>:</span>
				</div>
				<div class="col-sm-1 text-center">
					<span class="text-primary"><em ab-label="STD_QUANTITY_SHORT" >Qty</em>:</span>
				</div>
				<div class="col-sm-6 text-left">
				&nbsp;
				</div>
				
				<div class="col-sm-12" style="font-weight:700;margin-left:20px;" ng-repeat="invQrec in vin_inve | AB_noDoubles:'idVSL_ORDE' " ng-if="vin_inve.length>0 &&  invQrec.VIN_INVE_ITMID == xItm.VSL_ORDE_ITMID"  >
					
					
					<div class="row "  ng-repeat="invQ in invQrec.rowSet   | AB_Sorted:'VSL_ORHE_ORNUM,VSL_ORDE_ORLIN' " ng-if="invQ.idVSL_ORHE  && invQ.idVSL_ORHE != idVSL_ORHE && invQ.VSL_ORST_STEPS > 'EE_SCED' && invQ.VSL_ORST_STEPS < 'JJ_INVO' " >
		
						<div class="col-sm-3 " recount="1" ng-init="xItm.hasPending=1" >
				
						&nbsp;{{ invQ.VSL_ORHE_ORNUM  }}&nbsp; {{invQ.VGB_CUST_BPNAM}}&nbsp;
				
						</div>
						<div class="col-sm-2 ">
							&nbsp;{{ invQ.VSL_ORHE_CUSPO  }}&nbsp;
						</div>
						<div class="col-sm-1 text-left ">
							&nbsp;{{ invQ.VSL_ORST_ORDQT  }}&nbsp;
							<span ng-repeat="stp in VSL_STEP_LIST" ng-if="stp.name == invQ.VSL_ORST_STEPS">
		 					{{stp.labeltext}} 
		 					</span>
						</div>

						<div class="col-sm-6 text-left">
						&nbsp;
						</div>

						
					</div>
				
				</div>
			
			</div>
</div>

<?php
EOC;

 require_once "VSL_ORDER_FORMS.php";


?>





