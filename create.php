<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create a record</title>
</head>
<body>
  <h1>Create a product</h1>
  <!-- Script to save the record on database -->
  <?php
    if($_POST) {  // check if there are a query string with new record input
      include 'config/database.php'; // script for db connection
      try{
     
        // insert query
        $query_string = "INSERT INTO products SET name=:name, description=:description, price=:price, created=:created";
 
        // prepare query for execution
        $stmt = $connection->prepare($query_string);
 
        // posted values
        $name=$_POST['name'];
        $description=$_POST['description'];
        $price=$_POST['price'];
 
        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
         
        // specify when this record was inserted to the database
        $created=date('Y-m-d H:i:s');
        $stmt->bindParam(':created', $created);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div>Record was saved.</div><br>";
        }else{
            echo "<div>Unable to save record.</div><br>";
        }
         
    }
      // if errors
      catch(PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
      }
    }
  ?>

  <!-- input form -->
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <!-- Input for product name -->
    <label for="name">Name</label>
    <br>
    <input type="text" name="name" id="name">
    <hr>
    <!-- Input for product description -->
    <label for="description">Description</label>
    <br>
    <input type="text" name="description" id="description">
    <hr>
    <!-- Input for product price -->
    <label for="price">Price</label>
    <br>
    <input type="text" name="price" id="price">
    <hr>
    <input type="submit" value="Create">
  </form>
  <a href='index.php'>Back to read products</a>
</body>
</html>