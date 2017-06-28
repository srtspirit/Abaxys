<table style="width:100%;" class="{{OIT.RPOhidden==true?'hidden':''}}" ng-init="OIT.RPOhidden=true">
<tr class="ab-strong" >
	<td style="width:12%;">
	Trans.ID
	</td>
	<td style="width:40%;">
	Item&nbsp;&nbsp;
	</td>
	<td style="width:8%;" class="text-right"> Quantity </td>
	<td style="width:8%;" class="text-right"> Price&nbsp;</td>
	<td style="width:8%;" class="text-right"> Extension&nbsp;</td>
	<td style="width:8%;" class="text-right">New Qty</td>
	<td style="width:8%;" class="text-right">New Price&nbsp;</td>
	<td style="width:8%;" class="text-right">Extension&nbsp;</td>
	
	
</tr>



<tr ng-repeat="rpoitm in rawResult.vap_open_items | AB_noDoubles:'idVAP_OIHE_ITM' " 
ng-if="rpoitm.VAP_OIHE_BOOKID == OIT.idVAP_OIHE || rpoitm.VAP_OIHE_ITM_OITID == OIT.idVAP_OIHE " >
	
	<td ng-init="OIT.RPOhidden=false">
		{{rpoitm.VAP_OIHE_INVOI}}
		{{rpoitm.VGL_JNHE_TRNID}}
		
	</td>
	<td >
		<span class="ab-strong" ">
		{{rpoitm.VIN_ITEM_ITMID}}
		</span>
		
		<span class="small">
		-{{rpoitm.VAP_OIHE_ITM_DESCR}}
		</span>
		
		<span class="small text-primary ab-strong" ng-if="rpoitm.VIN_ITEM_ITTXT=='NOTAX'"><span class="small">no tax</span></span>
		<span class="small text-primary ab-strong" ng-if="rpoitm.VIN_ITEM_ITTXT!='NOTAX'"><span class="small">Taxable</span></span>
	</td>
	<td class="text-right">
		<span ng-if="rpoitm.VAP_OIHE_ITM_ORDQT_ORG!=0">
			{{rpoitm.VAP_OIHE_ITM_ORDQT_ORG}}&nbsp;
		</span>	
		
	</td>
	<td class="text-right">
		<span ng-if="rpoitm.VAP_OIHE_ITM_OUNET_ORG!=0">	
			{{ABGetNumberFn("fmt-curr",rpoitm.VAP_OIHE_ITM_OUNET_ORG)}}&nbsp;
		</span>			
	</td>
	<td class="text-right">
		<span ng-if="rpoitm.VAP_OIHE_ITM_EXTEN_ORG!=0">	
			{{ABGetNumberFn("fmt-curr", rpoitm.VAP_OIHE_ITM_EXTEN_ORG) }}&nbsp;
		</span>			
	</td>
	<td class="text-right">
		{{rpoitm.VAP_OIHE_ITM_ORDQT}}&nbsp;
		
	</td>
	<td class="text-right">
		{{ABGetNumberFn("fmt-curr",rpoitm.VAP_OIHE_ITM_OUNET)}}&nbsp;
		
	</td>
	<td class="text-right">
	
		{{ABGetNumberFn("fmt-curr", rpoitm.VAP_OIHE_ITM_EXTEN) }}&nbsp;
		
	</td>
	
</tr>
</table>