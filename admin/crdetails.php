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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Covid Test Results</title>
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
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="../images/admin.jpg" alt="Admin Profile" class="adminpic">
            <?php echo $_SESSION['admin_id']; ?> <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">
            <li><a href="notification.php"><i class="zmdi zmdi-notifications text-danger"></i> Notifications</a></li>
            <li><a href="../login.php">Logout</a></li>
            <li><a href="#">Profile</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!-- NAV ENDS -->
  <!-- TABLE STARTS -->
  <div class="container-fluid" id="all-products">
    <h1 class="text-center">COVID Test Results</h1>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>Patient</th>
            <th>Hospital</th>
            <th>Date</th>
            <th>Results</th>
            <th>Report</th>
          </tr>
        </thead>
        <tbody>
          <!-- PHP  STARTS-->
          <?php
          $query = "SELECT * FROM appointment";
          $result = mysqli_query($con, $query);

          while ($row = mysqli_fetch_assoc($result)) {
            $patient_id = $row['patient_id'];
            $hospital_id = $row['hospital_id'];

            $patient_query = "SELECT patient_name FROM patient WHERE patient_id = $patient_id";
            $patient_result = mysqli_query($con, $patient_query);

            $hospital_query = "SELECT hospital_name FROM hospital WHERE hospital_id = $hospital_id";
            $hospital_result = mysqli_query($con, $hospital_query);

            if ($patient_result && $hospital_result) {
              $patient_data = mysqli_fetch_assoc($patient_result);
              $hospital_data = mysqli_fetch_assoc($hospital_result);

              $patient_name = $patient_data['patient_name'];
              $hospital_name = $hospital_data['hospital_name'];
              ?>
              <tr>
                <td>
                  <?= $patient_name ?>
                </td>
                <td>
                  <?= $hospital_name ?>
                </td>
                <td>
                  <?= $row['app_date'] ?>
                </td>
                <td>
                  <?= $row['status'] == 1 ? 'Positive' : 'Negative' ?>
                </td>
                   <td><a href="download.php?app_id={$row['app_id']}" class='btn' style='background-color:red; color:#ffff'>Download Report</a></td>;

            
              </tr>
            <?php } else { ?>
              <tr>
                <td colspan="5">Error fetching data.</td>
              </tr>
            <?php }
          }
          ?>
          <!-- PHP  ENDS-->

        </tbody>
      </table>
    </div>
  </div>
  <!-- TABLE END -->
</body>
<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>