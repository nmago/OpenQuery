<?php
function __autoload($className) {
	$filename = strtolower($className) . '.php';
	$expArr = explode('_', $className);
	if(empty($expArr[1]) OR $expArr[1] == 'Base'){
		$folder = 'classes';			
	}else{			
		switch(strtolower($expArr[0])){
			case 'controller':
				$folder = 'controllers';	
				break;
				
			case 'model':					
				$folder = 'models';	
				break;
				
			default:
				$folder = 'classes';
				break;
		}
	}
	// classpath
	$file = SITE_PATH . $folder . DS . $filename;
	//echo($file.'; ');
	if (file_exists($file) == false) {
		return false;
	}		
	include ($file);
}
