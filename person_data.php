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
                $sql = "SELECT *, solveAge(Dzimsanas_gads) AS Vecums FROM persona 
                    JOIN klubs 
                    ON persona.Kluba_ID = klubs.Kluba_ID
                    JOIN grupa
                    ON persona.Grupas_ID = grupa.Grupas_ID
                    WHERE Personas_ID = '$id';";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $sql1 = "SELECT * FROM kluba_biedri
                    JOIN persona
                    ON kluba_biedri.Personas_ID = persona.Personas_ID
                    WHERE persona.Personas_ID = '$id';";
                $result1 = mysqli_query($connection, $sql1);
                $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                
            }
        ?>
            <fieldset>
                <legend><h3>Personas dati</h3></legend>
                <label for="name">Vārds, Uzvārds: <?php echo $row['Vards']; ?> <?php echo $row['Uzvards']; ?></label><br><br>
                <label for="gender">Dzimums: <?php echo $row['Dzimums']; ?></label><br><br>
                <label for="birth_date">Dzimšanas gads: <?php echo $row['Dzimsanas_gads']; ?><br><br>
                <label for="age">Vecums: <?php echo $row['Vecums']; ?></label><br><br>
                <label for="address">Adrese: <?php echo $row['Adrese']; ?></label><br><br>
                <label for="email">E-pasts: <?php echo $row['E_pasts']; ?></label><br><br>
                <label for="telephone">Telefona numurs: <?php echo $row['Telefona_numurs']; ?></label><br><br>
                <label for="club">Klubs: <?php echo $row['Nosaukums']; ?></label><br><br>
                <label for="club_acception_date">Pieņemts klubā: <?php echo $row1['Pienemsanas_datums']; ?></label><br><br>
                <label for="group">Grupas kategorija: <?php echo $row['Kategorija']; ?></label><br><br>
                <label for="group_description">Grupas apraksts: <?php echo $row['Apraksts']; ?></label>
            </fieldset>
            </form>
        </main>

        <!-- Footer -->
        <div class="footer">
            <h3>&copy; RIHARDS RIČIS CĪRULIS | 2018</h3>
        </div>
    </body>
</html>