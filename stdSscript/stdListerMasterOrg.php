<?php


class ListerMaster extends dbMaster
	{	
		function getListBasedOnPrimaryGroup()
		{
			$query = $this->buildPrimaryRequest();
			
			$tFnc = new AB_querySession;
			$query = $tFnc->tblAccessCond(null, $query, true, "onaccess,onaccess.USR");
		    // echo($query);
			$tbls = new dbMaster($this->getTableName(),$this->tblInfo->schema);
		    $tbls->dbProcessTransactionPdo($trig);
		    $tbls->dbPdoPrep($query,$dta,$dtaType);		

    		$this->assignResultToThis($tbls);		
		}
		
		function choosePrimaryGroup($cond)
		{
		    $query = $this->buildChoosePrimaryGroupQuery($cond);
		    
		    $tFnc = new AB_querySession;
			$query = $tFnc->tblAccessCond(null, $query, true, "onaccess,onaccess.USR");
		    // echo($query);
			$tbls = new dbMaster($this->getTableName(),$this->tblInfo->schema);
		    $tbls->dbProcessTransactionPdo($trig);
		    $tbls->dbPdoPrep($query,$dta,$dtaType);		

    		$this->assignResultToThis($tbls);		
		}
		
		function chooseItemById($id)
		{
		    $query = $this->buildChooseItemByIdQuery($id);
			
			$tFnc = new AB_querySession;
			$query = $tFnc->tblAccessCond($this->E_POST, $query, true, "onaccess,onaccess.USR");
		    // echo($query);
			$tbls = new dbMaster($this->getTableName(),$this->tblInfo->schema);
		    $tbls->dbProcessTransactionPdo($trig);
		    $tbls->dbPdoPrep($query,$dta,$dtaType);		

    		$this->assignResultToThis($tbls);		
		}
		
		protected function buildChoosePrimaryGroupQuery($cond)
		{
		    $tableName = $this->getTableName();
			$mainColumnName = $this->getMainColumnName();
			$idColumnName = $this->idColumnName;
			
		    $query = <<<EOC
			SELECT
				${mainColumnName}
				,${idColumnName}
			FROM {$tableName}
			WHERE LEFT(UPPER({$mainColumnName}), 1) = '${cond}';
EOC;

			return $query;
		}
		
		protected function buildPrimaryRequest()
		{
			$tableName = $this->getTableName();
			$mainColumnName = $this->getMainColumnName();
			
			$query = <<<EOC
			SELECT
				LEFT(UPPER({$mainColumnName}), 1)
				,COUNT(*)
			FROM {$tableName}
			GROUP BY LEFT(UPPER({$mainColumnName}), 1);
EOC;

			return $query;
		}
		
		protected function getTableName()
		{
		    return $this->tableName;
		}
		
		protected function getMainColumnName()
		{
		    return $this->mainColumnName;
		}
		
		protected function assignResultToThis($resultObj)
		{
		    foreach($resultObj as $name => $value)
    			{
    			 $this->$name = $value;
    			}
		}
		
		protected function buildChooseItemByIdQuery($id)
		{
		   
		}
	}
	
class ItemLister extends ListerMaster
{
    function ItemLister($schema)
    {
    	$this->dbMaster("vin_item",$schema);
        $this->tableName = "vin_item";
        $this->mainColumnName = "VIN_ITEM_ITMID";
        $this->idColumnName = "idVIN_ITEM";
    }
    
    protected function buildChooseItemByIdQuery($id)
    {
        $tableName = $this->tableName;
        $idColumnName = $this->idColumnName;

        $query = <<<EOC
			SELECT
				*
			FROM ${tableName}
			WHERE ${idColumnName} = ${id};
EOC;

			return $query;
    }
}
	
//	$obj = new ItemLister(;
//	$obj->chooseItemById(1);
	
?>
