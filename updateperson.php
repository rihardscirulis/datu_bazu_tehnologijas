<?php
    require "connect.php";

    $id = $_GET['id'];
    $newname=$_POST['new_name'];
    $newsurname=$_POST['new_surname'];
    $newgender=$_POST['new_gender'];
    $newaddress=$_POST['new_address'];
    $newbirth_date=$_POST['new_birth_date'];
    $newemail=$_POST['new_email'];
    $newtelephone=$_POST['new_telephone'];
    $newposition=$_POST['new_position'];
    $newclubID=$_POST['new_club'];
    $newgroupID=$_POST['new_group'];

    /*$sql = "INSERT INTO persona (Vards, Uzvards, Dzimums, Dzimsanas_gads, Adrese, E_pasts, Telefona_numurs,
        Kluba_pozicija, Kluba_ID, Grupas_ID)
        VALUES ('".$name."', '".$surname."', '".$gender."', '".$birth_date."', '".$address."', '".$email."',
        '".$telephone."', '".$position."', '".$clubID."', '".$groupID."')";*/
    $sql = "UPDATE persona
            SET Vards = '$newname', Uzvards = '$newsurname', Dzimums = '$newgender',
            Dzimsanas_gads = '$newbirth_date', Adrese = '$newaddress',  E_pasts = '$newemail',
            Telefona_numurs = '$newtelephone', Kluba_pozicija = '$newposition',
            Kluba_ID = '$newclubID', Grupas_ID = '$newgroupID'
            WHERE Personas_ID = '$id'";
    //--------------------------------------

    mysqli_query($connection, $sql);
    mysqli_close($connection);
    header("Location: /person_list_filter.php");
?>