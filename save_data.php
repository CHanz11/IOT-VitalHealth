<?php
// Database connection details
$servername = "mydb1.c3saackuoh4e.ap-southeast-2.rds.amazonaws.com";
$username = "admin";
$password = "chanzkie15";
$dbname = "mydb1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientName = $_POST["patientName"];
    $birthday = $_POST["birthday"];
    $patientAddress = $_POST["patientAddress"];
    $patientID = $_POST["patientID"];
    $passcode = $_POST["passcode"];

    // SQL to insert data into the Patient1 table
    $sql = "INSERT INTO Patient1 (patientName, birthday, patientAddress, patientID, passcode)
            VALUES ('$patientName', '$birthday', '$patientAddress', '$patientID', '$passcode')";

    if ($conn->query($sql) === TRUE) {
        echo "Record saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
