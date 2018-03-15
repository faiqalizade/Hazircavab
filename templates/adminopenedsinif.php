<?php if (isset($addfenn)):
  #burada yoxlayir addfenn(fennin elave edilmesi) var ya yox yoxdursa yoxlayir edit dir ya remove
  ?>
  <?php
  if (isset($_POST['submit'])):
    $kitabname2 = trim($_POST['kitabname']);
    $fennimageputh = 'cavablar/'.$adminsinif.'/'.mb_strtolower($kitabname2).'.png';
    $adminaddingfenn = R::dispense($adminsinif);
    $adminaddingfenn->name = mb_strtolower($kitabname2);
    $adminaddingfenn->image = $fennimageputh;
    R::store($adminaddingfenn);
    #burada yoxlayiriq eger papka varsa ora sekli atir yoxdursa o adda papka yaradib sekli ora atir
    if (is_dir('cavablar/'.$adminsinif)) {
      copy($_FILES['kitabimage']['tmp_name'],$fennimageputh);
    }else {
      mkdir('cavablar/'.$adminsinif);
      copy($_FILES['kitabimage']['tmp_name'],$fennimageputh);
    }
   ?>
   <script>
     window.location = 'index.php?page=adminalfa&adminsinif=<?=$adminsinif;?>&adminfenn=<?=mb_strtolower($kitabname2);?>'
   </script>
 <?php endif; ?>
  <div id="admincontent">
    <p>Fenn'in elave edilmesi</p>
    <form method="post"  enctype="multipart/form-data">
       <input type="text" name="kitabname" placeholder="Fennin Adi" required autofocus>
       <br>
         <input type="file" name="kitabimage" id="sekil" required>
       <label for="sekil">
         Kitab Sekli
       </label>
       <input type="submit" name="submit" value="Elave Et">
    </form>
  </div>
<?php elseif(isset($editfenn)):
  #eger editfenn varsa (fennin redakte edilmesi) ona gore script
   ?>
  <?php
  if (isset($_POST['submit'])) {
    $kitabname2 = trim($_POST['kitabname']);
    $fennimageputh = 'cavablar/'.$adminsinif.'/'.mb_strtolower($kitabname2).'.png';
    if (file_exists($fennimageputh)) {
      #burda yuklenen seklin olub olmadigini yoxlayiriq varsa pozub yerine yuklenen sekli atiriq
      unlink($fennimageputh);
      copy($_FILES['kitabimage']['tmp_name'],$fennimageputh);
    }else {
      copy($_FILES['kitabimage']['tmp_name'],$fennimageputh);
    }
  }
   ?>
  <div id="admincontent">
    <p>Fenn'in redakt edilmesi</p>
    <form method="post"  enctype="multipart/form-data">
       <input type="text" name="kitabname" placeholder="Fennin Adi" required autofocus>
       <br>
         <input type="file" name="kitabimage" id="sekil" required>
       <label for="sekil">
         Kitab Sekli
       </label>
       <input type="submit" name="submit" value="Kitabi Seklin deyis">
    </form>
  </div>
<?php elseif(isset($removefenn)):?>
  <?php
  #burda yoxlayiriq removefenn var ya yox (fennin silmesi) ver varsa bazdan o fenne aid olan herseyi pozuruq ve ona aid papkani pozuruq(geri donmez)
  if (isset($_POST['submit'])):
    $kitabname2 = trim($_POST['kitabname']);
    $adminfenndeleterm = mb_strtolower($kitabname2);
    $adminfenndelete = $adminfenndeleterm;
    if ($adminsinif == 'az5' || $adminsinif == 'az6' || $adminsinif == 'az7' || $adminsinif == 'az8' || $adminsinif == 'az9') {
      $bukvi1 = [' ','ə','ç','ş','ü','ö','ğ','ı'];
      $bukvi2 = ['','ew','cw','sw','uw','ow','gw','iw'];
      $adminfenndelete = str_replace($bukvi1,$bukvi2,$adminfenndelete);
    }else {
      $bukvi1 = [' ','ы','ъ','ь','е','ё','ю','я','э','й','ц','у','к','н','г','ш','щ','з','х','ф','в','а','п','р','о','л','д','ж','ч','с','м','и','т','б'];
      $bukvi2 = ['','wi','wt','wm','we','wo','wu','wa','e','y','c','u','k','n','q','sh','hs','z','x','f','v','a','p','r','o','l','d','j','ch','s','m','i','t','b'];
      $adminfenndelete = str_replace($bukvi1,$bukvi2,$adminfenndelete);
    }
    $removedir = 'cavablar/'.$adminsinif.'/'.mb_strtolower($kitabname2);
    $admindeletetable = $adminsinif.$adminfenndelete;
    $adminremovefenn = R::findOne($adminsinif,'name = ?',[mb_strtolower($kitabname2)]);
    R::trash($adminremovefenn);
    R::wipe($admindeletetable.'pages');
    R::wipe($admindeletetable);
    exec(sprintf("rm -rf %s", escapeshellarg($removedir)));
    unlink($removedir.'.png');
   ?>
   <script>
     window.location = 'index.php?page=adminalfa';
   </script>
 <?php endif; ?>
  <div id="admincontent">
    <p>Fenn'in silinmesi</p>
    <form method="post"  enctype="multipart/form-data">
       <input type="text" name="kitabname" placeholder="Fennin Adi" required autofocus>
       <br>
       <?php echo $admindeletetable; ?>
       <input type="submit" name="submit" value="Remove">
    </form>
  </div>
<?php else:
  #eger ne addfen,removefenn,editfenn yoxdursa yene yoxlayiriq cavabin add,edit,remove edilmesi varsa addeditremove php aciriq yoxursa butun table aciriq fenn sehifeye gore
   ?>
  <?php if ((!isset($add)) && (!isset($edit)) && (!isset($remove))):?>
  <div id="admincontent">
    <?php
    $adminverifytoispage = R::findOne($adminsinif,'name = ?',[mb_strtolower($adminfenn)]);
    if (!empty($adminverifytoispage)):
      #burada axtaririq hele bir fenn var ya yox yoxdur fennin olmadigini deyib fennin olmadigini deyirik
      ?>
    <p id="text1"><?=mb_strtoupper($adminfenn); ?></p>
          <p id="add"><a href="index.php?page=adminalfa&adminsinif=<?=$adminsinif;?>&adminfenn=<?=$adminfenn;?>&add">+</a></p>
      <?php
      #burada soz aralarini gotururuk
      if ($adminsinif == 'az5' || $adminsinif == 'az6' || $adminsinif == 'az7' || $adminsinif == 'az8' || $adminsinif == 'az9') {
        $bukvi1 = ['ə','ç','ş','ü','ö','ğ','ı'];
        $bukvi2 = ['ew','cw','sw','uw','ow','gw','iw'];
        $adminfenn2 = str_replace($bukvi1,$bukvi2,$adminfenn);
      }else {
        $bukvi1 = [' ','ы','ъ','ь','е','ё','ю','я','э','й','ц','у','к','н','г','ш','щ','з','х','ф','в','а','п','р','о','л','д','ж','ч','с','м','и','т','б'];
        $bukvi2 = ['','wi','wt','wm','we','wo','wu','wa','e','y','c','u','k','n','q','sh','hs','z','x','f','v','a','p','r','o','l','d','j','ch','s','m','i','t','b'];
        $adminfenn2 = str_replace($bukvi1,$bukvi2,$adminfenn);
      }
      $adminfennreplaced = str_replace(' ','',$adminfenn2);
      $adminforconnecting = $adminsinif.mb_strtolower($adminfennreplaced);
      #sehifeleri axtaririq ve sehifeye gore siralayiriq
      $adminconnectingtable = R::find($adminforconnecting.'pages','pages ORDER BY pages');
       ?>
       <?php foreach ($adminconnectingtable as $adminpagesnumbers):?>
         <?php
         $adminfornumber = 'pages = '.$adminpagesnumbers->pages.' ORDER BY number';
         $adminfenntable = R::find($adminforconnecting,$adminfornumber);
        ?>
        <?php if (!empty($adminfenntable)): ?>
          <p class="texts">Seh. <?=$adminpagesnumbers->pages;?></p>
          <p id="plus"><a href="index.php?page=adminalfa&adminsinif=<?=$adminsinif;?>&adminfenn=<?=mb_strtolower($adminfenn);?>&add=<?=$adminpagesnumbers->pages; ?>">+</a></p>
        <?php endif;?>
         <?php foreach ($adminfenntable as $table):?>
           <div class="table">
              <p class="class3"><?=$table->id;?></p>
              <p class="class3"><?=$table->number;?></p>
              <p><a class="class2" href="index.php?page=adminalfa&adminopenedimage=<?=$table->image;?>">Sekli Ac</a></p>
              <p><a class="class1" href="index.php?page=adminalfa&adminsinif=<?=$adminsinif;?>&adminfenn=<?=mb_strtolower($adminfenn);?>&edit&admineditpage=<?=$adminpagesnumbers->pages;?>&admineditnumber=<?=$table->number;?>&editid=<?=$table->id;?>">Edit</a></p>
              <p><a class="class1" href="index.php?page=adminalfa&adminsinif=<?=$adminsinif;?>&adminfenn=<?=mb_strtolower($adminfenn);?>&remove&adminremovepage=<?=$adminpagesnumbers->pages;?>&removeid=<?=$table->id;?>">Remove</a></p>
          </div>
         <?php endforeach; ?>
       <?php endforeach; ?>
       <?php else: ?>
         <div id="admincontent">
           <?='Bele bir Fenn yoxdur';?>
         </div>
     <?php endif;?>
  </div>
  <?php else:
      require 'templates/addeditremove.php';
    endif;
     ?>
<?php endif; ?>
