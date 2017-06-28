
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
	
	
	
	$scope.ACVarFilterInit = function(colName,colVal)
	{
		// colVal = $scope["list"+colName];
		
		var occ = 0;
	
		while (occ < $scope["rawResult"]["vin_cust"].length)
		{	
			if ( !$scope["rawResult"]["vin_cust"][occ]["rowRowLog"] || !colName)
			{
				$scope["rawResult"]["vin_cust"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vin_cust"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vin_cust"][occ]["rowRowLog"]["hidden"] = "  ";
				  
			}			

			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
				
				
			}
			
			$scope["rawResult"]["vin_cust"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vin_cust"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vin_cust"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vin_cust"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			for (var i in dta)
			{
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vin_cust"][occ][i]) + "'")<0)
				{
					$scope["rawResult"]["vin_cust"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vin_cust"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
		