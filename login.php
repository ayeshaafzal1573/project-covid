<?php
include('connection.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Login</title>
</head>

<body>
    <h2>User Login</h2>
    <form method="post">
        <label for="user_type">User Type:</label>
        <select id="user_type" name="user_type" onchange="showFields(this.value)" required>
            <option value="">Select User Type</option>
            <option value="Admin">Admin</option>
            <option value="Hospital">Hospital</option>
            <option value="Patient">Patient</option>
        </select><br><br>

        <!-- Admin Fields -->
        <div id="adminFields" style="display: none;">
            <label for="username">Admin Username:</label>
            <input type="text" name="username"><br><br>

            <label for="admin_password">Admin Password:</label>
            <input type="password" name="admin_password"><br><br>
            <input type="submit" value="Login">

        </div>

        <!-- Hospital Fields -->
        <div id="hospitalFields" style="display: none;">
            <label for="hospital_name">Hospital Name:</label>
            <input type="text" name="hospital_name"><br><br>

            <label for="hospital_password">Password:</label>
            <input type="password" name="hospital_password"><br><br>
            <input type="submit" value="Login">

        </div>

        <!-- Patient Fields -->
        <div id="patientFields" style="display: none;">
            <label for="patient_email">Email:</label>
            <input type="text" name="patient_email"><br><br>

            <label for="patient_password">Password:</label>
            <input type="password" name="patient_password"><br><br>
            <input type="submit" value="Login">

        </div>

    </form>
    <?php if (isset($loginError)) { ?>
        <p>
            <?php echo $loginError; ?>
        </p>
        <?php
    }
    ?>
    <script src="script.js"> </script>
    <!-- PHP -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //variable of dropdown
        $userType = $_POST["user_type"];

        if ($userType === "Admin") {
            $username = $_POST["username"];
            $password = $_POST["admin_password"];

            $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) == 1) {
                header("Location: admin/admin.php");
                exit;
            } else {
                $loginError = "Invalid username or password.";
            }
        }
        //Hospital Login
        elseif ($userType === "Hospital") {
            $hospitalName = $_POST["hospital_name"];
            $password = $_POST["hospital_password"];

            // Check if the hospital's approval status is not 'Rejected'
            $approvalQuery = "SELECT approval_status FROM hospital WHERE hospital_name = '$hospitalName'";
            $approvalResult = mysqli_query($con, $approvalQuery);

            if (mysqli_num_rows($approvalResult) == 1) {
                $approvalRow = mysqli_fetch_assoc($approvalResult);
                $approvalStatus = $approvalRow["approval_status"];

                if ($approvalStatus !== 'Rejected') {
                    $loginQuery = "SELECT * FROM hospital WHERE hospital_name = '$hospitalName' AND password = '$password'";
                    $loginResult = mysqli_query($con, $loginQuery);

                    if (mysqli_num_rows($loginResult) == 1) {
                        header("Location: hospital/hospital.php");
                        exit;
                    } else {
                        $loginError = "Your registration request has been rejected by the admin.";
                    }
                }
            }
        }
        //Patient Login
        elseif ($userType === "Patient") {

            $patientEmail = $_POST["patient_email"];
            $password = $_POST["patient_password"];

            $query = "SELECT * FROM patient WHERE email = '$patientEmail' AND password = '$password'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) == 1) {
                header("Location: patient.php");
                exit;

            } else {
                $loginError = "Invalid email or password.";
            }
        }
    }
    ?>

</body>

</html>