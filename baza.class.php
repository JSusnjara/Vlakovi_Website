<?php

class Baza {

    //WebDiP
    //2016foi

    /* const server = "localhost";
      const korisnik = "root";
      const lozinka = "root";
      const baza = "WebDiP2020x126"; */

    const server = "localhost";
    const korisnik = "WebDiP2020x126";
    const lozinka = "admin_9kb7";
    const baza = "WebDiP2020x126";

    private $veza = null;
    private $greska = '';

    function spojiDB() {
        $this->veza = new mysqli(self::server, self::korisnik, self::lozinka, self::baza);
        if ($this->veza->connect_errno) {
            echo "Neuspješno spajanje na bazu: " . $this->veza->connect_errno . ", " .
            $this->veza->connect_error;
            $this->greska = $this->veza->connect_error;
        }
        $this->veza->set_charset("utf8");
        if ($this->veza->connect_errno) {
            echo "Neuspješno postavljanje znakova za bazu: " . $this->veza->connect_errno . ", " .
            $this->veza->connect_error;
            $this->greska = $this->veza->connect_error;
        }
        return $this->veza;
    }

    function zatvoriDB() {
        $this->veza->close();
    }

    function selectDB($upit) {
        $rezultat = $this->veza->query($upit);
        if ($this->veza->connect_errno) {
            echo "Greška kod upita: {$upit} - " . $this->veza->connect_errno . ", " .
            $this->veza->connect_error;
            $this->greska = $this->veza->connect_error;
        }

        if (!$rezultat)
            $rezultat = null;
        return $rezultat;
    }

    function pogreskaDB() {
        if ($this->greska != '') {
            return true;
        } else {
            return false;
        }
    }

    function insertKorisnik($ime, $prezime, $korisnickoIme, $email, $lozinka) {

        $slova = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $sol = "";
        for ($i = 0; $i < 20; $i++) {
            $sol .= substr($slova, rand(0, 61), 1);
        }
        $datum = $this->Vrijeme("Y-m-d H:i:s");
        $lozinkaSha = hash("sha256", $sol . $lozinka);
        $upit = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, sol, lozinka_sha256, email, "
                . "status, uloga_id, broj_neuspjesnih_prijava, datum_registracije) VALUES ('{$ime}', '{$prezime}', '{$korisnickoIme}', '{$lozinka}', "
                . "'{$sol}', '{$lozinkaSha}', '{$email}', '0', '3', '0', '{$datum}');";
        $rezultat = $this->veza->query($upit);
        if ($rezultat) {
            $link = hash("sha256", substr($sol, 0, 10));
            $mail_to = $email;
            $mail_from = "From: Vlakovi2020@foi.unizg.hr";
            $mail_subject = "{$korisnickoIme} - aktivacijski kod";
            $mail_body = "Uspješno kreiran korisnički račun.\nZa završetak registracije kliknite na sljedeći link:\n"
                    . "https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x126/prijava.php?user={$korisnickoIme}"
                    . "&kod={$link}";
            mail($mail_to, $mail_subject, $mail_body, $mail_from);
        }
        return $rezultat;
    }

    function updateKorisnik($korisnickoIme, $status = 0, $ulogaId = 3, $brojNeuspjesnihPrijava = 0) {
        $upit = "UPDATE korisnik SET status = '{$status}', uloga_id = '{$ulogaId}', broj_neuspjesnih_prijava = "
                . "'{$brojNeuspjesnihPrijava}' WHERE korisnicko_ime = '{$korisnickoIme}';";
        $rezultat = $this->veza->query($upit);
        return $rezultat;
    }

    function novaLozinka($korisnickoIme, $email, $sol) {
        $lozinka = "";
        $slova = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for ($i = 0; $i < 12; $i++) {
            $lozinka .= substr($slova, rand(0, 61), 1);
        }
        $lozinkaSha = hash("sha256", $sol . $lozinka);
        $upit = "UPDATE korisnik SET lozinka = '{$lozinka}', lozinka_sha256 = '{$lozinkaSha}' WHERE korisnicko_ime = "
                . "'{$korisnickoIme}';";
        $rezultat = $this->veza->query($upit);
        if ($rezultat) {
            $mail_to = $email;
            $mail_from = "From: Vlakovi2020@foi.unizg.hr";
            $mail_subject = "{$korisnickoIme} - nova lozinka";
            $mail_body = "Vaša nova lozinka za https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x126 glasi:\n"
                    . "{$lozinka}";
            mail($mail_to, $mail_subject, $mail_body, $mail_from);
        }
        return $rezultat;
    }

    function insertTematika($tematika, $opis, $moderatori) {

        $upit = "INSERT INTO tematika_izlozbe (naziv_tematike, opis_tematike) VALUES ('{$tematika}', '{$opis}');";
        $rezultat = $this->veza->query($upit);
        if ($rezultat != 1) {
            return false;
        }
        $tematika_id = $this->veza->insert_id;
        //insert moderatori
        foreach ($moderatori as $mod) {
            $upit = "INSERT INTO upravlja_tematikom (tematika_id, moderator_korisnicko_ime) VALUES ('{$tematika_id}',"
                    . "'{$mod}');";
            $rezultat = $this->veza->query($upit);
        }
        //rezultat je broj unesenih redaka, ali stalno je prebrisan
        return $rezultat;
    }

    function updateTematika($id, $tematika, $opis, $moderatori) {

        $upit = "UPDATE tematika_izlozbe SET naziv_tematike = '{$tematika}', opis_tematike = '{$opis}' WHERE tematika_id"
                . " = '{$id}';";
        $rezultat = $this->veza->query($upit);
        if ($rezultat != 1) {
            return false;
        }

        $upit = "DELETE FROM upravlja_tematikom WHERE tematika_id = '{$id}';";
        $rezultat = $this->veza->query($upit);

        foreach ($moderatori as $mod) {
            $upit = "INSERT INTO upravlja_tematikom (tematika_id, moderator_korisnicko_ime) VALUES ('{$id}', '{$mod}');";
            $rezultat = $this->veza->query($upit);
        }
        //rezultat je broj unesenih redaka, ali stalno je prebrisan
        return $rezultat;
    }

    function insertIzlozba($nazivIzlozbe, $datumPocetka, $maxPrijava, $statusIzlozbe, $tematikaId) {

        $upit = "INSERT INTO izlozba (naziv_izlozbe, datum_pocetka, max_prijava, status_izlozbe_id, tematika_id) "
                . "VALUES ('{$nazivIzlozbe}', '{$datumPocetka}', '{$maxPrijava}', '{$statusIzlozbe}', '{$tematikaId}');";
        $rezultat = $this->veza->query($upit);
        return $rezultat;
    }

    function updateIzlozba($idIzlozbe, $nazivIzlozbe, $datumPocetka, $maxPrijava, $statusIzlozbe) {

        $upit = "UPDATE izlozba SET naziv_izlozbe = '{$nazivIzlozbe}', datum_pocetka = '{$datumPocetka}', "
                . "max_prijava = '{$maxPrijava}', status_izlozbe_id = '{$statusIzlozbe}' WHERE izlozba_id = '{$idIzlozbe}';";
        $rezultat = $this->veza->query($upit);
        return $rezultat;
    }

    function insertVlak($nazivVlaka, $maxBrzina, $brojSjedala, $opis, $pogonMotoraId, $korisnickoIme, $izlozbaId) {

        $upit = "INSERT INTO vlak (naziv_vlaka, max_brzina, broj_sjedala, opis, pogon_motora_id, korisnik_korisnicko_ime)"
                . " VALUES ('{$nazivVlaka}', '{$maxBrzina}', '{$brojSjedala}', '{$opis}', '{$pogonMotoraId}',"
                . " '{$korisnickoIme}');";
        $rezultat = $this->veza->query($upit);
        $vlakId = $this->veza->insert_id;
        $datum = $this->Vrijeme("Y-m-d H:i:s");
        $upit = "INSERT INTO prijava_vlaka (izlozba_id, vlak_id, vrijeme_prijave) VALUES ('{$izlozbaId}', '{$vlakId}', "
                . "'{$datum}');";
        $rezultat = $this->veza->query($upit);
    }

    function updatePrijavaVlaka($vlakId, $potvrdjenaPrijava, $pregledanaPrijava) {
        $upit = "UPDATE prijava_vlaka SET potvrdjena_prijava = '{$potvrdjenaPrijava}', pregledana_prijava = "
                . "'{$pregledanaPrijava}' WHERE vlak_id = '{$vlakId}';";
        $rezultat = $this->veza->query($upit);
        return $rezultat;
    }

    function insertMaterijal($urlMaterijala, $nazivMaterijala, $vrstaMaterijala, $vlakId) {
        $upit = "INSERT INTO materijali_za_vlak (url_materijala, naslov, vrsta_materijala, vlak_id) VALUES ("
                . "'{$urlMaterijala}', '{$nazivMaterijala}', '{$vrstaMaterijala}', '{$vlakId}');";
        $rezultat = $this->veza->query($upit);
        return $rezultat;
    }

    function insertGlas($korisnickoIme, $izlozbaId, $vlakId) {
        $upit = "SELECT COUNT(*) as c FROM prijava_vlaka WHERE izlozba_id = '{$izlozbaId}' AND vlak_id = '{$vlakId}';";
        $rezultat = $this->selectDB($upit);
        $red = mysqli_fetch_array($rezultat);
        if ($red["c"] == 0) {
            return false;
        }
        $upit = "INSERT INTO glas (korisnik_korisnicko_ime, izlozba_id, vlak_id) VALUES ('{$korisnickoIme}', "
                . "'{$izlozbaId}', '{$vlakId}');";
        $this->veza->query($upit);
        return true;
    }

    function zatvoriGlasovanje($izlozbaId) {
        $upit = "SELECT COUNT(*) AS c, vlak_id FROM glas WHERE izlozba_id = '{$izlozbaId}' GROUP BY vlak_id "
                . "ORDER BY c DESC LIMIT 1;";
        $rezultat = $this->selectDB($upit);
        if ($red = mysqli_fetch_array($rezultat)) {
            $vlakId = $red["vlak_id"];
            $upit = "UPDATE izlozba SET vlak_pobjednik_id = '{$vlakId}' WHERE izlozba_id = '{$izlozbaId}';";
            $this->veza->query($upit);
        }
    }
    
    function insertDnevnik($radnjaId, $korisnickoIme, $stranica = null, $radnja = null){
        $datum = $this->Vrijeme("Y-m-d H:i:s");
        $upit = "INSERT INTO dnevnik (tip_tip_id, korisnik_korisnicko_ime, datum_vrijeme, stranica, radnja) VALUES "
                . "('{$radnjaId}', '{$korisnickoIme}', '{$datum}', '{$stranica}', '{$radnja}');";
        $this->veza->query($upit);
    }

    static function Vrijeme($format) {
        $fp = fopen("json/konfiguracija.json", "r");
        $sadrzaj = fread($fp, 10000);
        $json = json_decode($sadrzaj);
        $sati = $json->konfiguracija->pomak;
        $vrijeme = new DateTime();
        $vrijeme->add(new DateInterval("PT{$sati}H"));
        $vrijeme = $vrijeme->format($format);
        return $vrijeme;
    }
    

}

?>