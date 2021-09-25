<?php 
ob_start();
session_start();


$pageTitle = 'Favorites Items | A to Z for All';
    
include 'init.php';

?>

<div class="container">

	<h1 class="text-center"><?php getTE('Favorites');?></h1>
	    
	    <div class="container">
	    	
		<?php 


		if(!empty($_COOKIE)){

		echo '<div class="row">';
	
			$allArray = array_keys($_COOKIE,'favorite') ;

			foreach ($allArray as $key => $value) {
				$value = trim($value,'favorite'); // to remove adder prifix

		$items =getInnerItem("items.Item_ID = $value");

		echo '<div class="each-item">';

			foreach ($items as $item) {
				$itemid = $item['Item_ID'];
				echo '<a href="'.$item['Item_Page_Code'].'?itemid='.$item['Item_ID'].'">';//Start a
				 //itemsGridX("items.Item_ID = $item");
            
			

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
                    
                    echo '<img  src="images/items/'.$img.'" alt=""/>';
                    echo '<div class="caption">';
                        echo '<p class="title">'.$item['Item_Name'].'</p>';
                        echo '<p>'.mb_substr($item['Item_Description'],0,30).'</p>';
                        echo '<p class="date">'.$item['Inser_Time'].'</p>';
                        echo '<span class="price">'.number_format($item['Main_Price']).' '.$item['Currency_Code'].'</span>';


                echo '<input type="image" class="remove-favorite" src="images/form/favorit-icon.png" onClick="removeFavorite(value)"  width="24px" value="'.$itemid.'">';
                        
                    echo '</div>' ;
                echo '</div>'; 
              echo '</div>';
            
         echo '</a>';// end main a
				
		}
		echo '</div>';
			
	}
				
			echo '</div>';
			

}

			    
			    ?>
	</div>
</div>

<?php


include  $tpl . "footer.php";?>