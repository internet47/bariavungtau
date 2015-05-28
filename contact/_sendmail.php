<?php
$sub =isset($_GET['submit'])?$_GET['submit']:""; //kiểm tra biến submit
if ($sub)
{
	require_once 'mail/lib/swift_required.php'; //đưa thư viện swiftmailer vào
	
	#################################################
		$host ="mail.freesale-vietnam.com" ;
		$port =25 ;
		$name_of_to = "Webmaster";
		$email_of_to = "viettq@freesale-vietnam.com" ;
		$user = "viettq@freesale-vietnam.com";
		$pass = "jAwKuAMKn02";
		
		if(empty($_GET['name']) || empty($_GET['email']) || empty($_GET['company']) || empty($_GET['type']) || empty($_GET['position']) ||empty($_GET['message']))
		{
		header("location:jp.baria-vungtau.gov.vn/contact/index.php");
		}
		
		//////////////////////////////////////////////////////////////////
		$name= isset($_GET['name'])?trim($_GET['name']):"";
		$email = isset($_GET['email'])?trim($_GET['email']):"";
		$company = isset($_GET['company'])?trim($_GET['company']):"";
		$address = isset($_GET['address'])?trim($_GET['address']):"";
		$url = isset($_GET['url'])?trim($_GET['url']):"";
		$fax = isset($_GET['fax'])?trim($_GET['fax']):"";
		$phone = isset($_GET['phone'])?trim($_GET['phone']):"";
		$type = isset($_GET['type'])?trim($_GET['type']):"";
		$position = isset($_GET['position'])?trim($_GET['position']):"";
		$longmessage = isset($_GET['message'])?trim($_GET['message']):"";
		$topic = $name.' - '.$company;
		
		//$body = $name.'-'. $email .'-'.$company.'-'. $address .'-'.$fax .'-'.$phone.'-'. $type .'-'.$position.'-'. $longmessage;
		$body = getTemplateHeader();
		$body .= getTemplate($name,$email,$company,$phone,$fax,$type,$position,$longmessage, $address, $url);
		$body .= getTemplateFooter();
			
	
	if (empty($email) || empty($name) || empty($type) || empty($company) || empty($body) || empty($position))
		{
		echo "<script>alert ('Please, check again'); window.history.back(-1);</script>";
		die();
		}
	
		
		#################################################
			$transport = Swift_SmtpTransport::newInstance($host, $port);
			$transport->setUsername($user);
			$transport->setPassword($pass);
			
			// Create the message
			$message = Swift_Message::newInstance();
			$message->setTo(array($email_of_to => $name_of_to));
			
			$message->setSubject($topic);
			
			$message->setBody($body);
			$message->setBody($body, 'text/html');
			
			$message->setFrom($email, $name);
			
			// Send the email
			$mailer = Swift_Mailer::newInstance($transport);
			if ($mailer->send($message, $failedRecipients))
			{
				echo "<script>alert ('Send success'); window.history.back(-1);</script>";
			}
			else
			{
			// Show failed recipients
			print_r($failedRecipients);//in ra danh sách người gởi bị lỗi
			echo "<script>alert ('Send false. Please, check connection or email'); window.history.back(-1);</script>";
			}
	}
		else
		{
			echo "<script> window.history.back(-1);</script>";
		}
		
		
		
//////////////////////////ĐỊNH DẠNG CẤU TRÚC MAIL NHẬN //////////////////////////////////////////////////////		
		
function getTemplateHeader(){
$str = <<<EOF
	<style type="text/css">
    body {
        font-family: Arial, Helvetica, sans-serif; font-size: 16px}
        
    table
    {
    width: auto	;
	clear:both;
	float:left;
	margin: 10px 5px 5px 5px;
    }
    
    table td
    {
        border-bottom: 1px solid #000;
		text-align:left;
		vertical-align:middle;
        height: 22px;
    }
    
    </style>
    <table width="700" border="0" align="left" cellpadding="0" cellspacing=0" bgcolor="#FFFFFF">
                    <thead>
                        <tr>
                            <th width="111"></th>
                        </tr>
                    </thead>
                    <tbody>
EOF;
	return $str;

}

function getTemplateFooter(){
$str = <<<EOF
	            </tbody>
                </table>
EOF;
	return $str;
}


function getTemplate($a,$b,$c,$d,$e,$f,$g,$h,$k,$l){
$str = <<<EOF
                        <tr>
                            <td height="50" bgcolor="#CEE6FF">[お名前]</td>
                            <td width="428"> $a </td>
                        </tr>
                        <tr>
                            <td height="50" bgcolor="#CEE6FF">[メールアドレス]</td>
                          <td> $b </td>
                        </tr>
                        <tr>
                            <td height="50" bgcolor="#CEE6FF">[会社名]</td>
                          <td> $c </td>
                        </tr>
                        <tr>
						<tr>
                            <td height="50" bgcolor="#CEE6FF">[住所]</td>
                          <td> $k </td>
                        </tr>
                        <tr>
                            <td height="50" bgcolor="#CEE6FF">[電話番号]</td>
                          <td> $d </td>
                        </tr>
						 <tr>
                            <td height="50" bgcolor="#CEE6FF">[FAX番号]</td>
                          <td> $e </td>
                        </tr>
						 <tr>
                            <td height="50" bgcolor="#CEE6FF">[会社のURL]</td>
                          <td> $l </td>
                        </tr>
						 <tr>
                            <td height="50" bgcolor="#CEE6FF">[業種]</td>
                          <td> $f </td>
                        </tr>
						<tr>
                            <td height="50" bgcolor="#CEE6FF">[役職]</td>
                          <td> $g </td>
                        </tr>
						<tr>
                            <td height="50" bgcolor="#CEE6FF">[内容]</td>
                          <td> $h </td>
                        </tr>
						<tr>
                          <td style="border:none" colspan="2"></td>
                        </tr>
EOF;
		return $str;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		
?>