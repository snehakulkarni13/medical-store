
<?php
session_start();
ini_set('display_errors',0);
//include_once("connectDatabase.php");
// echo"<pre>";
// print_r($_POST);



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
//echo "Connected successfully";




if ($_SERVER["REQUEST_METHOD"] == "POST") 
{  // Check if submit button was clicked
    // Validate Name

  $sql = "SELECT * FROM `sharda_admin`";  // Use backticks for table name
  $result_query = $conn->query($sql);  // Execute the query

// Check if query was successful
  if ($result_query) {
     // echo "Query successful!<br>";
      //echo "<pre>";
     $result=$result_query->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array and print
  } else {
      echo "Error: " . $conn->error;
  } 

    $nameErr="";
    $name = $_POST["uname"];
    if(($_POST["uname"])== "")
    {
     // echo "here=>".$nameErr;
     //die;
        $nameErr = "Username is required";

    } 
  
     if(($_POST["password"])== "")
    {
     
      $passwordErr="";
     // echo "here=>".$nameErr;
     //die;
        $passwordErr = "Password is required";
    } 
    else
    {
       $password=$_POST["password"];
    }

// echo"<pre>";
// print_r($result);
// echo"name=>>>>>".$result[0]['user_name'];
  
  if($passwordErr =="" && $nameErr =="")
  {

    if($name === $result[0]['user_name'] && $password === $result[0]['password'])
     { 
        $_SESSION['username'] = $name;
        $_SESSION['password'] = $password;
        echo "Login successful! Welcome, " . $_SESSION['username'];
        header("Location: dashboard.php");
        exit(); 
    }
    else {

      $passwordInErr="";
      $passwordInErr = "Incorrect username or password!";

    }
  }
  
}



?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

form
{
  margin-left: 10%;
  margin-right: 10%;
}
button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
h2
{
  /*margin-left: 40%;*/
/*  background-color: black;*/
 /* margin-right: 40%;
*/}

   form {
            
            background-color: lightblue;
          }
body
{
  background-image: url('images/pic.jpg');
}

</style>
</head>

<body >



<form action="" method="post">
  <h2 id="heading"><center>Sharda Medical Chakur</center> </h2>
  <div class="imgcontainer">
   <!--  <img src="img_avatar2.png" alt="Avatar" class="avatar"> -->
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" id="uname" required>
    <span style="color:red;"><?php echo $nameErr; ?></span><br><br>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>
   <span style="color:red;"><?php echo $passwordErr; ?></span><br>
    <span style="color:red;"><?php echo $passwordInErr; ?></span><br> 
        
    <button type="submit">Login</button>
   <!--  <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label> -->
  </div>

  <div class="container" style="background-color:#f1f1f1" >
    <button type="button" class="cancelbtn">Cancel</button>
    <!-- <span class="psw">Forgot <a href="#">Password</a></span> -->
  </div>
</form>

</body>
</html>
