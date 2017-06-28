<div class="hidden">
<?php 
session_start();
ob_clean();
?>
</div>
<div class="hidden">​
<!-- require_once "../appCscript/VIT_ISSUES.php"; --> 
​
<?php 
require_once "../stdSscript/stdAppobjGen.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
require_once "../appCscript/VAP_FINANCE.php";

$xtmp = new appForm("VAP_OITEMCK");

?>
​
<style>
.ACdropdown {
    display: none;
}
​
.ACdropdown-content {
​
    display: block;
    position: absolute;
    min-width:250px;
    background-color:white;
    color:black;
    
    box-shadow: 8px 8px 8px 8px rgba(0,0,0,0.2);
​
    z-index:1;
}
​
​
</style>
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
      
      
<textarea class="hidden" ab-updSuccess="" >

	$scope.getPayments($scope.currentRec);

</textarea>
	      
</div>



<div class="row " ng-init="SESSION_DESCR='Bank Reconciliation';" >

<div class="col-lg-12 ab-spaceless ">
    <?php require_once "../stdCscript/stdFormButtons.php"; ?>
    <script>
        $('#ab-sysOpt').addClass("{{checkSelectCC()==true?'':'hidden'}}");
        $('#ab-delete').html(" ");
        $('#ab-create').html(" ");
 //       $('#ab-new').html('');
    </script>
    
</div>


<div class="col-lg-3 ">   
		
		<div class="row ">
		&nbsp;
		</div>
		<div class="row ab-spaceless">
			<input ng-model="vapPcFormPg" class="hidden" />
			<div class="col-sm-4 well ab-spaceless ab-pointer " 
			 ng-click="setVapPcForm(0);getPayments(currentRec);" >
				<span class=" {{vapPcFormPg==0?'text-primary':''}}" >
					<span class="glyphicon glyphicon-ok {{vapPcFormPg==0?'text-primary':'invisible'}}" ></span>
					&nbsp;
					<span ab-label="STD_OUTSTANDING" >..Outstanding</span>
					&nbsp;
					</span>
					<span ng-init="setOrgvapPcFormPg(0);"></span>
				</span>
			</div>
			<div class="col-sm-4 well ab-spaceless ab-pointer" 
				ng-click="setVapPcForm(1);getPayments(currentRec);" >
				<span class=" {{vapPcFormPg==1?'text-primary':''}}" >
					<span class="glyphicon glyphicon-ok {{vapPcFormPg==1?'text-primary':'invisible'}}" ></span>
					&nbsp;
					<span ab-label="STD_RECONCILED" >..Reconciled</span>
					&nbsp;
				</span>
				<span ng-init="setOrgvarFormPg(1);"></span>
		
			</div>

			
		</div>			

		<div class="row">
		<table>
		<tr>
		<td>
		&nbsp;
		</td>
		<td class=" {{idVGB_CURR_current>0?'':'hidden'}} ">
			<span class="ab-strong {{cancelTransaction==1?'text-danger':''}} {{vapPcFormPg==1?'':'hidden'}}" >
				<span ng-if="cancelTransaction==1"  class="ab-border ab-spaceless" ng-click="cancelRecon(0)">
					<span class="glyphicon glyphicon-ok" ></span>
				</span>
				<span ng-if="cancelTransaction!=1" class="ab-border ab-pointer ab-spaceless" ng-click="cancelRecon(1)" >
					<span class="invisible">
						<span class="glyphicon glyphicon-ok" ></span>
					</span>
				</span>
				&nbsp;Cancel&nbsp;
				<span ab-label="STD_RECONCILED" >..Reconciled</span>
			</span>
		</td>
		</tr>
		</table>
		</div>
		
		
​<table style="width:100%;" class="table-striped">

	<tr><td colspan=10></td></tr>
	<tr class="text-primary ab-strong">
		<td>
			<input ng-model="idVGB_CURR_current" class="hidden"  size=2  />
			<input ng-model="idVGL_BANK_current" class="hidden"  size=2 />
			<input ng-model="VGL_BANK_PMTDE_current" class="hidden"  size=2 />
			
			<input ng-model="updateOn" class="hidden"  size=2 />
		</td>	
		<td colspan=2 class="text-center">
			<span ab-label="VGL_BANK_PMTDE_SH"></span>
		</td>
		<td>
			<span ab-label="STD_RATE"></span>
		</td>
		<td class="text-right">
			<span ab-label="VGB_CURR_RADAT"></span>
		</td>
	</tr>	
	<tr 	ng-repeat="curr in rawResult.vap_banks  | AB_noDoubles:'idVGL_CHART' " 
		ng-if="curr.VGL_BANK_CHECK =='1'"
		class="{{idVGL_BANK_current==curr.idVGL_BANK?'ab-strong':''}}" >
		<td>
			<span  class="text-primary" >
				<span ng-if="idVGL_BANK_current==curr.idVGL_BANK"  class="ab-border ab-spaceless">
					<span class="glyphicon glyphicon-ok" ></span>
				</span>
				<span ng-if="idVGL_BANK_current!=curr.idVGL_BANK" class="ab-border ab-pointer ab-spaceless" 
					ng-click="setCurrency(curr)" >
					<span class="invisible">
						<span class="glyphicon glyphicon-ok" ></span>
					</span>
				</span>
			</span>
			&nbsp;
		</td>
		<td class="text-right" >
			{{curr.VGL_CHART_GLIDN}}&nbsp;-&nbsp;{{curr.VGB_CURR_CURID}}&nbsp;&nbsp;
		</td>
		<td>
			{{curr.VGL_CHART_GLDES}}
		</td>
		<td>
			{{curr.VGB_CURR_CURAT}}
		</td>
		<td class="text-right">
			{{curr.VGB_CURR_RADAT}}
		</td>
	</tr>
	</tr>

</table>	

<div class="hidden">
<input class='text-muted' ab-mpp onchange="getMaxPerPage();" value="0" />
</div>

</div>

<div class="col-lg-9 {{idVGB_CURR_current>0?'':'hidden'}}""> 
<div class="col-sm-12" > 
<form id="mainForm" name="mainForm" ab-view="vap_oihe" ab-main="vap_outstanding"  > 
<table style="width:100%;" class="{{cancelTransaction!=1?'text-primary':'text-danger'}}" >
<tr>
<td style="width:10%;">
<input class="hidden" ab-btrigger="vap_oihe" ng-model="idVAP_OIHE"  />
<input class="hidden" ab-btrigger="vap_oihe" ng-model="idVGL_BANK"  />
<input class="hidden" ng-model="CURRENCYID"  />
<input class="hidden" ng-model="BANKID"  />
<input class="hidden" ng-model="currentBank.VGL_BANK_CURID" ng-bind="CURRENCYID=currentBank.VGL_BANK_CURID "/>
<input class="hidden" ng-model="currentBank.idVGL_BANK" ng-bind="BANKID=currentBank.idVGL_BANK"/>
<input class="hidden" ng-model="currentBank.VGL_BANK_PMTTY" />
<input class="hidden" ng-model="currentBank.VGL_BANK_TYDET" />
<input class="hidden" ng-model="originalNEXCK" size=2 />
<input class="hidden" ng-model="cancelTransaction" ng-init="cancelTransaction=0" />
</td>
<td style="width:25%;">
<span class="ab-border ab-strong">
	(&nbsp;{{vap_oihe_pmt.length}}&nbsp;) &nbsp;Payment(s)&nbsp;
	<span class=" {{vapPcFormPg==0?'':'hidden'}}" ab-label="STD_OUTSTANDING" >..Outstanding</span>
	<span class=" {{vapPcFormPg==1?'':'hidden'}}" ab-label="STD_RECONCILED" >..Reconciled</span>
</span>
</td>
<td style="width:65%;">
	<table class='{{vapPcFormPg==1?"":"invisible"}}'>
	<tr>
		<?php 
		$xtmp = new appForm("VAP_OITEMCC");
		$hardCode = $xtmp->setDatePick("doc_date_from");
		echo "<td >&nbsp;<span class='text-primary ab-strong' ab-label='STD_FROM'></span>&nbsp;</td>";
		echo "<td >" . $hardCode . "</td>";
		$hardCode = $xtmp->setDatePick("doc_date_to");
		echo "<td >&nbsp;<span class='text-primary ab-strong' ab-label='STD_TO'></span>&nbsp;</td>";
		echo  "<td >" .$hardCode . "</td>";
		?>
		<td class="text-primary text-left ab-strong" >
			<span class="ab-pointer ab-border ab-spaceless" ng-click="getPayments(currentRec);" >
				&nbsp;Refresh&nbsp;
			</span>&nbsp;
		</td>
		
	</tr>
	</table>
</td>					

</tr>
</table>
</form>
</div>
<div class="col-sm-12 " > 
	<div class="ab-wrapper-div">
	<table	class=" table-striped ab-strong" style="width:100%;" >
	<tr class="text-primary" >
		<td style="width:9%;"  >&nbsp;&nbsp;<span ab-label="STD_POST_DATE">Date</span></td>
		<td style="width:9%;"  >&nbsp;&nbsp;<span ab-label="STD_CREATED">Date Created</span></td>
		<td style="width:10%;">
		Supplier
		</td>
		<td style="width:10%;" class="text-center" ></td>
		<td style="width:16%;"  >Type&nbsp;-&nbsp;ID</td>
		<td style="width:10%;" class="text-right" >Amount</td>
		
		<td style="width:36%;" >&nbsp;&nbsp;&nbsp;&nbsp;Reference&nbsp;&nbsp;
		</td>
	</tr>
	</table>
	</div>
	<div class="ab-wrapper-div">
		<table	class=" table-striped " style="width:100%;" >
		<tr class="text-primary" >
			<td style="width:18%;" ></td>
			<td style="width:10%;" ></td>
			<td style="width:10%;" ></td>
			<td style="width:16%;" ></td>
			
			<td style="width:10%;" ></td>			
			<td style="width:36%;" ></td>
		</tr>
		
		<tr ab-formlist="oihe_list"  class="{{OIT.SELECT==1?'ab-strong':''}}"
			ng-repeat="OIT in vap_oihe_pmt| AB_noDoubles:'idVAP_OIHE' " 
			ng-if="OIT.idVAP_OIHE>0" >
			
			<td colspan=100 >
			<div>
			<form ab-view="oihe_list" ab-main="oihe_list" ab-context="0" >
			<table style="width:100%;" >
			<tr class="text-primary" >
				<td style="width:18%;"><input ng-model="OIT.idVAP_OIHE" class="hidden" /></td>
				<td style="width:10%;"></td>
				<td style="width:10%;"></td>
				<td style="width:16%;"></td>
				<td style="width:10%;"></td>
				<td style="width:36%;"></td>
			</tr>
			</table>			
			<table style="width:100%;" >
			<tr class="text-primary" >
				<td style="width:18%;"><input ng-model="OIT.idVAP_OIHE" class="hidden" /></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:16%;" ></td>

				<td style="width:10%;" ></td>
				<td style="width:36%;" ></td>
			</tr>
			<tr>			
			<td>
				<table style="width:100%">
				<tr >
				<td style="width:50%">
					<input ng-model="OIT.SELECT" ng-init="OIT.SELECT=0" class="hidden" />
					<span ng-if="vapPcFormPg==0||cancelTransaction==1">
						<span  class="{{cancelTransaction!=1?'text-primary':'text-danger'}}" >
							<span ng-if="OIT.SELECT==1"  class="ab-border  ab-pointer  ab-spaceless" ng-click="OIT.SELECT=0;checkSelectCC();" >
								<span class="glyphicon glyphicon-ok" ></span>
							</span>
							<span ng-if="OIT.SELECT==0" class="ab-border ab-pointer ab-spaceless" ng-click="OIT.SELECT=1;checkSelectCC();"  >
								<span class="invisible">
									<span class="glyphicon glyphicon-ok" ></span>
								</span>
							</span>
						</span>
					</span>
	
					&nbsp;
					{{OIT.VAP_OIHE_DOCDA}}
					<input ng-model="OIT.VAP_OIHE_DOCDA" class="hidden"  />
				</td>
				<td style="width:50%" title="Time: {{OIT.VAP_OIHE_CDATE.slice(11)}}" >

					<span class="{{OIT.VAP_OIHE_CDATE.indexOf(OIT.VAP_OIHE_DOCDA)==-1?'':'hidden'}}" >
						{{OIT.VAP_OIHE_CDATE.slice(0,11)}}
					</span>
					<span class="{{OIT.VAP_OIHE_CDATE.indexOf(OIT.VAP_OIHE_DOCDA)>-1?'':'hidden'}}" >
						<span ab-label="STD_SAME" class="small" >Same day</span>
					</span>
					
				</td>
				</tr>
				</table>
			</td>		
			<td colspan=2 class="small ab-strong text-left" >
				{{OIT.VGB_SUPP_BPNAM}}
			</td>
			<td>
				<span 	ng-repeat="curr in rawResult.vap_banks  | AB_noDoubles:'idVGL_BANK' " 
					ng-if="curr.idVGL_BANK == OIT.VAP_OIHE_BNKID" >
					
				{{curr.VGL_BANK_PMTDE}}&nbsp;
				</span>
				#{{OIT.VAP_OIHE_CHKID}}
			</td>
			<td class="text-right" >
				<input ng-model="OIT.VAP_OIHE_AMUNT" class="hidden" />
				$&nbsp;{{ABGetNumberFn("fmt-curr",OIT.VAP_OIHE_AMUNT*-1)}}

			</td>

			<td>
				<input ng-model="OIT.VAP_OIHE_REFER" class="hidden" />
				&nbsp;&nbsp;&nbsp;&nbsp;
				{{OIT.VAP_OIHE_REFER}}

			</td>	
			</tr>

			</table>
			</form>
			</div>
			
			</td>
		</tr>
		</table>
	</div>
		
	
</div>

</div>
</div>



</div>

   </div>
   
</div> 
</div> 

<div id="checkRun" class="hidden" >
	
			<table ng-repeat="OIT in payMain " ng-if="OIT.VGL_BANK_CHECK=='1'"  style="{{$last!=true?'page-break-after: always;':''}}" >
							<tr >
								<td><br><br><br></td>
							</tr>
							<tr>
								<td width="450" ></td>
								
								<td width="100"  >
									{{OIT.VAP_OIHE_DOCDA.slice(0,4)}}&nbsp;
									{{OIT.VAP_OIHE_DOCDA.slice(5,7)}}&nbsp;
									{{OIT.VAP_OIHE_DOCDA.slice(8,10)}}
								</td>
							</tr>
							<tr >
								<td><br><br><br></td>
							</tr>
							
							<tr >
								<td width="20" ><br><br></td>
								<td width="420" align="center" style="font-size:10px;" >
								<br><br>
								{{OIT.amtWord}}
								<td width="100" style="font-size:14px;" >
									<b>{{ABGetNumberFn("fmt-curr",OIT.VAP_OIHE_AMUNT*-1)}}&nbsp;&nbsp;&nbsp;</b>
								</td>
								
							</tr>
							<tr >
								<td><br><br><br></td>
							</tr>
							<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td class="addr">
								
									<span >{{OIT.VGB_ADDR_ADNAM}}</span><br>
									<span >{{OIT.VGB_ADDR_ADD01}}</span><br>
									<span ng-if="OIT.VGB_ADDR_ADD02.length>0" >{{OIT.VGB_ADDR_ADD02}}<br></span>
									<span id="PAY_ADD5" >{{OIT.VGB_ADDR_CITYN}},&nbsp;{{OIT.VGB_PRST_DESCR}}</span><br>
									<span >{{OIT.VGB_ADDR_POSTC}}</span>
									<span ng-if="OIT.VGB_ADDR_ADD02.length==0" ><br></span>									
								</td>
								<td valign="top" class="small" align="right"><span id="PAY_CHECK" >{{OIT.VAP_OIHE_CHKID}}</span></td>
							</tr>						
							<tr >
								<td><br><br><br></td>
							</tr>
							<tr>
								<td width="10" >&nbsp;</td>
								<td width="520" >
									<table width="100%" border="1" >
										<tr>
											<td width="35%">	
												&nbsp;&nbsp;
												<span >{{OIT.VGB_SUPP_BPNAM}}</span>
												&nbsp;&nbsp;
											</td>

											<td width="15%">	
												&nbsp;&nbsp;Ck#:&nbsp;&nbsp;<span >{{OIT.VAP_OIHE_CHKID}}</span>&nbsp;&nbsp;
											</td>
											<td width="15%" >											
												&nbsp;&nbsp;Date:&nbsp;&nbsp;<span >PAY_DATE</span>&nbsp;&nbsp;
										  	</td>
											<td width="20%" >																				
												&nbsp;&nbsp;Mnt/Amt:&nbsp;&nbsp;
												<span >
												{{ABGetNumberFn("fmt-curr",OIT.VAP_OIHE_AMUNT*-1)}}
												</span>&nbsp;&nbsp;
											</td>
											<td width="15%" >																				
												&nbsp;&nbsp;Page:&nbsp;&nbsp;
												<span >1</span>
												&nbsp;/&nbsp;
												<span >1</span>&nbsp;&nbsp;
											</td>									
										</tr>
									</table>
								</td>
								<td width="10" >&nbsp;</td>
							</tr>
							<tr >
								<td><br></td>
							</tr>
							<tr >
								<td width="25"></td>	
								<td width="100"><b>Facture / Invoice</b></td>
								<td width="60"><b>Date</b></td>
								<td width="75"><b>Montant / Amount</b></td>
								<td width="30"></td>									
								<td width="100"><b>Facture / Invoice</b></td>
								<td width="60"><b>Date</b></td>
								<td width="75"><b>Montant / Amount</b></td> 
								<td width="75">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>
							
							<tr ng-repeat="OITDET in payStub " ng-if="OIT.idVAP_OIHE == OITDET.idVAP_OIHE">
								<td width="25"></td>	
								<td width="100" >
									<span ng-if="OITDET.leftVAP_OIHE_OITTY.length>0" >{{OITDET.leftVAP_OIHE_OITTY}}-&nbsp;{{OITDET.leftVAP_OIHE_REFER}}</span>
								</td>
								<td width="60">
									<span ng-if="OITDET.leftVAP_OIHE_OITTY.length>0" >{{OITDET.leftVAP_OIHE_DOCDA}}</span>
								</td>
								<td width="75">
									<span ng-if="OITDET.leftVAP_OIHE_OITTY.length>0" >PA&nbsp;&nbsp;{{ABGetNumberFn("fmt-curr",OITDET.leftVAP_OIDE_AMUNT*-1)}}</span>
								</td> 
								
								<td width="30"></td>	
								
								<td width="100" >
									<span ng-if="OITDET.rightVAP_OIHE_OITTY.length>0" >{{OITDET.rightVAP_OIHE_OITTY}}-&nbsp;{{OITDET.rightVAP_OIHE_REFER}}</span>
								</td>
								<td width="60">
									<span ng-if="OITDET.rightVAP_OIHE_OITTY.length>0" >{{OITDET.rightVAP_OIHE_DOCDA}}</span>
								</td>
								<td width="75">
									<span ng-if="OITDET.rightVAP_OIHE_OITTY.length>0" >PA&nbsp;&nbsp;{{ABGetNumberFn("fmt-curr",OITDET.rightVAP_OIDE_AMUNT*-1)}}</span>
								</td> 
							</tr>
							<tr >
								<td><br><br><br></td>
							</tr>
							<tr>
								<td width="10" >&nbsp;</td>
								<td width="520" >
									<table width="100%" border="1" >
										<tr>
											<td width="35%">	
												&nbsp;&nbsp;
												<span >{{OIT.VGB_SUPP_BPNAM}}</span>
												&nbsp;&nbsp;
											</td>

											<td width="15%">	
												&nbsp;&nbsp;Ck#:&nbsp;&nbsp;<span >{{OIT.VAP_OIHE_CHKID}}</span>&nbsp;&nbsp;
											</td>
											<td width="15%" >											
												&nbsp;&nbsp;Date:&nbsp;&nbsp;<span >PAY_DATE</span>&nbsp;&nbsp;
										  	</td>
											<td width="20%" >																				
												&nbsp;&nbsp;Mnt/Amt:&nbsp;&nbsp;
												<span >
												{{ABGetNumberFn("fmt-curr",OIT.VAP_OIHE_AMUNT*-1)}}
												</span>&nbsp;&nbsp;
											</td>
											<td width="15%" >																				
												&nbsp;&nbsp;Page:&nbsp;&nbsp;
												<span >1</span>
												&nbsp;/&nbsp;
												<span >1</span>&nbsp;&nbsp;
											</td>									
										</tr>
									</table>
								</td>
								<td width="10" >&nbsp;</td>
							</tr>
							<tr >
								<td><br></td>
							</tr>
							<tr>
								<td width="25"></td>	
								<td width="100"><b>Facture / Invoice</b></td>
								<td width="60"><b>Date</b></td>
								<td width="75"><b>Montant / Amount</b></td>
								<td width="30"></td>									
								<td width="100"><b>Facture / Invoice</b></td>
								<td width="60"><b>Date</b></td>
								<td width="75"><b>Montant / Amount</b></td> 
								<td width="75">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>
							<tr ng-repeat="OITDET in payStub " ng-if="OIT.idVAP_OIHE == OITDET.idVAP_OIHE">

								<td width="25"></td>	
								<td width="100" >
									<span ng-if="OITDET.leftVAP_OIHE_OITTY.length>0" >{{OITDET.leftVAP_OIHE_OITTY}}-&nbsp;{{OITDET.leftVAP_OIHE_REFER}}</span>
								</td>
								<td width="60">
									<span ng-if="OITDET.leftVAP_OIHE_OITTY.length>0" >{{OITDET.leftVAP_OIHE_DOCDA}}</span>
								</td>
								<td width="75">
									<span ng-if="OITDET.leftVAP_OIHE_OITTY.length>0" >PA&nbsp;&nbsp;{{ABGetNumberFn("fmt-curr",OITDET.leftVAP_OIDE_AMUNT*-1)}}</span>
								</td> 
								
								<td width="30"></td>	
								
								<td width="100" >
									<span ng-if="OITDET.rightVAP_OIHE_OITTY.length>0" >{{OITDET.rightVAP_OIHE_OITTY}}-&nbsp;{{OITDET.rightVAP_OIHE_REFER}}</span>
								</td>
								<td width="60">
									<span ng-if="OITDET.rightVAP_OIHE_OITTY.length>0" >{{OITDET.rightVAP_OIHE_DOCDA}}</span>
								</td>
								<td width="75">
									<span ng-if="OITDET.rightVAP_OIHE_OITTY.length>0" >PA&nbsp;&nbsp;{{ABGetNumberFn("fmt-curr",OITDET.rightVAP_OIDE_AMUNT*-1)}}</span>
								</td> 
							</tr>
				<tr>
					<td >
					</td>
				</tr>
				<tr>
					<td >
					</td>
				</tr>
				</table>


</div>