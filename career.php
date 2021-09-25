<?php 
ob_start();
    session_start();
    $pageTitle = 'Career | A to Z for All';

include 'init.php';

// Check if the User is comming From HTTP POST Connect
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    
        $formErrors = array();
        
        $name    = tSec($_POST['name']);
        $email   = eSec($_POST['email']);
        $phone   = nSec($_POST['phone']);
        $subject = tSec($_POST['job-title']);
        $message = tSec($_POST['text']);

        // Get user id from the session
        if(isset($_SESSION['uid'])){
            $userID = $_SESSION['uid'];
        }else{
            $userID = NULL ;
        }
        
        
        if (isset($name)){  
            if (strlen($name) < 4){
                $formErrors[] = getTE('The User  must be longer than 3 latter');
            }
        }
  
        if(isset($email)){
            $filterdEmail = $email ;  
            if(filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true){
                $formErrors[] = getTE('This is not Email Form');
            }
        }
        if (!isset($subject)){
                $formErrors[] = getTE('Pleas insert the Subject');
        }

        if (!isset($message)){
                $formErrors[] = getTE('Pleas writ the message');
        }
       
        if(empty($formErrors)){ // If All Fields in form is OK 


            //Insert User in DB
                $stmt = $con->prepare("INSERT INTO feedback(User_ID, Name, Email, Phone, Subject, Fb_Text, Status) VALUES( :zuserid ,:zname ,:zemail ,:zphone, :zsubject, :ztext, 0)");
                $stmt->execute(array('zuserid' => $userID,'zname' => $name,'zemail' => $email,'zphone'=>$phone, 'zsubject'=>$subject, 'ztext'=>$message));
            

            // echo Success message
            $successMs = '<div class="alert alert-success" >'.getT('Thank you for Feedback').'</div>';
            redirectHome($successMs,'index.php',2);
           

            }
        }


?>

    
    <h1 class="text-center"><?php getTE('Career'); ?></h1>
    <!-- Start Feedback Form-->
    <div class="container">
        <div class="row">
            
        
    <div class=" col-md-offset-2 col-md-5  mine-box ">
        
    <form class="signup" data-class="signup" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

        <div class="input-container">
            <input class="form-control" type="text" name="name" autocomplete="on" placeholder="<?php getTE('Full Name');?>" required="required"  title="The User Name is not Validate" >
        </div>

        <div class="input-container">
            <input class="form-control" type="text" name="email"  placeholder="<?php getTE('Email');?>" required="required">
        </div>

        <div class="input-container">
            <input class="form-control" type="text" name="phone"  placeholder="<?php getTE('Phone');?>">
        </div>

        <div class="input-container">
            <select class="form-control" name="job-title">
                <option value="IT Manager"><?php getTE('IT Manager');?></option>
                <option value="Website Developer"><?php getTE('Website Developer');?></option>
                <option value="Website Designer"><?php getTE('Website Designer');?></option>
                <option value="Marketing"><?php getTE('Marketing ');?></option>
            </select>
        </div>

        <div class="input-container">
            <textarea class="form-control"  rows="6" name="text" autocomplete="off" placeholder="<?php getTE('Messages');?>" required="required" ></textarea>
        </div>


        <input class="btn btn-primary btn-block " type="submit" name="signup" value="<?php getTE('Send');?>">
    </form>

    
    </div>
    <div class="col-md-offset-2 col-md-3 ">
        <div class="career-send-mail">
            <p><?php getTE('Or send your CV by Email to');?> :</p>
            <a href="mailto:job@a2z4a.com">job@A2Z4A.com</a>
        </div>
        
    </div>
  </div>
</div>
    <!-- End Feedback Form-->


    <!-- Start Message Box -->
<div class="container text-center">
    
    <?php 
    
    if (!empty ($formErrors )){
        echo '<div class="alert alert-danger">';
        foreach ($formErrors as $error){
        echo '§ ' . $error .'<br>';
        }
        echo '</div>'; 
    }
        
          
        if (isset($successMs)){
            echo '<div class="alert alert-success">';
            echo $successMs ;
            echo '</div>' ;
            }
        ?>
    
</div>
    <!-- End Message Box -->

<?php  
include $tpl .'footer.php' ;  
    ?>