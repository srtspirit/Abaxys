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

<div class="row " ng-init="SESSION_DESCR='User Comments';idVIT_ISSUE=0;ABlstAlias('idVIT_ISSUE','idVIT_ISSUE','vit_issue','vit_issue');DateChk=0;dateCond='AA';" >

<div class="col-lg-12 ab-spaceless">
	<?php require_once "../stdCscript/stdFormButtons.php"; ?>
	<script>
		$('#ab-buttonPad').html('');
		$('#ab-new').html('');
	</script>
	
</div>

<div class="col-sm-2">   
   <form id="mainForm" name="mainForm"   ab-view="vit_issue" ab-main="vit_issue"  >
   <button onclick="doDoc();" >Export</button>
   
<?php
	$xtmp = new appForm("VIT_ISSUE");
	$hardCode = <<<BOD
			<div>
				<span ab-empty="{{tbData=='vit_issue'?'vit_issue':'Yes'}}"
				class="" >
				<input a_iref="02-60"
							size=15
							lval=""
							ng-change="initFilters();VIT_ISSUE_USER=VIT_ISSUE_USERx;FLT_ISSUE_USER=VIT_ISSUE_USER;idVIT_ISSUE=0;ABlstAlias('idVIT_ISSUE','idVIT_ISSUE,FLT_ISSUE_USER','vit_issue','vit_issue');VIT_ISSUE_USERx=FLT_ISSUE_USER;"
							ng-model="VIT_ISSUE_USERx" value=""
							
							
							style="{$xtmp->inAttrib['style']}" 
						/>

				</span>
			</div>
			<input class="hidden"   id="FLT_ISSUE" ab-filter="vit_issue" ab-filter-cond="CONTAINS" ab-filter-cond-exmaples="STARTS,ENDS,CONTAINS,GR,SM,NE,EQ"  

				ab-filter-model="VIT_ISSUE_USER,VIT_ISSUE_TITLE,VIT_ISSUE_TEXT,VIT_ISSUE_SOLUTION,VIT_ISSUE_CDATE,VIT_ISSUE_TICKET,VIT_ISSUE_PROCESS,VIT_ISSUE_SESSION"

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
		$filterSwitch = '<span ng-click='. "'" . 'ACVarFilterToggle("' . $name . '")' . "'" . ' class="bg-primary ab-border ab-pointer ab-spaceless "  >&nbsp;X&nbsp;</span>';
		
		$trn[count($trn)] = '<div id="flt' . $name . '" class=" ACdropdown "  >';
		$trn[count($trn)] = '<div class="ACdropdown-content" >';
		$trn[count($trn)] = '<table style="width:95%;margin:10px;padding:3px;" class="table-striped  ab-spaceless bg-success " role="tablist" >';
		$trn[count($trn)] = ' 	<tr>';


		$trn[count($trn)] = ' 		<td  class="text-top ab-pointer " ';
		$trn[count($trn)] = ' 		ng-click="list' . $name . "='';ACVarFilterInit('" . $name . "','');" . '" >';
		$trn[count($trn)] = ' 		<div  class="ab-pointer" title="Clear all" >&nbsp;&#9744;&nbsp;</div></td>';
//		$trn[count($trn)] = ' 		<td></td>';
		$trn[count($trn)] = ' 		<td title="Select all" class="text-top ab-pointer" ';
		$trn[count($trn)] = ' 		ng-click=";list' . $name . "='-1';ACVarFilterInit('" . $name . "','');" . '" >';

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
		$trn[count($trn)] = '	ng-repeat="varRow in  rawResult.vit_issue | AB_noDoubles:'. "'". $name. "'" .' | AB_Sorted:'."'".$name."'".'  " >';
		$trn[count($trn)] = ' 		<td class="text-center ab-pointer ab-border ab-spaceless" ';
		$trn[count($trn)] = ' 		ng-init="list' . $name . '=list' . $name . " + ',' + varRow." . $name . "+ ','" . ';stat=0" ';
		$trn[count($trn)] = ' 		>';
//		$trn[count($trn)] = ' 		</td>';
//		$trn[count($trn)] = '		<td class="text-left ab-pointer ab-border ab-spaceless"  >';
		
//		$trn[count($trn)] = '		{{ACVarColSetIsOn('. "'" . $name ."',varRow.".$name.')}}';

		$trn[count($trn)] = '			<span ng-click="ACVarColSelToggle('. "'" . $name ."',varRow.".$name.');" class="{{ACVarColSetIsOnA('. "'" . $name ."',varRow.".$name.',$'.'index)==true?'."'':'hidden'}}".'" checked type="checkbox" >';
		$trn[count($trn)] = '			<span class="glyphicon glyphicon-ok"></span></span>';
		$trn[count($trn)] = '			<span ng-click="ACVarColSelToggle('. "'" . $name ."',varRow.".$name.');" class="{{ACVarColSetIsOnA('. "'" . $name ."',varRow.".$name.',$'.'index)!=true?'."'':'hidden'}}".'" type="checkbox" >';
		$trn[count($trn)] = '			<span class="glyphicon glyphicon-ok" style="color:transparent;"></span></span>';
		$trn[count($trn)] = '	        </td>';
		$trn[count($trn)] = ' 		<td>&nbsp;</td>';
		$trn[count($trn)] = ' 		<td>&nbsp;</td>';
		$trn[count($trn)] = '	        <td class="text-left" style="white-space:nowrap;">';
		$trn[count($trn)] = '	        	<span  >';
		$trn[count($trn)] = '	        	<input class="hidden" ng-model="varRow.' . $name . '"  ng-init="ACVarColSelToggle('. "'" . $name ."',varRow.".$name.');" />';
        $trn[count($trn)] = '         <span ng-repeat="sta in statuses" ng-if="varRow.' . $name . '==sta.status;" ng-init="stat=1">';                 
		$trn[count($trn)] = '         {{sta.text}} ';
		
		$trn[count($trn)] = '         </span> '; 
	              
		$trn[count($trn)] = ' <span  ng-if="stat==0">';
		$trn[count($trn)] = ' {{varRow.'. $name. '}}';
        $trn[count($trn)] = ' </span>';		
		$trn[count($trn)] = '  </span>';
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
	$inputStyle = "style='background-color:inherit;' ";
	
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
		
		// $ngclick  = "";
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

<div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ab-spaceless" >
<div>
<?php echo setHeadField("VIT_ISSUE_DESC","15"," Menu Description","1","","","text-primary");  ?>
</div>
<div>
<?php echo setHeadField("VIT_ISSUE_USERID","15"," User Id","1","","","text-primary"); ?>
</div>
<div>
<?php echo setHeadField("VIT_ISSUE_STATUS","15"," Status","1","","","text-primary");  ?>   
</div>
<div><table><tr><td style="white-space:nowrap;vertical-align:top;" class="ab-spaceless"  ng-click="DateChk=1-DateChk;dateSearch();" >
<br>
<span class="ab-border ab-pointer ab-spaceless">
<span class="glyphicon glyphicon-ok " ng-if="DateChk!=0"></span>
<span class="glyphicon glyphicon-ok " ng-if="DateChk==0" style="color:transparent;"></span>
</span>
</td><td style="white-space:nowrap;vertical-align:top;" >
<br>
<span class="text-primary">&nbsp;Date&nbsp;</span>	
</td><td class="ab-spaceless" style="padding-left:15px;padding-top:10px;" >
<?php
	
	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] .= " {{DateChk==1?'':'hidden'}} ab-spaceless"; 
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="STD_FROM";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setDatePick("VIT_ISSUE_CDATE1");
	$xtmp->setFieldWrapper("view01","1.1","vit_issue","VIT_ISSUE_CDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
	
	echo $xtmp->currHtml;
	
	$grAttr = $xtmp->grAttrib;
	$grAttr["class"] .= " {{DateChk==1?'':'hidden'}} ab-spaceless"; 
	$laAttr = $xtmp->laAttrib;
	$laAttr["ab-label"] ="STD_TO";
	$inAttr = $xtmp->inAttrib;
	$hardCode = $xtmp->setDatePick("VIT_ISSUE_CDATE2");
	$xtmp->setFieldWrapper("view01","1.1","vit_issue","VIT_ISSUE_CDATE","",$grAttr,$laAttr,$inAttr,$hardCode);
	
	echo $xtmp->currHtml;
?>
<div>
<button type="button" class="{{DateChk!=0?'':'hidden'}}" ng-click="dateSearch();">Search</button>
</div>
</td></tr></table>

</div>



</div>

<div class="hidden" >
<?php echo setHeadField("VIT_ISSUE_CDATE","15"," Creation Date","1","","","text-primary"); ?>
</div>

</div>
      		   
<div class="col-sm-8 mygrid-wrapper-div ab-border">     		   
<h3><head>Comments</head></h3>         
         
      
         				  		
		
		 
		 
		 
		 <div class="row {{xxx.rowRowLog.hidden}} ab-odd ab-spaceless " id="rNum{{xxx.abIndex}}"    ng-repeat=" xxx in  rawResult.vit_issue | AB_noDoubles:'idVIT_ISSUE' | AB_sortReverse:'VIT_ISSUE_CDATE' "  ng-init="xxx.test=0">		   
		  <div >
		  <div title="{{xxx.exp>0?'Has detail':'No detail'}}">
		   <div class="container"  ng-init="xxx.exp=0" >
		   			
		      				   	
		
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
				   	<br><font size="2" class="text-primary">Ticket No:&nbsp;{{xxx.VIT_ISSUE_TICKET}}&nbsp; Status:&nbsp;<span ng-repeat="sta in statuses" ng-if="xxx.VIT_ISSUE_STATUS==sta.status">
				   	{{sta.text}}
				   	</span></font></br>
				   	
				   	
				   	<input class="hidden" ng-model"xxx.test" />
				   	</h4>		   	
	    			
							
			<div class="col-sm-6">
				<h5>
					
			           <div  ng-if="xxx.VIT_IFSSUE_TEXT!=''" >
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
			        </h5>
	      			
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
						
		     </div> 

	      </div>  
	                 			   
		</div>

 
       
        </div>



       </div>
     </form>
   </div>
   
<script>

function doDoc()
{

var dhtml = "<table>"
$("#excel").find('tr').each(function(){

dhtml += "<tr>"
$(this).find("td").each(function(){
dhtml += "<td>" + $(this).text() + "</td>";
	});
dhtml += "</tr>"	

});

dhtml += "</table>"

var header ="<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:excel' xmlns='http://www.w3.org/TR/REC-html40'><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body>"
var docOut = header + dhtml + "</body></html>"
$("#txt").val(docOut)
$("#go").click()
}

</script>   
<div class="hidden">
<form action="newOut.php" method="post" >
<input id="fName" name="fName" value="SupportData.xls" />
<textarea id="txt" name="txt"></textarea>
<input type="submit" id="go" value="go" />

</form>
<div id="excel">
<table>
<tr>
<td>Date</td>
<td>Ticket#</td>
<td>User</td>
<td>Process</td>
<td>Session</td>
<td>Title</td>
<td>Descr</td>
<td>Status= 100:NEW 200:VIEWED 300 SUBMITTED, 400:PURG 800:COMPLETED 900:CANCEL
<td>Text</td>
<td>Others Wrote</td>
<td>Solution</td>
</tr>
<tr ng-repeat=" xxx in  rawResult.vit_issue | AB_noDoubles:'idVIT_ISSUE' | AB_sortReverse:'VIT_ISSUE_CDATE' " >
<td>{{ xxx.VIT_ISSUE_CDATE }}</td>
<td>#{{ xxx.VIT_ISSUE_TICKET }}</td>
<td>{{ xxx.VIT_ISSUE_USER }}</td>
<td>{{ xxx.VIT_ISSUE_PROCESS }}</td>
<td>{{ xxx.VIT_ISSUE_SESSION }}</td>
<td>{{ xxx.VIT_ISSUE_TITLE }}</td>
<td>{{ xxx.VIT_ISSUE_DESC }}</td>
<td>{{ xxx.VIT_ISSUE_STATUS }}</td>
<td>{{ xxx.VIT_ISSUE_TEXT }}</td>
<td>
<span ng-repeat="issd in xxx.rowSet" ng-if="issd.VIT_ISSDET_ISSUEID == xxx.idVIT_ISSUE">
<textarea>
{{issd.VIT_ISSDET_USER}} wrote on {{issd.VIT_ISSDET_CDATE}}
----
{{issd.VIT_ISSDET_TEXT}}
--------------------------
</textarea>
</td>
</span>
</td>
<td>{{ xxx.VIT_ISSUE_SOLUTION }}</td>
</tr>
</table>   
</div>
</div>