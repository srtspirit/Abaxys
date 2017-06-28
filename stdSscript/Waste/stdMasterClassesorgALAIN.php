<?php



class dbMaster
{
	
	
	
	function dbMaster($tblName,$schema)
	{
		$this->help = "Master table function" ;
		$this->help .= " Table main access";
		$this->mess = "";
		$this->stdTable = false;
		$this->tblInfo = new dbTblInfo($tblName,$schema);
		$this->tblPrimary = new dbTblPrimary($tblName,$schema);
		$this->tblUnique = new dbTblUnique($tblName,$schema);
		$this->tblCtrts = new dbTblConstraints($tblName,$schema);
		$this->tblFlds = new dbTblFields($tblName,$schema);
		//$this->sqlSelect = $this->dbSetTrig();
	}
	
	function onInitNewRec($tbl,$pr)
	{
			
		$tblDocu  = "Function call on event. Set new record Init"; 
		return $tbl;
	}

	
	function dbChkMatch($objdta)
	{


		$E_POST = setEpost($this->tblInfo->schema,$objdta);
		
  		$occ = 0;
  		$compare = array();
  		$compVal = array();
		  		
   		$keyName = "";
  		while ($occ < count($this->tblFlds->dta))
  		{
  			
  			
  			
  			if ($E_POST[$this->tblFlds->dta[$occ]['name']] != "" )
  			{
  				
  				$compare[count($compare)] = $this->tblFlds->dta[$occ]['name'];
  				$compVal[count($compVal)] = $E_POST[$this->tblFlds->dta[$occ]['name']];
  				
  			}
  			$occ += 1;
  		}
   		
		
  		
  		
  		
		if (count($compare) > 0)
		{  				

			$trig = $this->dbSetTrig();
				
			$whereClause = "";	
			$occ = 0;
			while ($occ < count($compare))
			{

				if ($occ > 0)
				{
					$whereClause .= " AND";
				}
				$whereClause .= " " . $compare[$occ]." = :" .$compare[$occ];
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;

				$occ += 1;
			}
			
			
			$wcp = strpos($trig,"[=WHERE=]");
			$trig = substr($trig,0,$wcp) . $whereClause . substr($trig,$wcp+9);

			$wcp = strpos($trig,"[=LIMIT=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . substr($trig,$wcp+9);
				$limit = "";
			}
			
			$wcp = strpos($trig,"[=ORDBY=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . substr($trig,$wcp+9);
			}
			
			
			$holdTrig = $trig; // Re-use holdTrig for each tbsAccessCond

			if ($this->RAWBORROW == true)
			{

				$trig = tbsAccessCond($holdTrig,true,"onupdateUSR");
				$this->dbPdoPrep($trig,$vobj,$tobj);
				
				if ($this->rowCount > 0)
				{
					$this->RawUpd = $this->result[0];
					$this->dbRawUpd($this->result[0]);
				}
				$this->shareCount = $this->rowCount;
				$this->shareCountTrig = $trig;
			}		

			$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access

			$this->canCreate = strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"New");
			$this->canUpdate = strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"Upd");
			$this->canDelete = strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"Del");

	  		// tableName.condition
			$trig = tbsAccessCond($holdTrig,true,"onupdate,onupdateUSR");
			$this->dbPdoPrep($trig,$vobj,$tobj);
			$this->result = array();
			$this->updCountHelp = "Includes Dimension & user onupdate restrictions";
			$this->updCount =  $this->canUpdate?$this->rowCount:0;
			$this->updCountTrig = $trig;
			
			$trig = tbsAccessCond($holdTrig,true,"ondelete,ondeleteUSR");
			$this->dbPdoPrep($trig,$vobj,$tobj);
			$this->result = array();
			$this->delCountHelp = "Includes Dimension & user onupdate restrictions";
			$this->delCount =  $this->canDelete?$this->rowCount:0;
			$this->delCountTrig = $trig;


			$trig = tbsAccessCond($holdTrig,true,"onupdateUSR");
			$this->dbPdoPrep($trig,$vobj,$tobj);
			$this->result = array();
			$this->usrCountHelp = "Only user onupdate restrictions";
			$this->usrCount = $this->canUpdate?$this->rowCount:0;
			$this->usrCountTrig = $trig;
			
						
			$trig = tbsAccessCond($holdTrig,false,"");
			$this->dbPdoPrep($trig,$vobj,$tobj);
			$this->result = array();
			$this->rawCountHelp = "no restrictions";
			$this->rawCount = $this->rowCount;
			$this->rawCountTrig = $trig;
			
			
			if ($this->RAWBORROW == true)
			{
				$this->result = array();
				$this->result[0] = $this->RawUpd;

			}			
		}
		
	}	

	function dbRawUpd($ePost)
	{
		$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
		if ($ab_Dusa[$this->tblInfo->tblName]['dimvalue'])
		{
			$wtmp = $ab_Dusa[$this->tblInfo->tblName]['dimvalue'];
			$wCol = substr($wtmp,0,strpos($wtmp,":"));
			$wVal = substr($wtmp,strpos($wtmp,":")+1);
			$wOva = $ePost[$wCol];
			$this->orgDim = $wOva;
			$this->newDim = $wVal;
			$this->dimIsNew = strpos($wOva,$wVal);
			if (strpos(",".$wOva,$wVal)==false)
			{
				if (strlen($wOva))
				{
					$wOva .= ",";
				}
				$wOva .= $wVal;
				$ePost[$wCol] = $wOva;
				$this->dbUpdRec($ePost);
			}
			

			
		}
		
		
	}

	function dbFindMatch($objdta)
	{

		
		$E_POST = setEpost($this->tblInfo->schema,$objdta);
		
  		$occ = 0;
  		
  		$repeatPointer = -1; // = -1 no repeat field
  		
  		$compare = array();
  		$compVal = array();
		  		
   		$keyName = "";
  		while ($occ < count($this->tblFlds->dta))
  		{
  			
  			
  			
  			if ($E_POST[$this->tblFlds->dta[$occ]['name']] != "" )
  			{
  				
  				$compare[count($compare)] = $this->tblFlds->dta[$occ]['name'];
  				if (!is_array($E_POST[$this->tblFlds->dta[$occ]['name']]))
  				{
	  				$compVal[count($compVal)] = $E_POST[$this->tblFlds->dta[$occ]['name']];
	  			}
	  			else
  				{
  					// Set repeat field once only if -1
  					if ($repeatPointer == -1)
  					{
  						$repeatPointer = count($compVal);
  					}
	  				$compVal[count($compVal)] = $E_POST[$this->tblFlds->dta[$occ]['name']][0];
	  			}
	  			
  				
  			}
  			$occ += 1;
  		}
   		
		
  		
  		
  		
		if (count($compare) > 0)
		{  				

			$trig = $this->dbSetTrig();
				
			$whereClause = "";	
			$occ = 0;
			while ($occ < count($compare))
			{

				if ($occ > 0)
				{
					$whereClause .= " AND";
				}
				$whereClause .= " " . $compare[$occ]." = :" .$compare[$occ];
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;

				$occ += 1;
			}
			
			
			$wcp = strpos($trig,"[=WHERE=]");
			$trig = substr($trig,0,$wcp) . $whereClause . substr($trig,$wcp+9);

			$wcp = strpos($trig,"[=LIMIT=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . substr($trig,$wcp+9);
				$limit = "";
			}
			
			$wcp = strpos($trig,"[=ORDBY=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . substr($trig,$wcp+9);
			}

	  		// tableName.condition
			$trig = tbsAccessCond($trig,true,"onaccess,onaccessUSR");

			// $trig .= "; " . $trig;
			
			if (!$E_POST["RECSET"] || count($E_POST["RECSET"]) == 0)
			{
				$this->dbPdoPrep($trig,$vobj,$tobj);
			}
			else
			{
				$aTrig = $E_POST["RECSET"];
				array_unshift($aTrig,$trig);
				//$this->recSet = $aTrig;
				$this->dbPdoRecSet($aTrig,$vobj,$tobj);
			}

			if ($this->rowCount == 0)
			{
				$this->result[0] = $this->dbInitNewRec($objdta);
			}

			
			//$this->trig = $trig;
			$this->clause = $vobj;
			$this->process = "Match";
		}
		
	}	

	function dbInitNewRec($objdta)
	{
		// Under construction
		
		$E_POST = setEpost($this->tblInfo->schema,$objdta);
		$occ = 0;
  		while ($occ < count($this->tblFlds->dta))
  		{
  			
			$ret[$this->tblFlds->dta[$occ]['name']] = $E_POST[$this->tblFlds->dta[$occ]['name']];
	  		if ($ret[$this->tblFlds->dta[$occ]['name']] == "")
	  		{
	  			if ($this->tblFlds->dta[$occ]['default'] != "CURRENT_TIMESTAMP")
	  			{
	  				$ret[$this->tblFlds->dta[$occ]['name']] = $this->tblFlds->dta[$occ]['default'];
	  			}
	  		}
	  		
  			$occ += 1;
  		}
  		
  		$ret = $this->onInitNewRec($ret,"");		
  		return $ret;		
	}
	
	function dbFindLike($objdta)
	{

		$E_POST = setEpost($this->tblInfo->schema,$objdta);
  		$occ = 0;
  		$compare = array();
  		$compVal = array();
  		
  		while ($occ < count($this->tblFlds->dta))
  		{
  			if ($E_POST[$this->tblFlds->dta[$occ]['name']] != "" )
  			{
  				$compare[count($compare)] = $this->tblFlds->dta[$occ]['name'];
  				$compVal[count($compVal)] = $E_POST[$this->tblFlds->dta[$occ]['name']];
  			}
  			$occ += 1;
  		}


		if (count($compare) > 0)
		{  				

			$trig = $this->dbSetTrig();
				
			$whereClause = "";	
			$occ = 0;
			while ($occ < count($compare))
			{

				if ($occ > 0)
				{
					$whereClause .= " AND";
				}
				$whereClause .= " " . $compare[$occ]." LIKE :" .$compare[$occ];
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;

				$occ += 1;
			}

			$wcp = strpos($trig,"[=WHERE=]");
			$trig = substr($trig,0,$wcp) . $whereClause . substr($trig,$wcp+9);
			
		
			$orderDir = " ASC ";
			$limit = "";
			if ($objdta['MAXREC_OUT'])
			{
				$max = $objdta['MAXREC_OUT'];
				if ($max < 0)
				{
					$orderDir = " desc ";
					$max = $max *-1;
					
				}
				if ($max != 0)
				{
					$limit = " LIMIT :RLIMIT ";
					$vobj['RLIMIT']=intval($max);
					$tobj['RLIMIT']=PDO::PARAM_INT;
				}
					
			}

			$occ = 0;
			$ob = " ";
			while ($occ < count($this->tblUnique->dta))
			{
				if ($occ == 0)
				{
					$ob .= "ORDER BY ";
					$lastIndex = $this->tblUnique->dta[$occ]['keyName'];
				}
				
				if ($lastIndex == $this->tblUnique->dta[$occ]['keyName'])
				{
					if ($occ > 0)
					{
						$ob .= ", ";
					}
					$ob .= $this->tblUnique->dta[$occ]['fieldName'] . $orderDir;
					$orderDir = " ASC ";
				}
				else
				{
					$occ = count($this->tblUnique->dta);
				}
				
				$occ += 1;
			}
			
			$wcp = strpos($trig,"[=LIMIT=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . $limit . substr($trig,$wcp+9);
				$limit = "";
			}
			
			$wcp = strpos($trig,"[=ORDBY=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . $ob . substr($trig,$wcp+9);
			}
			
			$trig .= $ob . $limit;


	  		// tableName.condition
			$trig = tbsAccessCond($trig,true,"onaccess,onaccessUSR");
			
			$this->dbPdoPrep($trig,$vobj,$tobj);
			
			//$this->trig = $trig;
			$this->clause = $vobj;
			$this->process = "Like";
		}
		
	}
	
	function dbSetTrig()
	{
		$this->stdTable = true;
		
$trig = <<<EOD
			SELECT * FROM {$this->tblInfo->tblName} WHERE [=WHERE=] [=COND:{$this->tblInfo->tblName}=]  
EOD;
		return $trig;		
	}
	
	function dbFindFrom($objdta)
	{

		$E_POST = setEpost($this->tblInfo->schema,$objdta);
		$this->process = "From";
		$this->E_POST = $E_POST;
  		$occ = 0;
  		$compare = array();
  		$compVal = array();
  		
  		$keyName = "";
  		
		$trig = $this->dbSetTrig();
	
		while (strpos($trig,"[=COND:"))
		{
			$wcp = strpos($trig,"[=COND:");
			$wtb = substr($trig,$wcp+7);
			$wtb = substr($wtb,0,strpos($wtb,"=]"));
			
			$wTbl = new dbMaster($wtb,$this->tblInfo->schema); 

			$occ = 0;
			
	 		while ($occ < count($wTbl->tblFlds->dta))
	  		{
	  			// 
	  			if ($E_POST[$wTbl->tblFlds->dta[$occ]['name']] != "" )
	  			{
	  				$compare[count($compare)] = $wTbl->tblFlds->dta[$occ]['name'];
	  				$compVal[count($compVal)] = $E_POST[$wTbl->tblFlds->dta[$occ]['name']];
	  				$this->cond[$wTbl->tblFlds->dta[$occ]['name']] = $E_POST[$wTbl->tblFlds->dta[$occ]['name']];
	  			}
	  			
	  			$occ += 1;
	  		}
	  		
	  		$trig = substr($trig,0,$wcp) .  substr($trig,$wcp+9+strlen($wtb));	
		}	
		
		$trig = $this->dbSetTrig();
	
		
		foreach($E_POST as $name => $value)
		{
			if (strpos($trig,":".$name))
			{			
				$compare[count($compare)] = $name;
				$compVal[count($compVal)] = $value;
			}
		}
		//$this->trig = $trig;

		if (count($compare) > 0)
		{  				

			$trig = $this->dbSetTrig();
			
			
			$orderDir = " ASC ";
			$limit = "";
			
			$compareSign = ">";
			
			
			if ($objdta['MAXREC_OUT'])
			{
				$max = $objdta['MAXREC_OUT'];
				if ($max < 0)
				{
					$compareSign = "<";
					$orderDir = " desc ";
					$max = $max *-1;
					
				}
				if ($max != 0)
				{
					$limit = " LIMIT :RLIMIT ";
					$vobj['RLIMIT']=intval($max);
					$tobj['RLIMIT']=PDO::PARAM_INT;
				}
					
			}
			
			
				
			$whereClause = "(";	
			$occ = 0;
			while ($occ < count($compare))
			{
				// First one
				if ($occ == 0)
				{
					$whereClause .= " ( " . $compare[$occ] . " " . $compareSign . " :" . $compare[$occ];
					if ($objdta['GETMATCH'] == "1" || count($compare) > 1 )
					{
						$whereClause .= " ) OR ( " . $compare[$occ]. " " . $compareSign ."= :" .$compare[$occ];
					}
				}
				else
				{
					if ($objdta['GETMATCH'] == "1" || count($compare) > $occ + 1 )
					{
						$whereClause .= " AND " . $compare[$occ]. " " . $compareSign . "= :" .$compare[$occ];
					}
					else
					{
						$whereClause .= " AND " . $compare[$occ]. " " . $compareSign . " :" .$compare[$occ];
					}
				}
										
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;
				$occ += 1;
			}
			$whereClause .=   " ) )";
			
			$mb = explode(",",$E_POST['REQUIRED']);
			$occ = 0;
			while ($occ < count($mb))
			{
				if ($mb[$occ])
				{		
					$whereClause .= " AND " . $mb[$occ] . " = " . "'" . $E_POST[$mb[$occ]] . "' " ; 
				}
				$occ += 1;
			}

			
			
			$wcp = strpos($trig,"[=WHERE=]");
			$trig = substr($trig,0,$wcp) . $whereClause . substr($trig,$wcp+9);
			

			$occ = 0;
			$ob = " ";
			$mainOb = "";
			
			if ($E_POST['SORTED'])
			{
				$ob .= "ORDER BY " . $E_POST['SORTED']  . $orderDir;
				$orderDir = " ASC ";
				$mainOb .= "ORDER BY " . $E_POST['SORTED']  . $orderDir;
			}
				
			
			while ($occ < count($this->tblUnique->dta) && !$E_POST['SORTED'])
			{

				if ($occ == 0)
				{
					$ob .= "ORDER BY ";
					$mainOb .= "ORDER BY ";
					
					$lastIndex = $this->tblUnique->dta[$occ]['keyName'];
				}
				
				if ($lastIndex == $this->tblUnique->dta[$occ]['keyName'])
				{
					if ($occ > 0)
					{
						$ob .= ", ";
						$mainOb .= ", ";
					}
					$ob .= $this->tblUnique->dta[$occ]['fieldName'] . $orderDir;
					$orderDir = " ASC ";
					$mainOb .= $this->tblUnique->dta[$occ]['fieldName'] . $orderDir;
				}
				else
				{
					$occ = count($this->tblUnique->dta);
				}
				
				$occ += 1;
			}
			
			$wcp = strpos($trig,"[=LIMIT=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . $limit . substr($trig,$wcp+9);
				$limit = "";
			}
			
			$this->ob = $ob;
			$this->mainOb = $mainOb;
			
			$wcp = strpos($trig,"[=ORDBY=]");
			if ($wcp != false)
			{
				$trig = substr($trig,0,$wcp) . $ob . substr($trig,$wcp+9);
				$ob = $mainOb;
			}
			
			$trig .= $ob . $limit;
			
			if ($this->stdTable == true)
			{
				$trig = " SELECT * FROM ( " . $trig . ") xx " . $mainOb;
			}
			
	  		// tableName.condition
			$trig = tbsAccessCond($trig,true,"onaccess,onaccessUSR");

			
			//$this->trig = $trig;
			$this->clause = $vobj;
			
			$this->dbPdoPrep($trig,$vobj,$tobj);
		}
		
	}
	
	function dbPdoPrep($trig,$dta,$dtaType)
	{
		$servername = "localhost";
		$username = $_SESSION['dbUser'];
		$password = $_SESSION['dbUserPwd'];
		
		
		$dbname = $this->tblInfo->schema;
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 				
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, $options);
		
		$stmt = $conn->prepare($trig);
		foreach($dta as $name => $value)
		{
			$keyName = $name;
			$keyVal = $value;
			$keyType = $dtaType[$name];
			$stmt->bindValue(":" . $keyName,$keyVal,$keyType);
			
		}		
		$stmt->execute();
		
		$wDate = getdate();
		$this->pdoTimeStmp = $wDate["year"] . "-" . $wDate["mon"] . "-" .$wDate["mday"] . "  " . $wDate["hours"] . ":" . $wDate["minutes"] . ":" . $wDate["seconds"];
		
		$this->pdoErrorCode = $stmt->errorCode();
		
		$this->errorInfo = $stmt->errorInfo();
		$this->errCount = count($this->errorInfo);
		if ($this->errCount > 1)
		{
			$this->errorCode = $this->errorInfo[1];
		}
		else
		{
			$this->errorCode = 0;
		}
		
		$this->rowCount = $stmt->rowCount();
		
		
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$this->fetchResult = $result;

		$occ = 0;
		while (count($result) > $occ)
		{
			$result[$occ] =  seturlDecode($result[$occ]);	
	
			$occ += 1;
		}
		
		$this->result = $result;

		//$this->trig = $trig;
		$this->lastId = $conn->lastInsertId();
		

		$conn = null;
		
	}
	
	function dbPdoRecSet($trig,$dta,$dtaType)
	{
		
		$this->recSetCount = 0;
		$recSetResult = array();
		
		$occ = 1;		
		while ($occ < count($trig))
		{
			$dta = $trig[$occ];
			
			$this->dbPdoPrep($trig[0],$dta,$dtaType);
			$this->recSetCount += $this->rowCount;
			
			$wocc = 0;
			while ($wocc < count($this->result) )
			{
				$recSetResult[count($recSetResult)] = $this->result[$wocc];
				$wocc += 1;
			}
			
			$occ += 1;
		}
		
		$this->recSetResult = $recSetResult;


		
	}

	function dbGenPrep($wTbls,$dtaObj)
	{
		
		$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
		if (strpos(",".$ab_Dusa[$wTbls->tblInfo->tblName]['allow'],"New") == true)
		{
			$tri = $dtaObj["trig"];
			$vob = $dtaObj["vobj"];
			$tob = $dtaObj["tobj"];
			
			$wTbls->dbPdoPrep($tri,$vob,$tob);

			if ($wTbls->lastId > 0)
			{
				
				$wTbls->inserted = $wTbls->tblPrimary->dta[0]["colName"];
				$rid = array();
				$rid[$wTbls->tblPrimary->dta[0]["colName"]] = $wTbls->lastId;
				$wTbls->dbChkMatch($rid);
				$wTbls->dbFindMatch($rid);
			}
			
		}
		else
		{
			$wTbls->allowErr = 901;
			$wTbls->allowMess = "No permission to Create";
			$wTbls->allow = $ab_Dusa[$wTbls->tblInfo->tblName]['allow'];
		}
			

		
		$wTbls->clause = $vobj;					
		

		if ($wTbls->errorCode != 0)
		{
			$wTbls->dbValidConstraints($dtaObj);
			$wTbls->success = false;
		}
		else
		{
			 $wTbls->dbFindMatch($dtaObj);
			 $wTbls->success = true;
		}		
		
		return $wTbls;
	}
	
	
	function dbInsertSet($wTbls,$schema,$dtaObj)
	{
		
		$E_POST = setEpost($schema,$dtaObj);
		
		$insertSet = array();
		
		$tblOcc = 0;
		while ($tblOcc < count($wTbls))
		{
			
	  		$occ = 0;
	  		
	  		$compare = array();
	  		$compVal = array();

			$vobj = array();
			$tobj = array();
	
			$trig = " INSERT INTO ". $wTbls[$tblOcc]->tblInfo->tblName . " ";
	
			$wFields = array();
			$wClause = array();
			while ($occ < count($wTbls[$tblOcc]->tblFlds->dta))
			{
				if ($dtaObj[$wTbls[$tblOcc]->tblFlds->dta[$occ]['name']] != "" )
				{
					$wFields[count($wFields)] = $wTbls[$tblOcc]->tblFlds->dta[$occ]['name'];
					$wClause[count($wClause)] = " :" . $wTbls[$tblOcc]->tblFlds->dta[$occ]['name'] . " ";
	  				$compare[count($compare)] = $wTbls[$tblOcc]->tblFlds->dta[$occ]['name'];
					$compVal[count($compVal)] = $E_POST[$wTbls[$tblOcc]->tblFlds->dta[$occ]['name']];
					
				}
				$occ += 1;
			}
			
			if (count($wClause) == 0)
			{
				// $xxthis->errno = 1;
				// $xxthis->mess = "No data to insert in " . $wTbls[$tblOcc]->tblInfo->tblName ;
			}
			else
			{
				$wtmp = "";
				
				$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
				if ($ab_Dusa[$wTbls[$tblOcc]->tblInfo->tblName]['dimvalue'])
				{
					$wtmp = $ab_Dusa[$wTbls[$tblOcc]->tblInfo->tblName]['dimvalue'];
					$wFields[count($wFields)] = substr($wtmp,0,strpos($wtmp,":"));	
					$wClause[count($wClause)] = " :" . substr($wtmp,0,strpos($wtmp,":")). " ";
					$compare[count($compare)] = substr($wtmp,0,strpos($wtmp,":"));	
					$compVal[count($compVal)] = substr($wtmp,strpos($wtmp,":")+1);	
				}
	
							
				$trig .= "(" . implode(",",$wFields) . ") VALUES (".implode(",",$wClause).")";
				// echo $trig . "\nWTMP= " . $wtmp;
				//$this->trigger = $trig;
				
				$occ = 0;
				while ($occ < count($compare))
				{
					$vobj[$compare[$occ]]= $compVal[$occ];
					$tobj[$compare[$occ]]=PDO::PARAM_STR;
					$occ += 1;
				}
			}
			
			$insertSet[$tblOcc]["trig"] = $trig;
			$insertSet[$tblOcc]["vobj"] = $vobj;
			$insertSet[$tblOcc]["tobj"] = $tobj;	
			
			$tblOcc += 1;
		}		
		
		return $insertSet;		
		
		
	}

	function dbValidConstraints($dtaObj)
	{
		$wcon = $this->tblCtrts;
		$occ = 0;
		
		
		$this->invalidConstraints = array();
				
		while ($occ < count($wcon->dta))
		{
			
			
			$trig = "SELECT * FROM " . $wcon->dta[$occ]['refTbl'] . " WHERE ";

			$wClause = array();
			$wocc = 0;
			$wField = "";
			
			foreach($wcon->dta[$occ]['refFields'] as $name => $value)
			{
		    		$wClause[count($wClause)] = $value . " = '" . $dtaObj[$name] ."' " ;
		    		// Get first field of where clause
		    		if ($wField == "")
		    		{
					$wField = $name;
				};
			}
			
			$trig .= implode(" AND ",$wClause);
			
			$valRet = new valQuery($this->tblInfo->schema,$trig);
			if ($valRet->success == false)
			{
				$this->invalidConstraints[count($this->invalidConstraints)]->field = $wField;
				$this->invalidConstraints[count($this->invalidConstraints)-1]->mess = $valRet->ret;
				$this->invalidConstraints[count($this->invalidConstraints)-1]->table = $wcon->dta[$occ]['refTbl'];
				$this->invalidConstraints[count($this->invalidConstraints)-1]->constraint = $wcon->dta[$occ]['name'];
			}
			
			$occ += 1;
		}
		
		
		
	}
	
	function dbDelRec($dtaObj)
	{
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";


		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
  		$occ = 0;
  		$compare = array();
  		$compVal = array();
  		
		$trig = " DELETE  FROM ". $this->tblInfo->tblName . " WHERE ";
		$occ = 0;
		$wClause = array();
		while ($occ < count($this->tblPrimary->dta))
		{
			if (!$E_POST[$this->tblPrimary->dta[$occ]['colName']] || $E_POST[$this->tblPrimary->dta[$occ]['colName']] == "" )
			{
				$wClause = array();
				$occ = count($this->tblPrimary->dta);
			}
			else
			{
				$wClause[count($wClause)] = $this->tblPrimary->dta[$occ]['colName'] . " = :" . $this->tblPrimary->dta[$occ]['colName'] . " ";
				$compare[count($compare)] = $this->tblPrimary->dta[$occ]['colName'];
				$compVal[count($compVal)] = $E_POST[$this->tblPrimary->dta[$occ]['colName']];

			}
			$occ += 1;
		}
		
		if (count($wClause) == 0)
		{
			$this->errno = 1;
			$this->mess = "You must supply the Primary key to delete a record";
		}
		else
		{
			$trig .= implode(" AND ",$wClause);
			$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
			if ($ab_Dusa[$this->tblInfo->tblName]['ondelete'])
			{
				 $trig .= " AND " . $ab_Dusa[$this->tblInfo->tblName]['ondelete'] . " ";
			
			}
			
			$occ = 0;
			while ($occ < count($compare))
			{
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;
				$occ += 1;
			}
						
			
			if (strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"Del") == true)
			{
				$this->dbPdoPrep($trig,$vobj,$tobj);
				if ($this->errorCode == 0 && $this->rowCount >0)
				{

					$rid = array();
					$rid[$this->tblPrimary->dta[0]["colName"]] = null;
					$this->result = array();
					$this->result[0] = $rid;
				}
					
			}
			else
			{
				$this->allowErr = 903;
				$this->allowMess = "No permission to Delete ";
				$this->allow = $ab_Dusa[$this->tblInfo->tblName]['allow'];
			}

			$holdCode =$this->errorCode;
			$holdInfo =$this->errorInfo;
			$holdRow = $this->rowCount;

			$rid = array();
			$rid[$this->tblPrimary->dta[0]["colName"]] = $E_POST[$this->tblPrimary->dta[0]["colName"]];
			$this->dbChkMatch($rid);
			$this->errorCode = $holdCode;
			$this->errorInfo = $holdInfo;
			$this->rowCount = $holdRow;

			$this->clause = $vobj;		


		}
			
		
		
			
	}

	function dbUpdRec($dtaObj)
	{
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";

		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
  		$occ = 0;
  		$compare = array();
  		$compVal = array();


		$trig = "UPDATE ". $this->tblInfo->tblName . " ";

		$occ = 0;
		$wClause = array();
		while ($occ < count($this->tblPrimary->dta))
		{
			if (!$E_POST[$this->tblPrimary->dta[$occ]['colName']] || $E_POST[$this->tblPrimary->dta[$occ]['colName']] == "" )
			{
				$wClause = array();
				$occ = count($this->tblPrimary->dta);
			}
			else
			{
				$wClause[count($wClause)] = $this->tblPrimary->dta[$occ]['colName'] . " = :" . $this->tblPrimary->dta[$occ]['colName'] . " ";
  				$compare[count($compare)] = $this->tblPrimary->dta[$occ]['colName'];
				$compVal[count($compVal)] = $E_POST[$this->tblPrimary->dta[$occ]['colName']];

			}
			$occ += 1;
		}

		if (count($wClause) == 0)
		{
			$this->errno = 1;
			$this->mess = "You must supply the Primary key to update a record";
		}
		else
		{	

			$occ = 0;
			$wFields = array();
			while ($occ < count($this->tblFlds->dta))
			{
				// Warning AC 20150516 Field not part of update
				if ($E_POST[$this->tblFlds->dta[$occ]['name']] != "" )
				{
					$wFields[count($wFields)] = $this->tblFlds->dta[$occ]['name'] . " = :" . $this->tblFlds->dta[$occ]['name'] . " ";
	  				$compare[count($compare)] = $this->tblFlds->dta[$occ]['name'];
					$compVal[count($compVal)] = $E_POST[$this->tblFlds->dta[$occ]['name']];
				}

				$occ += 1;
			}
			
			if (count($wFields) == 0)
			{
				$this->errno = 1;
				$this->mess = "No data to update ";
			}
			else
			{
				$trig .= " SET " . implode(",",$wFields) . " WHERE ".implode(" AND ",$wClause);

				$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
				if ($ab_Dusa[$this->tblInfo->tblName]['onupdate'] && $this->RAWBORROW != true)
				{
					 $trig .= " AND " . $ab_Dusa[$this->tblInfo->tblName]['onupdate'] . " ";
				}
				if ($ab_Dusa[$this->tblInfo->tblName]['onupdateUSR']  && $this->RAWBORROW != true)
				{
					 $trig .= " AND " . $ab_Dusa[$this->tblInfo->tblName]['onupdateUSR'] . " ";
				}

				

				$occ = 0;
				while ($occ < count($compare))
				{
					$vobj[$compare[$occ]]= $compVal[$occ];
					$tobj[$compare[$occ]]=PDO::PARAM_STR;
					$occ += 1;
				}
				
				$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
				if (strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"Upd") == true)
				{
					$this->dbPdoPrep($trig,$vobj,$tobj);
					$holdCode =$this->errorCode;
					$holdInfo =$this->errorInfo;
					$holdRow = $this->rowCount;

					$rid = array();
					$rid[$this->tblPrimary->dta[0]["colName"]] = $E_POST[$this->tblPrimary->dta[0]["colName"]];
					$this->dbChkMatch($rid);
					$this->errorCode = $holdCode;
					$this->errorInfo = $holdInfo;
					$this->rowCount = $holdRow;
					
				}
				else
				{
					$this->allowErr = 902;
					$this->allowMess = "No permission to Update ";
					$this->allow = $ab_Dusa[$this->tblInfo->tblName]['allow'];
				}				
				$this->clause = $vobj;
									

				if ($this->errorCode != 0)
				{
					$this->dbValidConstraints($dtaObj);
				}
				//$this->trig = $trig;		
				$this->success = true;
				

			}
			
		};
		
		
			
	}

	function dbInsRec($dtaObj)
	{
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";

		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
  		$occ = 0;
  		
  		$compare = array();
  		$compVal = array();

		$trig = " INSERT INTO ". $this->tblInfo->tblName . " ";

		$wFields = array();
		$wClause = array();
		while ($occ < count($this->tblFlds->dta))
		{
			if ($dtaObj[$this->tblFlds->dta[$occ]['name']] != "" )
			{
				$wFields[count($wFields)] = $this->tblFlds->dta[$occ]['name'];
				$wClause[count($wClause)] = " :" . $this->tblFlds->dta[$occ]['name'] . " ";
  				$compare[count($compare)] = $this->tblFlds->dta[$occ]['name'];
				$compVal[count($compVal)] = $E_POST[$this->tblFlds->dta[$occ]['name']];
				
			}
			$occ += 1;
		}
		
		if (count($wClause) == 0)
		{
			$this->errno = 1;
			$this->mess = "No data to insert ";
		}
		else
		{
			$wtmp = "";
			
			$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
			if ($ab_Dusa[$this->tblInfo->tblName]['dimvalue'])
			{
				$wtmp = $ab_Dusa[$this->tblInfo->tblName]['dimvalue'];
				$wFields[count($wFields)] = substr($wtmp,0,strpos($wtmp,":"));	
				$wClause[count($wClause)] = " :" . substr($wtmp,0,strpos($wtmp,":")). " ";
				$compare[count($compare)] = substr($wtmp,0,strpos($wtmp,":"));	
				$compVal[count($compVal)] = substr($wtmp,strpos($wtmp,":")+1);	

				
			}

						
			$trig .= "(" . implode(",",$wFields) . ") VALUES (".implode(",",$wClause).")";
			// echo $trig . "\nWTMP= " . $wtmp;
			//$this->trigger = $trig;
			
			$occ = 0;
			while ($occ < count($compare))
			{
				$vobj[$compare[$occ]]= $compVal[$occ];
				$tobj[$compare[$occ]]=PDO::PARAM_STR;
				$occ += 1;
			}
			

			$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
			if (strpos(",".$ab_Dusa[$this->tblInfo->tblName]['allow'],"New") == true)
			{
				$this->dbPdoPrep($trig,$vobj,$tobj);
				if ($this->lastId > 0)
				{
					$this->inserted = $this->tblPrimary->dta[0]["colName"];
					$rid = array();
					$rid[$this->tblPrimary->dta[0]["colName"]] = $this->lastId;
					$this->dbChkMatch($rid);
					$this->dbFindMatch($rid);
				}
				
			}
			else
			{
				$this->allowErr = 901;
				$this->allowMess = "No permission to Create";
				$this->allow = $ab_Dusa[$this->tblInfo->tblName]['allow'];
			}
				


			$this->clause = $vobj;					
			

			if ($this->errorCode != 0)
			{
				$this->dbValidConstraints($dtaObj);
				$this->success = false;
			}
			else
			{
				 $this->dbFindMatch($dtaObj);
				 $this->success = true;
			}
		
			

		}
			
		
		// return $ret;
			
	}

}


class dbTblInfo
{
	public $tblName;
	public $tblComment;

	function dbTblInfo($tname,$schema)
	{

		$this->help = "Table General Information";
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";


	
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{
			$trig ="
			 SELECT *  FROM INFORMATION_SCHEMA.TABLES  
			  WHERE TABLE_SCHEMA='" . $schema . "' AND TABLE_NAME='" .$tname."'
			 ";
		  
			$result = mysqli_query($g->con,$trig);

			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;		
			
			if($row = mysqli_fetch_array($result)) 
			{
				$this->success = true;
				$this->schema = $row['TABLE_SCHEMA'];
				$this->tblName = $row['TABLE_NAME'];
				$this->tblComment = $row['TABLE_COMMENT'];
			
			}
			
			
			closeConnection($g->con);
		};		
	
	}
}



class dbTblPrimary
{

	function dbTblPrimary($tname,$schema)
	{

		$this->help = "Table Primary Key Fields";
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";
		
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{
			$trig ="SHOW INDEX FROM " . $tname . " FROM " . $schema . " WHERE Key_Name='PRIMARY' ";
			
			$result = mysqli_query($g->con,$trig);
			
			
			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;
			$this->dta = array();
			while($this->errno == 0 && $row = mysqli_fetch_array($result)) 
			{
				$this->success = true;
				$this->dta[count($this->dta)]['colName'] = $row['Column_name'];
			}
			
			closeConnection($g->con);
		};
		
			
	}
	
}


class dbTblUnique
{

	function dbTblUnique($tname,$schema)
	{

		$this->help = "Table Unique Key Fields ";
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";
		
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{
			$trig ="SHOW INDEX FROM " . $tname . " FROM " . $schema . " WHERE Key_Name !='PRIMARY' AND Non_unique = 0";
			
			$result = mysqli_query($g->con,$trig);
			
			
			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;
			
			
			while($this->errno == 0 && $row = mysqli_fetch_array($result)) 
			{
				$this->success = true;
				$tmp['keyName'] = $row['Key_name'];
				$tmp['seq'] = $row['Seq_in_index'];
				$tmp['fieldName'] = $row['Column_name'];
				
				$this->dta[count($this->dta)] = $tmp;
				
			}
			
			closeConnection($g->con);
		};
		
			
	}
	
}






class dbTblConstraints 
{
	
	function dbTblConstraints($tname,$schema)
	{
		
		$this->help = "Table Constraints";
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";
		
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{
		
			$trig ="
			 SELECT * 
			     FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
			      WHERE REFERENCED_TABLE_SCHEMA = '" . $schema . "' AND TABLE_NAME = '".$tname."' 
			      ORDER BY TABLE_NAME,CONSTRAINT_NAME,ORDINAL_POSITION	
				";
			
			$result = mysqli_query($g->con,$trig);
			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;
			$this->dta = array();	
			
			$occ = 0;	
			$consName = "";	
			while($row = mysqli_fetch_array($result)) 
			{
				$this->success = true;
		
				$outName = "";
				if ($consName != $row['CONSTRAINT_NAME'])
				{
					if ($consName != "")
					{
						$this->dta[$occ-1]['refFields'] = $fld;
					}
					$fld = array();
					$consName = $row['CONSTRAINT_NAME'];
					$this->dta[$occ]['name']= $row['CONSTRAINT_NAME'];
					$this->dta[$occ]['refTbl'] =  $row['REFERENCED_TABLE_NAME'];	
					$occ += 1;
					
				}
				
				$fld[$row['COLUMN_NAME']] = $row['REFERENCED_COLUMN_NAME'];
				
				
				
			};

			if ($consName != "")
			{
				$this->dta[$occ-1]['refFields'] = $fld;
			}
		
			closeConnection($g->con);
		
		};
		
	}

}

class dbTblFields
{

	function dbTblFields($tname,$schema)
	{

		$this->help = "Table Fields Information";
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";
		
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{	
			$trig ="
			 SELECT *  FROM INFORMATION_SCHEMA.COLUMNS  
			  WHERE TABLE_SCHEMA='". $schema ."' AND TABLE_NAME='" .$tname."'
			  
			  ORDER BY TABLE_NAME, ORDINAL_POSITION";
		  
			$result = mysqli_query($g->con,$trig);
			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;
			 
			
			$occ = 0;
			while($row = mysqli_fetch_array($result)) 
			{
		

				$cons = array();
				$cons['name'] 		= $row['COLUMN_NAME'];
				$cons['type'] 		= $row['COLUMN_TYPE'];
				$cons['default'] 	= $row['COLUMN_DEFAULT'];
				$cons['auto'] 		= $row['EXTRA'];
				$cons['comment']	= $row['COLUMN_COMMENT'];
				
				$this->dta[$occ] = $cons;
				
				$occ += 1;
			}
	
			
		
		
				
				

		
			closeConnection($g->con);
		};
	
	}

}



function dspTblInfo($tblQ)
{
//[=DOC=]Sets Table schema Post information 

	$tblParam['tblName'] = $tblQ->tblInfo->tblName;
	$tblParam['tblDesc'] = $tblQ->tblInfo->tblComment;
	$tblParam['tblFields'] = $tblQ->tblFlds;
	$tblParam['tblPrimary'] = $tblQ->tblPrimary;
	$tblParam['tblUnique'] = $tblQ->tblUnique;
	$tblParam['tblConstraints'] = $tblQ->tblCtrts;
	
	return $tblParam;
}

		




function tbsAccessCond($trig,$condOn,$cond)
{
// $con should be "onaccess" or "onupdate" for checks
	$ab_Dusa = $_SESSION["AB_DUSA"]; // Dimension and user Security and access
	
	$condList = explode(",",$cond);
	
	while (strpos($trig,"[=COND:"))
	{
		$wcp = strpos($trig,"[=COND:");
		$wtb = substr($trig,$wcp+7);
		$wtb = substr($wtb,0,strpos($wtb,"=]"));
		
		$wCond = "";
		$occ = 0;
		while ($occ < count($condList) && $condOn)
		{	
			if ($ab_Dusa[$wtb][$condList[$occ]])
			{
				$wCond .= " AND " . $ab_Dusa[$wtb][$condList[$occ]] . " ";
			}
		
			$occ += 1;
		}
	
		$trig = substr($trig,0,$wcp) . $wCond . substr($trig,$wcp+9+strlen($wtb));

	}	

	return $trig;

}



function setEpost($schema,$post)
{
	$g = openConnection($schema);

	
	foreach($post as $name => $value)
	{
		if (!is_array($value))
		{
			 $ret[$name] = mysqli_real_escape_string($g->con,$value);
		}
		else
		{
			$occ = 0;
			while ($occ < count($value))
			{
				$ret[$name][$occ] = $value[$occ]; 
				$occ += 1;
			}
		}
			
	}
	
	closeConnection($g->con);
	
	return $ret;

}

function seturlDecode($obj)
{
	foreach($obj as $name => $value)
	{
		 $ret[$name] = urldecode($value);
	}

	return $ret;
}



class valQuery 
{
	public $query;
	public $ferr; 
	public $errno;
	public $error;
	public $ret;
	
	
	
	function valQuery($schema,$trig)
	{
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";
		
		$g = openConnection($schema);
		if ($g->con == false)
		{
			$this->errno = $g->errno;
			$this->mess = $g->mess;
		}
		else
		{			
			$result = mysqli_query($g->con,$trig);
			$this->errno = mysqli_errno($g->con);
			$this->mess = mysqli_error($g->con);
			//$this->trig = $trig;

			$ret = "";
			$ferr = 0;
			$this->ferr = 0;
			
			if (mysqli_errno($g->con) != 0)
			{
				$ret = "CHKALL:1 - Err:". mysqli_errno($g->con) . " - " .  mysqli_error($g->con); 			
		
			}
			else
			{
				if ($row = mysqli_fetch_array($result))
				{
					$this->success = true;
					$ret = "";
				}
				else
				{
					$ret =  "Err:Not found";
					$ferr = 1;
				}
			}
		
			$this->ferr = $ferr;
			$this->ret = $ret;
			
			closeConnection($g->con);	
		};
	}

}
function openConnection($schema)
{
	$ret->errno = 0;
	$ret->success = false;
	$ret->mess = "";
	
	$username = $_SESSION['dbUser'];
	$password = $_SESSION['dbUserPwd'];
	
	
	$ret->con=mysqli_connect("",$username,$password,$schema);
	if (mysqli_connect_errno()) 
	{
		$ret->errno = mysqli_connect_errno();
		$ret->mess = mysqli_connect_error();
	}
	else
	{
		$ret->success = true;
	};
	
	return $ret;	
}

function closeConnection($con)
{
	mysqli_close($con);
}




?>
