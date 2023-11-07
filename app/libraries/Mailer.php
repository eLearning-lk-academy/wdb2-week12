<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer{

    private $mailer;
    private $to = [];
    private $subject;
    private $message;

    public function __construct(){
        
        require __DIR__."/../../config/config.php";

        $mailer = new PHPMailer(true);
        $mailer->isSMTP();
        $mailer->Host       = $smtp['host'];
        $mailer->SMTPAuth   = true;
        $mailer->Username   = $smtp['username'];
        $mailer->Password   = $smtp['password'];
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mailer->Port       = $smtp['port'];

        $mailer->setFrom($email['fromAddress'], $email['fromName']);
        $mailer->isHtml(true);

        $this->mailer = $mailer;

    }


    public function to($email, $name = null){
        $this->to[] =[$email, $name];
    }

    public function subject($subject){
        $this->subject = $subject;
    }

    public function message($message){
        $this->message = $message;
    }

    public function send(){
        foreach($this->to as $recipient){
            $this->mailer->addAddress($recipient[0], $recipient[1]);
        }

        $this->mailer->Subject = $this->subject;
        $this->mailer->Body = $this->message;
        return $this->mailer->send();
    }

}