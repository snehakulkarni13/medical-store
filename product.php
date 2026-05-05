<?php
ini_set('display_errors', 0); 
// Simulating a database with an array (in a real-world scenario, use a database)
session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    } else { 
     header("Location: admin.php");
        exit(); 
}
include_once("sidepage.php");

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


  $sql = "SELECT * FROM `stocklist` order by id desc";  // Use backticks for table name
  $result_query = $conn->query($sql);  // Execute the query

// Check if query was successful
  if ($result_query) {
     // echo "Query successful!<br>";
      //echo "<pre>";
     $result=$result_query->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array and print
  } else {
      echo "Error: " . $conn->error;
  } 
   $sql_count = "SELECT COUNT(*) as res_count FROM `stocklist` ";  // Use backticks for table name
  $result_count_query = $conn->query($sql_count);  // Execute the query
 if ($result_count_query) {
   $res_count=$result_count_query->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array and print
  } else {
      echo "Error: " . $conn->error;
  } 

$action = $_POST['action'];
$id = $_POST['id'];

if ($action == 'delete') {
    $sql1 = "DELETE FROM stocklist WHERE id = $id";
    $result_query1 = $conn->query($sql1); 
    //echo $result_query1;
}

$image_path = 'path/to/your/image.jpg'; // Background image


$perPage = 8;  // Rows per page
$totalRows = count($result);
$totalPages = ceil($totalRows / $perPage);

// Get current page number from URL (default is 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = ($page > 0) ? $page : 1;  // Ensure page is at least 1
$start = ($page - 1) * $perPage;  // Starting index for the data slice

// Filter by search term (if any)
$searchTerm = isset($_GET['search']) ? strtolower($_GET['search']) : '';
if ($searchTerm) {
    // Filter data based on search term
    $filteredData = array_filter($result, function ($row) use ($searchTerm) {
        return strpos(strtolower($row['product_name']), $searchTerm) !== false;
    });
} else {
    $filteredData = $result;
}

// Apply pagination to the filtered data
$paginatedData = array_slice($filteredData, $start, $perPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
           background-image : url('images/wallpaper.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
            border-radius: 10px;
            padding: 40px;
            width: 95%;
            height: 95%;
            max-width: 1200px; /* Maximum width */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-left: 18%;
            margin-right: 18%;
        }

        h1 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 30px;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;

        }

        .btn-custom {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #45a049;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .table-responsive {
            margin-top: 20px;
        }

        /* Responsive Design Enhancements */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .addbtn{
                margin-right: 20%;
            }
            .table th, .table td {
                font-size: 0.9rem;
                 white-space: nowrap;
            }

            .btn-sm {
                font-size: 0.75rem;
            }
        }

  #searchInput {
        width: 95%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }
    </style>
</head>
<body>

<div class="container">
    <h1>Product Details</h1>
    <h3 class="addbtn"><a href="addProduct.php" class="btn btn-info btn-sm"> Add <span class="fa fa-plus"></span></a></h3>

    <!-- Users Table -->
    <div class="table-responsive">
        <form action="" method="GET" id="searchForm">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="text" name="search" id="searchInput" placeholder="Search by name..." value="<?php echo htmlspecialchars($searchTerm); ?>" onkeyup="this.form.submit()">
    </form>

        <!--  <form action="" method="POST"> -->
            <input type="hidden" id="hid_name" name="hid_name" value="">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Maf Date</th>
                    <th>Expiry Date</th>
                    <th>Wholesaler</th>
                    <th>Entry Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $num =0;
                foreach ($paginatedData as $row) : 
                 $df ++;
                    ?>
                    <tr id="tr_<?php echo $row['id']; ?>">
                        <td><?php echo $df; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['mfg_date']; ?></td>
                        <td><?php echo $row['exp_date']; ?></td>
                        <td><?php echo $row['wholesaler']; ?></td>
                        <td><?php echo $row['entry_date']; ?></td>

                        <td>
                            <a href="editProduct.php?id=<?php echo $row['id']; ?>"class="btn btn-warning btn-sm">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="delFun(<?php echo $row['id'];?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo "Total ".$res_count[0]['res_count'];?>
        <div class="pagination">

            <?php 
            if ($page > 1): ?>
                <a href="?page=1&search=<?php echo urlencode($searchTerm); ?>">First</a>&nbsp;
                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($searchTerm); ?>">Prev</a>&nbsp;   
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($searchTerm); ?>" class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>&nbsp;&nbsp;
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($searchTerm); ?>">Next</a>&nbsp;&nbsp;&nbsp;
                <a href="?page=<?php echo $totalPages; ?>&search=<?php echo urlencode($searchTerm); ?>">Last</a>&nbsp;&nbsp;
            <?php endif; ?>
        </div>
   <!--  </form> -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/product.js"></script>

</body>
</html>
