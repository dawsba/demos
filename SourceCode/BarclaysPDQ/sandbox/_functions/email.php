<?PHP
  function send_email($title,$messagex)
  {
	$to = admin_email;
	$subject = $title;
	$headers = "From: EPDQ SERVER\r\n";
	$headers .= "Reply-To: NO-REPLY\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$message = '<html><body>';
	$message .= $messagex;
	$message .= '</body></html>';
	mail($to, $subject, $message, $headers);
	return;
  }
?>