<?php 
ini_set('display_errors', 0);
session_start();
ob_clean();

include "../appCscript/VGB_PARTNERS.php";

?>


<div class='btn-sm ab-body-buttons' id="ab-header" style="white-space:nowrap;">

 <span ng-model="vgb_supp" ng-include="'stdCscript/stdDbButtons.php'"></span>
</div>
<form id="mainForm" href="#vgb_bparct/{{VGB_BPAR_BPART}}/UPDATE"  ab-main="vgb_bpar" >
<div class="row mygrid-wrapper-div" >
	<div class="col-sm-4">
		<table class="table  table-striped" >
		<tr>
			<td onclick="if(A_ReporterFn.getProp()){}">
				<label class="btn-md" ab-label="VGB_BPAR_BPART_SH">Business Partner</label>
				
			</td>
			<td>
				<Input class="ab-hidden" type="text" ng-model="idVGB_BPAR" size=3 />
				<input type="text" size=20 id="VGB_BPAR_BPART" 
				value="" 
				ng-change="chkDta();" 
				lval="" 
				ng-model="VGB_BPAR_BPART" />
			</td>
		</tr>
		</table>
	</div>
	<div class="col-sm-4">
		<table class="table  table-striped" >
		<tr>
		
			<td>
				<label class="btn-md" ab-label="STD_NAME">Name</label>
			</td>
			<td>	
				<input type="text"  size=40 ng-model="VGB_BPAR_BPNAM" value="" />
			</td>

		</tr>
		</table>
	</div>
	<div class="col-sm-4">
		<table class="table  table-striped" >
		<tr>
			<td>
				<label class="btn-md" ab-label="STD_CREATED" >Created</label>
			</td>
			<td>	
				
				<Input type="text" a_iref="2-2" size=15 disabled ng-model="VGB_BPAR_CDATE" value="" />
			</td>
		</tr>

		
		</table>
    	</div>

</div>    	





<table ab-updhide >
<tr  role="presentation"  ng-repeat="x in vgb_bpar">


	<td colspan=10>
	<div class="row">


		<div class="col-sm-5">			

			<span class="btn-sm table-bordered"  recid={{x.VGB_BPAR_BPART}} onclick="toggleCl(this,'ab-fxVGB_CUST_BTADD');">
	          		
	          		<span class="text-muted" >
					Adresses
				</span>	
				&nbsp;&nbsp;
				<span class="caret"></span>
				
				{{x.rowSet.length}}
				
			</span>

			<span ab-fxVGB_CUST_BTADD={{x.VGB_BPAR_BPART}} class='ab-hidden'>
				<br>Detail
				<img src="images/detail.png" ab-fxVGB_CUST_BTADD={{x.VGB_BPAR_BPART}} class='btn ab-hidden' recid={{x.VGB_BPAR_BPART}} 
				recid={{x.VGB_BPAR_BPART}} onclick="toggleCl(this,'ab-fxVGB_CUST_BTADDde');" 
				/>
				&nbsp;
				New
				<img 	src="images/edit04.png" width="16" height="16" 
					onclick="abLinkChange(this.getAttribute('ab-rhref'));abLink(this);" 
					ab-rhref="#vgb_bparct/{{x.VGB_BPAR_BPART}}/UPDATE"
					title="Create New Address"
					href="#vgb_addrct/0/{{x.idVGB_BPAR}}/{{x.VGB_BPAR_BPART}}-{{x.VGB_BPAR_BPNAM}}/CREATE" 
				/>
				
					
			</span>



			<div  class="ab-hidden" ab-fxVGB_CUST_BTADD={{x.VGB_BPAR_BPART}} ab-fx ab-dtaGB_CUST_BTADD>
			      	<table class='table table-hover btn'  >
			      	
			      	<tr ng-repeat="y in x.rowSet" ab-value='{{y.idVGB_ADDR}}' recid={{x.VGB_BPAR_BPART}}
			      	onclick="toggleCl(this,'ab-fxVGB_CUST_BTADD');">
					<td>
					<span  class='btn btn-xs btn-default'
					      	onclick="abLinkChange(this.getAttribute('ab-rhref'));abLink(this);" 
						ab-rhref="#vgb_bparct/{{x.VGB_BPAR_BPART}}/UPDATE"
						   title="Edit address {{y.VGB_ADDR_ADDID}}"
					      	href="#vgb_addrct/{{y.idVGB_ADDR}}/{{x.idVGB_BPAR}}/{{x.VGB_BPAR_BPART}} - {{x.VGB_BPAR_BPNAM}}/{{UPDATE"								
					>
					      	<img src="images/edit04.png"  width="16" height="16" />
					

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
		<div class="col-sm-4" >			
		<div class="hidden{{tbData=='vgb_cust'||tbData=='vgb_bpar'?'vgb_cust':''}}">
			<span ng-init='cust = !x.idVGB_CUST?"0":x.idVGB_CUST'></span>
			<span onclick="abLinkChange(this.getAttribute('ab-rhref'));abLink(this);" 
			ab-rhref="#vgb_bparct/{{x.VGB_BPAR_BPART}}/UPDATE"
			class="btn  btn-xs btn-default" title='{{!x.idVGB_CUST?"Create":"Edit"}} Customer?' 
			href="#vgb_custct/{{cust}}/{{x.idVGB_BPAR}}/{{x.VGB_BPAR_BPART}} - {{x.VGB_BPAR_BPNAM}}/{{!x.VGB_CUST_BPART?'CREATE':'UPDATE'}}" > {{!x.idVGB_CUST?"Create Customer?":"Edit Customer?"}}</span>
		</div>
		</div>
		<div class="col-sm-3" >
		<div class="hidden{{tbData=='vgb_supp'||tbData=='vgb_bpar'?'vgb_supp':''}}">			

		
			<span ng-init='supp = !x.idVGB_SUPP?"0":x.idVGB_SUPP'></span>
			<span onclick="abLinkChange(this.getAttribute('ab-rhref'));abLink(this);" 
			ab-rhref="#vgb_bparct/{{x.VGB_BPAR_BPART}}/UPDATE" 
			class="btn  btn-xs btn-default"  title='{{!x.idVGB_SUPP?"Create":"Edit"}} Supplier?' 
			href="#vgb_suppct/{{supp}}/{{x.idVGB_BPAR}}/{{x.VGB_BPAR_BPART}} - {{x.VGB_BPAR_BPNAM}}/{{!x.VGB_SUPP_BPART?'CREATE':'UPDATE'}}" >  {{!x.idVGB_SUPP?"Create Supplier?":"Edit Supplier?"}}</span>
		</div>	
		</div>



			
	</div>


	</td>
</tr>

<tr><td colspan=10 id="ddebug" ><?echo strpos("X".$_SESSION["logged"],"NIaALA") == 1?$_SESSION["logged"]:"-";?>&nbsp;</td></tr>

<tr><td colspan=10>

	<div class="row">


		<div class="col-sm-5">			
		</div>
		<div class="col-sm-4" >			
		<div class="hidden{{tbData=='vgb_cust'||tbData=='vgb_bpar'?'vgb_cust':''}}">
		<div ng-app="AbaxysApp" ng-controller="vgb_custctController">
<?php

if (strpos("X".$_SESSION["logged"],"NIsasALA") == 1)
{
ini_set('display_errors', 1);
include("VGB_CUSTCT.php")

?>

<?php
}
?>

		</div>
		</div>
		<div class="col-sm-3" >
		<div class="hidden{{tbData=='vgb_supp'||tbData=='vgb_bpar'?'vgb_supp':''}}">			

		
		</div>	
		</div>



			
	</div>

	</td>
</tr>


<?php 


if (strpos("X".$_SESSION["logged"],"NIffALA") == 1)
{
?>

<tr><td colspan=10 >

<div class="container">
  
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse1">Customer</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
      <div ng-app="AbaxysApp" ng-controller="vgb_suppctController">
        <div class="panel-body">

<div class="row">
	<div class="col-sm-6">
		<table class="table table-striped" >
		<tr>
		<td >
			<label class="btn-md"  ab-label="VGB_BPAR_BPART_SH">Partner</label>
				
			
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
			<label class="btn-sm">{{ recPointer }}</label>
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
		          		
		          		<span class="text-muted" ng-repeat="x	in vgb_bpar[0].rowSet">
						{{ x.idVGB_ADDR==VGB_CUST_BTADD?x.VGB_ADDR_ADDID + " - " + x.VGB_ADDR_DESCR:"" }}
					</span>	
					&nbsp;&nbsp;
					<span class="caret"></span>
				</span>

				<img src="images/detail.png" ab-fxVGB_CUST_BTADD class='btn ab-hidden' onclick="$('[ab-fxVGB_CUST_BTADDde]').toggleClass('ab-hidden');" />




				<div  class="ab-search ab-hidden" ab-fxVGB_CUST_BTADD ab-fx ab-dtaGB_CUST_BTADD>
				      	<table class='table table-hover btn' ng-repeat="x in vgb_bpar" >
				      	
				      	<tr ng-repeat="y in x.rowSet" ab-value='{{y.idVGB_ADDR}}' 
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
		          		
		          		<span class="text-muted" ng-repeat="x	in vgb_bpar[0].rowSet">
						{{ x.idVGB_ADDR==VGB_CUST_STADD?x.VGB_ADDR_ADDID + " - " + x.VGB_ADDR_DESCR:"" }}
					</span>	
					&nbsp;&nbsp;
					<span class="caret"></span>
				</span>

				<img src="images/detail.png" ab-fxVGB_CUST_STADD class='btn ab-hidden' onclick="$('[ab-fxVGB_CUST_STADDde]').toggleClass('ab-hidden');" />




				<div  class="ab-search ab-hidden" ab-fxVGB_CUST_STADD ab-fx ab-dtaGB_CUST_STADD>
				      	<table class='table table-hover btn' ng-repeat="x in vgb_bpar" >
				      	
				      	<tr ng-repeat="y in x.rowSet" ab-value='{{y.idVGB_ADDR}}' 
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
			ab-autolabel="VGB_SLRP_SRNAM" 
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
		          		
		          		<span class="text-muted" ng-repeat="x	in vgb_bpar[0].rowSet">
						{{ x.idVGB_ADDR==VGB_CUST_BKADD?x.VGB_ADDR_ADDID + " - " + x.VGB_ADDR_DESCR:"" }}
					</span>	
					&nbsp;&nbsp;
					<span class="caret"></span>
				</span>

				<img src="images/detail.png" ab-fxVGB_CUST_BKADD class='btn ab-hidden' onclick="$('[ab-fxVGB_CUST_BKADDde]').toggleClass('ab-hidden');" />




				<div  class="ab-search ab-hidden" ab-fxVGB_CUST_BKADD ab-fx ab-dtaGB_CUST_BKADD>
				      	<table class='table table-hover btn' ng-repeat="x in vgb_bpar" >
				      	
				      	<tr ng-repeat="y in x.rowSet" ab-value='{{y.idVGB_ADDR}}' 
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



        </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse2">Supplier</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
      <div ng-app="AbaxysApp" ng-controller="vgb_suppctController">
        <div class="panel-body">
<?php include("vgb_suppct.php"); ?>
	</div>
      </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse3">Address</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
<div class="row">
	<div class="col-sm-5">
		<table class="table table-striped" >
		<tr>
		<td onclick="if(A_ReporterFn.getProp()){}">

			<label class="btn-md" ab-label="VGB_BPAR_BPART_SH">Partner</label>
			
		</td>
		<td>
			<Input class="ab-hidden" type="text" ng-model="idVGB_ADDR" size=3 />
			<input type="text" size=20 readonly 
				id="VGB_ADDR_BPART" 
				class="ab-hidden" 
				value="" 
				lval="" 
				ng-model="VGB_ADDR_BPART" value="" />
				<label class="btn-sm">{{ recPointer }}</label>

		</td>
		</tr>
		<td>
			<label class="btn-md"   ab-label="VGB_ADDR_ADDID">Address ID</label>
		</td>
		<td>
			<div><table><tr>
			
				<td>			
				<input type="text" class="ACCESS dbCmd" size=2 
				 a_iref="02-60"
				size=2
				lval=""
				ng-keypress="A_chkRec('VGB_ADDR_BPART,VGB_ADDR_ADDID','vgb_addr',$event,'keypress,13');"
				ng-blur="A_chkRec('VGB_ADDR_BPART,VGB_ADDR_ADDID','vgb_addr',$event,'blur');"
				ng-model="VGB_ADDR_ADDID" value="" />
				</td>
				<td>
				&nbsp;
				</td>
				<td>

					<ul class="nav nav-tabs">
					  <li class="dropdown">
					    <span class="dropdown-toggle btn-default" data-toggle="dropdown" >Addresses
					    <span class="caret"></span></span>
					    <ul class="dropdown-menu" >
					      <li class="btn btn-xs btn-default" href="" role="presentation" >
					      	
					      	<table class='table' ng-repeat="x in vgb_bpar" >
					      	<tr>
					      	<td style="width:25%;" >
					      		Id
					      	</td>
					      	<td style="width:75%;">
					      		Description
					      	</td>
					      	</tr>
					      	
					      	<tr ng-repeat="y in x.rowSet">
						<td>{{y.VGB_ADDR_ADDID}}</td>
						<td style='text-align:left;'>
						<div style='overflow:hidden;max-height:20px;' 
						onmouseover="this.style.maxHeight='';" 
						onmouseout="this.style.maxHeight='20px';" 
						>
						{{ y.VGB_ADDR_DESCR }} ..<br><br>
						<div class='btn-info btn-sm'>
						{{y.VGB_ADDR_ADNAM}} 
						<br>{{y.VGB_ADDR_ADD01}},  
						{{y.VGB_ADDR_ADD02}} 
						<br>{{y.VGB_ADDR_CITYN}}, {{y.VGB_ADDR_POSTC}}
						</div>
						</div>      	
					      	</td>
					      	
					      	</tr>
					      	</table>
					      </li>
					      
					    </ul>
					  </li>
					</ul>  

				</td>
				
			</tr></table></div>










		</td>
		</tr>
		<td>
			<label class="btn-md"   ab-label="STD_NOTE">Address Description</label>
		</td>
		<td>	
			<input type="text"   size=40 ng-model="VGB_ADDR_DESCR" value="" />
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
			<input ng-model="VGB_ADDR_PRSID" class="ab-hidden" size=5 />
			<input a_iref="02-60"
			
			lval=""
			ab-autofill="vgb_prst,idVGB_PRST:VGB_ADDR_PRSID,VGB_PRST_PRSID:VGB_PRST_PRSID_f"
			ab-autolabel="VGB_PRST_DESCR" 
			ng-keyup="kUp('VGB_PRST_PRSID_f','VGB_PRST_PRSID','vgb_prst')"  
			ng-model="VGB_PRST_PRSID_f"
			id="VGB_PRST_PRSID_f"
			ab-autocomplete
			ab-toggle="VGB_PRST_PRSID_fx"
			type="text"  size=5 value="" />
			
			<span class="ab-hidden" role="presentation" id="VGB_PRST_PRSID_fx" >{{VGB_PRST_PRSID }}</span>
		
			<span class="text-muted" >  {{VGB_PRST_DESCR }} </span>
			 
		</td>
		</tr>
		<td>
			<label class="btn-md"   ab-label="VGB_ADDR_CNTID">Country ID code</label>
		</td>
		<td>	
			<input ng-model="VGB_ADDR_CNTID" class="ab-hidden" size=5 />
			<input a_iref="02-60"
			
			lval=""
			ab-autofill="vgb_cntr,idVGB_CNTR:VGB_ADDR_CNTID,VGB_CNTR_CNTID:VGB_ADDR_CNTID_f"
			ab-autolabel="VGB_CNTR_DESCR" 
			ng-keyup="kUp('VGB_ADDR_CNTID_f','VGB_CNTR_CNTID','vgb_cntr')"  
			ng-model="VGB_ADDR_CNTID_f"
			id="VGB_ADDR_CNTID_f"
			ab-autocomplete  
			ab-toggle="VGB_ADDR_CNTID_fx"
			 size=3  value=""  value=""  />
			 <span class="ab-hidden" role="presentation" id="VGB_ADDR_CNTID_fx" >{{VGB_CNTR_CNTID }}</span>
			 <span class="text-muted" >  {{VGB_CNTR_DESCR }} </span>

		</td>
		</tr>

		</table>
		          
	</div>		
	<div class="col-sm-7">

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
			<table >
			<tr>
			<td>		
			<input class="ab-hidden" ng-model="VGB_ADDR_SCHID"  size=5 />
			<input a_iref="02-60" 
			
			lval=""
			ab-autofill="vtx_schh,idVTX_SCHH:VGB_ADDR_SCHID,VTX_SCHH_SCHID:VGB_ADDR_SCHID_f"
				ab-autolabel="VTX_SCHH_SCHDE" 
				ab-autocomplete 
				ng-keyup="kUp('VGB_ADDR_SCHID_f','VTX_SCHH_SCHID','vtx_schh')"  
				ng-model="VGB_ADDR_SCHID_f"
				id="VGB_ADDR_SCHID_f"
				
				ab-toggle="VGB_ADDR_SCHID_fx"				
				size=5  value=""   />&nbsp;&nbsp;
			</td>
			<td alain>
				<div>
				<span class="text-muted" role="presentation" ng-model="VGB_ADDR_SCHID_f1X2" ng-repeat="x in mdta | AB_Compare:VGB_ADDR_SCHID:'idVTX_SCHH'">
					<span class="ab-hidden" role="presentation" id="VGB_ADDR_SCHID_fx" >{{x.VTX_SCHH_SCHID }}</span>
					{{ x.VTX_SCHH_SCHDE }}
				</span>
				</div>			
		
			</td>
			</tr>
			</table>
		</div>
		</td>
		</tr>		
		<tr>
		<td>		
			<label class="btn-md"   ab-label="VGB_ADDR_PCHID">(Purchase) Taxe Scheme</label>
		</td>	
		<td class="ab-align-top">
		
				
			<table  >
			<tr>
			<td>		
			<input class="ab-hidden" ng-model="VGB_ADDR_PCHID"  size=5 />
			<input a_iref="02-60"
			
			lval=""
			ab-autofill="vtx_schh,idVTX_SCHH:VGB_ADDR_PCHID,VTX_SCHH_SCHID:VGB_ADDR_PCHID_f"
				ab-autolabel="VTX_SCHH_SCHDE" 
				ab-autocomplete 
				ng-keyup="kUp('VGB_ADDR_PCHID_f','VTX_SCHH_SCHID','vtx_schh')"  
				ng-model="VGB_ADDR_PCHID_f"
				id="VGB_ADDR_PCHID_f"
				ab-toggle="VGB_ADDR_PCHID_fx"				
				size=5  value=""   />&nbsp;&nbsp;
			</td>
			<td alain>

				<div>
				<span class="text-muted" role="presentation" ng-model="VGB_ADDR_PCHID_f1X2" ng-repeat="x in mdta | AB_Compare:VGB_ADDR_PCHID:'idVTX_SCHH'">
					<span class="ab-hidden" role="presentation" id="VGB_ADDR_PCHID_fx" >{{x.VTX_SCHH_SCHID }}</span>
					{{ x.VTX_SCHH_SCHDE }}
				</span>
				</div>			
				


			</td>
			</tr>
			</table>
		</div>
		</td>
		</tr>
		</table>

		</div>
    	</div>
        
        </div>
      </div>
    </div>
  </div> 
</div>
</td></tr>

<?php
}
?>

</table>


<?php

if (strpos("X".$_SESSION["logged"],"NIALA") == 1)
{
?>
<script>
$("#ddebug").on("click",function(){
	
alert($("#VGB_CUST_BPART").attr("class")+"---")
});

</script>
<?php
}
?>

			