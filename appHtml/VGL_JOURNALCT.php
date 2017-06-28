<?php // require_once "../stdSscript/stdPHPobjGen.php"; ?>
<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
	<?php require_once "../appCscript/VGL_FINANCE.php"; ?>
</div>

<div style="margin-left:5px;" ng-init="SESSION_DESCR='Financial journal posting'">

	<div class="ab-spaceless"  >

		<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		
	</div>
	
<div class="hidden">
<textarea class="hidden" ab-updSuccess="" >

$scope.local_journal = new Array();
$scope.totalDebit=0;
$scope.totalCredit=0;
$scope.VGL_JOHE_DOCDA='';
$scope.initGlPost();

$scope.selectGlPostOrder(-1);
if ($scope.currentFlag!='NEW' || $scope.VGL_JOHE_ORTYPE=='TMPL')
{
	if ($scope.VGL_JOHE_ORTYPE=='STDO')
	{
		$scope.editGlPostOrder(0,'new');
		$scope.isVisibleSet('order');
	}
	else
	{
		$scope.editGlPostOrder(0,'new');
		$scope.isVisibleSet('tmpl');
	}
}
else
{
	$scope.editGlPostOrder(0,'new');
}

</textarea>
<div id="updKeys" class="hidden">
	<div id="updCreate" >
		<span class="text-primary" ng-click="localUpd('UPDATE');" >
			<span class="glyphicon glyphicon-floppy-disk ab-pointer" style="font-size:large;" title="Update posting order">
			</span>
		</span>
	</div>
	<div id="updPosting" >
		<span class="text-primary" ng-click="localUpd('POSTING');" >
			<span class="glyphicon glyphicon-floppy-disk ab-pointer" style="font-size:large;" title="Post selected to financials">
			</span>
		</span>
	</div>
	<div id="updDelete" >
		<span class="text-primary" ng-click="localUpd('DELETE');" >
			<span class="glyphicon glyphicon-trash ab-pointer" style="font-size:large;" title="Delete selected posting order">
			</span>
		</span>
	</div>

</div>


<script>




$("#ab-create").html($("#updCreate").html());
$("#ab-update").html($("#updPosting").html());
$("#ab-delete").html($("#updDelete").html());
$("#updKeys").html("");

</script>

<script language='JavaScript' type='text/JavaScript'>

var Key = {
  LEFT:   37,
  UP:     38,
  RIGHT:  39,
  DOWN:   40
};

/* IE: attachEvent, Firefox & Chrome: addEventListener */
function _addEventListener(evt, element, fn) {
  if (window.addEventListener) {element.addEventListener(evt, fn, false);}
  else {element.attachEvent('on'+evt, fn);}
}

function onInputKeydown(evt) {
  if (!evt) {evt = window.event;} // for IE compatible
  var keycode = evt.keyCode || evt.which; // also for cross-browser compatible
  if (keycode == Key.LEFT) {document.getElementById("info").innerHTML += "LEFT ";}
  else if (keycode == Key.UP) {document.getElementById("info").innerHTML += "UP ";}
  else if (keycode == Key.RIGHT) {document.getElementById("info").innerHTML += "RIGHT ";}
  else if (keycode == Key.DOWN) {document.getElementById("info").innerHTML += "DOWN ";}
  else {document.getElementById("info").innerHTML += "SOMEKEY ";}
}

function addevt() {
  _addEventListener('keydown', document, onInputKeydown);
}



</script>

<script>

function setChartDisplay(state)
{
	if (state > 0)
	{
		// $("[ab-flst='ab-lister-vgl_chart']").removeClass("ab-hidden");
	}
	else
	{
		// $("[ab-flst='ab-lister-vgl_chart']").addClass("ab-hidden");
	}
}

function chkKeyCode(ev)
{
 
	switch (window.event.keyCode) 
	{
		case 37:
		// disp('Left key is pressed') // execute a function by passing parameter 
		checkKeyPress(-1);
		break;
		case 38:
		// disp('Up key is pressed') 
		break;
		case 39:
		// disp('Right key is pressed') 
		checkKeyPress(1);
		break;
		case 40:
		// disp('Down key is pressed') 
		break;
	}
}

function disp(txt)
{
	var text = $("[ng-model='VGL_JOHE_REFER']").val()+txt+"\n";
	$("[ng-model='VGL_JOHE_REFER']").val(text);
}
	
function checkKeyPress(dir)
{


	var occ = 0;
	var occFound = -1;
	var lastVal = new Array();
	var currVal = $("[ng-model='VGL_CHART_GLIDN']").val();
	
	$("[ab-dfl='ABDFLvgl_chart']").each(function()
	{
		
		lastVal[occ] = "deflectVal(" + $(this).attr("dflval") + ",'VGL_CHART_GLIDN');" ;
		if ($(this).attr("dflval") == currVal)
		{
			occFound = occ;
		}
		
		
		occ += 1;
	});
	
	eval(lastVal[occFound + dir]);
	$("[ng-model='ABSELvgl_chart']").focus();
	
}

function searchAccounts()
{
	$("[ab-flst='ab-lister-vgl_chart']").removeClass("ab-hidden");
	$("[ab-flst='ab-lister-vgl_chart']").removeClass("hidden");
}

$("[ng-model='ABSELvgl_chart']").attr("size",10);
var exec = ""
if ($("[ng-model='ABSELvgl_chart']").attr("onfocus"))
{
	exec = $("[ng-model='ABSELvgl_chart']").attr("onfocus");
}
exec += ";$('#submitAcc').attr('type','submit');setWrapper();"
$("[ng-model='ABSELvgl_chart']").attr("onfocus",exec);

var exec = ""
if ($("[ng-model='ABSELvgl_chart']").attr("onblur"))
{
	exec = $("[ng-model='ABSELvgl_chart']").attr("onblur");
}
exec += ";$('#submitAcc').attr('type','button');"
$("[ng-model='ABSELvgl_chart']").attr("onblur",exec);

// $("[ab-flst='ab-lister-vgl_chart']").addClass("ab-hidden")

//	$("[ab-flst='ab-lister-vgl_chart']").find("tr").each(function(){
//	    
//	    	$(this).click(function(){
//	    		
//		$("#EsubmitAcc").click();
//		// $(this).addClass("ab-hidden");
//		});
//	});

setChartDisplay(0);
$("input").keydown(function()
{
chkKeyCode(event);	
});


function setWrapper()
{
	
//	$("[class='mygrid-wrapper-divSm']").addClass('ab-wrapper-div');
//	$("[class='mygrid-wrapper-divSm']").removeClass('mygrid-wrapper-divSm');
	
}

function jrnChartHide(val)
{
	
	$("[ab-flst='" + val + "']").addClass("hidden");
	
}
function jrnChartClickSet(val)
{
	$("[ab-flst='" + val + "']").attr("onclick","jrnChartClickExe('" + val + "');")
	
}
function jrnChartClickExe(val)
{
	$('#accountInsert').click();
	
	setTimeout('$("[ab-flst=' + "'" + val + "']" + '").removeClass("hidden")',1)
	// alert($('#accountInsert').val());
}

</script>


</div>	

	<script>
//		var outB = "<span class=" + '"' + "{{opts.updType!='CREATE'?'':'hidden'}}" + '" >'+ $('#ab-new').html() + "</span>";
//		$('#ab-appOpt').html(outB);
//		$('#ab-new').html('');
	</script>


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

$chartLister = $xtmp->setSearchMaster($sparm);

$chartLister .= <<<EOC
<div id="vsl_chartView" class=" ab-container ab-border hidden" style="position:fixed;z-index:1;">
<div class="ab-wrapper-div">
<table class="ab-border ab-spaceless" style="width:100%;" >
<tr class="well text-primary ab-strong">
<td style="width:5%;" ></td>
<td style="width:70%;white-space:nowrap;" >Gl Account</td>
<td style="width:15%;" ></td>
<td style="width:10%;" onclick="$('#vsl_chartView').addClass('hidden');" class="bg-primary text-center" >X</td>
</tr>
</table>
</div>

<div class="ab-wrapper-div ">

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
	ng-click="insertAccount(acc.idVGL_CHART);" 
	onclick='$("#vsl_chartView").addClass("hidden");'
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
$("[ng-model='ABsPattern{$sparm["searchResult"]}']").focus(function()
{
	$("#vsl_chartView").removeClass("hidden");
	// $(this).select()
});


</script>


EOC;


?>


<form id="mainForm" name="mainForm"   ab-view="vgl_posting" ab-main="vgl_posting" ng-init="isVisibleSet('tmpl');" >
	<div class="row" style="margin:0px;padding:0px;">
	 
		<div class="col-lg-3" >
			<input  class="hidden" ab-btrigger="vgl_posting" ng-model="vgl_postingID" ng-init="vgl_postingID=1" /> 
			<span class="text-primary ab-strong " >
				<h4>
				<?php echo date("l jS \of F Y"); ?>
				</h4>
				<input class="hidden" ng-model="glUpdateType" />
				<input class="hidden" ng-model="glUpdateMethod" />
			</span>
				
		</div>
		<div class="col-lg-1 well ab-border ab-spaceless" ng-click="isVisibleSet('tmpl');">
			<span class="{{isVisible('tmpl')==true?'text-primary':''}}" >
				<span class="glyphicon glyphicon-ok {{isVisible('tmpl')==true?'':'invisible'}}" ></span>
				&nbsp;
				Templates 
				</span>
			</span>					
		</div>		
		<div class="col-lg-1 well ab-border ab-spaceless" ng-click="isVisibleSet('post');">
			<span class="{{isVisible('post')==true?'text-primary':''}}" >
				<span class="glyphicon glyphicon-ok {{isVisible('post')==true?'':'invisible'}}" ></span>
				&nbsp;
				Entry
				</span>
				<span class="text-primary {{VGL_JOHE_ORTYPE=='TMPL'&&isVisible('post')==true?'':'hidden'}}">
					&nbsp;template&nbsp;
				</span>	
				
			</span>		
			
		</div>
		<div class="col-lg-1 well ab-border ab-spaceless" ng-click="isVisibleSet('order');">
			<span class="{{isVisible('order')==true?'text-primary':''}}" >
				<span class="glyphicon glyphicon-ok {{isVisible('order')==true?'':'invisible'}}" ></span>
				&nbsp;
				Posting 
				</span>
			</span>					
		</div>

				
		<div class="col-lg-6" >
			<input class="hidden" ng-model="currentFlag"  />
			
		</div>
	</div>
	<div class="row" style="margin:0px;padding:0px;">	
		<div class="col-lg-3" onmouseover="setWrapper();" >
	
			<input class="hidden" ng-model="lastVGL_JOHE_DOCDA"  ng-init="lastVGL_JOHE_DOCDA=''"  />

			<table style="width:100%;" >

			<tr>
				<td style="vertical-align:top;width:25%;">
				<input class="hidden" ng-model="VGL_JOHE_PSOUR"  ng-init="VGL_JOHE_PSOUR='VGL_JRN'" />
					<?php
					$grAttr = $xtmp->grAttrib;
					$grAttr["onmouseout"] = "$('#DOCDA').click();";
					$laAttr = $xtmp->laAttrib;
					$laAttr["ab-label"] = "STD_POST_DATE";
					$laAttr["class"] .= " small ";
					$inAttr = $xtmp->inAttrib;
					$hardCode = $xtmp->setDatePick("VGL_JOHE_DOCDA");
					$datePick = $hardCode;
					$xtmp->setFieldWrapper("view01","2.090","vgl_johe","VGL_JOHE_DOCDA","",$grAttr,$laAttr,$inAttr,$hardCode);
					echo $xtmp->currHtml;
					?>
					<script>
					$("[ng-model='VGL_JOHE_DOCDA']").attr("ng-click","clickDate()");
					</script>
					
					<input id="getFiscal" class="hidden" ng-click="initGlPostTimed(VGL_JOHE_DOCDA)" />
				</td>
				<td  style="width:75%;"  class="text-center text-primary " >
					<span class="{{isPostDateValid()==true||glUpdateType!='post'?'hidden':''}} text-danger" >
						<label ab-label="MES_DATE_INVALID"></label>
					</span>
					<input class="hidden" id="accountInsert"  ng-click="insertAccount(VGL_CHART_GLIDN);"  value="AA"/>
					<span ng-repeat="pdate in vgl_jnentry "  class="{{isPostDateValid()!=true?'hidden':''}}" >
						Posting Year:&nbsp;
						<span class="ab-strong">{{pdate.VGL_JOHE_GLFIS}}</span>
						&nbsp;&nbsp;Period:&nbsp;<span class="ab-strong">{{pdate.VGL_JOHE_GLPER}}
					</span>
					<span ng-init="lastVGL_JOHE_DOCDA=VGL_JOHE_DOCDA;"></span>

				</td>
			</tr>

			<tr>
				<td colspan=2>
				<span ab-label="STD_REF" class="text-primary ab-strong" >Ref...</span>
				<br>
				<a id="info" rows="5" cols="35"></a>
				<textarea style="width:100%;" rows=5 placeholder="posting reference" ng-model="VGL_JOHE_REFER" onfocus="jrnChartHide('ab-lister-vgl_chart',);"  ></textarea>
				<input id="autoDistribute" class="hidden" ng-click="distributeBal()" />
				</td>
			</tr>
			</table>

		</div>


		
		<div class="col-lg-8" >
			<div class="{{isVisible('post')==true?'':'hidden'}}" >
				<div class="ab-wrapper-div">
					<table style="width:100%;" class="{{!AB_CPARM?'hidden':''}}" >	
					<tr > 
						<input class="hidden" ng-model="VGL_JOHE_TRNOR" ng-init="VGL_JOHE_TRNOR=0" />
						<input class="hidden" ng-model="VGL_JOHE_ORTYPE" ng-init="VGL_JOHE_ORTYPE='STDO'" />
						<input class="hidden" ng-model="VGL_JOHE_NAME" ng-init="VGL_JOHE_NAME=''" />
						<td colspan=3 class="{{VGL_JOHE_TRNOR==0?'':'hidden'}}">
							<span class="btn-success ab-pointer ab-border ab-strong ab-spaceless " ng-click="editGlPostOrder(0,'new');">
								&nbsp;Reset&nbsp;
							</span>	
							&nbsp;&nbsp;&nbsp;								
							<span class=" text-primary " >
								New entry 
								<span class="{{VGL_JOHE_ORTYPE=='TMPL'?'':'hidden'}}">
									template&nbsp;&nbsp;&nbsp; 
								</span>	
							</span>
							<span class="{{VGL_JOHE_ORTYPE=='TMPL'?'':'hidden'}}"> 
								<span class=" text-primary " >
									<span ab-label="STD_NAME" ></span>:
								</span>
								<input ng-model="VGL_JOHE_NAME"  />
							</span>
						</td>
						<td colspan=3 class="{{VGL_JOHE_TRNOR>0?'':'hidden'}}"> 
							<span class="btn-success ab-pointer ab-border ab-strong ab-spaceless " ng-click="editGlPostOrder(0,'new');">
								&nbsp;Reset&nbsp;
							</span>	
							<span class=" text-primary " >
								&nbsp;&nbsp;&nbsp;							
								Editing 
								<span class="{{VGL_JOHE_ORTYPE=='STDO'?'':'hidden'}}">
									post order#:
								</span>	
								<span class="{{VGL_JOHE_ORTYPE=='TMPL'?'':'hidden'}}">
									template#:
								</span>	
							</span>
							&nbsp;<span class="ab-strong">{{local_journal[0].VGL_JOHE_TRNOR}}</span>&nbsp;&nbsp;&nbsp; 
							<span class="{{VGL_JOHE_ORTYPE=='TMPL'?'':'hidden'}}"> 
								<span class=" text-primary " >
									<span ab-label="STD_NAME" ></span>:
								</span>
								<input ng-model="VGL_JOHE_NAME"  />
							</span>

						</td>
					</tr>				
					<tr class="ab-strong ab-border text-primary small" >
						<td style="width:10%;"></td>
						<td style="width:15%;"> Account # </td>
						<td style="width:30%;"> Description </td>
						<td style="width:15%;" class="text-right"> Debit&nbsp;&nbsp;&nbsp;</td>
						<td style="width:15%;" class="text-right"> Credit&nbsp;&nbsp;&nbsp;</td>
						<td style="width:15%;" class="text-center">
							<span ng-repeat="curr in vgb_curr | AB_noDoubles:'idVGB_CURR' "  ng-if="curr.idVGB_CURR==AB_CPARM.VGB_COMPANY.vgb_cust[0].VGB_CUST_CURID" >
								&nbsp;({{curr.VGB_CURR_CURID }})&nbsp;&nbsp;
							</span>
						
						</td>
					</tr>
					</table>
				</div>
				<div class="ab-wrapper-div">
					<table style="width:100%;" class="{{!AB_CPARM?'hidden':''}}" >
					<tr class="ab-strong"  >
						<td style="width:10%;"></td>
						<td style="width:15%;"></td>
						<td style="width:30%;"></td>
						<td style="width:15%;"></td>
						<td style="width:15%;"></td>
						<td style="width:15%;"></td>
					</tr>							
					<tr ab-formlist="jnhe_list" ng-repeat="jrn in local_journal | AB_noDoubles:'idVGL_JODE'  " cwlass="{{jrn.local_trash==0?'':'text-danger ab-strong'}}"  >
						
						<td >
						
							<input ng-model="jrn.local_trash" class="hidden" />
							<div class="text-primary ab-pointer" 
							>
							
							<span title="click to remove account" ng-click="jrn.local_trash = 1 - jrn.local_trash;insertAccount(0);"
							class="t2ext-primary aeb-pointer" 
							onmouseover="$(this).addClass('text-danger');" 
							onmouseout="$(this).removeClass('text-danger');"	
							
							>
							
						 
								Trash
								
								<span class="glyphicon glyphicon-trash"></span>
							
							</span>
							</div>
						</td>
						<td style="color:inherit;" >
							<input class="hidden" ng-model="jrn.GL_POST" ng-init="jrn.GL_POST=1"/>
							<input class="hidden" ng-model="jrn.VGL_CHART_GLIDN" />
							<input class="hidden" ng-model="jrn.idVGL_CHART" />
							<input class="hidden" ng-model="jrn.VGL_CHART_CURID" />
							{{jrn.VGL_CHART_GLIDN}}
							<span ng-repeat="curr in vgb_curr | AB_noDoubles:'idVGB_CURR' "  ng-if="curr.idVGB_CURR==jrn.VGL_CHART_CURID" >
								&nbsp;({{curr.VGB_CURR_CURID }})
							</span> 
						</td>
						<td>
							<input class="hidden" ng-model="jrn.VGL_CHART_GLDES" />
							{{jrn.VGL_CHART_GLDES}}
						</td>
						<td class="text-right">
			
							<input id="debitId{{$index}}" ng-if="jrn.VGL_JODE_CRE_AMT==0" 
							ng-model="jrn.VGL_JODE_DEB_AMT" size=8 class="ab-borderless text-right "  
							ng-blur='distributeBal();jrn.VGL_JODE_DEB_AMT=ABGetNumberFn("fmt-curr",jrn.VGL_JODE_DEB_AMT)' />&nbsp;
						
							<span ng-if="jrn.VGL_JODE_CRE_AMT!=0" >
								<input  ng-model="jrn.VGL_JODE_DEB_AMT" size=8 class="hidden ab-borderless text-right " />
							</span>
			
						</td>
						<td class="text-right">
							<input id="creditId{{$index}}" ng-if="jrn.VGL_JODE_DEB_AMT==0" ng-model="jrn.VGL_JODE_CRE_AMT" size=8 class="ab-borderless text-right "  ng-blur='distributeBal();jrn.VGL_JODE_CRE_AMT=ABGetNumberFn("fmt-curr",jrn.VGL_JODE_CRE_AMT)' />&nbsp;
							<span ng-if="jrn.VGL_JODE_DEB_AMT!=0" >
								<input ng-model="jrn.VGL_JODE_CRE_AMT" size=8 class="hidden ab-borderless text-right " />
								
							</span>
						</td>
						<td class="text-right small ab-strong">
							<span ng-repeat="curr in vgb_curr | AB_noDoubles:'idVGB_CURR' "  ng-if="curr.idVGB_CURR==jrn.VGL_CHART_CURID" >
								<span ng-if="curr.VGB_CURR_CURAT!=1">
									{{computeExchange(jrn,curr.VGB_CURR_CURAT)}}
									&nbsp;@&nbsp;{{curr.VGB_CURR_CURAT}}&nbsp;
								</span>
							</span> 
			
						</td>
					</tr>
					<tr>
			
					<td colspan=3>
						<?php echo $chartLister; ?> 
					</td>
			
					</tr>					
					<tr class="ab-strong">
						<td></td>
						<td></td>
						<td></td>
						<td class="text-right"  >
						<input class="hidden ab-borderless text-right "   ng-model="totalDebit" size=8 />
						<span style="border-top:solid;border-width:1px;">
						&nbsp;{{totalDebit}}&nbsp;
						</span>
						</td>
						<td class="text-right"  >
						<input class="hidden ab-borderless text-right " ng-model="totalCredit" size=8 />
						<span style="border-top:solid;border-width:1px;">
						&nbsp;{{totalCredit}}&nbsp;
						</span>
						</td>
						<td class="text-right">
						&nbsp;
						</td>						
					</tr>
					<tr class="ab-strong">
						<td class="text-right">
						&nbsp;
						</td>						
					</tr>					
					</table>
				</div>
			</div>
			<div class="{{isVisible('order')==true||isVisible('tmpl')==true?'':'hidden'}}" >
				<div class="ab-wrapper-div">
					<table style="width:100%;" class="{{!rawResult.todayPost?'hidden':''}}" >
					<tr class="ab-strong" >
						<td style="width:34%;"> 
								<table style="width:100%;">
								<tr >	
									<td class="text-left  text-primary" >	
										<span class="well ab-border ab-spaceless ab-pointer text-primary small" ng-click="selectGlPostOrder(0);">
											&nbsp;
											Select all
											&nbsp;
										</span>		
									</td>
									<td class="text-left  text-primary" >					
										<span class="well ab-border ab-spaceless ab-pointer text-primary small" ng-click="selectGlPostOrder(-1);">
										&nbsp;Clear all&nbsp;
										</span>
									</td>
									<td class="text-left  text-primary" >
										<span class="{{isVisible('order')==true?'':'hidden'}}" >					
										Posting Orders
										</span>
										<span class="{{isVisible('tmpl')==true?'':'hidden'}}" >	
											<span class="well ab-border ab-spaceless ab-pointer text-primary small" ng-click="editGlPostOrder(-1,'new');isVisibleSet('post');">
											&nbsp;New &nbsp;
											</span>														
										</span>
									</td>
									<td class="small text-right {{isVisible('tmpl')==true?'':'hidden'}} {{hasOrdersSelected()==false?'':'hidden'}} ">
										<span class=" text-primary" ab-label="STD_FILTER"></span>
										<input size=10 ng-model="filter_today" />&nbsp;&nbsp;&nbsp;
									</td>

								</tr>
								</table>						
						
						</td>
						<td class=" text-primary" style="width:10%;"> Account # </td>
						<td class=" text-primary" style="width:34%;"> Description </td>
						<td class=" text-primary text-right" style="width:10%;" > Debit</td>
						<td class=" text-primary text-right" style="width:10%;" > Credit</td>
						<td class=" text-primary" style="width:1%;" ></td>
					</tr>
					<tr class="ab-border">
						<td colspan=100></td>
					</tr>
					</table>
				</div>
				<div class="ab-wrapper-div">							
					<table class="ab-border" style="width:100%;" 
					ng-if="(isVisible('order')==true && head.VGL_JOHE_ORTYPE=='STDO')||(isVisible('tmpl')==true && head.VGL_JOHE_ORTYPE=='TMPL' && isFilterValid(head.idVGL_JOHE)==true)"
					ng-repeat="head in rawResult.todayPost | AB_noDoubles:'idVGL_JOHE' | AB_sortReverse:'VGL_JOHE_CDATE' ">
					<tr >
						<td style="width:34%;padding:2px;vertical-align:top;" class="ab-strong" > 
							<div>
								<table style="width:100%;">
								<tr>	
									<td class="text-center" >	
										<span class="well ab-border ab-spaceless ab-pointer text-primary small" ng-click="selectGlPostOrder(head.idVGL_JOHE);">
											<span class="glyphicon glyphicon-ok {{isOrderSelected(head.idVGL_JOHE)==true?'':'invisible'}}" ></span>
											&nbsp;
											<span class="text-center {{isVisible('order')==true?'':'hidden'}}">
												Select
											</span>
											<span class="text-center {{isVisible('tmpl')==true?'':'hidden'}}">
												<span class="glyphicon glyphicon-trash"></span>
											</span>
											&nbsp;
										</span>	
										<input class="hidden" ng-model="head.GL_ORDER" ng-init="head.GL_ORDER=1"/>	
										<input class="hidden" ng-model="head.selected" 
										ng-if="isOrderSelected(head.idVGL_JOHE)==true"  ng-init="head.selected=1;" />
									</td>
									<td class="text-center" >					
										<span class="well ab-border ab-spaceless ab-pointer text-primary small" ng-click="editGlPostOrder(head.idVGL_JOHE,'edit');isVisibleSet('post');">
										&nbsp;Edit&nbsp;
										</span>
									</td>
									<td class="text-center" >
										<span class="{{isVisible('tmpl')==true?'':'hidden'}}"  >					
											<span class="well ab-border ab-spaceless ab-pointer text-primary small" ng-click="editGlPostOrder(head.idVGL_JOHE,'new');isVisibleSet('post');">
											&nbsp;Insert&nbsp;
											</span>
										</span>
									</td>

								</tr>
								</table>
									
									
							</div>
							<div>
								<input class="hidden" ng-model="head.idVGL_JOHE" />
								<span class="{{isVisible('order')==true?'':'hidden'}}"  >
									Order#:{{head.VGL_JOHE_TRNOR}}&nbsp;
									<span class="text-primary small">
									{{head.VGL_JOHE_CDATE}}
									</span>
								</span>
								<span class="{{isVisible('tmpl')==true?'':'hidden'}}"  >
									Template#:{{head.VGL_JOHE_TRNOR}}&nbsp;
									<span class="text-primary small">
									{{head.VGL_JOHE_NAME}}
									</span>
								</span>
							</div>
							<div class="small"  >
								<table style="width:100%;">
									<tr>
										<td class="text-primary" style="width:15%;vertical-align:top;" >Ref:</td>
										<td class="well small ab-spaceless " style="width:80%;margin:2px;padding-left:10px;padding-right:10px;">
											<input class="hidden" ng-model="head.ref" ng-init="head.ref=ABdisplayText(head.VGL_JOHE_REFER);" />
											<span ng-repeat="refer in head.ref" >
											{{refer.text}}<br>
											</span>
										</td>
										<td style="width:5%;">&nbsp;</td>
										
									</tr>
								</table>
							</div>
						</td>
						<td style="width:66%;vertical-align:top;">
												
						<table style="width:100%;" >
						<tr style="vertical-align:top;" ab-formlist="gl_orders" ng-repeat="jrn in rawResult.todayPost | AB_noDoubles:'idVGL_JODE' " ng-if="jrn.idVGL_JOHE == head.idVGL_JOHE" >
							
							<td style="width:14%;vertical-align:top;">
								{{jrn.VGL_CHART_GLIDN}}
							</td>
							<td style="width:55%;">
								{{jrn.VGL_CHART_GLDES}}
							</td>
							<td style="width:15%;" class="text-right">
								<span ng-if="jrn.VGL_JODE_GLAMT>0" >{{ABGetNumberFn("fmt-curr",jrn.VGL_JODE_GLAMT)}}</span>&nbsp;
							</td>
							<td style="width:15%;" class="text-right">
								<span ng-if="jrn.VGL_JODE_GLAMT<0" >{{ABGetNumberFn("fmt-curr",(jrn.VGL_JODE_GLAMT * -1)) }}</span>&nbsp;
							</td>
							<td style="width:1%;">
							</td>
							
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
</form>	
<div class="hidden">
<input ab-mpp="0" value="0" />
</div>

<span class="hidden" id="openUdateConfirm" data-toggle="modal" data-target="#updateConfirm" ></span>	
<div id="updateConfirm" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span  >{{glUpdateMethod}} </span> </h4>
        
      </div>
      <div class="modal-body">
	<table  style="width:100%;" >
		<tr>
			<td colspan=2 class="text-primary" ><label>{{updateConfirmMessage}}</label></td>        				
		</tr>
		<tr>
			<td >
				<span class="btn btn-success btn-sm" ng-click="ABupd('UPDATE');" ng-if="glUpdateMethod=='UPDATE'" data-dismiss="modal">
					Update 
					<span class="{{VGL_JOHE_ORTYPE=='STDO'?'':'hidden'}}">
						<span class="{{VGL_JOHE_TRNOR>0?'':'hidden'}}">
						posting 
						</span>
						<span class="{{VGL_JOHE_TRNOR==0?'':'hidden'}}">
						new entry 
						</span>

					</span>
					<span class="{{VGL_JOHE_ORTYPE=='TMPL'?'':'hidden'}}">
						Template 
					</span>
					
				</span>
				<span class="btn btn-success btn-sm" ng-click="ABupd('UPDATE');" ng-if="glUpdateMethod=='POSTING'" data-dismiss="modal">
					Post to financials
				</span>
				<span class="btn btn-success btn-sm" ng-click="ABupd('UPDATE');" ng-if="glUpdateMethod=='DELETE'" data-dismiss="modal">
					Delete
					<span class="{{isVisible('order')==true?'':'hidden'}}">
						posting 
					</span>
					<span class="{{isVisible('tmpl')==true?'':'hidden'}}">
						Template 
					</span>
					
				</span>
			</td>
			<td >
				<span class="btn btn-success btn-sm" data-dismiss="modal">
					Cancel
				</span>
			</td>	        					
				
	
	</table>
      </div>

    </div>

  </div>
</div>