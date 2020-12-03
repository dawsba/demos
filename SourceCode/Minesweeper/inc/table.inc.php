<? include  'script.inc.php'; ?>
<table cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="gtbl" width="200">
  <?
    $m=0;
    for($i=1;$i<=$_SESSION['height'];$i++)
    {
      ?><tr><?
      for($k=1;$k<=$_SESSION['width'];$k++)
      {
        $m++;
        if(shown($m,$open,$flag) || $showall==1)
        {
            ?>
            <td style="padding:0px;border:1px solid #999;" class="<?= celltype($m); ?>">&nbsp;
            
            </td>
            <?
        }
        else
        {
            ?>
            <td style="padding:0px;" class="std">
            <? if(flag($m)){ ?>
            <input type="image" src="img/flag.png" class="unshown" onclick="sndReq('table','inc/table.inc.php?open=<?= $m; ?>')"/>
            <? }else{ ?>
            <input type="button" class="unshown" onclick="sndReq('table','inc/table.inc.php?open=<?= $m; ?>')"/>
            <? } ?>
            </td>
            <?
        }
      }
      ?></tr><?
    }
  ?>
</table>
<?
	/*foreach($_SESSION['cell'] as $k => $v)
	{
	  foreach($_SESSION['cell'][$k] as $k2 => $v2)
		{
		  echo $k2."--".$v2."<BR>";
		}
	}*/
	?>