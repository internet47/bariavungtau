###############################################################################
# Administrated Screen Users Editable Functions
###############################################################################

$current_data_path = "${dir_datas}modules/$form{'m'}/$form{'m'}\.dat";
@current_data = &loadfile($current_data_path);
@db_fields = ('flag','expires_start','expires_end','limit','serials','thanks_page','sendmail_path','logsave','cart_in_element','cart_logsave','send_mode','attached_mode','display_mode','logdata_path','cart_logdata_path','mailform_sender_address_name','mailform_sender_address','mail_method','thanks_message','title_mailform','title_confirm','title_error','title_thanks','spamcheck','mail_dustclear','mail_dustclear_zero','client_info','site_url','table_style','th_style','td_style','separate_before','separate_after','flag_afiri','afiri_tag','flag_smartphone_tpl','flag_futurephone_tpl','setlang');
