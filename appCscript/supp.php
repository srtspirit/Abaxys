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
				setTimeout('$("#formSaveSuccess").css("color","transparent");',3000)
				
				if (dta.dbFnct == "dbDelRec" && dta.errorCode == 0 && dta.tblInfo.tblName == "vgb_addr")
				{
					$scope.opts.idVGB_ADDR  = 0;
				}
				if ((dta.dbFnct == "dbDelRec" || dta.dbFnct == "dbInsRec") && dta.errorCode == 0 && dta.tblInfo.tblName == "vgb_supp")
				{
					$('#ab-back').click();
				}				
				
				$("#controllerGrid").val(dta.dbFnct + " Err=" + dta.errorCode  + " Tbl= " + dta.tblInfo.tblName)

			}

		 	
		 	$scope.save = function(opt)
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
		 	$scope.saveAll = function(opt)
		 	{
		 		
		 		$("#mainForm").attr("ab-main","vgb_bpar");
		 		A_Scope.callBack = '$("#mainForm").attr("ab-main","' + $("#mainForm").attr("ab-main") + '");';
		 		A_Scope.callBack += "if (data['posts'].errorCode==0){$scope.idVGB_BPAR = data['posts'].result[0].idVGB_BPAR;$('#VGB_PARTNERrfs').click();}"
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
						$scope.isPartnerOther = "Exists as supplier " + $scope.VGB_BPARCT[0].VGB_BPAR_BPNAM;
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
			 	tObj['VGB_SUPP_BPART'] = $scope.VGB_SUPP_BPART;
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
				
				$scope.chkMain();
				
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
