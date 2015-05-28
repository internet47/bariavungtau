###############################################################################
# Administrated Screen Users Editable Functions
###############################################################################

#$current_data_path = "${dir_datas}modules/$form{'m'}/$form{'m'}\.dat";
# メールフォーム設定
$current_data_path = "${dir_datas}modules/mailform_env/mailform_env\.dat";
@current_data = &loadfile($current_data_path);
@db_fields = ('flag','expires_start','expires_end','limit','serials','thanks_page','sendmail_path','logsave','cart_in_element','cart_logsave','send_mode','attached_mode','display_mode','logdata_path','cart_logdata_path','mailform_sender_address_name','mailform_sender_address','mail_method','thanks_message','title_mailform','title_confirm','title_error','title_thanks','spamcheck','mail_dustclear','mail_dustclear_zero','client_info','site_url','table_style','th_style','td_style','separate_before','separate_after','flag_afiri','afiri_tag','flag_smartphone_tpl','flag_futurephone_tpl','setlang');

# 項目の設定
$current_data_path2 = "${dir_datas}modules/elements/elements\.dat";
@current_data2 = &loadfile($current_data_path2);
@db_fields2 = ('elements_id','num','name','type_of_element','html_size','html_rows','html_cols','html_id','element_type','check_type','on_event','html_tag_free','text_min','text_max','enable_filetypes','filesize_min','filesize_max','checked_min','checked_max','element_valus','element_text','html_example','note','element_error_message','must_disp','default_value','system_disp_false','html_tag_free_top','elements_class');

# 自動返信
$current_data_path3 = "${dir_datas}modules/return_mail/return_mail\.dat";
@current_data3 = &loadfile($current_data_path3);
