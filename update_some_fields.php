<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// INCLUDING DATABASE AND MAKING OBJECT
include_once 'config/database.php';
include_once 'class/records.php';

$database = new Database();
$db = $database->getConnection();

$item = new Record($db);

$item->case_number_id = $data->case_number_id;


// $db_connection = new Database();
// $conn = $db_connection->dbConnection();

// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));

//CHECKING, IF ID AVAILABLE ON $data
if(isset($data->case_number_id)){
    
    $msg['message'] = '';
 //   $post_id = $data->case_number_id;
    
    //GET POST BY ID FROM DATABASE
    $get_post = "SELECT * FROM `case_number` WHERE `case_number_id` = '$post_id'";
    $get_stmt = $conn->prepare($get_post);
    // $get_stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    $get_stmt->execute();
    
    
    //CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
    if($get_stmt->rowCount() > 0){
        
        // FETCH POST FROM DATBASE 
        $row = $get_stmt->fetch(PDO::FETCH_ASSOC);
        
        // CHECK, IF NEW UPDATE REQUEST DATA IS AVAILABLE THEN SET IT OTHERWISE SET OLD DATA
        $post_case_file_number = isset($data->case_file_number) ? $data->case_file_number : $row['case_file_number'];
        $post_case_first_name = isset($data->case_first_name) ? $data->case_first_name : $row['case_first_name'];
        $post_case_last_name = isset($data->case_last_name) ? $data->case_last_name : $row['case_last_name'];
        $post_case_subcategory = isset($data->case_subcategory) ? $data->case_subcategory : $row['case_subcategory'];
        $post_case_creation_date = isset($data->case_creation_date) ? $data->case_creation_date : $row['case_creation_date'];
        $post_case_closed_date = isset($data->case_closed_date) ? $data->case_closed_date : $row['case_closed_date'];
        $post_case_box = isset($data->case_box) ? $data->case_box : $row['case_box'];
        $post_case_author = isset($data->case_author) ? $data->case_author : $row['case_author'];
        
        $update_query = "UPDATE `case_number` SET `case_file_number` = ':case_file_number', `case_first_name` = ':case_first_name', `case_last_name` = ':case_last_name', `case_subcategory` = ':case_subcategory', `case_creation_date` = ':case_creation_date', `case_closed_date` = ':case_closed_date', `case_box` = ':case_box', `case_author` = ':case_author' WHERE `case_number_id` = ':case_number_id'";
        
        $update_stmt = $conn->prepare($update_query);
        
        // DATA BINDING AND REMOVE SPECIAL CHARS AND REMOVE TAGS
        $update_stmt->bindValue(':case_file_number', htmlspecialchars(strip_tags($post_case_file_number)),PDO::PARAM_STR);
        $update_stmt->bindValue(':case_first_name', htmlspecialchars(strip_tags($post_case_first_name)),PDO::PARAM_STR);
        $update_stmt->bindValue(':case_last_name', htmlspecialchars(strip_tags($post_case_last_name)),PDO::PARAM_STR);
        $update_stmt->bindValue(':case_subcategory', htmlspecialchars(strip_tags($post_case_subcategory)),PDO::PARAM_STR);
        $update_stmt->bindValue(':case_creation_date', htmlspecialchars(strip_tags($post_case_creation_date)),PDO::PARAM_STR);
        $update_stmt->bindValue(':case_closed_date', htmlspecialchars(strip_tags($post_case_closed_date)),PDO::PARAM_STR);
        $update_stmt->bindValue(':case_box', htmlspecialchars(strip_tags($post_case_box)),PDO::PARAM_STR);
        $update_stmt->bindValue(':case_author', htmlspecialchars(strip_tags($post_case_author)),PDO::PARAM_STR);
        $update_stmt->bindValue(':case_number_id', $post_id,PDO::PARAM_INT);
        //$update_stmt->bindValue(':id', $post_id,PDO::PARAM_INT);
        
        
        if($update_stmt->execute()){
            $msg['message'] = 'Data updated successfully';
        }else{
            $msg['message'] = 'data not updated';
        }   
        
    }
    else{
        $msg['message'] = 'Invlid ID';
    }  
    
    echo  json_encode($msg);
    
}
?>
        