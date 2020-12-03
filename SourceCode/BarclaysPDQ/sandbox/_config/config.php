<?PHP
  //EPDQ VARIABLES
  define('BCARD_URL','https://mdepayments.epdq.co.uk/ncol/test/orderdirect.asp');  // PATH TO BARCLAYCARD SECURE SERVER
  define('SHA1_PASSWORD','alphatest1alphatest'); //ASSIGNED IN BARCLAYS BACKEND UNDER SHA1 PASSPHRASE
  define('PSPID','pan6qb'); // PSPID FOR MASTER GROUP IN BARCLAYS BACKEND
  define('USERID','taxoff1'); // USERID ASSIGNED IN BARCLAYS WITH API PRIVIALGES
  define('PSWD','7744ID$77');//'65C.QFYcF?'); // PASSWORD ASSIGNED TO USER -> USERID
  
  // XML DEFINES
  define('XML_TAG','root');
  
  //MYSQL VARIABLES
  //define('dbserver',"127.0.0.1");
  define('dbserver',"pandorasystems.net");
  define('dbusername',"pandoras_dbuser");
  define('dbpassword',"85328358");  
  define('dbname',"pandoras_epdq");
  
  define('table_prefix','tbl_');
    
  // VARIOUS
  define('admin_email','bdawson@pandorasystems.net');
  define('db_path','_db');
  define('function_path','_functions');
  
  // Encryption Algo
  define('useenc',FALSE);
  define('encfile','pc1/pc1.php'); // PC1
  define('encsalt','InTheYear2525'); // SALT FOR ENCRYPTION
  define('forcepcenc',FALSE);
  
  //OUTPUT TYPES
  define('usexml',FALSE);
  define('usejson',true);
?>