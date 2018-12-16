<?php
    require "connect.php";
    
    $id = $_GET['id'];
    $sql = "DELETE FROM persona WHERE Personas_ID = '$id'";
    $result = mysqli_query($connection, $sql);
    
    header("Location: /person_list_filter.php");
?>