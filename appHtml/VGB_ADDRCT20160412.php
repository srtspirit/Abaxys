<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>


<div class="row mygrid-wrapper-div " >

<!--
Angular data-ng-init - Optional but needed
If present will execute the $scope functions

-->


<textarea class="hidden" ab-updSuccess="" >
$scope.flipHidden('.collps',false);
$scope.flipHidden('.collps-on',true);
</textarea>
<!--
Attribute ab-updSuccess - Optional
If present and ABupd is successfull
ABupd() will execute (eval) the value of the object

Note that $scope needs to be in the code as opposed to data-ng-init= above
-->


	<form id="mainForm" name="mainForm"  ab-view="vgb_addr" ab-main="vgb_addr" ab-context="0" >
<!--
ab-main="vgb_cntr" mandatory
Instructs update process main table to update
-->



		<div class="row {{idVGB_BPAR>0?'hidden':''}} collps-on ">

			<div class="col-sm-3">
			
				<table class="table-condensed">
					<tr>
						<td></td>
							
						<td></td>
					</tr>
					<tr>
						<td colspan=2 style=""  >
							<span  data-dismiss="modal"  ab-menu="{{opts.Session=='VGB_CUSTCT'?'vgb_cust':'vgb_supp'}}" ng-click="ABContext('vgb_cust',-1);" name="mainForm" class="ab-pointer btn-primary text-primary">&nbsp;
								<span class="glyphicon glyphicon-backward"></span>&nbsp;
								<span ab-label="{{opts.Session=='VGB_CUSTCT'?'VGB_CUSTCT':'VGB_SUPPCT'}}"></span>&nbsp;
								
							</span>
						<td>
					</tr>
					<tr>
						<td></td>
						<td>	
							<span data-dismiss="modal"  class="ab-pointer btn-primary text-primary  {{idVGB_BPAR>0?'':'hidden'}}" ng-click="flipHidden('.collps',false);flipHidden('.collps-on',true);ABContext('vgb_addr',0);">&nbsp;
								<span class="glyphicon glyphicon-backward"></span>&nbsp;
								<span ab-label="STD_LIST">Address List</span>&nbsp;
							</span>
						</td>
					</tr>
				</table>

			</div>
			<div class="col-sm-9">

<?php		
$xtmp = new appForm("VGB_ADDRCT");
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "{{opts.Session=='VGB_CUSTCT'?'VGB_CUST_BPART':'VGB_SUPP_BPART'}}"; 
$inAttr = $xtmp->inAttrib;
$hardCode = "<label>{{ VGB_BPAR_BPART }}</label>&nbsp;&nbsp;-&nbsp;<label {{opts.Session!='VGB_SUPPCT'?'':'hidden'}} >{{VGB_CUST_BPNAM}}</label><label {{opts.Session=='VGB_SUPPCT'?'':'hidden'}} >{{VGB_SUPP_BPNAM}}</label>";
$xtmp->setFieldWrapper("view01","1.01","vgb_bpar","VGB_BPAR_BPART","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>
			</div>

			<div class="col-sm-2">

			</div>
			<div class="col-sm-10">
			</div>
	
			<div class="col-sm-12">
			
<?php require_once "../appHtml/VGB_ADDRCT-TMPL.php"; ?>	

			</div>	
		</div>
		<div class="row collps {{idVGB_BPAR>0?'':'hidden'}} ">

			<div class="col-sm-2">

<!--
				<span  ab-menu="{{opts.Session=='VGB_CUSTCT'?'vgb_cust':'vgb_supp'}}" name="mainForm" class="ab-pointer btn-primary text-primary">&nbsp;
					<span class="glyphicon glyphicon-backward"></span>&nbsp;
					<span ab-label="{{opts.Session=='VGB_CUSTCT'?'VGB_CUSTCT':'VGB_SUPPCT'}}"></span>&nbsp;
					
				</span>

				<span  ab-menu="vgb_supp" name="mainForm" class="ab-pointer btn-primary text-primary">&nbsp;

					<span class="glyphicon glyphicon-backward"></span>&nbsp;
					<span ab-label="VGB_SUPPCT">Supplier</span>&nbsp;</small> 
					
				</span>
-->				
			</div>
			<div class="col-sm-10">
<!--
<?php		

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "{{opts.Session=='VGB_CUSTCT'?'VGB_CUST_BPART':'VGB_SUPP_BPART'}}"; 
$inAttr = $xtmp->inAttrib;
$hardCode = "<label>{{ VGB_BPAR_BPART }}</label>&nbsp;&nbsp;-&nbsp;<label {{opts.Session!='VGB_SUPPCT'?'':'hidden'}} >{{VGB_CUST_BPNAM}}</label><label {{opts.Session=='VGB_SUPPCT'?'':'hidden'}} >{{VGB_SUPP_BPNAM}}</label>";
$xtmp->setFieldWrapper("view01","1.01","vgb_bpar","VGB_BPAR_BPART","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>
-->			</div>
		
			<div class="col-sm-2">
				<a data-dismiss="modal" ng-click="flipHidden('.collps',true);flipHidden('.collps-on',false);ABContext('vgb_addr',1);setNewAddId();" >
					
					<span class="glyphicon glyphicon-pencil ab-pointer text-primary" ></span>
					<span ab-label="STD_NEW" >New</span>
				</a>
			
			</div>
			<div class="col-sm-2 text-primary">
				<span class="btn-md ab-pointer glyphicon glyphicon-th-list" onclick="$('[fxVGB_BPAR_ADDID]').toggleClass('hidden');" ondblclick="$('[fxVGB_BPAR_ADDID]').addClass('hidden');" title=""></span>				

				<label class="btn-md " ab-label="STD_DRILL">Partner</label>

			</div>
			<div class="col-sm-8 text-primary">
			</div>
	
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-2">	
						&nbsp;&nbsp;
						<label  ab-label="STD_ID_CODE"></label>	
					
																										
					</div>	
					<div class="col-sm-4">
							<label  ab-label="STD_ADDRESS"></label>
								
					</div>
					<div class="col-sm-6">
						<label  ab-label="STD_CONTACT">Contact</label>
					</div>
								
							
				</div>
					
				<div class="row" ng-repeat="xx in VGB_ADDRCT " >
					<div class="col-sm-2 small" >
						&nbsp;
 				 		<a data-dismiss="modal" ng-click="flipHidden('.collps',true);flipHidden('.collps-on',false);ABContext('vgb_addr',1);ABupdChkObj('idVGB_ADDR',xx.idVGB_ADDR,true);ABchk(null,'vgb_addr');supportTBL();" >
							<span  class="ab-pointer glyphicon glyphicon-pencil" ></span>
						</a>
															
						<span class="btn-xs ab-pointer glyphicon glyphicon-th-list" vval="{{xx.VGB_ADDR_ADDID}}" onclick="$('#fxVGB_BPAR_ADDID'+$(this).attr('vval')).toggleClass('hidden');" title=""></span>	
						{{xx.VGB_ADDR_ADDID}}
						&nbsp;&nbsp;

					</div>
						
					<div class="col-sm-4">
						{{xx.VGB_ADDR_DESCR}}
					</div>	
					<div class="col-sm-6 small">								
						<label >{{xx.VGB_ADDR_CONT1}}</label>
						<span class="small" ng-if="xx.VGB_ADDR_TEL01.length>0" > 
						<label class="text-primary small" ab-label="VGB_ADDR_TEL01">Tel.</label>
						{{xx.VGB_ADDR_TEL01}} 
						</span>

					</div>	
					


				</div>
				<div fxVGB_BPAR_ADDID="" id="fxVGB_BPAR_ADDID{{xx.VGB_ADDR_ADDID}}" class="row hidden"  style="vertical-align:top;">
					<div class="col-sm-2">
					</div>	
					<div class="col-sm-2 small">
					<label>
						{{xx.VGB_ADDR_ADNAM}}<br>
						{{xx.VGB_ADDR_ADD01}}<br>
						{{xx.VGB_ADDR_ADD02}}
						{{xx.VGB_ADDR_CITYN}},&nbsp;
						<span ng-repeat="yy in vgb_prst | AB_noDoubles:'idVGB_PRST'" class="{{yy.idVGB_PRST==xx.idVGB_PRST?'':'hidden'}}">
							{{ yy.VGB_PRST_DESCR }}
						</span>
						,&nbsp;{{xx.VGB_ADDR_POSTC}}
					</label>	
					</div>
					<div class="col-sm-2 small" >
						<table >
							<tr ng-if="xx.VGB_ADDR_FAX01.length > 0" >
								<td>
									<label class="text-primary small" ab-label="VGB_ADDR_TEL01">Tel.</label>
								</td>
								<td>&nbsp;&nbsp;</td>
								<td >
								{{xx.VGB_ADDR_FAX01}}	
								</td>
							</tr>
							<tr ng-if="xx.VGB_ADDR_EMAIL.length>0" >
								<td>
									<label class="text-primary small" ab-label="VGB_ADDR_EMAIL">Email</label>
								</td>
								<td>&nbsp;&nbsp;</td>
								<td>
									{{xx.VGB_ADDR_EMAIL}}
								</td>
							</tr>
						</table>
					</div>
					<div class="col-sm-2 small" >
						<table >
							<tr ng-if="xx.VGB_ADDR_TEL02.length + xx.VGB_ADDR_FAX02.length > 0">
								<td >
									<label class="text-primary small" ab-label="VGB_ADDR_TEL01">Tel.</label>
								</td>
								<td>&nbsp;&nbsp;</td>
								<td >
								{{xx.VGB_ADDR_TEL02}}<br>
								{{xx.VGB_ADDR_FAX02}}
									
								</td>
							</tr>
							<tr ng-if="xx.VGB_ADDR_TAXEX.length>0" >
								<td>
									<label class="text-primary small" ab-label="VGB_ADDR_EMAIL">Email</label>
								</td>
								<td>&nbsp;&nbsp;</td>
								<td>
									{{xx.VGB_ADDR_TAXEX}}
								</td>
							</tr>
						</table>
					</div>								
				</div>
			</div>					

								
			</div>
		</div>

	</form>

</div>	
