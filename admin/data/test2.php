<?php

$xml = simplexml_load_file('syslog.xml');
foreach($xml->List as $list){
	
//	unset($list->admin->user);
//	unset($list->admin->login);
//	unset($list->admin->logout);
//	unset($list->admin->content);
//	unset($list->admin->ip);
	unset($list->admin);
	
}
echo $xml->asXML(); 


?>