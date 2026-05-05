<?php
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

   
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   
                        $nameErr="";

                        $productName =strip_tags($_POST['product_name']);
                        $quantity = strip_tags($_POST['quantity']);
                        $price = htmlspecialchars($_POST['price']);
                        $maf=strip_tags($_POST['maf']);
                        $timestamp = strtotime($maf);
                        $mafDate = date('d-m-y', $timestamp);
                        $exp=strip_tags($_POST['exp']);
                        $timestamp1 = strtotime($exp);
                        $expDate=date('d-m-y', $timestamp1);
                        $wholesaler=strip_tags($_POST['wholesaler']);
                        $currentDate=date("d-m-y");
                       
                        if(($_POST["price"])!= "")
                            {
                        if (preg_match("/^-?\d+(\.\d+)?$/", $price)) {

                            $sql = "INSERT INTO stocklist(product_name,wholesaler,price,entry_date,quantity,mfg_date,exp_date)VALUES('".$productName."','".$wholesaler."','".$price."','".$currentDate."','".$quantity."','".$mafDate."','".$expDate."')";  // Use backticks for table name
                         //echo "here=>" .$sql;
                         $result_query = $conn->query($sql);

                          if ($result_query) {
                             echo "Inserted successful!<br>";
                           //  echo "<pre>";
                                  header("Location: addProduct.php");
                          } else {
                              echo "Error: " . $conn->error;
                          } 
                              
                        } 
                        else
                        {
                            $nameErr = "Please Enter is Valid Price";
                        }
                        }

                         

        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
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
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 form-container">
                <h3 class="text-center mb-4">Add Product</h3>

                <!-- Add Form -->
                <form action="" method="POST">
                   
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="product_name">Product Name:</label>
                        <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo $_POST["product_name"]; ?>"required>
                    </div>
                   
                     <div class="form-group col-md-6">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="<?php echo $_POST["quantity"]; ?>" required>
                     </div>
                      <div class="form-group col-md-6">
                        <label for="price">Price:</label>
                        <input type="text" id="price" name="price" class="form-control" value="<?php echo $_POST["price"]; ?>" required onfocusout="isNumeric()">
                        <span style="color:red;"><?php echo $nameErr; ?></span>

                      </div>
                      <div class="form-group col-md-3">
                        <label for="maf">Maf Date:</label>
                        <input type="date" id="maf" name="maf" class="form-control" value="<?php echo $_POST["maf"]; ?>" required>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exp">Expiry Date:</label>
                        <input type="date" id="exp" name="exp" class="form-control"  value="<?php echo $_POST["exp"]; ?>" required>
                    </div>
                    </div>
                    <div class="form-row">
                     <div class="form-group col-md-6">
                        <label for="wholesaler">Wholesaler:</label>
                        <input type="text" id="wholesaler" name="wholesaler" class="form-control" value="<?php echo $_POST["wholesaler"]; ?>" required>
                    </div>
                    </div>
                    


                    <button type="submit" class="btn btn-submit btn-block">Add <span class="fas fa-plus"></span></button>
                   <!--  <button type="button" class="btn btn-secondary btn-block" onclick="cancelbtn()">Cancel</button> -->
                    <a href="product.php" class="btn btn-secondary btn-block"> Cancel</span></a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function isNumeric()
    {
    
   // alert("hey");
    var price=$("#price").val();
//let input = "123.45";  // Sample input

// Regex to match integer or floating-point number
if (/^-?\d+(\.\d+)?$/.test(price)) {
    //console.log("Valid number");

} else {
   // console.log("Invalid number");
    alert("Please Enter Valid Price");
      //document.getElementById("price").focus();
}
}
</script>
</body>
</html>
