
<div class="{{ABsearchTbl=='ABsearchvin_item_list'?'':'hidden'}}" >
<div class="hidden" ab-remark="String Labels">
<span ab-label="VIN_ITEM_SEAR1"></span>
<span ab-label="VIN_ITEM_SCUOM"></span>
<span ab-label="VIN_ITEM_SEAR1"></span>
<span ab-label="VIN_ITEM_SEAR1"></span>
<span ab-label="VIN_ITEM_SEAR1"></span>

</div>
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VIN_ITEM_ITMID_ABR";
$sparm["searchTable"] = "vin_item";
$sparm["searchJoin"] = "vin_lshe";
$sparm["searchResult"] = "ABsearchvin_item_list";
$sparm["searchFilter"] = "hidd2en";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VIN_ITEM_ITMID,VIN_ITEM_LOTCT";
$sparm["rootGroup"] = "VIN_ITEM_SEAR1:vin_ityp:idVIN_ITYP:VIN_ITYP_DESCR";
$sparm["rootGroup"] .= ",VIN_ITEM_ITGRP:vin_grou:idVIN_GROU:VIN_GROU_DESCR";

$hardCode = $xtmp->setSearchMaster($sparm);
// echo $hardCode;
?>

<table>
<tr>
<td>
<?php echo $hardCode; ?>
</td>
</tr>
</table>

	
	<div class="ab-wrapper-div">
		<table class="text-primary ab-strong" style="width:100%;" >
			<tr class="">
				<td style="width:10%;" ></td>
				<td style="width:30%;" ><span ab-label="STD_ID_CODE">ID</span></td>
				<td style="width:30%;" ><span ab-label="STD_DESCR">Bname</span></td>
				<td style="width:30%;" >
					<span ab-label="VIN_LSHE_LOTID">ID</span>
					Hello
				</td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div">
		<table class="table-striped" style="width:100%;" >
			<tr class="ab-border ab-spaceless" ng-repeat="item in ABsearchvin_item_list | AB_noDoubles:'idVIN_ITEM'  | AB_Sorted:'VIN_ITEM_ITMID' " >
				<td style="width:9%;" >
					<span   class="text-primary ab-pointer" ab-label="STD_SELECT"
					ng-click="ABsessionSetResponseLocal(item)" >Select..</span>
					
					
				
				</td>	
				
				<td style="width:30%;" >
					{{ item.VIN_ITEM_ITMID }}
				</td>
				<td style="width:30%;" >
					{{ item.VIN_ITEM_DESC1 }} 
					
				</td>
				<td style="width:30%;" >
					<table style="width:100%;" ng-if="item.VIN_ITEM_LOTCT=='1'" >
						<tr >
							<td>
								<span 	class="text-primary ab-pointer" 
									itid="#itm-{{item.idVIN_ITEM}}"
									onclick="$($(this).attr('itid')).toggleClass('hidden');" 
								>
									<span ab-label="STD_ACTIVE"></span>
									<span class="caret"></span>
								</span>
								
							</td>
							<td >
								<span 	class="text-primary ab-pointer" 
									itid="#itmso-{{item.idVIN_ITEM}}"
									onclick="$($(this).attr('itid')).toggleClass('hidden');" 
								>
									<span ab-label="VIN_LSHE_SOLDO"></span>
									<span class="caret"></span>
								</span>
							</td>
						</tr>
							
						<tr id="itm-{{item.idVIN_ITEM}}" class="hidden ab-border" >
							<td class="ab-top ab-strong" ><span ab-label="STD_ACTIVE"></span></td>
							<td >
								<span 	ng-repeat="lots in ABsearchvin_item_list | AB_noDoubles:'idVIN_LSHE' " 
								ng-if="item.idVIN_ITEM==lots.VIN_LSHE_ITMID && lots.VIN_LSHE_SOLDO=='0'">
								
								{{lots.VIN_LSHE_LOTID}}-{{lots.VIN_LSHE_SERNO}}<br>
								</span>
							</td>
						</tr>
						<tr id="itmso-{{item.idVIN_ITEM}}" class="hidden ab-border" >
							<td class="ab-top ab-strong"  ><span ab-label="VIN_LSHE_SOLDO"></span></td>
							<td >
								<span 	ng-repeat="lots in ABsearchvin_item_list | AB_noDoubles:'idVIN_LSHE' " 
								ng-if="item.idVIN_ITEM==lots.VIN_LSHE_ITMID && lots.VIN_LSHE_SOLDO=='1'">
								
								{{lots.VIN_LSHE_LOTID}}-{{lots.VIN_LSHE_SERNO}}<br>
								</span>
							</td>
						</tr>
					</table>
				</td>
				<td class="width:1%;">
					<span ng-if="$last==true"><span ng-init="ABgetLabels();"></span></span>
				</td>
			</tr>
		</table>
	</div>
</div>
