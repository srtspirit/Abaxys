<?php
ini_set("display_errors", "0");
error_reporting(E_ALL);
  session_start();
       ob_clean();
if(!isset($_SESSION['AB_DUSA']['userMainId'])) {
 	header('Location:../login.php');
}
// User parameters Tempo
require_once "stdSscript/stdDBClass.php";
require_once "stdSscript/stdUsersSetting.php";
require_once "stdSscript/stdSessionVarQuery.php";
// AC 20170326 removed 
require_once "stdSscript/stdSessionVarQueryFun.php";
require_once "stdSecurity/userSecuritySetup.php";
require_once "stdHtml/StylesAnJqBootScripts.php";
// require_once "stdHtml/stdJQextInputMask.php"; To be implemented
require_once "stdSscript/stdPHPfunctions.php";


?>


  <script>
   <?php  require_once "stdCscript/SessionVarScripts.php";  ?>
  </script>

  <script>
  
  <?php require_once "stdCscript/stdScopeFunctions.php";?>
   <?php require_once "stdCscript/standardRoutines.php";?>
   </script>

  <script>
   <?php require_once "stdCscript/standardControllers.php";?>
   </script>
   <script src="extScripts/dirPagination.js"></script>



  <script type="text/javascript">
//Define an angular module for our app

var A$_ProcessFn = new A_Process()

function A_Process()
{
	this.processId = 652267
	
}

A_Process.prototype.A$getProp = function ()
{
	
	var result = "Main";
	return result;

}

//alert($A_ProcessFn.getProp())





  </script>
  

 
</head>
<body ng-app="AbaxysApp"  class="ab-body ab-container" ng-cloak onbeforeprint="abPrintOut();" 
onload="if(window.name.indexOf('ab-frm.')!=0){$('[ab-obj]').removeClass('hidden');}else{$('[ab-obj]').remove();$('#abSession').attr('class','col-sm-12'); };"

>
<input type="hidden" id="ab-mainlst" ab-value="#default" value="#default" />

<?php 

	/*$wAccess = false;
	if (strpos("X".$_SESSION["logged"],"NESH.") == 1)
	{
		$wAccess = true;
	}
	
	if (strpos("X".$_SESSION["logged"],"AEB.") == 1)
	{
		$wAccess = true;
	}
	
	if (strpos("X".$_SESSION["logged"],"NIALA") == 1)
	{
		$wAccess = true;
	}

	if (strpos("X".$_SESSION["logged"],"LEOCHARLES") == 1)
	{
		$wAccess = true;
	}

	if ($wAccess == false)
	{
		//$_SESSION["AB_DUSA"] = "";
	}
	*/
	
	
	
	// if (strpos("X".$_SESSION["logged"],"NIALA") == 1)
	if (1 == 1)
	{

?>

	
<?php
	}
?>	
	
		
		<!--  <a href="#ABM_Scripts" >ABM Scripts</a> -->

<div class="row" class="bg-primary  " style="margin-left:40px;margin-right:40px;" oldStyle="b22ackground-color:DodgerBlue" >

	<div ab-obj="menu" class="col-sm-1 bg-primary hidden hidden-sm hidden-xs" colors="" style="min-height:61px;text-align:right;" >
		<a href="#x" >
			<img ab-obj="menu" src="stdImages/logo/Abaxys4Bleu.png"  />
		</a>
	</div>
	<div ab-obj="menu" class="col-sm-1 hidden visible-sm visible-xs" colors=""  >
		<a href="#x" >
			<img ab-obj="menu" width="60" height="60" src="stdImages/logo/Abaxys4Bleu.png"  />
		</a>
	</div>	
			
	<div ab-obj="menu" class="col-sm-11 hidden" colors="" style="min-height:73px;" >
		<?php require_once "stdHtml/SessionOrgMenu.php"; ?>
		<input type="hidden" style="color:black;" onchange="$('[colors]').css('background-color',this.value);" />
	</div>
	
	
	
</div>	

<div class="row " style="margin-left:40px;margin-right:40px;" >

	<div id="abSession" class="col-sm-12" >

		<div ab-obj="menu" class=" hidden">
			<div class="row" >

				<div class="col-sm-12 ab-spaceless" ab-select="app">
					
					<div  ng-init="TestController();" >
		
						<?php require_once "stdHtml/SessionUsrMenu.php"; ?>
		
					</div>
					<div>&nbsp;</div>
				</div>  
			</div>
		</div>
	
	  
	
		<div class="ab-container"  >
	
			<div>
				<div id="ab-SesMenu"></div>
				<div id="ab-main" ng-view="" ></div>
				
			</div>
			<div id="ab-reportRow"></div>
			<div id="ab-reportPdf" class="hidden" >
				<div >
					<div >
					  	<textarea  ab-model="ab-pdp-txt" ></textarea>
					
						
						<form id="ab-pdf-MainForm" action="AppPdfFormats/tcpdf/documents/formExec.php" method="post" 
						target="ABviewForm"  ab-target="ABviewForm">
							
							<input name="EXAMPLE" class="hdiden small" size=10 value="AB_basePdfForm.php" />
							<input name="reportName" id="ab-pdf-TextName"  value="Report" />
							<textarea name="html" id="ab-pdf-TextId" class="hidden small" >
							</textarea>
		
							<input ab-form-id="PDF" type="submit" value="View" />
					
						</form>
					</div>
					
		
				</div>				
			</div>
			<div class="row" >
				
				<div class="col-sm-6" >
					<small class='small'  ></small>						
				</div>
				<div class="col-sm-6 small " >
					
										
				</div>
			</div>
			<div class='row btn-xs '>
				<div class='col-sm-2 btn-xs hidden' >
					<label class="btn-xs" [=LBL=]STD_DIVISION_BR[=LBL=]>Branch</label>:&nbsp;
					<label class="btn-xs" >&nbsp;
						<?php 
							// OLD echo $_SESSION["AB_DUSA"]['user']['dimlevelTR'];
							
							// New requires stdSessionVarQuery.php
							
							$wfnc = new AB_querySession;
							$curr = $wfnc->getCurrentAffect();
							
							echo $curr.levelDescr;
						?>
						
					</label>
					
				</div>
			
				<div class='col-sm-10 btn-xs ' >
				
				</div>
			</div>	
		</div>
	</div>
	<div ab-obj="menu" class="col-sm-1">
	
	</div>
</div>				
<div id="rBuffer"></div>
<span id="bug"></span>

	<div class="visible-lg"  style="position:fixed;z-index:5;top:50px;vertical-align:top;">
	<table   >
	<tr><td style="vertical-align:top;">
		<img width=40 height=40 class="btn " src="stdImages/buttons/A_Blank.png"
		value="inline" 
		onclick="$('[debug]').children().css('display',this.value);this.value=='none'?this.value='inline':this.value='none';$(this).css('display','inline');"
		/>
		 
		
	</td>
	<td debug colspan=3 style="vertical-align:top;">
	
		<span class="btn btn-primary" style="display:none;vertical-align:top;" onclick="conClear()">Console Clear</span> 
		<span class="btn btn-primary" style="display:none;vertical-align:top;" onclick="$('#sesVar').toggleClass('hidden');">Sesssion Var</span> 	
		<div id="sesVar" class="hidden ab-border bg-warning">
				<?php		
					echo "<div>";
					echo "<br>&nbsp;&nbsp;&nbsp;&nbsp; <button type='button' class='btn btn-link btn-xs text-muted' data-toggle='collapse' data-target='#Session'>Session Var:\$_SESSION</button>";
					echo "<div id='Session' class='collapse' ><textarea cols=70 rows=10>";
					echo getProps($_SESSION,"","_SESSION");
					echo "</textarea></div></div>";
	
					echo "<div>";
					echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-link btn-xs text-muted' data-toggle='collapse' data-target='#AB_CTRLorgTables'>Organisation: AB_DUSA</button>";
					echo "<div id='AB_CTRLorgTables' class='collapse' ><textarea cols=70 rows=10>";
					// echo getProps($_SESSION["AB_DUSA"]['orgTables'],"","A_Ctrl.orgTables");
					echo getProps($_SESSION["AB_DUSA"],"","AB_DUSA");
					echo "</textarea></div></div>";
	
					echo "<div>";
					echo "<br>&nbsp;&nbsp;&nbsp;&nbsp; <button type='button' class='btn btn-link btn-xs text-muted' data-toggle='collapse' data-target='#AB_CTRLusrLevels'>User Levels: AB_CTRL</button>";
					echo "<div id='AB_CTRLusrLevels' class='collapse' ><textarea>";
					// echo getProps($_SESSION["AB_CTRL"]['usrLevels'],"","A_Ctrl.usrLevels");
					echo getProps($_SESSION["AB_CTRL"],"","AB_CTRL");
					echo "</textarea><br>";
					echo "<textarea cols=70 rows=10>";
					// echo getProps($_SESSION["AB_CTRL"]['usrTables'],"","A_Ctrl.usrTables");
					echo "</textarea><br>";
					echo "<textarea cols=70 rows=10>";
					// echo getProps($_SESSION["AB_CTRL"]['usrSessions'],"","A_Ctrl.usrSessions");
					echo "</textarea></div></div>";
				?>
		</div>
		<div style="display:none;">
			<span class="ab-colors">		
			<br><br>&nbsp;&nbsp;
			focusGrid
			<br>
			</span>
			<textarea  cols=30 rows=5 id="focusGrid" >
			</textarea>
		</div>
		<div style="display:none;">
			<span class="ab-colors">
			<br>&nbsp;&nbsp;
			controllerGrid
			<br>
			</span>
			<textarea  cols=30 rows=5 id="controllerGrid" class="hidden" >
			</textarea>
		</div>
		<div style="display:none;">
			<span class="ab-colors">		
			<br>&nbsp;&nbsp;
			dbListGrid
			<br>
			</span>
			<textarea  cols=30 rows=5 id="dbListGrid"  class="hidden" >
			</textarea>
		</div>
		<div style="display:none;">
			<span class="ab-colors">		
			<br>&nbsp;&nbsp;
			dbUpdGrid
			<br>
			</span>
			<textarea  cols=30 rows=5 id="dbUpdGrid"  class="hidden" >
			</textarea>
		</div>

		
	</td>
	</tr>
	<tr>
	<td></td>
	<td debug style="vertical-align:top;" >
		<input style="display:none;" type="button" onclick="eval($('#exec').val());" value="exec" /><br>	
		<textarea style="display:none;"  cols=30 rows=5 id="exec" >
var debug = "";
debug += showProps(dDta.dbUpd.dta ,"upd")
$("#focusGrid").val(debug)

		</textarea>
	</td>
	</tr>
	<tr>
	<td></td>
	<td debug style="vertical-align:top;" >	
		<input style="display:none;" type="button" onclick="eval($('#dataGrid').val());" value="exec" />
		<br>
		<textarea style="display:none;" cols=30 rows=5 id="dataGrid" >
$("#ab-sessionBoard").click();
var debug = "";
var lead ="";
var recSet = dDta.scList.vin_inve[0].rowSet;
var recFields = "";
debug += A_Scope.recSetToTsv(recSet,lead,recFields)
$("#focusGrid").val(debug)
		</textarea>
	</td>
	</tr>
	<tr>
	<td></td>
	<td debug style="vertical-align:top;" >	
		
		<input style="display:none;" type="button" onclick="eval($('#ddaGrid').val());" value="exec" /><br>
		<textarea style="display:none;" cols=30 rows=5 id="ddaGrid" >
dDta['rr']=new Array();
var occ = 0;
while (occ < dDta.dbUpd.dta.E_POST.RECSET.length-1)
{
dDta['rr'][occ] = new Object();
dDta['rr'][occ] = dDta.dbUpd.dta.E_POST.RECSET[occ+1] 
occ += 1;
}
		</textarea>		
	</td></tr>
	</table>


	</div>




<!-- Modal -->
<!--
<div id="sessionModal" class="modal fade" role="dialog" style="">
<button id="ab-sessionBoard" type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" data-target="#sessionModal">Open Modal</button>
  <div class="modal-dialog" style="width:55%;height:75%;">


    <div class="modal-content" style="width:100%;height:99%;">
      <div class="modal-header" style="height:10%;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{SESSION_DESCR}} A Modal Header</h4>
      </div>
      <div class="modal-body" style="height:80%;">
        <iframe name="ab-frm.abStdFrm" style="width:100%;height:99%;" src="http://www.sasadept.net:3080/ABerp/wrapSession.php" ></iframe>
      </div>
      <div class="modal-footer" style="height:10%;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

-->

</body>




</html>
