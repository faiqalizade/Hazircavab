<?php
#buarada COOKIE varsa silirik yoxdursa giris sehifesine veririk
if (isset($_COOKIE['loged_user'])) {
	setcookie('loged_user','',0,'/');
	header('Location: '.$_SERVER['HTTP_REFERER']);
}else {
	if(isset($_COOKIE['loged_admin_verify'])){
	  setcookie('loged_admin_verify','');
	  setcookie('loged_admin_id','');
	  setcookie('loged_admin_name','');
	  header('Location: index.php?page=adminalfa');
	}else {
		header('Location: index.php?page=adminalfa');
	}
}
?>
