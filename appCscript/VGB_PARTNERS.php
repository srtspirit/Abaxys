
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


	A_Scope.setProcess($scope);
	
	$scope.ABunloadExe["vgb_cust"] = "dbMain";
	$scope.ABunloadExe["vgb_addr"] = "dbChk";		
	
	$scope.A_reload = function()
	{

		if ($scope.opts.Session == "VGB_CUSTCT")
		{
			$('#ab-back').attr("href","#VGB_PARTNERS/VGB_CUSTCT/Process:VGB_PARTNERS,Session:VGB_CUSTCT,tblName:vgb_cust,updType:CREATE,idVGB_BPAR:0,VGB_BPAR_BPART:,tbData:vgb_cust")
		}
		else
		{
			$('#ab-back').attr("href","#VGB_PARTNERS/VGB_SUPPCT/Process:VGB_PARTNERS,Session:VGB_SUPPCT,tblName:vgb_supp,updType:CREATE,idVGB_BPAR:0,VGB_BPAR_BPART:,tbData:vgb_supp")
		}
			
		$('#ab-back').click();
		
		
		// location.reload();
	}

	// Made common for VGB_SVIACT AND VGB_CUSTCT
	$scope.detCustomerDetail = function(custId)
	{

		var mainTbl = "vgb_svia";
		var suppTbls = "vgb_supp:idVGB_SUPP = VGB_SVIA_SUPPID ";
		var alias = "vgb_cust_svia";
		var pattern = "[=SPE=] VGB_SVIA_CUSTID = " + custId + " ";
		var orderBy = "VGB_SUPP_BPNAM";
		var objFunctions = "";
		var objGroupBy = "";
		
		$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"",objFunctions,objGroupBy);
		
	}	
	
	
	$scope.getBanks =function()
	{
		// $scope["VGB_BANK_BNKID"] ='';
		// $scope.ABlstAlias('VGB_BANK_BNKID','VGB_BANK_BNKID','vgb_bank','vgb_bank');
	}
			
	$scope.A_chkRec = function(p1,p2,ev,evCk)
	{
		
		var evc = evCk.split(",")
		
		if (evc[0].indexOf(ev.type)>-1 && (evc.length == 1 || ev.keyCode == evc[1]))
		
//		if (ev.type == 'blur' || (ev.type == 'keypress' && ev.keyCode == 13))
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
	
	$scope.A_validate = function(tVal,tbl)
 	{
 		var vObj = tVal.split(",")
 		var val = new Object();
 		var occ = 0;
 		while (occ < vObj.length)
 		{
 			val[vObj[occ]] = $scope[vObj[occ]];
 			
			occ += 1; 			
 		}
 
 		A_Scope.dbValidate($scope,$http,val,tbl)
		
	
	}
	
	$scope.chk_vgb_addr = function()
	{
		
		if ($scope.opts.idVGB_BPAR > 0)
		{
			
			$scope.match = true;
			$scope['VGB_ADDR_BPART']  = $scope.opts.idVGB_BPAR;
			$scope.aliasName = "VGB_ADDRCT";
			
			A_Scope.dbList($scope,$http,'VGB_ADDR_BPART','VGB_ADDR_BPART','vgb_addr',0,100)
			$scope.match = false;
						
		}	
	
	}

	$scope.setNewAddId = function()
	{
		$scope.ABupdChkObj('idVGB_ADDR',0,true);
		A_Scope.callBack = "$scope.getNextAddId();";
		$scope.ABchk(null,'vgb_addr');
	}
	
	$scope.getNextAddId = function()
	{
		
		$scope.VGB_ADDR_LASTID = 0
		var  occ = 0;
		while (occ < $scope.VGB_ADDRCT.length)
		{
			if (occ == 0)
			{
				$scope.VGB_ADDR_ADNAM = $scope.VGB_ADDRCT[occ].VGB_ADDR_ADNAM
				$scope.VGB_ADDR_PRSID = $scope.VGB_ADDRCT[occ].VGB_ADDR_PRSID
				$scope.VGB_ADDR_CNTID = $scope.VGB_ADDRCT[occ].VGB_ADDR_CNTID
				$scope.VGB_ADDR_SCHID = $scope.VGB_ADDRCT[occ].VGB_ADDR_SCHID
				$scope.VGB_ADDR_PCHID = $scope.VGB_ADDRCT[occ].VGB_ADDR_PCHID
			}
			$scope.VGB_ADDR_LASTID = Math.max($scope.VGB_ADDR_LASTID,$scope.VGB_ADDRCT[occ].VGB_ADDR_ADDID);
			occ += 1;
		}
		
		$scope.VGB_ADDR_LASTID += 10
		
		$scope.idVGB_ADDR = 0;
		$scope.VGB_ADDR_BPART = $scope.idVGB_BPAR;
		$scope.VGB_ADDR_ADDID = $scope.VGB_ADDR_LASTID;
		
	}

	$scope.val_vgb_addr = function()
	{

		
		var tObj = new Object();
		tObj['idVGB_ADDR']  =  $scope.idVGB_ADDR
		$scope.ce = "VGB_ADDR_BPART"
		$scope.obj = "idVGB_ADDR"
		$scope.tbl = "vgb_addr"
		
		$scope.chkMain(tObj);
			
	
	}

	$scope.val_new_bpar = function()
	{
		
		$scope.match = true;
		$scope['VGB_BPAR_BPART']  = $scope.VGB_BPAR_BPART;
		$scope.aliasName = "VGB_BPARnew";
		
		A_Scope.callBack = "$scope.set_new_bpar(data['posts']);"
		A_Scope.dbList($scope,$http,'VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',0,100)
		$scope.match = false;
	
	}
	
//		$scope.set_new_bpar = function(dta)
//		{
//			if (dta.rowCount > 0)
//			{
//				$("[ng-model='VGB_BPAR_BPART']").focus();
//				$scope.VGB_BPAR_BPART_newMess = "Already exists!!! " + $scope.VGB_BPARnew[0].VGB_CUST_BPART + "<-" + $scope.VGB_BPARnew[0].idVGB_BPAR + "->" + $scope.VGB_BPARnew[0].VGB_SUPP_BPART
//			}
//			else
//			{
//				$scope.VGB_BPAR_BPART_newMess = "";
//			}
//			
//		}
				

	$scope.set_new_bpar = function(dta)
	{
		if (dta.rowCount > 0)
		{
			if ($scope.opts.Session == "VGB_CUSTCT")
			{
				if ($scope.VGB_BPARnew[0].VGB_CUST_BPART > 0)
				{
					$("[ng-model='VGB_BPAR_BPART']").focus();
					$scope.VGB_BPAR_BPART_newMess = "Already exists!!! " ;
				}
				else
				{
					if ($scope.VGB_BPARnew[0].idVGB_SUPP > 0)
					{
						$scope.isPartnerOther = "Exists  as supplier!!! " ;
						
					}
					
					
					$scope.resetScope();
					$scope.idVGB_BPAR = $scope.VGB_BPARnew[0].VGB_SUPP_BPART;
					$scope.VGB_CUST_BPART = $scope.VGB_BPARnew[0].VGB_SUPP_BPART;
					$scope.VGB_CUST_BPNAM = $scope.VGB_BPARnew[0].VGB_SUPP_BPNAM;
					
					$scope.VGB_CUST_BTADD = $scope.VGB_BPARnew[0].idVGB_ADDR;
					$scope.VGB_CUST_STADD = $scope.VGB_BPARnew[0].idVGB_ADDR;
					
					$scope.idVGB_ADDR = $scope.VGB_BPARnew[0].idVGB_ADDR;
					$scope.VGB_ADDR_DESCR = $scope.VGB_BPARnew[0].VGB_ADDR_DESCR;
					

//					var tObj = new Object;
//					tObj["VGB_CUST_BPART"] = $scope.VGB_BPARnew[0].idVGB_BPAR;
//					A_Scope.callBack = "";
//					A_Scope.dbChk($scope,$http,tObj)
				}
			}
			else
			{
				if ($scope.VGB_BPARnew[0].VGB_SUPP_BPART > 0)
				{
					$("[ng-model='VGB_BPAR_BPART']").focus();
					$scope.VGB_BPAR_BPART_newMess = "Already exists!!! " ;
				}
				else
				{
					if ($scope.VGB_BPARnew[0].idVGB_CUST > 0)
					{
						$scope.isPartnerOther = "Exists as customer!!! " ;
					}
					
					$scope.resetScope();
					$scope.idVGB_BPAR = $scope.VGB_BPARnew[0].VGB_CUST_BPART;
					$scope.VGB_SUPP_BPART = $scope.VGB_BPARnew[0].VGB_CUST_BPART;
					$scope.VGB_SUPP_BPNAM = $scope.VGB_BPARnew[0].VGB_CUST_BPNAM;
					
					$scope.VGB_SUPP_BTADD = $scope.VGB_BPARnew[0].idVGB_ADDR;
					$scope.VGB_SUPP_STADD = $scope.VGB_BPARnew[0].idVGB_ADDR;
					
					$scope.idVGB_ADDR = $scope.VGB_BPARnew[0].idVGB_ADDR;
					$scope.VGB_ADDR_DESCR = $scope.VGB_BPARnew[0].VGB_ADDR_DESCR;


					// var tObj = new Object;
					// tObj["VGB_SUPP_BPART"] = $scope.VGB_BPARnew[0].idVGB_BPAR;
					// A_Scope.callBack = "";
					// A_Scope.dbChk($scope,$http,tObj)
				}
			}

			$("[ab-menu='vgb_addr']").addClass("hidden");
			

		}
		else
		{
			$("[ab-menu='vgb_addr']").removeClass("hidden"); 
			$scope.VGB_BPAR_BPART_newMess = "";
		}
		
	}

	$scope.isPartnerOther = "";

	// A_LocalAgular.VGB_PARTNERS($scope,$http,$routeParams);
	A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	

}

A_LocalAgularFn.prototype.VGB_PARTNERS = function($scope,$http,$routeParams) 
{
	
	$scope.ABmaxPerPageSet(0);
	currentPerPage = 0;
	$scope.ablabelVGB_CUSTCT = $("[ab-label='VGB_CUSTCT']").html()
	$scope.ablabelVGB_SUPPCT = $("[ab-label='VGB_SUPPCT']").html()
	$scope.ablabelVGB_ADDRCT = $("[ab-label='VGB_ADDRCT']").html()
	

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
	



	A_Session.sessionSetCur($scope,$scope.tbData)
	
//	$scope.message = '' ; 
	
	// getMaxPerPage(currentPerPage);

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

	}

	if ($scope.tbData == "vgb_supp")
	{
		$scope.ce = "VGB_BPAR_BPART"
		$scope.obj = "VGB_BPAR_BPART"
		$scope.tbl = "vgb_supp"
		$scope.VGB_SUPP_BPNAM = ""

	}

// $("#ab-mainlst").val("#default")
	
	$scope.currentKey = function(obj)
	{
		currentKey = obj
	}
	
	$scope.kPress = function(ce,obj,tbl,dir)
	{
	
		$scope.aliasName = "vgb_bpar";
		// $('#focusGrid').val(showProps(out,'out') + showProps(dDta.dbList,'dta') + showProps(dDta.dbList.clause,'Clause')+ showProps(dDta.dbList.E_POST,'EPO'));"
		A_Scope.dbList($scope,$http,ce,obj,tbl,dir,currentPerPage)
		
	} 
	
// AC20150824	
//	$scope.updNew = function()
//	{
//		 updNewDb($scope,$http)
//	}
// AC20150824	
	
// 	$scope.save = function(opt)
// 	{
//		
// 		//A_Scope.dbUpd($scope,$http,opt)
// 	}   



	$scope.aliasName = "vgb_bpar";
	if (!$scope.opts.VGB_BPAR_BPART || $scope.opts.VGB_BPAR_BPART == "null" )
	{
		$scope.VGB_BPAR_BPART = '';
	}
	else
	{
	 	$scope.VGB_BPAR_BPART = $scope.opts.VGB_BPAR_BPART;
	}

 	A_Scope.callBack = "tblInfo($scope,$http);";
 	A_Scope.callBack += '$("[ng-model=' + "'VGB_BPAR_BPART']" + '").focus();';
 	$scope.kPress($scope.ce,$scope.obj,$scope.tbl,0);


 	// $("[ab-formObj='ButtonCreate']").removeClass("hidden");
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
	A_Scope.tblInfo($scope,$http)
	commonScope($scope)
	
	$scope.kUp = function(ce,obj,tbl)
	{
		
		A_Scope.dbAutoFill($scope,$http,ce,obj,tbl)
		
		
	}
 	$scope.chkDta = function (val)
 	{
 		if (!val)
 		{
 			val = new Object();
 			val[$scope.ce] = $scope.VGB_BPAR_BPART; 			
 			
 		}
 
 		A_Scope.dbChk($scope,$http,val)
 		// performChk ($scope,$http,val)
 		
 	}
 	
 	$scope.ABupd = function(opt)
 	{
 		A_Scope.dbUpd($scope,$http,opt);
 		
 	}   
 	
 	
 	tObj = new Object();
 	tObj[$scope.ce] = $scope.VGB_BPAR_BPART;
 	$scope.chkObj = tObj
 	$scope.chkDta(tObj)

//	$scope.qRefresh($scope,$http)

 	A_Scope.dbList($scope,$http,'VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',0,1)	
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
	
	$scope.vgb_bpar = $scope.opts;
	
	
	
	$scope.recPointer = $scope.opts.RECPOINTER;	
	$scope.idVGB_ADDR = $scope.opts.idVGB_ADDR;
	$scope.VGB_ADDR_BPART = $scope.opts.idVGB_BPAR;
	
	$scope.ce = "idVGB_ADDR"
	$scope.obj = "idVGB_ADDR"
	$scope.tbl = "vgb_addr"
	$scope.ab_upd = "vgb_addr"
	
	A_Scope.tblInfo($scope,$http)


	
	$scope.kUp = function(ce,obj,tbl)
	{
		A_Scope.dbAutoFill($scope,$http,ce,obj,tbl)
	}
	

	
 	$scope.chkDta = function (val)
 	{
 		if (!val)
 		{
 			val = new Object();
 			val[$scope.ce] = $scope.idVGB_ADDR; 			
 		}
 		A_Scope.dbChk($scope,$http,val)
 	}
 	
 	$scope.ABupd = function(opt)
 	{
 		$("[ng-model='VGB_ADDR_SCHID']").val($scope.VGB_ADDR_PRSID);
 		$("[ng-model='VGB_ADDR_PCHID']").val($scope.VGB_ADDR_PRSID);
 		
 		if ($scope.VGB_ADDR_BPART==0)
 		{
			$scope.ce = "idVGB_BPAR"
			$scope.obj = "idVGB_BPAR"
			$scope.tbl = "vgb_bpar"
			$scope.VGB_BPAR_BPART = $scope.vgb_bpar.VGB_BPAR_BPART
			$scope.VGB_BPAR_BPNAME = $scope.vgb_bpar.VGB_BPAR_BPNAME
			$("[ab-main]").attr("ab-main","vgb_bpar");
 			A_Scope.dbUpd($scope,$http,opt)
 		}	
		$("[ab-main]").attr("ab-main","vgb_addr");
		$scope.ce = "idVGB_ADDR"
		$scope.obj = "idVGB_ADDR"
		$scope.tbl = "vgb_addr"
 		
 		A_Scope.dbUpd($scope,$http,opt)

 	}   
 	
 	// for testing bgn
	$scope.kPress = function(ce,obj,tbl,dir)
	{
		// ADDRCT
		if (!$scope.rawResult[tbl] || $scope.rawResult[tbl].length < 1)
		{
			A_Scope.dbList($scope,$http,ce,obj,tbl,dir,1)
		}
		
	} 
	// for testing end
	
	 	tObj = new Object();
 		tObj[$scope.ce] = $scope.idVGB_ADDR;
 		tObj['VGB_ADDR_BPART'] = $scope.VGB_ADDR_BPART;
	$scope.chkObj = tObj 		

// 	$scope.chkDta(tObj) 
 	
 	chkReadonly();
 	


	$scope.chkMain();

	setTimeout("checkChange()",100)
	 	
// 	$scope.match = true;
// 	$scope.kPress('VGB_ADDR_BPART','idVGB_BPAR','vgb_bpar',0);
// 	$scope.match = false;
 	
}

A_LocalAgularFn.prototype.VGB_CUSTCT = function($scope,$http,$routeParams) 
{

	<?php require_once "../appCscript/VGB_PARTNERS_VGB_CUSTCT.php"; ?>

}



A_LocalAgularFn.prototype.VGB_SUPPCT = function($scope,$http,$routeParams) 
{

	<?php require_once "../appCscript/VGB_PARTNERS_VGB_SUPPCT.php"; ?> 

}

A_LocalAgularFn.prototype.VGB_SVIACT = function($scope,sName)
{

	$scope.callLister = function()
	{
		var mainTbl = "vin_item";
		var alias = "Andrey";
		
		$scope.ABLister(mainTbl,alias);
		
	}	
	
	$scope.initDisplayData = function()
	{
		//$scope.ABsearchAlias = function(mainTbl,suppTbls,pattern,alias,orderBy,callBack,objFunctions,objGroupBy)
		var mainTbl = "vgb_svia";
		var suppTbls = "vgb_supp:idVGB_SUPP = VGB_SVIA_SUPPID ";
		var alias = "vgb_supp_stats";
		var pattern = "";
		var orderBy = "";
		var objFunctions = " COUNT(VGB_SVIA_SUPPID) as recCountSupp ";
		var objGroupBy = "VGB_SVIA_SUPPID";
		$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,A_Scope.callBack,objFunctions,objGroupBy);
		
	}
	
	$scope.initDisplayCust = function()
	{
		var mainTbl = "vgb_svia";
		var suppTbls = "vgb_cust:idVGB_CUST = VGB_SVIA_CUSTID ";
		var alias = "vgb_cust_stats";
		var pattern = "";
		var orderBy = "";
		var objFunctions = " COUNT(VGB_SVIA_CUSTID) as recCountCust ";
		var objGroupBy = "VGB_SVIA_CUSTID";
		$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"",objFunctions,objGroupBy);
		
	}	

	
	$scope.chkPartnerOptions = function()
	{
		
		if ($scope.opts.idVGB_CUST)
		{
			$scope.recDefault["VGB_SVIA_CUSTID"] = $scope.opts.idVGB_CUST;
		}
		if ($scope.opts.idVGB_SUPP)
		{
			$scope.recDefault["VGB_SVIA_SUPPID"] = $scope.opts.idVGB_SUPP;
		}
		
	}
	
	$scope.detSuppierDetail = function(suppId)
	{
		$scope.last_SUPPID = suppId;
		
		var mainTbl = "vgb_svia";
		var suppTbls = "vgb_cust:idVGB_CUST = VGB_SVIA_CUSTID ";
		var alias = "vgb_supp_detail";
		var pattern = "[=SPE=] VGB_SVIA_SUPPID = " + suppId + " ";
		var orderBy = "VGB_CUST_BPNAM";
		var objFunctions = "";
		var objGroupBy = "";
		
		$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"",objFunctions,objGroupBy);
		
	}	

//	$scope.detCustomerDetail = function(custId)
//	{
//		$scope.last_CUSTID = custId;
//		
//		var mainTbl = "vgb_svia";
//		var suppTbls = "vgb_supp:idVGB_SUPP = VGB_SVIA_SUPPID ";
//		var alias = "vgb_cust_detail";
//		var pattern = "[=SPE=] VGB_SVIA_CUSTID = " + custId + " ";
//		var orderBy = "VGB_SUPP_BPNAM";
//		var objFunctions = "";
//		var objGroupBy = "";
//		
//		$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"",objFunctions,objGroupBy);
//		
//	}	
		
	$scope.editVgb_svia = function(vgb_sviaId,record)
	{
		$scope.recDefault = record;
		var objRead = new Object();
		objRead["idVGB_SVIA"] = vgb_sviaId;
		A_Scope.callBack = "$scope.setRecDefault();";
		$scope.ABchk(objRead,"vgb_svia");
	}
	
	$scope.setRecDefault = function()
	{
		if ($scope.idVGB_SVIA < 1)
		{
			
			if (!$scope.recDefault["recCountCust"])
			{
				$scope.VGB_SVIA_SUPPID = $scope.recDefault["VGB_SVIA_SUPPID"];
			}
			if (!$scope.recDefault["recCountSupp"])
			{
				$scope.VGB_SVIA_CUSTID = $scope.recDefault["VGB_SVIA_CUSTID"];
			}
			$scope.VGB_SVIA_DESCR = $scope.recDefault["VGB_SVIA_DESCR"];
			$scope.VGB_SVIA_DEFAULT = "0";
		}
		
		$scope.readPartners();
	}
	
	$scope.readPartners = function()
	{
		if (!$scope.VGB_SVIA_CUSTID)
		{
			$scope.VGB_SVIA_CUSTID = 0;
		}
		if (!$scope.VGB_SVIA_SUPPID)
		{
			$scope.VGB_SVIA_SUPPID = 0;
		}
		
		var mainTbl = "vgb_bpar";
		var suppTbls = "vgb_cust:VGB_CUST_BPART = idVGB_BPAR ";
		suppTbls += ",vgb_supp:VGB_SUPP_BPART = idVGB_BPAR ";
		var alias = "vgb_bpar_data";
		var pattern = "[=SPE=] idVGB_CUST = " + $scope.VGB_SVIA_CUSTID + " ";
		pattern += "OR idVGB_SUPP = " + $scope.VGB_SVIA_SUPPID + " ";
		var orderBy = "VGB_BPAR_BPART";
		var objFunctions = "";
		var objGroupBy = "";
		
		var callBack = "$scope.detSuppierDetail($scope.last_SUPPID);";
		$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,callBack,objFunctions,objGroupBy);		
	}
	
	$scope.updVal = function(vName,vVal,vObj)
	{
		$scope[vName] = vVal;
		if (vName == "VGB_SVIA_SUPPID")
		{
			$scope.VGB_SVIA_DESCR = vObj["VGB_SUPP_BPNAM"];
		}
		$scope.readPartners();
	}
	
	$scope.last_SUPPID = 0;
	$scope.recDefault = new Object();
	
	var editId = 0;
	if ($scope.opts.idVGB_SVIA)
	{
		editId = $scope.opts.idVGB_SVIA;
	}
	
	A_Scope.callBack = "$scope.editVgb_svia(" + editId + ",$scope.recDefault);";
	
	$scope.chkPartnerOptions();
	$scope.initDisplayData();	
	
	
	
	
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
