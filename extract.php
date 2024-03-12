<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values of usergender and totalincome from the form
    $usergender = $_POST["usergender"];
    $totalincome = $_POST["totalincome"];

    // Database connection setup
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "taxcollection";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Define variables to store the query range
    $startId = 1;
    $endId = 5;

    // Determine the query range based on totalincome
    if ($totalincome > 800000 && $totalincome <= 2000000) {
        $startId = 6;
        $endId = 10;
    } elseif ($totalincome > 2000000 && $totalincome <= 4000000) {
        $startId = 11;
        $endId = 15;
    } elseif ($totalincome > 4000000) {
        $startId = 16;
        $endId = 20;
    }

    // Build and execute the SQL query with a random row within the specified range
    $sql = "SELECT imagename, image, description, link FROM menscollection WHERE id BETWEEN $startId AND $endId ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the randomly selected row
        $row = $result->fetch_assoc();
        //echo "<p>Image Name: " . $row["Imagename"] . "</p>";
        
        echo "Image Name: " . $row["imagename"] . "<br>";
        echo "Description: " . $row["description"] . "<br>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($row["image"]) . "' />";
        //echo '<img src="' . $row["image"] . '" alt="Image"><br>';
        echo '<a href="' . $row["link"] . '">Buy</a><br>';
    } else {
        echo "No data found in the specified range.";
    }

    $conn->close();
}
?>



