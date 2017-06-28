<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vit_issue"] = "dbMain";


	$scope.statuses = new Array();
	
	var occ = 0
	$scope.statuses[occ] = new Object();
	$scope.statuses[occ]["status"] = "100"
	$scope.statuses[occ]["text"] = "New Entry"
	occ += 1;
	$scope.statuses[occ] = new Object();
	$scope.statuses[occ]["status"] = "200"
	$scope.statuses[occ]["text"] = "Viewed"
	occ += 1;
	$scope.statuses[occ] = new Object();
	$scope.statuses[occ]["status"] = "300"
	$scope.statuses[occ]["text"] = "Submitted"
	occ += 1;
	$scope.statuses[occ] = new Object();
	$scope.statuses[occ]["status"] = "400"
	$scope.statuses[occ]["text"] = "In Wip"
	occ += 1;
	$scope.statuses[occ] = new Object();
	$scope.statuses[occ]["status"] = "800"
	$scope.statuses[occ]["text"] = "Completed"
	occ += 1;
	$scope.statuses[occ] = new Object();
	$scope.statuses[occ]["status"] = "900"
	$scope.statuses[occ]["text"] = "Cancelled"
	occ += 1;	 
	
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}

A_LocalAgularFn.prototype.VIT_ISSUES = function($scope,$http,$routeParams)
{
	
	$scope.dateSearch = function()
	{
		if($scope.VIT_ISSUE_CDATE1>$scope.VIT_ISSUE_CDATE2)
		{
			alert('From date should not be greater than to date');
		}
		else
		{	
        $scope.ACVarFilterToggle('VIT_ISSUE_CDATE');	
		$scope.listVIT_ISSUE_CDATE=-1;
		$scope.ACVarFilterInit('VIT_ISSUE_CDATE','');
		}	
	
	}
	
	
	$scope.initFilters = function()
	{
		
		$scope.listVIT_ISSUE_DESC="";
		$scope.listVIT_ISSUE_USERID="";
		$scope.listVIT_ISSUE_CDATE="";
		$scope.listVIT_ISSUE_STATUS="";
	}
	
	
	
	
	$scope.initIssueDet = function()
	{
		
	
		$scope.idVIT_ISSUE = "0";
	        $scope.VIT_ISSUE_SESSION = $scope.opts.iSession;
	        $scope.VIT_ISSUE_PROCESS = $scope.opts.iProcess;
	        $scope.ABlstAlias('idVIT_ISSUE','idVIT_ISSUE','vit_issue','lister');


		        
}
	
	$scope.chkForNewIsssue = function()
    	{
       
		if ($scope.idVIT_ISSUE < 1 )
    		{
			
		    $scope.VIT_ISSUE_SESSION = $scope.opts.iSession;
			$scope.VIT_ISSUE_PROCESS = $scope.opts.iProcess;
			
		
    		}
    		else
    		{
               
    			$scope.setUpIssdet();
    		}
    		
    	}
    	
    	$scope.setUpIssdet = function(main,comm)
    	{
        
        $scope.ABinitTbl('vit_issue','idVIT_ISSUE');       
		$scope.ABupdChkObj('idVIT_ISSUE', $scope.opts.idVIT_ISSUE,true);
		$scope.ABchkMain();   		
    	}
	

	$scope.setIssueUserDet = function()
	{
         var Dat=Date.now();

         <?php
                 $tFnc = new AB_querySession;     
                  
                 $user = $tFnc->getUserData();
                 $userName=$user['userName'];
                
                 
                  ?>         
		$scope.VIT_ISSUE_USER='<?php echo $userName;?>';
	    $scope.VIT_ISSUE_SESSION = $scope.opts.iSession;
	    $scope.VIT_ISSUE_PROCESS = $scope.opts.iProcess;    
	    $scope.VIT_ISSUE_DESC=$scope.opts.iSessionDescr;
        $scope.VIT_ISSUE_TICKET=Dat;   
  	   	
 
		}		
	
	$scope.initFirstTimeDet = function()
	{
		
		if(!$scope.opts.idVIT_ISSUE)
		{
			$scope.getIssueDataDet(0);
		}
		else
		{
			$scope.getIssueDataDet($scope.opts.idVIT_ISSUE);
		}
		
		dDta["scope"] = $scope;
	}
	
	$scope.getIssueDataDet = function(idCode)
	{        
		// $scope.initIssueDet();
		 	
		$scope.idVIT_ISSUE = idCode;	
		$scope.ABinitTbl('vit_issue','idVIT_ISSUE');
		A_Scope.callBack = "$scope.setIssueUserDet();";
		
		$scope.ABchk();

	}
	
	// $scope.initFirstTimeDet();
	
	
	$scope.ACVarFilterHide = function()
	{
	
		$("[id^='flt']").addClass("ACdropdown");
	}
	

	$scope.ACVarFilterToggle = function(colName)
	{
		
		
		if ( !$scope["Orglist"+colName] || $scope["Orglist"+colName]== "")
		{
			 $scope["Orglist"+colName] =  $scope["list"+colName];
		}
			
		$("[id^='flt']").each(function()
		{
			if ($(this).attr("id") != "flt"+colName)
			{
				$(this).addClass("ACdropdown")
			}
		});
		
		$("#flt"+colName).toggleClass("ACdropdown");
	}	
	
	$scope.ACVarColSelToggle = function(colName,colVal)
	{

		var xSearch = $scope["list"+colName];
		var chkVal = encodeURI(colVal)
		
		
	    
		// alert(colName +"="+colVal+"="+chkVal+"=="+xSearch.indexOf("'" + chkVal + "'"))

		if (xSearch.indexOf("'" + chkVal + "'") > -1)
		{
			// Remove
			xSearch = xSearch.slice(0,xSearch.indexOf("'" + chkVal + "'")) + xSearch.slice(xSearch.indexOf("'" + chkVal + "'")+chkVal.length+2)
		
         }
		else
		{
			//Add
			xSearch += "'" + chkVal + "'"
		}
        
		
		
		$scope["list"+colName] = xSearch;

		$scope.ACVarFilterInit(colName,xSearch);

		
	}
	
	$scope.ACVarColSetIsOn = function(colName,colVal)
	{
		var xSearch = $scope["list"+colName];
		var chkVal = encodeURI(colVal)
	
		if (xSearch.indexOf("'" + chkVal + "'") > -1)
		{
			return true;
		}	
		else
		{
			return false;
		}
	}
	
	$scope.ACVarColSetIsOnA = function(colName,colVal,nn)
	{
		var xSearch = $scope["list"+colName];
		var chkVal = encodeURI(colVal)

		if (colName=="VIT_ISSUE_STATUS")
		{
			if (!dDta['ccc'])
			{
				dDta['ccc'] = new Array();
			}
			dDta['ccc'][dDta['ccc'].length] = chkVal + "=" +  $scope["list"+colName] + "=" + nn;
		}
	
		if (xSearch.indexOf("'" + chkVal + "'") > -1)
		{
			return true;
		}	
		else
		{
			return false;
		}
	}	
	
	$scope.ACVarFilterInit = function(colName,colVal)
	{
		// colVal = $scope["list"+colName];
		
		var occ = 0;
		
		while (occ < $scope["rawResult"]["vit_issue"].length)
		{	
			if ( !$scope["rawResult"]["vit_issue"][occ]["rowRowLog"] || !colName)
			{
				
				$scope["rawResult"]["vit_issue"][occ]["rowRowLog"] = new Object();
				$scope["rawResult"]["vit_issue"][occ]["rowRowLog"]["COLS"] = new Object();
				$scope["rawResult"]["vit_issue"][occ]["rowRowLog"]["hidden"] = "  ";
	          	
			}			
            
			if ($scope["list"+colName] == -1)
			{
				// Do nothing
				
				$scope["list"+colName] = $scope["Orglist"+colName];
				var colVal = $scope["list"+colName]
			    	
			 	
			}
			
			$scope["rawResult"]["vit_issue"][occ]["rowRowLog"]["COLS"][colName] = colVal;
			$scope["rawResult"]["vit_issue"][occ]["rowRowLog"]["hidden"] = " Ok ";
			
			var dta = $scope["rawResult"]["vit_issue"][occ]["rowRowLog"]["COLS"]
			
			// $scope["rawResult"]["vit_issue"][occ]["rowRowLog"]["hidden"] += "[" + colName + ":" + colVal  + "]";
			
			
			var dateCond = true;
			var datetmp = $scope["rawResult"]["vit_issue"][occ]["VIT_ISSUE_CDATE"];
			
			var dateCompare = datetmp.slice(0,4) + datetmp.slice(5,7) + datetmp.slice(8,10);
		
			for (var i in dta)
			{
				if ($scope.DateChk != 0 && ($scope.VIT_ISSUE_CDATE1 > dateCompare
				|| $scope.VIT_ISSUE_CDATE2 < dateCompare ))
				{
					dateCond = false;
				}
				// $scope["dateCond"] = dateCond + "[" + $scope.VIT_ISSUE_CDATE1 + "][" +  $scope.VIT_ISSUE_CDATE2 + "](" + dateCompare + " )";
				if (dta[i].indexOf("'" + encodeURI($scope["rawResult"]["vit_issue"][occ][i]) + "'")<0 || dateCond != true)
				{
					$scope["rawResult"]["vit_issue"][occ]["rowRowLog"]["hidden"] = "hidden";// "Not" + encodeURI($scope["rawResult"]["vit_issue"][occ][i]) + "in" +  dta[i];
				}
		  	}

  			// alert(colName + "=" + $scope["list"+colName])	

			

			occ += 1;
		}
		
			
	}
	
	
	
}
A_LocalAgularFn.prototype.VIT_ISSUECT = function($scope,$http,$routeParams)
{
	
	

	
	$scope.localABupd = function (opt)
	{
        
        var ok=false;
        var user='0';
        var usercd='user';
        <?php 
		$tFnct = new AB_querySession;
		$isAdmin = $tFnct->isUserAdmin();
		?>
		<?php
		$tFnc = new AB_querySession;		
		$user = $tFnc->getUserData();		
		$userCode=$user['userCode'];		 
		?>
		user='<?php echo $isAdmin;?>';
		usercd='<?php echo $userCode;?>';

	
	

		if((user<'1')&&(opt.toUpperCase()=="DELETE"))
		{
			ok=true;
		}	
		
		else if((user<'1')&&(opt.toUpperCase()=="UPDATE"))
		{		
			 
	           if((usercd==$scope.VIT_ISSUE_USERID)&&($scope.VIT_ISSUE_STATUS=='100'))
           {
              
               ok=false;
           }
           else
           {             
		   ok=true;
			   
           }						
           
		}
		else if(opt.toUpperCase()=="CREATE")
		{
			ok=false;
		}
				
		
		 
		if(ok)
        {              
        	$("#ab-main-rec-mess").html('Transaction is not processed due to insufficient privilege'); 
                       
        	$scope.ABupdCancel = true; 

        }	
				

		
	}
	
	
	
	$scope.initIssue = function()
	{
           
		    
           $scope.idVIT_ISSUE = $scope.opts.idVIT_ISSUE;
	        
	        
	        $scope.VIT_ISSUE_SESSION = $scope.opts.iSession;
	        $scope.VIT_ISSUE_PROCESS = $scope.opts.iProcess;
	        $scope.ABlstAlias('idVIT_ISSUE','idVIT_ISSUE','vit_issue','lister');
	
//		$scope.idVIT_ISSUE = "0";
//	        $scope.VIT_ISSUE_SESSION = $scope.opts.iSession;
//	        $scope.VIT_ISSUE_PROCESS = $scope.opts.iProcess;
//	        $scope.ABlstAlias('idVIT_ISSUE','idVIT_ISSUE','vit_issue','lister');

		        
	}
	
	$scope.chkForNewIsssue = function()
    	{
       
		if ($scope.idVIT_ISSUE < 1 )
    		{
			
		    $scope.VIT_ISSUE_SESSION = $scope.opts.iSession;
			$scope.VIT_ISSUE_PROCESS = $scope.opts.iProcess;
			
		
    		}
    		else
    		{
               
    			$scope.setUpIssdet();
    		}
    		
    	}
    	
    	$scope.setUpIssdet = function()
    	{
        

        $scope.ABinitTbl('vit_issdet','VIT_ISSDET_ISSUEID');       
		$scope.ABupdChkObj('VIT_ISSDET_ISSUEID', $scope.opts.idVIT_ISSUE,true);
		$scope.ABchkMain();   		
    	}
	

	
    $scope.prepDetail = function(mainId,commnt)
    {
    	
    	<?php
                $tFnc = new AB_querySession;     
                 
                $user = $tFnc->getUserData();
                $userName=$user['userName'];
               
                
         ?>         
		
    	$scope.VIT_ISSDET_USER='<?php echo $userName;?>';    	
		$scope.idVIT_ISSDET=0;
	    $scope.VIT_ISSDET_ISSUEID=mainId;
	    $scope.VIT_ISSDET_TEXT=commnt;

	   
    }

	$scope.issdetABupd = function(opt,mainId,commnt)
	{
			    
		$("#mainForm").attr("ab-main","vit_issdet");
//		$scope.prepDetail(mainId,commnt); 
	
		A_Scope.callBack = "$scope.initIssue(); ";
		$scope.ABupd(opt);
		
		$("#mainForm").attr("ab-main","vit_issue");
	
	}	

	$scope.setIssueUser = function()
	{
		if($scope.opts.idVIT_ISSUE<1)
		{
          var Dat=Date.now();
          <?php
         $tFnc = new AB_querySession;     
          
         $user = $tFnc->getUserData();
         $userName=$user['userName'];
         $userCode=$user['userCode'];
         
          ?>

        
          
		$scope.VIT_ISSUE_USER='<?php echo $userName;?>';
	
	    $scope.VIT_ISSUE_SESSION = $scope.opts.iSession;
	    $scope.VIT_ISSUE_PROCESS = $scope.opts.iProcess;    
	    $scope.VIT_ISSUE_DESC=$scope.opts.iSessionDescr;
        $scope.VIT_ISSUE_TICKET=Dat; 
        $scope.VIT_ISSUE_USERID='<?php echo $userCode;?>'; 
		} 
	   	
 
		}		
	
	$scope.initFirstTime = function()
	{
		if(!$scope.opts.idVIT_ISSUE)
		{
			$scope.getIssueData(0);
		}
		else
		{
			$scope.getIssueData($scope.opts.idVIT_ISSUE);
			
	 		}
			}
	
	$scope.getIssueData = function(idCode)
	{        
		
		$scope.initIssue();	
		
		$scope.ABinitTbl('vit_issue','idVIT_ISSUE');
		$scope.ABupdChkObj('idVIT_ISSUE', idCode,true);
		A_Scope.callBack = "$scope.setIssueUser();";				
		$scope.ABchk();
		
		
		
	}
	
	$scope.initFirstTime();

	
}

</script>

