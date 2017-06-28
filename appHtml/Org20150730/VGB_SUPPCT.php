<?php
ini_set('display_errors', 0);
session_start();
ob_clean();

include "../appCscript/VGB_PARTNERS.php";

?>




<div class='btn-sm ab-body-buttons' id="ab-header" style="white-space:nowrap;">

 <span ng-model="vgb_supp" ng-include="'stdCscript/stdDbButtons.php'"></span>


</div>
<form id="mainForm"  href="#vgb_suppct/{{idVGB_SUPP}}/{{idVGB_BPAR}}/{{VGB_BPAR_BPART}} - {{VGB_BPAR_BPNAM}}/UPDATE" ab-main="vgb_supp" >
<div class="row mygrid-wrapper-div">
	<div class="col-sm-6">
		<table class="table table-striped" >
		<tr>
		<td>
			<label class="btn-md" ab-label="VGB_BPAR_BPART_SH">Partner</label>
			
		</td>
		<td>
			<Input class="ab-hidden" type="text" ng-model="idVGB_SUPP" size=3 />
			<Input readonly
			lval="" 
			auto-main="YES" 
			ab-autolabel="VGB_SUPP_BPNAM" 
			ng-keyup="kUp('VGB_SUPP_BPART','VGB_SUPP_BPART','vgb_supp')"  
			ng-model="VGB_SUPP_BPART"
			id="VGB_SUPP_BPART"
			class="ab-hidden"
			ab-autocomplete
			type="text" size="20" ng-model="VGB_SUPP_BPART" value="">
			<label class="btn-sm">{{ recPointer }}</label>
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="STD_NAME" >VGB_SUPP_BPNAM</label>
		</td>
		<td>
			<input a_iref="02-10" type="text" size="40" ng-model="VGB_SUPP_BPNAM" value="">
		</td>
		</tr>


		<tr>
			<td  >
			
				<label class="btn-md" ab-label="VGB_SUPP_BTADD">VGB_SUPP_BTADD</label>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				
			</td>
			<td >

				<input ng-model="VGB_SUPP_BTADD" class="ab-hidden" size=5 />
				
				<span class="btn-sm table-bordered"  onclick="$('[ab-fxVGB_SUPP_BTADD]').toggleClass('ab-hidden');">
		          		
		          		<span class="text-muted" ng-repeat="x	in vgb_bpar[0].xtra">
						{{ x.idVGB_ADDR==VGB_SUPP_BTADD?x.VGB_ADDR_ADDID + " - " + x.VGB_ADDR_DESCR:"" }}
					</span>	
					&nbsp;&nbsp;
					<span class="caret"></span>
				</span>

				<img src="images/detail.png" ab-fxVGB_SUPP_BTADD class='btn ab-hidden' onclick="$('[ab-fxVGB_SUPP_BTADDde]').toggleClass('ab-hidden');" />




				<div  class="ab-search ab-hidden" ab-fxVGB_SUPP_BTADD ab-fx ab-dtaGB_CUST_BTADD>
				      	<table class='table table-hover btn' ng-repeat="x in vgb_bpar" >
				      	
				      	<tr ng-repeat="y in x.xtra" ab-value='{{y.idVGB_ADDR}}' 
				      	onclick="deflectVal(this.getAttribute('ab-value'),'VGB_SUPP_BTADD');$('[ab-fxVGB_SUPP_BTADD]').toggleClass('ab-hidden');">
						<td>
							<span class="caret{{y.idVGB_ADDR!=VGB_SUPP_BTADD?'xxx':''}}"></span>
							{{y.VGB_ADDR_ADDID}}
						</td>
						<td style='text-align:left;white-space:nowrap;'  >
						
						
							{{ y.VGB_ADDR_DESCR }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<br>
							<span ab-fxVGB_SUPP_BTADDde class='ab-hidden btn-sm disabled'>
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


			</td>
			
		</tr>


		<tr>
			<td  >
			
				<label class="btn-md" ab-label="VGB_SUPP_STADD">VGB_SUPP_STADD</label>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				
			</td>
			<td >

				<input ng-model="VGB_SUPP_STADD" class="ab-hidden" size=5 />
				
				<span class="btn-sm table-bordered"  onclick="$('[ab-fxVGB_SUPP_STADD]').toggleClass('ab-hidden');">
		          		
		          		<span class="text-muted" ng-repeat="x	in vgb_bpar[0].xtra">
						{{ x.idVGB_ADDR==VGB_SUPP_STADD?x.VGB_ADDR_ADDID + " - " + x.VGB_ADDR_DESCR:"" }}
					</span>	
					&nbsp;&nbsp;
					<span class="caret"></span>
				</span>

				<img src="images/detail.png" ab-fxVGB_SUPP_STADD class='btn ab-hidden' onclick="$('[ab-fxVGB_SUPP_STADDde]').toggleClass('ab-hidden');" />




				<div  class="ab-search ab-hidden" ab-fxVGB_SUPP_STADD ab-fx ab-dtaGB_CUST_STADD>
				      	<table class='table table-hover btn' ng-repeat="x in vgb_bpar" >
				      	
				      	<tr ng-repeat="y in x.xtra" ab-value='{{y.idVGB_ADDR}}' 
				      	onclick="deflectVal(this.getAttribute('ab-value'),'VGB_SUPP_STADD');$('[ab-fxVGB_SUPP_STADD]').toggleClass('ab-hidden');">
						<td>
							<span class="caret{{y.idVGB_ADDR!=VGB_SUPP_STADD?'xxx':''}}"></span>
							{{y.VGB_ADDR_ADDID}}
						</td>
						<td style='text-align:left;white-space:nowrap;'  >
						
						
							{{ y.VGB_ADDR_DESCR }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<br>
							<span ab-fxVGB_SUPP_STADDde class='ab-hidden btn-sm disabled'>
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


			</td>
			
		</tr>


		
<!--		
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_SUPP_PTADD" >VGB_SUPP_PTADD</label>
		</td>
		<td>
			<input ng-model="VGB_SUPP_BTADD" class="ab-hidden" size=5 />
			<input ng-model="VGB_ADDR_BPART" class="ab-hidden" size=5 />
			
			<input a_iref="02-60"
			size=2
			lval=""
			ab-autofill="vgb_addr,idVGB_ADDR:VGB_SUPP_BTADD,VGB_SUPP_BTADD:VGB_ADDR_ADDID_f"
			ab-autolabel="VGB_ADDR_DESCR"
			ab-RequiredKey="VGB_ADDR_BPART" 
			ng-keyup="kUp('VGB_ADDR_ADDID_f','VGB_ADDR_ADDID','vgb_addr')"  
			ng-model="VGB_ADDR_ADDID_f" 
			id="VGB_ADDR_ADDID_f"
			value="" 
			ab-autocomplete
			ab-toggle="VGB_ADDR_ADDID_fxa"
			/>
			<span class="text-muted" role="presentation" ng-model="VGB_ADDR_ADDID_fx1X2" ng-repeat="x	in mdta">
				<span class="ab-hidden" role="presentation" id="VGB_ADDR_ADDID_fxa{{x.idVGB_ADDR==VGB_SUPP_BTADD?'':$index}}" >{{x.VGB_ADDR_ADDID }}</span>
			</span>
			<span class="text-muted" role="presentation" ng-model="VGB_SUPP_BTDESC" ng-repeat="x	in mdta">
				{{ x.idVGB_ADDR==VGB_SUPP_BTADD?x.VGB_ADDR_DESCR:"" }}
			</span>
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_SUPP_SFADD" >VGB_SUPP_STADD</label>
		</td>
		<td>
			<input ng-model="VGB_SUPP_STADD" class="ab-hidden" size=5 />
			<input a_iref="02-60"
			size=2
			lval=""
			ab-autofill="vgb_addr,idVGB_ADDR:VGB_SUPP_STADD,VGB_SUPP_STADD:VGB_ADDR_ADDID_f1"
			ab-autolabel="VGB_ADDR_DESCR"
			ab-RequiredKey="VGB_ADDR_BPART" 
			ng-keyup="kUp('VGB_ADDR_ADDID_f1','VGB_ADDR_ADDID','vgb_addr')"  
			ng-model="VGB_ADDR_ADDID_f1" 
			id="VGB_ADDR_ADDID_f1"
			value="" 
			ab-autocomplete
			ab-toggle="VGB_ADDR_ADDID_fx1"
			/>
			<span class="text-muted" role="presentation" ng-model="VGB_ADDR_ADDID_fx1XX" ng-repeat="x	in mdta">
				
				<span class="ab-hidden" role="presentation" id="VGB_ADDR_ADDID_fx1{{x.idVGB_ADDR==VGB_SUPP_STADD?'':$index}}" >{{x.VGB_ADDR_ADDID }}</span>
			</span>

			<span class="text-muted" role="presentation" ng-model="VGB_SUPP_STDESC" ng-repeat="x	in mdta">
				{{ x.idVGB_ADDR==VGB_SUPP_STADD?x.VGB_ADDR_DESCR:"" }}
			</span>
					</td>
		</td>
		</tr>
-->	
		</table>
	</div>
	<div class="col-sm-6">
		<table class="table  table-striped" >
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CRELI" >VGB_SUPP_CRELI</label>
		</td>
		<td>
			<input a_iref="02-40" type="text" size="13" ng-model="VGB_SUPP_CRELI" value="">
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_TERM_TERID" >VGB_SUPP_TERID</label>
		</td>
		<td>
			<input ng-model="VGB_SUPP_TERID"  class="ab-hidden" size=5 />
			<input 
			lval="" 
			ab-autofill="vgb_term,idVGB_TERM:VGB_SUPP_TERID,VGB_TERM_TERID:VGB_TERM_TERID_f"
			ab-autolabel="VGB_TERM_DESCR" 
			ng-keyup="kUp('VGB_TERM_TERID_f','VGB_TERM_TERID','vgb_term')"  
			ng-model="VGB_TERM_TERID_f"
			id="VGB_TERM_TERID_f"
			ab-autocomplete
			
			type="text" size="5" value=""
			ab-toggle="VGB_TERM_TERID_fx"
			 />
			<span class="ab-hidden" role="presentation" id="VGB_TERM_TERID_fx" >{{VGB_TERM_TERID}}</span>
          		<span class="text-muted" role="presentation" >
				{{ VGB_TERM_DESCR}}
			</span>

		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="STD_CURRENCY"  >VGB_SUPP_CURID</label>
		</td>
		<td>
			<input ng-model="VGB_SUPP_CURID"  class="ab-hidden" size=5 />
			<input 
			lval="" 
			ab-autofill="vgb_curr,idVGB_CURR:VGB_SUPP_CURID,VGB_CURR_CURID:VGB_CURR_CURID_f"
			ab-autolabel="VGB_CURR_DESCR" 
			ng-keyup="kUp('VGB_CURR_CURID_f','VGB_CURR_CURID','vgb_curr')"  
			ng-model="VGB_CURR_CURID_f"
			id="VGB_CURR_CURID_f"
			ab-autocomplete
			type="text" size="5" value=""
			ab-toggle="VGB_CURR_CURID_fx"
			 />
			<span class="ab-hidden" role="presentation" id="VGB_CURR_CURID_fx" >{{VGB_CURR_CURID}}</span>
          		<span class="text-muted" role="presentation" >
				{{ VGB_CURR_DESCR}}
			</span>

		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VSL_ORHE_ORFOB" >VGB_SUPP_ORFOB</label>
		</td>
		<td>
			<input a_iref="02-65" type="text" size="30" ng-model="VGB_SUPP_ORFOB" value="">
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="STD_CDATE" >VGB_SUPP_CDATE</label>
		</td>
		<td>
			<input a_iref="02-70" type="text" size="15" disabled ng-model="VGB_SUPP_CDATE" value="">
		</td>
		</tr>
		</table>
	</div>
</div>

</form>
