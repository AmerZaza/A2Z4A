<?php 
ob_start();
session_start();

if(isset($_SESSION['user'])){

    $pageTitle = 'Manage User Profile';
  
    include 'init.php';

    $user = $_SESSION['uid'];
    // Check if the user ist registed in correct id 
    $users = superGet('*','users',"User_ID = $user");
    if (!empty($users)){

        $do = isset($_GET['do']) ? $_GET['do'] : 'preview';

        if($do == 'preview'){  // preview page 
            $userid = $_SESSION['uid'];

            $users = superGet('*','users',"users.User_ID = $userid");
         
            foreach ($users as $user) {}

            // Get Language name
                $langID = $user['Select_Lang'];
                $langs = superGet('*','languages',"Lang_ID = $langID");
                foreach ($langs as $lang) {}
                
            ?>
            <div>

        <div class="container">
        <div class="row">
            <div class="col col-md-12">
                <div class="container">
                    <div class="profile-head">
                        <img class="profile-back-img" src="images/profiles/<?php echo $user['User_back_image'];?>">
                    </div>
                    <div class="profile-head-info">
                            
                        <div class="profile-title"> <?php echo $user['Full_Name']?></div>
                             <img class="head-user-img" src="images/profiles/<?php echo $user['User_Image'] ?>">
                        </div>
                    </div>

                        <div class="container user-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul>
                                        <li><label><?php getTE('User Name');?> : </label><span><?php echo $user['User_Name'];?></span></li>
                                        <li><label><?php getTE('Full Name');?> :</label><span><?php echo $user['Full_Name'];?></span></li>
                                        <li><label><?php getTE('Email');?> :</label><span><?php echo $user['Email'];?></span></li>
                                        <li><label><?php getTE('Website');?> :</label><span><?php echo $user['User_Web'];?></span></li>

                                        <li><label><?php getTE('Language');?> : </label><span><?php echo $lang['Lang_Name'];?></span></li>
                                       
                                        <li><label><?php getTE('Regist Date');?> :</label><span><?php echo $user['Regis_Time'];?></span></li>
                                    </ul>
         
                                </div>
<!--
                                <div class="col-md-6">
                                    <?php 
                                    $userLoc = $user['U_Location_ID'];
                                    if(isset($userLoc)){
                                    $areas = superGet('*','locations_text', "Location_ID = $userLoc");
                                    foreach ($areas as $area) {}
                                    ?>
                                     <ul>
                                        <li><label><?php getTE('Country');?> :</label><span><?php if(isset($area['Country'])){ echo $area['Country'];}?></span></li>
                                        <li><label><?php getTE('Region');?> :</label><span><?php if(isset($area['Region'])){echo $area['Region'];} ?></span></li>
                                        <li><label><?php getTE('City');?> :</label><span><?php if(isset($area['City'])){ echo $area['City'];}?></span></li>
                                        <li><label><?php getTE('Street');?> :</label><span><?php if(isset($area['Street'])){ echo $area['Street'];}?></span></li>
                                        <li><label><?php getTE('Haus Nummer');?> :</label><span><?php if(isset($area['Haus_N'])){ echo $area['Haus_N'];}?></span></li>
                                        <li><label><?php getTE('Address');?> :</label><span><?php if(isset($area['Loc_Note'])){ echo $area['Loc_Note'];}?></span></li>
                                     </ul>
 
                                    <?php } // END IS Set?>
                                    
                                </div>
          -->
                            </div>
                        </div>


                    
                </div>
     
                
                <!--
                <a href="manage_users.php?do=edit&userid=<?php echo $user['User_ID'];?>" class="btn btn-primary edit-btn">Edit Provider</a> -->
                
                
                 <!-- Add Profile Photo -->
      
        </div>
    </div>


                <div class="form-btn"> 
                    <a class="btn btn-red " href="manage_users.php?do=edit&userid=<?php echo $user['User_ID'] ?>"><?php getTE('Edit Profile');?></a>
                </div>

               
            </div>
            <?php
     
        
    }elseif($do == 'new') {

        $userid = $_SESSION['uid'];
        $users = superGet ('Full_Name','users',"User_ID = $userid");// Just to add Name
        foreach ($users as $user) {}

       ?>

<h3> <?php getTE('Dear');?> <?php echo $user['Full_Name'];?> <?php getTE('you must to compleat your profile before selling items');?>  </h3>

<div class="container">
    <div class="row">
         
        
        <div class="col-md-9 item-info">
            

                 <div class="">
                    <form action="manage_users.php?do=insert&userid=<?php echo $userid?>" method="POST">

                          <div class="form-group container">
                            <label class="col-sm-2 control-lable"><?php getTE('Provider Name');?></label>
                            <div class="col-sm-10 col-md-4">
                                <input class="form-control" type="text"  name="pname" required="required">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-sm-2 control-lable"><?php getTE('Contact Person');?></label>
                            <div class="col-sm-10 col-md-4">
                                <input class="form-control" type="text"  name="cperson">
                            </div>
                        </div>
                        <div class="form-group container">
                                 <label class="col-sm-2 control-lable"><?php getTE('Phone');?></label>
                            <div class="col-sm-10 col-md-4">
                                <input class="form-control " type="text"  name="pnummer">
                            </div>
                        </div>

                        <div class="form-group container">
                            <label class="col-sm-2 control-lable"><?php getTE('Fax');?></label>
                            <div class="col-sm-10 col-md-4">
                                <input class="form-control" type="text"  name="fnummer">
                            </div>
                        </div>

                        <div class="form-btn">
                            <input class="btn btn-red" type="submit" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
         
       <?php

    }elseif($do == 'insert') {

         $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

          if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $proName  =  $_POST['pname'];
            $cPerson  =  $_POST['cperson'];
            $phone    =  $_POST['pnummer'];
            $fax      =  $_POST['fnummer'];
            $langID   =  $_SESSION['ulang'];

                 $stmt = $con->prepare("INSERT INTO providers(User_ID, Provider_Phone, Provider_Fax)
                                VALUES(:zuser, :zphone, :zfax)") ;
                 $stmt->execute(array(
                        'zuser'      => $userid,
                        'zphone'     => $phone,
                        'zfax'       => $fax
                        
                         ));

                  $stmt = $con->prepare("INSERT INTO providers_ml(Provider_ID, Provider_Name, Contact_Person,Lang_ID)
                                VALUES(LAST_INSERT_ID(), :zpname, :zcontacz, :zlang)") ;
                 $stmt->execute(array(
                        'zpname'      => $proName,
                        'zcontacz'    => $cPerson,
                        'zlang'       => $langID
                        
                         ));
       


             $msg = '<div class="alert alert-success">'.getT('Your Data inserted Successfully ').'</div>';
            redirectHome($msg);

          }else{
            $msg = '<div claee="alert-danger">'.getT('Sorry, You are not resisted').'</div>';
            redirectHome($msg,'index.php',3);

          }

    }elseif($do == 'edit') {

        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        $users = superGet('*','users',"User_ID = $userid");
        foreach ($users as $user) {}
        ?>

<div class="container">
    <div class="row">

        <div class="container">
            <div class="profile-head">
                <img class="profile-back-img" src="images/profiles/<?php echo $user['User_back_image'];?>">
                
            </div>
            <div class="edit-back-photo-btn">
                    <a href="manage_users.php?do=add_back_Photo&userid=<?php echo $user['User_ID'] ?>"><i class="far fa-image fa-3x"></i></a>
                    <span class="icon-details"><?php getTE('Change the background image');?></span>
                </div>

            <div class="profile-head-info">
                            
                <div class="profile-title"> <?php echo $user['Full_Name']?></div>
                    <img class="head-user-img" src="images/profiles/<?php echo $user['User_Image'] ?>">
                    <div class="edit-photo-btn">
                    <a  href="manage_users.php?do=add_Photo&userid=<?php echo $user['User_ID'] ?>"><i class="far fa-address-card fa-2x"></i></a>
                    <span class="icon-details"><?php getTE('Change Profile Photo');?></span>
                    </div>
                </div>
        </div>

       
         <div class="col-md-9 ">  
            <div class="user-details">
                <form action="manage_users.php?do=update&userid=<?php echo $user['User_ID'];?>" method="POST">
                  

                    <div class="form-group container">
                        <label class="col-sm-2 control-lable"><?php getTE('Full Name');?></label>
                        <div class="col-sm-10 col-md-4">
                            <input class="form-control " type="text" name="ufull" value="<?php echo $user['Full_Name'];?>">
                        </div>
                    </div>

                    <div class="form-group container">
                        <label class="col-sm-2 control-lable"><?php getTE('Email');?></label>
                        <div class="col-sm-10 col-md-4">
                            <input class="form-control " type="text" name="uemail" value="<?php echo $user['Email'];?>">
                        </div>
                    </div>

                    <div class="form-group container">
                        <label class="col-sm-2 control-lable"><?php getTE('Website');?></label>
                        <div class="col-sm-10 col-md-4">
                            <input class="form-control " type="text" name="usite" value="<?php echo $user['User_Web'];?>">
                        </div>
                    </div>
                    <!--
                    <div class="form-group container">
                        <label class="col-sm-2 control-lable">Location</label>
                        <div class="col-sm-10 col-md-4">
                            <input class="form-control " type="text" name="uloc" value="<?php echo $user['U_Location_ID'];?>">
                        </div>
                    </div>
                        -->
                    <div class="form-group container">
                        <label class="col-sm-2 control-lable"><?php getTE('Language');?></label>
                        <div class="col-sm-10 col-md-4">
                            <select class="form-control" name="ulang">
                                <?php 
                                $langid = $user['Select_Lang'];
                                $Langs = superGet('*','languages',"Lang_ID = $langid");
                                foreach ($Langs as $Lang) { }
                               // Get Selected language
                              echo '<option value="'. $Lang['Lang_ID'].'">'.$Lang['Lang_Name'].'</option>';
                              // Get other languages to select
                               $languages = superGet('*','languages',"Lang_ID != 1 AND Lang_Used = 1");
                               foreach ($languages as $Lang) {
                                echo '<option value="'. $Lang['Lang_ID'].'">'.$Lang['Lang_Name'].'</option>';
                               }
                            ?>
                                
                            </select>
                        </div>
                    </div>


                    <div class="form-btn">
                        <input class="btn btn-red" type="submit" value="<?php getTE('Edit');?>">
                    </div>


                </form>
            </div>
         </div>
     </div>
    </div>

        <?php

    }elseif($do == 'update') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 

         $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

         $users = superGet('*','users',"User_ID = $userid");
         foreach ($users as $user) {}

           $uName = tSec($_POST['uname']);
           $uFull = tSec($_POST['ufull']);
           $uEmail = tSec($_POST['uemail']);
           $uWeb =  tSec($_POST['usite']);
           $uLoc = 0 ; //tSec($_POST['uloc']);
           $uLang = tSec($_POST['ulang']);
           $pName = tSec($_POST['pname']);




        $stmt = $con->prepare("UPDATE users SET Full_Name = ?, Email = ?, User_Web = ?, U_Location_ID = ?,Select_Lang = ? WHERE User_ID = ?") ;
        $stmt->execute(array( $uFull, $uEmail, $uWeb, $uLoc, $uLang , $userid ));

       

        header('Location: manage_users.php?do=preview&userid='.$userid);

            } 
    }elseif ($do == 'add_Photo') {

        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        ?>
         <div class="container">
            <h2><?php getTE('Photos');?></h2>
            <div class="row">

            <form action="manage_users.php?do=insert_photo&userid=<?php echo $userid;?>" method="POST" enctype="multipart/form-data">
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
    }elseif ($do == 'add_back_Photo') {

    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        ?>
         <div class="container">
            <h2><?php getTE('Photos');?></h2>
            <div class="row">

            <form action="manage_users.php?do=insert_back_photo&userid=<?php echo $userid;?>" method="POST" enctype="multipart/form-data">
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
    }elseif($do == 'insert_photo'){

     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
           
            $user = $_SESSION['uid'];

  
        addFile('images/profiles/','image');
        $img =  $file;
 
        $stmt = $con->prepare("UPDATE users SET User_Image = ? WHERE User_ID = ?") ;
        $stmt->execute(array($img, $userid ));

        header('Location: manage_users.php?do=preview&userid='.$userid);

             

         }else{
                echo '<br> <div class="container"><div class="alert alert-danger">'. getT('Sorry, you did not selected the User').'There is no User in this Details </div></div>' ;
            } 


    }elseif($do == 'insert_back_photo'){
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
           
            $user = $_SESSION['uid'];

  
        addFile('images/profiles/','image');
        $img =  $file;
 
        $stmt = $con->prepare("UPDATE users SET User_back_image  = ? WHERE User_ID = ?") ;
        $stmt->execute(array($img, $userid ));

        header('Location: manage_users.php?do=preview&userid='.$userid);

             

         }else{
                echo '<br> <div class="container"><div class="alert alert-danger">'. getT('Sorry, you did not selected the User').'There is no User in this Details </div></div>' ;
            } 

    }// ElesIf setuations

  }// End of if user registed
} // End if the is Session


include  $tpl . "footer.php";

?>