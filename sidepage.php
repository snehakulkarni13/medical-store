  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Bootstrap 5 CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

  /* Sidebar style */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
            transition: all 0.3s;
        }

        .sidebar.collapsed {
            width: 0;
            padding-top: 0;
            overflow: hidden;
        }

        .sidebar a {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

     .container-fluid-static {
            max-width: 1200px; /* Maximum width like a regular container */
            margin: 0 auto;    /* Center the container */
        }

        /* Optional: Make sure the container fills the screen width if needed */
        .container-fluid-static .content {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .sidebar a:hover {
            background-color: #575d63;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }


        .sidebar-toggler {
            position: absolute;
            top: 20px;
            left: 5px;
            background-color: #343a40;
            color: white;
            border: none;
            font-size: 20px;
            cursor: pointer;
            z-index: 10;
        }

        .card {
            margin-bottom: 20px;
        }
        h4
        {
            margin-left: 5%;
        }

   </style>
</head>

<body>
 <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4 class="text-white text-center mb-4">Admin Dashboard</h4>
        <a href="dashboard.php">Home</a>
        <a href="Product.php">Product</a>
        <a href="billing.php">Billing</a>
      <!--   <a href="reports.php">Reports</a> -->
        <a href="logout.php">Logout</a>
    </div>

    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggler" id="sidebarToggle">
        &#9776;
    </button>
     <!-- Bootstrap 5 JavaScript and dependencies -->

    <!-- Custom JavaScript to toggle sidebar -->
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            // Toggle sidebar visibility
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('shifted');
        });
    </script>
    </body>

</html>