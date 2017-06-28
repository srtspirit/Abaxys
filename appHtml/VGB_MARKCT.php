<!-- stdPHPobjGen is std script to generate HTML
   class AB_objGen
   For now only two type of inputs are generated
   
   1 - Yes/No or True/False
   setYesNoField
   2 - Lister of foreign table data
   setListerField
   
   -->
<div class="ab-colors" >
   <span ng-model="vgb_mark" >
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
   ABinitTbl('vgb_mark','idVGB_MARK');
   ABlstAlias('idVGB_MARK','idVGB_MARK','vgb_mark','lister');" >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVGB_MARK;
$scope.ABinitTbl('vgb_mark','VGB_MARK_MRKID');
$scope.ABlstAlias('VGB_MARK_MRKID','VGB_MARK_MRKID','vgb_mark','lister');
$scope.ABupdChkObj('idVGB_MARK',id,true);
$scope.ABupdChkObj('VGB_MARK_MRKID','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vgb_mark" ab-main="vgb_mark"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-6">
         <table class="table table-striped">
            <tr class="ab-border" >
               <td>
                  <a ng-click="ABupdChkObj('idVGB_MARK','0',true);ABupdChkObj('VGB_MARK_MRKID','',false);ABchk();" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VGB_MARK_MRKID">
                  Market ID
                  </label>
               </td>
               <td><label ab-label="VGB_MARK_DESCR">
               Market Description
                  </label>
               </td>
               
            </tr>
            <tr ng-repeat="xx in lister" class="{{xx.idVGB_MARK!=idVGB_MARK?'':'ab-active'}}">
               <td>
                  <a ng-click="ABupdChkObj('idVGB_MARK',xx.idVGB_MARK,true);ABupdChkObj('VGB_MARK_MRKID','',false);ABchk();" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VGB_MARK_MRKID}}
               </td>
               <td>
                  {{xx.VGB_MARK_DESCR}}
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
                     <label class="btn-md"  ab-label="VGB_MARK_MRKID">Market ID</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVGB_MARK" />
                     <Input 	size=15 ng-model="VGB_MARK_MRKID" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_MARK_DESCR">Market Description</label>
                  </td>
                  <td>
                     <Input 	size=20 ng-model="VGB_MARK_DESCR" value="" />
                  </td>
               </tr>
              
            </table>
         </div>
      </div>
   </form>
</div>

