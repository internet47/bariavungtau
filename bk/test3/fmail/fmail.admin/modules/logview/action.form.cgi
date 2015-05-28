###############################################################################
#
###############################################################################

$action_name = 'メール履歴の閲覧';

@mailform_env = &loadfile('./datas/modules/mailform_env/mailform_env.dat');
$mailform_env = join("\n",@mailform_env);
($mailform_flag,$expires_start,$expires_end,$limit,$serials,$thanks_page,$sendmail_path,$logsave,$cart_in_element,$cart_logsave,$send_mode,$attached_mode,$display_mode,$logdata_path,$cart_logdata_path,$mailform_sender_address_name,$mailform_sender_address,$mail_method,$thanks_message,$title_mailform,$title_confirm,$title_error,$title_thanks,$spamcheck,$mail_dustclear,$mail_dustclear_zero,$client_info,$site_url,$table_style,$th_style,$td_style,$separate_before,$separate_after,$flag_afiri,$afiri_tag,$flag_smartphone_tpl,$flag_futurephone_tpl,$setlang) = split(/\n/,$mailform_env);

if($logdata_path eq $null){
	$logdata_path = './datas/maillog/mail_logdata-' . $form{'v'} . '.cgi';
} else {
	$logdata_path = $logdata_path . 'mail_logdata-' . $form{'v'} . '.cgi';
}

@list = &loadfile($logdata_path);

@list = grep(/\t$form{'id'}\t/,@list);
@record = split(/\t/,$list[0]);

$session_data_info = $record[1];
#$stmp = $record[0];

## 項目読み込み
@elements = &loadfile('./datas/modules/elements/elements.dat');
unshift @elements,"000\t000\t通し番号";
unshift @elements,"000\t000\t送信ID";
unshift @elements,"000\t000\t送信日時";
push @elements,"000\t000\tホスト名";
push @elements,"000\t000\tIPアドレス";
push @elements,"000\t000\tブラウザ\/OS";
push @elements,"000\t000\t送信元アドレス";
$elt = 0;
for($cnt=0;$cnt<@elements;$cnt++){
	($elements_id,$num,$name,$type_of_element,$html_size,$html_rows,$html_cols,$html_id,$element_type,$check_type,$on_event,$html_tag_free,$text_min,$text_max,$enable_filetypes,$filesize_min,$filesize_max,$checked_min,$checked_max,$element_valus,$element_text,$html_example,$note,$element_error_message,$must_disp,$default_value,$system_disp_false,$html_tag_free_top,$elements_class) = split(/\t/,$elements[$elt]);
	
	#項目名の改良処理
	${name} =~ s/&lt;-br-&gt;//g;
	
	if($element_type ne "spacer"){
		$colored = "";
		if($cnt % 2 == 0){
			$colored = " class=\"colored\"";
		}
		$check_attached_files = "./datas/attached_files/${session_data_info}_en${elements_id}\.cgi";
		if(-f $check_attached_files){
			# ファイル名の差し替え（通し番号にする）
			@filename_arr = split(/\./,$record[$cnt]);
			$record[$cnt] = $serials_this_num . '.' . $filename_arr[-1];
			
			$filename = &encodeURI($record[$cnt]);
			$view .= "<tr${colored}><th>${name}</th><td><a href=\"download.cgi?mode=attached&path=${session_data_info}_en${elements_id}&name=${filename}\">${record[$cnt]}</a>&nbsp;</td></tr>";
		}
		else {
			${record[$cnt]} = &sanitizing_meta(${record[$cnt]});
			$view .= "<tr${colored}><th>${name}</th><td>${record[$cnt]}&nbsp;</td></tr>";
			
			# 添付ファイル名に通し番号を設定するために
			if($name eq '通し番号'){
				# ファイル名用に一時格納
				$serials_this_num = ${record[$cnt]};
			}
		}
	}
	else {
		$cnt--;
	}
	$elt++;
}

$print_html = <<"EOF";
	<div class="displayLayout">
	<table cellpadding="0" cellspacing="0" class="displayLayout">
		${view}
		<tr>
			<td>&nbsp;</td>
			<td><input type="button" name="submit" value="戻る" onclick="location.href='?m=$form{'m'}'" /></td>
		</tr>
	</table>
	</div>
EOF
