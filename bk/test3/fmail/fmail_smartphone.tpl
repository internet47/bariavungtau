<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta id="viewport" name="viewport" content="width=device-width">
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		
		<title>Fmail | <!--%%fmail-printable-area-title%%--></title>
		<link rel="stylesheet" href="./smaph/commons/_include.css" type="text/css" />
		<meta name="Description" content="fmail <!--%%fmail-printable-area-ver%%-->" />
		
		<!-- [ Fmail Include Files ] -->
		<link rel="stylesheet" href="./smaph/fmail.lib/fmail.css" type="text/css" />
		<script type="text/javascript" src="./fmail.lib/jquery.js" charset="utf-8"></script>
		<script type="text/javascript" src="./fmail.postcode.cgi?js" charset="utf-8"></script>
		<script type="text/javascript" src="./smaph/fmail.lib/fmail.js" charset="utf-8"></script>
		<script type="text/javascript" src="./smaph/fmail.lib/smaph.js" charset="utf-8"></script>
		<!-- [ Fmail Include Files EOF ] -->
		
	</head>
	<body id="fmailbody" onload="updateOrientation()" Onorientationchange="updateOrientation()">
		<div id="header">
			<h1 id="title">fmail <!--%%fmail-printable-area-ver%%--></h1>
			<span>FREESALE MAILFORM SYSTEM VERSION <!--%%fmail-printable-area-ver%%--></span>
		</div>
		<div id="container">
			<div id="contents">
				<!--%%fmail-invisible-contents-start%%-->
					これはスマフォ用テンプレートです。<br />
					入力画面のみ出力
				<!--%%fmail-invisible-contents-end%%-->
				
				<!--%%fmail-printable-area-error%%-->
				<!--%%fmail-printable-area-body%%-->
			</div>
		</div>
		<div id="footer">
			<span>Copyright&copy; 2009 All Rights Reserved.</span>
		</div>
		
		
		<!--%%fmail-invisible-contents-start%%-->
			入力画面のみ出力
		<!--%%fmail-invisible-contents-end%%-->
		
		<!--%%fmail-error-contents-start%%-->
			エラー画面のみ出力
		<!--%%fmail-error-contents-end%%-->
		
		<!--%%fmail-confirm-contents-start%%-->
			確認画面画面のみ出力
		<!--%%fmail-confirm-contents-end%%-->
		
		<!--%%fmail-thanks-contents-start%%-->
			送信完了画面のみ出力
		<!--%%fmail-thanks-contents-end%%-->
		
	</body>
</html>