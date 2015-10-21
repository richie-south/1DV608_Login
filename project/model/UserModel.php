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
        $shaPassword = sha1(\Settings::SALT . $password);

        if(is_string($username) == false || is_string($password) == false || strlen($username) < 1 && strlen($password) < 1){
            throw new EmptyInputException();
        }
        if (is_string($username) == false || strlen($username) < 1){
            throw new NoUserNameException();
        }
        if(strip_tags($username) != $username){
            throw new InvalidCharacters();
        }
        if (is_string($password) == false || strlen($password) < 1){
            throw new NoPasswordException();
        }
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
