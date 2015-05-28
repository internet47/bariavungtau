<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>生活情報 ｜バリア・ブンタウ省進出完全ガイド</title>
<meta name="Keywords" content="ベトナム,進出,海外進出,日本企業,工場,バリア・ブンタウ,工業団地,誘致企業" />
<meta name="Description" content="生活情報 | ベトナム南部最大の工業区、バリア・ブンタウ省公式日本語版サイト。「バリアブンタウ省進出支援 日本事務所」が運営し、進出希望の日本企業を全面的にサポートします。" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<!-- *** stylesheet *** -->

<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/vietstyle.css" type="text/css" media="screen" />

<!-- *** javascript *** -->
<script src="js/jquery-1.8.3.js" type="text/javascript"></script>
<script src="js/rollover.min.js" type="text/javascript"></script>
<script src="js/current.js" type="text/javascript"></script>
<script src="js/page-scroller.js" type="text/javascript"></script>
<script src="js/jquery.dropdown.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript"> 
 	var map;
	var pos;
	var i=0;
	var color;
	var Mylocation1;
	var Mylocation2;
	var file_xml ="admin/data/xmlv2.xml"; // file các vị trí
	var homexml = "admin/data/home.xml"; // file định vị ban đầu
	var file_list="admin/data/list.xml";
	

	
function getHome()
	{
	$.ajax({url:homexml, cache:false, success: function(data)
	 {
		   $(data).find("Home").each(function() 
		   {
				Mylocation1 = parseFloat($(this).find("lat").text());//lay 2 giá trị của vị trí định vị ban đầu
				Mylocation2 = parseFloat($(this).find("lng").text());
				
				var myLatlng = new google.maps.LatLng(Mylocation1,Mylocation2); // vị trí ban đầu
				var myOptions = {
				zoom: 16,
				center: myLatlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl:true, // cho phép hiện loại bản đồ
				mapTypeControlOptions: {
				style:google.maps.MapTypeControlStyle.DROPDOWN_MENU,
				position:google.maps.ControlPosition.TOP_CENTER
								}
						 }
				 map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				
			});//end each
	 }//end function data
	});//end ajax	
	 //return false;
	}//end getHome
	
	
function getPosition(pos)
	{
	var bounds = new google.maps.LatLngBounds();
	$("#tab > tbody").empty();//xóa cái dữ liệu cũ mỗi khi ta click chọn
	$.ajax({url:file_xml, cache:false, success: function(data) 
	 {
		   $(data).find("Position").each(function() 
		   {
				
			   
				var type =  $(this).attr("type"); //get Type
				
				if (i%2 == 0)
					color = "#FFFFFF";
				else
					color = "#EEEEEE";
				if (type == pos)
				{
					 var company = $(this).find("company").text(); //get Company
					  var lat = $(this).find("lat").text();
					  var lng= $(this).find("lng").text();
					  var add= $(this).find("add").text();
					  var image= $(this).find("image").text();
					  var des= $(this).find("des").text();
					  var url= $(this).find("url").text();
					  var icon= 'admin/icon/'+$(this).find("icon").text();
					  var latlng = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
					  
					  
					  var elem = $('<tr class="add" bgcolor="'+color+'"><td><a href="abc.com" onclick ="infoOpen('+lat+','+lng+');" class="linkgmap">'+company+'</a></td> <td>'+add+'</td></tr>');
					  $("#tab").append(elem);//thêm dữ liệu vào bảng bên dưới
					  
					  $(".linkgmap").click(function(e) {
                        e.preventDefault();
                    });
					  
					  var content='<div class="content">'+
						'<p id="firstHeading" class="firstHeading">'+ company +'</p>'+
						'<div id="bodyContent">'+
						'<img src="admin/image/'+image+'" class="img" width="100px" height="100px" />'+
						'<span class="text">'+
						des+'<br>'+'Add: '+add+'<br>'+'Link: '+'<a href="'+url+'">'+url+'</a>'+
						'</span></div></div>';
					 
					  bounds.extend(latlng);
			
					 //var  marker = new google.maps.Marker({ position: latlng,  map: map });
					var marker = new google.maps.Marker
					({
					position: latlng,
					map: map,		
					animation: google.maps.Animation.DROP,
					icon: icon,
					sidebarItem: "Position"
					});
					attachSecretMessage(marker,content);	//đưa thông tin tên marker
					
					map.fitBounds(bounds); // di chuyển đến đúng những marker đã đánh dấu
					i++;

				}//end if
			});//end each
			
	 }//end function data
	});//end ajax	
	 //return false;
	}//end getPosition(pos)
	
	

function getAllPosition()
	{
	var bounds = new google.maps.LatLngBounds();
	$("#tab > tbody").empty();//xóa cái dữ liệu cũ mỗi khi ta click chọn
	$.ajax({url:file_xml, cache:false, success: function(data) 
	 {
		   $(data).find("Position").each(function() 
		   {
				
				if (i%2 == 0)
					color = "#FFFFFF";
				else
					color = "#EEEEEE";
					
			var type =  $(this).attr("type"); //get Type
			if (type !="")
				{
					 var company = $(this).find("company").text(); //get Company
					  var lat = $(this).find("lat").text();
					  var lng= $(this).find("lng").text();
					  var add= $(this).find("add").text();
					  var image= $(this).find("image").text();
					  var des= $(this).find("des").text();
					  var url= $(this).find("url").text();
					  var icon= 'admin/icon/'+$(this).find("icon").text();
					  var latlng = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
					  
					  
					  var elem = $('<tr class="add" bgcolor="'+color+'"><td><a href="#" onclick ="infoOpen('+lat+','+lng+');" >'+company+'</a></td> <td>'+add+'</td> </tr>');
					  $("#tab").append(elem);//thêm dữ liệu vào bảng bên dưới
					  
					   // var elem = $('<tr class="add" bgcolor="'+color+'"><td><img src="'+icon+'" alt="icon" class="img" width="16px" height="16px" /></td><td><a href="#" onclick ="infoOpen('+lat+','+lng+');" >'+company+'</a></td> <td>'+add+'</td> <td>'+des+'</td> <td>'+url+'</td><td><img src="admin/image/'+image+'" alt="picture_of_position" width="30px" height="30px" /></td></tr>');
//					  $("#tab").append(elem);//thêm dữ liệu vào bảng bên dưới
//					  
					  
					  var content='<div class="content">'+
						'<p id="firstHeading" class="firstHeading">'+ company +'</p>'+
						'<div id="bodyContent">'+
						'<img src="admin/image/'+image+'" class="img" width="100px" height="100px" />'+
						'<span class="text">'+
						des+'<br>'+'Add: '+add+'<br>'+'Link: '+'<a href="'+url+'">'+url+'</a>'+
						'</span></div></div>';
					 
					  bounds.extend(latlng);
			
					 //var  marker = new google.maps.Marker({ position: latlng,  map: map });
					var marker = new google.maps.Marker
					({
					position: latlng,
					map: map,		
					animation: google.maps.Animation.DROP,
					icon: icon,
					sidebarItem: "Position"
					});
					attachSecretMessage(marker,content);	//đưa thông tin tên marker
					
					map.fitBounds(bounds); // di chuyển đến đúng những marker đã đánh dấu
					i++;
				}//end if
			});//end each
			
	 }//end function data
	});//end ajax	
	 //return false;
	}//end getPosition(pos)


	
function infoOpen(lat,lng)
{
	var myLatLng = new google.maps.LatLng( lat, lng );
	
	var marker = new google.maps.Marker({
					 position: myLatLng,
					 map: map,
					 animation: google.maps.Animation.DROP,
					 title:'HERE',
					 icon:'admin/icon/down.png',
					 optimized: true, //tắt hay mở info_window
    				 zIndex: -5 // cho Icon nằm dưới icon chính
				  });
				  	
	marker.setPosition( new google.maps.LatLng( lat, lng ) );
	map.panTo(new google.maps.LatLng( lat, lng ));//di chuyển con trỏ đến nay marker
}	


function attachSecretMessage(marker, content) //hàm xuất xuất info box
{
		var infowindow = new google.maps.InfoWindow({ content: content, maxWidth: 500});
		
		google.maps.event.addListener(marker, 'click', function() 
		{
			infowindow.open(map,marker);
		});

/*		google.maps.event.addListener(marker, 'mouseout', function() 
		{
			infowindow.close(map,marker);
		});*/
}
	

</script>
<script language="javascript">


$(function()
{
	list();//chạy danh sách category
	
	 $('.refresh').click(function() 
	{
		getAllPosition();
		document.location.reload(true);
    }); //end click*/
	
});



function list()
{
		var list = new Array();
		$.ajax({url: file_list, cache:false}).done(function(data)
		{
				$(data).find("List").each(function()
				{
					
				 var no= $(this).find("no").text();
				 var name= $(this).find("name").text();
					
				 var elem = '<li><input type="checkbox" name="typePosition" class="typePosition" value="'+name+'" > '+name+'</li>';
				 $("#wrap #navi ul").append(elem);//thêm dữ liệu vào bảng bên dưới
				});
				
				
				$('.typePosition').change(function(e) //click chọn từng item
				{
					if (!this.checked)
						{//alert('uncheck');
						getHome();
						var type = $(this).attr("value");
						//alert(type);
						var index = list.indexOf(type);
						//alert(index);
						list.splice(index, 1);
						getManyChoice(list);
						}
					else
						{	
							
							var type = $(this).attr("value");
							list.push(type); //đưa mãng type vào
							$("#contain_checkbox").attr("value",list);
							getManyChoice(list); //gọi hàm lặp các type xuất ra danh sách
						}
					
					//getHome();
					//$('.typePosition').removeAttr('checked');//remove tất cả checkbox của class .typePosition
					//$(".add").remove();
					//$(this).attr('checked',true); // sau đó thêm thuộc tính checked vào checkbox đang check
						// gọi hàm nào đó và truyền tham số value của checkbox đang check vào
					
					
					
				}); //end click
				
				
				
				
				
				$('.refresh').click(function() 
				{
					getAllPosition();
					document.location.reload(true);
				}); //end click*/
				
				
				$('.Reset').click(function() 
				{
					getHome();
					$(".typePosition").each(function() {
                     $(this).removeAttr("checked");
                    });
				}); //end click*/
						
		});//end done
		
		
		getHome();
		//getAllPosition(); // rot xuong het
}



function getManyChoice(list)
{
	var Num = list.length;
	for(var i=0; i<Num; i++) 
	{
		var value = list[i];
		getPosition(value);
	}
		
	
}

</script>

<!-- FS Conversion Analyzer end -->

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
<body id="underpage" class="livingPage">
<div id="wrapper">
  <div id="header">
    <h1>生活情報 ｜バリア・ブンタウ省進出完全ガイド</h1>
    <div id="logo">
      <p><a href="http://jp.baria-vungtau.gov.vn/"><img src="images/logo.jpg" width="635" height="106" alt="バリア・ブンタウ省進出完全ガイド" /></a></p>
      <ul>
        <li><img src="images/tel.jpg" width="238" height="50" alt="(84)-64-385-0019 毎日:08：00AM～17：00PM" /></li>
        <li><a href="../../cgi-bin/fmail.cgi"><img src="images/b_mail_off.jpg" alt="メールでお問い合わせはこちらから" width="238" height="50" border="0" /></a></li>
      </ul>
    </div>
    <div id="globalNav" class="clearfix">
      <ul class="global-navi">
        <li><a href="http://jp.baria-vungtau.gov.vn/"><img src="images/b_navi01_off.jpg" width="144" height="47" alt="トップページ" /></a></li>
        <li><a href="news.html"><img src="images/b_navi02_off.jpg" width="119" height="47" alt="更新情報 " /></a><ul>
            <li><a href="gallery.html">写真・動画集</a></li>
          </ul></li>
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
        <h2><img src="images/h2_live.jpg" width="975" height="193" alt="生活情報" /></h2>
      </div>
      <div class="pathway"><a href="http://jp.baria-vungtau.gov.vn/">バリア・ブンタウ省進出完全ガイド</a> &nbsp;&gt;&gt;&nbsp;生活情報</div>
      <h3><img src="images/h3_map.jpg" width="995" height="49" alt="生活情報マップ"></h3>
      <div class="box_maplist">
        <div id="wrap">
          <div id="infoView">
            <div class="u_guide">以下のチェックボックスにチェックを入れたスポットの位置を表示します。また、表示されたアイコンをクリックすると詳細情報を確認できます。右側のカラムには、チェックしたスポットの一覧が表示されます。</div>
            <div id="navi">
              <ul>
                <input type="hidden" name="contain_checkbox" id="contain_checkbox">
                <!--  <li id="check">
                    <input type="checkbox" name="refresh" class="refresh" value="all">
                    View All</li>
                    
                   <li id="clearall">
                    <input type="checkbox" name="refresh" class="Reset" value="Reset">
                    Reset </li> -->
                
              </ul>
            </div>
          </div>
          <div id="info_position">
            <table id="tab">
              <thead>
                <tr> 
                  <!--                      <th>#</th>
-->
                  <th>Name:</th>
                  <th>Address:</th>
                  <!-- <th>Description:</th>
                      <th>Link:</th>
                      <th>Image:</th>--> 
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div id="top">
            <div id="map_canvas"></div>
          </div>
        </div>
        <!--end wrap --> 
        
      </div>
    </div>
  </div>
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
      <li><a href="rule.html">利用規約／個人情報の取扱いについて</a></li>
      <li><a href="fmail/fmail.cgi">お問い合わせ</a></li>
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

<!-- / #wrapper -->
</div>
</body>
</html>