<!--
BU FAYL ISE ACILMIS NOMRENI TAPIR 'fenn/sehife/number'
-->
<style>
aside h1{
	border: none;
	margin: 0;
	color: inherit;
}
</style>
<aside>
<?php
if ($sinif == 'az5' || $sinif == 'az6' || $sinif == 'az7' || $sinif == 'az8' || $sinif == 'az9') {
  $bukvi1 = [' ','ə','ç','ş','ü','ö','ğ','ı'];
  $bukvi2 = ['','ew','cw','sw','uw','ow','gw','iw'];
  $ttl = 'Buyurun Hazır Cavab';
}else {
  $bukvi1 = [' ','ы','ъ','ь','е','ё','ю','я','э','й','ц','у','к','н','г','ш','щ','з','х','ф','в','а','п','р','о','л','д','ж','ч','с','м','и','т','б'];
  $bukvi2 = ['','wi','wt','wm','we','wo','wu','wa','e','y','c','u','k','n','q','sh','hs','z','x','f','v','a','p','r','o','l','d','j','ch','s','m','i','t','b'];
  $ttl = 'Вот вам Hazır Cavab';
}
$loadtable = str_replace($bukvi1,$bukvi2,$openedfenn);
$loadingimages = R::find($sinif.$loadtable,'pages = '.$openedsehife.' ORDER BY number');
foreach ($loadingimages as $image):?>
<?php if ($image->number == $openednumber): ?>
  <p id="fennname"><span><?=$ttl;?></span></p>
  <?php if (isset($image->image)): ?>
  	<img id="openedcavabimage" src="<?=$image->image;?>">
  <?php endif; ?>
  <div class="openedtext"><?=$image->text;?></div>
<?php endif;?>
<?php endforeach;?>
</aside>
