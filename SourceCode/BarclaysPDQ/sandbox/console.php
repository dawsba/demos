<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>EPDQ CONSOLE TEST</title>
</head>
<?
  if($_GET['submit']==1)
  {
	//echo "Running Script";
	$url = 'http://pandorasystems.net/barclays/sandbox/index.php';
	$fields_string = 'AMOUNT='.$_POST['amount'].'&CURRENCY='.$_POST['currency'].'&CARDNO='.$_POST['card'].'&ED='.$_POST['ed'].'&CVC='.$_POST['cvc'].'&OPERATION=SAL';
		
	//open connection
	$ch = curl_init();
	
	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url.'/?'.$fields_string);
	//curl_setopt($ch,CURLOPT_POST, count($fields));
	//curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	
	//execute post
	$result = curl_exec($ch);
	
	//close connection
	curl_close($ch);
  }
?>
<body>
  <table border="0">
    <tr>
      <td valign="top" width="500">
        <fieldset><legend>Submission Data</legend>
          <form action="?submit=1" enctype="multipart/form-data" method="post">
          <table>
            <tr>
              <td>Card Number</td><td><input name="card" type="text" placeholder="4111111111111111" value="4111111111111111"></td>
            </tr>
            <tr>
              <td>Expiry Date (mmyy)</td><td><input name="ed" type="text" placeholder="0517" value="0517"></td>
            </tr>
            <tr>
              <td>CVC</td><td><input type="text" name="cvc" placeholder="666" value="666"></td>
            </tr>
            <tr>
              <td>CURRENCY</td><td><input type="text" name="currency" placeholder="GBP" value="GBP" readonly></td>
            </tr>
            <tr>
              <td>AMOUNT (£)no decimal £100 = 10000</td><td><input name="amount" type="text" value="10000" placeholder="10000"></td>
            </tr>
            <tr>
              <td>&nbsp;</td><td><input type="submit" value="Submit"></td>
            </tr>
          </table>
          </form>
        </fieldset>
      </td>
      <td>
        <table>
          <tr>
            <td>
              <fieldset><legend>Transmit String</legend>
        		<? if(isset($fields_string)){echo $url.'/?'.$fields_string;}else{echo "<p>No Data</p>";} ?>
        	  </fieldset>
            </td>
          </tr>
          <tr>
            <td>
              <fieldset><legend>Raw Return</legend>
        		<? if(isset($result)){echo $result;}else{echo "<p>No Data</p>";} ?>
        	  </fieldset>
            </td>
          </tr>
          <tr>
            <td>
              <fieldset><legend>Tidy Return</legend>
                <? $xres = json_decode($result, true); ?>
                <? if(isset($result)){ ?><pre><?= var_dump($xres); ?></pre><? }else{echo "<p>No Data</p>";} ?>
              </fieldset>
            </td>
          </tr>
          <tr>
            <td>
              <fieldset><legend>Conclusion Return</legend>
                <? 
				  if(isset($result))
				  {
					if($xres['STATUS']==9)
					{
					  echo "Payment Processed";
					}
					else
					{
					  echo $xres['NCERROR']." -&- ".$xres['NCERRORPLUS'];
					}
			      }
				  else
				  {
					echo "<p>No Data</p>";
				  }
				?>
              </fieldset>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
