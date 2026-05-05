<?php
$servername="localhost";
$username="";
$password="";
$conn= new mysqli($servername,$username,$password);
if($conn->connect_error)
{
	die("failed");
}
echo "sucess";
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
    table,th,td{
    border:3px solid black;
    border-collapse:collapse;
    }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            background-size: cover; /* Makes sure the image covers the whole page */
            background-position: center center; /* Centers the image */
            background-repeat: no-repeat; /* Prevents repeating the image */
        }

       
    </style>
</head>

<body>
<table>
<tr>
<th>Sr.No</th>
<th>Name</th>
<th>Mobile No</th>
</tr>
<tr>
<td>1</td>
<td>Sneha </td>
<td>123456789</td>
</tr>
<tr>
<td>2</td>
<td>Test</td>
<td>123456789</td>
</tr>
<tr>
<td>3</td>
<td>Abc</td>
<td>123456789</td>
</tr>
</table>

    <!-- Bootstrap 5 JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    

</body>  

</html>