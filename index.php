<?php
//WebDiP
//2016foi
// /var/www/WebDiP/2020_projekti/WebDiP2020x126
// admin_9kb7
include "./baza.class.php";
include "./sesija.class.php";
Sesija::kreirajSesiju();

if (isset($_SESSION["korisnik"])) {
    $veza = new Baza();
    $veza->spojiDB();
    $veza->insertDnevnik(12, $_SESSION["korisnik"], "index.php");
    $veza->zatvoriDB();
}

//promjena teme
if (isset($_GET["theme"])) {
    if (isset($_COOKIE["theme"])) {
        if ($_COOKIE["theme"] == "./css/jsusnjara.css") {
            setcookie("theme", "./css/jsusnjara_black_and_white.css");
        } else {
            setcookie("theme", "./css/jsusnjara.css");
        }
    } else {
        setcookie("theme", "./css/jsusnjara_black_and_white.css");
    }
    header("Location: index.php");
    exit();
}
if (isset($_GET["accessibility"])) {
    setcookie("theme", "./css/jsusnjara_accessibility.css");
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Početna stranica</title>
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
            <h2>Početna stranica</h2>
            <div class="ikone">
                <a href="index.php?theme=1">
                    <img src="./datoteke/theme_icon.jpg" alt="Promjeni temu" width="40"/>
                </a>
                <a href="index.php?accessibility=1">
                    <img src="./datoteke/accessibility_icon.png" alt="Prilagodba" width="40"/>
                </a>
            </div>


            <?php
            $veza = new Baza();
            $veza->spojiDB();
            $upit = "SELECT i.izlozba_id, i.naziv_izlozbe, i.datum_pocetka, i.max_prijava, i.status_izlozbe_id, "
                    . "i.tematika_id, i.vlak_pobjednik_id, s.naziv_statusa, t.naziv_tematike, v.naziv_vlaka, "
                    . "v.korisnik_korisnicko_ime, v.naziv_vlaka FROM izlozba i LEFT JOIN status_izlozbe s "
                    . "ON i.status_izlozbe_id = s.status_izlozbe_id "
                    . "LEFT JOIN tematika_izlozbe t ON i.tematika_id = t.tematika_id "
                    . "LEFT JOIN vlak v ON i.vlak_pobjednik_id = v.vlak_id;";
            $rezultat = $veza->selectDB($upit);
            while ($red = mysqli_fetch_array($rezultat)) {
                $izlozbaId = $red['izlozba_id'];
                $upit = "SELECT COUNT(*) as c FROM prijava_vlaka p WHERE p.izlozba_id = '{$izlozbaId}';";
                $rezultat2 = $veza->selectDB($upit);
                $red2 = mysqli_fetch_array($rezultat2);
                echo "<div class='d'><b>Naziv izložbe: "
                . "<a href='izlozba.php?izlozbaId={$red['izlozba_id']}'>{$red['naziv_izlozbe']}</a></b><br>"
                . "<b>Broj vlakova: {$red2['c']}</b><br><b>Tematika: </b>{$red['naziv_tematike']}<br>"
                . "<b>Status: </b>{$red['naziv_statusa']}<br>"
                . "<b>Datum početka: </b>{$red['datum_pocetka']}<br>"
                . "<b>Max prijava: </b>{$red['max_prijava']}<br>"
                . "<b>Pobjednik: </b>{$red['korisnik_korisnicko_ime']} - {$red['naziv_vlaka']}<br>";
                $upit = "SELECT * FROM prijava_vlaka p LEFT JOIN vlak v ON p.vlak_id = v.vlak_id WHERE p.izlozba_id "
                        . "= '{$izlozbaId}';";
                $rezultat2 = $veza->selectDB($upit);
                echo "<b>Članovi izložbe:</b>";
                $brojac = 0;
                while ($red = mysqli_fetch_array($rezultat2)) {
                    if ($brojac++ % 5 == 0) {
                        echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    echo "{$red['korisnik_korisnicko_ime']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                echo "</div>";
            }
            $veza->zatvoriDB();
            ?>

        </section>
    </body>

    <footer>
        <p>&copy; 2021.</p>
    </footer>
</html>