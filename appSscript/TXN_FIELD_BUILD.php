<?php

class txn_dimtbl extends dbMaster
{
	function txn_dimtbl($schema)
	{
		$this->dbMaster("txn_dimtbl",$schema);
	}


	
	function dbSetTrig()
	{


$rtrig = <<<EOD

	SELECT * FROM

	( SELECT * FROM txn_dimtbl WHERE [=WHERE=] [=COND:txn_dimtbl=] [=ORDBY=] [=LIMIT=] ) t1

		LEFT JOIN txn_fbmaster t2 ON t2.TXN_FBMASTER_TXNID = idTXN_DIMTBL [=COND:txn_fbmaster=] 
		LEFT JOIN txn_fbbuild t3 ON t3.TXN_FBBUILD_BOMID = t2.idTXN_FBMASTER [=COND:txn_fbbuild=]
		LEFT JOIN txn_fbfield t4 ON t4.TXN_FBFIELD_BOMID = t3.TXN_FBBUILD_BOMID AND t4.idTXN_FBFIELD = t3.TXN_FBBUILD_FIELDID [=COND:txn_fbfield=]

		

EOD;

$trig = <<<EOD

	SELECT * FROM

	( SELECT * FROM txn_dimtbl WHERE [=WHERE=] [=COND:txn_dimtbl=] [=ORDBY=] [=LIMIT=] ) t1

		LEFT JOIN txn_fbmaster t2 ON t2.TXN_FBMASTER_TXNID = idTXN_DIMTBL [=COND:txn_fbmaster=] 
		LEFT JOIN txn_fbbuild t3 ON t3.TXN_FBBUILD_BOMID = t2.idTXN_FBMASTER  AND t3.TXN_FBBUILD_ROWDTA > '' [=COND:txn_fbbuild=]
		LEFT JOIN txn_fbfield t4 ON t4.TXN_FBFIELD_BOMID = t2.idTXN_FBMASTER [=COND:txn_fbfield=]

		

EOD;


//	$trig = <<<EOD
//				SELECT * FROM
//				 
//			 	( SELECT * FROM txn_fbmaster WHERE [=WHERE=] [=COND:txn_fbmaster=][=ORDBY=] [=LIMIT=] ) t1
//	
//				LEFT JOIN txn_fbfield t2 ON t2.TXN_FBFIELD_BOMID = idTXN_FBMASTER [=COND:txn_fbfield=]
//				 
//				LEFT JOIN txn_fbbuild t3 ON t3.TXN_FBBUILD_BOMID = idTXN_FBMASTER [=COND:txn_fbbuild=]
//				
//			
//	EOD;	

		return $trig;
		
	}
	
	
	
	function execQuery($conn,$query,$rocc)
	{
		
		if (!$this->sqlQueErr)
		{
			$this->sqlQueErr = array();
		}
		
		
		$rocc += 1;
		if (mysqli_query($conn, $query)) 
		{
    			$rocc = mysqli_insert_id($conn);
    			$this->sqlQueErr[count($this->sqlQueErr)] = $rocc;
		} 
		else 
		{
			$this->sqlQueErr[count($this->sqlQueErr)] = $rocc . "--" . mysqli_error($conn);
			$rocc = $rocc * -1;
			
		}		
		
		return $rocc;
		
	}	

	function getIndex($quObj,$fName,$sVal,$row)
	{
		$found = 0;
		$rResult = "";
		$rvs = "";
		foreach ($quObj as $name => $value)
		{
			
			if (strpos(" ".$name,$fName) > 0)
			{

				$ckVal = $value[$fName];

// $rsv .= "[" . $name . "=" . $ckVal . "]";

				if(strpos(":" . $ckVal . ":" , ":" . $sVal . ":") > 0)
				{
					$found += 1;
				}

				if ($rResult == "" )
				{
					if ( ($row == 0 && $found > 0) || ($row > 0 && $found == $row) )
					{
						if ($ckVal != "")
						{
							$rResult = substr($ckVal,0,strpos($ckVal,":"));
						}
					}
				}
				
			}	
						
		}

// $rResult .=  "]]]" . $rsv ;
		return $rResult;
	}

	function getFieldId($oVal,$sQ,$fGrp)
	{
		$nan = acos($oVal);
		if (is_nan($nan) == "")
		{
			// $oVal = "*";
			foreach ($sQ as $name => $value)
			{
				
				if (!$sQ[$name][$fGrp])
				{
				}
				else
				{
					if (strpos($sQ[$name][$fGrp],":".$oVal.":") != false)
					{
						$oVal = substr($sQ[$name][$fGrp],0,strpos($sQ[$name][$fGrp],":"));
					}
				}
					
			}
			
			
		}

		return $oVal;
	}
	
	function dbUpdRec($dtaObj)
	{
		$this->dbFnct = 'dbUpdRec';
		$this->errno = 0;
		$this->success = false;
		$this->mess = "";
		
		$this->hasErrors = 0;
		
		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		
		

		$tmpQuery = array();
		
		foreach($E_POST as $name => $value)
		{
			if ($name != "" && strrpos($name,"_") && strrpos($name,"_row") + 4 == strlen($name))
			{
				
				$tName = substr($name,0,strrpos($name,"_row"));
				$rSeq = substr($tName,strrpos($tName,"_")+1);
				$tName = substr($tName,0,strrpos($tName,"_"));

				if (substr($tName,0,2) == "id")
				{
					$tmpQuery[$rSeq]["id"] = substr($tName,2);
				}
				
				$tmpQuery[$rSeq][$tName] = $value;
				
			}

		}



		$this->tmpQ = $tmpQuery;

	
		$g = openConnection($this->tblInfo->schema);
		if ($g->con == false)
		{
			$this->sqlConnectErr = $this->tblInfo->schema;
		}
		
		// Set autocommit to off
		$this->hasError = 0;
		mysqli_autocommit($g->con,FALSE);

$this->depdebug = "";		

		$copyToNew = "";
		
		$sqlQuery = array();
		$inpStream = array();
		$refLinks = array();
		$newTxnId = "";
		
		$retId = 0;
		$retCount = 0;
		foreach($tmpQuery as $name => $value)
		{
			switch ($value["id"])
			{
				case "TXN_DIMTBL":

					$tsql = array();
					foreach($value as $fname => $fvalue)
					{
						if ($fvalue != "")
						{
							$tsql[$fname] = $fvalue;
						}
					}
					
					if ($value["idTXN_DIMTBL"] > 0 )
					{
						$xSet = "";
						foreach($tsql as $tna => $fnv)
						{
							if ($tna != "idTXN_DIMTBL" && $tna != "id" )
							{
								$xSet .= ", ";
								$xSet .= $tna . "='" . $fnv . "'";
							}
							
						}
						
						$sqlQuery[$value["id"].$name]["Query"] = "UPDATE txn_dimtbl SET " . substr($xSet,1);   
						$sqlQuery[$value["id"].$name]["Query"] .= " WHERE idTXN_DIMTBL='" . $value["idTXN_DIMTBL"] . "' ;" ;
						$sqlQuery[$value["id"].$name][$value["id"]] = "";
					}
					else
					{
						$xSet = "";
						$xVal = "";
						
						foreach($tsql as $tna => $fnv)
						{
							if ($tna != "idTXN_DIMTBL" && $tna != "id" )
							{
								$xSet .= ",";
								$xSet .= $tna;
								$xVal .= ",";
								$xVal .= "'" . $fnv . "'";
								
							}
							
						}
						
						$sqlQuery[$value["id"].$name]["Query"] = "INSERT INTO txn_dimtbl (" . substr($xSet,1) . ") ";   
						$sqlQuery[$value["id"].$name]["Query"] .= " VALUES (" . substr($xVal,1) . ")";
						
						$sqlQuery[$value["id"].$name][$value["id"]] = $value["idTXN_DIMTBL"] . ":";
						
					}
					
					$retId = $this->execQuery($g->con,$sqlQuery[$value["id"].$name]["Query"],$retCount);
					$sqlQuery[$value["id"].$name]["Query"] .= " [" . $this->sqlQueErr[count($this->sqlQueErr)-1] . "]";
					$sqlQuery[$value["id"].$name][$value["id"]] = $retId . ":" . $sqlQuery[$value["id"].$name][$value["id"]];
					if($retId < 0)
					{
						$this->hasErrors = 1;
					}
					$newTxnId = $retId;				
				break;
				case "TXN_FBMASTER":

					$tsql = array();
					if( $value["TXN_FBMASTER_TXNID"] < 0)
					{
						$value["TXN_FBMASTER_TXNID"] = $newTxnId;
					}
										
					foreach($value as $fname => $fvalue)
					{
						if ($fvalue != "")
						{
							$tsql[$fname] = $fvalue;
						}
					}
					
					if ($value["idTXN_FBMASTER"] > 0 )
					{
						$xSet = "";
						foreach($tsql as $tna => $fnv)
						{
							if ($tna != "idTXN_FBMASTER" && $tna != "id" )
							{
								$xSet .= ", ";
								$xSet .= $tna . "='" . $fnv . "'";
							}
							
						}
						
						$sqlQuery[$value["id"].$name]["Query"] = "UPDATE txn_fbmaster SET " . substr($xSet,1);   
						$sqlQuery[$value["id"].$name]["Query"] .= " WHERE idTXN_FBMASTER='" . $value["idTXN_FBMASTER"] . "' ;" ;
						$sqlQuery[$value["id"].$name][$value["id"]] = "";
					}
					else
					{

						$xSet = "";
						$xVal = "";
						
						foreach($tsql as $tna => $fnv)
						{
							if ($tna != "idTXN_FBMASTER" && $tna != "id" )
							{
								$xSet .= ",";
								$xSet .= $tna;
								$xVal .= ",";
								$xVal .= "'" . $fnv . "'";
								
							}
							
						}
						
						$sqlQuery[$value["id"].$name]["Query"] = "INSERT INTO txn_fbmaster (" . substr($xSet,1) . ") ";  
						$sqlQuery[$value["id"].$name]["Query"] .= " VALUES (" . substr($xVal,1) . ")"; 
						
						$sqlQuery[$value["id"].$name][$value["id"]] = $value["idTXN_FBMASTER"] . ":";
						
					}
					$retId = $this->execQuery($g->con,$sqlQuery[$value["id"].$name]["Query"],$retCount);
					$sqlQuery[$value["id"].$name]["Query"] .= " [" . $this->sqlQueErr[count($this->sqlQueErr)-1] . "]";
					$sqlQuery[$value["id"].$name][$value["id"]] = $retId . ":" . $sqlQuery[$value["id"].$name][$value["id"]];
					if($retId < 0)
					{
						$this->hasErrors = 1;
					}
					
				break;
				case "TXN_FBBUILD":
				
					$tsql = array();

// $this->depdebug .= "\n is idTXN_DIMTBL = " . $this->getIndex($sqlQuery,"TXN_DIMTBL","",0);
					
					// $this->hasErrors = 4;
					
					// if true new from copy of org
					if ($copyToNew == "" && $value["TXN_FBBUILD_FIELDID"] != $newTxnId && $newTxnId != "" )
					{
						$copyToNew = "done";
						$fbFieldId = array();
						$fbmasterId = array();
						
//						readAll("txn_fbmaster",$value["TXN_FBBUILD_FIELDID"])
				 		
				  		$wTbls = new dbMaster("txn_fbmaster",$this->tblInfo->schema);
				  		$dtaObj = array();
				  		$dtaObj["TXN_FBMASTER_TXNID"]=$value["TXN_FBBUILD_FIELDID"];
				  		$wTbls->dbFindMatch($dtaObj);
				  		
				  		$reObj = $wTbls->result;
				  		$reNew = $wTbls->result;
				  		
				  		$occ = 0;
				  		while ($occ < count($reObj))
				  		{
					  		$wTbls = new dbMaster("txn_fbfield",$this->tblInfo->schema);
					  		$dtaObj = array();
					  		$dtaObj["TXN_FBFIELD_BOMID"] = $reObj[$occ]["idTXN_FBMASTER"];
					  		$wTbls->dbFindMatch($dtaObj);
					  		$reObj[$occ]["TXN_FBFIELD"] = array();
							$wocc = 0;
							while ($wocc < count($wTbls->result))
							{
								$reObj[$occ]["TXN_FBFIELD"][count($reObj[$occ]["TXN_FBFIELD"])] = $wTbls->result[$wocc];
								$wocc += 1;
							}
												  			
				  			$occ += 1;
				  		}

						
						
				  		$occ = 0;
				  		while ($occ < count($reObj))
				  		{

							$xSet = "";
							$xVal = "";
							
							foreach($reObj[$occ] as $tna => $fnv)
							{
								if ($tna != "idTXN_FBMASTER" && $tna != "TXN_FBFIELD" )
								{
									$xSet .= ",";
									$xSet .= $tna;
									$xVal .= ",";
									if ($tna != "TXN_FBMASTER_TXNID")
									{
										$xVal .= "'" . $fnv . "'";
									}
									else
									{
									
										$xVal .= "'" . $newTxnId . "'";
									
									}
									
								}
								
							}
						
							$sqlQuery["TXN_FBMASTERcopy".$occ]["Query"] = "INSERT INTO txn_fbmaster (" . substr($xSet,1) . ") ";  
							$sqlQuery["TXN_FBMASTERcopy".$occ]["Query"] .= " VALUES (" . substr($xVal,1) . ")"; 
							$sqlQuery[$value["id"].$name][$value["id"]] = $value["idTXN_FBMASTER"] . ":";
							
							$retId = $this->execQuery($g->con,$sqlQuery["TXN_FBMASTERcopy".$occ]["Query"],$retCount);
							$sqlQuery["TXN_FBMASTERcopy".$occ]["Query"] .= " [" . $this->sqlQueErr[count($this->sqlQueErr)-1] . "]";
						
						
							
							$fbmasterId[$reObj[$occ]["idTXN_FBMASTER"]] = $retId;
							


							$wocc = 0;
					  		while ($wocc < count($reObj[$occ]["TXN_FBFIELD"]) )
					  		{
	
								$xSet = "";
								$xVal = "";
								
								

								if (!$reObj[$occ]["TXN_FBFIELD"][$wocc]["TXN_FBFIELD_LABELID"] || $reObj[$occ]["TXN_FBFIELD"][$wocc]["TXN_FBFIELD_LABELID"] == "")
								{
									$reObj[$occ]["TXN_FBFIELD"][$wocc]["TXN_FBFIELD_LABELID"] = "0";
								}
								
								if (!$reObj[$occ]["TXN_FBFIELD"][$wocc]["TXN_FBFIELD_FISEQ"] || $reObj[$occ]["TXN_FBFIELD"][$wocc]["TXN_FBFIELD_FISEQ"] == "")
								{
									$reObj[$occ]["TXN_FBFIELD"][$wocc]["TXN_FBFIELD_FISEQ"] = "0";
								}
						
								foreach($reObj[$occ]["TXN_FBFIELD"][$wocc] as $tna => $fnv)
								{
									if ($tna != "idTXN_FBFIELD"  )
									{
										$xSet .= ",";
										$xSet .= $tna;
										$xVal .= ",";
										
										if ($tna != "TXN_FBFIELD_BOMID")
										{
											$xVal .= "'" . $fnv . "'";
										}
										else
										{
											$xVal .= "'" . $fbmasterId[$fnv] . "'";
										}
										
									}
									
								}
								$sqlQuery["TXN_FBFIELDcopy".$occ."_".$wocc]["Query"] = "INSERT INTO txn_fbfield (" . substr($xSet,1) . ") ";  
								$sqlQuery["TXN_FBFIELDcopy".$occ."_".$wocc]["Query"] .= " VALUES (" . substr($xVal,1) . ")"; 
								
								$retId = $this->execQuery($g->con,$sqlQuery["TXN_FBFIELDcopy".$occ."_".$wocc]["Query"],$retCount);
								$sqlQuery["TXN_FBFIELDcopy".$occ."_".$wocc]["Query"] .= " [" . $this->sqlQueErr[count($this->sqlQueErr)-1] . "]";
								
								
								$fbfieldId[$reObj[$occ]["TXN_FBFIELD"][$wocc]["idTXN_FBFIELD"]] = $retId;
								$wocc += 1;	
							}
							
							$occ += 1;
						}
					}
				  	// if true new from copy of org end	
// $this->depdebug = $reObj;
  
					
// $this->depdebug .= "\nTXN_FBBUILD_BOMID=".$value["TXN_FBBUILD_BOMID"]. "after =";

					if( $value["TXN_FBBUILD_BOMID"] < 0 )
					{
						$value["TXN_FBBUILD_BOMID"] = $this->getIndex($sqlQuery,"TXN_FBMASTER",$value["TXN_FBBUILD_BOMID"],0);
						$value["TXN_FBBUILD_FIELDID"] = $this->getIndex($sqlQuery,"TXN_FBFIELD",$value["TXN_FBBUILD_FIELDID"],0);
					}
				
// $this->depdebug .=  $value["TXN_FBBUILD_BOMID"] . $value["TXN_FBBUILD_DSPSEQ"]  . $value["TXN_FBBUILD_ROWDTA"] . "\n";

					
					foreach($value as $fname => $fvalue)
					{
						
//						if ($fvalue != "")
//						{
							$tsql[$fname] = $fvalue;
//						}
//						else
//						{
// $this->depdebug .= "[-]" . $fname;							
//						}
					}

					
					if ($value["idTXN_FBBUILD"] > 0 )
					{
						$xSet = "";
						foreach($tsql as $tna => $fnv)
						{
							$neVal = $fnv;
							
							switch ($tna)
							{
								case "TXN_FBBUILD_ROWDTA":
									
									$cl = explode(",",$fnv);
									$wocc = 0;
									$neVal="";
									$seVal="";
									while ($wocc < count($cl))
									{
										if ($copyToNew != "")
										{
											$neVal .= $seVal . $fbfieldId[$cl[$wocc]];
										}
										else
										{
											$neVal .= $seVal . $this->getFieldId($cl[$wocc],$sqlQuery,"TXN_FBFIELD");
										}
										
										$seVal=",";
										
										// $cl[$wocc] = $fbfieldId[$cl[$wocc]];
										$wocc += 1;
									}
								break;
								default:
							}
																						
							if ($tna != "idTXN_FBBUILD" && $tna != "id" )
							{
								$xSet .= ", ";
								$xSet .= $tna . "='" . $neVal . "'";
							}
							
						}
						
						$sqlQuery[$value["id"].$name]["Query"] = "UPDATE txn_fbbuild SET " . substr($xSet,1);   
						$sqlQuery[$value["id"].$name]["Query"] .= " WHERE idTXN_FBBUILD='" . $value["idTXN_FBBUILD"] . "' ;" ;
						$sqlQuery[$value["id"].$name][$value["id"]] = "";
					}
					else
					{
						$xSet = "";
						$xVal = "";
						
						
						foreach($tsql as $tna => $fnv)
						{
							$neVal = $fnv;
$this->depdebug .= "\nbuild --" . $tna ."=". $neVal . "=";							
							switch ($tna)
							{
								case "TXN_FBBUILD_FIELDID":

									if (!$newTxnId)
									{
										$neVal = $E_POST["idTXN_DIMTBL"];
									}
									else
									{
										$neVal = $newTxnId;
									}

								break;
								case "TXN_FBBUILD_BOMID":
									if ($copyToNew != "")
									{
										$neVal = $fbmasterId[$fnv];
									}



								break;
								case "TXN_FBBUILD_ROWDTA":
									
									$cl = explode(",",$fnv);
									$wocc = 0;
									$neVal="";
									$seVal="";
									while ($wocc < count($cl))
									{
										if ($copyToNew != "")
										{
											$neVal .= $seVal . $fbfieldId[$cl[$wocc]];
										}
										else
										{
											$neVal .= $seVal . $this->getFieldId($cl[$wocc],$sqlQuery,"TXN_FBFIELD");
										}
										
										$seVal=",";
										
										// $cl[$wocc] = $fbfieldId[$cl[$wocc]];
										$wocc += 1;
									}
								break;
								default:
							}
							
							if ($tna != "idTXN_FBBUILD" && $tna != "id" )
							{
								$xSet .= ",";
								$xSet .= $tna;
								$xVal .= ",";
								$xVal .= "'" . $neVal . "'";
								
							}
							
								
						}
$this->depdebug .= "\nINSERT INTO txn_fbbuild (" . substr($xSet,1) . ") ";  
$this->depdebug .= " VALUES (" . substr($xVal,1) . ")"; 
						
						$sqlQuery[$value["id"].$name]["Query"] = "INSERT INTO txn_fbbuild (" . substr($xSet,1) . ") ";  
						$sqlQuery[$value["id"].$name]["Query"] .= " VALUES (" . substr($xVal,1) . ")"; 
						
						$sqlQuery[$value["id"].$name][$value["id"]] = $value["idTXN_FBBUILD"] . ":";
						
					}
					
					$retId = $this->execQuery($g->con,$sqlQuery[$value["id"].$name]["Query"],$retCount);
					$sqlQuery[$value["id"].$name]["Query"] .= " [" . $this->sqlQueErr[count($this->sqlQueErr)-1] . "]";
					$sqlQuery[$value["id"].$name][$value["id"]] = $retId . ":" . $sqlQuery[$value["id"].$name][$value["id"]];
					if($retId < 0)
					{
						$this->hasErrors = 1;
					}
					
				
														
				break;
				
				case "TXN_FBFIELD":

					$tsql = array();
					
					$trgBom = $value["TXN_FBFIELD_BOMID"];
					
					if( $value["TXN_FBFIELD_BOMID"] < 0 )
					{
						$value["TXN_FBFIELD_BOMID"] = $this->getIndex($sqlQuery,"TXN_FBMASTER",$value["TXN_FBFIELD_BOMID"],0);
					}
					
										
										
					foreach($value as $fname => $fvalue)
					{
						if ($fvalue != "")
						{
							$tsql[$fname] = $fvalue;
						}
					}
					
					if ($value["idTXN_FBFIELD"] > 0 )
					{
						$xSet = "";
						foreach($tsql as $tna => $fnv)
						{
							if ($tna != "idTXN_FBFIELD" && $tna != "id" )
							{
								$xSet .= ", ";
								$xSet .= $tna . "='" . $fnv . "'";
							}
							
						}
						
						$sqlQuery[$value["id"].$name]["Query"] = "UPDATE txn_fbfield SET " . substr($xSet,1);   
						$sqlQuery[$value["id"].$name]["Query"] .= " WHERE idTXN_FBFIELD='" . $value["idTXN_FBFIELD"] . "' ;" ;
						$sqlQuery[$value["id"].$name][$value["id"]] = "";
					}
					else
					{
						$xSet = "";
						$xVal = "";
						
						foreach($tsql as $tna => $fnv)
						{
							if ($tna != "idTXN_FBFIELD" && $tna != "id" )
							{
								$xSet .= ",";
								$xSet .= $tna;
								$xVal .= ",";
								$xVal .= "'" . $fnv . "'";
								
							}
							
						}
						
						$sqlQuery[$value["id"].$name]["Query"] = "INSERT INTO txn_fbfield (" . substr($xSet,1) . ") ";  
						$sqlQuery[$value["id"].$name]["Query"] .= " VALUES (" . substr($xVal,1) . ")"; 

						$sqlQuery[$value["id"].$name][$value["id"]] = $value["idTXN_FBFIELD"] . ":" . $value["TXN_FBFIELD_FIVAL"] . ":" . $trgBom;
						
					}				
					
					$retId = $this->execQuery($g->con,$sqlQuery[$value["id"].$name]["Query"],$retCount);
					$sqlQuery[$value["id"].$name]["Query"] .= " [" . $this->sqlQueErr[count($this->sqlQueErr)-1] . "]";
					$sqlQuery[$value["id"].$name][$value["id"]] = $retId . ":" . $sqlQuery[$value["id"].$name][$value["id"]];
					if($retId < 0)
					{
						$this->hasErrors = 1;
					}
				break;
				
				default:
				
			}
			
			
			$retCount += 1;
			
		}
		
$this->fbmasterId = $fbmasterId;
$this->fbfieldId = $fbfieldId;

// $this->hasErrors = 5;

		if ($this->hasErrors > 0)
		{
			// Rollback transaction
			mysqli_rollback($g->con);
		}
		else
		{
			// Commit transaction
			mysqli_commit($g->con);
		}
			
		closeConnection($g->con);
		$this->sqlQuery = $sqlQuery;
	
		
		
	}
	
	function dbI22nsRec($dtaObj)
	{
		
		$this->dbFnct = 'dbInsRec';
		$this->localScript = "txn_fbmaster";
		
//		$tPost = explode(",",$dtaObj["txn_fbBOM"]);
//		$occ = 0;
//		while ($occ < count($tPost))
//		{
//			$this->E_POST[$occ] = explode("\t",$tPost[$occ]);
//			$occ += 1;
//		}
		
		
  		$wTbls = new dbMaster("txn_fbmaster",$this->tblInfo->schema);
  		$ret = $wTbls->dbInsRec($dtaObj);
  		$this->dbInsRecResult = $wTbls;
		$this->result = $wTbls->result;
	
		$E_POST = setEpost($this->tblInfo->schema,$dtaObj);
		$tPost = explode(",",$dtaObj["txn_fbBOM"]);
		$occ = 0;
		$this->E_POST = array();
		while ($occ < count($tPost))
		{
			$this->E_POST[$occ] = explode("\t",$tPost[$occ]);
			$occ += 1;
		}
		
		$dtaObj = array();
		$dtaObj["TXN_FBMASTER_BOMCODE"] = $E_POST["TXN_FBMASTER_BOMCODE"];
		
		$wTbls = new dbMaster("txn_fbmaster",$this->tblInfo->schema);
		$ret = $wTbls->dbFindMatch($dtaObj);
		$this->fetchResult = $wTbls->result;

  		
//	  		// Bpar;
//	  		
//	  		$wTbls = array();
//	  		$wTbls[0] = new dbMaster("txn_fbmaster",$this->tblInfo->schema);
//	
//	  		$insertSet = $this->dbInsertSet($wTbls,$this->tblInfo->schema,$dtaObj);
//	  		  		
//	  		$this->insertSet = $insertSet;
//	  		$wret[0] = $this->dbGenPrep($wTbls[0],$insertSet[0],$dtaObj);
//			
//			$this->updErrCode = $wTbls[0];
//			$updErr = $wret[0]->errorCode;
//			
//			if ($updErr == 0)
//			{
//				$this->updErrCodeRe = $wret[0]->result[0]["idVGB_BPAR"];
//				$dtaObj["idVGB_BPAR"] = $wret[0]->result[0]["idVGB_BPAR"];
//				$dtaObj["VGB_ADDR_BPART"] = $dtaObj["idVGB_BPAR"];
//				$dtaObj["VGB_CUST_BPART"] = $dtaObj["idVGB_BPAR"];
//				$dtaObj["VGB_SUPP_BPART"] = $dtaObj["idVGB_BPAR"];
//			}
//	
//			
//			// ADDR;
//	  		$wTbls = array();
//			$wTbls[0] = new dbMaster("vgb_addr",$this->tblInfo->schema);
//			if ($updErr == 0)
//			{
//				
//				
//	
//		  		$insertSet = $this->dbInsertSet($wTbls,$this->tblInfo->schema,$dtaObj);
//		  		$wret[1] = $this->dbGenPrep($wTbls[0],$insertSet[0],$dtaObj);
//		  		$updErr = $wret[1]->errorCode;
//				if ($updErr == 0)
//				{
//					$dtaObj["idVGB_ADDR"] = $wret[1]->result[0]["idVGB_ADDR"];
//					$dtaObj["VGB_CUST_BTADD"] = $dtaObj["idVGB_ADDR"];
//					$dtaObj["VGB_CUST_STADD"] = $dtaObj["idVGB_ADDR"];
//					$dtaObj["VGB_SUPP_BTADD"] = $dtaObj["idVGB_ADDR"];
//					$dtaObj["VGB_SUPP_STADD"] = $dtaObj["idVGB_ADDR"];
//					
//				}
//				else
//		  		{
//		  			$wret[0]->dbDelRec($dtaObj);
//		  		}
//		  	}
//		  	else
//		  	{
//				$wTbls[0]->dbValidConstraints($dtaObj);
//				$wret[1] = $wTbls[0];	  		
//		  	}
//	
//			// CUST OR SUPP;
//	  		$wTbls = array(); $wwT = $E_POST["SESSION"]!="VGB_CUSTCT"?"vgb_supp":"vgb_cust";
//			$wTbls[0] = new dbMaster($wwT,$this->tblInfo->schema);
//			if ($updErr == 0)
//			{
//				
//		  		
//		  		$insertSet = $this->dbInsertSet($wTbls,$this->tblInfo->schema,$dtaObj);
//		  		$wret[2] = $this->dbGenPrep($wTbls[0],$insertSet[0],$dtaObj);
//		  		$updErr = $wret[2]->errorCode;
//		  		if ($updErr != 0)
//		  		{
//		  			$wret[1]->dbDelRec($dtaObj);
//		  			$wret[0]->dbDelRec($dtaObj);
//		  		}
//			}		
//		  	else
//		  	{
//				$wTbls[0]->dbValidConstraints($dtaObj);
//				$wret[2] = $wTbls[0];	  		
//		  	}
//	
//			if ($updErr == 0)
//			{
//			
//				$this->result = array();
//				$this->result[0] = $wret[0]->result[0];
//				$this->result[1] = $wret[1]->result[0];
//				$this->result[2] = $wret[2]->result[0];
//				$this->errorCode = 0;
//			}
//			else
//			{
//				$this->errorCode = $updErr;
//				$this->result = "";		
//			}
//			
//			$this->invalidConstraints = array();
//			$occ = 0;
//			$seq = 0;
//			while ($occ < 3)
//			{
//				$wocc = 0;
//				while ($wocc < count($wret[$occ]->invalidConstraints))
//				{
//					$this->invalidConstraints[$seq] = $wret[$occ]->invalidConstraints[$wocc];
//					$seq  += 1;
//					$wocc += 1;
//				}
//				$occ += 1;
//			}
//			
		// $this->result = $wret;
		
	}	

}





function xxBgn()
{
}
class xxvgb_bpar_ext extends dbMaster
{
	function xxvgb_bpar_ext($schema)
	{
		$this->dbMaster("vgb_bpar",$schema);
	}


	function xxdbSetTrig()
	{



$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgb_bpar WHERE [=WHERE=] [=COND:vgb_bpar=][=ORDBY=] LIMIT 1 ) t1

			
			LEFT JOIN vgb_cust t2 ON t2.VGB_CUST_BPART = idVGB_BPAR [=COND:vgb_cust=]
			LEFT JOIN vgb_supp t3 ON t3.VGB_SUPP_BPART = idVGB_BPAR [=COND:vgb_supp=]
			LEFT JOIN vgb_addr t4 ON t4.VGB_ADDR_BPART = idVGB_BPAR	[=COND:vgb_addr=]		
			
			
			 	
			 
		
EOD;

		return $trig;
		
	}

}



class xxvgb_addr extends dbMaster
{
	function xxvgb_addr($schema)
	{
		$this->dbMaster("vgb_addr",$schema);
	}



		
	function xxdbSetTrig()
	{

$trig = <<<EOD
			SELECT * FROM 
			 
		 	( SELECT * FROM vgb_addr WHERE [=WHERE=] [=COND:vgb_addr=] [=ORDBY=] [=LIMIT=] ) t1
		 	
		LEFT JOIN vgb_bpar ON idVGB_BPAR = t1.VGB_ADDR_BPART [=COND:vgb_bpar=]
		LEFT JOIN vtx_schh ON idVTX_SCHH = t1.VGB_ADDR_SCHID OR idVTX_SCHH = t1.VGB_ADDR_PCHID 
		LEFT JOIN vgb_cntr ON idVGB_CNTR = t1.VGB_ADDR_CNTID
		LEFT JOIN vgb_prst ON idVGB_PRST = t1.VGB_ADDR_PRSID 
				

		
EOD;

		return $trig;
		
	}


}	

class xxvgb_cust extends dbMaster
{
	function xxvgb_cust($schema)
	{
		$this->dbMaster("vgb_cust",$schema);
	}

	function xxonInitNewRec($tbl,$pr)
	{
		$tmpObj = array();
		$tmpObj["idVGB_BPAR"]= $tbl["VGB_CUST_BPART"];
		$bpar = new vgb_bpar_ext($this->tblInfo->schema); 
		$bpar->dbFindMatch($tmpObj);
		if (count($bpar->result) > 0)
		{
			$tbl["VGB_CUST_BPNAM"] = $bpar->result[0]["VGB_BPAR_BPNAM"];
			$tbl["VGB_CUST_BTADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_CUST_STADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_CUST_SLSRP"] = $bpar->result[0]["idVGB_SLRP"];

		}

		foreach($bpar->result[0] as $name => $value)
		{
			if (!$tbl[$name]) 
			{
				$tbl[$name] = $bpar->result[0][$name];
			}
			
		}
			
		
		
		$this->onInitNewRecX['vgb_cust'] = $tbl;

		return $tbl;
	}


	function xxdbDelRec($dtaObj)
	{
		$this->dbFnct = 'dbDelRec';
		
		$recSet = setEpost($this->tblInfo->schema,$dtaObj);
		$idVGB_BPAR = $recSet["VGB_CUST_BPART"];
		
		$customer = new dbMaster("vgb_cust",$this->tblInfo->schema);
		$customer->dbDelRec($dtaObj);
		$this->errorCode = $customer->errorCode;
		
		$this->customer = $customer;
		$this->currentPartner = $idVGB_BPAR;
		// Check if partner is supplier
		
		$partner = new vgb_bpar($this->tblInfo->schema);
		$objChk = array();
		$objChk['idVGB_BPAR'] = $idVGB_BPAR;
		$partner->dbChkMatch($objChk);
		if ($partner->fetchResult[0]['idVGB_CUST'] == null && $partner->fetchResult[0]['idVGB_SUPP'] == null )
		{
			$addresses = array();
			$addr = new vgb_addr($this->tblInfo->schema);

			$occ = 0;
			while ($occ < count($partner->fetchResult))
			{
				if ($partner->fetchResult[$occ]['idVGB_ADDR'] != null)
				{
					$objChk['idVGB_ADDR'] = $partner->fetchResult[$occ]['idVGB_ADDR'];
					$objChk['VGB_ADDR_BPART'] = $idVGB_BPAR;
					$addr->dbDelRec($objChk);
					$this->delrecs = $objChk['idVGB_ADDR'];
					$addresses[count($addresses)] = $addr;
				}
				$occ += 1;
				
			}
			
			$partner->dbDelRec($objChk);
			$this->addresses = $addresses;

		};

		$this->partner = $partner;
		
		
		
		// Will only be allowed if last address was deleted (no constraints
		// $partner = $this->dbMaster("vgb_bpar",$this->tblInfo->schema);
		// $partner->dbDelRec($dtaObj);
	
	}	
				

	function xxdbSetTrig()
	{

$trig = <<<EOD
			SELECT * FROM
			 
		 	( SELECT * FROM vgb_bpar 

		LEFT JOIN vgb_cust ON idVGB_BPAR = VGB_CUST_BPART [=COND:vgb_cust=]
		LEFT JOIN vgb_addr t2 ON t2.VGB_ADDR_BPART = VGB_CUST_BPART [=COND:vgb_addr=]
		LEFT JOIN vgb_ctyp ON idVGB_CTYP = VGB_CUST_CUTYP
		LEFT JOIN vgb_curr ON idVGB_CURR = VGB_CUST_CURID
		LEFT JOIN vgb_mark ON idVGB_MARK = VGB_CUST_MRKID
		LEFT JOIN vgb_slrp ON idVGB_SLRP = VGB_CUST_SLSRP
		LEFT JOIN vgb_term ON idVGB_TERM = VGB_CUST_TERID 
								
		WHERE [=WHERE=] AND idVGB_CUST [=COND:vgb_bpar=]  [=LIMIT=] ) tx		

		
EOD;


		return $trig;
		
		
		
	}

}	

class xxvgb_supp extends dbMaster
{
	function xxvgb_supp($schema)
	{
		$this->dbMaster("vgb_supp",$schema);
	}

	function xxonInitNewRec($tbl,$pr)
	{
		$tmpObj = array();
		$tmpObj["idVGB_BPAR"]= $tbl["VGB_SUPP_BPART"];
		$bpar = new vgb_bpar_ext($this->tblInfo->schema); 
		$bpar->dbFindMatch($tmpObj);
		if (count($bpar->result) > 0)
		{
			$tbl["VGB_SUPP_BPNAM"] = $bpar->result[0]["VGB_BPAR_BPNAM"];
			$tbl["VGB_SUPP_BTADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_SUPP_STADD"] = $bpar->result[0]["idVGB_ADDR"];
			$tbl["VGB_SUPP_SLSRP"] = $bpar->result[0]["idVGB_SLRP"];

		}

		foreach($bpar->result[0] as $name => $value)
		{
			if (!$tbl[$name]) 
			{
				$tbl[$name] = $bpar->result[0][$name];
			}
			
		}
			
		
		
		$this->onInitNewRecX['vgb_supp'] = $tbl;

		return $tbl;
	}
	
	
	function xxdbDelRec($dtaObj)
	{
		$this->dbFnct = 'dbDelRec';
		
		$recSet = setEpost($this->tblInfo->schema,$dtaObj);
		$idVGB_BPAR = $recSet["VGB_SUPP_BPART"];
		
		$supplier = new dbMaster("vgb_supp",$this->tblInfo->schema);
		$supplier->dbDelRec($dtaObj);
		$this->errorCode = $supplier->errorCode;
		
		$this->supplier = $supplier;
		$this->currentPartner = $idVGB_BPAR;
		// Check if partner is supplier
		
		$partner = new vgb_bpar($this->tblInfo->schema);
		$objChk = array();
		$objChk['idVGB_BPAR'] = $idVGB_BPAR;
		$partner->dbChkMatch($objChk);
		if ($partner->fetchResult[0]['idVGB_CUST'] == null && $partner->fetchResult[0]['idVGB_SUPP'] == null )
		{
			$addresses = array();
			$addr = new vgb_addr($this->tblInfo->schema);

			$occ = 0;
			while ($occ < count($partner->fetchResult))
			{
				if ($partner->fetchResult[$occ]['idVGB_ADDR'] != null)
				{
					$objChk['idVGB_ADDR'] = $partner->fetchResult[$occ]['idVGB_ADDR'];
					$objChk['VGB_ADDR_BPART'] = $idVGB_BPAR;
					$addr->dbDelRec($objChk);
					$this->delrecs = $objChk['idVGB_ADDR'];
					$addresses[count($addresses)] = $addr;
				}
				$occ += 1;
				
			}
			
			$partner->dbDelRec($objChk);
			$this->addresses = $addresses;

		};

		$this->partner = $partner;
		
		
		
		// Will only be allowed if last address was deleted (no constraints
		// $partner = $this->dbMaster("vgb_bpar",$this->tblInfo->schema);
		// $partner->dbDelRec($dtaObj);
	
	}	


	function xxdbSetTrig()
	{


$trig = <<<EOD
			SELECT * FROM 
			 
		 	( SELECT * FROM vgb_bpar 
		 	
		LEFT JOIN vgb_supp t1 ON VGB_SUPP_BPART = idVGB_BPAR  [=COND:vgb_supp=]
		LEFT JOIN vgb_addr t2 ON t2.VGB_ADDR_BPART = t1.VGB_SUPP_BPART [=COND:vgb_addr=]
		LEFT JOIN vgb_curr ON idVGB_CURR = t1.VGB_SUPP_CURID
		LEFT JOIN vgb_term ON idVGB_TERM = t1.VGB_SUPP_TERID 
		
		WHERE [=WHERE=] AND idVGB_SUPP [=COND:vgb_bpar=] [=LIMIT=] ) tx		

		
EOD;

		return $trig;
		
	}

}	

?>