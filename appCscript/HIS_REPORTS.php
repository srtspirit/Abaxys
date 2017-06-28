<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}
	
A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{
    
	$scope.setPeriod = function(obj,val)
	{
		if (obj == "YEAR")
		{
			$scope.yearSelected = val;
		}
		if (obj == "MONTH")
		{
			$scope.monthSelected = val
		}
	}

	$scope.setPeriodSelection = function()
	{
		var months = "January,February,March,April,May,June,July,August,September,October,November,December".split(",");
		var startYear = ( $scope.yearSelected * 1 ) - 2;
		
		$scope.rptYear = new Array();
		$scope.rptMonth = new Array();

		var occ = 0;
		while (occ < 3)
		{
			$scope.rptYear[occ] = new Object();
			$scope.rptYear[occ]["YEAR"] = startYear + occ;
			occ += 1;
		}
		
		var occ = 0;
		var tm = "";
		while (occ < 12)
		{
			$scope.rptMonth[occ] = new Object();
			tm = (occ+1).toString();
			if (tm.length<2)
			{
				tm = "0" + tm;
			}
			$scope.rptMonth[occ]["MONTH"] = tm;
			$scope.rptMonth[occ]["DESCR"] = months[occ];
			occ += 1;
		}
		
		dDta["months"] = $scope.rptMonth;
		
		
	}
	 
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}	

A_LocalAgularFn.prototype.VSL_DEVAL_RPT = function($scope,$http,$routeParams)
{
	
	
	$scope.DEL_EVAL = function()
	{
		var newObj = new Object();
		newObj.reportFromDate = $scope.reportFromDate;
		newObj.reportToDate = $scope.reportToDate;
		
		
		A_Scope.callBack = "$scope.fillReport();";
		$scope.ABchk(newObj,'vsl_DEL_EVAL'); 
		
		
	}	
	
	$scope.fillReport = function()
	{
		// head = new dbHeader("Sales Delivery Evaluation","Jan 01 2016","Dec 31 2016")
		head = new dbHeader("Sales Delivery Evaluation",$scope.reportFromDate,$scope.reportToDate)
		xmlDoc = $scope.vsl_DEL_EVAL;
		recFilters = new Array();
		refreshPage('ORNUM');
		// resetFilters();
	}
	
	
	$scope.yearFrom = $scope.ABGetDateFn('get-year','');
	$scope.monthFrom = $scope.ABGetDateFn('get-month','');
	
	
	if (($scope.monthFrom*1) + 1 > 12)
	{
		$scope.yearTo = ($scope.yearFrom*1) + 1;
		$scope.monthTo = "01" ;
	}
	else
	{
		$scope.yearTo = $scope.yearFrom;
		if (($scope.monthFrom*1)+1 > 9)
		{
			$scope.monthTo = String(($scope.monthFrom*1)+1);
		}
		else
		{
			$scope.monthTo = "0" + String(($scope.monthFrom*1)+1);
		}
			
	}
	$scope.monthFrom = "01";
	$scope.reportFromDate = $scope.yearFrom + "-" + $scope.monthFrom +  "-01"
	$scope.reportToDate = $scope.yearTo + "-" + $scope.monthTo + "-00"
	
	$scope.DEL_EVAL();	
	// setRptDta();
}


A_LocalAgularFn.prototype.ORHE_HISTORY_POS = function($scope,$http,$routeParams)
{

	$scope.reportSupplierId = 0;
	$scope.currentReport = new Object();
	
	$scope.clearData = function(aName)
	{
		if (
		$scope.currentReport.SupplierId == $scope.reportSupplierId &&
		$scope.currentReport.SupplierCode == $scope.reportSupplierCode &&
		$scope.currentReport.yearSelected == $scope.yearSelected &&
		$scope.currentReport.monthSelected == $scope.monthSelected
		)
		{
			$scope.currentReport.noChange = true;
		}
		else
		{
			$scope.currentReport.noChange = false;
		}
		
	}

	$scope.setReportSupplierId = function(rec)
	{
		$scope.reportSupplierId = rec.idVGB_SUPP;
		$scope.reportSupplierCode = rec.VGB_BPAR_BPART;
		$scope.reportSupplierName = rec.VGB_SUPP_BPNAM;
	}

	$scope.getvsl_POS_RPT = function()
	{
		var newObj = new Object();
		newObj.reportSupplierId = $scope.reportSupplierId;
		newObj.reportFromDate = $scope.yearSelected + "-" + $scope.monthSelected ;
		newObj.reportToDate = $scope.yearSelected + "-" + $scope.monthSelected + "-99"
		A_Scope.callBack = "$scope.initColumnSelect();";
		$scope.ABchk(newObj,'vsl_POS_RPT'); 
	}
	
	$scope.initColumnSelect = function()
	{
	
		$scope.currentReport = new Object();
		$scope.currentReport.noChange = true;
		$scope.currentReport.SupplierId = $scope.reportSupplierId;
		$scope.currentReport.SupplierCode = $scope.reportSupplierCode;
		$scope.currentReport.SupplierName = $scope.reportSupplierName;
		$scope.currentReport.yearSelected = $scope.yearSelected;
		$scope.currentReport.monthSelected = $scope.monthSelected;
		
		if (!$scope.columnSelect && $scope.vsl_POS_RPT.length > 0 )
		{
			$scope.columnSelect = new Object();
			$scope.columnList = new Array();
			var occ = 0;
			var obj = $scope.vsl_POS_RPT[0];
			for (var i in obj)
			{
				if (obj.hasOwnProperty(i))
				{
					$scope.columnSelect[i]  = 1;
					occ = $scope.columnList.length;
					$scope.columnList[occ] = new Object();
					$scope.columnList[occ].colName = i;
					
				}
		  	}			
		}
	}

	$scope.countColumnSelect = function()
	{
		var ret = "";
		var occ = 0;
		var totOcc = 0;
		var obj = $scope.columnSelect;
		for (var i in obj)
		{
			if (obj.hasOwnProperty(i))
			{
				occ += $scope.columnSelect[i];
				totOcc += 1;
			}
	  	}			
	  	
	  	ret = " (" + occ + " of " + totOcc +")";
	  	return ret;
		
	}
	
	$scope.yearSelected = $scope.ABGetDateFn('get-year','');
	$scope.monthSelected = $scope.ABGetDateFn('get-month','');
	
	if ($scope.monthSelected - 1 < 1)
	{
		$scope.monthSelected = 12;
		$scope.yearSelected = $scope.yearSelected - 1;
	}
	else
	{
		$scope.monthSelected -= 1;
	}
		
	
	$scope.setPeriodSelection();	
}



A_LocalAgularFn.prototype.HIS_MARGRPT = function($scope,$http,$routeParams)
{
	
	
	
	$scope.dateSearch = function()
	
	{
	
		if($scope.VSL_ORHE_CDATE1>$scope.VSL_ORHE_CDATE2)
		{
			alert('From date should not be greater than to date');
		}
		else
		{

			
			var tmpObj = A_Scope.getInputVal();
			
			
			$scope.ABchk(tmpObj,"his_prft_marg");

			

			
		}
		
	}
	
	$scope.SalesDetails = function()
	{
		var nObj = new Object();
		nObj["idVGB_CUST"] = 117;
	
		$scope.ABchk(nObj,"vsl_history");
		
	}
	
	$scope.chkRange = function(fieldName,tblName,tblField)
	{
		
		$scope[tblField] = $scope[fieldName];
		A_Scope.callBack = "$scope.setRange('" + fieldName + "','" + tblName + "','" + tblField + "');";
		
		$scope.ABlstAlias(tblField,tblField,tblName,tblName); 
		
		
	}
	
	$scope.setRange = function(fieldName,tblName,tblField)
	{
		
		if($scope[tblName].length > 0)
		{
			$scope[fieldName] = $scope[tblName][0][tblField];
		}
		//else
		//{
		//	alert("you have past the last record in table");
		//	$("[ng-model='"+fieldName+"']").focus();
		//}
		
	}
	
	
	
	
}
A_LocalAgularFn.prototype.ORHE_HISTORY = function($scope,$http,$routeParams)
{
	$scope.custFilter = new Array();
	$scope.itemFilter = new Array();
	$scope.currentYearSelected = "";
	$scope.currentMonthSelected = "";
	$scope.currentCustFilter = new Array();
	$scope.currentItemFilter = new Array();
	
	
	
	$scope.selectRec = function(wrecId,objName)
	{
		if (!$scope[objName + "Recs" ])
		{
			$scope[objName + "Recs" ] = new Object();
		}
		
		if (wrecId == 0)
		{
			$scope[objName] = new Array();
			return;
		}
		
		var recId = 0;
		if (objName=="custFilter")
		{
			recId = wrecId.idVGB_CUST;
			recDescr = wrecId.VGB_BPAR_BPART + " - " + wrecId.VGB_CUST_BPNAM;
		}
		else
		{
			recId = wrecId.idVIN_ITEM;
			recDescr =  wrecId.VIN_ITEM_ITMID + " - " + wrecId.VIN_ITEM_DESC1;
		}
		
		$scope[objName + "Recs" ][recId] = recDescr;
		$scope[objName + "List" ] = new Array();
		
		var occ = 0;
		var obj = $scope[objName + "Recs" ]
		
		for (var i in obj)
		{
			if (obj.hasOwnProperty(i))
			{
				$scope[objName + "List" ][occ] = new Object();
				$scope[objName + "List" ][occ]["recId"] = i;
				$scope[objName + "List" ][occ]["recDescr"] = obj[i];
				occ+= 1
			}
			
	  	}		
		
		
		var recList = "," + $scope[objName].join(",") + ",";
		if (recList.indexOf("," + recId + ",") > -1)
		{
			recList = recList.replace("," + recId + "," , ",");
		}
		else
		{
			recList += recId + ","
		}
		
		recList = recList.replace(",," ,",")
		
		if (recList.indexOf(",") == 0)
		{
			recList = recList.slice(1);
		}
		if (recList.lastIndexOf(",") == recList.length-1)
		{
			recList = recList.slice(0,recList.length-1);
		}
		
		if (recList.length == 0)
		{
			$scope[objName] = new Array();
		}
		else
		{
			$scope[objName] = recList.split(",");
		}
		
	}
	$scope.selectRecAll = function(objName,resultName,fieldName)
	{
		if (!$scope[resultName])
		{
			return;
		}
		var wrec = $scope[resultName];
		var occ = 0;
		while (occ < wrec.length)
		{
			var recList = "," + $scope[objName].join(",") + ",";
			if (recList.indexOf("," + wrec[occ][fieldName] + ",") == -1)
			{
				$scope.selectRec(wrec[occ][fieldName],objName);
			}		
			
			occ += 1;
		}
		
	}
	

	
	$scope.isRecSelected  = function(recId,objName)
	{
		
		var ret = false;
		
		var recList = "," + $scope[objName].join(",") + ",";
		if (recList.indexOf("," + recId + ",") > -1)
		{
			ret = true;
		}		
		
		return ret;		
	}
	
	
	$scope.yearSelected = $scope.ABGetDateFn('get-year','');
	$scope.monthSelected = $scope.ABGetDateFn('get-month','');
	$scope.setPeriodSelection();

	
	$scope.salesMTD_YTD = function()
	{
		var nObj = new Object();
		
		nObj["yearSelected"] = $scope.yearSelected;
		nObj["monthSelected"] = $scope.monthSelected;
		nObj["custFilter"] = $scope.custFilter;
		nObj["itemFilter"] = $scope.itemFilter;

		$scope.currentYearSelected = $scope.yearSelected;
		$scope.currentMonthSelected = $scope.monthSelected;
		$scope.currentCustFilter = $scope.custFilter;
		$scope.currentItemFilter = $scope.itemFilter

		
		$scope.ABchk(nObj,"vsl_MTD_YTD");
	}
	
	
	
	
	$scope["ORHE_HISTORY_CUST"] = "";
	$scope["ORHE_HISTORY_SUPP"] = "";
	$scope["ORHE_HISTORY_ITEMID"] = "";
	$scope["ORHE_HISTORY_ORDNUM"] = "";
	$scope["ORHE_HISTORY_ORDNO"] = "";
	$scope["idVGB_CUST"] = "";
	$scope["idVGB_SUPP"] = "";
	$scope["idVIN_ITEM"] = "";
	$scope["idVSL_ORHE"] = "";
	$scope["idVPU_ORHE"] = "";
	
	$scope.execVSLQuery = function()
	{
		
		var query = $("#queryVSL").val()
		var cond = new Array();
		var condList = ""
		var occ = 0;
		var recSet = $scope.vsl_history;
		
		while (occ < recSet.length)
		{
			if (recSet[occ]["VIN_ITEM_ITMID"] != null && condList.indexOf("[=]" + recSet[occ]["VIN_ITEM_ITMID"]  + "[=]") == -1)
			{
				condList += "[=]" + recSet[occ]["VIN_ITEM_ITMID"] + "[=]";
				cond[cond.length] = " ( VIN_ITEM_ITMID = '" + recSet[occ]["VIN_ITEM_ITMID"] + "' ) ";
			}

			if (recSet[occ]["VSL_ORST_STEPS"] > "JJ_INVO")
			{
				
				recSet[occ]["VSL_ORST_PDATE"] = recSet[occ]["VSL_ORST_DDATE"];
			}
								
			occ += 1;	
		}
		
		$scope.vsl_history = recSet;

		if (cond.length > 0)
		{
			$scope.spatVSL = "[=SPE=]" + cond.join("OR");
			
			$scope.ABsearchAlias('vin_item',query,$scope.spatVSL,'VSL_DETAIL','','$scope.execVSLQuery2();') 			
		}
		
	
	}

	$scope.localSetSortby = function(sName,sVal)
	{
		
		if ($scope[sName]!=sVal)
		{
			$scope[sName]=sVal;
		}
		else
		{
			$scope[sName]="";
		}
		
	}

	$scope.execVSLQuery2 = function()
	{
	


		var detail = $scope.vsl_history;
	
		var cLen = 0
		var occ = 0
		var cond = new Array();
		
		var condList = ""
		var condCust = ""
		
		while (occ < detail.length)
		{
			if (detail[occ]["idVGB_CUST"] != null && condList.indexOf("[=]" + detail[occ].idVGB_CUST + "[=]") == -1)
			{
				condList += "[=]" +  detail[occ].idVGB_CUST + "[=]";
				cond[cond.length] = " ( VIN_CUST_BPART = '" +  detail[occ].idVGB_CUST + "' ) ";
			}
			if (cond.length > 0)
			{
				condCust = " AND ( " + cond.join("OR") + ") ";
			}
			occ += 1;
			
		}
		
		var locParm = "";
		locParm += "vin_supp:VIN_SUPP_ITMID = idVIN_ITEM";
		locParm += ",vgb_supp:VIN_SUPP_BPART = idVGB_SUPP";
		locParm += ",vin_cust:VIN_CUST_ITMID = idVIN_ITEM" + condCust;
		locParm += ",vgb_cust:VIN_CUST_BPART = idVGB_CUST";
		locParm += ",vgb_bpar:VGB_SUPP_BPART = idVGB_BPAR";
		locParm += ",vin_inve:VIN_INVE_ITMID = idVIN_ITEM";
		locParm += ",vin_lslq:VIN_LSLQ_ITMID = idVIN_ITEM";
		$scope.ABsearchAlias('vin_item',locParm,$scope.spatVSL,'VSL_DETAIL_INV','') 
		
	}

	$scope.execVPUQuery = function()
	{
		
		var query = $("#queryVPU").val()
		var cond = new Array();
		var condList = ""
		var occ = 0;
		var recSet = $scope.vpu_history;
		
		while (occ < recSet.length)
		{
			if (recSet[occ]["VIN_ITEM_ITMID"] != null && condList.indexOf("[=]" + recSet[occ]["VIN_ITEM_ITMID"]  + "[=]") == -1)
			{
				condList += "[=]" + recSet[occ]["VIN_ITEM_ITMID"] + "[=]";
				cond[cond.length] = " ( VIN_ITEM_ITMID = '" + recSet[occ]["VIN_ITEM_ITMID"] + "' ) ";
			}

			
			occ += 1;	
		}

		if (cond.length > 0)
		{
			$scope.spatVPU = "[=SPE=]" + cond.join("OR");
			
			$scope.ABsearchAlias('vin_item',query,$scope.spatVPU,'VPU_DETAIL','','$scope.execVPUQuery2();') 			
		}
	
	}

	$scope.execVPUQuery2 = function()
	{
	
		var detail = $scope.vpu_history;
		
		var locParm = "";
		locParm += "vin_supp:VIN_SUPP_ITMID = idVIN_ITEM";
		locParm += ",vgb_supp:VIN_SUPP_BPART = idVGB_SUPP";
		locParm += ",vgb_bpar:VGB_SUPP_BPART = idVGB_BPAR";
		locParm += ",vin_inve:VIN_INVE_ITMID = idVIN_ITEM";
		locParm += ",vin_lslq:VIN_LSLQ_ITMID = idVIN_ITEM";
		$scope.ABsearchAlias('vin_item',locParm,$scope.spatVPU,'VPU_DETAIL_INV','') 
		
	}	

	$scope.initNewCustomer = function()
	{
			$scope.idVGB_CUST = $scope.abSessionResponse.idVGB_CUST;			
			$scope.VGB_BPAR_BPART = $scope.abSessionResponse.VGB_BPAR_BPART;
		  $scope.ORHE_HISTORY_CUST = $scope.VGB_BPAR_BPART; 
		  $scope.chkRangePartner('ORHE_HISTORY_CUST','vgb_bpar','VGB_BPAR_BPART')
	}
	$scope.initNewOrder = function()
	{
			$scope.idVSL_ORHE = $scope.abSessionResponse.idVSL_ORHE;			
			$scope.VSL_ORHE_ORNUM = $scope.abSessionResponse.VSL_ORHE_ORNUM;
		  $scope.ORHE_HISTORY_ORDNUM = $scope.VSL_ORHE_ORNUM; 
		  $scope.chkRangeOrd('ORHE_HISTORY_ORDNUM','vsl_orhe','VSL_ORHE_ORNUM')
	}
		$scope.initNewOrders = function()
	{
			$scope.idVPU_ORHE = $scope.abSessionResponse.idVPU_ORHE;			
			$scope.VPU_ORHE_ORNUM = $scope.abSessionResponse.VPU_ORHE_ORNUM;
		  $scope.ORHE_HISTORY_ORDNO = $scope.VPU_ORHE_ORNUM; 
		  $scope.chkRangeOrn('ORHE_HISTORY_ORDNO','vpu_orhe','VPU_ORHE_ORNUM')
	}
	$scope.initNewItem = function()
	{
			$scope.idVIN_ITEM = $scope.abSessionResponse.idVIN_ITEM;			
			$scope.VIN_ITEM_ITMID = $scope.abSessionResponse.VIN_ITEM_ITMID;
		  $scope.ORHE_HISTORY_ITEMID = $scope.VIN_ITEM_ITMID; 
		  $scope.chkRangeItm('ORHE_HISTORY_ITEMID','vin_item','VIN_ITEM_ITMID')
	}
	
		$scope.initNewItems = function()
	{
			 
			$scope.idVIN_ITEM = $scope.abSessionResponse.idVIN_ITEM;			
			$scope.VIN_ITEM_ITMID = $scope.abSessionResponse.VIN_ITEM_ITMID;
		  $scope.ORHE_HISTORY_ITEMIDS = $scope.VIN_ITEM_ITMID; 
		  
			$scope.chkRangeItms('ORHE_HISTORY_ITEMIDS','vin_item','VIN_ITEM_ITMID');
	}

	$scope.initNewSupp = function()
	{
			$scope.idVGB_SUPP = $scope.abSessionResponse.idVGB_SUPP;			
			$scope.VGB_BPAR_BPART = $scope.abSessionResponse.VGB_BPAR_BPART;
		  $scope.ORHE_HISTORY_SUPP = $scope.VGB_BPAR_BPART; 
		  $scope.chkRangePartner('ORHE_HISTORY_SUPP','vgb_bpar','VGB_BPAR_BPART')
	}	

	
	$scope.SalesDetails = function()
	{
		var nObj = new Object();
		//alert($scope.idVGB_CUST+"-"+ $scope.idVIN_ITEM+"-"+$scope.idVSL_ORHE);
		nObj["idVGB_CUST"] = $scope.idVGB_CUST;
		nObj["idVIN_ITEM"] = $scope.idVIN_ITEM;
		nObj["idVSL_ORHE"] = $scope.idVSL_ORHE;
		
		$scope.ABchk(nObj,"vsl_history");
		
	}
	
		$scope.purchaseDetails = function()
	{
		var nObj = new Object();
		//alert($scope.idVGB_SUPP+"-"+ $scope.idVIN_ITEM+"-"+$scope.idVPU_ORHE);
		nObj["idVGB_SUPP"] = $scope.idVGB_SUPP;
		nObj["idVIN_ITEM"] = $scope.idVIN_ITEM;
		nObj["idVPU_ORHE"] = $scope.idVPU_ORHE;
		
		$scope.ABchk(nObj,"vpu_history");
		
	}
	
	$scope.chkRangeOrd = function(fieldName,tblName,tblField)
	{
		$scope["idVIN_ITEM"] = 0;
		$scope["idVGB_CUST"] = 0;
		
		
		if($scope[fieldName].trim()!="")
		{
			$scope[tblField] = $scope[fieldName];
			A_Scope.callBack = "$scope.setRangeOrd('" + fieldName + "','" + tblName + "','" + tblField + "');";
		
			$scope.ABlstAlias(tblField,tblField,tblName,tblName); 
		}
		
	}
	
		$scope.chkRangeOrn = function(fieldName,tblName,tblField)
	{
		$scope["idVIN_ITEM"] = 0;
		$scope["idVGB_SUPP"] = 0;
		
		
		if($scope[fieldName].trim()!="")
		{
			$scope[tblField] = $scope[fieldName];
			A_Scope.callBack = "$scope.setRangeOrn('" + fieldName + "','" + tblName + "','" + tblField + "');";
		
			$scope.ABlstAlias(tblField,tblField,tblName,tblName); 
		}
		
	}
	
	$scope.chkRangeItm= function(fieldName,tblName,tblField)
	{
		$scope["idVSL_ORHE"] = 0;		
		$scope["idVGB_CUST"] = 0;
		
		if($scope[fieldName].trim()!="")
		{
			$scope[tblField] = $scope[fieldName];
			A_Scope.callBack = "$scope.setRangeItm('" + fieldName + "','" + tblName + "','" + tblField + "');";
		
			$scope.ABlstAlias(tblField,tblField,tblName,tblName); 
		}
		
	}
	
	$scope.chkRangeItms= function(fieldName,tblName,tblField)
	{
		$scope["idVPU_ORHE"] = 0;		
		$scope["idVGB_SUPP"] = 0;
		
		if($scope[fieldName].trim()!="")
		{
			$scope[tblField] = $scope[fieldName];
			A_Scope.callBack = "$scope.setRangeItms('" + fieldName + "','" + tblName + "','" + tblField + "');";
		
			$scope.ABlstAlias(tblField,tblField,tblName,tblName); 
		}
		
	}
	
	
	$scope.chkRangePartner = function(fieldName,tblName,tblField)
	{
		$scope["idVSL_ORHE"] = 0;
		$scope["idVPU_ORHE"] = 0;
		$scope["idVIN_ITEM"] = 0;
		
		if($scope[fieldName].trim()!="")
		{
			$scope[tblField] = $scope[fieldName];
			A_Scope.callBack = "$scope.validateBpart('" + fieldName + "','" + tblName + "','" + tblField + "');";
		
			$scope.ABlstAlias(tblField,tblField,tblName,tblName);
				
		}
		
   			
	}
	
	$scope.validateBpart = function(fieldName,tblName,tblField)
	{
	
		$scope[fieldName] = "";
		if($scope[tblName].length > 0)
		{
			var occ = 0;
			while (occ < $scope["rawResult"]["vgb_bpar"].length && $scope[fieldName] == "")
			{
				if (fieldName.indexOf("_CUST") >-1  && $scope["rawResult"]["vgb_bpar"][occ]["idVGB_CUST"] > 0)
				{
					$scope[fieldName] = $scope["rawResult"]["vgb_bpar"][occ][tblField];
				  	$scope["idVGB_CUST"] = $scope["rawResult"]["vgb_bpar"][occ]["idVGB_CUST"];
				  	$scope.SalesDetails();
				}
				
				if (fieldName.indexOf("_SUPP") >-1  && $scope["rawResult"]["vgb_bpar"][occ]["idVGB_SUPP"] > 0)
				{
					$scope[fieldName] = $scope["rawResult"]["vgb_bpar"][occ][tblField];
				  	$scope["idVGB_SUPP"] = $scope["rawResult"]["vgb_bpar"][occ]["idVGB_SUPP"];
				  	$scope.purchaseDetails();
				}
				
				occ += 1;
			}

		}		
	}
		
	$scope.setRangeOrd = function(fieldName,tblName,tblField)
	{
		$scope[fieldName] = "";
		if($scope[tblName].length > 0)
		{
			$scope[fieldName] = $scope[tblName][0][tblField];
			$scope["idVSL_ORHE"] =$scope[tblName][0]["idVSL_ORHE"];
			$scope.SalesDetails();
			//$scope["idVIN_ITEM"] =$scope[tblName][0]["idVIN_ITEM"];
		}
	}	
	
		$scope.setRangeOrn = function(fieldName,tblName,tblField)
	{
		$scope[fieldName] = "";
		if($scope[tblName].length > 0)
		{
			$scope[fieldName] = $scope[tblName][0][tblField];
			$scope["idVPU_ORHE"] =$scope[tblName][0]["idVPU_ORHE"];
			$scope.purchaseDetails();
			//$scope["idVIN_ITEM"] =$scope[tblName][0]["idVIN_ITEM"];
		}
	}	
$scope.setRangeItm = function(fieldName,tblName,tblField)
	{
		$scope[fieldName] = "";
		if($scope[tblName].length > 0)
		{
			$scope[fieldName] = $scope[tblName][0][tblField];
			//$scope["idVSL_ORHE"] =$scope[tblName][0]["idVSL_ORHE"];
			$scope["idVIN_ITEM"] =$scope[tblName][0]["idVIN_ITEM"];
			$scope.SalesDetails();
			
		}

		
	}
	
$scope.setRangeItms = function(fieldName,tblName,tblField)
	{
		$scope[fieldName] = "";
		if($scope[tblName].length > 0)
		{
			$scope[fieldName] = $scope[tblName][0][tblField];
			//$scope["idVSL_ORHE"] =$scope[tblName][0]["idVSL_ORHE"];
			$scope["idVIN_ITEM"] =$scope[tblName][0]["idVIN_ITEM"];
			$scope.purchaseDetails();
		}

		
	}

	$scope.getUnitDescr = function(unitId)
	{
		var ret = "";
		var recSet = $scope.rawResult.vin_units;
		var occ = 0
		while (occ < recSet.length && ret== "")
		{
			if (recSet[occ].idVIN_UNIT == unitId)
			{
				ret = recSet[occ].VIN_UNIT_UNITM;
			}
			occ += 1;
		}
		
		return ret;
	}

	$scope.initSupport = function()
	{
		
		A_Scope.callBack = "$scope.initSupport1();";
		$scope.idVIN_UNIT = "0";
		$scope.ABlstAlias('idVIN_UNIT','idVIN_UNIT',"vin_unit","vin_units");
	}
	$scope.initSupport1 = function()
	{
		A_Scope.callBack = "$scope.initSupport2();";
		$scope.idVIN_WARS = "0";
		$scope.ABlstAlias('idVIN_WARS','idVIN_WARS',"vin_wars","vin_warss");
	}

    $scope.initSupport2 = function()
	{
		//A_Scope.callBack = "$scope.initSupport2();";
		$scope.idVIN_LOCS = "0";
		$scope.ABlstAlias('idVIN_LOCS','idVIN_LOCS',"vin_locs","vin_locss");
	}
	
	$scope.initSupport();
	$scope.VSLextraSort = ""
	$scope.VPUextraSort = ""
	
}

</script>



