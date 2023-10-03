<?php
// Database Connection
include("../connection.php");
// Session Start
session_start();
//if user loggout
if (!isset($_SESSION['patient_id'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Covid Report</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/patient.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="icon" href="../images/covidlogo.png" type="image/gif" />
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
</head>

<body class="main-layout">
    <!-- header -->
    <header class="header-area">
        <div class="right">
            <button class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user" aria-hidden="true"></i>
                <?php echo $_SESSION['patient_name']; ?>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="myprofile.php">My Profile</a>
                <a class="dropdown-item" href="../logout.php">Logout</a>
            </div>
        </div>
        <div class="container">
            <div class="row d_flex">
                <div class="col-sm-3 logo_sm">
                    <div class="logo">
                        <a href="index.php"></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-lg-1 col-md-12 col-sm-9">
                    <div class="navbar-area">
                        <nav class="site-navbar">
                            <ul>
                                <li><a href="patient.php">Home</a></li>
                                <li><a href="myappointment.php">Appointments</a></li>
                                <li><a href="patient.php" class="logo_midle">Pandemix</a></li>
                                <li><a href="hospitals.php">Hospital</a></li>
                                <li><a class="active" href="covidreport.php">Reports</a></li>
                            </ul>
                            <button class="nav-toggler">
                                <span></span>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- TABLE STARTS -->
    <div class="container-fluid" id="all-products">
        <h1 class="text-center">Patient Reports</h1>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Hospital Name</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Test Name</th>
                        <th>Result</th>
                        <th>Vaccination Suggestion</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP -->
                    <?php
                    if (isset($_SESSION['patient_id'])) {
                        $patient_id = $_SESSION['patient_id'];
                        $query = "SELECT appointment.app_date, appointment.app_time, appointment.test_name, appointment.status, hospital.hospital_name, 
                        CASE WHEN appointment.status = 1 THEN patient_vaccination_table.vac_suggest
                        ELSE 'No suggestion' END AS vac_suggest FROM appointment
                        JOIN hospital ON appointment.hospital_id = hospital.hospital_id
                        LEFT JOIN patient_vaccination_table ON appointment.patient_id = patient_vaccination_table.patient_id
                        WHERE appointment.patient_id = $patient_id";
                        $result = mysqli_query($con, $query);
                        if (!$result) {
                            die("Error executing the query: " . mysqli_error($con));
                        }
                    }
                    ?>
                    <!-- PHP END -->
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <?= $row['hospital_name'] ?>
                            </td>
                            <td>
                                <?= $row['app_date'] ?>
                            </td>
                            <td>
                                <?= $row['app_time'] ?>
                            </td>
                            <td>
                                <?= $row['test_name'] ?>
                            </td>
                            <td>
                                <?= $row['status'] == 1 ? 'Positive' : 'Negative' ?>
                            </td>
                            <td>
                                <?= $row['status'] == 1 ? $row['vac_suggest'] : 'No suggestion' ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- TABLE END -->
    <!--  footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="hedingh3 text_align_left">
                            <h3>USEFUL LINKS</h3>
                            <ul class="menu_footer">
                                <li><a href="patient.php">Home</a>
                                <li>
                                <li><a href="myappointment.php">My Appointment</a>
                                <li>
                                <li> <a href="bookappointment.php">Book Appointment</a>
                                <li>
                                <li> <a href="covidreport.php">My Reports</a>
                                <li>

                            </ul>


                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="hedingh3 text_align_left">
                            <h3>About</h3>
                            <p>
                                We are committed to delivering the latest news, health guidelines, and resources from
                                reputable
                                sources.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="hedingh3  text_align_left">
                            <h3>Contact Us</h3>
                            <ul class="top_infomation">
                                <li><i class="fa fa-phone" aria-hidden="true"></i>
                                    <a href="tel:111-222-333">+92-343-209872</a>
                                </li>
                                <li><i class="fa fa-envelope" aria-hidden="true"></i>
                                    <a href="mailto:ayeshaafzal1573@gmail.com">info@pandemix.com</a>
                                </li>
                                <li> <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <a href="https://www.google.com/maps/@24.8847152,67.1775322,15z?entry=ttu">Pandemix
                                        Hospital,Karachi</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="hedingh3 text_align_left">
                            <h3>Location</h3>
                            <div class="map">
                                <img src="../images/map.png" alt="map" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </footer>
    <!-- end footer -->
    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>