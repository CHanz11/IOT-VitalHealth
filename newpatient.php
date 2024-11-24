<?php 

    include_once("connections/connection.php");
    $con = connection();


    if(isset($_POST['submit'])){
        $fname = $_POST['patientFirstName'];
        $lname = $_POST['patientLastName'];
        $gender = $_POST['gender'];
        $bday = $_POST['birthday'];
        $add = $_POST['patientAddress'];
        $pass = $_POST['passcode'];

        $sql = "INSERT INTO `patient_list`(`first_name`, `last_name`, `gender`, `birth_day`, `address`, `passcode`, `date`, `time`) VALUES ('$fname', '$lname', '$gender', '$bday', '$add', '$pass', CURRENT_DATE(), CURRENT_TIME())";
        $con->query($sql) or die ($con->error);

        echo header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Monitoring Dashboard</title>
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
        <h1 class="dashboard-title">REGISTER NEW RECORD</h1>
        <a href="index.php" class="register-btn">DASHBOARD</a>
    </header>

    <main class="new-patient-form">
        <div class="patient-type">NEW PATIENT</div>

        <form action="" method="post">
            <div class="form-group">
                <label for="first_name">Patient First Name*</label>
                <input type="text" id="patientFirstName" name="patientFirstName" required>
            </div>
            <div class="form-group">
                <label for="last_name">Patient Last Name*</label>
                <input type="text" id="patientLastName" name="patientLastName" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender*</label>
                <select name="gender" id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday*</label>
                <input type="text" id="birthday" name="birthday" required>
            </div>
            <div class="form-group">
                <label for="patientAddress">Address*</label>
                <input type="text" id="patientAddress" name="patientAddress" required>
            </div>
            <div class="form-group">
                <label for="passcode">Create Passcode</label>
                <input type="text" id="passcode" name="passcode">
            </div>
            <input type="submit" name="submit" value="Save">
        </form>
    </main>

</body>
</html>
