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
<script type="text/javascript" src="jwplayer.js"></script>

<script>jwplayer.key="itdRjkcNdhDS/LHyAGsNdmw/moMq3YH1bS1dSw=="</script>
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

<style>
.jwlogo{
	clear:both;
	display:none;
}
</style>

</head>
<body>


<div class="container">

<aside>
	<div class="navbar">
    	<ul>
            <li><a href="#">Home</a></li>
            <li><a href="#"><span>Gallery</span></a></li>
            <li><a href="#"><span>Video gallery list</span></a></li>
        </ul>
    </div>
</aside>

		<div class="sixteen columns">
			<h1 class="remove-bottom">Video Gallery List </h1>

<!--//TABLE//-->
	<!--<div class="filterinput"><input id="filter" type="text" value="filter" class="defaultvalue" /></div> -->

	<article>

    <?php 
		include('config.php');
		//create_table('images',array('id','title','description','image','date','status'));
		$data = get_data('videos','*');
		
		$str='';
		$count = count($data);
		if($count==NULL)
		{
			$str='Database is empty';
		}
		else
		{
			
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
			$page = 1;
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
		echo '
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
						  <th data-sort-initial="true" width="150">Link youtube</th>
						  <th data-sort-initial="true" width="120">Video</th>
						  <th data-hide="phone" >Control</th>
						</tr>
					  </thead>
					  
					  <tbody>
		';
		//$valid=1;
		for($i=$start;$i<$end;$i++)
		{
				$str =$str.'
				<tr>
							<td>'.$i.'</td>
							<td data-value="78025368997">'.$data[$i]['date'].'</td>
							<!--<td>
								<ul class="editcp">
									<li><a href="editvideo.php?editid='.$data[$i]['id'].'" class="edit tiptip" title="Home page">Edit</a></li>
									<li><a onClick="return confirm("Delete?");" href="listvideo.php?deleteid='.$data[$i]['id'].'" class="del tiptip" title="Home page">Delete</a></li>
								</ul>
							</td>-->
							<td><a>'.$data[$i]['title'].'</a></td>
							<td style="width:230px;"><div class="hligt">'.$data[$i]['description'].'</div></td>
							<td class="img">
							<figure>';
							if($data[$i]['link']=='')
							{
								$str = $str.'No data';
							}
							else{
							$str = $str.'<a href="'.$data[$i]['link'].'" target="_blank">'.$data[$i]['link'].'</a>
							<!--<iframe width="150" height="150" src="'. $data[$i]['link'].'" frameborder="0" allowfullscreen></iframe> -->
							';
							}
							$str = $str.'</figure>
							</td>
							<td class="img11">
							<figure>
							';
							if($data[$i]['video']=='')
							{
								$str = $str.'Video empty';
							}
							else
							{
								$str = $str.'<div id="my-video'.$data[$i]['id'].'"></div>
									<script type="text/javascript">
										jwplayer("my-video'.$data[$i]['id'].'").setup({
											file: "uploads/videos/'.$data[$i]['video'].'",
											width: "150",
											height: "150",
											image: "http://content.bitsontherun.com/thumbs/3XnJSIm4-640.jpg"
										});
									</script>';
							}
							$str = $str.'</figure>
							<!--//<figcaption>video</figcaption>//-->
							</td>
							<td data-value="suspended" width="150">
								<ul class="editcp">
									<li><a href="editvideo.php?editid='.$data[$i]['id'].'" class="edit tiptip" title="Home page">Edit</a></li>
									<li><a onClick="return confirm(\'Delete?\');" href="listvideo.php?deleteid='.$data[$i]['id'].'" class="del tiptip" title="Home page">Delete</a></li>
								</ul>
							</td>
						</tr>
				';
				echo $str;
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
						  <th data-sort-initial="true" width="150">Link youtube</th>
						  <th data-sort-initial="true" width="120">Video</th>
						  <th data-hide="phone" width="150">Control</th>
						</tr>
					  </thead>
					  
					  <tbody>';
					  $valid =1;
	  		foreach($data as $value)
			{
					$str = $str.'
						 <tr>
							<td>'.$valid.'</td>
							<td data-value="78025368997">'.$value['date'].'</td>
							<!--<td>
								<ul class="editcp">
									<li><a href="editvideo.php?editid='.$value['id'].'" class="edit tiptip" title="Home page">Edit</a></li>
									<li><a onClick="return confirm("Delete?");" href="listvideo.php?deleteid='.$value['id'].'" class="del tiptip" title="Home page">Delete</a></li>
								</ul>
							</td>-->
							<td><a>'.$value['title'].'</a></td>
							<td style="width:230px;"><div class="hligt">'.$value['description'].'</div></td>
							<td class="img">
							<figure>';
							if($value['link']=='')
							{
								$str = $str.'No data';
							}
							else{
							$str = $str.'<a href="'.$value['link'].'" target="_blank">'.$value['link'].'</a>
							<!--<iframe width="150" height="150" src="'. $value['link'].'" frameborder="0" allowfullscreen></iframe> -->
							';
							}
							$str = $str.'</figure>
							</td>
							<td class="img11">
							<figure>
							';
							if($value['video']=='')
							{
								$str = $str.'Video empty';
							}
							else
							{
								$str = $str.'<div id="my-video'.$value['id'].'"></div>
									<script type="text/javascript">
										jwplayer("my-video'.$value['id'].'").setup({
											file: "uploads/videos/'.$value['video'].'",
											width: "150",
											height: "150",
											image: "http://content.bitsontherun.com/thumbs/3XnJSIm4-640.jpg"
										});
									</script>';
							}
							$str = $str.'</figure>
							<!--//<figcaption>video</figcaption>//-->
							</td>
							<td style="width:150px;">
								<ul class="editcp">
									<li><a href="editvideo.php?editid='.$value['id'].'" class="edit tiptip" title="Home page">Edit</a></li>
									<li><a onClick="return confirm(\'Delete?\');" href="listvideo.php?deleteid='.$value['id'].'" class="del tiptip" title="Home page">Delete</a></li>
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
			
			
			$dataunlink = get_data('videos','*','id,=,'.$_GET['deleteid'].'');
			del_data('videos','id',array($_GET['deleteid']));
			//var_dump($dataunlink);
			foreach($dataunlink as $unlink)
			{
				$a = $unlink['video'];
				$link = "uploads/videos/$a";
				if($link && $unlink['video']!='')
				{
					unlink($link);
				}
			}
			
			header('Location: listvideo.php'); 
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
        </ul> -->       
    </div>

    
<!--//TABLE//-->




		</div>


	</div>

</body>
</html>