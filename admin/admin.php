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
  <title>Dashboard</title>
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
      <a href="#"><img src="../images/covidlogo.png" alt="" style="width:120px ; height:120px;padding: 20px;"></a>
    </header>
    <ul class="nav">
      <li>
        <a href="admin.php">
          <i class="fas fa-tachometer-alt"></i>Dashboard
        </a>
      </li>
      <li>
        <a href="patientrecord.php">
          <i class="fas fa-users"></i>Patients
        </a>
      </li>
      <li>
        <a href="hospitaldetails.php">
          <i class="fas fa-hospital"></i>Hospitals
        </a>
      </li>
      <li>
        <a href="crdetails.php">
          <i class="fas fa-chart-bar"></i>Reports
        </a>
      </li>
      <li>
        <a href="testdetails.php">
          <i class="fas fa-file-medical"></i>Patient Test Details
        </a>
      </li>
      <li>
        <a href="vaccine.php">
          <i class="fas fa-syringe"></i>Vaccine Availability
        </a>
      </li>


    </ul>
  </div>
  </div>
  </div>
  </div>
  <!-- SIDEBAR END -->
  <!-- NAV STARTS -->
  <nav class="navbar">
    <div class="container-fluid">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="../images/adminuser.png" alt="Admin Profile" class="adminpic">
            <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">
            <li><a href="notification.php"><i class="zmdi zmdi-notifications text-danger"></i> Notifications</a></li>
            <li><a href="../login.php">Logout</a></li>

          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!-- NAV ENDS -->
  <!-- CARDS -->

  <!-- start services -->

  <div class="container w-100" data-aos="fade-up">
    <div class="row justify-content-center" style="margin-left: 250px;">
      <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3" id="grooming">
        <div class="grooming-imgbg mt-2">
          <img src="../images/hospital.png" alt="Award" class="grooming-img">
        </div>
        <h5>Total Hospitals</h6>
          <p class="grooming-para">
10
          </p>
      </div>
      <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 " id="grooming">
        <div class="grooming-imgbg mt-2">
          <img src="../images/patient.png" alt="Award" class="grooming-img ">
        </div>
        <h5>Patients</h5>
        <p class="grooming-para">

20
        </p>
      </div>
      <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3" id="grooming">
        <div class="grooming-imgbg mt-2">
          <img src="../images/vaccine.png" alt="Award" class="grooming-img ">
        </div>
        <h5>Vaccinated</h5>
         <p class="grooming-para">
2
          </p>
      </div>


    </div>
  </div>

  </div>
  </div>
  </div>

  </div>
</body>
<!-- PHP -->

<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>