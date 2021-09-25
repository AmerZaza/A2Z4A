<?php 
ob_start();

session_start();

$pageTitle = 'Automobile Spare Parts | A to Z for All';
    
include 'init.php';


/* Spare Parte Grid Function V 1.0 
** Function to previw the Spare parts's item results grid in pages .  
*/

function SPsGrid($where = NULL , $order = NULL ,$limit = NULL){
	
	$items =getInnerItemSP($where, $order,'',$limit);
	foreach ($items as $item) {
		$itemID = $item['Item_ID'];
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

		?>

	<div class="container auto-grid control-box ">
		<div class="container ">

            <p class="control-title"><?php echo $item['Item_Name'] ;?><span class=""><i class="fas fa-cog"></i></span></span></p>
        </div>

		<div class="row">
			<div class="col col-md-3">
				<p><?php echo mb_substr($item['Item_Description'],0,30).'...';?></p>
			</div>
			<div class="col col-md-6">
				
			</div>
			<div class="col col-md-3">
				<?php 
				
				?>
				<p class="am-price"><?php echo $item['Main_Price'];?> <span><?php echo $item['Currency_Code']; ?></span></p>
			</div>
		</div>

		<div class="container">
			<div class="row">
				
			<div class="col col-md-3">
				<a href="sp_item.php?itemid=<?php echo $itemID ;?>">
				<?php
				// Set $img = Default if ther is no image
				$images = superGet('*','items_images',"Item_ID = $itemID AND Ist_Main = 1");
               if (!empty ($images)){
               	
                foreach ($images as $imge){
                        $img = $imge['Item_Image'];
                    }
                }else {
                    $img = 'item.jpg';
                }
				?>
				<div >
					<img  class="main-img" src="images/items/<?php echo $img; ?>" alt=""/>
					<?php 
					// GEt the rist photo
					$otherImages = superGet('*','items_images',"Item_ID = $itemID");
					/*  Small Photo under main Photo
					if(!empty ($otherImages)){
						echo '<div class="img-section">';
						foreach ($otherImages as $otherImage) {
						$img = $otherImage['Item_Image'];	
						echo '<img  class="other-img" src="images/items/'.$img.'" alt=""/>';
						}// forrach not main photos
						echo '</div>';
					}
					*/
					?>
				</div>
				</a>
			</div>
			<div class="col col-md-3 col-xs-6 ">

				<p class="detail-icon"><i class="fas fa-bold"></i> <?php echo $brandName;?><span class="detail-desc"><?php getTE('Brand');?></span></p>

				<p class="detail-icon"><i class="fab fa-phabricator"></i> <?php echo $item['SP_Main_Item_Name'];?><span class="detail-desc"><?php getTE('Item Name');?></span></p>

				<p class="detail-icon"><i class="far fa-folder-open"></i> <?php echo $item['SP_Reference'];?><span class="detail-desc"><?php getTE('Reference');?></span></p>

				<p class="detail-icon"><i class="fas fa-ruler-combined"></i> <?php echo $item['Unit_Name'];?><span class="detail-desc"><?php getTE('Unit');?></span></p>


			</div>

			<div class="col col-md-3 col-xs-6">
			 

				<p class="detail-icon"><i class="fas fa-car"></i> <?php echo $makerName;?><span class="detail-desc"><?php getTE('Maker');?></span></p>

				<p class="detail-icon"><i class="fas fa-flag-checkered"></i> <?php echo $modelName;?><span class="detail-desc"><?php getTE('Model');?></span></p>

				<p class="detail-icon"><i class="far fa-calendar-alt"></i> <?php echo $item['Production_Year'];?><span class="detail-desc"><?php getTE('Production');?></span></p>

			
				
			</div>

			<div class="col col-md-3  col-xs-6">
				

				<div class="text-center"><!--start provider sectio -->
					<!--
					<div class="container">
                    <p class=""><?php getTE("Provider");?> <span class="icon"><i class="far fa-address-card"></i></span> </p>
                    </div>
                -->
            

                <?php // Get Providers Details
                $proUid = $item['User_ID'];
                $pros = getInnerProvider("providers.User_ID = $proUid");
                foreach ($pros as $pro) {}

                ?>
                <p><?php getTE("Provider");?> : <a href="pro_profile.php?proid=<?php echo $pro['Provider_ID'];?>"><?php echo $pro['Provider_Name'];?></a></p>
                <p><?php // getTE("Contact Person");?> <?php //echo $pro['Contact_Person'];?> </p>
            
            
                <div class="">
                <img class="pro-img " src="images\profiles\<?php  echo $pro["User_Image"] ; ?>" alt="" />
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
             <p> <?php echo $pro['Email'];?> </p>

             <div>
             <a class="btn btn-default btn-sm" href="send_message.php?itemid=<?php echo $item['Item_ID'].'&resiverid='.$item['User_ID'] ?>" target="popup"> <?php  getTE("Send Message for Provider");?></a>
            </div>


					
				</div><!-- end provider section -->
				
			</div>
			
		</div>

		<div class="row">
			<div class="col col-xs-5">
				
                    <?php  // Get Item Evalutions

                      // Get Evauation Count
                      $evalCount = countRec('Evaluation_ID','items_evaluations',"Item_ID = $itemID AND Evaluation_Display = 1");
                      echo '<span>'.getT("Evaluations time").': <span>'.$evalCount;

                      echo '<br>';

                     // Get Stars Avrage
                        $StarAvrage = avgRec('Item_Star','items_evaluations',"Item_ID = $itemID AND Evaluation_Display = 1");
                         grtStar($StarAvrage);

                     ?>
			</div>

			<div class="col col-xs-3">
				
				<input type="image" class="add-compare" src="images/form/balance-icon.png" onClick="addCompare(value)"  width="24px" value="<?php echo $itemID; ?>" >

				<input type="image" class="add-favorite" src="images/form/favorit-icon.png" onClick="addFavorite(value)"  width="24px"  value="<?php echo $itemID; ?> ">
	
			</div>

			<div class="col col-xs-4">
				<a href="sp_item.php?itemid=<?php echo $itemID ;?>"><?php GetTE("More Details");?><span><i class="fas fa-angle-double-down"></i></span></a>
			</div>

			<div>
				
			</div>
			</div>
		</div>
	</div>
	<?php 
	
	} 
}
//////////////////////////////////////////////

  $pageid = isset($_GET['pageid']) && is_numeric($_GET['pageid']) ? intval($_GET['pageid']) : 0;
   $cats = getInnerCat("categories.Category_ID = $pageid");
  foreach ($cats as $cat) {}


  if ($_SERVER['REQUEST_METHOD'] = 'GET') {

  	// Get Item Group ID 

  	if (!empty($_GET['Group'])){
			$group   = $_GET['Group'];
			$sGroup  = ' AND sp_groups.SP_Group_ID = '. $_GET['Group'];
		}else{$group = NULL ;
			$sGroup  = NULL;
		}

  	// Get Main Item ID
		if (!empty($_GET['Item'])){
			$item   = $_GET['Item'];
			$sItem  =  "sp_items.SP_Main_Item_ID =" . $_GET['Item'];
		}else{$item = NULL ;
			$sItem  = NULL;
		}

	// Get Maker 
		if (!empty($_GET['maker'])){
			$maker   = $_GET['maker'];
			$sMaker  =  "sp_items.Maker_ID =" . $_GET['maker'];
		}else{$maker = NULL ;
			$sMaker  = NULL;
		}

		// Get Maker And Mode 
		if (!empty($_GET['model'])){
			$model   = $_GET['model'];
			$sModel  =  "sp_items.Model_ID =" . $_GET['model'];
		}else{$model = NULL ;
			$sModel  = NULL;
		}

		// Get Production 
		if (!empty($_GET['production'])){
			$production   = $_GET['production'];
			$sProduction  =  "sp_items.Production_Year =" . $_GET['production'];
		}else{$production = NULL ;
			$sProduction  = NULL;
		}

		// Get Fuel 
		if (!empty($_GET['fuel'])){
			$fuel   = $_GET['fuel'];
			$sFuel  =  "sp_items.AM_Fuel_ID =" . $_GET['fuel'];
		}else{$fuel = NULL ;
			$sFuel  = NULL;
		}

		// Get Main Price
		if (!empty($_GET['Price-f'])){
			$priceF   = $_GET['Price-f'];
			$sPriceF  = ' AND Main_Price >='. $_GET['Price-f'];
		}else{$priceF = NULL ;
			$sPriceF  = NULL;
		}

		if (!empty($_GET['Price-t'])){
			$priceT   = $_GET['Price-t'];
			$sPriceT  = ' AND Main_Price <='. $_GET['Price-t'];
		}else{$priceT = NULL ;
			$sPriceT  = NULL;
		}

		// Get Maker & Model
/*
		if (!empty($_GET['Maker'])){
			$maker   = $_GET['Maker'];
			$sMaker  = ' AND makes.id ='. $_GET['Maker'];
		}else{$maker = NULL ;
			$sMaker  = NULL;
		}

		if (!empty($_GET['Model'])){
			$model   = $_GET['Model'];
			$sModel  = ' AND models.id ='. $_GET['Model'];
		}else{$model = NULL ;
			$sModel  = NULL;
		}

	*/	
		// Location#
		// Location#
		if (!empty($_GET['country'])){
			 $country  = $_GET['country'];
			 $sCountry = " AND Country =  '". $_GET['country'] ."'";

		}else{$country = NULL ;
			 $sCountry = NULL;
		}

		if (!empty($_GET['region'])){
			 $region  = $_GET['region'];
			 $sRegion = " AND Region =   '". $_GET['region'] ."'";
		}else{$region = NULL ;
			 $sRegion = NULL;
		}

		if (!empty($_GET['city'])){
			 $city  = $_GET['city'];
			 $sCity = " AND City =   '". $_GET['city'] ."'";
		}else{$city = NULL ;
			 $sCity = NULL;
		}

		if (!empty($_GET['zip'])){
			 $zip  = $_GET['zip'];
			 $sZip = " AND Zip =   '". $_GET['zip'] ."'";
		}else{$zip = NULL ;
			 $sZip = NULL;
		}

		if (!empty($_GET['street'])){
			 $street  = $_GET['street'];
			 $sStreet = " AND Street =   '". $_GET['street'] ."'";
		}else{$street = NULL ;
			 $sStreet = NULL;
		}

		if (!empty($_GET['haus'])){
			 $hausN  = $_GET['haus'];
			 $sHausN = " AND Haus_N =   '". $_GET['haus'] ."'";
		}else{$hausN = NULL ;
			 $sHausN = NULL;
		}

		if (isset($_GET['distance'])){
		$sDistance  = $_GET['distance'];
		}else{$sDistance = NULL;}

	$address = $street .' '.$hausN.' '.$zip.' '.$region.' '.$city.' '.$country;
	if(trim($address) !== "" && $sDistance !== '' ){
		$sGeoLoc = getGeoLoc($address);
		$sLat = $sGeoLoc['lat']; 
		$sLon = $sGeoLoc['lng'];

			//$locs = superGet('*','locations_text');
			$locs = getInnerItemsp("items.Category_ID = $pageid ");
			foreach ($locs as $loc) {
				$locID = $loc['Location_ID'];
				$lat   = $loc['Latitude'];
				$lon   = $loc['Longitude'];

				if(isset($_GET['unit'])){
					$unit = $_GET['unit'];
				}else{$unit = NULL;}

				$rDistance = getDirectDistance($lat, $lon, $sLat, $sLon, $unit);

				if ($rDistance <= $sDistance){

					$allLocs[] = " OR providers.Location_ID = ". $locID;
				}
			}
		if(!empty($allLocs)){
		$rLocString = implode(" ",$allLocs);
		$rLocString = preg_replace('/OR/','',$rLocString,1);
		$rLocString = ' AND ('.$rLocString.')';
// echo '<br><textarea row="5" class="form-control">'.$rLocString.'</textarea>' ;
			}else{$rLocString = NULL;}
		}else{$rLocString = NULL;}

	// Set Location details = Null if Geo Location is set
	if($rLocString != NULL){
		$sCountry = NULL;
		$sRegion  = NULL;
		$sCity    = NULL;
		$sZip     = NULL;
		$sStreet  = NULL;
		$sHausN   = NULL;
		}


	}  

///////////////////////////////////////
		// Get the Sorting Order 
	if (isset($_GET['sorting'])){
		if ($_GET['sorting'] == 'priceh'){
			$order = "items.Main_Price ASC";

		}elseif ($_GET['sorting'] == 'pricel') {
			$order = "items.Main_Price DESC";

		}elseif ($_GET['sorting'] == 'timeh') {
			$order = "items.Inser_Time ASC";

		}elseif ($_GET['sorting'] == 'timel') {
			$order = "items.Inser_Time DESC";
		}
		
	  }else{$order = "items.Inser_Time DESC" ;}
///////////////// End Sorting php////////////////////////

///////////////// Start Get Limit //////////////////////

	if (isset($_GET['limit'])){
		$limit = $_GET['limit'];
	}else{$limit = '0,'.$resultsCount;}


//////////////// End Get Limit ////////////////////
?>  

<h2 class="text-center"><?php getTE('Spare Parts'); ?></h2>	


<div class="container">
	<div class="row">
		<div class="col-md-3">

<!--    *******   Start Controls Section ******  -->

			<form action="<?php echo $_SERVER['PHP_SELF'].'?pageid='.$pageid?>" method="GET">
				<input type="hidden" name="pageid" value="<?php echo $pageid ;?>" >

			<div class="control-box">
			<p class="details-packet-title"><?php getTE('Spare Parts');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>

			<div class="details-packet">

				<div class="container ">

	                <div class="col-md-12">
	                    <div class="form-group ">
	                      <label class=" col-md-12 control-lable"><?php getTE("Groups");?></label>
	                      <div class=" col-md-12">
	                          <select class="form-control "  name="Group" onChange="getSPitems(value)" >
	                          <option value=""> <?php getTE("Select");?></option>

	                          <?php 
	                          $groups = getInnerGroupSP();
	                          foreach ($groups as $group) {
	                            echo '<option value = "'.$group['SP_Group_ID'].'">'.$group['SP_Group_Name'].'</option>';
	                          }
	                          ?>
	                      </select>
	                  
	                      </div>
	                  </div>
	              </div>

	              <div class="col-md-12">
	                    <div class="form-group ">
	                      <label class=" col-md-12 control-lable"><?php getTE("Item");?></label>
	                      <div class=" col-md-12">
	                          <select class="form-control "  name="Item"  id="main-sp">
	                          <option value=""> <?php getTE("Select");?></option>

	                          <?php 
	                          // Get All befoe Select Group
	                          /*  
	                          $spares = getInnerSpareSP();
	                          foreach ($spares as $spare) {
	                            echo '<option value = "'.$spare['SP_Main_Item_ID'].'">'.$spare['SP_Main_Item_Name'].'</option>';
	                          		}
	                          */
	                          ?>
	                      </select>
	                  
	                      </div>
	                  </div>
	              </div>

	              </div>
	          </div>
	      </div>


		<div class="control-box">
			<p class="details-packet-title"><?php getTE('Model');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>

			<div class="details-packet">

	            <div class="container">
	              <div class="col-md-12 ">
	                  <div class="form-group ">
	                  <label class=" col-md-12 control-lable"><?php getTE("Maker");?></label>
	                  <div class=" col-md-12">
	                      <select class="form-control" id="maker-list" name="maker" onChange="getModel(value)"   >
	                      <option value=""> <?php getTE("All Makers");?></option>
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
	            <div class="col-md-12">
	                <div class="form-group container">
	                    <label class="col-md-12 control-lable"><?php getTE("Models");?></label>
	                    <div class=" col-md-12">
	                        <select class="form-control"  name="model" id="mod-list" onChange="getModelText(value)" disabled="disabled">
	                            
	                            <option value=""><?php getTE("Selct Models");?> </option>
	                        </select>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="container">
	        	<div class="col-md-12">
	        		<div class="form-group container">
	        			<label class="col-md-12 control-lable"><?php getTE("Production");?></label>
	        				<div class="col-md-12">
	        				<select class="form-control" name="production" >
	        					<option value=""><?php getTE('Not Set'); ?></option>
	        				<?php 
	        				for($P = 2019; $P >= 1970; $P--){
	        					echo '<option value = "'.$P.'">'.$P.'</option>';
	        					}
	        				?>
	        				</select>
	        			</div>
	        		</div>
	        	</div>
	        </div>

	        <div class="container">
	        	<div class="col-md-12">
	        		<div class="form-group container">
	        			<label class="col-md-12 control-lable"><?php getTE("Production");?></label>
	        				<div class="col-md-12">
	        				<select class="form-control" name="fuel" >
	        					<option value=""><?php getTE('Not Set');?></option>
	        				<?php 
	        				$fuels = getInnerFuelAm();
	        				foreach ($fuels as $fuel) {
	        					echo '<option value = "'.$fuel['AM_Fuel_ID'].'">'.$fuel['AM_Fuel_Name'].'</option>';
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
		<p class="details-packet-title"><?php getTE('Price');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>

		<div class="details-packet">
      
        <div class="container">
        	<div class="">
					<p><?php getTE('Main Cost'); ?></p>
					<div class="">
						<input class="form-control" type="number" name="Price-f" placeholder="<?php getTE('From');?>">
					</div>
					<div class="">
						<input class="form-control" type="number" name="Price-t" placeholder="<?php getTE('To');?>">
					</div>
				</div>

	       
	      	</div>
	   	  </div>
	   	</div>

	   	<div class="control-box">
			<p class="details-packet-title"><?php getTE('Location');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>

			<div class="details-packet">
				<div class="">
					<label class="control-lable"><?php getTE("Enter your address");?></label>

					<div class="" id="locationField">
                    <input id="autocomplete" placeholder="<?php getTE("Enter your address");?>"
                    onFocus="geolocate()" type="text" class="form-control">
               	 </div>
				</div>


                <div class="">
                    <div class="form-group container">
                    	<!--
                        <label class=" control-lable"><?php getTE("Country");?></label> -->
                        <div class="">
                            <input class="form-control" type="hidden"  name="country"   id="country">
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="form-group container">
                    	<!--
                        <label class=" control-lable"><?php getTE("Region");?></label> -->
                        <div class="">
                            <input class="form-control" type="hidden"  name="region" id="administrative_area_level_1">
                        </div>
                    </div>
                </div>

                      
                <div class="">
                    <div class="form-group container">
                    	<!--
                        <label class=" control-lable"><?php getTE("City");?></label> -->
                        <div class="">
                            <input class="form-control" type="hidden"  name="city"   id="locality">
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="form-group container">
                    	<!--
                        <label class=" control-lable"><?php getTE("Zip Code");?></label> -->
                        <div class="">
                            <input class="form-control" type="hidden"  name="zip"   id="postal_code">
                        </div>
                    </div>
                </div>

                            
                 <input class="form-control" type="hidden" id="route" name="street">

                 <input class="form-control" type="hidden" id="street_number" name="haus">	

				<div>
					<label><?php getTE('Distance');?></label>
					<input class="form-control col-xs-12 " type="range" min="0" max="100" value=""  name="" id="dis-range">
					<div class="col-xs-6">
						<input class="form-control " name="distance" type="number" id="dis-text" max="100" min="0" readonly>
					</div>
					<div class="col-xs-6">
						<select class="form-control" name="unit">
							<option value="K">KM</option>
							<option value="M">Mail</option>
						</select>
					</div>
				</div>

			</div>
		</div>


	        <div class="col-md-12 ">
	        	<input type="submit" value="<?php getTE('Search'); ?>" class = "btn btn-red">
	        </div>

			</form>
		</div>
<!--     ********   End Controls Section ********    -->
<!-- ****************** Start Page ************** -->
 <div class="col col-md-9">
 	<div class="row">

<!-- **** Start TAGS Section  **** -->
	<div class="col col-md-8">
	<?php
	      if (isset($_GET)){
	      	$selects = $_GET;
	      	// Remove from tags top icons
	      	unset($selects['pageid']);
	      	unset($selects['limit']);
	      	unset($selects['sorting']);
	      	unset($selects['distance']);
	      	unset($selects['unit']);
	      	foreach ($selects as $key => $select) {
	      		if(!empty($select)){
	      		echo '<div class="select-tag">';
	      		echo str_replace("-"," ",$key) ; //echo str_replace("-"," ",$key) .' = '.'<span>'. $select.'</span>';
	      		$nLink = getLink($_GET,$key) ;
	      		echo '<a href="'.$_SERVER['PHP_SELF'].'?'.$nLink.'">X</a>';
	      		echo '</div>';
	      		}
	      	}
	      }
	      ?>
	</div>
<!-- **** End TAGS Section  **** -->

<!-- **** Start Sorting Section  **** -->
	<div class="col col-md-4">
    		
		<?php   $orderLink = getLink($_GET,'sorting');?>

		 <div class="sorting-list col-md-1 col-offcit-4"><!--Start sorting list -->
		<ul class ="">
			<li><?php getTE('Sorting'); ?> </li>
			<li>
				<a href="<?php echo $_SERVER['PHP_SELF'].'?sorting=priceh&'.$orderLink; ?>"><?php getTE('Price');?> +</a>
			</li>
			<li>
				<a href="<?php echo $_SERVER['PHP_SELF'].'?sorting=pricel&'.$orderLink; ?>"><?php getTE('Price');?> -</a>
			</li>
			<li>
				<a href="<?php echo $_SERVER['PHP_SELF'].'?sorting=timel&'.$orderLink;?>"><?php getTE('Newer');?> </a>
			</li>
			<li>
				<a href="<?php echo $_SERVER['PHP_SELF'].'?sorting=timeh&'.$orderLink;?>"><?php getTE('Older');?> </a>
			</li>
		</ul>
		</div> 
    </div>
<!-- *** End Sorting Section  **** -->
<br><br>
<!-- *** Start Results Section  **** -->
<?php 
			 
	if( isset($sGroup) || isset($sItem) || isset($sMaker) || isset($sModel) || isset($sProduction) || isset($sFuel) || isset($sPriceF) ||isset($sPriceT) || isset($sCountry) || isset($sRegion) || isset($sCity) || isset($sZip) || isset($sStreet) || isset($rLocString) )  {


	$rools = $sGroup . $sItem .$sMaker . $sModel . $sProduction . $sFuel . $sPriceF . $sPriceT . $sCountry .$sRegion .$sCity. $sZip .$sStreet . $rLocString ;


	}else{$rools = "categories.Category_ID = $pageid";}

	$rools = preg_replace('/AND/','',$rools,1).' AND items.Item_Display = 1 '; //ReMov & Add Display Rool

//	   echo 'ROOLS ='.$rools;
	SPsGrid($rools,$order, $limit);

	?>
<!-- *** End Results Section  **** -->


<!-- *******  Start LIMIT  *****   -->
	<div class="result-limit">
		<?php 
		// Get all AM_Items Count
		$orderLink = getLink($_GET,"limit");
		$allItems = getInnerItemSP($rools);
		$amCount =  count($allItems);
		//$resultsCount = 3;
		$pagesCount = ceil($amCount / $resultsCount);// To MAX near Nummber
		echo '<ul>';
			for($I = 1 ; $I <= $pagesCount ; $I++){
				$sLimit = ($I-1)*$resultsCount.','.$resultsCount;
			echo '<li><a href="'.$_SERVER['PHP_SELF'].'?limit='.$sLimit.'&'.$orderLink.'">'.$I.'</a></li>';
			}
		echo '</ul>';
		?>
		<span><?php getTE('Page');?></span>	
	</div>
	<!-- ******  End LIMIT ****** -->
 		
 	</div>
 	
 </div>
<!-- ******************* End Page *************** -->



	</div><!-- End mine row -->
</div><!-- End mine container -->




<div class="container">
	<div class="row">

		<div class="col col-md-3">
			<?php getCatParent("87"); ?>
		</div>
	</div>
</div>

<?php

////////////////Save the Search///////////////////
	   /* 
	// Get The IP
    $ipAddr = getIP();

	/// Get Using Status
	if (isset($_GET['new'])  && isset($_GET['used'])){
			$usingS = 0 ;
		}elseif(isset($_GET['new']) && !isset($_GET['used'])){
			$usingS = 1 ;
		}elseif(isset($_GET['used'] ) && !isset($_GET['new'] )){
			$usingS = 2 ;
		}elseif(!isset($_GET['used']) && !isset($_GET['new'])){
			$usingS = 0 ; //'AND AM_Using_ID = 0'
		}


		if(!empty($_GET['maker'])){$maker = $_GET['maker'];}else{$maker = 0;}
		if(!empty($_GET['model'])){$model = $_GET['model'];}else{$model = 0;}
		

	  $stmt = $con->prepare("INSERT INTO am_items_search( IP,
	  													  Maker_ID,
	  													  Model_ID, 
	  													  AM_Production_From,
	  										
	  													  Fog_Lights

	  													 				 )
                            		VALUES( :ip,
                            				:zmakerid,
                            				:zmodelid,
                            				:zproddfrom,
                            				:zproddto,
                            				:zfuelid,
                            				:zbody,
                            				:zuse,
                            				:zgearb,

                            				:zfogl

                            							)");
        $stmt->execute(array(
                        'ip'		   => $ipAddr,
                        'zmakerid'     => $maker,
                        'zmodelid'     => $model,
                        'zproddfrom'   => $proDateF,
                        'zproddto' 	   => $proDateT,
                        'zfuelid'	   => $fuel,
                        'zbody'		   => $body,
                        'zuse'		   => $usingS,
                   
                        'zfogl'		   => $FogLight
                    
                         ));
	

*/
  //////////// End Save Search //////////////
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

include  $tpl . "footer.php";?>