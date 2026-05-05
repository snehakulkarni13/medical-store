<?php


   
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


     $name = $_POST['name'] ?? '';
     $quentity = $_POST['quentity'] ?? '';
    $radio_id = $_POST['radio_id'] ?? '';
     
   
                     
                        echo "Received:<br>";
    echo "Name: " . htmlspecialchars($name) . "<br>";
    echo "quentity: " . htmlspecialchars($quentity) . "<br>";
     echo "radio_id: " . htmlspecialchars($radio_id) . "<br>";


                            $sql = "INSERT INTO insert_ajax(name,quentity,Gender)VALUES('".$name."','".$quentity."','".$radio_id."')";  // Use backticks for table name
                         echo "here=>" .$sql;
                         $result_query = $conn->query($sql);

                          if ($result_query) {
                             echo "Inserted successful!<br>";
                          
                          } else {
                              echo "Error: " . $conn->error;
                          } 
                              

                        

                         

        }
    ?>