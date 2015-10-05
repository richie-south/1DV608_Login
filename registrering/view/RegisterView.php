<?php

class RegisterView {

    private static $UserName = "RegisterView::UserName";
    private static $Password = "RegisterView::Password";
    private static $PasswordRepeat = "RegisterView::PasswordRepeat";
    private static $DoRegistration = "RegisterView::DoRegistration";
    private static $Message = "RegisterView::Message";

    private static $url = "register";

    public function response(){
        return $this->generateRegistrateFormHTML();
    }

    public function userWantsToRegistrat(){
        if(isset($_GET[self::$url])){
            return true;
        }
        return false;
    }

    public function checkUserNamePost(){
        return isset($_POST[self::$UserName]);
    }

    public function checkPasswordPost(){
        return isset($_POST[self::$Password]);
    }

    public function checkDoRegistrationPost(){
        return isset($_POST[self::$DoRegistration]);
    }

    private function generateRegistrateFormHTML(){
        return '
        <form method="post">
                <fieldset>
                <legend>Register a new user - Write username and password</legend>
                    <p id="'. self::$Message .'"></p>
                    <label for="'. self::$UserName .'" >Username :</label>
                    <input type="text" size="20" name="'. self::$UserName .'" id="'. self::$UserName .'" value="" />
                    <br/>
                    <label for="'. self::$Password .'" >Password  :</label>
                    <input type="password" size="20" name="'. self::$Password .'" id="'. self::$Password .'" value="" />
                    <br/>
                    <label for="'. self::$PasswordRepeat .'" >Repeat password  :</label>
                    <input type="password" size="20" name="'. self::$PasswordRepeat .'" id="'. self::$PasswordRepeat .'" value="" />
                    <br/>
                    <input id="submit" type="submit" name="'. self::$DoRegistration .'"  value="Register" />
                    <br/>
                </fieldset>
            </form>
        ';
    }

}
