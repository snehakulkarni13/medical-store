                   
<?php
include_once("sidepage.php");
ini_set('display_errors', 0); 
session_start();
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

 $sql1 = "SELECT id,product_name,mfg_date,exp_date FROM `stocklist` order by id desc";  // Use backticks for table name
  $result_query1 = $conn->query($sql1);  // Execute the query

  if ($result_query1) {
     $result1=$result_query1->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array and print
  } else {
      echo "Error: " . $conn->error;
  } 
   
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   
                        //$productName =strip_tags($_POST['product_name']);

                        $selected_products = $_POST['product_name'];
                        $productName = implode(",", $selected_products);


                        $quantity = strip_tags($_POST['quantity']);
                        $price = htmlspecialchars($_POST['price']);
                        $maf=strip_tags($_POST['maf']);
                        $timestamp = strtotime($maf);
                        $mafDate = date('d-m-y', $timestamp);
                        $exp=strip_tags($_POST['exp']);
                        $timestamp1 = strtotime($exp);
                        $expDate=date('d-m-y', $timestamp1);
                        $drName=strip_tags($_POST['doctor_name']);
                        $BillNo=strip_tags($_POST['bill_no']);
                        $address=strip_tags($_POST['address']);
                        $currentDate=date("d-m-y");
                        $customer_name=strip_tags($_POST['customer_name']);
                        
                         $sql = "INSERT INTO customers(product_name,doctor_name,price,entry_date,quantity,bill_no,address,customer_name)VALUES('".$productName."','".$drName."','".$price."','".$currentDate."','".$quantity."','".$BillNo."','".$address."','".$customer_name."')";  // Use backticks for table name
                         //echo "here=>" .$sql;
                         $result_query = $conn->query($sql);

                          if ($result_query) {
                             echo "Inserted successful!<br>";
                           //  echo "<pre>";
                                  header("Location: print.php");
                          } else {
                              echo "Error: " . $conn->error;
                          } 

        }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            background-image : url('images/wallpaper.jpg');
            margin: 0;
            height: 100vh;
            background-size: cover; /* Makes sure the image covers the whole page */
            background-position: center center; /* Centers the image */
            background-repeat: no-repeat; /* Prevents repeating the image */
        }
        .container {
            margin-top: 50px;
        }
        h3 {
            color: #4CAF50;
        text-align: center;
        margin-bottom: 30px;
            }
        .form-container {
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
           
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }

           .select-container {
            margin: 20px auto;
            text-align: center;
            max-width: 500px;
        }
        .select2-container {
            width: 100% !important;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 form-container">
                <h3 class="text-center mb-4">Billing Details</h3>
                <label for="bill_no">Bill No:</label>
                         <label><?php echo "10"; ?></label>

                <!-- Add Form -->
                <form action="" method="POST">
                   <div class="form-group col-md-3">
                        
                        <input type="hidden" id="bill_no" name="bill_no" value="<?php echo $_POST['bill_no']; ?>" class="form-control" required>
                    </div>
                    <div class="form-row">
                     <div class="form-group col-md-6">
                        <label for="customer_name">Patient Name:</label>
                        <input type="text" id="customer_name" name="customer_name" value="<?php echo $_POST['customer_name']; ?>"class="form-control" required>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="<?php echo $_POST['address']; ?>" class="form-control" required>
                    </div>
                     <div class="form-group col-md-6">
                        <label for="doctor_name">Doctor Name:</label>
                        <input type="text" id="doctor_name" name="doctor_name" value="<?php echo $_POST['doctor_name']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                            <div class="form-group">
                            <label for="product_name">Choose Products</label>
                            <select name="product_name[]" id="product_name"  class="form-control" multiple onchange="showInputs()">
                                <?php foreach ($result1 as $row): ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['product_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                           </div>
                    </div>
                     <div class="form-group col-md-6">
                        <label for="quantity">Quantity:</label>
                        <input type="text" id="quantity" name="quantity" value="<?php echo $_POST['quantity']; ?>" class="form-control" required>
                     </div>
                      <div class="form-group col-md-6">
                        <label for="price">MRP:</label>
                        <input type="text" id="price" name="price" value="<?php echo $_POST['price']; ?>" class="form-control" required>
                      </div>
                      <div id="input-container" class="form-group col-md-12" style="display:none;">
                      <div>
                        <label for="maf">Maf Date:</label>
                        <input type="date" id="maf" name="maf" value="<?php echo $_POST['maf']; ?>" class="form-control" required>
                      </div>
                      <div >
                        <label for="exp">Expiry Date:</label>
                        <input type="date" id="exp" name="exp" value="<?php echo $_POST['exp']; ?>" class="form-control" required>
                    </div>
                    </div>
                    
                     
                    </div>
                    


                    <button type="submit" class="btn btn-submit btn-block">Add <span class="fas fa-plus"></span></button>
                   <a href="dashboard.php" class="btn btn-secondary btn-block"> Cancel</span></a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Initialize Select2 on the select element -->
<script>
    function showInputs() {
       
  const selectedItems = document.getElementById("product_name").selectedOptions;

  // Check if at least one item is selected
  if (selectedItems.length > 0) {
    document.getElementById("input-container").style.display = "block"; // Show input fields
  } else {
    document.getElementById("input-container").style.display = "none"; // Hide input fields if no item is selected
  }
}
    $(document).ready(function() {
        $('#product_name').select2({
            placeholder: "Select Products",
            allowClear: true,
            width: '100%'  // Ensures Select2 takes up the full width
        });
    });

   
</script>
</body>
</html>
