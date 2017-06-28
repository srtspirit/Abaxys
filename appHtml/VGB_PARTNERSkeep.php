¿<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VGB_PARTNERS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;

?>
</div>

<div class="hidden" ng-init="SESSION_DESCR=tbData=='vgb_cust'?'Customers':'Suppliers';">

	<span ab-label="VGB_CUSTCT"></span>
	<span ab-label="VGB_SUPPCT"></span>
	<span ab-label="VGB_ADDRCT"></span>

</div>

<div style="margin-left:5px;" >

	<div id="mainForm" ab-main="vgb_bpar" style="margin:0px;">
	
		<div class="row  "  >
			<div class="col-sm-12 ab-spaceless "  >
		
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
				
			</div>
		
			<div class="col-sm-12 ">
				<table  >
				<tr>
					<td>
					  		<div title="" ng-init="collaps=0">
					  			<span  onclick="$('#bcollaps').click();collapseall(0);" class="btn-link " title="">
					  				<span class="glyphicon glyphicon-zoom-out " title=""></span>
					  			</span>
								<span onclick="$('#bcollapsIn').click();collapseall(1);" class="btn-lg btn-link " title="">
									<span class="glyphicon glyphicon-zoom-in " title="">
									</span>
								</span>
								<input class="hidden" id="bcollaps" ng-model="collaps" ng-click="collaps = 0;" size=2 />
								<input class="hidden" id="bcollapsIn" ng-model="collaps" ng-click="collaps = 1;" size=2 />
							</div>
					</td>
				<td id="ab-new" >
					<label  title="CREATE" class="{{tbData=='vgb_cust'?'':'hidden'}}">
	 				 		
	 				 		<a 
							abl-first={{$first}}
							abl-last={{$last}}
							
							value={{tbData=='vgb_bpar'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_cust'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_supp'?x.VGB_BPAR_BPART:''}}
							xxx={{tbData}}
							href="#VGB_PARTNERS/VGB_CUSTCT/Process:VGB_PARTNERS,Session:VGB_CUSTCT,tblName:vgb_cust,updType:CREATE,idVGB_BPAR:0,VGB_BPAR_BPART:,tbData:{{tbData}}" 
							>
								<span >New</span>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>
											
					</label>
					<label  title="CREATE" class="{{tbData=='vgb_cust'?'hidden':''}}">
	 				 		<a 
							abl-first={{$first}}
							abl-last={{$last}}
							
							value={{tbData=='vgb_bpar'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_cust'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_supp'?x.VGB_BPAR_BPART:''}}
							xxx={{tbData}}
							href="#VGB_PARTNERS/VGB_SUPPCT/Process:VGB_PARTNERS,Session:VGB_SUPPCT,tblName:vgb_supp,updType:CREATE,idVGB_BPAR:0,VGB_BPAR_BPART:,tbData:{{tbData}}"  
							>
								<span >New</span>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>
	
	
					</label>
				</td>
				<td>	  
					
	<?php
	
	$xtmp = new appForm("VGB_PARTNERS");
	
$hardCode = <<<BOD
	
			<div  >
				
				<span ab-empty="{{tbData=='vgb_bpar'?'vgb_bpar':'Yes'}}" class="hidden{{ tbData=='vgb_bpar'?'xxx':''}}" >
					<input a_iref="02-60"
							size=15
							lval=""
							ng-keyup="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',0);"
							ng-blur="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',0);"
							ng-model="VGB_BPAR_BPART" value="" 
							style="{$xtmp->inAttrib['style']}"
							
						/>
	
					
					<img src="stdImages/buttons/A_Search.png" width="30" height="30"  ng-click="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',0)" />
				</span>
		
				<span ab-empty="{{tbData=='vgb_cust'?'vgb_cust':'Yes'}}"
				class="hidden{{ tbData=='vgb_cust'?'xxx':''}}" >
					<input a_iref="02-60"
							size=15
							lval=""
							nggg-keyup="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_cust',0);"
							nggg-blur="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_cust',0);"
							ng-change="FLT_BPAR_BPART=VGB_BPAR_BPART;VGB_BPAR_BPART=' ';ABlstAlias('VGB_BPAR_BPART','VGB_BPAR_BPART,FLT_BPAR_BPART','vgb_cust','vgb_bpar');VGB_BPAR_BPART=FLT_BPAR_BPART;"
							ng-model="VGB_BPAR_BPART" value="" 
							style="{$xtmp->inAttrib['style']}"
						/>
	
					
				</span>
				<span ab-empty="{{tbData=='vgb_supp'?'vgb_supp':'Yes'}}"
				class="hidden{{ tbData=='vgb_supp'?'xxx':''}}" >
					<input a_iref="02-60"
							size=15
							lval=""
							nggg-keyup="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_supp',0);"
							nggg-blur="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_supp',0);"
							ng-change="FLT_BPAR_BPART=VGB_BPAR_BPART;VGB_BPAR_BPART=' ';ABlstAlias('VGB_BPAR_BPART','VGB_BPAR_BPART,FLT_BPAR_BPART','vgb_supp','vgb_bpar');VGB_BPAR_BPART=FLT_BPAR_BPART;"
							ng-model="VGB_BPAR_BPART" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>
	
				</span>
			
			</div>
			
			
				<input class="hidden"  id="FLT_BPAR" ab-filter="vgb_bpar" ab-filter-cond="CONTAINS" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  

				ab-filter-model="VGB_BPAR_BPART,VGB_CUST_BPNAM,VGB_CUST_CUBNK,VGB_CUST_DELCO,VGB_ADDR_DESCR,VGB_ADDR_TEL01,VGB_ADDR_TEL02,VGB_ADDR_FAX01,VGB_ADDR_FAX02,VGB_ADDR_POSTC,VGB_ADDR_ADNAM,VGB_ADDR_ADD01,VGB_ADDR_ADD02,VGB_ADDR_CONT1,VGB_ADDR_CONT2,VGB_ADDR_EMAIL,VGB_CTYP_CUTYP,VGB_SLRP_SLSRP,VGB_TERM_TERID"

				ng-model="FLT_BPAR_BPART" />
				
					<span ng-init="VGB_PARTNERS_DRILL=1" ></span>
					<input type="hidden" ng-model="VGB_PARTNERS_DRILL" />

BOD;




 
// Standard Search by VGB_BPAR_BPART


$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="{{tbData=='vgb_cust'?'VGB_CUST_BPART':'VGB_SUPP_BPART'}}";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;

$xtmp->setFieldWrapper("view01","0.0","vgb_bpar","VGB_BPAR_BPART","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;



?>	
			</td>
			</tr>
			</table>
			
		</div>
	</div>
<script>
$('#ab-appOpt').html('&nbsp;&nbsp;' + $('#ab-new').html());
$('#ab-sysOpt').html('');
$('#ab-new').html('');

</script>

<div>
  	<table class="table table-condensed" style="width:95%;">
	<tr>

		<td class=" ab-spaceless">
			<div class="row ab-listhead bg-primary"  >
			<?php
			
			$xtmp = new appForm("VGB_PARTNERS");
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-1";
			$laAttr = $xtmp->laAttrib;
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vgb_bpar","","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
						
			$xtmp = new appForm("VGB_PARTNERS");
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-3";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="{{tbData=='vgb_cust'?'VGB_CUST_BPART':'VGB_SUPP_BPART'}}";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vgb_bpar","VGB_BPAR_BPART","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			$xtmp = new appForm("VGB_PARTNERS");
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-3";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="STD_NAME";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vgb_bpar","VGB_BPAR_BPNAM","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			$xtmp = new appForm("VGB_PARTNERS");
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-5";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="STD_CDATE";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vgb_bpar","STD_CDATE","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			?>
			</div>
	</td>
		</tr>	
	</table>

</div>



	<div  class="mygrid-wrapper-div"   style="margin:0px;padding:0px;" >



  <div >
  

<table class="table table-condensed table-striped"  >	  	
	  <tr role="presentation"  ng-repeat="x in vgb_bpar |AB_Sorted:'VGB_BPAR_BPART' " abl-first={{$first}} abl-last={{$last}} >
	  			
	  			<td ng-if="abSessionModal==true" class="small">
	  				<a  ng-click="ABsessionSetResponse(x)" > Select </a>&nbsp;
	  			</td>
	  			
				<td style="min-width:10px;max-width:10px;" >	
					<span ng-if="!ABSelectors.idVGB_CUST[x.idVGB_CUST]" ng-click="ABRecSelectors('idVGB_CUST',x.idVGB_CUST,'add',x.VGB_BPAR_BPART + ':' + x.VGB_CUST_BPNAM);">
						<span class="ab-pointer glyphicon glyphicon-plus text-muted small" title="add to tagged list" ></span>
						
					</span>
					<span ng-if="ABSelectors.idVGB_CUST[x.idVGB_CUST]" ng-click="ABRecSelectors('idVGB_CUST',x.idVGB_CUST,'delete',x.VGB_BPAR_BPART + ':' + x.VGB_CUST_BPNAM);" >
						<span class="btn-link glyphicon glyphicon-tag" title="remove from tagged list" ></span>
					</span>
					
				</td>

	  <td>
          
		<div class="row "  >
		
			<div class="col-sm-1" >	

 				 		<a  class="hidden{{tbData!='vgb_cust'?'':'xx'}}" 
						
						value={{tbData=='vgb_bpar'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_cust'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_supp'?x.VGB_BPAR_BPART:''}}
						xxx={{tbData}}
						href="#{{opts.Process}}/VGB_CUSTCT/idVGB_BPAR:{{x.idVGB_BPAR}},idVGB_CUST:{{x.idVGB_CUST}},updType:UPDATE,Session:VGB_CUSTCT,Process:{{opts.Process}}" >
						
						<?php
						$tFnc = new AB_querySession;
						$dtaObj = array();
						$dtaObj['PROCESS'] = "VGB_PARTNERS";
						$dtaObj['SESSION'] = "VGB_CUSTCT";
						$chk = 0;
						$chk += $tFnc->hasPriviledge($dtaObj,"vgb_cust","New");
						$chk += $tFnc->hasPriviledge($dtaObj,"vgb_cust","Upd");
						$chk += $tFnc->hasPriviledge($dtaObj,"vgb_cust","Del");

						if ($chk > 0)
						{
							echo "<span >Edit</span>";
						}
						else
						{
							echo "<span >View</span>";
						}
						?>
							<span  class="glyphicon glyphicon-pencil" ></span>
						</a>
						
						
						<a class="hidden{{tbData!='vgb_supp'?'':'xx'}}" 
						
						
						value={{tbData=='vgb_bpar'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_cust'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_supp'?x.VGB_BPAR_BPART:''}}
						xxx={{tbData}}
						href="#{{opts.Process}}/VGB_SUPPCT/idVGB_BPAR:{{x.idVGB_BPAR}},idVGB_SUPP:{{x.idVGB_SUPP}},updType:UPDATE,Session:VGB_SUPPCT,Process:{{opts.Process}}" >
						<?php
						$tFnc = new AB_querySession;
						$dtaObj = array();
						$dtaObj['PROCESS'] = "VGB_PARTNERS";
						$dtaObj['SESSION'] = "VGB_SUPPCT";
						$chk = 0;
						$chk += $tFnc->hasPriviledge($dtaObj,"vgb_supp","New");
						$chk += $tFnc->hasPriviledge($dtaObj,"vgb_supp","Upd");
						$chk += $tFnc->hasPriviledge($dtaObj,"vgb_supp","Del");

						if ($chk > 0)
						{
							echo "<span >Edit</span>";
						}
						else
						{
							echo "<span >View</span>";
						}
						?>
							<span  class="glyphicon glyphicon-pencil" ></span>
						</a>
							<span style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{x.idVGB_BPAR}}" class="btn-link glyphicon glyphicon-th-list"></span>
						
			</div>
			<div class="col-sm-3" >	
							<div>
							<label>
							{{x.VGB_BPAR_BPART}}<input class="hidden" ng-model="x.VGB_BPAR_BPART" />
							</label>		
							</div>
							<?php
							// VSL_ORHE_ORNUM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small ng-binding"  class="text-primary"><label><em  ab-label="STD_CURRENCY" class="text-primary">Currency:</em><small>&nbsp;{{x.VGB_CURR_CURID}}</small><small class="ng-binding">&nbsp;{{x.VGB_CURR_DESCR}}</small></label></div> ';
$xtmp->setFieldWrapper("header","0.0","","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
?>				
			</div>


			<div class="col-sm-3">		
				
				<label>
					<span class="hidden{{tbData=='vgb_bpar'?'yes':''}}" >
					{{x.VGB_BPAR_BPNAM}}<input class="hidden" ng-model="x.VGB_BPAR_BPNAM" />
					</span>
					<span class="hidden{{tbData=='vgb_cust'?'yes':''}}" >
					{{x.VGB_CUST_BPNAM}}<input class="hidden" ng-model="x.VGB_CUST_BPNAM" />
					</span>
					<span class="hidden{{tbData=='vgb_supp'?'yes':''}}" >
					{{x.VGB_SUPP_BPNAM}}<input class="hidden" ng-model="x.VGB_SUPP_BPNAM" />
					</span>
				</label>
			<?php
							// VSL_ORHE_ORNUM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"  class="text-primary"><label><em  ab-label="VGB_TERM_TERID" class="text-primary">Term:</em><small>&nbsp;{{x.VGB_TERM_TERID}}</small><small>&nbsp;{{x.VGB_TERM_DESCR}}</small></label></div> ';
$xtmp->setFieldWrapper("header","0.0","","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

							?>			
			</div>
			<div class="col-sm-5">		
				<label>
				{{x.VGB_BPAR_CDATE}}<input class="hidden" ng-model="x.VGB_BPAR_CDATE" /> 
				</label>
				<?php
							// VSL_ORHE_ORNUM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"  class="text-primary"><label><em  ab-label="VGB_SLRP_SLSRP" class="text-primary">Sales Rep ID:</em><small>&nbsp;{{x.VGB_SLRP_SLSRP}}</small><small>&nbsp;{{x.VGB_SLRP_SRNAM}}</small></label></div> ';
$xtmp->setFieldWrapper("header","0.0","","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

				?>	

			</div>

		
		</div> 
		
 	      <div id="collapse{{$index+1}}" class="panel-collapse collapse">
	
			<div class="container">

 				 <ul class="nav nav-pills">
 				 	
			

				  </ul>
			</div>	
		</div>
			      
	<?php
			echo '<div style="clear:both;"></div>';
			echo '<div exp-list="1" id="exp_{{x.idVGB_BPAR}}" class="collapse {{' . "collaps!=1?'':'in'}}" . '">';
			echo '<div class="col-sm-1 "></div>';
			echo '<div class="col-sm-3 ">';
			
				$xtmp->grAttrib["class"] = "ab-spaceless small";
				$grAttr = $xtmp->grAttrib;
				$laAttr = $xtmp->laAttrib;
				$inAttr = $xtmp->inAttrib;
				$hardCode = '<div ng-repeat="y in x.rowSet | AB_noDoubles:\'idVGB_ADDR\'">
 							       
					  <div class="small" ng-if="y.idVGB_ADDR == x.VGB_CUST_BTADD || y.idVGB_ADDR == x.VGB_SUPP_BTADD">
	                				 <label class="addr_lbl"> <em  ab-label="STD_BILL_TO" class="text-primary">Bill to:</em>&nbsp;</label>
	                				  <label class="addr_cnt">
					                 <span><small>{{y.VGB_ADDR_ADNAM}}</small></span>
					              	
					                 <span ng-if="y.VGB_ADDR_ADD01"><br><small>{{y.VGB_ADDR_ADD01}}</small></span>
					              
					                 <span ng-if="y.VGB_ADDR_ADD02"><br><small>{{y.VGB_ADDR_ADD02}}</small></span>
					              
					                 <span ng-if="y.VGB_ADDR_CITYN || y.VGB_ADDR_POSTC || y.VGB_PRST_DESCR"><br><small>
					                 <span class="ng-binding ng-scope" ng-if="y.VGB_ADDR_CITYN">{{y.VGB_ADDR_CITYN}},&nbsp;</span>
					                 <span class="ng-binding ng-scope" ng-if="y.VGB_ADDR_POSTC">{{y.VGB_ADDR_POSTC}},&nbsp;</span>
					                 <span class="ng-binding ng-scope" ng-if="y.VGB_PRST_DESCR">{{y.VGB_PRST_DESCR}}</span>					                 
					                 </small></span>
					                 
					                 <span ng-if="y.VGB_ADDR_TEL01"><br><small>{{y.VGB_ADDR_TEL01}}</small></span>
					              
					                 <span ng-if="y.VGB_ADDR_EMAIL"><br><small>{{y.VGB_ADDR_EMAIL}}</small></span>
					              </label>
	              </div>
	              
						       </div>
						       <div ng-repeat="y in x.rowSet | AB_noDoubles:\'idVGB_ADDR\'">
 						 
		           <div class="small" ng-if="y.idVGB_ADDR == x.VGB_CUST_BTADD || y.idVGB_ADDR == x.VGB_SUPP_STADD">
		           <label class="addr_lbl"><em ab-label="STD_SHIP_TO" class="text-primary">Ship to:</em>&nbsp;</label>
		             <label class="addr_cnt"><span><small>{{y.VGB_ADDR_ADNAM}}</small></span>
					              	
					                 <span ng-if="y.VGB_ADDR_ADD01"><br><small>{{y.VGB_ADDR_ADD01}}</small></span>
					              
					                 <span ng-if="y.VGB_ADDR_ADD02"><br><small>{{y.VGB_ADDR_ADD02}}</small></span>
					              
					                 <span ng-if="y.VGB_ADDR_CITYN || y.VGB_ADDR_POSTC || y.VGB_PRST_DESCR"><br><small>
					                 <span class="ng-binding ng-scope" ng-if="y.VGB_ADDR_CITYN">{{y.VGB_ADDR_CITYN}},&nbsp;</span>
					                 <span class="ng-binding ng-scope" ng-if="y.VGB_ADDR_POSTC">{{y.VGB_ADDR_POSTC}},&nbsp;</span>
					                 <span class="ng-binding ng-scope" ng-if="y.VGB_PRST_DESCR">{{y.VGB_PRST_DESCR}}</span>
					                 </small></span>
					              
					                 <span ng-if="y.VGB_ADDR_TEL01"><br><small>{{y.VGB_ADDR_TEL01}}</small></span>
					              
					                 <span ng-if="y.VGB_ADDR_EMAIL"><br><small>{{y.VGB_ADDR_EMAIL}}</small></span>
					              </label>
		           </div>
		            
						       </div>';
				$xtmp->setFieldWrapper("toggle","2.1","vgb_cust","","",$grAttr,$laAttr,$inAttr,$hardCode);
				echo $xtmp->currHtml;
				echo '</div>';
				echo '<div class="col-sm-3">';
					
				$xtmp->grAttrib["class"] = "ab-spaceless small";
				$grAttr = $xtmp->grAttrib;
				$laAttr = $xtmp->laAttrib;
				$inAttr = $xtmp->inAttrib;
				$hardCode = '<div ng-repeat="y in x.rowSet | AB_noDoubles:\'idVGB_ADDR\'">
 						 
		           <div class="small" ng-if="y.idVGB_ADDR == x.VGB_CUST_BKADD">
		           <label class="addr_lbl"><em ab-label="" class="text-primary">Address:</em>&nbsp;</label>
		             <label class="addr_cnt"><span><small>{{y.VGB_ADDR_ADNAM}}</small></span>
					              	
					                 <span ng-if="y.VGB_ADDR_ADD01"><br><small>{{y.VGB_ADDR_ADD01}}</small></span>
					              
					                 <span ng-if="y.VGB_ADDR_ADD02"><br><small>{{y.VGB_ADDR_ADD02}}</small></span>
					              
					                 <span ng-if="y.VGB_ADDR_CITYN || y.VGB_ADDR_POSTC || y.VGB_PRST_DESCR"><br><small>
					                 <span class="ng-binding ng-scope" ng-if="y.VGB_ADDR_CITYN">{{y.VGB_ADDR_CITYN}},&nbsp;</span>
					                 <span class="ng-binding ng-scope" ng-if="y.VGB_ADDR_POSTC">{{y.VGB_ADDR_POSTC}},&nbsp;</span>
					                 <span class="ng-binding ng-scope" ng-if="y.VGB_PRST_DESCR">{{y.VGB_PRST_DESCR}}</span>
					                 </small></span>
					              
					                 <span ng-if="y.VGB_ADDR_TEL01"><br><small>{{y.VGB_ADDR_TEL01}}</small></span>
					              
					                 <span ng-if="y.VGB_ADDR_EMAIL"><br><small>{{y.VGB_ADDR_EMAIL}}</small></span>
					              </label>
		           </div>
		            
						       </div>';
				$xtmp->setFieldWrapper("toggle","2.1","vgb_cust","","",$grAttr,$laAttr,$inAttr,$hardCode);
				echo $xtmp->currHtml;
			echo '</div>';
			
			
			
			/* Left side VGB_PARTNERS data Section start */
			
			echo '<div class="col-sm-5">';
			?>
			<div class="hidden{{ tbData=='vgb_cust'?'xxx':''}}">
			<?php

 // VSL_ORHE_CURID
$xtmp->grAttrib["class"] = "ab-spaceless small";
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div ng-repeat="y in vsl_orhe | AB_noDoubles:\'idVGB_CURR\'"><div class="small" ng-if="y.idVGB_CURR == x.VSL_ORHE_CURID"><label><em  ab-label="STD_CURRENCY" class="text-primary">Currency:</em><small>&nbsp;{{y.VGB_CURR_CURID}} {{ y.VGB_CURR_DESCR}}</small></label></div></div>
             <div class="small"><label><em  ab-label="VIN_ITEM_CFCAT" class="text-primary">C of C Attached :</em><small>&nbsp;{{x.VSL_ORHE_CFCAT === "1" ? "Yes" : "No"}} </small></label></div>';
$xtmp->setFieldWrapper("toggle","2.1","vsl_orhe","x.VSL_ORHE_CURID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

echo '</div>
     <div style="clear:both;"></div>
     </div>';

/* Left side VSL_ORHE data Section End */

/* Right side VSL_ORDE data Section Start */
echo '<div class="col-sm-6">';

 echo '<table class="table table-condensed ab-spaceless" width="95%;">
      	 <tr>
				<td><label class="small"></label></td>  
				<td><label class="small"><em  ab-label="VSL_ORHE_ORNUM" class="text-primary">Order No.#</em></label></td>  
				<td><label class="small"><em  ab-label="VSL_ORHE_CUSPO" class="text-primary">Purchase Order</em></label></td>
				<td><label class="small"><em  ab-label="VSL_ORHE_ODATE" class="text-primary">Order Date </em></label></td>
			 </tr>';
       	
        echo '<tr class="ab-spaceless" ng-repeat="k in x.rowSet | AB_noDoubles:\'idVSL_ORHE\'">';
        echo '<td class="small"><label>{{k.VSL_ORDE_ORLIN}}</label></td>';
echo '<td  class="ab-spaceless">';
$hardCode = '<span class="ab-spaceless"><label class="small">&nbsp;{{y.VSL_ORHE_ORNUM}}</label></span>';
echo $hardCode;
echo  '</td><td  class="ab-spaceless"><span style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{x.idVGB_BPAR}}" class="btn-link glyphicon glyphicon-th-list"></span></td><td  class="ab-spaceless">';

// VSL_ORHE ORDER ID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div><div class="small"><label>&nbsp;{{y.VSL_ORHE_CUSPO}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vsl_orhe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td  class="ab-spaceless">';

 // VSL_ORHE PURCHASE ORDER
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label><small>&nbsp;{{k.VSL_ORHE_ODATE}}</small></label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vsl_orhe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td  class="ab-spaceless">';

 // VSL_ORHE_CDATE
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label><small>&nbsp;{{k.VSL_ORDE_DDATE}}</small></label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vsl_orhe","k.VSL_ORDE_DDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td></tr></table>';
echo '</div>';

echo '</div>
      <div style="clear:both;"></div>';

			?></div>
			<div class="hidden{{ tbData=='vgb_supp'?'xxx':''}}">
			<?php
				$xtmp->grAttrib["class"] = "ab-spaceless small";
				$grAttr = $xtmp->grAttrib;
				$laAttr = $xtmp->laAttrib;
				$inAttr = $xtmp->inAttrib;
				$hardCode = '<div>
									  <div class="small">
					                 <label><em  ab-label="" class="text-primary">Order #:</em>&nbsp;<small>{{x.VPU_ORHE_ORNUM}}</small></label>
					              </div>
				                 <div class="small">
					                 <label><em  ab-label="" class="text-primary">PO:</em>&nbsp;<small>{{x.VPU_ORHE_CUSPO}}</small></label>
					              </div>
					              <div class="small">
					                 <label><em  ab-label="" class="text-primary">Date:</em>&nbsp;<small>{{x.VPU_ORHE_ODATE}}</small></label>
					              </div>
						       </div>';
				$xtmp->setFieldWrapper("toggle","2.1","vgb_cust","","",$grAttr,$laAttr,$inAttr,$hardCode);
				echo $xtmp->currHtml;
			?>			
			</div>
			<?php
			echo '</div>';
	?>
	</td>
	</tr>

	</table>   
  </div>

</div>

<table class="table table-condensed " >

	  <tr class="ab-spaceless">
	  	<td>
	  
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vgb_bpar'?'vgb_bpar':'Yes'}}"
			class="hidden{{ tbData=='vgb_bpar'?'xxx':''}} text-primary" >
			      	<span class="btn-sm glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="ABnextSet('#vgb_bpar_pg','vgb_bpar','abl-first','VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',-1)"  > </span>
			      	<span class="btn-sm glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="ABnextSet('#vgb_bpar_pg','vgb_bpar','abl-last','VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',1)"  > </span>
			</span>
			<span ab-empty="{{tbData=='vgb_cust'?'vgb_cust':'Yes'}}"
			class="hidden{{ tbData=='vgb_cust'?'xxx':''}} text-primary" >
			      	<span class="btn-sm glyphicon glyphicon-backward " src="stdImages/buttons/A_Previous.png"  ng-click="ABnextSet('#vgb_bpar_pg','vgb_bpar','abl-first','VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_cust',-1)"> </span>
			      	<span class="btn-sm glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"   ng-click="ABnextSet('#vgb_bpar_pg','vgb_bpar','abl-last','VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_cust',1)" > </span>
			      	
			</span>
			<span ab-empty="{{tbData=='vgb_supp'?'vgb_supp':'Yes'}}"
			class="hidden{{ tbData=='vgb_supp'?'xxx':''}} text-primary" >
			      	<span class="btn-sm glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png"   ng-click="ABnextSet('#vgb_bpar_pg','vgb_bpar','abl-first','VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_supp',-1)" > </span>
			      	<span class="btn-sm glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png" ng-click="ABnextSet('#vgb_bpar_pg','vgb_bpar','abl-last','VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_supp',1)"  > </span>
			</span>			
			<span id="vgb_bpar_pg" class="text-danger hidden" ab-label="STD_ENDOFFILE">End of records</span>
		</td>
	</tr>
	<tr>		  
	  	<td> 
		  <div class="visible-lg">
			&nbsp;
			<span ng-repeat="org in AB_DUSA.orgLevels |AB_Selected:AB_DUSA.usrLevels.CurrentAffect:'levelId' " class=" {{org.isSelected}} " >{{org.levelDescr}}</span>	
			
		  <div>
	  	</td>
	  </tr>
</table>	

</div>


</div>
<div class='btn-sm ab-body-buttons hidden' >

		{{ message }}
		<span ab-empty="{{tbData=='vgb_bpar'?'vgb_bpar':'Yes'}}" >All Partners</span>
		<span ab-empty="{{tbData=='vgb_cust'?'vgb_cust':'Yes'}}" >Customers</span>
		<span ab-empty="{{tbData=='vgb_supp'?'vgb_supp':'Yes'}}" >Suppliers</span>

		<span class='hidden'>

		
		Records per page:&nbsp;
		<select class='text-muted' ab-mpp onchange="getMaxPerPage();" value="100" >
		  <option value="10">10</option>
		  <option value="20" >20</option>
		  <option value="40"  >40</option>
		  <option value="100" selected >100</option>
		</select>

		</span>

</div>
<script>

function collapseall(dir)
{
		
	$("[exp-list]").each(function()
	{
		if ($(this).hasClass("in"))
		{
			if (dir==0)
			{
				$("[data-target='#" + $(this).attr("id") + "']").click();
				
			}
		}
		else
		{
			if (dir==1)
			{
				$("[data-target='#" + $(this).attr("id") + "']").click();
				
			}
		}
		
	});
	
	
}
</script>
<style type="text/css">
.addr_cnt
{
	vertical-align: top;
	min-width: 75%;
}
.addr_lbl
{
	vertical-align: top;
	min-width: 19%;
}
</style>
