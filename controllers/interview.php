<?php

Class Controller_interview  Extends Controller_Base {
	

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
		
		//$this->template->vars('article', $article);
		$this->template->view('index');
	}
	
	function show(){
		$id_iv = $_GET['id'];
		if(!empty($id_iv)){
			$model = new Model_Interviews();
			$ivResult = $model->getForShow($id_iv);

			$this->template->vars('iv', $ivResult['iv'][0]);
			$this->template->vars('ivoptions', $ivResult['ivoptions']);

			@$lk = array(
				'likes' => 	(int) $ivResult['ivlikescount'][0]['lcount'],
				'dislikes' => (int) $ivResult['ivlikescount'][1]['lcount']
			);
			$this->template->vars('ivlikescount', $lk);

			$this->template->vars('lastliketime', $ivResult['lastliketime']);

			$this->template->view('show');
		}else
			header('Location: '. SITEURL);
	}
	

	
}