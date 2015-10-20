<?php

namespace model;

class UserDAL {

    private static $userTable = "users";

    public function __construct(){
        $this->database = new \mysqli(\Settings::DBURL, \Settings::DBUserName, \Settings::DBPassword, \Settings::DBName);
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
    }

    public function checkUserCredentials($username, $password){
        $stmt = $this->database->prepare("SELECT EXISTS(SELECT 1 FROM ".self::$userTable." WHERE BINARY username = '".$username."' AND password = '".$password."')");
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

    // added the admin user
    private function addAdmin($username, $password){
        $p = sha1(\Settings::SALT . $password);

        $stmt = $this->database->prepare("INSERT INTO  `".self::$userTable."` (`username` , `password`) VALUES (?, ?)");
		if ($stmt === FALSE) {
			throw new \Exception($this->database->error);
		}

		$stmt->bind_param('ss', $username, $p);
		$stmt->execute();
    }

}
