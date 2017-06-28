<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
  <style>
  .autocomplete_input {
	position:relative;  
  }
  .autodata {
	position:absolute; 
	top:20px;
	left:0; 
	max-height: 250px;
	overflow: hidden;
	z-index: 99;
	background:#FFF;
	min-width:220px;
	border:1px solid #ccc;  
  }
  .datalist {
	 padding:4px 6px;
	 border-bottom:1px solid #ccc;
  }
  </style>
<div class="hidden">
	<?php require_once "../appCscript/VIN_ITEMS.php"; ?>
</div>
<textarea class="hidden" ab-updSuccess="1" >

if (data['posts'].requestMethod == 'DELETE')
{
	$scope.opts.updType = "CREATE";
	$scope.opts.idVIN_LSHE = 0;
	$scope.initEditLot();
}
else
{
	if ($scope.opts.updType == "CREATE")
	{
		$scope.opts.updType = "UPDATE";
		$scope.opts.idVIN_LSHE = data['posts'].insertId ;
		$scope.initEditLot();	
	}
	else
	{
		$scope.initEditLot();
	}
}


</textarea>

<div style="margin-left:5px;" ng-init="SESSION_DESCR='Item Lot Control'">
	<div class="row ab-spaceless ">
		<div class="col-sm-12 ab-spaceless" ng-model="vin_lshe" >
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		</div>
		<div class="col-sm-5" style="padding:0px;padding-top:5px;">
			<ul class="nav nav-tabs " >
				<li>
				<label  title="VIN_ITEMS"  >	
		 			<a class="bg-primary " href="#/VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item" >
					<span class="glyphicon glyphicon-backward" ></span><span>Item List</span>
					 </a>			
				</label>
				</li>
			</ul>
		</div>
		<div class="col-sm-7">
		</div>
	</div>
	
<div class="ab-spaceless" >

<div id="ab-new" >
	<label  title="CREATE" class="{{opts.updType=='CREATE'?'hidden':''}}">
		 <a ng-click="setUpdType(0);" hr2ef="#VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:0,idVIN_ITEM:{{opts.idVIN_ITEM}},updType:CREATE,Session:VIN_LOTCT,Process:VIN_ITEMS" >
			<span >New</span>
			<span  class="glyphicon glyphicon-pencil" ></span>
		</a>			
	</label>
</div>

	<script>
		$('#ab-appOpt').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
	</script>

</div>

	<div class="row mygrid-wrapper-div ab-borderless" style="margin:0px;padding:0px;">
	<div class="col-sm-3">
		<form id="mainForm" name="mainForm"  ab-view="vin_lshe" ab-main="vin_lshe">
		<?php
$xtmp = new appForm("VIN_LOTCT");

// AC 20160212 - The field below should be "idVIN_LSHE"
// AC 20160212 - The ab-btrigger setting is correct.
// AC 20160212 - This allows for a central function to display the proper update buttons.
// AC 20160212 - If idVIN_LSHE > 0 display button UPDATE & DELETE else button ADD 
// idVIN_LSHE
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vin_lshe";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("VIEW01","0.0","vin_lshe","idVIN_LSHE","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// AC 20160212 - I made one change below $laAttr['ab-label'] = "VIN_ITEM_ITMID";
// AC 20160212 - The field below should be display only
// AC 20160212 - The value will always be supplied from VIN_LSHE session 
// AC 20160212 - Should list all Items with Lot control = Yes

// VIN_LSHE_ITMID
/*$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_ITMID";
$xtmp->setFieldWrapper("view01","1.1","vin_lshe","VIN_LSHE_ITMID","",$grAttr,$laAttr,$inAttr,"");
echo  $xtmp->currHtml;*/

	// VIN_LSHE_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] .= "";
$xtmp->setFieldWrapper("view01","1.1","vin_item","VIN_ITEM_ITMID","",$grAttr,$laAttr,$inAttr,"<table><tr><td><label>{{VIN_ITEM_ITMID}}&nbsp;&nbsp;&nbsp;<a target='{{ABtarget}}'  href='#/VIN_ITEMS/VIN_ITEMCT/idVIN_ITEM:{{opts.idVIN_ITEM}},updType:UPDATE,Session:VIN_ITEMCT,Process:VIN_ITEMS'>
<span class='text-primary small'>
Edit
<span class='glyphicon glyphicon-pencil' ></span>
</span>
</a></label></td></tr><tr><td>{{vin_lsheList[0].VIN_ITEM_DESC1}}</td></tr></table>");
echo $xtmp->currHtml;
?>

<?php
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("VIEW01","0.0","vin_lshe","VIN_LSHE_ITMID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_LSHE_ITMID
/*$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VIN_ITEM_ITMID";

	$keepOrg = 0; 
	$repeatIn = "vin_item";
	$searchIn = "";
	$refName = "VIN_LSHE_ITMID"; // unique
	$refModel = "VIN_LSHE_ITMID"; // unique
	$repeatInRef = "idVIN_ITEM"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_ITEM_ITMID}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VIN_ITEM_ITMID;VIN_ITEM_ITMID='';VIN_ITEM_ITMID_F='';kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',0);VIN_ITEM_ITMID=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
$xtmp->setFieldWrapper("view01","1.1","vin_lshe","VIN_LSHE_ITMID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo  $xtmp->currHtml;*/


// VIN_LSHE_LOTID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "VIN_LSHE_LOTID";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.2","vin_lshe","VIN_LSHE_LOTID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


// VIN_LSHE_DOMDA IF DOM
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{" . "VIN_LSHE_DOMOS!='DOS'?'':'hidden'" . "}} ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "VIN_LSHE_DOMDA";
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setDatePick("VIN_LSHE_DOMDA");
$xtmp->setFieldWrapper("view01","1.1","vin_lshe","VIN_LSHE_DOMDA","",$grAttr,$laAttr,$inAttr,$hardCode);

$domda = $xtmp->currHtml;

// VIN_LSHE_DOMDA If DOS
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " {{" . "VIN_LSHE_DOMOS!='DOS'?'hidden':''" . "}} ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "STD_DOS";
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setDatePick("VIN_LSHE_DOMDA");
$xtmp->setFieldWrapper("view01","1.1","vin_lshe","VIN_LSHE_DOMDA","",$grAttr,$laAttr,$inAttr,$hardCode);
// echo $xtmp->currHtml;
$domda .= $xtmp->currHtml;

?>

<?php
echo "<table><tr><td>" . $domda . "</td><td  style='vertical-align:bottom;padding-left:3px;'><input ng-model='VIN_LSHE_DOMOS' /></td></tr></table>";

// VIN_LSHE_DATES
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "STD_DATE_END";
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setDatePick("VIN_LSHE_DATES");

$xtmp->setFieldWrapper("view01","1.1","vin_lshe","VIN_LSHE_DATES","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_LSHE_SOLDO
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_LSHE_SOLDO");
$xtmp->setFieldWrapper("view01","0.0","vin_lshe","VIN_LSHE_SOLDO","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_LSHE_AUTOS
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_LSHE_AUTOS");
$xtmp->setFieldWrapper("view01","0.0","vin_lshe","VIN_LSHE_AUTOS","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

// AC 20160212 - I made one change below $laAttr['ab-label'] = "VGB_SUPP_BPART";
// AC 20160212 - Obviously we cannot make a list of all suppliers 1000+ for the user to select one.
// AC 20160212 - We will need to modify wrapper functions to have search capabilities when more than x count of records.
// AC 20160212 - Also another table will control what suppliers are displayed
// AC 20160212 - Table vin_supp links Items to suppliers. I will create it. 
// AC 20160212 - It will also be part of the VIN_ITEMS process.
// VIN_LSHE_BPART
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_SUPP_BPART";

	$keepOrg = 0; 
	$repeatIn = "vgb_supp";
	$searchIn = "";
	$refName = "VIN_LSHE_BPART"; // unique
	$refModel = "VIN_LSHE_BPART"; // unique
	$repeatInRef = "idVGB_SUPP"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VGB_SUPP_BPNAM}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "hold=VGB_SUPP_BPNAM;VGB_SUPP_BPNAM='';VGB_SUPP_BPNAM_F='';kPress('VGB_SUPP_BPNAM','VGB_SUPP_BPNAM','vgb_supp',0);VGB_SUPP_BPART=hold;".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
$xtmp->setFieldWrapper("view01","1.1","vgb_supp","VIN_LSHE_BPART","",$grAttr,$laAttr,$inAttr,$hardCode);
echo  $xtmp->currHtml;

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vin_lshe";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("VIEW01","0.0","vin_lshe","VIN_LSHE_LOTSQ","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

  ?>
		</form>
		</div>
		<div class="col-sm-5">
<div style="height:25px">
&nbsp;
</div>
		<table class="" width="100%">
		<tr>
				<td class="bg-primary" colspan="2"> Item Lot:</td>
		</tr>
		<tr class="text-primary ab-border">
				<td></td>
				<td></td>
				<td class="small"><label  ab-label="VIN_LSHE_LOTID">Lot Identification</label></td>
				<td class="small"><label  ab-label="STD_DOS_OR_DOM">VIN_LSHE_DOMDA </label></td>
				<td class="small"><label  ab-label="VIN_LSHE_DATES">Shelf Life ends </label></td>
		</tr>
		
		<?php
		
$tmp = 'ng-click="ABupdChkObj(' . "'idVIN_LSHE',k.idVIN_LSHE,true);ABupdChkObj('idVIN_LSHE','',false);ABchk();".'"';
$last = 'target="{{'.'ABtarget}}" href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:{{k.idVIN_LSHE}},idVIN_ITEM:{{ k.idVIN_ITEM }},updType:UPDATE,Session:VIN_LOTCT,Process:VIN_ITEMS"';
$last = " ng-click='setUpdType(k.idVIN_LSHE);' ";		
echo '<tr ng-repeat="k in vin_lsheList[0].rowSet |AB_noDoubles:\'idVIN_LSHE\'" ng-if="k.idVIN_LSHE>0" class="ab-spaceless {{k.idVIN_LSHE!=idVIN_LSHE?\'\':\'ab-active\'}}">';
echo '<td> <input type="checkbox" ng-model="k.link" /></td>';
echo '<td  class="ab-spaceless"><a basee="2"' . $last . ' >
			<span class="text-primary small">
			Edit
			<span class="glyphicon glyphicon-pencil" ></span>
			</span>
			</a></td><td>';

// VIN_LSHE LOT ID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_LOTID}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_lshe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_LSHE DOMDA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_DOMDA}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_lshe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_LSHE DATES
 $grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_DATES}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_lshe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';
/*
// VSL_ORHE PURCHASE ID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_BPART}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_lshe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td>';
*/
?>
</tr>
		</table>
		</div>
		
		<div class="col-sm-4">
<div style="height:25px"></div>
		<?php
		 echo '<table class="" width="100%;"><tr>
				<td class="bg-primary" colspan="2" >Product Spec Sheet:</td>
			 </tr>
      	<tr class="text-primary ab-border">
				<td><a  target="{{'.'ABtarget}}" href="#VIN_ITEMS/VIN_SSMACT/idVIN_SSMA:0,idVIN_ITEM:{{opts.idVIN_ITEM}},updType:CREATE,Session:VIN_SSMACT,Process:VIN_ITEMS">
			<span class="text-primary small">
			New
			<span class="glyphicon glyphicon-pencil" ></span>
			</span>
			</a></td>  
				<td class="small"><label ab-label="VIN_SSMA_SPEID">Spec. Sheet ID Code</label></td>
				<td class="small"><label ab-label="STD_DESCRIPTION">Description </label></td>
		</tr>';
      
        echo '<tr ng-repeat="spec in vin_lsheList[0].rowSet |AB_noDoubles:\'idVIN_SSMA\'" n2g-if="spec.idVIN_SSMA>0" class="ab-spaceless" >';
        echo '<td  class="ab-spaceless"><a target="{{'. 'ABtarget}}"  href="#/VIN_ITEMS/VIN_SSMACT/idVIN_SSMA:{{spec.idVIN_SSMA}},idVIN_ITEM:{{spec.idVIN_ITEM}},updType:UPDATE,Session:VIN_SSMACT,Process:VIN_ITEMS">';
?>
			<span class="text-primary small">
			Edit
			<span class="glyphicon glyphicon-pencil" ></span>
			</span>
			</a></td><td>
<?php
// VIN_LSHE LOT ID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{spec.VIN_SSMA_SPEID}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_lshe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_LSHE DOMDA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{spec.VIN_SSMA_DESCR}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_lshe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td>';

?>
</tr></table>
		</div>
	</div>
</div>
