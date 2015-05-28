<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>更新情報 ｜バリア・ブンタウ省進出完全ガイド ～バリア・ブンタウ省公式日本語版サイト～</title>
<meta name="Keywords" content="ベトナム,進出,海外進出,日本企業,工場,バリア・ブンタウ,工業団地,誘致企業" />
<meta name="Description" content="更新情報 | ベトナム南部最大の工業区、バリア・ブンタウ省公式日本語版サイト。「バリアブンタウ省進出支援 日本事務所」が運営し、進出希望の日本企業を全面的にサポートします。" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<!-- *** stylesheet *** -->
<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/prettyPhoto2.css" type="text/css" media="screen" />
<style>
.disabled {
 opacity: 0.5 pointer-events: none cursor: default
}
</style>
<!-- *** javascript *** -->
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/rollover.min.js" type="text/javascript"></script>
<script src="js/current.js" type="text/javascript"></script>
<script src="js/page-scroller.js" type="text/javascript"></script>
<script src="js/jquery.dropdown.js" type="text/javascript"></script>
<script>
$(document).ready(function(e) {
	$(".box_news dl").remove();// khu vuc xuat hien data can xoa
	list_page(0,7);
	paging(8);//lay 10 tin
	
});



function paging(number_topic)
{
$.ajax({url: "admin/data/news.xml", cache:false}).done(function(data)
		{	
				
				var Total=$(data).find("New").size();	
				var page =Math.ceil(Total/number_topic);
				
				for (var i=0; i< page; i++)
				{
					var mot = i*number_topic;
					var hai = (mot+number_topic);
					var p = i+1;
					$(".paging").append('&nbsp;<a href="#" data1="'+mot+'" data2="'+hai+'" class="getstep">'+p+'</a> ');
				}
				
				$(".getstep").click(function() 
					{
					$(this).removeAttr("href");
					$(this).css("text-decoration","none");
					
					$(".getstep").not(this).attr("href","#").css("text-decoration","underline");
					
					var num1 = $(this).attr("data1");
					var num2 = $(this).attr("data2");
					
					$("#NoSlide").attr({"data1":num1,"data2":num2});// get two val from click and tranfer it to "next".
					
					$(".box_news dl").remove();

					list_page(num1,num2);
                	});
					
				$(".getstep").eq(0).attr("href","#").css("text-decoration","none");
				$('#NoSlide').attr({"data1":"0","data2":"7"}); //khai báo mặc định.
				
				
				$(".rightforward").click(function() //NEXT
					{
                   var num1 =parseInt($("#NoSlide").attr("data1")); //đọc giá trị từ hidden put
				   var num2 = parseInt($("#NoSlide").attr("data2"));
					$(".box_news dl").remove();
					num1 = num1 + number_topic;
					num2 = num2 + number_topic;
					
					list_page(num1,num2);
					$("#NoSlide").attr({"data1":num1,"data2":num2});
					
					$(".getstep").each(function(data) //tim thuoc tinh = so num1
					{
						var ok = $(this).attr("data1")
						if (ok == num1)
						{
							$(this).attr("href","#").css("text-decoration","none");
						}
						else
						{
							$(this).attr("href","#").css("text-decoration","underline");
						} 
                    });
	            });//end rightforward
				
				
				$(".leftback").click(function() //REVIEW
					{
                   var num1 =parseInt($("#NoSlide").attr("data1")); //đọc giá trị từ hidden put
				   var num2 = parseInt($("#NoSlide").attr("data2"));
					$(".box_news dl").remove();
					num1 = num1 - number_topic;
					num2 = num2 - number_topic;
					
					list_page(num1,num2);
					$("#NoSlide").attr({"data1":num1,"data2":num2});

					$(".getstep").each(function(data) //tim thuoc tinh = so num1
					{
						var ok = $(this).attr("data1")
						if (ok == num1)
						{
							$(this).attr("href","#").css("text-decoration","none");
						}
						else
						{
							$(this).attr("href","#").css("text-decoration","underline");
						} 
                    });
	            });//end rightforward
				
		});
}


function list_page(num1,num2)		
{
	
		$.ajax({url: "admin/data/news.xml", cache:false}).done(function(data)
		{	 
				$(data).find("New").slice(num1,num2).each(function()//11 tin
				{
					var no= $(this).find("no").text();
					var title= $(this).find("title").text();
					var short= $(this).find("short").text();
					var long= $(this).find("long").text();
					var image= $(this).find("image").text();
					var dateposted= $(this).find("dateposted").text();
					var myarr = dateposted.split(' ');
					var dateposted = myarr[0];
					
					var myarr = dateposted.split(' ');
					var dateposted = myarr[0];
					var dmy = dateposted.split('/');
					var d = dmy[0];
					var m = dmy[1];
					var y = dmy[2];
					var dateposted = y+'/'+m+'/'+d;
				 var elem =('<dl><dt><p>'+dateposted+'</p></dt><dd class="text_t"><a href="detailnew-'+no+'.html"><p class="img_detail"><img src="admin/image/thumb2/'+image+'" width="100" alt=" "/></p>'+title+'</a></dd><dd class="detail"><a href="detailnew-'+no+'.html"><img src="images/b_detail_off.jpg" width="113" height="17" alt="詳細情報を見る" /></a></dd></dl>');
				 
				  $(".box_news").append(elem);//thêm dữ liệu vào bảng bên dưới
				});//end New				
		});//end ajax
};//end done

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
</head>
<body id="underpage" class="news">
<div id="wrapper">
  <div id="header">
    <h1>更新情報 ｜バリア・ブンタウ省進出完全ガイド ～バリア・ブンタウ省公式日本語版サイト～</h1>
    <div id="logo">
      <p><a href="http://jp.baria-vungtau.gov.vn/"><img src="images/logo.jpg" width="635" height="106" alt="バリア・ブンタウ省進出完全ガイド" /></a></p>
      <ul>
        <li><img src="images/tel.jpg" width="238" height="50" alt="(84)-64-385-0019 月～金:07：30～16：30" /></li>        <li><a href="contact/index.php"><img src="images/b_mail_off.jpg" alt="お問い合わせはこちらから" width="238" height="50" border="0" /></a></li>
</ul>
    </div>
    <div id="globalNav" class="clearfix">
      <ul class="global-navi">
        <li><a href="http://jp.baria-vungtau.gov.vn/"><img src="images/b_navi01_off.jpg" width="144" height="47" alt="トップページ" /></a></li>
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
        <h2><img src="images/h2_news.jpg" width="975" height="193" alt="更新情報" /></h2>
      </div>
      <div class="pathway"><a href="http://jp.baria-vungtau.gov.vn/">バリア・ブンタウ省進出完全ガイド</a> &nbsp;&gt;&gt;&nbsp;更新情報</div>
      <div id="content">
        <h3><img src="images/h3_news.jpg" width="725" height="49" alt="更新情報" /></h3>
        <div class="section">
          <input type="hidden" name="NoSlide" id="NoSlide" />
          <div class="box_news"></div>
          <div style="text-align:center" class="digg"> <span><a href="#" class="leftback "> &lt; </a> </span> <span class="paging"> </span> <span><a href="#" class="rightforward" > &gt; </a> </span> </div>
          <!-- end paging --> 
        </div>
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
          <ul>             <li><a href="industry/index.html"><img src="images/b_snavi09_off.jpg" width="234" height="41" alt="工業団地マップ" /></a></li>
 <li><a href="living_information.html"><img src="images/b_snavi08_off.jpg" width="234" height="41" alt="生活情報マップ" /></a></li>
          <li><a href="gallery.html"><img src="images/b_snavi10_off.jpg" width="234" height="41" alt="写真・動画集" /></a></li>
            <li><a href="faq.html"><img src="images/b_snavi11_off.jpg" width="234" height="41" alt="よくある質問" /></a></li>
            <li><a href="partner.html"><img src="images/b_snavi12_off.jpg" width="234" height="41" alt="パートナーリンク" /></a></li>            <li><a href="contact/index.php"><img src="images/b_snavi13_off.jpg" width="234" height="41" alt="お問い合わせフォーム" /></a></li>
<li><a href="sitemap.html"><img src="images/b_snavi14_off.jpg" width="234" height="41" alt="サイトマップ" /></a></li>
          </ul>
        </div><!--        <p><a href="http://www.forval-vietnam.com/" target="_blank"><img src="images/banner_snavi_01.jpg" width="240" height="90" alt=" " /></a></p>
        <p><a href="http://www.forval.co.jp" target="_blank"><img src="images/banner_snavi_02.jpg" width="240" height="90" alt=" " /></a></p>
--><div class="box_snavi_exchange">
          <p><img src="images/img_exchange.jpg" width="234" height="40" alt="為替レート" /></p>
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
          <div class="right"> 参照元<img src="images/logo-EXIM-2.gif" alt="" title="" /></div>
        </div>
        <!-- / #nav --></div>
      
      <!-- / #main --></div>
  </div>
  <div id="footer">
    <p class="pagetop"><a href="#header"><img src="images/b_page_top_off.jpg" alt="トップへ" /></a></p>
    <div id="footer_link">
      <ul>
        <li class="title_home"><a href="http://jp.baria-vungtau.gov.vn/">TOPページ</a> </li>
        <li><a href="news.html">更新情報</a></li>
        <li><a href="living_information.html">生活情報</a></li>
        <li><a href="gallery.html">写真・動画集</a></li>
        <li><a href="faq.html">よくある質問</a></li>
        <li><a href="partner.html">パートナーリンク</a></li>
        <li><a href="rule.html">利用規約／個人情報の取扱いについて</a></li>        <li><a href="contact/index.php">お問い合わせ</a></li>
<li><a href="sitemap.html">サイトマップ</a></li>
      </ul>
      <ul>
        <li class="title_under">基本情報</li>
        <li><a href="infobaria/greeting.html">ご挨拶（委員長）</a></li>
        <li><a href="infobaria/access.html">アクセス（地図、行き方）</a></li>
        <li><a href="infobaria/history_baria.html">バリア・ブンタウ省の歴史</a></li>
        <li><a href="infobaria/index.html">地理位置、気候、経済発展状況</a></li>
      </ul>
      <ul>
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
    </div>
    <address id="copyright" class="clearfix">
    Copyright©2013 バリア・ブンタウ省進出支援 日本事務所 All Rights Reserved.
    </address>
    
    <!-- / #footer --></div>
  
  <!-- / #wrapper --></div>
</body>
</html>