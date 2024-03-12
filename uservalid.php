<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taxcollection"; // Updated database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = $_POST["useremail"]; // Change "useremail" to match your form's email input name
    $userpassword = $_POST["userpassword"]; // Change "userpassword" to match your form's password input name

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE useremail = ? AND userpassword = ?");
    $stmt->bind_param("ss", $useremail, $userpassword);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, redirect to ePaytax.html
            header("Location: ePaytax.html");
            exit; // Terminate script after redirection
        } else {
            // User does not exist, send a response indicating failure
            $response = ["success" => false, "message" => "Invalid User"];
            echo json_encode($response);
        }
    } else {
        // Database error
        $response = ["success" => false, "message" => "Database Error"];
        echo json_encode($response);
    }

    $stmt->close();
}

$conn->close();
?>
