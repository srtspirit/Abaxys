			
			
			<tr id="vpu-0" class="{{isLocal()==true?'':'hidden'}}" ng-if="$first==true">
				<td style="vertical-align:top;">
					<span ng-if="isLocal()==true">
						<input class="hidden " ng-model="OIT.SELECT" ng-init="OIT.SELECT=1" />
						<input class="hidden " ng-model="OIT.NEWPOST" ng-init="OIT.NEWPOST=1" />
					</span>	
					<span ng-if="isLocal()==false">
						<input class="hidden " ng-model="OIT.SELECT" ng-init="OIT.SELECT=0" />
						<input class="hidden " ng-model="OIT.NEWPOST" ng-init="OIT.NEWPOST=0" />
					</span>	
					
				</td>
				<td colspan=10>
					<table style="width:100%;">
					<tr class="ab-strong" ng-repeat="vpu in local_purch | AB_noDoubles:'idVPU_ORSI' "  >
						<td style="width:40%;">
						Item&nbsp;&nbsp;<span class="text-primary small ab-pointer" ng-click="insertItem(local_purch,0,0)" >New Item</span>
						<input class="hidden" ng-model="vpu.grandtotal" ng-click="vpu.grandtotal=accGrandTotal(0)"  size=5 />
						<input class="hidden" ng-model="vpu.taxtotal"  size=5 /> 
						<input class="hidden" ng-model="vpu.invtotal"  size=5 />
						<input class="hidden" ng-model="vpu.idVTX_SCHH" ng-init="vpu.idVTX_SCHH=VGB_ADDR_PCHID" size=5 />
						</td>
						<td style="width:10%;" class="text-right"> Quantity </td>
						<td style="width:10%;" class="text-right"> Price&nbsp;</td>
						<td style="width:10%;" class="text-right"> Extension&nbsp;</td>
						<td style="width:30%;" class="text-right" ></td>
						
						
					</tr>
					<tr  ng-repeat="vpu in local_purch | AB_noDoubles:'idVPU_ORST' "  >
						
						<td>
							<span ng-if="vpu.newItem=='1' " > 
								<span class="glyphicon glyphicon-trash" ng-click="removeNewLine(local_purch,vpu.idVPU_ORST,0);" ></span>

								&nbsp;&nbsp;&nbsp;<input title="Find by Item" placeholder=" Search by Item " 
								onfocus="$(this).select();" 
								ng-blur="chkRangeItm('local_purch',0,vpu.VIN_ITEM_ITMID,vpu.idVPU_ORST);"
								ng-keypress="chkEventItm('local_purch',$event,0,vpu.VIN_ITEM_ITMID,vpu.idVPU_ORST);"
								ng-model="vpu.VIN_ITEM_ITMID" size="10" class="ab-borderless small ab-strong" />
								
								<input class="hidden" ng-model="VIN_ITEM_ITMID" />

							</span>
							<span class="ab-strong" ng-if="vpu.newItem!='1' ">
							{{vpu.VIN_ITEM_ITMID}}
							</span>
							<input class="hidden" ng-model="vpu.idVIN_ITEM" />
							<input class="hidden" ng-model="vpu.VIN_ITEM_INVIT" />
							<input class="hidden" ng-model="vpu.newItem" />
							
							<span class="small" ng-if="vpu.newItem!='1' ">
							-<input size=30 readonly class="ab-borderless" ng-model="vpu.VPU_ORDE_DESCR" />
							</span>
							<span class="small" ng-if="vpu.newItem=='1' ">
							-<input size=30 ng-model="vpu.VPU_ORDE_DESCR" />
							</span>
							<input class="hidden" ng-model="vpu.VIN_ITEM_ITTXT" />
							<input class="hidden" ng-model="vpu.VPU_ORDE_OLTYP" ng-init="vpu.VPU_ORDE_OLTYP='EXP'" />
							<span class="small text-primary ab-strong" ng-if="vpu.VIN_ITEM_ITTXT=='NOTAX'"><span class="small">no tax</span></span>
							<span class="small text-primary ab-strong" ng-if="vpu.VIN_ITEM_ITTXT!='NOTAX'"><span class="small">Taxable</span></span>
						</td>
						<td class="text-right">
							<input size=5 class="text-right" ng-model="vpu.VPU_ORST_ORDQT_REV" clickid="0" ng-if="vpu.idVIN_ITEM>0"
							onfocus="$(this).select();"
							onblur="accumclick($(this).attr('clickid'));" ng-init="vpu.VPU_ORST_ORDQT_REV=vpu.VPU_ORST_ORDQT" />
						</td>
						<td class="text-right">

							<input size=5 class="text-right" ng-model="vpu.VPU_ORDE_OUNET_REV" clickid="0" ng-if="vpu.idVIN_ITEM>0"
							onfocus="$(this).select();"
							onblur="accumclick($(this).attr('clickid'));" ng-init="vpu.VPU_ORDE_OUNET_REV=vpu.VPU_ORDE_OUNET" />
						</td>
						<td class="text-right" ng-if="vpu.idVIN_ITEM>0">
							
							<input class="hidden"  ng-model="vpu.ext" taxing="{{vpu.VIN_ITEM_ITTXT}}" 
							ng-bind="vpu.ext=((vpu.VPU_ORDE_OUNET_REV*1) * (vpu.VPU_ORST_ORDQT_REV*1) / (vpu.VPU_ORDE_FACTO*1)).toFixed(2)" size=5 />
							
							{{ABGetNumberFn("fmt-curr",( (vpu.VPU_ORDE_OUNET_REV*1) * (vpu.VPU_ORST_ORDQT_REV*1) / (vpu.VPU_ORDE_FACTO*1) )) }}&nbsp;
						</td>
						
					</tr>
					<tr class="ab-border">
					</tr>
					
					<tr ng-repeat="jrn in rawResult.vgl_taxscheme | AB_noDoubles:'idVTX_SCHH' " >
						<td colspan=100>
							<table style="width:100%;">
							<tr>
								<td style="width:40%;"></td>
								<td style="width:10%;" class="text-right"></td>
								<td style="width:10%;" class="text-right"></td>
								<td style="width:10%;" class="text-right"></td>
								<td style="width:10%;" class="text-right"></td>
								<td style="width:10%;" class="text-right"></td>
								<td style="width:10%;" class="text-right"></td>
								
							</tr>
							<tr ng-repeat="vpu in rawResult.vgl_taxscheme | AB_noDoubles:'idVTX_SCHE' | AB_Sorted:'VTX_SCHE_SCHSQ' "  >
						
								<td>
									
								</td>
								<td colspan=2 class="text-right">
									{{vpu.VGL_CHART_GLDES}}
								</td>
								<td class="text-right">
									<input size=5 class="ab-borderless text-right" readonly  
									taxseq="{{vpu.VTX_SCHE_SCHSQ}}"
									taxper="{{vpu.VTX_SCHE_TAXPE}}"
									taxprev ="{{vpu.VTX_SCHE_TPREV}}"
									ng-model="jrn.VGL_JNDE_GLAMT_REV" ng-init="jrn.VGL_JNDE_GLAMT_REV=0" />&nbsp;
								</td>

							</tr>

							</table>
						</td>
						
					</tr>
					<tr>
						<td class="text-right">
						</td>
						<td class="text-right">
						</td>
						<td class="text-right text-primary ab-strong">
							Total:
						</td>	
						<td class="text-right">
							<input class="text-primary text-right ab-borderless ab-strong" readonly ng-model="vpu.invtotal"  size=5 />&nbsp;	
						</td>
					</tr>										
					<tr class="ab-border">
						<td colspan=100></td>
					</tr>
					</table>
				</td>
			</tr>
			