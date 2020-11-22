<?php
/**
 * Description of Mailgun
 *
 * @author danielbazan
 */

require_once dirname(dirname(dirname(__FILE__))).'/vendor/autoload.php';

class Mailgun {
    private $mail;
    
    public function __construct(array $settings) {
        $this->mail = new PHPMailer;
        $this->mail->isSMTP();  // Set mailer to use SMTP
        //$this->mail->Host = 'smtp.mailgun.org';  // Specify mailgun SMTP servers
        $this->mail->Host = $settings['host'];  // Specify mailgun SMTP servers
        $this->mail->SMTPAuth = true; // Enable SMTP authentication
        //$this->mail->Username = 'postmaster@sandboxeefff71147a749958e9903ae9fa13d61.mailgun.org'; // SMTP username from https://mailgun.com/cp/domains
        $this->mail->Username = $settings['username']; // SMTP username from https://mailgun.com/cp/domains
        //$this->mail->Password = '50b031ec828f857c5c6e493b369b0d7e-39bc661a-4dcc3c3f'; // SMTP password from https://mailgun.com/cp/domains
        $this->mail->Password = $settings['password']; // SMTP password from https://mailgun.com/cp/domains
        $this->mail->SMTPSecure = 'tls';   // Enable encryption, 'ssl'
        $this->mail->CharSet = 'UTF-8';
    }
    
    public function send_mail($from, $fromname, $to, $toName, $subject, $body, $AltBody) {
        $this->mail->From = $from; // The FROM field, the address sending the email 
        $this->mail->FromName = $fromname; // The NAME field which will be displayed on arrival by the email client
        $this->mail->addAddress($to, $toName);     // Recipient's email address and optionally a name to identify him
        $this->mail->isHTML(true);   // Set email to be sent as HTML, if you are planning on sending plain text email just set it to false
        // The following is self explanatory
        $this->mail->Subject = $subject;
        $this->mail->Body    = $body;
        $this->mail->AltBody = $AltBody;
        if(!$this->mail->send()) {  
            return $this->mail->ErrorInfo;
        } else {
            return true;
        }

    }
    
    
    
}
