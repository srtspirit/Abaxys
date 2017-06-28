<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/VIN_ITEMS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>
</div>
<div class="hidden" ng-init="SESSION_DESCR='Item Control';FLT_ITEM_FIELD='VIN_ITEM_ITMID';">
	<span ab-label="VIN_ITEMCT"></span>
</div>

<div id="ab-new" >
	<label  title="CREATE" class="">
		 <a href="#VIN_ITEMS/VIN_ITEMCT/Process:VIN_ITEMS,Session:VIN_ITEMCT,tblName:vin_item,updType:CREATE,idVIN_ITEM:0" >
			<span >New</span>
			<span  class="glyphicon glyphicon-pencil" ></span>
		</a>			
	</label>
</div>

<div style="margin-left:5px;">
	<div id="mainForm" ab-main="vin_item" style="margin:0px;padding:0px;">
		<div class="row">
			<div class="col-sm-12 ab-spaceless">
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>
		</div>
		<div class="ab-spaceless  " style="vertical-align:top;padding:0px;margin:0px;" >
				<table style="width:80%;vertical-align:top;" class="ab-spaceless  " >
					<tr>
						<td style="width:15%;vertical-align:top;"></td>
						<td style="width:85%;vertical-align:top;"></td>
					</tr>
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
						<td>

							<span class="text-primary">
									<span ab-label="STD_SEARCH">Search In</span>&nbsp;
							</span>
								

						</td>
						<td>
						
						 
						</td>
					</tr>
										
					<tr>
			  
			<td>
			<div>
				<span ab-empty="{{tbData=='vin_item'?'vin_item':'Yes'}}"
				class="" >
					<input a_iref="02-60"
							size=15
							lval=""
							gng-keyup="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',0);"
							ng-change="FLT_ITEM_ITMID=VIN_ITEM_ITMID;VIN_ITEM_ITMID=' ';ABlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,FLT_ITEM_LOTCT,FLT_ITEM_ITMID','vin_item');VIN_ITEM_ITMID=FLT_ITEM_ITMID;"
							
							gng-blur="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',0);"
							ng-model="VIN_ITEM_ITMID" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>
	
				</span>
			</div>
			</td>
			<td>
				<div style="font-size:4pt;">&nbsp;</div>

				<span class="text-primary">
					
					<input type="radio"  name="LOTCT" ng-click="FLT_ITEM_LOTCT='1';VIN_ITEM_ITMID=' ';ABlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,FLT_ITEM_LOTCT,FLT_ITEM_ITMID','vin_item');VIN_ITEM_ITMID=FLT_ITEM_ITMID;" />&nbsp;Lot Only
					&nbsp;&nbsp;
					<input type="radio"  name="LOTCT" ng-click="FLT_ITEM_LOTCT='0';VIN_ITEM_ITMID=' ';ABlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,FLT_ITEM_LOTCT,FLT_ITEM_ITMID','vin_item');VIN_ITEM_ITMID=FLT_ITEM_ITMID;" />&nbsp;Non Lot Only
					&nbsp;&nbsp;
					<input type="radio"  name="LOTCT"  checked ng-click="FLT_ITEM_LOTCT='';VIN_ITEM_ITMID=' ';ABlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,FLT_ITEM_LOTCT,FLT_ITEM_ITMID','vin_item');VIN_ITEM_ITMID=FLT_ITEM_ITMID;" />&nbsp;All
					&nbsp;&nbsp;
					
					
					<input class="hidden" ab-filter="vin_item" ab-filter-cond="EQ" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  ab-filter-model="VIN_ITEM_LOTCT" ng-model="FLT_ITEM_LOTCT" />

					<input class="hidden" id="FLT_ITEM" ab-filter="vin_item" ab-filter-cond="CONTAINS" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  
						ab-filter-model="VIN_ITEM_ITMID,VIN_ITEM_DESC1,VIN_ITEM_DESC2,VIN_ITEM_DESC3,VIN_ITEM_PINFO,VIN_ITEM_INVID,VIN_ITYP_ITYPE,VIN_ITYP_DESCR,VIN_GROU_ITGRP,VIN_GROU_DESCR,VIN_LSHE_LOTID" 
						ng-model="FLT_ITEM_ITMID" />
					<!-- <input  class="hidden" ng-model="FLT_ITEM_FIELD" /> -->
					
				</span>
				
			</td>

					
				</tr>
			</table>

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
			
			$xtmp = new appForm("VIN_ITEMS");
			$xtmp->grAttrib["style"]="";
			$xtmp->grAttrib["class"]="ab-spaceless ";
			
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-1";
			$laAttr = $xtmp->laAttrib;
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_item","","",$grAttr,$laAttr,$inAttr,"  ");
			echo $xtmp->currHtml;
						
			// $xtmp = new appForm("VIN_ITEMS");
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="{{tbData=='vin_item'?'VIN_ITEM_ITMID':'VIN_ITEM_ITMID'}}";
			$laAttr["class"] .= "bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";

		
			$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_ITMID","",$grAttr,$laAttr,$inAttr," ");
			
			echo $xtmp->currHtml;
			
			// $xtmp = new appForm("VIN_ITEM");
			$grAttr = $xtmp->grAttrib;
			$grAttr["class"] .= "col-sm-2";
			$laAttr = $xtmp->laAttrib;
			$laAttr["ab-label"] ="VIN_ITEM_DESC1";
			$laAttr["class"] .= " bg-primary ";
			$laAttr["style"] .= "padding-left:10px;";
			$inAttr = $xtmp->inAttrib;
			$inAttr["class"]= " hidden ";
			$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_DESC1","",$grAttr,$laAttr,$inAttr,"  ");
	

			echo $xtmp->currHtml;

			$xtmp = new appForm("VIN_ITEMS");

	
			?>
			</div>
		</td>
		</tr>	
	</table>
</div>
<div class="mygrid-wrapper-div"  style="margin:0px;padding:0px;">
	<div>
		<table class="table table-condensed table-striped">
	  		<tr role="presentation" ng-repeat="x in vin_item">	
	  		<form id="mainForm" name="mainForm"  ab-rowset="{{$index}}" ab-view="vin_item" ab-main="vin_item">
	  			<td ng-if="abSessionModal==true" class="small">
	  				<a  ng-click="ABsessionSetResponse(x)" > Select </a>&nbsp;
	  			</td>
				<td style="min-width:10px;max-width:10px;" >	
					<span ng-if="!ABSelectors.idVIN_ITEM[x.idVIN_ITEM]" ng-click="ABRecSelectors('idVIN_ITEM',x.idVIN_ITEM,'add',x.VIN_ITEM_ITMID + ':' + x.VIN_ITEM_DESC1);">
						<span class="ab-pointer glyphicon glyphicon-plus text-muted small" title="add to tagged list" ></span>
					</span>
					<span ng-if="ABSelectors.idVIN_ITEM[x.idVIN_ITEM]" ng-click="ABRecSelectors('idVIN_ITEM',x.idVIN_ITEM,'delete',x.VIN_ITEM_ITMID + ':' + x.VIN_ITEM_DESC1);" >
						<span class="btn-link glyphicon glyphicon-tag" title="remove from tagged list" ></span>
					</span>
					
				</td>

	  			<td class=" ab-spaceless" >
					<div class="row">
						<div class="col-sm-1">
							&nbsp;
							<a href="#{{opts.Process}}/VIN_ITEMCT/idVIN_ITEM:{{x.idVIN_ITEM}},updType:UPDATE,Session:VIN_ITEMCT,Process:{{opts.Process}}" >
							
								<?php
						$tFnc = new AB_querySession;
						$dtaObj = array();
						$dtaObj['PROCESS'] = "VIN_ITEMS";
						$dtaObj['SESSION'] = "VIN_ITEMCT";
						$chk = 0;
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_item","New");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_item","Upd");
						$chk += $tFnc->hasPriviledge($dtaObj,"vin_item","Del");

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
							
						<span style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{x.idVIN_ITEM}}" class="btn-link glyphicon glyphicon-th-list"></span>
						</div>	
												
<div class="col-sm-2 ab-spaceless">
<input class="hidden" ng-model="x.idVIN_ITEM" />
<input class="hidden" ng-model="x.VIN_ITEM_ITMID" />
<input class="hidden" ng-model="x.VIN_ITEM_DESC1" />
<label>
	{{x.VIN_ITEM_ITMID}} 
	<small>
		<br>&nbsp;{{x.VIN_ITEM_DESC1}}
	</small>
</label>

</div>
<div class="col-sm-2 ab-spaceless small">

<span class="small">
<label>

	<span>{{x.VIN_ITEM_DESC2}}</span> 
	<span>{{x.VIN_ITEM_DESC3}}</span> 

	<span>
		<small class="text-primary" ng-if="x.VIN_ITEM_PINFO.length>0" >
			<em><br>Packaging:</em>
		</small>
		{{x.VIN_ITEM_PINFO}}
	</span>
	<span>
		<small class="text-primary" ng-if="x.VIN_ITEM_INVID.length>0" >
			<em><br>Invoicing Code:</em>
		</small>
		{{x.VIN_ITEM_INVID}}
	</span>

	
</label>
</span>	

</div>


<div class="col-sm-1 ab-spaceless small">

<span class="small">
<label>
	<table>
	<tr>
		<td class="small">
			<span class="text-primary"><em>On&nbsp;hand:</em></span>
		</td>
		<td style="min-width:35px;" >
			&nbsp;{{ x.VIN_INVE_BOHQT.length>0?x.VIN_INVE_BOHQT:'0' }}&nbsp;
		</td>
	</tr>
	<tr>
		<td class="small">
			<span class="text-primary"><em>Allocated:</em></span>
		</td>
		<td>
			&nbsp;{{x.VIN_INVE_ALOQT>0?x.VIN_INVE_ALOQT:'0'}}&nbsp;
		</td>
	</tr>
	<tr>
		<td class="small">
			<span class="text-primary"><em>On&nbsp;PO:</em></span>
		</td>
		<td >
			&nbsp;{{x.VIN_INVE_PURQT>0?x.VIN_INVE_PURQT:'0'}}&nbsp;
		</td>
	</tr>

	</table>

</label>
</span>	
	
</div>
<div class="col-sm-2 ab-spaceless small">


<span class="small">
<label>
	<table>
	<tr>
		<td >
			
			<em class="text-primary" ab-label="STD_UOM_SHORT" >UM</em>:&nbsp;{{ x.VIN_UNIT_DESCR }}<br>
			<span class="small" ng-if="x.VIN_ITYP_ITYPE.length>0" >
				<em class="text-primary">Type:</em>&nbsp;{{x.VIN_ITYP_ITYPE}}&nbsp;<small>{{x.VIN_ITYP_DESCR}}<br></small>
			</span>
				
			<span class="small" ng-if="x.VIN_GROU_ITGRP.length>0" >
				<em class="text-primary">Group:</em>&nbsp;{{x.VIN_GROU_ITGRP}}&nbsp;<small>{{x.VIN_GROU_DESCR}}</small>
			</span>
		</td>
	</tr>
	</table>
</label>
</span>		
	
<?php

echo '</div><div class="col-sm-2 ab-spaceless small">';

echo '</div></div></div>';
		
echo '<div style="clear:both;"></div>';
echo '<div exp-list="1" id="exp_{{x.idVIN_ITEM}}" class="collapse {{' . "collaps!=1?'':'in'}}" . '">';
echo '<div class="row">';
echo '<div class="col-sm-6 hidden{{x.VIN_ITEM_LOTCT!=1?\'\':\'xx\'}}">';
echo '<label class="ng-binding small">Item Lot:</label>';
echo '<table class="table table-condensed ab-spaceless" width="95%;">
      	 <tr>
				<td><a href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:0,idVIN_ITEM:{{ x.idVIN_ITEM }},updType:CREATE,Session:VIN_LOTCT,Process:VIN_ITEMS" >
<span>New</span>
<span class="glyphicon glyphicon-pencil" ></span>
</a></td>  

				<td class="small"><label class="small"><em  ab-label="VIN_LSHE_LOTID" class="text-primary">Lot Identification</em></label></td>
				<td class="small"><label class="small"><em  ab-label="VIN_LSHE_DOMDA" class="text-primary">VIN_LSHE_DOMDA </em></label></td>
				<td class="small"><label class="small"><em  ab-label="VIN_LSHE_DATES" class="text-primary">VIN_LSHE_DATES</em></label></td>  
				<td class="small"><label class="small"><em  ab-label="VIN_LSHE_BPART" class="text-primary">VIN_LSHE_BPART</em></label></td>
			</tr>';
      
        echo '<tr class="ab-spaceless" ng-repeat="k in x.rowSet |AB_noDoubles:\'idVIN_LSHE\'" ng-if="k.idVIN_LSHE>0 && k.VIN_LSHE_SOLDO == 0">';
        echo '<td  class="ab-spaceless"><a href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:{{k.idVIN_LSHE}},idVIN_ITEM:{{idVIN_ITEM}},updType:UPDATE,Session:VIN_LOTCT,Process:VIN_ITEMS" >
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

// VSL_ORHE PURCHASE ID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small">&nbsp;{{k.VIN_LSHE_BPART}}</label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_lshe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td>';

 // VSL_ORHE DATE
 /*
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = '<div class="small"><label class="small"><small>&nbsp;Active</small></label></div>';
$xtmp->setFieldWrapper("toggle-item","3.1","vin_lshe","","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $hardCode;
echo '</td>';
*/
?>
</tr></table>
		  </div> 
<div class="col-sm-6">
<label class="ng-binding small">Sales Order:</label>
<div ng-repeat="s in x.rowSet" ng-if="s.VSL_ORHE_ORNUM.length == 0">
<p>No sales orders ! </p>
</div>
<div ng-repeat="s in x.rowSet | AB_noDoubles:'idVSL_ORHE'" ng-if="s.VSL_ORHE_ORNUM.length > 0"  ng-show="$first">
<table class="table table-condensed ab-spaceless" width="95%;">
<tr>
<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_ORNUM" >Order No.#</em></label></td>
<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_CUSPO">Customer PO number</em></label></td>
<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_ODATE">Order Date</em></label> </td>
<td  class="small"><label><em class="text-primary" ab-label="VSL_ORDE_ORDQT">Qty</em></label></td>
<td  class="small"><label><em class="text-primary" ab-label="VSL_ORDE_OUNET">Price</em></label></td>
<td  class="small"><label><em class="text-primary" ab-label="VSL_ORHE_ORNUM">Total</em></label></td>
</tr>
<tr ng-repeat="s in x.rowSet | AB_noDoubles:'idVSL_ORHE'">
<td class="small" ><label class="small">&nbsp;{{s.VSL_ORHE_ORNUM}}</label></td>
<td class="small" ><label class="small">&nbsp;{{s.VSL_ORHE_CUSPO}}</label></td>
<td class="small" ><label class="small">&nbsp;{{s.VSL_ORHE_ODATE}}</label></td>
<td class="small" ><label class="small">&nbsp;{{s.VSL_ORDE_ORDQT}}</label></td>
<td class="small" ><label class="small">&nbsp;{{s.VSL_ORDE_OUNET}}</label></td>
<td class="small" ><label class="small">&nbsp;{{(s.VSL_ORDE_ORDQT * s.VSL_ORDE_OUNET)}}</label></td>
</tr>
</table>
</div>
</div>
</div>
<div class="row">		  
<div class="col-sm-6 hidden{{x.VIN_ITEM_LOTCT!=1?'':'xx'}}">
<label class="ng-binding small">Product Spec Sheet:</label>
<?php
echo '<table class="table table-condensed ab-spaceless" width="95%;">
      	 <tr>
				
				<td><a href="#/VIN_ITEMS/VIN_SSMACT/idVIN_SSMA:0,idVIN_ITEM:{{ x.idVIN_ITEM }},updType:CREATE,Session:VIN_SSMACT,Process:VIN_ITEMS">
<span>New</span>
<span class="glyphicon glyphicon-pencil" ></span>
</a></td>  
				<td class="small"><label class="small"><em  ab-label="VIN_SSMA_SPEID" class="text-primary">Spec. Sheet ID Code</em></label></td>
				<td class="small"><label class="small"><em  ab-label="VIN_SSMA_DESCR" class="text-primary">VIN_SSMA_DESCR </em></label></td>
		</tr>';
      
        echo '<tr class="ab-spaceless" ng-repeat="spec in x.rowSet |AB_noDoubles:\'idVIN_SSMA\'" ng-if="spec.idVIN_SSMA>0">';
        echo '<td  class="ab-spaceless"><a href="#/VIN_ITEMS/VIN_SSMACT/idVIN_SSMA:{{spec.idVIN_SSMA}},idVIN_ITEM:{{x.idVIN_ITEM}},updType:UPDATE,Session:VIN_SSMACT,Process:VIN_ITEMS" >
			<span class="text-primary small">
			Edit
			<span class="glyphicon glyphicon-pencil" ></span>
			</span>
			</a></td><td>';

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
<div class="col-sm-6">
<label class="ng-binding small">Purchase Order:</label>
<label class="ng-binding text-primary small">purchasing coming soon</label>
</div>	
</div>	   			
	  			</td>
	  			</form>
	  		</tr>
	  	  </table>
	</div> 
</div>
</div>
<table class="table table-condensed ">
	  <tr class="ab-spaceless">
	  		<td>
			&nbsp;&nbsp;&nbsp;
			<span ab-empty="{{tbData=='vin_item'?'vin_item':'Yes'}}"
			class="{{ tbData=='vin_item'?'xxx':''}} text-primary" >
		
			      	<span class="btn glyphicon glyphicon-backward "  src="stdImages/buttons/A_Previous.png" ng-click="kPress('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',-1)"  > </span>
			      	<span class="btn glyphicon glyphicon-forward " src="stdImages/buttons/A_Next.png"    ng-click="ABlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,VIN_ITEM_LOTCT','vin_item')"  > </span>
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
