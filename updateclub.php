<?php
    require "connect.php";

    $id = $_GET['id'];
    $newclub_name=$_POST['newclub_name'];
    $newclub_date=$_POST['newclub_date'];

    $sql = "UPDATE klubs
            SET Nosaukums = '$newclub_name', 
            Dibinasanas_datums = '$newclub_date'
            WHERE Kluba_ID = '$id'";

    mysqli_query($connection, $sql);
    mysqli_close($connection);
    header("Location: /club_list.php");
?>