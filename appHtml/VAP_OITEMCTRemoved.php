/////////


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
		<td style="width:35%;vertical-align:top;" >

			<table style="width:100%;">
				<tr>
					<td style="width:40%;vertical-align:top;">
<?php
$xtmp = new appForm("VAP_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg!=1|| curBank.VGL_BANK_CTRLV!='1'?'hidden':'' }} ";
$laAttr = $xtmp->laAttrib;

$laAttr["class"] .= " small ";
$laAttr["ab-label"] = "VAP_OIHE_CONNU";
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "8";
$xtmp->setFieldWrapper("view01","2.090","vap_oihe","VAP_OIHE_CONNU","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
?>

<?php
$xtmp = new appForm("VAP_OITEMCT");
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{ varFormPg!=1||curBank.VGL_BANK_CHECK!='1'?'hidden':'' }} ";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " small ";
$laAttr["ab-label"] = "STD_CHKID";
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "8";
$xtmp->setFieldWrapper("view01","2.090","vap_oihe","VAP_OIHE_CONNU","",$grAttr,$laAttr,$inAttr,"");
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
$xtmp = new appForm("VAP_OITEMCT");
$hardCode = $xtmp->setDatePick("VAP_OIHE_PMTDA");
echo $hardCode;
?>
						
								</td>
								<td >
								<input size=2 class="hidden" ng-model="postd" ng-bind="postd=ABGetDateFn('diff-today',VAP_OIHE_PMTDA)" />
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
// VAP_OIHE_BPBNK
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['class'] = "hidden";
$grAttr['class'] = "ab-spaceless";

	$keepOrg = 0; 
	$repeatIn = "vgb_bank";
	$searchIn = "";
	$refName = "vgb_bank"; // unique
	$refModel = "VAP_OIHE_BPBNK"; // unique
	$repeatInRef = "idVGB_BANK"; //Unique
	$searchRefDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_BANK_BNKID}}","{{ab_rloop.VGB_BANK_DESCR}}"));
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_BANK_BNKID}}","{{ab_rloop.VGB_BANK_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = "";
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view02","2.5","vap_oihe","VAP_OIHE_BPBNK","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
?>								

								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
