<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
 use SMTPValidateEmail\Validator as SmtpEmailValidator;
class Functions{

	static public function No_s($str){
		$n_s=strlen($str);$last=substr($str, ($n_s-1));
		if ($last=="s"||$last=="S") {$str= substr($str, 0, -1);}
		return $str;}
	static public function nav_list($x, $y, $z){
		$z= array();
		foreach ($x as $key => $value) {
 			if ($value[$y]!=null||$value[$y]!="") {
 			  array_push($z, $value[$y]);}}
 		return $z;}	
 	static public function aias($fil_, $fil, $list, $parameter_, $parameter, $case ){
		 $list_=$list;
		 $aia=array();
		 $faof=[];
		 $indx=0;
		 	for ($i=0; $i <count($list) ; $i++) {
		 		 if ($case!=null||$case!="") {
		 			if ($list[$i][$parameter_]!=$fil_||$list[$i][$parameter]!=$fil) {
		 			unset($list_[$i]);}
		 		}else{
		 			if ($list[$i][$parameter_]!=$fil_) {
		 			unset($list_[$i]);}
		 		}
		 	} 
		 	foreach ($list_ as $key => $value) {
			 	if (count($aia)<12) {
		 		 		array_push($aia, $value);  
		 		 	}else{
						$faof[$indx]= $aia;
						$indx++;	
						$aia=array();
						array_push($aia, $value); 
		 		 	}
			}
			if (count($aia)!=0) {
				 $faof[$indx]= $aia;
			}return $faof;}	
 
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
					<b style="color:#999">Tu còdigo para reestablecer tu contraseña es:</b>'.$code.'</div>
					<a href="'.$url.'" target="_blank" style="text-decoration:none"><div style= "line-height: 60px; background:#0aa; width:60%; color:white">'.$do.'</div>
					</a>'; 
 		}else{
 			$addhtml='
					<a href="'.$url.$verification.'/'.$code.'" target="_blank" style="text-decoration:none"><div style= "line-height: 60px; background:#0aa; width:60%; color:white">'.$do.'</div>
					</a>'; 

 		}

			try {  
				$mail->CharSet = 'UTF-8';
			    //Server settings
			  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			    $mail->isSMTP();                                            //Send using SMTP
			    $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
			    $mail->SMTPAuth   = true;                                          //SMTP password
			    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS ;   
			           //Enable implicit TLS encryptionENCRYPTION_SMTPS; 
			    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			    //Recipients 
			    $mail->addAddress($addrees, $nameto);     //Add a recipient 
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

	static public function email_validator($data){
				$email     = $data;
				$sender    = 'mtest_alez@hotmail.com';
				$validator = new SmtpEmailValidator($email, $sender);

				// If debug mode is turned on, logged data is printed as it happens:
				 $validator->debug = true;
				$results   = $validator->validate();

		 

				// Get log data (log data is always collected)
				$log = $validator->getLog();
				 
				return $results;
	}




static public function smtp_validate($email){
var_dump($email);
   $result=false;
   list($name, $domain)=explode('@',$email);
   # SMTP QUERY CHECK
   $max_conn_time = 30;
   $sock='';
   $port = 25;
   $max_read_time = 5;
   $users=$name;
   # retrieve SMTP Server via MX query on domain
   $hosts = array();
   $mxweights = array();
   getmxrr($domain, $hosts, $mxweights);
   $mxs = array_combine($hosts, $mxweights);
   asort($mxs, SORT_NUMERIC);
   #last fallback is the original domain
   $mxs[$domain] = 100;
   $timeout = $max_conn_time / count($mxs);
   # try each host
/*   while(list($host) = each($mxs)) {
      #connect to SMTP server

    }
*/


foreach ($mxs as $key => $value) {
	while (list($host)=$value) {
		      if($sock = fsockopen($host, $port, $errno, $errstr, (float) $timeout)){
         stream_set_timeout($sock, $max_read_time);
         break;
      }
	}
}



 # did we get a TCP socket
 if($sock) {
	 $reply = fread($sock, 2082);
      preg_match('/^([0-9]{3}) /ims', $reply, $matches);
      $code = isset($matches[1]) ? $matches[1] : '';
      if($code != '220') {
         # MTA gave an error...
         return $result;
      }
      # initiate smtp conversation
      $msg="HELO ".$domain;
      fwrite($sock, $msg."\r\n");
      $reply = fread($sock, 2082);
      # tell of sender
      $msg="MAIL FROM: <".$name.'@'.$domain.">";
      fwrite($sock, $msg."\r\n");
      $reply = fread($sock, 2082);
      #ask of recepient
      $msg="RCPT TO: <".$name.'@'.$domain.">";
      fwrite($sock, $msg."\r\n");
      $reply = fread($sock, 2082);
      #get code and msg from response
      preg_match('/^([0-9]{3}) /ims', $reply, $matches);
      $code = isset($matches[1]) ? $matches[1] : '';
      if($code == '250'){
        #you received 250 so the email address was accepted
         $result=true;
      }elseif($code == '451' || $code == '452') {
        #you received 451 so the email address was greylisted
         #or some temporary error occured on the MTA) - so assume is ok
         $result=true;
      }else{
         $result=false;
      }
      #quit smtp connection
      $msg="quit";
      fwrite($sock, $msg."\r\n");
      # close socket
      fclose($sock);
  }
   return $code;
}




}
