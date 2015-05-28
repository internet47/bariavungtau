###############################################################################
# Administrated Screen Users Editable Functions
###############################################################################
# mailform_env
$current_data = join("\n",@current_data);
($flag,$expires_start,$expires_end,$limit,$serials,$thanks_page,$sendmail_path,$logsave,$cart_in_element,$cart_logsave,$send_mode,$attached_mode,$display_mode,$logdata_path,$cart_logdata_path,$mailform_sender_address_name,$mailform_sender_address,$mail_method,$thanks_message,$title_mailform,$title_confirm,$title_error,$title_thanks,$spamcheck,$mail_dustclear,$mail_dustclear_zero,$client_info,$site_url,$table_style,$th_style,$td_style,$separate_before,$separate_after,$flag_afiri,$afiri_tag,$flag_smartphone_tpl,$flag_futurephone_tpl,$setlang) = split(/\n/,$current_data);

# return_mail
$flag_res_mail = $current_data3[0];

my $flag_file = 0;
for($cnt=0;$cnt<@current_data2;$cnt++){
	my(@current_record2) = split(/\t/,$current_data2[$cnt]);
	if($current_record2[8] eq 'file'){
		$flag_file = 1;
	}
}

## path
eval{ $server_root_path = `pwd`; };
if ($@ || !$server_root_path) { $server_root_path = 'unknown'; }
if($server_root_path eq 'unknown'){
	if ($0 =~ /^(.*[\\\/])/) { $server_root_path = $1; }
	else { $server_root_path = 'unknown'; }
}
if($server_root_path eq 'unknown'){
	$server_root_path = $ENV{'SCRIPT_FILENAME'};
	@path = split(/\//,$server_root_path);
	pop @path;
	$server_root_path = join("\/",@path);
}
$server_root_path =~ s/\n//g;

if($flag){
	$flag_checked = ' checked';
}
if($serials){
	$serial_checked = ' checked';
}
if($logsave){
	$logsave_checked = ' checked';
}
if($send_mode){
	$send_flag_checked = ' checked';
}
if($attached_mode){
	$attached_mode_checked = ' checked';
}
if($display_mode eq "table"){
	$table_checked = ' checked';
}
else {
	$dl_checked = ' checked';
}

if($mail_method eq "text"){
	$text_checked = " checked";
}
else {
	$html_checked = " checked";
}
if($spamcheck){
	$spamcheck_checked = " checked";
}
if($mail_dustclear){
	$mail_dustclear_checked = " checked";
}
if($mail_dustclear_zero){
	$mail_dustclear_zero_checked = " checked";
}
$thanks_message =~ s/<br \/>/\n/g;
$client_info =~ s/<br \/>/\n/g;
if(!($attached_method)){
	$attached_method_hidden = " style=\"display: none\"";
}

${table_style} =~ s/"/&quot;/g;
${th_style} =~ s/"/&quot;/g;
${td_style} =~ s/"/&quot;/g;

if($flag_afiri){
	$flag_afiri_checked = " checked";
}
${afiri_tag} =~ s/"/&quot;/g;

if($flag_smartphone_tpl){
	$flag_smartphone_tpl_checked = " checked";
}

if($flag_futurephone_tpl){
	$flag_futurephone_tpl_checked = " checked";
}

if($setlang eq 'utf8'){
	$setlang_utf8_checked = " checked";
}

## 条件定義用の項目読み込み
@elements = &loadfile('./datas/modules/elements/elements.dat');
#送信元名用
$flag_soushinmoto = 0;
for($cnt=0;$cnt<@elements;$cnt++){
	($elements_id,$num,$name,$type_of_element,$html_size,$html_rows,$html_cols,$html_id,$element_type,$check_type,$on_event,$html_tag_free,$text_min,$text_max,$enable_filetypes,$filesize_min,$filesize_max,$checked_min,$checked_max,$element_valus,$element_text,$html_example,$note,$element_error_message,$must_disp,$default_value,$system_disp_false,$html_tag_free_top,$elements_class) = split(/\t/,$elements[$cnt]);
	if($element_type ne "spacer"){
		#既に登録されている値から、selectedを指定
		$checkflag_mailform_sender_address_name = ${mailform_sender_address_name};
		$checkflag_mailform_sender_address_name =~ s/&lt;//g;
		$checkflag_mailform_sender_address_name =~ s/&gt;//g;
		if($checkflag_mailform_sender_address_name eq ${elements_id}){
			$add_elements_value_list_name .= "<option value=\"<${elements_id}>\" selected=\"selected\">${name}</option>";
			#エンドユーザ情報が反映されていたので、フラグに1を立てる
			$flag_soushinmoto = 1;
		}else{
			$add_elements_value_list_name .= "<option value=\"<${elements_id}>\">${name}</option>";
		}
	}
}
if(!$flag_soushinmoto){	$add_elements_value_list_name = "<option value=\"メールフォーム管理システム\" class=\"caution\">ユーザ情報未選択 or 手動設定</option>" . $add_elements_value_list_name;}

#送信元メールアドレス用
$flag_soushinmoto = 0;
for($cnt=0;$cnt<@elements;$cnt++){
	($elements_id,$num,$name,$type_of_element,$html_size,$html_rows,$html_cols,$html_id,$element_type,$check_type,$on_event,$html_tag_free,$text_min,$text_max,$enable_filetypes,$filesize_min,$filesize_max,$checked_min,$checked_max,$element_valus,$element_text,$html_example,$note,$element_error_message,$must_disp,$default_value,$system_disp_false,$html_tag_free_top,$elements_class) = split(/\t/,$elements[$cnt]);
	if($element_type ne "spacer"){
		#既に登録されている値から、selectedを指定
		$checkflag_mailform_sender_address = ${mailform_sender_address};
		$checkflag_mailform_sender_address =~ s/&lt;//g;
		$checkflag_mailform_sender_address =~ s/&gt;//g;
		if($checkflag_mailform_sender_address eq ${elements_id}){
			$add_elements_value_list_mail .= "<option value=\"<${elements_id}>\" selected=\"selected\">${name}</option>";
			#エンドユーザ情報が反映されていたので、フラグに1を立てる
			$flag_soushinmoto = 1;
		}else{
			$add_elements_value_list_mail .= "<option value=\"<${elements_id}>\">${name}</option>";
		}
	}
}
if(!$flag_soushinmoto){	$add_elements_value_list_mail = "<option value=\"\" class=\"caution\">ユーザ情報未選択 or 手動設定 </option>" . $add_elements_value_list_mail;}


##初期値判定
#URL（トップページ）
if(${site_url} eq 'http://www.xx.xx/'){
	$site_url_error_msg = '<img src="../images/mfp_error.gif" class="error_img" />初期値のままです。';
	$site_url_error_bg = 'class="error_bg"';
}elsif(!${site_url}){
	$site_url_error_msg = '<img src="../images/mfp_error.gif" class="error_img" />入力されていません。';
	$site_url_error_bg = 'class="error_bg"';
}

#クライアント情報
$client_info_work = ${client_info};
$client_info_work =~ s/\n/<>/g;
if($client_info_work eq '株式会社○○<>〒xxx-xxxx　○○都○○区○○<>TEL：xx-xxxx-xxxx<>FAX：xx-xxxx-xxxx<>E-mail：xx@xx.xx'){
	$client_info_error_msg = '<img src="../images/mfp_error.gif" class="error_img" />初期値のままです。';
	$client_info_error_bg = 'class="error_bg"';
}elsif(!${client_info}){
	$client_info_error_msg = '<img src="../images/mfp_error.gif" class="error_img" />入力されていません。';
	$client_info_error_bg = 'class="error_bg"';
}



## 通し番号
$serial_num = &mfp_LoadLine('./datas/serial.dat');
$action_name = 'Fmailプラン確認シート';
$print_html = <<"EOF";
<p>プランに対する内訳を判定します。</p>
<form>
	<fieldset>
		<select id="plan_set" onchange="plan_check(this.id);">
			<option value="">Fmailのプランを選択してください</option>
			<option value="スタンダードプラン">スタンダードプラン</option>
			<option value="ゴールドプラン">ゴールドプラン</option>
			<option value="プレミアムゴールドプラン">プレミアムゴールドプラン</option>
			<option value="プレミアムプラン">プレミアムプラン</option>
		</select><br /><br />
		<p id="result">
			<textarea id="result_item"></textarea>
		</p>
	</fieldset>
</form>
EOF

# メール送信
$mail_send = '<span class="check_off">●</span>';

# 自動返信
if($flag_res_mail){
	$res_sw = '<span class="check_on">●</span>';
	$res_sw_set = '<span class="check_set">SET</span>';
}else{
	$res_sw = '<span class="check_off">●OFF</span>';
}

# スパムフィルタ
if($spamcheck){
	$spam_ft = '<span class="check_on">●</span>';
	$spam_ft_set = '<span class="check_set">SET</span>';
}else{
	$spam_ft = '<span class="check_off">●OFF</span>';
}

# 郵便番号からの住所自動反映機能
$zip_addr = '<span class="check_off">●</span>';

# ファイル添付機能
if($flag_file){
	$file_em = '<span class="check_on">●</span>';
	$file_em_set = '<span class="check_set">SET</span>';
	$file_em_ng = '<span class="check_ng">NG</span>';
}else{
	$file_em = '<span class="check_off">●OFF</span>';
}

# ＨＴＭＬメール
if($mail_method eq "html"){
	$html_mail = '<span class="check_on">●</span>';
	$html_mail_set = '<span class="check_set">SET</span>';
	$html_mail_ng = '<span class="check_ng">NG</span>';
}else{
	$html_mail = '<span class="check_off">●OFF</span>';
}

# フィーチャーフォン対応
if($flag_futurephone_tpl){
	$mobile_set = '<span class="check_on">●</span>';
	$mobile_set_set = '<span class="check_set">SET</span>';
	$mobile_set_ng = '<span class="check_ng">NG</span>';
}else{
	$mobile_set = '<span class="check_off">●OFF</span>';
}

# アフィリエイトタグ追加機能
if($flag_afiri){
	$aff_tag = '<span class="check_on">●</span>';
	$aff_tag_set = '<span class="check_set">SET</span>';
	$aff_tag_ng = '<span class="check_ng">NG</span>';
}else{
	$aff_tag = '<span class="check_off">●OFF</span>';
}

# 未入力項目処理機能
if($mail_dustclear || $mail_dustclear_zero){
	$minyuryoku_data = '<span class="check_on">●</span>';
	$minyuryoku_data_set = '<span class="check_set">SET</span>';
	$minyuryoku_data_ng = '<span class="check_ng">NG</span>';
}else{
	$minyuryoku_data = '<span class="check_off">●OFF</span>';
}

# 対応言語モード
if($setlang eq 'utf8'){
	$setlang_data = '<span class="check_on">●</span>';
	$setlang_data_set = '<span class="check_set">SET</span>';
	$setlang_data_ng = '<span class="check_ng">NG</span>';
}else{
	$setlang_data = '<span class="check_off">●OFF</span>';
}

# メール履歴管理（限定開放）
if($logsave){
	$rireki = '<span class="check_on">●</span>';
	$rireki_set = '<span class="check_set">SET</span>';
	$rireki_ng = '<span class="check_ng">NG</span>';
}else{
	$rireki = '<span class="check_off">●OFF</span>';
}
# 商品カート履歴管理（限定開放）
if($cart_logsave){
	$cart = '<span class="check_on">●</span>';
	$cart_set = '<span class="check_set">SET</span>';
	$cart_ng = '<span class="check_ng">NG</span>';
}else{
	$cart = '<span class="check_off">●OFF</span>';
}

# スマートフォン対応
if($flag_smartphone_tpl){
	$sp_set = '<span class="check_on">●</span>';
	$sp_set_set = '<span class="check_set">SET</span>';
	$sp_set_ng = '<span class="check_ng">NG</span>';
}else{
	$sp_set = '<span class="check_off">●OFF</span>';
}

# 管理画面（完全開放）
$all = '<span class="check_off">●</span>';

# 項目編集
$all_em = '<span class="check_off">●</span>';

# メール宛先・件名・本文編集
$all_mail = '<span class="check_off">●</span>';

$print_html .= <<"EOF";
<table id="plan_list">
	<tr>
		<td></th>
		<td>機能名</th>
		<td class="platinum">プラチナ</th>
		<td class="premium">プレミアムゴールド</th>
		<td class="gold">ゴールド</th>
		<td class="standard">スタンダード</th>
	</tr>
	<tr>
		<td>1</td>
		<td class="title">メール送信</td>
		<td class="platinum">$mail_send</td><td class="premium">$mail_send</td><td class="gold">$mail_send</td><td class="standard">$mail_send</td>
	</tr>
	<tr>
		<td>2</td>
		<td class="title">自動返信</td>
		<td class="platinum">$res_sw$res_sw_set</td><td class="premium">$res_sw$res_sw_set</td><td class="gold">$res_sw$res_sw_set</td><td class="standard">$res_sw$res_sw_set</td>
	</tr>
	<tr>
		<td>3</td>
		<td class="title">スパムフィルタ</td>
		<td class="platinum">$spam_ft$spam_ft_set</td><td class="premium">$spam_ft$spam_ft_set</td><td class="gold">$spam_ft$spam_ft_set</td><td class="standard">$spam_ft$spam_ft_set</td>
	</tr>
	<tr class="kubun">
		<td>4</td>
		<td class="title">郵便番号からの住所自動反映機能</td>
		<td class="platinum">$zip_addr$zip_addr_set</td><td class="premium">$zip_addr$zip_addr_set</td><td class="gold">$zip_addr$zip_addr_set</td><td class="standard">$zip_addr$zip_addr_set</td>
	</tr>
	<tr>
		<td>5</td>
		<td class="title">ファイル添付機能</td>
		<td class="platinum">$file_em$file_em_set</td><td class="premium">$file_em$file_em_set</td><td class="gold">$file_em$file_em_set</td><td class="standard">$file_em_ng</td>
	</tr>
	<tr>
		<td>6</td>
		<td class="title">ＨＴＭＬメール</td>
		<td class="platinum">$html_mail$html_mail_set</td><td class="premium">$html_mail$html_mail_set</td><td class="gold">$html_mail$html_mail_set</td><td class="standard">$html_mail_ng</td>
	</tr>
	<tr>
		<td>7</td>
		<td class="title">フィーチャーフォン対応</td>
		<td class="platinum">$mobile_set$mobile_set_set</td><td class="premium">$mobile_set$mobile_set_set</td><td class="gold">$mobile_set$mobile_set_set</td><td class="standard">$mobile_set_ng</td>
	</tr>
	<tr>
		<td>8</td>
		<td class="title">アフィリエイトタグ追加機能</td>
		<td class="platinum">$aff_tag$aff_tag_set</td><td class="premium">$aff_tag$aff_tag_set</td><td class="gold">$aff_tag$aff_tag_set</td><td class="standard">$aff_tag_ng</td>
	</tr>
	<tr>
		<td>9</td>
		<td class="title">未入力項目処理機能</td>
		<td class="platinum">$minyuryoku_data$minyuryoku_data_set</td><td class="premium">$minyuryoku_data$minyuryoku_data_set</td><td class="gold">$minyuryoku_data$minyuryoku_data_set</td><td class="standard">$minyuryoku_data_ng</td>
	</tr>
	<tr class="kubun">
		<td>10</td>
		<td class="title">多言語モード</td>
		<td class="platinum">$setlang_data$setlang_data_set</td><td class="premium">$setlang_data$setlang_data_set</td><td class="gold">$setlang_data$setlang_data_set</td><td class="standard">$setlang_data_ng</td>
	</tr>
	<tr>
		<td>11</td>
		<td class="title">メール履歴管理（限定開放）</td>
		<td class="platinum">$rireki$rireki_set</td><td class="premium">$rireki$rireki_set</td><td class="gold">$rireki_ng</td><td class="standard">$rireki_ng</td>
	</tr>
	<tr>
		<td>12</td>
		<td class="title">商品カート履歴管理（限定開放）</td>
		<td class="platinum">$cart$cart_set</td><td class="premium">$cart$cart_set</td><td class="gold">$cart_ng</td><td class="standard">$cart_ng</td>
	</tr>
	<tr class="kubun">
		<td>13</td>
		<td class="title">スマートフォン対応</td>
		<td class="platinum">$sp_set$sp_set_set</td><td class="premium">$sp_set$sp_set_set</td><td class="gold">$sp_set_ng</td><td class="standard">$sp_set_ng</td>
	</tr>
	<tr>
		<td>14</td>
		<td class="title">管理画面（完全開放）</td>
		<td class="platinum">$all</td><td class="premium">　</td><td class="gold">　</td><td class="standard">　</td>
	</tr>
	<tr>
		<td>15</td>
		<td class="title">項目編集</td>
		<td class="platinum">$all_em</td><td class="premium">　</td><td class="gold">　</td><td class="standard">　</td>
	</tr>
	<tr>
		<td>16</td>
		<td class="title">メール宛先・件名・本文編集</td>
		<td class="platinum">$all_mail</td><td class="premium">　</td><td class="gold">　</td><td class="standard">　</td>
	</tr>
	<tr>
		<td colspan="6" class="info">※「<span class="check_off">●</span>」のみは、システム的に確認出来ない項目の為、手動確認願います</td>
	</tr>
</table>
<br /><br />
<form style="display: none;">
	<table cellpadding="0" cellspacing="0" class="sheet">
		<tr>
			<th>履歴保存</th>
			<td><input type="checkbox" name="logsave" id="log_save" value="1"${logsave_checked} /></td>
		</tr>
		<tr>
			<th>未入力項目</th>
			<td>
				<input type="checkbox" name="mail_dustclear" id="mail_dustclear" value="1"${mail_dustclear_checked} /> 未入力項目をメールに反映しない。<br />
				<input type="checkbox" name="mail_dustclear_zero" id="mail_dustclear_zero" value="1"${mail_dustclear_zero_checked} /> 「0」または、「0個」をメールに反映しない。
			</td>
		</tr>
		<tr>
			<th>ファイル添付項目</th>
			<td>
				<input type="text" name="element_file" id="flag_file" value="$flag_file" /> 1なら項目に添付ファイル設定あり
			</td>
		</tr>
		<tr>
			<th>メールモード</th>
			<td>
				<input type="radio" name="mail_method" id="mail_method_html" value="html"${html_checked} /> HTMLメール
			</td>
		</tr>
		<tr>
			<th>アフィリエイト</th>
			<td>
				<input type="checkbox" name="flag_afiri" id="flag_afiri" value="1"$flag_afiri_checked /> 利用する。
			</td>
		</tr>
		<tr>
			<th>スマートフォン用<br />テンプレート</th>
			<td>
				<input type="checkbox" name="flag_smartphone_tpl" id="flag_smartphone_tpl" value="1"$flag_smartphone_tpl_checked /> 利用する。
			</td>
		</tr>
		<tr>
			<th>フィーチャーフォン用<br />テンプレート</th>
			<td>
				<input type="checkbox" name="flag_futurephone_tpl" id="flag_futurephone_tpl" value="1"$flag_futurephone_tpl_checked /> 利用する。
			</td>
		</tr>
		<tr>
			<th>多言語モード</th>
			<td>
				<input type="radio" name="setlang" id="setlang" value="utf8"$setlang_utf8_checked /> 多言語モード
			</td>
		</tr>
	</table>
</form>
EOF
