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
                        echo "<td><a href='person_data.php?id=".$row['ID']."' style='text-decoration:none; color:red'>Personas dati</a></td>";
                        echo "<td><a href='edit_person.php?id=".$row['ID']."' style='text-decoration:none; color:red'>Labot</a></td>";
                        echo "<td><a href='delete_person.php?id=".$row['ID']."' style='text-decoration:none; color:red'>Dzēst</a></td>";
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
                ?>
                <form action="group_list_filter.php" method="post">
                    <label for="Sorting_group_persons">Kārtot pēc grupas piederības:</label>
                        <select name="group">
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
                    <input type="submit" name="groupsubmit" value="Apstiprināt"><br><br>
                </form>  

                <?php
                    require "connect.php";
                    if(empty($_POST['group'])) {
                        die;
                    }
                    else {
                        $groupID = $_POST['group'];
                    }

                    $sqlgroup = "SELECT * FROM grupa;";
                    $result2 = mysqli_query($connection, $sqlgroup);
                    $rowgroup = mysqli_fetch_array($result2, MYSQLI_ASSOC);

                    $groupCount = "SELECT Grupas_ID, Kategorija FROM grupa
                        WHERE Grupas_ID ='$groupID';";
                    $groupCountResult = mysqli_query($connection, $groupCount);
                    $groupCount = mysqli_fetch_array($groupCountResult);

                    if(isset($_POST['groupsubmit'])) {
                        if($groupID === $groupCount['Grupas_ID']) {
                            echo "<h3>Grupas - ".$groupCount['Kategorija']." - personu saraksts</h3>";
                            $sql2 = "CALL personFiltrationByGroup('$groupID');";
                            /*$sql2 = "SELECT persona.Personas_ID as ID, persona.Vards as 'Vārds', 
                            persona.Uzvards as 'Uzvārds', kluba_biedri.Pienemsanas_datums as 'Pieņemts', 
                            persona.Telefona_numurs as 'Telefona numurs', persona.E_pasts as 'E-pasts' 
                            FROM persona 
                            JOIN kluba_biedri 
                            ON persona.Personas_ID = kluba_biedri.Personas_ID 
                            JOIN grupa 
                            ON persona.Grupas_ID = grupa.Grupas_ID 
                            WHERE grupa.Grupas_ID = '$groupID' 
                            ORDER BY persona.Uzvards ASC;";*/
                        
                            echo "<!-- $sql2 --!>";
                            $sql_res2 = mysqli_query($d, $sql2) or die("<h1>".mysqli_error()."</h1>");
                            tabula($sql_res2);
                        }
                    }
                ?>
        </main>

        <!-- Footer -->
        <div class="footer">
            <h3>&copy; RIHARDS RIČIS CĪRULIS | 2018</h3>
        </div>
    </body>
</html>