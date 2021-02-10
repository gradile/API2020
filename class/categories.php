<?php
    class Category{

        // Connection
        private $conn;

        // Table
        private $db_table = "case_categories";

        // Columns
        public $category_id;
        public $category_description;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getCategories(){
            $sqlQuery = "SELECT category_id, category_description FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
    }
?>