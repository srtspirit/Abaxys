<!-- stdPHPobjGen is std script to generate HTML
   class AB_objGen
   For now only two type of inputs are generated
   
   1 - Yes/No or True/False
   setYesNoField
   2 - Lister of foreign table data
   setListerField
   
   -->
<div class="ab-colors" >
   <span ng-model="vgb_ctyp" >
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
   ABinitTbl('vgb_ctyp','idVGB_CTYP');
   ABlstAlias('idVGB_CTYP','idVGB_CTYP','vgb_ctyp','lister');" >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVGB_CTYP;
$scope.ABinitTbl('vgb_ctyp','VGB_CTYP_CUTYP');
$scope.ABlstAlias('VGB_CTYP_CUTYP','VGB_CTYP_CUTYP','vgb_ctyp','lister');
$scope.ABupdChkObj('idVGB_CTYP',id,true);
$scope.ABupdChkObj('VGB_CTYP_CUTYP','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vgb_ctyp" ab-main="vgb_ctyp"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-6">
         <table class="table table-striped">
            <tr class="ab-border" >
               <td>
                  <a ng-click="ABupdChkObj('idVGB_CTYP','0',true);ABupdChkObj('VGB_CTYP_CUTYP','',false);ABchk();" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VGB_CTYP_CUTYP">Customer Type
                  </label>
               </td>
               <td><label ab-label="VGB_CTYP_DESCR">Type Description
                  </label>
               </td>
               
            </tr>
            <tr ng-repeat="xx in lister" class="{{xx.idVGB_CTYP!=idVGB_CTYP?'':'ab-active'}}">
               <td>
                  <a ng-click="ABupdChkObj('idVGB_CTYP',xx.idVGB_CTYP,true);ABupdChkObj('VGB_CTYP_CUTYP','',false);ABchk();" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VGB_CTYP_CUTYP}}
               </td>
               <td>
                  {{xx.VGB_CTYP_DESCR}}
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
                     <label class="btn-md"  ab-label="VGB_CTYP_CUTYP">Customer Type</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVGB_CTYP" />
                     <Input 	size=15 ng-model="VGB_CTYP_CUTYP" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_CTYP_DESCR">Type Description</label>
                  </td>
                  <td>
                     <Input 	size=20 ng-model="VGB_CTYP_DESCR" value="" />
                  </td>
               </tr>
              
            </table>
         </div>
      </div>
   </form>
</div>

