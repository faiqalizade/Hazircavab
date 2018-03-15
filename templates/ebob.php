<aside>
  <p class="h1copy">ƏBOB/НОД</p>
  <form method="post">
    <input type="text" name="number1" style="text-align: center;"required placeholder="1"><br><br>
    <input type="text" name="number2" style="text-align: center;" required placeholder="2"><br><br>
    <input type="text" name="number3" style="text-align: center;" placeholder="3"><br><br>
    <input type="submit" name="submit" value="Hesabla / Рассчитать">
    </form>
    <?php
    if (isset($_POST['submit'])) {
      $num1 = $_POST['number1'];
      $num2 = $_POST['number2'];
      $num3 = $_POST['number3'];
      $cavabnum1 = [];
      $cavabnum2 = [];
      $cavabnum3 = [];
      for ($i = 2; $i <= $num1; $i++) {
        $cavab1 = $num1 / $i;
        if (is_int($cavab1)) {
          $cavabnum1[] = $i;
        }
      }
      for ($y = 2; $y <= $num2 ; $y++) {
        $cavab2 = $num2 / $y;
        if (is_int($cavab2)) {
          $cavabnum2[] = $y;
        }
      }

      for ($x = 2; $x <= $num3 ; $x++) {
        $cavab3 = $num3 / $x;
        if (is_int($cavab3)) {
          $cavabnum3[] = $x;
        }
      }
      if (empty($cavabnum3)){
        foreach ($cavabnum1 as $number1) {
          foreach ($cavabnum2 as $number2) {
            if ($number1 == $number2) {
              $numberr[] = $number1;
            }
          }
        }
      }else {
        foreach ($cavabnum1 as $number1) {
          foreach ($cavabnum2 as $number2) {
            foreach ($cavabnum3 as $number3) {
              if ($number1 == $number2) {
                if ($number2 == $number3) {
                  $numberr[] = $number1;
                }
              }
            }
          }
        }
      }
      rsort($numberr);
      if (empty($numberr[0])) {
        echo "<br>";
        echo 'Nəticə / Итого: 1';
      }else {
        echo "<br>";
        echo 'Nəticə / Итого: '.$numberr[0];
      }
    }
     ?>
</aside>
