<?php 
    session_start();

    $UserStatus = $_SESSION["userStatus"];

    if($UserStatus != "admin"){
        $msg = "You don't have the access to this page!";
        header("Location:../prijava.php?error=$msg");
    }

    require "../DatabaseLayer/ConnectionClass.php";

    $ConnectionObject = new Connection("../DatabaseLayer/ConnectionParameters.xml");
    $ConnectionObject->Connect();

    if(!$ConnectionObject->ConnectionToDB){
        echo "Connection Error";
        exit();
    }

    require "../DataLayer/BaseClass.php";
    require "../DataLayer/AranzmanClass.php";
    require "../DataLayer/DestinacijaClass.php";
    include "../Utility/utilityFunctions.php";

    $DestinacijaList = new DestinacijaClass($ConnectionObject, "destinacija");
    $DestinacijaList->DajSveDestinacije();

    $AranzmanID = $_POST["AranzmanID"];

    $AranzmanObject = new AranzmanClass($ConnectionObject, "Aranzman");
    $AranzmanObject->DajAranzmanPoID($AranzmanID);

    $ConnectionObject->Disconnect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Izmena aranzmana</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Bootstrap/CSS/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Styles/style.css">

</head>
<body>
    <!-- Navigation -->
    <?php include "../Includes/navigation-inner.php"; ?>
    
    <section class="col-8 mx-auto">
        <h1 class="section-title">Izmena aranžmana</h1>

        <form class="form-dodajAranzman" action="../LogicLayer/izmeniAranzman.php" method="post">
            <div class="form-row">
                <input type="hidden" name="AranzmanID" value="<?php echo $AranzmanObject->itemsArray[0][0];?>">

                <label class="form-label" for="novaSifra">Šifra aranžmana:</label>
                <input class="form-text" type="text" name="novaSifra" id="novaSifra" value="<?php echo $AranzmanObject->itemsArray[0][1]?>" required pattern="[0-9]{5}">
            </div>

            <div class="form-row">
                <label class="form-label" for="novaDestinacija">Naziv destinacije:</label>
                <select class="form-text" name="novaDestinacija" id="novaDestinacija" required>
                    <option value="" disabled hidden selected>Izaberite destinaciju</option>
                    <?php 
                        foreach ($DestinacijaList->itemsArray as $Index => $Row) {
                    ?>
                        <option value="<?php echo $Row[1]; ?>"><?php echo $Row[1]; ?></option>
                    <?php    
                        }
                    ?>
                </select>
            </div>

            <div class="form-row">
                <label class="form-label" for="novaCena">Cena:</label>
                <input class="form-text" type="number" name="novaCena" id="novaCena" value="<?php echo $AranzmanObject->itemsArray[0][3]?>" required>
            </div>

            <div class="form-row">
                <label class="form-label" for="noviDatumPolaska">Datum polaska:</label>
                <input class="form-text" type="date" name="noviDatumPolaska" id="noviDatumPolaska" value="<?php echo $AranzmanObject->itemsArray[0][4]?>" required>
            </div>

            <div class="form-row">
                <input class="btn btn-primary" type="submit" name="submitAddClient" value="Submit">
            </div>
        </form>
    </section>

    <!-- Bootstrap -->
    <script src="../Bootstrap/JS/jquery.js"></script>
    <script src="../Bootstrap/JS/bootstrap.min.js"></script>
</body>
</html>