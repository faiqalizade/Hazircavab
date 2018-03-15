		<script src="templates/jquery-3.2.1.js"></script>
		<?php
		  #burada GET'in bos olub olmadigini yoxlayiriq eks halda login yerinine veririk meqsed tehlukesizlik(Yeni faylin adi acilmasin qarsisin aliriq)
		 if (empty($_GET)):?>
		  <?php if (isset($_COOKIE['loged_admin_verify'])):?>
		    <?php
		    require_once '../db.php';
		    #Burada db ve rb qosulur cunki eger Get bosdursa bunlar qosulmur ve yoxlayiriq cookie'si var girenin yoxdursa Login
		    $verifyadmin = R::findOne('admin','id = ?', [$_COOKIE['loged_admin_id']]);
		    #varsa kodu yoxlayiriq duzdurse adminalfaya orada yeniden yoxlanilir ve aadminpanel
		    if ($_COOKIE['loged_admin_verify'] == $verifyadmin->password):?>
		    <script>
		      window.location = '../index.php?page=adminalfa';
		    </script>
		  <?php else:?>
		    <script>
		      window.location = '../index.php?page=adminalfa';
		    </script>
		  <?php endif;?>
		  <?php else:?>
		    <script>
		      window.location = '../index.php?page=adminalfa';
		    </script>
		  <?php endif;?>
		  <?php else:
		    #eger get bos deyilsede yenede yoxlayiriq (Eslinde adminalfa ve admin login yoxlayir amma yenede) ve sidebar & header
		    ?>
		    <?php if (isset($_COOKIE['loged_admin_verify'])):?>
		      <?php
		      $verifyadmin = R::findOne('admin','id = ?', [$_COOKIE['loged_admin_id']]);
		      if ($_COOKIE['loged_admin_verify'] == $verifyadmin->password): ?>
		      <?php
		      if ($_COOKIE['loged_admin_name'] == 'Faiq') {
		        #ad ve Familiya oyrenirik
		        $name = 'Faiq';
		        $surname = 'Alizade';
		      }else {
		        $name = 'Ali';
		        $surname = 'Babayev';
		      }?>
		      <?php endif; ?>
		  <?php endif; ?>
		  <header>
		    <a href="index.php?page=adminalfa"><img id="logo" src="images/Logo.svg"></a>
		    <a href="index.php?page=adminalfa"><p id="text">Admin Panel</p></a>
		        <p id="name"><?=$name. ' '. $surname;?></p>
		  </header>
		  <div class="content">
		  <div id="sidebar">
		  <h2>Az sektor</h2>
		  <ul>
		    <?php for ($i=5; $i <=9 ; $i++):
		      #ve cikl her cikl de fennleri bazadan axtarib gosteririk
		      $adminsidebarfenns = R::find('az'.$i);?>
		        <li class="li"><?=$i; ?>-ci sinif
		          <ul>
		          <?php foreach ($adminsidebarfenns as $adminsidebarfenn): ?>
		            <li class="li1"><a href="index.php?page=adminalfa&adminsinif=az<?=$i;?>&adminfenn=<?=$adminsidebarfenn->name;?>"><?=ucfirst($adminsidebarfenn->name);?></a></li>
		            <?php endforeach; ?>
		            <li class="li1"><a href="index.php?page=adminalfa&adminsinif=az<?=$i;?>&addfenn">+ADD+</a></li>
		            <?php if (!empty($adminsidebarfenns)): ?>
		              <li class="li1"><a href="index.php?page=adminalfa&adminsinif=az<?=$i;?>&removefenn">-Remove-</a></li>
		              <li class="li1"><a href="index.php?page=adminalfa&adminsinif=az<?=$i;?>&editfenn">EDIT</a></li>
		            <?php endif; ?>
		        </ul>
		        </li>
		  <?php endfor; ?>
		  </ul>
		  <h2>Русский сектор</h2>
		  <ul>
		  <?php for ($i=5; $i <= 9 ; $i++):
		    #ve cikl her cikl de fennleri bazadan axtarib gosteririk
		    $adminsidebarfenns = R::find('ru'.$i);
		    ?>
		  <li class="li"><?=$i;?>-ый класс
		  <ul>
		    <?php foreach ($adminsidebarfenns as $adminsidebarfenn): ?>
		      <li class="li1"><a href="index.php?page=adminalfa&adminsinif=ru<?=$i;?>&adminfenn=<?=$adminsidebarfenn->name;?>"><?=ucfirst($adminsidebarfenn->name);?></a></li>
		      <?php endforeach; ?>
		      <li class="li1"><a href="index.php?page=adminalfa&adminsinif=ru<?=$i;?>&addfenn">+ADD+</a></li>
		      <?php if (!empty($adminsidebarfenns)):
		        #birder burda yoxlayiriq eger hec bir fenn yoxdursa edit remove gostrilmesin eger bir fenn de olsa gostercek
		        ?>
		        <li class="li1"><a href="index.php?page=adminalfa&adminsinif=ru<?=$i;?>&removefenn">-Remove-</a></li>
		        <li class="li1"><a href="index.php?page=adminalfa&adminsinif=ru<?=$i;?>&editfenn">EDIT</a></li>
		      <?php endif; ?>
		  </ul>
		        </li>
		  <?php endfor; ?>
		  <li id="cixis"><a href="index.php?page=logout">Çıxış</a></li>
		  </ul>
		  </div>
		  <?php
		  #burada yoxlayiriq goresen sinif acilib ya yox ve yaxud acilmis cavab(sekil) acilib ya yox ona gore fayl aciriq
		    if (isset($adminsinif)){
		      require 'templates/adminopenedsinif.php';
		    }elseif($adminopenedimage){
		      require 'templates/adminopenedimage.php';
		    }
		   ?>
					<?php if (!isset($adminsinif)): ?>
						<div style="float:left; margin-left: 19%; width: 81%;">
								<?php
								$imtahanaddfenn = $_GET['imtahanaddfenn'];
								$imtahanremove = $_GET['imtahanremove'];
									if (!isset($imtahanaddfenn) && !isset($imtahanremove)): ?>
									<p style="text-align:center; font-size: 2.5em;font-weight:bold;">İmtahanlar</p>
									<p style="text-align:center; font-size: 1.8em;font-weight:bold;">Azərbaycan Sektoru</p>
									<p style="text-align:center; font-size: 1.5em;"><a style="color:blue;" href="index.php?page=adminalfa&imtahanaddfenn&sektor=az">+Add+</a></p>
									<?php
									$imtahanfennleriaz = R::find('testfennleriaz');
										foreach ($imtahanfennleriaz as $key):
												$testconnecting = mb_strtolower($key->name);
												$bukvi1 = [' ','ə','ç','ş','ü','ö','ğ','ı'];
												$bukvi2 = ['','ew','cw','sw','uw','ow','gw','iw'];
												$testconnecting = str_replace($bukvi1,$bukvi2,$testconnecting);
												$imtahantable = R::find($testconnecting.'az');
													?>
													<p style="text-align: center;font-weight:bold;font-size:1.4em;"><a style="color:blue;" href="index.php?page=adminalfa&imtahanremove=<?=$testconnecting.'az';?>">&#10005;</a> <?=$key->name?> <a style="color:blue;" href="index.php?page=adminalfa&imtahanaddfenn=<?=$testconnecting.'az'?>">&#10011;</a></p>
													<?php foreach ($imtahantable as $imtahan): ?>
															<p style="text-align: center;font-weight:bold;font-size:1.4em;"><a style="color:blue;" href="index.php?page=adminalfa&imtahanremove=<?=$testconnecting.'az'.$imtahan->sinifnumber;?>">&#10005;</a> <?=$imtahan->sinif?> <a style="color:blue;" href="index.php?page=adminalfa&imtahanaddfenn=<?=$testconnecting.'az'?>&sinif=<?=$imtahan->sinifnumber?>">&#10011;</a></p>
															<?php
															$sualview1 = 'index.php?page=adminalfa&imtahanaddfenn='.$testconnecting.'az&sinif='.$imtahan->sinifnumber;
															$imtahan = R::find($testconnecting.'az'.$imtahan->sinifnumber,'ORDER BY sualnumber');
															foreach ($imtahan as $suallar):
																	$sualview = $sualview1.'&id='.$suallar->id;
															?>
															<!--burada suali ve varianlari ve sayire gosterek-->
															<br>
															<p class="imtahansual"><a style="color:blue;" href="<?=$sualview;?>">&#9998;</a> Sual <?=$suallar->sualnumber?> <a style="color:blue;" href="<?=$sualview.'&remove'?>">&#10006;</a></p>
															<p class="imtahansual"><?=$suallar->sual?></p>
															<p class="imtahansual"><?=$suallar->a?></p>
															<p class="imtahansual"><?=$suallar->b?></p>
															<p class="imtahansual"><?=$suallar->c?></p>
															<p class="imtahansual"><?=$suallar->d?></p>
															<p class="imtahansual">Düzgün cavab : <?=$suallar->verify?></p><br>
															<hr><br>
															<!--Burada bitir-->
															<?php endforeach; ?>
													<?php endforeach; ?>
									<?php endforeach; ?>
									<br>
									<p style="text-align:center; font-size: 1.8em; font-weight:bold;">Rus sektoru</p>
									<p style="text-align:center; font-size: 1.5em;"><a style="color:blue;" href="index.php?page=adminalfa&imtahanaddfenn&sektor=ru">+Add+</a></p>
									<?php
									$imtahanfennleriru = R::find('testfennleriru');
										foreach ($imtahanfennleriru as $key):
												$testconnecting = mb_strtolower($key->name);
												$bukvi1 = [' ','ы','ъ','ь','е','ё','ю','я','э','й','ц','у','к','н','г','ш','щ','з','х','ф','в','а','п','р','о','л','д','ж','ч','с','м','и','т','б'];
												$bukvi2 = ['','wi','wt','wm','we','wo','wu','wa','e','y','c','u','k','n','q','sh','hs','z','x','f','v','a','p','r','o','l','d','j','ch','s','m','i','t','b'];
												$testconnecting = str_replace($bukvi1,$bukvi2,$testconnecting);
												$imtahantable = R::find($testconnecting.'ru');
													?>
													<p style="text-align: center;font-weight:bold;font-size:1.4em;"><a style="color:blue;" href="index.php?page=adminalfa&imtahanremove=<?=$testconnecting.'ru';?>">&#10005;</a> <?=$key->name?> <a style="color:blue;" href="index.php?page=adminalfa&imtahanaddfenn=<?=$testconnecting.'ru'?>">&#10011;</a></p>
													<?php foreach ($imtahantable as $imtahan): ?>
															<p style="text-align: center;font-weight:bold;font-size:1.4em;"><a style="color:blue;" href="index.php?page=adminalfa&imtahanremove=<?=$testconnecting.'ru'.$imtahan->sinifnumber;?>">&#10005;</a> <?=$imtahan->sinif?> <a style="color:blue;" href="index.php?page=adminalfa&imtahanaddfenn=<?=$testconnecting.'ru'?>&sinif=<?=$imtahan->sinifnumber?>">&#10011;</a></p>
															<?php
															$sualview1 = 'index.php?page=adminalfa&imtahanaddfenn='.$testconnecting.'ru&sinif='.$imtahan->sinifnumber;
															$imtahan = R::find($testconnecting.'ru'.$imtahan->sinifnumber,'ORDER BY sualnumber');
															foreach ($imtahan as $suallar):
																	$sualview = $sualview1.'&id='.$suallar->id;
															?>
															<!--burada suali ve varianlari ve sayire gosterek-->
															<br>
															<p class="imtahansual"><a style="color:blue;" href="<?=$sualview?>">&#9998;</a> Sual <?=$suallar->sualnumber?> <a style="color:blue;" href="<?=$sualview.'&remove'?>">&#10006;</a></p>
															<p class="imtahansual"><?=$suallar->sual?></p>
															<p class="imtahansual"><?=$suallar->a?></p>
															<p class="imtahansual"><?=$suallar->b?></p>
															<p class="imtahansual"><?=$suallar->c?></p>
															<p class="imtahansual"><?=$suallar->d?></p>
															<p class="imtahansual">Düzgün cavab : <?=$suallar->verify?></p><br>
															<hr><br>
															<!--Burada bitir-->
															<?php endforeach; ?>
													<?php endforeach; ?>
									<?php endforeach; ?>
									<?php else:?>
											<?php if (isset($imtahanremove)):
													if (isset($_POST['submit'])) {
															R::wipe($imtahanremove);
															for ($i=4; $i < 11; $i++) {
																R::wipe($imtahanremove.$i);
															}
											}
											?>
													<form style="text-align:center;" method="post">
															<input style="margin-top:1%;" type="submit" name="submit" value="Əminsiz ?">
													</form>
													<?php else: ?>
															<?php if(empty($imtahanaddfenn)): ?>
																	<form class="imtahan_add" method="post" enctype="multipart/form-data">
																			<input class="imtahan_input" type="text" name="fennname" autofocus required><br>
																			<input id="foto_upload" type="file" name="sekil" required><br>
																			<label class="foto_upload_label" for="foto_upload">Şəkil</label><br><br>
																			<input class="imtahan_submit" type="submit" name="submit" value="Göndər"><br>
																	</form>
																	<script>
																	$("#foto_upload").change(function () {
																			$(".foto_upload_label").css({
																					"color" : "#00fa3e",
																					"border" : "#00fa3e 2px solid"
																			});
																	});
																	</script>
																	<?php
																	if (isset($_POST['submit'])) {
																			$fennname = $_POST['fennname'];
																			$fennname = trim($fennname);
																			$proverka_est_li_fenn = R::findOne('testfennleri'.$_GET['sektor'],'name = ?',[$fennname]);
																			if (empty($proverka_est_li_fenn)) {
																					$imtahanfennadddb = R::dispense('testfennleri'.$_GET['sektor']);
																					$imtahanfennadddb->name = $fennname;
																					$imtahanfennadddb->image = 'images/'.$_POST['fennname'].'.png';
																					R::store($imtahanfennadddb);
																			}
																			copy($_FILES['sekil']['tmp_name'],'images/'.$fennname.'.png');
																	}
																		?>
																<?php else:
																		$bukvi1 = [' ','ə','ç','ş','ü','ö','ğ','ı'];
																		$bukvi2 = ['','ew','cw','sw','uw','ow','gw','iw'];
																		$imtahanaddfenn = str_replace($bukvi1,$bukvi2,$imtahanaddfenn);
																		?>
																		<?php if (!isset($_GET['sinif'])): ?>
																				<?php
																				if (isset($_POST['sub'])){
																									$addsinifimtahan = R::dispense($imtahanaddfenn);
																									$addsinifimtahan->sinifnumber = $_POST['sinifnumber'];
																									$addsinifimtahan->sinif = $_POST['sinif'];
																									R::store($addsinifimtahan);
																							}
																							?>
																					<form class="imtahan_add" method="post">
																							<input class="imtahan_input" type="number" name="sinifnumber" placeholder="Sinif nömrəsi" required><br><br>
																							<input class="imtahan_input" type="text" name="sinif" placeholder="Sinif adı" required><br><br>
																							<input class="imtahan_submit" type="submit" name="sub" value="GÖNDƏR">
																					</form>
																			<?php else:?>
																					<?php
																					if (isset($_POST['sub'])){
																							if (!isset($_GET['id']) && !isset($_GET['remove'])) {
																									$addsual = R::dispense($imtahanaddfenn.$_GET['sinif']);
																							}else {
																									$addsual = R::load($imtahanaddfenn.$_GET['sinif'],$_GET['id']);
																							}
																							if (!isset($_GET['remove'])) {
																									$addsual->sualnumber = $_POST['sualnumber'];
																									$addsual->sual = $_POST['sual'];
																									$addsual->a = $_POST['a'];
																									$addsual->b = $_POST['b'];
																									$addsual->c = $_POST['c'];
																									$addsual->d = $_POST['d'];
																									$addsual->verify = $_POST['verify'];
																									R::store($addsual);
																							}
																							else {
																									$removesual = R::load($imtahanaddfenn.$_GET['sinif'],$_GET['id']);
																									R::trash($removesual);
																							}
																					}
																					if (isset($_GET['id'])) {
																							$sualvalues = R::find($imtahanaddfenn.$_GET['sinif'],'id ='.$_GET['id']);
																							foreach ($sualvalues as $values) {
																									$sualnumber = $values->sualnumber;
																									$sual = $values->sual;
																									$a = $values->a;
																									$b = $values->b;
																									$c = $values->c;
																									$d = $values->d;
																									$verify = $values->verify;
																							}
																					}
																						?>
																					<?php if (!isset($_GET['remove'])):?>
																							<form class="imtahan_add" method="post">
																									<input placeholder="Sual nömrəsi" value="<?=$sualnumber?>" type="number" name="sualnumber" required><br><br>
																									<textarea placeholder="Sual" name="sual" required rows="3" cols="50"><?=$sual?></textarea><br><br>
																									<textarea placeholder="A variantı" name="a" required rows="3" cols="50"><?=$a?></textarea><br><br>
																									<textarea placeholder="B variantı" name="b" required rows="3" cols="50"><?=$b?></textarea><br><br>
																									<textarea placeholder="C variantı" name="c" required rows="3" cols="50"><?=$c?></textarea><br><br>
																									<textarea placeholder="D variantı" name="d" required rows="3" cols="50"><?=$d?></textarea><br><br>
																									<input placeholder="Düzgün variant" type="text" name="verify" value="<?=$verify?>" required><br><br>
																									<input type="submit" name="sub" value="GÖNDƏR">
																							</form>
																							<p style="text-align:center; font-size: 1em;">DIQQET!!! Suallari duzgun siralayin</p>
																							<?php else: ?>
																									<form method="post" class="imtahan_add">
																											<input type="submit" name="sub" value="Silmek">
																									</form>
																									<br>
																									<p style="text-align:center; font-size: 1em;">DIQQET!!! SILDIKDEN SONRA YA YERINE BIR SUAL YAZIN YADA HAMMISINI SIRALAYIN!!!</p>
																					<?php endif; ?>
																		<?php endif; ?>
															<?php endif; ?>
											<?php endif; ?>
								<?php endif; ?>
						</div>
					<?php endif; ?>
		  </div>
		<?php endif; ?>
