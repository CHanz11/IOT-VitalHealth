<?php 
    session_start();
    include_once("connections/connection.php");
    $con = connection();

    if(isset($_POST['add'])){
        $userid = $_POST['userid'];
        $passcode = $_POST['passcode'];

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM patient_list WHERE id = ? AND passcode = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("is", $userid, $passcode); // Assuming 'id' is an integer
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['UserLogin'] = $row['id'];
            $stmt->close();

            // Add data to the queue table
            $queueSql = "INSERT INTO queue (id, passcode, fname, lname) VALUES (?, ?, ?, ?)";
            $queueStmt = $con->prepare($queueSql);
            $queueStmt->bind_param("isss", $row['id'], $row['passcode'], $row['first_name'], $row['last_name']);
            $queueStmt->execute();
            $queueStmt->close();

            header("Location: index.php");
            exit(); // Ensure no further code execution after redirection
        } else {
            echo "No user found.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Monitoring Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="register">

    <header>
        <div class="website-name">
            IOT INTEGRATION<br>
            FOR VITAL SIGNS MONITORING<br>
            SYSTEM IN HEALTH SECTORS
        </div>
        <a href="index.php" class="register-btn">DASHBOARD</a>
    </header>

    <main class="new-patient-form">
        <h1 class="dashboard-title">REGISTER NEW RECORD</h1>
        <br/>
        <form action="" method="post">
        <div class="form-group">
        <label >User ID</label>
        <input type="text" name="userid" id="userid">
        </div>
        <div class="form-group">
        <label >Passcode</label>
        <input type="password" name="passcode" id="passcode">
        </div>
        <br/> <br/>
        <button type="submit" name="add">ADD</button>
        </form>
    </main>

</body>
</html>