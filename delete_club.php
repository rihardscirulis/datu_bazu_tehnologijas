<?php
    require "connect.php";
    
    $id = $_GET['id'];
    $sql = "DELETE FROM klubs WHERE Kluba_ID = '$id'";
    $result = mysqli_query($connection, $sql);
    
    header("Location: /club_list.php");
?>