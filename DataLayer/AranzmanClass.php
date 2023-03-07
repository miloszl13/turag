<?php
class AranzmanClass extends BaseClass{

    public function DajSveAranzmane()
    {
        $this->GetAll("AranzmanID");
    }

    public function DajAranzmanPoID($AranzmanID)
    {
        $this->GetAllFiltered("AranzmanID", $AranzmanID, "AranzmanID");
    }

    public function DodajNoviAranzman($InputSifra, $InputDestinacija, $InputCena, $InputDatum)
    {
        $DodajNoviAranzmanSQL = "INSERT INTO `" . $this->dbName . "`.`" . $this->tableName . "` (SifraAranzmana, NazivDestinacije, Cena, DatumPolaska) VALUES ('$InputSifra', '$InputDestinacija', '$InputCena', '$InputDatum')";

        $error = $this->ExecuteUpdateQuery($DodajNoviAranzmanSQL);

        return $error;
    }

    public function AzurirajAranzman($SelectedID, $NovaSifraAranzmana, $NovaDestinacija, $NovaCena, $NoviDatum)
    {
        $AzurirajAranzmanSQL = "UPDATE `" . $this->dbName . "`.`" . $this->tableName . "` SET SifraAranzmana='" . $NovaSifraAranzmana . "', NazivDestinacije='" . $NovaDestinacija . "', Cena='" . $NovaCena . "', DatumPolaska='" . $NoviDatum . "' WHERE AranzmanID=" . $SelectedID;
    
        $this->ExecuteUpdateQuery($AzurirajAranzmanSQL);
    }

    public function ObrisiAranzman($InputID)
    {
        $ObrisiAranzmanSQL = "DELETE FROM `" . $this->dbName . "`.`" . $this->tableName . "` WHERE AranzmanID = '" . $InputID . "'";

        $this->ExecuteDeleteQuery($ObrisiAranzmanSQL);
    }

    public function DajAranzmanPoDestinaciji($InputDestinacija){
        $this->GetAllFiltered("NazivDestinacije", $InputDestinacija, "AranzmanID");
    }

    public function ProveraSifreAranzmana($InputSifra){
        $this->DajAranzmanPoSifri($InputSifra);

        if($this->itemsCount == 0){
            return true;
        }else{
            return false;
        }
    }
}
?>