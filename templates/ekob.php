<aside>
  <p class="h1copy">ƏKOB/НОК</p>
  <form method="post">
    <input type="text" name="number1" style="text-align: center;" required placeholder="1"><br><br>
    <input type="text" name="number2" style="text-align: center;" required placeholder="2"><br><br>
    <input type="text" name="number3" style="text-align: center;" placeholder="3"><br><br>
    <input type="submit" name="submit" value="Hesabla / Рассчитать">
    </form>
    <?php
    if (isset($_POST['submit'])) {
      $num1 = $_POST['number1'];
      $num2 = $_POST['number2'];
      $num3 = $_POST['number3'];
      if (empty($num3)) {
        $numbers = [$num1,$num2];
        rsort($numbers);
        $i = $numbers[0] * 1000;
        for ($i; $i >= $numbers[0] ; $i--) {
          if (is_int($i / $numbers[0])) {
            if (is_int($i / $numbers[1])) {
              $cavab[] = $i;
            }
          }
        }

      } else {
        $numbers = [$num1,$num2,$num3];
        rsort($numbers);
        $i = $numbers[0] * 1000;
        for ($i; $i >= $numbers[0] ; $i--) {
          if (is_int($i / $numbers[0])) {
            if (is_int($i / $numbers[1])) {
              if (is_int($i / $numbers[2])){
                $cavab[] = $i;
              }
            }
          }
        }
      }
    sort($cavab);
    echo "<br>";
    echo 'Nəticə / Итого: '.$cavab[0];
  }
     ?>
</aside>
