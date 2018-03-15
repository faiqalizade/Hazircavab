<?php
//asagidaki kod registasiya ucundur ve mexanikidir
  function registration()
  {
    $admin = R::dispense('admin');
    $admin->name = 'Ali';
    $admin->surname = 'Babazade';
    $admin->login = 'babazadeali';
    $admin->password = password_hash('5518585a', PASSWORD_DEFAULT);
    R::store($admin);
  }
 ?>
