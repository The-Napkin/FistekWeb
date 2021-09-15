<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/Exception.php';
require_once __DIR__ . '/PhpMailer.php';
require_once __DIR__ . '/SMTP.php';
 $path = 'data.pps';
 $stringa = $_POST['karma'];
 $variable = fopen('data.pps',"r");
 $content = stream_get_contents($variable);
 $space = '';
 error_reporting(0);
ini_set('display_errors', 0);



if (isset($_POST['karma']) && !(stristr($content,$stringa))){ 
    if (($stringa == $space) || ($stringa == null)){
        echo '<span style="color:#ff0066;text-align:center;"><b>Do not leave this field emty.</b></span>';
        die();
        }
    else{
        $mail = new PHPMailer(true);
        
        // $mail->SMTPDebug = 3;                               // Enable verbose debug output
        
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'fistek.studios@gmail.com';                 // SMTP username
        $mail->Password = 'Standardcylinder94hard';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        
        $mail->From = 'fistek.studios@gmail.com';
        $mail->FromName = 'FistekMail';
            //$mail->addAddress('dev@fistekstudios.eu', 'DevTeam');     // Add a recipient
        $mail->addAddress("$stringa");               // Name is optional
        $mail->addReplyTo('timotej@fistekstudios.eu', 'Timotej');
        
        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Subject = 'Newsletter subscribed!';
        $mail->Body    = "You have succesfully subscribed to our <b>Project_T</b> newsletter!";
        $mail->AltBody = "You have succesfully subscribed to our Project_T newsletter!";
        $mail->send();

        $fh = fopen($path,"a+");
        $string = $_POST['karma']  . PHP_EOL;
        fwrite($fh,$string); // Write information to the file
        fclose($fh); // Close the file
        echo '<span style="color:#AFA;text-align:center;"><b>You have successfully subscribed to updates/newsletter!</b></span>';
         }
        }
else{
        echo '<span style="color:#ff0066;text-align:center;"><b>You are already subscribed to updates/newsletter!</b></span>';
    
   }

?>