<?php
    session_start();
    include "Utility/utilityFunctions.php";

    $UserStatus = $_SESSION["userStatus"];

    if($UserStatus != "admin" && $UserStatus != "user"){
        $msg = "You don't have access to this page.";
        header("Location:prijava.php?error=$msg");
    }

    require "DatabaseLayer/ConnectionClass.php";

    $ConnectionObject = new Connection("DatabaseLayer/ConnectionParameters.xml");
    $ConnectionObject->Connect();

    if(!$ConnectionObject->ConnectionToDB){
        echo "Connection Error";
        exit();
    }

    require "DataLayer/BaseClass.php";
    require "DataLayer/AranzmanClass.php";

    $AranzmanObject = new AranzmanClass($ConnectionObject, "Aranzman");


    if(isset($_POST["filterSubmit"])){
        $FilterValue = $_POST["filterInput"];

        $AranzmanObject->DajAranzmanPoDestinaciji($FilterValue);
    }else {
        $AranzmanObject->DajSveAranzmane();
    }

    $ConnectionObject->Disconnect();
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Korisnicki panel</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="Bootstrap/CSS/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Styles/style.css">

</head>

<body>
    <!-- Navigation -->
    <?php include "Includes/navigation.php"; ?>

    <!-- User Aside -->
    <?php include "Includes/aside-user.php"; ?>
        
    <section class="section-table col-10 offset-2">
        <h1 class="section-title">Lista aranžmana</h1>

        <h2 class="text-center">Filtriraj po destinaciji</h2>
        <form class="form-filter" action="page-main.php" method="POST">
            <label class="form-label" for="filterInput">Filter:</label>
            <input class="form-text" type="text" name="filterInput" id="filterInput">
            <input class="mx-2 btn btn-primary" type="submit" name="filterSubmit" value="Filter">
            <input class="mx-2 btn btn-primary" type="submit" value="Prikaži sve">
        </form>


        <?php if($AranzmanObject->itemsCount == 0) {?> <!-- IF begin -->
            <h1 class="text-center">Nema dostupnih aranžmana</h1>
        <?php } else {?> <!-- IF end, ELSE begin -->
            <!-- Table -->
            <table class="table-clients">
                <?php
                PrintUserTableHeading();
                $AranzmanCounter = 1;

                if ($AranzmanObject->itemsArray == 0) {
                    echo "<h1 class=\"text-center my-5\"> No data to display for this filter value</h1>";
                } else {
                    foreach ($AranzmanObject->itemsArray as $ListRow => $RowArray) {
                        echo "<tr>";
                        PrintCellValue($AranzmanCounter);
                        
                        foreach ($RowArray as $ArrayItem => $Value) {
                            if ($ArrayItem == 0) { // Skip printing AranzmanID
                                continue;
                            }
                            PrintCellValue($Value);
                        }
                        $AranzmanCounter++;
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        <?php }?> <!-- ELSE end -->
    </section>
        
    <!-- Bootstrap JS -->
    <script src="Bootstrap/JS/jquery.js"></script>
    <script src="Bootstrap/JS/bootstrap.min.js"></script>
</body>

</html>