<script>
var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{
    
	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vin_item"] = "dbMain";
	 
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}
A_LocalAgularFn.prototype.VIN_ITEMS = function($scope,$http,$routeParams) 
{

	$scope.orderRefresh = function()
	{
		
		// time out to permit page refresh before collecting item list
		setTimeout(function()
		{
			$scope.orderQuery();
			$scope.idVIN_ITEM = 0; //$scope.VSL_ORDE_ITMID;
			$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_item_vsl','vin_item_vsl','vsl_item');
			$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM,vin_item_vpu','vin_item_vpu','vpu_item');
			
		},500);
		 
	}
	
	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		$scope.ABlstAlias(ce,obj,tbl,"vin_item","vin_item")
	}
	
	$scope.orderQuery = function ()
	{
		var nL = "";
		//var i = 1;
		$("[ng-model='x.idVIN_ITEM']").each(function()
		{ 
			
			if (nL.indexOf("," + $(this).val() + ",") == -1)
			{
				/*$scope.VSL_ORDE_ITMID = Math.min($(this).val(),$scope.VSL_ORDE_ITMID) 
				if(i == 1)
					nL += "," + $(this).val() + ",";
				else*/
					nL += $(this).val() + ",";
			}
			//i++;
		});
		
		$scope["vin_item_vsl"] = nL; 
		$scope["vin_item_vpu"] = nL; 
	}
	
	$scope.VIN_ITEMSlstAlias = function (ce,obj,tbl,dir) 
	{
		
		$scope["vin_item_vsl"] = "";
		$scope["vin_item_vpu"] = "";
		$scope["idVIN_ITEM"]=0;
		A_Scope.callBack = "$scope.orderRefresh();";
		$scope.ABlstAlias(ce,obj,tbl,dir)
	}

	$scope.VIN_ITEM_ITMID = ""
	
	$scope.VIN_ITEMSlstAlias('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item','vin_item')
	

}

A_LocalAgularFn.prototype.VIN_REPLENISH = function($scope,$http,$routeParams)
{
	<?php require_once "../appCscript/VIN_ITEMS_REPLENISH.php"; ?>
	
}


A_LocalAgularFn.prototype.VIN_CUST_ITEMS = function($scope,$http,$routeParams)
{
	<?php require_once "../appCscript/VIN_ITEMS_VIN_CUSTCT.php"; ?>
	
}

A_LocalAgularFn.prototype.VIN_SUPP_ITEMS = function($scope,$http,$routeParams)
{
	<?php require_once "../appCscript/VIN_ITEMS_VIN_SUPPCT.php"; ?>
	
}

A_LocalAgularFn.prototype.VIN_CUSTCT = function($scope,$http,$routeParams)
{
	$scope.initNewCustomer = function()
	{
		if ($scope.idVIN_CUST < 1 || $scope.VIN_CUST_BPART == $scope.abSessionResponse.idVGB_CUST)
		{
			$scope.VIN_CUST_BPART = $scope.abSessionResponse.idVGB_CUST;
			$scope.VGB_CUST_BPNAM = $scope.abSessionResponse.VGB_CUST_BPNAM;
			$scope.VGB_BPAR_BPART = $scope.abSessionResponse.VGB_BPAR_BPART;
		}

	}	

	$scope.initNewItem = function()
	{
		if ($scope.idVIN_CUST < 1 || $scope.VIN_CUST_ITMID == $scope.abSessionResponse.idVIN_ITEM)
		{
			$scope.VIN_CUST_ITMID = $scope.abSessionResponse.idVIN_ITEM;
			$scope.VIN_ITEM_ITMID = $scope.abSessionResponse.VIN_ITEM_ITMID;
			$scope.VIN_ITEM_DESC1 = $scope.abSessionResponse.VIN_ITEM_DESC1;
		}

	}	

	$scope.initNewSupp = function()
	{
//		if ($scope.idVIN_CUST < 1 || $scope.VIN_CUST_SUPPL == $scope.abSessionResponse.idVGB_SUPP)
//		{
			$scope.VIN_CUST_SUPPL = $scope.abSessionResponse.idVGB_SUPP;
			$scope.VGB_SUPP_BPNAM = $scope.abSessionResponse.VGB_SUPP_BPNAM;
			$scope.VGB_BPAR_BPARTS = $scope.abSessionResponse.VGB_BPAR_BPART;
//		}

	}


	$scope.vin_setitems = function()
	{
		
		
		
    	if ($scope.orgItemId>0&&$scope.orgId<1)
	    	{ 
	    		
	    		$scope.idVIN_ITEM=$scope.orgItemId;
	    		$scope.ABinitTbl('vin_cust_item','idVIN_ITEM');	   
			$scope.ABupdChkObj('supportChk',true,true);
	    	   	$scope.ABupdChkObj('idVIN_ITEM',$scope.orgItemId,true);
	    	   	A_Scope.callBack = "$scope.initItemDta(data);$scope.vin_setcust();";
	    		$scope.ABchk();   
	    		
	    	}    
	}	

	$scope.initItemDta = function(data)
	{
		if(data.posts.result[0])
		{			
			var nObj = data.posts.result[0];
			$scope.VIN_CUST_ITMID = nObj.idVIN_ITEM;
			$scope.VIN_ITEM_ITMID = nObj.VIN_ITEM_ITMID;
			$scope.VIN_ITEM_DESC1 = nObj.VIN_ITEM_DESC1;

					}
	}
	
	
	$scope.vin_setcust = function()
	{
	 
    	if ($scope.orgCustId>0&&$scope.orgId<1)
	    	{ 
	    		$scope.idVGB_CUST=$scope.orgCustId;
	    		$scope.ABinitTbl('vgb_cust','idVGB_CUST');
	    		$scope.ABupdChkObj('supportChk',true,true);	   
	    	   	$scope.ABupdChkObj('idVGB_CUST',$scope.orgCustId,true);
	    	   	A_Scope.callBack = "$scope.initCustDta(data);"
	    		$scope.ABchk();   
	    		
	    	}    
	        
     	
	}	
	
	$scope.initCustDta = function(data)
	{
	 
		if(data.posts.result[0])
		{			
			var nObj = data.posts.result[0];
			$scope.VIN_CUST_BPART = nObj.idVGB_CUST;
			$scope.VGB_BPAR_BPART = nObj.VGB_BPAR_BPART;
			$scope.VGB_CUST_BPNAM = nObj.VGB_CUST_BPNAM;
		}
	}

	$scope.initCustItmdta = function(holdId)
	{

		
		$scope.ABinitTbl('vin_cust','idVIN_CUST');	   
	   	$scope.ABupdChkObj('idVIN_CUST', holdId,true);   		
	   	A_Scope.callBack = "$scope.vin_setitems();";
		$scope.ABchk();	
		//$scope.vin_setitems();
	
	}

	
	$scope.orgItemId = $scope.opts.idVIN_ITEM;
	$scope.orgCustId = $scope.opts.idVGB_CUST;
	$scope.orgId = $scope.opts.idVIN_CUST;
	
	$scope.initCustItmdta($scope.orgId);

}


A_LocalAgularFn.prototype.VIN_SUPPCT = function($scope,$http,$routeParams)
{
	$scope.initNewSupp = function()
	{
		if ($scope.idVIN_SUPP < 1 || $scope.VIN_SUPP_BPART == $scope.abSessionResponse.idVGB_SUPP)
		{
			$scope.VIN_SUPP_BPART = $scope.abSessionResponse.idVGB_SUPP;
			$scope.VGB_SUPP_BPNAM = $scope.abSessionResponse.VGB_SUPP_BPNAM;
			$scope.VGB_BPAR_BPART = $scope.abSessionResponse.VGB_BPAR_BPART;
		}

	}	

	$scope.initNewItem = function()
	{
		if ($scope.idVIN_SUPP < 1 || $scope.VIN_SUPP_ITMID == $scope.abSessionResponse.idVIN_ITEM)
		{
			$scope.VIN_SUPP_ITMID = $scope.abSessionResponse.idVIN_ITEM;
			$scope.VIN_ITEM_ITMID = $scope.abSessionResponse.VIN_ITEM_ITMID;
			$scope.VIN_ITEM_DESC1 = $scope.abSessionResponse.VIN_ITEM_DESC1;
		}

	}	




	$scope.vin_setitems = function()
	{
		
	    	if ($scope.orgItemId>0&&$scope.orgeId<1)
	    	{ 
	    		
	    		$scope.idVIN_ITEM=$scope.orgItemId;
	    		$scope.ABinitTbl('vin_supp_item','idVIN_ITEM');	   
			    $scope.ABupdChkObj('supportChk',true,true);
	    	   	$scope.ABupdChkObj('idVIN_ITEM',$scope.orgItemId,true);
	    	   	A_Scope.callBack = "$scope.initItemDta(data);$scope.vin_setsupp();";

	    		$scope.ABchk();   
	    		
	    	}    
	}	

	$scope.initItemDta = function(data)
	{
		if(data.posts.result[0])
		{	
					

			var nObj = data.posts.result[0];
			$scope.VIN_SUPP_ITMID = nObj.idVIN_ITEM;
			$scope.VIN_ITEM_ITMID = nObj.VIN_ITEM_ITMID;
			$scope.VIN_ITEM_DESC1 = nObj.VIN_ITEM_DESC1;

		
		}
	}
	
	
	$scope.vin_setsupp = function()
	{
	    	if ($scope.orgSuppId>0&&$scope.orgeId<1)
	    	{ 
	    		$scope.idVGB_SUPP=$scope.orgSuppId;
	    		$scope.ABinitTbl('vgb_supp','idVGB_SUPP');
	    		$scope.ABupdChkObj('supportChk',true,true);	   
	    	   	$scope.ABupdChkObj('idVGB_SUPP',$scope.orgSuppId,true);
	    	   	A_Scope.callBack = "$scope.initSuppDta(data);"
	    		$scope.ABchk();   
	    		
	    	}    
	        
     	
	}	
	
	$scope.initSuppDta = function(data)
	{
		if(data.posts.result[0])
		{			
			var nObj = data.posts.result[0];
			$scope.VIN_SUPP_BPART = nObj.idVGB_SUPP;
			$scope.VGB_BPAR_BPART = nObj.VGB_BPAR_BPART;
			$scope.VGB_SUPP_BPNAM = nObj.VGB_SUPP_BPNAM;
		}
	}

	$scope.initSuppItmdta = function(holdId)
	{

    	
		$scope.ABinitTbl('vin_supp','idVIN_SUPP');	   
	   	$scope.ABupdChkObj('idVIN_SUPP', holdId,true);   		
	   	A_Scope.callBack = "$scope.vin_setitems();";
		$scope.ABchk();	
		//$scope.vin_setitems();
	
	}

	
	$scope.orgItemId = $scope.opts.idVIN_ITEM;
	$scope.orgSuppId = $scope.opts.idVGB_SUPP;
	$scope.orgeId = $scope.opts.idVIN_SUPP;
	$scope.initSuppItmdta($scope.orgeId);

}

A_LocalAgularFn.prototype.VIN_ITEMCT = function($scope,$http,$routeParams)
{
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype = $scope.opts.updType;
	
	if (!$scope.opts.idVIN_ITEM)
	{
		A_LocalAgular.setOpts($scope,"idVIN_ITEM");
	}
	
	$scope.vin_itemUnits = function()
	{
		if (!$scope.VIN_ITEM_UNSET || $scope.VIN_ITEM_UNSET == 0)
		{
			alert("You must select a unit set first!!!")
			return;
		}

		var needToRead = false
		try 
		{
			if (!$scope["vin_unit"] || $scope.vin_unit[0].VIN_UNIT_UNSET!=$scope.VIN_ITEM_UNSET)
			{
				needToRead = true;
			}
		}
		catch(er)
		{
			needToRead = true;
		}
		
				
		if (needToRead == true)
		{
			delete $scope.vin_unit
			var callBack = 'if($scope.vin_unit==""){alert("The selected unit set has no units of measure defined");}'
			var pattern = "[=SPE=] VIN_UNIT_UNSET = " + $scope.VIN_ITEM_UNSET + " " ;
			$scope.ABsearchAlias('vin_unit','',pattern,'vin_unit','VIN_UNIT_UNITM ASC',callBack)
		}

	}
	

	$scope.copyUnitOfMeasure = function(unitId)
	{
		if ($scope.VIN_ITEM_ACUOM*1==0)
		{
			$scope.VIN_ITEM_ACUOM = unitId;
		}
		if ($scope.VIN_ITEM_CPUOM*1==0)
		{
			$scope.VIN_ITEM_CPUOM = unitId;
		}
		if ($scope.VIN_ITEM_LPUOM*1==0)
		{
			$scope.VIN_ITEM_LPUOM = unitId;
		}
		if ($scope.VIN_ITEM_PUUOM*1==0)
		{
			$scope.VIN_ITEM_PUUOM = unitId;
		}
		if ($scope.VIN_ITEM_SAUOM*1==0)
		{
			$scope.VIN_ITEM_SAUOM = unitId;
		}
		if ($scope.VIN_ITEM_SCUOM*1==0)
		{
			$scope.VIN_ITEM_SCUOM = unitId;
		}
		if ($scope.VIN_ITEM_UNITM*1==0)
		{
			$scope.VIN_ITEM_UNITM = unitId;			
		}
	}
	
	$scope.eraseUnitOfMeasure = function()
	{
		
		$scope.VIN_ITEM_ACUOM = "";
		$scope.VIN_ITEM_CPUOM = "";
		$scope.VIN_ITEM_LPUOM = "";
		$scope.VIN_ITEM_PUUOM = "";
		$scope.VIN_ITEM_SAUOM = "";
		$scope.VIN_ITEM_SCUOM = "";
		$scope.VIN_ITEM_UNITM = "";
		delete $scope.vin_unit;
		
	}
	
//	$scope.vin_itemSupportTbl = function()
//	{
//		A_Scope.callBack = "$scope.vin_itemSupportTbl1();"
//		$scope.VIN_UNIT_UNITM = " ";
//		$scope.ABlst('VIN_UNIT_UNITM','VIN_UNIT_UNITM','vin_unit',0);
//	}


	$scope.vin_itemSupportTbl = function()
	{
		if (!$scope["vin_ityp"] )
		{
			var pattern = "";
			$scope.ABsearchAlias('vin_ityp','','','vin_ityp','VIN_ITYP_ITYPE ASC','$scope.vin_itemSupportTbl2();')
		}
		else
		{
			$scope.vin_itemSupportTbl2();
		}
	}
//	$scope.vin_itemSupportTbl1 = function()
//	{
//		A_Scope.callBack = "$scope.vin_itemSupportTbl2();"
//		$scope.VIN_ITYP_ITYPE = " ";
//		$scope.ABlst('VIN_ITYP_ITYPE','VIN_ITYP_ITYPE','vin_ityp',0);		
//	}

	$scope.vin_itemSupportTbl2 = function()
	{
		if (!$scope["vin_uset"] )
		{
			var pattern = "";
			$scope.ABsearchAlias('vin_uset','','','vin_uset','VIN_USET_UNSET ASC','$scope.vin_itemSupportTbl3();')
		}
		else
		{
			$scope.vin_itemSupportTbl3();
		}
	}
//	$scope.vin_itemSupportTbl2 = function()
//	{
//		A_Scope.callBack = "$scope.vin_itemSupportTbl3();"
//		$scope.VIN_USET_UNSET = " ";
//		$scope.ABlst('VIN_USET_UNSET','VIN_USET_UNSET','vin_uset',0);
//	}


	$scope.vin_itemSupportTbl3 = function()
	{
		if (!$scope["vin_wars"] )
		{
			var pattern = "";
			$scope.ABsearchAlias('vin_wars','','','vin_wars','VIN_WARS_WARID ASC','$scope.vin_itemSupportTbl4();$scope.setWarhouse();')
		}
		else
		{
			$scope.vin_itemSupportTbl4();
		}
	}
//	$scope.vin_itemSupportTbl3 = function()
//	{
//		A_Scope.callBack = "$scope.vin_itemSupportTbl4();$scope.setWarhouse();"
//		$scope.VIN_WARS_WARID = " ";
//		$scope.ABlst('VIN_WARS_WARID','VIN_WARS_WARID','vin_wars',0);
//	}
//


	$scope.vin_itemSupportTbl4 = function()
	{
		if (!$scope["vin_grou"] )
		{
			var pattern = "";
			$scope.ABsearchAlias('vin_grou','','','vin_grou','VIN_GROU_ITGRP ASC','$scope.vin_itemSupportTbl5();')
		}
		else
		{
			$scope.vin_itemSupportTbl5();
		}
	}
//	$scope.vin_itemSupportTbl4 = function()
//	{
//		A_Scope.callBack = "$scope.vin_itemSupportTbl5();"
//		$scope.VIN_GROU_ITGRP = " ";
//		$scope.ABlst('VIN_GROU_ITGRP','VIN_GROU_ITGRP','vin_grou',0);
//	}


	$scope.vin_itemSupportTbl5 = function()
	{
		if (!$scope["vgl_schh"] )
		{
			var pattern = "";
			$scope.ABsearchAlias('vgl_schh','','','vgl_schh','VGL_SCHH_ISCID ASC','$scope.vin_itemSupportTbl6();')
		}
		else
		{
			$scope.vin_itemSupportTbl6();
		}
	}
//	$scope.vin_itemSupportTbl5 = function()
//	{
//		A_Scope.callBack = "$scope.vin_itemSupportTbl6();"
//		$scope.VGL_SCHH_ISCID = " ";
//		$scope.ABlst('VGL_SCHH_ISCID','VGL_SCHH_ISCID','vgl_schh',0);
//	}
	$scope.vin_itemSupportTbl6 = function()
	{
		if (!$scope["vtx_itta"] )
		{
			var pattern = "";
			$scope.ABsearchAlias('vtx_itta','','','vtx_itta','VTX_ITTA_TCAID ASC','$scope.vin_itemSupportTbl7();')
		}
		else
		{
			$scope.vin_itemSupportTbl7();
		}
	}
//	$scope.vin_itemSupportTbl6 = function()
//	{
//		$scope.VTX_ITTA_TCAID = " ";
//		$scope.ABlst('VTX_ITTA_TCAID','VTX_ITTA_TCAID','vtx_itta',0);
//	}

	$scope.vin_itemSupportTbl7 = function()
	{
		// Only needed on first time
		// if ($scope.idVIN_ITEM 
		if (!$scope.VIN_ITEM_UNSET && $scope["vin_uset"] && $scope["vin_uset"]!= "" && $scope["vin_uset"].length >0 )
		{
			$scope.VIN_ITEM_UNSET = $scope["vin_uset"][0]["idVIN_USET"]; 
		}
		
		if (!$scope.VIN_ITEM_ISCID && $scope["vgl_schh"] && $scope["vgl_schh"]!= "" && $scope["vgl_schh"].length >0 )
		{
			$scope.VIN_ITEM_ISCID = $scope["vgl_schh"][0]["idVGL_SCHH"]; 
		}
		
		if (!$scope["vin_unit"] )
		{
			var pattern = "[=SPE=] VIN_UNIT_UNSET = " + $scope.VIN_ITEM_UNSET + " " ;
			$scope.ABsearchAlias('vin_unit','',pattern,'vin_unit','VIN_UNIT_UNITM ASC','')
		}
	}
	
	$scope.getVinSuppliers = function()
	{
		var pattern = "[=SPE=] VIN_SUPP_ITMID = '" + $scope.idVIN_ITEM + "' ";
		var joinTbl = "vgb_supp:idVGB_SUPP = VIN_SUPP_BPART";
		$scope.ABsearchAlias('vin_supp',joinTbl,pattern,'vin_suppliers','','');
	}
		
	$scope.setWarhouse = function()
	{
		if ($scope.idVIN_ITEM > 0)
		{
			return;
		}
		var occ = 0
		while (occ < $scope.vin_wars.length)
		{
			if ($scope.vin_wars[occ]["VIN_WARS_SFWAR"] == "1")
			{
				$scope["VIN_ITEM_WARID"] = $scope.vin_wars[occ]["idVIN_WARS"];
				occ = $scope.vin_wars.length;
			}
			occ += 1;
		}
	}
	

	$scope.initItmdta = function(opt)
	{
		$scope.ABinitTbl('vin_item','idVIN_ITEM');
		$scope.ABupdChkObj('idVIN_ITEM',opt,true);
		A_Scope.callBack = "$scope.vin_itemSupportTbl();";
		$scope.ABchkMain();
	}
	
	$scope.itmidDefaults = function()
	{
		
		if ($scope.opts.updType == "CREATE")
		{
			if (!$scope.VIN_ITEM_INVID || $scope.VIN_ITEM_INVID==null || $scope.VIN_ITEM_INVID == "" )
			{
				$scope.VIN_ITEM_INVID = $scope.VIN_ITEM_ITMID;	
			}
			
			if (!$scope.VIN_ITEM_HRZID || $scope.VIN_ITEM_HRZID==null || $scope.VIN_ITEM_HRZID == "" )
			{
				$scope.VIN_ITEM_HRZID = $scope.VIN_ITEM_ITMID;	
			}
			if (!$scope.VIN_ITEM_UPCID || $scope.VIN_ITEM_UPCID==null || $scope.VIN_ITEM_UPCID == "" )
			{
				$scope.VIN_ITEM_UPCID = $scope.VIN_ITEM_ITMID;	
			}
		}
	}
			

	
	$scope.initItmdta($scope.opts.idVIN_ITEM);

}


A_LocalAgularFn.prototype.VIN_LOTCT = function($scope,$http,$routeParams) 
{
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype = $scope.opts.updType;
	
	
	$scope.setLSHE_DATES = function(opt)
	{
		
		var ret = $scope.VIN_LSHE_DATES;
		
		if ($scope.idVIN_LSHE < 1 || opt==1)
		{
			ret = $scope.ABGetDateFn('add-days',($scope.vin_lsheList[0].VIN_ITEM_DOMOS!='DOS'?$scope.VIN_LSHE_DOMDA:$scope.VIN_LSHE_DOSDA) + ',' + $scope.vin_lsheList[0].VIN_ITEM_SHLIF);
		}
		
		return ret;
	}
	
	
	if (!$scope.opts.idVIN_LSHE)
	{
		A_LocalAgular.setOpts($scope,"idVIN_LSHE");
	}

	$scope.setEdtfld = function()
	{ 
		$scope.idVGB_SUPP = $scope.VIN_LSHE_BPART;
		$scope.ABlst('idVGB_SUPP','idVGB_SUPP','vgb_supp',0);
	}

	$scope.getItemLots = function ()	
	{
		
		$scope.idVIN_ITEM = $scope.opts.idVIN_ITEM
		A_Scope.callBack = "$scope.initLot();$scope.setEdtfld();";
		$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM','vin_item_lots',"vin_lsheList")
	}

	$scope.initLot = function()
	{
		// AC 20160619
		$scope.idVIN_SSMA_LIST = "";
		$scope.idVIN_SSMA_LISTorg = "";
		
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
		else
		{
			// AC 20160619
			// init attached  Specs list
			var tObj = $scope.vin_lsheList[0];
			var occ = 0;
			while (occ < tObj.rowSet.length)
			{
				/// $scope.idVIN_SSMA_LIST += "[" + tObj[occ].VIN_SSLT_ITMID + "){" + tObj[occ].VIN_SSLT_LOTID + "]";
				
				if (tObj.rowSet[occ].VIN_SSLT_ITMID == $scope.vin_lsheList[0].idVIN_ITEM && tObj.rowSet[occ].VIN_SSLT_LOTID == $scope.idVIN_LSHE)
				{
					if (tObj.rowSet[occ].idVIN_SSLT > 0 && $scope.idVIN_SSMA_LIST.indexOf("," + tObj.rowSet[occ].VIN_SSLT_SPESQ + ",") == -1)
					{
						$scope.idVIN_SSMA_LIST += "," + tObj.rowSet[occ].VIN_SSLT_SPESQ + ",";
					}
				}
				occ += 1
			}
			
		}
		
		$scope.idVIN_SSMA_LISTorg = $scope.idVIN_SSMA_LIST;
		
		
	}
	
	
	// AC 20160619
	$scope.toggleSpecLink = function(specId)
	{
		if ($scope.idVIN_SSMA_LIST.indexOf("," + specId + ",") == -1)
		{
			$scope.idVIN_SSMA_LIST += "," + specId + ",";
		}
		else
		{
			$scope.idVIN_SSMA_LIST = $scope.idVIN_SSMA_LIST.slice(0,$scope.idVIN_SSMA_LIST.indexOf("," + specId + ",")) + $scope.idVIN_SSMA_LIST.slice($scope.idVIN_SSMA_LIST.indexOf("," + specId + ",")+specId.length+2);
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
	 
}

A_LocalAgularFn.prototype.VIN_SSMACT = function($scope,$http,$routeParams) 
{
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype = $scope.opts.updType;
	
	if (!$scope.opts.idVIN_SSMA)
	{
		A_LocalAgular.setOpts($scope,"idVIN_SSMA");
	}

	$scope.getItemLots = function ()	
	{
		$scope.idVIN_ITEM = $scope.opts.idVIN_ITEM;
		A_Scope.callBack = "$scope.initLot();";
		$scope.ABlstAlias('idVIN_ITEM','idVIN_ITEM','vin_item_lots',"vin_ssmaList")
	}

	$scope.initLot = function()
	{
		//$scope.idVIN_SSMA_LIST = "[" + tObj.rowSet.length + "]";
		
		$scope.idVIN_LSHE_LIST = "";
		$scope.idVIN_LSHE_LISTorg = "";
		
		if ($scope.idVIN_SSMA < 1)
		{
			$scope.idVIN_SSMA='';
			$scope.VIN_SSMA_SPEID='';
			$scope.VIN_SSMA_DESCR='';
			$scope.VIN_SSMA_SUETA= $scope.vin_ssmaList[0].VIN_ITEM_SUETA;
			$scope.VIN_SSMA_SHLIF='';
			$scope.VIN_SSMA_REVIS='';
			$scope.VIN_SSMA_SUPER='';
			$scope.VIN_SSMA_LINKS='';
			$scope.VIN_SSIT_ITMID= $scope.opts.idVIN_ITEM;
			$scope.idVIN_ITEM = $scope.vin_ssmaList[0].idVIN_ITEM;
			$scope.VIN_ITEM_ITMID = $scope.vin_ssmaList[0].VIN_ITEM_ITMID;
			$scope.VIN_ITEM_DESC1 = $scope.vin_ssmaList[0].VIN_ITEM_DESC1;
		}
		else
		{
	
			var tObj = $scope.vin_ssmaList[0];
			var occ = 0;
					
			while (occ < tObj.rowSet.length)
			{
				
				if (tObj.rowSet[occ].VIN_SSLT_ITMID == $scope.vin_ssmaList[0].idVIN_ITEM && tObj.rowSet[occ].VIN_SSLT_SPESQ == $scope.idVIN_SSMA)
				{
					if (tObj.rowSet[occ].idVIN_SSLT > 0 && $scope.idVIN_LSHE_LIST.indexOf("," + tObj.rowSet[occ].VIN_SSLT_LOTID + ",") == -1)
					{
						$scope.idVIN_LSHE_LIST += "," + tObj.rowSet[occ].VIN_SSLT_LOTID + ",";
					}
				}
				occ += 1
			}
			
		}

		$scope.idVIN_LSHE_LISTorg = $scope.idVIN_LSHE_LIST;
	}
	
	$scope.initEditLot =function () 
	{
		$scope.ABinitTbl("vin_ssma","idVIN_SSMA");
		$scope.ABupdChkObj("idVIN_SSMA",$scope.opts.idVIN_SSMA,true);
		A_Scope.callBack = "$scope.getItemLots();";
		$scope.ABchkMain();
	}

	$scope.setUpdType = function(idNumber)
	{ 
		if (idNumber == 0)
		{
			$scope.opts.updType = "CREATE";
			$scope.opts.idVIN_SSMA = 0;
			$scope.initEditLot();
		}
		else
		{
			$scope.opts.updType = "UPDATE";
			$scope.opts.idVIN_SSMA = idNumber;
			$scope.initEditLot();	
		}
	}
	
	$scope.toggleLotLink = function(lotId)
	{
		if ($scope.idVIN_LSHE_LIST.indexOf("," + lotId + ",") == -1)
		{
			$scope.idVIN_LSHE_LIST += "," + lotId + ",";
		}
		else
		{
			$scope.idVIN_LSHE_LIST = $scope.idVIN_LSHE_LIST.slice(0,$scope.idVIN_LSHE_LIST.indexOf("," + lotId + ",")) + $scope.idVIN_LSHE_LIST.slice($scope.idVIN_LSHE_LIST.indexOf("," + lotId + ",")+lotId.length+2);
		}
		
	}
	
	$scope.initEditLot();
}
</script>
