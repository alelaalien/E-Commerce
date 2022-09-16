<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once "connection.php";

 
 
class User_m{

		static public function m_register($table, $data){
			$s=Connection::connect()->prepare("INSERT INTO $table (name, pass, email, login, verification, c_email) VALUES
				(:name, :pass, :email, :login, :verification, :c_email)");
			$s->bindParam(":name", $data["name"], PDO::PARAM_STR);
			$s->bindParam(":pass", $data["pass"], PDO::PARAM_STR);
			$s->bindParam(":email", $data["email"], PDO::PARAM_STR);
			$s->bindParam(":login", $data["login"], PDO::PARAM_STR);
			$s->bindParam(":verification", $data["verification"], PDO::PARAM_STR);
			$s->bindParam(":c_email", $data["c_email"], PDO::PARAM_STR);
		//	"ale z", "a@mail.com", "123", "direct", 1 

		if($s->execute()){

			return "done";

		}else{

			return "error";
		
		}
			$s->close();
			$s=null;
		} 

	static public function m_read($table, $item, $value, $option){
		if ($option==1) {
			$s=Connection::connect()->prepare("SELECT * FROM $table WHERE $item=:$item");
			 
			$s->bindParam(":".$item, $value, PDO::PARAM_STR);
			$s->execute();

			return $s->fetch();			
		}else{
			$s=Connection::connect()->prepare("SELECT  id,name,email,login,pic,verification FROM  $table WHERE $item=:$item");
			     
			$s->bindParam(":".$item, $value, PDO::PARAM_STR);
			$s->execute();
			return $s->fetch();	
		}

		$s->close();
		$s=null;
	}
	static public function m_update($table, $id, $item, $value){
		$s=Connection::connect()->prepare("UPDATE $table SET $item=:$item WHERE id=:id");
		$s->bindParam(":".$item, $value, PDO::PARAM_STR);
		$s->bindParam(":id", $id, PDO::PARAM_STR);
		if ($s->execute() ) {
			return "ok";
		}else{
			return "error";
		}
		$s->close();
		$s=null;
	}	
	static public function mail($data, $code){
			 $mail = new PHPMailer(true);

			try {
			    //Server settings
			    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			    $mail->isSMTP();                                            //Send using SMTP
			    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
			    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			    $mail->Username   = 'user@example.com';                     //SMTP username
			    $mail->Password   = 'secret';                               //SMTP password
			    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			    //Recipients
			    $mail->setFrom('from@example.com', 'Mailer');
			    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
			    $mail->addAddress('ellen@example.com');               //Name is optional
			    $mail->addReplyTo('info@example.com', 'Information');
			    $mail->addCC('cc@example.com');
			    $mail->addBCC('bcc@example.com');

			    //Attachments
			    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			    //Content
			    $mail->isHTML(true);                                  //Set email format to HTML
			    $mail->Subject = 'Here is the subject';
			    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			    $mail->send();
			    echo 'Message has been sent';
			} catch (Exception $e) {
			    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
	}
}
/**/