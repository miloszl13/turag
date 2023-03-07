<?php 
    session_start();

    $UserStatus = $_SESSION["userStatus"];

    if($UserStatus != "admin"){
        $msg = "Nemate pravo da pristupite ovoj stranici";
        header("Location:../index.php?error=$msg");
    }

    require "../DatabaseLayer/ConnectionClass.php";
    require "../DataLayer/BaseClass.php";
    require "../DataLayer/DestinacijaClass.php";
    require "../DataLayer/AranzmanClass.php";

    $ConnectionObject = new Connection("../DatabaseLayer/ConnectionParameters.xml");
    $ConnectionObject->Connect();

    if(!$ConnectionObject->ConnectionToDB){
        echo "Connection Error";
        exit();
    }

    $TargetID = $_POST["DestinacijaID"];

    $DestinacijaObject = new DestinacijaClass($ConnectionObject, "destinacija");
    {
        $DestinacijaObject->ObrisiDestinaciju($TargetID);
        $ConnectionObject->Disconnect();
        header("Location:../page-lista-destinacija.php");
    }

?>