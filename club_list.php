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
                function tabula($sql_res) {
                    $first = true;
                    echo "<center><table class=\"schedule\">";
                    echo "<table border=\"0\">";
                    while($row = mysqli_fetch_assoc($sql_res)) {
                        if($first) {
                            echo "<tr>";
                            foreach($row as $k=>$v) {
                                echo "<th>$k</th>";
                            }
                            echo "</tr>".PHP_EOL;
                            $first = false;
                        }
                        echo "<tr>";
                        foreach($row as $v) {
                            echo "<td>$v</td>";
                        }
                        echo "<td><a href='edit_club.php?id=".$row['ID']."' style='text-decoration:none; color:red'>Labot</a></td>";
                        echo "<td><a href='delete_club.php?id=".$row['ID']."' style='text-decoration:none; color:red'>Dzēst</a></td>";
                        echo "</tr>".PHP_EOL;
                    }
                    echo "</table></center>";

                    $row_cnt = mysqli_num_rows($sql_res);
                    printf("<br><center>Rezultātu kopā ir <b>%d</b> rindas. </center>\n", $row_cnt);
                    /* close result set */
                    mysqli_free_result($sql_res); 
                }

                # Veidojam savienojumu ar savu serveri un datu bazi
                $d = mysqli_connect('localhost','root','kaprize','tenisa_datubaze') or die('Nevaru pievienoties datubāzei');
                $chs = mysqli_set_charset($d, "utf8");
            
                echo "<h3>Klubu saraksts</h3>";
                $sql = "SELECT klubs.Kluba_ID as ID, klubs.Nosaukums as Nosaukums, klubs.Dibinasanas_datums as 'Dibinašanas datums', 
                    CONCAT(persona.Vards,' ',persona.Uzvards) as Administrators
                    FROM klubs 
                    JOIN persona 
                    ON klubs.Kluba_ID = persona.Kluba_ID 
                    WHERE persona.Kluba_pozicija = 'Administrators'";
                echo "<!-- $sql --!>";
                $sql_res = mysqli_query($d, $sql) or die("<h1>".mysqli_error()."</h1>");
                tabula($sql_res);
            ?>
        </main>

        <!-- Footer -->
        <div class="footer">
            <h3>&copy; RIHARDS RIČIS CĪRULIS | 2018</h3>
        </div>
    </body>
</html>