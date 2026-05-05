<?php
ini_set('display_errors', 0); 

   
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
                <h3 class="text-center mb-4">Add</h3>

                <!-- Add Form -->
                <form action="" method="POST">
                   
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $_POST["name"]; ?>"required>
                    </div>
                   
                     <div class="form-group col-md-6">
                        <label for="quentity">Quantity:</label>
                        <input type="number" id="quentity" name="quentity" class="form-control" value="<?php echo $_POST["quentity"]; ?>" required>
                        <input type="hidden" id="result" name="result" class="form-control" value="" required>

                         
                     </div>
                      <div class="form-group col-md-6">
                        <label for="radio">Gender:</label>
                        <input type="radio" id="male" name="radio_id" value="0">
                       <label for="male">Male</label>
                       <input type="radio" id="Female" name="radio_id" value="1">
                       <label for="Female">Female</label><br>
                       <!--  <input type="radio" id="radio" name="radio" class="form-control" value="<?php echo $_POST["radio"]; ?>" required> -->
                     </div>
                    


                    <button type="button" class="btn btn-submit btn-block" onclick="add();">Add <span class="fas fa-plus"></span></button>
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


function add()
{


      const name = document.getElementById("name").value;
       const radio_id = document.getElementsByName("radio_id").value;

      const radioButtons = document.getElementsByName('radio_id');
            let selectedLanguage = '';

            for (let i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                    selectedLanguage = radioButtons[i].value;
                    break;
                }
            }
            document.getElementById('result').innerText = "You selected: " + selectedLanguage;
             //document.getElementById('result').innerText = "You selected: " + selectedLanguage;
          
      const quentity = document.getElementById("quentity").value;
      
      //alert(radio_id);

      let hasError = false;

      if (name === "") {
        document.getElementById("nameError").innerText = "Name is required.";
        hasError = true;
      }

      if (hasError) return;
      
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "ajaxPage.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          document.getElementById("response").innerHTML = xhr.responseText;
        }
      };

      const data = `name=${encodeURIComponent(name)}&quentity=${encodeURIComponent(quentity)}&radio_id=${encodeURIComponent(selectedLanguage)}`;
      xhr.send(data);

      $("#response").hide();
      alert("Sucessfully");

 
}
</script>
</body>
</html>
