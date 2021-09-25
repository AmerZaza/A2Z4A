<?php 
ob_start();
session_start();

$pageTitle = 'Items Compare | A to Z for All';
    
include 'init.php';

echo '<h1 class="text-center">'.getT('Compare').'</h1>';

if(!empty($_COOKIE)){
	$allArray = array_keys($_COOKIE,'compare') ;
	foreach ($allArray as $key => $value) {
		$value = trim($value,'compare'); // to remove adder prifix

		// Sort items to Categories

		// Collect AM Items
		$amItemTS = getInnerItemAM("items.Item_ID = $value");
		if(!empty($amItemTS)){
			foreach ($amItemTS as $amItemT) {
				$amItems[] = $amItemT;
			}
		}

		// Collect WS Items
		$wsItemTS = getInnerItemWS("items.Item_ID = $value");
		if(!empty($wsItemTS)){
			foreach ($wsItemTS as $wsItemT) {
				$wsItems[] = $wsItemT;
			}
		}

		// Collect RE Items
		$reItemTS = getInnerItemRE("items.Item_ID = $value");
		if(!empty($reItemTS)){
			foreach ($reItemTS as $reItemT) {
				$reItems[] = $reItemT;
			}
		}

	}
}

if(!empty($amItems)){ // if AMitems not empty
?>
<div class="container">
	    
	    <div class="cmpare-table">
	    	<div class="row">

	    	<div class="col col-xs-4 col-md-2">

			<img  src="images/items/<?php echo 'NULL.png' ; ?>" alt="" />

		<ul>
			
			<li><p><?php getTE('Item Number');?></p></li>
			<li><p><?php getTE('Item Name');?></p></li>
			<li><p><?php getTE('Price') ;?></p></li>
			<li><p><?php getTE('Milage');?></p></li>
			<li><p><?php getTE('Fuel');?></p></li>
			<li><p><?php getTE('Gear Box');?></p></li>
			<li><p><?php getTE('Passengers');?></p></li>
			<li><p><?php getTE('Owner Order');?></p></li>
			<li><p><?php getTE('Co2') ;?></p></li>
			<li><p><?php getTE('Emissions Class') ;?></p></li>
			<li><p><?php getTE('Emissions Sticker') ;?></p></li>
			<li><p><?php getTE('ABS') ;?></p></li>
			<li><p><?php getTE('ESP')  ;?></p></li>
			<li><p><?php getTE('Alarm System');?></p></li>
			<li><p><?php getTE('Isofix');?></p></li>
			<li><p><?php getTE('AC Front');?></p></li>
			<li><p><?php getTE('AC Rear');?></p></li>
			<li><p><?php getTE('Navigation') ;?></p></li>
			<li><p><?php getTE('Power Steering');?></p></li>
			<li><p><?php getTE('Keyless Entry') ;?></p></li>
			<li><p><?php getTE('Power Seats') ;?></p></li>
			<li><p><?php getTE('Airbag Driver') ;?></p></li>
			<li><p><?php getTE('Airbag Passenger');?></p></li>
			<li><p><?php getTE('Airbag Side') ;?></p></li>
			<li><p><?php getTE('xenon Headlights');?></p></li>
			<li><p><?php getTE('LED Front Lights');?></p></li>
			<li><p><?php getTE('LED Back Lights') ;?></p></li>
			<li><p><?php getTE('Daylight') ;?></p></li>
			<li><p><?php getTE('Fog Lights') ;?></p></li>
			<li><p><?php getTE('Tinted Glass') ;?></p></li>
			<li><p><?php getTE('AM/FM Stereo') ;?></p></li>
			<li><p><?php getTE('Cassette Player');?></p></li>
			<li><p><?php getTE('CD') ;?></p></li>
			<li><p><?php getTE('MP3 Disc');?></p></li>
			<li><p><?php getTE('Premium Sound') ;?></p></li>
			<li><p><?php getTE('DVD System') ;?></p></li>
			<li><p><?php getTE('Alloy Wheels') ;?></p></li>
			<li><p><?php getTE('Moonroof Sunroof');?></p></li>
			<li><p><?php getTE('Third Row Seats') ;?></p></li>
			<li class="pro-compare"><p><?php getTE('Provider') ;?></p></li>
			<li><p><?php getTE('Remove from the List') ;?></p></li>

		</ul>
	</div>
	
	    	
		<?php 

		foreach ($amItems as $item) {
			$itemid = $item['Item_ID'];


//////////////Get Am Items Details//////////////////
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

		// Provider
		$ProviderID =  $item['User_ID'];
		$pros = getInnerProvider("providers.User_ID = $ProviderID");
		foreach ($pros as $pro) {}


////////////////Start Table ///////////////////
		
		$images = superGet('*','items_images',"Item_ID= $itemid AND Ist_Main = 1") ;

           // Set $img = Default if ther is no image
               if (!empty ($images)){
               	
                foreach ($images as $imge){
                        $img = $imge['Item_Image'];
                    }
                }else {
                    $img = 'item.jpg';
                }
           //Get Category Code
                $catID = $item['Category_ID'];
                $cats = superGet('Item_Page_Code','categories',"Category_ID = $catID");
                foreach ($cats as $cat) {}
                	$caCode = $cat['Item_Page_Code'];
                
				?>
	<div class="col col-xs-4 col-md-2   ">
		<img  src="images/items/<?php echo $img ; ?>" alt="" />
		<ul>
			
			<li><p><a href="<?php echo $caCode.'.?itemid='.$item['Item_ID']; ?>"><?php echo 'AM'.$item['Item_ID'];?></p></a></li>
			<li><p><?php echo $item['Item_Name'];?></p></li>
			<li><p><?php echo $item['Main_Price'] .' '. $Currency['Currency_Code'];?></p></li>
			<li><p><?php echo $item['AM_Mileage'];?></p></li>
			<li><p><?php echo $fuel['AM_Fuel_Name'];?></p></li>
			<li><p><?php echo $gear['AM_Gearbox_Name'];?></p></li>
			<li><p><?php echo $item['AM_Passengers'];?></p></li>
			<li><p><?php echo $item['AM_Owner_Number'];?></p></li>
			<li><p><?php echo $item['Emissions_Co2'];?></p></li>
			<li><p><?php echo $eClasse['AM_Emission_Class_Name'];?></p></li>
			<li><p><?php echo $eSticker['AM_Emission_Sticker_Name'];?></p></li>

			<li><p><?php if($item['ABS'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['ESP'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Alarm_System'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Isofix'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['AC_Front'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['AC_Rear'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Navigation'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Power_Steering'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Keyless_Entry'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Power_Seats'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Airbag_Driver'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Airbag_Passenger'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Airbag_Side'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['xenon_Headlights'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['LED_Front_Lights'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['LED_Back_Lights'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Daylight_Auto'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Fog_Lights'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Tinted_Glass'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['AM_FM_Stereo'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Cassette_Player'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['CD'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['MP3_Single_Disc'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Premium_Sound'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['DVD_System'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Alloy_Wheels'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Moonroof_Sunroof'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li><p><?php if($item['Third_Row_Seats'] == 0){echo '-';}else{getTE('yes');}?></p></li>
			<li class="pro-compare">
				<p><?php getTE("Provider");?> : <a href="pro_profile.php?proid=<?php echo $pro['Provider_ID'];?>"><?php echo $pro['Provider_Name'];?></a></p>
                <p><?php  getTE("Contact Person");?>: <?php echo $pro['Contact_Person'];?> </p>
                <div class="">
                <img class="pro-img" src="images\profiles\<?php  echo $pro["User_Image"] ; ?>" alt="" />
                <a class="btn btn-primary" href="send_message.php?itemid=<?php echo $item['Item_ID'].'&resiverid='.$item['User_ID'] ?>" target="popup"> <?php  getTE("Send for Pro");?></a>
                </div>
			</li>

			<li>
				<input type="image" class="remove-compare" src="images/form/balance-icon.png" onClick="removeCompare(value)"  width="24px" value="<?php echo $item['Item_ID']; ?>" >

			</li>

		</ul>
	</div>	
			
<?php			
	}
			 
?>
	 </div>  
	</div>
</div>
<?php
}// END if AMitems not empty
if (!empty($wsItems)){ 
	?>
	<br><br>
	<div class="container">
	    
	    <div class="cmpare-table">
	    	<div class="row">

		    	<div class="col col-xs-4 col-md-2   ">

				<img  src="images/items/<?php echo 'NULL.png' ; ?>" alt="" />

				<ul>
					<li><p><?php getTE('Item Number');?></p></li>
					<li><p><?php getTE('Item Name');?></p></li>
					<li><p><?php getTE('Service');?></p></li>
					<li><p><?php getTE('Cost');?></p></li>
					<li><p><?php getTE('Maker');?></p></li>
					<li><p><?php getTE('Model');?></p></li>
					<li><p><?php getTE('Time');?></p></li>
					<li class="pro-compare"><p><?php getTE('Provider') ;?></p></li>
					<li><p><?php getTE('Remove from the List') ;?></p></li>
							
				</ul>
			</div>
	<?php 
	foreach ($wsItems as $item) {
		//Get Category Code
                $catID = $item['Category_ID'];
                $cats = superGet('Item_Page_Code','categories',"Category_ID = $catID");
                foreach ($cats as $cat) {}
                	$caCode = $cat['Item_Page_Code'];

                if(isset($item['Maker_ID'])){
                	$makerID = $item['Maker_ID'];
                $makers = superGet('Make_Name','makes',"id = $makerID");
                foreach($makers as $maker){}
                	$makerName = $maker['Make_Name'];

                }else{$makerName = $getT('All');}
                
                if(isset($item['Model_ID'])){
                	$modelID = $item['Model_ID'];
                $models = superGet('Model_Name','models',"id = $modelID");
                foreach($models as $model){}
                	$modelName = $model['Model_Name'];
                }else{$modelName = getT('All');}

                // Provider
				$ProviderID =  $item['User_ID'];
				$pros = getInnerProvider("providers.User_ID = $ProviderID");
		foreach ($pros as $pro) {}
   
				?>
	<div class="col col-xs-4 col-md-2   ">
			<div style="height: 90px">
			<h2 class="text-center"><?php echo $item['WS_Service_Icon'];?></h2>
			</div>
			<ul>
				
				<li><p><a href="<?php echo $caCode.'.?itemid='.$item['Item_ID']; ?>"><?php echo 'WS'.$item['Item_ID'];?></a></p></li>
				<li><p><?php echo $item['Item_Name'];?></p></li>
				<li><p><?php echo $item['Main_Price'] .' '.$item['Currency_Code'];?></p></li>
				<li><p><?php echo $item['WS_Service_Name'];?></p></li>
				<li><p><?php echo $makerName;?></p></li>
				<li><p><?php echo $modelName;?></p></li>
				<li><p><?php echo $item['Expected_Time'];?></p></li>
				<li class="pro-compare">
					<p><?php getTE("Provider");?> : <a href="pro_profile.php?proid=<?php echo $pro['Provider_ID'];?>"><?php echo $pro['Provider_Name'];?></a></p>
	                <p><?php  getTE("Contact Person");?>: <?php echo $pro['Contact_Person'];?> </p>
	                <div class="">
	                <img class="pro-img" src="images\profiles\<?php  echo $pro["User_Image"] ; ?>" alt="" />
	                <a class="btn btn-primary" href="send_message.php?itemid=<?php echo $item['Item_ID'].'&resiverid='.$item['User_ID'] ?>" target="popup"> <?php  getTE("Send for Pro");?></a>
	                </div>
				</li>

				<li>
					<input type="image" class="remove-compare" src="images/form/balance-icon.png" onClick="removeCompare(value)"  width="24px" value="<?php echo $item['Item_ID']; ?>" >

				</li>
			</ul>
		</div>
	<?php
	}
	?>
		
		</div>
	</div>
</div>


<?php
}// END if WSitems not empty
if (!empty($reItems)){ 
	?>
	<br><br>
	<div class="container">
	    
	    <div class="cmpare-table">
	    	<div class="row">

		    	<div class="col col-xs-4 col-md-2   ">

				<img  src="images/items/<?php echo 'NULL.png' ; ?>" alt="" />
 
				<ul>
					<li><p><?php getTE('Item Number');?></p></li>
					<li><p><?php getTE('Item Name');?></p></li>
					<li><p><?php getTE('Cost');?></p></li>

					<li><p><?php getTE('Praxis');?></p></li>
					<li><p><?php getTE('Type');?></p></li>
					<li><p><?php getTE('Area');?></p></li>
					<li><p><?php getTE('Rooms');?></p></li>
					<li><p><?php getTE('Bath Rooms');?></p></li>
					<li><p><?php getTE('Kitchen');?></p></li>
					<li><p><?php getTE('Heating system');?></p></li>
					<li><p><?php getTE('Floor');?></p></li>
					<li><p><?php getTE('Furnished');?></p></li>

					<li><p><?php getTE('Available From');?></p></li>
					<li><p><?php getTE('Available To');?></p></li>
					<li><p><?php getTE('Building');?></p></li>
					<li><p><?php getTE('Repaire');?></p></li>
					<li class="pro-compare"><p><?php getTE('Provider') ;?></p></li>
					<li><p><?php getTE('Remove from the List') ;?></p></li>
				</ul>
			</div>
			<?php 
			foreach ($reItems as $item) {
				$itemid = $item['Item_ID'];
				//Get Category Code
                $catID = $item['Category_ID'];
                $cats = superGet('Item_Page_Code','categories',"Category_ID = $catID");
                foreach ($cats as $cat) {}
                	$caCode = $cat['Item_Page_Code'];

                // Provider
				$ProviderID =  $item['User_ID'];
				$pros = getInnerProvider("providers.User_ID = $ProviderID");
				foreach ($pros as $pro) {}

				// Get Furnitsh Status
				if($item['RE_Furnished'] == 1){
					$furnished = getT('Yes');
				}else{$furnished = getT('No');}

				// Get Heating
				$heatingID = $item['RE_Heating_ID'];
				$heatings = getInnerHeatingRE("re_heating.RE_Heating_ID = $heatingID");
				foreach ($heatings as $heating) {}
				
				//Get Image
				$images = superGet('*','items_images',"Item_ID= $itemid AND Ist_Main = 1") ;

           // Set $img = Default if ther is no image
               if (!empty ($images)){
               	
                foreach ($images as $imge){
                        $img = $imge['Item_Image'];
                    }
                }else {
                    $img = 'item.jpg';
                }

		?>
		<div class="col col-xs-4 col-md-2   ">

		<img  src="images/items/<?php echo $img ; ?>" alt="" />
		
			<ul>
				<li><p><a href="<?php echo $caCode.'.?itemid='.$item['Item_ID']; ?>"><?php echo 'RE'.$item['Item_ID'];?></a></p></li>
				<li><p><?php echo $item['Item_Name'];?></p></li>
				<li><p><?php echo $item['Main_Price'] .' '.$item['Currency_Code'];?></p></li>
				<li><p><?php echo $item['Praxis_Name'];?></p></li>
				<li><p><?php echo $item['Type_Name'];?></p></li>
				<li><p><?php echo $item['RE_Area'];?></p></li>
				<li><p><?php echo $item['RE_Room'];?></p></li>
				<li><p><?php echo $item['RE_Bath'];?></p></li>
				<li><p><?php echo $item['RE_Kitchen'];?></p></li>
				<li><p><?php echo $heating['RE_Heating_Name'];?></p></li>
				<li><p><?php echo $item['RE_Floor'];?></p></li>
				<li><p><?php echo $furnished;?></p></li>
				<li><p><?php echo $item['RE_Available_From'];?></p></li>
				<li><p><?php echo $item['RE_Available_To'];?></p></li>
				<li><p><?php echo $item['RE_Creation'];?></p></li>
				<li><p><?php echo $item['RE_Renewal'];?></p></li>
				<li class="pro-compare">
				<p><?php getTE("Provider");?> : <a href="pro_profile.php?proid=<?php echo $pro['Provider_ID'];?>"><?php echo $pro['Provider_Name'];?></a></p>
                <p><?php  getTE("Contact Person");?>: <?php echo $pro['Contact_Person'];?> </p>
                <div class="">
                <img class="pro-img" src="images\profiles\<?php  echo $pro["User_Image"] ; ?>" alt="" />
                <a class="btn btn-primary" href="send_message.php?itemid=<?php echo $item['Item_ID'].'&resiverid='.$item['User_ID'] ?>" target="popup"> <?php  getTE("Send for Pro");?></a>
                </div>
			</li>

			<li>
				<input type="image" class="remove-compare" src="images/form/balance-icon.png" onClick="removeCompare(value)"  width="24px" value="<?php echo $item['Item_ID']; ?>" >
			</li>

			</ul>
			
		</div>
		<?php	
} ?>
	</div>
</div>
</div>

<?php
}// End if RE items not empty
include  $tpl . "footer.php";?>