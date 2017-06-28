<?php
session_start();ob_clean();
header('Content-Type: application/json');


$inPost = json_decode(file_get_contents('php://input'), true);

if (!$inPost)
{
	$inPost["postMethod"] = "POST";	
	foreach($_POST as $name => $value)
	{

		 $inPost["POST_" . $name] = stripslashes($value);
	}
	foreach($_GET as $name => $value)
	{

		 $inPost["GET_" . $name] = stripslashes($value);
	}			
}
else
{
	$inPost["postMethod"] = "json";	
}


echo json_encode(array('posts' => $inPost));	
exit;


ob_end_clean();


?>