<?php
$verifed = false;
if (isset($_COOKIE['loged_user'])) {
	if (isset($user_values['login']) && isset($user_values['password'])) {
		$user_verify = R::findOne('users','login = ?',[$user_values['login']]);
		if ($user_verify->password == $user_values['password']) {
			$verifed = true;
		}
	}
}
  #buarada acilmis sehifeni headerde(basliqda) arxa rengin dueldilmesi ucun oyrenirik
  if ($title == 'Hazır Ev Tapşırıqları') {
    $home = 'home';
  }elseif($title == 'Əlaqə') {
    $contact = 'contactmenu';
  }
		if ($page == 'ready'|| $page == 'profile') {
			$ready = 'ready';
  }
 ?>
<header>
  <img id="sidebarsvg" style="cursor:pointer;" src="images/menu.svg">
    <div id='transidebar'>
      <img id="backforsdb" src="images/back.svg" alt="">
						<?php if ($page != 'ready' && $page != 'profile'): ?>
							<p class="zaqolovok">Az sektoru</p>
							<ul>
											<li><a id="<?php echo $openedaz5; ?>" href="index.php?page=openedsinif&sinif=az5">5-ci sinif</a></li>
											<li><a id="<?php echo $openedaz6; ?>" href="index.php?page=openedsinif&sinif=az6">6-cı sinif</a></li>
											<li><a id="<?php echo $openedaz7; ?>" href="index.php?page=openedsinif&sinif=az7">7-ci sinif</a></li>
											<li><a id="<?php echo $openedaz8; ?>" href="index.php?page=openedsinif&sinif=az8">8-ci sinif</a></li>
											<li><a id="<?php echo $openedaz9; ?>" href="index.php?page=openedsinif&sinif=az9">9-cu sinif</a></li>
							</ul>
							<p class="zaqolovok" id="russidebar">Русский сектор</p>
							<ul style="margin-bottom: 8%;">
											<li><a id="<?php echo $openedru5; ?>" href="index.php?page=openedsinif&sinif=ru5">5-ый класс</a></li>
											<li><a id="<?php echo $openedru6; ?>" href="index.php?page=openedsinif&sinif=ru6">6-ой класс</a></li>
											<li><a id="<?php echo $openedru7; ?>" href="index.php?page=openedsinif&sinif=ru7">7-ой класс</a></li>
											<li><a id="<?php echo $openedru8; ?>" href="index.php?page=openedsinif&sinif=ru8">8-ой класс</a></li>
											<li><a id="<?php echo $openedru9; ?>" href="index.php?page=openedsinif&sinif=ru9">9-ый класс</a></li>
							</ul>
							<a href="index.php?page=services" style="color: white; font-size: .9em;font-family:Arial; font-weight: bold;"> Сервисы / Servislər </a><br>
							<a href="index.php?page=imtahan" style="color: white; font-size: .9em;font-family:Arial; font-weight: bold;"> Тесты / İmtahanlar <sup style="color: rgb(134,214,180); font-size:.3em; text-shadow: 0 0 2px rgba(114,212,165,.43);">NEW</sup></a><br>
							<?php if (!isset($_COOKIE['loged_user'])): ?>
								<a class="giris" style="cursor:pointer;color: white; font-size: .9em;font-family:Arial; font-weight: bold;">Giriş</a>
							<?php else: ?>
								<?php if ($verifed): ?>
									<a class="giris" style="cursor:pointer;color: white; font-size: .9em;font-family:Arial; font-weight: bold;">@<?=$user_values['login'];?></a>
								<?php endif; ?>
							<?php endif;?>
							<?php else: ?>
								<?php if ($verifed): ?>
									<script>
									var $_GET = {};
								if(document.location.toString().indexOf('?') !== -1) {
									var query = document.location
																	.toString()
																	// get the query string
																	.replace(/^.*?\?/, '')
																	// and remove any existing hash string (thanks, @vrijdenker)
																	.replace(/#.*$/, '')
																	.split('&');

									for(var i=0, l=query.length; i<l; i++) {
											var aux = decodeURIComponent(query[i]).split('=');
											$_GET[aux[0]] = aux[1];
									}
								}
									</script>
									<div style="text-align:center;"  id="ready_user_mobile">
										<div style="width:100%;float:left;text-align:left;">
											<img src="images/login.png" width="30%;" style="">
											<a href="index.php?page=profile&profile_id=<?=$user_verify->id;?>" style="float:left;width:100%;color:#fff;font-size:0.8em;margin-left:2.7%;">@<?=$user_verify->login;?></a>
											<p style="font-size:0.7em;color:white;float:left;width:100%;margin-bottom:2%;margin-left:6%;">&nbsp;<?=$user_verify->status;?></p>
										</div>
										<div style="margin-right:30%;margin-left:.5%;float:left;" class="ready_user_panel">
											<a class="ready_class2" href="index.php?page=ready">Suallar</a>
											<a class="ready_class" href="index.php?page=profile&profile_id=<?=$user_verify->id;?>">Mənim Profilim</a>
											<a class="ready_class3" href="#">Bildirimler</a>
												<a class="ready_class4" href="index.php">&#8592; Hazır Cavab'a qayıt</a>
										</div>
									</div>
									<script>
									if ($_GET['page']=='profile') {
										$('.ready_class').addClass('test2');
									}else if ($_GET['page']=='ready') {
										$('.ready_class2').addClass('test3');
									}
									</script>
									<?php else: ?>
											<a class="giris" style="cursor:pointer;color: white; font-size: .9em;font-family:Arial; font-weight: bold;"> Giriş </a>
											<script src="templates/registry.js"></script>
								<?php endif; ?>
						<?php endif; ?>
			 </div>
				<script>
				if ($(window).width() < 760) {
					$('#sidebarsvg').click(function () {
						$('#transidebar').css({'left':'0'});
					});
					$('#backforsdb').click(function () {
						$('#transidebar').css({'left':'-110%'});
					});
				}
				$(window).resize(function () {
					if ($(window).width() < 760) {
						$('#sidebarsvg').click(function () {
							$('#transidebar').css({'left':'0'});
						});
						$('#backforsdb').click(function () {
							$('#transidebar').css({'left':'-110%'});
						});
					}
				});
				</script>
  <a name = 'rusca' title="Ana Səhifə" href="index.php"><img id='logohead' src="images/Logo.svg" ></a>
  <a href="index.php?page=contact"><img class="menusvg" src="images/phone-book.svg" alt=""></a>
		<a href="index.php?page=ready&new"><img class="menusvg" src="images/ready.png" alt=""></a>
  <a href="index.php"><img class="menusvg" src="images/house.svg" alt=""></a>
  <!-- Kompyuter ve Planset versiyasinda asagdakilar olacaq -->
    <menu>
        <li><a id='<?=$home;?>' class="imtahan" href="index.php">Ana Səhifə</a></li>
								<li><a id='<?=$ready;?>' class="imtahan"  href="index.php?page=ready&new">Ready</a></li>
        <li><a id='<?=$contact;?>' class="imtahan"  href="index.php?page=contact">Əlaqə</a></li>
    </menu>
<script>
	$(document).ready (function () {
		$(".giris").click(function () {
			$(".qeydiyyat_div").css({
				"position" : "fixed",
				"width" : "100%",
				"height" : "100%",
				'border':'none',
				'box-shadow':'none',
				'margin':'0',
				"top":"0",
				"left" : "0"});
			$(".exit_giris").html('<p>Bağla</p>');
			$(".qeydiyyat_div").hide();
			$(".qeydiyyat_div").fadeIn(1000);
			$(".exit_giris").bind('click',function () {
			  $(".qeydiyyat_div").fadeOut(1000);
			});
			$("#userimg").css({"float":"none"});
			$(".client_logout").css({"float":"none","margin-left":"0"});
		});
	});
</script>
</header>
