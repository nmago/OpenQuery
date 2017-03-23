<?php
Class Controller_Index Extends Controller_Base {
	

	public $layouts = "base";
	public $no_auth_layout = "base_no_auth";
	

	function index() {
		$select = Array(
          'order' => 'id_iv'
        );
        $model = new Model_Interviews($select);
        $interviews = $model->getLastWithUsers(10);

        $this->template->vars('interviews', $interviews);
        $this->template->view('index');
		
	}
	
}
