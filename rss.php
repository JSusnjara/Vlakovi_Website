<?xml version="1.0"?>
<rss version="2.0">
    <channel>
        <title>Posljednje odobrene prijave za izložbe</title>
        <link>https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x126/rss.php</link>
        <description>Web stranica o vlakovima</description>

        <?php
        require "./baza.class.php";
        $veza = new Baza();
        $veza->spojiDB();
        $upit = "SELECT izlozba_id FROM izlozba;";
        $rezultat = $veza->selectDB($upit);
        while ($red = mysqli_fetch_array($rezultat)) {
            $izlozbaId = $red['izlozba_id'];
            $upit = "SELECT * FROM prijava_vlaka p LEFT JOIN vlak v ON p.vlak_id = v.vlak_id WHERE p.potvrdjena_prijava "
                    . "= '1' AND p.izlozba_id = '{$izlozbaId}' ORDER BY p.vrijeme_prijave DESC LIMIT 10;";
            $rezultat2 = $veza->selectDB($upit);
            while ($red = mysqli_fetch_array($rezultat2)) {
                echo "<item><title>{$red['vlak_id']}. {$red['naziv_vlaka']}</title>"
                . "<description>Max brzina: {$red['max_brzina']}, Broj sjedala: {$red["broj_sjedala"]}, "
                . "Opis: {$red['opis']}, Korisnik: {$red['korisnik_korisnicko_ime']}</description>"
                . "<link>https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x126/izlozba.php?izlozbaId="
                . "{$izlozbaId}</link></item>";
            }
        }

        $veza->zatvoriDB();
        ?>

    </channel>
</rss>