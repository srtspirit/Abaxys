
<input  id="orheVin_custCMD" class="hidden" data-dismiss="modal" ng-click="backOrderInsert(ordeId,backOrderOptionQty);" value="YES KEEP" />
<div id="orheVin_cust"  class="modal fade" role="dialog">
  <div class="modal-dialog">
  	
    <!-- Modal content
    <tr ng-repeat="lastPrice in rawResult.vin_cust" ng-if="lastPrice.VIN_CUST_BPART == VSL_ORHE_BTCUS && lastPrice.VIN_CUST_ITMID == x.VSL_ORDE_ITMID" >
    -->
    <div class="modal-content" ng-init="new_BTADD='';new_STADD=''">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span ab-label="" >Items purchased by </span> - <label >{{ VGB_CUST_BPNAM }}</label></h4>
       
        <table>
        <tr>
        	<td >

			<input ng-model="qlist_VIN_ITEM_ITMID" class="hidden" />
			<input ng-model="qlist_idVIN_ITEM" class="hidden" />
			<input ng-model="qlist_VIN_ITEM_DESC1" class="hidden" />
			<input ng-model="qlist_VIN_ITEM_DESC2" class="hidden" />
			<input ng-model="qlist_VIN_ITEM_DESC3" class="hidden" />
			<input ng-model="qlist_VIN_ITEM_LISTP" class="hidden" />
			<input ng-model="qlist_VIN_ITEM_UNITM" class="hidden" />
			<input ng-model="qlist_VIN_ITEM_UNSET" class="hidden" />
			<input ng-model="qlist_VIN_ITEM_LISTP" class="hidden" />
			<input ng-model="qlist_VIN_ITEM_LOTCT" class="hidden" />
        		<input ng-model="qlist_VSL_ORDE_OLTYP" class="hidden" />
                	
        	</td>

        </tr>
        </table>
        
      </div>
      <div class="modal-body">
        <table  style="width:100%;">
        <tr>
        	<td>
        		<table class="table" style="width:100%;" >


				<tr>
					<td colspan=5 >
						<table style="width:100%;" >
							<tr>
								<td>
									<span class="text-primary" ab-label="STD_TRANSPORT"></span>
								</td>
								<td>
									<input class="hidden" ng-model="VSL_ORHE_SHIPID" />
									<input readonly class="ab-borderless ab-strong" ng-model="VSL_ORHE_ORVIA" />
									
								</td>
								<td>	
									<span class="glyphicon glyphicon-th-list text-primary"
									ng-click="initSupportSVIA();"
									onclick="$('#SHIPVIAITMS').toggleClass('hidden');" >
									</span>
								</td>
							</tr>
						</table>
						<div id="SHIPVIAITMS" class="hidden">
							<table style="width:100%;" class="{{vgb_cust_svia.length>0?'':'hidden'}} text-primary small ab-strong">
								<tr >
									<td style="width:10%;" >
									</td>								
									<td style="width:30%;" >
										<span ab-label="VIN_ITEM_ITMID">Supp</span>
									</td>
									<td style="width:60%;" >
										<span ab-label="STD_DESCR">Acc&</span>
									</td>

								</tr>
								
							</table>
							<table style="width:100%;"  class="well" >
								<tr ng-repeat="custdet in vgb_cust_svia " 
								ng-if="custdet.idVGB_SVIA==VSL_ORHE_SHIPID&&custdet.idVIN_ITEM!=null&&custdet.VIN_ITEM_INVIT=='0'" >
									<td style="width:10%;" class="text-left" >
										<span class="btn-link" ng-if="currOrdeId < 1" data-dismiss="modal"
											currOrdeLine="{{currOrdeLine}}"
											idVIN_ITEM="{{custdet.idVIN_ITEM}}" 
											VIN_ITEM_ITMID="{{custdet.VIN_ITEM_ITMID}}" 
											VIN_ITEM_DESC1="{{custdet.VIN_ITEM_DESC1}}" 
											VIN_ITEM_DESC2="{{custdet.VIN_ITEM_DESC2}}" 
											VIN_ITEM_DESC3="{{custdet.VIN_ITEM_DESC3}}" 
											VIN_ITEM_LISTP="{{custdet.VIN_ITEM_LISTP}}" 
											VIN_ITEM_UNITM="{{custdet.VIN_ITEM_UNITM}}" 
											VIN_ITEM_UNSET="{{custdet.VIN_ITEM_UNSET}}" 
											VIN_ITEM_LISTP="{{custdet.VIN_ITEM_LISTP}}" 
											VIN_ITEM_LOTCT="{{custdet.VIN_ITEM_LOTCT}}" 
											VIN_ITEM_INVIT="{{custdet.VIN_ITEM_INVIT}}" 
											VSL_ORDE_OLTYP="{{custdet.VIN_ITEM_INVIT!='0'?'STD':'EXP'}}"
											VSL_ORDE_SUPID="{{custdet.VIN_SUPP_BPART}}" 
											
											onclick="
												
												deflectVal($(this).attr('idVIN_ITEM'),'qlist_idVIN_ITEM');
												deflectVal($(this).attr('VIN_ITEM_ITMID'),'qlist_VIN_ITEM_ITMID');
												deflectVal($(this).attr('VIN_ITEM_DESC1'),'qlist_VIN_ITEM_DESC1');
												deflectVal($(this).attr('VIN_ITEM_DESC2'),'qlist_VIN_ITEM_DESC2');
												deflectVal($(this).attr('VIN_ITEM_DESC3'),'qlist_VIN_ITEM_DESC3');
												deflectVal($(this).attr('VIN_ITEM_LISTP'),'qlist_VIN_ITEM_LISTP');
												deflectVal($(this).attr('VIN_ITEM_UNITM'),'qlist_VIN_ITEM_UNITM');
												deflectVal($(this).attr('VIN_ITEM_UNSET'),'qlist_VIN_ITEM_UNSET');
												deflectVal($(this).attr('VIN_ITEM_LISTP'),'qlist_VIN_ITEM_LISTP');
												deflectVal($(this).attr('VIN_ITEM_LOTCT'),'qlist_VIN_ITEM_LOTCT');
												deflectVal($(this).attr('VIN_ITEM_INVIT'),'qlist_VIN_ITEM_INVIT');
												deflectVal($(this).attr('VSL_ORDE_OLTYP'),'qlist_VSL_ORDE_OLTYP');
												deflectVal($(this).attr('VSL_ORDE_SUPID'),'qlist_VSL_ORDE_SUPID');
												
												$('#VIN_ITEMqlist' + $(this).attr('currOrdeLine')).click();
												"
										>
										Select
										</span>	
									</td>
									<td style="width:30%;" >
										{{custdet.VIN_ITEM_ITMID}}
					
									</td>
									<td style="width:60%;" >
										{{custdet.VIN_ITEM_DESC1}}
									</td>								
								</tr>
							</table>
						</div>					
					
					</td>
        			</tr>

        			<tr>
        				<td class="text-primary text-center  " >
						<span ab-label=""></span>
        				</td>
        				
        				<td class="text-primary text-center  " >
						<span ab-label="VIN_ITEM_ITMID"></span>
        				</td>
        				<td class="text-primary text-center  " >
  						<span ab-label="STD_DESCR"></span>
        				</td>
					<td class="text-primary text-center  " >
  						<span ab-label="">Last Date</span>
        				</td>

        				
        				
        			</tr>
        			
        			<tr ng-repeat="lastPrice in rawResult.vin_cust | AB_noDoubles:'idVIN_ITEM' | AB_sortReverse:'VIN_CUST_LPDATE' " ng-if="lastPrice.VIN_CUST_BPART == idVGB_CUST" >
        			 
        			 	<td>
						
						<span class="btn-link" ng-if="currOrdeId < 1" data-dismiss="modal"
							currOrdeLine="{{currOrdeLine}}"
							idVIN_ITEM="{{lastPrice.idVIN_ITEM}}" 
							VIN_ITEM_ITMID="{{lastPrice.VIN_ITEM_ITMID}}" 
							VIN_ITEM_DESC1="{{lastPrice.VIN_ITEM_DESC1}}" 
							VIN_ITEM_DESC2="{{lastPrice.VIN_ITEM_DESC2}}" 
							VIN_ITEM_DESC3="{{lastPrice.VIN_ITEM_DESC3}}" 
							VIN_ITEM_LISTP="{{lastPrice.VIN_ITEM_LISTP}}" 
							VIN_ITEM_UNITM="{{lastPrice.VIN_ITEM_UNITM}}" 
							VIN_ITEM_UNSET="{{lastPrice.VIN_ITEM_UNSET}}" 
							VIN_ITEM_LISTP="{{lastPrice.VIN_ITEM_LISTP}}" 
							VIN_ITEM_LOTCT="{{lastPrice.VIN_ITEM_LOTCT}}" 
							VIN_ITEM_INVIT="{{lastPrice.VIN_ITEM_INVIT}}" 
							VSL_ORDE_OLTYP="{{lastPrice.VIN_ITEM_INVIT!='0'?'STD':'EXP'}}"
							
							
							onclick="
								
								deflectVal($(this).attr('idVIN_ITEM'),'qlist_idVIN_ITEM');
								deflectVal($(this).attr('VIN_ITEM_ITMID'),'qlist_VIN_ITEM_ITMID');
								deflectVal($(this).attr('VIN_ITEM_DESC1'),'qlist_VIN_ITEM_DESC1');
								deflectVal($(this).attr('VIN_ITEM_DESC2'),'qlist_VIN_ITEM_DESC2');
								deflectVal($(this).attr('VIN_ITEM_DESC3'),'qlist_VIN_ITEM_DESC3');
								deflectVal($(this).attr('VIN_ITEM_LISTP'),'qlist_VIN_ITEM_LISTP');
								deflectVal($(this).attr('VIN_ITEM_UNITM'),'qlist_VIN_ITEM_UNITM');
								deflectVal($(this).attr('VIN_ITEM_UNSET'),'qlist_VIN_ITEM_UNSET');
								deflectVal($(this).attr('VIN_ITEM_LISTP'),'qlist_VIN_ITEM_LISTP');
								deflectVal($(this).attr('VIN_ITEM_LOTCT'),'qlist_VIN_ITEM_LOTCT');
								deflectVal($(this).attr('VIN_ITEM_INVIT'),'qlist_VIN_ITEM_INVIT');
								deflectVal($(this).attr('VSL_ORDE_OLTYP'),'qlist_VSL_ORDE_OLTYP');
								deflectVal($(this).attr('VSL_ORDE_SUPID'),'');
								
								
								$('#VIN_ITEMqlist' + $(this).attr('currOrdeLine')).click();
								"
						>
						Select
						</span>


        			 	
        			 	</td>
        				<td >
						{{lastPrice.VIN_ITEM_ITMID}}		
        				</td>
        				<td >
						{{lastPrice.VIN_ITEM_DESC1}}		
        				</td>

        				<td >
						{{lastPrice.VIN_CUST_LPDATE}}		
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
