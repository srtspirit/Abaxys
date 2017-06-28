
<div id="AB_Form" id="addForm" class="" >


	<div class="row container">

<button ng-click="flipHidden('.collps',false);flipHidden('.collps-on',true);" class="btn-link {{idVGB_BPAR!=0?'':'hidden'}}" >
	<span class="glyphicon glyphicon-arrow-left" style="font-size:large;">
	</span>
</button>

	
<?php

$xtmp = new appForm("VGB_ADDRCT");

echo '<div class="col-sm-3 ab-borderless">';

 
// idVGB_ADDR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";

$xtmp->setFieldWrapper("view01","0.0","vgb_addr","idVGB_ADDR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


// VGB_ADDR_BPART 
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "{{opts.Session=='VGB_CUSTCT'?'VGB_CUST_BPART':'VGB_SUPP_BPART'}}";
$hardCode = <<<HRD


<label >{{VGB_BPAR_BPART}}&nbsp;&nbsp;&nbsp;</label>
<label {{opts.Session!='VGB_SUPPCT'?'':'hidden'}} >{{VGB_CUST_BPNAM}}</label>
<label {{opts.Session=='VGB_SUPPCT'?'':'hidden'}} >{{VGB_SUPP_BPNAM}}</label>

HRD;

$xtmp->setFieldWrapper("view01","1.01","vgb_addr","VGB_ADDR_BPART","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

	
// VGB_ADDR_ADDID if new
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] .= " {{idVGB_BPAR>0?hidden'':'';}} ";
$xtmp->setFieldWrapper("view01","1.02","vgb_addr","VGB_ADDR_ADDID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VGB_ADDR_ADDID exits
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] .= " {{VGB_ADDR_BPART>0?'':'hidden';}} ";
	
$xtmp->setFieldWrapper("view01","1.02","vgb_addr","VGB_ADDR_ADDID","",$grAttr,$laAttr,$inAttr,"<label>{{ VGB_ADDR_ADDID }}</label>");
echo $xtmp->currHtml;
echo '</div> ';		
?>
<!--
			<td>
				<label class=""   ab-label="VGB_ADDR_ADDID">Address ID</label>
				
				
			</td>
			<td>
				<div>
					<table>
					<tr>
						<td>
							<span class="{{idVGB_ADDR>0?'hidden':'';}} {{idVGB_BPAR>0?'':'hidden';}}" >
								<input size=2	
									lval=""
									
									ng-model="VGB_ADDR_ADDID" 
									ng-blur=
									"ABupdChkObj('idVGB_ADDR','',false);
									ABupdChkObj('VGB_ADDR_ADDID',VGB_ADDR_ADDID,true);
									ABupdChkObj('VGB_ADDR_BPART',VGB_CUST_BPART,true);
									ABchk();";
									nsg-blur="A_validate('VGB_ADDR_ADDID,VGB_ADDR_BPART','vgb_addr');"
								/>
								
							</span>						

							<span class="{{idVGB_ADDR>0?'hidden':'';}} {{idVGB_BPAR>0?'hidden':'';}}" >
								<input size=2	
									lval=""
									
									ng-model="VGB_ADDR_ADDID" 
								/>
							</span>						

						</td>
						<td>
							<div class="{{VGB_ADDR_BPART>0?'':'hidden';}}" >
								<label>{{ VGB_ADDR_ADDID }}</label>
							

							</div>
						</td>
						<td>	

															
							<span class="{{idVGB_ADDR>0?'hidden':'';}}" >
								<span ng-repeat="x in VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR' " >
									<span class="btn-warning hidden{{x.VGB_ADDR_ADDID==VGB_ADDR_ADDID?'xx':''}}" >
										already exist!
									</span>
								</span>
							</span>		
						</td>
						
					</tr>
					</table>
				</div>

			</td>
			</tr>
			<td>
				<label class="btn-md"   ab-label="STD_NOTE">Address Description</label>
			</td>
			<td>	
				<input type="text"  size=40 ng-model="VGB_ADDR_DESCR" value="" />
			</td>
			</tr>
			<td colspan=2 >
			<table class="table" ><tr>
				<td rowspan=3 class="ab-align-top">
					<label class="btn-md"   ab-label="STD_ADDRESS">Address</label>
				</td>
				<td>	
					<input type="text"  size=40 ng-model="VGB_ADDR_ADNAM" value="" />
		
				</td>
				</tr>
			
				<td>
					<input type="text"   size=40 ng-model="VGB_ADDR_ADD01" value="" />
		
				</td>
				</tr>
				
				<td>
					<input type="text"   size=40 ng-model="VGB_ADDR_ADD02" value="" />
		
				</td>
			</tr></table>	
			</td>
			</tr>
			<td>
				<label class="btn-md"   ab-label="VGB_ADDR_CITYN">City Name</label>
			</td>
			<td>		
				<input type="text" class="A_input"  size=20 ng-model="VGB_ADDR_CITYN" value="" />
			</td>
			</tr>
			<td>
				<label class="btn-md"   ab-label="VGB_ADDR_POSTC">Postal Code</label>
			</td>
			<td>	
				<input type="text" class="A_input"  size=10 ng-model="VGB_ADDR_POSTC" value="" />
						
			</td>
			</tr>
			<td>
				<label class="btn-md"   ab-label="VGB_PRST_PRSID">Province State ID</label>
			</td>
			<td >


<?php
$keepOrg = 0; 
$repeatIn = "vgb_prst | AB_noDoubles:'idVGB_PRST'";
$searchIn = "";
$refName = "vgb_prst"; // unique
$refModel = "VGB_ADDR_PRSID"; // unique
$repeatInRef = "idVGB_PRST"; //Unique
$searchRefDesc = ""; // implode("&nbsp;&nbsp;",array("{{VGB_PRST_PRSID}}","{{VGB_PRST_DESCR}}"));
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_PRST_PRSID}}","{{ab_rloop.VGB_PRST_DESCR}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_PRST_PRSID;VGB_PRST_PRSID='';VGB_PRST_PRSID_F='';kPress('VGB_PRST_PRSID','VGB_PRST_PRSID','vgb_prst',0);VGB_PRST_PRSID=hold;".'"';
$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>



			 
			</td>
			</tr>
			<td>
				<label class="btn-md"   ab-label="VGB_ADDR_CNTID">Country ID code</label>
			</td>
			<td>	
<?php
$keepOrg = 0; 
$repeatIn = "vgb_cntr | AB_noDoubles:'idVGB_CNTR'";
$searchIn = "";
$refName = "vgb_cntr"; // unique
$refModel = "VGB_ADDR_CNTID"; // unique
$repeatInRef = "idVGB_CNTR"; //Unique
$searchRefDesc = ""; // implode("&nbsp;&nbsp;",array("{{VGB_CNTR_CNTID}}","{{VGB_CNTR_DESCR}}"));
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_CNTR_CNTID}}","{{ab_rloop.VGB_CNTR_DESCR}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_CNTR_CNTID;VGB_CNTR_CNTID='';VGB_CNTR_CNTID_F='';kPress('VGB_CNTR_CNTID','VGB_CNTR_CNTID','vgb_cntr',0);VGB_CNTR_CNTID=hold;".'"';
$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>


			</td>
			</tr>
	
			</table>
		          
		</div>		
		<div class="col-sm-6">
	
			<table  class="table  table-striped" >
			<tr>
			<td>
				<label class="btn-md"   ab-label="VGB_ADDR_CONT1">Contact #1</label>
			</td>	
			<td>
				<input type="text"  size=30 ng-model="VGB_ADDR_CONT1" value="" />
			</td>
			</tr>
			<tr>
			<td class="ab-align-top">	
				
			</td>
			<td class="ab-align-top">
				<input type="text" class="A_input"  size=14 ng-model="VGB_ADDR_TEL01" value="" />
				<label class="btn-md"   ab-label="VGB_ADDR_TEL01">Tel</label>
			</td>
			</tr>	
			<tr>
			<td class="ab-align-top">	
				
			</td>
			<td class="ab-align-top">
				<input type="text" class="A_input"  size=14 ng-model="VGB_ADDR_FAX01" value="" />
				<label class="btn-md"   ab-label="VGB_ADDR_FAX01">Fax</label>
			</td>
			</tr>
	
			<tr>
			<td>
				<label class="btn-md"   ab-label="VGB_ADDR_CONT2">Contact #2</label>
			</td>	
			<td>
				<input type="text"  size=30 ng-model="VGB_ADDR_CONT2" value="" />
			</td>
			</tr>
			<tr>
			<td class="ab-align-top">	
				
			</td>
			<td class="ab-align-top">
				<input type="text" class="A_input"  size=14 ng-model="VGB_ADDR_TEL02" value="" />
				<label class="btn-md"   ab-label="VGB_ADDR_TEL02">Tel</label>
			</td>
			</tr>	
			<tr>
			<td class="ab-align-top">	
				
			</td>
			<td class="ab-align-top">
				<input type="text" class="A_input"  size=14 ng-model="VGB_ADDR_FAX02" value="" />
				<label class="btn-md"   ab-label="VGB_ADDR_FAX02">Fax</label>
			</td>
			</tr>
			
			<tr>
			<td>
	
				<label class="btn-md"   ab-label="VGB_ADDR_EMAIL">Email</label>
			</td>
			<td>
				<input type="text"  size=30 ng-model="VGB_ADDR_EMAIL" value="" />
			</tr>
	
			<tr>
			<td>		
				<label class="btn-md"   ab-label="VGB_ADDR_SCHID">(Sales) Taxe Scheme</label>
			</td>	
			<td class="ab-align-top">
			<div>

<?php
$keepOrg = 0; 
$repeatIn = "vtx_schh";
$searchIn = "";
$refName = "vtx_schhSA"; // unique
$refModel = "VGB_ADDR_SCHID"; // unique
$repeatInRef = "idVTX_SCHH"; //Unique
$searchRefDesc = ""; // implode("&nbsp;&nbsp;",array("{{VTX_SCHH_SCHID}}","{{VTX_SCHH_SCHDE}}"));
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VTX_SCHH_SCHID}}","{{ab_rloop.VTX_SCHH_SCHDE}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VTX_SCHH_SCHID;VTX_SCHH_SCHID='';VTX_SCHH_SCHID_F='';kPress('VTX_SCHH_SCHID','VTX_SCHH_SCHID','vtx_schh',0);VTX_SCHH_SCHID=hold;".'"';
$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>

				
			</div>
			</td>
			</tr>		
			<tr>
			<td>		
				<label class="btn-md"   ab-label="VGB_ADDR_PCHID">(Purchase) Taxe Scheme</label>
			</td>	
			<td class="ab-align-top">
			<div>
<?php
$keepOrg = 0; 
$repeatIn = "vtx_schh";
$searchIn = "";
$refName = "vtx_schhPU"; // unique
$refModel = "VGB_ADDR_PCHID"; // unique
$repeatInRef = "idVTX_SCHH"; //Unique
$searchRefDesc = "";
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VTX_SCHH_SCHID}}","{{ab_rloop.VTX_SCHH_SCHDE}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VTX_SCHH_SCHID;VTX_SCHH_SCHID='';VTX_SCHH_SCHID_F='';kPress('VTX_SCHH_SCHID','VTX_SCHH_SCHID','vtx_schh',0);VTX_SCHH_SCHID=hold;".'"';
$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>

				
			</div>
			</td>
			</tr>
			</table>
	
		</div>
-->	
	</div>
</div>