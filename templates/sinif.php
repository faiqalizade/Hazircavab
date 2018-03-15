<aside>
<?php
#Burada her sinif ucun fennleri axtaririq ve ona gore fennleri gosteririk eger yoxdursa osibka olarak mesaj gosterir
$openedsinif = R::find($sinif);
if (empty($openedsinif)):?>
  <h1><?php echo $title;?></h1>
  <h2><!-- Heç bir fenn tapılmadı.Yaxında yüklənəcək ! -->Не найден ни одной книги.В ближайшее время будет добавлен</h2>
<?php else:?>
  <h1><?php echo $title; ?></h1>
  <div id='wrappersinif'>
    <?php foreach ($openedsinif as $fenns): ?>
      <div class="fenn">
        <a href="index.php?page=openedsinif&sinif=<?=$sinif;?>&openedfenn=<?=$fenns->name;?>"><img id="fennfoto" src="<?=$fenns->image;?>"></a>
      </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</aside>
