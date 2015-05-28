###############################################################################
# Administrated Screen Users Editable Functions
###############################################################################

@mailform_env = &loadfile('./datas/modules/mailform_env/mailform_env.dat');
$mailform_env = join("\n",@mailform_env);
($mailform_flag,$expires_start,$expires_end,$limit,$serials,$thanks_page,$sendmail_path,$logsave,$cart_in_element,$cart_logsave,$send_mode,$attached_mode,$display_mode,$logdata_path,$cart_logdata_path,$mailform_sender_address_name,$mailform_sender_address,$mail_method,$thanks_message,$title_mailform,$title_confirm,$title_error,$title_thanks,$spamcheck,$mail_dustclear,$mail_dustclear_zero,$client_info,$site_url,$table_style,$th_style,$td_style,$separate_before,$separate_after,$flag_afiri,$afiri_tag,$flag_smartphone_tpl,$flag_futurephone_tpl,$setlang) = split(/\n/,$mailform_env);

# Mail log directory
if($logdata_path eq $null) {
	$maillog_dir = './datas/maillog/';
} else {
	$maillog_dir = $logdata_path;
}

# Data extraction date
if($logdata_path eq $null) {
	@mailstamp = &loadfile('./datas/maillog/maillog_select.cgi');
} else {
	@mailstamp = &loadfile($logdata_path . 'maillog_select.cgi');
}

$mailstamp = join("\n",@mailstamp);
($mailstamp) = split(/\n/,$mailstamp);

if(!$mailstamp) {
	$mailstamp = sprintf("%04d-%02d",$year,$mon);
}

@mailstamp_arr = split(/-/,$mailstamp);

if($logdata_path eq $null) {
	$logdata_path = './datas/maillog/mail_logdata-' . $mailstamp . '.cgi';
} else {
	$logdata_path = $logdata_path . 'mail_logdata-' . $mailstamp . '.cgi';
}


if((-f $logdata_path) && $logdata_path ne $null){
	$filesize = -s $logdata_path;
}
else {
	$logdata_path = './datas/logdata.cgi';
	$filesize = -s $logdata_path;
}

$action_name = 'メールフォームの項目一覧';
if($filesize > 0){
	$print_html = <<"	EOF";
		<p>ログファイルが蓄積された状態です。一度<a href="index.cgi?m=logview">ログファイルを初期化</a>してから再度、お試しください</p>
	EOF
}
else {
	for($cnt=0;$cnt<@current_data;$cnt++){
		#my(@current_record) = split(/\t/,$current_data[$cnt]);
		($elements_id,$num,$name,$type_of_element,$html_size,$html_rows,$html_cols,$html_id,$element_type,$check_type,$on_event,$html_tag_free,$text_min,$text_max,$enable_filetypes,$filesize_min,$filesize_max,$checked_min,$checked_max,$element_valus,$element_text,$html_example,$note,$element_error_message,$must_disp,$default_value,$system_disp_false,$html_tag_free_top,$elements_class) = split(/\t/,$current_data[$cnt]);
		$users_list .= "<tr onmouseover=\"this.style.backgroundColor='#E8EEF9';\" onmouseout=\"this.style.backgroundColor='#FFFFFF';\">\n";
		$users_list .= "<td class=\"adjust_sort\"><a href=\"?m=$form{'m'}&a=sort_one&id=${elements_id}&rank=up\"><img src=\"modules/elements/images/sort_up.gif\"></a><a href=\"?m=$form{'m'}&a=sort_one&id=${elements_id}&rank=down\"><img src=\"modules/elements/images/sort_down.gif\"></a></td>\n";
		$users_list .= "<td class=\"item\"><input type=\"text\" size=\"4\" value=\"${num}\" name=\"${elements_id}\" class=\"sort_num\" /><a href=\"?m=$form{'m'}&a=form&id=$elements_id\">${name}(${element_type})</a></td>\n";
		$users_list .= "<td class=\"edit\"><img src=\"modules/elements/images/button_edit.gif\" width=\"60\" height=\"20\" alt=\"編集\" class=\"button\" onclick=\"location.href='?m=$form{'m'}&a=form&id=$elements_id'\" /></td>\n";
		$users_list .= "<td class=\"copy\"><img src=\"modules/elements/images/button_copy.gif\" width=\"60\" height=\"20\" alt=\"複製\" class=\"button\" onclick=\"copy_confirm('?m=$form{'m'}&a=copy&id=${elements_id}','${name}');\" /></td>\n";
		$users_list .= "<td class=\"del\"><img src=\"modules/elements/images/button_delete.gif\" width=\"60\" height=\"20\" alt=\"削除\" class=\"button\" onclick=\"delete_confirm('?m=$form{'m'}&a=delete&id=${elements_id}','${name}');\" /></td>\n";
		$users_list .= "<td class=\"delete_check\"><label for=\"delete_${elements_id}\"><input type=\"checkbox\" value=\"${elements_id}\" name=\"delete_${elements_id}\" id=\"delete_${elements_id}\" /></label></td>\n";
		$users_list .= "</tr>\n";
	}
	$print_html = <<"	EOF";
		<form id="user_add" action="?m=$form{'m'}&a=sort" method="POST" onsubmit="return gosort()">
		<input type="submit" value="項目の並び替え" class="sort_button" onclick="select_delete_check('sort');" onkeyup="select_delete_check('sort');" />
		<a href="?m=$form{'m'}&a=form" class="add">項目を追加する</a>
		<input type="submit" value="選択項目の削除" class="delete_button" onclick="select_delete_check('del');" onkeyup="select_delete_check('del');" />
		<table cellpadding="0" cellspacing="0" class="list">
			${users_list}
		</table>
		<input type="submit" value="項目の並び替え" class="sort_button" onclick="select_delete_check('sort');" onkeyup="select_delete_check('sort');" />
		<a href="?m=$form{'m'}&a=form" class="add">項目を追加する</a>
		<input type="submit" value="選択項目の削除" class="delete_button" onclick="select_delete_check('del');" onkeyup="select_delete_check('del');" />
		<input type="hidden" name="flag_delete_value" value="" id="flag_delete" />
		</form>
	EOF
}
