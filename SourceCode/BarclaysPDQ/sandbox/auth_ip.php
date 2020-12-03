<?PHP
  require_once('_config/config.php');
  require_once('_db/db.con.php');
  if(q("SELECT COUNT(*) FROM `".table_prefix."auth` WHERE `ip` = '".$_SERVER['REMOTE_ADDR']."' LIMIT 1")<=0)
  {
    if(q("INSERT INTO `".table_prefix."auth` (`id`,`ip`) VALUES ('','".$_SERVER['REMOTE_ADDR']."'); ")){echo "IP UNLOCKED";}else{echo "ERROR - CONTACT ADMIN";}
  }
  else{echo "IP ALREADY EXISTS";}
?>