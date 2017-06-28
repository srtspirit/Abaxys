<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
	<?php require_once "../appCscript/VGB_AMHE.php"; ?>
</div>
<div style="margin-left:5px;" ng-init="SESSION_DESCR='Form Message Control'">
	<div class="row ab-spaceless ">
		<div class="col-sm-12 ab-spaceless" ng-model="vgb_amhe" >
			<?php require_once "../stdCscript/stdFormButtons.php"; ?>
		</div>
		<div class="col-sm-5" style="padding:0px;padding-top:5px;">
			<ul class="nav nav-tabs " >
				<li>
					<span class="text-danger" >{{vgb_amhe_localError}}</span>
					<span class="text-warning" >&nbsp;&nbsp;</span>
					<label class="btn-xs"   ab-label="" ></label>
					<span  value=""></span>
				</li>
			</ul>
		</div>
		<div class="col-sm-7">
	
		</div>
		
<textarea class="hidden" ab-updSuccess="" >


if (data['posts'].requestMethod == 'DELETE')
{
	$scope.initDocMsgdta(0,VGB_AMHE_SOURC);
}
else
{
	
	var tmpId = $scope.idVGB_AMHE
	if (data['posts'].requestMethod == 'CREATE')
	{

		tmpId=data['posts'].insertId;
	    
	}

	$scope.initDocMsgdta(tmpId,VGB_AMHE_SOURC);

}


</textarea>
		
		
	</div>
	<div class="row mygrid-wrapper-div ab-borderless" style="margin:0px;padding:0px;">
	

	
		<form id="mainForm" name="mainForm"  ab-view="vgb_amhe" ab-main="vgb_amhe">
		
		 	

		<?php
$xtmp = new appForm("VGB_AMHECT");
echo '<div class="col-sm-3 ab-borderless">';
 
// idVGB_AMHE	
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vgb_amhe";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("System","","vgb_amhe","idVGB_AMHE","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['ab-btrigger'] = "vgb_amhe";
$grAttr['class'] = "hidden";
$xtmp->setFieldWrapper("System","0.0","vgb_amhe","VGB_AMHE_STEPLIST","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


// VGB_AMHE_SOURC
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode =  $xtmp->setEnumField('vgb_amhe','VGB_AMHE_SOURC');

$xtmp->setFieldWrapper("view01","2.4","vgb_amhe","VGB_AMHE_SOURC","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

// VGB_AMHE_MESID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr['ab-label'] = "VGB_AMHE_MESID";
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.2","vgb_amhe","VGB_AMHE_MESID","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;

// VGB_AMHE_DESCR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.1","vgb_amhe","VGB_AMHE_DESCR","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;


/*// VGB_AMHE_STEPS 	
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.1","vgb_amhe","VGB_AMHE_STEPS 	","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;
echo '</div><div class="col-sm-3">';*/

/*// VGB_AMHE_PRPOS
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.1","vgb_amhe","VGB_AMHE_PRPOS","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;*/

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr["class"] = "hidden";
$inAttr["size"] = "5";

//$focus = ' onfocus="' . "$(this).attr('rows','4');$(this).attr('cols','30');$(this).css('width','');$(this).css('height','');$(this).css('overflow','auto');" . '" ';

//$blur = ' onblur="' . "$(this).css('width','140px');$(this).css('height','20px');$(this).css('overflow','hidden');" . '" ';

$hardCode  = '<table><tr>';

$hardCode .= '<td style="vertical-align:top;" ><label class="text-primary"  ab-label="STD_TEXT_LINE" >Text Line</label>:<textarea style="overflow:hidden;font-size:9pt;" rows="4" cols="30"  ng-model="VGB_AMHE_DTEXT"  > </textarea></td><td>&nbsp;&nbsp;&nbsp;</td>';

$hardCode .= '</tr></table>';
$xtmp->setFieldWrapper("view01","0.122","vit_issue","VGB_AMHE_DTEXT","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;


//VGB_AMHE_ALWAY

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = $xtmp->setYesNoField("VGB_AMHE_ALWAY");
$xtmp->setFieldWrapper("view01","1.1","vgb_amhe","VGB_AMHE_ALWAY","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

// VGB_AMHE_DATFR
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "STD_FROM";
$inAttr = $xtmp->inAttrib;
$hardCode = "<table><tr><td><label class='text-primary'ab-label='STD_DATE'></label>&nbsp;</td><td>" . $xtmp->setDatePick("VGB_AMHE_DATFR") . "</td></tr></table>";
$xtmp->setFieldWrapper("view01","1.1","vgb_amhe","VGB_AMHE_DATFR","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;
//echo "<div ><table class='table'><tr><td>" . $exp1 . "</td></tr></table></div>";			

// VGB_AMHE_DATTO
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$laAttr["ab-label"] = "STD_TO";
$inAttr = $xtmp->inAttrib;
$hardCode = "<table><tr><td><label class='text-primary'ab-label='STD_DATE'></label>&nbsp;</td><td>" . $xtmp->setDatePick("VGB_AMHE_DATTO") . "</td></tr></table>";
$xtmp->setFieldWrapper("view01","1.1","vgb_amhe","VGB_AMHE_DATTO","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

/*// VGB_AMHE_DTEXT
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$xtmp->setFieldWrapper("view01","1.1","vgb_amhe","VGB_AMHE_DTEXT","",$grAttr,$laAttr,$inAttr,"");
echo $xtmp->currHtml;*/

echo '</div>';
  ?>
  
  		<div class="col-sm-3 ab-borderless">
  			        
			<div class="{{VGB_AMHE_SOURC=='PURCH'?'':'hidden'}}" >
  				<table>
  					<tr>
  						<td> Purchase Steps </td>
  					</tr>
  					<tr ng-repeat="vpu in vpuSteps | AB_Sorted:'VBP_CPARM_PRMNA' ">  						
  						<td> 
					    <input type="checkbox" steps="PURCH"  value="{{vpu.VBP_CPARM_PRMNA}}" 
					    ng-click="setStepList();"
					     class="text-primary" />
						{{vpu.VBP_CPARM_PRMVA}} </td>
  					</tr>
  				</table>
  			</div>
  			<div class="{{VGB_AMHE_SOURC=='SALES'?'':'hidden'}}">
  				<table>
  					<tr>
  						<td> Sales Steps </td>  						
  					</tr>
  					<tr ng-repeat="vsl in vslSteps | AB_Sorted:'VBP_CPARM_PRMNA' ">
  						<td> 
						 <input type="checkbox" steps="SALES"  value="{{vsl.VBP_CPARM_PRMNA}}"  
						 ng-click="setStepList();"
						 class="text-primary" />
						{{vsl.VBP_CPARM_PRMVA}} </td>
  					</tr>
  				</table>
  			</div>

		</div>

   <div class="col-sm-6">
         <table class="table ab-border">
            <tr >
               <td>
                  <a ng-click="initDocMsgdta(0,VGB_AMHE_SOURC)" >
                  <span >New</span>
                  <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;							
                  <label ab-label="VGB_AMHE_SOURC">
                   	Module
                  </label>
               </td>
               <td><label ab-label="VGB_AMHE_MESID">
               Message Text
                  </label>
               </td>
			   <td><label ab-label="VGB_AMHE_DESCR">
               Message Description
                  </label>
               </td>               
               <td>
               		<label ab-label="STD_DATE"></label>
               		<label ab-label="STD_FROM"></label>
               </td>
               <td>
               		<label ab-label="STD_DATE"></label>
               		<label ab-label="STD_TO"></label>
               </td>
            </tr>
	
            <tr ng-repeat="xx in lister" ng-if="xx.VGB_AMHE_SOURC==VGB_AMHE_SOURC" class="ab-spaceless {{xx.idVGB_AMHE!=idVGB_AMHE?'':'bg-info'}}">
               <td>
                  <a ng-click="initDocMsgdta(xx.idVGB_AMHE,xx.VGB_AMHE_SOURC);" >
                  <span >Edit</span>
                  <span  class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  &nbsp;&nbsp;				
                  {{xx.VGB_AMHE_SOURC}}
               </td>
                <td>
                  {{xx.VGB_AMHE_MESID}}
               </td>
			   <td>
                  {{xx.VGB_AMHE_DESCR}}
               </td>               
                <td>
                  {{xx.VGB_AMHE_DATFR}}
               </td>
			   <td>
                  {{xx.VGB_AMHE_DATTO}}
               </td>
            </tr>
         </table>
      </div>		

		</form>
	</div>
</div>