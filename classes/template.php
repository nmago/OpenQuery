<?php
// template class
Class Template {

	private $template;
	private $controller;
	private $layouts;
	private $vars = array();
	
	function __construct($layouts, $controllerName) {
		$this->layouts = $layouts;
		$arr = explode('_', $controllerName);
		$this->controller = strtolower($arr[1]);
	}
	
	// set vars for show
	function vars($varname, $value) {
		if (isset($this->vars[$varname]) == true) {
			trigger_error ('Unable to set var `' . $varname . '`. Already set, and overwrite not allowed.', E_USER_NOTICE);
			return false;
		}
		$this->vars[$varname] = $value;
		return true;
	}
	
	// show
	function view($name) {
		$pathLayout = SITE_PATH . 'views' . DS . 'layouts' . DS . $this->layouts . '.php';
		$contentPage = SITE_PATH . 'views' . DS . $this->controller . DS . $name . '.php';
		if (file_exists($pathLayout) == false) {
			trigger_error ('Layout `' . $this->layouts . '` does not exist.', E_USER_NOTICE);
			return false;
		}
		if (file_exists($contentPage) == false) {
			trigger_error ('Template `' . $name . '` does not exist.', E_USER_NOTICE);
			return false;
		}
		
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}

		define('GENTIME', round(microtime(true) - STARTTIME, 3));
		
		include ($pathLayout);                
	}
	
}