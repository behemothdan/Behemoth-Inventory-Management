<?php
	require_once 'vendor/autoload.php';
	require_once 'includes/connection.php';
	require_once 'includes/models.php';
	require_once 'includes/functions.php';
	
	$router = new AltoRouter();
	$router->setBasePath('/');	
	require_once 'includes/routes.php';	
	$match = $router->match();

	if( $match && is_callable($match['target']) ) {
		$view = call_user_func_array( $match['target'], $match['params'] );		
	} else {					
		$view = $match['target'];
	}	
	
?>
<!DOCTYPE html>
<html lang="en">
	<?php require 'includes/header.php'; ?>
	<body class="frontpage">			
		<?php  require $view; ?>		
		<script type="text/javascript" src="/style/scripts/main.js"></script>
	</body>
</html>