<?php
session_start();

$user = $_GET["user"];
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '1724472681116564','be87e18ce4a5f9154cd8d79466646517' );
// login helper with redirect_uri
    //$helper = new FacebookRedirectLoginHelper('http://anandlocalhost.com/mdw/fbconfig.php?user='.$user );
  $helper = new FacebookRedirectLoginHelper('http://ec2-54-169-29-187.ap-southeast-1.compute.amazonaws.com/fbconfig.php?user='.$user );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me?locale=en_US&fields=id,name,email' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
 	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
  $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
/* ---- Session Variables -----*/
  $_SESSION['FBID'] = $fbid;           
  $_SESSION['FULLNAME'] = $fbfullname;
  $_SESSION['EMAIL'] =  $femail;
    /* ---- header location after session ----*/
  header("Location: validatefb.php?user=".$user);
} else {
  $loginUrl = $helper->getLoginUrl(array('scope' => 'email'));
  header("Location: ".$loginUrl);
}
?>



<!-- 7026559087

54373088

65830014 -->