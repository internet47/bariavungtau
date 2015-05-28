<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=980">
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<title><!--WebSiteAdmin-Title--></title>
		<meta name="revisit_after" content="7 days" />
		<meta name="robots" content="ALL" />
		<meta http-equiv="pragma" content="no-cache" />
		<link rel="index" href="index.cgi" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="commons/include.css" type="text/css" />
		<script type="text/javascript" src="commons/app.js"></script>
		<script type="text/javascript" src="commons/jquery.js"></script>
		<script type="text/javascript" src="commons/include.js"></script>
		<script type="text/javascript" src="commons/ajax.js"></script>
		<script type="text/javascript" src="commons/expression.js"></script>
		<meta name="Keywords" content="tasklogs" />
		<meta name="Description" content="tasklogs" />
		<!--WebSiteAdmin-Include-->
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<!--WebSiteAdmin-Header-->
				<h1>WebApp.Platforms beta</h1>
			</div>
			<div id="navigator">
				<ul>
					<li><div><img src="images/spacer.gif" alt="loading" width="16" height="16" id="loading" /></div></li>
					<script type="text/javascript" src="commons/dashcode.js"></script>
				<!--
					<li><span onmouseover="over(this)" onmouseout="out(this)" onclick="loadhtml('about')">TASK</span></li>
					<li><span onmouseover="over(this)" onmouseout="out(this)" onclick="logtout()">LOGOUT</span></li>
				-->
				</ul>
			</div>
			<div id="container">
				<div id="sidebar">
					<ul>
						<li><a href="?" class="module">ホーム画面<span>home</span></a></li>
						<!--module_list-->
						<li><a href="http://www.freesale.co.jp/products/support/manuals/fmail3.40/FmailManual3.40.pdf" target="_blank" class="module">ご利用マニュアル<span>online manual</span></a></li>
					</ul>
				</div>
				<div id="contents">
					<!--WebSiteAdmin-Contents-->
				</div>
				<div id="footer">
					<span><!--WebSiteAdmin-Copyright--></span>
				</div>
			</div>
		</div>
	</body>
</html>