<?PHP
  //EPDQ VARIABLES
  define('BCARD_URL','https://mdepayments.epdq.co.uk/ncol/test/orderdirect.asp');  // PATH TO BARCLAYCARD SECURE SERVER
  define('SHA1_PASSWORD','***************************************'); //ASSIGNED IN BARCLAYS BACKEND UNDER SHA1 PASSPHRASE
  define('PSPID','***************************************'); // PSPID FOR MASTER GROUP IN BARCLAYS BACKEND
  define('USERID','***************************************'); // USERID ASSIGNED IN BARCLAYS WITH API PRIVIALGES
  define('PSWD','***************************************');//'65C.QFYcF?'); // PASSWORD ASSIGNED TO USER -> USERID
  
  // XML DEFINES
  define('XML_TAG','root');
  
  //MYSQL VARIABLES
  //define('dbserver',"127.0.0.1");
  define('dbserver',"pandorasystems.net");
  define('dbusername',"***************************************");
  define('dbpassword',"***************************************");  
  define('dbname',"pandoras_epdq");
  
  define('table_prefix','tbl_');
    
  // VARIOUS
  define('admin_email','bdawson@pandorasystems.net');
  define('db_path','_db');
  define('function_path','_functions');
  
  // Encryption Algo
  define('useenc',FALSE);
  define('encfile','pc1/pc1.php'); // PC1
  define('encsalt','***************************************'); // SALT FOR ENCRYPTION
  define('forcepcenc',FALSE);
  
  //OUTPUT TYPES
  define('usexml',FALSE);
  define('usejson',true);
?>