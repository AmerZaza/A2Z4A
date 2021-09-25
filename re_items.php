<?php 
ob_start();

session_start();

$pageTitle = 'Real Estate Items Page | A to Z for All';
    
include 'init.php';


/* Real Estate Grid Function V 1.0 
** Function to previw the Real Estate's item results grid in pages .  
*/

function REsGrid($where = NULL , $order = NULL ,$limit = NULL){
	
	$items =getInnerItemRE($where, $order,'',$limit);
	foreach ($items as $item) {
		$itemID = $item['Item_ID'];

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

	<div class="container auto-grid control-box ">
		<div class="container ">

             <p class="control-title"><?php echo $item['Item_Name'] ;?><span class=""><i class="far fa-building"></i></span></span></p>
        </div>

		<div class="row">
			<div class="col col-md-3">
				<p><?php echo mb_substr($item['Item_Description'],0,30).'...';?></p>
			</div>
			<div class="col col-md-6">
				
			</div>
			<div class="col col-md-3">
				<?php 
				$totalCost = $item['RE_Main_Cost'] + $item['RE_Heating_Cost'] + $item['RE_Water_Cost'] + $item['RE_Electric_Cost'] + $item['RE_Side_Costs1']+$item['RE_Additional_Costs'];
				?>
				<p class="am-price"><?php echo number_format($totalCost);?> <span><?php echo $item['Currency_Code']; ?></span></p>
			</div>
		</div>

		<div class="container">
			<div class="row">
				
			<div class="col col-md-3">
				<a href="re_item.php?itemid=<?php echo $itemID ;?>">
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
				<p class="detail-icon"><i class="far fa-handshake"></i> <?php echo $praxi['Praxis_Name'];?><span class="detail-desc"><?php getTE('Praxis');?></span></p>
				

				<p class="detail-icon"><i class="fas fa-home"></i> <?php echo $type['Type_Name'];?><span class="detail-desc"><?php getTE('Type');?></span></p>
				

				<div>
					<label><?php getTE('Address');?></label>
					<p><?php echo $item['Country'].' '.$item['Region'].' '.$item['City'].' '.$item['Zip'].' '.$item['Street'].' '.$item['Haus_N'];?></p>
				</div>

			</div>

			<div class="col col-md-3 col-xs-6">
				<p class="detail-icon"><i class="fas fa-chess-board"></i> <?php echo $item['RE_Area'].' m²';?><span class="detail-desc"><?php getTE('Area');?></span></p> 

				<p class="detail-icon"><i class="fas fa-cubes"></i><?php echo $item['RE_Room'];?><span class="detail-desc"><?php getTE('Rooms');?></span></p> 

				<p class="detail-icon"><i class="far fa-calendar-alt"></i> <?php echo $item['RE_Available_From'];?><span class="detail-desc"><?php getTE('Available From');?></span></p>

				<?php  
				if ($item['RE_Furnished'] == 1){
				 	$Furnished = getT('Yes');
				}else{$Furnished = getT('No');}
				?>
				<p class="detail-icon"><i class="fas fa-couch"></i> <?php echo $Furnished;?><span class="detail-desc"><?php getTE('Furnished');?></span></p>

				
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
				<a href="re_item.php?itemid=<?php echo $itemID ;?>"><?php GetTE("More Details");?><span><i class="fas fa-angle-double-down"></i></span></a>
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

  	// Get Praxis ID  XXXX

  	if (!empty($_GET['Praxis'])){
			$praxis   = $_GET['Praxis'];
			$sPraxis  = ' AND praxis.Praxis_ID = '. $_GET['Praxis'];
		}else{$praxis = NULL ;
			$sPraxis  = NULL;
		}

  	// Get Type ID
		if (!empty($_GET['type'])){
			$type   = $_GET['type'];
			$sType  =  "re_items.RE_Type_ID =" . $_GET['type'];
		}else{$type = NULL ;
			$sType  = NULL;
		}

		// Get Main Cost
		if (!empty($_GET['mprice-f'])){
			$mpriceF   = $_GET['mprice-f'];
			$sMpriceF  = ' AND RE_Main_Cost >='. $_GET['mprice-f'];
		}else{$mpriceF = NULL ;
			$sMpriceF  = NULL;
		}

		if (!empty($_GET['mprice-t'])){
			$mpriceT   = $_GET['mprice-t'];
			$sMpriceT  = ' AND RE_Main_Cost <='. $_GET['mprice-t'];
		}else{$mpriceT = NULL ;
			$sMpriceT  = NULL;
		}

		// Get Cost + Neben
		if (!empty($_GET['nprice-f'])){
			$mnpriceF   = $_GET['nprice-f'];
			$sMNpriceF  = ' AND re_items.RE_Main_Cost + re_items.RE_Side_Costs1 >='. $_GET['nprice-f'] ;
		}else{$mnpriceF = NULL ;
			$sMNpriceF  = NULL;
		}

		if (!empty($_GET['nprice-t'])){
			$mnpriceT   = $_GET['nprice-t'];
			$sMNpriceT  = ' AND re_items.RE_Main_Cost + re_items.RE_Side_Costs1 <='. $_GET['nprice-t'] ;
		}else{$mnpriceT = NULL ;
			$sMNpriceT  = NULL;
		}

		// Get Total cost
		if (!empty($_GET['tprice-f'])){
			$tpriceF   = $_GET['tprice-f'];
			$sTpriceF  = ' AND RE_Main_Cost + RE_Side_Costs1 + RE_Heating_Cost + RE_Water_Cost + RE_Electric_Cost + RE_Additional_Costs	 >='. $_GET['tprice-f'] ;
		}else{$tpriceF = NULL ;
			$sTpriceF  = NULL;
		}

		if (!empty($_GET['tprice-t'])){
			$tpriceT   = $_GET['tprice-t'];
			$sTpriceT  = ' AND RE_Main_Cost + RE_Side_Costs1 + RE_Heating_Cost + RE_Water_Cost + RE_Electric_Cost + RE_Additional_Costs	 <='. $_GET['tprice-t'] ;
		}else{$tpriceT = NULL ;
			$sTpriceT  = NULL;
		}

		// Get Area
		if (!empty($_GET['area-f'])){
			$areaF   = $_GET['area-f'];
			$sAreaF  = ' AND RE_Area >= '. $_GET['area-f'];
		}else{$areaF = NULL ;
			$sAreaF  = NULL;
		}

		if (!empty($_GET['area-t'])){
			$areaT   = $_GET['area-t'];
			$sAreaT  = ' AND RE_Area <= '. $_GET['area-t'];
		}else{$areaT = NULL ;
			$sAreaT  = NULL;
		}

		// Get Room
		if (!empty($_GET['room-f'])){
			$roomF   = $_GET['room-f'];
			$sRoomF  = ' AND RE_Room >= '. $_GET['room-f'];
		}else{$roomF = NULL ;
			$sRoomF  = NULL;
		}

		if (!empty($_GET['room-t'])){
			$roomT   = $_GET['room-t'];
			$sRoomT  = ' AND RE_Room <= '. $_GET['room-t'];
		}else{$roomT = NULL ;
			$sRoomT  = NULL;
		}

		// Get Bath 
		if (!empty($_GET['bath-f'])){
			$bathF   = $_GET['bath-f'];
			$sBathF  = ' AND RE_Bath >= '. $_GET['bath-f'];
		}else{$bathF = NULL ;
			$sBathF  = NULL;
		}

		if (!empty($_GET['bath-t'])){
			$bathT   = $_GET['bath-t'];
			$sBathT  = ' AND RE_Bath <= '. $_GET['bath-t'];
		}else{$bathT = NULL ;
			$sBathT  = NULL;
		}

		
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
			$locs = getInnerItemRE("items.Category_ID = $pageid ");
			foreach ($locs as $loc) {
				$locID = $loc['Location_ID'];
				$lat   = $loc['Latitude'];
				$lon   = $loc['Longitude'];

				if(isset($_GET['unit'])){
					$unit = $_GET['unit'];
				}else{$unit = NULL;}

				$rDistance = getDirectDistance($lat, $lon, $sLat, $sLon, $unit);

				if ($rDistance <= $sDistance){

					$allLocs[] = " OR re_items.Location_ID = ". $locID;
				}
			}
			if(!empty($allLocs)){
		$rLocString = implode(" ",$allLocs);
		$rLocString = preg_replace('/OR/','',$rLocString,1);
		$rLocString = ' AND ('.$rLocString.')';
 //echo '<br><textarea row="5" class="form-control">'.$rLocString.'</textarea>' ;
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
///////////////// End Sorting php///////////////////

///////////////// Start Get Limit //////////////////////

	if (isset($_GET['limit'])){
		$limit = $_GET['limit'];
	}else{$limit = '0,'.$resultsCount;}


//////////////// End Get Limit ////////////////////
?>  

<h1 class="text-center"><?php getTE('Real Estate'); ?></h1>	


<div class="container">
	<div class="row">
		<div class="col-md-3">

<!--    *******   Start Controls Section ******  -->

			<form action="<?php echo $_SERVER['PHP_SELF'].'?pageid='.$pageid?>" method="GET">
				<input type="hidden" name="pageid" value="<?php echo $pageid ;?>" >

			<div class="control-box">
			<p class="details-packet-title"><?php getTE('Real Estate');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>

			<div class="details-packet">

				<div class="container ">

	                <div class="col-md-12">
	                    <div class="form-group ">
	                      <label class=" col-md-12 control-lable"><?php getTE("Praxis");?></label>
	                      <div class=" col-md-12">
	                          <select class="form-control "  name="Praxis"  >
	                          <option value=""> <?php getTE("Select");?></option>

	                          <?php 
	                          $praxis = getInnerPraxis();
	                          foreach ($praxis as $prax) {
	                            echo '<option value = "'.$prax['Praxis_ID'].'">'.$prax['Praxis_Name'].'</option>';
	                          }
	                          ?>
	                      </select>
	                  
	                      </div>
	                  </div>
	              </div>
	              <div class="col-md-12">
	                    <div class="form-group ">
	                      <label class=" col-md-12 control-lable"><?php getTE("Type");?></label>
	                      <div class=" col-md-12">
	                          <select class="form-control "  name="type"  >
	                          <option value=""> <?php getTE("Select");?></option>

	                          <?php 
	                          $types = getInnerTypesRE();
	                          foreach ($types as $type) {
	                            echo '<option value = "'.$type['RE_Type_ID'].'">'.$type['Type_Name'].'</option>';
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
		<p class="details-packet-title"><?php getTE('Costs');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>

		<div class="details-packet">
      
        <div class="container">
        	<div class="">
					<p><?php getTE('Main Cost'); ?></p>
					<div class="">
						<input class="form-control" type="number" name="mprice-f" placeholder="<?php getTE('From');?>">
					</div>
					<div class="">
						<input class="form-control" type="number" name="mprice-t" placeholder="<?php getTE('To');?>">
					</div>
				</div>

				<div class="">
					<p><?php echo getT('Main Cost') .' & '.getT('Haus Costs'); ?></p>
					<div class="">
						<input class="form-control" type="number" name="nprice-f" placeholder="<?php getTE('From');?>">
					</div>
					<div class="">
						<input class="form-control" type="number" name="nprice-t" placeholder="<?php getTE('To');?>">
					</div>
				</div>

				<div class="">
					<p><?php getTE('Total Cost'); ?></p>
					<div class="">
						<input class="form-control" type="number" name="tprice-f" placeholder="<?php getTE('From');?>">
					</div>
					<div class="">
						<input class="form-control" type="number" name="tprice-t" placeholder="<?php getTE('To');?>">
					</div>
				</div>
	       
	      	</div>
	   	  </div>
	   	</div>

	   	<div class="control-box">
		<p class="details-packet-title"><?php getTE('Details');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>

		<div class="details-packet">
      
        <div class="container">
        	<div class="">
					<p><?php getTE('Area'); ?></p>
					<div class="">
						<input class="form-control" type="number" name="area-f" placeholder="<?php getTE('From');?>">
					</div>
					<div class="">
						<input class="form-control" type="number" name="area-t" placeholder="<?php getTE('To');?>">
					</div>
				</div>

				<div class="">
					<p><?php getTE('Rooms'); ?></p>
					<div class="">
						<input class="form-control" type="number" name="room-f" placeholder="<?php getTE('From');?>">
					</div>
					<div class="">
						<input class="form-control" type="number" name="room-t" placeholder="<?php getTE('To');?>">
					</div>
				</div>

				<div class="">
					<p><?php getTE('Bath'); ?></p>
					<div class="">
						<input class="form-control" type="number" name="bath-f" placeholder="<?php getTE('From');?>">
					</div>
					<div class="">
						<input class="form-control" type="number" name="bath-t" placeholder="<?php getTE('To');?>">
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
			
	if( isset($sPraxis) || isset($sType) || isset($sMpriceF) ||isset($sMpriceT) || isset($sMNpriceF)|| isset($sMNpriceT) || isset($sTpriceF) || isset($sTpriceT) || isset($sAreaF) || isset($sAreaT) || isset($sRoomF)|| isset($sRoomT)|| isset($sBathF)|| isset($sBathT)|| isset($sCountry) || isset($sRegion) || isset($sCity) || isset($sZip) || isset($sStreet) || isset($rLocString))  {


	$rools = $sPraxis . $sType . $sMpriceF . $sMpriceT . $sMNpriceF . $sMNpriceT . $sTpriceF . $sTpriceT . $sAreaF . $sAreaT . $sRoomF . $sRoomT . $sBathF . $sBathT .$sCountry .$sRegion .$sCity. $sZip .$sStreet .$rLocString;


	}else{$rools = "categories.Category_ID = $pageid";}

	$rools = preg_replace('/AND/','',$rools,1).' AND items.Item_Display = 1 '; //ReMov & Add Display Rool

	//   echo 'ROOLS ='.$rools;

	REsGrid($rools,$order, $limit);

	?>
<!-- *** End Results Section  **** -->


<!-- *******  Start LIMIT  *****   -->
	<div class="result-limit">
		<?php 
		// Get all RE_Items Count
		$orderLink = getLink($_GET,"limit");
		$allItems = getInnerItemRE($rools);
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
			<?php getCatParent("70"); ?>
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