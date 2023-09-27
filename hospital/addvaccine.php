<?php
// Database Connection
include("../connection.php");
// Session Start
session_start();
//if user loggout
if (!isset($_SESSION['hospital_id'])) {
    header("Location: ../login.php");
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vaccine</title>
    <link rel="stylesheet" href="../admin/assets/style.css">
    <link rel="icon" href="../images/covidlogo.png">
    <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>


<body>
    <!-- SIDEBAR -->
    <div id="sidebar">
        <header>
            <a href="#"><img src="../images/covidlogo.png" alt="" style="width:120px ; height:120;padding: 20px;"></a>
        </header>
        <ul class="nav">
            <li>
                <a href="patientlist.php">
                    <i class="zmdi zmdi-account"></i>Patients
                </a>
            </li>
            <li>
                <a href="patientappointment.php">
                    <i class="zmdi zmdi-calendar"></i>Patient Appointment
                </a>
            </li>
            <li>
                <a href="addvaccine.php">
                    <i class="zmdi zmdi-plus"></i>Add Vaccination
                </a>
            </li>
            <li>
                <a href="vacstatus.php">
                    <i class="zmdi zmdi-hospital"></i>Vaccination
                </a>
            </li>
            <li>
                <a href="patientvacstatus.php">
                    <i class="fas fa-syringe"></i> Patient Vaccination
                </a>
            </li>
        </ul>

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
                        <img src="../images/hospitaluser.png" alt="Admin Profile" class="adminpic">
                        <?php echo $_SESSION['hospital_name']; ?> <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="../logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- NAV ENDS -->
    <!-- TABLE STARTS -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $vaccineName = $_POST['vaccine_name'];
        $availabilityStatus = $_POST['availability_status'];
        $hospitalId = $_SESSION['hospital_id'];
        $query = "INSERT INTO vaccination (hospital_id, vac_name, vac_status)
              VALUES ($hospitalId, '$vaccineName', '$availabilityStatus')";
        echo "SQL Query: $query<br>";

        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<script>alert('Vaccine data inserted successfully');</script>";
        } else {
            echo "<script>alert('Error inserting vaccine data: " . mysqli_error($con) . "');</script>";
        }
    }
    ?>
    <!-- Form to insert vaccine data -->
    <h1 class="add-vaccine">ADD VACCINATION</h1>
    <form method="POST" style="margin-left: 400px; width:50%;">
        <div class="form-group">
            <label for="vaccine_name">Vaccine Name:</label>
            <input type="text" class="form-control" id="vaccine_name" name="vaccine_name">
        </div>
        <div class="form-group">
            <label for="availability_status">Availability Status:</label>
            <select class="form-control" id="availability_status" name="availability_status">
                <option class="Available" value="Available">Available</option>
                <option class="Unavailable" value="Unavailable">Unavailable</option>
            </select>
        </div>
        <button type="submit" class="btn-vaccine">Insert Vaccine Data</button>
    </form>



    <!-- TABLE END -->

</body>
<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>

</body>

</html>