<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
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
          <i class="zmdi zmdi-widgets"></i>Test Results </a>
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
    <table>
        <tr>
            <th>ID</th>
            <th>Patient Name</th>
            <th>Test Name</th>
            <th>Hospital Name</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <!-- PHP -->
        <?php
        $query = "SELECT a.app_id, p.patient_name, h.hospital_name,test_name, a.app_date, a.app_time
          FROM appointment a
          LEFT JOIN patient p ON a.patient_id = p.patient_id
          LEFT JOIN hospital h ON a.hospital_id = h.hospital_id";

        $result = mysqli_query($con, $query);
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>{$row['app_id']}</td>";
            echo "<td>{$row['patient_name']}</td>";
            echo "<td>{$row['test_name']}</td>";
            echo "<td>{$row['hospital_name']}</td>";
            echo "<td>{$row['app_date']}</td>";
            echo "<td>{$row['app_time']}</td>";
            echo "</tr>";
        }
        ?>
        <!-- PHP -->
    </table>
    <script src="https://cdn.usebootstrap.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>

</html>