<? session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SMS Message API</title>
</head>
<style>
#loginbox{width:450px;height:200px;border:1px solid #000099;margin-top:220px;margin-left:auto;margin-right:auto;}
#loginbox h1{color:#0000CC; text-align:center;}
#loginbox input{width:150px;border:1px solid black;}
#loginbox .button{width:50px;}
#loginbox .cent{text-align:center; margin-left:auto; margin-right:auto;}
#mainbox{width:750px;height:650px;border:1px solid #000099;margin-top:150px;margin-left:auto;margin-right:auto; overflow:auto;padding-left:20px;}
#mainbox h1{color:#0000CC; text-align:center;}
#mainbox input{width:150px;border:1px solid black;}
#mainbox textarea{width:300px; height:170px; border:1px solid black; overflow:auto;}
#mainbox .button{width:50px;}
</style>
<body>

<?php
if(isset($loginset))
{
  $_SESSION[userdetails] = 'active';
  $_SESSION[username] = $_POST['username'];
  $_SESSION[password] = $_POST['password'];
  foreach($_POST as $k=>$v){unset($$k);}
}
if(!isset($_SESSION[userdetails]))
{
?>
  <div id="loginbox"><h1>Surma News Message System</h1>
  <form action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
    <table class="cent">
	  <tr><td>Username</td><td>:</td><td><input type="text" name="username" /></td></tr>
	  <tr><td>Password</td><td>:</td><td><input type="password" name="password" /></td></tr>
	  <tr><td colspan="3"><input class="button" type="submit" name="loginset" value="Submit" /></td></tr>
	</table>
  </form>
 <p class="cent"><small>System built on bulksms api systems, plese use your bulksms login details to access.</small></p>
  </div>
<?
}
else
{
?>
<div id="mainbox">
<h1>Surma News Message System <small style="color:#0033FF; font-size:14px;">Logged in as <?= $_SESSION[username]; ?></small></h1>
<h3 class="cent" align="center">Credits available - 
  <? 
	$test = FALSE;
	$use_http = TRUE;
	if($test == FALSE)
	{
	  $ch = curl_init();
      if($use_http == TRUE){curl_setopt($ch, CURLOPT_URL, 'http://www.bulksms.co.uk/eapi/user/get_credits/1/1.1');}
	  else{curl_setopt($ch, CURLOPT_URL, 'http://www.bulksms.co.uk:5567/eapi/user/get_credits/1/1.1');}
      curl_setopt ($ch, CURLOPT_POST, 1);
      $post_fields = 'username='.$_SESSION[username].'&password='.$_SESSION[password].'';
      curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_fields);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response_string = curl_exec($ch);
      curl_close($ch);
      print $response_string."\n";
	}
  ?>
</h3>
<?
if(isset($_GET['logout'])){session_destroy();echo "<script>window.location='index.php'</script>";}
function addplus($message)
{
  $message = trim($message);
  $pattern = array(' ');
  $replacement = array('+');
  for ($i=0; $i<sizeof($pattern); $i++) {
    $str = mb_ereg_replace($pattern[$i], $replacement[$i], $message);
  }
  return $str;
}
function stripws($txt)
{
  $txt = trim($txt);
  $pattern = array(' ');
  $replacement = array('');
  for ($i=0; $i<sizeof($pattern); $i++) {
    $str = mb_ereg_replace($pattern[$i], $replacement[$i], $txt);
  }
  return $str;
}
function checknum($numbers)
{
  $i = 0;
  $numbers = stripws($numbers);
  if(substr($numbers,-1) != ','){$numbers = trim($numbers).",";}
  $nums2 = split(',',$numbers);
  foreach($nums2 as $k=>$v)
  {
    $v=trim($v);
	if(strlen($v) == 11)
	{
	  if($i === 0)
	  {
	    $nums .= '44'.substr($v,1);
		$i=3;
	  }
	  else
	  {
	    $nums .= ',44'.substr($v,1);
	  }
	}
  }
  return $nums;
}
$un = $_SESSION[username]; //'surmanewsgroup';
$pw = $_SESSION[password]; //'redmate';
//foreach($_POST as $k=>$v){echo $k."--".$v."<BR>";}
?>
<script language="javascript" type="text/javascript">
function count(txt)
{
  //alert(txt);
  var a;
  var b;
  b = txt.length*1;
  if(b > 160){alert("maximum text length reached");document.getElementById('messbox').value = document.getElementById('oldval').value;}else{a = 160-b; document.getElementById('lefto').value = a;document.getElementById('oldval').value=txt;}
}
</script>
<form action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
<?
if(isset($cancel)){unset($sender);}
if(isset($sender))
{
  $message = addplus($message);
  $phonenumbers = checknum($recbox);
  if(isset($un) && isset($pw) && isset($message) && isset($phonenumbers))
  {
    $test = FALSE;
	$use_http = TRUE;
	$get_quote = FALSE;
	if($get_quote == TRUE && !isset($_SESSION[store]) && !isset($confirm))
	{
	  $ch = curl_init();
      if($use_http == TRUE){curl_setopt($ch, CURLOPT_URL, 'http://www.bulksms.co.uk/eapi/submission/quote_sms/2/2.0');}
	  else{curl_setopt($ch, CURLOPT_URL, 'http://www.bulksms.co.uk:5567/eapi/submission/quote_sms/2/2.0');}
      curl_setopt ($ch, CURLOPT_POST, 1);
      $post_fields = 'username='.$un.'&password='.$pw.'&message='.$message.'&msisdn='.$phonenumbers.'';
      curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_fields);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response_string = curl_exec($ch);
      curl_close($ch);
      $return2 = $response_string.'/n';
	  $return2 = strtok(trim(strip_tags($return2)),'|');
	  $return[Code]=$return2[0];
	  $return[Type]=$return2[1];
	  $return[Amount]=$return2[3];unset($return2);
	  $_SESSION[store][smsmessage]=$message;
	  $_SESSION[store][msidn]=$phonenumbers;
	  
	}
	else
	{
	  if($test == FALSE)
	  {
	    if($get_quote == FALSE){$_SESSION[store][smsmessage]=$message;$_SESSION[store][msidn]=$phonenumbers;}
		$ch = curl_init();
        if($use_http == TRUE){curl_setopt($ch, CURLOPT_URL, 'http://www.bulksms.co.uk/eapi/submission/send_sms/2/2.0');}
	    else{curl_setopt($ch, CURLOPT_URL, 'http://www.bulksms.co.uk:5567/eapi/submission/quote/2/2.0');}//send_sms
        curl_setopt ($ch, CURLOPT_POST, 1);
        $post_fields = 'username='.$un.'&password='.$pw.'&sender='.$Sender_ID.'&message='.$_SESSION[store][smsmessage].'&msisdn='.$_SESSION[store][msidn];
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_string = curl_exec($ch);
        curl_close($ch);
        print $response_string."\n";
		$sender = TRUE;
		echo "<p><a href=\"".$_SERVER['PHP_SELF']."\">Send anouther message</a></p";
	  }
	  else
	  {
	    echo $message." -- ".$phonenumbers;
	  }
	  unset($_SESSION[store]);
	}
  }
  else
  {
    echo "<h1 style='color:red;'>SYSTEM ERROR</h1>";
  }
}
if(!isset($sender)){
?>
<table>
  <tr>
    <td valign="top" align="right">Message</td>
	<td><textarea name="message" id="messbox" cols="40" rows="10" onkeyup="count(this.value)"></textarea><input type="hidden" id="oldval" /></td>
  </tr>
  <tr>
    <td align="right">Available characters</td>
	<td><input type="text" id="lefto" value="160" /></td>
  </tr>
  <tr>
    <td colspan="1" align="right">Sender ID</td><td><select name="Sender_ID"><option value="" selected="selected">none</option><option value="MET+Police">MET Police</option><option value="Neighbourhood+Watch">SNeighbourhood Watch</option><option value="British+Muslims">British Muslims</option><option value="Shurma News">Shurma News</option><option value="Metro News">Metro News</option><option value="E11BID">E11BID</option><option value="LBWF+PROC">LBWF PROC</option></select></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" width="50%" align="justify">Recipients <small>each number on new line followed by a comma</small><p>eg:<br />01256 556 486,<br />01253 868091,</p><hr /><p style="font-size:12px;">Remember to use the full number with the (0)(zero) in front not +44 or 44 the phone number must be 11 characters long!</p></td>
	<td><textarea name="recbox" id="recboxy" cols="40" rows="10"></textarea></td>
  </tr>
  <tr>
    <td>
	  <p>&nbsp;</p>
	</td>
	<td>
	  <input type="submit" id="sub" name="sender" value="Confirm & Send" />
	</td>
  </tr>	
</table>
<? }else{if(isset($_SESSION[store]) && $get_quote==TRUE){ ?>
<table>
  <tr>
    <td>
      <h1>Confirm SMS Quote</h1>
	  <? echo "<pre>";print_r($return);echo "</pre>";
	  echo "memememe";foreach($return as $k => $v){echo "<p>$k -- $v</p>";} ?>
      <table><tr><td><input type="submit" name="confirm" value="Confirm" /></td><td><input type="submit" name="cancel" value="Cancel" /></td></tr></table>
    </td>
  </tr>
</table>
<input type="hidden" name="sender" value="hidden" />
<? } ?>
</form>  
<p>Log out click here &raquo;&raquo;&raquo; <a href="?logout=logout">LOGOUT</a> </p>   
<?
}
}
?>
</div>
</body>
</html>