<!-- Main content -->
<title>Home - Covid-Care</title>
<section class="content text-dark">
    <div class="container-fluid">
        <h1 class="text-light">Covid Test and Vaccination System</h1>
        <hr class="border-light">
        <div class="row">
            <!-- start -->
            <div class="col-sm-4">
                <div class="card mb-5 text-center" style="width: 18rem;box-shadow:  0 8px 50px rgba(0,0,0,0.2);">
                    <img src="../assets/img/medical.jpg" style="height:280px;" class="card-img-top" alt="...">
                    <div class="card-body" style="background-color:rgb(49, 49, 110);">
                        <strong>
                            <h4 class="card-text" style="color:white;">Vaccine Listed :
                                <?php


                                $selectquery = "SELECT vaccines.vac_name,users.username,vaccines.status
                   FROM
                   users
                   JOIN
                   vaccines
                   ON
                   users.user_id = vaccines.h_id";


                                $query = mysqli_query($con, $selectquery);
                                $count = mysqli_num_rows($query);
                                echo $count;
                                ?>

                            </h4>
                        </strong>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mb-5 text-center" style="width: 18rem;box-shadow:  0 8px 50px rgba(0,0,0,0.2);">
                    <img src="../assets/img/location.jpg" style="height:280px;" class="card-img-top" alt="...">
                    <div class="card-body" style="background-color:rgb(49, 49, 110);">
                        <strong>
                            <h4 class="card-text" style="color:white;">Vaccination Center :
                                <?php


                                $selectquery1 = "select * from vaccination where status = '1'";


                                $query1 = mysqli_query($con, $selectquery1);
                                $count1 = mysqli_num_rows($query1);
                                echo $count1;
                                ?>


                            </h4>
                        </strong>
                    </div>
                </div>
            </div>
            
            </div>
            <!-- end -->
            <div class="container">

            </div>
        </div>
</section>
