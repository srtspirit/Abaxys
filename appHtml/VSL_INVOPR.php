<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VSL_ORDERS.php"; 
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
		SESSION_DESCR='Sales Invoice Printing';
		
	" >

	<span ab-label="VSL_INVOCT"></span>

	
<textarea class="hidden" ab-updSuccess="" >

	$scope.getVSL_DELIVERED();
	$scope.deliveryID = "";
	

</textarea>	
</div>

		<div class="row ">
			<div class="col-lg-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
		</div>


<script>
// Remove button
$("#ab-buttonPad").html("")
</script>

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
		$trn[count($trn)] = '	ng-repeat="varRow in  rawResult.vsl_pick | AB_noDoubles:'. "'". $name. "'" .' | AB_Sorted:'."'".$name."'".'  " >';
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
		<div class="col-lg-6">
			<table style="width:100%" >
				<tr class="text-primary ab-strong " >
					<td colspan=2>
						<input class="hidden" ng-model="doc_printed" ng-init="doc_printed=0" />
						<span class="text-primary ab-pointer ab-border ab-spaceless" ng-click="doc_printed=1-doc_printed;getVSL_DELIVERED();" >
						<input type="checkbox" checked ng-if="doc_printed==1" />
						<input type="checkbox" ng-if="doc_printed==0" />
						<span class="ab-strong" >&nbsp;Display printed Invoices&nbsp;</span>
						</span>					
					</td>
					<td class='{{doc_printed==1?"":"invisible"}}' >Date From</td>
					<td class='{{doc_printed==1?"":"invisible"}}' >Date To</td>
					<td class='{{doc_printed==1?"":"invisible"}}' >
						<table>
						<tr>
						<td>
							<span>
								
								<input class="hidden" id="VGB_CUSTsearch" ng-click="initCustomer();" />
								<a class="ab-pointer" 
								ng-click="ABsearchTbl='vgb_cust';ABsessionLink('','#VGB_CUSTsearch','vgb_cust');"
								neg-click="ABsessionLink('#/VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_cust,SourceProcess:VSL_INVOPR','#VGB_CUSTsearch');" >
									<span title="Access Partner List " ab-label="VGB_CUST_BPART" ></span>
									<span title="Access Partner List " class="glyphicon glyphicon-search" ></span>
								</a>
							</span>
							<input class="hidden" ng-model="VAP_OIHE_BSUPP" />
						</td>
						<td>&nbsp;</td>
						<td>
							<form>
							
							<span class="btn ab-spaceless">
								<input title="Find by Partner ID code" class="ab-borderless text-primary" placeholder=" Search by ID " 
								id="ORHE_HISTORY_CUST"
								ng-model="ORHE_HISTORY_CUST" size="9"   />
							</span>
							<button ab-model="findPartner" class="btn-link ab-border ab-spaceless  {{ORHE_HISTORY_CUST.length>0?'ab-pointer':'invisible'}}"
								ng-click="chkRangePartner('ORHE_HISTORY_CUST','vgb_bpar','VGB_BPAR_BPART');"
							>
							Find
							</button>
							</form>
						</td>
						</tr>
						</table>
					
					</td>
				</tr>
				<tr>
					<td class="text-primary text-left ab-strong" >
						<span class="ab-pointer ab-border ab-spaceless" ng-click="getVSL_DELIVERED();" >
							&nbsp;Refresh&nbsp;
						</span>&nbsp;
					</td>
					<td class="text-primary text-left ab-strong" >
						<span class="ab-pointer ab-border ab-spaceless {{rawResult.vsl_delivered.length>0?'':'invisible'}}" ng-click="selectAddAll();" >
							&nbsp;Select All&nbsp;
						</span>&nbsp;
						<span class="ab-pointer ab-border ab-spaceless {{deliveryID.trim()!=''?'':'invisible'}}" ng-click="selectClearAll();" >
							&nbsp;Clear All&nbsp;
						</span>&nbsp;

					</td>
					
					<?php 
					$hideDate = " class='{{" . 'doc_printed==1?"":"invisible"}}' . "' "; 
					$xtmp = new appForm("VSL_INVOPR");
					$hardCode = $xtmp->setDatePick("doc_date_from");
					echo "<td " . $hideDate . " >" . $hardCode . "</td>";
					$hardCode = $xtmp->setDatePick("doc_date_to");
					echo  "<td " . $hideDate . " >" .$hardCode . "</td>";
					?>
					
					<td class='{{doc_printed==1&&find_idVGB_CUST>0?"":"invisible"}}'>
					{{find_VGB_BPAR_BPART}} - {{find_VGB_CUST_BPNAM}}	
					<span ng-click="find_idVGB_CUST=0;getVSL_DELIVERED();" class="text-primary ab-pointer  ab-strong ab-border ab-spaceless" > Clear</span>
					</td>
					
				</tr>
			</table>
			
		</div>
		<div class="col-lg-4 {{deliveryID.trim()!=''?'':'invisible'}}" >
			
			<form id="mainForm" name="mainForm"  ab-context="1" ab-view="vsl_delivered" ab-main="vsl_delivered"   >
			<input  class="hidden" ab-btrigger="vsl_delivered" ng-model="idVSL_ORSI" /> 
			<input class="hidden" ng-model="vsl_delivered"  ng-init="vsl_delivered='vsl_invoice'" />
			<input class="hidden" ng-model="deliveryID" ng-init="deliveryID=''" />
			<table class="small">
				<tr>
					<td >
						
						<span class="btn btn-success ab-spaceless"  ng-if='doc_printed==0' 
						ng-click="processVSL_DELIVERED('processing');" >
						 	Process
						</span>			
 						<span class="btn btn-success ab-spaceless"  ng-if='doc_printed==1' 
						ng-click="processVSL_DELIVERED('re-printing');" >
							re-print
						</span>	
					</td>
				</tr>
			</table>	
			</form>
		</div>
	</div>


	<div class="row bg-primary ab-wrapper-div " ng-init="extraSort='';sortBy='VSL_ORST_PDATE';" >
	
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless" ><?php echo setHeadField("VSL_ORHE_USLNA","5","C.S.R.","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless" ><?php echo setHeadField("VGB_BPAR_BPART","10","Customer","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3   hidden-xs hidden-md  hidden-sm ab-spaceless" ><?php echo setHeadField("VGB_CUST_DESCR","5","Name","","","","bg-primary "); ?></div>
		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 ab-spaceless" ><?php echo setHeadField("VSL_ORHE_ORNUM","5","Order #","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3  hidden-xs hidden-md  hidden-sm ab-spaceless" ><?php echo setHeadField("VSL_ORHE_CUSPO","5","Cust. Ref.","","","","bg-primary "); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 hidden-xs hidden-md  hidden-sm  ab-spaceless" ><?php echo setHeadField("VSL_ORST_WINVO","5","Invoice Number","","","","bg-primary "); ?></div>

		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless hidden-xs hidden-md  hidden-sm " ><?php echo setHeadField("VSL_ORSI_CDATE","8","Created","","","","bg-primary "); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless hidden-xs hidden-md  hidden-sm " >
			<table style="width:100%;" >
			<tr>
			<td style="width:50%;"> 
				<?php echo setHeadField("VSL_ORSI_PROCE","5","Processed","","","","bg-primary"); ?>
			</td>
			<td style="width:50%;"> 				
				<?php echo setHeadField("VSL_ORSI_DOCPR","5","Printed","","","","bg-primary"); ?>
			</td>
			</tr>
			</table>
		</div>
		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 ab-spaceless hidden-xs hidden-md  hidden-sm " ><?php echo setHeadField("VSL_ORSI_PDATE","10","Trans. Totals","","","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-3 col-sm-3 col-xs-3 ab-spaceless " ><?php echo setHeadField("VSL_ORST_PDATE","10","Del. Date","1","-1","","bg-primary"); ?></div>

	</div>	
	<div class="row ab-wrapper-div " >
	<div class="row ab-odd ab-border ab-spaceless {{isSelected(varRow.VSL_ORST_WINVO)!=1?'':'ab-strong'}}" 
	ng-repeat="varRow in  rawResult.vsl_delivered | AB_noDoubles:'idVSL_ORHE,VSL_ORST_WINVO' | AB_Sorted:extraSort+sortBy " >	

			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  "  >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORHE_USLNA","5","C.S.R.","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<?php echo setRowDspField("varRow.VSL_ORHE_USLNA","5","C.S.R.","","","","  "); ?>
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
							<?php echo setHeadField("VGB_CUST_DESCR","10","Name","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<?php echo setRowDspField("varRow.VGB_CUST_BPNAM","12","Name","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>


			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12   " >

				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORHE_ORNUM","5","Order #","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
						
							<div class="text-primary ab-pointer"
								ng-click="initPickOrder(varRow.idVSL_ORHE,varRow.VSL_ORST_PICID);" > 
								<table>
								<tr>
								<td>
									<input class="hidden" ng-model="varRow.VSL_ORST_WINVO" />
									<span class="ab-border text-primary ab-spaceless" ng-click="setSelected(varRow.VSL_ORST_WINVO);">
										<span class="glyphicon glyphicon-ok {{isSelected(varRow.VSL_ORST_WINVO)!=1?'invisible':''}}">
										</span>
									</span>
									&nbsp;
								</td>
								<td>							
									<?php echo setRowDspField("varRow.VSL_ORHE_ORNUM","10","Order #www as","","","","ab-pointer"); ?>
								</td>
	
								</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12   " >
				<table style="width:100%;" >
					<tr >
						<td style="width:30%;"  class="text-left ab-spaceless visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORHE_CUSPO","5","Cust. Ref.","","","","  text-primary visible-xs visible-md  visible-sm "); ?> 						
						</td>
						<td>			
							<?php echo setRowDspField("varRow.VSL_ORHE_CUSPO","15","Cust. Ref.","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12   " >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;" class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORST_PICID","5","Pack Id","","","","text-primary visible-xs visible-md  visible-sm "); ?> 
						</td>
						
						<td style="width:5%;">
							<?php echo setRowDspField("varRow.VSL_ORSI_GRPID","5","Pick","","","","  "); ?>
						</td>
						<td></td>
					</tr>
				</table>
			</div>


			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORSI_CDATE","8","Created","","","","text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<?php echo setRowDspField("varRow.VSL_ORSI_CDATE","15","Created","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>


			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >

				<table style="width:100%;" >
				<tr>
				<td style="width:50%;"> 
					<span class="{{ varRow.VSL_ORSI_PROCE==1?'':'hidden' }}" >
						<?php echo setHeadField("VSL_ORSI_PROCE","5","Yes","","","",""); ?>						
					</span>
					<span class="{{ varRow.VSL_ORSI_PROCE==1?'hidden':'' }}" >
						<?php echo setHeadField("VSL_ORSI_PROCE","5","No","","","",""); ?>
					</span>
				</td>
				<td style="width:50%;"> 
					<span class="{{ varRow.VSL_ORSI_DOCPR==1?'':'hidden' }}" >
						<?php echo setHeadField("VSL_ORSI_DOCPR","5","Yes","","","",""); ?>						
					</span>
					<span class="{{ varRow.VSL_ORSI_DOCPR==1?'hidden':'' }}" >
						<?php echo setHeadField("VSL_ORSI_DOCPR","5","No","","","",""); ?>
					</span>

				</td>
				</tr>
				</table>
			</div>

		
		
			<div class="col-lg-2 " >


				<table style="width:100%;" >
					<tr ng-repeat="tot in vsl_totals | AB_noDoubles:'VSL_ORST_WINVO' " ng-if="varRow.VSL_ORST_WINVO==tot.VSL_ORST_WINVO" >
						<td class="small" >
							${{ABGetNumberFn("fmt-curr",tot.TOTSALES)}}
							
							{{tot.TAXES}}

						</td>
					</tr>
				</table>
			</div>
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >


				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORST_PDATE","10","Planned Date","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>			
							<?php echo setRowDspField("varRow.VSL_ORST_DDATE","15","Del Date","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

	</div>	
	</div>	

<div class="hidden">

				<span id="doccset" class="hidden" 
				onclick="
				deflectValText(localSetDocDta($('[tcpdform]').text()),'htmlText');
				deflectVal(1,'formSubmit');
				$('[fosub]').click();
				deflectVal(0,'formSubmit');
				" >
				Form
				</span>
				
<?php 		
require_once "../appHtml/VSL_ORDER_FORMS.php"; ?>
?>
</div>