<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$web_id = 1;

$connect = mysqli_connect("localhost", "root", "", "content_management");
$query = "SELECT * FROM slots where web_id = $web_id";
$result = mysqli_query($connect, $query);
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS Panel</title>

    <link href="assets/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/sb-admin.css" rel="stylesheet">

    <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/dropzone.css" />

    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .box {
            width: 800px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 25px;
        }

        #page_list li {
            padding: 16px;
            background-color: #f9f9f9;
            border: 1px dotted #ccc;
            cursor: move;
            margin-top: 12px;
        }

        #page_list li.ui-state-highlight {
            padding: 24px;
            background-color: #ffffcc;
            border: 1px dotted #ccc;
            cursor: move;
            margin-top: 12px;
        }

    </style>

</head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="home.php">CMS</a>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        </form>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <div id="wrapper">
          <!-- Sidebar -->
          <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="pages.php" role="button">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Slots</span>
                </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="website.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Websites</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_account.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>User Accounts</span></a>
            </li>
        </ul>

        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Pages</li>
                </ol>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <?php  
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $slot_id = $row['slot_id'];
                            $slot_type = $row['slot_type'];
                            $web_id = $row['web_id'];
                            ?>
                            <a href="home.php?slot_id=<?php echo $slot_id ?>">
                            <div class="card text-white bg-primary mt-3 mb-3 ml-5 mr-5" style="max-width: 18rem;">
                                 <div class="card-header">
                                   <?php                                     
                                   echo "<h1> Slot : $slot_id </h1>";
                                   ?>
                                   </div> 
                                   <div class="card-body">
                                   <?php echo "<h5> $slot_type </h5>"; ?>
                                   </div>
                                </div>
                                </a>
                            <?php         
                        }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Page level plugin JavaScript-->
        <script src="assets/vendor/chart.js/Chart.min.js"></script>
        <script src="assets/vendor/datatables/jquery.dataTables.js"></script>
        <script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin.min.js"></script>

        <!-- Demo scripts for this page-->
        <script src="assets/js/demo/datatables-demo.js"></script>
        <script src="assets/js/demo/chart-area-demo.js"></script>

        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
        <script src="./assets/js/script.js"></script>
        <script type="text/javascript" src="./assets/js/dropzone.js"></script>
</body>

</html>
