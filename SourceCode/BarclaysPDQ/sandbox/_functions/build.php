<?PHP
  function build_fields()
  {
	$count=0;$v='';$k='';
	foreach($_GET as $k=>$v)
    {
	  $fields[strtoupper($k)]=$v;
	  $count++;
	  switch(strtoupper($k))
	  {
		case 'CARDNO':
		case 'CVC':
		case 'EMAIL':
		case 'CN':
		case 'OWNERTELNO':		
		  if(strlen($v)<=4&&forcepcenc)
		  {
			$v=PC1algo($v,'enc');
		  }
		  if(useenc)//encryption function
		  {
			$v=PC1algo($v);
		  } 
		  $fields[strtoupper($k)]=str_replace(' ','',str_replace('%20','',htmlspecialchars($v)));
		break;
	  }
    }
	if($count<=2)
	{
	  send_email('INSUFFICIENT VARIABLES','NOT ENOUGH VARIABLES TO BUILD REQUEST');
	  $error=array();
	  $error['STATUS']='ERROR';
	  $error['DESC']='INSUFFICIENT VARIABLES - NOT ENOUGH VARIABLES TO BUILD REQUEST';
	  output_xml($error);
	}
	return $fields;
  }
?>