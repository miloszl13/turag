<?php

function PrintUserTableHeading(){
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Šifra aranžmana</th>";
    echo "<th>Destinacija</th>";
    echo "<th>Cena</th>";
    echo "<th>Datum polaska</th>";
    echo "</tr>";
}

function PrintCellValue($Value){
    echo "<td>";
    echo $Value;
    echo "</td>";
}
function PrintDestinacijaTableHeading(){
    echo "<tr>";
    echo "<th>Destinacija</th>";
    echo "<th>Drzava</th>";
    echo "<th class=\"td-adminControls\">Controls</th>";
    echo "</tr>";
}
function PrintErrorMessage($Message){
    echo "<h3 class=\"access-message access-denied\">" . $Message . "</h3>";
}

function PrintAdminTableHeading(){
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Aranžman ID</th>";
    echo "<th>Šifra aranžmana</th>";
    echo "<th>Destinacija</th>";
    echo "<th>Cena</th>";
    echo "<th>Datum polaska</th>";
    echo "<th class=\"td-adminControls\">Kontrole</th>";
    echo "</tr>";
}
