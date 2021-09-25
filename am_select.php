<?php 
ob_start();
session_start();


$pageTitle = 'Select Automobiles Details';
    
include 'init.php';
?>
<div class="container">
	<div class="row">
		<div class="col col-md-12"> <!--controls Section -->
			<div class="row">
				<form action="am_items.php" method="GET">

				<input type="hidden" name="pageid" value="80">

				<div class="col col-md-12 ">

				<div class="control-box">
				<p class="control-title"><?php getTE('Model');?> <span class=""><i class="fas fa-car"></i></span> </p>	

				<div class="">

					<div class="col col-md-6">
						<label><?php getTE('Maker'); ?></label>
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


					<div class="col col-md-6">
						<label><?php getTE('Model'); ?></label>
					<select name="model" class="form-control" id="mod-list" >
						<?php 
						
						if(isset($model)){ // From Get

							$SamModels = superGet('*','models',"models.id = $model");
							foreach ($SamModels as $SamModel) {
								echo '<option value="'.$SamModel['id'].'">'.$SamModel['Model_Name'].'</option>';
							}
						} 
						?>
					</select>
				</div>

				<a href="#" class="add-model"><?php getTE('other model');?></a>

				</div><!-- Model Packet -->


				<div class="select-model row">

					<div class="col col-md-6">
						<label><?php getTE('Maker'); ?></label>
					<select name="maker2" class="form-control" id="maker-list" onChange="getModel2(value) ">
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


					<div class="col col-md-6">
						<label><?php getTE('Model'); ?></label>
					<select name="model2" class="form-control" id="mod-list2" >
						<?php 
						
						if(isset($model)){ // From Get

							$SamModels = superGet('*','models',"models.id = $model");
							foreach ($SamModels as $SamModel) {
								echo '<option value="'.$SamModel['id'].'">'.$SamModel['Model_Name'].'</option>';
							}
							
						} 
						?>
					</select>
				</div>

				<a href="#" class="add-model"><?php getTE('other model');?></a>

				</div><!-- Model Packet -->


				<div class="select-model row">

					<div class="col col-md-6">

						<label><?php getTE('Maker'); ?></label>
					<select name="maker3" class="form-control" id="maker-list" onChange="getModel3(value) ">
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
					


				<div class="col col-md-6">
						<label><?php getTE('Model'); ?></label>
					<select name="model3" class="form-control" id="mod-list3" >
						<?php 
						
						if(isset($model)){ // From Get

							$SamModels = superGet('*','models',"models.id = $model");
							foreach ($SamModels as $SamModel) {
								echo '<option value="'.$SamModel['id'].'">'.$SamModel['Model_Name'].'</option>';
							}
							
						} 
						?>
					</select>
				</div>

				</div><!-- Model Packet -->

			


				</div>

				<div class="control-box">
				<p class="details-packet-title"><?php getTE('Dates');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	
				<data class="details-packet">


					<div class="col-md-6">
						<label><?php getTE('Production Date'); ?></label>
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

					<div class="col-md-6">
						<label><?php getTE('First registering'); ?></label>
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
						<label class="col-md-12"><?php getTE('Price'); ?></label>
						<div class="col-md-6">
							<input class="form-control" type="number" name="price-f" placeholder="<?php getTE('From');?>">
						</div>
						<div class="col-md-6">
							<input class="form-control" type="number" name="price-t" placeholder="<?php getTE('To');?>">
						</div>
					</div>
				</div><!-- price-->
				</div>

				<div class="control-box">
				<p class="details-packet-title"><?php getTE('Location');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	

				<div class="details-packet">

    		      <div class="col-md-12">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Enter your address");?></label>
                            <div class="col-md-12" id="locationField">
                                <input id="autocomplete" placeholder="<?php getTE("Enter your address");?>"
                                onFocus="geolocate()" type="text" class="form-control">
                            </div>
                        </div>
                    </div> 


                    <div class="col-md-6">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Country");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="country"   id="country" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Region");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="region" id="administrative_area_level_1" readonly>
                            </div>
                        </div>
                    </div>

                      
                    <div class="col-md-6">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("City");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="city"   id="locality" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group container">
                            <label class="col-md-12 control-lable"><?php getTE("Zip Code");?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text"  name="zip"   id="postal_code" readonly>
                            </div>
                        </div>
                    </div>

                            
                    <input class="form-control" type="hidden" id="route">
                    <input class="form-control" type="hidden" id="street_number">

	                <div>
						<label class="col-md-12 control-lable"><?php getTE('Distance');?></label>
						<div class="col-xs-12">
							<input class="form-control" type="range" min="0" max="100" value=""  name="" id="dis-range">
						</div>
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

				</div><!-- Location-->



				<div class="control-box">
				<p class="details-packet-title"><?php getTE('Details');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	
				<data class="details-packet">

					<div class="col-md-6">
						<label><?php getTE('Milage'); ?></label>
						<input class="form-control" type="number" name="milage" value="<?php echo $_GET['milage'] ;?>">
					</div>

					<div class="col-md-6">
						<label><?php getTE('Body'); ?></label>
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


					<div class="col-md-6">
						<label><?php getTE('Fuel'); ?></label>
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

					<div class="col-md-6">
						<label><?php getTE('Gear Box'); ?></label>
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

					<div class="col-md-6">
						<label><?php getTE('Passengers'); ?></label>
						<input class="form-control" type="number" name="passengers" value="<?php echo $_GET['passengers'] ;?>">
					</div>

					
				</data><!-- Main detail -->
				</div>

				<div class="control-box">

				<p class="details-packet-title"><?php getTE('Environment');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	
				<data class="details-packet">

					<div class="col-md-6">
						<label><?php getTE('Emissions'); ?></label>
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

					<div class="col-md-6">
						<label><?php getTE('Emissions Sticker'); ?></label>
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


					<div class="col-md-6">
						<label><?php getTE('Doors'); ?></label>
						<input class="form-control" type="text" name="doors"  value="">
					</div>

					<div class="col-md-6">
						<label><?php getTE('Drive Type'); ?></label>
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
					

					<div >
						<div class="">
						<label><?php getTE('Exterior Color'); ?></label>
						</div>
						<div class="out-color">
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
					</div>
				</data><!-- Colorss Packet -->
				</div>

				<div class="control-box">
				<p class="details-packet-title"><?php getTE('Equipments');?> <span class="det-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> <span class="det-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span></p>	
				<data class="details-packet">

					<div class="row">
						<div class="col-sm-6">

							<label><?php getTE('Safety');?></label>

							<div>
								<input class="" type="checkbox" name="ESP"  value="YES" <?php if(isset($_GET['ESP'])){echo 'checked';}?> >
								<lable><?php getTE('ESP'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="ABS"  value="YES" <?php if(isset($_GET['ABS'])){echo 'checked';}?> >
								<lable><?php getTE('ABS'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Isofix"  value="YES" <?php if(isset($_GET['Isofix'])){echo 'checked';}?> >
								<lable><?php getTE('Isofix'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Alarm_System"  value="YES" <?php if(isset($_GET['Alarm_System'])){echo 'checked';}?> >
								<lable><?php getTE('Alarm_System'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Keyless_Entry"  value="YES" <?php if(isset($_GET['Keyless_Entry'])){echo 'checked';}?> >
								<lable><?php getTE('Keyless_Entry'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Airbag_Driver"  value="YES" <?php if(isset($_GET['Airbag_Driver'])){echo 'checked';}?> >
								<lable><?php getTE('Airbag Driver'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Airbag_Passenger"  value="YES" <?php if(isset($_GET['Airbag_Passenger'])){echo 'checked';}?> >
								<lable><?php getTE('Airbag_Passenger'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Airbag_Side"  value="YES" <?php if(isset($_GET['Airbag_Side'])){echo 'checked';}?> >
								<lable><?php getTE('Airbag_Side'); ?></lable>
							</div>

						</div>

						<div class="col-md-6">
							<label><?php getTE('Comfort'); ?></label>

							<div>
								<input class="" type="checkbox" name="AC_Front"  value="YES" <?php if(isset($_GET['AC_Front'])){echo 'checked';}?> >
								<lable><?php getTE('AC_Front'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="AC_Rear"  value="YES" <?php if(isset($_GET['AC_Rear'])){echo 'checked';}?> >
								<lable><?php getTE('AC_Rear'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Navigation"  value="YES" <?php if(isset($_GET['Navigation'])){echo 'checked';}?> >
								<lable><?php getTE('Navigation'); ?></lable>
							</div>

						</div>

						<div class="col-md-6">
							<label><?php getTE('Entertainment'); ?></label>

							<div>
								<input class="" type="checkbox" name="AM_FM_Stereo"  value="YES" <?php if(isset($_GET['AM_FM_Stereo'])){echo 'checked';}?> >
								<lable><?php getTE('AM FM Stereo'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Cassette_Player"  value="YES" <?php if(isset($_GET['Cassette_Player'])){echo 'checked';}?> >
								<lable><?php getTE('Cassette Player'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="CD"  value="YES" <?php if(isset($_GET['CD'])){echo 'checked';}?> >
								<lable><?php getTE('CD'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="MP3_Single_Disc"  value="YES" <?php if(isset($_GET['MP3_Single_Disc'])){echo 'checked';}?> >
								<lable><?php getTE('MP3 Disc'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="DVD_System"  value="YES" <?php if(isset($_GET['DVD_System'])){echo 'checked';}?> >
								<lable><?php getTE('DVD System'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Premium_Sound"  value="YES" <?php if(isset($_GET['Premium_Sound'])){echo 'checked';}?> >
								<lable><?php getTE('Premium Sound'); ?></lable>
							</div>

						</div>

						<div class="col-md-6">
							<label><?php getTE('Additions');?></label>

							<div>
								<input class="" type="checkbox" name="Power_Windows"  value="YES" <?php if(isset($_GET['Power_Windows'])){echo 'checked';}?> >
								<lable><?php getTE('Power Windows'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Integrated_Phone"  value="YES" <?php if(isset($_GET['Integrated_Phone'])){echo 'checked';}?> >
								<lable><?php getTE('Integrated Phone'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Power_Steering"  value="YES" <?php if(isset($_GET['Power_Steering'])){echo 'checked';}?> >
								<lable><?php getTE('Power Steering'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Rear_Window_Defroster"  value="YES" <?php if(isset($_GET['Rear_Window_Defroster'])){echo 'checked';}?> >
								<lable><?php getTE('Rear Window Defroster'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Rear_Window_Wiper"  value="YES" <?php if(isset($_GET['Rear_Window_Wiper'])){echo 'checked';}?> >
								<lable><?php getTE('Rear Window Wiper'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Tinted_Glass"  value="YES" <?php if(isset($_GET['Tinted_Glass'])){echo 'checked';}?> >
								<lable><?php getTE('Tinted Glass'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Moonroof_Sunroof"  value="YES" <?php if(isset($_GET['Moonroof_Sunroof'])){echo 'checked';}?> >
								<lable><?php getTE('Moonroof Sunroof'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Alloy_Wheels"  value="YES" <?php if(isset($_GET['Alloy_Wheels'])){echo 'checked';}?> >
								<lable><?php getTE('Alloy Wheels'); ?></lable>
							</div>

						</div>

						<div class="col-md-6">
							<label><?php getTE('Seats');?></label>

							<div>
								<input class="" type="checkbox" name="Memory_Seats"  value="YES" <?php if(isset($_GET['Memory_Seats'])){echo 'checked';}?> >
								<lable><?php getTE('Memory Seats'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Bucket_Seats"  value="YES" <?php if(isset($_GET['Bucket_Seats'])){echo 'checked';}?> >
								<lable><?php getTE('Bucket Seats'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Power_Steering"  value="YES" <?php if(isset($_GET['Power_Steering'])){echo 'checked';}?> >
								<lable><?php getTE('Power Seats'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Third_Row_Seats"  value="YES" <?php if(isset($_GET['Third_Row_Seats'])){echo 'checked';}?> >
								<lable><?php getTE('Third Row Seats'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Leather_Interior"  value="YES" <?php if(isset($_GET['Leather_Interior'])){echo 'checked';}?> >
								<lable><?php getTE('Leather Interior'); ?></lable>
							</div>

						</div>

						<div class="col-md-6">
							<label><?php getTE('Lights');?></label>

							<div>
								<input class="" type="checkbox" name="LED_Front_Lights"  value="YES" <?php if(isset($_GET['LED_Front_Lights'])){echo 'checked';}?> >
								<lable><?php getTE('LED Front Lights'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="LED_Back_Lights"  value="YES" <?php if(isset($_GET['LED_Back_Lights'])){echo 'checked';}?> >
								<lable><?php getTE('LED Back Lights'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Daylight_Auto"  value="YES" <?php if(isset($_GET['Daylight_Auto'])){echo 'checked';}?> >
								<lable><?php getTE('Daylight'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="xenon_Headlights"  value="YES" <?php if(isset($_GET['xenon_Headlights'])){echo 'checked';}?> >
								<lable><?php getTE('Xenon Headlights'); ?></lable>
							</div>

							<div>
								<input class="" type="checkbox" name="Fog_Lights"  value="YES" <?php if(isset($_GET['Fog_Lights'])){echo 'checked';}?> >
								<lable><?php getTE('Fog Lights'); ?></lable>
							</div>
							
						</div>

						
					</div>
					

					





				
				</data><!-- Colorss Packet -->
				</div>

				
				<div class="col-md-5 col-md-offset-3 ">
					<input type="submit" value="<?php getTE('Search');?>" class="btn btn-red ">
				</div>

				</div>
				</form>
			</div>
		</div>

	</div>	    	
</div>

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