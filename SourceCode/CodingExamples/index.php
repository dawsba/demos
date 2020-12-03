<?
  //CLASS TO CALC VOWELS IN A STRING
  class vowel_check { 
    var $astring = 'aMemberVar Member Variable'; 
	var $vowels = 'aeiou';
    var $counter = '0';
	
	function vcount()
	{ 
        $cr = preg_match_all('/['.$this->vowels.']/i',$this->astring,$xxx);
		$this->counter = $cr;
    } 
	function display()
	{
	  return $this->counter;
	}
  } 
  // EOF VOWEL CHECK
  
  // FUNCTION TO CALC AREA OF A CIRCLE FROM RADIUS
  function area($area)
  {
	return pow($area, 2)*M_PI;
  }
  // EOF AREA
  
  // FUNCTION TO CHECK CASE STATUS OF FIRST CHAR OF STRING
  function nstring($astring)
  {
	switch(ctype_upper(substr($astring,0,1)))
	{
	  case true:
	  $val = "1st Char is Upper";
	  break;
	  default:
	  $val = "1st Char is <u>NOT</u> Upper";
	  break;
	}
	return $val;
  }
  // EOF NSTRING
  
  function factoring($number,$total=0,$string='')
  {
	while($number>1)
	{	  
	  $newnum=$number-1;
	  if($total>0){$total=$number*$total;}else{$total=$number;}
	  $string.=$number.' X ';
	  return factoring($newnum,$total,$string);
	}
	
	$string .= $number;
	$result = array($total,$string);
	return $result;
  }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Barbon Tech Questions</title>
<style>
.red{color:red; font-size:18px;}
</style>
</head>

<body>
<fieldset id="area">
  <legend>Area of a Circle</legend>
  <form action="?area=1" method="post">
    <table>
      <tr>
        <td>Radius</td>
        <td><input name="numr" type="number" placeholder="10"></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit"></td>
      </tr>
    </table>
  </form> 
  <?
    if(isset($_GET['area']))
	{
	  if(is_numeric($_POST['numr']))
	  {
		echo "<p class='red'>Area(<small>".$_POST['numr']."</small>) = ".area($_POST['numr'])."</p>";
	  }
	  else
	  {
		echo "<p class='red'>Incorrect Value Entered</p>"; 
	  }
	}
  ?>
</fieldset>
<fieldset id="upperstring">
  <legend>First Char Uppercase?</legend>
  <form action="?ustring=1" method="post">
    <table>
      <tr>
        <td>String</td>
        <td><input name="astring" type="text" placeholder="This is a String"></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit"></td>
      </tr>
    </table>
  </form> 
  <?
    if(isset($_GET['ustring']))
	{
	  if(!is_numeric($_POST['numr']))
	  {
		echo "<p class='red'>String(<small>".$_POST['astring']."</small>) = ".nstring($_POST['astring'])."</p>";
	  }
	  else
	  {
		echo "<p class='red'>Incorrect String Entered</p>"; 
	  }
	}
  ?>
</fieldset>
<fieldset id="vowelstring">
  <legend>Vowels in a String</legend>
  <form action="?vowels=1" method="post">
    <table>
      <tr>
        <td>String</td>
        <td><input name="vstring" type="text" placeholder="This is a String"></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit"></td>
      </tr>
    </table>
  </form> 
  <?
    if(isset($_GET['vowels']))
	{
	  if(strlen($_POST['vstring'])>=1)
	  {
		$vow = new vowel_check;
		$vow->astring = $_POST['vstring'];
		$vow->vcount();
		$result = $vow->display();
		echo "<p class='red'>String(<small>".$_POST['vstring']."</small>) = ".$result."</p>";
	  }
	  else
	  {
		echo "<p class='red'>Incorrect String Entered</p>"; 
	  }
	}
  ?>
</fieldset>
<fieldset id="factorial">
  <legend>Recursive Factorial</legend>
  <form action="?facts=1" method="post">
    <table>
      <tr>
        <td>Integer</td>
        <td><input name="numbs" type="number" placeholder="10"></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit"></td>
      </tr>
    </table>
  </form> 
  <?
    if(isset($_GET['facts']))
	{
	  if(is_numeric($_POST['numbs']))
	  {
		$values = factoring(floor($_POST['numbs']));
		echo "<p class='red'>String(<small>".$_POST['numbs']."</small>) = Total:".$values[0]." - Rec/Calc:".$values[1]."</p>";
	  }
	  else
	  {
		echo "<p class='red'>Incorrect Integer Entered(".$_POST['numbs'].")</p>"; 
	  }
	}
  ?>
</fieldset>

<?= "Copyright &copy;".date('Y'); ?>
</body>
</html>
