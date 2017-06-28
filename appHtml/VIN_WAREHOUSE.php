<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VIN_WAREHOUSE.php"; 
require_once "../stdSscript/stdSessionVarQuery.php";
?>
</div>
<style>
.text-primary span { display:none; }
.clearfix:after {
    clear:both;
  }
</style>
<div class="hidden" ng-init="SESSION_DESCR='Inventory Warehouses'">
	<span ab-label="vin_wars"></span>
</div>
<div style="margin-left:5px;">
	<div id="mainForm" ab-main="vin_wars" style="margin:0px;">
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
	 				 			 <a href="#{{opts.Process}}/VIN_WARSCT/Process:{{opts.Process}},Session:VIN_WARSCT,tblName:vin_wars,updType:CREATE,idVIN_WARS:0,tbData:{{tbData}}">
								<span >New</span>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</a>			
							</label>
						</td>
					<td>	  
<?php
	$xtmp = new appForm("VIN_WAREHOUSE");
	$hardCode = <<<BOD
			<div>
				<span ab-empty="{{tbData=='vin_wars'?'vin_wars':'Yes'}}"
				class="" >
				<input a_iref="02-60"
							size=15
							lval=""
							ng-change="FLT_WARS_WARID=VIN_WARS_WARID;VIN_WARS_WARID=' ';ABlstAlias('VIN_WARS_WARID','VIN_WARS_WARID,FLT_WARS_WARID','vin_wars',0);VIN_WARS_WARID=FLT_WARS_WARID;"
							ng-model="VIN_WARS_WARID" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>

				</span>
			</div>
			<input class="hidden"  id="FLT_WARS" ab-filter="vin_wars" ab-filter-cond="CONTAINS" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  

				ab-filter-model="VIN_WARS_WARID,VIN_WARS_DESCR"

				ng-model="FLT_WARS_WARID" />
BOD;
$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="STD_SEARCH";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;

$xtmp->setFieldWrapper("view01","0.0","vin_wars","VIN_WARS_WARID","",$grAttr,$laAttr,$inAttr,$hardCode);
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
			<div class="row ab-listhead bg-primary"  >
			<?php
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-1";
			$laAttr = $xtmp->laAttrib;
			$laAttr["class"] .= " bg-primary ";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.10","vin_wars","","",$grAttr,$laAttr,$inAttr," ");
			echo $xtmp->currHtml;
						
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-4";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_WARS_WARID";
			$laAttr["class"] .= "bg-primary ";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.20","vin_wars","VIN_WARS_WARID","",$grAttr,$laAttr,$inAttr," ");

			echo $xtmp->currHtml;
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-4";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_WARS_DESCR";
			$laAttr["class"] .= " bg-primary ";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$hardCode = '<div class="text-primary bg-primary" style="font-weight:700;padding-left:10px;" class="text-primary">Description </div> ';
			$xtmp->setFieldWrapper("view01","0.40","vin_wars","VIN_WARS_DESCR","",$grAttr,$laAttr,$inAttr,$hardCode);
			echo $xtmp->currHtml;
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_WARS_INVWA";
			$laAttr["class"] .= " bg-primary ";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.40","vin_wars","VIN_WARS_INVWA","",$grAttr,$laAttr,$inAttr,"");
			echo $xtmp->currHtml;
			
		/*	$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-3";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_WARS_ADDID";
			$laAttr["class"] .= " bg-primary ";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$hardCode = '<div class="text-primary bg-primary"style="font-weight:700;padding-left:10px;"  class="text-primary">Address ID Code</div> ';
			$xtmp->setFieldWrapper("view01","0.40","vin_wars","VIN_WARS_ADDID","",$grAttr,$laAttr,$inAttr,$hardCode);
			echo $xtmp->currHtml;
			*/
			?>
			</div>
		</td>
		</tr>	
	</table>
</div>
	
	<div class="mygrid-wrapper-div  ab-borderless ab-spaceless" >
		<table class="table table-condensed table-striped" >
	  		<tr role="presentation" class="" ng-repeat="x in vin_wars">	
	  		<form id="mainForm" name="mainForm"  ab-rowset="{{$index}}" ab-view="vin_wars" ab-main="vin_wars">	
	  			<td class=" ab-spaceless">
					<div class="row">
						<div class="col-sm-1">
							<a href="#{{opts.Process}}/VIN_WARSCT/idVIN_WARS:{{x.idVIN_WARS}},updType:UPDATE,Session:VIN_WARSCT,Process:{{opts.Process}}" >
								<?php
						$tFnc = new AB_querySession;
						$dtaObj = array();
						$dtaObj['PROCESS'] = "VIN_WAREHOUSE";
						$dtaObj['SESSION'] = "VIN_WARSCT";
						$chk = 0;
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_wars","New");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_wars","Upd");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_wars","Del");

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
							<span style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{x.idVIN_WARS}}" class="btn-link glyphicon glyphicon-th-list"></span>
						</div>							
<?php

// idvin_wars
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("","0.0","vin_wars","x.idVIN_WARS","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

$xtmp = new appForm("VIN_WAREHOUSE");

echo '<div class="col-sm-4">';

// vin_wars_WARID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div><label>&nbsp{{ x.VIN_WARS_WARID }}</label></div>';
$xtmp->setFieldWrapper("header","0.0","","x.VIN_WARS_WARID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</div><div class="col-sm-4">';


// vin_wars_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div><label>&nbsp{{ x.VIN_WARS_DESCR }}</label></div>';
$xtmp->setFieldWrapper("header","0.0","vin_wars","x.VIN_WARS_DESCR","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</div><div class="col-sm-2">';

// vin_wars_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div><span ng-show="{{ x.VIN_WARS_INVWA }} == \'1\'">Yes</span>
              <span ng-show="{{ x.VIN_WARS_INVWA }} == \'0\'">No</span></div>';
$xtmp->setFieldWrapper("header","0.0","vin_wars","x.VIN_WARS_INVWA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</div><div style="clear:both;"></div>';

/*echo '</div><div class="col-sm-3">';

// vin_wars_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div><label>&nbsp{{ x.VIN_WARS_ADDID }}</label></div></div>';
$xtmp->setFieldWrapper("header","0.0","vin_wars","x.VIN_WARS_ADDID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</div><div style="clear:both;"></div>';
*/

/* collapse in body section start */


echo '<div exp-list="1" id="exp_{{x.idVIN_WARS}}" class="collapse {{' . "collaps!=1?'':'in'}}" . '">';

echo '<div class="col-sm-1 "></div>';

/* Left side vin_wars data Section start */

echo '<div class="col-sm-4">';
?>
<div ng-repeat="y in x.rowSet" ng-if="y.idVIN_LOCS.length == 0">

<p>No Location Detail Found! </p>
</div>
<div ng-repeat="y in x.rowSet | AB_noDoubles:'idVIN_LOCS'" ng-if="y.idVIN_LOCS.length > 0"  ng-show="$first">
<?php
 echo '<table class="table table-condensed ab-spaceless" width="95%;">
      	 <tr>
				 
				<td><label class="small"><em  ab-label="VIN_LOCS_WARID" class="text-primary">Location ID</em></label></td>  
				<td><label class="small"><em  ab-label="STD_DESCR" class="text-primary">Description</em></label></td>
			 </tr>';
echo '<tr class="ab-spaceless" ng-repeat="y in x.rowSet | AB_noDoubles:\'idVIN_LOCS\' | orderBy:\'VIN_LOCS_LOCID\'" ng-if="y.idVIN_LOCS.length > 0">';
        
/*echo '<td  class="ab-spaceless small">';

$hardCode = '<a href="#{{opts.Process}}/VIN_LOCSCT/idVIN_LOCS:{{y.idVIN_LOCS}},idVIN_WARS:{{x.idVIN_WARS}},updType:UPDATE,Session:VIN_LOCSCT,Process:{{opts.Process}}" >';
						$tFnc = new AB_querySession;
						$dtaObj = array();
						$dtaObj['PROCESS'] = "VIN_WAREHOUSE";
						$dtaObj['SESSION'] = "VIN_LOCSCT";
						$chk = 0;
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_locs","New");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_locs","Upd");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_locs","Del");

						if ($chk > 0)
						{
							$hardCode .="<label >Edit</label>";
						}
						else
						{
							$hardCode .="<label >View</label>";
						}
						
 $hardCode .='<span  class="glyphicon glyphicon-pencil" ></span>
							</a>';
echo $hardCode;
echo  '</td>';*/

echo '<td  class="ab-spaceless">';

// VIN_ITEM_ITMID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small" ng-if="y.idVIN_ITEM == k.VSL_ORDE_ITMID"><label>&nbsp;{{y.VIN_LOCS_LOCID}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_locs","y.VIN_LOCS_LOCID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td><td  class="ab-spaceless">';

 // VIN_ITEM_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label><small>&nbsp;{{y.VIN_LOCS_DESCR}}</small></label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_locs","y.VIN_LOCS_DESCR","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td></tr></table>';
echo '</div>
     <div style="clear:both;"></div>

     </div>';
?>	
					 </div>	  			
	  			 </td>
	  			</form>
	  		</tr>
	  	  </table>
	  	  </div>
	  	</div>	
</div>

<table class="table table-condensed hidden ">
	  <tr class="ab-spaceless">
	  		<td>
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vin_wars'?'vin_wars':'Yes'}}"
			class="hidden{{ tbData=='vin_wars'?'xxx':''}} text-primary" >
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_wars',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_wars',1)"  > </span>
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
</script>﻿
