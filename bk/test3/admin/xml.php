<?php
ob_start();
include('checklogin.php');
include("config/functions.php");
echo '<meta charset="UTF-8" /> ';

$do = isset($_GET["do"])?$_GET["do"]:"add";

		if ($do=="add")
		{
			add_xml();
		}
		else if ($do=="edit")
		{
			//edit_xml();	
		}
		else if ($do=="update")
		{
			update_xml();	
		}
		else if ($do=="delete")
		{
			delete_xml();	
		}


function add_xml()
{
if (isset($_POST['submit']))
	{
		if (empty($_POST['lat']) || empty($_POST['lng']))
				{
					echo "<script type='application/javascript'> alert('Please, Choose position on GMAP.'); self.location='getlocation.php'; </script>";
				}
				else
				{	
					
					$lat = $_POST['lat'];				
					if (find($lat)== 0)//neu khong trung
						{				
							$lng = $_POST['lng'];
							$type = $_POST['type'];
							$company = $_POST['company'];
							$add =$_POST['add'];
							$des = $_POST['des'];
							$url = $_POST['url'];
							$date = date ('d/m/Y H:i:s',time());
							
							$icon =isset($_POST['icon'])?$_POST['icon']:"";
							
							$image_name = $_FILES['img']['name'];
							$image_tmp = $_FILES['img']['tmp_name'];
							$image_size = $_FILES['img']['size'];
							
							$image_name_converted = TIME_TEMP.'_'.stripUnicode($image_name);
							$des_path= IMG_FOLDER.$image_name_converted;
							$result=0;
							if (@move_uploaded_file($image_tmp,$des_path))
								{
								Insert($lat,$lng,$type,$company,$add,$des,$image_name_converted,$url,$date,$icon);
								header("Cache-Control: no-cache, must-revalidate"); //ko luu cache
								header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
								header("location: getmap.php");
								/*echo "<script> window.location.href='getmap.php';</script>";*/
								}
								
						}
						else
						{
							
							echo "<script> alert('Duplicate position.Please, choose another position !'); window.location.href='getmap.php';</script>";
						}
				}
	}
else //else submit
	{
	echo "<script type='application/javascript'> alert('Back to Get Position'); self.location='getlocation.php'; </script>";
	}
}


function edit_xml()
{
$lat = $_GET['id'];
$xml = simplexml_load_file("data/xmlv2.xml") or die("Error: Cannot create object");
		   
		
foreach($xml->children() as $Positions)
{
    foreach($Positions->children() as $Position => $data)
	{
		  $ty = $data['type']; //lấy tên loại
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
		  include("editLocation.php");
		}
    }
}
}//end edit



function update_xml()
{
$submit= isset($_POST['submit'])?$_POST['submit']:"";

if ($submit)
	{
		$lat_old= isset($_POST["lat_old"])?$_POST["lat_old"]:""; //lấy giá trị của input hidden 
		$lat_new= isset($_POST["lat"])?$_POST["lat"]:""; 
		
			if ($lat_new !="")
			{
				if ($lat_old != $lat_new)
					{
					$lat = $lat_new;
					}
				else
					{
					$lat = $lat_old;
					}
				
				$lng_n =  isset($_POST["lng"])?$_POST["lng"]:"";
				$com_n= isset($_POST["company"])?$_POST["company"]:"";
				$add_n= isset($_POST["add"])?$_POST["add"]:"";
				$des_n= isset($_POST["des"])?$_POST["des"]:"";
				$url_n= isset($_POST["url"])?$_POST["url"]:"";
				$type_n = isset($_POST["type"])?$_POST["type"]:"";
				$date_n = date("d/m/Y H:i:s",time());
				
				$image_name = $_FILES['img']['name'];
				$image_tmp = $_FILES['img']['tmp_name'];
				$image_size = $_FILES['img']['size'];
				
				$image_old =  isset($_POST["image_old"])?$_POST["image_old"]:""; // ten file cũ
				
				$icon =isset($_POST['icon'])?$_POST['icon']:"";
				
				if ($image_name != "" && $image_old != $image_name)
				{	
					$image_name_converted = TIME_TEMP.'_'.stripUnicode($image_name);
					$des_path= IMG_FOLDER.$image_name_converted;
					$result=0;
					if (@move_uploaded_file($image_tmp,$des_path))
						{
						update($lat_old,$lat,$lng_n,$type_n,$com_n,$add_n,$des_n,$image_name_converted,$url_n,$date_n,$icon);
						unlink(IMG_FOLDER.$image_old);
						}
					
				}
				else if ($image_name == "")
				{
						update($lat_old,$lat,$lng_n,$type_n,$com_n,$add_n,$des_n,$image_old,$url_n,$date_n, $icon);
				}
				header("Cache-Control: no-cache, must-revalidate"); //ko luu cache
				header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
				header("location: getmap.php");
			}
	}
	else
	{
	echo '<script> alert("You can not access directly file. Please, back again."); window.location.href="index.php";</script>';	
	}
}//end update




function delete_xml()
{
	$lat= isset($_GET["id"])?$_GET["id"]:"";
	$img= isset($_GET["img"])?$_GET["img"]:"";
	if	(unlink(IMG_FOLDER.$img))
	{
		delete($lat);
		header("Cache-Control: no-cache, must-revalidate"); //ko luu cache
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		echo '<script>alert("Delete Success."); window.location.href="getmap.php";</script>';
	}
	else
	{
		echo '<script>alert("Delete False."); window.location.href="index.php";</script>';
	}
}//end func delete

?>