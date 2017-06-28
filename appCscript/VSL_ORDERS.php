<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	A_Scope.setProcess($scope);
	$scope.ABunloadExe["vsl_orhe"] = "dbMain";

	$scope.initStepList = function()
	{

		$scope["VSL_STEP_LIST"] = new Array();
	
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();						                                             
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "DD_ACKN";                                             
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";                                             
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_ACKID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_DD_ACKN";                         
	 	$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Quote"; 
	        
	                                                   
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();                                           
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "DE_AOKN";                                   
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "example_ACKN.php";                                   
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_AOKID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_DE_AOKN";                         
	        $scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Acknowledge"; 
	                                                                                                                                
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();                                           
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "EE_SCED";                                   
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";                                   
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_SCEID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_EE_SCED";  
	        $scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Reserve";  	                                           
	                                                                   
	                                                                                                                                                                     
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "FF_PICK";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "example_PICK.php";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_PICID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_FF_PICK";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Picking";  
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "GG_RELE";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_RELID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_GG_RELE";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Release";     
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "HH_PACK";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "example_PACK.php";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_PAKID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_HH_PACK";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Pack";           
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "II_DELI";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["field"] = "VSL_ORST_DELID";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_II_DELI";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Deliver";        
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "JJ_INVO";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_JJ_INVO";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Confirm Del.";     
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "KK_PURG";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_KK_PURG";
	        $scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Invoicing";            
	
	
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length]=new Object();
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["name"]= "QQ_PURG";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["form"] = "";
		$scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["label"]= "LF_STEPS_QQ_PURG";
	        $scope["VSL_STEP_LIST"][$scope["VSL_STEP_LIST"].length-1]["labeltext"]= "Completed";     
	        
	        
	        dDta["VSL_STEP_LIST"] =   $scope["VSL_STEP_LIST"];

	}
	
	$scope.initStepList();
	




	$scope.ACVarFilterHide = function()
	{
	
		$("[id^='flt']").addClass("ACdropdown");
	}
	

	$scope.ACVarFilterToggle = function(colName)
	{
		
		
		if ( !$scope["Orglist"+colName] || $scope["Orglist"+colName]== "")
		{
			 $scope["Orglist"+colName] =  $scope["list"+colName];
		}
			
		$("[id^='flt']").each(function()
		{
			if ($(this).attr("id") != "flt"+colName)
			{
				$(this).addClass("ACdropdown")
			}
		});
		
		$("#flt"+colName).toggleClass("ACdropdown");
	}	
	
	$scope.ACVarColSelToggle = function(colName,colVal)
	{

		var xSearch = $scope["list"+colName];
		var chkVal = encodeURI(colVal)
	
		// alert(colName +"="+colVal+"="+chkVal+"=="+xSearch.indexOf("'" + chkVal + "'"))

		if (xSearch.indexOf("'" + chkVal + "'") > -1)
		{
			// Remove
			xSearch = xSearch.slice(0,xSearch.indexOf("'" + chkVal + "'")) + xSearch.slice(xSearch.indexOf("'" + chkVal + "'")+chkVal.length+2)
		}
		else
		{
			//Add
			xSearch += "'" + chkVal + "'"
		}

		$scope["list"+colName] = xSearch;

		$scope.ACVarFilterInit(colName,xSearch);

		
	}
	
	$scope.ACVarColSetIsOn = function(colName,colVal)
	{
		var xSearch = $scope["list"+colName];
		var chkVal = encodeURI(colVal)
	
		if (xSearch.indexOf("'" + chkVal + "'") > -1)
		{
			return true;
		}	
		else
		{
			return false;
		}
	}
	
	
	A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}

A_LocalAgularFn.prototype.VSL_VARIANCES = function($scope,$http,$routeParams) 
{

	$scope.ACVarFilterInit = function(colName,colVal)
	{
		// colVal = $scope["list"+colName];
		
		var occ = 0;
		while (occ < $scope["rawResult"]["vsl_varie"].length)
		{	
			if ( !$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["hidden"] = "  ";
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
			}
			
			$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vsl_varie"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vsl_varie"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vsl_varie"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
	
}	

A_LocalAgularFn.prototype.VSL_INVOCT = function($scope,$http,$routeParams) 
{
	$scope.processVSL_PROFORMA = function(ornum,delId)
	{
		try
		{
			wDoc.close();
		}
		catch(er){}
		
		var selPicks = delId
		
		var wDoc = window.open('oneMomentPlease.php?title=Sales Invoices' + "&process= Proforma" ,'ABviewForm');
		
		
		var tmpObj = new Object();
		tmpObj["idVSL_ORHE"] = ornum;
		A_Scope.callBack = "$scope.printExec(" + delId + ");";
		$scope.ABchk(tmpObj,"vsl_orheXXX");
	}

	$scope.docStepValid = function(rSet)
	{
		
		var ret = false;
		
		// New version
		if($scope.formSelName && $scope.formSelName !="")
		{ 
			var occ = 0;
			var recSet = $scope["rawResult"]["vsl_orhe"];
			while (occ < recSet.length && ret == false)
			{
				if (rSet["idVSL_ORDE"] == recSet[occ]["idVSL_ORDE"])
				{
					if ( $scope.formSelDocId == recSet[occ][$scope.formSelField])
					{
						ret = true;
					}
				}
				occ += 1;
			}
		}
		
		return ret;
		
		

	}
			
	$scope.printExec = function(delId)
	{
		dDta["printExecCt"] = dDta.dbChk.vsl_delivered;
		$scope.formSel = " #-111" ;
		$scope.formSelName = "JJ_INVO";
		$scope.formSelField = "VSL_ORST_DELID";
		$scope.tmpexe = $scope["AB_CPARM"]["VSL_STEPS"][$scope.formSelName] + ".php";
		$scope.selexe= $scope.tmpexe
		var selPicks = delId;
		$scope.formSelDocId = selPicks;
		$scope.formSelGrpId = selPicks;
		$scope.formSelForma = "ON";
		$("#doccset").click();
		
	}

	$scope.insertEle = function(from,to,ornum)
	{

		var occ = 0;
		while (occ < $scope[from].length)
		{
			$scope[from][occ]["idVSL_ORHE"] = ornum;
			$scope[from][occ]["VSL_ORDE_ORNUM"] = ornum;
			$scope[from][occ]["VSL_LSTR_ORNUM"] = ornum;
			$scope[from][occ]["VPU_ORST_ORNUM"] = ornum;
			$scope[from][occ]["VPU_ORSI_ORNUM"] = ornum;
			$scope[from][occ]["VSL_ORDE_CFCAT"] = "0";
			$scope[from][occ]["VSL_ORST_WINVO"] = $scope.formSelDocId;
			
			$scope["rawResult"][to][$scope["rawResult"][to].length] = $scope[from][occ];
			$scope[to][$scope[to].length] = $scope[from][occ];
			occ += 1;
		}
		if (!dDta['fr'])
		{
			dDta['fr'] = new Object;
		}
		dDta['fr'][from] = $scope[from]
	}

	
	$scope.getVSL_DELIVERY = function()
	{
		var tmpObj = new Object();
		tmpObj["idVSL_ORHE"] = 0;
		$scope.ABchk(tmpObj,"vsl_invoice");
	}

	$scope.isSelected = function(delID)
	{
		var ret = 0;
		var testVar = "," + $scope.deliveryID + ","
		if (testVar.indexOf("," + delID + ",") >-1)
		{
			ret = 1;
		}
		return ret;
	}

	$scope.setSelected = function(delID,updCount)
	{
		var ret = 0;
		var testVar = $scope["deliveryID"].split(",")
		var newVar = "";
		var comma = "";
		var occ = 0
		while (occ < testVar.length && $scope["deliveryID"].trim() != "")
		{
			if (testVar[occ] == delID)
			{
				ret = 1;
			}
			else
			{
				newVar += comma + testVar[occ]
				comma = ","
			}
			occ += 1
		}
		if (ret == 0)
		{
			newVar += comma + delID
		}
		
		$scope["deliveryID"] = newVar;

	}

	
}

A_LocalAgularFn.prototype.VSL_INVOPR = function($scope,$http,$routeParams) 
{
	
	$scope.doc_date_to = $scope.ABGetDateFn('get-year','')+$scope.ABGetDateFn('get-month','') + $scope.ABGetDateFn('get-day','')
	$scope.doc_date_from = $scope.ABGetDateFn('add-days',$scope.doc_date_to + ",-30");

	$scope.doc_printed = 0;

	$scope.formMessValid = function(msg)
	{
		var ret = true;
		
		if (msg["VGB_AMHE_SOURC"] != "SALES")
		{
			ret = false;
		}
		
		var td = $scope.ABGetDateFn('get-year','')+'-'+$scope.ABGetDateFn('get-month','')+'-'+$scope.ABGetDateFn('get-day','');
		if ( msg["VGB_AMHE_ALWAY"] == 0 && ( td < msg["VGB_AMHE_DATFR"] || td > msg["VGB_AMHE_DATTO"] ) )
		{
			ret = false;
		}
		
		if (msg["VGB_AMHE_STEPLIST"].indexOf($scope.formSelName) == -1)
		{
			ret = false;
		}
		
		
		
		return ret;
	}
	
	$scope.docStepValid = function(rSet)
	{
		
		var ret = true;
		
		// New version
		if($scope.formSelName && $scope.formSelName !="")
		{ 
			var occ = 0;
			var recSet = $scope["rawResult"]["vsl_orhe"];
			while (occ < recSet.length && ret == false)
			{
				if (rSet["idVSL_ORDE"] == recSet[occ]["idVSL_ORDE"])
				{
					if ( $scope.formSelDocId == recSet[occ][$scope.formSelField])
					{
						ret = true;
					}
				}
				occ += 1;
			}
		}
		
		return ret;
	}

	$scope.printExec = function()
	{
		dDta["printExecPr"] = dDta.dbChk.vsl_delivered;
		$scope.formSel = " #-111" ;
		$scope.formSelName = "JJ_INVO";
		$scope.formSelField = "VSL_ORST_WINVO";
		$scope.formSelDocId = 620;
		$scope.formSelGrpId = 620;
			// $scope.tmpexe = "example_" + $scope.formSelName.slice($scope.formSelName.indexOf("_") + 1) + ".php" ;
		$scope.tmpexe = $scope["AB_CPARM"]["VSL_STEPS"][$scope.formSelName] + ".php";
		$scope.selexe= $scope.tmpexe
		dDta["tcpdform"] = new Array();
		var occ = 0;
		var selPicks = $scope.deliveryID.split(",")
		
		$scope["rawResult"]["vsl_orhe"] = new Array();
		$scope["vsl_orhe"] = new Array();
		
		$scope["rawResult"]["vsl_orheTax"] = new Array();
		$scope["vsl_orheTax"] = new Array();

		$scope["rawResult"]["vgb_addr"] = new Array();
		$scope["vgb_addr"] = new Array();

		$scope["rawResult"]["vin_cust"] = new Array();
		$scope["vin_cust"] = new Array();

		
		dDta.units = $scope["vin_unit"];
		
		while (occ < selPicks.length)
		{
		
			if (occ == 0)
			{	
				$scope.formSelDocId = selPicks[occ];
				$scope.formSelGrpId = selPicks[occ];
			}
	
			$scope.insertEle("vsl_orhe" + occ + "main","vsl_orhe",occ+1)
			$scope.insertEle("vsl_orhe" + occ + "vsl_orheTax","vsl_orheTax",occ+1)
			$scope.insertEle("vsl_orhe" + occ + "vgb_addr","vgb_addr",occ+1)
			$scope.insertEle("vsl_orhe" + occ + "vin_cust","vin_cust",occ+1)
			
			occ +=1
		}

		dDta["tcpdform"] = "Nothing";
		
		setTimeout(function()
		{
			
			$("#doccset").click();
			$scope.getVSL_DELIVERED();
			
		},100);
				

		
	}
	
	$scope.insertEle = function(from,to,ornum)
	{

		var occ = 0;
		while (occ < $scope[from].length)
		{
			$scope[from][occ]["idVSL_ORHE"] = ornum;
			$scope[from][occ]["VSL_ORDE_ORNUM"] = ornum;
			$scope[from][occ]["VSL_LSTR_ORNUM"] = ornum;
			$scope[from][occ]["VPU_ORST_ORNUM"] = ornum;
			$scope[from][occ]["VPU_ORSI_ORNUM"] = ornum;
			$scope[from][occ]["VSL_ORDE_CFCAT"] = "0";
			$scope[from][occ]["VSL_ORST_WINVO"] = $scope.formSelDocId;
			
			$scope["rawResult"][to][$scope["rawResult"][to].length] = $scope[from][occ];
			$scope[to][$scope[to].length] = $scope[from][occ];
			occ += 1;
		}
		if (!dDta['fr1'])
		{
			dDta['fr1'] = new Object;
		}
		dDta['fr1'][from] = $scope[from]		
	}
	

	$scope.processVSL_DELIVERED = function(pType)
	{
		try
		{
			wDoc.close();
		}
		catch(er){}
		
		var selPicks = $scope.deliveryID.split(",")
		pType += " ("+selPicks.length +")";
		var wDoc = window.open('oneMomentPlease.php?title=Sales Invoices' + "&process=" + pType ,'ABviewForm');
		
		
		var tmpObj = new Object();
		tmpObj["doc_process"] = $scope.deliveryID;
		tmpObj["doc_printed"] = $scope.doc_printed;
		A_Scope.callBack = "$scope.printExec();";
		$scope.ABchk(tmpObj,"vsl_delivered");
	}
		
	$scope.getVSL_DELIVERED = function()
	{
		var tmpObj = new Object();
		tmpObj["doc_printed"] = $scope.doc_printed;
		
		if ($scope.doc_printed > 0)
		{
			tmpObj["date_range"] = $scope.doc_date_from + "," + $scope.doc_date_to;
			tmpObj["idVGB_CUST"] = $scope.find_idVGB_CUST;
		}
		$scope.deliveryID = "";
		$scope.ABchk(tmpObj,"vsl_delivered");
	}
	
	$scope.selectAddAll = function()
	{
		$("[ng-model='varRow.VSL_ORST_WINVO']").each(function()
		{
			var tval = $(this).val();
			if ($scope.isSelected(tval) == false)
			{
				$scope.setSelected(tval,0);
			}
		});
	}
		
	$scope.selectClearAll = function()
	{
		$("[ng-model='varRow.VSL_ORST_WINVO']").each(function()
		{
			var tval = $(this).val();
			if ($scope.isSelected(tval) == true)
			{
				$scope.setSelected(tval,0);
			}
		});
	}

	$scope.isSelected = function(delID)
	{
		var ret = 0;
		var testVar = "," + $scope.deliveryID + ","
		if (testVar.indexOf("," + delID + ",") >-1)
		{
			ret = 1;
		}
		return ret;
	}

	$scope.setSelected = function(delID,updCount)
	{
		var ret = 0;
		var testVar = $scope["deliveryID"].split(",")
		var newVar = "";
		var comma = "";
		var occ = 0
		while (occ < testVar.length && $scope["deliveryID"].trim() != "")
		{
			if (testVar[occ] == delID)
			{
				ret = 1;
			}
			else
			{
				newVar += comma + testVar[occ]
				comma = ","
			}
			occ += 1
		}
		if (ret == 0)
		{
			newVar += comma + delID
		}
		
		$scope["deliveryID"] = newVar;

	}

	$scope.chkRangePartner = function(fieldName,tblName,tblField)
	{
		
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
			var matchFound = false;
			var occ = 0;
			while (occ < $scope["rawResult"]["vgb_bpar"].length && $scope[fieldName] == "")
			{
				if (fieldName.indexOf("_CUST") >-1  && $scope["rawResult"]["vgb_bpar"][occ]["idVGB_CUST"] > 0)
				{
					$scope[fieldName] = $scope["rawResult"]["vgb_bpar"][occ][tblField];
					$scope.find_idVGB_CUST = $scope["rawResult"]["vgb_bpar"][occ].idVGB_CUST;
					$scope.find_VGB_CUST_BPNAM = $scope["rawResult"]["vgb_bpar"][occ].VGB_CUST_BPNAM;
					$scope.find_VGB_BPAR_BPART = $scope["rawResult"]["vgb_bpar"][occ].VGB_BPAR_BPART;
					matchFound = true;
				  	
				}
				

				
				occ += 1;
			}
			
			if (matchFound == false)
			{
				$scope.find_idVGB_CUST = 0;
			}
			
			if ($scope[fieldName] == "")
			{
				$scope["VGB_BPAR_BPART"] =  $scope["var_items"][0]["VGB_BPAR_BPART"];		
			}
			$scope[fieldName] = "";

			
		}
		else
		{
			$scope["VGB_BPAR_BPART"] =  $scope["var_items"][0]["VGB_BPAR_BPART"];		
		}
	}

	$scope.initCustomer = function()
	{
		$scope.find_idVGB_CUST = $scope.abSessionResponse.idVGB_CUST;
		$scope.find_VGB_CUST_BPNAM = $scope.abSessionResponse.VGB_CUST_BPNAM;
		$scope.find_VGB_BPAR_BPART = $scope.abSessionResponse.VGB_BPAR_BPART;
	}
	
	$scope.getVSL_DELIVERED();
	
}

A_LocalAgularFn.prototype.VSL_PICKER = function($scope,$http,$routeParams) 
{
	$scope.inPicking = 1;

	$scope.pickCheck = 1;
	$scope.orderSelected = 0;
	$scope.idVSL_ORHE = 0;
	$scope.VSL_ORHE_ORNUM = "";
	A_LocalAgular["VSL_ORHECT"]($scope,$http,$routeParams);

	$scope.initPickOrder = function(idOrd,idPic)
	{
		
		$scope.pickCheck = 1;


		A_Scope.callBack="$scope.setupSpecSheets();$scope.countPending();$scope.setOrhePick("+idPic+");"		
		// A_Scope.callBack="$scope.setOrhePack("+idPic+");"		
	
		var tmpObj = new Object();
		tmpObj["idVSL_ORHE"] = idOrd;
		// A_Scope.callBack = "$scope.countPending();"
		$scope.ABchk(tmpObj,"vsl_orheXXX");
		
//		$scope.ABinitTbl("vsl_orhe","idVSL_ORHE")
//		// $scope.ABinitTbl("vsl_pickerChk","idVSL_ORHE")
//		$scope.ABupdChkObj("idVSL_ORHE",idOrd,true);
//		
//		A_Scope.callBack = "$scope.setOrhePick("+idPic+");"
//		$scope.ABchk();
		$scope.DOC_ORST = "";
		$scope.allPicksSelected = false;		
		
	}	
	
	$scope.getVSL_PICK = function()
	{
		$scope.idVSL_ORHE=0;
		A_Scope.callBack = "$scope.getUsers();$scope.setFormPickOn(0);";
		$scope.ABlstAlias('idVSL_ORHE','idVSL_ORHE','vsl_pickerChk','vsl_pick');
				
	}
	
	$scope.countCheckBox = function(objAttr)
	{
		var vVal = 1
		
		$("[" + objAttr + "]").each(function()
		{
			if ($(this).prop("checked")==false)
			{
				vVal = 0
			} 
		});
		
		if (vVal == 0)
		{
			$scope.allPicksSelected = false;
		}
		else
		{
			$scope.allPicksSelected = true;
		}
		
		
		
	}


	
	$scope.setOrhePick = function(pickId)
	{
		$scope["tmpORHE"] = new Array();
		var occ = 0;
		
		while (occ < $scope["vsl_orhe"].length)
		{
			if ($scope["vsl_orhe"][occ]["VSL_ORST_PICID"] == pickId)
			{
				$scope["tmpORHE"][$scope["tmpORHE"].length] = $scope["vsl_orhe"][occ];
			}
			occ += 1;
		}
		
		dDta["tmpORHE"] = $scope["tmpORHE"];
		$scope["vsl_orhe"] = $scope["tmpORHE"];
		
		
		$scope.pickCheck = 0;
		$scope.orderSelected = pickId;
		
		
	}
	
	$scope.setFormPickOn = function(pickId)
	{

		// $scope.inveRefresh();
		// $scope.orderQuery();
		
		setTimeout(function()
		{
			
			$scope.pickCheck = 0;
			// 
			
		},100);
		
			
	}	
	
	$scope.setFormPickOff = function(pickId)
	{
		$scope.orderSelected = 0;	
	}	
	
	

	$scope.ACVarFilterInit = function(colName,colVal)
	{
		// colVal = $scope["list"+colName];
		
		var occ = 0;
		while (occ < $scope["rawResult"]["vsl_pick"].length)
		{	
			if ( !$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["hidden"] = "  ";
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
			}
			
			$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vsl_pick"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vsl_pick"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vsl_pick"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
	
}	

// Begin


A_LocalAgularFn.prototype.VSL_PACKER = function($scope,$http,$routeParams) 
{
	$scope.inPacking = 1;
	$scope.pickCheck = 1;
	$scope.orderSelected = 0;
	
	$scope.idVSL_ORHE = 0;
	$scope.VSL_ORHE_ORNUM = "";
	A_LocalAgular["VSL_ORHECT"]($scope,$http,$routeParams);

	$scope.initPackOrder = function(idOrd,idPic)
	{
		
		$scope.pickCheck = 1;

		A_Scope.callBack="$scope.setupSpecSheets();$scope.countPending();$scope.setOrhePack("+idPic+");"		
	
		var tmpObj = new Object();
		tmpObj["idVSL_ORHE"] = idOrd;
		$scope.ABchk(tmpObj,"vsl_orheXXX");

		$scope.DOC_ORST = "";
		$scope.allPicksSelected = false;		
		
	}	

	$scope.dispCurrent = function(obj)
	{
		alert(obj + "\n" + showProps(obj,"v"))
		
	}
	

	$scope.getVSL_PACK = function()
	{
		$scope.idVSL_ORHE=0;
		A_Scope.callBack = "$scope.getUsers();$scope.setFormPackOn(0);";
		$scope.ABlstAlias('idVSL_ORHE','idVSL_ORHE','vsl_packerChk','vsl_pack');
				
	}
	
	
	$scope.countCheckBox = function(objAttr)
	{
		var vVal = 1
		
		$("[" + objAttr + "]").each(function()
		{
			if ($(this).prop("checked")==false)
			{
				vVal = 0
			} 
		});
		
		if (vVal == 0)
		{
			$scope.allPicksSelected = false;
		}
		else
		{
			$scope.allPicksSelected = true;
		}
		
		
		
	}


	
	$scope.setOrhePack = function(pickId)
	{
		$scope["tmpORHE"] = new Array();
		var occ = 0;
		
		while (occ < $scope["vsl_orhe"].length)
		{
			if ($scope["vsl_orhe"][occ]["VSL_ORST_PAKID"] == pickId)
			{
				$scope["tmpORHE"][$scope["tmpORHE"].length] = $scope["vsl_orhe"][occ];
			}
			occ += 1;
		}
		
		dDta["tmpORHE"] = $scope["tmpORHE"];
		$scope["vsl_orhe"] = $scope["tmpORHE"];
		
		
		$scope.pickCheck = 0;
		$scope.orderSelected = pickId;
		
		$scope.initSupportSVIA()
		
	}
	
	$scope.setTransporter = function(record)
	{
		$scope.VGB_SUPP_BPNAM = record.VGB_SUPP_BPNAM;
		$scope.VSL_ORSI_BPART = record.idVGB_SUPP;
		// SUPPLIER_BPART = abSessionResponse.VGB_BPAR_BPART
	}

	$scope.setFormPackOn = function(pickId)
	{

		// $scope.inveRefresh();
		// $scope.orderQuery();
		
		setTimeout(function()
		{
			$scope.pickCheck = 0;
		 	// $scope.orderQuery();
			
		},100);
		
			
	}	
	
	$scope.setFormPackOff = function(pickId)
	{
		$scope.orderSelected = 0;	
	}	
	
	

	$scope.ACVarFilterInit = function(colName,colVal)
	{
		// colVal = $scope["list"+colName];
		
		var occ = 0;
		while (occ < $scope["rawResult"]["vsl_pack"].length)
		{	
			if ( !$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["hidden"] = "  ";
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
			}
			
			$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vsl_pack"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vsl_pack"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vsl_pack"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
	
}	


// END






A_LocalAgularFn.prototype.VSL_ORHECT = function($scope,$http,$routeParams) 
{
	<?php require_once "../appCscript/VSL_ORDERS_VSL_ORHECT.php"; ?>
}

A_LocalAgularFn.prototype.VSL_ORDERS = function($scope,$http,$routeParams)
{
	
	$scope.vsl_orheHasStepsCurrent = 1;
	

	// I included this below to comply with your current HTML. But you must modify VIN_ITEMS to directly call ABlstAlias in $inTrig kPress statements
	// You must rewrite the function to specify "vin_item"  in reference to ng-repeat="x in vin_item"
	// Will give same resuls and will comply to naming convention.
	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		
		$scope.ABlstAlias(ce,obj,tbl,"vsl_orhe")
	}
	
	$scope.VSL_ORHE_ORNUM = ""
	$scope.kPress('VSL_ORHE_ORNUM','VSL_ORHE_ORNUM,vsl_orheHasStepsCurrent','vsl_orhe',0)
	
	
	$scope.vsl_orheTestXXX = function(orheId)
	{
		
		var tmpObj = new Object();
		tmpObj["idVSL_ORHE"] = orheId;
		$scope.ABchk(tmpObj,"vsl_orheXXX");

	}
	
	
}
	





</script>



