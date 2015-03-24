<?php

$to = 'pam.griffith@sri.com,haloedrain@hotmail.com,pamgriffith@gmail.com,pam.griffith@rocketmail.com';
$subject = 'Test HTML email' ;
$body = '';

$headers = 'From: pam@pamgriffith.net' . "\r\n" ;
$headers .='Reply-To: '. $to . "\r\n" ;
$headers .='X-Mailer: PHP/' . phpversion();
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";   
if(mail($to, $subject, $body,$headers)) {
	echo('<br>'."Email Sent".'</br>');
} 
else {
	echo("<p>Email Message delivery failed...</p>");
}
?>