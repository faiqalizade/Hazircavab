<!--
Burada acilmis sehifeye gore misallari aciriq ve ORDER BY pages edirik yeni sehifelere gore siralayiriq
-->
<aside>
  <?php
  $fenname = $openedfenn;
  $fenname= mb_convert_case($fenname, MB_CASE_TITLE, "UTF-8");
   ?>
  <p id="fennname"><span><?=$fenname;?></span></p>
  <p id="sinifno"><?=$title;?></p>
  <p id="select">Misal nömrəsini seç</p>
    <div class="sehifecontent">
  <?php
  if ($sinif == 'az5' || $sinif == 'az6' || $sinif == 'az7' || $sinif == 'az8' || $sinif == 'az9') {
    $bukvi1 = [' ','ə','ç','ş','ü','ö','ğ','ı'];
    $bukvi2 = ['','ew','cw','sw','uw','ow','gw','iw'];
    }else {
    $bukvi1 = [' ','ы','ъ','ь','е','ё','ю','я','э','й','ц','у','к','н','г','ш','щ','з','х','ф','в','а','п','р','о','л','д','ж','ч','с','м','и','т','б'];
    $bukvi2 = ['','wi','wt','wm','we','wo','wu','wa','e','y','c','u','k','n','q','sh','hs','z','x','f','v','a','p','r','o','l','d','j','ch','s','m','i','t','b'];
    }
    $loadtable = str_replace($bukvi1,$bukvi2,$openedfenn);
  $loadingnumbers = R::find($sinif.$loadtable,'pages = '.$openedsehife.' ORDER BY number');
  foreach ($loadingnumbers as $number):?>
    <a href="index.php?page=openedsinif&sinif=<?=$sinif;?>&openedfenn=<?=$openedfenn;?>&openedsehife=<?=$openedsehife;?>&openednumber=<?=$number->number;?>" class="sehifeler">
      <?=$number->number?>
    </a>
<?php endforeach;?>
  </div>
</aside>
