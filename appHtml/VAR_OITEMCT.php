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
require_once "../appCscript/VAR_FINANCE.php";

$xtmp = new appForm("VAR_OITEMCT");

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

$scope.initCust($scope.VGB_CUST_BPART);



</textarea>
	      
</div>

<div class="row " ng-init="SESSION_DESCR='Receivable Journal';" >

<div class="col-lg-12 ab-spaceless ">
    <?php require_once "../stdCscript/stdFormButtons.php"; ?>
    <script>
        $('#ab-sysOpt').addClass("{{updateOn>0&&validEntry()?'':'hidden'}}");
        $('#ab-delete').html(" ");
 //       $('#ab-new').html('');
    </script>
    
</div>

<div class="col-sm-4">   
  

​<table class="table-striped" style="width:100%">
	<tr>
		<td style="width:15%" class="text-center ab-strong small" >
			<span>
				
				<input class="hidden" id="VGB_CUSTsearch" ng-click="initNewCustomer();" />
				<a class="ab-pointer" 
				ng-click="ABsearchTbl='vgb_cust';ABsessionLink('','#VGB_CUSTsearch','vgb_cust');"
				neg-click="ABsessionLink('#/VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_cust,SourceProcess:VSL_ORDERS','#VGB_CUSTsearch');" >
					<span title="Access Partner List " ab-label="VGB_CUST_BPART" ></span>
					<span title="Access Partner List " class="glyphicon glyphicon-search" ></span>
				</a>
			</span>
			<input class="hidden" ng-model="VAR_OIHE_BCUST" />
		</td>
		<td style="width:30%;white-space:nowrap;">
			<form>
				
				<span class="btn ab-spaceless">
					<input title="Find by Partner ID code" class="ab-borderless text-primary" placeholder=" Search by ID " ng-model="ORHE_HISTORY_CUST" size="9"   />
				</span>
				<button class="btn-link ab-border ab-spaceless  {{ORHE_HISTORY_CUST.length>0?'ab-pointer':'invisible'}}"
					ng-click="chkRangePartner('ORHE_HISTORY_CUST','vgb_bpar','VGB_BPAR_BPART');"
				>
				Find
				</button>
				
			</form>

		</td>	
		<td style="width:55%" class="text-right" >
			<label>{{ VGB_BPAR_BPART }}</label>&nbsp;&nbsp;
			<label>{{ VGB_CUST_BPNAM }}</label>&nbsp;&nbsp;

		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr class=" {{ idVGB_ADDR>0?'':'hidden' }}">
		<td colspan=3 class="ab-strong " style="vertical-align:top;padding-left:10px;" >
			<span ab-label='STD_BILL_TO' class='small text-primary'>Bill</span>
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
			
			
			<td  style="width:60%;vertical-align:top;padding-right:30px;">
			

	       			<div class="text-right ">
	       				<span class="{{VGB_ADDR_CONT1!=''?'':'hidden'}} " >
			       			<span ab-label="VGB_ADDR_CONT1" class="text-primary small "></span>{{ VGB_ADDR_CONT1 }}
			       		</span>
		       			<span class="{{VGB_ADDR_TEL01!=''?'':'hidden'}} " >
			       			&nbsp;&nbsp;<span ab-la2bel="VGB_ADDR_TEL01" class="text-primary small ">Tel :</span>{{ VGB_ADDR_TEL01 }}
			       		</span>
		       		</div>
	       			<div class="{{VGB_ADDR_FAX01!=''?'':'hidden'}} text-right  ">
		       			&nbsp;&nbsp;<span ab-la2bel="VGB_ADDR_FAX01" class="text-primary small ">Tel : </span>{{ VGB_ADDR_FAX01 }}
		       		</div>      			
		       		<div class="{{VGB_ADDR_EMAIL!=''?'':'hidden'}}  text-right ">
		       			&nbsp;&nbsp;<span ab-la2bel="VGB_ADDR_EMAIL" class="text-primary small ">E-Mail:</span>{{ VGB_ADDR_EMAIL }}
		       		</div>
		       		
		       		
	       			<div class="text-right ">
	       				
		       			<span ab-label="VGB_ADDR_CONT2" class="{{VGB_ADDR_CONT2!=''?'':'hidden'}}  text-primary small "></span>{{ VGB_ADDR_CONT2 }}
		       			<span class="{{VGB_ADDR_TEL02!=''?'':'hidden'}} " >
		       				&nbsp;&nbsp;<span ab-la2bel="VGB_ADDR_TEL02" class="text-primary small ">Tel :</span>{{ VGB_ADDR_TEL02 }}
		       			</span>
		       		</div>

	       			<div class="{{VGB_ADDR_FAX02>0?'':'hidden'}}  text-right ">
		       			&nbsp;&nbsp;<span ab-la2bel="VGB_ADDR_FAX02" class="text-primary small ">Tel :</span>{{ VGB_ADDR_FAX02 }}
		       		</div>      			
		       		
	       			<div class="{{VGB_ADDR_TAXEX!=''?'':'hidden'}}  text-right ">
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

// VGB_CUST_CURID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CURID";
$hardCode = "<span class='ab-strong'>{{ VGB_CURR_CURID}} &nbsp;&nbsp {{ VGB_CURR_DESCR}}</span>";
$hardCode .= "&nbsp;&nbsp;<span ab-label='STD_RATE' ></span>&nbsp;<span class='ab-strong'>{{ VGB_CURR_CURAT}} &nbsp;&nbsp</span>";
$xtmp->setFieldWrapper("view02","2.6","vgb_cust","VGB_CUST_CURID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>

		</td>
	</tr>		

	<tr class=" {{ idVGB_BPAR>0?'':'hidden' }}">
		<td  >
		</td>
		<td colspan=2 >


<?php



// VGB_CUST_TERID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_TERM_TERID";
$hardCode = "<span class='ab-strong'>{{ VGB_TERM_TERID }}&nbsp;&nbsp;{{ VGB_TERM_DESCR}}";
$hardCode .= "&nbsp;&nbsp;<span ab-label='VGB_TERM_NETDA' class='text-primary' ></span><span>:&nbsp;{{ VGB_TERM_NETDA}}</span><br>";
$hardCode .= "<span ab-label='VGB_TERM_DISDA' class='text-primary' ></span><span>:&nbsp;{{ VGB_TERM_DISDA}}</span>";
$hardCode .= "&nbsp;&nbsp;<span ab-label='VGB_TERM_DISCN' class='text-primary' ></span><span>:&nbsp;{{ VGB_TERM_DISCN}}</span></span>";
$xtmp->setFieldWrapper("view02","2.5","vgb_cust","VGB_CUST_TERID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>

		</td>
	</tr>		
	
	<tr class=" {{ idVGB_BPAR>0?'':'hidden' }}">
		<td  >
		</td>
		<td colspan=2 >
		
<?php
// VGB_CUST_CRELI
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CRELI";
$inAttr['size'] = "8";
$inAttr['readonly'] = "";
$inAttr['class'] .= " ab-strong ";
$inAttr['ab-ft'] = "amt";
$xtmp->setFieldWrapper("view02","2.4","vgb_cust","VGB_CUST_CRELI","",$grAttr,$laAttr,$inAttr,"");

$holdCode = $xtmp->currHtml;

//VGB_CUST_CRHOL
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = "<span class='ab-strong'>" . $xtmp->setYesNoDisplay("VGB_CUST_CRHOL") . "</span>";
$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_CRHOL","",$grAttr,$laAttr,$inAttr,$hardCode);

$holdCode2 = $xtmp->currHtml;




// VGB_CUST_OVERD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr['ab-label'] = "STD_OVERDUE_DAYS";
$inAttr['size'] = 2;
$inAttr['readonly'] = "";
$inAttr['class'] .= " ab-strong ";
$xtmp->setFieldWrapper("view02","2.4","vgb_cust","VGB_CUST_OVERD","",$grAttr,$laAttr,$inAttr,"");


echo "<div><table style='width:100%' ><tr><td style='width:30%' >" . $holdCode . "</td><td style='width:30%' >" . $holdCode2 . "</td><td style='width:40%' >" . $xtmp->currHtml . "</td></tr></table></div>";



?>

		</td>
	</tr>		
	
	<tr class=" {{ idVGB_BPAR>0?'':'hidden' }}">
		<td  >
		</td>
		<td colspan=2 >
		
<?php
$hardCode = "<table>";


$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "20";
$inAttr['readonly'] = "";
$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";

$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_CUBNK","",$grAttr,$laAttr,$inAttr,"");
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td ab-label='STD_NAME' class='" . $laAttr['class'] . "' ></td>";
$hardCode .= "<td>" . $xtmp->currHtml . "</td></tr>";


// VGB_CUST_CREDR 
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "20";
$inAttr['readonly'] = "";
$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";

$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_CREDR","",$grAttr,$laAttr,$inAttr,"");
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td ab-label='STD_REF' class='" . $laAttr['class'] . "' ></td>";
$hardCode .= "<td>" . $xtmp->currHtml . "</td></tr>";



$hardCode .= "</table>";

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["ab-label"] = "STD_BANK";

$xtmp->setFieldWrapper("view02","0.0","vgb_cust","STD_BANK","",$grAttr,$laAttr,$inAttr,$hardCode);

echo $xtmp->currHtml;
?>		
		</td>
	</tr>		


		
</table>	

</div>

<div class="col-sm-7 "> 
   <form id="mainForm" name="mainForm"   ab-view="var_oihe" ab-main="var_oihe"  > 
<div class="row  {{ VAR_OIHE_BCUST>0?'':'hidden' }} ">
<div class="col-sm-12">  
	<input ng-model="varFormPg" class="hidden" ng-init="varFormPg=-1 "/>
	<div class="col-sm-2 well ab-spaceless ab-pointer hidden" 
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
	<div class="col-sm-2 well ab-spaceless  ab-pointer hidden" 
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

<input class="hidden" ng-model="VAR_OIHE_BCUST" />
<input class="hidden" ng-model="VAR_OIHE_BTADD" />
<input class="hidden" ng-model="VAR_OIHE_OITTY" />
<input class="hidden" ng-model="VAR_OIHE_TERID" />
<input class="hidden" ng-model="VAR_OIHE_NETDA" />
<input class="hidden" ng-model="VAR_OIHE_DISDA" />
<input class="hidden" ng-model="VAR_OIHE_DISCN" />
<input class="hidden" ng-model="VAR_OIHE_CURID" />
<input class="hidden" ng-model="VAR_OIHE_CURAT" />
<input class="hidden" ng-model="VAR_OIHE_BPBNK"  />
<input class="hidden" ab-btrigger="var_oihe" ng-model="idVAR_OIHE"  />


<table style="width:100%;" >
	<tr>

		<td style="width:6%;vertical-align:top;" >
<?php

$xtmp = new appForm("VAR_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg==1?'':'hidden' }} ab-spaceless ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ab-spaceless ";
$laAttr["ab-label"] = "STD_SELECT";
$inAttr = $xtmp->inAttrib;
$hardCode = "<input class='hidden' ng-model='VAR_DISTRIBUTE' ng-init='VAR_DISTRIBUTE=0' />";
$hardCode .= "<input type='checkbox' ng-model='VAR_DISTRIBUTE_CK' ng-click='VAR_DISTRIBUTE=1-VAR_DISTRIBUTE;accumAdjust();' ng-init='VAR_DISTRIBUTE_CK=false'/>";
$xtmp->setFieldWrapper("view01","2.090","var_oihe","VAR_DISTRIBUTE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


?>

		</td>
		<td style="width:10%;vertical-align:top;" >

<?php
$xtmp = new appForm("VAR_OITEMCT");
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "STD_POST_DATE";
$laAttr["class"] .= " small ";
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setDatePick("VAR_OIHE_DOCDA");
$xtmp->setFieldWrapper("view01","2.090","var_oihe","VAR_OIHE_DOCDA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
?>
<br>
		</td>
		<td style="width:19%;vertical-align:top;" >

<?php

$xtmp = new appForm("VAR_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg!=0?'':' ab-spaceless' }} ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ";
$laAttr["ab-label"] = "STD_REF";
$laAttr["class"] .= " {{ varFormPg!=0?'':' ab-spaceless' }} ";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","2.090","var_oihe","VAR_OIHE_REFER","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;



?>

		</td>
		<td style="width:15%;vertical-align:top;" >


<?php
$xtmp = new appForm("VAR_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg==3?'hidden':'' }} ab-spaceless ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ";
$laAttr["ab-label"] = "STD_AMOUNT";
$inAttr = $xtmp->inAttrib;
$inAttr['ab-ft'] = "amt";
$inAttr['size'] = "8";
$inAttr['ng-click'] = "validateAmt();";
$inAttr['ng-blur'] = "validateAmt();accumAdjustDelay();";
$xtmp->setFieldWrapper("view01","2.090","var_oihe","VAR_OIHE_AMUNT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
?>

		</td>
		<td style="width:12%;vertical-align:top;" >

<?php

$xtmp = new appForm("VAR_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg!=0?'hidden':'' }} ab-spaceless ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ab-spaceless ";
$laAttr["ab-label"] = "VSL_ORHE_CUSPO";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","2.090","var_oihe","VAR_OIHE_CUSPO","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;






$xtmp = new appForm("VAR_OITEMCT");
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
							<input class="hidden" ng-model="VAR_OIHE_BNKID" />
							<input class="hidden" ng-model="VGL_BANK_PMTTY" />
							<input class="hidden" ng-model="VGL_BANK_TYDET" />
							
							<ul class="nav  ab-spaceless " role="tablist"    >
							<li class="dropdown ab-spaceless"  >
								
								<span data-toggle="dropdown" class="ab-pointer" style="white-space:nowrap;padding:0px;" >
									<span ng-repeat="bnk in rawResult.vgl_bank_info | AB_noDoubles:'idVGL_BANK' " 
									ng-if="VAR_OIHE_BNKID==bnk.idVGL_BANK" >{{ bnk.VGL_BANK_PMTDE }}</span>
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
									ng-if="VAR_OIHE_BNKID==bnk.idVGL_BANK" >&nbsp;&nbsp;{{ bnk.VGL_BANK_TDESC }}&nbsp;&nbsp;</span>
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



$xtmp->setFieldWrapper("view01","2.090","var_oihe","VAR_OIHE_BNKID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
?>
		</td>
		<td style="width:38%;vertical-align:top;" >

			<table style="width:100%;">
				<tr>
					<td style="width:40%;vertical-align:top;">
<?php
$xtmp = new appForm("VAR_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg!=1|| curBank.VGL_BANK_CTRLV!='1'?'hidden':'' }} ";
$laAttr = $xtmp->laAttrib;

$laAttr["class"] .= " small ";
$laAttr["ab-label"] = "VAP_OIHE_CONNU";
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "8";
$xtmp->setFieldWrapper("view01","2.090","var_oihe","VAR_OIHE_CONNU","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
?>

<?php
$xtmp = new appForm("VAR_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg!=1||curBank.VGL_BANK_CHECK!='1'?'hidden':'' }} ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ";
$laAttr["ab-label"] = "STD_CHKID";
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "8";
$xtmp->setFieldWrapper("view01","2.090","var_oihe","VAR_OIHE_CONNU","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
?>

					</td>
					<td style="white-space:nowrap;width:250px;max-width:250px;vertical-align:top;" class="small" >
						<table style="width:100%;" class="{{ varFormPg==1&&(curBank.VGL_BANK_CHECK=='1'||curBank.VGL_BANK_CTRLV==1)?'':'hidden' }}" >
							<tr>
								<td class="text-primary ab-strong " ab-label="STD_PMT_DATE" >
								</td>
								<td>:&nbsp;</td>
								<td >
<?php
$xtmp = new appForm("VAR_OITEMCT");
$hardCode = $xtmp->setDatePick("VAR_OIHE_PMTDA");
echo $hardCode;
?>
						
								</td>
								<td >
								<input size=2 class="hidden" ng-model="postd" ng-bind="postd=ABGetDateFn('diff-today',VAR_OIHE_PMTDA)" />
								<span class="text-primary {{ postd>0?'':'invisible'}}" >
									&nbsp;
									<input ng-model="postdatedchk" type="checkbox" />
									<span ab-label="STD_POST_DATED" >PD</span>
									

								</span>
								</td>
							</tr>
							<tr>
								<td class="text-primary ab-strong " ab-label="STD_BANK" >
								</td>
								<td>:</td>
								<td colspan=2 class="text-left " style="white-space:nowrap;"
								ng-init="VGB_BANK_BNKID='';ABlstAlias('VGB_BANK_BNKID','VGB_BANK_BNKID','vgb_bank',0);"
								>


<?php
// VAR_OIHE_BPBNK
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['class'] = "hidden";
$grAttr['class'] = "ab-spaceless";

	$keepOrg = 0; 
	$repeatIn = "vgb_bank";
	$searchIn = "";
	$refName = "vgb_bank"; // unique
	$refModel = "VAR_OIHE_BPBNK"; // unique
	$repeatInRef = "idVGB_BANK"; //Unique
	$searchRefDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_BANK_BNKID}}","{{ab_rloop.VGB_BANK_DESCR}}"));
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_BANK_BNKID}}","{{ab_rloop.VGB_BANK_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = "";
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view02","2.5","var_oihe","VAR_OIHE_BPBNK","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
?>								
								</td>
							</tr>
						</table>
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
	<table	class=" table-striped " style="width:100%;" >
	<tr class="text-primary" >
		<td style="width:6%;" >&nbsp;&nbsp;Date</td>
		<td style="width:18%;padding-right:10px;" class="text-right" >
			<span class="{{varFormPg==3?'':'hidden'}} ab-spaceless">
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
		<td style="width:10%;" >Inv# - Tr.ID</td>
		<td style="width:10%;" >Type</td>
		<td style="width:10%;" class="text-right" >Amount&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td style="width:10%;" class="text-right" >Balance&nbsp;&nbsp;</td>
		<td style="width:36%;" >&nbsp;&nbsp;Reference&nbsp;&nbsp;
		<button class="small ab-borderless" ng-click="showZero=1-showZero" ng-init="showZero=0">
			<span ab-label="STD_SHOW_ZERO" class="{{showZero==0?'':'hidden'}}">Show</span>
			<span ab-label="STD_HIDE_ZERO" class="{{showZero>0?'':'hidden'}}">Hide</span>
		</button>
		</td>
	</tr>
	</table>
	</div>
	<div class="ab-wrapper-div">
		<table	class=" table-striped " style="width:100%;" >
		<tr class="text-primary" >
			<td style="width:12%;"  ></td>
			<td style="width:12%;" ></td>
			<td style="width:10%;" ></td>
			<td style="width:10%;" ></td>
			<td style="width:10%;" ></td>
			<td style="width:10%;" ></td>			
			<td style="width:36%;" ></td>
		</tr>
		<tr  ab-formlist="oihe_list"  ng-repeat="OIT in var_open_items| AB_noDoubles:'idVAR_OIHE' " ng-if="OIT.VAR_OIHE_BALAN != 0 || showZero>0">
			<td colspan=100 >
			<div>
			<form ab-view="oihe_list" ab-main="oihe_list" ab-context="0" >
			<table style="width:100%;"  >
			<tr class="text-primary" >
				<td style="width:12%;"><input ng-model="OIT.idVAR_OIHE" class="hidden" /></td>
				<td style="width:12%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:36%;" ></td>
			</tr>
			<tr>			
			<td>
			
				<span class="text-primary small {{(varFormPg==3||isDistribute()==true)&&OIT.idVAR_OIHE>0&&OIT.VAR_OIHE_BALAN!=0?'ab-border':'invisible'}} ab-spaceless">
					
					<span ng-click="
					OIT.SELECT = 1-OIT.SELECT;
					OIT.ADJAMOUT=(OIT.SELECT>0?OIT.VAR_OIHE_BALAN:0);
					accumAdjustDelay();
					" 
					style="{{OIT.SELECT>0?'':'color:transparent;' }}" class="glyphicon glyphicon-ok" ></span>
				</span>&nbsp;
				{{OIT.VAR_OIHE_DOCDA}}
				<input ng-model="OIT.VAR_OIHE_DOCDA" class="hidden" />
			</td>		
			<td  >
				<span class="{{(varFormPg==3||isDistribute()==true)&&OIT.idVAR_OIHE>0?'':'hidden'}} ab-spaceless">
					<input ng-model="OIT.SELECT" ng-init="OIT.SELECT=0" class="hidden" />
					<button class="small ab-borderless {{OIT.SELECT>0?'':'hidden'}} " 
					title="Set to remaining balance"
					ng-click="OIT.ADJAMOUT=OIT.ADJAMOUT-ADJBALANCE;accumAdjustDelay();">=</button>
					<span class="{{OIT.SELECT>0?'ab-border':''}} ab-spaceless" >
						<input 	ng-model="OIT.ADJAMOUT"
							trtype="{{OIT.VAR_OIHE_OITTY}}" 
							trbal="{{OIT.VAR_OIHE_BALAN}}"
							ng-init="OIT.ADJAMOUT=0"
							ng-blur="accumAdjustDelay();"
							size=6
							class="{{OIT.SELECT>0?'':'hidden'}} ab-borderless ab-spaceless text-right {{OIT.VAR_OIHE_OITTY!='INV'?'text-danger':'text-primary'}}" 
						/>
						
					</span>
				</span>
			</td>

			<td class="small ab-strong text-center" >
				<span class="ab-pointer text-primary" pt="#jrn-{{OIT.idVGL_JNHE}}" onclick="$($(this).attr('pt')).toggleClass('hidden');" >
				<span class="{{OIT.VAR_OIHE_INVOI>0?'':'hidden'}}">{{OIT.VAR_OIHE_INVOI}}-</span>
				{{OIT.VGL_JNHE_TRNID}}
				</span>
				<input ng-model="OIT.VAR_OIHE_TRNID" class="hidden" />
				
			</td>
			<td  >
				<div>
				<table>
				<tr>
				<td title="View posting detail" >
					{{OIT.VAR_OIHE_OITTY}}
					<input ng-model="OIT.VAR_OIHE_OITTY" class="hidden" />
				</td>
				<td style="white-space:nowrap;" >
					<span data-toggle="dropdown" class="text-primary  small" style="white-space:nowrap;padding:0px;" >
						
						<span  ng-repeat="bnk in rawResult.vgl_bank_info | AB_noDoubles:'idVGL_BANK' " 
						ng-if="OIT.VAR_OIHE_OITTY=='PMT'&&OIT.VAR_OIHE_BNKID==bnk.idVGL_BANK" >{{ bnk.VGL_BANK_PMTDE }}&nbsp;
						
						</span>
					
						
					</span>
				</td>
				</tr>
				</table>
				</div>
				
			</td>
			<td class="text-right" >
				<input ng-model="OIT.VAR_OIHE_AMUNT" class="hidden" />
				{{OIT.VAR_OIHE_AMUNT}}
				<span class="{{OIT.VAR_OIHE_AMUNT!=OIT.VAR_OIHE_BALAN?'text-primary ab-pointer':''}}" tid="{{OIT.idVAR_OIHE}}" 
				onclick="$('#ADJ-'+$(this).attr('tid')).toggleClass('hidden');"  >&nbsp;&nbsp;
				<span class="caret {{OIT.VAR_OIHE_AMUNT!=OIT.VAR_OIHE_BALAN?'':'invisible'}}"> </span></span>
			</td>
			<td class="text-right ab-strong" >
				<input ng-model="OIT.VAR_OIHE_BALAN" class="hidden" />
				{{OIT.VAR_OIHE_BALAN}}&nbsp;&nbsp;
			</td>
			<td class="small" >
				<input ng-model="OIT.VAR_OIHE_REFER" class="hidden" />
				&nbsp;&nbsp;
				
				<span class="{{OIT.VAR_OIHE_REFER.trim()!=''?'':'hidden'}} ab-strong" ab-label="" >
				{{OIT.VAR_OIHE_REFER}}&nbsp;&nbsp;
				</span>
				<span class="{{OIT.VAR_OIHE_CONNU.trim()!=''?'':'hidden'}} ab-strong" ab-label="" >
					<span ng-repeat="bnk in rawResult.vgl_bank_info | AB_noDoubles:'idVGL_BANK' " 
					ng-if="OIT.VAR_OIHE_BNKID==bnk.idVGL_BANK" >
						{{ bnk.VGL_BANK_TDESC }}
					</span>
					&nbsp;:&nbsp;{{OIT.VAR_OIHE_CONNU}}
				</span>
				
				<span >
					{{OIT.VAR_OIHE_PMTDA}}
					<span class="small ab-strong"  ng-repeat="bk in vgb_bank |  AB_noDoubles:'idVGB_BANK'" ng-if="bk.idVGB_BANK==OIT.VAR_OIHE_BPBNK" >
					{{bk.VGB_BANK_BNKID}}
					</span>
				</span>

			</td>	
			</tr>
			<tr id="jrn-{{OIT.idVGL_JNHE}}" class="hidden">
				<td></td>
				<td colspan=10>
					<table style="width:100%;">
					<tr class="ab-strong" ng-repeat="jrn in rawResult.vgl_journal | AB_noDoubles:'idVGL_JNHE' " ng-if="jrn.idVGL_JNHE == OIT.idVGL_JNHE" >
						<td style="width:30%;"> Source: {{jrn.VGL_JNHE_PSOUR}} </td>
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
			<tr class="text-primary" >
				<td style="width:12%;"><input ng-model="OIT.idVAR_OIHE" class="hidden" /></td>
				<td style="width:8%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:10%;" ></td>
				<td style="width:40%;" ></td>
			</tr>
			<tr id="ADJ-{{OIT.idVAR_OIHE}}" class="hidden ab-border" >
				<td></td>
				<td></td>
				<td></td>
				<td colspan=5 style="vertical-align:top;">
					<table style="width:100%">
					<tr ng-repeat="OITDET in rawResult.var_open_items| AB_noDoubles:'idVAR_OIDE' " ng-if="OIT.idVAR_OIHE == OITDET.VAR_OIDE_OITID" >
						<td style="width:15%;vertical-align:top;">{{ OITDET.VAR_OIDE_TRNDA}}</td>
						<td style="width:10%;vertical-align:top;">{{ OITDET.VAR_OIDE_TRNID}}</td>
						<td style="width:10%;vertical-align:top;" class="text-right" >{{ OITDET.VAR_OIDE_AMUNT}}&nbsp;&nbsp;</td>
						<td style="width:55%">
							<table style="width:100%">
							<tr ng-repeat="OITDDD in rawResult.var_open_items| AB_noDoubles:'idVAR_OIDE' " ng-if="OITDET.VAR_OIDE_TRNID == OITDDD.VAR_OIDE_TRNID && OITDET.idVAR_OIDE != OITDDD.idVAR_OIDE ">
								<td style="width:32%;" class="text-left">&nbsp;{{OITDDD.VAR_OIHE_DOCDA}}&nbsp;{{OITDDD.VAR_OIHE_OITTY}}</td>
								<td style="width:32%;" class="text-left">&nbsp;{{OITDDD.VGL_JNHE_TRNID}}</td>
								<td style="width:22%;" class="text-right">{{OITDDD.VAR_OIDE_AMUNT}}</td>
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

<div class="hidden">
<input class='text-muted' ab-mpp onchange="getMaxPerPage();" value="0" />
</div>
   </div>
   
   
  