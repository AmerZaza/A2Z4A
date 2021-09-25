<?php 
ob_start();

session_start();

$pageTitle = 'Automobils Page | A to Z for All';
    
include 'init.php';

/* Autos Grid Function V 1.0 
** Function to previw the car's item results grid in pages .  
*/

function autosGrid($where = NULL , $order = NULL ,$limit = NULL){
	$items =getInnerItemAM($where, $order,'',$limit);
	foreach ($items as $item) {
		$itemID = $item['Item_ID'];

		// Get Variables Name
		//Fuel Name
		$fuelID =  $item['AM_Fuel_ID'];
		$fuels = getInnerFuelAm("am_fuel_ml.AM_Fuel_ID = $fuelID");
		foreach ($fuels as $fuel) {}

		//Fuel Gear Box
		$gearID =  $item['AM_Gearbox_ID'];
		$gears = getInnerGearAm("am_gearboxes_ml.AM_Gearbox_ID = $gearID");
		foreach ($gears as $gear) {}

		//Emmesion Sticker
		$stickerID =  $item['Emission_Sticker_ID'];
		$eStickers = getInnerEStickAM("am_emissions_sticker.AM_Emission_Sticker_ID = $stickerID");
		foreach ($eStickers as $eSticker) {}

		//Emmesion Code
		$eClassID =  $item['Emissions_Class_ID'];
		$eClasses = superGet('*','am_emissions_class',"am_emissions_class.AM_Emission_Class_ID = $eClassID ");
		foreach ($eClasses as $eClasse) {}

		// Currency Code
		$CurrencyID =  $item['Currency_ID'];
		$Currencys = superGet('Currency_Code','currencies', "currencies.Currency_ID = $CurrencyID");
		foreach ($Currencys as $Currency) {}
		
	
	?>

	<div class="container auto-grid control-box ">
		<div class="container ">

             <p class="control-title"><?php echo $item['Make_Name'].' ,,, '.$item['Model_Name'] ;?><span class=""><i class="fa fa-car" aria-hidden="true"></i></span></span></p>
        </div>

		<div class="row">
			<div class="col col-md-3">
				<p class="font-italic"><strong><?php echo $item['Item_Name'].' | '.$item['AM_Sub_Model_Text'];?></strong></p>
			</div>
			<div class="col col-md-6">
				<p><?php //echo $item['Item_Description'];?></p>
			</div>
			<div class="col col-md-3">
				<p class="am-price"><?php echo number_format(round ($item['Main_Price']));?> <span><?php echo $Currency['Currency_Code']; ?></span></p>
			</div>
		</div>

		<div class="container">
			<div class="row">
				
			<div class="col col-md-3">
				<a href="am_item.php?itemid=<?php echo $itemID ;?>">
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

				<p class="detail-icon"><i class="far fa-calendar-alt"></i> <?php echo $item['AM_Production_Date'];?><span class="detail-desc"><?php getTE('Production Date');?></span></p>

				<p class="detail-icon"><i class="fas fa-road"></i> <?php echo $item['AM_Mileage'];?><span>KM</span><span class="detail-desc"><?php getTE('Milage');?></span></p>
				

				<p class="detail-icon"><i class="fas fa-gas-pump"></i><?php echo $fuel['AM_Fuel_Name'];?><span class="detail-desc"><?php getTE('Fuel');?></span></p>
				

				<p class="detail-icon"><i class="fab fa-steam-square"></i> <?php echo $gear['AM_Gearbox_Name'];?><span class="detail-desc"><?php getTE('Gear Box');?></span></p>

			</div>



			<div class="col col-md-3 col-xs-6">
				<p class="detail-icon"><i class="fas fa-users" ></i> <?php echo $item['AM_Passengers'];?><span class="detail-desc"><?php getTE('Passengers');?></span></p> 

				<p class="detail-icon"><i class="far fa-user"></i> <?php echo $item['AM_Owner_Number'];?><span class="detail-desc"><?php getTE('Owner Order');?></span></p>

				<?php if($item['Engine_Size'] != 0) {$enginSize = $item['Engine_Size'].' CC';}else{$enginSize = '--';} ?>

				<p class="detail-icon"><i class="fas fa-dumbbell"></i> <?php echo $enginSize;?><span class="detail-desc"><?php getTE('Engine Size');?></span></p>

				<?php  // Just if class is set
				if ($item['Emissions_Class_ID'] != 0) {
					?>
				<p class="detail-icon"><i class="fab fa-envira"></i><?php echo  $eClasse['AM_Emission_Class_Name'];?><span class="detail-desc"><?php getTE('Emissions Class');?></span></p>
				<?php } ?>

				<?php  // Just if Stiker is set
				if ($item['Emission_Sticker_ID'] != 0) {
					?>
				<p style="color:#<?php echo $eSticker['Color_Code'];?>"><?php echo  $eSticker['AM_Emission_Sticker_Name'];?><span class="detail-desc"><?php getTE('Emissions Sticker');?></span></p>
				<?php } ?>
				
			</div>

			<div class="col col-md-3  col-xs-12">
				

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
    <!--
             <p><i class="fas fa-phone"></i> :<?php echo $pro['Provider_Phone'];?> </p>
             <p><i class="far fa-envelope-open"></i> : <?php echo $pro['Email'];?> </p>
	-->
             <div>
             <a class="btn btn-default btn-sm" href="send_message.php?itemid=<?php echo $item['Item_ID'].'&resiverid='.$item['User_ID'] ?>" target="popup"> <?php  getTE("Send Message for Provider");?></a>
            </div>


					
				</div><!-- end provider section -->

				<div><!-- Start Distance -->
				<?php
				if(isset($item['Latitude']) && isset($item['Longitude'])){

					$iLat = $item['Latitude']; 
					$iLon = $item['Longitude']; 

					if(isset($_GET['unit'])){
						$Unit = $_GET['unit'];
					}else{$Unit = 'K';}

					if(isset($_GET['street'])){$street = $_GET['street'];}else{$street = NULL;}
					if(isset($_GET['haus'])){$haus = $_GET['haus'];}else{$haus = NULL;}
					if(isset($_GET['zip'])){$zip = $_GET['zip'];}else{$zip = NULL;}
					if(isset($_GET['region'])){$region = $_GET['region'];}else{$region = NULL;}
					if(isset($_GET['city'])){$city = $_GET['city'];}else{$city = NULL;}
					if(isset($_GET['country'])){$country = $_GET['country'];}else{$country = NULL;}
				
				$userAddress = $street .' '.$haus.' '.$zip.' '.$region.' '.$city.' '.$country;
				if(trim($userAddress) !== "" ){
					$uGeoLoc = getGeoLoc($userAddress);
					$uLat = $uGeoLoc['lat']; 
					$uLon = $uGeoLoc['lng']; 
					}
					if (!empty($uGeoLoc)){
						$iDistance = getDirectDistance($iLat, $iLon, $uLat, $uLon, $Unit);
						if ($Unit == 'K'){$vUnit = 'KM';}
						if ($Unit == 'M'){$vUnit = 'Mail';}

					
						?>
						<div class="progress ">
						  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
						  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($iDistance);?>%">
						    <?php echo round($iDistance).' '.'KM';?>
						  </div>
						</div>
						<?php

					}
					
				}
				?>
					
				</div><!-- End Distance -->
				
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
				
				<input type="image" class="add-compare" src="images/form/balance-icon.png" onClick="addCompare(value)"  width="34px" value="<?php echo $itemID; ?>" >

				<input type="image" class="add-favorite" src="images/form/favorit-icon.png" onClick="addFavorite(value)"  width="34px"  value="<?php echo $itemID; ?> ">
	
			</div>

			<div class="col col-xs-4">
				<a href="am_item.php?itemid=<?php echo $itemID ;?>"><?php GetTE("More Details");?><span><i class="fas fa-angle-double-down"></i></span></a>
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

  	// Get Using Status ID 

		if (isset($_GET['new'])  && isset($_GET['used'])){
			$usingStatus = NULL ;
		}elseif(isset($_GET['new']) && !isset($_GET['used'])){
			$usingStatus = 'AND AM_Using_ID = 1' ;
		}elseif(isset($_GET['used'] ) && !isset($_GET['new'] )){
			$usingStatus = 'AND AM_Using_ID = 2' ;
		}elseif(!isset($_GET['used']) && !isset($_GET['new'])){
			$usingStatus = NULL ; //'AND AM_Using_ID = 0'
		}

  	// Get Maker And Model
		if (!empty($_GET['maker'])){
			$maker   = $_GET['maker'];
			$sMaker  = ' AND am_items.Maker_ID = '. $_GET['maker'];
		}else{$maker = NULL ;
			$sMaker  = NULL;
		}

		if (!empty($_GET['maker2'])){
			$maker   = $_GET['maker2'];
			$sMaker2  = ' OR am_items.Maker_ID = '. $_GET['maker2'];
		}else{$maker = NULL ;
			$sMaker2  = NULL;
		}

		if (!empty($_GET['maker3'])){
			$maker   = $_GET['maker3'];
			$sMaker3  = ' OR am_items.Maker_ID = '. $_GET['maker3'];
		}else{$maker = NULL ;
			$sMaker3  = NULL;
		}


		if (!empty($_GET['model'])){
			$model   = $_GET['model'];
			$sModel  = ' AND Model_ID = '. $_GET['model'];
		}else{$model = NULL ;
			$sModel  = NULL;
		}

		if (!empty($_GET['model2'])){
			$model   = $_GET['model2'];
			$sModel2  = ' OR Model_ID = '. $_GET['model2'];
		}else{$model = NULL ;
			$sModel2  = NULL;
		}

		if (!empty($_GET['model3'])){
			$model   = $_GET['model3'];
			$sModel3  = ' OR Model_ID = '. $_GET['model3'];
		}else{$model = NULL ;
			$sModel3  = NULL;
		}

		if (!empty($_GET['prodate-f'])){
			$proDateF   = $_GET['prodate-f'];
			$sProDateF  = ' AND AM_Production_Date >='. $_GET['prodate-f'];
		}else{$proDateF = NULL ;
			$sProDateF  = NULL;
		}

		if (!empty($_GET['prodate-t'])){
			$proDateT   = $_GET['prodate-t'];
			$sProDateT  = ' AND AM_Production_Date <= '. $_GET['prodate-t'];
		}else{$proDateT = NULL ;
			$sProDateT  = NULL;
		}

		if (!empty($_GET['regist-f'])){
			$refDateF   = $_GET['prodate-f'];
			$sRegDateF  = ' AND AM_First_Regist >='. $_GET['regist-f'];
		}else{$refDateF = NULL ;
			$sRegDateF  = NULL;
		}

		if (!empty($_GET['regist-t'])){
			$regDateT   = $_GET['regist-t'];
			$sRegDateT  = ' AND AM_First_Regist <= '. $_GET['regist-t'];
		}else{$regDateT = NULL ;
			$sRegDateT  = NULL;
		}

		if (!empty($_GET['price-f'])){
			$priceF   = $_GET['price-f'];
			$sPriceF  = ' AND Main_Price >='. $_GET['price-f'];
		}else{$priceF = NULL ;
			$sPriceF  = NULL;
		}

		if (!empty($_GET['price-t'])){
			$priceT   = $_GET['price-t'];
			$sPriceT  = ' AND Main_Price <= '. $_GET['price-t'];
		}else{$priceT = NULL ;
			$sPriceT  = NULL;
		}

		if (!empty($_GET['fuel'])){
			$fuel   = $_GET['fuel'];
			$sFuel  = ' AND AM_Fuel_ID = '. $_GET['fuel'];
		}else{$fuel = NULL ;
			$sFuel  = NULL;
		}

		if (!empty($_GET['gear-box'])){
			$gearbox   = $_GET['gear-box'];
			$sGearbox  = ' AND AM_Gearbox_ID = '. $_GET['gear-box'];
		}else{$gearbox = NULL ;
			$sGearbox  = NULL;
		}

		if (!empty($_GET['passengers'])){
			$passengers   = $_GET['passengers'];
			$sPassengers  = ' AND AM_Passengers = '. $_GET['passengers'];
		}else{$passengers = NULL ;
			$sPassengers  = NULL;
		}

		if (!empty($_GET['drive-type'])){
			$driveType   = $_GET['drive-type'];
			$sDriveType  = ' AND AM_Drive_Type_ID = '. $_GET['drive-type'];
		}else{$driveType = NULL ;
			$sDriveType  = NULL;
		}

		if (!empty($_GET['doors'])){
			$doors   = $_GET['doors'];
			$sDoors  = ' AND AM_Doors = '. $_GET['doors'];
		}else{$doors = NULL ;
			$sDoors  = NULL;
		}

		if (!empty($_GET['milage'])){
			$milage  = $_GET['milage'];
			$sMilage = ' AND AM_Mileage >= '. $_GET['milage'];
		}else{$milage= NULL ;
			$sMilage = NULL;
		}

		if (!empty($_GET['body'])){
			$body  = $_GET['body'];
			$sBody = ' AND AM_Body_ID = '. $_GET['body'];
		}else{$body= NULL ;
			$sBody = NULL ;
		}

		if (!empty($_GET['em-class'])){
			$emClass  = $_GET['em-class'];
			$sEmClass = ' AND Emissions_Class_ID = '. $_GET['em-class'];
		}else{$emClass= NULL ;
			$sEmClass = NULL;
		}  

		if (!empty($_GET['em-sticker'])){
			 $emSticker  = $_GET['em-sticker'];
			 $sEmSticker = ' AND Emission_Sticker_ID = '. $_GET['em-sticker'];
		}else{$emSticker = NULL ;
			 $sEmSticker = NULL;
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
			$locs = getInnerItemAM("items.Category_ID = $pageid ");
			foreach ($locs as $loc) {
				$locID = $loc['Location_ID'];
				$lat   = $loc['Latitude'];
				$lon   = $loc['Longitude'];

				if(isset($_GET['unit'])){
					$unit = $_GET['unit'];
				}else{$unit = NULL;}

				$rDistance = getDirectDistance($lat, $lon, $sLat, $sLon, $unit);

				if ($rDistance <= $sDistance){

					$allLocs[] = " OR am_items.Location_ID = ". $locID;
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
		
//////////////////////////////////////////////

		// Equibment Y / N not set allyne becuse it's not set in if not null
		if (isset($_GET['AC_Front'])){
			$sACfront = ' AND AC_Front = 1 ';
		}else{
			$sACfront = NULL;
		}

		if (isset($_GET['ABS'])){
			$sAbs = ' AND ABS = 1 ';
		}else{
			$sAbs = NULL;
		}

		if (isset($_GET['ESP'])){   
			$sEsp = ' AND ESP = 1 ';
		}else{
			$sEsp = NULL;
		}

		if (isset($_GET['Navigation'])){
			$sNavi = ' AND Navigation = 1 ';
		}else{
			$sNavi = NULL;
		}

		if (isset($_GET['Memory-Seats'])){
			$sMemSeat = ' AND Memory_Seats = 1 ';
		}else{
			$sMemSeat = NULL;
		}

		if (isset($_GET['Leather-Interior'])){
			$sLether = ' AND Leather_Interior = 1 ';  
		}else{
			$sLether = NULL;
		}

		if (isset($_GET['LED-Front-Lights'])){
			$sLedFl = ' AND LED_Front_Lights = 1 ';
		}else{
			$sLedFl = NULL;
		}

		if (isset($_GET['LED-Back-Lights'])){
			$sLedBl = ' AND LED_Back_Lights = 1 ';
		}else{
			$sLedBl = NULL;
		}

		if (isset($_GET['Fog-Lights'])){
			$sFogL = ' AND Fog_Lights = 1 ';
		}else{
			$sFogL = NULL;
		}
		///// from am_select page

		if (isset($_GET['Isofix'])){
			$sIsofix = ' AND Isofix = 1 ';
		}else{
			$sIsofix = NULL;
		}

		if (isset($_GET['Alarm_System'])){
			$sAlarm = ' AND Alarm_System = 1 ';
		}else{
			$sAlarm = NULL;
		}

		if (isset($_GET['Keyless_Entry'])){
			$sKeyLess = ' AND Keyless_Entry = 1 ';
		}else{
			$sKeyLess = NULL;
		}  

		if (isset($_GET['Airbag_Driver'])){
			$sAirBagDrive = ' AND Airbag_Driver = 1 ';
		}else{
			$sAirBagDrive = NULL;
		}

		if (isset($_GET['Airbag_Passenger'])){
			$sAirBagPass = ' AND Airbag_Passenger = 1 ';
		}else{
			$sAirBagPass = NULL;
		}

		if (isset($_GET['Airbag_Side'])){
			$sAirBagSide = ' AND Airbag_Side = 1 ';
		}else{
			$sAirBagSide = NULL;
		}


		if (isset($_GET['AC_Rear'])){
			$sACrear = ' AND AC_Rear = 1 ';
		}else{
			$sACrear = NULL;
		}

		if (isset($_GET['AM_FM_Stereo'])){
			$sAmFm = ' AND AM_FM_Stereo = 1 ';
		}else{
			$sAmFm = NULL;
		}

		if (isset($_GET['Cassette_Player'])){
			$sCasset = ' AND Cassette_Player = 1 ';
		}else{
			$sCasset = NULL;
		}

		if (isset($_GET['CD'])){
			$sCd = ' AND CD = 1 ';
		}else{
			$sCd = NULL;
		}

		if (isset($_GET['MP3_Single_Disc'])){
			$sMp3 = ' AND MP3_Single_Disc = 1 ';
		}else{
			$sMp3 = NULL;
		}

		if (isset($_GET['DVD_System'])){
			$sDvd = ' AND DVD_System = 1 ';
		}else{
			$sDvd = NULL;
		}

		if (isset($_GET['Premium_Sound'])){
			$sPsound = ' AND Premium_Sound = 1 ';
		}else{
			$sPsound = NULL;
		}

		if (isset($_GET['Power_Windows'])){
			$sPwind = ' AND Power_Windows = 1 ';
		}else{
			$sPwind = NULL;
		}

		if (isset($_GET['Integrated_Phone'])){
			$sIphone = ' AND Integrated_Phone = 1 ';
		}else{
			$sIphone = NULL;
		}

		if (isset($_GET['Power_Steering'])){
			$sPsteer = ' AND Power_Steering = 1 ';
		}else{
			$sPsteer = NULL;
		}

		if (isset($_GET['Rear_Window_Defroster'])){
			$sRwind = ' AND Rear_Window_Defroster = 1 ';
		}else{
			$sRwind = NULL;
		}

		if (isset($_GET['Rear_Window_Wiper'])){
			$sRwindW = ' AND Rear_Window_Wiper = 1 ';
		}else{
			$sRwindW = NULL;
		}

		if (isset($_GET['Tinted_Glass'])){
			$sTglass = ' AND Tinted_Glass = 1 ';
		}else{
			$sTglass = NULL;
		}

		if (isset($_GET['Moonroof_Sunroof'])){
			$sMroof = ' AND Moonroof_Sunroof = 1 ';
		}else{
			$sMroof = NULL;
		}

		if (isset($_GET['Alloy_Wheels'])){
			$sAwheels = ' AND Alloy_Wheels = 1 ';
		}else{
			$sAwheels = NULL;
		}

		if (isset($_GET['Bucket_Seats'])){
			$sBseat = ' AND Bucket_Seats = 1 ';
		}else{
			$sBseat = NULL;
		}

		if (isset($_GET['Power_Steering'])){
			$sPsteering = ' AND Power_Steering = 1 ';
		}else{
			$sPsteering = NULL;
		}

		if (isset($_GET['Third_Row_Seats'])){
			$sTseat = ' AND Third_Row_Seats = 1 ';
		}else{
			$sTseat = NULL;
		}

		if (isset($_GET['Daylight_Auto'])){
			$sDaylight = ' AND Daylight_Auto = 1 ';
		}else{
			$sDaylight = NULL;
		}

		if (isset($_GET['xenon_Headlights'])){
			$sXenon = ' AND xenon_Headlights = 1 ';
		}else{
			$sXenon = NULL;
		}


		// Color Section 
		$allOcollors = getInnerColorAm();
		foreach ($allOcollors as $allOcollor) {
				$sColor = $allOcollor['AM_Color_Name'];
				$sColorID = $allOcollor['AM_Color_ID'];
				
			if (isset($_GET[$sColor]) ){
			 $oColor  = $sColor;
			 $sScolor[] = ' OR AM_Out_Color_ID = '. $sColorID;
			}else{$oColor = NULL ;
			// $sScolor = NULL;
			}
			
		}
		// Change color array to String
		if (!empty($sScolor)){
			$colorString = implode($sScolor); // Change color array to String
			$colorString = preg_replace('/OR/','AND',$colorString,1);//replace first OR
		}else{ $colorString = NULL;}

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


<h2 class="text-center"><?php getTE('Automobile'); ?></h2>	

<div class="container">
	<div class="row">
		<div class="col col-md-3"> <!--controls Section -->
			<div class="row">
				<form action="<?php echo $_SERVER['PHP_SELF'].'?pageid='.$pageid?>" method="GET">
					<input type="hidden" name="pageid" value="<?php echo $pageid ;?>" >
				<div class="col col-md-12 ">

				<div class="control-box">
				<p class="details-packet-title"><?php getTE('Model');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	

				<data class="details-packet">

					<div>
						<p><?php getTE('Maker'); ?></p>
					<select name="maker" class="form-control" id="maker-list" onChange="getModel(value) ">
						<?php 
						if(isset($maker)){ 

							$SamMakers = superGet('*','makes',"makes.id = $maker");
							foreach ($SamMakers as $SamMaker) {
								echo '<option value="'.$SamMaker['id'].'">'.$SamMaker['Make_Name'].'</option>';
							}
							
						}else{
							echo '<option value="">'.getT("Not Set").'</option>';
						}
							$amMakers = superGet('*','makes');
							foreach ($amMakers as $amMaker) {
								echo '<option value="'.$amMaker['id'].'">'.$amMaker['Make_Name'].'</option>';
							}
						?>
					</select>
					</div>


					<div>
						<p><?php getTE('Model'); ?></p>
					<select name="model" class="form-control" id="mod-list" >
						<?php 
						
						if(isset($model)){ // From Get

							$SamModels = superGet('*','models',"models.id = $model");
							foreach ($SamModels as $SamModel) {
								echo '<option value="'.$SamModel['id'].'">'.$SamModel['Model_Name'].'</option>';
							}
							
						} /*else{
							echo '<option value="">Not Set</option>';
						}
							$amModels = superGet('*','models');
							foreach ($amModels as $amModel) {
								echo '<option value="'.$amModel['id'].'">'.$amModel['Model_Name'].'</option>';
							}
							*/
						?>
					</select>
				</div>
				</data><!-- Model Packet -->
				</div>

				<div class="control-box">
				<p class="details-packet-title"><?php getTE('Dates');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	
				<data class="details-packet">


					<div class="">
						<p><?php getTE('Production Date'); ?></p>
						<div class="">
						<select class="form-control " name="prodate-f" >
							<?php 
							if (isset($proDate)){
								echo '<option value="'.$proDate.'">'.$proDate.'</option>';
							}
							echo '<option value="">'.getT('From').'</option>';
							for($i = 2018; $i>=1950; $i--){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							?>
							
						</select>
						</div>
						<div class="">
						<select class="form-control " name="prodate-t" >
							<?php 
							if (isset($proDate)){
								echo '<option value="'.$proDate.'">'.$proDate.'</option>';
							}
							echo '<option value="" >'.getT('To').'</option>';
							for($i = 2018; $i>=1950; $i--){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}

							?>
						</select>
						</div>
						
					</div>

					<div class="">
						<p><?php getTE('First registering'); ?></p>
						<div class="">
							<input type="month" class="form-control " name="regist-f" >				
						</div>
						<div class="">
							<input type="month" class="form-control " name="regist-t">	
						</div>
					</div>
				</data><!-- Dates -->
				</div>


				<div class="control-box">
				<p class="details-packet-title"><?php getTE('Price');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	
				<div class="details-packet">

					<div class="">
						<p><?php getTE('Price'); ?></p>
						<div class="">
							<input class="form-control" type="number" name="price-f" placeholder="<?php getTE('From');?>">
						</div>
						<div class="">
							<input class="form-control" type="number" name="price-t" placeholder="<?php getTE('To');?>">
						</div>
					</div>
				</div><!-- price-->
				</div>

				<div class="control-box">
				<p class="details-packet-title"><?php getTE('Details');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	
				<data class="details-packet">

					<div>
						<p><?php getTE('Milage'); ?></p>
						<input class="form-control" type="number" name="milage" value="<?php echo $_GET['milage'] ;?>">
					</div>

					<div>
						<p><?php getTE('Body'); ?></p>
					<select name="body" class="form-control">
						<?php 
						if(isset($body)){ 

							$SamBodys = getInnerBodyAm("am_body_types_ml.AM_Body_Type_ID = $body");
							foreach ($SamBodys as $SamBody) {
								echo '<option value="'.$SamBody['AM_Body_Type_ID'].'">'.$SamBody['AM_Body_Type_Name'].'</option>';
							}
							
						}else{
							echo '<option value=""> '.getT("Not Set").'</option>';
						}
							$amBodys = getInnerBodyAm();
							foreach ($amBodys as $amBody) {
								echo '<option value="'.$amBody['AM_Body_Type_ID'].'">'.$amBody['AM_Body_Type_Name'].'</option>';
							}
						?>
					</select>
					</div>


					<div>
						<p><?php getTE('Fuel'); ?></p>
					<select name="fuel" class="form-control">
						<?php 
						if(isset($fuel)){ 

							$SamFuels = getInnerFuelAm("am_fuel.AM_Fuel_ID = $fuel");
							foreach ($SamFuels as $SamFuel) {
								echo '<option value="'.$SamFuel['AM_Fuel_ID'].'">'.$SamFuel['AM_Fuel_Name'].'</option>';
							}
							
						}else{
							echo '<option value="">'.getT("Not Set").'</option>';
						}
							$amFuels = getInnerFuelAm();
							foreach ($amFuels as $amFuel) {
								echo '<option value="'.$amFuel['AM_Fuel_ID'].'">'.$amFuel['AM_Fuel_Name'].'</option>';
							} 
						?>
					</select>
					</div>

					<div>
						<p><?php getTE('Gear Box'); ?></p>
					<select name="gear-box" class="form-control">
						<?php 
						if(isset($gearbox)){ 

							$Sgearboxs = getInnerGearAm("am_gearboxes.AM_Gearbox_ID = $gearbox");
							foreach ($Sgearboxs as $Sgearbox) {
								echo '<option value="'.$Sgearbox['AM_Gearbox_ID'].'">'.$Sgearbox['AM_Gearbox_Name'].'</option>';
							}
							
						}else{
							echo '<option value="">'.getT("Not Set").'</option>';
						}
							$amGearboxs = getInnerGearAm();
							foreach ($amGearboxs as $amGearbox) {
								echo '<option value="'.$amGearbox['AM_Gearbox_ID'].'">'.$amGearbox['AM_Gearbox_Name'].'</option>';
							}
						?>
					</select>
					</div>

					<div>
						<p><?php getTE('Passengers'); ?></p>
						<input class="form-control" type="number" name="passengers" value="<?php echo $_GET['passengers'] ;?>">
					</div>

					
				</data><!-- Main detail -->
				</div>

				<div class="control-box">

				<p class="details-packet-title"><?php getTE('Environment');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	
				<data class="details-packet">

					<div>
						<p><?php getTE('Emissions'); ?></p>
						<select name="em-class" class="form-control">
							<?php 
							if(isset($emClass)){
								$sEmClasses = superGet('*','am_emissions_class',"AM_Emission_Class_ID = $emClass");
								foreach ($sEmClasses as $sEmClasse) {
									echo '<option value="'.$sEmClasse['AM_Emission_Class_ID'].'">'.$sEmClasse['AM_Emission_Class_Name'].'</option>';
								}
							}else{
								echo '<option value="">'.getT("Not Set").'</option>';
							}
							$emClasses = superGet('*','am_emissions_class');
								foreach ($emClasses as $emClasse) {
									echo '<option value="'.$emClasse['AM_Emission_Class_ID'].'">'.$emClasse['AM_Emission_Class_Name'].'</option>';
								}
							

							?>
						</select>
					</div>

					<div>
						<p><?php getTE('Emissions Sticker'); ?></p>
						<select name="em-sticker" class="form-control">  
							<?php 
							if(isset($emSticker)){
								$sEstickers = getInnerEStickAM("am_emission_stickers_ml.AM_Emission_Sticker_ID = $emSticker");
								foreach ($sEstickers as $sEsticker) {
									echo '<option value="'.$sEsticker['AM_Emission_Sticker_ID'].'">'.$sEsticker['AM_Emission_Sticker_Name'].'</option>';
								}
							}else{
								echo '<option value="">'.getT("Not Set").'</option>';
							}
							$eStickers = getInnerEStickAM();
								foreach ($eStickers as $eSticker) {
									echo '<option value="'.$eSticker['AM_Emission_Sticker_ID'].'">'.$eSticker['AM_Emission_Sticker_Name'].'</option>';
								}
							

							?>
						</select>
					</div>
				</data><!-- envirument -->
				</div>

				<div class="control-box">
				<p class="details-packet-title"><?php getTE('More Details');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	
				<data class="details-packet">


					<div>
						<p><?php getTE('Doors'); ?></p>
						<input class="form-control" type="text" name="doors"  value="<?php echo $doors ;?>">
					</div>

					<div>
						<p><?php getTE('Drive Type'); ?></p>
						<select name="drive-type" class="form-control">
							<?php 
							if(isset($driveType)){
								$sDriveTs = superGet('*','am_drive_type',"AM_Drive_Type_ID = $driveType");
								foreach ($sDriveTs as $sDriveT) {
									echo '<option value="'.$sDriveT['AM_Drive_Type_ID'].'">'.$sDriveT['AM_Drive_Type_Name'].'</option>';
								}
							}else{
								echo '<option value="">'.getT("Not Set").'</option>';
							}
							$DriveTs = superGet('*','am_drive_type');
								foreach ($DriveTs as $DriveT) {
									echo '<option value="'.$DriveT['AM_Drive_Type_ID'].'">'.$DriveT['AM_Drive_Type_Name'].'</option>';
								}
							

							?>
						</select>
					</div>

				</data><!-- more details Packet -->
				</div>

				<div class="control-box">
				<p class="details-packet-title"><?php getTE('Color');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	
				<data class="details-packet">
					

					<div class="out-color">
						<p><?php getTE('Exterior Color'); ?></p>
						<?php 
						$oColors = getInnerColorAm("am_colors.AM_Color_ID != 0");
						foreach ($oColors as $oColor) {
							?>
							<label class="" style="background-color: <?php echo $oColor['AM_Color_Code']; ?>;">
								<input type="checkbox" name="<?php echo $oColor['AM_Color_Name']; ?>" value="YES"  >
								<?php
								if(isset($_GET[$oColor['AM_Color_Name']])){$style='display:block;';}else{$style = NULL;}
								?>
								<span class="" style="<?php echo $style; ?>"><i class="fa fa-check" aria-hidden="true"></i></span>
							</label>

							<?php
						}
						?>
					</div>
				</data><!-- Colorss Packet -->
				</div>

				<div class="control-box">
				<p class="details-packet-title"><?php getTE('Equipments');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	
				<data class="details-packet">
					
					<div>
						<input class="" type="checkbox" name="AC_Front"  value="YES" <?php if(isset($_GET['AC_Front'])){echo 'checked';}?> >
						<lable><?php getTE('AC Front'); ?></lable>
					</div>

					<div>
						<input class="" type="checkbox" name="ABS"  value="YES" <?php if(isset($_GET['ABS'])){echo 'checked';}?> >
						<lable><?php getTE('ABS'); ?></lable>
					</div>

					<div>
						<input class="" type="checkbox" name="ESP"  value="YES" <?php if(isset($_GET['ESP'])){echo 'checked';}?> >
						<lable><?php getTE('ESP'); ?></lable>
					</div>

					<div>
						<input class="" type="checkbox" name="Navigation"  value="YES" <?php if(isset($_GET['Navigation'])){echo 'checked';}?> >
						<lable><?php getTE('Navigation'); ?></lable>
					</div>

					<div>
						<input class="" type="checkbox" name="Memory-Seats"  value="YES" <?php if(isset($_GET['Memory-Seats'])){echo 'checked';}?> >
						<lable><?php getTE('Memory Seats'); ?></lable>
					</div>

					<div>
						<input class="" type="checkbox" name="Leather-Interior"  value="YES" <?php if(isset($_GET['Leather-Interior'])){echo 'checked';}?> >
						<lable><?php getTE('Leather Interior'); ?></lable>
					</div>

					<div>
						<input class="" type="checkbox" name="LED-Front-Lights"  value="YES" <?php if(isset($_GET['LED-Front-Lights'])){echo 'checked';}?> >
						<lable><?php getTE('LED Front Lights'); ?></lable>
					</div>


					<div>
						<input class="" type="checkbox" name="LED-Back-Lights"  value="YES" <?php if(isset($_GET['LED-Back-Lights'])){echo 'checked';}?> >
						<lable><?php getTE('LED Back Lights'); ?></lable>
					</div>

					<div>
						<input class="" type="checkbox" name="Fog-Lights"  value="YES" <?php if(isset($_GET['Fog-Lights'])){echo 'checked';}?> >
						<lable><?php getTE('Fog Lights'); ?></lable>
					</div>
				</data><!-- Colorss Packet -->
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

				<div class="text-center">
					<a href="am_select.php"><?php getTE('More Details ');?> >></a>				
				</div>

				
				<div class="text-center">
					<input type="submit" value="<?php getTE('Search');?>" class="btn btn-red col-sm-3 fixt-btn">
				</div>

				</div>
				</form>
			</div>

			<div>
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- Left side -->
				<ins class="adsbygoogle"
				     style="display:block"
				     data-ad-client="ca-pub-4112940950021564"
				     data-ad-slot="5959915373"
				     data-ad-format="auto"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
								
			</div>

		</div>

	<div class="col col-md-9"> <!--page Section -->
		<div class="container">
	<div class="row">
<!--
		<div class="col col-md-3">
			<?php getCatParent("80"); ?>
		</div>
-->
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


	</div>
</div>

	<?php 

		//$items = getInnerItemAM();   "items.Category_ID = $pageid" 
 
			
	if( isset($usingStatus) || isset($sMaker) || isset($sModel) || isset($sProDateF) || isset($sProDateT) || isset($sProDateF) || isset($sRegDateF)|| isset($sRegDateT) || isset($sPriceF) || isset($sPriceT) ||  isset($sFuel) || isset($sGearbox) || isset($sPassengers) || isset($sDoors) || isset($sMilage) || isset($sBody) || isset($sDriveType) || isset($sEmClass) || isset($sEmSticker) || isset($colorString) || isset($sCountry) || isset($sRegion) || isset($sCity) || isset($sZip) || isset($sIsofix) || isset($sAlarm) || isset($sKeyLess) || isset($sAirBagDrive) || isset($sAirBagPass) || isset($sAirBagSide) || isset($sACfront) || isset($sACrear) || isset($sACrear) || isset($sAmFm) || isset($sCasset) || isset($sCd) || isset($sMp3) || isset($sDvd) || isset($sPsound) || isset($sPwind) || isset($sIphone) || isset($sPsteer) || isset($sRwind) || isset($sRwindW) || isset($sTglass) || isset($sMroof) || isset($sAwheels) || isset($sBseat) || isset($sPsteering) || isset($sTseat) || isset($sDaylight) || isset($sXenon) || isset($rLocString))  {

		$rools = $usingStatus .$sMaker .  $sModel . $sMilage . $sProDateF . $sProDateT . $sProDateF . $sRegDateT . $sRegDateF . $sPriceF . $sPriceT . $sFuel. $sGearbox . $sPassengers . $sDoors . $sBody . $sDriveType . $sEmClass . $sEmSticker . $sAbs . $sEsp . $sNavi  . $sMemSeat . $sLether . $sLedFl . $sLedBl . $sFogL . $colorString . $sMaker2 .$sMaker3 . $sModel2 .$sModel3 .$sCountry . $sRegion . $sCity . $sZip .$sIsofix . $sAlarm . $sKeyLess . $sAirBagDrive .$sAirBagPass . $sAirBagSide . $sACfront . $sACrear . $sAmFm . $sCasset . $sCd . $sMp3 . $sDvd . $sPsound . $sPwind . $sIphone . $sPsteer . $sRwind . $sRwindW . $sTglass . $sMroof . $sAwheels . $sBseat . $sPsteering . $sTseat . $sDaylight . $sXenon . $rLocString;


	}else{$rools = "categories.Category_ID = $pageid";}

		$rools = preg_replace('/AND/','',$rools,1).' AND items.Item_Display = 1 '; //ReMov & Add Display Rool

	    //    echo 'ROOLS ='.$rools;

			autosGrid($rools,$order, $limit) ;

			?>
		<!-- Start LIMIT -->
		<div class="result-limit">
			<?php 
			// Get all AM_Items Count
			$orderLink = getLink($_GET,"limit");
			$allItems = getInnerItemAM($rools);
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
		<!-- End LIMIT -->


		</div>


	</div>
	
</div>

<?php

////////////////Save the Search///////////////////
	    
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
		if(!empty($_GET['prodate-f'])){$proDateF = $_GET['prodate-f'];}else{$proDateF = 0;}
		if(!empty($_GET['prodate-t'])){$proDateT = $_GET['prodate-t'];}else{$proDateT = 0;}
		if(!empty($_GET['fuel'])){$fuel = $_GET['fuel'];}else{$fuel = 0;}
		if(!empty($_GET['body'])){$body = $_GET['body'];}else{$body = 0;}
		if(!empty($_GET['gear-box'])){$gearbox = $_GET['gear-box'];}else{$gearbox = 0;}
		if(!empty($_GET['passengers'])){$passengers = $_GET['passengers'];}else{$passengers = 0;}
		if(!empty($_GET['doors'])){$doors = $_GET['doors'];}else{$doors = 0;}
		if(!empty($_GET['milage'])){$milage = $_GET['milage'];}else{$milage = 0;}
		if(!empty($_GET['regist-f'])){$refDateF = $_GET['regist-f'];}else{$refDateF = 0;}
		if(!empty($_GET['em-class'])){$emClass = $_GET['em-class'];}else{$emClass = 0;}
		if(!empty($_GET['em-sticker'])){$emSticker = $_GET['em-sticker'];}else{$emSticker = 0;}
		if(!empty($_GET['drive-type'])){$driveType = $_GET['drive-type'];}else{$driveType = 0;}
		if(!empty($_GET['ABS'])){$abs = 1;}else{$abs = 0;}
		if(!empty($_GET['ESP'])){$esp = 1;}else{$esp = 0;}
		if(!empty($_GET['Alarm_System'])){$alarmSys = 1;}else{$alarmSys = 0;}
		if(!empty($_GET['AC_Front'])){$acFront = 1;}else{$acFront = 0;}
		if(!empty($_GET['AC_Rear'])){$acRear = 1;}else{$acRear = 0;}
		if(!empty($_GET['Navigation'])){$navi = 1;}else{$navi = 0;}
		if(!empty($_GET['Power_Windows'])){$poerS = 1;}else{$poerS = 0;}
		if(!empty($_GET['Keyless_Entry'])){$KeyLess = 1;}else{$KeyLess = 0;}
		if(!empty($_GET['Isofix'])){$Isofix = 1;}else{$Isofix = 0;}
		if(!empty($_GET['Integrated_Phone'])){$Iphone = 1;}else{$Iphone = 0;}
		if(!empty($_GET['Bucket_Seats'])){$bucketS = 1;}else{$bucketS = 0;}
		if(!empty($_GET['Leather_Interior'])){$letherS = 1;}else{$letherS = 0;}
		if(!empty($_GET['Memory_Seats'])){$memoryS = 1;}else{$memoryS = 0;}
		if(!empty($_GET['Power_Steering'])){$PowerSeat = 1;}else{$PowerSeat = 0;}//!
		if(!empty($_GET['Airbag_Driver'])){$abDriver = 1;}else{$abDriver = 0;}
		if(!empty($_GET['Airbag_Passenger'])){$abPass = 1;}else{$abPass = 0;}
		if(!empty($_GET['Airbag_Side'])){$abSide = 1;}else{$abSide = 0;}
		if(!empty($_GET['Power_Windows'])){$powerWind = 1;}else{$powerWind = 0;}
		if(!empty($_GET['Rear_Window_Defroster'])){$rearWind = 1;}else{$rearWind = 0;}
		if(!empty($_GET['Rear_Window_Wiper'])){$rearwindW = 1;}else{$rearwindW = 0;}
		if(!empty($_GET['Tinted_Glass'])){$tGlass = 1;}else{$tGlass = 0;}
		if(!empty($_GET['AM_FM_Stereo'])){$AmFm = 1;}else{$AmFm = 0;}
		if(!empty($_GET['DVD_System'])){$dvd = 1;}else{$dvd = 0;}
		if(!empty($_GET['Cassette_Player'])){$cassette = 1;}else{$cassette = 0;}
		if(!empty($_GET['CD'])){$cd = 1;}else{$cd = 0;}
		if(!empty($_GET['MP3_Single_Disc'])){$mp3 = 1;}else{$mp3 = 0;}
		if(!empty($_GET['Premium_Sound'])){$pSound = 1;}else{$pSound = 0;}
		if(!empty($_GET['Alloy_Wheels'])){$aWheels = 1;}else{$aWheels = 0;}
		if(!empty($_GET['Moonroof_Sunroof'])){$moonS = 1;}else{$moonS = 0;}
		if(!empty($_GET['Third_Row_Seats'])){$therdRseat = 1;}else{$therdRseat = 0;}
		if(!empty($_GET['xenon_Headlights'])){$xenon = 1;}else{$xenon = 0;}
		if(!empty($_GET['LED_Front_Lights'])){$fLight = 1;}else{$fLight = 0;}
		if(!empty($_GET['LED_Back_Lights'])){$bLight = 1;}else{$bLight = 0;}
		if(!empty($_GET['Daylight_Auto'])){$dayLight = 1;}else{$dayLight = 0;}
		if(!empty($_GET['Fog_Lights'])){$FogLight = 1;}else{$FogLight = 0;}


	  $stmt = $con->prepare("INSERT INTO am_items_search( IP,
	  													  Maker_ID,
	  													  Model_ID, 
	  													  AM_Production_From,
	  													  AM_Production_To,
	  													  AM_Fuel_ID,
	  													  AM_Body_ID,
	  													  AM_Using_ID,
	  													  AM_Gearbox_ID,
	  													  AM_Passengers,
	  													  AM_Doors,
	  													  AM_Mileage,
	  													  AM_First_Regist,
	  													  Emissions_Class_ID,
	  													  Emission_Sticker_ID,
	  													  AM_Drive_Type_ID,
	  													  ABS,
	  													  ESP,
	  													  Alarm_System,
	  													  isofix,
	  													  AC_Front,
	  													  AC_Rear,
	  													  Navigation,
	  													  Power_Steering,
	  													  Keyless_Entry,
	  													  Integrated_Phone,
	  													  Bucket_Seats,
	  													  Leather_Interior,
	  													  Memory_Seats,
	  													  Power_Seats,
	  													  Airbag_Driver,
	  													  Airbag_Passenger,
	  													  Airbag_Side,
	  													  Power_Windows,
	  													  Rear_Window_Defroster,
	  													  Rear_Window_Wiper,
	  													  Tinted_Glass,
	  													  AM_FM_Stereo,
	  													  DVD_System,
	  													  Cassette_Player,
	  													  CD,
	  													  MP3_Single_Disc,
	  													  Premium_Sound,
	  													  Alloy_Wheels,
	  													  Moonroof_Sunroof,
	  													  Third_Row_Seats,
	  													  xenon_Headlights,
	  													  LED_Front_Lights,
	  													  LED_Back_Lights,
	  													  Daylight_Auto,
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
                            				:zpasseng,
                            				:zdoors,
                            				:zmilage,
                            				:zfregist,
                            				:zemisclass,
                            				:zemisstic,
                            				:zdrivet,
                            				:zabs,
                            				:zsep,
                            				:zalarmsys,
                            				:zisofix,
                            				:zacfront,
                            				:zacrear,
                            				:znav,
                            				:zpoers,
                            				:zkeyless,
                            				:zinphone,
                            				:zbucket,
                            				:zleatherin,
                            				:zmemseat,
                            				:zpowerset,
                            				:zabdriver,
                            				:zabpass,
                            				:zabside,
                            				:zpowerwind,
                            				:zrearwind,
                            				:zrearwwind,
                            				:ztintglass,
                            				:zamfm,
                            				:DVD_System,
                            				:zcasset,
                            				:zcd,
                            				:zmp3,
                            				:zpsound,
                            				:zalloyw,
                            				:zmoonr,
                            				:ztrows,
                            				:zxenon,
                            				:zledf,
                            				:zledb,
                            				:zdayl,
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
                        'zgearb'       => $gearbox,
                        'zpasseng'	   => $passengers,
                        'zdoors'       => $doors,
                        'zmilage'      => $milage,
                        'zfregist'     => $refDateF,
                        'zemisclass'   => $emClass,
                        'zemisstic'    => $emSticker,
                        'zdrivet'	   => $driveType,
                        'zabs'		   => $abs,
                        'zsep'         => $esp,
                        'zalarmsys'    => $alarmSys,
                        'zisofix'      => $Isofix,
                        'zacfront'	   => $acFront,
                        'zacrear'	   => $acRear,
                        'znav'		   => $navi,
                        'zpoers'	   => $poerS,
                        'zkeyless'	   => $KeyLess,
                        'zinphone'     => $Iphone,
                        'zbucket'	   => $bucketS,
                        'zleatherin'   => $letherS,
                        'zmemseat'     => $memoryS,
                        'zpowerset'    => $PowerSeat,
                        'zabdriver'    => $abDriver,
                        'zabpass'      => $abPass,
                        'zabside'      => $abSide,
                        'zpowerwind'   => $powerWind,
                        'zrearwind'    => $rearWind,
                        'zrearwwind'   => $rearwindW,
                        'ztintglass'   => $tGlass,
                        'zamfm'        => $AmFm,
                        'DVD_System'   => $dvd,
                        'zcasset'      => $cassette,
                        'zcd'          => $cd,
                        'zmp3'         => $mp3,
                        'zpsound'      => $pSound,
                        'zalloyw'      => $aWheels,
                        'zmoonr'       => $moonS,
                        'ztrows'       => $therdRseat,
                        'zxenon'       => $xenon,
                        'zledf'        => $fLight,
                        'zledb'        => $bLight,
                        'zdayl'        => $dayLight,
                        'zfogl'		   => $FogLight
                    
                         ));
	

   /// Get Using Status

/*


		if(!empty($_GET['maker'])){$maker = $_GET['maker'];}else{$maker = 0;}


	  $stmt = $con->prepare("INSERT INTO am_items_search( Maker_ID
	  													 		)
                            		VALUES( :zmakerid

                            							)");
        $stmt->execute(array(
                        
                        'zmakerid'     => $maker
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