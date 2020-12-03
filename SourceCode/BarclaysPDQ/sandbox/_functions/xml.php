<?PHP
  function output_xml($xml)
  {
	$xmlx = new SimpleXMLElement('<'.XML_TAG.'/>');
    @array_walk_recursive(array_flip($xml), array ($xmlx, 'addChild'));
    print $xmlx->asXML();
	exit(1);
  }
?>