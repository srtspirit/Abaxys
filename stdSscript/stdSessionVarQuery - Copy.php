<?php



class AB_querySession
{

	function getCurrentAffect()
	{
		

		$affect = array();
		$tObj = $_SESSION["AB_DUSA"]["usrLevels"]["Affectations"];
		

		$occ = 0;
		while ($occ < count($tObj))
		{
			if ($occ == 0)
			{
				$dusa = $tObj[$occ];				
			}
			if ($tObj[$occ]['levelId'] == $_SESSION["AB_DUSA"]['usrLevels']['CurrentAffect'])
			{
				$affect = $tObj[$occ];				
				$occ = count($tObj);
				$lFound = true;
			}
			$occ += 1;
		}
		
		if ($lFound != true)
		{
			$affect = $dusa;
		}
		
		return $affect;
		
	}
	

	
	function getUserData()
	{
		$obj = array();
		
		$obj["userCode"]=$_SESSION["AB_DUSA"]["userCode"];
		$obj["userName"]=$_SESSION["AB_DUSA"]["userName"];
		$obj["userType"]=$_SESSION["AB_DUSA"]["userType"];
		
		return $obj;
	}
	
	
	function isOrgLevel($tblName)
	{	
		

		$tObj = $_SESSION["AB_DUSA"]["orgTables"];

		// temps for phase A testing otherwise directly to next if
		if ( !$tObj[$tblName] )
		{	
			$tObj = $_SESSION["AB_CTRL"]["orgTables"];

		
		}
		// temps for phase A testing otherwise directly to next if
		
		if ( !$tObj[$tblName] )
		{
			$ret = false;
		}
		else
		{
			$ret = $tObj[$tblName];
		}
		
		return $ret;	
	}
	
	function hasTblCtrts($sesDta,$tblName)
	{
		// Has table constraints
		// if $process && $session are blank checks in AB_CTRL['usrTables'][$tblName]
		// else
		// Checks in AB_CTRL[$process] for $session and $tblName
		// Returns object found or false

		$process = "";
		$session = "";
		
		if ($sesDta["PROCESS"] && $sesDta["SESSION"])
		{
			$process = $sesDta["PROCESS"];
			$session = $sesDta["SESSION"];
		}
		
		if ($process == "" && $session == "")
		{
			if (!$_SESSION['AB_CTRL']['usrTables'][$tblName])
			{
				return false;
			}
			else
			{
				return $_SESSION['AB_CTRL']['usrTables'][$tblName];
			}
		}
		else
		{
			if ($process == "" || $session == "")
			{
				return false;
			}
			else
			{

				$ret = false;
	
				$tObj = $_SESSION["AB_CTRL"]["usrSessions"][$process];
				
				$occ = 0;
				while ($occ < count($tObj))
				{
					
					if ($tObj[$occ]["TblName"] == $tblName && $tObj[$occ]["Session"] == $session )
					{
						
						$ret = $tObj[$occ];
						$occ = count($tObj);
					}
					
					$occ += 1;
				}
				
				return $ret;
			}
			
		}	
		
	}
	
	
	function isSuperAdmin()
	{
		if ($_SESSION["AB_DUSA"]["userType"] == "ADM")
		{ 
			return true;
		}
		else
		{ 
			return false;
		}
		
	}
	
	function isUserAdmin()
	{
		$ret = 0;
		$affecs = $_SESSION["AB_DUSA"]["usrLevels"]["Affectations"];
		$occ = 0;
		while ($occ < count($affecs) && $ret == 0)
		{
			if($affecs[$occ]["groupDescr"]=="ADMIN")
			{
				$ret=1;
			}
			
			$occ += 1;
		}
		
		
		return $ret;
	}

	function tblAccessCond($sesDta,$trig,$condOn,$cond)
	{
	// $con should be "onaccess" or "onupdate" for checks
	// $con + ":USR" = user level
	
	
		// $tFnc = new AB_querySession;
		$condList = explode(",",$cond);
		$wout = array();
		
		while (strpos($trig,"[=COND:"))
		{
			$wcp = strpos($trig,"[=COND:");
			$wtb = substr($trig,$wcp+7);
			$wtb = substr($wtb,0,strpos($wtb,"=]"));
			
			
			$wCond = "";
			$occ = 0;
			while ($occ < count($condList) && $condOn)
			{	
				if (strpos($condList[$occ],".USR")>0)
				{
					$ab_Dusa = $this->hasTblCtrts("",$wtb); // Table User level
					$ab_Dusa_ex = $this->hasTblCtrts($sesDta,$wtb); // Table Process & User  Level
					$condList[$occ] = str_replace(".URS","",$condList[$occ]);	
				}
				else
				{
					$ab_Dusa = $this->isOrgLevel($wtb); // Dimension 
					$ab_Dusa_ex = "";
				}
				
						
				if ($ab_Dusa[$condList[$occ]])
				{
					$wCond .= " AND " . $ab_Dusa[$condList[$occ]] . " ";
				}
				if ($ab_Dusa_ex[$condList[$occ]])
				{
					$wCond .= " AND " . $ab_Dusa_ex[$condList[$occ]] . " ";
				}
				$wout[count($wout)]["DUSA"] = $this->isOrgLevel($wtb);
				$wout[count($wout)-1]["DUXX"] = $ab_Dusa_ex;
				
				$occ += 1;
			}
			
			$this->conditions = $wout;
			
			$trig = substr($trig,0,$wcp) . $wCond . substr($trig,$wcp+9+strlen($wtb));
	
		}	
	
		return $trig;
	
	}
	
	function hasPriviledge($sesDta,$tblName,$priv)
	{
		// if $priv == "" returns priviledges
		$ret = 0;
		
		if ($sesDta["PROCESS"] && $sesDta["SESSION"])
		{
			$tObj = $_SESSION["AB_CTRL"]["usrSessions"][$sesDta["PROCESS"]];
			
			$occ = 0;
			while ($occ < count($tObj))
			{
				
				if ($tObj[$occ]["TblName"] == $tblName && $tObj[$occ]["Session"] == $sesDta["SESSION"] )
				{
					
					if ($priv && strpos(",".strtoupper($tObj[$occ]["Priviledges"]),strtoupper($priv))>0)
					{
						$ret = 1;
					}
					if ($priv == "")
					{
						$ret = $tObj[$occ]["Priviledges"];
					}
					
					$occ = count($tObj);
				}
				
				$occ += 1;
			}
			
			
		}
		
		if ($sesDta["PROCESS"]=="VBP_GLOBAL" && $sesDta["SESSION"]=="VBP_GLOBAL")
		{
			$ret = 1;
		}
		return $ret;
		
	}
	
	function crapPriviledge($sesDta,$tblName,$priv)
	{
		// if $priv == "" returns priviledges
		$ret = 0;
		
		if ($sesDta["PROCESS"] && $sesDta["SESSION"])
		{
			$tObj = $_SESSION["AB_CTRL"]["usrSessions"][$sesDta["PROCESS"]];
			
			$occ = 0;
			while ($occ < count($tObj))
			{
				
				if ($tObj[$occ]["TblName"] == $tblName && $tObj[$occ]["Session"] == $sesDta["SESSION"] )
				{
					if (strpos(",".strtoupper($tObj[$occ]["Priviledges"]),strtoupper($priv))>0)
					{
						$ret = 1;
					}
					if ($priv == "")
					{
						$ret = $tObj[$occ]["Priviledges"];
					}
					
					$occ = count($tObj);
				}
				
				$occ += 1;
			}
			
			
		}
		
		return $ret;
		
	}


	function getschemaReference($tblName)
	{

		$rObj = array();

		$module = substr($tblName,0,3);
		$trig = " select * FROM cfg_dbref ";
		if ($tblName != "")
		{
			$trig .= "WHERE CFG_DBREF_CODE = :CFG_DBREF_CODE ";
		}

		$servername = "67.205.85.9";
		// $servername = "localhost";
		$username = $_SESSION['dbUser'];
		$password = $_SESSION['dbUserPwd'];
		
		$dbname = "orgdim";
		$dbname = "org_dimension";

		try 
		{

			$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 				
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, $options);
			$stmt = $conn->prepare($trig);
	
			if ($tblName != "")
			{
				$keyName = "CFG_DBREF_CODE";
				$keyVal = $module;
				$keyType = PDO::PARAM_STR;
				$stmt->bindValue(":" . $keyName,$keyVal,$keyType);
			}
	
			$stmt->execute();
		}	
		catch(PDOException $e)
		{
			$erObj = "fucking error";
			return $erObj;
			// header('Location:../login.php');
		}

			
		$wDate = getdate();
			
		$rObj['GSRerrorCode'] = $stmt->errorCode();
		$rObj['GSRerrorInfo'] = $stmt->errorInfo();
		$rObj['GSRrowCount'] = $stmt->rowCount();
		
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
		$rObj['GSRresult'] = $result;

		$conn = null;

		return $rObj;		
	}
}




?>

	