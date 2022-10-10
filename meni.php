<?php

echo '<nav><ul>';
echo "<li><a href='./index.php'>Početna stranica</a></li>";
echo "<li><a href='./autor.html'>O autoru</a></li>";
echo "<li><a href='./rss.php'>RSS kanal</a></li>";

if (!isset($_SESSION["uloga"])) {
    echo "<li><a href='./registracija.php'>Registracija</a></li>";
    echo "<li><a href='./prijava.php'>Prijava</a></li>";
} else {
    $uloga = $_SESSION["uloga"];
    if($uloga == 1){
        echo "<li><a href='./tematike.php'>Tematike izložbi</a></li>";
        echo "<li><a href='./postavke.php'>Postavke</a></li>";
        echo "<li><a href='./dnevnik.php'>Dnevnik korištenja</a></li>";
    }
    if($uloga <= 2){
        echo "<li><a href='./moje_tematike.php'>Moje tematike izložbi</a></li>";
    }
    echo "<li><a href='./prijava.php?akcija=odjava'>Odjava</a></li>";
}

echo '</ul></nav>';
?>