<?php
/*if(!session_id()){
    session_start();
}

// Incluir el autoloader del the SDK
require_once __DIR__ . '/Facebook/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

/*
 * Configuración de Facebook SDK
 
$appId         = '387836858675915'; //Identificador de la Aplicación
$appSecret     = '40f8853b5bf9f89eeb8afbb8b79ee06b'; //Clave secreta de la aplicación
$redirectURL   = 'https://innovagnp.mx/luliygabo/login.php'; //Callback URL
$fbPermissions = array('');  //Permisos opcionales

$fb = new Facebook(array(
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v3.2',
));

?>*/
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration Luli y Gabo
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'iderobin_root');
define('DB_PASSWORD', 'kool16');
define('DB_NAME', 'iderobin_luliygabo');
define('DB_USER_TBL', 'usuarios');

// Database configuration Innova
/*define('DB_HOST', 'localhost');
define('DB_USERNAME', 'koolteck');
define('DB_PASSWORD', 'Klteck16!@');
define('DB_NAME', 'koolteck_luliygabo');
define('DB_USER_TBL', 'usuarios');*/

// Facebook API configuration
define('FB_APP_ID', '387836858675915');
define('FB_APP_SECRET', '40f8853b5bf9f89eeb8afbb8b79ee06b');
define('FB_REDIRECT_URL', 'https://tiendaluliygabo.com.mx/ ');

// Start session
if(!session_id()){
    session_start();
}

// Include the autoloader provided in the SDK
require_once __DIR__ . '/Facebook/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

// Call Facebook API
$fb = new Facebook(array(
    'app_id' => FB_APP_ID,
    'app_secret' => FB_APP_SECRET,
    'default_graph_version' => 'v3.2',
));

// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();

// Try to get access token
try {
    if(isset($_SESSION['facebook_access_token'])){
        $accessToken = $_SESSION['facebook_access_token'];
    }else{
          $accessToken = $helper->getAccessToken();
    }
} catch(FacebookResponseException $e) {
     echo 'Graph returned an error: ' . $e->getMessage();
      exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
}