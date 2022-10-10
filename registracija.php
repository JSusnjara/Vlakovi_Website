<?php
include "./baza.class.php";
include "./sesija.class.php";
Sesija::kreirajSesiju();
if (isset($_SESSION["uloga"])) {
    header("Location: ./index.php");
    exit();
}

if (isset($_POST["registriraj"])) {
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
    }
    $greska = "";
    if (!$captcha) {
        $greska = "Molimo potvrdite da niste robot!";
    }
    $secretKey = "6Ld35gUbAAAAAJ_7pQ3zWTigpTeWMFcPvz9_I2yi";
    $ip = $_SERVER['REMOTE_ADDR'];
    // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);
    // should return JSON with success as true
    if ($responseKeys["success"]) {
        
    } else {
        $greska .= "Captcha provjera neuspješna!";
    }

    foreach ($_POST as $k => $v) {
        if (empty($v)) {
            $greska .= "Unos u polje {$k} prazno!<br>";
        }
        
        if($k == "email"){
            $uzorak = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/";
            if (!preg_match($uzorak, $v)) {
                $greska .= "Polje {$k} neispravnog formata <br>";
            }
        }
        
        if($k == "korisnickoIme"){
            if(strlen($v) < 4){
                $greska .= "Korisničko ime prekratko! <br>";
            }
        }
        
        if($k == "lozinka"){
            $uzorak = '/^(?!.*(.)\1{3})((?=.*[\d])(?=.*[A-Za-z])|(?=.*[^\w\d\s])(?=.*[A-Za-z])).{8,20}$/';
            if (!preg_match($uzorak, $v)) {
                $greska .= "Lozinka nije dovoljno sigurna. Mora imati barem 8 znakova, kombinacija slova i brojeva!<br>";
            }
        }
    }
    if (isset($_POST["lozinka"]) && isset($_POST["lozinkaPonovi"]) && $_POST["lozinka"] != $_POST["lozinkaPonovi"]) {
        $greska .= "Lozinke se ne podudaraju!<br>";
    }

    if (empty($greska)) {
        //registracija
        $ime = $_POST["ime"];
        $prezime = $_POST["prezime"];
        $korisnickoIme = $_POST["korisnickoIme"];
        $email = $_POST["email"];
        $lozinka = $_POST["lozinka"];

        $veza = new Baza();
        $veza->spojiDB();
        $rezultat = $veza->insertKorisnik($ime, $prezime, $korisnickoIme, $email, $lozinka);
        $veza->insertDnevnik(1, $korisnickoIme);
        $veza->zatvoriDB();
        if ($rezultat) {
            header("Location: ./prijava.php");
        } else {
            $greska .= "Neuspješna registracija!<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Registracija</title>
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
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>
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
            <h2>Registracija</h2>
            <div style="color:red;">
                <?php
                if (isset($greska)) {
                    echo "<p>$greska</p>";
                }
                ?>
            </div>

            <form method="post" action="registracija.php">
                <table>
                    <tr>
                        <td><label for="ime">Ime:</label></td>
                        <td><input name="ime" type="text" size="20" maxlength="45"/></td>
                    </tr>
                    <tr>
                        <td><label for="prezime">Prezime:</label></td>
                        <td><input name="prezime" type="text" size="20" maxlength="45"/></td>
                    </tr>
                    <tr>
                        <td><label for="email">E-mail:</label></td>
                        <td><input name="email" type="text" size="20" maxlength="45"/></td>
                    </tr>
                    <tr>
                        <td><label for="korisnickoIme">Korisničko ime:</label></td>
                        <td><input name="korisnickoIme" type="text" size="20" maxlength="25"/></td>
                    </tr>
                    <tr>
                        <td><label for="lozinka">Lozinka:</label></td>
                        <td><input name="lozinka" type="password" size="20" maxlength="25"/></td>
                    </tr>
                    <tr>
                        <td><label for="lozinkaPonovi">Ponovite lozinku:</label></td>
                        <td><input name="lozinkaPonovi" type="password" size="20" maxlength="25"/></td>
                    </tr>
                </table>
                <div class="g-recaptcha" data-sitekey="6Ld35gUbAAAAAHi5IDlar_wdLqQ1dKbfucBFUgJQ"></div>
                <input name="registriraj" type="submit" value="Registriraj se"/>
            </form>

        </section>
    </body>

    <footer>
        <p>&copy; 2021.</p>
    </footer>
</html>