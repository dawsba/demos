<?PHP
  function getOrderId()
  {
	return rand(100,999).'|'.date('YmdHis').'|'.rand(100,999);
  }
?>