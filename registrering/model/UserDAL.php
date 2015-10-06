<?php

namespace model;

class UserDAL {

    private $users;
    private static $filename = "users";

    public function __construct(){

    }

    public function save(\model\User $user){
        if($this->isSame($user)){
            throw new Exception();
        }
        $this->users[] = $user;
    }

    public function getGetUsers(){
        return $this->users;

    }

    public function isSame(\model\User $user){
        return false;
    }

}
