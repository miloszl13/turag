<?php
class User extends BaseClass{
    // Class Attributes
    public $userID;
    public $userRealName;
    public $userSurname;
    public $userStatus;
    public $username;
    public $password;
    public $userOldID;

    // Constructor is inherited

    // Public Methods

    // Authenticate user 
    public function AuthenticateUser($InputUsername, $InputPassword)
    {
        $AuthenticateUserSQL = "SELECT * FROM `" . $this->dbName . "`.`" . $this->tableName . "` WHERE `Username`='" . $InputUsername . "' AND `Password`='" . $InputPassword . "' ORDER BY `UserID`";

        $this->ExecuteQuery($AuthenticateUserSQL);

        if($this->itemsCount == 1){
            return true;
        }else {
            return false;
        }
    }
    
}
?>