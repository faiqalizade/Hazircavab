<style>
#imtahancontentwrapper{
  display: flex;
  width: 100%;
  justify-content: center;
}
aside{
  width: 90%;
  box-shadow: none;
}
input[type = 'radio']{
  display: none;
}
.variant{
  padding-left: 0.5%;
  text-align: left;
  transition: 800ms all;
  cursor: pointer;
  margin-bottom: .5%;
}
.variant:hover{
  background-color: #d2d2d2;
}
#times{
  margin-top: 3%;
  margin-left: 1.5%;
  background-color: #2c3e50;
  padding: .5% 1%;
  color: white;
  float: left;
  font-size: 1.2em;
}
#question,#netice{
  text-align: left;
  font-family: Sinhala Sangam MN;
  font-size: 1.6em;
  margin-bottom: 1%;
}
#button {
  float: left;
  margin-top: 3%;
  transition: 200ms all;
  font-size: 1.2em;
  border: none;
  opacity: 0.6;
  background-color: #2c3e50;
  padding: .5% 1%;
  color: white;
}
#warning,#error,#success{
	width: 6%;
}
@media screen and (max-width: 760px) {
	#warning,#error,#success{
		width: 15%;
	}
}
</style>
<script>
$(document).ready (function (){
  if (!getcookie('minutes')){
    setcookie('minutes',19,'/');
  }
  if(!getcookie('secs')) {
    setcookie('secs',60,'/');
  }else if (getcookie('secs') < 0) {
    setcookie('secs',60,'/');
  }
  time();
  $('.imtahan').bind('click',function () {
    var txt;
    var r = confirm("Əminsiz ?");
    if (r == true) {
      deletecookie('bal');
      deletecookie('sual');
      deletecookie('minutes');
      deletecookie('secs');
       return true;
    } else {
        return false;
    }
  });
  if (!getcookie('bal')) {
    setcookie('bal',0,'/');
}
function parseGetParams() {
 var GET = {};
 var __GET = window.location.search.substring(1).split("&");
 for(var i=0; i<__GET.length; i++) {
    var getVar = __GET[i].split("=");
    GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1];
 }
 return GET;
}
var $_GET = parseGetParams();
  function setcookie ( name, value, path, exp_y, exp_m, exp_d, exp_h , exp_m , domain, secure ){
    var cookie_string = name + "=" + escape ( value );

    if ( exp_y )
    {
      var expires = new Date ( exp_y, exp_m, exp_d, exp_h , exp_m );
      cookie_string += "; expires=" + expires.toGMTString();
    }

    if ( path )
          cookie_string += "; path=" + escape ( path );

    if ( domain )
          cookie_string += "; domain=" + escape ( domain );

    if ( secure )
          cookie_string += "; secure";

    document.cookie = cookie_string;
  }
  function deletecookie ( cookie_name ){
    var date = new Date;
    date.setDate(date.getDate() - 5);
    document.cookie = cookie_name +'=; path=/; expires='+date.toUTCString();
  }
  function getcookie ( cookie_name ){
    var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );

    if ( results )
      return ( unescape ( results[2] ) );
    else
      return null;
  }
  var sual;
  if (!getcookie('sual')) {
    setcookie('sual',1,'/');
    sual = 1;
  }else {
    sual = getcookie('sual');
  }
    var minute,second;
    function time() {
      if (getcookie('minutes') && getcookie('secs')) {
        minute = getcookie('minutes');
        second = getcookie('secs');
        second--;
        if (second == 0) {
          setcookie('secs',60,'/');
          second = '00';
          if (minute == 0) {
            $("#netice").text("İmtahanın nəticəsi"+getcookie("bal")+"/3");
            deletecookie('bal');
            deletecookie('sual');
            deletecookie('minutes');
            deletecookie('secs');
            location.reload();
          }else {
            minute--;
            setcookie('minutes',minute,'/');
          }
        }else {
          setcookie('secs',second,'/');
        }
        if (second < 10 && second > 0) {
          second = '0'+second;
        }
        document.getElementById('times').textContent = minute+':'+second;
      }
    }
    setInterval(time, 1000);
  function ajaxFunc(data) {
    $('#loadingimage').css({'display':'none'});
    $('#sualdiv').css({'display':'block'});
    document.getElementById('sual').innerHTML = data;
    if (sual >= 4) {
      $('#button').css({'display':'none'});
    }
    $('input').change(function () {
      $('#button').removeAttr('disabled');
      $('#button').css({"opacity" : "1","cursor" : "pointer"});
    });
    $('#button').bind('click',function (){
      var cavab = ($('input:checked').val());
      ajaxStart(cavab);
      //Burada her ireli duymesine basdiqda toxlayiriq eger sual sayisindan
      // 1 ve yaxud daha coxdursa istirakcinin balin gosteririk cookieleri silirik timout ise php faylin islemesine vaxt verir!!
      if (sual >= 4) {
        $('#times').css({'display':'none'});
        $('#button').css({'display':'none'});
        setTimeout(function (){
          var color;
          if (getcookie("bal") >= 3) {
            color="#0acb5d";
            $('#success').show(1500);
            $('#neticehakkinda').text("Təbriklər.Uğurunuz bol olsun.");
          }else if (getcookie("bal") == 2) {
            color="#ffd600";
            $('#warning').show(1500);
            $('#neticehakkinda').text("Umidinizi itirmeyin :|");
          }else {
            color="red";
            $('#error').show(1500);
            $('#neticehakkinda').text("Öyrənəcəyiniz çox şey var! :(");
          }
          $('#netice').css({'display':'block','color' : color});
          $("#neticeBal").html("<span style='font-size:1.5em;color:"+color+";'>"+getcookie('bal')+"</span> / 3   <span style=\'color: #c4c4c4\'>Cavablar</span>");
          $('#neticeTime').html(20-getcookie('minutes')+'<span style=\'color: #c4c4c4\'> Deqiqeye bitirdiniz(~)</span>');
          setTimeout(function () {
            deletecookie('bal');
            deletecookie('sual');
            deletecookie('minutes');
            deletecookie('secs');
            //location.reload();
          }, 100);
        }, 300);
      }
    });
    $('.variant').bind('click',function () {
    $(".variant").css({ "background-color" : "","color" : "",'box-shadow': 'none'});
    $(this).css({ "background-color" : "#2c3e50","color" : "white", 'box-shadow': '5px 5px 5px rgba(138,138,138,.76)'});
    });
    $("#sualdiv").hide();
    $("#sualdiv").fadeIn(1000);
  }
  //Burada Yoxlayiriq eger sual sual saisindan azdirsa gosteririk yeni eger 3 sual olarsa +1 gelib yoxlayiriq
  if (sual < 4) {
    $.ajax({
      type: 'post',
      url: 'templates/imtahanconnecting.php',
      data: ({sual: sual,imtahan: $_GET['imtahan']}),
      dataType:"html",
      success: ajaxFunc
    });
  }
  function ajaxStart(cavab){
    sual = getcookie('sual');
    sual++;
    setcookie('sual',sual,'/');
    $.ajax({
      type: 'post',
      url: 'templates/imtahanconnecting.php',
      data: ({sual: sual,imtahan: $_GET['imtahan'],cavab: cavab}),
      dataType:"html",
      success: ajaxFunc
    });
  }
  });
</script>
<div id="imtahancontentwrapper">
  <aside>
    <div id="sual">
    </div>
    <p id="times"></p>
					<img id="warning" style="display:none;" src="images/warningg.png">
					<img id="error" style="display:none;" src="images/error.png">
					<img id="success" style="display:none;" src="images/success.png">
      <p style="text-align:center; display: none" id="netice">İmtahanın nəticəsi</p>
      <p style="font-size:1.4em;" id="neticehakkinda"></p>
      <p style="text-align:center;margin-top:0.6%;" id="neticeBal"></p>
      <p style="text-align:center;margin-top:0.6%;" id="neticeTime"></p>
  </aside>
</div>
