<?php
session_start();ob_clean();

$inPost = json_decode(file_get_contents('php://input'), true);
$tbl = $inPost['tblList'];

require_once "../stdSscript/stdAppobjGen.php";

$occ = 0;
$tableSet = array();

while ($occ < count($tbl))
{
	if ($tbl[$occ]["tblLayout"]["orgLevelType"] == "Master")
	{
//		echo "\ntblName:" . $tbl[$occ]["tblName"];
//		echo "\ntblDesc:" . $tbl[$occ]["tblDesc"];
	
		$tblPrimary = "";
		$wocc = 0;
		while ($wocc < count($tbl[$occ]["tblLayout"]["tblPrimary"]["dta"]))
		{
			if ($tblPrimary == "")
			{
				$tblPrimary = $tbl[$occ]["tblLayout"]["tblPrimary"]["dta"][$wocc]["colName"];
			}
//			echo "\ntblPrimary " . ($wocc + 1) . "-" . $tbl[$occ]["tblLayout"]["tblPrimary"]["dta"][$wocc]["colName"];
			$wocc += 1;
		}
		
		$tblUnique = "";
		$wocc = 0;
		while ($wocc < count($tbl[$occ]["tblLayout"]["tblUnique"]["dta"]))
		{
			if ($tblUnique == "")
			{
				$tblUnique = $tbl[$occ]["tblLayout"]["tblUnique"]["dta"][$wocc]["fieldName"];
			}
//			echo "\ntblUnique " . $tbl[$occ]["tblLayout"]["tblUnique"]["dta"][$wocc]["seq"]  . "-" . $tbl[$occ]["tblLayout"]["tblUnique"]["dta"][$wocc]["keyName"] . "-" . $tbl[$occ]["tblLayout"]["tblUnique"]["dta"][$wocc]["fieldName"];
			$wocc += 1;
		}	
//		echo "\n";

		$tableSet[$tbl[$occ]["tblName"]] = buildSearch($tbl[$occ]["tblName"],$tblPrimary,$tblUnique);
	}

	$occ += 1;
}

ob_clean();
// echo $tableSet;
echo json_encode(array($tableSet));

function buildSearch($tblName,$tblPrimary,$tblUnique)
{
	
$ret = array();
$ret["tblName"] = $tblName;
$ret["tblPrimary"] = $tblPrimary;
$ret["tblUnique"] = $tblUnique;

$out = <<<EOC
<div ab-master-dflt="{$tblName}" class="{{ABsearchTbl=='ABsearch{$tblName}'?'':'hidden'}}" >
EOC;


$xtmp = new appForm("stdSearchDsp");
$sparm = array();
$sparm["searchLabel"] = $tblName;
$sparm["searchTable"] = $tblName;
$sparm["searchJoin"] = "";
$sparm["searchResult"] = "ABsearch".$tblName;
$sparm["searchFilter"] = "hid2den";
$sparm["filterExclude"] = "";
$sparm["filterAuto"] = "";
$out .= $xtmp->setSearchMaster($sparm) . "</div>";

$ret["tblSeach"] = $out;

return $ret;

$xout = <<<EOC

	<div class="ab-wrapper-div">
		<table class="text-primary ab-strong" style="width:100%;" >
			<tr class="">
				<td style="width:10%;" ></td>
				<td style="width:20%;" ><span ab-label="STD_ID_CODE">ID</span></td>
				<td style="width:30%;" ><span ab-label="STD_NAME">Bname</span></td>
				<td style="width:40%;" ></td>
			</tr>
		</table>
	</div>
	<div class="ab-wrapper-div">
		<table class="table-striped" style="width:100%;" >
			<tr class="ab-border ab-spaceless" ng-repeat="recS in tblName | AB_noDoubles:tblPrimary' | AB_Sorted:tblUnique " >
				<td style="width:10%;" class="text-primary ab-pointer" >
					<span ab-label="STD_SELECT"
					ng-click="ABsessionSetResponseLocal(recS)" >Select..</span>
				</td>
				<td style="width:20%;" >
					{{ recS.{$tblPrimary} }}
				</td>
				<td style="width:30%;" >
					{{ recS.{$tblUnique} }}
				</td>
				<td style="width:50%;" >
				</td>
			
			</tr>
		</table>

	</div>
	
</div>

EOC;
	
}


?>
