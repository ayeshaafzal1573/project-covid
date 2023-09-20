<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Approval</title>
</head>

<body>
     <div class="container-fluid d-flex align-items-center" id="add-product" >
            <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mt-5">Add Product</h1>
                <form method="post" enctype="multipart/form-data">
                <?php if (!empty($infomsg)): ?>
                  <div class="alert alert-success mt-4">
                    <?php echo $infomsg; ?>
                  </div>
            <?php endif; ?>
                    <div class="form-group justify-content-center">
                        <input type="text" name="pname" class="form-control" placeholder="Product Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="pprice" class="form-control" placeholder="Product Price" required>
                        </div>
                        <div class="form-group">
                            <select name="pcategory" class="form-control" required>
                                <option value="" disabled selected>Select Category:</option>
                                <option value="cat">Cat</option>
                                <option value="dog">Dog</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="psub-category" class="form-control" required>
                                <option value="" disabled selected>Select Sub-Category:</option>
                                <option value="food">Food</option>
                                <option value="accessory">Accessory</option>
                                <option value="medicine">Medicine</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="file" name="pimage" class="form-control-file" required>
                        </div>
                    <div class="form-group">
                        <input type="submit" name="add" class="btn" value="Add Product">
                    </div>
                    </form>
                </div>
            </div>
    </div>


          </div>
        </div>
      </div>
    <table style="margin-left: 300px;">


        <thead>
            <tr>
                <th>NAME:</th>
                <th>Location:</th>
                <th>Action:</th>
            </tr>
        </thead>
        <tbody>
            <!-- PHP -->
            <?php
            $fetch_hospital = mysqli_query($con, "SELECT * FROM hospital");

            if ($fetch_hospital) {
                while ($hospital = mysqli_fetch_assoc($fetch_hospital)) {
                    echo "<tr>";
                    echo "<td>{$hospital['hospital_name']}</td>";
                    echo "<td>{$hospital['location']}</td>";

                    echo "<td> 
            <a href='hospital_active.php?id={$hospital['hospital_id']}'>
                <button>Approve</button>
            </a>
            <a href='hospital_deactive.php?id={$hospital['hospital_id']}'>
                <button>Reject</button>
            </a>
        </td>";
                    echo "</tr>";
                }
            } else {
                echo "Error: " . mysqli_error($con);
            }
            ?>
            <!-- PHP -->
        </tbody>
    </table>
</body>

</html>