<!-- stdPHPobjGen is std script to generate HTML
   class AB_objGen
   For now only two type of inputs are generated
   
   1 - Yes/No or True/False
   setYesNoField
   2 - Lister of foreign table data
   setListerField
   
   -->
<div class="ab-colors" >
   <span ng-model="vgb_slrp" >
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
   ABinitTbl('vgb_slrp','idVGB_SLRP');
   ABlstAlias('idVGB_SLRP','idVGB_SLRP','vgb_slrp','lister');" >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVGB_SLRP;
$scope.ABinitTbl('vgb_slrp','VGB_SLRP_SLSRP');
$scope.ABlstAlias('VGB_SLRP_SLSRP','VGB_SLRP_SLSRP','vgb_slrp','lister');
$scope.ABupdChkObj('idVGB_SLRP',id,true);
$scope.ABupdChkObj('VGB_SLRP_SLSRP','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vgb_slrp" ab-main="vgb_slrp"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-6">
         <table class="table table-striped">
            <tr class="ab-border" >
               <td>
                  <a ng-click="ABupdChkObj('idVGB_SLRP','0',true);ABupdChkObj('VGB_SLRP_SLSRP','',false);ABchk();" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VGB_SLRP_SLSRP">
                  Sales Representative ID code
                  </label>
               </td>
               <td><label ab-label="VGB_SLRP_SRNAM">
               Sales Rep Name
                  </label>
               </td>
               <td><label ab-label="VGB_SLRP_SRCOR">
               Sales Rep Commission Rate
                  </label>
               </td>
            </tr>
            <tr ng-repeat="xx in lister" class="{{xx.idVGB_SLRP!=idVGB_SLRP?'':'ab-active'}}">
               <td>
                  <a ng-click="ABupdChkObj('idVGB_SLRP',xx.idVGB_SLRP,true);ABupdChkObj('VGB_SLRP_SLSRP','',false);ABchk();" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VGB_SLRP_SLSRP}}
               </td>
               <td>
                  {{xx.VGB_SLRP_SRNAM}}
               </td>
                <td>
                  {{xx.VGB_SLRP_SRCOR}}
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
                     <label class="btn-md"  ab-label="VGB_SLRP_SLSRP">Sales Representative ID code</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVGB_SLRP" />
                     <Input 	size=15 ng-model="VGB_SLRP_SLSRP" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_SLRP_SRNAM">Sales Rep Name</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGB_SLRP_SRNAM" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_SLRP_SRCOR">Sales Rep Commission Rate</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGB_SLRP_SRCOR" value="" />
                  </td>
               </tr>
              
            </table>
         </div>
      </div>
   </form>
</div>

