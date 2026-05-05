<?php
ini_set('display_errors', 0); 
    session_start();
    include_once("sidepage.php");
    if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    } else { 
     header("Location: admin.php");
        exit(); 
}

$servername = "localhost";
$username = "root";
$password = "";
$db="sharda_medical";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


  $sql = "SELECT count(product_name) as product_count FROM `stocklist` order by id desc";  // Use backticks for table name
  $result_query = $conn->query($sql);  // Execute the query

// Check if query was successful
  if ($result_query) {
     // echo "Query successful!<br>";
      //echo "<pre>";
     $result=$result_query->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array and print
  } else {
      echo "Error: " . $conn->error;
  } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggleable Sidebar Dashboard</title>
    <!-- Bootstrap 5 CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-image : url('images/wallpaper.jpg');
            margin: 0;
            height: 100vh;
            background-size: cover; /* Makes sure the image covers the whole page */
            background-position: center center; /* Centers the image */
            background-repeat: no-repeat; /* Prevents repeating the image */
        }

       
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <span class="navbar-brand">Sharda Medical Chakur</span>
                <div class="d-flex">
                    <span class="navbar-text">
                        Welcome, <strong>Admin</strong>
                    </span>
                </div>
            </div>
        </nav>
        <div class="container mt-4">
            <div class="row">
                <!-- Example Card 1 -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                           Total Products
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $result[0]['product_count']; ?> Products</h5>
                            <p class="card-text">present in the shop</p>
                        </div>
                    </div>
                </div>
               <!--  <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            Sales Revenue
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">$10,500</h5>
                            <p class="card-text">Total revenue generated this month.</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    

</body>  

</html>
