<?php
  // header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   header("Access-Control-Allow-Methods: GET");
   header("Access-Control-Max-Age: 3600");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-dataed-With");

   include_once 'config/database.php';
   include_once 'class/records.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Record($db);

    $item->case_number_id = isset($_GET['case_number_id']) ? $_GET['case_number_id'] : die();

    $item->getSingleCaseNumber();
    
    if($item->case_file_number != null){
    // create array
    $case_number_array = array(
      'case_number_id' => $item->case_number_id,
      'case_file_number' => $item->case_file_number,
      'case_first_name' => $item->case_first_name,
      'case_last_name' => $item->case_last_name,
      'case_subcategory' => $item->case_subcategory,
      'case_creation_date' => $item->case_creation_date,
      'case_closed_date' => $item->case_closed_date,
      'case_box' => $item->case_box,
      'case_author' => $item->case_author
    );

    http_response_code(200);
    echo json_encode($case_number_array);
   }
   else {
      http_response_code(404);
      echo json_encode("Case number not found.");
   }
		