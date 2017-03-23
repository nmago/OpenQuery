<?php
// abstract controller class 
Abstract Class Controller_Base {

	protected $registry;
	protected $template;
	protected $layouts; // шаблон
	protected $no_auth_layout;
	protected $userinfo = array();
	
	public $vars = array();

	//include templated
	function __construct() {
		$this->prepareUserInfo();
		// templates
		if($this->userinfo['auth']){
			$this->template = new Template($this->layouts, get_class($this));
			$this->template->vars('userfullname', $this->userinfo['firstname'].' '.$this->userinfo['lastname']);
			$this->template->vars('userid',$this->userinfo['id_user']);
			
		}else
			 $this->template = new Template($this->no_auth_layout, get_class($this));
		
	}

	abstract function index();
	
	function prepareUserInfo(){
		if(!empty($_SESSION['user_id'])){
			$model = new Model_Users();
			$this->userinfo = $model->getUserInfo((int)$_SESSION['user_id']);
			$this->userinfo['auth'] = true;	
		}else{
			$this->userinfo['auth'] = false;
		}
	}
	
	
}
