<?php

require_once("model/User.php");

class RegisterView {

    private static $UserName = "RegisterView::UserName";
    private static $Password = "RegisterView::Password";
    private static $PasswordRepeat = "RegisterView::PasswordRepeat";
    private static $DoRegistration = "RegisterView::Register";
    private static $MessageID = "RegisterView::Message";
    private $message;

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
        return $_POST[self::$UserName];
    }

    public function checkPasswordPost(){
        return $_POST[self::$Password];
    }

    public function checkPasswordRepeetPost(){
        return $_POST[self::$PasswordRepeat];
    }

    public function checkDoRegistrationPost(){
        return isset($_POST[self::$DoRegistration]);
    }

    public function getUser(){
        $username = $this->checkUserNamePost();
        $password = $this->checkPasswordPost();
        $passwordRepeat = $this->checkPasswordRepeetPost();

        try {
            return new \model\User($username, $password, $passwordRepeat);
        } catch (\model\EmptyInputException $e) {
            $this->message = "Username has too few characters, at least 3 characters.<br>Password has too few characters, at least 6 characters.";
        } catch (\model\NoUserNameException $e) {
            $this->message = "Username has too few characters, at least 3 characters.";
        } catch (\model\NoPasswordException $e) {
            $this->message = "Password has too few characters, at least 6 characters.";
        } catch (\model\PasswordDontMatchException $e) {
            $this->message = "Passwords do not match.";
        }// TODO: invalid caracters
        catch (Exception $e) {
            $this->message = "Unspecified error";
        }
        return null;
    }

    public function setDuplicate(){
        $this->message = "User exists, pick another username.";
    }

    private function generateRegistrateFormHTML(){
        return '
        <form method="post">
                <fieldset>
                <legend>Register a new user - Write username and password</legend>
                    <p id="'. self::$MessageID .'">'.$this->message.'</p>
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
