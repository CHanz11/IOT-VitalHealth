<?php 

    include_once("connections/connection.php");
    $con = connection();
    $id = $_GET['ID'];

    $sql = "SELECT * FROM patient_list WHERE id = '$id'";
    $patients = $con->query($sql) or die ($con->error);
    $row = $patients->fetch_assoc();


    if(isset($_POST['submit'])){
        $fname = $_POST['patientFirstName'];
        $lname = $_POST['patientLastName'];
        $gender = $_POST['gender'];
        $bday = $_POST['birthday'];
        $add = $_POST['patientAddress'];
        $pass = $_POST['passcode'];

        $sql = "UPDATE patient_list SET first_name = '$fname', last_name = '$lname', gender = '$gender', birth_day = '$bday', address = '$add', passcode = '$pass', date = CURRENT_DATE(), time = CURRENT_TIME() WHERE id = '$id'";
        $con->query($sql) or die ($con->error);

        header("Location: details.php?ID=" . $id);

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
                <input type="text" id="patientFirstName" name="patientFirstName" value="<?php echo $row['first_name'];?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Patient Last Name*</label>
                <input type="text" id="patientLastName" name="patientLastName" value="<?php echo $row['last_name'];?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender*</label>
                <select name="gender" id="gender">
                    <option value="Male" <?php echo ($row['gender'] == "Male") ? 'selected' : ''; ?> >Male</option>
                    <option value="Female" <?php echo ($row['gender'] == "Female") ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday*</label>
                <input type="text" id="birthday" name="birthday" value="<?php echo $row['birth_day'];?>" required>
            </div>
            <div class="form-group">
                <label for="patientAddress">Address*</label>
                <input type="text" id="patientAddress" name="patientAddress" value="<?php echo $row['address'];?>" required>
            </div>
            <div class="form-group">
                <label for="passcode">Edit Passcode</label>
                <input type="text" id="passcode" name="passcode" value="<?php echo $row['passcode'];?>">
            </div>
            <input type="submit" name="submit" value="Update">
        </form>
    </main>

</body>
</html>
