<?php
require_once('DbConfig.php');

class DB{
	
	protected $ConLink;
	protected $_select;
	protected $_where;
	protected $_groupby;
	protected $_joins;
	protected $_sortby;
	protected $_limit;
	protected $_insert_fields;
	protected $_insert_values;
	protected $_update_clause;
	protected $_mysql_functions = array('NOW()');
	protected $_last_query;

	
	function __construct()
	{
		
		$this->makeConnection($var=3);
		$this->initialize();
	}
	
	private function makeConnection($var)
	{
		global $Org_Config, $Client_Config, $Session_Config;
		if($var==1) {
			$this->ConLink = mysqli_connect($Org_Config['DBHostName'],$Org_Config['DBUserName'],$Org_Config['DBPassword'],$Org_Config['DBName']) or die( mysqli_error());
		return $this->ConLink;
		} elseif($var==2) {
			$this->ConLink = mysqli_connect($Session_Config['DBHostName'],$Session_Config['DBUserName'],$Session_Config['DBPassword'],$Session_Config['DBName']) or die( mysqli_error());
		   return $this->ConLink;
		} else {
			$this->ConLink = mysqli_connect($Client_Config['DBHostName'],$Client_Config['DBUserName'],$Client_Config['DBPassword'],$Client_Config['DBName']) or die( mysqli_error());
		   return $this->ConLink;
		}
	}
	
	private function initialize(){
		$this->_joins = '';
		$this->_limit = '';
		$this->_select = '*';
		$this->_sortby = '';
		$this->_where = '';
		$this->_where_in = '';
		$this->_insert_fields = '';
		$this->_insert_values = '';
		$this->_update_clause = '';
		$this->_groupby = '';
	}
	
	/*
	 Func Name : select
	 Input     : Array or String
	 Output    : Void
	 Example1  : $this->db->select('id, name, phone');
	 Example2  : $this->db->select(array('id','name','phone')); 
	*/
	function select($select_fields = '*'){
		if($select_fields == ''){
			$this->_select = '*';
		}elseif(is_array($select_fields)){
			$this->_select = implode(", ",$select_fields);
		}else{
			$this->_select = $select_fields;
		}
	}
	
	/*
	 Func Name : get
	 Input     : String
	 Output    : Array - array('num_rows' => integer, 'row' => result_set_array)
	 Example   : $this->db->get("table_name");
	*/
	function get($table,$dbval){
		$query = $this->build_query($table, "select");
		$result = $this->execute_query($query,$dbval);
		$num_rows = 0;
		$ResultSet = array();
		if($result){
			$num_rows = mysqli_num_rows($result);
			while($ResultSet1 = mysqli_fetch_assoc($result)){
				$ResultSet[] = $ResultSet1;
			}
		}
		$output = array('num_rows' => $num_rows, 'row' => $ResultSet);
		mysqli_free_result($result);
		$this->initialize();
		return $output;
	}
	
	/*
	 Func Name : joins
	 Input     : Array or String
	 Output    : Void
	 Example1  : $this->db->joins("JOIN join_table_name ON(join condition)");
	 Example2  : $this->db->joins(array('join_table_name' => array('join condition','join type')));
	             In this join type is optional
	*/
	function joins($joins){
		if(is_array($joins) && count($joins) > 0){
			foreach($joins as $joinkey => $joinvalue){
				if(count($joinvalue)==1){
					$this->_joins .= " JOIN ".$joinkey." ON (".$joinvalue[0].")";
				}else{
					$this->_joins .= " ".$joinvalue[1]." ".$joinkey." ON (".$joinvalue[0].")";
				}
			}
		}elseif($joins != ''){
			$this->_joins .= " ".$joins;
		}
	}
	
	/*
	 Func Name : where
	 Input1    : Array
	 Input2    : Booleen
	 Output    : Void
	 Example   : $this->db->where(array('id'=>3));
	*/
	function where($where_array = array(), $enclose_with_brackets = FALSE){
		if(is_array($where_array) && count($where_array) > 0){
			$this->_where_to_clause($where_array, 'AND', 'AND', $enclose_with_brackets);
		}
	}
	
	/*
	 Func Name : or_where
	 Input1    : Array
	 Input2    : Booleen
	 Output    : Void
	 Example   : $this->db->where(array('id'=>3));
	*/
	function or_where($where_array = array(), $enclose_with_brackets = FALSE){
		if(is_array($where_array) && count($where_array) > 0){
			$this->_where_to_clause($where_array, 'AND', 'OR', $enclose_with_brackets);
		}
	}
	/*
	 Func Name : where_or
	 Input1    : Array
	 Input2    : Booleen
	 Output    : Void
	 Example   : $this->db->where(array('id'=>3));
	*/
	function where_or($where_array = array(), $enclose_with_brackets = FALSE){
		if(is_array($where_array) && count($where_array) > 0){
			$this->_where_to_clause($where_array, 'OR', 'AND', $enclose_with_brackets);
		}
	}
	/*
	 Func Name : or_where_or
	 Input1    : Array
	 Input2    : Booleen
	 Output    : Void
	 Example   : $this->db->where(array('id'=>3));
	*/
	function or_where_or($where_array = array(), $enclose_with_brackets = FALSE){
		if(is_array($where_array) && count($where_array) > 0){
			$this->_where_to_clause($where_array, 'OR', 'OR', $enclose_with_brackets);
		}
	}
	
	/*
	 Func Name : where_not_in
	 Input1    : Array
	 Input2    : Booleen
	 Output    : Void
	 Example   : $this->db->where(array('id'=>3));
	*/
	function where_not_in($field, $search_in_array = array(), $enclose_with_brackets = FALSE){
		if(is_array($search_in_array) && count($search_in_array) > 0){
			$this->_where_in($field, $search_in_array, 'NOT IN', 'AND', $enclose_with_brackets);
		}
	}
	/*
	 Func Name : or_where_not_in
	 Input1    : Array
	 Input2    : Booleen
	 Output    : Void
	 Example   : $this->db->where(array('id'=>3));
	*/
	function or_where_not_in($field, $search_in_array = array(), $enclose_with_brackets = FALSE){
		if(is_array($search_in_array) && count($search_in_array) > 0){
			$this->_where_in($field, $search_in_array, 'NOT IN', 'OR', $enclose_with_brackets);
		}
	}
	/*
	 Func Name : where_in
	 Input1    : Array
	 Input2    : Booleen
	 Output    : Void
	 Example   : $this->db->where(array('id'=>3));
	*/
	function where_in($field, $search_in_array = array(), $enclose_with_brackets = FALSE){
		if(is_array($search_in_array) && count($search_in_array) > 0){
			$this->_where_in($field, $search_in_array, 'IN', 'AND', $enclose_with_brackets);
		}
	}
	/*
	 Func Name : _where_to_clause
	 Input     : Array
	 Output    : Void
	 Example   : $this->db->where(array('id' => 3));
	*/
	protected function _where_in($field, $search_in_array, $operator = 'IN', $concater = 'AND', $enclose_with_brackets = FALSE){
		$temp = array();
		foreach($search_in_array as $value){
			$value = $this->trim_input($value);
			$value = $this->escape_input($value);
		    $value = $this->sanitize_query($value);
			$temp[] = "'".$value."'";
		}
		if($enclose_with_brackets){
			if($this->_where == ''){
				$this->_where = "(".$field." ".$operator." (".implode(", ",$temp)."))";
			}else{
				$this->_where .= " ".$concater." (".$field." ".$operator." (".implode(", ",$temp)."))";
			}
		}else{
			if($this->_where == ''){
				$this->_where = $field." ".$operator." (".implode(", ",$temp).")";
			}else{
				$this->_where .= " ".$concater." ".$field." ".$operator." (".implode(", ",$temp).")";
			}
		}
	}
	/*
	 Func Name : _where_to_clause
	 Input     : Array
	 Output    : Void
	 Example   : $this->db->where(array('id' => 3));
	*/
	protected function _where_to_clause($where_array, $conjunction = 'AND', $concater = 'AND', $enclose_with_brackets = FALSE){
		$temp = array();
		foreach($where_array as $field => $value){
			
			
			if($this->_has_operator($field)){
					if($value != ''){
					    $temp[] = $field." '".$value."'";
					}else{
						if($this->_null_operator($field)){
							$temp[] = $field;
						}else{
							$temp[] = $field." '".$value."'";
						}
					}
			}else{
				$temp[] = $field." = '".$value."'";
			}
		}
		if($enclose_with_brackets){
			if($this->_where == ''){
				$this->_where = " (".implode(" ".$conjunction." ",$temp).")";
			}else{
				$this->_where .= " ".$concater." (".implode(" ".$conjunction." ",$temp).")";
			}
		}else{
			if($this->_where == ''){
				$this->_where = " ".implode(" ".$conjunction." ",$temp);
			}else{
				$this->_where .= " ".$concater." ".implode(" ".$conjunction." ",$temp);
			}
		}
	}
	
	/*
	 Func Name : num_rows
	 Like $this->db->get() except it returns the number of rows
	*/
	function num_rows($table){
		$query = $this->build_query($table, "select");		
		$result = $this->execute_query($query);
		$num_rows = 0;
		if($result){
			$num_rows = mysql_num_rows($result);
		}
		$this->initialize();
		mysql_free_result($result);
		return $num_rows;
	}
	
	/*
	 Func Name : limit
	 Input1    : Integer (MANDATORY)
	 Input2    : Integer (MANDATORY)
	 Output    : Void
	 Example   : $this->db->limit(0, 2);
	*/
	function limit($offset, $results_per_page){
		$this->_limit = " LIMIT ".$offset.", ".$results_per_page;
	}
	
	function last_query(){
		return $this->_last_query;
	}
	
	protected function _has_operator($string){
		$str = trim($string);
		if ( ! preg_match("/(\s|<|>|!|=|is null|is not null|like|not like)/i", $str))
		{
			return FALSE;
		}
		return TRUE;
	}
	
	protected function build_query($table, $query_type){
		if($table == ''){
			show_php_error("No table selected", "A DB error encountered");
		}else{
			$query = '';
			
			switch($query_type){
				case "select" :
				$query = "SELECT ".$this->_select." FROM ".$table;
				if($this->_joins != ''){
					$query .= $this->_joins;
				}
				if($this->_where != ''){
					$query .= " WHERE ".$this->_where;
				}
				if($this->_groupby != ''){
					$query .= " GROUP BY ".$this->_groupby;
				}
				if($this->_sortby != ''){
					$query .= " ORDER BY ".$this->_sortby;
				}
				if($this->_limit != ''){
					$query .= $this->_limit;
				}
				break;
				
				case "insert" :
				$query = "INSERT INTO ".$table." (".$this->_insert_fields.") VALUES (".$this->_insert_values.")";
				break;
				
				case "update":
				$query = "UPDATE ".$table." SET ".$this->_update_clause;
				if($this->_where != ''){
					$query .= " WHERE ".$this->_where;
				}
				break;
				
				case "delete" :
				$query = "DELETE FROM ".$table;
				if($this->_where != ''){
					$query .= " WHERE ".$this->_where;
				}
			}
		}
		return $query;
	}
	
	function put_where($where_text, $clear_existing_clause = TRUE){
		if($clear_existing_clause){
			$this->_where = $where_text;
		}else{
			$this->_where = ' AND '.$where_text;
		}
	}
	function get_where($clear_existing_clause = TRUE){
		$where_clause = '';
		if($this->_where != ''){
			$where_clause = $this->_where;
			if($clear_existing_clause){
				$this->_where = '';
			}			
		}
		return $where_clause;
	}
	
	
	function get_field($field, $table, $where=''){
		$this->select($field);
		if($where != ''){
			 if(is_string($where)){
				 $this->put_where($where);
			 }elseif(is_array($where) && count($where) > 0){
				 $this->where($where);
			 }
		}
		$r = $this->get($table);
		if($r['num_rows'] > 0){
			$row = $r['row'];
			return $row[0][$field];
		}
		
		return FALSE;
	}
	
	/*
	 Func Name : insert
	 Input1    : Valide table_name as String
	 Input2    : Array
	 Output    : If Insert is done then mysql_insert_id() (Note : applicable only for a table with auto-increment primary key field)
	             else FALSE
	 Example   : $this->db->insert('table_name', array('field_name' => 'values'...));
	*/
	function insert($table, $insert_array,$dbval=''){
		
		$fields_array = array();
		$values_array = array();
		
		if(is_array($insert_array) && count($insert_array) > 0){
			foreach($insert_array as $fields => $values){
				$fields_array[] = $fields;
                $values = $this->trim_input($values);
				if($this->_has_mysql_operators($values)){
					$values_array[] = $values;
				}elseif(in_array(strtoupper($values), $this->_mysql_functions)){					
					$values_array[] = strtoupper($values);
				}else{					
					$values = $this->escape_input($values);
					$values_array[] = "'".$values."'";
				}
			}
			$this->_insert_fields = implode(", ",$fields_array);
			$this->_insert_values = implode(", ",$values_array);
		}else{
			echo "No insert values specified, A DB error encountered";
		}
		
		$query = $this->build_query($table, "insert");
		$result = $this->execute_query($query,$dbval);
		$this->initialize();
		if($result){
			$output = mysqli_insert_id($this->ConLink);
			return $output;
		}else{
			return FALSE;
		}
	}
	
	/*
	 Func Name : update
	 Input1    : Valide table_name as String
	 Input2    : Array
	 Output    : If Update is done then mysql_affected_rows()
	             else FALSE
	 Example   : $this->db->update('table_name', array('field_name' => 'values'...));
	 Extras    : for condition use this->db->where()
	*/
	function update($table, $update_array,$dbval=''){
		
		if(is_array($update_array) && count($update_array) > 0){
			$temp_clause = array();
			foreach($update_array as $fields => $values){
				$values = $this->trim_input($values);
				$values = $this->escape_input($values);
				if(in_array(strtoupper($values), $this->_mysql_functions)){
					$values = strtoupper($values);
				}else{
					$values = "'".$values."'";
				}
				$temp_clause[] = "$fields = $values";
			}
			$this->_update_clause = implode(", ",$temp_clause);
		}else{
			echo "No insert values specified, A DB error encountered";
		}
		
		$query = $this->build_query($table, "update");
		$result = $this->execute_query($query,$dbval);
		$this->initialize();
		if($result){
			$output = mysqli_affected_rows($this->ConLink);
			return $output;
		}else{
			return FALSE;
		} 
	}
	
	/*
	 Func Name : update
	 Input     : Valide table_name as String
	 Output    : If Delete is done then TRUE else FALSE
	 Example   : $this->db->delete('table_name');
	 Extras    : for condition use this->db->where()
	*/
	function delete($table){
		$query = $this->build_query($table, "delete");
		$result = $this->execute_query($query,$dbval='');
		$this->initialize();
		 if($result){
			return TRUE;
		}else{
			 return FALSE;
		}
	}
	function group_by($group_by){
		if(is_string($group_by)){
			if($this->not_null($group_by)){
				if($this->_groupby == ''){
					$this->_groupby = $group_by;
				}else{
					$this->_groupby .= ", ".$group_by;
				}
			}
		}elseif(is_array($group_by) && count($group_by) > 0){
			if($this->_groupby == ''){
				$this->_groupby = implode(", ",$group_by);
			}else{
				$this->_groupby .= ", ".implode(", ",$group_by);
			}
		}
	}
	
	function not_null($str){
		if ( ! is_array($str))
		{
			return (trim($str) == '') ? FALSE : TRUE;
		}
		else
		{
			return ( ! empty($str));
		}
	}
	/*
	 Func Name : order_by
	 Input     : Array or String
	 Output    : Void
	 Example1  : $this->db->sortby("field_name ASC");
	 Example2  : $this->db->joins(array('field_name' => ASC));
	*/
	function order_by($sort_clause){
		if(is_array($sort_clause) && count($sort_clause) > 0){
			$temp = array();
			foreach($sort_clause as $sk => $sv){
				$temp[] = $sk." ".$sv;
			}
			if($this->_sortby == ''){
				$this->_sortby = " ".implode(", ",$temp);
			}else{
				$this->_sortby .= ", ".implode(", ",$temp);
			}
		}elseif($sort_clause != ''){
			if($this->_sortby == ''){
				$this->_sortby = " ".$sort_clause;
			}else{
				$this->_sortby .= ", ".$sort_clause;
			}
		}
	}
	
	function sanitize_query($string){
		$badWords = array("/delete/", "/update/","/union/","/insert/","/drop/", "/where/", "/DELETE/", "/UPDATE/","/UNION/","/INSERT/","/DROP/", "/WHERE/", "/http/", "/--/", "/#/");
		$string = preg_replace($badWords, "", $string);
		return $string;
	}
	
	protected function _has_mysql_operators($string){
		$str = trim($string);
		if ( ! preg_match("/^(now|addtime|curdate|timediff|adddate|date_add)[\(]([a-z0-9,_\(\)\-\"\'\s]*)[\)]$/i", $str))
		{
			return FALSE;
		}
		return TRUE;
	}
	
	function query_execute($query,$dbval){
		 
		$result = $this->execute_query($query,$dbval);
		$num_rows = 0;
		$ResultSet = array();
		if($result){
			$num_rows = mysqli_num_rows($result);
			while($ResultSet1 = mysqli_fetch_assoc($result)){
				$ResultSet[] = $ResultSet1;
			}
		}
		$output = array('num_rows' => $num_rows, 'row' => $ResultSet);
		mysqli_free_result($result);
		return $output;
	}

	
	function update_connection($dbval){
			if(!$this->ConLink){
				mysqli_close($this->ConLink);
			}
			$this->makeConnection($dbval);
	}
	
	
	
	function execute_query($query,$dbval){
		//print_r($query);
		$this->update_connection($dbval);
		if($query == ''){
			echo "No Query given A DB error encountered";
		}
		
		$result = mysqli_query($this->ConLink,$query) or die(mysqli_error());
		$this->closeConnection();
		if($result){
			$this->_last_query = $query;
			return $result;
		}
	}
	
	function trim_input($string){
		$string=trim($string);
		return $string;
	}
	
	function escape_input($string){
		$this->update_connection($dbval);
		if(get_magic_quotes_gpc()) { // prevents duplicate backslashes
			$string = stripslashes($string);
		}if (phpversion() >= '4.3.0'){
			$string = mysqli_real_escape_string($this->ConLink,$string);
		}else{		
			$string = mysql_escape_string($this->ConLink,$string);
		}
		return $string;
	}
	
	function closeConnection(){
		if(!$this->ConLink){
				mysqli_close($this->ConLink);
		}
	}
	
}
