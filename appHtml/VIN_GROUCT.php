<!-- stdPHPobjGen is std script to generate HTML
   class AB_objGen
   For now only two type of inputs are generated
   
   1 - Yes/No or True/False
   setYesNoField
   2 - Lister of foreign table data
   setListerField
   -->
<div >
   <span ng-model="vin_grou" >
   <?php require_once "../stdCscript/stdFormButtons.php"; ?>
   </span>
   <!-- stdDbButtons contain all update buttons (New - Upd - Del - Share) and has a back button
      The display is initialized by ABclearUpdButtons  and ABinitTbl  - displays back button only
      The display of proper update buttons is maintained by ABchk() automaticly
      All update button call the standard function ABupd() 
      -->	
</div>
<div class="row mygrid-wrapper-div" 
   data-ng-init="
   ABinitTbl('vin_grou','idVIN_GROU');
   ABlstAlias('idVIN_GROU','idVIN_GROU','vin_grou','lister'); 
   " >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVIN_GROU;
$scope.ABinitTbl('vin_grou','VIN_GROU_ITGRP');
$scope.ABlstAlias('VIN_GROU_ITGRP','VIN_GROU_ITGRP','vin_grou','lister');
$scope.ABupdChkObj('idVIN_GROU',id,true);
$scope.ABupdChkObj('VIN_GROU_ITGRP','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vin_grou" ab-main="vin_grou"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-6">
         <table class="table table-striped">
            <tr class="ab-border" >
               <td>
                  <a ng-click="ABupdChkObj('idVIN_GROU','0',true);ABupdChkObj('VIN_GROU_ITGRP','',false);ABchk();" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VIN_GROU_ITGRP">
                   	Item Group
                  </label>
               </td>
               <td><label ab-label="VIN_GROU_DESCR">
               Description
                  </label>
               </td> 
            </tr>
            <tr ng-repeat="xx in lister" class="{{xx.idVIN_GROU!=idVIN_GROU?'':'ab-active'}}">
               <td>
                  <a ng-click="ABupdChkObj('idVIN_GROU',xx.idVIN_GROU,true);ABupdChkObj('VIN_GROU_ITGRP','',false);ABchk();" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VIN_GROU_ITGRP}}
               </td>
               <td>
                  {{xx.VIN_GROU_DESCR}}
               </td>
            </tr>
         </table>
      </div>
      <div class="col-sm-6">
         <div style="position:fixed;padding:20px;" >
            <table class="table ab-border " >
               <tr>
                  <td colspan=2 class="ab-colors">
                  	<input class="hidden" ab-btrigger="vin_grou" ng-model="idVIN_GROU" />
                  </td>
               </tr>
               <tr>
                  <td style="width:40%;">
                     <label class="btn-md"  ab-label="VIN_GROU_ITGRP">Source</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVIN_GROU" />
                     <Input 	size=5 ng-model="VIN_GROU_ITGRP" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VIN_GROU_DESCR">Description</label>
                  </td>
                  <td>
                     <Input size=15 ng-model="VIN_GROU_DESCR" value="" />
                  </td>
               </tr>
            </table>
         </div>
      </div>
   </form>
</div>