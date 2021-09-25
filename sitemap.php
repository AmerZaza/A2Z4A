<?php 
ob_start();
session_start();


$pageTitle = 'Sitemap Page | A to Z for All';
    
include 'init.php';

?>
<h1><?php getTE('Sitemap');?></h1>
<div class="container">
	<div class="row">
		
		<h2><a href="index.php"><?php getTE('Home Page');?></a></h2>


		<label><a href="am_items.php?pageid=80"><?php getTE('automobile');?>:</a></label>
		<p><a href="am_select.php"><?php getTE('More Details');?></a></p>

		<p><a href="about_us.php"><?php getTE('About us');?></a></p>
		<p><a href="subscribe.php"><?php getTE('Subscribe');?></a></p>
		<p><a href="feedback.php"><?php getTE('Feedback');?></a></p>

		

	</div>
	
</div>

<?php


include  $tpl . "footer.php";?>