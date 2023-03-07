<?php 
    session_start();
    
    $UserStatus = $_SESSION["userStatus"];
    
    
    if($UserStatus != "admin"){
        $msg = "You don't have the access to this page!";
        header("Location:../prijava.php?error=$msg");
    }
    
    include "Utility/utilityFunctions.php";
    
    if(isset($_GET["error"])){
        PrintErrorMessage($_GET["error"]);    
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
    $AranzmanObject->DajSveAranzmane();

    $ConnectionObject->Disconnect();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin panel</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="Bootstrap/CSS/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Styles/style.css">

</head>
<body>
    <!-- Navigation -->
    <?php include "Includes/navigation.php"; ?>
    
    <!-- Aside -->
    <?php include "Includes/aside-admin.php"; ?>

    <section class="section-table col-10 offset-2">
        <h1 class="section-title">Lista aranžmana</h1>

        <?php if($AranzmanObject->itemsCount == 0) {?> <!-- IF begin -->
            <h1 class="text-center my-4">Nema dostupnih aranžmana</h1>
        <?php } else {?> <!-- IF end, ELSE begin -->
            <table class="table-admin">
                <?php
                    PrintAdminTableHeading();
                    $AranzmanCounter = 0;

                    /* OUTER FOREACH START */
                    foreach ($AranzmanObject->itemsArray as $Index => $Array) {
                        echo "<tr>";
                        $AranzmanCounter++;
                        PrintCellValue($AranzmanCounter);
                        
                        /* INNER FOREACH START */
                        foreach ($Array as $Column => $Value) {
                            PrintCellValue($Value);
                        } /* INNER FOREACH END */ ?> 

                        <td class="td-adminControls">
                            <form action="Pages/izmeniAranzmanPage.php" method="POST">
                                <input type="hidden" name="AranzmanID" value="<?php echo $Array[0]; ?>">
                                <input class="btn btn-primary" type="submit" value="Izmeni">
                            </form>
                            <form action="LogicLayer/obrisiAranzman.php" method="POST">
                                <input type="hidden" name="AranzmanID" value="<?php echo $Array[0]; ?>">
                                <input class="btn btn-danger" type="submit" value="Obriši">
                            </form>
                        </td>
                        
                        <?php
                        echo "</tr>";
                    } /* OUTER FOREACH END */?> 
            </table>
        <?php }?> <!-- ELSE end -->
    </section>

</body>
</html>