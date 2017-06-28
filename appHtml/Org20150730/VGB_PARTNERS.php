<?php

ini_set('display_errors', 0);
session_start();
ob_clean();


		



include "../appCscript/VGB_PARTNERS.php";

?>
<div class='ab-body-buttons'>

		{{ message }}&nbsp;
		<span ab-empty="{{tbData=='vgb_bpar'?'vgb_bpar':'Yes'}}" >All Partners</span>
		<span ab-empty="{{tbData=='vgb_cust'?'vgb_cust':'Yes'}}" >Customers</span>
		<span ab-empty="{{tbData=='vgb_supp'?'vgb_supp':'Yes'}}" >Suppliers</span>

		<span class='hidden'>

		
		Records per page:&nbsp;
		<select class='text-muted' ab-mpp onchange="getMaxPerPage();" value="20" >
		  <option value="10">10</option>
		  <option value="20" selected >20</option>
		  <option value="30">30</option>
		  <option value="40">40</option>
		  <option value="50">50</option>
		  <option value="60">60</option>
		  <option value="70">70</option>
		  <option value="80">80</option>
		  <option value="90">90</option>
		  <option value="100">100</option>
		</select>

		</span>

</div>


<form id="mainForm" ab-main="vgb_bpar">

<div class="row"  >
	<div class="col-sm-12" >
		<table class="table" >
			<tr>
				<td>
					<label class="btn-md" ab-label="VGB_BPAR_BPART">Business Partner</label>
					&nbsp;
					<label class="btn-md" ab-label="STD_SELECTION">Selection</label>


					
					
				</td>
				<td>
				<span ab-empty="{{tbData=='vgb_bpar'?'vgb_bpar':'Yes'}}" class="btn btn-xs btn-default" onclick="abLink(this);" href="#vgb_bparct/*/CREATE" >New Partner</span>
				<span ab-empty="{{tbData=='vgb_cust'?'vgb_cust':'Yes'}}" class="btn btn-xs btn-default" onclick="abLink(this);" href="#vgb_bparct/*/CREATE" >New Customer</span>
				<span ab-empty="{{tbData=='vgb_supp'?'vgb_supp':'Yes'}}" class="btn btn-xs btn-default" onclick="abLink(this);" href="#vgb_bparct/*/CREATE" >New Supplier</span>
			      	
				</td>
				<td>
					&nbsp;
					<label class="btn-md" ab-label="STD_SEAR">Seach</label>
					&nbsp;
	
					<span ab-empty="{{tbData=='vgb_bpar'?'vgb_bpar':'Yes'}}" 
					class="hidden{{ tbData=='vgb_bpar'?'xxx':''}}" >
						<input type="text" size=25 id="VGB_BPAR_BPART" 	value=""  ng-model="VGB_BPAR_BPART" />
						<button ng-click="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',0)" >Search Partners</button>
					</span>

					<span ab-empty="{{tbData=='vgb_cust'?'vgb_cust':'Yes'}}"
					class="hidden{{ tbData=='vgb_cust'?'xxx':''}}" >
						<input type="text" size=25 id="VGB_BPAR_BPART" 	value=""  ng-model="VGB_BPAR_BPART" />
						<button ng-click="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_cust',0)" >Search Customers</button>
					</span>
					<span ab-empty="{{tbData=='vgb_supp'?'vgb_supp':'Yes'}}"
					class="hidden{{ tbData=='vgb_supp'?'xxx':''}}" >
						<input type="text" size=25 id="VGB_BPAR_BPART" 	value=""  ng-model="VGB_BPAR_BPART" />
						<button ng-click="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_supp',0)" >Search Suppliers</button>
					</span>

					
				</td>
				<td>
					<span ab-empty="{{tbData=='vgb_bpar'?'vgb_bpar':'Yes'}}"
					class="hidden{{ tbData=='vgb_bpar'?'xxx':''}}" >
					      	<button ng-click="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',-1)" >Prev</button>
					      	<button ng-click="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',1)" >Next</button>
					</span>
					<span ab-empty="{{tbData=='vgb_cust'?'vgb_cust':'Yes'}}"
					class="hidden{{ tbData=='vgb_cust'?'xxx':''}}" >
					      	<button ng-click="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_cust',-1)" >Prev</button>
					      	<button ng-click="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_cust',1)" >Next</button>
					</span>
					<span ab-empty="{{tbData=='vgb_supp'?'vgb_supp':'Yes'}}"
					class="hidden{{ tbData=='vgb_supp'?'xxx':''}}" >
					      	<button ng-click="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_supp',-1)" >Prev</button>
					      	<button ng-click="kPress('VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_supp',1)" >Next</button>
					</span>
				</td>
			</tr>
		</table>
		<table class="table table-condensed table-striped"  >
			<thead>
			<tr >
			<th colspan=10>
			
				<div class="row">
					<div class="col-sm-3">	
					<label ab-label="VGB_BPAR_BPART">Partner</label>
					</div>
					
					<div class="col-sm-3">
					<label ab-label="STD_NAME">Name</label>
					</div>
					
					<div class="col-sm-2">
					<label ab-label="STD_ADDRESS">Address</label>
					</div>
					
					<div class="col-sm-2">
					<label ab-label="STD_CREATED">Created</label>
					</div>		
					
					<div class="col-sm-1">
					<label ab-label="VGB_CUST_BPART" class="hidden{{tbData=='vgb_bpar'?'vgb_cust':''}}">
						Customer
					</label>
					</div>
					
					<div class="col-sm-1">
						<label ab-label="VGB_SUPP_BPART"  class="hidden{{tbData=='vgb_bpar'?'vgb_supp':''}}">
							Supplier
						</label>
					</div>
					
					
				</div>
			</th>

			</tr>
	
			</thead>
		<tr>
		<td colspan=10>
		<div   class="mygrid-wrapper-div" >
		<table class="table table-condensed table-striped"  >
			
			<tbody>
			<tr  role="presentation"  ng-repeat="x in vgb_bpar">
			
			
				<td colspan=10>
				<div class="row">
					<div class="col-sm-6">			
				
						<table><tr>
							<td style='overflow:hidden;width:150px;max-width:150px;white-space:nowrap;font-size:8pt'>
									
									<span class="btn btn-xs btn-default ab-hidden{{tbData!='vgb_cust'?'':'xx'}}" 
									ab-label="STD_EDIT"
									abl-first={{$first}}
									abl-last={{$last}}
									onclick="abLink(this);" 
									value={{tbData=='vgb_bpar'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_cust'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_supp'?x.VGB_BPAR_BPART:''}}
									xxx={{tbData}}
									href="#{{opts.Process}}/VGB_CUSTCT/idVGB_BPAR:{{x.idVGB_BPAR}},updType:UPDATE,Session:VGB_CUSTCT,Process:{{opts.Process}}" >
									{{$index+1}}
										<img 	src="stdImages/buttons/A_Edit.png" width="16" height="16" 	/>
									</span>
									
									
									<span class="btn btn-xs btn-default ab-hidden{{tbData!='vgb_supp'?'':'xx'}}" 
									ab-label="STD_EDIT"
									abl-first={{$first}}
									abl-last={{$last}}
									onclick="abLink(this);" 
									value={{tbData=='vgb_bpar'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_cust'?x.VGB_BPAR_BPART:''}}{{tbData=='vgb_supp'?x.VGB_BPAR_BPART:''}}
									xxx={{tbData}}
									href="#{{opts.Process}}/VGB_SUPPCT/idVGB_BPAR:{{x.idVGB_BPAR}},updType:UPDATE,Session:VGB_SUPPCT,Process:{{opts.Process}}" >
									{{$index+1}}
										<img 	src="stdImages/buttons/A_Edit.png" width="16" height="16" 	/>
									</span>
									
									
					
								{{x.VGB_BPAR_BPART}}
							</td>
							<td>		
									&nbsp;&nbsp;-&nbsp;
					
									<span class="hidden{{tbData=='vgb_bpar'?'yes':''}}" >
									{{x.VGB_BPAR_BPNAM}}
									</span>
									<span class="hidden{{tbData=='vgb_cust'?'yes':''}}" >
									{{x.VGB_CUST_BPNAM}}
									</span>
									<span class="hidden{{tbData=='vgb_supp'?'yes':''}}" >
									{{x.VGB_SUPP_BPNAM}}
									</span>

						</td></tr></table>
					</div>

					<div class="col-sm-2">			

						<span class="btn-sm table-bordered"  recid={{x.VGB_BPAR_BPART}} onclick="toggleCl(this,'ab-fxVGB_CUST_BTADD');">
				          		
				          		<span class="text-muted" >
								Adresses
							</span>	
							&nbsp;&nbsp;
							<span class="caret"></span>
							
							{{x.xtra.length}}
							
						</span>
		
						<span ab-fxVGB_CUST_BTADD={{x.VGB_BPAR_BPART}} class='ab-hidden'>
							<br>Detail
							<img src="images/detail.png" ab-fxVGB_CUST_BTADD={{x.VGB_BPAR_BPART}} class='btn ab-hidden' recid={{x.VGB_BPAR_BPART}} 
							recid={{x.VGB_BPAR_BPART}} onclick="toggleCl(this,'ab-fxVGB_CUST_BTADDde');" 
							/>
							&nbsp;
							
								
						</span>
		
		
		
						<div  class="ab-hidden" ab-fxVGB_CUST_BTADD={{x.VGB_BPAR_BPART}} ab-fx ab-dtaGB_CUST_BTADD>
						      	<table class='table table-hover btn'  >
						      	
						      	<tr ng-repeat="y in x.xtra" ab-value='{{y.idVGB_ADDR}}' recid={{x.VGB_BPAR_BPART}}
						      	onclick="toggleCl(this,'ab-fxVGB_CUST_BTADD');">
								<td>
								<span  class=''
								      	title="address {{y.VGB_ADDR_ADDID}}"
								      		
								>
								      	
								

									<span class="caret{{y.idVGB_ADDR!=VGB_CUST_BTADD?'xxx':''}}"></span>
									{{y.VGB_ADDR_ADDID}}
								</span>
								</td>
								<td style='text-align:left;white-space:nowrap;'  >
								
								
									{{ y.VGB_ADDR_DESCR }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<br>
									<span ab-fxVGB_CUST_BTADDde={{x.VGB_BPAR_BPART}} class='ab-hidden btn-sm disabled'>
										{{y.VGB_ADDR_ADNAM}} 
										<br>{{y.VGB_ADDR_ADD01}},  
										{{y.VGB_ADDR_ADD02}} 
										<br>{{y.VGB_ADDR_CITYN}}, {{y.VGB_ADDR_POSTC}}
										<br>{{y.VGB_ADDR_CONT1}} - {{y.VGB_ADDR_TEL01}}
										
								      	</span>
							      	</td>
						      	
						      	</tr>
						      	</table>
					      	</div>	
		
					</div>

					<div class="col-sm-2">			
				
				
								{{x.VGB_BPAR_CDATE}}
					</div>								<div class="col-sm-1" >			
					<div class="hidden{{tbData=='vgb_bpar'?'vgb_cust':''}}">
						<span ng-init='cust = !x.idVGB_CUST?"0":x.idVGB_CUST'></span>
						<span title='Is a customer?'  > {{!x.idVGB_CUST?"No":"Yes"}}</span>
					</div>	
					</div>
					<div class="col-sm-1" >
					<div class="hidden{{tbData=='vgb_bpar'?'vgb_supp':''}}">			

					
						<span ng-init='supp = !x.idVGB_SUPP?"0":x.idVGB_SUPP'></span>
						<span title='Is supplier?'  >  {{!x.idVGB_SUPP?"No":"Yes"}}</span>
					</div>	
					</div>
		
				</div>
				</td>
			</tr>
			<tr >
			
			
				<td colspan=10>
				<div class="row">
					<div class="col-sm-12">			
					</div>
				</div>
			<tr>
		
			<tr>
				<td>
					<br><br><br><br><br><br><br><br>
				</td>
			</tr>
			
		</table>
		</div>
		</td>
		</tr>
		</table>
    	</div>
		

</div>   	


</form>
