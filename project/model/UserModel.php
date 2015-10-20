<?php
namespace model;


class EmptyInputException extends \Exception {};
class NoUserNameException extends \Exception {};
class NoPasswordException extends \Exception {};
class InvalidCharacters extends \Exception {};
class WrongUserCredentialsException extends \Exception {};

class UserModel {

    private $username;
    private $password;

    public function __construct(\model\UserDAL $userDAL, $username, $password){

        if(is_string($username) == false || is_string($password) == false){
            throw new EmptyInputException();
        }
        if (is_string($username) == false || strlen($username) < 0){
            throw new NoUserNameException();
        }
        if(strip_tags($username) != $username){
            throw new InvalidCharacters();
        }
        if (is_string($password) == false || strlen($password) < 0){
            throw new NoPasswordException();
        }
        $shaPassword = sha1(\Settings::SALT . $password);
        if(!$userDAL->checkUserCredentials($username, $shaPassword)){
            throw new WrongUserCredentialsException();
        }

        $this->username = $username;
        $this->password = $shaPassword;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getUsername(){
        return $this->username;
    }

}
