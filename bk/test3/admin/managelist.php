<?php
ob_start();
include('checklogin.php'); ?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>LIST</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/vietstyle.css" rel="stylesheet" type="text/css" />
<link href="styles/vietcolor.css" rel="stylesheet" type="text/css" />
<script type="application/javascript" src="js/jquery-1.8.3.js"></script>
<script>
var file_xml="data/list.xml";
var i=0;

$(document).ready(function(e) 
{
		/*---------*/
		list();//chạy khởi động
		
		/*---------*/
		$(window).mousemove( function(e) 
		{
		 mouseX = e.pageX; //toa do mouse
		 mouseY = e.pageY;
		});  
	
		/*--------RIGHT CLICK-----*/
		$(document)[0].oncontextmenu = function() { return false;}// disable menucontext
		$(document).mousedown(function(e){
		  if( e.button == 2 ) 
		  {
			$("#add_news").css("visibility","visible");
			$("#add_news").show("slow");	
			$("#add_news").css({'top':mouseY, 'left':mouseX});
		   }
			else
			{
			return true;
			}
		});
		/*---------HIDE---------*/
	
		$("#button_hide").click(function() {
            $("#add_news").hide("slow");
			document.getElementById('name').value = "";
        });
		
		$("#button_hide2").click(function() {
            $("#add_news2").hide("slow");
        });
		
		
		/*--------------KIEM TRA KICH THUOC ICON------------------*/
		var _URL = window.URL || window.webkitURL;
		var Wicon = 24;//chiều rộng icon
		var Hicon = 24;//chiều cao icon
		$("#icon, #icon2").change(function (e) 
		{
			var file, img;
			if ((file = this.files[0])) 
			{
				img = new Image();
				img.onload = function () 
				{
					//alert(this.width + " " + this.height);
					if (this.width > Wicon || this.height > Hicon)
					{
						alert("Vui lòng chọn icon <" +Wicon +"px");
						$("#icon").val('');
						$("#icon2").val('');
						return false;
					}
					else
					{
						return true;	
					}
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		
		/*------SUBMIT ADD-------*/
		$("#submit").click(function(e) {
            var name = $("#name").val();
			var icon = $("#icon").val();
			if (name =="" || icon=="")
			{
				alert("Please, type name of list or choose icon.");
				return false;
			}
			else
			{
				return true;
			}
        });
		
		
		/*------SUBMIT2 ADD-------*/
		$("#submit2").click(function(e) {
            var name = $("#name2").val();
			
			if (name =="")
			{
				alert("Please, type name of list.");
				return false;
			}
			else
			{
				return true;
			}
        });

});//end ready



function list()
{
		$.ajax({url: file_xml, cache:false}).done(function(data)
		{
				$(data).find("List").each(function()
				{
					if (i%2 == 0)
						color = "#FFFFFF";
					else
						color = "#EEEEEE";
					
				 var no= $(this).find("no").text();
				 var name= $(this).find("name").text();
				 var icon = $(this).find("icon").text();
				 var pathicon= 'icon/'+$(this).find("icon").text();
					
					
				 var elem = $('<tr class="add" bgcolor="'+color+'"><td class="add_'+no+'" width="20">'+no+'</td><td class="add_'+no+'_name" width="200">'+name+'</td><td width="20"><img src="'+pathicon+'" alt="icon_list" width="16" heigh="16"></td><td width="70"><a href="#" class="edit_bt linkPro small light_blue" data1="'+no+'" data2="'+name+'" data3="'+icon+'">Edit</a></td><td width="70"><a href="#" class="delete_bt linkPro small red" data1="'+no+'" data3="'+icon+'" id="confi">Delete</a></td></tr>');
				 $("#tab2").append(elem);//thêm dữ liệu vào bảng bên dưới
				
				});//end New
				
				$(".edit_bt").click(function() 
				{
					var no = $(this).attr("data1");
					var name = $(this).attr("data2");
					var icon = $(this).attr("data3");
					
					$("#name2").val(name);
					$("#no2").val(no);
					$("#icon_old").val(icon);
					$("#image_icon").attr("src",'icon/'+icon);
					
					$("#add_news2").css("visibility","visible");
					$("#add_news2").show("slow");	
					$("#add_news2").css({'top':mouseY, 'left':mouseX});			
                });		
				
				$(".delete_bt").click(function() 
				{
					var ans = confirm("Do you want to delete this item ?");
					if (ans)
					{
						var no = $(this).attr("data1");
						var icon = $(this).attr("data3");
						
						$.ajax({
							url:"list.php?do=deletelist",
							cache:false,
							data: "&no="+no+"&icon="+icon
							})
							.done(function(){
								$("#tab2 > tbody").empty();//xóa cái dữ liệu cũ mỗi khi ta click chọn
								list();
								});	
					}
					else
					{
					return false;	
					}
				});
						
		});//end done
}



</script>
</head>
<body>
<h1> CATEGORIES LIST</h1>

<div id="content_news">
<span class="redlabel">* Right click to Add new list</span>
<table cellpadding="0" cellspacing="0" id="tab2">
    <thead>
        <th>No</th>
        <th>NAME</th>
        <th>ICON</th>
        <th colspan="2">Action</th>
    </thead>
    <tbody>
    </tbody>
</table>
</div>


<div id="add_news">
<form method="POST" action="list.php?do=addlist" name="addlist" enctype="multipart/form-data">
	<table id="lefttable" cellpadding="0" cellspacing="0">
    <tr>
    <td>Name: </td><td>
    <input type="text" name="name" id="name" maxlength="50">
    </td>
    </tr>
    <tr>
    <td>Icon</td><td>
    <input type="file" name="icon" id="icon"><br>
    <label class="redlabel">(16 pixel x 16pixel)</label>
    </td>
    </tr>
    <tr>
    <td colspan="2" align="center">
    <input type="submit" name="submit" value=" > Add" class="linkPro small green" id="submit">
    <input type="button" name="hide" value="< Cancel" class="linkPro small red" id="button_hide">
    </td>
    </tr>
    <tr height="10px"></tr>
    </table> 
</form>
</div>

<div id="add_news2">
<form method="post" action="list.php?do=updatelist" name="editlist" enctype="multipart/form-data">
	<table id="lefttable2" cellpadding="0" cellspacing="0" border="0" align="center">
    <tr>
    <td>Name: </td>
    <td><input type="text" name="name" id="name2" maxlength="50">
  	    <input type="hidden" name="no" id="no2">
    </td>
    </tr>
    <tr>
    <td>Icon: </td>
    <td>
    <img src="#" alt="" width="16" height="16" id="image_icon" />
	<input type="file" name="icon" id="icon2"><br>
    <input type="hidden" name="icon_old" id="icon_old">
    <label class="redlabel">(16 pixel x 16pixel)</label>
    </td>
    </tr>
    <tr>
    <td colspan="2" align="center">
    <input type="submit" name="submit2" value=" > Update" class="linkPro small yellow" id="submit2">
    <input type="button" name="hide" value="< Cancel" class="linkPro small red" id="button_hide2">
    </td>
    </tr>
    <tr height="10px"></tr>
    </table> 
</form>
</div>


</body>
</html>