<?
  // DATABASE CONNECTIVITY
  $link=@mysql_connect (dbserver,dbusername,dbpassword) or die ('DB ERROR -> ' . mysql_error());
  mysql_select_db (dbname); 
  
  function q($query,$assoc=1) {
   $r = @mysql_query($query);
   if( mysql_errno() ) {
       //$error = 'MYSQL ERROR #'.mysql_errno().' : <small>' . mysql_error(). '</small><br><VAR>$query</VAR>';
       //echo($error); 
	   return FALSE;
   } 
   if(strtolower(substr($query,0,6))!= 'select') return array(mysql_affected_rows(),mysql_insert_id());
   $count = @mysql_num_rows($r);
   if( !$count ) return 0;
   if( $count == 1 ) {
       if( $assoc ) $f = mysql_fetch_assoc($r);
       else $f = mysql_fetch_row($r);
       mysql_free_result($r);
       if( count($f) == 1 ) {
           list($key) = array_keys($f);    
           return $f[$key];
       } else {
           $all = array();
           $all[] = $f;
           return $all;
       }
   } else {
       $all = array();
       for( $i = 0; $i < $count; $i++ ) {
           if( $assoc ) $f = mysql_fetch_assoc($r);
           else $f = mysql_fetch_row($r);
           $all[] = $f;
       }
       @mysql_free_result($r);
       return $all;
    }
  }
  
//------------------------------------------------------------------------------------------------
?>