

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
		A_Scope.dbList($scope,$http,ce,obj,tbl,dir,1)
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

	$('#ab-back').attr("href","#VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_cust")
	
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

		
			$scope.ce = "idVGB_CUST"
			$scope.obj = "idVGB_CUST"
			$scope.tbl = "vgb_cust"
			$scope.ab_upd = "vgb_cust"

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
				
				if (dta.dbFnct == "dbDelRec" && dta.errorCode == 0 && dta.tblInfo.tblName == "vgb_addr")
				{
					$scope.opts.idVGB_ADDR  = 0;
				}

				if (dta.dbFnct == "dbDelRec"  && dta.errorCode == 0 && dta.tblInfo.tblName == "vgb_cust")
				{
					$('#ab-back').click();
				}
								
				if ( (dta.dbFnct == "dbInsRec" || dta.dbFnct == "dbOrgShare") && dta.errorCode == 0 && dta.tblInfo.tblName == "vgb_cust")
					
				{
					$('#ab-back').attr("href","#VGB_PARTNERS/VGB_CUSTCT/idVGB_BPAR:" + $scope.idVGB_BPAR +",updType:UPDATE,Session:VGB_CUSTCT,Process:VGB_PARTNERS")
					$('#ab-back').click();
					
				}		
				
								
				$("#controllerGrid").val(dta.dbFnct + " Err=" + dta.errorCode  + " Tbl= " + dta.tblInfo.tblName)

			}
			
		 	$scope.ABupd = function(opt)
		 	{
		 		
		 		
				if (opt == "BORROW" )	 
				{
					A_Scope.callBack = 'if (data["posts"].errorCode==0){location.reload();}else{$scope.saveSuccess(data["posts"]);};';
					A_Scope.dbUpd($scope,$http,opt)
				}
				else
				{		
			 		if ($scope.idVGB_BPAR > 0)
			 		{
			 			
			 			A_Scope.callBack = 'if (data["posts"].errorCode==0){$scope.saveSuccess(data["posts"]);$scope.custInit();' + $("[ab-updSuccess]").val() + '}else{$scope.saveSuccess(data["posts"]);};';
	
				 		A_Scope.dbUpd($scope,$http,opt)
				 	}
					else
					{
					
						$scope.saveAll(opt)
					} 	
				}
		 	}  
		 	 
		 	$scope.saveAll = function(opt)
		 	{
				var eExec = $("[ab-updSuccess]").val();
				
		 		$("#mainForm").attr("ab-main","vgb_bpar");
		 		A_Scope.callBack = '$("#mainForm").attr("ab-main","' + $("#mainForm").attr("ab-main") + '");';
		 		A_Scope.callBack += "if (data['posts'].errorCode==0){$scope.idVGB_BPAR = data['posts'].result[0].idVGB_BPAR;$('#VGB_PARTNERrfs').click();" + eExec + " }"
		 		A_Scope.dbUpd($scope,$http,opt);
		 		
			}
	
					 	

		 	$scope.main = function()
		 	{
		 		
			 	A_Scope.dbList($scope,$http,'VGB_CUST_BPART','idVGB_BPAR','vgb_bpar',0,1)
			}


			$scope.chk_vgb_bpar = function()
			{
				
				$scope.match = true;
				$scope['VGB_BPAR_BPART']  = $scope.opts.VGB_BPAR_BPART;
				$scope.aliasName = "VGB_BPARCT";
				
				A_Scope.callBack = "$scope.set_VGB_BPARCT();"
				A_Scope.dbList($scope,$http,'VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',0,100)
				$scope.match = false;
			
			}
			
			$scope.set_VGB_BPARCT = function()
			{
				
				if ($scope.VGB_BPARCT[0].idVGB_BPAR && $scope.VGB_BPARCT[0].idVGB_BPAR > 0)
				{
					if($scope.VGB_BPARCT[0].idVGB_SUPP && $scope.VGB_BPARCT[0].idVGB_SUPP > 0)
					{
						$scope.isPartnerOther = "Exists 33 as supplier";

						$scope.idVGB_BPAR = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.opts.idVGB_BPAR = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.VGB_CUST_BPART = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.vgb_cust[0].VGB_CUST_BPART = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.VGB_CUST_BPNAM = $scope.VGB_BPARCT[0].VGB_BPAR_BPNAM;
						$scope.vgb_cust[0].VGB_CUST_BPNAM = $scope.VGB_BPARCT[0].VGB_BPAR_BPNAM;
						// $scope.VGB_ADDR_ = $scope.VGB_BPARCT[0].idVGB_ADD;
						
						
						
						if ($scope.VGB_BPARCT[0].idVGB_ADDR && $scope.VGB_BPARCT[0].idVGB_ADDR > 0)
						{
							$scope.idVGB_ADDR = $scope.VGB_BPARCT[0].idVGB_ADDR;
							$scope.VGB_CUST_BTADD = $scope.VGB_BPARCT[0].idVGB_ADDR;
							$scope.vgb_cust[0].VGB_CUST_BTADD = $scope.VGB_BPARCT[0].idVGB_ADDR;
							$scope.VGB_CUST_STADD = $scope.VGB_BPARCT[0].idVGB_ADDR;
							$scope.vgb_cust[0].VGB_CUST_STADD = $scope.VGB_BPARCT[0].idVGB_ADDR;
	
						}
						
						if ($scope.VGB_BPARCT[0].VGB_SUPP_BTADD && $scope.VGB_BPARCT[0].VGB_SUPP_BTADD > 0)
						{
							
							$scope.idVGB_ADDR = $scope.VGB_BPARCT[0].VGB_SUPP_BTADD;
							$scope.VGB_CUST_BTADD = $scope.VGB_BPARCT[0].VGB_SUPP_BTADD;
							$scope.vgb_cust[0].VGB_CUST_BTADD = $scope.VGB_BPARCT[0].VGB_SUPP_BTADD;
							$scope.VGB_CUST_STADD = $scope.VGB_BPARCT[0].VGB_SUPP_BTADD;
							$scope.vgb_cust[0].VGB_CUST_STADD = $scope.VGB_BPARCT[0].VGB_SUPP_BTADD;
							$scope.VGB_CUST_BPNAM = $scope.VGB_BPARCT[0].VGB_SUPP_BPNAM;
							$scope.vgb_cust[0].VGB_CUST_BPNAM = $scope.VGB_BPARCT[0].VGB_SUPP_BPNAM;
	
							$scope.idVGB_CURR  = $scope.VGB_BPARCT[0].VGB_SUPP_CURID;
							$scope.vgb_cust[0].idVGB_CURR  = $scope.VGB_BPARCT[0].VGB_SUPP_CURID;
							$scope.VGB_CUST_CURID = $scope.VGB_BPARCT[0].VGB_SUPP_CURID;
							$scope.vgb_cust[0].VGB_CUST_CURID = $scope.VGB_BPARCT[0].VGB_SUPP_CURID;
							
	
						}
						
						A_Scope.callBack = "$scope.val_vgb_addr();"
						$scope.chk_vgb_addr()
					}
					else						
					{
						var obj = new Object();
						obj["VGB_CUST_BPART"] = $scope.VGB_BPARCT[0].idVGB_BPAR;
			 			$scope.chkObj = obj
			 			$scope.tbl = "vgb_cust"
						$scope.chkMain();
						$scope.isPartnerOther = "Exists as customer " + $scope.VGB_BPARCT[0].VGB_BPAR_BPNAM;
					}				
				}
				
			}

						

			$scope.resetScope = function()
			{			
			
				$scope.ce = "idVGB_CUST"
				$scope.obj = "idVGB_CUST"
				$scope.tbl = "vgb_cust"
				$("#ab-back > img").attr("href","#VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_cust,VGB_BPAR_BPART:"+$scope.VGB_BPAR_BPART)
			}
			

			$scope.kPress = function(ce,obj,tbl,dir)
			{
				
				A_Scope.dbList($scope,$http,ce,obj,tbl,dir,currentPerPage)
				
			} 


			
			$scope.custInit = function()
			{
				
				$scope.resetScope();
			
				$scope.vgb_bpar = null;
				$scope.vgb_cust = null;
				$scope.vgb_addr = null;
				
			 	tObj = new Object();
			 	tObj['idVGB_CUST'] = $scope.idVGB_CUST;
			 	$scope.chkObj = tObj
			 	
				
				A_Scope.callBack = "";
				
				if ($scope.opts.VGB_BPAR_BPART)
				{
					A_Scope.callBack += "$scope.VGB_BPAR_BPART = $scope.opts.VGB_BPAR_BPART;$scope.VGB_ADDR_ADDID=10;";
					A_Scope.callBack += "$scope.chk_vgb_bpar();";
				}
				else
				{
					
					A_Scope.callBack += "$scope.chk_vgb_addr();";
//					if ($scope.opts.idVGB_ADDR == 0 )
//					{
//						A_Scope.callBack += "$scope.idVGB_ADDR=0;$scope.VGB_ADDR_LASTID=$scope.VGB_ADDR_ADDID;$scope.A_validate('VGB_ADDR_ADDID,VGB_ADDR_BPART','vgb_addr');$scope.VGB_ADDR_ADDID=$scope.VGB_ADDR_LASTID;$scope.opts.idVGB_ADDR=null;";
//						// A_Scope.callBack += "$scope.idVGB_ADDR = $scope.opts.idVGB_ADDR;$scope.opts.idVGB_ADDR=null;";
//					}
				}	
				
				A_Scope.callBack += "$scope.resetScope();$scope.supportBase();";
				A_Scope.callBack += "$('#ab-back').attr('href','#VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_cust,VGB_BPAR_BPART:'+$scope.VGB_BPAR_BPART);";
				$scope.chkMain();
				$("[ng-model='VGB_BPAR_BPART']").focus();
				
			}
			
			$scope.setChanges = function()
			{
				setTimeout('checkChange()',100)
				
			}
			$scope.supportBase = function()
			{

				A_Scope.callBack = "$scope.VGB_TERM_TERID='" + $scope.VGB_TERM_TERID +"';"
				$scope.VGB_TERM_TERID = "";
				$scope.aliasName = "vgb_term"
				A_Scope.dbList($scope,$http,'VGB_TERM_TERID','VGB_TERM_TERID','vgb_term',0,100)
				
				A_Scope.callBack = "$scope.VGB_CURR_CURID='" + $scope.VGB_CURR_CURID +"';"
				$scope.VGB_CURR_CURID = "";
				$scope.aliasName = "vgb_curr"
				A_Scope.dbList($scope,$http,'VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0,100)
				
			}
				
			$scope.supportTBL = function()
			{
				
				A_Scope.callBack = "$scope.VGB_PRST_PRSID='" + $scope.VGB_PRST_PRSID + "';"
				$scope.VGB_PRST_PRSID = "";
				$scope.aliasName = "vgb_prst"
				A_Scope.dbList($scope,$http,'VGB_PRST_PRSID','VGB_PRST_PRSID','vgb_prst',0,100)

				A_Scope.callBack = "$scope.VGB_CNTR_CNTID='" + $scope.VGB_CNTR_CNTID + "';"
				$scope.VGB_CNTR_CNTID = "";
				$scope.aliasName = "vgb_cntr"
				A_Scope.dbList($scope,$http,'VGB_CNTR_CNTID','VGB_CNTR_CNTID','vgb_cntr',0,100)
				
				A_Scope.callBack = "$scope.VTX_SCHH_SCHID='" + $scope.VTX_SCHH_SCHID +"';"
				$scope.VTX_SCHH_SCHID = "";
				$scope.aliasName = "vtx_schh"
				A_Scope.dbList($scope,$http,'VTX_SCHH_SCHID','VTX_SCHH_SCHID','vtx_schh',0,100)
				
				
			}
			

//		 	tObj = new Object();
//		 	tObj['idVGB_ADDR'] = 0;
//		 	$scope.chkObj = tObj
//		 	$scope.ABchk(tObj,"vgb_addr")
//			
//		
//		 	tObj = new Object();
//		 	tObj['idVGB_CUST'] = 0;
//		 	$scope.chkObj = tObj
//		 	$scope.ABchk(tObj,"vgb_cust")
		 	
			// flipHidden('.collps',true);flipHidden('.collps-on',false);

			
			$scope.custInit();


}



A_LocalAgularFn.prototype.VGB_SUPPCT = function($scope,$http,$routeParams) 
{
 
 	$('#ab-back').attr("href","#VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_supp")
 	
			$scope.errno = 0;
			$scope.error = "";

			$scope.utype = $scope.opts.updType;
		
			if (!$scope.opts.idVGB_BPAR)
			{
				A_LocalAgular.setOpts($scope,"idVGB_BPAR");

			}
			
			$scope.recPointer = $scope.opts.RECPOINTER;
			$scope.idVGB_SUPP = $scope.opts.idVGB_SUPP;
			$scope.VGB_SUPP_BPART = $scope.opts.idVGB_BPAR;
	
			$scope.ce = "idVGB_SUPP"
			$scope.obj = "idVGB_SUPP"
			$scope.tbl = "vgb_supp"
			$scope.ab_upd = "vgb_supp"			
			
			

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
				setTimeout('$("#formSaveSuccess").css("color","transparent");',3000)
				
				if (dta.dbFnct == "dbDelRec" && dta.errorCode == 0 && dta.tblInfo.tblName == "vgb_addr")
				{
					$scope.opts.idVGB_ADDR  = 0;
				}
				if ( dta.dbFnct == "dbDelRec"  && dta.errorCode == 0 && dta.tblInfo.tblName == "vgb_supp" )
				{
					$('#ab-back').click();
				}				
				if ( (dta.dbFnct == "dbInsRec" || dta.dbFnct == "dbOrgShare") && dta.errorCode == 0 && dta.tblInfo.tblName == "vgb_supp")
				{
					$('#ab-back').attr("href","#VGB_PARTNERS/VGB_SUPPCT/idVGB_BPAR:" + $scope.idVGB_BPAR +",updType:UPDATE,Session:VGB_SUPPCT,Process:VGB_PARTNERS")
					$('#ab-back').click();
					
				}				
				
				$("#controllerGrid").val(dta.dbFnct + " Err=" + dta.errorCode  + " Tbl= " + dta.tblInfo.tblName)

			}

		 	
		 	$scope.ABupd = function(opt)
		 	{

				if (opt == "BORROW" )	 
				{
					A_Scope.callBack = 'if (data["posts"].errorCode==0){location.reload();}else{$scope.saveSuccess(data["posts"]);};';
					A_Scope.dbUpd($scope,$http,opt)
				}
				else
				{		
			 		
			 		if ($scope.idVGB_BPAR > 0)
			 		{
			 			A_Scope.callBack = 'if (data["posts"].errorCode==0){$scope.saveSuccess(data["posts"]);$scope.suppInit();}else{$scope.saveSuccess(data["posts"]);}';
				 		A_Scope.dbUpd($scope,$http,opt)
				 	}
					else
					{
						$scope.saveAll(opt)
					} 	
				}
		 	} 
		 	  
		 	$scope.saveAll = function(opt)
		 	{
		 		var eExec = $("[ab-updSuccess]").val();
		 		
		 		$("#mainForm").attr("ab-main","vgb_bpar");
		 		A_Scope.callBack = '$("#mainForm").attr("ab-main","' + $("#mainForm").attr("ab-main") + '");';
		 		A_Scope.callBack += "if (data['posts'].errorCode==0){$scope.idVGB_BPAR = data['posts'].result[0].idVGB_BPAR;$('#VGB_PARTNERrfs').click();" + eExec + " }"
		 		A_Scope.dbUpd($scope,$http,opt);
		 		
			}
	
					 	

		 	$scope.main = function()
		 	{
		 		
			 	A_Scope.dbList($scope,$http,'VGB_SUPP_BPART','idVGB_BPAR','vgb_bpar',0,1)
			}


			$scope.chk_vgb_bpar = function()
			{
				
				$scope.match = true;
				$scope['VGB_BPAR_BPART']  = $scope.opts.VGB_BPAR_BPART;
				$scope.aliasName = "VGB_BPARCT";
				
				A_Scope.callBack = "$scope.set_VGB_BPARCT();"
				A_Scope.dbList($scope,$http,'VGB_BPAR_BPART','VGB_BPAR_BPART','vgb_bpar',0,100)
				$scope.match = false;
			
			}
			
		
			$scope.set_VGB_BPARCT = function()
			{
				
				if ($scope.VGB_BPARCT[0].idVGB_BPAR && $scope.VGB_BPARCT[0].idVGB_BPAR > 0)
				{
					if($scope.VGB_BPARCT[0].idVGB_CUST && $scope.VGB_BPARCT[0].idVGB_CUST > 0)
					{					
						$scope.isPartnerOther = "Exists as customer";

						
						$scope.idVGB_BPAR = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.opts.idVGB_BPAR = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.VGB_SUPP_BPART = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.vgb_supp[0].VGB_SUPP_BPART = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.VGB_SUPP_BPNAM = $scope.VGB_BPARCT[0].VGB_BPAR_BPNAM;
						$scope.vgb_supp[0].VGB_SUPP_BPNAM = $scope.VGB_BPARCT[0].VGB_BPAR_BPNAM;
						$scope.VGB_ADDR_ = $scope.VGB_BPARCT[0].idVGB_ADD;
						
						
						
						if ($scope.VGB_BPARCT[0].idVGB_ADDR && $scope.VGB_BPARCT[0].idVGB_ADDR > 0)
						{
							$scope.idVGB_ADDR = $scope.VGB_BPARCT[0].idVGB_ADDR;
							$scope.VGB_SUPP_BTADD = $scope.VGB_BPARCT[0].idVGB_ADDR;
							$scope.vgb_supp[0].VGB_SUPP_BTADD = $scope.VGB_BPARCT[0].idVGB_ADDR;
							$scope.VGB_SUPP_STADD = $scope.VGB_BPARCT[0].idVGB_ADDR;
							$scope.vgb_supp[0].VGB_SUPP_STADD = $scope.VGB_BPARCT[0].idVGB_ADDR;
	
						}
						
						if ($scope.VGB_BPARCT[0].VGB_CUST_BTADD && $scope.VGB_BPARCT[0].VGB_CUST_BTADD > 0)
						{
							
							$scope.idVGB_ADDR = $scope.VGB_BPARCT[0].VGB_CUST_BTADD;
							$scope.VGB_SUPP_BTADD = $scope.VGB_BPARCT[0].VGB_CUST_BTADD;
							$scope.vgb_supp[0].VGB_SUPP_BTADD = $scope.VGB_BPARCT[0].VGB_CUST_BTADD;
							$scope.VGB_SUPP_STADD = $scope.VGB_BPARCT[0].VGB_CUST_BTADD;
							$scope.vgb_supp[0].VGB_SUPP_STADD = $scope.VGB_BPARCT[0].VGB_CUST_BTADD;
							$scope.VGB_SUPP_BPNAM = $scope.VGB_BPARCT[0].VGB_CUST_BPNAM;
							$scope.vgb_supp[0].VGB_SUPP_BPNAM = $scope.VGB_BPARCT[0].VGB_CUST_BPNAM;
	
							$scope.idVGB_CURR  = $scope.VGB_BPARCT[0].VGB_CUST_CURID;
							$scope.vgb_supp[0].idVGB_CURR  = $scope.VGB_BPARCT[0].VGB_CUST_CURID;
							$scope.VGB_SUPP_CURID = $scope.VGB_BPARCT[0].VGB_CUST_CURID;
							$scope.vgb_supp[0].VGB_SUPP_CURID = $scope.VGB_BPARCT[0].VGB_CUST_CURID;
						
						}

						A_Scope.callBack = "$scope.val_vgb_addr();"
						$scope.chk_vgb_addr()


					}
					else						
					{
						var obj = new Object();
						obj["VGB_SUPP_BPART"] = $scope.VGB_BPARCT[0].idVGB_BPAR;
			 			$scope.chkObj = obj
			 			$scope.tbl = "vgb_supp"
						$scope.chkMain();
						$scope.isPartnerOther = "Exists 44 as supplier " + $scope.VGB_BPARCT[0].VGB_BPAR_BPNAM;
					}
											
					
					
				}
				
			}




						

			$scope.resetScope = function()
			{			
			
			
				$scope.ce = "idVGB_SUPP"
				$scope.obj = "idVGB_SUPP"
				$scope.tbl = "vgb_supp"
				$("#ab-back > img").attr("href","#VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_supp,VGB_BPAR_BPART:"+$scope.VGB_BPAR_BPART)
			}
			

			$scope.kPress = function(ce,obj,tbl,dir)
			{
				
				A_Scope.dbList($scope,$http,ce,obj,tbl,dir,currentPerPage)
				
			} 


			
			$scope.suppInit = function()
			{
				$scope.resetScope();

				$scope.vgb_bpar = null;
				$scope.vgb_supp = null;
				$scope.vgb_addr = null;
				
			 	tObj = new Object();
			 	tObj['idVGB_SUPP'] = $scope.idVGB_SUPP;
			 	$scope.chkObj = tObj
			 	
				
				
				A_Scope.callBack = "";
				
				if ($scope.opts.VGB_BPAR_BPART)
				{
					A_Scope.callBack += "$scope.VGB_BPAR_BPART = $scope.opts.VGB_BPAR_BPART;$scope.VGB_ADDR_ADDID=10;";
					A_Scope.callBack += "$scope.chk_vgb_bpar();";
				}
				else
				{
					A_Scope.callBack += "$scope.chk_vgb_addr();";
//					if ($scope.opts.idVGB_ADDR)
//					{
//						
//						A_Scope.callBack += "$scope.idVGB_ADDR = $scope.opts.idVGB_ADDR;$scope.opts.idVGB_ADDR=null;";
//					}					
				}	
				 
				A_Scope.callBack += "$scope.resetScope();$scope.supportBase();";
				A_Scope.callBack += "$('#ab-back').attr('href','#VGB_PARTNERS/VGB_PARTNERS/Process:VGB_PARTNERS,Session:VGB_PARTNERS,tblName:vgb_supp,VGB_BPAR_BPART:'+$scope.VGB_BPAR_BPART);";
				$scope.chkMain();
				$("[ng-model='VGB_BPAR_BPART']").focus();
			}
			
			
			$scope.supportBase = function()
			{

				A_Scope.callBack = "$scope.VGB_TERM_TERID='" + $scope.VGB_TERM_TERID +"';"
				$scope.VGB_TERM_TERID = "";
				$scope.aliasName = "vgb_term"
				A_Scope.dbList($scope,$http,'VGB_TERM_TERID','VGB_TERM_TERID','vgb_term',0,100)
				
				A_Scope.callBack = "$scope.VGB_CURR_CURID='" + $scope.VGB_CURR_CURID +"';"
				$scope.VGB_CURR_CURID = "";
				$scope.aliasName = "vgb_curr"
				A_Scope.dbList($scope,$http,'VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0,100)
				
			}

			$scope.supportTBL = function()
			{
				
				A_Scope.callBack = "$scope.VGB_PRST_PRSID='" + $scope.VGB_PRST_PRSID + "';"
				$scope.VGB_PRST_PRSID = "";
				$scope.aliasName = "vgb_prst"
				A_Scope.dbList($scope,$http,'VGB_PRST_PRSID','VGB_PRST_PRSID','vgb_prst',0,100)

				A_Scope.callBack = "$scope.VGB_CNTR_CNTID='" + $scope.VGB_CNTR_CNTID + "';"
				$scope.VGB_CNTR_CNTID = "";
				$scope.aliasName = "vgb_cntr"
				A_Scope.dbList($scope,$http,'VGB_CNTR_CNTID','VGB_CNTR_CNTID','vgb_cntr',0,100)
				
				A_Scope.callBack = "$scope.VTX_SCHH_SCHID='" + $scope.VTX_SCHH_SCHID +"';"
				$scope.VTX_SCHH_SCHID = "";
				$scope.aliasName = "vtx_schh"
				A_Scope.dbList($scope,$http,'VTX_SCHH_SCHID','VTX_SCHH_SCHID','vtx_schh',0,100)
				
				
			}
			
			
			
			$scope.suppInit();




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
j