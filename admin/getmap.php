<?php include('checklogin.php');
ob_start();
?>
<!DOCTYPE html> 
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<title>Demo JQUERY with Gooogle Map</title>
<link rel="stylesheet" href="../css/vietstyle.css" type="text/css" media="screen" />

<script language="javascript" src="js/jquery-1.8.3.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript"> 
 	var map;
	var pos;
	var i=0;
	var color;
	var Mylocation1;
	var Mylocation2;
	var file_xml ="data/xmlv2.xml"; // file các vị trí
	var homexml = "data/home.xml"; // file định vị ban đầu
	var file_list="data/list.xml";
	

	
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
					  var icon= 'icon/'+$(this).find("icon").text();
					  var latlng = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
					  
					  
					  var elem = $('<tr class="add" bgcolor="'+color+'"><td><img src="'+icon+'" alt="icon" class="img" width="16px" height="16px" /></td><td>'+lat+'</td> <td>'+lng+'</td><td><a href="#" onclick ="infoOpen('+lat+','+lng+');" >'+company+'</a></td> <td>'+add+'</td> <td>'+des+'</td> <td>'+url+'</td><td><img src="image/'+image+'" alt="picture_of_position" width="30px" height="30px" /></td><td><a href="editLocation.php?id='+lat+'" class="linkPro small light_blue">Edit</a></td><td><a href="xml.php?do=delete&id='+lat+'&img='+image+'" class="delete_bt linkPro small red" id="confi">Delete</a></td></tr>');
					  $("#tab").append(elem);//thêm dữ liệu vào bảng bên dưới
					  
					  var content='<div class="content">'+
						'<h2 id="firstHeading" class="firstHeading">'+ company +'</h2>'+
						'<div id="bodyContent">'+
						'<img src="image/'+image+'" class="img" width="100px" height="100px" />'+
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
			 $('.delete_bt').one('click',function(e)
						{
						e.preventDefault();
						var ans =	confirm("Are you delete this item ?");
						if(ans)
							{
							location.href = $(this).attr('href');
							}
						else
							{
								return false;	
							}
						}); 
			
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
					 icon:'icon/down.png',
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
		{infowindow.close(map,marker);});*/
}



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
					  var icon= 'icon/'+$(this).find("icon").text();
					  var latlng = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
					  
					  
					  var elem = $('<tr class="add" bgcolor="'+color+'"><td><img src="'+icon+'" alt="icon" class="img" width="16px" height="16px" /></td><td>'+lat+'</td> <td>'+lng+'</td><td><a href="#" onclick ="infoOpen('+lat+','+lng+');" >'+company+'</a></td> <td>'+add+'</td> <td>'+des+'</td> <td>'+url+'</td><td><img src="image/'+image+'" alt="picture_of_position" width="30px" height="30px" /></td><td><a href="editLocation.php?id='+lat+'" class="linkPro small light_blue">Edit</a></td><td><a href="xml.php?do=delete&id='+lat+'&img='+image+'" class="delete_bt linkPro small red" id="confi">Delete</a></td></tr>');
					  
					  $("#tab").append(elem);//thêm dữ liệu vào bảng bên dưới
					  
					  var content='<div class="content">'+
						'<h2 id="firstHeading" class="firstHeading">'+ company +'</h2>'+
						'<div id="bodyContent">'+
						'<img src="image/'+image+'" class="img" width="100px" height="100px" />'+
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


	

</script>
<script language="javascript">
$(function()
{
	list();//chạy danh sách category
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
				 $("#wrap_admin #navi ul").append(elem);//thêm dữ liệu vào bảng bên dưới
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

				}); //end click
				

				$('.refresh').click(function() 
				{
					$('.Reset').removeAttr("checked");
					$(".typePosition").each(function() {
                     $(this).removeAttr("checked");
                    });
				 	getAllPosition();
					//document.location.reload(true);
				}); //end click*/
				
				
				$('.Reset').click(function() 
				{
					document.location.reload(true);
					getHome();
					
					$('.refresh').removeAttr("checked");
					
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

</head>
<body>
  <h1 class="h1admin_gmap">GOOGLE MAP </h1>
  <div id="wrap_admin">
  	<div id="navi">
    	<ul> 
        	<input type="hidden" name="contain_checkbox" id="contain_checkbox">
           <li id="check">
                    <input type="checkbox" name="refresh" class="refresh" value="all">
                    View All</li>
                    
                   <li id="clearall">
                    <input type="checkbox" name="refresh" class="Reset" value="Reset">
                    Reset </li>
                    
           </li>
        </ul>
    </div>
    <div id="info_position">
	      <table id="tab">
          <thead>
          <tr>
            <th>#</th>
            <th>Latitute</th>
            <th>Longitude</th>
            <th>Name:</th>
            <th>Address:</th>
            <th>Description:</th>
            <th>Link:</th>  
            <th>Image:</th>  
            <th colspan="2">Action</td>                       
          </tr>
          </thead>
          <tbody>
          </tbody>
          </table>
    </div>
  	<div id="top">
       <div id="add_location"><a href="getLocation.php" class="linkPro rounded green">Add location</a> <a onClick="getHome(); document.location.reload(true); " class="linkPro rounded blue">Reload Map</a></div>
      <div id="map_canvas"></div>
    </div>
  </div><!--end wrap -->
</body>
</html>
