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
    <title>Patient Vaccination Status</title>
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
    <!-- FORM STARTS -->
    <!-- PHP -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patient_id = $_POST['patient_id'];
        $selected_vac_id = $_POST['vaccination'];
        $query = "SELECT `vac_name` FROM `vaccination` WHERE `vac_id` = $selected_vac_id";
        $result = $con->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $selected_vac_name = $row['vac_name'];
            $sql = "INSERT INTO `patient_vaccination_table` (`patient_id`, `vac_id`, `vac_suggest`)
                    VALUES ($patient_id, $selected_vac_id, '$selected_vac_name')";

            if ($con->query($sql) === TRUE) {
                echo '<script>alert("Vaccination successfully recorded.");</script>';
            } else {
                echo '<script>alert("Error: ' . $sql . '\n' . $con->error . '");</script>';
            }
        } else {
            echo '<script>alert("Selected vaccination not found.");</script>';
        }
    }

    $hospital_id = $_SESSION['hospital_id'];


    $sql = "SELECT  a.`patient_id`, p.`patient_name`, v.`vac_id`, v.`vac_name`
            FROM `appointment` a
            INNER JOIN `vaccination` v ON v.`hospital_id` = a.`hospital_id`
            INNER JOIN `patient` p ON a.`patient_id` = p.`patient_id`
            WHERE a.`hospital_id` = $hospital_id
            AND a.`status` = 1
            AND v.`vac_status` = 'Available'";

    $result = mysqli_query($con,$sql);
    // $patients = $result->fetch_all(MYSQLI_ASSOC);

    // $con->close();
    ?>

    <!-- PHP -->
    <h1 class="add-vaccine">Patient Vaccination</h1>
    <form method="POST" style="margin-left: 400px; width:50%;">
        <label for="patient_id">Select Patient:</label>
        <select name="patient_id" id="availability_status">
            <!-- PHP -->
            <?php
    
                foreach ($result as $client) {

               
                    echo "<option>" . $client['patient_name'] . "</option>";
                }
           
            ?>
        </select><br><br>

        <label for="vaccination">Select Vaccination:</label>
        <select name="vaccination" id="availability_status">
            <!-- PHP -->
            <?php
          
                foreach ($result as $client) {
                    echo "<option >" . $client['vac_name'] . "</option>";
                }
        ?>
        </select><br>

        <input type="submit" value="Submit" class="btn-vaccine">
    </form>
</body>
<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>