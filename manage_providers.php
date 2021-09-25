<?php 
ob_start();

session_start();

if(isset($_SESSION['user'])){

    $pageTitle = 'Manage Providers Informations';
  
    include 'init.php';

    $user = $_SESSION['uid'];
    // Check if the user ist registed in correct id 
    $users = superGet('*','users',"User_ID = $user");
    if (!empty($users)){

        $do = isset($_GET['do']) ? $_GET['do'] : 'preview';

        if($do == 'preview'){  // preview page 
            $userid = $_SESSION['uid'];

            $proveiders = getInnerProvider("users.User_ID = $userid");
              if (!empty($proveiders)) { // if user is provider 
              
            foreach ($proveiders as $pro) {}
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
                                    <li><label><?php getTE('User Name');?> : </label><span><?php echo $pro['User_Name'];?></span></li>
                                     <li><label><?php getTE('Full Name');?> :</label><span><?php echo $pro['Full_Name'];?></span></li>
                                    <li><label><?php getTE('Email');?> :</label><span><?php echo $pro['Email'];?></span></li>
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
                                     if($pro['Provider_Type'] == 2){ ?>

                                    
                                            <li><label><?php getTE('Contact Person');?> :</label><span><?php if(isset($pro['Contact_Person'])){ echo $pro['Contact_Person'];}?></span></li>
                                            <li><label><?php getTE('About Provider');?> :</label><span><?php if(isset($pro['About_Pro'])){ echo $pro['About_Pro'];}?></span></li>
                                            <li><label><?php getTE('Provider Service');?> :</label><span><?php if(isset($pro['Pro_Services'])){ echo $pro['Pro_Services'];}?></span></li>
                                
                                        <?php
                                     }
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
                                         
                                     </div>
 
                                    <?php } // END IS Set?>
                                    
                                </div>
                            </div>
                        </div>
                   
                    
                </div>

                <div class="form-btn">
                    <?php 
                    $pros = getInnerProvider("users.User_ID = $userid");
                    foreach ($pros as $p) {}
                      
                    if ($p['Provider_Type'] == 1){
                        echo '<a class="btn btn-success"  href="manage_providers.php?do=edit-p-p&proid='.$pro['Provider_ID'].'">'.getT('Edit').'</a>';
                    }elseif($p['Provider_Type'] == 2){
                        echo '<a class="btn btn-success"  href="manage_providers.php?do=edit-c-p&proid='.$pro['Provider_ID'].'">'.getT('Edit').'</a>';
                    }
                    ?>

                    <a href="select_category.php" class="btn btn-primary"><?php getTE("New Item");?></a>
            </div>

         </div>
            <?php
        }else { // If provider is not empty (exist als provider not just user )
            getTE('You are not Provider');
        }

    }elseif($do == 'select') {

        $userid = $_SESSION['uid'];
        $users = superGet ('*','users',"User_ID = $userid");// Just to add Name
        foreach ($users as $user) {}




        ?>
     
        <h3><?php echo getT('Dear') .' '. $user['User_Name'].' '. getT('you must to complete your profile before selling items');?></h3>

        

        <div class="container">
            <div class="row">
                <div class="col col-md-4">
                    <div class="select-pro-box control-box">
                        <a href="<?php echo $_SERVER['PHP_SELF'];?>?do=new-p-pro&protype=1">
                        <label><?php getTE('Personal Provider');?></label>
                        <span class=""><i class="fa fa-user" aria-hidden="true"></i></span>
                        <p><?php getTE('For Normal persons');?></p>
                        </a>
                        
                    </div>
                    
                </div>

                <div class="col col-md-4">
                    <div class="select-pro-box control-box">
                        <a href="<?php echo $_SERVER['PHP_SELF'];?>?do=new-c-pro&protype=2">
                        <label><?php getTE('Companies Provider');?></label>
                        <span><i class="fa fa-users" aria-hidden="true"></i></span>
                        <p><?php getTE('For Companies');?></p>
                        </a>
                        
                    </div>
                    
                </div>
            </div>
            
        </div>

        <?php

    }elseif($do == 'new-c-pro') {

        $userid = $_SESSION['uid'];
        if(isset($_GET['protype'])){$proType = $_GET['protype'];}else{$proType = 0 ;}
        
        $users = superGet ('*','users',"User_ID = $userid");
        foreach ($users as $user) {}


       ?>


<div class="container">

    <h2>  <?php echo getT('Providers Informations').' '. $user['Full_Name']; ?></h2>
  
            <form action="<?php echo $_SERVER['PHP_SELF'];?>?do=insert&userid=<?php echo $userid?>" method="POST">

                <input type="hidden" name="pro-type" value="<?php echo $proType?>">

                <div class="row">
                    <div class="col col-md-5">
                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Company Name');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="pname" required="required" value="<?php echo $user['Full_Name'] ;?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Contact Person');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="cperson" required="required">
                            </div>
                        </div>
                        <div class="form-group container">
                                 <label class="col-md-5 control-lable"><?php getTE('Phone');?></label>
                            <div class="col-md-7">
                                <input class="form-control " type="text"  name="pnummer">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Fax');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="fnummer">
                            </div>
                        </div>

                         <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('About Provider');?></label>
                            <div class="col-md-7">
                              
                                <textarea class="form-control"  name="about-p" required="required" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Providers Services');?></label>
                            <div class="col-md-7">
                                <textarea class="form-control"  name="p-services" required="required" rows="5"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-5">
                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Country');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="country" required="required">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Region');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="region">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('City');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="city" required="required">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Zip Code');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="zip" >
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Street');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="street" >
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('House number');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="hnummer" >
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Address Notes');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="addnote">
                            </div>
                        </div>
                        
                    </div>
                </div>


                          
                       

                        <div class="form-btn">
                            <input class="btn btn-red" type="submit" value="<?php getTE('Save'); ?>">
                        </div>
                    </form>
               
    </div>
         
       <?php

    }elseif($do == 'new-p-pro') {


        $userid = $_SESSION['uid'];
        if(isset($_GET['protype'])){$proType = $_GET['protype'];}else{$proType = 0 ;}

        $users = superGet ('*','users',"User_ID = $userid");// Just to add Name
        foreach ($users as $user) {}
            
       ?>


<div class="container">

    <h2> <?php getTE('Providers Informations');?> <?php echo $user['Full_Name'];?> </h2>
    
            <form action="<?php echo $_SERVER['PHP_SELF'];?>?do=insert&userid=<?php echo $userid?>" method="POST">

                <input type="hidden" name="pro-type" value="<?php echo $proType?>">

                <div class="row">
                    <div class="col col-md-5">

                 <div class="form-group container">
                        <label class="col-md-5 control-lable"><?php getTE('Provider Name');?></label>
                    <div class="col-md-7">
                        <input class="form-control" type="text"  name="pname" required="required" min="2" value="<?php echo $user['Full_Name'] ;?>">
                    </div>
                </div>

                 
                <div class="form-group container">
                         <label class="col-md-5 control-lable"><?php getTE('Phone');?></label>
                    <div class="col-md-7">
                        <input class="form-control " type="text"  name="pnummer">
                    </div>
                </div>

                <div class="form-group container">
                    <label class="col-md-5 control-lable"><?php getTE('Fax');?></label>
                    <div class=" col-md-7">
                        <input class="form-control" type="text"  name="fnummer">
                    </div>
                </div>

            </div>

            <div class="col-md-5">
                <div class="form-group container">
                    <label class="col-md-4 control-lable"><?php getTE('Country');?></label>
                    <div class="col-sm-10 col-md-7">
                        <input class="form-control" type="text"  name="country" required="required">
                    </div>
                </div>

                <div class="form-group container">
                    <label class="col-md-4 control-lable"><?php getTE('Region');?></label>
                    <div class="col-sm-10 col-md-7">
                        <input class="form-control" type="text"  name="region">
                    </div>
                </div>

                <div class="form-group container">
                    <label class="col-md-4 control-lable"><?php getTE('City');?></label>
                    <div class="col-sm-10 col-md-7">
                        <input class="form-control" type="text"  name="city" required="required">
                    </div>
                </div>

                <div class="form-group container">
                    <label class="col-md-4 control-lable"><?php getTE('Zip Code');?></label>
                    <div class="col-sm-10 col-md-7">
                        <input class="form-control" type="text"  name="zip" >
                    </div>
                </div>

                <div class="form-group container">
                    <label class="col-md-4 control-lable"><?php getTE('Street');?></label>
                    <div class="col-sm-10 col-md-7">
                        <input class="form-control" type="text"  name="street" >
                    </div>
                </div>

                <div class="form-group container">
                    <label class="col-md-4 control-lable"><?php getTE('House number');?></label>
                    <div class="col-sm-10 col-md-7">
                        <input class="form-control" type="text"  name="hnummer" >
                    </div>
                </div>

                <div class="form-group container">
                    <label class="col-md-4 control-lable"><?php getTE('Address Notes');?></label>
                    <div class="col-sm-10 col-md-7">
                        <input class="form-control" type="text"  name="addnote">
                    </div>
                </div>


                
            </div>
        </div>



                <div class="form-btn">
                    <input class="btn btn-red" type="submit" value="<?php getTE('Save');?>">
                </div>

            </form>
                 
    </div>
         
       <?php

    }elseif($do == 'edit-p-p') {
         // Get Pro ID
        $userID = $_SESSION['uid'];
        $providers = getInnerProvider("users.User_ID = $userID");

        foreach ($providers as $pro) {}
            $proID = $pro['Provider_ID'];

            // GET ´Provides Location details

            $locID = $pro['Location_ID'];
            $locs = superGet('*','locations_text',"Location_ID = $locID");
            foreach ($locs as $loc) {}
                                    
        ?>
<div class="container">
    <div class="row">

        <div class="container">
            <div class="profile-head" styleX="background-image: url('images/profiles/<?php echo $pro['User_back_image'];?>'); width: 100%;">
                <img class="profile-back-img" src="images/profiles/<?php echo $pro['User_back_image'];?>">
                
            </div>
            <div class="edit-back-photo-btn">
                    <a href="manage_providers.php?do=add_back_Photo&userid=<?php echo $pro['User_ID'] ?>"><i class="far fa-image fa-3x"></i></a>
                    <span class="icon-details"><?php getTE('Change the background image');?></span>
                    </div>
            </div>

            <div class="profile-head-info">
                            
                <div class="profile-title"> <?php echo $pro['Full_Name']?></div>
                    <img class="head-user-img" src="images/profiles/<?php echo $pro['User_Image'] ?>">
                    <div class="edit-photo-btn">
                    <a  href="manage_providers.php?do=add_Photo&userid=<?php echo $pro['User_ID'] ?>"><i class="far fa-address-card fa-2x"></i></a>
                    <span class="icon-details"><?php getTE('Change Profile Photo');?></span>
                    </div>
                </div>
        </div>
  </div>


<div class="container pro-info">
    <h2> <?php getTE('Providers Informations');?></h2>

                    <form action="<?php echo $_SERVER['PHP_SELF'];?>?do=update&proid=<?php echo $proID?>" method="POST">

                        <div class="row">

                        <div class="col col-md-5">

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Provider Name');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="pname" required="required" value="<?php echo $pro['Provider_Name'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                                 <label class="col-md-5 control-lable"><?php getTE('Phone');?></label>
                            <div class=" col-md-7">
                                <input class="form-control " type="text"  name="pnummer"value="<?php echo $pro['Provider_Phone'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Fax');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="fnummer" value="<?php echo $pro['Provider_Fax'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Email');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="email" value="<?php echo $pro['Email'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Website');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="web" value="<?php echo $pro['User_Web'];?>">
                            </div>
                        </div>

                        </div>
                        <div class="col col-md-5">
                            <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Country');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="country" required="required" value="<?php echo $pro['Country'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Region');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="region" value="<?php echo $pro['Region'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('City');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="city" required="required" value="<?php echo $pro['City'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Zip Code');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="zip" value="<?php echo $pro['Zip'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Street');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="street" value="<?php echo $pro['Street'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('House number');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="hnummer" value="<?php echo $pro['Haus_N'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Address Notes');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="addnote" value="<?php echo $pro['Loc_Note'];?>">
                            </div>
                        </div>

                        <hr>

                         <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('User Name');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="user-name" readonly value="<?php echo $pro['User_Name'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('language');?></label>
                            <div class=" col-md-7">
                               <select class="form-control" name="language">
                                <?php 
                                // Get selected Lang Name
                                $langID = $pro['Select_Lang'];
                                $langs = superGet('*','languages',"Lang_ID = $langID");
                                foreach($langs as $lang){}
                                echo '<option value ="'.$lang['Lang_ID'].'">'.$lang['Lang_Name'].'</option>';
                              // Get Other Languages
                                $oLangs = superGet('*','languages',"Lang_ID != 1 AND Lang_Used = 1");
                                foreach($oLangs as $oLang){
                                    echo '<option value ="'.$oLang['Lang_ID'].'">'.$oLang['Lang_Name'].'</option>';
                                }
                                ?>
                                   
                               </select>
                            </div>
                        </div>
                            
                            
                        </div>
                        </div>

   


                        <div class="form-btn">
                            <input class="btn btn-red " type="submit" value="<?php getTE('Save');?>">
                        </div>

                    </form>
                
        </div>

        <?php

}elseif($do == 'edit-c-p') {
       // Get Pro ID
        $userID = $_SESSION['uid'];
        $providers = getInnerProvider("users.User_ID = $userID");

        foreach ($providers as $pro) {}

            $proID = $pro['Provider_ID'];

            // GET ´Provides Location details

            $locID = $pro['Location_ID'];
            $locs = superGet('*','locations_text',"Location_ID = $locID");
            foreach ($locs as $loc) {}
                                    
        ?>
<div class="container">
    <div class="row">

        <div class="container">
            <div class="profile-head" styleX="background-image: url('images/profiles/<?php echo $pro['User_back_image'];?>'); width: 100%;">
                <img class="profile-back-img" src="images/profiles/<?php echo $pro['User_back_image'];?>">
                
            </div>
            <div class="edit-back-photo-btn">
                    <a href="manage_providers.php?do=add_back_Photo&userid=<?php echo $pro['User_ID'] ?>"><i class="far fa-image fa-3x"></i></a>
                    <span class="icon-details"><?php getTE('Change the background image');?></span>
                    </div>
            </div>

            <div class="profile-head-info">
                            
                <div class="profile-title"> <?php echo $pro['Full_Name']?></div>
                    <img class="head-user-img" src="images/profiles/<?php echo $pro['User_Image'] ?>">
                    <div class="edit-photo-btn">
                    <a  href="manage_providers.php?do=add_Photo&userid=<?php echo $pro['User_ID'] ?>"><i class="far fa-address-card fa-2x"></i></a>
                    <span class="icon-details"><?php getTE('Change Profile Photo');?></span>
                    </div>
                </div>
        </div>
  </div>


<div class="container pro-info">
    <h2 > <?php getTE('Providers Informations');?></h2>
  
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>?do=update&proid=<?php echo $proID?>" method="POST">

                        <div class="row">
                        <div class="col-md-5">
                            <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Company Name');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="pname" required="required" value="<?php echo $pro['Provider_Name'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Contact Person');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="cperson" value="<?php echo $pro['Contact_Person'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                                 <label class="col-md-5 control-lable"><?php getTE('Phone');?></label>
                            <div class="col-md-7">
                                <input class="form-control " type="text"  name="pnummer" value="<?php echo $pro['Provider_Phone'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Fax');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="fnummer" value="<?php echo $pro['Provider_Fax'];?>">
                            </div>
                        </div>

                         <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Email');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="email" value="<?php echo $pro['Email'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Website');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="web" value="<?php echo $pro['User_Web'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('About Provider');?></label>
                            <div class=" col-md-7">
                                <textarea class="form-control"  name="about-p" rows="5"><?php echo $pro['About_Pro'];?></textarea>
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Providers Services');?></label>
                            <div class="col-md-7">
                                <textarea class="form-control" name="p-services" rows="5"><?php echo $pro['Pro_Services'];?></textarea>
                            </div> 
                        </div>

                            
                        </div>

                        <div class="col-md-5">
                            <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Country');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="country" required="required" value="<?php echo $loc['Country'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Region');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="region" value="<?php echo $loc['Region'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('City');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="city" required="required" value="<?php echo $loc['City'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Zip Code');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="zip" required="required" value="<?php echo $loc['Zip'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Street');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="street" required="required" value="<?php echo $loc['Street'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('House number');?></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text"  name="hnummer" required="required" value="<?php echo $loc['Haus_N'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('Address Notes');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="addnote" value="<?php echo $loc['Loc_Note'];?>">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('User Name');?></label>
                            <div class=" col-md-7">
                                <input class="form-control" type="text"  name="user-name" readonly value="<?php echo $pro['User_Name'];?>">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-md-5 control-lable"><?php getTE('language');?></label>
                            <div class=" col-md-7">
                               <select class="form-control" name="language">
                                <?php 
                                // Get selected Lang Name
                                $langID = $pro['Select_Lang'];
                                $langs = superGet('*','languages',"Lang_ID = $langID ");
                                foreach($langs as $lang){}
                                echo '<option value ="'.$lang['Lang_ID'].'">'.$lang['Lang_Name'].'</option>';
                              // Get Other Languages
                                $oLangs = superGet('*','languages',"Lang_ID != 1 AND Lang_Used = 1");
                                foreach($oLangs as $oLang){
                                    echo '<option value ="'.$oLang['Lang_ID'].'">'.$oLang['Lang_Name'].'</option>';
                                }
                                ?>
                                   
                               </select>
                            </div>
                        </div>

                            
                        </div>  

                        </div>


                        <div class="form-btn">
                            <input class="btn btn-red" type="submit" value="<?php getTE('Save');?>">
                        </div>
                    </form>
                
    </div>

        <?php

    }elseif($do == 'insert') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 

        $userid  = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

        $users = superGet('*','users',"User_ID = $userid");
        foreach ($users as $user) {} 

           
        $pName     =  tSec($_POST['pname']);
        if(isset($_POST['cperson'])){$cperson = tSec($_POST['cperson']);}else{$cperson = NULL;}
        if(isset($_POST['about-p'])){$aboutP  =  tSec($_POST['about-p']);}else{$aboutP = NULL;}
        if(isset($_POST['p-services'])){$pService = tSec($_POST['p-services']);}else{$pService = NULL;}

        
        $uFon      =  tSec($_POST['pnummer']);
        $ufax      =  tSec($_POST['fnummer']);
        
        //$locID     = $user['Location_ID'];
        if(isset($_POST['Location_ID'])){$locID = $_POST['Location_ID'];}else{$locID = NULL;}

        $country   = tSec($_POST['country']);
        $region    = tSec($_POST['region']);
        $city      = tSec($_POST['city']);
        $zip       = tSec($_POST['zip']);
        $street    = tSec($_POST['street']);
        $hausNum   = tSec($_POST['hnummer']);
        $addNot    = tSec($_POST['addnote']);

        $proType     = $_POST['pro-type'];

        $pLang     = $mLang ;

       


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

       

             $stmt = $con->prepare("INSERT INTO providers(User_ID, Provider_Phone, Provider_Fax,Provider_Type , Location_ID)
                                VALUES(:userid, :zpphone, :zpfax, :zprotypr, LAST_INSERT_ID() )") ;
             $stmt->execute(array(
                            'userid'      => $userid,
                            'zpphone'     => $uFon,
                            'zprotypr'    => $proType,
                            'zpfax'       => $ufax
                             ));


             $stmt = $con->prepare("INSERT INTO providers_ml(Provider_ID, Provider_Name, Contact_Person, About_Pro, Pro_Services, Lang_ID)
                                VALUES( LAST_INSERT_ID(), :zproname, :zprocontact, :zabout,:zservice ,:zlang )") ;
             $stmt->execute(array(
                            'zproname'      => $pName,
                            'zprocontact'   => $cperson,
                            'zabout'        => $aboutP,
                            'zservice'      => $pService,
                            'zlang'         => $pLang
                             ));



    }// end if server is post
    $link = 'manage_providers.php?userid='.$userid;
    redirectHome('',$link,1);

        

    }elseif($do == 'update') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 

         $proid = isset($_GET['proid']) && is_numeric($_GET['proid']) ? intval($_GET['proid']) : 0;

         //$users = superGet('*','users'."User_ID = $proid");

         $providers = getInnerProvider("providers.Provider_ID = $proid");
         foreach ($providers as $provider) {}

        $pName     =  tSec($_POST['pname']);
        $cperson   =  tSec($_POST['cperson']);
        $aboutP    =  tSec($_POST['about-p']);
        $pService  =  tSec($_POST['p-services']);
        $uFon      =  tSec($_POST['pnummer']);
        $ufax      =  tSec($_POST['fnummer']);
       // $uName     =  tSec($_POST['user-name']);

        $uEmail    =  tSec($_POST['email']);
        $uWeb      =  tSec($_POST['web']);

        $country   = tSec($_POST['country']);
        $region    = tSec($_POST['region']);
        $city      = tSec($_POST['city']);
        $zip       = tSec($_POST['zip']);
        $street    = tSec($_POST['street']);
        $hausNum  = tSec($_POST['hnummer']);
        $addNot    = tSec($_POST['addnote']);

        $pLang     = $_POST['language']; 
  

        $userID    = $provider['User_ID'];
        $pID       = $provider['Provider_ID'];
        $locID     = $provider['Location_ID'];

          



        $stmt = $con->prepare("UPDATE users SET  Full_Name = ?, Email = ?, User_Web = ?, Select_Lang = ? WHERE User_ID = ?") ;
        $stmt->execute(array( $pName, $uEmail, $uWeb, $pLang , $userID )); 

        $stmt = $con->prepare("UPDATE providers SET Provider_Phone = ?,Provider_Fax = ?  WHERE User_ID = ?") ;
        $stmt->execute(array($uFon, $ufax, $userID));

        $stmt = $con->prepare("UPDATE providers_ml SET Provider_Name = ?,Contact_Person = ?, About_Pro = ?, Pro_Services = ?  WHERE Provider_ID = ?") ;
        $stmt->execute(array($pName, $cperson, $aboutP, $pService, $pID));

          //Set   Location with Lat Lon
        $address = $street.' '.$hausNum.''.$zip.''. $city .' '. $region.' '.$country;

        $geoLoc = getGeoLoc($address);
        $lat = $geoLoc['lat'];
        $lon = $geoLoc['lng'];


        $stmt = $con->prepare("UPDATE locations_text SET Country = ?,Region = ?,  City = ?, Zip = ?,Street = ?, Haus_N = ?, Loc_Note = ?, Latitude = ?, Longitude = ? WHERE Location_ID = ?") ;
        $stmt->execute(array($country, $region, $city, $zip, $street, $hausNum, $addNot, $lat, $lon , $locID));
      


        header('Location: manage_providers.php?do=preview&proid='.$proid);

            } 
}elseif ($do == 'add_Photo') {

    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        ?>
         <div class="container">
            <h2><?php getTE('Photos');?></h2>
            <div class="row">

            <form action="manage_providers.php?do=insert_photo&userid=<?php echo $userid;?>" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control" type="file"  name="image">
                    </div>
                    <div class="col-sm-10 col-md-4 ">
                    <input class="btn btn-red"  type="submit" value="<?php getTE('Add Photo');?>" >
                    </div>

                </div>
            </form>
<!--
            <div class="form-group ">
                <a class="btn btn-success" href="profile.php"><?php getTE('profile page');?></a>
              </div>
-->

            </div>
        </div>



    <?php
}elseif ($do == 'add_back_Photo') {

     $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        ?>
         <div class="container">
            <h2><?php getTE('Photos');?></h2>
            <div class="row">

            <form action="manage_providers.php?do=insert_back_photo&userid=<?php echo $userid;?>" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control" type="file"  name="image">
                    </div>
                    <div class="col-sm-10 col-md-4 ">
                    <input class="btn btn-red"  type="submit" value="<?php getTE('Add Photo');?>" >
                    </div>

                </div>
            </form>
<!--
            <div class="form-group ">
                <a class="btn btn-success" href="profile.php"><?php getTE('profile page');?></a>
              </div>
-->

            </div>
        </div>



    <?php


        // Add Photos Section 
           // Get Item Images from the DB 
}elseif($do == 'insert_photo'){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $proid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
           
            $user = $_SESSION['uid'];

  
        addFile('images/profiles/','image');
        $img =  $file;
 
        $stmt = $con->prepare("UPDATE users SET User_Image = ? WHERE User_ID = ?") ;
        $stmt->execute(array($img, $proid ));

        header('Location: manage_providers.php?do=preview&proid='.$proid);

         }else{
                echo '<br> <div class="container"><div class="alert alert-danger">There is no Providerin this Details </div></div>' ;
            } 


}elseif($do == 'insert_back_photo'){

     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $proid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
           
            $user = $_SESSION['uid'];

  
        addFile('images/profiles/','image');
        $img =  $file;
 
        $stmt = $con->prepare("UPDATE users SET User_back_image = ? WHERE User_ID = ?") ;
        $stmt->execute(array($img, $proid ));

        header('Location: manage_providers.php?do=preview&proid='.$proid);

         }else{
                echo '<br> <div class="container"><div class="alert alert-danger">There is no Providerin this Details </div></div>' ;
            } 



     }// ElesIf setuations

  }// End of if user registed
} // End if the is Session


include  $tpl . "footer.php";
?>