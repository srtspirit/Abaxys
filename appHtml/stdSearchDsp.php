<?php

function genOrgDimSel($tblName,$fieldDim,$fieldId,$fieldDescr)
{

$fieldIdName = $fieldId;
if(strpos($fieldIdName,".") > 0)
{
	$fieldIdName = substr($fieldIdName,strpos($fieldIdName,".")+1);
}

$fieldDimName = $fieldDim;
if(strpos($fieldDimName,".") > 0)
{
	$fieldDimName = substr($fieldDimName,strpos($fieldDimName,".")+1);
}


$ret = <<<EOC

	<span ng-repeat="org in ABorgDimensions" >
	 
		<span class="text-success ab-strong ab-border ab-spaceless small"  
		ng-if="{$fieldDim}.indexOf(',' + org.levelId + ',')>-1">
			<span class="ab-pointer" ng-click="dbOrgCheck(org.levelDescr+ ' - ' + {$fieldDescr},'{$tblName}','{$fieldIdName}','{$fieldDimName}',{$fieldDim},{$fieldId},org.levelId*-1)" title="turn off in {{org.levelDescr}}">
				<span class="glyphicon glyphicon-ok" ></span>{{org.levelDescr}}
			</span>	
			&nbsp;
		</span>
		
		<span class="text-muted ab-border ab-spaceless small"  
		ng-if="{$fieldDim}.indexOf(',' + org.levelId + ',')==-1">
			<span class="ab-pointer" ng-click="dbOrgCheck(org.levelDescr + ' - ' + {$fieldDescr},'{$tblName}','{$fieldIdName}','{$fieldDimName}',{$fieldDim},{$fieldId},org.levelId)" title="share with {{org.levelDescr}}">
				&nbsp;{{org.levelDescr}}
			</span>	
			&nbsp;
		</span>
	</span>
	
EOC;

return $ret;	

}



?>
<div ab-master-org="" class="hidden" >
<input class="hidden" ng-model="currentOrg" ng-init="currentOrg=''" />
<span ab-table="vgb_cust" ng-click="ABsearchTbl='vgb_cust'" >CUST</span>&nbsp;
<span ab-table="vgb_supp" ng-click="ABsearchTbl='vgb_supp'" >SUPP</span>&nbsp;
<span ab-table="vin_item" ng-click="ABsearchTbl='vin_item'" >ITEM</span>
</div>

<?php require_once "../stdSscript/stdAppobjGen.php"; ?>

<!-- Customers -->

<div class="{{ABsearchTbl=='ABsearchvgb_cust'?'':'hidden'}}" >

<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VGB_CUST_BPART";
$sparm["searchTable"] = "vgb_cust";
$sparm["searchJoin"] = "vgb_bpar,vgb_addr";
$sparm["searchResult"] = "ABsearchvgb_cust";
$sparm["searchFilter"] = "hid2den";
$sparm["filterExclude"] = "VGB_BPAR_BPNAM,VGB_BPAR_CDATE";
$sparm["filterAuto"] = "VGB_BPAR_BPART";
$sparm["rootGroup"] = "VGB_CUST_MRKID:vgb_mark:idVGB_MARK:VGB_MARK_DESCR";
$sparm["rootGroup"] .= ",VGB_CUST_CUTYP:vgb_ctyp:idVGB_CTYP:VGB_CTYP_DESCR";
$sparm["rootGroup"] .= ",VGB_CUST_SLSRP:vgb_slrp:idVGB_SLRP:VGB_SLRP_SRNAM";

$hardCode = $xtmp->setSearchMaster($sparm);





?>

<table>
<tr>
<td>
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvgb_cust'" >
	<span id="ab-org-master-mess"></span>
</td>
</tr>
</table>



	<div class="ab-wrapper-div">
		<table class="text-primary ab-strong" style="width:100%;" >
			<tr class="">
				<td style="width:10%;" >
				<span class="hidden">
					<span ab-label="VGB_CUST_MRKID"></span>
					<span ab-label="VGB_CUST_CUTYP"></span>
					<span ab-label="VGB_CUST_SLSRP"></span>
					<span ab-label=""></span>
					
					
				</span>
				
				</td>
				<td style="width:20%;" ><span ab-label="STD_ID_CODE">ID</span></td>
				<td style="width:20%;" ><span ab-label="STD_NAME">Bname</span></td>
				<td style="width:50%;" >
					<table style="width:100%;">
						<tr>
							<td style="width:40%;" ><span ab-label="STD_ADDR_DESCR">ID</span></td>
							<td style="width:40%;" ><span ab-label="STD_CONTACT">ID</span></td>
							<td style="width:20%;" ><span ab-label="STD_TEL">ID</span></td>
						</tr>
					</table>			
				</td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div">
		<table class="table-striped" style="width:100%;" >
			<tr class="ab-border ab-spaceless" ng-repeat="cust in ABsearchvgb_cust | AB_noDoubles:'idVGB_CUST' | AB_Sorted:'VGB_BPAR_BPART' " >
				<td style="width:10%;"  >
					<table>
					<tr>
					<td>
						<span ng-if="!ABorgDimensions" class="text-primary ab-pointer" ab-label="STD_SELECT"
							ng-click="ABsessionSetResponseLocal(cust)" >
							Select..
						</span>
					</td>	
					<td ng-if="ABorgDimensions" >
					<?php echo genOrgDimSel("vgb_cust","cust.VGB_CUST_AB_DILEVEL","cust.idVGB_CUST","cust.VGB_BPAR_BPART"); ?>
					</td>
					</tr>
					</table>
				</td>
				<td style="width:20%;" >
					{{ cust.VGB_BPAR_BPART }}
				</td>
				<td style="width:20%;" >
					{{ cust.VGB_CUST_BPNAM }}:{{cust.VGB_CUST_CRELI}}
					
				</td>
				<td style="width:50%;" >
					<table style="width:100%;">
						<tr ng-repeat="addr in ABsearchvgb_cust | AB_noDoubles:'idVGB_ADDR' " ng-if="cust.idVGB_BPAR==addr.VGB_ADDR_BPART">
							<td style="width:40%;" >{{addr.VGB_ADDR_DESCR}}</td>
							<td style="width:40%;" >{{addr.VGB_ADDR_CONT1}}</td>
							<td style="width:20%;" >{{addr.VGB_ADDR_TEL01}}</td>
						</tr>
					</table>
				</td>
			
			</tr>
		</table>

	</div>
</div>

<!-- suppliers -->
<div class="{{ABsearchTbl=='ABsearchvgb_supp'?'':'hidden'}}" >
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VGB_SUPP_BPART";
$sparm["searchTable"] = "vgb_supp";
$sparm["searchJoin"] = "vgb_bpar,vgb_addr";
$sparm["searchResult"] = "ABsearchvgb_supp";
$sparm["searchFilter"] = "hidd5en";
$sparm["filterExclude"] = "VGB_BPAR_BPNAM,VGB_BPAR_CDATE";
$sparm["filterAuto"] = "VGB_BPAR_BPART";

$hardCode = $xtmp->setSearchMaster($sparm);
// echo $hardCode;
?>


<table>
<tr>
<td>
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvgb_supp'" >
	<span id="ab-org-master-mess"></span>
</td>
</tr>
</table>

<!--
	<form >
		<span class="text-primary small" ab-label="VGB_SUPP_BPART" >{{ABsearchTbl}}</span>
		<input ng-model="ABsPattern" class="small" />
		<button id="{{ABsearchTbl=='vgb_supp'?'ABsPattern':''}}" class="ab-borderless text-primary small" 
		ng-click="ABsearchAlias('vgb_supp','vgb_bpar,vgb_addr',ABsPattern,'ABsearch')" >Find</button>
	</form>
-->	
	<div class="ab-wrapper-div">
		<table class="text-primary ab-strong" style="width:100%;" >
			<tr class="">
				<td style="width:10%;" ></td>
				<td style="width:20%;" ><span ab-label="STD_ID_CODE">ID</span></td>
				<td style="width:20%;" ><span ab-label="STD_NAME">Bname</span></td>
				<td style="width:50%;" >
					<table style="width:100%;">
						<tr>
							<td style="width:40%;" ><span ab-label="STD_ADDR_DESCR">ID</span></td>
							<td style="width:40%;" ><span ab-label="STD_CONTACT">ID</span></td>
							<td style="width:20%;" ><span ab-label="STD_TEL">ID</span></td>
						</tr>
					</table>			
				</td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div">
		<table class="table-striped" style="width:100%;" >
			<tr class="ab-border ab-spaceless" ng-repeat="supp in ABsearchvgb_supp | AB_noDoubles:'idVGB_SUPP' | AB_Sorted:'VGB_BPAR_BPART' " >
				<td style="width:10%;"  >
				
					<span ng-if="!ABorgDimensions" class="text-primary ab-pointer" ab-label="STD_SELECT"
					ng-click="ABsessionSetResponseLocal(supp)" >Select..</span>
					
				
					<span ng-if="ABorgDimensions" >
					<?php echo genOrgDimSel("vgb_supp","supp.VGB_SUPP_AB_DILEVEL","supp.idVGB_SUPP","csupp.VGB_BPAR_BPART"); ?>
					</span>
				</td>
				
				<td style="width:20%;" >
					{{ supp.VGB_BPAR_BPART }}
				</td>
				<td style="width:20%;" >
					{{ supp.VGB_SUPP_BPNAM }}
					
				</td>
				<td style="width:50%;" >
					<table style="width:100%;">
						<tr ng-repeat="addr in ABsearchvgb_supp | AB_noDoubles:'idVGB_ADDR' " ng-if="supp.idVGB_BPAR==addr.VGB_ADDR_BPART">
							<td style="width:40%;" >{{addr.VGB_ADDR_DESCR}}</td>
							<td style="width:40%;" >{{addr.VGB_ADDR_CONT1}}</td>
							<td style="width:20%;" >{{addr.VGB_ADDR_TEL01}}</td>
						</tr>
					</table>
				</td>
			
			</tr>
		</table>
	</div>
</div>

<!-- Item -->
<div class="{{ABsearchTbl=='ABsearchvin_item'?'':'hidden'}}" >
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
$sparm["searchResult"] = "ABsearchvin_item";
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
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvin_item'" >
	<span id="ab-org-master-mess"></span>
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
					<span ab-label="VIN_LSHE_LOTID">ID</span></td>
				</td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div">
		<table class="table-striped" style="width:100%;" >
			<tr class="ab-border ab-spaceless" ng-repeat="item in ABsearchvin_item | AB_noDoubles:'idVIN_ITEM'  | AB_Sorted:'VIN_ITEM_ITMID' " >
				<td style="width:9%;" >
					<span  ng-if="!ABorgDimensions" class="text-primary ab-pointer" ab-label="STD_SELECT"
					ng-click="ABsessionSetResponseLocal(item)" >Select..</span>
					
					
				
					<span ng-if="ABorgDimensions" >
						<?php echo genOrgDimSel("vin_item","item.VIN_ITEM_AB_DILEVEL","item.idVIN_ITEM","item.VIN_ITEM_ITMID"); ?>
					</span>
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
								<span 	ng-repeat="lots in ABsearchvin_item | AB_noDoubles:'idVIN_LSHE' " 
								ng-if="item.idVIN_ITEM==lots.VIN_LSHE_ITMID && lots.VIN_LSHE_SOLDO=='0'">
								
								{{lots.VIN_LSHE_LOTID}}-{{lots.VIN_LSHE_SERNO}}<br>
								</span>
							</td>
						</tr>
						<tr id="itmso-{{item.idVIN_ITEM}}" class="hidden ab-border" >
							<td class="ab-top ab-strong"  ><span ab-label="VIN_LSHE_SOLDO"></span></td>
							<td >
								<span 	ng-repeat="lots in ABsearchvin_item | AB_noDoubles:'idVIN_LSHE' " 
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


<!-- vgb_slrp -->
<div class="{{ABsearchTbl=='ABsearchvgb_slrp'?'':'hidden'}}" >
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VSL_HR_BPIT_00_SLSRP";
$sparm["searchTable"] = "vgb_slrp";
$sparm["searchJoin"] = "";
$sparm["searchResult"] = "ABsearchvgb_slrp";
$sparm["searchFilter"] = "hidd2en";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VGB_SLRP_SLSRP,VGB_SLRP_SRNAM";
$hardCode = $xtmp->setSearchMaster($sparm);
// echo $hardCode;
?>

<table>
<tr>
<td>
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvgb_slrp'" >
	<span id="ab-org-master-mess"></span>
</td>
</tr>
</table>

	
	<div class="ab-wrapper-div">
		<table class="text-primary ab-strong" style="width:100%;" >
			<tr class="">
				<td style="width:10%;" ></td>
				<td style="width:30%;" ><span ab-label="VGB_SLRP_SLSRP">ID</span></td>
				<td style="width:30%;" ><span ab-label="STD_DESCR">Bname</span></td>
				<td style="width:30%;" >
					
				</td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div">
		<table class="table-striped" style="width:100%;" >
			<tr class="ab-border ab-spaceless" ng-repeat="rep in ABsearchvgb_slrp | AB_noDoubles:'idVGB_SLRP'  | AB_Sorted:'VGB_SLRP_SLSRP' " >
				<td style="width:9%;" >
					<span ng-if="!ABorgDimensions" class="text-primary ab-pointer" ab-label="STD_SELECT"
					ng-click="ABsessionSetResponseLocal(rep)" >Select..</span>
					
					
					<span ng-if="ABorgDimensions" >
					<?php echo genOrgDimSel("vgb_slrp","rep.VGB_SLRP_AB_DILEVEL","rep.idVGB_SLRP","rep.VGB_SLRP_SLSRP"); ?>
					</span>
				</td>

				<td style="width:30%;" >
					{{ rep.VGB_SLRP_SLSRP }}
				</td>
				<td style="width:30%;" >
					{{ rep.VGB_SLRP_SRNAM }} 
				</td>
				<td style="width:30%;" >
					
				</td>
				<td class="width:1%;">
					<span ng-if="$last==true"><span ng-init="ABgetLabels();"></span></span>
				</td>
			</tr>
		</table>
	</div>
</div>

<!-- vgb_term -->
<div class="{{ABsearchTbl=='ABsearchvgb_term'?'':'hidden'}}" >
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VPU_ORSIPR_TERM";
$sparm["searchTable"] = "vgb_term";
$sparm["searchJoin"] = "";
$sparm["searchResult"] = "ABsearchvgb_term";
$sparm["searchFilter"] = "hidd2en";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VGB_TERM_TERID,VGB_TERM_DESCR";
$hardCode = $xtmp->setSearchMaster($sparm);
// echo $hardCode;
?>


<table>
<tr>
<td>
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvgb_term'" >
	<span id="ab-org-master-mess"></span>
</td>
</tr>
</table>

	
	<div class="ab-wrapper-div">
		<table class="text-primary ab-strong" style="width:100%;" >
			<tr class="">
				<td style="width:10%;" ></td>
				<td style="width:30%;" ><span ab-label="VGB_SLRP_SLSRP">ID</span></td>
				<td style="width:30%;" ><span ab-label="STD_DESCR">Bname</span></td>
				<td style="width:30%;" >
					
				</td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div">
		<table class="table-striped" style="width:100%;" >
			<tr class="ab-border ab-spaceless" ng-repeat="rep in ABsearchvgb_term | AB_noDoubles:'idVGB_TERM'  | AB_Sorted:'VGB_SLRP_SLSRP' " >
				<td style="width:9%;" >
					<span ng-if="!ABorgDimensions"  class="text-primary ab-pointer" ab-label="STD_SELECT"
					ng-click="ABsessionSetResponseLocal(rep)" >Select..</span>

					<span ng-if="ABorgDimensions" >
						<?php echo genOrgDimSel("vgb_term","rep.VGB_TERM_AB_DILEVEL","rep.idVGB_TERM","rep.VGB_TERM_TERID"); ?>
					</span>
				</td>
				
				<td style="width:30%;" >
					{{ rep.VGB_TERM_TERID }}
				</td>
				<td style="width:30%;" >
					{{ rep.VGB_TERM_DESCR }} 
				</td>
				<td style="width:30%;" >
					
				</td>
				<td class="width:1%;">
					<span ng-if="$last==true"><span ng-init="ABgetLabels();"></span></span>
				</td>
			</tr>
		</table>
	</div>
</div>

<!-- cfg_menugroup -->


<div ab-params="cfg_menugroup" class="hidden" ></div>
<div ng-if="ABorgDimensions"   class="{{ABsearchTbl=='ABsearchcfg_menugroup'?'':'hidden'}}" >
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "STD_MENU";
$sparm["searchTable"] = "cfg_menugroup";
 
$sparm["searchJoin"] = "cfg_menu,cfg_session";
$sparm["searchResult"] = "ABsearchcfg_menugroup";
$sparm["searchFilter"] = "hidd2en";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "";
$hardCode = $xtmp->setSearchMaster($sparm);
// echo $hardCode;
?>


<table>
<tr>
<td>
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchcfg_menugroup'" >
	<span id="ab-org-master-mess"></span>
</td>
</tr>
</table>

	
	<div class="ab-wrapper-div">
		<table class="text-primary ab-strong" style="width:100%;" >
			<tr class="">
				<td style="width:5%;" ></td>
				<td style="width:15%;" ><span ab-label="CFG_MENU_CODE">Menu Code</span></td>
				<td style="width:15%;" ><span ab-label="STD_DESCR">Descr.</span></td>
				<td style="width:15%;" ><span ab-label="CFG_SESSION_CODE">Session Code</span></td>
				<td style="width:30%;" ><span ab-label="STD_DESCR">Bname</span></td>
				<td style="width:20%;" >
					
				</td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div">
		<table class="table-striped" style="width:100%;" >
			<tr class="ab-border ab-spaceless" ng-repeat="rep in ABsearchcfg_menugroup | AB_noDoubles:'CFG_MENU_CODE'  | AB_Sorted:'CFG_MENU_DESCR,CFG_SESSION_DESIGNATION' " >
				<td style="width:5%;vertical-align:top;" >
					<span ng-if="!ABorgDimensions"  class="text-primary ab-pointer" ab-label="STD_SELECT"
					ng-click="ABsessionSetResponseLocal(rep)" >Select..</span>

				</td>
				<td style="width:15%;vertical-align:top;" >
					{{ rep.CFG_MENU_CODE}} 
				</td>
				<td style="width:15%;vertical-align:top;" >
					{{ rep.CFG_MENU_DESCR}} 
				</td>
				
				<td style="width:45%;vertical-align:top;" >
					<table class="table-striped" style="width:100%;" >
						<tr class="ab-border ab-spaceless" ng-repeat="repDet in ABsearchcfg_menugroup | AB_noDoubles:'idCFG_MENUGROUP'  | AB_Sorted:'CFG_SESSION_DESIGNATION' " 
						ng-if="repDet.CFG_MENU_CODE==rep.CFG_MENU_CODE"
						>
							<td style="width:25%;" >
								{{ repDet.CFG_SESSION_CODE}}
							</td>
							<td style="width:75%;" >
								{{ repDet.CFG_SESSION_DESIGNATION}} 
							</td>
						</tr>
					</table>
				</td>
				
				<td style="width:20%;" >
					<span ng-if="$last==true"><span ng-init="ABgetLabels();"></span></span>
				</td>
			</tr>
		</table>
	</div>
</div>

<!-- vgl_fpctr  -->


<div ab-params="vgl_fpctr" class="hidden" ></div>
<div ng-if="ABorgDimensions"   class="{{ABsearchTbl=='ABsearchvgl_fpctr'?'':'hidden'}}" >
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "STD_MENU";
$sparm["searchTable"] = "vgl_fpctr";
 
$sparm["searchJoin"] = "";
$sparm["searchResult"] = "ABsearchvgl_fpctr";
$sparm["searchFilter"] = "hidd2en";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "";
$hardCode = $xtmp->setSearchMaster($sparm);
// echo $hardCode;
?>


<table>
<tr>
<td>
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvgl_fpctr'" >
	<span id="ab-org-master-mess"></span>
</td>
</tr>
</table>

	
	<div class="ab-wrapper-div">
		<table class="text-primary ab-strong" style="width:100%;" >
			<tr class="">
				<td style="width:10%;" ></td>
				<td style="width:20%;" ><span ab-label="VGL_FPCTR_YEAR">VGL_FPCTR_YEAR</span></td>
				<td style="width:20%;" ><span ab-label="VGL_FPCTR_SMONTH">VGL_FPCTR_SMONTH</span></td>
				<td style="width:20%;" ><span ab-label="VGL_FPCTR_PCOUNT">VGL_FPCTR_PCOUNT</span></td>
				<td style="width:20%;" ><span ab-label="VGL_FPCTR_CLOSED">VGL_FPCTR_CLOSED</span></td>
				<td style="width:10%;" >
					
				</td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div">
		<table class="table-striped" style="width:100%;" >
			<tr class="ab-border ab-spaceless" ng-repeat="rep in ABsearchvgl_fpctr  " >
				<td style="width:10%;vertical-align:top;" >
					<span ng-if="!ABorgDimensions"  class="text-primary ab-pointer" ab-label="STD_SELECT"
					ng-click="ABsessionSetResponseLocal(rep)" >Select..</span>

				</td>
				<td style="width:20%;vertical-align:top;" >
					{{ rep.VGL_FPCTR_YEAR}} 
				</td>
				<td style="width:20%;vertical-align:top;" >
					{{ rep.VGL_FPCTR_SMONTH}} 
				</td>
				
				<td style="width:20%;vertical-align:top;" >
					{{ rep.VGL_FPCTR_PCOUNT}} 
				</td>
				<td style="width:20%;vertical-align:top;" >
					<span class="{{rep.VGL_FPCTR_CLOSED==0?'':'hidden'}}" ab-label="STD_NO"></span>
					<span class="{{rep.VGL_FPCTR_CLOSED==1?'':'hidden'}}" ab-label="STD_YES"></span>
				</td>
				
				<td style="width:10%;" >
					<span ng-if="$last==true"><span ng-init="ABgetLabels();"></span></span>
				</td>
			</tr>
		</table>
	</div>
</div>


<!-- 	vgb_nfnu  -->


<div ab-params="vgb_nfnu" class="hidden" ></div>
<div ng-if="ABorgDimensions"   class="{{ABsearchTbl=='ABsearchvgb_nfnu'?'':'hidden'}}" >
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "STD_MENU";
$sparm["searchTable"] = "vgb_nfnu";
 
$sparm["searchJoin"] = "";
$sparm["searchResult"] = "ABsearchvgb_nfnu";
$sparm["searchFilter"] = "hidd2en";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "";
$hardCode = $xtmp->setSearchMaster($sparm);
// echo $hardCode;
?>


<table>
<tr>
<td>
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvgb_nfnu'" >
	<span id="ab-org-master-mess"></span>
</td>
</tr>
</table>

	
	<div class="ab-wrapper-div">
		<table class="text-primary ab-strong" style="width:100%;" >
			<tr class="">
				<td style="width:10%;" ></td>
				<td style="width:20%;" ><span ab-label="VGB_NFNU_NFNCO">VGB_NFNU_NFNCO</span></td>
				<td style="width:20%;" ><span ab-label="VGB_NFNU_DESCR">VGB_NFNU_DESCR</span></td>
				<td style="width:20%;" ><span ab-label="VGB_NFNU_NFNVA">VGB_NFNU_NFNVA</span></td>
				<td style="width:20%;" ><span ab-label="VGB_NFNU_AB_DILEVEL">VGB_NFNU_AB_DILEVEL</span></td>
				<td style="width:10%;" >
					
				</td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div">
		<table class="table-striped" style="width:100%;" >
			<tr class="ab-border ab-spaceless" ng-repeat="rep in ABsearchvgb_nfnu  | AB_Sorted:'VGB_NFNU_NFNCO,VGB_NFNU_AB_DILEVEL' " >
				<td style="width:10%;vertical-align:top;" >
					<span ng-if="!ABorgDimensions"  class="text-primary ab-pointer" ab-label="STD_SELECT"
					ng-click="ABsessionSetResponseLocal(rep)" >Select..</span>

				</td>
				<td style="width:20%;vertical-align:top;" >
					{{ rep.VGB_NFNU_NFNCO}} 
				</td>
				<td style="width:20%;vertical-align:top;" >
					{{ rep.VGB_NFNU_DESCR}} 
				</td>
				
				<td style="width:20%;vertical-align:top;" >
					{{ rep.VGB_NFNU_NFNVA}} 
				</td>
				<td style="width:20%;vertical-align:top;" >
					<span ng-repeat="org in ABorgDimensions" >
						<span class="text-muted ab-border ab-spaceless small"  
						ng-if="rep.VGB_NFNU_AB_DILEVEL.indexOf(',' + org.levelId )!=-1">
							<span class="ab-pointer" >
								&nbsp;{{org.levelDescr}}
							</span>	
							&nbsp;
						</span>
					</span>	
				</td>
				
				<td style="width:10%;" >
					<span ng-if="$last==true"><span ng-init="ABgetLabels();"></span></span>
				</td>
			</tr>
		</table>
	</div>
</div>


<!-- 	vgl_nfnu  -->


<div ab-params="vgl_nfnu" class="hidden" ></div>
<div ng-if="ABorgDimensions"   class="{{ABsearchTbl=='ABsearchvgl_nfnu'?'':'hidden'}}" >
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "STD_MENU";
$sparm["searchTable"] = "vgl_nfnu";
 
$sparm["searchJoin"] = "";
$sparm["searchResult"] = "ABsearchvgl_nfnu";
$sparm["searchFilter"] = "hidd2en";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "";
$hardCode = $xtmp->setSearchMaster($sparm);
// echo $hardCode;
?>


<table>
<tr>
<td>
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvgl_nfnu'" >
	<span id="ab-org-master-mess"></span>
</td>
</tr>
</table>

	
	<div class="ab-wrapper-div">
		<table class="text-primary ab-strong" style="width:100%;" >
			<tr class="">
				<td style="width:10%;" ></td>
				<td style="width:20%;" ><span ab-label="VGL_NFNU_NFNCO">VGL_NFNU_NFNCO</span></td>
				<td style="width:20%;" ><span ab-label="VGL_NFNU_DESCR">VGL_NFNU_DESCR</span></td>
				<td style="width:20%;" ><span ab-label="VGL_NFNU_NFNVA">VGL_NFNU_NFNVA</span></td>
				<td style="width:20%;" ><span ab-label=""></span></td>
				<td style="width:10%;" >
					
				</td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div">
		<table class="table-striped" style="width:100%;" >
			<tr class="ab-border ab-spaceless" ng-repeat="rep in ABsearchvgl_nfnu  | AB_Sorted:'VGL_NFNU_NFNCO' " >
				<td style="width:10%;vertical-align:top;" >
					<span ng-if="!ABorgDimensions"  class="text-primary ab-pointer" ab-label="STD_SELECT"
					ng-click="ABsessionSetResponseLocal(rep)" >Select..</span>

				</td>
				<td style="width:20%;vertical-align:top;" >
					{{ rep.VGL_NFNU_NFNCO}} 
				</td>
				<td style="width:20%;vertical-align:top;" >
					{{ rep.VGL_NFNU_DESCR}} 
				</td>
				
				<td style="width:20%;vertical-align:top;" >
					{{ rep.VGL_NFNU_NFNVA}} 
				</td>
				<td style="width:20%;vertical-align:top;" >

				</td>
				
				<td style="width:10%;" >
					<span ng-if="$last==true"><span ng-init="ABgetLabels();"></span></span>
				</td>
			</tr>
		</table>
	</div>
</div>




<!-- 	vtx_schh   -->


<div ab-params="vtx_schh" class="hidden" ></div>
<div ng-if="ABorgDimensions"   class="{{ABsearchTbl=='ABsearchvtx_schh'?'':'hidden'}}" >
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "STD_MENU";
$sparm["searchTable"] = "vtx_schh";
 
$sparm["searchJoin"] = "vtx_sche,vgl_chart:idVGL_CHART=VTX_SCHE_GLIDN OR idVGL_CHART=VTX_SCHE_GLACR ";
$sparm["searchResult"] = "ABsearchvtx_schh";
$sparm["searchFilter"] = "hidd2en";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "";
$hardCode = $xtmp->setSearchMaster($sparm);


$chartDsp =<<<EOC

<div class="ab-wrapper-divsm" >
<table style="width:100%;" >
<tr class="ab-hover {{ glDta.idVGL_CHART==repDet.VTX_SCHE_GLIDN?'ab-strong text-primary ab-underline':'' }}" 
ng-click="repDet.VTX_SCHE_GLIDN_new=glDta.idVGL_CHART;repDet.VGL_CHART_GLIDN_new=glDta.VGL_CHART_GLIDN;repDet.VGL_CHART_GLDES_new=glDta.VGL_CHART_GLDES;"  ng-repeat="glDta in ABsearchvgl_chart | AB_Sorted:'VGL_CHART_GLIDN' " >
<td class="" >{{glDta.VGL_CHART_GLIDN}}</td>
<td>{{glDta.VGL_CHART_GLDES}}</td>
<td class="{{ glDta.idVGL_CHART==repDet.VTX_SCHE_GLIDN?'small text-right':'hidden' }}" >
<span class="ab-border" ab-label="STD_ORIGINAL" > Org.</span> </td>
</tr>
</table>
</div>

EOC;

$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "hidden";
$sparm["searchTable"] = "vgl_chart";
 
$sparm["searchJoin"] = "";
$sparm["searchResult"] = "ABsearchvgl_chart";
$sparm["searchFilter"] = "hidden";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VGL_CHART_GLIDN";
$sparm["dspViewer"] = $chartDsp;
$chartCode = $xtmp->setSearchMaster($sparm);



?>


<table ng-init="" >
<tr>
<td class="hidden" >
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvtx_schh'" ng-init="ABsearchAlias('vtx_schh','vtx_sche,vgl_chart:idVGL_CHART=VTX_SCHE_GLIDN OR idVGL_CHART=VTX_SCHE_GLACR ',ABsPatternABsearchvtx_schh,'ABsearchvtx_schh','','','','')">
	<span id="ab-org-master-mess"></span>
	
</td>
</tr>
</table>

	
	<div class="ab-wrapper-div">
		<div class="row text-primary ab-strong" style="width:100%;" >
				
				<div class="col-lg-1" ><span ab-label="VGL_BRCH_GLBID">Branch</span></div>
				<div class="col-lg-2" ><span ab-label="STD_SOURCE">STD_SOURCE</span></div>
				<div class="col-lg-7" style="vertical-align:top;" >

					<div class="row">
						<div class="col-lg-3" ><span ab-label="STD_ID_CODE">Code</span></div>
						<div class="col-lg-2" ><span ab-label="STD_REFERENCE">Ref.</span></div>
						<div class="col-lg-2" ><span ab-label="STD_POST">Post Column</span></div>
						<div class="col-lg-4" ><span ab-label="VGL_CHART_GLIDN">Chart Id</span></div>
					</div>
				</div>
				
				
		</div>
	</div>
	<div class="ab-wrapper-div">
		
			<div class="row  ab-border ab-spaceless" ng-repeat="rep in ABsearchvtx_schh | AB_noDoubles:'idVTX_SCHH'  | AB_Sorted:'VTX_SCHH_SCHID' " >
				<div class="col-lg-1" style="vertical-align:top;" >
				</div>
				<div class="col-lg-2" >
					<span >
						{{ rep.VTX_SCHH_SCHID}}  - {{rep.VTX_SCHE_SCHDE}}
					</span>
				</div>
				<div class="col-lg-7" style="vertical-align:top;" >
				
				
					<div class="row  ab-underline ab-spaceless"  ng-repeat="repDet in ABsearchvtx_schh | AB_noDoubles:'idVTX_SCHE'  | AB_Sorted:'VTX_SCHE_AB_DILEVEL' " 
					ng-if="rep.idVTX_SCHH==repDet.VTX_SCHE_SCHID"
					>
					
						<div class="col-lg-3" style="vertical-align:top;" >

						<div ng-if="ABsearchvtx_schh[0].idSelect!=repDet.idVTX_SCHE" >

						<input class="hidden" ng-model="repDet.VGL_PACC_DESCR_new" ng-init="repDet.VGL_PACC_DESCR_new=repDet.VGL_PACC_DESCR" />
						<input class="hidden" ng-model="repDet.VGL_PACC_DBCRT_new" ng-init="repDet.VGL_PACC_DBCRT_new=repDet.VGL_PACC_DBCRT" />
						<input class="hidden" ng-model="repDet.VGL_PACC_GLIDN_new" ng-init="repDet.VGL_PACC_GLIDN_new=repDet.VGL_PACC_GLIDN" />
						<input class="hidden" ng-model="repDet.VGL_CHART_GLIDN_new" ng-init="repDet.VGL_CHART_GLIDN_new=repDet.VGL_CHART_GLIDN" />
						<input class="hidden" ng-model="repDet.VGL_CHART_GLDES_new" ng-init="repDet.VGL_CHART_GLDES_new=repDet.VGL_CHART_GLDES" />
						
						</div>


						<form id="mainForm" ab-main="vtx_sche" ng-if="ABsearchvtx_schh[0].idSelect==repDet.idVTX_SCHE" >
						
						
<textarea class="hidden" ab-updSuccess="" >
$scope.ABsearchAlias('vtx_schh','vtx_sche,vgl_chart:idVGL_CHART=VTX_SCHE_GLIDN OR idVGL_CHART=VTX_SCHE_GLACR ',$scope.ABsPatternABsearchvtx_schh,'ABsearchvtx_schh','','$scope.ABsearchvtx_schh[0].idSelect='+$scope.ABsearchvtx_schh[0].idSelect+';','','')
</textarea>	
						
						<input class="hidden" ng-model="idVGL_PACC" ng-bind="idVTX_SCHE=repDet.idVTX_SCHE" />
						<input class="hidden" ng-model="VGL_PACC_DESCR" ng-bind="VGL_PACC_DESCR=repDet.VGL_PACC_DESCR_new" />
						<input class="hidden" ng-model="VGL_PACC_DBCRT" ng-bind="VGL_PACC_DBCRT=repDet.VGL_PACC_DBCRT_new" />
						<input class="hidden" ng-model="VGL_PACC_GLIDN" ng-bind="VGL_PACC_GLIDN=repDet.VGL_PACC_GLIDN_new" />

						<input class="hidden" ng-model="repDet.VGL_PACC_DESCR_new" ng-init="repDet.VGL_PACC_DESCR_new=repDet.VGL_PACC_DESCR" />
						<input class="hidden" ng-model="repDet.VGL_PACC_DBCRT_new" ng-init="repDet.VGL_PACC_DBCRT_new=repDet.VGL_PACC_DBCRT" />
						<input class="hidden" ng-model="repDet.VGL_PACC_GLIDN_new" ng-init="repDet.VGL_PACC_GLIDN_new=repDet.VGL_PACC_GLIDN" />
						<input class="hidden" ng-model="repDet.VGL_CHART_GLIDN_new" ng-init="repDet.VGL_CHART_GLIDN_new=repDet.VGL_CHART_GLIDN" />
						<input class="hidden" ng-model="repDet.VGL_CHART_GLDES_new" ng-init="repDet.VGL_CHART_GLDES_new=repDet.VGL_CHART_GLDES" />
						</form>
						
						<input class="hidden" ng-model="repDet.idVGL_PACC" />
						
						<span  ng-click="ABsearchvtx_schh[0].idSelect = repDet.idVTX_SCHE" 
						class="ab-pointer text-primary">	
						&nbsp;						
							<span class="glyphicon glyphicon-pencil"></span>
						&nbsp;	
						</span>
							<span ng-repeat="org in ABorgDimensions" >
								<span class="text-muted ab-border ab-spaceless small"  
								ng-if="repDet.VTX_SCHE_AB_DILEVEL.indexOf(',' + org.levelId )!=-1">
									<span class="" >
										&nbsp;{{org.levelDescr}}
									</span>	
									&nbsp;
								</span>
							</span>
						</div>
						<div class="col-lg-3" style="vertical-align:top;" >
							<div class="{{repDet.VGL_PACC_DESCR_new!=repDet.VGL_PACC_DESCR?'text-danger':''}}" >
								{{ repDet.VTX_SCHE_SEQDE}} 
							</div>
														
						</div>

						<div class="col-lg-1" >
							<span class="{{repDet.VTX_SCHE_TPREV==0?'':'hidden'}}" ab-label="STD_NO"></span>
							<span class="{{repDet.VTX_SCHE_TPREV==1?'':'hidden'}}" ab-label="STD_YES"></span>
						</div>
						<div class="col-lg-2 text-right"  >
								{{ repDet.VTX_SCHE_TAXPE}}%
						</div>



						<div class="col-lg-1 text-center" >
							<div class="{{repDet.VGL_CHART_GLIDN_new!=repDet.VGL_CHART_GLIDN?'text-danger':''}}" ng-click="repDet.selected=1-repDet.selected">
								{{ repDet.VGL_CHART_GLIDN_new}}
							</div>
						</div>
						<div class="col-lg-2" " >
							<div  class="{{repDet.VGL_CHART_GLDES_new!=repDet.VGL_CHART_GLDES?'text-danger':''}}" >
							{{ repDet.VGL_CHART_GLDES_new}} 
							</div>
						</div>
						<div class="ab-well {{ABsearchvtx_schh[0].idSelect==repDet.idVTX_SCHE?'':'hidden'}} col-lg-12">
						<div class="row">
							<div class="col-lg-1" style="vertical-align:top;" >
								<div class="btn btn-sm btn-primary ab-spaceless" 
								ng-click="ABsearchvtx_schh[0].idSelect=0">
								&nbsp;X&nbsp;
								</div>
							
							</div>
							<div class="col-lg-3" style="vertical-align:top;" >
								<div neg-if="repDet.selected>0" >
									<input ng-model="repDet.VGL_PACC_DESCR_new" size=20 />
								</div>
								<div ng-if="ABsearchvtx_schh[0].idSelect==repDet.idVTX_SCHE" >
									<?php echo $chartCode; ?>
								</div>
															
							</div>
	
							<div class="col-lg-1" style="" >
								<div class=" {{repDet.selected>0?'':'heidden'}}" >
									<span class="btn btn-default ab-spaceless {{repDet.VGL_PACC_DBCRT_new>0?'':'hidden'}}" 
									ng-click="repDet.VGL_PACC_DBCRT_new=(-1)"
									ab-label="STD_DEBIT">D</span>
									
									<span class="btn btn-default ab-spaceless {{repDet.VGL_PACC_DBCRT_new<0?'':'hidden'}}" 
									ng-click="repDet.VGL_PACC_DBCRT_new=1"
									ab-label="STD_CREDIT">C</span>
								</div>						
							</div>
	
							<div class="col-lg-1" style="" >
								<div class=" {{repDet.selected>0?'':'hiedden'}}" >
									
									{{ repDet.VGL_CHART_GLIDN_new}} 
								</div>
	
									
	
							</div>
							<div class="col-lg-4" style="" >
								<div class="{{repDet.selected>0?'':'hideden'}}" >
									{{ repDet.VGL_CHART_GLDES_new}} 
									
								</div>
							</div>	

							<div class="col-lg-2" style="" >

								<div class="btn btn-success" ng-click="ABupd('UPDATE');"
									ng-if="repDet.VGL_PACC_DESCR_new+repDet.VGL_PACC_DBCRT_new+repDet.VGL_CHART_GLDES_new!=repDet.VGL_PACC_DESCR+repDet.VGL_PACC_DBCRT+repDet.VGL_CHART_GLDES"
								>
									Update
								</div>
							</div>

												
						</div>
						</div> 
					</div>
				
				</div>
				
				<div class="col-lg-1" style="" >

					<span ng-if="$last==true"><span ng-init="ABgetLabels();"></span></span>
				</div>
			</div>
		
	</div>
</div>



<!-- 	vgl_pacc -->

<div ab-params="vgl_pacc" class="hidden"></div>

<div ng-if="ABorgDimensions"  class="{{ABsearchTbl=='ABsearchvgl_pacc'?'':'hidden'}}" >
<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "STD_MENU";
$sparm["searchTable"] = "vgl_pacc";
 
$sparm["searchJoin"] = "vgl_chart";
$sparm["searchResult"] = "ABsearchvgl_pacc";
$sparm["searchFilter"] = "hidd2en";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VGL_PACC_SOURCE,VGL_CHART_GLIDN";
$hardCode = $xtmp->setSearchMaster($sparm);
// echo $hardCode;


$chartDsp =<<<EOC

<div class="ab-wrapper-divsm" >
<table style="width:100%;" >
<tr class="ab-hover {{ glDta.idVGL_CHART==repDet.VGL_PACC_GLIDN?'ab-strong text-primary ab-underline':'' }}" ng-click="repDet.VGL_PACC_GLIDN_new=glDta.idVGL_CHART;repDet.VGL_CHART_GLIDN_new=glDta.VGL_CHART_GLIDN;repDet.VGL_CHART_GLDES_new=glDta.VGL_CHART_GLDES;"  ng-repeat="glDta in ABsearchvgl_chart | AB_Sorted:'VGL_CHART_GLIDN' " >
<td class="" >{{glDta.VGL_CHART_GLIDN}}</td>
<td>{{glDta.VGL_CHART_GLDES}}</td>
<td class="{{ glDta.idVGL_CHART==repDet.VGL_PACC_GLIDN?'small text-right':'hidden' }}" >
<span class="ab-border" ab-label="STD_ORIGINAL" > Org.</span> </td>
</tr>
</table>
</div>

EOC;

$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "hidden";
$sparm["searchTable"] = "vgl_chart";
 
$sparm["searchJoin"] = "";
$sparm["searchResult"] = "ABsearchvgl_chart";
$sparm["searchFilter"] = "hidden";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VGL_CHART_GLIDN";
$sparm["dspViewer"] = $chartDsp;
$chartCode = $xtmp->setSearchMaster($sparm);




$chartDsp =<<<EOC

<div class="ab-wrapper-divsm" >
<table style="width:100%;" >
<tr class="ab-hover {{ glDta.idVGL_CHART==repDet.VGL_PACC_GLIDN?'ab-strong text-primary ab-underline':'' }}" ng-click="repDet.VGL_PACC_GLIDN_new=glDta.idVGL_CHART;repDet.VGL_CHART_GLIDN_new=glDta.VGL_CHART_GLIDN;repDet.VGL_CHART_GLDES_new=glDta.VGL_CHART_GLDES;"  ng-repeat="glDta in ABsearchvgl_chart | AB_Sorted:'VGL_CHART_GLIDN' " >
<td class="" >{{glDta.VGL_CHART_GLIDN}}</td>
<td>{{glDta.VGL_CHART_GLDES}}</td>
<td class="{{ glDta.idVGL_CHART==repDet.VGL_PACC_GLIDN?'small text-right':'hidden' }}" >
<span class="ab-border" ab-label="STD_ORIGINAL" > Org.</span> </td>
</tr>
</table>
</div>

EOC;

$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "hidden";
$sparm["searchTable"] = "vgl_chart";
 
$sparm["searchJoin"] = "";
$sparm["searchResult"] = "ABsearchvgl_chart";
$sparm["searchFilter"] = "hidden";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "VGL_CHART_GLIDN";
$sparm["dspViewer"] = $chartDsp;
$chartCode = $xtmp->setSearchMaster($sparm);


?>


<table ng-init="" >
<tr>
<td class="hidden" >
<?php echo $hardCode; ?>
</td>
<td ng-if="ABorgDimensions&&ABsearchTbl=='ABsearchvgl_pacc'" ng-init="ABsearchAlias('vgl_pacc','vgl_chart',ABsPatternABsearchvgl_pacc,'ABsearchvgl_pacc','','','','')">
	<span id="ab-org-master-mess"></span>
	
</td>
</tr>
</table>

	
	<div class="ab-wrapper-div">
		<div class="row text-primary ab-strong" style="width:100%;" >
				
				<div class="col-lg-1" ><span ab-label="VGL_BRCH_GLBID">Branch</span></div>
				<div class="col-lg-2" ><span ab-label="STD_SOURCE">STD_SOURCE</span></div>
				<div class="col-lg-7" style="vertical-align:top;" >

					<div class="row">
						<div class="col-lg-3" ><span ab-label="STD_ID_CODE">Code</span></div>
						<div class="col-lg-2" ><span ab-label="STD_REFERENCE">Ref.</span></div>
						<div class="col-lg-2" ><span ab-label="STD_POST">Post Column</span></div>
						<div class="col-lg-4" ><span ab-label="VGL_CHART_GLIDN">Chart Id</span></div>
					</div>
				</div>
				
				
		</div>
	</div>
	<div class="ab-wrapper-div">
		
			<div class="row  ab-border ab-spaceless" ng-repeat="rep in ABsearchvgl_pacc | AB_noDoubles:'VGL_PACC_SOURCE,VGL_PACC_AB_DILEVEL'  | AB_Sorted:'VGL_PACC_SOURCE,VGL_PACC_AB_DILEVEL' " >
				<div class="col-lg-1" style="vertical-align:top;" >
		
					<span ng-repeat="org in ABorgDimensions" >
						<span class="text-muted ab-border ab-spaceless small"  
						ng-if="rep.VGL_PACC_AB_DILEVEL.indexOf(',' + org.levelId )!=-1">
							<span class="ab-pointer" >
								&nbsp;{{org.levelDescr}}
							</span>	
							&nbsp;
						</span>
					</span>
				</div>
				<div class="col-lg-2" >
					<span title="{{ rep.VGL_PACC_SOURCE}}" ab-label="VGL_SOURCE_{{rep.VGL_PACC_SOURCE}}"
						{{ rep.VGL_PACC_SOURCE}} 
					</span>
				</div>
				<div class="col-lg-7" style="vertical-align:top;" >
				
				
					<div class="row  ab-underline ab-spaceless"  ng-repeat="repDet in ABsearchvgl_pacc | AB_noDoubles:'idVGL_PACC'  | AB_Sorted:'VGL_PACC_SCHCO' " 
					ng-if="rep.VGL_PACC_SOURCE==repDet.VGL_PACC_SOURCE && rep.VGL_PACC_AB_DILEVEL==repDet.VGL_PACC_AB_DILEVEL"
					>
					
						<div class="col-lg-3" style="vertical-align:top;" >

						<div ng-if="ABsearchvgl_pacc[0].idSelect!=repDet.idVGL_PACC" >

						<input class="hidden" ng-model="repDet.VGL_PACC_DESCR_new" ng-init="repDet.VGL_PACC_DESCR_new=repDet.VGL_PACC_DESCR" />
						<input class="hidden" ng-model="repDet.VGL_PACC_DBCRT_new" ng-init="repDet.VGL_PACC_DBCRT_new=repDet.VGL_PACC_DBCRT" />
						<input class="hidden" ng-model="repDet.VGL_PACC_GLIDN_new" ng-init="repDet.VGL_PACC_GLIDN_new=repDet.VGL_PACC_GLIDN" />
						<input class="hidden" ng-model="repDet.VGL_CHART_GLIDN_new" ng-init="repDet.VGL_CHART_GLIDN_new=repDet.VGL_CHART_GLIDN" />
						<input class="hidden" ng-model="repDet.VGL_CHART_GLDES_new" ng-init="repDet.VGL_CHART_GLDES_new=repDet.VGL_CHART_GLDES" />
						
						</div>


						<form id="mainForm" ab-main="vgl_pacc" ng-if="ABsearchvgl_pacc[0].idSelect==repDet.idVGL_PACC" >
						
						
<textarea class="hidden" ab-updSuccess="" >
$scope.ABsearchAlias('vgl_pacc','vgl_chart',$scope.ABsPatternABsearchvgl_pacc,'ABsearchvgl_pacc','','$scope.ABsearchvgl_pacc[0].idSelect='+$scope.ABsearchvgl_pacc[0].idSelect+';','','')
</textarea>	
						
						<input class="hidden" ng-model="idVGL_PACC" ng-bind="idVGL_PACC=repDet.idVGL_PACC" />
						<input class="hidden" ng-model="VGL_PACC_DESCR" ng-bind="VGL_PACC_DESCR=repDet.VGL_PACC_DESCR_new" />
						<input class="hidden" ng-model="VGL_PACC_DBCRT" ng-bind="VGL_PACC_DBCRT=repDet.VGL_PACC_DBCRT_new" />
						<input class="hidden" ng-model="VGL_PACC_GLIDN" ng-bind="VGL_PACC_GLIDN=repDet.VGL_PACC_GLIDN_new" />

						<input class="hidden" ng-model="repDet.VGL_PACC_DESCR_new" ng-init="repDet.VGL_PACC_DESCR_new=repDet.VGL_PACC_DESCR" />
						<input class="hidden" ng-model="repDet.VGL_PACC_DBCRT_new" ng-init="repDet.VGL_PACC_DBCRT_new=repDet.VGL_PACC_DBCRT" />
						<input class="hidden" ng-model="repDet.VGL_PACC_GLIDN_new" ng-init="repDet.VGL_PACC_GLIDN_new=repDet.VGL_PACC_GLIDN" />
						<input class="hidden" ng-model="repDet.VGL_CHART_GLIDN_new" ng-init="repDet.VGL_CHART_GLIDN_new=repDet.VGL_CHART_GLIDN" />
						<input class="hidden" ng-model="repDet.VGL_CHART_GLDES_new" ng-init="repDet.VGL_CHART_GLDES_new=repDet.VGL_CHART_GLDES" />
						</form>
						
						<input class="hidden" ng-model="repDet.idVGL_PACC" />
						
						<span  ng-click="ABsearchvgl_pacc[0].idSelect = repDet.idVGL_PACC" 
						class="ab-pointer text-primary">	
						&nbsp;						
							<span class="glyphicon glyphicon-pencil"></span>
						&nbsp;	
						</span>
							{{ repDet.VGL_PACC_SCHCO }}
						</div>
						<div class="col-lg-3" style="vertical-align:top;" >
							<div class="{{repDet.VGL_PACC_DESCR_new!=repDet.VGL_PACC_DESCR?'text-danger':''}}" >
								{{ repDet.VGL_PACC_DESCR}} 
							</div>
														
						</div>

						<div class="col-lg-1" style="" >
							<div class="{{repDet.VGL_PACC_DBCRT_new!=repDet.VGL_PACC_DBCRT?'text-danger':''}}" >
								<span class="{{repDet.VGL_PACC_DBCRT_new>0?'':'hidden'}}" ab-label="STD_DEBIT">D</span>
								<span class="{{repDet.VGL_PACC_DBCRT_new<0?'':'hidden'}}" ab-label="STD_CREDIT">C</span>
							</div>
						</div>

						<div class="col-lg-1" style="" >
							<div class="{{repDet.VGL_CHART_GLIDN_new!=repDet.VGL_CHART_GLIDN?'text-danger':''}}" ng-click="repDet.selected=1-repDet.selected">
								{{ repDet.VGL_CHART_GLIDN_new}}
							</div>
						</div>
						<div class="col-lg-4" style="" >
							<div  class="{{repDet.VGL_CHART_GLDES_new!=repDet.VGL_CHART_GLDES?'text-danger':''}}" >
							{{ repDet.VGL_CHART_GLDES_new}} 
							</div>
						</div>
						<div class="ab-well {{ABsearchvgl_pacc[0].idSelect==repDet.idVGL_PACC?'':'hidden'}} col-lg-12">
						<div class="row">
							<div class="col-lg-1" style="vertical-align:top;" >
								<div class="btn btn-sm btn-primary ab-spaceless" 
								ng-click="ABsearchvgl_pacc[0].idSelect=0">
								&nbsp;X&nbsp;
								</div>
							
							</div>
							<div class="col-lg-3" style="vertical-align:top;" >
								<div neg-if="repDet.selected>0" >
									<input ng-model="repDet.VGL_PACC_DESCR_new" size=20 />
								</div>
								<div ng-if="ABsearchvgl_pacc[0].idSelect==repDet.idVGL_PACC" >
									<?php echo $chartCode; ?>
								</div>
															
							</div>
	
							<div class="col-lg-1" style="" >
								<div class=" {{repDet.selected>0?'':'heidden'}}" >
									<span class="btn btn-default ab-spaceless {{repDet.VGL_PACC_DBCRT_new>0?'':'hidden'}}" 
									ng-click="repDet.VGL_PACC_DBCRT_new=(-1)"
									ab-label="STD_DEBIT">D</span>
									
									<span class="btn btn-default ab-spaceless {{repDet.VGL_PACC_DBCRT_new<0?'':'hidden'}}" 
									ng-click="repDet.VGL_PACC_DBCRT_new=1"
									ab-label="STD_CREDIT">C</span>
								</div>						
							</div>
	
							<div class="col-lg-1" style="" >
								<div class=" {{repDet.selected>0?'':'hiedden'}}" >
									
									{{ repDet.VGL_CHART_GLIDN_new}} 
								</div>
	
									
	
							</div>
							<div class="col-lg-4" style="" >
								<div class="{{repDet.selected>0?'':'hideden'}}" >
									{{ repDet.VGL_CHART_GLDES_new}} 
									
								</div>
							</div>	

							<div class="col-lg-2" style="" >

								<div class="btn btn-success" ng-click="ABupd('UPDATE');"
									ng-if="repDet.VGL_PACC_DESCR_new+repDet.VGL_PACC_DBCRT_new+repDet.VGL_CHART_GLDES_new!=repDet.VGL_PACC_DESCR+repDet.VGL_PACC_DBCRT+repDet.VGL_CHART_GLDES"
								>
									Update
								</div>
							</div>

												
						</div>
						</div> 
					</div>
				
				</div>
				
				<div class="col-lg-1" style="" >

					<span ng-if="$last==true"><span ng-init="ABgetLabels();"></span></span>
				</div>
			</div>
		
	</div>
</div>

<div class="row">
<?php // testing abstract name require_once "../appHtml/stdSearchDspVIN_ITEM_LIST.php"; ?>
</div>


<div class="row">
<?php require_once "../appHtml/stdSearchDspVGB_CPARM.php"; ?>
</div>

<div class="row">
<?php require_once "../appHtml/stdSearchDspVGL_BANK.php"; ?>
</div>

<div>
<span class="ab-pointer" onclick="$('#ABtestTrig').toggleClass('hidden');">.</span>
<div id="ABtestTrig" class="hidden text-primary small ab-strong "  >
{{dspTrig}}
</div>
<div id="ABdspTrig" class="hidden text-primary small ab-strong "  >
</div>
</div>	

