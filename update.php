<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Edit product</h1>

  <?php
    // check for query string
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    // db connection
    include 'config/database.php';
    try {

      // query string
      $query_string = 'SELECT * FROM products WHERE id = ?';
      $stmt = $connection->prepare($query_string);
      $stmt->bindParam(1, $id);
      $stmt->execute();
      
      // fetch data
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
      // update product
      $name = $row['name'];
      $description = $row['description'];
      $price = $row['price'];
    }
    // errors handling
    catch(PDOException $exception) {
      die('ERROR: ' . $exception->getMessage());
    }
  ?>

  <!-- update script -->
  <?php
    if($_POST) {  // if query string is present
      try {
        // prepare query string for updating record
        $query_string = "UPDATE products 
                    SET name=:name, description=:description, price=:price 
                    WHERE id = :id";
        $stmt = $connection->prepare($query_string);
        $name = $_POST['name'];
        $stmt->bindParam(':name', $name);
        $description = $_POST['description'];
        $stmt->bindParam(':description', $description);
        $price = $_POST['price'];
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);

        // execute the query
        if ($stmt->execute()) {
          echo "<div>The product has been succesfully updated.</div>";
        } else {
          echo "<div>Unable to update the product.</div>";
        }
      }
      catch(PDOException $exception) {
        echo 'ERROR: ' . $exception->getMessage();
      }
    }
  ?>

  <!-- form for input new product data -->
  <form action="<?= $_SERVER["PHP_SELF"] . "?id={$id}"; ?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value="<?= $name; ?>" /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description' ><?= $description; ?></textarea></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' value="<?= $price; ?>" /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' />
                <a href='index.php' class='btn btn-danger'>Back to product list</a>
            </td>
        </tr>
    </table>
  </form>
</body>
</html>