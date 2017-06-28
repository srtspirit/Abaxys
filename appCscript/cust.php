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
				
				if (dta.dbFnct == "dbDelRec" && dta.errorCode == 0 && dta.tblInfo.tblName == "vgb_addr")
				{
					$scope.opts.idVGB_ADDR  = 0;
				}
				if ((dta.dbFnct == "dbDelRec" || dta.dbFnct == "dbInsRec") && dta.errorCode == 0 && dta.tblInfo.tblName == "vgb_cust")
				{
					$('#ab-back').click();
				}				
								
				$("#controllerGrid").val(dta.dbFnct + " Err=" + dta.errorCode  + " Tbl= " + dta.tblInfo.tblName)

			}
			
		 	$scope.save = function(opt)
		 	{
		 		if ($scope.idVGB_BPAR > 0)
		 		{
		 			A_Scope.callBack = 'if (data["posts"].errorCode==0){$scope.saveSuccess(data["posts"]);$scope.custInit();}else{$scope.saveSuccess(data["posts"]);}';
		 			
			 		A_Scope.dbUpd($scope,$http,opt)
			 	}
				else
				{
				
					$scope.saveAll(opt)
				} 	
		 	}  
		 	 
		 	$scope.saveAll = function(opt)
		 	{

		 		$("#mainForm").attr("ab-main","vgb_bpar");
		 		A_Scope.callBack = '$("#mainForm").attr("ab-main","' + $("#mainForm").attr("ab-main") + '");';
		 		A_Scope.callBack += "if (data['posts'].errorCode==0){$scope.idVGB_BPAR = data['posts'].result[0].idVGB_BPAR;$('#VGB_PARTNERrfs').click();}"
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
						$scope.isPartnerOther = "Exists as supplier";

						$scope.idVGB_BPAR = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.opts.idVGB_BPAR = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.VGB_CUST_BPART = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.vgb_cust[0].VGB_CUST_BPART = $scope.VGB_BPARCT[0].idVGB_BPAR;
						$scope.VGB_CUST_BPNAM = $scope.VGB_BPARCT[0].VGB_BPAR_BPNAM;
						$scope.vgb_cust[0].VGB_CUST_BPNAM = $scope.VGB_BPARCT[0].VGB_BPAR_BPNAM;
						$scope.VGB_ADDR_ = $scope.VGB_BPARCT[0].idVGB_ADD;
						
						
						
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
			 	tObj['VGB_CUST_BPART'] = $scope.VGB_CUST_BPART;
			 	$scope.chkObj = tObj
			 	
				
				A_Scope.callBack = ""
				
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
				
				A_Scope.callBack += "$scope.resetScope();$scope.supportBase();$scope.setChanges();";
				
				$scope.chkMain();
				
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
			
			
			
			$scope.custInit();


}
