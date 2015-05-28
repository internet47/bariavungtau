<?php include('checklogin.php');
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
            <li><a href="#"><span>Gallery</span></a></li>
            <li><a href="#"><span>Image gallery list</span></a></li>
        </ul>
    </div>
</aside>

		<div class="sixteen columns">
			<h1 class="remove-bottom">Images Gallery List </h1>

<!--//TABLE//-->
	<!-- <div class="filterinput"><input id="filter" type="text" value="filter" class="defaultvalue" /></div> -->

	<article>    
	 
      <?php include('config.php');
		//create_table('images',array('id','title','description','image','date','status'));
		$data = get_data('images','*');
		$str='';
		$count = count($data);
		
		/* paging */
		$lineperpage = 10;
		$num = count($data);
		//var_dump($data);
		$st=ceil($num/$lineperpage);
		if(isset($_GET['page']))
		{ 
			$page = $_GET['page'];
		}
		else
		{
			$page=1;
		}
		if($page == "")
		{
			$start = 0;
		} 
		else 
		{
			$start = ($page - 1) * $lineperpage;
		}
		$end = $start + $lineperpage;
		if ($end > $num)
		{
			$end = $num;
		}
		echo '<div align="center">
		<table data-filter="#filter" class="footable">
      <thead>
        <tr>
          <th data-class="" data-sort-initial="true" width="40">No.</th>
		   <!--<th data-class="expand" data-sort-initial="true" width="40">No.</th>-->
          <th data-hide="phone,tablet" data-type="numeric" width="100">Date</th>
          <!--<th data-hide="" data-sort-ignore="true">&nbsp;</th> -->
		 <!-- <th data-hide="default" data-sort-ignore="true">&nbsp;</th> -->          
 		  <th data-sort-ignore="true">Title</th>
          <th data-hide="phone,tablet">Description</th>
          <th data-sort-initial="true">Image</th>
          <th data-hide="phone" width="110">Control</th>
        </tr>
      </thead>
      
      <tbody>
		';
		//$valid=1;
		for($i=$start;$i<$end;$i++)
		{
				echo '<tr>
				<td>'.$i.'</td>
				<td data-value="78025368997" style="width:50px;">'.$data[$i]['date'].'</td>
				<!-- //<td>
					<ul class="editcp">
						<li><a href="editimageupload.php?editid='.$data[$i]['id'].'" class="edit tiptip" title="Home page">Edit</a></li>
						<li><a onClick="return confirm(\'Delete?\');" href="listimage.php?deleteid='.$data[$i]['id'].'" class="del tiptip" title="Home page">Delete</a></li>
					</ul>
				</td> //-->
				<td><a>'.$data[$i]['title'].'</a></td>
				<td style="width:230px;"><div class="hligt">'.$data[$i]['description'].'</div></td>
				<td class="img" style="width:110px;">
				<figure><img src="uploads/images/thumbs/'.$data[$i]['thumbs'].'" style="width:100px; height:100px;" ></figure>
				<!--<figcaption></figcaption> -->
				</td>
				<td data-value="suspended" style="width:150px;">
					<ul class="editcp">
						<li><a href="editimageupload.php?editid='.$data[$i]['id'].'" class="edit tiptip" title="Home page">Edit</a></li>
						<li><a onClick="return confirm(\'Delete?\');" href="listimage.php?deleteid='.$data[$i]['id'].'" class="del tiptip" title="Home page">Delete</a></li>
					</ul>
				</td>
			</tr>';
			//$valid++;
				//echo '<a>'.$data[$i]['id'].'</a><br />';
		}
		echo "</tbody></table>";
		echo '<div class="page">';
			//echo '<span>page: </span>';
			
			if($page==1)
			{
				echo '';
			}
			else
			{
				$pagenext = $page-1;
				if($pagenext>0)
				{
					$linknext = '?page='.$pagenext.'';
					echo '<div class="next"><a class="next" href="'.$linknext.'">Preview</a></div>';	
				}
			}
			for($i=1;$i<=$st;$i++)
			{
				$link = '?page='.$i.'';
				if ($page == "")
				{
					$page = 1;
				}
				if ($page == $i)
				{
					if($st==1)
					{
						echo '';
					}
					else
					{
						echo '<b>'.$i.'</b>';
					}
				}
				else
				{
					echo '<a href="'.$link.'">'.$i.'</a>';
				}
			
			echo ' ';
			}
			
			
			if($page>=$st)
			{
				echo ' ';
			}
			else
			{
				if($st==1)
				{
					echo '';
				}
				else
				{
					$pagenext = $page+1;
					$linknext = '?page='.$pagenext.'';
					echo '<div class="next"><a class="next" href="'.$linknext.'">Next</a></div>';
				}
			}
		echo '</div>';
		echo "</div>";

		/* end paging */
		
		
		
		if($count==NULL)
		{
			$str='Database is empty';
		}
		else
		{
	$str =$str.'<table data-filter="#filter" class="footable">
      <thead>
        <tr>
          <th data-class="" data-sort-initial="true" width="40">No.</th>
		   <!--<th data-class="expand" data-sort-initial="true" width="40">No.</th>-->
          <th data-hide="phone,tablet" data-type="numeric" width="100">Date</th>
          <!--<th data-hide="" data-sort-ignore="true">&nbsp;</th> -->
		 <!-- <th data-hide="default" data-sort-ignore="true">&nbsp;</th> -->          
 		  <th data-sort-ignore="true">Title</th>
          <th data-hide="phone,tablet">Description</th>
          <th data-sort-initial="true">Image</th>
          <th data-hide="phone" width="110">Control</th>
        </tr>
      </thead>
      
      <tbody>';
	  $valid =1;
			foreach($data as $value)
			{
					$str = $str.'
						 <tr>
				<td>'.$valid.'</td>
				<td data-value="78025368997" style="width:50px;">'.$value['date'].'</td>
				<!-- //<td>
					<ul class="editcp">
						<li><a href="editimageupload.php?editid='.$value['id'].'" class="edit tiptip" title="Home page">Edit</a></li>
						<li><a onClick="return confirm(\'Delete?\');" href="listimage.php?deleteid='.$value['id'].'" class="del tiptip" title="Home page">Delete</a></li>
					</ul>
				</td> //-->
				<td><a>'.$value['title'].'</a></td>
				<td style="width:230px;"><div class="hligt">'.$value['description'].'</div></td>
				<td class="img" style="width:110px;">
				<figure><img src="uploads/images/thumbs/'.$value['thumbs'].'" style="width:100px; height:100px;" ></figure>
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
				$valid++;
			}
		}
		//echo $str;
		// xoa du lieu 
		if(isset($_GET['deleteid']))
		{
			//echo $_GET['deleteid'];
			$dataunlink = get_data('images','*','id,=,'.$_GET['deleteid'].'');
			del_data('images','id',array($_GET['deleteid']));
			//var_dump($dataunlink);
			foreach($dataunlink as $unlink)
			{
				$a = $unlink['image'];
				$b = $unlink['thumbs'];
				$link = "uploads/images/$a";
				$linkthum = "uploads/images/thumbs/$b";
				if($link)
				{
					unlink($link);
				}
				if($linkthum)
				{
					unlink($linkthum);
				}
			}
			$_SESSION['content'] .= 'Deleted the image <br />';
			header('Location: listimage.php'); 
		}
	?>
      
      
        
      </tbody>
    </table>
    </article>
    
	<div id="paging">
    	<!--<ul class="pagelist">
          <li>Page:</li>
          <li><a href="list.html" target="mainFrame">1</a></li>
          <li class="active"><a href="list.html" target="mainFrame">2</a></li>
          <li><a href="list.html" target="mainFrame">3</a></li>
          <li><a href="list.html" target="mainFrame">4</a></li>
        </ul>  -->      
    </div>

    
<!--//TABLE//-->




		</div>


	</div>

</body>
</html>