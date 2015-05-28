/*********************************/
/******CẤU HÌNH WEB DEV TOOL******/
/*********************************/
/**************************************
CHỈ CẤU HÌNH CÁC THÔNG SỐ SAU ĐÂY:

	west__size: 250 => độ rộng (pixel) của menu trái
	folroot: 'TEST' => tên folder chứa các order để test 

**************************************/

	var folroot = 'TEST';
	var myLayout; 
	$(document).ready(function () {
		//iFrame
		myLayout = $('body').layout({
			west__size:					250
		,	west__spacing_closed:		20
		,	west__togglerLength_closed:	100
		,	west__togglerAlign_closed:	"top"
		,	west__togglerContent_closed:"M<BR>E<BR>N<BR>U"
		,	west__togglerTip_closed:	"Open & Pin Menu"
		,	west__sliderTip:			"Slide Open Menu"
		,	west__slideTrigger_open:	"mouseover"
		,	center__maskContents:		true // IMPORTANT - enable iframe masking
		});
		//iFrame
		//Tree View
		$('#fileTree').fileTree({ root: folroot+'/', script: 'jqueryFileTree.php', folderEvent: 'click', expandSpeed: 750, collapseSpeed: 750, multiFolder: true }, function(file) { 
		//alert(file);
		window.open(file.replace('',''), "mainFrame", "location=1,status=1,scrollbars=1,width=100,height=100");
		});
		//Tree View
 	});
	