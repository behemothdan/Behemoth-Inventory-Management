<?php
    session_start();
	
	$validationmessage;
	$displayValidationMessage == false;
	
    if(!isset($_SESSION["myemail"])){
        header("location:../index.php");
    }
		
	require_once '../vendor/autoload.php';
	require_once '../includes/connection.php';	
	require_once 'includes/models.php';
	require_once 'includes/functions.php';
	
	connect();
		
	$router = new AltoRouter();
	$router->setBasePath('/dashboard');	
	require_once 'includes/routes.php';	
	$match = $router->match();
			
	$user = new User;
	$user = getCurrentUser($_SESSION["myemail"]);	
?>
<!DOCTYPE html>
<html lang="en">	
	<?php require 'includes/head.php'; ?>	
	<body>
		<?php require 'includes/nav.php'; ?>
		<div class="container">			
			<?php			
				if( $match && is_callable( $match['target'] ) ) {
					$view = call_user_func_array( $match['target'], $match['params'] );
					require $view;
				} else if( $match['target'] == "views/base.php" ) {
					require $match['target'];
				} else {					
					require 'views/404.php';					
				}						
			?>
		</div>
		<script type="text/javascript" src="/style/scripts/main.js"></script>		
		<script type="text/javascript">
			$('#repeatpasswordinput').keyup(function() {
				var firstpassword = $('#passwordinput').val();
				var secondpassword = $('#repeatpasswordinput').val();
				
				if(firstpassword != secondpassword){
					$('div.passwordinput').addClass('has-error');
					$('div.passwordinputrepeat').addClass('has-error');
					$('div.passwordinputrepeat .glyphicon').addClass('glyphicon-remove');	
				} else if (firstpassword == secondpassword){
					$('div.passwordinput').removeClass('has-error').addClass('has-success');
					$('div.passwordinputrepeat').removeClass('has-error').addClass('has-success');
					$('div.passwordinputrepeat .glyphicon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
				}
			});
			
			$partblock = "";
			$("#addpart").click(function() {
				if( $partblock == "" ){
					$partblock = $(".product-group").clone().find("input:text").val("").end();
				}
				$($partblock).insertAfter(".product-group");
				$("#removepart").removeClass("disabled");
			});		
			
			$("#removepart").click(function() {
				$productcount = $(".product-group").length;
				if( $productcount > 1 ){
					$(".product-group").last().remove();
					$productcount = $(".product-group").length;
					if( $productcount == 1 ) {
						$("#removepart").addClass("disabled");
					}
				}
			});	
			
			$(function() {
				$('#confirmpo').click(function() {
					if ($(this).is(':checked')) {
						$('#submitpo').removeAttr('disabled');						
					} else {
						$('#submitpo').attr('disabled', 'disabled');
					}
				});
			});		

			$(function() {
				$( "#dateinput" ).datepicker();
			});			
		</script>		
	</body>
</html>