<!DOCTYPE html>
<html>
<head>
    <title>Menu Page</title>
    <!-- <link rel="stylesheet" href="extractstyle.css" class="css"> -->
</head>
<body>
    <h1>Welcome to Menu Page</h1>
    <p>Choose an option:</p>
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

        $conn->close();
    }
    ?>
    <form method="post" action="http://localhost/extractproduct.php">
        <!-- Hidden input fields to pass usergender and totalincome to extract.php -->
        <input type="hidden" name="usergender" value="<?php echo $usergender; ?>">
        <input type="hidden" name="totalincome" value="<?php echo $totalincome; ?>">

        <input type="submit" name="choice" value="Product Suggestion">
    </form>
    <form method="post" action="http://localhost/extracttrip.php">
        <!-- Hidden input fields to pass usergender and totalincome to extracttrip.php -->
        <input type="hidden" name="usergender" value="<?php echo $usergender; ?>">
        <input type="hidden" name="totalincome" value="<?php echo $totalincome; ?>">

        <input type="submit" name="choice" value="Plan a Trip">
    </form>
</body>
</html>
