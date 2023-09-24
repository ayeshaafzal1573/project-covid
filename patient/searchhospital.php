<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Search</title>
</head>

<body>
    <h1>Hospital Search</h1>
  <form id="searchForm">
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required><br>

    <label for="hospital_type">Hospital Type:</label>
    <select id="hospital_type" name="hospital_type"> 
        <option value="covid19">COVID-19</option>
        <option value="vaccination">Vaccination</option>
    </select><br>

    <button type="submit">Search</button>
</form>
    <div id="searchResults">
        <!-- Display search results here -->
    </div>

    <script src="../search.js"></script>

</body>

</html>
<?php
include("../connection.php");
$location = $_GET["location"];
$hospitalType = $_GET["hospital_type"]; 
$query = "SELECT * FROM `hospital` WHERE `location` LIKE '%$location%' AND `hospital_name` = '$hospitalType'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($con));
}

// Process and display search results
while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>Name: " . $row["hospital_name"] . "</p>";
    echo "<p>Location: " . $row["location"] . "</p>";
    echo "<hr>";
}

mysqli_close($con);
?>
