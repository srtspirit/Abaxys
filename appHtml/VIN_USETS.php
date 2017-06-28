<?php require_once "../stdSscript/stdAppobjGen.php"; ?>

<div class="hidden">
<?php 
session_start();
ob_clean();
require_once "../appCscript/VIN_USETS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>

<textarea class="hidden" ab-updSuccess="" >
$scope.opts.updType="";
$scope.VIN_USET_UNSET = $scope['orgVIN_USET_UNSET'];
$scope.initSpace();
</textarea>

</div>
<div class="hidden" ng-init="SESSION_DESCR='Unit of Measure Control'">
	<span ab-label="VIN_UNITCT"></span>
</div>
<div id="ab-new" class="hidden" >
	<label  title="CREATE" class="{{opts.updType!='CREATE'?'':'hidden'}}">
		 <a 
	href="#VIN_USETS/VIN_USETS/Process:VIN_USETS,Session:VIN_USETS,tblName:vin_uset,updType:CREATE,idVIN_USET:0,VIN_USET_UNSET:,tbData:{{tbData}}" 
	>
		<span >New</span>
		<span  class="glyphicon glyphicon-pencil" ></span>
	</a>			
	</label>
	
</div>
	<script>
		$('#ab-appOpt').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
		
		
		$('#ab-delete').find("[ng-click]").attr("ng-click","delSet();")
		
	</script>
							
<div style="margin-left:5px;">
	<!-- <div id="mainForm" ab-main="vin_unit" style="margin:0px;"> -->
	  			
		<div class="row">
			<div class="col-sm-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
			<div class="col-sm-3 ">

<form id="mainForm" name="mainForm"  ab-context="1" ab-view="vin_uset" ab-main="vin_uset"  >	
				<table>
					<tr><td>&nbsp;</td></tr>				
					<tr>

						<td>	 
						<input class="hidden" ab-btrigger="vin_uset" ng-model="idVIN_USET" /> 
<?php
	$xtmp = new appForm("VIN_USETS");
	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] .= " {{idVIN_USET>0?'':'hidden'}}";
	$laAttr = $xtmp->laAttrib;
	
	$inAttr = $xtmp->inAttrib;
		
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

	$xtmp = new appForm("VIN_USETS");
	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] .= " {{idVIN_USET>0?'hidden':''}}";
	$laAttr = $xtmp->laAttrib;
	
	$inAttr = $xtmp->inAttrib;
	
	$xtmp->setFieldWrapper("view02","2.1","vin_uset","VIN_USET_UNSET","",$grAttr,$laAttr,$inAttr,"");
	echo $xtmp->currHtml;	


?>
					</td>

				</tr>
				<tr>
					<td>
<?php		
		// VIN_USET_DESCR;
		$grAttr = $xtmp->grAttrib;
//		$grAttr["class"] .= " ab-spaceless ab-borderless";
		$laAttr = $xtmp->laAttrib;
		$laAttr["ab-label"] = "STD_DESCR";
		$inAttr = $xtmp->inAttrib;
		$inAttr["id"] = "VIN_USET_DESCR";
		$xtmp->setFieldWrapper("view01","2.1","vin_uset","VIN_USET_DESCR","",$grAttr,$laAttr,$inAttr,"");
		echo $xtmp->currHtml;
?>
					</td>
				</tr>
				<tr>
					<td>
					
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
					</td>
				</tr>
			</table>
</form>			
		</div>

		<div class="col-sm-9">
			<div class="row">
				<div class="col-sm-12">
				
				</div>
			</div>
			
			<div class="mygrid-wrapper-div"  style="margin:0px;padding:0px;">
			<div class="row">
				<div class="col-sm-12">
				  	<table class="table-condensed {{opts.updType!='CREATE'?'':'hidden'}}">
				  	
					<tr class=" ">
						<td class=" ab-spaceless">
							
								<a 
									ng-click="insertIn();" 
								>
									<span class="small" >Insert</span>
									<span  class="glyphicon glyphicon-pencil small" ></span>
								</a>			
							
	
						</td>					
						<td class=" ab-spaceless">
					
<!--							
							<?php
							
							$xtmp = new appForm("VIN_USETS");
							$xtmp->grAttrib["class"] = " ";
							// $xtmp->grAttrib["style"] = "";
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
							$laAttr = $xtmp->laAttrib;
							$laAttr["ab-label"] ="STD_UOM";
							$laAttr["class"] .= " text-primary ";
							$laAttr["style"] .= "text-align:center;";
							$inAttr = $xtmp->inAttrib;
							$inAttr["class"]= " hidden ";
							
							$grAttr["class"]="ab-spaceless";
							$xtmp->setFieldWrapper("view01","0.0","vin_unit","VIN_UNIT_UNITM","",$grAttr,$laAttr,$inAttr,"  ");
							echo "-->". $xtmp->currHtml . "</td>";
				
							$grAttr = $xtmp->grAttrib;
							$laAttr = $xtmp->laAttrib;
							$laAttr["ab-label"] ="STD_DESCR";
							$laAttr["class"] .= " text-primary ab-spaceless ";
							$laAttr["style"] .= "text-align:center;";
							$inAttr = $xtmp->inAttrib;
							$inAttr["class"]= " hidden ";
							$grAttr["class"].=" ab-spaceless ";
							$xtmp->setFieldWrapper("view01","0.0","vin_unit","VIN_UNIT_DESCR","",$grAttr,$laAttr,$inAttr,"  ");
							echo "<td>".$xtmp->currHtml."</td>";
				
				
							$grAttr = $xtmp->grAttrib;
							$grAttr["class"] .= " {{VIN_USET_UVACT > 0?'':'invisible'}} ";
							$laAttr = $xtmp->laAttrib;
							$laAttr["ab-label"] ="VIN_UNIT_FACTO";
							$laAttr["class"] .= " text-primary ab-spaceless";
							$laAttr["style"] .= "text-align:center;";
							$inAttr = $xtmp->inAttrib;
							$inAttr["class"]= " hidden ";
							
							$xtmp->setFieldWrapper("view01","0.0","vin_unit","VIN_UNIT_FACTO","",$grAttr,$laAttr,$inAttr,"  ");
							echo "<td>".$xtmp->currHtml."</td>";
				
							?>
							</div>
						
						</tr>	

		  						<tr ab-formlist="uset_list"   ab-rowset="{{$index}}"   
		  						class="{{x.idVIN_UNIT > 0?'':'hidden'}}"
		  						role="presentation" ng-repeat="x in uset_list |AB_Sorted:'VIN_UNIT_UNITM' " >
								<td colspan=5>
								<div>
								
									<form ab-view="vin_unit" ab-main="vin_unit" ab-context="0" >
									<table class="table-condensed {{x.trash==1?'text-danger':''}}">
									<tr>

									<td class="{{x.trash==1?'text-danger':'text-primary'}}" >
									
									<input type="checkbox" value="0" onclick="$(this).val(1-$(this).val());" ng-model="x.trash" class="text-primary" />
									<span  class="glyphicon glyphicon-trash small" ></span>
									</td>

		  							<td>

		  							
		  							<input class="hidden" ab-btrigger="vin_unit" ng-model="x.idVIN_UNIT" /> 
		  							<input class="hidden" ng-model="idVIN_USET" /> 
		  							<input class="hidden" ng-model="x.VIN_UNIT_UNSET" /> 
		  							<input class="hidden" ng-model="VIN_USET_DESCR" /> 
		  							<input class="hidden" ng-model="VIN_USET_UVACT" /> 
<?php 
// 									

// $xtmp = new appForm("VIN_USETS");
$xtmp->laAttrib["class"] .= " hidden ";
$xtmp->grAttrib["class"] = "ab-spaceless";
$xtmp->grAttrib["style"] = "";
//VIN_UNIT_UNITM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "5";
$xtmp->setFieldWrapper("view01","0.0","vin_unit","x.VIN_UNIT_UNITM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

echo '</td><td>';
// VIN_UNIT_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "10";
$xtmp->setFieldWrapper("view01","0.0","vin_unit","x.VIN_UNIT_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


echo '</td><td>';
// VIN_UNIT_FACTO
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{VIN_USET_UVACT > 0?'':'invisible'}} ";
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "2";
$xtmp->setFieldWrapper("view01","0.0","vin_unit","x.VIN_UNIT_FACTO","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

?>
						
  			


	</td>
	</tr>
	</table>
	</form>	
	</div>
	</td>
	  	</tr>
		

	  	  </table>
	</div>

</div>
</div>
</div>
</div>

<table class=" ">
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
</div>