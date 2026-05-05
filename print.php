
<?php
ini_set('display_errors', 0); 
// Simulating a database with an array (in a real-world scenario, use a database)
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

  $sql = "SELECT * FROM `customers` order by id desc limit 1";  // Use backticks for table name
  $result_query = $conn->query($sql);  // Execute the query

  if ($result_query) {
     $result=$result_query->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array and print
  } else {
      echo "Error: " . $conn->error;
  } 

  $array1=$result[0]['quantity'];
  $array2=$result[0]['price'];


  $number=$result[0]['product_name'];

  $sql1 = "SELECT product_name FROM `stocklist` WHERE `id` IN ($number) ORDER BY FIELD (id,$number)";  // Use backticks for table name
  $result_query1 = $conn->query($sql1);  // Execute the query

  if ($result_query1) {
     $array3=$result_query1->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array and print
  } else {
      echo "Error: " . $conn->error;
  } 
//   echo"<pre>";

// print_r($array3);




$commaSeparatedNames = [];  // Array to store the results

foreach($array3 as $index => $rw) {
    // Add the product name to the array
    $commaSeparatedNames[] = $rw['product_name'];
}

// Implode the array with a comma separator
$commaSeparatedString = implode(', ', $commaSeparatedNames);

//echo $commaSeparatedString;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Billing Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .bill-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
        }
        .header h2 {
            margin: 0;
        }
        .bill-info {
            margin-top: 20px;
        }
        .bill-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .bill-info th, .bill-info td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .bill-info th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .print-btn {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .print-btn button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .print-btn button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<!-- Bill Content -->
<div class="bill-container">
    <div class="header">
        <h2>Billing Invoice</h2>
        <p>Customer Name: <?php echo $result[0]['customer_name']; ?></p>
        <p>Date: <?php echo date('d-m-Y'); ?></p>
    </div>

    <div class="bill-info">
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price per Item</th>
                    <th>Total</th>
                </tr>
            </thead>
            
                <!-- Example Product -->
<?php 
//  print_r($commaSeparatedString);
// echo"<pre>";
//     print_r($array1);
    // echo"<pre>";
    // print_r($array2);
//     echo"<pre>";

// Your string of products
//$products_string = "calpol, TusQ";

// Use explode() to convert the string into an array
$arrayA = explode(", ", $commaSeparatedString);
$arrayE = explode(",", $array2);

$arrayB = explode(",", $array1);


//  print_r($arrayA);
// echo"<pre>";
//     print_r($arrayE);
//     echo"<pre>";
    // print_r($arrayB);
    // echo"<pre>";

//$data = [$commaSeparatedString,$array1,$array2];
   $num=0;
    // Loop through the data and display it in table rows
    for ($i = 0; $i < count($arrayA); $i++) {
        $num++;
        echo "<tr>";
        echo "<td>" . $arrayA[$i] . "</td>";
        echo "<td>" . $arrayB[$i] . "</td>";
        echo "<td>" . $arrayE[$i] . "</td>";
         echo "<td id = final_$num>" . $arrayB[$i] * $arrayE[$i]. "</td>";
        echo "</tr>";
   
   }
    ?>
        </table>
    </div>

    <div class="total">
        <label class="test" id="total_no">15 Rs</label>
    </div>

    <!-- Print Button -->
    <div class="print-btn">
        <button onclick="window.print()">Print Bill</button>
    </div>
</div>

<script>

     function calculateTotal() {
        var total = 0;
        // Loop through all the final_* td elements
        var i = 1;  // Start with final_1
        while (document.getElementById("final_" + i)) {
            var value = parseFloat(document.getElementById("final_" + i).innerText);
            if (!isNaN(value)) {
                total += value;  // Add the value to the total
            }
            i++;
        }
        // Set the total value in the total_no label
        document.getElementById("total_no").innerText = total + " Rs";
    }

    // Call the function to calculate total when the page loads
    window.onload = calculateTotal;
            // $('.test').val('200');
           // loadTable();
        
    // This script will trigger the print dialog
    function printPage() {
        window.print();
    }
      
</script>

</body>
</html>
