<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}
	
A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{
    
	 
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}	

A_LocalAgularFn.prototype.VAP_OITEMAG = function($scope,$http,$routeParams)
{
	
	<?php require_once "../appCscript/VAP_FINANCE_AGED.php"; ?>
	
}

A_LocalAgularFn.prototype.VAP_OITEMCT = function($scope,$http,$routeParams)
{
	$scope["idVAP_OIHE"] = 0;
	$scope.initVAP_OIHE = function()
	{
		var chkObj = new Object();
		chkObj["idVAP_OIHE"] = "0";
		$scope.ABchk(chkObj,'vap_oihe');
		$scope["curBank"] = new Object();
		$("[ng-model='ORHE_HISTORY_SUPP']").focus();
	}
	
	$scope.initNewSupplier = function()
	{
		console.log("initNewSupplier")
	
		$scope.initSupp($scope.abSessionResponse.VGB_SUPP_BPART);
		
		
	}	
	
	$scope.initSupp = function(bparId)
	{
		console.log("INIT_SUPP")
		var chkObj = new Object();
		chkObj["idVGB_BPAR"] = bparId;
		// A_Scope.callBack = "$scope.initOrheData();";
		A_Scope.callBack = "$scope.initOrheData(data);$scope.setVarForm(-1);$scope.initLocalPurch();";
		$scope.ABchk(chkObj,'vap_items');
		$scope.VAP_BOOKING=0;
		$scope.VAP_BOOKING_CK=false;
		$scope.VAP_DISTRIBUTE=0;
		$scope.VAP_DISTRIBUTE_CK=false;
	}

	$scope.isDistribute = function()
	{
		var ret = false;
		if ( $scope.varFormPg==1  && $scope.VAP_DISTRIBUTE==true)
		{
			ret = true;
		}
		return ret;
	}

	$scope.isBooking = function()
	{
		var ret = false;
		if ( ($scope.varFormPg==0 || $scope.varFormPg==2) && $scope.VAP_BOOKING==true)
		{
			ret = true;
		}
		return ret;
	}
	
	$scope.isLocal = function()
	{
		var ret = false;
		if ( ($scope.varFormPg==0 || $scope.varFormPg==2) && $scope.VAP_BOOKING!=true)
		{
			ret = true;
		}
		return ret;
	}

	$scope.chkEventItm = function(recName,ev,idVGL_JNHE,itemID,idVPU_ORST)
	{
		var keyCode = (ev.keyCode?ev.keyCode:ev.which);

		if (keyCode == 13)
		{
			$scope.chkRangeItm(recName,idVGL_JNHE,itemID,idVPU_ORST);
		}
		
	}
	
	$scope.chkRangeItm = function(recName,idVGL_JNHE,itemID,idVPU_ORST)
	{

		
		if(itemID.trim()!="")
		{
			$scope["VIN_ITEM_ITMID"] = itemID;
			
			A_Scope.callBack = "$scope.initItem('"+recName +"',0," + idVPU_ORST + "," + idVGL_JNHE + ");";
			
			$scope.ABlstAlias("VIN_ITEM_ITMID","VIN_ITEM_ITMID","vin_service","vin_service"); 
			
		}
		
	}
	
	$scope.initLocalPurch = function()
	{
		console.log("initLocalPurch")
		$scope["local_purch"] = new Array();
		$scope["local_purch"][0] = new Object();
		$scope["local_purch"][0]["idVPU_ORSI"] = 0;
		$scope["local_purch"][0]["idVPU_ORST"] = 1;
		$scope["local_purch"][0]["VPU_ORSI_GRPID"] = 0;
		$scope["local_purch"][0]["VIN_ITEM_ITMID"] = "";
		$scope["local_purch"][0]["idVIN_ITEM"] = 0;
		$scope["local_purch"][0]["VIN_ITEM_INVIT"] = 0;
		$scope["local_purch"][0]["newItem"] = 1;
		$scope["local_purch"][0]["VPU_ORDE_DESCR"] = "";
		$scope["local_purch"][0]["VPU_ORST_ORDQT"] = 0;
		$scope["local_purch"][0]["VPU_ORDE_OUNET"] = 0;
		$scope["local_purch"][0]["VPU_ORDE_FACTO"] = 1;
		$scope["local_purch"][0]["VPU_ORDE_OLTYP"] = "EXP"; 
		
		$scope["local_journal"] = new Array();
		dDta["local_purch"] = $scope["local_purch"];
		
	}
	
	$scope.removeNewLine = function(recSet,idVPU_ORST,idVGL_JNHE)
	{
		var occ = 0;
		
		while (occ < recSet.length)
		{
			if (idVPU_ORST == recSet[occ].idVPU_ORST)
			{
				recSet.splice(occ,1);
				occ = recSet.length;
			}
			occ += 1;
		}
		if (recSet.length==0)
		{
			$scope.initLocalPurch();
		}
		
		setTimeout(function()
		{
			$("#vpu-" + idVGL_JNHE).find("[ng-model='vpu.grandtotal']").click();
			
		},10);
		
	}

	$scope.initItem = function(recName,rowNumber,idVPU_ORST,idVGL_JNHE)
	{
		var occ = 0;
		
		if (recName == "local_purch")
		{
			while (occ < $scope.local_purch.length)
			{
				if (idVPU_ORST == $scope.local_purch[occ].idVPU_ORST)
				{
					$scope.local_purch[occ]["VIN_ITEM_ITMID"] = $scope.rawResult.vin_service[rowNumber]["VIN_ITEM_ITMID"];
					$scope.local_purch[occ]["idVIN_ITEM"] =  $scope.rawResult.vin_service[rowNumber]["idVIN_ITEM"];
					$scope.local_purch[occ]["VIN_ITEM_INVIT"] = $scope.rawResult.vin_service[rowNumber]["VIN_ITEM_INVIT"];
					$scope.local_purch[occ]["VPU_ORDE_DESCR"] =  $scope.rawResult.vin_service[rowNumber]["VIN_ITEM_DESC1"];
					$scope.local_purch[occ]["VIN_ITEM_ITTXT"] =  $scope.rawResult.vin_service[rowNumber]["VIN_ITEM_ITTXT"];
					$scope.local_purch[occ]["VPU_ORDE_OLTYP"] = "EXP"; 
					occ = $scope.local_purch.length;
				}
				occ += 1;
			}
		}
		else
		{
			while (occ < $scope.rawResult.vpu_purch.length)
			{
				if (idVPU_ORST == $scope.rawResult.vpu_purch[occ].idVPU_ORST)
				{
					$scope.rawResult.vpu_purch[occ]["VIN_ITEM_ITMID"] = $scope.rawResult.vin_service[rowNumber]["VIN_ITEM_ITMID"];
					$scope.rawResult.vpu_purch[occ]["idVIN_ITEM"] =  $scope.rawResult.vin_service[rowNumber]["idVIN_ITEM"];
					$scope.rawResult.vpu_purch[occ]["VIN_ITEM_INVIT"] = $scope.rawResult.vin_service[rowNumber]["VIN_ITEM_INVIT"];
					$scope.rawResult.vpu_purch[occ]["VPU_ORDE_DESCR"] =  $scope.rawResult.vin_service[rowNumber]["VIN_ITEM_DESC1"];
					$scope.rawResult.vpu_purch[occ]["VIN_ITEM_ITTXT"] =  $scope.rawResult.vin_service[rowNumber]["VIN_ITEM_ITTXT"];
	
					occ = $scope.rawResult.vpu_purch.length;
				}
				occ += 1;
			}
		}
		
		setTimeout(function()
		{
			$("#vpu-" + idVGL_JNHE).find("[ng-model='vpu.grandtotal']").click();
			
		},10);
		
		

		
	}

	
	$scope.insertItem = function(recSet,OIHE_INVOI,idVPU_ORSI)
	{
		var nextStep = 0;
		
		var occ = 0;
		var newLine = 0;
		var nlFound = false;
		
//<tr ng-repeat="vpu in rawResult.vpu_purch | AB_noDoubles:'idVPU_ORST' " ng-if="vpu.VPU_ORSI_GRPID == OIT.VAP_OIHE_INVOI" >
//	vpu.VIN_ITEM_ITMID
//	vpu.idVIN_ITEM
//	vpu.VIN_ITEM_INVIT
//	vpu.VPU_ORDE_DESCR
//	vpu.VPU_ORST_ORDQT
//	vpu.VPU_ORDE_OUNET
//	vpu.VPU_ORDE_FACTO
		
		
		while (occ < recSet.length)
		{
			nextStep = Math.max(nextStep,Number(recSet[occ].idVPU_ORST));
			occ += 1;
		}
		
		nextStep += 1;
		
		newLine = recSet.length;
		recSet[newLine] = new Object();
		recSet[newLine]["newItem"] = "1";
		recSet[newLine]["idVPU_ORST"] = nextStep;
		recSet[newLine]["idVPU_ORSI"] = idVPU_ORSI;
		recSet[newLine]["VPU_ORSI_GRPID"] = OIHE_INVOI;
		
		
		recSet[newLine]["VIN_ITEM_ITMID"] = "";
		recSet[newLine]["idVIN_ITEM"] = 0;
		recSet[newLine]["VIN_ITEM_INVIT"] = "0";
		recSet[newLine]["VPU_ORDE_DESCR"] = "";
		recSet[newLine]["VPU_ORST_ORDQT"] = 0;
		recSet[newLine]["VPU_ORDE_OUNET"] = 0;
		recSet[newLine]["VPU_ORDE_FACTO"] = 1;
		recSet[newLine]["VPU_ORDE_OLTYP"] = "EXP";
		
		
	}

	
	$scope.computeTax = function(idVGL_JNHE,amt,recSet)
	{
	
		$scope["item_amt"] = amt;
		$scope["tax_records"] = recSet;

		A_Scope.callBack = "$scope.computeTaxDsp(" + idVGL_JNHE + ");";
		$scope.ABlstAlias('item_amt','item_amt,tax_records',"vgl_taxing","vgl_taxing");
		
	}
	
	$scope.computeTaxDsp = function(idVGL_JNHE)
	{
		var invtotal = 0;
		var grtotal = 0;
		var taxTotal = 0;
		var tmpTax = 0;
		var occ = 0;
		var debug = "";
		
		dDta["vgl_taxing"] = new Object();
		dDta["vgl_taxing"]["id"] = idVGL_JNHE;
		dDta["vgl_taxing"]["recSet"] = recSet;		
		dDta["vgl_taxing"]["scopeSet"] = $scope["rawResult"]["vgl_taxing"];	
		var recSet = $scope["rawResult"]["vgl_taxing"];
		
		$("#vpu-" + idVGL_JNHE).find("[ng-model]").each(function()
		{
			if ($(this).attr("ng-model") == "jrn.VGL_JNDE_GLAMT_REV")
			{
				occ = 0;
				while (occ < recSet.length)
				{
					if ($(this).attr("taxseq") == recSet[occ]["VTX_SCHE_SCHSQ"])
					{
						tmpTax = (recSet[occ]["GLAMT"]*1);
						tmpTax = tmpTax.toFixed(2);
						$(this).val(tmpTax);
						taxTotal += (tmpTax*1);
						occ = recSet.length;
					}
					occ +=1;
				}
			}
			if ($(this).attr("ng-model") == "OIT.ADJAMOUT")
			{
				debug += $(this).attr("trtype") + "\n"
			} 			
		});
		
		taxTotal = taxTotal.toFixed(2);
		$("#vpu-" + idVGL_JNHE).find("[ng-model='vpu.taxtotal']").val(taxTotal);
		grtotal = $("#vpu-" + idVGL_JNHE).find("[ng-model='vpu.grandtotal']").val() * 1;
		grtotal = grtotal.toFixed(2);
		invtotal = (grtotal*1) + (taxTotal*1);
		invtotal = invtotal.toFixed(2);		
		$("#vpu-" + idVGL_JNHE).find("[ng-model='vpu.invtotal']").val(invtotal);
		
		if ($("#jrn-" + idVGL_JNHE).find("[ng-model='OIT.SELECT']").val() == 0)
		{
			invtotal = 0;
		}
		$("#jrn-" + idVGL_JNHE).find("[ng-model='OIT.ADJAMOUT_BOOK']").val(invtotal);
		if ($scope.isLocal()==true)
		{
			$scope["VAP_OIHE_AMUNT"] = $scope.ABGetNumberFn("fmt-curr",Math.abs(invtotal));
			if (invtotal > 0)
			{
				$scope.varFormPg = 0;
				$scope["VAP_OIHE_OITTY"] = "INV";
				$scope["VAP_FACTOR"] = 1;
				
			}
			if (invtotal < 0)
			{
				$scope.varFormPg = 2;
				$scope["VAP_OIHE_OITTY"] = "CRN";
				$scope["VAP_FACTOR"] = -1;
			}
			
		}		
		$scope.accumAdjustDelay();
	}
	


	
	$scope.accGrandTotal = function(idVGL_JNHE)
	{
		var grTotal = 0;
		var itemTotal = 0;
		var itemTotalNoTax = 0;
		var taxTotal = 0;
		var amtToTax = 0;
		var curTax = 0;
		var taxRate = 0;
		
		
		$("#vpu-" + idVGL_JNHE).find("[ng-model]").each(function()
		{
			if ($(this).attr("ng-model") == "vpu.ext")
			{
				amtToTax = ($(this).val()*1);
				amtToTax = amtToTax.toFixed(2);
				if ($(this).attr("taxing")!="NOTAX")
				{
					itemTotal += amtToTax*1;
				}
				else
				{
					itemTotalNoTax += amtToTax*1;
				}
				console.log("VAP_FINANCE-accGrandTotal",$(this).val(),amtToTax,itemTotal,itemTotalNoTax)
				
			}
			
		});

		var recSet = new Array();
		var occ = 0;
		$("#vpu-" + idVGL_JNHE).find("[ng-model]").each(function()
		{
			if ($(this).attr("ng-model") == "jrn.VGL_JNDE_GLAMT_REV")
			{
				occ = recSet.length;
				recSet[occ] = new Object();
				recSet[occ]["VTX_SCHE_TPREV"] = $(this).attr("taxprev");
				recSet[occ]["VTX_SCHE_TAXPE"] = $(this).attr("taxper");
				recSet[occ]["VTX_SCHE_SCHSQ"] = $(this).attr("taxseq");

				

			}
			
		});
		
		
		$scope.computeTax(idVGL_JNHE,(itemTotal*1),recSet);
		
		itemTotal += itemTotalNoTax;	
		grTotal = (itemTotal*1) ;
		grTotal = grTotal.toFixed(2)
		
		
		return grTotal;	
	}
	
	
	$scope.updateRpoVariance = function(recSet,flag)
	{
		var holdMain = $("#mainForm").attr("ab-main");
		$("#mainForm").attr("ab-main","vap_oihe_itm");
		
		$scope.idVAP_OIHE_ITM = recSet.idVAP_OIHE_ITM;
		$scope.VAP_OIHE_ITM_OITID = recSet.VAP_OIHE_ITM_OITID;
		$scope.VAP_OIHE_ITM_ITMID = recSet.VAP_OIHE_ITM_ITMID;
		$scope.VAP_OIHE_ITM_ORDQT = recSet.VAP_OIHE_ITM_ORDQT;
		$scope.VAP_OIHE_ITM_OUNET = recSet.VAP_OIHE_ITM_OUNET;
		$scope.VAP_OIHE_ITM_EXTEN = recSet.VAP_OIHE_ITM_EXTEN;
<?php
$sesQ = new AB_querySession();
$userDta = $sesQ->getUserData();
?>		
		
		$scope.VAP_OIHE_ITM_USLNA = "<?php echo $userDta["userCode"]; ?>";
		
		$scope.ABupd(flag.toUpperCase());

		$("#mainForm").attr("ab-main",holdMain);		
	}
	
	$scope.initOrheData = function(oDta)
	{
		console.log("initOrheData");
		$scope["VGB_BPAR_BPART"] = $scope["vap_items"][0]["VGB_BPAR_BPART"];
		$scope["VAP_OIHE_BSUPP"] = $scope["vap_items"][0]["idVGB_SUPP"];
		$scope["VAP_OIHE_BTADD"] = $scope["vap_items"][0]["VGB_SUPP_BTADD"];
		$scope["VAP_OIHE_TERID"] = $scope["vap_items"][0]["VGB_SUPP_TERID"];
		$scope["VAP_OIHE_NETDA"] = $scope["vap_items"][0]["VGB_TERM_NETDA"];
		$scope["VAP_OIHE_DISDA"] = $scope["vap_items"][0]["VGB_TERM_DISDA"];
		$scope["VAP_OIHE_DISCN"] = $scope["vap_items"][0]["VGB_TERM_DISCN"];
		$scope["VAP_OIHE_CURID"] = $scope["vap_items"][0]["VGB_SUPP_CURID"];
		$scope["VAP_OIHE_CURAT"] = $scope["vap_items"][0]["VGB_CURR_CURAT"];
		$scope["VAP_OIHE_OITTY"] = "";
		$scope["VAP_OIHE_DOCDA"] = "";
		$scope["VAP_OIHE_BPBNK"] = "";
		$scope["VAP_OIHE_AMUNT"] = "";
		$scope["VAP_OIHE_PMTDA"] = "";
		$scope["VAP_OIHE_CONNU"] = "";
		$scope["VAP_OIHE_REFER"] = "";
		$scope["VAP_BOOKING"] = false;
		$scope["VAP_DISTRIBUTEÈ"] = false;
		
		$("#VAP_OIHE_BPBNKmain").html("");
		
		$scope["idVAP_OIHE"] = "";
		$("#ab-update").addClass("hidden");
		$("#ab-delete").addClass("hidden");
		$("#ab-create").removeClass("hidden");

console.log("initOrheData111");
		setDbErr($scope,oDta['posts']);
console.log("initOrheData222");		
		A_Scope.setUpdTbl($scope,"vap_oihe","dbMain",oDta['posts']);
console.log("initOrheData333");		
console.log("initOrheDataTotal");			
	}


	
	$scope.setVarForm =function(formNum)
	{

		console.log("setVarForm");
		
		$scope["VAP_FACTOR"] = 0;
		var formNew = formNum;
		var debug = formNew + $scope["VAP_OIHE_OITTY"];
		switch (formNum)
		{
			case 0:
			if ($scope["VAP_OIHE_OITTY"]!="INV")
			{
				$scope["VAP_OIHE_OITTY"] = "INV";
				$scope["VAP_FACTOR"] = 1;
			}
			else
			{
				$scope["VAP_OIHE_OITTY"] = "";
				formNew = -1;
			}
			break;
			case 1:
			if ($scope["VAP_OIHE_OITTY"]!="PMT")
			{
				$scope["VAP_OIHE_OITTY"] = "PMT";
				$scope["VAP_FACTOR"] = -1;
			}
			else
			{
				$scope["VAP_OIHE_OITTY"] = "";
				formNew = -1;
			}
			break;	
			case 2:
			if ($scope["VAP_OIHE_OITTY"]!="CRN")
			{
				$scope["VAP_OIHE_OITTY"] = "CRN";
				$scope["VAP_FACTOR"] = -1;
			}
			else
			{
				$scope["VAP_OIHE_OITTY"] = "";
				formNew = -1;
			}
			break;
			case 3:
			if ($scope["VAP_OIHE_OITTY"]!="ADJ")
			{
				$scope["VAP_OIHE_OITTY"] = "ADJ";
				$scope["VAP_OIHE_AMUNT"] = 0;
				
			}
			else
			{
				$scope["VAP_OIHE_OITTY"] = "";
				formNew = -1;
			}				
		}	
		
		debug += "\n" + formNew + $scope["VAP_OIHE_OITTY"];
		
		$scope["ADJBALANCE"] = 0;
		if (formNew >-1)
		{
			$scope.updateOn = 1;
			if (formNew==3)
			{
			        $('#ab-create').addClass("hidden");
			        $('#ab-update').removeClass("hidden");			
				$scope.updateOn = 2;
				$scope.accumAdjust()
			}
			else
			{
			        $('#ab-create').removeClass("hidden");
			        $('#ab-update').addClass("hidden");			
			}
			
			if ($scope["VAP_OIHE_DOCDA"]=="")
			{
				$scope["VAP_OIHE_DOCDA"] = $scope.ABGetDateFn('get-year','')+$scope.ABGetDateFn('get-month','')+$scope.ABGetDateFn('get-day','');
				
			}
			
		}
		else
		{
			$scope.updateOn = 0;
		}
		
		$scope.varFormPg = formNew
		
		
		
	}
	
	$scope.setBankInfo = function(fValue)
	{
		$scope["VAP_OIHE_BNKID"] = fValue["idVGL_BANK"]
		$scope["VGL_BANK_PMTTY"] = fValue["VGL_BANK_PMTTY"];
		$scope["VGL_BANK_TYDET"] = fValue["VGL_BANK_TYDET"];
		
		$scope["curBank"] = fValue;
	}


	$scope.chkRangePartner = function(fieldName,tblName,tblField)
	{
		
		if($scope[fieldName].trim()!="")
		{
			$scope[tblField] = $scope[fieldName];
			A_Scope.callBack = "$scope.validateBpart('" + fieldName + "','" + tblName + "','" + tblField + "');$scope.initLocalPurch();";
		
			$scope.ABlstAlias(tblField,tblField,tblName,tblName);
				
		}
		
   			
	}
	
	$scope.validateBpart = function(fieldName,tblName,tblField)
	{
	
		$scope[fieldName] = "";
		if($scope[tblName].length > 0)
		{
			var occ = 0;
			while (occ < $scope["rawResult"]["vgb_bpar"].length && $scope[fieldName] == "")
			{
				if (fieldName.indexOf("_SUPP") >-1  && $scope["rawResult"]["vgb_bpar"][occ]["idVGB_SUPP"] > 0)
				{
					$scope[fieldName] = $scope["rawResult"]["vgb_bpar"][occ][tblField];
				  	$scope["idVGB_BPAR"] = $scope["rawResult"]["vgb_bpar"][occ]["idVGB_BPAR"];
				  	$scope.initSupp($scope["idVGB_BPAR"]);
				  	
				}
				

				
				occ += 1;
			}
			
			if ($scope[fieldName] == "")
			{
				$scope["VGB_BPAR_BPART"] =  $scope["vap_items"][0]["VGB_BPAR_BPART"];		
			}
			

			
			$scope[fieldName] = "";

			
		}
		else
		{
			$scope["VGB_BPAR_BPART"] =  $scope["vap_items"][0]["VGB_BPAR_BPART"];		
		}
		
		
		//Example for future reference How to list search items see VAP_OITEMCT
//		$scope["tbName"] = "vgb_bpar";
//		$scope["idName"] = "VGB_BPAR_BPART";
//		$scope["idDescr"] = "VGB_SUPP_BPNAM";
//		$scope["tbCond"] = function (rec){ if (rec.idVGB_SUPP>0){return true;}else{return false}}
//		$scope["selInstruction"] = function (rec){ $scope["ORHE_HISTORY_SUPP"] = rec.VGB_BPAR_BPART;setTimeout(function(){$("[ab-model='findPartner']").click();},10)}
	
	}

	$scope.accumAdjust = function()
	{
		$scope["ADJBALANCE"] = 0;
		
		var accAdj = 0;
		
		var subType="STD";
		if ($scope.varFormPg==0 || $scope.varFormPg==2)
		{
			subType="RPO";
		}
		var debug = "";
		
		if ($scope.isBooking() == false)
		{
			var accAdj = 0;
			var totEval = "+0";
			
			$("[ng-model='OIT.ADJAMOUT']").each(function()
			{
					
					if (isNaN($(this).val()))
					{
						$(this).val(0)
					}
					
					if ($(this).attr("trtype")!="INV")
					{
						$(this).val(Math.abs($(this).val())*-1);
					}
					else
					{
						$(this).val(Math.abs($(this).val()));
					}
					
					if (Math.abs($(this).attr("trbal"))<Math.abs($(this).val()))
					{
						$(this).val($(this).attr("trbal"))
					}
					
					if (Number.isNaN(parseFloat($(this).val())) == false)
					{
						totEval += "+" + parseFloat($(this).val());
					}
										
					// accAdj  += ($(this).val()*1)
					$(this).val($scope.ABGetNumberFn("fmt-curr",$(this).val()))
					
			});
			
			accAdj = eval(totEval).toFixed(2);
		}
		else
		{	
			var accAdj = 0;
			var totEval = "";
			if ($scope.varFormPg==0)
			{
				if (Number.isNaN(parseFloat($scope["VAP_OIHE_AMUNT"])) == false)
				{
					totEval = "-" + $scope["VAP_OIHE_AMUNT"];
				}				
			}
			else
			{
				if (Number.isNaN(parseFloat($scope["VAP_OIHE_AMUNT"])) == false)
				{
					totEval = "+" + $scope["VAP_OIHE_AMUNT"];
				}				
			}
			
			var lineAmt = 0;
			
			
			$("[ng-model='OIT.ADJAMOUT_BOOK']").each(function()
			{
					
					if (isNaN($(this).val()))
					{
						$(this).val(0)
					}
					
					if ($(this).attr("trtype")!="INV")
					{
						$(this).val(Math.abs($(this).val())*-1);
					}
					else
					{
						$(this).val(Math.abs($(this).val()));
					}
					
					if (Number.isNaN(parseFloat($(this).val())) == false)
					{
						totEval += "+" + parseFloat($(this).val());
					}
					
					$(this).val($scope.ABGetNumberFn("fmt-curr", $(this).val()))
			});
			
			accAdj = eval(totEval).toFixed(2)
			
		}
		
		
		$scope["ADJBALANCE"] = accAdj*1;
		$scope["ADJBALANCE"] = $scope.ABGetNumberFn("fmt-curr",$scope["ADJBALANCE"]);
		if ($scope.isDistribute()==true)
		{
			$scope.VAP_OIHE_AMUNT = $scope["ADJBALANCE"];
		}
			

		
	}
	
	$scope.accumAdjustDelay = function()
	{
	
		setTimeout(function()
		{
			
			$("[ng-model='ADJBALANCE']").click()
			
			
		},10);
	}
	
	$scope.validEntry = function()
	{
		if ($scope.varFormPg==1 && $scope.isDistribute()==false)
		{
			$scope["ADJBALANCE"] = 0;
		}
		
		if ($scope["ADJBALANCE"] != 0 && $scope.varFormPg!=1)
		{
			return false;
		}
		if ($scope.varFormPg!=3 && $scope["VAP_OIHE_AMUNT"] == 0)
		{
			return false;
		}
		
		if ($scope.varFormPg==1 && $scope["VAP_OIHE_BNKID"] < 1)
		{
			return false;
		}

		if ($scope.varFormPg==1 && $scope["VAP_OIHE_AMUNT"] < 0)
		{
			return false;
		}
				
		if ($scope.varFormPg!=3	)
		{
			return true;
		}
		
		var ret = false;
		$("[ng-model='OIT.ADJAMOUT']").each(function()
		{
			if ($(this).val() != 0)
			{
				ret = true
			}
		});
		
		return ret;
	}
	
	$scope.validateAmt = function()
	{
		if (isNaN($scope["VAP_OIHE_AMUNT"]))
		{
			$scope["VAP_OIHE_AMUNT"] = 0;
		}
		
		$scope["VAP_OIHE_AMUNT"] = Math.abs($scope["VAP_OIHE_AMUNT"]);
		$scope["VAP_OIHE_AMUNT"] = $scope.ABGetNumberFn("fmt-curr",$scope["VAP_OIHE_AMUNT"]);		
	}
		
	$scope.initVAP_OIHE()
	
	
}

A_LocalAgularFn.prototype.VAP_OITEMCC = function($scope,$http,$routeParams)
{
	$scope.vapPcFormPg = 0;
	$scope.doc_date_to = $scope.ABGetDateFn('get-year','')+$scope.ABGetDateFn('get-month','') + $scope.ABGetDateFn('get-day','')
	$scope.doc_date_from = $scope.ABGetDateFn('add-days',$scope.doc_date_to + ",-60");
		
	$scope.setVapPcForm = function(formNum)
	{
		if (formNum!=$scope.vapPcFormPg)
		{
			$scope.vapPcFormPg = formNum;
			$scope.cancelTransaction = 0;
		}
	}	

	$scope.cancelRecon = function(val)
	{
		$scope.cancelTransaction = val;
	}
		
	$scope.setCurrency = function(rec)
	{
		$scope["idVGL_CHART_current"] = rec.idVGL_CHART;
		$scope["VGL_CHART_GLDES_current"] = rec.idVGL_BANK;		
		$scope["idVGB_CURR_current"] = rec.idVGB_CURR;
		$scope["idVGL_BANK_current"] = rec.idVGL_BANK;
		$scope["VGL_BANK_PMTDE_current"] = rec.VGL_BANK_PMTDE;
		$scope["VGL_BANK_PMTTY_current"] = rec.VGL_BANK_PMTTY;
		$scope["currentRec"] = rec;
		$scope.getPayments(rec);
		
	}
	
	$scope.getPayments = function(rec)
	{
		
		$scope.ignored = 0;
		var chkObj = "";
		chkObj += " VAP_OIHE_OITTY = 'PMT' ";
		chkObj += " AND VAP_OIHE_APPROVED = '1' ";
		chkObj += " AND VAP_OIHE_ISSUED = '1' ";
		chkObj += " AND VAP_OIHE_POSTED = '1' ";		

		var tblUpd = $("#mainForm").attr("ab-main");	
		
		switch ($scope.vapPcFormPg)
		{
			case 0:
				chkObj += " AND VAP_OIHE_PSTAT = 'OUTSTD' ";
			break;
			case 1:
				chkObj += " AND VAP_OIHE_PSTAT = 'RECONC' ";
				chkObj += " AND VAP_OIHE_DOCDA >= '" + $scope.doc_date_from + "' ";
				chkObj += " AND VAP_OIHE_DOCDA <= '" + $scope.doc_date_to + "' ";
			break;	
		}

		chkObj += " AND ( ";
		var occ = 0;
		var banks = $scope.vap_banks;
		var vor = ""
		while (occ < banks.length)
		{
			if (rec.idVGL_CHART == banks[occ].idVGL_CHART)
			{
				
				chkObj += vor + " VAP_OIHE_BNKID = '" + banks[occ].idVGL_BANK +"' ";
				vor = " OR ";
			}
			occ += 1;
		}
		chkObj += " ) ";				
		
		$scope.ABsearchAlias("vap_oihe","vgb_supp","[=SPE=] " + chkObj ,"vap_oihe_pmt","","")
	}

	$scope.getBank = function()
	{
		// $scope.ABsearchAlias = function(mainTbl,suppTbls,pattern,alias,orderBy,callBack)
		
		$scope.ABsearchAlias("vgl_bank","vgl_chart,vgb_curr","","vap_banks","","")
		
	}

	$scope.checkSelectCC = function()
	{
		var found = false;
		
		
		$("[ng-model='OIT.SELECT']").each(function()
		{
			if ($(this).val() == "1" )
			{
				found = true;
			}
		});

		if (found == true)
		{
			$scope["updateOn"] = 1;
			$("#ab-update").removeClass("hidden");
			
		}
		else
		{
		        $scope["updateOn"] = 0;
		        $("#ab-update").addClass("hidden");
		        
		}
		
		return found;
	}
	
	$scope.getBank();
	
		
}

A_LocalAgularFn.prototype.VAP_OITEMCK = function($scope,$http,$routeParams)
{
	$scope["idVGB_CURR_current"] = 0;
	
	
	$scope.localABupd = function(opt)
	{
		
		
		if ($scope.varFormPg==1 && $scope.cancelTransaction == 0 )
		{
			var myWindow = window.open("", "ABviewForm");
		}
	}	
	
	$scope.cancelTr = function(val)
	{
		$scope.cancelTransaction = val;
	}
		
	$scope.setVarForm = function(formNum)
	{
		$scope.varFormPg = formNum;
		var tblUpd = "";
		
		$scope.ignored = 0;
		$scope.ignore_refer = "";
		
		switch (formNum)
		{
			case 0:
				tblUpd = "vap_approval";
				
			break;
			case 1:
				tblUpd = "vap_checks";
				
			break;	
			case 2:
				tblUpd = "vap_paypost";
				
			break;
		}
		
		$("#mainForm").attr("ab-main",tblUpd);
		

	}	
	
	$scope.validControlNumber = function(ctrlNo)
	{
		var orgCtrlNo = ($scope.originalNEXCK*1)
		
		if (ctrlNo < orgCtrlNo)
		{
			$scope.VGL_BANK_NEXCK = orgCtrlNo;
			$scope.ignored = 0;
			$("[ng-model='VGL_BANK_NEXCK']").focus();
		}
		else
		{
			$scope.ignored = $scope.VGL_BANK_NEXCK - orgCtrlNo;
		}
	}
			
	$scope.getCurrencies = function()
	{
		$scope["idVGB_CURR"] = "0";
		A_Scope.callBack = "$scope.getvap_banks();"
		$scope.ABlstAlias("idVGB_CURR","idVGB_CURR","vgb_curr","vgb_curr"); 
		
	}
	
	$scope.setOrgvarFormPg = function(pg)
	{
		if ($scope.varFormPg == -1)
		{
			$scope.setVarForm(pg);
		}

	}
	$scope.getvap_banks = function()
	{

		var chkObj = new Object();
		chkObj["VGL_BANK_SOURC"] = "PURCH";
		$scope.ABchk(chkObj,'vap_banks');
				
	}
		
	$scope.setCurrency = function(rec)
	{
		$scope["idVGB_CURR_current"] = rec.idVGB_CURR;
		$scope["idVGL_BANK_current"] = rec.idVGL_BANK;
		$scope["VGL_BANK_PMTDE_current"] = rec.VGL_BANK_PMTDE;
		$scope["VGL_BANK_PMTTY_current"] = rec.VGL_BANK_PMTTY;
		
		$scope.getPayments(rec.idVGL_BANK);
		
	}

	$scope.getPayments = function(bnkId)
	{
		$scope.ignored = 0;
		var chkObj = new Object();
		chkObj["VAP_OIHE_BNKID"] = bnkId;
		chkObj["VAP_OIHE_OITTY"] = "PMT";
		chkObj["VAP_OIHE_PSTAT"] = "OUTSTD";

		var tblUpd = $("#mainForm").attr("ab-main");	
		
		switch (tblUpd)
		{
			case "vap_approval":
			
				chkObj["VAP_OIHE_CHKID"] = "0";
				chkObj["VAP_OIHE_APPROVED"] = "0";
				chkObj["VAP_OIHE_ISSUED"] = "0";
				chkObj["VAP_OIHE_POSTED"] = "0";
				
			break;
			case "vap_checks":
			
				chkObj["VAP_OIHE_CHKID"] = "0";
				chkObj["VAP_OIHE_APPROVED"] = "1";
				chkObj["VAP_OIHE_ISSUED"] = "0";
				chkObj["VAP_OIHE_POSTED"] = "0";
				
			break;	
			case "vap_paypost":
			
				chkObj["VAP_OIHE_APPROVED"] = "1";
				chkObj["VAP_OIHE_ISSUED"] = "1";
				chkObj["VAP_OIHE_POSTED"] = "0";
				
			break;
		}
		
		
		A_Scope.callBack = "$scope.getBank(" + bnkId + ");";
		$scope.ABchk(chkObj,'vap_payment');
	}

	$scope.getBank = function(bnkId)
	{

		setTimeout(function()
		{
			$scope.getBankTimed(bnkId);

		},10);
		
	}

	$scope.getBankTimed = function(bnkId)
	{
		
		$scope["currentBank"] = new Object();
		var occ = 0;
		while (occ < $scope["rawResult"]["vap_payment"].length )
		{
			if ($scope["rawResult"]["vap_payment"][occ]["idVGL_BANK"] == bnkId)
			{
				$scope["currentBank"] = $scope["rawResult"]["vap_payment"][occ];
				occ = $scope["rawResult"]["vap_payment"].length;
			}
				
			occ += 1;
		}
		
		$scope["originalNEXCK"] = $scope["currentBank"]["VGL_BANK_NEXCK"];
		
		dDta["currentBank"] = $scope["currentBank"];
		
	}
	

	
	$scope.testRun = function(checkSet)
	{

//		if ($scope.vap_checks)
//		{
//			
//			$scope.setPayStubDta(dDta.dbChk.vap_checks.checkRun)
//		}
//		else
//		{
//			var chkObj = new Object();
//			chkObj["VGL_BANK_SOURC"] = "PURCH";
//			$scope.ABchk(chkObj,'vap_checks');
//		}
						
	} 
	
	$scope.setPayStubDta = function(checkSet)
	{
//	ng-repeat="OITDET in rawResult.vap_oihe_paid| 
//	AB_noDoubles:'idVAP_OIHE' " 
//	ng-if="OIT.VAP_OIDE_TRNID == OITDET.VAP_OIDE_TRNID && OIT.idVAP_OIDE != OITDET.idVAP_OIDE ">		
//	VAP_OIHE_OITTY
//	VAP_OIHE_REFER
//	VAP_OIHE_DOCDA
//	VAP_OIDE_AMUNT
//	ng-repeat="OIT in vap_oihe_pmt| AB_noDoubles:'idVAP_OIHE' " ng-if="OIT.VGL_BANK_CHECK=='1'"
//	=================
// 	Prepares check stubs for ng-repeat on $scope["payStub"]
//	=================


		try{
		$scope["payMain"] = new Array();
		$scope["payStub"] = new Array();
		$scope["payStubExtra"] = new Array();
		
		var chkRun = new Object();
		var chkTrCount = 0;
		
		var lastVAP_OIDE_TRNID = "";

		var checkRun = checkSet[0];
		var paidRun = checkSet[1];
		
		var mainOcc = 0;
		var lastidVAP_OIHE = 0;
		
		
		while (mainOcc < checkRun.length )
		{

			if (!chkRun[checkRun[mainOcc]["idVAP_OIHE"]])
			{
				chkRun[checkRun[mainOcc]["idVAP_OIHE"]] = new Object();
				chkRun[checkRun[mainOcc]["idVAP_OIHE"]]["record"] = checkRun[mainOcc];
				chkRun[checkRun[mainOcc]["idVAP_OIHE"]]["TRNID"] = new Array();
			}
			
			chkTrCount = chkRun[checkRun[mainOcc]["idVAP_OIHE"]]["TRNID"].length;
			chkRun[checkRun[mainOcc]["idVAP_OIHE"]]["TRNID"][chkTrCount] = checkRun[mainOcc]["VAP_OIDE_TRNID"];

			mainOcc += 1;
		}
		}
		catch(er){alert(er)}
		dDta["chkRun"] = chkRun;
		
		var currCount = 0;
		
		for (var i in chkRun)
		{
				
				
			var VAP_TRNID = chkRun[i]["TRNID"];
			var OIT = chkRun[i]["record"];
			
			$scope["payMain"][$scope["payMain"].length] = OIT;
			
			var occ = 0;
			var side = 0;
			
			var stubCount = 0;
								
			mainOcc = 0;
			while (mainOcc < VAP_TRNID.length)
			{	
				occ = 0;
			
				while (occ < paidRun.length )
				{
					var OITDET = paidRun[occ];
					
					if (VAP_TRNID[mainOcc] == OITDET.VAP_OIDE_TRNID && OIT.idVAP_OIHE != OITDET.VAP_OIDE_OITID)
					{
						if (side/2 == Math.round(side/2))
						{
							
							stubCount += 1
							
							currCount = $scope["payStub"].length;
							$scope["payStub"][currCount] = new Object();
							$scope["payStub"][currCount]["idVAP_OIHE"] = OIT["idVAP_OIHE"];
							
							$scope["payStub"][currCount]["leftVAP_OIDE_TRNID"] = paidRun[occ]["VAP_OIDE_TRNID"];
							$scope["payStub"][currCount]["leftVAP_OIHE_OITTY"] = paidRun[occ]["VAP_OIHE_OITTY"];
							$scope["payStub"][currCount]["leftVAP_OIHE_REFER"] = paidRun[occ]["VAP_OIHE_REFER"];
							$scope["payStub"][currCount]["leftVAP_OIHE_DOCDA"] = paidRun[occ]["VAP_OIHE_DOCDA"];
							$scope["payStub"][currCount]["leftVAP_OIDE_AMUNT"] = paidRun[occ]["VAP_OIDE_AMUNT"];
							
							$scope["payStub"][currCount]["rightVAP_OIDE_TRNID"] = "";
							$scope["payStub"][currCount]["rightVAP_OIHE_OITTY"] = "";
							$scope["payStub"][currCount]["rightVAP_OIHE_REFER"] = "";
							$scope["payStub"][currCount]["rightVAP_OIHE_DOCDA"] = "";
							$scope["payStub"][currCount]["rightVAP_OIDE_AMUNT"] = "";
							
							
						}
						else
						{
							$scope["payStub"][currCount]["rightVAP_OIDE_TRNID"] = paidRun[occ]["VAP_OIDE_TRNID"];
							$scope["payStub"][currCount]["rightVAP_OIHE_OITTY"] = paidRun[occ]["VAP_OIHE_OITTY"];
							$scope["payStub"][currCount]["rightVAP_OIHE_REFER"] = paidRun[occ]["VAP_OIHE_REFER"];
							$scope["payStub"][currCount]["rightVAP_OIHE_DOCDA"] = paidRun[occ]["VAP_OIHE_DOCDA"];
							$scope["payStub"][currCount]["rightVAP_OIDE_AMUNT"] = paidRun[occ]["VAP_OIDE_AMUNT"];
			
						}
						
						side += 1;	
					}
					occ += 1;
				}
				
				mainOcc += 1
			}
			while (stubCount > 20)
			{
				$scope["payStubExtra"][$scope["payStubExtra"].length] = $scope["payStub"][$scope["payStub"].length-1];
				$scope["payStub"].pop();
				stubCount = stubCount-1;
			}
			
			while (stubCount < 20)
			{
				currCount = $scope["payStub"].length;
				$scope["payStub"][currCount] = new Object();
				$scope["payStub"][currCount]["idVAP_OIHE"] = OIT.idVAP_OIHE;
						
				$scope["payStub"][currCount]["leftVAP_OIDE_TRNID"] = OIT.VAP_OIDE_TRNID;
				$scope["payStub"][currCount]["leftVAP_OIHE_OITTY"] = "";
				$scope["payStub"][currCount]["leftVAP_OIHE_REFER"] = "";
				$scope["payStub"][currCount]["leftVAP_OIHE_DOCDA"] = "";
				$scope["payStub"][currCount]["leftVAP_OIDE_AMUNT"] = "";
				
				$scope["payStub"][currCount]["rightVAP_OIDE_TRNID"] = "";
				$scope["payStub"][currCount]["rightVAP_OIHE_OITTY"] = "";
				$scope["payStub"][currCount]["rightVAP_OIHE_REFER"] = "";
				$scope["payStub"][currCount]["rightVAP_OIHE_DOCDA"] = "";
				$scope["payStub"][currCount]["rightVAP_OIDE_AMUNT"] = "";
				
				stubCount += 1;
			}
			
		}

		setTimeout(function()
		{
			$("#checkPrint").click();
		},10);
		
		dDta["payMain"] = $scope["payMain"];	
		dDta["payStub"] = $scope["payStub"];	

var debug = "";
debug += showProps(dDta.dbChk.vap_checks.checkRun ,"upd")
debug += showProps(dDta.payMain  ,"pma")
debug += showProps(dDta.payStub  ,"stu")
$("#focusGrid").val(debug)

	}
	
	$scope.checkSelect = function()
	{
		var found = false;
		
		
		$("[ng-model='OIT.SELECT']").each(function()
		{
		
			if ($(this).val() == "1" )
			{
				found = true;
			}
		});

		if (found == true)
		{

			var formNum = $scope.varFormPg;
			switch (formNum)
			{
				case 0:
				break;
				case 1:
				case 2:
					if (!$scope["POSTDATE"] && $scope.cancelTransaction != 1)
					{
						found = false;
					}

				break;
			}
					
		}

		if (found == true)
		{
			$scope["updateOn"] = 1;
			$("#ab-update").removeClass("hidden");
			
		}
		else
		{
		        $scope["updateOn"] = 0;
		        $("#ab-update").addClass("hidden");
		        
		}
		
		return found;
	}
	

	$scope.getCurrencies();
	
	
}


</script>



