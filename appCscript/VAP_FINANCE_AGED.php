	//setting up aging date initial value
//	var today = new Date();
//	var year = today.getFullYear();
//	var month = today.getMonth() + 1;
//	var day = today.getDate();
//	$scope.agingDate = "" + year + (month > 9? month: "0" + month) + (day > 9? day: "0" + day);
	
	$scope.agingDate = $scope.ABGetDateFn('get-year','')+$scope.ABGetDateFn('get-month','')+$scope.ABGetDateFn('get-day','');

	
	$scope.suppFilter = new Array();

	$scope.daysDiff = function($date1, $date2)
	{
		var mSecPerDay = 1000 * 60 * 60 * 24;
		return ($date2 - $date1) / mSecPerDay;
	}
	$scope.selectRec = function(recId,objName)
	{
		if (recId == 0)
		{
			$scope[objName] = new Array();
			return;
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
	
	$scope.doAgingReport = function()
	{
		var tmpObj = new Object();
		tmpObj.agingDate = $scope.agingDate;
		tmpObj.suppFilter = $scope.suppFilter;
		A_Scope.callBack = "$scope.fillAgedReport();";
		$scope.ABchk(tmpObj,"vap_agedreport");
	}
	
	$scope.readVarItems = function()
	{
		A_Scope.setAlertUser("inside readVarItems","andrey");
		var wRec = $scope.userFilter;
		var suppList = "";
		var occ = 0;
		var sPattern = "[=SPE=] ";
		
//		if ($scope.ALL == 0 && $scope.Supplier.length > 0)
		if ($scope.ALL == 0)
		{
			
			// loop $scope.suppliers
			if ($scope.userFilter.length > 0)
			{
				//sPattern += " AND ( ";
				var xOr = "";
				var occ = 0;
				while (occ < wRec.length)
				{
					if (suppList.indexOf(","+wRec[occ].idVGB_SUPP + ",") == -1)
					{
						suppList += "," + wRec[occ].idVGB_SUPP + ",";
						sPattern += xOr + " VAP_OIHE_BSUPP = " + wRec[occ].idVGB_SUPP + " " ;
						xOr = " OR ";
					}
			
					occ +=1 ;
				}
				//sPattern += " )";
	
			}
			
		}
		else
		{
			$scope.ALL = 1	
		}	
		
		
		var mnTable = "vap_oihe";
		var joinTbls = "vap_oide:VAP_OIDE_OITID = idVAP_OIHE,vgb_supp:idVGB_SUPP = VAP_OIHE_BSUPP";
		var alias = "Andrey";
		var orderBy = "VGB_SUPP_BPNAM";
		var objFunctions = "(max(VAP_OIHE_AMUNT) + sum(VAP_OIDE_AMUNT)) as balance";
		var groupBy = "VAP_OIHE_BSUPP,idVAP_OIHE";
		var callBack = "$scope.readAr();";
			
		$scope.ABsearchAlias(mnTable, joinTbls, sPattern, alias,orderBy,callBack, objFunctions, groupBy);
	}
	
	$scope.fillAgedReport = function()
	{
		var agedTableRef = $scope.vap_agedreport;
		/*
		response is a table with structure:
		cust_name_1 | 0 				| totalDebt | total30 	| total60 	| total90 	| total120 	| totalOld
		cust_name_1 | invoiceNumver 	| 0			| 0			| 0			| xxx		|	0		| 0
		cust_name_1 | invoiceNumver 	| 0			| 0			| xxx		| 0			|	0		| 0
		cust_name_2 | 0 				| totalDebt | total30 	| total60 	| total90 	| total120 	| totalOld
		cust_name_2 | invoiceNumver 	| 0			| xxx		| 0			| 0			|	0		| 0
		cust_name_2 | invoiceNumver 	| 0			| 0			| xxx		| 0			|	0		| 0
		*/
		
		$scope.dummyTable = new Array();
		var clientDebt;
		A_Scope.setAlertUser(agedTableRef.length, "Andrey");
		for (i = 0; i < agedTableRef.length; i++)
		{
			if (i == 0 || agedTableRef[i].VGB_SUPP_BPNAM != agedTableRef[i-1].VGB_SUPP_BPNAM)
			{
				if (i != 0)
				{
					$scope.dummyTable.push(clientDebt);
				}
				
				clientDebt = new Object();
				clientDebt.name = agedTableRef[i].VGB_SUPP_BPNAM;
				clientDebt.currency = agedTableRef[i].currency;
				clientDebt.currDesc = agedTableRef[i].VGB_CURR_DESCR;
				clientDebt.suppId = agedTableRef[i].idVGB_SUPP;
				clientDebt.totalDebt = agedTableRef[i].totalDebt;
				clientDebt.total30 = agedTableRef[i].total30;
				clientDebt.total60 = agedTableRef[i].total60;
				clientDebt.total90 = agedTableRef[i].total90;
				clientDebt.total120 = agedTableRef[i].total120;
				clientDebt.totalOld = agedTableRef[i].totalOld;
				clientDebt.invoices = new Array();
				
				continue;
			}
			
			clientDebt.invoices.push([agedTableRef[i].invoice
					,agedTableRef[i].invDate
					,agedTableRef[i].total30
					,agedTableRef[i].total60
					,agedTableRef[i].total90
					,agedTableRef[i].total120 
					,agedTableRef[i].totalOld ]);
			
//										,agedTableRef[i].invDate
//										,agedTableRef[i].total30 > 0? agedTableRef[i].total30 + " " + agedTableRef[i].currency: 0
//										,agedTableRef[i].total60 > 0? agedTableRef[i].total60 + " " + agedTableRef[i].currency: 0
//										,agedTableRef[i].total90 > 0? agedTableRef[i].total90 + " " + agedTableRef[i].currency: 0
//										,agedTableRef[i].total120 > 0? agedTableRef[i].total120 + " " + agedTableRef[i].currency: 0
//										,agedTableRef[i].Old > 0? agedTableRef[i].totalOld + " " + agedTableRef[i].currency: 0]);
		}
		
		$scope.dummyTable.push(clientDebt);
		dDta.dummyTable = $scope.dummyTable;
		dDta.vap_agedreport = $scope.vap_agedreport;
	}
	
	$scope.setTransacType = function(invRec)
	{
		var invoice = invRec[0];
		if (invoice == 0)
		{
			invoice = "Payment";
		}
		else
		{
			var occ = 2;
			while (occ < invRec.length)
			{
				if (invRec[occ] > 0)
				{
					invoice += " Invoice";
					occ = invRec.length;
				}
				if (invRec[occ] < 0)
				{
					invoice += " Credit";
					occ = invRec.length;
				}
				
				occ += 1;
			}
				
			
		}
		
		return invoice;	
			
	}
	
	$scope.setAmtDisplay= function(invAmt)
	{
		var invoice = "-"
		if (invAmt != 0)
		{
			invoice = "$" + invAmt;
		}
		
		return invoice;
	}
	
	$scope.readAr = function()
	{
		var tmpObj = new Object();
		tmpObj.agingDate = $scope.agingDate;
		A_Scope.callBack = "$scope.fillAgedReport();";
		$scope.ABchk(tmpObj,"vap_agedreport");
		
		var i = 0;
	
		var wi = 0;
		
		var table = new Array();
		var date = new Date();
		
		$scope.table = new Array();
		 
		for ( i = 0; i < $scope.Andrey.length; i++)
		{
			
			if ($scope.Andrey[i].VAP_OIHE_AMUNT < 0 || $scope.Andrey[i].balance == 0) continue; // unless having is invented
			
			
			wi = $scope.table.length - 1;
			if ($scope.table.length == 0 || ($scope.table[wi].VGB_SUPP_BPNAM != $scope.Andrey[i].VGB_SUPP_BPNAM))
			{
				
				wi = $scope.table.length;
				$scope.table[wi] = new Object();
				$scope.table[wi]["VGB_SUPP_BPNAM"] = $scope.Andrey[i].VGB_SUPP_BPNAM;
				$scope.table[wi]["idVGB_SUPP"] = $scope.Andrey[i].idVGB_SUPP;
				
				
				$scope.table[wi].before30 = new Array();
				$scope.table[wi].before60 = new Array();
				$scope.table[wi].before90 = new Array();
				$scope.table[wi].before120 = new Array();
				$scope.table[wi].after120 = new Array();
				
			}
			
			var invoice = new Object();
			invoice.num = $scope.Andrey[i].VAP_OIHE_INVOI;
			invoice.date = new Date($scope.Andrey[i].VAP_OIHE_DOCDA);
			invoice.amount = $scope.Andrey[i].VAP_OIHE_AMUNT;
			invoice.balance = ($scope.Andrey[i].balance == null? invoice.amount: $scope.Andrey[i].balance);
			
			var diffDays = $scope.daysDiff(invoice.date, date);

			
			$scope.table[wi]["id"] = i;
		
			
			if (diffDays < 30)
			{
				
				$scope.table[wi].before30.push(invoice);
				
			}
			else if (diffDays < 60)
			{
				$scope.table[wi].before60.push(invoice);
			}
			else if (diffDays < 90)
			{

				$scope.table[wi].before90.push(invoice);
			}
			else if(diffDays < 120)
			{
				$scope.table[wi].before120.push(invoice);
			}
			else
			{
				$scope.table[wi].after120.push(invoice);
			}
			
			
			//8888888888888888888888888888888888
			//******************dummy data*******************
			
			$scope.dummyTable = [new DebtSet("Dedorov"), new DebtSet("Bombardia")];
			
		}
		
		function DebtSet(name){
			this.name = name;
			this.totalDebt = 280;
			this.total30 = 100;
			this.total60 = 150;
			this.total90 = 0;
			this.total120 = 0;
			this.totalOld = 50;
			
			this.invoices = [["number at date", 50, " ", " ", " ", " ", " "],
						["number at date", 50, " ", " ", " ", " ", " "],
						["number at date", " ", 120, " ", " ", " ", " "],
						["number at date", " ", 30, " ", " ", " ", " "],
						["number at date", " ", " ", " ", " ", " ", 10],
						["number at date", " ", " ", " ", " ", " ", 40]];
		}
		
		
		// $scope["table"] = table;
	
		if (!dDta)
		{
			dDta = new Object();
		}
		dDta["andrey"] = $scope["table"];
		
		
	}
	
	$scope.hasOpenItems = function(bpId)
	{
		
		var ret = false;
		var occ = 0;
		var wRec = $scope.vap_items;
		while (occ < wRec.length)
		{
			if (wRec[occ].VAP_OIHE_BSUPP == bpId)
			{
				ret = true;
				// occ = wRec.length;
				break;
			}
			
			occ +=1 ;
		}
		
		return ret;
	}
	
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
		nObj["idVGB_SUPP"] = 117;
	
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
	
	
	
	

