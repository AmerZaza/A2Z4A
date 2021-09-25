<?php

//ID:      512219781952-01of960iata7psj9ummmioddtsiaumhu.apps.googleusercontent.com
//Secret:  7EcK_0ZTiaZk9m_mqgPlwUwu
ob_start();
session_start();
include 'init.php';

	require_once "includes/libraries/GoogleAPI/config.php";

	if (isset($_SESSION['access_token']))
		$gClient->setAccessToken($_SESSION['access_token']);
	else if (isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['access_token'] = $token;
	} else {
		header('Location: login.php');
		exit();
	}

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();
///////////////////////////////////////////////
/*

	$_SESSION['id'] = $userData['id'];
	$_SESSION['email'] = $userData['email'];
	$_SESSION['gender'] = $userData['gender'];
	$_SESSION['picture'] = $userData['picture'];
	$_SESSION['familyName'] = $userData['familyName'];
	$_SESSION['givenName'] = $userData['givenName'];

	header('Location: index.php');
	exit();
	*/

// Check if user in Db 

$gUserId = $userData['id'];
$email   = $userData['email'];
$gUsers = superGet('*','users', "Email = '$email'");
//$gUsers = superGet('*','users', "Google_ID = '$gUserId'");

if(empty($gUsers)){
  // Set User record Details:
  $userName = $userData['id'];
  $password = $userData['id'];
  $email    = $userData['email'];
  $pwKey  = rand(1000,9999);

  //$email = rand(1000,9999).'@'.rand(1000,9999).'.'.rand(10,99);
  
  $fullname = $userData['givenName'].' '.$userData['familyName'];
  $lang = 11;

  $gUserId = $userData['id'];

  $stmt = $con->prepare("INSERT INTO users(User_Name, Password, Change_PW_K, Email,Full_Name, Select_Lang ,User_Status, Accept , News , Google_ID) 

    VALUES(:zuser, :zpass, :zpasskey, :zemail ,:zfullname, :zlang,1,1,0,:zgid)");

        $stmt->execute(array('zuser' => $userName,
                              'zpass' => sha1($password),
                              'zpasskey' => $pwKey, 
                              'zemail' => $email, 
                              'zfullname'=> $fullname, 
                              'zlang'=> $lang, 
                              'zgid' => $gUserId
                            ));
                                  
}

    //get user new ID
    $users = superGet('*','users', "Email = '$email'");
    foreach ($users as $user) {}

    $_SESSION['uid']=$user['User_ID']; // Regist th User ID from DB in the Session 
    $_SESSION['user']=$user['User_Name'];;  // Regist the Session Name
    $_SESSION['ulang'] = $user['Select_Lang'];

    $_SESSION['uimg'] = $userData['picture'];
       // redirectHome('index.php');
header('Location:index.php'); // Forowrd to the next Page 

include  $tpl . "footer.php";  
?>