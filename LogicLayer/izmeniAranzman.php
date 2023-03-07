<?php
    session_start();

    $UserStatus = $_SESSION["userStatus"];

    if($UserStatus != "admin"){
        $msg = "You don't have the access to this page.";
        header("Location:../prijava.php?error=$msg");
    }

    require "../DatabaseLayer/ConnectionClass.php";

    $ConnectionObject = new Connection("../DatabaseLayer/ConnectionParameters.xml");
    $ConnectionObject->Connect();

    if(!$ConnectionObject->ConnectionToDB){
        echo "Connection error.";
        exit();
    }

    require "../DataLayer/BaseClass.php";
    require "../DataLayer/AranzmanClass.php";

    $AranzmanID = $_POST["AranzmanID"];
    $Sifra = $_POST["novaSifra"];
    $NazivDestinacije = $_POST["novaDestinacija"];
    $Cena = $_POST["novaCena"];
    $DatumPolaska = $_POST["noviDatumPolaska"];

    $AranzmanObject = new AranzmanClass($ConnectionObject, "Aranzman");

    $AranzmanObject->AzurirajAranzman($AranzmanID, $Sifra, $NazivDestinacije, $Cena, $DatumPolaska);

    header("Location:../page-lista-aranzmana.php");
?>