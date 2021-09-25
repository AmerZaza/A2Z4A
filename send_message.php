<?php 
ob_start(); 

session_start();

$pageTitle = 'Send Message | A to Z for All';
  
include 'init.php';

    //chek if the Id is Excist and is nummer
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0; //short if 
    $reciverid = isset($_GET['resiverid']) && is_numeric($_GET['resiverid']) ? intval($_GET['resiverid']) : 0; //short if 
    $parentid = isset($_GET['parentid']) && is_numeric($_GET['parentid']) ? intval($_GET['parentid']) : 0; //short if 

       // Select All Data Depend on this Id

    $items = getInnerItemRE("items.Item_ID = $itemid"); 
    foreach ($items as $item) {}
    

    
    
     if(isset($_SESSION['user'])){  
     	?>
    <div class="container">

      <h3 class="text-center"><?php getTE('Send Message for the Provider');?></h3>
      <div class="row">
        <div class="col-md-offset-3">
            <div class="add-comment ">

                <form action="<?php echo $_SERVER['PHP_SELF'].'?itemid='.$itemid;?>" method="POST" >
                	<input type="hidden" name="resiver" value="<?php echo $reciverid ; ?>">
                	<input type="hidden" name="item" value="<?php echo $itemid ; ?>">
                	<input type="hidden" name="parentm" value="<?php echo $parentid ; ?>">

                	<div class="col-sm-10 col-md-8 ">
                		<input class="form-control" type="text" name="Subject" required placeholder="<?php getTE('Subject'); ?>">

                    <textarea class="form-control" name="message" required placeholder="<?php getTE('The Message'); ?>"></textarea>
                    </div>
                    <div class=" col-sm-6   col-sm-offset-2">
                     <input class="btn btn-primary  col-sm-6 " type="submit" value="<?php getTE('Send'); ?>">
                    </div>
                </form>
                <?php 
                    if($_SERVER['REQUEST_METHOD']== 'POST'){
                        $message  = tSec($_POST['message']) ;
                        $subject  = tSec($_POST['Subject']) ;
                        $userid   = $_SESSION['uid'] ;
                      //  $resid    = $reciverid;
                        $resiverid = $_POST['resiver']; 
                        $parentid = $_POST['parentm'];

                        //$message = 1;



                        if(!empty($message)){
                            $stmt = $con->prepare("INSERT INTO 
                              messages(Sender, Resiver, Message_Text,Subject,Item_ID, Parent_ID)
                              VALUES(:zsender,:zresiver, :zmessage,:zsubject,:zitemid, :zparentid) ");
                              $stmt->execute(array('zsender'   => $userid,
                                                   'zresiver'  => $resiverid,
                                                   'zmessage'  => $message,
                                                   'zsubject'  => $subject,
                                                   'zitemid'   => $itemid,
                                                   'zparentid' => $parentid

                                                     ));

                        // send Email 

                          //get user email & Full name
                            $ersivers = superGet('*','users',"User_ID = $resiverid");
                            foreach ($ersivers as $ersiver) {}
                            $fullName  = $ersiver['Full_Name'];
                            $email     = $ersiver['Email'];
                            $headers   = "Content-type:text/html;charset=UTF-8" . "\r\n"."From:info@a2z4a.de";
                            $emailText = getT('Dear').' '.$fullName.' '.getT('you have').' '.getT('new message').'<br><br>'.$subject.'<br>'.$message.'<br>'.'<a href="a2z4a.de/login.php">'.getT('replay').'</a>';
                            

                        mail($email,getT('New meeage'),$emailText,$headers);

                                
                        echo '<div class="container">'; 
                          echo '<div class="col-md-10">';
                              $msg = '<div class="alert alert-success"> '.getT('Your Message added successfully').'</div>';
                        redirectHome($msg,'messages.php');
                          echo '</div>';
                        echo '</div>';
                        }//end if message not empty  
                    
                     }// end if request = post
                ?>
            
            </div>
         </div>
      </div>
    </div>
    <?php }else{
         echo  getT('To add Comment Pleas').'<a href="login.php">SigIn</a>' ;
     }
		include  $tpl . "footer.php";
		?>
     

