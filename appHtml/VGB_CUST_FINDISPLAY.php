	<div class="row">
		
		<div class="col-lg-5" >
			<span ab-label='STD_BILL_TO' class='small text-primary'>Bill</span>
       			<div>
	       			{{ VGB_ADDR_ADNAM }}
	       		</div>
       			<div class="{{VGB_ADDR_ADD01!=''?'':'hidden'}}  ">
	       			{{ VGB_ADDR_ADD01 }}
	       		</div>
       			<div class="{{VGB_ADDR_ADD02!=''?'':'hidden'}}  ">
				{{ VGB_ADDR_ADD02 }}
			</div>
			<div>
				<span class="{{VGB_ADDR_CITYN!=''?'':'hidden'}}  "> {{ VGB_ADDR_CITYN }} </span>
				<span class="{{VGB_ADDR_POSTC!=''?'':'hidden'}}  "> ,{{ VGB_ADDR_POSTC }}</span>
			</div>	        
		</div>	
		<div class="col-lg-7" >
			<div class="row">
				<div class="col-lg-7" >
	       				<span class="{{!VGB_ADDR_CONT1?'hidden':''}} " >
			       			<span ab-label="VGB_ADDR_CONT1" class="text-primary small "></span>{{ VGB_ADDR_CONT1 }}
			       		</span>
				</div>
				<div class="col-lg-5" >
		       			<span class="{{!VGB_ADDR_TEL01?'hidden':''}} " >
			       			<span ab-la2bel="VGB_ADDR_TEL01" class="text-primary small ">Tel :</span>{{ VGB_ADDR_TEL01 }}
			       		</span>

				</div>
				
				<div class="col-lg-7" >
				</div>
	       			<div class="col-lg-5 {{!VGB_ADDR_FAX01?'hidden':''}}  ">
		       			<span ab-la2bel="VGB_ADDR_FAX01" class="text-primary small ">Tel : </span>{{ VGB_ADDR_FAX01.length }}
		       		</div>      			

				<div class="col-lg-7" >
				</div>
		       		<div class="col-lg-5 {{!VGB_ADDR_EMAIL?'hidden':''}}  ">
		       			<span ab-la2bel="VGB_ADDR_EMAIL" class="text-primary small ">E-Mail:</span>{{ VGB_ADDR_EMAIL }}
		       		</div>
		       		<div class="col-lg-7" >
		       			<span ab-label="VGB_ADDR_CONT2" class="{{!VGB_ADDR_CONT2?'hidden':''}}  text-primary small "></span>{{ VGB_ADDR_CONT2 }}
		       		</div>
		       		<div class="col-lg-5 {{!VGB_ADDR_TEL02?'hidden':''}} " >
		       			<span ab-la2bel="VGB_ADDR_TEL02" class="text-primary small ">Tel :</span>{{ VGB_ADDR_TEL02 }}
		       		</div>

				<div class="col-lg-7" >
				</div>

	       			<div class="col-lg-5 {{!VGB_ADDR_FAX02?'hidden':''}}  ">
		       			<span ab-la2bel="VGB_ADDR_FAX02" class="text-primary small ">Tel :</span>{{ VGB_ADDR_FAX02 }}
		       		</div>      			
				<div class="col-lg-7" >
				</div>
		       		
	       			<div class="col-lg-5 {{!VGB_ADDR_TAXEX?'hidden':''}}  ">
		       			<span ab-la2bel="VGB_ADDR_TAXEX" class="text-primary small ">E-Mail:</span>{{ VGB_ADDR_TAXEX }}
		       		</div>
		       						
				
				
			</div>	
		</div>
	</div>	
	<div class="row">
		<div class="col-lg-6" >
		
<?php

// VGB_CUST_CURID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CURID";
$hardCode = "<span class='ab-strong'>{{ VGB_CURR_CURID}} &nbsp;&nbsp {{ VGB_CURR_DESCR}}</span>";
$hardCode .= "&nbsp;&nbsp;<span ab-label='STD_RATE' ></span>&nbsp;<span class='ab-strong'>{{ VGB_CURR_CURAT}} &nbsp;&nbsp</span>";
$xtmp->setFieldWrapper("view02","2.6","vgb_cust","VGB_CUST_CURID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>
		</div>
		<div class="col-lg-6" >

<?php

		

// VGB_CUST_TERID
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_TERM_TERID";
$hardCode = "<span class='ab-strong'>{{ VGB_TERM_TERID }}&nbsp;&nbsp;{{ VGB_TERM_DESCR}}";
$hardCode .= "&nbsp;&nbsp;<span ab-label='VGB_TERM_NETDA' class='text-primary' ></span><span>:&nbsp;{{ VGB_TERM_NETDA}}</span><br>";
$hardCode .= "<span ab-label='VGB_TERM_DISDA' class='text-primary' ></span><span>:&nbsp;{{ VGB_TERM_DISDA}}</span>";
$hardCode .= "&nbsp;&nbsp;<span ab-label='VGB_TERM_DISCN' class='text-primary' ></span><span>:&nbsp;{{ VGB_TERM_DISCN}}</span></span>";
$xtmp->setFieldWrapper("view02","2.5","vgb_cust","VGB_CUST_TERID","",$grAttr,$laAttr,$inAttr,$hardCode);
echo $xtmp->currHtml;

?>
		</div>
	</div>	
	<div class="row">
		
		
<?php
// VGB_CUST_CRELI
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$laAttr['ab-label'] = "VGB_CUST_CRELI";
$inAttr['size'] = "8";
$inAttr['readonly'] = "";
$inAttr['class'] .= " ab-strong ";
$inAttr['ab-ft'] = "amt";
$xtmp->setFieldWrapper("view02","2.4","vgb_cust","VGB_CUST_CRELI","",$grAttr,$laAttr,$inAttr,"");

$holdCode = $xtmp->currHtml;

//VGB_CUST_CRHOL
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$hardCode = "<span class='ab-strong'>" . $xtmp->setYesNoDisplay("VGB_CUST_CRHOL") . "</span>";
$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_CRHOL","",$grAttr,$laAttr,$inAttr,$hardCode);

$holdCode2 = $xtmp->currHtml;




// VGB_CUST_OVERD
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;

$laAttr['ab-label'] = "STD_OVERDUE_DAYS";
$inAttr['size'] = 2;
$inAttr['readonly'] = "";
$inAttr['class'] .= " ab-strong ";
$xtmp->setFieldWrapper("view02","2.4","vgb_cust","VGB_CUST_OVERD","",$grAttr,$laAttr,$inAttr,"");


echo "<div class='col-lg-3' >" . $holdCode . "</div><div class='col-lg-3' >" . $holdCode2 . "</div><div class='col-lg-3' >" . $xtmp->currHtml . "</div>";



?>
	</div>	
	<div class="row">

		<div class="col-lg-12" >
		
<?php
$hardCode = "<table>";


$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "20";
$inAttr['readonly'] = "";
$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";

$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_CUBNK","",$grAttr,$laAttr,$inAttr,"");
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td ab-label='STD_NAME' class='" . $laAttr['class'] . "' ></td>";
$hardCode .= "<td>" . $xtmp->currHtml . "</td></tr>";


// VGB_CUST_CREDR 
$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr['size'] = "20";
$inAttr['readonly'] = "";
$grAttr['class'] = " ";
$grAttr['style'] = " ";
$laAttr['class'] = "hidden";

$xtmp->setFieldWrapper("view02","0.0","vgb_cust","VGB_CUST_CREDR","",$grAttr,$laAttr,$inAttr,"");
$laAttr = $xtmp->laAttrib;
$laAttr["class"] = "small text-muted";
$hardCode .= "<tr><td ab-label='STD_REF' class='" . $laAttr['class'] . "' ></td>";
$hardCode .= "<td>" . $xtmp->currHtml . "</td></tr>";



$hardCode .= "</table>";

$grAttr = $xtmp->grAttrib;
$laAttr = $xtmp->laAttrib;
$inAttr = $xtmp->inAttrib;
$inAttr["ab-label"] = "STD_BANK";

$xtmp->setFieldWrapper("view02","0.0","vgb_cust","STD_BANK","",$grAttr,$laAttr,$inAttr,$hardCode);

echo $xtmp->currHtml;
?>		
		</div>
	</div>
</div>