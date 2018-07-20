<?php
function sendmail($emailRecipient,$nameRecipient,$subject,$content){

require_once 'src/PHPMailer.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions (debug loi)
try {
    //Server settings
    $mail->charSet ="UTF-8";
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output (xuat ra file thong bao loi)
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ag500118.chung@gmail.com';                 // SMTP username email dung de goi mail
    $mail->Password = '273150757';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ag500118.chung@gmail.com', 'Mailer');
    $mail->addAddress($emailRecipient, $nameRecipient);     // Add a recipient
    //$mail->addAddress('chungnh@vpi.pvn.vn');               // Name is optional
    $mail->addReplyTo('ag500118.chung@gmail.com', $subject);
    $mail->addCC('ag500118.chung@gmail.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $content;
    //$mail->AltBody = 'chào bạn';

    $mail->send();
   return true;
} catch (Exception $e) {
   return false;
}
}