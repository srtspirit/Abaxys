<div class="hidden">
<?php 
session_start();
ob_clean();
?>
</div>
​<div class="hidden">
<!-- require_once "../appCscript/VIT_ISSUES.php"; --> 
​
<?php 
require_once "../stdSscript/stdAppobjGen.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
require_once "../appCscript/VGL_FINANCE.php";



?>



​
</div>
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


<div class="hidden" id="dtaSelect"  >
<table style="width:100%;">
<tr>
<td style="width:10%;"></td>
<td>
	<div class="well ab-spaceless ab-pointer" ng-init="OrheFormPg=0;ABsearchTbl='vgl_journal' " 
		ng-click="OrheFormPg=0;ABsearchTbl='vgl_journal'" >
		
		<span class=" {{OrheFormPg==0?'text-primary':''}}" >
			<span class="glyphicon glyphicon-ok {{OrheFormPg==0?'text-primary':'invisible'}}" ></span>
			&nbsp;
			Journal Report
			</span>
		</span>
	</div>
</td>
<td>	
	<div class="well ab-spaceless ab-pointer" 
		ng-click="OrheFormPg=1;ABsearchTbl='vgl_balance';setPeriodSelection();" >
		
		<span class=" {{OrheFormPg==1?'text-primary':''}}" >
			<span class="glyphicon glyphicon-ok {{OrheFormPg==1?'text-primary':'invisible'}}" ></span>
			&nbsp;
			Trial Balance
		</span>




	</div>
</td>
<td>	
	<div class="well ab-spaceless ab-pointer" 
		ng-click="OrheFormPg=2;ABsearchTbl='vgl_register'" >
		
		<span class=" {{OrheFormPg==2?'text-primary':''}}" >
			<span class="glyphicon glyphicon-ok {{OrheFormPg==2?'text-primary':'invisible'}}" ></span>
			&nbsp;
			Register
		</span>




	</div>
</td>


</tr>
</table>
</div>


<div class="col-lg-12 ab-spaceless">
    <?php require_once "../stdCscript/stdFormButtons.php"; ?>
    <script>
        $('#ab-buttonPad').html($("#dtaSelect").html());
        $('#ab-new').html('');
    </script>
    
</div>






<div class="row" ng-init="SESSION_DESCR='Financial Journals';" >

<div class="col-sm-12 {{OrheFormPg==0?'':'hidden'}}" >   

<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "VGL_JOURNALCT";
$sparm["searchTable"] = "vgl_jnhe";

$sparm["searchJoin"] = "vgl_jnde:idVGL_JNHE = VGL_JNDE_TRNID";
$sparm["searchJoin"] .= ",vgl_chart:idVGL_CHART = VGL_JNDE_GLIDN";
$sparm["searchJoin"] .= ",vgb_curr:idVGB_CURR = VGL_JNHE_CURID";

$sparm["orderBy"] = "VGL_JNHE_TRNID DESC";

$sparm["searchResult"] = "jrnTrans";
$sparm["searchFilter"] = "";
$sparm["filterExclude"] = "VGL_JNHE_DILEVEL";
$sparm["filterAuto"] = "VGL_JNHE_TRNID,VGL_JNHE_DOCDA,VGL_JNHE_PSOUR";
$sparm["callBack"] = "$"."scope.getDetailJournal(out);";
$sparm["objFunctions"] = "";
$sparm["objGroupBy"] = "idVGL_JNHE";	

$hardCode = $xtmp->setSearchMaster($sparm);
echo $hardCode;

?>

</div>

<div class="col-sm-12 {{OrheFormPg==1?'':'hidden'}}">   

	<table  >
		<tr>
			<td>
			&nbsp;&nbsp;&nbsp;

				
			</td>
			<td >
				<table >
					<tr>
						<td>
							<span class="text-primary" ab-label="STD_SELECT" ></span>
							<span class="text-primary" ab-label="STD_YEAR" ></span>
							&nbsp;&nbsp;
						</td>
						<td ng-if="OrheFormPg==1">
							<ul class="nav  ab-spaceless " role="tablist">
								<li class="dropdown ab-spaceless"  >
									<span data-toggle="dropdown" class="ab-strong ab-pointer" 
									ng-repeat="fiscDta in glFiscalRec | AB_noDoubles:'YEAR' " 
									ng-if="fiscDta.YEAR == yearSelected">
										{{fiscDta.YEAR}}
										<span class="caret"></span>
									</span>
									<ul class="dropdown-menu ab-spaceless" ab-flst="" role="menu">
										<li ng-repeat="fDta in glFiscalRec | AB_noDoubles:'YEAR' "  >
											<span class="text-primary ab-pointer" ng-click="setFiscalYear(fDta.YEAR);">
												&nbsp;&nbsp;{{fDta.YEAR}}
											</span>
										</li>
									</ul>
								</li>
							</ul>
						</td>
					</tr>
				</table>
			</td>
			<td >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td >
				<table >
					<tr>
						<td>
							<span class="text-primary" ab-label="STD_SELECT" ></span>
							<span class="text-primary" ab-label="STD_MONTH" ></span>
							&nbsp;&nbsp;
						</td>
						<td ng-if="OrheFormPg==1">
							<ul class="nav  ab-spaceless " role="tablist">
								<li class="dropdown ab-spaceless"  >
									<span data-toggle="dropdown" class="ab-strong ab-pointer" 
									ng-repeat="fiscDta in glFiscalRec | AB_noDoubles:'MONTH' " 
									ng-if="fiscDta.MONTH == monthSelected">
										{{fiscDta.DESCR}}
										<span class="caret"></span>
									</span>
									<ul class="dropdown-menu ab-spaceless" ab-flst="" role="menu">
										<li ng-repeat="fDta in glFiscalRec | AB_noDoubles:'MONTH' "  >
											<span class="text-primary ab-pointer" ng-click="setFiscalMonth(fDta.MONTH);">
												&nbsp;&nbsp;{{fDta.DESCR}}
											</span>
										</li>
									</ul>
								</li>
							</ul>
						</td>
					</tr>
				</table>
			</td>
			<td>
				&nbsp;&nbsp;&nbsp;
				<span class="btn btn-success btn-md" ab-label="STD_SUBMIT" ng-click="getBalanceJournal();" >GO</span>
			</td>			
		</tr>
	</table>

</div>

<div class="col-sm-12 ">   
   
<?php
  $xtmp = new appForm("ORHE_HISTORY"); 

?>



<div class="col-sm-6 {{OrheFormPg==0?'':'hidden'}}" >




<div class="ab-wrapper-div" style="width:100%;">	
		

<table  class=" ab-spaceless" style="width:100%;" ng-init="sortBy='';VSLextraSort='';" >
<tr class="text-primary ab-border">
			<td style="width:30%;">
			<span class="text-primary small" ab-label="STD_TRNID_SHORT" ></span>&nbsp;-
			<span class="text-primary small" ab-label="STD_YEAR" ></span>&nbsp;-
			<span class="text-primary small" ab-label="STD_PERIOD" ></span>
			</td>
			<td style="width:10%;"> Account # </td>
			<td style="width:35%;"> Description </td>
			<td style="width:10%;" class="text-right"> Debit</td>
			<td style="width:10%;" class="text-right"> Credit</td>
			<td style="width:5%;" ></td>

</tr>	




</table>
</div>
<div class="ab-wrapper-div" style="width:100%;" >
		<table style="width:100%;" >
		<tr class="ab-strong" >
			<td style="width:30%;"></td>
			<td style="width:10%;"></td>
			<td style="width:35%;"></td>
			<td style="width:10%;" class="text-right"></td>
			<td style="width:10%;" class="text-right"></td>
			<td style="width:5%;" ></td>
		</tr>
		<tr class="ab-border">
			<td colspan=100></td>
		</tr>
		</table>					
		<table class="ab-border" style="width:100%;" ng-repeat="head in vgl_journal | AB_noDoubles:'idVGL_JNHE' ">
		<tr >
			<td style="width:30%;padding:2px;vertical-align:top;" class="ab-strong" > 
				#:{{head.VGL_JNHE_TRNID}}&nbsp;-
				<span class="ab-strong" >&nbsp;{{computeFiscalDate(head.VGL_JNHE_DOCDA,"YEAR")}}</span>
				&nbsp;-
				<span class="ab-strong" >&nbsp;{{computeFiscalDate(head.VGL_JNHE_DOCDA,"PERIOD")}}</span>
				<div>			
					<span class="text-primary small">
					{{head.VGL_JNHE_CDATE}}
					</span>
				</div>
				<div class="well small text-left ab-spaceless" style="margin-left:10px;margin-right:10px;" >
					{{head.VGL_JNHE_REFER}}
				</div>
			</td>
			<td style="width:70%;vertical-align:top;">
									
			<table style="width:100%;" >
			<tr style="vertical-align:top;" ng-repeat="jrn in vgl_journal | AB_noDoubles:'idVGL_JNDE' " ng-if="jrn.idVGL_JNHE == head.idVGL_JNHE" >
				
				<td style="width:10%;vertical-align:top;">
					{{jrn.VGL_CHART_GLIDN}}
				</td>
				<td style="width:55%;">
					{{jrn.VGL_CHART_GLDES}}
				</td>
				<td style="width:15%;" class="text-right">
					<span ng-if="jrn.VGL_JNDE_GLAMT>0" >{{ABGetNumberFn("fmt-curr",jrn.VGL_JNDE_GLAMT)}}</span>&nbsp;
				</td>
				<td style="width:15%;" class="text-right">
					<span ng-if="jrn.VGL_JNDE_GLAMT<0" >{{ABGetNumberFn("fmt-curr",(jrn.VGL_JNDE_GLAMT * -1)) }}</span>&nbsp;
				</td>
				<td style="width:5%;">
				</td?
				
			</tr>
			<tr >
				<td colspan=100>&nbsp;</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>

</div>
</div>

<div class="col-sm-6 {{OrheFormPg==0?'':'hidden'}}" >




<div class="ab-wrapper-div" style="width:100%;">	
		

<table  class=" ab-spaceless" style="width:100%;" ng-init="sortBy='';VSLextraSort='';" >
<tr class="text-primary ab-border">
			<td style="width:15%;"><span class="text-primary small" ab-label="VGL_TRHE_GLFIS" ></span></td>
			<td style="width:15%;"><span class="text-primary small" ab-label="STD_PERIOD" ></span></td>
			
			<td style="width:10%;"> Account # </td>
			<td style="width:35%;"> Description </td>
			<td style="width:10%;" class="text-right"> Debit</td>
			<td style="width:10%;" class="text-right"> Credit</td>
			<td style="width:5%;" ></td>

</tr>	




</table>
</div>
<div class="ab-wrapper-div" style="width:100%;" >
		<table style="width:100%;" >
		<tr class="ab-strong" >
			<td style="width:15%;"> </td>
			<td style="width:15%;"> </td>
			<td style="width:10%;"></td>
			<td style="width:35%;"></td>
			<td style="width:10%;" class="text-right"></td>
			<td style="width:10%;" class="text-right"></td>
			<td style="width:5%;" ></td>
		</tr>
		<tr class="ab-border">
			<td colspan=100></td>
		</tr>
		</table>					
		<table class="ab-border" style="width:100%;" ng-repeat="head in vgl_summ |AB_Sorted:'VGL_JNHE_GLFIS,VGL_JNHE_GLPER' | AB_noDoubles:'VGL_JNHE_GLFIS,VGL_JNHE_GLPER' ">
		<tr >
			<td style="width:15%;padding:2px;vertical-align:top;" class="ab-strong" > 
				<span class="ab-strong" >&nbsp;{{computeFiscalDate(head.VGL_JNHE_DOCDA,"YEAR")}}</span>
			</td>	
			<td style="width:15%;padding:2px;vertical-align:top;" class="ab-strong" > 
				<span class="ab-strong" >&nbsp;{{computeFiscalDate(head.VGL_JNHE_DOCDA,"PER")}}</span>
			</td>
			<td style="width:70%;vertical-align:top;">
									
			<table style="width:100%;" >
			<tr style="vertical-align:top;" ng-repeat="jrn in vgl_summ | AB_noDoubles:'VGL_JNHE_GLFIS,VGL_JNHE_GLPER,VGL_JNDE_GLIDN' " 
			ng-if="jrn.VGL_JNHE_GLFIS == head.VGL_JNHE_GLFIS && jrn.VGL_JNHE_GLPER == head.VGL_JNHE_GLPER" >
				
				<td style="width:10%;vertical-align:top;">
					{{jrn.VGL_CHART_GLIDN}}
				</td>
				<td style="width:55%;">
					{{jrn.VGL_CHART_GLDES}}
				</td>
				<td style="width:15%;" class="text-right">
					<span ng-if="jrn.AmtType>0" >{{ABGetNumberFn("fmt-curr",jrn.AmtType)}}</span>&nbsp;
				</td>
				<td style="width:15%;" class="text-right">
					<span ng-if="jrn.AmtType<0" >{{ABGetNumberFn("fmt-curr",(jrn.AmtType * -1)) }}</span>&nbsp;
				</td>
				<td style="width:5%;">
				</td?
				
			</tr>
			<tr >
				<td colspan=100>&nbsp;</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>

</div>
</div>




</div>

</div>


<div class="col-sm-6 {{OrheFormPg==1?'':'hidden'}}">



<div class="ab-wrapper-div" style="width:100%;">	
		

<table  class=" ab-spaceless" style="width:100%;" ng-init="sortBy='';VSLextraSort='';" >
<tr class="text-primary ab-border">
			<td style="width:30%;">
				<span class="text-primary small" ab-label="VGL_TRHE_GLFIS" ></span>
				<span class="ab-strong" >	
				{{computeFiscalDate(yearSelected.toString()+"0101","YEAR")}}
				</span>
				&nbsp;&nbsp;
				<span class="text-primary small" ab-label="STD_PERIOD" ></span>	
				<span class="ab-strong" >
				{{computeFiscalDate(yearSelected.toString()+monthSelected.toString() + "01","PERIOD")}}
				</span>
			</td>
			<td style="width:10%;"> Account # </td>
			<td style="width:35%;"> Description </td>
			<td style="width:10%;" class="text-right"> Debit</td>
			<td style="width:10%;" class="text-right"> Credit</td>
			<td style="width:5%;" ></td>

</tr>	

<tr style="vertical-align:top;" class="ab-border ab-spaceless ab-strong" ng-repeat="jrn in vgl_balsumm  " >
	<td style="width:30%;"></td>
	<td style="width:10%;vertical-align:top;">
		
	</td>
	<td style="width:35%;">
		<span class="text-primary ab-strong" >Balance</span>
	</td>
	<td style="width:10%;" class="text-right">
		<span ng-if="jrn.AmtPost>0" >{{ABGetNumberFn("fmt-curr",jrn.AmtPost)}}</span>&nbsp;
		<span ng-if="jrn.AmtPost==0" >--</span>&nbsp;
	</td>
	<td style="width:10%;" class="text-right">
		<span ng-if="jrn.AmtPost<0" >{{ABGetNumberFn("fmt-curr",(jrn.AmtPost * -1)) }}</span>&nbsp;
		<span ng-if="jrn.AmtPost==0" >--</span>&nbsp;
	</td>
	<td style="width:5%;">
	</td?
	
</tr>



</table>
</div>
<div class="ab-wrapper-div" style="width:100%;" >
		<table style="width:100%;" >
		<tr class="ab-strong" >
			<td style="width:30%;"></td>
			<td style="width:10%;"></td>
			<td style="width:35%;"></td>
			<td style="width:10%;" class="text-right"></td>
			<td style="width:10%;" class="text-right"></td>
			<td style="width:5%;" ></td>
		</tr>
		<tr class="ab-border">
			<td colspan=100></td>
		</tr>
		</table>					
		<table class="ab-border" style="width:100%;">
		<tr >
			<td style="width:30%;padding:2px;vertical-align:top;" class="ab-strong" > 
			</td>
			<td style="width:70%;vertical-align:top;">
									
				<table style="width:100%;" >
				<tr style="vertical-align:top;" ng-repeat="jrn in vgl_balance | AB_noDoubles:'idVGL_CHART' " >
					
					<td style="width:10%;vertical-align:top;">
						{{jrn.VGL_CHART_GLIDN}}
					</td>
					<td style="width:55%;">
						{{jrn.VGL_CHART_GLDES}}
					</td>
					<td style="width:15%;" class="text-right">
						<span ng-if="jrn.AmtPost>0" >{{ABGetNumberFn("fmt-curr",jrn.AmtPost)}}</span>&nbsp;
					</td>
					<td style="width:15%;" class="text-right">
						<span ng-if="jrn.AmtPost<0" >{{ABGetNumberFn("fmt-curr",(jrn.AmtPost * -1)) }}</span>&nbsp;
					</td>
					<td style="width:5%;">
					</td>
					
				</tr>
				<tr>
					<td colspan=100>&nbsp;</td>
				</tr>
				</table>
			</td>
			</tr>
			</table>

</div>
</div>
</div>
<div class="col-sm-6 {{OrheFormPg==1?'':'hidden'}}">

</div>


<div class="col-sm-8 {{OrheFormPg==2?'':'hidden'}}">

<?php
$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = "STD_LABEL_EMPTY";
$sparm["searchTable"] = "vgl_chart";
$sparm["searchJoin"] = "vgb_curr:idVGB_CURR = VGL_CHART_CURID";


$sparm["orderBy"] = "VGL_CHART_GLIDN ASC";

$sparm["searchResult"] = "vgl_chart";
$sparm["searchFilter"] = "hidden";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "";
$sparm["callBack"] = "";

$chartSearch = $xtmp->setSearchMaster($sparm);

$chartLister = <<<EOC
<div id="vsl_chartView" class=" ab-container ab-border hidden" style="position:fixed;z-index:1;">
<div class="ab-wrapper-divmd">
<table class="ab-border ab-spaceless" style="width:100%;" >
<tr class="well text-primary ab-strong">
<td style="width:5%;" ></td>
<td style="width:25%;" >

<label class="{{setField=='VGL_CHART_GLIDN_FR'?'':'hidden'}} " ab-label="STD_FROM" ></label>
<label class="{{setField=='VGL_CHART_GLIDN_TO'?'':'hidden'}} " ab-label="STD_TO" ></label>
<label class="{{setField=='VGL_CHART_GLIDN_SE'?'':'hidden'}} " ab-label="STD_SELECT" ></label>


&nbsp;<span ab-label="VGL_CHART00_GLIDN_SH" >Account</span>
</td>
<td style="width:60%;" >{$chartSearch}</td>
<td style="width:10%;" onclick="$('#vsl_chartView').addClass('hidden');$('.glSearch').removeClass('bg-warning');" class="bg-primary text-center" >X</td>
</tr>
</table>
</div>

<div class="ab-wrapper-divmd ">

<table class="table-striped" style="width:100%;" >
<tr>
<td style="width:1%;" ></td>
<td style="width:25%;" ></td>
<td style="width:3%;" ></td>
<td style="width:70%;" ></td>
<td style="width:1%;" ></td>

</tr>
<tr 	class="ab-pointer"
	ng-repeat="acc in vgl_chart" 
	ng-click="selectAccount(acc.VGL_CHART_GLIDN,setField);" 
	
	onmouseover="$(this).addClass('text-primary ab-strong')"
	onmouseout="$(this).removeClass('text-primary ab-strong')"
	>
<td>&nbsp;</td>	
<td>{{acc.VGL_CHART_GLIDN}}&nbsp;({{acc.VGB_CURR_CURID}})</td>
<td>&nbsp;</td>
<td >{{acc.VGL_CHART_GLDES}}</td>
<td>&nbsp;</td>
</tr>
</table>
</div>
</div>
<script>
$(".glSearch").focus(function()
{
	$("#vsl_chartView").removeClass("hidden");
	$(".glSearch").removeClass("bg-warning");
	$(this).addClass("bg-warning");
	// $(this).select()
});


</script>


EOC;


$datePickFr = $xtmp->setDatePick("VGL_JNHE_DOCDA_FR");
$datePickTo = $xtmp->setDatePick("VGL_JNHE_DOCDA_TO");
$detailled = $xtmp->setYesNoField("REGISTER_DETAIL");

?>

<table>
<td><span ab-label="VGL_CHART00_GLIDN_SH" class="text-primary ab-strong" >Account</span>&nbsp;&nbsp;</td>
<td><span ab-label="STD_FROM" class="text-primary" ></span>:&nbsp;</td>
<td><input size=6 class="glSearch ab-strong" ng-click="setField='VGL_CHART_GLIDN_FR'" ng-model="VGL_CHART_GLIDN_FR" />&nbsp;</td>
<td><span ab-label="STD_TO" class="text-primary" ></span>:&nbsp;</td>
<td><input size=6 class="glSearch ab-strong" ng-click="setField='VGL_CHART_GLIDN_TO'" ng-model="VGL_CHART_GLIDN_TO" />&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><span ab-label="STD_POST_DATE"  class="text-primary ab-strong"></span>&nbsp;&nbsp;<span ab-label="STD_FROM"  class="text-primary"></span>:&nbsp;</td>
<td><?php echo $datePickFr; ?></td>
<td><span ab-label="STD_TO" class="text-primary" ></span>:&nbsp;</td>
<td><?php echo $datePickTo; ?></td>
<td>&nbsp;&nbsp;<span class="btn btn-success btn-md" ab-label="STD_SUBMIT" ng-click="getRegister();" >GO</span></td>
</tr>
<tr>
<td colspan=20>
<?php echo $chartLister; ?>
</td>
</tr>
</table>

	
		
	<div class="ab-wrapper-div" >
		<table  class=" ab-spaceless" style="width:100%;" ng-init="sortBy='';VSLextraSort='';" >
			<tr class="text-primary ab-border">
				<td style="width:20%;">
					<table>
					<tr>
					<td>			
					<span ab-label="STD_DETAILLED"  class="text-primary ab-strong"></span>:&nbsp;
					</td>
					<td>
					<?php echo $detailled; ?>
					</td>
					</tr>
					</table>
				</td>
				<td style="width:10%;"> Account # </td>
				<td style="width:30%;"> Description </td>
				<td style="width:10%;padding-right:12px;" class="text-right">Debit</td>
				<td style="width:10%;padding-right:12px;" class="text-right">Credit</td>
				<td style="width:3%;" ></td>
				<td style="width:15%;padding-right:12px;" class="text-right">Balance</td>
				<td style="width:2%;" ></td>

			</tr>
		</table>
	</div>		
	<div class="ab-wrapper-div" >
		<table style="width:100%;" ng-repeat="jrn in vgl_register  "
			<tr style="vertical-align:top;" class="ab-border ab-spaceless ab-strong"  >
				<td style="width:20%;"></td>
				<td style="width:10%;vertical-align:top;">
					{{jrn.VGL_CHART_GLIDN}}
				</td>
				<td style="width:30%;">
					<span class="text-primary ab-strong" >{{jrn.VGL_CHART_GLDES}}</span>
				</td>
				<td style="width:10%;" class="text-right">
					<span ng-if="jrn.dbTotal!=0" >{{ABGetNumberFn("fmt-curr",jrn.dbTotal)}}</span>
					<span ng-if="jrn.dbTotal==0" >--&nbsp;</span>&nbsp;
				</td>
				<td style="width:10%;" class="text-right">
					<span ng-if="jrn.crTotal!=0" >{{ABGetNumberFn("fmt-curr",jrn.crTotal)}}</span>
					<span ng-if="jrn.crTotal==0" >--&nbsp;</span>&nbsp;
				</td>
				<td style="width:3%;"></td>
				<td style="width:15%;" class="text-right">
					<span ng-if="jrn.amtBalance>0" >{{ABGetNumberFn("fmt-curr",jrn.amtBalance)}}&nbsp;<span class="text-primary">Dr</span></span>
					<span ng-if="jrn.amtBalance<0" >{{ABGetNumberFn("fmt-curr",(jrn.amtBalance*-1))}}&nbsp;<span class="text-primary">Cr</span></span>
					<span ng-if="jrn.amtBalance==0" >--&nbsp;</span>&nbsp;
				</td>
				<td style="width:2%;" ></td>
				
			</tr>
			<tr style="vertical-align:top;" class="well small {{REGISTER_DETAIL=='0'?'hidden':''}} " 
				 ng-repeat="jrnDe in vgl_regDetail  " ng-if="jrn.VGL_CHART_GLIDN == jrnDe.VGL_CHART_GLIDN" >
				<td style="width:20%;"></td>
				<td style="width:10%;vertical-align:top;">
					
				</td>
				<td style="width:30%;">
					<span class="text-primary small" >Tr#</span>	
					&nbsp;
					<span class="ab-strong" >
					{{jrnDe.VGL_JNHE_TRNID}}
					</span>					
					&nbsp;&nbsp;
					{{jrnDe.VGL_JNHE_DOCDA}}

				</td>
				<td style="width:10%;" class="text-right">
					<span ng-if="jrnDe.VGL_JNDE_GLAMT>0" >{{ABGetNumberFn("fmt-curr",jrnDe.VGL_JNDE_GLAMT)}}</span>
					<span ng-if="jrnDe.VGL_JNDE_GLAMT==0" >--&nbsp;</span>&nbsp;
				</td>
				<td style="width:10%;" class="text-right">
					<span ng-if="jrnDe.VGL_JNDE_GLAMT<0" >{{ABGetNumberFn("fmt-curr",(jrnDe.VGL_JNDE_GLAMT*-1))}}</span>
					<span ng-if="jrnDe.VGL_JNDE_GLAMT==0" >--&nbsp;</span>&nbsp;
				</td>
				<td style="width:3%;"></td>
				<td style="width:15%;" class="text-right">
				</td>
				<td style="width:2%;" ></td>
				
			</tr>
		</table>





</div> 
</div>
<div class="hidden">
<input class='text-muted' ab-mpp onchange="getMaxPerPage();" value="0" />
</div>
   </div>
 


<!--
vgl_registerAmtTotal
var debug = "";
var chkStr = "";
var sstr = "125"
var tmp = "";
var occ = 0;
var fff = 0
var rec = dDta.ABMaster.vsl_history.result
while (occ < rec.length)
{
fff +=1
chkStr = showProps(rec[occ],occ).toUpperCase(0)
if (chkStr.indexOf(sstr) >-1)
{
tmp = chkStr.slice(chkStr.indexOf(sstr)-18)
tmp = tmp.slice(0,tmp.indexOf("\n"))
debug +=rec[occ].VPU_ORHE_ORNUM + " = " + tmp + "\n"
}

occ += 1
}
$("#focusGrid").val(occ + " = " + fff + "\n" +debug)

				
-->
