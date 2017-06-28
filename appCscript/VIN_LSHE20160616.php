<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}
A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vin_lshe"] = "dbMain";
	 
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}
A_LocalAgularFn.prototype.VIN_LSHE = function($scope,$http,$routeParams) 
{
	
	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		$scope.ABlstAlias(ce,obj,tbl,"vin_lshe")
	}

   	$scope.VIN_LSHE_ITMID = " ";
   	
	$scope.kPress('VIN_LSHE_ITMID','VIN_LSHE_ITMID','vin_lshe',0);
		
	// AC 20160302 Commente line below
	// $scope.ABchkMain();
}

A_LocalAgularFn.prototype.VIN_LOTCT = function($scope,$http,$routeParams) 
{
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype = $scope.opts.updType;
	
	
	if (!$scope.opts.idVIN_LSHE)
	{
		A_LocalAgular.setOpts($scope,"idVIN_LSHE");
	}
	

	// AC 20160512
	// The function below $scope.ABupd is not allowed. 
	
	// The declaration of AB function is forbidden.
	// Direct calls to function A_Scope.dbUpd is forbidden; It is reserved for the standard controller.
	// Any calls to A_Scope database access functions is forbidden. Always use Standard AB scope functions.
	// Breaking these rules will disrupt many functionalities
	
	// I do not want to find another one that I have not given temporary consent. They will all be removed from appCsripts.
	
	// You can use the ab-updSuccess textarea in your appHtml script to achieve the same result as below.
	// ab-updSuccess text is executed like a callBack only if (data['posts'].errorCode==0)
	// In the future if we need to execute something if the update failed we will create and implement ab-updFailure
	
	// Fix your coding to comply and remove the $scope.ABupd function from this script.
	// Fix all other scripts you have done the same way to comply.
	// If you cannot find solutions, we will need to review together and find a good method.
		
//			$scope.ABupd = function (opt) {
//				
//					A_Scope.callBack = "$scope.initfun();";
//					A_Scope.dbUpd($scope,$http,opt);
//				
//			 }
	

	// AC 20160512	 
	// Not needed 
	// Do not modify $("#ab-back").attr("href",str);
	// Angular has a nice fluid display. (No screen refresh) 
	// When you redirect angular initializes and display is not fluid.
	// To understand the visual difference execute Global Parameter Country  control. Try the edit and the create new.
	// Much more fluid no refresh. All parameter sessions are the same 
	
	/*$scope.redirect = function()
	{
			if($scope.opts.updType == "CREATE")
				var str = "#VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:0,idVIN_ITEM:"+$scope.opts.idVIN_ITEM+",updType:CREATE,Session:VIN_LOTCT,Process:VIN_ITEMS";
			else if ($scope.opts.updType == "UPDATE") 
				var str = "#VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:"+$scope.opts.idVIN_LSHE+",idVIN_ITEM:"+$scope.opts.idVIN_ITEM+",updType:UPDATE,Session:VIN_LOTCT,Process:VIN_ITEMS";
			
			$("#ab-back").attr("href",str);
		  	$('#ab-back').click();
	}*/

	// AC 20160512	
	// I do not understand why this is required 
	// Remove if not needed
	$scope.setEdtfld = function()
	{ 
//		var occ = 0;
//		while (occ < $scope.vin_item.length)
//		{
//			if ($scope.vin_item[occ]['idVIN_LSHE'] == $scope.opts.idVIN_LSHE)
//			{
//				$scope.VIN_LSHE_UNITM=$scope.vin_item[occ]['VIN_LSHE_ITMID'];
//				$scope.VIN_LSHE_LOTID=$scope.vin_item[occ]['VIN_LSHE_LOTID'];
//				$scope.VIN_LSHE_DOMDA=$scope.vin_item[occ]['VIN_LSHE_DOMDA'];
//				$scope.VIN_LSHE_DATES=$scope.vin_item[occ]['VIN_LSHE_DATES'];
//				$scope.VIN_LSHE_SOLDO=$scope.vin_item[occ]['VIN_LSHE_SOLDO'];
//				$scope.VIN_LSHE_AUTOS=$scope.vin_item[occ]['VIN_LSHE_AUTOS'];
//				$scope.VIN_LSHE_BPART=$scope.vin_item[occ]['VIN_LSHE_BPART'];
//				$scope.VIN_LSHE_LOTSQ=$scope.vin_item[occ]['VIN_LSHE_LOTSQ'];
//				$scope.VIN_ITEM_ITMID=$scope.vin_item[occ]['VIN_ITEM_ITMID'];
//				$scope.idVIN_LSHE=$scope.vin_item[occ]['idVIN_LSHE'];
//			}
//			occ += 1;
//		}
		$scope.idVGB_SUPP = $scope.VIN_LSHE_BPART;
		$scope.ABlst('idVGB_SUPP','idVGB_SUPP','vgb_supp',0);
	}



	// AC 20160512
	
	// The function below vin_itemSupportTbl is not good structure
	// Using $scope.opts.updType == 'CREATE' and $scope.opts.idVIN_ITEM does not make it reusable unless you redirect every time
	// Initializing VIN_LSHE data in a function called vin_itemSupportTbl does not make sense and is difficult to find and understand
	// This is not the place to do that
	
	/*$scope.vin_itemSupportTbl = function()
	{
	  if($scope.opts.idVIN_ITEM) {
			var obj = new Object();
			obj["idVIN_ITEM"] = $scope.opts.idVIN_ITEM;
			A_Scope.callBack = "	 if($scope.opts.updType == 'CREATE' ){$scope.idVIN_LSHE='';$scope.VIN_LSHE_LOTID='';$scope.VIN_LSHE_DOMDA='';$scope.VIN_LSHE_DATES='';$scope.VIN_LSHE_AUTOS='';$scope.VIN_LSHE_SOLDO='';$scope.VIN_LSHE_BPART='';}else{$scope.setEdtfld();}$scope.VIN_LSHE_ITMID=$scope.opts.idVIN_ITEM;";
			$scope.ABchkMain(obj,"vin_item");
  			}
  			else {
			$scope.idVIN_ITEM = $scope.VIN_LSHE_ITMID;
			A_Scope.callBack = "$scope.setEdtfld()";
			$scope.ABlst('idVIN_ITEM','idVIN_ITEM','vin_item',0);
		}
		$scope.idVGB_SUPP = $scope.VIN_LSHE_BPART;
		$scope.ABlst('idVGB_SUPP','idVGB_SUPP','vgb_supp',0);
	}
	*/
	// AC 20160512	
	// Below should have been made within a function
	// This would avoid the usage of $scope.redirects function 
	// If below was a function then you could call this function and it would be the same effect as redirect function.
	// Without reloading each time. 
	/*$scope.ABinitTbl('vin_lshe','idVIN_LSHE');
	$scope.ABupdChkObj('idVIN_LSHE', $scope.opts.idVIN_LSHE,true);*/
	//A_Scope.callBack = "$scope.vin_itemSupportTbl();";
	//$scope.ABchkMain();


	$scope.getItemLots = function ()	
	{
		
		$scope.idVIN_ITEM = $scope.opts.idVIN_ITEM
		A_Scope.callBack = "$scope.initLot();$scope.setEdtfld();";
		$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM','vin_item',"vin_lsheList")
	}

	$scope.initLot = function()
	{
	
		// alert($scope.idVIN_LSHE + "-" + $scope.opts.idVIN_ITEM)
		if ($scope.idVIN_LSHE < 1)
		{
			
			$scope.idVIN_LSHE='';
			$scope.VIN_LSHE_LOTID='';
			$scope.VIN_LSHE_DOMDA='';
			$scope.VIN_LSHE_DATES='';
			$scope.VIN_LSHE_AUTOS='';
			$scope.VIN_LSHE_SOLDO='';
			$scope.VIN_LSHE_BPART='';
			$scope.VIN_LSHE_ITMID= $scope.opts.idVIN_ITEM;
			$scope.idVIN_ITEM = $scope.vin_lsheList[0].idVIN_ITEM;
			$scope.VIN_ITEM_ITMID = $scope.vin_lsheList[0].VIN_ITEM_ITMID;
			$scope.VIN_ITEM_DESC1 = $scope.vin_lsheList[0].VIN_ITEM_DESC1;
		}
	}
	
	$scope.initEditLot =function () 
	{

		$scope.ABinitTbl("vin_lshe","idVIN_LSHE");
		$scope.ABupdChkObj("idVIN_LSHE",$scope.opts.idVIN_LSHE,true);
		A_Scope.callBack = "$scope.getItemLots();";
		$scope.ABchkMain();
		
	}

	$scope.setUpdType = function(idNumber)
	{

		if (idNumber == 0)
		{
			$scope.opts.updType = "CREATE";
			$scope.opts.idVIN_LSHE = 0;
			$scope.initEditLot();
			
		}
		else
		{
			$scope.opts.updType = "UPDATE";
			$scope.opts.idVIN_LSHE = idNumber;
			$scope.initEditLot();	
		}
	}
	
	$scope.initEditLot();

// AC 20160512	
/* This is how it should look
//		$scope.initLot = function()
//		{
//			idVIN_LSHE='';
//			VIN_LSHE_LOTID='';
//			VIN_LSHE_DOMDA='';
//			VIN_LSHE_DATES='';
//			VIN_LSHE_AUTOS='';
//			VIN_LSHE_SOLDO='';
//			VIN_LSHE_BPART='';
//			VIN_LSHE_ITMID=idVIN_ITEM;
//		}
//
//		$scope.initLotDta = function(lotId)
//		{
//			$scope.ABinitTbl('vin_lshe','idVIN_LSHE');
//			$scope.ABupdChkObj('idVIN_LSHE',lotId,true);
//			A_Scope.callBack = "$scope.vin_itemSupportTbl();if($scope.idVIN_LSHE < 1){$scope.initLot());";
//			$scope.ABchkMain();	
//		}
//	
//	$scope.idVIN_ITEM = $scope.opts.idVIN_ITEM
//	$scope.initLotDta($scope.opts.idVIN_LSHE)

*/	

/*
	// AC 20160512
	
Edit LOT
 not	href="#/VIN_ITEMS/VIN_LOTCT/idVIN_LSHE:27,idVIN_ITEM:7,updType:UPDATE,Session:VIN_LOTCT,Process:VIN_ITEMS"
 this way ng-click="initLotDta(k.idVIN_LSHE);"
	
	
You will need to modify vin_itemSupportTbl
*/
	 
}


</script>
