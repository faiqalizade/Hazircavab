<?php
	require 'templates/ready_sign.php';
	if (isset($_GET['add_verify_cavab_id'])) {
		$add_verify_cavab = R::load('readycavablar',$_GET['add_verify_cavab_id']);
		$add_verify_cavab->verify_cavab = 1;
		R::store($add_verify_cavab);
		echo "<script>window.location = '".$_SERVER['HTTP_REFERER']."';</script>";
	}
	if (isset($_GET['remove_verify_cavab_id'])) {
		$remove_verify_cavab = R::load('readycavablar',$_GET['remove_verify_cavab_id']);
		$remove_verify_cavab->verify_cavab = 0;
		R::store($remove_verify_cavab);
		echo "<script>window.location = '".$_SERVER['HTTP_REFERER']."';</script>";
	}
$opened_sual_find = R::load('readysuals',$_GET['sual_id']);
if ($opened_sual_find->id != 0):
			$proverka_na_admin = R::findOne('users','login = ?',[$user_values['login']]);
			$sual_added_user_values = R::findOne('users',' login = ?',[$opened_sual_find->added_user]);
			date_default_timezone_set('Asia/baku');
			if (isset($_POST['ready_suala_cavab_submit'])) {
				if (!isset($_GET['edit_suala_cavab_id'])) {
					$adding_suala_cavab = R::dispense('readycavablar');
					$adding_suala_cavab->sual_id = $opened_sual_find->id;
					$adding_suala_cavab->added_user_login = $user_values['login'];
					$adding_suala_cavab->cavab_content = $_POST['ready_suala_cavab'];
					$adding_suala_cavab->date = date('Y.m.d      G:i');
					$adding_suala_cavab->verify_cavab = 0;
					R::store($adding_suala_cavab);
					$adding_count_cavabs = R::load('readysuals',$opened_sual_find->id);
					$adding_count_cavabs->cavablar = $adding_count_cavabs->cavablar+1;
					R::store($adding_count_cavabs);
					echo "<script>window.location = 'index.php?page=ready&opened_sual&sual_id=".$_GET['sual_id']."';</script>";
				}else{
					$edit_suala_cavab = R::load('readycavablar',$_GET['edit_suala_cavab_id']);
					$edit_suala_cavab->cavab_content = $_POST['ready_suala_cavab'];
					R::store($edit_suala_cavab);
					echo "<script>window.location = 'index.php?page=ready&opened_sual&sual_id=".$_GET['sual_id']."';</script>";
				}
			}
		?>
	<div id="ready_content" style="">
		<div style="float: left; width: 98%; padding-left:2%; margin-top: 2%;">
			<img style="float:left; width: 8%;" src="images/login.png" alt="">
			<p class="client_name_ready"><a style="color:black;" href="index.php?page=profile&profile_id=<?=$sual_added_user_values->id;?>"><?=$sual_added_user_values->name.'  '.$sual_added_user_values->surname;?></a></p>
			<p class="client_login_ready">@<?=$sual_added_user_values->login;?></p>
			<p class="client_status_ready"><?=$sual_added_user_values->status;?></p>

		</div>
		<?php if ($proverka_na_admin->status == 'Admin' || $sual_added_user_values->login == $user_values['login']): ?>
			<div style="float:left;width:100%;position:relative;">
				<img class="redaktor_img" src="images/more.png" style="margin-bottom:1%;float:right; width:2%; margin-right: 5%;cursor:pointer;">
				<div style="display:none;top:37%;left:75.3%;" class="redaktor">
					<a style="" href="index.php?page=ready&ready_remove=<?=$opened_sual_find->id?>">Sil</a>
					<a href="index.php?page=ready&ready_edit=<?=$opened_sual_find->id?>">Redakte Et</a>
				</div>
			</div>
		<?php endif; ?>
		<h1 class="client_sual_basliq"><?=$opened_sual_find->sual_head;?></h1>
		<div style="margin-bottom:1%;" class="client_sual">
				<?=$opened_sual_find->sual_content;?>
				<p class="yerlesdirme_tarixi"><?=$opened_sual_find->added_date;?></p>
			</div>
				<script src="ckeditor/ckeditor.js"></script>
				<?php
				$opened_sual_cavablari = R::find('readycavablar','sual_id ='.$opened_sual_find->id.' ORDER BY date');
				if (!empty($opened_sual_cavablari)): ?>
					<p class="cavablar_text">Cavablar</p>
					<?php else: ?>
						<p style="float:left;width:100%; text-align:center; color:#c25213; font-size: 1.3em;">Bu sual hələ cavablanmayıb. Cavab verən, ilk siz olun!</p>
				<?php endif; ?>
				<?php
				foreach($opened_sual_cavablari as $cavablar):
					$added_cavab_login_find = R::findOne('users','login = ?',[$cavablar->added_user_login]);
				 ?>
					<div class="yorumdiv" style="border-bottom: 1px solid gray; float:left; width:100%; padding-top:2%;">
						<div style="float:left;width:100%;position: relative;">
							<img style="float:left;margin-left:4%;" src="images/login.png" width="4%" alt="">
							<?php if ($added_cavab_login_find->login == $user_values['login']): ?>
								<a href="index.php?page=profile&profile_id=<?=$added_cavab_login_find->id;?>" style="color:#060c17;display:block;float:left;font-size:0.8em;margin-top:0.3%;margin-left:.5%;">Men</a>
								<?php else: ?>
									<a href="index.php?page=profile&profile_id=<?=$added_cavab_login_find->id;?>" style="color:#060c17;display:block;float:left;font-size:0.8em;margin-top:0.3%;margin-left:.5%;"><?=$added_cavab_login_find->name.'  '.$added_cavab_login_find->surname?></a>
							<?php endif; ?>
							<?php if ($added_cavab_login_find->login == $user_values['login'] || $proverka_na_admin->status == 'Admin'):?>
								<img class="redaktor_img" src="images/more.png" style="float:right; width:2%; margin-right: 5%;cursor:pointer;">
								<div style="display:none;" class="redaktor">
									<a href="index.php?page=ready&remove_cavab_id=<?=$cavablar->id?>">Sil</a>
									<a href="index.php?page=ready&opened_sual&sual_id=<?=$_GET['sual_id']?>&edit_suala_cavab_id=<?=$cavablar->id?>">Redakte Et</a>
								</div>
							<?php endif; ?>
							<div style="float:left; margin-top:.4%; margin-left: .5%; width:9%;">
								<p style="float:left;color:gray;font-size:0.7em;">@<?=$added_cavab_login_find->login;?></p>
								<p style="float:left;font-size:0.7em;">Status: <?=$added_cavab_login_find->status;?></p>
							</div>
							<?php if ($sual_added_user_values->login != $user_values['login']):
								if($cavablar->verify_cavab):
								?>
								<img width="2%" style="float:left; margin-top:1%;" src="images/check.png">
							<?php
								endif;
						endif; ?>
						</div>
								<div class="ready_sual_cavab">
									<?=$cavablar->cavab_content;?>
									<p class="yerlesdirme_tarixi"><?=$cavablar->date;?></p>
								</div>
								<?php if ($sual_added_user_values->login == $user_values['login']):
									 if ($added_cavab_login_find->login != $user_values['login']):
											if (!$cavablar->verify_cavab):?>
											<a href="index.php?page=ready&opened_sual&add_verify_cavab_id=<?=$cavablar->id?>" style="display:block;margin-left:79.4%;float:left;width:27.6%; margin-bottom:1%;"><button class="bal_artirma" type="button" name="button">Cavab düzgündür</button></a>
										<?php elseif($cavablar->verify_cavab):?>
											<img width="3%" style="margin-left:74.4%;float:left;margin-right:2.5%;" src="images/check.png"><a href="index.php?page=ready&opened_sual&remove_verify_cavab_id=<?=$cavablar->id?>" style="display:block;float:left;width:20%; margin-bottom:1%;"><button class="bal_cixarma bal_artirma" type="button" name="button">Cavab səhvdir</button></a>
									<?php
											endif;
								 endif;
								endif;
								?>
					</div>
				<?php endforeach;?>
				<script>
				var redaktor = 0;
				$('.redaktor_img').bind('click',function () {
					$('.redaktor').hide();
					$('.redaktor_img').attr('src','images/more.png');
					$('.redaktor_img').css({
						'background-color': 'transparent',
						'border-radius': '0'
					});
					if (redaktor == 0) {
						$(this).next().fadeIn(600);
						$(this).attr('src','images/more_black.png');
						$(this).css({
							'background-color': '#cfccd0',
							'border-radius': '5px 5px 0 0'
						});
						redaktor = 1;
					}else {
						$(this).next().fadeOut(600);
						$(this).attr('src','images/more.png');
						$(this).css({
							'background-color': 'transparent',
							'border-radius': '0'
						});
						redaktor = 0;
					}
				});
				$('body').click(function (event) {
					if (event.target.className != 'redaktor_img') {
							if (redaktor == 1) {
								$('.redaktor').hide();
								$('.redaktor_img').attr('src','images/more.png');
								$('.redaktor_img').css({
									'background-color': 'transparent',
									'border-radius': '0'
								});
						}
					redaktor = 0;
				}
	});
				</script>
				<?php if(isset($_COOKIE['loged_user'])):
					//Eger cookie varsa
					if (isset($user_values['login']) && isset($user_values['password'])):
						//Eger user_values'de login ve password varsa hemen logini axtaririq
					$proverka_cookie = R::findOne('users','login = ?',[$user_values['login']]);
					if($proverka_cookie->password == $user_values['password']):
						//Eger password duzdurse edirik
						$edit_suala_cavab_find = R::load('readycavablar',$_GET['edit_suala_cavab_id']);
				 ?>
					<p style="float:left; width:96%; border-bottom: 3px solid #363b62; padding: .5% 0 .5% 4%; margin-top:2%; font-size:1.5em; font-weight:bold;">Sizin bu suala cavabiniz</p>
					<form method="post" style="float: left; width: 95%; margin-left: 2.5%; margin-top: 5%;">
					<?php if (!isset($_GET['edit_suala_cavab_id'])): ?>
					<textarea id="ck-editor-text" name="ready_suala_cavab"></textarea>
					<p class="error"></p>
					<input type="submit" name="ready_suala_cavab_submit" id="client_sual_sub" value="Cavabla">
				<?php else:
					//Eger editlenen cavabin added_user_login'i  user_valuesdeki login beraberdirse ve yaxud statusu admindirse
					if($edit_suala_cavab_find->added_user_login == $user_values['login'] || $proverka_cookie->status == 'Admin'):
					?>
					<textarea id="ck-editor-text" name="ready_suala_cavab"><?=$edit_suala_cavab_find->cavab_content;?></textarea><p class="error"></p>
					<p class="error"></p>
					<input type="submit" name="ready_suala_cavab_submit" id="client_sual_sub" value="Dəyiş">
					<?php else: //Eks halda onu Ready sehifesine gondermek lazimdir ?>
						<script>
						window.location = 'index.php?page=ready&new';
						</script>
				<?php
					endif;
			 endif;?>
					</form>
					<script>
					CKEDITOR.replace('ck-editor-text');
						setTimeout(function () {
						setInterval(function () {
							if ($('.cke_wysiwyg_frame').contents().find('p').text().length > 0){
							if ($('.cke_wysiwyg_frame').contents().find('p').text().length <= 20) {
								$('.error').text('Cavabın uzunluğu ən azı 20 olmalıdır');
								$('#client_sual_sub').attr('disabled','disabled');
								$('#client_sual_sub').css('cursor','not-allowed');
							}else if($('.cke_wysiwyg_frame').contents().find('p').text().length > 20){
								$('.error').text('');
								$('#client_sual_sub').removeAttr('disabled');
								$('#client_sual_sub').css('cursor','pointer');
							}
						}
						}, 1000);
					}, 1000);
					</script>
					</div>
				<?php else:?>
					<!-- Eger user valus de login ver password varsa amma login parol sehvdirse -->
					<script>
					function deletecookie ( cookie_name ){
							var date = new Date;
							date.setDate(date.getDate() - 5);
							document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
					}
					deletecookie('loged_user');
					window.location = 'index.php?page=ready&opened_sual&sual_id=<?=$_GET['sual_id']?>';
					</script>
				<?php endif; ?>
				<?php else: ?>
					<!-- Eger user valuesde login ve password yoxdursa -->
					<script>
					function deletecookie ( cookie_name ){
							var date = new Date;
							date.setDate(date.getDate() - 5);
							document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
					}
					deletecookie('loged_user');
					window.location = 'index.php?page=ready&opened_sual&sual_id=<?=$_GET['sual_id']?>';
					</script>
			<?php endif; ?>
	<?php else: ?>
		<!--Eger cookie yoxdursa-->
		<p style="text-align:center; font-size:1.5em; padding: 1%;">Ready'dən istifadə etmək üçün <span class="giris">giriş</span> edin və ya <span class="qeydiyyat_ready">qeydiyyatdan</span> keçin</p>
		<script>
		$(".qeydiyyat_ready").css({"cursor":"pointer","border-bottom":"2px solid"});
		$(".giris").css({"cursor":"pointer","border-bottom":"2px solid"});
		  $('.giris').click(function () {
		  		$("input[name='login_login']").focus();
		  });
				$('.qeydiyyat_ready').click(function () {
					$(".qeydiyyat_wrapper").css({'display':'flex'});
					$(".qeydiyyat").show(800);
		  });
		</script>
	<?php endif; ?>
	<?php else:
		//en birinci yoxladiq hele bir sual var ya yox yoxdursa asagdakilar olacaq
		?>
		<div id="ready_content">
			<p style="float:left; width:100%; text-align:center; font-size:2em; color: #bf571c; margin: 7% 0;">Belə bir sual tapılmadı</p>
		</div>
<?php endif; ?>
