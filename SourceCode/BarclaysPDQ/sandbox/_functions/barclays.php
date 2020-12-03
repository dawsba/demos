<?PHP
function EPDQDirect($fieldx)
{
  //parse_str($fields,$fieldx);

  $fields_string='';
  $SHASTR = '';
   
  $url = BCARD_URL;
  
  $OrderId = getOrderId();
  
  $fieldx['PSPID']=PSPID;
  $fieldx['USERID']=USERID;
  $fieldx['PSWD']=PSWD;
  $fieldx['ORDERID']=$OrderId;

  ksort($fieldx);
  
  $SECRETSIG = SHA1_PASSWORD;
  
  foreach($fieldx as $key=>$value)
  {
     if(strlen($value)>=1)
	 {
	   $fields_string .= $key.'='.$value.'&';
	   $SHASTR .= strtoupper($key).'='.$value.$SECRETSIG;
	 }else{unset($fieldx[$key]);}
  } 
  
  $fieldx['SHASIGN'] = sha1($SHASTR);
  $fields_string .= 'SHASIGN='.$fieldx['SHASIGN'];
  
  rtrim($fields_string, '&');
  
  //START COMMUNICATION
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, (count($fieldx)));
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);

  $xml = new SimpleXMLElement($result);
  $xml = (array) $xml;
  $xml = $xml['@attributes'];
  if(usexml)
  {    
	output_xml($xml);
  }
  if(usejson)
  {
    echo json_encode($xml);
  }
  curl_close($ch);

  //THIS IS WHERE DB COMES IN
  
  // EOF DB
  
  
}
?>