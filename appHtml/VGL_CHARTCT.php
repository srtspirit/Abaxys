<?php require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<?php require_once "../appCscript/VGL_FINANCE.php"; ?>

<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "STD_LABEL_EMPTY";
$sparm["searchTable"] = "vgl_chart";
// $sparm["searchJoin"] = "vgb_curr:idVGB_CURR = VGL_CHART_CURID";
$sparm["searchJoin"] = "vgb_curr,vgl_brch";

$sparm["orderBy"] = "VGL_CHART_GLIDN ASC";

$sparm["searchResult"] = "lister";
$sparm["searchFilter"] = "hidden";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "";
$sparm["callBack"] = "";

$chartLister = $xtmp->setSearchMaster($sparm);
?>
<div id="newChart" class="hidden">
	<a ng-click="chkChart(0);" >
	<span >New</span>
	<span class="glyphicon glyphicon-pencil" ></span>
	</a>
</div>
<script>
	$('#ab-appOpt').html($("#newChart").html());
	
</script>
	                 
<div class="ab-colors" >
   <span ng-model="vgl_chart" >
   <?php require_once "../stdCscript/stdDbButtons.php"; ?>
   </span>

</div>
<div class="row " 
   daata-neg-init="
   ABinitTbl('vgl_chart','idVGL_CHART');
   ABlstAlias('idVGL_CHART','idVGL_CHART','vgl_chart','lister');  
idVGB_CURR=0;
ABlst('idVGB_CURR','idVGB_CURR','vgb_curr',0);
idVGL_BRCH=0;
ABlst('idVGL_BRCH','idVGL_BRCH','vgl_brch',0);
   " >

   <textarea class="hidden" ab-updSuccess="" >
var id=$scope.idVGL_CHART;
$scope.ABinitTbl('vgl_chart','VGL_CHART_GLIDN');
$scope.ABlstAlias('VGL_CHART_GLIDN','VGL_CHART_GLIDN','vgl_chart','lister');
$scope.ABupdChkObj('idVGL_CHART',id,true);
$scope.ABupdChkObj('VGL_CHART_GLIDN','',false);
$scope.ABchk();
</textarea>
   <form id="mainForm" name="mainForm"  ab-view="vgl_chart" ab-main="vgl_chart"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
	<div class="col-lg-12"> 
		&nbsp;
	</div>

	<div class="col-lg-12"> 
	      <?php echo $chartLister; ?>   
	</div>
      <div class="col-lg-6">
         
            <div class="row ab-border ab-strong" >
               <div class="col-lg-2" ng-init="sortField='VGL_CHART_GLIDN';extraSort=''" >
			<div class="text-primary  ab-pointer " ng-click="extraSort=''" >
                  		<span ab-label="VGL_CHART00_GLIDN_SH"  ></span>
	                   	<span class="caret {{extraSort==''?'':'invisible'}}"></span> 
	                 </div>
               </div>
               <div class="col-lg-4" >
			<div class="text-primary  ab-pointer " ng-click="extraSort='VGL_CHART_GLDES'" >
                  		<span ab-label="STD_DESCR"  ></span>
	                   	<span class="caret {{extraSort=='VGL_CHART_GLDES'?'':'invisible'}}"></span> 
	                 </div>
               </div>
               <div class="col-lg-2" >
			<div class="text-primary  ab-pointer " ng-click="extraSort='VGL_CHART_GLTYP'" >
                  		<span ab-label="VGL_CHART00_GLTYP"  ></span>
	                   	<span class="caret {{extraSort=='VGL_CHART_GLTYP'?'':'invisible'}}"></span> 
	                 </div>
               </div>
               <div class="col-lg-2" >
			<div class="text-primary  ab-pointer " ng-click="extraSort='VGL_CHART_CURID'" >
                  		<span ab-label="STD_CURRENCY"  ></span>
	                   	<span class="caret {{extraSort=='VGL_CHART_CURID'?'':'invisible'}}"></span> 
	                 </div>
               </div>
               <div class="col-lg-2" >
			<div class="text-primary  ab-pointer " ng-click="extraSort='VGL_CHART_GLBID'" >
                  		<span ab-label="STD_BRANCH"  ></span>
	                   	<span class="caret {{extraSort=='VGL_CHART_GLBID'?'':'invisible'}}"></span> 
	                 </div>
               </div>
               
            </div>
           
           <div class=" ab-wrapper-div" >
            <div class="row ab-border "  ng-repeat="xx in rawResult.lister  | AB_Sorted:extraSort+','+sortField" class="{{xx.idVGL_CHART!=idVGL_CHART?'':'ab-active'}}">
            
              <div class="col-lg-2" >
                  <a  ng-click="chkChart(xx.idVGL_CHART);" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VGL_CHART_GLIDN}}
               </div>
               <div class="col-lg-4" >
                  {{xx.VGL_CHART_GLDES}}
               </div>
                <div class="col-lg-2" >
                  {{xx.VGL_CHART_GLTYP}}
               </div>
               <div class="col-lg-2" >
                 <span ng-repeat="y in vgb_curr" class="{{y.idVGB_CURR==xx.VGL_CHART_CURID?'':'hidden'}}">
						{{y.VGB_CURR_DESCR}}
					<span>
                  
               </div>
               <div class="col-lg-2" >
               <span ng-repeat="y in vgl_brch" class="{{y.idVGL_BRCH==xx.VGL_CHART_GLBID?'':'hidden'}}">
						{{y.VGL_BRCH_BRDES}}
					<span>
               </div>
            </div>
</div>
      </div>
      <div class="col-sm-6">
         <div id="chartEditor" class="hidden" style="position:fixed;padding:20px;" >
            <table class="table ab-border " >
               <tr>
                  <td colspan=2 class="ab-colors">
                  </td>
               </tr>
               <tr>
                  <td style="width:40%;">
                     <label class="btn-md"  ab-label="VGL_CHART_GLIDN">GL Account Number</label>
                  </td>
                  <td style="width:60%;">
                     <input  class="hidden" ng-model="idVGL_CHART" />
                     <Input 	size=15 ng-model="VGL_CHART_GLIDN" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGL_CHART_GLDES">GL Account Description</label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGL_CHART_GLDES" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGL_CHART_GLTYP">GL Account Type </label>
                  </td>
                  <td>
                     <Input size=20 ng-model="VGL_CHART_GLTYP" value="" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGL_CHART_CURID">Curency ID Code</label>
                  </td>
                  <td>
						<?php
						$keepOrg = 1; 
						$repeatIn = "vgb_curr";
						$searchIn = "";
						$refName = "vgb_curr"; // unique
						$refModel = "VGL_CHART_CURID"; // unique
						$repeatInRef = "idVGB_CURR"; //Unique
						$searchRefDesc = "";// implode("&nbsp;&nbsp;",array("{{VGB_CURR_CURID}}","{{VGB_CURR_DESCR}}"));
						$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_CURR_CURID}}","{{ab_rloop.VGB_CURR_DESCR}}"));
						$refDetail = "";
						$refDetailLink = "";
						$ignTrig = 'ng-click="' . "hold=VGB_CURR_CURID;VGB_CURR_CURID='';VGB_CURR_CURID_F='';ABlst('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0);VGB_CURR_CURID=hold;".'"';

						$tmp = new AB_objGen;
						$tmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
						?>
                  </td>
                  </td>
               </tr>
               <tr>
                  <td>
                     <label class="btn-md"  ab-label="VGL_CHART_GLBID">Branch Id</label>
                  </td>
                  <td>
                <?php
							$keepOrg = 1; 
							$repeatIn = "vgl_brch";
							$searchIn = "";
							$refName = "VGL_BRCH_GLBID"; // unique
							$refModel = "VGL_CHART_GLBID"; // unique
							$repeatInRef = "idVGL_BRCH"; //Unique
							$searchRefDesc = "";// implode("&nbsp;&nbsp;",array("{{VGB_CURR_CURID}}","{{VGB_CURR_DESCR}}"));
							$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGL_BRCH_GLBID}}","{{ab_rloop.VGL_BRCH_BRDES}}"));	
							$refDetail = "";
							$refDetailLink = "";
							$ignTrig = 'ng-click="' . "hold=VGL_BRCH_GLBID;VGL_BRCH_GLBID='';VGL_BRCH_GLBID_F='';ABlst('VGL_BRCH_GLBID','VGL_BRCH_GLBID','vgl_brch',0);VGL_BRCH_GLBID=hold;".'"';
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
