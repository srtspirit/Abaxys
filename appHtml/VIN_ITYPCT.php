<!-- stdPHPobjGen is std script to generate HTML
   class AB_objGen
   For now only two type of inputs are generated
   
   1 - Yes/No or True/False
   setYesNoField
   2 - Lister of foreign table data
   setListerField
   -->
<div class="ab-colors" >
   <span ng-model="vin_ityp" >
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
   ABinitTbl('vin_ityp','idVIN_ITYP');
   ABlstAlias('idVIN_ITYP','idVIN_ITYP','vin_ityp','lister'); 
   " >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVIN_ITYP;
$scope.ABinitTbl('vin_ityp','VIN_ITYP_ITYPE');
$scope.ABlstAlias('VIN_ITYP_ITYPE','VIN_ITYP_ITYPE','vin_ityp','lister');
$scope.ABupdChkObj('idVIN_ITYP',id,true);
$scope.ABupdChkObj('VIN_ITYP_ITYPE','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vin_ityp" ab-main="vin_ityp"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-6">
         <table class="table table-striped">
            <tr class="ab-border" >
               <td>
                  <a ng-click="ABupdChkObj('idVIN_ITYP','0',true);ABupdChkObj('VIN_ITYP_ITYPE','',false);ABchk();" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VIN_ITYP_ITYPE">
                   	Item Types
                  </label>
               </td>
               <td><label ab-label="VIN_ITYP_DESCR">
               Alpha 30 Lower
                  </label>
               </td> 
            </tr>
            <tr ng-repeat="xx in lister" class="{{xx.idVIN_ITYP!=idVIN_ITYP?'':'ab-active'}}">
               <td>
                  <a ng-click="ABupdChkObj('idVIN_ITYP',xx.idVIN_ITYP,true);ABupdChkObj('VIN_ITYP_ITYPE','',false);ABchk();" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VIN_ITYP_ITYPE}}
               </td>
               <td>
                  {{xx.VIN_ITYP_DESCR}}
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
                     <label class="btn-md"  ab-label="VIN_ITYP_ITYPE">Item Types</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVIN_ITYP" />
                     <Input 	size=15 ng-model="VIN_ITYP_ITYPE" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VIN_ITYP_DESCR">Alpha 30 Lower</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VIN_ITYP_DESCR" value="" />
                  </td>
               </tr>
            </table>
         </div>
      </div>
   </form>
</div>