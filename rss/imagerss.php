<?php
    header("Content-Type: application/rss+xml; charset=UTF-8");
	//header("Content-type: application/xml charset=ISO-8859-1"); 
?>
<?php
	echo "<?xml version='1.0' encoding='UTF-8'?>
	<rss version='2.0'>
		<channel>
			<title>9lessons | Programming Blog </title>
			<link>http://9lessons.blogspot.com</link>
			<description>Programming Blog </description>
			<language>en-us</language>
	";
 	include('function.php');
	$data = get_data('images','*');
	foreach($data as $rss)
	{
		$title = $rss['title'];
		$description = $rss['description'];
		$date = $rss['date'];
		echo "
		<item> 
			<title>$title</title>
			<date>$date</date>
			<description>$description</description>
		</item>
";
	}
echo "
	<channel>
</rss>";
?>
