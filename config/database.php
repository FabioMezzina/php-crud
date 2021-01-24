<?php
// Database setup
$host = "localhost:3306";
$username = "root";
$password = "root";
$db_name = "db_crud_train";

// connection to the database
try {
  $connection = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
catch(PDOException $exception) {
  echo "connection failed" . $exception->getMessage();
}

