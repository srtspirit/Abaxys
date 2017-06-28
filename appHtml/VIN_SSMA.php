<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VIN_SSMA.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>
</div>
<div class="hidden" ng-init="SESSION_DESCR='Product Spec Sheet Control'">
	<span ab-label="VIN_SSMACT"></span>
</div>
<div id="ab-new" class="hidden" >
	<label  title="CREATE" class="">
		 <a href="#VIN_ITEMS/VIN_SSMACT/Process:VIN_ITEMS,Session:VIN_SSMACT,tblName:vin_ssma,updType:CREATE,idVIN_SSMA:0,VIN_SSMA_SPEID:,tbData:{{tbData}}" >
			 <span >New</span>
			 <span  class="glyphicon glyphicon-pencil" ></span>
	    </a>			
	</label>
</div>
<script>
	$('#ab-buttonPad').html('&nbsp;&nbsp;' + $('#ab-new').html());
	$('#ab-new').html('');
</script>
<div style="margin-left:5px;">
	<div id="mainForm" ab-main="vin_ssma" style="margin:0px;">
		<div class="row">
			<div class="col-sm-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
			<div class="col-sm-3">
				<table>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<?php
	$xtmp = new appForm("VIN_SSMA");
	$hardCode = <<<BOD
			<div>
				<span ab-empty="{{tbData=='vin_ssma'?'vin_ssma':'Yes'}}"
				class="" >
					<input a_iref="02-60"
							size=15
							lval=""
							ng-keyup="kPress('VIN_SSMA_SPEID','VIN_SSMA_SPEID','vin_ssma ',0);"
							ng-blur="kPress('VIN_SSMA_SPEID','VIN_SSMA_SPEID','vin_ssma ',0);"
							ng-model="VIN_SSMA_SPEID" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>
	
				</span>
			</div>
BOD;
$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="{{tbData=='vin_ssma '?'VIN_SSMA_SPEID':'VIN_SSMA_SPEID'}}";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;

$xtmp->setFieldWrapper("view01","0.0","vin_ssma ","VIN_SSMA_SPEID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>						
						</td>					
					</tr>				
				</table>
			</div>
		</div>
  <div>
  	<table class="table table-condensed" style="width:95%;">
	<tr>
		<td class=" ab-spaceless">
			<div class="row ab-listhead bg-primary"  >
			<?php
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-1";
			$laAttr = $xtmp->laAttrib;
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_ssma","","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
						
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="{{tbData=='vin_ssma '?'VIN_SSMA_SPEID':'VIN_SSMA_SPEID'}}";
			$laAttr["class"] .= "bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_ssma","VIN_SSMA_SPEID","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_SSMA_DESCR";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_ssma","VIN_SSMA_DESCR","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_SSMA_SUETA";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_ssma","VIN_SSMA_SUETA","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_SSMA_SHLIF";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_ssma","VIN_SSMA_SHLIF","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;

			?>
			</div>
		</td>
		</tr>	
	</table>
</div>
<div class="mygrid-wrapper-div"  style="margin:0px;padding:0px;">
	<div>
		<table class="" >
	  		<tr role="presentation" class=" ab-border" ng-repeat="x in vin_ssma">	
	  		<form id="mainForm" name="mainForm"  ab-rowset="{{$index}}" ab-view="vin_ssma" ab-main="vin_ssma">	
	  			<td>
					<div class="row">
						<div class="col-sm-1">
							<a href="#{{opts.Process}}/VIN_SSMACT/idVIN_SSMA:{{x.idVIN_SSMA}},updType:UPDATE,Session:VIN_SSMACT,Process:{{opts.Process}}" >
								<?php
						$tFnc = new AB_querySession;
						$dtaObj = array();
						$dtaObj['PROCESS'] = "VIN_ITEMS";
						$dtaObj['SESSION'] = "VIN_SSMACT";
						$chk = 0;
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_ssma ","New");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_ssma ","Upd");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_ssma","Del");

						if ($chk > 0)
						{
							echo "<span >Edit</span>";
						}
						else
						{
							echo "<span >View</span>";
						}
						?>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>
						</div>	
												
<?php
echo '<div class="col-sm-2 ab-borderless">';
$xtmp->laAttrib["class"] .= " hidden disable";
$xtmp->inAttrib["readonly"] = "1";
$xtmp->inAttrib["size"] = "15";
$xtmp->inAttrib["style"] .= "border:none;";

// idVIN_SSMA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vin_ssma ","x.idVIN_SSMA","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_SSMA_SPEID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","2.1","vin_ssma  ","x.VIN_SSMA_SPEID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</div><div class="col-sm-2 ab-borderless">';


// VIN_SSMA_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","0.0","vin_ssma","x.VIN_SSMA_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</div><div class="col-sm-2 ab-borderless">';

// VIN_SSMA_SUETA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","0.0","vin_ssma","x.VIN_SSMA_SUETA","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</div><div class="col-sm-2 ab-borderless">';

// "VIN_SSMA_SHLIF
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","0.0","vin_ssma","x.VIN_SSMA_SHLIF","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

echo '<div></div>';
?>
						
						
					</div>	  			
	  			</td>
	  			</form>
	  		</tr>
	  	  </table>
	</div>
	<table class="table table-condensed ">
	  <tr class="ab-spaceless">
	  		<td>
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vin_ssma'?'vin_ssma':'Yes'}}"
			class="hidden{{ tbData=='vin_ssma'?'xxx':''}} text-primary" >
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_SSMA_SPEID','VIN_SSMA_SPEID','vin_ssma',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="kPress('VIN_SSMA_SPEID','VIN_SSMA_SPEID','vin_ssma',1)"  > </span>
			</span>
			</td>
	</tr>
	<tr>		  
	  	<td> 
		  <div class="visible-lg">
			&nbsp;
			<span ng-repeat="org in AB_DUSA.orgLevels |AB_Selected:AB_DUSA.usrLevels.CurrentAffect:'levelId' " class=" {{org.isSelected}} " >{{org.levelDescr}}</span>	
			
		  <div>
	  	</td>
	  </tr>
</table>	
</div>
	</div>
	<div class='btn-sm ab-body-buttons hidden' >
		<span class='hidden'>
			Records per page:&nbsp;
			<select class='text-muted' ab-mpp onchange="getMaxPerPage();" value="100" >
		 		 <option value="10">10</option>
			    <option value="20" >20</option>
		  		 <option value="40"  >40</option>
		       <option value="100" selected >100</option>
			</select>
		</span>
	</div>
</div>