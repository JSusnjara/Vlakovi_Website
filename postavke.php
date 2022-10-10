<?php
include "./baza.class.php";
include "./sesija.class.php";
Sesija::kreirajSesiju();


if (!isset($_SESSION["uloga"]) || $_SESSION["uloga"] != 1) {
    header("Location: prijava.php");
    exit();
}

$samoPristup = true;

//kreiranje sigurnosne kopije
if (isset($_POST["kreirajSigurnosnuKopiju"])) {
    $samoPristup = false;
    $filepath = "sigurnosna kopija.txt";
    $myfile = fopen($filepath, "w") or die("Ne može se napraviti back-up!");
    $text = "DELETE FROM materijali_za_vlak WHERE '1'='1';\nDELETE FROM prijava_vlaka WHERE '1'='1';\n"
            . "DELETE FROM glas WHERE '1'='1';\nDELETE FROM vlak WHERE '1'='1';\n";
    $veza = new Baza();
    $veza->spojiDB();

    $upit = "SELECT * FROM vlak;";
    $rezultat = $veza->selectDB($upit);
    while ($red = mysqli_fetch_array($rezultat)) {
        $text .= "INSERT INTO vlak (vlak_id, naziv_vlaka, max_brzina, broj_sjedala, opis, pogon_motora_id, korisnik_korisnicko_ime)"
                . " VALUES ('{$red['vlak_id']}', '{$red['naziv_vlaka']}', '{$red['max_brzina']}', '{$red['broj_sjedala']}', "
                . "'{$red['opis']}', '{$red['pogon_motora_id']}', '{$red['korisnik_korisnicko_ime']}');\n";
    }
    $upit = "SELECT * FROM prijava_vlaka;";
    $rezultat = $veza->selectDB($upit);
    while ($red = mysqli_fetch_array($rezultat)) {
        $text .= "INSERT INTO prijava_vlaka (izlozba_id, vlak_id, potvrdjena_prijava, pregledana_prijava, vrijeme_prijave)"
                . " VALUES ('{$red['izlozba_id']}', '{$red['vlak_id']}', '{$red['potvrdjena_prijava']}', "
                . "'{$red['pregledana_prijava']}', '{$red['vrijeme_prijave']}');\n";
    }
    $upit = "SELECT * FROM materijali_za_vlak;";
    $rezultat = $veza->selectDB($upit);
    while ($red = mysqli_fetch_array($rezultat)) {
        $text .= "INSERT INTO materijali_za_vlak (url_materijala, naslov, vrsta_materijala, vlak_id) VALUES "
                . "('{$red['url_materijala']}', '{$red['naslov']}', '{$red['vrsta_materijala']}', '{$red['vlak_id']}');\n";
    }
    $upit = "SELECT * FROM glas;";
    $rezultat = $veza->selectDB($upit);
    while ($red = mysqli_fetch_array($rezultat)) {
        $text .= "INSERT INTO glas (korisnik_korisnicko_ime, izlozba_id, vlak_id)"
                . " VALUES ('{$red['korisnik_korisnicko_ime']}', '{$red['izlozba_id']}', '{$red['vlak_id']}');\n";
    }

    $veza->insertDnevnik(13, $_SESSION["korisnik"], "postavke.php");
    $veza->zatvoriDB();
    fwrite($myfile, $text);
    fclose($myfile);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    flush(); // Flush system output buffer
    readfile($filepath);
    unlink($filepath); //obrisi
}

//vracanje iz skripte
if (isset($_POST["vratiIzSigurnosneKopije"]) && !empty($_FILES['backupDatoteka'])) {
    $samoPristup = false;
    $userfile = $_FILES['backupDatoteka']['tmp_name'];
    $userfile_name = $_FILES['backupDatoteka']['name'];
    $userfile_size = $_FILES['backupDatoteka']['size'];
    $userfile_type = $_FILES['backupDatoteka']['type'];
    $userfile_error = $_FILES['backupDatoteka']['error'];
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

    $upfile = 'datoteke' . $userfile_name;

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
    $redovi = explode("\n", file_get_contents($upfile));
    for ($i = 0; $i < sizeof($redovi) - 1; $i++) {
        $veza->selectDB($redovi[$i]);
    }
    $upit = "SELECT * FROM izlozba WHERE status_izlozbe_id = '4';";
    $rezultat = $veza->selectDB($upit);
    while ($red = mysqli_fetch_array($rezultat)) {
        $veza->zatvoriGlasovanje($red["izlozba_id"]);
    }
    $upit = "SELECT m.url_materijala, m.naslov, k.email, p.izlozba_id, i.naziv_izlozbe FROM materijali_za_vlak m "
            . "LEFT JOIN vlak v ON m.vlak_id = v.vlak_id LEFT JOIN korisnik k ON v.korisnik_korisnicko_ime = "
            . "k.korisnicko_ime LEFT JOIN prijava_vlaka p ON p.vlak_id = v.vlak_id LEFT JOIN izlozba i ON "
            . "i.izlozba_id = p.izlozba_id;";
    $rezultat = $veza->selectDB($upit);
    $email = " ";
    $poruka = "";
    $nazivIzlozbe = "";
    while ($red = mysqli_fetch_array($rezultat)) {
        if ($email != $red["email"]) {
            if (!empty($poruka)) {
                $mail_to = $email;
                $mail_from = "From: Vlakovi2020@foi.unizg.hr";
                $mail_subject = "{$nazivIzlozbe} - gubitak materijala";
                $mail_body = $poruka;
                mail($mail_to, $mail_subject, $mail_body, $mail_from);
                $poruka = "";
            }
            $email = $red["email"];
        }
        $nazivIzlozbe = "{$red['izlozba_id']} - {$red['naziv_izlozbe']}";
        if (!file_exists($red["url_materijala"])) {
            if (empty($poruka)) {
                $poruka = "Molimo ponovno uploadajte sljedeće materijale:\n";
            }
            $poruka .= $red["naslov"] . " - " . $red["url_materijala"] . "\n";
        }
    }

    $veza->insertDnevnik(14, $_SESSION["korisnik"], "postavke.php");
    $veza->zatvoriDB();
    unlink($upfile);
}

if(isset($_POST["blokiraj"])){
    $samoPristup = false;
    $veza = new Baza();
    $veza->spojiDB();
    $upit = "SELECT * FROM korisnik WHERE korisnicko_ime = '{$_POST['korisnickoIme']}';";
    $rezultat = $veza->selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $veza->updateKorisnik($_POST["korisnickoIme"], 1, $red["uloga_id"], 3);
    $veza->insertDnevnik(7, $_SESSION["korisnik"], "postavke.php", "blokiran: {$_POST['korisnickoIme']}");
    $veza->zatvoriDB();
}

if(isset($_POST["odblokiraj"])){
    $samoPristup = false;
    $veza = new Baza();
    $veza->spojiDB();
    $upit = "SELECT * FROM korisnik WHERE korisnicko_ime = '{$_POST['korisnickoIme']}';";
    $rezultat = $veza->selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $veza->updateKorisnik($_POST["korisnickoIme"], 1, $red["uloga_id"], 0);
    $veza->insertDnevnik(8, $_SESSION["korisnik"], "postavke.php", "odblokiran: {$_POST['korisnickoIme']}");
    $veza->zatvoriDB();
}

//virtualno vrijeme
if(isset($_POST["preuzmiPomak"])){
    $samoPristup = false;
    if(!($fp = fopen("http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json", "r"))){
        echo "Problem: nije moguće dohvatiti url pomaka vremena!";
    }
    $sadrzaj = fread($fp, 10000);
    $json = json_decode($sadrzaj);
    $sati = $json->WebDiP->vrijeme->pomak->brojSati;
    $sati = is_numeric($sati) ? $sati : 0;
    fclose($fp);
    
    $var = new \stdClass();
    $var->konfiguracija = new \stdClass();
    $var->konfiguracija->pomak = $sati;
    $sadrzaj = json_encode($var);
    $fp = fopen("json/konfiguracija.json", "w");
    fwrite($fp, $sadrzaj);
    fclose($fp);
    
    $veza = new Baza();
    $veza->spojiDB();
    $veza->insertDnevnik(10, $_SESSION["korisnik"], "postavke.php", "novi pomak: " . $sati);
    $veza->zatvoriDB();
}

if($samoPristup){
    $veza = new Baza();
    $veza->spojiDB();
    $veza->insertDnevnik(12, $_SESSION["korisnik"], "postavke.php");
    $veza->zatvoriDB();
}

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Postavke</title>
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
            <h2>Postavke</h2>

            <h3>Sigurnosna kopija</h3>
            <form method="post" action="postavke.php" enctype='multipart/form-data'>
                <input type="submit" name="kreirajSigurnosnuKopiju" value="Kreiraj sigurnosnu kopiju"/><br><br>
                <input type="file" name="backupDatoteka"/>
                <input type="submit" name="vratiIzSigurnosneKopije" value="Vrati iz sigurnosne kopije"/><br>
            </form>
            
            <h3>Virtualno vrijeme</h3>
            <form method="post" action="postavke.php">
                <a href="http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html" target="_blank">Postavi pomak vremena</a>
                <br><input type="submit" name="preuzmiPomak" value="Preuzmi pomak"/>
            </form>

            <h3>Upravljanje korisnicima</h3>
            <table class="tablica">
                <thead>
                    <tr>
                        <th>Korisničko ime</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Akcija</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $veza = new Baza();
                    $veza->spojiDB();
                    $upit = "SELECT * FROM korisnik;";
                    $rezultat = $veza->selectDB($upit);
                    while ($red = mysqli_fetch_array($rezultat)) {
                        echo "<tr><td>{$red['korisnicko_ime']}</td><td>{$red['ime']}</td><td>{$red['prezime']}</td>"
                        . "<td>{$red['email']}</td><td>";
                        echo $red["broj_neuspjesnih_prijava"] < 3 ? "Aktivan</td>" : "Blokiran</td>";
                        echo $red["broj_neuspjesnih_prijava"] < 3 ? ($red["uloga_id"] == 1 ? "<td>administrator</td>" :
                                        "<td><form method='post' action='postavke.php'><input type='hidden'"
                                        . " name='korisnickoIme' value='{$red['korisnicko_ime']}'/>"
                                        . "<input type='submit' name='blokiraj' value='Blokiraj'/></form></td>") :
                                "<td><form method='post' action='postavke.php'><input type='hidden'"
                                . " name='korisnickoIme' value='{$red['korisnicko_ime']}'/>"
                                . "<input type='submit' name='odblokiraj' value='Odblokiraj'/></form></td>";
                        echo "</tr>";
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