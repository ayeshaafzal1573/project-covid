<?php
//Database Connection
include("connection.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
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
      <header>Signup</header>
      <form action="register.php" method="post">
        <label for="user_type">User Type:</label>
        <select id="user_type" name="user_type" onchange="showFields(this.value)" required class="usertype">
          <option value="">Select User Type</option>
          <option value="Admin">Admin</option>
          <option value="Hospital">Hospital</option>
          <option value="Patient">Patient</option>
        </select>


        <!-- Admin Fields -->
        <div id="adminFields" style="display: none;" class="form signup">
          <input type="text" name="username" placeholder="Username"><br><br>
          <input type="text" name="admin_email" placeholder="Email"><br><br>
          <input type="password" name="admin_password" placeholder="Password"><br><br>
          <input type="submit" value="Register" name="submit">

        </div>

        <!-- Hospital Fields -->
        <div id="hospitalFields" style="display: none;">
          <input type="text" name="hospital_name" placeholder="Hospital Name"><br><br>
          <select name="location" class="location">
            <option value="Karachi">Karachi</option>
            <option value="Lahore">Lahore</option>
            <option value="Islamabad">Islamabad</option>
            <option value="Multan">Multan</option>
          </select><br><br>
          <input type="password" name="hospital_password" placeholder="Password"><br><br>
          <button class="hbtn"> <a href="hospital/approcess.php">Register</button></a>
        </div>

        <!-- Patient Fields -->
        <div id="patientFields" style="display: none;">
          <input type="text" id="patient_name" name="patient_name" placeholder="Patient Name"><br><br>
          <input type="text" name="address" placeholder="Patient Address"><br><br>
          <input type="text" name="email" placeholder="Patient Email"><br><br>
          <input type="password" name="patient_password" placeholder="Patient Password"><br><br>
          <input type="submit" value="Register" name="submit"><br><br>

        </div>
      </form>
    </div>

    <div class="form login">
      <header><a href="login.php">Login</header></a>
    </div>

    <!-- PHP -->
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $userType = $_POST["user_type"];
      if (isset($_POST['submit'])) {
        // Process the form data based on user type
        if ($userType === "Admin") {
          $adminusername = $_POST["username"];
          $adminemail = $_POST["admin_email"];
          $adminpassword = $_POST["admin_password"];
          $query = "INSERT INTO admin (username, email, password) VALUES ('$adminusername', '$adminemail', '$adminpassword')";

          // Perform admin registration
        } elseif ($userType === "Hospital") {
          $hospitalname = $_POST["hospital_name"];
          $hospitallocation = $_POST["location"];
          $hospitalpassword = $_POST["hospital_password"];
          $query = "INSERT INTO hospital (hospital_name, location, password) VALUES ('$hospitalname', '$hospitallocation', '$hospitalpassword')";

          // Perform hospital registration
        } elseif ($userType === "Patient") {
          $patientname = $_POST["patient_name"];
          $patientaddress = $_POST["address"];
          $patientemail = $_POST["email"];
          $patientpassword = $_POST["patient_password"];
          $query = "INSERT INTO patient (patient_name, address, email, password) VALUES ('$patientname', '$patientaddress', '$patientemail', '$patientpassword')";
        }

        // Execute the query
        if (mysqli_query($con, $query)) {
          echo '<script>window.location.href = "login.php";</script>';
        } else {
          echo "Error: " . mysqli_error($con);
        }
      }
    }
    ?>
    <script>
      const wrapper = document.querySelector(".wrapper"),
        signupHeader = document.querySelector(".signup header"),
        loginHeader = document.querySelector(".login header");

      loginHeader.addEventListener("click", () => {
        wrapper.classList.add("active");
      });
      signupHeader.addEventListener("click", () => {
        wrapper.classList.remove("active");
      });
    </script>
    <script src="script.js"></script>
  </section>
</body>

</html>