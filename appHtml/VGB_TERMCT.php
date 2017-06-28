<!-- stdPHPobjGen is std script to generate HTML
   class AB_objGen
   For now only two type of inputs are generated
   
   1 - Yes/No or True/False
   setYesNoField
   2 - Lister of foreign table data
   setListerField
   -->
<div class="ab-colors" >
   <span ng-model="vgb_term" >
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
   ABinitTbl('vgb_term','idVGB_TERM');
   ABlstAlias('idVGB_TERM','idVGB_TERM','vgb_term','lister');" >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVGB_TERM;
$scope.ABinitTbl('vgb_term','VGB_TERM_TERID');
$scope.ABlstAlias('VGB_TERM_TERID','VGB_TERM_TERID','vgb_term','lister');
$scope.ABupdChkObj('idVGB_TERM',id,true);
$scope.ABupdChkObj('VGB_TERM_TERID','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vgb_term" ab-main="vgb_term"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-6">
         <table class="table table-striped">
            <tr class="ab-border" >
               <td>
                  <a ng-click="ABupdChkObj('idVGB_TERM','0',true);ABupdChkObj('VGB_TERM_TERID','',false);ABchk();" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VGB_TERM_TERID">
                   	Term
                  </label>
               </td>
               <td><label ab-label="VGB_TERM_DESCR">
               Term Description
                  </label>
               </td>
               <td><label ab-label="VGB_TERM_NETDA">
               Net Days
                  </label>
               </td>
               <td><label ab-label="VGB_TERM_DISDA">
               Discount Days
                  </label>
               </td>
               <td><label ab-label="VGB_TERM_DISCN">
               Discount %
                  </label>
               </td>
            </tr>
            <tr ng-repeat="xx in lister" class="{{xx.idVGB_TERM!=idVGB_TERM?'':'ab-active'}}">
               <td>
                  <a ng-click="ABupdChkObj('idVGB_TERM',xx.idVGB_TERM,true);ABupdChkObj('VGB_TERM_TERID','',false);ABchk();" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VGB_TERM_TERID}}
               </td>
               <td>
                  {{xx.VGB_TERM_DESCR}}
               </td>
                <td>
                  {{xx.VGB_TERM_NETDA}}
               </td>
                <td>
                  {{xx.VGB_TERM_DISDA}}
               </td>
               <td>
                  {{xx.VGB_TERM_DISCN}}
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
                     <label class="btn-md"  ab-label="VGB_TERM_TERID">Term</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVGB_TERM" />
                     <Input 	size=15 ng-model="VGB_TERM_TERID" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_TERM_DESCR">Term Description</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGB_TERM_DESCR" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_TERM_NETDA">Net Days</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGB_TERM_NETDA" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_TERM_DISDA">Discount Days</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGB_TERM_DISDA" value="" />
                  </td>
               </tr>
                <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_TERM_DISCN">Discount %</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGB_TERM_DISCN" value="" />
                  </td>
               </tr>
              
            </table>
         </div>
      </div>
   </form>
</div>