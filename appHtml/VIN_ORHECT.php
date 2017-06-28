<?php require_once "../stdSscript/stdAppobjGen.php"; ?>


<style>
.boxwrapper label {
	min-width: 25px !important;
}


.ACdropdown {
    position: relative;
    display: inline-block;
}

.ACdropdown-content {
    display: none;
    position: absolute;
    background-color:white;
    min-width: 350px;
    box-shadow: 8px 8px 8px 8px rgba(0,0,0,0.2);
    padding: 5px 5px;
    z-index:1;
}

.ACdropdown:hover .ACdropdown-content {
    display: block;
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

<div class="hidden">

<?php 
session_start();
ob_clean();
require_once "../appCscript/VIN_TRANSAC.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>




<textarea class="hidden" ab-updSuccess="" >




if (data['posts'].requestMethod == 'DELETE')
{
	
	location.href="#/VIN_TRANSAC/VIN_ORDERS/Process:VIN_TRANSAC,Session:VIN_ORDERS,tblName:vin_orhe"
}
else
{

	if ($scope.opts.updType == "CREATE")
	{
		location.href="#VIN_TRANSAC/VIN_ORHECT/idVIN_ORHE:" + data['posts'].insertId + ",updType:UPDATE,Session:VIN_ORHECT,Process:VIN_TRANSAC"
	}
	else
	{

		$scope.initOrder();
		

		
	}


}

</textarea>

</div>
<div class="hidden" ng-init="SESSION_DESCR='Inventory Adjustment Control'">
	<span ab-label="VIN_ORHECT"></span>
</div>
<div id="ab-new" class="hidden" ng-init="tdDates = ABGetDateFn('','');" >

	<label  title="CREATE" class="{{opts.updType!='CREATE'?'':'hidden'}}">
		 <a 
	href="#VIN_TRANSAC/VIN_ORHECT/Process:VIN_TRANSAC,Session:VIN_ORHECT,tblName:vin_orhe,updType:CREATE,idVIN_ORHE:0,tbData:{{tbData}}" 
	>
		<span >New</span>
		<span  class="glyphicon glyphicon-pencil" ></span>
	</a>			
	</label>
	
</div>

<div class="hidden" id="processButton">
	<div ng-if="hasToProcess();" >
		<input class="hidden" ng-model="VIN_ORHE_PROCESS" size=5 />
		<div ng-if="VIN_ORHE_PROCESS!='1' " >
			<span class="btn btn-success btn-md ab-spaceless"   ng-if="dbProcessTransaction!=1" ng-click="saveForProcess();"  >
			Process 
			</span>
		</div>
		<span  ng-if="VIN_ORHE_PROCESS=='1' "class="text-primary" >
			Order has been processed by
			<span class="ab-strong" ng-repeat="usr in vin_users"  ng-if="VIN_ORHE_PROCBY==usr.CFG_USERS_CODE" org="{{VIN_ORHE_USLNA}}" >
			       	&nbsp;&nbsp;
			       	{{usr.CFG_USERS_DESIGNATION}}
			</span>
			
		</span>
	</div>
</div>





	<script>
		$('#ab-appOpt').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
		$('#ab-delete').find("[ng-click]").attr("ng-click","delSet();")
		$('#ab-buttonExt').html($("#processButton").html())
		
	</script>

							
<div style="margin-left:5px;" >	  			

		<div class="row ">
			<div class="col-sm-12 ab-spaceless" id="orheFormButtons" >
				<?php require_once "../stdCscript/stdFormButtons.php"; ?>
			</div>

			<form id="mainForm" name="mainForm"  ab-context="1" ab-view="vin_orhe" ab-main="vin_orhe"  >			
			<div class="col-sm-3  ac ">

				<input class="hidden" ab-btrigger="vin_orhe" ng-model="idVIN_ORHE" /> 
				<input class="hidden" neeg-init="VIN_UNIT_UNITM = ' ';ABlstAlias('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);" ng-model="VIN_UNIT_UNITM" />
				<input class="hidden" neeg-init="VGB_CURR_CURID = ' ';ABlstAlias('VGB_CURR_CURID','VGB_CURR_CURID','vin_curr',0);" ng-model="VGB_CURR_CURID" />
				<input class="hidden" ng-model="dbProcessTransaction" />
				
				
<?php

	// 1,040" VIN_ORHE_ORNUM 
	$xtmp = new appForm("VIN_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_ORNUM";
	$inAttr = $xtmp->inAttrib;
	$inAttr["class"] = "hidden";
	
	$xtmp->setFieldWrapper("view01","1.040","vin_orhe","VIN_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,"");
	$hardC0 = $xtmp->currHtml;	

	// 1,040" VIN_ORHE_ORNUM 
	$xtmp = new appForm("VIN_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_ORNUM";
	$laAttr["class"] = "hidden";
	$inAttr = $xtmp->inAttrib;
	$inAttr["size"] = "10";
	$inAttr["class"] .= " text-center text-primary";
	$inAttr["disabled"] = "disabled";
	$xtmp->setFieldWrapper("view01","1.040","vin_orhe","VIN_ORHE_ORNUM","",$grAttr,$laAttr,$inAttr,"");
	$hardC1 = $xtmp->currHtml;	



$tFnc = new AB_querySession;
$isAdmin = $tFnc->isUserAdmin();
$currUsr = $tFnc->getUserData();

$usr = <<< EOC

<input class="hidden" ng-model="VIN_ORHE_USLNA" />
<input class="hidden" id="orgUser" ng-model="orgUser"  />
<span neeg-init="getUsers();" ></span>
<span ng-repeat="usr in vin_users"  ng-if="VIN_ORHE_USLNA==usr.CFG_USERS_CODE" org="{{VIN_ORHE_USLNA}}" >
       	&nbsp;&nbsp;
       	{{usr.CFG_USERS_DESIGNATION}}
</span>

EOC;

$process = <<< EOC

<div class="col-sm-1  ac "></div>


EOC;



echo "<table style='width:100%' ><tr><td>" . $hardC0 . "</td><td>" .  $hardC1 . "</td><td class='text-primary' >&nbsp;&nbsp;User:</td><td>".$usr."</td></tr></table>";
	
echo "</div>";
echo $process;


	
	echo '</div><div class="col-sm-2  ">';

	//2,090	 	VIN_ORHE_CDATE
	$xtmp = new appForm("VIN_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_CREATED";
	$inAttr = $xtmp->inAttrib;
	$hardCode = " &nbsp;{{" . "VIN_ORHE_CDATE" . "}}";
	$xtmp->setFieldWrapper("view01","2.090","vin_orhe","VIN_ORHE_CDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
	
	
	//2,090	VIN_ORHE_OTYPE
	$xtmp = new appForm("VIN_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_TRNTY";
	$inAttr = $xtmp->inAttrib;
	$hardCode = "<input class='hidden' ng-model='VIN_ORHE_OTYPE' ng-bind='VIN_ORHE_OTYPE=getSource()' /><span class='ab-strong' ab-label='VIN_ORHE_OTYPE_adjust' ></span>"; // $xtmp->setEnumDisplay("vin_orhe","VIN_ORHE_OTYPE");
	$xtmp->setFieldWrapper("view01","2.090","vin_orhe","VIN_ORHE_OTYPE","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
	
	//2,090	 	VIN_ORHE_TEXT
	$xtmp = new appForm("VIN_ORDERS");
	$grAttr = $xtmp->grAttrib;
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] = "STD_REF";
	$inAttr = $xtmp->inAttrib;
	$hardCode = '<textarea  style="overflow:hidden;font-size:9pt;width:100%;" rows="5" cols="18"  ng-model="VIN_ORHE_TEXT"  > </textarea>';
	$xtmp->setFieldWrapper("view01","2.090","vin_orhe","VIN_ORHE_TEXT","",$grAttr,$laAttr,$inAttr,$hardCode);
	echo $xtmp->currHtml;
	
	

		

echo '</div>';


$detailPosition = <<<EOC
<td style="width:5%;" ></td>
<td style="width:3%;"  ></td>
<td style="width:15%;"  ></td>
<td style="width:20%;"  ></td>
<td style="width:10%;"  ></td>
<td style="width:6%;"  ></td>
<td style="width:8%;"  ></td>
<td style="width:7%;"  ></td>
<td style="width:7%;"  ></td>
<td style="width:7%;"  ></td>
<td style="width:12%;" >


</td>
EOC;


?>

<input type="hidden" id="VIEW_ITEMS" ng-click="FLT_ITEM_ITMID=VIN_ITEM_ITMID;VIN_ITEM_ITMID=' ';ABlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID,FLT_ITEM_LOTCT,FLT_ITEM_ITMID','vin_item');VIN_ITEM_ITMID=FLT_ITEM_ITMID;" />
<input class="hidden" onclick='$("input").removeAttr("ab-search-target");$(this).attr("ab-search-target","on");$("#VIEW_ITEMS").click();$("#ab-sessionBoardVIN_ITEMS").click();' value="Click" />			
<input class="hidden" ng-mo5del="idVIN_ITEM" />


		
</form>

	<div class="col-sm-10 " >
		<div class="row">
			<div class="col-sm-12">
			  	<table style="width:100%;" class="table-striped">
			  	<tr>
					<?php echo $detailPosition; ?>
			  	</tr>


				<tr  >
					<td  class=" ab-spaceless" style="vertical-align:top;" >
						
							<span class="btn-link ab-pointer" ng-if="idVIN_ORHE>0 && VIN_ORHE_PROCESS=='0'" ng-click="insertInDetail();" >
								<span>Insert</span>
								<span  class="glyphicon glyphicon-pencil" ></span>
							</span>			
							

					</td>
					
			  		<td class="bg-primary " style="white-space:nowrap;" >
			  			<span ab-label="STD_ORLIN_SH"></span>
			  		</td>
			  		<td class="bg-primary text-center " style="white-space:nowrap;" >
			  			<span ab-label="VIN_ITEM_ITMID"></span>
			  		</td>
			  		<td class="bg-primary " style="white-space:nowrap;" >
			  			<span ab-label="STD_DESCR"></span>
			  		</td>
			  		<td class="bg-primary " style="white-space:nowrap;" >
			  			<span ab-label="VIN_WARS_WARID"></span>
			  		</td>
			  		<td class="bg-primary " style="white-space:nowrap;" >
			  			<span ab-label="VIN_LOCS_LOCID_SH"></span>
			  		</td>
			  		<td class="bg-primary " style="white-space:nowrap;" >
			  			<span ab-label="VIN_ADJUTR_SH_ADJQT"></span>
			  		</td>
			  		<td class="bg-primary " style="white-space:nowrap;" >
			  			<span ab-label="STD_UOM_SHORT"></span>
			  		</td>
			  		<td class="bg-primary small" style="white-space:nowrap;" >
			  			<span ab-label="VIN_ITEM_AVGCP"></span>
			  		</td>
			  		<td class="bg-primary small" style="white-space:nowrap;" >
			  			<span ab-label="VIN_ORDE_ADJCP"></span>
			  		</td>
			  		
			  		<td class="bg-primary small" style="white-space:nowrap;" >
						<table  class="ab-spaceless" style="width:100%;" >
						  	<tr>
								<td class="text-left" >
									<table style="width:100%;">
									<tr>
									<td class="ab-strong ab-border abspaceless text-center" style="width:50%;">On Hand</td>
									<td class="ab-border abspaceless text-center" style="width:50%;">
									<span  ab-label="STD_NEW"></span>
									<span  ab-label="STD_QUANTITY_SHORT"></span>  
									</td>
									</tr>
									</table>
		  							 
								</td>								  	
						  	</tr>
						 </table> 				  		
			  		</td>
				</tr>
				</table>
				<div class="ab-wrapper-div"  style="width:100%;">
			  	<table style="width:100%;" class="table-striped ">
			  	<tr>
					<?php echo $detailPosition; ?>
			  	</tr>

				<tr	ab-formlist="order_list"
				   	ab-rowset="{{$index}}"   
				   	ab-new="{{ orde.idVIN_ORDE < 1?'1':'0' }}"
					ORDE-repeat="1"
		  			role="presentation" 
		  			ng-repeat="orde in rawResult.vin_orhe | AB_noDoubles:'idVIN_ORDE' " 
		  			ng-if="orde.VIN_ORDE_ORLIN > 0"
		  			id="ordeLine{{orde.idVIN_ORDE}}"
		  		>
					<td colspan=100 class="ab-spaceless">
						<div style="padding-top:4px;">
							<form ab-view="vin_orde" ab-main="vin_orde" ab-context="0" >
								<table class=" {{orde.trash==1?'text-danger':''}} table-striped" style="width:100%;" >
								  	<tr>
										<?php echo $detailPosition; ?>
								  	</tr>
								
									<tr>
										<td class="small text-center {{orde.trash==1?'text-danger':'text-primary'}}" >
											<span ng-if="VIN_ORHE_PROCESS=='0'">
												<input ng-change="formChange();" type="checkbox" value="0" onclick="$(this).val(1-$(this).val());" ng-model="orde.trash" class="text-primary" />
												<span  class="glyphicon glyphicon-trash " ></span>
											</span>
											<span ng-if="VIN_ORHE_PROCESS=='1'" class="invisible" >
												<input type="checkbox" value="0"  ng-model="orde.trash" class="text-primary" />
												<span  class="glyphicon glyphicon-trash " ></span>
											</span>
											
										</td>
	
			  							<td >
				  							<input class="hidden" ng-model="idVIN_ORHE" />
				  							<input class="hidden" ab-btrigger="vin_orhe"  ng-model="orde.idVIN_ORDE" /> 
				  							<input class="hidden" ng-model="orde.VIN_ORDE_ORNUM" /> 
				  							<input class="hidden" ng-model="orde.VIN_ORDE_FACTO" />
				  							<input readonly class="ab-borderless" ng-model="orde.VIN_ORDE_ORLIN" size=5 /> 
										</td>
										<td>

											<input class="hidden" id="VIN_ITEMsearch{{orde.VIN_ORDE_ORLIN}}" ng-if="orde.idVIN_ORDE < 1"
											ng-click="
											
											orde.VIN_ITEM_ITMID = abSessionResponse.VIN_ITEM_ITMID;
											orde.VIN_ORDE_ITMID = abSessionResponse.idVIN_ITEM;
											orde.VIN_ORDE_UNSET = abSessionResponse.VIN_ITEM_UNSET;
											orde.VIN_ORDE_QTUOM = abSessionResponse.VIN_ITEM_UNITM;
											orde.VIN_ORDE_FACTO = abSessionResponse.VIN_UNIT_FACTO;
											orde.VIN_ORDE_WARID = abSessionResponse.VIN_ITEM_WARID;
											orde.VIN_ORDE_AVGCP = 0;
											
											orde.VIN_ITEM_DESC1 = abSessionResponse.VIN_ITEM_DESC1;
											
											saveNewLine(abSessionResponse.VIN_ITEM_INVIT,orde);
											
											" />

											<a title="Search all Items"  class="ab-pointer  ab-spaceless" vin_items="" id="orlinSearch{{orde.VIN_ORDE_ORLIN}}"
											
											ng-click="ABsearchTbl='vin_item';ABsessionLink('','#VIN_ITEMsearch'+ orde.VIN_ORDE_ORLIN,'vin_item');"
											>
												<span class="glyphicon glyphicon-search" ></span>
											</a>
											
											<strong>&nbsp;{{ orde.VIN_ITEM_ITMID }}</strong>										
				  							<input class="hidden" ng-model="orde.VIN_ORDE_ITMID" size=5 /> 
				  							<input class="hidden" ng-model="orde.VIN_ORDE_UNSET" size=5 /> 
				  							<input class="hidden" ng-model="orde.VIN_ITEM_LOTCT" size=5 /> 
				  							<input class="hidden" ng-model="orde.VIN_ITMWAR_AVGCP" size=5 /> 
										</td>
										<td>
											<span class="{{orde.VIN_ORDE_ITMID!=''?'':'text-danger small ab-strong'}}" >
				  							{{orde.VIN_ITEM_DESC1}} 
				  							</span>
										</td>
										<td  >
											<span ng-repeat="wars in rawResult.vin_item_WAR  | AB_noDoubles:'idVIN_WARS'" ng-if="wars.idVIN_WARS==orde.VIN_ORDE_WARID"  >
											{{ wars.VIN_WARS_DESCR }}
											</span>
											<span ng-init="orde.VIN_ORDE_LOCID=(orde.VIN_ORDE_LOCID!=''?orde.VIN_ORDE_LOCID:wars.VIN_WARS_MALOC);"></span>
											</span>
				  							<input ng-change="formChange();" readonly class="hidden" ng-model="orde.VIN_ORDE_WARID" size=5 /> 
										</td>
										<td>
											<span ng-repeat="wars in rawResult.vin_item_WAR  | AB_noDoubles:'idVIN_LOCS'" ng-if="wars.idVIN_LOCS==orde.VIN_ORDE_LOCID"  >
											{{ wars.VIN_LOCS_DESCR }}
											</span>
				  							<input ng-change="formChange();" readonly class="hidden" ng-model="orde.VIN_ORDE_LOCID" size=5 /> 
										</td>
										<td>
											<span ng-if="VIN_ORHE_PROCESS=='0'">
												<span ng-if="orde.VIN_ITEM_LOTCT>0">
					  							<input ng-change="formChange();" readonly ng-model="orde.VIN_ORDE_ORDQT" ng-bind="orde.VIN_ORDE_ORDQT=lotQtyIn(orde.idVIN_ORDE)" size=5 /> 
					  							</span>
					  							<span ng-if="orde.VIN_ITEM_LOTCT==0">
					  							<input ng-change="formChange();" class="" ng-model="orde.VIN_ORDE_ORDQT" size=5 /> 
					  							</span>
					  						</span>
					  						<span ng-if="VIN_ORHE_PROCESS=='1'">
					  							<input class="hidden" ng-model="orde.VIN_ORDE_ORDQT" size=5 />
					  							{{orde.VIN_ORDE_ORDQT}}
					  						</span>
					  						

										</td>
										<td>
											
											<div class="small" ng-if="orde.VIN_ORDE_ITMID>0" >
												<input  class="hidden" ng-model="orde.VIN_ORDE_QTUOM" size=5 /> 

												<ul class="nav  ab-spaceless " role="tablist"    >
												<li class="dropdown ab-spaceless" 
												ng-repeat="uom in rawResult.vin_item_UOM" 
												ng-init="orde.VIN_ORDE_FACTO = (orde.idVIN_ORDE>0?orde.VIN_ORDE_FACTO:uom.VIN_UNIT_FACTO)"
												ng-if="uom.idVIN_UNIT==orde.VIN_ORDE_QTUOM && uom.idVIN_USET==orde.VIN_ORDE_UNSET"  >
												
												
													<span data-toggle="dropdown" class="text-primary btn-link" style="white-space:nowrap;padding:0px;" >
														{{uom.VIN_UNIT_UNITM}}
														<span class="caret" ></span>
													</span>
													<ul class="dropdown-menu ab-spaceless" ab-flst="" role="menu" ng-if="VIN_ORHE_PROCESS=='0'" >
														<li class="dropdown ab-border ab-spaceless" 
														ng-repeat="uom in rawResult.vin_item_UOM" 
														ng-if="uom.idVIN_USET==orde.VIN_ORDE_UNSET"  >
															<a ng-if="uom.idVIN_UNIT!=orde.VIN_ORDE_QTUOM"
															class="small"  ng-click="orde.VIN_ORDE_QTUOM = uom.idVIN_UNIT;orde.VIN_ORDE_FACTO=uom.VIN_UNIT_FACTO;formChange()" >
																{{uom.VIN_UNIT_UNITM}}
															</a>
															<a ng-if="uom.idVIN_UNIT==orde.VIN_ORDE_QTUOM"
															class="small ab-strong"  >
																{{uom.VIN_UNIT_UNITM}}
															</a>
														</li>
								
													</ul>
												</li>
												</ul>

											</div>										

				  							
										</td>
								  		<td style="white-space:nowrap;"  class="text-left" >
								  			<input class="hidden" ng-model="orde.VIN_ORDE_UPDCP" />
								  			<span ng-if="VIN_ORHE_PROCESS=='0'">
									  			<span ng-if="orde.VIN_ORDE_UPDCP=='0'" >
										  			<span class="text-primary small ab-pointer" title="Change average cost price"
										  			ng-click="orde.VIN_ORDE_AVGCP=orde.VIN_ITMWAR_AVGCP;orde.VIN_ORDE_UPDCP='1'">
									  				Change 
									  				</span>	
									  				{{ABGetNumberFn("fmt-curr",orde.VIN_ITMWAR_AVGCP)}}
									  			</span>
									  			<span  ng-if="orde.VIN_ORDE_UPDCP=='1'"  >
										  			<span class="text-primary small ab-pointer" title="Cancel average cost change"
										  			ng-click="orde.VIN_ORDE_AVGCP=orde.VIN_ITMWAR_AVGCP;orde.VIN_ORDE_UPDCP='0'">
										  				Cancel
										  			</span>
										  			<input size=4 class="{{orde.VIN_ITMWAR_AVGCP!=orde.VIN_ORDE_AVGCP?'text-danger ab-strong':''}}" ng-model="orde.VIN_ORDE_AVGCP"  />
										  		</span>
										  	</span>
										  	<span ng-if="VIN_ORHE_PROCESS=='1'" class="ab-strong" >
										  		{{ABGetNumberFn("fmt-curr",orde.VIN_ITMWAR_AVGCP)}}
										  	</span>
								  		</td>
								  		<td style="white-space:nowrap;" class="text-right">
								  			<input class="hidden" ng-model="orde.VIN_ORDE_ADJCP" />
								  			
								  			<span ng-if="VIN_ORHE_PROCESS=='0'" >
									  			<input size=4 ng-model="orde.VIN_ORDE_ADJCP" />
									  		</span>
										  	<span ng-if="VIN_ORHE_PROCESS=='1'" class="ab-strong" >
										  		{{ABGetNumberFn("fmt-curr",orde.VIN_ORDE_ADJCP)}}&nbsp;&nbsp;
										  	</span>
									  		
								  		</td>
										
										<td>
											<table style="width:100%;">
											<tr>
											<td class="ab-strong" style="width:50%;"></td>
											<td style="width:50%;"></td>
											</tr>
											<tr ng-repeat="inv in rawResult.vin_item_inv  | AB_noDoubles:'idVIN_INVE'"
											ng-if="inv.VIN_INVE_ITMID==orde.VIN_ORDE_ITMID" 
											>
											<td class="ab-strong text-center" >{{inv.VIN_INVE_BOHQT}}</td>
											<td class="ab-strong text-center text-primary" ng-if="VIN_ORHE_PROCESS!=1" >{{(inv.VIN_INVE_BOHQT*1) + (orde.VIN_ORDE_ORDQT*1)}}</td>
											</tr>
											</table>
										
										</td>

									</tr>
	
								</table>

								

								<table class=" {{orde.trash==1?'text-danger':''}} ab-spaceless" style="width:100%;" >
								  	<tr>
										<?php echo $detailPosition; ?>
								  	</tr>
									

									<tr	ab-formlist="lstr_list"
									   	ab-rowset="{{$index}}"   
									   	ab-new="{{ lstr.idVIN_ORDE < 1?'1':'0' }}"
										LSTR-repeat="1"
							  			role="presentation" 
							  			ng-repeat="lstr in rawResult.vin_orhe | AB_noDoubles:'idVIN_LSTR' " 
							  			ng-if="orde.idVIN_ORDE==lstr.VIN_LSTR_ORLIN"
							  			class=" {{orde.trash==1?'text-danger':''}}"
							  		>
										<td class="small text-center {{orde.trash==1?'text-danger':'text-primary'}}" >
											
										</td>
	

										<td colspan=3 >
										</td>
										<td colspan=2 >
												<input class="hidden" ng-model="lstr.idVIN_LSTR"  />
												
												<input class="hidden" ng-model="lstr.VIN_LSTR_LOTSQ" />
												<ul class="nav nav-pills ab-spaceless  ab-pointer" role="tablist" ng-init="" >
													<li class="dropdown ab-spaceless " >
														<div class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;min-width:75px;padding:0px;">
															<span ab-label="VIN_LSHE_LOTSQ_SH">Lot</span>
															<span class="caret"></span>
																						
															<span class="ab-strong" 
															ng-repeat="lot in rawResult.vin_item_lots | AB_noDoubles:'idVIN_LSHE' " 
															ng-if="lot.idVIN_LSHE==lstr.VIN_LSTR_LOTSQ" >
																<label>{{lot.idVIN_LSHE}} - {{lot.VIN_LSHE_LOTID }}</label>
															</span>
												
														
														</div>
													</li>
												</ul>												
													
										</td>
										<td>
											
											<span ng-if="VIN_ORHE_PROCESS=='0'">
					  							<input class="ab-strong" ng-change="formChange();" ng-model="lstr.VIN_LSTR_ALOQT" size=3 /> 
					  						</span>
											<span ng-if="VIN_ORHE_PROCESS=='1'" >
					  							<input class="ab-strong" readonly ng-model="lstr.VIN_LSTR_ALOQT" size=3 /> 
					  						</span>
				  							<input class="hidden" ng-model="lstr.VIN_LSTR_ALOQT_ORG" ng-init="lstr.VIN_LSTR_ALOQT_ORG=lstr.VIN_LSTR_ALOQT;"  />
										</td>

			  							<td >
										</td>
			  							<td >
										</td>
			  							<td >
										</td>
										
										<td>
											<table style="width:100%;">
											<tr>
											<td class="ab-strong" style="width:50%;"></td>
											<td style="width:50%;"></td>
											</tr>
											<tr ng-repeat="inv in rawResult.vin_item_inv  | AB_noDoubles:'idVIN_LSLQ'"
											ng-if="inv.VIN_LSLQ_LOTSQ==lstr.VIN_LSTR_LOTSQ" 
											>
											<td class="ab-strong text-center" >{{inv.VIN_LSLQ_BOHQT}}</td>
											<td class="ab-strong text-center text-primary" ng-if="VIN_ORHE_PROCESS!=1" >{{(inv.VIN_LSLQ_BOHQT*1) + (lstr.VIN_LSTR_ALOQT*1)}}</td>
											</tr>
											</table>										
											
										</td>

									</tr>



									<tr	ab-formlist="lstr_list"
									   	ab-rowset="{{$index}}"   
									   	ab-new="1"
										LSTR-repeat="1"
							  			role="presentation" 
										ng-repeat="lstr in rawResult.vin_item_lots | AB_noDoubles:'idVIN_LSHE' "  
										ng-if="lstr.VIN_LSHE_ITMID==orde.VIN_ORDE_ITMID && lotNotIn(rawResult.vin_orhe,orde.idVIN_ORDE,lstr.idVIN_LSHE) && VIN_ORHE_PROCESS=='0'"  
										class=" {{orde.trash==1?'text-danger':''}}"
							  		>



										<td class="small text-center {{orde.trash==1?'text-danger':'text-primary'}}" >
												
										</td>
	
			  							<td >
										</td>
										<td  >
				  							
										</td>
			  							<td >
										</td>
										
										<td colspan=2 >
												
												<input class="hidden" ng-model="lstr.VIN_LSTR_LOTSQ"  />
												<span ng-init="lstr.VIN_LSTR_LOTSQ=lstr.idVIN_LSHE" ></span>
												<ul class="nav nav-pills ab-spaceless  ab-pointer" role="tablist" ng-init="" >
													<li class="dropdown ab-spaceless " >
														<div class="dropdown-toggle " data-toggle="dropdown" style="white-space:nowrap;min-width:75px;padding:0px;">
															<span ab-label="VIN_LSHE_LOTSQ_SH">Lot</span>
															<span class="caret"></span>
																						
															<span class="small" 
															ng-repeat="lot in rawResult.vin_item_lots | AB_noDoubles:'idVIN_LSHE' " 
															ng-if="lot.idVIN_LSHE==lstr.VIN_LSTR_LOTSQ" >
																{{lot.idVIN_LSHE}} - {{lot.VIN_LSHE_LOTID }}
															</span>
												
														
														</div>
													</li>
												</ul>												
													
										</td>
										<td>
				  							<input class="" ng-change="formChange();" ng-model="lstr.VIN_LSTR_ALOQT" ng-init="lstr.VIN_LSTR_ALOQT=0" size=5 /> 
										</td>
			  							<td >
										</td>
										<td  >
				  							
										</td>
			  							<td >
										</td>
										
										<td >
											<table style="width:100%;">
											<tr>
											<td class="ab-strong" style="width:50%;"></td>
											<td style="width:50%;"></td>
											</tr>
											<tr ng-repeat="inv in rawResult.vin_item_inv  | AB_noDoubles:'idVIN_LSLQ'"
											ng-if="inv.VIN_LSLQ_LOTSQ==lstr.VIN_LSTR_LOTSQ" 
											>
											<td class="ab-strong text-center" >{{inv.VIN_LSLQ_BOHQT}}</td>
											<td class="ab-strong text-center text-primary" ng-if="VIN_ORHE_PROCESS!=1" >{{(inv.VIN_LSLQ_BOHQT*1) + (lstr.VIN_LSTR_ALOQT*1)}}</td>
											</tr>
											</table>
										
										</td>

									</tr>


	
								</table>

								
							</form>
						</div>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td colspan=6 >
						<table style="width:100%;" class="ab-border" ng-repeat="head in rawResult.vgl_journal | AB_noDoubles:'idVGL_JNHE' " >
						<tr><td colspan=5>&nbsp;</td></tr>
						<tr class="ab-strong" >
							<td style="width:30%;"> Source: {{head.VGL_JNHE_PSOUR}} 
							</td>
							<td style="width:10%;"> Account # </td>
							<td style="width:40%;"> Description </td>
							<td style="width:10%;" class="text-right"> Debit&nbsp;</td>
							<td style="width:10%;" class="text-right"> Credit&nbsp;</td>
							
						</tr>
						<tr ng-repeat="jrn in rawResult.vgl_journal | AB_noDoubles:'idVGL_JNDE' "  >
							<td></td>
							<td>
								{{jrn.VGL_CHART_GLIDN}}
							</td>
							<td>
								{{jrn.VGL_CHART_GLDES}}
							</td>
							<td class="text-right">
								<span ng-if="jrn.VGL_JNDE_GLAMT>0" >{{ABGetNumberFn("fmt-curr",jrn.VGL_JNDE_GLAMT)}}</span>&nbsp;
							</td>
							<td class="text-right">
								<span ng-if="jrn.VGL_JNDE_GLAMT<0" >{{ABGetNumberFn("fmt-curr",(jrn.VGL_JNDE_GLAMT * -1)) }}</span>&nbsp;
							</td>
							
						</tr>
						<tr class="ab-border">
							<td colspan=100></td>
						</tr>
						</table>
					</td>
				</tr>				
				
				
				
				</table>
				<div style="padding-top:150px;"></div>

				</div>
			</div>
		</div>
	</div>
</div>	

<span class="hidden" id="openUdateConfirm" data-toggle="modal" data-target="#processOrder" ></span>	

<div id="processOrder"  class="modal fade" role="dialog">
  <div class="modal-dialog">
  	
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span ab-label="" >Confirm process inventory order</span> </h4>
      </div>
      <div class="modal-body text-center">
			<span class="btn btn-success btn-md " 
			  ng-if="dbProcessTransaction!=1" ng-click="saveForProcess('PROCESS');"  >
			Process 
			</span>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
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

<div class='ab-borderr' ng-init="currOrstId=0" id="accumY" notg-click="chkOrstQty();" >

<input class="hidden" ng-model="currOrstId" />
</div>

</div>
</div>
<script>

</script>

<span type="button" class="btn-link" data-toggle="modal" data-target="#orstQtyModal"></span>
<input  id="orstQtyModalCMD" class="hidden" data-dismiss="modal" ng-click="backOrderInsert(ordeId,backOrderOptionQty);" value="YES KEEP" />
<div id="orstQtyModal"  class="modal fade" role="dialog">
  <div class="modal-dialog">
  	
    <!-- Modal content-->
    <div class="modal-content" ng-init="new_BTADD='';new_STADD=''">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span ab-label="" >Quantity in step sequence </span> - <label> Back Order option</label></h4>
       
        <table>
        <tr>
        	<td >
                	
        	</td>

        </tr>
        </table>
        
      </div>
      <div class="modal-body">
        <table  style="width:100%;">
        <tr>
        	<td>
        		<table class="table" style="width:100%;" >
        			<tr class="{{retractRequired>0?'':'hidden'}}">
        				<td >

        					You must retract to         					
        					<span class="bg-warning">
							<span class="glyphicon glyphicon-triangle-left text-danger"></span>
					        	Picking
				        	</span>
				        	if you want to change quantities.&nbsp;&nbsp;-&nbsp;	

        				</td>
        				
        			</tr>
        			<tr class="{{backOrderOption>0?'':'hidden'}}">
        				<td class="text-primary text-center  ab-border" >
        					<div>
	        					<input ng-model="orheBckOrd" class="hidden" />
	        					<button class="btn-lg ab-pointer {{orheBckOrd>0?'':'hidden'}}" ng-click="orheBckOrd=1-orheBckOrd" > 
			        				A quantity of {{backOrderOptionQty}} will be retained as back order!<br>Click this to <strong>cancel</strong> back order
		        				</button>
	        					<button class="btn-lg ab-pointer {{orheBckOrd<1?'':'hidden'}}" ng-click="orheBckOrd=1-orheBckOrd" > 
			        				The remaining quantity of {{backOrderOptionQty}} will not be retained!<br>Click this to <strong>retain</strong> back order
		        				</button>
		        			</div>
		        			<div class="text-danger ab-strong">
							{{orstLotMess}}
						</div>
		
        				</td>
        				
        			</tr>
        		
	        		
	        	</table>
        	</td>
        
        
        
        </tr>
        </table>
        
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div>

<?php require_once "VIN_CUST_QLIST_insert.php"; ?>	
</div>
<div id="ORHE_ALLOC" class="modal fade" role="dialog" >
	<div class="modal-dialog"  style="min-width:1200px;" >
	<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><span ab-label="STD_ADD22RESS" >Order Allocation</span> - <label>{{VIN_ORHE_ORNUM}} {{VGB_CUST_BPNAM}}</label></h4>
				
				<input class=" ab-borderless ab-pointer" 
				onmouseover="$(this).attr('title','Set dates to today');" readonly ng-model="today_PDATE" size="8" 
				onclick="$('[vin_pdate]').click();" 
				ng-init="today_PDATE=ABGetDateFn('get-year','')+'-'+ABGetDateFn('get-month','')+'-'+ABGetDateFn('get-day','')"			
				/>
			</div>
			<div class="modal-body ab-spaceless">
				<div class="container" >
	
					<?php require_once "VIN_ORDER_FORMS.php"; ?>
				</div>
	
				<div class="container" ng-if="1==0" title="AC Turning off" >
					<?php require_once "VIN_ORHE_ALLOCATION.php"; ?>
				</div>
	
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


