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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../admin/assets/style.css">
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
                        <?php echo $_SESSION['hospital_id']; ?> <span class="caret"></span>
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
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $vaccineName = $_POST['vaccine_name'];
        $availabilityStatus = $_POST['availability_status'];
        $hospitalId = $_SESSION['hospital_id'];


        // Insert the data into the vaccination table
        $query = "INSERT INTO vaccination (hospital_id, vac_name, vac_status)
              VALUES ($hospitalId, '$vaccineName', '$availabilityStatus')";

        // Debug: Print the query to check if it looks correct
        echo "SQL Query: $query<br>";

        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<script>alert('Vaccine data inserted successfully');</script>";
        } else {
            echo "<script>alert('Error inserting vaccine data: " . mysqli_error($con) . "');</script>";
        }
    }
    ?>


    <!-- ... Rest of your HTML code ... -->

    <!-- Form to insert vaccine data -->
    <form method="POST">
        <div class="form-group">
            <label for="vaccine_name">Vaccine Name:</label>
            <input type="text" class="form-control" id="vaccine_name" name="vaccine_name" required>
        </div>
        <div class="form-group">
            <label for="availability_status">Availability Status:</label>
            <select class="form-control" id="availability_status" name="availability_status" required>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Insert Vaccine Data</button>
    </form>



    <!-- TABLE END -->

</body>
<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>

</body>

</html>