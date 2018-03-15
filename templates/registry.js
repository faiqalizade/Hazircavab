$(document).ready (function () {
	// Giris Input focus
	$(".giris_input").focus(function () {
		$(this).css({"border-bottom" : "#2c3e50 2px solid"});});
	$(".giris_input").blur(function () {
		$(this).css({"border-bottom" : "#e8d314 2px solid"});
	});
	// Qeydiyyat
	$(".qeydiyyat_button_ready").bind("click",function () {
		$(".qeydiyyat_wrapper").css({'display':'flex'});
		$(".qeydiyyat").show(800);
		});
	$(".qeydiyyat_exit").click(function () {
		$(".qeydiyyat").hide(800);
		setTimeout(function () {
			$(".qeydiyyat_wrapper").css({'display':'none'});
		}, 700);
	});
	$(document).click(function (event) {
		if (event.target.className == 'qeydiyyat_wrapper') {
			$(".qeydiyyat").hide(800);
			setTimeout(function () {
				$(".qeydiyyat_wrapper").css({'display':'none'});
			}, 700);
	}
});
	$('.reg_login').change(function () {
		$(".reg_login").val($(".reg_login").val().toLowerCase());
	});
	$('.reg_login').on('keyup',function(){
		var reg_login = $(".reg_login").val();
			if (reg_login != "") {
				for (var i = 0; i < reg_login.length; i++) {
					if (reg_login[i] == ' ') {
						$(".reg_login").val(reg_login.replace(' ','_'));
					}
				}if ($(".reg_login").val().length < 6) {
					$(".reg_password").attr('disabled','disabled');
					$('#yoxlama2').text('Loginin uzunluğu ən azı 6 olmalıdır');
					$('#yoxlama').text('');
					$('#qeydiyyat_button').attr('disabled','disabled');
					$('#qeydiyyat_button').css({"cursor" : "not-allowed"});
				}else {
					$(".reg_password").removeAttr('disabled');
					verify = true;
					$('#yoxlama2').text('');
					$('#qeydiyyat_button').removeAttr('disabled');
					$('#qeydiyyat_button').css({"cursor" : "pointer"});
				}
			}
		});

	$('.reg_password').on('keyup',function(){
		if ($('.reg_password').val() != $('.reg_password_verify').val()) {
			$('#yoxlama').text('Parollar eyni deyil');
			$('#qeydiyyat_button').attr('disabled','disabled');
			$('#qeydiyyat_button').css({"cursor" : "not-allowed"});
		}else {
			$('#yoxlama').text('');
			$('#qeydiyyat_button').removeAttr('disabled');
			$('#qeydiyyat_button').css({"cursor" : "pointer"});
		}
		if ($(".reg_password").val().length < 6) {
			$(".reg_password_verify").attr('disabled','disabled');
				$('#yoxlama2').text('Parolun uzunluğu ən azı 6 olmalıdır');
				$('#yoxlama').text('');
				$('#qeydiyyat_button').attr('disabled','disabled');
				$('#qeydiyyat_button').css({"cursor" : "not-allowed"});
			}else {
				$(".reg_password_verify").removeAttr('disabled');
				$('#yoxlama2').text('');
				$('#qeydiyyat_button').removeAttr('disabled');
				$('#qeydiyyat_button').css({"cursor" : "pointer"});
			}
	});
	$('.reg_password_verify').on('keyup',function(){
		if ($('.reg_password_verify').val() != $('.reg_password').val()) {
			$('#yoxlama').text('Parollar eyni deyil');
			$('#qeydiyyat_button').attr('disabled','disabled');
			$('#qeydiyyat_button').css({"cursor" : "not-allowed"});
		}else {
			$('#yoxlama').text('');
			$('#qeydiyyat_button').removeAttr('disabled');
			$('#qeydiyyat_button').css({"cursor" : "pointer"});
		}
	});
});
