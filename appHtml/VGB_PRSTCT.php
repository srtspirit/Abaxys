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
   <span ng-model="vgb_prst" >
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
   ABinitTbl('vgb_prst','idVGB_PRST');
   ABlstAlias('idVGB_PRST','idVGB_PRST','vgb_prst','lister');
idVTX_SCHH=0;
ABlst('idVTX_SCHH','idVTX_SCHH','vtx_schh',0);   
   " >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVGB_PRST;
$scope.ABinitTbl('vgb_prst','VGB_PRST_PRSID');
$scope.ABlstAlias('VGB_PRST_PRSID','VGB_PRST_PRSID','vgb_prst','lister');
$scope.ABupdChkObj('idVGB_PRST',id,true);
$scope.ABupdChkObj('VGB_PRST_PRSID','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vgb_prst" ab-main="vgb_prst"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-6">
         <table class="table table-striped">
            <tr class="ab-border" >
               <td>
                  <a ng-click="ABupdChkObj('idVGB_PRST','0',true);ABupdChkObj('VGB_PRST_PRSID','',false);ABchk();" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VGB_PRST_PRSID">
                   	Province State ID
                  </label>
               </td>
               <td><label ab-label="VGB_PRST_DESCR">
               Province/State Name
                  </label>
               </td>
               <td><label ab-label="VGB_PRST_SCHID">
               (Sales) Tax Scheme Code
                  </label>
               </td>
               <td><label ab-label="VGB_PRST_PCHID">
               (Purchase) Tax Scheme
                  </label>
               </td>
               
            </tr>
            <tr ng-repeat="xx in lister" class="{{xx.idVGB_PRST!=idVGB_PRST?'':'ab-active'}}">
               <td>
                  <a ng-click="ABupdChkObj('idVGB_PRST',xx.idVGB_PRST,true);ABupdChkObj('VGB_PRST_PRSID','',false);ABchk();" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VGB_PRST_PRSID}}
               </td>
               <td>
                  {{xx.VGB_PRST_DESCR}}
               </td>
                <td>
                <span ng-repeat="y in vtx_schh" class="{{y.idVTX_SCHH==xx.VGB_PRST_SCHID?'':'hidden'}}">
						{{y.VTX_SCHH_SCHDE}}
					<span>
               </td>
                <td>
                <span ng-repeat="y in vtx_schh" class="{{y.idVTX_SCHH==xx.VGB_PRST_PCHID?'':'hidden'}}">
						{{y.VTX_SCHH_SCHDE}}
					<span>	
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
                     <label class="btn-md"  ab-label="VGB_PRST_PRSID">Province State ID</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVGB_PRST" />
                     <Input 	size=15 ng-model="VGB_PRST_PRSID" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_PRST_SCHID">Province/State Name</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGB_PRST_DESCR" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_PRST_SCHID">(Sales) Tax Scheme Code</label>
                  </td>
                  <td>
                 <?php
							$keepOrg = 1; 
							$repeatIn = "vtx_schh";
							$searchIn = "";
							$refName = "VTX_SCHH_SCHID"; // unique
							$refModel = "VGB_PRST_SCHID"; // unique
							$repeatInRef = "idVTX_SCHH"; //Unique
							$searchRefDesc = "";// implode("&nbsp;&nbsp;",array("{{VGB_CURR_CURID}}","{{VGB_CURR_DESCR}}"));
							$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VTX_SCHH_SCHDE}}"));	
							$refDetail = "";
							$refDetailLink = "";
							$ignTrig = 'ng-click="' . "hold=;VTX_SCHH_SCHDE='';VTX_SCHH_SCHDE_F='';ABlst('VTX_SCHH_SCHDE','VTX_SCHH_SCHDE','vtx_schh',0);VTX_SCHH_SCHDE=hold;".'"';
							$tmp = new AB_objGen;
							$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
                 ?>
                  </td>
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGB_PRST_PCHID">(Purchase) Tax Scheme</label>
                  </td>
                  <td>
                <?php
							$keepOrg = 1; 
							$repeatIn = "vtx_schh";
							$searchIn = "";
							$refName = "VTX_SCHH_SCHDE"; // unique
							$refModel = "VGB_PRST_PCHID"; // unique
							$repeatInRef = "idVTX_SCHH"; //Unique
							$searchRefDesc = "";// implode("&nbsp;&nbsp;",array("{{VGB_CURR_CURID}}","{{VGB_CURR_DESCR}}"));
							$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VTX_SCHH_SCHDE}}"));	
							$refDetail = "";
							$refDetailLink = "";
							$ignTrig = 'ng-click="' . "hold=VTX_SCHH_SCHDE;VTX_SCHH_SCHDE='';VTX_SCHH_SCHDE_F='';ABlst('VTX_SCHH_SCHDE','VTX_SCHH_SCHDE','vtx_schh',0);VTX_SCHH_SCHDE=hold;".'"';
							$tmp = new AB_objGen;
							$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
                 ?>
                  
                  </td>
               </tr>
            </table>
         </div>
      </div>
   </form>
</div>