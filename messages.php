<?php 
ob_start(); 
session_start();

$pageTitle = 'Messages | A to Z for All';

include 'init.php';

if(isset($_SESSION['user'])){
  $userID = $_SESSION['uid'];
  ?>
  <div class="container">
    <div class="message">
    <div class="row">
      <div class="col col-md-5 ">
        <div class="main-list">
     
     <?php  
     $imgPath = 'images/profiles/' ;
     $parentMs = getInnerMessage("(Sender = $userID AND Parent_ID = 0) OR (Resiver = $userID AND Parent_ID = 0) ");

     echo '<ul>';
     foreach ($parentMs as $parentM) {
      $senderID = $parentM['User_ID'];
      $senders = superGet('*','users',"User_ID = $senderID") ;
      foreach ($senders as $sender) {}

        //Get Item's Image id 
        $itemID = $parentM['Item_ID'];
        $imgs = superGet('*','items_images',"Item_ID = $itemID AND Ist_Main = 1");
        foreach ($imgs as $img) {}
          if(isset($img['Item_ID'])){
            $itemImgLink = 'images/items/'.$img['Item_Image'];
          }else{
            $itemImgLink = 'images/form/not-available.png';
          }
      ?>
      <li>
        <div class="row">

          <div class="col col-xs-3">
              <img class="img-sender" src = "<?php echo $imgPath .$sender['User_Image'] ?>">
            <p class="col col-xs-12" class=""><span><?php getTE('Sender');?>  </span><a href="user_profile.php?userid=<?php echo $sender['User_ID'];?>"><?php echo $sender['User_Name']; ?></a> </p>
          </div>

          <div class="col col-xs-5">
              <a  href="<?php echo $_SERVER['PHP_SELF'].'?msg='.$parentM['Messages_ID']?>">  
                <label class="subject"><?php echo $parentM['Subject']?></label>
              </a>
              <span class="msg-time"><?php echo $parentM['Messages_Time'] ?></span>
          </div>

          <div class="col col-xs-4">
              <div class="text-center">
                    <!-- Get Item Name -->
                  <?php 
                  $items = getInnerItem("items.Item_ID = $itemID");

                  if(!empty($items)){
                    foreach ($items as $item) {}
                      echo $item['Item_Name'];  
                    }
                  ?>
                 </div>
              <div>
              <img class="img-item" src = "<?php echo $itemImgLink ; ?>">
            </div>

            <!-- Get Provider link -->
            <div class="text-center">
            <?php 
            // Get Provider 
            $users = superGet('*','items',"Item_ID = $itemID");
            if (!empty($users)){
            foreach ($users as $user) {}
              $userID = $user['User_ID'];

            $pros = getInnerProvider("providers.User_ID = $userID ");
            foreach ($pros as $pro) {}

            echo '<a href="pro_profile.php?proid='.$pro['Provider_ID'].'">'.$pro['Provider_Name'].'</a>';
          }
            ?>
            </div>
            
          </div>
       

      </li>
      <?php
     }
     echo '</ul>';

     ?>
        
      </div>
    </div>
    <div class="col col-md-5">
        <div class="list-detail">
        <?php
        $pMid = isset($_GET['msg']) && is_numeric($_GET['msg']) ? intval($_GET['msg']) : 0; 
        if(isset($pMid) AND $pMid != 0){// if thir is Selected parent message
        $owners = getInnerMessage("Messages_ID = $pMid");
        foreach ($owners as $owner) {  
          if (isset($owner['Sender'])){$senderID = $owner['Sender'];}else{$senderID = NULL;}
          if (isset($owner['Resiver'])){$resiverID = $owner['Resiver'];}else{$resiverID = NULL;}
                   
        if (($senderID == $userID )OR ($resiverID == $userID)){// (Security Check) if the user is sender or resiever

          // trick to get message class
          if ($owner['Sender'] == $userID){$clas = 'sender';}else {$clas = 'resiver';}

          $itemID = $owner['Item_ID'];

          ?>
          <div class="each-msg <?php echo $clas; ?>">
            <label><?php echo $owner['Subject']; ?></label><span class="d-msg-time"><?php echo $owner['Messages_Time']; ?></span>
            <p> <?php echo $owner['Message_Text']; ?></p>
          </div>

          <?php 
          // Get Child messages from parent id
          $parentID = $owner['Messages_ID']; 
          $childMsgs = getInnerMessage("Parent_ID = $parentID AND Item_ID = $itemID");
          foreach ($childMsgs as $childMsg) {

             // trick to get message class
          if ($childMsg['Sender'] == $userID){$clas = 'sender';}else {$clas = 'resiver';}


            ?>
          <div class="each-msg <?php echo $clas; ?>">
             <label><?php echo $childMsg['Subject']; ?></label><span class="d-msg-time"><?php echo $childMsg['Messages_Time']; ?></span>
            <p> <?php echo $childMsg['Message_Text']; ?></p>
          </div>

            <?php  
          }// end child foreach

        }else{//End sequrity check 
          echo getT('you do not have the permissions');
        }

      }
    }
        ?>
        </div>

        <div > <!--  Start Insert Messages-->
          <?php 
          if (isset($parentM['Item_ID'])){     //(!empty($parentMs)){

          ?>
          <p> <?php getTE('Send Answer'); ?></p>
          <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

            <input type="hidden" name="resiver" value="<?php echo $parentM['Sender'] ; ?>">
            <input type="hidden" name="itemid" value="<?php echo $parentM['Item_ID'] ; ?>">
            <input type="hidden" name="parentid" value="<?php echo $owner['Messages_ID'] ; ?>">

            <input type="text" name="subject" class="form-control">
            <textarea name="message" class="form-control"></textarea>
            <div class="text-center ">
            <input class="btn btn-primary col-sm-12" type="submit" value="<?php getTE('Send');?>" ">
            </div>
            
          </form>
         
          
        </div>

  <?php 
    // Insert the messsage into Database

          if($_SERVER['REQUEST_METHOD']== 'POST' && $_POST['subject'] != NULL){


                $fResiverid = $_POST['resiver'] ;
                $message   = tSec($_POST['message']) ;
                $subject   = tSec($_POST['subject']) ;
                $itemid    = $_POST['itemid'];
                $parentid  = $_POST['parentid'];

                // Trick to get The Resiver ID 

              if ($fResiverid == $userID){  
                $resiverid = $parentM['Resiver'];
               }else{
                $resiverid = $parentM['Sender'];
               }

                 $stmt = $con->prepare("INSERT INTO 
                       messages(Sender, Resiver, Message_Text,Subject,Item_ID, Parent_ID)
                    VALUES(:zsender,:zresiver, :zmessage,:zsubject,:zitemid, :zparentid) ");
                 $stmt->execute(array('zsender'   => $userID,
                                      'zresiver'  => $resiverid,
                                      'zmessage'  => $message,
                                      'zsubject'  => $subject,
                                      'zitemid'   => $itemid,
                                      'zparentid' => $parentid
                                         ));

                 // Send Email
                 //get user email & Full name
                            $ersivers = superGet('*','users',"User_ID = $resiverid");
                            foreach ($ersivers as $ersiver) {}
                            $fullName  = $ersiver['Full_Name'];
                            $email     = $ersiver['Email'];
                            $headers   = "Content-type:text/html;charset=UTF-8" . "\r\n"."From:info@a2z4a.de";
                            $emailText = getT('Dear').' '.$fullName.' '.getT('you have').' '.getT('new message').'<br><br>'.$subject.'<br>'.$message.'<br>'.'<a href="a2z4a.de/login.php">'.getT('replay').'</a>';
                            

                        mail($email,getT('New meeage'),$emailText,$headers);

               } // IF Server is POST

            }else{
              echo '<h3>'.getT('You do not have Any messages').' <i class="far fa-meh fa-spin"></i></h3>';
            }
    }else{
    	$mssg = '<div class="alert alert-danger">'.getT('Sorry, You are not resisted').'</div>';
    	redirectHome($mssg,'index.php');
    }
    echo '</div> </div></div></div>';
    include $tpl.'footer.php';
?>