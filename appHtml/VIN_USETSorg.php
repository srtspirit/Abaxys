<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();
ob_clean();
require_once "../appCscript/VIN_USETS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>
</div>
<div class="hidden" ng-init="SESSION_DESCR='Unit of Measure Control'">
	<span ab-label="VIN_UNITCT"></span>
</div>
<div style="margin-left:5px;">
	<div id="mainForm" ab-main="vin_unit" style="margin:0px;">
		<div class="row">
			<div class="col-sm-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
			<div class="col-sm-3 ">
				<table>
					<tr>
						<td id="ab-new" >
							<label  title="CREATE" class="">
	 				 			 <a 
							href="#VIN_USETS/VIN_UNITCT/Process:VIN_USETS,Session:VIN_UNITCT,tblName:vin_uset,updType:CREATE,idVIN_USET:0,VIN_USET_UNSET:,tbData:{{tbData}}" 
							>
								<span >New</span>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>			
							</label>
							<!--
							<input class="hidden" ng-model="idVIN_USET" />
							-->
							
						</td>
					<td>	  
<?php
	$xtmp = new appForm("VIN_USETS");
	$hardCode = <<<BOD


			<div class="hidden" >
				<span class="" >
					<input a_iref="02-60"
							size=15
							lval=""
							ng-keyup="kPress('VIN_USET_UNSET','VIN_USET_UNSET','vin_uset',0);"
							ng-blur="kPress('VIN_USET_UNSET','VIN_USET_UNSET','vin_uset',0);"
							ng-model="VIN_USET_UNSET" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>
	
				</span>
			</div>

BOD;


$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="VIN_USET_UNSET";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;

// $xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_USET_UNSET","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo $xtmp->currHtml;



	$keepOrg = 0; 
	$repeatIn = "vin_uset | AB_noDoubles:'idVIN_USET'";
	$searchIn = "";
	$refName = "vin_uset"; // unique
	$refModel = "idVIN_USET"; // unique
	$repeatInRef = "idVIN_USET"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_USET_UNSET}}","{{ab_rloop.VIN_USET_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "ng-click=" . '"' . "ckMain();" . '" ';
	$ignTrig = 'ng-click="' . "hold=VIN_USET_UNSET;VIN_USET_UNSET='';VIN_USET_UNSET_F='';kPress('VIN_USET_UNSET','VIN_USET_UNSET','vin_uset',0);VIN_USET_UNSET=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("view02","2.5","vin_uset","VIN_USET_UNSET","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;



?>
					</td>

					<td>	  
<?php
	
	$hardCode = <<<BOD
			<div>
				<span  class="" >
					<input a_iref="02-60"
							size=15
							lval=""
							ng-keyup="kPress('VIN_UNIT_UNSET','VIN_UNIT_UNSET','vin_unit',0);"
							ng-blur="kPress('VIN_UNIT_UNSET','VIN_UNIT_UNSET','vin_unit',0);"
							ng-model="VIN_UNIT_UNSET" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>
	
				</span>
			</div>
BOD;
$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="VIN_UNIT_UNSET";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;
// echo $xtmp->currHtml;

?>
					</td>

				</tr>
			</table>
		</div>
		<div class="col-sm-2 ">
<?php		
		// VIN_USET_DESCR;
		$grAttr = $xtmp->grAttrib;
		$grAttr["class"] .= " ab-spaceless ab-borderless";
		$laAttr = $xtmp->laAttrib;
		$laAttr["ab-label"] = "STD_DESCR";
		$inAttr = $xtmp->inAttrib;
		$xtmp->setFieldWrapper("view01","2.1","vin_uset","VIN_USET_DESCR","",$grAttr,$laAttr,$inAttr,"");
		echo $xtmp->currHtml;
?>
		</div>
		<div class="col-sm-2 ">
		
<?php		
			// VIN_USET_UVACT
			$grAttr = $xtmp->grAttrib;
			// $grAttr["class"] .= " ab-spaceless ab-borderless";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_USET_UVACT";
			
			$laAttr["style"] .= "";
			$inAttr = $xtmp->inAttrib;
			$hardCode = $xtmp->setYesNoField("VIN_USET_UVACT");		
			$xtmp->setFieldWrapper("view01","0.0","vin_uset","VIN_USET_UVACT","",$grAttr,$laAttr,$inAttr,$hardCode );
			echo $xtmp->currHtml;

?>
		</div>		
	</div>
	<script>
		$('#ab-appOpt').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
	</script>
	<div>
	
  	<table  style="width:95%;">
	<tr>
		<td class=" ab-spaceless">
	
			<div class="row ab-listhead bg-primary"  >
			<?php
			
			$xtmp = new appForm("VIN_USETS");
			$xtmp->grAttrib["class"] = " ";
			$xtmp->grAttrib["style"] = "";
			$grAttr = $xtmp->grAttrib;
			$laAttr = $xtmp->laAttrib;
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_uset","","",$grAttr,$laAttr,$inAttr,"  ");
			
			$xOut = "<table ><tr><td>&nbsp;&nbsp;&nbsp;" . $xtmp->currHtml . "</td>";
						
			$grAttr = $xtmp->grAttrib;
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_USET_UNSET";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_uset","VIN_USET_UNSET","",$grAttr,$laAttr,$inAttr,"  ");
			
			$xOut .= "<td>" . $xtmp->currHtml . "</td></tr></table>";
			echo '<div class="col-sm-1 ab-spaceless " >' . $xOut . '</div>';
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2  ";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="STD_DESCR";
			
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:1px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_uset","VIN_USET_DESCR","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-1 ";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_USET_UVACT";
			$laAttr["class"] .= " bg-primary small";
			$laAttr["style"] .= "";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			
			$xtmp->setFieldWrapper("view01","0.0","vin_uset","VIN_USET_UVACT","",$grAttr,$laAttr,$inAttr," ");
			echo $xtmp->currHtml;
				
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-1";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="STD_UOM";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_unit","VIN_UNIT_UNITM","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;

			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2 ";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="STD_DESCR";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_unit","VIN_UNIT_DESCR","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;


			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$grAttr["class"] .= " {{VIN_USET_UVACT > 0?'':'invisible'}} ";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_UNIT_FACTO";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_unit","VIN_UNIT_FACTO","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;

			?>
			</div>
		</td>
		</tr>	
	</table>
</div>
<div class="row">
<div class="col-sm-3">

</div>
<div class="col-sm-9">
<div class= "row"

<div class="mygrid-wrapper-div"  style="margin:0px;padding:0px;">
	<div>
		<table  >
	  		<tr role="presentation"   ng-repeat="x in vin_uset">
	  			
	  			<td>
<form id="mainForm" name="mainForm"  ab-rowset="{{$index}}" ab-view="vin_unit" ab-main="vin_unit"  >
	  			
					<div class="row">
				
<?php
$hardCode = '<a href="#{{opts.Process}}/VIN_UNITCT/idVIN_USET:{{x.idVIN_USET}},idVIN_UNIT:{{x.idVIN_UNIT}},updType:UPDATE,Session:VIN_UNITCT,Process:{{opts.Process}}" >';
						
						$tFnc = new AB_querySession;
						$dtaObj = array();
						$dtaObj['PROCESS'] = "VIN_USETS";
						$dtaObj['SESSION'] = "VIN_USETS";
						$chk = 0;
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_uset","New");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_uset","Upd");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_uset","Del");

						if ($chk > 0)
						{
							$hardCode .= "<span></span>";
							$hardCode .= '<span  class="glyphicon glyphicon-pencil" ></span></a>';
						}
						else
						{
							$hardCode .= '<span >View{$chk}{$tFnc->hasPriviledge($dtaObj,"vin_uset","New")};</span>';
							
						}
						
						
						


$VUSET = array();

$VUSET[count($VUSET)] = $hardCode;							

$xtmp = new appForm("VIN_UNITCT");

$xtmp->grAttrib['style'] = "";
$xtmp->grAttrib['class'] = " ab-spaceless   ";

$xtmp->laAttrib["class"] .= " hidden disable";
// $xtmp->inAttrib["readonly"] = "1";

$xtmp->inAttrib["style"] .= "border:none;";

// idVIN_USET	
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vin_uset","x.idVIN_USET","",$grAttr,$laAttr,$inAttr,"");
$VUSET[count($VUSET)] = $xtmp->currHtml;



// VIN_USET_UNSET
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " ab-spaceless ab-borderless";
$laAttr = $xtmp->laAttrib;
$laAttr["class"] .= " hidden "; 
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "5";

$xtmp->setFieldWrapper("view01","2.1","vin_uset","x.VIN_USET_UNSET","",$grAttr,$laAttr,$inAttr,"");
$VUSET[count($VUSET)] = $xtmp->currHtml;

$inAttr["size"] = "10";
$xtmp->setFieldWrapper("view01","2.1","vin_uset","x.VIN_USET_DESCR","",$grAttr,$laAttr,$inAttr,"");
$VUSET[count($VUSET)] = $xtmp->currHtml;


$hardCode = $xtmp->setYesNoField("x.VIN_USET_UVACT");
$xtmp->setFieldWrapper("view01","2.1","vin_uset","x.VIN_USET_UVACT","",$grAttr,$laAttr,$inAttr,$hardCode);
$VUSET[count($VUSET)] = $xtmp->currHtml;

$hardCode = "<div class='row'>";
$hardCode .= "<div class='col-sm-1' >" . $VUSET[0] . "</div>";
$hardCode .= "<div class='col-sm-2' >{{x.VIN_USET_UNSET}}</div>";
$hardCode .= "<div class='col-sm-5' >{{x.VIN_USET_DESCR}}</div>";

$holdAttr = $xtmp->inAttrib;
$xtmp->inAttrib['class']="hidden";
$hardCode .= "<div class='col-sm-4' >" . $xtmp->setYesNoField("x.VIN_USET_UVACT") . "</div>";
$hardCode .= "</div>";
$xtmp->inAttrib = $holdAttr;

echo '<div class="col-sm-2">';
echo '<table><tr><td></td><td>' . $VUSET[1] . '</td><td>' . $VUSET[2] . '</td></tr></table>';
echo '</div>';
echo '<div class="col-sm-3">';
echo $VUSET[3];
echo '</div>';
echo '<div class="col-sm-3">';
echo $VUSET[4];
echo '</div>';



$hardCode = "";



echo '<div class="col-sm-1 ab-borderless">';
// idVIN_UNIT	
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vin_unit";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vin_unit","x.idVIN_UNIT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


// VIN_UNIT_UNSET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vin_unit","x.VIN_UNIT_UNSET","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


//VIN_UNIT_UNITM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "5";
$xtmp->setFieldWrapper("view01","0.0","vin_unit","x.VIN_UNIT_UNITM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

echo '</div><div class="col-sm-2 ab-borderless">';
// VIN_UNIT_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "10";
$xtmp->setFieldWrapper("view01","0.0","vin_unit","x.VIN_UNIT_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


echo '</div><div class="col-sm-1 ab-borderless">';
// VIN_UNIT_FACTO
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{x.VIN_USET_UVACT > 0?'':'invisible'}} ";
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = 2;
$xtmp->setFieldWrapper("view01","0.0","vin_unit","x.VIN_UNIT_FACTO","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;





echo '</form><div></div></div>';








?>
						
						
					</div>	  			
	  			</td>
	  		
	  		</tr>
	  	  </table>
	</div>
</div>
</div>
<table class="table table-condensed ">
	  <tr class="ab-spaceless">
	  		<td>
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vin_item'?'vin_item':'Yes'}}"
			class="hidden{{ tbData=='vin_item'?'xxx':''}} text-primary" >
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',1)"  > </span>
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
</div>              