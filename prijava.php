<?php
include "./baza.class.php";
include "./sesija.class.php";

Sesija::kreirajSesiju();

if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

if (isset($_GET["akcija"]) && $_GET["akcija"] === "odjava") {
    $veza = new Baza();
    $veza->spojiDB();
    if (isset($_SESSION["korisnik"])) {
        $veza->insertDnevnik(11, $_SESSION["korisnik"]);
    }
    $veza->zatvoriDB();
    Sesija::obrisiSesiju();
}

if (isset($_SESSION["uloga"])) {
    header("Location: ./index.php");
    exit();
}

$greska = "";
$poruka = "";

if (isset($_GET["user"]) && isset($_GET["kod"])) {
    $user = $_GET["user"];
    $kod = $_GET["kod"];

    $upit = "SELECT sol, datum_registracije, status FROM korisnik WHERE korisnicko_ime = '{$user}';";
    $veza = new Baza();
    $veza->spojiDB();
    $rezultat = $veza->selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $sol = $red["sol"];
    $status = $red["status"];
    $datumRegistracije = strtotime($red["datum_registracije"]);
    $datumSad = strtotime(Baza::Vrijeme("Y-m-d H:i:s"));
    $razlika = $datumSad - $datumRegistracije;
    $satiProslo = $razlika / 3600;
    if ($status == 1) {
        $greska .= "Aktivacijski link već je iskorišten!<br>";
    } else {
        if (hash("sha256", substr($sol, 0, 10)) == $kod && $satiProslo <= 14) {
            $veza->updateKorisnik($user, 1);
            $poruka .= "Uspješna registracija, sada se možete prijaviti!<br>";
        } else {
            $greska .= "Nevažeći aktivacijski link!<br>";
        }
    }
    $veza->zatvoriDB();
}

if (isset($_POST["prijavi"])) {
    if (empty($_POST["korisnickoIme"]) || empty($_POST["lozinka"]))
        $greska .= "Molimo unesite sve podatke!";
    if (empty($greska)) {
        $lozinka = $_POST["lozinka"];
        $korisnickoIme = $_POST["korisnickoIme"];
        $zapamtiMe = false;
        if (isset($_POST["zapamtiMe"]))
            $zapamtiMe = true;
        $veza = new Baza();
        $veza->spojiDB();
        $upit = "SELECT sol, lozinka_sha256, status, uloga_id, broj_neuspjesnih_prijava FROM korisnik WHERE "
                . "korisnicko_ime = '{$korisnickoIme}';";
        $rezultat = $veza->selectDB($upit);
        $red;
        if ($red = mysqli_fetch_array($rezultat)) {

            $status = $red["status"];
            $lozinka_sha256 = $red["lozinka_sha256"];
            $sol = $red["sol"];
            $uloga = $red["uloga_id"];
            $brojNeuspjesnihPokusaja = $red["broj_neuspjesnih_prijava"];
            if ($status == 0) {
                $greska .= "Molimo prvo aktivirajte korisnički račun preko linka poslanog na vašu e-mail adresu!<br>";
            } else {
                if ($brojNeuspjesnihPokusaja >= 3) {
                    $greska .= "Vaš račun je blokiran!";
                } else {
                    if (hash("sha256", $sol . $lozinka) == $lozinka_sha256) {
                        //uspjesna prijava
                        Sesija::kreirajKorisnika($korisnickoIme, $uloga);
                        if ($zapamtiMe) {
                            setcookie("korisnicko_ime", $korisnickoIme);
                        }
                        $veza->updateKorisnik($korisnickoIme, $status, $uloga, 0);
                        $veza->insertDnevnik(2, $korisnickoIme, "prijava.php");
                        $veza->zatvoriDB();
                        header("Location: ./index.php");
                        exit();
                    } else {
                        if ($brojNeuspjesnihPokusaja == 2) {
                            $greska .= "Tri neuspješna pokušaja prijave, vaš račun je zaključan!";
                        } else {
                            $greska .= "Neispravna lozinka!<br>";
                        }
                        $veza->updateKorisnik($korisnickoIme, $status, $uloga, $brojNeuspjesnihPokusaja + 1);
                        $veza->insertDnevnik(3, $korisnickoIme, "prijava.php");
                    }
                }
            }
        } else {
            $greska .= "Neispravno korisničko ime!<br>";
        }
        $veza->zatvoriDB();
    }
}

if (isset($_POST["zaboravljenaLozinka"])) {
    if (empty($_POST["korisnickoIme"]))
        $greska .= "Molimo unesite vaše korisničko ime!";
    if (empty($greska)) {
        $korisnickoIme = $_POST["korisnickoIme"];
        $veza = new Baza();
        $veza->spojiDB();
        $upit = "SELECT email, sol FROM korisnik WHERE korisnicko_ime = '{$korisnickoIme}';";
        $rezultat = $veza->selectDB($upit);
        if ($red = mysqli_fetch_array($rezultat)) {
            $email = $red["email"];
            $sol = $red["sol"];
            $rezultat = $veza->novaLozinka($korisnickoIme, $email, $sol);
            if ($rezultat) {
                $poruka .= "Nova lozinka uspješno kreirana i poslana na vašu e-mail adresu!";
                $veza->insertDnevnik(9, $korisnickoIme, "prijava.php");
            }
        }
        $veza->zatvoriDB();
    }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Prijava</title>
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
            <h2>Prijava</h2>
            <div style="color:red;">
                <?php
                if (isset($greska)) {
                    echo "<p>$greska</p>";
                }
                ?>
            </div>

            <div style="color:green;">
                <?php
                if (isset($poruka)) {
                    echo "<p>$poruka</p>";
                }
                ?>
            </div>

            <form method="post" action="prijava.php">
                <table>
                    <tr>
                        <td><label for="korisnickoIme">Korisničko ime:</label></td>
                        <td><input name="korisnickoIme" type="text" size="20" maxlength="25"
                            <?php
                            echo isset($_COOKIE["korisnicko_ime"]) ?
                                    "value='{$_COOKIE["korisnicko_ime"]}'" : ""
                            ?>/></td>
                    </tr>
                    <tr>
                        <td><label for="lozinka">Lozinka:</label></td>
                        <td><input name="lozinka" type="password" size="20"/></td>
                    </tr>
                    <tr>
                        <td><label for="zapamtiMe">Zapamti me</label></td>
                        <td><input name="zapamtiMe" type="checkbox"/></td>
                    </tr>
                </table>
                <input name="prijavi" type="submit" value="Prijavi se"/>
                <br>
                <input name="zaboravljenaLozinka" type="submit" value="Zaboravili ste lozinku?"/>
            </form>

        </section>
    </body>

    <footer>
        <p>&copy; 2021.</p>
    </footer>
</html>