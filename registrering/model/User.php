<?php

namespace model;

class EmptyInputException extends \Exception {};
class NoUserNameException extends \Exception {};
class NoPasswordException extends \Exception {};
class PasswordDontMatchException extends \Exception {};
class InvalidCharacters extends \Exception {};

class User {

    private $username;
    private $password;

    public function __construct($username, $password, $passwordRepeet){
        //$username = strip_tags($username);
        //$password = strip_tags($password);
        // htmlspecialchars

        if(is_string($username) == false || is_string($password) == false || strlen($password) < 6 && strlen($username) < 3){
                throw new EmptyInputException();
        }

        if (is_string($username) == false || strlen($username) < 3){
            throw new NoUserNameException();
        }

        if(strip_tags($username) != $username){
            throw new InvalidCharacters();
        }

        if (is_string($password) == false || strlen($password) < 6){
            throw new NoPasswordException();
        }
        if($password != $passwordRepeet){
            throw new PasswordDontMatchException();
        }

        $this->username = $username;
        $this->password = sha1(\Settings::SALT . $password); //hash($password + \Settings::SALT);

    }

    public function getPassword(){
        return $this->password;
    }

    public function getUsername(){
        return $this->username;
    }
}
