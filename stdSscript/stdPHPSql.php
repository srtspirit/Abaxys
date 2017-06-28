<?php
session_start();ob_clean();

// $schema is evaluated based on table name later: This is default and is not used
$schema = $_POST['SCHEMA'];
if (!$_POST['SCHEMA'])
{
	$schema = "ERP_002";
}

$tbl = $_POST['TBLNAME'];


$inPost = json_decode(file_get_contents('php://input'), true);

if (!$inPost)
{
	
	foreach($_POST as $name => $value)
	{

		 $inPost[$name] = stripslashes($value);
	}	
}


// Partners
// include 'TBA_TBL_MAINPartner.php';

$appProcess = $inPost['PROCESS']; 
$appSession = $inPost['SESSION']; 

$_SESSION["lastPost"] =  $inPost;

require_once "stdSessionVarQuery.php" ;
require_once "stdPHPfunctions.php" ;
require_once "stdMasterClasses.php" ;
require_once "stdSearchMaster.php" ;
require_once "stdListerMaster.php" ;
// require_once "stdAppobjGen.php";

// require_once "stdAmountWords.php";



// New method to get SCHEMA AND QUERY Organisation DIM Level information and access rights



$tFnc = new AB_querySession;
$newSchema = $tFnc->getschemaReference( $inPost['TBLNAME']);
if ($newSchema['GSRrowCount'] > 0)
{
	$inPost['SCHEMA'] = $newSchema['GSRresult'][0]['CFG_DBREF_SCHEMA'];
}
$_SESSION["setEpost"] = "it for :" . $inPost['SCHEMA'] . $inPost['TBLNAME'] . "=";
$inPost = setEpost($inPost['SCHEMA'],$inPost);



// Scripts can be included if table requires special update processes and checks.
// These scripts usually contain a CLASS for the target Table and table set
// ie: class vgb_cust extends dbMaster
	
	// check to see if script with process name exist and include
	if (file_exists('../appSscript/' . $appProcess . '.php'))
	{
		require_once '../appSscript/' . $appProcess . '.php';
	}
	
	// check to see if script with session name exist and include
	if (file_exists('../appSscript/' . $appSession . '.php'))
	{
		require_once '../appSscript/' . $appSession . '.php';
	}
	




$schema = $inPost['SCHEMA'];
$tbl = $inPost['TBLNAME'];
// $ha=eval("$tbl($schema)");
$hx=new dbMaster($tbl,$schema);
$hmethods = $tbl . "=".class_exists($tbl);


function getVars($obj) 
{
	$occ = 0;
	$arr = get_object_vars($obj);
	$ret = array();

	foreach ($arr as $prop => $val) 
	{
    		
		$tmp["name"] = $prop;
		$tmp["val"] = $val;

    		$ret[$occ] = $tmp;
    		$occ += 1;    		
	}
	
	return $ret;

}


function getMethods($obj) 
{
	$ret = array();
	$occ = 0;
	$arr = get_class_methods(get_class($obj));
	foreach ($arr as $method  ) 
	{
		$tmp["name"] = $method;
		$tmp["desc"] = "Empty";
    		$ret[$occ] = $tmp;
    		$occ += 1;
	}
	
	return $ret;
	
}


function setTable($tbl,$schema)
{

// Check IF Scripts included with new class definition for table.
// ie: class vgb_cust extends dbMaster

	if (class_exists($tbl))
	{
		 $eva = "\$master = new " . $tbl . "('$schema');";
		 eval($eva);
	}
	else
	{
		$master = new dbMaster($tbl,$schema);
	}

	
		
	return $master;
	
}

if ($inPost["METHOD"]== "TABLELIST")
{


$tFnc = new AB_querySession;
$newSchema = $tFnc->getschemaReferenceType($inPost["SCHEMALIST"]);

if ($newSchema != "")
{
	$dbname = $newSchema;
}
else
{
	$dbname = $inPost["SCHEMALIST"];
}
	
	$_SESSION['ABtblLayout'] = array();

	// Was main administrator before mod
	$username = "devUser";
	$password = "Nesh792ab";	
					
	if (!mysql_connect('localhost',$username,$password)) {
	    echo 'Could not connect to mysql';
	    exit;
	}
	
	$sql = "SHOW TABLES FROM $dbname";
	$result = mysql_query($sql);
	
	if (!$result) {
	    echo "DB Error, could not list tables\n";
	    echo 'MySQL Error: ' . mysql_error();
	    exit;
	}
	
	$tableSet = array();
	
	while ($row = mysql_fetch_row($result)) 
	{
	
		$trig ="SELECT *  FROM INFORMATION_SCHEMA.TABLES  WHERE TABLE_SCHEMA='" . $dbname . "' AND TABLE_NAME='" .$row[0]."'";
		$trResult = mysql_query($trig);
		if($rec = mysql_fetch_array($trResult)) 
		{
			$tDescr = $rec['TABLE_COMMENT'];
		}
		else
		{
			$tDescr = "XXXX";
		}
			
		$tableSet[count($tableSet)]['tblName'] = $row[0];
		$tableSet[count($tableSet)-1]['tblDesc'] = $tDescr;
		$tableSet[count($tableSet)-1]['tblLayout'] = new dbMaster($row[0],$dbname);
		$tableSet[count($tableSet)-1]['tblStats'] = $tableSet[count($tableSet)-1]['tblLayout']->ABCountTableRecords('local:');
		$tableSet[count($tableSet)-1]['tblStatsOrg'] = $tableSet[count($tableSet)-1]['tblLayout']->ABCountTableRecords('org:');
		if ($tableSet[count($tableSet)-1]['tblLayout']->orgLevelType == "Master")
		{
			$tableSet[count($tableSet)-1]['ABsearch'] = " *** Master";
		} 
		
		$_SESSION['ABtblLayout'][$row[0]] = array();
		foreach($tableSet[count($tableSet)-1]['tblLayout'] as $name => $value)
    		{
    			if ($name=="tblInfo" || $name=="tblPrimary" || $name=="tblUnique" || $name=="tblCtrts"  || $name=="tblFlds")
    			{
	    			$_SESSION['ABtblLayout'][$row[0]][$name] = array();
	    			foreach($value as $xname => $xval)
	    			{
	    				if (strpos("X".$xname,"PDOrow") > 0 || strpos("X".$xname,"Create") > 0)
	    				{
	    				}
	    				else
	    				{ 
	    					$_SESSION['ABtblLayout'][$row[0]][$name][$xname] = $xval;
	    				}
	    			}
	    		}
    				
    		}
    					
			
	}
	
	// $_SESSION['ABtblLayout'] = array();
	
	
	mysql_free_result($result);
	
		
	echo json_encode(array('posts' => $tableSet));	
	exit;



}

//function buildDefaultSearch(
//{
//$xtmp = new appForm("stdSearchDsp");
//$sparm = array();
//$sparm["searchLabel"] = "{{viewLabel}}";
//$sparm["searchTable"] = "{{viewTable}}";
//$sparm["searchJoin"] = "";
//$sparm["searchResult"] = "ABsearchvgb_cust";
//$sparm["searchFilter"] = "hid2den";
//$sparm["filterExclude"] = "VGB_BPAR_BPNAM,VGB_BPAR_CDATE";
//$sparm["filterAuto"] = "VGB_BPAR_BPART";
//
//$hardCode = $xtmp->setSearchMaster($sparm);
//}






if ($inPost["METHOD"]== "CLASSREF")
{
	
	$classOut = array();
	
	if (strlen(strpos($_SESSION["admin"],"[ADM")) > 0 )
	{
	
		$master = setTable($tbl,$schema);
		$master->requestMethod = $inPost["METHOD"];
//		if (class_exists($tbl))
//		{
//			 $eva = "\$master = new " . $tbl . "('$schema');";
//			 eval($eva);
//		}
//		else
//		{
//			$master = new dbMaster($tbl,$schema);
//		}

		$xout = getMethods($master);			
		$classOut["dbMaster"]["Meth"] = $xout;                  
		$xout = getVars($master);                           
		$classOut["dbMaster"]["Vars"] = $xout; 
		$classOut["dbMaster"]["Vals"] = getObjVals($master,"",""); 
		
		
		$xout = getMethods($master->tblInfo);                                                                       
		$classOut["tblInfo"]["Meth"] = $xout;                                                                       
		$xout = getVars($master->tblInfo);                  
		$classOut["tblInfo"]["Vars"] = $xout;       
		$classOut["tblInfo"]["Vals"] = getObjVals($master->tblInfo,"",""); 
		
		$xout = getMethods($master->tblPrimary);                                                                    
		$classOut["tblPrimary"]["Meth"] = $xout;                                                                    
		$xout = getVars($master->tblPrimary);               
		$classOut["tblPrimary"]["Vars"] = $xout;  
		$classOut["tblPrimary"]["Vals"] = getObjVals($master->tblPrimary,"","");  		  
		
		$xout = getMethods($master->tblUnique);                                                                     
		$classOut["tblUnique"]["Meth"] = $xout;                                                                     
		$xout = getVars($master->tblUnique);                
		$classOut["tblUnique"]["Vars"] = $xout;     
		$classOut["tblUnique"]["Vals"] = getObjVals($master->tblUnique,"","");  		  
		
		$xout = getMethods($master->tblCtrts);                                                                      
		$classOut["tblCtrts"]["Meth"] = $xout;                                                                      
		$xout = getVars($master->tblCtrts);                 
		$classOut["tblCtrts"]["Vars"] = $xout;      
		$classOut["tblCtrts"]["Vals"] = getObjVals($master->tblCtrts,"","");  		  
		
		$xout = getMethods($master->tblFlds);                                                                       
		$classOut["tblFlds"]["Meth"] = $xout;                                                                       
		$xout = getVars($master->tblFlds);                  
		$classOut["tblFlds"]["Vars"] = $xout;
		$classOut["tblFlds"]["Vals"] = getObjVals($master->tblFlds,"","");  		         
                                            
 
		
	};
	

	echo json_encode(array('posts' => $classOut));	
	exit;
}



if ($inPost['METHOD'] == "REQINFO")
{
	$schema = $inPost['SCHEMA'];
	
	// $tbl = explode(",",$inPost['TBLNAME']);
	$tbl = $inPost['TBLNAME'];

	$xout = array();
	$tblQuery = new dbMaster($tbl,$schema);
	$xout[$tbl] = array();
 	$xout[$tbl] = dspTblInfo($tblQuery);
 	$refXout = $tblQuery->tblCtrts->dta;
 	$occ = 0;
 	while ($occ < count($refXout))
 	{
 		$nTable = $refXout[$occ]['refTbl'];
 		if (!$xout[$nTable])
 		{
		 	$tblQuery = new dbMaster($nTable,$schema);
		 	$xout[$nTable] = dspTblInfo($tblQuery);
		}
		
 		$occ += 1;
 	}
	

	echo json_encode(array('posts' => $xout));
	exit;	
	
}



if ($inPost['METHOD'] == "REQSING" || $inPost['METHOD'] == "REQFULL")
{

	$schema = $inPost['SCHEMA'];
	$tbl = $inPost['TBLNAME'];
	

	if ($inPost['METHOD'] == "REQFULL")
	{
		
		$tblQuery = setTable($tbl,$schema);
	}
	else
	{
		$tblQuery = new dbMaster($tbl,$schema);
			
	}		
	
	$tblQuery->requestMethod = $inPost["METHOD"];
	

	if ($inPost['RAWMATCH'] )
	{
		$tblQuery->dbChkMatch($inPost);
	}


	if ($inPost["MATCH"] == "1")
	{
		
		$tblQuery->dbFindMatch($inPost);
	}
	else
	{
		$tblQuery->dbFindFrom($inPost);
	}
	
	$tblQuery->methods = $hmethods;

	echo json_encode(array('posts' => $tblQuery));
	exit;
}

if ($inPost['METHOD'] == "BORROW")
{
	$tblQuery = setTable($tbl,$schema);
	$tblQuery->requestMethod = $inPost["METHOD"];
	
//	if (class_exists($tbl))
//	{
//		 $eva = "\$tblQuery = new " . $tbl . "('$schema');";
//		 eval($eva);
//	}
//	else
//	{
//		$tblQuery = new dbMaster($tbl,$schema);
//	}
	$tblQuery->RAWBORROW = true;
	// $tblQuery->dbChkMatch($inPost);
	$tblQuery->dbOrgShare($inPost);
	
	$tblQuery->methods = $hmethods;			
	echo json_encode(array('posts' => $tblQuery));
	exit;		
}


if ($inPost['METHOD'] == "CREATE")
{
	$tblQuery = setTable($tbl,$schema);
	$tblQuery->requestMethod = $inPost["METHOD"];
	
//	$tblQuery = new dbMaster($tbl,$schema);
	$tblQuery->dbInsRec($inPost);
	
	$tblQuery->methods = $hmethods;
	echo json_encode(array('posts' => $tblQuery));
	exit;		
}

if ($inPost['METHOD'] == "UPDATE")
{
	$tblQuery = setTable($tbl,$schema);
	$tblQuery->requestMethod = $inPost["METHOD"];
	
//	$tblQuery = new dbMaster($tbl,$schema);
	$tblQuery->dbUpdRec($inPost);

	$tblQuery->methods = $hmethods;
	echo json_encode(array('posts' => $tblQuery));
	exit;		
}

if ($inPost['METHOD'] == "SEARCHMASTER")
{
	$tblQuery = new dbSearchMaster($schema,$inPost);
	echo json_encode(array('posts' => $tblQuery));
	exit;		
}

if ($inPost['METHOD'] == "SEARCHLISTER")
{
	$tblQuery = new ItemLister($schema);
	// $tblQuery = ListerMaster::createListerInstance($schema,$inPost);
	
	//$tblQuery->getListBasedOnGroup($inPost["group"], "2");
	//$tblQuery->getListBasedOnGroup("ItemCategory", "3");
	//$tblQuery->getRootGroups();
	//$tblQuery->getListBasedOnRootGroup("ItemCategory");
	$tblQuery->getListBasedOnGroup("ItemCategory", "2");
	echo json_encode(array('posts' => $tblQuery));
	exit;		
}


if ($inPost['METHOD'] == "VALIDATE")
{
	$tblQuery = setTable($tbl,$schema);
	$tblQuery->requestMethod = $inPost["METHOD"];
//	if (class_exists($tbl))
//	{
//		 $eva = "\$tblQuery = new " . $tbl . "('$schema');";
//		 eval($eva);
//	}
//	else
//	{
//		$tblQuery = new dbMaster($tbl,$schema);
//	}
		
	$tblQuery->dbValidConstraints($inPost);

	$tblQuery->methods = $hmethods;
	echo json_encode(array('posts' => $tblQuery));
	exit;		
	
}

if ($inPost['METHOD'] == "DELETE")
{
	$tblQuery = setTable($tbl,$schema);
	$tblQuery->requestMethod = $inPost["METHOD"];
	
//	$tblQuery = new dbMaster($tbl,$schema);
	$tblQuery->dbDelRec($inPost);
	
	$tblQuery->methods = $hmethods;
	echo json_encode(array('posts' => $tblQuery));
	exit;		
}

if ($inPost['METHOD'] == "ABBASELIST")
{

	if (file_exists('../appSscript/' .  $inPost['TBLNAME'] . '.bl.php'))
	{
		require_once '../appSscript/' . $inPost['TBLNAME']. 'bl.php';
	}
	else
	{
		// nothing
	}
	
	$tblQuery = dbBaseList($inPost);
	
	echo json_encode(array('posts' => $tblQuery));
	exit;		
}

ob_end_clean();


?>