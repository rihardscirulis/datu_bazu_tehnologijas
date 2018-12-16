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
                $sql = "SELECT * FROM persona 
                JOIN klubs 
                ON persona.Kluba_ID = klubs.Kluba_ID
                JOIN grupa
                ON persona.Grupas_ID = grupa.Grupas_ID
                WHERE Personas_ID = '$id';";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            }
        ?>
            <form action="updateperson.php?id=<?php echo $id; ?>" method="post">
                <fieldset>
                    <legend><h3>Personas informācija</h3></legend>
                    Vārds:<br>
                    <input type="text" name="new_name" value="<?php echo $row['Vards']; ?>" required><br><br>
                    Uzvārds:<br>
                    <input type="text" name="new_surname" value="<?php echo $row['Uzvards']; ?>" required><br><br>
                    Dzimums:<br>
                    <select name="new_gender" required>
                        <option disabled selected value><?php echo $row['Dzimums']; ?></option>
                        <option value="Vīrietis">Vīrietis</option>
                        <option value="Sieviete">Sieviete</option>
                    </select><br><br>
                    Dzimšanas gads:<br>
                    <input type="date" name="new_birth_date" value="<?php echo $row['Dzimsanas_gads']; ?>" required><br><br>
                    Adrese:<br>
                    <input type="text" name="new_address" value="<?php echo $row['Adrese']; ?>" required><br><br>
                    E-pasts:<br>
                    <input type="email" name="new_email" value="<?php echo $row['E_pasts']; ?>" required><br><br>
                    Telefona numurs:<br>
                    <input type="text" name="new_telephone" value="<?php echo $row['Telefona_numurs']; ?>" maxlength="8" required><br><br>
                    Kluba pozīcija:<br>
                    <select name="new_position" value="" required>
                        <option disabled selected value><?php echo $row['Kluba_pozicija']; ?></option>
                        <option value="Biedrs">Biedrs</option>
                        <option value="Administrators">Administrators</option>
                        <option value="Treneris">Treneris</option>
                        <option value="Kapteinis">Kapteinis</option>
                    </select><br><br>
                    Klubs:<br>
                    <select name="new_club" required>
                        <option disabled selected value><?php echo $row['Nosaukums']; ?></option>
                        <?php
                            require "connect.php";
                            $query = "SELECT * FROM klubs;";
                            $results = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($results)) {
                                echo "<option value='".$row['Kluba_ID']."'>".$row['Nosaukums']."</option>";
                            }
                            mysqli_close($connection);
                        ?>
                    </select><br><br>
                    Grupa:<br>
                    <select name="new_group" required>
                        <option disabled selected value><?php echo $row['Kategorija']; ?></option>
                        <?php
                            require "connect.php";
                            $query = "SELECT * FROM grupa;";
                            $results = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($results)) {
                                echo "<option value='".$row['Grupas_ID']."'>".$row['Kategorija']."</option>";
                            }
                            mysqli_close($connection);
                        ?>
                    </select><br><br>
                    <input type="submit" name="submit" value="Atjaunot">
                    <input type="reset" value="Iztirīt"><br><br>
                </fieldset>
            </form>
        </main>

        <!-- Footer -->
        <div class="footer">
            <h3>&copy; RIHARDS RIČIS CĪRULIS | 2018</h3>
        </div>
    </body>
</html>