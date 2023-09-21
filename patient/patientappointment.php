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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital Details</title>
  <link rel="stylesheet" href="../admin/assets/style.css">
  <link rel="icon" href="../images/corona_icon.png">
  <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

  
  <!-- TABLE STARTS -->
  <div class="container-fluid"  >
    <h1 class="text-center">My Appointment</h1>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
              <th>Patient Name</th>
                <th>Hospital Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
          </tr>
        </thead>
        <tbody>
          <!-- PHP -->
     <?php
if (isset($_SESSION['patient_id'])) {
    $patient_id = $_SESSION['patient_id'];

    $query = "SELECT appointment.app_date, appointment.app_time, patient.patient_name, hospital.hospital_name
        FROM appointment
        JOIN patient ON appointment.patient_id = patient.patient_id
        JOIN hospital ON appointment.hospital_id = hospital.hospital_id
        WHERE appointment.patient_id = $patient_id";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error executing the query: " . mysqli_error($con));
    }
    ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td>
                    <?= $row['patient_name'] ?>
                </td>
                <td>
                    <?= $row['hospital_name'] ?>
                </td>
                <td>
                    <?= $row['app_date'] ?>
                </td>
                <td>
                    <?= $row['app_time'] ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php
} else {
    echo "Patient not logged in.";
}
?>

          <!-- PHP END -->
        </tbody>
      </table>
    </div>
  </div>
  <!-- TABLE END -->
  <!-- SCRIPTS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

