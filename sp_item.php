<?php 

session_start();

$pageTitle = 'Automobile Spare Part | A to Z for All';
  
include 'init.php';


    //chek if the Id is Excist and is nummer
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0; //short if 
       // Select All Data Depend on this Id

$items = getInnerItemSP("items.Item_ID = $itemid ");

if(!empty($items)){  // If the item ID is in DB
  foreach ($items as $item) {}

    // Get Variables Name

    // Get Brand 
      if(isset($item['Brand_ID']) ){
        $brandID = $item['Brand_ID'];
        $brands = superGet('*','brands',"Brand_ID = $brandID");
        foreach ($brands as $brand) {}
           $brandName = $brand['Brand_Name'];
      }else{$brandName = getT('Not Set');}
    
    // Get Maker
    if (isset($item['Maker_ID']) & $item['Maker_ID'] != 0){
    $makerID =  $item['Maker_ID'];
    $makers = superGet('Make_Name','makes',"id = $makerID");
    foreach ($makers as $maker) {}
     $makerName = $maker['Make_Name']; 
    }else {$makerName = getT('All');}

// Get Model
    if (isset($item['Model_ID']) ){
      $modelID = $item['Model_ID'];
      $models = superGet('Model_Name','models',"id = '$modelID'");
      foreach ($models as $model) {}
      $modelName = $model['Model_Name'];

      if ($modelName == 'Other' & isset($item['Model_Text'])){
        $modelName = $item['Model_Text'];
      }elseif($modelName == 'Other' & !isset($item['Model_Text'])){
        $modelName = getT('All');
      }

    }else{$modelName = getT('All');}

    // Get Fuel
    $fuelID = $item['AM_Fuel_ID'];
    $fuels = getInnerFuelAm("am_fuel.AM_Fuel_ID = $fuelID");
    foreach ($fuels as $fuel) {}

?>
<div class="container">
  <div class="row">
    <div class="col col-md-9">
      <div class="control-box">

        <div class="container">
          <p class="control-title"><?php echo $item['Item_Name'];?>  <span class="icon"><i class="fas fa-cog"></i></span></p>
        </div>
         <?php 
            //Chek if the Item hast photos
            // Get All Photos
            $images = superGet('*','items_images',"
                items_images.Item_ID = $itemid");
             if (!empty($images)){
            ?>

            <div class="col-xs-3">
              <div class="all-photo-list" id="photo-list">
                <p class="scrool-btn top" onclick="scrollT()"><i class="far fa-caret-square-up fa-2x"></i></p>
              <?php 
             
              echo '<div class="">';
              foreach ($images as $image) {
              echo  '<img class="item_image" src="images/items/'.$image['Item_Image'].'" alt=""/>';
                }
                echo '</div>';
              ?>
              <p class="scrool-btn down" onclick="scrollD()"><i class="far fa-caret-square-down fa-2x"></i></p>
          </div>
        </div>

        <div class="col-xs-9 " >
          <div class="focus-photo ">
            <?php 
          // Get Main Photo 
            
          $images = superGet('*','items_images',"items_images.Item_ID = $itemid  AND Ist_Main = 1");
          echo '<div class="col ">';
          foreach ($images as $image) {}
              if (!empty($image)){
          echo  '<img class="focus_image" src="images/items/'.$image['Item_Image'].'" alt=""/>';
              }else{
                  echo 'This ADS has no Photos';
              }
            echo '</div>'; 

            ?>
            </div>

            <div class="container">
                  <div class="item-n"><?php getTE('Item Number');?>:<?php echo 'RE'.$itemid ; ?></div>
              </div>

        </div>
        <?php 
       }else{ // if item has no photos
          ?>

        <div class="col-xs-9">
            <img class="no-img-item center" src="images/form/no_photo.jpeg">

            <div class="container">
             <p class="item-n">Item Number:<?php echo 'RE'.$itemid ; ?></p>
            </div>
        </div>
        <?php


        }// End else item withut photos
             if (isset($item['Item_Description'])){
              echo '<div class="item-desc">';
              echo '<p>'.$item['Item_Description'].'</p>';
              echo '</div>';
            }
        ?>

          </div>
        </div>

        <div class="col-md-3">

          <div class="control-box">
                   <div class="container">
                    <p class="control-title"><?php getTE("Item Evaluation");?> <span class="icon"><i class="fas fa-star-half"></i></span> </p>
                    </div>
                    <?php  // Get Item Evalutions

                      // Get Evauation Count
                      $evalCount = countRec('Evaluation_ID','items_evaluations',"Item_ID = $itemid AND Evaluation_Display = 1");
                      echo '<span>'.getT("Evaluations time").': <span>'.$evalCount;

                      echo '<br>';

                     // Get Stars Avrage
                        $StarAvrage = avgRec('Item_Star','items_evaluations',"Item_ID = $itemid AND Evaluation_Display = 1");
                         grtStar($StarAvrage);
                     ?>
                  </div>
                  <div class="control-box">
                     <div class="container">
                      <p class="control-title"><?php getTE("sharing");?> <span class="icon"><i class="fa fa-share-alt" aria-hidden="true"></i></span> </p>
                      </div>

                     <div class=" sharing ">


                        <?php
                         $link = "https://www.a2z4a.com/re_item.php?itemid=".$itemid;
                         ?>
        <div class="container">
          <div id="share">

  <!-- facebook -->
  <a class="facebook" href="https://www.facebook.com/share.php?u=<?php echo $link;?>&title=<?php echo $item['Item_Name'];?>" target="blank" ><i class="fab fa-facebook-f"></i></a>

  <!-- twitter -->
  <a class="twitter" href="https://twitter.com/intent/tweet?status=<?php echo $link;?>" target="blank"><i class="fab fa-twitter"></i></a>

  <!-- google plus -->
  <a class="googleplus" href="https://plus.google.com/share?url=<?php echo $link;?>" target="blank"><i class="fab fa-google-plus-g"></i></a>

  <!-- linkedin -->
  <a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link;?>&title=<?php echo $item['Item_Name'];?>&source={{source}}" target="blank"><i class="fab fa-linkedin-in"></i></a>
  
  <!-- pinterest -->
  <a class="pinterest" href="https://pinterest.com/pin/create/bookmarklet/?media={{media}}&url=<?php echo $link;?>&is_video=false&description=<?php echo $item['Item_Description'];?>" target="blank"><i class="fab fa-pinterest-p"></i></a>

  <!-- Whats app -->
  <a class="whatsapp" href="https://api.whatsapp.com/send?text=<?php echo $link;?>" target="_blank"><i class="fab fa-whatsapp"></i> </a>
  <!-- Post -->
  <a class="post" href="mailto:name@mail.com?subject=My%20Advice&amp;body=Visit This Link: <?php echo $link;?>" ><i class="fas fa-at"></i></a>

  </div>
</div>

                  </div>
                </div>

          <div class="under-sharing-ads"> <!-- ads -->
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- item page under shearing responce -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-4112940950021564"
                 data-ad-slot="1621025161"
                 data-ad-format="link"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>

          </div>
   
        </div>
  
        
      </div> <!-- End Row-->

      <div class="container">
            <div class="row">
              <div class="col-md-3">  
                <!--
                <div class="data-form">
                    <p class="title"><?php  getTE("Address");?></p>
                    <?php 
                    ?>
                    <span> <?php echo $loc['Street']; ?></span><br>
                    <span> <?php echo $loc['Zip']; ?></span> 
                    <span> <?php echo $loc['City']; ?></span>
                    <span> <?php echo $loc['Region']; ?></span>
                     <br>
                    <span> <?php echo $loc['Country']; ?></span>

                </div>     -->
                </div>
            </div>             
        </div>


    <div class="am-tags">      
          <?php 
          if (! empty($item['Item_Tags'])){  
                  
                  $allTags = explode("," , $item['Item_Tags']);

                      foreach ($allTags as $allTag){
                          echo '<span class=""> ';
                          echo '<a href="tags.php?name='.$allTag.'" target="_blank">'.$allTag. '</a>';
                          echo '</span>';
                      }
                  }  ?>    
    </div>
        

  <div class="container">
      <div class="row"> 

        <div class="col-md-8 ">

          <div class="control-box">
            <div class="container">
                  <p class="control-title"><?php getTE("Basic Information");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                  </div>

                  <div class="packet">
                   <div class="container ">
                      <div class="col-md-12 ">

                      <div class="info-line"> <label><?php getTE("Item Group");?></label><span><?php echo $item['SP_Group_Name'];?></span></div> 

                      <hr class="custom-hr">

                    <div class="info-line"> <label><?php getTE("Item");?></label><span><?php echo $item['SP_Main_Item_Name'];?></span></div>

                    <hr class="custom-hr">

                    <div class="info-line"> <label><?php getTE("Brand");?></label><span><?php echo $brandName;?></span></div>

                    <hr class="custom-hr">

                    <div class="info-line"> <label><?php getTE("Unit");?></label><span><?php echo $item['Unit_Name'];?></span></div>

                    <hr class="custom-hr">

                    <div class="info-line"> <label><?php getTE("  Reference");?></label><span><?php echo $item['SP_Reference'];?></span></div>

                    <hr class="custom-hr">

                   <div class="info-line"> <label><?php getTE("Price");?></label><span><?php echo $item['Main_Price'].' '.$item['Currency_Code'];?></span></div>

                   <hr class="custom-hr">

                  <div class="info-line"> <label><?php getTE("Maker");?></label><span><?php echo $makerName;?></span></div>

                  <hr class="custom-hr">

                  <div class="info-line"> <label><?php getTE("Model");?></label><span><?php echo $modelName;?></span></div>

                  <hr class="custom-hr">

                  <div class="info-line"> <label><?php getTE("Fuel");?></label><span><?php echo $fuel['AM_Fuel_Name'];?></span></div>

                  <hr class="custom-hr">

                  <div class="info-line"> <label><?php getTE("Production");?></label><span><?php echo $item['Production_Year'];?></span></div>


              </div>
            </div>
          </div>
        </div>
        
      

              <div class="control-box">
                <div class="container">
                <p class="control-title"><?php getTE("Details");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>

                <div class="packet">
                 <div class="container ">
                    <div class="col-md-12 ">

                      <div class="info-line"> <label><?php getTE("Link to another site");?></label><span><?php echo $item['Item_Link1'];?></span></div>
                      <hr class="custom-hr">

                      <div class="info-line"> <label><?php getTE("Link to another site");?></label><span><?php echo $item['Item_Link2'];?></span></div>
                      <hr class="custom-hr">

                      <div class="info-line"> <label><?php getTE("Description");?></label><textarea readonly class="form-control" rows="5"><?php echo $item['Item_Description'];?></textarea></div>

                    </div>
                  </div>
                </div>
              </div>

      </div>

      <div class="col-md-4 ">
        <div class="control-box">
          <div class="container">
            <p class="control-title"><?php getTE("Provider");?> <span class="icon"><i class="far fa-address-card"></i></span> </p>
            </div>
          
              <?php // Get Providers Details
              $proUid = $item['User_ID'];
              $pros = getInnerProvider("providers.User_ID = $proUid");
              foreach ($pros as $pro) {}

              ?>
              <p><?php getTE("Provider");?> : <a href="pro_profile.php?proid=<?php echo $pro['Provider_ID'];?>"><?php echo $pro['Provider_Name'];?></a></p>
              <p><?php  getTE("Contact Person");?>: <?php echo $pro['Contact_Person'];?> </p>
          
            <div class="text-center">
              <div>
              <img class="pro-img" src="images\profiles\<?php  echo $pro["User_Image"] ; ?>" alt="" />
              </div>

             <?php  // Get Provider Evalutions

              // Get Evauation Count
             $proID = $pro['Provider_ID'];
              $evalCount = countRec('Evaluation_ID','provider_evaluation',"Provider_ID = $proID AND Evaluation_Display = 1");
              echo '<span>'. getT("Evaluations time").': <span>'.$evalCount;

              echo '<br>';

             // Get Stars Avrage
             $proID = $pro['Provider_ID'];
                $StarAvrage = avgRec('Provider_Star','provider_evaluation',"Provider_ID = $proID AND Evaluation_Display = 1");
                 grtStar($StarAvrage);

             ?>
             <br>
             <p><i class="fas fa-phone"></i> :<?php echo $pro['Provider_Phone'];?> </p>
             <p><i class="far fa-envelope-open"></i> : <?php echo $pro['Email'];?> </p>

             <div>
             <a class="btn btn-default" href="send_message.php?itemid=<?php echo $item['Item_ID'].'&resiverid='.$item['User_ID'] ?>" target="popup"> <?php  getTE("Send Message for Provider");?></a>
            </div>
          </div>
            
        </div> 
      </div>
    </div>             
  </div>
  

    <hr class="custom-hr">

<!-- NNNNNNNNNNNNNNNN ADD MESSAGE SECTION -->

<!-- Start Add Comment Form -->
    <div class="control-box">
                   <div class="container">
                    <p class="control-title"><?php getTE("Add Your Comment");?> <span class="icon"><i class="far fa-comments"></i></span> </p>
                    </div>


      <div class="container">
          <?php if(isset($_SESSION['user'])){  ?>
          <div class="row">
            <div class="data-form" id="commit">
            
                <form action="<?php echo $_SERVER['PHP_SELF'].'?itemid='.$item['Item_ID'].'#commit';?>" method="POST">  
                   
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
                if($_SERVER['REQUEST_METHOD']== 'POST'){

                    $comment = tSec($_POST['comment']) ;
                    $userid  = $_SESSION['uid'] ;
                    $langid  = $_SESSION['ulang'];
                    $itemid  = $item['Item_ID'];
                    $star    = $_POST['star'] ;
                    
                      // Check if ther is Commit from this user
                      $commits = superGet('*','items_evaluations',"Item_ID = $itemid AND User_ID = $userid ");
                      if(empty($commits)){

                        if(!empty($comment)){
                            $stmt = $con->prepare("INSERT INTO 
                              items_evaluations(Item_ID, User_ID, Item_Star)
                              VALUES(:zitemid, :zuserid, :zstar) ");
                              $stmt->execute(array('zitemid'=>$itemid,
                                                   'zuserid'=>$userid,
                                                   'zstar'  =>$star
                                                    ));

                              $stmt = $con->prepare("INSERT INTO 
                              items_evaluations_ml( Evaluation_ID,Lang_ID,Item_Comment)
                              VALUES(LAST_INSERT_ID(), :zlang, :zcomment) ");
                              $stmt->execute(array( 
                                                   'zcomment'  =>$comment,
                                                   'zlang'     =>$langid 
                                                    ));
                            if($stmt){
                              
                                echo '<div class="alert alert-success"> Your Commet Added Successfuly</div>';
                            
                            }
                        }

                       }else{// if ther is old commit from this user
                        if(!empty($comment)){
                          // Get Commint ID
                          foreach ($commits as $comm) {}
                            $commitID = $comm['Evaluation_ID'];

                          $stmt = $con->prepare("UPDATE items_evaluations SET  Item_Star = ? ,Evaluation_Display = 0 WHERE Evaluation_ID = ?");
                             $stmt->execute(array( $star,$commitID ));


                            $stmt = $con->prepare("UPDATE items_evaluations_ml SET  Item_Comment = ? WHERE Evaluation_ID = ?");
                             $stmt->execute(array( $comment ,$commitID));

                              echo '<div class="alert alert-success"> '.getT('Your Comment Updated Successfully').'</div>';


                       }// if commit not empty
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
    <hr class="custom-hr">

    <!-- End Add Comment Form -->
    <!-- Start Show Comments -->
     
                <?php 
            $evaluats = getInnerItemEv("items_evaluations.Item_ID = {$item['Item_ID']} AND Evaluation_Display = 1");
     
            echo '<div class="row">';
            
            
            foreach($evaluats as $evaluat){
              ?>
              <div class="container commints">
                <div class="row">
                  <div class="col-sm-3">
                    <img class="pro-img" src="images/profiles/<?php echo $evaluat['User_Image'];?>">
                    <br>
                    <span><?php echo $evaluat['Full_Name']; ?></span>
                    <br>
                    <span><?php echo $evaluat['Evaluation_Time'];?></span>
                    
                  </div>
                  <div class="col-sm-3">
                    <span><?php grtStar($evaluat['Item_Star']) ; ?></span>
                  </div>
                  <div class="col-sm-6">
                    <br>
                    <span><?php echo $evaluat['Item_Comment']; ?></span>
                  </div>
                  
                </div>
              </div>
              <?php
             
             }
            ?>
</div>

<?php

 }else{
       echo ' <br><br> <div class="container"><div class="alert alert-danger">There is no Item in this Details, Or the items wait the Activation </div></div>' ;
        }

   echo '</div>'; // End  comments Container
   ?>

    <script src="https://apis.google.com/js/platform.js" async defer>
      {lang: 'en-GB'}
    </script>
   <?php                       

include  $tpl . "footer.php";?>