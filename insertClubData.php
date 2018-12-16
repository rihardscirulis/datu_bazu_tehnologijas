<?php
    //Formas aizpilde un datu pievienošana datubāzē
    require "connect.php";

    $clubName=$_POST['club_name'];
    $clubDate=$_POST['club_date'];

    $sql = "INSERT INTO klubs (Nosaukums, Dibinasanas_datums)
        VALUES ('".$clubName."', '".$clubDate."')";
    //--------------------------------------
    
    mysqli_query($connection, $sql);
    mysqli_close($connection);
    header("Location: /add_club.php");
?>