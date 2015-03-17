<?php
function Send_Contact($to, $from, $subject,$body)
{
require 'class.phpmailer.php';
$mail       = new PHPMailer();
$mail->IsSMTP(true);            // use SMTP
$mail->IsHTML(true);
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "tls://smtp.gmail.com"; // Amazon SES server, note "tls://" protocol
$mail->Port       =  465;                    // set the SMTP port
$mail->Username   = "sassyladies.csse@gmail.com";  // SMTP  username
$mail->Password   = "sassyladies";  // SMTP password
$mail->SetFrom($from, 'Question from user');
$mail->AddReplyTo($from,'Reply to user');
$mail->Subject    = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);
$mail->Send();   
}
?>
