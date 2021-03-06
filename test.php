<?php 
ob_start();
	session_start();
	$pageTitle = 'login';
	if (isset($_SESSION['user'])) {
	header('Location:index.php'); // Forowrd to the next Page If the session is allready exist 	before
        exit();
	}
	
include 'init.php';

?>

<h2 class="text-center"> <?php getTE('Sign IN')?></h2>
    
    <!-- Start LogIn Form-->
    <div class="container">
        <div class="row">
            <div class="col col-md-6">
                <form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <div class="input-container">
                    <div class="col col-md-12">
                     <input class="form-control" type="text" name="username" autocomplete="off" placeholder="<?php getTE('User Name');?>" required="required" />
                    </div>
                </div>
                <div class="input-container">
                    <div class="col col-md-12">
                        <input class="form-control" type="password" name="password" autocomplete="new-password" placeholder="<?php getTE('Password');?>" required="required"  >
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-2" >
                    <input class="btn btn-warning  col-xs-12" type="submit" name="login" value="<?php getTE('Sign IN')?>">
                </div>
            </form>

            <div class="col-md-8 col-md-offset-2 ">
            <a class="btn btn-success col-xs-12" href="signup.php"><?php getTE('Register as new user');?></a>
             </div>
                
            </div> <!--end log with email -->

            <div class="col col-md-6">
                <h4 class="text-center"><?php getTE('Or you can log in using');?></h4>
            <!-- Facebook SignIn Buttonn -->
            <div>
            <?php 

            require_once __DIR__ .'/includes/libraries/facebook/src/Facebook/autoload.php';

            $fb = new Facebook\Facebook([
              'app_id' => '1996541913750498', 
              'app_secret' => 'd3a117b6a1f588a19902519b3d0a768c',
              'default_graph_version' => 'v2.2',
              ]);
            $helper = $fb->getRedirectLoginHelper();

                 $permissions = ['email']; // Optional permissions
             $loginUrl = $helper->getLoginUrl('https://a2z4a.com/fb-callback.php', $permissions);

                echo '<div class="col-md-8 col-md-offset-2">';
                echo '<a class="btn btn-primary col-xs-12" href="' . htmlspecialchars($loginUrl) . '">Facebook</a>';
                echo '</div>';

                 ?>
             </div><!-- End facebook buttun-->
             <div>
                <!-- Google SignIn Buttonn -->
            <?php 

       
  ////////////////////////////////////
        require_once "includes/libraries/GoogleAPI/config.php";
        $loginURL = $gClient->createAuthUrl();
        ?>
        <div class="col-md-8 col-md-offset-2">
        <input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Log In With Google" class="btn btn-danger col-xs-12">
        </div>
        
                 
             </div><!-- end google buttun-->
                
            </div>
            
        </div><!--end row -->
        
    </div><!--end container -->
    

    <?php

// Check if the User is comming From HTTP POST Connect
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset ($_POST['login'])){
        
	$visitorn = tSec($_POST['username']);
	$pass = $_POST['password'];
	$hashedPass = sha1($pass);
   

	// Chek if the user is EXIST in DB *Excute Statement*

    $visitors = superGet('*','users',"User_Name = '$visitorn' AND Password = '$hashedPass' OR Email  = '$visitorn' AND Password = '$hashedPass'"); //
    
    foreach ($visitors as $visitor){}

    if (!empty($visitors)){
        $_SESSION['user']=$visitor['User_Name'];  // Regist the Session Name
        $_SESSION['uid']=$visitor['User_ID']; // Regist th User ID from DB in the Session
        $_SESSION['ulang']=$visitor['Select_Lang']; // Regist th User ID from DB in the Session
        header('Location:index.php'); // Forowrd to the next Page 
        exit(); 
    

    
    }else{
        ?>
        <div class="col col-md-8 col-md-offset-2">
            <div class="alert alert-danger"> 
                <div><?php getTE('User Name or Password are not Correct');?></div>
                <br>
                <div><a href=change_pw.php> *<?php getTE('Forget the Password');?> </a></div>
            </div>
            
        </div>

        <?php
    } 
  }
} 
 
 ?>


 <?php
include $tpl .'footer.php' ;  
    ?>