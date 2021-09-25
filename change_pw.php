<?php 
ob_start();
	$pageTitle = 'Change Password | A to Z for All';
	
include 'init.php';


$do = isset($_GET['do']) ? $_GET['do'] : 'check_email';

        if($do == 'check_email'){  // Check Emaile Page

            ?>

    <h2 class="text-center"> <?php getTE('Insert your Email');?></h2>
        
        <!-- Start Change Password Form-->
    <div class="container">
        <div class="col col-md-6 col-md-offset-3">
         <form class="signup" data-class="signup" action="<?php echo $_SERVER['PHP_SELF'].'?do=send_email'; ?>" method="POST">
            
            <div >
                <input class="form-control" type="email" name="email"  placeholder="Email" required="required" >
            </div>
           
            <input class="btn btn-success btn-block " type="submit" value="Send">
            
        </form>
        </div>
    </div>
    <?php
        
    }elseif($do == 'send_email'){

    $email = $_POST['email'];
    if (!empty($email)){
        $users = superGet('*','users',"Email = '$email' ");
        if(isset($users)){

            // Change Password Key in DB
        $pwKey = rand(1000,9999);
        $sentPwKey = $pwKey + 1978;

        $stmt = $con->prepare("UPDATE users SET Change_PW_K = ? WHERE Email = ?") ;
        $stmt->execute(array($pwKey,$email));



            // Creat aud send the Email
            foreach ($users as $user){}
                $uEmail = $user['Email'];
                $userID = $user['User_ID'];
               // $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers = "Content-type:text/html;charset=UTF-8" . "\r\n"."From:info@a2z4a.com";
                //$link = $_SERVER['PHP_SELF'].'?do=insert_new_pw&T564789='.$userID.'&fd=2555&z=5678';
                $link = 'http://a2z4a.com/change_pw.php'.'?do=insert_new_pw&T564789='.$userID.'&fd='.rand(1000,9999).'&ar8='.$sentPwKey.'&z='.rand(100,999);

                $emailMsg = "
                <html>
                <head>
                <title>Change User's Password</title>
                </head>
                <body>
                <br>
                <p>Dear User</p>
                <br>
                <p>You asked to change your Password , If you do not want to change it just ignore this email.</p><br>
                <p>If you still want to change the current passowrd just Click hear <a href='".$link."'> Change Password</a>.</p>
                <br><br>
                <p>With best regards</p>

                <table>
                <tr>
                <th>Technical Support</th>
                </tr>
                <tr>
                <td><a href = 'http://a2z4a.com'>www.A2Z4A.com</a></td>
                <td></td>
                </tr>
                </table>
                </body>
                </html>

                " ;


            mail($uEmail,'Cahnge Password',$emailMsg,$headers);



            echo '<h1></h1>';
            $msg = '<div class="alert alert-success">'.getT('visit your email').'</div>';
            redirectHome($msg,'index.php');

        }else{// if email is not in the DB
            $msg = '<div class="alert alert-danger">'.getT('email not registed').'</div>';
            redirectHome($msg,'index.php');
        }
           
        
    }else{// if Email from POST is Empty
        $msg = '<div class="alert alert-danger">'.getT('insert Your Correct Email').'</div>';
            redirectHome($msg,'index.php');
     }


}elseif($do == 'insert_new_pw'){
            //T 564789  (Tric for sequrity)
        $userID = isset($_GET['T564789']) && is_numeric($_GET['T564789']) ? intval($_GET['T564789']) : 0;

            // Get PW Key
        $sentPwKey = isset($_GET['ar8']) && is_numeric($_GET['ar8']) ? intval($_GET['ar8']) : 0;
        $PwKey = $sentPwKey - 1978;

    $users = superGet('*','users',"User_ID = $userID AND Change_PW_K = '$PwKey' ");
    if(!empty($users)){ // if id fror reight user & Key is true
            ?>

<h2 class="text-center"> Change the Password</h2>
    
    <!-- Start Change Password Form-->
<div class="container">
    <div class="col col-md-6 col-md-offset-3">
     <form class="signup" data-class="signup" action="<?php echo $_SERVER['PHP_SELF'].'?do=update_pw' ; ?>" method="POST">

        <input type="hidden" name="uid" value="<?php echo $userID; ?>">
        
        <div >
            <input class="form-control" type="password" name="password1" autocomplete="new-password" placeholder="Password" required="required" minlenghtX="6" maxlengthX="12">
        </div>
        <div>
            <input class="form-control" type="password" name="password2" autocomplete="new-password" placeholder="Re-Password" required="required" minlenghtX="6" maxlengthX="12">
        </div>

        <input class="btn btn-success btn-block " type="submit" name="signup" value="SignUp">
        
    </form>
    </div>
</div>
    
    <!-- End Change Password Form-->

            <?php

        }else{//if user id is set in db
            getTE('Sorry, You are not resisted');
            } 


    }elseif ( $do == 'update_pw'){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    
        
        $password1  = $_POST['password1'];
        $password2  = $_POST['password2'];
        $userID     = $_POST['uid'];
        
      
        $formErrors = array();
  
        if (isset($password1) && isset($password2)){
            if (strlen($password1) < 6){
                $formErrors[] = getT('The Password must be');
            }
          
            
            if (sha1($password1) !== sha1($password2)){
                $formErrors[] = getT('The Passwords did not match');
            } 
        }
        
        
        if(empty($formErrors)){ // If All Fields in form is OK 

           $password   =  sha1($password2);

            $stmt = $con->prepare("UPDATE users SET Password = ? WHERE User_ID = ?") ;
        $stmt->execute(array($password,$userID ));

           
        
                    // echo Success message
                    $successMs = '<div class="alert alert-success">'.getT('Your Password successfully changed').'</div>';
                   redirectHome($successMs,"login.php" ,3);

                    }else{

                        echo '<div class= "container">';
                            echo '<div class="alert alert-danger">';
                            foreach ($formErrors as $error){
                            echo '§ ' . $error .'<br>';
                            }
                            echo '</div>'; 
                        echo '</div>';
                        redirectHome('',"x" ,4);
                        
                    }
        
                
            }else{//if user is set
                echo '<div class="container">';
                $msg = '<div class="alert alert-danger">'.getT('Sorry, You are not resisted').'/div>';
                redirectHome($msg,'index.php');
                echo '</div>';
            }

    }// ende else if 



 
include $tpl .'footer.php' ;  
    ?>