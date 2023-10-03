<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
//if user log out
if (!isset($_SESSION['admin_id'])) {
  header("Location: ../login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Details</title>
  <link rel="stylesheet" href="../assets/css/admin.css">
  <link rel="icon" href="../assets/images/covidlogo.png">
  <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <!-- SIDEBAR STARTS -->
  <div id="sidebar">
    <header>
      <a href="#"><img src="../assets/images/covidlogo.png" alt=""
          style="width:120px ; height:120px;padding: 20px;"></a>
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

  <!-- SIDEBAR END -->
  <!-- NAV STARTS -->
  <nav class="navbar">
    <div class="container-fluid">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="../assets/images/adminuser.png" alt="Admin Profile" class="adminpic">
            <?php echo $_SESSION['username']; ?> <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">
            <li><a href="notification.php"><i class="zmdi zmdi-notifications"></i>Approval</a></li>
            <li><a href="../login.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!-- NAV END -->
  <!-- TABLE STARTS -->
  <div class="container-fluid" id="all-products">
    <h1 class="text-center">Test Details</h1>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>Patient Name</th>
            <th>Test Name</th>
            <th>Hospital Name</th>
            <th>Date</th>
            <th>Time</th>
          </tr>
        </thead>
        <tbody>
          <!-- PHP -->
          <?php
          $query = "SELECT a.app_id, p.patient_name, h.hospital_name,test_name, a.app_date, a.app_time
          FROM appointment a
          LEFT JOIN patient p ON a.patient_id = p.patient_id
          LEFT JOIN hospital h ON a.hospital_id = h.hospital_id";

          $result = mysqli_query($con, $query);
          foreach ($result as $row) {
            echo "<tr>";
            echo "<td>{$row['patient_name']}</td>";
            echo "<td>{$row['test_name']}</td>";
            echo "<td>{$row['hospital_name']}</td>";
            echo "<td>{$row['app_date']}</td>";
            echo "<td>{$row['app_time']}</td>";

            echo "</tr>";
          }
          ?>
          <!-- PHP END -->
        </tbody>
      </table>
    </div>
  </div>
  <!-- TABLE END -->

  <!-- LINKS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>