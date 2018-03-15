<?php if (!isset($_COOKIE['loged_user'])): ?>
	<div class="qeydiyyat_div">
			<p style="font-size:1.3em" class="h1copy"><!-- GİRİŞ -->Вход</p>
			<form method="post">
				<input class="giris_input" type="text" required name="login_login" placeholder="Логин">
				<input class="giris_input" type="password" required name="login_password" placeholder="Пароль"><br>
				<input style="position:absolute;left:-111px;" id="salam" type="submit" name="login_submit" value="GİRİŞ">
				<label id="button" style="padding-top:2.9%;padding-bottom: 3.1%;width:10%;font-size:0.71em;" for="salam"><!-- Giriş -->Вход</label>
				<button id="button" class="qeydiyyat_button_ready" type="button" name="button"><!-- QEYDİYYAT -->Регистрация</button>
			</form>
			<br>
			<p style="color: red;"><?=$login_error;?></p>
			<br>
			<p style="cursor:pointer" class="exit_giris"></p>
	</div>
	<div class="qeydiyyat_wrapper">
		<div class="qeydiyyat">
			<img class="qeydiyyat_exit" src="images/x-button.png">
			<p class="qeydiyyat_text"><!-- Qeydiyyat -->Регистрация</p>
			<form class="qeydiyyat_form" method="post">
				<input class="qeydiyyat_input" type="text" name="reg_name" required placeholder="Имя"><br>
				<input class="qeydiyyat_input" type="text" name="reg_surname" required placeholder="Фамилия"><br>
				<input class="qeydiyyat_input reg_login" type="text" name="reg_login" required placeholder="Логин"><br>
				<input class="qeydiyyat_input reg_password" type="password" name="reg_password" required placeholder="Пароль"><br>
				<input class="qeydiyyat_input reg_password_verify" type="password" name="reg_password_verify" required placeholder="Повтор пароли"><br>
				<input type="submit" name="reg_submit" value="Регистрация" id="qeydiyyat_button">
			</form>
			<br>
			<p id="yoxlama"></p>
			<p id="yoxlama2"></p>
			<p id="yoxlama3"></p>
		</div>
	</div>
	<script src="templates/registry.js"></script>
	<?php else:
		$user_values = unserialize($_COOKIE['loged_user']);
		$user_verify = R::findOne('users','login = ?',[$user_values['login']]);
		if ($user_verify->status == 'Lider') {
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
		if ($user_verify->password == $user_values['password']):
		 ?>
			<div class="qeydiyyat_div" style="position:relative;">
					<div class="client">
						<img width="13%" src="images/login.png" alt="">
						<div>
							<p class="clientname"><?=$user_values['name'];?> <?=$user_values['surname'];?></p>
							<p class="client_login">@<?=$user_values['login'];?></p>
							<p class="client_status">Статус: <span style="color:<?=$color?>"> <?=$user_verify->status;?></span></p>
						</div>
					</div>
						<p class="client_logout_p"><a class="client_logout" href="index.php?page=logout"><!-- Çıxış -->Выход</a><p>
						<p style="cursor:pointer" class="exit_giris"></p>
				</div>
			<?php else: ?>
				<script>
				function setcookie ( name, value, path, exp_y, exp_m, exp_d, exp_h , exp_m , domain, secure ){
						var cookie_string = name + "=" + escape ( value );

						if ( exp_y )
						{
								var expires = new Date ( exp_y, exp_m, exp_d, exp_h , exp_m );
								cookie_string += "; expires=" + expires.toGMTString();
						}

						if ( path )
												cookie_string += "; path=" + escape ( path );

						if ( domain )
												cookie_string += "; domain=" + escape ( domain );

						if ( secure )
												cookie_string += "; secure";

						document.cookie = cookie_string;
				}
				function deletecookie ( cookie_name ){
						var date = new Date;
						date.setDate(date.getDate() - 5);
						document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
				}
				function getcookie ( cookie_name ){
						var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );

						if ( results )
								return ( unescape ( results[2] ) );
						else
								return null;
				}
				deletecookie('loged_user');
					window.location = 'index.php';
				</script>
		<?php endif; ?>
<?php endif; ?>
<div id="mix_block_1294867889"></div>
