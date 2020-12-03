<?PHP
  function PC1algo($str,$flag='dec',$salt=encsalt)
  {
	$data = new PC1;
	switch($flag)
	{
	  case 'dec':
	    return $data->decrypt($str,$salt);
	  break;
	  case 'enc':
		return $data->encrypt($str,$salt);
	  break;
	  default:
	    return $data->decrypt($str,$salt);
	}
  }
?>