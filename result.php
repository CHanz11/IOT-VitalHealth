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
    $search = $_GET['search'];

$sql = "SELECT * FROM patient_list WHERE first_name LIKE '%$search%' || last_name LIKE '%$search%' ORDER BY id DESC";
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
        <h1 class="dashboard-title">DASHBOARD</h1>
        <a href="register.php" class="register-btn">REGISTER NEW RECORD</a>
            <a href="logout.php" class="register-btn">Logout</a>
    </header>

    <main class="register">
        <div class="patient-record">PATIENT RECORD</div>
        <div class="search-container">
        <form action="result.php" method="get">
            <input type="text" name="search" id="search" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>DATE</th>
                    <th>TIME</th>
                    <th>VIEW</th>
                    <th>EDIT</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php do{ ?>
                <tr>
                    <td> <?php echo $row['id'];?> </td>
                    <td><?php echo $row['first_name']." ".$row['last_name'];?></td>
                    <td><?php echo $row['date'];?></td>
                    <td><?php echo $row['time'];?></td>
                    <td><a href="details.php?ID=<?php echo htmlspecialchars($row['id']); ?>"><i class="fa fa-eye"></i> View</a></td>
                    <td><a href="edit.php?ID=<?php echo htmlspecialchars($row['id']); ?>"><i class="fa fa-edit"></i> Edit</a></td>
                    <form action="delete.php" method="post">
                        <td>
                            <button type="submit" name="delete"><i class="material-icons">delete</i></button>
                            <input type="hidden" name="ID" value="<?php echo htmlspecialchars($row['id']); ?>";>
                        </td>
                    </form>
                </tr>
                <?php }while($row = $patients->fetch_assoc()); ?>
            </tbody>
        </table>
    </main>

</body>
</html>