<?php
    /*
    #db connection object
	$options=[
		PDO::ATTR_EMULATE_PREPARES=>false,
		PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ
        ];
    try {
        $pdo=new PDO('mysql:HOST=localhost;dbname=tenisa_datubaze;charset=utf8', 'root', 'kaprize', $options);
    } 
    catch(PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }*/

    $servername = "localhost";
    $username = "root";
    $password = "kaprize";
    $dbname = "tenisa_datubaze";

    //Create connection
    $connection = mysqli_connect($servername, $username, $password, $dbname);
    //-----------------

    //Change character set to utf8
    if(!mysqli_set_charset($connection, "utf8")) {
        //printf("Error loading character set utf8: %s\n", mysqli_error($connection));
    }
    else {
        //printf("Current character set: %s\n", mysqli_character_set_name($connection));
    }

    //Check connection
    if (!$connection) {
        //die("Connection failed: " . mysqli_connect_error());
    }
    else{
        //echo "Connected successfully";
    }
    //----------------
?>