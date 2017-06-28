<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}
	
A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	$scope.initMookPeriod = function()
	{
		var chkObj = new Object();
		chkObj["VGL_FISCAL_DATE"] =  $scope.ABGetDateFn('get-year','')+"0101";
	
		
		$scope.ABchk(chkObj,'vgl_jnentry');
	}    
	
	$scope.setFiscalYear = function(year)
	{
		$scope.yearSelected = year;
	}
	$scope.setFiscalMonth = function(mth)
	{
		var month = mth.toString();
		if (month.length <2)
		{
			month = "0" + month;
		}
		
		$scope.monthSelected = month;
	}
		
	$scope.computeFiscalDate = function(dta,tag)
	{

		var year = "";
		var per =  "";
		

		try
		{
			var res = dta.replace(/-/g, "");
			var adjPeriod = ($scope.vgl_jnentry[0]["VGL_JNHE_GLPER"]*1) - 1
			year = res.slice(0,4)*1;
			per =  res.slice(4,6)*1;
			
			per += adjPeriod
			if (per >12)
			{ 
				per = per -12;
				year = year + 1;
			}
		}
		catch(er){}
		
		if (tag == "YEAR")
		{
			return year;
		}
		else
		{
			return per;
		}
		
		
	}
	
	$scope.setPeriodSelection = function()
	{
		if ($scope.yearSelected)
		{
			return;
		}
		$scope.yearSelected = $scope.ABGetDateFn('get-year','');
		$scope.monthSelected = $scope.ABGetDateFn('get-month','');
		
		var months = "January,February,March,April,May,June,July,August,September,October,November,December".split(",");
		var startYear = ( $scope.yearSelected * 1 ) - 1;
		$scope.glFiscalRec = new Array();
		var occ = 0;
		var wocc = 0;
		var fLen = 0;
		while (occ < 3)
		{
			wocc = 0;
			while (wocc < 12)
			{
				fLen = $scope.glFiscalRec.length
				$scope.glFiscalRec[fLen] = new Object();
				$scope.glFiscalRec[fLen]["YEAR"] = startYear + occ;
				$scope.glFiscalRec[fLen]["MONTH"] = wocc + 1;
				$scope.glFiscalRec[fLen]["DESCR"] = months[wocc];
				wocc += 1;
			}
			occ += 1;
		}
		
	}
	
	
	
	A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}	

A_LocalAgularFn.prototype.VGL_JOURNALRP = function($scope,$http,$routeParams)
{

	$scope.VGL_JNHE_DOCDA_TO = $scope.ABGetDateFn('get-year','')+$scope.ABGetDateFn('get-month','') + $scope.ABGetDateFn('get-day','')
	$scope.VGL_JNHE_DOCDA_FR = $scope.ABGetDateFn('add-days',$scope.VGL_JNHE_DOCDA_TO + ",-30");

	$scope.REGISTER_DETAIL = '0';



	$scope.initGlAccount = function()
	{
		
		$scope.ABsearchAlias('vgl_chart','vgb_curr:idVGB_CURR = VGL_CHART_CURID','','vgl_chart','VGL_CHART_GLIDN ASC','$scope.setFirstLast();') 

	}
	
	$scope.setFirstLast = function()
	{
		$scope.VGL_CHART_GLIDN_FR = $scope.vgl_chart[0]["VGL_CHART_GLIDN"];
		$scope.VGL_CHART_GLIDN_TO = $scope.vgl_chart[$scope.vgl_chart.length-1]["VGL_CHART_GLIDN"];
	}
	
	$scope.selectAccount =function(val,objName)
	{

		if (objName!="VGL_CHART_GLIDN_SE")
		{
			$scope[objName] = val;
			$("#vsl_chartView").addClass("hidden");
			$(".glSearch").removeClass("bg-warning");
		}
		
		switch (objName)
		{
			case "VGL_CHART_GLIDN_FR":
			
				if ($scope.VGL_CHART_GLIDN_FR > $scope.VGL_CHART_GLIDN_TO || !$scope.VGL_CHART_GLIDN_TO)
				{
					$scope.VGL_CHART_GLIDN_TO = $scope.VGL_CHART_GLIDN_FR;
				}
				break;
				
			case "VGL_CHART_GLIDN_TO":
			
				if ($scope.VGL_CHART_GLIDN_FR > $scope.VGL_CHART_GLIDN_TO || !$scope.VGL_CHART_GLIDN_FR)
				{
					$scope.VGL_CHART_GLIDN_FR = $scope.VGL_CHART_GLIDN_TO;
				}
				break;

				
		}

	}

	$scope.getRegister = function()
	{

		var searchJoin = "vgl_jnde:idVGL_JNHE = VGL_JNDE_TRNID";
		searchJoin += ",vgl_chart:idVGL_CHART = VGL_JNDE_GLIDN";
		searchJoin += ",vgb_curr:idVGB_CURR = VGL_JNHE_CURID";
		
		var pattern = "[=SPE=] VGL_CHART_GLIDN >= '" + $scope.VGL_CHART_GLIDN_FR + "' AND VGL_CHART_GLIDN <= '" + $scope.VGL_CHART_GLIDN_TO + "' ";
		pattern += " AND VGL_JNHE_DOCDA >= '" + $scope.VGL_JNHE_DOCDA_FR + "' AND VGL_JNHE_DOCDA <= '" + $scope.VGL_JNHE_DOCDA_TO + "' ";
		$scope.ABsearchAlias('vgl_jnhe',searchJoin,pattern,'vgl_regDetail','VGL_CHART_GLIDN ASC','$scope.summRegister();')

	}

	$scope.summRegister = function()
	{
		$scope.vgl_register = new Array();
		dDta["vgl_register"] = new Array();
		
		var regObj = new Object();
		var occ = 0
		var tmpAmt = 0;
		var balTmp = 0;
		var debTmp = 0;
		var creTmp = 0;
		
		var glIDN = ""
		var recSet = $scope.vgl_regDetail;
		
		while (occ < recSet.length)
		{
			glIDN = recSet[occ]["VGL_CHART_GLIDN"]
			if (!regObj[glIDN])
			{
				regObj[glIDN] = recSet[occ];
				regObj[glIDN]["dbTotal"] = 0;
				regObj[glIDN]["crTotal"] = 0;
				regObj[glIDN]["amtBalance"] = 0;
			}

			tmpAmt = recSet[occ]["VGL_JNDE_GLAMT"]*1
			balTmp = regObj[glIDN]["amtBalance"] * 1
			debTmp = regObj[glIDN]["dbTotal"] * 1
			creTmp = regObj[glIDN]["crTotal"] * 1
					
			regObj[glIDN]["amtBalance"] = (balTmp + tmpAmt).toFixed(2);
			if (tmpAmt > 0)
			{
				regObj[glIDN]["dbTotal"] = (debTmp + (tmpAmt*1)).toFixed(2);
			}
			if (recSet[occ]["VGL_JNDE_GLAMT"] < 0)
			{
				regObj[glIDN]["crTotal"] = (creTmp + (tmpAmt*-1)).toFixed(2);
			}
			
			if (glIDN  *1 == 21001)
			{
				dDta["vgl_register"][dDta["vgl_register"].length] = tmpAmt + " -- " + regObj[glIDN]["amtBalance"]
			}				
			occ += 1;
		}
	
		
		try
		{	
			for (var i in regObj)
			{
				$scope.vgl_register[$scope.vgl_register.length] = regObj[i];
		  	}		
		}catch(er){}
		
		
		
	}

	$scope.getDetailJournal = function(obj)
	{
		if (obj["SPATTERN"] != "[=GETLAYOUT=]")
		{
			var oPattern = new Array();
			var occ = 0;
			while (occ < $scope.jrnTrans.length)
			{
				oPattern[occ] = " idVGL_JNHE = " + $scope.jrnTrans[occ]["idVGL_JNHE"];
				occ += 1;
			}
			if (oPattern.length>0)
			{
				var objPattern = "[=SPE=] " + oPattern.join(" OR ");
				$scope.ABsearchAlias('vgl_jnhe',obj["SUPPTBL"],objPattern,'vgl_journal',obj["ORDERBY"],'$scope.getSummary(out);');
			}
		}

	}
	
	$scope.getSummary = function(obj)
	{
		if (obj["SPATTERN"] != "[=GETLAYOUT=]")
		{
			var obFunc = "SUM(VGL_JNDE_GLAMT) AS AmtType, COUNT(idVGL_JNHE) AS NumbType";
			var onGb = "VGL_JNHE_GLFIS,VGL_JNHE_GLPER,VGL_JNDE_GLIDN";
			$scope.ABsearchAlias('vgl_jnhe',obj["SUPPTBL"],obj["SPATTERN"],'vgl_summ',obj["ORDERBY"],'',obFunc,onGb)
		}

	}
	
	$scope.getBalanceJournal = function()
	{
		
		var docDate = $scope.yearSelected + $scope.monthSelected + "01";
		
		
		var objPattern = "[=SPE=] ";
		objPattern += " VGL_JNHE_GLFIS = " + $scope.computeFiscalDate(docDate,"YEAR");
		objPattern += " AND VGL_JNHE_GLPER = " + $scope.computeFiscalDate(docDate,"PERIOD");

		var suppTbl = "vgl_jnde:idVGL_JNHE = VGL_JNDE_TRNID";
		suppTbl += ",vgl_chart:idVGL_CHART = VGL_JNDE_GLIDN";
		suppTbl += ",vgb_curr:idVGB_CURR = VGL_JNHE_CURID";		

		var orderBy = "VGL_CHART_GLIDN";

		var obFunc = "SUM(VGL_JNDE_GLAMT) AS AmtPost, COUNT(idVGL_JNHE) AS NumbType";
		var onGb = "VGL_JNHE_GLFIS,VGL_JNHE_GLPER,VGL_JNDE_GLIDN";
		
		$scope.ABsearchAlias('vgl_jnhe',suppTbl,objPattern,'vgl_balance',orderBy,'$scope.getBalSummary(out);',obFunc,onGb);

	}
	
	$scope.getBalSummary = function(obj)
	{
		if (obj["SPATTERN"] != "[=GETLAYOUT=]")
		{
			var obFunc = "SUM(VGL_JNDE_GLAMT) AS AmtPost , COUNT(idVGL_JNHE) AS NumbType";
			var onGb = "VGL_JNHE_GLFIS,VGL_JNHE_GLPER";
			$scope.ABsearchAlias('vgl_jnhe',obj["SUPPTBL"],obj["SPATTERN"],'vgl_balsumm',obj["ORDERBY"],'',obFunc,onGb)
		}

	}
	
		
	$scope.initMookPeriod();
	$scope.initGlAccount();	
	
	
	
}


A_LocalAgularFn.prototype.VGL_JOURNALCT = function($scope,$http,$routeParams)
{

	$scope.isPostDateValid = function()
	{
		var ret = true;
		if (!$scope.VGL_JNHE_DOCDA)
		{
			$scope.VGL_JNHE_DOCDA = "";
		}
		
		$scope.VGL_JNHE_DOCDA = $scope.VGL_JNHE_DOCDA.trim();
		if ($scope.VGL_JNHE_DOCDA.length !=8)
		{
			ret = false
			$("#ab-update").addClass("hidden");
		}
		else
		{
			
			$("#ab-update").removeClass("hidden");
		}
			
			
		
		
		return ret;
	}
	
	$scope.initGlPosting = function()
	{
		$scope.ABsearchAlias('vgl_chart','vgb_curr:idVGB_CURR = VGL_CHART_CURID','','vgl_chart','VGL_CHART_GLIDN ASC','$scope.getCurrencies()') 
//		$scope.VGL_CHART_GLIDN='';
//		A_Scope.callBack = "$scope.getCurrencies();";
//		$scope.ABlstAlias('VGL_CHART_GLIDN','VGL_CHART_GLIDN','vgl_chart',0);
//		$scope.VGL_CHART_GLIDN='';	
	}
	
	
	$scope.getCurrencies = function()
	{

		$scope.VGB_CURR_CURID='';
		
		$scope.ABlstAlias('VGB_CURR_CURID','VGB_CURR_CURID','vgb_curr',0);
		$scope.VGB_CURR_CURID='';	
		
	}

	$scope.initGlPosting();
	
	$scope.computeExchange = function(rec,rate)
	{
		
		var total = 0
		if (rec.VGL_JNDE_DEB_AMT!=0) 
		{
			total = rec.VGL_JNDE_DEB_AMT * rate
		}
		else
		{
			total = rec.VGL_JNDE_CRE_AMT * rate
		}
		
		total = total.toFixed(2);	
		return total;
	}
	
	$scope.setVarFormxx =function()
	{
		
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
			
			if ($scope["VAR_OIHE_DOCDA"]=="")
			{
				$scope["VAR_OIHE_DOCDA"] = $scope.ABGetDateFn('get-year','')+$scope.ABGetDateFn('get-month','')+$scope.ABGetDateFn('get-day','');
				
			}
			
		}
		else
		{
			$scope.updateOn = 0;
		}
		
		$scope.varFormPg = formNew
		
	}


	$scope.clickDate = function()
	{
		$('a').attr("onclick",'$("#getFiscal").click()');
	}
	
	$scope.initGlPostTimed	= function(DOCDA)
	{
		$('a').attr("onclick",'$("#getFiscal").click()');
		setTimeout(function()
		{
			
			$scope.initGlPost();
			
			
		},100);		
	}
	$scope.initGlPost = function(DOCDA)
	{
		var chkObj = new Object();
		if (DOCDA)
		{
			chkObj["VGL_FISCAL_DATE"] = DOCDA;
		}
		else
		{
			chkObj["VGL_FISCAL_DATE"] = $scope.VGL_JNHE_DOCDA;
		}
		
		$scope.ABchk(chkObj,'vgl_jnentry');
		
	}


	$scope.distributeBal = function()
	{
		var debit = 0;
		var credit = 0;
		$("[ng-model='jrn.VGL_JNDE_DEB_AMT']").each(function()
		{
			var x = Math.abs($(this).val())
			// x=x.toFixed(2)
			debit += Number(x)
			
			
		});
		
		$("[ng-model='jrn.VGL_JNDE_CRE_AMT']").each(function()
		{
			var x = Math.abs($(this).val())
			//x=x.toFixed(2)
			credit += Number(x);
			
		});
		
		$scope.totalDebit = $scope.ABGetNumberFn("fmt-curr",debit);
		$scope.totalCredit = $scope.ABGetNumberFn("fmt-curr",credit);
		
//			var ret = true;
//			if ($scope.totalDebit!=$scope.totalCredit)
//			{ 
//				ret = false;
//			}
		// return ret;
		
	}


	$scope.insertAccount = function(objIn)
	{
		
		
		if (!$scope["local_journal"])
		{
			$scope["local_journal"] = new Array();
		}

		var nextInsert = $scope["local_journal"].length;

		var objIdFound = false;
				
		var occ =0;
		while (occ < $scope.local_journal.length)
		{
			if (objIn == $scope.local_journal[occ]["idVGL_CHART"])
			{
				// alert(objIn+" == "+$scope.vgl_chart[occ]["idVGL_CHART"])
				objIdFound = true;
				occ = $scope.local_journal.length;
			}

			occ += 1;
		}
				
		occ =0;
		while (occ < $scope.vgl_chart.length && objIdFound == false)
		{
			if($scope.vgl_chart[occ]["idVGL_CHART"] == objIn)
			{
				$scope["local_journal"][nextInsert] = new Object();
		
				$scope["local_journal"][nextInsert]["local_trash"] = 0;
				$scope["local_journal"][nextInsert]["idVGL_CHART"] = $scope.vgl_chart[occ]["idVGL_CHART"];
				$scope["local_journal"][nextInsert]["VGL_CHART_GLIDN"] = $scope.vgl_chart[occ]["VGL_CHART_GLIDN"];
				$scope["local_journal"][nextInsert]["VGL_CHART_GLDES"] = $scope.vgl_chart[occ]["VGL_CHART_GLDES"];
				$scope["local_journal"][nextInsert]["VGL_CHART_CURID"] = $scope.vgl_chart[occ]["VGL_CHART_CURID"];
				$scope["local_journal"][nextInsert]["VGL_JNDE_DEB_AMT"] = '';
				$scope["local_journal"][nextInsert]["VGL_JNDE_CRE_AMT"] = '';
				$scope["local_journal"][nextInsert]["idVGL_JNHE"] = 1;
				$scope["local_journal"][nextInsert]["idVGL_JNDE"] = nextInsert + 1;

				occ = $scope.vgl_chart.length;
			}
			occ += 1;
		}
				
		occ =0;
		while (occ < $scope.local_journal.length)
		{
			if ($scope["local_journal"][occ]["local_trash"] == 1)
			{
				$scope["local_journal"].splice(occ,1);
			}
			else
			{
				$scope["local_journal"][occ]["idVGL_JNDE"] = occ + 1;
				occ += 1;
			}
		}
		
		var locid = "#debitId" + ($scope.local_journal.length-1)
		setTimeout(function()
		{
			if (objIdFound == false && $scope.local_journal.length>0)
			{				
				$(locid).focus()
			}
			$("#autoDistribute").click();
			
		},10);
		
		
		
	}
	
	$scope["idVAR_OIHE"] = 0;
	$scope.initVAR_OIHE = function()
	{
		var chkObj = new Object();
		chkObj["idVAR_OIHE"] = "0";
		$scope.ABchk(chkObj,'var_oihe');
		$scope["curBank"] = new Object();
		
		$("[ng-model='ORHE_HISTORY_CUST']").focus();
	}
	
	$scope.initNewCustomer = function()
	{

		$scope.initCust($scope.abSessionResponse.VGB_CUST_BPART);

	}	
	
	$scope.initCust = function(bparId)
	{
		var chkObj = new Object();
		chkObj["idVGB_BPAR"] = bparId;
		// A_Scope.callBack = "$scope.initOrheData();";
		A_Scope.callBack = "$scope.initOrheData(data);$scope.setVarForm(-1);";
		$scope.ABchk(chkObj,'var_items');
	}

	$scope.initOrheData = function(oDta)
	{
		
		$scope["VGB_BPAR_BPART"] = $scope["var_items"][0]["VGB_BPAR_BPART"];
		$scope["VAR_OIHE_BCUST"] = $scope["var_items"][0]["idVGB_CUST"];
		$scope["VAR_OIHE_BTADD"] = $scope["var_items"][0]["VGB_CUST_BTADD"];
		$scope["VAR_OIHE_TERID"] = $scope["var_items"][0]["VGB_CUST_TERID"];
		$scope["VAR_OIHE_NETDA"] = $scope["var_items"][0]["VGB_TERM_NETDA"];
		$scope["VAR_OIHE_DISDA"] = $scope["var_items"][0]["VGB_TERM_DISDA"];
		$scope["VAR_OIHE_DISCN"] = $scope["var_items"][0]["VGB_TERM_DISCN"];
		$scope["VAR_OIHE_CURID"] = $scope["var_items"][0]["VGB_CUST_CURID"];
		$scope["VAR_OIHE_CURAT"] = $scope["var_items"][0]["VGB_CURR_CURAT"];
		$scope["VAR_OIHE_OITTY"] = "";
		$scope["VAR_OIHE_DOCDA"] = "";
		$scope["VAR_OIHE_BPBNK"] = "";
		$scope["VAR_OIHE_AMUNT"] = "";
		$scope["VAR_OIHE_PMTDA"] = "";
		$scope["VAR_OIHE_CONNU"] = "";
		$scope["VAR_OIHE_REFER"] = "";
		
		$("#VAR_OIHE_BPBNKmain").html("");
		
		$scope["idVAR_OIHE"] = "";
		$("#ab-update").addClass("hidden");
		$("#ab-delete").addClass("hidden");
		$("#ab-create").removeClass("hidden");

		setDbErr($scope,oDta['posts']);
		A_Scope.setUpdTbl($scope,"var_oihe","dbMain",oDta['posts']);
	}


	
	$scope.setVarForm =function(formNum)
	{

		

		
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
			
			if ($scope["VAR_OIHE_DOCDA"]=="")
			{
				$scope["VAR_OIHE_DOCDA"] = $scope.ABGetDateFn('get-year','')+$scope.ABGetDateFn('get-month','')+$scope.ABGetDateFn('get-day','');
				
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
		$scope["VAR_OIHE_BNKID"] = fValue["idVGL_BANK"];
		$scope["VGL_BANK_PMTTY"] = fValue["VGL_BANK_PMTTY"];
		$scope["VGL_BANK_TYDET"] = fValue["VGL_BANK_TYDET"];
		
		$scope["curBank"] = fValue;
	}


	$scope.chkRangePartner = function(fieldName,tblName,tblField)
	{
		
		if($scope[fieldName].trim()!="")
		{
			$scope[tblField] = $scope[fieldName];
			A_Scope.callBack = "$scope.validateBpart('" + fieldName + "','" + tblName + "','" + tblField + "');";
		
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
				if (fieldName.indexOf("_CUST") >-1  && $scope["rawResult"]["vgb_bpar"][occ]["idVGB_CUST"] > 0)
				{
					$scope[fieldName] = $scope["rawResult"]["vgb_bpar"][occ][tblField];
				  	$scope["idVGB_BPAR"] = $scope["rawResult"]["vgb_bpar"][occ]["idVGB_BPAR"];
				  	$scope.initCust($scope["idVGB_BPAR"]);
				  	
				}
				

				
				occ += 1;
			}
			
			if ($scope[fieldName] == "")
			{
				$scope["VGB_BPAR_BPART"] =  $scope["var_items"][0]["VGB_BPAR_BPART"];		
			}
			$scope[fieldName] = "";

			
		}
		else
		{
			$scope["VGB_BPAR_BPART"] =  $scope["var_items"][0]["VGB_BPAR_BPART"];		
		}
	}

	$scope.accumAdjust = function()
	{
		var debug = "";
		var wtpBal = 0;
		var workNum = new Array();
		
		$scope["ADJBALANCE"] = 0;
		$("[ng-model='OIT.ADJAMOUT']").each(function()
		{
			if (isNaN($(this).val()))
			{
				$(this).val(0)
			}
			
			if ($(this).attr("trtype")!="INV")
			{
				$(this).val(Math.abs(Number($(this).val()))*-1);
			}
			else
			{
				$(this).val(Math.abs(Number($(this).val())));
			}
			
			if (Math.abs($(this).attr("trbal"))<Math.abs($(this).val()))
			{
				$(this).val(Number($(this).attr("trbal")))
			}
			
			
			// $scope["ADJBALANCE"] += Number($(this).val())
			
			var wNum = Number($(this).val()).toFixed(2);
			
			wtpBal  += wNum;
			workNum[workNum.length] = Number(wNum).toFixed(2);
			$(this).val($scope.ABGetNumberFn("fmt-curr",$(this).val()))
			
		});
		
		var occ = 0
		var newTotal = 0
		while (occ < workNum.length)
		{
			
			if (workNum[occ] < 0)
			{
				debug +=   "-[" + Math.abs(workNum[occ]) + "]="
				newTotal = Number(newTotal) - Math.abs(workNum[occ]);
				debug += newTotal 
			}
			else
			{
				debug +=   "+[" + Math.abs(workNum[occ]) + "]="
				newTotal = Number(newTotal) + Math.abs(workNum[occ]);
				debug += newTotal 
			}
			
			debug += "\n";
			newTotal = Number(newTotal).toFixed(2);
				
			occ += 1;
		}
		
		debug += "is equal to " + newTotal + "\n==" + wtpBal + "=="
		// $scope["ADJBALANCE"] = $scope.ABGetNumberFn("fmt-curr",$scope["ADJBALANCE"]);
		$scope["ADJBALANCE"] = $scope.ABGetNumberFn("fmt-curr",newTotal);
		debug += "==" + $scope["ADJBALANCE"] + "=="
		
		$("#focusGrid").val(debug)
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
		if ($scope["ADJBALANCE"] != 0)
		{
			return false;
		}
		if ($scope.varFormPg!=3 && $scope["VAR_OIHE_AMUNT"] == 0)
		{
			return false;
		}
		
		if ($scope.varFormPg==1 && $scope["VAR_OIHE_BNKID"] < 1)
		{
			return false;
		}
		
		if ($scope.varFormPg==1 && ($scope["curBank"]["VGL_BANK_CTRLV"]=='1' || $scope["curBank"]["VGL_BANK_CHECK"] =='1') )
		{
			
			if(!$scope["VAR_OIHE_CONNU"] || $scope["VAR_OIHE_CONNU"].trim() == "")
			{
				return false;
			}
			
			if(!$scope["VAR_OIHE_PMTDA"] || $scope["VAR_OIHE_PMTDA"].trim() == "")
			{
				return false;
			}
			
			if ($scope.ABGetDateFn('diff-today',$scope["VAR_OIHE_PMTDA"])>0 && $scope["postdatedchk"] != true)
			{
				return false;
			}
			if ($scope["VAR_OIHE_BPBNK"] > 0)
			{
			}
			else
			{
				return false;
			}
			
			
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
		if (isNaN($scope["VAR_OIHE_AMUNT"]))
		{
			$scope["VAR_OIHE_AMUNT"] = 0;
		}
		
		$scope["VAR_OIHE_AMUNT"] = Math.abs($scope["VAR_OIHE_AMUNT"]);
		$scope["VAR_OIHE_AMUNT"] = $scope.ABGetNumberFn("fmt-curr",$scope["VAR_OIHE_AMUNT"]);		
	}

//	$scope.initGlPost(VGL_JNHE_DOCDA);
//	$scope.ABlstAlias('VGL_CHART_GLIDN','VGL_CHART_GLIDN','vgl_chart',0);
	
	// $scope.initVAR_OIHE()
	
	
}

</script>



