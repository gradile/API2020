<?php
  //  header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	include_once 'config/database.php';
    include_once 'class/categories.php';

	$database = new Database();
    $db = $database->getConnection();

    $items = new Category($db);

    $stmt = $items->getCategories();
    $itemCount = $stmt->rowCount();


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $recordsArr = array();
       
       // $recordsArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
				"category_id" => $category_id,
				"category_description" => $category_description,
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