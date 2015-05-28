<!--
	//elements names
	var dateselect_dateElementsId = "en1331812811";
	
	// 表示期間
	var setdays = 14;
	
	// 表示開始日（0は当日、翌日からなら1とする）
	var start_day = 0;
	
	var dateselect_weeksName = new Array('（日）','（月）','（火）','（水）','（木）','（金）','（土）');
	
	// IE6～8だけ年調整
	if(navigator.userAgent.indexOf("MSIE 8") != -1 || navigator.userAgent.indexOf("MSIE 7") != -1 || navigator.userAgent.indexOf("MSIE 6") != -1){
		var yearplus = 0;
	}else{
		var yearplus = 1900;
	}
	
	
	document.write('<select name="' + dateselect_dateElementsId + '" id="' + dateselect_dateElementsId + '">');
	
	for(i=start_day;i<setdays+start_day;i++){
		dateselect_today = new Date();
		dateselect_year = dateselect_today.getYear() + yearplus;
		dateselect_month = dateselect_today.getMonth() + 1;
		dateselect_day = dateselect_today.getDate();
		date = computeDate(dateselect_year, dateselect_month, dateselect_day, i);

		dateselect_year = date.getFullYear();
		dateselect_month = date.getMonth() + 1;
		dateselect_day = date.getDate();
		dateselect_week = dateselect_weeksName[date.getDay()];
		
		
		if(date.getDay() == 0){
			// 日曜日
			style = ' style="background: #FFDDDD;"';
		}else if(date.getDay() == 6){
			// 土曜日
			style = ' style="background: #DDDDDD;"';
		}else{
			// 平日
			style = '';
		}
		
		document.write('<option value="' + dateselect_year + '年' + dateselect_month + '月' + dateselect_day + '日' + dateselect_week + '"' + style + '>' + dateselect_year + '年' + dateselect_month + '月' + dateselect_day + '日' + dateselect_week + '</option>');
		
	}
	
	document.write('</select>');
	
	
	// 確認画面から戻ってきた時の代入
	if(dateDefaultValue[dateselect_dateElementsId] != undefined && dateDefaultValue[dateselect_dateElementsId] != "")
		document.getElementById(dateselect_dateElementsId).value = dateDefaultValue[dateselect_dateElementsId];
	
	
	
	function computeDate(year, month, day, addDays) {
		var dt = new Date(year, month - 1, day);
		var baseSec = dt.getTime();
		var addSec = addDays * 86400000;//日数 * 1日のミリ秒数
		var targetSec = baseSec + addSec;
		dt.setTime(targetSec);
		return dt;
	}

//-->