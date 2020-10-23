<?php
ini_set('display_errors', 0);
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
include("includes/SiteSetting.php");

$dbObj->where("email_status", 0);
$order_details = $dbObj->get('tbl_email');
// echo "<pre>";
// print_r($order_details);

foreach ($order_details as $key => $value) {
	       $email_id= $value[emailaddress];
	       $ToMail = "rahul.nachare@ethinos.com";
            $Subject = 'Ethinos Digital Marketing : New lead';
            $Body = "<p><br>You have recieved a new lead.  Below are the details:</p>";
            $Body .= "<strong>Email Address</strong> : " . $email_id . "<br>";
            $Body .= "<br>";
            $Body .= "Thanks & Regards";
            $Body .= "<br>Ethinos Team";
            $mailObj = new PHPMailer;
	sendMail($mailObj, $ToMail, $Subject, $Body,$email_id); //call function
}



function sendMail($mailObj, $ToMail, $Subject, $Body)
{
	global $email_id,$dbObj;
     // $mailObj->SMTPDebug = 2;
    $mailObj->IsHTML(true); 
    $mailObj->Timeout = 30;
    $mailObj->isSMTP();
    $mail->SMTPAutoTLS = false;                                             // Set mailer to use SMTP
    $mailObj->Host = 'thetestsite.in';  // Specify main and backup SMTP servers
    $mailObj->SMTPAuth = true;                                  // Enable SMTP authentication
    $mailObj->Username = 'info@thetestsite.in';                     // SMTP username
    $mailObj->Password = 'Sameer@123';                               // SMTP password
    $mailObj->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mailObj->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );                               // Enable TLS encryption, `ssl` also accepted
    $mailObj->Port = 587;           // TCP port to connect to
    $mailObj->setFrom('info@thetestsite.in', 'Ethinos Digital Marketing');
    $mailObj->addAddress($ToMail);     // Add a recipient
   // $mailObj->addAddress('careers@anviti.in');
    
    // $mailObj->addBCC("sagar.more@ethinos.com");
    $mailObj->addBCC("siddharth.hundare@ethinos.com");
    $mailObj->addBCC("rahul.nachare@ethinos.com");
 
    // Set email format to HTML
    $mailObj->Subject = $Subject;
    $mailObj->Body = $Body;

    if (!$mailObj->send())
    {
        echo json_encode(array('status' => 'error'));
        exit;
    } else{
    	$dbObj->where("emailaddress",$email_id);
    	$dbObj->update('tbl_email',array("email_status"=>1));
        echo json_encode(array('status' => "success"));
    }
}
?>
