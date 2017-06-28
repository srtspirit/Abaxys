<?php session_start();ob_clean();

$_SESSION['entryPointBefore']="Here";
// User parameters Tempo
require_once "stdSecurity/userSecuritySetup.php";
require_once "stdHtml/StylesAnJqBootScripts.php";
require_once "stdSscript/stdPHPfunctions.php";
$_SESSION['entryPoint']="Here";
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
<body ng-app="AbaxysApp" class="ab-body ab-container" >
<input type="hidden" id="ab-mainlst" ab-value="#default" value="#default" />

<?php 

	$wAccess = false;
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
		$_SESSION["AB_DUSA"] = "";
	}
	
	
	
	
	if (strpos("X".$_SESSION["logged"],"NIALA") == 1)
	{

?>
	
	<div  style="position:fixed;z-index:5;vertical-align:top;">
	<table >
	<tr><td style="vertical-align:top;">
		<img width=40 height=40 class="btn " src="stdImages/buttons/A_Blank.png"
		value="inline" 
		onclick="$('[debug]').children().css('display',this.value);this.value=='none'?this.value='inline':this.value='none';$(this).css('display','inline');"
		/>
		 
		
	</td>
	<td debug colspan=3 style="vertical-align:top;">
		
		<span class="btn btn-primary" style="display:none;vertical-align:top;" onclick="conClear()">Console Clear</span> 
			
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
var debug = "\n--================-----\n" + $("#focusGrid").val();
$("#focusGrid").val(showProps(A_Scope,"s")+debug)
		</textarea>
	</td>
	</tr>
	<tr>
	<td></td>
	<td debug style="vertical-align:top;" >	
		<input style="display:none;" type="button" onclick="eval($('#dataGrid').val());" value="exec" />
		<br>
		<textarea style="display:none;" cols=30 rows=5 id="dataGrid" >
// A_Ctrl.sessionHistory
var dd = ""; var occ = 0;
while (occ < A_Ctrl.sessionHistory.length )
{
dd += showProps(A_Ctrl.sessionHistory[occ],String(occ)+"-")
occ += 1;
}
// dd += showProps(A_Ctrl.sessionHistory[1],"s1")
// dd += showProps(A_Ctrl.sessionHistory[2],"s2")
// dd += showProps(A_Ctrl.sessionHistory[3],"s3")
$("#focusGrid").val("A_Ctrl.sessionHistory=" + A_Ctrl.sessionHistory.length + "\n" + dd)
		</textarea>
	</td>
	</tr>
	<tr>
	<td></td>
	<td debug style="vertical-align:top;" >	
		
		<input style="display:none;" type="button" onclick="eval($('#ddaGrid').val());" value="exec" /><br>
		<textarea style="display:none;" cols=30 rows=5 id="ddaGrid" >
// A_Session

$("#focusGrid").val(showProps(A_Session,"s"))
$("#focusGrid").val(showProps(A_Session.sessions.VGB_CUSTCT[0]  ,"s"))
		</textarea>		
	</td></tr>
	</table>


	</div>
<?php
	}
?>	
	
		
		<!--  <a href="#ABM_Scripts" >ABM Scripts</a> -->

<div class="row" style="background-color:DodgerBlue" >

	<div class="col-sm-1 btn btn-primary" colors="" style="min-height:60px;text-align:right;" >
		<a href="#x" >
			<img  src="stdImages/logo/Abaxys4Bleu.png"  />
		</a>
	</div>	
	<div class="col-sm-11 btn btn-primary " colors="" style="min-height:73px;">
		<?php include "stdHtml/SessionOrgMenu.php"; ?>
		<input type="hidden" style="color:black;" onchange="$('[colors]').css('background-color',this.value);" />
	</div>
	
	
	
</div>	

<div class="row">
	<div class="col-sm-2 ">
		
			<?php include "stdHtml/SessionUsrFavorite.php"; ?>




	</div>

	<div class="col-sm-9">
		<div class="ab-container">
			<div class="row" >

				<div class="col-sm-12" >
					<div>&nbsp;</div>
					<div class="ab-border">
		
						<?php include "stdHtml/SessionUsrMenu.php"; ?>
		
					</div>
					<div>&nbsp;</div>
				</div>  
			</div>
		</div>
	
	  
	
		<div class="ab-container" >
	
			<div>
				<div id="ab-SesMenu"></div>
				<div id="ab-main" ng-view="" ></div>
			</div>
			
			<div class="row" >
				
				<div class="col-sm-6" id="ab-main-rec">
					<small class='small'  ></small>						
				</div>
				<div class="col-sm-6 small " >
					<b class="text-danger" id="ab-main-rec-err" ></b>						
				</div>
			</div>
			<div class='row btn-xs '>
				<div class='col-sm-2 btn-xs hidden' >
					<label class="btn-xs" [=LBL=]STD_DIVISION_BR[=LBL=]>Branch</label>:&nbsp;
					<label class="btn-xs" >&nbsp;
						<?php echo $_SESSION["AB_DUSA"]['user']['dimlevelTR']; ?>
					</label>
					
				</div>
			
				<div class='col-sm-10 btn-xs ' >
				
				<?php 
						$usrOpt = "";
						$usrSet = "";
						foreach($_SESSION["AB_DUSA"] as $name => $value)
						{
					    		
							foreach($_SESSION["AB_DUSA"][$name] as $func => $result)
							{
								if ($name == "usrList")
								{
									$select = $_SESSION["AB_DUSA"]["user"]["name"] == $func?"selected":"";
									$usrOpt .= "<option value='" . $func . "' " . $select . " >" . $func . "= ".$result."</option>";
								}
								$usrSet .= "<option>" . $name . "." . $func . "= ".$result."</option>";
								    		
							}
						}
						
						
						if (strlen($usrOpt))
						{
							// echo "&nbsp;&nbsp;&nbsp;&nbsp;Current user: <select class='btn-xs ab-body-info' onchange='abLinkUsr(this);'> " . $usrOpt . "</select>";
						}
						
						if (strlen($usrSet) && strpos("X".$_SESSION["logged"],"NIALA") == 1)
						{
							// echo "&nbsp;&nbsp;&nbsp;&nbsp;Configuration: <select class='btn-xs ab-body-info' onchange='abLinkUsr(this);'> " . $usrSet . "</select>";
						}
						if (strlen($usrSet) && strpos("X".$_SESSION["logged"],"NIAdddLA") == 1)
						{
				?>
							&nbsp;&nbsp;&nbsp;&nbsp;Images: 
							<input class='btn-xs ab-body-info' type='text' size=10 value='' 
							onchange="this.value==''?$('#AB-IMG').html($('#AB-I').html()):$('#AB-IMG').append($('#AB-I'+this.value).html());"
							/>
							<span class='hidden'>						
								<span id="AB-I" >
									<img class="image" class='text-muted' style='width=30px;height:30px;' src="images/buttons/transparent.png" title='Transparent'  value="Transparent" />
								</span>
								<span id="AB-I00" >
									<img class="image" class='text-muted' style='width=30px;height:30px;' src="images/buttons/folderBlueDark.png" title='Transparent'  value="Transparent" />
								</span>
								<span id="AB-I01" >
									<img class="image" class='text-muted' style='width=30px;height:30px;' src="images/buttons/folderGreenLigth.png" title='Transparent'  value="Transparent" />
								</span>
								<span id="AB-I02">
									<img class="image" class='text-muted'  style='width=30px;height:30px;' src="images/buttons/folderClosed.png" title='Transparent'  value="Transparent" />
								</span>
								<span id="AB-I03" >
									<img class="image" class='text-muted' style='width=30px;height:30px;' src="images/buttons/ShareBlue.png" title='Transparent'  value="Transparent" />
								</span>
							</span>						
							
				<?php
						}	
											
				?>
				 	
					
				   		
				</div>
			</div>	
		</div>
	</div>
	<div class="col-sm-1">
	</div>
</div>				
<div id="rBuffer"></div>
<span id="bug"></span>


</body>




</html>
