<?php
   // header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	include_once 'config/database.php';
    include_once 'class/records.php';

	$database = new Database();
    $db = $database->getConnection();

    $items = new Record($db);

    $stmt = $items->getLastCaseFileNumber();
    $row = $stmt->fetch();
  if($row != null){
    echo json_encode($row);
   } else{
       http_response_code(404);
       echo json_encode(
           array("message" => "No record found.")
       );
   }
?>