<?php

ini_set('display_errors', 0);
session_start();
ob_clean();

?>

<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}


A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	if (!$scope.opts.Session)
	{
		window.history.back();
	}
	

	A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	

}

A_LocalAgularFn.prototype.VGB_PARTNERS = function($scope,$http,$routeParams) 
{

	$scope.message = 'Partner List';
	

	if ($scope.utype)
	{
		$scope.tbData = $("[ab-main]").attr("ab-main",$scope.utype);
	}
		
	$scope.tbData = $("[ab-main]").attr("ab-main");
	
	if ($scope.opts.tblName)
	{
		$scope.tbData = $scope.opts.tblName;
	}
	
	// $scope.message = "P:" + $scope.opts.tblName + " === " + $scope.tbData;

	A_Session.sessionSetCur($scope,$scope.tbData)
	
	$scope.message = '' ; 
	
	getMaxPerPage(currentPerPage);

	if ($scope.tbData == "vgb_bpar")
	{
		$scope.ce = "VGB_BPAR_BPART"
		$scope.obj = "VGB_BPAR_BPART"
		$scope.tbl = "vgb_bpar"
		$scope.VGB_BPAR_BPART = ""
	}

	if ($scope.tbData == "vgb_cust")
	{
		$scope.ce = "VGB_BPAR_BPART"
		$scope.obj = "VGB_BPAR_BPART"
		$scope.tbl = "vgb_cust"
		$scope.VGB_CUST_BPNAM = ""
//		$("#ab-mainlst").val("#partners/vgb_cust")
	}

	if ($scope.tbData == "vgb_supp")
	{
		$scope.ce = "VGB_BPAR_BPART"
		$scope.obj = "VGB_BPAR_BPART"
		$scope.tbl = "vgb_supp"
		$scope.VGB_SUPP_BPNAM = ""
//		$("#ab-mainlst").val("#partners/vgb_supp")
	}

// $("#ab-mainlst").val("#default")
	
	$scope.currentKey = function(obj)
	{
		currentKey = obj
	}
	
	$scope.kPress = function(ce,obj,tbl,dir)
	{
		
		performList($scope,$http,ce,obj,tbl,dir,currentPerPage)
		
	} 
	
	$scope.updNew = function()
	{
		 updNewDb($scope,$http)
	}
	
 	$scope.save = function(opt)
 	{
 		performSave($scope,$http,opt)
 	}   

	$scope.aliasName = "vgb_bpar";
 	$scope.VGB_BPAR_BPART = currentKey;
 	$scope.kPress($scope.ce,$scope.obj,$scope.tbl,0);
 	
 	setTimeout ("abEmpty();",500)
 		
}


A_LocalAgularFn.prototype.VGB_BPARCT = function($scope,$http,$routeParams) 
{
 

	$scope.message = 'Partner';
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype = $routeParams.OPTION;
	$scope.tbData = $("[ab-main]").attr("ab-main")
	
	A_Session.sessionSetCur($scope,$scope.tbData)
	
	if ($routeParams.VGB_BPAR_BPART && $routeParams.OPTION != "CREATE")
	{
		$scope.VGB_BPAR_BPART = $routeParams.VGB_BPAR_BPART;
		$("[ng-model='VGB_BPAR_BPART']").prop( "readonly", true );
		
	}
	

	// ce  = input field ID
	// obj = Data field ID
	// tbl = Data table name
	
	
	$scope.ce = "VGB_BPAR_BPART"
	$scope.obj = "VGB_BPAR_BPART"
	$scope.tbl = "vgb_bpar"
	$scope.ab_upd = "vgb_bpar"

	abBind($scope)
	tblInfo($scope,$http)
	commonScope($scope)
	
	var availableTags = [];
	$("[ab-autocomplete]").autocomplete({source: availableTags});

	$scope.kUp = function(ce,obj,tbl)
	{
		
		performRequest($scope,$http,ce,obj,tbl)
		
		
	}
 	$scope.chkDta = function (val)
 	{
 		if (!val)
 		{
 			val = new Object();
 			val[$scope.ce] = $scope.VGB_BPAR_BPART; 			
 			
 		}
 
 		performChk ($scope,$http,val)
 		
 	}
 	$scope.save = function(opt)
 	{
 		performSave($scope,$http,opt);
 		
 	}   
 	
 	
 	tObj = new Object();
 	tObj[$scope.ce] = $scope.VGB_BPAR_BPART;
 	$scope.chkObj = tObj
 	$scope.chkDta(tObj)

//	$scope.qRefresh($scope,$http)
 	performList($scope,$http,'VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',0,1)	
 	chkReadonly()

}

A_LocalAgularFn.prototype.VGB_ADDRCT = function($scope,$http,$routeParams) 
{


	$scope.message = 'Address';
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype = $scope.opts.updType;
	$scope.tbData = $("[ab-main]").attr("ab-main");

	A_Session.sessionSetCur($scope,$scope.tbData)
	
	
		
	if (!$scope.opts.idVGB_BPAR)
	{
		A_LocalAgular.setOpts($scope,"idVGB_BPAR");

	}
	
	
	$scope.recPointer = $scope.opts.RECPOINTER;	
	$scope.idVGB_ADDR = $scope.opts.idVGB_ADDR;
	$scope.VGB_ADDR_BPART = $scope.opts.idVGB_BPAR;
	
	$scope.ce = "idVGB_ADDR"
	$scope.obj = "idVGB_ADDR"
	$scope.tbl = "vgb_addr"
	$scope.ab_upd = "vgb_addr"
	



	var availableTags = [];
	$("[ab-autocomplete]").autocomplete({source: availableTags});

	$scope.kUp = function(ce,obj,tbl)
	{
		performRequest($scope,$http,ce,obj,tbl)
	}
	
	$scope.valDta = function(p1,p2,ev)
	{
		
		if (ev.type == 'blur' || (ev.type == 'keypress' && ev.keyCode == 13))
		{
			$scope.tbl = p2;
			tp = p1.split(",");
			tObj = new Object();
			var occ = 0
			while (occ < tp.length)
			{
				tObj[tp[occ]] = $scope[tp[occ]]
				occ += 1
			}
			$scope.chkDta(tObj)
		}
	}
	
 	$scope.chkDta = function (val)
 	{
 		if (!val)
 		{
 			val = new Object();
 			val[$scope.ce] = $scope.idVGB_ADDR; 			
 		}
 		performChk($scope,$http,val)
 	}
 	$scope.save = function(opt)
 	{
 		performSave($scope,$http,opt)
 	}   
 	
 	// for testing bgn
	$scope.kPress = function(ce,obj,tbl,dir)
	{
		performList($scope,$http,ce,obj,tbl,dir,1)
	} 
	// for testing end
	
	 	tObj = new Object();
 		tObj[$scope.ce] = $scope.idVGB_ADDR;
 		tObj['VGB_ADDR_BPART'] = $scope.VGB_ADDR_BPART;
	$scope.chkObj = tObj 		
 	$scope.chkDta(tObj) 
 	
 	chkReadonly();
 	$scope.kPress('VGB_ADDR_BPART','idVGB_BPAR','vgb_bpar',0);
 	
}

A_LocalAgularFn.prototype.VGB_CUSTCT = function($scope,$http,$routeParams) 
{
 
	// Not being used example of Local controller
	
			$scope.message = 'Customers' ;
			$scope.errno = 0;
			$scope.error = "";
			
			
			
			$scope.utype = $scope.opts.updType;
		
			if (!$scope.opts.idVGB_BPAR)
			{
				A_LocalAgular.setOpts($scope,"idVGB_BPAR");

			}
				
					
			
			$scope.recPointer = $scope.opts.RECPOINTER;
			$scope.idVGB_CUST = $scope.opts.idVGB_CUST;
			$scope.VGB_CUST_BPART = $scope.opts.idVGB_BPAR;
			// ce  = input field ID
			// obj = Data field ID
			// tbl = Data table name
			
			
			$scope.ce = "idVGB_CUST"
			$scope.obj = "idVGB_CUST"
			$scope.tbl = "vgb_cust"
			$scope.ab_upd = "vgb_cust"
			
			// commonScope($scope)
			
			
			var availableTags = [];
			$("[ab-autocomplete]").autocomplete({source: availableTags});
		
			$scope.rfs = function(obName)
			{
				$scope[obName] = $("[ng-model='"+obName+"']").val();
			}
		
			$scope.kAC = function(ce,obj,tbl)
			{
		
				performAutoComplete($scope,$http,ce,obj,tbl)
			}
				
			$scope.kUp = function(ce,obj,tbl)
			{
		
				performRequest($scope,$http,ce,obj,tbl)
			}
		 	$scope.chkDta = function (val)
		 	{
		 		if (!val)
		 		{
		 			val = $scope.chkObj;
		 		}
		 		performChk($scope,$http,val)
		 	}
		 	$scope.save = function(opt)
		 	{
		 		performSave($scope,$http,opt)
		 	}   
		 	$scope.scopeUpd = function(xname,xval)
		 	{
		 		$scope[xname]=xval
		 		// alert(xval)
		 	}
			
		 	tObj = new Object();
		 	// tObj[$scope.ce] = $scope.idVGB_CUST;
		 	tObj['VGB_CUST_BPART'] = $scope.VGB_CUST_BPART;
		 	$scope.chkObj = tObj
		 	$scope.chkDta(tObj)  
		 	
		 	chkReadonly();
		 	$scope.main = function()
		 	{
		 		
			 	performList($scope,$http,'VGB_CUST_BPART','idVGB_BPAR','vgb_bpar',0,1)
			}
			$scope.match = true;
			$scope.main()
		 	$scope.match = false;
	 	
}


A_LocalAgularFn.prototype.VGB_SUPPCT = function($scope,$http,$routeParams) 
{
 
 
// 	try
// 	{
// 		setLocalScope();
// 	}catch(er){}
 
 	// alert("vgb_suppctController" + A_ReporterFn.reportRaw + " --- " + A_ReporterFn.reportBuffer.length);
 	

	$scope.message = 'Supplier';
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype =$scope.opts.updType;	

	$scope.tbData = $("[ab-main]").attr("ab-main");
	if ($scope.tbData == "vgb_supp" )
	{	
		// alert("SUPP:" + A_BaseStdFn.getLocal() + "RAW:"+A_BaseStdFn.reportRaw);
	}
	A_Session.sessionSetCur($scope,$scope.tbData)
	

	if (!$scope.opts.idVGB_BPAR)
	{
		A_LocalAgular.setOpts($scope,"idVGB_BPAR");

	}
	
	$scope.recPointer = $scope.opts.RECPOINTER;
	$scope.idVGB_SUPP = $scope.opts.idVGB_SUPP;
	$scope.VGB_SUPP_BPART = $scope.opts.idVGB_BPAR;
	// ce  = input field ID
	// obj = Data field ID
	// tbl = Data table name
	
	
	$scope.ce = "idVGB_SUPP"
	$scope.obj = "idVGB_SUPP"
	$scope.tbl = "vgb_supp"
	$scope.ab_upd = "vgb_supp"
	
	var availableTags = [];
	$("[ab-autocomplete]").autocomplete({source: availableTags});

	$scope.kUp = function(ce,obj,tbl)
	{
		performRequest($scope,$http,ce,obj,tbl)
	}
 	$scope.chkDta = function (val)
 	{
 		if (!val)
 		{
 			val = $scope.chkObj;
 		}
 		performChk($scope,$http,val)
 	}
 	$scope.save = function(opt)
 	{
 		performSave($scope,$http,opt)
 	}   
 	
 	$scope.main = function()
 	{
 		performList($scope,$http,'VGB_SUPP_BPART','idVGB_BPAR','vgb_bpar',0,1)
 	}	
	 	
 	
 	tObj = new Object();
 	// tObj[$scope.ce] = $scope.idVGB_SUPP; 
 	// Tested remove previous line Removed on May 05 2015 Access testing
 	tObj['VGB_SUPP_BPART'] = $scope.VGB_SUPP_BPART;
 	$scope.chkObj = tObj
 	$scope.chkDta(tObj)  
 	
 	chkReadonly();
 	$scope.match = true;
 	$scope.main();
 	$scope.match = false;
 	   
}




A_LocalAgularFn.prototype.setOpts = function($scope,sName)
{
		
	var wObj = A_Session.getHistory($scope.opts.Session,0)
	var occ = 0;
	while (wObj && !wObj[sName])
	{
		occ += 1;
		wObj = A_Session.getHistory($scope.opts.Session,occ)
	}
	if (wObj[sName])
	{
		$scope.opts = wObj;
	}
	else
	{

		var wObj = A_Session.getHistory(sName,0)
		var occ = 0;
		while (wObj && !wObj[sName])
		{
			occ += 1;
			wObj = A_Session.getHistory(sName,occ)
		}
		if (wObj[sName])
		{
			$scope.opts[sName] = wObj[sName];
		}
		else
		{
		
			window.history.back();
		}
	}
}




</script>
