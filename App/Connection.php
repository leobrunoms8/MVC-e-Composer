<?php
    namespace App;

    class Connection{

        public static function getDb(){

            try{

                $conn = new \PDO(
                    "mysql:host=192.168.1.4;dbname=mvc;charset=utf8",
                    "developer",
                    "Leo140707"
                );
    
                $conn->exec('set charset utf8');
    
                return $conn;

                
            } catch(\PDOException $e) {
                echo '<p>' .$e->getMessage(). '</p>';
            }
        }
    }

?>
