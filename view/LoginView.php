<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private $loginModel;
	private $sessionModel;

	public function __construct(Login $login, Session $session){
		$this->loginModel = $login;
		$this->sessionModel = $session;
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

	/**
	* @return inputed username
	*/
	public function getInputUsername(){
		return $_POST[self::$name];
	}

	/**
	* @return inputed password
	*/
	public function getInputPassword(){
		return $_POST[self::$password];
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = '';
		$response = '';

		// user press logout button
		/*if($this->checkLogoutPost()){
			$message = $this->loginModel->getMessage();
			$response = $this->generateLoginFormHTML($message);
		}*/

		if($this->sessionModel->isSessionSetTrue()){
			$message = $this->loginModel->getMessage();
			$response = $this->generateLogoutButtonHTML($message);
		}else{
			$message = $this->loginModel->getMessage();
			$response = $this->generateLoginFormHTML($message);
		}

		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message/*, $storedName*/) {
		return '
			<form method="post" >
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value= "'.$this->getRequestUserName().'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		if (isset($_POST[self::$name])) {
			return $_POST[self::$name];
		}
	}

}
