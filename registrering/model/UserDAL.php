<?php

namespace model;

class UserDAL {

    private static $filename = "users";
    private static $table = "lab4";

    public function __construct(){

    }

    public function connect(){
        $this->database = new \mysqli(\Settings::DBURL, \Settings::DBUserName, \Settings::DBPassword, \Settings::DBName);
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
    }

    public function save(\model\User $user){
        if($this->doExists($user->getUsername())){
            throw new \Exception();
        }

        $stmt = $this->database->prepare("INSERT INTO  `lab4` (`username` , `password`) VALUES (?, ?)");

		if ($stmt === FALSE) {
			throw new \Exception($this->database->error);
		}

		$username = $user->getUsername();
		$password = $user->getPassword();

		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();

    }

    private function doExists($username){
        $stmt = $this->database->prepare("SELECT EXISTS(SELECT 1 FROM ".self::$table." WHERE username = '".$username."')");
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

    public function correctCredentials($username, $password){
        $password = sha1(\Settings::SALT . $password);
        $stmt = $this->database->prepare("SELECT EXISTS(SELECT 1 FROM ".self::$table." WHERE BINARY username = '".$username."' AND password = '".$password."')");

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
}
