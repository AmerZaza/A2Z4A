<?php
include 'configuration.php';
include 'admin/connect.php';
include 'includes/functions/functions.php';

$do = isset($_GET['do']) ? $_GET['do'] : 'NULL';


if ($do == 'add-favourite') {

	if(!empty($_POST['itemid'])){

		$itemid = $_POST['itemid'];
		$itemid = trim($itemid,' '); // thir is extra space!!

		setcookie('favorite'.$itemid, 'favorite', time() + (86400 * 30), "/");//(86400 * 30)

      // Add Icon & Count after click to Add new
		$allArray = array_keys($_COOKIE,'favorite') ;
			if(!empty($allArray)){
			// check if the item ID is not in Coockie 
				$check = array_search($itemid,$allArray);
				if ($check == 0){$x = 1;}else{$x = NULL;}

				$count = count($allArray) + $x;
				echo '<a href="favorites.php"><span><i class="far fa-heart fa-lg"></i><span class="icon-sum"  id="favorit-sum">'.$count.'</span></span></a>';

			}else{
				echo '<span class="icon-sum" ><i class="far fa-heart fa-lg"></i></span>';
			}
	}	
}elseif ($do == 'remove-favourite') {

	if(!empty($_POST['itemid'])){

		$itemid = $_POST['itemid'];
		setcookie( 'favorite'.$itemid, '', time() - (3600 * 24), "/");//(86400 * 30)

      // Add Icon & Count after click to Add new
		$allArray = array_keys($_COOKIE,'favorite') ;
			if(!empty($allArray)){
			// check if the item ID is not in Coockie 
				$check = array_search($itemid,$allArray);
				if ($check !== 0){$x = NULL;}else{$x = 1;}

				$count = count($allArray) - $x;
				echo '<a href="favorites.php"><span><i class="far fa-heart fa-lg"></i><span class="icon-sum"  id="favorit-sum">'.$count.'</span></span></a>';

			}else{
				echo '<span class="icon-sum" ><i class="far fa-heart fa-lg"></i></span>';
			}  
	}	

}elseif ($do == 'add-compare') {

	$compareArray = array_keys($_COOKIE,'compare');
	if( count($compareArray) <=5) { //!empty($compareArray) &&

	if(!empty($_POST['itemid'])){

		$itemid = $_POST['itemid'];
		setcookie( 'compare'.$itemid, 'compare', time() + (86400 * 30), "/");//(86400 * 30)

      // Add Icon & Count after click to Add new
		$allArray = array_keys($_COOKIE,'compare') ;
			if(!empty($allArray)){
			// check if the item ID is not in Coockie 
				$check = array_search($itemid,$allArray);
				if ($check == 0){$x = 1;}else{$x = NULL;}

				$count = count($allArray) + $x;
				echo '<a href="compare.php"><span><i class="fas fa-balance-scale fa-lg"></i><span class="icon-sum"  id="compare-sum">'.$count.'</span></span></a>';

			}else{
				echo '<span class="icon-sum" ><i class="fas fa-balance-scale fa-lg"></i></span>';
			}
		}	
	}
}elseif ($do == 'remove-compare') {

	if(!empty($_POST['itemid'])){

		$itemid = $_POST['itemid'];
		setcookie( 'compare'.$itemid, '', time() - (3600 * 24), "/");//(86400 * 30)

      // Add Icon & Count after click to Add new
		$allArray = array_keys($_COOKIE,'compare') ;
			if(!empty($allArray)){
			// check if the item ID is not in Coockie 
				$check = array_search($itemid,$allArray);
				if ($check == 0){$x = 1;}else{$x = NULL;}

				$count = count($allArray) - $x ;
				echo '<a href="compare.php"><span><i class="fas fa-balance-scale fa-lg"></i><span class="icon-sum" id="compare-sum">'.$count.'</span></span></a>';

			}else{
				echo '<span class="icon-sum" ><i class="fas fa-balance-scale fa-lg"></i></span>';
			}  
	}
} elseif ($do == 'main-SP'){
	echo '<option value = "">'.getT('Select').'</option>'; 
	if (!empty($_POST['groupid'])) {
	$groupID = $_POST['groupid'];
	$mainItems = getInnerSpareSP("sp_m_items_groups.SP_group_ID = $groupID");
		foreach ($mainItems as $mainItem) {
			echo '<option value = "'.$mainItem['SP_Main_Item_ID'].'">'.$mainItem['SP_Main_Item_Name'].'</option>';
		}
	
    }
} elseif ($do == 'accept_cookies'){

	setcookie('accept_cookies', 'yes', time() + (86400 * 30 * 6), "/");
	// Get the url to same page
	if(!empty($_GET['page'])){
		$page = $_GET['page'];
	}else{$page = 'index.php';}
	
	header('Location:'.$page);

} elseif ($do == 'loc-matrix'){ 

	if(!empty($_POST['destinations'])){

		echo '<h2>Hi</h2>'.$_POST['destinations'];
		
	}

}


?>