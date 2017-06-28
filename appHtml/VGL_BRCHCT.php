<!-- stdPHPobjGen is std script to generate HTML
   class AB_objGen
   For now only two type of inputs are generated
   
   1 - Yes/No or True/False
   setYesNoField
   2 - Lister of foreign table data
   setListerField
   -->
<div class="ab-colors" >
   <span ng-model="vgl_brch" >
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
   ABinitTbl('vgl_brch','idVGL_BRCH');
   ABlstAlias('idVGL_BRCH','idVGL_BRCH','vgl_brch','lister'); 
   " >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVGL_BRCH;
$scope.ABinitTbl('vgl_brch','VGL_BRCH_GLBID');
$scope.ABlstAlias('VGL_BRCH_GLBID','VGL_BRCH_GLBID','vgl_brch','lister');
$scope.ABupdChkObj('idVGL_BRCH',id,true);
$scope.ABupdChkObj('VGL_BRCH_GLBID','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vgl_brch" ab-main="vgl_brch"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-6">
         <table class="table table-striped">
            <tr class="ab-border" >
               <td>
                  <a ng-click="ABupdChkObj('idVGL_BRCH','0',true);ABupdChkObj('VGL_BRCH_GLBID','',false);ABchk();" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VGL_BRCH_GLBID">
                   	Branch Id
                  </label>
               </td>
               <td><label ab-label="VGL_BRCH_BRDES">
               Branch Description
                  </label>
               </td> 
            </tr>
            <tr ng-repeat="xx in lister" class="{{xx.idVGL_BRCH!=idVGL_BRCH?'':'ab-active'}}">
               <td>
                  <a ng-click="ABupdChkObj('idVGL_BRCH',xx.idVGL_BRCH,true);ABupdChkObj('VGL_BRCH_GLBID','',false);ABchk();" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VGL_BRCH_GLBID}}
               </td>
               <td>
                  {{xx.VGL_BRCH_BRDES}}
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
                     <label class="btn-md"  ab-label="VGL_BRCH_GLBID">Branch Id</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVGL_BRCH" />
                     <Input 	size=15 ng-model="VGL_BRCH_GLBID" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGL_BRCH_BRDES">Branch Description</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGL_BRCH_BRDES" value="" />
                  </td>
               </tr>
            </table>
         </div>
      </div>
   </form>
</div>