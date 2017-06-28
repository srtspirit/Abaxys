<div class="hidden">
<?php 
session_start();
ob_clean();
?>
</div>

<!-- require_once "../appCscript/VIT_ISSUES.php"; --> 

<?php 
require_once "../stdSscript/stdAppobjGen.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
require_once "../appCscript/VIT_ISSUES.php";

?>

<div>

<table class="table"><tr>
<td>A</td><td>b</td>
<td>A</td><td>b</td>
<td>A</td><td>b</td>
<td>A</td><td>b</td>
<td>A</td><td>b</td>
<td>A</td><td>b</td>
</tr></table>

</div>
<div class="row "  >

<div class="col-sm-1"><input class="ab-borderless" readonly size=25 ng-model="VIT_ISSUE_TICKET" /></div><div class="col-sm-1">b</div>
<div class="col-sm-1"><label ab-label="STD_SEARCH">ALAIN</label></div><div class="col-sm-1">b</div>
<div class="col-sm-1">{{VIT_ISSUE_USER}} adl;;asld  sadl;l;ldas   sdal;l;;lad  asdll;ads</div><div class="col-sm-1">b</div>

<div class="col-sm-1"><input class="ab-borderless" readonly size=15 value="VIT_ISSUE_TICKET  adl;;asld  sadl;l;ldas   sdal;l;;lad  asdll;ads  adl;;asld  sadl;l;ldas   sdal;l;;lad  asdll;ads" /></div>

<div class="col-sm-5"><div class="row">
<div class="col-sm-1">A</div><div class="col-sm-1">b</div>
<div class="col-sm-1">A</div><div class="col-sm-1">b</div>
</div></div>
</div>

   <!--
      Angular data-ng-init - Optional but needed
      If present will execute the $scope functions
      
      -->
<textarea class="hidden" ab-updSuccess="" >

<!-- if (data['posts'].dbFnct == 'dbInsRec')
{
	if( data['posts'].tblInfo.tblName == "vit_issue")
	{
		$scope.idVIT_ISSUE =  data['posts'].insertId;		
		
	}
}
$scope.getIssueData($scope.idVIT_ISSUE);
 -->
</textarea> 

   <form id="mainForm" name="mainForm"  ab-view="vit_issue" ab-main="vit_issue"  >
      		
<?php
	$xtmp = new appForm("VIT_ISSUE");
	$hardCode = <<<BOD
			<div>
				<span ab-empty="{{tbData=='vit_issue'?'vit_issue':'Yes'}}"
				class="" >
				<input a_iref="02-60"
							size=15
							lval=""
							ng-change="VIT_ISSUE_USER=VIT_ISSUE_USERx;FLT_ISSUE_USER=VIT_ISSUE_USER;idVIT_ISSUE=0;ABlstAlias('idVIT_ISSUE','idVIT_ISSUE,FLT_ISSUE_USER','vit_issue','lister');VIT_ISSUE_USERx=FLT_ISSUE_USER;"
							ng-model="VIT_ISSUE_USERx" value=""
							style="{$xtmp->inAttrib['style']}" 
						/>

				</span>
			</div>
			<input class="hidden"   id="FLT_ISSUE" ab-filter="lister" ab-filter-cond="CONTAINS" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  

				ab-filter-model="VIT_ISSUE_USER,VIT_ISSUE_TITLE,VIT_ISSUE_TEXT,VIT_ISSUE_SOLUTION,VIT_ISSUE_CDATE,VIT_ISSUE_TICKET"

				ng-model="FLT_ISSUE_USER" />
BOD;
$grAttr = $xtmp->grAttrib;
$grAttr["style"] .= " container ";
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] ="STD_SEARCH";
$laAttr["style"] .= "font-weight:800;";
$inAttr = $xtmp->inAttrib;

$xtmp->setFieldWrapper("view01","0.0","vit_issue","VIT_ISSUE_USER","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>
      		   
      		<tr>
	                
	                <h3><head>Comments</head></h3>
	                
			</tr>
      
      <div class="col-sm-12 mygrid-wrapper-div ab-border" >   
      
         <table class="table table-striped" > 				  		
		
		<tr ng-repeat="xxx in lister | AB_sortReverse:'VIT_ISSUE_CDATE' "  ng-init="xxx.test=0">		   
		   <td title="{{xxx.exp>0?'Has detail':'No detail'}}">
		   <div class="container"  ng-init="xxx.exp=0" >
		   			
		      				   	
		<div>
				   	<h4>
				   	<a href="#{{opts.Process}}/VIT_ISSUECT/idVIT_ISSUE:{{xxx.idVIT_ISSUE}},updType:UPDATE,Session:VIT_ISSUECT,Process:{{opts.Process}},iSession:{{xxx.VIT_ISSUE_SESSION}},iProcess:{{xxx.VIT_ISSUE_PROCESS}},iSessionDescr:{{xxx.VIT_ISSUE_DESC}}" >
				   	
				   	<span>Edit</span> <span class="glyphicon glyphicon-pencil"></span>
				   	</a>
				   	<span ng-if="xxx.exp>0" style="padding-left:10px;" data-toggle="collapse" data-target="#exp_{{xxx.idVIT_ISSUE}}" class="btn-link glyphicon glyphicon-th-list">
		      		</span>
		      		<span ng-if="xxx.exp<1" style="padding-left:10px;" class="btn glyphicon glyphicon-th-list text-muted">		      		
		      		</span>
				   	<label>{{xxx.VIT_ISSUE_USER}}</label>
				   	&nbsp;-&nbsp;{{xxx.VIT_ISSUE_DESC}}&nbsp;-&nbsp;{{xxx.VIT_ISSUE_TITLE}}&nbsp;(&nbsp;{{xxx.VIT_ISSUE_CDATE}}&nbsp;)&nbsp;&nbsp; 
				   	<br><font size="2" class="text-primary">Ticket No:&nbsp;{{xxx.VIT_ISSUE_TICKET}}</font></br>
				   	<input class="hidden" ng-model"xxx.test" />
				   	</h4>		   	
	    </div>			
							
			<div>
				<h5>
					
			           <div  ng-if="xxx.VIT_IFSSUE_TEXT!=''" >
				          	<label ng-init='xxx.Itext=xxx.VIT_ISSUE_TEXT.split("\n")' >Comment:
				          	</label>
				          	<div class="well" >
					          	<div ng-repeat="itxt in xxx.Itext" >
					          		{{itxt}}&nbsp;
					          	</div>
				          	</div>
				          </div>
			           	<div  ng-if="xxx.VIT_ISSUE_SOLUTION!=''" >
			           		<label ng-init='xxx.Stext=xxx.VIT_ISSUE_SOLUTION.split("\n")' >Solution:
			           		</label>
				          	<div class="well" >
					          	<div ng-repeat="itxt in xxx.Stext" >
					          		{{itxt}}
					          	</div>
				          	</div>
			           	</div>
			        </h5>
	      		</div>	
	      		<div id="exp_{{xxx.idVIT_ISSUE}}" class="collapse">	
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
						
		</div> 

	          </td>  
	                 			   
		</tr>
       </table>
     </div>	
 
 
   </form>
   
</div>