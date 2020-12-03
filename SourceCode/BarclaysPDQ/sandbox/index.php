<?PHP
  error_reporting(E_ALL); // TURN ON ERROR CHECKING
  ini_set('display_errors', '1'); // FOR TESTING PURPOSES FORCE INI TO DISPLAY ERRORS
  
  require_once('_config/config.php'); // LOAD CONFIGURATION AND DEFAULTS / DEFINES
  require_once(db_path.'/db.con.php'); // CREATE CONNECTION TO DATABASE
  require_once(function_path.'/email.php'); // LOAD EMAIL FUNCTION - CURRENTLY LAMP SEND
  require_once(function_path.'/xml.php'); // RETURN DATA ENCAPSULATION TYPE - CAN BE REPLACED WITH EG: JSON
  require_once(db_path.'/auth.php'); // CHECKS AND/OR INSERTS IP ADDRESS FOR USE OF MAIN SCRIPT - CAN ONLY ADD FROM AUTH_IP.PHP(NO ARGS)
  
  check_auth(); //CHECKS IP FOR AUTHENTICATION
  
  $encpath = function_path.'/'.encfile;
  //if(useenc){require_once($encpath);}else{echo "ERROR IN ENC";exit(1);}
    
  require_once(function_path.'/build.php');
  
  $fields4 = (array) build_fields(); // GENERATES API DATA SHEET(ARRAYS)
  
  require_once(function_path.'/orderid.php');
  require_once(function_path.'/barclays.php');
  
  EPDQDirect($fields4);
?>