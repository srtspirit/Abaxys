<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VIN_SSLTCT.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>
</div>
<div class="hidden" ng-init="SESSION_DESCR='Product Spec Sheet Control'">
	<span ab-label="VIN_SSLTCT"></span>
</div>
<div id="ab-new" class="hidden" >
	<label  title="CREATE" class="{{opts.updType!='CREATE'?'':'hidden'}}">
		 <a href="#VIN_ITEMS/VIN_SSLTCT/Process:VIN_ITEMS,Session:VIN_SSLTCT,tblName:vin_sslt,updType:CREATE,idVIN_SSLT:0,VIN_SSLT_SPEID:,tbData:{{tbData}}" >
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
		<div class="row">
			<div class="col-sm-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
			<div class="col-sm-3">
			<br />
			<form id="mainForm" name="mainForm" ab-context="1"  ab-view="vin_sslt" ab-main="vin_sslt">
		<?php
$xtmp = new appForm("VIN_SSLTCT");

// idVIN_SSLT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vin_sslt";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("VIEW01","0.0","vin_sslt","idVIN_SSLT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


//VIN_SSLT_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_ITMID";

	$keepOrg = 0; 
	$repeatIn = "vin_item";
	$searchIn = "";
	$refName = "vin_item"; // unique
	$refModel = "VIN_SSLT_ITMID"; // unique
	$repeatInRef = "idVIN_ITEM"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_ITEM_ITMID}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VIN_ITEM_ITMID;VIN_ITEM_ITMID='';VIN_ITEM_ITMID_F='';kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',0);VIN_ITEM_ITMID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("View01","1.2","vin_sslt","VIN_SSLT_ITMID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_SSLT_LOTID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_SSLT_LOTID";

	$keepOrg = 0; 
	$repeatIn = "vin_lshe";
	$searchIn = "";
	$refName = "vin_lshe"; // unique
	$refModel = "VIN_SSLT_LOTID"; // unique
	$repeatInRef = "idVIN_LSHE"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_LSHE_LOTID}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VIN_LSHE_LOTID;VIN_LSHE_LOTID='';VIN_LSHE_LOTID_F='';kPress('VIN_LSHE_LOTID','VIN_LSHE_LOTID','vin_lshe',0);VIN_LSHE_LOTID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("View01","1.2","vin_sslt","VIN_SSLT_LOTID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_SSLT_SPESQ
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_SSLT_SPESQ";

	$keepOrg = 0; 
	$repeatIn = "vin_ssma";
	$searchIn = "";
	$refName = "vin_ssma"; // unique
	$refModel = "VIN_SSLT_SPESQ"; // unique
	$repeatInRef = "idVIN_SSMA"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_SSMA_SPEID}}","{{ab_rloop.VIN_SSMA_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VIN_SSMA_SPEID;VIN_SSMA_SPEID='';VIN_SSMA_SPEID_F='';kPress('VIN_SSMA_SPEID','VIN_SSMA_SPEID','vin_ssma',0);VIN_SSMA_SPEID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
$xtmp->setFieldWrapper("View01","1.2","vin_sslt","VIN_SSLT_SPESQ","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
 ?>
		</form>
			</div>
			<div class="col-sm-9">
			<br />
			<div class="{{opts.updType!='CREATE'?'':'hidden'}}">
			 <div>
  	<table class=" table-condensed" style="width:95%;">
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
			$xtmp->setFieldWrapper("view01","0.0","vin_sslt","","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
						
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="{{tbData=='vin_sslt '?'VIN_ITEM_ITMID':'VIN_ITEM_ITMID'}}";
			$laAttr["class"] .= "bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_sslt","VIN_SSLT_ITMID","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_SSLT_SPESQ";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_sslt","VIN_SSLT_SPESQ","",$grAttr,$laAttr,$inAttr,"  ");
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
	  		<tr role="presentation" class=" ab-border" ng-repeat="x in vin_sslt">	
	  		<form id="mainForm" name="mainForm"  ab-rowset="{{$index}}" ab-view="vin_sslt" ab-main="vin_sslt">	
	  			<td>
					<div class="row">
						<div class="col-sm-1">
							<a href="#{{opts.Process}}/VIN_SSLTCT/idVIN_SSLT:{{x.idVIN_SSLT}},updType:UPDATE,Session:VIN_SSLTCT,Process:{{opts.Process}}" >
								<?php
						$tFnc = new AB_querySession;
						$dtaObj = array();
						$dtaObj['PROCESS'] = "VIN_ITEMS";
						$dtaObj['SESSION'] = "VIN_SSLTCT";
						$chk = 0;
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_sslt ","New");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_sslt ","Upd");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_sslt","Del");

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

// idVIN_SSLT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("view01","0.0","vin_sslt ","x.idVIN_SSIT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_SSLT_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","2.1","vin_sslt","x.VIN_ITEM_ITMID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</div><div class="col-sm-2 ab-borderless">';

// VIN_SSLT_LOTID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","2.1","vin_sslt","x.VIN_LSHE_LOTID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</div><div class="col-sm-2 ab-borderless">';

// VIN_SSLT_SPESQ
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","2.1","vin_sslt","x.VIN_SSMA_SPEID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</div>';


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
			<span ab-empty="{{tbData=='vin_sslt'?'vin_sslt':'Yes'}}"
			class="" >
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_SSLT_ITMID','VIN_SSLT_ITMID','vin_sslt',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="kPress('VIN_SSLT_ITMID','VIN_SSLT_ITMID','vin_sslt',1)"  > </span>
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
<div>
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