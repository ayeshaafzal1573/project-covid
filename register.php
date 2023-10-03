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
  <link rel="stylesheet" href="assets/css/register.css" />
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="icon" href="assets/images/covidlogo.png">
  <link rel="stylesheet" href="assets/css/responsive.css">
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
                <li><a href="index.php#contact">Contact </a></li>
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
          <input type="submit" value="Register" name="submit" onclick="return validateForm();">
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
          <input type="submit" value="Register" name="submit" onclick="return validateForm();">
        </div>
        <!-- Patient Fields -->
        <div id="patientFields" style="display: none;">
          <input type="text" id="patient_name" name="patient_name" placeholder="Patient Name"><br><br>
          <input type="text" name="address" placeholder="Patient Address"><br><br>
          <input type="text" name="email" placeholder="Patient Email"><br><br>
          <input type="password" name="patient_password" placeholder="Patient Password"><br><br>
          <input type="submit" value="Register" name="submit" onclick="return validateForm();"><br><br>
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
        //ADMIN
        if ($userType === "Admin") {
          $adminusername = $_POST["username"];
          $adminemail = $_POST["admin_email"];
          $adminpassword = $_POST["admin_password"];
          $hashedPassword = password_hash($adminpassword, PASSWORD_DEFAULT);
          $query = "INSERT INTO admin (username, email, password) VALUES ('$adminusername', '$adminemail', '$hashedPassword')";
        }
        //PATIENT
        elseif ($userType === "Patient") {
          $patientname = $_POST["patient_name"];
          $patientaddress = $_POST["address"];
          $patientemail = $_POST["email"];
          $patientpassword = $_POST["patient_password"];
          $hashedPassword = password_hash($patientpassword, PASSWORD_DEFAULT);
          $query = "INSERT INTO patient (patient_name, address, email, password) VALUES ('$patientname', '$patientaddress', '$patientemail', '$hashedPassword')";
        }
        //HOSPITAL
        elseif ($userType === "Hospital") {
          $hospitalname = $_POST["hospital_name"];
          $hospitallocation = $_POST["location"];
          $hospitalpassword = $_POST["hospital_password"];
          $hashedPassword = password_hash($hospitalpassword, PASSWORD_DEFAULT);
          $query = "INSERT INTO hospital (hospital_name, location, password,status,approval_status) 
              VALUES ('$hospitalname', '$hospitallocation', '$hashedPassword',0,'Pending')";
        }

        if (mysqli_query($con, $query)) {
          echo "<script>alert('Admin will approve your request');</script>";
        } else {
          echo "Error: " . mysqli_error($con);
        }
      }
    }
    ?>
    <!-- PHP END -->

  </section>
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
                <img src="assets/images/map.png" alt="map" />
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
    function validateForm() {
      var userType = document.getElementById("user_type").value;
      var isValid = true;
      var username = document.getElementById("username").value;
      var email = document.getElementById("admin_email").value;
      var password = document.getElementById("admin_password").value;
      if (username === "" || email === "" || password === "") {
        alert("Username, Email, and Password are required fields.");
        isValid = false;
      } else if (!isEmailValid(email)) {
        alert("Invalid email format.");
        isValid = false;
      } else if (!isPasswordValid(password)) {
        alert("Password must contain at least one lowercase letter, one uppercase letter, and be at least 8 characters long.");
        isValid = false;
      }
      if (userType === "Hospital") {
        var hospitalName = document.getElementById("hospital_name").value;
        var location = document.getElementById("location").value;
        var hospitalPassword = document.getElementById("hospital_password").value;

       else if (hospitalName === "" || location === "" || hospitalPassword === "") {
          alert("Hospital Name, Location, and Password are required fields.");
          isValid = false;
        } else if (!isPasswordValid(hospitalPassword)) {
          alert("Hospital Password must contain at least one lowercase letter, one uppercase letter, and be at least 8 characters long.");
          isValid = false;
        }
      } else if (userType === "Patient") {
        var patientName = document.getElementById("patient_name").value;
        var address = document.getElementById("address").value;
        var patientEmail = document.getElementById("email").value; // Assuming you renamed the input field
        var patientPassword = document.getElementById("patient_password").value;

        if (patientName === "" || address === "" || patientEmail === "" || patientPassword === "") {
          alert("Patient Name, Address, Email, and Password are required fields.");
          isValid = false;
        } else if (!isPasswordValid(patientPassword)) {
          alert("Patient Password must contain at least one lowercase letter, one uppercase letter, and be at least 8 characters long.");
          isValid = false;
        }
      }

      return isValid;
    }
    function isEmailValid(email) {
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }
    function isPasswordValid(password) {
      // Password must contain at least one lowercase letter, one uppercase letter, and be at least 8 characters long
      var lowercaseRegex = /[a-z]/;
      var uppercaseRegex = /[A-Z]/;
      return lowercaseRegex.test(password) && uppercaseRegex.test(password) && password.length >= 8;
    }
  </script>
  <script src="assets/script.js"></script>

</body>

</html>