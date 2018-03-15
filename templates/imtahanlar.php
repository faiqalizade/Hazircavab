<style>
aside{
  width: 91%;
  box-shadow: none;
}
.riyaziyyat{
  padding: 2%;
  flex-basis: 28%;
  margin-bottom: 3%;
}
.riyaziyyat img{
  border-radius: 50%;
  height: 43%;
  width: 30%;
}
.riyaziyyat img:hover{
  box-shadow: 0 0 10px #969696;
}
#sinifs{
  margin-top: 5%;

}
.sinifs{
  font-size: 1.2em;
  color: #245b6f;
}
#h{
  color: #4c5d6e;
  font-family: inherit;
  font-size: 1.1em;
  text-shadow: 0 5px 15px;
}

#imtahanwrapper{
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}
#imtahancontentwrapper{
  display: flex;
  float: left;
  width: 100%;
  justify-content: center;
}
.sektor_name{
	font-size: 1.8em;
	color: #46AD9B;
	margin-bottom: 2%;
}
@media screen and (min-width: 761px) and (max-width: 1100px) {
  #h{
    font-size: 1em;
  }
		.h1copy{
			font-size: 2em;
		}
}
@media screen and (max-width: 760px) {
  .riyaziyyat img {
    height: 43%;
  }
  .riyaziyyat{
    flex-basis: 100%;
  }
		.sektor_name{
			font-size: 1.3em
		}
		.h1copy{
			font-size: 1.2em;
		}
}
</style>
<?php
$testfennleriaz = R::find('testfennleriaz');
$testfennleriru = R::find('testfennleriru');
 ?>
     <div id="imtahancontentwrapper">
       <aside>
         <p class="h1copy"><?=$title?></p>
									<p class="sektor_name">Azərbaycan sektoru</p>
         <div id="imtahanwrapper">
           <?php foreach ($testfennleriaz as $testler):
             $proverka = false;
             $bukvi1 = [' ','ə','ç','ş','ü','ö','ğ','ı'];
             $bukvi2 = ['','ew','cw','sw','uw','ow','gw','iw'];
             $testtable = str_replace($bukvi1,$bukvi2,mb_strtolower($testler->name));
             for ($i = 5; $i <= 10; $i++) {
               $proverkanapustatu = R::find($testtable.'az'.$i);
               if (count($proverkanapustatu) >= 3) {
                 $proverka = true;
               }
             }
             if ($proverka):
             ?>
             <div class="riyaziyyat">
               <img src="<?=$testler->image;?>">
               <div id="sinifs">
                 <p id="h"><?=$testler->name?></p>
                 <?php
                 $fenntable = mb_strtolower($testler->name);
                 $bukvi1 = [' ','ə','ç','ş','ü','ö','ğ','ı'];
                 $bukvi2 = ['','ew','cw','sw','uw','ow','gw','iw'];
                 $fenntable = str_replace($bukvi1,$bukvi2,$fenntable);
                 $fennsinifleri = R::find($fenntable.'az');
                 foreach ($fennsinifleri as $sinif):
                 $sualsayisi = count(R::find($fenntable.'az'.$sinif->sinifnumber));
                 if ($sualsayisi >= 3):
                  ?>
                 <p class="sinifs"><a style="color:#245b6f;" href="index.php?page=imtahan&imtahan=<?=$fenntable.'az'.$sinif->sinifnumber;?>"><?=$sinif->sinif;?></a><p>
               <?php endif;?>
               <?php endforeach; ?>
               </div>
             </div>
           <?php endif; ?>
           <?php endforeach;?>
         </div>
									<p class="sektor_name">Русский сектор</p>
         <div id="imtahanwrapper">
           <?php
            foreach ($testfennleriru as $testler):
              $bukvi1 = [' ','ы','ъ','ь','е','ё','ю','я','э','й','ц','у','к','н','г','ш','щ','з','х','ф','в','а','п','р','о','л','д','ж','ч','с','м','и','т','б'];
              $bukvi2 = ['','wi','wt','wm','we','wo','wu','wa','e','y','c','u','k','n','q','sh','hs','z','x','f','v','a','p','r','o','l','d','j','ch','s','m','i','t','b'];
              $forconnecting = str_replace($bukvi1,$bukvi2,mb_strtolower($testler->name));
             $proverka = false;
             for ($i = 5; $i <= 10; $i++) {
               $proverkanapustatu = R::find($forconnecting.'ru'.$i);
               if (count($proverkanapustatu) >= 1){
                 $proverka = true;
               }
             }
             if ($proverka):
             ?>
             <div class="riyaziyyat">
               <img src="<?=$testler->image;?>">
               <div id="sinifs">
                 <p id="h"><?=$testler->name?></p>
                 <?php
                 $fenntable = mb_strtolower($forconnecting);
                 $fennsinifleri = R::find($fenntable.'ru');
                 foreach ($fennsinifleri as $sinif):
                 $sualsayisi = count(R::find($fenntable.'ru'.$sinif->sinifnumber));
                 if ($sualsayisi >= 1):
                  ?>
                 <p class="sinifs"><a style="color:#245b6f;" href="index.php?page=imtahan&imtahan=<?=$fenntable.'ru'.$sinif->sinifnumber;?>" class="sinifs"><?=$sinif->sinif;?></a></p>
               <?php endif;?>
               <?php endforeach; ?>
               </div>
             </div>
           <?php endif;?>
           <?php endforeach;?>
         </div>
       </aside>
     </div>
