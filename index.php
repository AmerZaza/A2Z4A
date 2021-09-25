<?php 
ob_start();
session_start();

$pageTitle = 'A to Z 4 All | E-commerce Portal';
    
include 'init.php';

?>
<!-- ***  Start Fast Links Section *** -->
<div class="container">
		<div class="fast-link">
			<?php 
            if(isset($_SESSION['uid'])){
                $proID = $_SESSION['uid'];
                $pros = superGet('User_ID','providers',"User_ID = $proID");
                
                if(!empty($pros)){
                    $hrefAM = 'manage_am_items.php?do=new&catid=80';
                    $hrefWS = 'manage_ws_items.php?do=new&catid=86';
                    
                }else{
                    $hrefAM = 'manage_providers.php?do=select';
				    $hrefWS = 'manage_providers.php?do=select';
                    
                }
				
			}else{
				$hrefAM = 'login.php';
				$hrefWS = 'login.php';
			}
			
			?>

				<a href="am_items.php?pageid=80" class="btn btn-red "><?php getTE('Buying Car')?></a>


				<a href="<?php echo $hrefAM; ?>" class="btn btn-red "><?php getTE('Selling Car')?></a>
                
                <a href="index.php#auto-brand" class="btn btn-red "><?php getTE('Top Auto Brands')?></a>
<!--

				<a href="ws_items.php?pageid=86" class="btn btn-red "><?php getTE('Car services')?></a>

				<a href="<?php echo $hrefWS; ?>" class="btn btn-red "><?php getTE('Supply of auto services')?></a>

				
-->	
		</div>
</div>
<!-- ***  End Fast Links Section *** -->

<div class="container">
	<div class="row">
<!-- ***  Start AM Search Links Section *** -->

		<div class="col-md-6">
			<div class="control-box">

			<div class="container ">
             <p class="control-title"><?php getTE('automobile') ;?><span class=""><i class="fa fa-car" aria-hidden="true"></i></span></span></p>
        	</div>

				<form action="am_items.php" method="GET">
					<input type="hidden" name="pageid" value="80">


				<div class="col-md-12 ">

					<div class=" col-xs-6">
                        <div class="row status-form">
                        	<div class="col-md-3 ">
                                <input class="" type="checkbox" name="new"  value="yes" checked>
                            </div>
                            <p class="col-md-9" ><?php getTE("New");?></p>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="row status-form">
                        	<div class="col-md-3 ">
                                <input class="" type="checkbox" name="used"  value="yes" checked>
                            </div>
                            <p class="col-md-9" ><?php getTE("Used");?></p>
                        </div>
                    </div>


				</div>

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
								echo '<option value="0">'.getT("Not Set").'</option>';
							}
								$amMakers = superGet('*','makes');
								foreach ($amMakers as $amMaker) {
									echo '<option value="'.$amMaker['id'].'">'.$amMaker['Make_Name'].'</option>';
								}
							?>
						</select>
					</div>

					<div class="col-md-6">
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

				<div class="col col-md-6 ">
						<label class="col col-md-12"><?php getTE('Production Date'); ?></label>
						<div class="col-md-6 col-0padding">
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
						<div class="col-md-6 col-0padding">
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

					<div class="col col-md-6">
						<label class="col col-md-12"><?php getTE('Price'); ?></label>
						<div class=" col col-md-6 col-0padding">
							<input class="form-control" type="number" min="0" name="price-f" placeholder="<?php getTE('From');?>">
						</div>
						<div class="col col-md-6 col-0padding">
							<input class="form-control" type="number" min="0" name="price-t" placeholder="<?php getTE('To');?>">
						</div>
					</div>

					<div class="col col-md-6">
						<label><?php getTE('Milage'); ?></label>
						<input class="form-control" type="number" name="milage" value="<?php echo $_GET['milage'] ;?>">
					</div>

					<div class="col col-md-6">
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

					<div class="col col-md-6">
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

					<div class="col col-md-6">
						<label><?php getTE('Passengers'); ?></label>
						<input class="form-control" type="number" min="0" name="passengers" value="<?php echo $_GET['passengers'] ;?>">
					</div>


				<div class="col-md-offset-4 col-md-4">
					<input class="btn btn-red"   type="submit" value="<?php getTE('Search');?>">
				</div>

					<div class=" col-md-4 ">
						<a class="" href="am_select.php"><?php getTE('More Details'); ?> >></a>
					</div>
			</form>
			
			</div>
		</div>
<!-- ***  End AM Search Links Section *** -->

<!--  *** Start  Body Type Section *** -->
		<div class="col col-md-6 col-xs-12 col-md-offset-0 body-t-section">
			<?php
			$amBodys = getInnerBodyAm("Body_Type_image != 'NULL' ");
			foreach ($amBodys as $amBody) {
				$bodyTypeID = $amBody['AM_Body_Type_ID'];
				//Count items for each type
				$count = countRec('AM_Item_ID','am_items'," AM_Body_ID = $bodyTypeID");
			 	?>
			 	<div class="am-body-type">
			 		<a href="am_items.php?pageid=80&body=<?php echo $bodyTypeID ;?>">
				 		<span class="body-t-name"><?php echo $amBody['AM_Body_Type_Name'];?></span>
				 		<span class="body-t-count">
				 		<?php echo $count;?>
				 		</span>
				 		<img src="images/autoBody/<?php echo $amBody['Body_Type_image']; ?>">
			 		</a>
			 		
			 	</div>
			 	<?php
			 } 
			?>
		</div>
<!--  *** End  Body Type Section *** -->
		
	</div>
</div>

<div class="container">
	<div class="row">
<!-- *** Start AM iteme Previwe Section *** -->
	<h1 class="text-center container "><?php getTE('Automobile');?></h1>

		<div class="col col-md-12">
			<div class="all-item-list">
		    <p class="scrool-btn left" onclick="scrollL()"><i class="far fa-caret-square-left fa-2x"></i></p>
		    <div class="container items-horizon " id="photo-list">
			    <?php 
			    itemsGrid("Item_Display = 1 AND categories.Category_ID = 80",'items.Item_ID',"DESC",10);
			    ?>
			</div>
			<p class="scrool-btn right" onclick="scrollR()"><i class="far fa-caret-square-right fa-2x"></i></p>
		</div>
	</div>
<!-- *** End AM iteme Previwe Section *** -->
	</div>
</div>

<div class="container">
	<div class="row">
<!-- ***  Start WS Search Section *** -->
<!--
		<div class="col col-md-6 ">
			<div class="control-box">

			<div class="container ">
             <p class="control-title"><?php getTE('Service') ;?><span class=""><i class="fas fa-cogs"></i></span></span></p>
        	</div>

				<form action="ws_items.php" method="GET">
					<input type="hidden" name="pageid" value="86">

				<div class="col col-md-6">
					<label><?php getTE('Service'); ?></label>
					<select class="form-control "  name="service"  >
                      <option value=""> <?php getTE("Select Service");?></option>

                      <?php 
                      $services = getInnerServiceWS();
                      foreach ($services as $service) {
                        echo '<option value = "'.$service['WS_Service_ID'].'">'.$service['WS_Service_Name'].'</option>';
                      }
                      ?>
                  </select>
				</div>

				<div class="col col-md-6">
					<label><?php getTE('Maker'); ?></label>
						<select name="maker" class="form-control" id="maker-listXX" onChange="getModelXX(value) ">
							<?php 
							if(isset($maker)){ 

								$SamMakers = superGet('*','makes',"makes.id = $maker");
								foreach ($SamMakers as $SamMaker) {
									echo '<option value="'.$SamMaker['id'].'">'.$SamMaker['Make_Name'].'</option>';
								}
							}else{
								echo '<option value="0">'.getT("Not Set").'</option>';
							}
								$amMakers = superGet('*','makes');
								foreach ($amMakers as $amMaker) {
									echo '<option value="'.$amMaker['id'].'">'.$amMaker['Make_Name'].'<option>';
								}
							?>
						</select>
					</div>

					<div class="col-md-6">
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

					<div class="container">
						<label class="col col-md-12"><?php getTE('Cost'); ?></label>
						<div class=" col col-md-6 ">
							<input class="form-control" type="number" min="0" name="price-f" placeholder="<?php getTE('From');?>">
						</div>
						<div class="col col-md-6">
							<input class="form-control" type="number" min="0" name="price-t" placeholder="<?php getTE('To');?>">
						</div>
					</div>

				<div class="col-md-offset-4 col-md-4">
					<input class="btn btn-red"   type="submit" value="<?php getTE('Search');?>">
				</div>
					<div class=" col-md-4 ">
						<a class="" href="am_select.php"><?php getTE('More Details'); ?> >></a>
					</div>
			</form>
			</div>
		</div>
-->
<!-- ***  End WS Search Section *** -->
	</div>
</div>


<div class="container">
	<div class="row">

<!-- *** Start WS iteme Previwe Section *** -->
<!--
	<div class="col col-md-12">
			<h1 class="text-center container "><?php getTE('Workshop Services');?></h1>
		
			<div class="all-item-list">

		    <p class="scrool-btn left" onclick="scrollWL()"><i class="far fa-caret-square-left fa-2x"></i></p>

		    <div class="container items-horizon " id="ws-list">
			    <?php 
			    itemsGrid("Item_Display = 1 AND categories.Category_ID = 86",'items.Item_ID',"DESC",10);
			    ?>
			</div>
			<p class="scrool-btn right" onclick="scrollWR()"><i class="far fa-caret-square-right fa-2x"></i></p>
		</div>
	</div>
-->
<!-- *** End WS iteme Previwe Section *** -->
	
	</div>	
</div>	

<div class="container">
	<div class="row">
<!-- ***  Start RE Search  Section *** -->
<!--
		<div class="col-md-6">
			<div class="control-box">
				<div class="container ">
             <p class="control-title"><?php getTE('Real Estate') ;?><span class=""><i class="fas fa-home"></i></span></span></p>
        	</div>
        	<form action="re_items.php" method="GET">
				<input type="hidden" name="pageid" value="70">

				<div class="col-md-6">
					<label><?php getTE('Praxis'); ?></label>
					<select class="form-control " name="Praxis">
						<option value=""> <?php getTE("Select");?></option>

	                          <?php 
	                          $praxis = getInnerPraxis();
	                          foreach ($praxis as $prax) {
	                            echo '<option value = "'.$prax['Praxis_ID'].'">'.$prax['Praxis_Name'].'</option>';
	                          }
	                          ?>
					</select>
				</div>

				<div class="col-md-6">
					<label class=" col-md-12 control-lable"><?php getTE("Type");?></label>
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

				<div class="col-md-6">
					<label><?php getTE('Main Cost');?></label>
					<div class="row">
						<div class="col-md-6 col-0padding">
							<input class="form-control" type="number" name="mprice-f" placeholder="<?php getTE('From');?>">
						</div>
						<div class="col-md-6 col-0padding">
							<input class="form-control" type="number" name="mprice-t" placeholder="<?php getTE('To');?>">
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<label><?php getTE('Total Cost');?></label>
					<div class="row">
						<div class="col-md-6 col-0padding">
							<input class="form-control" type="number" name="tprice-f" placeholder="<?php getTE('From');?>">
						</div>
						<div class="col-md-6 col-0padding">
							<input class="form-control" type="number" name="tprice-t" placeholder="<?php getTE('To');?>">
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<label><?php getTE('Area');?></label>
					<div class="row">
						<div class="col-md-6 col-0padding">
							<input class="form-control" type="number" name="area-f" placeholder="<?php getTE('From');?>">
						</div>
						<div class="col-md-6 col-0padding">
							<input class="form-control" type="number" name="area-t" placeholder="<?php getTE('To');?>">
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<label><?php getTE('Rooms');?></label>
					<div class="row">
						<div class="col-md-6 col-0padding">
							<input class="form-control" type="number" name="room-f" placeholder="<?php getTE('From');?>">
						</div>
						<div class="col-md-6 col-0padding">
							<input class="form-control" type="number" name="room-t" placeholder="<?php getTE('To');?>">
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<label><?php getTE('Location');?></label>
					<div class="" id="locationField">
                    <input id="autocomplete" placeholder="<?php getTE("Enter your address");?>"
                    onFocus="geolocate()" type="text" class="form-control">
               	 </div>
				</div>

				<input class="form-control" type="hidden"  name="country"   id="country">
				<input class="form-control" type="hidden"  name="region" id="administrative_area_level_1">
				<input class="form-control" type="hidden"  name="city"   id="locality">
				<input class="form-control" type="hidden"  name="zip"   id="postal_code">
				<input class="form-control" type="hidden" id="route" name="street">
                <input class="form-control" type="hidden" id="street_number" name="haus">

                <div class="col-md-12">
                	<label><?php getTE('Distance');?></label>
                	<div class="row">
                		<div class="col-md-6">
                			<input class="form-control col-xs-12 " type="range" min="0" max="100" value=""  name="" id="dis-range">
                		</div>
                		<div class="col-md-3 col-xs-6">
                			<input class="form-control " name="distance" type="number" id="dis-text" max="100" min="0" readonly>
                		</div>
                		<div class="col-md-3 col-xs-6">
						<select class="form-control" name="unit">
							<option value="K">KM</option>
							<option value="M">Mail</option>
						</select>
					</div>
                		
                	</div>
                	
                </div>

                <div class="col-md-offset-4 col-md-4">
					<input class="btn btn-red"   type="submit" value="<?php getTE('Search');?>">
				</div>
		
			</form>

			</div>
		</div>
-->
<!-- ***  End RE Search  Section *** -->

<!--  *** Start  RE Type Section *** -->
<!--
		<div class="col col-md-6 col-xs-12 col-md-offset-0 body-t-section">
			<?php
			$reTypes = getInnerTypesRE("Type_Image != 'NULL' ");
			foreach ($reTypes as $reType) {
				$reTypeID = $reType['RE_Type_ID'];
				//Count items for each type
				$count = countRec('RE_Item_ID','re_items'," RE_Type_ID = $reTypeID");
			 	?>
			 	<div class="am-body-type re-type">
			 		<a href="re_items.php?pageid=70&type=<?php echo $reTypeID ;?>">
				 		<span class="body-t-name"><?php echo $reType['Type_Name'];?></span>
				 		<span class="body-t-count">
				 		<?php echo $count;?>
				 		</span>
				 		<img src="images/reType/<?php echo $reType['Type_Image']; ?>">
			 		</a>
			 		
			 	</div>
			 	<?php
			 } 
			?>
		</div>
-->
<!--  *** End  RE Type Section *** -->

	</div>
</div>


<div class="container">
	<div class="row">
<!-- *** Start RE iteme Previwe Section *** -->
<!--
	<h1 class="text-center container "><?php getTE('Real Estate');?></h1>

		<div class="col col-md-12">
			<div class="all-item-list">
		    <p class="scrool-btn left" onclick="scrollReL()"><i class="far fa-caret-square-left fa-2x"></i></p>
		    <div class="container items-horizon " id="re-list">
			    <?php 
			    itemsGrid("Item_Display = 1 AND categories.Category_ID = 70",'items.Item_ID',"DESC",10);
			    ?>
			</div>
			<p class="scrool-btn right" onclick="scrollReR()"><i class="far fa-caret-square-right fa-2x"></i></p>
		</div>
	</div>
-->
<!-- *** End RE iteme Previwe Section *** -->
	</div>
</div>


<div class="container">
	<div class="row">
<!-- Start Providers Section-->
	<h1 class="text-center"><?php getTE('Some Providers');?></h1>
		<div class="col col-md-12">
			<div class="all-item-list">

		    <p class="scrool-btn left" onclick="scrollPL()"><i class="far fa-caret-square-left fa-2x"></i></p>

		    <div class="container items-horizon " id="pro-list">
		    	<div class="tree-stum ">
			    <?php 
			   
			   // $pros = getInnerProvider("Provider_Type = 2" , 10);
			     $pros = getInnerProvider("Provider_Type != 3" , 10);
			   // print_r($pros);
			    foreach ($pros as $pro) {
			    ?>
			    <div class="text-center tree-ast ">
			    	<div class="item-box">
				    <p><?php getTE("Provider");?> : <a href="pro_profile.php?proid=<?php echo $pro['Provider_ID'];?>"><?php echo $pro['Provider_Name'];?></a></p>
	               		 <p><?php  getTE("Contact Person");?>: <?php echo $pro['Contact_Person'];?> </p>
		            
		                <div class="">
		                <img class="pro-list-img" src="images\profiles\<?php  echo $pro["User_Image"] ; ?>" alt="" />
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
	               </div>
	           </div>
				 <?php    }   ?>     
			</div>
			</div>

			<p class="scrool-btn right" onclick="scrollPR()"><i class="far fa-caret-square-right fa-2x"></i></p>
			</div>
		</div>
<!-- End Providers Section-->
	</div>
</div>

<div class="container">
	<div class="row">
<!--Start Countries Section -->
<!--
<h1 class="text-center col-sm-12"><?php getTE('Results by Countries');?></h1>
	<div class="control-box col-md-12">
		<?php
		$locs = getInnerItemAM();
		if (!empty($locs)){
		foreach ($locs as $loc) {
			if(isset($loc['Country'])){
				$countries[] = $loc['Country'];
				}
			}
			$countries =array_unique($countries) ;
			foreach ($countries as $country) {
			echo '<div class="location-count ">';
				echo $country ; 
				// count all rec where same city
				$all = getInnerItemAM("Country = '$country'");
				$count = count($all);
				echo '<span><a href="am_items.php?pageid=80&Country='.$country.'">'.$count.'</a></span>';

				echo " , ";
			echo '</div>';
			}
		}
		?>

	</div>
-->
<!--End Countries Section -->
<!--Start Cities Section -->
<!--
 <h1 class="text-center col-sm-12"><?php getTE('Results by Cities');?></h1>
	<div class="control-box col-md-12" id="ad-location">
		<?php
		$locs = getInnerItemAM();
		if(!empty($locs)){
		foreach ($locs as $loc) {
			if(isset($loc['City'])){
				$cities[] = $loc['City'];
				}
			}
			$cities =array_unique($cities) ;
			foreach ($cities as $city) {
			echo '<div class="location-count">';
				echo $city ; 
				// count all rec where same city
				$all = getInnerItemAM("City = '$city'");
				$count = count($all);
				echo '<span><a href="am_items.php?pageid=80&City='.$city.'">'.$count.'</a></span>';

				echo ",";
			echo '</div>';
			}
		}
		?>

	</div>
-->
<!--End Cities Section -->
		
	</div>
</div>


<div class="container">
	<div class="row">
<!-- Start Brands Section -->
		<div class="col col-md-12 " id="auto-brand">
		<h1 class="text-center"><?php getTE('Top Auto Brands');?></h1>
		<?php 
		$brands  = superGet('*','makes',"Brand_Image != 'null'",'id','ASC',16);
		foreach ($brands as $brand) {
			$makID = $brand['id'];

				// Photo & link
			echo '<a href = "am_items.php?pageid=80&maker='.$makID.'">';
				echo '<div class="brand-img">';
				echo '<img src="images/carBrand/'.$brand['Brand_Image'].'">';
				echo '</div>';
			echo '</a>';
			}

	
	/////////////////////////////////////
		/*
		$brands = getInnerItemAM("Brand_Image != 'null'");
		foreach ($brands as $brand) {
			//get AmItem Link
			$makID = $brand['Maker_ID'];

			// Photo & link
			echo '<a href = "am_items.php?pageid=80&maker='.$makID.'">';
				echo '<div class="brand-img">';
				echo '<img src="images/carBrand/'.$brand['Brand_Image'].'">';
				echo '</div>';
			echo '</a>';
		} */

		?>
		</div>
<!-- End Brands Section -->	
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