<?
ob_start(); 
include('checklogin.php');

/////////////DEFINE//////////////
define("IMG_FOLDER","image/"); //tên thư mục upload
define("ICON_FOLDER","icon/"); //tên thư mục upload
define("END_FILE","vungtau_".date('d-m-Y-H-i-s', time())); //ten file sau khi /
define("TIME_TEMP",date('d-m-Y-H-i-s',time()));
define("FILE","data/xmlv2.xml");
define("FILE_LIST","data/list.xml");
define("FILE_NEW","data/news.xml");
define("FILE_NEW_INDEX","/admin/data/news.xml");
define("THUM_BIG","image/thumb1/");
define("THUM_SMALL","image/thumb2/");
/////////////////////////////////





function stripUnicode($str)
{
  if(!$str) return false;
   $unicode = array(
      'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
      'd'=>'đ',
      'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
      'i'=>'í|ì|ỉ|ĩ|ị',
      'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
      'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
      'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
	  '_'=>' ',
);
foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
return $str;
}

function getHeight($image) {
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}


//You do not need to alter these functions
function getWidth($image) {
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}



function Insert($lat,$lng,$type,$company,$add,$des,$image,$url,$date,$icon)
{
$fp = fopen(FILE, "rb") or die("Can not open file XML. Please check file again.");
$str = fread($fp, filesize(FILE));
  
$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Can not insert data to XML file. Please check permission on folder Data. thks");

// get document element
$root   = $xml->documentElement;
$fnode  = $root->firstChild;

//add a node
$ori    = $fnode->childNodes->item(0);//vị trí chèn từ 0 (trên cùng)

$company_xml  = $xml->createElement("company"); 
$companyText = $xml->createTextNode($company); 
$company_xml->appendChild($companyText); 

$lat_xml  = $xml->createElement("lat"); 
$latText = $xml->createTextNode($lat); 
$lat_xml->appendChild($latText); 

$lng_xml  = $xml->createElement("lng"); 
$lngText = $xml->createTextNode($lng); 
$lng_xml->appendChild($lngText); 

$add_xml  = $xml->createElement("add"); 
$addText = $xml->createTextNode($add); 
$add_xml->appendChild($addText); 

$des_xml  = $xml->createElement("des"); 
$desText = $xml->createTextNode($des); 
$des_xml->appendChild($desText); 

$image_xml  = $xml->createElement("image"); 
$imageText = $xml->createTextNode($image); 
$image_xml->appendChild($imageText); 

$icon_xml  = $xml->createElement("icon"); 
$iconText = $xml->createTextNode($icon); 
$icon_xml->appendChild($iconText); 

$url_xml  = $xml->createElement("url"); 
$urlText = $xml->createTextNode($url); 
$url_xml->appendChild($urlText); 

$date_xml  = $xml->createElement("date"); 
$dateText = $xml->createTextNode($date); 
$date_xml->appendChild($dateText); 

$Position   = $xml->createElement("Position");
$Position->setAttribute("type",$type);
$Position->appendChild($company_xml);
$Position->appendChild($lat_xml);
$Position->appendChild($lng_xml);
$Position->appendChild($add_xml);
$Position->appendChild($des_xml);
$Position->appendChild($image_xml);
$Position->appendChild($icon_xml);
$Position->appendChild($url_xml);
$Position->appendChild($date_xml);

$fnode->insertBefore($Position,$ori);

$xml->save(FILE) or die("Can not insert data to XML file. Please check permission on folder Data. thks"); //lưu lại nếu file chưa tạo*/
}



function update($lat_old,$lat,$lng_n,$type_n,$com_n,$add_n,$des_n,$image_n,$url_n,$date_n,$icon)
{
	$fp = fopen(FILE, "rb") or die("Can not open file XML. Please check file again.");
	$str = fread($fp, filesize(FILE));
	
	$xml = new DOMDocument();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->loadXML($str) or die("Can not insert data to XML file. Please check permission on folder Data. thks");
	
	// get document element
	$root   = $xml->documentElement;
	$fnode  = $root->firstChild;
	
	$id_LAT = $xml->getElementsByTagName("lat"); //tìm tag có tên là lat: <lat></lat>
	$i = 0;
	foreach ($id_LAT as $latlat)
	{
	if ($latlat->nodeValue == $lat_old)	//nếu gái trị chứa bên trong <lat></lat> mà = giá trị của $find
	{
		$op = $fnode->childNodes->item($i); // vị trí của NODE thỏa điểu kiện tìm được
			
		$company_xml  = $xml->createElement("company"); 
		$companyText = $xml->createTextNode($com_n); 
		$company_xml->appendChild($companyText); 
		
		$lat_xml  = $xml->createElement("lat"); 
		$latText = $xml->createTextNode($lat); 
		$lat_xml->appendChild($latText); 
		
		$lng_xml  = $xml->createElement("lng"); 
		$lngText = $xml->createTextNode($lng_n); 
		$lng_xml->appendChild($lngText); 
		
		$add_xml  = $xml->createElement("add"); 
		$addText = $xml->createTextNode($add_n); 
		$add_xml->appendChild($addText); 
		
		$des_xml  = $xml->createElement("des"); 
		$desText = $xml->createTextNode($des_n); 
		$des_xml->appendChild($desText); 
		
		$image_xml  = $xml->createElement("image"); 
		$imageText = $xml->createTextNode($image_n); 
		$image_xml->appendChild($imageText); 
		
		$icon_xml  = $xml->createElement("icon"); 
		$iconText = $xml->createTextNode($icon); 
		$icon_xml->appendChild($iconText); 
		
		$url_xml  = $xml->createElement("url"); 
		$urlText = $xml->createTextNode($url_n); 
		$url_xml->appendChild($urlText); 
		
		$date_xml  = $xml->createElement("date"); 
		$dateText = $xml->createTextNode($date_n); 
		$date_xml->appendChild($dateText); 
	
		$Position   = $xml->createElement("Position");
		$Position->setAttribute("type",$type_n);
		$Position->appendChild($company_xml);
		$Position->appendChild($lat_xml);
		$Position->appendChild($lng_xml);
		$Position->appendChild($add_xml);
		$Position->appendChild($des_xml);
		$Position->appendChild($image_xml);
		$Position->appendChild($icon_xml);
		$Position->appendChild($url_xml);
		$Position->appendChild($date_xml);
			
		$fnode->replaceChild($Position,$op); // thay thế giá trị cũ = giá trị mới tại vị trí cũ $op
	}
	 $i ++; 
	}
	$xml->save(FILE) or die("Can not insert data to XML file. Please check permission on folder Data. thks"); //lưu lại nếu file chưa tạo	
}


function delete($lat_find)
{

$fp = fopen(FILE, "rb") or die("Can not open file XML. Please check file again.");
$str = fread($fp, filesize(FILE));
  
$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Can not insert data to XML file. Please check permission on folder Data. thks");


// get document element
$root   = $xml->documentElement;
$fnode  = $root->firstChild;

$id_LAT = $xml->getElementsByTagName("lat"); //tìm tag có tên là lat: <lat></lat>

$i= 0;
foreach ($id_LAT as $lat)
{
	if ($lat->nodeValue ==$lat_find)	//nếu gái trị chứa bên trong <lat></lat> mà = D
	{
		$ori = $fnode->childNodes->item($i);
		$fnode->removeChild($ori);
	}
	 $i += 1; 
}

$xml->save(FILE) or die("Can not insert data to XML file. Please check permission on folder Data. thks"); //lưu lại nếu file chưa tạo
	
}//ednc function delete



function find($lat_find)
{
	$fp = fopen(FILE, "rb") or die("Can not open file XML. Please check file again.");
	$str = fread($fp, filesize(FILE));
	
	$xml = new DOMDocument();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->loadXML($str) or die("Can not insert data to XML file. Please check permission on folder Data. thks");
	
	// get document element
	$root   = $xml->documentElement;
	$fnode  = $root->firstChild;
	
	$id_LAT = $xml->getElementsByTagName("lat"); //tìm tag có tên là lat: <lat></lat>
	foreach ($id_LAT as $latlat)
	{
		if ($latlat->nodeValue == $lat_find)	//nếu gái trị chứa bên trong <lat></lat> mà = giá trị của $find
		{
			return 1;
			break;
		}
		else
		{
			return 0;	
		}
	}
}

///////////////////////////////// LIST /////////////////////////////////////////////////////////////

function Insert_list($name,$icon)
{
$fp = fopen(FILE_LIST, "rb") or die("Can not open file XML. Please check file again.");
$str = fread($fp, filesize(FILE_LIST));
  
$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Can not insert data to XML file. Please check permission on folder Data. thks");

// get document element
$root   = $xml->documentElement;
$fnode  = $root->firstChild;

//add a node
$ori    = $fnode->childNodes->item(0);//vị trí chèn từ 0 (trên cùng)

$no = MaxNo() + 1;//lấy giá trị lơn nhất của NO và +1
$no_xml  = $xml->createElement("no"); 
$noText = $xml->createTextNode($no); 
$no_xml->appendChild($noText); 

$name_xml  = $xml->createElement("name"); 
$nameText = $xml->createTextNode($name); 
$name_xml->appendChild($nameText); 

$icon_xml  = $xml->createElement("icon"); 
$iconText = $xml->createTextNode($icon); 
$icon_xml->appendChild($iconText); 

$Position   = $xml->createElement("List");
$Position->appendChild($no_xml);
$Position->appendChild($name_xml);
$Position->appendChild($icon_xml);

$fnode->insertBefore($Position,$ori);

$xml->save(FILE_LIST) or die("Can not insert data to XML file. Please check permission on folder Data. thks"); //lưu lại nếu file chưa tạo*/
}



function MaxNo()// hàm lấy số ID lớn nhất
{
	$arr= array();
	$xml = simplexml_load_file(FILE_LIST) or die("Can not insert data to XML file. Please check permission on folder Data. thks: Cannot create object");
	foreach($xml->children() as $Positions)
	{
		foreach($Positions->children() as $Position => $data)
		{
			 $no = (string) $data->no;
			 array_push($arr,$no);
		}
	}//end foreach
		 return max($arr); // trả về số lớn nhất
		
}



function update_list($no,$name,$icon)
{
	$fp = fopen(FILE_LIST, "rb") or die("Can not open file XML. Please check file again.");
	$str = fread($fp, filesize(FILE_LIST));
	
	$xml = new DOMDocument();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->loadXML($str) or die("Can not insert data to XML file. Please check permission on folder Data. thks");
	
	// get document element
	$root   = $xml->documentElement;
	$fnode  = $root->firstChild;
	
	$id_no = $xml->getElementsByTagName("no"); //tìm tag có tên là lat: <lat></lat>
	$i = 0;
	foreach ($id_no as $nono)
	{
	if ($nono->nodeValue == $no)	//nếu gái trị chứa bên trong <lat></lat> mà = giá trị của $find
	{
		$op = $fnode->childNodes->item($i); // vị trí của NODE thỏa điểu kiện tìm được
			
		$no_xml  = $xml->createElement("no"); 
		$noText = $xml->createTextNode($no); 
		$no_xml->appendChild($noText); 
		
		$name_xml  = $xml->createElement("name"); 
		$nameText = $xml->createTextNode($name); 
		$name_xml->appendChild($nameText); 
		
		$icon_xml  = $xml->createElement("icon"); 
		$iconText = $xml->createTextNode($icon); 
		$icon_xml->appendChild($iconText); 
		
		$Position   = $xml->createElement("List");
		$Position->appendChild($no_xml);
		$Position->appendChild($name_xml);
		$Position->appendChild($icon_xml);
			
		$fnode->replaceChild($Position,$op); // thay thế giá trị cũ = giá trị mới tại vị trí cũ $op
	}
	 $i ++; 
	}
	$xml->save(FILE_LIST) or die("Can not insert data to XML file. Please check permission on folder Data. thks"); //lưu lại nếu file chưa tạo	
}


function delete_list($no)
{

$fp = fopen(FILE_LIST, "rb") or die("Can not open file XML. Please check file again.");
$str = fread($fp, filesize(FILE_LIST));
  
$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Can not insert data to XML file. Please check permission on folder Data. thks");

// get document element
$root   = $xml->documentElement;
$fnode  = $root->firstChild;

$id_no = $xml->getElementsByTagName("no"); //tìm tag có tên là lat: <lat></lat>

$i= 0;
foreach ($id_no as $nono)
{
	if ($nono->nodeValue == $no)	//nếu gía trị chứa bên trong <lat></lat> mà = D
	{
		$ori = $fnode->childNodes->item($i);
		$fnode->removeChild($ori);
	}
	 $i += 1; 
}

$xml->save(FILE_LIST) or die("Can not insert data to XML file. Please check permission on folder Data. thks"); //lưu lại nếu file chưa tạo
	
}//ednc function delete



//////////////////////////////////////// NEWS /////////////////////////////////////////////

function MaxNo_New()// hàm lấy số ID lớn nhất
{
	$arr= array();
	$xml = simplexml_load_file(FILE_NEW) or die("Can not load XML file. Please check permission on folder Data. thks: Cannot create object");
	foreach($xml->children() as $Positions)
	{
		foreach($Positions->children() as $Position => $data)
		{
			 $no = (string) $data->no;
			 array_push($arr,$no);
		}
	}//end foreach
		 return max($arr); // trả về số lớn nhất
		
}



function Insert_new($title,$summary,$long,$image_name_converted)
{
$fp = fopen(FILE_NEW, "rb") or die("Can not open file XML. Please check file again.");
$str = fread($fp, filesize(FILE_NEW));
  
$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Can not insert data to XML file. Please check permission on folder Data. thks");

// get document element
$root   = $xml->documentElement;
$fnode  = $root->firstChild;

//add a node
$ori    = $fnode->childNodes->item(0);//vị trí chèn từ 0 (trên cùng)

$no = MaxNo_New() + 1;//lấy giá trị lơn nhất của NO và +1
$no_xml  = $xml->createElement("no"); 
$noText = $xml->createTextNode($no); 
$no_xml->appendChild($noText); 

$title_xml  = $xml->createElement("title"); 
$titleText = $xml->createTextNode($title); 
$title_xml->appendChild($titleText); 

$summary_xml  = $xml->createElement("short"); 
$summaryText = $xml->createTextNode($summary); 
$summary_xml->appendChild($summaryText); 


$long_xml  = $xml->createElement("long"); 
$longText = $xml->createTextNode($long); 
$long_xml->appendChild($longText); 


$image_xml  = $xml->createElement("image"); 
$imageText = $xml->createTextNode($image_name_converted); 
$image_xml->appendChild($imageText); 


$date = date ('d/m/Y H:i:s',time());
$date_xml  = $xml->createElement("dateposted"); 
$dateText = $xml->createTextNode($date); 
$date_xml->appendChild($dateText); 

$type="social";
$Position   = $xml->createElement("New");
$Position->setAttribute("type",$type);
$Position->appendChild($no_xml);
$Position->appendChild($title_xml);
$Position->appendChild($summary_xml);
$Position->appendChild($long_xml);
$Position->appendChild($image_xml);
$Position->appendChild($date_xml);

$fnode->insertBefore($Position,$ori);

$xml->save(FILE_NEW) or die("Can not insert data to XML file. Please check permission on folder Data. thks"); //lưu lại nếu file chưa tạo*/

$_SESSION['content'] .= 'Added news, title: '.$title.'<br />';
}

function update_new($no,$title,$summary,$long,$old_image)
{
	$fp = fopen(FILE_NEW, "rb") or die("Can not open file XML. Please check file again.");
	$str = fread($fp, filesize(FILE_NEW));
	
	$xml = new DOMDocument();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->loadXML($str) or die("Can not insert data to XML file. Please check permission on folder Data. thks");
	
	// get document element
	$root   = $xml->documentElement;
	$fnode  = $root->firstChild;
	
	$id_no = $xml->getElementsByTagName("no"); //tìm tag có tên là lat: <lat></lat>
	$i = 0;
	foreach ($id_no as $nono)
	{
	if ($nono->nodeValue == $no)	//nếu gái trị chứa bên trong <lat></lat> mà = giá trị của $find
	{
		$op = $fnode->childNodes->item($i); // vị trí của NODE thỏa điểu kiện tìm được
			
		$no_xml  = $xml->createElement("no"); 
		$noText = $xml->createTextNode($no); 
		$no_xml->appendChild($noText); 
		
		$title_xml  = $xml->createElement("title"); 
		$titleText = $xml->createTextNode($title); 
		$title_xml->appendChild($titleText); 
		
		$summary_xml  = $xml->createElement("short"); 
		$summaryText = $xml->createTextNode($summary); 
		$summary_xml->appendChild($summaryText); 
		
		$long_xml  = $xml->createElement("long"); 
		$longText = $xml->createTextNode($long); 
		$long_xml->appendChild($longText); 
		
		$image_xml  = $xml->createElement("image"); 
		$imageText = $xml->createTextNode($old_image); 
		$image_xml->appendChild($imageText); 

		$date = date ('d/m/Y H:i:s',time());
		$date_xml  = $xml->createElement("dateposted"); 
		$dateText = $xml->createTextNode($date); 
		$date_xml->appendChild($dateText); 
				

		$Position   = $xml->createElement("New");
		$type="social";
		$Position->setAttribute("type",$type);
		$Position->appendChild($no_xml);
		$Position->appendChild($title_xml);
		$Position->appendChild($summary_xml);
		$Position->appendChild($long_xml);
		$Position->appendChild($image_xml);
		$Position->appendChild($date_xml);
		
			
		$fnode->replaceChild($Position,$op); // thay thế giá trị cũ = giá trị mới tại vị trí cũ $op
	}
	 $i ++; 
	}
	$xml->save(FILE_NEW) or die("Can not insert data to XML file. Please check permission on folder Data. thks"); //lưu lại nếu file chưa tạo
	
	$_SESSION['content'] .= 'Updated news, title: '.$title.'<br />';	
}



function delete_new($no)
{

$fp = fopen(FILE_NEW, "rb") or die("Can not open file XML. Please check file again.");
$str = fread($fp, filesize(FILE_NEW));
  
$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Can not insert data to XML file. Please check permission on folder Data. thks");

// get document element
$root   = $xml->documentElement;
$fnode  = $root->firstChild;

$id_no = $xml->getElementsByTagName("no"); //tìm tag có tên là lat: <lat></lat>

$i= 0;
foreach ($id_no as $nono)
{
	if ($nono->nodeValue == $no)	//nếu gía trị chứa bên trong <lat></lat> mà = D
	{
		$ori = $fnode->childNodes->item($i);
		$fnode->removeChild($ori);
	}
	 $i += 1; 
}

$xml->save(FILE_NEW) or die("Can not insert data to XML file. Please check permission on folder Data. thks"); //lưu lại nếu file chưa tạo
	
	$_SESSION['content'] .= 'Deleted news, number: '.$no.'<br />';
	
}//ednc function delete

////////////////////////////////////////// LAYOUT //////////////////////////////////////

$do=isset($_GET['do'])?$_GET['do']:"";

if ($do=="firstnew")
{
	echo $do;
	TopMaxNo();
}


function TopMaxNo()// hàm lấy số ID lớn nhất
{
	$arr= array();
	$xml = simplexml_load_file("../data/news.xml") or die("Can not insert data to XML file. Please check permission on folder Data. thks: Cannot create object");
	foreach($xml->children() as $Positions)
	{
		foreach($Positions->children() as $Position => $data)
		{
			 $no = (string) $data->no;
			 array_push($arr,$no);
		}
	}//end foreach
			$top =  max($arr); // trả về số lớn nhất
		 

			$xml = simplexml_load_file("../data/news.xml") or die("Error: Cannot load file xml"); 	
			foreach($xml->children() as $Positions)
			{
				foreach($Positions->children() as $Position => $data)
				{
					  $no_inxml = $data->no;
					if ($no_inxml==$top) 
					{
					  $title= $data->title;
					  $short= $data->short;
					  $long= $data->long;
					  $image = $data->image;
					  $dateposted = $data->dateposted;
					  
					  $title= 'a';
					  $short= 'b';
					  $long=  'c';
					  $image = 'd';
					  $dateposted = 'e';
					  
					  $out = array('no' => $top,'title' => $title, 'short'=>$short, "long"=>$long, "image"=>$image, "dateposted" =>$dateposted);// đưa vào mãng
					  echo json_encode($out);
					  die();
					}
				}
			}//end foreach

}//end Topmax


function createthumb( $pathToImages, $pathToThumbs, $thumbWidth, $name)  
{
      // load image and get image size 
      $img = imagecreatefromjpeg( "$pathToImages"."$name" );  //tao 1 image moi voi duong dan noi chua hinh va ten hinh
      $width = imagesx( $img ); // lay chieu rong hinh
      $height = imagesy( $img ); // lay chieu cao hinh
 
      // calculate thumbnail size 
      $new_width = $thumbWidth;  // chieu rong moi = chieu rong ta chon
      $new_height = floor( $height * ( $thumbWidth / $width ) ); // tu tren suy ra chieu cao
 
      // create a new temporary image 
      $tmp_img = imagecreatetruecolor( $new_width, $new_height ); 
 
      // copy and resize old image into new image  
      imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height ); 
 
      // save thumbnail into a file 
      imagejpeg($tmp_img, "{$pathToThumbs}{$name}",100);  // xuat ra trinh duyet voi duong dan thumb va ten hinh
	  chmod($pathToThumbs.$name, 0777);
      imagedestroy($tmp_img);
}




?>
