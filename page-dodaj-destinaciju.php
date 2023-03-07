<?php
    session_start();

    $UserStatus = $_SESSION["userStatus"];

    if($UserStatus != "admin" && $UserStatus != "user"){
        $msg = "Nemate pristup ovoj stranici";
        header("Location:index.php?error=$msg");
    }

    $SiteTitle = "Dodaj destinaciju";

    require "DatabaseLayer/ConnectionClass.php";

    $ConnectionObject = new Connection("DatabaseLayer/ConnectionParameters.xml");
    $ConnectionObject->Connect();

    if(!$ConnectionObject->ConnectionToDB){
        echo "Connection Error";
        exit();
    }

    require "DataLayer/BaseClass.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Dodaj destinaciju</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="Bootstrap/CSS/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Styles/style.css">

</head>
<body>
    <!-- Navigation -->
    <?php include "Includes/navigation-inner.php"; ?>

    <!-- User Aside -->
    <?php include "Includes/aside-admin.php"; ?>

    <section class="section-table col-10 offset-2">
        <h1 class="section-title">Dodaj destinaciju</h1>
        <form action="LogicLayer/dodajDestinaciju.php" method="POST">

            <div class="form-row">
                <label class="form-label" for="destinacija">Destinacija</label>
                <input class="form-text" type="text" name="destinacija" id="destinacija" required>
            </div>
            <div class="form-row">
                <label class="form-label" for="drzava">Država</label>
                <input class="form-text" type="text" name="drzava" id="drzava" required>
            </div>
            <div class="form-row">
                <input class="btn btn-primary" name="DestinacijaSubmit" type="submit" value="Potvrdi">
            </div>
        </form>
    </section>

    <!-- Bootstrap JS -->
    <script src="Bootstrap/JS/jquery.js"></script>
    <script src="Bootstrap/JS/bootstrap.min.js"></script>
</body>
</html>