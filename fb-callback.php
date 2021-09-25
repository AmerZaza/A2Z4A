<?php
// .de
//1919507528340975
//443fa21b4b84f52147334451499e0593
ob_start();
session_start();
include 'init.php';

require_once __DIR__ .'/includes/libraries/facebook/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1919507528340975', 
  'app_secret' => '443fa21b4b84f52147334451499e0593',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
}catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);

$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

//$_SESSION['fb_access_token'] = (string) $accessToken;

try {

  $response = $fb->get('/me?fields=id,name,email', $accessToken);
  
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();


// Get Facebooks User Details
$name = $me->getName();
$id = $me->getId();
$image = 'https://graph.facebook.com/'.$id.'/picture?width=300';
$_SESSION['uimg'] = $image;
$email = $me->getProperty('email');

// Check if user in Db 
$fbUsers = superGet('*','users', "Email = '$email'");
//$fbUsers = superGet('*','users', "FB_ID = '$id'");

if(empty($fbUsers)){
  // Set User record Details:
  $userName = $id;
  $password = $id;
  $pwKey  = rand(1000,9999);

 // $email = rand(1000,9999).'@'.rand(1000,9999).'.'.rand(10,99);
  
  $fullname = $name;
  $lang = 11;

  $FB_ID = $id;

  $stmt = $con->prepare("INSERT INTO users(User_Name, Password, Change_PW_K, Email,Full_Name, Select_Lang ,User_Status, Accept , News , FB_ID) 

    VALUES(:zuser, :zpass, :zpasskey, :zemail ,:zfullname, :zlang,1,1,0,:zfbid)");

        $stmt->execute(array('zuser' => $userName,
                              'zpass' => sha1($password),
                              'zpasskey' => $pwKey, 
                              'zemail' => $email, 
                              'zfullname'=> $fullname, 
                              'zlang'=> $lang, 
                              'zfbid' => $FB_ID
                            ));
                                  
}

    //get user new ID
    $users = superGet('*','users', "Email = '$email'");
    foreach ($users as $user) {}

    $_SESSION['uid']=$user['User_ID']; // Regist th User ID from DB in the Session 
    $_SESSION['user']=$user['User_Name'];;  // Regist the Session Name
    $_SESSION['ulang'] = $user['Select_Lang'];

       // redirectHome('index.php');
    
header('Location:index.php'); // Forowrd to the next Page 

include  $tpl . "footer.php";       
?>