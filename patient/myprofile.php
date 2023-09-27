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
    <title>Pandemix</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="patient.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="icon" href="../images/covidlogo.png" type="image/gif" />
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
</head>

<body class="main-layout">
    <!-- header -->
    <header class="header-area">
        <div class="left">
            <a href="Javascript:void(0)"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
        <div class="right">
            <a href="register.php"><i class="fa fa-user" aria-hidden="true"></i></a>
        </div>
        <div class="container">
            <div class="row d_flex">
                <div class="col-sm-3 logo_sm">
                    <div class="logo">
                        <a href="index.html"></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-lg-1 col-md-12 col-sm-9">
                    <div class="navbar-area">
                        <nav class="site-navbar">
                            <ul>
                                <li><a class="active" href="patient.php">Home</a></li>
                                <li><a href="myappointment.php">Appointments</a></li>
                                <li><a href="patient.php" class="logo_midle">Pandemix</a></li>
                                <li><a href="hospitals.php">Hospital</a></li>
                                <li><a href="covidreport.php">Reports</a></li>
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
    <!-- PHP -->
    <?php

$patient_id = $_SESSION['patient_id'];
$query = "SELECT * FROM `patient` WHERE `patient_id` = $patient_id";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $patient_name = $row['patient_name'];
    $address = $row['address'];
    $email = $row['email'];
}

mysqli_close($con);
?>

<div class="container myprofile">
    <div class="row">
        <div class="col-md-12">
            <img src="../images/patientuser.png" alt="myprofile" class="my-img">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p style="font-family: poppin; font-size: 22px;  margin-top: 5px;">
        <?php echo $patient_name; ?></p>
        </div>
        
        </div>
        <div class="row">
            <div class="col-12">
            <p><strong>Address:</strong>
            <br>
            </p>
            <p style="border: 1px solid black; width: 40%;">
            <?php echo $address; ?>
            </p>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12">
            <p><strong>Email:</strong><br>
                <p style="border: 1px solid black; width: 40%;">
                    <?php echo $email; ?>
                    </p>
    
    </p>
    </p>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                  
  <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>

            </div>
        </div>
</div>



  
 
  
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fzj+3iv2pZl5jK4vF2z5s0TNqI3f21f5sFt9GO+86n5FIEp6p4U6T/Kf5F92Rf5k2L"
        crossorigin="anonymous"></script>

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
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>

