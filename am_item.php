<?php 

session_start();

$pageTitle = 'Automobil Page | A to Z for All';


include 'init.php';


    //chek if the Id is Excist and is nummer
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0; //short if 
       // Select All Data Depend on this Id

//$items = getInnerItemRE("items.Item_ID = $itemid "); 
$items = getInnerItemAM("items.Item_ID = $itemid ");



if(!empty($items)){    // If the item ID is in DB
    foreach ($items as $item) {}

      $fuelID = $item['AM_Fuel_ID'];
        $sfuels = getInnerFuelAm("am_fuel_ml.AM_Fuel_ID = $fuelID");
        foreach ($sfuels as $sfuel) {}

      $bodyID = $item['AM_Body_ID'];
        $sBodys = getInnerBodyAm("am_body_types.AM_Body_Type_ID = $bodyID");
        foreach($sBodys as $sBody){}

      $gearID = $item['AM_Gearbox_ID'];
        $sGears = getInnerGearAm("am_gearboxes.AM_Gearbox_ID = $gearID");
        foreach ($sGears as $sGear) {}

      $usingID = $item['AM_Using_ID'];
        $sUseStatus = getInnerUseAm("am_usings.AM_Using_ID = $usingID");
        foreach ($sUseStatus as $sUseStatu) {}

      $oColorID = $item['AM_Out_Color_ID'];
        $sOcolors = getInnerColorAm("am_colors.AM_Color_ID = $oColorID");
        foreach ($sOcolors as $sOcolor) {}

      $iColorID = $item['AM_In_Color_ID'];
        $sIcolors = getInnerColorAm("am_colors.AM_Color_ID = $iColorID");
        foreach ($sIcolors as $sIcolor) {}

      $dTid = $item['AM_Drive_Type_ID'];
       $sDtS = superGet('*','am_drive_type',"AM_Drive_Type_ID = $dTid");
       foreach ($sDtS as $sDtS) {}

      $salesMid = $item['AM_Sales_Method_ID'];
        $sSalesMs = getInnerSalMeAM("am_sales_methods.AM_Sales_Method_ID =$salesMid ");
        foreach ($sSalesMs as $sSalesM) {}

      $emissCid = $item['Emissions_Class_ID'];
        $eCs = superGet('*','am_emissions_class',"AM_Emission_Class_ID =$emissCid ");
        foreach ($eCs as $eC) {}

      $emissSid  =$item['Emission_Sticker_ID'];
        $sEss = getInnerEStickAM("am_emissions_sticker.AM_Emission_Sticker_ID = $emissSid");
        foreach ($sEss as $sEss) {}

      $locID = $item['Location_ID'];
      $locs = superGet('*','locations_text',"Location_ID = $locID ");
       foreach ($locs as $loc) {}
                           


    $currency = $item['Currency_Code']; // Get Currency Code 

?>

<div class="container">
  <div class="row">
    <div class="col col-md-9">
      <div class="control-box">

            <div class="container">
              <p class="control-title"><?php echo $item['Item_Name'];?>  <span class="icon"><i class="fa fa-car" aria-hidden="true"></i></span></p>
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
                                <div class="item-n"><?php getTE('Item Number');?>:<?php echo 'AM'.$itemid ; ?></div>
                            </div>

                      </div>
                      <?php 
                     }else{ // if item has no photos
                        ?>

                        <div class="col-xs-9">
                            <img class="no-img-item center" src="images/form/no_photo.jpeg">


                            <div class="container">
                             <p class="item-n">Item Number:<?php echo 'AM'.$itemid ; ?></p>
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
                        $link = "https://www.a2z4a.de/am_item.php?itemid=".$itemid;
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

                         <div class="info-line"> <label><?php getTE("Maker");?></label><span><?php echo $item['Make_Name'];?></span></div> 

                         <hr class="custom-hr">

                          <?php // If model = Other
                         if (isset($item['AM_model_Text'])){ 
                          $textModel = $item['AM_model_Text']; }else{$textModel = NULL;}
                          ?>

                         <div class="info-line"> <label><?php getTE("Model");?></label><span><?php echo $item['Model_Name'].' '.$textModel;?></span></div>

                         <hr class="custom-hr">


                         <div class="info-line"> <label><?php getTE("Fuel");?></label><span><?php echo $sfuel['AM_Fuel_Name'];?></span></div>

                         <hr class="custom-hr"> 

                         <div class="info-line"> <label><?php getTE("Production Date");?></label><span><?php echo $item['AM_Production_Date'];?></span></div> 

                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("First registering");?></label><span><?php echo $item['AM_First_Regist'];?></span></div> 

                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Body Type");?></label><span><?php echo $sBody['AM_Body_Type_Name'];?></span></div>

                         <hr class="custom-hr"> 

                         <div class="info-line"> <label><?php getTE("Gear Box");?></label><span><?php echo $sGear['AM_Gearbox_Name'];?></span></div>

                         <hr class="custom-hr"> 

                         <div class="info-line"> <label><?php getTE("Milage");?></label><span><?php echo number_format($item['AM_Mileage']);?></span></div>

                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Passengers");?></label><span><?php echo $item['AM_Passengers'];?></span></div>

                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Using Status");?></label><span><?php echo $sUseStatu['AM_Using_Name'];?></span></div>

                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Owner Order");?></label><span><?php echo $item['AM_Owner_Number'];?></span></div>

                         <hr class="custom-hr">


                         <div class="info-line"> <label><?php getTE("Price");?></label><span><?php echo number_format($item['Main_Price']) .' '.$item['Currency_Code'];?></span> </div>

                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Sales Method");?></label><span><?php echo $sSalesM['AM_Sales_Method_Name'];?></span></div>
           


                         </div>
                      </div>
                    </div>

          </div>
                                


                      
                <div class="control-box">
                   <div class="container">
                    <p class="control-title"><?php getTE("technical informations");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                     <div class="container ">
                        <div class="col-md-12 "> 



                        <div class="info-line"> <label><?php getTE("Engine Size");?></label><span><?php echo $item['Engine_Size'] ;?></span></div>

                        <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Number of valves");?></label><span><?php echo $item['Valves_Number'];?></span></div>

                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Engine Type");?></label><span><?php echo $item['Engine_Type'];?></span></div>

                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Drive Type");?></label><span><?php echo $sDtS['AM_Drive_Type_Name'];?></span></div>


                        </div>
                      </div>
                    </div>
                </div>


                <div class="control-box">
                   <div class="container">
                    <p class="control-title"><?php getTE("Environment");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                     <div class="container ">
                        <div class="col-md-12 ">


                        <div class="info-line"> <label><?php getTE("Emissions");?></label><span><?php echo $eC['AM_Emission_Class_Name'];?></span></div>

                        <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Emissions Sticker");?></label><span><?php echo $sEss['AM_Emission_Sticker_Name'];?></span></div>

                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Emissions Co2");?></label><span><?php echo $item['Emissions_Co2'];?></span></div> 


                        </div>
                      </div>
                    </div>
                </div>


                <div class="control-box">
                   <div class="container">
                    <p class="control-title"><?php getTE("Maintenance");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                     <div class="container ">
                        <div class="col-md-12 ">

                          <div class="info-line"> <label><?php getTE("Next Check");?></label><span><?php echo $item['AM_Checked_To'];?></span></div>

                          <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Timing belt Replacement");?></label><span><?php echo $item['Belt_Replacement'];?></span></div>

                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Guaranteed To");?></label><span><?php echo $item['Guaranteed_To'];?></span></div>


                        </div>
                      </div>
                    </div>
                </div>



                <div class="control-box">
                   <div class="container">
                    <p class="control-title"><?php getTE("Appearance");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                     <div class="container ">
                        <div class="col-md-12 ">

                          <?php 
                         if(isset($item['AM_Sub_Model_Text'])){
                          ?>
                          <div class="info-line"> <label><?php getTE("Sub Model");?></label><span><?php echo $item['AM_Sub_Model_Text'];?></span></div> <?php
                         }
                         ?>
                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Doors");?></label><span><?php echo $item['AM_Doors'];?></span></div>
                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Exterior Color");?></label><span><?php echo $sOcolor['AM_Color_Name'];?></span></div>
                         <hr class="custom-hr">

                         <?php // Get Mitalic Status
                           if ($item['AM_Mitalic'] == 1){
                            $mitalic = getT('yes');
                          }else{$mitalic = getT('no');}
                         ?>
                         <div class="info-line"> <label><?php getTE("Mitalic");?></label><span><?php echo $mitalic;?></span></div>
                         <hr class="custom-hr">

                         <div class="info-line"> <label><?php getTE("Interior Color");?></label><span><?php echo $sIcolor['AM_Color_Name'];?></span></div>


                        </div>
                      </div>
                    </div>
                </div>


                <div class="control-box">
                   <div class="container">
                    <p class="control-title"><?php getTE("Equipments");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                     <div class="container ">
                        <div class="am-yesno">

                          <div class="row">
                          <?php 
                          echo '<div class="col col-md-5">';

                          if($item['ESP'] != 0){$SafetyS[] = getT('ESP');}
                          if($item['ABS'] != 0){$SafetyS[] = getT('ABS');}
                          if($item['Isofix'] != 0){$SafetyS[] = getT('Isofix');}
                          if($item['Alarm_System'] != 0){$SafetyS[] = getT('Alarm System');}
                          if($item['Keyless_Entry'] != 0){$SafetyS[] = getT('Keyless Entry');}
                          if($item['Airbag_Driver'] != 0){$SafetyS[] = getT('Airbag Driver');}
                          if($item['Airbag_Passenger'] != 0){$SafetyS[] = getT('Airbag Passenger');}
                          if($item['Airbag_Side'] != 0){$SafetyS[] = getT('Airbag Side');}

                          if(!empty($SafetyS)){
                            echo '<label>'.getT('Safety').'</label>';
                            echo '<ul>';
                            foreach ($SafetyS as $Safety) {
                              echo '<li>'.$Safety.'</li>';
                            }
                            echo '</ul>';
                          }

                          echo '</div>';

                          echo '<div class="col col-md-5">';

                          if($item['AC_Front'] != 0){$ComfortS[] = getT('AC Front');}
                          if($item['AC_Rear'] != 0){$ComfortS[] = getT('AC Rear');}
                          if($item['Navigation'] != 0){$ComfortS[] = getT('Navigation');}

                          if(!empty($ComfortS)){
                            echo '<label>'.getT('Comfort').'</label>';
                            echo '<ul>';
                            foreach ($ComfortS as $Comfort) {
                              echo '<li>'.$Comfort.'</li>';
                            }
                            echo '</ul>';
                          }

                          echo '</div>';

                          echo '<div class="col col-md-5">';

                          if($item['Power_Windows'] != 0){$AdditionsS[] = getT('Power Windows');}
                          if($item['Integrated_Phone'] != 0){$AdditionsS[] = getT('Integrated Phone');}
                          if($item['Power_Steering'] != 0){$AdditionsS[] = getT('Power Steering');}
                          if($item['Rear_Window_Defroster'] != 0){$AdditionsS[] = getT('Rear Window Defroster');}
                          if($item['Rear_Window_Wiper'] != 0){$AdditionsS[] = getT('Rear Window Wiper');}
                          if($item['Tinted_Glass'] != 0){$AdditionsS[] = getT('Tinted Glass');}
                          if($item['Moonroof_Sunroof'] != 0){$AdditionsS[] = getT('Moonroof Sunroof');}
                          if($item['Alloy_Wheels'] != 0){$AdditionsS[] = getT('Alloy Wheels');}

                          if(!empty($ComfortS)){
                            echo '<label>'.getT('Additions').'</label>';
                            echo '<ul>';
                            foreach ($AdditionsS as $Additions) {
                              echo '<li>'.$Additions.'</li>';
                            }
                            echo '</ul>';
                          }

                          echo '</div>';

                          echo '<div class="col col-md-5">';


                          if($item['AM_FM_Stereo'] != 0){$EntertainmentS[] = getT('AM/FM Stereo');}
                          if($item['Cassette_Player'] != 0){$EntertainmentS[] = getT('Cassette Player');}
                          if($item['CD'] != 0){$EntertainmentS[] = 'CD Player';}
                          if($item['DVD_System'] != 0){$EntertainmentS[] = getT('DVD System');}
                          if($item['MP3_Single_Disc'] != 0){$EntertainmentS[] = getT('MP3 Disc');}
                          if($item['Premium_Sound'] != 0){$EntertainmentS[] = getT('Premium Sound');}
                       

                          if(!empty($EntertainmentS)){
                            echo '<label>'.getT('Entertainment').'</label>';
                            echo '<ul>';
                            foreach ($EntertainmentS as $Entertainment) {
                              echo '<li>'.$Entertainment.'</li>';
                            }
                            echo '</ul>';
                          }

                          echo '</div>';

                          echo '<div class="col col-md-5">';


                          if($item['LED_Front_Lights'] != 0){$LightS[] = getT('LED Front Lights');}
                          if($item['LED_Back_Lights'] != 0){$LightS[] = getT('LED Back Lights');}
                          if($item['Daylight_Auto'] != 0){$LightS[] = getT('Daylight');}
                          if($item['xenon_Headlights'] != 0){$LightS[] = getT('xenon Headlights');}
                          if($item['Fog_Lights'] != 0){$LightS[] = getT('Fog Lights');}
                       

                          if(!empty($LightS)){
                            echo '<label>'.getT('Lights').'</label>';
                            echo '<ul>';
                            foreach ($LightS as $Light) {
                              echo '<li>'.$Light.'</li>';
                            }
                            echo '</ul>';
                          }

                          echo '</div>';

                          echo '<div class="col col-md-5">';

                          if($item['Memory_Seats'] != 0){$SeatS[] = getT('Memory Seats');}
                          if($item['Bucket_Seats'] != 0){$SeatS[] = getT('Bucket Seats');}
                          if($item['Power_Seats'] != 0){$SeatS[] = getT('Power Seats');}
                          if($item['Third_Row_Seats'] != 0){$SeatS[] = getT('Third Row Seats');}
                          if($item['Leather_Interior'] != 0){$SeatS[] = getT('Leather Interior');}
                       

                          if(!empty($SeatS)){
                            echo '<label>'.getT('Seats').'</label>';
                            echo '<ul>';
                            foreach ($SeatS as $Seat) {
                              echo '<li>'.$Seat.'</li>';
                            }
                            echo '</ul>';
                          }

                          echo '</div>';
                          
                          ?>


                            </div> <!--End row -->


                        </div>
                      </div>
                    </div>
                </div>


                <div class="control-box">
                   <div class="container">
                    <p class="control-title"><?php getTE("Additional Informations");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                     <div class="container ">
                        <div class="col-md-12 ">
                            
                          <div class="info-line"> <label><?php getTE("Added from");?></label><span><?php echo $item['Inser_Time'];?></span></div>
                          <hr class="custom-hr">

                          <div class="info-line"> <label><?php getTE("Link to another site");?></label><p><?php echo $item['Item_Link1'];?></p></div>
                          <hr class="custom-hr">

                          <div class="info-line"> <label><?php getTE("Link to another site");?></label><p><?php echo $item['Item_Link2'];?></p></div>
                          <hr class="custom-hr">

                          <div class="info-line "> <label><?php getTE("Description");?></label><textarea class="col-md-12 form-control"><?php echo $item['Item_Description'];?></textarea></div>

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

        <div>
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- item page -->
          <ins class="adsbygoogle"
               style="display:block"
               data-ad-client="ca-pub-4112940950021564"
               data-ad-slot="7988270775"
               data-ad-format="auto"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
          
        </div> 

        </div>

        </div>             
        </div>
  


    <div class="control-box">
                   <div class="container">
                    <p class="control-title"><?php getTE("Location");?> <span class="icon"><i class="far fa-map"></i> </p>
                    </div>
                    <div class="row">
                      <div class="col col-md-10">

                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!!.!2d6.!3d51.!!1f0!!3f0!!!!!3m3!1m2!1s0x%!2s<?php echo $loc['Zip']?>+<?php echo $loc['Street'] .' '.$loc['City'].' '. $loc['Region'] .' '. $loc['Country']; ?>!!3m2!!!" width="99%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                      </div>
                      <div class="col col-md-2">


                        <h5 class="text-center"><?php getTE('Provider Address');?></h5>
                        <?php echo '<p class="text-center">'.$loc['Street'].' '.$loc['Haus_N'].'<br> '.$loc['Zip'] .'  '. $loc['City'].' <br> '.$loc['Region'].' '.$loc['Country'] .'<p>';?>
                      
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