<?php 

session_start();

$pageTitle = 'Providers Profile | A to Z for All';
    
include 'init.php';


  $proID = isset($_GET['proid']) && is_numeric($_GET['proid']) ? intval($_GET['proid']) : 0;
  $providers = getInnerProvider("providers.Provider_ID = $proID");
  if(!empty($providers)){
    foreach ($providers as $pro){}

    ?>
    <div class="container">
        <div class="row">
            <div class="col col-md-12">
                <div class="container">
                    <div class="profile-head">
                        <img class="profile-back-img" src="images/profiles/<?php echo $pro['User_back_image'];?>">
                    </div>
                    <div class="profile-head-info">
                            
                        <div class="profile-title"> <?php echo $pro['Full_Name']?></div>
                             <img class="head-user-img" src="images/profiles/<?php echo $pro['User_Image'] ?>">
                        </div>
                </div>

                    <div class="container user-details">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><label><?php getTE('Provider Name');?> : </label><span><?php echo $pro['User_Name'];?></span></li>
                                     <li><label><?php getTE('Full Name');?> :</label><span><?php echo $pro['Full_Name'];?></span></li>
                                    <li><label><?php getTE('Email');?> :</label><span><?php echo $pro['Email'];?></span></li>
                                    <li><label><?php getTE('Phone');?> :</label><span><?php echo $pro['Provider_Phone'];?></span></li>
                                    
                                     <li><label><?php getTE('Website');?> :</label><span><?php echo $pro['User_Web'];?></span></li>
                                     <?php 
                                     //get Language
                                     $langID = $pro['Select_Lang'];

                                     $langs = superGet('*','languages',"Lang_ID = $langID"); 
                                     foreach ($langs as $lang){}

                                     ?>
                                     <li><label><?php getTE('Language');?> : </label><span><?php echo $lang['Lang_Name'];?></span></li>
                                    <li><label><?php getTE('Regist Date');?> :</label><span><?php echo $pro['Regis_Time'];?></span></li>

                                        <?php 
                                        if(isset($pro['Contact_Person'])){
                                            echo '<li><label>'.getT('Contact Person').':</l<bel><span>'.$pro['Contact_Person'].'</span></li>';}
                                        if(isset($pro['About_Pro'])){
                                            echo '<li><label>'.getT('About Provider').' :</l<bel><p>'.$pro['About_Pro'].'</p></li>';}
                                        if(isset($pro['Pro_Services'])){
                                            echo '<li><label>'.getT('Providers Services').' :</l<bel><p>'.$pro['Pro_Services'].'</p></li>';}

                                         
                                        ?>
                                 </ul>
         
                             </div>

                             <div class="col-md-6">
                                   <?php 
                                    $userLoc = $pro['U_Location_ID'];
                                    if(isset($userLoc)){
                                    $areas = superGet('*','locations_text', "Location_ID = $userLoc");
                                    foreach ($areas as $area) {}
                                    ?>
                                     <ul>
                                        <li><label><?php getTE('Country');?> :</label><span><?php if(isset($pro['Country'])){ echo $pro['Country'];}?></span></li>
                                        <li><label><?php getTE('Region');?> :</label><span><?php if(isset($pro['Region'])){echo $pro['Region'];} ?></span></li>
                                        <li><label><?php getTE('City');?> :</label><span><?php if(isset($pro['City'])){ echo $pro['City'];}?></span></li>
                                        <li><label><?php getTE('Street');?> :</label><span><?php if(isset($pro['Street'])){ echo $pro['Street'];}?></span></li>
                                        <li><label><?php getTE('Haus Nummer');?> :</label><span><?php if(isset($pro['Haus_N'])){ echo $pro['Haus_N'];}?></span></li>
                                        <li><label><?php getTE('Address Notes');?> :</label><span><?php if(isset($pro['Loc_Note'])){ echo $pro['Loc_Note'];}?></span></li>


                                     </ul>
 
                                    <?php 


                                } // END IS Set?>
                                    
                                </div>
                            </div>
                        </div>
   
                    
                </div>
           
        </div>
    </div>


<div class="container" id="my-items">
    
    <div class="container">
        <div class="row">
            
      
        <?php 
        $proUserID = $pro['User_ID'];
        $items = getInnerItem("items.User_ID = $proUserID ");
        if (!empty($items)){  ?>
            <h1 class="title"><?php getTE('My Items'); ?></h1>
            <?php
      
         foreach ($items as $item){  
            $itemid = $item['Item_ID'];
            $images = superGet('*','items_images', "Item_ID = $itemid AND Ist_Main = 1");
            
            // Set $img = Default if ther is no image
               if (!empty ($images)){
                foreach ($images as $imge){
                        $img = $imge['Item_Image'];
                    }
                }else {
                    $img = 'item.jpg';
                }
            
        
                echo '<div class="col-md-3">'; 
                 echo '<div class="thumbnail item-box">'; 
                  echo '<a href= '.$item['Item_Page_Code'].'?itemid='.$item['Item_ID'].'>';
                    
                    echo '<img  src="images/items/'.$img.'" alt="" class="class="img-responsive"/>';
                    echo '<div class="caption">';
                        echo '<p class="title">'.$item['Item_Name'].'</p>';
                        //echo '<p>'.$item['Item_Description'].'</p>';
                        echo '<p class="date">'.$item['Inser_Time'].'</p>';
                        echo '<spam >'.$item['Main_Price'].' ' .$item['Currency_Code'].'</spam>';
                
                      echo '</div>' ; 
                      echo '</a>' ;
                    echo '</div>' ;
                echo '</div>';                
            
             } // for each item
          }// if item not empty
        ?>
        </div>
        
    </div>
</div>


<!-- Start Add Comment Form -->
    <div class="control-box">
       <div class="container">
        <p class="control-title"><?php getTE("Add Your Comment");?> <span class="icon"><i class="far fa-comments"></i></span> </p>
        </div>


    <div class="container" id="comment">
    <?php if(isset($_SESSION['user'])){  ?>
    <div class="row">
            <div class="data-form">
            
                <form action="<?php echo $_SERVER['PHP_SELF'].'?proid='.$proID.'#comment';?>" method="POST">  
                   
                    <div>
                        <select class="form-control " name="star">
                            <option value=""> <?php  getTE("Select Stars");?> </option>
                            <option class="star" value="1">★</option>
                            <option class="star" value="2">★★</option>
                            <option class="star" value="3">★★★</option>
                            <option class="star" value="4">★★★★</option>
                            <option class="star" value="5">★★★★★</option>
                        </select>

                        <textarea class="form-control" name="comment" required placeholder="<?php  getTE("Comment");?>"></textarea>

                    </div>   
                    <div class="text-center">             
                       <input class="btn btn-primary" type="submit" value="<?php  getTE("Add Comment");?>">
                    </div>  
                </form>
                <?php 

                // check if it the fist commit from this user
                $userid  = $_SESSION['uid'] ;
                

                $comms = superGet('*','provider_evaluation',"Provider_ID = $proID AND User_ID = $userid");
                if(empty($comms)){

                    if($_SERVER['REQUEST_METHOD']== 'POST'){

                      $star    = $_POST['star'] ;
                      $comment = tSec($_POST['comment']) ;   
                      $langid  = $_SESSION['ulang'];
                        
                        
                      if(!empty($comment)){
                            $stmt = $con->prepare("INSERT INTO 
                              provider_evaluation(Provider_ID, User_ID, Provider_Star)
                              VALUES(:zitemid, :zproid, :zstar) ");
                              $stmt->execute(array('zitemid'=>$proID,
                                                   'zproid' =>$userid,
                                                   'zstar'  =>$star
                                                    ));

                              $stmt = $con->prepare("INSERT INTO 
                              provider_evaluation_ml(Evaluation_ID, Lang_ID ,Provider_Comment)
                              VALUES(LAST_INSERT_ID(), :zlang, :zcomment) ");
                              $stmt->execute(array( 
                                                   'zcomment'  =>$comment,
                                                   'zlang'     =>$langid 
                                                    ));
                            if($stmt){
                              
                                echo '<div class="alert alert-success"> '.getT('Your Comment Added Successfully').'</div>';
                            
                                }
                            }
                         }   
                    }else{// if empty Provider + User

                      if($_SERVER['REQUEST_METHOD']== 'POST'){

                      $star    = $_POST['star'] ;
                      $comment = tSec($_POST['comment']) ;  

                      // Get Comment ID If it set
                      foreach ($comms as $comm) {}
                        $commID = $comm['Evaluation_ID'];
                    

                     $stmt = $con->prepare("UPDATE provider_evaluation SET  Provider_Star = ? ,Evaluation_Display = 0 WHERE Evaluation_ID = ?");
                     $stmt->execute(array( $star,$commID ));


                    $stmt = $con->prepare("UPDATE provider_evaluation_ml SET  Provider_Comment = ? WHERE Evaluation_ID = ?");
                     $stmt->execute(array( $comment ,$commID));

                      echo '<div class="alert alert-success"> '.getT('Your Comment Updated Successfully').'</div>';
                       }
                    }
                    ?>
            
            </div>
        </div>
  
    </div>
    <?php }else{
         echo  '<a href="login.php">'.getT('Sign IN').'</a> '.getT('To add Comment Pleas')  ;
         echo '</div>'; 
     }  ?>
     
        
    </div>

    
    <!-- End Add Comment Form -->

    <!-- Start View Pro Comments section -->
  <div class="container ">
    <?php 
    $evaluations = getInnerProEv("provider_evaluation.Provider_ID = $proID AND Evaluation_Display = 1"); 
      foreach ($evaluations as $eva){
        ?>
        <div class="container commints">
          <div class="row">
            <div class="col-sm-2">
          
              <?php echo $eva['Evaluation_Time'];?>
            </div>
            <div class="col-sm-3">
              <?php grtStar($eva['Provider_Star']);?>
            </div>
            <div class="col-sm-7">
              <?php echo $eva['Provider_Comment'];?>
            </div>
            
          </div>
          
        </div>
        <?php 
      }
    ?>
  </div>


    <?php
        } // end if proveider not EMPTY 


include  $tpl . "footer.php";