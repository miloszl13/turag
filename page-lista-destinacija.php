<?php 
    session_start();

    $UserStatus = $_SESSION["userStatus"];

    if($UserStatus != "admin"){
        $msg = "Nemate pristup ovoj stranici";
        header("Location:index.php?error=$msg");
    }

    include "Utility/utilityFunctions.php";

    if(isset($_GET["error"])){
        PrintErrorMessage($_GET["error"]);
    }

    $SiteTitle = "Lista zvanja";

    require "DatabaseLayer/ConnectionClass.php";
    
    $ConnectionObject = new Connection("DatabaseLayer/ConnectionParameters.xml");
    $ConnectionObject->Connect();

    if(!$ConnectionObject->ConnectionToDB){
        echo "Connection Error";
        exit();
    }

    require "DataLayer/BaseClass.php";
    require "DataLayer/DestinacijaClass.php";

    $ListaDestinacija = new DestinacijaClass($ConnectionObject, "destinacija");
    $ListaDestinacija->DajSveDestinacije();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Lista destinacija</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="Bootstrap/CSS/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Styles/style.css">

</head>
<body>
    <!-- Navigation -->
    <?php include "Includes/navigation-inner.php"; ?>

    <!-- Aside -->
    <?php include "Includes/aside-admin.php"; ?>

    <section class="section-table offset-2 col-10">
        <h1 class="section-title">Lista destinacija</h1>
        
        <?php if($ListaDestinacija->itemsCount == 0) {?>

            <h1 class="text-center">Nema podataka</h1>

        <?php } else { ?>

            <table class="table-clients">
                <?php
                    PrintDestinacijaTableHeading();
                    $DestinacijaCount = 1;

                    foreach($ListaDestinacija->itemsArray as $Index => $Row){
                        echo "<tr>";
                        foreach($Row as $Column => $Value){
                            if($Column == 0){
                                continue; // Skip ID column
                            }
                            PrintCellValue($Value);
                        }
                ?>
                    <!-- Table Cell Start -->
                    <td class="td-adminControls">
                        <form action="LogicLayer/obrisiDestinaciju.php" method="post">
                            <input type="hidden" name="DestinacijaID" value="<?php echo $Row[0]; ?>">
                            <input class="btn btn-danger" type="submit" value="Obriši">
                        </form>
                    </td>
                    <!-- Table Cell End -->
                <?php
                        $DestinacijaCount++;
                        echo "</tr>";
                    }
                ?>
            </table>
            
        <?php }?>
    </section>

    <!-- Bootstrap JS -->
    <script src="Bootstrap/JS/jquery.js"></script>
    <script src="Bootstrap/JS/bootstrap.min.js"></script>    
</body>
</html>