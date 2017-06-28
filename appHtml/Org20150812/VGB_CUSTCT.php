<div class="hidden">
<?php require_once "../appCscript/VGB_PARTNERS.php"; ?>
</div>



<div class='btn-sm '>


	<span ng-model="vgb_cust" ng-include="'stdCscript/stdDbButtons.php'" ></span>
	

</div>

<form id="mainForm"   ab-main="vgb_cust"  >
<div class="row mygrid-wrapper-div">
	<div class="col-sm-6">
		<table class="table table-striped" >
		<tr>
		<td>
			<label class="btn-md"  ab-label="VGB_CUST_BPART">Partner</label>
		
		
				
		</td>
		<td>
			
			<Input class="ab-hidden" type="text" ng-model="idVGB_CUST" size=3 />		
			<input readonly
			lval="" 
			auto-main="YES" 
			ab-autolabel="VGB_CUST_BPNAM" 

			ng-keyup="kUp('VGB_CUST_BPART','VGB_CUST_BPART','vgb_cust')"  
			ng-model="VGB_CUST_BPART"
			id="VGB_CUST_BPART"
			class="ab-hidden" 
			ab-autocomplete
			type="text" size="20" value="" />
			<label class="btn-sm">{{ VGB_BPAR_BPART }}</label>
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="STD_NAME">VGB_CUST_BPNAM</label>
		</td>
		<td>
			<input a_iref="02-10" type="text" size="40" ng-model="VGB_CUST_BPNAM" value="" />
		</td>
		</tr>

		<tr>
			<td  >
			
				<label class="btn-md" ab-label="VGB_CUST_BTADD">VGB_CUST_BTADD</label>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				
			</td>
			<td >

				<input ng-model="VGB_CUST_BTADD" class="ab-hidden" size=5 />
				
				<span class="btn-sm table-bordered"  onclick="$('[ab-fxVGB_CUST_BTADD]').toggleClass('ab-hidden');">
		          		
		          		<span class="text-muted" ng-repeat="x	in vgb_cust">
						{{ x.idVGB_ADDR==VGB_CUST_BTADD?x.VGB_ADDR_ADDID + " - " + x.VGB_ADDR_DESCR:"" }}
					</span>	
					&nbsp;&nbsp;
					<span class="caret"></span>
				</span>

<!--
				<img src="images/detail.png" ab-fxVGB_CUST_BTADD class='btn ab-hidden' onclick="$('[ab-fxVGB_CUST_BTADDde]').toggleClass('ab-hidden');" />
-->
				<span ab-fxVGB_CUST_BTADD ab-label="STD_DETAILLED" class='btn btn-xs text-muted ab-hidden' onclick="$('[ab-fxVGB_CUST_BTADDde]').toggleClass('ab-hidden');">Detail</span>



				<div  class="ab-search ab-hidden" ab-fxVGB_CUST_BTADD ab-fx ab-dtaGB_CUST_BTADD>
				      	<table class='table table-hover btn'  >
				      	<tr><td>Line</td></tr>
				      	<tr ng-repeat="y in vgb_cust" ab-value='{{y.idVGB_ADDR}}' 
				      	onclick="deflectVal(this.getAttribute('ab-value'),'VGB_CUST_BTADD');$('[ab-fxVGB_CUST_BTADD]').toggleClass('ab-hidden');">
						<td>
							<span class="caret{{y.idVGB_ADDR!=VGB_CUST_BTADD?'xxx':''}}"></span>
							{{y.VGB_ADDR_ADDID}}
						</td>
						<td style='text-align:left;white-space:nowrap;'  >
						
						
							{{ y.VGB_ADDR_DESCR }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<br>
							<span ab-fxVGB_CUST_BTADDde class='ab-hidden btn-sm disabled'>
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
			
				<label class="btn-md" ab-label="VGB_CUST_STADD">VGB_CUST_STADD</label>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				
			</td>
			<td >

				<input ng-model="VGB_CUST_STADD" class="ab-hidden" size=5 />
				
				<span class="btn-sm table-bordered"  onclick="$('[ab-fxVGB_CUST_STADD]').toggleClass('ab-hidden');">
		          		
		          		<span class="text-muted" ng-repeat="x	in vgb_cust">
						{{ x.idVGB_ADDR==VGB_CUST_STADD?x.VGB_ADDR_ADDID + " - " + x.VGB_ADDR_DESCR:"" }}
					</span>	
					&nbsp;&nbsp;
					<span class="caret"></span>
				</span>
<!--
				<img src="images/detail.png" ab-fxVGB_CUST_STADD class='btn ab-hidden' onclick="$('[ab-fxVGB_CUST_STADDde]').toggleClass('ab-hidden');" />
-->
				<span ab-fxVGB_CUST_STADD ab-label="STD_DETAILLED" class='btn btn-xs text-muted ab-hidden' onclick="$('[ab-fxVGB_CUST_STADDde]').toggleClass('ab-hidden');">Detail</span>


				<div  class="ab-search ab-hidden" ab-fxVGB_CUST_STADD ab-fx ab-dtaGB_CUST_STADD>
				      	<table class='table table-hover btn' >
				      	
				      	<tr ng-repeat="y in vgb_cust" ab-value='{{y.idVGB_ADDR}}' 
				      	onclick="deflectVal(this.getAttribute('ab-value'),'VGB_CUST_STADD');$('[ab-fxVGB_CUST_STADD]').toggleClass('ab-hidden');">
						<td>
							<span class="caret{{y.idVGB_ADDR!=VGB_CUST_STADD?'xxx':''}}"></span>
							{{y.VGB_ADDR_ADDID}}
						</td>
						<td style='text-align:left;white-space:nowrap;'  >
						
						
							{{ y.VGB_ADDR_DESCR }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<br>
							<span ab-fxVGB_CUST_STADDde class='ab-hidden btn-sm disabled'>
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
		<td>
			<label class="btn-md"  ab-label="VGB_CUST_BAORA">VGB_CUST_BAORA</label>
		</td>
		<td>
			<input ng-click="rfs('VGB_CUST_BAORA')" ng-model="VGB_CUST_BAORA"  value="" />
			
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VIN_ITEM_CFCAT">VGB_CUST_CFCAT</label>
		</td>
		<td>
			<input  ng-click="rfs('VGB_CUST_CFCAT')" ng-model="VGB_CUST_CFCAT" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_DELCO">VGB_CUST_DELCO</label>
		</td>
		<td>
			<div>
			<table>
			<tr>
			<td>
			
				<input  ng-click="rfs('VGB_CUST_DELCO')" ng-model="VGB_CUST_DELCO" value="" />
			</td>
			<td>	
				<label class='btn-sm {{VGB_CUST_DELCO=="CONDITIO"?"":"ab-hidden"}}'   ab-label="VGB_CUST_COLLE">VGB_CUST_COLLE</label>
			</td>
			</tr>
			<tr>
			<td>
			</td>
			<td>
				<label class='btn-sm {{VGB_CUST_DELCO=="CONDITIO"?"":"ab-hidden"}}'   ab-label="LF_DELCO_PREPAID" >f  </label>
				<input class='{{VGB_CUST_DELCO=="CONDITIO"?"":"ab-hidden"}}' type="text" size="8" ng-model="VGB_CUST_COLLE" value="" />
				
			</td>
			</tr>
			</table>
			</div>
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VSL_ORHE_ORFOB">VGB_CUST_ORFOB</label>
		</td>
		<td>
			<input a_iref="02-65" type="text" size="30" ng-model="VGB_CUST_ORFOB" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md" ab-label="VGB_SLRP_SLSRP" >VGB_CUST_SLSRP</label>
		</td>
		<td>
			<input ng-model="VGB_CUST_SLSRP" class="ab-hidden" size=5 />
			<input a_iref="02-60"
			
			lval=""
			ab-autofill="vgb_slrp,idVGB_SLRP:VGB_CUST_SLSRP,VGB_SLRP_SLSRP:VGB_SLRP_SLSRP_f"
			ab-autolabel="VGB_SLRP_SRNAM,VGB_SLRP_SRCOR" 
			ng-keyup="kUp('VGB_SLRP_SLSRP_f','VGB_SLRP_SLSRP','vgb_slrp')"  
			ng-model="VGB_SLRP_SLSRP_f"
			id="VGB_SLRP_SLSRP_f"
			
			ab-autocomplete
			type="text"  size=5 value=""
			ab-toggle="VGB_SLRP_SLSRP_fx"
			/>
			<span class="ab-border" id="VGB_SLRP_SLSRP_fx">{{VGB_SLRP_SLSRP}}</span>
			
          		<span class="text-muted" role="presentation" >
				{{ VGB_SLRP_SRNAM}}
			</span>

		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_MRKID">VGB_CUST_MRKID</label>
		</td>
		<td>
			<input ng-model="VGB_CUST_MRKID" class="ab-hidden" size=5 />
			<input 
			lval="" 
			ab-autofill="vgb_mark,idVGB_MARK:VGB_CUST_MRKID,VGB_MARK_MRKID:VGB_MARK_MRKID_f"
			ab-autolabel="VGB_MARK_DESCR" 
			ng-keyup="kUp('VGB_MARK_MRKID_f','VGB_MARK_MRKID','vgb_mark')"  
			ng-model="VGB_MARK_MRKID_f"
			id="VGB_MARK_MRKID_f"
			
			ab-autocomplete
			
			 type="text" size="5" ng-model="VGB_CUST_MRKID" value=""
			ab-toggle="VGB_MARK_MRKID_fx"
			/>
			<span class="text-muted" id="VGB_MARK_MRKID_fx">{{VGB_MARK_MRKID}}</span>

          		<span class="text-muted" role="presentation" >
				{{ VGB_MARK_DESCR}}
			</span>



		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CUTYP">VGB_CUST_CUTYP</label>
		</td>
		<td>
			<input ng-model="VGB_CUST_CUTYP" class="ab-hidden" size=5 />
			<Input
			lval="" 
			ab-autofill="vgb_ctyp,idVGB_CTYP:VGB_CUST_CUTYP,VGB_CTYP_CUTYP:VGB_CTYP_CUTYP_f"
			ab-autolabel="VGB_CTYP_DESCR" 
			ng-keyup="kUp('VGB_CTYP_CUTYP_f','VGB_CTYP_CUTYP','vgb_ctyp')"  
			ng-model="VGB_CTYP_CUTYP_f"
			id="VGB_CTYP_CUTYP_f"
			ab-autocomplete
				
			 type="text" size="8" ng-model="VGB_CUST_CUTYP" value=""
			ab-toggle="VGB_CTYP_CUTYP_fx"
			/>
			<span class="text-muted" id="VGB_CTYP_CUTYP_fx">{{VGB_CTYP_CUTYP}}</span>
          		<span class="text-muted" role="presentation" >
				{{ VGB_CTYP_DESCR}}
			</span>

		</td>
		</tr>
			
		</table>
	</div>
	<div class="col-sm-6">
		<table class="table table-striped" >
		<tr>				
		<td>
			<label class="btn-md"   ab-label="STD_CDATE" >VGB_CUST_CDATE</label>
		</td>
		<td>
			<span ng-model="VGB_CUST_CDATE" value="">{{VGB_CUST_CDATE}} </span>
		</td>
		</tr>
		
		<tr>				
		<td>
			<label class="btn-md"   ab-label="STD_BANK">VGB_CUST_CUBNK</label>
		</td>
		<td>
			<input a_iref="02-10" type="text" size="30" ng-model="VGB_CUST_CUBNK" value="" />
		</td>
		</tr>

		<tr>
			<td  >
			
				<label class="btn-md" ab-label="VGB_CUST_BKADD">VGB_CUST_BKADD</label>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				
			</td>
			<td >

				<input ng-model="VGB_CUST_BKADD" class="ab-hidden" size=5 />
				
				<span class="btn-sm table-bordered"  onclick="$('[ab-fxVGB_CUST_BKADD]').toggleClass('ab-hidden');">
		          		
		          		<span class="text-muted" ng-repeat="x	in vgb_cust">
						{{ x.idVGB_ADDR==VGB_CUST_BKADD?x.VGB_ADDR_ADDID + " - " + x.VGB_ADDR_DESCR:"" }}
					</span>	
					&nbsp;&nbsp;
					<span class="caret"></span>
				</span>

<!--
				<img src="images/detail.png" ab-fxVGB_CUST_BKADD class='btn ab-hidden' onclick="$('[ab-fxVGB_CUST_BKADDde]').toggleClass('ab-hidden');" />
-->
				<span ab-fxVGB_CUST_BKADD ab-label="STD_DETAILLED" class='btn btn-xs text-muted ab-hidden' onclick="$('[ab-fxVGB_CUST_BKADDde]').toggleClass('ab-hidden');" >Detail</span>



				<div  class="ab-search ab-hidden" ab-fxVGB_CUST_BKADD ab-fx ab-dtaGB_CUST_BKADD>
				      	<table class='table table-hover btn'  >
				      	
				      	<tr ng-repeat="y in vgb_cust" ab-value='{{y.idVGB_ADDR}}' 
				      	onclick="deflectVal(this.getAttribute('ab-value'),'VGB_CUST_BKADD');$('[ab-fxVGB_CUST_BKADD]').toggleClass('ab-hidden');">
						<td>
							<span class="caret{{y.idVGB_ADDR!=VGB_CUST_BKADD?'xxx':''}}"></span>
							{{y.VGB_ADDR_ADDID}}
						</td>
						<td style='text-align:left;white-space:nowrap;'  >
						
						
							{{ y.VGB_ADDR_DESCR }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<br>
							<span ab-fxVGB_CUST_BKADDde class='ab-hidden btn-sm disabled'>
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
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CREDR">VGB_CUST_CREDR</label>
		</td>
		<td>
			<input a_iref="02-30" type="text" size="30" ng-model="VGB_CUST_CREDR" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CRHOL">VGB_CUST_CRHOL</label>
		</td>
		<td>
			<input ng-click="rfs('VGB_CUST_CRHOL')" ng-model="VGB_CUST_CRHOL" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_STATM">VGB_CUST_STATM</label>
		</td>
		<td>
			<input ng-click="rfs('VGB_CUST_STATM')" ng-model="VGB_CUST_STATM" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_STBFW">VGB_CUST_STBFW</label>
		</td>
		<td>
			<input ng-model="VGB_CUST_STBFW" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_TERM_TERID"	>VGB_CUST_TERID</label>
		</td>
		<td>
			<input ng-model="VGB_CUST_TERID" class="ab-hidden" size=5 />
			<input 
			lval="" 
			ab-autofill="vgb_term,idVGB_TERM:VGB_CUST_TERID,VGB_TERM_TERID:VGB_TERM_TERID_f"
			ab-autolabel="VGB_TERM_DESCR" 
			ng-keyup="kUp('VGB_TERM_TERID_f','VGB_TERM_TERID','vgb_term')"  
			ng-model="VGB_TERM_TERID_f"
			id="VGB_TERM_TERID_f"
			ab-autocomplete
			
			type="text" size="5" 
			value="" 
			ab-toggle="VGB_TERM_TERID_fx"
			/>
			<span class="text-muted" id="VGB_TERM_TERID_fx">{{VGB_TERM_TERID}}</span>

          		<span class="text-muted" role="presentation" >
				{{ VGB_TERM_DESCR}}
			</span>

		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CRELI">VGB_CUST_CRELI</label> 
		</td>
		<td>
			<Input a_iref="02-80" class="A_input" type="text" size="13" ng-model="VGB_CUST_CRELI" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="STD_OVERDUE_DAYS" >VGB_CUST_OVERD</label>
		</td>
		<td>
			<input a_iref="02-90" class="A_input" type="text" size="2" ng-model="VGB_CUST_OVERD" value="" />
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CURID">VGB_CUST_CURID</label>
		</td>
		<td>
			<input ng-model="VGB_CUST_CURID" class="ab-hidden" size=5 />
			<input 
			lval=""
			ab-autofill="vgb_curr,idVGB_CURR:VGB_CUST_CURID,VGB_CURR_CURID:VGB_CURR_CURID_f"
			ab-autolabel="VGB_CURR_DESCR" 
			ng-keyup="kUp('VGB_CURR_CURID_f','VGB_CURR_CURID','vgb_curr')"  
			ng-model="VGB_CURR_CURID_f"
			id="VGB_CURR_CURID_f"
			ab-autocomplete
			type="text" size="4" 
			ab-toggle="VGB_CURR_CURID_fx"
			/>
			<span class="text-muted" id="VGB_CURR_CURID_fx">{{VGB_CURR_CURID}}</span>
          		<span class="text-muted" role="presentation" >
				{{ VGB_CURR_DESCR }}
			</span>
			
		</td>
		</tr>
		<tr>
		<td>
			<label class="btn-md"   ab-label="VGB_CUST_CSTAT">VGB_CUST_CSTAT</label>
		</td>
		<td>
			<input ng-click="rfs('VGB_CUST_CSTAT')" ng-model="VGB_CUST_CSTAT" value="" />
		</td>
		</tr>
		</table>
	</div>
</div>

</form>
