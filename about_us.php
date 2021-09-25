<?php 
ob_start();

session_start();

$pageTitle = 'About A to Z for All |E-commerce portal';
    
include 'init.php';
?>

<h1 class="text-center"><?php getTE('About us'); ?></h1>
<?php
if(isset($_SESSION['ulang']) && $_SESSION['ulang'] == 61){
  ?>
<p>نسعى من خلال موقعنا الحالي تحقيق أعلى درجات الكفائة للزوار الاعزاء من البائعين والمشترين على حد سواء، ذلك من خلال:</p>
<p>•  التطوير الدائم للموقع وتنويع الخدمات المقدمة.</p>
<p>•  تحقيق المرونة من خلال التوجه بتطوير الخدمات نحو متطلبات زوار الموقع المسجلة في سجل الزوار لتحقيق الحد الأكبر من مردودية الاستخدام لديهم.</p>
<p>•  امكانية الاستفادة من احصاءات البحث المسجلة في بيانات الموقع ، لرفع امكانية الوصول للمعلومات والتعامل معها من قبل الزوار.</p>
<p>•  اتاحة تقديم تفاصيل أكثر دقة حول اعلانات المواد المعروضة مما تقدمه المواقع الأخرى.</p>
<p>•  اتاحة ادراج روابط للمادة المعروضة في مواقع أخرى .</p>
<p>•  امكانية بناء صفحة مستقلة للبائع ، من الممكن له من خلالها بالاضافة لعرض اعلاناته ادراج طرق الاتصال معه ، وعرض معلومات مفصلة عنه في حال كان البائع شركة تجارية .</p>
<p>•  امكانية تقييم المنتجات والبائعين من قبل الزوار ، مما سيعزز ثقة الزوار ببيانات الموقع.</p>
<p>•  خطة ادارة الموقع للترويج المستمر له والفوز بأكبر عدد ممكن من الزوار المعنيين بالاعلانات  المعروضة.</p>
<?php

}else {
  
 ?>

 <p>Through our current website, we aim to achieve the highest degree of efficiency for our dear visitors, both sellers and buyers, through:</p>
 <p>• Permanent site development and diversification of services provided.</p>
 <p>• Achieve flexibility by developing services to meet the requirements of registered visitors in the guestbook to maximize their cost-effectiveness.</p>
 <p>• The possibility of benefiting from the research statistics recorded in the site data, to increase access to information and deal with it by visitors.</p>
 <p>• Make it possible to provide more accurate information about the ads of the materials offered by other sites.</p>
 <p>• Enable links to the material displayed in other sites.</p>
 <p>• The possibility of building an independent page for the seller, through which in addition to the presentation of his ads to include ways to contact him, and provide detailed information about him in case the seller is a trading company.</p>
 <p>• The possibility of evaluating products and sellers by visitors, which will enhance visitors' confidence in the site data.</p>
 <p>• Site management plan to continuously promote and win as many visitors as possible.</p>

 <?php
}



include  $tpl . "footer.php";?>