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
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="images/covidlogo.png">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
</head>

<body>
  <header class="header-area">
    <div class="right">
      <a href="register.php"><i class="fa fa-user" aria-hidden="true"></i></a>
    </div>
    <div class="container">
      <div class="row d_flex">
        <div class="col-sm-3 logo_sm">
          <div class="logo">
            <a href="index.php"></a>
          </div>
        </div>
        <div class="col-lg-10 offset-lg-1 col-md-12 col-sm-9">
          <div class="navbar-area">
            <nav class="site-navbar">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php#about">About</a></li>
                <li><a href="index.php" class="logo_midle">Pandemix</a></li>
                <li><a href="index.php#action">Actions</a></li>
                <li><a href="contact.php">Contact </a></li>
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
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Variable for user type from dropdown
      $userType = $_POST["user_type"];

      if ($userType === "Admin") {
        $username = $_POST["username"];
        $password = $_POST["admin_password"];

        // Prepare and execute a query using prepared statements
        $query = "SELECT admin_id, password FROM admin WHERE username = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $admin_id, $hashedPassword);

        if (mysqli_stmt_fetch($stmt) && password_verify($password, $hashedPassword)) {
          $_SESSION['admin_id'] = $admin_id;
          $_SESSION['username'] = $username;
          header("location: admin/admin.php");
          exit;
        } else {
          echo "<script>alert('Invalid admin name or password');</script>";
        }

        mysqli_stmt_close($stmt);
      } elseif ($userType === "Patient") {
        $patientEmail = $_POST["patient_email"];
        $password = $_POST["patient_password"];

        // Prepare and execute a query using prepared statements
        $query = "SELECT patient_id, patient_name, password FROM patient WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $patientEmail);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $patient_id, $patient_name, $hashedPassword);

        if (mysqli_stmt_fetch($stmt) && password_verify($password, $hashedPassword)) {
          $_SESSION['patient_id'] = $patient_id;
          $_SESSION['patient_name'] = $patient_name;
          header("location: patient/patient.php");
          exit;
        } else {
          echo "<script>alert('Invalid email name or password');</script>";
        }

        mysqli_stmt_close($stmt);
      }
    }

    // Hospital login code
    if (isset($_POST["login_submit"])) {
      $hospitalName = $_POST["hospital_name"];
      $password = $_POST["hospital_password"];
      // Prepare and execute a query using prepared statements
      $query = "SELECT hospital_id, hospital_name, approval_status, password FROM hospital WHERE hospital_name = ?";
      $stmt = mysqli_prepare($con, $query);
      mysqli_stmt_bind_param($stmt, "s", $hospitalName);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $hospital_id, $hospital_name, $approval_status, $hashedPassword);

      if (mysqli_stmt_fetch($stmt) && password_verify($password, $hashedPassword)) {
        if ($approval_status == 'Approved') {
          $_SESSION['hospital_id'] = $hospital_id;
          $_SESSION['hospital_name'] = $hospital_name;
          header("location: hospital/index.php");
          exit;
        } else {
          echo "<script>alert('Admin has rejected your request');</script>";
        }
      } else {
        echo "<script>alert('Invalid hospital name or password');</script>";
      }

      mysqli_stmt_close($stmt);
    }
    ?>
    <!-- PHP END -->

  </section>
  <!-- PHP -->
  <!--  footer -->
  <footer>
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="hedingh3 text_align_left">
              <h3>USEFUL LINKS</h3>
              <ul class="menu_footer">
                <li><a href="index.php">Home</a>
                <li>
                <li><a href="index.php#about">About</a>
                <li>
                <li> <a href="contact.php">Contact</a>
                <li>

              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="hedingh3 text_align_left">
              <h3>About</h3>
              <p>
                We are committed to delivering the latest news, health guidelines, and resources from reputable
                sources.
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="hedingh3  text_align_left">
              <h3>Contact Us</h3>
              <ul class="top_infomation">
                <li><i class="fa fa-phone" aria-hidden="true"></i>
                  <a href="tel:111-222-333">+92-343-209872</a>
                </li>
                <li><i class="fa fa-envelope" aria-hidden="true"></i>
                  <a href="mailto:ayeshaafzal1573@gmail.com">info@pandemix.com</a>
                </li>
                <li> <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <a href="https://www.google.com/maps/@24.8847152,67.1775322,15z?entry=ttu">Pandemix
                    Hospital,Karachi</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="hedingh3 text_align_left">
              <h3>Location</h3>
              <div class="map">
                <img src="images/map.png" alt="map" />
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </footer>
  <!-- end footer -->
  <!-- JAVASCRIPT -->
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
    function showLoginAlert(message) {
      var loginAlert = document.getElementById("login-alert");
      var alertMessage = document.getElementById("alert-message");
      alertMessage.innerText = message;
      loginAlert.style.display = "block";
    }
    if (typeof loginSuccess !== 'undefined' && loginSuccess === false) {
      showLoginAlert("Invalid email or password.");
    }
  </script>
</body>

</html>