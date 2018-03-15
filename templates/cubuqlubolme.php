<aside>
  <p class="h1copy">Çubuqlu Bölmə / Деление столбиком</p>
  <form method="post">
    <input type="text" name="val1" style="text-align: center;"required placeholder="1" required><br><br>
    <input type="text" name="val2" style="text-align: center;"required placeholder="2" required><br><br>
    <input type="submit" name="submit" value="Hesabla / Расчитать">
  </form>
  <div style="text-align: left; margin-top: 2%;">
    <?php if (isset($_POST['submit'])):
      $val1 = $_POST['val1'];
      $val2 = $_POST['val2'];
      settype($val1, integer);
      settype($val2, integer);
      $cavab = intval($val1 / $val2);
      while ($cavab > 0) {
        $testcavabarr[] = $cavab % 10;
        $cavab = intval($cavab / 10);
      }
      $i = strlen(implode($testcavabarr)) - 1;
      for ($i; $i >= 0; $i--) {
        $cavabarr[] = $testcavabarr[$i];
      }
      $cavab1 = $val1;
      $t = 0;
      $q = 0;
      $h = 0;
      $margin = 0;
      $lengthcavab = 0;
      $forcavab = $cavabarr[0]*$val2;
      $y = strlen($val1) - strlen($forcavab);
      for ($y; $y > 0; $y--) {
        $forcavab *= 10;
      }
      if ($val1 - $forcavab < 0) {
        $lengthcavab++;
      }
      function cavab($value) {
        global $cavab1,$val1,$t,$margin,$h;
        $i = strlen($cavab1) - strlen($value);
        $margin = strlen($val1) - strlen($value);
        if ($h > 0) {
          $margin -= strlen($cavab1) - strlen($value);
        }else {
          $h++;
        }
        for ($i; $i > 0; $i--) {
          $value *= 10;
        }
        if ($cavab1 - $value < 0) {
          $value /= 10;
          $margin++;

        }
        $cavab1 -= $value;
        }
       ?>
      <div style="margin-left: 50%;">
        <div style="float: left; padding-right: .1%;">
          <p><?=$val1;?></p>
          <p style="margin-left: <?=$lengthcavab*.6-.4;?>rem;">-<?=$cavabarr[0]*$val2;?></p>
          <div style="float: left; border-top: solid 1px;">
          <?php foreach ($cavabarr as $key): cavab($key*$val2);?>
            <?php if ($q > 0):?>
              <?php if ($key * $val2 != 0):?>
                <p style="margin-left: <?=($margin)*.6-.4;?>rem;">-<?=$key * $val2;?></p>
                <p style="margin-left: <?=(strlen($val1) - strlen($cavab1))*.6;?>rem; border-top: solid 1px;"><?=$cavab1;?></p>
              <?php endif; ?>
              <?php else:?>
                <p style="margin-left: <?=(strlen($val1) - strlen($cavab1))*.6;?>rem;"><?=$cavab1;?></p>
            <?php endif; $q++;?>
          <?php $margin = 0; endforeach;?>
          </div>
        </div>
        <div style="border-left: solid 1px; float: left; padding-left: .1%;">
          <p><?=$val2;?></p>
          <p style="border-top: solid 1px;"><?=intval($val1 / $val2);?></p>
        </div>
      </div>
    <?php endif;?>
  </div>
</aside>
