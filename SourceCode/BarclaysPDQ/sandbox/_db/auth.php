<?PHP
  function check_auth()
  {
	$sql = "SELECT COUNT(*) FROM `".table_prefix."auth` WHERE `ip` = '".$_SERVER['REMOTE_ADDR']."' LIMIT 1";
    if(q($sql)<1)
    {
      q("INSERT INTO `".table_prefix."badauth` (`id`,`ip`,`date`) VALUES ('','".$_SERVER['REMOTE_ADDR']."','".date("YmdHis")."')");
	  send_email('FAILED AUTH','ACCESS ATTEMPT FROM '.$_SERVER['REMOTE_ADDR']);
	  $error=array();
	  $error['STATUS']='ERROR';
	  $error['DESC']='THE ATTEMPTED IP IS NOT IN THE AUTHENTICATED LIST('.$_SERVER['REMOTE_ADDR'].')';
	  output_xml($error);
    }
  }
?>