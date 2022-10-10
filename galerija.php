<?php
include "./baza.class.php";
include "./sesija.class.php";
Sesija::kreirajSesiju();


if (isset($_GET["izlozbaId"])) {
    $izlozbaId = $_GET["izlozbaId"];
    if (isset($_GET["pogon"])) {
        $pogon = $_GET["pogon"];
    } else {
        $pogon = "sve";
    }
    $poStranici = 10;
    if (isset($_GET["poStranici"]) && !empty($_GET["poStranici"])) {
        $poStranici = $_GET["poStranici"];
    }
    $stranica = 1;
    if (isset($_GET["stranica"])) {
        $stranica = $_GET["stranica"];
    }
    if (isset($_GET["promjenaStranice"])) {
        switch ($_GET["promjenaStranice"]) {
            case "<":
                $stranica--;
                break;
            case ">":
                $stranica++;
                break;
        }
    }
    $urlovi = [];
    $veza = new Baza();
    $veza->spojiDB();
    $upit = "SELECT m.url_materijala, m.naslov, pm.naziv_pogona FROM materijali_za_vlak m LEFT JOIN vlak v ON"
            . " m.vlak_id = v.vlak_id LEFT JOIN prijava_vlaka p "
            . "ON v.vlak_id = p.vlak_id LEFT JOIN pogon_motora pm ON pm.pogon_motora_id = v.pogon_motora_id WHERE "
            . "p.izlozba_id = '{$izlozbaId}' AND m.vrsta_materijala = 'slika'";
    if (!($pogon == "sve")) {
        $upit .= " AND pm.naziv_pogona = '{$pogon}'";
    }
    $rezultat = $veza->selectDB($upit);
    while ($red = mysqli_fetch_array($rezultat)) {
        array_push($urlovi, array("url" => $red["url_materijala"], "pogon" => $red["naziv_pogona"],
            "naslov" => $red["naslov"]));
    }
    $veza->zatvoriDB();
} else {
    header("Location: prijava.php");
    exit();
}

$veza = new Baza();
$veza->spojiDB();
$veza->insertDnevnik(12, $_SESSION["korisnik"], "galerija.php", "izlozba_id: {$izlozbaId}");
$veza->zatvoriDB();
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Galerija</title>
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
            <h2>Galerija</h2>

            <form method="get" action="galerija.php?izlozbaId=<?php echo $izlozbaId; ?>">
                <input type="hidden" name="izlozbaId" value="<?php echo $izlozbaId; ?>"/>
                <?php
                $veza = new Baza();
                $veza->spojiDB();
                $upit = "SELECT naziv_pogona FROM pogon_motora;";
                $rezultat = $veza->selectDB($upit);
                while ($red = mysqli_fetch_array($rezultat)) {
                    echo "<input name='pogon' type='radio' value='{$red['naziv_pogona']}'/>"
                    . "<label>{$red['naziv_pogona']}</label>";
                }
                $veza->zatvoriDB();
                ?>
                <input name="pogon" type="radio" value="sve"/>
                <label>sve</label><br>
                <label for="poStranici">Broj rezultata po stranici:</label>
                <input name="poStranici" type="number" size="20"/>
                <input type="submit" name="filtriraj" value="Filtriraj"/>
            </form>

            <div class="galerijaRed" id="slikeHtml">
                <?php
                $brojac = 1;
                foreach ($urlovi as $url) {
                    if ($brojac > (($stranica - 1) * $poStranici) && $brojac <= ($stranica * $poStranici)) {
                        echo "<figure><img src='{$url['url']}' alt='{$url['naslov']}' class='slikeGalerija'>"
                        . "<figcaption>{$url['naslov']}</figcaption></figure>";
                    }
                    $brojac++;
                }
                ?>
            </div>

            <form method="get" action="galerija.php">
                <input type="hidden" name="izlozbaId" value="<?php echo $izlozbaId; ?>"/>
                <input type="hidden" name="pogon" value="<?php echo $pogon; ?>"/>
                <input type="hidden" name="poStranici" value="<?php echo $poStranici; ?>"/>
                <?php
                if (sizeof($urlovi) > $poStranici) {
                    echo "<input type='hidden' name='stranica' value='{$stranica}'/>";
                    if ($stranica != 1) {
                        echo "<input type='submit' name='promjenaStranice' value='<'/>";
                    }
                    echo "<input type='submit' name='promjenaStranice' value='{$stranica}'/>";
                    if (sizeof($urlovi) > $poStranici * $stranica) {
                        echo "<input type='submit' name='promjenaStranice' value='>'/>";
                    }
                }
                ?>
            </form>
        </section>
    </body>

    <footer>
        <p>&copy; 2021.</p>
    </footer>
</html>