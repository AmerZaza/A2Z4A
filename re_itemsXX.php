<?php 

session_start();

$pageTitle = 'Real Estate';
    
include 'init.php';


  $pageid = isset($_GET['pageid']) && is_numeric($_GET['pageid']) ? intval($_GET['pageid']) : 0;

?>

<h1 class="text-center"><?php getTE('Real Estate Page'); ?></h1>

<div class=" search-re ">
	<form action="<?php echo $_SERVER['PHP_SELF'].'?pageid='.$pageid;?>&do=result" method="GET">
			
				
				<select class="category"  name="category">
					<?php 
					if (!empty($_GET['category'])){
						$catID = $_GET['category'];
						$cats = getInnerCat("categories.Category_ID = $catID");
						foreach ($cats as $cat) {}
						echo '<option value="'.$cat['Category_ID'].'">'.$cat['Category_Name'].'</option>';
						$allcats = getInnerCat();
						foreach ($allcats as $allcat) {
						echo '<option value="'.$allcat['Category_ID'].'">'.$allcat['Category_Name'].'</option>';}

					}else{
						echo '<option value="">'.getT('Select Category').'</option>';
						$cats = getInnerCat();
						foreach ($cats as $cat) {
							echo '<option value="'.$cat['Category_ID'].'">'.$cat['Category_Name'].'</option>';
						}
					}
					?>
					
				</select>
			

				<input class="location" type="text" name="location" placeholder="<?php getTE('Select Location') ?>" value="<?php //echo  $_GET['location'];?>" >

				<select class="praxis"  name="praxis" >
					<?php 
					if (!empty($_GET['praxis'])){
						$praxID = $_GET['praxis'];
						$praxis = getInnerPraxis("praxis.Praxis_ID = $praxID");
						foreach ($praxis as $prax) {}
						echo '<option value="'.$prax['Praxis_ID'].'">'.$prax['Praxis_Name'].'</option>';
						$allpraxs = getInnerPraxis();
						foreach ($allpraxs as $allprax) {
						echo '<option value="'.$allprax['Praxis_ID'].'">'.$allprax['Praxis_Name'].'</option>';}

					}else{
						echo '<option value="">'.getT('Select Praxis').'</option>';
						$Praxs = getInnerPraxis();
						foreach ($Praxs as $Prax) {
							echo '<option value="'.$Prax['Praxis_ID'].'">'.$Prax['Praxis_Name'].'</option>';
						}
					}
					
					?>
				</select>
			

				<input class=" price" type="number" name="price-from" placeholder="<?php getTE('Price From'); ?>" value="<?php echo $_GET['price-from'];?>">
			

				<input class=" price" type="number" name="price-to" placeholder="<?php getTE('Price To'); ?>" value="<?php echo $_GET['price-to'];?>">

				<input class=" area" type="number" name="area-from" placeholder="<?php getTE('Area From'); ?>" value="<?php echo $_GET['area-from'];?>">

				<input class=" area" type="number" name="area-to" placeholder="<?php getTE('Area To'); ?>" value="<?php echo $_GET['area-to'];?>">

				<input class=" room" type="number" name="rooms" placeholder="<?php getTE('Room N'); ?>" value="<?php echo $_GET['rooms'];?>">

				<input class="btn btn-success" type="submit" value="<?php getTE('Search'); ?>" >
		</form>
</div>




<?php
// Get Cat Parent a list
echo '<div class= "parent">' ;
if(!empty($pageid)){
	getCatParent($pageid);//XXXXXXXXXX
}
echo '</div>';

	
if ($_SERVER['REQUEST_METHOD'] = 'Get') {


	if(isset($_GET['location'])){
		$_SESSION['location'] = tSec($_GET['location']);
	}else{
		$_SESSION['location'] = NULL;
		//unset($_GET['location']);
	}
	$location = $_SESSION['location'];

	
	if(isset($_GET['price-from'])){
		$_SESSION['price-from'] = nSec($_GET['price-from']);
	}else{
		$_SESSION['price-from'] = NULL;
		//unset($_GET['price-from']);
	}
	$priceFrom = $_SESSION['price-from'];
	
	
	if(isset($_GET['price-to'])){
		$_SESSION['price-to'] = nSec($_GET['price-to']);
	}else{
		$_SESSION['price-to'] = NULL;
		//unset($_GET['price-to']);
	}
	$priceTo = $_SESSION['price-to'];

	
	if(isset($_GET['rooms'])){
		$_SESSION['rooms'] = nSec($_GET['rooms']);
	}else{
		$_SESSION['rooms'] = NULL;
		//unset($_GET['rooms']);
	}
	$roomN = $_SESSION['rooms'];

	
	if(isset($_GET['area-from'])){
		$_SESSION['area-from'] = nSec($_GET['area-from']);
	}else{
		$_SESSION['area-from'] = NULL;
		//unset($_GET['area-from']);
	}
	$areaF = $_SESSION['area-from'];

	
	if(isset($_GET['area-to'])){
		$_SESSION['area-to'] = nSec($_GET['area-to']);
	}else{
		$_SESSION['area-to'] = NULL;
		//unset($_GET['area-to']);
	}
	$areaT = $_SESSION['area-to'];

	
	if(isset($_GET['category'])){
		$_SESSION['category'] = $_GET['category'];
	}else{
		$_SESSION['category'] = NULL;
		//unset($_GET['category']);
	}
	$CatID = $_SESSION['category'];
	

	if(isset($_GET['praxis'])){
		$_SESSION['praxis'] = $_GET['praxis'];
	}else{
		$_SESSION['praxis'] = NULL;
		//unset($_GET['praxis']);
	}
	$PraxisID = $_SESSION['praxis'];
	


	if (isset($_SESSION['user'])){
		$userN = $_SESSION['user'];
		$UserS = superGet('User_ID','users',"User_Name = '$userN'");
		foreach ($UserS as $User) {}
			$userID = $User['User_ID'];
	}else{$userID = NULL ;}

	if (!empty($_SERVER['HTTP_CLIENT_IP'])){
		$userIP = $_SERVER['HTTP_CLIENT_IP'] ;
	}else{$userIP = NULL ;} // XXXX


	// AreaTo Condition
	if ( !empty($areaT)){ $areaTCon = "AND (RE_Area <= '$areaT')"; }else{$areaTCon = NULL;}
	// AreaFrom Condition
	if ( !empty($areaF)){ $areaFCon = "AND (RE_Area >= '$areaF')"; }else{$areaFCon = NULL;}
	// PriceTo Condition
	if ( !empty($priceTo)){ $priceTCon = "AND (Main_Price >= '$priceTo')"; }else{$priceTCon = NULL;}
	// PriceFrom Condition
	if ( !empty($priceFrom)){ $priceFCon = "AND (Main_Price >= '$priceFrom')"; }else{$priceFCon = NULL;}
	// Room Condition
	if ( !empty($roomN)){ $roomsCon = "AND (RE_Room = $roomN)"; }else{$roomsCon = NULL;}

	// Category Condition
	if ( !empty($CatID)){ $catCon = "AND (items.Category_ID = $CatID)"; }else{$catCon = NULL;}
	// Praxis Condition
	if ( !empty($PraxisID)){ $praxCon = "AND (items.Praxis_ID = $PraxisID)"; }else{$praxCon = NULL;}

	// Get the Order 
	if (isset($_GET['sorting'])){
		if ($_GET['sorting'] == 'priceh'){
			$order = "items.Main_Price ASC";

		}elseif ($_GET['sorting'] == 'pricel') {
			$order = "items.Main_Price DESC";

		}elseif ($_GET['sorting'] == 'areah') {
			$order = "re_items.RE_Area ASC";

		}elseif ($_GET['sorting'] == 'areal') {
			$order = "re_items.RE_Area DESC";

		}elseif ($_GET['sorting'] == 'timeh') {
			$order = "items.Inser_Time ASC";

		}elseif ($_GET['sorting'] == 'timel') {
			$order = "items.Inser_Time DESC";
		}
		
	}else{$order = NULL ;}

    

echo '<div class="container top-controls">';
  echo '<div class="row">';
	echo '<div class="col col-md-9">';
      if (isset($_GET)){
      	$selects = $_GET;
      	unset($selects['pageid']);
      	foreach ($selects as $key => $select) {
      		if(!empty($select)){
      		echo '<div class="select-tag">';
      		echo str_replace("-"," ",$key) .' = '.'<span>'. $select.'</span>';
      		$nLink = getLink($_GET,$key) ;
      		echo '<a href="'.$_SERVER['PHP_SELF'].'?'.$nLink.'">X</a>';
      		echo '</div>';
      		}
      	}
      }
    echo '</div>';
    echo '<div class="col col-md-3">';
    $orderLink = getLink($_GET,'sorting');
    ?>
    <div class="sorting-list">
		<ul class ="">
			<li><?php getTE('Sorting'); ?>:</li>
			<li>
				<a href="<?php echo $_SERVER['PHP_SELF'].'?sorting=priceh&'.$orderLink; ?>"><?php getTE('Price');?> +</a>
			</li>
			<li>
				<a href="<?php echo $_SERVER['PHP_SELF'].'?sorting=pricel&'.$orderLink; ?>"><?php getTE('Price');?> -</a>
			</li>
			<li>
				<a href="<?php echo $_SERVER['PHP_SELF'].'?sorting=areah&'.$orderLink;?>"><?php getTE('Area');?> +</a>
			</li>
			<li>
				<a href="<?php echo $_SERVER['PHP_SELF'].'?sorting=areal&'.$orderLink;?>"><?php getTE('Area');?> -</a>
			</li>
			<li>
				<a href="<?php echo $_SERVER['PHP_SELF'].'?sorting=timeh&'.$orderLink;?>"><?php getTE('Newer');?> </a>
			</li>
			<li>
				<a href="<?php echo $_SERVER['PHP_SELF'].'?sorting=timel&'.$orderLink;?>"><?php getTE('Older');?> </a>
			</li>
		</ul>
	</div> 
	<?php
    echo '</div>';
  echo '</div>';
echo '</div>';
      

 // SAVE RE_SEARCH REQuest:
    //Check if there are selected paramiters 
if (!empty($location) || !empty($areaF) || !empty($areaT) ||!empty($priceTo)|| !empty($priceFrom) || !empty($roomN)){

   $stmt = $con->prepare("INSERT INTO re_search_requests(User_ID, User_IP, String, Category_ID, Praxis_ID, Price_From, Price_To, Area_From, Area_To, Room_N) VALUES(:zuserid, :zuserip, :zstring, :zcaid, :zpraxid, :zpricef, :zpricet, :zareaf, :zareat, :zroom)");

                    $stmt->execute(array(
                        'zuserid'    => $userID ,
                        'zuserip'   => $userIP,
                        'zstring'   => $location,
                        'zcaid'  	=> $CatID,
                        'zpraxid'   => $PraxisID,
                        'zpricef' 	=> $priceFrom,
                        'zpricet'  	=> $priceTo,
                        'zareaf'  	=> $areaF,
                        'zareat'  	=> $areaT,
                        'zroom'   	=> $roomN
                       
                         ));
    } // end if there paramiters to insert the record

$items = getInnerItemRE("((Country = '$location') OR (Region = '$location') OR ( City LIKE '%$location%') OR (Zip = '$location') OR (Street LIKE '%$location%') OR (Item_Name LIKE '%$location%'))
	$roomsCon $priceFCon $priceTCon $areaFCon $areaTCon $catCon $praxCon " , $order
	);

	
	if (!empty($items)){


		?>
	
	
	<div class="container">
	<div class="row">
		<?php
	foreach ($items as $item){  
            $itemid = $item['Item_ID'];
            echo '<a href="re_item.php?itemid='.$item['Item_ID'].'">';//Start a
         $images = superGet('*','items_images',"Item_ID= $itemid AND Ist_Main = 1") ;

           // Set $img = Default if ther is no image
               if (!empty ($images)){
                foreach ($images as $imge){
                        $img = $imge['Item_Image'];
                    }
                }else {
                    $img = 'item.jpg';
                }


            echo '<div class="col-md-3 ">';
                echo '<div class="thumbnail item-box">'; 
                    
                    echo '<img  src="images/items/'.$img.'" alt="" class="img-responsive"/>';
                    echo '<div class="caption">';
                        echo '<p class="title">'.$item['Item_Name'].'</p>';
                        echo '<p>'.$item['Item_Description'].'</p>';
                        echo '<p class="date">'.$item['Inser_Time'].'</p>';
                        echo '<span class="price">'.$item['Main_Price'].'</span>';
                        
                    echo '</div>' ;
                echo '</div>';
                
            echo '</div>';
         echo '</a>';// end main a
            
        }
        echo '</div>'; // end row
    echo '</div>';  // end Container

      }
          
   }else{// End If request = Get

   	/// View the item greed

   	?>

   	<div class="container">
    


	    <div class="container">
	        <?php 
	         $order = $_GET['order'];// LOOOK about	 !!!!!!       

	       itemsGrid("items.Category_ID = $pageid" , $order) ;

	        ?>
	    </div>
    
	</div>
<?php


   } // End else  request = POST


include  $tpl . "footer.php";?>