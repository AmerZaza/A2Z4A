<?php 

session_start();

$pageTitle = 'Items';
  
include 'init.php';


    //chek if the Id is Excist and is nummer
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0; //short if 
       // Select All Data Depend on this Id

//$items = getInnerItemRE("items.Item_ID = $itemid "); 
$items = getInnerItemRE("items.Item_ID = $itemid ");


if(!empty($items)){    // If the item ID is in DB
    foreach ($items as $item) {}

    $currency = $item['Currency_Code']; // Get Currency Code 

?>


<div class="container">
            
    <h2 class="text-center"><?php echo $item['Item_Name'];?></h2>

                <div class="container">
                    <div class="row">

                        <?php 
                        //Chek if the Item hast photos
                        // Get All Photos
                        $images = superGet('*','items_images',"
                            items_images.Item_ID = $itemid");
                         if (!empty($images)){

                        ?>

                        <div class="col-md-2">
                            <div class="all-photo-list">
                            <?php 
                          
                             
                            echo '<div class="">';
                            foreach ($images as $image) {
                            echo  '<img class="item_image" src="images/items/'.$image['Item_Image'].'" alt=""/>';
                              }
                              echo '</div>';
                            ?>
                        </div>
                      </div>

                      <div class="col-md-7 " >
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
                                <p class="item-n">Item Number:<?php echo 'RE'.$itemid ; ?></p>
                            </div>

                      </div>
                      <?php 
                     }else{ // if item has no photos
                        ?>

                        <div class="col-md-9">
                            <img class="no-img-item center" src="images/form/no_photo.jpeg">


                            <div class="container">
                             <p class="item-n">Item Number:<?php echo 'RE'.$itemid ; ?></p>
                            </div>

                        </div>


                  
                         <?php


                      }// End else item withut photos
                      ?>

                      <div class="col-md-3">
                          
                        
                        <div class="data-form">
                            <p class="title"><?php  getTE("Address");?></p>
                            <?php 
                            $locID = $item['Location_ID'];
                            $locs = superGet('*','locations_text',"Location_ID = $locID ");
                            foreach ($locs as $loc) {}
                            ?>
                            <span> <?php echo $loc['Street']; ?></span><br>
                            <span> <?php echo $loc['Zip']; ?></span> 
                            <span> <?php echo $loc['City']; ?></span>
                            <span> <?php echo $loc['Region']; ?></span>
                             <br>
                            <span> <?php echo $loc['Country']; ?></span>

                        </div>

                    <div class="data-form">
                     <p class="title"><?php getTE("Item Evaluation");?></p>

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

                    <div class="data-form sharing">
                        <p class="title"><?php getTE("sharing");?></p>


                        <?php $link = $_SERVER['PHP_SELF'].'?itemid='.$itemid;?>
                    <div class="container">
                      <div class="row">

                      <div class="col col-sm-4">
                          <!--  FACEBOOK  Shering --> 
                          

                          <div id="fb-root"></div>
                          <script>(function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11';
                            fjs.parentNode.insertBefore(js, fjs);
                          }(document, 'script', 'facebook-jssdk'));</script>

                          <div class="facebook">
                          <div class="fb-share-button" data-href="https://amertzaza.000webhostapp.com/re_item.php?itemid=228" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Famertzaza.000webhostapp.com%2Fre_item.php%3Fitemid%3D<?php echo $item['Item_ID']; ?>&amp;src=sdkpreparse">Share</a></div>
                          </div>
                               
                    </div>
                        
                    <div class="col col-sm-4">
                      <div class="post">
                        
                        <a href="mailto:name@mail.com?subject=My%20Advice&amp;body=This%20is%20a%20Link%20: https:/<?php echo $link;?>"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                        </div>
                     </div>

                     <div class="col col-sm-4">
                      <!--  GOOGLE Shering -->  

                  <script src="https://apis.google.com/js/platform.js" async defer>
                    {lang: 'en-GB'}
                  </script>


                  <div class="google">
                  <div class="g-plus" data-action="share" data-href="https://amertzaza.000webhostapp.com/re_item.php?itemid=<?php echo $item['Item_ID']; ?>"></div>
                  </div>


                  </div>

                       </div>

                      </div>


                    </div>

                </div>
            </div>
                        
        </div>

        

                <div class="re-describ">
                     <p><?php echo $item['Item_Description']; ?></p>
                </div>
               

                <div class="item_samary">
                	<span> <?php echo getT('For') .' '. $item['Praxis_Name']; ?> </span> <br>
                    <span> <?php  getTE("Total Cost");?>:<?php echo $item['Main_Price']+$item['RE_Water_Cost']+$item['RE_Electric_Cost']+$item['RE_Side_Costs1']+$item['RE_Additional_Costs']+$item['RE_Additional_Costs2'] .' '. $currency; ?></span>
                    <span><?php  getTE("Rooms");?>:<?php echo $item['RE_Room']; ?></span>
                    <span><?php  getTE("Area");?> :<?php echo $item['RE_Area']; ?></span>
                </div>

                

               

    <div class="container">
        <div class="row"> 

        <div class="col-md-7 ">
            <div class="data-form">
            <p class="title"><?php  getTE("Main Informations");?></p>
            <ul class="list-unstyled item_v_list">
                <li><span><?php  getTE("Categorey");?> :</span><a href="re_items.php?pageid=<?php echo $item['Category_ID'];?>"><?php echo $item['Category_Name']; ?></a></li>
                <hr class="custom-hr">
                <li><span><?php  getTE("Type");?>:</span> <?php echo $item['Praxis_Name']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Insert Date");?>: </span><?php echo $item['Inser_Time']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Area");?>: </span><?php echo $item['RE_Area']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Rooms");?>: </span><?php echo $item['RE_Room']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Path");?>: </span><?php echo $item['RE_Bath']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Type");?>: </span><?php echo $item['RE_Type_ID']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Kitchen");?>: </span><?php echo $item['RE_Kitchen']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Heating System");?>: </span><?php echo $item['RE_Heating']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Floor");?>: </span><?php echo $item['RE_Floor']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Furnisched");?>: </span><?php 
                    if ($item['RE_Furnished'] == 1){echo 'Yes';}else{ echo 'No';}
                 ?></li>

            </ul>
            </div>
            <div class="data-form">
            <p class="title" =""><?php  getTE("Costs per");?>/ <?php echo $currency ?></p>
            <ul class="list-unstyled item_v_list">
                <li><span> <?php  getTE("Main Cost");?>: </span><?php echo $item['Main_Price']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Haus Costs");?>: </span><?php echo $item['RE_Side_Costs1']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Water Cost");?>: </span><?php echo $item['RE_Water_Cost']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Electricity Cost");?>: </span><?php echo $item['RE_Electric_Cost']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Additional Costs");?> 1: </span><?php echo $item['RE_Additional_Costs']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Additional Costs");?> 2: </span><?php echo $item['RE_Additional_Costs2']; ?></li>
            </ul>
            </div>
            <div class="data-form">
            <ul class="list-unstyled item_v_list">
                <li><span> <?php  getTE("Available From");?>: </span><?php echo $item['RE_Available_From']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Available To");?>: </span><?php echo $item['RE_Available_To']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Bilding Date");?>: </span><?php echo $item['RE_Creation']; ?></li>
                <hr class="custom-hr">
                <li><span> <?php  getTE("Renewal Date");?>: </span><?php echo $item['RE_Renewal']; ?></li>
               
                
                <!-- li><span> Made in:</span> <?php //echo  $item['Made_IN']; ?></li -->
            </ul>
        </div>
        <?php 
        if (!empty($item['RE_Description'])){

        ?>
        <div class="data-form">
            <p class="title"> <?php  getTE("More Informations");?></p><?php echo $item['RE_Description']; ?>
        </div>
        <?php  } ?>

        
            
                    <?php
                    
                    if (! empty($item['Item_Tags'])){  
                    echo '<div class="data-form">'; 
                    echo '<p class="title">Tags</p>';
                    $allTags = explode("," , $item['Item_Tags']);

                        foreach ($allTags as $allTag){
                            echo '<span class=tags> ';

                          //  $allTag = str_replace(' ','',$allTag);

                            echo '<a href="tags.php?name='.$allTag.'" target="_blank">'.$allTag. '</a>';
                            echo '</span>';
                        }
                        echo '</div>';
                    }
                    
                    ?>
            
        </div>

        <div class="col-md-5 ">

            <div class="data-form">
              <p class="title"> <?php getTE("Provider");?></p>
            

                <?php // Get Providers Details
                $proID = $item['User_ID'];
                $pros = getInnerProvider("providers.User_ID = $proID");
                foreach ($pros as $pro) {}

                ?>
                <p><?php getTE("Provider");?> : <a href="pro_profile.php?proid=<?php echo $pro['Provider_ID'];?>"><?php echo $pro['Provider_Name'];?></a></p>
                <p><?php  getTE("Contact Person");?>: <?php echo $pro['Contact_Person'];?> </p>
            
            
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

             <div>
             <a class="btn btn-primary" href="send_message.php?itemid=<?php echo $item['Item_ID'].'&resiverid='.$item['User_ID'] ?>" target="popup"> <?php  getTE("Send Message for Provider");?></a>
            </div>
            
        </div>             
        </div>
        </div>             
        </div>
  

    <div class="data-form google-map">
        <p class="title"><?php  getTE("Location");?></p>
 


<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!!.!2d6.!3d51.!!1f0!!3f0!!!!!3m3!1m2!1s0x%!2s<?php echo $loc['Zip']?>+<?php echo $loc['City'] ?>!!3m2!!!" width="99%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
  
 </div>


    <hr class="custom-hr">

<!-- NNNNNNNNNNNNNNNN ADD MESSAGE SECTION -->


    <hr class="custom-hr">

    <!-- Start Add Comment Form -->
    <div class="container">
    <?php if(isset($_SESSION['user'])){  ?>
    <div class="row">
        <div class="col-md-offset-1 col-md-8">
            <div class="add-comment">
            <div class="data-form">
            <p class="title"><?php  getTE("Add Your Comment");?></p>
            
                <form action="<?php echo $_SERVER['PHP_SELF'].'?itemid='.$item['Item_ID'];?>" method="POST">  
                   
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
                    <input class="btn btn-primary" type="submit" value="<?php  getTE("Add Comment");?>">
                </form>
                <?php 
                    if($_SERVER['REQUEST_METHOD']== 'POST'){
                        $comment = tSec($_POST['comment']) ;
                        $userid  = $_SESSION['uid'] ;
                        $langid  = $_SESSION['ulang'];/////&&&&&&&&&&&&&&&&&
                        $itemid  = $item['Item_ID'];
                        $star    = $_POST['star'] ;
                        
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
                            
                    }
                    ?>
            
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php }else{
         echo ' Pleas <a href="login.php">SigIn</a> To Add Comments' ;
         echo '</div>';
     }  ?>
     <hr class="custom-hr">
    <!-- End Add Comment Form -->
    <!-- Start Show Comments -->
     
                <?php 
            $evaluats = getInnerItemEv("items_evaluations.Item_ID = {$item['Item_ID']} AND Evaluation_Display = 1");
     
            echo '<div class="row">';
            
            
            foreach($evaluats as $evaluat){
                echo '<div class="col-md-3">';
                echo  '<img src="images/profiles/'. $evaluat['User_Image'].'" class="pro-img">';
                echo '</div>';
                echo '<div class="col-md-9">';
                echo  getT('Stars').':'; grtStar($evaluat['Item_Star']) ; echo '<br>';
                echo  getT('Comment').':' .$evaluat['Item_Comment'] . '<br>';
                echo  getT('Insert Date').':'.$evaluat['Evaluation_Time'] . '<br>';
                echo  getT('User Name').':'.$evaluat['Full_Name'] . '<br>';
                echo "<hr>";
                echo '</div>' ;
             }
            ?>
     
   
</div>


<?php

 }else{
            echo ' <br><br> <div class="container"><div class="alert alert-danger">'.getT('There is no Item in this Details, Or the items wait the Activation').' </div></div>' ;
        }



   echo '</div>'; // End  comments Container
include  $tpl . "footer.php";?>