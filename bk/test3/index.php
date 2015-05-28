<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>バリア・ブンタウ省進出完全ガイド</title>
<meta name="Keywords" content="#" />
<meta name="Description" content="#" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<!-- *** stylesheet *** -->
<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
<!-- *** javascript *** -->
<script src="js/jquery-1.8.3.js" type="text/javascript"></script>
<script src="js/rollover.min.js" type="text/javascript"></script>
<script src="js/current.js" type="text/javascript"></script>
<script src="js/page-scroller.js" type="text/javascript"></script>
<script src="js/jquery.dropdown.js" type="text/javascript"></script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<!-- Google Analytics start -->

<script type="text/javascript">
$(document).ready(function(e) {
	list();
});//end ready

function list()		
{
		var limit = 4;
		var i=0;
		$.ajax({url: "admin/data/news.xml", cache:false}).done(function(data)
		{
				$(data).find("New").each(function()
				{		
					if(i > limit) return false;
					var no= $(this).find("no").text();
					var title= $(this).find("title").text();
					var short= $(this).find("short").text();
					var long= $(this).find("long").text();
					var image= $(this).find("image").text();
					var dateposted= $(this).find("dateposted").text();
					var myarr = dateposted.split(' ');
					var dateposted = myarr[0];
					var dmy = dateposted.split('/');
					var d = dmy[0];
					var m = dmy[1];
					var y = dmy[2];
					var dateposted = y+'/'+m+'/'+d;
					


				    var elem = ('<dl><dt><img src="admin/image/'+image+'" width="93" height="59" alt="'+title+'" /></dt><dd class="text_t"><a href="detailnew-'+no+'.html">'+title+'</a><dd class="dateposted">'+dateposted+'</dt><dd class="detail"><a href="detailnew-'+no+'.html"><img src="images/b_detail_off.jpg" width="113" height="17" alt="詳細情報を見る" class="details" /></a></dd></dl>');

				$(".n_boxRight").append(elem);//thêm dữ liệu vào bảng bên dưới
				
					i++;
				});//end New	
					
				var p= ('<p class="news_hist"><a href="news.html"><img src="images/b_index01_off.jpg" width="195" height="41" alt="過去の記事をもっと見る" /></a></p>');
				
				$(".n_boxRight").append(p);//thêm dữ liệu vào bảng bên dưới		
		});//end done
		
}
</script>

</head>
<body id="indexPage">
<div id="wrapper">
  <div id="header">
    <h1>バリア・ブンタウ省進出完全ガイド</h1>
    <div id="logo">
      <p><img src="images/logo.jpg" width="635" height="106" alt="バリア・ブンタウ省進出完全ガイド" /></p>
      <ul>
        <li><img src="images/tel.jpg" width="238" height="50" alt="(84)-064-000-000 毎日:08：00AM～17：00PM" /></li>
        <li><a href="fmail/fmail.cgi"><img src="images/b_mail_off.jpg" width="238" height="50" alt="メールでお問い合わせはこちらから" /></a></li>
      </ul>
    </div>
    <div id="globalNav" class="clearfix">
      <ul class="global-navi">
        <li><a href="./"><img src="images/b_navi01_off.jpg" width="144" height="47" alt="トップページ" /></a></li>
        <li><a href="news.html"><img src="images/b_navi02_off.jpg" width="119" height="47" alt="更新情報 " /></a>
         <ul>
            <li><a href="gallery.html">写真・動画集</a></li>
          </ul>
        
        </li>
        <li><img src="images/b_navi03_off.jpg" width="123" height="47" alt="基本情報" />
          <ul>
            <li><a href="infobaria/greeting.html">ご挨拶（委員長）</a></li>
            <li><a href="infobaria/access.html">アクセス（地図、行き方）</a></li>
            <li><a href="infobaria/history_baria.html">バリア･ブンタウ省の歴史</a></li>
            <li><a href="infobaria/index.html">地理位置、気候、経済発展状況</a></li>
            <li><a href="partner.html">パートナーリンク</a></li>
          </ul>
        </li>
        <li><a href="industry/index.html"><img src="images/b_navi04_off.jpg" width="154" height="47" alt="工業団地情報" /></a></li>
        <li><a href="living_information.html"><img src="images/b_navi05_off.jpg" width="123" height="47" alt="生活情報" /></a></li>
        <li><img src="images/b_navi06_off.jpg" width="191" height="47" alt="投資環境について" />
          <ul class="global-navi">
            <li><a href="investment/investor_attraction.html">企業誘致のご案内</a></li>
            <li><a href="investment/policy.html">優遇政策</a></li>
            <li><a href="investment/infrastructure.html">バリア・ブンタウ省への企業の進出メリット</a></li>
            <li><a href="investment/invesment_process.html">投資プロセス</a></li>
            <li><a href="investment/japanese_list.html">進出日系企業一覧</a></li>
          </ul>
        </li>
        <li><a href="faq.html"><img src="images/b_navi07_off.jpg" width="141" height="47" alt="よくある質問" /></a></li>
      </ul>
    </div>
    <!-- / #header --></div>
  <div id="wrap_content">
    <div id="main" class="cf">
      <div class="main_img">
        <h2><img src="images/main_img.jpg" width="970" height="368" alt="日系企業海外進出のラストフロンティア、ベトナム南部最大の工業区" /></h2>
      </div>
      <div id="content">
        <h3><img src="images/index_h3.jpg" width="725" height="49" alt="更新情報" /></h3>
        <div id="News">
          <div class="n_boxLeft">
            <dl>
              <dt>
                <? 
			    $arr= array();
				$xml = simplexml_load_file("admin/data/news.xml") or die("Can not insert data to XML file. Please check permission on folder Data. thks: Cannot create object");
				foreach($xml->children() as $Positions)
				{
					foreach($Positions->children() as $Position => $data)
					{
						 $no = (string) $data->no;
						 array_push($arr,$no);
					}
				}//end foreach
						$top =  max($arr); // trả về số lớn nhất
		 
			$xml = simplexml_load_file("admin/data/news.xml") or die("Error: Cannot load file xml"); 	
			foreach($xml->children() as $Positions)
			{
				foreach($Positions->children() as $Position => $data)
				{
					  $no_inxml = $data->no;
					if ($no_inxml==$top) 
					{
					  $title= $data->title;
					  $short= $data->short;
					  $long= $data->long;
					  $image = $data->image;
					  $dateposted = $data->dateposted;

					 echo '<img src="admin/image/'.$image.'" width="380" height="252" alt="'.$title.'" />';
					 echo '</dt>';
             echo  '<dd><span class="title_news"><a href="detailnew-'.$no.'.html">'.$title.'</a></span><br />'.$short.'';
					}
				}
			}//end foreach
			  ?>
            </dl>
          </div>
          <div class="n_boxRight"> </div>
        </div>
        <h3><img src="images/index_h3-07.jpg" width="725" height="49" alt="バリア・ブンタウ省便利マップ" /></h3>
        <div class="cont">
          <p class="fleft"><a href="industry/index.html"><img src="images/banner_index01_off.jpg" width="352" height="99" alt="工業団地マップ" /></a></p>
          <p class="fright"><img src="images/banner_index02_off.jpg" width="352" height="99" alt="生活情報マップ" /></p>
        </div>
        <h3><img src="images/index_h3-09.jpg" width="725" height="49" alt="バリア・ブンタウ省紹介ムービー（日本語ナレーション、約11分）" /></h3>
        <div class="box01">バリア・ブンタウ省の立地、環境、産業、進出済みの日系企業へのインタビュー等をご紹介しています。
          ベトナム南部最大の工業区であり、ビジネス・住環境はもとより、美しい森林や海など豊かな自然に囲まれ、ベトナムを代表する観光地でもある私たちの省について、ご理解頂けると思います。
          是非、一度、ご覧ください。</div>
        <div class="box_video mb20">
         <div id="flashContent">
           <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="720" height="540" id="FLVPlayer">
             <param name="movie" value="FLVPlayer_Progressive.swf" />
             <param name="quality" value="high">
             <param name="wmode" value="opaque">
             <param name="scale" value="noscale">
             <param name="salign" value="lt">
             <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Corona_Skin_2&amp;streamName=PhimVungTau&amp;autoPlay=false&amp;autoRewind=false" />
             <param name="swfversion" value="8,0,0,0">
             <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
             <param name="expressinstall" value="Scripts/expressInstall.swf">
             <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
             <!--[if !IE]>-->
             <object type="application/x-shockwave-flash" data="FLVPlayer_Progressive.swf" width="720" height="540">
               <!--<![endif]-->
               <param name="quality" value="high">
               <param name="wmode" value="opaque">
               <param name="scale" value="noscale">
               <param name="salign" value="lt">
               <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Corona_Skin_2&amp;streamName=PhimVungTau&amp;autoPlay=false&amp;autoRewind=false" />
               <param name="swfversion" value="8,0,0,0">
               <param name="expressinstall" value="Scripts/expressInstall.swf">
               <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
               <div>
                 <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                 <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
               </div>
               <!--[if !IE]>-->
             </object>
             <!--<![endif]-->
           </object>
         </div>
        
        
         <!--<iframe width="720" height="540" src="http://www.youtube-nocookie.com/embed/BXSqzLV1zZ4" frameborder="0" allowfullscreen></iframe> --> </div>
        
        <!-- / #content --></div>
      <div id="nav">
        
        <div class="box_snavi_orang">
          <p class="mb05"><img src="images/title_snavi.jpg" width="234" height="40" alt="基本情報" /></p>
          <ul>
            <li><a href="infobaria/greeting.html"><img src="images/b_snavi01_off.jpg" width="234" height="55" alt="ご挨拶（委員長）" /></a></li>
            <li><a href="infobaria/access.html"><img src="images/b_snavi02_off.jpg" width="234" height="55" alt="アクセス（地図、行き方）" /></a></li>
            <li><a href="infobaria/history_baria.html"><img src="images/b_snavi03_off.jpg" width="234" height="55" alt="バリア･ブンタウ省の歴史" /></a></li>
            <li><a href="infobaria/index.html"><img src="images/b_snavi04_off.jpg" width="234" height="55" alt="地理位置、気候、経済発展状況" /></a></li>
          </ul>
        </div>
        <div class="box_snavi_black">
          <p class="mb05"><img src="images/title_snavi-06.jpg" width="234" height="40" alt="投資環境について" /></p>
           <ul>
            <li><a href="investment/investor_attraction.html"><img src="images/b_snavi05_off.jpg" width="234" height="55" alt="企業誘致のご案内" /></a></li>
            <li><a href="investment/policy.html"><img src="images/b_snavi06_off.jpg" width="234" height="55" alt="優遇政策" /></a></li>
            <li><a href="investment/infrastructure.html"><img src="images/b_snavi07_off.jpg" width="234" height="55" alt="バリア・ブンタウ省への企業の進出メリット"/></a></li>
            <li><a href="investment/invesment_process.html"><img src="images/b_snavi15_off.jpg" width="234" height="55" alt="投資プロセス" /></a></li>
            <li><a href="investment/japanese_list.html"><img src="images/b_snavi16_off.jpg" width="234" height="55" alt="進出日系企業一覧" /></a></li>
          </ul>
        </div>
        <div class="box_snavi_blue">
          <p class="mb05"><img src="images/title_snavi-08.jpg" width="234" height="40" alt="投資環境について" /></p>
          <ul>
            <li><a href="living_information.html"><img src="images/b_snavi08_off.jpg" width="234" height="41" alt="生活情報マップ" /></a></li>
            <li><a href="industry/index.html"><img src="images/b_snavi09_off.jpg" width="234" height="41" alt="工業団地マップ" /></a></li>
            <li><a href="gallery.html"><img src="images/b_snavi10_off.jpg" width="234" height="41" alt="写真・動画集" /></a></li>
            <li><a href="faq.html"><img src="images/b_snavi11_off.jpg" width="234" height="41" alt="よくある質問" /></a></li>
            <li><a href="partner.html"><img src="images/b_snavi12_off.jpg" width="234" height="41" alt="パートナーリンク" /></a></li>            <li><a href="fmail/fmail.cgi"><img src="images/b_snavi13_off.jpg" width="234" height="41" alt="お問い合わせフォーム" /></a></li>
<li><a href="sitemap.html"><img src="images/b_snavi14_off.jpg" width="234" height="41" alt="サイトマップ" /></a></li>
          </ul>
        </div>
        <div class="box_snavi_exchange">          <p><img src="images/img_exchange.jpg" width="234" height="40" alt="為替レート" /></p>
<script src="http://vnexpress.net/Service/Forex_Content.js" type="text/javascript" language="javascript"></script> 
          <script>
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
          <div class="right"> 参照元<img src="images/logo-EXIM-2.gif" alt="" title="" /></div> </div>
        <!-- / #nav --></div>
      
      <!-- / #main --></div>
  </div>
  <div id="footer">
    <p class="pagetop"><a href="#header"><img src="images/b_page_top_off.jpg" alt="トップへ" /></a></p>
    <div id="footer_link">
      <ul>
        <li class="title_home"><a href="#">TOPページ</a> </li>
        <li><a href="news.html">更新情報</a></li>
        <li><a href="living_information.html">生活情報</a></li>
        <li><a href="gallery.html">写真・動画集</a></li>
        <li><a href="faq.html">よくある質問</a></li>
        <li><a href="partner.html">パートナーリンク</a></li>
        <li><a href="rule.html">利用規約／個人情報の取扱いについて</a></li>        <li><a href="fmail/fmail.cgi">お問い合わせ</a></li>
<li><a href="sitemap.html">サイトマップ</a></li>
      </ul>
      <ul>
        <li class="title_under">基本情報</li>
        <li><a href="infobaria/greeting.html">ご挨拶（委員長）</a></li>
        <li><a href="infobaria/access.html">アクセス（地図、行き方）</a></li>
        <li><a href="infobaria/history_baria.html">バリア・ブンタウ省の歴史</a></li>
        <li><a href="infobaria/index.html">地理位置、気候、経済発展状況</a></li>
      </ul>      <ul>
        <li class="title_under">工業団地情報</li>
        <li><a href="industry/phumy3_industry.html">フーミー III工業団地</a></li>
        <li><a href="industry/dabac_industry.html">ダバク日本企業専用工業団地</a></li>
        <li><a href="industry/daiduong_industry.html">ミスアンB1 ダイズン工業団地</a></li>
        <li><a href="industry/tienhung_industry.html">ミスアンB1ティエンフン工業団地</a></li>
        <li><a href="industry/index.html">その他の工業団地一覧</a></li>
      </ul>

      <ul class="last">
        <li class="title_under">投資環境について</li>
        <li><a href="investment/investor_attraction.html">企業誘致のご案内</a></li>
        <li><a href="investment/policy.html">優遇政策</a></li>
        <li><a href="investment/infrastructure.html">バリア・ブンタウ省への企業の進出メリット</a></li>
        <li><a href="investment/invesment_process.html">投資プロセス</a></li>
        <li><a href="investment/japanese_list.html">進出日系企業一覧</a></li>
      </ul>
    </div>    <address id="copyright" class="clearfix">Copyright©2013 バリア・ブンタウ省進出支援 日本事務所 All Rights Reserved.</address>
<!-- / #footer --></div>
  
  <!-- / #wrapper --></div>

<script type="text/javascript">
<!--
//
swfobject.registerObject("FlashID");
swfobject.registerObject("FLVPlayer");
//-->
</script> 
<!-- FS Conversion Analyzer end -->
</body>
</html>