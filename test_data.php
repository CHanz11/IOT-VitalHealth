<?php
    $hostname = "localhost";
    $username = "root";
    $password = "chanzkie15";
    $database = "sensor_db";

    $conn = mysqli_connect($hostname, $username, $password, $database );

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Data base is ok....";

    if(isset($_POST["d"])){
        $d = $_POST["d"];

        $sql = "INSERT INTO ultrasonic (data) VALUES (".$d.")";

        if(mysqli_query($conn, $sql)){
            echo "New record created successfuly..";
        } else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
        }
    }
?>