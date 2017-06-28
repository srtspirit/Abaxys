<?php 
ini_set('display_errors', 0);
session_start();
ob_clean();

include "../appCscript/VGB_PARTNERS.php";

?>

<div class='btn-sm ab-body-buttons' id="ab-header" style="white-space:nowrap;">


<span ng-model="vgb_addr" ng-include="'stdCscript/stdDbButtons.php'"></span>

</div>

<script>
	if (A_ReporterFn.reportRaw.indexOf(",VGB_ADDRCT") == -1)
	{ 	
		A_ReporterFn.reportRaw += ",VGB_ADDRCT";
		A_ReporterFn.reportBuffer.VGB_ADDRCT = "VGB_ADDRCT";
	}



A_Reporter.prototype.getProp = function (obj,propName)
{
	
alert("ADDR PROPS " + A_ReporterFn.reportRaw + " --- " + showProps(A_ReporterFn.reportBuffer,'rB'));

}


function getTableUsage()
{
	alert("Addresses");
}
function setLocalScope()
{
	
}

</script>


<form id="mainForm" href="#vgb_addrct/{{idVGB_ADDR}}/{{idVGB_BPAR}}/{{VGB_BPAR_BPART}} - {{VGB_BPAR_BPNAM}}/{{UPDATE"
 ab-main="vgb_addr" >



<div class="row mygrid-wrapper-div">
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
				<input a_iref="02-60"
				size=2
				lval=""
				ng-keypress="valDta('VGB_ADDR_BPART,VGB_ADDR_ADDID','vgb_addr',$event);"
				ng-blur="valDta('VGB_ADDR_BPART,VGB_ADDR_ADDID','vgb_addr',$event);"
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
					      	
					      	<tr ng-repeat="y in x.xtra">
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

</form>
