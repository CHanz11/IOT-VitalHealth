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

$sql = "SELECT * FROM queue ORDER BY id DESC";
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
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

    <main class="register">
        <div class="patient-record">QUEUED PATIENTS</div>
        <div class="search-container">

        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>PASSCODE</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php do{ ?>
                <tr>
                    <td> <?php echo $row['id'];?> </td>
                    <td><?php echo $row['fname']." ".$row['lname'];?></td>
                    <td> <?php echo $row['passcode'];?> </td>
                    <form action="delete_queue.php" method="post">
                        <td>
                            <button type="submit" name="delete_queue"><i class="material-icons">delete</i></button>
                            <input type="hidden" name="ayde" value="<?php echo htmlspecialchars($row['id']); ?>";>
                        </td>
                    </form>
                </tr>
                <?php }while($row = $patients->fetch_assoc()); ?>
            </tbody>
        </table>
    </main>

</body>
</html>