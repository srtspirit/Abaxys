<?php

function getProps($obj,$name,$lead)
{
	if ($obj == null)
	{
		return "nothing";
	}

	foreach($obj as $func => $result)
	{
		
		if (is_object($obj[$func]) || is_array($obj[$func]))
		{
			if(!$obj[$func][0])
			{
				$ret .= $lead . setJsObj($name) . setJsObj($func) ." = new Object();\n";
				$ret .= getProps($obj[$func], $func , $lead . setJsObj($name) );
			}
			else
			{
				$ret .= $lead .  setJsObj($name) . setJsObj($func) . " = new Array();\n";
				
				$occ = 0;
				while ($occ < count($obj[$func]))
				{
					$ret .= $lead . setJsObj($name) .setJsObj($func) . "[" . $occ . "] = new Object();\n";
					$ret .= getProps($obj[$func][$occ], $func . "[" . $occ . "]" ,$lead . setJsObj($name) );
					$occ += 1;
				}
			}
			
		}
		else
		{
			$ret .= $lead . setJsObj($name) . setJsObj($func) . ' = "' . $result . $xxx .'";' . "\n";
		}
	}

	return $ret;

}

function getObjVals($obj,$name,$lead)
{
	
	if ($obj == null)
	{
		return false;
	}
	
	$ret = array();

	foreach($obj as $func => $result)
	{
		if (is_object($result) || is_array($result))
		{
			if(!is_array($result))
			{
				$ret[$func] = getObjVals($result,"","");
			}
			else
			{
				$occ = 0;
				$ret[$func] = array();
				while ($occ < count($result))
				{
					
					$ret[$func][$occ] = getObjVals($result[$occ],"","" );
					$occ += 1;
				}
			}
			
		}
		else
		{
			$ret[$func] =  $result ;

		}
	}

	return $ret;

}



function setJsObj($txt)
{
	$ret = $txt;
	if ($txt != "")
	{
		$ret = "." . $ret;
	}
	
	return $ret;
}



?>