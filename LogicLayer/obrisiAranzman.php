<?php
    session_start();

    // Get user from session
    $userStatus = $_SESSION["userStatus"];

    if($UserStatus != "admin"){
        $msg = "You don't have the access to this page.";
        header("Location:../prijava.php?error=$msg");
    }

    // Include Classes
    require "../DatabaseLayer/ConnectionClass.php";
    require "../DataLayer/BaseClass.php";
    require "../DataLayer/AranzmanClass.php";

    // Include Utility
    require "../Utility/utilityFunctions.php";

    // Establish Connection
    $ConnectionObject = new Connection("../DatabaseLayer/ConnectionParameters.xml");
    $ConnectionObject->Connect();

    // Check Established Connection
    if($ConnectionObject->ConnectionToDB){
        $AranzmanObject = new AranzmanClass($ConnectionObject, "Aranzman");

        $AranzmanID = $_POST["AranzmanID"]; 

        $AranzmanObject->ObrisiAranzman($AranzmanID);
        
        header("Location:../page-lista-aranzmana.php");
    }else {
        $msg = "Connection error";
        header("Location:../page-lista-aranzmana.php?error=$msg");
    }
?>