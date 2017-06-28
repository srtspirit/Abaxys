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

$xtmp = new appForm("VAP_OITEMCT");

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

$scope.initSupp($scope.VGB_SUPP_BPART);



</textarea>
	      
</div>

<div class="row " ng-init="SESSION_DESCR='Payable Journal';" >

<div class="col-lg-12 ab-spaceless ">
    <?php require_once "../stdCscript/stdFormButtons.php"; ?>
    <script>
        $('#ab-sysOpt').addClass("{{updateOn>0&&validEntry()?'':'hidden'}}");
        $('#ab-delete').html(" ");
 //       $('#ab-new').html('');
    </script>
    
</div>

<div class="col-lg-3">   
  

​<table class="table-striped" style="width:100%">
	<tr>
		<td style="width:15%" class="text-center ab-strong small" >
			<span>
				
				<input class="hidden" id="VGB_SUPPsearch" ng-click="initNewSupplier();" />
				<a class="ab-pointer" 
				ng-click="ABsearchTbl='vgb_supp';ABsessionLink('','#VGB_SUPPsearch','vgb_supp');"
				neg-click="ABsessionLink('#/VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_supp,SourceProcess:VSL_ORDERS','#VGB_SUPPsearch');" >
					<span title="Access Partner List " ab-label="VGB_SUPP_BPART" ></span>
					<span title="Access Partner List " class="glyphicon glyphicon-search" ></span>
				</a>
			</span>
			<input class="hidden" ng-model="VAP_OIHE_BSUPP" />
		</td>
		<td style="width:30%;white-space:nowrap;">
			<form>
			
			<span class="btn ab-spaceless">
				<input title="Find by Partner ID code" class="ab-borderless text-primary" placeholder=" Search by ID " 
				id="ORHE_HISTORY_SUPP"
				ng-model="ORHE_HISTORY_SUPP" size="9"   />
			</span>
			<button ab-model="findPartner" class="btn-link ab-border ab-spaceless  {{ORHE_HISTORY_SUPP.length>0?'ab-pointer':'invisible'}}"
				ng-click="chkRangePartner('ORHE_HISTORY_SUPP','vgb_bpar','VGB_BPAR_BPART');"
			>
			Find
			</button>
			</form>

		</td>	
		<td style="width:55%" class="text-right" >
			<label>{{ VGB_BPAR_BPART }}</label>&nbsp;&nbsp;
			<label>{{ VGB_SUPP_BPNAM }}</label>&nbsp;&nbsp;

		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr class=" {{ idVGB_ADDR>0?'':'hidden' }}">
		<td colspan=3 class="ab-strong " style="vertical-align:top;padding-left:10px;" >
			<span ab-label='VGB_SUPP_PTADD' class='small text-primary'>Bill</span>
			<br>
       			<table style="width:100%;">
       			<tr>
       			<td  style="width:40%;vertical-align:top;">
	       			<div>
		       			{{ VGB_ADDR_ADNAM }}
		       		</div>
	       			<div class="{{VGB_ADDR_ADD01!=''?'':'hidden'}}  ">
		       			{{ VGB_ADDR_ADD01 }}
		       		</div>
	       			<div class="{{VGB_ADDR_ADD02!=''?'':'hidden'}}  ">
					{{ VGB_ADDR_ADD02 }}
				</div>
				<div>
					<span class="{{VGB_ADDR_CITYN!=''?'':'hidden'}}  "> {{ VGB_ADDR_CITYN }} </span>
					<span class="{{VGB_ADDR_POSTC!=''?'':'hidden'}}  "> ,{{ VGB_ADDR_POSTC }}</span>
				</div>	        
			</td>
			</tr>
			<tr>
			
			<td  style="width:60%;vertical-align:top;padding-right:30px;">
			

	       			<div class="text-right ">
	       				<span class="{{VGB_ADDR_CONT1.trim().length>0?'':'hidden'}} " >
			       			<span ab-label="VGB_ADDR_CONT1" class="text-primary small "></span>{{ VGB_ADDR_CONT1 }}
			       		</span>
		       			<span class="{{VGB_ADDR_TEL01.trim().length>0?'':'hidden'}} " >
			       			&nbsp;&nbsp;<span ab-la2bel="VGB_ADDR_TEL01" class="text-primary small ">Tel :</span>{{ VGB_ADDR_TEL01 }}
			       		</span>
		       		</div>
	       			<div class="{{VGB_ADDR_FAX01.trim().length>0?'':'hidden'}} text-right  ">
		       			&nbsp;&nbsp;<span ab-la2bel="VGB_ADDR_FAX01" class="text-primary small ">Tel : </span>'{{ VGB_ADDR_FAX01 }}'
		       		</div>      			
		       		<div class="{{VGB_ADDR_EMAIL.trim().length>0?'':'hidden'}}  text-right ">
		       			&nbsp;&nbsp;<span ab-la2bel="VGB_ADDR_EMAIL" class="text-primary small ">E-Mail:</span>{{ VGB_ADDR_EMAIL }}
		       		</div>
		       		
		       		
	       			<div class="text-right ">
	       				
		       			<span ab-label="VGB_ADDR_CONT2" class="{{VGB_ADDR_CONT2.trim().length>0?'':'hidden'}}  text-primary small "></span>{{ VGB_ADDR_CONT2 }}
		       			<span class="{{VGB_ADDR_TEL02.trim().length>0?'':'hidden'}} " >
		       				&nbsp;&nbsp;<span ab-la2bel="VGB_ADDR_TEL02" class="text-primary small ">Tel :</span>{{ VGB_ADDR_TEL02 }}
		       			</span>
		       		</div>

	       			<div class="{{VGB_ADDR_FAX02.trim().length>0?'':'hidden'}}  text-right ">
		       			&nbsp;&nbsp;<span ab-la2bel="VGB_ADDR_FAX02" class="text-primary small ">Tel :</span>{{ VGB_ADDR_FAX02 }}
		       		</div>      			
		       		
	       			<div class="{{VGB_ADDR_TAXEX.trim().length>0?'':'hidden'}}  text-right ">
		       			&nbsp;&nbsp;<span ab-la2bel="VGB_ADDR_TAXEX" class="text-primary small ">E-Mail:</span>{{ VGB_ADDR_TAXEX }}
		       		</div>
		       		
	       		
 		
			
			
			</td>
			</tr>
			</table>
		</td>
	</tr>	
	


	
	<tr class=" {{ idVGB_BPAR>0?'':'hidden' }}">
		<td  >
		</td>
		<td colspan=2 >
		
<?php

// VGB_SUPP_CURID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CURID";
$hardCode = "<span class='ab-strong'>{{ VGB_CURR_CURID}} &nbsp;&nbsp {{ VGB_CURR_DESCR}}</span>";
$hardCode .= "&nbsp;&nbsp;<span ab-label='STD_RATE' ></span>&nbsp;<span class='ab-strong'>{{ VGB_CURR_CURAT}} &nbsp;&nbsp</span>";
$xtmp->setFieldWrapper("view02","2.6","vgb_supp","VGB_SUPP_CURID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>

		</td>
	</tr>		

	<tr class=" {{ idVGB_BPAR>0?'':'hidden' }} ">
		<td  >
		</td>
		<td colspan=2 >


<?php



// VGB_SUPP_TERID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_TERM_TERID";
$hardCode = "<span class='ab-strong'>{{ VGB_TERM_TERID }}&nbsp;&nbsp;{{ VGB_TERM_DESCR}}";
$hardCode .= "&nbsp;&nbsp;<span ab-label='VGB_TERM_NETDA' class='text-primary' ></span><span>:&nbsp;{{ VGB_TERM_NETDA}}</span><br>";
$hardCode .= "<span ab-label='VGB_TERM_DISDA' class='text-primary' ></span><span>:&nbsp;{{ VGB_TERM_DISDA}}</span>";
$hardCode .= "&nbsp;&nbsp;<span ab-label='VGB_TERM_DISCN' class='text-primary' ></span><span>:&nbsp;{{ VGB_TERM_DISCN}}</span></span>";
$xtmp->setFieldWrapper("view02","2.5","vgb_supp","VGB_SUPP_TERID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>

		</td>
	</tr>		
	
	<tr class=" {{ idVGB_BPAR>0?'':'hidden' }}">
		<td  >
		</td>
		<td colspan=2 >
		
<?php
// VGB_SUPP_CRELI
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CRELI";
$inAttr['size'] = "8";
$inAttr['readonly'] = "";
$inAttr['class'] .= " ab-strong ";
$inAttr['ab-ft'] = "amt";
$xtmp->setFieldWrapper("view02","2.4","vgb_supp","VGB_SUPP_CRELI","",$grAttr,$laAttr,$inAttr,"");

echo $xtmp->currHtml;


?>

		</td>
	</tr>		


		
</table>	

<div class="hidden">
<input class='text-muted' ab-mpp onchange="getMaxPerPage();" value="0" />
</div>
 <!-- Example for future reference How to list search items
<div class="{{rawResult[tbName].length>0?'':'hidden'}}">
<table>
<tr>
<td>
</td>
<td>
Identification
</td>
<td>
&nbsp;
</td>
<td>
Description
</td>
</tr>
<tr ng-repeat="display in rawResult[tbName] | AB_noDoubles:idName " ng-if="tbCond(display)!=false">
<td>
<span ng-if="!selInstruction!=true">
<input type='checkbox' ng-click="selInstruction(display)" />
</span>
</td>
<td> {{display[idName]}}</td>   
<td></td>
<td> {{display[idDescr]}}</td>
</tr>
</table>
</div>
-->

</div>

<div class="col-lg-9 "> 
   <form id="mainForm" name="mainForm"   ab-view="vap_oihe" ab-main="vap_oihe"  > 
<div class="row  {{ VAP_OIHE_BSUPP>0?'':'hidden' }} ">
<div class="col-sm-12">  
	<input ng-model="varFormPg" class="hidden" ng-init="varFormPg=-1 "/>
	<div class="col-sm-2 well ab-spaceless ab-pointer " 
	 ng-click="setVarForm(0)">
		<span class=" {{varFormPg==0?'text-primary':''}}" >
			<span class="glyphicon glyphicon-ok {{varFormPg==0?'text-primary':'invisible'}}" ></span>
			&nbsp;
			Invoice
			&nbsp;
			</span>
		</span>
	</div>
	<div class="col-sm-2 well ab-spaceless ab-pointer" 
		ng-click="setVarForm(1)" >
		<span class=" {{varFormPg==1?'text-primary':''}}" >
			<span class="glyphicon glyphicon-ok {{varFormPg==1?'text-primary':'invisible'}}" ></span>
			&nbsp;Payment&nbsp;
		</span>

	</div>
	<div class="col-sm-2 well ab-spaceless  ab-pointer " 
		ng-click="setVarForm(2)"  >
		<span class=" {{varFormPg==2?'text-primary':''}}" >
			<span class="glyphicon glyphicon-ok {{varFormPg==2?'text-primary':'invisible'}}" ></span>
			<small>&nbsp;Credit&nbsp;</small>
		</span>
		
		<input class="hidden" ng-model="vin_inveQuery"  />
		<input class="hidden" ab-mpp="limit" value="0" />			
		<input class="hidden" ng-click="idVIN_ITEM=VPU_ORDE_ITMID;ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_inveQuery','vin_inveQuery','vin_inve');" />
	</div>
	<div class="col-sm-2 well ab-spaceless  ab-pointer" 
		ng-click="setVarForm(3)"  >
		<span class=" {{varFormPg==3?'text-primary':''}}" >
			<span class="glyphicon glyphicon-ok {{varFormPg==3?'text-primary':'invisible'}}" ></span>
			<small>&nbsp;Adjustment&nbsp;</small>
		</span>
		
		<input class="hidden" ng-model="vin_inveQuery"  />
		<input class="hidden" ab-mpp="limit" value="0" />			
		<input class="hidden" ng-click="idVIN_ITEM=VPU_ORDE_ITMID;ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_inveQuery','vin_inveQuery','vin_inve');" />
	</div>

</div>
<div class="col-sm-12 {{ varFormPg<0?'hidden':'' }}" >   

<input class="hidden" ng-model="VAP_OIHE_BSUPP" />
<input class="hidden" ng-model="VAP_OIHE_BTADD" />
<input class="hidden" ng-model="VAP_OIHE_OITTY" />
<input class="hidden" ng-model="VAP_OIHE_TERID" />
<input class="hidden" ng-model="VAP_OIHE_NETDA" />
<input class="hidden" ng-model="VAP_OIHE_DISDA" />
<input class="hidden" ng-model="VAP_OIHE_DISCN" />
<input class="hidden" ng-model="VAP_OIHE_CURID" />
<input class="hidden" ng-model="VAP_OIHE_CURAT" />
<input class="hidden" ng-model="VAP_OIHE_BPBNK"  />
<input class="hidden" ab-btrigger="vap_oihe" ng-model="idVAP_OIHE"  />


<table style="width:100%;"  >
	<tr>


		<td style="width:6%;vertical-align:top;" >

<?php

$xtmp = new appForm("VAP_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg==0||varFormPg==2?'':'hidden' }} ab-spaceless ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ab-spaceless ";
$laAttr["ab-label"] = "VAP_BOOKING";
$inAttr = $xtmp->inAttrib;
$hardCode = "<input class='hidden' ng-model='VAP_BOOKING' ng-init='VAP_BOOKING=0' />";
$hardCode .= "<input type='checkbox' ng-model='VAP_BOOKING_CK' ng-click='VAP_BOOKING=1-VAP_BOOKING' ng-init='VAP_BOOKING_CK=false'/>";
$xtmp->setFieldWrapper("view01","2.090","vap_oihe","VAP_BOOKING","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


?>
<?php

$xtmp = new appForm("VAP_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg==1?'':'hidden' }} ab-spaceless ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ab-spaceless ";
$laAttr["ab-label"] = "STD_SELECT";
$inAttr = $xtmp->inAttrib;
$hardCode = "<input class='hidden' ng-model='VAP_DISTRIBUTE' ng-init='VAP_DISTRIBUTE=0' />";
$hardCode .= "<input type='checkbox' ng-model='VAP_DISTRIBUTE_CK' ng-click='VAP_DISTRIBUTE=1-VAP_DISTRIBUTE;accumAdjust();' ng-init='VAP_DISTRIBUTE_CK=false'/>";
$xtmp->setFieldWrapper("view01","2.090","vap_oihe","VAP_DISTRIBUTE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


?>



		</td>

		<td style="width:10%;vertical-align:top;" >

<?php
$xtmp = new appForm("VAP_OITEMCT");
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "STD_POST_DATE";
$laAttr["class"] .= " small ";
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setDatePick("VAP_OIHE_DOCDA");
$xtmp->setFieldWrapper("view01","2.090","vap_oihe","VAP_OIHE_DOCDA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
?>
<br>
		</td>
		<td style="width:15%;vertical-align:top;" >

<?php

$xtmp = new appForm("VAP_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg!=0?'':' ab-spaceless' }} ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ";
$laAttr["ab-label"] = "STD_REF";
$laAttr["class"] .= " {{ varFormPg!=0?'':' ab-spaceless' }} ";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","2.090","vap_oihe","VAP_OIHE_REFER","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;



?>

		</td>
		<td style="width:15%;vertical-align:top;" >


<?php
$xtmp = new appForm("VAP_OITEMCT");
$grAttr = $xtmp->grAttrib;

$grAttr["class"] .= " {{ varFormPg==3||isLocal()==true?'hidden':'' }} ab-spaceless ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ";
$laAttr["ab-label"] = "STD_AMOUNT";
$inAttr = $xtmp->inAttrib;
// $inAttr['ab-ft'] = "amt";
$inAttr['size'] = "8";
$inAttr['onfocus'] = "$(this).select();";
$inAttr['ng-click'] = "$(this).select();";
$inAttr['ng-blur'] = "validateAmt();accumAdjustDelay();";
$hardCode = "<input size=8 onfocus='$(this).select();' ng-click=";
$xtmp->setFieldWrapper("view01","2.090","vap_oihe","VAP_OIHE_AMUNT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
?>

<?php
$xtmp = new appForm("VAP_OITEMCT");
$grAttr = $xtmp->grAttrib;

$grAttr["class"] .= " {{ varFormPg==3||isLocal()==false?'hidden':'' }} ab-spaceless ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ";
$laAttr["ab-label"] = "STD_AMOUNT";
$inAttr = $xtmp->inAttrib;
// $inAttr['ab-ft'] = "amt";
$inAttr['size'] = "8";
$inAttr['readonly'] = "";
$inAttr['onfocus'] = "$(this).select();";
$inAttr['ng-click'] = "$(this).select();";
$inAttr['ng-blur'] = "validateAmt();accumAdjustDelay();";
$hardCode = "<input size=8 onfocus='$(this).select();' ng-click=";
$xtmp->setFieldWrapper("view01","2.090","vap_oihe","VAP_OIHE_AMUNT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

echo '</td><td style="width:15%;vertical-align:top;">';

$xtmp = new appForm("VAP_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg!=1?'hidden':'' }} ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ";
$laAttr["ab-label"] = "STD_PMTTY";
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "8";
$hardCode =<<<EOC


				<table style="width:100%">
					<tr>
						<td class="text-left">
							<input class="hidden" ng-model="VAP_OIHE_BNKID" />
							<input class="hidden" ng-model="VGL_BANK_PMTTY" />
							<input class="hidden" ng-model="VGL_BANK_TYDET" />
							
							<ul class="nav  ab-spaceless " role="tablist"    >
							<li class="dropdown ab-spaceless"  >
								
								<span data-toggle="dropdown" class="ab-pointer" style="white-space:nowrap;padding:0px;" >
									<span ng-repeat="bnk in rawResult.vgl_bank_info | AB_noDoubles:'idVGL_BANK' " 
									ng-if="VAP_OIHE_BNKID==bnk.idVGL_BANK" >{{ bnk.VGL_BANK_PMTDE }}</span>
									<span class="text-primary">
										&nbsp;&nbsp;
										<span class="caret" ></span>
									</span>
									
								</span>
								<ul class="dropdown-menu ab-spaceless" ab-flst="" role="menu"  >
									<li class="" ng-repeat="bnk in rawResult.vgl_bank_info | AB_noDoubles:'VGL_BANK_PMTTY' "  >
									<a class="small"  ng-click="setBankInfo(bnk);" >
									<span  >{{ bnk.VGL_BANK_PMTDE }}</span>
									</a>
									</li>
								</ul>
							</li>
							</ul>
						</td>
					</tr>
					<tr>
						<td class="text-left">	
							<ul class="nav ab-strong ab-spaceless small" role="tablist"  ng-if="VGL_BANK_PMTTY!=VGL_BANK_TYDET"  >
							<li class="dropdown ab-spaceless"  >
								
								<span data-toggle="dropdown" class="ab-pointer" style="white-space:nowrap;padding:0px;" >
									<span class="ab-border ab-spaceless"
									ng-repeat="bnk in rawResult.vgl_bank_info | AB_noDoubles:'idVGL_BANK' " 
									ng-if="VAP_OIHE_BNKID==bnk.idVGL_BANK" >&nbsp;&nbsp;{{ bnk.VGL_BANK_TDESC }}&nbsp;&nbsp;</span>
									<span class="text-primary">
										
										<span class="caret" ></span>
										&nbsp;&nbsp;&nbsp;&nbsp;
									</span>
									
								</span>
								<ul class="dropdown-menu ab-spaceless" ab-flst="" role="menu"  >
									<li class="" ng-repeat="bnk in rawResult.vgl_bank_info | AB_noDoubles:'VGL_BANK_TYDET' " 
									ng-if="VGL_BANK_PMTTY==bnk.VGL_BANK_PMTTY" >
									<a class="small"  ng-click="setBankInfo(bnk);" >
									<span  >{{ bnk.VGL_BANK_TDESC }}</span>
									</a>
									</li>
								</ul>
							</li>
							</ul>
						</td>
					</tr>
				</table>
				
				
EOC;



$xtmp->setFieldWrapper("view01","2.090","vap_oihe","VAP_OIHE_BNKID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
?>
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
			<span class="{{varFormPg==3||isBooking()==true?'':'hidden'}} ab-spaceless">
				<input 	ng-model="ADJBALANCE" 
					ng-init="ADJBALANCE='0.00'" 
					ng-focus="accumAdjust();"
					ng-click="accumAdjust();"
					size=6
					class="hidden"
				/>
				<span class="small ab-spaceless" >Bal.&nbsp;
				
				</span>

				<span class="ab-spaceless ab-strong" >$&nbsp;
					<span class="ab-borderless ab-spaceless text-right {{ADJBALANCE<0?'text-danger':'text-primary'}}" >
					{{ ADJBALANCE }}&nbsp;&nbsp;
					</span>
				</span>
			</span>		
		</td>
		<td style="width:10%;" class="text-center" >ID</td>
		<td style="width:10%;"  >Type</td>
		<td style="width:10%;" class="text-right" >Amount&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td style="width:10%;" class="text-right" >Balance&nbsp;&nbsp;</td>
		<td style="width:32%;" >&nbsp;&nbsp;Reference&nbsp;&nbsp;
		<span class="well small ab-borderless ab-spaceless ab-pointer" ng-click="showZero=1-showZero" ng-init="showZero=0">
			<span ab-label="STD_SHOW_ZERO" class="{{showZero==0?'':'hidden'}}">Show</span>
			<span ab-label="STD_HIDE_ZERO" class="{{showZero>0?'':'hidden'}}">Hide</span>
		</span>
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
		
		<tr  id="jrn-{{OIT.idVGL_JNHE}}" ab-formlist="oihe_list"  ng-repeat="OIT in vap_open_items| AB_noDoubles:'idVAP_OIHE' " ng-if="OIT.VAP_OIHE_PSTAT!='CANCEL'" >
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
			<?php require_once "../appHtml/VAP_OITEMCT_NOBOOK.php"; ?>
			</table>			
			<table style="width:100%;" ng-if="OIT.VAP_OIHE_BALAN != 0 || showZero>0">
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
					<span class="text-primary small ab-border ab-spaceless ab-pointer" ng-if="(varFormPg==3||isDistribute()==true)&&OIT.idVAP_OIHE>0&&OIT.VAP_OIHE_BALAN!=0&&OIT.VAP_OIHE_TRTYP=='STD'">
						
						<span ng-click="
						OIT.SELECT = 1-OIT.SELECT;
						OIT.ADJAMOUT=(OIT.SELECT>0?OIT.VAP_OIHE_BALAN:0);
						accumAdjustDelay();
						" 
						style="{{OIT.SELECT>0?'':'color:transparent;' }}" class="glyphicon glyphicon-ok" ></span>
					</span>
					<span class="text-primary small ab-border ab-spaceless ab-pointer" ng-if="isBooking()==true&&OIT.VAP_OIHE_TRTYP=='RPO'">
						
						<input class="hidden" ng-model="OIT.SELECT" ng-init="OIT.SELECT=0"  />
						<input class="hidden " ng-model="OIT.NEWPOST" ng-init="OIT.NEWPOST=0" />
						<span ng-click="
						OIT.SELECT = 1-OIT.SELECT;
						
						" 
						clickid="{{OIT.idVGL_JNHE}}" onclick="accumclick($(this).attr('clickid'));"
						
						style="{{OIT.SELECT>0?'':'color:transparent;' }}" class="glyphicon glyphicon-ok" ></span>
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
			<td  >
				<span ng-if="(varFormPg==3||isDistribute()==true)&&OIT.idVAP_OIHE>0&&OIT.VAP_OIHE_TRTYP=='STD'" class="ab-spaceless">
					<input ng-model="OIT.SELECT" ng-init="OIT.SELECT=0" class="hidden" />
					<button class="small ab-borderless {{OIT.SELECT>0?'':'hidden'}} " 
					title="Set to remaining balance"
					ng-click="OIT.ADJAMOUT=OIT.ADJAMOUT-ADJBALANCE;accumAdjustDelay();">=</button>
					<span class="{{OIT.SELECT>0?'ab-border':''}} ab-spaceless" >
						<input 	ng-model="OIT.ADJAMOUT"
							trtype="{{OIT.VAP_OIHE_OITTY}}"
							trsubtype="{{OIT.VAP_OIHE_TRTYP}}" 
							trbal="{{OIT.VAP_OIHE_BALAN}}"
							ng-init="OIT.ADJAMOUT=0"
							ng-blur="accumAdjustDelay();"
							onfocus="$(this).select();"
							size=5
							class="{{OIT.SELECT>0?'':'hidden'}} ab-borderless ab-spaceless text-right {{OIT.VAP_OIHE_OITTY!='INV'?'text-danger':'text-primary'}}" 
						/>
						
					</span>
				</span>
				<span ng-if="isBooking()==true&&OIT.idVAP_OIHE>0&&OIT.VAP_OIHE_TRTYP=='RPO'" class="ab-spaceless">
					<input ng-model="OIT.SELECT" ng-init="OIT.SELECT=0" class="hidden" />
					<span class="{{OIT.SELECT>0?'ab-border':''}} ab-spaceless" >
						<input 	ng-model="OIT.ADJAMOUT_BOOK"
							trtype="{{OIT.VAP_OIHE_OITTY}}" 
							trsubtype="{{OIT.VAP_OIHE_TRTYP}}" 
							trbal="{{OIT.VAP_OIHE_BALAN}}"
							ng-init="OIT.ADJAMOUT=0"
							readonly
							size=6
							class="{{OIT.SELECT>0?'':'hidden'}} ab-borderless ab-spaceless text-right {{OIT.VAP_OIHE_OITTY!='INV'?'text-danger':'text-primary'}}" 
						/>
						
					</span>
				</span>

			</td>
			<td class="small ab-strong text-center" >
				<span class="ab-pointer text-primary" pt="#jrnpost-{{OIT.idVGL_JNHE}}" onclick="$($(this).attr('pt')).toggleClass('hidden');" >
				<span class="{{OIT.VAP_OIHE_INVOI>0?'':'hidden'}}">{{OIT.VAP_OIHE_INVOI}}-</span>
				{{OIT.VGL_JNHE_TRNID}}
				</span>
				<input ng-model="OIT.VAP_OIHE_TRNID" class="hidden" />
				
			</td>
			<td  >
				<div>
				<table>
				<tr>
				<td>
					<span ng-if="OIT.VAP_OIHE_TRTYP=='STD'">
					{{OIT.VAP_OIHE_OITTY}}
					</span>
					<span ng-if="OIT.VAP_OIHE_TRTYP!='STD'" class="text-primary ab-pointer ab-strong small" pt="#vpu-{{OIT.idVGL_JNHE}}" 
					clickid="{{OIT.idVGL_JNHE}}" 
					onclick="accumclick($(this).attr('clickid'));$($(this).attr('pt')).toggleClass('hidden');" >
					{{OIT.VAP_OIHE_OITTY}}-{{OIT.VAP_OIHE_TRTYP}}
					</span>
					
					<input ng-model="OIT.VAP_OIHE_OITTY" class="hidden" />
				</td>
				<td style="white-space:nowrap;" >
					<span data-toggle="dropdown" class="text-primary  small" style="white-space:nowrap;padding:0px;" >
						
						<span  ng-repeat="bnk in rawResult.vgl_bank_info | AB_noDoubles:'idVGL_BANK' " 
						ng-if="OIT.VAP_OIHE_OITTY=='PMT'&&OIT.VAP_OIHE_BNKID==bnk.idVGL_BANK" >{{ bnk.VGL_BANK_PMTDE }}&nbsp;
						
						</span>
					
						
					</span>
				</td>
				</tr>
				</table>
				</div>
				
			</td>
			<td class="text-right" >
			<input ng-model="OIT.VAP_OIHE_AMUNT" class="hidden" />
			{{OIT.VAP_OIHE_AMUNT}}
			<span class="{{OIT.VAP_OIHE_AMUNT!=OIT.VAP_OIHE_BALAN?'text-primary ab-pointer':''}}" tid="{{OIT.idVAP_OIHE}}" 
			onclick="$('#adj-'+$(this).attr('tid')).toggleClass('hidden');"  >&nbsp;&nbsp;
			<span class="caret {{OIT.VAP_OIHE_AMUNT!=OIT.VAP_OIHE_BALAN?'':'invisible'}}"> </span></span>
			</td>
			<td class="text-right ab-strong" >
			<input ng-model="OIT.VAP_OIHE_BALAN" class="hidden" />
			{{OIT.VAP_OIHE_BALAN}}&nbsp;&nbsp;
			</td>
			<td>
				<input ng-model="OIT.VAP_OIHE_REFER" class="hidden" />
				&nbsp;&nbsp;
				
				<span class="{{OIT.VAP_OIHE_REFER.trim()!=''?'':'hidden'}} ab-strong" ab-label="" >
				{{OIT.VAP_OIHE_REFER}}&nbsp;&nbsp;
				</span>
				<span class="{{OIT.VAP_OIHE_CONNU.trim()!=''?'':'hidden'}} ab-strong" ab-label="" >
					<span ng-repeat="bnk in rawResult.vgl_bank_info | AB_noDoubles:'idVGL_BANK' " 
					ng-if="OIT.VAP_OIHE_BNKID==bnk.idVGL_BANK" >
						{{ bnk.VGL_BANK_TDESC }}
					</span>
					&nbsp;:&nbsp;{{OIT.VAP_OIHE_CONNU}}
				</span>				
				<span ng-if="1==1">
					{{OIT.VAP_OIHE_PMTDA}}
					<span class="small ab-strong"  ng-repeat="bk in vgb_bank |  AB_noDoubles:'idVGB_BANK'" ng-if="bk.idVGB_BANK==OIT.VAP_OIHE_BPBNK" >
					{{bk.VGB_BANK_BNKID}}
					</span>
					
				</span>

			</td>	
			</tr>
			<tr  id="jrnpost-{{OIT.idVGL_JNHE}}" class="hidden">
				<td></td>
				<td colspan=10>
					<table style="width:100%;" ng-repeat="head in rawResult.vgl_journal | AB_noDoubles:'idVGL_JNHE' " ng-if="head.idVGL_JNHE == OIT.idVGL_JNHE" >
					<tr class="ab-strong" >
						<td style="width:30%;"> Source: {{head.VGL_JNHE_PSOUR}} 
						</td>
						<td style="width:10%;"> Account # </td>
						<td style="width:40%;"> Description </td>
						<td style="width:10%;" class="text-right"> Debit&nbsp;</td>
						<td style="width:10%;" class="text-right"> Credit&nbsp;</td>
						
					</tr>
					<tr ng-repeat="jrn in rawResult.vgl_journal | AB_noDoubles:'idVGL_JNDE' " ng-if="jrn.idVGL_JNHE == OIT.idVGL_JNHE" >
						<td></td>
						<td>
							{{jrn.VGL_CHART_GLIDN}}
						</td>
						<td>
							{{jrn.VGL_CHART_GLDES}}
						</td>
						<td class="text-right">
							<span ng-if="jrn.VGL_JNDE_GLAMT>0" >{{ABGetNumberFn("fmt-curr",jrn.VGL_JNDE_GLAMT)}}</span>&nbsp;
						</td>
						<td class="text-right">
							<span ng-if="jrn.VGL_JNDE_GLAMT<0" >{{ABGetNumberFn("fmt-curr",(jrn.VGL_JNDE_GLAMT * -1)) }}</span>&nbsp;
						</td>
						
					</tr>
					<tr class="ab-border">
						<td colspan=100></td>
					</tr>
					</table>
				</td>
			</tr>
			<script>
			function accumclick(id)
			{
				// click for ng-function to recalc total and taxes
				$("#vpu-" + id).find("[ng-model='vpu.grandtotal']").click();
			}
			</script>
			<tr id="vpu-{{OIT.idVGL_JNHE}}" class="hidden">
				<td></td>
				<td colspan=10>
					<table style="width:100%;">
					<tr class="ab-strong" ng-repeat="vpu in rawResult.vpu_purch | AB_noDoubles:'idVPU_ORSI' " ng-if="vpu.VPU_ORSI_GRPID == OIT.VAP_OIHE_INVOI" >
						<td style="width:40%;">
						Item&nbsp;&nbsp;<span class="text-primary small ab-pointer" ng-click="insertItem(rawResult.vpu_purch,vpu.VPU_ORSI_GRPID,vpu.idVPU_ORSI)" >New Item</span>
						<input class="hidden" ng-model="vpu.grandtotal" ng-click="vpu.grandtotal=accGrandTotal(OIT.idVGL_JNHE)"  size=5 />
						<input class="hidden" ng-model="vpu.taxtotal"  size=5 /> 
						<input class="hidden" ng-model="vpu.invtotal"  size=5 />
						
						</td>
						<td style="width:10%;" class="text-right"> Quantity </td>
						<td style="width:10%;" class="text-right"> Price&nbsp;</td>
						<td style="width:10%;" class="text-right"> Extension&nbsp;</td>
						<td style="width:10%;" class="text-right"> New Qty </td>
						<td style="width:10%;" class="text-right"> New Price&nbsp;</td>
						<td style="width:10%;" class="text-right"> Extension&nbsp;</td>
						
						
					</tr>
					<tr ng-repeat="vpu in rawResult.vpu_purch | AB_noDoubles:'idVPU_ORSI,idVGB_ADDR' " ng-if="vpu.VPU_ORSI_GRPID == OIT.VAP_OIHE_INVOI && vpu.idVGB_ADDR == vpu.VPU_ORHE_STADD" >
					<td><input class="hidden" ng-model="vpu.idVTX_SCHH" /></td>
					</tr>
					<tr ng-repeat="vpu in rawResult.vpu_purch | AB_noDoubles:'idVPU_ORST' " ng-if="vpu.VPU_ORSI_GRPID == OIT.VAP_OIHE_INVOI" >
						
						<td>
							<span ng-if="vpu.newItem=='1' " > 
								<span class="glyphicon glyphicon-trash" ng-click="removeNewLine(rawResult.vpu_purch,vpu.idVPU_ORST,OIT.idVGL_JNHE);" ></span>

								&nbsp;&nbsp;&nbsp;<input title="Find by Item" placeholder=" Search by Item " 
								onfocus="$(this).select();" 
								ng-blur="chkRangeItm('',OIT.idVGL_JNHE,vpu.VIN_ITEM_ITMID,vpu.idVPU_ORST);"
								ng-keypress="chkEventItm('',$event,OIT.idVGL_JNHE,vpu.VIN_ITEM_ITMID,vpu.idVPU_ORST);"
								ng-model="vpu.VIN_ITEM_ITMID" size="10" class="ab-borderless small ab-strong" />
								
								<input class="hidden" ng-model="VIN_ITEM_ITMID" />

							</span>	
							<span class="ab-strong" ng-if="vpu.newItem!='1' ">
							{{vpu.VIN_ITEM_ITMID}}
							</span>
							<input class="hidden" ng-model="vpu.idVIN_ITEM" />
							<input class="hidden" ng-model="vpu.VIN_ITEM_INVIT" />
							<input class="hidden" ng-model="vpu.newItem" />
							
							<span class="small">
							-{{vpu.VPU_ORDE_DESCR}}
							</span>
							<input class="hidden" ng-model="vpu.VIN_ITEM_ITTXT" />
							<input class="hidden" ng-model="vpu.VPU_ORDE_OLTYP" />
							<span class="small text-primary ab-strong" ng-if="vpu.VIN_ITEM_ITTXT=='NOTAX'"><span class="small">no tax</span></span>
							<span class="small text-primary ab-strong" ng-if="vpu.VIN_ITEM_ITTXT!='NOTAX'"><span class="small">Taxable</span></span>
							<span class="text-primary" ng-if="vpu.VPU_ORDE_OLTYP=='BOR'">
								&nbsp;Borned by {{ AB_CPARM.VGB_COMPANY.vgb_cust[0].VGB_CUST_BPNAM }}
							</span>
						</td>
						<td class="text-right">
							{{vpu.VPU_ORST_ORDQT}}&nbsp;
							
						</td>
						<td class="text-right">
							{{ABGetNumberFn("fmt-curr",vpu.VPU_ORDE_OUNET)}}&nbsp;
							
						</td>
						<td class="text-right">
						
							{{ABGetNumberFn("fmt-curr",( (vpu.VPU_ORDE_OUNET*1) * (vpu.VPU_ORST_ORDQT*1) / (vpu.VPU_ORDE_FACTO*1) )) }}&nbsp;
						</td>
						<td class="text-right">
						
							<span ng-if="vpu.VPU_ORDE_OLTYP!='BOR'">
								<input size=5 class="text-right" ng-model="vpu.VPU_ORST_ORDQT_REV" clickid="{{OIT.idVGL_JNHE}}" 
								onfocus="$(this).select();"
								onblur="accumclick($(this).attr('clickid'));" ng-init="vpu.VPU_ORST_ORDQT_REV=vpu.VPU_ORST_ORDQT" />
								<input size=5 class="hidden" ng-model="vpu.VPU_ORST_ORDQT_ORG" 
								ng-init="vpu.VPU_ORST_ORDQT_ORG=vpu.VPU_ORST_ORDQT" />
							</span>
						</td>
						<td class="text-right">

							<span ng-if="vpu.VPU_ORDE_OLTYP!='BOR'">
								<input size=5 class="text-right" ng-model="vpu.VPU_ORDE_OUNET_REV" clickid="{{OIT.idVGL_JNHE}}" 
								onfocus="$(this).select();"
								onblur="accumclick($(this).attr('clickid'));" ng-init="vpu.VPU_ORDE_OUNET_REV=vpu.VPU_ORDE_OUNET" />
								<input size=5 class="hidden" ng-model="vpu.VPU_ORDE_OUNET_ORG" 
								ng-init="vpu.VPU_ORDE_OUNET_ORG=vpu.VPU_ORDE_OUNET" />
							</span>

						</td>
						<td class="text-right">
							<span ng-if="vpu.VPU_ORDE_OLTYP!='BOR'">
								<input class="hidden"  ng-model="vpu.ext" taxing="{{vpu.VIN_ITEM_ITTXT}}" ng-bind="vpu.ext=((vpu.VPU_ORDE_OUNET_REV*1) * (vpu.VPU_ORST_ORDQT_REV*1) / (vpu.VPU_ORDE_FACTO*1)).toFixed(2)" size=5 />
								<input class="hidden"  ng-model="vpu.ext_ORG" ng-bind="vpu.ext_ORG=((vpu.VPU_ORDE_OUNET_ORG*1) * (vpu.VPU_ORST_ORDQT_ORG*1) / (vpu.VPU_ORDE_FACTO*1)).toFixed(2)" size=5 />
								{{ABGetNumberFn("fmt-curr",( (vpu.VPU_ORDE_OUNET_REV*1) * (vpu.VPU_ORST_ORDQT_REV*1) / (vpu.VPU_ORDE_FACTO*1) )) }}&nbsp;
							</span>	
						</td>
						
					</tr>
					<tr class="ab-border">
					</tr>
					
					<tr ng-repeat="jrn in rawResult.vgl_journal | AB_noDoubles:'idVGL_JNDE' " ng-if="jrn.idVGL_JNHE == OIT.idVGL_JNHE" >
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
							<!-- <tr ng-repeat="vpu in rawResult.vpu_purch | AB_noDoubles:'VPU_ORSI_GRPID' | AB_Sorted:'VTX_SCHE_SCHSQ' " ng-if="vpu.VPU_ORSI_GRPID == OIT.VAP_OIHE_INVOI  && vpu.VTX_SCHE_GLACR == jrn.VGL_JNDE_GLIDN" > -->
							<tr ng-repeat="vpu in rawResult.vpu_purch | AB_noDoubles:'VPU_ORSI_GRPID,VTX_SCHE_GLIDN' | AB_Sorted:'VTX_SCHE_SCHSQ' " ng-if="vpu.VPU_ORSI_GRPID == OIT.VAP_OIHE_INVOI  && vpu.VTX_SCHE_GLACR == jrn.VGL_JNDE_GLIDN" >
						
								<td>
									{{jrn.VGL_CHART_GLDES}}
								</td>
								<td>
									
								</td>
								<td class="text-right">
									
								</td>
								<td class="text-right">
								
									{{ABGetNumberFn("fmt-curr",( (jrn.VGL_JNDE_GLAMT*1) )) }}&nbsp;
								</td>
								<td>
									
								</td>
								<td class="text-right">
									
								</td>
								<td class="text-right">
									<input size=5 class="ab-borderless text-right" readonly  
									taxseq="{{vpu.VTX_SCHE_SCHSQ}}"
									taxper="{{vpu.VTX_SCHE_TAXPE}}"
									taxprev ="{{vpu.VTX_SCHE_TPREV}}"
									ng-model="jrn.VGL_JNDE_GLAMT_REV" ng-init="jrn.VGL_JNDE_GLAMT_REV=(jrn.VGL_JNDE_GLAMT*1).toFixed(2)" />&nbsp;
									<span class="hidden" >{{ABGetNumberFn("fmt-curr",( (jrn.VGL_JNDE_GLAMT_REV*1) )) }}&nbsp;</span>
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
						<td class="text-right">
						</td>
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
			<tr class="text-primary" >
				<td style="width:12%;"><input ng-model="OIT.idVAP_OIHE" class="hidden" /></td>
				<td style="width:8%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:40%;" ></td>
			</tr>
			<tr id="adj-{{OIT.idVAP_OIHE}}" class="hidden ab-border" >
				<td></td>
				<td></td>
				<td></td>
				<td colspan=5 style="vertical-align:top;">
					<table style="width:100%">
					<tr ng-repeat="OITDET in rawResult.vap_open_items| AB_noDoubles:'idVAP_OIDE' " ng-if="OIT.idVAP_OIHE == OITDET.VAP_OIDE_OITID" >
						<td style="width:15%;vertical-align:top;">{{ OITDET.VAP_OIDE_TRNDA}}</td>
						<td style="width:10%;vertical-align:top;">{{ OITDET.VAP_OIDE_TRNID}}</td>
						<td style="width:10%;vertical-align:top;" class="text-right" >{{ OITDET.VAP_OIDE_AMUNT}}&nbsp;&nbsp;</td>
						<td style="width:55%">
							<table style="width:100%">
							<tr ng-repeat="OITDDD in rawResult.vap_open_items| AB_noDoubles:'idVAP_OIDE' " ng-if="OITDET.VAP_OIDE_TRNID == OITDDD.VAP_OIDE_TRNID && OITDET.idVAP_OIDE != OITDDD.idVAP_OIDE ">
								<td style="width:32%;" class="text-left">&nbsp;{{OITDDD.VAP_OIHE_DOCDA}}&nbsp;{{OITDDD.VAP_OIHE_OITTY}}</td>
								<td style="width:32%;" class="text-left">&nbsp;{{OITDDD.VAP_OIHE_TRNID}}</td>
								<td style="width:22%;" class="text-right">{{OITDDD.VAP_OIDE_AMUNT}}</td>
								<td style="width:14%;" ></td>
							</tr>
							</table>
						</td>
						<td style="width:10%"></td>
						
					<tr>
					</table>	
			</tr>
			<table>
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
