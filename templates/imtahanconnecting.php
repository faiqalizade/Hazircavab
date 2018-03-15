<?php
require_once '../db.php';
$suallar = R::find($_POST['imtahan'], 'sualnumber ='.$_POST['sual']);
  $sual = $_POST['sual'];
  if ($sual > 1) {
    $sual -= 1;
    $cavablar = R::find($_POST['imtahan'],'sualnumber ='.$sual);
    foreach ($cavablar as $cavab) {
      if ($_POST['cavab'] == $cavab->verify) {
        $cookiecavab = $_COOKIE['bal'];
        $cookiecavab++;
        setcookie('bal',$cookiecavab,0,'/');
      }
    }
  }
 ?>
 <form>
   <input id="a" type="radio" name="Cavab" value="a">
   <input id="b" type="radio" name="Cavab" value="b">
   <input id="c" type="radio" name="Cavab" value="c">
   <input id="d" type="radio" name="Cavab" value="d">
 </form>
<?php foreach ($suallar as $sual): ?>
  <div id="sualdiv">
    <p draggable="true"  id="question"><?=$sual->sual?></p>
    <label for="a"><p draggable="true" class="variant"><?=$sual->a?></p></label>
    <label for="b"><p draggable="true" class="variant"><?=$sual->b?></p></label>
    <label for="c"><p draggable="true" class="variant"><?=$sual->c?></p></label>
    <label for="d"><p draggable="true" class="variant"><?=$sual->d?></p></label>
  </div>
<?php endforeach; ?>
<button id="button" style="cursor:not-allowed;" disabled type="button" name="button">Növbəti &#8594;</button>
