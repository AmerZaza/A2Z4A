<?php 
ob_start();

session_start();

$pageTitle = 'Manage Items';

include 'init.php';

if(isset($_SESSION['user'])){
  

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
              $itemid = $id['max(Item_ID)']; // I must to test it online
          }
          //check if there are records for this user
          if($itemid == NULL){
              $message = getT('There are no Item in this details');
              redirectHome($message,'index.php', 3);
          }

  $items = getInnerItemSP("items.Item_ID = $itemid");
  if(!empty($items)){    // If the item ID is in DB
    foreach ($items as $item) {}  
    // Get Variables Name
    // Get Brand 
      if(isset($item['Brand_ID']) & $item['Brand_ID'] != 0 ){
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
    if (isset($item['AM_Fuel_ID']) & $item['AM_Fuel_ID'] != 0){
    $fuelID = $item['AM_Fuel_ID'];
    $fuels = getInnerFuelAm("am_fuel_ml.AM_Fuel_ID = $fuelID");
    foreach ($fuels as $fuel) {}
      $fuelName = $fuel['AM_Fuel_Name'];
    }else{$fuelName = getT('All');}
    
   ?>  
<div class="container">
  <div class="row">

    <div class="col col-md-9">
      <div class="control-box">
            <div class="container">
              <p class="control-title"><?php echo $item['Item_Name'];?> <span class="top"></span> <span class="icon"><i class="fas fa-cog"></i></span></p>
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
                                <p class="item-n"><?php echo getT('Item Number') .': AM'.$itemid ; ?></p>
                            </div>

                      </div>
                      <?php 
                     }else{ // if item has no photos
                        ?>

                        <div class="col-md-9">
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
      <a class="btn btn-default" href="manage_sp_items.php?do=m_photos&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Manage Photos');?></a>
      </div>
    </div> <!-- End photo Col-->

    <div class="am-tags col-md-2">      
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
        <div class="col-md-9 ">
          <div class="control-box">
            <div class="container">
            <p class="control-title"><?php getTE("Basic Information");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
            </div>

            <div class="packet">
             <div class="container ">
                <div class="col-md-12 ">

                  <div class="info-line"> <label><?php getTE("Item Group");?></label><span><?php echo $item['SP_Group_Name'];?></span></div> 

                  <div class="info-line"> <label><?php getTE("Item");?></label><span><?php echo $item['SP_Main_Item_Name'];?></span></div>

                  <div class="info-line"> <label><?php getTE("Brand");?></label><span><?php echo $brandName;?></span></div>

                  <div class="info-line"> <label><?php getTE("Unit");?></label><span><?php echo $item['Unit_Name'];?></span></div>

                  <div class="info-line"> <label><?php getTE("  Reference");?></label><span><?php echo $item['SP_Reference'];?></span></div>

                  <div class="info-line"> <label><?php getTE("Price");?></label><span><?php echo $item['Main_Price'].' '.$item['Currency_Code'];?></span></div>

                  <div class="info-line"> <label><?php getTE("Maker");?></label><span><?php echo $makerName;?></span></div>

                  <div class="info-line"> <label><?php getTE("Model");?></label><span><?php echo $modelName;?></span></div>

                  <div class="info-line"> <label><?php getTE("Fuel");?></label><span><?php echo $fuelName;?></span></div>

                  <div class="info-line"> <label><?php getTE("Production");?></label><span><?php echo $item['Production_Year'];?></span></div>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>


    <div class="container">
      <div class="row">
        <div class="col col-md-9">

          <div class="control-box">
        <div class="container">
          <p class="control-title"><?php getTE("More Details");?> <span class="top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>
          </div>

          <div class="packet">
           <div class="container ">
              <div class="col-md-12 ">

                <div class="info-line"> <label><?php getTE("Tags");?></label><span><?php echo $item['Item_Tags'];?></span></div>

                <div class="info-line"> <label><?php getTE("Link to another site");?></label><span><?php echo $item['Item_Link1'];?></span></div>

                <div class="info-line"> <label><?php getTE("Link to another site");?></label><span><?php echo $item['Item_Link1'];?></span></div>

                <div class="info-line"> <label><?php getTE("Description");?></label><textarea class="form-control" readonly rows="4"><?php echo $item['Item_Description'];?></textarea></div>

              </div>
            </div>
          </div>
        </div>
          
        </div>
      </div>
    </div>
    

  </div>
</div>

    <div class="form-group text-center">
              <a class="btn btn-success" href="manage_sp_items.php?do=edit&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Edit Item');?></a>
              <!--
              <a class="btn btn-success" href="manage_sp_items.php?do=m_photos&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Manage Photos');?></a>
            -->
              <a class="btn btn-success" href="select_category.php" ><?php getTE('New Item');?></a>
              <a class="btn btn-danger" href="manage_sp_items.php?do=delete&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Delete Item'); ?></a>
          </div>
   
        <?php
    } // End if item id isset

}elseif($do == 'edit'){

    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
    $user = $_SESSION['uid'];

    $items = getInnerItemSP("items.Item_ID = '$itemid' AND items.User_ID = '$user' "); 

  if(!empty($items)){    // If the item ID is in DB
    foreach ($items as $item) {}   

    // Get Variables Name

      // Get Brand
      if(isset($item['Brand_ID'])){
        $brandID = $item['Brand_ID'];
        $brands = superGet('*','brands',"Brand_ID = $brandID");
        foreach ($brands as $brand) {}
      }

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
    $fuels = getInnerFuelAm("am_fuel_ml.AM_Fuel_ID = $fuelID");
    foreach ($fuels as $fuel) {}
      if ($fuel['AM_Fuel_ID'] == 0 || $fuel['AM_Fuel_ID'] == NULL){
        $fuelName = getT('All');
      }else{$fuelName = $fuel['AM_Fuel_Name'];}

      ?>

<h1 class="text-center"><?php echo getT("Edit Item") .' '.$item['Item_Name'] ;?></h1>
<div class="container">
    <div class="row">      
      
      <div class="col-md- item-info">
          
           <div class="">
              <form action="<?php echo $_SERVER['PHP_SELF'];?>?do=update&itemid=<?php echo $itemid;?>" method="POST">

     
          <div class="form-group container">
                
          <div class="control-box">

              <div class="container">
              <p class="control-title"><?php getTE("Spare Part");?> <span class=""><i class="fas fa-cogs"></i></span></p>
              </div>

              <div class="">

              <div class="container ">

                <div class="col-md-5 ">
                      <div class="form-group ">
                      <label class=" col-md-12 control-lable"><?php getTE("Item Group");?></label>
                      <div class=" col-md-12">
                          <select class="form-control "  name="group" required="required"  onChange="getSPitems(value)">
                          <option value="<?php echo $item['SP_Group_ID'];?>"> <?php echo $item['SP_Group_Name'];?></option>

                          <?php 
                          $spGroups = getInnerGroupSP();
                          foreach ($spGroups as $spGroup) {
                            echo '<option value = "'.$spGroup['SP_Group_ID'].'">'.$spGroup['SP_Group_Name'].'</option>';
                          }
                          ?>
                      </select>
                      </div>
                  </div>
              </div>

              <div class="col-md-5 ">
                <div class="form-group ">
                  <label class=" col-md-12 control-lable"><?php getTE("Brand");?></label>
                  <div class=" col-md-12">
                      <select class="form-control"  name="brand">
                      <?php 
                      if(isset($item['Brand_ID'])){
                        ?>
                        <option value="<?php echo $brand['Brand_ID']; ?>"> <?php echo $brand['Brand_Name']; ?></option>
                        <?php }  ?>
                        <option value=""><?php getTE('Not Set');?></option>

                      <?php 
                      $brands = superGet('*','brands');
                      foreach ($brands as $brand) {
                          echo '<option value ="'.$brand['Brand_ID'].'">' .$brand['Brand_Name'] .'</option>';
                            }
                      ?>
                  </select>
                
                  </div>
              </div>
            </div>
            </div>

              <div class="container ">

                <div class="col-md-5 ">
                      <div class="form-group ">
                      <label class=" col-md-12 control-lable"><?php getTE("Select Item");?></label>
                      <div class=" col-md-12">
                          <select class="form-control "  name="spare" required="required" id="main-sp" >
                          <option value="<?php echo $item['SP_Main_Item_ID'];?>"> <?php echo $item['SP_Main_Item_Name'];?></option>
                          <?php 
                          /*
                          $spParts = getInnerSpareSP();
                          foreach ($spParts as $spPart) {
                            echo '<option value = "'.$spPart['SP_Main_Item_ID'].'">'.$spPart['SP_Main_Item_Name'].'</option>';
                            }
                            */
                          ?>
                      </select>
                      </div>
                  </div>
              </div>
              <div class="col-md-5">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Reference");?></label>
                  <div class="col-md-12">
                  <input  class=" form-control" type="text"  name="reference" required="required" value="<?php echo $item['Item_Name'];?>">
                </div>
              </div>
            </div>

            <div class="container ">

                <div class="col-md-5 ">
                      <div class="form-group ">
                      <label class=" col-md-12 control-lable"><?php getTE("Units");?></label>
                      <div class=" col-md-12">
                          <select class="form-control "  name="unit" required="required" >
                          <option value="<?php echo $item['Unit_ID'];?>"> <?php echo $item['Unit_Name'];?></option>

                          <?php 
                          $units = getInnerUnit();
                          foreach ($units as $unit) {
                            echo '<option value = "'.$unit['Unit_ID'].'">'.$unit['Unit_Name'].'</option>';
                          }
                          ?>
                      </select>
                      </div>
                  </div>
              </div>
              <div class="col-md-3">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Price");?></label>
                  <div class="col-md-12">
                  <input  class=" form-control" type="number" min="0" name="price" required="required" step="0.01" value="<?php echo $item['Main_Price'];?>">
                  </div>
                 </div>
            </div>

             <div class="col-md-2">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Currency");?></label>
                  <div class="col-md-12">

                  <select name="currency" class="form-control">
                    <option value="<?php echo $item['Currency_ID'];?>"><?php echo $item['Currency_Code'];?></option>
                    <?php
                    $currencies = getInnerCurrency("Currency_Used = 1");
                    foreach ($currencies as $currency) {
                      echo '<option value="'.$currency['Currency_ID'].'">'.$currency['Currency_Code'].'</option>';
                     }
                    ?>
                    
                  </select>
                  </div>
                 </div>
              </div>
            </div>
              
            </div>


            <div class="container">
              <div class="col-md-5 ">
                  <div class="form-group ">
                  <label class=" col-md-12 control-lable"><?php getTE("Maker");?></label>
                  <div class=" col-md-12">
                      <select class="form-control" id="maker-list" name="maker" onChange="getModel(value)"   required="required" >
                      <option value="<?php echo $item['Maker_ID'];?>"><?php echo $makerName;?></option>
                      <option value="0"> <?php getTE("All Makers");?></option>

                      <?php 
                      $makers = superGet('*','makes',"id != 0");
                      foreach ($makers as $maker) {
                          echo '<option value ="'.$maker['id'].'">' .$maker['Make_Name'] .'</option>';
                            }
                      ?>
                    </select>
                
                  </div>
              </div>
          </div>

          <div class="col-md-5 ">
                  <div class="form-group ">
                  <label class=" col-md-12 control-lable"><?php getTE("Production");?></label>
                  <div class=" col-md-12">
                      <select class="form-control"  name="production" >
                      <option value="<?php echo $item['Production_Year'];?>"> <?php echo $item['Production_Year'];?></option>
                      <option value="0"> <?php getTE("Not Set");?></option>

                      <?php 

                      for($I = 2019 ;$I >= 1970 ; $I--) {
                          echo '<option value ="'.$I.'">' .$I.'</option>';
                            }
                      ?>
                    </select>
                  </div>
              </div>
          </div>


        </div>
        <!-- trik input to post model where its not changed-->
        <input type="hidden" name="model" value="<?php echo $item['Model_ID']; ?>">

        <div class="container">
            <div class="col-md-5">
                <div class="form-group container">
                    <label class="col-md-12 control-lable"><?php getTE("Models");?></label>
                    <div class=" col-md-12">
                        <select class="form-control"  name="model" id="mod-list" onChange="getModelText(value)" disabled="disabled">
                          <option value="<?php echo $item['Model_ID'];?>"> <?php echo $modelName ;?></option>
                         
                            <option value=""><?php getTE("Selct Models");?> </option>
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
              <div class="col-md-5 ">
                  <div class="form-group ">
                  <label class=" col-md-12 control-lable"><?php getTE("Fuel");?></label>
                  <div class=" col-md-12">
                      <select class="form-control" name="fuel"   required="required" >
                      <option value="<?php echo $item['AM_Fuel_ID'];?>"> <?php echo $fuelName;?></option>

                      <?php 
                      $fuels = getInnerFuelAm();
                      foreach ($fuels as $fuel) {
                          echo '<option value ="'.$fuel['AM_Fuel_ID'].'">' .$fuel['AM_Fuel_Name'] .'</option>';
                            }
                      ?>
                  </select>
                
                  </div>
              </div>
          </div>
        </div>


        <div class="container">

            <div class="col-md-10">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Description");?></label>
                  <div class="col-md-12">
                    <textarea class=" form-control" name="description" rows="4"  ><?php echo $item['Item_Description'];?></textarea>
                  </div>
                 </div>
            </div>

 
        </div>
      </div>
    </div>
  </div>

    <div class="form-group container">
                
          <div class="control-box">

              <div class="container">
              <p class="control-title"><?php getTE("More Details");?> <span class=""><i class="fas fa-cogs"></i></span></p>
              </div>

              <div class="container">
                <div class="col-md-5">
                  <div class="form-group container ">
                    <label class="col-md-12 control-lable"><?php getTE("Tags");?></label>
                    <div class="col-md-12">
                    <input  class=" form-control" type="text"  name="tags">
                    </div>
                   </div>
                </div>
              </div>

              <div class="container">

                <div class="col-md-5">
                  <div class="form-group container ">
                    <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                    <div class="col-md-12">
                    <input  class=" form-control" type="text"  name="link1">
                    </div>
                   </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group container ">
                    <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                    <div class="col-md-12">
                    <input  class=" form-control" type="text"  name="link2">
                    </div>
                   </div>
                </div>

            </div>

            <div class="container ">

              <div class="col-md-10">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Description");?></label>
                  <div class="col-md-12">
                    <textarea class=" form-control" name="description" rows="4"></textarea>
                  </div>
                </div>
            </div>
 
              </div>
            </div>
          </div>


          <div class="col-md-offset-4 col-md-4 ">
                <input class="btn btn-red "  type="submit" value="<?php getTE('Save');?>">
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

    $spGroupID = $_POST['group'];
    $brand     = $_POST['brand'];
    $makerID   = $_POST['maker'];

    $link1     = tSec($_POST['link1']);
    $link2     = tSec($_POST['link2']);
    $tags      = tSec(str_replace('.',',',str_replace('،',',',$_POST['tags'])));

    if(isset($_POST['maker'])){$makerID = $_POST['maker'];}else{$makerID = NULL;}
    if(isset($_POST['model'])){$modelID = $_POST['model'];}else{$modelID = NULL;}
    if(isset($_POST['model-text'])){$modelText = $_POST['model-text'];}else{$modelText = NULL;}
    if(isset($_POST['fuel'])){$fuel = $_POST['fuel'];}else{$fuel = NULL;}
    $fuel         = $_POST['fuel'];
    $spItem       = $_POST['spare'];
    $reference    = tSec($_POST['reference']);
    $unit         = $_POST['unit'];
    $price        = $_POST['price'];
    $currency     = $_POST['currency'];
    $description  = tSec($_POST['description']);
    $production   = $_POST['production'];

    if (empty($makerID)){$allMakers = 1;}else{$allMakers = 0;}
    if (empty($modelID)){$allModels = 1;}else{$allModels = 0;}
    if (isset($_SESSION['ulang'])){
      $lang     = $_SESSION['ulang'];
    }else{$lang = $mLang;}

    $itemName  = $reference;
    $praxid    = 1;


    // Check if needed Variables are set 
  /*  if ($catID == 0){
            $formErrors[] = getT('You must select the Category');
            } */

    if (empty($spItem)){
          $formErrors[] = getT('You must select the Item');
            }

    if (empty($unit)){
          $formErrors[] =  getT('You must select the Unit');
            }

    if (empty($price)){
                $formErrors[] =  getT('You must select the Price');
              }

    if (empty($currency)){
                $formErrors[] =  getT('You must select the currency');
            }


  if (empty($formErrors)){  

    $stmt = $con->prepare("UPDATE items SET  Item_Link1 = ? , Item_Link2 = ?  WHERE Item_ID = ?");
        $stmt->execute(array( $link1 , $link2, $itemid ));

    $stmt = $con->prepare("UPDATE items_ml SET Item_Name = ?, Item_Description = ? , Item_Tags = ?  WHERE Item_ID = ?");
        $stmt->execute(array($itemName, $description, $tags , $itemid ));

    $stmt = $con->prepare("UPDATE sp_items SET  SP_Main_Item_ID = ?, SP_Reference = ?, Unit_ID = ?, Maker_ID = ?, Model_ID = ?,All_Makers = ?, All_Models = ?,  AM_Fuel_ID = ?, Production_Year = ?, Brand_ID = ? WHERE Item_ID = ?");
        $stmt->execute(array($spItem, $reference, $unit, $makerID, $modelID, $allMakers,$allModels, $fuel, $production, $brand, $itemid));



      echo '<div>';
      $msg = '<div class= "alert alert-success">'.getT('The Item Updated Successfully').'</div>';
      redirectHome($msg,'manage_sp_items.php?itemid='.$itemid,2);
      echo '</div>';
        
        }else{
            echo "<div>";
            foreach ($formErrors as $formError) {
                echo '<div class="alert alert-danger">'.$formError.'</div>';
            }
            echo "</div>";
        }


    }else{
       $msg = '<div class="alert alert-danger"> '.getT('There are no Item in this details').'</div>';
       redirectHome($msg,'manage_sp_items.php',2);

      } 
              

}elseif($do == 'new'){

  ?>

<h1 class="text-center"><?php getTE("Add New Item");?></h1>

<div class="container">
    <div class="row">      
      
      <div class="col-md- item-info">
          
           <div class="">
              <form action="<?php echo $_SERVER['PHP_SELF'];?>?do=insert" method="POST">

                  <div class="form-group container">
                      <div class="col-sm-10 col-md-4">
                          <?php 
                          //Get Category name and id
                          $catID = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0; 

                          ?>
                         <input type="hidden" name="catid" value="<?php echo $catID;?>">
                         <?php //echo $cat['Category_Name'];?>
                      </div>
                  </div>

                  <input type="hidden" name="cat-id" value="<?php echo $catID; ?>">
                     
          <div class="form-group container">
                
          <div class="control-box">

              <div class="container">
              <p class="control-title"><?php getTE("Spare Part");?> <span class=""><i class="fas fa-cogs"></i></span></p>
              </div>

              <div class="">

              <div class="container ">

                <div class="col-md-5 ">
                      <div class="form-group ">
                      <label class=" col-md-12 control-lable"><?php getTE("Item Group");?></label>
                      <div class=" col-md-12">
                          <select class="form-control "  name="group" required="required"  onChange="getSPitems(value)">
                          <option value="0"> <?php getTE("Item Group");?></option>

                          <?php 
                          $spGroups = getInnerGroupSP();
                          foreach ($spGroups as $spGroup) {
                            echo '<option value = "'.$spGroup['SP_Group_ID'].'">'.$spGroup['SP_Group_Name'].'</option>';
                          }
                          ?>
                      </select>
                      </div>
                  </div>
              </div>

              <div class="col-md-5 ">
                <div class="form-group ">
                  <label class=" col-md-12 control-lable"><?php getTE("Brand");?></label>
                  <div class=" col-md-12">
                      <select class="form-control"  name="brand">
                      <option> <?php getTE("Not Set");?></option>

                      <?php 
                      $brands = superGet('*','brands');
                      foreach ($brands as $brand) {
                          echo '<option value ="'.$brand['Brand_ID'].'">' .$brand['Brand_Name'] .'</option>';
                            }
                      ?>
                  </select>
                
                  </div>
              </div>
            </div>
            </div>

              <div class="container ">

                <div class="col-md-5 ">
                      <div class="form-group ">
                      <label class=" col-md-12 control-lable"><?php getTE("Select Item");?></label>
                      <div class=" col-md-12">
                          <select class="form-control "  name="spare" required="required" id="main-sp" >
                          <option> <?php getTE("Select Item");?></option>

                          <?php 
                          /*
                          $spParts = getInnerSpareSP();
                          foreach ($spParts as $spPart) {
                            echo '<option value = "'.$spPart['SP_Main_Item_ID'].'">'.$spPart['SP_Main_Item_Name'].'</option>';
                          }
                          */
                          ?>
                      </select>
                      </div>
                  </div>
              </div>
              <div class="col-md-5">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Reference");?></label>
                  <div class="col-md-12">
                  <input  class=" form-control" type="text"  name="reference" required="required" >
                </div>
              </div>
            </div>

            <div class="container ">

                <div class="col-md-5 ">
                      <div class="form-group ">
                      <label class=" col-md-12 control-lable"><?php getTE("Units");?></label>
                      <div class=" col-md-12">
                          <select class="form-control "  name="unit" required="required" >
                          <option> <?php getTE("Select Unit");?></option>

                          <?php 
                          $units = getInnerUnit();
                          foreach ($units as $unit) {
                            echo '<option value = "'.$unit['Unit_ID'].'">'.$unit['Unit_Name'].'</option>';
                          }
                          ?>
                      </select>
                      </div>
                  </div>
              </div>
              <div class="col-md-3">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Price");?></label>
                  <div class="col-md-12">
                  <input  class=" form-control" type="number" min="0" name="price" required="required" step="0.01">
                  </div>
                 </div>
            </div>

             <div class="col-md-2">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Currency");?></label>
                  <div class="col-md-12">

                  <select name="currency" class="form-control">
                    <?php
                    $currencies = getInnerCurrency("Currency_Used = 1");
                    foreach ($currencies as $currency) {
                      echo '<option value="'.$currency['Currency_ID'].'">'.$currency['Currency_Code'].'</option>';
                     }
                    ?>
                    
                  </select>
                  </div>
                 </div>
              </div>
            </div>
              
            </div>


            <div class="container">
              <div class="col-md-5 ">
                  <div class="form-group ">
                  <label class=" col-md-12 control-lable"><?php getTE("Maker");?></label>
                  <div class=" col-md-12">
                      <select class="form-control" id="maker-list" name="maker" onChange="getModel(value)"   required="required" >
                      <option value="0"> <?php getTE("All Makers");?></option>

                      <?php 
                      $makers = superGet('*','makes',"id != 0");
                      foreach ($makers as $maker) {
                          echo '<option value ="'.$maker['id'].'">' .$maker['Make_Name'] .'</option>';
                            }
                      ?>
                    </select>
                
                  </div>
              </div>
          </div>

          <div class="col-md-5 ">
                  <div class="form-group ">
                  <label class=" col-md-12 control-lable"><?php getTE("Production");?></label>
                  <div class=" col-md-12">
                      <select class="form-control"  name="production" >
                      <option value="0"> <?php getTE("Not Set");?></option>

                      <?php 

                      for($I = 2019 ;$I >= 1970 ; $I--) {
                          echo '<option value ="'.$I.'">' .$I.'</option>';
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
                    <label class="col-md-12 control-lable"><?php getTE("Models");?></label>
                    <div class=" col-md-12">
                        <select class="form-control"  name="model" id="mod-list" onChange="getModelText(value)" disabled="disabled">
                            <option value="0"><?php getTE("Selct Models");?> </option>
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
              <div class="col-md-5 ">
                  <div class="form-group ">
                  <label class=" col-md-12 control-lable"><?php getTE("Fuel");?></label>
                  <div class=" col-md-12">
                      <select class="form-control" name="fuel"   required="required" >
                      <option> <?php getTE("Not Set");?></option>

                      <?php 
                      $fuels = getInnerFuelAm();
                      foreach ($fuels as $fuel) {
                          echo '<option value ="'.$fuel['AM_Fuel_ID'].'">' .$fuel['AM_Fuel_Name'] .'</option>';
                            }
                      ?>
                  </select>
                
                  </div>
              </div>
          </div>
        </div>


        
      </div>
    </div>

    <div class="form-group container">
                
          <div class="control-box">

              <div class="container">
              <p class="control-title"><?php getTE("More Details");?> <span class=""><i class="fas fa-cogs"></i></span></p>
              </div>

              <div class="container">
                <div class="col-md-5">
                  <div class="form-group container ">
                    <label class="col-md-12 control-lable"><?php getTE("Tags");?></label>
                    <div class="col-md-12">
                    <input  class=" form-control" type="text"  name="tags">
                    </div>
                   </div>
                </div>
              </div>

              <div class="container">

                <div class="col-md-5">
                  <div class="form-group container ">
                    <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                    <div class="col-md-12">
                    <input  class=" form-control" type="text"  name="link1">
                    </div>
                   </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group container ">
                    <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                    <div class="col-md-12">
                    <input  class=" form-control" type="text"  name="link2">
                    </div>
                   </div>
                </div>

            </div>

            <div class="container ">

              <div class="col-md-10">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Description");?></label>
                  <div class="col-md-12">
                    <textarea class=" form-control" name="description" rows="4"></textarea>
                  </div>
                </div>
            </div>
 
              </div>
            </div>
          </div>
        </div>




          <div class="col-md-offset-4 col-md-4 ">
                <input class="btn btn-red "  type="submit" value="<?php getTE('Save');?>">
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

    $catID     = $_POST['catid'];
    $userID    = $_SESSION['uid'];
   // $spGroupID = $_POST['group'];
    $brand     = $_POST['brand'];
    $makerID   = $_POST['maker'];
    $link1     = tSec($_POST['link1']);
    $link2     = tSec($_POST['link2']);
    $tags      = tSec(str_replace('.',',',str_replace('،',',',$_POST['tags']))); 
     
    if(isset($_POST['maker'])){$makerID = $_POST['maker'];}else{$makerID = NULL;}
    if(isset($_POST['model'])){$modelID = $_POST['model'];}else{$modelID = NULL;}
    if(isset($_POST['model-text'])){$modelText = $_POST['model-text'];}else{$modelText = NULL;}
    if(isset($_POST['fuel'])){$fuel = $_POST['fuel'];}else{$fuel = NULL;}
    $spItem       = $_POST['spare'];
    $reference    = tSec($_POST['reference']);
    $unit         = $_POST['unit'];
    $price        = $_POST['price'];
    $currency     = $_POST['currency'];
    $description  = tSec($_POST['description']);
    $production   = $_POST['production'];

    if (empty($makerID)){$allMakers = 1;}else{$allMakers = 0;}
    if (empty($modelID)){$allModels = 1;}else{$allModels = 0;}

    if (isset($_SESSION['ulang'])){
      $lang     = $_SESSION['ulang'];
    }else{$lang = $mLang;}


    $itemName =  $reference; // Item Name = referance name

    $praxid    = 1;


    // Check if needed Variables are set 
    

    if (empty($spItem)){
          $formErrors[] = getT('You must select the Item');
            }

    if (empty($unit)){
          $formErrors[] =  getT('You must select the Unit');
            }

    if (empty($price)){
                $formErrors[] =  getT('You must select the Price');
              }

    if (empty($currency)){
                $formErrors[] =  getT('You must select the currency');
            }

  if (empty($formErrors)){

    $stmt = $con->prepare("INSERT INTO items(Main_Price,Praxis_ID, Category_ID, Currency_ID, User_ID, Item_Link1, Item_Link2)
                                VALUES(:zprice, :zpraxis,:zcatid, :zcurrncyid, :zuserid, :zlink1, :zlink2)") ;
        $stmt->execute(array(
                        'zprice'          => $price,
                        'zpraxis'         => $praxid,
                        'zcatid'          => $catID,
                        'zcurrncyid'      => $currency,
                        'zuserid'         => $userID,
                        'zlink1'          => $link1,
                        'zlink2'          => $link2
                         ));

/*
     $stmt = $con->prepare("INSERT INTO items_images(Item_Image, Item_ID)
                                VALUES(:zimage, LAST_INSERT_ID())") ;
        $stmt->execute(array(
                        'zimage'       => $imageName
                         ));
*/
  // Trick to get the last (Item_ID) from the DB to use it 
    $ID  =$con->prepare ("SELECT max(Item_ID) FROM items");
    $ID->execute();
    $ids = $ID->fetchAll();
    foreach ($ids as $id) {}
    $lastID = $id['max(Item_ID)'];


    $stmt = $con->prepare("INSERT INTO items_ml(Item_ID,Lang_ID, Item_Name, Item_Description, Item_Tags)
                                VALUES(:zitemid, :zlang, :ziname, :zdescription, :ztag)") ;
        $stmt->execute(array(
                        'zitemid'      => $lastID,
                        'zlang'        => $lang,
                        'ziname'       => $itemName,
                        'zdescription' => $description,
                        'ztag'         => $tags
                         ));

        $stmt = $con->prepare("INSERT INTO sp_items(Item_ID,SP_Reference, SP_Main_Item_ID, Unit_ID,All_Makers,All_Models, Maker_ID,Model_ID,AM_Fuel_ID,Production_Year,Brand_ID)

                            VALUES(:zitemid, :zrefernce, :zmainitemid, :zunitid, :zallmakers,
                               :zallmodels, :zmakerid, :zmodelid,  :zfuleid, :zproduct , :zbrand)") ;

          $stmt->execute(array(
                        'zitemid'     => $lastID,
                        'zrefernce'   => $reference,
                        'zmainitemid' => $spItem,
                        'zunitid'     => $unit,
                        'zmakerid'    => $makerID,
                        'zmodelid'    => $modelID,
                        'zallmakers'  => $allMakers,
                        'zallmodels'  => $allModels,
                        'zfuleid'     => $fuel,
                        'zproduct'    => $production,
                        'zbrand'      => $brand
                         ));


     echo '<div class="container">';
        $msg = '<div class="alert alert-success">'.getT('The Item Updated Successfully').'</div>';

        $link = 'manage_sp_items.php?do=preview&itemid='.$lastID;
        redirectHome($msg,$link);

      echo '</div>';


  }else{ // end if errors array is empty
    echo "<div class= 'container'>";
          foreach ($formErrors as $formError) {
              echo "<div class='alert alert-danger'> * ".$formError."</div>";
                  }

           // $msg = '<div class="alert alert-danger">'.getT('The Item Updated Successfully').'</div>';
            redirectHome('');
           
          echo "</div>";
  }



    }// End if Request is post

 }elseif ($do == 'delete') {

        //chek if the Id is Excist and is number
        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0; //short if 
        $check = superGet('Item_ID', 'items','Item_ID = "$itemid"') ;


                if($check > 0){
                /* There are no image or location for this items

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
                    */

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
            echo '</div>';//
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
              <li><a  class="" href="manage_sp_items.php?do=set_main&phoid=<?php echo $image['Image_ID'] ; ?>"><?php getTE('Set Main');?></a></li>
              <li><a  class="confirm" href="manage_sp_items.php?do=delete_photo&phoid=<?php echo $image['Image_ID'];?>"><?php getTE('Delete');?></a></li>

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
                <form action="manage_sp_items.php?do=insert_photo&itemid=<?php echo $itemid; ?>" method="POST" enctype="multipart/form-data">
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
                    <a class="btn btn-primary add-photo" href="manage_sp_items.php?itemid=<?php echo $itemid;?>"><?php getTE('Preview Page'); ?></a>
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
                header('Location: manage_sp_items.php?do=m_photos&itemid='.$itemid);
                //manage_sp_items.php?do=m_photos&itemid=$itemid

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
              

      header('Location: manage_sp_items.php?do=m_photos&itemid='.$itemid);
          }else{
      echo '<div>';
      $theMsg = "<div>".getT('The Item Deleted Successfully')."</div>";////
      redirectHome($theMsg,'manage_sp_items.php',2);
      echo '</div>';////////////
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
     redirectHome($theMsg,'manage_sp_items.php',3);


}else{ // End the do possibles
          $theMsg = getT('Fauls Request');
            redirectHome($theMsg,'manage_sp_items.php?do=manage',1);
      }

}
?>

<?php

include  $tpl."footer.php";
?>