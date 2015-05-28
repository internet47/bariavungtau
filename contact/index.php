<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>お問い合わせフォーム ｜バリア・ブンタウ省進出完全ガイド ～バリア・ブンタウ省公式日本語版サイト～</title>
<meta name="Keywords" content="ベトナム,進出,海外進出,日本企業,工場,バリア・ブンタウ,工業団地,誘致企業" />
<meta name="Description" content="page title | ベトナム南部最大の工業区、バリア・ブンタウ省公式日本語版サイト。「バリアブンタウ省進出支援 日本事務所」が運営し、進出希望の日本企業を全面的にサポートします。" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<!-- *** stylesheet *** -->
<link href="../css/styles.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="../css/lightbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/prettyPhoto2.css" type="text/css" media="screen" />

<!-- *** javascript *** -->
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/rollover.min.js" type="text/javascript"></script>
<script src="../js/current.js" type="text/javascript"></script>
<script src="../js/page-scroller.js" type="text/javascript"></script>
<script src="../js/jquery.dropdown.js" type="text/javascript"></script>
<script type="application/javascript" src="../js/jquery-1.8.3.js"></script>
<script>
	$(document).ready(function(e) {
		 $("#loading").hide();
		
		 $("#loading").ajaxStart(function () {
				$(this).css({
						  display:"block",
						  position: 'absolute',
						  right: "50%",
						  top: "50%"
					 });	
				$(this).show();
				});

		$("#loading").ajaxStop(function () {
					$(this).hide();
				});
		
		
		$("#send").click(function(e) {
			//e.preventDefault();
            var name = $("#name").val();
			var email = $("#email").val();
			var email_confirm = $("#email_confirm").val();
			var company = $("#company").val();
			var fax = $("#fax").val();
			var phone = $("#phone").val();
			var type = $("#type").val();
			var position = $("#position").val();
			var message = $("#message").val();
			
			if (name =="")
				{	
				if ($("span.red1").length <= 0)
					{$("#name").after("<span class='red1'>お名前が未入力です。</span>");$("#name").focus();}
				}
			else
				$("span.red1").remove();
			
			
			if (email =="" || email != email_confirm)
				{
				if ($("span.red2").length <= 0)
					{$("#email_confirm").after("<span class='red2'>メールアドレスが未入力です。</span>");}
				}
			else
				$("span.red2").remove();
				
			if (company =="")
				{	
				if ($("span.red3").length <= 0)
					{$("#company").after("<span class='red3'>会社名が未入力です。</span>");$("#company").focus();}
				}
			else
				$("span.red3").remove();	
				
				
			if (type =="")
				{	
				if ($("span.red4").length <= 0)
					{$("#type").after("<span class='red4'>業種が未入力です。</span>");$("#type").focus();}
				}
			else
				$("span.red4").remove();	
				
			if (position =="")
				{	
				if ($("span.red5").length <= 0)
					{$("#position").after("<span class='red5'>役職が未入力です。</span>");$("#position").focus();}
				}
			else
				$("span.red5").remove();	
			
			if (message =="")
				{	
				if ($("span.red6").length <= 0)
					{$("#message").after("<span class='red6'>内容が未入力です。</span>");$("#message").focus();}
				}
			else
				$("span.red6").remove();	
			
			
			if ($("span.red1, span.red2, span.red3, span.red4, span.red5, span.red6").length >0)			
				return false;	
			else
				return true;
			
			
        });//end send 
		
		
		
		///////////////////////////////////////////////////////
		$("#fax").click(function(e) {
            $(this).val('');
        });
		
		$("#fax").blur(function(e) {
			var no = $(this).val();
			if (no =="")
           	 	$(this).val('0000-00-0000');
			else
				{
				if (!checkFax(no))	
					{alert("FAX 番号を見本の通り記入してください。");
					 $(this).val('0000-00-0000');
					}
				}
        });//end blur
		
		
		///////////////////////////////////////////////////////
		$("#phone").click(function(e) {
            $(this).val('');
        });
		
		$("#phone").blur(function(e) {
            var no = $(this).val();
			if (no =="")
           	 $(this).val('0000-00-0000');
			 else
				{
				if (!checkFax(no))	
					{alert("電話番号を見本の通り記入してください。");
					 $(this).val('0000-00-0000');
					}
				}
        });
		
		////////////////
		$("#email").blur(function(e) {
			 	 var email = $("#email").val();
				 if (!checkEmail(email))
				 {
				 	alert("メールアドレスに誤りがあります。");
					$(this).val('');
					$("#email").focus();
					return false;
				 }
        });//end blur
		///////////////////
		$("#email_confirm").blur(function(e) {
			 	 var email_confirm = $("#email_confirm").val();
				 if (!checkEmail(email_confirm))
				 {
				 	alert("メールアドレスに誤りがあります。");
					$(this).val('');
					$("#email_confirm").focus();
					return false;
				 }
        });//end blur
		
		
    });//end ready
	
	
	
	
	
function checkFax(number)
	{
		var par=/^([0-9]){4}-([0-9]){2}-([0-9]){4}$/;
		return par.test(number);
	}//end checkfax	
	
function checkEmail(email)
	{
		var par=/^([a-z0-9\._-]+)@([a-z0-9-]+)\.(([a-z0-9])+)\.?([a-z0-9]){2,6}?$/;
		return par.test(email);
	}//end checkEmail
	
	
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35961890-4']);
  _gaq.push(['_setDomainName', 'baria-vungtau.gov.vn']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<style>
.red1, .red2 , .red3 , .red4 , .red5 , .red6
{
color: red;
}
</style>

</head>

<body id="mail">
<div id="wrapper">
  <div id="header">
    <h1>お問い合わせフォーム ｜バリア・ブンタウ省進出完全ガイド ～バリア・ブンタウ省公式日本語版サイト～</h1>
    <div id="logo">
      <p><a href="http://jp.baria-vungtau.gov.vn/"><img src="../images/logo.jpg" width="635" height="106" alt="バリア・ブンタウ省進出完全ガイド" /></a></p>
      <ul>
        <li><img src="../images/tel.jpg" width="238" height="50" alt="(84)-64-385-0019 毎日:07：30～16：30" /></li>
        <li><a href="index.php"><img src="../images/b_mail_off.jpg" alt="お問い合わせはこちらから" width="238" height="50" border="0" /></a></li>
      </ul>
    </div>
    <div id="globalNav" class="clearfix">
      <ul class="global-navi">
        <li><a href="http://jp.baria-vungtau.gov.vn/"><img src="../images/b_navi01_off.jpg" width="144" height="47" alt="トップページ" /></a></li>
        <li><a href="../news.html"><img src="../images/b_navi02_off.jpg" width="119" height="47" alt="更新情報 " /></a>
          <ul>
            <li><a href="../gallery.html">写真・動画集</a></li>
          </ul>
        </li>
        <li><img src="../images/b_navi03_off.jpg" width="123" height="47" alt="基本情報" />
          <ul>
            <li><a href="../infobaria/greeting.html">ご挨拶（委員長）</a></li>
            <li><a href="../infobaria/access.html">アクセス（地図、行き方）</a></li>
            <li><a href="../infobaria/history_baria.html">バリア･ブンタウ省の歴史</a></li>
            <li><a href="../infobaria/index.html">地理位置、気候、経済発展状況</a></li>
            <li><a href="../partner.html">パートナーリンク</a></li>
          </ul>
        </li>
        <li><a href="../industry/index.html"><img src="../images/b_navi04_off.jpg" width="154" height="47" alt="工業団地情報" /></a></li>
        <li><a href="../living_information.html"><img src="../images/b_navi05_off.jpg" width="123" height="47" alt="生活情報" /></a></li>
        <li><img src="../images/b_navi06_off.jpg" width="191" height="47" alt="投資環境について" />
          <ul class="global-navi">
            <li><a href="../investment/investor_attraction.html">企業誘致のご案内</a></li>
            <li><a href="../investment/policy.html">優遇政策</a></li>
            <li><a href="../investment/infrastructure.html">バリア・ブンタウ省への企業の進出メリット</a></li>
            <li><a href="../investment/invesment_process.html">投資プロセス</a></li>
            <li><a href="../investment/japanese_list.html">進出日系企業一覧</a></li>
          </ul>
        </li>
        <li><a href="../faq.html"><img src="../images/b_navi07_off.jpg" width="141" height="47" alt="よくある質問" /></a></li>
      </ul>
    </div>
    <!-- / #header --></div>
  <div id="wrap_content">
    <div id="main" class="cf">
      <div class="main_img">
        <h2><img src="../images/h2_contact.jpg" width="975" height="193" alt="お問い合わせフォーム" /></h2>
      </div>
      <div class="pathway"><a href="http://jp.baria-vungtau.gov.vn/">バリア・ブンタウ省進出完全ガイド</a> &nbsp;&gt;&gt;&nbsp;お問い合わせフォーム </div>
      <div id="content">
                <p><a href="http://jp.baria-vungtau.gov.vn/rule.html"><img src="../images/b_rule_off.jpg" width="725" height="83" alt="利用規約／個人情報の取扱いについて" /></a></p>

        <h3><img src="../images/h3_fmail.jpg" width="725" height="116" alt="お問い合わせフォーム" /></h3>
        <div class="box01">
        
        
        
        <?php
		//echo $_SERVER['REQUEST_METHOD'];
		
			/*			
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				//Here we parse the form
				if(!isset($_SESSION['csrf']) || $_SESSION['csrf'] !== $_POST['csrf'])
					throw new RuntimeException('CSRF attack');
			 
				//Do the rest of the processing here
			}*/
			 
			//Generate a key, print a form:
			$key = sha1(microtime());
			$_SESSION['key'] = $key;
			$token = $key;
			
		?>
        <!-- confirmmail.php?token=<php echo $token ?-->
        <form method="post" enctype="multipart/form-data" action="confirmmail.php?token=<?php echo $token ?>" name="form_mail" id="form">
<table width="70%" cellpadding="10" cellspacing="10" border="1">
<col class="col1" />
<col class="col2" />
<tbody>
<tr>
	<th>お名前<img src="../images/mfp_must.gif" width="30" height="16" alt="必須" /></th>
    <td><input type="text" name="name" id="name" value="" /></td>
</tr>
<tr>
	<th>メールアドレス<img src="../images/mfp_must.gif" width="30" height="16" alt="必須" /></th>
    <td><p class="green">（※半角英数字でご記入ください）</p>
      <p><input type="text" name="email" id="email"  value=""  /></p>
      <p class="green">※確認のため、再度入力してください</p>
      <p><input type="text" name="email_confirm" id="email_confirm" value="" /></p>
      </td>
      
</tr>

<tr>
	<th>会社名<img src="../images/mfp_must.gif" width="30" height="16" alt="必須" /></th>
    <td><input type="text" name="company" id="company" value=""/></td>
</tr>

<tr>
	<th>住所</th>
    <td><input type="text" name="address" id="address" value="" /></td>
</tr>

<tr>
	<th>電話番号</th>
    <td><input type="text" name="phone" id="phone"  value="0000-00-0000" /></td>
</tr>

<tr>
	<th>FAX番号</th>
    <td><input type="text" name="fax" id="fax"  value="0000-00-0000" /></td>
</tr>

<tr>
	<th>会社のURL</th>
    <td><input type="text" name="url" id="url"  value="http://" /></td>
</tr>

<tr>
	<th>業種<img src="../images/mfp_must.gif" width="30" height="16" alt="必須" /></th>
    <td><input type="text" name="type" id="type" value="" /></td>
</tr>

<tr>
	<th>役職<img src="../images/mfp_must.gif" width="30" height="16" alt="必須" /></th>
    <td><input type="text" name="position" id="position"  value="" /></td>
</tr>

<tr>
	<th>内容<img src="../images/mfp_must.gif" width="30" height="16" alt="必須" /></th>
    <td><textarea name="message" cols="30" rows="10" id="message"></textarea></td>
</tr>

</tbody>
</table>

<p class="center"><input type="submit" name="submit" value="確認画面へ進む" id="send" /></p>
<input type="hidden" name="csrf" value="<?php echo $key; ?>" />
</form>
        
        </div>
        <!-- / #content --></div>
      <div id="nav">
        <div class="box_snavi_orang">
          <p class="mb05"><img src="../images/title_snavi.jpg" width="234" height="40" alt="基本情報" /></p>
          <ul>
            <li><a href="../infobaria/greeting.html"><img src="../images/b_snavi01_off.jpg" width="234" height="55" alt="ご挨拶（委員長）" /></a></li>
            <li><a href="../infobaria/access.html"><img src="../images/b_snavi02_off.jpg" width="234" height="55" alt="アクセス（地図、行き方）" /></a></li>
            <li><a href="../infobaria/history_baria.html"><img src="../images/b_snavi03_off.jpg" width="234" height="55" alt="バリア･ブンタウ省の歴史" /></a></li>
            <li><a href="../infobaria/index.html"><img src="../images/b_snavi04_off.jpg" width="234" height="55" alt="地理位置、気候、経済発展状況" /></a></li>
          </ul>
        </div>
        <div class="box_snavi_black">
          <p class="mb05"><img src="../images/title_snavi-06.jpg" width="234" height="40" alt="投資環境について" /></p>
          <ul>
            <li><a href="../investment/investor_attraction.html"><img src="../images/b_snavi05_off.jpg" width="234" height="55" alt="企業誘致のご案内" /></a></li>
            <li><a href="../investment/policy.html"><img src="../images/b_snavi06_off.jpg" width="234" height="55" alt="優遇政策" /></a></li>
            <li><a href="../investment/infrastructure.html"><img src="../images/b_snavi07_off.jpg" width="234" height="55" alt="バリア・ブンタウ省への企業の進出メリット"/></a></li>
            <li><a href="../investment/invesment_process.html"><img src="../images/b_snavi15_off.jpg" width="234" height="55" alt="投資プロセス" /></a></li>
            <li><a href="../investment/japanese_list.html"><img src="../images/b_snavi16_off.jpg" width="234" height="55" alt="進出日系企業一覧" /></a></li>
          </ul>
         </div>
        <div class="box_snavi_exchange">
          <p class="mb05"><img src="../images/title_snavi-08.jpg" width="234" height="40" alt="menu" /></p>
          <ul>
            <li><a href="../industry/index.html"><img src="../images/b_snavi09_off.jpg" width="234" height="41" alt="工業団地マップ" /></a></li>
            <li><a href="../living_information.html"><img src="../images/b_snavi08_off.jpg" width="234" height="41" alt="生活情報マップ" /></a></li>
            <li><a href="../gallery.html"><img src="../images/b_snavi10_off.jpg" width="234" height="41" alt="写真・動画集" /></a></li>
            <li><a href="../faq.html"><img src="../images/b_snavi11_off.jpg" width="234" height="41" alt="よくある質問" /></a></li>
            <li><a href="../partner.html"><img src="../images/b_snavi12_off.jpg" width="234" height="41" alt="パートナーリンク" /></a></li>
            <li><a href="index.php"><img src="../images/b_snavi13_off.jpg" width="234" height="41" alt="お問い合わせフォーム" /></a></li>
            <li><a href="../sitemap.html"><img src="../images/b_snavi14_off.jpg" width="234" height="41" alt="サイトマップ" /></a></li>
          </ul>
        </div>
        <!--        <p><a href="http://www.forval-vietnam.com/" target="_blank"><img src="images/banner_snavi_01.jpg" width="240" height="90" alt=" " /></a></p>
        <p><a href="http://www.forval.co.jp" target="_blank"><img src="images/banner_snavi_02.jpg" width="240" height="90" alt=" " /></a></p>
-->
        <div class="box_snavi_exchange">
          <p><img src="../images/img_exchange.jpg" width="234" height="40" alt="為替レート" /></p>
          <script src="http://vnexpress.net/Service/Forex_Content.js" type="text/javascript" language="javascript"></script> <script>
                $(document).ready(function(e) {
                    var a = vForexs[0];
                    var b = vCosts[0];
					b =b.replace(".", ",")
                    $("#USD").text(a);
                    $("#VCODE").text(b);
                    
                    var j = vForexs[4];
                    var jv = vCosts[4];
                    
                    $("#JPY").text(j);
                    $("#JPVCODE").text(jv);
                    
                
                });
                </script>
          <dl>
            <dt><strong><span id="USD"></span></strong></dt>
            <dd><span id="VCODE"></span></dd>
          </dl>
          <dl class="clearfix">
            <dt><strong><span id="JPY"></span></strong></dt>
            <dd><span id="JPVCODE"></span></dd>
          </dl>
          <div class="right"> 参照元<img src="../images/logo-EXIM-2.gif" alt="" title="" /></div>
        </div>
        <!-- / #nav --></div>
      
      <!-- / #main --></div>
  </div>
  <div id="footer">
    <p class="pagetop"><a href="#header"><img src="../images/b_page_top_off.jpg" alt="トップへ" /></a></p>
    <div id="footer_link">
      <ul>
        <li class="title_home"><a href="http://jp.baria-vungtau.gov.vn/">TOPページ</a> </li>
        <li><a href="../news.html">更新情報</a></li>
        <li><a href="../living_information.html">生活情報</a></li>
        <li><a href="../gallery.html">写真・動画集</a></li>
        <li><a href="../faq.html">よくある質問</a></li>
        <li><a href="../partner.html">パートナーリンク</a></li>
        <li><a href="../rule.html">利用規約／個人情報の取扱いについて</a></li>
        <li><a href="index.php">お問い合わせ</a></li>
        <li><a href="../sitemap.html">サイトマップ</a></li>
      </ul>
      <ul>
        <li class="title_under">基本情報</li>
        <li><a href="../infobaria/greeting.html">ご挨拶（委員長）</a></li>
        <li><a href="../infobaria/access.html">アクセス（地図、行き方）</a></li>
        <li><a href="../infobaria/history_baria.html">バリア・ブンタウ省の歴史</a></li>
        <li><a href="../infobaria/index.html">地理位置、気候、経済発展状況</a></li>
      </ul>
      <ul>
        <li class="title_under">工業団地情報</li>
        <li><a href="../industry/phumy3_industry.html">フーミー III工業団地</a></li>
        <li><a href="../industry/dabac_industry.html">ダバク日本企業専用工業団地</a></li>
        <li><a href="../industry/daiduong_industry.html">ミスアンB1 ダイズン工業団地</a></li>
        <li><a href="../industry/tienhung_industry.html">ミスアンB1ティエンフン工業団地</a></li>
        <li><a href="../industry/index.html">その他の工業団地一覧</a></li>
      </ul>
      <ul class="last">
        <li class="title_under">投資環境について</li>
        <li><a href="../investment/investor_attraction.html">企業誘致のご案内</a></li>
        <li><a href="../investment/policy.html">優遇政策</a></li>
        <li><a href="../investment/infrastructure.html">バリア・ブンタウ省への企業の進出メリット</a></li>
        <li><a href="../investment/invesment_process.html">投資プロセス</a></li>
        <li><a href="../investment/japanese_list.html">進出日系企業一覧</a></li>
      </ul>
    </div>
    <address id="copyright" class="clearfix">
    Copyright©2013 バリア・ブンタウ省進出支援 日本事務所 All Rights Reserved.
    </address>
    
    <!-- / #footer --></div>
  
  <!-- / #wrapper --></div>
</body>
</html>