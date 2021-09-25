<?php 
ob_start();

session_start();

$pageTitle = 'Subscribe | A to Z for All';
include 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
        $formErrors = array();
        
        $name    = tSec($_POST['name']);
        $email   = eSec($_POST['email']);
       

        // Get user id from the session

        	/*
        if(isset($_SESSION['uid'])){
            $userID = $_SESSION['uid'];
        }else{
            $userID = NULL ;
        }
        	*/
        
        
        if (isset($name)){  
            if (strlen($name) < 4){
                $formErrors[] = getTE('The User must be longer than 3 latter');
            }
        }
  
        if(isset($email)){
            $filterdEmail = $email ;  
            if(filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true){
                $formErrors[] = getTE('This is not Email Form');
            }
        }
        
       
        if(empty($formErrors)){ // If All Fields in form is OK 

    

                    //Insert User in DB
                        $stmt = $con->prepare("INSERT INTO subscribe(Subscribe_Name, Subscribe_Email) VALUES( :zname ,:zemail )");
                        $stmt->execute(array('zname' => $name,'zemail' => $email));
                    

                   

                    }
            $msg = '<div class="alert alert-success" >'.getTE('Your Email added to the Subscribe list').'</div>';
            redirectHome($msg, "index.php" , 2);
        }
    

?>
<h2 class="text-center"><?php getTE('Add me to the Subscribe List');?></h2>
<div class="container ">
	<div class="row ">
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
			<div class=" col col-md-6 col-md-offset-3">
            <input class="form-control" type="text" name="name" autocomplete="off" placeholder="<?php getTE('Name');?>" required="required"  title="The  Name is not Validate" >
        </div>

        <div class=" col col-md-6 col-md-offset-3">
            <input class="form-control" type="email" name="email" autocomplete="off" placeholder="<?php getTE('Email');?>" required="required"  title="The Email is not Validate" >
        </div>

        <div class=" col col-md-4 col-md-offset-4">
        <input class="btn btn-primary btn-block " type="submit" name="signup" value="<?php getTE('Subscribe');?>">
        </div>

			
		</form>
		
	</div>
	
</div>

<?php
include  $tpl . "footer.php";
