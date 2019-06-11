<?php
session_start();
//echo "SESIÓN "; var_dump($_SESSION);

extract($_REQUEST,EXTR_PREFIX_SAME,"v_");
//echo "REQUEST: <pre>"; var_dump($_REQUEST); echo "</pre>";

if ($cerrar_session=='si') {
	session_unset();
	session_destroy();
}
/*echo "SESIÓN "; var_dump($_SESSION);*/

include 'config/db.php';

/*inclu Face*/
/*include'configFace.php';
include 'usuarios.php';


if(isset($accessToken)){
    if(isset($_SESSION['facebook_access_token'])){
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
        // Put short-lived access token in session
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        
          // OAuth 2.0 client handler helps to manage access tokens
        $OAuth2Client = $fb->getOAuth2Client();
        
        // Exchanges a short-lived access token for a long-lived one
        //$longLivedAccessToken = $
       // OAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        //$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        
        // Set default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    
    // Redirect the user back to the same page if url has "code" parameter in query string
    if(isset($_GET['code'])){
        header('Location: ./');
    }
    
    // Getting user's profile info from Facebook
    try {
        $graphResponse = $fb->get('/me?fields=name,first_name,last_name,email');
        $fbUser = $graphResponse->getGraphUser();
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // Redirect user back to app login page
        header("Location: ./");
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    
    // Initialize User class
    $user = new User();
    
    // Getting user's profile data
    $fbUserData = array();
    $fbUserData['oauth_uid']  = !empty($fbUser['id'])?$fbUser['id']:'';
    $fbUserData['first_name'] = !empty($fbUser['first_name'])?$fbUser['first_name']:'';
    $fbUserData['last_name']  = !empty($fbUser['last_name'])?$fbUser['last_name']:'';
    $fbUserData['email']      = !empty($fbUser['email'])?$fbUser['email']:''; 
    // Insert or update user data to the database
    $fbUserData['oauth_provider'] = 'facebook';
    $userData = $user->checkUser($fbUserData);
    
    // Storing user data in the session
    $_SESSION['userData'] = $userData;
    
    // Get logout url
    $logoutURL = $helper->getLogoutUrl($accessToken, FB_REDIRECT_URL.'cerrar.php');
    
    // Render Facebook profile data
    if(!empty($userData)){
        $output  = '<h2>Facebook Profile Details</h2>';
        $output .= '<div class="ac-data">';
        $output .= '<p><b>Facebook ID:</b> '.$userData['oauth_uid'].'</p>';
        $output .= '<p><b>Name:</b> '.$userData['first_name'].' '.$userData['last_name'].'</p>';
        $output .= '<p><b>Email:</b> '.$userData['email'].'</p>';
        $output .= '</div>';
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
}else{
    // Get login url
    $permissions = ['email']; // Optional permissions
    $loginURL = $helper->getLoginUrl('https://tienda.luliygabo.com/index.php', $permissions);
    
    // Render Facebook login button
    $output = '<a href="'.htmlspecialchars($loginURL).'"><img src="images/fb-login-btn.png"></a>';
}*/
?>
<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Luli y Gabo - Tienda en Línea</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
      <!--limpiar chace -->
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="https://devitems.com/preview/asbab/apple-touch-icon.png">
    
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arvo:400,700" rel="stylesheet">

    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/auth.js"></script>
</head>

<?php
if ($_SESSION['id']== "" || $_SESSION['id']==0 || $_SESSION['id']==NULL) {
?>
<body style="bacground-color:#ffc600">

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <?php include 'header.php' ?>
        <!-- End Header Area -->

        <div class="body__overlay"></div>
         <!-- Start Offset Wrapper -->
         <div class="offset__wrapper">

        <!-- Start Search Popap -->
        <?php include 'search-pop.php' ?>
        <!-- End Search Popap -->

        <!-- Start Cart Panel -->
        <?php include 'cart-panel.php' ?>
        <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->
        
        
        <!-- Start Product Details Area -->
        <section class="htc__loginboxed htc__product__details ptb--100">

       
        <div class="login-box col-md-4 col-lg-4 col-sm-6 col-xs-10 mb-55">
                 <!--<div class="logionCerrar">
                    <a href="index.php">
                        <img src="images/icons/Cerrar.png">
                    </a>
                </div>-->               
                <?php
				if ($msg!=NULL) {
				?>
					<br>
					<div class="<?=$class;?>">
						<center><?=$msg;?></center>
					</div><br><br>
				<?
				}
				?>
				<form id="contact-form" action="includes/auth.php" method="post">
					<h2>¡Hola! Entra con tu cuenta</h2>
					<div class="single-contact-form">
						<div class="contact-box subject">
							<input type="email" name="email" placeholder="mail@luliygabo.com">
						</div>
					</div>

					<div class="single-contact-form">
						<div class="contact-box subject">
							<input type="password" name="password" placeholder="******">
						</div>
					</div>

					<div class="single-contact-form"  style="margin-top: 10px;">
						<a href="recuperar.php">
                        ¿Olvidaste tu contraseña?
                        </a>
					</div>
				   
					<div class="contact-btn">
						<input type="hidden" name="seccion" value="<?=$seccion?>">
						<button type="submit" class="fv-btn">Entrar</button>
					</div>
				</form>
				<hr>

				<div style="text-align:center">
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.2&appId=2084893641560714&autoLogAppEvents=1';
					fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>

					
				
					<div class="single-contact-form" style="margin-top: 10px;">
						¿Aún no estas registrado?
					</div>
					<div class="contact-btn">
						<a href="register.php" class="rg-btn">Regístrate</a>
					</div>
				</div>
				<!--facebook
				<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
				<div><?php echo $output; echo $userInfo; ?></div>-->
                <div class="fb-box">
                    <!-- Display login button / Facebook profile information    -->
                    <?php echo $output; ?>
                </div>
			</div>    
        </section>
        <!-- End Product Details Area -->
        
        <!-- Start Footer Area -->
        
         <?php include 'footer.php' ?>
        <!-- End Footer Style -->
    </div>
    <!-- Body main wrapper end -->

    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!-- Waypoints.min.js. -->
    <script src="js/waypoints.min.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>

    
</body>
<?php
} else {
	?>
	<script language="javascript">
	location.href = "index.php";
	</script>
	<?php
}
?>

</html>