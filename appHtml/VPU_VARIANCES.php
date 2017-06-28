<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VPU_ORDERS.php"; 
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
<div class="hidden" ng-init="SESSION_DESCR='Purchase receipt variance ';idVPU_ORHE=0;ABlstAlias('idVPU_ORHE','idVPU_ORHE','vpu_userVariance','vpu_varie');" >
	<span ab-label="VPU_VARIANCES"></span>
</div>

<div style="margin-left:5px;"   >
	<div id="mainForm" ab-main="vpu_orhe" style="margin:0px;"  >
		<div class="row ">
			<div class="col-sm-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
			<div class="col-sm-12">
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
	 				 			 <a 
							href="#VPU_ORDERS/VPU_ORHECT/Process:VPU_ORDERS,Session:VPU_ORHECT,tblName:vpu_orhe,updType:CREATE,idVPU_ORHE:0,tbData:{{tbData}}" 
							>
								<span >New</span>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>			
							</label>
						</td>
					<td class="hidden">	  
<?php
	$xtmp = new appForm("VPU_ORDERS");
	$hardCode = <<<BOD
			<div>
				<span ab-empty="{{tbData=='vpu_orhe'?'vpu_orhe':'Yes'}}"
				class="" >
				<input a_iref="02-60"
							size=15
							lval=""
							ng-change="FLT_ORHE_ORNUM=VPU_ORHE_ORNUM;VPU_ORHE_ORNUM=' ';ABlstAlias('VPU_ORHE_ORNUM','VPU_ORHE_ORNUM,FLT_ORHE_ORNUM','vpu_orhe',0);VPU_ORHE_ORNUM=FLT_ORHE_ORNUM;"
							ng-model="VPU_ORHE_ORNUM" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>

				</span>
			</div>
			<input class="hidden"  id="FLT_ORHE" ab-filter="vpu_orhe" ab-filter-cond="CONTAINS" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  

				ab-filter-model="VPU_ORHE_ORNUM,VPU_ORHE_CUSPO,VPU_ORHE_USLNA,VGB_SUPP_BPNAM,VGB_ADDR_DESCR,VGB_SLRP_SLSRP,VIN_ITEM_ITMID,VIN_ITEM_DESC1,VPU_ORDE_ODATE,VPU_ORDE_DDATE"

				ng-model="FLT_ORHE_ORNUM" />
BOD;
$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="STD_SEARCH";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;

$xtmp->setFieldWrapper("view01","0.0","vpu_orhe","VPU_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>
					</td>

					<td>&nbsp;
						<a href="#/VPU_ORDERS/VPU_ORDERS/Process:VPU_ORDERS,Session:VPU_ORDERS,tblName:vpu_orhe" >
						<span ab-label="VPU_ORDERS_vpu_orhe" >Po</span>
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
	$retVal = "<input ng-init=" . '"' . "varRow.on=(ACVarColSetIsOn('" . $name . "',varRow." . $name . ")!=true?'hidden':'')".'"'." readOnly class='ab-borderless ". $class . " ' ";
	$retVal .= "title='{{" . $name ."}}' ";
	$retVal .= "size=" . $size . " ";
	$retVal .= "ab-ilabel='" . $label . "'  ";
	$retVal .= "ng-model='" . $name . "'  ";
	
	$retVal .= "/>";
	
	
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
		$trn[count($trn)] = '	ng-repeat="varRow in  rawResult.vpu_varie | AB_noDoubles:'. "'". $name. "'" .' | AB_Sorted:'."'".$name."'".'  " >';
		$trn[count($trn)] = ' 		<td class="text-center ab-pointer ab-border ab-spaceless" ';
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
	$inputStyle = "";
	
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


	<div class="row bg-primary" ng-init="extraSort='';sortBy='VPU_ORST_PDATE';" >
		<div class="col-sm-1 ab-spaceless" ><?php echo setHeadField("VPU_ORHE_USLNA","5","C.S.R.","1","1","","bg-primary"); ?></div>
		<div class="col-sm-1 ab-spaceless" ><?php echo setHeadField("VGB_BPAR_BPART","10","Supplier","1","1","","bg-primary"); ?></div>
		<div class="col-sm-1 ab-spaceless" ><?php echo setHeadField("VGB_SUPP_DESCR","10","Name","","","","bg-primary"); ?></div>
		<div class="col-sm-1 ab-spaceless" ><?php echo setHeadField("VPU_ORHE_ORNUM","5","Order #","1","1","","bg-primary"); ?></div>
		<div class="col-sm-1 ab-spaceless" ><?php echo setHeadField("VPU_ORHE_CUSPO","5","Supplier Ref.","","","","bg-primary"); ?></div>
		<div class="col-sm-1 ab-spaceless" >
			<table class="ab-spaceless" >
				<tr>
					<td>
						<?php echo setHeadField("VPU_ORDE_ORLIN","5","Line","","","","bg-primary"); ?>
					</td>
					<td>
						<?php echo setHeadField("VPU_ORST_STPSQ","5","Step","","","","bg-primary"); ?>
					</td>
				</tr>
			</table>	
		</div>

		<div class="col-sm-1 ab-spaceless" ><?php echo setHeadField("VIN_ITEM_ITMID","10","Item","1","1","","bg-primary"); ?></div>
		<div class="col-sm-2 ab-spaceless" ><?php echo setHeadField("VIN_ITEM_DESC1","10","Description","","","","bg-primary"); ?></div>
		<div class="col-sm-1 ab-spaceless" ><?php echo setHeadField("VPU_ORST_ORDQT","10","Ord. Qty","","","","bg-primary"); ?></div>
		<div class="col-sm-1 ab-spaceless" ><?php echo setHeadField("VPU_ORST_PDATE","10","Planned Date","1","-1","","bg-primary"); ?></div>
		<div class="col-sm-1 ab-spaceless" ><?php echo setHeadField("VARIANCE","15","Variance","","","","bg-primary"); ?></div>

	</div>	
	 
		<div class="row {{varRow.rowRowLog.hidden}} " id="rNum{{varRow.abIndex}}" 
		ng-repeat="varRow in  rawResult.vpu_varie | AB_noDoubles:'idVPU_ORST' | AB_Sorted:extraSort+sortBy " >	
			<div class="col-sm-1" ><table><tr><td> </td><td><?php echo setRowDspField("varRow.VPU_ORHE_USLNA","5","C.S.R.","","","",""); ?></td></tr></table></div>
			<div class="col-sm-1" ><?php echo setRowDspField("varRow.VGB_BPAR_BPART","15","Customer","","","",""); ?></div>
			<div class="col-sm-1" ><?php echo setRowDspField("varRow.VGB_SUPP_BPNAM","15","Name","","","",""); ?></div>
			<div class="col-sm-1" >
			<a href="#VPU_ORDERS/VPU_ORHECT/idVPU_ORHE:{{varRow.idVPU_ORHE}},updType:UPDATE,Session:VPU_ORHECT,Process:VPU_ORDERS">
				<span class="glyphicon glyphicon-pencil"></span>
			</a>			
				<?php echo setRowDspField("varRow.VPU_ORHE_ORNUM","6","Order #www as","","","",""); ?>
			</div>
			<div class="col-sm-1" ><?php echo setRowDspField("varRow.VPU_ORHE_CUSPO","15","Cust. Ref.","","","",""); ?></div>
			<div class="col-sm-1" >
				<table class="ab-spaceless" >
					<tr>
						<td class="text-center" >
							<?php echo setRowDspField("varRow.VPU_ORDE_ORLIN","5","Line","","","",""); ?>
						</td>
						<td class="text-center" >
							<?php echo setRowDspField("varRow.VPU_ORST_STPSQ","5","Step","","",""," "); ?>
						</td>
					</tr>
				</table>				
			
			
			
			</div>

			<div class="col-sm-1" ><?php echo setRowDspField("varRow.VIN_ITEM_ITMID","15","Item","","","",""); ?></div>
			<div class="col-sm-2" ><?php echo setRowDspField("varRow.VIN_ITEM_DESC1","30","Description","","","",""); ?></div>
			<div class="col-sm-1" ><?php echo setRowDspField("varRow.VPU_ORST_ORDQT","15","Ord. Qty","","","",""); ?></div>
			<div class="col-sm-1" ><?php echo setRowDspField("varRow.VPU_ORST_PDATE","15","Planned Date","","","",""); ?></div>
			<div class="col-sm-1 ">{{ (ABGetDateFn('diff-today',varRow.VPU_ORST_PDATE )*-1) }}</div>
		</div>
	
	
	
	<div class="row mygrid-wrapper-div" ng-re2peat="varRec in  vpu_varie" ng-init="extraSort='';sortBy='VPU_ORST_PDATE';">	
	</div> 
	
		

</div>

<table class="table table-condensed hidden ">
	  <tr class="ab-spaceless">
	  		<td>
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vpu_orhe'?'vpu_orhe':'Yes'}}"
			class="hidden{{ tbData=='vpu_orhe'?'xxx':''}} text-primary" >
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vpu_orhe',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vpu_orhe',1)"  > </span>
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

