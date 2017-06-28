<?php require_once "../stdSscript/stdAppobjGen.php"; ?>

<div class="hidden">
	<?php require_once "../appCscript/VMS_MESSENGER.php"; ?>
</div>
<div class="hidden">
<?php
session_start();
ob_clean();
require_once "../stdSscript/stdSessionVarQuery.php"; 
$tFnc = new AB_querySession;
$currUsr = $tFnc->getUserData();

?> 
</div>
<div style="margin-left:5px;" ng-init="SESSION_DESCR='User messaging'">

	<div class="ab-spaceless"  >

		<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		
	</div>

<div id="ab-new" class="hidden" >
	<label  title="CREATE" ng-if="idVGB_SVIA>0">
		 <a ng-click="editVgb_svia(0,'');" >
			<span >New</span>
			<span  class="glyphicon glyphicon-pencil" ></span>
		</a>			
	</label>
</div>



	<script>
		$('#ab-appOpt').html('&nbsp;&nbsp;' + $('#ab-new').html());
		$('#ab-new').html('');
		$('#ab-sysOpt').html('');
		
	</script>
	
<div class="hidden">
<textarea class="hidden" ab-updSuccess="" >
A_Scope.callBack = '$scope.editUsrmess($scope.original["idVMS_USRMESS"],<?php echo $currUsr['userMainId']; ?>);';
$scope.initDisplayData(<?php echo $currUsr['userMainId']; ?>);

</textarea>
</div>
<div class="hidden">
<input class="hidden" ng-model="userMainId" ng-init="initDisplayData(<?php echo $currUsr['userMainId']; ?>);" />
</div>

<?php

$userLister = <<<EOC
<div id="sys_userView" class=" ab-container ab-border hidden" style="position:fixed;z-index:1;">
<div class="ab-wrapper-div">
<table class="ab-border ab-spaceless" style="width:100%;" >
<tr class="well text-primary ab-strong">
<td style="width:5%;" ></td>
<td style="width:80%;white-space:nowrap;" class="text-center">Select</td>

<td style="width:5%;" ></td>
<td style="width:10%;" onclick="$('#sys_userView').addClass('hidden');" class="bg-primary text-center ab-pointer" >X</td>
</tr>
</table>
</div>

<div class="ab-wrapper-div ">

<table class="table-striped" style="width:300px;" >
<tr>
<td style="width:1%;" ></td>
<td style="width:60%;" ></td>
<td style="width:3%;" ></td>
<td style="width:35%;" ></td>
<td style="width:1%;" ></td>

</tr>
<tr 	class="ab-pointer"
	ng-repeat="sacc in sys_users" 
	onclick='$("#sys_userView").addClass("hidden");'
	ng-click="updUsrVal(sacc.CFG_USERS_ID);"
	ng-if=" sacc.CFG_USERS_ID!={$currUsr['userMainId']}"
	onmouseover="$(this).addClass('text-primary ab-strong')"
	onmouseout="$(this).removeClass('text-primary ab-strong')"
	>
<td>&nbsp;</td>	
<td style="white-space:nowrap;" >{{sacc.CFG_USERS_DESIGNATION}}&nbsp;</td>
<td>&nbsp;</td>
<td > ({{sacc.CFG_ORGLEVEL_CODE}})</td>
<td>&nbsp;</td>
</tr>
</table>
</div>
</div>

<script>
$("[ng-model='ABsPattern{$sparm["searchResult"]}']").focus(function()
{
	$("#sys_userView").removeClass("hidden");
	$("#sys_userSelect").addClass("hidden");

});


</script>

EOC;


$userFilter = <<<EOC
<div id="sys_userSelect" class=" ab-container ab-border hidden" style="position:fixed;z-index:1;">
<div class="ab-wrapper-div">
<table class="ab-border ab-spaceless" style="width:100%;" >
<tr class="well text-primary ab-strong">
<td style="width:5%;" ></td>
<td style="width:80%;white-space:nowrap;" class="text-center">
<table style="width:100%;">
<tr>
<td  style="width:40%;">
<span class="{{ userFilter.length>0?'':'hidden'}} ab-pointer  text-primary" ng-click="setUserFilter(0);">
Clear
</span>
</td>
<td  style="width:60%;">
Selections 

(
<span class="{{userFilter.length==0?'':'hidden'}}" ab-label="STD_ALL">tous</span>
<span class="{{userFilter.length>0?'':'hidden'}}" >{{userFilter.length}}</span>
}
</td>
</tr>
</table>
</td>

<td style="width:5%;" ></td>
<td style="width:10%;" onclick="$('#sys_userSelect').addClass('hidden');" class="bg-primary text-center ab-pointer" >X</td>
</tr>
</table>
</div>

<div class="ab-wrapper-div ">

<table class="table-striped" style="width:300px;" >
<tr>
<td style="width:1%;" ></td>
<td style="width:60%;" ></td>
<td style="width:3%;" ></td>
<td style="width:35%;" ></td>
<td style="width:1%;" ></td>

</tr>
<tr 	class="ab-pointer"
	ng-repeat="sacc in sys_users" 
	ng-click="setUserFilter(sacc.CFG_USERS_ID);"
	ng-if=" sacc.CFG_USERS_ID!={$currUsr['userMainId']}"
	onmouseover="$(this).addClass('text-primary ab-strong')"
	onmouseout="$(this).removeClass('text-primary ab-strong')"
	>
<td></td>
<td style="white-space:nowrap;" >{{sacc.CFG_USERS_DESIGNATION}}&nbsp;</td>
<td>&nbsp;</td>
<td >
({{sacc.CFG_ORGLEVEL_CODE}})
<span class="{{isUserSelected(sacc.CFG_USERS_ID)?'':'invisible'}}" >
<span class="glyphicon glyphicon-ok" title=""></span>
</span>

</td>
<td>&nbsp;</td>
</tr>
</table>
</div>
</div>

<script>
$("[ng-model='ABsPattern{$sparm["searchResult"]}']").focus(function()
{
	$("#sys_userSelect").removeClass("hidden");
	$("#sys_userView").addClass("hidden");

});


</script>

EOC;


?>
	<div class="row">
		<div class="col-lg-3 ab-spaceless" style="padding-left:10px;padding-top:20px;" ng-init="displayPage=0" >
			<div class="{{displayPage==0?'':'hidden'}}" >
			<div>
				<h4 class="text-primary ab-strong">
				&nbsp; Messages Received
				</h4>
				<div class="ab-wrapper-divsm ">
					<table class="table-striped" style="width:100%;" >
						<tr ng-repeat="stat in vms_usrmess_lst | AB_noDoubles:'VMS_USRMESS_DSTUSR' "
						ng-if="stat.VMS_USRMESS_ORGUSR!=<?php echo $currUsr['userMainId']; ?> "  >
							<td> 
								<table style="width:100%;" ng-repeat="det in vms_usrmess_lst" 
								ng-if="det.VMS_USRMESS_DSTUSR==stat.VMS_USRMESS_DSTUSR && det.VMS_USRMESS_ORIGIN == '1'">
									<tr>
										<td style="width:80%;">
										</td>
										<td style="width:20%;">
										</td>	
									</tr>				
									<tr>
										<td class="text-right">
										<span class="ab-strong small">{{det.VMS_USRMESS_TSTAMP}}</span>&nbsp;
										<span class="text-primary" ab-label="STD_FROM"></span>
										<span class="small ab-strong" 
										ng-repeat="usr in sys_users | AB_noDoubles:'CFG_USERS_ID' " 
										ng-if="usr.CFG_USERS_ID == det.VMS_USRMESS_ORGUSR"
										>
											{{ usr.CFG_USERS_DESIGNATION }} ({{usr.CFG_ORGLEVEL_CODE}})
										</span>
										</td>
										<td class="text-center ab-strong" >
											<span class="text-primary  ab-pointer" ng-click="editUsrmess(det.idVMS_USRMESS,<?php echo $currUsr['userMainId']; ?>);">Reply</span>
										</td>	
					
									</tr>
									<tr ng-init="det.mess = ABdisplayText(det.VMS_USRMESS_MTEXT);">
										<td colspan=3 class="small">
																			
											<span class="text-success ab-strong" >{{det.mess[0].text}}</span>
											&nbsp;<b>...</b>
										</td>
									</tr>			
									<tr class="ab-border ab-spaceless">
		
										<td style="font-size:2pt;"></td>
									</tr>			
									
								</table>
							</td>
						</tr>
					</table>
				</div>	
			</div>
			<div >
				<h4 class="text-primary ab-strong">
				&nbsp;Sent messages
				</h4>
				<div class="ab-wrapper-divsm ">
					<table class="table-striped" style="width:100%;" >
						<tr ng-repeat="stat in vms_usrmess_lst | AB_noDoubles:'VMS_USRMESS_ORGUSR' "
						ng-if="stat.VMS_USRMESS_ORGUSR==<?php echo $currUsr['userMainId']; ?> " >
							<td> 
								<table style="width:100%;" ng-repeat="det in vms_usrmess_lst" 
								ng-if="det.VMS_USRMESS_ORGUSR==stat.VMS_USRMESS_ORGUSR && det.VMS_USRMESS_ORIGIN == '1'">
									<tr>
										<td style="width:80%;">
										</td>
										<td style="width:20%;">
										</td>	
									</tr>				
									<tr>
										<td class="text-right">
										<span class="ab-strong small">{{det.VMS_USRMESS_TSTAMP}}</span>&nbsp;
										<span class="text-primary" ab-label="STD_TO " >To</span>
										<span class="small ab-strong" 
										ng-repeat="usr in sys_users | AB_noDoubles:'CFG_USERS_ID' " 
										ng-if="usr.CFG_USERS_ID == det.VMS_USRMESS_DSTUSR"
										>
											{{ usr.CFG_USERS_DESIGNATION }} ({{usr.CFG_ORGLEVEL_CODE}})
										</span>
										</td>
										<td class="text-center ab-strong" >
											<span class="text-primary  ab-pointer" ng-click="editUsrmess(det.idVMS_USRMESS,<?php echo $currUsr['userMainId']; ?>);">Reply</span>
										</td>	
					
									</tr>
									<tr ng-init="det.mess = ABdisplayText(det.VMS_USRMESS_MTEXT);">
										<td colspan=3 class="small">
																		
											<span class="text-success ab-strong" >{{det.mess[0].text}}</span>
											&nbsp;<b>...</b>
										</td>
									</tr>			
									<tr class="ab-border ab-spaceless">
		
										<td style="font-size:2pt;"></td>
									</tr>			
									
								</table>
							</td>
						</tr>
					</table>
				</div>	
			</div>
			
			</div>
			<div class="{{displayPage==1?'':'hidden'}} ab-wrapper-div" >
			<div >
				<h4 class="text-primary ab-strong">
				&nbsp; Messages Received
				</h4>
				<div >
					<table class="table-striped" style="width:100%;" >
						<tr ng-repeat="stat in vms_usrmess_hist | AB_noDoubles:'VMS_USRMESS_DSTUSR' "
						ng-if="stat.VMS_USRMESS_ORGUSR!=<?php echo $currUsr['userMainId']; ?> "  >
							<td> 
								<table style="width:100%;" ng-repeat="det in vms_usrmess_hist" 
								ng-if="det.VMS_USRMESS_DSTUSR==stat.VMS_USRMESS_DSTUSR && det.VMS_USRMESS_ORIGIN == '1'">
									<tr>
										<td style="width:80%;">
										</td>
										<td style="width:20%;">
										</td>	
									</tr>				
									<tr>
										<td class="text-right">
										<span class="ab-strong small">{{det.VMS_USRMESS_TSTAMP}}</span>&nbsp;
										<span class="text-primary" ab-label="STD_FROM"></span>
										<span class="small ab-strong" 
										ng-repeat="usr in sys_users | AB_noDoubles:'CFG_USERS_ID' " 
										ng-if="usr.CFG_USERS_ID == det.VMS_USRMESS_ORGUSR"
										>
											{{ usr.CFG_USERS_DESIGNATION }} ({{usr.CFG_ORGLEVEL_CODE}})
										</span>
										</td>
										<td class="text-center ab-strong" >
											<span class="text-primary  ab-pointer" ab-label="STD_VIEW" ng-click="editUsrmess(det.idVMS_USRMESS,<?php echo $currUsr['userMainId']; ?>);">View</span>
										</td>	
					
									</tr>
									<tr ng-init="det.mess = ABdisplayText(det.VMS_USRMESS_MTEXT);">
										<td colspan=3 class="small">
																			
											<span class="text-success ab-strong" >{{det.mess[0].text}}</span>
											&nbsp;<b>...</b>
										</td>
									</tr>			
									<tr class="ab-border ab-spaceless">
		
										<td style="font-size:2pt;"></td>
									</tr>			
									
								</table>
							</td>
						</tr>
					</table>
				</div>	
			</div>
			<div>
				<h4 class="text-primary ab-strong">
				&nbsp;Sent messages
				</h4>
				<div>
					<table class="table-striped" style="width:100%;" >
						<tr ng-repeat="stat in vms_usrmess_hist | AB_noDoubles:'VMS_USRMESS_ORGUSR' "
						ng-if="stat.VMS_USRMESS_ORGUSR==<?php echo $currUsr['userMainId']; ?> " >
							<td> 
								<table style="width:100%;" ng-repeat="det in vms_usrmess_hist" 
								ng-if="det.VMS_USRMESS_ORGUSR==stat.VMS_USRMESS_ORGUSR && det.VMS_USRMESS_ORIGIN == '1'">
									<tr>
										<td style="width:80%;">
										</td>
										<td style="width:20%;">
										</td>	
									</tr>				
									<tr>
										<td class="text-right">
										<span class="ab-strong small">{{det.VMS_USRMESS_TSTAMP}}</span>&nbsp;
										<span class="text-primary" ab-label="STD_TO " >To</span>
										<span class="small ab-strong" 
										ng-repeat="usr in sys_users | AB_noDoubles:'CFG_USERS_ID' " 
										ng-if="usr.CFG_USERS_ID == det.VMS_USRMESS_DSTUSR"
										>
											{{ usr.CFG_USERS_DESIGNATION }} ({{usr.CFG_ORGLEVEL_CODE}})
										</span>
										</td>
										<td class="text-center ab-strong" >
											<span class="text-primary  ab-pointer" ab-label="STD_VIEW" ng-click="editUsrmess(det.idVMS_USRMESS,<?php echo $currUsr['userMainId']; ?>);">View</span>
										</td>	
					
									</tr>
									<tr ng-init="det.mess = ABdisplayText(det.VMS_USRMESS_MTEXT);">
										<td colspan=3 class="small">
																		
											<span class="text-success ab-strong" >{{det.mess[0].text}}</span>
											&nbsp;<b>...</b>
										</td>
									</tr>			
									<tr class="ab-border ab-spaceless">
		
										<td style="font-size:2pt;"></td>
									</tr>			
									
								</table>
							</td>
						</tr>
					</table>
				</div>	
			</div>			

			</div>
			
			
		</div>	
		
		<div class="col-lg-7 ab-spaceless " style="margin-left:10px;" >

			
				<table style="width:100%;">
					<tr>
						<td style="width:15%;" class="text-center">
							<span ng-click="displayPage=0" class="well ab-pointer ab-border ab-spaceless {{displayPage==0?'text-primary':''}}">
								<span class="glyphicon glyphicon-ok {{displayPage==0?'':'invisible'}}" title=""></span>
								&nbsp;Current&nbsp;
								<span class="glyphicon glyphicon-ok invisible" title=""></span>
							</span>
						</td>	
						<td style="width:15%;" class="text-center">
							<span ng-click="displayPage=1" class="well ab-pointer ab-border ab-spaceless {{displayPage==1?'text-primary':''}}">
								<span class="glyphicon glyphicon-ok {{displayPage==1?'':'invisible'}}" title=""></span>
								&nbsp;Archives&nbsp;
								<span class="glyphicon glyphicon-ok invisible" title=""></span>
							</span>
						</td>	
						<td style="width:50%;" >
				
							<div  class="{{displayPage==1?'':'hidden'}}" >
								<table style="width:100%;">
								<tr>
									<td style="width:50%;">
									</td>
				
									<td style="width:30%;">
										<?php echo $userFilter; ?>
									</td>
									<td style="width:10%;">
									</td>					
								
								</tr>
								<tr>
									<td>
										<span class="text-primary ab-strong" ab-label="STD_SEARCH" ></span>
										<input class="small" ng-model="searchPattern" />
									</td>
									<td class="text-center" >
										<span class="ab-pointer text-primary ab-strong" onclick='$("#sys_userSelect").removeClass("hidden");'>
											Users
											(
											<span class="{{userFilter.length==0?'':'hidden'}}" ab-label="STD_ALL">tous</span>
											<span class="{{userFilter.length>0?'':'hidden'}}" >{{userFilter.length}}</span>
											)
											<span class="caret"></span>
										</span>
									</td>
									<td>
										<span class="btn btn-success btn-sm ab-spaceless ab-strong" 
											ng-click="searchHistoryData(<?php echo $currUsr['userMainId']; ?>);" >
											<span ab-label="STD_SUBMIT" ></span>
										</span>
									</td>
								</tr>
														
								</table>
										
								
							</div>						
						</td>	
						<td style="width:20%;" ></td>
					</tr>
				</table>
			
				<table class="ab-border" style="width:100%;" >
					<tr >
						<td style="width:10%;vertical-align:top;">
						</td>
						<td style="width:70%;vertical-align:top;">

							<input class="hidden" ng-model="idVMS_USRMESS" />
							<input class="hidden" ng-model="VMS_USRMESS_CONVID" />
							<input class="hidden" ng-model="VMS_USRMESS_DSTUSR" />
							<input class="hidden" ng-model="VMS_USRMESS_ORGUSR" />
							
						</td>
						<td style="width:20%;vertical-align:top;">
						</td>
					</tr>
					<tr>
						<td colspan=2>
							<table class="table-striped" style="width:100%;" >
								<tr>
									<td style="width:50%;">
										<span class="ab-pointer text-primary ab-strong" ng-click="setNewMessage(<?php echo $currUsr['userMainId']; ?>);">
										<span class="glyphicon glyphicon-pencil"></span>
										New message
										</span>
									</td>
									<td>
										<table class="{{isNewMessage()==false && original.VMS_USRMESS_ORGUSR==<?php echo $currUsr['userMainId']; ?>?'':'hidden' }}" >
											<tr>
												<td>
													<span ng-click="setUpdate();" 
													class="{{VMS_USRMESS_READ == '0'?'':'hidden'}} btn btn-success btn-sm ab-spaceless ab-strong" >
														&nbsp;
													 	<span ab-label="STD_COMPLETED"></span>
													 	&nbsp;
													</span>
													<span ng-click="setUpdate();" 
													class="{{VMS_USRMESS_READ == '1'?'':'hidden'}} btn btn-success btn-sm ab-spaceless ab-strong" >
														&nbsp;
													 	<span ab-label="STD_OPEN"></span>
													 	&nbsp;
													</span>
													
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
						
					</tr>
					<tr>
						<td colspan=3 class="text-right small ab-strong" >
						&nbsp;	
						</td>
					</tr>					
					<tr>	
						<td></td>
						<td > 
							<table>
								<tr class=" {{isNewMessage()?'hidden':''}} ">
									<td>
										<span class="text-primary ab-strong" ab-label="STD_DATE"></span>
										&nbsp;
									</td>
									<td>	
										{{ original.VMS_USRMESS_TSTAMP }}
									</td>
								</tr>
								<tr><td style="font-size:2pt;">&nbsp;</td></tr>							
								<tr>
									<td>
										<span class="text-primary {{isNewMessage()?'hidden':''}} ab-strong" ab-label="STD_FROM"></span>
										<span class="{{isNewMessage()?'':'hidden'}}" >
											<span class="ab-pointer text-primary ab-strong" onclick='$("#sys_userView").removeClass("hidden");'>
												Select To
												<span class="caret"></span>
											</span>
											
										</span>	
										&nbsp;
										
									</td>
									<td>
										<?php echo $userLister; ?>
										<span class="text-muted ab-strong {{isNewMessage()?'':'hidden'}}"  
										ng-repeat="usr in sys_users | AB_noDoubles:'CFG_USERS_ID' " 
										ng-if="usr.CFG_USERS_ID == VMS_USRMESS_DSTUSR && usr.CFG_USERS_ID!=<?php echo $currUsr['userMainId']; ?>"
										>
											{{ usr.CFG_USERS_DESIGNATION }} ({{usr.CFG_ORGLEVEL_CODE}})
										</span>	
																				
										<span class="text-muted ab-strong {{isNewMessage()?'hidden':''}} " >
											<span ng-repeat="usr in sys_users | AB_noDoubles:'CFG_USERS_ID' " 
											ng-if="usr.CFG_USERS_ID == original.VMS_USRMESS_ORGUSR"
											>
												{{ usr.CFG_USERS_DESIGNATION }} ({{usr.CFG_ORGLEVEL_CODE}})
											</span>	
											<span class="{{original.VMS_USRMESS_ORGUSR==<?php echo $currUsr['userMainId']; ?>?'':'hidden'}}">
												&nbsp;&nbsp;
												<span class="text-primary ab-strong" ab-label="STD_TO"></span>
												&nbsp;
												<span ng-repeat="usr in sys_users | AB_noDoubles:'CFG_USERS_ID' " 
												ng-if="usr.CFG_USERS_ID == original.VMS_USRMESS_DSTUSR"
												>
													{{ usr.CFG_USERS_DESIGNATION }} ({{usr.CFG_ORGLEVEL_CODE}})
												</span>	
											
										</span>
											
									</td>
								</tr>
								<tr><td style="font-size:2pt;">&nbsp;</td></tr>
								<tr>	
									<td>
										<span class="text-primary ab-strong" ab-label="STD_PRIORITY"></span>
										&nbsp;
									</td>
									<td>	
										<div class="{{isNewMessage()?'':'hidden'}}">
										<?php
											//2,085	 	VSL_ORHE_PRLEV
											$xtmp = new appForm("VSL_ORDERS");
											$hc = $xtmp->setEnumField("vms_usrmess","VMS_USRMESS_PRLEV");
											echo $hc;							
										?>		
										</div>					
										<div class="{{isNewMessage()?'hidden':''}}">
										<?php
											//2,085	 	VSL_ORHE_PRLEV
											$xtmp = new appForm("VSL_ORDERS");
											$hc = $xtmp->setEnumDisplay("vms_usrmess","VMS_USRMESS_PRLEV");
											echo $hc;							
										?>		
										</div>					
									</td>
								</tr>
							</table>
						</td>
							
					</tr>

					<tr>
						<td colspan=3 class="text-right small ab-strong" >
						&nbsp;	
						</td>
					</tr>					
					<tr class="{{isNewMessage()?'hidden':''}}">
						<td class="text-right small ab-strong" style="vertical-align:top;">
							<span class="text-primary" ab-label="STD_ORIGINAL" ></span>&nbsp;
							<span class="text-primary" ab-label="STD_MESSAGE" ></span>&nbsp;
						</td>
						<td  class="ab-strong" >
							<div class="well ab-spaceless" style="padding:5px;">
								<div ng-repeat="mess in originalText">
								{{mess.text}}
								</div>
							</div>
							<div class="ab-wrapper-divsm" >
							<div ng-repeat="rpl in vms_usrmess_detail" ng-if="rpl.VMS_USRMESS_ORIGIN!='1'">
								<table style="width:100%;">
									<tr>
										<td style="width:5%">
										</td>
										<td style="width:5%">
										</td>
										<td style="width:60%">
										</td>
										<td style="width:30%">
										</td>
									</tr>
									<tr>
										<td></td>
										<td colspan=2>
											<span class="text-muted ab-strong" 
											ng-repeat="usr in sys_users | AB_noDoubles:'CFG_USERS_ID' " 
											ng-if="usr.CFG_USERS_ID == rpl.VMS_USRMESS_ORGUSR 
											&& rpl.VMS_USRMESS_ORGUSR!=<?php echo $currUsr['userMainId']; ?> "
											>
												{{ usr.CFG_USERS_DESIGNATION }} ({{usr.CFG_ORGLEVEL_CODE}})
											</span>	
											<span ng-if="rpl.VMS_USRMESS_ORGUSR==<?php echo $currUsr['userMainId']; ?> ">
											You
											</span>
											&nbsp;wrote on {{rpl.VMS_USRMESS_TSTAMP}}
										</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>		
											<span ng-init="rpl.mess = ABdisplayText(rpl.VMS_USRMESS_MTEXT)" ></span>
											<div  class="well text-success ab-spaceless" style="padding:5px;" >
												<div ng-repeat="mess in rpl.mess">
													{{mess.text}}
												</div>
											</div>
										</td>
									</tr>
								</table>	
								
								
							</div>
							</div>							
						</td>
					</tr>
					<tr>
						<td colspan=3 class="text-right small ab-strong" >
						&nbsp;	
						</td>
					</tr>					
					<tr class="{{VMS_USRMESS_READ == '1'?'hidden':''}}" >
						<td class="text-right small ab-strong" style="vertical-align:top;" >
						<span class="text-primary" ab-label="STD_MESSAGE" ></span>&nbsp;
						</td>
						<td  class="ab-strong" >
							<table>
								<tr>
									<td>
										<textarea placeholder="message" ng-model="VMS_USRMESS_MTEXT" cols=40 rows=5 ></textarea>
									</td>
									<td>&nbsp;</td>
									<td style="vertical-align:top;" >	
										<span ng-click="conditionSend();" 
										class="btn btn-success btn-sm ab-spaceless ab-strong" >
											&nbsp;
										 	<span ab-label="STD_SEND"></span>
										 	&nbsp;
										</span>
									</td>
								</tr>
							</table>	

						</td>
					</tr>
					<tr>
						<td class="text-right small ab-strong" >
						</td>
						<td  class="ab-strong" >
						</td>
					</tr>
				</table>				
			<form id="mainForm" name="mainForm"   ab-view="vms_usrmess" ab-main="vms_usrmess" ab-context="1" >
				<input class="hidden" ab-btrigger="vms_usrmess" ng-model="idVMS_USRMESS"   /> 
				<input class="hidden" ng-model="VMS_USRMESS_CONVID" />
				<input class="hidden" ng-model="VMS_USRMESS_DSTUSR" />
				<input class="hidden" ng-model="VMS_USRMESS_ORGUSR" />
				<input class="hidden" ng-model="VMS_USRMESS_READ" />
				<input class="hidden" ng-model="vmsUpdateFlag" />
				<input class="hidden" ng-model="vmsUpdateId" />

			</form>				
		
		</div>
		<div class="col-lg-2 ab-spaceless" >
		
		</div>
	</div>


<span class="hidden" id="openUdateConfirm" data-toggle="modal" data-target="#updateConfirm" ></span>	
<div id="updateConfirm" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span  >{{messUpdateMethod}} </span> </h4>
        
      </div>
      <div class="modal-body">
	<table  style="width:100%;" >
		<tr>
			<td colspan=2 class="text-primary" ><label>{{updateConfirmMessage}}</label></td>        				
		</tr>
		<tr ng-if="messUpdateMethod!='ERROR'" >
			<td >
				<span class="btn btn-success btn-sm" ng-if="messUpdateMethod=='Complete'" ng-click="localupd('COMPLETE');"  data-dismiss="modal">
					Update Complete 
				</span>
				<span class="btn btn-success btn-sm" ng-if="messUpdateMethod=='Open'" ng-click="localupd('OPEN');"  data-dismiss="modal">
					Update re-Open
				</span>
				
			</td>
			<td >
				<span class="btn btn-success btn-sm" data-dismiss="modal">
					Cancel
				</span>
			</td>
		</tr>		        					
		<tr ng-if="messUpdateMethod=='ERROR'" >
			<td colspan=2 style="padding-left:30px;">
				<div ng-repeat="reason in updateConfirmError" >
				<label>{{ reason.text }}</label>
				</div> 	
				<div>&nbsp;</div>
				<div class="btn btn-success btn-sm" data-dismiss="modal">
					OK 
				</div>
			</td>
		</tr>				
	
	</table>
      </div>

    </div>

  </div>
	
<script>
$('[ab-select="app"]').addClass("hidden");
</script>