<?php
  //  header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	include_once 'config/database.php';
    include_once 'class/subCategories.php';

	$database = new Database();
    $db = $database->getConnection();

    $items = new Subcategory($db);

    $stmt = $items->getSubCategories();
    $itemCount = $stmt->rowCount();


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $recordsArr = array();
       
       // $recordsArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
				"subcategory_id" => $subcategory_id,
                "subcategory_name" => $subcategory_name,
                "parent_category" => $parent_category,
                "parent_category2" => $parent_category2
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