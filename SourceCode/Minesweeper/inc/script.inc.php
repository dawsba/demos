<?
  session_start();
  $cwidth = 15;
  $cheight = 15;
  if(!function_exists('cell_filled')){
  function cell_filled($id)
  {
	  if(isset($_SESSION['cell'][$id]) || isset($_SESSION['mine'][$id])){return true;}
	  return false;	  
  }
  function fill_cells($tc)
  {
	for($c=1;$c<=$tc;$c++)
	{
	  mine_loc($c);
	}
  }
  function shown($id,$open,$flag)
  {
	if($open > 0 || $flag > 0){clicked($id,$open,$flag);}
	if($_SESSION['cell'][$id][show]==1 && $id != $flag){return true;}
	return false;  
  }
  function flag($id){}
  function clicked($id,$open,$flag)
  {
	$_SESSION['cell'][$open][show]=1;
	$_SESSION['cell'][$flag][show]=1;
	return;
  }
  function cellref($id)
  {
	  $row = ceil(($id/$_SESSION['width']));
	  if($row != 1){
		  $_SESSION['cd'][tt] = $id-$_SESSION['width'];
		  if($row == ceil((($id-($_SESSION['width']+1))/$_SESSION['width']))+1){$_SESSION['cd'][tl] = $id-($_SESSION['width']+1);}
		  if($row != ceil((($id-($_SESSION['width']-1))/$_SESSION['width']))){$_SESSION['cd'][tr] = $id-($_SESSION['width']-1);}
	  }
	  if($row < $id-1 && $row == ceil((($id-1)/$_SESSION['width']))){$_SESSION['cd'][ll] = $id-1;}
	  if($id != ($row*$_SESSION['width'])){$_SESSION['cd'][rr] = $id+1;}
	  if($row != $_SESSION['height']){
		  if($row != ceil((($id+($_SESSION['width']-1))/$_SESSION['width']))){$_SESSION['cd'][bl] = $id+($_SESSION['width']-1);}
		  $_SESSION['cd'][bb] = $id+$_SESSION['width'];
		  if(ceil((($id+($_SESSION['width']+1))/$_SESSION['width'])) == $row+1){$_SESSION['cd'][br] = $id+($_SESSION['width']+1);}
	  }
	  return $_SESSION['cd'];
  }
  function countm($id,$dis=0)
  {
	  $mc=0;
	  $_SESSION['cd']=array();
	  $_SESSION['cd'] = cellref($id);
	  foreach($_SESSION['cd'] as $k=>$v)
	  {
		 if(in_array($v,$_SESSION['mine'])){$mc++;}
	  }
	  unset($_SESSION['cd']);
	  $_SESSION['cell'][$id][cc]=$mc;
	  return "std".$mc;
  }
  function make_seed()
  {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
  }
  function mine_loc($id)
  {
	  while(count($_SESSION['mine']) < $_SESSION['mines'])
	  {
		  mt_srand(make_seed());
		  $tcid=rand(1,$_SESSION['total_cells']);
		  if(!cell_filled($tcid)){$_SESSION['cell'][$tcid][mine]=1;$_SESSION['mine'][]=$tcid;}
	   }
  }
  function celltype($id)
  {
	  $class = 'std';
	  if(in_array($id,$_SESSION['mine'])){return "mine";}
	  else
	  {
		$class = countm($id);  
	  }
	  return $class;
  }
  if(!isset($_SESSION['height']) && !isset($_POST[height])){$_SESSION['height']=20;}if(isset($_POST[height])){$_SESSION['height']=$_POST[height];}
  if(!isset($_SESSION['width']) && !isset($_POST[width])){$_SESSION['width']=20;}if(isset($_POST[width])){$_SESSION['width']=$_POST[width];}
  if(!isset($_SESSION['mines']) && !isset($_POST[mines])){$_SESSION['mines']=20;}if(isset($_POST[mines])){$_SESSION['mines']=$_POST[mines];}
  if($_SESSION['mines'] > ($_SESSION['height']*$_SESSION['width'])){$_SESSION['mines'] = 1;echo "Mines cannot exceed grid size";}
  $_SESSION['cell'] = array();
  $_SESSION['mine'] = array();
  $_SESSION['cd']=array();
  $_SESSION['total_cells'] = $_SESSION['height']*$_SESSION['width'];
  
  }
?>