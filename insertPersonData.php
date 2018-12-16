<?php
    //Formas aizpilde un datu pievienošana datubāzē
    require "connect.php";

    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $gender=$_POST['gender'];
    $address=$_POST['address'];
    $birth_date=$_POST['birth_date'];
    $email=$_POST['email'];
    $telephone=$_POST['telephone'];
    $position=$_POST['position'];
    $clubID=$_POST['club'];
    $groupID=$_POST['group'];

    $sql = "INSERT INTO persona (Vards, Uzvards, Dzimums, Dzimsanas_gads, Adrese, E_pasts, Telefona_numurs,
        Kluba_pozicija, Kluba_ID, Grupas_ID)
        VALUES ('".$name."', '".$surname."', '".$gender."', '".$birth_date."', '".$address."', '".$email."',
         '".$telephone."', '".$position."', '".$clubID."', '".$groupID."')";
    //--------------------------------------
    
    mysqli_query($connection, $sql);
    mysqli_close($connection);
    header("Location: /add_person.php");
?>