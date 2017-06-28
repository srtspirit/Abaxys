<div class="row"  ng-if="ordersAll==0">
	<div class="ab-wrapper-div">
		<div class="col-lg-1">
			
		</div>	
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12  ">
		
			<div class="row ab-spaceless" id="vin{{headRow.idVIN_ITEM}}" 
			ng-repeat="headRow in vin_item_replenish | AB_Sorted:'VIN_ITEM_ITMID,rTable' " 
			ng-if="headRow.idVIN_ITEM && headRow.rTable=='vin_inve'" >
				<div style="margin-top:5px;" class="row text-muted ab-strong ab-spaceless  ab-well " 
				ng-init="headRow.hasOrderSales=false;headRow.hasOrderPurch=false;headRow.specMissMatch=0;headRow.specQtOk=true;" 
				ng-repeat="varRow in vin_item_replenish | AB_Sorted:'VIN_ITEM_ITMID,rTable' " 
				ng-if="varRow.rTable=='vin_inve'&&varRow.idVIN_ITEM==headRow.idVIN_ITEM ">
		
					<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12  ">
						
						<span class="text-primary small hidden-lg" ab-label="VIN_ITEM_ITMID">ITEM</span>&nbsp;
						
						<span ng-if="headRow.hasOrderSales==true||headRow.hasOrderPurch==true" class="ab-pointer text-primary" myId="{{headRow.idVIN_ITEM}}" 
						onclick="$('#vin'+$(this).attr('myId')).find('.rpl_detail').toggleClass('hidden');" >
							<span class="glyphicon glyphicon-list" ></span>
						</span>
						<span ng-if="headRow.hasOrderSales==false&&headRow.hasOrderPurch==false" class="text-muted " >
							<span class="glyphicon glyphicon-list" ></span>
						</span>
						
						<span ng-if="varRow.rTable=='vin_inve'">{{varRow.VIN_ITEM_ITMID}}</span>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12  ">
					
						<span class="text-primary small hidden-lg"  ab-label="STD_DESCR">Desc.</span>&nbsp;
						<span ng-if="varRow.rTable=='vin_inve'">
							{{varRow.VIN_ITEM_DESC1}}
						</span>
					</div>
					<div class="col-lg-1 col-md-3 col-sm-4 col-xs-6  ">
						<span  class="text-primary small hidden-lg" ab-label="VIN_ITEM_BOHQT_S">BOH</span>&nbsp;
					
						<span ng-if="varRow.rTable=='vin_inve'||varRow.rTable=='vin_lslq'">
							{{varRow.BOHQT}}
						</span>
					</div>
					<div class="col-lg-1 col-md-3 col-sm-4 col-xs-6  ">
						<span  class="text-primary small hidden-lg" ab-label="VIN_ITEM_ALOQT">ALO</span>&nbsp;

						<span ng-if="varRow.rTable=='vin_inve'||varRow.rTable=='vin_lslq'" >


							{{headRow.SLSACK}}
						</span>
					</div>
					<div class="col-lg-1 col-md-3 col-sm-4 col-xs-6  ">
					
					<span  class="text-primary small hidden-lg" ab-label="VIN_ITEM_PURQT_SH1"></span>&nbsp;
						<span ng-if="varRow.rTable=='vin_inve'||varRow.rTable=='vin_lslq'">
							{{headRow.PURACK}}
						</span>
						<span ng-if="varRow.rTable=='vin_inve'"  >
							<input readonly class="hidden ab-borderless" ng-model="headRow.SLSACK" ng-init="headRow.SLSACK=0" size=2 />
							<input readonly class="hidden ab-borderless" ng-model="headRow.PURACK" ng-init="headRow.PURACK=0" size=2 />
							<span ng-repeat="ackRow in vin_item_replenish | AB_Sorted:'VIN_ITEM_ITMID,rTable' " 
							ng-if="varRow.idVIN_ITEM==ackRow.idVIN_ITEM" >
								<span ng-if="ackRow.rTable=='vsl_orst'" class="hidden" >
									<span ng-bind="headRow.SLSACK=(ackRow.ACKQT*1)+(varRow.ALOQT*1)" ></span>
								</span>	
								<span ng-if="ackRow.rTable=='vpu_orst'" class="hidden" >
									<span ng-bind="headRow.PURACK=(ackRow.ACKQT*1)+(varRow.PURQT*1)" ></span>
								</span>	
							</span>
						</span>
		
					</div>	
					<div class="col-lg-1 col-md-12 col-sm-4 col-xs-6  ">
						<span  class="text-primary small hidden-lg" ab-label="VIN_ITEM_SUETA">ETA</span>&nbsp;

						{{varRow.VIN_ITEM_SUETA}}
					</div>	
					<div class="col-lg-4 col-md-12 col-sm-6 col-xs-12  ">	
						<span class="hidden">Recommendation</span>
						<span 
						ng-repeat="varRowQty in vin_item_replenish | AB_Sorted:'VIN_ITEM_ITMID,rTable' " 
						ng-if="varRowQty.rTable=='vin_qtys'&&varRowQty.idVIN_ITEM==headRow.idVIN_ITEM ">
							<span ng-init="varRowQty.message=computeReplMessage(varRowQty.FIRSTD,varRowQty.ACKQT,varRowQty.VIN_ITEM_SUETA,varRowQty.VIN_ITEM_MINQT,varRowQty.VIN_ITEM_MINSD,varRow.BOHQT,headRow.PURACK,headRow.SLSACK)"></span>
							<span class="small ab-border bg-warning text-danger ab-spaceless"  >
								{{ varRowQty.message }}
							</span>
						</span>
						<span ng-if="headRow.specQtOk==false">
							<span class="small ab-border bg-warning text-danger ab-spaceless">Qty missing for Specs</span>
						</span>
						
						<span ng-if="headRow.specMissMatch==1">
							<span class="small ab-border bg-warning text-danger ab-spaceless">Spec. miss-match</span>
						</span>
					</div>
				</div>

<?php

$salesOrders = <<<EOC

				<div ng-if="headRow.hasOrderSales==true" 
				class="row rpl_detail hidden ab-strong ab-border ab-spaceless small ab-primary visible-lg" >
		
					<div class="rpl_detail hidden col-lg-1 col-md-4 col-sm-6 col-xs-12  ">
						Sales Order 
						<span ng-init="ABsetField('modalOrder','Sales ')" >
					</div>
					<div class="rpl_detail hidden col-lg-3 col-md-4 col-sm-6 col-xs-12  ">
						Customer
					</div>
					<div class="rpl_detail hidden col-lg-4 col-md-12 col-sm-12 col-xs-12  ">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  ">
								Planned Date
							</div>	
					
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">
								Line-Step
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">
								Quantity
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  ">
								Next Step
							</div>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12  ">	
					
					</div>
				</div>

EOC;

$salesOrdersRepeat = <<<EOC


				<div class="rpl_detail hidden row text-danger ab-underline ab-well rpl_detail hidden"
				ng-repeat="specRow in vsl_replOrders | AB_noDoubles:'ORNUM,ORLIN,STPSQ' | AB_Sorted:'ORNUM,ORLIN,STPSQ' " 
				ng-if="specRow.rTable=='sales'&&(specRow.idVIN_ITEM==headRow.idVIN_ITEM||ordersAll==1)" 
				ng-init="headRow.hasOrderSales=true;specRow.detRepeat=false;" >


EOC;

$salesOrdersDetRepeat = <<<EOC
		
				<div class="rpl_detail hidden row text-danger ab-underline ab-well"
				ng-repeat="specRow in vsl_replOrders | AB_noDoubles:'ORNUM,ORLIN,STPSQ' | AB_Sorted:'ORNUM,ORLIN,STPSQ' " 
				ng-if="specRow.rTable=='sales' && mainSearchOrder==specRow.rTable+specRow.ORDID && ordersAll==0 "  
				ng-init="headRow.hasOrderSales=true;specRow.detRepeat=true" >
		
EOC;

$salesOrdersBottom = <<<EOC


					<div slsId="{{specRow.ORDID}}" class="col-lg-4 col-md-12 col-sm-12 col-xs-12  " 
					ng-init="specRow.lotChk=evalSpecs(specRow.ORNUM,specRow.ORLIN,specRow.STPSQ,'sales');"
					>
						
						<table style="width:100%;" >
						<tr>
							<td style="width:25%;" ></td>
							<td style="width:25%;" ></td>
							<td style="width:25%;" ></td>
							<td style="width:25%;" ></td>
						</tr>	
						<tr>
						<td colspan=4>
							&nbsp;
							<span ng-if="ordersAll==0&&mainSearchOrder==''"  
							ng-click="ABsetField('mainSearchOrder',specRow.rTable+specRow.ORDID);"
							class="ab-strong  ab-pointer ab-border ab-spaceless"
							
							onclick="
							orderDetailOrderShow();
							" >
								&nbsp;<span class="caret"></span>
								{{specRow.ORNUM}}&nbsp;
							</span>
							<span ng-if="ordersAll!=0||mainSearchOrder!=''"  >
								<a target="_blank" href="#/VSL_ORDERS/VSL_ORHECT/idVSL_ORHE:{{specRow.ORDID}},updType:UPDATE,Session:VSL_ORHECT,Process:VSL_ORDERS" >
								<span class="glyphicon glyphicon-pencil"></span>
								{{specRow.ORNUM}}
								</a>
							</span>
							&nbsp;
							{{specRow.BPNAM}}&nbsp;&nbsp;
<!--						

						</td>

						<td colspan=2 class="ab-strong text-muted small">
-->
						<span ng-if="ordersAll==0&&mainSearchOrder==''" >[{{specRow.CFG_USERS_DESIGNATION}}] </span>
						<span ng-if="ordersAll==1||mainSearchOrder!=''" class="ab-strong " >[{{specRow.VIN_ITEM_ITMID}}]&nbsp;{{specRow.VIN_ITEM_DESC1}} </span>

						</td>

						</tr>
						
						</table>
				
					</div>
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12  ">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  " ng-init="specRow.hasDetail=false">
								<span class="text-primary ab-strong small hidden-lg">Del&nbsp;</span>
								{{specRow.DDATE}}
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">
								<span class="text-primary ab-strong small hidden-lg">Line&nbsp;</span>
								{{specRow.ORLIN}}-{{specRow.STPSQ}}
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">
								<span class="text-primary ab-strong small hidden-lg">Qty&nbsp;</span>
								{{specRow.ORDQT}}
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  ">
								<span class="text-primary ab-strong small hidden-lg">Stp&nbsp;</span>
								{{AB_CPARM["VSL_STEPS_DESCR"][specRow.STEPS]}} 
							</div>
						</div>
						<div class="row" ng-if="ordersAll==0&&mainSearchOrder==''">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " ng-init="specRow.hasDetail=false" >
								<div ng-if="specRow.lotChk.length>0" neg-init="headRow.specQtOk=specRow.lotChk[0].specQtOk" >
									<table style="width:100%;" class="small" >
										<tr>
											<td style="width:1%;" ></td>
											<td style="width:99%;" >
												<table style="width:100%;" class="bg-warning ab-border">
													<tr class="text-primary ab-strong" >
														<td style="width:2%;" ></td>
														<td style="width:30%;" >Lot&nbsp;Identification</td>
														<td style="width:68%;" >Specs&nbsp;required&nbsp;not&nbsp;linked</td>
													</tr>
													<tr class="ab-underline ab-strong" ng-repeat="badLots in specRow.lotChk" >
														<td></td>
														<td ng-init="headRow.specMissMatch=1">
															{{badLots.VIN_LSHE_LOTID}}
															<span class="{{badLots.VIN_LSHE_SERNO>0?'':'hidden'}}" >
																[{{badLots.VIN_LSHE_SERNO}}]
															</span>
														</td>
														<td>
															{{badLots.notspecs}}
														</td>
													</tr>
													<tr class="ab-border" >
														<td colspan=10></td>
													</tr>
												</table>
											</td>
										</tr>

						<tr>
						<td colspan=10 style="font-size:4pt;">&nbsp;</td>
						</tr>
						<tr>
						<td></td>
						<td colspan=2 ng-init="specRow.hasDisplayed=false" >
							<div class="ab-strong bg-warning ab-border ab-spaceless" >
								<div ng-if="specRow.hasDisplayed==true" class=" text-primary ab-strong" >
									<table style="width:100%;" >
										<tr>
											<td style="width:1%;" ></td>
											<td style="width:60%;" >Spec Id&nbsp;&nbsp;Qty missing</td>
											<td style="width:20%;" >E.T.A.</td>
											<td style="width:19%;" >Avail.</td>
										</tr>
									</table>
								</div>
								
								
								<div ng-repeat="specDet in vsl_replOrders | AB_noDoubles:'ORNUM,ORLIN,VIN_SSMA_SPEID' "
								ng-if="specRow.ORNUM==specDet.ORNUM&&specRow.ORLIN==specDet.ORLIN&&specDet.VIN_SSMA_SPEID" 
								ng-init="specDet.hasNoQty=true;specRow.hasProblem=false;" >
							
							<!--
							<span ng-init="specDet.SLSACK=0;specDet.PURACK=0" ></span>	
							<span ng-repeat="ackRow in vin_item_replenish | AB_Sorted:'VIN_ITEM_ITMID,rTable' " 
							ng-if="specDet.idVIN_ITEM==ackRow.idVIN_ITEM" >
								<span ng-if="ackRow.rTable=='vsl_orst'&&" class="hid2den" >
									<span ng-init="specDet.SLSACK=(ackRow.ACKQT*1)+(varRow.ALOQT*1)" ></span>
									[{{(ackRow.ACKQT*1)+(ackRow.ALOQT*1)}}]={{specDet.SLSACK}}
								</span>	
								<span ng-if="ackRow.rTable=='vpu_orst'" class="hid2den" >
									<span ng-init="specDet.PURACK=(ackRow.ACKQT*1)+(varRow.PURQT*1)" ></span>
									{ {{(ackRow.ACKQT*1)+(ackRow.PURQT*1)}} }={{specDet.PURACK}}
								</span>	
							</span>
							-->


									<table style="width:100%;" class="ab-strong bg-warning ab-border" 
									ng-repeat="sQty in vin_specqty " 
									neg-if="sQty.idVIN_ITEM = specRow.idVIN_ITEM && sQty.VIN_ITEM_ITMID!=null"
									ng-if="sQty.lotId==specDet.idVIN_SSMA"
									ng-init="specDet.hasNoQty=false;specRow.hasProblem=true;"
									>



										<tr ng-if="sQty.BOHQT-headRow.SLSACK+headRow.PURACK<1" 
										ng-init="specRow.hasDisplayed=true;headRow.specQtOk=false;" >
											<td style="width:1%;" ></td>
											<td style="width:60%;" >
												{{sQty.VIN_ITEM_ITMID}}
											</td>	
											<td style="width:20%;">
												{{sQty.VIN_ITEM_SUETA}}
											</td>
											<td style="width:19%;">
											
												{{sQty.BOHQT - headRow.SLSACK + headRow.PURACK + (specRow.ORDQT*1)}}
											</td>
											
										</tr>

									<tr ng-if="specDet.hasNoQty==true" 
									ng-init="specRow.hasProblem=true;headRow.specQtOk=false;">
											<td style="width:1%;" ></td>
											<td style="width:60%;" ng-init="specRow.hasDisplayed=true;" >
												{{specDet.VIN_SSMA_SPEID.length}}
											</td>	
											<td style="width:20%;">
												{{specDet.VIN_SSMA_SUETA.length}}
											</td>
											<td style="width:19%;">
												{{0-headRow.SLSACK+headRow.PURACK}}
											</td>
											
										</tr>
									</table>
									 
								
								</div>
								
							



						
						
						</td>
						</tr>

									</table>		
								</div>	
							</div>
						</div>	

					</div>	
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
						<div class="row">
						
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8  ">
								<table style="width:100%;" ng-if="specRow.hasDetail==true" class="small ab-strong">
									<tr>
										<td style="width:55%;">
											<span class="text-primary ab-strong small">Lot Id&nbsp;</span>
										</td>	
										<td style="width:10%;">
											<span class="text-primary ab-strong small">Qty&nbsp;</span>
										</td>
										<td style="width:35%;">
											<table style="width:100%;">
												<tr>
													<td style="width:34%;">
														<span class="text-primary ab-strong small">Hand&nbsp;</span>
													</td>	
													<td style="width:33%;">
														<span class="text-primary ab-strong small">Allo&nbsp;</span>
													</td>	
													<td style="width:33%;">
														<span class="text-primary ab-strong small">P.O.&nbsp;</span>
													</td>	
												</tr>
											</table>
										</td>
									</tr>
								</table>

								<div ng-repeat="specDet in vsl_replOrders | AB_noDoubles:'ORNUM,ORLIN,STPSQ,VIN_LSHE_LOTID' "
								ng-if="specRow.ORNUM==specDet.ORNUM&&specRow.ORLIN==specDet.ORLIN&&specRow.STPSQ==specDet.STPSQ&&specDet.VIN_LSHE_LOTID" >
								<table style="width:100%;" ng-init="specRow.hasDetail=true" class="small ab-strong">
									<tr>
										<td style="width:55%;">
											{{specDet.VIN_LSHE_LOTID}}
											<span class="{{specDet.VIN_LSHE_SERNO>0?'':'hidden'}}" >
												[{{specDet.VIN_LSHE_SERNO}}]
											</span>
											
										</td>	
										<td style="width:10%;">
											
											{{specDet.LOTQT}}
										</td>
										<td style="width:35%;">
											<table style="width:100%;" 
											ng-repeat="lotRow in vin_item_replenish | AB_noDoubles:'idVIN_LSHE' " 
											ng-if="lotRow.rTable=='vin_lslq'&&lotRow.idVIN_LSHE==specDet.idVIN_LSHE ">
												<tr>
													<td style="width:34%;" class="ab-border ab-spaceless">
														<span >
															{{lotRow.BOHQT}}
														</span>
													</td>
													<td style="width:33%;" class="ab-border ab-spaceless">
														<span >
															{{lotRow.ALOQT}}
														</span>
													</td>
													<td style="width:33%;" class="ab-border ab-spaceless">
														<span >
															{{lotRow.PURQT}}
														</span>
													</td>											
												</tr>
											</table>
										</td>
									</tr>
								</table>
								</div>							
							</div>
					
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  ">

								<table style="width:100%;" ng-if="specRow.hasDetail==true" class="small ab-strong">
									<tr>
										<td style="width:75%;">
											<span class="text-primary ab-strong small">Spec Id&nbsp;</span>
										</td>	
										<td style="width:25%;">
											<span class="text-primary ab-strong small">Days&nbsp;</span>
										</td>
									</tr>
								</table>

								<div ng-repeat="specDet in vsl_replOrders | AB_noDoubles:'ORNUM,ORLIN,VIN_SSMA_SPEID' "
								ng-if="specRow.ORNUM==specDet.ORNUM&&specRow.ORLIN==specDet.ORLIN&&specDet.VIN_SSMA_SPEID" >
								<table style="width:100%;" ng-init="specRow.hasDetail=true" class="small ab-strong">
									<tr>
										<td style="width:75%;">
											{{specDet.VIN_SSMA_SPEID}}
										</td>	
										<td style="width:25%;">
											
											{{specDet.VIN_SSMA_SUETA}}
										</td>
									</tr>
								</table>
								
								</div>
							</div>
						</div>
					</div>

				</div>	

EOC;

echo $salesOrders . $salesOrdersRepeat . $salesOrdersBottom;



$purchOrders = <<<EOC

				<div ng-if="headRow.hasOrderPurch==true"  
				class="row rpl_detail hidden ab-strong ab-border ab-spaceless small ab-primary visible-lg rpl_detail hidden" >
		
					<div class="rpl_detail hidden col-lg-1 col-md-4 col-sm-6 col-xs-12  ">
						Purch. Order
						<span ng-init="ABsetField('modalOrder','Purchase ')" >
					</div>
					<div class="rpl_detail hidden col-lg-3 col-md-4 col-sm-6 col-xs-12  ">
						Supplier
					</div>
					<div class="rpl_detail hidden col-lg-4 col-md-12 col-sm-12 col-xs-12  ">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  ">
								Planned Date
							</div>	
					
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">
								Line-Step
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">
								Quantity
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  ">
								Next Step
							</div>	
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " ng-init="specRow.hasDetail=false">
								<div ng-if="specRow.lotChk.length>0" >
									<table style="width:100%;" class="small" >
										<tr>
											<td style="width:1%;" ></td>
											<td style="width:99%;" >
												<table style="width:100%;" class="bg-warning ab-border">
													<tr class="text-primary ab-strong" >
														<td style="width:2%;" ></td>
														<td style="width:30%;" >Lot&nbsp;Identification</td>
														<td style="width:68%;" >Specs&nbsp;required&nbsp;not&nbsp;linked</td>
													</tr>
													<tr class="ab-underline ab-strong" ng-repeat="badLots in specRow.lotChk" >
														<td></td>
														<td>
															{{badLots.VIN_LSHE_LOTID}}
															<span class="{{badLots.VIN_LSHE_SERNO>0?'':'hidden'}}" >
																[{{badLots.VIN_LSHE_SERNO}}]
															</span>
														</td>
														<td>
															{{badLots.notspecs}}
														</td>
													</tr>
													<tr class="ab-border" >
														<td colspan=10></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>		
								</div>	
							</div>
						</div>	
						
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12  ">	
					
					</div>
				</div>
EOC;

$purchOrdersRepeat = <<<EOC
		
				<div class="rpl_detail hidden row text-success ab-underline ab-well rpl_detail hidden"
				ng-repeat="specRow in vsl_replOrders | AB_noDoubles:'ORNUM,ORLIN,STPSQ' | AB_Sorted:'ORNUM,ORLIN,STPSQ' " 
				ng-if="specRow.rTable=='purch'&&(specRow.idVIN_ITEM==headRow.idVIN_ITEM||ordersAll==1) "  
				ng-init="headRow.hasOrderPurch=true;specRow.detRepeat=false;" >
		
EOC;

$purchOrdersDetRepeat = <<<EOC
		
				<div class="rpl_detail hidden row text-success ab-underline ab-well"
				ng-repeat="specRow in vsl_replOrders | AB_noDoubles:'ORNUM,ORLIN,STPSQ' | AB_Sorted:'ORNUM,ORLIN,STPSQ' " 
				ng-if="specRow.rTable=='purch' && mainSearchOrder==specRow.rTable+specRow.ORDID && ordersAll==0 "  
				ng-init="headRow.hasOrderPurch=true;specRow.detRepeat=true" >
		
EOC;


$purchOrdersBottom = <<<EOC

					<div purId="{{specRow.ORDID}}" class="col-lg-4 col-md-12 col-sm-12 col-xs-12  "
					neg-init="specRow.lotChk=evalSpecs(specRow.ORNUM,specRow.ORLIN,specRow.STPSQ,'purch');">
						<table >
						<tr>
						<td>
							<span ng-if="ordersAll==0&&mainSearchOrder==''"  
							ng-click="ABsetField('mainSearchOrder',specRow.rTable+specRow.ORDID);;"
							class="ab-strong  ab-pointer ab-border ab-spaceless"
							onclick="
							orderDetailOrderShow();
							" >
								&nbsp;<span class="caret"></span>
								{{specRow.ORNUM}}&nbsp;
							</span>
							<span ng-if="ordersAll==1||mainSearchOrder!=''" >
								<a target="_blank" href="#/VPU_ORDERS/VPU_ORHECT/idVPU_ORHE:{{specRow.ORDID}},updType:UPDATE,Session:VPU_ORHECT,Process:VPU_ORDERS" >
								<span class="glyphicon glyphicon-pencil"></span>
								{{specRow.ORNUM}}
								</a>
							</span>
							{{specRow.BPNAM}}&nbsp;&nbsp;
						</td>
						<td class="ab-strong text-muted">
						<span ng-if="ordersAll==0&&mainSearchOrder==''" >[{{specRow.CFG_USERS_DESIGNATION}}] </span>
						<span ng-if="ordersAll==1||mainSearchOrder!=''" class="ab-strong " >[{{specRow.VIN_ITEM_ITMID}}]&nbsp;{{specRow.VIN_ITEM_DESC1}} </span>
						</td>
						</tr>
						</table>
						
						
					</div>
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12  ">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  " ng-init="specRow.hasDetail=false">
								<span class="text-primary ab-strong small hidden-lg">Del&nbsp;</span>
								{{specRow.DDATE}}
							</div>

							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">
								<span class="text-primary ab-strong small hidden-lg">Line&nbsp;</span>
								{{specRow.ORLIN}}-{{specRow.STPSQ}}
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">
								<span class="text-primary ab-strong small hidden-lg">Qty&nbsp;</span>
								{{specRow.ORDQT}}
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  ">
								<span class="text-primary ab-strong small hidden-lg">Stp&nbsp;</span>
								{{AB_CPARM["VPU_STEPS_DESCR"][specRow.STEPS]}}
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " ng-init="specRow.hasDetail=false">

								<div ng-if="specRow.lotChk.length>0" >
									<table style="width:100%;" class="small" >
										<tr>
											<td style="width:1%;" ></td>
											<td style="width:99%;" >
												<table style="width:100%;" class="bg-warning ab-border">
													<tr class="text-primary ab-strong" >
														<td style="width:2%;" ></td>
														<td style="width:30%;" >Lot&nbsp;Identification</td>
														<td style="width:68%;" >Specs&nbsp;required&nbsp;not&nbsp;linked</td>
													</tr>
													<tr class="ab-underline ab-strong" ng-repeat="badLots in specRow.lotChk" >
														<td ></td>
														<td>
															{{badLots.VIN_LSHE_LOTID}}
															<span class="{{badLots.VIN_LSHE_SERNO>0?'':'hidden'}}" >
																[{{badLots.VIN_LSHE_SERNO}}]
															</span>
														</td>
														<td>
															{{badLots.notspecs}}
														</td>
													</tr>
													<tr class="ab-border" >
														<td colspan=10></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>		
								</div>							
							</div>
						</div>	
					</div>	
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
						<div class="row">
						
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8  ">
								<table style="width:100%;" ng-if="specRow.hasDetail==true" class="small ab-strong">
									<tr>
										<td style="width:55%;">
											<span class="text-primary ab-strong small">Lot Id&nbsp;</span>
										</td>	
										<td style="width:10%;">
											<span class="text-primary ab-strong small">Qty&nbsp;</span>
										</td>
										<td style="width:35%;">
											<table style="width:100%;">
												<tr>
													<td style="width:34%;">
														<span class="text-primary ab-strong small">Hand&nbsp;</span>
													</td>	
													<td style="width:33%;">
														<span class="text-primary ab-strong small">Allo&nbsp;</span>
													</td>	
													<td style="width:33%;">
														<span class="text-primary ab-strong small">P.O.&nbsp;</span>
													</td>	
												</tr>
											</table>
										</td>
									</tr>
								</table>

								<div ng-repeat="specDet in vsl_replOrders | AB_noDoubles:'ORNUM,ORLIN,STPSQ,VIN_LSHE_LOTID' "
								ng-if="specRow.ORNUM==specDet.ORNUM&&specRow.ORLIN==specDet.ORLIN&&specRow.STPSQ==specDet.STPSQ&&specDet.VIN_LSHE_LOTID" >
								<table style="width:100%;" ng-init="specRow.hasDetail=true" class="small ab-strong ">
									<tr>
										<td style="width:55%;">
											{{specDet.VIN_LSHE_LOTID}}
											<span class="{{specDet.VIN_LSHE_SERNO>0?'':'hidden'}}" >
												[{{specDet.VIN_LSHE_SERNO}}]
											</span>
											
										</td>	
										<td style="width:10%;">
											
											{{specDet.LOTQT}}
										</td>
										<td style="width:35%;">
											<table style="width:100%;" 
											ng-repeat="lotRow in vin_item_replenish | AB_noDoubles:'idVIN_LSHE' " 
											ng-if="lotRow.rTable=='vin_lslq'&&lotRow.idVIN_LSHE==specDet.idVIN_LSHE ">
												<tr>
													<td style="width:34%;" class="ab-border ab-spaceless">
														<span >
															{{lotRow.BOHQT}}
														</span>
													</td>
													<td style="width:33%;" class="ab-border ab-spaceless">
														<span >
															{{lotRow.ALOQT}}
														</span>
													</td>
													<td style="width:33%;" class="ab-border ab-spaceless">
														<span >
															{{lotRow.PURQT}}
														</span>
													</td>											
												</tr>
											</table>
										</td>
									</tr>
								</table>
								</div>							
							</div>
					
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  ">

								<table style="width:100%;" ng-if="specRow.hasDetail==true" class="small ab-strong">
									<tr>
										<td style="width:75%;">
											<span class="text-primary ab-strong small">Spec Id&nbsp;</span>
										</td>	
										<td style="width:25%;">
											<span class="text-primary ab-strong small">Days&nbsp;</span>
										</td>
									</tr>
								</table>

								<div ng-repeat="specDet in vsl_replOrders | AB_noDoubles:'ORNUM,ORLIN,VIN_SSMA_SPEID' "
								ng-if="specRow.ORNUM==specDet.ORNUM&&specRow.ORLIN==specDet.ORLIN&&specDet.VIN_SSMA_SPEID" >
								<table style="width:100%;" ng-init="specRow.hasDetail=true" class="small ab-strong">
									<tr>
										<td style="width:75%;">
											{{specDet.VIN_SSMA_SPEID}}
										</td>	
										<td style="width:25%;">
											
											{{specDet.VIN_SSMA_SUETA}}
										</td>
									</tr>
								</table>
								
								</div>
							</div>
						</div>
					</div>

				</div>	


EOC;

echo $purchOrders . $purchOrdersRepeat . $purchOrdersBottom;



?>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  text-primary rpl_detail hidden" 
					ng-if="headRow.hasOrderSales==true||headRow.hasOrderPurch==true"
					style="border-bottom:solid;border-width:2px;">
				</div>

			</div>
			<div class="col-lg-1">
			</div>

		</div>
	</div>
</div>

			
			
<div class="row" id="orderDetail" ng-if="ordersAll==1" >

	<div class="ab-wrapper-div">
	<div class="row">
		<div class="col-lg-1">
			<input class="hidden" ng-model="headRow.hasOrderSales" />
		</div>	
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12  " ng-init="headRow.hasOrderSales=false">
<?php		
echo $salesOrders . $salesOrdersRepeat . $salesOrdersBottom;
?>
		</div>
		<div class="col-lg-1">
		</div>	
	</div>

	<div class="row">
		<div class="col-lg-1">
			<input class="hidden" ng-model="headRow.hasOrderPurch" />
		</div>	
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12  " ng-init="headRow.hasOrderPurch=false">
<?php		
echo $purchOrders . $purchOrdersRepeat . $purchOrdersBottom;		
?>
		</div>
		<div class="col-lg-1">
		</div>	
	</div>
	</div>
	<script>
		setTimeout("$('#orderDetail').find('.rpl_detail').removeClass('hidden');",500)
	</script>
	
</div>			

<div ng-init="abAppOpen=0;abAppLinkOpen=false" ></div>

<div class="row" id="orderDetailOrder" ng-if="mainSearchOrder!=''&&ordersAll==0" >

<span class="hidden" id="openDetailOrder" data-toggle="modal" data-target="#orderselect" ></span>	
<div id="orderselect" class="modal fade" role="dialog"  >
  <div class="modal-dialog" style="width:90%;">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header {{abAppOpen==0?'':'hidden'}}">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
        	<span class="text-primary" >{{modalOrder}}Order Display </span> 
        </h4>
        
      </div>
      <div class="modal-body "  >
      
	<div class="ab-wrapper-div {{abAppOpen==0?'':'hidden'}}">
	<div class="row " >

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " ng-init="headRow.hasOrderSales=false">
<?php		
echo $salesOrders . $salesOrdersDetRepeat . $salesOrdersBottom;
?>
		</div>

		
	</div>

	<div class="row ">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " ng-init="headRow.hasOrderPurch=false">
<?php		
echo $purchOrders . $purchOrdersDetRepeat . $purchOrdersBottom;		;		
?>
		</div>
		<input id="hiddenModal" class="hidden" ng-click="ABsetField('mainSearchOrder','');" />
	</div>
	</div>
	
	<div class="row hidden" >
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " >
			
			<div class="{{abAppOpen==1?'':'hidden'}}" style="width:100%;height:600px;" >
			
			<iframe id="orderEditor" class="ab-borderless" name="ab-obj-app-hideHeader" neg-if="abAppLinkOpen==true"
			 width="100%" height="100%" scrolling="no" src="" >
			Sorry cannot open with this browser. Try Chrome.
			</iframe>
			<!--
			<object name="ab-obj-app-hideHeader" type="text/html"  width="100%" height="600px" data="#/VSL_ORDERS/VSL_ORHECT/idVSL_ORHE:80,updType:UPDATE,Session:VSL_ORHECT,Process:VSL_ORDERS">
			Sorry cannot open with this browser. Try Chrome.
			</object>
			-->
			</div>


		</div>
	</div>
	<div class="row " >
		<div id="orderDsp" class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " >
			Edit {{currOrnum}}
		</div>
	</div>		
	
	<script>
		function orderDetailOrderShow()
		{
			setTimeout("$('#orderDetailOrder').find('.rpl_detail').removeClass('hidden');$('#openDetailOrder').click();",500)
		}
		$('#orderselect').on('hidden.bs.modal', function () {
			$("#hiddenModal").click();;
		});		
	</script>
      </div>
      <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                 <button type="button"  data-dismiss="modal" ng-click="abAppOpen=0;abAppLinkOpen=false">
        	<span class="text-primary" >Close {{modalOrder}}Order </span> 
        	</button>
        </h4>

        
      </div>

    </div>

  </div>
</div>	
	
</div>			

