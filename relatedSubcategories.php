<?php
  // header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   header("Access-Control-Allow-Methods: GET");
   header("Access-Control-Max-Age: 3600");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-dataed-With");

   include_once 'config/database.php';
   include_once 'class/subCategories.php';

   include_once 'config/database.php';
    include_once 'class/records.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Subcategory($db);

    $items->id = isset($_GET['id']) ? $_GET['id'] : die();

    $stmt = $items->getRelatedSubCategories();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $recordsArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
				"subcategory_id" => $subcategory_id,
				"subcategory_name" => $subcategory_name,
				"parent_category" => $parent_category,
				"parent_category2" => $parent_category2,
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

		