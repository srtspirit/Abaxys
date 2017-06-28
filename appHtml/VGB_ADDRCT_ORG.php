
<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>

		



<div class="row mygrid-wrapper-div ab-border" >

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


	<form id="mainForm" name="mainForm"  ab-view="vgb_addr" ab-main="vgb_addr"  >
<!--
ab-main="vgb_cntr" mandatory
Instructs update process main table to update
-->
		<div class="{{idVGB_BPAR!=0?'hidden':''}} collps-on ">
<?php require_once "../appHtml/VGB_ADDRCT-TMPL.php"; ?>	
		</div>	
		<div class="row collps {{idVGB_BPAR!=0?'':'hidden'}} ">
			<div class="col-sm-1">
			</div>
			<div class="col-sm-2 text-primary">
				<span class="btn-md ab-pointer glyphicon glyphicon-th-list" onclick="$('[fxVGB_BPAR_ADDID]').toggleClass('hidden');" ondblclick="$('[fxVGB_BPAR_ADDID]').addClass('hidden');" title=""></span>				

				<label class="btn-md {{opts.Session=='VGB_CUSTCT'?'':'hidden'}}" ab-label="VGB_CUST_BPART">Partner</label>
				
				<label class="btn-md {{opts.Session=='VGB_SUPPCT'?'':'hidden'}}" ab-label="VGB_SUPP_BPART">Partner</label>			
			</div>
			<div class="col-sm-9 text-primary">
					<label>{{ VGB_BPAR_BPART }}</label>&nbsp;&nbsp;-&nbsp;
					<label {{opts.Session!='VGB_SUPPCT'?'':'hidden'}} >{{VGB_CUST_BPNAM}}</label>
					<label {{opts.Session=='VGB_SUPPCT'?'':'hidden'}} >{{VGB_SUPP_BPNAM}}</label>
			</div>
	
			<div class="col-sm-12">
	
				<table class="table ">
					<tr class="ab-border" >
						<td>

							<div class="row">
								<div class="col-sm-1">
									&nbsp;
									<a ng-click="flipHidden('.collps',true);flipHidden('.collps-on',false);ABupdChkObj('idVGB_ADDR',0,true);ABchk(null,'vgb_addr');" >
			 				 			
										<span >New</span>
										<span  class="ab-pointer glyphicon glyphicon-pencil" ></span>
										
									</a>
								</div>
								<div class="col-sm-1">	
									<label  ab-label="STD_ID_CODE"></label>									
								</div>	
								<div class="col-sm-3">
									<label  ab-label="VGB_CNTR_DESCR"></label>
								</div>	
								<div class="col-sm-4">
									<label  ab-label="STD_ADDRESS"></label>
								
								</div>
								
							
							</div>
						</td>	
					</tr>	
					<tr ng-repeat="xx in VGB_ADDRCT | AB_noDoubles:'idVGB_ADDR' " class="collps {{xx.idVGB_ADDR!=idVGB_ADDR?'':'ab-active'}}">
						<td > 
							<div class="row">
								<div class="col-sm-1">
									&nbsp;
			 				 		<a  ng-click="flipHidden('.collps',true);flipHidden('.collps-on',false);ABupdChkObj('idVGB_ADDR',xx.idVGB_ADDR,true);ABchk(null,'vgb_addr');supportTBL();" >
			 				 		
										<span class="ab-pointer" ab-label="STD_EDIT" >Edit</span>
										<span  class="ab-pointer glyphicon glyphicon-pencil" ></span>
										
									</a>
								</div>	

								<div class="col-sm-1">
									<span class="btn-xs ab-pointer glyphicon glyphicon-th-list" vval="{{xx.VGB_ADDR_ADDID}}" onclick="$('#fxVGB_BPAR_ADDID'+$(this).attr('vval')).toggleClass('hidden');" title=""></span>	
									{{xx.VGB_ADDR_ADDID}}
								</div>					
			

									
								<div class="col-sm-3">
									{{xx.VGB_ADDR_DESCR}}
								</div>	
								<div class="col-sm-4">
									{{xx.VGB_ADDR_ADNAM}}
								
								</div>
								<div class="col-sm-3">								
									<table style="width:100%;" >
										<tr>
											<td style="width:35%;">
												<label ab-label="VGB_ADDR_CONT1">Contact</label>
											</td>
											<td style="width:65%;">
												{{xx.VGB_ADDR_CONT1}}
											</td>
										</tr>
									</table>
								</div>	

							</div>
							<div fxVGB_BPAR_ADDID="" id="fxVGB_BPAR_ADDID{{xx.VGB_ADDR_ADDID}}" class="row hidden"  style="vertical-align:top;">
								<div class="col-sm-1">
								</div>	
								<div class="col-sm-1">
								</div>	
								<div class="col-sm-3">
								</div>	
								<div class="col-sm-4">
									{{xx.VGB_ADDR_ADD01}}<br>
									{{xx.VGB_ADDR_ADD02}}<br>
									{{xx.VGB_ADDR_CITYN}},&nbsp;
									<span ng-repeat="yy in vgb_prst | AB_noDoubles:'idVGB_PRST'" class="{{yy.idVGB_PRST==xx.idVGB_PRST?'':'hidden'}}">
										{{ yy.VGB_PRST_DESCR }}
									</span>
									,&nbsp;{{xx.VGB_ADDR_POSTC}}
								</div>
								<div class="col-sm-3" >
									<table style="width:100%;" >
										<tr>
											<td style="width:35%;">
												<label ab-label="VGB_ADDR_TEL01">Tel.</label>
											</td>
											<td style="width:65%;">
											{{xx.VGB_ADDR_TEL01}}
												
											</td>
										</tr>
										<tr>
											<td>
												<label ab-label="VGB_ADDR_EMAIL">Email</label>
											</td>
											<td>
												{{xx.VGB_ADDR_EMAIL}}
											</td>
										</tr>
									</table>
								</div>
							</div>
						</td>		
					</tr>
				</table>				
	
			</div>
		</div>

	</form>

</div>	
