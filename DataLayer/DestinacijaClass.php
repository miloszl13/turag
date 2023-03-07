<?php
class DestinacijaClass extends BaseClass{
    // Constructor Inherited
    // Public Methods

    public function DodajDestinaciju($NewDestinacijaIme, $NewDrzava)
    {
        $DodajDestinacijuSQL = "INSERT INTO `" . $this->dbName . "`.`" . $this->tableName . "` (ImeDestinacije, Drzava) VALUES ('$NewDestinacijaIme', '$NewDrzava')";

        $this->ExecuteUpdateQuery($DodajDestinacijuSQL);
    }

    public function ObrisiDestinaciju($TargetID)
    {
        $ObrisiDestinacijuSQL = "DELETE FROM `" . $this->dbName . "`.`" . $this->tableName . "` WHERE DestinacijaID=" . $TargetID;

        $this->ExecuteDeleteQuery($ObrisiDestinacijuSQL);
    }
    
    public function DajSveDestinacije()
    {
        $this->GetAll("DestinacijaID");
    }
}
?>