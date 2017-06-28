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
			showOn: "button",
			buttonText: "<span class='glyphicon glyphicon-th-list'></span>",
			dateFormat: "yymmdd"
		});		
	});

	
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
		if (!$inputAttrib["onclick"])
		{
			$inputAttrib["onfocus"] = "A_Scope.initModels();";
		}
		else
		{
			$inputAttrib["onfocus"] .= ";A_Scope.initModels();";
			$inputAttrib["onfocus"] = ltrim($inputAttrib["onclick"],";");
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

			
			$fieldHtml .= $lead . '<Input '. $inpAttr . '  ng-model="'.$fieldName.'" value="" />';
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



				<div  class="  "  {$ignTrig} ab-objLister="ab-lister-{$refName},{$keepOrg}"  >
					<span style="border:none;border-bottom:solid;border-width:1px;border-color:CornflowerBlue;"   >
						<input id="{$refModel}" ng-model="{$refModel}"  class="ab-hidden" size=5 />
						<span class="  text-primary " id="{$refModel}main" >
						{$searchRefDesc}
						{$dispHtml}
							
						</span>
						<span class="caret text-primary "></span>
					</span>
					
				{$refDetailDisp}				
	
				</div>
				<div class="hidden " ab-flst="ab-lister-{$refName}" >
					
					<div class="mygrid-wrapper-divSm" >
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


function setYesNoField($fieldName)
{

$classSetOff = 	"hidden{{" . $fieldName . "!=0?'xx':''}}" ;
$classSetOn = 	"hidden{{" . $fieldName . "!=0?'':'xx'}}" ;

$divHtml = <<<BOD
		
	<div>	
		<input class="hidden" ng-model="{$fieldName}" />	
		<div class=" {$classSetOn}" >
			<span>
				
				<label 
					<span ab-label="STD_NO" style="min-width:40px;" >
					No
					</span>
					
				</label>
				
			</span>
			<span ng-click="{$fieldName}=1;" class="ab-pointer {$this->inAttrib['class']} ab-border ab-spaceless">
				
				<span class="btn-link  " >
					<span  class="glyphicon glyphicon-ok invisible small"  ></span>	
				</span>
				
			</span>
		</div>

		<div class=" {$classSetOff}" >
			<span>
				<label ab-label="STD_YES" style="min-width:40px;">
				Yes
				</label>
				
			</span>
			<span ng-click="{$fieldName}=0;" class="ab-pointer {$this->inAttrib['class']} ab-border ab-spaceless">
				
				
				<span class="btn-link  " >
					<span  class="glyphicon glyphicon-ok small " ></span>	
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

	
 <div><input ab-datepick type="text" size=7 placeholder="yyyymmdd" ng-model="{$fieldName}"   title="default settings" ></div>
 <div><input ab-datepick type="text" size=7 placeholder="yyyymmdd" ng-model="{$fieldName}"   title="default settings" ></div>

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

}

?>