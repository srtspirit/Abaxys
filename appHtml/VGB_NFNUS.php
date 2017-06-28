<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
require_once "../appCscript/VGB_NFNUS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>
</div>
<div class="hidden" ng-init="SESSION_DESCR='Maintain Next free number'">
	<span ab-label="VGB_NFNUCT"></span>
</div>
<div id="ab-new" class="hidden" >
	<label  title="CREATE" class="">
		 <a href="#VGB_SYSPAR/VGB_NFNUCT/Process:VGB_SYSPAR,Session:VGB_NFNUCT,tblName:vgb_nfnu,updType:CREATE,idVGB_NFNU:0,VGB_NFNU_NFNCO:,tbData:{{tbData}}" >
			 <span >New</span>
			 <span  class="glyphicon glyphicon-pencil" ></span>
	    </a>			
	</label>
</div>
<script>
	$('#ab-appOpt').html('&nbsp;&nbsp;' + $('#ab-new').html());
	$('#ab-new').html('');
</script>
<div style="margin-left:5px;">
	<div id="mainForm" ab-main="vgb_nfnu" style="margin:0px;">
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
	$xtmp = new appForm("VGB_NFNUS");
	$hardCode = <<<BOD
			<div>
				<span ab-empty="{{tbData=='vgb_nfnu'?'vgb_nfnu':'Yes'}}"
				class="" >
					<input a_iref="02-60"
							size=15
							lval=""
							ng-keyup="kPress('VGB_NFNU_NFNCO','VGB_NFNU_NFNCO','vgb_nfnu',0);"
							ng-blur="kPress('VGB_NFNU_NFNCO','VGB_NFNU_NFNCO','vgb_nfnu',0);"
							ng-model="VGB_NFNU_NFNCO" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>
	
				</span>
			</div>
BOD;
$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="{{tbData=='vgb_nfnu'?'VGB_NFNU_NFNCO':'VGB_NFNU_NFNCO'}}";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;

$xtmp->setFieldWrapper("view01","0.0","vgb_nfnu","VGB_NFNU_NFNCO","",$grAttr,$laAttr,$inAttr,$hardCode);
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
			$xtmp->setFieldWrapper("view01","0.0","vgb_nfnu","","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
						
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="{{tbData=='vgb_nfnu'?'VGB_NFNU_NFNCO':'VGB_NFNU_NFNCO'}}";
			$laAttr["class"] .= "bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vgb_nfnu","VGB_NFNU_NFNCO","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			/*$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VGB_NFNU_DESCR";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vgb_nfnu","VGB_NFNU_DESCR","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;*/
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VGB_NFNU_NFNVA";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vgb_nfnu","VGB_NFNU_NFNVA","",$grAttr,$laAttr,$inAttr,"  ");
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
	  		<tr role="presentation" class=" ab-border" ng-repeat="x in vgb_nfnu">	
	  		<form id="mainForm" name="mainForm"  ab-rowset="{{$index}}" ab-view="vgb_nfnu" ab-main="vgb_nfnu">	
	  			<td>
					<div class="row">
						<div class="col-sm-1">
							<a href="#{{opts.Process}}/VGB_NFNUCT/idVGB_NFNU:{{x.idVGB_NFNU}},updType:UPDATE,Session:VGB_NFNUCT,Process:{{opts.Process}}" >
								<?php
						$tFnc = new AB_querySession;
						$dtaObj = array();
						$dtaObj['PROCESS'] = "VGB_SYSPAR";
						$dtaObj['SESSION'] = "VGB_NFNUCT";
						$chk = 0;
						$chk += $tFnc->hasPriviledge($dtaObj,"vgb_nfnu ","New");
						$chk += $tFnc->hasPriviledge($dtaObj,"vgb_nfnu ","Upd");
						$chk += $tFnc->hasPriviledge($dtaObj,"vgb_nfnu","Del");

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

// idVGB_NFNU
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vgb_nfnu ","x.idVGB_NFNU","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VGB_NFNU_NFNCO
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","2.1","vgb_nfnu ","x.VGB_NFNU_NFNCO","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</div><div class="col-sm-2 ab-borderless">';


/*// VGB_NFNU_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","0.0","vgb_nfnu","x.VGB_NFNU_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</div><div class="col-sm-2 ab-borderless">';*/

// VGB_NFNU_NFNVA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","0.0","vgb_nfnu","x.VGB_NFNU_NFNVA","",$grAttr,$laAttr,$inAttr,"");
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
			<span ab-empty="{{tbData=='vgb_nfnu'?'vgb_nfnu':'Yes'}}"
			class="hidden{{ tbData=='vgb_nfnu'?'xxx':''}} text-primary" >
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VGB_NFNU_NFNCO','VGB_NFNU_NFNCO','vgb_nfnu',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="kPress('VGB_NFNU_NFNCO','VGB_NFNU_NFNCO','vgb_nfnu',1)"  > </span>
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