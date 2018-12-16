<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kursa darbs Datu bāzu tehnoloģijas</title>
        <meta name="Rihards Ričis Cīrulis">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <img src="images/tennis_ball_logo.png" class="center">
        <h1>Latvijas tenisa klubu datubāze</h1>

        <!-- NAVIGATION MENU -->
        <ul>
            <li><a class="active" href="index.php">Sākums</a></li>
            <li><a class="active" href="club_list.php">Klubu saraksts</a></li>
            <li><a class="active" href="person_list_filter.php">Personu filtrācija</a></li>
            <li><a class="active" href="group_list_filter.php">Grupu filtrācija</a></li>
            <li><a class="active" href="add_person.php">Pievienot personu</a></li>
            <li><a class="active" href="add_club.php">Pievienot klubu</a></li>
        </ul>
        <hr>

        <!-- Main content -->
        <main>
        <?php
            require "connect.php";

            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM klubs 
                        WHERE Kluba_ID = '$id';";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            }
        ?>
            <form action="updateclub.php?id=<?php echo $id; ?>" method="post">
                <fieldset>
                    <legend><h3>Kluba ievades forma</h3></legend>
                    Jaunā kluba nosaukums:<br>
                    <input type="text" name="newclub_name" value="<?php echo $row['Nosaukums']; ?>" required><br><br>
                    Dibināšanas datums:<br>
                    <input type="date" name="newclub_date" value="<?php echo $row['Dibinasanas_datums']; ?>" required><br><br>
                    <input type="submit" name="submit" value="Pievienot">
                    <input type="reset" name="reset" value="Iztīrīt"><br><br>
                    Piezīme: Lai pievienotu administratoru jaunam klubam, dodieties uz sadaļu 
                    "Pievienot personu", vai arī ieceļiet kādu personu par šī kluba administratoru
                    sadaļā "Personu saraksts", labojot personas datus.
                </fieldset>
            </form>
        </main>

        <!-- Footer -->
        <div class="footer">
            <h3>&copy; RIHARDS RIČIS CĪRULIS | 2018</h3>
        </div>
    </body>
</html>