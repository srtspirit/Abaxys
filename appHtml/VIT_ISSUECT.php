<div class="hidden">
<?php 
session_start();
ob_clean();
?>
</div>



<?php 
require_once "../stdSscript/stdAppobjGen.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
require_once "../appCscript/VIT_ISSUES.php"; 


$tFnc = new AB_querySession;
$isAdmin = $tFnc->isUserAdmin();

?>


<div class="AMERICA"  ng-init="SESSION_DESCR='Comment edit'">
  
   <div  >
   <?php require_once "../stdCscript/stdFormButtons.php"; ?>
   
   </div>
   <!-- stdDbButtons contain all update buttons (New - Upd - Del - Share) and has a back button
      The display is initialized by ABclearUpdButtons  and ABinitTbl  - displays back button only
      The display of proper update buttons is maintained by ABchk() automaticly
      All update button call the standard function ABupd() 
      -->	
</div>



<div  class="row" style="padding:0px;padding-top:5px;" >
	
	<div class="col-sm-12" >
	
	
		<ul  class="nav  nav-tabs" >

			<li >
			<span class="text-warning" ng-model="isPartnerOther" >&nbsp;&nbsp;{{isPartnerOther}}</span>
<!-- 
			<label class="btn-xs"   ab-label="STD_CDATE" ></label>
			<span  value="">{{VIT_ISSUE_CDATE}} </span> -->
 			<span ab-label="STD_NEW" ng-if="opts.idVIT_ISSUE == '0'" >Nouveau</span>

			<label class="btn-xs"   ab-label="STD_AUTHOR" ></label>
			<span class="text-primary" value="">:{{VIT_ISSUE_USER}}</span>
			<label class="btn-xs" >&nbsp;&nbsp;Session:&nbsp;</label><span class="text-primary">{{opts.iSession}}&nbsp;</span>
		    <label class="btn-xs" >&nbsp;&nbsp;SessionDescr:&nbsp;</label><span class="text-primary">{{opts.iSessionDescr}}&nbsp;</span>
			
<!-- 			<span class="btn-xs"  ab-label="{{VIT_ISSUE_SESSION}}" ><label class="btn-xs" >&nbsp;&nbsp;SessionDesc:</label>{{opts.iSessionDescr}}</span>
 -->			<label class="btn-xs" >&nbsp;&nbsp;Process:&nbsp;</label><span class="text-primary">{{opts.iProcess}}&nbsp;</span>
			</li>
			
		</ul>	
	</div>
</div>


<div class="row "  >
   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
<textarea class="hidden" ab-updSuccess="" >
if (data['posts']["requestMethod"] == "CREATE")
{	
	$scope.getIssueData(data['posts'].insertId);
}
else
{	
	if (data['posts']["requestMethod"] != "DELETE")
	{			
		$scope.getIssueData($scope.idVIT_ISSUE);
	}
	else
	{			
		$scope.getIssueData(0);
	}
	
}

//if (data['posts'].dbFnct == 'dbInsRec')if( data['posts'].tblInfo.tblName == "vit_issue"){$scope.idVIT_ISSUE =  data['posts'].insertId;}$scope.getIssueData($scope.idVIT_ISSUE); 


</textarea> 
   <form id="mainForm" name="mainForm" ab-context="1"  ab-view="vit_issue" ab-main="vit_issue"  >
      <!--
         ab-main="vgb_cntr" mandatory
         Instructs update process main table to update
         -->
      <div class="col-sm-3">
 	
 	 <h3><head>New Comments</head></h3>

 	<input type="text" class="hidden" ab-btrigger="vit_issue" ng-model="idVIT_ISSUE" />
  	<input type="text" class="hidden" ng-model="VIT_ISSUE_USER" />
  	<input type="text" class="hidden" ng-model="VIT_ISSUE_DESC" />	
 	<input type="text" class="hidden" ng-model="VIT_ISSUE_PROCESS" />
	<input type="text" class="hidden" ng-model="VIT_ISSUE_TICKET" />
	<input type="text" class="hidden" ng-model="VIT_ISSUE_SESSION" /> 	
	<input type="text" class="hidden" ng-model="VIT_ISSUE_TITLE" />
	<input type="textarea" class="hidden" ng-model="VIT_ISSUE_TEXT" />
	<input type="textarea" class="hidden" ng-model="VIT_ISSUE_SOLUTION" />
	<input type="text" class="hidden" ng-model="VIT_ISSUE_COMPDT" /> 
 	<input type="text" class="hidden" ng-model="idVIT_ISSDET" />
 	<input type="text" class="hidden" ng-model="VIT_ISSDET_USER" />		
 	<input type="text" class="hidden" ng-model="VIT_ISSDET_TEXT" />
 	<input type="text" class="hidden" ng-model="VIT_ISSDET_ISSUEID" />
 	<input type="text" class="hidden" ng-model="VIT_ISSUE_USERID" />
 	
	
<?php

$hardCode =<<<EOC


 	<input type="text" class="hidden" ng-model="isAdmin" ng-init="isAdmin='{$isAdmin}'" />
	

EOC;

echo $hardCode;
	

$xtmp = new appForm("VIT_ISSUECT");



	
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="VIT_ISSUE_TITLE";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","0.0","vit_issue","VIT_ISSUE_TITLE","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


 $grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";

$focus = ' onfocus="' . "$(this).attr('rows','4');$(this).attr('cols','30');$(this).css('width','');$(this).css('height','');$(this).css('overflow','auto');" . '" ';

$blur = ' onblur="' . "$(this).css('width','140px');$(this).css('height','20px');$(this).css('overflow','hidden');" . '" ';

$hardCode  = '<table><tr>';

$hardCode .= '<td style="vertical-align:top;" ><label class="text-primary"  ab-label="STD_TEXT_LINE" >Text Line</label>:<textarea style="overflow:hidden;font-size:9pt;" rows="1" cols="18" ' . $focus . $blur . ' ng-model="VIT_ISSUE_TEXT"  > </textarea></td><td>&nbsp;&nbsp;&nbsp;</td>';

$hardCode .= '</tr></table>';
$xtmp->setFieldWrapper("view01","0.122","vit_issue","VIT_ISSUE_TEXT","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
$hardCod  = '<table><tr>';
$hardCod .= '</tr><tr>';
$hardCod .= '<td style="vertical-align:top;" ><label class="text-primary"  ab-label="STD_SOLUTION" >Solution</label>&nbsp:<textarea style="overflow:hidden;font-size:9pt;" rows="1" cols="18" ' .  $focus . $blur  . '" ng-model="VIT_ISSUE_SOLUTION"  > </textarea></td>';
$hardCod .= '</tr></table>'; 
$xtmp->setFieldWrapper("view01","0.122","vit_issue","VIT_ISSUE_SOLUTION","",$grAttr,$laAttr,$inAttr,$hardCod);
echo $xtmp->currHtml;

?>	
<!--  
 -->


<label class="text-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status:</label><input type="text" class="hidd2en" ng-model="VIT_ISSUE_STATUS"  ng-init="isAdmin='1'" />
	
      </div>
      <!--
      
      <div title=" " ng-init="collaps=0">
					  			<span  onclick="$('.collapse').removeClass('in');" class="btn-link " title="">
					  				<span class="glyphicon glyphicon-zoom-out " title=""></span>
					  			</span>
								<span onclick="$('[data-toggle]').click();"  class="btn-lg btn-link " title="">
									<span class="glyphicon glyphicon-zoom-in " title="">
									</span>
								</span>						
	  </div>
-->														
					
      		   
      		<tr>
	                
	                <h3><head> Comments on {{opts.iSessionDescr}}</head></h3>
	                
			</tr>
      
      <div class="col-sm-8 mygrid-wrapper-div ab-border" >   
      
         				  		
		
		<div class="row" ng-repeat="xxx in lister | AB_sortReverse:'VIT_ISSUE_CDATE' "  ng-if="(xxx.VIT_ISSUE_SESSION == opts.iSession&&idVIT_ISSUE==0)||xxx.idVIT_ISSUE==idVIT_ISSUE"  ng-init="xxx.test=0">		   
		
		
		   <div class="container"  ng-init="xxx.exp=0" > 
		   	<div>
		      		
			   
			   	<h4>
				   	<span ng-if="xxx.exp>0" style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{xxx.idVIT_ISSUE}}" class="btn-link glyphicon glyphicon-th-list">
		      		</span>
		      		<span ng-if="xxx.exp<1" style="padding-left:10px;" title="No details" class="btn glyphicon glyphicon-th-list text-muted">
		      		</span>
				   	<label>{{xxx.VIT_ISSUE_USER}}</label>
				   	&nbsp;-&nbsp;{{xxx.VIT_ISSUE_TITLE}}&nbsp;(&nbsp;{{xxx.VIT_ISSUE_CDATE}}&nbsp;)&nbsp;&nbsp; 
				   	<br><font size="2" class="text-primary">Ticket No:&nbsp;{{xxx.VIT_ISSUE_TICKET}}&nbsp; Status:&nbsp;
				   	
				   	<span ng-repeat="sta in statuses" ng-if="xxx.VIT_ISSUE_STATUS==sta.status">
				   	{{sta.text}}
				   	</span>
				   	</font></br>
				   	<input class="hidden" ng-model"xxx.test" />			   	
				</h4>
			</div>			
			<div>
				<h5>	
				<!-- Ranganath I made these mod 20160627 Alain -->
				<!-- You should apply this to all read only text in your scripts  -->
				<!-- Class well give a nice container look -->
				
				          <div  ng-if="xxx.VIT_ISSUE_TEXT!=''" >
				          	<label ng-init='xxx.Itext=ABdisplayText(xxx.VIT_ISSUE_TEXT)' >Comment:
				          	</label>
				          	<div class="well" >
					          	<div ng-repeat="itxt in xxx.Itext" >
					          		{{itxt.text}}&nbsp;
					          	</div>
					          	
					          	
				          	</div>
				          </div>
			           	<div  ng-if="xxx.VIT_ISSUE_SOLUTION!=''" >
			           		<label ng-init='xxx.Stext=ABdisplayText(xxx.VIT_ISSUE_SOLUTION)' >Solution:
			           		</label>
				          	<div class="well" >
					          	<div ng-repeat="itxt in xxx.Stext" >
					          		{{itxt.text}}
					          	</div>
				          	</div>
			           	</div>
			        <!-- Ranganath I made these mod 20160627 Alain END -->
			           	
			        </h5>
	      		</div>	
	      		<div id="exp_{{xxx.idVIT_ISSUE}}" class="collapse in">	
	      				<table >
	      				<tr ng-repeat="issd in xxx.rowSet" ng-if="issd.VIT_ISSDET_ISSUEID == xxx.idVIT_ISSUE">
						
						
						
						<td class="text-primary" style="vertical-align:top;" ng-init="xxx.exp=1">
	      					
	      					{{issd.VIT_ISSDET_USER}}&nbsp;wrote on&nbsp;
	      					<br>{{issd.VIT_ISSDET_CDATE}}</br>
	      					</td>
	      					<td  style="vertical-align:top;" >&nbsp;&nbsp;:</td>
		      				<td style="vertical-align:top;"  ng-if="issd.VIT_ISSDET_TEXT!=''" >
		      					<textarea readonly ng-model="issd.VIT_ISSDET_TEXT" rows=3 cols=40 ></textarea>
		      				</td>
	
	      				</tr>
	      				</table>    				
	      				
	      		</div>           	
			<div>
				 <?php require_once "../appHtml/VIT_ISSDETCT.php"; ?>	
		      	</div>
				
		</div> 
	  
     </div>	
 
</div> 
   </form>
   
</div>