<?php
    include_once("connections/connection.php");
    $con = connection();

    if(isset($_POST['delete_queue'])){
        $id = $_POST['ayde'];
        $sql = "DELETE FROM queue WHERE id = '$id'";
        $con->query($sql) or die ($con->error);
        echo header("Location: queue.php");
    }