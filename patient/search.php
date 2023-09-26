<?php
// Include the database connection
include("../connection.php");

// Get the search query from the AJAX request
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Perform the SQL query to search for hospitals
$sql = "SELECT * FROM hospital WHERE hospital_name LIKE '%$search%'";
$result = $con->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Loop through the results and display them in cards
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">' . $row['hospital_name'] . '</h5>
                    <p class="card-text">Location: ' . $row['location'] . '</p>
                    <p class="card-text">Status: ' . ($row['status'] ? 'Active' : 'Inactive') . '</p>
                    <p class="card-text">Approval Status: ' . $row['approval_status'] . '</p>
                </div>
            </div>
        </div>';
    }
} else {
    echo '<div class="col-12"><p>No hospitals found.</p></div>';
}
$con->close();
?>