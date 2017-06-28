<!-- stdPHPobjGen is std script to generate HTML
   class AB_objGen
   For now only two type of inputs are generated
   
   1 - Yes/No or True/False
   setYesNoField
   2 - Lister of foreign table data
   setListerField
   -->
<div class="ab-colors" >
   <span ng-model="vgb_sour" >
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
   ABinitTbl('vgb_sour','idVGB_SOUR');
   ABlstAlias('idVGB_SOUR','idVGB_SOUR','vgb_sour','lister'); 
   " >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVGB_SOUR;
$scope.ABinitTbl('vgb_sour','VGB_SOUR_SOURC');
$scope.ABlstAlias('VGB_SOUR_SOURC','VGB_SOUR_SOURC','vgb_sour','lister');
$scope.ABupdChkObj('idVGB_SOUR',id,true);
$scope.ABupdChkObj('VGB_SOUR_SOURC','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vgb_sour" ab-main="vgb_sour"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-6">
         <table class="table table-striped">
            <tr class="ab-border" >
               <td>
                  <a ng-click="ABupdChkObj('idVGB_SOUR','0',true);ABupdChkObj('VGB_SOUR_SOURC','',false);ABchk();" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VGB_SOUR_SOURC">
                   	Source
                  </label>
               </td>
               <td><label ab-label="VGB_SOUR_DESCR">
               Description
                  </label>
               </td> 
            </tr>
            <tr ng-repeat="xx in lister" class="{{xx.idVGB_SOUR!=idVGB_SOUR?'':'ab-active'}}">
               <td>
                  <a ng-click="ABupdChkObj('idVGB_SOUR',xx.idVGB_SOUR,true);ABupdChkObj('VGB_SOUR_SOURC','',false);ABchk();" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VGB_SOUR_SOURC}}
               </td>
               <td>
                  {{xx.VGB_SOUR_DESCR}}
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
                     <label class="btn-md"  ab-label="VGB_SOUR_SOURC">Source</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVGB_SOUR" />
                     <Input 	size=15 ng-model="VGB_SOUR_SOURC" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_SOUR_DESCR">Description</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGB_SOUR_DESCR" value="" />
                  </td>
               </tr>
            </table>
         </div>
      </div>
   </form>
</div>