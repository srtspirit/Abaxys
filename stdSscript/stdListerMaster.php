<?php


abstract class ListerMaster extends dbMaster
	{	
	    function __construct($schema)
	    {
	    	$this->schema = $schema;
	        $this->count = "count"; //string constant
			$this->id = "id"; //string constant
			$this->maxLength = 5; //int constant
			$this->name = "name"; //string constant
			
			$this->rootGroups = array("alphabet"); //root groups available for all masters
	    }
	    

		protected function assignResultToThis($resultObj)
		{
			if($resultObj->result == null)
			{
				$objToParse = $resultObj;
			}
			else
			{
				$objToParse = $resultObj->result;
			}
		    foreach($objToParse as $name => $value)
    			{
    			 $this->result[$name] = $value;
    			}
		}
		
		//Returns object with with list based on a group
		//accepts name of a rootGroup and name of a group as paramaters. Must be on of the values returned by getRootGroups and getListBasedOnRoot group functions respectevely
		//the result is a table showing all possible elements or subgroups and quantity of elements in each subgroup
		function getListBasedOnGroup($rootGroup, $group)
		{
			$this->paramQueryFromWhere = $this->buildGroupQueryFromWhere($rootGroup, $group);
			$queryCount = "select ". " count(*) as " . $this->count . " " . $this->paramQueryFromWhere;
			
			//get the quantity of elements in this group to check if we it's less than limit for showing them all in a screen
			$tbls = new dbMaster($this->dataSource,$this->schema);
			$tbls->dbProcessTransactionPdo($queryCount);
			//$tbls->dbPdoPrep($query,$dta,$dtaType);
			//echo($query);
			
			//if less than limit return the result
			if ($tbls->result[0]["count"] <= $this->maxLength)
			{
				$query = $this->buildSelectIdQuery() . $this->paramQueryFromWhere;
				$tbls = new dbMaster($this->dataSource,$this->schema);
				$tbls->dbProcessTransactionPdo($query);
				
				$this->assignResultToThis($tbls);
				return ;
			}
			else //otherwise splitting up is needed
			{
				$this->splitGroupRecours($this->paramQueryFromWhere);
				$this->assignResultToThis($this->result);
			}
		}
		
		protected function buildSelectIdQuery()
		{
			$query = <<<EOC
			SELECT 
				{$this->idColumnName} as {$this->id}
				,{$this->mainColumnName} as {$this->name} 
EOC;
			return $query;
		}
		
		//Returns object with with list based on a group and additional condition
		//accepts name of a rootGroup and name of a group and alphabetic condition as paramaters. Must be on of the values returned by getRootGroups and getListBasedOnRoot group functions respectevely
		//the result is a table showing all possible elements
		//doesn't split groups it's understimated that $condition is the result of previous invokation of getListBasedOnGroup where all the splitting has been performed
		function getListBasedOnGroupAndCondition($rootGroup, $group, $condition)
		{
			$query = $this->buildSelectIdQuery() . $this->buildGroupQueryFromWhere($rootGroup, $group) . " AND " . $this->mainColumnName . " LIKE '" . $condition . "%'";
			
			$tbls = new dbMaster($this->dataSource,$this->schema);
			$tbls->dbProcessTransactionPdo($query);
				
			$this->assignResultToThis($tbls);
		}
		
		//this function splits a particular group into subgroups based on alphabet. Works recusevly
		//Parameters: part of query (from and where),
		//$letterCount quantity of first letters used for grouping (initial call is always with one letter. But deeper recursive calls (if one letter is not enough) will be with two and so on)
		//$previousValue - alphabet group that was used on prevous iteration. null for the first iteration
		protected function splitGroupRecours($paramQueryFromWherequery, $letterCount = 1, $previousValue = null)
		{
			$groupingColumn = $this->buildAlphbeticCondition($this->mainColumnName, $letterCount);
			
			if ($previousValue == null)
			{
				$condBasedOnPreviousGroupingColumn = "";
				$this->result = array();
			}
			else
			{
				$condBasedOnPreviousGroupingColumn = " and " . $this->buildAlphbeticCondition($this->mainColumnName, $letterCount - 1) . " = '" . $previousValue . "'";
			}
			
			$query = <<<EOC
						SELECT 
							{$groupingColumn} AS name
							, count({$groupingColumn}) AS {$this->count} 
						{$paramQueryFromWherequery}
						{$condBasedOnPreviousGroupingColumn}
						GROUP BY {$groupingColumn}
EOC;
					
			$tbls = new dbMaster($this->dataSource,$this->schema);
			$tbls->dbProcessTransactionPdo($query);
			//$tbls->dbPdoPrep($query,$dta,$dtaType);
			
			$this->table = $tbls; //debug
			
			// for each group that we got check if it is less then limit
			foreach($tbls->result as $value)
			{
				$this->value = $value; //debug
				if ($value["count"] <= $this->maxLength) // if less than limit add it to result
				{
					array_push($this->result, $value);
				}
				else //otherwise invoke a deeper splitting
				{
					$this->splitGroupRecours($paramQueryFromWherequery, $letterCount + 1, $value["name"]);
				}
			}

		}
		
		//builds alphabetic condition
		//includes $letterCount first letters of $columnName
		protected function buildAlphbeticCondition($columnName, $letterCount)
		{
			return "LEFT(UPPER(" . $columnName . "), " . $letterCount . ")";
		}
		
		//Returns object with with list based on rootGroup
		//accepts name of the rootGroup as a paramater must be on of the values returned by getRootGroups function
		//the result is a table showing all possible groups and quantity if elements in each group
		function getListBasedOnRootGroup($rootGroup)
	    {
	        $query = $this->buildQueryBasedOnRootGroup($rootGroup);
	        
	        $tbls = new dbMaster($this->dataSource,$this->schema);
	        $tbls->dbProcessTransactionPdo($query);
	        
	        $this->assignResultToThis($tbls);
	    }
	    
		//This function is used to get all possible categories of master table
	    function getRootGroups()
		{
			$this->assignResultToThis($this->rootGroups);
		}
		
		//This function builds and return as string the database query
		//that is used for getting list based on root group from database
		protected function buildQueryBasedOnRootGroup($rootGroup)
		{
			$this->searchColumnName = $this->rootGroupMapper[$rootGroup];
            $query = <<<EOC
                SELECT {$this->searchColumnName} as {$this->searchColumnName}
                        ,COUNT(*) as {$this->count}
                FROM {$this->dataSource}
                GROUP BY {$this->searchColumnName}
EOC;
			
			//TODO: what are we passing as the first param?
			//$tFnc = new AB_querySession;
			//$query = $tFnc->tblAccessCond(???,$query,true,"onaccess,onaccess.USR");
			return $query;
		}
		
		//This function builds the part of query decalring only from and where clasues that is used to get list based on rootGroup and group
		//select clasues must be attched later
		//This is done in that way because sometimes it's used for getting list of groups and quantities, sometimes for getting elements
		protected function buildGroupQueryFromWhere($rootGroup, $group)
		{
			$this->searchColumnName = $this->rootGroupMapper[$rootGroup];
            $query = <<<EOC
                
                FROM {$this->dataSource} 
                WHERE {$this->searchColumnName} = {$group}
EOC;

			//condition: [=COND:$this->dataSource=]
			//TODO: what are we passing as the first param?
			//$tFnc = new AB_querySession;
			//$query = $tFnc->tblAccessCond(???,$query,true,"onaccess,onaccess.USR");
			return $query;
		}
		
		static function createListerInstance($schema, $inPost)
		{
			if ($inPost['tableName'] == 'vinItem')
			{
				return new ItemLister($schema);
			}	
			
		}
		
	}


// Bgn hard code
class ItemLister extends ListerMaster
{
    function __construct($schema)
    {
    	parent::__construct($schema);
        $this->dataSource = "vin_item";
        $this->mainColumnName = "VIN_ITEM_ITMID";
        $this->idColumnName = "idVIN_ITEM";
        
        array_push($this->rootGroups, "ItemCategory", "ItemSupplyer");
		
		$this->rootGroupMapper = array();
		$this->rootGroupMapper["ItemCategory"] = "VIN_ITEM_SEAR1";
    }
}
// end hard code	
?>