<!--
	function checkUserEdit(obj,msg){
		var errorMSG = "";
		if(obj.elements["note_title"].value == "")
			errorMSG += "・タイトルが空欄です\n";
		if(obj.elements["note_body"].value == "")
			errorMSG += "・本分が空欄です\n";
		
		if(errorMSG == ""){
			return true;
		}
		else{
			alert(errorMSG);
			return false;
		}
	}
	function delete_confirm(getUrl,getId){
		var confirmMSG = "メモ帳「" + getId + "」を削除してもよろしいですか？";
		if(confirm(confirmMSG)){
			location.href = getUrl;
		}
		else{
			return false;
		}
	}
	function settextarea(){
		if(document.getElementById('note_body')){
			document.getElementById('note_body').style.height = (appConf['contents'].height - 190) + "px";
		}
	}
	//$(document).ready(settextarea);
	appObject['onload'].push("settextarea()");
	$(window).resize(settextarea);
//-->