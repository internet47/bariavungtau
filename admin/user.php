<?php include('checklogin.php');
ob_start();
?>
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
<link rel="stylesheet" type="text/css" href="libs/tablesort/footable.sortable-0.1.css">
<link rel="stylesheet" type="text/css" href="libs/tablesort/footable-0.1.css">
<link rel="stylesheet" type="text/css" href="libs/tiptip/tipTip.css">
  <script src="libs/tiptip/jquery.tipTip.js" type="text/javascript"></script>
  <script src="libs/tablesort/footable-0.1.js" type="text/javascript"></script>
  <script src="libs/tablesort/footable.sortable.js" type="text/javascript"></script>
  <script src="libs/tablesort/footable.filter.js" type="text/javascript"></script>  
<!--//ADDONS//-->
      
<script src="js/script.js" type="text/javascript" charset="utf-8" ></script>

</head>
<body>

<div class="container">

<aside>
	<div class="navbar">
    	<ul>
            <li><a href="#">Home</a></li>
            <li><a href="#"><span>Gallary</span></a></li>
            <li><a href="#"><span>List image gallary</span></a></li>
        </ul>
    </div>
</aside>

		<div class="sixteen columns">
			<h1 class="remove-bottom">List images gallary </h1>

<!--//TABLE//-->
	<div class="filterinput"><input id="filter" type="text" value="filter" class="defaultvalue" /></div>

	<article>    
	 
      <?php include('config.php');
		//create_table('images',array('id','title','description','image','date','status'));
		$data = get_data('images','*');
		$str='';
		$count = count($data);
		if($count==NULL)
		{
			$str='Database is empty';
		}
		else
		{
			$str =$str.'<table data-filter="#filter" class="footable">
      <thead>
        <tr>
          <th data-class="expand" data-sort-initial="true" width="40">No.</th>
          <th data-hide="phone,tablet" data-type="numeric" width="100">Date</th>
          <th data-hide="default" data-sort-ignore="true">&nbsp;</th>     
 		  <th data-sort-ignore="true">Title</th>
          <th data-hide="phone,tablet">Description</th>
          <th data-sort-initial="true" width="180">Image</th>
          <th data-hide="phone" width="110">Control</th>
        </tr>
      </thead>
      
      <tbody>';
			foreach($data as $value)
			{
					$str = $str.'
						 <tr>
				<td>'.$value['id'].'</td>
				<td data-value="78025368997">'.$value['date'].'</td>
				<td>
					<ul class="editcp">
						<li><a href="form.html" class="edit tiptip" title="Home page">Edit</a></li>
						<li><a onClick="return confirm("Delete?");" href="list.html" class="del tiptip" title="Home page">Delete</a></li>
					</ul>
				</td>
				<td><a target="_blank" href="http://www.google.com">'.$value['title'].'</a></td>
				<td>'.$value['description'].'</td>
				<td class="img">
				<figure><img src="uploads/images/'.$value['image'].'"></figure>
				<!--<figcaption></figcaption> -->
				</td>
				<td data-value="suspended">
					<ul class="editcp">
						<li><a href="editimageupload.php?editid='.$value['id'].'" class="edit tiptip" title="Home page">Edit</a></li>
						<li><a onClick="return confirm(\'Delete?\');" href="listimage.php?deleteid='.$value['id'].'" class="del tiptip" title="Home page">Delete</a></li>
					</ul>
				</td>
			</tr>
					';
				//}
				
			}
		}
		echo $str;
		// xoa du lieu 
		if(isset($_GET['deleteid']))
		{
			//echo $_GET['deleteid'];
			del_data('images','id',array($_GET['deleteid']));
			header('Location: listimage.php'); 
		}
	?>
      
      
        
      </tbody>
    </table>
    </article>
    
	<div id="paging">
    	<ul class="pagelist">
          <li>Page:</li>
          <li><a href="list.html" target="mainFrame">1</a></li>
          <li class="active"><a href="list.html" target="mainFrame">2</a></li>
          <li><a href="list.html" target="mainFrame">3</a></li>
          <li><a href="list.html" target="mainFrame">4</a></li>
        </ul>        
    </div>

    
<!--//TABLE//-->




		</div>


	</div>

</body>
</html>