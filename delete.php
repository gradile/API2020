<?php
  //  header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once 'config/database.php';
    include_once 'class/records.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Record($db);
    
    $id = $_GET['case_number_id'];
    
    $item->case_number_id = $id;
    
    if($item->deleteCaseNumber()){
        echo json_encode("Record data deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }
?>