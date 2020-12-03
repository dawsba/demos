<?
  session_start();
  foreach($_POST as $k => $v){$posts .= posts."-- ".$k." <-> ".$v."\n";}
  foreach($_GET as $k => $v){$posts .= gets."-- ".$k." <-> ".$v."\n";}
  foreach($_REQUEST as $k => $v){$posts .= requests."-- ".$k." <-> ".$v."\n";}
  $ch = curl_init();
  $use_http = TRUE;
  if($use_http == TRUE){curl_setopt($ch, CURLOPT_URL, 'http://www.bulksms.co.uk/eapi/submission/send_sms/2/2.0');}
  else{curl_setopt($ch, CURLOPT_URL, 'http://www.bulksms.co.uk:5567/eapi/submission/send_sms/2/2.0');}
  curl_setopt ($ch, CURLOPT_POST, 1);
  $post_fields = 'username=*****&password=*****&message=Your message has been received please enter >> 55662 << in www.*****.com/online&msisdn='.$_POST['sender'].'';
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_fields);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $response_string = curl_exec($ch);
  curl_close($ch);
  $sender = TRUE;
  $filename = 'test.txt';$somecontent = $posts."\n SMS RESPONSE ->".$response_string;$handle = fopen($filename, "w");if(fwrite($handle, $somecontent) === FALSE){exit;}
  fclose($handle);
?>