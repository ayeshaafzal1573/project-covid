<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <title>Pandemix</title>
   <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" href="patient.css">
   <link rel="stylesheet" href="../css/responsive.css">
   <link rel="icon" href="../images/covidlogo.png" type="image/gif" />
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
      media="screen">
   <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
</head>

<body class="main-layout">
   <!-- header -->
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
                        <li><a class="active" href="patient.php">Home</a></li>
                        <li><a href="myappointment.php">Appointments</a></li>
                        <li><a href="patient.php" class="logo_midle">Pandemix</a></li>
                        <li><a href="hospitals.php">Hospital</a></li>
                        <li><a href="covidreport.php">Reports</a></li>
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
   <!-- end header -->
   <div class="full_bg">
      <!-- header inner -->
      <div class="section">
         <!-- carousel code -->
         <div id="banner1" class="carousel slide slider_main">
            <div class="carousel-inner">
               <div class="carousel-item active" id="home">
                  <div class="carousel-caption cuplle">
                     <div class="container">
                        <div class="row">
                           <div class="col-md-8">
                              <div class="photog">
                                 <h1>Care early<br>Coronavirus</h1>
                                 <a class="read_more" href="bookappointment.php">Book Appointment</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end banner -->
   <!-- about -->
   <div class="about" id="about">
      <div class="container_width">
         <div class="row d_flex">
            <div class="col-md-7">
               <div class="titlepage text_align_left">
                  <h2>About Corona Virus </h2>
                  <p>English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default
                     model text, and a
                     search for
                  </p>
                  <button class="read_more">Read More</button>
               </div>
            </div>
            <div class="col-md-5">
               <div class="about_img text_align_center">
                  <figure><img src="../images/about.png" alt="#" /></figure>
               </div>
            </div>

         </div>
      </div>
   </div>
   <!-- end about -->
   <!-- coronata -->
   <div class="coronata">
      <div class="container">
         <div class="row d_flex grid">
            <div class="col-md-7">
               <div class="coronata_img text_align_center">
                  <figure><img src="../images/corona.png" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-5 oder1">
               <div class="titlepage text_align_left">
                  <h2>Coronavirus what it is?</h2>
                  <p>when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                     distribution of letters,
                     as opposed to using
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end coronata -->
   <!-- use in doctor page -->
   <div class="cases">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage text_align_center ">
                  <h2>Coronavirus Cases</h2>
                  <p>making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words,
                     combined with a
                     handful</p>
               </div>
            </div>
         </div>
         <div class="row d_flex">
            <div class=" col-md-4">
               <div class="latest text_align_center">
                  <figure><img src="../images/cases1.png" alt="#" /></figure>
                  <div class="nostrud">
                     <h3>Cases 01</h3>
                     <p>It is a long established fact that a reader will be distracted by the readable content of a page
                        when looking at its
                        layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of
                        letters, as opposed to
                        using 'Content here, content here', making it look</p>
                  </div>
               </div>
            </div>
            <div class=" col-md-4">
               <div class="latest text_align_center">
                  <figure><img src="../images/cases2.png" alt="#" /></figure>
                  <div class="nostrud">
                     <h3>Cases 02</h3>
                     <p>It is a long established fact that a reader will be distracted by the readable content of a page
                        when looking at its
                        layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of
                        letters, as opposed to
                        using 'Content here, content here', making it look</p>
                  </div>
               </div>
            </div>
            <div class=" col-md-4">
               <div class="latest text_align_center">
                  <figure><img src="../images/cases3.png" alt="#" /></figure>
                  <div class="nostrud">
                     <h3>Cases 03</h3>
                     <p>It is a long established fact that a reader will be distracted by the readable content of a page
                        when looking at its
                        layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of
                        letters, as opposed to
                        using 'Content here, content here', making it look</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end cases -->
   <!--  footer -->
   <footer>
      <div class="footer">
         <div class="container">
            <div class="row">
               <div class="col-lg-2 col-md-6 col-sm-6">
                  <div class="hedingh3 text_align_left">
                     <h3>USEFUL LINKS</h3>
                     <ul class="menu_footer">
                        <li><a href="patient.php">Home</a>
                        <li>
                        <li><a href="myappointment.php">My Appointment</a>
                        <li>
                        <li> <a href="bookappointment.php">Book Appointment</a>
                        <li>
                        <li> <a href="covidreport.php">My Reports</a>
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
                        <img src="../images/map.png" alt="map" />
                     </div>
                  </div>
               </div>

            </div>
         </div>

      </div>
   </footer>
   <!-- end footer -->
   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
   <script src="js/custom.js"></script>
</body>

</html>