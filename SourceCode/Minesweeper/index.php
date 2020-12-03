<?
  $showall = 1;
  include 'inc/script.inc.php';
  fill_cells($_SESSION['total_cells']);
  /*for($c=0;$c<=$_SESSION['total_cells'];$c++)
  {
	if(!cell_filled($c)){}
  }*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP MineSweeper</title>
<? include 'inc/style.inc.php';include 'inc/js.inc.php'; ?>
</head>

<body>
<h2>PHP Mine Sweeper</h2>
<table>
  <tr>
    <td valign="top">
      <table border="3" class="gtbl" width="<?= $cwidth*$width+5; ?>">
        <tr>
          <td valign="top">
            <div id="table">
			  <? include 'inc/table.inc.php'; ?>
            </div>
          </td>
        </tr>
      </table>
    </td>
    <td valign="top">
        <? include 'inc/cpanel.inc.php'; ?>
    </td>
  </tr>
</table>
</body>
</html>
