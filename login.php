<?php
//Database Connection
include("connection.php");
// Session Start
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="css/register.css" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Responsive-->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- fevicon -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
    media="screen">
  <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
</head>

<body>
  <header class="header-area">
    <div class="left">
      <a href="Javascript:void(0)"><i class="fa fa-search" aria-hidden="true"></i></a>
    </div>
    <div class="right">
      <a href="register.html"><i class="fa fa-user" aria-hidden="true"></i></a>
    </div>
    <div class="container">
      <div class="row d_flex">
        <div class="col-sm-3 logo_sm">
          <div class="logo">
            <a href="index.html"></a>
          </div>
        </div>
        <div class="col-lg-10 offset-lg-1 col-md-12 col-sm-9">
          <div class="navbar-area">
            <nav class="site-navbar">
              <ul>
                <li><a class="active" href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="index.html" class="logo_midle">Pandemix</a></li>
                <li><a href="#action">Actions</a></li>
                <li><a href="contact.html">Contact </a></li>
              </ul>
              <button class="nav-toggler">
                <span></span>
              </button>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
  <section class="wrapper">
    <div class="form signup">
      <header>Login</header>
      <form method="post">
        <label for="user_type">User Type:</label>
        <select id="user_type" name="user_type" onchange="showFields(this.value)" required class="usertype">
          <option value="">Select User Type</option>
          <option value="Admin">Admin</option>
          <option value="Hospital">Hospital</option>
          <option value="Patient">Patient</option>
        </select><br><br>

        <!-- Admin Fields -->
        <div id="adminFields" style="display: none;">
          <input type="text" name="username" placeholder="Admin Username"><br><br>
          <input type="password" name="admin_password" placeholder="Admin Password"><br><br>
          <input type="submit" value="Login">

        </div>

        <!-- Hospital Fields -->
        <div id="hospitalFields" style="display: none;">
          <input type="text" name="hospital_name" placeholder="Hospital Name"><br><br>
          <input type="password" name="hospital_password" placeholder="Password"><br><br>
          <input type="submit" value="Login" name="login_submit">

        </div>

        <!-- Patient Fields -->
        <div id="patientFields" style="display: none;">
          <input type="text" name="patient_email" placeholder="Patient Email"><br><br>
          <input type="password" name="patient_password" placeholder="Password"><br><br>
          <input type="submit" value="Login">

        </div>

      </form>
    </div>

    <div class="form login">
      <header><a href="register.php">Register</header></a>
    </div>

    <!-- PHP -->
    <?php if (isset($loginError)) { ?>
      <p>
        <?php echo $loginError; ?>
      </p>
      <?php
    }
    ?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      //variable of dropdown
      $userType = $_POST["user_type"];

      if ($userType === "Admin") {
        $username = $_POST["username"];
        $password = $_POST["admin_password"];

        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

        if (mysqli_num_rows(mysqli_query($con, $query))) {
          $fetch_id = "SELECT admin_id FROM admin WHERE username='$username'";
          $result = mysqli_query($con, $fetch_id);
          $row = mysqli_fetch_array($result);
          $_SESSION['admin_id'] = $row['admin_id'];
          header("location: admin/admin.php");
          exit;
        } else {
          $loginError = "Invalid email or password.";
          echo "<script>var loginSuccess = false;</script>";
        }
      }

      //Patient Login
      elseif ($userType === "Patient") {
        $patientEmail = $_POST["patient_email"];
        $password = $_POST["patient_password"];
        $query = "SELECT * FROM patient WHERE email = '$patientEmail' AND password = '$password'";

        if (mysqli_num_rows(mysqli_query($con, $query))) {
          $fetch_id = "SELECT patient_id FROM patient WHERE email='$patientEmail'";
          $result = mysqli_query($con, $fetch_id);
          $row = mysqli_fetch_array($result);
          $_SESSION['patient_id'] = $row['patient_id'];
          header("location: patient/patient.php");
          exit;
        } else {
          $loginError = "Invalid email or password.";
          echo "<script>var loginSuccess = false;</script>";
        }
      }
    }
    ?>
    <!-- Hospital Login -->
    <?php
    if (isset($_POST["login_submit"])) {
      $hospitalName = $_POST["hospital_name"];
      $password = $_POST["hospital_password"];
      $query = "SELECT * FROM hospital WHERE hospital_name='$hospitalName' AND password='$password'";
      $login_query = mysqli_query($con, $query);

      if ($login_query && mysqli_num_rows($login_query) > 0) {
        $check_login = mysqli_fetch_assoc($login_query);

        if ($check_login['status'] == 1) {

          $_SESSION['hospital_id'] = $check_login['hospital_id'];

          echo "<script>alert('Login successful');</script>";
          header("location: hospital/patientlist.php");
          exit;
        } else {
          echo "<script>alert('Admin has rejected your request');</script>";
        }
      }
    }
    ?>

    <!-- PHP -->
    <script>
      loginHeader.addEventListener("click", () => {
        wrapper.classList.add("active");
      });
      signupHeader.addEventListener("click", () => {
        wrapper.classList.remove("active");
      });
    </script>
    <script src="script.js"></script>
    <script>
      // JavaScript function to show the login alert
      function showLoginAlert(message) {
        var loginAlert = document.getElementById("login-alert");
        var alertMessage = document.getElementById("alert-message");
        alertMessage.innerText = message;
        loginAlert.style.display = "block";
      }

      // Check if login was unsuccessful and display an alert
      if (typeof loginSuccess !== 'undefined' && loginSuccess === false) {
        showLoginAlert("Invalid email or password.");
      }
    </script>

  </section>
</body>

</html>