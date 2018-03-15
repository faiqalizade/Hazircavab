<aside>
  <div id="openedfennwrapper">
    <?php
    $fenname = $openedfenn;
    $fenname= mb_convert_case($fenname, MB_CASE_TITLE, "UTF-8");
     ?>
  <p id="fennname"><span><?=$fenname;?></span></p>
  <p id="sinifno"><?=$title;?></p>
      <p id="select">Səhifəni seç</p>
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
      $loadingpages = R::find($sinif.$loadtable.'pages','ORDER BY pages');
      foreach ($loadingpages as $pages):?>
        <a href="index.php?page=openedsinif&sinif=<?=$sinif;?>&openedfenn=<?=$openedfenn;?>&openedsehife=<?=$pages->pages;?>" class="sehifeler">
          <?=$pages->pages;?>
        </a>
    <?php endforeach; ?>
    </div>
      </div>
</aside>
