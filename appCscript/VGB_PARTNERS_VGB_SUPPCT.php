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
			
			$scope.addrABupd = function(opt)
			{
				$("#mainForm").attr("ab-main","vgb_addr");
				$scope.ABupd(opt);
				$("#mainForm").attr("ab-main","vgb_supp");
			}
			

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
			 			A_Scope.callBack = 'if (data["posts"].errorCode==0){$scope.saveSuccess(data["posts"]);$scope.suppInit();' + $("[ab-updSuccess]").val() + '}else{$scope.saveSuccess(data["posts"]);}';
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
// 		 		alert($("#mainForm").attr("ab-main"));
		 		
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
				// SUPPCT
				if (!$scope.rawResult[tbl] || $scope.rawResult[tbl].length < 1)
				{
					A_Scope.dbList($scope,$http,ce,obj,tbl,dir,currentPerPage)
				}				
				
				// A_Scope.dbList($scope,$http,ce,obj,tbl,dir,currentPerPage)
				
			} 

			$scope.createdSuppInit = function(pIds)
			{
				
				
			 	tObj = "#VGB_PARTNERS/VGB_SUPPCT/idVGB_BPAR:" + pIds.insertId + ",idVGB_SUPP:" + pIds.MAINinsertId+",updType:UPDATE,Session:VGB_SUPPCT,Process:VGB_PARTNERS";
				$("[ng-model]").each(function()
				{
					$(this).remove();
					
				});			 	
			 	
				location.href= tObj;				
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
				if ($scope.chkObj['idVGB_SUPP']==undefined)
				{
					$scope.chkObj['idVGB_SUPP'] = "0";
				}
				
				$scope.chkMain();
				$("[ng-model='VGB_BPAR_BPART']").focus();
			}
			
			
			$scope.supportBase = function()
			{

				A_Scope.callBack = "$scope.VGB_TERM_TERID='" + $scope.VGB_TERM_TERID +"';"
				A_Scope.callBack += "$scope.supportBase01();"
				
				$scope.VGB_TERM_TERID = "";
				$scope.aliasName = "vgb_term"
				A_Scope.dbList($scope,$http,'VGB_TERM_TERID','VGB_TERM_TERID','vgb_term',0,100)
				
			}
				
			$scope.supportBase01 = function()
			{
				A_Scope.callBack = "$scope.VGB_CURR_CURID='" + $scope.VGB_CURR_CURID +"';$scope.initSupportSVIA();"
				$scope.VGB_CURR_CURID = "";
				$scope.aliasName = "vgb_curr"
				
				A_Scope.dbList($scope,$http,'VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0,100)
				
			}


	
			$scope.supportTBL = function()
			{
				
				A_Scope.callBack = "$scope.VGB_PRST_PRSID='" + $scope.VGB_PRST_PRSID + "';"
				A_Scope.callBack += "$scope.supportTBL01();"
				$scope.VGB_PRST_PRSID = "";
				$scope.aliasName = "vgb_prst"
				A_Scope.dbList($scope,$http,'VGB_PRST_PRSID','VGB_PRST_PRSID','vgb_prst',0,100)
			}

			$scope.supportTBL01 = function()
			{

				A_Scope.callBack = "$scope.VGB_CNTR_CNTID='" + $scope.VGB_CNTR_CNTID + "';"
				A_Scope.callBack += "$scope.supportTBL02();"
				$scope.VGB_CNTR_CNTID = "";
				$scope.aliasName = "vgb_cntr"
				A_Scope.dbList($scope,$http,'VGB_CNTR_CNTID','VGB_CNTR_CNTID','vgb_cntr',0,100)

			}

			$scope.supportTBL02 = function()
			{
				
				A_Scope.callBack = "$scope.VTX_SCHH_SCHID='" + $scope.VTX_SCHH_SCHID +"';"
				$scope.VTX_SCHH_SCHID = "";
				$scope.aliasName = "vtx_schh"
				A_Scope.dbList($scope,$http,'VTX_SCHH_SCHID','VTX_SCHH_SCHID','vtx_schh',0,100)
				
				
			}
			
			$scope.initSupportSVIA = function()
			{
				var mainTbl = "vgb_svia";
				var suppTbls = "vgb_supp:idVGB_SUPP = VGB_SVIA_SUPPID ";
				suppTbls += ",vin_supp:VIN_SUPP_BPART = VGB_SVIA_SUPPID ";
				suppTbls += ",vin_item:idVIN_ITEM = VIN_SUPP_ITMID ";
				var alias = "vgb_cust_svia";
				var pattern = "[=SPE=] VGB_SVIA_CUSTID = " + $scope.AB_CPARM.VGB_COMPANY.vgb_cust[0].idVGB_CUST + "  OR VGB_SVIA_CUSTID = 0 ";
				var orderBy = "VGB_SUPP_BPNAM";
				var objFunctions = "";
				var objGroupBy = "";
				
				$scope.ABsearchAlias(mainTbl,suppTbls,pattern,alias,orderBy,"",objFunctions,objGroupBy);
			}			
		
			$scope.setSelectOrheSVIA = function(SVIAid)
			{
				try
				{
					
					if (SVIAid==0)
					{
						$scope.VGB_SUPP_SHIPID = null;
					}
					else
					{
						$scope.VGB_SUPP_SHIPID = SVIAid;
					}
					
				}
				catch(er){}
			}			
	
			$scope.suppInit();



