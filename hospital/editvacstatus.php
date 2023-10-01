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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vaccine Status</title>
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
                        <li><a href="index.php"><i class="fas fa-home"></i>Back To Home</a></li>
                        <li><a href="../logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- NAV ENDS -->
    <!-- PHP -->
    <?php
    if (isset($_GET['vac_id'])) {
        $vac_id = $_GET['vac_id'];
        $query = "SELECT vac_id, vac_name, vac_status FROM vaccination WHERE hospital_id = {$_SESSION['hospital_id']} AND vac_id = $vac_id";
        $result = mysqli_query($con, $query);

        if ($result && $row = mysqli_fetch_assoc($result)) {
            $vac_name = $row['vac_name'];
            $vac_status = $row['vac_status'];
        } else {
            echo "Vaccination ID not found.";
            exit;
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newStatus = $_POST['new_status'];
        $updateQuery = "UPDATE vaccination SET vac_status = '$newStatus' WHERE vac_id = $vac_id AND hospital_id = {$_SESSION['hospital_id']}";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            header("Location: vacstatus.php");
            exit;
        } else {
            echo "Error updating vaccination status: " . mysqli_error($con);
        }
    }
    ?>
    <!-- PHP -->
    <!-- FORM -->
    <h1 class="add-vaccine">Add Vaccination</h1>
    <form method="POST" style="margin-left: 400px; width:50%;">


        <label>New Status:</label>
        <select class="form-control" id="new_status" name="new_status">
            <option value="Available" <?php if ($vac_status === 'Available')
                echo 'selected'; ?>>Available</option>
            <option value="Unavailable" <?php if ($vac_status === 'Unavailable')
                echo 'selected'; ?>>Unavailable
            </option>
        </select>

        <button type="submit" class="btn-vaccine">Update Status</button>
    </form>
    <!-- FORM END -->

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</body>

</html>