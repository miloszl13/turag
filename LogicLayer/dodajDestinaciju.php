<?php 
    session_start();

    $UserStatus = $_SESSION["userStatus"];

    if($UserStatus != "admin"){
        $msg = "You can't access that page";
        header("Location:../index.php?error=$msg");
    }

    require "../DatabaseLayer/ConnectionClass.php";

    $ConnectionObject = new Connection("../DatabaseLayer/ConnectionParameters.xml");
    $ConnectionObject->Connect();

    if(!$ConnectionObject->ConnectionToDB){
        echo "Connection Error";
        exit();
    }

    require "../DataLayer/BaseClass.php";
    require "../DataLayer/DestinacijaClass.php";

    $DestinacijaObject = new DestinacijaClass($ConnectionObject, "destinacija");

    $DestinacijaIme = $_POST["destinacija"];
    $Drzava = $_POST["drzava"];

    $DestinacijaObject->DodajDestinaciju($DestinacijaIme, $Drzava);
    
        $ConnectionObject->Disconnect();
        header("Location:../page-lista-destinacija.php");
?>