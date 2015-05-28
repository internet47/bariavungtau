<?php
ob_start();
include('checklogin.php'); 
include("config/functions.php");

	$do = isset($_GET['do'])?$_GET['do']:"";
		if ($do== "addlist")
		{
			add_item();	
		}
		else if ($do == "updatelist")
		{
			update_item();
		}
		else if ($do == "deletelist")
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
			$name = isset($_POST['name'])?$_POST['name']:"";
			
			$image_name = $_FILES['icon']['name'];
			$image_tmp = $_FILES['icon']['tmp_name'];
			$image_size = $_FILES['icon']['size'];
			
			
							
			$image_name_converted = TIME_TEMP.'_'.stripUnicode($image_name);
			$des_path= ICON_FOLDER.$image_name_converted;
			
			
			if (@move_uploaded_file($image_tmp,$des_path))
			{
				Insert_list($name,$image_name_converted);
				echo '<script>alert("Add success  !!!"); window.location.href="managelist.php";</script>';
			}
			else
			{
				echo '<script>alert("Can not upload icon. Please, check again: Permission on folder icon  !!!"); window.history.back(-1);</script>';
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
			$name = isset($_POST['name'])?$_POST['name']:"";
			$no = isset($_POST['no'])?$_POST['no']:"";
			$icon_old = isset($_POST['icon_old'])?$_POST['icon_old']:"";
			
			$image_name = $_FILES['icon']['name'];
			$image_tmp = $_FILES['icon']['tmp_name'];
			$image_size = $_FILES['icon']['size'];
			
			
			if ($no !="" && $name !="")
			{				
				if ($image_name =="")
				{
				update_list($no,$name,$icon_old);
				header("location: managelist.php");
				}
				else
				{
				$image_name_converted = TIME_TEMP.'_'.stripUnicode($image_name);
				$des_path= ICON_FOLDER.$image_name_converted;
				
			if (@move_uploaded_file($image_tmp,$des_path))
					{
					update_list($no,$name,$image_name_converted);
					unlink(ICON_FOLDER.$icon_old);
					}
					header("location: managelist.php");
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
			$icon = isset($_GET['icon'])?$_GET['icon']:"";
			
			if	(unlink(ICON_FOLDER.$icon))
			{
				delete_list($no);
				header("Cache-Control: no-cache, must-revalidate"); //ko luu cache
				header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
				echo '<script>alert("Delete Success."); window.location.href="managelist.php";</script>';
			}
			else
			{
				echo '<script>alert("Delete False."); window.location.href="managelist.php";</script>';
			}
	}
?>