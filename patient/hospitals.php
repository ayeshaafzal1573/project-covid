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
    <!-- Navigation Bar -->
                    <form class="form-inline" action="hospitals.php" method="GET">
                        <input class="form-control" type="search" placeholder="Search" name="search"
                            aria-label="Search">
                        <button class="btn btn-search" type="submit">Search</button>
                    </form>
           

    <div class="container mt-4">
        <div class="row">
            <!-- PHP Code to Retrieve Hospitals -->
            <?php

            // Handle search query if present
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = "SELECT * FROM hospital WHERE hospital_name LIKE '%$search%'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                      echo '
                      <div class="col-lg-4 col-md-6 mb-4">
                      <div class="card" style="width: 18rem;">    
                    <img src="../images/hospital.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">' . $row['hospital_name'] . '</h5>
                    <p class="card-text">Location: ' . $row['location'] . '</p>
                    <p class="card-text">Status: ' . ($row['status'] ? 'Active' : 'Inactive') . '</p>
                           
  </div>
</div>
</div>';
                  
                }
            } else {
                echo '<div class="col-12"><p>No hospitals found.</p></div>';
            }

            $con->close();
            ?>
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