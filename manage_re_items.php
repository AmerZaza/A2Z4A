<?php 
ob_start();

session_start();

include 'init.php';

if(isset($_SESSION['user'])){

    $pageTitle = 'Manage Real Estate Items';
  

    $user = $_SESSION['uid'];

    $do = isset($_GET['do']) ? $_GET['do'] : 'preview';

        if($do == 'preview'){  // preview page 

            if(!empty($_GET['itemid'])){
                $itemid = $_GET['itemid'];
            }else{
                $ID  =$con->prepare ("SELECT max(Item_ID) FROM items WHERE User_ID = $user");
                $ID->execute();
                $ids = $ID->fetchAll();
                foreach ($ids as $id) {   }
                $itemid = $id['max(Item_ID)']; 
            }
            //check if there are records for this user
            if($itemid == NULL){
                $message = getT('There are no Item in this details');
                redirectHome($message,'index.php', 3);
            }
            $items = getInnerItemRE("items.Item_ID = $itemid");
            if(!empty($items)){

            foreach ($items as $item) {}

                // Get Variables

         // Get Praxis
         $praxID = $item['Praxis_ID'];
         $praxis = getInnerPraxis("praxis.Praxis_ID = $praxID");
         foreach ($praxis as $praxi) {}

          // Get Type
          $typeID = $item['RE_Type_ID'];
          $types  = getInnerTypesRE("re_types.RE_Type_ID = $typeID");
          foreach ($types as $type) {}

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

                        <div class="col-md-3">
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

                      <div class="col-md-9 " >
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
                                <p class="item-n"><?php echo getT('Item Number') .': RE'.$itemid ; ?></p>
                            </div>

                      </div>
                      <?php 
                     }else{ // if item has no photos
                        ?>

                        <div class="col-md-9">
                            <img class="no-img-item center" src="images/form/RealEstate.jpeg">

                            <div class="container">
                             <p class="item-n"><?php echo getT('Item Number').': RE'.$itemid ; ?></p>
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
      <a class="btn btn-default" href="manage_re_items.php?do=m_photos&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Manage Photos');?></a>
      </div>
      
    </div>

    <div class="col-md-3">


  </div> 
</div><!-- End Row-->
</div><!-- End Container-->

            
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
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col col-md-8">

        <div class="control-box">
            <div class="container">
                    <p class="control-title"><?php getTE("Basic Information");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                        <div class="container ">
                            <div class="col-md-12 ">


                                <div class="info-line"> <label><?php getTE("Praxis");?></label><span><?php echo $praxi['Praxis_Name'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Type");?></label><span><?php echo $type['Type_Name'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Area");?></label><span><?php echo $item['RE_Area'];?> m²</span></div>

                                <div class="info-line"> <label><?php getTE("Floor");?></label><span><?php echo $item['RE_Floor'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Rooms");?></label><span><?php echo $item['RE_Room'];?></span></div> 

                                <div class="info-line"> <label><?php getTE("Bath");?></label><span><?php echo $item['RE_Bath'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Kitchen");?></label><span><?php echo $item['RE_Kitchen'];?></span></div>

                                <?php // Get Heating Name
                                $heatID = $item['RE_Heating_ID'];
                                $heatings = getInnerHeatingRE("re_heating.RE_Heating_ID = $heatID");
                                foreach($heatings as $heat){}
                                $heatName = $heat['RE_Heating_Name'];
                                ?>
                                <div class="info-line"> <label><?php getTE("Heating system");?></label><span><?php echo $heatName;?></span></div>
                                
                                <?php // Get Furnished Status
                                if ($item['RE_Furnished'] == 1){
                                    $furnStatus = getT('yes');
                                }else{$furnStatus = getT('no');}
                                ?>

                                <div class="info-line"> <label><?php getTE("Furnished");?></label><span><?php echo $furnStatus;?></span></div> 
                            </div>
                        </div>
                    </div>

            </div>

            <div class="control-box">
            <div class="container">
                    <p class="control-title"><?php getTE("Dates");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                        <div class="container ">
                            <div class="col-md-12 ">

                                <div class="info-line"> <label><?php getTE("Available From");?></label><span><?php echo 
                                $item['RE_Available_From'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Available To");?></label><span><?php echo 
                                $item['RE_Available_To'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Building");?></label><span><?php echo $item['RE_Creation'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Repair");?></label><span><?php echo $item['RE_Renewal'];?></span></div> 

                            </div>
                        </div>
                    </div>

            </div>

            <div class="control-box">
            <div class="container">
                    <p class="control-title"><?php getTE("Costs");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                        <div class="container ">
                            <div class="col-md-12 ">

                                <div class="info-line"> <label><?php getTE("Main Cost");?></label><span><?php echo $item['RE_Main_Cost'].' '.$item['Currency_Code'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Haus Costs");?></label><span><?php echo $item['RE_Side_Costs1'].' '.$item['Currency_Code'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Heating costs");?></label><span><?php echo $item['RE_Heating_Cost'].' '.$item['Currency_Code'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Water Cost");?></label><span><?php echo $item['RE_Water_Cost'].' '.$item['Currency_Code'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Electricity Cost");?></label><span><?php echo $item['RE_Electric_Cost'].' '.$item['Currency_Code'];?></span></div> 

                                <div class="info-line"> <label><?php getTE("Additional Costs");?></label><span><?php echo $item['RE_Additional_Costs'].' '.$item['Currency_Code'];?></span></div> 

                            </div>
                        </div>
                    </div>

            </div>

             <div class="control-box">
            <div class="container">
                    <p class="control-title"><?php getTE("Other Details");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                        <div class="container ">
                            <div class="col-md-12 ">

                                <div class="info-line"> <label><?php getTE("Link to another site");?></label><p><?php echo $item['Item_Link1'];?></p></div>

                              <div class="info-line"> <label><?php getTE("Link to another site"); ?></label><p><?php echo $item['Item_Link2'];?></p></div>

                                <div class="info-line "> <label><?php getTE("Description");?></label><textarea  readonly class="col-md-12 form-control"><?php echo $item['Item_Description'];?></textarea></div>

                            </div>
                        </div>
                    </div>
                </div>
<!--
            <div class="control-box">
            <div class="container">
                    <p class="control-title"><?php getTE("Address");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                    </div>

                    <div class="packet">
                        <div class="container ">
                            <div class="col-md-12 ">

                                <div class="info-line"> <label><?php getTE("Country");?></label><span><?php echo $item['Country'];?></span></div>

                                <div class="info-line"> <label><?php getTE("City");?></label><span><?php echo 
                                $item['City'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Region");?></label><span><?php echo 
                                $item['Region'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Zip");?></label><span><?php echo 
                                $item['Zip'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Street");?></label><span><?php echo 
                                $item['Street'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Haus number");?></label><span><?php echo 
                                $item['Haus_N'];?></span></div>

                                <div class="info-line"> <label><?php getTE("Address Notes");?></label><span><?php echo 
                                $item['Loc_Note'];?></span></div>

                            </div>
                        </div>
                    </div>

                </div>
-->
    </div><!-- Row -->
</div><!-- Container -->

                <div class="control-box">
                   <div class="container">
                    <p class="control-title"><?php getTE("Location");?> <span class="icon"><i class="far fa-map"></i> </p>
                    </div>
                    <div class="row">
                      <div class="col col-md-10">

                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!!.!2d6.!3d51.!!1f0!!3f0!!!!!3m3!1m2!1s0x%!2s<?php echo $item['Zip']?>+<?php echo $loc['Street'] .' '.$loc['City'].' '. $loc['Region'] .' '. $loc['Country']; ?>!!3m2!!!" width="99%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                      </div>
                      <div class="col col-md-2">
                        <h4 class="text-center"><?php getTE('Address');?></h4>
                        
                        <?php echo '<p class="text-center"><br>'.$item['Street'].' '.$item['Haus_N'].'<br> '.$item['Zip'] .'  '. $item['City'].' <br> '.$item['Region'].' '.$item['Country'] .'<p>';?>

                      </div>
                   </div>
                </div>
            </div>

                <div class="form-group text-center">
                <a class="btn btn-success" href="manage_re_items.php?do=edit&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Edit Item');?></a>
                <a class="btn btn-success" href="manage_re_items.php?do=m_photos&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Manage Photos');?></a>
                <a class="btn btn-success" href="manage_re_items.php?do=new"><?php getTE('New Item');?></a>
                <a class="btn btn-danger" href="manage_re_items.php?do=delete&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Delete Item'); ?></a>
            </div>


<?php
    }else{ // if item is not empty
        $msg = '<div class = "alert alert-danger"> There is no Item in this Details </div>';
        redirectHome($msg, 'index.php');
    }

}elseif($do == 'edit'){

            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
            $user = $_SESSION['uid'];

            
        $items = getInnerItemRE("items.Item_ID = '$itemid' And users.User_ID = '$user'"); 

        if(!empty($items)){    // If the item ID is in DB
            foreach ($items as $item) {}
            
    ?>

<h1 class="text-center"><?php echo getT("Edit Item") .' '.$item['Item_Name'] ;?></h1>

<div class="container">
    <div class="row">
        <div class="item-info">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>?do=update&itemid=<?php echo $itemid;?>" method="POST">
            

            <div class="control-box">

                <div class="container">
                <p class="control-title"><?php getTE("Mine Informations");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>

                <div class="packet">

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Praxis");?></label>
                                <div class=" col-md-12">
                                  <select class="form-control" name="praxis" required="required">
                                <?php 
                                $sPraxID = $item['Praxis_ID'];
                                $sPraxess = getInnerPraxis("praxis.Praxis_ID = $sPraxID");
                                foreach($sPraxess AS $sPrax);
                                echo '<option value ="'.$sPrax['Praxis_ID'].'">'.$sPrax['Praxis_Name'].'</option>';
                                $praxess = getInnerPraxis();
                                foreach ($praxess as $praxes) {
                                    echo '<option value ="'.$praxes['Praxis_ID'].'">' .$praxes['Praxis_Name'] .'</option>';
                                    }  ?>
                                  </select>  
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Type");?></label>
                                <div class=" col-md-12">
                                  <select class="form-control" name="itype" required="required">
                                <?php 
                                $sTypeID = $item['RE_Type_ID'];
                                $sTypes = getInnerTypesRE("re_types.RE_Type_ID = $sTypeID");
                                foreach ($sTypes as $sType) {}
                                    echo '<option value="'.$sType['RE_Type_ID'].'">'.$sType['Type_Name'].'</option>';
                                  
                                $types = getInnerTypesRE();
                                foreach ($types as $type) {
                                    echo '<option value ="'.$type['RE_Type_ID'].'">' .$type['Type_Name'] .'</option>';
                                    }  ?>
                                  </select>  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Heating system");?></label>
                                <div class=" col-md-12">
                                  <select class="form-control" name="heating" required="required">
                                    <?php 
                                $heatID = $item['RE_Heating_ID'];
                                $sHeatings = getInnerHeatingRE("re_heating.RE_Heating_ID = $heatID");
                                foreach ($sHeatings as $sHet) {}
 
                                echo '<option value ="'.$sHet['RE_Heating_ID'].'">' .$sHet['RE_Heating_Name'] .'</option>';

                                $Heatings = getInnerHeatingRE();
                                foreach ($Heatings as $Het) {
                                    echo '<option value ="'.$Het['RE_Heating_ID'].'">' .$Het['RE_Heating_Name'] .'</option>';
                                    }  ?>
                                  </select>  
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Area");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0"  name="iarea" value="<?php echo $item['RE_Area']; ?>" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Floor");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=1 min="0" name="ifloor" value="<?php echo $item['RE_Floor']; ?>">
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Rooms");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.5 min="0"  name="iroom" value="<?php echo $item['RE_Room']; ?>" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Bath");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=1 min="0" name="ibath" value="<?php echo $item['RE_Bath']; ?>">
                                </div>
                            </div>
                        </div>

                    </div>

                     <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Kitchen");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=1  min="0" name="ikit" value="<?php echo $item['RE_Kitchen']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Furnished");?></label>
                                <div class=" col-md-12">
                                <div class="col-md-6">
                                <input id="fern-yes" type="radio" name="fern" value="1" checked />
                                <label for="fern-yes"><?php getTE('Yes'); ?></label>
                                </div>
                                <div class="col-md-6">
                                    <input id="fern-no" type="radio" name="fern" value="0"  />
                                    <label for="fern-no"><?php getTE('No'); ?></label>
                                </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="control-box">

                <div class="container">
                <p class="control-title"><?php getTE("Dates");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>

                <div class="packet">
                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Available From");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="date" name="iavaf" value="<?php echo 
                                    $item['RE_Available_From']; ?>" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Available To");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="date" name="iavat" value="<?php echo 
                                    $item['RE_Available_To']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Building");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="date" name="ibdate" value="<?php echo 
                                    $item['RE_Creation']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Repair");?></label>
                                <div class=" col-md-12">
                                    <input  class="form-control" type="date" name="irdate" value="<?php echo 
                                    $item['RE_Renewal']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="control-box">

                <div class="container">
                <p class="control-title"><?php getTE("Costs");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>

                <div class="packet">

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Currency");?></label>
                                <div class=" col-md-12">
                                    <select class="form-control" name="icurrency">
                                    <?php 
                                    $sCurr = $item['Currency_ID'] ;
                                    $sCurrencies = getInnerCurrency("currencies.Currency_ID = $sCurr");
                                    foreach ($sCurrencies as $sCurrn){}
                                        echo '<option value ="'.$sCurrn['Currency_ID'].'.">'.$sCurrn['Currency_Code'].'</option>';

                                    $currencies = getInnerCurrency();
                                    foreach ($currencies as $curn) {
                                     echo '<option value="'.$curn['Currency_ID'].'">'.$curn['Currency_Code'].'</option>';
                                        }?>
                                 </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Main Cost");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0" name="imcost" value="<?php echo 
                                    $item['RE_Main_Cost']; ?>" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Haus Costs");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0"  name="ibcost" value="<?php echo 
                                    $item['RE_Side_Costs1']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Heatin Cost");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0" name="ihcost" value="<?php echo 
                                    $item['RE_Heating_Cost']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Water Cost");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0"  name="iwcost" value="<?php echo 
                                    $item['RE_Water_Cost']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Electricity Cost");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0" name="iecost" value="<?php echo 
                                    $item['RE_Electric_Cost']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Additional Costs");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0"  name="ia1cost" value="<?php echo 
                                    $item['RE_Additional_Costs']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
      
                </div>
            </div>

            <div class="control-box">

                <div class="container">
                <p class="control-title"><?php getTE("Other Details");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>

                <div class="packet">

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="text"  name="link1" value="<?php echo 
                                    $item['Item_Link1']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="text"  name="link2" value="<?php echo 
                                    $item['Item_Link2']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Name");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="text"  name="iname" value="<?php echo 
                                    $item['Item_Name']; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Tags");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="text"  name="itag" value="<?php echo 
                                    $item['Item_Tags']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Description");?></label>
                                <div class="col col-md-12">
                                <textarea  class="form-control" name="idisc" rows="6"><?php echo 
                                    $item['Item_Description']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
             <div class="control-box">

                <div class="container">
                <p class="control-title"><?php getTE("Address");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>


                <div class="packet">
                    
                    <div class="col-md-10">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Enter your address");?></label>
                        <div class="col-md-12" id="locationField">
                            <input id="autocomplete" placeholder="<?php getTE("Enter your address");?>"
                            onFocus="geolocate()" type="text" class="form-control">
                        </div>
                        </div>
                    </div> 

                    <div class="container">
                     <div class="col-md-5">
                        <div class="form-group ">
                            <label class="col-md-12 control-lable"><?php getTE("Country");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="country" required="required" id="country" value="<?php echo $item['Country'];?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                    <div class="form-group ">
                        <label class="col-md-12 control-lable"><?php getTE("Region");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="region" id="administrative_area_level_1" value="<?php echo $item['Region'];?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container"> 
                <div class="col-md-5">
                    <div class="form-group ">
                        <label class="col-md-12 control-lable"><?php getTE("City");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="city"  id="locality" value="<?php echo $item['City'];?>" >
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Zip Code");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="zip"  id="postal_code" value="<?php $item['Zip'];?>">
                        </div>
                    </div>
                </div>
                </div>

            <div class="container">
                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Street");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="street" id="route" value="<?php $item['Street'];?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12
                        control-lable"><?php getTE("Haus number");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="h-numm" id="street_number" value="<?php $item['Haus_N'];?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="col-md-5">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Address Notes");?></label>
                        <div class="col-md-12">
                            <input class="form-control" type="text"  name="add-not" value="<?php $item['Loc_Note'];?>" >
                        </div>
                    </div>
                </div>

            </div>
         </div>
     </div>

            <div class="text-center ">
                <input class="control-btn-a" id="" type="submit" value="<?php getTE('Save');?>">
            </div>

        </form>      
 
    </div>
            

        
    </div>
</div>

       

    <?php
        }else{ // if item is not empty
        $msg = '<div class = "alert alert-danger"> There is no Item in this Details </div>';
        redirectHome($msg, 'index.php');
    }
}elseif($do == 'update'){
     if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
            $user = $_SESSION['uid'];
        $items = getInnerItemRE("items.Item_ID = '$itemid' And users.User_ID = '$user'");
        foreach ($items as $item) {}

        //////////////////////////////////
        $itemName  = tSec($_POST['iname']);
        $itemDisc  = tSec($_POST['idisc']);
        $itemArea  = $_POST['iarea'];
        $itemType  = $_POST['itype'];
        $itemFurn  = $_POST['fern']; 
        $availFrom = $_POST['iavaf'];
        $availTo   = $_POST['iavat'];
        $floor     = $_POST['ifloor'];
        $room      = $_POST['iroom'];
        $kitchen   = $_POST['ikit'];
        $bath      = $_POST['ibath'];
        $mainC     = $_POST['imcost'];//nSec($_POST['imcost']);
        $HeatC     = $_POST['ihcost'];//nSec($_POST['ihcost']);
        $elecC     = $_POST['iecost'];//nSec($_POST['iecost']);
        $waterC    = $_POST['iwcost'];//nSec($_POST['iwcost']);
        $buildC    = $_POST['ibcost'];//nSec($_POST['ibcost']);
        $adeC1     = $_POST['ia1cost'];//nSec($_POST['ia1cost']);
        $bildD     = $_POST['ibdate']; 
        $repD      = $_POST['irdate'];
         $tag       = tSec(str_replace('.',',',str_replace('،',',',$_POST['itag'])));
        $currenid  = $_POST['icurrency']; 
        $userid    = $_SESSION['uid']; 
        $praxid    = $_POST['praxis'];
        $country   = tSec($_POST['country']);
        $region    = tSec($_POST['region']);
        $city      = tSec($_POST['city']);
        $zip       = tSec($_POST['zip']);
        $street    = tSec($_POST['street']);
        $hausNum   = tSec($_POST['h-numm']);
        $addNot    = tSec($_POST['add-not']);
        $link1     = tSec($_POST['link1']);
        $link2     = tSec($_POST['link2']);
        $heating  =$_POST['heating'] ;

        $locid     = $item['Location_ID'];

    // Get Item Name from item Type if it is empty
        if (empty($itemName)){
            $itemName = $item['Type_Name'];
        }

     //check if all Variable is set
        if (empty($itemArea)){
                $formErrors[] = getT('You must Insert The Area');
            }
        if (empty($itemType)){
                $formErrors[] = getT('You must select the Type');
            }
        if (empty($praxid)){
                $formErrors[] = getT('You must select the Praxis');
            }
        if (empty($availFrom)){
                $formErrors[] = getT('You must insert the Available Date');
            }
        if (empty($mainC)){
                $formErrors[] = getT('You must select the main Cost');
            }
        if (empty($country)){
                $formErrors[] = getT('You must insert The Country');
            }

if (empty($formErrors)) {

    //Set   Location with Lat Lon
    $address = $street.' '.$hausNum.''.$zip.''. $city .' '. $region.' '.$country;

    $geoLoc = getGeoLoc($address);
    $lat = $geoLoc['lat'];
    $lon = $geoLoc['lng'];


        $stmt = $con->prepare("UPDATE locations_text SET Country = ?,Region = ?,  City = ?, Zip = ?,Street = ?, Haus_N = ?, Loc_Note = ?, Latitude = ?, Longitude = ? WHERE Location_ID = ?") ;
        $stmt->execute(array($country, $region, $city, $zip, $street, $hausNum, $addNot, $lat, $lon , $locID));
                   

        $stmt = $con->prepare("UPDATE items SET Main_Price = ?, Praxis_ID =?, Currency_ID = ? ,Item_Link1 = ?, Item_Link2 = ? WHERE Item_ID = ?") ;
        $stmt->execute(array($mainC, $praxid ,$currenid, $link1 , $link2 ,$itemid));
        
                   
        $stmt = $con->prepare("UPDATE items_ml SET Item_Name = ?, Item_Description = ?, Item_Tags = ? WHERE Item_ID = ?");
        $stmt->execute(array( $itemName, $itemDisc, $tag, $itemid ));   

                     
        $stmt = $con->prepare("UPDATE re_items SET RE_Area =?, RE_Room =?, RE_Bath =?, RE_Kitchen =?, RE_Heating_Cost =?, RE_Water_Cost =?, RE_Electric_Cost =?, RE_Side_Costs1 =?, RE_Additional_Costs =?, RE_Main_Cost =?, RE_Available_From =?, RE_Available_To =?, RE_Creation =?, RE_Renewal =?,RE_Furnished =?,RE_Floor =?, RE_Heating_ID =? WHERE Item_ID =? ");
        $stmt->execute(array($itemArea,$room,$bath, $kitchen, $HeatC, $waterC, $elecC, $buildC, $adeC1, $mainC, $availFrom, $availTo, $bildD, $repD, $itemFurn, $floor ,$heating ,$itemid));


            $msg = '<div class="alert alert-success">'.getT('The Item Updated Successfully').'</div>';
            redirectHome($msg,"manage_re_items.php?do=preview&itemid=".$itemid,2);

            }else{// view Errors if not empty
            echo "<div class= 'container'>";
            foreach ($formErrors as $formError) {
                echo "<div class='alert alert-danger'> * ".$formError."</div>";
                    }
             
            echo "</div>";

            }

        }else{
                 $msg = '<div class="alert alert-danger">'.getT('There are no Item in this details').'</div>';
                 redirectHome($msg,'index.php',2);
            } 
            

}elseif($do == 'm_photos'){
    // Add Current Photos
    $itemid = $_GET['itemid'];

    $images = superGet('*','items_images',"Item_ID = $itemid");

            ?>
<h2 class="text-center"><?php getTE('Item Images');?></h2>

  <div class="container control-box"> 
    <div class="row">
      <?php
      foreach ($images as $image) {
        ?>
        <div class="col-md-2 col-xs-4">
          <img class="item_image" src="images/items/<?php echo $image['Item_Image']; ?>" alt=""/>
          <div class="p-list">
            <span class="p-list-icon"><i class="far fa-images fa-lg"></i></span>
            <ul class="list">
              <li><a  class="" href="manage_re_items.php?do=set_main&phoid=<?php echo $image['Image_ID'] ; ?>"><?php getTE('Set Main');?></a></li>
              <li><a  class="confirm" href="manage_re_items.php?do=delete_photo&phoid=<?php echo $image['Image_ID'];?>"><?php getTE('Delete');?></a></li>

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
                <form action="manage_re_items.php?do=insert_photo&itemid=<?php echo $itemid; ?>" method="POST" enctype="multipart/form-data">
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
                    <a class="btn btn-primary add-photo" href="manage_re_items.php?itemid=<?php echo $itemid;?>"><?php getTE('Preview Page'); ?></a>
            </div>
        </div>
    <?php
  
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
        header('Location: manage_re_items.php?do=m_photos&itemid='.$itemid);
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
              

      header('Location: manage_re_items.php?do=m_photos&itemid='.$itemid);
          }else{
      echo '<div>';
      $theMsg = "<div>".getT('The Item Deleted Successfully')."</div>";
      redirectHome($theMsg,'manage_re_items.php',2);
      echo '</div>';
       }
}elseif ($do == 'set_main'){

    $phoid = isset($_GET['phoid']) && is_numeric($_GET['phoid']) ? intval($_GET['phoid']) : 0; //short if 
    $images = superGet('*', 'items_images',"Image_ID = $phoid") ;
    foreach ($images as $image) {}
    $itemid = $image['Item_ID'];
    
    // Set other photo not main :
    $stmt = $con->prepare("UPDATE items_images SET Ist_Main = ? WHERE Item_ID = ?") ;
    $stmt->execute(array(0, $itemid));
    
    // Set selected photo is main :
    $stmt = $con->prepare("UPDATE items_images SET Ist_Main = ? WHERE Image_ID = ?") ;
    $stmt->execute(array(1, $phoid));

    //Redirect page :
    $theMsg = '<div class= "alert alert-success">'.getT('The Selected photo selected as main').'</div>';
     redirectHome($theMsg,'manage_re_items.php',3);


}elseif($do == 'new'){

//Get Category name and id
$catID = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0; 
     
 ?>

<h1 class="text-center"><?php getTE('Add New Item'); ?></h1>

<div class="container">
    <div class="row">

        <div class="item-info">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>?do=insert" method="POST">
                <input type="hidden" name="catid" value="<?php echo $catID; ?>">

            <div class="control-box">

                <div class="container">
                <p class="control-title"><?php getTE("Mine Informations");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>

                <div class="packet">

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Praxis");?></label>
                                <div class=" col-md-12">
                                  <select class="form-control" name="praxis" required="required">
                                    <option value=""><?php getTE('Select Praxis');?></option>
                                    <?php 
                                $praxess = getInnerPraxis();
                                foreach ($praxess as $praxes) {
                                    echo '<option value ="'.$praxes['Praxis_ID'].'">' .$praxes['Praxis_Name'] .'</option>';
                                    }  ?>
                                  </select>  
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Type");?></label>
                                <div class=" col-md-12">
                                  <select class="form-control" name="itype" required="required">
                                    <option value=""><?php getTE('Select Type');?></option>
                                    <?php 
                                $types = getInnerTypesRE();
                                foreach ($types as $type) {
                                    echo '<option value ="'.$type['RE_Type_ID'].'">' .$type['Type_Name'] .'</option>';
                                    }  ?>
                                  </select>  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Heating system");?></label>
                                <div class=" col-md-12">
                                  <select class="form-control" name="heating" required="required">
                                    <?php 
                                $Heatings = getInnerHeatingRE();
                                foreach ($Heatings as $Het) {
                                    echo '<option value ="'.$Het['RE_Heating_ID'].'">' .$Het['RE_Heating_Name'] .'</option>';
                                    }  ?>
                                  </select>  
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Area");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0"  name="iarea" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Floor");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=1 min="0" name="ifloor">
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Rooms");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.5 min="0"  name="iroom" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Bath");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=1 min="0" name="ibath">
                                </div>
                            </div>
                        </div>

                    </div>

                     <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Kitchen");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=1  min="0" name="ikit">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Furnished");?></label>
                                <div class=" col-md-12">
                                <div class="col-md-6">
                                <input id="fern-yes" type="radio" name="fern" value="1" checked />
                                <label for="fern-yes"><?php getTE('Yes'); ?></label>
                                </div>
                                <div class="col-md-6">
                                    <input id="fern-no" type="radio" name="fern" value="0"  />
                                    <label for="fern-no"><?php getTE('No'); ?></label>
                                </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="control-box">

                <div class="container">
                <p class="control-title"><?php getTE("Dates");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>

                <div class="packet">
                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Available From");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="date" name="iavaf" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Available To");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="date" name="iavat">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Building");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="date" name="ibdate">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Repair");?></label>
                                <div class=" col-md-12">
                                    <input  class="form-control" type="date" name="irdate">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="control-box">

                <div class="container">
                <p class="control-title"><?php getTE("Costs");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>

                <div class="packet">

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Currency");?></label>
                                <div class=" col-md-12">
                                    <select class="form-control" name="icurrency">
                                    <?php 
                                    $currencies = getInnerCurrency();
                                    foreach ($currencies as $curn) {
                                     echo '<option value="'.$curn['Currency_ID'].'">'.$curn['Currency_Code'].'</option>';
                                        }?>
                                 </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Main Cost");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0" name="imcost" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Haus Costs");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0"  name="ibcost">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Heating costs");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0" name="ihcost">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Water Cost");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0"  name="iwcost">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Electricity Cost");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0" name="iecost">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Additional Costs");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="number" step=0.01 min="0"  name="ia1cost">
                                </div>
                            </div>
                        </div>
                    </div>
      
                </div>
            </div>

            <div class="control-box">

                <div class="container">
                <p class="control-title"><?php getTE("Other Details");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
                </div>

                <div class="packet">

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="text"  name="link1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="text"  name="link2">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Name");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="text"  name="iname">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Tags");?></label>
                                <div class=" col-md-12">
                                    <input class="form-control" type="text"  name="itag">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-lable"><?php getTE("Description");?></label>
                                <div class="col col-md-12">
                                <textarea class="form-control" name="idisc" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
             <div class="control-box">

                <div class="container">
                <p class="control-title"><?php getTE("Address");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
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
             
        }  */
        ?>
                <div class="packet">
                    <div class="col-md-10">
                    <div class="form-group container">
                        <label class="col-md-12 control-lable"><?php getTE("Enter your address");?></label>
                        <div class="col-md-12" id="locationField">
                            <input id="autocomplete" placeholder="<?php getTE("Enter your address");?>"
                            onFocus="geolocate()" type="text" class="form-control">
                        </div>
                    </div>
                </div> 
 

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
                <input class="control-btn-a" id="" type="submit" value="<?php getTE('Save');?>">
            </div>

        </form>      
 
    </div>
</div>
</div>

 <?php
}elseif ($do == 'insert') {

     if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $itemName  = tSec($_POST['iname']);
        $itemDisc  = tSec($_POST['idisc']);
        $itemArea  = $_POST['iarea'];
        $itemType  = $_POST['itype'];
        $itemFurn  = $_POST['fern']; 
        $availFrom = $_POST['iavaf'];
        $availTo   = $_POST['iavat'];
        $floor     = $_POST['ifloor'];
        $room      = $_POST['iroom'];
        $kitchen   = $_POST['ikit'];
        $bath      = $_POST['ibath'];
        $mainC     = $_POST['imcost'];//nSec($_POST['imcost']);
        $HeatC     = $_POST['ihcost'];//nSec($_POST['ihcost']);
        $elecC     = $_POST['iecost'];//nSec($_POST['iecost']);
        $waterC    = $_POST['iwcost'];//nSec($_POST['iwcost']);
        $buildC    = $_POST['ibcost'];//nSec($_POST['ibcost']);
        $adeC1     = $_POST['ia1cost'];//nSec($_POST['ia1cost']);
        $bildD     = $_POST['ibdate']; 
        $repD      = $_POST['irdate'];
         $tag       = tSec(str_replace('.',',',str_replace('،',',',$_POST['itag'])));
        $catid     = $_POST['catid']; 
        $currenid  = $_POST['icurrency']; 
        $userid    = $_SESSION['uid']; 
        $praxid    = $_POST['praxis'];
        $country   = tSec($_POST['country']);
        $region    = tSec($_POST['region']);
        $city      = tSec($_POST['city']);
        $zip       = tSec($_POST['zip']);
        $street    = tSec($_POST['street']);
        $hausNum   = tSec($_POST['h-numm']);
        $addNot    = tSec($_POST['add-not']);
        $link1     = tSec($_POST['link1']);
        $link2     = tSec($_POST['link2']);
        $heating   = $_POST['heating'];

    // Get Item Name from item Type if it is empty
        if (empty($itemName)){
            $types = getInnerTypesRE("re_types.RE_Type_ID = $itemType");
            foreach ($types as $type) {}
            $itemName = $type['Type_Name'];
        }
        

    // Get Language id
        if (isset($_SESSION['ulang'])){
          $lang     = $_SESSION['ulang'];
        }else{$lang = $mLang;}


        //check if all Variable is set
        if (empty($itemArea)){
                $formErrors[] = getT('You must Insert The Area');
            }
        if (empty($itemType)){
                $formErrors[] = getT('You must select the Type');
            }
        if (empty($praxid)){
                $formErrors[] = getT('You must select the Praxis');
            }
        if (empty($availFrom)){
                $formErrors[] = getT('You must insert the Available Date');
            }
        if (empty($mainC)){
                $formErrors[] = getT('You must select the main Cost');
            }
        if (empty($country)){
                $formErrors[] = getT('You must insert The Country');
            }

if (empty($formErrors)) {

        $stmt = $con->prepare("INSERT INTO items(Main_Price,Praxis_ID, Category_ID, Currency_ID, User_ID ,Item_Link1 ,Item_Link2)
                                VALUES(:zprice, :zpraxis, :zcatid, :zcurrncyid,  
                                    :zuserid,
                                    :zlink1,
                                    :zlink2
                                        )") ;
        $stmt->execute(array(
                        'zprice'          => $mainC,
                        'zpraxis'         => $praxid,
                        'zcatid'          => $catid,
                        'zcurrncyid'      => $currenid,
                        'zuserid'         => $userid,
                        'zlink1'          => $link1,
                        'zlink2'          => $link2
                         ));
       
                   
                   
        $stmt = $con->prepare("INSERT INTO items_ml(Item_Name, Item_Description, Item_Tags,Lang_ID, Item_ID)
                                    VALUES(:zitem_name, :zitem_disc, :zitem_tag, :zlang, LAST_INSERT_ID() )");
        $stmt->execute(array(
                        'zitem_name'          => $itemName,
                        'zitem_disc'          => $itemDisc,
                        'zitem_tag'           => $tag,
                        'zlang'               => $mLang
                         ));

       // Trick to get the last (Item_ID) from the DB to use it
     
    $ID  =$con->prepare ("SELECT max(Item_ID) FROM items");
    $ID->execute();
    $ids = $ID->fetchAll();
    foreach ($ids as $id) {   }
    $lastID = $id['max(Item_ID)'];
    //echo $lastID;
  
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


        $stmt = $con->prepare("INSERT INTO re_items (RE_Area, RE_Room, RE_Bath, RE_Kitchen, RE_Main_Cost, RE_Heating_Cost, RE_Water_Cost, RE_Electric_Cost, RE_Side_Costs1, RE_Additional_Costs,RE_Available_From, RE_Available_To, RE_Creation, RE_Renewal,RE_Furnished,RE_Floor, RE_Type_ID ,RE_Heating_ID ,Location_ID ,Item_ID)
                                VALUES(:zarea, :zroom, :zbath, :zkichen, :zmainc,:zheating, :zwater, :zelectric, :zs_cost, :zadd1, :zavailable_f, :zavailable_t, :zcreat, :zrenew, :zfurnished, :zfloor, :ztypeid, :zheating ,LAST_INSERT_ID(), :zitemid )");
        $stmt->execute(array(
                        'zarea'          => $itemArea,
                        'zroom'          => $room,
                        'zbath'          => $bath,
                        'zkichen'        => $kitchen,
                        'zmainc'         =>$mainC,
                        'zheating'       => $HeatC,
                        'zwater'         => $waterC,
                        'zelectric'      => $elecC,
                        'zs_cost'        => $buildC,
                        'zadd1'          => $adeC1,
                        'zavailable_f'   => $availFrom,
                        'zavailable_t'   => $availTo,
                        'zcreat'         => $bildD,
                        'zrenew'         => $repD,
                        'zfurnished'     => $itemFurn,
                        'zfloor'         => $floor,
                        'ztypeid'        => $itemType,
                        'zheating'       => $heating,
                        'zitemid'        =>$lastID
                         )); 
          

          
             header('Location: manage_re_items.php');

        }else{// view Errors if not empty
            echo "<div class= 'container'>";
            foreach ($formErrors as $formError) {
                echo "<div class='alert alert-danger'> * ".$formError."</div>";
                    }
             
            echo "</div>";

            }       
    } // End (if server post (Add statement section))
           

}elseif ($do == 'delete') {

        //chek if the Id is Excist and is number
        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0; //short if 
        $check = superGet('Item_ID', 'items','Item_ID = "$itemid"') ;

        if($check > 0){ 

            // Get locations-text ID to delete it
            $items = superGet("Location_ID",'am_items',"Item_ID = $itemid");
                foreach ($items as $item) {}
                  $locTextID = $item['Location_ID'];

        // DELETE The File from the SERVER  Item_ID
        $imgs = superGet('*','items_images', "Item_ID = $itemid");
        foreach ($imgs as $img) {
            unlink('images/items/'.$img['Item_Image']);
            }
         

            $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = :zitemid");

            $stmt->bindParam(":zitemid", $itemid);

            $stmt->execute();

            $stmt = $con->prepare("DELETE FROM locations_text WHERE Location_ID = :zlocid");
                    $stmt->bindParam(":zlocid", $locTextID);
                    $stmt->execute();


            echo '<div class="">';
            $theMsg = "<div class= 'alert alert-success'>".getT('The Item Deleted Successfully')."</div>";
            redirectHome($theMsg);
            echo '</div>';

            }else{
            echo '<div>';
            $theMsg = "<div class='alert alert-danger'>".getT('Sorry, you did not selected the User')."</div>";
            redirectHome($theMsg,'index.php',2);
            echo '</div>';////////////
             }
            

        }else{ // End the do possibles
            redirectHome('Fauls Request','manage_re_items.php?do=manage',1);
            }
        
}else{ // if user not registed (First if)
     $theMsg = '<div class="container"><div class="alert alert-danger"> Sorry, you are not registes </div></div>' ;

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