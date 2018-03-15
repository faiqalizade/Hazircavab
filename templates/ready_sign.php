<?php
$user_verify = R::findOne('users','login = ?',[$user_values['login']]);
if ($user_verify->status == 'Lider'){
	$color = '#f0ce1d';
}elseif ($user_verify->status == 'Orta') {
	$color = '#e6b46a';
}elseif ($user_verify->status == 'Böyük') {
	$color = '#21d042';
}elseif ($user_verify->status == 'Zəif') {
	$color = '#e83030';
}elseif ($user_verify->status == 'Admin') {
	$color = '#000a8f';
}
?>
<?php if (isset($_COOKIE['loged_user'])): ?>
	<div id="ready_user">
		<div class="client">
			<img id="userimg" src="images/user.png" alt="">
				<p class="clientname client_values"><a href="index.php?page=profile&profile_id=<?=$user_verify->id;?>" style="color:#d9eafb;"><?=$user_values['name'];?> <?=$user_values['surname'];?></a></p>
				<p style="color:white;" class="client_login">@<?=$user_values['login'];?></p>
				<p style="color:white;" class="client_status">Status: <span style="color:<?=$color?>">&nbsp;<?=$user_verify->status;?></span></p>
				<div style="margin-top: 5%;">
					<p><a class="user_lists" href="index.php?page=ready&notification">Bildirimler<span style="width:17%;float:right;background-color:#af1616; text-align:center;">+99</span></a></p>
				</div>
				<a class="client_exit" href="index.php?page=logout">Çıxış</a>
			</div>
	</div>
	<?php else: ?>
		<div id="ready_user">
			<p style="font-size:1.3em;" class="h1copy">GİRİŞ</p>
			<form method="post">
				<input class="giris_input" type="text" required name="login_login" placeholder="Login">
				<input class="giris_input" type="password" required name="login_password" placeholder="Şifrə"><br>
				<input id="button" type="submit" name="login_submit" value="GİRİŞ">

				<button id="button22" type="button" name="button">QEYDİYYAT</button>
			</form>
			<br>
			<p style="color: red; text-align:center;"><?=$login_error;?></p>
		</div>
		<div class="ready_qeydiyyat_wrapper">
			<div class="ready_qeydiyyat">
				<img class="ready_qeydiyyat_exit" src="images/x-button.png">
				<p class="qeydiyyat_text">Qeydiyyat</p>
				<form class="qeydiyyat_form" method="post">
					<input class="qeydiyyat_input" type="text" name="reg_name" required placeholder="Ad"><br>
					<input class="qeydiyyat_input" type="text" name="reg_surname" required placeholder="Soyad"><br>
					<input class="qeydiyyat_input ready_reg_login" type="text" name="reg_login" required placeholder="Login"><br>
					<input class="qeydiyyat_input ready_reg_password" type="password" name="reg_password" required placeholder="Şifrə"><br>
					<input class="qeydiyyat_input ready_reg_password_verify" type="password" name="ready_reg_password_verify" required placeholder="Şifrəni təsdiqlə"><br>
					<input type="submit" name="reg_submit" value="Qeydiyyatdan keç" id="ready_qeydiyyat_button">
				</form>
				<br>
				<p id="ready_yoxlama"></p>
				<p id="ready_yoxlama2"></p>
			</div>
		</div>
		<script>
		$("#button22").bind("click",function () {
			$(".ready_qeydiyyat_wrapper").css({'display':'flex'});
			$(".ready_qeydiyyat").show(800);
			});
		$(".ready_qeydiyyat_exit").click(function () {
			$(".ready_qeydiyyat").hide(800);
			setTimeout(function () {
				$(".ready_qeydiyyat_wrapper").css({'display':'none'});
			}, 700);
		});
		$(document).click(function (event) {
			if (event.target.className == 'ready_qeydiyyat_wrapper') {
				$(".ready_qeydiyyat").hide(800);
				setTimeout(function () {
					$(".ready_qeydiyyat_wrapper").css({'display':'none'});
				}, 700);
		}
		});
		$('.ready_reg_login').change(function () {
			$(".ready_reg_login").val($(".ready_reg_login").val().toLowerCase());
		});
		$('.ready_reg_login').on('keyup',function(){
			var ready_reg_login = $(".ready_reg_login").val();
				if (ready_reg_login != "") {
					for (var i = 0; i < ready_reg_login.length; i++) {
						if (ready_reg_login[i] == ' ') {
							$(".ready_reg_login").val(ready_reg_login.replace(' ','_'));
						}
					}if ($(".ready_reg_login").val().length < 6) {
						$(".ready_reg_password").attr('disabled','disabled');
						$('#ready_yoxlama2').text('Loginin uzunluğu ən azı 6 olmalıdır');
						$('#ready_yoxlama').text('');
						$('#ready_qeydiyyat_button').attr('disabled','disabled');
						$('#ready_qeydiyyat_button').css({"cursor" : "not-allowed"});
					}else {
						$(".ready_reg_password").removeAttr('disabled');
						verify = true;
						$('#ready_yoxlama2').text('');
						$('#ready_qeydiyyat_button').removeAttr('disabled');
						$('#ready_qeydiyyat_button').css({"cursor" : "pointer"});
					}
				}
			});

		$('.ready_reg_password').on('keyup',function(){
			if ($(this).val() != $('.ready_reg_password_verify').val()) {
				$('#ready_yoxlama').text('Parollar eyni deyil');
				$('#ready_qeydiyyat_button').attr('disabled','disabled');
				$('#ready_qeydiyyat_button').css({"cursor" : "not-allowed"});
			}else {
				$('#ready_yoxlama').text('');
				$('#ready_qeydiyyat_button').removeAttr('disabled');
				$('#ready_qeydiyyat_button').css({"cursor" : "pointer"});
			}
			if ($(this).val().length < 5) {
				$(".ready_reg_password_verify").attr('disabled','disabled');
					$('#ready_yoxlama2').text('Parolun uzunluğu ən azı 6 olmalıdır');
					$('#yoxlama').text('');
					$('#ready_qeydiyyat_button').attr('disabled','disabled');
					$('#ready_qeydiyyat_button').css({"cursor" : "not-allowed"});
				}else {
					$(".ready_reg_password_verify").removeAttr('disabled');
					$('#ready_yoxlama2').text('');
					$('#ready_qeydiyyat_button').removeAttr('disabled');
					$('#ready_qeydiyyat_button').css({"cursor" : "pointer"});
				}
		});

		$('.ready_reg_password_verify').on('keyup',function(){
			if ($(this).val() != $('.ready_reg_password').val()) {
				$('#ready_yoxlama').text('Parollar eyni deyil');
				$('#ready_qeydiyyat_button').attr('disabled','disabled');
				$('#ready_qeydiyyat_button').css({"cursor" : "not-allowed"});
			}else {
				$('#ready_yoxlama').text('');
				$('#ready_qeydiyyat_button').removeAttr('disabled');
				$('#ready_qeydiyyat_button').css({"cursor" : "pointer"});
			}
		});
		</script>
<?php endif; ?>
