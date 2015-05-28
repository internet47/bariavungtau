###############################################################################
# Administrated Screen Users Editable Functions
###############################################################################

@mailform_env = &loadfile('./datas/modules/mailform_env/mailform_env.dat');
$mailform_env = join("\n",@mailform_env);
($mailform_flag,$expires_start,$expires_end,$limit,$serials,$thanks_page,$sendmail_path,$logsave,$cart_in_element,$cart_logsave,$send_mode,$attached_mode,$display_mode,$logdata_path,$cart_logdata_path,$mailform_sender_address_name,$mailform_sender_address,$mail_method,$thanks_message,$title_mailform,$title_confirm,$title_error,$title_thanks,$spamcheck,$mail_dustclear,$mail_dustclear_zero,$client_info,$site_url,$table_style,$th_style,$td_style,$separate_before,$separate_after,$flag_afiri,$afiri_tag,$flag_smartphone_tpl,$flag_futurephone_tpl,$setlang) = split(/\n/,$mailform_env);

# escape
$logdata_path_copy = $logdata_path;

if($logdata_path eq $null){
	$logdata_path = './datas/maillog/mail_logdata-' . $form{'v'} . '.cgi';
} else {
	$logdata_path = $logdata_path . 'mail_logdata-' . $form{'v'} . '.cgi';
}


# BUファイルも定義して削除
$logdata_bu_path = $logdata_path . '.backup';

&dirclear('./datas/attached_files/');
&savefile($logdata_path,@null);
&savefile($logdata_bu_path,@null);

# 初期化履歴の保存
if($logdata_path_copy eq $null){
	$delstamp_path = './datas/maillog/logdata_delstamp.cgi';
} else {
	$delstamp_path = $logdata_path_copy . 'logdata_delstamp.cgi';
}
$date_stamp = sprintf("%04d/%02d/%02d %02d:%02d:%02d",$year,$mon,$day,$hour,$min,$sec);
&mfp_SaveAddLine($delstamp_path,$date_stamp);

$redirect = "?m=$form{'m'}";
