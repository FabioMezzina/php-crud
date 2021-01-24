<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Read products page</h1>

  <?php 
    // database connection
    include 'config/database.php';

    // query to select all data
    $query_string = "SELECT id, name, description, price FROM products ORDER BY id DESC";
    $stmt = $connection->prepare($query_string);
    $stmt->execute();

    // get number of records
    $num = $stmt->rowCount();

    // link to create productt page
    echo "<a href='create.php'>Create new product</a> ";

    if($num > 0) {
      echo "<table>";//start table
      //creating our table heading
      echo "<tr>";
          echo "<th>ID</th>";
          echo "<th>Name</th>";
          echo "<th>Description</th>";
          echo "<th>Price</th>";
          echo "<th>Action</th>";
      echo "</tr>";
      
      // fetch all records from db and show in a table
      $records = $stmt->fetchAll();
      foreach ($records as $record) {
        echo "<tr>";
          echo "<td>{$record['id']}</td>";
          echo "<td>{$record['name']}</td>";
          echo "<td>{$record['description']}</td>";
          echo "<td>{$record['price']}</td>";
          echo "<td>"; // cta to view details, update or delete product
            // read one record 
            echo "<a href='read_one.php?id={$record['id']}'>Detail </a>";

            // we will use this links on next part of this post
            echo "<a href='update.php?id={$record['id']}'>Edit </a>";

            // we will use this links on next part of this post
            echo "<a href='#' onclick='delete_user({$record['id']});'>Delete </a>";
          echo "</td>";
        echo "</tr>";
      }
      // end table
      echo "</table>";
    } else {
      echo "<h3>No products found!</h3>";
    }
  ?>
</body>
</html>