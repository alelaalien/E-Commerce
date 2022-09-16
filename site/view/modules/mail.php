<?php 
 use SMTPValidateEmail\Validator as SmtpEmailValidator;

class Mail{
	static public function validator($data){
		$email     = $data;
				$sender    = 'mtest_alez@hotmail.com';
				$validator = new SmtpEmailValidator($email, $sender);

				// If debug mode is turned on, logged data is printed as it happens:
				 $validator->debug = true;
				$results   = $validator->validate();

				var_dump($results);

				// Get log data (log data is always collected)
				$log = $validator->getLog();
				var_dump($log);
				return $results;
	}
	static public function mail_service($data){

		$mail = new  PHPMailer(true);
	  	 
		$addrees=$data["address"];
		$nameto=$data["nameto"];
		$subjet=$data["subjet"];
		$logo=$data["logo"];
		$icon=$data["icon"];
		$txt=$data["txt"];
		$txt2=$data["txt2"];
		$title=$data["title"];
		$url=$data["url"];
		$code=$data["code"];
		$typeof=$data["typeof"];
		$addhtml="";
		$do=$data["do"];
		$verification="verification";
 		  
//<div style="margin-bottom: 14px;"></div>
 		if ($typeof=="resetpass") {
 			$addhtml='<div style="margin-bottom: 14px;">
					<b style="color:#999">Tu nueva contraseña es:</b>'.$code.'</div>
					<a href="'.$url.'" target="_blank" style="text-decoration:none"><div style= "line-height: 60px; background:#0aa; width:60%; color:white">'.$do.'</div>
					</a>'; 
 		}else{
 			$addhtml='
					<a href="'.$url.$code.'" target="_blank" style="text-decoration:none"><div style= "line-height: 60px; background:#0aa; width:60%; color:white">'.$do.'</div>
					</a>'; 

 		}

			try {  
				$mail->CharSet = 'UTF-8';
			    //Server settings
			   $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			    $mail->isSMTP();                                            //Send using SMTP
			    $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
			    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			    $mail->Username   = 'mtest_alez@hotmail.com';                     //SMTP username
			    $mail->Password   = '34421752az';                               //SMTP password
			    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS ;   
			           //Enable implicit TLS encryptionENCRYPTION_SMTPS; 
			    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			    //Recipients
			    $mail->setFrom('mtest_alez@hotmail.com', 'Ale');
			    $mail->addAddress($addrees, $nameto);     //Add a recipient
			             //Name is optionalalelaalien@outlook.com
			   // $mail->addReplyTo('info@example.com', 'Information');

			/*
			    //Attachments
			    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name*/

			    //Content
			    $mail->isHTML(true);                                  //Set email format to HTML
			    $mail->Subject = $subjet;
			    $mail->Body    = '<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
						
						<center>
							
							<img style="padding:20px; width:10%" src="http://localhost/proyectos/eccomerce/'.$logo.'">

						</center>

						<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
						
							<center>
							
							<img style="padding:20px; width:15%" src="'.$icon.'">

							<h3 style="font-weight:100; color:#999">'.$title.'</h3>

							<hr style="border:1px solid #ccc; width:80%">

							<h4 style="font-weight:100; color:#999; padding:0 20px">'.$txt.'</h4>

							'.$addhtml.'					

							<br>

							<hr style="border:1px solid #ccc; width:80%">

							<h5 style="font-weight:100; color:#999">'.$txt2.'</h5>

							</center>

						</div>

								</div>';
			   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			    $mail->send();
			    
			    return "ok";
			} catch (Exception $e) {
			    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			    return "error : {$mail->ErrorInfo}";
			}


}	
}

