<?php  require_once "../stdSscript/stdPHPobjGen.php"; ?>
<!-- stdPHPobjGen is std script to generate HTML
   class AB_objGen
   For now only two type of inputs are generated
   
   1 - Yes/No or True/False
   setYesNoField
   2 - Lister of foreign table data
   setListerField
   -->
<div class="ab-colors" >
   <span ng-model="vin_locs" >
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
   ABinitTbl('vin_locs','idVIN_LOCS');
   ABlstAlias('idVIN_LOCS','idVIN_LOCS','vin_locs','lister');
idVIN_WARS=0;
ABlst('idVIN_WARS','idVIN_WARS','vin_wars',0);   
   " >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVIN_LOCS;
$scope.ABinitTbl('vin_locs','VIN_LOCS_WARID');
$scope.ABlstAlias('VIN_LOCS_WARID','VIN_LOCS_WARID','vin_locs','lister');
$scope.ABupdChkObj('idVIN_LOCS',id,true);
$scope.ABupdChkObj('VIN_LOCS_WARID','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vin_locs" ab-main="vin_locs"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-6">
         <table class="table table-striped">
            <tr class="ab-border" >
               <td>
                  <a ng-click="ABupdChkObj('idVIN_LOCS','0',true);ABupdChkObj('VIN_LOCS_WARID','',false);ABchk();" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VIN_LOCS_WARID">
                   	 	Warehouse ID code
                  </label>
               </td>
               <td><label ab-label="VIN_LOCS_LOCID">
               Location ID
                  </label>
               </td>
               <td><label ab-label="VIN_LOCS_DESCR">
               Description
                  </label>
               </td>
               
            </tr>
            <tr ng-repeat="xx in lister" class="{{xx.idVIN_LOCS!=idVIN_LOCS?'':'ab-active'}}">
               <td>
                  <a ng-click="ABupdChkObj('idVIN_LOCS',xx.idVIN_LOCS,true);ABupdChkObj('VIN_LOCS_WARID','',false);ABchk();" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                   <span ng-repeat="y in vin_wars" class="{{y.idVIN_WARS==xx.VIN_LOCS_WARID?'':'hidden'}}">
						{{y.VIN_WARS_WARID}}
					<span>
               </td>
               <td>
                  {{xx.VIN_LOCS_LOCID}}
               </td>
                <td>
                  {{xx.VIN_LOCS_DESCR}}
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
                     <label class="btn-md"  ab-label="VIN_LOCS_WARID">Warehouse ID code</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVIN_LOCS" />
                    <?php
							$keepOrg = 1; 
							$repeatIn = "vin_wars";
							$searchIn = "";
							$refName = "VIN_WARS_WARID"; // unique
							$refModel = "VIN_LOCS_WARID"; // unique
							$repeatInRef = "idVIN_WARS"; //Unique
							$searchRefDesc = "";// implode("&nbsp;&nbsp;",array("{{VGB_CURR_CURID}}","{{VGB_CURR_DESCR}}"));
							$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_WARS_WARID}}"));	
							$refDetail = "";
							$refDetailLink = "";
							$ignTrig = 'ng-click="' . "hold=;VIN_WARS_WARID='';VIN_WARS_WARID_F='';ABlst('VIN_WARS_WARID','VIN_WARS_WARID','vin_wars',0);VIN_WARS_WARID=hold;".'"';
							$tmp = new AB_objGen;
							$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
                 ?>
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VIN_LOCS_LOCID">Location ID</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VIN_LOCS_LOCID" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VIN_LOCS_DESCR">Description</label>
                  </td>
                  <td>
                 	 <Input size=20 ng-model="VIN_LOCS_DESCR" value="" />
                  </td>
                 
               </tr>
               
            </table>
         </div>
      </div>
   </form>
</div>