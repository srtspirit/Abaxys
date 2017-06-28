

	$scope.ACVarDivHide = function()
	{
	
		$("[id^='flt']").addClass("ADdropdown");
	}
	

	$scope.ACVarDivToggle = function(colName)
	{
		
			
		$("[id^='flt']").each(function()
		{
			if ($(this).attr("id") != "flt"+colName)
			{
				$(this).addClass("ADdropdown")
			}
		});
		
		$("#flt"+colName).toggleClass("ADdropdown");
	}	
	


	// alert(showProps($scope.opts,"op"))

	// I included this below to comply with your current HTML. But you must modify VIN_ITEMS to directly call ABlstAlias in $inTrig kPress statements
	// You must rewrite the function to specify "vin_item"  in reference to ng-repeat="x in vin_item"
	// Will give same resuls and will comply to naming convention.
	
	// If you write in your prototype a function called $scope.localABupd()
	// ABUpd() function will call this function with the option variable "UPDATE,CREATE,DELETE"
	// If you want to cancel the operation the set variable $scope.ABupdCancel = true
	// In your code you can prepare data for the update 
	$scope.localABupd = function(opt)
	{
		$scope.setOrheFormInvisible();
		
		if (opt=="DELETE")
		{
			// A_Scope.callBack += "$scope.setOrheFormInvisible();$scope.resetOrheForm(2000);";
			A_Scope.callBack += "$scope.resetOrheForm(100);";
		}
		else
		{
			// A_Scope.callBack += "$scope.setOrheFormInvisible();$scope.resetOrheForm(12000);";
			A_Scope.callBack += "$scope.resetOrheForm(100);";
		}
			
		if (!A_Scope.cancelBack)
		{
			A_Scope.cancelBack = "";
		}
		// A_Scope.cancelBack += "$scope.resetOrheForm(10);";
		
	}

	$scope.setOrheFormInvisible = function()
	{
		$("#ab-buttonPad").addClass('invisible');
	}
	
	$scope.resetOrheForm = function(tCount)
	{	
		setTimeout(function()
		{
			$("#ab-buttonPad").removeClass('invisible');
		
		},tCount);
	}
	
	
	$scope.ABsessionUrl ="#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item";

	$scope.toggleSpecList = function(specId,specList,orde)
	{
		// alert($scope.getSpecColorSet(orde));
		if (!orde.VSL_ORDE_LSPEC)
		{
			orde.VSL_ORDE_LSPEC = "";
			specList = "";
		}
		
		specList = "," + specList.trim()
		
		var debug = "ID:"+specId+"\nLIST:"+specList
		
		if (specList.indexOf("," + specId + ",") == -1)
		{
			specList += specId + ",";
		}
		else
		{
			specList = specList.slice(0,specList.indexOf("," + specId + ",")) + specList.slice(specList.indexOf("," + specId + ",")+ 1 + specId.length)
		}

		// alert($scope.rawResult.vin_item_ssma)
		specList=specList.slice(1)
		
		
		if (specList.length<1)
		{
			specList = " "
		}		

		
		return specList;
	}
	
	
	
	$scope.setupSpecSheets = function()
	{
		$scope["specSheet"] = new Object();
		var wipINVE = $scope.vin_item_vin_lshe;
		var tmpDate = "";
		
		
		var count = 0;
		var occ = 0;
		var wocc = 0;
		
		while (occ < wipINVE.length)
		{
			if (wipINVE[occ].VIN_SSIT_ITMID > 0)
			{
				
				if (!$scope["specSheet"][wipINVE[occ].VIN_SSIT_ITMID])
				{
					$scope["specSheet"][wipINVE[occ].VIN_SSIT_ITMID] = new Array();
				}

				wocc = 0;
				var wipINVErows = wipINVE[occ].rowSet
				while (wocc < wipINVErows.length)
				{

					// wipINVErows[occ]["VIN_LSHE_SMDATES"] = ""
					
					if (wipINVErows[wocc].VIN_SSIT_ITMID > 0)
					{
						// wipINVErows[wocc].VIN_LSHE_DATES = $scope.ABGetDateFn('add-days',wipINVErows[wocc].VIN_LSHE_DOMDA + "," + wipINVErows[wocc].VIN_SSMA_SHLIF);
						
						// wipINVErows[occ]["VIN_LSHE_SMDATES"] = $scope.ABGetDateFn('add-days',wipINVErows[wocc].VIN_LSHE_DOMDA + "," + wipINVErows[wocc].VIN_SSMA_SHLIF);
						
						count = $scope["specSheet"][wipINVE[occ].VIN_SSIT_ITMID].length;
						$scope["specSheet"][wipINVE[occ].VIN_SSIT_ITMID][count]= wipINVErows[wocc];
						// $scope["specSheet"][wipINVE[occ].VIN_SSIT_ITMID][count]["VIN_LSHE_SMDATES"] = tmpDate;
					}
					
					wocc += 1;
				}
				
			}	

			occ += 1;

		}
		
		dDta["specSheet"] = $scope["specSheet"];
		dDta["wipINVE"] = wipINVErows;
		dDta["vin_item_vin_lshe"] = wipINVE;

	}

	$scope.inveRefresh = function()
	{
		// This function is access with ng-click in appHtml
		// Some scope code clicks this object on a timeout count
		
		$scope.inveQuery();
		$scope.idVIN_ITEM = 0; //$scope.VSL_ORDE_ITMID;
		// A_Scope.callBack = "$scope.setupSpecSheets();$scope.countPending()"
		A_Scope.callBack = "$scope.getOrheLstr();";
		$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_inveQuery','vin_inveQuery','vin_inve');	 

		
	}
	
	
	$scope.getOrheLstr = function()
	{
		A_Scope.callBack = "$scope.setupSpecSheets();$scope.countPending();$scope.resetOrheForm(4000);";
		$scope.ABlstAlias('idVSL_ORHE','idVSL_ORHE','vsl_orheLstr','vsl_orheLSTR');	  // To be support
		
	}
	
	$scope.inveQuery = function ()
	{
		var nL = "";
		$("[ng-model='x.VSL_ORDE_ITMID']").each(function()
		{ 
			
			if (nL.indexOf($(this).val() + ",") == -1)
			{
				// $scope.VSL_ORDE_ITMID = Math.min($(this).val(),$scope.VSL_ORDE_ITMID) 
				nL += $(this).val() + ",";
			}
		});
		$scope["vin_inveQuery"] = nL; 
		
		
	}

	$scope.countPending = function ()
	{
		try
		{
		
		setTimeout(function()
		{
			$("[ng-model='x.totalCount']").each(function()
			{ 
				
				$(this).val($(this).parent().find("[recount]").length);
				var resp = $(this).val();
				if ($(this).val() < 1)
				{
					var resp = "none"
				} 
				$(this).parent().parent().find("[ng-model='x.recCount']").val("(" + resp +")")
			});
			
			$("[lotaccumulator]").each(function()
			{
				$(this).click();
			});
			
			
		},500);
		}catch(er){alert(er)}
			
	
	}

    	$scope.updLotSel = function()
    	{
    		// alert ("HERE" + $("[ng-model$='.lotSel']").parentsUntil('table').find("[ng-model='y.selCountDsp']").val())
    		// alert($(this).parentsUntil("div").find("[ng-model='y.selCountDsp']").attr('ng-model'));
		$("[ng-model='y.lotSel']").each(function()
		{
			try{
				$(this).val($(this).parentsUntil('table').find('[lotselected]').val())
				
				var selList = $(this).val().split(',');
				var selCount = 0;
				var occ = 0;
				while (occ < selList.length-1)
				{
					selCount += Number(selList[occ].slice(selList[occ].indexOf(':')+1));
					occ += 1;
				};
			
				$(this).parentsUntil('table').find("[ng-model='y.selCountDsp']").val(selCount);
			
			}
			catch(er){alert($(this).val()+er)}
			
		}); 
		
		
    	}
    

	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		
		$scope.ABlstAlias(ce,obj,tbl,"vsl_orhe")
	}

	$scope.chkCurrMain = function()
	{

		var currMain = $("#mainForm").attr("ab-main");
		$("#mainForm").attr("ab-main","vsl_orst");
		tblInfo($scope,$http);
		$("#mainForm").attr("ab-main",currMain );
			
		
	}

	$scope.initSpace = function()
	{
		
		A_Scope.callBack = "$scope['idVSL_ORHE']=$scope.vsl_orhe[0]['idVSL_ORHE'];$scope.ckMain();"
		$scope.kPress('VSL_ORHE_ORNUM','VSL_ORHE_ORNUM','vsl_orhe',0)
	}		

	$scope.ckMain = function (ce,obj,tbl,dir)	
	{	
		var obj = new Object();
		obj["idVSL_ORHE"] = $scope.idVSL_ORHE
		$("[ab-new='1']").remove();
		A_Scope.callBack = "$scope['order_list'] = $scope['vsl_orhe'];$scope['orgVSL_ORHE_ORNUM'] = $scope.VSL_ORHE_ORNUM;"
		$scope.ABchkMain(obj,"vsl_orhe")
	}

	$scope.insertInDetail = function()
	{
		var nextLine = 0;
		var occ = 0;
		var newLine = 0;
		var newCount = 0;
		var nlFound = false;
		while (occ < $scope.vsl_orhe.length)
		{
			
			if (nextLine <  Number($scope.vsl_orhe[occ].VSL_ORDE_ORLIN))
			{
				nextLine = Number($scope.vsl_orhe[occ].VSL_ORDE_ORLIN);
			}
			if ($scope.vsl_orhe[occ].VSL_ORDE_ORLIN < 0 && nlFound == false)
			{
				newLine = occ;
				nlFound = true;
			}
			occ += 1;
		}
		
		if (nextLine < 1)
		{
			nextLine = 10;
		}
		else
		{
			nextLine += 10;
		}
		if (Math.floor(nextLine) != nextLine)
		{
			nextLine = Math.floor(nextLine+10)
		}
		
		if ($scope.vsl_orhe[newLine].VSL_ORDE_ORLIN < 0)
		{
			$scope.vsl_orhe[newLine].idVSL_ORDE = $scope.vsl_orhe[newLine].VSL_ORDE_ORLIN;
			$scope.vsl_orhe[newLine].VSL_ORDE_ORLIN = nextLine
			$scope.vsl_orhe[newLine].VSL_ORDE_ORDQT = 0;
			$scope.vsl_orhe[newLine].VSL_ORST_ORDQT = 0;
			$scope.vsl_orhe[newLine].VSL_ORDE_CFCAT = $scope.VSL_ORHE_CFCAT;
			$scope.vsl_orhe[newLine].VSL_ORDE_ITMID = 0;
			$scope.vsl_orhe[newLine].VSL_ORDE_DESCR = "";
			$scope.vsl_orhe[newLine].VSL_ORDE_ITEXT = "";
			$scope.vsl_orhe[newLine].VSL_ORDE_OTEXT = "";
			$scope.vsl_orhe[newLine].VIN_ITEM_ITMID = "";
			$scope.vsl_orhe[newLine].VIN_ITEM_LOTCT = 0;
			$scope.vsl_orhe[newLine].VSL_ORST_PDATE = $scope.ABGetDateFn('get-year','')+'-'+$scope.ABGetDateFn('get-month','')+'-'+$scope.ABGetDateFn('get-day','');
			$scope.vsl_orhe[newLine].VSL_ORST_STEPS = ""; 
			$scope.vsl_orhe[newLine].VSL_ORDE_OUNET = 0;
			$scope.vsl_orhe[newLine].VSL_ORDE_OLTYP = "STD";
			$scope.vsl_orhe[newLine].VSL_ORDE_LLINK = null; 
			$scope.vsl_orhe[newLine].VSL_ORDE_LSPEC = ""; 
			
			newCount += 1; 
		}
		$scope.accum();
		$scope.chkCurrMain();
		setTimeout("ABsetDatepickers();",50)	
		
	}
	

	$scope.insertInStep = function(ordLine,ordQty)
	{
		var nextLine = 0;
		var nextId = 0;
		var nextStep = 0;
		
		var occ = 0;
		var newLine = 0;
		var nlFound = false;
		while (occ < $scope.vsl_orhe.length)
		{
			if (ordLine == $scope.vsl_orhe[occ].VSL_ORDE_ORLIN)
			{
				nextId = Number($scope.vsl_orhe[occ].idVSL_ORDE);
				nextLine = Number($scope.vsl_orhe[occ].VSL_ORDE_ORLIN);
				nextStep = Number($scope.vsl_orhe[occ].VSL_ORST_STPSQ);
			}
				
			if ($scope.vsl_orhe[occ].VSL_ORDE_ORLIN < 0 && nlFound == false)
			{
				newLine = occ;
				nlFound = true;
				
			}
						
			occ += 1;
		}
		
		
		
		if (nextLine < 1)
		{
			return;
		}

		if (nextStep < 1)
		{
			nextStep = 10;
		}
		else
		{
			nextStep += 10;
		}
		
		
		if ($scope.vsl_orhe[newLine].VSL_ORDE_ORLIN < 0)
		{
			$scope.vsl_orhe[newLine].idVSL_ORDE = nextId;
			$scope.vsl_orhe[newLine].VSL_ORDE_ORLIN = nextLine;
			$scope.vsl_orhe[newLine].VSL_ORST_STPSQ = nextStep;
			$scope.vsl_orhe[newLine].VSL_ORST_ORDQT = ordQty;
			$scope.vsl_orhe[newLine].VSL_ORST_STEPS = "";
			
			$scope.vsl_orhe[newLine].newStepMess = "New"
			if (ordQty >0)
			{
				$scope.vsl_orhe[newLine].newStepMess = "Back-order";
			}
			
			// $scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VSL_ORDE_ORDQT','y.VSL_ORST_ORDQT');
		}
		
		$scope.accum();
		setTimeout("ABsetDatepickers();",50)	
		
	}
	
	$scope.insertIn22Step = function(attrName,attrValue,ordLine)
	{
		var debug="";
		
		var rep = "<tr ordline='0' ab-formlist='orstep_list' ng-repeat='y in vsl_orhe'  ab-new='2' ab-rowset='dirty' >";

		var occ = 0;
		$("[" + attrName + "='" + attrValue + "']").each(function()
		{
			
			if (occ == 0 && $(this).attr("ordline") == ordLine)
			{
				$(this).before(rep + $(this).html() + "</tr>");
				occ +=1
			}
			
			
		});
		
		$("[ab-rowset='dirty']").find("[ng-model]").each(function()
		{
			$(this).val("");
			$(this).attr("ab-orgval","")
			
		});
		
		$("[ab-rowset='dirty']").attr("ab-rowset","0")
		
		var occ = -1;
		$("[ab-new='2']").each(function()
		{
			$(this).attr("ab-rowset",occ);
			occ = occ - 1;
			
		});
		
		// alert(debug)
		
		// find("[ab-rowset='1']").html())
	}

	$scope.delSet = function()
	{
		$("[ng-model$='.trash']").val("1")
		$("[ng-model$='.trash']").attr("checked",true);
		$("[ng-model$='.trash']").parent("td").addClass("text-danger");
		$("[ng-model$='.trash']").parents("tr").find("[ng-model]").addClass("text-danger");
	
		A_Scope.callBack = "$scope.unDelSet();";
		$scope.ABupd('DELETE');
		
		if (A_Scope.callBack == "//cancel;")
		{
			$scope.unDelSet();$scope.resetOrheForm(10);
			A_Scope.callBack = "";
		}
		
	}
	
	
	
	$scope.unDelSet = function()
	{
		
		$("[ng-model$='.trash']").val("0")
		$("[ng-model$='.trash']").removeAttr("checked");
		$("[ng-model$='.trash']").parent("td").removeClass("text-danger");
		$("[ng-model$='.trash']").parents("tr").find("[ng-model]").removeClass("text-danger");
		
	} 
	
	
	$scope.initNewCustomer = function()
	{
		if ($scope.idVSL_ORHE < 1 || $scope.VSL_ORHE_BTCUS == $scope.abSessionResponse.idVGB_CUST)
		{
			$scope.idVGB_BPAR = $scope.abSessionResponse.VGB_CUST_BPART;
			$scope.VSL_ORHE_BTCUS = $scope.abSessionResponse.idVGB_CUST;
			$scope.VSL_ORHE_STCUS = $scope.abSessionResponse.idVGB_CUST;
			$scope.VSL_ORHE_OBCUS = $scope.abSessionResponse.idVGB_CUST;
			$scope.VSL_ORHE_BTADD = $scope.abSessionResponse.VGB_CUST_BTADD;
			$scope.VSL_ORHE_STADD = $scope.abSessionResponse.VGB_CUST_STADD;
			$scope.VGB_CUST_BPNAM = $scope.abSessionResponse.VGB_CUST_BPNAM;
			$scope.VSL_ORHE_BAORA = $scope.abSessionResponse.VGB_CUST_BAORA;
			$scope.VSL_ORHE_CRHOL = $scope.abSessionResponse.VGB_CUST_CRHOL;
			$scope.VSL_ORHE_TERID = $scope.abSessionResponse.VGB_CUST_TERID;
			$scope.VSL_ORHE_SLSRP = $scope.abSessionResponse.VGB_CUST_SLSRP;
			$scope.VSL_ORHE_CURID = $scope.abSessionResponse.VGB_CUST_CURID;
			$scope.VSL_ORHE_LLIFE = $scope.abSessionResponse.VGB_CUST_LLIFE;
			$scope.VSL_ORHE_ORFOB = $scope.abSessionResponse.VGB_CUST_ORFOB;
			$scope.VSL_ORHE_CFCAT = $scope.abSessionResponse.VGB_CUST_CFCAT;
			$scope.VGB_CUST_BPART = $scope.abSessionResponse.VGB_CUST_BPART;
			$scope.initAddress($scope.abSessionResponse.VGB_CUST_BPART);
			
			
		}

	}	
	
	$scope.getSpecColorSet = function (orde)
	{

		// finds the selected spec with the least of shelf life.
		specLink = "";

		if (orde["VSL_ORDE_LSPEC"].trim() != "" && $scope["specSheet"][orde["VSL_ORDE_ITMID"]])
		{
			var specList = "," + orde["VSL_ORDE_LSPEC"].trim() + ","
			var recSet = $scope["specSheet"][orde["VSL_ORDE_ITMID"]];
			var dayCount = 0;
			var occ = 0;
			while (occ < recSet.length)
			{
				if (specList.indexOf("," + recSet[occ]["idVIN_SSMA"] + ",") > -1)
				{
					
					if (dayCount == 0 || dayCount > Number(recSet[occ]["VIN_SSMA_SHLIF"]))
					{
						specLink = recSet[occ]["idVIN_SSMA"];
						dayCount = Number(recSet[occ]["VIN_SSMA_SHLIF"]);
					}
				}	
				
				occ += 1;
			}
			
		}
		
		
		return specLink;
		
	}
	
	$scope.setLifeColors = function(val,dta,orde)
	{
		
		
		if (!orde["VSL_ORDE_LLINK"])
		{
			var specId = orde;
		}
		else
		{
			var specId = orde["VSL_ORDE_LLINK"];
		}
		
		if (!dDta.colors)
		{
			dDta.colors = new Array();
		}
		
		dcl = dDta.colors.length
		dDta.colors[dcl] = new Object();
		
		dDta.colors[dcl]["val"] = val;
		dDta.colors[dcl]["dta"] = dta;
		dDta.colors[dcl]["specId"] = specId;
		dDta.colors[dcl]["orde"] = orde;
		dDta.colors[dcl]["item"] = orde["VSL_ORDE_DESCR"];
		
		var rColor = "green";
		
		var level_0 = 1;
		var level_1 = $scope["VSL_ORHE_LLIFE"];
		
		if (val < level_0)
		{
			rColor = "red";
		}
		else
		{
			if (val < level_1)
			{
				rColor = "yellow";
			}
		}
		
		dDta.colors[dcl]["rColor"] = rColor;
		var speColor = rColor;
		
		
		var isToSpec = true;
		
		if (specId >0)
		{
			
			isToSpec = false;
			var itmList = $scope["vin_item_ssma"];
			speColor = "red";
			
			var occ = 0;
			var wocc = 0;
			while (occ < itmList.length)
			{
				wocc =0;
				while (wocc < itmList[occ].rowSet.length && itmList[occ].idVIN_ITEM == dta.VIN_LSHE_ITMID )
				{
					if (itmList[occ]["rowSet"][wocc].VIN_SSLT_LOTID == dta.idVIN_LSHE && itmList[occ]["rowSet"][wocc].VIN_SSLT_SPESQ == specId)
					{
						speColor = rColor;
						isToSpec = true;
						dDta.colors[dcl]["orde"] = orde;
					}

					
					
					wocc += 1;
				}
				
				occ += 1;
			}
			
			
		}
		
		dDta.colors[dcl]["speColor"] = speColor;
		if (isToSpec == false && rColor.toUpperCase() != "RED")
		{
			speColor = "yellow"
		}
		
		// $scope["vin_item_ssma"]
		
		dDta.colors[dcl]["retColor"] = speColor;
		
		rColor = speColor;
		
			
		return rColor;
		
	}

	$scope.chkOrstQtyUnset = function()
	{
		$('#orstQtyModal').off('hidden.bs.modal')
	}	

	$scope.chkOrstQtySet = function()
	{
		$scope.chkOrstQtyUnset();
		$('#orstQtyModal').on('hidden.bs.modal', function () {
    			
    			$("#orstQtyModalCMD").click();
		})		
	}	
	
	$scope.backOrderInsert = function(ordeId,backOrderOptionQty)
	{
		
		if (backOrderOptionQty > 0 && $scope.orheBckOrd > 0)
		{
			$scope.insertInStep(ordeId,backOrderOptionQty)
		}
		
	}
	
	$scope.chkProfitMargin = function(orde)
	{
		
		if (orde.VSL_ORDE_QUONU > 0 && $scope.pmarg_IgnQuote == true)
		{
			return;
		}
		
		if (!$scope.vin_itmwar || $scope.vin_itmwar[0].VIN_ITMWAR_ITMID != orde.VSL_ORDE_ITMID)
		{
			var itmObj = new Object();
			itmObj["VIN_ITMWAR_ITMID"] = orde.VSL_ORDE_ITMID;
			itmObj["VIN_ITMWAR_WARID"] = orde.VSL_ORDE_WARID;
			A_Scope.callBack = "$scope.chkProfitMarginAmt(" + orde.idVSL_ORDE + ");";
			$scope.ABchk(itmObj,"vin_itmwar")
		}
		else
		{
			$scope.chkProfitMarginAmt(orde.idVSL_ORDE);
		}
			
		console.log(showProps(orde,"VSL"))
	}

	$scope.chkProfitMarginAmt = function(ordeId)
	{
		var ounet = 0;
		var rOcc = -1;
		var occ = 0;
		while (occ < $scope.vsl_orhe.length && rOcc < 0)
		{
			if ($scope.vsl_orhe[occ].idVSL_ORDE == ordeId)
			{
				$scope.vsl_orhe[occ].VSL_ORDE_COSTP = $scope.vin_itmwar[0].VIN_ITMWAR_AVGCP*1;
				ounet = $scope.vsl_orhe[occ].VSL_ORDE_OUNET;
				rOcc = occ;
			}
			occ += 1;
		}
		
		var avCost = $scope.vin_itmwar[0].VIN_ITMWAR_AVGCP * 1;
		var mProfit = $scope.AB_CPARM.VSL_CHECKS.PMARG / 100;
		var gProfit = 0;
		var cGood = ounet-avCost
		var gProfit = cGood/ounet
		
		if (gProfit < mProfit)
		{
			$scope["pmarg"] = new Object
			$scope["pmarg"].VSL_ORDE_ORLIN = $scope.vsl_orhe[rOcc].VSL_ORDE_ORLIN;
			$scope["pmarg"].VIN_ITEM_ITMID = $scope.vsl_orhe[rOcc].VIN_ITEM_ITMID;
			$scope["pmarg"].VIN_ITEM_DESCR = $scope.vsl_orhe[rOcc].VIN_ITEM_DESC1;
			$scope["pmarg"].VSL_ORDE_OUNET = $scope.vsl_orhe[rOcc].VSL_ORDE_OUNET;
			
			$('[data-target="#myModalPmarg"]').click();
		}
		
			
		
		console.log(ounet,$scope.vin_itmwar[0].VIN_ITMWAR_AVGCP*1)
	}

	
	$scope.chkOrstQty = function(ordeId,orstId,orstSteps)
	{

		$scope.retractRequired = 0;
		$scope.backOrderOption = 0;
		$scope.ordeId = ordeId;
		$scope.orstId = orstId;
		$scope.orstLotCount = 0;
		$scope.orstLotMess = "";
		$scope.chkOrstQtyUnset();
		
		// alert(orstId + "--" + $("#lotStpSum"+orstId).val() + "||" + orstSteps )
		if ($("#lotStpSum"+orstId))
		{
			
			$scope.orstLotCount = $("#lotStpSum"+orstId).val()
//			$("#lotStpSum"+orstId).click();
//			alert(orstId)
		}
		
		
		
		$scope.orheBckOrd = $scope.VSL_ORHE_BAORA * 1;
		
		var qty = $("#VSL_ORST_ORDQT"+$scope.orstId).val();
		
		var orgQty = $("#VSL_ORST_ORDQT"+$scope.orstId).attr("chkqty");
		if (orgQty == "init")
		{
			orgQty = $("#VSL_ORST_ORDQT"+$scope.orstId).attr("ab-orgval");
			$("#VSL_ORST_ORDQT"+$scope.orstId).attr("chkqty",orgQty);
		}
		
		$scope.orstOrgQty = orgQty;
		$scope.orstNewQty = qty;
		
		
		
		try
		{
			
			$scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VSL_ORDE_ORDQT','y.VSL_ORST_ORDQT');
		
			if (orstSteps < "FF_PICK")
			{ 
				return qty;
			}
			
			if (orstSteps > "FF_PICK" && qty != orgQty)
			{
				$scope.retractStep = orstSteps;
				$scope.retractRequired = 1;
				$('[data-target="#orstQtyModal"]').click();
				$scope.chkOrstQtyUnset();
				// $("#VSL_ORST_ORDQT"+orstId).focus();
				qty = orgQty;
				$scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VSL_ORDE_ORDQT','y.VSL_ORST_ORDQT');
				
	
	
			}
			else
			{
				if (Number(qty) < Number(orgQty))
				{
					
					
					if ($scope.orstLotCount && $scope.orstLotCount.length > 0)
					{
						$scope.orstLotMess = "You must adjust lot quantities";
					} 
					$scope.backOrderOption = 1;
					$scope.backOrderOptionQty = orgQty - qty;
					$("#VSL_ORST_ORDQT"+$scope.orstId).attr("chkqty",qty);
					$('[data-target="#orstQtyModal"]').click();
//					if ($scope.orheBckOrd > 0)
//					{
						$scope.chkOrstQtySet();
//					}
					
					$scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VSL_ORDE_ORDQT','y.VSL_ORST_ORDQT');
					
				}
				
			}
		
			$scope.setOrderDates();
		
		}catch(er){alert( "AA" + er)}
	
		return qty;
		
		// alert(qty + " --was " + orgQty + $scope.currentOrst["steps"])
	}
	
	$scope.setOrderDates = function()
	{
		
		if ($scope.VSL_ORHE_ODATE == "")
		{
			var d = new Date();
			var m = String(d.getMonth() + 1);
			if (m.length<2)
			{
				m = "0" + m;
			}
			if (d.getDate() < 10)
			{
				m += "0";
			}
			 
			$scope.VSL_ORHE_ODATE = d.getFullYear()+ m + d.getDate();
		}
		
		var DDATE = "";
		
		$("[ab-formlist='order_list']").each(function()
		{
			if ($(this).find("[ng-model='x.VSL_ORDE_ODATE']").val()=='')
			{
				$(this).find("[ng-model='x.VSL_ORDE_ODATE']").val($scope.VSL_ORHE_ODATE);
			}
			if ($(this).find("[ng-model='x.VSL_ORDE_DDATE']").val()=='')
			{
				$(this).find("[ng-model='x.VSL_ORDE_DDATE']").val($(this).find("[ng-model='x.VSL_ORDE_ODATE']").val());
			}
			
			DDATE = $(this).find("[ng-model='x.VSL_ORDE_DDATE']").val();
			
			$(this).find("[ab-formlist='orstep_list']").each(function()
			{

				if ($(this).find("[ng-model='y.VSL_ORST_PDATE']").val()=='')
				{
					$(this).find("[ng-model='y.VSL_ORST_PDATE']").val(DDATE);
				}

				
			});

		});
		
//		if(x.VSL_ORDE_ODATE == ''){x.VSL_ORDE_ODATE = x.VSL_ORHE_ODATE;};
//		if(x.VSL_ORDE_DDATE == ''){x.VSL_ORDE_DDATE = x.VSL_ORDE_ODATE;};
//		if(y.VSL_ORST_DDATE == ''){x.VSL_ORST_DDATE = x.VSL_ORDE_DDATE;};
	}

	$scope.initOrder = function()
	{

		setTimeout(function()
		{
			
			$scope.ABinitTbl("vsl_orhe","idVSL_ORHE")
			$scope.ABupdChkObj("idVSL_ORHE",$scope.opts.idVSL_ORHE,true);
			
			A_Scope.callBack = "$scope.copyOrg();$scope.chkCurrMain();$scope.initAddress();$scope.setOrderDocuments();$scope.getOrderTax();$scope.orderFormRefresh();setTimeout('ABsetDatepickers();',600);"
			A_Scope.callBack += "setTimeout('" + '$("#inveRefr").click();' + "',300);";
			
			$scope.ABchk();
		},500);
		
	}

	$scope.orderFormRefresh = function()
	{
		try
		{
		
		setTimeout(function()
		{
			$scope.abBindRefresh()
			
		},100);
		}catch(er){alert(er)}
	
	}		

	$scope.initOrderORSI = function()
	{
		A_Scope.callBack = "$scope.getOrderMessages();"
		$scope.ABlstAlias('idVSL_ORHE','idVSL_ORHE','vsl_orheOrsi','vsl_orheOrsi');

	}

	$scope.getOrderMessages = function()
	{
		$scope.idVGB_AMHE= 0;
		$scope.ABlstAlias('idVGB_AMHE','idVGB_AMHE','vgb_amhe','vgb_amhe');			
	}

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


		
		return ret;
	}

	
	$scope.setQuoteAccount = function(qRec)
	{
		alert($scope.VSL_ORHE_ODATE + "-" + qRec.VIN_CUST_EXPIR + "=" + $scope.ABGetDateFn('diff-days',qRec.VIN_CUST_EXPIR+","+$scope.VSL_ORHE_ODATE))
	}
	
	$scope.orderQuery = function ()
	{
		var nL = ",";
		$("[ng-model='x.VSL_ORDE_ITMID']").each(function()
		{ 
			
			if (nL.indexOf("," + $(this).val() + ",") == -1)
			{
				nL += $(this).val() + ",";
			}

		});
		
		nL = nL.slice(1);
		
		$scope["vin_item_specs"] = nL; 
		$scope["vin_item_lots"] = nL;

		$scope.idVIN_ITEM = 0
		$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_item_specs','vin_item_specs','vin_item_ssma');  

		$scope.idVIN_ITEM = 0
		// A_Scope.callBack="$scope.countLots();";
		$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_item_lots','vin_item_lots','vin_item_vin_lshe');  
	
		$scope["vin_item_lots"] = ""; 
		$scope["vin_item_specs"] = ""; 

	}

	$scope.countLots = function()
	{
		
		setTimeout(function()
		{
			$("[id^='lotAccum']").each(function()
			{

				var newSels = '';
				$(this).parentsUntil('table').find('[lotallo]').each(function()
				{
					if (isNaN($(this).val()) == true )
					{
						$(this).val($(this).attr('lastval'));
					}
					$(this).val(Math.abs($(this).val()))
					$(this).val($(this).val()=='0'?'':$(this).val())
					$(this).attr('lastval',$(this).val())
					if ($(this).val() > 0)
					{
						var lotUniqueId = $(this).attr('lotuniqueid'); // $(this).parentsUntil('div').find('[lotuniqueid]').val();
						newSels += lotUniqueId + ':' + Number($(this).val()) + ',';
					}
						
				});
				
				
				$(this).parentsUntil('table').find('[lotselected]').val(newSels);
				

			});
			
		},10);

	}
	
	$scope.getUsers = function()
	{
		if (!$scope["vls_users"] )
		{
			A_Scope.callBack = "$scope.getUnits();";
			$scope["CFG_USERS_CODE"] = " "; 
			$scope.ABlstAlias('CFG_USERS_CODE','CFG_USERS_CODE','cfg_users','vsl_users');
		}
		else
		{
			$scope.getUnits();
		}
		
	}
	
	$scope.getUnits = function()
	{
		if (!$scope["vin_unit"] )
		{
			var pattern = "[=SPE=]idVIN_UNIT > 0";
			$scope.ABsearchAlias('vin_unit','','','vin_unit','VIN_UNIT_UNITM ASC','$scope.getCurrency();')
		}
		else
		{
			$scope.getCurrency();
		}
	}

	$scope.getCurrency = function()
	{
		
		if (!$scope["vgb_curr"] )
		{
			var pattern = "[=SPE=]idVGB_CURR > 0";
			$scope.ABsearchAlias('vgb_curr','','','vgb_curr','VGB_CURR_CURID ASC','$scope.getSalesRep();')
		}
		else
		{
			$scope.getSalesRep();
		}
	}
	
	$scope.getSalesRep = function()
	{
		if (!$scope["vgb_slrp"] )
		{
			var pattern = "[=SPE=]idVGB_SLRP > 0";
			$scope.ABsearchAlias('vgb_slrp','','','vgb_slrp','VGB_SLRP_SLSRP ASC','$scope.getTerms();')
		}
		else
		{
			$scope.getTerms();
		}
	}

	$scope.getTerms = function()
	{
		if (!$scope["vgb_term"] )
		{
			var pattern = "[=SPE=]idVGB_TERM > 0";
			$scope.ABsearchAlias('vgb_term','','','vgb_term','VGB_TERM_TERID ASC','$scope.initSupportSVIA();')
		}
		else
		{
			$scope.initSupportSVIA();
		}
	}
		
	$scope.setOrderDocuments = function()
	{
 		$scope["vsl_orsi"] = new Array();
 		
 		var orsiList=""; // NO doubles "[idVSL_ORST,idVSL_ORSI]"
 		var tmpKey = "";
		
		var occ = 0;
		while (occ < $scope.vsl_orhe.length)
		{
			if ($scope.vsl_orhe[occ].idVSL_ORST > 0)
			{
				if ($scope.vsl_orhe[occ].idVSL_ORSI < 1)
				{
					$scope.vsl_orhe[occ].idVSL_ORSI = 0;
				}
				
				if (orsiList.indexOf("["+$scope.vsl_orhe[occ].idVSL_ORST+","+$scope.vsl_orhe[occ].idVSL_ORSI +"]") == -1 )
				{
					// $scope.vsl_orsi[$scope.vsl_orsi.length] = $scope.vsl_orhe[occ];
					 
					tmpKey = $scope.vsl_orhe[occ].VSL_ORST_STEPS;
					tmpKey += String(1000000 + $scope.vsl_orhe[occ].VSL_ORDE_ORLIN ) + "-" ;
					tmpKey += String(1000000 + $scope.vsl_orhe[occ].VSL_ORST_STPSQ );
					
					orsiList += tmpKey + "[" + $scope.vsl_orhe[occ].idVSL_ORST + "," + $scope.vsl_orhe[occ].idVSL_ORSI + "][" + occ + "\t";
				}
			}
			occ += 1;
		}
		
		var oTemp = orsiList.split("\t");
		oTemp.sort()
		var wocc = 0;
		var occ = 0;
		while (occ < oTemp.length)
		{
			if (oTemp[occ].indexOf("][") > -1)
			{
				wocc = oTemp[occ].slice(oTemp[occ].indexOf("][")+2);
				$scope.vsl_orsi[$scope.vsl_orsi.length] = $scope.vsl_orhe[wocc];
			}
			
			occ += 1;
		}
		
		
		dDta.alain = orsiList; //$scope["vsl_orsi"]
		
	}


	
	$scope.initAddress = function(bparId)
	{
		// $scope.VGB_ADDR_BPART = $scope.idVGB_BPAR; //$scope.VSL_ORHE_BTCUS;
		$scope.VGB_ADDR_BPART = bparId; 
		
		$scope.idVGB_ADDR='';
		A_Scope.callBack = "$scope.initvin_cust();"
		$scope.ABlstAlias('VGB_ADDR_BPART','VGB_ADDR_BPART','vgb_addr','vgb_addr');
	}

	$scope.initvin_cust = function()
	{
		$scope.VIN_CUST_BPART = $scope.VSL_ORHE_BTCUS;
		$scope.idVIN_CUST='';
		A_Scope.callBack = "$scope.getUsers();"
		$scope.ABlstAlias('VIN_CUST_BPART','VIN_CUST_BPART','vin_cust','vin_cust'); 
	
	}


	$scope.getOrderTax = function()
	{	
		var obj = new Object();
		$scope.ABlstAlias("idVSL_ORHE","idVSL_ORHE","vsl_orheTax","vsl_orheTax"); // To be support

		
	}
	
	$scope.initSupport = function()
	{
		var obj = new Object();
		obj["idVGB_CURR"] = $scope.VSL_ORHE_CURID;
		A_Scope.callBack = "$scope.initSupportTERMS();"
		$scope.ABchk(obj,"vgb_curr");
	}

	$scope.initSupportTERMS = function()
	{
		var obj = new Object();
		obj["idVGB_TERM"] = $scope.VSL_ORHE_TERID;
		A_Scope.callBack = "$scope.initSupportSLRP();"
		$scope.ABchk(obj,"vgb_term");
	}
	
	$scope.initSupportSLRP = function()
	{

		var obj = new Object();
		obj["idVGB_SLRP"] = $scope.VSL_ORHE_SLSRP;
		A_Scope.callBack = "$scope.initSupportSVIA();"
		$scope.ABchk(obj,"vgb_slrp")

	}	

	$scope.initSupportSVIA = function()
	{
		var mainTbl = "vgb_svia";
		var suppTbls = "vgb_supp:idVGB_SUPP = VGB_SVIA_SUPPID ";
		suppTbls += ",vin_supp:VIN_SUPP_BPART = VGB_SVIA_SUPPID ";
		suppTbls += ",vin_item:idVIN_ITEM = VIN_SUPP_ITMID ";
		var alias = "vgb_cust_svia";
		var pattern = "[=SPE=] VGB_SVIA_CUSTID = " + $scope.VSL_ORHE_BTCUS + "  OR VGB_SVIA_CUSTID = 0 ";
		var orderBy = "VGB_SUPP_BPNAM";
		var objFunctions = "";
		var objGroupBy = "";
		
		$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"$scope.setNewOrheSVIA();",objFunctions,objGroupBy);
	}
	
	$scope.checkItemSupplier = function(suppId,vslSuppId,vslItemId)
	{
		try{
		
		if (suppId === undefined || suppId == '')
		{
			suppId = vslSuppId;
			return suppId;
		}
		
		var occ = 0;
		while (occ < $scope.vgb_cust_svia.length)
		{
			if ($scope.vgb_cust_svia[occ]["VIN_SUPP_BPART"] == suppId && $scope.vgb_cust_svia[occ]["VIN_SUPP_ITMID"] == vslItemId)
			{
				$scope.vin_supp[$scope.vin_supp.length] = $scope.vgb_cust_svia[occ];
				
				occ = $scope.vgb_cust_svia.length;
				
			}
			occ += 1;
		}
		
		}
		catch(er){alert(er)}
		
		return suppId;
	}
	
	$scope.setNewOrheSVIA = function()
	{
		try
		{
			if ($scope.idVSL_ORHE==0)
			{
				var occ = 0
				while (occ < $scope.vgb_cust_svia.length && $scope.VSL_ORHE_SHIPID == null)
				{ 
					if ($scope.vgb_cust_svia[occ]["VGB_SVIA_DEFAULT"] == "1")
					{
						$scope.VSL_ORHE_SHIPID = $scope.vgb_cust_svia[occ]["idVGB_SVIA"];
						$scope.VSL_ORHE_ORVIA = $scope.vgb_cust_svia[occ]["VGB_SVIA_VIATXT"];
					}
					occ += 1;
				}
			}
		}
		catch(er){alert(er)}
	}

	$scope.setSelectOrheSVIA = function(SVIAid)
	{
		try
		{
			
			var occ = 0;
			if (SVIAid==0)
			{
				$scope.VSL_ORHE_SHIPID = null;
				$scope.VSL_ORHE_ORVIA = "";
				occ = $scope.vgb_cust_svia.length;
			}
			else
			{
				$scope.VSL_ORHE_SHIPID = SVIAid;
			}
				
			
			while (occ < $scope.vgb_cust_svia.length)
			{ 
				if ($scope.vgb_cust_svia[occ]["idVGB_SVIA"] == SVIAid)
				{
					$scope.VSL_ORHE_SHIPID = $scope.vgb_cust_svia[occ]["idVGB_SVIA"];
					$scope.VSL_ORHE_ORVIA = $scope.vgb_cust_svia[occ]["VGB_SVIA_VIATXT"];
				}
				occ += 1;
			}
		}
		catch(er){}
	}
	
	$scope.lotHasQty = function (idLSHE,dtaORST,soldOut)
	{
		
		var obj = $scope["vin_inve"];
		var objQ = 0;
		
try
{				
		var occ = 0;
		while (occ < obj.length &&  objQ == 0)
		{
			if (obj[occ]["VIN_LSLQ_LOTSQ"] == idLSHE)
			{
				if (obj[occ]["VIN_LSLQ_BOHQT"]*1 > 0 && soldOut == "0")
				{
					objQ += (obj[occ]["VIN_LSLQ_BOHQT"]*1)
				}
			
			}
				
			occ += 1
		}
		

		var obj = $scope["rawResult"]["vsl_orheLSTR"];
		var occ = 0;
		while (occ < obj.length &&  objQ == 0)
		{
			
			if (obj[occ]["VSL_LSTR_ORNUM"] == dtaORST["VSL_ORST_ORNUM"]  
			&& obj[occ]["VSL_LSTR_ORLIN"] == dtaORST["VSL_ORST_ORLIN"] 
			&& obj[occ]["VSL_LSTR_STPSQ"]  == dtaORST["idVSL_ORST"]
			&& obj[occ]["VSL_LSTR_LOTSQ"]  == idLSHE )
			{
				 objQ += 1;
			}
				
			occ += 1
		}
}catch(er){}
		
		return objQ;
	}
	
	$scope.serviceSupplier = function(itemId)
	{
		// not used this read is performed during the master Read VSL_ORHEXXX
		$scope.idVIN_SUPP = 0
		$scope.vin_supp_items = itemId;
		$scope.ABlstAlias('idVIN_SUPP','idVIN_SUPP,vin_supp_items','vin_supp','vin_supp');  
		
		
	}
	
	
	$scope.VIN_ITEMsearch = function(x,abSessionResponse)
	{
		
x.VIN_ITEM_ITMID = abSessionResponse.VIN_ITEM_ITMID;
x.VSL_ORDE_ITMID = abSessionResponse.idVIN_ITEM;
x.VSL_ORDE_DESCR = abSessionResponse.VIN_ITEM_DESC1;
x.VSL_ORDE_ITEXT = abSessionResponse.VIN_ITEM_DESC2 + ' ' + abSessionResponse.VIN_ITEM_DESC3;

x.VSL_ORDE_OUNET = abSessionResponse.VIN_ITEM_LISTP;
x.VSL_ORDE_SAUOM = abSessionResponse.VIN_ITEM_UNITM;
x.VSL_ORDE_QTUOM = abSessionResponse.VIN_ITEM_UNITM;
x.VSL_ORDE_LISTP = abSessionResponse.VIN_ITEM_LISTP;

x.VSL_ORDE_WARID = ''; //abSessionResponse.VIN_ITEM_WARID;
x.VSL_ORDE_LOTCT = abSessionResponse.VIN_ITEM_LOTCT;
x.VSL_ORDE_OLTYP = (abSessionResponse.VIN_ITEM_INVIT>0?'STD':'EXP');
x.VIN_ITEM_INVIT = abSessionResponse.VIN_ITEM_INVIT;
$scope.VIN_INVE_ITMID = x.VIN_ITEM_ITMID;

// return x;
		
	}
	
	$scope.AAVSL_ORHECT_BEGIN = function(){}
	
	$scope.vsl_orheTestXXX = function()
	{

		setTimeout(function()
		{
			$scope.setOrheFormInvisible();
			if($scope.opts.updType == "CREATE") 
			{
				$scope.resetOrheForm(1200);
			}
			else
			{
				$scope.resetOrheForm(12000);
			}
			A_Scope.callBack="$scope.resetOrheForm(100);$scope.setupSpecSheets();$scope.countPending();$scope.getUsers();"		
	
			var tmpObj = new Object();
			tmpObj["idVSL_ORHE"] = $scope.opts.idVSL_ORHE;
			// A_Scope.callBack = "$scope.countPending();"
			$scope.ABchk(tmpObj,"vsl_orheXXX");
		},100);

	}
	
	if (!$scope.opts.updType)
	{
		if (!$scope.inPicking && !$scope.inPacking)
		{
			$scope.VSL_ORHE_ORNUM = "";
			$scope.initSpace()
		}
	}
	else
	{
		$scope.vsl_orheTestXXX();

//		$scope.setOrheFormInvisible();
//		$scope.resetOrheForm(12000);
//		$scope.initOrder();
	}
	$scope["idVSL_ORHE"] = 0;
	
	// $scope.ABlstAlias('idVSL_ORHE','idVSL_ORHE',"vsl_userVariance","vsl_varie")
		
	$scope.selectCurrentForm = function(val,grpId,docId)
	{
		
		if (!val)
		{
			$scope.formSel = "Current document(s)";
			$scope.formSelName = '';
			$scope.formSelField = '';
			$scope.formSelDocId = 0;
			$scope.formSelGrpId = 0;
			
		}
		else
		{
			
			$scope.formSel = val.labeltext + " #-" + grpId;
			$scope.formSelName = val.name;
			$scope.formSelField = val.field;
			
			$scope.formSelDocId = docId;
			$scope.formSelGrpId = grpId;
			// $scope.tmpexe = "example_" + $scope.formSelName.slice($scope.formSelName.indexOf("_") + 1) + ".php" ;
			$scope.tmpexe = $scope["AB_CPARM"]["VSL_STEPS"][$scope.formSelName] + ".php";
			$scope.selexe= $scope.tmpexe
			$("#doccset").click();
			

		}
		
		// $scope.DOC_STEPS = $scope.formSelName
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
		
		
		// old version
//		if($scope.formSelName && $scope.formSelName !="")
//		{ 
//			if (!rSet[$scope.formSelField] ||$scope.formSelDocId != rSet[$scope.formSelField])
//			{
//				// alert($scope.formSel + "\n" + rSet[$scope.formSelField] + " - " + $scope.formSelField);
//				return false;
//			}
//		}
//		
//		return true;
	}
	
	
	$scope.initAllocDashBoard = function(val,txt)
	{
		if (!val)
		{
			$scope.stpSel = "Select New Document";
			$scope.stpSelName = '';
			$scope.stepRetract = false;
		}
		else
		{
			
			$scope.stpSel = txt ;
			$scope.stpSelName = val;
		}
		$scope.DOC_STEPS = $scope.stpSelName
	}
	
	$scope.toggleAllocStepSel = function(stepId)
	{
		if (!$scope.DOC_ORST)
		{
			$scope.DOC_ORST = "";
		}
		var tmp = "," + $scope.DOC_ORST + ",";
		var fstr = "," + stepId + ",";
		
	try
	{
		
		if (tmp.indexOf(fstr) > -1)
		{
			tmp = tmp.slice(0,tmp.indexOf(fstr)) + tmp.slice( tmp.indexOf(fstr) + fstr.length - 1);
		}
		else
		{
			tmp = tmp + fstr;
		}
		
		while (tmp.indexOf(",,") > -1)
		{
			tmp = tmp.slice(0,tmp.indexOf(",,")) + tmp.slice(tmp.indexOf(",,")+1);
		}
		if (tmp.indexOf(",") == 0)
		{
			tmp = tmp.slice(1);
		}
		if (tmp.lastIndexOf(",") == tmp.length-1)
		{
			tmp = tmp.slice(0,tmp.length-1);
		}
		$scope.DOC_ORST = tmp;

	}
	catch(er)
	{
		alert(tmp + "\n" + er)
	}		
		
	}
	
	$scope.copyOrg = function()
	{
		setTimeout("A_Scope.initModels();",100)
		$scope.accum();
		
	}
	$scope.accum = function()
	{
		$scope.ABSetNgAccum('#accumY','[ORDE-repeat]','x.VSL_ORDE_ORDQT','y.VSL_ORST_ORDQT');
	}
	
	
	$scope.newRecord = new Array();


	
