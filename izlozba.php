<?php
include "./baza.class.php";
include "./sesija.class.php";
Sesija::kreirajSesiju();

if (!(isset($_SESSION["uloga"]))) {
    header("Location: prijava.php");
    exit();
}

if (isset($_GET["izlozbaId"])) {
    $izlozbaId = $_GET["izlozbaId"];
    $veza = new Baza();
    $veza->spojiDB();
    $upit = "SELECT * FROM izlozba WHERE izlozba_id = '{$izlozbaId}';";
    $rezultat = $veza->selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $nazivIzlozbe = $red["naziv_izlozbe"];
    $veza->zatvoriDB();
} else {
    header("Location: ./index.php");
    exit();
}

$samoPristup = true;

//provjera je li korisnik moderator ove izlozbe
$veza = new Baza();
$veza->spojiDB();
$uloga = $_SESSION["uloga"];
$korisnik = $_SESSION["korisnik"];
$upit = "SELECT u.tematika_id FROM upravlja_tematikom u LEFT JOIN tematika_izlozbe t ON u.tematika_id = t.tematika_id "
        . "LEFT JOIN izlozba i ON t.tematika_id = i.tematika_id WHERE u.moderator_korisnicko_ime = '{$korisnik}' "
        . "AND i.izlozba_id = '{$izlozbaId}';";
$rezultat = $veza->selectDB($upit);
$jestModeratorIzlozbe = false;
if (mysqli_fetch_array($rezultat)) {
    $jestModeratorIzlozbe = true;
}

//provjera je li vec korisnik poslao prijavu
$upit = "SELECT v.vlak_id FROM vlak v LEFT JOIN prijava_vlaka p ON v.vlak_id = p.vlak_id "
        . "WHERE v.korisnik_korisnicko_ime = '{$_SESSION['korisnik']}' AND p.izlozba_id = '{$izlozbaId}';";
$rezultat = $veza->selectDB($upit);
$vecPoslaoPrijavu = false;
if ($red = mysqli_fetch_array($rezultat)) {
    $vecPoslaoPrijavu = true;
    $vlakId = $red["vlak_id"];
}

//provjera je li proslo vrijeme prijave i je li vec podneseno max prijava i je li otvoreno slanje prijava
$upit = "SELECT datum_pocetka, max_prijava, status_izlozbe_id FROM izlozba WHERE izlozba_id = '{$izlozbaId}';";
$rezultat = $veza->selectDB($upit);
$red = mysqli_fetch_array($rezultat);
$datumPocetka = strtotime($red["datum_pocetka"]);
$datumSad = strtotime(Baza::Vrijeme("Y-m-d"));
$razlika = $datumSad - $datumPocetka;
$prosloVrijemeZaSlanjePrijave = false;
if ($razlika >= 0) {
    $prosloVrijemeZaSlanjePrijave = true;
}
$maxPrijava = $red["max_prijava"];
$statusIzlozbe = $red["status_izlozbe_id"];
$upit = "SELECT COUNT(*) AS ukupno FROM prijava_vlaka WHERE izlozba_id = '{$izlozbaId}' AND potvrdjena_prijava = '1';";
$rezultat = $veza->selectDB($upit);
$red = mysqli_fetch_array($rezultat);
$podnesenoPrijava = $red["ukupno"];
$podnesenoMaxPrijava = false;
if ($podnesenoPrijava >= $maxPrijava) {
    $podnesenoMaxPrijava = true;
}


//provjera je li otvoreno glasovanje i je li korisnik već glasovao
$upit = "SELECT status_izlozbe_id FROM izlozba WHERE izlozba_id = '{$izlozbaId}';";
$rezultat = $veza->selectDB($upit);
$red = mysqli_fetch_array($rezultat);
$statusIzlozbe = $red["status_izlozbe_id"];
$upit = "SELECT COUNT(*) as c FROM glas WHERE korisnik_korisnicko_ime = '{$korisnik}' AND izlozba_id = '{$izlozbaId}';";
$rezultat = $veza->selectDB($upit);
$red = mysqli_fetch_array($rezultat);
$vecGlasovao = false;
if ($red["c"] != 0) {
    $vecGlasovao = true;
}

$veza->zatvoriDB();

//glasovanje
if (isset($_GET["glas"]) && $statusIzlozbe == 3 && !$vecGlasovao) {
    $samoPristup = false;
    $vlakId = $_GET["glas"];
    $veza = new Baza();
    $veza->spojiDB();
    if ($veza->insertGlas($korisnik, $izlozbaId, $vlakId)) {
        $vecGlasovao = true;
        $veza->insertDnevnik(19, $_SESSION["korisnik"], "izlozba.php", "glas: {$vlakId}");
    }
    $veza->zatvoriDB();
}

if (isset($_POST["dodajPrijavuVlaka"]) && !$vecPoslaoPrijavu && !$prosloVrijemeZaSlanjePrijave && !$podnesenoMaxPrijava && $statusIzlozbe == 1) {
    $samoPristup = false;
    $korisnickoIme = $_SESSION["korisnik"];
    $nazivVlaka = $_POST["nazivVlaka"];
    $maxBrzina = $_POST["maxBrzina"];
    $brojSjedala = $_POST["brojSjedala"];
    $opis = $_POST["opis"];
    $pogonMotora = $_POST["pogonMotora"];
    $veza = new Baza();
    $veza->spojiDB();
    $veza->insertVlak($nazivVlaka, $maxBrzina, $brojSjedala, $opis, $pogonMotora, $korisnickoIme, $izlozbaId);
    $veza->insertDnevnik(20, $_SESSION["korisnik"], "izlozba.php", "vlak: {$nazivVlaka}");
    $veza->zatvoriDB();
    $vecPoslaoPrijavu = true;
}

if (isset($_POST["prihvatiPrijavu"])) {
    $samoPristup = false;
    $veza = new Baza();
    $veza->spojiDB();
    $veza->updatePrijavaVlaka($_POST["vlakId"], 1, 1);
    $veza->insertDnevnik(21, $_SESSION["korisnik"], "izlozba.php", "prijava: {$_POST['vlakId']}");
    $veza->zatvoriDB();
}

if (isset($_POST["odbijPrijavu"])) {
    $samoPristup = false;
    $veza = new Baza();
    $veza->spojiDB();
    $veza->updatePrijavaVlaka($_POST["vlakId"], 0, 1);
    $veza->insertDnevnik(22, $_SESSION["korisnik"], "izlozba.php", "prijava: {$_POST['vlakId']}");
    $veza->zatvoriDB();
}

//dodavanje materijala
if (isset($_POST["dodajMaterijal"])) {
    // TO DO: provjera jesu li unesena sva polja, provjera postoji li vec materijal sa zadanim nazivom
    $samoPristup = false;
    $nazivMaterijala = $_POST["nazivMaterijala"];
    $vrstaMaterijala = $_POST["vrstaMaterijala"];

    $userfile = $_FILES['materijalDatoteka']['tmp_name'];
    $userfile_name = $_FILES['materijalDatoteka']['name'];
    $userfile_size = $_FILES['materijalDatoteka']['size'];
    $userfile_type = $_FILES['materijalDatoteka']['type'];
    $userfile_error = $_FILES['materijalDatoteka']['error'];
    if ($userfile_error > 0) {
        echo 'Problem: ';
        switch ($userfile_error) {
            case 1: echo 'Veličina veća od ' . ini_get('upload_max_filesize');
                break;
            case 2: echo 'Veličina veća od ' . $_POST["MAX_FILE_SIZE"] . 'B';
                break;
            case 3: echo 'Datoteka djelomično prenesena';
                break;
            case 4: echo 'Datoteka nije prenesena';
                break;
        }
        exit;
    }

    if (!file_exists("datoteke/{$korisnik}")) {
        umask(0);
        mkdir("datoteke/{$korisnik}", 0777, true);
    }
    $upfile = "datoteke/{$korisnik}/" . $userfile_name;

    if (is_uploaded_file($userfile)) {
        if (!move_uploaded_file($userfile, $upfile)) {
            echo 'Problem: nije moguće prenijeti datoteku na odredište';
            exit;
        }
    } else {
        echo 'Problem: mogući napad prijenosom. Datoteka: ' . $userfile_name;
        exit;
    }

    $veza = new Baza();
    $veza->spojiDB();
    $veza->insertMaterijal($upfile, $nazivMaterijala, $vrstaMaterijala, $vlakId);
    $veza->insertDnevnik(23, $_SESSION["korisnik"], "izlozba.php", "materijal: {$upfile}");
    $veza->zatvoriDB();
}

if($samoPristup){
    $veza = new Baza();
    $veza->spojiDB();
    $veza->insertDnevnik(12, $_SESSION["korisnik"], "izlozba.php");
    $veza->zatvoriDB();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title><?php echo $nazivIzlozbe; ?></title>
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
            <h2><?php echo $nazivIzlozbe; ?></h2>
            <h3><a href="galerija.php?izlozbaId=<?php echo $izlozbaId; ?>&pogon=sve">Pogledaj galeriju</a></h3>
            <?php
            if ($statusIzlozbe == 3 && !$vecGlasovao) {
                echo "<h3><a href = 'izlozba.php?izlozbaId={$izlozbaId}&glasovanje=true'>Glasuj za pobjednika</a></h3>";
            }
            ?>

            <?php

            function urediIspis($ulaz, $duzinaRetka, $pocetak = "") {
                $duzina = strlen($ulaz);
                $izlaz = "";
                $zadnjiIndex = 0;
                for ($i = $duzinaRetka; $i < $duzina; $i += $duzinaRetka) {
                    $nijeRazmak = true;
                    $j = $i + 10;
                    while ($i < $duzina && $nijeRazmak && $i < $j) {
                        if (substr($ulaz, $i, 1) == " ") {
                            $nijeRazmak = false;
                        }
                        $i++;
                    }
                    if (!$nijeRazmak) {
                        if (!empty($izlaz)) {
                            $izlaz .= "<br>" . $pocetak;
                        }
                        $izlaz .= substr($ulaz, $zadnjiIndex, $i - $zadnjiIndex);
                        $zadnjiIndex = $i;
                    } else {
                        if (!empty($izlaz)) {
                            $izlaz .= "-<br>" . $pocetak . "-";
                        }
                        $i--;
                        $izlaz .= substr($ulaz, $zadnjiIndex, $i - $zadnjiIndex);
                        $zadnjiIndex = $i;
                    }
                }
                $izlaz .= "<br>" . $pocetak . substr($ulaz, $zadnjiIndex);
                return $izlaz;
            }

            if ($vecPoslaoPrijavu) {
                echo "<h3>Moja prijava</h3>";
                $veza = new Baza();
                $veza->spojiDB();
                $upit = "SELECT * FROM vlak v LEFT JOIN prijava_vlaka p ON p.vlak_id = v.vlak_id LEFT JOIN pogon_motora"
                        . " pm ON v.pogon_motora_id = pm.pogon_motora_id WHERE "
                        . "v.korisnik_korisnicko_ime = '{$korisnik}' AND izlozba_id = '{$izlozbaId}';";
                $rezultat = $veza->selectDB($upit);
                $red = mysqli_fetch_array($rezultat);
                echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;<b>Naziv vlaka:</b> " . $red["naziv_vlaka"] . "<br>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<b>Max brzina:</b> " . $red["max_brzina"] . "<br>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<b>Broj sjedala:</b> " . $red["broj_sjedala"] . "<br>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<b>Opis:</b> " .
                urediIspis($red["opis"], 100, '&nbsp;&nbsp;&nbsp;&nbsp;') . "<br>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<b>Pogon motora:</b> " . $red["naziv_pogona"] . ", " .
                $red["max_vrijeme_rada_sati"] . "h, " . $red["max_udaljenost_km"] . "km<br>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<b>Status prijave:</b> ";
                echo $red["pregledana_prijava"] ? ($red["potvrdjena_prijava"] ? "Prihvaćeno" : "Odbijeno") :
                        "Nije pregledano";
                echo "<br></p>";

                //dodavanje materijala
                if ($red["potvrdjena_prijava"]) {
                    echo "<br><form method='post' action='izlozba.php?izlozbaId={$izlozbaId}' "
                    . "enctype='multipart/form-data''><table>";
                    echo "<tr><td><label for='materijalDatoteka'>Dodaj materijale:</label></td>"
                    . "<td><input name='materijalDatoteka' type='file'/></td></tr>";
                    echo "<tr><td><label for='nazivMaterijala'>Naziv datoteke:</label></td>"
                    . "<td><input name='nazivMaterijala' type='text' size='20' maxlength='30'/></td></tr>";
                    echo "<tr><td><label for='vrstaMaterijala'>Vrsta materijala:</label></td>"
                    . "<td><input name='vrstaMaterijala' type='radio' value='slika'/><label>slika</label>"
                    . "<input name='vrstaMaterijala' type='radio' value='video'/><label>video</label>"
                    . "<input name='vrstaMaterijala' type='radio' value='audio'/><label>audio</label></td></tr>";
                    echo "</table>";
                    echo "<input name='dodajMaterijal' type='submit' value='Dodaj materijal'/>";
                    echo "</form>";
                }
                $veza->zatvoriDB();
            }
            ?>

            <h3>Popis prijava</h3>
            <?php
            if ($statusIzlozbe == 3 && !$vecGlasovao && isset($_GET['glasovanje'])) {
                echo "<br><h3>KLIKNITE na naziv vlaka za kojeg glasujete!</h3><br>";
            }
            ?>
            <table class="tablica">
                <thead><tr>
                        <th>Naziv vlaka</th>
                        <th>Max brzina</th>
                        <th>Broj sjedala</th>
                        <th>Opis</th>
                        <th>Pogon motora</th>
                        <th>Korisnik</th>
                        <?php
                        if ($jestModeratorIzlozbe) {
                            echo "<th>Status prijave</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $veza = new Baza();
                    $veza->spojiDB();
                    $upit = "SELECT v.vlak_id, v.naziv_vlaka, v.max_brzina, v.broj_sjedala, v.opis, p.naziv_pogona, "
                            . "pv.potvrdjena_prijava, pv.pregledana_prijava, v.korisnik_korisnicko_ime FROM"
                            . " prijava_vlaka pv LEFT JOIN vlak v ON pv.vlak_id = v.vlak_id LEFT JOIN pogon_motora p "
                            . "ON v.pogon_motora_id = p.pogon_motora_id WHERE pv.izlozba_id = '{$izlozbaId}'";
                    if (!$jestModeratorIzlozbe) {
                        $upit .= " AND pv.potvrdjena_prijava = '1';";
                    }
                    $rezultat = $veza->selectDB($upit);
                    while ($red = mysqli_fetch_array($rezultat)) {
                        $opis = urediIspis($red['opis'], 40);
                        if ($statusIzlozbe == 3 && !$vecGlasovao && isset($_GET['glasovanje'])) {
                            echo "<tr><td><h3><a href='izlozba.php?izlozbaId={$izlozbaId}&glas={$red['vlak_id']}'"
                            . ">{$red['naziv_vlaka']}</a></h3></td>";
                        } else {
                            echo "<tr><td>{$red['naziv_vlaka']}</td>";
                        }
                        echo "<td>{$red['max_brzina']}</td>"
                        . "<td>{$red['broj_sjedala']}</td><td>{$opis}</td>"
                        . "<td>{$red['naziv_pogona']}</td><td>{$red['korisnik_korisnicko_ime']}</td>";
                        if ($jestModeratorIzlozbe) {
                            echo "<td>";
                            echo $red["potvrdjena_prijava"] == 1 ? "Prihvaceno" : "Odbijeno";
                            echo "</td>";
                            if ($red["pregledana_prijava"] == 0) {
                                echo "<td><form method='post' action='izlozba.php?izlozbaId={$izlozbaId}'>"
                                . "<input type='hidden' name='vlakId' value='{$red['vlak_id']}'/>"
                                . "<input name='prihvatiPrijavu' type='submit' value='Prihvati'/>"
                                . "<input name='odbijPrijavu' type='submit' value='Odbij'/></form></td>";
                            }
                        }
                        echo "</tr>";
                    }
                    $veza->zatvoriDB();
                    ?>
                </tbody>
            </table>

            <button onclick="prikaziFormu()" id="sakrijPrijavaVlakaFormaBt" style="display:<?php
            echo
            ($vecPoslaoPrijavu || $prosloVrijemeZaSlanjePrijave || $podnesenoMaxPrijava || $statusIzlozbe != 1) ?
                    "none" : "block";
            ?>;"
                    >Dodaj novu prijavu</button>
            <script>
                function prikaziFormu() {
                    var forma = document.getElementById("novaPrijavaVlakaForm");
                    forma.style.display = "block";
                    var bt = document.getElementById("sakrijPrijavaVlakaFormaBt");
                    bt.style.display = "none";
                }
            </script>

            <div id="novaPrijavaVlakaForm" style="display:none;">
                <form method="post" action="izlozba.php?izlozbaId=<?php echo $izlozbaId; ?>">
                    <table>
                        <tr>
                            <td><label for="nazivVlaka">Naziv vlaka:</label></td>
                            <td><input name="nazivVlaka" type="text" size="20" maxlength="45"/></td>
                        </tr>
                        <tr>
                            <td><label for="maxBrzina">Max brzina:</label></td>
                            <td><input name="maxBrzina" type="text" size="20"/></td>
                        </tr>
                        <tr>
                            <td><label for="brojSjedala">Broj sjedala:</label></td>
                            <td><input name="brojSjedala" type="text" size="20"/></td>
                        </tr>
                        <tr>
                            <td><label for="opis">Opis:</label></td>
                            <td><textarea name="opis" rows="8" cols="20"></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="pogonMotora">Pogon motora:</label></td>
                            <td><?php
                                $veza = new Baza();
                                $veza->spojiDB();
                                $upit = "SELECT pogon_motora_id, naziv_pogona FROM pogon_motora;";
                                $rezultat = $veza->selectDB($upit);
                                while ($red = mysqli_fetch_array($rezultat)) {
                                    echo "<input name='pogonMotora' type='radio' value='{$red['pogon_motora_id']}'>"
                                    . "<label>{$red['naziv_pogona']}</label>";
                                }
                                $veza->zatvoriDB();
                                ?></td>
                        </tr>
                    </table>
                    <input name="dodajPrijavuVlaka" type="submit" value="Dodaj prijavu vlaka"/>
                </form>
            </div>

        </section>
    </body>

    <footer>
        <p>&copy; 2021.</p>
    </footer>
</html>