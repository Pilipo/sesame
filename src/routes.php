<?php

use Slim\Http\Request;
use Slim\Http\Response;
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\PinInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// Routes


$app->get('/status', function (Request $req, Response $res, array $arg) {
    $this->logger->info("Slim-Skeleton '/' route");

    // Check for listening services
    

    $data = array('status' => "Populate this with door or system status.");
    $res = $res->withJson($data);
    return $res;
});

$app->get('/command/open', function (Request $req, Response $res, array $arg) {
    $this->logger->info("Slim-Skeleton '/' route");

    $gpio = new GPIO();
    $pin = $gpio->getOutputPin(18);
    $pin->setValue(PinInterface::VALUE_HIGH);

    $status = "Populate this with door OPEN action confirmation and success or failure.";    

    $data = array(
        'status' => $status,
        'action' => "OPEN"
    );

    sendMail($status);
    $res = $res->withJson($data);
    return $res;
});

$app->get('/command/close', function (Request $req, Response $res, array $arg) {
    $this->logger->info("Slim-Skeleton '/' route");

    $status = "Populate this with door CLOSE action confirmation and success or failure.";

    $data = array(
        'status' => $status,
        'action' => "CLOSE"
    );

    sendMail($status);
    $res = $res->withJson($data);
    return $res;
});

function sendMail($message) {
    $mail = new PHPMailer(true);

    //Setup
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = getenv('EMAIL_USER');               // SMTP username
    $mail->Password = getenv('EMAIL_PASS');               // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom(getenv('EMAIL_USER'), 'server-name');
    $mail->addAddress(getenv('EMAIL_TO'), 'recipient name');     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = '<p>This is more detail:</p>';
    $mail->Body     .= '<p>' . $message . '</p>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //Send it!
    return $mail->send();
}