<?php 
if(strpos($_SERVER['HTTP_REFERER'],'slock') !== false) { 
    $to = "info@slock.it"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];
    $subject = "slock.it-request: ".$_POST['subject'];
    $subject2 = "Copy of your slock.it form submission";
    $message = $name . " ( $from ) wrote the following:" . "\n\n" . $_POST['txt'];
    $message2 = "Here is a copy of your message " . $name . "\n\n" . $_POST['txt'];

    $headers = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers); // sends a copy of the message to the sender
    
    
    
    $data = array("payload"=> json_encode(array(
                "text"          =>  "$subject\n$message",
                "icon_emoji"    =>  ":incoming_envelope:"
            )));
	
	
    $ch = curl_init("https://hooks.slack.com/services/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");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    if ($result=="Payload was not valid JSON") {
        mail("simon@jentzschfamily.net","mailer-error","send : $data   \n result: ".$result,$headers);
    }
        
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers); // sends a copy of the message to the sender
}
?>
