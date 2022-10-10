<?php
include "./baza.class.php";
include "./sesija.class.php";
Sesija::kreirajSesiju();

if (!(isset($_SESSION["uloga"]) && $_SESSION["uloga"] <= 2)) {
    header("Location: prijava.php");
    exit();
}

//dohvacanje podataka sa ili bez trazilice
$veza = new Baza();
$veza->spojiDB();
$upit = "SELECT * FROM dnevnik LEFT JOIN tip ON tip_tip_id = tip_id";
$zapisi = [];
if (isset($_POST["trazi"])) {
    $korisnik = $_POST["korisnik"];
    $radnja = $_POST["radnja"];
    $and = false;
    if (strval($korisnik) != "0") {
        $and = true;
        $upit .= " WHERE korisnik_korisnicko_ime = '{$korisnik}'";
    }
    if ($radnja != 0) {
        if ($and) {
            $upit .= " AND tip_tip_id = '{$radnja}'";
        } else {
            $upit .= " WHERE tip_tip_id = '{$radnja}'";
        }
    }
}
$rezultat = $veza->selectDB($upit);
while ($red = mysqli_fetch_array($rezultat)) {
    array_push($zapisi, array("korisnik_korisnicko_ime" => $red['korisnik_korisnicko_ime'], "naziv_radnje" =>
        $red['naziv_radnje'], "radnja" => $red['radnja'], "stranica" => $red['stranica'], "datum_vrijeme" =>
        $red['datum_vrijeme']));
}

$veza->zatvoriDB();

//dohvacanje podataka za statistiku
$veza = new Baza();
$veza->spojiDB();
$upit = "SELECT korisnik_korisnicko_ime, stranica, COUNT(*) as c FROM dnevnik";
$statistika = [];
if (isset($_POST["filter"])) {
    $korisnik = $_POST["korisnik"];
    $datumOd = $_POST["datumOd"];
    $datumDo = $_POST["datumDo"];
    $and = false;
    if (strval($korisnik) != "0") {
        $and = true;
        $upit .= " WHERE korisnik_korisnicko_ime = '{$korisnik}'";
    }
    if ($and) {
        $upit .= " AND datum_vrijeme > '{$datumOd} 00:00:00' AND datum_vrijeme < '{$datumDo} 00:00:00'";
    } else {
        $upit .= " WHERE datum_vrijeme > '{$datumOd} 00:00:00' AND datum_vrijeme < '{$datumDo} 00:00:00'";
    }
}
$upit .= " GROUP BY korisnik_korisnicko_ime, stranica";
$rezultat = $veza->selectDB($upit);
while ($red = mysqli_fetch_array($rezultat)) {
    array_push($statistika, array("korisnik" => $red['korisnik_korisnicko_ime'],
        "stranica" => $red['stranica'], "broj" => $red['c']));
}
$veza->zatvoriDB();

$veza = new Baza();
$veza->spojiDB();
$veza->insertDnevnik(12, $_SESSION["korisnik"], "dnevnik.php");
$veza->zatvoriDB();
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Dnevnik korištenja</title>
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
            <h2>Dnevnik korištenja</h2>

            <div class='d'>
                <form method="post" action="dnevnik.php">
                    <table>
                        <tr>
                            <td><label for="korisnik">Korisnik:</label></td>
                            <td><select name="korisnik">
                                    <option value="0" selected="selected">- sve -</option>
                                    <?php
                                    $veza = new Baza();
                                    $veza->spojiDB();
                                    $upit = "SELECT * FROM korisnik;";
                                    $rezultat = $veza->selectDB($upit);
                                    while ($red = mysqli_fetch_array($rezultat)) {
                                        echo "<option value='{$red['korisnicko_ime']}'"
                                        . ">{$red['ime']} {$red['prezime']} - {$red['korisnicko_ime']}</option>";
                                    }
                                    $veza->zatvoriDB();
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td><label for="radnja">Radnja:</label></td>
                            <td><select name="radnja">
                                    <option value="0" selected="selected">- sve -</option>
                                    <?php
                                    $veza = new Baza();
                                    $veza->spojiDB();
                                    $upit = "SELECT * FROM tip;";
                                    $rezultat = $veza->selectDB($upit);
                                    while ($red = mysqli_fetch_array($rezultat)) {
                                        echo "<option value='{$red['tip_id']}'>{$red['naziv_radnje']}</option>";
                                    }
                                    $veza->zatvoriDB();
                                    ?>
                                </select></td>
                            <td><input name="trazi" type="submit" value="Traži"/></td>
                        </tr>
                    </table>
                </form>
            </div>

            <table class="tablica">
                <thead>
                    <tr>
                        <th>Korisnik</th>
                        <th>Radnja</th>
                        <th>Opis</th>
                        <th>Stranica</th>
                        <th>Vrijeme</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($zapisi as $red) {
                        echo "<tr><td>{$red['korisnik_korisnicko_ime']}</td><td>{$red['naziv_radnje']}</td>"
                        . "<td>{$red['radnja']}</td><td>{$red['stranica']}</td><td>{$red['datum_vrijeme']}</td></tr>";
                    }
                    ?>
                </tbody>
            </table>


            <br><h2>Statistika korištenja stranica</h2>

            <div class='d'>
                <form method="post" action="dnevnik.php">
                    <table>
                        <tr>
                            <td><label for="korisnik">Korisnik:</label></td>
                            <td><select name="korisnik">
                                    <option value="0" selected="selected">- sve -</option>
                                    <?php
                                    $veza = new Baza();
                                    $veza->spojiDB();
                                    $upit = "SELECT * FROM korisnik;";
                                    $rezultat = $veza->selectDB($upit);
                                    while ($red = mysqli_fetch_array($rezultat)) {
                                        echo "<option value='{$red['korisnicko_ime']}'"
                                        . ">{$red['ime']} {$red['prezime']} - {$red['korisnicko_ime']}</option>";
                                    }
                                    $veza->zatvoriDB();
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td><label for="datumOd">Datum od:</label></td>
                            <td><input type="date" name="datumOd" value="2018-07-22"/></td>
                            <td><label for="datumDo">Datum do:</label></td>
                            <td><input type="date" name="datumDo" value="2022-07-22"/></td>
                            <td><input name="filter" type="submit" value="Filtriraj"/></td>
                        </tr>
                    </table>
                </form>
            </div>

            <?php
            $stranice = array("index.php", "galerija.php", "izlozbe.php", "izlozba.php", "postavke.php", "dnevnik.php");
            foreach ($stranice as $stranica) {
                echo "<div class='d'>
                <h3>{$stranica}</h3>
                <table>
                    <thead>
                        <tr>
                            <td>Korisnik</td>
                            <td>Broj pristupa</td>
                        </tr>
                    </thead>
                    <tbody>";
                foreach ($statistika as $red) {
                    if ($red["stranica"] == $stranica) {
                        echo "<tr><td>{$red['korisnik']}</td><td>{$red['broj']}</td></tr>";
                    }
                }
                echo "</tbody>
                </table>
            </div>";
            }
            ?>

        </section>
    </body>

    <footer>
        <p>&copy; 2021.</p>
    </footer>
</html>