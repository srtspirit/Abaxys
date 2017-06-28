<span type="button" class="btn-link" data-toggle="modal" data-target="#orstQtyModal"></span>
<input  id="orstQtyModalCMD" class="hidden" data-dismiss="modal" ng-click="backOrderInsert(ordeId,backOrderOptionQty);" value="YES KEEP" />
<div id="orstQtyModal"  class="modal fade" role="dialog">
  <div class="modal-dialog">
  	
    <!-- Modal content 222-->
    
   
    <div class="modal-content" ng-init="new_BTADD='';new_STADD=''">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span ab-label="" >Quantity in step sequence </span> - <label> Back Order option</label></h4>
       
        <table>
        <tr>
        	<td >
                	
        	</td>

        </tr>
        </table>
        
      </div>
      <div class="modal-body">
        <table  style="width:100%;">
        <tr>
        	<td>
        		<table class="table" style="width:100%;" >
        			<tr class="{{retractRequired>0?'':'hidden'}}">
        				<td >

        					You must retract to         					
        					<span class="bg-warning">
							<span class="glyphicon glyphicon-triangle-left text-danger"></span>
					        	Purchase Order
				        	</span>
				        	if you want to change quantities.&nbsp;&nbsp;-&nbsp;	

        				</td>
        				
        			</tr>
        			<tr class="{{backOrderOption>0?'':'hidden'}}">
        				<td class="text-primary text-center  ab-border" >
        					<div>
	        					<input ng-model="orheBckOrd" class="hidden" />
	        					<button class="btn-lg ab-pointer {{orheBckOrd>0?'':'hidden'}}" ng-click="orheBckOrd=1-orheBckOrd" > 
			        				A quantity of {{backOrderOptionQty}} will be retained as back order!<br>Click this to <strong>cancel</strong> back order
		        				</button>
	        					<button class="btn-lg ab-pointer {{orheBckOrd<1?'':'hidden'}}" ng-click="orheBckOrd=1-orheBckOrd" > 
			        				The remaining quantity of {{backOrderOptionQty}} will not be retained!<br>Click this to <strong>retain</strong> back order
		        				</button>
		        			</div>
		        			<div class="text-danger ab-strong">
							{{orstLotMess}}
						</div>
		
        				</td>
        				
        			</tr>
        		
	        		
	        	</table>
        	</td>
        
        
        
        </tr>
        </table>
        
      </div>
      <div class="modal-footer">

        <button type="button" id="alaindismiss" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


