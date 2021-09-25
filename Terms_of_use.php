<?php 
ob_start();

session_start();

$pageTitle = 'Terms of use | A to Z for All';
    
include 'init.php';
?>

<h1 class="text-center"><?php getTE('Terms of use'); ?></h1>
<?php
if(isset($_SESSION['ulang']) && $_SESSION['ulang'] == 12){
  ?>
<p>فيما يلي المعلومات والشروط الواجب على مستخدم الموقع معرفتها ومراعاتها :</p>

<p>  عدم التوجه بالايذاء اللفظي لأي جهة من خلال التعليقات على الاعلانات والعارضين.</p>
<p>  يحق للمستخدم الواحد تقييم كل معلن لمرة واحدة فقط ، وسيعتبر التقييم الثاني تغيير للأول.</p>
<p>  يحق للمستخدم الواحد تقييم كل إعلان لمرة واحدة فقط، وسيعتبر التقييم الثاني تغيير للأول.</p>
<p>  يحق لادارة الموقع حذف اي اعلان لا يستوفي شروط العرض، دون اعلام صاحبه.</p>
<p>  يحق لادارة الموقع حذف أي تعليق لا يتماشى مع شروط الاستخدام.</p>
<p>  يحق لادارة الموقع استخدام احصاءات البيانات المدخلة ، وسجلات البحث لتطوير سوق العرض في الدول التي يتم تشغيل الموقع فيها.</p>
<p></p>
<?php

}else {

 ?>
 <p>The following is the information and conditions that the user of the site must know and observe:</p>

 <p>o Do not resort to verbal abuse to any party through comments on advertisements and exhibitors.</p>
 <p>o One user is entitled to evaluate each advertiser only once, and the second will be considered a change to the first one.</p>
 <p>o One user is entitled to evaluate each ad for one time only, and the second will be considered a change to the first one.</p>
 <p>o Site management has the right to delete any advertisement that does not meet the conditions of the offer, without informing the owner.</p>
 <p>o Site management has the right to delete any comments that do not comply with the terms of use.</p>
 <p>o The management of the site has the right to use the statistics of the data entered, and the search records to develop the display market in the countries where the site is operated.</p>

 <?php
}

echo '<br><br>';
echo '<div class="text-center">';
echo '<a class="btn btn-success" href="signup.php">'.getT('Continue registration').'</a>';
echo '</div>';



include  $tpl . "footer.php";?>