<style>
h2{font-family:Verdana, Geneva, sans-serif;}
.unshown{width:<?= $cwidth; ?>px;height:<?= $cheight; ?>px;font-size:8px;}
.std{width:<?= $cwidth+5; ?>px;height:<?= $cheight+5; ?>px;font-size:8px;}
.unshown:hover{background-color:#999;}
.mine{width:<?= $cwidth; ?>px;height:<?= $cheight; ?>px;font-size:8px; background-image:url(img/mine.png); background-repeat:no-repeat; background-position:center;}
<?
for($r=0;$r<=8;$r++)
{
	?>
	.std<?= $r; ?>{width:<?= $cwidth; ?>px;height:<?= $cheight; ?>px;font-size:8px; background-image:url(img/<?= $r; ?>.png); background-repeat:no-repeat; background-position:center;}
	<?
}
?>
.gtbl tr{min-width:<?= $cwidth*$width+15; ?>px;}
</style>