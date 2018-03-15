<?php
#burada Get den asli olaraq hal hazirda $page yeni sehifeni yoxlayiqiq ona gore fayl aciriq
if (!isset($page)){
  require 'templates/sidebar.php';
  require 'templates/main.php';
		require 'templates/userlogin.php';
}elseif ($page == 'services') {
  require 'templates/sidebar.php';
  if (isset($service)) {
    if ($service == 'ebob') {
      require 'templates/ebob.php';
    }elseif ($service == 'ekob') {
      require 'templates/ekob.php';
    }elseif ($service == 'altaltavurma') {
      require 'templates/altalta.php';
    }elseif ($service == 'cubuqlubolme') {
      require 'templates/cubuqlubolme.php';
    }
    }else{
    require 'templates/services.php';
  }
		require 'templates/userlogin.php';
}elseif ($page == 'imtahan') {
  if (isset($imtahan)) {
    require 'templates/imtahan.php';
  }else {
    require 'templates/imtahanlar.php';
  }
}elseif ($page == 'adminalfa') {
    require 'templates/adminlogin.php';
}elseif ($page == 'logout') {
  require_once 'templates/logout.php';
}elseif ($page == 'openedsinif'){
  require 'templates/sidebar.php';
  if (!isset($openedfenn)) {
    require 'templates/sinif.php';
  }else {
    if (!isset($openedsehife)) {
      require 'templates/openedfenn.php';
    }else {
      if (!isset($openednumber)) {
        require 'templates/openedsehife.php';
      }else {
          require 'templates/openednumber.php';
      }
    }
  }
		require 'templates/userlogin.php';
}elseif ($page == 'contact') {
  require 'templates/contact.php';
}elseif ($page == 'copy') {
  require 'templates/copy.php';
}elseif ($page == 'ready') {
	if (!isset($_GET['opened_sual'])){
		require 'templates/ready.php';
	}else {
		require 'templates/ready_opened_sual.php';
	}
	require 'templates/userlogin.php';
	echo "
	<script>
		if ($(window).width() > 760) {
			$('.qeydiyyat_div').css({'display':'none'});

		}
		$(window).resize(function () {
			if ($(window).width() > 760) {
				$('.qeydiyyat_div').css({'display':'none'});
			}
		});
	</script>
	";
}elseif ($page == 'profile') {
	require 'templates/ready_opened_profile.php';
	require 'templates/userlogin.php';
	echo "
	<script>
		if ($(window).width() > 760) {
			$('.qeydiyyat_div').css({'display':'none'});

		}
		$(window).resize(function () {
			if ($(window).width() > 760) {
				$('.qeydiyyat_div').css({'display':'none'});
			}
		});
	</script>
	";
}
 ?>
