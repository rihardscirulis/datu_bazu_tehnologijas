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
            <form action="insertPersonData.php" method="post">
                <fieldset>
                    <legend><h3>Personas ievades forma</h3></legend>
                    Vārds:<br>
                    <input type="text" name="name" placeholder="-- Ievadiet vārdu --" required><br><br>
                    Uzvārds:<br>
                    <input type="text" name="surname" placeholder="-- Ievadiet uzvārdu --" required><br><br>
                    Dzimums:<br>
                    <select name="gender" required>
                        <option disabled selected value>-- Izvelēties dzimumu --</option>
                        <option value="Vīrietis">Vīrietis</option>
                        <option value="Sieviete">Sieviete</option>
                    </select><br><br>
                    Dzimšanas gads:<br>
                    <input type="date" name="birth_date" required><br><br>
                    Adrese:<br>
                    <input type="text" name="address" placeholder="-- Ievadiet datumu --" required><br><br>
                    E-pasts:<br>
                    <input type="email" name="email" placeholder="-- Ievadiet e-pastu --" required><br><br>
                    Telefona numurs:<br>
                    <input type="text" name="telephone" placeholder="-- Ievadiet telefona numuru --" maxlength="8" required><br><br>
                    Kluba pozīcija:<br>
                    <select name="position" required>
                        <option disabled selected value>-- Izvelēties pozīciju --</option>
                        <option value="Biedrs">Biedrs</option>
                        <option value="Administrators">Administrators</option>
                        <option value="Treneris">Treneris</option>
                        <option value="Kapteinis">Kapteinis</option>
                    </select><br><br>
                    Klubs:<br>
                    <select name="club" required>
                        <option disabled selected value>-- Izvelēties klubu --</option>
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
                    <select name="group" required>
                        <option disabled selected value>-- Izvelēties grupu --</option>
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
                    <input type="submit" name="submit" value="Apstiprināt">
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