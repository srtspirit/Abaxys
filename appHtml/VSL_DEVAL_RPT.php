<?php require_once "../stdSscript/stdAppobjGen.php"; ?>
<div class="hidden">
<?php 
session_start();ob_clean();
require_once "../appCscript/HIS_REPORTS.php"; 
require_once "../stdSscript/stdSessionVarQuery.php" ;
?>
</div>




<style>

@media print
{

	td
	{ 
		vertical-align:top;
		text-size: -20%;
		
	}


	div.rheader
	{
		position:relative;
		Height: 25px;
		visibility: visible;
		
	}

	div.report
	{
		position:relative;
		top:0px;
		left:0px;
		height:100%;
		width:100%;
		overflow:hidden;
	}

	button
	{
		background-color: transparent;
		border: none;
	}
	
	a
	{
		visibility: hidden
	}
	

	
}

td.dline
{
	border-style: none;
	font-size: small;
	vertical-align:top;
	background-color: WhiteSmoke;
}

td.filter
{
	text-align:left;
	vertical-align: top;
	padding-left: 10px;	
}

td.filterl
{
	text-align:left;
	vertical-align: top;
	padding-left: 10px;
	font-size:small;	
}

td.titleSmall
{
	font-size: small;
	font-weight: bold;
}

button.filter
{
	font-size: 6pt;
	border-top: none;
	border-left: none;
	background-color: LightSteelBlue ;
	color: white;
	
}

div
{
	page-break-after:avoid;
}


div.head
{
	page-break-before:always;
}

div.select
{
	position:relative;
	width:100%;
	Height: 350px;
	overflow: auto;
	background-color: lightgrey;
	font-size: small;
}

div.report
{
	position:relative;

	width:100%;
	overflow:hidden;
	z-index:1;
	
}

div.rheader
{
	position:relative;
	Height: 1px;
	visibility: hidden;
	
}

div.header
{
	position:relative;
	top:0px;
	left:0px;
	height:100%;
	width:100%;
	overflow:hidden;
	z-index:2;
}




div.headerMin
{
	position:relative;
	top:0px;
	left:0px;
	height:30px;
	width:100%;
	overflow:hidden;
	z-index:2;
}



div.headeron
{
	position:absolute;
	top:0px;
	left:0px;
	height:100%;
	width:100%;
	background-color: lightgrey;
	overflow:hidden;
	vertical-align:top;
	z-index:2;
}

table
{
	border:solid;
	border-width: 1px;
	border-color: transparent;	
}

.posfixed
{
	position:fixed;

	z-index: 2;
	background-color:white;
}

.lister 
{
	overflow: visible;
	overflow-x: hidden;
	padding:10px;
	max-height: 400px;	
}

td.title
{
	white-space: nowrap;
	text-align: center;
	font-size:-2;
}

tr.head
{
	
	border:solid;
	border-width: 1px;
	border-color: GhostWhite;
	background-color:Gainsboro; 
	border: none;
}

tr.noshow
{
	position:absolute;
	top:-1px;
	height: 1px;
	visibility: hidden;
	border: none;
}



tr.total
{
	border-style:solid;
	border-width: 1px;
	border-color: Lavender;
	border-top-color: transparent;
	

}

tr.firstshow

{
	position:relative;
	visibility:visible;
	height: 100%;
	top: 0px;
	font-size: -1;
	border-color: transparent;
	border-top-color: blue;
}

tr.goshow
{
	position:relative;
	visibility:visible;
	height: 100%;
	top: 0px;
	font-size: -1;
	border-color: transparent;
}

</style>

<script type="text/javascript">
 
 	var head
	var xmlDoc = new Array() 
	var recFilters = new Array()	
	var currSortField = ""
	var filtersOnPartners = false;
	var filtersOnItems = false;
	var filtersOnRanges = false

function fieldVal(recSet,fieldName,recSeq)
{
	var ret = ""
	
	try
	{
		ret = 	eval("recSet."+fieldName)
	}

	catch(er){}
		
	return (ret)
}	

function refreshPage(sfield)
{
	
	document.getElementsByName("REPORT")[0].innerHTML = "<table><tr><td>One moment please - Un instant S.V.P.</td></tr></table>"
	setTimeout("changeSort('"+sfield+"')",1);
}

function changeSort(sfield)
{
	currSortField = sfield
	
	var sortList = new Array()
	var workVar

	var filterSet = false
	if (recFilters.length == 0)
	{
		recFilters[0] = ""; // Customers
		recFilters[1] = ""; // Items
		filterSet = true
	}

	// Init gTotals
	document.getElementById("totVal00").value =  ""
	document.getElementById("totVal01").value =  ""
	document.getElementById("totVal02").value =  ""
	document.getElementById("totVal03").value =  ""
	document.getElementById("totVal04").value =  ""
	document.getElementById("totVal05").value =  ""	
	
	
	var evalString = "xmlDoc[occ]." + sfield
	var occ = 0



	document.getElementsByName("title")[0].innerHTML = unescape(head.TTEXT)
	
	
	document.getElementsByName("title")[0].innerHTML += "&nbsp;&nbsp;(" + formDate(unescape(head.DELFR))
	document.getElementsByName("title")[0].innerHTML += "&nbsp;to&nbsp;" + formDate(unescape(head.DELTO)) + ")"


	
	while (occ < xmlDoc.length)
	{
		workVar = eval(evalString)
		sortList[sortList.length] = workVar + "[=" + String(occ)
		occ += 1
	}
	
	var outVar = ""
	var detVar = ""
	var recVar
	var seq = 0
	
	var pageNumber = 1
	outVar += placeHeading(pageNumber,sfield,0)
	
	

	sortList.sort()
	
	var lastKey = ""
	var tmpRec
	
	var wvar
	
	occ = 0
	seqOcc = 0
	
	while (occ < sortList.length)
	{
		seq = Number(sortList[occ].slice(sortList[occ].lastIndexOf("[=")+2))
		recVar = xmlDoc[seq]

		if (filterSet == true)
		{
			if (recFilters[0].indexOf(fieldVal(recVar,"BTCUS",0)) == -1)
			{
				recFilters[0] = recFilters[0] + fieldVal(recVar,"BTCUS",0) + "|"
			}
			if (recFilters[1].indexOf(fieldVal(recVar,"ITMID",0)+"|") == -1)
			{
				recFilters[1] = recFilters[1] + fieldVal(recVar,"ITMID",0) + "|"
			}
		}

		if (filterSet == true || recFiltersValid(recVar) == true)
		{
		
			if (lastKey != sortList[occ].slice(0,sortList[occ].lastIndexOf("[=")))
			{
				
				if (lastKey != "" && listSeq.length > 0)
				{
					wvar = setTotal(listSeq,sfield,lastKey)
					if (wvar.length > 0)
					{
						outVar += wvar
						outVar += detVar
						seqOcc += 1
					}
				}
				
				detVar = ""
				var listSeq = new Array()
				if (Math.round(seqOcc/25) == seqOcc/25 && seqOcc > 0)
				{
					pageNumber += 1
					outVar += placeHeading(pageNumber,sfield,1)
				}
	
				lastKey = sortList[occ].slice(0,sortList[occ].lastIndexOf("[="))
				
				
			}
			
			
			var gTotals = new Array()
			gTotals[0] = 0
			gTotals[1] = Number(stripLeadSpaces(fieldVal(recVar,"TLREC",0)))
			gTotals[2] = Number(stripLeadSpaces(fieldVal(recVar,"TREAD",0)))
	
			try
			{
				gTotals[0] = Math.round((gTotals[2]-gTotals[1])/gTotals[2]*100)
			}catch(er){gTotals[0]=0;}

			
			
			listSeq[listSeq.length] = seq
			
			detVar += "<tr class='noshow' id='" + lastKey +"' name='" + lastKey +"' >"
			detVar += setCell(recVar,"ORNUM",sfield,0)
			detVar += setCell(recVar,"BTCUS",sfield,0)
			detVar += setCell(recVar,"BPNAM",sfield,0)
			detVar += setCell(recVar,"ITMID",sfield,0)
			detVar += setCell(recVar,"DESC1",sfield,0)
			detVar += setCell(recVar,"LEADT",sfield,0)
			detVar += "<td class='dline'>" + gTotals[0] + "%</td>"
			detVar += setCell(recVar,"TLDAY",sfield,0)
			detVar += setCell(recVar,"TLREC",sfield,0)
			detVar += setCell(recVar,"TREAD",sfield,0)
			detVar += setCell(recVar,"TMAXL",sfield,0)
			detVar += setCell(recVar,"USLNA",sfield,0)
			detVar += "</tr>"

		}		
		
		occ += 1
		
		
	}

	if (lastKey != "")
	{
		outVar += setTotal(listSeq,sfield,lastKey)
		outVar += detVar
	}	

	outVar += "</table></div>"

	pageNumber += 1
	outVar += placeHeading(pageNumber,sfield,2)


	
	var retVar = "<table>" + placeHeading(0,sfield,2)

	document.getElementsByName("REPORT")[0].innerHTML = retVar + outVar

	if (filterSet == true)
	{
		initFilters()	
	}
}


function formDate(tmp)
{
	return tmp;
	// Retured
	tmp += "Not Valid"
	tmp = tmp.slice(0,11)
	var ret = tmp.slice(0,4) + tmp.slice(4,7) + tmp.slice(7)  
	return (ret)
}



function initFilters()
{

	
	recFilters[0] = recFilters[0].slice(0,recFilters[0].length-1)
	recFilters[1] = recFilters[1].slice(0,recFilters[1].length-1)
	var tt0 = recFilters[0].split("|")
	var tt1 = recFilters[1].split("|")

	tt0.sort()
	tt1.sort()
	
	var btcusMin = ""
	var btcusMax = "" 
     
	var itmidMin = "" 
	var itmidMax = "" 
	
	
	
	var filtRec = "<table style='width:100%;' >"
	
	var filtRecSet = '$(".fltCust").click();'
	
	filtRec += "<tr><td class='filterl'><input type='radio' class='ab-pointer' onclick='updFilter(this,0);" + filtRecSet + "' value='fltCust' />Clear Selections</td></tr>"
	filtRec += "<tr><td class='filterl'><input type='radio' class='ab-pointer' onclick='updFilter(this,1);" + filtRecSet + "' value='fltCust' />Select All</td></tr>"
	
	
	var occ = 0
	while (occ < tt0.length)
	{

		filtRec += "<tr><td class='filterl'>&nbsp;<input type='checkbox' class='ab-pointer'  onclick='" + filtRecSet + "' value='fltCust' name='fltCust' checked='checked' id='" + tt0[occ] +"' />&nbsp;" + unescape(tt0[occ]) + "</td></tr>"
		occ +=1
	}
	  
	filtRec += "</table>"
	
	document.getElementsByName("filterCust")[0].innerHTML = filtRec
	
	filtRec = "<table style='width:100%;' >"
	var filtRecSet = '$(".fltItem").click();'
	
	filtRec += "<tr><td class='filterl'><input type='radio' class='ab-pointer' onclick='updFilter(this,0);" + filtRecSet + "' value='fltItem' />Clear Selections</td></tr>"
	filtRec += "<tr><td class='filterl'><input type='radio' class='ab-pointer' onclick='updFilter(this,1);" + filtRecSet + "' value='fltItem' />Select All</td></tr>"
	
	var occ = 0
	while (occ < tt1.length)
	{

		filtRec += "<tr><td class='filterl'>&nbsp;<input type='checkbox' class='ab-pointer' onclick='" + filtRecSet + "' value='fltItem' name='fltItem' checked='checked' id='" + tt1[occ] +"' />&nbsp;" + unescape(tt1[occ]) + "</td></tr>"

		occ +=1
	}
	
	filtRec += "</table>"
	
	document.getElementsByName("filterItem")[0].innerHTML = filtRec
	
	document.getElementsByName("chkORNUM")[0].checked = false;
	document.getElementsByName("evlORNUM")[0].value = 0
	document.getElementsByName("evlORNUM")[1].value = 999999999

	document.getElementsByName("chkBTCUS")[0].checked = false;
	document.getElementsByName("evlBTCUS")[0].value = unescape(tt0[0])
	document.getElementsByName("evlBTCUS")[1].value = unescape(tt0[tt0.length-1])

	document.getElementsByName("chkITMID")[0].checked = false;
	document.getElementsByName("evlITMID")[0].value = unescape(tt1[0])
	document.getElementsByName("evlITMID")[1].value = unescape(tt1[tt1.length-1])
	
	document.getElementsByName("chkTLDAY")[0].checked = false;
	document.getElementsByName("evlTLDAY")[0].value = 0
	document.getElementsByName("evlTLDAY")[1].value = 9999

	document.getElementsByName("chkTLREC")[0].checked = false;
	document.getElementsByName("evlTLREC")[0].value = 0
	document.getElementsByName("evlTLREC")[1].value = 9999

	document.getElementsByName("chkTREAD")[0].checked = false;
	document.getElementsByName("evlTREAD")[0].value = 0
	document.getElementsByName("evlTREAD")[1].value = 9999

	document.getElementsByName("chkTMAXL")[0].checked = false;
	document.getElementsByName("evlTMAXL")[0].value = 0
	document.getElementsByName("evlTMAXL")[1].value = 9999

	document.getElementsByName("chkUSLNA")[0].checked = false;
	document.getElementsByName("evlUSLNA")[0].value = ""
	document.getElementsByName("evlUSLNA")[1].value = "ZZZZZZ"
	
	recFilters[0] = "|"
	recFilters[1] = "|"
	
	filtersOnPartners = false;
	filtersOnItems = false;
 	filtersOnRanges = false
	setFilterDisplay()
	
}  

function updFilter(obj,flag)
{
	var occ = 1
	while (flag > -1 && occ < document.getElementsByName(obj.value).length)
	{
		document.getElementsByName(obj.value)[occ].checked = flag
		occ += 1
	}
	
	var filterNo = Number(document.getElementsByName(obj.value)[0].id.slice(1))
	var filterChk = document.getElementsByName(obj.value)[0].checked
	filterChk = false;
	
	var lastFilter = recFilters[filterNo]
	recFilters[filterNo] = "|"
	
	var tagOcc = 0
	var selOcc = 0
	
	occ = 1
	while (occ < document.getElementsByName(obj.value).length && filterChk == false)
	{
		if (document.getElementsByName(obj.value)[occ].checked == true)
		{
			recFilters[filterNo] += document.getElementsByName(obj.value)[occ].id + "|"
			selOcc +=1;
		}
		tagOcc += 1;
		occ += 1;
	}
	
	if (tagOcc == selOcc)
	{
		recFilters[filterNo] = ""
	}
		
	if (filterChk == false )
	{
		
		recFilters[filterNo] += "|"
	}

	try
	{
		if (obj.name.indexOf("flt") == 0)
		{
			refreshPage(currSortField)
		}
	}catch(er){}
		
	if (flag > -1)
	{
		obj.checked = false
	} 
	
	$("#debug").val("[" + tagOcc + "]" + selOcc + "(" + filterNo + ")" + recFilters[filterNo])
	
}

function rangeValid(tmpEval,tmpFr,tmpTo,cvalid)
{

	
	try
	{
		tmpEval = tmpEval.toUpperCase()
		tmpFr = tmpFr.toUpperCase()
		tmpTo = tmpTo.toUpperCase()
	}catch(er){}
	
	

	var ret = cvalid
	
	if (!( (tmpEval > tmpFr || tmpEval == tmpFr) && (tmpEval < tmpTo || tmpEval == tmpTo) ))
	{
		ret = false
	}
	
	return (ret)
}

function totalsValid(tot)
{
	
	var ret = true
	var tmpEval
	var tmpFr 
	var tmpTo

//	if ( document.getElementsByName("fltRange")[0].checked == false )
//	{
	
		if (document.getElementsByName("chkTLDAY")[0].checked == true)
		{
			filtersOnRanges = true;
			tmpEval = tot[0]
			tmpFr = Number(document.getElementsByName("evlTLDAY")[0].value)
			tmpTo = Number(document.getElementsByName("evlTLDAY")[1].value)
			ret = rangeValid(tmpEval,tmpFr,tmpTo,ret)

		}	
		if (document.getElementsByName("chkTLREC")[0].checked == true)
		{
			filtersOnRanges = true;
			tmpEval = tot[1]
			tmpFr = Number(document.getElementsByName("evlTLREC")[0].value)
			tmpTo = Number(document.getElementsByName("evlTLREC")[1].value)
			ret = rangeValid(tmpEval,tmpFr,tmpTo,ret)

		}	
		if (document.getElementsByName("chkTREAD")[0].checked == true)
		{
			filtersOnRanges = true;
			tmpEval = tot[2]
			tmpFr = Number(document.getElementsByName("evlTREAD")[0].value)
			tmpTo = Number(document.getElementsByName("evlTREAD")[1].value)
			ret = rangeValid(tmpEval,tmpFr,tmpTo,ret)

		}	
		if (document.getElementsByName("chkTMAXL")[0].checked == true)
		{
			filtersOnRanges = true;
			tmpEval = tot[3]
			tmpFr = Number(document.getElementsByName("evlTMAXL")[0].value)
			tmpTo = Number(document.getElementsByName("evlTMAXL")[1].value)
			ret = rangeValid(tmpEval,tmpFr,tmpTo,ret)

		}	
//	}
	
	setFilterDisplay();
	return (ret)
	
}

function setFilterDisplay()
{
	$("#filtersOn").addClass("hidden");
	$("#filtersOnPartners").addClass("hidden");
	$("#filtersOnItems").addClass("hidden");
	$("#filtersOnRanges").addClass("hidden");
	if (filtersOnPartners == true)
	{
		$("#filtersOn").removeClass("hidden");
		$("#filtersOnPartners").removeClass("hidden");
	};
	if (filtersOnItems == true)
	{
		$("#filtersOn").removeClass("hidden");
		$("#filtersOnItems").removeClass("hidden");
	};
	if (filtersOnRanges == true)
	{
		$("#filtersOn").removeClass("hidden");
		$("#filtersOnRanges").removeClass("hidden");
	};
	
	
}

function recFiltersValid(rec)
{
	var ret = true
	
	filtersOnPartners = false;
	if (recFilters[0].length > 1)
	{
		filtersOnPartners = true;
	}
	
	filtersOnItems = false;
	if (recFilters[1].length > 1)
	{
		filtersOnItems = true;
	}

	filtersOnRanges = false
	if (recFilters[0].length > 1 && recFilters[0].indexOf("|"+fieldVal(rec,"BTCUS",0)+"|") == -1)
	{
		ret = false
	}
	if (recFilters[1].length > 1 && recFilters[1].indexOf("|"+fieldVal(rec,"ITMID",0)+"|") == -1)
	{
		ret = false
	}

	var tmpEval
	var tmpFr 
	var tmpTo
//	if ( document.getElementsByName("fltRange")[0].checked == false )
//	{
		if (document.getElementsByName("chkORNUM")[0].checked == true)
		{
			filtersOnRanges = true;
			tmpEval = Number(unescape(fieldVal(rec,"ORNUM",0)))
			tmpFr = Number(document.getElementsByName("evlORNUM")[0].value)
			tmpTo = Number(document.getElementsByName("evlORNUM")[1].value)
			ret = rangeValid(tmpEval,tmpFr,tmpTo,ret)

		}	
		if (document.getElementsByName("chkBTCUS")[0].checked == true)
		{
			filtersOnRanges = true;
			tmpEval = unescape(fieldVal(rec,"BTCUS",0))
			tmpFr = document.getElementsByName("evlBTCUS")[0].value
			tmpTo = document.getElementsByName("evlBTCUS")[1].value
			ret = rangeValid(tmpEval,tmpFr,tmpTo,ret)

		}	
		if (document.getElementsByName("chkITMID")[0].checked == true)
		{
			filtersOnRanges = true;
			tmpEval = unescape(fieldVal(rec,"ITMID",0))
			tmpFr = document.getElementsByName("evlITMID")[0].value
			tmpTo = document.getElementsByName("evlITMID")[1].value
			ret = rangeValid(tmpEval,tmpFr,tmpTo,ret)

		}	
		if (document.getElementsByName("chkUSLNA")[0].checked == true)
		{
			filtersOnRanges = true;
			tmpEval = unescape(fieldVal(rec,"USLNA",0))
			tmpFr = document.getElementsByName("evlUSLNA")[0].value
			tmpTo = document.getElementsByName("evlUSLNA")[1].value
			ret = rangeValid(tmpEval,tmpFr,tmpTo,ret)

		}	

		
		
//	}
	
	
	setFilterDisplay();

	return(ret)
}	

function setBack(obj)
{


	var foundRef = false
	
	
	var occ = 0
	while ( occ < document.getElementsByTagName("a").length)
	
	{
		if (document.getElementsByTagName("a")[occ].name == "goBack" && obj.name != "goBack")
		{
			document.getElementsByTagName("a")[occ].href = "#" + obj.name
		}
		else
		{
			if (document.getElementsByTagName("a")[occ].name != "goBack" && obj.name == "goBack" && obj.href.indexOf("#" + document.getElementsByTagName("a")[occ].name) > -1)
			{
				foundRef = true
			}
		}

		occ += 1
	}

	if (obj.name == "goBack" && foundRef == false)
	{
		obj.href = "#top" 
	}


}
function placeHeading(pgNum,sfield,flag)
{
	var retVar = ""
	
	if (flag > 0)
	{
		retVar += "</table></div><div class='head ' >"
	}
	else 
	{
		retVar += "<div>"
	}
		
	retVar += "<table  style='width:100%;'  border='1' cellspacing='0' cellpadding='0' >"
	if (flag<2)
	{
		// retVar += "<tr>";
		// retVar += "<td colspan=2><a href='#filt' name='pgn" + String(pgNum) + "' onclick='setBack(this);' >"+flag +"Filters</a></td><td class='titleSmall' colspan=100 >" + document.getElementsByName("title")[0].innerHTML + "</td>";
		// retVar += "</tr>";
	
		retVar += "<tr class='bg-primary' >"
	
		retVar += setTitleCell("Ord","ORNUM",sfield,1,"Order Number")
		retVar += setTitleCell("Partner","BTCUS",sfield,1,"Partner Id.")
		retVar += setTitleCell("Name","BPNAM",sfield,0,"Partner Name")
		retVar += setTitleCell("Item","ITMID",sfield,1,"Item Id.")
		retVar += setTitleCell("Desc.","DESC1",sfield,0,"Item description")
		retVar += setTitleCell("Lead","LEADT",sfield,0,"Lead Time from order date")
		retVar += setTitleCell("%","PERSU",sfield,0,"% not late")
		retVar += setTitleCell("A.Late","TLDAY",sfield,0,"Average late days")
		retVar += setTitleCell("T.Late","TLREC",sfield,0,"Total late deliveries")
		retVar += setTitleCell("T.Del.","TREAD",sfield,0,"Total deliveries")
		retVar += setTitleCell("Latest","TMAXL",sfield,0,"Lastest delivery")
		retVar += setTitleCell("User","USLNA",sfield,1,"Owner user Id")
		retVar += "</tr>"      
	}

	if (flag > 1)
	{
		
		var gTotals = new Array()
		gTotals[0] = Number(document.getElementById("totVal00").value)
		gTotals[1] = Number(document.getElementById("totVal01").value) 
		gTotals[2] = Number(document.getElementById("totVal02").value) 
		gTotals[3] = Number(document.getElementById("totVal03").value) 
		gTotals[4] = Number(document.getElementById("totVal04").value) 
		gTotals[5] = Number(document.getElementById("totVal05").value) 
		
		if (gTotals[2]>0)
		{
			gTotals[1] = gTotals[1]/gTotals[2]
		}
		else
		{
			gTotals[1] = 0
		}
		gTotals[1] = Math.round(gTotals[1])
		if (gTotals[3]>0)
		{
			gTotals[5] = gTotals[5]/gTotals[3]
		}
		gTotals[5] = Math.round(gTotals[5])
		
		try
		{
			gTotals[0] = Math.round((gTotals[3]-gTotals[2])/gTotals[3]*100)
		}catch(er){gTotals[0]=0;}


		
		retVar += "<tr class='ab-border ab-strong' name='gTotalsfoot' name='gTotalsfoot'  >"
		retVar += "<td colspan=4>&nbsp;</td><td class='text-primary' >Totals</td>"
		retVar += "<td><span class='text-primary' >Lead:&nbsp;</span>" + gTotals[5] + "</td>"
		retVar += "<td><span class='text-primary' >%:&nbsp;</span>" + String(gTotals[0]) + "<span style='font-size:xx-small;'>%</span></td>"
		retVar += "<td><span class='text-primary' >A.Late:(Average Late Days)&nbsp;</span>" + gTotals[1] + "</td>"
		retVar += "<td><span class='text-primary' >T.Late:(Total Late Del.)&nbsp;</span>" + gTotals[2] + "</td>"
		retVar += "<td><span class='text-primary' >T.Del:(Total deliveries)&nbsp;</span>" + gTotals[3]+ "</td>"
		retVar += "<td><span class='text-primary' >Latest Del. Days:&nbsp;</span>" + gTotals[4] + "</td>"
		retVar += "<td></td></tr>"


	}

	return(retVar)
	
}


function showProps(obj,objName)
{
	var result = objName + " def:\n";
	try
	{
		for (var i in obj)
		{
			if (obj.hasOwnProperty(i))
			{
				result += objName + "." + i + " = '" + obj[i] + "'\n";
			}
	  	}
	}catch(er){}
	
	return result;

}


function setTotal(seqList,sortfield,keyLast)
{

	
	
	var tmpRec = xmlDoc
	
	var totals = new Array()
	totals[0] = 0
	totals[1] = 0
	totals[2] = 0
	totals[3] = 0
	totals[4] = 0
	totals[5] = 0
	
	var gTotals = new Array()
	gTotals[0] = Number(document.getElementById("totVal00").value)
	gTotals[1] = Number(document.getElementById("totVal01").value) 
	gTotals[2] = Number(document.getElementById("totVal02").value) 
	gTotals[3] = Number(document.getElementById("totVal03").value) 
	gTotals[4] = Number(document.getElementById("totVal04").value) 
	gTotals[5] = Number(document.getElementById("totVal05").value) 
	
	var occ = 0
	while (occ < seqList.length)
	{

		totals[1] += Number(stripLeadSpaces(fieldVal(tmpRec[seqList[occ]],"TLDAY",0)))
		totals[2] += Number(stripLeadSpaces(fieldVal(tmpRec[seqList[occ]],"TLREC",0)))
		totals[3] += Number(stripLeadSpaces(fieldVal(tmpRec[seqList[occ]],"TREAD",0)))
		totals[4] = Math.max(totals[4],Number(stripLeadSpaces(fieldVal(tmpRec[seqList[occ]],"TMAXL",0))))
		totals[5] += Number(stripLeadSpaces(fieldVal(tmpRec[seqList[occ]],"LEADT",0)))
		occ += 1
	}


	gTotals[1] += totals[1]
	gTotals[2] += totals[2]
	gTotals[3] += totals[3]
	gTotals[4] = Math.max(totals[4],gTotals[4])
	gTotals[5] += totals[5]


	if (totals[2]>0)
	{
		totals[1] = totals[1]/totals[2]
		
	}
	else
	{
		totals[1] = 0
	}
	if (totals[3]>0)
	{
		totals[5] = totals[5]/totals[3]
	}
	
	totals[1] = Math.round(totals[1])
	totals[5] = Math.round(totals[5])
	
	try
	{
		totals[0] = Math.round((totals[3]-totals[2])/totals[3]*100)
	}catch(er){totals[0]=0;}

	if (totalsValid(totals) == false)
	{
		return ("")
	}	

// end of totals setup

	
	document.getElementById("totVal00").value =  String(gTotals[0])
	document.getElementById("totVal01").value =  String(gTotals[1])
	document.getElementById("totVal02").value =  String(gTotals[2])
	document.getElementById("totVal03").value =  String(gTotals[3])
	document.getElementById("totVal04").value =  String(gTotals[4])
	document.getElementById("totVal05").value =  String(gTotals[5])


// end of gTotals setup


	keyLast = " onclick='toggleDetail(" + '"' + keyLast + '");' + "' "
	
	var retVar = "<tr class='total' >"
	if (returnEqals("ORNUM",sortfield,"ORNUM") == "")
	{
		retVar += "<td><span class='text-primary ab-pointer' " + keyLast + "><span class='glyphicon glyphicon-list' ></span>&nbsp;</span></td>"
	}
	else
	{
		retVar += "<td><span class='text-primary ab-pointer' " + keyLast + "><span class='glyphicon glyphicon-list' ></span>"+unescape(fieldVal(tmpRec[seqList[0]],"ORNUM",0))+"</span></td>" 
	}	
		

	if (sortfield == "ORNUM" || sortfield == "BTCUS" || sortfield == "BPNAM" )
	{
		retVar += setCell(tmpRec[seqList[0]],"BTCUS",sortfield,1)
		retVar += setCell(tmpRec[seqList[0]],"BPNAM",sortfield,1)
	}
	else
	{
		retVar += setCell(tmpRec[seqList[0]],"BTCUS","",1)
		retVar += setCell(tmpRec[seqList[0]],"BPNAM","",1)
	}
	
	if (sortfield == "ITMID" || sortfield == "DESC1" )
	{
		retVar += setCell(tmpRec[seqList[0]],"ITMID",sortfield,1)
		retVar += setCell(tmpRec[seqList[0]],"DESC1",sortfield,1)
	}
	else
	{
		retVar += setCell(tmpRec[seqList[0]],"ITMID","",1)
		retVar += setCell(tmpRec[seqList[0]],"DESC1","",1)
	}
	
	retVar += "<td>" + String(totals[5]) + "</td>"
	retVar += "<td>" + String(totals[0]) + "<span style='font-size:xx-small;'>%</span></td>"
	retVar += "<td>" + String(totals[1]) + "</td>"
	retVar += "<td>" + String(totals[2]) + "</td>"
	retVar += "<td>" + String(totals[3]) + "</td>"
	retVar += "<td>" + String(totals[4]) + "</td>"
	
	retVar += setCell(tmpRec[seqList[0]],"USLNA",returnEqals("USLNA",sortfield,"USLNA"),1)
	retVar += "</tr>"



	return (retVar)	
}

function returnEqals(txt,txt1,rettxt)
{
	if (txt == txt1)
	{
		return(rettxt)
	}
	else
	{
		return("")
	}	
}
function setCell(obj,nodeName,sortfield,ctype)
{
	var lstyle = ""
	var sortCell = "-BTCUS-ITMID-ORNUM-USLNA"
	var insertText = unescape(fieldVal(obj,nodeName,0))
	
	if (nodeName == sortfield)
	{
		lstyle = " style='color:blue;' "
		if (sortCell.indexOf("-" + nodeName) > -1  && ctype == 0)
		{
			if (nodeName == "USLNA")
			{
				lstyle = " style='color:blue;font-size:x-small;border-width:1px;border-top-style:solid;' "
				insertText = unescape(fieldVal(obj,"PDATE",0)) 
				insertText += "</br>" + unescape(fieldVal(obj,"DDATE",0)) 
			}
			else
			{
				insertText = "Ord: " + unescape(fieldVal(obj,"PDATE",0)) 
			}
		}
	
	}
	else
	{
		if (sortfield == "" )
		{
			insertText = ""
		}	
	}
	
	if (ctype == 0)
	{
		if ( ( nodeName == "BPNAM" && sortfield == "BTCUS" ) || ( nodeName == "BTCUS" && sortfield == "ORNUM" ) )
		{
			insertText = "Del: " + unescape(fieldVal(obj,"DDATE",0)) 
		}
		if (nodeName == "DESC1" && sortfield == "ITMID" )
		{
			insertText = "Del: " + unescape(fieldVal(obj,"DDATE",0)) 
		}
		lstyle += " class='dline' "
	}
	var ret = "<td " + lstyle + " >" + insertText + "</td>"
	
	return (ret)
}

function setTitleCell(obj,nodeName,sortfield,flag,wtitle)
{
	var lstyle = ""
	var inputStr = ""

	if (flag * flag == 1)
	{
		if (nodeName == sortfield)
		{
			obj = "<span class='glyphicon glyphicon-ok' ></span> " + obj;
		}
		else
		{
			obj = "<span class='ab-underline' >" + obj + "</span>";
		}
		
		
		lstyle += " title='Sort by "  + wtitle + "' " 
		inputStr +=	"<span class='ab-pointer ab-strong' onclick='refreshPage(" + '"' + nodeName + '");' + "' >" + obj +"<input class='hidden' type='radio' name='sss'  /></span>"
		obj = "";
	}
	else
	{
		lstyle += " title='" + wtitle + "' "
	}
	
	inputStr += obj 
	
	if (flag < 0)
	{
		var tmp = 'onclick="' + "document.getElementsByName('HEADER')[0].className='headeron';" + '" '
		inputStr +=	"&nbsp;&nbsp;&nbsp;<button class='filter' title='Filter " + obj +"'"+tmp+" >Filter</button>"
	}

	var ret = "<td " + lstyle + " >" + inputStr + "</td>"
	
	return (ret)
}

function stripLeadSpaces(obj)
{
	var ret = obj
	while (ret.indexOf("%20") == 0)
	{
		ret = ret.slice(3)
	} 
	return(ret)
	
}


function toggleDetail(objName)
{

	var occ = 0
	while ( occ < document.getElementsByName(objName).length)
	{
		if (document.getElementsByName(objName)[occ].className == "noshow" )
		{
			document.getElementsByName(objName)[occ].className = "goshow"
		}
		else
		{
			document.getElementsByName(objName)[occ].className = "noshow" 
		}
		
		occ +=1
	}	
}


function evlFormula(obj,fname)
{

	var woper = new Array()
	woper[woper.length] = "^E| ^var == "
	woper[woper.length] = "^G| ^var > "
	woper[woper.length] = "^S| ^var < "
	woper[woper.length] = "^N| ^var != "
	woper[woper.length] = "^A| && "
	woper[woper.length] = "^O| || "

	
	var alphaFl = "|BTCUS|ITMID"
	var alphField = false
	
	if (alphaFl.indexOf("|"+fname+"|")	> -1)
	{
		alphField = true
	}
	


	var sPattern = ""
	var fPattern = ""

	var ePattern = obj.value

	var occ = 0
	while (occ < woper.length)
	{
		sPattern = woper[occ].slice(0,2)
		fPattern = woper[occ].slice(3)
		while ( ePattern.indexOf(sPattern) > -1 )
		{
			ePattern = ePattern.slice(0,ePattern.indexOf(sPattern)) + fPattern + ePattern.slice(ePattern.indexOf(sPattern)+sPattern.length)
		}
		occ += 1
	}	
	
	
	sPattern = "^var"
	fPattern = " 24 "
	if (alphField == true)
	{
		fPattern = " 'ACME' "
	}
	
	while ( ePattern.indexOf(sPattern) > -1 )
	{
		ePattern = ePattern.slice(0,ePattern.indexOf(sPattern)) + fPattern + ePattern.slice(ePattern.indexOf(sPattern)+sPattern.length)
	}

	ePattern = ePattern
	var bcolor = "red"
	try
	{
		var x = eval(ePattern)
		bcolor = "green"
	}
	catch(er){}
	obj.style.borderColor = bcolor
	
}

function dbRecord(ORNUM,ORLIN,BTCUS,BPNAM,ITMID,DESC1,TLDAY,TLREC,TREAD,TMAXL,USLNA,PDATE,DDATE,LEADT)
{
	this.ORNUM = ORNUM
	this.ORLIN = ORLIN
	this.BTCUS = BTCUS
	this.BPNAM = BPNAM
	this.ITMID = ITMID
	this.DESC1 = DESC1
	this.TLDAY = TLDAY
	this.TLREC = TLREC
	this.TREAD = TREAD
	this.TMAXL = TMAXL
	this.USLNA = USLNA
	this.PDATE = PDATE
	this.DDATE = DDATE
	this.LEADT = LEADT

}

function dbHeader(TTEXT,DELFR,DELTO)
{

	this.TTEXT = TTEXT
	this.DELFR = DELFR
	this.DELTO = DELTO

}

function setRptDta()
{	
	// head = new dbHeader("Sales Delivery Evaluation","Jan 01 2016","Dec 31 2016")

// end of data function
}	




function zzEnd(){}

</script>



<div  onload="setRptDta();refreshPage('ORNUM')" >



<div id="HEADER" name="HEADER" class="hea2derMin">

				<table class="posfixed" >
					<tr class='filter hidden ab-underline bg-primary '>
						<td>
							<span class="btn btn-primary btn-mg ab-border" onclick="$('.filter').toggleClass('hidden');" >&nbsp;X&nbsp;</span> 
						</td>	
						<td colspan=3 class=" text-right" >
							<span   >
								<span class="ab-spaceless"  >
								<span class="glyphicon glyphicon-arrow-left"></span>
								&nbsp;&nbsp;Filters&nbsp;&nbsp;
								<span class="glyphicon glyphicon-arrow-right"></span>
								</span>
							</span>
						</td>
						<td class="text-right" >
							<span class="btn btn-primary btn-mg ab-border" onclick="$('.filter').toggleClass('hidden');" >&nbsp;X&nbsp;</span> 
						</td>	
						
					</tr>
					<tr  >
						<td class="filter hidden text-primary ab-strong ab-border" >
							Partners on report.
							<span title="Show all & ignore selections" class="hidden" >
								Show all 
								<input type='checkbox' class='fltCust' name='fltCust' onclick='updFilter(this,-1)' checked='checked' id='A0' value='fltCust'/>
								&nbsp;&nbsp;&nbsp;
							</span>
						</td>
						<td class="filter hidden">&nbsp;</td>

						<td class="filter hidden text-primary ab-strong  ab-border" >
							Items on report.
							<span title="Show all & ignore selections" class="hidden" >
								Show all 
								<input type='checkbox' class='fltItem' name='fltItem' onclick='updFilter(this,-1)' checked='checked' id='A1' value='fltItem' />
								&nbsp;&nbsp;&nbsp;
							</span>
						</td>
						<td class="filter hidden">&nbsp;</td>
						<td class="filter hidden text-primary ab-strong ab-border" >
							Advanced Filtering
							<span title="Show all & ignore selections" class="hidden" >
								Show all
								<input type='checkbox' class='fltRange' name='fltRange' onclick='updFilter(this,-1)' checked='checked' id='A1' value='fltItem' />
								&nbsp;&nbsp;&nbsp;
							</span>
						</td>
						
					</tr>
					<tr>
						<td class="filter hidden  ab-border ab-well" >
							<div class="lister" name="filterCust" id="filterCust" >

							</div>
						</td>
						<td class="filter hidden">&nbsp;</td>
						<td class="filter hidden  ab-border ab-well" >
							<div class="lister" name="filterItem" id="filterItem" >

							</div>
						</td>
						<td class="filter hidden">&nbsp;</td>
						<td class="filter hidden  ab-border ab-well" >
							<div class="lister" name="RangeSet" id="RangeSet" >
								<table style='width:100%;' >
									<tr>
										<td></td>
										<td class="text-center text-primary" >
											From
											&nbsp;&nbsp;&nbsp;
										</td>
										<td class="text-center text-primary" >
											To
											&nbsp;&nbsp;&nbsp;
										</td>
									<tr>
										<td  class="filterl text-primary">
											<input type='checkbox' class="ab-pointer" value='ORNUM' name='chkORNUM'  onclick='$(".fltRange").click();' />Order Number
										</td>
										<td  class="filterl ">
											<input type='text' size='15' value='' id='fr' onchange='$(".fltRange").click();' name='evlORNUM'  />
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='to' onchange='$(".fltRange").click();' name='evlORNUM'  />
										</td>
									</tr>
									<tr>
										<td  class="filterl text-primary">
											<input type='checkbox' class="ab-pointer" value='BTCUS' name='chkBTCUS'  onclick='$(".fltRange").click();' />Partner Id
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='fr' onchange='$(".fltRange").click();' name='evlBTCUS'  />
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='to' onchange='$(".fltRange").click();' name='evlBTCUS'  />
										</td>
									</tr>		
									<tr>
										<td  class="filterl text-primary">
											<input type='checkbox' class="ab-pointer" value='ITMID' name='chkITMID'  onclick='$(".fltRange").click();' />Item Id
	
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='fr' onchange='$(".fltRange").click();' name='evlITMID'  />
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='to' onchange='$(".fltRange").click();' name='evlITMID'  />
										</td>
									</tr>	
									<tr>
										<td  class="filterl text-primary">
											<input type='checkbox' class="ab-pointer" value='PERCA' name='chkPERCA'  onclick='$(".fltRange").click();' />% Success
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='fr' onchange='$(".fltRange").click();' name='evlPERCA'  />
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='to' onchange='$(".fltRange").click();' name='evlPERCA'  />
										</td>
									</tr>	
									<tr>
										<td  class="filterl text-primary">
											<input type='checkbox' class="ab-pointer" value='TLDAY' name='chkTLDAY'  onclick='$(".fltRange").click();' />Avg. Late Days
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='fr' onchange='$(".fltRange").click();' name='evlTLDAY'  />
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='to' onchange='$(".fltRange").click();' name='evlTLDAY'  />
										</td>
									</tr>	
									<tr>
										<td  class="filterl text-primary">
											<input type='checkbox' class="ab-pointer" value='TLREC' name='chkTLREC'  onclick='$(".fltRange").click();' />Total Late Del.
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='fr' onchange='$(".fltRange").click();' name='evlTLREC'  />
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='to' onchange='$(".fltRange").click();' name='evlTLREC'  />
										</td>
									</tr>	
									<tr>
										<td  class="filterl text-primary">
											<input type='checkbox' class="ab-pointer" value='TREAD' name='chkTREAD'  onclick='$(".fltRange").click();' />Total Deliveries	
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='fr' onchange='$(".fltRange").click();' name='evlTREAD'  />
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='to' onchange='$(".fltRange").click();' name='evlTREAD'  />
										</td>
									</tr>
									<tr>
										<td  class="filterl text-primary">
											<input type='checkbox' class="ab-pointer" value='TMAXL' name='chkTMAXL'  onclick='$(".fltRange").click();' />Latest	Delivery
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='fr' onchange='$(".fltRange").click();' name='evlTMAXL'  />										
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='to' onchange='$(".fltRange").click();' name='evlTMAXL'  />										
										</td>
									</tr>
									<tr>
										<td  class="filterl text-primary">
											<input type='checkbox' class="ab-pointer" value='USLNA' name='chkUSLNA'  onclick='$(".fltRange").click();' />User Id
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='fr' onchange='$(".fltRange").click();' name='evlUSLNA'  />
										</td>
										<td  class="filterl">
											<input type='text' size='15' value='' id='to' onchange='$(".fltRange").click();' name='evlUSLNA'  />
										</td>
									</tr>
								</table>
							</div>
						</td>
						
					<tr>
				</table>


	<table style='width:100%;'  >
		<tr>
			<td class="title">
				<table  style='width:100%;' >
					<tr>
						<td style="width:33%;" >
<table>
<tr>
<td class="text-primary ab-strong" >
&nbsp;&nbsp;
<span ab-label="STD_FROM"></span>
<span ab-label="STD_DATE"></span>
&nbsp;&nbsp;
</td>
<td>

<?php
$xtmp = new appForm("delEval");
$hardCode = $xtmp->setDatePick("reportFromDate");
echo  $hardCode;
?>
</td>
<td class="text-primary ab-strong" >
&nbsp;&nbsp;
<span ab-label="STD_TO"></span>
<span ab-label="STD_DATE"></span>
&nbsp;&nbsp;
</td>
<td>

<?php
$hardCode = $xtmp->setDatePick("reportToDate");
echo  $hardCode;
?>
</td>
<td>
&nbsp;&nbsp;
<span class="btn btn-success btn-md ab-spaceless" ng-click="DEL_EVAL();" >Submit</span>

&nbsp;&nbsp;
</td>

</tr>
</table>	
							
						</td>
						<td class="titleSmall" style="width:34%;" >
							<span name="title" id="title" >Abaxys Report</span>
						</td>
						<td style="width:33%;" >
							<table>
							<tr>
							<td rowspan=2>
								<span class="btn btn-success btn-md ab-spaceless" onclick="$('.filter').toggleClass('hidden');" >Filters</span> 
							</td>
							<td>&nbsp;</td>
							<td class="text-primary ab-underline ab-strong small ab-spaceless" >
							&nbsp;
								<span class="hidden" id="filtersOn" >Filters On</span>
							</td>	
							<tr>
							<td></td>
							<td>
							&nbsp;
								<span class="bg-primary hidden" id="filtersOnPartners" >&nbsp;Partners&nbsp;</span>
								<span class="bg-primary hidden" id="filtersOnItems" >&nbsp;Items&nbsp;</span>
								<span class="bg-primary hidden" id="filtersOnRanges" >&nbsp;Ranges&nbsp;</span>
							</td>
							</tr>
							</table>
						</td>
						
					</tr>
				</table>	
			</td>
		</tr>
		
	</table>			
</div>




<div id="REPORT" name="REPORT" class="r22eport ab-wrapper-div" >
</div>


<div><a name="bottom"></a><a name="back"></a></div>
<div id="RECSET" name="RECSET" style="position:relative;visibility:hidden;height:1px;overflow:hidden;" >

</div>
<div>

<Input type="hidden" id="totVal00" value="" />
<Input type="hidden" id="totVal01" value="" />
<Input type="hidden" id="totVal02" value="" />
<Input type="hidden" id="totVal03" value="" />
<Input type="hidden" id="totVal04" value="" />
<Input type="hidden" id="totVal05" value="" />
</div>



</div>

<script type="text/javascript">

	var xmlrec = document.getElementsByName("RECSET")[0].innerHTML
	while(xmlrec.indexOf("></") > -1)
	{
		xmlrec = xmlrec.slice(0,xmlrec.indexOf("></")+1)+"%20" + xmlrec.slice(xmlrec.indexOf("></")+1)
	}
	document.getElementsByName("RECSET")[0].innerHTML = xmlrec

</script>



  







