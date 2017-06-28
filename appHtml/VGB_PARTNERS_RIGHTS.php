<?php

echo "<div class='hidden' >";

session_start();ob_clean();
require_once "../stdSscript/stdSessionVarQuery.php" ;

// User access rights
$tFnc = new AB_querySession;
$dtaObj = array();
$dtaObj['PROCESS'] = "VGB_PARTNERS";
$dtaObj['SESSION'] = "VGB_CUSTCT";
$chkCust = array();
$chkCust['new'] = $tFnc->hasPriviledge($dtaObj,"vgb_cust","New");
$chkCust['Upd'] = $tFnc->hasPriviledge($dtaObj,"vgb_cust","Upd");
$chkCust['Del'] = $tFnc->hasPriviledge($dtaObj,"vgb_cust","Del");
$chkCust['all'] = $tFnc->hasPriviledge($dtaObj,"vgb_cust","**");
$dtaObj = array();
$dtaObj['PROCESS'] = "VGB_PARTNERS";
$dtaObj['SESSION'] = "VGB_SUPPCT";
$chkSupp = array();
$chkSupp['new'] = $tFnc->hasPriviledge($dtaObj,"vgb_supp","New");
$chkSupp['Upd'] = $tFnc->hasPriviledge($dtaObj,"vgb_supp","Upd");
$chkSupp['Del'] = $tFnc->hasPriviledge($dtaObj,"vgb_supp","Del");

$dtaObj = array();
$dtaObj['PROCESS'] = "VGB_PARTNERS";
$dtaObj['SESSION'] = "VGB_ADDRCT";
$chkAddr = array();
$chkAddr['new'] = $tFnc->hasPriviledge($dtaObj,"vgb_addr","New");
$chkAddr['Upd'] = $tFnc->hasPriviledge($dtaObj,"vgb_addr","Upd");
$chkAddr['Del'] = $tFnc->hasPriviledge($dtaObj,"vgb_addr","Del");


$hardCode =<<<EEO

<input ng-model="rightsCust.new" ng-init="rightsCust.new={$chkCust['new']}" />
<input ng-model="rightsCust.Upd" ng-init="rightsCust.Upd={$chkCust['Upd']}" />
<input ng-model="rightsCust.Del" ng-init="rightsCust.Del={$chkCust['Del']}" />
<input ng-model="rightsCust.hasRights" ng-init="rightsCust.hasRights = rightsCust.new+rightsCust.Upd+rightsCust.Del" />

<input ng-model="rightsSupp.new" ng-init="rightsSupp.new={$chkSupp['new']}" />
<input ng-model="rightsSupp.Upd" ng-init="rightsSupp.Upd={$chkSupp['Upd']}" />
<input ng-model="rightsSupp.Del" ng-init="rightsSupp.Del={$chkSupp['Del']}" />
<input ng-model="rightsSupp.hasRights" ng-init="rightsSupp.hasRights = rightsSupp.new+rightsSupp.Upd+rightsSupp.Del" />

<input ng-model="rightsAddr.new" ng-init="rightsAddr.new={$chkAddr['new']}" />
<input ng-model="rightsAddr.Upd" ng-init="rightsAddr.Upd={$chkAddr['Upd']}" />
<input ng-model="rightsAddr.Del" ng-init="rightsAddr.Del={$chkAddr['Del']}" />
<input ng-model="rightsAddr.hasRights" ng-init="rightsAddr.hasRights = rightsAddr.new+rightsAddr.Upd+rightsAddr.Del" />

</div>


EEO;

echo $hardCode;

echo "</div>";
	
?>