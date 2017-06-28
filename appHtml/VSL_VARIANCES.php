<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VSL_ORDERS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;



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


</style>


<script>
	
	function closeFlt()
	{
		$("[id^='flt']").addClass("ACdropdown")
	}

</script>


</div>
<div class="hidden" ng-init="SESSION_DESCR='Sales delivery variance ';idVSL_ORHE=0;ABlstAlias('idVSL_ORHE','idVSL_ORHE','vsl_userVariance','vsl_varie');" >
	<span ab-label="VSL_VARIANCES"></span>
</div>

<div style="margin-left:5px;"   >
	<div id="mainForm" ab-main="vsl_orhe" style="margin:0px;"  >
		<div class="row ">
			<div class="col-lg-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
			<div class="col-lg-12">
				<table>
					<tr>
					  	<td class="hidden">
					  		<div title="" ng-init="collaps=0">
					  			<span  onclick="$('#bcollaps').click();collapseall(0);" class="btn-link " title="">
					  				<span class="glyphicon glyphicon-zoom-out " title=""></span>
					  			</span>
								<span onclick="$('#bcollapsIn').click();collapseall(1);" class="btn-lg btn-link " title="">
									<span class="glyphicon glyphicon-zoom-in " title="">
									</span>
								</span>
								<input class="hidden" id="bcollaps" ng-model="collaps" ng-click="collaps = 0;" size=2 />
								<input class="hidden" id="bcollapsIn" ng-model="collaps" ng-click="collaps = 1;" size=2 />
							</div>
						</td>
						<td id="ab-new" >
							<label  title="CREATE" class="">
	 				 			 <a  class="bg=danger" 
							href="#VSL_ORDERS/VSL_ORHECT/Process:VSL_ORDERS,Session:VSL_ORHECT,tblName:vsl_orhe,updType:CREATE,idVSL_ORHE:0,tbData:{{tbData}}" 
							>
								<span ab-label="VSL_ORHE">Order</span>
								<span ab-label="STD_NEW">New</span>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>			
							</label>
						</td>
					<td class="hidden">	  
<?php
	$xtmp = new appForm("VSL_ORDERS");
	$hardCode = <<<BOD
			<div>
				<span ab-empty="{{tbData=='vsl_orhe'?'vsl_orhe':'Yes'}}"
				class="" >
				<input a_iref="02-60"
							size=15
							lval=""
							ng-change="FLT_ORHE_ORNUM=VSL_ORHE_ORNUM;VSL_ORHE_ORNUM=' ';ABlstAlias('VSL_ORHE_ORNUM','VSL_ORHE_ORNUM,FLT_ORHE_ORNUM','vsl_orhe',0);VSL_ORHE_ORNUM=FLT_ORHE_ORNUM;"
							ng-model="VSL_ORHE_ORNUM" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>

				</span>
			</div>
			<input class="hidden"  id="FLT_ORHE" ab-filter="vsl_orhe" ab-filter-cond="CONTAINS" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  

				ab-filter-model="VSL_ORHE_ORNUM,VSL_ORHE_CUSPO,VSL_ORHE_USLNA,VGB_CUST_BPNAM,VGB_ADDR_DESCR,VGB_SLRP_SLSRP,VIN_ITEM_ITMID,VIN_ITEM_DESC1,VSL_ORDE_ODATE,VSL_ORDE_DDATE"

				ng-model="FLT_ORHE_ORNUM" />
BOD;
$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="STD_SEARCH";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;

$xtmp->setFieldWrapper("view01","0.0","vsl_orhe","VSL_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>
					</td>

					<td>&nbsp;
						<a href="#/VSL_ORDERS/VSL_ORDERS/Process:VSL_ORDERS,Session:VSL_ORDERS,tblName:vsl_orhe" >
						<span ab-label="VSL_ORDERS_vsl_orhe" >Sls</span>
						</a>
					</td>
					
				</tr>
			</table>
			</div>
		</div>
		
	<script>
		$('#ab-buttonPad').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
	</script>
<?php





function setRowDspField($name,$size,$text,$filter,$sort,$label,$class)
{

//        ng-init= "varRow.on=(ACVarColSetIsOn('" . $name . "',varRow." . $name . ")!=true?'hidden':'')"
	$retVal = "<input ng-i2nit=" . '"' . "varRow.on=(ACVarColSetIsOn('" . $name . "',varRow." . $name . ")!=true?'hidden':'')".'"'." readOnly class='ab-borderless ". $class . " ' ";
	$retVal .= "title='{{" . $name ."}}' ";
	$retVal .= "size=" . $size . " ";
	$retVal .= "ab-ilabel='" . $label . "'  ";
	$retVal .= "ng-model='" . $name . "'  ";
	$retVal .= " style='background-color:inherit;' ";
		
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
	$filterSwitch = '<span class="small glyphicon glyphicon-filter ab-invisible "  ></span>';
	
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
		$trn[count($trn)] = '	ng-repeat="varRow in  rawResult.vsl_varie | AB_noDoubles:'. "'". $name. "'" .' | AB_Sorted:'."'".$name."'".'  " >';
		$trn[count($trn)] = ' 		<td class="text-center ab-pointer ab-border ab-spaceless" ';
		$trn[count($trn)] = ' 		ng-init="list' . $name . '=list' . $name . " + ',' + varRow." . $name . "+ ','" . '" ';
		$trn[count($trn)] = ' 		>';
//		$trn[count($trn)] = ' 		</td>';
//		$trn[count($trn)] = '		<td class="text-left ab-pointer ab-border ab-spaceless"  >';
		
//		$trn[count($trn)] = '		{{ACVarColSetIsOn('. "'" . $name ."',varRow.".$name.')}}';

		$trn[count($trn)] = '			<span ng-click="ACVarColSelToggle('. "'" . $name ."',varRow.".$name.');" class="{{ACVarColSetIsOn('. "'" . $name ."',varRow.".$name.')==true?'."'':'hidden'}}".'" checked type="checkbox" >';
		$trn[count($trn)] = '			<span class="glyphicon glyphicon-ok"></span></span>';
		$trn[count($trn)] = '			<span ng-click="ACVarColSelToggle('. "'" . $name ."',varRow.".$name.');" class="{{ACVarColSetIsOn('. "'" . $name ."',varRow.".$name.')!=true?'."'':'hidden'}}".'" type="checkbox" >';
		$trn[count($trn)] = '			<span class="glyphicon glyphicon-ok ab-invisible"></span></span>';
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
	$inputStyle = "style='background-color:inherit;' ";
	
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
		
		$inputStyle= "style='margin-left:10px;border-bottom:double;border-width:3px;" . " {{" . $ngif . '?"color:gold;":""}}' ."'";
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


	<div class="row bg-primary " ng-init="extraSort='';sortBy='VSL_ORST_PDATE';" >
	
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" ><?php echo setHeadField("VSL_ORHE_USLNA","5","C.S.R.","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" ><?php echo setHeadField("VGB_BPAR_BPART","10","Customer","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" ><?php echo setHeadField("VGB_CUST_DESCR","10","Name","","","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" ><?php echo setHeadField("VSL_ORHE_ORNUM","5","Order #","1","1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" ><?php echo setHeadField("VSL_ORHE_CUSPO","5","Cust. Ref.","","","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" >
			<table class="ab-spaceless" >
				<tr>
					<td>
						<?php echo setHeadField("VSL_ORDE_ORLIN","5","Line","","","","bg-primary"); ?>
					</td>
					<td>
						<?php echo setHeadField("VSL_ORST_STPSQ","5","Step","","","","bg-primary"); ?>
					</td>
				</tr>
			</table>	
		</div>

		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" ><?php echo setHeadField("VIN_ITEM_ITMID","10","Item","1","1","","bg-primary"); ?></div>
		<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 ab-spaceless" ><?php echo setHeadField("VIN_ITEM_DESC1","10","Description","","","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" ><?php echo setHeadField("VSL_ORST_ORDQT","10","Ord. Qty","","","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" ><?php echo setHeadField("VSL_ORST_PDATE","10","Planned Date","1","-1","","bg-primary"); ?></div>
		<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" ><?php echo setHeadField("VARIANCE","15","Variance","","","","bg-primary"); ?></div>

	</div>	
	
		<div class="row {{varRow.rowRowLog.hidden}} ab-odd ab-spaceless " id="rNum{{varRow.abIndex}}" 
			ng-repeat="varRow in  rawResult.vsl_varie | AB_noDoubles:'idVSL_ORST' | AB_Sorted:extraSort+sortBy " 
			
			>	

			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 " >
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
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VGB_BPAR_BPART","10","Customer","","",""," text-primary visible-xs visible-md  visible-sm "); ?>
							
						</td>
						
						<td>			
							<?php echo setRowDspField("varRow.VGB_BPAR_BPART","10","Customer","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >
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


			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >

				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORHE_ORNUM","5","Order #","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<a href="#VSL_ORDERS/VSL_ORHECT/idVSL_ORHE:{{varRow.idVSL_ORHE}},updType:UPDATE,Session:VSL_ORHECT,Process:VSL_ORDERS">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>			
						</td>
						<td>		
							<?php echo setRowDspField("varRow.VSL_ORHE_ORNUM","10","Order #www as","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >
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

			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;" class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORDE_ORLIN","5","Line","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
						</td>
						
						<td style="width:5%;">
							<?php echo setRowDspField("varRow.VSL_ORDE_ORLIN","5","Line","","","","  "); ?>
						</td>
						<td style="width:5%;">	
							<?php echo setRowDspField("varRow.VSL_ORST_STPSQ","5","Step","","","","  "); ?>
						</td>
						<td></td>
					</tr>
				</table>
			</div>


			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VIN_ITEM_ITMID","10","Item","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<?php echo setRowDspField("varRow.VIN_ITEM_ITMID","15","Item","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>


			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 " >

				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VIN_ITEM_DESC1","10","Description","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>
							<?php echo setRowDspField("varRow.VIN_ITEM_DESC1","30","Description","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

		
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  " >

				<table style="width:100%;" >
					<tr>

						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VSL_ORST_ORDQT","10","Ord. Qty","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>									
							<?php echo setRowDspField("varRow.VSL_ORST_ORDQT","15","Ord. Qty","","","","  "); ?>
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
							<?php echo setRowDspField("varRow.VSL_ORST_PDATE","15","Planned Date","","","","  "); ?>
						</td>
					</tr>
				</table>
			</div>

		
			<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12  ">
				<table style="width:100%;" >
					<tr>
						<td style="width:30%;"  class="text-left visible-xs visible-md  visible-sm ">
							<?php echo setHeadField("VARIANCE","15","Variance","","",""," text-primary visible-xs visible-md  visible-sm "); ?> 
							
						</td>
						
						<td>			
							{{ (ABGetDateFn('diff-today',varRow.VSL_ORST_PDATE )*-1) }}
						</td>
					</tr>
				</table>
			</div>

			

		</div>
	
	
	
	<div class="row mygrid-wrapper-div" ng-re2peat="varRec in  vsl_varie" ng-init="extraSort='';sortBy='VSL_ORST_PDATE';">	
	</div> 
	
		

</div>

<table class="table table-condensed hidden ">
	  <tr class="ab-spaceless">
	  		<td>
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vsl_orhe'?'vsl_orhe':'Yes'}}"
			class="hidden{{ tbData=='vsl_orhe'?'xxx':''}} text-primary" >
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vsl_orhe',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vsl_orhe',1)"  > </span>
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

<script>

function collapseall(dir)
{
		
	$("[exp-list]").each(function()
	{
		if ($(this).hasClass("in"))
		{
			if (dir==0)
			{
				$("[data-target='#" + $(this).attr("id") + "']").click();
				
			}
		}
		else
		{
			if (dir==1)
			{
				$("[data-target='#" + $(this).attr("id") + "']").click();
				
			}
		}
		
	});
	
	
}
</script>

