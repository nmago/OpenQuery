<?php
Class Controller_user  Extends Controller_Base {
	
	public $layouts = "base";
	public $no_auth_layout = "base_no_auth";
	
	function index() {
		$s_query = (!empty($_GET['s'])) ? $_GET['s'] : false;
		if($s_query){
			$select = array(
				'where' => 'ivtext = '.$squery 
			);
			$model = new Model_Search($select);
			$results = $model->getResults();
		}else{
			$results = false;
		}
		
		$this->template->view('index');
	}
	
	function register(){
		if(isset($_POST['ok'])){
			$errors = '';
			
			$email = $_POST['email'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$pass = $_POST['password'];
			$repass = $_POST['repassword'];
			if($pass != $repass) 
				$errors.='Пароли не совпадают';
			if(empty($email) || empty($firstname) || empty($lastname) || empty($pass)) 
				$errors.='Все поля не заполнены';
			
			if(empty($errors)){
				$umodel = new Model_Users();
				if($umodel->registerUser($email, $firstname, $lastname, $pass)){
					$this->template->view('register-successfull');
				}	
				else
					$this->template->view('register-unknown-error');
			}else{
				echo ($errors);
			}
		}else
			$this->template->view('register-form');
	}
	
	function login(){
		if(isset($_POST['ok'])){
			$errors = '';
			$email = $_POST['email'];
			$pass = $_POST['password'];
			if(!empty($email) && (!empty($pass))){
				$umodel = new Model_Users();
				if($umodel->login($email, $pass)) 
					header('Location: '. SITEURL);
				else
					echo "Неверный логин и/или пароль.";
			}else
				$errors.="Все поля не заполнены";
		}
		$this->template->view('login-form');
	}


	function logout(){
		$_SESSION['user_id'] = 0;
		header('Location: '. SITEURL);
	}
	
}