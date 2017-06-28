<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}


A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	/* $scope,$http,$routeParams are Angular objects. 
	
		You can only access these variables with ng-events/functions
		 
		ng-events can replace and many time are more efficient then HTML event.
		ng-click
		ng-blur
		ng-keypress
		
		ng-event functions must be defined in the $scope objects		
		
	
	*/
	
	// First function
	$scope.recSet = new Array();
	
	$scope.setName01 = function()
	{
		$scope.message = "Hello Account Manager";
		$scope.CFG_USERS_CODE = "Gayle";
		$scope.CFG_USERS_DESIGNATION = "Gayle Berry";
	}

	// Secong function
	
	$scope.setName02 = function()
	{
		$scope.message = "Hello Boss";
		$scope.CFG_USERS_CODE = "Kerry";
		$scope.CFG_USERS_DESIGNATION = "Kerry Blake ";
	}

	$scope.setList = function(oCount)
	{
		doSomeStdJSFunction($scope,oCount)
	}

	$scope.dbFctn = function ()
	{
		doSomeDbFunction($scope,$http)
		
	}

	$scope.setList(3);

}


function doSomeStdJSFunction($scope,oCo)
{
	
	var obj = new Object();
	$scope["recSet"] = new Array();
	
	
	var occ = 0
	while (occ < oCo)
	{
		$scope["recSet"][occ] = new Object();
		$scope["recSet"][occ].col01 = occ + 1;
		$scope["recSet"][occ].col02 = "Session " 
		$scope["recSet"][occ].col03 = "Name of someone";
		$scope["recSet"][occ].col04 = 10 * ($scope["recSet"][occ].col01 + 1) / 2;
		
		// $scope["recSet"][occ] = obj;	
		
		occ += 1
	}
	
	
	
}

function doSomeDbFunction($scope,$http)
{
	
	var out = new Object();
	out["PROCESS"] = "Nothing"
	
	$http.post('stdSscript/stdPHPSql.php',out)
	.success(function (data, status, headers, config)
	{
		$scope.postMessage = "Post successfull nothing returned in data - faking it"  
		
		$scope.CFG_USERS = new Array();
		var occ = 0;
		$scope.CFG_USERS[occ] = new Object();
		$scope.CFG_USERS[occ]["CFG_USERS_ID"]= 		"1";
		$scope.CFG_USERS[occ]["CFG_USERS_CODE"]= 	"GAYLE";
		$scope.CFG_USERS[occ]["CFG_USERS_DESIGNATION"]= "Gayle";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTLEVEL"]= 	"MTL";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTGROUP"]= 	"MNG";
		
		occ += 1;	
		$scope.CFG_USERS[occ] = new Object();
		$scope.CFG_USERS[occ]["CFG_USERS_ID"]= 		"2";
		$scope.CFG_USERS[occ]["CFG_USERS_CODE"]= 	"KERRY";
		$scope.CFG_USERS[occ]["CFG_USERS_DESIGNATION"]= "Kerry";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTLEVEL"]= 	"MTL";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTGROUP"]= 	"SUP";
			
		occ += 1;	
		$scope.CFG_USERS[occ] = new Object();
		$scope.CFG_USERS[occ]["CFG_USERS_ID"]= 		"3";
		$scope.CFG_USERS[occ]["CFG_USERS_CODE"]= 	"AMANDA";
		$scope.CFG_USERS[occ]["CFG_USERS_DESIGNATION"]= "Amanda";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTLEVEL"]= 	"MTL";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTGROUP"]= 	"SALES";
			
		occ += 1;	
		$scope.CFG_USERS[occ] = new Object();
		$scope.CFG_USERS[occ]["CFG_USERS_ID"]= 		"4";
		$scope.CFG_USERS[occ]["CFG_USERS_CODE"]= 	"DRAKE";
		$scope.CFG_USERS[occ]["CFG_USERS_DESIGNATION"]= "Drake";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTLEVEL"]= 	"TOR";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTGROUP"]= 	"SUP";
			
		occ += 1;	
		$scope.CFG_USERS[occ] = new Object();
		$scope.CFG_USERS[occ]["CFG_USERS_ID"]= 		"5";
		$scope.CFG_USERS[occ]["CFG_USERS_CODE"]= 	"SANDY";
		$scope.CFG_USERS[occ]["CFG_USERS_DESIGNATION"]= "Sandy";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTLEVEL"]= 	"MTL";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTGROUP"]= 	"PURC";
			
		occ += 1;	
		$scope.CFG_USERS[occ] = new Object();
		$scope.CFG_USERS[occ]["CFG_USERS_ID"]= 		"6";
		$scope.CFG_USERS[occ]["CFG_USERS_CODE"]= 	"BOB";
		$scope.CFG_USERS[occ]["CFG_USERS_DESIGNATION"]= "Bob";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTLEVEL"]= 	"MTL";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTGROUP"]= 	"REPS";
			
		occ += 1;	
		$scope.CFG_USERS[occ] = new Object();
		$scope.CFG_USERS[occ]["CFG_USERS_ID"]= 		"7";
		$scope.CFG_USERS[occ]["CFG_USERS_CODE"]= 	"GUYLAINE";
		$scope.CFG_USERS[occ]["CFG_USERS_DESIGNATION"]= "Guylaine";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTLEVEL"]= 	"MTL";
		$scope.CFG_USERS[occ]["CFG_USERS_DFLTGROUP"]= 	"SALES";
			
				
		
		
		
	});
	
}

</script>