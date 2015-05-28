<!--
	function checkUserEdit(obj,msg){
		var errorMSG = "";
		if(errorMSG == ""){
			return true;
		}
		else{
			alert(errorMSG);
			return false;
		}
	}
	function statdisp(){
		if(appObject['querys']["stat"] != undefined){
			if(document.getElementById("stat"))
				document.getElementById("stat").style.display = "block";
		}
	}
	
	
	
	var qtm_posObj = new Object();
	function add_element_value() {
		objId = 'mailform_sender_address_name';
		qtm_pos(objId);
		var obj = document.getElementById(objId);
		qtm_posObj.end = qtm_posObj.start;
		//qtm_posObj.body = "<" + document.getElementById('add_elements_value_list').value + ">";
		qtm_posObj.body = document.getElementById('add_elements_value_list').value;
		qtm_feedback(obj);
	}
	function qtm_feedback(obj){
		//qtm_posObj.first = obj.value.substring(0,qtm_posObj.start);
		qtm_posObj.first = "";
		//qtm_posObj.last = obj.value.substring(qtm_posObj.end,obj.value.length);
		qtm_posObj.last = "";
		obj.value = qtm_posObj.first + qtm_posObj.body + qtm_posObj.last;
		obj.value = qtm_posObj.first + qtm_posObj.body + qtm_posObj.last;
		var endfocus = qtm_posObj.first + qtm_posObj.body;
		endfocus = endfocus.length;
		if (obj.createTextRange) {
			if(navigator.userAgent.indexOf("MSIE") > -1)endfocus-=1;
			var range = obj.createTextRange();
			range.move('character',endfocus+1);
			range.select();
		}
		else if (obj.setSelectionRange) {
			obj.setSelectionRange(endfocus,endfocus);
		}
	}
	function oftt(obj){
		obj.style.height = "300px";
	}
	function obtt(obj){
		obj.style.height = "100px";
	}
	function qtm_pos(objId){
		var obj = document.getElementById(objId);
		obj.focus();
		qtm_posObj.body = "";
		if(navigator.userAgent.indexOf("MSIE") > -1){
			//IE（textareaの場合）
			//var range = document.selection.createRange();
			//var clone = range.duplicate();
			//clone.moveToElementText(obj);
			//clone.setEndPoint('EndToEnd',range);
			//qtm_posObj.start = clone.text.length - range.text.length;
			//qtm_posObj.end = clone.text.length - range.text.length + range.text.length;
			
			//IE（追加：textarea以外の場合）
				var range = document.selection.createRange();
				var eleRange = obj.createTextRange();
				eleRange.setEndPoint('EndToStart', range);
				qtm_posObj.start = eleRange.text.length;

				eleRange = obj.createTextRange();
				eleRange.setEndPoint('EndToEnd', range);
				qtm_posObj.end = eleRange.text.length;
		}
		else {
			//NOT IE
			qtm_posObj.start = obj.selectionStart;
			qtm_posObj.end = obj.selectionEnd;
		}
		if(qtm_posObj.start != qtm_posObj.end){
			qtm_posObj.body = obj.value.substring(qtm_posObj.start,qtm_posObj.end);
		}
	}
	
	
	
	//追加
	function add_element_value_subject() {
		objId = 'mailform_sender_address';
		qtm_pos_subject(objId);
		var obj = document.getElementById(objId);
		qtm_posObj.end = qtm_posObj.start;
		//qtm_posObj.subject = "<" + document.getElementById('add_elements_value_list_subject').value + ">";
		qtm_posObj.subject = document.getElementById('add_elements_value_list_subject').value;
		qtm_feedback_subject(obj);
	}
	//追加
	function qtm_feedback_subject(obj){
		//qtm_posObj.first = obj.value.substring(0,qtm_posObj.start);
		qtm_posObj.first = "";
		//qtm_posObj.last = obj.value.substring(qtm_posObj.end,obj.value.length);
		qtm_posObj.last = "";
		obj.value = qtm_posObj.first + qtm_posObj.subject + qtm_posObj.last;
		obj.value = qtm_posObj.first + qtm_posObj.subject + qtm_posObj.last;
		var endfocus = qtm_posObj.first + qtm_posObj.subject;
		endfocus = endfocus.length;
		if (obj.createTextRange) {
			if(navigator.userAgent.indexOf("MSIE") > -1)endfocus-=1;
			var range = obj.createTextRange();
			range.move('character',endfocus+1);
			range.select();
		}
		else if (obj.setSelectionRange) {
			obj.setSelectionRange(endfocus,endfocus);
		}
	}
	//追加
	function qtm_pos_subject(objId){
		var obj = document.getElementById(objId);
		obj.focus();
		qtm_posObj.subject = "";
		if(navigator.userAgent.indexOf("MSIE") > -1){
			//IE（textareaの場合）
			//var range = document.selection.createRange();
			//var clone = range.duplicate();
			//clone.moveToElementText(obj);
			//clone.setEndPoint('EndToEnd',range);
			//qtm_posObj.start = clone.text.length - range.text.length;
			//qtm_posObj.end = clone.text.length - range.text.length + range.text.length;
			
			//IE（追加：textarea以外の場合）
				var range = document.selection.createRange();
				var eleRange = obj.createTextRange();
				eleRange.setEndPoint('EndToStart', range);
				qtm_posObj.start = eleRange.text.length;

				eleRange = obj.createTextRange();
				eleRange.setEndPoint('EndToEnd', range);
				qtm_posObj.end = eleRange.text.length;
			
		}
		else {
			//NOT IE
			qtm_posObj.start = obj.selectionStart;
			qtm_posObj.end = obj.selectionEnd;
		}
		if(qtm_posObj.start != qtm_posObj.end){
			qtm_posObj.subject = obj.value.substring(qtm_posObj.start,qtm_posObj.end);
		}
	}
	
	
	
	
	
	
	
	
	
	//添付ファイルの表示非表示
	function filesave_disp(){
		if(!document.getElementById('log_save').checked){
			if(document.getElementById('file_save_input').checked){
				alert("添付ファイルをサーバに蓄積する場合、履歴保存にチェックを入れてください。\n\nただし、Fmailプラチナプランでのご契約が条件となります。");
			}
			document.getElementById('file_save_input').checked = false;
		}
	}
	
	
	// プランチェック
	function plan_check(str) {
		// 履歴管理
		if(document.getElementById('log_save').checked){			var log_save = 1;		}
		
		// 未入力項目
		if(document.getElementById('mail_dustclear').checked){			var mail_dustclear = 1;		}
		if(document.getElementById('mail_dustclear_zero').checked){			var mail_dustclear_zero = 1;		}
		
		// メールモード
		if(document.getElementById('mail_method_html').checked){			var mail_method_html = 1;		}
		
		// ファイル添付項目
		if(document.getElementById('flag_file').value == 1){			var flag_file = 1;		}
		
		// アフィリエイト
		if(document.getElementById('flag_afiri').checked){			var flag_afiri = 1;		}
		
		// スマートフォン用テンプレート
		if(document.getElementById('flag_smartphone_tpl').checked){			var flag_smartphone_tpl = 1;		}
		
		// フューチャーフォン用テンプレート
		if(document.getElementById('flag_futurephone_tpl').checked){			var flag_futurephone_tpl = 1;		}
		
		// 多言語モード
		if(document.getElementById('setlang').checked){			var setlang = 1;		}
		
		
		// 判定処理
		var textdata = '';
		var textdata_comment = '';
		if(document.getElementById(str).value == 'スタンダードプラン'){
			if(flag_file == 1){	textdata += 'ファイル添付機能\n';	}
			if(mail_method_html == 1){	textdata += 'HTMLメール\n';	}
			if(flag_futurephone_tpl == 1){	textdata += 'フィーチャーフォン対応\n';	}
			if(flag_afiri == 1){	textdata += 'アフィリエイトタグ追加機能\n';	}
			if(mail_dustclear == 1 || mail_dustclear_zero == 1){	textdata += '未入力項目\n';	}
			if(setlang == 1){	textdata += '多言語モード\n';	}
			if(log_save == 1){	textdata += '履歴管理\n';	}
			if(flag_smartphone_tpl == 1){	textdata += 'スマートフォン対応\n';	}
			if(textdata){
				textdata += '---------------------------------------\n';
				textdata += 'がサービス提供範囲外です。\n';
				textdata += '\nメールフォームの設定をご確認ください。\n';
				textdata += '\nオプション契約している場合もあり。\nディレクターへの確認必須。';
			}else{
				textdata += '正しく設定されています。';
			}
			
			var el=document.getElementsByTagName('td');
			for (var i=0;i<el.length;i++){
				if(el[i].className=='standard'){
					el[i].style.background = '#ffeeee';
				}else if(el[i].className=='platinum' || el[i].className=='premium' || el[i].className=='gold'){
					el[i].style.background = '#ffffff';
				}
			}
			
		}else if(document.getElementById(str).value == 'ゴールドプラン'){
			if(log_save == 1){	textdata += '履歴管理\n';	}
			if(flag_smartphone_tpl == 1){	textdata += 'スマートフォン対応\n';	}
			if(textdata){
				textdata += '---------------------------------------\n';
				textdata += 'がサービス提供範囲外です。\n';
				textdata += '\nメールフォームの設定をご確認ください。\n';
				textdata += '\nオプション契約している場合もあり。\nディレクターへの確認必須。';
			}else{
				textdata += '正しく設定されています。';
			}
			
			var el=document.getElementsByTagName('td');
			for (var i=0;i<el.length;i++){
				if(el[i].className=='gold'){
					el[i].style.background = '#ffeeee';
				}else if(el[i].className=='platinum' || el[i].className=='premium' || el[i].className=='standard'){
					el[i].style.background = '#ffffff';
				}
			}
			
		}else if(document.getElementById(str).value == 'プレミアムゴールドプラン'){
			textdata = '履歴管理の限定開放とスマートフォン対応が可能です。\n\nお客様へ通知するアカウントは\n\n「WEBサイト管理者」でお願いします。';
			
			var el=document.getElementsByTagName('td');
			for (var i=0;i<el.length;i++){
				if(el[i].className=='premium'){
					el[i].style.background = '#ffeeee';
				}else if(el[i].className=='platinum' || el[i].className=='gold' || el[i].className=='standard'){
					el[i].style.background = '#ffffff';
				}
			}
			
		}else if(document.getElementById(str).value == 'プレミアムプラン'){
			textdata = '管理画面完全開放開放します。\n\nお客様へ通知するアカウントは\n\n「WEBサイト上級管理者」でお願いします。';
			
			var el=document.getElementsByTagName('td');
			for (var i=0;i<el.length;i++){
				if(el[i].className=='platinum'){
					el[i].style.background = '#ffeeee';
				}else if(el[i].className=='premium' || el[i].className=='gold' || el[i].className=='standard'){
					el[i].style.background = '#ffffff';
				}
			}
			
		}
		
		document.getElementById('result_item').value = textdata;
		
		// 結果表示
		if(document.getElementById(str).value){
			document.getElementById('result').style.display = 'block';
		}
	}
	
	
	appObject['onload'].push("statdisp()");
//-->