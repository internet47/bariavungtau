<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>更新情報 ｜バリア・ブンタウ省進出完全ガイド</title>
<meta name="Keywords" content="#" />
<meta name="Description" content="#" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<!-- *** stylesheet *** -->
<link href="../css/styles.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="../css/lightbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/prettyPhoto2.css" type="text/css" media="screen" />
<script type="text/javascript" src="jwplayer.js"></script>
<script>jwplayer.key="itdRjkcNdhDS/LHyAGsNdmw/moMq3YH1bS1dSw=="</script>

<!-- *** javascript *** -->
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/rollover.min.js" type="text/javascript"></script>
<script src="../js/current.js" type="text/javascript"></script>
<script src="../js/page-scroller.js" type="text/javascript"></script>
<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/prettymove.js"></script>
<script src="../js/prettyPhoto2.js"></script>
<script type="text/javascript">
$(function(){
 $(".video").prettyPhoto();
});
</script>

<!-- Google Analytics start -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23751781-29']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- video popug -->
<link rel="stylesheet" href="index_videolb/videolightbox.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="index_videolb/overlay-minimal.css"/>
<!--<script src="index_videolb/jquery.js" type="text/javascript"></script> -->
<script src="index_videolb/swfobject.js" type="text/javascript"></script>

<!-- Google Analytics end -->
<!-- FS Conversion Analyzer start -->
<script type="text/javascript">
<!--//
  var fsUserSite = 'www2.fsaccess.jp';
  var fsJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
  var fsSiteId = "kitchen-showa_com";
  document.write(unescape("%3Cscript src='" + fsJsHost + fsUserSite +"/fsa/script/" + fsSiteId + "' charset='utf-8' type='text/javascript'%3E%3C/script%3E"));

//-->
</script>

</head>
<body id="underpage">
<div id="wrapper">
  <div id="header">
    <h1>更新情報 ｜バリア・ブンタウ省進出完全ガイド</h1>
    <div id="logo">
      <p><img src="../images/logo.jpg" width="635" height="106" alt="バリア・ブンタウ省進出完全ガイド" /></p>
      <ul>
        <li><img src="../images/tel.jpg" width="238" height="50" alt="(84)-064-000-000 毎日:08：00AM～17：00PM" /></li>
        <li><a href=""><img src="../images/b_mail_off.jpg" width="238" height="50" alt="メールでお問い合わせはこちらから" /></a></li>
      </ul>
    </div>
    <div id="globalNav" class="clearfix">
      <ul>
        <li><a href="#"><img src="../images/b_navi01_off.jpg" width="144" height="47" alt="トップページ" /></a></li>
        <li><a href="gallery.php"><img src="../images/b_navi02_off.jpg" width="119" height="47" alt="更新情報 " /></a></li>
        <li><a href="#"><img src="../images/b_navi03_off.jpg" width="123" height="47" alt="基本情報" /></a></li>
        <li><a href="#"><img src="../images/b_navi04_off.jpg" width="154" height="47" alt="工業団地情報" /></a></li>
        <li><a href="#"><img src="../images/b_navi05_off.jpg" width="123" height="47" alt="生活情報" /></a></li>
        <li><a href="#"><img src="../images/b_navi06_off.jpg" width="191" height="47" alt="投資環境について" /></a></li>
        <li><a href="#"><img src="../images/b_navi07_off.jpg" width="141" height="47" alt="よくある質問" /></a></li>
      </ul>
    </div>
    <!-- / #header --></div>
  <div id="wrap_content">
    <div id="main" class="cf">
      <div class="main_img">
        <h2><img src="../images/h2_gallery.jpg" width="975" height="193" alt="????" /></h2>
      </div>
      <div class="pathway"><a href="../">バリア・ブンタウ省進出完全ガイド</a> &nbsp;&gt;&gt;&nbsp;更新情報</div>
      <div id="content">
        <h3><img src="../images/index_h3.jpg" width="725" height="49" alt="????" /></h3>
        <div id="example">
          <div class="imageRow">
            <div class="set">
              <?php 
			  	include('config.php');
				
				//create_table('images',array('id','title','description','image','thumbs','date','status'));
				
			  	$data = get_data('images','*');
				$str='';
				$count = count($data);
				if($count==NULL)
				{
					$str='Database is empty';
				}
				else
				{
					foreach($data as $value)
					{
					$str =$str.'
						<div class="single"><a href="../admin/uploads/images/'.$value['image'].'" rel="prettyPhoto" title="'.$value['description'].'" >
						<img src="../admin/uploads/images/thumbs/'.$value['thumbs'].'" alt="'.$value['title'].'" />
						<p>'.$value['title'].'</p> </a> </div>
						';
					}
				}
				echo $str;
			  ?>
            </div>
          </div>
          <h3><img src="../images/index_h3.jpg" width="725" height="49" alt="????" /></h3>
          <div class="imageRow">
            <div class="set">
              <?php 
			  	//include('config.php');
				
				//create_table('images',array('id','title','description','image','thumbs','date','status'));
				
			  	$datavideo = get_data('videos','*');
				$str='';
				$count = count($datavideo);
				if($count==NULL)
				{
					$str='Database is empty';
				}
				else
				{
					foreach($datavideo as $val)
					{
						if($val['link']=='' && $val['video']=='')
						{
							// khong co video
							$str =$str.'';
						}
						else
						{
							if($val['link']!='' && $val['video']!='')
							{
								//xuat video tu youtube
								$str =$str.'
								<div class="single">
								<a href="'.$val['link'].'" rel="prettyPhoto" title="'.$val['description'].'">
								<img src="../images/gallery/thumb-7.jpg" alt="Ba Ria � Vung Tau" /><p>'.$val['title'].'</p></a>
								</div>
								';
							}
							else
							{
								if($val['link']=='')
								{
									// xuat video tu may tinh
									$str =$str.'<div class="single">
									<div class="videogallery">
										<a class="voverlay" href="index_videolb/player.swf?url=../../admin/uploads/videos/'.$val['video'].'&volume=100" title="'.$val['description'].'">
										<img src="../images/gallery/thumb-7.jpg" alt="test" width="150" height="150" /><p>'.$val['title'].'</p></a>
									</div></div>
										';
								}
								else
								{
									// xuat file tu youtube
									$str =$str.'
									<div class="single">
								<a href="'.$val['link'].'" rel="prettyPhoto" title="'.$val['description'].'">
								<img src="../images/gallery/thumb-7.jpg" alt="Ba Ria � Vung Tau" /><p>'.$val['title'].'</p></a>
								</div>
										';
								}
							}
						}
					}
				}
				echo $str;
			  ?>
            </div>
          </div>
        </div>
        
        <!-- / #content --></div>
      <div id="nav">
        <div class="box_snavi_orang">
          <p class="mb05"><img src="../images/title_snavi.jpg" width="234" height="40" alt="基本情報" /></p>
          <ul>
            <li><a href="#"><img src="../images/b_snavi01_off.jpg" width="234" height="55" alt="ご挨拶（委員長）" /></a></li>
            <li><a href="#"><img src="../images/b_snavi02_off.jpg" width="234" height="55" alt="アクセス（地図、行き方）" /></a></li>
            <li><a href="#"><img src="../images/b_snavi03_off.jpg" width="234" height="55" alt="バリア･ブンタウ省の歴史" /></a></li>
            <li><a href="#"><img src="../images/b_snavi04_off.jpg" width="234" height="55" alt="地理位置、気候、経済発展状況" /></a></li>
          </ul>
        </div>
        <div class="box_snavi_black">
          <p class="mb05"><img src="../images/title_snavi-06.jpg" width="234" height="40" alt="投資環境について" /></p>
          <ul>
            <li><a href="#"><img src="../images/b_snavi05_off.jpg" width="234" height="55" alt="企業誘致のご案内" /></a></li>
            <li><a href="#"><img src="../images/b_snavi06_off.jpg" width="234" height="55" alt="優遇政策" /></a></li>
            <li><a href="#"><img src="../images/b_snavi07_off.jpg" width="234" height="55" alt="インフラ" /></a></li>
          </ul>
        </div>
        <div class="box_snavi_blue">
          <p class="mb05"><img src="../images/title_snavi-08.jpg" width="234" height="40" alt="投資環境について" /></p>
          <ul>
            <li><a href="#"><img src="../images/b_snavi08_off.jpg" width="234" height="41" alt="生活情報マップ" /></a></li>
            <li><a href="#"><img src="../images/b_snavi09_off.jpg" width="234" height="41" alt="工業団地マップ" /></a></li>
            <li><a href="#"><img src="../images/b_snavi10_off.jpg" width="234" height="41" alt="写真・動画集" /></a></li>
            <li><a href="#"><img src="../images/b_snavi11_off.jpg" width="234" height="41" alt="よくある質問" /></a></li>
            <li><a href="#"><img src="../images/b_snavi12_off.jpg" width="234" height="41" alt="パートナーリンク" /></a></li>
            <li><a href="../fmail/fmail.cgi"><img src="../images/b_snavi13_off.jpg" width="234" height="41" alt="お問い合わせフォーム" /></a></li>
            <li><a href="#"><img src="../images/b_snavi14_off.jpg" width="234" height="41" alt="サイトマップ" /></a></li>
          </ul>
        </div>
        <!-- / #nav --></div>
      
      <!-- / #main --></div>
  </div>
  <div id="footer">
    <p class="pagetop"><a href="#header"><img src="../images/b_page_top_off.jpg" alt="" /></a></p>
    <div id="footer_link">
      <ul>
        <li class="title_home"><a href="#">TOPページ</a> </li>
        <li><a href="#">更新情報</a></li>
        <li><a href="#">生活情報</a></li>
        <li><a href="#">よくある質問</a></li>
        <li><a href="../fmail/fmail.cgi">お問い合わせ</a></li>
        <li><a href="#">サイトマップ</a></li>
      </ul>
      <ul>
        <li class="title_under">基本情報</li>
        <li><a href="#">ご挨拶（委員長）</a></li>
        <li><a href="#">アクセス（地図、行き方）</a></li>
        <li><a href="#">バリア・ブンタウ省の歴史</a></li>
        <li><a href="#">地理位置、気候、経済発展状況</a></li>
      </ul>
      <ul>
        <li class="title_under">工業団地情報</li>
        <li><a href="#">ダバク日本企業専用工業団地</a></li>
        <li><a href="#">ミスアンB1 ダイズン工業団地</a></li>
        <li><a href="#">フーミー III工業団地</a></li>
        <li><a href="#">ミスアンB1ティエンフン工業団地</a></li>
        <li><a href="#">その他の工業団地一覧</a></li>
      </ul>
      <ul class="last">
        <li class="title_under">投資環境について</li>
        <li><a href="#">企業誘致のご案内</a></li>
        <li><a href="#">優遇政策</a></li>
        <li><a href="#">インフラ</a></li>
      </ul>
    </div>    <address id="copyright" class="clearfix">Copyright©2013 バリア・ブンタウ省進出支援 日本事務所 All Rights Reserved.</address>
<!-- / #footer --></div>
  
  <!-- / #wrapper --></div>
<!-- FS Conversion Analyzer start --> 
<script type="text/javascript">
<!--//
  var fsUserSite = 'www2.fsaccess.jp';
  var fsJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
  var fsSiteId = "kitchen-showa_com";
  document.write(unescape("%3Cscript src='" + fsJsHost + fsUserSite +"/fsa/script/" + fsSiteId + "' charset='utf-8' type='text/javascript'%3E%3C/script%3E"));

//-->
</script> 
 

<script src="index_videolb/jquery.tools.min.js" type="text/javascript"></script> 
<script src="index_videolb/videolightbox.js" type="text/javascript"></script>
</body>
</html>