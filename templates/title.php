<?php
if (isset($page)) {
  if ($page == 'contact') {
    $title = 'Əlaqə';
  }elseif ($page == 'ready') {
			$title = 'Ready';
  }elseif ($page == 'profile') {
			$user_for_title = R::find('users','id = '.$_GET['profile_id']);
			foreach ($user_for_title as $get_user){
				$title = $get_user->name.' '.$get_user->surname.' (@'.$get_user->login.')';
			}
  }elseif ($page == 'copy') {
    $title = 'Bütün Hüqüqlar Qorunur';
  }elseif ($page == 'services') {
    if ($service == 'ebob') {
      $title = 'ƏBOB/НОД';
    }elseif ($service == 'ekob') {
      $title = 'ƏKOB/НОK';
    }elseif ($service == 'altaltavurma') {
      $title = 'Alt alta vurma / Умножение столбиком';
    }elseif ($service == 'cubuqlubolme') {
      $title = 'Çubuqlu Bölmə / Деление столбиком';
    }
    else {
      $title = 'Сервисы / Servislər';
    }
  }elseif ($page == 'openedsinif') {
    if ($sinif == 'az5') {
      $openedaz5 = 'sinif';
      $title = '5-ci sinif Azərbaycan sektoru';
    }elseif ($sinif == 'az6') {
      $openedaz6 = 'sinif';
      $title = '6-cı sinif Azərbaycan sektoru';
    }elseif ($sinif == 'az7') {
      $openedaz7 = 'sinif';
      $title = '7-ci sinif Azərbaycan sektoru';
    }elseif ($sinif == 'az8') {
      $openedaz8 = 'sinif';
      $title = '8-ci sinif Azərbaycan sektoru';
    }elseif ($sinif == 'az9') {
      $openedaz9 = 'sinif';
      $title = '9-cu sinif Azərbaycan sektoru';
    }elseif ($sinif == 'ru5') {
      $openedru5 = 'sinif';
      $title = '5-ый класс Русский сектор';
    }elseif ($sinif == 'ru6') {
      $openedru6 = 'sinif';
      $title = '6-ой класс Русский сектор';
    }elseif ($sinif == 'ru7') {
      $openedru7 = 'sinif';
      $title = '7-ой класс Русский сектор';
    }elseif ($sinif == 'ru8') {
      $openedru8 = 'sinif';
      $title = '8-ой класс Русский сектор';
    }elseif ($sinif == 'ru9') {
      $openedru9 = 'sinif';
      $title = '9-ый класс Русский сектор';
    }
  }elseif ($page == 'imtahan') {
    $title = 'İmtahanlar / Тесты';
  }elseif ($page == 'ready') {
			$title = 'Ready';
  }elseif ($page == 'adminalfa') {
    $sing = $_POST;
    if (isset($sing['knopka'])) {
      #burada hemin login axtaririq
      $admin = R::findOne('admin', 'login = ?', [$sing['login']]);
      #eger varsa hemin login parolu yoxlayiriq
      if($admin){
        if (password_verify($sing['password'], $admin->password)) {
          #parolu yoxladiq duzdurse COOKIE yaradiriq
          setcookie('loged_admin_name',$admin->name, time() + 86400);
          setcookie('loged_admin_id',$admin->id, time() + 86400);
          setcookie('loged_admin_verify',$admin->password, time() + 86400);
          header('Location: index.php?page=adminalfa');
        } else {
          $errors = "Login ve yaxud parol sehvdir";
        }
      } else {
        $errors = "Login ve yaxud parol sehvdir";
      }
    }
  }elseif ($page == 'logout') {
    require_once 'logout.php';
  }
}

	if (isset($_POST['login_submit'])) {
		$login_search = R::findOne('users','login = ?',[htmlspecialchars($_POST['login_login'])]);
		if (isset($login_search)) {
			if (password_verify($_POST['login_password'],$login_search->password)) {
				$user_values = [
					'name'=>$login_search->name,
					'surname'=>$login_search->surname,
					'login'=>$login_search->login,
					'password'=>$login_search->password
				];
				setcookie('loged_user',serialize($user_values),time() + 604800,'/');
				echo "<script>window.location= '';</script>";
			}else {
				$login_error = 'Login və yaxud parol səhvdir';
			}
		}else {
			$login_error = 'Login və yaxud parol səhvdir';
		}
	}elseif (isset($_POST['reg_submit'])) {
		$searchlogin = R::findOne('users','login = ?',[$_POST['reg_login']]);
		if (empty($searchlogin)){
			$registry = R::dispense('users');
			$registry->name = htmlspecialchars($_POST['reg_name']);
			$registry->surname = htmlspecialchars($_POST['reg_surname']);
			$registry->status = 'Zəif';
			$registry->login = htmlspecialchars($_POST['reg_login']);
			$registry->password = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);
			R::store($registry);
			$registered = true;
		}else {
			$registered = false;
		}
	}
 ?>
