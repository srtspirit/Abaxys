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
   <span ng-model="vgb_curr" >
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
   ABinitTbl('vgb_curr','idVGB_CURR');
   ABlstAlias('idVGB_CURR','idVGB_CURR','vgb_curr','lister');" >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVGB_CURR;
$scope.ABinitTbl('vgb_curr','VGB_CURR_CURID');
$scope.ABlstAlias('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr','lister');
$scope.ABupdChkObj('idVGB_CURR',id,true);
$scope.ABupdChkObj('VGB_CURR_CURID','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vgb_curr" ab-main="vgb_curr"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-6">
         <table class="table table-striped">
            <tr class="ab-border" >
               <td>
                  <a ng-click="ABupdChkObj('idVGB_CURR','0',true);ABupdChkObj('VGB_CURR_CURID','',false);ABchk();" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VGB_CURR_CURID">
                   	Currency ID Code
                  </label>
               </td>
               <td><label ab-label="VGB_CURR_DESCR">
               Currency Description
                  </label>
               </td>
               <td><label ab-label="VGB_CURR_CURAT">
               Curency Rate
                  </label>
               </td>
               <td><label ab-label="VGB_CURR_RADAT">
               Rate Date
                  </label>
               </td>
               
            </tr>
            <tr ng-repeat="xx in lister" class="{{xx.idVGB_CURR!=idVGB_CURR?'':'ab-active'}}">
               <td>
                  <a ng-click="ABupdChkObj('idVGB_CURR',xx.idVGB_CURR,true);ABupdChkObj('VGB_CURR_CURID','',false);ABchk();" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VGB_CURR_CURID}}
               </td>
               <td>
                  {{xx.VGB_CURR_DESCR}}
               </td>
                <td>
                  {{xx.VGB_CURR_CURAT}}
               </td>
                <td>
                  {{xx.VGB_CURR_RADAT}}
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
                     <label class="btn-md"  ab-label="VGB_CURR_CURID">Currency ID Code</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVGB_CURR" />
                     <Input 	size=15 ng-model="VGB_CURR_CURID" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_CURR_DESCR">Currency Description</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGB_CURR_DESCR" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_CURR_CURAT">Curency Rate</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGB_CURR_CURAT" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_CURR_RADAT">Rate Date</label>
                  </td>
                  <td>

                    <!-- <Input size=20 ng-model="VGB_CURR_RADAT" placeholder="yyyy-MM-dd" ui-date="dateOptions" value="" />-->
                <?php $tmp = new AB_objGen;
							 $tmp->setDatePick("VGB_CURR_RADAT"); ?>
                  </td>
               </tr>
            </table>
         </div>
      </div>
   </form>
</div>