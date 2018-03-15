
<?php
require 'templates/ready_sign.php';
$user_verify = R::findOne('users','id = ?',[$_GET['profile_id']]);
if ($user_verify->status == 'Lider'){
	$color = '#FFD700';
}elseif ($user_verify->status == 'Orta') {
	$color = '#d18615';
}elseif ($user_verify->status == 'Böyük') {
	$color = '#15aa31';
}elseif ($user_verify->status == 'Zəif') {
	$color = '#c20b0b';
}elseif ($user_verify->status == 'Admin') {
	$color = '#000a8f';
}
//Eger cookie varsa
if (isset($_COOKIE['loged_user'])):
	//Eger user valuesde login ve password varsa
	if (isset($user_values['login']) && isset($user_values['password'])):
		//Eger varsa hele bir login axtaririq
		$user_verify = R::findOne('users','login = ?',[$user_values['login']]);
		//Ve eger hele bir lgoin varsa
		if (!empty($user_verify)):
			//onun password'un yoxlayiriq
		if($user_verify->password == $user_values['password']):
			//Ve duzdurse Gosteririk
			$user_profile_load = R::load('users',$_GET['profile_id']);
			?>
		<div class="opened_profile_content">
			<div class="opened_profile_user">
				<p style="text-align:center;float:left;width:100%;"><img class="login_opened" src="images/login.png"></p>
				<p class="opened_profile_name"><?=$user_profile_load->name.' '.$user_profile_load->surname;?></p>
				<p class="opened_profile_login"><span style="color:#716d86;">Login:</span>&nbsp;&nbsp;@<?=$user_profile_load->login;?></p>
				<p class="opened_profile_status"><span style="color:#716d86;">Status:</span>&nbsp;&nbsp;<span style="color:<?=$color;?>"><?=$user_profile_load->status;?></span></p>
				<?php
				//Eger girilen profil onundursa Profilin redakte olunmasini Gosteririk
				if ($user_profile_load->login == $user_values['login']):
					//Eger knopkaya basilibsa
					if (isset($_POST['edit_profile_submit'])){
						//Hele bir id'de user axtaririq
						$edit_profile_load = R::load('users',$user_profile_load->id);
						//Eger hele bir user tapildisa
						if ($edit_profile_load->id != 0){
							//Eger passwordu editlemek istemyibse
							if (empty($_POST['edit_profile_password'])){
								$edit_profile_load->name = htmlspecialchars($_POST['edit_profile_name']);
								$edit_profile_load->surname = htmlspecialchars($_POST['edit_profile_surname']);
								R::store($edit_profile_load);
								echo "
								<script>
								$(document).ready (function() {
								$('.profile_edit_wrapper').css('display','flex');
								$('.profile_edit_content').fadeIn(1000);
								$('.qeydiyyat_form').css({'display':'none'});
								$('.qeydiyyat_text').text('Redaktə edildi');
								setTimeout(function(){
								function deletecookie ( cookie_name ){
										var date = new Date;
										date.setDate(date.getDate() - 5);
										document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
								}
								deletecookie('loged_user');
								var _GET = window
								.location
								.search
								.replace('?','')
								.split('&')
								.reduce(
									function(p,e){
										var a = e.split('=');
										p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
										return p;
									},
									{}
									);
									window.location = 'index.php?page=profile&profile_id='+_GET['profile_id'];
								},3000);
								});
								</script>
								";
							}else {
								//Eger passwordu editlemek isteyibse Onun indiki parol inputunda yazdigi kodu yoxalyiriq
								if (password_verify($_POST['edit_profile_password'],$user_profile_load->password)) {
									//Duzdurse edirik
									$edit_profile_load->name = htmlspecialchars($_POST['edit_profile_name']);
									$edit_profile_load->surname = htmlspecialchars($_POST['edit_profile_surname']);
									$edit_profile_load->password = password_hash($_POST['edit_profile_password_verify'],1);
									R::store($edit_profile_load);
									echo "
									<script>
									$(document).ready (function() {
									$('.profile_edit_wrapper').css('display','flex');
									$('.profile_edit_content').fadeIn(1000);
									$('.qeydiyyat_form').css({'display':'none'});
									$('.qeydiyyat_text').text('Redaktə edildi');
									setTimeout(function(){
										function deletecookie ( cookie_name ){
												var date = new Date;
												date.setDate(date.getDate() - 5);
												document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
										}
										deletecookie('loged_user');
										var _GET = window
										.location
										.search
										.replace('?','')
										.split('&')
										.reduce(
											function(p,e){
												var a = e.split('=');
												p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
												return p;
											},
											{}
											);
											window.location = 'index.php?page=profile&profile_id='+_GET['profile_id'];
									},3000)
});
									</script>
									";
								}else {
									//Eger onun yazdigi indiki parol duz deyilse
									echo "
									<script>
									$(document).ready (function() {
										$('.profile_edit_wrapper').css('display','flex');
										$('.profile_edit_content').fadeIn(1000);
										redaktorprofile();
										$('#yoxlama3').text('İndiki şifrə yanlışdır');
									});
									</script>
									";
								}
							}
						}else {
							//Eger bele bir user id si tapilmyibsa
						}
					}
					?>
			<p style="text-align:center;float:left;width:100%;">	<button type="button" id="redaktor_profile" name="button">Profili redakte et</button><p>
					<!-- Profile edit block -->
					<div class='profile_edit_wrapper'>
						<div class="profile_edit_content">
							<p class="qeydiyyat_text">Profili redaktə et </p>
							<form class="qeydiyyat_form" method="post">
								<input class="qeydiyyat_input username" type="text" name="edit_profile_name" value="<?=$user_profile_load->name?>" required placeholder="Ad"><br>
								<input class="qeydiyyat_input surname" type="text" name="edit_profile_surname" value="<?=$user_profile_load->surname?>" required placeholder="Soyad"><br>
								<input class="qeydiyyat_input now_password" type="password" name="edit_profile_password" placeholder="İndiki Şifrə"><br>
								<input class="qeydiyyat_input reg_password" type="password" name="edit_profile_password_verify" placeholder="Yeni şifrə"><br>
								<input class="qeydiyyat_input reg_password_verify" type="password" name="edit_profile_password_verify" placeholder="Yeni şifrəni təsdiqlə"><br>
								<input type="submit" style="cursor:not-allowed;" disabled name="edit_profile_submit" value="Dəyişdir" id="qeydiyyat_button">
								<button type="button"  id="qeydiyyat_button" class="cancel_edit_profile">Ləğv et</button>
							</form>
							<p id="yoxlama"></p>
							<p id="yoxlama2"></p>
							<p id="yoxlama3"></p>
						</div>
					</div>
					<script>
  			// Lazimli olan varlari global olaraq tanidiriq
					var verify1 = false,
					verify2 = false,
					edit_login_interval,
					verify3 = false;
					// Eger Dəyişdir butonuna basilibsa
					$("#redaktor_profile").click(function (){
						$('.profile_edit_wrapper').css('display','flex');
						$('.profile_edit_content').fadeIn(1000);
				 redaktorprofile();
					});
					function redaktorprofile() {
						// Ad ve soyadi vara aliriq.
						var clientname = $('.username').val(),
						clientsurname = $('.surname').val();
						// Her defe yoxlamasi ucun interval ile her 1 mili saniyede funksiya basladiriq
						edit_login_interval = setInterval(function () {
									if (clientname != $('.username').val() || clientsurname != $('.surname').val()) {
										// Sifre inputlarinda yazilib yazilmadigini yoxlayiriq
										if ($('.reg_password').val().length < 1 && $('.reg_password_verify').val().length < 1) {
											$('#qeydiyyat_button:eq(0)').removeAttr('disabled');
											$('#qeydiyyat_button:eq(0)').css('cursor','pointer');
										}else { // Eger indiki sifre yazilmiyibsa butona basmaq olmasin
											if ($('.now_password').val() == '') {
												$('#qeydiyyat_button:eq(0)').attr('disabled','disabled');
												$('#qeydiyyat_button:eq(0)').css('cursor','not-allowed');
											}else { // Eger indiki sifre yazilibsa butona basmaq olsun
												$('#qeydiyyat_button:eq(0)').removeAttr('disabled');
												$('#qeydiyyat_button:eq(0)').css('cursor','pointer');
											}
										}
									}else { // ad ve soyad degistirilende onda bas veren funksiyalar
										if (!verify1 && !verify2 && !verify3) {
											// Her seyin duz olub olmadigini yoxlayiriq
											$('#qeydiyyat_button:eq(0)').attr('disabled','disabled');
											$('#qeydiyyat_button:eq(0)').css('cursor','not-allowed');
										}else if($('.reg_password_verify').val() == $('.reg_password').val()) {
											// Eger sifreler bir birine beraberdirse :
											if ($('.now_password').val().length <= 6) { // Eger indiki sifrenin uzunlugu 6 ya beraberdirse ve ya boyukdurse :
												$('#qeydiyyat_button:eq(0)').attr('disabled','disabled');
												$('#qeydiyyat_button:eq(0)').css('cursor','not-allowed');
											}else { // Eger indiki sifrenin uzunlugu 6-dan kicikdirse :
												$('#qeydiyyat_button:eq(0)').removeAttr('disabled');
												$('#qeydiyyat_button:eq(0)').css('cursor','pointer');
											}
										}
										// Eger indiki sifre bosdursa edilecek funksiyalar
										if ($('.now_password').val() == '') {
											$('.reg_password').on('keyup',function(){
												if ($('.reg_password').val() != $('.reg_password_verify').val()) {
													// Parollarin eyni olub olmadigini yoxlayiriq eger eyni deilse :
													verify2 = false;
													$('#yoxlama').text('Parollar eyni deyil');
													if ($('#reg_password_verify').val() = '') {
														$('#qeydiyyat_button').attr('disabled','disabled');
														$('#qeydiyyat_button').css({"cursor" : "not-allowed"});
													}else {
														$('#qeydiyyat_button').removeAttr('disabled');
														$('#qeydiyyat_button').css({"cursor" : "pointer"});
													}
												}else { // Eger eynidirse :
													verify2 =  true;
													$('#yoxlama').text('');
													$('#qeydiyyat_button').removeAttr('disabled');
													$('#qeydiyyat_button').css({"cursor" : "pointer"});
												} // Birinci Sifrenin uzunlugunu 6 dan kicik olub olmadigini yoxluyuruq
												if ($(".reg_password").val().length <= 6) {
													// Eger kicikdirse :
													verify1 = false;
														$('#yoxlama2').text('Parolun uzunluğu ən azı 6 olmalıdır');
														$('#yoxlama').text('');
														$('#qeydiyyat_button').attr('disabled','disabled');
														$('#qeydiyyat_button').css({"cursor" : "not-allowed"});
													}else { // Eger Boyukdurse ve ya beraberdirse
														verify1 = true;
														$('#yoxlama2').text('');
														$('#qeydiyyat_button').removeAttr('disabled');
														$('#qeydiyyat_button').css({"cursor" : "pointer"});
													}
											});  // Ikinci Sifrenin uzunlugunu 6 dan kicik olub olmadigini yoxluyuruq
											$('.reg_password_verify').on('keyup',function(){
												if ($('.reg_password_verify').val() != $('.reg_password').val()) {
													// Eger eyni deilse :
													$('#yoxlama').text('Parollar eyni deyil');
													$('#qeydiyyat_button').attr('disabled','disabled');
													$('#qeydiyyat_button').css({"cursor" : "not-allowed"});
												}else { // Eger eynidirse
													$('#yoxlama2').text('İndiki şifrəni yazın');
													verify3 = true;
													$('#yoxlama').text('');
													$('#qeydiyyat_button').removeAttr('disabled');
													$('#qeydiyyat_button').css({"cursor" : "pointer"});
												}
											});
										} // Eger indiki funksiya bos deyilse edilecek funksiyalar :
										else {
											$('#yoxlama2').text('');
												if ($('.now_password').val().length > 0  && $('.reg_password').val().length < 1 && $('.reg_password_verify').val().length < 1) {
													// Eger yeni sifreni yazmiyibsa :
													$('#yoxlama').text('Yeni şifrəni yazın');
													$('#qeydiyyat_button:eq(0)').attr('disabled','disabled');
													$('#qeydiyyat_button:eq(0)').css('cursor','not-allowed');
												}else { // Eger yazibsa :
													if ($('.reg_password').val().length > 1) {
														if ($('.reg_password_verify').val().length > 1) {
															if ($(".reg_password").val().length > 5 && $('.reg_password').val() == $('.reg_password_verify').val()){
																$('#qeydiyyat_button:eq(0)').removeAttr('disabled');
																$('#qeydiyyat_button:eq(0)').css('cursor','pointer');
															}
														}else {
																if ($(".reg_password").val().length < 6 && $('.reg_password').val() != $('.reg_password_verify').val()) {
																	$('#qeydiyyat_button').attr('disabled','disabled');
																	$('#qeydiyyat_button').css({"cursor" : "not-allowed"});
																}else {
																	if ($('.reg_password').val() == $('.reg_password_verify').val()) {
																		$('#qeydiyyat_button').removeAttr('disabled');
																		$('#qeydiyyat_button').css({"cursor" : "pointer"});
																	}
																}
														}
													}
												}

										}
									}
						}, 100);
					}
					// Eger legv ede basirsa blokun gizlenmesi
					$('.cancel_edit_profile').click(function () {
						clearInterval(edit_login_interval);
						$(".profile_edit_content").fadeOut(800);
						$(".profile_edit_wrapper").fadeOut(800);
					});
					// Blokdan qiraga basanda bloku gizlenmesi
					$(document).click(function (event) {
						if (event.target.className == 'profile_edit_wrapper') {
							$(".profile_edit_content").fadeOut(800);
							$(".profile_edit_wrapper").fadeOut(800);
							clearInterval(edit_login_interval);
					}
				});
					</script>
					<!-- end profile edit block -->
				<?php endif; ?>
				<div class="opened_profile_values">
					<?php
					$my_suals = R::find('readysuals',' added_user LIKE ?',[$user_profile_load->login]);
					$my_cavabs = R::find('readycavablar','added_user_login LIKE ?',[$user_profile_load->login]);
					$verify_cavab_counts = 0;
					foreach ($my_cavabs as $find_verify_cavab_counts) {
						if ($find_verify_cavab_counts->verify_cavab == 1) {
							$verify_cavab_counts++;
						}
					}
						?>
					<div class="scores_block_wrapper">
						<div class="scores_blocks">
							<p>0</p>
							<p>Bal</p>
						</div>
						<div class="scores_blocks">
							<p><?=count($my_suals)?></p>
							<p>Suallar</p>
						</div>
						<div class="scores_blocks">
							<p><?=count($my_cavabs);?></p>
							<p>Cavablar</p>
						</div>
						<div class="scores_blocks" >
							<p><?=$verify_cavab_counts?></p>
							<p>Düzgün cavablar</p>
						</div>
					</div>
				</div>
				<div style="float:left; width: 100%;border-bottom: solid 1px #cbcce8; border-top: solid 1px #cbcce8;">
					<p id="my_suals">Suallar</p>
					<p id="my_cavabs">Cavablar</p>
				</div>
				<div class="my_suals_content">
					<?php foreach ($my_suals as $my_sual):
						$is_verify_cavab = false;
						$if_is_verify_cavabs = R::find('readycavablar','sual_id = '.$my_sual->id);
						foreach ($if_is_verify_cavabs as $verify_cavabs) {
							if ($verify_cavabs->verify_cavab) {
								$is_verify_cavab = true;
							}
						}
						 ?>
						<div class="client_suallar">
							<div style="float:left; width: 85%; word-wrap: break-word;">
								<p style="float:left; width:100%;"><a class="client_sual_h" href="index.php?page=ready&opened_sual&sual_id=<?=$my_sual->id;?>"><?=$my_sual->sual_head;?></a></p>
								<p class="client_time"><?=$my_sual->added_date?></p>
							</div>
							<?php if ($is_verify_cavab): ?>
								<div style="float:left; width:15%; text-align: center; color: #38506c; font-size: 1.2em;">
									<?=$my_sual->cavablar?> <br>
									Cavab
								</div>
								<?php else: ?>
									<div style="float:left; width:15%; text-align: center; color: #38506c; font-size: 1.2em;">
										<?=$my_sual->cavablar?> <br>
										Cavab
									</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="my_cavabs_content">
					<?php
					 foreach ($my_cavabs as $my_cavab):
						$my_cavabs_sual = R::load('readysuals',$my_cavab->sual_id);
						?>
						<div class="client_suallar">
							<?php if ($my_cavabs_sual->added_user == $user_values['login']): ?>
									<a href="index.php?page=ready&opened_sual&sual_id=<?=$my_cavab->sual_id;?>" style="display:block;float:left;width:85%;font-size: .9em;">Sual: <?=$my_cavabs_sual->sual_head.'<span style=\'color:#888c89;\'>    Login:  Men</span>';?></a>
								<?php else: ?>
									<?php if (empty($my_cavabs_sual->sual_head) && empty($my_cavabs_sual->added_user)): ?>
										<p style="float:left;width:85%;font-size: .9em; color:#db711a;">Sual silinib</p>
										<?php else: ?>
											<a href="index.php?page=ready&opened_sual&sual_id=<?=$my_cavab->sual_id;?>" style="display:block;float:left;width:85%;font-size: .9em; color:#230db6;">Sual: <?=$my_cavabs_sual->sual_head.'<span style=\'color:#888c89;\'>    Login:  @'.$my_cavabs_sual->added_user.'</span>';?></a>
									<?php endif; ?>
							<?php endif; ?>
							<div style="float: left; width:80%; overflow-x:scroll;">
								<p><?=$my_cavab->cavab_content;?></p>
							</div>
         <?php if ($my_cavab->verify_cavab): ?>
         	<img style="margin-left:14%;float:right;" src="images/check.png" width="3%" alt="">
         <?php endif; ?>
						</div>

					<?php endforeach; ?>
				</div>
				<script>
				$('.my_cavabs_content').hide();
				$('#my_cavabs').css({'border':'none'});
				$('#my_cavabs').click(function () {
					$('.my_suals_content').fadeOut(200);
					$('#my_cavabs').css({'border-bottom':'2px solid'});
					$('#my_suals').css({'border':'none'});
					setTimeout(function () {
						$('.my_cavabs_content').fadeIn(200);
					}, 200);
				});
				$('#my_suals').click(function () {
					$('.my_cavabs_content').fadeOut(200);
					$('#my_suals').css({'border-bottom':'2px solid'});
					$('#my_cavabs').css({'border':'none'});
					setTimeout(function () {
						$('.my_suals_content').fadeIn(200);
					}, 200);
				});
				</script>
			</div>
		</div>
			<?php else:
				//Eger password beraber Deyilse
				 ?>
				<script>
				function deletecookie ( cookie_name ){
						var date = new Date;
						date.setDate(date.getDate() - 5);
						document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
				}
				deletecookie('loged_user');
				window.location = 'index.php?page=ready&new';
				</script>
				<?php endif;
				//Eger hele bir user tapilmadisa
			else:
				?>
				<script>
				function deletecookie ( cookie_name ){
						var date = new Date;
						date.setDate(date.getDate() - 5);
						document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
				}
				deletecookie('loged_user');
				window.location = 'index.php?page=ready&new';
				</script>
				<?php
					endif;
			 else:
					//Eger user_values'de login ve password yoxdursa
					?>
					<script>
					function deletecookie ( cookie_name ){
							var date = new Date;
							date.setDate(date.getDate() - 5);
							document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
					}
					deletecookie('loged_user');
					window.location = 'index.php?page=ready&new';
					</script>
		<?php endif;
	else://Eger loged_user cookie si yoxdursa
		 ?>
	<div class="opened_profile_content">
		<p style="text-align:center; font-size:2em; color:#bf571c; margin: 9.3% 0;"><b>Ready</b>'hesablarına baxmaq ücün <b>Ready</b>'hesabınız olmalıdır</p>
	</div>
<?php endif; ?>
