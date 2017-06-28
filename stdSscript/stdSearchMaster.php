<?php

// get List of Primary fields of all tables.
// Exclude primary fields in search patterns

// get list of all field in tables excluding promary fields

// get label of fields and if not found use table schema field description


class dbSearchMaster extends dbMaster
{
	function dbSearchMaster($schema,$dtaObj)
	{
		$this->ABmasterTable = $dtaObj['TBLNAME'];
		$this->ABignoreOrg = $dtaObj['ignoreOrg'];
		$this->dbMaster($dtaObj['TBLNAME'],$schema);
		$this->localPost = $dtaObj;
		
		if ($dtaObj["ORGCHK"] == "ON")
		{
			

			$this->ABorgCheck = $dtaObj["ABorgCheck"][0];
			$vobj = array();
			$tobj = array();

			$vobj[$dtaObj["tblFieldIdName"]] = $dtaObj["tblRecId"];
			$tobj[$dtaObj["tblFieldIdName"]]=PDO::PARAM_INT;

			$vobj[$dtaObj["DimName"]] = $dtaObj["DimVal"];
			$tobj[$dtaObj["DimName"]]=PDO::PARAM_STR;
			
			$vobj["orgFlag"] = "," . abs($dtaObj["flag"]);
			$tobj["orgFlag"]=PDO::PARAM_STR;
			
			$countTrig = implode(" UNION ",$dtaObj["ABorgCheck"]);
						
			// $this->dbPdoPrep($dtaObj["ABorgCheck"][0],$vobj,$tobj);
			$wTbl = new dbMaster($dtaObj['TBLNAME'],$schema);
			
			$wTbl->dbPdoPrep($countTrig,$vobj,$tobj);
			$this->ABorgCheckPdo = $wTbl;

			
			
			$this->ABorgCheckvobj = $vobj;
			$this->ABorgChecktobj = $tobj;
			$this->countTrig = $countTrig;
			$this->updOrgVal = "";
			
			$this->result = array();
			$occ = 0;
			while ($occ < count($wTbl->result))
			{
				if ($wTbl->result[$occ]["total"] && $wTbl->result[$occ]["total"] > 0)
				{
					$this->result[count($this->result)] = $wTbl->result[$occ];
				}
				$occ += 1;
			}
			
			if ($dtaObj["flag"] > 0 || count($this->result) == 0)
			{
				$xFlag = abs($dtaObj["flag"]);
				$xDim = str_replace("," . $xFlag . ",",",",$dtaObj["DimVal"]);
				if ($dtaObj["flag"] > 0)
				{
					$xDim .= ",".$xFlag;
				}
				
				$tmpDim = explode("," ,$xDim);
				
				$newOrg=",";
				$occ = 0;
				while ($occ < count($tmpDim))
				{
					if (trim($tmpDim[$occ])!="")
					{
						$newOrg .=  $tmpDim[$occ] . ",";
					}
					
					$occ += 1;
				}
				$newOrg .= "  ";
				
$updTrig = "UPDATE " . $dtaObj['TBLNAME'] . " SET " . $dtaObj["DimName"] . " = '" . $newOrg . "'";
$updTrig .= " WHERE " . $dtaObj["tblFieldIdName"] . " = " . $vobj[$dtaObj["tblFieldIdName"]] . " ";

				$this->updOrgVal = $newOrg;
				$this->updTrig = $updTrig;
				$this->dbPdoPrep($updTrig,$vobj,$tobj);
			}
					
			
			return;
		

		}
		
		
		$this->AB_CPARM = $this->dbGetCparm();
		$this->ABprimary = $this->ABgetTablePrimaryFields($this->tblPrimary->dta);
		$this->ABfields = $this->ABgetTableFields($this->tblFlds->dta,$this->ABprimary);
		$this->ABselectFields = $this->ABgetTableFields($this->tblFlds->dta,"");
		
		// $dtaObj['SQLFUNCTIONS'] = "SUM(VGL_JNDE_GLAMT) AS AmtType, COUNT(idVGL_JNHE) AS NumbType ";
		// $dtaObj['GROUPBY'] = "VGL_JNHE_GLFIS,VGL_JNHE_GLPER,VGL_JNDE_GLIDN";
		
		$this->fieldDescriptor = array();
		$this->fieldDescripRec = array();
		
		
		$maintblCtrts = $this->tblCtrts->dta;
		

		$tblData = array();
		$tblData = $this->ABStoreReturnDta($dtaObj['TBLNAME'],$schema,$tblData);


		$refTables = array();
		if ($dtaObj['SUPPTBL'])
		{
			$refTables = explode(",",$dtaObj['SUPPTBL']);
		}
		$this->refTables = $refTables;
		
		$this->ABjoins = array();
		$occ = 0;
		while ($occ < count($refTables))
		{
			$ref = $this->ABchecktblCtrts($refTables[$occ],$maintblCtrts);
			
			// This is to check if Join statament was provided
			$tmp = explode(":",$refTables[$occ]);
			if (count($tmp)>1)
			{
				$refTables[$occ] = $tmp[0];
			}
			
			
			$tblData = $this->ABStoreReturnDta($refTables[$occ],$schema,$tblData);
			
			if (strlen($ref)>0)
			{
				$this->ABjoins[$refTables[$occ]] = $ref;
				$this->dbMaster($refTables[$occ],$schema);
				$this->ABprimary .= $this->ABgetTablePrimaryFields($this->tblPrimary->dta);
				$this->ABfields .= $this->ABgetTableFields($this->tblFlds->dta,$this->ABprimary);
				$this->ABselectFields .= $this->ABgetTableFields($this->tblFlds->dta,"");
				
			}
			
			$occ += 1;
		}
		
		if (strripos($this->ABselectFields,",") == strlen($this->ABselectFields)-1)
		{
			$this->ABselectFields = substr($this->ABselectFields,0,strlen($this->ABselectFields)-1);
		}
		
		if ($dtaObj['SPATTERN'] != "[=GETLAYOUT=]")
		{	
			// $this->dspTrig = $this->ABgetTrig($dtaObj['TBLNAME'],$this->ABjoins,$this->ABfields,$dtaObj['SPATTERN'],$dtaObj["ORDERBY"]);
			$this->dspTrig = $this->ABgetTrig($dtaObj,$this->ABjoins,$this->ABfields);
			
			// $this->testInjection();
			$this->ABProcessTrig();
		}
		
		$this->tblData = $tblData;
		$this->ABsetRangeSelect();
		$this->ABSetMasterInfo();
	}

	function ABChkOrgDependency($dtaObj)
	{
		// not used
		$this->ABorgCheck = $dtaObj["ABorgCheck"][0];
		$vobj = array();
		$tobj = array();

		$vobj[$dtaObj["tblFieldIdName"]] = $dtaObj["tblRecId"];
		$tobj[$dtaObj["tblFieldIdName"]]=PDO::PARAM_INT;

		$vobj[$dtaObj["DimName"]] = $dtaObj["DimVal"];
		$tobj[$dtaObj["DimName"]]=PDO::PARAM_STR;
		
		$vobj["orgFlag"] = "," . abs($dtaObj["flag"]);
		$tobj["orgFlag"]=PDO::PARAM_STR;
		
		$countTrig = implode(" UNION ",$dtaObj["ABorgCheck"]);
					
		// $this->dbPdoPrep($dtaObj["ABorgCheck"][0],$vobj,$tobj);
		$wTbl = new dbMaster($dtaObj['TBLNAME'],$schema);
		
		$wTbl->dbPdoPrep($countTrig,$vobj,$tobj);
		$this->ABorgCheckPdo = $wTbl;
		
		
		$this->ABorgCheckvobj = $vobj;
		$this->ABorgChecktobj = $tobj;
		$this->countTrig = $countTrig;
		$this->updOrgVal = "";
		
		$this->result = array();
		$occ = 0;
		while ($occ < count($wTbl->result))
		{
			if ($wTbl->result[$occ]["total"] && $wTbl->result[$occ]["total"] > 0)
			{
				$this->result[count($this->result)] = $wTbl->result[$occ];
			}
			$occ += 1;
		}
		
		if ($dtaObj["flag"] > 0 || count($this->result) == 0)
		{
			$xFlag = abs($dtaObj["flag"]);
			$xDim = str_replace("," . $xFlag . ",",",",$dtaObj["DimVal"]);
			if ($dtaObj["flag"] > 0)
			{
				$xDim .= ",".$xFlag;
			}
			
			$tmpDim = explode("," ,$xDim);
			
			$newOrg=",";
			$occ = 0;
			while ($occ < count($tmpDim))
			{
				if (trim($tmpDim[$occ])!="")
				{
					$newOrg .=  $tmpDim[$occ] . ",";
				}
				
				$occ += 1;
			}
			$newOrg .= "  ";
			
			$updTrig = "UPDATE " . $dtaObj['TBLNAME'] . " SET " . $dtaObj["DimName"] . " = '" . $newOrg . "'";
			$updTrig .= " WHERE " . $dtaObj["tblFieldIdName"] . " = " . $vobj[$dtaObj["tblFieldIdName"]] . " ";

			$this->updOrgVal = $newOrg;
			$this->updTrig = $updTrig;
			$this->dbPdoPrep($updTrig,$vobj,$tobj);
		}
					
	}
	
	function ABSetMasterInfo()
	{
		
		$upd["ABprimary"] = $this->ABprimary;
		$upd["ABfields"] = $this->ABfields;
		$upd["ABselectFields"] = $this->ABselectFields;
		$upd["searchPattern"] = $this->searchPattern;
		$upd["refTables"] = $this->refTables;
		$upd["clauseType"] = $this->clauseType;
		$upd["whereClause"] = $this->ABgetFieldsDescr($this->whereClause);
		// $upd["fieldDescriptor"] = $this->fieldDescripRec;
		$upd["orderBySeq"] = $this->orderBySeq;
		$upd["PDOhasExecuted"] = $this->PDOhasExecuted;
		$upd["PDOABProcessTr"] = $this->PDOABProcessTr;
		$upd["pdoTimeStmp"] = $this->pdoTimeStmp;
		$upd["pdoErrorCode"] = $this->pdoErrorCode;
		$upd["errorInfo"] = $this->errorInfo;
		$upd["rowCount"] = $this->rowCount;
		$upd["tblStats"] = $this->ABCountTableRecords('local:');

		$this->ABMasterInfo = $upd;
		

	}
	
	function ABgetFieldsDescr($wClause)
	{
		
		$occ = 0;
		while ($occ < count($this->fieldDescripRec))
		{
			if ($this->fieldDescripRec[$occ]["name"] && (strpos("xx_" . $wClause,$this->fieldDescripRec[$occ]["name"]) * 1)  > 0)
			{
				$replWit = $this->fieldDescripRec[$occ]["ref"];
				if ((strpos($replWit,"LABEL:") * 1)  > 0)
				{
					$replWit = substr($replWit,0,(strpos($replWit,"LABEL:") * 1));
				}
					
				$wClause = str_replace($this->fieldDescripRec[$occ]["name"],$replWit,$wClause);
			}
			$occ += 1;
		}
		
		return $wClause;
		
		
	}


	
	function ABProcessTrig()
	{
		
		$this->ABProcessTransactionPdo($this->dspTrig);
		
		$occ = 0;
		while ($occ < count($this->result))
		{
			$this->result[$occ]["mainTbl"] = $dtaObj['TBLNAME'];
			$occ += 1;
		}
				
	}
	function ABStoreReturnDta($tblName,$schema,$obj)
	{
		$wTbls = new dbMaster($tblName,$schema);
		foreach($wTbls as $name => $value)
		{
			 $obj[$tblName][$name] = $value;
		}
		return $obj;

//			var debug = "";
//			debug += showProps(dDta.ABMaster.ABsearch.tblData.vgb_cust.tblInfo  ,"upd")
//			$("#focusGrid").val(debug)
				
	}
	
	function ABchecktblCtrts($rTable,$tblCtrts)
	{
		$occ = 0;
		$ref = "";
		$or = "";
		
		// This is to check if Join statament was provide
		$tmp = explode(":",$rTable);
		if (count($tmp)>1)
		{
			$rTable = $tmp[0];
			$ref = $tmp[1];
			$occ = count($tblCtrts);
		}
			
		
		while ($occ < count($tblCtrts))
		{
			
			if ($tblCtrts[$occ]["refTbl"] == $rTable)
			{
				$tmpRef = "";
				
				$and = "";
				foreach($tblCtrts[$occ]["refFields"] as $name => $value)
				{
					 $tmpRef .= $and . $name . " = " . $value;
					 $and = " AND ";
				}  	
				
				$tmpRef = "( " . $tmpRef . " ) ";
				$ref .= $or . $tmpRef;
				$or = " OR ";
				// $occ = count($tblCtrts);
			}
						
			$occ += 1;
		}
		
		if ($ref == "")
		{
			// If contraints are opposite direction???
			$locTbl = new dbMaster($rTable,$this->tblInfo->schema);
			$tblCtrts = $locTbl->tblCtrts->dta;
			$occ = 0;
			$ref = "";
			$or = "";
			while ($occ < count($tblCtrts))
			{
				
				if ($tblCtrts[$occ]["refTbl"] == $this->tblInfo->tblName)
				{
					$tmpRef = "";
					
					$and = "";
					foreach($tblCtrts[$occ]["refFields"] as $name => $value)
					{
						 $tmpRef .= $and . $name . " = " . $value;
						 $and = " AND ";
					}  	
					
					$tmpRef = "( " . $tmpRef . " ) ";
					$ref .= $or . $tmpRef;
					$or = " OR ";
					// $occ = count($tblCtrts);
				}
							
				$occ += 1;
			}
		}
		
		if (!$this->reftbl)
		{
			$this->reftbl = array();
		}
		
		$this->reftbl[count($this->reftbl)] = "[" .$rTable."]=" .$ref; 
		
		return $ref;
		
		
	}

	function ABgetTablePrimaryFields($primary)
	{
	// send $this->tblPrimary->dta;
	
		$ret = "";
		$occ = 0;
		while ($occ < count($primary))
		{
			$ret .= $primary[$occ]["colName"] . ",";
			$occ += 1;
		}
		return $ret;
		
	}
	
	function ABgetTableFields($tbFields,$primary)
	{
	// send $this->tblFlds->dta , exclude primary fields
	
		$ret = "";
		$occ = 0;
		while ($occ < count($tbFields))
		{
			if (strpos("x,".$primary."," ,",".$tbFields[$occ]["name"].",") < 1)
			{
				$ret .= $tbFields[$occ]["name"] . ",";
				if (!$this->fieldDescriptor[$tbFields[$occ]["name"]])
				{
					$this->fieldDescriptor[$tbFields[$occ]["name"]] = $tbFields[$occ]["comment"];
					$this->fieldDescripRec[count($this->fieldDescripRec)]["name"] = $tbFields[$occ]["name"];
					$this->fieldDescripRec[count($this->fieldDescripRec)-1]["ref"] = $tbFields[$occ]["comment"];
				}
				
			}
			$occ += 1;
		}
		return $ret;
		
	}
	
	function ABgetTrig($dtaObj,$tblJoin,$cFields)
	{
		$mainTbl = $dtaObj['TBLNAME'];
		$sPattern = $dtaObj['SPATTERN'];
		$orderBy = $dtaObj["ORDERBY"];

		$sqlFunction = $dtaObj['SQLFUNCTIONS'];
		$groupBy = $dtaObj['GROUPBY'];
		
		if (strlen(trim($sqlFunction)) > 0)
		{
			$sqlFunction = " ," . $sqlFunction;
		}
		if (strlen(trim($groupBy)) > 0)
		{
			$groupBy = " GROUP BY " . $groupBy;
		}


	
		$fldList = $this->ABselectFields;
		// $fldList = $this->ABsetField($this->ABselectFields);
		// $fldList = $this->ABsetField("vin_orhe,vin_orde,vin_lstr,vin_item,vin_wars,vin_itmwar,vin_locs,vin_uset,vin_unit");
		
		
		
$holdTrig = <<<EOC
		
		
		SELECT {$fldList} {$sqlFunction} FROM {$mainTbl}
		
EOC;
		
		
		if ($tblJoin)
		{
			foreach($tblJoin as $name => $value)
			{

$holdTrig .= <<<EOC
		
		LEFT JOIN {$name} ON {$value}  [=COND:{$name}=]
		
EOC;
			
			}
		}

		$fields = "";
		$sPattern = trim($sPattern);
		$this->clauseType = "LIKE";
		$this->clauseTypeChk = strpos("x".$sPattern,"[=SPE=]");
		if (strpos("x".$sPattern,"[=SPE=]") == 1)
		{
			$this->clauseType = "RANGE";
			$sPattern = substr($sPattern,7);
		}
		if (strpos("x".$sPattern,"[=FLD=]") == 1)
		{
			$this->clauseType = "FIELD";
			$sPattern = substr($sPattern,7);
			
		}		

		$this->searchPattern = $sPattern;


		$occ = 0;
		$wClause = "";
		$or = "";
		$cF = explode(",",$cFields);
		while ($occ < count($cF) && $this->clauseType == "LIKE") 
		{
			if (strlen($cF[$occ])>0 && strpos($cF[$occ],"AB_DILEVEL") == false )
			{
				$wClause .= $or . $cF[$occ] . " LIKE '%" . $sPattern . "%' ";
				$or = " OR ";
			}
			if (strlen($sPattern)==0 && strlen($wClause)>0)
			{
				$occ = count($cF);
			}
			
			$occ += 1;
		}
		
		if ($this->clauseType == "RANGE")
		{
			$wClause = $sPattern;
		}
		
		if ($orderBy)
		{
			$orderBy = "  ORDER BY " . $orderBy . " " ;
		}
		
$this->whereClause = $wClause;

$holdTrig .= <<<EOC
		
		WHERE ( {$wClause} ) [=COND:{$mainTbl}=] {$groupBy} {$orderBy} 	
		
EOC;
		
		
		
		
		$this->orderBySeq = $orderBy;
		
		$tFnc = new AB_querySession;
		if ($this->localPost["SESSION"] == "STDVIEWTBLPROTOTYPE")
		{
			$tFnc->ABignoreOrg = true;
		}
		else
		{
			$tFnc->ABignoreOrg = false;
		}
		
		$trig = $tFnc->tblAccessCond($objdta,$holdTrig,true,"onupdate,onupdate.USR");
		
		
		
		return $trig;
	
	}



	function testInjection()
	{
		// testInjection
		$inject = "a' or '1'='1";
		$this->injection = array();
		$this->injection["inval"] = $inject;
		
		$trig = "
		SELECT idVGB_CUST,VGB_CUST_BPART,VGB_CUST_BPNAM,VGB_CUST_BTADD,VGB_CUST_STADD,VGB_CUST_BPBNK,VGB_CUST_CUBNK,VGB_CUST_BKADD,VGB_CUST_CREDR,VGB_CUST_CRHOL,VGB_CUST_STATM,VGB_CUST_STBFW,VGB_CUST_TERID,VGB_CUST_CURBA,VGB_CUST_CRELI,VGB_CUST_CUTYP,VGB_CUST_BAORA,VGB_CUST_SLSRP,VGB_CUST_DELCO,VGB_CUST_COLLE,VGB_CUST_MRKID,VGB_CUST_CURID,VGB_CUST_UBPID,VGB_CUST_UBPDE,VGB_CUST_CSTAT,VGB_CUST_OVERD,VGB_CUST_OLDIN,VGB_CUST_CDATE,VGB_CUST_ORFOB,VGB_CUST_MISCE,VGB_CUST_TAXEX,VGB_CUST_CFCAT,VGB_CUST_LLIFE,VGB_CUST_AB_DILEVEL,idVGB_BPAR,VGB_BPAR_BPART,VGB_BPAR_BPNAM,VGB_BPAR_CDATE,idVGB_ADDR,VGB_ADDR_BPART,VGB_ADDR_ADDID,VGB_ADDR_DESCR,VGB_ADDR_ADNAM,VGB_ADDR_ADD01,VGB_ADDR_ADD02,VGB_ADDR_POSTC,VGB_ADDR_CITYN,VGB_ADDR_PRSID,VGB_ADDR_SCHID,VGB_ADDR_PCHID,VGB_ADDR_CNTID,VGB_ADDR_TEL01,VGB_ADDR_TEL02,VGB_ADDR_FAX01,VGB_ADDR_FAX02,VGB_ADDR_CONT1,VGB_ADDR_CONT2,VGB_ADDR_EMAIL,VGB_ADDR_TAXEX  FROM vgb_cust
				
		LEFT JOIN vgb_bpar ON ( VGB_CUST_BPART = idVGB_BPAR )   
				
		LEFT JOIN vgb_addr ON ( VGB_CUST_BKADD = idVGB_ADDR AND VGB_CUST_BPART = VGB_ADDR_BPART )  OR ( VGB_CUST_BTADD = idVGB_ADDR AND VGB_CUST_BPART = VGB_ADDR_BPART )  OR ( VGB_CUST_STADD = idVGB_ADDR AND VGB_CUST_BPART = VGB_ADDR_BPART )   
				
		WHERE (   (  VGB_BPAR_BPART <= :inval  ) )  AND VGB_CUST_AB_DILEVEL LIKE '%,2,%'    	
		";
		
		$this->ABProcessTransactionPdo($trig);
		$occ = 0;
		while ($occ < count($this->result))
		{
			$this->result[$occ]["mainTbl"] = $dtaObj['TBLNAME'];
			$occ += 1;
		}				
	}

	function ABProcessTransactionPdo($trig)
	{
		// Injection on range =  ' or '1'='1
		// Injection on wild card = %' or '%' = ' 
	
		$servername = "localhost";
		
		// NEW
		$tFnc = new AB_querySession;
		$tObj = $tFnc->getschemaReference($this->tblInfo->tblName);
		$username = $tObj['GSRresult'][0]['CFG_DBREF_DBUSER'];
		$password = $tObj['GSRresult'][0]['CFG_DBREF_DBUSERPWD'];
		

		$dbname = $this->tblInfo->schema;
		$this->PDOtrig = $trig;
		$this->PDOhasExecuted = false;
		$this->PDOABProcessTr = $this->PDOhasExecuted;



		try
		{
			
			$this->PDOhasExecuted = false;

			if ($this->brTrConn != null)
			{
				$conn = $this->brTrConn;
				$this->pdoSeesIt = true;
			}
			else
			{
				$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 				
				$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
	
				$this->pdoSeesIt = false;
			}
			
			$this->PDOhasExecuted = true;
			$this->PDOABProcessTr = $this->PDOhasExecuted;
			
			
			$stmt = $conn->prepare($trig);
			
			$err = $stmt->execute();
			// testInjection replace above command
			// $err = $stmt->execute($this->injection);
			
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
			
			$this->PDOhasExecuted = true;
			
		}
		catch(PDOException $e)
		{
			$this->PDOException = $e;

			if ($this->PDOhasExecuted == false)
			{
				$this->errorInfo = array();
				$this->errorInfo[0] = "Server Timed out";
				$this->errorInfo[1] = 10;
				$this->errorCode = 10;
				return;
				
			}
			else
			{
				$this->errorInfo = $stmt->errorInfo();
			}
			
			$this->errCount = count($this->errorInfo);
			if ($this->errCount > 1)
			{
				$this->errorCode = $this->errorInfo[1];
			}
			else
			{
//				$this->errorCode = 0;
			}
			
		}
				
		$this->fetchResult = $result;
		$this->result = $result;


		if ($this->brTrConn == null)
		{
			$conn = null;
			$stmt = null;
		}
		else
		{
			// Under observation
			$conn = null;
			$stmt = null;
			$this->brTrConn = null;
		}
		
		
	}

	function ABsetRangeSelect()
	{
	
		$this->ABrange = array();	

$this->ABrange["RFUNCTIONS"] = <<<EOC

<script>
	$(function() {
		
		$( "[ab-datepick]" ).datepicker({
			
			showOn: "button",
			buttonText: "<span class='glyphicon glyphicon-th-list'></span>",

      showOtherMonths: true,
      selectOtherMonths: true,			
			dateFormat: "yymmdd"
			
		});		
	});
	
	function ABsearchRemoveObj(objName)
	{
		$("#ABdspTrig").html(objName + " = " + $("[ab-searchid='" + objName + "']").length)
		$("[ab-searchid='" + objName + "']").click();
	}
	
	function ABsearchGetVal(scopeName)
	{
		if ($("[ab-model='" + scopeName + "']").attr("ctype")=="NUMBER")
		{
			var ret = $("[ab-model='" + scopeName + "']").val() * 1;
		}
		else
		{
			var ret = $("[ab-model='" + scopeName + "']").val();
		}
		
		return ret;
	}
	function ABsearchSetVal(scopeName,scopeVal)
	{
		$("[ab-model='" + scopeName + "']").val(scopeVal);
		
	}
	
	function ABsearchCheckRange(scopeName)
	{
		$("#ABdspTrig").html(scopeName )

		if (scopeName.lastIndexOf("-FROM") + 5 == scopeName.length)
		{
			var comp = scopeName.slice(0,scopeName.lastIndexOf("-FROM")) + "-TO";
			$("#ABdspTrig").html(scopeName+","+comp + "=" + ABsearchGetVal(comp) +"<"+ ABsearchGetVal(scopeName) )

			if (ABsearchGetVal(comp) < ABsearchGetVal(scopeName) )
			{
				ABsearchSetVal(comp,ABsearchGetVal(scopeName));
			}
		}
		if (scopeName.lastIndexOf("-TO") + 3 == scopeName.length)
		{
			var comp = scopeName.slice(0,scopeName.lastIndexOf("-TO")) + "-FROM";
			$("#ABdspTrig").html(scopeName+","+comp + "=" + ABsearchGetVal(comp) +">"+ ABsearchGetVal(scopeName) )			
			if (ABsearchGetVal(comp) > ABsearchGetVal(scopeName) )
			{
				ABsearchSetVal(comp,ABsearchGetVal(scopeName));
			}
		}
		
	}
	
</script>
		
EOC;


$this->ABrange["DATE"] = <<<EOC
<div  id="[=FIELDNAME=]" ABrange="DATE" class="" >
<table class="ab-border well " style="width:100%;">
<tr class="[=FIELDNAME=]-DIV">
<td>&nbsp;</td>
<td colspan="2" style="white-space:nowrap;">
<label>
<span class="text-primary " ab-label="[=FIELDNAME=]" >[=FIELDDESCR=]</span>
<span class="text-primary small" ab-label="STD_RANGE" >Range:</span>
</label>
</td>	
<td style="white-space:nowrap;text-align:right;">
	<input type="checkbox" class="ab-pointer" onclick="$('.[=FIELDNAME=]-RG').toggleClass('hidden');" />
	&nbsp;&nbsp;
	<span class="text-primary ab-border ab-spaceless ab-pointer" onclick="ABsearchRemoveObj('[=FIELDNAME=]')" >
	<span class="glyphicon glyphicon-trash"></span>
	</span>
	&nbsp;
</td>
</tr>
<tr class="[=FIELDNAME=]-RG hidden" >
<td>&nbsp;</td>
<td style="white-space:nowrap;">
<span class="text-primary" ab-label="STD_FROM" >FROM:</span>&nbsp;
</td>
<td>
<input ab-datepick type="text" ctype="[=COMPTYPE=]" size=10 placeholder="yyyymmdd" onchange="ABsearchCheckRange('AB-[=FIELDNAME=]-FROM');" ab-model="AB-[=FIELDNAME=]-FROM" title="default settings" >
</td>
<td>&nbsp;</td>
</tr>
<tr class="[=FIELDNAME=]-RG hidden">
<td>&nbsp;</td>
<td style="white-space:nowrap;">
<span class="text-primary" ab-label="STD_TO" >TO:</span>&nbsp;
</td>
<td>
<input ab-datepick type="text" ctype="[=COMPTYPE=]" size=10 placeholder="yyyymmdd" onchange="ABsearchCheckRange('AB-[=FIELDNAME=]-TO');" ab-model="AB-[=FIELDNAME=]-TO"   title="default settings" >
</td>
<td>&nbsp;</td>
</tr>
<tr class="[=FIELDNAME=]-RG hidden">
<td>&nbsp;</td>
<td class="text-primary" colspan="2"  style="white-space:nowrap;">
[=FIELDHELP=]
</td>
<td>&nbsp;</td>
</tr>
</table>
</div>

EOC;

$this->ABrange["VARCHAR"] = <<<EOC
<div  id="[=FIELDNAME=]"  ABrange="VARCHAR"  >
<table class="ab-border well" style="width:100%;">
<tr class="[=FIELDNAME=]-DIV">
<td>&nbsp;</td>
<td colspan="2"  style="white-space:nowrap;">
<label>
<span class="text-primary " ab-label="[=FIELDNAME=]" >[=FIELDDESCR=]</span>
<span class="text-primary small" ab-label="STD_RANGE" >Range:</span>
</label>
</td>
<td style="white-space:nowrap;text-align:right;">
	<input type="checkbox" class="ab-pointer" onclick="$('.[=FIELDNAME=]-RG').toggleClass('hidden');" />
	&nbsp;&nbsp;
	<span class="text-primary ab-border ab-spaceless ab-pointer" onclick="ABsearchRemoveObj('[=FIELDNAME=]')" >
	<span class="glyphicon glyphicon-trash"></span>
	</span>
	&nbsp;
</td>
</tr>
<tr class="[=FIELDNAME=]-RG hidden">
<td>&nbsp;</td>
<td style="white-space:nowrap;">
<span class="text-primary" ab-label="STD_FROM" >FROM:</span>&nbsp;
</td>
<td style="white-space:nowrap;">
<input type="text" ctype="[=COMPTYPE=]" size=20 onblur="ABsearchCheckRange('AB-[=FIELDNAME=]-FROM');" ab-model="AB-[=FIELDNAME=]-FROM" title="default settings" >
</td>
<td>&nbsp;</td>
</tr>
<tr class="[=FIELDNAME=]-RG hidden">
<td>&nbsp;</td>
<td>
<span class="text-primary" ab-label="STD_TO" >TO:</span>&nbsp;
</td>
<td>
<input type="text" ctype="[=COMPTYPE=]" size=20 onblur="ABsearchCheckRange('AB-[=FIELDNAME=]-TO');" ab-model="AB-[=FIELDNAME=]-TO"   title="default settings" >
</td>
<td>&nbsp;</td>
</tr>
<tr class="[=FIELDNAME=]-RG hidden">
<td>&nbsp;</td>
<td class="text-primary" colspan="2"  style="white-space:nowrap;">
[=FIELDHELP=]
</td>
<td>&nbsp;</td>
</tr>
</table>
</div>

EOC;



$this->ABrange["ENUM"] = <<<EOC
<div  id="[=FIELDNAME=]"  ABrange="ENUM" >
<table class="ab-border well " style="width:100%;">
<tr class="[=FIELDNAME=]-DIV">
<td>&nbsp;</td>
<td colspan="2"  style="white-space:nowrap;">
<label  class="">
<span class="text-primary " ab-label="[=FIELDNAME=]" >[=FIELDDESCR=]</span>
<span class="text-primary small" ab-label="STD_SELECT" >SELECT:</span>
</label>
</td>	
<td style="white-space:nowrap;text-align:right;">
	<input type="checkbox" class="ab-pointer" onclick="$('.[=FIELDNAME=]-RG').toggleClass('hidden');" />
	&nbsp;&nbsp;
	<span class="text-primary ab-border ab-spaceless ab-pointer" onclick="ABsearchRemoveObj('[=FIELDNAME=]')" >
	<span class="glyphicon glyphicon-trash"></span>
	</span>
	&nbsp;
</td>
</tr>
<tr>
<td colspan="100" class="[=FIELDNAME=]-RG hidden">
<div>
<table >
[=ABSELECT=]
<tr class="ab-pointer" onclick="ABSELECT_[=FIELDNAME=](this);" >
<td>&nbsp;</td>
<td class="text-right">
<span class="text-primary ab-border ab-spaceless" >
<span ab-enum-tog="0"  class="text-primary invisible" >
<span class="glyphicon glyphicon-ok"></span>
</span>
</span>
&nbsp;&nbsp;
</td>
<td class="text-left">
<input type="hidden" ctype="[=COMPTYPE=]" ab-model="AB-[=FIELDNAME=]" value="0" enumval="[=ENUMVAL=]" title="default settings" />
<span ab-label="[=ENUMLAB=]">[=ENUMVAL=]</span>
</td>
<td>&nbsp;</td>
</tr>
[=ABSELECT=]
</table>
</div>
</td>
</tr>
<tr class="[=FIELDNAME=]-RG hidden">
<td>&nbsp;</td>
<td class="text-primary" colspan="2"  style="white-space:nowrap;">
[=FIELDHELP=]
</td>
<td>&nbsp;</td>
</tr>
</table>
</div>

<script>
function ABSELECT_[=FIELDNAME=](ele)
{
	if ($(ele).find('[ab-model]').val()!='0')
	{
		$(ele).find('[ab-enum-tog]').addClass("invisible");
		$(ele).find('[ab-model]').val("0")
	}
	else
	{
		$(ele).find('[ab-enum-tog]').removeClass("invisible")
		$(ele).find('[ab-model]').val("1")
	}
	
}
</script>

EOC;

	}
		
	
}

?>