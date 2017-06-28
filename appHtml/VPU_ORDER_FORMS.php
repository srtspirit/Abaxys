<div class="row">	
	<div class="col-sm-12 ab-spaceless ab-border" >
	</div>
		
	<div class="col-sm-4" ng-init="htmlText=$('#txtH').html();" >
		<div class="row">
			<div class="col-sm-12 ab-spaceless" >
			  <textarea  ng-model="htmlText" ></textarea> <!-- -->
			
			<input class="hidden" ng-model="formSubmit" ng-init="formSubmit=0" />
			<span ng-if="formSubmit>0">
				<form action="AppPdfFormats/tcpdf/documents/formExec.php" method="post" 
				target="ABviewForm" >
					
					<input name="EXAMPLE" class="hdiden small" size=10 ng-model="tmpexe"  />
					<textarea name="html" class="hidden small" 
					ndg-init="VGB_SLRP_SLSRP=' ';ABlstAlias('VGB_SLRP_SLSRP','VGB_SLRP_SLSRP','vgb_slrp',0);" ng-model="htmlText" >
					</textarea>
	
	

					<input fosub="1" type="submit" 	onclick="deflectValText(localSetDocDta($('[tcpdform]').text()),'htmlText');"
					
					value="View" />
			
				</form>
			</span>	
			</div>
			

		</div>
	</div>
    

				
</div>

<script>
function localSetDocDta(docObj)
{
	var wObj = docObj;
	var newObj = "";
	
	while ( wObj.indexOf("$this.DOC_") > -1)
	{
		wObj = wObj.slice(wObj.indexOf("$this.DOC_")+ 6 );
		newObj += wObj.slice(0,wObj.indexOf(":")+1);
		wObj = wObj.slice(wObj.indexOf(":")+1);
		
		var tmp = "";
		if (wObj.indexOf("$this.DOC_") > -1)
		{
			tmp = wObj.slice(0,wObj.indexOf("$this.DOC_"));
		}
		else
		{
			tmp = wObj;
		}
		
//		if (tmp.indexOf("\n")>-1)
//		{
//			tmp = tmp.slice(0,tmp.indexOf("\n"))
//		}
		
		
		newObj += tmp.trim() + "[=REC=]\n";		
		
	}
	
	
	
	return newObj;
}
</script>

<div class="row">
<div class="col-sm-12">
	<iframe name="viewForm" style="width:100%;height:400px;" class="ab-borderless" src="" ></iframe>
</div>
</div> 




<div  class="hidden small">
	

	<div tcpdform ng-repeat="tcpdf in vpu_orhe  | AB_noDoubles:'idVPU_ORHE' ">
	<span>
		$this.DOC_FORM_HEAD:VPU_HF_ACKNOW
		$this.DOC_AUTHOR:<?php echo $_SESSION["AB_DUSA"]["userName"]; ?>
		$this.DOC_TITLE:Accus&#233; de r&#233;ception - Acknowledgement&nbsp;&nbsp;
		$this.DOC_REFERENCE:{{tcpdf.VPU_ORHE_ORNUM}}-{{formSelGrpId>0?formSelGrpId:'sample'}}
		$this.DOC_NUMBER:{{formSelGrpId>0?formSelGrpId:'sample'}}
		$this.DOC_DOCDATE:{{today_PDATE=ABGetDateFn('get-year','')+'-'+ABGetDateFn('get-month','')+'-'+ABGetDateFn('get-day','')}}
		$this.DOC_PARTNER_ID:{{tcpdf.VGB_BPAR_BPART}}
		$this.DOC_PARTNER_DSG:{{tcpdf.VGB_SUPP_BPNAM}}
		$this.DOC_PARTNER_REF:{{tcpdf.VPU_ORHE_CUSPO}}
		$this.DOC_PARTNER_TERM:{{tcpdf.VGB_TERM_DESCR}}
		$this.DOC_ORHE_ODATE:{{tcpdf.VPU_ORHE_ODATE}}
		$this.DOC_ORHE_ORNUM:{{tcpdf.VPU_ORHE_ORNUM}}
		$this.DOC_ORHE_ORVIA:{{tcpdf.VPU_ORHE_ORVIA}}
		$this.DOC_ORHE_ORFOB:{{tcpdf.VPU_ORHE_ORFOB}}
		$this.DOC_ORHE_SALESREP:{{tcpdf.VGB_SLRP_SRNAM}}
		$this.DOC_ORHE_MESSAGE:{{tcpdf.VPU_ORHE_ORTXT}}
		$this.DOC_ORHE_EXTREF:
		$this.DOC_ORHE_CURRENCY:{{tcpdf.VGB_CURR_DESCR}}
		$this.DOC_ORHE_CFCAT:{{tcpdf.VPU_ORHE_CFCAT}}
		$this.DOC_ORHE_LLIFE:{{tcpdf.VPU_ORHE_LLIFE}}
		$this.DOC_ORHE_ADD:{{vgb_addr.length}}
		$this.DOC_debug:{{vgb_addr.length}}
	</span>
	
		
	<span	ng-repeat="msgdetails in vgb_amhe | AB_noDoubles:'idVGB_AMHE'  " 
		ng-if="formMessValid(msgdetails)==true" >
		
		$this.DOC_MSG_ID-{{$index}}:{{msgdetails.idVGB_AMHE}}
		$this.DOC_MSG_DTEXT-{{$index}}:{{msgdetails.VGB_AMHE_DTEXT}}
		$this.DOC_MSG_STEPLIST-{{$index}}:{{msgdetails.VGB_AMHE_STEPLIST}}
		
	
	</span>
	
	<span	ng-repeat="mapaddr in vgb_addr | AB_noDoubles:'idVGB_ADDR' ">

			
		<span ng-repeat="address in mapaddr.rowSet | AB_noDoubles:'idVGB_ADDR' ">

			<span ng-if="address.idVGB_ADDR == tcpdf.VPU_ORHE_BTADD" >
				<input class="hidden" ng-model="btVGB_PRST_DESCR" ng-init="btVGB_PRST_DESCR = address.VGB_PRST_DESCR" >
			</span>

			<span ng-init="btVGB_CNTR_DESCR = address.VGB_CNTR_DESCR" ></span>
			
			<span ng-if="address.idVGB_ADDR == tcpdf.VPU_ORHE_STADD" >
				<span ng-init="stVGB_PRST_DESCR = address.VGB_PRST_DESCR" ></span>
				<span ng-init="stVGB_CNTR_DESCR = address.VGB_CNTR_DESCR" ></span>
			</span>
			
		</span>
		<span ng-repeat="tcAdd in mapaddr.rowSet | AB_noDoubles:'idVGB_ADDR' " 
		ng-if="tcAdd.idVGB_ADDR == tcpdf.VPU_ORHE_BTADD" >
			$this.DOC_BTADD_1:{{tcAdd.VGB_ADDR_ADNAM}}
			$this.DOC_BTADD_2:{{tcAdd.VGB_ADDR_ADD01}}
			$this.DOC_BTADD_3:{{tcAdd.VGB_ADDR_ADD02}}
			$this.DOC_BTADD_4:{{tcAdd.VGB_ADDR_CITYN}},&nbsp;{{tcAdd.VGB_PRST_DESCR}},&nbsp;{{tcAdd.VGB_CNTR_DESCR}}
			$this.DOC_BTADD_5:{{tcAdd.VGB_ADDR_POSTC}}
		</span>
	</span>	

	<span ng-repeat="tcAdd in rawResult.vgb_addr | AB_noDoubles:'idVGB_ADDR' " 
	ng-if="tcAdd.idVGB_ADDR == tcpdf.VPU_ORHE_STADD" >
		$this.DOC_STADD_1:{{tcAdd.VGB_ADDR_ADNAM}}
		$this.DOC_STADD_2:{{tcAdd.VGB_ADDR_ADD01}}
		$this.DOC_STADD_3:{{tcAdd.VGB_ADDR_ADD02}}
		$this.DOC_STADD_4:{{tcAdd.VGB_ADDR_CITYN}},&nbsp;{{tcAdd.VGB_PRST_DESCR}},&nbsp;{{tcAdd.VGB_CNTR_DESCR}}
		$this.DOC_STADD_5:{{tcAdd.VGB_ADDR_POSTC}}
	</span>	
	
	<span ng-repeat="tcAdd in rawResult.vpu_orheTax | AB_noDoubles:'idVTX_SCHE' " ng-if="tcAdd.idVGB_ADDR == tcpdf.VPU_ORHE_STADD" >
		$this.DOC_VTX_ID-{{$index}}:{{tcAdd.idVTX_SCHE}}
		$this.DOC_VTX_SEQ-{{$index}}:{{tcAdd.VTX_SCHE_SCHSQ}}
		$this.DOC_VTX_DESCR-{{$index}}:{{tcAdd.VTX_SCHE_SEQDE}}
		$this.DOC_VTX_TPREV-{{$index}}:{{tcAdd.VTX_SCHE_TPREV}}
		$this.DOC_VTX_TAXPE-{{$index}}:{{tcAdd.VTX_SCHE_TAXPE}}
	</span>

	<span ng-repeat="tcDet in vpu_orhe | AB_noDoubles:'idVPU_ORDE' " ng-if="tcDet.idVPU_ORHE == tcpdf.idVPU_ORHE && tcDet.idVPU_ORST > 0 && docStepValid(tcDet) == true && tcDet.VPU_ORDE_OLTYP!='BOR'" >
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_ITEMCODE:{{tcDet.VIN_ITEM_ITMID}}
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_ITMTAXTYPE:{{tcDet.VIN_ITEM_ITTXT}}
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_OLINETYPE:{{tcDet.VPU_ORDE_OLTYP}}
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_ITEMDESCR:{{tcDet.VPU_ORDE_DESCR}}
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_ITEMOTEXT:{{tcDet.VPU_ORDE_OTEXT}}
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_ITEMITEXT:{{tcDet.VPU_ORDE_ITEXT}}
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_DELDATE:{{tcDet.VPU_ORDE_DDATE}}
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_ORDQTY:0
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_NETPRICE:{{tcDet.VPU_ORDE_OUNET}}
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_LLINK:{{tcDet.VPU_ORDE_LLINK}}
		<span ng-if="tcDet.VPU_ORDE_CFCAT=='0'">
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_CFCAT:
		</span>
		<span ng-if="tcDet.VPU_ORDE_CFCAT=='1'">
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_CFCAT:C-C Cert
		</span>
		<span ng-if="tcDet.VPU_ORDE_CFCAT=='2'">
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_CFCAT:C-A Cert
		</span>
		<span ng-if="tcDet.VPU_ORDE_CFCAT=='3'">
		$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_CFCAT:C-C & C-A Cert
		</span>
		
		<span ng-repeat="uom in vin_unit | AB_noDoubles:'idVIN_UNIT' " ng-if="uom.idVIN_UNIT == tcDet.VPU_ORDE_SAUOM" >
			$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_UOFM:{{uom.VIN_UNIT_DESCR}}
		</span>
		
		<span	ng-repeat="sma in vin_item_ssma | AB_noDoubles:'idVIN_ITEM' " 
			ng-if="sma.idVIN_ITEM==tcDet.VPU_ORDE_ITMID" 
		>
			<span	ng-repeat="smaRows in rawResult.vin_item_ssma | AB_noDoubles:'idVIN_SSMA'  "
				ng-if="smaRows.idVIN_ITEM==tcDet.VPU_ORDE_ITMID && ((','+ tcDet.VPU_ORDE_LSPEC).indexOf(','+smaRows.idVIN_SSMA+',')>-1 || smaRows.idVIN_SSMA == tcDet.VPU_ORDE_LLINK)" 
			>
				$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_SPEC{{smaRows.idVIN_SSMA}}_ID:{{smaRows.idVIN_SSMA}}
				$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_SPEC{{smaRows.idVIN_SSMA}}_SPEID:{{smaRows.VIN_SSMA_SPEID}}
				$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_SPEC{{smaRows.idVIN_SSMA}}_DESCR:{{smaRows.VIN_SSMA_DESCR}}
				
			</span>


		</span>
		<span ng-repeat="quote in rawResult.vin_cust" 	ng-if="tcDet.VPU_ORDE_QUONU==quote.idVIN_CUST" >
			$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_QUOT_ID:{{quote.idVIN_CUST}}
			$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_QUOT_QUONU:{{quote.VIN_CUST_QUONU}}
		</span>
		
		<span ng-repeat="tcDst in vpu_orhe | AB_noDoubles:'idVPU_ORST' " ng-if="tcDet.idVPU_ORDE == tcDst.VPU_ORST_ORLIN  && formSelDocId == tcDst[formSelField] " >
			<span>
				$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_ORDQTY:{{tcDst.VPU_ORST_ORDQT}}
				$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_STEP:{{tcDst.VPU_ORST_STEPS}}
				$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_ORDQT:{{tcDst.VPU_ORST_ORDQT}}
				
				<span ng-repeat="lselRow in vin_inve  | AB_noDoubles:'idVIN_ITEM' "
				 	ng-if="tcDet.idVIN_ITEM == lselRow.VIN_LSHE_ITMID" 
				 >
				 	
					<span ng-repeat="lSel in rawResult.vin_inve  | AB_noDoubles:'idVIN_LSHE'  | AB_sortReverse:'VIN_LSHE_DOMDA' " 
					ng-if="tcDet.idVIN_ITEM == lSel.VIN_LSHE_ITMID && lSel.VIN_LSHE_SOLDO == 0" >	
							$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_ID:{{lSel.VIN_LSHE_LOTID}}
							$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_QT:0
							$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_DOM:{{ ABGetDateFn('get-year',lSel.VIN_LSHE_DOMDA) }}-{{ ABGetDateFn('get-month',lSel.VIN_LSHE_DOMDA) }}
							$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_ROWCOUNT:{{lselRow.rowSet.length}}
							<span ng-if="tcDet.VPU_ORDE_LLINK > 0 " >
	
	
								<span ng-repeat="tcSpec in specSheet[tcDet.VPU_ORDE_ITMID] "
								ng-if="tcSpec.idVIN_SSMA == tcDet.VPU_ORDE_LLINK && lSel.idVIN_LSHE == tcSpec.idVIN_LSHE" 
								ng-init="lSel.LSHE_DATES=ABGetDateFn('add-days',lSel.VIN_LSHE_DOMDA + ',' + tcSpec.VIN_SSMA_SHLIF);" 
								>
									$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_EXP:{{ ABGetDateFn('get-year',lSel.LSHE_DATES) }}-{{ ABGetDateFn('get-month',lSel.LSHE_DATES) }}
									$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_LIFE:{{ ABGetDateFn('diff-perc',lSel.VIN_LSHE_DOMDA + "," + lSel.LSHE_DATES) }}%
									$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_LIFEDEL:{{ ABGetDateFn('diff-perc',lSel.VIN_LSHE_DOMDA + "," + lSel.LSHE_DATES + "," + tcDet.VPU_ORDE_DDATE) }}%
									$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_MONTHS:{{ (ABGetDateFn('diff-today',lSel.LSHE_DATES)/12).toFixed(1) }}
								</span>
							</span>
							<span ng-if="tcDet.VPU_ORDE_LLINK < 1"> 						
								$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_EXP:{{ ABGetDateFn('get-year',lSel.VIN_LSHE_DATES) }}-{{ ABGetDateFn('get-month',lSel.VIN_LSHE_DATES) }}
								$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_LIFE:{{ ABGetDateFn('diff-perc',lSel.VIN_LSHE_DOMDA + "," + lSel.VIN_LSHE_DATES) }}%
								$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_LIFEDEL:{{ ABGetDateFn('diff-perc',lSel.VIN_LSHE_DOMDA + "," + lSel.VIN_LSHE_DATES + "," + tcDet.VPU_ORDE_DDATE) }}%
								$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_MONTHS:{{ (ABGetDateFn('diff-today',lSel.VIN_LSHE_DATES)/12).toFixed(1) }}
	
							</span>

							<span ng-repeat="lAq in vin_inve  | AB_noDoubles:'idVPU_LSTR' "  ng-if="lAq.idVPU_LSTR > 0 && lAq.VPU_LSTR_LOTSQ == lSel.idVIN_LSHE  && lAq.VPU_LSTR_ORLIN == tcDet.idVPU_ORDE && lAq.VPU_LSTR_STPSQ == tcDst.idVPU_ORST" >
								$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{lSel.idVIN_LSHE}}_QT:{{lAq.VPU_LSTR_ALOQT}}
							</span>
								
							
							
					</span>
				</span>
			</span>
		</span>
	</span>
</div>



<div class="hidden" >
					<span ng-repeat="lAq in vin_inve  | AB_noDoubles:'idVIN_LSHE'  | AB_sortReverse:'VIN_LSHE_DOMDA'" neg-if="lSel.VPU_LSTR_LOTSQ == lAq.idVIN_LSHE" >			
						$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{$index}}_ID:{{lAq.VIN_LSHE_LOTID}}
						$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{$index}}_QT:{{lSel.VPU_LSTR_ALOQT}}
						$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{$index}}_DOM:{{ ABGetDateFn('get-year',lAq.VIN_LSHE_DOMDA) }}-{{ ABGetDateFn('get-month',lAq.VIN_LSHE_DOMDA) }}
						$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{$index}}_EXP:{{ ABGetDateFn('get-year',lAq.VIN_LSHE_DATES) }}-{{ ABGetDateFn('get-month',lAq.VIN_LSHE_DATES) }}
						$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{$index}}_LIFE:{{ ABGetDateFn('diff-perc',lAq.VIN_LSHE_DOMDA + "," + lAq.VIN_LSHE_DATES) }}%
						$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{$index}}_LIFEDEL:{{ ABGetDateFn('diff-perc',lAq.VIN_LSHE_DOMDA + "," + lAq.VIN_LSHE_DATES + "," + tcDet.VPU_ORDE_DDATE) }}%
						$this.DOC_LINE{{tcDet.VPU_ORDE_ORLIN}}_{{tcDst.VPU_ORST_STPSQ}}_LOT{{$index}}_MONTHS:{{ (ABGetDateFn('diff-today',lAq.VIN_LSHE_DATES)/12).toFixed(1) }}
					</span>
</div>