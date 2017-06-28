<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}
	
A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{
    
	 
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}	

A_LocalAgularFn.prototype.VAR_OITEMCT = function($scope,$http,$routeParams)
{
	$scope["idVAR_OIHE"] = 0;
	$scope.initVAR_OIHE = function()
	{
		var chkObj = new Object();
		chkObj["idVAR_OIHE"] = "0";
		$scope.ABchk(chkObj,'var_oihe');
		$scope["curBank"] = new Object();
		
		$("[ng-model='ORHE_HISTORY_CUST']").focus();
	}
	
	$scope.initNewCustomer = function()
	{

		$scope.initCust($scope.abSessionResponse.VGB_CUST_BPART);

	}	
	
	$scope.initCust = function(bparId)
	{
		var chkObj = new Object();
		chkObj["idVGB_BPAR"] = bparId;
		// A_Scope.callBack = "$scope.initOrheData();";
		A_Scope.callBack = "$scope.initOrheData(data);$scope.setVarForm(-1);";
		$scope.ABchk(chkObj,'var_items');
		$scope.VAR_DISTRIBUTE=0;
		$scope.VAR_DISTRIBUTE_CK=false;
		
	}

	$scope.isDistribute = function()
	{
		var ret = false;
		if ( $scope.varFormPg==1  && $scope.VAR_DISTRIBUTE==true)
		{
			ret = true;
		}
		return ret;
	}
	
	$scope.initOrheData = function(oDta)
	{
		
		$scope["VGB_BPAR_BPART"] = $scope["var_items"][0]["VGB_BPAR_BPART"];
		$scope["VAR_OIHE_BCUST"] = $scope["var_items"][0]["idVGB_CUST"];
		$scope["VAR_OIHE_BTADD"] = $scope["var_items"][0]["VGB_CUST_BTADD"];
		$scope["VAR_OIHE_TERID"] = $scope["var_items"][0]["VGB_CUST_TERID"];
		$scope["VAR_OIHE_NETDA"] = $scope["var_items"][0]["VGB_TERM_NETDA"];
		$scope["VAR_OIHE_DISDA"] = $scope["var_items"][0]["VGB_TERM_DISDA"];
		$scope["VAR_OIHE_DISCN"] = $scope["var_items"][0]["VGB_TERM_DISCN"];
		$scope["VAR_OIHE_CURID"] = $scope["var_items"][0]["VGB_CUST_CURID"];
		$scope["VAR_OIHE_CURAT"] = $scope["var_items"][0]["VGB_CURR_CURAT"];
		$scope["VAR_OIHE_OITTY"] = "";
		$scope["VAR_OIHE_DOCDA"] = "";
		$scope["VAR_OIHE_BPBNK"] = "";
		$scope["VAR_OIHE_AMUNT"] = "";
		$scope["VAR_OIHE_PMTDA"] = "";
		$scope["VAR_OIHE_CONNU"] = "";
		$scope["VAR_OIHE_REFER"] = "";
		$scope["VAR_DISTRIBUTEÈ"] = false;
		
		$("#VAR_OIHE_BPBNKmain").html("");
		
		$scope["idVAR_OIHE"] = "";
		$("#ab-update").addClass("hidden");
		$("#ab-delete").addClass("hidden");
		$("#ab-create").removeClass("hidden");

		setDbErr($scope,oDta['posts']);
		A_Scope.setUpdTbl($scope,"var_oihe","dbMain",oDta['posts']);

		
	}


	
	$scope.setVarForm =function(formNum)
	{

		
		$scope["VAR_FACTOR"] = 0;
		var formNew = formNum;
		var debug = formNew + $scope["VAR_OIHE_OITTY"];
		switch (formNum)
		{
			case 0:
			if ($scope["VAR_OIHE_OITTY"]!="INV")
			{
				$scope["VAR_OIHE_OITTY"] = "INV";
				$scope["VAR_FACTOR"] = 1;
			}
			else
			{
				$scope["VAR_OIHE_OITTY"] = "";
				formNew = -1;
			}
			break;
			case 1:
			if ($scope["VAR_OIHE_OITTY"]!="PMT")
			{
				$scope["VAR_OIHE_OITTY"] = "PMT";
				$scope["VAR_FACTOR"] = -1;
			}
			else
			{
				$scope["VAR_OIHE_OITTY"] = "";
				formNew = -1;
			}
			break;	
			case 2:
			if ($scope["VAR_OIHE_OITTY"]!="CRN")
			{
				$scope["VAR_OIHE_OITTY"] = "CRN";
				$scope["VAR_FACTOR"] = -1;
			}
			else
			{
				$scope["VAR_OIHE_OITTY"] = "";
				formNew = -1;
			}
			break;
			case 3:
			if ($scope["VAR_OIHE_OITTY"]!="ADJ")
			{
				$scope["VAR_OIHE_OITTY"] = "ADJ";
				$scope["VAR_OIHE_AMUNT"] = 0;
				
			}
			else
			{
				$scope["VAR_OIHE_OITTY"] = "";
				formNew = -1;
			}				
		}	
		
		debug += "\n" + formNew + $scope["VAR_OIHE_OITTY"];
		
		$scope["ADJBALANCE"] = 0;
		if (formNew >-1)
		{
			$scope.updateOn = 1;
			if (formNew==3)
			{
			        $('#ab-create').addClass("hidden");
			        $('#ab-update').removeClass("hidden");			
				$scope.updateOn = 2;
				$scope.accumAdjust()
			}
			else
			{
			        $('#ab-create').removeClass("hidden");
			        $('#ab-update').addClass("hidden");			
			}
			
			if ($scope["VAR_OIHE_DOCDA"]=="")
			{
				$scope["VAR_OIHE_DOCDA"] = $scope.ABGetDateFn('get-year','')+$scope.ABGetDateFn('get-month','')+$scope.ABGetDateFn('get-day','');
				
			}
			
		}
		else
		{
			$scope.updateOn = 0;
		}
		
		$scope.varFormPg = formNew
		
	}
	
	$scope.setBankInfo = function(fValue)
	{
		$scope["VAR_OIHE_BNKID"] = fValue["idVGL_BANK"];
		$scope["VGL_BANK_PMTTY"] = fValue["VGL_BANK_PMTTY"];
		$scope["VGL_BANK_TYDET"] = fValue["VGL_BANK_TYDET"];
		
		$scope["curBank"] = fValue;
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
			var occ = 0;
			while (occ < $scope["rawResult"]["vgb_bpar"].length && $scope[fieldName] == "")
			{
				if (fieldName.indexOf("_CUST") >-1  && $scope["rawResult"]["vgb_bpar"][occ]["idVGB_CUST"] > 0)
				{
					$scope[fieldName] = $scope["rawResult"]["vgb_bpar"][occ][tblField];
				  	$scope["idVGB_BPAR"] = $scope["rawResult"]["vgb_bpar"][occ]["idVGB_BPAR"];
				  	$scope.initCust($scope["idVGB_BPAR"]);
				  	
				}
				

				
				occ += 1;
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

	$scope.accumAdjust = function()
	{
		var debug = "";
		var wtpBal = 0;
		var workNum = new Array();
		
		$scope["ADJBALANCE"] = 0;
		$("[ng-model='OIT.ADJAMOUT']").each(function()
		{
			if (isNaN($(this).val()))
			{
				$(this).val(0)
			}
			
			if ($(this).attr("trtype")!="INV")
			{
				$(this).val(Math.abs(Number($(this).val()))*-1);
			}
			else
			{
				$(this).val(Math.abs(Number($(this).val())));
			}
			
			if (Math.abs($(this).attr("trbal"))<Math.abs($(this).val()))
			{
				$(this).val(Number($(this).attr("trbal")))
			}
			
			
			// $scope["ADJBALANCE"] += Number($(this).val())
			
			var wNum = Number($(this).val()).toFixed(2);
			
			wtpBal  += wNum;
			workNum[workNum.length] = Number(wNum).toFixed(2);
			$(this).val($scope.ABGetNumberFn("fmt-curr",$(this).val()))
			
		});
		
		var occ = 0
		var newTotal = 0
		while (occ < workNum.length)
		{
			
			if (workNum[occ] < 0)
			{
				debug +=   "-[" + Math.abs(workNum[occ]) + "]="
				newTotal = Number(newTotal) - Math.abs(workNum[occ]);
				debug += newTotal 
			}
			else
			{
				debug +=   "+[" + Math.abs(workNum[occ]) + "]="
				newTotal = Number(newTotal) + Math.abs(workNum[occ]);
				debug += newTotal 
			}
			
			debug += "\n";
			newTotal = Number(newTotal).toFixed(2);
				
			occ += 1;
		}
		
		debug += "is equal to " + newTotal + "\n==" + wtpBal + "=="
		// $scope["ADJBALANCE"] = $scope.ABGetNumberFn("fmt-curr",$scope["ADJBALANCE"]);
		$scope["ADJBALANCE"] = $scope.ABGetNumberFn("fmt-curr",newTotal);
		debug += "==" + $scope["ADJBALANCE"] + "=="
		if ($scope.isDistribute()==true)
		{
			$scope.VAR_OIHE_AMUNT = $scope["ADJBALANCE"];
		}
		
		$("#focusGrid").val(debug)
	}
	
	$scope.accumAdjustDelay = function()
	{
	
		setTimeout(function()
		{
			
			$("[ng-model='ADJBALANCE']").click()
			
			
		},10);
	}
	
	$scope.validEntry = function()
	{
		if ($scope.varFormPg==1 && $scope.isDistribute()==false)
		{
			$scope["ADJBALANCE"] = 0;
		}

		if ($scope["ADJBALANCE"] != 0  && $scope.varFormPg!=1)
		{
			
			return false;
		}
		if ($scope.varFormPg!=3 && $scope["VAR_OIHE_AMUNT"] == 0)
		{
			
			return false;
		}
		
		if ($scope.varFormPg==1 && $scope["VAR_OIHE_BNKID"] < 1)
		{
			
			return false;
		}
		if ($scope.varFormPg==1 && $scope["VAR_OIHE_AMUNT"] < 0)
		{
			
			return false;
		}
				
		if ($scope.varFormPg==1 && ($scope["curBank"]["VGL_BANK_CTRLV"]=='1' || $scope["curBank"]["VGL_BANK_CHECK"] =='1') )
		{
			
			if(!$scope["VAR_OIHE_CONNU"] || $scope["VAR_OIHE_CONNU"].trim() == "")
			{
				
				return false;
			}
			
			if(!$scope["VAR_OIHE_PMTDA"] || $scope["VAR_OIHE_PMTDA"].trim() == "")
			{
				
				return false;
			}
			
			if ($scope.ABGetDateFn('diff-today',$scope["VAR_OIHE_PMTDA"])>0 && $scope["postdatedchk"] != true)
			{
				
				return false;
			}
			if ($scope["VAR_OIHE_BPBNK"] > 0)
			{
			}
			else
			{
				
				return false;
			}
			
			
		}
		if ($scope.varFormPg!=3	)
		{
			return true;
		}
		
		var ret = false;
		$("[ng-model='OIT.ADJAMOUT']").each(function()
		{
			if ($(this).val() != 0)
			{
				ret = true
			}
		});
		
		return ret;
	}
	
	$scope.validateAmt = function()
	{
		if (isNaN($scope["VAR_OIHE_AMUNT"]))
		{
			$scope["VAR_OIHE_AMUNT"] = 0;
		}
		
		$scope["VAR_OIHE_AMUNT"] = Math.abs($scope["VAR_OIHE_AMUNT"]);
		$scope["VAR_OIHE_AMUNT"] = $scope.ABGetNumberFn("fmt-curr",$scope["VAR_OIHE_AMUNT"]);		
	}
		
	$scope.initVAR_OIHE()
	$scope.ABsearchTbl = "vgb_cust";
	
}

A_LocalAgularFn.prototype.VAR_OITEMAG = function($scope,$http,$routeParams)
{
	
	<?php require_once "../appCscript/VAR_FINANCE_AGED.php"; ?>
	
}

</script>



