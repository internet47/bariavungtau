<?php  include('checklogin.php');
ob_start();
?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Quản Lý Tin tức</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/vietstyle.css" rel="stylesheet" type="text/css" />
<link href="styles/vietcolor.css" rel="stylesheet" type="text/css" />
<link href="fckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<script type="application/javascript" src="js/jquery-1.8.3.js"></script>
<script>
var file_xml="data/news.xml";
var i=0;

$(document).ready(function(e) {
	$("#tab tbody tr").remove();// khu vuc xuat hien data can xoa
	list_page(0,9);
	paging(9);//lay 3 tin
	form();
	
});


function form()
{
$("#submit").click(function() {
			var title = $("#title").val();
			var summary= $("#summary").val();
			var i= $("#image1").val();

            if (title =="" || summary=="" || i=="")
			{
				alert("Please, fill in the blank !!");
				return false;	
			}
			else
			{
				return true;	
			}
        });
		
		$("#submit2").click(function() {
			var title = $("#title2").val();
			var summary= $("#summary2").val();

            if (title =="" || summary=="" )
			{
				alert("Please, fill in the blank !!");
				return false;	
			}
			else
			{
				return true;	
			}
        });
		
		
	
		$(window).mousemove( function(e) 
		{
		 mouseX = e.pageX; //toa do mouse
		 mouseY = e.pageY;
		});  
	
	
		$("#button_add_news").click(function(e) {
            $("#add_news").css("visibility", "visible");
			$("#add_news").show("fast");
			var H = $(window).height();
			var W = $(window).width();
			var appH = (H - $("#add_news").outerHeight())/2;
			var appW = (W - $("#add_news").outerWidth())/2;
			$("#add_news").css({'top':appH,'left':appW});
			//$("#add_news").animate({top:appH, left:appW},1000);
        });
		
		$("#button_hide").click(function() {
            $("#add_news").hide("slow");
        });
		
		
		$("#button_hide2").click(function(){
			$("#add_news2").hide("slow");
			});
		
		$(document)[0].oncontextmenu = function() { return false;}// disable menucontext
		$(document).mousedown(function(e){
		  if( e.button == 2 ) 
		  {
			$("#add_news").css("visibility","visible");
			$("#add_news").show("fast");
			$("#add_news").css({'top':mouseY, 'left':mouseX});
			return false;
		   }
		    else 
			{
			 return true;
			}
		});
			
			
			list();//chay list danh muc
			
			
			/////////////////////////////////////////MAX WORD/////////////////////////////////////////////
			var maxWords = 30;

			$('#summary').keypress(function() {
				var $this, wordcount;
				$this = $(this);
				wordcount = $this.val().split(/\b[\s,\.-:;]*/).length;
				if (wordcount > maxWords) {
					jQuery(".word_count span").text("Number of words:" + maxWords);
					alert("You've reached the maximum allowed words.");
					return false;
				} else {
					return $(".word_count span").text(wordcount +" of (Max words: "+maxWords+")");
				}
			});
			
			$('#summary').change(function() {
				var words = $(this).val().split(/\b[\s,\.-:;]*/);
				if (words.length > maxWords) {
					words.splice(maxWords);
					$(this).val(words.join(""));
					alert("You've reached the maximum allowed words. Extra words removed.");
				}
			});
			
			
			$('#summary2').keypress(function() {
				var $this, wordcount;
				$this = $(this);
				wordcount = $this.val().split(/\b[\s,\.-:;]*/).length;
				if (wordcount > maxWords) {
					jQuery(".word_count2 span").text("Number of words:" + maxWords);
					alert("You've reached the maximum allowed words.");
					return false;
				} else {
					return $(".word_count2 span").text(wordcount +" of (Max words: "+maxWords+")");
				}
			});
			
			$('#summary2').change(function() {
				var words = $(this).val().split(/\b[\s,\.-:;]*/);
				if (words.length > maxWords) {
					words.splice(maxWords);
					$(this).val(words.join(""));
					alert("You've reached the maximum allowed words. Extra words removed.");
				}
			});
			/////////////////////////////////////////////////////////////////////////////////////

}




function paging(number_topic)
{
$.ajax({url: file_xml, cache:false}).done(function(data)
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
					
					$("#tab tbody tr").remove();

					list_page(num1,num2);
                	});
					
				$(".getstep").eq(0).attr("href","#").css("text-decoration","none");
				$('#NoSlide').attr({"data1":"0","data2":"9"}); //khai báo mặc định.
				
				
				$(".rightforward").click(function() //NEXT
					{
                   var num1 =parseInt($("#NoSlide").attr("data1")); //đọc giá trị từ hidden put
				   var num2 = parseInt($("#NoSlide").attr("data2"));
					$("#tab tbody tr").remove();
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
					$("#tab tbody tr").remove();
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
	
		$.ajax({url: file_xml, cache:false}).done(function(data)
		{
				$(data).find("New").slice(num1,num2).each(function()//11 tin
				{
					if (i%2 == 0)
						color = "#FFFFFF";
					else
						color = "#EEEEEE";
					
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

					
				 var elem = $('<tr class="add" bgcolor="'+color+'"><td>'+no+'</td><td>'+title+'</td><td>'+short+'</td><td><img src="image/thumb2/'+image+'" alt="picture_of_position" width="100" /></td><td>'+dateposted+'</td><td><a href="#" class="edit_bt linkPro small light_blue" data1="'+no+'">Edit</a></td><td><a href="#" class="delete_bt linkPro small red" id="confi" data1="'+no+'" data2="'+image+'">Delete</a></td></tr>');
				 $("#tab").append(elem);//thêm dữ liệu vào bảng bên dưới
				});//end New
				
				$(".edit_bt").click(function() 
				{
					var no = $(this).attr("data1");
					$.ajax({
							url:"news.php?do=editnew",
							cache:false,
							data: "&no="+no
							})
							.done(function(data)
								{
								$("#add_news2").css("visibility","visible");
								$("#add_news2").show("slow");
								$("#add_news2").css({"top":100, "left":100});		
									
								var getData = $.parseJSON(data);

								 $('#add_news2 #no').val(getData.no);
								 $('#add_news2 #title2').val(getData.title[0]);
								 $('#add_news2 #summary2').val(getData.short[0]);
								 $('#img').attr("src",'image/thumb1/'+getData.image[0]);
								 $('#old_image').val(getData.image[0]);

								
								$("#FCKeditor1").remove();
								$("#FCKeditor1___Config").remove();
								$("#FCKeditor1___Frame").remove();
			
								
								 var editor = ('<input type="hidden" id="FCKeditor1" name="long2"  style="display:none" /><input type="hidden" id="FCKeditor1___Config" style="display:none" />');
								 $(editor).insertAfter("#com");
								
    							 $('#FCKeditor1').html(' ');
						         $('#FCKeditor1').val(getData.long[0]);
								
							var end =('<iframe id="FCKeditor1___Frame" src="fckeditor/editor/fckeditor.html?InstanceName=FCKeditor1&amp;Toolbar=Default" width="800" height="200" frameborder="0" scrolling="no"></iframe>');				
							 	$(end).insertAfter("#com");
								 
								
								});		//end done	
								
                });//end edit
				
				$(".delete_bt").click(function() 
				{
					var ans = confirm("Do you want to delete this item ?");
					if (ans)
					{
						var no = $(this).attr("data1");
						var image = $(this).attr("data2");
						
						$.ajax({
							url:"news.php?do=deletenew",
							cache:false,
							data: "&no="+no+"&image="+image
							})
							.done(function(){
								$("#tab > tbody").empty();//xóa cái dữ liệu cũ mỗi khi ta click chọn
								list();
								});	
					}
					else
					{
					return false;	
					}
				});					
		});//end done
};

</script>



<?php include("fckeditor/fckeditor.php") ?>

</head>
<body>

<h1> NEWS LIST</h1>
<div id="button_add_news"><a href="#" class="linkPro small green">> Add News</a></div>
<div id="content_news">
<table border="1" cellpadding="0" cellspacing="0" id="tab">
    <thead>
        <th>No</th>
        <th>Title</th>
        <th>Summary</th>
        <th>Image</th>
        <th>Date</th>
        <th colspan="2">Action</th>
    </thead>
    <tbody>
    </tbody>
</table>
 <input type="hidden" name="NoSlide" id="NoSlide" />
          <div class="box_news"></div>
          <div style="text-align:center" class="digg"> <span><a href="#" class="leftback "> &lt; </a> </span> <span class="paging"> </span> <span><a href="#" class="rightforward" > &gt; </a> </span> </div>
          <!-- end paging --> 
</div>

<div id="add_news">
<div id="button_hide"><a href="#" class="linkPro small black">[X]</a></div>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Here we parse the form
    if(!isset($_SESSION['csrf']) || $_SESSION['csrf'] !== $_POST['csrf'])
        throw new RuntimeException('CSRF attack');
 
    //Do the rest of the processing here
}
 
//Generate a key, print a form:
$key = sha1(microtime());
$_SESSION['csrf'] = $key;
?>

<form method="POST" action="news.php?do=addnew" name="addnew" enctype="multipart/form-data">
	<table width="100%" border="0" id="lefttable">
    <tbody>
    <tr>
    	<td>Title</td><td><input type="text" name="title" style="width: 400px; padding: 3px; border: 1px solid black" id="title"></td>   
    </tr>
    <tr>
  		 <td>Summary</td><td><textarea name="summary" cols="150" rows="3" id="summary"></textarea><div class="word_count redlabel"><span></span></div></td>
    </tr>
    <tr>
  		 <td>Content</td><td>
         <label class="redlabel"> Bạn vui lòng không coppy dữ liệu trực tiếp từ website khác</label>
         <input type="hidden" id="FCKeditor2" name="long" style="display:none" />
         <input type="hidden" id="FCKeditor2___Config" value="" style="display:none" />
         <iframe id="FCKeditor2___Frame" src="fckeditor/editor/fckeditor.html?InstanceName=FCKeditor2&amp;Toolbar=Default" width="800" height="200" frameborder="0" scrolling="no"></iframe><br>
         </td>
    </tr>
    <tr>
   		 <td>Image</td><td><input type="file" name="image" id="image1"></td>
    </tr> 
    </tbody>
    <tfoot>
    <tr>
    	<td colspan="2" align="center"><input type="submit" name="submit" value="POST" class="linkPro green" style="width:100px" id="submit"></td>
    </tr>
    </tfoot>
    </table> 
    <input type="hidden" name="csrf" value="<?php echo $key; ?>" />
</form>
</div>

<div id="add_news2">
<div id="button_hide2"><a href="#" class="linkPro small black">[X]</a></div>
<form method="POST" action="news.php?do=updatenew" name="updatenew" enctype="multipart/form-data">
	<table width="100%" border="0" id="lefttable">
    <tbody>
    <tr>
    	<td>Title</td>
        <td><input type="text" name="title" style="width: 400px; padding: 3px; border: 1px solid black" id="title2">
        	<input type="hidden" name="no" id="no">
        </td>   
    </tr>
    <tr>
  		 <td>Summary</td><td><textarea name="summary" cols="150" rows="3" id="summary2" ></textarea><div class="word_count2 redlabel"><span></span></div></td>
    </tr>
    <tr>
  		 <td>Content</td><td>
          <span id="com"><!-- Dua short -->
          </span>
        
         </td>
    </tr>
    <tr>
   		 <td>Image</td><td><input type="file" name="image"><br>
						<img src="#" alt="Picture" width="200" id="img" />
                        <input type="hidden" name="old_image" id="old_image">
					   </td>
    </tr> 
    </tbody>
    <tfoot>
    <tr>
    	<td colspan="2" align="center"><input type="submit" name="submit2" value="UPDATE" class="linkPro green" style="width:100px" id="submit2"></td>
    </tr>
    </tfoot>
    </table> 
    <input type="hidden" name="csrf" value="<?php echo $key; ?>" />
</form>
</div>


<div id="output"></div>

</body>
</html>