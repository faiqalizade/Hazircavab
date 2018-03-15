<?php
if (is_dir('cavablar/'.$adminsinif)) {
  if (is_dir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2))) {

    if (is_dir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2).'/'.$_POST['Sehife'])) {
        copy($_FILES['sekil']['tmp_name'],$imageputh);
    }else {
      mkdir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2).'/'.$_POST['Sehife']);
      if (is_dir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2).'/'.$_POST['Sehife'])) {
          copy($_FILES['sekil']['tmp_name'],$imageputh);
      }
    }
  }else {
    mkdir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2));
    if (is_dir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2).'/'.$_POST['Sehife'])) {
        copy($_FILES['sekil']['tmp_name'],$imageputh);
    }else {
      mkdir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2).'/'.$_POST['Sehife']);
      if (is_dir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2).'/'.$_POST['Sehife'])) {
          copy($_FILES['sekil']['tmp_name'],$imageputh);
      }
    }
  }
}else {
  mkdir('cavablar/'.$adminsinif);
  if (is_dir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2))) {

    if (is_dir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2).'/'.$_POST['Sehife'])) {
        copy($_FILES['sekil']['tmp_name'],$imageputh);
    }else {
      mkdir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2).'/'.$_POST['Sehife']);
    }
  }else {
    mkdir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2));
    if (is_dir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2).'/'.$_POST['Sehife'])) {
        copy($_FILES['sekil']['tmp_name'],$imageputh);
    }else {
      mkdir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2).'/'.$_POST['Sehife']);
      if (is_dir('cavablar/'.$adminsinif.'/'.strtolower($adminfenn2).'/'.$_POST['Sehife'])) {
          copy($_FILES['sekil']['tmp_name'],$imageputh);
      }
    }
  }
}
 ?>
