<?php 
    session_start();

    $UserStatus = $_SESSION["userStatus"];

    if($UserStatus != "admin"){
        $msg = "You don't have the access to this page!";
        header("Location:../prijava.php?error=$msg");
    }
    
    require "DatabaseLayer/ConnectionClass.php";

    $ConnectionObject = new Connection("DatabaseLayer/ConnectionParameters.xml");
    $ConnectionObject->Connect();

    if(!$ConnectionObject->ConnectionToDB){
        echo "Connection Error";
        exit();
    }

    require "DataLayer/BaseClass.php";
    require "DataLayer/DestinacijaClass.php";

    $DestinacijaList = new DestinacijaClass($ConnectionObject, "destinacija");
    $DestinacijaList->DajSveDestinacije();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin Page</title>

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

    <section class="offset-2">
        <h1 class="section-title">Dodaj aranžman</h1>

        <form class="form-dodajAranzman" action="LogicLayer/dodajAranzman.php" method="post">
            <div class="form-row">
                <label class="form-label" for="novaSifra">Sifra:</label>
                <input class="form-text" type="text" name="novaSifra" id="novaSifra" required pattern="[0-9]{5}">
            </div>

            <div class="form-row">
                <label class="form-label" for="novaDestinacija">Destinacija:</label>
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
                <input class="form-text" type="number" name="novaCena" id="novaCena" required>
            </div>

            <div class="form-row">
                <label class="form-label" for="noviDatumPolaska">Datum polaska:</label>
                <input class="form-text" type="date" name="noviDatumPolaska" id="noviDatumPolaska" required>
            </div>

            <div class="form-row">
                <input class="btn btn-primary" type="submit" name="submitDodajAranzman" value="Potrvdi">
            </div>
        </form>
    </section>

    <!-- Bootstrap -->
    <script src="Bootstrap/JS/jquery.js"></script>
    <script src="Bootstrap/JS/bootstrap.min.js"></script>
</body>
</html>