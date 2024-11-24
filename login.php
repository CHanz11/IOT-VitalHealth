<?php 
    include_once("connections/connection.php");
    $con = connection();

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM patient_users WHERE username = ? AND password = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['UserLogin'] = $row['username'];
            $_SESSION['Access'] = $row['access'];
            $stmt->close();
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
    </header>

    <main class="new-patient-form">
        <h1 class="dashboard-title">Login Page</h1>
        <br/>
        <form action="" method="post">
        <div class="form-group">
        <label >Username</label>
        <input type="text" name="username" id="username">
        </div>
        <div class="form-group">
        <label >Password</label>
        <input type="password" name="password" id="password">
        </div>
        <br/> <br/>
        <button type="submit" name="login">Login</button>
        </form>
    </main>

</body>
</html>