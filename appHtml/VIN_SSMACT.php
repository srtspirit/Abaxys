<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
	<?php require_once "../appCscript/VIN_ITEMS.php"; ?>
</div>
<textarea class="hidden" ab-updSuccess="1" >

if (data['posts'].requestMethod == 'DELETE')
{
	$scope.opts.updType = "CREATE";
	$scope.opts.idVIN_SSMA = 0;
	$scope.initEditLot();
}
else
{

	if ($scope.opts.updType == "CREATE")
	{
		$scope.opts.updType = "UPDATE";
		$scope.opts.idVIN_SSMA = data['posts'].insertId ;
		$scope.initEditLot();	
	}
	else
	{
		$scope.initEditLot();
	}
}

</textarea>
<div style="margin-left:5px;" ng-init="SESSION_DESCR=' Product Spec Sheet Main'">
	<div class="row ab-spaceless ">
		<div class="col-sm-12 ab-spaceless" ng-model="vin_ssma" >
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
			 <a href="#VIN_ITEMS/VIN_SSMACT/idVIN_SSMA:0,idVIN_ITEM:{{opts.idVIN_ITEM}},updType:CREATE,Session:VIN_SSMACT,Process:VIN_ITEMS" >
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
	<form id="mainForm" name="mainForm"  ab-view="vin_ssma" ab-main="vin_ssma">
	<div class="col-sm-3">
		
		<?php
$xtmp = new appForm("VIN_SSMACT");

	// VIN_LSHE_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] .= "";
$xtmp->setFieldWrapper("view01","1.1","vin_item","VIN_ITEM_ITMID","",$grAttr,$laAttr,$inAttr,"<table><tr><td><label>{{VIN_ITEM_ITMID}} &nbsp;&nbsp;&nbsp;<a target='{{ABtarget}}'  href='#/VIN_ITEMS/VIN_ITEMCT/idVIN_ITEM:{{opts.idVIN_ITEM}},updType:UPDATE,Session:VIN_ITEMCT,Process:VIN_ITEMS'>
<span class='text-primary small'>
Edit Item
<span class='glyphicon glyphicon-pencil' ></span>
</span>
</a></label></td></tr><td>{{VIN_ITEM_DESC1}}</td></tr></table>");
echo $xtmp->currHtml;

// idVIN_SSMA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vin_ssma";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("VIEW01","0.0","vin_ssma","idVIN_SSMA","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_SSMA_SPEID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "VIN_SSMA_SPEID_SH";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.2","vin_ssma","VIN_SSMA_SPEID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_SSMA_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "STD_DESCR";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.2","vin_ssma","VIN_SSMA_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_DOMOS
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "STD_DOS_OR_DOM";
$inAttr['size'] = 5;
$xtmp->setFieldWrapper("view01","0.86","vin_ssma","VIN_SSMA_DOMOS","",$grAttr,$laAttr,$inAttr,"");
echo  $xtmp->currHtml;

// VIN_SSMA_SHLIF
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "VIN_ITEM_SHLIF";
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "5";
$xtmp->setFieldWrapper("view01","1.1","vin_ssma","VIN_SSMA_SHLIF","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


// VIN_SSMA_SUETA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "VIN_ITEM_SUETA";
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "5";
$xtmp->setFieldWrapper("view01","1.1","vin_ssma","VIN_SSMA_SUETA","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


//VIN_SSMA_REVIS
$grAttr = $xtmp->grAttrib;
$grAttr['class'] = "hidden";
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_SSMA_REVIS");
$xtmp->setFieldWrapper("view01","0.0","vin_ssma","VIN_SSMA_REVIS","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

//VIN_SSMA_SUPER
$grAttr = $xtmp->grAttrib;
$grAttr['class'] = "hidden";
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VIN_SSMA_SUPER");
$xtmp->setFieldWrapper("view01","0.0","vin_ssma","VIN_SSMA_SUPER","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


// VIN_SSMA_LINKS
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "VIN_SSMA_LINKS";
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$inAttr['value'] = 0;
$xtmp->setFieldWrapper("view01","1.2","vin_ssma","VIN_SSMA_LINKS","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("VIEW01","0.0","vin_ssit","VIN_SSIT_ITMID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VIN_ITEM_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("VIEW01","0.0","vin_ssma","idVIN_ITEM","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
?>
		
		</div>
		<div class="col-sm-7">
		<?php
		echo '<table class="" width="100%;">

      	<tr class="text-primary bg-primary">
				<td></td>  
				<td class="small"><label ab-label="VIN_SSMA_SPEID">Spec. Sheet ID Code</label></td>
				<td class="small"><label ab-label="STD_DESCRIPTION">VIN_SSMA_DESCR </label></td>
			    <td class="small"><label  ab-label="STD_DOS_OR_DOM">VIN_SSMA_DOMOS </label></td>		
		        <td class="small"><label ab-label="VIN_ITEM_SUETA">Delivery Lead Time Days</label></td>
				<td class="small"><label ab-label="VIN_SSMA_SHLIF">Shelf Life Days </label></td>
		</tr>';
      
        echo '<tr ng-repeat="spec in vin_ssmaList[0].rowSet |AB_noDoubles:\'idVIN_SSMA\'" ng-if="spec.idVIN_SSMA>0" class="ab-spaceless {{spec.idVIN_SSMA!=idVIN_SSMA?\'\':\'bg-info\'}}" >';
        echo '<td  class="ab-spaceless"><a target="{{'. 'ABtarget}}" ng-click="setUpdType(spec.idVIN_SSMA);">';
?>
			<span class="text-primary small"  >
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
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_LSHE DOMDA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{spec.VIN_SSMA_DESCR}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_SSMA_DOMOS
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{spec.VIN_SSMA_DOMOS}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_SSMA_SUETA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{spec.VIN_SSMA_SUETA}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_SSMA_SHLIF
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{spec.VIN_SSMA_SHLIF}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td>';
?>
</tr></table>
		</div>

		<div class="col-sm-7 text-middle "  style="padding:50px;">

		<table class="" style="width:95%;" >
		<tr>
		<td>&nbsp;</td>
		<td class="small">
		<a target="{{ABtarget}}" href="#VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:0,idVIN_ITEM:{{opts.idVIN_ITEM}},updType:CREATE,Session:VIN_LOTCT,Process:VIN_ITEMS">
			<span >
			New Lot
			<span class="glyphicon glyphicon-pencil" ></span>
			</span>
		</a>
		</td>
		</tr>		
		<tr class="bg-primary  ">
		<td>&nbsp;</td>
		<td class="small">
			<span >
			Select Lot
			</span>
		</a>
		</td>
		<td class="small"><label  ab-label="VIN_LSHE_LOTID">Lot Identification</label></td>
		<td class="small"><label  ab-label="STD_DOS_OR_DOM">VIN_LSHE_DOMDA </label></td>
		<td class="small"><label  ab-label="VIN_LSHE_DOMOS">VIN_LSHE_DOMOS </label>	
			<!-- YR20160620 -->
			<input class="hidden" size=5 ng-model="idVIN_LSHE_LISTorg" />&nbsp;
			<input class="hidden" size=5 ng-model="idVIN_LSHE_LIST" ab-orgval="{{idVIN_LSHE_LISTorg}}" />
		</td>
		<td class="small"><label  ab-label="VIN_LSHE_DATES">Shelf Life ends </label></td>
		<td class="small"  ><input type="checkbox" ng-model="clsdlot" ng-init="clsdlot=false"/>&nbsp;Display Closed Lots</td>		
				<!--<td class="small"><label  ab-label="VIN_LSHE_DATES">Shelf Life ends</label></td> -->
		</tr>
<?php
echo '<tr ng-repeat="k in vin_ssmaList[0].rowSet |AB_noDoubles:\'idVIN_LSHE\'" ng-if="k.idVIN_LSHE>0 && k.VIN_LSHE_SOLDO == 0" class="ab-spaceless {{clsdlot!=1?\'\':\'hidden\'}}">';
?>
	<td>&nbsp;</td>
   <td> 
		<input ng-if="idVIN_LSHE_LIST.indexOf(',' + k.idVIN_LSHE + ',')== -1" ng-click="toggleLotLink(k.idVIN_LSHE);" type="checkbox" />
		<input ng-if="idVIN_LSHE_LIST.indexOf(',' + k.idVIN_LSHE + ',')> -1"  ng-click="toggleLotLink(k.idVIN_LSHE);" type="checkbox"  checked />
	</td><td>       

<?php

// VIN_LSHE LOT ID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_LOTID}}</label>';
$hardCode .= '<span class="small {{k.VIN_LSHE_SERNO>0?' . "'':'hidden'}}" . '" >[{{' . ' k.VIN_LSHE_SERNO}}]</span></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_LSHE DOMDA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_DOMDA}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_LSHE DOMDA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_DOMOS}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_LSHE DATES
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_DATES}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td>';

echo '<td  class="ab-spaceless"><a  target="{{'.'ABtarget}}" href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:{{k.idVIN_LSHE}},idVIN_ITEM:{{ k.idVIN_ITEM }},updType:UPDATE,Session:VIN_LOTCT,Process:VIN_ITEMS">
			<span class="text-primary small">
			Edit
			<span class="glyphicon glyphicon-pencil" ></span>
			</span>
			</a></td></tr>';

echo '<tr ng-repeat="k in vin_ssmaList[0].rowSet |AB_noDoubles:\'idVIN_LSHE\'" ng-if="k.idVIN_LSHE>0 && k.VIN_LSHE_SOLDO == 1" class="ab-spaceless {{clsdlot!=0?\'\':\'hidden\'}}">';
?>
   <td> 
   	<input ng-if="idVIN_LSHE_LIST.indexOf(',' + k.idVIN_LSHE + ',')== -1" ng-click="toggleLotLink(k.idVIN_LSHE);" type="checkbox" />
		<input ng-if="idVIN_LSHE_LIST.indexOf(',' + k.idVIN_LSHE + ',')> -1"  ng-click="toggleLotLink(k.idVIN_LSHE);" type="checkbox"  checked />
	</td> <td>       

<?php

// VIN_LSHE LOT ID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_LOTID}}</label>';
$hardCode .= '<span class="small {{k.VIN_LSHE_SERNO>0?' . "'':'hidden'}}" . '" >[{{' . ' k.VIN_LSHE_SERNO}}]</span></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_LSHE DOMDA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_DOMDA}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_LSHE DOMDA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_DOMOS}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td>';

// VIN_LSHE DATES
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_DATES}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_ssma","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td>'; 

echo '<td  class="ab-spaceless"><a  target="{{'.'ABtarget}}" href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:{{k.idVIN_LSHE}},idVIN_ITEM:{{ k.idVIN_ITEM }},updType:UPDATE,Session:VIN_LOTCT,Process:VIN_ITEMS">
			<span class="text-primary small">
			Edit
			<span class="glyphicon glyphicon-pencil" ></span>
			</span>
			</a></td></tr>';

?>

		</table>
		</div>
		</form>
	</div>
	
</div>
