<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vpu_orhe"] = "dbMain";

	$scope.initStepList = function()
	{

		$scope["VPU_STEP_LIST"] = new Array();
	
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();						                                             
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "DD_ACKN";                                             
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "";                                             
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_ACKID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_DD_ACKN";                         
	 	$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Quote"; 
	        
	                                                   
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();                                           
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "DE_AOKN";                                   
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "";                                   
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_AOKID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_DE_AOKN";                         
	        $scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Accept-Quote"; 
	                                                                                                                                
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();                                           
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "EE_SCED";                                   
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "";                                   
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_SCEID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_EE_SCED";  
	        $scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Scedule";  	                                           
	                                                                   
	                                                                                                                                                                     
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "FF_PICK";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "VPU_PICK_OF";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_PICID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_FF_PICK";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Purchase-Order";  
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "GG_RELE";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_RELID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_GG_RELE";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Receive Goods";     
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "HH_PACK";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "VPU_PACK_OF";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_PAKID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_HH_PACK";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Receipt List";           
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "II_DELI";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "light";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["field"] = "VPU_ORST_DELID";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_II_DELI";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Quality control";        
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "JJ_INVO";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_JJ_INVO";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Received Goods";     
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "KK_PURG";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_KK_PURG";
	        $scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Inv. Match";            
	
	
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length]=new Object();
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["name"]= "QQ_PURG";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["shade"] = "hidden";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["form"] = "";
		$scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["label"]= "LF_STEPS_QQ_PURG";
	        $scope["VPU_STEP_LIST"][$scope["VPU_STEP_LIST"].length-1]["labeltext"]= "Completed";         

		dDta["VPU_STEP_LIST"] =   $scope["VPU_STEP_LIST"];
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

A_LocalAgularFn.prototype.VPU_VARIANCES = function($scope,$http,$routeParams) 
{

	$scope.ACVarFilterInit = function(colName,colVal)
	{
		// colVal = $scope["list"+colName];
		
		var occ = 0;
		while (occ < $scope["rawResult"]["vpu_varie"].length)
		{	
			if ( !$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["hidden"] = "  ";
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
			}
			
			$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vpu_varie"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vpu_varie"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vpu_varie"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
	
}	

// Begin

A_LocalAgularFn.prototype.VPU_RECEIPT = function($scope,$http,$routeParams) 
{

	$scope.pickCheck = 1;
	$scope.orderSelected = 0;
	$scope.idVPU_ORHE = 0;
	$scope.VPU_ORHE_ORNUM = "";
	A_LocalAgular["VPU_ORHECT"]($scope,$http,$routeParams);


	$scope.initPackOrder = function(idOrd,idPic)
	{
		
		$scope.pickCheck = 1;

		A_Scope.callBack="$scope.setupSpecSheets();$scope.countPending();$scope.setOrhePack("+idPic+");"		
		// A_Scope.callBack="$scope.setOrhePack("+idPic+");"		
	
		var tmpObj = new Object();
		tmpObj["idVPU_ORHE"] = idOrd;
		// A_Scope.callBack = "$scope.countPending();"
		$scope.ABchk(tmpObj,"vpu_orheXXX");
				
//		$scope.ABinitTbl("vpu_orhe","idVPU_ORHE")
//		$scope.ABupdChkObj("idVPU_ORHE",idOrd,true);
//		
//		A_Scope.callBack = "$scope.setOrhePack("+idPic+");"
//		$scope.ABchk();
		$scope.DOC_ORST = "";
		$scope.allPicksSelected = false;
		
	}	
	
	$scope.countCheckBox = function(objAttr)
	{
		var vVal = 1
		var debug = "N/a"
		var cbChck = new Object();
		var cbName = "";
		var chkBox = 0
		$scope.hasPicksBo = false;
		
		if (objAttr.toUpperCase()=="RESET")
		{
			$("[id^='VPU_ORST_BACKORMESS']").addClass("hidden");
			$("[xlinesel]").each(function()
			{
				debug += $(this).prop("checked");
				
				$(this).prop("checked") = false;
			});
			alert(debug)
			$("#focusGrid").val(debug)
			return;
		}
			
			
		$("[ordline]").each(function()
		{
			cbName = $(this).attr("ordline"); 
			
			var tmpChck = new Array();
			tmpChck[0] = "";
			tmpChck[1] = "";
			
			$("[xlinesel^='" + cbName + "']").each(function()
			{
				if ($(this).prop("checked"))
				{
					tmpChck[$(this).attr("cert")] += "1";
					
					
				}
				else
				{
					tmpChck[$(this).attr("cert")] += "0";
				}
				
			});
			
			if (tmpChck[0].indexOf("1") == -1)
			{
				cbChck[cbName] = 0;
				$scope.hasPicksBo = true;
			}
			else
			{
				if (tmpChck[0].indexOf("0") > -1)
				{
					$scope.hasPicksBo = true;
				}

				if (tmpChck[1] == "" || tmpChck[1].indexOf("0") == -1)
				{
					cbChck[cbName] = 1;
					if (chkBox == 0)
					{
						chkBox = 1;
					}	
				}
				else
				{
					cbChck[cbName] = 2;
					chkBox = 2;
				}
				
			}	
			
		});
		debug = showProps(cbChck,'ck');
		dDta["orderLine"] = cbChck;
		$("#focusGrid").val(debug + "\n====" + chkBox)
		if (chkBox != 1)
		{
			$scope.allPicksSelected = false;
		}
		else
		{
			$scope.allPicksSelected = true;
		}

		setTimeout(function()
		{

			$("[ordline]").each(function()
			{
	
				var boQt = $(this).find("[id^='VPU_ORST_BACKORDQT']").val() * 1;
				if ($(this).find("[xlinesel]").prop("checked") )
				{		
						
					if ( boQt == 0)
					{
						$(this).find("[id^='VPU_ORST_BACKORMESS']").addClass("hidden");
					}
				}						
				else
				{
					$(this).find("[id^='VPU_ORST_BACKORMESS']").removeClass("hidden");
				}
			});
		
		},100);
		
	}


	
	$scope.setOrhePack = function(pickId)
	{
		$scope["tmpORHE"] = new Array();
		var occ = 0;
		
		while (occ < $scope["vpu_orhe"].length)
		{
			if ($scope["vpu_orhe"][occ]["VPU_ORST_PAKID"] == pickId)
			{
				$scope["tmpORHE"][$scope["tmpORHE"].length] = $scope["vpu_orhe"][occ];
			}
			occ += 1;
		}
		
		dDta["tmpORHE"] = $scope["tmpORHE"];
		$scope["vpu_orhe"] = $scope["tmpORHE"];
		
		
		$scope.pickCheck = 0;
		$scope.orderSelected = pickId;
		
		
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
		while (occ < $scope["rawResult"]["vpu_pack"].length)
		{	
			if ( !$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["hidden"] = "  ";
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
			}
			
			$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vpu_pack"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vpu_pack"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vpu_pack"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
	
}	



// END






A_LocalAgularFn.prototype.VPU_ORHECT = function($scope,$http,$routeParams) 
{

	<?php require_once "../appCscript/VPU_ORDERS_VPU_ORHECT.php"; ?>
	
}



A_LocalAgularFn.prototype.VPU_INVOCT = function($scope,$http,$routeParams) 
{
	
	$scope.getVPU_DELIVERY = function()
	{
		var tmpObj = new Object();
		tmpObj["idVPU_ORHE"] = 0;
		A_Scope.callBack = "$scope.computeGroupTotal();";
		$scope.ABchk(tmpObj,"vpu_invoice");
	}
	
	$scope.computeGroupTotal = function()
	{
		var total = new Object();
		var occ = 0;
		while (occ < $scope.rawResult.vpu_invoice.length)
		{
			if ($scope.rawResult.vpu_invoice[occ].VPU_ORDE_OLTYP == "STD")
			{
				receiptID = $scope.rawResult.vpu_invoice[occ].VPU_ORST_DELID;
				if (!total[receiptID])
				{
					total[receiptID] = 0;
				}
				total[receiptID] += ($scope.rawResult.vpu_invoice[occ].EXTENSION*1);
			}
			occ += 1;
		}
		var occ = 0;
		while (occ < $scope.rawResult.vpu_invoice.length)
		{
			if ($scope.rawResult.vpu_invoice[occ].VPU_ORDE_OLTYP == "STD")
			{
				receiptID = $scope.rawResult.vpu_invoice[occ].VPU_ORST_DELID;
				$scope.rawResult.vpu_invoice[occ].grTotal = total[receiptID];
				$scope.rawResult.vpu_invoice[occ].percent = ((($scope.rawResult.vpu_invoice[occ].EXTENSION*1)/(total[receiptID]*1)).toFixed(2))*100;
			}
			occ += 1;
		}
		
	}
	
	$scope.vpu_invoctInsertItem = function(delId)
	{
		if (!$scope.provCost)
		{
			$scope.provCost = new Array();
		}
		if ( $scope.abSessionResponse.VIN_ITEM_INVIT != 0)
		{
			A_Scope.ABDisplayMessage("<span class='text-danger'>Must be a service item</span>");
			return;
		}
		var recFound = false;
		var occ = 0;
		while (occ < $scope.provCost.length && recFound == false )
		{
			if ($scope.provCost[occ].idVIN_ITEM == $scope.abSessionResponse.idVIN_ITEM && $scope.provCost[occ].delId == delId)
			{
				recFound = true;
				A_Scope.ABDisplayMessage("<span class='text-danger'>Item already in costing for this invoice</span>");
			}
			occ += 1;
		}
		if (recFound == false)
		{
			var nRec = $scope.provCost.length;
			$scope.provCost[nRec] = new Object();
			$scope.provCost[nRec].idVIN_ITEM = $scope.abSessionResponse.idVIN_ITEM;
			$scope.provCost[nRec].VIN_ITEM_ITMID = $scope.abSessionResponse.VIN_ITEM_ITMID;
			$scope.provCost[nRec].VIN_ITEM_DESC1 = $scope.abSessionResponse.VIN_ITEM_DESC1;
			$scope.provCost[nRec].delId = delId;
			$scope.provCost[nRec].amount = 0;
			A_Scope.ABDisplayMessage("");
		}
				
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
	
A_LocalAgularFn.prototype.VPU_ORDERS = function($scope,$http,$routeParams)
{
	
	$scope.vpu_orheHasStepsCurrent = 1;
	

	// I included this below to comply with your current HTML. But you must modify VIN_ITEMS to directly call ABlstAlias in $inTrig kPress statements
	// You must rewrite the function to specify "vin_item"  in reference to ng-repeat="x in vin_item"
	// Will give same resuls and will comply to naming convention.
	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		
		$scope.ABlstAlias(ce,obj,tbl,"vpu_orhe")
	}
	
	$scope.VPU_ORHE_ORNUM = ""
	$scope.kPress('VPU_ORHE_ORNUM','VPU_ORHE_ORNUM,vpu_orheHasStepsCurrent','vpu_orhe',0)
	
	
	
}
	




</script>



