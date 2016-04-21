<?php
	$router->map('GET', '[a:action]', function($action){
		global $currentpage;
		$currentpage = new Page;
		$currentpage = getPage($action);
		return 'views/' . $currentpage->getTemplate();
	});
	
	$router->map('GET', '[a:action]/', function($action){
		global $currentpage;
		$currentpage = new Page;
		$currentpage = getPage($action);
		return 'views/' . $currentpage->getTemplate();
	});	
	
	$router->map('GET', '*', function($action = null){
		global $currentpage;
		$currentpage = new Page;		
		
		if( $action == "" ){			
			$action = "/";
		}
		
		$currentpage = getPage($action);		
		return 'views/' . $currentpage->getTemplate();
	});		
?>