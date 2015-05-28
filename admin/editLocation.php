<?php include('checklogin.php');
ob_start();
?>

$lat = isset($_GET['id'])?$_GET['id']:"";

if ($lat)
{
	$xml = simplexml_load_file("data/xmlv2.xml") or die("Error: Cannot create object");
	$lat_old = $lat;		   
			
	foreach($xml->children() as $Positions)
	{
		foreach($Positions->children() as $Position => $data)
		{
			  
			$lat_inxml = $data->lat;
			if ($lat_inxml==$lat) 
			{
			  $la= $data->lat;
			  $ln= $data->lng;
			  $comp = $data->company;
			  $ad = $data->add;
			  $de= $data->des;
			  $ur= $data->url;
			  $im = $data->image;
			  $da = $data->date;
			  $ty = $data['type']; //lấy tên loại
			}
		}	
	}//end foreach
}
else
{
	echo '<script> alert("No, please"); window.location.href="index.php";</script>';	
}
?>
<!DOCTYPE html> 
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Edit Location</title>
<style>
      html, body {
		margin: 0;
		padding: 0;
		height: 100%;
		font-family:Arial, Helvetica, sans-serif;
		font-size: 12px;
      }
	  

#image_edit .img  {
	float: left;
	width: 50px;
	height: 50px;
	padding: 5px;
	background-color:#FF6;
	}
	
.content
{
	background-color:#CFF;	
	height: 100px;
}

.text 
{
	vertical-align:text-top;		
}

#map_canvas
{
	position: relative;
	width:100%; 
	height:100%
}

#add_location
{
	position: absolute;
	top: 10px;
	left: 10px;
	width:200px; 
	height:100px;
}
#showLocation
{
	position: absolute;
	width: 700px;
	display: none;
	background-color:#CCC;
	box-shadow: 3px 3px 10px 5px #000;
	z-index: 9999;
}

#loading
{
	position: absolute;
	top: 50%;
	right: 50%;
	z-index: 9999;
	margin: 0px auto;
	width:300px;
	visibility: hidden;	
	background-color:#FFC;
	border: 1px solid #999;
	text-align: center;
}
table
{
-webkit-border-radius: 3px; 
-moz-border-radius: 3px; 
border-radius: 3px;

}
</style>

<link href="styles/vietcolor.css" rel="stylesheet" type="text/css">
<script language="javascript" src="js/jquery-1.8.3.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script language="javascript" src="js/edit-update.js"></script>

<script>
var file_list="data/list.xml";


$(document).ready(function()
{              
	$("#showLocation").prepend('<input type="button" name="hidden_form" id="hidden_form" value="HIDE" class="linkPro small rounded red" style="position:absolute; top:5px; right:5px" >');    
	
	$("#hidden_form").click(function() {$("#showLocation").hide("slow");});  
	
	$("#showLocation").css("display","block");
	
    $('#showLocation').animate({bottom:"50", right: "5"},300);
	
	$("#submit").click(function(e) {
        if ($("#company").val() =="" ||  $(".input_form option:selected").attr("data") =="")
			{alert("Fill in the blank !!."); return false;}
		else
			{
			$("#showLocation").hide("fast");
			$("#loading").css("visibility","visible");
			}
    });
	
	$("#showLocation").prepend('<input type="button" name="hidden_form" id="hidden_form" value="HIDE" class="linkPro small rounded red" style="position:absolute; top:5px; right:5px" >');
             
	$(window).resize(function()
	{
		var w = $(this).height();
		var div = $('#showLocation').outerHeight();
		var need_H = (w - div)/2;
		
		$('#showLocation').animate({bottom: need_H , right: "5"},300);
		
	});
	
	list();//chay list option
	
});


function list()
{
		$.ajax({url: file_list, cache:false}).done(function(data)
		{
				$(data).find("List").each(function()
				{
				 var no= $(this).find("no").text();
				 var name= $(this).find("name").text();
				 var icon= $(this).find("icon").text();
					
				 var elem = '<option value="'+name+'" data="'+icon+'" >'+name+'</option>';
				 $(".input_form").append(elem);//thêm dữ liệu vào bảng bên dưới
				});	
				
				$(".input_form").change(function(e) {//lấy giá trị khi ta chọn
					var va = $(".input_form option:selected").attr("data");
                   $("#icon").attr("value",va);
                });
				
		});//end done
}




</script>
</head>
<body onLoad="initialize()">
  <div id="map_canvas"></div>
  <div id="add_location">
   	 <a href="#" onClick="location.href='getmap.php';" class="linkPro rounded black">< Back</a> <a href="#" onClick="initialize();" class="linkPro rounded blue">Reload Map</a>
   </div>
   <div id="loading">Loading... <br><img src="icon/loader.gif"></div>
  <div id="showLocation">	
<form method="POST" action="xml.php?do=update" name="addxmlform" enctype="multipart/form-data" >
  <table width="40%" border="0" align="center">
  <tr>
  	<td><label title="Latitude">LAT</label></td>
    <td><input type="text" name="lat" id="lat" onClick="SelectText('lat')"  class="input_form" value="<?= $lat; ?>">
    	<input type="hidden" name="lat_old" value="<?= $lat_old; ?>">
    </td>
  </tr>
    <tr>
  	<td><label title="longitude">LNG</label></td>
    <td><input type="text" name="lng" id="lng" onClick="SelectText('lng')" class="input_form" value="<?= $ln; ?>"></td>
  </tr>
  <tr>
  	<td><label title="longitude">Type</label></td>
    <td><select name="type"  class="input_form">
			<option value="" data="">-------------</option>
    	</select>
        <input type="hidden" name="icon" id="icon">
    </td>
  </tr>
   <tr>
  	<td><label title="company">Company</label></td>
    <td><input type="text" name="company" id="company" value="<?= $comp; ?>" class="input_form"></td>
  </tr>
   <tr>
  	<td><label title="address">Address</label></td>
    <td><textarea name="add" cols="70" rows="5" class="input_form"><?= $ad; ?></textarea></td>
  </tr>
  <tr>
  	<td><label title="description">Description</label></td>
    <td><textarea name="des" cols="70" rows="5" class="input_form"><?= $de; ?></textarea></td>
  </tr>
  <tr>
  	<td><label title="url">Url</label></td>
    <td><input type="text" name="url" id="url" value="<?= $ur; ?>" class="input_form"></td>
  </tr>
   <tr>
  	<td><label title="image">Image</label></td>
    <td><input type="file" name="img" class="input_form" id="img"><br>
    	<input type="hidden" name="image_old" value="<?= $im; ?>">
    	<? if ($im =="") 
        $pic ="icon/no_image.png";
        	else
         $pic="image/".$im;
        ?>
    	<img src="<?= $pic; ?>" width="200px" height="200px" alt="hình minh họa"/ id="image_edit"><br>
        <? echo "Date: ".$da ; ?>
        </td>
  </tr>
  <tr>
  <td colspan="2"><input type="submit" name="submit" id="submit" value="Update" class="linkPro small round yellow" ></td>
  </tr>
</table>
</form>
  </div>
</body>
</html>

