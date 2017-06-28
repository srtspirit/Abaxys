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
					// A_Scope.callBack = 'if (data["posts"].errorCode==0){location.reload();}else{$scope.saveSuccess(data["posts"]);};';
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
		 		A_Scope.callBack += "if (data['posts'].errorCode==0){$scope.idVGB_BPAR = data['posts'].result[0].idVGB_BPAR;$('#VGB_PARTNERrfs').click();" + eExec + " }"
		 		A_Scope.dbUpd($scope,$http,opt);
		 		// $("#mainForm").attr("ab-main","vgb_cust");
		 		
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
				//CUSTCT
				if (!$scope.rawResult[tbl] || $scope.rawResult[tbl].length < 1)
				{
					A_Scope.dbList($scope,$http,ce,obj,tbl,dir,currentPerPage)
				}				
				// A_Scope.dbList($scope,$http,ce,obj,tbl,dir,currentPerPage)
				
			} 

			$scope.addrABupd = function(opt)
			{
				$("#mainForm").attr("ab-main","vgb_addr");
				$scope.ABupd(opt);
				$("#mainForm").attr("ab-main","vgb_cust");
			}
			
			$scope.createdCustInit = function(pIds)
			{
				
				
			 	tObj = "#VGB_PARTNERS/VGB_CUSTCT/idVGB_BPAR:" + pIds.insertId + ",idVGB_CUST:" + pIds.MAINinsertId+",updType:UPDATE,Session:VGB_CUSTCT,Process:VGB_PARTNERS";
				$("[ng-model]").each(function()
				{
					$(this).remove();
					
				});			 	
			 	
				location.href= tObj;				
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
				if ($scope.chkObj['idVGB_CUST']==undefined)
				{
					$scope.chkObj['idVGB_CUST'] = "0";
				}
					
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
				A_Scope.callBack += "$scope.supportBase01();"
				
				$scope.VGB_TERM_TERID = "";
				$scope.aliasName = "vgb_term"
				A_Scope.dbList($scope,$http,'VGB_TERM_TERID','VGB_TERM_TERID','vgb_term',0,100)
				
			}
				
			$scope.supportBase01 = function()
			{
				A_Scope.callBack = "$scope.VGB_CURR_CURID='" + $scope.VGB_CURR_CURID +"';$scope.getBanks();"
				A_Scope.callBack += "$scope.supportTBL();"
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
				A_Scope.callBack += "$scope.supportTBL03();"
				$scope.VTX_SCHH_SCHID = "";
				$scope.aliasName = "vtx_schh"
				A_Scope.dbList($scope,$http,'VTX_SCHH_SCHID','VTX_SCHH_SCHID','vtx_schh',0,100)
				
				
			}
			
			$scope.supportTBL03 = function()
			{
				A_Scope.callBack = "$scope.supportTBL04();"
				$scope.VGB_SLRP_SLSRP = "";
				$scope.aliasName = "vgb_slrp"
				A_Scope.dbList($scope,$http,'VGB_SLRP_SLSRP','VGB_SLRP_SLSRP','vgb_slrp',0,100)
			}

			$scope.supportTBL04 = function()
			{
				A_Scope.callBack = "$scope.getMarket();"
				$scope.VGB_BANK_BNKID = "";
				$scope.aliasName = "vgb_bank"
				A_Scope.dbList($scope,$http,'VGB_BANK_BNKID','VGB_BANK_BNKID','vgb_bank',0,100)
			}

			$scope.getMarket = function()
			{
				if (!$scope["vgb_mark"] )
				{
					var pattern = "[=SPE=]idVGB_MARK > 0";
					$scope.ABsearchAlias('vgb_mark','','','vgb_mark','VGB_MARK_MRKID ASC','$scope.getCustType();')
				}
				else
				{
					$scope.getCustType();
				}
			}

			$scope.getCustType = function()
			{
				if (!$scope["vgb_ctyp"] )
				{
					var pattern = "[=SPE=]idVGB_CTYP > 0";
					$scope.ABsearchAlias('vgb_ctyp','','','vgb_ctyp','VGB_CTYP_CUTYP ASC','')
				}
			}



			
			$scope.custInit();

