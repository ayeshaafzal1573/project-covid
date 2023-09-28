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
    <title>Patient Appointment</title>
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
    <div class="container-fluid" id="all-products">
        <h1 class="text-center">Patient Appointments</h1>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Hospital Name</th>
                        <th>Appointment Date</th>
                        <th>Test Name</th>
                        <th>Test Result</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP -->
                    <?php
                    $hospital_id = $_SESSION['hospital_id'];
                    $query = "SELECT a.*, p.patient_name FROM appointment a JOIN patient p ON a.patient_id = p.patient_id WHERE a.approval_status = 'Approved' AND a.hospital_id = $hospital_id";
                    $result = mysqli_query($con, $query);

                    if (!$result) {
                        die("Error executing the query: " . mysqli_error($con));
                    }

                    while ($row = mysqli_fetch_assoc($result)):
                        $patient_id = $row['patient_id'];

                        $patient_query = "SELECT patient_name FROM patient WHERE patient_id = $patient_id";
                        $patient_result = mysqli_query($con, $patient_query);

                        $hospital_query = "SELECT hospital_name FROM hospital WHERE hospital_id = $hospital_id";
                        $hospital_result = mysqli_query($con, $hospital_query);

                        if ($patient_result && $hospital_result):
                            $patient_data = mysqli_fetch_assoc($patient_result);
                            $hospital_data = mysqli_fetch_assoc($hospital_result);

                            $patient_name = $patient_data['patient_name'];
                            $hospital_name = $hospital_data['hospital_name'];
                            ?>
                            <tr data-appid="<?= $row['app_id'] ?>">
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
                                    <?= $row['test_name'] ?>
                                </td>
                                <td>
                                    <button class="positive-button btn btn-success"
                                        data-appid="<?= $row['app_id'] ?>">Positive</button>
                                    <button class="negative-button btn btn-danger"
                                        data-appid="<?= $row['app_id'] ?>">Negative</button>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Error fetching data.</td>
                            </tr>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <!-- PHP -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script>
    $(document).ready(function () {
        $(".positive-button, .negative-button").on("click", function () {
            var app_id = $(this).data("appid");
            var isPositive = $(this).hasClass("positive-button");
            var url = isPositive ? "test_active.php" : "test_deactive.php";
            
            console.log("Sending AJAX request to: " + url);

            $.post(url, { app_id: app_id }, function (data) {
                console.log("Response received: " + data);

                if (data === "success") {
                    $("tr[data-appid='" + app_id + "']").remove();
                } else {
                    console.error("Error occurred.");
                }
            });
        });
    });

</script>



</body>

</html>