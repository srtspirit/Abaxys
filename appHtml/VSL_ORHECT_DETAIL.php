<div class="{{opts.updType!='CREATE'?'':'hidden'}}">
	<input ng-model="currOrdeId" class="hidden" />
	<input ng-model="currOrdeLine" class="hidden" />
	
	<div class=" row " ab-formlist="order_list"   ab-rowset="{{$index}}"   ab-new="{{ x.idVSL_ORDE < 1?'1':'0' }}"
		ORDE-repeat="1"
		role="presentation" 
		ng-repeat="x in vsl_orhe | AB_noDoubles:'idVSL_ORDE' " 
		ng-init="x.VSL_ORDE_ORDQT=0" 
		ng-if="x.idVSL_ORDE*1 != 0"
		ceelass="{{x.VSL_ORDE_ORLIN > 0?'':'hidden'}}"
	 >
		<form   ab-view="vsl_orde" ab-main="vsl_orde" ab-context="0" ng-init="x.showLots=1">



		<div  class="AC col-lg-1  {{x.trash==1?'text-danger':''}} "  >
		
			<table style="width:100%;" >
			<tr>
			<td class="text-left" style="width:50%">
			<span class="small  {{x.trash==1?'text-danger':'text-primary'}} {{vslFormPg!=2?'':'hidden'}}" style="white-space:nowrap;" >
				<input type="checkbox" value="0" onclick="$(this).val(1-$(this).val());" ng-model="x.trash" class="text-primary" />
				<span  class="glyphicon glyphicon-trash small" ></span>
				
			</span>
			</td>
			
	<td  class="text-right" style="width:50%">
	<div>
	<table>
		<tr>
			<td style="width:10px;"></td>
			<td></td>
		</tr>

		<tr>
			<td colspan=100>
				<input type="hidden" class="hidden" value=""  />					
				<input class="hidden" ng-model="x.VSL_ORDE_CFCAT" />
				<ul class="nav  ab-spaceless " role="tablist"    >
				<li class="dropdown ab-spaceless"  >
					<span data-toggle="dropdown" class="text-primary btn-link ab-border ab-strong" style="white-space:nowrap;padding:0px;" >
						<input ng-if="x.VSL_ORDE_CFCAT=='0'" type="text" size=5 class="small ab-pointer ab-borderless" placeholder="No Certs" />
						<input ng-if="x.VSL_ORDE_CFCAT=='1'" type="text" size=5 class="small ab-pointer ab-borderless" value="C-C Cert" />
						<input ng-if="x.VSL_ORDE_CFCAT=='2'" type="text" size=5 class="small ab-pointer ab-borderless" value="C-A Cert" />
						<input ng-if="x.VSL_ORDE_CFCAT=='3'" type="text" size=5 class="small ab-pointer ab-borderless" value="Both Certs"/>
						<span class="caret" ></span>
					</span>
					<ul class="dropdown-menu ab-spaceless"  role="menu"  >
						<li class=""  >
						<a class="small"  ng-click="x.VSL_ORDE_CFCAT='0';" >
						<span ab-label="STD_NONE" >None</span>
						</a>
						</li>
						<li class=""  >
						<a class="small"  ng-click="x.VSL_ORDE_CFCAT='1';" >
						<span ab-label="VIN_ITEM_CFCAT_1" >C of C</span>
						</a>
						</li>
						<li class=""  >
						<a class="small"  ng-click="x.VSL_ORDE_CFCAT='2';" >
						<span ab-label="VIN_ITEM_CFCAT_2" >C of A</span>
						</a>
						</li>
						<li class=""  >
						<a class="small"  ng-click="x.VSL_ORDE_CFCAT='3';" >
						<span ab-label="VIN_ITEM_CFCAT_3" >Both</span>
						</a>
						</li>

					</ul>
				</li>
				</ul>
			</td>
		</tr>


	</table>		

	</div>
	
	</td>
			
	</tr>
			<tr>
			<td></td>
			
			
			<td class="text-right">

		 <div title="Select Specs "  ng-if="x.VIN_ITEM_LOTCT > 0">
		 
		 	<div  class=" ab-spaceless text-center" ng-click="ACVarDivToggle('SSMA'+x.idVSL_ORDE);" >
					
				      <span class=" ab-pointer text-primary ab-spaceless" >
				      	
				        <input type="text"  ng-if="x.VSL_ORDE_LSPEC.split(',').length -1>0" class=" ab-pointer text-primary ab-borderless   small"  size=5 value=" {{x.VSL_ORDE_LSPEC.split(',').length -1}} spec(s)" />
				        <input type="text"  ng-if="x.VSL_ORDE_LSPEC.split(',').length -1<1" class=" ab-pointer text-primary ab-borderless   small"  size=5 placeholder="No specs" />
				        <span class="caret" ></span>
				      </span>			
				
				<input class="hidden" ng-model="x.specCurrent"  />
				<span ng-init="x.specCurrent=x.VSL_ORDE_LLINK" ></span>
			</div>			      
			

			   
			
			<div id="fltSSMA{{x.idVSL_ORDE}}" class="ADdropdown" >
				<div class="ADdropdown-content" >
	
					<div>
					
						<table style="width:95%;margin-left:10px;padding:3px;" class="table-striped  ab-spaceless ">
						 	<tr>
						 		<td colspan=3 class="text-center" >
						 			<strong>Specs. to provide with delivery</strong>
						 			<input class="hidden" ng-model="x.VSL_ORDE_LSPEC" />
						 		</td>
						 		<td class="text-center"  >
						 			<div class=" bg-primary ab-pointer ab-spaceless text-center"  ng-click="ACVarDivHide();" >&nbsp;X&nbsp;</div>
						 		</td>
						 	</tr>
						 </table>
					</div>
					<div class="mygrid-wrapper-div " style="max-height:250px;" >
					
					
						<table style="width:100%;margin-left:10px;padding:3px;" class="table-striped  ab-spaceless bg-success " role="tablist" 
							ng-repeat="sma in rawResult.vin_item_ssma | AB_noDoubles:'idVIN_ITEM' " 
							neg-repeat="sma in vin_item_ssma | AB_noDoubles:'idVIN_ITEM' " 
							ng-if="sma.idVIN_ITEM==x.VSL_ORDE_ITMID" 
						 >
							<tr class=" ab-border text-primary" >
								<td></td>
								<td style="width:40%" class="text-center" ><strong>Spec Id.</strong></td>
								<td style="width:45%" class="text-center" ><strong>Description</strong></td>
								<td style="width:12%" class="text-center" ><strong>Life</strong></td>
								<td style="width:3%" class="text-center" >&nbsp;</td>
							</tr>
			
								
						<tr class="" 
							ng-repeat="smaRows in rawResult.vin_item_ssma | AB_noDoubles:'idVIN_SSMA'  "
							neg-repeat="smaRows in sma.rowSet | AB_noDoubles:'idVIN_SSMA'  "
							ng-if="smaRows.idVIN_ITEM==x.VSL_ORDE_ITMID " 
						 >		
						 		<td></td>
								<td  class="text-left ab-pointer" style="white-space:nowrap;"
								ng-click="
								x.VSL_ORDE_LSPEC=toggleSpecList(smaRows.idVIN_SSMA,x.VSL_ORDE_LSPEC,x);x.VSL_ORDE_LLINK=getSpecColorSet(x);
								" >
									<input ng-if="(','+x.VSL_ORDE_LSPEC).indexOf(','+smaRows.idVIN_SSMA+',')>-1"  checked type="checkbox" />
									<input ng-if="(','+x.VSL_ORDE_LSPEC).indexOf(','+smaRows.idVIN_SSMA+',')==-1"  type="checkbox" />
									<label>
									&nbsp;
							        	{{smaRows.VIN_SSMA_SPEID}}
		
							        	</label>
							        </td>
							        <td class="text-left" style="white-space:nowrap;">
							        	<span ng-if="smaRows.VIN_SSMA_DESCR" >
							        		{{smaRows.VIN_SSMA_DESCR}}
							        		
							        	</span>
							        </td>
							        <td class="text-left" style="white-space:nowrap;">	
									<label class="" >
									{{ (smaRows.VIN_SSMA_SHLIF/30).toFixed(1) }}
									</label>
								</td>	
					        </tr>

						</table>
					</div>
					<div>
					
						<table style="width:95%;margin-left:10px;padding:3px;" class="table-striped  ab-spaceless ">

					        <tr>
					        	<td style="width:100%;" >
					        		<div class="text-center bg-primary ab-pointer ab-spaceless " ng-click="ACVarDivHide();" >close</div>
					        	</td>
					        </tr>
						</table>
					</div>	
				</div>	

  			</div>
  		
 
  		
		</div>
		
			</td>
<!-- -->

<tr>
			<td colspan=2 class="text-left">
			
			
			<span class="ab-pointer text-primary small {{x.recCount > 0?'':'hidden'}}"  title="{{x.recCount}} order(s) pending"
				ng-if="x.recCount > 0"
				idlink="{{x.idVSL_ORDE}}"  
				onclick="$('#invQ'+$(this).attr('idlink')).toggleClass('hidden');"
			>
				
				<small>
				<span class=" glyphicon glyphicon-th-list ab-spaceless" ></span>
				{{x.recCount}}&nbsp;order(s)
				</small>
				
				
			</span>
			<span class="small {{x.recCount > 0?'hidden':''}}" >
				<strong>No orders </strong>
			</span>

			<input class="hidden" ng-model="idVSL_ORHE" />
			<input class="hidden" ab-btrigger="vsl_orhe"  ng-model="x.idVSL_ORDE" /> 
			<input class="hidden" ng-model="x.VSL_ORDE_LSPEC" />
			<input class="hidden" ng-model="x.VSL_ORDE_ORNUM" /> 
			<input class="hidden" ng-model="x.VSL_ORDE_WARID" /> 
			<input class="hidden" ng-model="x.VSL_ORDE_LOCID" /> 
			<input class="hidden" ng-model="x.VSL_ORDE_FACTO" /> 
			<input class="hidden" ng-model="x.VSL_ORDE_QTUOM" ng-bind="x.VSL_ORDE_QTUOM=x.VSL_ORDE_SAUOM" /> 
			</td>
		<tr>


<!-- -->			
			</tr>
			</table>
		</div>

<?php 

$xtmp = new appForm("VSL_ORDERS");
$xtmp->laAttrib["class"] .= " hidden "; 
$xtmp->laAttrib["class"] .= " small ";
$xtmp->grAttrib["class"] = "ab-spaceless";
$xtmp->grAttrib["style"] = "";
//VSL_ORDE_ORLIN
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "STD_ORLIN_SH";


$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "3";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ORLIN","",$grAttr,$laAttr,$inAttr,"");



echo '<div class="AC col-lg-1 text-right " ><strong>';
echo $xtmp->currHtml;

$hcode =<<<EOC

<div type="button" title="Search customer Items"  class="btn-link ab-spaceless ab-pointer small" data-toggle="modal" point="{{x.idVSL_ORDE}}" pointline="{{x.VSL_ORDE_ORLIN}}" 
onmouseover="deflectVal($(this).attr('point'),'currOrdeId');deflectVal($(this).attr('pointline'),'currOrdeLine');" 
data-target="#orheVin_cust"> Cust Items</div>

EOC;

echo $hcode;

echo '<div class="small hidden text-primary" ng-if="x.VIN_ITEM_LOTCT > 0">';
echo 'Spec.:<input class="hidden" ng-model="search.idVIN_ITEM" ng-init="search.idVIN_ITEM=x.VSL_ORDE_ITMID" />	';
echo '</div></strong></div>';


echo '<div class="AC col-lg-2 ab-spaceless" >';
echo '<div  class="AC ab-spaceless" >';


$itemDsp = <<<EOH

<table style="width:100%;" >
<tr>
<td>
<input class="hidden" id="VIN_ITEMsearch{{x.VSL_ORDE_ORLIN}}" ng-if="x.idVSL_ORDE < 1"
ng-click="VIN_ITEMsearch(x,abSessionResponse);$('#inveRefr').click();"

ng-click="

x.VIN_ITEM_ITMID = abSessionResponse.VIN_ITEM_ITMID;
x.VSL_ORDE_ITMID = abSessionResponse.idVIN_ITEM;
x.VSL_ORDE_DESCR = abSessionResponse.VIN_ITEM_DESC1;
x.VSL_ORDE_ITEXT = abSessionResponse.VIN_ITEM_DESC2 + ' ' + abSessionResponse.VIN_ITEM_DESC3;
x.VSL_ORDE_OUNET = abSessionResponse.VIN_ITEM_LISTP;
x.VSL_ORDE_SAUOM = abSessionResponse.VIN_ITEM_UNITM;
x.VSL_ORDE_QTUOM = abSessionResponse.VIN_ITEM_UNITM;
x.VSL_ORDE_LISTP = abSessionResponse.VIN_ITEM_LISTP;
x.VSL_ORDE_UNSET = abSessionResponse.VIN_ITEM_UNSET;


x.VSL_ORDE_LOTCT = abSessionResponse.VIN_ITEM_LOTCT;
x.VSL_ORDE_OLTYP = (abSessionResponse.VIN_ITEM_INVIT>0?'STD':'EXP');
x.VIN_ITEM_INVIT = abSessionResponse.VIN_ITEM_INVIT;
VIN_INVE_ITMID = x.VIN_ITEM_ITMID;
x.VSL_ORDE_WARID = ''; 

$('#inveRefr').click();

" />

<input class="hidden" id="VIN_ITEMqlist{{x.VSL_ORDE_ORLIN}}" ng-if="x.idVSL_ORDE < 1"


ng-click="

x.VIN_ITEM_ITMID = qlist_VIN_ITEM_ITMID;
x.VSL_ORDE_ITMID = qlist_idVIN_ITEM;
x.VSL_ORDE_DESCR = qlist_VIN_ITEM_DESC1;
x.VSL_ORDE_ITEXT = qlist_VIN_ITEM_DESC2 + ' ' +  qlist_VIN_ITEM_DESC3;
x.VSL_ORDE_OLTYP = qlist_VSL_ORDE_OLTYP;
x.VSL_ORDE_OUNET = qlist_VIN_ITEM_LISTP;
x.VSL_ORDE_SAUOM = qlist_VIN_ITEM_UNITM;
x.VSL_ORDE_QTUOM = qlist_VIN_ITEM_UNITM;
x.VSL_ORDE_LISTP = qlist_VIN_ITEM_LISTP;
x.VSL_ORDE_UNSET = qlist_VIN_ITEM_UNSET;
x.VSL_ORDE_LOTCT = qlist_VIN_ITEM_LOTCT;
x.VSL_ORDE_OLTYP = qlist_VSL_ORDE_OLTYP;
x.VIN_ITEM_INVIT = qlist_VIN_ITEM_INVIT;
x.VSL_ORDE_SUPID = checkItemSupplier(qlist_VSL_ORDE_SUPID,x.VSL_ORDE_SUPID,qlist_idVIN_ITEM);
x.VSL_ORDE_WARID = ''; 



VIN_INVE_ITMID = x.VIN_ITEM_ITMID;

$('#inveRefr').click();

" />


  <ul class="hidden nav-pills ab-spaceless" role="tablist">
    <li class="dropdown ab-spaceless">
      <a class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;padding:0px;">
	<span class="glyphicon glyphicon-search"></span>
      </a>
      <ul class="dropdown-menu ab-spaceless" role="menu">
        <li class=" ab-spaceless">
		<a title="Search customer Items" class="ab-pointer ab-spaceless" vin_items="" id="orlinSearch{{x.VSL_ORDE_ORLIN}}"
		ng-click="ABsearchTbl='vin_item';ABsessionLink('','#VIN_ITEMsearch'+ x.VSL_ORDE_ORLIN,'vin_item');" 
		neg-click="ABsessionLink('#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item,SourceProcess:VSL_ORDERS','#VIN_ITEMsearch'+ x.VSL_ORDE_ORLIN);" 
		>
		
		All Items
		</a>
        </li>
        <li class=" ab-spaceless">
		<a class="ab-pointer ab-spaceless" >
			<span type="button" class="btn-link" 
			data-toggle="modal" point="{{x.idVSL_ORDE}}" pointline="{{x.VSL_ORDE_ORLIN}}" 
			onmouseover="deflectVal($(this).attr('point'),'currOrdeId');deflectVal($(this).attr('pointline'),'currOrdeLine');" 
			data-target="#orheVin_cust">Cust. Items</span>		
		</a>
        </li>
      </ul>
    
    </li>
    <li class=" ab-spaceless">
    	{{ x.VIN_ITEM_ITMID }}
    </li>
  </ul>


</td>
<td>



<span class="  small  " >



	<a title="Search all Items"  class="ab-pointer  ab-spaceless" vin_items="" id="orlinSearch{{x.VSL_ORDE_ORLIN}}"
	ng-click="ABsearchTbl='vin_item';ABsessionLink('','#VIN_ITEMsearch'+ x.VSL_ORDE_ORLIN,'vin_item');" 
	neg-click="ABsessionLink('#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item,SourceProcess:VSL_ORDERS','#VIN_ITEMsearch'+ x.VSL_ORDE_ORLIN);" 
	>
	
		<span class="glyphicon glyphicon-search" ></span>
	</a>
	
	<strong>&nbsp;{{ x.VIN_ITEM_ITMID }}</strong>

</span>

</td>

</tr>
</table>
	
EOH;

//	$laAttr["ab-label"] = "STD_DESCR";
//	$laAttr["ab-label"] = "VSL_ORHE_ODATE";
//	$laAttr["ab-label"] = "VSL_ORHE_DDATE_10";
//	$laAttr["ab-label"] = "STD_QUANTITY_SHORT";
//	$laAttr["ab-label"] = "STD_PRICE";
//	$laAttr["ab-label"] = "STD_UOM_SHORT";

// VSL_ORDE_ITMID


$grAttr = $xtmp->grAttrib;
$grAttr["class"] = "hidden";
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "10";
$inAttr["class"] = "hidden";
$laAttr["ab-label"] = "VIN_ITEM_ITMID";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ITMID","",$grAttr,$laAttr,$inAttr,'');





$hardCode=<<<EOC

<table  style='width:100%;' class="ab-spaceless" ><tr><td><span> $xtmp->currHtml</span>

<span >{$itemDsp}</span></td></tr></table>

EOC;

echo $hardCode;

$hardCode=<<<EOC

		 <div title="Select Specs " class="small "  ng-if="x.VIN_ITEM_LOTCT > 0">
		 
		 	<div  ng-click="ACVarDivToggle('SSMA'+x.idVSL_ORDE);" >
				<strong>	
				      <span readonly class="ab-pointer small" 
				        <span>{{x.VSL_ORDE_LSPEC.split(',').length -1}}  Selected</span>
				      </span>			
				</strong>
				<input class="hidden" ng-model="x.specCurrent"  />
				<span ng-init="x.specCurrent=x.VSL_ORDE_LLINK" ></span>
			</div>			      
			

			   
			
			  <div id="fltSSMA{{x.idVSL_ORDE}}" class="ADdropdown" >
				  <div class="mygrid-wrapper-div   ADdropdown-content" style="max-height:200px;" >
	
					<table style="width:100%;margin-left:10px;padding:3px;" class="table-striped  ab-spaceless bg-success " role="tablist" 
						ng-repeat="sma in vin_item_ssma | AB_noDoubles:'idVIN_ITEM' " 
						ng-if="sma.idVIN_ITEM==x.VSL_ORDE_ITMID" 
					 >
					 	<tr>
					 		<td colspan=3 class="text-center" >
					 			<strong>Specs. to provide with delivery</strong>
					 		</td>
					 		<td class="text-center"  >
					 			<div class=" bg-primary ab-pointer ab-spaceless text-center"  ng-click="ACVarDivHide();" >X&nbsp;</div>
					 		</td>
					 	</tr>
						<tr class=" ab-border text-primary" >
							<td></td>
							<td style="width:45%" class="text-center" ><strong>Spec Id.</strong></td>
							<td style="width:45%" class="text-center" ><strong>Description</strong></td>
							<td style="width:10%" class="text-center" ><strong>Life</strong></td>
						</tr>
		
							
					<tr class="" 
						ng-repeat="smaRows in sma.rowSet | AB_noDoubles:'idVIN_SSMA'  "
						
					 >		
					 		<td></td>
							<td  class="text-left ab-pointer" 
							ng-click="
							x.VSL_ORDE_LSPEC=toggleSpecList(smaRows.idVIN_SSMA,x.VSL_ORDE_LSPEC,x);x.VSL_ORDE_LLINK=getSpecColorSet(x);
							" >
								<input ng-if="(','+x.VSL_ORDE_LSPEC).indexOf(','+smaRows.idVIN_SSMA+',')>-1"  checked type="checkbox" />
								<input ng-if="(','+x.VSL_ORDE_LSPEC).indexOf(','+smaRows.idVIN_SSMA+',')==-1"  type="checkbox" />
								<label>
								&nbsp;
						        	{{smaRows.VIN_SSMA_SPEID}}
	
						        	</label>
						        </td>
						        <td class="text-left">
						        	<span ng-if="smaRows.VIN_SSMA_DESCR" >
						        		{{smaRows.VIN_SSMA_DESCR}}
						        		
						        	</span>
						        </td>
						        <td class="text-left" >	
								<label class="" >
								{{ (smaRows.VIN_SSMA_SHLIF/30).toFixed(1) }}
								</label>
							</td>	
				        </tr>
				        <tr>
				        	<td colspan=10>
				        		<div class="text-center bg-primary ab-pointer ab-spaceless " ng-click="ACVarDivHide();" >close</div>
				        	</td>
				        </tr>
					</table>
			</div>	

  		</div>
  		
 
  		
</div>



EOC;

// echo $hardCode;

// echo $xtmp->currHtml;
echo '</div>';


echo '<div class="AC  " >';
// VSL_ORDE_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "22";
$laAttr["ab-label"] = "STD_DESCR";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_DESCR","",$grAttr,$laAttr,$inAttr,"");


$hTextCode = <<<EOC


	<tr>
		<td class=" ab-spaceless text-top" >	
			<div ng-click="ACVarDivToggle(x.idVSL_ORDE);" class="ab-pointer" >
	 			<input readonly class="ab-pointer ab-borderless small" size=25 value="{{x.VSL_ORDE_ITEXT}}" />
				<b>
				<span class="caret text-primary"></span>
				<span class="{{x.VSL_ORDE_OTEXT.trim().length>0?'text-danger':''}} small" ng-click="" >...</span>
				</b>
				<input readonly class="ab-borderless small hidden" size=5 value="{{x.VSL_ORDE_OTEXT}}" />
			</div>
			<div id="flt{{x.idVSL_ORDE}}" class="ADdropdown small ab-spaceless"  >
				<div class="ADdropdown-content ab-spaceless "  >
					<div class="well ab-spaceless">
						<table style="width:100%;">
						<tr>
						<td style="width:90%;">
							&nbsp;<span class="text-primary" ab-label="VBA_LABD_LTEXT" > </span>
						</td>
						<td  style="width:10%;text-align:right;" >
							<div class="text-center bg-primary ab-pointer ab-spaceless "  ng-click="ACVarDivHide();" >X</div>	
						</td>
						<tr>
						<td colspan=2 >
							<textarea  style="overflow:hidden;font-size:9pt;width:100%;" rows="5" cols="18"  ng-model="x.VSL_ORDE_ITEXT"  > 
							</textarea>
						</td>
						</tr>
						</table>
					</div>
					<div class="well ab-spaceless" >&nbsp;
						<span class="text-primary" ab-label="STD_INSTRUCTIONS" class="small" ></span><br>
						<textarea  style="overflow:hidden;font-size:9pt;width:100%;" rows="5" cols="18"  ng-model="x.VSL_ORDE_OTEXT"  >
						</textarea>
					</div>
					<div class="text-center bg-primary ab-pointer ab-spaceless " ng-click="ACVarDivHide();" >close</div>

				</div>
			</div>
		</td>
	</tr>

EOC;



$hardCode = <<<EOC
	<div>
	<table style="width:100%" class="ab-spaceless" >
		<tr>
			<td colspan=3 class="text-left">
			<strong>
				$xtmp->currHtml
			</strong>
			</td>

		</tr>		
		{$hTextCode}
	</table>
	</div>
EOC;
		
echo $hardCode;


?>

	
	<div ng-repeat="invQ in vin_inve | AB_noDoubles:'idVIN_INVE'  " ng-if="vin_inve.length>0 && invQ.VIN_INVE_ITMID == x.VSL_ORDE_ITMID && invQ.VIN_ITEM_INVIT=='1'" >

		<span class="small">
		<label>
			<table style="width:100%;" >
			<tr>
				<td class="small">
					<span class="text-primary"><em>On&nbsp;hand:</em></span>
				</td>
				<td style="min-width:35px;" >
		
				
				&nbsp;{{ invQ.VIN_INVE_BOHQT.length>0?invQ.VIN_INVE_BOHQT:'0' }}&nbsp;
		
				</td>
				<td class="small">
					<span class="text-primary"><em>Allocated:</em></span>
				</td>
				<td>
					&nbsp;{{invQ.VIN_INVE_ALOQT>0?invQ.VIN_INVE_ALOQT:'0'}}&nbsp;
				</td>
				<td class="small">
					&nbsp;&nbsp;<span class="text-primary"><em>On&nbsp;PO:</em></span>
				</td>
				<td >
					&nbsp;{{invQ.VIN_INVE_PURQT>0?invQ.VIN_INVE_PURQT:'0'}}&nbsp;
				</td>

			</tr>
		
			</table>
		
		</label>
		</span>	
	</div>

<div ng-if="x.VIN_ITEM_INVIT!='1'" >
<table style="width:100%;" >
<tr>
<td style="width:30%;" class="ab-strong">
	
	<span class="{{x.VSL_ORDE_OLTYP!='STD'?'':'hidden'}}" >
		<input class="hidden" ng-model="x.VSL_ORDE_OLTYP" />
		<input class="hidden" ng-model="x.VIN_ITEM_INVIT" />
		<input class="hidden" ng-model="x.VSL_ORDE_SUPID" />
		
		<ul class="nav  ab-spaceless " role="tablist"    >
			<li class="dropdown ab-spaceless"  >
				<span data-toggle="dropdown" class="text-primary btn-link" style="white-space:nowrap;padding:0px;" >
					<span ng-if="x.VSL_ORDE_OLTYP=='EXP'" class="small ab-pointer ab-borderless" >Invoice </span>
					<span ng-if="x.VSL_ORDE_OLTYP=='BOR'" class="small ab-pointer ab-borderless" >No charge</span>
					<span class="caret" ></span>
				</span>
				<ul class="dropdown-menu ab-spaceless" role="menu"  >
					<li class="{{x.VSL_ORDE_OLTYP!='EXP'?'h2idden':''}}"  >
					<a class="small"  ng-click="x.VSL_ORDE_OLTYP='EXP';" >
					<span >Charge</span>
					</a>
					</li>
					<li class="{{x.VSL_ORDE_OLTYP!='BOR'?'hi2dden':''}}"  >
					<a class="small"  ng-click="x.VSL_ORDE_OLTYP='BOR';" >
					<span >No charge</span>
					</a>
					</li>

				</ul>
			</li>
		</ul>
	</span>
	


</td>
<td style="width:70%;" class="{{x.VSL_ORDE_OLTYP!='STD'?'':'hidden'}} ab-strong">

		<ul class="nav  ab-spaceless " role="tablist"  ng-init="x.servMess='Select Supplier'"  >
			<li class="dropdown ab-spaceless" >
				<span data-toggle="dropdown" class="text-primary btn-link" style="white-space:nowrap;padding:0px;" neg-click="serviceSupplier(x.VSL_ORDE_ITMID);" >
					<span class="small ab-pointer ab-borderless" >{{x.servMess}}</span>
					<span class="caret" ></span>
				</span>
				<ul class="dropdown-menu ab-spaceless"  role="menu"  >
					<li ng-repeat="supp in vin_supp | AB_noDoubles:'VIN_SUPP_BPART' " ng-if="supp.VIN_SUPP_ITMID == x.VSL_ORDE_ITMID" >
						<a class="small"  ng-click="x.VSL_ORDE_SUPID=supp.VIN_SUPP_BPART;" >
							<span class="{{x.VSL_ORDE_SUPID==supp.VIN_SUPP_BPART?'':'invisible'}} text-primary" >
								<span ng-if="x.VSL_ORDE_SUPID==supp.VIN_SUPP_BPART"><span ng-init="x.servMess=supp.VGB_SUPP_BPNAM"></span></span>
								<span class="glyphicon glyphicon-ok" ></span>
							</span> 
							<span >{{supp.VGB_SUPP_BPNAM}}</span>
						</a>
					</li>
					<li class="{{vin_supp.length==1&&vin_supp[0].idVIN_SUPP==null?'':'hidden'}}"  >
						<a class="small text-primary"  >
						<span >{{vin_supp[0].idVIN_SUPP.length}}No suppliers for item</span>
						</a>
					</li>

				</ul>
			</li>
		</ul>


</td>
</tr>
</table>
</div>	
	
	
</div>
</div>

<?php


// Removed ODATE



echo '<div class="AC col-lg-1 hidden" ><strong>';

// VSL_ORDE_OUNET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
// $laAttr["class"] = "hidden";
$inAttr["size"] = "4";
$laAttr["ab-label"] = "STD_PRICE";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_OUNET","",$grAttr,$laAttr,$inAttr,"");
echo "<table><tr><td>$</td><td>".$xtmp->currHtml."</td></tr></table>";
echo '</strong>';
echo '<strong>';

// VSL_ORDE_SAUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "4";


// VIN_ITEM_LPUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr["ab-label"] = "STD_UOM_SHORT";

	$keepOrg = 0; 
	$repeatIn = "vin_unit";
	$searchIn = "";
	$refName = "x.VSL_ORDE_SAUOM"; // unique
	$refModel = "x.VSL_ORDE_SAUOM"; // unique
	$repeatInRef = "idVIN_UNIT"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_UNIT_UNITM}}","{{ab_rloop.VIN_UNIT_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "VIN_UNIT_UNITM='A ';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);
	
	
$hardCode =<<<EOC

	
	<input class="hidden" size=2 ng-model="x.VSL_ORDE_SAUOM" />
	<ul class="nav  ab-spaceless small" role="tablist"    >
	<li class="dropdown ab-spaceless" 
	ng-repeat="uom in vin_unit" 
	ng-init="x.VSL_ORDE_FACTO = (x.idVSL_ORDE>0?x.VSL_ORDE_FACTO:uom.VIN_UNIT_FACTO)"
	ng-if="uom.idVIN_UNIT==x.VSL_ORDE_SAUOM && uom.idVIN_USET==x.VSL_ORDE_UNSET"  >
	
	
		<span data-toggle="dropdown" class="text-primary btn-link" style="white-space:nowrap;padding:0px;" >
			{{uom.VIN_UNIT_UNITM}}
			<span class="caret" ></span>
		</span>
		<ul class="dropdown-menu ab-spaceless"  role="menu"  >
			<li class="dropdown ab-border ab-spaceless" 
			ng-repeat="uomDe in vin_unit" 
			ng-if="uomDe.idVIN_USET==x.VSL_ORDE_UNSET"  >
			
				<a ng-if="uomDe.idVIN_UNIT!=x.VSL_ORDE_SAUOM"
				class="small"  ng-click="x.VSL_ORDE_SAUOM = uomDe.idVIN_UNIT;x.VSL_ORDE_FACTO=uomDe.VIN_UNIT_FACTO;formChange()" >
					{{uomDe.VIN_UNIT_UNITM}}--{{uomDe.idVIN_USET}}
				</a>
				<a ng-if="uomDe.idVIN_UNIT==x.VSL_ORDE_SAUOM"
				class="small ab-strong"  >
					{{uomDe.VIN_UNIT_UNITM}}--{{uomDe.idVIN_USET}}
				</a>
			</li>

		</ul>
	</li>
	</ul>


EOC;
	
//	$hardCode = '<div class="small" ><input class="hidden" size=2 ng-model="x.VSL_ORDE_SAUOM" /><select class="small" onchange="$(this).parent().find('."'input')".'.val($(this).val());">';
//	$hardCode .= '<option class="small" ng-repeat="uom in vin_unit" value="{{'.'uom.idVIN_UNIT}}" ng-if="uom.idVIN_UNIT==x.VSL_ORDE_SAUOM"  >';
//	$hardCode .= '{{' . 'uom.VIN_UNIT_UNITM}}';
//	$hardCode .= '</option>';
//	$hardCode .= '<option class="small" ng-repeat="uom in vin_unit"  value="{{'.'uom.idVIN_UNIT}}" ng-model="uom.idVIN_UNIT" ng-if="uom.idVIN_UNIT!=x.VSL_ORDE_SAUOM && uom.VIN_UNIT_UNSET==x.VIN_ITEM_UNSET"  >';
//	$hardCode .= '{{' . 'uom.VIN_UNIT_UNITM}}';
//	$hardCode .= '</option>';
//	$hardCode .= '</select></div>';
	
//	x.VIN_ITEM_UNSET
	
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_SAUOM","",$grAttr,$laAttr,$inAttr,$hardCode);



// $xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_SAUOM","",$grAttr,$laAttr,$inAttr,"");






echo $xtmp->currHtml;

$hardCode = <<<EOC

<table class="hid2den" >
	<tr>
		<td class="text-right small">
			<span class="text-primary">Total Qty</span>
			<em>{{x.VSL_ORDE_ORDQT}}</em>
		</td>

		<td class="small text-right hidden">
			<span class="text-primary">$</span>
		</td>
		<td class=" hidden" >
			{{ABGetNumberFn('fmt-curr',x.VSL_ORDE_ORDQT * x.VSL_ORDE_OUNET) }}
		</td>	
	</tr>
	
</table>				

EOC;

echo $hardCode;
				
echo '</strong></div>';

echo '<div class="AC col-lg-2 hidden" ><strong>';
// VSL_ORDE_DDATE



$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "6";
$laAttr["ab-label"] = "VSL_ORHE_DDATE_10";
$hardCode = "<div style='font-size:90%;'>" . $xtmp->setDatePick("x.VSL_ORDE_DDATE"). "</div>";
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_DDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</strong></div>';

echo '<div class="AC col-lg-1 hidden" ><strong>';

// VSL_ORDE_ORDQT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
// $inAttr["readonly"] = '';
$inAttr["class"] .= " text-center text-primary";
// $inAttr["disabled"] = "disabled";
$inAttr["size"] = "4";
$laAttr["ab-label"] = "STD_QUANTITY_SHORT";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_ORDQT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</strong>';


echo '</div>';


// <span style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{x.idVSL_ORHE}}" class="btn-link glyphicon glyphicon-th-list"></span>
// echo '<div exp-list="1" id="exp_{{x.idVSL_ORHE}}" class="collapse {{' . "collaps!=1?'':'in'}}" . '">';


?>
						
	

<div class="hidden ">
<table>
	<tr exp-list="1" id="exp_{{x.idVSL_ORDE}}" class="collapse {{collaps!=1?'':'in'}}" >
		<td colspan=100 class="ab-spaceless" style="padding-top:4px;" >
			<!- ab-label will updated with required label for ng-repeats -->
			<span class="hidden">
				<span ab-label="VGB_CUST_BAORA_SHO" ></span>
				<span ab-label="VIN_ITEM_PICKP" ></span>
				<span ab-label="VIN_ITEM_PACKP" ></span>
				
			
			</span>
		


			<table  class=" small {{x.trash==1?'text-danger':''}}" style="width:100%;vertical-align:top;" >
			<tr>
			<td style="width:15%;" ></td>
			<td style="width:22%;" ></td>
			<td style="width:63%;" ></td>
			
			</tr>

<?php 			
$xtmp = new appForm("VSL_ORHE");
$xtmp->grAttrib["class"] = "ab-spaceless medium";
$xtmp->grAttrib["style"] = "";

echo '<td style="vertical-align:top;" ><table><tr><td>';
// VSL_ORDE_BAORA
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "VGB_CUST_BAORA_SHO";
$grAttr["class"] .= " small ";
$inAttr = $xtmp->inAttrib;
$inAttr["class"] = "hidden";
$xtmp->setFieldWrapper("view01","0.111","vsl_orde","VSL_ORDE_BAORA","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td class="boxwrapper" style="padding-left:10px;vertical-align:top;">';
// VSL_ORDE_BAORA
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " small ";
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$hardCode = $xtmp->setYesNoField("x.VSL_ORDE_BAORA");
$xtmp->setFieldWrapper("view01","0.122","vsl_orde","x.VSL_ORDE_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</td>';

	
echo '</tr><tr>';

echo '<td>';
// VSL_ORDE_PICKP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "VIN_ITEM_PICKP";
$grAttr["class"] .= " small ";
$inAttr = $xtmp->inAttrib;
$inAttr["class"] = "hidden";
$xtmp->setFieldWrapper("view01","0.111","vsl_orde","VIN_ITEM_PICKP","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td class="boxwrapper" style="padding-left:10px;" >';
// VSL_ORDE_PICKP
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " small ";
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$hardCode = $xtmp->setYesNoField("x.VSL_ORDE_PICKP");
$xtmp->setFieldWrapper("view01","0.122","vsl_orde","x.VSL_ORDE_PICKP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</td>';

	
echo '</tr></tr>';

echo '<td>';
// VSL_ORDE_PACKP
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "VIN_ITEM_PACKP";
$grAttr["class"] .= " small ";
$inAttr = $xtmp->inAttrib;
$inAttr["class"] = "hidden";
$xtmp->setFieldWrapper("view01","0.111","vsl_orde","VIN_ITEM_PACKP","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</td>';

echo '<td class="boxwrapper" style="padding-left:10px;">';
// VSL_ORDE_PACKP
$grAttr = $xtmp->grAttrib;
$grAttr["class"] .= " small ";
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";
$hardCode = $xtmp->setYesNoField("x.VSL_ORDE_PACKP");
$xtmp->setFieldWrapper("view01","0.122","vsl_orde","x.VSL_ORDE_PACKP","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '<input class="hidden" ng-model="x.VIN_ITEM_LOTCT" />';
echo '</td></tr></table></td>';
	
echo '<td rowspan="100" style="vertical-align:top;">';
// VSL_ORDE_DTEXT

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";

$focus = ' onfocus="' . "$(this).attr('rows','4');$(this).attr('cols','30');$(this).css('width','');$(this).css('height','');$(this).css('overflow','auto');" . '" ';

$blur = ' onblur="' . "$(this).css('width','140px');$(this).css('height','20px');$(this).css('overflow','hidden');" . '" ';

$hardCode = '<table><tr>';
$hardCode .= '<td style="text-align:right;" ><label class="text-primary" ab-label="STD_TEXT" >Text:</label> &nbsp;&nbsp;<textarea style="overflow:hidden;font-size:9pt;" rows="1" cols="18" ' . $focus . $blur . ' ng-model="x.VSL_ORDE_ITEXT"  > </textarea></td><td>&nbsp;&nbsp;&nbsp;</td>';
$hardCode .= '</tr><tr>';
$hardCode .= '<td style="text-align:right;" ><label class="text-primary small" ab-label="STD_INSTRUCTIONS" >Instruc.</label>:<textarea style="overflow:hidden;font-size:9pt;" rows="1" cols="18" ' .  $focus . $blur  . '" ng-model="x.VSL_ORDE_OTEXT"  > </textarea></td>';
$hardCode .= '</tr></table>';
$xtmp->setFieldWrapper("view01","0.122","vsl_orde","x.VSL_ORDE_BAORA","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
echo '</td></tr></table></td></tr></table>';


$stepCode = <<<EOC

</div>




<div  class="AC col-lg-5" >



	<table  class=" ab-spaceless" style="width:100%;vertical-align:top;">
		<tr class="bg-primary small hidden" >
		
			<td class="ab-spaceless" style="vertical-align:top;padding-left:2px;width:10%;">
										

										
			</td>
			<td style="font-weight:700;width:10%;">
				<span ab-label="VSL_ORST_STPSQxxx">				
					Seq.
				</span>
			</td>
			<td style="font-weight:700;width:20%;" ab-label="VSL_ORST_PDATE">Plan Date</td> 
			<td style="font-weight:700;width:15%;" ab-label="STD_QUANTITY_SHORT">Quantity</td>
			<td style="font-weight:700;width:15%;">
			<span ab-label="VSL_ORST_STEPS">Seq. Steps&nbsp;&nbsp;</span>
			</td>
			
			<td style="font-weight:700;width:30%;" class="text-right  " >&nbsp;

			</td>			
		</tr>
		
		<tr  ab-formlist="orstep_list"  
			ab-new="{{ x.idVSL_ORDE < 1 || idVSL_ORST < 1?'1':'0' }}"
			ordline="{{x.VSL_ORDE_ORLIN}}" 
			ng-repeat="y in vsl_orhe   | AB_noDoubles:'idVSL_ORDE,idVSL_ORST'  "
			 cqwelass="{{x.VSL_ORDE_ORLIN==y.VSL_ORDE_ORLIN?'':'hidden'}}"
			ng-if="x.idVSL_ORDE==y.idVSL_ORDE"
			
		>
		
		
<td colspan=100 class="ab-spaceless {{wid==1?'text-danger':''}} ">

<input class="hidden" ng-model="y.VSL_ORST_ACKID" />
<input class="hidden" ng-model="y.VSL_ORST_AOKID" />
<input class="hidden" ng-model="y.VSL_ORST_SCEID" />
<input class="hidden" ng-model="y.VSL_ORST_PICID" />
<input class="hidden" ng-model="y.VSL_ORST_RELID" />
<input class="hidden" ng-model="y.VSL_ORST_PAKID" />
<input class="hidden" ng-model="y.VSL_ORST_DELID" />
<input class="hidden" ng-model="y.VSL_ORST_WINVO" />
<input class="hidden" ng-model="y.VSL_ORST_ARCID" ng-init="x.VSL_ORDE_ORDQT=(x.VSL_ORDE_ORDQT*1)+(y.VSL_ORST_ORDQT*1)"/>




<div class="ab-spaceless">
<table   class=" ab-spaceless  {{wid==1?'text-danger':''}}" style="width:100%">
<tr>


EOC;

// var debug = "\n--================-----\n" + $("#focusGrid").val();
// $("#focusGrid").val(showProps(dDta.dbUpd.out.RECSET[1],"s")+debug)

$stepCode .= <<<EOC
	<td style="width:10%;" >
	
		<span class="{{vslFormPg!=2?'':'hidden'}}" >
			<input type="checkbox" value="0" onclick="$(this).val(1-$(this).val());" ng-model="y.trash" class="text-primary" />
			<span  class="glyphicon glyphicon-trash small" ></span>
		</span>
		
		<span class="{{vslFormPg==2?'':'hidden'}}" >
			<span class="{{stpSelName!=''?'hidden':''}}">
			....			
			</span>
			<span class="{{stpSelName!=''?'':'hidden'}}">
				<span ng-if="stepRetract!=true" >
					<span class="ab-pointer" 
						ng-if="y.VSL_ORST_STEPS<stpSelName || y.VSL_ORST_STEPS==stpSelName && y.VSL_ORST_STEPS < 'JJ_X' "  
						ng-click="toggleAllocStepSel(y.idVSL_ORST);" 
					>
						<input type="checkbox"	xlinesel="" class="glyph2icon glyphic2on-unchecked" style="font-size:medium;"
							ng-if="(',' + DOC_ORST + ',').indexOf(','+y.idVSL_ORST+',')==-1" />
							
						<input  type="checkbox"	checked xlinesel="" class="glyp2hicon glyph2icon-expand " style="font-size:medium;"
							ng-if="(',' + DOC_ORST + ',').indexOf(','+y.idVSL_ORST+',')>-1" />
					</span>	
				</span>
				<span ng-if="stepRetract==true" >
				
					<span class="ab-pointer" 
						ng-if="y.VSL_ORST_STEPS>stpSelName && stpSelName!='' && y.VSL_ORST_STEPS < 'JJ_X' "  
						ng-click="toggleAllocStepSel(y.idVSL_ORST);" 
					>
						<input type="checkbox" xlinesel="" class="glyph2icon glyphic2on-unchecked" style="font-size:medium;"
							ng-if="(',' + DOC_ORST + ',').indexOf(','+y.idVSL_ORST+',')==-1" />
							
						<input  type="checkbox"	checked xlinesel="" class="glyp2hicon glyph2icon-expand " style="font-size:medium;"
							ng-if="(',' + DOC_ORST + ',').indexOf(','+y.idVSL_ORST+',')>-1" />
					</span>	
				</span>
			</span>
		</span>
	
	</td>	
	
	
EOC;

// VSL_ORST_STPSQ
$stepCode .= '<td style="width:10%;">';

$xtmp->grAttrib['class'] .= " ab-spaceless " ;
		
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["class"] = "hidden";


$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.idVSL_ORST","",$grAttr,$laAttr,$inAttr,"");
$stepCode .= $xtmp->currHtml;

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "2";


$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_STPSQ","",$grAttr,$laAttr,$inAttr,"");
$stepCode .= $xtmp->currHtml;
$stepCode .= '</td>';

// VSL_ORST_PDATE
$stepCode .= '<td style="width:15%;" class="small" ng-init="ABsetDatepickers();" >';
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$hardCode = $xtmp->setDatePick("y.VSL_ORST_PDATE");
$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_PDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
$stepCode .= $xtmp->currHtml;
$stepCode .= '</td>';

// VSL_ORST_ORDQT
$stepCode .= '<td style="width:10%;">';
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr["class"] = "hidden";

$inAttr["size"] = "5";
$inAttr["title"] = "VSL_ORST_ORDQT.{{" . "y.idVSL_ORST" . "}}";
$inAttr["neg-focus"] = "chkOrstQtySet(x.idVSL_ORDE,y.idVSL_ORST,y.VSL_ORST_STEPS);";
$inAttr["ng-blur"] = "y.VSL_ORST_ORDQT=chkOrstQty(x.VSL_ORDE_ORLIN,y.idVSL_ORST,y.VSL_ORST_STEPS);";
$inAttr["id"] = "VSL_ORST_ORDQT{{ y.idVSL_ORST }}";
$inAttr["chkqty"] = "init";

$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_ORDQT","",$grAttr,$laAttr,$inAttr,"");
$stepCode .= $xtmp->currHtml;
$stepCode .= '<input class="hidden" ng-model=" y.VSL_ORST_WARID" /><input class="hidden" ng-model="y.VSL_ORST_STEPS" /><input class="hidden" ng-model=" y.VSL_ORST_LOCID" /></td>';

// VSL_ORST_STEPS


$stepCode .= '<td style="width:15%;vertical-align:bottom;">';


//	<select class="ab-flipped" ab-bind="VSL_ORST_STEPS" ng-model="y.VSL_ORST_STEPS" >
//	<option value="">Select Step</option>
//	<option ab-label="LF_STEPS_DD_ACKN" value="DD_ACKN">To Quote</option>
//	<option ab-label="LF_STEPS_DE_AOKN" value="DE_AOKN">To Acknowledge quota</option>
//	<option ab-label="LF_STEPS_EE_SCED" value="EE_SCED">To Reserve</option>
//	<option ab-label="LF_STEPS_FF_PICK" value="FF_PICK">(pick-up)</option>
//	<option ab-label="LF_STEPS_GG_RELE" value="GG_RELE">To Release</option>
//	<option ab-label="LF_STEPS_HH_PACK" value="HH_PACK">To Pack</option>
//	<option ab-label="LF_STEPS_II_DELI" value="II_DELI">To Deliver</option>
//	<option ab-label="LF_STEPS_JJ_INVO" value="JJ_INVO">Submit to WIP</option>
//	<option ab-label="LF_STEPS_KK_PURG" value="KK_PURG">In Wip</option>
//	<option ab-label="LF_STEPS_QQ_PURG" value="QQ_PURG">Invoiced &amp; Completed</option>
//	</select>



$stepCode .= <<<EOC

<!--
  <ul class="nav nav-pills ab-spaceless" role="tablist" ng-if="y.idVSL_ORST>0">
    <li class="dropdown ab-spaceless">
      <a class="dr1opdown-toggle " data-toggle="dro1pdown" style="white-space:nowrap;padding:0px;">
	<span class="ca2ret"></span>
-->
	<span  ng-repeat="step in VSL_STEP_LIST" ng-if="y.idVSL_ORST>0 && step.name==y.VSL_ORST_STEPS" >
		&nbsp;{{step.labeltext}}&nbsp;
	</span>
	<span  ng-if="y.idVSL_ORST<1" class="small text-primary" >
		&nbsp;{{y.newStepMess}}&nbsp;
	</span>
<!--      	
      </a>
      <!--
      <ul class="dropdown-menu ab-spaceless" role="menu">
        <li ng-if="x.OrderStatus.IV_VSL_STEPS_VALID.indexOf(step.name)>-1" ng-repeat="step in VSL_STEP_LIST" >
        <a class="small" ng-click="y.VSL_ORST_STEPS=step.name;" style="white-space:nowrap;width:150px;max-width:150px;padding:0px;">
        	
        	<span ng-if="step.name>y.VSL_ORST_STEPS" >
        	&nbsp;&nbsp;{{step.labeltext}}
        	<span class="glyphicon glyphicon-triangle-right text-primary " ></span>
        	</span>
        	<span ng-if="step.name<y.VSL_ORST_STEPS" >
        	&nbsp;<span class="glyphicon glyphicon-triangle-left text-primary " ></span>&nbsp;{{step.labeltext}}
        	</span>
        	<span class="text-primary " ng-if="step.name==y.VSL_ORST_STEPS" >
        	&nbsp;&nbsp;&nbsp;&nbsp;{{step.labeltext}}
        	</span>
        	
        </a>
        </li>
      </ul>
    
    </li>
  </ul>
 
  <ul class="nav nav-pills ab-spaceless" role="tablist" ng-if="y.idVSL_ORST<0">
    <li class="dropdown ab-spaceless">
      <a class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;width:150px;max-width:150px;padding:0px;">
	
	<span>
	&nbsp;
	</span>
      	
      </a>

    </li>
  </ul>
   -->




EOC;

//	$grAttr = $xtmp->grAttrib;
//	$laAttr = $xtmp->laAttrib;
//	$inAttr = $xtmp->inAttrib;
//	$laAttr["class"] = "hidden";
//	$inAttr["size"] = "21";
//	$inAttr["class"] = " {{". "y.idVSL_ORST>0?'':'invisible'}} ";
//	
//	$xtmp->setFieldWrapper("view01","0.122","vsl_orst","y.VSL_ORST_STEPS","",$grAttr,$laAttr,$inAttr,"");
//	$stepCode .= $xtmp->currHtml;
$stepCode .= '</td>';

$stepCode .= <<<EOC


<td  style="width:15%;"  >

	
<div lot-links="on" ng-if="y.VIN_ITEM_LOTCT > 0"  >
	
	<span lotlist="0"  >
		<span  class="hidden" ng-repeat="lot in vsl_orhe   | AB_noDoubles:'idVSL_LSTR'  " ng-if="y.idVSL_ORST == lot.VSL_LSTR_STPSQ" >
		{{lot.idVSL_LSTR}}:{{lot.VSL_LSTR_ALOQT}},
		</span>
	</span>
	
	<input class="hidden"  ng-model="y.lotSel" size=5 />
	
	<input id="lotSel{{ y.idVSL_ORST }}"  lid="{{y.idVSL_ORST}}" class="hidden" 
		onclick="
			var lotUniqueId = '';
			var lotOrstId = '';
			$(this).parentsUntil('table').find('[lotallo]').each(function()
			{
				if (lotOrstId != $(this).attr('lotallo') || lotUniqueId != $(this).attr('lotuniqueid') )
				{
					lotUniqueId = $(this).attr('lotuniqueid');
					lotOrstId = $(this).attr('lotallo');
					$(this).val($('#lotAlloQt' + lotOrstId +'-'+ lotUniqueId).val());
				}
				
			});
			
			$('#lotAccum'+$(this).attr('lid')).click()
			"
			/>		
	
	
	<input class="hidden" lotaccumulator="0" value="" 
		id="lotAccum{{ y.idVSL_ORST }}" 
		onclick="
			var newSels = '';
			
			$(this).parentsUntil('table').find('[lotallo]').each(function()
			{
				if (isNaN($(this).val()) == true )
				{
					$(this).val($(this).attr('lastval'));
				}
				$(this).val(Math.abs($(this).val()))
				$(this).val($(this).val()=='0'?'':$(this).val())
				$(this).attr('lastval',$(this).val())
				if ($(this).val() != 0)
				{
					var lotUniqueId = $(this).attr('lotuniqueid'); // $(this).parentsUntil('div').find('[lotuniqueid]').val();
					newSels += lotUniqueId + ':' + Number($(this).val()) + ',';
				}
					
			});
			
			
			$(this).parentsUntil('table').find('[lotselected]').val(newSels);
			
			$(this).parentsUntil('table').find('[lotselected]').attr('lotSelected','1');
			$(this).parentsUntil('table').find('[lotselected]').click();
			
			
			"
	
	/>
	<input updlotsel="0" class="hidden" ng-click="updLotSel()" />
		
	<input class="hidden" lotselected="0" value="" totalOrd="{{y.VSL_ORST_ORDQT}}"
		onclick="
		$(this).parent().find('[ng-model]').val($(this).parent().find('[lotlist]').text());
		var selCount = 0;
		if ($(this).attr('lotselected') == '0')
		{
			$(this).parentsUntil('table').find('[lotallo]').each(function()
			{
				$(this).attr('lastval',Number($(this).val()))
				$(this).attr('orgval',Number($(this).val()))
			});

			$(this).val($(this).parent().find('[ng-model]').val().trim());
			$(this).attr('lotSelected','1')
		}
		var selList = $(this).val().split(',');
		var occ = 0;
		while (occ < selList.length-1)
		{
			selCount += Number(selList[occ].slice(selList[occ].indexOf(':')+1));
			occ += 1;
		};
		
		$(this).parentsUntil('table').find('[selCountDsp]').html(selCount);
		
		
		if (Math.abs(Number($(this).attr('totalOrd'))) != Math.abs(selCount))
		{
			$(this).parentsUntil('table').find('[lid]').addClass('text-danger');
		}
		else
		{
			$(this).parentsUntil('table').find('[lid]').removeClass('text-danger');
		}
		
		$(this).parent().find('[updlotsel]').click();
		
		// alert('LOT:' + $(this).parent().find('[updlotsel]').attr('updlotsel'));
		// $(this).parentsUntil('table').find('[ng-click]').click();	
	" />
	 
	<input id="lotStpSum{{y.idVSL_ORST}}" class="hidden" ng-model="y.selCountDsp" onclick="$(this).parent().find('[lotSelected]').click();" />
	
	<span lid="#LotQt{{y.idVSL_ORST}}"  class="btn-sm ab-pointer small text-primary"  orst="{{y.VSL_ORST}}"
	ng-click="x.showLots=1;"
	onclick="	
	$($(this).attr('lid')).toggleClass('hidden');
	$(this).parent().find('[lotSelected]').click();
	" >
	Lots
	<span class="glyphicon glyphicon-th-list small"></span>
	<span selCountDsp="on"></span>
	</span>
	
</div>


</td>
<td style="width:10%;" title="Step extention" class="text-right text-primary small" >{{ '$&nbsp;' + ABGetNumberFn('fmt-curr',y.VSL_ORST_ORDQT * x.VSL_ORDE_OUNET) }}</td>
</tr>

<tr ng-if="x.VIN_ITEM_LOTCT > 0" id="LotQt{{y.idVSL_ORST}}" class="hidden  ab-spaceless ">
	
	<td colspan=100 style="vertical-align:top;margin:0px;" id="LotQt{{x.idVSL_ORDE}}" class="small ab-spaceless text-right" ng-app=""  >
		
		<div class="row  ab-spaceless text-right" ng-init="lotHeadBg='bg-danger ab-body-curtain '" style="color:white;"  >
			<div class="col-lg-1">&nbsp;</div>
			<div class="col-lg-3 ab-spaceless text-center {{lotHeadBg}}">
			Lot
			</div>
			<div class="col-lg-1 ab-spaceless text-center {{lotHeadBg}}">
			Qty
			</div>
			<div class="col-lg-1 ab-spaceless text-center {{lotHeadBg}}">
			Allo
			</div>
			<div class="col-lg-1 ab-spaceless text-center {{lotHeadBg}}">
			PO
			</div>
			<div class="col-lg-1 ab-spaceless text-center {{lotHeadBg}}">
			Date
			</div>
			<div class="col-lg-1 ab-spaceless text-center {{lotHeadBg}}">
			Exp.
			</div>

			<div class="col-lg-2 ab-spaceless text-left {{lotHeadBg}}">
				<table style="width:100%;" ><tr>
				<td style="width:33%;" class="ab-spaceless">
					&nbsp;
					<span class="ab-spaceless small">
						Life
					<span>
				</td>			
				<td style="width:32%;"  class=" ab-spaceless small">
					Del.
				</td>								
				
				<td style="width:35%;"  class=" ab-spaceless small">
					Months
				</td>	
				</tr></table>							
			</div>				
			
			<div class="col-lg-1 ab-spaceless text-center {{lotHeadBg}}">
			
			<span>Qty</span>
			</div>					
			
		</div>

		<div   	ng-repeat="rowlotQt in rawResult.vin_item_vin_lshe  | AB_noDoubles:'idVIN_ITEM' "
		 	ng-if="x.idVIN_ITEM == rowlotQt.VIN_LSHE_ITMID" 
		 >
		 <div  abc="{{lotHasQty(lotQt.idVIN_LSHE)}}" class="row {{lotHasQty(lotQt.idVIN_LSHE,y,lotQt.VIN_LSHE_SOLDO)>0?'':'hidden'}}"
		 	ng-repeat="lotQt in rawResult.vin_item_vin_lshe   | AB_noDoubles:'idVIN_LSHE'  | AB_sortReverse:'VIN_LSHE_DOMDA' "   
		 	ng-if="x.idVIN_ITEM == lotQt.VIN_LSHE_ITMID"
		 	neg-repeat="lotQt in rowlotQt.rowSet   | AB_noDoubles:'idVIN_LSHE'  | AB_sortReverse:'VIN_LSHE_DOMDA' "   
		 
		 >
		 	<div class="col-lg-1">&nbsp;</div>
			<div class="col-lg-3 ab-border ab-spaceless text-right">
				<input class="hidden" ng-model="lotQt.idVIN_LSHE" />
				<input class="hidden" ng-model="lotQt.hasSpecs" ng-init="lotQt.hasSpecs=0" />	
				<span ng-if="lotQt.hasSpecs==0" class="text-muted" title="has no specs." >
					{{lotQt.VIN_LSHE_LOTID}}&nbsp;
				</span>
				<span class="{{lotQt.VIN_LSHE_SERNO>0?'':'hidden'}}" >
				[{{lotQt.VIN_LSHE_SERNO}}]
				</span>

				<ul class="nav  ab-spaceless " role="tablist" 
					ng-repeat="sma in vin_item_ssma | AB_noDoubles:'idVIN_ITEM' " 
					ng-if="sma.idVIN_ITEM==x.VSL_ORDE_ITMID" 
				 >
				<li class="dropdown ab-spaceless" >
				<a ng-if="lotQt.hasSpecs>0" title="has {{lotQt.hasSpecs}} spec(s) linked to lot" class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;padding:0px;">
					<table style="width:100%;" >
						<tr>
							<td class="text-left  small" >
								<span  class="caret"></span>
								{{lotQt.hasSpecs}}
							</td>
							<td class="text-right" >
								<span>
									{{lotQt.VIN_LSHE_LOTID}}&nbsp;
								</span>
								<span class="{{lotQt.VIN_LSHE_SERNO>0?'':'hidden'}}" >
								[{{lotQt.VIN_LSHE_SERNO}}]
								</span>
							</td>
						</tr>
					</table>
				</a>
				<ul class="dropdown-menu ab-spaceless text-right" role="menu" ng-init="lotQt.hasSpecs=0" >
					
				<li class="bg-warning" 
					ng-repeat="smaRows in rawResult.vin_item_ssma "
					neg-repeat="smaRows in sma.rowSet "
					ng-if="smaRows.VIN_SSLT_LOTID == lotQt.idVIN_LSHE && smaRows.VIN_SSLT_SPESQ == smaRows.idVIN_SSMA" 
				 >
				<a class="small"  style="white-space:nowrap;padding-left:2px;min-width:200px;text-align:right;">
					<span ng-init="lotQt.hasSpecs=lotQt.hasSpecs+1" >
						<table style="width:100%">
						<tr class=" ab-border" >
						<td colspan=2 class="text-left">
							<span class="text-primary" >Spec Id:</span>
							<label>
							&nbsp;&nbsp;
					        	{{smaRows.VIN_SSMA_SPEID}}
					        	&nbsp;&nbsp;
					        	</label>
					        </td>
					        <td class="text-right">
					        	<span ng-if="smaRows.VIN_SSMA_DESCR" >
					        		{{smaRows.VIN_SSMA_DESCR}}
					        		&nbsp;&nbsp;
					        	</span>
					        </td>
					        </tr>
					        <tr>
					        <td style="width:50%;" class="text-right" >	
							<span class="text-primary" >Expires:</span>
						</td>
					        <td style="width:50%;" class="text-left" >	
							<label class="" >&nbsp;
							{{ABGetDateFn('add-days', lotQt.VIN_LSHE_DOMDA + "," + smaRows.VIN_SSMA_SHLIF)}}
							</label>
						</td>	
					        </tr>
					        <tr>
					        <td style="width:50%;" class="text-right">	
							<span class="text-primary" >Exp. Months:</span>
						</td>
					        <td style="width:50%;" class="text-left" >	
							<label class="" >&nbsp;
							{{ (ABGetDateFn('diff-today',ABGetDateFn('add-days', lotQt.VIN_LSHE_DOMDA + "," + smaRows.VIN_SSMA_SHLIF))/30 ).toFixed(1) }}
							</label>
					        </td>
					        </tr>
					        <tr>
					        <td style="width:50%;" class="text-right" >	
							<span class="text-primary" >Life %:</span>
						</td>
					        <td style="width:50%;" class="text-left" >	
							<label class="" >&nbsp;
							{{ (ABGetDateFn('diff-perc', lotQt.VIN_LSHE_DOMDA + "," + (ABGetDateFn('add-days', lotQt.VIN_LSHE_DOMDA + "," + smaRows.VIN_SSMA_SHLIF)) )) }}
							</label>
							
						</td>
						</tr>
						</table>
					
				       	</span>
				</a>
				</li>
				</ul>
				</li>
				</ul>
					
			</div>
			<div class="col-lg-1 ab-border ab-spaceless text-right">
				<span ng-repeat="lotAloRow in vin_inve  | AB_noDoubles:'idVIN_ITEM' " ng-if="lotAloRow.VIN_LSLQ_ITMID == lotQt.VIN_LSHE_ITMID" >
				<span ng-repeat="lotAlo in rawResult.vin_inve | AB_noDoubles:'idVIN_LSLQ' "
				neg-repeat="lotAlo in lotAloRow.rowSet  | AB_noDoubles:'idVIN_LSLQ' " ng-if="lotAlo.VIN_LSLQ_LOTSQ == lotQt.idVIN_LSHE" >
					{{ lotAlo.VIN_LSLQ_BOHQT }} 
				</span>
				</span>
				&nbsp;
			
			</div>
			<div class="col-lg-1 ab-border ab-spaceless text-right">
				<span ng-repeat="lotAloRow in vin_inve  | AB_noDoubles:'idVIN_ITEM' " ng-if="lotAloRow.VIN_LSLQ_ITMID == lotQt.VIN_LSHE_ITMID" >
				<span ng-repeat="lotAlo in rawResult.vin_inve | AB_noDoubles:'idVIN_LSLQ' "
				neg-repeat="lotAlo in lotAloRow.rowSet  | AB_noDoubles:'idVIN_LSLQ' " ng-if="lotAlo.VIN_LSLQ_LOTSQ == lotQt.idVIN_LSHE" >
					{{ lotAlo.VIN_LSLQ_ALOQT }} 
				</span>
				</span>
				&nbsp;
			
			</div>
			<div class="col-lg-1 ab-border ab-spaceless text-right">
				<span ng-repeat="lotAloRow in vin_inve  | AB_noDoubles:'idVIN_ITEM' " ng-if="lotAloRow.VIN_LSLQ_ITMID == lotQt.VIN_LSHE_ITMID" >
				<span ng-repeat="lotAlo in rawResult.vin_inve | AB_noDoubles:'idVIN_LSLQ' "
				neg-repeat="lotAlo in lotAloRow.rowSet  | AB_noDoubles:'idVIN_LSLQ' " ng-if="lotAlo.VIN_LSLQ_LOTSQ == lotQt.idVIN_LSHE" >
					{{ lotAlo.VIN_LSLQ_PURQT }} 
				</span>
				</span>
				&nbsp;
			
			</div>
			<div class="col-lg-1 ab-border ab-spaceless text-center">
				{{ ABGetDateFn('get-year',lotQt.VIN_LSHE_DOMDA) }}-{{ ABGetDateFn('get-month',lotQt.VIN_LSHE_DOMDA) }}
			</div>
			<div class="col-lg-1 ab-border ab-spaceless text-center" style="font-weight:700;" >
			
				<span ng-if="x.VSL_ORDE_LLINK < 1 " >
				
					{{ ABGetDateFn('get-year',lotQt.VIN_LSHE_DATES) }}-{{ ABGetDateFn('get-month',lotQt.VIN_LSHE_DATES) }} 

						
				</span>
				
				<span class="text-primary" ng-repeat="tcSpec in specSheet[x.VSL_ORDE_ITMID] | AB_noDoubles:'idVIN_LSHE,idVIN_SSMA'"
				ng-if="tcSpec.idVIN_SSMA == x.VSL_ORDE_LLINK && lotQt.idVIN_LSHE == tcSpec.idVIN_LSHE" 
				ng-init="lotQt.LSHE_DATES=ABGetDateFn('add-days',lotQt.VIN_LSHE_DOMDA + ',' + tcSpec.VIN_SSMA_SHLIF); " >		
					{{ ABGetDateFn('get-year',lotQt.LSHE_DATES) }}-{{ ABGetDateFn('get-month',lotQt.LSHE_DATES) }}
				</span>
			</div>	




			<div ng-if="x.VSL_ORDE_LLINK<1" class="col-lg-2  ab-spaceless" ng-init="x.specCurrent=''">			
			
				<table  
				style="width:100%;border-color:transparent;border:none;border-bottom:solid;border-width:2px;border-color:{{lotQt.lifeColor}};" 
				>
				<tr>
				<td style="width:33%;"  
				ng-init="lotQt.lifeColor = setLifeColors(ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + ',' + lotQt.VIN_LSHE_DATES),lotQt,x);"
				class=" ab-border ab-spaceless text-center small">
					{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + lotQt.VIN_LSHE_DATES) }}%
				</td>			
				<td style="width:33%;"  class=" ab-border ab-spaceless text-center small">
					{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + lotQt.VIN_LSHE_DATES + "," + y.VSL_ORST_PDATE) }}%
				<td style="width:34%;"  class=" ab-border ab-spaceless text-center small">
					<span ng-if="ABGetDateFn('diff-today',lotQt.VIN_LSHE_DATES) > 0" >
					{{ (ABGetDateFn('diff-today',lotQt.VIN_LSHE_DATES)/30).toFixed(1) }}
					</span>
					<span ng-if="ABGetDateFn('diff-today',lotQt.VIN_LSHE_DATES) < 0.0000001 " >
					0
					</span>

				</td>
				</tr></table>

			</div>				


			<div ng-if="x.VSL_ORDE_LLINK>0" class="col-lg-2  ab-spaceless" ng-init="x.specCurrent=x.VSL_ORDE_LLINK" >
				
				
				<table title="{{lotQt.lifeColor!=lotQt.LinkColor?'Lot not valid for Spec':'Lot is to spec'}}" style="width:100%;;border-color:transparent;border:none;border-bottom:solid;border-width:2px;border-color:{{lotQt.lifeColor}};" >
					<tr class="r" ng-repeat="sp in specSheet[x.VSL_ORDE_ITMID] | AB_noDoubles:'idVIN_LSHE,idVIN_SSMA' " 
					ng-if="lotQt.idVIN_LSHE==sp.idVIN_LSHE && sp.idVIN_SSMA==x.VSL_ORDE_LLINK " 
					ng-init="sp.LSHE_DATES=ABGetDateFn('add-days',lotQt.VIN_LSHE_DOMDA + ',' + sp.VIN_SSMA_SHLIF); "
					>
					<td class="ab-border ab-spaceless text-center small" style="width:34%;"
					ng-init="
					lotQt.lifeColor = setLifeColors(ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + ',' + sp.LSHE_DATES),lotQt,x);
					lotQt.LinkColor = setLifeColors(ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + ',' + sp.LSHE_DATES),lotQt,0);
					"  >
						{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + sp.LSHE_DATES) }}%
					</td>
					<td class="ab-border ab-spaceless text-center small" style="width:33%;" >
						{{ ABGetDateFn('diff-perc',lotQt.VIN_LSHE_DOMDA + "," + sp.LSHE_DATES + "," + y.VSL_ORST_PDATE) }}%
					</td>
					<td class="ab-border ab-spaceless text-center small" style="width:33%;" >
						<span ng-if="ABGetDateFn('diff-today',sp.LSHE_DATES) > 0" >
						{{ (ABGetDateFn('diff-today',sp.LSHE_DATES)/30).toFixed(1) }}
						</span>
						<span ng-if="ABGetDateFn('diff-today',sp.LSHE_DATES) < 0.0000001 " >
						0
						</span>						
					</td>
					</tr>
				</table>	
			
			</div>

<!---
$("#ab-sessionBoard").click();
var debug = "";
debug += A_Scope.recSetToTsv(dDta.scList.vin_inve[0].rowSet,"",",VIN_ITEM_ITMID,VIN_LSHE_LOTID,VSL_ORDE_ORLIN,VSL_ORST_STPSQ,idVSL_ORHE,idVSL_ORDE,VSL_LSTR_ORNUM,VSL_LSTR_ORLIN,VSL_LSTR_STPSQ,VSL_LSTR_ALOQT,idVSL_LSTR")
$("#focusGrid").val(debug)
-->		

			
			<div class="col-lg-1  ab-spaceless text-center ab-pointer" 
				onclick="$(this).find('#newId').removeClass($(this).find('#lotId').html()?'':'hidden');$(this).find('input').focus();" 
			>
				<input class="hidden" lotuniqueid="0" ng-model="lotQt.VSL_LSTR_LOTSQ" />
				
				<div class="ab-border ab-spaceless " style="min-width:25px;min-height:16px;" >
					<!-- <span ng-repeat="lotRows in vin_inve | AB_noDoubles:'idVIN_ITEM' " ng-if="lotRows.idVIN_ITEM==x.VSL_ORDE_ITMID" > -->
					<span 
					ng-repeat="lotRows in vsl_orheLSTR | AB_noDoubles:'idVSL_ORHE' " 
					ng-if="lotRows.idVSL_ORHE==idVSL_ORHE" >
						<!-- <small>{{lotQt.idVIN_LSHE}}-{{y.idVSL_ORST}}</small> -->
						<span id="lotId" 
						ng-repeat="lotSel in rawResult.vsl_orheLSTR  | AB_noDoubles:'idVSL_LSTR' " 
						ng-if="y.idVSL_ORST == lotSel.VSL_LSTR_STPSQ  && lotSel.VSL_LSTR_LOTSQ == lotQt.idVIN_LSHE" 
						neg-repeat="lotSel in lotRows.rowSet  | AB_noDoubles:'idVSL_LSTR' " 
						neg-if="y.idVSL_ORST == lotSel.VSL_LSTR_STPSQ  && lotSel.VSL_LSTR_LOTSQ == lotQt.idVIN_LSHE" >
							<input size=2 class="small ab-borderless ab-spaceless" 
								lotallo="{{lotSel.VSL_LSTR_STPSQ}}"
								lastval="0"
								orgval="0"
								lotuniqueid="{{lotQt.idVIN_LSHE}}"
								onfocus="$(this).select();"					
								onchange="$(this).parentsUntil('table').find('[lotaccumulator]').click();"
								
								ng-model="lotSel.VSL_LSTR_ALOQT"
							/>
							
		
							
						</span>
					</span>
					
					<span id="newId" class="hidden"  >
						<input size=2  class="small ab-borderless ab-spaceless"
							lotallo="{{y.idVSL_ORST}}"
							lotuniqueid="{{lotQt.idVIN_LSHE}}"
							lastval="0"
							orgval="0"
							onfocus="$(this).select();"
							onchange="$(this).parentsUntil('table').find('[lotaccumulator]').click();"
							
							ng-model="newSel.VSL_LSTR_ALOQT"
						/>
							
					</span>
				</div>
			</div>	
			
		</div>	
				
		</div>

		
	</td>
</tr>	





</table>

</div>

</td>
</tr>
<tr>
	
	<td colspan=100 style="padding-left:50px;padding-top:5px;"  ng-app=""  >
		<span class="text-primary  ab-spaceless {{vslFormPg!=2?'':'hidden'}}" >
			<span class="ab-pointer" ng-click="insertInStep(x.VSL_ORDE_ORLIN,0);" onklick="stepInsert(this);" >
				<span class="small" >Insert Step</span>
				<span  class="glyphicon glyphicon-pencil" ></span>
			</span>	
		      	<input class="hidden text-primary" ng-model="x.VSL_ORDE_LLINK"   title="Spec Link"  />
		</span>  	
	</td>
</tr>

</table>

EOC;

echo $stepCode;


?>

</div>

<?php

echo '<div class="AC col-lg-2" >';

// VSL_ORDE_OUNET
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$grAttr["class"] = "ab-spaceless";
$laAttr["class"] = "hidden";
$inAttr["size"] = "4";
$laAttr["ab-label"] = "STD_PRICE";

$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_OUNET","",$grAttr,$laAttr,$inAttr,"");
echo "<table style='width:100%;'><tr class='ab-strong' ><td>$</td><td style='white-space:nowrap;' >".$xtmp->currHtml."</td>";

// VSL_ORDE_SAUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["size"] = "4";


// VIN_ITEM_LPUOM
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr["ab-label"] = "STD_UOM_SHORT";

	$keepOrg = 0; 
	$repeatIn = "vin_unit";
	$searchIn = "";
	$refName = "x.VSL_ORDE_SAUOM"; // unique
	$refModel = "x.VSL_ORDE_SAUOM"; // unique
	$repeatInRef = "idVIN_UNIT"; //Unique
	$searchRefDesc = "";
	$refDesc = implode("&nbsp;&nbsp;",array("{{ab_rloop.VIN_UNIT_UNITM}}","{{ab_rloop.VIN_UNIT_DESCR}}"));
	$refDetail = "";
	$refDetailLink = "";
	$ignTrig = 'ng-click="' . "VIN_UNIT_UNITM='A ';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);".'"';
	$hardCode = $xtmp->setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig);

$hardCode =<<<EOC

	<input class="hidden" size=2 ng-model="x.VSL_ORDE_SAUOM" />
	<input class="hidden" size=2 ng-model="x.VSL_ORDE_UNSET" />
	<ul class="nav  ab-spaceless " role="tablist"    >
	<li class="dropdown ab-spaceless small" 
	ng-repeat="uom in vin_unit" 
	ng-init="x.VSL_ORDE_FACTO = (x.idVSL_ORDE>0?x.VSL_ORDE_FACTO:uom.VIN_UNIT_FACTO)"
	ng-if="uom.idVIN_UNIT==x.VSL_ORDE_SAUOM && uom.VIN_UNIT_UNSET==x.VSL_ORDE_UNSET"  >
	
	
		<span data-toggle="dropdown" class="text-primary btn-link" style="white-space:nowrap;padding:0px;" >
			{{uom.VIN_UNIT_UNITM}}
			<span class="caret" ></span>
		</span>
		<ul class="dropdown-menu ab-spaceless" role="menu"  >
			<li class="dropdown ab-border ab-spaceless small" 
			ng-repeat="uomDe in vin_unit" 
			ng-if="uomDe.VIN_UNIT_UNSET==x.VSL_ORDE_UNSET"  >
				<a ng-if="uomDe.idVIN_UNIT!=x.VSL_ORDE_SAUOM"
				class="small"  ng-click="x.VSL_ORDE_SAUOM = uomDe.idVIN_UNIT;x.VSL_ORDE_FACTO=uomDe.VIN_UNIT_FACTO;formChange()" >
					{{uomDe.VIN_UNIT_UNITM}}
				</a>
				<a ng-if="uomDe.idVIN_UNIT==x.VSL_ORDE_SAUOM"
				class="small text-primary"  >
				<span class="glyphicon glyphicon-ok" ></span>&nbsp;
					{{uomDe.VIN_UNIT_UNITM}}
				</a>
			</li>

		</ul>
	</li>
	</ul>


EOC;



//	$hardCode = '<div class="small spaceless" ><input class="hidden" size=2 ng-model="x.VSL_ORDE_SAUOM" /><select class="small" onchange="$(this).parent().find('."'input')".'.val($(this).val());">';
//	$hardCode .= '<option class="small" ng-repeat="uom in vin_unit" value="{{'.'uom.idVIN_UNIT}}" ng-if="uom.idVIN_UNIT==x.VSL_ORDE_SAUOM"  >';
//	$hardCode .= '{{' . 'uom.VIN_UNIT_UNITM}}';
//	$hardCode .= '</option>';
//	$hardCode .= '<option class="small" ng-repeat="uom in vin_unit"  value="{{'.'uom.idVIN_UNIT}}" ng-model="uom.idVIN_UNIT" ng-if="uom.idVIN_UNIT!=x.VSL_ORDE_SAUOM && uom.VIN_UNIT_UNSET==x.VIN_ITEM_UNSET"  >';
//	$hardCode .= '{{' . 'uom.VIN_UNIT_UNITM}}';
//	$hardCode .= '</option>';
//	$hardCode .= '</select></div>';
	
//	x.VIN_ITEM_UNSET
	
$xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_SAUOM","",$grAttr,$laAttr,$inAttr,$hardCode);



// $xtmp->setFieldWrapper("view01","0.0","vsl_orde","x.VSL_ORDE_SAUOM","",$grAttr,$laAttr,$inAttr,"");






echo "<td class='ab-pointer small' >" . $hardCode . "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>$</td><td>{{ ABGetNumberFn('fmt-curr',x.VSL_ORDE_ORDQT * x.VSL_ORDE_OUNET) }}</td></tr>";

$hardCode = <<<EOC

<tr ><td></td></tr>

<tr ng-repeat="lastPrice in rawResult.vin_cust" ng-if="lastPrice.VIN_CUST_LPPAID > 0 && lastPrice.VIN_CUST_BPART == VSL_ORHE_BTCUS && lastPrice.VIN_CUST_ITMID == x.VSL_ORDE_ITMID" >
<td colspan=100 class=" text-right small"  ng-init="x.LastPriceFound=1" >
<span class="text-primary" ab-label="STD_LAST_PRICE_PAID">Last Price </span> 
{{'$'+lastPrice.VIN_CUST_LPPAID}} - {{lastPrice.VIN_CUST_LPDATE}} 
</td>
</tr>
<tr ng-if="!x.LastPriceFound">
<td colspan=100 class="text-primary text-right small" >Never purchased before</td>
</tr>


EOC;

echo $hardCode;
$hardCode = <<<EOC

<tr><td><input class="hidden" ng-model="x.VSL_ORDE_QUONU" ng-init="x.VSL_ORDE_QUONU='0'" /></td></tr>

<tr ng-repeat="quote in rawResult.vin_cust" 
ng-if="(quote.VIN_CUST_EXPYN<1 || ABGetDateFn('diff-days',quote.VIN_CUST_EXPIR+','+VSL_ORHE_ODATE)+1>0) && quote.VIN_CUST_BPART == VSL_ORHE_BTCUS && quote.VIN_CUST_ITMID == x.VSL_ORDE_ITMID&&quote.VIN_CUST_SELLP>0&&quote.VIN_CUST_QUONU.trim()!=''">

<td colspan=100 class=" text-right small"  style="white-space:nowrap;" ng-init="x.QuoteFound=1;x.VSL_ORDE_OUNET=(x.idVSL_ORDE<1?quote.VIN_CUST_SELLP:x.VSL_ORDE_OUNET)" >
<span class="text-danger" ng-if="x.VSL_ORDE_OUNET*1!=quote.VIN_CUST_SELLP*1" ng-init="x.VSL_ORDE_QUONU='0'" >Not used</span> 
<span class="text-danger" ng-if="x.VSL_ORDE_OUNET*1==quote.VIN_CUST_SELLP*1" ng-init="x.VSL_ORDE_QUONU=quote.idVIN_CUST;" ></span> 
<span class="text-primary">Q.Amount</span> 
{{'$'+quote.VIN_CUST_SELLP}}
<span class="text-primary"> Exp.</span>
<span class="{{quote.VIN_CUST_EXPYN<1?'':'hidden'}}" ab-label="STD_NO">n/a</span>
<span class="{{quote.VIN_CUST_EXPYN>0?'':'hidden'}}"> {{quote.VIN_CUST_EXPIR}} </span>
</td>

</tr>

<tr ng-if="!x.QuoteFound"  >
<td colspan=100 class="text-primary text-right small" >No Quote Found</td>
</tr>
</table>
EOC;

echo $hardCode;


$hardCode = <<<EOC

<table class="hidden" >
	<tr>
		<td class="text-right small">
			<span class="text-primary">Total Qty</span>
			<em>{{x.VSL_ORDE_ORDQT}}</em>
		</td>

		<td class="small text-right hidden">
			<span class="text-primary">$</span>
		</td>
		<td class=" hidden" >
			{{ABGetNumberFn('fmt-curr',x.VSL_ORDE_ORDQT * x.VSL_ORDE_OUNET) }}
		</td>	
	</tr>
	
</table>				

EOC;

echo $hardCode;
				
echo '</div>';

?>


<div class="col-lg-12" >
	<div class="row" style="vertical-align:top;"  >

		<div class="col-lg-1 " >
		</div>	

		<div class="col-lg-8 " >
 		
			
		</div>	
		

	</div>

	<div id="invQ{{x.idVSL_ORDE}}" idtarget="1" class="hidden"  >
		
		<input class="hidden" ng-model="x.totalCount" />
		<div class="small" style="font-weight:700;" ng-repeat="invQrec in rawResult.vin_inve | AB_noDoubles:'idVIN_ITEM' " 
		ng-if="vin_inve.length>0 &&  invQrec.VIN_INVE_ITMID == x.VSL_ORDE_ITMID"  >
			
			<input size=2  class="hidden ab-borderless" ng-model="x.recCount"  ng-init="x.recCount=0" />
			<div class="row ab-border ab-spaceless"  ng-repeat="invQ in rawResult.vin_inve | AB_noDoubles:'idVSL_ORDE,idVSL_ORST'  | AB_Sorted:'VSL_ORHE_ORNUM,VSL_ORDE_ORLIN' " 
			ng-if="invQ.VIN_INVE_ITMID == x.VSL_ORDE_ITMID && invQ.idVSL_ORHE > 0 && invQ.idVSL_ORHE != idVSL_ORHE && invQ.VSL_ORST_STEPS > 'EE_SCED' && invQ.VSL_ORST_STEPS < 'JJ_INVO' " >
			
				<div class="col-lg-4 " recount="1" >
					<span class="text-primary" target="_blank" href="#/VSL_ORDERS/VSL_ORHECT/Process:VSL_ORDERS,Session:VSL_ORHECT,updType:UPDATE,idVSL_ORHE:{{invQ.idVSL_ORHE}}" >
						<span class="glyphicon glyphi21con-search" ></span>
						<span><em ab-label="STD_ORNUM_SH" >Order</em>:</span>
					</span>
		
					&nbsp;{{ invQ.VSL_ORHE_ORNUM  }}&nbsp; {{invQ.VGB_CUST_BPNAM}}&nbsp;
					<span class="text-primary" >&nbsp;&nbsp;CSR</span>
					<span class="ab-strong">:&nbsp;
						<span ng-repeat="usr in vsl_users"  ng-if="invQ.VSL_ORHE_USLNA==usr.CFG_USERS_CODE">
							{{usr.CFG_USERS_DESIGNATION}}
						</span>
					</span>		
				</div>
				<div class="col-lg-2 ">
					<span class="text-primary"><em ab-label="VSL_ORHE_CUSPO_10" >Ref</em>:</span>
					&nbsp;{{ invQ.VSL_ORHE_CUSPO  }}&nbsp;
				</div>
				<div class="col-lg-3 text-left" ng-init="x.recCount=x.recCount+1">
					<table style="width:100%;">
						<tr>
							<td style="vertical-align:top;" >
								&nbsp;&nbsp;
								<span class="text-primary"><em ab-label="STD_QUANTITY_SHORT" >Qty</em>:</span>
								&nbsp;{{ invQ.VSL_ORST_ORDQT  }}&nbsp;
								<span ng-repeat="stp in VSL_STEP_LIST" ng-if="stp.name == invQ.VSL_ORST_STEPS">
			 					{{stp.labeltext}} 
			 					</span>
			 				</td>
							<td style="vertical-align:top;" >
			
			 					<div ng-repeat="lotQty in  rawResult.vin_inve | AB_noDoubles:'idVSL_LSTR' " 
			 					ng-if="lotQty.VSL_LSTR_STPSQ==invQ.idVSL_ORST" >
			 						<table style="width:100%;">
				 						<tr>
				 							<td style="width:70%;">
							 					<span ng-repeat="lotIds in  rawResult.vin_inve | AB_noDoubles:'idVIN_LSHE' "
							 					ng-if="lotIds.idVIN_LSHE==lotQty.VSL_LSTR_LOTSQ">
								 					<span class="text-primary">&nbsp;Lot:&nbsp;</span>
								 					{{lotIds.VIN_LSHE_LOTID}}
								 					<span ng-if="lotIds.VIN_LSHE_SERNO > 0"> - {{lotIds.VIN_LSHE_SERNO}}</span>
							 					</span>
											</td>
											<td style="width:30%;">
							 					<span class="text-primary"><em ab-label="STD_QUANTITY_SHORT" >Qty</em>:</span>
							 					{{lotQty.VSL_LSTR_ALOQT}}
							 				</td>
							 			</tr>
							 		</table>
			 					</div>
			 				</td>
			 			</tr>
			 		</table>
				</div>


				
			</div>
		
		</div>
	
	</div>
	</div>	
	</form>	
	<div class="col-lg-11 ab-spaceless bg-warning ab-body-curtain" style="height:3px;" ></div>
	</div>
</div>
	  	  
	  	  
	  	 