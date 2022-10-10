<?php
include "./baza.class.php";
include "./sesija.class.php";
Sesija::kreirajSesiju();

if(!(isset($_SESSION["uloga"]) && $_SESSION["uloga"] == 1)){
    header("Location: index.php");
    exit();
}

$samoPristup = true;

if (isset($_POST["dodajTematiku"])) {
    $samoPristup = false;
    $nazivTematike = $_POST["nazivTematike"];
    $opisTematike = $_POST["opisTematike"];
    $moderatori = [];
    foreach ($_POST["moderatori"] as $mod) {
        array_push($moderatori, $mod);
    }
    $veza = new Baza();
    $veza->spojiDB();

    if ($_POST["dodajTematiku"] == "Dodaj tematiku") {
        $veza->insertTematika($nazivTematike, $opisTematike, $moderatori);
        $veza->insertDnevnik(15, $_SESSION["korisnik"], "tematike.php", "tematika: {$nazivTematike}");
    } else {
        $veza->updateTematika($_POST["idHidden"], $nazivTematike, $opisTematike, $moderatori);
        $veza->insertDnevnik(16, $_SESSION["korisnik"], "tematike.php", "tematika: {$nazivTematike}");
    }
    $veza->zatvoriDB();
}

if (isset($_POST["urediTematiku"])) {
    $samoPristup = false;
    $urediId = $_POST["urediId"];
    $veza = new Baza();
    $veza->spojiDB();
    $upit = "SELECT * FROM tematika_izlozbe WHERE tematika_id = '{$urediId}'";
    $rezultat = $veza->selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $urediNaziv = $red["naziv_tematike"];
    $urediOpis = $red["opis_tematike"];
    $upit = "SELECT * FROM korisnik k, upravlja_tematikom u WHERE u.tematika_id = '{$urediId}'"
            . " AND k.korisnicko_ime = u.moderator_korisnicko_ime;";
    $rezultat = $veza->selectDB($upit);
    $urediModeratori = [];
    while ($red = mysqli_fetch_array($rezultat)) {
        array_push($urediModeratori, $red['korisnicko_ime']);
    }
    $veza->zatvoriDB();
}

if($samoPristup){
    $veza = new Baza();
    $veza->spojiDB();
    $veza->insertDnevnik(12, $_SESSION["korisnik"], "tematike.php");
    $veza->zatvoriDB();
}

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Tematike izložbi</title>
        <meta charset="UTF-8">
        <meta name="title" content="Vlakovi">
        <meta name="description" content="Website for train enthusiasts">
        <meta name="keywords" content="train, exhibition, railway, locomotive, vlakovi, željeznica">
        <meta name="author" content="Josip Šušnjara">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="date.created" content="2021-05-23">
        <?php
        echo "<link rel='stylesheet' href='";
        echo isset($_COOKIE["theme"]) ?
                $_COOKIE["theme"] : "./css/jsusnjara.css";
        echo "' type='text/css'/>";
        ?>
    </head>

    <body>
        <header>
            <div class='h'>
                <h1>VLAKOVI</h1>
                <?php
                include "./meni.php";
                ?>
            </div>
        </header>
        
        <section>
            <h2>Tematike izložbi</h2>

            <table class="tablica">
                <thead><tr>
                        <th>ID</th>
                        <th>Naziv tematike</th>
                        <th>Opis tematike</th>
                        <th>Moderatori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $veza = new Baza();
                    $veza->spojiDB();
                    $upit = "SELECT * FROM tematika_izlozbe;";
                    $rezultat = $veza->selectDB($upit);
                    while ($red = mysqli_fetch_array($rezultat)) {
                        $tematikaId = $red['tematika_id'];
                        echo "<tr><td>{$tematikaId}</td>"
                        . "<td>{$red['naziv_tematike']}</td>"
                        . "<td>{$red['opis_tematike']}</td><td>";
                        $upit = "SELECT * FROM korisnik k, upravlja_tematikom u WHERE u.tematika_id = '{$tematikaId}'"
                                . " AND k.korisnicko_ime = u.moderator_korisnicko_ime;";
                        $rezultat2 = $veza->selectDB($upit);
                        $moderatori = [];
                        while ($red = mysqli_fetch_array($rezultat2)) {
                            echo "{$red['ime']} {$red['prezime']} ({$red['korisnicko_ime']})<br>";
                            array_push($moderatori, $red['korisnicko_ime']);
                        }
                        echo "</td><td><form action='tematike.php' method='post'>"
                        . "<input type='submit' name='urediTematiku' value='Uredi'/>"
                        . "<input type='hidden' name='urediId' value='{$tematikaId}'/></form></td></tr>";
                    }
                    $veza->zatvoriDB();
                    ?>
                </tbody>
            </table>

            <button onclick="prikaziFormu()" id="sakrijTematikaFormaBt"
                    <?php echo isset($urediId) ? "style='display:none;'" : "" ?>>Dodaj novu tematiku</button>
            <script>
                function prikaziFormu() {
                    var forma = document.getElementById("novaTematikaForm");
                    forma.style.display = "block";
                    var bt = document.getElementById("sakrijTematikaFormaBt");
                    bt.style.display = "none";
                }
            </script>

            <div id="novaTematikaForm" style="display: 
                 <?php echo isset($_POST["urediTematiku"]) ? 'block' : 'none' ?>;">
                <form method="post" action="tematike.php">
                    <table>
                        <tr>
                            <td><label for="nazivTematike">Naziv tematike:</label></td>
                            <td><input name="nazivTematike" type="text" size="20" maxlength="50" id="nazivTematike"
                                       <?php echo isset($urediNaziv) ? "value='$urediNaziv'" : "" ?>/></td>
                        </tr>
                        <tr>
                            <td><label for="opisTematike">Opis tematike:</label></td>
                            <td><textarea name="opisTematike" rows="8" cols="20"
                                          ><?php echo isset($urediOpis) ? "$urediOpis" : "" ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="moderatori[]">Moderatori:</label></td>
                            <td><select name="moderatori[]" multiple="multiple">
                                    <?php
                                    $veza = new Baza();
                                    $veza->spojiDB();
                                    $upit = "SELECT korisnicko_ime, ime, prezime FROM korisnik WHERE uloga_id < 3;";
                                    $rezultat = $veza->selectDB($upit);
                                    while ($red = mysqli_fetch_array($rezultat)) {
                                        echo "<option value='{$red['korisnicko_ime']}' ";
                                        if (isset($urediModeratori) && in_array($red['korisnicko_ime'], $urediModeratori)) {
                                            echo "selected='selected'";
                                        }
                                        echo ">{$red['ime']} {$red['prezime']}</option>";
                                    }
                                    $veza->zatvoriDB();
                                    ?>
                                </select></td>
                        </tr>
                    </table>
                    <input name="idHidden" type="hidden" <?php echo isset($urediId) ? "value='$urediId'" : "" ?>/>
                    <input name="dodajTematiku" type="submit" value="<?php
                                    echo isset($urediId) ?
                                            "Spremi promjene" : "Dodaj tematiku"
                                    ?>"/>
                </form>
            </div>

        </section>
    </body>

    <footer>
        <p>&copy; 2021.</p>
    </footer>
</html>