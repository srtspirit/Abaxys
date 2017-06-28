<?php

$stdJsScript = <<<EOD
<script>




function ABsetDatepickers()
{
	try
	{
		$( "[ab-datepick]" ).datepicker("destroy");
	}
	catch(er){}
		
	$(function() {
		
		$( "[ab-datepick]" ).datepicker({
			

      showOtherMonths: true,
      selectOtherMonths: true,			
			dateFormat: "yymmdd"
			
		});		
	});


//	showOn: "button",
//	buttonText: "<span class='glyphicon glyphicon-th-list'></span>",

	
}	
</script>
EOD;

echo $stdJsScript;


class appForm
{
	
	function appForm($fName)
	{
		$this->formName = $fName;
		$this->formData = array();
		$this->setDefaultAttribs();
		
	}
	
	function setDefaultAttribs()
	{

		$this->grAttrib = array();
		$this->laAttrib = array();
		$this->inAttrib = array();
		

		$this->grAttrib['class'] = " ";
		$this->grAttrib['style'] = "padding-top:5px;padding-bottom:10px;";
		
		$this->laAttrib['class'] = "text-primary ";
		$this->laAttrib['style'] = "font-weight:700;";
		
		$this->inAttrib['class'] = "";
		$this->inAttrib['style'] = "border:none;border-bottom:solid;border-width:1px;border-color:CornflowerBlue;";
		$this->inAttrib['size'] = 25;
		$this->inAttrib['type'] = "text";

		
	}

	function buildAttrib($attrObj)
	{
		$oAttr = "";
		if (!is_array($attrObj))
		{
			
		}
		else
		{
	
			foreach($attrObj as $name => $value)
			{
				$oAttr .= " " . $name . '="' . $value . '" ';
			}
		}

	
		return $oAttr;
		
	}

//		function enumField($obj)
//		{
//		
//	//	
//	//		if ($("[ng-model$='" + obj.name +"']").hasClass("ab-flipped") || $("[ng-model$='" + obj.name +"']").hasClass("hidden"))
//	//		{
//	//			return;
//	//		}
//	//	
//	//	//	alert($('[ng-model="y.VSL_ORST_STEPS"]').length + "=" + obj.name)
//	//		
//	//		var cv = "deflectVal(this.value,'" + obj.name + "');";
//	//		var sf = '<select  class="ab-flipped" ab-bind="'+ obj.name +'" onchange="' + cv + '" >';
//	//		var env = obj.type.slice(obj.type.indexOf("enum(")+5);
//	//		env = env.slice(0,env.indexOf(")"))
//	//		var tmpEnum = obj.comment;
//	//		if (tmpEnum.indexOf("LABEL:") > -1)
//	//		{
//	//			tmpEnum = tmpEnum.slice(tmpEnum.indexOf("LABEL:")+6);
//	//		}
//	//		var enLa = tmpEnum.split(',');
//	//		var enVa = env.split(',');
//	//		
//	//		var occ = 0
//	//		while (occ<enVa.length)
//	//		{
//	//			sf += "<option ab-label='" + enLa[occ] + "' value=" + enVa[occ] + ">" + enLa[occ] + "</option>";
//	//			occ += 1;
//	//		}
//	//		
//	//		sf += "</select>";	
//	//	
//	//		$("[ng-model$='" + obj.name +"']").each(function()
//	//		{
//	//			if ($(this).hasClass("ab-flipped") == false)
//	//			{
//	//				$("[ng-model$='" + obj.name +"']").after(sf);
//	//				$("[ng-model$='" + obj.name +"']").addClass("ab-hidden");
//	//				$("[ng-model$='" + obj.name +"']").addClass("ab-flipped");
//	//			}
//	//			
//	//		});
//			
//			
//		
//		}

	function setFieldWrapper($view,$seq,$tableName,$fieldName,$fieldType,$groupAttrib,$labelAttrib,$inputAttrib,$hardCode)
	{
	
		$grpAttr = $this->buildAttrib($groupAttrib);
		$labAttr = $this->buildAttrib($labelAttrib);
		if (!$inputAttrib["onfocus"])
		{
			$inputAttrib["onfocus"] = "A_Scope.initModels();";
		}
		else
		{
			$inputAttrib["onfocus"] .= ";A_Scope.initModels();";
			$inputAttrib["onfocus"] = ltrim($inputAttrib["onfocus"],";");
		}

		$inpQuery = "";
		if($inputAttrib["query"])
		{
			$inpQuery = "<span title='" . $inputAttrib["query"] . "' class='text-primary' >?</span>";
		}
		
		if (!$inputAttrib["ab-ft"] || $inputAttrib["ab-ft"] != "amt")
		{
			$lead = "";
		}
		else
		{
			$lead = "<label>$</label>";
			if (strlen($inputAttrib["style"])>0)
			{
				$inputAttrib["style"] .= ";";
			}
			$inputAttrib["style"] .= "text-align:right;";
		}
		
		$inpAttr = $this->buildAttrib($inputAttrib);
		
		$fieldHtml = "";
//		$fieldHtml = "<table  ><tr><td>";
		$fieldHtml .= '<div ab-pform="' . $this->formName .'"  ab-pview="' . $view . '" ab-pseq="' . $seq .'" ab-fgroup="'.$fieldName .'" '. $grpAttr .'">';
		
		
		$fieldHtml .= '<div ab-fgrlab="'.$fieldName . '" ' . $labAttr . ' > <span ab-label="' . $fieldName . '" >' .$fieldName.'</span></div>';
		
//		$fieldHtml .= '</td><td>';
		
		$fieldHtml .= '<div ab-fgrinp="'.$fieldName . '" style="margin-left:3px;" >';
		if ($hardCode !="")
		{
			$fieldHtml .= $hardCode;
		}
		else
		{
			if ($readOnly!= "")
			{
				$readOnly .= '=""  aaa="" ';
			}

			
			$fieldHtml .= $lead . '<Input '. $inpAttr . '  ng-model="'.$fieldName.'" value="" />' . $inpQuery;
		}
		
		$fieldHtml .= '</div>';
		
//		$fieldHtml .= '</td></tr></table>';
		
		$fieldHtml .= '</div>';
		
		$done = false;
		$hseq = $seq;
		$occ = 0;
		while ($done == false && $seq != "")
		{
			if (!$this->formData[$view][$seq])
			{
				$this->formData[$view][$seq]['Html'] = $fieldHtml;
				$this->formData[$view][$seq]['tableName'] = $tableName;
				$this->formData[$view][$seq]['fieldName'] = $fieldName;
				$this->formData[$view][$seq]['fieldType'] = $fieldType;
				$done = true;
			}
			else
			{
				$occ += 1;
				$seq = $hseq . "-" . $occ;
			}
			
		}
		
		$this->currHtml = $fieldHtml;	
	
	}
	

function setListerField($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig)
{	


$refHead = "<span title='". $refDetailLink ."' id='" . $refName . "{{" . "$" . "index" ."}}' >";
$refValue = "'" . $refName . "{{" . "$" . "index" ."}}'";


$refDescTop = $refDesc;
if ($searchRefDesc != "")
{
	$refDescTop = $searchRefDesc;
}


$refDetailDeflect = 'onclick="' . "$('#{$refModel}main').html($(this).find('label').html());deflectFlds(this.getAttribute('value'));" . '"';


if (strlen($refDetail) > 0)
{
	
$refDetailDisp = <<<BOD
				
	&nbsp;&nbsp;<span  ab-flst="ab-lister-{$refName}" class='btn glyphicon glyphicon-th-list hidden' onclick="$('[ab-fx{$refModel}de]').toggleClass('hidden');"></span>
BOD;

};


if ($searchRefDesc != "")
{
	$dispHtml = "";
}
else
{

$refDetailDeflect = 'dflval="{' . '{ab_rloop.' . $repeatInRef . '}}"';
$refDetailDeflect .= ' onclick="deflectVal($(this).attr(' . "'dflval'),'" . $refModel . "');" . '"'; 

// $refDetailDeflect = 'ng-click="' . $refModel . " = ab_rloop." . $repeatInRef . ';"';

$dispHtml = <<<BOD


	<span  ng-repeat="ab_rloop in {$repeatIn}"  > 

		<span class="text-muted {{ab_rloop.{$repeatInRef}!={$refModel}?'hidden':''}}">
		{$refDescTop} 	
		</span>
	</span>

BOD;


}


if (strlen($refDetailLink) > 0)
{
	$refDetailDeflect .= " " .  $refDetailLink;
}


$divHtml = <<<BOD



				<div  onmouseover="A_Scope.initModels();" style=""  {$ignTrig} ab-objLister="ab-lister-{$refName},1"  >
					<span style="border:none;border-bottom:solid;border-width:1px;border-color:CornflowerBlue;"   >
						<input id="{$refModel}" ng-model="{$refModel}"  class="ab-hidden" size=5 />
						<input ng-model="ABSEL{$refName}" size=2 placeholder="Select" 
						ng-change="ABfetchSim(ABSEL{$refName},rawResult.{$refName},'ABDFL{$refName}');" 
						value=""  style="background-color:white;" class="small ab-spaceless text-primary" 
						onblur="$(this).val('');"  /> 
						
						<span class="   " id="{$refModel}main" >
						{$searchRefDesc}
						{$dispHtml}
							
						</span>

						<input class="hidden" type="button" value="Select" 
						value=""  style="background-color:white;" class="small ab-spaceless text-primary" 
						onblur="$(this).val('Select ');"  /> 
					</span>
					
				{$refDetailDisp}				
	
				</div>
				<div class="hidden bg-info" ab-flst="ab-lister-{$refName}" style="position:absolute;z-index:1;max-width:100%;">
					
					<div class="ab-wrapper-divsm" >
					<table class=" table-bordered" >
					<tr ng-repeat="ab_rloop in {$repeatIn}" >
					<td style="white-space:nowrap;text-overflow:ellipsis;">
						{$refHead} 
							<input type="hidden"  name="{$refModel}" value="{{ab_rloop.{$repeatInRef}}}" />
							
							
						
						<div class="btn btn-xs {{ab_rloop.{$repeatInRef}!={$refModel}?'hidden':''}}" title="{$refDesc}">

							<span class="ab-border">
								
								&radic; 
								
							</span>
							&nbsp;
							
							<label>
							{$refDesc}
							</label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
						</div>

									
						
						
						<div ab-dfl="ABDFL{$refName}" class="btn btn-xs {{ab_rloop.{$repeatInRef}!={$refModel}?'':'hidden'}}"
							value={$refValue}  title="{$refDesc}"
							{$refDetailDeflect} 
						>	

							<span class="ab-border" style="color:transparent;">
								&radic; 
							</span>
							&nbsp;
							<span >
							<label>
							{$refDesc}
							</label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</span>
						</div>
						
						
						
						<div ab-fx{$refModel}de class='btn-xs disabled hidden' style="padding-left:20px;" >
							<div class="well well-sm">
							<strong>
							{$refDetail}
							</strong>
							</div>
							
					      	</div>
						
					</td>
					</tr>
					
					</table>
					</div>
				</div>


BOD;


	return 	$divHtml;

	}


function setYesNoField($fieldName)
{

$classSetOff = 	"hidden{{" . $fieldName . "!=0?'xx':''}}" ;
$classSetOn = 	"hidden{{" . $fieldName . "!=0?'':'xx'}}" ;

$divHtml = <<<BOD
		
	<div >	
		<input class="hidden ab-flipped" ng-model="{$fieldName}" />	
		<div class=" {$classSetOn}" onmouseover="A_Scope.initModels();">
			<span  ng-click="{$fieldName}='1';" onclick="ab_flip{$fieldName}(1);" class="ab-pointer {$this->inAttrib['class']} ab-border ab-spaceless">
				<span class="" >
					<input type="button"   value="No " ab-asw="{$fieldName}-0"
					style="background-color:white;" class=" ab-spaceless " onblur="$(this).val('No ');"  /> 
				</span>
				
			</span>
		</div>

		<div class=" {$classSetOff} " onmouseover="A_Scope.initModels();">
			<span  ng-click="{$fieldName}='0';" onclick="ab_flip{$fieldName}(0);" class="ab-pointer {$this->inAttrib['class']} ab-border ab-spaceless">
				<span class=" " >
					<input type="button"  value="Yes "  ab-asw="{$fieldName}-1"
						style="background-color:white;" class=" ab-spaceless " onblur="$(this).val('Yes ');"  /> 
				</span>
				
			</span>
		</div>
		<script>
		function ab_flip{$fieldName}(flag)
		{	
			setTimeout(function()
			{
				$("[ab-asw='{$fieldName}-" + flag + "']").focus();
			},100);
		}
		</script>
	</div>
	

BOD;

return $divHtml;						

}


function setEnumField($tableName,$fieldName)
{


$divHtml = <<<BOD
		
	<div>	
		<input class="hidden"  ng-model="{$fieldName}" />

		<select class="hidden " ab-enum="{$tableName},{$fieldName}" 
		onmouseover="A_Scope.initModels();"
		onchange="deflectVal($(this).val(),'{$fieldName}');">
			
			<option  ng-repeat="sef in ab_enum.{$fieldName}" ng-if="sef.selected" 
				ab-label="{{ sef.label }}"
				value="{{ sef.val }}">
				
			</option>
			<option ng-repeat="sef in ab_enum.{$fieldName}"  ng-if="!sef.selected" 
				ab-label="{{ sef.label }}"
				value="{{ sef.val }}"  >
				{{ sef.label }}
			</option>
			
		</select>
		<div ng-if='dbtblInfo.{$tableName}.tblFields && {$fieldName}' ng-init='ABenumControl();'></div>
		
		
	</div>

BOD;

			      
return $divHtml;						

}


function setEnumDisplayVal($tableName,$fieldName,$val)
{


$divHtml = <<<BOD
		
	<div>	
		<input class="hidden"  ng-model="{$fieldName}" />

		<select disabled  class="hidden " ab-enum="{$tableName},{$fieldName}" onchange="deflectVal($(this).val(),'{$fieldName}');">
			
			<option  ng-repeat="sef in ab_enum.{$fieldName}" ng-if="sef.{$fieldName}=='{$val}'" 
				ab-label="{{ sef.label }}"
				value="{{ sef.val }}">
			</option>
			
		</select>
		<div ng-if='dbtblInfo.{$tableName}.tblFields && {$fieldName}' ng-init='ABenumControl();'></div>
		
		
	</div>

BOD;

			      
return $divHtml;						

}

function setEnumDisplay($tableName,$fieldName)
{


$divHtml = <<<BOD
		
	<div>	
		<input class="hidden"  ng-model="{$fieldName}" />

		<select disabled  class="hidden " ab-enum="{$tableName},{$fieldName}" onchange="deflectVal($(this).val(),'{$fieldName}');">
			
			<option  ng-repeat="sef in ab_enum.{$fieldName}" ng-if="sef.selected" 
				ab-label="{{ sef.label }}"
				value="{{ sef.val }}">
			</option>
			<option ng-repeat="sef in ab_enum.{$fieldName}"  ng-if="!sef.selected" 
				ab-label="{{ sef.label }}"
				value="{{ sef.val }}"  >
				{{ sef.label }}
			</option>
			
		</select>
		<div ng-if='dbtblInfo.{$tableName}.tblFields && {$fieldName}' ng-init='ABenumControl();'></div>
		
		
	</div>

BOD;

			      
return $divHtml;						

}



function setYesNoDisplay($fieldName)
{

$classSetOff = 	"hidden{{" . $fieldName . "!=0?'xx':''}}" ;
$classSetOn = 	"hidden{{" . $fieldName . "!=0?'':'xx'}}" ;

$divHtml = <<<BOD
		
	<div >	
		<input class="hidden" ng-model="{$fieldName}" />	
		<div class=" {$classSetOn}" >
			<span class=" {$this->inAttrib['class']} ab-spaceless">
				<span class="" >
					No
				</span>
				
			</span>
		</div>

		<div class=" {$classSetOff} " >
			<span class=" {$this->inAttrib['class']}  ab-spaceless">
				
				
				<span class=" " >
					Yes
				</span>
				
			</span>
		</div>
	</div>

BOD;

return $divHtml;						

}




function setDatePick($fieldName)
{

	
$divHtml = <<<BOD

	
 <div  ><input ab-datepick type="text" size=10 placeholder="yyyymmdd" ng-model="{$fieldName}"   title="default settings" ></div>


BOD;

return 	$divHtml;					

}

/*

$( "[ab-datepick]" ).each(function()
{
		$(this).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,			
			showOn: "button",
			buttonText: "<span class='glyphicon glyphicon-th-list'></span>",
			dateFormat: "yymmdd"
		});		
	
});	



*/





function setDatePickRepeat($fieldName,$repeatId)
{
	
$divHtml = <<<BOD
<script>
	$(function() {
		$( "#{$fieldName}{$repeatId}" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,			
			showOn: "button",
			buttonText: "<span class='glyphicon glyphicon-th-list'></span>",
			dateFormat: "yymmdd"
		});		
	});
</script>

 <div><input id="{$fieldName}{$repeatId}"  type="text" size=7 placeholder="yyyymmdd" ng-model="{$fieldName}"   title="default settings" ></div>
	
BOD;

return 	$divHtml;					

}


function setgridLable($repeatIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc) {
   
	$dispHtml = <<<BOD
   <span ng-repeat="ab_rloop in {$repeatIn}" class="{{ab_rloop.{$repeatInRef}=={$refModel}?'':'hidden'}}">
						{$refDesc}
					</span>	
	
BOD;
 return $dispHtml;
}

function setMonthPickRepeat($fieldName,$repeatId)
{

$divHtml = <<<BOD
<script>
	
    $(".monthPicker").datepicker({ 
        dateFormat: 'mm-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        onClose: function(dateText, inst) {  
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
            $(this).val($.datepicker.formatDate('yy-mm', new Date(year, month, 1)));
        }
    });

    $(".monthPicker").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });    
    });

</script>

 
	
BOD;

return 	$divHtml;	
    
}

function setSearchMaster($params)
{
	$searchLabel = $params["searchLabel"];
	$searchTable = $params["searchTable"];
	$searchJoin = $params["searchJoin"];
	$searchResult = $params["searchResult"];
	$searchFilter = $params["searchFilter"];
	$filterExclude = $params["filterExclude"];
	$filterAuto = $params["filterAuto"];
	$orderBy = $params["orderBy"];
	$callBack = $params["callBack"];
	$objFunctions = $params["objFunctions"];
	$objGroupBy = $params["objGroupBy"];	
	
$searchMaster = <<<EOC

<div  >
	<div class="{{ABsearchTbl=='{$searchResult}'?'':'hidden'" >
	<form>
		<table style="width:100%;" ng-init="ABsetCurTable('','{$searchResult}');ABgetLabels();ABrangeFilters('ABsPattern{$searchResult}');">
		
			<tr>
				<td style="white-space:nowrap;padding-left:5px;"  >
					<span class="text-primary ab-strong" ab-label="STD_SEARCH" ></span>&nbsp;
					<span class="text-primary ab-strong" ab-label="{$searchLabel}" >{$searchTable}</span>
					<input class="hidden" id="ABsTable{$searchResult}" value="{$searchTable}" />
					<input class="hidden" id="ABsJoin{$searchResult}" value="{$searchJoin}" />
					<input class="hidden" id="ABsResult{$searchResult}" value="{$searchResult}" />
					<input class="hidden" id="ABsOrder{$searchResult}" value="{$orderBy}" />
					
					<input ng-model="ABsPattern{$searchResult}" class="small" size=30 title="Wild card search all fields" />
					<button id="ABsPattern{$searchResult}" 
					class="ab-borderless text-primary small ab-pointer" 
					ng-click="ABsearchAlias('{$searchTable}','{$searchJoin}',ABsPattern{$searchResult},'{$searchResult}','{$orderBy}','{$callBack}','{$objFunctions}','{$objGroupBy}')" >
						<span ab-label="STD_SUBMIT"> Find</span>
					</button>					
					<!--
					<input ng-model="ABsPattern" class="small" size=30 title="Wild card search all fields" />
					<button id="{{ABsearchTbl=='{$searchResult}'?'ABsPattern':''}}" 
					class="ab-borderless text-primary small ab-pointer" 
					ng-click="ABsearchAlias('{$searchTable}','{$searchJoin}',ABsPattern,'{$searchResult}','{$orderBy}')" >
						<span ab-label="STD_SUBMIT"> Find</span>
					</button>
					-->
					&nbsp;&nbsp;&nbsp;&nbsp;
					<span 	
						class="ABSTFILT{$searchTable} btn btn-success btn-md {$searchFilter}" 
						onclick="$('.ABSTDATA{$searchTable}').toggleClass('hidden');"
						ng-click="ABsetAutoFilter('{$searchResult}');";
						ab-label="STD_FILTERS" >
						Range
					</span>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<span ab-label="STD_WAIT" class="{{ABsearchWait=='on'?'':'hidden'}}"></span>
					{{ABREQUEST}}
					
				</td>
			</tr>
			<tr>
		
				<td>
					<input 
						ng-model="ABSTCLICK{$searchTable}"
						fname=""
						fcomment=""
						ftype=""
						tcomment=""
						ng-click="ABrangeTable('ABSTCLICK{$searchTable}');" 
						class="hidden" size=2
						id="ABSTCLICK{$searchTable}" />

				</td>
			</tr>


		</table>
	</form>
	</div>

	<div id="ABSTDATA{$searchTable}"  style="position:fixed;left:30px;z-index:1;" class="row hidden ab-border well ABSTDATA{$searchTable}"  >
	<table class="{$searchFilter} ab-strong ab-container" >
		<tr>
			<td class="text-success ab-strong ab-spaceless btn btn-md" style="white-space:nowrap;" >
				<label>			
				<span class="" ab-label="{$searchLabel}" >{$searchTable}</span>&nbsp;
				<span class="" ab-label="STD_FILTERS" ></span>&nbsp;
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="{{ABrangeSubmit==true?'':'hidden'}} " >
					<span 	onclick="$('.ABSTDATA{$searchTable}').toggleClass('hidden');"
						ng-click="ABsearchSubmit('ABsPattern{$searchResult}','{$searchResult}','{$callBack}','{$objFunctions}','{$objGroupBy}');ABsetCurTable('','{$searchResult}');" 
						class="btn btn-success btn-md ab-strong" >
						<span ab-label="STD_SUBMIT" >Submit to Search</span>
						&nbsp;
						<span ab-label="STD_FILTERS" ></span>
					</span>
				</span>
									
			</td>
			<td style="padding-left:5px;padding-right:5px;min-width:100px;">
			
				<table style="width:100%;" >
				<tr>
				<td>
				<!-- <input class="hidden" ng-model="{$searchResult}ABcurTable" ng-init="ABsetCurTable('','{$searchResult}');" /> -->
				<ul class="nav nav-tabs">
				  <li class="dropdown" style="padding-left:5px;" >
				    <span class="dropdown-toggle btn btn-success btn-md ab-spaceless" data-toggle="dropdown">
				    	Table
				    	<span class="caret"></span>
				    </span>
				    <ul class="dropdown-menu" >
				      <li ng-repeat="tbls in {$searchResult}_searchTable" >
				      	<span class="text-primary btn-link ab-pointer" ng-click="ABsetCurTable(tbls.tblInfo.tblName,'{$searchResult}');" style="white-space:nowrap;padding:0px;" >
				      	{{ tbls.tblInfo.tblComment }}
				      	</span>
				      </li>
				    </ul>
				  </li>
				</ul>
				</td>
				<td class="text-right">
					<span 
						class="btn btn-success btn-sm ab-spaceless {{{$searchResult}ABcurTable!=''?'':'hidden'}}" 
						ng-click="ABsetCurTable('','{$searchResult}');">
					&nbsp;X&nbsp
					</span>
				</td>
				</tr>
				</table>
							
			</td>
		</tr>						
		<tr class="ab-container">
			<td  style="padding-top:5px;vertical-align:top;">
				<div class="ab-wrapper-divmd"
					id="ABrangeTable{$searchResult}"
				 >
				</div>
			</td>

			<td   style="padding-left:15px;vertical-align:top;" >	

				<div ng-repeat="tables in {$searchResult}_searchTable"  
				class="{{tables.tblInfo.tblName=={$searchResult}ABcurTable?'':'hidden'}} ab-border ab-wrapper-divmd "  >

					<span class="well" style="white-space:nowrap;padding:0px;" >
						{{tables.tblInfo.tblComment}}
					</span>
					
					<div class="ab-spaceless ab-border ab-pointer" 
						onmouseover="$('.'+$(this).attr('ab-searchid')+'-DIV').addClass('bg-danger');"
						onmouseout="$('.'+$(this).attr('ab-searchid')+'-DIV').removeClass('bg-danger');"
						ab-searchid="{{fields.name}}"
						ng-click="ABrangeTable(fields.name,fields.comment,fields.type,tables.tblInfo.tblComment,'{$searchResult}');"
						ng-repeat="fields in tables.tblFlds.dta" 
						alain="{$filterAuto}"
						ab-filter-auto="{{ABisAutoFilter('{$filterAuto}','{$searchResult}',fields.name,fields.comment,fields.type,tables.tblInfo.tblComment)}}"
						ng-if="ABisConstraintField(fields,tables,'{$filterExclude}')==false"  >
						
							<a class="small ab-strong" ng-if="fields.comment.indexOf('LABEL:')>-1"  >
								<span ab-label="{{fields.name}}">{{fields.comment.slice(0,fields.comment.indexOf("LABEL:"))}}. </span>
							</a>
							<a class="small ab-strong" ng-if="fields.comment.indexOf('LABEL:')< 0"  >
								<span ab-label="{{fields.name}}">{{fields.comment}}. </span>
							</a>
							
					</div>
<!--					
					<span class="hidden" ng-if="$last==true" >
						<span ng-init="ABgetLabels()">
						
						</span>
					</span>
-->
				</div>	
				
			</td>
		</tr>
		
	</table>
	</div>
	



<script>

function ABexecClick(clickName,obj)
{
	$("#" + clickName).attr("fname",obj.attr("fname"))
	$("#" + clickName).attr("fcomment",obj.attr("fcomment"))
	$("#" + clickName).attr("ftype",obj.attr("ftype"))
	$("#" + clickName).attr("tcomment",obj.attr("tcomment"))
	$("#" + clickName).click();
}

function ABprepOver()
{

	if ( $("#ABSTDATA{$searchTable}"))
	{
		var popHead = $("#ABSTDATAHEAD{$searchTable}").html();
		var thmlCode = $("#ABSTDATA{$searchTable}").html();
		// thmlCode = $("#tester").html();
	
    		$('.ABSTFILT{$searchTable}').popover({title: popHead, content: thmlCode, html: true, placement: "bottom"}); 
    		$("#ABSTDATA{$searchTable}").remove()
    	}

}
</script>
</div>

	
EOC;

	return $searchMaster;

}









}

// UNDER BEGIN

function setListerFieldTEST($keepOrg,$repeatIn,$searchIn,$refName,$refModel,$searchInRef,$searchRefDesc,$repeatInRef,$refDesc,$refDetail,$refDetailLink,$ignTrig)
{	


$refHead = "<span title='". $refDetailLink ."' id='" . $refName . "{{" . "$" . "index" ."}}' >";
$refValue = "'" . $refName . "{{" . "$" . "index" ."}}'";


$refDescTop = $refDesc;
if ($searchRefDesc != "")
{
	$refDescTop = $searchRefDesc;
}


$refDetailDeflect = 'onclick="' . "$('#{$refModel}main').html($(this).find('label').html());deflectFlds(this.getAttribute('value'));" . '"';


if (strlen($refDetail) > 0)
{
	
$refDetailDisp = <<<BOD
				
	&nbsp;&nbsp;<span  ab-flst="ab-lister-{$refName}" class='btn glyphicon glyphicon-th-list hidden' onclick="$('[ab-fx{$refModel}de]').toggleClass('hidden');"></span>
BOD;

};


if ($searchRefDesc != "")
{
	$dispHtml = "";
}
else
{

$refDetailDeflect = 'dflval="{' . '{ab_rloop.' . $repeatInRef . '}}"';
$refDetailDeflect .= ' onclick="deflectVal($(this).attr(' . "'dflval'),'" . $refModel . "');" . '"'; 

// $refDetailDeflect = 'ng-click="' . $refModel . " = ab_rloop." . $repeatInRef . ';"';

$dispHtml = <<<BOD


	<span  ng-repeat="ab_rloop in {$repeatIn}"  > 

		<span class="text-muted {{ab_rloop.{$repeatInRef}!={$refModel}?'hidden':''}}">
		{$refDescTop} 	
		</span>
	</span>

BOD;


}


if (strlen($refDetailLink) > 0)
{
	$refDetailDeflect .= " " .  $refDetailLink;
}


$divHtml = <<<BOD



				<div  class="  "  {$ignTrig} ab-objLister="ab-lister-{$refName},1"  >
					<span style="border:none;border-bottom:solid;border-width:1px;border-color:CornflowerBlue;"   >
						<input id="{$refModel}" ng-model="{$refModel}"  class="ab-hidden" size=5 />
						<span class="   " id="{$refModel}main" >
						{$searchRefDesc}
						{$dispHtml}
							
						</span>
						<input type="button"  value="Select "  style="background-color:white;" class="small ab-spaceless text-primary" onblur="$(this).val('Select ');"  /> 
					</span>
					
				{$refDetailDisp}				
	
				</div>
				<div class="hidden " ab-flst="ab-lister-{$refName}" >
					
					<div class="ab-wrapper-divsm" >
					<table class=" table-bordered" >
					<tr ng-repeat="ab_rloop in {$repeatIn}" >
					<td>
						{$refHead}
							<input type="hidden"  name="{$refModel}" value="{{ab_rloop.{$repeatInRef}}}" />
							
							
						</span>
						<div class="btn btn-xs {{ab_rloop.{$repeatInRef}!={$refModel}?'hidden':''}}" >

							<span class="ab-border">
								
								&radic; 
								
							</span>
							&nbsp;
							
							<label>
							{$refDesc}
							</label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
						</div>

									
						
						
						<div class="btn btn-xs {{ab_rloop.{$repeatInRef}!={$refModel}?'':'hidden'}}"
							value={$refValue}
							{$refDetailDeflect} 
						>	

							<span class="ab-border" style="color:transparent;">
								&radic; 
							</span>
							&nbsp;
							<span >
							<label>
							{$refDesc}
							</label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</span>
						</div>
						
						
						
						<div ab-fx{$refModel}de class='btn-xs disabled hidden' style="padding-left:20px;" >
							<div class="well well-sm">
							<strong>
							{$refDetail}
							</strong>
							</div>
							
					      	</div>
						
					</td>
					</tr>
					
					</table>
					</div>
				</div>


BOD;


	return 	$divHtml;

	}





// UNDER END
?>