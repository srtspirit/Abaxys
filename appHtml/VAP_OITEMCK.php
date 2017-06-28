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

	$scope.getPayments($scope.idVGL_BANK_current);
	if ($scope.varFormPg == 1 && data['posts'].checkRun.length > 0 )
	{
		$scope.setPayStubDta(data['posts'].checkRun);
	}

	



</textarea>
	      
</div>

<?php
$tFnc = new AB_querySession;
$dtaObj = array();$dtaObj['PROCESS'] = "VAP_FINANCE";$dtaObj['SESSION'] = "VAP_APPROVAL";
$Approval = $tFnc->hasPriviledge($dtaObj,"vgl_bank","Upd");
$dtaObj = array();$dtaObj['PROCESS'] = "VAP_FINANCE";$dtaObj['SESSION'] = "VAP_OITEMCK";
$Printing = $tFnc->hasPriviledge($dtaObj,"vgl_bank","Upd");
$dtaObj = array();$dtaObj['PROCESS'] = "VAP_FINANCE";$dtaObj['SESSION'] = "VAP_POSTING";
$Posting = $tFnc->hasPriviledge($dtaObj,"vgl_bank","Upd");
?>


<div class="row " ng-init="SESSION_DESCR='Payable Payment Control';" >

<div class="col-lg-12 ab-spaceless ">
    <?php require_once "../stdCscript/stdFormButtons.php"; ?>
    <script>
        $('#ab-sysOpt').addClass("{{checkSelect()==true?'':'hidden'}}");
        $('#ab-delete').html(" ");
        $('#ab-create').html(" ");
 //       $('#ab-new').html('');
    </script>
    
</div>


<div class="col-lg-3 ">   
		<div class="row hidden">
			<div class="col-sm-12 ab-spaceless" >
		
			<input class="hidden" ng-model="formSubmit" ng-init="formSubmit=0" />
			<span >
				<form id="ab-pdf-form" action="AppPdfFormats/tcpdf/documents/formExec.php" method="post" 
				target="ABviewForm" >
					
					<input name="EXAMPLE" class="hdiden small" size=10  value="VAP_CHECKS.php"  />
					<textarea name="checkDta" id="checkDta" > </textarea>

					<input id="checkPrint" fosub="1" type="submit" onclick="$('#checkDta').val($('#checkRun').html());"
					
					value="View" />
			
				</form>
			</span>	
			</div>
			
			<button ng-click="setPayStubDta();" >click</button>
		</div>  
		
		<div class="row ">
		&nbsp;
		</div>
		<div class="row ab-spaceless">
			<input ng-model="varFormPg" class="hidden" ng-init="varFormPg=-1 "/>
			<div class="col-sm-4 well ab-spaceless ab-pointer " ng-if="<?php echo $Approval; ?>==1"
			 ng-click="setVarForm(0);getPayments(idVGL_BANK_current);cancelTr(0);" >
				<span class=" {{varFormPg==0?'text-primary':''}}" >
					<span class="glyphicon glyphicon-ok {{varFormPg==0?'text-primary':'invisible'}}" ></span>
					&nbsp;
					Approval
					&nbsp;
					</span>
					<span ng-init="setOrgvarFormPg(0);"></span>
				</span>
			</div>
			<div class="col-sm-4 well ab-spaceless ab-pointer" ng-if="<?php echo $Printing; ?>==1"
				ng-click="setVarForm(1);getPayments(idVGL_BANK_current);cancelTr(0);" >
				<span class=" {{varFormPg==1?'text-primary':''}}" >
					<span class="glyphicon glyphicon-ok {{varFormPg==1?'text-primary':'invisible'}}" ></span>
					&nbsp;Printing&nbsp;
				</span>
				<span ng-init="setOrgvarFormPg(1);"></span>
		
			</div>
			<div class="col-sm-4 well ab-spaceless ab-pointer" ng-if="<?php echo $Posting; ?>==1"
				ng-click="setVarForm(2);getPayments(idVGL_BANK_current);cancelTr(0);" >
				<span class=" {{varFormPg==2?'text-primary':''}}" >
					<span class="glyphicon glyphicon-ok {{varFormPg==2?'text-primary':'invisible'}}" ></span>
					&nbsp;Posting&nbsp;
				</span>
				<span ng-init="setOrgvarFormPg(2);"></span>
		
			</div>
			
		</div>			

		<div class="row ">
		&nbsp;
			<span ng-if="idVGB_CURR_current>0" class="ab-strong {{cancelTransaction==1?'text-danger':''}}" >
				<span ng-if="cancelTransaction==1"  class="ab-border ab-spaceless" ng-click="cancelTr(0)">
					<span class="glyphicon glyphicon-ok" ></span>
				</span>
				<span ng-if="cancelTransaction!=1" class="ab-border ab-pointer ab-spaceless" ng-click="cancelTr(1)" >
					<span class="invisible">
						<span class="glyphicon glyphicon-ok" ></span>
					</span>
				</span>
				&nbsp;Cancel&nbsp;
				<span class="{{varFormPg==0?'':'hidden'}}" >Payment</span>	
				<span class="{{varFormPg==1?'':'hidden'}}" >Approval</span>
				<span class="{{varFormPg==2?'':'hidden'}}" >Check</span>
			</span>
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
	<tr ng-repeat="curr in rawResult.vap_banks  | AB_noDoubles:'idVGL_BANK' " class="{{idVGL_BANK_current==curr.idVGL_BANK?'ab-strong':''}}" >
		<td>
			<span  class="text-primary" >
				<span ng-if="idVGL_BANK_current==curr.idVGL_BANK"  class="ab-border ab-spaceless">
					<span class="glyphicon glyphicon-ok" ></span>
				</span>
				<span ng-if="idVGL_BANK_current!=curr.idVGL_BANK" class="ab-border ab-pointer ab-spaceless" ng-click="setCurrency(curr)" >
					<span class="invisible">
						<span class="glyphicon glyphicon-ok" ></span>
					</span>
				</span>
			</span>
			&nbsp;
		</td>
		<td class="text-right" >
			{{curr.VGL_BANK_PMTDE}}&nbsp;-&nbsp;{{curr.VGB_CURR_CURID}}&nbsp;&nbsp;
		</td>
		<td>
			{{curr.VGB_CURR_DESCR}}
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
<form id="mainForm" name="mainForm" ab-view="vap_oihe" ab-main=""  > 
<table style="width:100%;" class="" >
<tr>
<td style="width:5%;">
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
<td style="width:10%;" class="  {{cancelTransaction!=1?'text-primary':'text-danger'}} ab-strong">
{{VGL_BANK_PMTDE}} &nbsp; &nbsp;
</td>
<td style="width:15%;" class="  {{cancelTransaction!=1?'text-primary':'text-danger'}} ab-strong">
<span ng-repeat="chkcurr in rawResult.vgb_curr  | AB_noDoubles:'idVGB_CURR' " ng-if="idVGB_CURR_current==chkcurr.idVGB_CURR" >
{{chkcurr.VGB_CURR_DESCR}}&nbsp; &nbsp;
</span>
</td>
<td style="width:15%;" class="{{idVAP_OIHE>0&&varFormPg!=0?'':'hidden'}} {{cancelTransaction!=1?'':'hidden'}}">
<span class="text-primary ab-strong {{varFormPg==1?'':'hidden'}}" ab-label="STD_PMT_DATE" ></span>
<span class="text-primary ab-strong {{varFormPg==2?'':'hidden'}}" ab-label="STD_POST_DATE" ></span>
<?php
$xtmp = new appForm("VAP_OITEMCT");
$hardCode = $xtmp->setDatePick("POSTDATE");
echo $hardCode;
?>

</td>
<td style="width:55%;">

<table  style="width:100%;">
<tr>
<td class="{{idVAP_OIHE>0&&varFormPg==1?'':'hidden'}}  {{cancelTransaction!=1?'':'hidden'}}" >
<table style="width:100%;" >
<tr>
<td style="width:30%;">

<input class="hidden" ng-model="ignored" ng-init="ignored=0" />
<?php
$xtmp = new appForm("VAP_OITEMCT");
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "STD_CHK_NFNU";
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "8";
$inAttr['ng-blur'] = "validControlNumber(VGL_BANK_NEXCK);";
$xtmp->setFieldWrapper("view01","2.090","vap_oihe","VGL_BANK_NEXCK","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
?>
</td>
<td style="width:70%;">

<span class="text-danger ab-strong {{ignored>0?'':'hidden'}}" >
<span >{{ ignored }}&nbsp;&nbsp;<span ab-label="STD_CONTROL_NO"></span><span ng-if="ignored>1">s</span>
<span ab-label="STD_IGNORED" ></span>&nbsp;&nbsp;
<span class="text-primary ab-pointer ab-border ab-spaceless" ng-click="validControlNumber(0);">&nbsp;<span ab-label="STD_RESET"></span>&nbsp;</span>
<br>
<span ab-label="STD_REF" class="text-primary small" ></span><input ng-model="ignore_refer" size=25 />
</span>

</td>


</tr>
</table>

</td>
<td class="{{cancelTransaction==1&&varFormPg==2&&idVAP_OIHE>0?'text-danger':'hidden'}}">
<span ab-label="STD_REF" class=" small" ></span><input ng-model="ignore_refer" size=25 />
</td>
<td style="width:30%;" >
<span class="{{idVAP_OIHE>0?'hidden':''}} text-danger ab-strong small" >
No &nbsp;{{ VGL_BANK_PMTDE_current }} &nbsp;payments in 
<span ng-repeat="chkcurr in rawResult.vgb_curr  | AB_noDoubles:'idVGB_CURR' " ng-if="idVGB_CURR_current==chkcurr.idVGB_CURR" >
&nbsp; {{chkcurr.VGB_CURR_DESCR}}&nbsp;
</span>
</span>
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
		<td style="width:10%;padding-right:10px;" class="text-right" >
		Supplier
		</td>
		<td style="width:10%;" class="text-center" ></td>
		<td style="width:10%;"  >Type</td>
		<td style="width:10%;" class="text-right" >Amount&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td style="width:10%;" class="text-right" >Balance&nbsp;&nbsp;</td>
		<td style="width:32%;" >&nbsp;&nbsp;Reference&nbsp;&nbsp;
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
			<td style="width:10%;" ></td>
			<td style="width:8%;" ></td>
			<td style="width:8%;" ></td>			
			<td style="width:36%;" ></td>
		</tr>
		
		<tr ab-formlist="oihe_list"  ng-repeat="OIT in vap_oihe_pmt| AB_noDoubles:'idVAP_OIHE' " ng-if="OIT.idVAP_OIHE>0" >
			<td colspan=100 >
			<div>
			<form ab-view="oihe_list" ab-main="oihe_list" ab-context="0" >
			<table style="width:100%;" >
			<tr class="text-primary" >
				<td style="width:18%;"><input ng-model="OIT.idVAP_OIHE" class="hidden" /></td>
				<td style="width:10%;"></td>
				<td style="width:10%;"></td>
				<td style="width:10%;"></td>
				<td style="width:8%;"></td>
				<td style="width:8%;"></td>
				<td style="width:36%;"></td>
			</tr>
			</table>			
			<table style="width:100%;" >
			<tr class="text-primary" >
				<td style="width:18%;"><input ng-model="OIT.idVAP_OIHE" class="hidden" /></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:8%;" ></td>
				<td style="width:8%;" ></td>
				<td style="width:36%;" ></td>
			</tr>
			<tr>			
			<td>
				<table style="width:100%">
				<tr>
				<td style="width:50%">
					<input ng-model="OIT.SELECT" ng-init="OIT.SELECT=0" class="hidden" />
					<span  class="{{cancelTransaction!=1?'text-primary':'text-danger'}}" >
						<span ng-if="OIT.SELECT==1"  class="ab-border  ab-pointer  ab-spaceless" ng-click="OIT.SELECT=0;checkSelect();" >
							<span class="glyphicon glyphicon-ok" ></span>
						</span>
						<span ng-if="OIT.SELECT==0" class="ab-border ab-pointer ab-spaceless" ng-click="OIT.SELECT=1;checkSelect();"  >
							<span class="invisible">
								<span class="glyphicon glyphicon-ok" ></span>
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
				<span class="ab-pointer text-primary" pt="#jrnpost-{{OIT.idVGL_JNHE}}" onclick="$($(this).attr('pt')).toggleClass('hidden');" >
					<span >
						{{OIT.VGB_SUPP_BPNAM}}
					</span>
				
				</span>
				
				
			</td>
			<td  >
				{{OIT.VAP_OIHE_OITTY}}&nbsp;
				<span ng-if="varFormPg==2" class="small" >#{{OIT.VAP_OIHE_CHKID}}
			</td>
			<td class="text-right" >
				<input ng-model="OIT.VAP_OIHE_AMUNT" class="hidden" />
				$&nbsp;{{ABGetNumberFn("fmt-curr",OIT.VAP_OIHE_AMUNT*-1)}}
				<span class="{{OIT.VAP_OIHE_AMUNT!=OIT.VAP_OIHE_BALAN?'text-primary ab-pointer':''}}" tid="{{OIT.idVAP_OIHE}}" 
				onclick="$('#adj-'+$(this).attr('tid')).toggleClass('hidden');"  >&nbsp;&nbsp;
				<span class="caret {{OIT.VAP_OIHE_AMUNT!=OIT.VAP_OIHE_BALAN?'':'invisible'}}"> </span></span>
			</td>
			<td class="text-right ab-strong" >
				<input ng-model="OIT.VAP_OIHE_BALAN" class="hidden" />
				$&nbsp;{{ABGetNumberFn("fmt-curr",OIT.VAP_OIHE_BALAN*-1)}}&nbsp;&nbsp;
			</td>
			<td>
				<input ng-model="OIT.VAP_OIHE_REFER" class="hidden" />
				&nbsp;&nbsp;
				
				<span class="{{OIT.VAP_OIHE_REFER.trim()!=''?'':'hidden'}} ab-strong" ab-label="" >
				{{OIT.VAP_OIHE_REFER}}&nbsp;&nbsp;
				</span>

			</td>	
			</tr>
			<tr class="text-primary" >
				<td style="width:12%;"><input ng-model="OIT.idVAP_OIHE" class="hidden" /></td>
				<td style="width:8%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:40%;" ></td>
			</tr>
			<tr id="adj-{{OIT.idVAP_OIHE}}" class="hidden " >
				<td></td>
				<td></td>
				<td></td>
				
				<td colspan=5 style="vertical-align:top;" class="small ab-border">
					<table style="width:100%" 
						ng-repeat="OITHEA in rawResult.vap_oihe_paid| AB_noDoubles:'idVAP_OIHE,VAP_OIDE_TRNID' " 
						ng-if="OITHEA.idVAP_OIHE == OIT.idVAP_OIHE"
					>
					<tr ab-formlist="oide_list" ng-repeat="OITDET in rawResult.vap_oihe_paid| AB_noDoubles:'idVAP_OIDE' " 
						ng-if="OITHEA.VAP_OIDE_TRNID == OITDET.VAP_OIDE_TRNID" class="{{OIT.idVAP_OIHE != OITDET.idVAP_OIHE?'':'hidden'}} " 
					>
						<td style="width:15%;vertical-align:top;">
						<input class="hidden" ng-model="OITDET.idVAP_OIDE" />
						{{ OITDET.VAP_OIDE_TRNDA}}
						</td>
						<td style="width:10%;vertical-align:top;">Tr#:&nbsp;{{ OITDET.VAP_OIDE_TRNID}}</td>
						<td style="width:10%;vertical-align:top;" class="text-right" >$&nbsp;{{ABGetNumberFn("fmt-curr",OITDET.VAP_OIDE_AMUNT * -1)}}&nbsp;&nbsp;</td>
						<td style="width:55%">
							<table style="width:100%;" class="ab-strong" >
							<tr>
								<td style="width:10%;" class="text-right"></td>
								<td style="width:50%;" class="text-left">
									(
									&nbsp;{{OITDET.VAP_OIHE_OITTY}}&nbsp;#{{OITDET.VAP_OIHE_INVOI}}
									&nbsp;-&nbsp;{{OITDET.VAP_OIHE_DOCDA}}&nbsp;
									)
								</td>
								<td style="width:40%;" >{{OITDET.VAP_OIHE_REFER}}</td>
							</tr>
							</table>
						</td>
						<td style="width:10%"></td>
						
					<tr>
					</table>
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