<script src="ckeditor_full/ckeditor.js"></script>
<?php if (isset($add)):?>
  <?php if (empty($add)):
    $adminfenn2 = $adminfenn;
    if ($adminsinif == 'az5' || $adminsinif == 'az6' || $adminsinif == 'az7' || $adminsinif == 'az8' || $adminsinif == 'az9') {
      $bukvi1 = ['ə','ç','ş','ü','ö','ğ','ı'];
      $bukvi2 = ['ew','cw','sw','uw','ow','gw','iw'];
      $adminfenn = str_replace($bukvi1,$bukvi2,$adminfenn);
    }else {
      $bukvi1 = [' ','ы','ъ','ь','е','ё','ю','я','э','й','ц','у','к','н','г','ш','щ','з','х','ф','в','а','п','р','о','л','д','ж','ч','с','м','и','т','б'];
      $bukvi2 = ['','wi','wt','wm','we','wo','wu','wa','e','y','c','u','k','n','q','sh','hs','z','x','f','v','a','p','r','o','l','d','j','ch','s','m','i','t','b'];
      $adminfenn = str_replace($bukvi1,$bukvi2,$adminfenn);
    }
    $adminfennreplaced = str_replace(' ','',trim($adminfenn));
    if (isset($_POST['submit'])){
      $adminforconnecting = $adminsinif.mb_strtolower($adminfennreplaced);
      $adminpostpage = 'pages = '.$_POST['Sehife'];
      $adminifissetpage = R::find($adminforconnecting.'pages',$adminpostpage);
      if (empty($adminifissetpage)) {
        $adminaddpage = R::dispense($adminforconnecting.'pages');
        $adminaddpage->pages = $_POST['Sehife'];
        R::store($adminaddpage);
      }
      $imageputh = 'cavablar/'.$adminsinif.'/'.mb_strtolower($adminfenn2).'/'.$_POST['Sehife'].'/'.$_POST['tapsiriqnomresi'].'.png';
      $adminaddingcavab = R::dispense($adminforconnecting);
      if ($_FILES['sekil']['error'] == 0) {
        $adminaddingcavab->pages = $_POST['Sehife'];
        $adminaddingcavab->number = $_POST['tapsiriqnomresi'];
        $adminaddingcavab->image = $imageputh;
        $adminaddingcavab->text = $_POST['text'];
      }else {
        $adminaddingcavab->pages = $_POST['Sehife'];
        $adminaddingcavab->number = $_POST['tapsiriqnomresi'];
        $adminaddingcavab->text = $_POST['text'];
      }
      R::store($adminaddingcavab);
      require 'templates/makedir.php';
    }
    ?>
    <div id="admincontent">
      <form method="post"  enctype="multipart/form-data">
         <input type="text" name="Sehife" placeholder="Səhifə" required autofocus>
         <br>
         <input type="text"  style="margin-bottom:2%;" name="tapsiriqnomresi" placeholder="Tapşırıq nömrəsi" required><br>
          <input type="file" name="sekil" id="sekil">
          <textarea id="ck-editor-text" name="text"></textarea>
         <label for="sekil">
           Şəkil Yüklə
         </label>
         <input type="submit" name="submit" value="Göndər">
      </form>
    </div>
				<script>CKEDITOR.replace('ck-editor-text');</script>
			<?php else: ?>
      <?php
      $adminfenn2 = $adminfenn;
      if ($adminsinif == 'az5' || $adminsinif == 'az6' || $adminsinif == 'az7' || $adminsinif == 'az8' || $adminsinif == 'az9') {
								$bukvi1 = [' ','ə','ç','ş','ü','ö','ğ','ı'];
        $bukvi2 = ['','ew','cw','sw','uw','ow','gw','iw'];
        $adminfennreplaced = str_replace($bukvi1,$bukvi2,trim($adminfenn));
      }else {
        $bukvi1 = [' ','ы','ъ','ь','е','ё','ю','я','э','й','ц','у','к','н','г','ш','щ','з','х','ф','в','а','п','р','о','л','д','ж','ч','с','м','и','т','б'];
        $bukvi2 = ['','wi','wt','wm','we','wo','wu','wa','e','y','c','u','k','n','q','sh','hs','z','x','f','v','a','p','r','o','l','d','j','ch','s','m','i','t','b'];
        $adminfennreplaced = str_replace($bukvi1,$bukvi2,trim($adminfenn));
      }
      if (isset($_POST['submit'])){
        $adminforconnecting = $adminsinif.mb_strtolower($adminfennreplaced);
        $imageputh = 'cavablar/'.$adminsinif.'/'.mb_strtolower($adminfenn2).'/'.$_POST['Sehife'].'/'.$_POST['tapsiriqnomresi'].'.png';
								echo $adminforconnecting;
								$adminaddingcavab = R::dispense($adminforconnecting);
        if ($_FILES['sekil']['error'] == 0) {
          $adminaddingcavab->pages = $_POST['Sehife'];
          $adminaddingcavab->number = $_POST['tapsiriqnomresi'];
          $adminaddingcavab->image = $imageputh;
          $adminaddingcavab->text = $_POST['text'];
        }else {
          $adminaddingcavab->pages = $_POST['Sehife'];
          $adminaddingcavab->number = $_POST['tapsiriqnomresi'];
          $adminaddingcavab->text = $_POST['text'];
        }
        R::store($adminaddingcavab);
        require 'templates/makedir.php';
      }
       ?>
      <div id="admincontent">
        <form method="post"  enctype="multipart/form-data">
           <input type="text" name="Sehife" placeholder="Səhifə" readonly required value="<?=$add?>">
           <br>
           <input type="text" style="margin-bottom:2%;" name="tapsiriqnomresi" placeholder="Tapşırıq nömrəsi" required autofocus><br>
             <input type="file" name="sekil" id="sekil" >
             <textarea id="ck-editor-text" name="text"></textarea>
           <label for="sekil">
             Şəkil Yüklə
           </label>
           <input type="submit" name="submit" value="Göndər">
        </form>
      </div>
						<script>CKEDITOR.replace('ck-editor-text');</script>
  <?php endif; ?>
<?php elseif(isset($edit)):?>
  <?php
  $adminfenn2 = $adminfenn;
  if ($adminsinif == 'az5' || $adminsinif == 'az6' || $adminsinif == 'az7' || $adminsinif == 'az8' || $adminsinif == 'az9') {
    $bukvi1 = ['ə','ç','ş','ü','ö','ğ','ı'];
    $bukvi2 = ['ew','cw','sw','uw','ow','gw','iw'];
    $adminfenn = str_replace($bukvi1,$bukvi2,$adminfenn);
  }else {
    $bukvi1 = [' ','ы','ъ','ь','е','ё','ю','я','э','й','ц','у','к','н','г','ш','щ','з','х','ф','в','а','п','р','о','л','д','ж','ч','с','м','и','т','б'];
    $bukvi2 = ['','wi','wt','wm','we','wo','wu','wa','e','y','c','u','k','n','q','sh','hs','z','x','f','v','a','p','r','o','l','d','j','ch','s','m','i','t','b'];
    $adminfenn = str_replace($bukvi1,$bukvi2,$adminfenn);
  }
  $adminfennreplaced = str_replace(' ','',trim($adminfenn));
  $adminforconnecting = $adminsinif.mb_strtolower($adminfennreplaced);
  $adminedit = R::find($adminforconnecting,'id= '.$editid);
  foreach ($adminedit as $texts) {
    $text = $texts->text;
  }
    if (isset($_POST['submit'])) :
      $adminfennreplaced = str_replace(' ','',trim($adminfenn));
      $imageputh = 'cavablar/'.$adminsinif.'/'.mb_strtolower($adminfenn2).'/'.$_POST['Sehife'].'/'.$_POST['tapsiriqnomresi'].'.png';
						$adminedittext = R::load($adminforconnecting,$editid);
      $adminedittext->text = $_POST['text'];
      if ($_FILES['sekil']['error'] == 0) {
							$adminedittext->image = $imageputh;
							require 'templates/makedir.php';
        if (file_exists($imageputh)) {
          unlink($imageputh);
          copy($_FILES['sekil']['tmp_name'],$imageputh);
        }else {
          copy($_FILES['sekil']['tmp_name'],$imageputh);
        }
      }
						R::store($adminedittext);
   ?>
   <script>
   window.location = 'index.php?page=adminalfa&adminsinif=<?=$adminsinif;?>&adminfenn=<?=$adminfenn2;?>';
   </script>
 <?php endif; ?>
  <div id="admincontent">
    <form method="post"  enctype="multipart/form-data">
       <input type="text" name="Sehife" placeholder="Səhifə" readonly value="<?=$admineditpage;?>">
       <br>
       <input type="text" style="margin-bottom:2%;" name="tapsiriqnomresi" readonly  placeholder="Tapşırıq nömrəsi" value="<?=$admineditnumber;?>"><br>
         <input type="file" name="sekil" id="sekil">
         <textarea id="ck-editor-text" name="text"><?=$text;?></textarea>
       <label for="sekil">
         Şəkli Dəyiş
       </label>
       <input type="submit" name="submit" value="Göndər">
    </form>
  </div>
		<script>CKEDITOR.replace('ck-editor-text');</script>
<?php elseif(isset($remove)):?>
  <div id="admincontent">
    <form method="post">
      <input type="submit" name="Silmek" value="Sildiyinize emin olun">
    </form>
  </div>
  <?php
  $adminfenn2 = $adminfenn;
  if ($adminsinif == 'az5' || $adminsinif == 'az6' || $adminsinif == 'az7' || $adminsinif == 'az8' || $adminsinif == 'az9') {
    $bukvi1 = ['ə','ç','ş','ü','ö','ğ','ı'];
    $bukvi2 = ['ew','cw','sw','uw','ow','gw','iw'];
    $adminfenn = str_replace($bukvi1,$bukvi2,$adminfenn);
  }else {
    $bukvi1 = [' ','ы','ъ','ь','е','ё','ю','я','э','й','ц','у','к','н','г','ш','щ','з','х','ф','в','а','п','р','о','л','д','ж','ч','с','м','и','т','б'];
    $bukvi2 = ['','wi','wt','wm','we','wo','wu','wa','e','y','c','u','k','n','q','sh','hs','z','x','f','v','a','p','r','o','l','d','j','ch','s','m','i','t','b'];
    $adminfenn = str_replace($bukvi1,$bukvi2,$adminfenn);
  }
  $adminfennreplaced = str_replace(' ','',trim($adminfenn));
  if (isset($_POST['Silmek'])):
    $adminforconnecting = $adminsinif.mb_strtolower($adminfennreplaced);
    $adminremovecavab = R::load($adminforconnecting,$removeid);
    R::trash($adminremovecavab);
    unlink($adminremovecavab->image);
   ?>
  <script>
    window.location='index.php?page=adminalfa&<?='adminsinif='.$adminsinif.'&adminfenn='.$adminfenn2;?>';
  </script>
<?php endif; ?>
<?php endif; ?>
