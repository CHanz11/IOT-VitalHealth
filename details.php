<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['UserLogin'])){
        //echo "Welcome ".$_SESSION['UserLogin'];
    }else{
        echo  header("Location: logout.php");
    }

    include_once("connections/connection.php");
    $con = connection();

    $id = $_GET['ID'];

$sql = "SELECT * FROM patient_list WHERE id = '$id'";
$patients = $con->query($sql) or die ($con->error);
$row = $patients->fetch_assoc();

// do{
//     echo $row['first_name']." ".$row['last_name']. "<br/>";
// }while($row = $patients->fetch_assoc());
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
        <h1 class="dashboard-title">PATIENT RECORD</h1>
        <a href="index.php" class="register-btn">DASHBOARD</a>
    </header>

    <main class="cyan-background">
        <div class="grey-box">
            <br>
            <div class="row">
                <div class="column">
                    <strong>Name: <?php echo $row['first_name']." ".$row['last_name'];?></strong> 
                </div>
                <div class="column">
                    <strong>Gender:</strong> <?php echo $row['gender'];?>
                </div>
                <div class="column">
                    <strong>Birthday:</strong> <?php echo $row['birth_day'];?>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="column">
                    <strong>ID Number: <?php echo $row['id'];?></strong>
                </div>
                <div class="column">
                    <strong>Address: <?php echo $row['address'];?></strong>
                </div>
                <div class="column">
                    
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="column">
                    <strong>Weight:</strong> <br><br> <?php echo $row['weight'];?>
                </div>
                <div class="column">
                    <strong>Height:</strong> <br><br> <?php echo $row['height'];?>
                </div>
                <div class="column">
                    <strong>Temperature:</strong> <br><br> <?php echo $row['temperature'];?>°C
                </div>
                <div class="column">
                    <strong>Blood Pressure:</strong> <br><br> <?php echo $row['bp'];?>
                </div>
                <div class="column">
                    <strong>BMI:</strong> <br><br> <?php echo $row['bmi'];?>
                </div>
            </div>
            <br>
        </div>
    </main>

</body>
</html>