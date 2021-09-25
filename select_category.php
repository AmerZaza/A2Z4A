<?php 

session_start();

$pageTitle = 'Select the Category | A to Z for All';
  
include 'init.php';
$cats = getInnerCat("categories.Allow_Items = 1 AND categories.Category_Display = 1");

echo '<div class="container">';
foreach ($cats as $cat) {
    ?>

    <div class="cat-select-table">
        <a href="manage_<?php echo $cat['Include_Code'];?>?do=new&catid=<?php echo $cat['Category_ID'];?>">
        <?php echo '<p>'.$cat['Category_Name'].'</p>'; ?>
        
        <img src="admin/images/categories/<?php echo $cat['Category_Image']; ?>">

        <?php echo '<p>'.$cat['Category_Description'].'</p>'; ?>
        </a>

    </div>

    <?php
}
echo '</div>';

include  $tpl . "footer.php";?>