<?php 

session_start();

$pageTitle = 'Results | A to Z for All';
    
include 'init.php';
?>

<div class="container">
    <h1 class="text-center"><?php getTE('Search Results')?></h1>


    <?php 
    if (!empty($_POST['search'])){
    $search = $_POST['search'];
    echo '<div class="you-search-for">';
    	echo getT('You are looking for').': '.$search. '<br>';
    echo '</div>';

    
    echo '<div class="container">';
    itemsGrid("Item_Name LIKE '%$search%' And Item_Display = 1 OR Item_Description LIKE '%$search%' And Item_Display = 1 OR Item_Tags LIKE '%$search%' And Item_Display = 1"); // Preview Items Grid depending on search 
    echo '</div>';
    }
    ?>
</div>

<?php


include  $tpl . "footer.php";?>