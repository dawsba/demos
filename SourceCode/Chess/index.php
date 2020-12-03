<?
session_start();
if(isset($reset)){session_destroy();echo "<script>window.location='".$_SERVER['PHP_SELF']."'</script>";}
if((!isset($_SESSION[currentplayer])) || ($_SESSION[currentplayer] == 2)){$_SESSION[currentplayer] = 1;}else{$_SESSION[currentplayer]++;}
?>
<script>
  function ready2move(a,b,c,d)
  {
	j = document.getElementById('holdingbx');
	if(a == j.value){j.value = ' ';document.getElementById(b).style.border='none';a=undefined;b=undefined;c=undefined;d=undefined;} 
	if(j.value.length > 4 && j.value != a && c != '<?= $_SESSION[currentplayer]; ?>')
	{
	  document.getElementById(b).style.border='2px solid blue';
	  var answer = confirm("Are you sure?")
	  if(answer){window.location='<? echo $_SERVER['PHP_SELF']; ?>?move='+j.value+'&new='+b;}else{document.getElementById(b).style.border='none';}
	}
	if(d != 'c' && j.value.length < 4 && c == '<?= $_SESSION[currentplayer]; ?>'){j.value = a;document.getElementById(b).style.border='2px solid red';}
	return;
  }
</script>
<?
function rules($player,$origcell,$newcelld,$pieceid)
{
  if($pieceid=='P') // (sqrt($board[playarea])*row)-(sqrt($board[playarea]-col))
  {
    if((($newcelld-$origcell) != 8) && ($_SESSION[playboard][$newcelld][player] != 'all')){$return = false;$message = 'Error';}else{$return = true;}
  }
  if(!$return){echo "<script>alert('".$message."')</script>";}
  return $return;
}
function piecemove($player,$origcell,$newcell,$pieceid)
{
  if(rules($player,$origcell,$newcell,$pieceid))
  {
    if($_SESSION[playboard][$origcell][piece] == $pieceid)
    {
      $_SESSION[playboard][$origcell][player] = 'all';
      $_SESSION[playboard][$origcell][piece] = 'c';
      $_SESSION[playboard][$newcell][player] = $player;
      $_SESSION[playboard][$newcell][piece] = $pieceid;
	  $_SESSION[playdata][moves][++$_SESSION[playdata][movenum]] = $player.":".$origcell.":".$newcell.":".$pieceid;
    }
    else
    {
      echo "<script>alert('Error')</script>";
    }
  }
  return;
}
if(isset($move)){$bits = explode(":",$move);piecemove($bits[1],$bits[0],$new,$bits[2]);}
// Session settings
  $board[playarea] = 64;
  $board[pieces][height] = 32;
  $board[pieces][width] = 32;
  $board[table][border] = 0;
  $board[table][width] = 0;
  $board[table][padding] = 0;
  $board[table][spacing] = 0;
  $board[table][style] = 'border:1px solid black;';
  $board[table][cells][width] = '50px';
  $board[table][cells][height] = '50px';
  $board[colours][black] = '#666';
  $board[colours][white] = '#FFFFFF';
  $player[1][colour] = 'Brown'; // YELLOW WHITE BROWN BLUE BLACK
  $player[2][colour] = 'Yellow';
  $player['all'][image]['filetype'] = 'ico';
  $board[rows] = sqrt($board[playarea]);
  $board[cols] = $board[rows];
  $board[colours][sqarray][0] = array("1"=>1,"3"=>1,"5"=>1,"7"=>1);
  $board[colours][sqarray][1] = array("2"=>1,"4"=>1,"6"=>1,"8"=>1); 
  $pieces[names] = array("K"=>'King',"Q"=>"Queen","R"=>"Rook","N"=>"Knight","B"=>"Bishop","P"=>"Pawn");
//----------

//pieces
  for($i=1;$i<=2;$i++)
  {
    $fni = $player['all'][image]['filetype'];$pct = $player[$i][colour];
	$pieces['p'.$i][img] = array("K"=>$pct." K.".$fni,"Q"=>$pct." Q.".$fni,"R"=>$pct." R.".$fni,"N"=>$pct." N.".$fni,"B"=>$pct." B.".$fni,"P"=>$pct." P.".$fni);
  }
  //clear
    $pieces['pall'][img]['c'] = 'clear.gif';
//------------

//Player starting positions
  $player[1][starting] = array("1"=>'R',"2"=>'N',"3"=>'B',"4"=>'K',"5"=>'Q',"6"=>'B',"7"=>'N',"8"=>'R');for($i=9;$i<=16;$i++){$player[1][starting][$i]='P';}
  $player[2][starting] = array("57"=>'R',"58"=>'N',"59"=>'B',"60"=>'K',"61"=>'Q',"62"=>'B',"63"=>'N',"64"=>'R');for($i=49;$i<=56;$i++){$player[2][starting][$i]='P';}
//------------

//Draw first board in memory
if(!isset($_SESSION[playboard])){
for($i=1;$i<=$board[playarea];$i++)
{
  if(isset($player[1][starting][$i])){$_SESSION[playboard][$i][player] = 1;$_SESSION[playboard][$i][piece] = $player[1][starting][$i];continue;}
  if(isset($player[2][starting][$i])){$_SESSION[playboard][$i][player] = 2;$_SESSION[playboard][$i][piece] = $player[2][starting][$i];continue;}
  $_SESSION[playboard][$i][player] = 'all';$_SESSION[playboard][$i][piece] = 'c';
}}
//------------
?>
<center>
Player <?= $_SESSION[currentplayer]; ?>s Turn
<table><tr><td>
  <table border="<?= $board[table][border]; ?>" width="<?= $board[table][width]; ?>" cellpadding="<?= $board[table][padding]; ?>" cellspacing="<?= $board[table][spacing]; ?>" style="<?= $board[table][style]; ?>">
  <?
  $j=1;
  ?><tr><? for($k=0;$k<=$board[cols];$k++){?><td align="center"><? if($k>0){echo $k;} ?></td><? } ?></tr><?
  for($i=1;$i<=$board[rows];$i++)
  {
	echo "<tr><td>$i</td>";
    for($k=1;$k<=$board[cols];$k++)
    {
      echo "<td id=\"".$j."\" style=\"width:".$board[table][cells][width].";height:".$board[table][cells][height].";background-color:";
	  if(!isset($board[colours][sqarray][$i%2][$k])){echo $board[colours][black];}else{echo $board[colours][white];}
	  echo ";\" align=\"center\"><img id='".$j.":".$_SESSION[playboard][$j][player].":".$_SESSION[playboard][$j][piece]."' onclick=\"ready2move(this.id,'".$j."','".$_SESSION[playboard][$j][player]."','".$_SESSION[playboard][$j][piece]."')\" src=\"images/".$pieces['p'.$_SESSION[playboard][$j][player]][img][$_SESSION[playboard][$j][piece]]."\" width=\"".$board[pieces][width]."\" height=\"".$board[pieces][height]."\"></td>";
	  $j++;
    }
    echo "</tr>";
  }
  echo "<tr><td colspan=\"".$board[rows]."\"><input type=\"button\" value=\"RESET\" onclick=\"window.location='".$_SERVER['PHP_SELF']."?reset=true'\"</td></tr>";
  ?>
  </table>
  </td>
  <td valign="top" align="center">
    Moves
    <table>
      <tr><td>Move</td><td>Player</td><td>From</td><td>To</td><td>Piece</td></tr>
	<?
	  if(isset($_SESSION[playdata][moves]))
	  {
	    foreach($_SESSION[playdata][moves] as $k=>$v)
		{
		  $parts = explode(":",$v);
		  echo "<tr><td>$k</td><td>$parts[0]</td><td>$parts[1]</td><td>$parts[2]</td><td>".$pieces[names][strtoupper($parts[3])]."</td></tr>";
		}
	  }
	?>
    </table>
  </td>
</tr>
</table>
  <input type="hidden" name="holding" id="holdingbx">
</center>
<br>
<br>
<h2>Output Code to Screen</h2>
<? 
  $fh = fopen('index.php', "r");
  while (!feof($fh)) {
  $line = fgets($fh);
  $data .= $line;
  }
  fclose($fh); 
  ?><pre><code><?php highlight_string($data); ?></code></pre>