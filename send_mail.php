<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_mail($email,$subject,$body){
    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    
    //Server settings
    //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'qnclaundry.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'laundry_notice@qnclaundry.com';        // SMTP username
    $mail->Password   = 'digitalnotice';                        // SMTP password
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 290;                                    // TCP port to connect to
    
    
    //Recipients
    $mail->setFrom('laundry_notice@qnclaundry.com', 'QnC Laundry');
    
    
    $mail->addAddress($email, 'Customer');     // Add a recipient
    
      // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    $mail->send();
    
}


    