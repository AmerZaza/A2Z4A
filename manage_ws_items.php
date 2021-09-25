<?php 
ob_start();

session_start();

$pageTitle = 'Manage Workshop Services';

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

  $items = getInnerItemWS("items.Item_ID = $itemid");

  if(!empty($items)){    // If the item ID is in DB
    foreach ($items as $item) {}  
    // Get Variables Name

    // Get Service Name _ML
    $sServID = $item['WS_Service_ID'];
    $sServices = getInnerServiceWS("ws_services.WS_Service_ID = $sServID");
    foreach ($sServices as $sService) {} 
    
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
    
    
   ?>  
<div class="container">
  <div class="row">
    <div class="col col-md-12">
      <div class="control-box">
            <div class="container">
              <p class="control-title"><?php // echo getTE('Service');?> <?php  echo $item['Item_Name'];?><span class="top"></span> <span class="icon"><i class="fas fa-cogs"></i></span></p>
            </div>

            <div class="row">
            <div class="col col-md-12">
              <p><label><?php getTE('Service');?></label><?php echo $sService['WS_Service_Name'];?></p>
            </div>
      

          <div class="col col-md-12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th><?php getTE('Maker');?></th>
                  <th><?php getTE('Model');?></th>
                  <th><?php getTE('Time');?></th>
                  <th><?php getTE('Cost');?></th>
                  <th><?php getTE('Currency');?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($items as $item){
                echo '<tr>';
                  echo '<td>'.$makerName.'</td>';
                  echo '<td>'.$modelName.'</td>';
                  echo '<td>'.$item['Expected_Time'].'</td>';
                  echo '<td>'.$item['Price'].'</td>';
                  echo '<td>'.$item['Currency_Code'].'</td>';
                echo '</tr>';
                }
                ?>
              </tbody>
            </table>
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

      <div class="control-box">
            <div class="container">
              <p class="control-title"><?php  echo getTE('Modre Details');?> <span class="top"></span> <span class="icon"><i class="fas fa-cogs"></i></span></p>
            </div>

            <div class="row">
            <div class="col col-md-6">
              <p><label><?php getTE('Link to another site');?></label><?php echo $item['Item_Link1'];?></p>
            </div>

            <div class="col-md-6">
              <p><label><?php getTE('Link to another site');?></label><?php echo $item['Item_Link2'];?></p>
            </div>

            <div class="col col-md-12">
                <label><?php getTE('Description');?></label>
                <textarea readonly class="form-control" rows="4">
                <?php echo $item['Item_Description'];?>
                </textarea>
            </div>
          </div>
        </div>



    </div>
  </div>
</div>

    <div class="form-group text-center">
              <a class="btn btn-success" href="manage_ws_items.php?do=edit&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Edit Item');?></a>
              <!--
              <a class="btn btn-success" href="manage_am_items.php?do=m_photos&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Manage Photos');?></a>
            -->
              <a class="btn btn-success" href="select_category.php" ><?php getTE('New Item');?></a>
              <a class="btn btn-danger" href="manage_ws_items.php?do=delete&itemid=<?php echo $item['Item_ID']?>"><?php getTE('Delete Item'); ?></a>
          </div>
   
        <?php
    } // End if item id isset

  }elseif($do == 'edit'){

    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
    $user = $_SESSION['uid'];

    $items = getInnerItemWS("items.Item_ID = '$itemid' AND items.User_ID = '$user' "); 

  if(!empty($items)){    // If the item ID is in DB
    foreach ($items as $item) {}   

    $sServices = getInnerItemWS("items.Item_ID = $itemid");
      foreach ($sServices as $sService) {}

      // Get Service Name
        $servID = $item['WS_Service_ID'];
        $sServNs = getInnerServiceWS("ws_services.WS_Service_ID = $servID");
        foreach ($sServNs as $sServN) {}

      ?>

<h1 class="text-center"><?php echo getT("Edit Item") .' '.$item['Item_Name'] ;?></h1>

  
<div class="container">
    <div class="row">      
      
      <div class="col-md- item-info">
          
           <div class="">
              <form action="<?php echo $_SERVER['PHP_SELF'];?>?do=update" method="POST">

                <input type="hidden" name="itemid" value="<?php echo $itemid; ?>">

                     
          <div class="form-group container">
                
          <div class="control-box">

              <div class="container">
              <p class="control-title"><?php echo $item['Item_Name'];?> <span class=""><i class="fas fa-cogs"></i></span></p>
              </div>

              <div class="">

              <div class="container ">

                <div class="col-md-5 ">
                      <div class="form-group ">
                      <label class=" col-md-12 control-lable"><?php getTE("Select Service");?></label>
                      <div class=" col-md-12">
                          <select class="form-control "  name="service" required="required" >
                          <?php 
                            echo '<option value = "'.$sService['WS_Service_ID'].'">'.$sServN['WS_Service_Name'].'</option>';
                              

                          $services = getInnerServiceWS("Visible = 1");
                          foreach ($services as $service) {
                            echo '<option value = "'.$service['WS_Service_ID'].'">'.$service['WS_Service_Name'].'</option>';
                           }
                          ?>
                      </select>
                    
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
                        <option><?php getTE('All');?></option>

                      <?php 
                      if(isset($sService['Maker_ID'])){
                        $makerID = $sService['Maker_ID'];

                        $sMakers = superGet('*','makes'," id = $makerID");
                        foreach ($sMakers as $sMaker) {
                          echo '<option value = "'.$sMaker['id'].'">'.$sMaker['Make_Name'].'</option>';
                        }
                      }
                      
                      
                      $makers = superGet('*','makes',"id != 0");
                      foreach ($makers as $maker) {
                          echo '<option value ="'.$maker['id'].'">' .$maker['Make_Name'] .'</option>';
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
                            
                      <?php 
                      if(isset($sService['Model_ID'])){
                        $modelID = $sService['Model_ID'];

                        $sModels = superGet('*','models'," id = $modelID");
                        foreach ($sModels as $sModel) {
                          echo '<option value = "'.$sModel['id'].'">'.$sModel['Model_Name'].'</option>';
                        }
                      }
                      ?>
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
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Time");?></label>
                  <div class="col-md-12">
                  <input  class=" form-control" type="number" step="0.01" min="0" name="time" required="required" value="<?php echo $sService['Expected_Time']; ?>">
                  </div>
                 </div>
            </div>

          <div class="col-md-3">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Cost");?></label>
                  <div class="col-md-12">
                  <input  class=" form-control" type="number" min="0" name="cost" required="required" step="0.01" value="<?php echo $sService['Price']; ?>">
                  </div>
                 </div>
            </div>

             <div class="col-md-2">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Currency");?></label>
                  <div class="col-md-12">

                  <select name="currencyid" class="form-control">
                    <?php 
                    echo '<option value = "'.$sService['Currency_ID'].'">'.$sService['Currency_Code'].'</option>';
                    $currencies = superGet('*','currencies',"Currency_Used = 1");
                    foreach ($currencies as $cur) {
                      echo '<option value="'.$cur['Currency_ID'].'">'.$cur['Currency_Code'].'</option>';
                     }
                    ?>
                    
                  </select>
                  </div>
                 </div>
               </div>
          
            </div>

        </div>
    </div>

    <div class="control-box">

              <div class="container">
              <p class="control-title"><?php echo $item['Item_Name'];?> <span class=""><i class="fas fa-cogs"></i></span></p>
              </div>

              <div class="">

              <div class="container ">

                <div class="col-md-5 ">
                  <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Tags");?></label>
                  <div class="col-md-12">
                  <input  class=" form-control" type="text"  name="tags"  value="<?php echo $item['Item_Tags']; ?>">
                  </div>
                 </div>
                </div>
              </div>

              <div class="container ">

                <div class="col-md-5 ">
                  <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                  <div class="col-md-12">
                  <input  class=" form-control" type="text"  name="link1"  value="<?php echo $item['Item_Link1']; ?>">
                  </div>
                 </div>
                </div>
                <div class="col-md-5 ">
                  <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Link to another site");?></label>
                  <div class="col-md-12">
                  <input  class=" form-control" type="text"  name="link2"  value="<?php echo $item['Item_Link2']; ?>">
                  </div>
                 </div>
                </div>

              </div>

              <div class="col-md-10">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Description");?></label>
                  <div class="col-md-12">
                    <textarea class=" form-control" type="number"  name="description" rows="4"><?php echo $sService['Item_Description']; ?></textarea>
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

  </div>
    <hr class="custom-hr">

                
    <?php
        }// if item is in DB and for this user

}elseif($do == 'update'){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

      $itemid = $_POST['itemid'];
      $user = $_SESSION['uid'];

      $items = getInnerItemWS("items.Item_ID = '$itemid' AND items.User_ID = '$user' ");
        foreach ($items as $item) {}

      $serviceID = $_POST['service']; 
      $makerID   = $_POST['maker']; 
      if(isset($_POST['model'])){$modelID = $_POST['model'];}else{$modelID = 0;}
      if(isset($_POST['model-text'])){$modelText = $_POST['model-text'];}else{$modelText = NULL;}
      $time        = $_POST['time'];
      $cost        = $_POST['cost'];
      $currency    = $_POST['currencyid'];
      
       $tags       = tSec(str_replace('.',',',str_replace('،',',',$_POST['tags'])));
      $link1        = tSec($_POST['link1']);
      $link2        = tSec($_POST['link2']);
      $description  = tSec($_POST['description']);

      $WSsItemID = $item['WS_Service_Item_ID'];
      $WSsItemSID = $item['WS_Services_Items_SP_ID']; 

      if (empty($makerID)){$allMakers = 1;}else{$allMakers = 0;}
      if (empty($modelID)){$allModels = 1;}else{$allModels = 0;}

    if (isset($_SESSION['ulang'])){
        $lang     = $_SESSION['ulang'];
      }else{$lang = $mLang;}

    // Get Service Name & MakerN to insert to Item Name
      // Get maker name
    if ($makerID != 0){
      $maks = superGet('Make_Name','makes',"id = $makerID");
      foreach ($maks as $mak) {}
       $makName = ' - '.$mak['Make_Name'];
    }else{$makName = NULL;}
   
    $servNames = superGet('*','ws_services_ml',"WS_Service_ID = $serviceID AND Lang_ID = 1");
    foreach ($servNames as $servName) {}
    $sServName = $servName['WS_Service_Name'] .$makName;

      $praxid   = 1;
     // $lang     = $mLang; //$_SESSION['ulang'];


      // Check if needed Variables are set 
      if ($serviceID == 0){
              $formErrors[] = getT('You must select the service');
              }

      if (empty($time)){
            $formErrors[] = getT('You must select the Time');
              }

      if (empty($cost)){
            $formErrors[] =  getT('You must select the cost');
              }

      if (empty($currency)){
                  $formErrors[] =  getT('You must select the currency');
              }

  if (empty($formErrors)){ 

    $stmt = $con->prepare("UPDATE items SET Item_Link1 = ?, Item_Link2 = ? WHERE Item_ID = ?");
        $stmt->execute(array($link1, $link2, $itemid )); 

    $stmt = $con->prepare("UPDATE items_ml SET Item_Name = ?, Item_Description = ?, Item_Tags = ? WHERE Item_ID = ?");
        $stmt->execute(array($sServName, $description, $tags, $itemid ));

    $stmt = $con->prepare("UPDATE ws_services_items SET   WS_Service_ID = ?, All_makers = ?, All_Models = ? WHERE WS_Service_Item_ID = ?");
        $stmt->execute(array( $serviceID, $allMakers, $allModels, $WSsItemID ));

    $stmt = $con->prepare("UPDATE ws_services_items_sp SET  Maker_ID = ?, Model_ID = ?, Model_Text = ?, Expected_Time = ?, Price = ?, Currency_ID = ? WHERE WS_Services_Items_SP_ID = ?");
        $stmt->execute(array($makerID ,$modelID , $modelText ,$time ,$cost ,$currency , $WSsItemSID));

      echo '<div>';
      $msg = '<div class= "alert alert-success">'.getT('The Item Updated Successfully').'</div>';
     redirectHome($msg,'manage_ws_items.php?itemid='.$itemid,2);
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
       redirectHome($msg,'manage_ws_items.php',2);

      } 
              

}elseif($do == 'new'){

  ?>

<h1 class="text-center"><?php getTE("Add New Service");?></h1>

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
                          $cats = getInnerCat("categories.Category_ID = $catID");
                          foreach ($cats as $cat) {}
                          ?>
                         <input type="hidden" name="icat" value="<?php echo $cat['Category_ID'];?>">
                         <?php //echo $cat['Category_Name'];?>
                      </div>
                  </div>

                  <input type="hidden" name="cat-id" value="<?php echo $catID; ?>">
                     
          <div class="form-group container">
                
          <div class="control-box">

              <div class="container">
              <p class="control-title"><?php getTE("Services");?> <span class=""><i class="fas fa-cogs"></i></span></p>
              </div>

              <div class="">

              <div class="container ">

                <div class="col-md-5 ">
                      <div class="form-group ">
                      <label class=" col-md-12 control-lable"><?php getTE("Select Service");?></label>
                      <div class=" col-md-12">
                          <select class="form-control "  name="service" required="required" >
                          <option value="0"> <?php getTE("Select Service");?></option>

                          <?php 
                          $services = getInnerServiceWS("Visible = 1");
                          foreach ($services as $service) {
                            echo '<option value = "'.$service['WS_Service_ID'].'">'.$service['WS_Service_Name'].'</option>';
                          }
                          ?>
                      </select>
                    
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

          <div class="col-md-5">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Time");?></label>
                  <div class="col-md-12">
                  <input  class=" form-control" type="number" step="0.01" min="0" name="time" required="required" >
                  </div>
                 </div>
            </div>

          <div class="col-md-3">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Cost");?></label>
                  <div class="col-md-12">
                  <input  class=" form-control" type="number" min="0" name="cost" required="required" step="0.01">
                  </div>
                 </div>
            </div>

             <div class="col-md-2">
                <div class="form-group container ">
                  <label class="col-md-12 control-lable"><?php getTE("Currency");?></label>
                  <div class="col-md-12">

                  <select name="currencyid" class="form-control">
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

</div>
    <hr class="custom-hr">

 <?php
}elseif ($do == 'insert') {

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $catID     = $_POST['cat-id'];
    $userID    = $_SESSION['uid'];
    $serviceID = $_POST['service'];
    $makerID   = $_POST['maker'];
    if(isset($_POST['model'])){$modelID = $_POST['model'];}else{$modelID = NULL;}
    if(isset($_POST['model-text'])){$modelText = $_POST['model-text'];}else{$modelText = NULL;}
    $time         = $_POST['time'];
    $cost         = $_POST['cost'];
    $currency     = $_POST['currencyid'];

     $tags        = tSec(str_replace('.',',',str_replace('،',',',$_POST['tags'])));
    $link1        = tSec($_POST['link1']);
    $link2        = tSec($_POST['link2']);
    $description  = tSec($_POST['description']);

    if (empty($makerID)){$allMakers = 1;}else{$allMakers = 0;}
    if (empty($modelID)){$allModels = 1;}else{$allModels = 0;}

    if (isset($_SESSION['ulang'])){
      $lang     = $_SESSION['ulang'];
    }else{$lang = $mLang;}

     // Get Service Name & MakerN to insert to Item Name
      // Get maker name
    if ($makerID != 0){
      $maks = superGet('Make_Name','makes',"id = $makerID");
      foreach ($maks as $mak) {}
       $makName = ' - '.$mak['Make_Name'];
    }else{$makName = NULL;}
   
    $servNames = superGet('*','ws_services_ml',"WS_Service_ID = $serviceID AND Lang_ID = 1");
    foreach ($servNames as $servName) {}
    $sServName = $servName['WS_Service_Name'] .$makName;
    
    ////////////////////
    $imageName = 'Workshops.png';
    $praxid    = 1;
    //$lang      = $mLang; //$_SESSION['ulang'];


    // Check if needed Variables are set 
    if ($serviceID == 0){
            $formErrors[] = getT('You must select the service');
            }

    if (empty($time)){
          $formErrors[] = getT('You must select the Time');
            }

    if (empty($cost)){
          $formErrors[] =  getT('You must select the cost');
            }

    if (empty($currency)){
                $formErrors[] =  getT('You must select the currency');
            }

  if (empty($formErrors)){

    $stmt = $con->prepare("INSERT INTO items(Main_Price,Praxis_ID, Category_ID, Currency_ID, User_ID, Item_Link1, Item_Link2)
                                VALUES(:zprice, :zpraxis,:zcatid, :zcurrncyid, :zuserid, :zlink1 , :zlink2)") ;
        $stmt->execute(array(
                        'zprice'          => $cost,
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
                                VALUES(:zitemid, :zlang, :ziname, :zdescription, :ztags)") ;
        $stmt->execute(array(
                        'zitemid'      => $lastID,
                        'zlang'        => $lang,
                        'ziname'       => $sServName,
                        'zdescription' => $description,
                        'ztags'        => $tags
                         ));

        $stmt = $con->prepare("INSERT INTO ws_services_items(Item_ID, WS_Service_ID, All_makers, All_Models)

                                VALUES(:zitemid, :zserviceid, :zallmaker, :zallmodels)") ;
        $stmt->execute(array(
                        'zitemid'     => $lastID,
                        'zserviceid'  => $serviceID,
                        'zallmaker'   => $allMakers,
                        'zallmodels'  => $allModels
                         ));


        $stmt = $con->prepare("INSERT INTO ws_services_items_sp(WS_Service_Item_ID, Maker_ID, Model_ID, Model_Text, Expected_Time, Price, Currency_ID)

                                VALUES(LAST_INSERT_ID(), :zmakerid, :zmodelid, :zmodelt,:zetime, :zprice, :zcurrncyid)") ;
        $stmt->execute(array(
                        'zmakerid'   => $makerID,
                        'zmodelid'   => $modelID,
                        'zmodelt'    => $modelText,
                        'zetime'     => $time,
                        'zprice'     => $cost,
                        'zcurrncyid' => $currency
                         ));

     echo '<div class="container">';
        $msg = '<div class="alert alert-success">'.getT('The Item Updated Successfully').'</div>';

        $link = 'manage_ws_items.php?do=preview&itemid='.$lastID;
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

/*
                    $stmt = $con->prepare("DELETE FROM locations_text WHERE Location_ID = :zlocid");
                    $stmt->bindParam(":zlocid", $locTextID);
                    $stmt->execute();

     */           

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

            

        }else{ // End the do possibles
          $theMsg = getT('Fauls Request');
            redirectHome($theMsg,'manage_ws_items.php',1);
            }
        
}else{ // if user not registed (First if)
     $theMsg = '<div class="container"><div class="alert alert-danger"> '.getT('Sorry, You are not resisted').' </div></div>' ;

    redirectHome($theMsg,'index.php',2);

} 
?>
<!--
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
  -->
<?php

include  $tpl."footer.php";
?>