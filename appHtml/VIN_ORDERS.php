<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VIN_TRANSAC.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>
</div>

<div class="hidden" ng-init="SESSION_DESCR='Inventory Transactions'">
	<span ab-label="VIN_ORHECT"></span>
</div>
<div style="margin-left:5px;">
	<div id="mainForm" ab-main="vin_orhe" style="margin:0px;">
		<div class="row">
			<div class="col-sm-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
			<div class="col-sm-12">
				<table>
					<tr>
					  	<td>
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
							href="#VIN_TRANSAC/VIN_ORHECT/Process:VIN_TRANSAC,Session:VIN_ORHECT,tblName:vin_orhe,updType:CREATE,idVIN_ORHE:0,tbData:{{tbData}}" 
							>
								<span >New</span>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>			
							</label>
						</td>
					<td>	  
<?php
	$xtmp = new appForm("VIN_ORDERS");
	$hardCode = <<<BOD
			<div>
				<span ab-empty="{{tbData=='vin_orhe'?'vin_orhe':'Yes'}}"
				class="" >
				<input a_iref="02-60"
							size=15
							lval=""
							ng-change="FLT_ORHE_ORNUM=VIN_ORHE_ORNUM;VIN_ORHE_ORNUM=' ';ABlstAlias('VIN_ORHE_ORNUM','VIN_ORHE_ORNUM,FLT_ORHE_ORNUM','vin_orhe','vin_orhe');VIN_ORHE_ORNUM=FLT_ORHE_ORNUM;"
							ng-model="VIN_ORHE_ORNUM" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>

				</span>
			</div>
			<input class="hidden"  id="FLT_ORHE" ab-filter="vin_orhe" ab-filter-cond="CONTAINS" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  

				ab-filter-model="VIN_ORHE_ORNUM,VIN_ORHE_CUSPO,VIN_ORHE_USLNA,VGB_CUST_BPNAM,VGB_ADDR_DESCR,VGB_SLRP_SLSRP,VIN_ITEM_ITMID,VIN_ITEM_DESC1,VIN_ORDE_ODATE,VIN_ORDE_DDATE"

				ng-model="FLT_ORHE_ORNUM" />
BOD;
$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="STD_SEARCH";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;

$xtmp->setFieldWrapper("view01","0.0","vin_orhe","VIN_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>
					</td>


				</tr>
			</table>
		</div>
	</div>
	<script>
		$('#ab-buttonPad').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
	</script>
	<div>
	
	
  	<table class="table table-condensed" style="width:95%;">
	<tr>
		<td class=" ab-spaceless">
			<div class="row bg-primary"  >
			<?php
			
			
			$xtmp = new appForm("VIN_ORDERS");
			$xtmp->grAttrib["style"]="";
			$xtmp->grAttrib["class"]="ab-spaceless ";
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-1";
			$laAttr = $xtmp->laAttrib;
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.10","vin_orhe","","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
						
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="STD_ORNUM";
			$laAttr["class"] .= "bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.20","vin_orhe","VIN_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
			
			
			$xtmp = new appForm("VIN_ORDERS");
			
						
			?>
			</div>
		</td>
		</tr>	
	</table>
</div>
	
	<div class="mygrid-wrapper-div  ab-borderless ab-spaceless" >
		<table class="table table-condensed table-striped" >
	  		<tr role="presentation" class="" ng-repeat="x in rawResult.vin_orhe | AB_noDoubles:'idVIN_ORHE'" >	
	  		<form id="mainForm" name="mainForm"  ab-rowset="{{$index}}" ab-view="vin_orhe" ab-main="vin_orhe">	
	  			<td class=" ab-spaceless">
					<div class="row">
						<div class="col-sm-1">
							<a href="#{{opts.Process}}/VIN_ORHECT/idVIN_ORHE:{{x.idVIN_ORHE}},updType:UPDATE,Session:VIN_ORHECT,Process:{{opts.Process}}" >
								<?php
						$tFnc = new AB_querySession;
						$dtaObj = array();
						$dtaObj['PROCESS'] = "VIN_TRANSAC";
						$dtaObj['SESSION'] = "VIN_ORHECT";
						$chk = 0;
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_orhe","New");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_orhe","Upd");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_orhe","Del");

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
							<span style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{x.idVIN_ORHE}}" class="btn-link glyphicon glyphicon-th-list"></span>
						</div>							
<?php

// idVIN_ORHE
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("","0.0","vin_orhe","x.idVIN_ORHE","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

$xtmp = new appForm("VIN_ORDERS");

echo '<div class="col-sm-2 ">';

// VIN_ORHE_ORNUM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = " hidden ";

$inAttr = $xtmp->inAttrib;
$hardCode = '<div><label>&nbsp{{ x.VIN_ORHE_ORNUM }}</label></div>
            <div class="small" class="text-primary">
            <label>
            <em  ab-label="VIN_ORHE_CDATE" class="text-primary">Created :</em>
            <small>&nbsp;{{x.VIN_ORHE_CDATE}}</small>
            </label>
            </div> ';
            
$xtmp->setFieldWrapper("header","0.0","vin_orhe","x.VIN_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


echo '</div>';
echo '<div exp-list="1" id="exp_{{x.idVIN_ORHE}}" class="collapse {{' . "collaps!=1?'':'in'}}" . '">';
echo '<div class="col-sm-1 "></div>';
echo '<div class="col-sm-6">';
echo '<table class="table table-condensed ab-spaceless" width="95%;">
      	 <tr>
				<td><label class="small"><em  ab-label="VIN_ITEM_ITMID" class="text-primary">Line#</em></lable></td>  
				<td><label class="small"><em  ab-label="VIN_ITEM_ITMID" class="text-primary">Item Code</em></lable></td>  
				<td><label class="small"><em  ab-label="STD_DESCR" class="text-primary">Description</em></lable></td>
				<td><label class="small"><em  ab-label="VIN_ORHE_DDATE_10" class="text-primary">Lot</em></lable></td>
				<td><label class="small"><em  ab-label="STD_QUANTITY_SHORT" class="text-primary">Adj </em></lable></td>
				<td><label class="small"><em  ab-label="STD_PRICE" class="text-primary">UofM </em></lable></td>     
				<td><label class="small"><em  ab-label="VIN_ORST_STEPS" class="text-primary">War </em></lable></td>     
				<td><label class="small"><em  ab-label="VIN_ORST_STEPS" class="text-primary">Location</em></lable></td>     
       	</tr>';
       	
       	
        echo '<tr class="ab-spaceless" ng-repeat="k in rawResult.vin_orhe | AB_noDoubles:\'idVIN_ORDE,idVIN_LSTR\'" ng-if="x.idVIN_ORHE == k.idVIN_ORHE" >';
        echo '<td class="small"><label>{{k.VIN_ORDE_ORLIN}}</label></td>';
echo '<td  class="ab-spaceless">';
echo '<label class="small">&nbsp;{{k.VIN_ITEM_ITMID}}</label>';
echo  '</td><td  class="ab-spaceless">';
echo  '<label>&nbsp;{{k.VIN_ITEM_DESC1}}</label></div></div>';
echo '</td><td  class="ab-spaceless">';
echo '<label><small>&nbsp;{{k.VIN_LSHE_LOTID}}</small></label>';
echo '</td><td  class="ab-spaceless">';
echo '<label ng-if="k.VIN_ITEM_LOTCT==0"><small>&nbsp;{{k.VIN_ORDE_ORDQT}}</small></label>';
echo '<label ng-if="k.VIN_ITEM_LOTCT==1"><small>&nbsp;{{k.VIN_LSTR_ALOQT}}</small></label>';
echo '</td><td class="ab-spaceless">';
echo '<label><small>&nbsp;{{k.VIN_UNIT_DESCR}}</small></label>';
echo '</td><td class="ab-spaceless">';
echo '<label><small>&nbsp;{{k.VIN_WARS_DESCR}}</small></label>';
echo '</td><td class="ab-spaceless">';
echo '<label><small>&nbsp;{{k.VIN_LOCS_DESCR}}</small></label>';
echo '</td></tr></table>';
echo '</div>';
/* Right side VIN_ORDE data Section End */
echo '</div>';
?>


<table class="table table-condensed hidden ">
	  <tr class="ab-spaceless">
	  		<td>
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vin_orhe'?'vin_orhe':'Yes'}}"
			class="hidden{{ tbData=='vin_orhe'?'xxx':''}} text-primary" >
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_orhe',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_orhe',1)"  > </span>
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