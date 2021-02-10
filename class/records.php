<?php
    class Record{

        // Connection
        private $conn;

        // Table
        private $db_table = "case_number";

        // Columns
        public $case_number_id;
        public $case_file_number;
        public $case_first_name;
        public $case_last_name;
        public $case_subcategory;
        public $case_creation_date;
        public $case_closed_date;
        public $case_box;
        public $case_author;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getCaseNumbers(){
            $sqlQuery = "SELECT case_number_id, case_file_number, case_first_name, case_last_name, case_subcategory, case_creation_date, case_closed_date, case_box, case_author FROM " . $this->db_table . " ORDER BY case_number_id DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // GET LAST case_file_number
        public function getLastCaseFileNumber() {
            $sqlQuery = "SELECT case_file_number FROM " . $this->db_table . " ORDER BY case_number_id DESC limit 1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createCaseNumber(){
            $sqlQuery = "INSERT INTO
                         " . $this->db_table . "
                        SET
                        case_number_id=:case_number_id, 
                        case_file_number=:case_file_number, 
                        case_first_name=:case_first_name, 
                        case_last_name=:case_last_name, 
                        case_subcategory=:case_subcategory, 
                        case_creation_date=:case_creation_date, 
                        case_closed_date=:case_closed_date, 
                        case_box=:case_box, 
                        case_author=:case_author";
                       
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->case_number_id=htmlspecialchars(strip_tags($this->case_number_id));
            $this->case_file_number=htmlspecialchars(strip_tags($this->case_file_number));
            $this->case_first_name=htmlspecialchars(strip_tags($this->case_first_name));
            $this->case_last_name=htmlspecialchars(strip_tags($this->case_last_name));
            $this->case_subcategory=htmlspecialchars(strip_tags($this->case_subcategory));
            $this->case_creation_date=htmlspecialchars(strip_tags($this->case_creation_date));
            $this->case_closed_date=htmlspecialchars(strip_tags($this->case_closed_date));
            $this->case_box=htmlspecialchars(strip_tags($this->case_box));
            $this->case_author=htmlspecialchars(strip_tags($this->case_author));
            
            // bind data
            $stmt->bindParam(":case_number_id", $this->case_number_id);
            $stmt->bindParam(":case_file_number", $this->case_file_number);
            $stmt->bindParam(":case_first_name", $this->case_first_name);
            $stmt->bindParam(":case_last_name", $this->case_last_name);
            $stmt->bindParam(":case_subcategory", $this->case_subcategory);
            $stmt->bindParam(":case_creation_date", $this->case_creation_date);
            $stmt->bindParam(":case_closed_date", $this->case_closed_date);
            $stmt->bindParam(":case_box", $this->case_box);
            $stmt->bindParam(":case_author", $this->case_author);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
         public function getSingleCaseNumber(){
            $sqlQuery = "SELECT case_number_id, case_file_number, case_first_name, case_last_name, case_subcategory, case_creation_date, case_closed_date, case_box, case_author FROM " . $this->db_table . " WHERE  case_number_id=:case_number_id LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);

          //  $this->case_number_id=htmlspecialchars(strip_tags($this->case_number_id));
            $stmt->bindParam(":case_number_id", $this->case_number_id);
            $stmt->execute();
           
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->case_file_number = $dataRow['case_file_number'];
            $this->case_first_name = $dataRow['case_first_name'];
            $this->case_last_name = $dataRow['case_last_name'];
            $this->case_subcategory = $dataRow['case_subcategory'];
            $this->case_creation_date = $dataRow['case_creation_date'];
            $this->case_closed_date = $dataRow['case_closed_date'];
            $this->case_box = $dataRow['case_box'];
            $this->case_author = $dataRow['case_author'];

            // if($stmt->execute()){
            //     return true;
            //  }
            //  return false;
        }      

        // UPDATE
        public function updateCaseNumber(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        case_file_number=:case_file_number, 
                        case_first_name=:case_first_name, 
                        case_last_name=:case_last_name, 
                        case_subcategory=:case_subcategory, 
                        case_creation_date=:case_creation_date, 
                        case_closed_date=:case_closed_date, 
                        case_box=:case_box, 
                        case_author=:case_author
                    WHERE 
                        case_number_id=:case_number_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
             // sanitize
             $this->case_file_number=htmlspecialchars(strip_tags($this->case_file_number));
             $this->case_first_name=htmlspecialchars(strip_tags($this->case_first_name));
             $this->case_last_name=htmlspecialchars(strip_tags($this->case_last_name));
             $this->case_subcategory=htmlspecialchars(strip_tags($this->case_subcategory));
             $this->case_creation_date=htmlspecialchars(strip_tags($this->case_creation_date));
             $this->case_closed_date=htmlspecialchars(strip_tags($this->case_closed_date));
             $this->case_box=htmlspecialchars(strip_tags($this->case_box));
             $this->case_author=htmlspecialchars(strip_tags($this->case_author));
             $this->case_number_id=htmlspecialchars(strip_tags($this->case_number_id));
             
             // bind data
             $stmt->bindParam(":case_file_number", $this->case_file_number);
             $stmt->bindParam(":case_first_name", $this->case_first_name);
             $stmt->bindParam(":case_last_name", $this->case_last_name);
             $stmt->bindParam(":case_subcategory", $this->case_subcategory);
             $stmt->bindParam(":case_creation_date", $this->case_creation_date);
             $stmt->bindParam(":case_closed_date", $this->case_closed_date);
             $stmt->bindParam(":case_box", $this->case_box);
             $stmt->bindParam(":case_author", $this->case_author);
             $stmt->bindParam(":case_number_id", $this->case_number_id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        public function deleteCaseNumber(){
            $sqlQuery = "DELETE FROM
                        ". $this->db_table ."
                    WHERE case_number_id=:case_number_id";
            
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->case_number_id=htmlspecialchars(strip_tags($this->case_number_id));
        
            $stmt->bindParam(":case_number_id", $this->case_number_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>