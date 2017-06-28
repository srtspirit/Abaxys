<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>



<div class="row  "  >

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

<!--
	<form id="mainForm" name="mainForm"  ab-view="vgb_addr" ab-main="vgb_addr" ab-context="0" >

ab-main="vgb_cntr" mandatory
Instructs update process main table to update
-->

		<div class="row ">

			<div class="col-sm-3 bg-primary">
				Postal Addresses
			</div>
		</div>		
			

		<div class="row {{idVGB_BPAR>0?'hidden':''}} collps-on ">

			<div class="col-sm-4">
			
				<span data-dismiss="modal"  class="ab-pointer btn-primary text-primary  {{idVGB_BPAR>0?'':'hidden'}}" ng-click="flipHidden('.collps',false);flipHidden('.collps-on',true);ABContext('vgb_addr',0);">&nbsp;
					<span class="glyphicon glyphicon-backward"></span>&nbsp;
					<span ab-label="STD_LIST">Address List</span>&nbsp;
				</span>

			</div>
			<div id="local-sysOpt" class="col-sm-8 {{idVGB_BPAR>0?'':'hidden'}}" >
			
				<span ng-if="idVGB_ADDR>0" >
					<span ng-if="rightsAddr.Upd>0" class="glyphicon glyphicon-floppy-disk ab-pointer text-primary"
					ng-if="idVGB_ADDR>0" ng-click="addrABupd('UPDATE');" type="button" 
					value="Save" 
					></span>
					&nbsp;&nbsp;
					<span ng-if="rightsAddr.Del>0" class="glyphicon glyphicon-trash ab-pointer text-primary"
					ng-if="idVGB_ADDR>0" ng-click="addrABupd('DELETE');" type="button" value="Delete"
					></span>
				</span>
				
				<span class="btn-link ab-pointer text-primary" ng-if="idVGB_ADDR<1"  ng-click="addrABupd('CREATE');" type="button" value="Create" >
					<span class="text-primary" ab-label="STD_NEW" >Add</span> 
					<span class="glyphicon glyphicon-floppy-disk"></span>
				</span>
				
			</div>

	
			<div class="col-sm-12 ">
			
				<?php require_once "../appHtml/VGB_ADDRCT-TMPL.php"; ?>	

			</div>	
			
		</div>
		<div class="row collps {{idVGB_BPAR>0?'':'hidden'}} ">

			<div class="col-sm-2 ">
				
			</div>
			<div class="col-sm-10">
			</div>
		
			<div class="col-sm-2">
				<a data-dismiss="modal" ng-if="rightsAddr.new>0" 
				ng-click="flipHidden('.collps',true);flipHidden('.collps-on',false);ABContext('vgb_addr',1);setNewAddId();" >
					
					<span class="glyphicon glyphicon-pencil ab-pointer text-primary" ></span>
					<span ab-label="STD_NEW" >New</span>
				</a>
			
			</div>
			<div class="col-sm-2 text-primary">
				
				<a flopen="1" 
				onclick="
				if($(this).attr('flopen')!=1)
				{
					$('[fxVGB_BPAR_ADDID]').addClass('hidden');
				}
				else
				{
					$('[fxVGB_BPAR_ADDID]').removeClass('hidden');
				}
				
				$(this).attr('flopen',1-$(this).attr('flopen'));
				
				"  >
					<span class="btn-md ab-pointer glyphicon glyphicon-th-list" ></span>				
					<label class="btn-md " ab-label="STD_DRILL">Partner</label>
				</a>	

			</div>
			<div class="col-sm-8 text-primary">
			</div>
	
			<div class="col-sm-12 ab-wrapper-div">
				<div class="row">
					<div class="col-sm-3">	
						&nbsp;&nbsp;
						<label  ab-label="STD_ID_CODE"></label>	
					
																										
					</div>	
					<div class="col-sm-3">
							<label  ab-label="STD_ADDRESS"></label>
								
					</div>
					<div class="col-sm-6">
						<label  ab-label="STD_CONTACT">Contact</label>
					</div>
								
							
				</div>
					
				<div class="row " ng-repeat="xx in VGB_ADDRCT  | AB_noDoubles:'idVGB_ADDR'" >
				
					<div class="col-sm-3 small " >
						<table >
							<tr>
								<td>
						&nbsp;
 				 		<a data-dismiss="modal" class="ab-pointer small" ng-if="rightsAddr.hasRights>0" 
 				 		ng-click="flipHidden('.collps',true);flipHidden('.collps-on',false);ABContext('vgb_addr',1);ABupdChkObj('idVGB_ADDR',xx.idVGB_ADDR,true);ABchk(null,'vgb_addr');supportTBL();" >
 				 			Edit
							<span  class="glyphicon glyphicon-pencil" ></span>
						</a>
															
						<span class="btn-xs ab-pointer glyphicon glyphicon-th-list" vval="{{xx.VGB_ADDR_ADDID}}" onclick="$('#fxVGB_BPAR_ADDID'+$(this).attr('vval')).toggleClass('hidden');" title=""></span>	
						{{xx.VGB_ADDR_ADDID}}
						&nbsp;&nbsp;
								</td>
								<td style="min-width:50px;" class="text-right" >
						<span class="text-primary small" ng-if="idVGB_CUST>0" >
							<span class="small" >Bill</span>
		        				<span class="glyphicon glyphicon-ok" ng-if="xx.idVGB_ADDR==VGB_CUST_BTADD" ></span>
		        				<span class="glyphicon glyphicon-unchecked ab-pointer"  rval='{{xx.idVGB_ADDR}}' ng-if="xx.idVGB_ADDR!=VGB_CUST_BTADD" onclick="deflectVal($(this).attr('rval'),'VGB_CUST_BTADD');" ></span>        
		        				&nbsp;
							<span class="small" >Ship</span>
		        				<span class="glyphicon glyphicon-ok" ng-if="xx.idVGB_ADDR==VGB_CUST_STADD" ></span>
		        				<span class="glyphicon glyphicon-unchecked ab-pointer" rval='{{xx.idVGB_ADDR}}' ng-if="xx.idVGB_ADDR!=VGB_CUST_STADD" onclick="deflectVal($(this).attr('rval'),'VGB_CUST_STADD');" name="stcust" ></span>
		        			</span>
						<span class="text-primary small" ng-if="idVGB_SUPP>0" >
							<span class="small" >Pay</span>
		        				<span class="glyphicon glyphicon-ok" ng-if="xx.idVGB_ADDR==VGB_SUPP_BTADD" ></span>
		        				<span class="glyphicon glyphicon-unchecked ab-pointer"  rval='{{xx.idVGB_ADDR}}' ng-if="xx.idVGB_ADDR!=VGB_SUPP_BTADD" onclick="deflectVal($(this).attr('rval'),'VGB_SUPP_BTADD');" ></span>        
		        				&nbsp;
							<span class="small" >Ship</span>
		        				<span class="glyphicon glyphicon-ok" ng-if="xx.idVGB_ADDR==VGB_SUPP_STADD" ></span>
		        				<span class="glyphicon glyphicon-unchecked ab-pointer" rval='{{xx.idVGB_ADDR}}' ng-if="xx.idVGB_ADDR!=VGB_SUPP_STADD" onclick="deflectVal($(this).attr('rval'),'VGB_SUPP_STADD');" name="stcust" ></span>
		        			</span>

		        					</td>
		        				</tr>
		        			</table>

					</div>
						
					<div class="col-sm-3">
						{{xx.VGB_ADDR_DESCR}}
					</div>	
					<div class="col-sm-5 small">								
						<label >{{xx.VGB_ADDR_CONT1}}</label>
						<span class="small" ng-if="xx.VGB_ADDR_TEL01.length>0" > 
						<label class="text-primary small" ab-label="VGB_ADDR_TEL01">Tel.</label>
						{{xx.VGB_ADDR_TEL01}} 
						</span>

					</div>	
					

					<div class="col-sm-12">
				
						<div fxVGB_BPAR_ADDID="" id="fxVGB_BPAR_ADDID{{xx.VGB_ADDR_ADDID}}" class="row hidden"  style="vertical-align:top;">
							<div class="col-sm-2">
							</div>	
							<div class="col-sm-4 small">
							<label>
								{{xx.VGB_ADDR_ADNAM}}<br>
								{{xx.VGB_ADDR_ADD01}}<br>
								{{xx.VGB_ADDR_ADD02}}
								{{xx.VGB_ADDR_CITYN}} &nbsp;
								<span ng-repeat="yy in vgb_prst | AB_noDoubles:'idVGB_PRST'" class="{{yy.idVGB_PRST==xx.idVGB_PRST?'':'hidden'}}">
									{{ yy.VGB_PRST_DESCR }}
								</span>
								 &nbsp;{{xx.VGB_ADDR_POSTC}}
							</label>	
							</div>
							<div class="col-sm-6 small" >
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
								<table >
									<tr ng-if="xx.VGB_ADDR_TEL02.length + xx.VGB_ADDR_FAX02.length > 0">
										<td >
											<label >{{xx.VGB_ADDR_CONT2}}</label><br>
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
						<div class="row">				
							<div class="col-sm-1 " >
							</div>
							<div class="col-sm-11 bg-primary" style="font-size:2pt;">
							</div>

						</div>
						
					</div>
					
				</div>					
			
			</div>
		</div>

<!--	</form> -->

</div>	
