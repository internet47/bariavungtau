#!/usr/bin/perl --

require './commons/conf.cgi';
require './commons/cgi-lib.pl';
require '../fmail.lib.cgi';
require $registry;
&ReadParse(*form);
use File::Basename;
use lib qw(../);
use Jcode;

$buffer = $ENV{'QUERY_STRING'};
@pairs = split(/&/, $buffer);
foreach $pair (@pairs) {
	($name, $value) = split(/=/, $pair);
	$name =~ tr/+/ /;
	$name =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
	$value =~ tr/+/ /;
	$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
	$value =~ s/\,/\./g;
	$form{$name} = $value;
}

if(&loginCheck){
	if($form{'mode'} eq "attached"){
		$check_attached_files = "./datas/attached_files/$form{'path'}\.cgi";
		if(-f $check_attached_files){
			chmod 0777, $check_attached_files;
			print "Content-type: application/octet-stream; name=\"$form{'name'}\"\n";
			print "Content-Disposition: attachment; filename=\"$form{'name'}\"\n\n";
			open(IN,$check_attached_files);
			print <IN>;
			chmod 0600, $check_attached_files;
		}
		else {
			print "Content-type: text/html; charset=UTF-8\n\n";
			print "file not found";
		}
	}
	if($form{'mode'} eq "csvdownload"){
		if(-f $form{'path'}){
			@elements = &loadfile('./datas/modules/elements/elements.dat');
			unshift @elements,"000\t000\t通し番号";
			unshift @elements,"000\t000\t送信ID";
			unshift @elements,"000\t000\t送信日時";
			unshift @elements,"000\t000\t小計（税込）";
			unshift @elements,"000\t000\t個数";
			unshift @elements,"000\t000\t単価（税込）";
			unshift @elements,"000\t000\t商品詳細2";
			unshift @elements,"000\t000\t商品詳細1";
			unshift @elements,"000\t000\t商品名";
			unshift @elements,"000\t000\t商品コード";
			unshift @elements,"000\t000\t注文番号";
			unshift @elements,"000\t000\tお問い合わせ番号";
			push @elements,"000\t000\tホスト名";
			push @elements,"000\t000\tIPアドレス";
			push @elements,"000\t000\tブラウザ\/OS";
			push @elements,"000\t000\t送信元アドレス";
			for($cnt=0;$cnt<@elements;$cnt++){
				($elements_id,$num,$name,$type_of_element,$html_size,$html_rows,$html_cols,$html_id,$element_type,$check_type,$on_blur,$on_focus,$text_min,$text_max,$enable_filetypes,$filesize_min,$filesize_max,$checked_min,$checked_max,$element_valus,$element_text,$html_example,$note) = split(/\t/,$elements[$cnt]);
				if($element_type ne "spacer"){
					
					#項目名の改良処理
					$name =~ s/&lt;-br-&gt;//;
					
					push @fieldnames,$name;
				}
			}
			## Microsoft CSV Export
			@csv = &loadfile($form{'path'});
			unshift @csv,join("\t",@fieldnames);
			for($cnt=0;$cnt<@csv;$cnt++){
				$csv[$cnt] =~ s/\"//g;
				@record = split(/\t/,$csv[$cnt]);
				$csv[$cnt] = "\"" . join("\"\,\"",@record) . "\"";
			}
			$csv = join("\n",@csv);
			# CSVダウンロード時の改行コード付与判定
			if ($form{'line'} eq 'br') {
				$csv =~ s/<br \/>/\n/g;
			}else{
				# 何もない場合は、<br />ままセルに残ります。
			}
			
			# 機種依存文字対応
			@kisyumoji = ('～','－','纊','褜','鍈','銈','蓜','俉','炻','昱','棈','鋹','曻','彅','丨','仡','仼','伀','伃','伹','佖','侒','侊','侚','侔','俍','偀','倢','俿','倞','偆','偰','偂','傔','僴','僘','兊','兤','冝','冾','凬','刕','劜','劦','勀','勛','匀','匇','匤','卲','厓','厲','叝','﨎','咜','咊','咩','哿','喆','坙','坥','垬','埈','埇','﨏','塚','增','墲','夋','奓','奛','奝','奣','妤','妺','孖','寀','甯','寘','寬','尞','岦','岺','峵','崧','嵓','﨑','嵂','嵭','嶸','嶹','巐','弡','弴','彧','德','忞','恝','悅','悊','惞','惕','愠','惲','愑','愷','愰','憘','戓','抦','揵','摠','撝','擎','敎','昀','昕','昻','昉','昮','昞','昤','晥','晗','晙','晴','晳','暙','暠','暲','暿','曺','朎','朗','杦','枻','桒','柀','栁','桄','棏','﨓','楨','﨔','榘','槢','樰','橫','橆','橳','橾','櫢','櫤','毖','氿','汜','沆','汯','泚','洄','涇','浯','涖','涬','淏','淸','淲','淼','渹','湜','渧','渼','溿','澈','澵','濵','瀅','瀇','瀨','炅','炫','焏','焄','煜','煆','煇','凞','燁','燾','犱','犾','猤','猪','獷','玽','珉','珖','珣','珒','琇','珵','琦','琪','琩','琮','瑢','璉','璟','甁','畯','皂','皜','皞','皛','皦','益','睆','劯','砡','硎','硤','硺','礰','礼','神','祥','禔','福','禛','竑','竧','靖','竫','箞','精','絈','絜','綷','綠','緖','繒','罇','羡','羽','茁','荢','荿','菇','菶','葈','蒴','蕓','蕙','蕫','﨟','薰','蘒','﨡','蠇','裵','訒','訷','詹','誧','誾','諟','諸','諶','譓','譿','賰','賴','贒','赶','﨣','軏','﨤','逸','遧','郞','都','鄕','鄧','釚','釗','釞','釭','釮','釤','釥','鈆','鈐','鈊','鈺','鉀','鈼','鉎','鉙','鉑','鈹','鉧','銧','鉷','鉸','鋧','鋗','鋙','鋐','﨧','鋕','鋠','鋓','錥','錡','鋻','﨨','錞','鋿','錝','錂','鍰','鍗','鎤','鏆','鏞','鏸','鐱','鑅','鑈','閒','隆','﨩','隝','隯','霳','霻','靃','靍','靏','靑','靕','顗','顥','飯','飼','餧','館','馞','驎','髙','髜','魵','魲','鮏','鮱','鮻','鰀','鵰','鵫','鶴','鸙','黑');
			# SJIS対応の2進数
			@kisyucode = ('1000000100000110','1000000100111110','0101111100111010','0101111110111010','0101111101111010','0101111111111010','0101111100000110','0101111110000110','0101111101000110','0101111111000110','0101111100100110','0101111110100110','0101111101100110','0101111111100110','0101111100010110','0101111110010110','0101111101010110','0101111111010110','0101111100110110','0101111110110110','0101111101110110','0101111111110110','0101111100001110','0101111110001110','0101111101001110','0101111111001110','0101111100101110','0101111110101110','0101111101101110','0101111111101110','0101111100011110','0101111110011110','0101111101011110','0101111111011110','0101111100111110','0101111110111110','0101111101111110','0101111100000001','0101111110000001','0101111101000001','0101111111000001','0101111100100001','0101111110100001','0101111101100001','0101111111100001','0101111100010001','0101111110010001','0101111101010001','0101111111010001','0101111100110001','0101111110110001','0101111101110001','0101111111110001','0101111100001001','0101111110001001','0101111101001001','0101111111001001','0101111100101001','0101111110101001','0101111101101001','0101111111101001','0101111100011001','0101111110011001','0101111101011001','0101111111011001','0101111100111001','0101111110111001','0101111101111001','0101111111111001','0101111100000101','0101111110000101','0101111101000101','0101111111000101','0101111100100101','0101111110100101','0101111101100101','0101111111100101','0101111100010101','0101111110010101','0101111101010101','0101111111010101','0101111100110101','0101111110110101','0101111101110101','0101111111110101','0101111100001101','0101111110001101','0101111101001101','0101111111001101','0101111100101101','0101111110101101','0101111101101101','0101111111101101','0101111100011101','0101111110011101','0101111101011101','0101111111011101','0101111100111101','0101111110111101','0101111101111101','0101111111111101','0101111100000011','0101111110000011','0101111101000011','0101111111000011','0101111100100011','0101111110100011','0101111101100011','0101111111100011','0101111100010011','0101111110010011','0101111101010011','0101111111010011','0101111100110011','0101111110110011','0101111101110011','0101111111110011','0101111100001011','0101111110001011','0101111101001011','0101111111001011','0101111100101011','0101111110101011','0101111101101011','0101111111101011','0101111100011011','0101111110011011','0101111101011011','0101111111011011','0101111100111011','0101111110111011','0101111101111011','0101111111111011','0101111100000111','0101111110000111','0101111101000111','0101111111000111','0101111100100111','0101111110100111','0101111101100111','0101111111100111','0101111100010111','0101111110010111','0101111101010111','0101111111010111','0101111100110111','0101111110110111','0101111101110111','0101111111110111','0101111100001111','0101111110001111','0101111101001111','0101111111001111','0101111100101111','0101111110101111','0101111101101111','0101111111101111','0101111100011111','0101111110011111','0101111101011111','0101111111011111','0101111100111111','1101111100000010','1101111110000010','1101111101000010','1101111111000010','1101111100100010','1101111110100010','1101111101100010','1101111111100010','1101111100010010','1101111110010010','1101111101010010','1101111111010010','1101111100110010','1101111110110010','1101111101110010','1101111111110010','1101111100001010','1101111110001010','1101111101001010','1101111111001010','1101111100101010','1101111110101010','1101111101101010','1101111111101010','1101111100011010','1101111110011010','1101111101011010','1101111111011010','1101111100111010','1101111110111010','1101111101111010','1101111111111010','1101111100000110','1101111110000110','1101111101000110','1101111111000110','1101111100100110','1101111110100110','1101111101100110','1101111111100110','1101111100010110','1101111110010110','1101111101010110','1101111111010110','1101111100110110','1101111110110110','1101111101110110','1101111111110110','1101111100001110','1101111110001110','1101111101001110','1101111111001110','1101111100101110','1101111110101110','1101111101101110','1101111111101110','1101111100011110','1101111110011110','1101111101011110','1101111111011110','1101111100111110','1101111110111110','1101111101111110','1101111100000001','1101111110000001','1101111101000001','1101111111000001','1101111100100001','1101111110100001','1101111101100001','1101111111100001','1101111100010001','1101111110010001','1101111101010001','1101111111010001','1101111100110001','1101111110110001','1101111101110001','1101111111110001','1101111100001001','1101111110001001','1101111101001001','1101111111001001','1101111100101001','1101111110101001','1101111101101001','1101111111101001','1101111100011001','1101111110011001','1101111101011001','1101111111011001','1101111100111001','1101111110111001','1101111101111001','1101111111111001','1101111100000101','1101111110000101','1101111101000101','1101111111000101','1101111100100101','1101111110100101','1101111101100101','1101111111100101','1101111100010101','1101111110010101','1101111101010101','1101111111010101','1101111100110101','1101111110110101','1101111101110101','1101111111110101','1101111100001101','1101111110001101','1101111101001101','1101111111001101','1101111100101101','1101111110101101','1101111101101101','1101111111101101','1101111100011101','1101111110011101','1101111101011101','1101111111011101','1101111100111101','1101111110111101','1101111101111101','1101111111111101','1101111100000011','1101111110000011','1101111101000011','1101111111000011','1101111100100011','1101111110100011','1101111101100011','1101111111100011','1101111100010011','1101111110010011','1101111101010011','1101111111010011','1101111100110011','1101111110110011','1101111101110011','1101111111110011','1101111100001011','1101111110001011','1101111101001011','1101111111001011','1101111100101011','1101111110101011','1101111101101011','1101111111101011','1101111100011011','1101111110011011','1101111101011011','1101111111011011','1101111100111011','1101111110111011','1101111101111011','1101111111111011','1101111100000111','1101111110000111','1101111101000111','1101111111000111','1101111100100111','1101111110100111','1101111101100111','1101111111100111','1101111100010111','1101111110010111','1101111101010111','1101111111010111','1101111100110111','1101111110110111','1101111101110111','1101111111110111','1101111100001111','1101111110001111','1101111101001111','1101111111001111','1101111100101111','1101111110101111','1101111101101111','1101111111101111','1101111100011111','1101111110011111','1101111101011111','1101111111011111','1101111100111111','0011111100000010','0011111110000010','0011111101000010','0011111111000010','0011111100100010','0011111110100010','0011111101100010','0011111111100010','0011111100010010','0011111110010010','0011111101010010','0011111111010010');
			# リスト文字をひとつずつ取り出しチェック
			for($kisyu_cnt=0;$kisyu_cnt<@kisyumoji;$kisyu_cnt++){
				# HITした場合、2進数で置換する。
				$csv =~ s/$kisyumoji[$kisyu_cnt]/<--$kisyucode[$kisyu_cnt]-->/g;
			}
			
			# 多言語対応
			#メールフォーム設定
			@mailform_env = &loadfile('./datas/modules/mailform_env/mailform_env.dat');
			$mailform_env = join("\n",@mailform_env);
			($mailform_flag,$expires_start,$expires_end,$limit,$serials,$thanks_page,$sendmail_path,$logsave,$cart_in_element,$cart_logsave,$send_mode,$attached_mode,$display_mode,$logdata_path,$cart_logdata_path,$mailform_sender_address_name,$mailform_sender_address,$mail_method,$thanks_message,$title_mailform,$title_confirm,$title_error,$title_thanks,$spamcheck,$mail_dustclear,$mail_dustclear_zero,$client_info,$site_url,$table_style,$th_style,$td_style,$separate_before,$separate_after,$flag_afiri,$afiri_tag,$flag_smartphone_tpl,$flag_futurephone_tpl,$setlang) = split(/\n/,$mailform_env);
			#if($setlang ne 'utf8'){
				# SJISへのコンバート
				Jcode::convert(\$csv,'sjis');
			#}else{
			#	# utf8のままなので、スルー
			#}
			
			# リスト文字をひとつずつ取り出しチェック
			for($kisyu_cnt=0;$kisyu_cnt<@kisyucode;$kisyu_cnt++){
				# 機種依存文字の復元
				$kisyu_pack = pack("b*",$kisyucode[$kisyu_cnt]);
				# 復元した文字で置換
				$csv =~ s/<--$kisyucode[$kisyu_cnt]-->/$kisyu_pack/g;
			}
			
			
			
			($sec,$min,$hour,$day,$mon,$year,$wday,$yday,$isdst) = gmtime(time + 9 * 3600);
			$mon++;$year += 1900;
			# fmailフォルダの名前付与----------
			# フルパス
			$fullpath = $ENV{SCRIPT_FILENAME};
			# ディレクトリ名のみ
			$dirpath = dirname($fullpath);
			# ディレクトリ名分割
			@pathname = split(/\//,$dirpath);
			# ファイル名合成
			@dname_arr = split(/-/,$form{'path'});
			$dname = "cartlog$dname_arr[1]$dname_arr[2]";
			$dname =~ s/.cgi//g;
			$form{'name'} = $pathname[-2] . '-' . $dname . '.csv';
			#$form{'name'} = $pathname[-2] . '-' . sprintf("%04d-%02d-%02d.csv",$year,$mon,$day);
			print "Content-type: application/octet-stream; name=\"$form{'name'}\"\n";
			print "Content-Disposition: attachment; filename=\"$form{'name'}\"\n\n";
			print $csv;
			
			# ダウンロード履歴の保存
			if($cart_logdata_path eq $null) {
				$dlstamp_path = './datas/cartlog/cart_logdata_dlstamp.cgi';
			} else {
				$dlstamp_path = $cart_logdata_path . 'cart_logdata_dlstamp.cgi';
			}
			$date_stamp = sprintf("%04d/%02d/%02d %02d:%02d:%02d",$year,$mon,$day,$hour,$min,$sec);
			# 改行判定
			if ($form{'line'} eq 'br') {
				$date_stamp .= ' 改行ありでDL';
			}else{
				$date_stamp .= ' 改行なしでDL';
			}
			&mfp_SaveAddLine($dlstamp_path,$date_stamp);
		}
		else {
			print "Content-type: text/html; charset=UTF-8\n\n";
			print "file not found";
		}
	}
	else {
		print "Content-type: text/html; charset=UTF-8\n\n";
		print "mode not found";
	}
	
}
else {
	print "Location: index.cgi\n\n";
}
exit;