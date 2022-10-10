<?php
include "./baza.class.php";
include "./sesija.class.php";
Sesija::kreirajSesiju();

if (!(isset($_SESSION["uloga"]) && $_SESSION["uloga"] <= 2 )) {
    header("Location: index.php");
    exit();
}

$veza = new Baza();
$veza->spojiDB();
$veza->insertDnevnik(12, $_SESSION["korisnik"], "moje_tematike.php");
$veza->zatvoriDB();
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Moje tematike izložbi</title>
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
            <h2>Moje tematike izložbi</h2>

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
                    $upit = "SELECT * FROM tematika_izlozbe t LEFT JOIN upravlja_tematikom u ON t.tematika_id = "
                            . "u.tematika_id WHERE u.moderator_korisnicko_ime = '{$_SESSION['korisnik']}';";
                    $rezultat = $veza->selectDB($upit);
                    while ($red = mysqli_fetch_array($rezultat)) {
                        $tematikaId = $red['tematika_id'];
                        echo "<tr><td>{$tematikaId}</td>"
                        . "<td><a href='./izlozbe.php?tematikaId={$tematikaId}'>{$red['naziv_tematike']}</a></td>"
                        . "<td>{$red['opis_tematike']}</td><td>";
                        $upit = "SELECT * FROM korisnik k, upravlja_tematikom u WHERE u.tematika_id = '{$tematikaId}'"
                                . " AND k.korisnicko_ime = u.moderator_korisnicko_ime;";
                        $rezultat2 = $veza->selectDB($upit);
                        $moderatori = [];
                        while ($red = mysqli_fetch_array($rezultat2)) {
                            echo "{$red['ime']} {$red['prezime']} ({$red['korisnicko_ime']})<br>";
                            array_push($moderatori, $red['korisnicko_ime']);
                        }
                    }
                    $veza->zatvoriDB();
                    ?>
                </tbody>
            </table>

        </section>
    </body>

    <footer>
        <p>&copy; 2021.</p>
    </footer>
</html>