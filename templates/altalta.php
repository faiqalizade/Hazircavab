<aside>
  <p class="h1copy">Alt alta vurma / Умножение столбиком</p>
  <form method="post">
    <input type="text" name="val1" style="text-align: center;"required placeholder="1" required><br><br>
    <input type="text" name="val2" style="text-align: center;"required placeholder="2" required><br><br>
    <input type="submit" name="submit" value="Hesabla / Расчитать">
  </form>
  <?php if (isset($_POST['submit'])):
    $numbers = [$_POST['val1'],$_POST['val2']];
    if (is_int($numbers[0]+1) && is_int($numbers[1]+1)) {
      rsort($numbers);
      $number1 = $numbers[0];
      $val1 = $numbers[0];
      $number2 = $numbers[1];
      $val2 = $numbers[1];
      $proverkaposlenumber1 = 0;
      $proverkaposlenumber2 = 0;
      $noliposlenumber1 = 0;
      $noliposlenumber2 = 0;
      $nolivnumber1 = 0;
      $nolivnumber2 = 0;
      while ($number1 > 0) {
        if ($number1 % 10 != 0) {
          $number1arr[] = $number1 % 10;
          $proverkaposlenumber1++;
        }else {
          $noliposlenumber1++;
          if ($proverkaposlenumber1 == 0) {
            $nolivnumber1++;
          }else{
            $number1arr[] = $number1 % 10;
          }
        }
        $number1 = intval($number1 / 10);
      }
      while ($number2 > 0) {
        if ($number2 % 10 != 0) {
          $number2arr[] = $number2 % 10;
          $proverkaposlenumber2++;
        }else {
          $noliposlenumber2++;
          if ($proverkaposlenumber2 == 0) {
            $nolivnumber2++;
          }else {
            $number2arr[] = $number1 % 10;
          }
        }
        $number2 = intval($number2 / 10);
      }
      if (strlen($val1) >= strlen($val2)) {
        if ($nolivnumber1 > 0 || $nolivnumber2 > 0) {
          $rem = .6;
          if ($nolivnumber2 > 0){
            if ($nolivnumber1 > 0){
              $formargin1 = (strlen($val1) - strlen($val2));
            }else {
              $formargin1 = (strlen($val1) - strlen($val2)) + ($nolivnumber2 - $nolivnumber1);
            }
           }else {
             if ($nolivnumber1 > 0) {
               $formargin1 = (strlen($val1) - strlen($val2));
             }else {
              $formargin1 = (strlen($val1) - strlen($val2)) + ($nolivnumber2 - $nolivnumber1);
             }
          }
        }else {
          $rem = .6;
          $formargin1 = strlen($val1) - strlen($val2);
          $formargin2 = $formargin1;
        }
      }else {
        $formargin1 = (strlen($val1) - strlen($val2)) + ($nolivnumber2 - $nolivnumber1);
        $formargin2 = $formargin1;
      }
      $formargin1 *= $rem;
      $x = 1;
      foreach ($number2arr as $key) {
        if ($x == 1) {
          if (strlen($key * $val1) >= strlen($val1)) {
            $forbordertop = 'border-top: solid 1px;';
            $forborderbottom = ' ';
            $formargin2 = strlen($val1) - strlen($key * $val1);
            if (strlen($key * $val1) > strlen($val1)) {
                $formargin2 = strlen($val1) - strlen($key * $val1);
                $x--;
            }
          }else {
            $forborderbottom = 'border-bottom: solid 1px;';
          }
        }
      }
      $z = 0;
      $value2 = 0;
      $length = 0;
      $margino = 0;
      $formargin2 *= $rem;
      $a = 0;
      $margincavab1 = strlen($val1 * $val2) - strlen($val1) - $nolivnumber2;
      $i = 0;
      $h = 0;
      function test($s) {
        global $nolivnumber1,$margincavab1,$nolivnumber2,$margino,$rem,$h,$i,$value2,$formargin2,$z,$length,$val1,$a;
        $value = $s;
        if ($z == 0) {
          $value2 = $value;
          if ($nolivnumber2 > 0) {
            if ($nolivnumber1 != 0) {
              $j = $nolivnumber2;
              $j *= $rem;
            }
          }
          if (strlen($value) - strlen($val1) == 0) {
            $margino = -$formargin2-$j;
          }
          $z++;
        }else {
          if (strlen($value) - strlen($value2) < 0) {
            $a = strlen($value) - strlen($value2);
            $length = $a;
            $length *= -$rem;
            $h++;
          }elseif (strlen($value) - strlen($value2) == 0) {
            if ($h != 0) {
              $length = 0;
              $length *= $rem;

            }
          }elseif (strlen($value) - strlen($value2) > 0) {
            $length = strlen($value) - strlen($value2);
            $length += $a;
            $length *= -$rem;
          }
        }
        $value2 = $value;
        return $length;
      }
      $margincavab1 *= -$rem;
      $l = 1;
    }else {
      $l = 0;
    }
    ?>
    <?php if ($l != 0): ?>
      <div id="body" style="float: left; margin-left: 50%; text-align: left; margin-top: 5%;">
        <div style="<?=$forborderbottom;?>">
          <p class='umnojenie'><?=$val1;?></p>
          <p class='umnojenie' style="margin-left: <?=$formargin1;?>rem;"><?=$val2;?></p>
        </div>
        <div style="margin-left: <?=$formargin2;?>rem; <?=$forbordertop;?>">
          <?php foreach ($number2arr as $number):?>
            <?php if ($number * $val1 != $val1 * $val2): ?>
              <?php if ($number * $val1 != 0): $length = test($number * $val1,$i);?>
                <p class='umnojenie' style="margin-left: <?=$i*-$rem+$margino+$length;?>rem;"><?=$number * $val1;?></p>
              <?php endif; ?>
            <?php endif; ?>
        <?php
        $i++;
        $length = 0;
         endforeach;?>
        </div>
          <p class='umnojenie' style="border-top: solid 1px; margin-left: <?=$margincavab1;?>rem;"><?=$val1*$val2;?></p>
      </div>
      <?php else: ?>
        <p style="margin-top: 5%;">Zehmet olmazsa tam eded yazin!</p>
    <?php endif; ?>
  <?php endif; ?>
</aside>
