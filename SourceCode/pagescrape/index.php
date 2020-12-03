<?PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('memory_limit','512M');
function customError($errno, $errstr)
{
  echo "<b>Error:</b> [$errno] $errstr<br>";
  echo "Ending Script";
  die();
}
set_error_handler("customError",E_USER_WARNING);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Page Scrapper V1.01</title>

<style>
  .thumb{width:140px;margin:10px; padding:5px; border:1px solid #000; border-radius:5px;}
</style>

</head>

<body>
<?PHP
  class stripper
  {
	  var $data = array();
	  var $cache = array();
	  var $start = '';
	  var $xend = '';
	  var $xstring = '';
	  var $weblink = '';
	  var $xlist = array();
	  var $filelist = array();
	  
	  function gsb($xstring, $start, $xend, $datax)
	  {
		$xstring = ' ' . $xstring;
		$ini = strpos($xstring, $start);
		if ($ini == 0){return;}
		$ini += strlen($start);
		$len = strpos($xstring, $xend, $ini) - $ini;
		$datax[] = trim(substr($xstring, $ini, $len));
		$this->cache[] = trim(substr($xstring, $ini, $len));
		$inx = strpos(substr($xstring, $ini+$len), $start);
		if ($inx <= 0 || is_null($inx))
		{
		  $this->data=$datax;
		  return;
		}
		$this->gsb(substr($xstring,$ini+$len),$start,$xend,$datax);
	  }
	  
	  function image_hunt()
	  {
		preg_match_all('/<img[^>]+>/i',$this->xstring, $this->cache);
	  }
	  
	  function find_src()
	  {
		foreach($this->xlist[0] as $k=>$img_tag)
		{
		  preg_match_all('/(alt|title|src)=("[^"]*")/i',$img_tag, $this->cache[]);
		}
	  }
	  
	  function rungsb()
	  {
		$this->gsb($this->xstring,$this->start,$this->xend,'');
	  }
	  
	  function dump()
	  {
		return $this->data;
	  }
	  
	  function settext($text)
	  {
		$this->xstring = $text;
	  }
	  
	  function settag($tag,$close)
	  {
		$this->start = $tag;
		$this->xend = $close;
	  }
	  
	  function loadlink($text)
	  {
		if(!filter_var($text, FILTER_VALIDATE_URL)){ trigger_error('Not a Valid Webpage!',E_USER_WARNING);}
		$this->weblink = $text;
		$this->webpage(); //load the page		
	  }
	  
	  function webpage()
	  {
		if(!filter_var($this->weblink, FILTER_VALIDATE_URL)){ trigger_error('Not a Valid Webpage!',E_USER_WARNING);}
		$this->settext(file_get_contents($this->weblink));
	  }
	  
	  function moveimg()
	  {
		$this->xlist = $this->cache;
	  }
	  
	  function subrun($tag,$tag2)
	  {
		foreach($this->xlist as $k=>$v)
		{
		  $this->settext($v);
		  $this->settag($tag,$tag2);
		  $this->rungsb();
		}
	  }
	  
	  function xempty($ztype)
	  {
		$this->$ztype = '';
	  }
	  
	  function mergeimages()
	  {
		foreach($this->cache as $v)
		{
		  if(is_array($v[2]))
		  {
			if(isset($v[2][0]))
			{
			  if(strlen($v[2][0])>4)
			  {
			    $olink = str_replace($this->weblink,'',ltrim(str_replace('"','',$v[2][0]),'/'));
				$ilink = rtrim($this->weblink,'/').'/'.$olink;
				//echo $olink."-".$ilink;
				if(filter_var($olink, FILTER_VALIDATE_URL))
				{
				  $this->filelist[] = $olink;
				  //echo "OLINK TRUE<br>";
				}
				elseif(filter_var($ilink, FILTER_VALIDATE_URL))
				{
				  $this->filelist[] = $ilink;
				  //echo "ILINK TRUE<br>";
				}
				else
				{
				  //echo "FAIL<br>";
				}
			  }
			}
		  }
		}
	  }
	  
	  function spk($obj)
	  {
		?>
          <h3>Dumping data to Screen</h3>
          <pre>
            <?= var_dump($obj); ?>
          </pre>
          <h4>End of Dump</h4>
        <?PHP
	  }
	  
	  function displayimages()
	  {
		$build = '';
		foreach($this->filelist as $k=>$v)
		{
		  $build .= "<img class=\"thumb\" src=\"$v\" \>";
		}
		if(strlen($build)<4){trigger_error("No Matching Data Scraped",E_USER_WARNING);}
		return $build;
	  }
  }
  $test = new stripper();
  if(isset($_POST['website']))
  {
    $test->loadlink($_POST['website']); 
    $test->settag('<img','/>');
    //$test->rungsb();
    $test->image_hunt();
	//$test->spk($test->cache);
	$test->moveimg();
    $test->xempty('data');
    $test->xempty('cache');
    //$test->subrun('src="','"');
	$test->find_src();
    $test->xempty('xlist');
	$test->mergeimages();
  }
?>
<form method="post">
  <input type="text" name="website" placeholder="Enter Website"><input type="submit" value="Submit">
</form>
<?PHP
  echo $test->displayimages();
?>
</body>
</html>
