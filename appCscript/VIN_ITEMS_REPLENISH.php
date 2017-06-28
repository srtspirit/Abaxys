
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
	
	
		if (xSearch && xSearch.indexOf("'" + chkVal + "'") > -1)
		{
			return true;
		}	
		else
		{
			return false;
		}
	}
	
	
	
	$scope.ACVarFilterInit = function(colName,colVal)
	{
		// colVal = $scope["list"+colName];
		
		var occ = 0;
	
		while (occ < $scope["rawResult"]["vin_rpln"].length)
		{	
			if ( !$scope["rawResult"]["vin_rpln"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vin_rpln"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vin_rpln"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vin_rpln"][occ]["rowRowLog"]["hidden"] = "  ";
				  
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
				
			}
			
			$scope["rawResult"]["vin_rpln"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vin_rpln"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vin_rpln"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vin_rpln"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vin_rpln"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vin_rpln"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vin_rpln"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
	
	
	// Your are here initReplenishClick
	$scope.editingOrder = 0;
	
	$scope.editingOrderSet = function(ornum,oType)
	{	
		var orderDsp = "";
		
		if (oType.toUpperCase()=="VSL")
		{
		
			$("[slsId='" + ornum +"']").each(function()
			{
				orderDsp += $(this).html();
			});
			
			$scope.abAppOpen=1;
			$scope.abAppLinkOpen=true;

			setTimeout(function()
			{
				if ($("#orderEditor").attr("src").indexOf("#/VSL_ORDERS/VSL_ORHECT/idVSL_ORHE:" + ornum + ",updType:UPDATE,Session:VSL_ORHECT,Process:VSL_ORDERS") ==-1)
				{
					$("#orderEditor").attr("src","#/VSL_ORDERS/VSL_ORHECT/idVSL_ORHE:" + ornum + ",updType:UPDATE,Session:VSL_ORHECT,Process:VSL_ORDERS");
				}
			},10)
		}
		if (oType.toUpperCase()=="VPU")
		{

			$("[purId='" + ornum +"']").each(function()
			{
				orderDsp += $(this).html();
			});

			$scope.abAppOpen=1;
			$scope.abAppLinkOpen=true;

			setTimeout(function()
			{
				if ($("#orderEditor").attr("src").indexOf("#/VPU_ORDERS/VPU_ORHECT/idVPU_ORHE:" + ornum + ",updType:UPDATE,Session:VPU_ORHECT,Process:VPU_ORDERS")==-1)
				{
					$("#orderEditor").attr("src","#/VPU_ORDERS/VPU_ORHECT/idVPU_ORHE:" + ornum + ",updType:UPDATE,Session:VPU_ORHECT,Process:VPU_ORDERS");
				}
				
			//	alert($("#orderEditor").length+"="+$scope.abAppOpen+"-"+$scope.abAppLinkOpen);
			},10)

			// alert($("#orderEditor").length+"="+$scope.abAppOpen+"-"+$scope.abAppLinkOpen);

		}
		
		$("#orderDsp").html(orderDsp);
		
	}
	
	
	$scope.initReplenish = function()
	{
		var newObj = new Object();
		A_Scope.callBack = "$scope.specQuantity();";
		$scope.ABchk(newObj,'vin_item_replenish');
		
		
	}
	
	
	$scope.vsl_DEL_EVAL = function()
	{
		var newObj = new Object();
		A_Scope.callBack = "";
		$scope.ABchk(newObj,'vsl_DEL_EVAL');
		
		
	}	

	$scope.specQuantity = function()
	{
		
		var specs = $scope.vin_item_replenish
		var newSpec = new Array();
		var occ = 0;
		while (occ < specs.length)
		{
			if (specs[occ]["rTable"] == "vin_specqty")
			{
				newSpec[newSpec.length] = specs[occ];
			}
			occ +=1;
		}
		
		$scope.vin_specqty = newSpec;
		dDta["vin_specqty"] = newSpec;
		// $scope.vsl_DEL_EVAL();
		
	}

	$scope.computeReplMessage = function(FIRSTD,inACKQT,inSUETA,inMINQT,inMINSD,inBOHQT,inPURACK,inSLSACK)
	{
		try
		{
		var ACKQT 	= Number(inACKQT)*1;
		var SUETA       = Number(inSUETA)*1; 
		var MINQT       = Number(inMINQT)*1; 
		var MINSD       = Number(inMINSD)*1; 
		var BOHQT       = Number(inBOHQT)*1; 
		var PURACK      = Number(inPURACK)*1;
		var SLSACK      = Number(inSLSACK)*1;

		var dayCount	= $scope.ABGetDateFn('diff-today',FIRSTD) * -1;
		var dayQty 	= (ACKQT/dayCount).toFixed(0)*1;
		var perQty	= (ACKQT/dayCount*SUETA).toFixed(0)*1;
		var minQty	= MINQT*1;
		if (minQty<1)
		{
			minQty = MINSD * dayQty;
		}
		var BOHRQ	= (BOHQT*1)+(PURACK*1)-(SLSACK*1)-(perQty*1);
		var MINRQ	= (BOHQT*1)+(PURACK*1)-(SLSACK*1)-(minQty*1)-(perQty*1);

		var message = "";
		
		if ( BOHRQ < 0) 
		{
			var xx = MINRQ * -1;
			message +='Below balance on hand! Requires: ' + xx ;
		}
		if ( MINRQ < 0) 
		{
			var xx = MINRQ * -1;
			message +='Below Minimum Qty! Requires: ' + xx;
		}
		}
		catch(er)
		{
			var message = "hell" + er;
		}
		
		return message;
		
	}


	$scope.evalSpecs = function(ornum,orlin,stpsq,rTable)
	{
		
		var occ = 0;
		var wocc = 0;
		var locc = 0;
		var lotL = 0;
		
		var ordRec = $scope.vsl_replOrders;
		var specs = $scope.vin_replSpecs;
		
		var ssmaList = new Array();
		var ssmaId = new Array();
		var ssmaLots = new Object();
		var workList = "";

		var specQty = new Object();
		var wlistLots = "";
		var wQty = 0;
		
		var lotChk = $scope.vin_item_replenish;
		var specChk = $scope.vin_replSpecs
		
		dDta.vin_item_replenish = $scope.vin_item_replenish;
		dDta.vin_replSpecs = $scope.vin_replSpecs;
		
		occ = 0
		while (occ <specChk.length )
		{
			if (wlistLots.indexOf("," + specChk[occ].idVIN_SSMA + "," + specChk[occ].idVIN_LSHE + "," ) == -1 )
			{
				wlistLots += "," +specChk[occ].idVIN_SSMA+","+specChk[occ].idVIN_LSHE+",";
				
				if (!specQty[specChk[occ].idVIN_SSMA])
				{
					specQty[specChk[occ].idVIN_SSMA] = new Object();
					specQty[specChk[occ].idVIN_SSMA]['BOHQT'] = 0;
					specQty[specChk[occ].idVIN_SSMA]['ALOQT'] = 0;
					specQty[specChk[occ].idVIN_SSMA]['PURQT'] = 0;
					specQty[specChk[occ].idVIN_SSMA]['ORDQT'] = 0;
				}
				wQty = 0
				wocc = 0
			

				var BOH = 0; //lotChk[wocc].BOHQT;
				var ALO = 0; //lotChk[wocc].ALOQT;
				var PUR = 0; //lotChk[wocc].PURQT;

				var debug = "";
				while (wocc < lotChk.length)
				{
					try{
					if (lotChk[wocc].idVIN_LSHE == specChk[occ].idVIN_LSHE && lotChk[wocc].rTable=='vin_lslq')
					{
						BOH = lotChk[wocc].BOHQT;
						ALO = lotChk[wocc].ALOQT;
						PUR = lotChk[wocc].PURQT;
						
						wQty = (lotChk[wocc].BOHQT*1);
						wQty = wQty - (lotChk[wocc].ALOQT*1);
						wQty += (lotChk[wocc].PURQT*1);
						
						wocc = lotChk.length;
					}
					}
					catch(er)
					{
						// dDta["lotChk"][dDta["lotChk"].length] = er; //lotChk[wocc];
					}
					
					wocc += 1;
				}
				
				specQty[specChk[occ].idVIN_SSMA]['BOHQT'] += (BOH*1)
				specQty[specChk[occ].idVIN_SSMA]['ALOQT'] += (ALO*1)
				specQty[specChk[occ].idVIN_SSMA]['PURQT'] += (PUR*1)
			}
			
			occ += 1;
		}

		
		occ = 0;
		while (occ < ordRec.length)
		{
			if (ordRec[occ]["ORNUM"] == ornum && ordRec[occ]["ORLIN"] == orlin && ordRec[occ]["idVIN_SSMA"] && ordRec[occ]["rTable"] == rTable)
			{
				workList += "," + ssmaList.join(",") + ",";
				if (workList.indexOf("," + ordRec[occ]["idVIN_SSMA"] + ",") == -1)
				{
					ssmaList[ssmaList.length] = ordRec[occ]["idVIN_SSMA"];
					ssmaId[ssmaId.length] = ordRec[occ]["VIN_SSMA_SPEID"];
					try
					{
						specQty[ordRec[occ]["idVIN_SSMA"]]["ORDQT"] = (specQty[ordRec[occ]["idVIN_SSMA"]]["BOHQT"]*1) - (ordRec[occ]["ORDQT"] * 1) ;
					}
					catch(er){}
				}
				
			} 
			occ += 1;
		}
		// dDta.lotCCCCC = specQty.length + "==" + ssmaList.length
		
		occ = 0;
		while (occ < ordRec.length && ssmaList.length)
		{
			
			if (ordRec[occ]["ORNUM"] == ornum 
				&& ordRec[occ]["ORLIN"] == orlin 
				&& ordRec[occ]["STPSQ"] == stpsq 
				&& ordRec[occ]["idVIN_LSHE"] 
				&& ordRec[occ]["rTable"] == rTable)
			{
				lotL = ordRec[occ]["idVIN_LSHE"];
				if (!ssmaLots[lotL])
				{
					ssmaLots[lotL] = new Object();
					ssmaLots[lotL]["VIN_LSHE_LOTID"] = ordRec[occ]["VIN_LSHE_LOTID"];
					ssmaLots[lotL]["VIN_LSHE_SERNO"] = ordRec[occ]["VIN_LSHE_SERNO"];
					ssmaLots[lotL]["specs"] = new Array();
					ssmaLots[lotL]["notspecs"] = new Array();
					ssmaLots[lotL]["lotOk"] = true;
					ssmaLots[lotL]["specQtOk"] = true;
					wocc = 0;
					while( wocc < specs.length)
					{
						if (ordRec[occ]["idVIN_LSHE"] == specs[wocc]["idVIN_LSHE"])
						{
							workList = "," + ssmaLots[lotL]["specs"].join(",") + ",";
							if (workList.indexOf("," + specs[wocc]["idVIN_SSMA"] + ",") == -1)
							{
								ssmaLots[lotL]["specs"][ssmaLots[lotL]["specs"].length] = specs[wocc]["idVIN_SSMA"];
							}						
						}
						wocc += 1;
					}	
					workList = "," + ssmaLots[lotL]["specs"].join(",") + ",";
					locc=0;
					while (locc < ssmaList.length )
					{
						if (workList.indexOf("," + ssmaList[locc] + ",") == -1)
						{
							ssmaLots[lotL]["notspecs"]+= " (" + ssmaId[locc] + ")";
							ssmaLots[lotL]["lotOk"] = false;
						}
							if (!dDta["lotChk"])
							{
								dDta["lotChk"]= new Array();
							}		
							
							if (specQty[ssmaList[locc]])
							{
								// ssmaLots[lotL]["specQtOk"] += "[" + ordRec[occ]["VIN_LSHE_LOTID"] +"-"+ specQty[ssmaList[locc]]["ORDQT"]+"-"+ specQty[ssmaList[locc]]["ALOQT"]+"-"+ specQty[ssmaList[locc]]["PURQT"]+"]";
							}
							dDta["lotChk"][dDta["lotChk"].length] = specQty[ssmaList[locc]];
						
						try
						{
							if (specQty[ssmaList[locc]]["ORDQT"] < 0)
							{
								ssmaLots[lotL]["specQtOk"] = false
							}
						}
						catch(er){
								ssmaLots[lotL]["specQtOk"] = false
							}
						
						locc += 1;
					}
					
							
				}
			}

			occ += 1;
		}
		
		
			
		var lotChk = new Array();
		
		try
		{
			for (var i in ssmaLots)
			{
				if (ssmaLots.hasOwnProperty(i))
				{
					if (ssmaLots[i]["lotOk"] == false)
					{
						occ = lotChk.length;
						lotChk[occ] = new Object();
						lotChk[occ] = ssmaLots[i];
					}
				}
		  	}			
		}
		catch(er){lotChk[lotChk.length]=er}

		
		return lotChk;
		
	}

