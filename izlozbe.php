<?php
include "./baza.class.php";
include "./sesija.class.php";
Sesija::kreirajSesiju();

if(!(isset($_SESSION["uloga"]) && $_SESSION["uloga"] <= 2)){
    header("Location: prijava.php");
    exit();
}


if (isset($_GET["tematikaId"])) {
    $tematikaId = $_GET["tematikaId"];
    $veza = new Baza();
    $veza->spojiDB();
    $upit = "SELECT * FROM tematika_izlozbe WHERE tematika_id = '{$tematikaId}';";
    $rezultat = $veza->selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $nazivTematike = $red["naziv_tematike"];
    $opisTematike = $red["opis_tematike"];
    $veza->zatvoriDB();
}
else {
    header("Location: ./tematike.php");
    exit();
}

$samoPristup = true;

if (isset($_POST["dodajIzlozbu"])) {
    $samoPristup = false;
    $nazivIzlozbe = $_POST["nazivIzlozbe"];
    $datumPocetka = $_POST["datumPocetka"];
    $maxPrijava = $_POST["maxPrijava"];
    $statusIzlozbe = $_POST["statusIzlozbe"];
    $veza = new Baza();
    $veza->spojiDB();

    if ($_POST["dodajIzlozbu"] == "Dodaj izložbu") {
        $veza->insertIzlozba($nazivIzlozbe, $datumPocetka, $maxPrijava, $statusIzlozbe, $tematikaId);
        $veza->insertDnevnik(17, $_SESSION["korisnik"], "izlozbe.php", "izložba: {$nazivIzlozbe}");
    } else {
        $veza->updateIzlozba($_POST["idHidden"], $nazivIzlozbe, $datumPocetka, $maxPrijava, $statusIzlozbe);
        $veza->insertDnevnik(18, $_SESSION["korisnik"], "izlozbe.php", "izložba: {$nazivIzlozbe}");
    }
    $veza->zatvoriDB();
}

if (isset($_POST["urediIzlozbu"])) {
    $samoPristup = false;
    $urediId = $_POST["urediId"];
    $veza = new Baza();
    $veza->spojiDB();
    $upit = "SELECT * FROM izlozba WHERE izlozba_id = '{$urediId}'";
    $rezultat = $veza->selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $urediNaziv = $red["naziv_izlozbe"];
    $urediDatum = $red["datum_pocetka"];
    $urediMaxPrijava = $red["max_prijava"];
    $urediStatusIzlozbe = $red["status_izlozbe_id"];
    $veza->zatvoriDB();
}

if($samoPristup){
    $veza = new Baza();
    $veza->spojiDB();
    $veza->insertDnevnik(12, $_SESSION["korisnik"], "izlozbe.php");
    $veza->zatvoriDB();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title><?php echo $nazivTematike; ?></title>
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
            <h2><?php echo $opisTematike; ?></h2>


            <table class="tablica">
                <thead><tr>
                        <th>ID</th>
                        <th>Naziv izložbe</th>
                        <th>Datum početka</th>
                        <th>Max prijava</th>
                        <th>Status izložbe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $veza = new Baza();
                    $veza->spojiDB();
                    $upit = "SELECT * FROM izlozba WHERE tematika_id = '{$tematikaId}';";
                    $rezultat = $veza->selectDB($upit);
                    while ($red = mysqli_fetch_array($rezultat)) {
                        $izlozbaId = $red['izlozba_id'];
                        echo "<tr><td>{$izlozbaId}</td>"
                        . "<td><a href='./izlozba.php?izlozbaId={$izlozbaId}'>"
                        . "{$red['naziv_izlozbe']}</a></td>"
                        . "<td>{$red['datum_pocetka']}</td>"
                        . "<td>{$red['max_prijava']}</td>";
                        $upit = "SELECT naziv_statusa FROM status_izlozbe WHERE status_izlozbe_id = "
                                . "'{$red['status_izlozbe_id']}';";
                        $rezultat2 = $veza->selectDB($upit);
                        $red = mysqli_fetch_array($rezultat2);
                        $statusIzlozbe = $red['naziv_statusa'];
                        echo "<td>{$statusIzlozbe}</td>"
                        . "<td><form action='izlozbe.php?tematikaId={$tematikaId}' method='post'>"
                        . "<input type='submit' name='urediIzlozbu' value='Uredi'/>"
                        . "<input type='hidden' name='urediId' value='{$izlozbaId}'/></form></td></tr>";
                    }
                    $veza->zatvoriDB();
                    ?>
                </tbody>
            </table>

            <button onclick="prikaziFormu()" id="sakrijIzlozbaFormaBt"
                    <?php echo isset($urediId) ? "style='display:none;'" : "" ?>>Dodaj novu izložbu</button>
            <script>
                function prikaziFormu() {
                    var forma = document.getElementById("novaIzlozbaForm");
                    forma.style.display = "block";
                    var bt = document.getElementById("sakrijIzlozbaFormaBt");
                    bt.style.display = "none";
                }
            </script>

            <div id="novaIzlozbaForm" style="display: 
                 <?php echo isset($_POST["urediIzlozbu"]) ? 'block' : 'none' ?>;">
                <form method="post" action="izlozbe.php?tematikaId=<?php echo $tematikaId; ?>">
                    <table>
                        <tr>
                            <td><label for="nazivIzlozbe">Naziv izložbe:</label></td>
                            <td><input name="nazivIzlozbe" type="text" size="20" maxlength="50" id="nazivIzlozbe"
                                       <?php echo isset($urediNaziv) ? "value='$urediNaziv'" : "" ?>/></td>
                        </tr>
                        <tr>
                            <td><label for="datumPocetka">Datum početka:</label></td>
                            <td><input name="datumPocetka" type="date" size="20"
                                       <?php echo isset($urediDatum) ? "value='$urediDatum'" : "" ?>/></td>
                        </tr>
                        <tr>
                            <td><label for="maxPrijava">Max prijava:</label></td>
                            <td><input name="maxPrijava" type="text" size="20"
                                       <?php echo isset($urediMaxPrijava) ? "value='$urediMaxPrijava'" : "" ?>/></td>
                        </tr>
                        <tr>
                            <td><label for="statusIzlozbe">Status izložbe:</label></td>
                            <td>
                                <?php
                                $veza = new Baza();
                                $veza->spojiDB();
                                $upit = "SELECT status_izlozbe_id, naziv_statusa FROM status_izlozbe;";
                                $rezultat = $veza->selectDB($upit);
                                while ($red = mysqli_fetch_array($rezultat)) {
                                    echo "<input name='statusIzlozbe' type='radio' value='{$red['status_izlozbe_id']}' ";
                                    if (isset($urediStatusIzlozbe) && $urediStatusIzlozbe == $red['status_izlozbe_id']) {
                                        echo "checked='checked'";
                                    }
                                    echo "><label>{$red['naziv_statusa']}</label>";
                                }
                                $veza->zatvoriDB();
                                ?>
                            </td>
                        </tr>
                    </table>
                    <input name="idHidden" type="hidden" <?php echo isset($urediId) ? "value='$urediId'" : "" ?>/>
                    <input name="dodajIzlozbu" type="submit" value="<?php
                    echo isset($urediId) ?
                            "Spremi promjene" : "Dodaj izložbu"
                    ?>"/>
                </form>
            </div>


        </section>
    </body>

    <footer>
        <p>&copy; 2021.</p>
    </footer>
</html>