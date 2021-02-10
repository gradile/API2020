<?php
  //  header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-dataed-With");
	
	include_once 'config/database.php';
    include_once 'class/records.php';

	$database = new Database();
    $db = $database->getConnection();

    $items = new Record($db);

    $stmt = $items->getCaseNumbers();
    $itemCount = $stmt->rowCount();


    // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $recordsArr = array();
      //  $recordsArr["body"] = array();
       // $recordsArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
				"case_number_id" => $case_number_id,
				"case_file_number" => $case_file_number,
				"case_first_name" => $case_first_name,
				"case_last_name" => $case_last_name,
				"case_subcategory" => $case_subcategory,
				"case_creation_date" => $case_creation_date,
				"case_closed_date" => $case_closed_date,
				"case_box" => $case_box,
				"case_author" => $case_author,
            );

            array_push($recordsArr, $e);
        }
        echo json_encode($recordsArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>