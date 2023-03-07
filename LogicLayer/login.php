<?php
    session_start();

    if(!isset($_POST["submitLogin"])){
        $msg = "Submit not clicked. Access Denied";
        header("Location:../prijava.php?error=$msg");
    }

    // Utility Class
    require_once "../Utility/utilityFunctions.php";

    // Get Login Info From The Form
    $loginUsername = $_POST["loginUsername"];
    $loginPassword = $_POST["loginPassword"];

    // Include classes
    require "../DatabaseLayer/ConnectionClass.php";
    require "../DataLayer/BaseClass.php";
    require "../DataLayer/UserClass.php";

    // Connect to database
    $ConnectionObject = new Connection("../DatabaseLayer/ConnectionParameters.xml");
    $ConnectionObject->Connect();

    // Check Connection
    if($ConnectionObject->ConnectionToDB){
        $currentUser = new User($ConnectionObject, "user");

        // Authenticate user in the database
        if($currentUser->AuthenticateUser($loginUsername, $loginPassword)){
            //PrintValueFormated($currentUser->itemsArray);
            //PrintValueFormated($currentUser->itemsNumberOfColumns);
            
            // Load data into the session
            $_SESSION["userID"] = $currentUser->GetNthColumn(0);
            $_SESSION["userRealName"] = $currentUser->GetNthColumn(1);
            $_SESSION["userSurname"] = $currentUser->GetNthColumn(2);
            $_SESSION["userStatus"] = $currentUser->GetNthColumn(3);
            $_SESSION["userUsername"] = $currentUser->GetNthColumn(4);
            $_SESSION["userPassword"] = $currentUser->GetNthColumn(5);
            

            if($_SESSION["userStatus"] == "admin"){
                $ConnectionObject->Disconnect();
                header("Location:../page-lista-aranzmana.php");
            }else {
                $ConnectionObject->Disconnect();
                header("Location:../page-main.php");
            }
        }else {
            $ConnectionObject->Disconnect();
            $msg = "Login information incorrect, try again.";
            header("Location:../prijava.php?error=$msg");
        }
    }

?>