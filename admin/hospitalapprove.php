<?php
// Database Connection
include("../connection.php");
// Session Start
session_start();
//if user loggout
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Approval</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" href="../images/corona_icon.png">
    <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <!-- SIDEBAR -->
    <div id="sidebar">
        <header>
            <a href="#"><img src="../images/corona_icon.png" alt="" style="width:70px ; padding: 20px;"></a>
        </header>
        <ul class="nav">
            <li>
                <a href="dashboard.php">
                    <i class="zmdi zmdi-view-dashboard"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="patientrecord.php">
                    <i class="zmdi zmdi-link"></i>Patients
                </a>
            </li>
            <li>
                <a href="hospitaldetails.php">
                    <i class="zmdi zmdi-share"></i>Hospitals
                </a>
            </li>
            <li>
                <a href="crdetails.php">
                    <i class="zmdi zmdi-widgets"></i>Reports</a>
            </li>
            <li>
                <a href="testdetails.php">
                    <i class="zmdi zmdi-settings"></i>Patient Test Details
                </a>
            </li>

        </ul>
    </div>
    </div>
    </div>
    </div>
    <!-- SIDEBAR END -->
    <!-- NAV STARTS -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="../images/admin.jpg" alt="Admin Profile" class="adminpic">
                        <?php echo $_SESSION['admin_id']; ?> <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="zmdi zmdi-notifications text-danger"></i> Notifications</a></li>
                        <li><a href="../login.php">Logout</a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- NAV ENDS -->
    <!-- TABLE STARTS -->
    <div class="container-fluid" id="all-products">
        <h1 class="text-center">Hospital Approval</h1>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>NAME:</th>
                        <th>Location:</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP -->
                    <?php
                    $fetch_hospital = mysqli_query($con, "SELECT * FROM hospital");

                    if ($fetch_hospital) {
                        while ($hospital = mysqli_fetch_assoc($fetch_hospital)) {
                            echo "<tr>";
                            echo "<td>{$hospital['hospital_name']}</td>";
                            echo "<td>{$hospital['location']}</td>";

                            echo "<td> 
          <a href='hospital_active.php?id={$hospital['hospital_id']}' class='btn btn-success'>
    Approve
</a>
<a href='hospital_deactive.php?id={$hospital['hospital_id']}' class='btn btn-danger'>
    Reject
</a>

        </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                    ?>
                    <!-- PHP -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- TABLE END -->

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>