	<div id="sessionModalVIN_ITEMS" class="modal fade" role="dialog"  >
	  <div class="modal-dialog" style="width:60%;">
			<button id="ab-sessionBoardVIN_ITEMS" type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" data-target="#sessionModalVIN_ITEMS">Open Modal</button>	
	    <!-- Modal content-->
	    <div class="modal-content"  >
	      <div class="modal-header" >
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">{{SESSION_DESCR}}</h4>
	      </div>
	      <div id="ab-errorBoard" class="modal-body" style="overflow:auto;" >

<!-- Start Modal Insert -->

<div style="margin-left:5px;">
	<div style="margin:0px;padding:0px;">
		<div class="ab-spaceless  " style="vertical-align:top;padding:0px;margin:0px;" >
				<table style="width:80%;vertical-align:top;" class="ab-spaceless  " >
					<tr>
						<td style="width:15%;vertical-align:top;"></td>
						<td style="width:85%;vertical-align:top;"></td>
					</tr>
					<tr>
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
						ab-filter-model="VIN_ITEM_ITMID,VIN_ITEM_DESC1,VIN_ITEM_DESC2,VIN_ITEM_DESC3,VIN_ITEM_PINFO,VIN_ITEM_INVID,VIN_ITYP_ITYPE,VIN_ITYP_DESCR,VIN_GROU_ITGRP,VIN_GROU_DESCR" 
						ng-model="FLT_ITEM_ITMID" />
					<!-- <input  class="hidden" ng-model="FLT_ITEM_FIELD" /> -->
					
					
				</span>
				
			</td>

					
				</tr>
			</table>

	</div>
	<script>
		$('#ab-new').html('');
	</script>
	<div>
  	<table class="table table-condensed" style="width:95%;">
	<tr>
		
		<td class=" ab-spaceless">
			<div class="row ab-listhead bg-primary"  >
			<?php
			
			$xtmp = new appForm("VIN_ITEMS");
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
//					
//				/*	// $xtmp = new appForm("VIN_ITEMS");
//					$grAttr = $xtmp->grAttrib;
//					$grAttr["class"] .= "col-sm-2";
//					$laAttr = $xtmp->laAttrib;
//					$laAttr["ab-label"] ="VIN_ITEM_PINFO";
//					$laAttr["class"] .= " bg-primary ";
//					$laAttr["style"] .= "padding-left:10px;";
//					$inAttr = $xtmp->inAttrib;
//					$inAttr["class"]= " hidden ";
//					$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_ITEM_PINFO","",$grAttr,$laAttr,$inAttr,"  ");
//					echo $xtmp->currHtml;*/
//					
//					// $xtmp = new appForm("VIN_ITEMS");
//					$grAttr = $xtmp->grAttrib;
//					$grAttr["class"] .= "col-sm-3";
//					$laAttr = $xtmp->laAttrib;
//					$laAttr["ab-label"] ="VIN_LSHE_LOTID";
//					$laAttr["class"] .= " bg-primary ";
//					$laAttr["style"] .= "padding-left:10px;";
//					$inAttr = $xtmp->inAttrib;
//					$inAttr["class"]= " hidden ";
//					$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_LSHE_LOTID","",$grAttr,$laAttr,$inAttr,"  ");
//					echo $xtmp->currHtml;
//					
//					$grAttr = $xtmp->grAttrib;
//					$grAttr["class"] .= "col-sm-3";
//					$laAttr = $xtmp->laAttrib;
//					$laAttr["ab-label"] ="VIN_SSIT_SPESQ";
//					$laAttr["class"] .= " bg-primary ";
//					$laAttr["style"] .= "padding-left:10px;";
//					$inAttr = $xtmp->inAttrib;
//					$inAttr["class"]= " hidden ";
//					$xtmp->setFieldWrapper("view01","0.0","vin_item","VIN_SSIT_SPESQ","",$grAttr,$laAttr,$inAttr,"  ");
//					echo $xtmp->currHtml;
				
				
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
	  			
	  			<td>
	  			<input data-dismiss="modal" type="checkbox" ng-click='ABfeedTarget("vin_item","idVIN_ITEM","ab-search-target",x.idVIN_ITEM);' />			
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
							
							<a target="{{opts.Process!='VIN_ITEMS'?'_blank':''}}" href="#VIN_ITEMS/VIN_ITEMCT/idVIN_ITEM:{{x.idVIN_ITEM}},updType:UPDATE,Session:VIN_ITEMCT,Process:VIN_ITEMS" >
							
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
<div class="col-sm-2 ab-spaceless small">


	<div class="small" ng-if="x.VIN_ITYP_ITYPE.length>0" >
		<label><em class="text-primary">Type:</em>&nbsp;{{x.VIN_ITYP_ITYPE}}&nbsp;<small>{{x.VIN_ITYP_DESCR}}</small></label>
	</div>
		
	<div class="small" ng-if="x.VIN_GROU_ITGRP.length>0" >
		<label><em class="text-primary">Group:</em>&nbsp;{{x.VIN_GROU_ITGRP}}&nbsp;<small>{{x.VIN_GROU_DESCR}}</small></label>
	</div>

<?php



echo '</div><div class="col-sm-2 ab-spaceless small">';

// AC 20160302
$hardCode = <<<EOC
<table style="width:100%;text-align:right;font-weight:800;" class="small">
<tr class="hidden{{x.VIN_ITEM_LOTCT!=1?'':'xx'}}">


<td >

	
<ul class="nav nav-tabs text-muted {{x.VIN_ITEM_LOTCT!=1?'hidden':''}} {{!x.rowSet[0].idVIN_LSHE?'hidden':''}}">

<li class"dropdown  "   >
	
	<span class="btn-xs ab-pointer dropdown-toggle" data-toggle="dropdown" title="Count{{x.rowSet.length}}" >
		<span class="small">
			Active Lots
		</span>
		<span class="caret" title=""></span>
	</span>
	
	<ul class="dropdown-menu" title="" ng-init="active=0">
		<li title="" ng-repeat="lot in x.rowSet |AB_noDoubles:'idVIN_LSHE' " ng-if="lot.idVIN_LSHE>0&&lot.VIN_LSHE_SOLDO==0" class="{{!lot.idVIN_LSHE?'hidden':''}} {{lot.VIN_LSHE_SOLDO!=0?'hidden':''}} ">
			
			<table style="width:100%;">
			<tr>
			<td>&nbsp;
			<span> {{ lot.VIN_LSHE_LOTID}} </span>
			</td>
			<td style="text-align:right;">
			<a target="{{opts.Process!='VIN_ITEMS'?'_blank':''}}" href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:{{lot.idVIN_LSHE}},idVIN_ITEM:{{idVIN_ITEM}},updType:UPDATE,Session:VIN_LOTCT,Process:VIN_ITEMS" >
			<span class="text-primary small">
			Edit
			<span class="glyphicon glyphicon-pencil" ></span>
			</span>
			</a>
			</td>
			<td>
			&nbsp;
			</td>
			</tr>
			</table>

		</li>
	</ul>
</li>
</ul>
</td>
</tr>
<tr>
<td>
<ul class="nav nav-tabs text-muted {{x.VIN_ITEM_LOTCT!=1?'hidden':''}} {{!x.rowSet[0].idVIN_LSHE?'hidden':''}}">
<li class"dropdown">
	<span class="btn-xs ab-pointer dropdown-toggle" data-toggle="dropdown" title="">
		<span  class="small" >Closed lots</span>
		<span class="caret" title=""></span>
	</span>
	
	<ul class="dropdown-menu"  title="">
		<li title="" ng-repeat="lot in x.rowSet |AB_noDoubles:'idVIN_LSHE' " class="{{!lot.idVIN_LSHE?'hidden':''}} {{lot.VIN_LSHE_SOLDO!=0?'':'hidden'}}">
			<table style="width:100%;">
			<tr>
			<td>&nbsp;
			<span> {{ lot.VIN_LSHE_LOTID}} </span>
			</td>
			<td style="text-align:right;">
			<a target="{{opts.Process!='VIN_ITEMS'?'_blank':''}}"  href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:{{lot.idVIN_LSHE}},idVIN_ITEM:{{idVIN_ITEM}},updType:UPDATE,Session:VIN_LOTCT,Process:VIN_ITEMS" >
			<span class="text-primary small">
			Edit
			<span class="glyphicon glyphicon-pencil" ></span>
			</span>
			</a>
			</td>
			<td>
			&nbsp;
			</td>
			</tr>
			</table>
		</li>
	</ul>
</li>
</ul>
</td>
<td class"">
<a target="{{opts.Process!='VIN_ITEMS'?'_blank':''}}"  href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:0,idVIN_ITEM:{{ x.idVIN_ITEM }},updType:CREATE,Session:VIN_LOTCT,Process:VIN_ITEMS" >
<span>New </span>
<span class="glyphicon glyphicon-pencil" ></span>
</a>
</td>
</tr>
</table>
EOC;


echo $hardCode;

// VIN_ITEM_UPCID
//	$grAttr = $xtmp->grAttrib;
//	$laAttr = $xtmp->laAttrib;
//	$inAttr = $xtmp->inAttrib;
//	$xtmp->setFieldWrapper("view01","0.0","vin_item","x.VIN_ITEM_UPCID","",$grAttr,$laAttr,$inAttr,"");
//	echo $xtmp->currHtml;

// echo '</div><div class="col-sm-3 ab-spaceless">';
// AC 20160305
$hardCode = <<<EOC
<table style="width:100%;text-align:right;font-weight:800;" class="small">
<tr class="hidden{{x.VIN_ITEM_LOTCT!=1?'':'xx'}}">

<td>
<ul class="nav nav-tabs text-muted {{x.VIN_ITEM_LOTCT!=1?'hidden':''}} {{!x.rowSet[0].idVIN_SSIT?'hidden':''}}">
	<li class"dropdown">
	  <span class="btn-xs ab-pointer dropdown-toggle" data-toggle="dropdown" title="" >
		<span  class="small">
			Spec. Sheets 
		</span>
		<span class="caret" title=""></span>
	</span>
	<ul class="dropdown-menu" title="">
	  <li title="" ng-repeat="spec in x.rowSet |AB_noDoubles:'idVIN_SSMA' " class="{{!spec.idVIN_SSMA?'hidden':''}}">
	  
	  
			<table style="width:100%;" class="small">
			<tr>
			<td>&nbsp;
			<span> {{spec.VIN_SSMA_SPEID}} </span>
			</td>
			<td style="text-align:right;">
			<a target="{{opts.Process!='VIN_ITEMS'?'_blank':''}}" href="#/VIN_ITEMS/VIN_SSMACT/idVIN_SSMA:{{spec.idVIN_SSMA}},idVIN_ITEM:{{x.idVIN_ITEM}},updType:UPDATE,Session:VIN_SSMACT,Process:VIN_ITEMS" >
			<span class="text-primary small">
			Edit
			<span class="glyphicon glyphicon-pencil" ></span>
			</span>
			</a>
			</td>
			<td>
			&nbsp;
			</td>
			</tr>
			</table>	  
	  
	  
	  
	  
	  

		</li>
	</ul>
	</li>
</ul>
</td>
<td class"">
<a target="{{opts.Process!='VIN_ITEMS'?'_blank':''}}" href="http://www.sasadept.net:3080/ABerp/wrapSession.php#/VIN_ITEMS/VIN_SSMACT/idVIN_SSMA:0,idVIN_ITEM:{{ x.idVIN_ITEM }},updType:CREATE,Session:VIN_SSMACT,Process:VIN_ITEMS" >
<span>New </span>
<span class="glyphicon glyphicon-pencil" ></span>
</a>
</td>
</tr>
</table>
EOC;
echo $hardCode;
echo '</div></div>';
?>
						<!--<div class="col-sm-2">
							<label>
								<span>
								{{x.VIN_ITEM_ITMID}}
								</span>
							</label>						
						</div>
						<div class="col-sm-4">
							<label>
								 <span ng-repeat="y in vin_ityp" class="{{y.idVIN_ITYP==x.VIN_ITEM_SEAR1?'':'hidden'}}">
									{{y.VIN_ITYP_DESCR}}
									</span>
							</label>						
						</div>
						<div class="col-sm-5">
							<label>
								<span>
								{{x.VIN_ITEM_DESC1}}
								</span>
							</label>						
						</div>-->
						
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




<!-- End Modal Insert -->

	      </div>
	      <div class="modal-footer" >
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	
	  </div>
	</div>


