<?php

namespace view;

class LoginView {
    private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
    private static $messageId = 'LoginView::Message';
    private $message;
    private $userDAL;

    public function __construct(\model\UserDAL $userDAL){
        $this->userDAL = $userDAL;
    }

    public function generateLoginFormHTML() {
		return '
			<form method="post" >
				<fieldset>
					<legend>Login</legend>
					<p id="' . self::$messageId . '">' . $this->message . '</p>
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value= "'.$this->getRequestUserName().'" />
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

    /**
	* @return inputed username
	*/
	private function getInputUsername(){
		return $_POST[self::$name];
	}
	/**
	* @return inputed password
	*/
	private function getInputPassword(){
		return $_POST[self::$password];
	}

    private function getRequestUserName() {
		if (isset($_POST[self::$name])) {
			return $_POST[self::$name];
		}
	}

    /**
	* @return boolean
	*/
	public function checkLoginPost(){
 		return isset($_POST[self::$login]);
 	}
	/**
	* @return boolean
	*/
	public function checkLogoutPost(){
 		return isset($_POST[self::$logout]);
 	}

    public function getUser(){
        try {
            return new \model\UserModel($this->userDAL, $this->getInputUsername(), $this->getInputPassword());
        } catch (\model\EmptyInputException $e) {
            $this->message = "Empty input";
        } catch (\model\NoUserNameException $e) {
            $this->message = "Empty username";
        } catch (\model\NoPasswordException $e) {
            $this->message = "Empty password";
        } catch (\model\InvalidCharacters $e) {
            $this->message = "Username contains invalid characters.";
        } catch (\model\WrongUserCredentialsException $e) {
            $this->message = "Wrong username or password";
        } catch (Exception $e) {
            $this->message = "Unspecified error";
        }
        return null;
    }
}
