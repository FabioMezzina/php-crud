<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Product detail</h1>
  <!-- script to get the product record from db, using the id passed as query string ?id=# -->
  <?php
    // connection to db
    include 'config/database.php';
    try {
      // get the product id
      $id = $_GET['id'];
      
      // query string to find the selected record
      $query_string = "SELECT * FROM products WHERE id = ?";
      $stmt = $connection->prepare($query_string);
      
      //execute query
      $stmt->bindParam(1, $id);
      $stmt->execute();
      
      // store data
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $name = $row['name'];
      $description = $row['description'];
      $price = $row['price'];
      
    }
    // errors handling
    catch(PDOException $exception) {
      die('ERROR: ' . $exception->getMessage());
    }
  ?>

  <div>Name: <?= $name ?></div>
  <div>Description: <?= $description ?></div>
  <div>Price: <?= $price ?></div>
  <hr>
  <a href="index.php">Back to product list</a>
</body>
</html>