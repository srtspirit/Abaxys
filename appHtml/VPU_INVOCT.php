<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VPU_ORDERS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;

$tFnc = new AB_querySession;
$isAdmin = $tFnc->isUserAdmin();
$currUsr = $tFnc->getUserData();

?>

<style>


.ACdropdown {
    display: none;
}

.ACdropdown-content {

    display: block;
    position: absolute;
    min-width:250px;
    background-color:white;
    color:black;
    
    box-shadow: 8px 8px 8px 8px rgba(0,0,0,0.2);

    z-index:1;
}




.ADdropdown {
    display: none;
}

.ADdropdown-content {

    display: block;
    position: absolute;
    min-width:350px;
    background-color:white;
    color:black;
    
    box-shadow: 8px 8px 8px 8px rgba(0,0,0,0.2);

    z-index:1;
}



</style>





<link rel="stylesheet" href="/comm22on/bootstrap/css/bootstrap-responsive.css">

<script>
	
	function closeFlt()
	{
		$("[id^='flt']").addClass("ACdropdown")
	}

</script>


</div>
<div class="hidden" 
	ng-init="
		SESSION_DESCR='Purchase RPO Posting';
		getVPU_DELIVERY();
	" >

	<span ab-label="VPU_INVOCT"></span>

	
<textarea class="hidden" ab-updSuccess="" >

	$scope.getVPU_DELIVERY();
	$scope.deliveryID = "";
	

</textarea>	
</div>

		<div class="row ">
			<div class="col-lg-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
		</div>

<?php


function setRowDspField($name,$size,$text,$filter,$sort,$label,$class)
{

//        ng-init= "varRow.on=(ACVarColSetIsOn('" . $name . "',varRow." . $name . ")!=true?'hidden':'')"
	$retVal = "<input ng-init=" . '"' . "varRow.on=(ACVarColSetIsOn('" . $name . "',varRow." . $name . ")!=true?'hidden':'')".'"'." readOnly class='ab-borderless ". $class . " ' ";
	$retVal .= "title='{{" . $name ."}}' ";
	$retVal .= "size=" . $size . " ";
	$retVal .= "ab-ilabel='" . $label . "'  ";
	$retVal .= " style='background-color:inherit;' ";
	$retVal .= "ng-model='" . $name . "'  ";
	
	$retVal .= "/>";
	
	
	
	// $retVal = "<table style='width:99%' title='{{" . $name ."}}'  ><tr><td style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;min-width:40px;max-width:80%;' >" . $retVal . "{{ " . $name . "}} </td></tr></table>";
	
	return $retVal ;

	
}

function setHeadField($name,$size,$text,$filter,$sort,$label,$class)
{
	$ngif="1<0";
	$ngelse="1<0";
	$ngclick="";
	$abpointer = "";


	$trn = array();
	$filterSwitch = '<span class="small glyphicon glyphicon-filter invisible "  ></span>';
	
	if ($filter!="")
	{
		$filterSwitch = '<span ng-click='. "'" . 'ACVarFilterToggle("' . $name . '")' . "'" . ' class="bg-primary ab-border ab-pointer ab-spaceless " >&nbsp;X&nbsp;</span>';
		
		$trn[count($trn)] = '<div id="flt' . $name . '" class=" ACdropdown "  >';
		$trn[count($trn)] = '<div class="ACdropdown-content" >';
		$trn[count($trn)] = '<table style="width:95%;margin:10px;padding:3px;" class="table-striped  ab-spaceless bg-success " role="tablist" >';
		$trn[count($trn)] = ' 	<tr>';


		$trn[count($trn)] = ' 		<td  class="text-top ab-pointer " ';
		$trn[count($trn)] = ' 		ng-click="list' . $name . "='';ACVarFilterInit('" . $name . "','');" . '" >';
		$trn[count($trn)] = ' 		<div  class="ab-pointer" title="Clear all" >&nbsp;&#9744;&nbsp;</div></td>';
//		$trn[count($trn)] = ' 		<td></td>';
		$trn[count($trn)] = ' 		<td title="Select all" class="text-top ab-pointer" ';
		$trn[count($trn)] = ' 		ng-click="list' . $name . "='-1';ACVarFilterInit('" . $name . "','');" . '" >';

//		$trn[count($trn)] = ' 		ng-click="list' . $name . '=Orglist' . $name . ';ACVarFilterInit();" >';

		$trn[count($trn)] = ' 		<span class="ab-pointer " >&nbsp;&#9745;&nbsp;</span></td>';
		$trn[count($trn)] = ' 		<td>&nbsp;</td>';
		$trn[count($trn)] = ' 		<td colspan=3 class="text-center" >';
		$trn[count($trn)] = ' 			<input readonly class="ab-borderless" size=15 value="Filter selection" />';
		$trn[count($trn)] = ' 			<input ng-model="list' . $name . '" ng-init="list' . $name . "=''" . '" class="hidden" />';
		$trn[count($trn)] = ' 			<input ng-model="Orglist' . $name . '" ng-init="Orglist' . $name . "=''" . '" class="hidden" />';
		$trn[count($trn)] = ' 		</td>';
		
		$trn[count($trn)] = ' 		<td class="text-top" rowspan=2000 style="vertical-align:top;" >'. $filterSwitch . '</td>';
		$trn[count($trn)] = ' 	</tr>';
		$trn[count($trn)] = ' 	<tr><td class="ab-border ab-spaceless" colspan=100></td></tr>';
		$trn[count($trn)] = '<tr class=""'; 
		$trn[count($trn)] = '	ng-repeat="varRow in  rawResult.vpu_pick | AB_noDoubles:'. "'". $name. "'" .' | AB_Sorted:'."'".$name."'".'  " >';
		$trn[count($trn)] = ' 		<td  class="text-center ab-pointer ab-border ab-spaceless" ';
		$trn[count($trn)] = ' 		ng-init="list' . $name . '=list' . $name . " + ',' + varRow." . $name . "+ ','" . '" ';
		$trn[count($trn)] = ' 		>';
//		$trn[count($trn)] = ' 		</td>';
//		$trn[count($trn)] = '		<td class="text-left ab-pointer ab-border ab-spaceless"  >';
		
//		$trn[count($trn)] = '		{{ACVarColSetIsOn('. "'" . $name ."',varRow.".$name.')}}';

		$trn[count($trn)] = '			<span ng-click="ACVarColSelToggle('. "'" . $name ."',varRow.".$name.');" class="{{ACVarColSetIsOn('. "'" . $name ."',varRow.".$name.')==true?'."'':'hidden'}}".'" checked type="checkbox" >';
		$trn[count($trn)] = '			<span class="glyphicon glyphicon-ok"></span></span>';
		$trn[count($trn)] = '			<span ng-click="ACVarColSelToggle('. "'" . $name ."',varRow.".$name.');" class="{{ACVarColSetIsOn('. "'" . $name ."',varRow.".$name.')!=true?'."'':'hidden'}}".'" type="checkbox" >';
		$trn[count($trn)] = '			<span class="glyphicon glyphicon-ok invisible"></span></span>';
		$trn[count($trn)] = '	        </td>';
		$trn[count($trn)] = ' 		<td>&nbsp;</td>';
		$trn[count($trn)] = ' 		<td>&nbsp;</td>';
		$trn[count($trn)] = '	        <td class="text-left">';
		$trn[count($trn)] = '	        	<span  >';
		$trn[count($trn)] = '	        	<input class="hidden" ng-model="varRow.' . $name . '"  ng-init="ACVarColSelToggle('. "'" . $name ."',varRow.".$name.');" />';
		$trn[count($trn)] = '	        		{{varRow.'. $name. '}}';
		$trn[count($trn)] = '	        	</span>';
		$trn[count($trn)] = '	        </td>';
		$trn[count($trn)] = '	</tr>';
		$trn[count($trn)] = '</table>';
		$trn[count($trn)] = '<div class="text-center bg-primary ab-pointer ab-spaceless " ng-click="ACVarFilterHide();" >close</div>';
		$trn[count($trn)] = '</div>';
		
		$trn[count($trn)] = '</div>';
		
		$dspColor='{{list' . $name . ".length!=Orglist" . $name . ".length && Orglist" . $name . "!=''?'bg-warning text-primary':''}} "; 
		// $filterSwitch = '<span onclick='. "'" . '$("#flt' . $name . '").toggleClass("ACdropdown");'."'".' class="small glyphicon glyphicon-filter" ></span>';
		$filterSwitch = '<span ng-click='. "'" . 'ACVarFilterToggle("' . $name . '")' . "'" . ' class="ab-pointer small glyphicon glyphicon-filter ' . $dspColor . ' " ></span>';

	}
	
	$filterHtml = implode("",$trn);
	$inputStyle = "style='background-color:inherit;'";
	
	if ($sort != "")
	{
		$ngif='(","+extraSort+sortBy+",").indexOf(",' . $name . ',")>-1';
		$ngelse="(','+extraSort+sortBy+',').indexOf('," . $name . ",')==-1";

		$abpointer=" ab-pointer ";
		
		if ($sort > 0)
		{
			$ngclick = "ng-click='extraSort=". '"' . $name . ',";' . "'";
			// $class .= " {{" . $ngif . '?"bg-info text-primary":""}} ';
		}
		if ($sort < 0)
		{
			$ngclick = "ng-click='extraSort=". '"' . '";' . "' ";
		}
		
		$inputStyle= "style='background-color:inherit;margin-left:10px;border-bottom:double;border-width:3px;" . " {{" . $ngif . '?"color:gold;":""}}' ."'";
	}
	

	
	
		
	$retVal = "<table><tr><td style='width:20px;text-align:center;' >" . $filterSwitch . "</td><td >";
	$retVal .= "<input title='sort by' readOnly class='ab-borderless small ". $class . $abpointer . " ' ";
	$retVal .= "value='" . $text ."' ";
	$retVal .= "size=" . $size . " ";
	$retVal .= "ab-ilabel='" . $label . "'  ";
	$retVal .= "ab-model='" . $name . "'  " . $inputStyle;

	$retVal .= $ngclick;

	
	$retVal .= "/></td></tr><tr><td colspan=100>". $filterHtml ."</td></tr></table>";
	
	return $retVal ;
	
}

?>

	<div class="row ">
		<div class="col-lg-4">
		&nbsp;
		</div>
		<div class="col-lg-4 {{deliveryID.trim()!=''?'':'hidden'}}" >
			<form id="mainForm" name="mainForm"  ab-context="1" ab-view="vpu_orhe" ab-main="vpu_orhe"   >
			<input  class="hidden" ab-btrigger="vpu_invoice" ng-model="idVPU_ORHE" /> 
			<input class="hidden" ng-model="VPU_INVOICE"  ng-init="VPU_INVOICE='vpu_invoice'" />
			<input class="hidden" ng-model="deliveryID" ng-init="deliveryID=''" />
			</form>
			<div class="hidden" id="costingData" >
				<div ng-repeat="vRow in  rawResult.vpu_invoice | AB_noDoubles:'idVPU_ORST' " 
				ab-formlist="invo_list"
				ng-if="isSelected(vRow.VPU_ORST_DELID)>0 && vRow.VPU_ORDE_OLTYP == 'STD'  " >	
				<form   ab-view="vpu_orde" ab-main="vpu_orde" ab-context="0" >
					<input ng-model="vRow.idVPU_ORHE" class="hidden" />
					<input ng-model="vRow.idVPU_ORST" class="hidden" />
					<input ng-model="vRow.VPU_ORST_DELID" class="hidden" />
					<input ng-model="vRow.idVIN_ITEM" class="hidden" />
					<input ng-model="vRow.VPU_ORST_ORDQT" class="hidden" />
					<input ng-model="vRow.VPU_ORDE_FACTO" class="hidden" />
					<input ng-model="vRow.VPU_ORDE_OUNET" class="hidden" />
					<input ng-model="vRow.EXTENSION" class="hidden" />
					<input ng-model="vRow.percent" class="hidden" />
					
					<div ng-repeat="cItem in provCost" 
					ab-formlist="invo_list"
					ng-if="cItem.delId == vRow.VPU_ORST_DELID" >
	
						<input ng-model="cItem.delId" class="hidden" />
						<input ng-model="cItem.ignore" class="hidden" />
						<input ng-model="cItem.idVIN_ITEM" class="hidden" />
						<input ng-model="cItem.VIN_ITEM_DESC1" class="hidden" />
						<input ng-model="cItem.VPU_ORDE_FACTO" class="hidden" />
						<input ng-model="cItem.amount" class="hidden" />
						<input ng-model="cItem.orstId" class="hidden" />
						<input ng-model="cItem.oltyp" class="hidden" />
					</div>
					
				</form>
				
				</div>
			</div>
			
			<table class="small">
				<tr>
					<td>
						<span class="text-primary" ab-label="STD_POST_DATE" ></span> &nbsp;
					</td>
					<td>

<?php

	$xtmp = new appForm("VPU_ORDERS");
	$hardCode = $xtmp->setDatePick("POST_DATE");
	echo $hardCode;
	
?>

					</td>
					<td>
						 &nbsp;&nbsp;<span class="btn btn-success ab-spaceless"  ng-click="ABupd('UPDATE');" >&nbsp;Process&nbsp;</span>			
					</td>
				</tr>
			</table>	
			
		</div>
	</div>


	<div class="row bg-primary " ng-init="extraSort='';sortBy='VPU_ORST_PDATE';" >
	
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless" ><?php echo setHeadField("VPU_ORHE_USLNA","5","C.S.R.","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless" ><?php echo setHeadField("VGB_BPAR_BPART","10","Supplier","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3   hidden-xs hidden-md  hidden-sm ab-spaceless" ><?php echo setHeadField("VGB_CUST_DESCR","5","Name","","","","bg-primary "); ?></div>
		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 ab-spaceless" ><?php echo setHeadField("VPU_ORHE_ORNUM","5","Order #","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3  hidden-xs hidden-md  hidden-sm ab-spaceless" ><?php echo setHeadField("VPU_ORHE_CUSPO","5","Cust. Ref.","","","","bg-primary "); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 hidden-xs hidden-md  hidden-sm  ab-spaceless" ><?php echo setHeadField("VPU_ORST_PICID","5","Receipt Id.","","","","bg-primary "); ?></div>

		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless hidden-xs hidden-md  hidden-sm " ><?php echo setHeadField("VPU_ORSI_CDATE","8","Created","","","","bg-primary "); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless hidden-xs hidden-md  hidden-sm " >
			<table style="width:100%;" >
			<tr>
			<td style="width:50%;"> 
				<?php echo setHeadField("VPU_ORSI_PROCE","5","Processed","","","","bg-primary"); ?>
			</td>
			<td style="width:50%;"> 				
				<?php echo setHeadField("VPU_ORSI_REISS","5","Re-Issue","","","","bg-primary"); ?>
			</td>
			</tr>
			</table>
		</div>
		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 ab-spaceless hidden-xs hidden-md  hidden-sm " ><?php echo setHeadField("VPU_ORSI_PDATE","10","Trans. Totals","","","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless " ><?php echo setHeadField("VPU_ORST_PDATE","10","Del. Date","1","-1","","bg-primary"); ?></div>

	</div>	
	<div class="row ab-odd ab-border ab-spaceless {{isSelected(varRow.VPU_ORST_DELID)!=1?'':'ab-strong'}}" 
	ng-repeat="varRow in  rawResult.vpu_invoice | AB_noDoubles:'idVPU_ORHE,VPU_ORST_DELID' | AB_Sorted:extraSort+sortBy " >	

		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  "  >
			<table style="width:100%;" >
				<tr>
					<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
						<?php echo setHeadField("VPU_ORHE_USLNA","5","C.S.R.","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
						
					</td>
					
					<td>
						<?php echo setRowDspField("varRow.VPU_ORHE_USLNA","5","C.S.R.","","","","  "); ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12   " >
			<table style="width:100%;" >
				<tr>
					<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
						<?php echo setHeadField("VGB_BPAR_BPART","10","Customer","","",""," text-primary visible-xs visible-md  visible-sm "); ?>
						
					</td>
					
					<td>			
						<?php echo setRowDspField("varRow.VGB_BPAR_BPART","15","Customer","","","","  "); ?>
					</td>
				</tr>
			</table>
		</div>

		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12   " >
			<table style="width:100%;" >
				<tr>
					<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
						<?php echo setHeadField("VGB_SUPP_DESCR","10","Name","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
						
					</td>
					
					<td>
						<?php echo setRowDspField("varRow.VGB_SUPP_BPNAM","12","Name","","","","  "); ?>
					</td>
				</tr>
			</table>
		</div>


		<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12   " >

			<table style="width:100%;" >
				<tr>
					<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
						<?php echo setHeadField("VPU_ORHE_ORNUM","5","Order #","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
						
					</td>
					
					<td>
					
						<div class="text-primary ab-pointer"
							neg-click="initPickOrder(varRow.idVPU_ORHE,varRow.VPU_ORST_PICID);"
							ng-click="setSelected(varRow.VPU_ORST_DELID);"  > 
							<table>
							<tr>
							<td>
								<span class="ab-border text-primary ab-spaceless" >
									<span class="glyphicon glyphicon-ok {{isSelected(varRow.VPU_ORST_DELID)!=1?'invisible':''}}">
									</span>
								</span>
								&nbsp;
							</td>
							<td >	
								{{varRow.VPU_ORHE_ORNUM}}						
								<? // php echo setRowDspField("varRow.VPU_ORHE_ORNUM","10","Order #www as","","","","ab-pointer"); ?>
							</td>

							</tr>
							</table>
						</div>
					</td>
					<td>
						<span class="text-primary ab-pointer" provc="#provC{{varRow.VPU_ORST_DELID}}" onclick="$($(this).attr('provc')).toggleClass('hidden');">
							Prov. Costing
							<span class="caret" ></span>
						</span>
					</td>
					
				</tr>
			</table>
		</div>

		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12   " >
			<table style="width:100%;" >
				<tr >
					<td style="width:30%;"  class="text-left ab-spaceless visible-xs visible-md  visible-sm ">
						<?php echo setHeadField("VPU_ORHE_CUSPO","5","Cust. Ref.","","","","  text-primary visible-xs visible-md  visible-sm "); ?> 						
					</td>
					<td>			
						<?php echo setRowDspField("varRow.VPU_ORHE_CUSPO","15","Cust. Ref.","","","","  "); ?>
					</td>
				</tr>
			</table>
		</div>

		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12   " >
			<table style="width:100%;" >
				<tr>
					<td style="width:30%;" class="text-left visible-xs visible-md  visible-sm ">
						<?php echo setHeadField("VPU_ORST_PICID","5","Receipt Id","","","","text-primary visible-xs visible-md  visible-sm "); ?> 
					</td>
					
					<td style="width:5%;">
						<?php echo setRowDspField("varRow.VPU_ORSI_GRPID","5","Pick","","","","  "); ?>
						
					</td>
					<td></td>
				</tr>
			</table>
		</div>


		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >
			<table style="width:100%;" >
				<tr>
					<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
						<?php echo setHeadField("VPU_ORSI_CDATE","8","Created","","","","text-primary visible-xs visible-md  visible-sm "); ?> 
						
					</td>
					
					<td>
						<?php echo setRowDspField("varRow.VPU_ORSI_CDATE","15","Created","","","","  "); ?>
					</td>
				</tr>
			</table>
		</div>


		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >

			<table style="width:100%;" >
			<tr>
			<td style="width:50%;"> 
				<span class="{{ varRow.VPU_ORSI_PROCE==1?'':'hidden' }}" >
					<?php echo setHeadField("VPU_ORSI_PROCE","5","Yes","","","",""); ?>						
				</span>
				<span class="{{ varRow.VPU_ORSI_PROCE==1?'hidden':'' }}" >
					<?php echo setHeadField("VPU_ORSI_PROCE","5","No","","","",""); ?>
				</span>
			</td>
			<td style="width:50%;"> 
				<span class="{{ varRow.VPU_ORSI_REISS==1?'':'hidden' }}" >
					<?php echo setHeadField("VPU_ORSI_REISS","5","Yes","","","",""); ?>						
				</span>
				<span class="{{ varRow.VPU_ORSI_REISS==1?'hidden':'' }}" >
					<?php echo setHeadField("VPU_ORSI_REISS","5","No","","","",""); ?>
				</span>

			</td>
			</tr>
			</table>
		</div>

	
	
		<div class="col-lg-2 " >


			<table style="width:100%;" >
				<tr ng-repeat="tot in vpu_totals | AB_noDoubles:'VPU_ORST_DELID' " ng-if="varRow.VPU_ORST_DELID==tot.VPU_ORST_DELID" >
					<td class="small" >
						${{ABGetNumberFn("fmt-curr",tot.TOTPURCH )}}
						
						{{tot.TAXES}}

					</td>
				</tr>
			</table>
		</div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >


			<table style="width:100%;" >
				<tr>
					<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
						<?php echo setHeadField("VPU_ORST_PDATE","10","Planned Date","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
						
					</td>
					
					<td>			
						<?php echo setRowDspField("varRow.VPU_ORST_DDATE","15","Del Date","","","","  "); ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8  "  >
			<div class="row hidden  ab-body-curtain ab-border ab-strong" id="provC{{varRow.VPU_ORST_DELID}}" >
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 " >
					<table style="width:100%;">
					<tr>
						<td>
							<input class="hidden" id="VIN_ITEMsearch{{varRow.VPU_ORST_DELID}}" 
							ng-click="vpu_invoctInsertItem(varRow.VPU_ORST_DELID);" />
						
						</td>
					</tr>
					<tr class=" text-primary ab-strong" >
						<td style="width:20%;">
							
							<span class="text-primary small ab-pointer" 
							ng-click="ABsearchTbl='vin_item';ABsessionLink('','#VIN_ITEMsearch'+ varRow.VPU_ORST_DELID,'vin_item');" >
								<span ab-label="STD_COSTING" >Cost</span>
								<span ab-label="VIN_ITEMS_vin_item" >Item</span>&nbsp;&nbsp;
								<span class="glyphicon glyphicon-search"></span>
							</span>
						</td>
						<td style="width:30%;" > Description </td>
						<td style="width:15%;" class="text-right"> Amount</td>
						<td style="width:10%;" class="text-right"> Ignore</td>
						<td style="width:25%;" ></td>
						
					</tr>
					<tr ng-repeat="costItem in provCost" class="{{costItem.ignore==0?'':'text-muted'}}" ng-if="costItem.delId == varRow.VPU_ORST_DELID" >
						<td>{{costItem.VIN_ITEM_ITMID}}
						<input class="hidden" ng-model="costItem.idVIN_ITEM" size=5 />
						<input ng-model="costItem.VPU_ORDE_FACTO" class="hidden" />
						</td>
						<td>{{costItem.VIN_ITEM_DESC1}}</td>
						<td class="text-right"> 
							<input ng-if="costItem.orstId==0" class="text-right" ng-blur="costItem.amount = ABGetNumberFn('fmt-curr',costItem.amount)" ng-model="costItem.amount" size=5 /> 
							<span ng-if="costItem.orstId!=0" >
								${{ABGetNumberFn('fmt-curr',costItem.amount)}}
							</span>
						</td>
						<td class="text-right">
							<input ng-model="costItem.ignore" class="hidden" />
							<span ng-click="costItem.ignore=1"
							class="btn btn-sm btn-default ab-spaceless {{costItem.ignore==0?'':'hidden'}} " > 
								&nbsp;<span ab-label="STD_NO" >No</span>&nbsp;
							</span>
							<span ng-click="costItem.ignore=0" 
							class="btn btn-sm btn-default ab-spaceless {{costItem.ignore==1?'':'hidden'}} " >
								&nbsp;<span ab-label="STD_YES" >Yes</span>&nbsp;
							</span>
						</td>
						<td class="text-center">
<table style="width:100%;" >
<tr>
<td style="width:30%;" class="ab-strong">
		<ul class="nav  ab-spaceless " role="tablist"  ng-if="costItem.orstId==0"  >
			<li class="dropdown ab-spaceless"  >
				<span data-toggle="dropdown" class="text-primary btn-link" style="white-space:nowrap;padding:0px;" >
					<span ng-if="costItem.oltyp=='EXP'" class="small ab-pointer ab-borderless" >Invoiced </span>
					<span ng-if="costItem.oltyp=='BOR'" class="small ab-pointer ab-borderless" >Borned by {{ AB_CPARM.VGB_COMPANY.vgb_cust[0].VGB_CUST_BPNAM }}</span>
					<span ng-if="costItem.orstId==0" class="caret" ></span>
				</span>
				<ul class="dropdown-menu ab-spaceless"  role="menu" ng-if="costItem.orstId==0" >
					<li class="{{costItem.oltyp!='EXP'?'h2idden':''}}"  >
					<a class="small"  ng-click="costItem.oltyp='EXP';" >
					<span >Invoiced</span>
					</a>
					</li>
					<li class="{{costItem.oltyp!='BOR'?'hi2dden':''}}"  >
					<a class="small"  ng-click="costItem.oltyp='BOR';" >
					<span >Borned by {{ AB_CPARM.VGB_COMPANY.vgb_cust[0].VGB_CUST_BPNAM }}</span>
					</a>
					</li>

				</ul>
			</li>
		</ul>
		<div ng-if="costItem.orstId>0"
		<span class="{{costItem.oltyp!='EXP'?'hidden':''}}"  >
			<span >Invoiced</span>
		</span>
		<span class="{{costItem.oltyp!='BOR'?'hidden':''}}"  >
			<span >Borned by {{ AB_CPARM.VGB_COMPANY.vgb_cust[0].VGB_CUST_BPNAM }}</span>
		</span>

</td>	
</tr>
</table>
						
						
						</td>
					</tr>
					</table>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ab-border" >
					<table style="width:100%" class="" >
					<tr class="text-primary ab-strong ab-border" >
						<td> Item </td>
						<td> Description </td>
						<td class="text-right" > Qty </td>
						<td class="text-right" > Price </td>
						<td class="text-right" > Extention </td>
						<td class="text-right" > Distr.%</td>
					</tr>
					<tr ng-repeat="detRow in  rawResult.vpu_invoice | AB_noDoubles:'idVPU_ORHE,idVPU_ORDE,idVPU_ORST' " 
						ng-if="detRow.VPU_ORST_DELID==varRow.VPU_ORST_DELID && detRow.VPU_ORDE_OLTYP == 'STD' " >	
						<td>{{detRow.VIN_ITEM_ITMID}}</td>
						<td>{{detRow.VIN_ITEM_DESC1}}</td>
						<td class="text-right" >{{detRow.VPU_ORST_ORDQT}}</td>
						<td class="text-right" >{{detRow.VPU_ORDE_OUNET}}</td>
						<td class="text-right" >{{detRow.EXTENSION}}</td>
						<td class="text-right" ><input class="text-right "  ng-model="detRow.percent" size=2 />&nbsp;</td>
					</tr>
					</table>	
				</div>
				
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  "  ></div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  "  style="font-size:2pt;">
		&nbsp;
		</div>

	</div>		

		

