<?php 
ob_start();

session_start();

$pageTitle = 'Automobil';
    
include 'init.php';
?>

<h1>About us 2</h1>
<!--
<iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fwww.a2z4a.com%2Fam_item.php%3Fitemid%3D11113&layout=button&size=small&mobile_iframe=true&width=58&height=20&appId" width="58" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
-->
<br><br>

<a href="http://www.facebook.com/sharer.php?s=100&p[title]=Sample+title%21&p[url]=http://www.a2z4a.com&p[summary]=Upcoming+talks+in+toronto&p[images][0]=images/items/r8.jpg">ff</a>


<br><br>
http://www.a2z4a.com
<img src="images/items/r8.jpg">

<br><br>
<a href="https://www.facebook.com/sharer.php?s=100&p[title]=Title+here&p[url]=http://www.a2z4a.com&p[summary]=I+love+cheese&p[images][0]=http://www.a2z4a.com/images/items/r8.jpg" target="_blank">Test</a>


<?php
////////////////////////////////////////////
//$geoIP = getIP();

/*
$geoIP  = json_decode(file_get_contents("http://freegeoip.net/json/$ipAddr"), true);
print_r($geoIP);
echo $geoIP;
if (isset($geoIP['country_name'])){$country = $geoIP['country_name'];}else{$country = NULL; }//echo $country;
echo '<br>< ' .$country. ' >';

*/

include  $tpl . "footer.php";?>