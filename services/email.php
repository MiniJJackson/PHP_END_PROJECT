<?php
  require 'vendor/autoload.php';
  
  function sendEmail($subject,$content,$to) {
    $apikey = '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';
    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("fairlyprompts@gmail.com", "Fairly Prompts");
    $email->setSubject($subject);
    $email->addTo($to, "Fairly Prompts");
    $email->addContent("text/plain", $content);
    $email->addContent(
        "text/html", $content
    );
    $sendgrid = new \SendGrid($apikey);
    try {
        $sendgrid->send($email);
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
  }

  function randomString($length){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
  }
?>