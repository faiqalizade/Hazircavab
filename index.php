<?php
require 'db.php';
$title = 'Hazır Ev Tapşırıqları';
$page = $_GET['page'];
$service = $_GET['service'];
$sinif = $_GET['sinif'];
$openedfenn = $_GET['openedfenn'];
$openedsehife = $_GET['openedsehife'];
$openednumber = $_GET['openednumber'];
$adminsinif = $_GET['adminsinif'];
$adminfenn =$_GET['adminfenn'];
$add = $_GET['add'];
$edit = $_GET['edit'];
$adminopenedimage = $_GET['adminopenedimage'];
$remove = $_GET['remove'];
$removeid = $_GET['removeid'];
$admineditpage = $_GET['admineditpage'];
$admineditnumber = $_GET['admineditnumber'];
$editid = $_GET['editid'];
$addfenn = $_GET['addfenn'];
$editfenn = $_GET['editfenn'];
$removefenn = $_GET['removefenn'];
$imtahan = $_GET['imtahan'];
require 'templates/title.php';
if (isset($_COOKIE)) {
	$user_values = unserialize($_COOKIE['loged_user']);
}
?>
<!DOCTYPE html>
<html>
    <head>
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<script id="jquery" src="templates/jquery-3.2.1.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-2210735403250989",
    enable_page_level_ads: true
  });
</script>

        <title><?=$title;?></title>
        <meta charset="utf-8"/>
        <meta property="og:title" content="Hazır Cavab"/>
        <meta property="og:description" content='
        Hansısa tapşırıqı yazmaqda çətinlik çəkirsiz?
        Onda buyurun sizə Hazır Cavab! Azərbaycanda ilk və tək olan saytımız! Hazır Cavab
        tamamilə kömək məqsədi ilə qurulmuşdur.Saytımızda çətinlik çəkdiyiniz misalların
        cavablarını asanlıqla tapa bilərsiniz.'/>
        <meta property="og:image" content="http://hazircavab.org/images/Logoyasil200.png">
        <meta property="og:image:width" content="15" />
        <meta property="og:image:height" content="15" />
        <meta property="og:type" content="article"/>
        <meta property="og:url" content= "http://hazircavab.org" />
        <meta name="yandex-verification" content="d39942f52de8c95e" />
        <meta name="viewport" content="width=device-width"/>
        <meta name="description" content='
        Hansısa tapşırıqı yazmaqda çətinlik çəkirsiz?
        Onda buyurun sizə Hazır Cavab! Azərbaycanda ilk və tək olan saytımız!
        Hazır Cavab tamamilə kömək məqsədi ilə qurulmuşdur.Saytımızda
        çətinlik çəkdiyiniz misalların cavablarını asanlıqla tapa bilərsiniz.'/>
        <meta name="keywords" content="Hazır Cavab,Hazır Ev Tapşırıqları,Məktəb misallarınnın cavabları,Misalların həlli,Düzgün cavablar,
        Hazir Cavab,Hazir ev tapsiriqlari,Ev tapşırıqlarının cavabları,Testin cavabları">
        <link rel="shortcut icon" href="images/Logoyasil.png" type="image/png">
        <?php if($page != 'adminalfa'):?>
          <link rel="stylesheet" href="css/main.css">
										<link type="text/css" rel="stylesheet" href="http://is.mixmarket.biz/css/uni/partner.css">
										<link id="formedia" rel="stylesheet" href="">
										<script>
										var width;
										if ($(window).width() < 1100 && $(window).width() > 761) {
											width = 0;
											$('#formedia').attr('href','css/tablet.css');
										}else if ($(window).width() < 760) {
											$('#formedia').attr('href','css/mobile.css');
											width = 1;
										}else if ($(window).width() > 1100) {
											width = 0;
											$('#formedia').removeAttr('href');
										}
										$(window).resize(function () {
											if ($(window).width() < 1100 && $(window).width() > 761) {
												width = 0;
												$('#transidebar').css({'left':'-110%'});
												$(".qeydiyyat_div").hide();
												$('.qeydiyyat_div').css({
													'border':'solid 7px #DEDEDE',
													'box-shadow':'8px 8px 3px rgba(0, 0, 0, 0.4)',
												 'width':'20%',
													'position':'static',
													'margin':'1% 0 0 1%',
												 'top': '0',
												 'left':'0'
												 });
												$(".exit_giris").css({"display":"none"});
											$(".qeydiyyat_div").show();
												$('#formedia').attr('href','css/tablet.css');
											}else if ($(window).width() < 760) {
												if (width == 0){
													$('.qeydiyyat_div').css({'display':'none'});
													width = 1;
												}
												$('#formedia').attr('href','css/mobile.css');
												$(".exit_giris").css({"display":"block"});
											}else if ($(window).width() > 1101) {
												width = 0;
												$('#transidebar').css({'left':'-110%'});
												$(".qeydiyyat_div").hide();
												$('.qeydiyyat_div').css({
													'border':'solid 7px #DEDEDE',
													'box-shadow':'8px 8px 3px rgba(0, 0, 0, 0.4)',
													'width':'16%',
													'position':'static',
													'margin':'1% 0 0 1%',
													'top': '0',
													'left':'0'
												});
												$(".exit_giris").css({"display":"none"});
												$(".qeydiyyat_div").show();
												$('#formedia').removeAttr('href');
											}
										});
										</script>
          <?php else: ?>
            <link rel="stylesheet" href="css/admin.css">
          <?php endif; ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
        <?php
        if ($page != 'adminalfa') {
        require_once 'templates/header.php';
        }
								sleep(.5);
        require_once 'templates/page.php';
        if (!empty($errors)){
          echo '<p id="loginerrors">'.array_shift($errors).'</p>';
        }
          echo "</div>";

        if ($page != 'adminalfa') {
        require_once 'templates/footer.php';
        }
         ?>
        </div>
        <?php //include 'analytics.php'; ?>
								<?php if (isset($registered)): ?>
									<?php if ($registered):?>
										<script>
										setTimeout(function () {
											$('.qeydiyyat_form').css({'display':'none'});
											$(".qeydiyyat_wrapper").css({'display':'flex'});
											$(".qeydiyyat").fadeIn(800);
											$('#yoxlama').css({'color':'green'});
											$('#yoxlama').text('Təbriklər uğurla qeydiyyatdan keçdiniz');
										},100);
										</script>
										<?php else: ?>
											<script>
											setTimeout(function () {
												$(".qeydiyyat_wrapper").css({'display':'flex'});
												$(".qeydiyyat").fadeIn(800);
												$('#yoxlama').css({'color':'red'});
												$('#yoxlama').text('Belə bir login var');
											}, 500);
											</script>
									<?php endif; ?>
								<?php endif; ?>
								<script type="text/javascript">
								document.write('<scr' + 'ipt language="javascript" type="text/javascript" src="http://1294867889.us.mixmarket.biz/uni/us/1294867889/?div=mix_block_1294867889&layout=D0&r=' + escape(document.referrer) + '&rnd=' + Math.round(Math.random() * 100000) + '" charset="windows-1251"><' + '/scr' + 'ipt>');
								</script>
								<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = '4Acerdm8K6';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
    </body>
</html>
