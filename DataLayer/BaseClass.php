<?php 
class BaseClass{
    // Database Attributes
    public $openConnection;
    public $dbName;
    public $tableName;

    // Class Attributes
    public $items;
    public $itemsCount;
    public $itemsArray;
    public $itemsColumnNumber;

    // Constructor 
    public function __construct($NewOpenConnection, $NewTableName)
    {
        $this->openConnection = $NewOpenConnection;
        $this->dbName = $NewOpenConnection->FullNameDB;
        $this->tableName = $NewTableName;
    }

    // Public Methods 

    // Execute query, count results
    protected function ExecuteQuery($Query)
    {
        $this->items = mysqli_query($this->openConnection->ConnectionToDB, $Query) or die("Error. Select Query Failed To Execute");
        $this->itemsCount = mysqli_num_rows($this->items);

        $this->BuildResultArray();
    }

    // Execute update query or return error
    protected function ExecuteUpdateQuery($Query){
        mysqli_query($this->openConnection->ConnectionToDB, $Query); //or die('Error. Update Query Failed To Execute');
    }

    // Execute delete query or return error
    protected function ExecuteDeleteQuery($Query){
        mysqli_query($this->openConnection->ConnectionToDB, $Query) or die('Error. Delete Query Failed To Execute');
    }

    // Build array of query results 
    protected function BuildResultArray()
    {
        $itemsTemp = $this->items;

        for($i = 0; $i < $this->itemsCount; $i++){
            $this->itemsArray[] = mysqli_fetch_row($itemsTemp);
        }

        // If no items are in the array, don't count columns
        if($this->itemsArray != null){
            $this->itemsNumberOfColumns = count($this->itemsArray[0]);
        }
        
        //echo $this->itemsColumnNumber;

        return $this->itemsArray;
    }

    // Return the value Nth Column
    public function GetNthColumn($ColumnNumber)
    {
        return $this->itemsArray[0][$ColumnNumber];
    }

    // Get all table entries, ordered
    protected function GetAll($OrderBy)
    {
        $GetAllSQL = "SELECT * FROM `" . $this->dbName . "`.`" . $this->tableName . "` ORDER BY " . $OrderBy;

        $this->ExecuteQuery($GetAllSQL);
    }

    // Get all filtered table entries, ordered
    public function GetAllFiltered($FilterBy, $FilterValue, $OrderBy)
    {
        $GetAllFilteredSQL = "SELECT * FROM `" . $this->dbName . "`.`" . $this->tableName . "` WHERE " . $FilterBy . "  ='" . $FilterValue . "' ORDER BY " . $OrderBy . " ASC";

        $this->ExecuteQuery($GetAllFilteredSQL);
    }

    // Get a single column, ordered 
    public function GetColumn($Column, $OrderBy)
    {
        $GetColumnSQL = "SELECT `" . $Column . "` FROM `" . $this->dbName . "`.`" . $this->tableName . "` ORDER BY " . $OrderBy;

        $this->ExecuteQuery($GetColumnSQL);
    }

    // Get a signle column filtered, ordered
    public function GetColumnFiltered($Column, $FilterBy, $FilterValue, $OrderBy)
    {
        $GetColumnFilteredSQL = "SELECT `" . $Column . "` FROM `" . $this->dbName . "`.`" . $this->tableName . "` WHERE `" . $FilterBy . "` = " . $FilterValue . " ORDER BY " . $OrderBy;

        $this->ExecuteQuery($GetColumnFilteredSQL);
    }
}
?>

