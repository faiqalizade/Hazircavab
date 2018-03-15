
<?php if (isset($_GET['trand'])): ?>
	<script>
	$(document).ready (function () {
		$('.border').eq(1).css({'border-bottom':'solid 2px'})
	});
	</script>
<?php elseif(isset($_GET['no_cavab'])): ?>
	<script>
	$(document).ready (function () {
		$('.border').eq(2).css({'border-bottom':'solid 2px'})
	});
	</script>
	<?php else: ?>
		<script>
		$(document).ready (function () {
			$('.border').eq(0).css({'border-bottom':'solid 2px'})
		});
		</script>
<?php endif;
//Eger cookie varsa
if (isset($_COOKIE['loged_user'])) {
	//Yoxlayiriq user_values'de password ve logn varsa
	if (isset($user_values['login']) && isset($user_values['password'])){
		//Eger cavabin silinmesi varsa
		$proverka_cookie = R::findOne('users','login = ?',[$user_values['login']]);
		if (isset($_GET['remove_cavab_id'])){
			//Cookie ni yoxlayirq
			//Eger user_valuesdeki paasword yxolanin cookie deki passworda eraberdirse
			if ($user_values['password'] == $proverka_cookie->password){
				//Cavabi yukleyiril
				$loading_cavab = R::load('readycavablar',$_GET['remove_cavab_id']);
				//Eger hele bir cavabvarsa
				if ($loading_cavab->id != 0) {
					//Yoxlayiriq cavab ona aiddir ve yaxud proverka_cookie status Admindirse
					if ($loading_cavab->added_user == $user_values['login'] || $proverka_cookie->status == 'Admin') {
						//Suali pozuruq
						$minus_cavablar = R::load('readysuals',$loading_cavab->sual_id);
						//readysuals table'ndeki cavablardan 1 cixiriq
						if ($minus_cavablar->cavablar != 0){
							$minus_cavablar->cavablar = $minus_cavablar->cavablar - 1;
						}else {
							$minus_cavablar->cavablar = 0;
						}
					R::store($minus_cavablar);
					R::trash($loading_cavab);
					echo "<script>window.location = '".$_SERVER['HTTP_REFERER']."';</script>";
					}
				}
			}
		}
		//Eger sualin silinmesi varsa
		elseif (isset($_GET['ready_remove'])) {
			if ($user_values['password'] == $proverka_cookie->password) {
				$loading_sual = R::load('readysuals',$_GET['ready_remove']);
				if ($loading_sual->added_user == $user_values['login'] && $proverka_cookie->status == 'Admin') {
					R::trash($loading_sual);
				}
			}
		}
	}
}
require 'templates/ready_sign.php';
?>
	<div id="ready_content">
		<a href="index.php?page=ready&new"><h1 class="ready_h1">Ready</h1></a>
		<?php if (!isset($_GET['ready_add']) && !isset($_GET['ready_edit'])): ?>
			<ul>
				<li><a href="index.php?page=ready&new" class="border">Yeni</a></li>
				<li><a href="index.php?page=ready&trand" class="border">Populyar</a></li>
				<li><a href="index.php?page=ready&no_cavab" class="border">Cavabı verilmeyen'ler</a></li>
			</ul>
			<?php if (isset($_COOKIE['loged_user'])): ?>
				<a class="new_ready_add" href="index.php?page=ready&ready_add">&#9998; Sual ver</a>
			<?php endif; ?>
			<?php
			if (isset($_GET['new'])) {
				$ready_suallar = R::find('readysuals','ORDER BY added_date DESC');
			}elseif (isset($_GET['trand'])) {
				$ready_suallar = R::find('readysuals','ORDER BY cavablar DESC');
			}elseif (isset($_GET['no_cavab'])) {
				$ready_suallar = R::find('readysuals','cavablar = 0');
			}else {
				$ready_suallar = R::find('readysuals','ORDER BY added_date DESC');
			}
			foreach ($ready_suallar as $sual):
				$is_verify_cavab = false;
				$if_is_verify_cavabs = R::find('readycavablar','sual_id = '.$sual->id);
				foreach ($if_is_verify_cavabs as $verify_cavabs) {
					if ($verify_cavabs->verify_cavab) {
						$is_verify_cavab = true;
					}
				}
				?>
			<div class="client_suallar">
			<div style="float:left; width: 85%;word-wrap: break-word;">
				<p style="float:left; width:100%;"><a class="client_sual_h" href="index.php?page=ready&opened_sual&sual_id=<?=$sual->id;?>"><?=$sual->sual_head;?></a></p>
				<p class="client_time"><?=$sual->added_date?></p>
			</div>
			<?php if ($is_verify_cavab): ?>
				<div class="suallar_content">
					<?=$sual->cavablar?> <br>
					Cavab
				</div>
				<?php else: ?>
					<div style="float:left; width:15%; text-align: center; color: #38506c; font-size: 1.2em;">
						<?=$sual->cavablar?> <br>
						Cavab
					</div>
			<?php endif; ?>
		</div>
			<?php endforeach; ?>
		<?php else:
			if (isset($_COOKIE['loged_user'])):
				if (isset($user_values['login']) && isset($user_values['password'])):
				$proverka_cookie = R::findOne('users','login = ?',[$user_values['login']]);
				if ($proverka_cookie->id != 0):
				if($proverka_cookie->password == $user_values['password']):
					$ready_edit_sual_load = R::load('readysuals',$_GET['ready_edit']);
					date_default_timezone_set('Asia/baku');
					if (isset($_POST['ready_submit'])) {
						if (!isset($_GET['ready_edit'])) {
							$add_ready = R::dispense('readysuals');
							$add_ready->sual_head = htmlspecialchars($_POST['ready_sual_head']);
							$add_ready->sual_content = $_POST['ready_sual'];
							$add_ready->added_date = date('Y.m.d      G:i');
							$add_ready->added_user = $user_values['login'];
							$add_ready->cavablar = 0;
							R::store($add_ready);
							echo "
							<script>
							window.location = 'index.php?page=ready&new';
							</script>
							";
						}else {
							$ready_edit_sual_load->sual_head = htmlspecialchars($_POST['ready_sual_head']);
							$ready_edit_sual_load->sual_content = $_POST['ready_sual'];
							R::store($ready_edit_sual_load);
							echo "
							<script>
							window.location = 'index.php?page=ready&opened_sual&sual_id=".$_GET['ready_edit']."';
							</script>
							";
						}
					}
				?>
				<script src="ckeditor/ckeditor.js"></script>
				<?php if (!isset($_GET['ready_edit'])): ?>
					<p style="padding-left:4%; font-size: 2em; margin-bottom:1%;">Sual əlavə et</p>
					<form  method="post" style="text-align: center; float:left; width: 100%;">
						<input type="text" maxlength="100" class="ready_add_sual" name="ready_sual_head" placeholder="Sual basligi"><br>
						<textarea id="ck-editor-text" name="ready_sual"></textarea><br>
						<input type="submit" id="ready_add_submit" disabled name="ready_submit" value="GÖNDƏR">
					</form>
					<?php else:
						if ($ready_edit_sual_load->added_user == $user_values['login'] || $proverka_cookie->status == 'Admin'):
						?>
						<p style="padding-left:4%; font-size: 2em; margin-bottom:1%;">Sual redakte et</p>
						<form  method="post" style="text-align: center; float:left; width: 100%;">
							<input type="text" maxlength="100" class="ready_add_sual" name="ready_sual_head" value="<?=$ready_edit_sual_load->sual_head?>" placeholder="Sual basligi"><br>
							<textarea id="ck-editor-text" name="ready_sual"><?=$ready_edit_sual_load->sual_content?></textarea><br>
							<input type="submit" id="ready_add_submit" disabled name="ready_submit" value="Deyis">
						</form>
						<?php else: ?>
							<script>
							window.location = 'index.php?page=ready&new';
							</script>
				<?php
				endif;
			endif; ?>
				<p class="error"></p>
				<p class="error2"></p>
				<script>
						CKEDITOR.replace('ck-editor-text');
							setTimeout(function () {
							setInterval(function () {
								if ($('.cke_wysiwyg_frame').contents().find('p').text().length <= 20) {
									$('#ready_add_submit').attr('disabled','disabled');
									$('#ready_add_submit').css({'cursor':'not-allowed'});
									$('.error').text('Sualın uzunluğu ən azı 25 olmalıdır');
								}else if($('.cke_wysiwyg_frame').contents().find('p').text().length > 20){
									$('.error').text('');
									$('#ready_add_submit').removeAttr('disabled');
									$('#ready_add_submit').css('cursor','pointer');
								}
							if ($('.ready_add_sual').val().length <= 10) {
									$('.error2').text('Sualın uzunluğu ən azı 10 olmalıdır');
									$('#ready_add_submit').attr('disabled','disabled');
									$('#ready_add_submit').css('cursor','not-allowed');
								}else if($('.ready_add_sual').val().length > 10){
									$('.error2').text('');
									$('#ready_add_submit').removeAttr('disabled');
									$('#ready_add_submit').css('cursor','pointer');
									if ($('.cke_wysiwyg_frame').contents().find('p').text().length <= 20) {
										$('#ready_add_submit').attr('disabled','disabled');
										$('#ready_add_submit').css({'cursor':'not-allowed'});
										$('.error').text('Sualın uzunluğu ən azı 25 olmalıdır');
									}else if($('.cke_wysiwyg_frame').contents().find('p').text().length > 20){
										$('.error').text('');
										$('#ready_add_submit').removeAttr('disabled');
										$('#ready_add_submit').css('cursor','pointer');
									}
								}
							}, 1000);
						}, 1000);
						$('.ready_add_sual').change(function () {
							var readysual = $(".ready_add_sual").val();
							readysual = readysual.slice(0, 1).toUpperCase() + readysual.slice(1)
							$(".ready_add_sual").val(readysual);
						});
				</script>
				<?php else: ?>
					<script>
					function deletecookie ( cookie_name ){
							var date = new Date;
							date.setDate(date.getDate() - 5);
							document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
					}
					deletecookie('loged_user');
					window.location = 'index.php?page=ready&new';
					</script>
			<?php endif;?>
			<?php else: ?>
				<script>
				function deletecookie ( cookie_name ){
						var date = new Date;
						date.setDate(date.getDate() - 5);
						document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
				}
				deletecookie('loged_user');
				window.location = 'index.php?page=ready&new';
				</script>
		<?php endif; ?>
		<?php else: ?>
		<script>
		function deletecookie ( cookie_name ){
				var date = new Date;
				date.setDate(date.getDate() - 5);
				document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
		}
		deletecookie('loged_user');
		window.location = 'index.php?page=ready&new';
		</script>
		<?php endif; ?>
			<?php else: ?>
				<script>
					window.location = 'index.php?page=ready&new';
				</script>
		<?php endif;?>
		<?php endif; ?>
	</div>
