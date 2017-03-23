<?php

Class Controller_search  Extends Controller_Base {
	
	public $layouts = "base";
	
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
	
}