<?php 
    session_start();

    $userStatus = $_SESSION["userStatus"];

    if($userStatus != "admin" && $userStatus != "user"){
        $msg = "Access to print page denied!";
    }

    require "DatabaseLayer/ConnectionClass.php";

    $ConnectionObject = new Connection("DatabaseLayer/ConnectionParameters.xml");
    $ConnectionObject->Connect();

    if(!$ConnectionObject->ConnectionToDB){
        echo "Connection error.";
        exit();
    }

    require "DataLayer/BaseClass.php";
    require "DataLayer/AranzmanClass.php";
    include "Utility/utilityFunctions.php";

    $AranzmanObject = new AranzmanClass($ConnectionObject, "Aranzman");
    $AranzmanObject->DajSveAranzmane();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Print</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="Bootstrap/CSS/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Styles/style-print.css">

</head>
<body>
    <h1>Lista aranžmana</h1>

    <?php if($AranzmanObject->itemsCount == 0) {?> <!-- IF begin -->
        <h1 class="text-center">Nema dostupnih aranžmana</h1>
    <?php } else {?> <!-- IF end ELSE begin -->
        <table>
            <?php PrintUserTableHeading(); ?>

            <?php
            $AranzmanCounter = 0;
            foreach ($AranzmanObject->itemsArray as $Index => $Array) {
                echo "<tr>";
                $AranzmanCounter++;
                PrintCellValue($AranzmanCounter);

                foreach ($Array as $Column => $Value) {
                    if ($Column == 0) {
                        continue; // skip printing AranzmanID
                    }
                    PrintCellValue($Value);
                }
                echo "</tr>";
            }?>
        </table>
    <?php }?> <!-- ELSE end -->     
    <!-- Bootstrap JS -->
    <script src="Bootstrap/JS/jquery.js"></script>
    <script src="Bootstrap/JS/bootstrap.min.js"></script>
</body>
</html>