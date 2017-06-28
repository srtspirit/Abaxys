<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{
	//alert(showProps($scope.opts,"opts"));
	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vin_item"] = "dbMain";
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}
A_LocalAgularFn.prototype.VIN_ITEMS = function($scope,$http,$routeParams) 
{
	$scope.ablabelVIN_ITEMCT = $("[ab-label='VIN_ITEMCT']").html()
	
	$('#ab-SesMenu').html("");

	if ($scope.utype)
	{
		$scope.tbData = $("[ab-main]").attr("ab-main",$scope.utype);
	}
		
	$scope.tbData = $("[ab-main]").attr("ab-main");
	
	if ($scope.opts.tblName)
	{
		$scope.tbData = $scope.opts.tblName;
	}
	else
	{
		$scope.opts.tblName = $scope.tbData;
		A_Scope.setProcess($scope);
	}
	A_Session.sessionSetCur($scope,$scope.tbData);
	
	getMaxPerPage(currentPerPage);

	if ($scope.tbData == "vin_item")
	{
		$scope.ce = "VIN_ITEM_ITMID"
		$scope.obj = "VIN_ITEM_ITMID"
		$scope.tbl = "vin_item"
		$scope.VIN_ITEM_ITMID = ""
	}
	$scope.currentKey = function(obj)
	{
		currentKey = obj
	}
	$scope.kPress = function(ce,obj,tbl,dir)
	{
		$scope.aliasName = "vin_item";
		A_Scope.dbList($scope,$http,ce,obj,tbl,dir,currentPerPage)
		
	}
	$scope.aliasName = "vin_item";
	if (!$scope.opts.VIN_ITEM_ITMID || $scope.opts.VIN_ITEM_ITMID == "null" )
	{
		$scope.VIN_ITEM_ITMID = '';
	}
	else
	{
	 	$scope.VIN_ITEM_ITMID = $scope.opts.VIN_ITEM_ITMID;
	}
 	A_Scope.callBack = "tblInfo($scope,$http);";
 	A_Scope.callBack += '$("[ng-model=' + "'VIN_ITEM_ITMID']" + '").focus();';
 	$scope.kPress($scope.ce,$scope.obj,$scope.tbl,0);
}

A_LocalAgularFn.prototype.VIN_ITEMCT = function($scope,$http,$routeParams)
{

		$('#ab-back').attr("href","#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item");
			$scope.errno = 0;
			$scope.error = "";
			$scope.utype = $scope.opts.updType;
			if (!$scope.opts.idVIN_ITEM)
			{
				A_LocalAgular.setOpts($scope,"idVIN_ITEM");

			}
			$scope.recPointer = $scope.opts.RECPOINTER;
			$scope.idVIN_ITEM = $scope.opts.idVIN_ITEM;
			$scope.VIN_ITEM_ITMID = $scope.opts.VIN_ITEM_ITMID;
			
			$scope.ce = "idVIN_ITEM"
			$scope.obj = "idVIN_ITEM"
			$scope.tbl = "vin_item"
			$scope.ab_upd = "vin_item"
			
			var availableTags = [];
			$("[ab-autocomplete]").autocomplete({source: availableTags});
			
			$scope.chkDta = function (val)
		 	{
		 		if (!val)
		 		{
		 			val = $scope.chkObj;
		 		}
		 		A_Scope.dbChk($scope,$http,val)
		 	}
		 	$scope.saveSuccess = function(dta)
			{
				$("#formSaveSuccess").css("color","white");
				setTimeout('$("#formSaveSuccess").css("color","transparent");',6000)

				if (dta.dbFnct == "dbDelRec" && dta.errorCode == 0 && dta.tblInfo.tblName == "vin_item")
				{
					$('#ab-back').click();
				}
				if ( (dta.dbFnct == "dbInsRec" || dta.dbFnct == "dbOrgShare") && dta.errorCode == 0 && dta.tblInfo.tblName == "vin_item")	
				{
					$('#ab-back').attr("href","#VIN_ITEMS/VIN_ITEMCT/idVIN_ITEM:" + $scope.idVIN_ITEM +",updType:UPDATE,Session:VIN_ITEMCT,Process:VIN_ITEMS")
					$('#ab-back').click();
					
				}	
				$("#controllerGrid").val(dta.dbFnct + " Err=" + dta.errorCode  + " Tbl= " + dta.tblInfo.tblName)
			}
			$scope.ABupd = function(opt)
		 	{
		 		if ($scope.idVIN_ITEM > 0)
		 		{
		 			A_Scope.callBack = 'if (data["posts"].errorCode==0){$scope.saveSuccess(data["posts"]);$scope.custInit();' + $("[ab-updSuccess]").val() + '}else{$scope.saveSuccess(data["posts"]);};';
			 		A_Scope.dbUpd($scope,$http,opt)
			 	}
				else
				{
					$scope.saveAll(opt)
				} 	
		 	} 
		 	$scope.saveAll = function(opt)
		 	{
		 		$("#mainForm").attr("ab-main","vin_item");
		 		A_Scope.callBack = '$("#mainForm").attr("ab-main","' + $("#mainForm").attr("ab-main") + '");';
		 		A_Scope.callBack += "if (data['posts'].errorCode==0){$scope.idVIN_ITEM = data['posts'].result[0].idVIN_ITEM;$('#VIN_ITEMrfs').click();}"
		 		A_Scope.dbUpd($scope,$http,opt);
			} 
			
			$scope.main = function()
		 	{
			 	A_Scope.dbList($scope,$http,'VIN_ITEM_ITMID','idVIN_ITEM','vin_item',0,1)
			}
			
			$scope.set_VIN_ITEMCT = function() {
				if ($scope.VIN_ITEMCT[0].idVIN_ITEM > 0)
				{
					//alert(2);	
				}			
			} 
			
			$scope.resetScope = function()
			{			
				$scope.ce = "idVIN_ITEM"
				$scope.obj = "idVIN_ITEM"
				$scope.tbl = "vin_item"
				$("#ab-back > img").attr("href","#VIN_ITEMS/VIN_ITEMS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item,VIN_ITEM_ITMID:"+$scope.VIN_ITEM_ITMID)
			}
			
			$scope.kPress = function(ce,obj,tbl,dir)
			{
				A_Scope.dbList($scope,$http,ce,obj,tbl,dir,currentPerPage)
			}  
			
			$scope.itemInit = function()
			{
				$scope.resetScope();
				$scope.vin_item = null;
			 	tObj = new Object();
			 	tObj['VIN_ITEM_ITMID'] = $scope.VIN_ITEM_ITMID;
			 	$scope.chkObj = tObj
	
				
				A_Scope.callBack = "";
				if ($scope.opts.VIN_ITEM_ITMID)
				{
					//alert(1);
					A_Scope.callBack += "$scope.VIN_ITEM_ITMID = $scope.opts.VIN_ITEM_ITMID;";
					A_Scope.callBack += "$scope.set_VIN_ITEMCT();";
				}
				
				A_Scope.callBack += "$scope.resetScope();";
				A_Scope.callBack += "$('#ab-back').attr('href','#VIN_ITEMS/VGB_PARTNERS/Process:VIN_ITEMS,Session:VIN_ITEMS,tblName:vin_item,VIN_ITEM_ITMID:'+$scope.VIN_ITEM_ITMID);";
				$scope.chkMain();
				$("[ng-model='VIN_ITEM_ITMID']").focus();
				
			}   
			
			//$scope.itemInit(); 
}
	

</script>
