<?php
    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($email) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Por favor vuelve a llenar el formulario.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "jeorhg.maeglin@gmail.com, blidania@gmail.com ";

        // Set the email subject.
        $subject = "Confirmado de boda // $name";

        // Build the email content.
        $email_content = "Nombre: $name\n<br>";
        $email_content .= "Email: $email\n\n<br>";

        // Build the email headers.
        $email_headers = "From: $name <$email>";
        // Activa la condificacción utf-8
        $email_headers = "MIME-Version: 1.0" . "\r\n";
        $email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "
            <!DOCTYPE html>
<!--[if lt IE 7]>      <html class='no-js lt-ie9 lt-ie8 lt-ie7'> <![endif]-->
<!--[if IE 7]>         <html class='no-js lt-ie9 lt-ie8'> <![endif]-->
<!--[if IE 8]>         <html class='no-js lt-ie9'> <![endif]-->
<!--[if gt IE 8]><!--> <html class='no-js'> <!--<![endif]-->
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<title>Nuestra boda &mdash; Jorge y Idania</title>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<meta name='description' content='' />
		<meta name='keywords' content='' />
		<meta name='author' content='' />


	<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Sacramento' rel='stylesheet'>
	
	<!-- Animate.css -->
	<link rel='stylesheet' href='css/animate.css'>
	<!-- Icomoon Icon Fonts-->
	<link rel='stylesheet' href='css/icomoon.css'>
	<!-- Bootstrap  -->
	<link rel='stylesheet' href='css/bootstrap.css'>

	<!-- Magnific Popup -->
	<link rel='stylesheet' href='css/magnific-popup.css'>

	<!-- Owl Carousel  -->
	<link rel='stylesheet' href='css/owl.carousel.min.css'>
	<link rel='stylesheet' href='css/owl.theme.default.min.css'>

	<!-- Theme style  -->
	<link rel='stylesheet' href='css/style.css'>

	<!-- Modernizr JS -->
	<script src='js/modernizr-2.6.2.min.js'></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src='js/respond.min.js'></script>
	<![endif]-->

	</head>
	<body>
		
	<div class='fh5co-loader'></div>
	
	<div id=''>
	

	<header id='fh5co-header' class='fh5co-cover fh5co-cover-sm' role='banner' style='background-image:url(images/img_bg_1.jpg);'>
		<div class='overlay'></div>
		<div class='fh5co-container'>
			<div class='row'>
				<div class='col-md-8 col-md-offset-2 text-center'>
					<div class='display-t'>
						<div class='display-tc animate-box' data-animate-effect='fadeIn'>
							<h1>Gracias :)</h1>
                            <h2><a href='https://www.jeorhg-desu.com/boda-jo-id/'>Regresar</a></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div id='fh5co-couple' class='fh5co-section-gray'>
		<div class='container'>
			
		</div>
	</div>
	</div>

	<div class='gototop js-top'>
		<a href='#' class='js-gotop'><i class='icon-arrow-up'></i></a>
	</div>
	
	<!-- jQuery -->
	<script src='js/jquery.min.js'></script>
	<!-- jQuery Easing -->
	<script src='js/jquery.easing.1.3.js'></script>
	<!-- Bootstrap -->
	<script src='js/bootstrap.min.js'></script>
	<!-- Waypoints -->
	<script src='js/jquery.waypoints.min.js'></script>
	<!-- Carousel -->
	<script src='js/owl.carousel.min.js'></script>
	<!-- countTo -->
	<script src='js/jquery.countTo.js'></script>

	<!-- Stellar -->
	<script src='js/jquery.stellar.min.js'></script>
	<!-- Magnific Popup -->
	<script src='js/jquery.magnific-popup.min.js'></script>
	<script src='js/magnific-popup-options.js'></script>

	<!-- Main -->
	<script src='js/main.js'></script>

	</body>
</html>

";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Paso un error. :/";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "No se puede enviar, intenta de nuevo.";
    }

?>
