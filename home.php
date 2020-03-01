<?php include('config.php'); ?>
<?php include('user.php'); ?>
<?php include('conn.php'); ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$result = $mysqli -> query("SELECT COUNT(patient_id)FROM Patient");
$rows = mysqli_fetch_row($result);
$patient_count = $rows[0];

$current_date_result = $mysqli -> query("SELECT COUNT(patient_id) FROM Patient WHERE date=CURDATE()");
$current_date = mysqli_fetch_row($current_date_result);
$current_date_count = $current_date[0];

$role = $row['role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dalupitiya Medical Center</title>

    <link href="assets/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/sb-admin.css" rel="stylesheet">

    <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/dropzone.css" />

    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
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
        <a class="navbar-brand mr-1" href="home.php">Dalupitiya Medical Centre</a>
        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        </form>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <p class="mt-2" style="color:#fff;"> Logged as <?php echo $row['name']; ?></p>
                <li class="nav-item dropdown no-arrow">
                    <!-- <i class="fas fa-user-circle fa-fw"></i> -->
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <form method="GET" action="">
                    <input type="submit" class="dropdown-item" name="logout" value="Logout" data-toggle="modal" data-target="#logoutModal">
                </form>
            </div>
            </li>
        </ul>
    </nav>

    <div id="wrapper">
        <!-- Sidebar -->
        <?php
        if (($role == "admin")) {
            echo '<ul class="sidebar navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="home.php" style="color:#fff">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Dashboard</span></a>
            </li>
                 <li class="nav-item">
                 <a class="nav-link" href="patient.php" style="color:#fff">
                         <i class="fas fa-fw fa-chart-area"></i>
                         <span>Patients</span></a>
                 </li>
             </ul>';
        } else {
            echo '<ul class="sidebar navbar-nav">
                 <li class="nav-item active">
                 <a class="nav-link" href="home.php">
                         <i class="fas fa-fw fa-tachometer-alt"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
             </ul>';
        }
        ?>

        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                </ol>

                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <h5>All Patients </h5>
                                <h1 style="text-align: right"><?php echo $patient_count; ?></h1>
                                <!-- <h3 style="text-align: center">20</h3> -->
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="patient.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                                <h5>Today's Patients Count </h5>
                                <h1 style="text-align: right"><?php echo $current_date_count; ?></h1>
                                <!-- <h3 style="text-align: center">20</h3> -->
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="patient.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                                <h5>Warning Card</h5>
                                <h1 style="text-align: right; color:#ffc107"><?php echo $patient_count; ?></h1>
                                <!-- <h3 style="text-align: center">20</h3> -->
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                        <!-- <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Area Chart Example</div>
                            <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                        </div> -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Bar Chart</div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-pie mr-1"></i>Pie Chart</div>
                                    <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
    <script src="./assets/js/script.js"></script>
    <script type="text/javascript" src="./assets/js/dropzone.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>
</body>

</html>