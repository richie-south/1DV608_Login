<?php

namespace model;

class UserDAL {

    private static $filename = "users";
    private static $table = "lab4";

    public function __construct(){
        $this->database = new \mysqli("richardsoderman.se", "root", "8uhOTD11Bf", "phplab4");
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
    }

    public function save(\model\User $user){

        if($this->doExists($user->getUsername())){
            throw new \Exception();
        }

        $stmt = $this->database->prepare("INSERT INTO  `lab4` (
			`username` , `password`) VALUES (?, ?)");

		if ($stmt === FALSE) {
			throw new \Exception($this->database->error);
		}
		$username = $user->getUsername();
		$password = $user->getPassword();
		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();

    }

    private function doExists($username){
        $stmt = $this->database->prepare("SELECT EXISTS(SELECT 1 FROM lab4 WHERE username = '".$username."')");
        //$stmt = $this->database->prepare("SELECT * FROM lab4 WHERE username = 'erik2'");
        if ($stmt === FALSE) {
            throw new \Exception();
        }

        $stmt->execute();
        $stmt->bind_result($exsists);
        $stmt->fetch();

        if($exsists == 1){
            return true;
        }
        return false;
    }

    public function getGetUsers(){
        /*return $this->users;

		$stmt = $this->database->prepare("SELECT * FROM " . self::$table);
		if ($stmt === FALSE) {
			throw new \Exception($this->database->error);
		}
		$stmt->execute();

	    $stmt->bind_result($pk, $title, $description, $price);
	    while ($stmt->fetch()) {
	    	$product = new Product($title, $price, $pk, $description);
	    	$this->productCatalog->add($product);
		}
		return  $this->productCatalog;*/

    }

    public function isSame(\model\User $user){
        return false;
    }

}
