<?php include('checklogin.php'); 
ob_start();
include("config/functions.php");

	$do = isset($_GET['do'])?$_GET['do']:"";
		if ($do== "addnew")
		{
			add_item();	
		}
		else if ($do == "editnew")
		{
			edit_item();
		}
		else if ($do == "updatenew")
		{
			update_item();
		}
		else if ($do == "deletenew")
		{
			delete_item();
		}
		else
		{
		//die();	
		}
/*----------------- FUNCTION--------------------------------------------------------- */

	function add_item()
	{
		$submit= isset($_POST['submit']);
		if ($submit)
		{
			$title = isset($_POST['title'])?$_POST['title']:"";
			$title = addslashes($title);
			
			$summary = isset($_POST['summary'])?$_POST['summary']:"";
			//$summary =  addslashes($summary);
			
			$long = isset($_POST['long'])?$_POST['long']:"";
			//$long =  addslashes($long);
			
			$image_name = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];
			$image_size = $_FILES['image']['size'];
			
			$image_name_converted = TIME_TEMP.'_'.stripUnicode($image_name);
			$des_path= IMG_FOLDER.$image_name_converted;
			
			
			if (@move_uploaded_file($image_tmp,$des_path))
			{
				Insert_new($title,$summary,$long,$image_name_converted);
				createthumb(IMG_FOLDER,THUM_BIG, "380", $image_name_converted);
				createthumb(IMG_FOLDER,THUM_SMALL, "100", $image_name_converted);
				
				echo '<script>alert("Add success  !!!"); window.location.href="listnews.php";</script>';
			}
			else
			{
				echo '<script>alert("Can not upload icon. Please, check again: Permission on folder image  !!!"); window.history.back(-1);</script>';
			}
		} //end submit
		else
		{
		echo '<script>alert("No, please !!!"); window.history.back(-1);</script>';
		}
		
	}//end add
	
	
	
	function update_item()
	{
		$submit2= isset($_POST['submit2']);
		if ($submit2)
		{
			$no = isset($_POST['no'])?$_POST['no']:"";
			$old_image = isset($_POST['old_image'])?$_POST['old_image']:"";
			$title = isset($_POST['title'])?$_POST['title']:"";
			$title = addslashes($title);
			$summary = isset($_POST['summary'])?$_POST['summary']:"";
			$long = isset($_POST['long2'])?$_POST['long2']:"";

			$image_name = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];
			$image_size = $_FILES['image']['size'];
			
		if ($no !="" && $title !="")
			{				
				if ($image_name =="")
				{
				update_new($no,$title,$summary,$long,$old_image);
				header("location: listnews.php");
				}
				else
				{
				$image_name_converted = TIME_TEMP.'_'.stripUnicode($image_name);
				$des_path= IMG_FOLDER.$image_name_converted;
				
					if (@move_uploaded_file($image_tmp,$des_path))
							{
							createthumb(IMG_FOLDER,THUM_BIG, "380", $image_name_converted);
							createthumb(IMG_FOLDER,THUM_SMALL, "100", $image_name_converted);
							update_new($no,$title,$summary,$long,$image_name_converted);
							unlink(IMG_FOLDER.$old_image);
							unlink(THUM_BIG.$old_image);
							unlink(THUM_SMALL.$old_image);
							}
							header("location: listnews.php");
				}
			}
			else
			{
				echo '<script>alert("Please, type name of list !!!"); window.history.back(-1);</script>';	
			}
		} //end submit
		else
			{
			echo '<script>alert("No, please !!!"); window.history.back(-1);</script>';
			}
	}//end edit
	
	
	function delete_item()
	{
			$no = isset($_GET['no'])?$_GET['no']:"";
			$image = isset($_GET['image'])?$_GET['image']:"";
			
			if (unlink(IMG_FOLDER.$image))
			{
				unlink(THUM_BIG.$image);
				unlink(THUM_SMALL.$image);
				delete_new($no);
				header("Cache-Control: no-cache, must-revalidate"); //ko luu cache
				header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
				echo '<script>alert("Delete Success."); window.location.href="listnews.php";</script>';
			}
			else
			{
				echo '<script>alert("Delete False."); window.location.href="listnews.php";</script>';
			}
	}
	
	function edit_item()//tìm kiếm và xuất dữ liệu ra form
	{
		$no = isset($_GET['no'])?$_GET['no']:"";
		if ($no)
		{
			$xml = simplexml_load_file(FILE_NEW) or die("Error: Cannot load file xml"); 	
			foreach($xml->children() as $Positions)
			{
				foreach($Positions->children() as $Position => $data)
				{
					  $ty = $data['type']; //lấy tên loại social
					  $no_inxml = $data->no;
					if ($no_inxml==$no) 
					{
					  $title= $data->title;
					  $short= $data->short;
					  $long= $data->long;
					  $image = $data->image;
					  $dateposted = $data->dateposted;
					  
					  $out = array('no' => $no,'title' => $title, 'short'=>$short, "long"=>$long, "image"=>$image, "dateposted" =>$dateposted);// đưa vào mãng
					  echo json_encode($out);
					  die();
					}
				}
			}//end foreach
		}//end if
		else
		{
			echo '<script>alert("No, Please."); window.location.href="listnews.php";</script>';
		}
		
	}
	
	
?>