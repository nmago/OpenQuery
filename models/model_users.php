<?php

Class Model_Users Extends Model_Base {
	
	public $id;
	public $id_category;
	public $title;
	public $small_text;
	public $text;
	public $date_create;
	public $is_active;
	
private $salt = 'f5d*s-dsdf51go}..swfd-87fqpzfgd';
	
	public function fieldsTable(){
		return array(
			
			'id' => 'Id',
			'id_category' => 'Id Category',
			'title' => 'Title',
			'small_text' => 'Small Text',
			'text' => 'Text',
			'date_create' => 'Date Create',
			'is_active' => 'Is Active',

		);
	}
	
	public function login($email, $pass){
		$dataArray = array(
			':email' => $email,
			':passhash' => $this->getPasswordHash($pass)
		);
		
		try{
			$db = $this->db;
			$stmt = $db->prepare("SELECT * FROM $this->table WHERE `usermail` = :email AND `userpass` = :passhash;");
			$result = $stmt->execute($dataArray);
			$row = $stmt->fetch();
			if($row['id_user'] != 0){
				$_SESSION['user_id'] = $row['id_user'];
				return true;
			}  
		}catch(PDOException $e){
			echo 'Error : '.$e->getMessage();
		}
		return false;
		
	}
	
	public function registerUser($email, $firstname, $lastname, $pass){
		$dataArray = array(
			':email' => $email,
			':firstname' => $firstname,
			':lastname' => $lastname,
			':passhash' => $this->getPasswordHash($pass),
			':isact' => 0,
			':actcode' => $this->generateActivateCode()
		);
		
		try {
			$db = $this->db;
			//print_r($dataArray);
			$stmt = $db->prepare("INSERT INTO $this->table (`usermail`, `firstname`, `lastname`, `userpass`, `isactivated`, `activate_code`) values (:email, :firstname, :lastname, :passhash, :isact, :actcode)");  
			$result = $stmt->execute($dataArray);
			$this->sendActivateCode(0, htmlspecialchars($email), $dataArray[':actcode']);
			return true;
		}catch(PDOException $e){
			echo 'Error : '.$e->getMessage();
			return false;
		}
	}
	
	public function getPasswordHash($pass){
		return md5($this->salt.md5($pass.$this->salt));
	}
	
	public function generateActivateCode(){
		return md5('f6asdf4*'.sha1((time()).' /rgdsf'));
	}
	
	public function sendActivateCode($id, $email, $code){
		if($id){ //id != 0
			//select user, ans resend actcode
		}else{
			$to = $email;
			$actcode = $code;
		}
		
		//sending..
		$to = $email;
		$subject = 'Активация аккаунта в OpenQuery';
		$text = file_get_contents(SITE_PATH. DS . 'views' . DS . 'user' . DS . 'register-mail-letter.tpl');
		$text = str_replace('{ACT_URL}', SITEURL.'/user/activate/?email='.$email.'&code='.$code,$text);
		
		return mail($to,$subject,$text,'From: service@'.SITEURL_SHORT.' \r\n');
		
	}
	
	public function getUserInfo($id){
		try{
			$db = $this->db;
			$stmt = $db->query("SELECT * from $this->table WHERE id_user = $id");
			return $stmt->fetch();
		}catch(PDOException $e) {
			echo $e->getMessage();
			exit;
		}
	}
	
}