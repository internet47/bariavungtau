<? 
include('checklogin.php');
ob_start(); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>FVN Map</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->

	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<!--[if gte IE 6]>
	<link rel="stylesheet" type="text/css" href="styles/ie.css">
	<![endif]-->

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicon================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">


	<!-- jQuery================================================== -->
<script type="text/javascript" charset="utf-8" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> 

<script type="text/javascript" charset="utf-8">
		!window.jQuery && document.write('<script charset="utf-8" src="js\/jquery.min.js"><\/script>');
		!window.jQuery && document.write('<script charset="utf-8" src="js\/jquery-ui.min.js"><\/script>');
</script>
	<!-- jQuery================================================== -->
    

<!--//ADDONS//-->    
<link rel="stylesheet" type="text/css" href="styles/file-upload.css">
<script src="js/form-min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/file-upload.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="libs/tiptip/tipTip.css">
<script src="libs/tiptip/jquery.tipTip.js" type="text/javascript"></script>
<!--//ADDONS//-->
      

<script src="js/script.js" type="text/javascript" charset="utf-8" ></script>
<!-- // valudator // -->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/messages_vi.js"></script>
    	<script type="text/javascript">
		$(document).ready(function(){
			$("#contact").validate({
				errorElement: "span" //Thành phần HTML hiện thông báo lỗi
				//Sử dụng tùy chọn rules cho những validate không hỗ trợ bởi class name
				/*rules: {
					cpassword: {
						equalTo: "#password" //So sánh với trường cpassword với thành trường có id là password
					},
					min_field: { min: 5 }, //Giá trị tối thiểu
					max_field: { max : 10 }, //Giá trị tối đa
					range_field: { range: [4,10] }, //Giá trị trong khoảng từ 4 - 10
					rangelength_field: { rangelength: [4,10] } //Chiều dài chuỗi trong khoảng từ 4 - 10 ký tự
				}*/
			});
		});
	</script>
      <!-- // calendar jquery //-->
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" /> 
  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datapicker" ).datepicker();
  });
  </script>
  
  

<script type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
if (limitField.value.length > limitNum) {
limitField.value = limitField.value.substring(0, limitNum);
} else {
limitCount.value = limitNum - limitField.value.length;
}
}
</script>

</head>
<body>

<div class="container">

<aside>
	<div class="navbar">
    	<ul>
            <li><a href="#">Home</a></li>
            <li><a href="#"><span>Gallery</span></a></li>
            <li><a href="#"><span>Upload image</span></a></li>
        </ul>
    </div>
</aside>

		<div class="sixteen columns">
			<h1 class="remove-bottom">Form Upload Image </h1>

    <?php include('config.php');
		//create_table('images',array('id','title','description','image','date','status'));
	?>
    <?php
		//include('upload_image.php');
		function getExt($filename){
			return $ext = strtolower(substr(strrchr($filename, '.'), 1));
		}
		if(isset($_POST['submit']))
		{
			$id = uniqid();
			$imagedescription = $_POST['imagedescription'];
			$imagetitle = $_POST['imagetitle'];
			$uploadfile = 'test.jpg';
			$val='';
			$valthumb='';	
			//$uploadfile = $_GET['uploadfile'];
			$dir = 'uploads/images/';
			$thumb = $dir.'thumbs/';
			$uploadpath = 'uploads/images/';      // directory to store the uploaded files
			$max_size = 2000;          // maximum file size, in KiloBytes
			$alwidth = 900;            // maximum allowed width, in pixels
			$alheight = 800;   
			$w=150;
			$h=150;        // maximum allowed height, in pixels
			$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png');        // allowed extensions
			
			$ext = getExt($_FILES['uploadfile']['name']);
			
			if(isset($_FILES['uploadfile']) && strlen($_FILES['uploadfile']['name']) > 1)
			{
				$uploadpath = $uploadpath . basename( $_FILES['uploadfile']['name']);       // gets the file name
				$sepext = explode('.', strtolower($_FILES['uploadfile']['name']));
				$type = end($sepext);       // gets extension
				list($width, $height) = getimagesize($_FILES['uploadfile']['tmp_name']);     // gets image width and height
				$err = '';         // to store the errors
		
				// Checks if the file has allowed type, size, width and height (for images)
				if(!in_array($type, $allowtype)) 
					$err .= 'The file: <b>'. $_FILES['uploadfile']['name']. '</b> not has the allowed extension type.';
				if($_FILES['uploadfile']['size'] > $max_size*3000) 
					$err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
				if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight))
					$err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;
				if (file_exists('uploads/images/' . $_FILES['uploadfile']['name']))
				{
					echo $_FILES['uploadfile']['name'] . " already exists. ";
					$err .=''.$_FILES['uploadfile']['name'] . '" already exists. "';
					$val ='';
				}
				// If no errors, upload the image, else, output the errors
				if($err == '')
				{
					if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadpath))
					{ 
						 // echo 'File: <b>'. basename( $_FILES['uploadfile']['name']). '</b> successfully uploaded:';
						 
							//$val = basename( $_FILES['uploadfile']['name']); 
							list($width, $height) = getimagesize($dir.$_FILES['uploadfile']['name']);
							$image_p = imagecreatetruecolor($w, $h);
							
							switch($ext){
								case "jpg":
									$image = imagecreatefromjpeg($dir.$_FILES['uploadfile']['name']);
								break;
								
								case "gif":
									$image = imagecreatefromgif($dir.$_FILES['uploadfile']['name']);
								break;
								
								case "png":
									$image = imagecreatefrompng($dir.$_FILES['uploadfile']['name']);
								break;
								
								default :
									$image = imagecreatefromjpeg($dir.$_FILES['uploadfile']['name']);
								break;
							}
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $w, $h, $width, $height);
						// Output & save to file
						$thumb_file = 'thumb_'.time().'.jpg';
						$tmp_content = imagejpeg($image_p, $thumb.$thumb_file, 100);
					//	echo $thumb_file;
						$val = basename( $_FILES['uploadfile']['name']);
						$valthumb = $thumb_file;
							
						//echo $val;
						
						  //echo $val;
						 // $uploadfile = $value;
						  //echo $uploadfile;	
						 // echo '<br/>File type: <b>'. $_FILES['fileup']['type'] .'</b>';
						  //echo '<br />Size: <b>'. number_format($_FILES['fileup']['size']/1024, 3, '.', '') .'</b> KB';
						  //if(isset($width) && isset($height))
							//echo '<br/>Image Width x Height: '. $width. ' x '. $height;
						 // echo '<br/><br/>Image address: <b>http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['REQUEST_URI']), '\\/').'/'.$uploadpath.'</b>';
					}
					else{
						echo '<b>Unable to upload the file.</b>';
						$val='';}
				}
				else
				echo $err;
			}
			$dateimage = $_POST['dateimage'];	
			$status = 1;	
			if($val=='' || $valthumb=='')
				echo 'Add gallary image not complete';
			else
			{
				add_data('images',array($id,$imagetitle,$imagedescription,$val,$valthumb,$dateimage,$status));
				echo'<script>';
				echo'alert("đã thành công")'; 
				echo'</script>';
				header('Location: listimage.php');	
			}
		}
	?>
	<!--//Content//-->
	<div id="contentfrm">
    <form action="#" method="POST" id="contact" name="form" enctype="multipart/form-data">
    	<div class="incon"> <hr /> </div>
        
        <div class="texttitle"> Image title</div>
        <div class="frmname"><input type="text" class="required" name="imagetitle" maxlength="30"><span id="charLeft">maximum 30 character</span></div>
        
        <div class="texttitle">Image Description</div>
        <div class="frmname">
         <textarea name="imagedescription" id="inputText" class="required" cols="20" rows="5" onKeyDown="limitText(this.form.imagedescription,this.form.countdown,200);" onKeyUp="limitText(this.form.imagedescription,this.form.countdown,200);"></textarea>
        <span id="charLeft">maximum 200 character</span></div>
        
        <div class="texttitle">Image</div>
        <div class="frmname">
        <div id="uploadfrmvideo1" class="frmname">
        	<div class="field">
                <label class="file-upload">
                    <span><strong>Upload file I</strong></span>
                    <input type="file" name="uploadfile" />
                </label>
            </div>
		</div>        
        </div>
        <div class="texttitle">Date</div>
        <div class="frmname"><input type="text" class="required" id="datapicker" name="dateimage" value="" readonly="readonly" /></div>
        
        <div class="texttitle">&nbsp;</div>
        <div class="frmname subres">
        <!--<input type="reset" name="reset" value="Reset">-->
        <input type="submit" name="submit" value="Submit">
        </div>

            
        
    </div>
    </form>
	<!--//Content//-->    

		</div>


</div>



</body>
</html>