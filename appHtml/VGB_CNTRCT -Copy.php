
<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>
<!-- stdPHPobjGen is std script to generate HTML

class AB_objGen
For now only two type of inputs are generated

1 - Yes/No or True/False
setYesNoField
2 - Lister of foreign table data
setListerField

-->


<div class="ab-colors" >
	<span ng-model="vgb_cntr" >
		<?php require_once "../stdCscript/stdDbButtons.php"; ?>
	</span>
	
<!-- stdDbButtons contain all update buttons (New - Upd - Del - Share) and has a back button
The display is initialized by ABclearUpdButtons  and ABinitTbl  - displays back button only
The display of proper update buttons is maintained by ABchk() automaticly
All update button call the standard function ABupd() 
-->	
	
</div>

<div class="row mygrid-wrapper-div" 
data-ng-init="
ABinitTbl('vgb_cntr','idVGB_CNTR');
ABlstAlias('idVGB_CNTR','idVGB_CNTR','vgb_cntr','lister');
idVGB_CURR=0;
ABlst('idVGB_CURR','idVGB_CURR','vgb_curr',0);
" >
<!--
Angular data-ng-init - Optional but needed
If present will execute the $scope functions

-->


<textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVGB_CNTR;
$scope.ABinitTbl('vgb_cntr','VGB_CNTR_CNTID');
$scope.ABlstAlias('VGB_CNTR_CNTID','VGB_CNTR_CNTID','vgb_cntr','lister');
$scope.ABupdChkObj('idVGB_CNTR',id,true);
$scope.ABupdChkObj('VGB_CNTR_CNTID','',false);
$scope.ABchk();
</textarea>
<!--
Attribute ab-updSuccess - Optional
If present and ABupd is successfull
ABupd() will execute (eval) the value of the object

Note that $scope needs to be in the code as opposed to data-ng-init= above
-->


	<form id="mainForm" name="mainForm"  ab-view="vgb_cntr" ab-main="vgb_cntr"  >
<!--
ab-main="vgb_cntr" mandatory
Instructs update process main table to update
-->


		<div class="col-sm-6">

			<table class="table table-striped">
				<tr class="ab-border" >
					<td>
				 		<a ng-click="ABupdChkObj('idVGB_CNTR','0',true);ABupdChkObj('VGB_CNTR_CNTID','',false);ABchk();" >
 				 		
							<span >New</span>
							<span  class="glyphicon glyphicon-pencil" ></span>
							
						</a>
						&nbsp;&nbsp;							
						<label ab-label="VGB_CNTR_CNTID">
						</label>
					</td>	
					<td><label ab-label="VGB_CNTR_DESCR">
					</label></td>	
					<td><label ab-label="STD_CURRENCY">
					</label></td>	
				</tr>	
				<tr ng-repeat="xx in lister" class="{{xx.idVGB_CNTR!=idVGB_CNTR?'':'ab-active'}}">
					<td>
 				 		<a ng-click="ABupdChkObj('idVGB_CNTR',xx.idVGB_CNTR,true);ABupdChkObj('VGB_CNTR_CNTID','',false);ABchk();" >
 				 		
							<span >Edit</span>
							<span  class="glyphicon glyphicon-pencil" ></span>
							
						</a>
						&nbsp;&nbsp;				
						{{xx.VGB_CNTR_CNTID}}
					</td>	
					<td>
						{{xx.VGB_CNTR_DESCR}}
					</td>	
					<td>
					<span ng-repeat="y in vgb_curr" class="{{y.idVGB_CURR==xx.VGB_CNTR_CURID?'':'hidden'}}">
						{{y.VGB_CURR_DESCR}}
					<span>	
					</td>
				</tr>
			</table>				

		</div>

		<div class="col-sm-6">
		
			<div style="position:fixed;padding:20px;" >
			<table class="table ab-border " >
			
				<tr>
					<td colspan=2 class="ab-colors">
					</td>
				</tr>

				<tr>
					<td style="width:40%;">
						<label class="btn-md"  ab-label="VGB_CNTR_CNTID">Ctnr</label>
					</td>
					
					<td style="width:60%;">
						<input  class="hidden" ng-model="idVGB_CNTR" />
						<Input 	size=5 ng-model="VGB_CNTR_CNTID" value="" />
									
					</td>
				</tr>
				<tr>
					<td>
						<label class="btn-md"  ab-label="VGB_CNTR_DESCR">desc</label>
					</td>
					
					<td>
						<Input 	size=10 ng-model="VGB_CNTR_DESCR" value="" />
									
					</td>
				</tr>

			<tr>
			<td>
				<label class="btn-md"   ab-label="VGB_CUST_CURID">VGB_CUST_CURID</label>
			</td>
			<td>

<?php
$keepOrg = 1; 
$repeatIn = "vgb_curr";
$searchIn = "";
$refName = "vgb_curr"; // unique
$refModel = "VGB_CNTR_CURID"; // unique
$repeatInRef = "idVGB_CURR"; //Unique
$searchRefDesc = "";// implode("&nbsp;&nbsp;",array("{{VGB_CURR_CURID}}","{{VGB_CURR_DESCR}}"));
$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_CURR_CURID}}","{{ab_rloop.VGB_CURR_DESCR}}"));
$refDetail = "";
$refDetailLink = "";
$ignTrig = 'ng-click="' . "hold=VGB_CURR_CURID;VGB_CURR_CURID='';VGB_CURR_CURID_F='';ABlst('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0);VGB_CURR_CURID=hold;".'"';

$tmp = new AB_objGen;
$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
?>
				</td>
				</tr>
			
			</table>
			</div>
		</div>
	</form>
</div>	
