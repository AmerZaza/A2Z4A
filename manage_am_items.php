<?php 
ob_start();

session_start();

$pageTitle = 'Manage Automobile Items';

include 'init.php';

$pageTitle = 'Manage Items';

if(isset($_SESSION['uid']) || isset($_SESSION['adminID']) ){

  $do = isset($_GET['do']) ? $_GET['do'] : 'preview';

  if($do == 'preview'){  // preview page 

      if(!empty($_GET['itemid'])){
        $itemid = $_GET['itemid'];
        } else{
            $ID  =$con->prepare ("SELECT max(Item_ID) FROM items WHERE User_ID = $user");
            $ID->execute();
            $ids = $ID->fetchAll();
            foreach ($ids as $id) {   }
            $itemid = $id['max(Item_ID)']; // I must to test it online
        }

    //check if there are records for this user
    if($itemid == NULL){
        $message = getT('There are no Item in this details');
        redirectHome($message,'index.php', 2);
    }

      if(isset($_SESSION['uid'])) {
        $userid = $_SESSION['uid'];
        $items = getInnerItemAM("items.Item_ID = $itemid AND users.User_ID = $userid");
      }elseif(isset($_SESSION['adminID'])){
        $items = getInnerItemAM("items.Item_ID = $itemid ");
      }

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
              <p class="control-title"><?php echo $item['Item_Name'];?> <span class="top"></span> <span class="icon"><i class="fa fa-car" aria-hidden="true"></i></span></p>
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
                                echo getT('This ADS has no Photos');
                            }
                          echo '</div>'; 
 
                          ?>

                          </div>



                          <div class="container">
                                <p class="item-n"><?php echo getT('Item Number') .': AM'.$itemid ; ?></p>
                            </div>

                      </div>
                      <?php 
                     }else{ // if item has no photos
                        ?>

                        <div class="col-xs-9">
                            <img class="no-img-item center" src="images/form/no_photo.jpeg">


                            <div class="container">
                             <p class="item-n"><?php echo getT('Item Number').': AM'.$itemid ; ?></p>
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
      <div class="text-center">
      <a class="btn btn-default" href="manage_am_items.php?do=m_photos&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Manage Photos');?></a>
      </div>
      
    </div>

    <div class="col-md-3">

    
  </div> <!-- End Row-->

         

  <div class="container">
      <div class="row">


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

                         <div class="info-line"> <label><?php getTE("Model");?></label><span><?php if($item['Model_ID'] != 0){echo $item['Model_Name'];}else{echo $item['AM_model_Text'];} ?></span></div> 

                          
                         <div class="info-line"> <label><?php getTE("Fuel");?></label><span><?php if($item['AM_Fuel_ID'] != 0){echo $sfuel['AM_Fuel_Name'];}else{echo $item['AM_Fuel_Text'];} ?></span></div> 


                         <div class="info-line"> <label><?php getTE("Production Date");?></label><span><?php echo $item['AM_Production_Date'];?></span></div> 

                         <div class="info-line"> <label><?php getTE("First registering");?></label><span><?php echo $item['AM_First_Regist'];?></span></div> 

                         <div class="info-line"> <label><?php getTE("Body Type");?></label><span><?php echo $sBody['AM_Body_Type_Name'];?></span></div> 

                         <div class="info-line"> <label><?php getTE("Gear Box");?></label><span><?php echo $sGear['AM_Gearbox_Name'];?></span></div> 

                         <div class="info-line"> <label><?php getTE("Passengers");?></label><span><?php echo $item['AM_Mileage'];?></span></div>

                         <div class="info-line"> <label><?php getTE("Using Status");?></label><span><?php echo $sUseStatu['AM_Using_Name'];?></span></div>

                         <div class="info-line"> <label><?php getTE("Owner Order");?></label><span><?php echo $item['AM_Owner_Number'];?></span></div>


                         <div class="info-line"> <label><?php getTE("Price");?></label><span><?php echo $item['Main_Price'].' '.$item['Currency_Code'];?></span></div>

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



                        <div class="info-line"> <label><?php getTE("Engine Size");?></label><span><?php echo $item['Engine_Size'];?></span></div>

                         <div class="info-line"> <label><?php getTE("Number of valves");?></label><span><?php echo $item['Valves_Number'];?></span></div>

                         <div class="info-line"> <label><?php getTE("Engine Type");?></label><span><?php echo $item['Engine_Type'];?></span></div>

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

                         <div class="info-line"> <label><?php getTE("Emissions Sticker");?></label><span><?php echo $sEss['AM_Emission_Sticker_Name'];?></span></div>

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

                         <div class="info-line"> <label><?php getTE("Timing belt Replacement");?></label><span><?php echo $item['Belt_Replacement'];?></span></div>

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

                         <div class="info-line"> <label><?php getTE("Doors");?></label><span><?php echo $item['AM_Doors'];?></span></div>

                         <div class="info-line"> <label><?php getTE("Exterior Color");?></label><span><?php echo $sOcolor['AM_Color_Name'];?></span></div>

                         <div class="info-line"> <label><?php getTE("Mitalic");?></label><span>
                          <?php if($item['AM_Mitalic'] == 1){getTE('yes');}else{getTE('no');}?>
                            
                          </span>
                         </div>

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

                          if(!empty($AdditionsS)){
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
                       

                          if(!empty($LightS)){
                            echo '<label>'.getT('Seats').'</label>';
                            echo '<ul>';
                            foreach ($LightS as $Light) {
                              echo '<li>'.$Light.'</li>';
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

                          <div class="info-line"> <label><?php getTE("Link to another site");?></label><p><?php echo $item['Item_Link1'];?></p></div>

                          <div class="info-line"> <label><?php getTE("Link to another site");?></label><p><?php echo $item['Item_Link2'];?></p></div>

                          <div class="info-line "> <label><?php getTE("Description");?></label><textarea class="col-md-12" readonly><?php echo $item['Item_Description'];?></textarea></div>

                        </div>
                      </div>
                    </div>
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
                        <h4 class="text-center"><?php getTE('Provider Address');?></h4>
                        
                        <?php echo '<p class="text-center"><br>'.$loc['Street'].' '.$loc['Haus_N'].'<br> '.$loc['Zip'] .'  '. $loc['City'].' <br> '.$loc['Region'].' '.$loc['Country'] .'<p>';?>

                      </div>
                   </div>
                </div>

             </div>
           </div>
        </div>
      </div>


            <div class="form-group text-center">
                <a class="btn btn-success" href="manage_am_items.php?do=edit&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Edit Item');?></a>
                <a class="btn btn-success" href="manage_am_items.php?do=m_photos&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Manage Photos');?></a>
                
                <?php 
                if ($item['Item_Display'] == 0){
                  ?>
                  <a class="btn btn-warning" href="manage_am_items.php?do=visible&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Visible'); ?></a>
                  <?php
                }else{  
                  ?>
                  <a class="btn btn-default" href="manage_am_items.php?do=invisible&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Invisible'); ?></a>
                  <?php
                }
                ?> 
                <a class="btn btn-danger" href="manage_am_items.php?do=delete&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Delete Item'); ?></a>

                <a class="btn btn-primary" href="manage_am_items.php?do=new&catid=<?php echo $item['Category_ID'];?>"><?php getTE('New Item');?></a>
                <br>
            </div>
     
    <?php 
    } // End if item id isset

    }elseif($do == 'edit'){

        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
        $user = $_SESSION['uid'];


      if(isset($_SESSION['uid'])) {
        $userid = $_SESSION['uid'];
        $items = getInnerItemAM("items.Item_ID = $itemid AND users.User_ID = $userid");
      }elseif(isset($_SESSION['adminID'])){
        $items = getInnerItemAM("items.Item_ID = $itemid ");
      }

        if(!empty($items)){    // If the item ID is in DB
            foreach ($items as $item) {}
       
    ?>

<h1 class="text-center"><?php echo getT("Edit Item") .' '.$item['Item_Name'] ;?></h1>

<div class="container">
    <div class="row">
         
        
        <div class="item-info">

                 <div class="">
                   

                    <form action="<?php echo $_SERVER['PHP_SELF'].'?do=update&itemid='.$item['Item_ID'];?>" method="POST">


                        <input type="hidden" name="cat-id" value="<?php echo $catID; ?>">
                           
                        <div class="form-group container">
                            <label class="col-sm-2 control-lable"><?php //getTE("Select Praxis"); ?></label>
                            <div class="col-sm-10 col-md-4">

                              <!--
                                <select class="form-control" name="praxis">
                                <?php 
                                //Get Category name and id
                                //$praxess = superGet("*",'praxis_ml');
                                $praxess = getInnerPraxis();
                                foreach ($praxess as $praxes) {
                                    echo '<option value ="'.$praxes['Praxis_ID'].'">' .$praxes['Praxis_Name'] .'</option>';
                                }
                                ?>
                                
                            </select>
                          -->
                          <input type="hidden" name="praxis" value="1">

                            </div>
                        </div>

                <div class="control-box">

                    <div class="container">
                    <p class="control-title"><?php getTE("Main Informations");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                    <div class="container ">
                        <div class="col-md-5 ">
                            <div class="form-group ">
                            <label class=" col-md-12 control-lable"><?php getTE("Maker");?></label>
                            <div class=" col-md-12">
                                <select class="form-control " id="maker-list" name="maker" onChange="getModel(value) " onChange="getMakerText(value)" required="required" >
                                <?php 
                                // get Current Mark
                                $makerId = $item['Maker_ID'];
                                $maks = superGet('*','makes',"id = $makerId");
                                foreach ($maks as $mak) {
                                echo  '<option value ="'.$mak['id'].'">' .$mak['Make_Name'] .'</option>';
                                }

                                // get other maker
                                $makers = superGet('*','makes',"id != 0");
                                foreach ($makers as $maker) {
                                    echo '<option value ="'.$maker['id'].'">' .$maker['Make_Name'] .'</option>';
                                }
                               // echo '<option value ="0"> <?php getTE("Other Maker");?> </option>';
                                ?>
                            </select>
                          
                            </div>
                        </div>
                    </div>
            
 
                
                <div class="col-md-5">
                        <div class="form-group container " id="maker-text">
                         
                         </div>
                    </div>

                </div>

                <div class="container">
                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Models");?></label>
                            <div class=" col-md-12">
                                <select class="form-control"  name="model" id="mod-list" onChange="getModelText(value)"  required="required" >
                                    
                                    <option value="<?php echo $item['Model_ID'];?>"><?php echo $item['Model_Name'];?> </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container " id="model-text">
                            <!-- Model Text -->
                         
                         </div>
                    </div>
                </div>

                <div class="container">
                  <div class="col-md-5">
                      <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Sub Model");?></label>
                            <div class=" col-md-12">
                              <input class="form-control " type="text"   name="sub-model" value="<?php echo $item['AM_Sub_Model_Text'];?>">
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="container">
                      <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Fuel");?></label>
                            <div class=" col-md-12">
                                <select class="form-control" id="fuel-list"  name="fuel" onChange="getFuelText(value)" required="required" >
                               
                                <?php 
                                $fuelID = $item['AM_Fuel_ID'];
                                $sfuels = getInnerFuelAm("am_fuel_ml.AM_Fuel_ID = $fuelID");
                                foreach ($sfuels as $sfuel) { 
                                    echo '<option value = "'.$sfuel['AM_Fuel_ID'].'">'.$sfuel['AM_Fuel_Name'].'</option>';
                                  }

                                $fuels = getInnerFuelAm();

                                foreach ($fuels as $fuel) {
                                    echo '<option value ="'.$fuel['AM_Fuel_ID'].'">' .$fuel['AM_Fuel_Name'] .'</option>';
                                }
                                ?>
                                <option value ="0">  <?php getTE("Other"); ?></option>';
                            </select>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-5">
                        <div class="form-group container " id="fuel-text">
                        <!-- Fuel Text -->
                        </div>
                            
                    </div>

            </div>


                <div class="container">
                    <div class="col-md-5">
                        <div class="form-group container">
                                 <label class="col-md-12 control-lable"><?php getTE("Production Date");?></label>
                            <div class=" col-md-12">
                                <select class="form-control" id="prod-year" name="prod-date"  required="required" >
                                    <option><?php echo $item['AM_Production_Date'];?></option>
                                    <?php 
                                    for ($i=2019 ; $i>=1950 ; $i--){
                                        echo '<option value ="'.$i.'" >'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("First registering");?></label>
                            <div class=" col-md-12">
                                <input class="form-control" id="first-regist"  type="month"  name="f-regist"  value="<?php echo $item['AM_First_Regist']; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                     <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Body Type");?></label>
                            <div class="col-md-12">
                                <select class="form-control" id="body-list"  name="body-t" required="required" >
                                 
                                <?php 
                                $bodyID = $item['AM_Body_ID'];
                                $sBodys = getInnerBodyAm("am_body_types.AM_Body_Type_ID = $bodyID");
                                foreach($sBodys as $sBody){}
                                echo '<option value ="'.$sBody['AM_Body_Type_ID'].'">' .$sBody['AM_Body_Type_Name'] .'</option>';
                                
                                $bodys = getInnerBodyAm();
                                foreach ($bodys as $body) {
                                    echo '<option value ="'.$body['AM_Body_Type_ID'].'">' .$body['AM_Body_Type_Name'] .'</option>';
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Gear Box");?></label>
                            <div class="col-md-12">
                                <select class="form-control" id="gear-list"  name="gear-box" required="required" >
                                <?php 
                                $gearID = $item['AM_Gearbox_ID'];
                                $sGears = getInnerGearAm("am_gearboxes.AM_Gearbox_ID = $gearID");
                                foreach ($sGears as $sGear) {}
                                  echo '<option value ="'.$sGear['AM_Gearbox_ID'].'">' .$sGear['AM_Gearbox_Name'] .'</option>';
                                
                                $Gears = getInnerGearAm();
                                foreach ($Gears as $Gear) {
                                    echo '<option value ="'.$Gear['AM_Gearbox_ID'].'">' .$Gear['AM_Gearbox_Name'] .'</option>';
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                    </div>

                </div>

                    
                <div class="container">
                    <div class="col-md-5">
                        <div class="form-group container">
                          <label class="col-md-12 control-lable"><?php getTE("Passengers");?></label>
                            <div class="col-md-12">
                                <input class="form-control " type="number" id="passengers"   name="sits-n"   min="1" max="40" value="<?php echo $item['AM_Passengers'];?>">
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="form-group container">
                                 <label class="col-md-12 control-lable"><?php getTE("Milage");?></label>
                            <div class=" col-md-12">
                                <input class="form-control" id="milage" type="number" min="0" name="milage"  required="required"  min="0" value="<?php echo $item['AM_Mileage'];?>">
                            </div>
                        </div>
                    </div>
                </div>

                </div>

            </div>

           
            <div class="control-box control-box-toggle-X">
                <div class="container">
                        <p class="control-title"><?php getTE("Status");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">

                   <div class=" container">
                        <div class="col-md-5">
                            <label class="col-md-12 "><?php getTE("Using Status");?></label>
                            <div class="col-md-12">
                                <select class="form-control" name="use-status" required="required" ">
                                <?php 
                                $usingID = $item['AM_Using_ID'];
                                $sUseStatus = getInnerUseAm("am_usings.AM_Using_ID = $usingID");
                                foreach ($sUseStatus as $sUseStatu) {}
                                    echo '<option value ="'.$sUseStatu['AM_Using_ID'].'">' .$sUseStatu['AM_Using_Name'] .'</option>';
                                
                                $UseStatus = getInnerUseAm();
                                foreach ($UseStatus as $us) {
                                    echo '<option value ="'.$us['AM_Using_ID'].'">' .$us['AM_Using_Name'] .'</option>';
                                }
                                ?>
                            </select>
                            </div>
                          </div>
                        

                        
                        <div class="col-md-5">
                        <div class="form-group container">
                                 <label class="col-md-12 control-lable"><?php getTE("Owner Order");?></label>
                            <div class="col-md-12">
                                <input class="form-control " type="number" min="0" name="owner-order"  value="<?php echo $item['AM_Owner_Number'];?>">
                            </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </div> 

              <div class="control-box control-box-toggle-X">

                <div class="container">
                    <p class="control-title"><?php getTE("Appearance");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                <div class="packet"> 
                  <div class="container">
                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Doors");?></label>
                            <div class="col-md-12">
                                
                              <select class="form-control" name="doors-n">
                                <option value="<?php echo $item['AM_Doors']; ?>"><?php echo $item['AM_Doors']; ?></option>
                                  <option value="2/3">2/3</option>
                                  <option value="4/5">4/5</option>
                                  <option value="6/7">6/7</option>
                                </select>
                            </div>
                        </div>
                    </div>
                  </div>

                <div class="container">
                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Exterior Color");?>
                                </label>
                            <div class="col-md-12">
                                <select class="form-control" name="out-color">
                                    </option>
                                <?php 
                                $oColorID = $item['AM_Out_Color_ID'];
                                $sOcolors = getInnerColorAm("am_colors.AM_Color_ID = $oColorID");
                                foreach ($sOcolors as $sOcolor) {}
                                echo '<option value ="'.$sOcolor['AM_Color_ID'].'">' .$sOcolor['AM_Color_Name'] .'</option>';
                                
                                $oColors = getInnerColorAm();
                                foreach ($oColors as $oColor) {
                                    echo '<option value ="'.$oColor['AM_Color_ID'].'">' .$oColor['AM_Color_Name'] .'</option>';
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-4 control-lable" ><?php getTE("Mitalic");?></label>
                            <div class="col-md-2">
                                <?php 
                                if ($item['AM_Mitalic'] == 0){
                                    echo '<input class="" type="checkbox" name="mitalic"  value="YES" >';
                                }else{
                                    echo '<input class="" type="checkbox" name="mitalic"  value="YES" checked = "true">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                
                </div>


                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Interior Color");?>
                            </label>
                            <div class="col-md-12">
                                <select class="form-control" name="in-color">
                                   
                                <?php 
                                $iColorID = $item['AM_In_Color_ID'];
                                $sIcolors = getInnerColorAm("am_colors.AM_Color_ID = $iColorID");
                                foreach ($sIcolors as $sIcolor) {}
                                echo '<option value ="'.$sIcolor['AM_Color_ID'].'">' .$sIcolor['AM_Color_Name'] .'</option>';
                                
                                $iColors = getInnerColorAm("am_colors.AM_Color_ID != 0");
                                foreach ($iColors as $iColor) {
                                    echo '<option value ="'.$iColor['AM_Color_ID'].'">' .$iColor['AM_Color_Name'] .'</option>';
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                    </div>

                </div>

                
            </div>


            <div class="control-box control-box-toggle-X">

                <div class="container">
                    <p class="control-title"><?php getTE("Technical Informations");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>
                
                <div class="packet">

                    <div class="container">

                        <div class="col-md-5">

                                <div class="form-group container">
                                    <label class="col-md-12 control-lable"><?php getTE("Engine Size");?></label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text"  name="eng-size" value="<?php echo $item['Engine_Size']; ?>">
                                        </div>
                                </div>
                        </div>

                        <div class="col-md-5">

                                <div class="form-group container">
                                    <label class="col-md-12 control-lable"><?php getTE("Number of valves");?></label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" name="eng-valv" value="<?php echo $item['Valves_Number']; ?>">
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="container">

                            <div class="col-md-5">

                                <div class="form-group container">
                                    <label class="col-md-12 control-lable"><?php getTE("Engine Type");?></label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" name="eng-type" value="<?php echo $item['Engine_Type']; ?>">
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-5">
                                    <div class="form-group container">
                                <label class="col-md-12 control-lable"><?php getTE("Drive Type");?>
                                </label>
                                <div class="col-md-12">
                                    <select class="form-control" name="drive-type">
                                        
                                    <?php 
                                    $dTid = $item['AM_Drive_Type_ID'];
                                    $sDtS = superGet('*','am_drive_type',"AM_Drive_Type_ID = $dTid");
                                    foreach ($sDtS as $sDt) { }
                                       echo '<option value = "'.$sDt['AM_Drive_Type_ID'].'">'.$sDt['AM_Drive_Type_Name'].'</option>';
                                    
                                   
                                    $dTypes = superGet('*','am_drive_type',"AM_Drive_Type_ID != 0");
                                    foreach ($dTypes as $dType) {
                                        echo '<option value = "'.$dType['AM_Drive_Type_ID'].'">'.$dType['AM_Drive_Type_Name'].'</option>';
                                    }
                                    ?>
                                </select>
                                </div>
                            </div>
                                
                            </div>
                        </div>

                    </div>
                </div>

 


         

            <div class="control-box control-box-toggle-X">

                <div class="container">
                    <p class="control-title"><?php getTE("Equipments");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>
                
                
                <div class="packet">


                    <div class="container">
                        <div class="col-md-5">
                            <label><?php getTE('Safety');?></label>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <?php 
                                if ($item['ESP'] == 0){
                                    echo '<input class="" type="checkbox" name="ESP"  value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="ESP"  value="YES" checked="true">';
                                }
                                ?>
                                
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("ESP");?></label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <?php 
                                if ($item['ABS'] == 0){
                                    echo '<input class="" type="checkbox" name="ABS"  value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="ABS"  value="YES" checked="true">'; 
                                }
                                ?>
                                
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("ABS");?></label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <?php 
                                if ($item['Isofix'] == 0){
                                    echo '<input class="" type="checkbox" name="isofix"  value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="isofix"  value="YES" checked="true">';
                                }
                                ?>
                                
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Isofix");?></label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <?php 
                                if ($item['Alarm_System'] == 0){
                                    echo '<input class="" type="checkbox" name="alarmsys" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="alarmsys" value="YES" checked="true">'; 
                                }
                                ?>
                                
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Alarm System");?></label>
                        </div>

                        <div class="form-group container"> 
                        <div class="col-md-1">
                            <?php 
                                if ($item['Keyless_Entry'] == 0){
                                    echo '<input class="" type="checkbox" name="keyless" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="keyless" value="YES" checked="true">';
                                }
                                ?>
                            
                        </div>
                        <label class="col-md-8 control-lable" ><?php getTE("Keyless Entry");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <?php 
                                if ($item['Airbag_Driver'] == 0){
                                    echo '<input class="" type="checkbox" name="ab-driver" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="ab-driver" value="YES" checked="true">';
                                }
                                ?>
                                
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Airbag Driver");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <?php 
                                if ($item['Airbag_Passenger'] == 0){
                                    echo '<input class="" type="checkbox" name="ab-pass" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="ab-pass" value="YES" checked="true">';
                                }
                                ?>
                            
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Airbag Passenger");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <?php 
                                if ($item['Airbag_Side'] == 0){
                                    echo '<input class="" type="checkbox" name="ab-side" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="ab-side" value="YES" checked="true">'; 
                                }
                                ?>
                                
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Airbag Side");?> </label>
                        </div>


                        </div>
                    
                        <div class="col-md-5">
                            <label><?php getTE('Comfort'); ?></label>

                            <div class="form-group container">
                            
                        <div class="col-md-1">
                            <?php 
                                if ($item['AC_Front'] == 0){
                                    echo '<input class="" type="checkbox" name="ac-front" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="ac-front" value="YES" checked="true">'; 
                                }
                                ?>
                            
                        </div>
                        <label class="col-md-8 control-lable" ><?php getTE("AC Front");?></label>
                        </div>

                        <div class="form-group container">
                            
                        <div class="col-md-1">
                            <?php 
                                if ($item['AC_Rear'] == 0){
                                    echo '<input class="" type="checkbox" name="ac-rear" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="ac-rear" value="YES" checked ="true">'; 
                                }
                                ?>
                            
                        </div>
                        <label class="col-md-8 control-lable" ><?php getTE("AC Rear");?></label>
                        </div>

                        <div class="form-group container">
                            
                        <div class="col-md-1">
                            <?php 
                                if ($item['Navigation'] == 0){
                                    echo '<input class="" type="checkbox" name="navigat" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="navigat" value="YES" checked="true">'; 
                                }
                                ?>
                        </div>
                        <label class="col-md-8 control-lable" ><?php getTE("Navigation");?></label>
                        </div>
                            


                        </div>

                        <div class="col-md-5">
                            <label><?php getTE('Entertainment'); ?></label>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['AM_FM_Stereo'] == 0){
                                    echo '<input class="" type="checkbox" name="am-fm" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="am-fm" value="YES" checked="true">';
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("AM/FM Stereo");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Cassette_Player'] == 0){
                                    echo '<input class="" type="checkbox" name="casset" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="casset" value="YES" checked="true">'; 
                                }
                                ?>
                                
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Cassette Player");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['CD'] == 0){
                                    echo '<input class="" type="checkbox" name="cd" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="cd" value="YES" checked = "true">'; 
                                }
                                ?>
                                
                                 </div>
                                <label class="col-md-8 control-lable" ><?php getTE("CD");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['MP3_Single_Disc'] == 0){
                                    echo '<input class="" type="checkbox" name="mp" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="mp" value="YES" checked="true">'; 
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("MP3 Disc");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['DVD_System'] == 0){
                                    echo '<input class="" type="checkbox" name="dvd-sys" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="dvd-sys" value="YES" checked="true">';
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("DVD System");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Premium_Sound'] == 0){
                                    echo '<input class="" type="checkbox" name="p-sound" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="p-sound" value="YES" checked = "true">';
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable"><?php getTE("Premium Sound");?> </label>
                            </div>


                            
                        </div>

                        <div class="col-md-5">
                            <label><?php getTE('Additions');?></label>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Power_Windows'] == 0){
                                    echo '<input class="" type="checkbox" name="power-wind" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="power-wind" value="YES" checked="true">'; 
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Power Windows");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Integrated_Phone'] == 0){
                                    echo '<input class="" type="checkbox" name="int-phone" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="int-phone" value="YES" checked="troue">'; 
                                }
                                ?>
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Integrated Phone");?> </label>
                            </div>

                            <div class="form-group container"> 
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Power_Steering'] == 0){
                                    echo '<input class="" type="checkbox" name="power-steer" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="power-steer" value="YES" checked="true">';
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Power Steering");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Rear_Window_Defroster'] == 0){
                                    echo '<input class="" type="checkbox" name="rear-w-d" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="rear-w-d" value="YES" checked="true">'; 
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Rear Window Defroster");?> </label>
                             </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Rear_Window_Wiper'] == 0){
                                    echo '<input class="" type="checkbox" name="rear-w-w" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="rear-w-w" value="YES" checked="true">'; 
                                }
                                ?>
                                
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Rear Window Wiper");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Tinted_Glass'] == 0){
                                    echo '<input class="" type="checkbox" name="tinted-glass" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="tinted-glass" value="YES" checked="true">'; 
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Tinted Glass");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Moonroof_Sunroof'] == 0){
                                    echo '<input class="" type="checkbox" name="moon-r" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="moon-r" value="YES" checked ="true">';
                                }
                                ?>
                                
                                 </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Moonroof Sunroof");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Alloy_Wheels'] == 0){
                                    echo '<input class="" type="checkbox" name="allaoy-w" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="allaoy-w" value="YES" checked ="true">'; 
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Alloy Wheels");?> </label>
                            </div>
 

                            
                        </div>

                        <div class="col-md-5">
                            <label><?php getTE('Seats');?></label>

                            <div class="form-group container"> 
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Memory_Seats'] == 0){
                                    echo '<input class="" type="checkbox" name="mem-seat" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="mem-seat" value="YES" checked="true">'; 
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Memory Seats");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Bucket_Seats'] == 0){
                                    echo '<input class="" type="checkbox" name="bucket" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="bucket" value="YES" checked ="true">';
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Bucket Seats");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Power_Steering'] == 0){
                                    echo '<input class="" type="checkbox" name="power-seat" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="power-seat" value="YES" checked="true">'; 
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Power Seats");?> </label>
                           </div>

                           <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Third_Row_Seats'] == 0){
                                  echo '<input class="" type="checkbox" name="row-s" value="YES" >';
                                    
                                }else{
                                    echo '<input class="" type="checkbox" name="row-s" value="YES" checked ="true">'; 
                                }
                                ?>
                                
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Third Row Seats");?> </label>
                            </div>

                            <div class="form-group container">    
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Leather_Interior'] == 0){
                                    echo '<input class="" type="checkbox" name="leather-in" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="leather-in" value="YES" checked = "true"> ';
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Leather Interior");?> </label>
                            </div>

                            
                        </div>

                        <div class="col-md-5">
                            <label><?php getTE('Lights');?></label>

                            

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['LED_Front_Lights'] == 0){
                                    echo '<input class="" type="checkbox" name="led-f-l" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="led-f-l" value="YES" checked="true"> ' ; 
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("LED Front Lights");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['LED_Back_Lights'] == 0){
                                    echo '<input class="" type="checkbox" name="led-b-l" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="led-b-l" value="YES" checked = "true">  ';
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("LED Back Lights");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Daylight_Auto'] == 0){
                                    echo '<input class="" type="checkbox" name="day-lig" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="day-lig" value="YES" checked ="true"> '; 
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Daylight");?> </label>
                               </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['xenon_Headlights'] == 0){
                                    echo '<input class="" type="checkbox" name="xenon" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="xenon" value="YES" checked ="true"> ';
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Xenon Headlights");?> </label>
                            </div>

                            <div class="form-group container">
                                <div class="col-md-1">
                                    <?php 
                                if ($item['Fog_Lights'] == 0){
                                    echo '<input class="" type="checkbox" name="fog-light" value="YES">';
                                }else{
                                    echo '<input class="" type="checkbox" name="fog-light" value="YES" checked ="true"> ' ;
                                }
                                ?>
                                    
                                </div>
                                <label class="col-md-8 control-lable" ><?php getTE("Fog Lights");?> </label>
                            </div>


                        </div>

                    </div>
             

                </div>
            </div>

        
            <div class="control-box control-box-toggle-X">

                    <div class="container">
                        <p class="control-title"><?php getTE("Cost");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">

                    <div class="col-md-5">
                        <div class="form-group container">
                                 <label class="col-md-12 control-lable"><?php getTE("Price");?></label>
                            <div class="col-md-12">
                                <input class="form-control " type="number" min="0"  name="imcost" required="required" value="<?php echo $item['Main_Price']?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Currency");?></label>
                            <div class="col-md-12">
                                 <select class="form-control" name="icurrency">
                                    <?php 
                                    echo '<option value="'.$item['Currency_ID'].'">'.$item['Currency_Code'].'</option>';
                                    $currencies = getInnerCurrency();
                                    foreach ($currencies as $curn) {
                                     echo '<option value="'.$curn['Currency_ID'].'">'.$curn['Currency_Code'].'</option>';
                                        }
                                    ?>
                                 </select>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Sales Method");?></label>
                            <div class="col-md-12">
                                <select class="form-control" name="sale-method">
                                <?php 
                                $salesMid = $item['AM_Sales_Method_ID'];
                                $sSalesMs = getInnerSalMeAM("am_sales_methods.AM_Sales_Method_ID =$salesMid ");
                                foreach ($sSalesMs as $sSalesM) {}
                                   echo '<option value ="'.$sSalesM['AM_Sales_Method_ID'].'">' .$sSalesM['AM_Sales_Method_Name'] .'</option>'; 
                              
                                $salesMethods = getInnerSalMeAM();
                                foreach ($salesMethods as $sMethod) {
                                    echo '<option value ="'.$sMethod['AM_Sales_Method_ID'].'">' .$sMethod['AM_Sales_Method_Name'] .'</option>';
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                    </div>
<!-- 
                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Main Cost");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="number"  name="imcost">
                            </div>
                        </div>
                    </div>
-->

                </div>
            </div>

                   
         
        
        <div class="control-box control-box-toggle-X" > 

            <div class="container"> 
               
                 <p class="control-title"><?php getTE("Maintenance");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
            </div>

            <div class="packet">

                    

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Next Check");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="month"  name="n-check" value="<?php echo $item['AM_Checked_To'];?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Timing belt Replacement");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="month"  name="rimen-reples" value="<?php echo $item['Belt_Replacement']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Guaranteed To");?> </label>
                            <div class="col-md-12">
                                <input class="form-control" type="month"  name="guaranteed-t" value="<?php echo $item['Guaranteed_To'];?>">
                            </div>
                        </div>
                    </div>

                 </div>

        </div>



        <div class="control-box control-box-toggle-X" >

            <div class="container">
                <p class="control-title"><?php getTE("Environment");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
            </div>

            <div class="packet">

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Emissions");?></label>
                            <div class="col-md-12">
                                 <select class="form-control" name="emis-class">
                                    <?php 
                                    $emissCid = $item['Emissions_Class_ID'];
                                    $eCs = superGet('*','am_emissions_class',"AM_Emission_Class_ID =$emissCid ");
                                    foreach ($eCs as $eC) {  }
                                      echo '<option value="'.$eC['AM_Emission_Class_ID'].'">'.$eC['AM_Emission_Class_Name'].'</option>';  
                                      
                                  
                                    $emissions = superGet('*','am_emissions_class');
                                    foreach ($emissions as $emis) {
                                     echo '<option value="'.$emis['AM_Emission_Class_ID'].'">'.$emis['AM_Emission_Class_Name'].'</option>';
                                        }

                                    ?>

                                 </select>
                                 
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Emissions Sticker");?></label>
                            <div class="col-md-12">
                                 <select class="form-control" name="emis-stick">
                                    <?php 
                                    $emissSid  =$item['Emission_Sticker_ID'];
                                    $sEss = getInnerEStickAM("am_emissions_sticker.AM_Emission_Sticker_ID = $emissSid");
                                    foreach ($sEss as $sEss) {}
                                        echo '<option value="'.$sEss['AM_Emission_Sticker_ID'].'">'.$sEss['AM_Emission_Sticker_Name'].'</option>';
                                    
                                    
                                    $emStickers = getInnerEStickAM();
                                    foreach ($emStickers as $emStick) {
                                     echo '<option value="'.$emStick['AM_Emission_Sticker_ID'].'">'.$emStick['AM_Emission_Sticker_Name'].'</option>';
                                        }
                                    ?>

                                 </select>
                                 
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Emissions Co2");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="emis-co2" value="<?php echo $item['Emissions_Co2']?>">
                            </div>
                        </div>
                    </div>

                </div>

        </div>

        <div class="control-box control-box-toggle-X">

                <div class="container">
                    <p class="control-title"><?php getTE("Additional Informations");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>
                
                <div class="packet">

                    <div class="container">

                        <div class="col-md-5">
          <!--
                        <div class="form-group container">
                                      <label class="col-md-12 control-lable"><?php getTE("Add Title");?></label>
                                <div class="col-md-12">
                                    <input class="form-control " type="text"   name="itemname"  value="<?php echo $item['Item_Name']; ?>">
                                </div>
                            </div>
          -->
        
                                <div class="form-group container">
                                    <label class="col-md-12 control-lable"><?php getTE("Tags");?></label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text"  name="itag" value="<?php echo $item['Item_Tags']; ?>">
                                        </div>
                                </div>

                                <div class="form-group container">
                                  <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text"  name="other1" value="<?php echo $item['Item_Link1']; ?>">
                                    </div>
                                  
                                </div>
                                <div class="form-group container">
                                  <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text"  name="other2" value="<?php echo $item['Item_Link2']; ?>">
                                    </div>
                                  
                                </div>
                        </div>

                        <div class="col-md-5">


                                <div class="form-group container">
                                    <label class="col-md-12 control-lable"><?php getTE("Description");?></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" type="textarea "  rows="6" name="idisc">   <?php echo $item['Item_Description']; ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
             </div>


        <div class="control-box control-box-toggle-X" >

                    <div class="container">
                        <p class="control-title"><?php getTE("Address");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">

                        <?php
                        $locationID = $item['Location_ID'];
                        $locations = superGet('*','locations_text',"Location_ID = $locationID");
                        foreach ($locations as $location) {}
                           
                        
                        ?>
                    
                    <div class="col-md-10">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Insert The Address");?></label>
                            <div class="" id="locationField">
                                <input id="autocomplete" placeholder="Enter your address"
                                onFocus="geolocate()" type="text" class="form-control">
                            </div>
                        </div>
                    </div> 
                    

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Country");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="country" required="required"  value="<?php echo $location['Country']; ?>" id="country"  readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Region");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="region"  value="<?php echo $location['Region']; ?>" id="administrative_area_level_1" readonly>
                            </div>
                        </div>
                    </div>

                      
                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("City");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="city"  value="<?php echo $location['City']; ?>" id='locality' readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Zip Code");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="zip"   value="<?php echo $location['Zip']; ?>" id="postal_code" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Street");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="street"  value="<?php echo $location['Street']; ?>" id="route" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12
                            control-lable"><?php getTE("Haus number");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="h-numm"  value="<?php echo $location['Haus_N']; ?>" id="street_number" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Address Notes");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="add-not"  value="<?php echo $location['Loc_Note']; ?>">
                            </div>
                        </div>
                    </div>

                </div>
        </div>

              <div class="text-center ">
                <input class="control-btn-a "  type="submit" value="<?php getTE('Save');?>">
              </div>

            </form>
         </div>    
        </div>
      </div>
    </div>

    <hr class="custom-hr">                   

                        
    <?php
        }// if item is in DB and for this user 
}elseif($do == 'update'){
     if ($_SERVER['REQUEST_METHOD'] == 'POST'){

         $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
        
        $user = $_SESSION['uid'];
        $items = getInnerItemAM("items.Item_ID = '$itemid' ");
        foreach ($items as $item) {}

        $catID     = $item['Category_ID'];
        $locID     = $item['Location_ID'];
        $itmMlid   = $item['Item_ID'];
        // Set AD Title
/*
        if(isset($_POST['itemname'])){
          $itemName  = tSec($_POST['itemname']);
        }else{$itemName = '##';}
    */    
        $itemDisc  = tSec($_POST['idisc']);
        $tag       = tSec(str_replace('.',',',str_replace('،',',',$_POST['itag'])));
        $other1    = tSec($_POST['other1']);
        $other2    = tSec($_POST['other2']);
        $catid     = $_POST['cat-id']; 
        $currenid  = $_POST['icurrency']; 
        $mainC     = $_POST['imcost'];// Float // senataliz yyyyy


        $praxid    = $_POST['praxis']; // XXXX
        $useStatus = $_POST['use-status'];
        $makerID   = $_POST['maker'];
        if(isset($_POST['maker-text'])) {
            $makerText = tSec($_POST['maker-text']);
        }
        
        
        if(isset($_POST['model'])){
          $modelID   = $_POST['model'];  
        }else {$modelID = 0;}

        if(isset($_POST['model-text'])){
          $modelText = tSec($_POST['model-text']);  
        }else {$modelText = NULL;}
        
        $subMtext  = tSec($_POST['sub-model']);
        $productD  = $_POST['prod-date'];////??
        $bodyID    = $_POST['body-t'];
        $GearBoxID = $_POST['gear-box'];
        $fuelID    = $_POST['fuel'];
        if (isset($_POST['fuel-text'])){
            $fuelText  = tSec($_POST['fuel-text']);
        }else{$fuelText = NULL ;}
        $sitsN     = nSec($_POST['sits-n']);
        $doorsN    = $_POST['doors-n'];
        $milage    = nSec($_POST['milage']);/////??
        $firstReg  = $_POST['f-regist']; ///// Date
        $nextCheck = $_POST['n-check'];///// Date
        $salesMid  = $_POST['sale-method'];
        $outColor  = $_POST['out-color'];
        $inColor   = $_POST['in-color'];
        $onerOrder = nSec($_POST['owner-order']); 

        $engSize   = tSec($_POST['eng-size']);
        $engValv   = $_POST['eng-valv'];
        $engType   = tSec($_POST['eng-type']);

        $imisClass = $_POST['emis-class'];
        $imisStick = $_POST['emis-stick'];
        $imisCo2   = tSec($_POST['emis-co2']);

        $rimenRepl = $_POST['rimen-reples']; 
        $guarantT  = $_POST['guaranteed-t'];

        $driveT  = $_POST['drive-type'];

        if (isset($_POST['mitalic']) && $_POST['mitalic'] = 'YES'){
            $mitalic     = 1;
        }else {$mitalic  = 0;}

        if (isset($_POST['ABS']) && $_POST['ABS'] = 'YES'){
            $ABS     = 1;
        }else {$ABS  = 0;}
        
        if (isset($_POST['ESP']) && $_POST['ESP'] = 'YES'){
            $ESP     = 1;
        }else {$ESP  = 0; }
       
        if (isset($_POST['alarmsys']) && $_POST['alarmsys'] = 'YES'){
            $alarmsys     = 1;
        }else {$alarmsys  = 0; }
       
        if (isset($_POST['isofix']) && $_POST['isofix'] = 'YES'){
            $isofix     = 1;
        }else {$isofix  = 0;}
        
        if (isset($_POST['ac-front']) && $_POST['ac-front'] = 'YES'){
            $acFront     = 1;
        }else {$acFront  = 0;}
        

        if (isset($_POST['ac-rear']) && $_POST['ac-rear'] = 'YES'){
            $acRear     = 1;
        }else {$acRear  = 0; }
       

        if (isset($_POST['navigat']) && $_POST['navigat'] = 'YES'){
            $nav     = 1;
        }else {$nav  = 0; }
       

        if (isset($_POST['power-steer']) && $_POST['power-steer'] = 'YES'){
            $powerSteer     = 1;
        }else {$powerSteer  = 0;}
        

        if (isset($_POST['keyless']) && $_POST['keyless'] = 'YES'){
            $keyless     = 1;
        }else {$keyless  = 0;}
        

        if (isset($_POST['int-phone']) && $_POST['int-phone'] = 'YES'){
            $intPhone     = 1;
        }else {$intPhone  = 0;}
        

        if (isset($_POST['bucket']) && $_POST['bucket'] = 'YES'){
            $bucket     = 1;
        }else {$bucket  = 0;  }
      

        if (isset($_POST['leather-in']) && $_POST['leather-in'] = 'YES'){
            $leatherIn     = 1;
        }else {$leatherIn  = 0;}
        

        if (isset($_POST['mem-seat']) && $_POST['mem-seat'] = 'YES'){
            $memSeat     = 1;
        }else {$memSeat  = 0;}
        

        if (isset($_POST['power-seat']) && $_POST['power-seat'] = 'YES'){
            $powerSeat     = 1;
        }else {$powerSeat  = 0;}
        

        if (isset($_POST['ab-driver']) && $_POST['ab-driver'] = 'YES'){
            $abDriver     = 1;
        }else {$abDriver  = 0; }
       

        if (isset($_POST['ab-pass']) && $_POST['ab-pass'] = 'YES'){
            $abPass     = 1;
        }else {$abPass  = 0;}

        if (isset($_POST['ab-side']) && $_POST['ab-side'] = 'YES'){
            $abSide     = 1;
        }else {$abSide  = 0;}
        

        if (isset($_POST['fog-light']) && $_POST['fog-light'] = 'YES'){
            $fogLight     = 1;
        }else {$fogLight  = 0; }

        if (isset($_POST['xenon']) && $_POST['xenon'] = 'YES'){
            $xenon     = 1;
        }else {$xenon  = 0; }

        if (isset($_POST['led-f-l']) && $_POST['led-f-l'] = 'YES'){
            $ledFront     = 1;
        }else {$ledFront  = 0; }

        if (isset($_POST['led-b-l']) && $_POST['led-b-l'] = 'YES'){
            $ledBack     = 1;
        }else {$ledBack  = 0; }

        if (isset($_POST['day-lig']) && $_POST['day-lig'] = 'YES'){
            $dayLight     = 1;
        }else {$dayLight  = 0; }
        
        if (isset($_POST['power-wind']) && $_POST['power-wind'] = 'YES'){
            $powerWind     = 1;
        }else {$powerWind  = 0; }
       

        if (isset($_POST['rear-w-d']) && $_POST['rear-w-d'] = 'YES'){
            $rearWd     = 1;
        }else {$rearWd  = 0;}
        

        if (isset($_POST['rear-w-w']) && $_POST['rear-w-w'] = 'YES'){
            $rearWw     = 1;
        }else {$rearWw  = 0;}
        

        if (isset($_POST['tinted-glass']) && $_POST['tinted-glass'] = 'YES'){
            $tintedGlass     = 1;
        }else {$tintedGlass  = 0; }
       

        if (isset($_POST['am-fm']) && $_POST['am-fm'] = 'YES'){
            $amFm     = 1;
        }else {$amFm  = 0;  }

    
        if (isset($_POST['casset']) && $_POST['casset'] = 'YES'){
            $casSet     = 1;
        }else {$casSet  = 0;}
        

        if (isset($_POST['cd']) && $_POST['cd'] = 'YES'){
            $cd     = 1;
        }else {$cd  = 0;}
        

        if (isset($_POST['mp']) && $_POST['mp'] = 'YES'){
            $mp     = 1;
        }else {$mp  = 0; } 
       

        if (isset($_POST['p-sound']) && $_POST['p-sound'] = 'YES'){
            $pSound     = 1;
        }else {$pSound  = 0; }
       

        if (isset($_POST['dvd-sys']) && $_POST['dvd-sys'] = 'YES'){
            $dvdSys     = 1;
        }else {$dvdSys  = 0;}
        

        if (isset($_POST['allaoy-w']) && $_POST['allaoy-w'] = 'YES'){
            $allaoyW     = 1;
        }else {$allaoyW  = 0;}
        

        if (isset($_POST['moon-r']) && $_POST['moon-r'] = 'YES'){
            $moonR     = 1;
        }else {$moonR  = 0; }
       

        if (isset($_POST['row-s']) && $_POST['row-s'] = 'YES'){
            $tRow     = 1;
        }else {$tRow  = 0;}
        

        $country   = tSec($_POST['country']);
        $region    = tSec($_POST['region']);
        $city      = tSec($_POST['city']);
        $zip       = tSec($_POST['zip']);
        $street    = tSec($_POST['street']);
        $hausNum   = tSec($_POST['h-numm']);
        $addNot    = tSec($_POST['add-not']);


        $lang      = $mLang; //$_SESSION['ulang'];

        $a    = 1; // for the items not have input 
        
     //check if all Variable is set
        if (empty($makerID) && empty($makerText)){
                $formErrors[] = getT('You must select the Maker');
            }

        if (empty($modelID) && empty($modelText)){
                $formErrors[] = getT('You must select the Model');
            }

        if (empty($fuelID) && empty($fuelText)){
                $formErrors[] = getT('You must select the Fuel type');
            }
            /*
        if (empty($firstReg)){
                $formErrors[] = getT('You must insert the first regist');
            }
           */
        if (empty($productD)){
                $formErrors[] = getT('You must insert the Production Date');
            }

        if (empty($GearBoxID)){
                $formErrors[] = getT('You must select the Gear box type');
            }

        if (empty($milage)){
                $formErrors[] =  getT('You must select the Millage');
            }


if (empty($formErrors)) {

    //Set   Location with Lat Lon
    $address = $street.' '.$hausNum.''.$zip.''. $city .' '. $region.' '.$country;

    $geoLoc = getGeoLoc($address);
    $lat = $geoLoc['lat'];
    $lon = $geoLoc['lng'];


        $stmt = $con->prepare("UPDATE locations_text SET Country = ?,Region = ?,  City = ?, Zip = ?,Street = ?, Haus_N = ?, Loc_Note = ?, Latitude = ?, Longitude = ? WHERE Location_ID = ?") ;
        $stmt->execute(array($country, $region, $city, $zip, $street, $hausNum, $addNot, $lat, $lon , $locID));



        $stmt = $con->prepare("UPDATE items SET Main_Price = ?,Category_ID = ?, Praxis_ID =?, Currency_ID = ?, Item_Link1 = ?, Item_Link2 = ? WHERE Item_ID = ?") ;
        $stmt->execute(array($mainC, $catID, $praxid ,$currenid, $other1, $other2, $itemid));

        $stmt = $con->prepare("UPDATE items_ml SET  Item_Description = ?, Item_Tags = ? WHERE Item_ID = ?");
        $stmt->execute(array( $itemDisc, $tag, $itemid ));
        

        $stmt = $con->prepare("UPDATE am_items SET  Maker_ID =?, AM_model_Text =?, Model_ID =?, AM_Sub_Model_Text =?, AM_Production_Date =?, AM_Fuel_ID =?, AM_Fuel_Text =?, AM_Body_ID =?, AM_Using_ID =?, AM_Gearbox_ID =?, AM_Passengers =?, AM_Doors =?, AM_Max_Speed =?, AM_Acceleration =?, AM_Mileage =?, AM_First_Regist =?, AM_Checked_To =?, AM_Owner_Number =? , AM_Sales_Method_ID =?, AM_Out_Color_ID =?, AM_Mitalic =?, AM_In_Color_ID =?,Emissions_Class_ID =?, Emission_Sticker_ID =?, Emissions_Co2 =?, Belt_Replacement =?, Guaranteed_To =?, ABS =?, ESP =?, Alarm_System =?,isofix =?, AM_Drive_Type_ID =?, AC_Front =?, AC_Rear =?, Navigation =?, Power_Steering =?, Keyless_Entry =?, Integrated_Phone =?, Bucket_Seats =?, Leather_Interior =?, Memory_Seats =?, Power_Seats =?, Airbag_Driver =?, Airbag_Passenger =?, Airbag_Side =?, Fog_Lights =?, Power_Windows =?, Rear_Window_Defroster =?, Rear_Window_Wiper =?, Tinted_Glass =?, AM_FM_Stereo =?, Cassette_Player =?, CD =?, MP3_Single_Disc =?, Premium_Sound =?, DVD_System =?, Alloy_Wheels =?, Moonroof_Sunroof =?, Third_Row_Seats =?,Engine_Size =?, Valves_Number =?, Engine_Type =? ,xenon_Headlights =?,LED_Front_Lights =?,LED_Back_Lights =? ,Daylight_Auto =? WHERE Item_ID = ?");

        $stmt->execute(array( $makerID, $modelText, $modelID, $subMtext, $productD, $fuelID ,$fuelText ,$bodyID, $useStatus, $GearBoxID, $sitsN, $doorsN, $a, $a, $milage, $firstReg, $nextCheck, $onerOrder, $salesMid, $outColor, $mitalic, $inColor, $imisClass, $imisStick, $imisCo2, $rimenRepl, $guarantT, $ABS, $ESP, $alarmsys, $isofix ,$driveT, $acFront, $acRear, $nav, $powerSteer, $keyless, $intPhone, $bucket, $leatherIn, $memSeat, $powerSeat, $abDriver, $abPass, $abSide, $fogLight, $powerWind, $rearWd, $rearWw, $tintedGlass, $amFm, $casSet, $cd, $mp, $pSound, $dvdSys, $allaoyW, $moonR ,$tRow, $engSize, $engValv, $engType, $xenon, $ledFront, $ledBack, $dayLight, $itemid ));



                echo "<div class= 'container'>"; 
                $msg = "<div class= 'alert alert-success'>".getT('The Item Updated Successfully')." </div>";
                redirectHome($msg,'manage_am_items.php?itemid='.$itemid,2);
                echo "</div>";
        
            }else{
                echo "<div>";
                foreach ($formErrors as $formError) {
                    echo '<div class="alert alert-danger">'.$formError.'</div>';
                }
                echo "</div>";
            }

        }else{
                 $msg = '<div class="alert alert-danger"> '.getT('There are no Item in this details').'</div>';
                 redirectHome($msg,'manage_am_items.php',2);

            } 
            
  }elseif($do == 'm_photos'){

    // Add Current Photos
    $itemid = $_GET['itemid'];

    if(isset($_SESSION['uid'])) {
        $userid = $_SESSION['uid'];
        $items = getInnerItemAM("items.Item_ID = $itemid AND users.User_ID = $userid");
      }elseif(isset($_SESSION['adminID'])){
        $items = getInnerItemAM("items.Item_ID = $itemid ");
      }

      if(!empty($items)){    // If the item ID is in DB
       

    $images = superGet('*','items_images',"Item_ID = $itemid");

    ?>
<h2 class="text-center"><?php getTE('Item Images');?></h2>

  <div class="container control-box"> 
    <div class="row">
      <?php
      foreach ($images as $image) {
        ?>
        <div class="col-md-2 col-xs-4 img-line">
          <img class="item_image" src="images/items/<?php echo $image['Item_Image']; ?>" alt=""/>
          <div class="p-list">
            <span class="p-list-icon"><i class="far fa-images fa-lg"></i></span>
            <ul class="">
              <li><a  href="manage_am_items.php?do=set_main&itemid=<?php echo $image['Item_ID'] ; ?>&phoid=<?php echo $image['Image_ID'] ; ?>"><?php getTE('Set Main');?></a></li>
              <li><a  class="confirm" href="manage_am_items.php?do=delete_photo&itemid=<?php echo $image['Item_ID'] ; ?>&phoid=<?php echo $image['Image_ID'];?>"><?php getTE('Delete');?></a></li>
            </ul>
          </div>
          
        </div>
        <?php
      } // End photos for each

        //Count Photos Limit 
        $imgCount = countRec('Item_ID','items_images',"Item_ID = $itemid ");

        $items = superGet('Image_Count','items',"Item_ID = $itemid");
        foreach ($items as $item){}
       
        if ($imgCount <= $item['Image_Count']) {
           
      ?>
      <div class="col col-md-2">
       <div class="p-manage-page">
          <form action="manage_am_items.php?do=insert_photo&itemid=<?php echo $itemid; ?>" method="POST" enctype="multipart/form-data">
              <div class="row ">

                  <div class="form-group col col-md-12 col-xs-4">
                          <div class="photo-input">
                             <img src="images/form/car-vector.png"  class="add-img-input" id="upfile1" style="cursor:pointer" />
                             <input class="form-control" type="file"  name="image" required id="file1">
                          </div>

                           <div class="text-center">
                            <span class="photo-count"><?php 
                            $totalCount =  $item['Image_Count'] +1 ;
                            echo $totalCount.' - '.$imgCount .' = ';
                            echo $totalCount - $imgCount; 
                            ?>
                              
                            </span>
                          </div>

                          <div class="  col col-md-12 ">
                           <input class="btn btn-default "  type="submit" value="<?php getTE('Add Photo');?>" >
                          </div>
                      </div>

                    </div>
                </form> 
            </div>

    </div><!--end row -->


    <?php
      } // if Count is not less than Accebted photo N#
        ?>
      </div>
    </div>
        <div class="container">
            <div class="text-center">
                    <a class="btn btn-primary add-photo" href="manage_am_items.php?itemid=<?php echo $itemid;?>"><?php getTE('Preview Page'); ?></a>
            </div>
        </div>
    <?php
  } // if $items not empty
}elseif($do == 'insert_photo'){

     if($_SERVER['REQUEST_METHOD']== 'POST'){
        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

        $imgName = isset($_GET['imgname']) && is_numeric($_GET['imgname']) ? intval($_GET['imgname']) : 0;

        $user = $_SESSION['uid'];

        addFile('images/items/','image'); // $imgName
        $img =  $file;
        $stmt = $con->prepare("INSERT INTO items_images(Item_Image, Item_ID) VALUES(:zimg, :zitemid)");

                    $stmt->execute(array(
                        'zimg'      => $img,
                        'zitemid'   => $itemid
                       
                         ));

        // Delete No Photo for this item if isset

      // $noImgs = superGet('*','items_images',)
        $stmt = $con->prepare("DELETE FROM items_images WHERE Item_ID = :zitemid AND Item_Image = 'no-item.png' ");

                    $stmt->bindParam(":zitemid", $itemid);

                    $stmt->execute();  

               // header('index.php');
                header('Location: manage_am_items.php?do=m_photos&itemid='.$itemid);
                //manage_am_items.php?do=m_photos&itemid=$itemid

     }else{
            echo ' <br><br> <div class="container"><div class="alert alert-danger">There is no Item in this Details, Or the items wait the Activation </div></div>' ;
        } 

 }elseif ($do == 'delete_photo') {

  $phoid = isset($_GET['phoid']) && is_numeric($_GET['phoid']) ? intval($_GET['phoid']) : 0; //short if 
  $images = superGet('*', 'items_images',"Image_ID = $phoid") ;
  foreach ($images as $image) {}
      $itemid = $image['Item_ID'];


// DELETE The File from the SERVER
  unlink('/images/items/'.$image['Item_Image']);

          if($images > 0){ 

           $stmt = $con->prepare("DELETE FROM items_images WHERE Image_ID = :zphoid");

              $stmt->bindParam(":zphoid", $phoid);

              $stmt->execute();  
              
      header('Location: manage_am_items.php?do=m_photos&itemid='.$itemid);
          }else{
      echo '<div>';
      $theMsg = "<div>".getT('The Item Deleted Successfully')."</div>";////
      redirectHome($theMsg,'manage_am_items.php?itemid='.$itemid,2);
      echo '</div>';////////////
       }

}elseif ($do == 'set_main'){
    $phoid = isset($_GET['phoid']) && is_numeric($_GET['phoid']) ? intval($_GET['phoid']) : 0; //short if 
    $images = superGet('*', 'items_images',"Image_ID = $phoid") ;
    foreach ($images as $image) {}
    $sItemid = $image['Item_ID'];
    
    // Set other photo not main :
    $stmt = $con->prepare("UPDATE items_images SET Ist_Main = ? WHERE Item_ID = ?") ;
    $stmt->execute(array(0, $sItemid));
    
    // Set selected photo is main :
    $stmt = $con->prepare("UPDATE items_images SET Ist_Main = ? WHERE Image_ID = ?") ;
    $stmt->execute(array(1, $phoid));

    //Redirect page :
    $theMsg = '<div class= "alert alert-success">'.getT('The Selected photo selected as main').'</div>';
     redirectHome($theMsg,'manage_am_items.php?itemid='.$itemid,3);

            
}elseif($do == 'new'){

            ?>

<h1 class="text-center"><?php getTE("Add New Item");?></h1>

<div class="container">
    <div class="row">
         

<div class="col-md- item-info">


     <div class="">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>?do=insert" method="POST">

            <div class="form-group container">
                <label class="col-sm-2 control-lable"><?php getTE("Categorey");?> </label>
                <div class="col-sm-10 col-md-4">
                    <?php 
                    //Get Category name and id
                    $catID = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0; 
                    $cats = getInnerCat("categories.Category_ID = $catID");
                    foreach ($cats as $cat) {}
                    ?>
                   <input type="hidden" name="icat" value="<?php echo $cat['Category_ID'];?>">
                   <?php echo $cat['Category_Name'];?>
                </div>
            </div>

            <input type="hidden" name="cat-id" value="<?php echo $catID; ?>">
               
            <div class="form-group container">
              <!--
                <label class="col-sm-2 control-lable"><?php getTE("Select Praxis"); ?></label>

                          -->
                <div class="col-sm-10 col-md-4">
                              <!--
                                <select class="form-control" name="praxis">
                                <?php 
                                //Get Category name and id
                                //$praxess = superGet("*",'praxis_ml');
                                $praxess = getInnerPraxis();
                                foreach ($praxess as $praxes) {
                                    echo '<option value ="'.$praxes['Praxis_ID'].'">' .$praxes['Praxis_Name'] .'</option>';
                                }
                                ?>
                                
                            </select>
                          -->
            <input type="hidden" name="praxis" value="1">

              </div>
          </div>

        <div class="control-box">

            <div class="container">
            <p class="control-title"><?php getTE("Mine Informations");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
            </div>

            <div class="packet">

            <div class="container ">
                <div class="col-md-5 ">
                    <div class="form-group ">
                    <label class=" col-md-12 control-lable"><?php getTE("Maker");?></label>
                    <div class=" col-md-12">
                      <select class="form-control" id="maker-list" name="maker" onChange="getModel(value)"  XonClick="getMakerText(value)" required="required" >
                        <option> <?php getTE("Select Makers");?></option>

                        <?php 
                        $makers = superGet('*','makes',"id != 0");
                        foreach ($makers as $maker) {
                            echo '<option value ="'.$maker['id'].'">' .$maker['Make_Name'] .'</option>';
                        }
                        //echo '<option value ="0">'. getT("Other Maker").' </option>';
                        ?>
                    </select>
                  
                    </div>
                </div>
            </div>
    

          <div class="col-md-5">
                  <div class="form-group container " id="maker-text">
                    <!-- Maker Text -->
                   
                  </div>
              </div>

          </div>

        <div class="container">
            <div class="col-md-5">
                <div class="form-group container">
                    <label class="col-md-12 control-lable"><?php getTE("Models");?></label>
                    <div class=" col-md-12">
                        <select class="form-control"  name="model" id="mod-list" onChange="getModelText(value)" disabled="disabled" required="required" >
                            
                            <option><?php getTE("Select Models");?> </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group container " id="model-text">
                    <!-- Model Text -->
                 
                 </div>
            </div>
        </div>

        <div class="container">
          <div class="col-md-5">
            <div class="form-group container">
                     <label class="col-md-12 control-lable"><?php getTE("Sub Model");?></label>
                <div class=" col-md-12">
                    <input class="form-control " type="text"   name="sub-model">
                </div>
            </div>
        </div>
      </div>

      <div class="container">
        <div class="col-md-5">
          <div class="form-group container">
              <label class="col-md-12 control-lable"><?php getTE("Fuel");?></label>
              <div class=" col-md-12">
                  <select class="form-control" id="fuel-list" disabled="disabled" name="fuel" onChange="getFuelText(value)" required="required" >
                      <option><?php getTE("Select Fuel");?></option>
                  <?php 
                  
                  $fuels = getInnerFuelAm();
                  foreach ($fuels as $fuel) {
                      echo '<option value ="'.$fuel['AM_Fuel_ID'].'">' .$fuel['AM_Fuel_Name'] .'</option>';
                  }

                  echo '<option value ="0"> '. getT("Other Fuel").'</option>';
                  ?>
              </select>
              </div>
          </div>
      </div>

      <div class="col-md-5">
          <div class="form-group container " id="fuel-text">
            <!-- Fuel Text -->
          </div>     
        </div>
     </div>

        
    <div class="container">
       <div class="col-md-5">
          <div class="form-group container">
              <label class="col-md-12 control-lable"><?php getTE("Body Type");?></label>
              <div class="col-md-12">
                  <select class="form-control" id="body-list" disabled="disabled" name="body-t" required="required" >
                      <option><?php getTE("Select Body Type");?></option>
                  <?php 
                  
                  $bodys = getInnerBodyAm();
                  foreach ($bodys as $body) {
                      echo '<option value ="'.$body['AM_Body_Type_ID'].'">' .$body['AM_Body_Type_Name'] .'</option>';
                  }
                  ?>
              </select>
              </div>
          </div>
      </div>


  <div class="col-md-5">
    <div class="form-group container">
        <label class="col-md-12 control-lable"><?php getTE("Gear Box");?></label>
            <div class="col-md-12">
              <select class="form-control" id="gear-list" disabled="disabled" name="gear-box" required="required" >
                <option><?php getTE("Select Gear Type");?></option>
                  <?php 
                  
                  $Gears = getInnerGearAm();
                  foreach ($Gears as $Gear) {
                      echo '<option value ="'.$Gear['AM_Gearbox_ID'].'">' .$Gear['AM_Gearbox_Name'] .'</option>';
                  }
                  ?>
            </select>
          </div>
        </div>
      </div>
    </div>

  <div class="container">
      <div class="col-md-5">
          <div class="form-group container">
             <label class="col-md-12 control-lable"><?php getTE("Production Date");?></label>
              <div class=" col-md-12">
                <select class="form-control" id="prod-year" name="prod-date" disabled="disabled" required="required" >
                  <option><?php getTE("Select the year");?></option>
                      <?php 
                      for ($i=2019 ; $i>=1950 ; $i--){
                          echo '<option value ="'.$i.'" >'.$i.'</option>';
                      }
                      ?>
                  </select>
              </div>
          </div>
      </div>

      <div class="col-md-5">
          <div class="form-group container">
              <label class="col-md-12 control-lable"><?php getTE("First registering");?></label>
              <div class=" col-md-12">
                <input class="form-control" id="first-regist" disabled="disabled" type="month"  name="f-regist"  >
              </div>
          </div>
      </div>
  </div>

      
  <div class="container">
      <div class="col-md-5">
          <div class="form-group container">
             <label class="col-md-12 control-lable"><?php getTE("Passengers");?></label>
              <div class="col-md-12">
                <input class="form-control " type="number" id="passengers" disabled="disabled"   name="sits-n"  min="1" max="40">
              </div>
          </div>
      </div>

          
          <div class="col-md-5">
              <div class="form-group container">
                       <label class="col-md-12 control-lable"><?php getTE("Milage");?></label>
                  <div class=" col-md-12">
                      <input class="form-control" id="milage" type="number"  min="0" name="milage" disabled="disabled" required="required" min="0">
                  </div>
              </div>
          </div>
      </div>

      </div>


  </div>

  <div class="container text-center">
          <div  class="control-btn-p " disabled="true" id="contenue-btn"><?php getTE("Continue");?></div>
  </div>


  <div class="control-box control-box-toggle">
      <div class="container">
              <p class="control-title"><?php getTE("Status");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
          </div>

          <div class="packet">

         <div class=" container">
              <div class="col-md-5">
                  <label class="col-md-12 "><?php getTE("Using Status");?></label>
                  <div class="col-md-12">
                      <select class="form-control" name="use-status" required="required" ">
                      <?php 
                      
                      $UseStatus = getInnerUseAm();
                      foreach ($UseStatus as $us) {
                          echo '<option value ="'.$us['AM_Using_ID'].'">' .$us['AM_Using_Name'] .'</option>';
                      }
                      ?>
                  </select>
                  </div>
                 </div>
              

            
            <div class="col-md-5">
            <div class="form-group container">
                     <label class="col-md-12 control-lable"><?php getTE("Owner Order");?></label>
                <div class="col-md-12">
                    <input class="form-control " type="number" min="0" max="15" name="owner-order" >
                </div>
            </div>
        </div>
        
        </div>
    </div>
</div> 

            <div class="control-box control-box-toggle">

    <div class="container">
        <p class="control-title"><?php getTE("Appearance");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
        </div>

    <div class="packet">

      <div class="container">
        <div class="col-md-5">
            <div class="form-group container">
                     <label class="col-md-12 control-lable"><?php getTE("Doors");?></label>
                <div class="col-md-12">
                    <select class="form-control" name="doors-n">
                      <option value="4/5">4/5</option>
                      <option value="2/3">2/3</option>
                      <option value="6/7">6/7</option>
                    </select>
                </div>
            </div>
        </div>
      </div>

    <div class="container">
        <div class="col-md-5">
            <div class="form-group container">
                <label class="col-md-12 control-lable"><?php getTE("Exterior Color");?>
                    </label>
                <div class="col-md-12">
                    <select class="form-control" name="out-color">
                        <option><?php getTE("Select the Exterior Color");?>
                        </option>
                    <?php 
                    
                    $oColors = getInnerColorAm();
                    foreach ($oColors as $oColor) {
                        echo '<option value ="'.$oColor['AM_Color_ID'].'">' .$oColor['AM_Color_Name'] .'</option>';
                    }
                    ?>
                </select>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-5">
            <div class="form-group container">
                <label class="col-md-4 control-lable" ><?php getTE("Mitalic");?></label>
                <div class="col-md-4">
                    <input class="" type="checkbox" name="mitalic"  value="YES">
                </div>
            </div>
        </div>
      </div>

          <div class="col-md-5">
              <div class="form-group container">
                  <label class="col-md-12 control-lable"><?php getTE("Interior Color");?>
                  </label>
                  <div class="col-md-12">
                      <select class="form-control" name="in-color">
                          <option><?php getTE("Select the Interior Color");?>
                          </option>
                      <?php 
                      
                      $iColors = getInnerColorAm();
                      foreach ($iColors as $iColor) {
                          echo '<option value ="'.$iColor['AM_Color_ID'].'">' .$iColor['AM_Color_Name'] .'</option>';
                      }
                      ?>
                  </select>
                  </div>
              </div>
          </div>

        </div>

        
    </div>


    <div class="control-box control-box-toggle">

        <div class="container">
            <p class="control-title"><?php getTE("technical informations");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
        </div>
        
        <div class="packet">

            <div class="container">

                <div class="col-md-5">    

                  <div class="form-group container">
                      <label class="col-md-12 control-lable"><?php getTE("Engine Size");?></label>
                      <div class="col-md-12">
                          <input class="form-control" type="text"  name="eng-size">
                      </div>
                  </div>
              </div>

              <div class="col-md-5">

                      <div class="form-group container">
                          <label class="col-md-12 control-lable"><?php getTE("Number of valves");?></label>
                          <div class="col-md-12">
                              <input class="form-control" type="text" name="eng-valv">
                          </div>
                      </div>
                  </div> 
              </div>

            <div class="container">

                <div class="col-md-5">

                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Engine Type");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text" name="eng-type">
                        </div>
                    </div>
                </div> 

                <div class="col-md-5">
                        <div class="form-group container">
                    <label class="col-md-12 control-lable"><?php getTE("Drive Type");?>
                    </label>
                    <div class="col-md-12">
                        <select class="form-control" name="drive-type">
                            <option><?php getTE("Select the Driving Type");?>
                            </option>
                        <?php 
                        $dTypes = superGet('*','am_drive_type');
                        foreach ($dTypes as $dType) {
                            echo '<option value = "'.$dType['AM_Drive_Type_ID'].'">'.$dType['AM_Drive_Type_Name'].'</option>';
                        }
                        ?>
                    </select>
                    </div>
                </div>
                    
                </div>
            </div>

        </div>
    </div>

      

        <div class="control-box control-box-toggle">

            <div class="container">
                <p class="control-title"><?php getTE("Equipments");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>
            
            
            <div class="packet">

                <div class="container">
                    <div class="col-md-5">
                        <label><?php getTE('Safety');?></label>

                    <div class="form-group container">
                        <div class="col-md-1">
                            <input class="" type="checkbox" name="ESP"  value="YES">
                        </div>
                        <label class="col-md-8 control-lable" ><?php getTE("ESP");?></label>
                    </div>

                    <div class="form-group container">
                        <div class="col-md-1">
                            <input class="" type="checkbox" name="ABS"  value="YES">
                        </div>
                        <label class="col-md-8 control-lable" ><?php getTE("ABS");?></label>
                    </div>

                    <div class="form-group container">
                        <div class="col-md-1">
                            <input class="" type="checkbox" name="isofix"  value="YES">
                        </div>
                        <label class="col-md-8 control-lable" ><?php getTE("Isofix");?></label>
                    </div>

                    <div class="form-group container">
                        <div class="col-md-1">
                            <input class="" type="checkbox" name="alarmsys" value="YES">
                        </div>
                        <label class="col-md-8 control-lable" ><?php getTE("Alarm System");?></label>
                    </div>

                    <div class="form-group container"> 
                    <div class="col-md-1">
                        <input class="" type="checkbox" name="keyless" value="YES">
                    </div>
                    <label class="col-md-8 control-lable" ><?php getTE("Keyless Entry");?> </label>
                    </div>

                    <div class="form-group container">
                        <div class="col-md-1">
                            <input class="" type="checkbox" name="ab-driver" value="YES">
                        </div>
                        <label class="col-md-8 control-lable" ><?php getTE("Airbag Driver");?> </label>
                    </div>

                    <div class="form-group container">
                        <div class="col-md-1">
                        <input class="" type="checkbox" name="ab-pass" value="YES">
                        </div>
                        <label class="col-md-8 control-lable" ><?php getTE("Airbag Passenger");?> </label>
                    </div>

                    <div class="form-group container">
                        <div class="col-md-1">
                            <input class="" type="checkbox" name="ab-side" value="YES">
                        </div>
                        <label class="col-md-8 control-lable" ><?php getTE("Airbag Side");?> </label>
                    </div>


                    </div>
                
                    <div class="col-md-5">
                        <label><?php getTE('Comfort'); ?></label>

                        <div class="form-group container">
                        
                    <div class="col-md-1">
                        <input class="" type="checkbox" name="ac-front" value="YES">
                    </div>
                    <label class="col-md-8 control-lable" ><?php getTE("AC Front");?></label>
                    </div>

                    <div class="form-group container">
                        
                    <div class="col-md-1">
                        <input class="" type="checkbox" name="ac-rear" value="YES">
                    </div>
                    <label class="col-md-8 control-lable" ><?php getTE("AC Rear");?></label>
                    </div>

                    <div class="form-group container">
                        
                    <div class="col-md-1">
                        <input class="" type="checkbox" name="navigat" value="YES">
                    </div>
                    <label class="col-md-8 control-lable" ><?php getTE("Navigation");?></label>
                    </div>
                        


                    </div>

                    <div class="col-md-5">
                        <label><?php getTE('Entertainment');?></label>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="am-fm" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("AM/FM Stereo");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                            <input class="" type="checkbox" name="casset" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Cassette Player");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                            <input class="" type="checkbox" name="cd" value="YES">
                             </div>
                            <label class="col-md-8 control-lable" ><?php getTE("CD");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="mp" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("MP3 Disc");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="dvd-sys" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("DVD System");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="p-sound" value="YES">
                            </div>
                            <label class="col-md-8 control-lable"><?php getTE("Premium Sound");?> </label>
                        </div>


                        
                    </div>

                    <div class="col-md-5">
                        <label><?php getTE('Additions');?></label>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="power-wind" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Power Windows");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="int-phone" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Integrated Phone");?> </label>
                        </div>

                        <div class="form-group container"> 
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="power-steer" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Power Steering");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="rear-w-d" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Rear Window Defroster");?> </label>
                         </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                            <input class="" type="checkbox" name="rear-w-w" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Rear Window Wiper");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="tinted-glass" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Tinted Glass");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                            <input class="" type="checkbox" name="moon-r" value="YES">
                             </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Moonroof Sunroof");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="allaoy-w" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Alloy Wheels");?> </label>
                        </div>


                        
                    </div>

                    <div class="col-md-5">
                        <label><?php getTE('Seats');?></label>

                        <div class="form-group container"> 
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="mem-seat" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Memory Seats");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="bucket" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Bucket Seats");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="power-seat" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Power Seats");?> </label>
                       </div>

                       <div class="form-group container">
                            <div class="col-md-1">
                            <input class="" type="checkbox" name="row-s" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Third Row Seats");?> </label>
                        </div>

                        <div class="form-group container">    
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="leather-in" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Leather Interior");?> </label>
                        </div>

                        
                    </div>

                    <div class="col-md-5">
                        <label><?php getTE('Lights');?></label>

                        

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="led-f-l" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("LED Front Lights");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="led-b-l" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("LED Back Lights");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="day-lig" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Daylight");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="xenon" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Xenon Headlights");?> </label>
                        </div>

                        <div class="form-group container">
                            <div class="col-md-1">
                                <input class="" type="checkbox" name="fog-light" value="YES">
                            </div>
                            <label class="col-md-8 control-lable" ><?php getTE("Fog Lights");?> </label>
                        </div>


                    </div>

                </div>
         

            </div>
        </div>

    
        <div class="control-box control-box-toggle">

                <div class="container">
                    <p class="control-title"><?php getTE("Cost");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>

                <div class="packet">

<!--
                <div class="col-md-5">
                    <div class="form-group container">
                             <label class="col-md-12 control-lable"><?php getTE("Price");?></label>
                        <div class="col-md-12">
                            <input class="form-control " type="number"  name="imcost" required="required" >
                        </div>
                    </div>
                </div>
-->

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Price");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="number" min="0" name="imcost" required="required">
                        </div>
                    </div>
                </div>

                 <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Currency");?></label>
                        <div class="col-md-12">
                             <select class="form-control" name="icurrency">
                                <?php 
                                $currencies = getInnerCurrency();
                                foreach ($currencies as $curn) {
                                 echo '<option value="'.$curn['Currency_ID'].'">'.$curn['Currency_Code'].'</option>';
                                    }
                                ?>
                             </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Sales Method");?></label>
                        <div class="col-md-12">
                            <select class="form-control" name="sale-method">
                            <?php 
                            $salesMethods = getInnerSalMeAM();
                            foreach ($salesMethods as $sMethod) {
                                echo '<option value ="'.$sMethod['AM_Sales_Method_ID'].'">' .$sMethod['AM_Sales_Method_Name'] .'</option>';
                            }
                            ?>
                        </select>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    
    <div class="control-box control-box-toggle" > 

        <div class="container"> 
           
             <p class="control-title"><?php getTE("Maintenance");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
        </div>

        <div class="packet">

                

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Next Check");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="month"  name="n-check">
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Timing belt Replacement");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="month"  name="rimen-reples">
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Guaranteed To");?> </label>
                        <div class="col-md-12">
                            <input class="form-control" type="month"  name="guaranteed-t">
                        </div>
                    </div>
                </div>

             </div>

    </div>



    <div class="control-box control-box-toggle" >

        <div class="container">
            <p class="control-title"><?php getTE("Environment");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
        </div>

        <div class="packet">

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Emissions");?></label>
                        <div class="col-md-12">
                             <select class="form-control" name="emis-class">
                                <?php 
                                $emissions = superGet('*','am_emissions_class');
                                foreach ($emissions as $emis) {
                                 echo '<option value="'.$emis['AM_Emission_Class_ID'].'">'.$emis['AM_Emission_Class_Name'].'</option>';
                                    }

                                ?>

                             </select>
                             
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Emissions Sticker");?></label>
                        <div class="col-md-12">
                             <select class="form-control" name="emis-stick">
                                <?php 
                                $emStickers = getInnerEStickAM();
                                foreach ($emStickers as $emStick) {
                                 echo '<option value="'.$emStick['AM_Emission_Sticker_ID'].'">'.$emStick['AM_Emission_Sticker_Name'].'</option>';
                                    }

                                ?>

                             </select>
                             
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Emissions Co2");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="emis-co2">
                        </div>
                    </div>
                </div>

            </div>

    </div>

    <div class="control-box control-box-toggle">

            <div class="container">
                <p class="control-title"><?php getTE("Additional Informations");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
            </div>
            
            <div class="packet">

                <div class="container">

                    <div class="col-md-5">
            <!--   
                    <div class="form-group container">
                                  <label class="col-md-12 control-lable"><?php getTE("Add Title");?></label>
                            <div class="col-md-12">
                                <input class="form-control " type="text"   name="item-name" >
                            </div>
                        </div>
                  
            -->
                            <div class="form-group container">
                                <label class="col-md-12 control-lable"><?php getTE("Tags");?></label>
                                <div class="col-md-12">
                                    <input class="form-control" type="text"  name="itag">
                                </div>
                            </div>

                            <div class="form-group container">
                              <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                                <div class="col-md-12">
                                    <input class="form-control" type="text"  name="other1">
                                </div>
                              
                            </div>
                            <div class="form-group container">
                              <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                                <div class="col-md-12">
                                    <input class="form-control" type="text"  name="other2">
                                </div>
                              
                            </div>

                    </div>

                    <div class="col-md-5">


                            <div class="form-group container">
                                <label class="col-md-12 control-lable"><?php getTE("Description");?></label>
                                <div class="col-md-12">
                                    <textarea class="form-control" type="textarea "  rows="6" name="idisc" >
                                    </textarea>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
         </div>

      


    <div class="control-box control-box-toggle" >

                <div class="container">
                    <p class="control-title"><?php getTE("Address");?><span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>

    <div class="packet">

      <div class="col-md-10">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Enter your address");?></label>
                        <div class="" id="locationField">
                            <input id="autocomplete" placeholder="<?php getTE("Enter your address");?>"
                            onFocus="geolocate()" type="text" class="form-control">
                        </div>
                    </div>
                </div> 
        <?php 
        /*
        // Get Default Address from Provider Address
        if (isset($_SESSION['uid'])){
          $userID = $_SESSION['uid'];
          $pros = getInnerProvider("providers.User_ID = '$userID' ");
          foreach ($pros as $pro) {}

            if(isset($pro['Country'])){
              $Country = $pro['Country'];
            }else{$Country = NULL ;}

            if(isset($pro['Region'])){
              $Region = $pro['Region'];
            }else{$Region = NULL ;}

            if(isset($pro['City'])){
              $City = $pro['City'];
            }else{$City = NULL ;}

            if(isset($pro['Zip'])){
              $Zip = $pro['Zip'];
            }else{$Zip = NULL ;}
             
        } 
  //Stoped this Function to get default Address to support search by location and distance. 
        */
        ?>


                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Country");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="country" required="required" id="country" value="<?php // echo $Country;?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php  getTE("Region");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="region" id="administrative_area_level_1" value="<?php // echo $Region;?>" readonly>
                        </div>
                    </div>
                </div>

                  
                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("City");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="city"  id="locality" value="<?php // echo $City;?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Zip Code");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="zip"  id="postal_code" value="<?php // echo $Zip;?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Street");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="street" id="route" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12
                        control-lable"><?php getTE("Haus number");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="h-numm" id="street_number" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Address Notes");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="add-not" readonly>
                        </div>
                    </div>
                </div>

            </div>
    </div>


            <div class="text-center ">
                <input class="control-btn-a" id="save-am" type="submit" value="<?php getTE('Save');?>">
            </div>

          </form>   
       </div>            
    </div>
  </div>
</div>


    <hr class="custom-hr">

 <?php
}elseif ($do == 'insert') {


  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $userid    = $_SESSION['uid']; 

        $itemDisc  = tSec($_POST['idisc']);
         $tag       = tSec(str_replace('.',',',str_replace('،',',',$_POST['itag'])));

        $other1    = tSec($_POST['other1']);
        $other2    = tSec($_POST['other2']);
        $catid     = $_POST['cat-id']; 
        $currenid  = $_POST['icurrency']; 
        $mainC     = $_POST['imcost'];// Float // senataliz yy
        
        $praxid    = $_POST['praxis']; // XXXX
        $useStatus = $_POST['use-status'];
        $makerID   = $_POST['maker'];

        if(isset($_POST['maker-text'])){$makerText = tSec($_POST['maker-text']);}else{$makerText = NULL ;}
        
        
        if(isset($_POST['model'])){
          $modelID   = $_POST['model'];  
        }else {$modelID = 0;}

        if(isset($_POST['model-text'])){
          $modelText = tSec($_POST['model-text']);  
        }else {$modelText = NULL;}
        
        $subMtext  = tSec($_POST['sub-model']);
        $productD  = $_POST['prod-date'];////??
        $bodyID    = $_POST['body-t'];
        $GearBoxID = $_POST['gear-box'];
        $fuelID    = $_POST['fuel'];
        if (isset($_POST['fuel-text'])){$fuelText  = tSec($_POST['fuel-text']);
        }else{$fuelText = NULL;}
        
        $sitsN     = nSec($_POST['sits-n']);
        $doorsN    = $_POST['doors-n'];
        $milage    = nSec($_POST['milage']);/////??
        $firstReg  = $_POST['f-regist']; ///// Date
        $nextCheck = $_POST['n-check'];///// Date
        $salesMid  = $_POST['sale-method'];
        $outColor  = $_POST['out-color'];
        $inColor   = $_POST['in-color'];
        $onerOrder = nSec($_POST['owner-order']); 

        $engSize   = tSec($_POST['eng-size']);
        $engValv   = $_POST['eng-valv'];
        $engType   = tSec($_POST['eng-type']);


        $imisClass = $_POST['emis-class'];
        $imisStick = $_POST['emis-stick'];
        $imisCo2   = tSec($_POST['emis-co2']);

        $rimenRepl = $_POST['rimen-reples']; 
        $guarantT  = $_POST['guaranteed-t'];

        $driveT  = $_POST['drive-type'];

        // Start Set AD Title
        if(isset($makerID)){
          $makes = superGet('*','makes', " id = $makerID" ); 
          foreach ($makes as $make) {}
            $makName = $make['Make_Name'];
          }else{$makeName = '#';}

        if(isset($modelID)){
          $models = superGet('*','models', " id = $modelID" ); 
          foreach ($models as $model) {}
            $modelName = $model['Model_Name'];
          }else{$modelName = '#';}
          // End Set AD Title


        if(isset($_POST['item-name']) && $_POST['item-name'] != NULL){
          $itemName  = tSec($_POST['item-name']);
        }else{$itemName = $makeName . $modelName ;}

        if (isset($_POST['mitalic']) && $_POST['mitalic'] = 'YES'){
            $mitalic     = 1;
        }else {$mitalic  = 0;}

        if (isset($_POST['ABS']) && $_POST['ABS'] = 'YES'){
            $ABS     = 1;
        }else {$ABS  = 0;}
        
        if (isset($_POST['ESP']) && $_POST['ESP'] = 'YES'){
            $ESP     = 1;
        }else {$ESP  = 0; }
       
        if (isset($_POST['alarmsys']) && $_POST['alarmsys'] = 'YES'){
            $alarmsys     = 1;
        }else {$alarmsys  = 0; }
       
        if (isset($_POST['isofix']) && $_POST['isofix'] = 'YES'){
            $isofix     = 1;
        }else {$isofix  = 0;}
        
        if (isset($_POST['ac-front']) && $_POST['ac-front'] = 'YES'){
            $acFront     = 1;
        }else {$acFront  = 0;}
        

        if (isset($_POST['ac-rear']) && $_POST['ac-rear'] = 'YES'){
            $acRear     = 1;
        }else {$acRear  = 0; }
       

        if (isset($_POST['navigat']) && $_POST['navigat'] = 'YES'){
            $nav     = 1;
        }else {$nav  = 0; }
       

        if (isset($_POST['power-steer']) && $_POST['power-steer'] = 'YES'){
            $powerSteer     = 1;
        }else {$powerSteer  = 0;}
        

        if (isset($_POST['keyless']) && $_POST['keyless'] = 'YES'){
            $keyless     = 1;
        }else {$keyless  = 0;}
        

        if (isset($_POST['int-phone']) && $_POST['int-phone'] = 'YES'){
            $intPhone     = 1;
        }else {$intPhone  = 0;}
        

        if (isset($_POST['bucket']) && $_POST['bucket'] = 'YES'){
            $bucket     = 1;
        }else {$bucket  = 0;  }
      

        if (isset($_POST['leather-in']) && $_POST['leather-in'] = 'YES'){
            $leatherIn     = 1;
        }else {$leatherIn  = 0;}
        

        if (isset($_POST['mem-seat']) && $_POST['mem-seat'] = 'YES'){
            $memSeat     = 1;
        }else {$memSeat  = 0;}
        

        if (isset($_POST['power-seat']) && $_POST['power-seat'] = 'YES'){
            $powerSeat     = 1;
        }else {$powerSeat  = 0;}
        

        if (isset($_POST['ab-driver']) && $_POST['ab-driver'] = 'YES'){
            $abDriver     = 1;
        }else {$abDriver  = 0; }
       

        if (isset($_POST['ab-pass']) && $_POST['ab-pass'] = 'YES'){
            $abPass     = 1;
        }else {$abPass  = 0;}

        if (isset($_POST['ab-side']) && $_POST['ab-side'] = 'YES'){
            $abSide     = 1;
        }else {$abSide  = 0;}
        

        if (isset($_POST['fog-light']) && $_POST['fog-light'] = 'YES'){
            $fogLight     = 1;
        }else {$fogLight  = 0; }

        if (isset($_POST['xenon']) && $_POST['xenon'] = 'YES'){
            $xenon     = 1;
        }else {$xenon  = 0; }

        if (isset($_POST['led-f-l']) && $_POST['led-f-l'] = 'YES'){
            $ledFront     = 1;
        }else {$ledFront  = 0; }

        if (isset($_POST['led-b-l']) && $_POST['led-b-l'] = 'YES'){
            $ledBack     = 1;
        }else {$ledBack  = 0; }

        if (isset($_POST['day-lig']) && $_POST['day-lig'] = 'YES'){
            $dayLight     = 1;
        }else {$dayLight  = 0; }
        
        if (isset($_POST['power-wind']) && $_POST['power-wind'] = 'YES'){
            $powerWind     = 1;
        }else {$powerWind  = 0; }
       

        if (isset($_POST['rear-w-d']) && $_POST['rear-w-d'] = 'YES'){
            $rearWd     = 1;
        }else {$rearWd  = 0;}
        

        if (isset($_POST['rear-w-w']) && $_POST['rear-w-w'] = 'YES'){
            $rearWw     = 1;
        }else {$rearWw  = 0;}
        

        if (isset($_POST['tinted-glass']) && $_POST['tinted-glass'] = 'YES'){
            $tintedGlass     = 1;
        }else {$tintedGlass  = 0; }
       

        if (isset($_POST['am-fm']) && $_POST['am-fm'] = 'YES'){
            $amFm     = 1;
        }else {$amFm  = 0;  }

    
        if (isset($_POST['casset']) && $_POST['casset'] = 'YES'){
            $casSet     = 1;
        }else {$casSet  = 0;}
        

        if (isset($_POST['cd']) && $_POST['cd'] = 'YES'){
            $cd     = 1;
        }else {$cd  = 0;}
        

        if (isset($_POST['mp']) && $_POST['mp'] = 'YES'){
            $mp     = 1;
        }else {$mp  = 0; } 
       

        if (isset($_POST['p-sound']) && $_POST['p-sound'] = 'YES'){
            $pSound     = 1;
        }else {$pSound  = 0; }
       

        if (isset($_POST['dvd-sys']) && $_POST['dvd-sys'] = 'YES'){
            $dvdSys     = 1;
        }else {$dvdSys  = 0;}
        

        if (isset($_POST['allaoy-w']) && $_POST['allaoy-w'] = 'YES'){
            $allaoyW     = 1;
        }else {$allaoyW  = 0;}
        

        if (isset($_POST['moon-r']) && $_POST['moon-r'] = 'YES'){
            $moonR     = 1;
        }else {$moonR  = 0; }
       

        if (isset($_POST['row-s']) && $_POST['row-s'] = 'YES'){
            $tRow     = 1;
        }else {$tRow  = 0;}
        

        $country   = tSec($_POST['country']);
        $region    = tSec($_POST['region']);
        $city      = tSec($_POST['city']);
        $zip       = tSec($_POST['zip']);
        $street    = tSec($_POST['street']);
        $hausNum   = tSec($_POST['h-numm']);
        $addNot    = tSec($_POST['add-not']);

        $lang      = $mLang; //$_SESSION['ulang'];

        $a    = 1; // for the items not have input 
        
     //check if all Variable is set
        if (empty($makerID) && empty($makerText)){
                $formErrors[] = getT('You must select the Maker');
            }

        if (empty($modelID) && empty($modelText)){
                $formErrors[] = getT('You must select the Model');
            }

        if (empty($fuelID) && empty($fuelText)){
                $formErrors[] = getT('You must select the Fuel type');
            }

    //    if (empty($firstReg)){
    ///            $formErrors[] = getT('You must insert the first regist');
    //        }
        if (empty($productD)){
                $formErrors[] = getT('You must insert the Production Date');
            }

        if (empty($GearBoxID)){
                $formErrors[] = getT('You must select the Gear box type');
            }

        if (empty($milage)){
                $formErrors[] =  getT('You must select the Millage');
            }


if (empty($formErrors)) {

        $stmt = $con->prepare("INSERT INTO items(Main_Price,Praxis_ID, Category_ID, Currency_ID, Item_Link1, Item_Link2, User_ID)
                                VALUES(:zprice, :zpraxis, :zcatid, :zcurrncyid, :zlink1, :zlink2, :zuserid)") ;
        $stmt->execute(array(
                        'zprice'          => $mainC,
                        'zpraxis'         => $praxid,
                        'zcatid'          => $catid,
                        'zcurrncyid'      => $currenid,
                        'zlink1'          => $other1,
                        'zlink2'          => $other2,
                        'zuserid'         => $userid
                         ));

        // Trick to get the last (Item_ID) from the DB to use it 
    $ID  =$con->prepare ("SELECT max(Item_ID) FROM items");
    $ID->execute();
    $ids = $ID->fetchAll();
    foreach ($ids as $id) {   }
    $lastID = $id['max(Item_ID)'];
       

  
        $stmt = $con->prepare("INSERT INTO items_ml(Item_ID,Lang_ID, Item_Name, Item_Description, Item_Tags)
                                VALUES(:zitemid, :zlang, :ziname, :zitemd, :ztags)") ;
        $stmt->execute(array(
                        'zitemid'     => $lastID,
                        'zlang'       => $lang,
                        'ziname'      => $itemName,
                        'zitemd'      => $itemDisc,
                        'ztags'       => $tag
                         ));

    //Set   Location with Lat Lon
    $address = $street.' '.$hausNum.''.$zip.''. $city .' '. $region.' '.$country;

    $geoLoc = getGeoLoc($address);
    $lat = $geoLoc['lat'];
    $lon = $geoLoc['lng'];


        $stmt = $con->prepare("INSERT INTO locations_text(Country, Zip, Region, City, Street, Haus_N, Loc_Note,Latitude,Longitude)
                                VALUES(:zcountry, :zzip, :zregion, :zcity, :zstreet, :zhnumber, :zlocnot, :zlan, :zlon)") ;
        $stmt->execute(array(
                        'zcountry'      => $country,
                        'zzip'          => $zip,
                        'zregion'       => $region,
                        'zcity'         => $city,
                        'zstreet'       => $street,
                        'zhnumber'      => $hausNum,
                        'zlocnot'       => $addNot,
                        'zlan'          => $lat,
                        'zlon'          => $lon
                         ));


        $stmt = $con->prepare("INSERT INTO am_items(Item_ID, Maker_ID, AM_model_Text, Model_ID, AM_Sub_Model_Text, AM_Production_Date, AM_Fuel_ID, AM_Fuel_Text, AM_Body_ID, AM_Using_ID, AM_Gearbox_ID, AM_Passengers, AM_Doors, AM_Max_Speed, AM_Acceleration, AM_Mileage, AM_First_Regist, AM_Checked_To, AM_Owner_Number , AM_Sales_Method_ID, AM_Out_Color_ID, AM_Mitalic, AM_In_Color_ID ,Emissions_Class_ID, Emission_Sticker_ID, Emissions_Co2, Belt_Replacement, Guaranteed_To, ABS, ESP, Alarm_System,isofix, AM_Drive_Type_ID, AC_Front, AC_Rear, Navigation, Power_Steering, Keyless_Entry, Integrated_Phone, Bucket_Seats, Leather_Interior, Memory_Seats, Power_Seats, Airbag_Driver, Airbag_Passenger, Airbag_Side, Fog_Lights, Power_Windows, Rear_Window_Defroster, Rear_Window_Wiper, Tinted_Glass, AM_FM_Stereo, Cassette_Player, CD, MP3_Single_Disc, Premium_Sound, DVD_System, Alloy_Wheels, Moonroof_Sunroof, Third_Row_Seats,Engine_Size, Valves_Number, Engine_Type ,xenon_Headlights ,LED_Front_Lights ,LED_Back_Lights ,Daylight_Auto ,Location_ID)
                                    VALUES(:zitemid, :zmakerid, :zmodelt, :zmodelid, :zsubmodel, :zprodd, :zfuelid, :zfueltext , :zbody, :zuse, :zgearb, :zpasseng, :zdoors, :zmspeed, :zacceler, :zmilage, :zfregist, :zcheckt, :zownern, :zsmethod, :zocolor, :zmita, :zicolor, :zmisclas, :zemisstic, :zemisco2,:zbeltrep, :zgurentee, :zabs, :zsep, :zalarmsys, :zisofix, :zdivet, :zacfront, :zacrear, :znav, :zpoers, :zkeyless, :zinphone, :zbucket, :zleatherin, :zmemseat, :zpowerset, :zabdriver, :zabpass, :zabside, :zfoglight, :zpowerw, :zrearw, :zrearww, :ztintglass, :zamfm, :zcasset, :zcd, :zmp, :zpsound ,:zdvds, :zalloyw, :zmoonr, :ztrows,
                                        :zengsize,
                                        :zvalv,:zengtype, :zxenon, :zledf, :zledb, :zdayl,                           
                                        LAST_INSERT_ID() )");
        $stmt->execute(array(
                        'zitemid'      => $lastID,
                        'zmakerid'     => $makerID,
                        'zmodelt'      => $modelText,
                        'zmodelid'     => $modelID,
                        'zsubmodel'    => $subMtext,
                        'zprodd'       => $productD,
                        'zfuelid'      => $fuelID,
                        'zfueltext'    => $fuelText,
                        'zbody'        => $bodyID,
                        'zuse'         => $useStatus,
                        'zgearb'       => $GearBoxID,
                        'zpasseng'     => $sitsN,
                        'zdoors'       => $doorsN,
                        'zmspeed'      => $a,
                        'zacceler'     => $a,
                        'zmilage'      => $milage,
                        'zfregist'     => $firstReg,
                        'zcheckt'      => $nextCheck,
                        'zownern'      => $onerOrder,
                        'zsmethod'     => $salesMid,
                        'zocolor'      => $outColor,
                        'zmita'        => $mitalic,
                        'zicolor'      => $inColor,
                        'zmisclas'     => $imisClass,
                        'zemisstic'    => $imisStick,
                        'zemisco2'     => $imisCo2,
                        'zbeltrep'     => $rimenRepl,
                        'zgurentee'    => $guarantT,
                        'zabs'         => $ABS,
                        'zsep'         => $ESP,
                        'zalarmsys'    => $alarmsys,
                        'zisofix'      => $isofix,
                        'zdivet'      => $driveT,
                        'zacfront'    => $acFront,
                        'zacrear'     => $acRear,
                        'znav'        => $nav,
                        'zpoers'      => $powerSteer,
                        'zkeyless'    => $keyless,
                        'zinphone'    => $intPhone,
                        'zbucket'     => $bucket,
                        'zleatherin'  => $leatherIn,
                        'zmemseat'    => $memSeat,
                        'zpowerset'   => $powerSeat,
                        'zabdriver'   => $abDriver,
                        'zabpass'     => $abPass,
                        'zabside'     => $abSide,
                        'zfoglight'   => $fogLight,
                        'zpowerw'     => $powerWind,
                        'zrearw'      => $rearWd,
                        'zrearww'     => $rearWw,
                        'ztintglass'  => $tintedGlass,
                        'zamfm'       => $amFm,
                        'zcasset'     => $casSet,
                        'zcd'         => $cd,
                        'zmp'         => $mp,
                        'zpsound'     => $pSound,
                        'zdvds'       => $dvdSys,
                        'zalloyw'     => $allaoyW,
                        'zmoonr'      => $moonR,
                        'ztrows'      => $tRow, 
                        'zengsize'    => $engSize,
                        'zvalv'       => $engValv,
                        'zengtype'    => $engType,
                        'zxenon'      => $xenon,
                        'zledf'       => $ledFront,
                        'zledb'       => $ledBack,
                        'zdayl'       => $dayLight
                         ));


            header('Location: manage_am_items.php?do=preview&itemid='.$lastID);


    
        }else{// view Errors if not empty
            echo "<div class= 'container'>";
            foreach ($formErrors as $formError) {
                echo "<div class='alert alert-danger'> * ".$formError."</div>";
                    }
             
            echo "</div>";

            }
          
    
    } // End (if server post (Add statement section))
           
            
 }elseif ($do == 'visible') {   

  //chek if the Id is Excist and is number
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

    if(isset($_SESSION['uid'])) {
        $userid = $_SESSION['uid'];
        $items = getInnerItemAM("items.Item_ID = $itemid AND users.User_ID = $userid");
      }elseif(isset($_SESSION['adminID'])){
        $items = getInnerItemAM("items.Item_ID = $itemid ");
      }

      if(!empty($items)){    // If the item ID is in DB

  // Change Visible Status:
    $stmt = $con->prepare("UPDATE items SET Item_Display = ? WHERE Item_ID = ?") ;
    $stmt->execute(array(1, $itemid));

    //Redirect page :
    $theMsg = '<div class= "alert alert-success">'.getT('This Item is Visable').'</div>';
     redirectHome($theMsg,'manage_am_items.php?itemid='.$itemid,1);

   }
 }elseif ($do == 'invisible') {

    //chek if the Id is Excist and is number
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

    if(isset($_SESSION['uid'])) {
        $userid = $_SESSION['uid'];
        $items = getInnerItemAM("items.Item_ID = $itemid AND users.User_ID = $userid");
      }elseif(isset($_SESSION['adminID'])){
        $items = getInnerItemAM("items.Item_ID = $itemid ");
      }

      if(!empty($items)){    // If the item ID is in DB

  // Change Visible Status:
    $stmt = $con->prepare("UPDATE items SET Item_Display = ? WHERE Item_ID = ?") ;
    $stmt->execute(array(0, $itemid));

    //Redirect page :
    $theMsg = '<div class= "alert alert-success">'.getT('This Item is Visable').'</div>';
     redirectHome($theMsg,'manage_am_items.php?itemid='.$itemid,1);
   }
 }elseif ($do == 'delete') {

    //chek if the Id is Excist and is number
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0; //short if

    if(isset($_SESSION['uid'])) {
        $userid = $_SESSION['uid'];
        $items = getInnerItemAM("items.Item_ID = $itemid AND users.User_ID = $userid");
      }elseif(isset($_SESSION['adminID'])){
        $items = getInnerItemAM("items.Item_ID = $itemid ");
      }

    if(!empty($items)){    // If the item ID is in DB


    $check = superGet('Item_ID', 'items','Item_ID = "$itemid"') ;


        if($check > 0){ 

          // DELETE The File from the SERVER  Item_ID
          $imgs = superGet('*','items_images', "Item_ID = $itemid");
          foreach ($imgs as $img) {
            if($img['Item_Image'] != 'no-item.png'){ // Delete if not photo img
              unlink('images/items/'.$img['Item_Image']);
                }
              }
          // Get locations-text ID to delete it
              $items = superGet("Location_ID",'am_items',"Item_ID = $itemid");
              foreach ($items as $item) {}
                $locTextID = $item['Location_ID'];
              
              $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = :zitemid");
              $stmt->bindParam(":zitemid", $itemid);
              $stmt->execute();

              $stmt = $con->prepare("DELETE FROM locations_text WHERE Location_ID = :zlocid");
              $stmt->bindParam(":zlocid", $locTextID);
              $stmt->execute();


      echo '<div class="">';
      $theMsg = "<div class='alert alert-success'>".getT('The Item Deleted Successfully')."</div>";
      redirectHome($theMsg,'index.php');
      echo '</div>';

        }else{
      echo '<div>';
      $theMsg = "<div >".getT('Sorry, you did not selected the User')."</div>";////
      redirectHome($theMsg,'index.php',2);
      echo '</div>';////////////
       }
      }   
            
  }else{ // End the do possibles
    $theMsg = getT('Fauls Request');
    redirectHome($theMsg,'manage_am_items.php?itemid='.$itemid,1);
  }
        
}else{ // if user not registed (First if)
     $theMsg = '<div class="container"><div class="alert alert-danger"> '.getT('Sorry, You are not resisted').' </div></div>' ;

    redirectHome($theMsg,'index.php',2);

} 
?>
<script>
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
<?php

include  $tpl."footer.php";
?>