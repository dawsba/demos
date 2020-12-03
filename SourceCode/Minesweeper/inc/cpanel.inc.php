<div id="cpanel">
  <form action="?ref=mssetup" enctype="multipart/form-data" method="post">
    <table>
      <tr>
        <td>Height</td>
        <td><input class="input" type="text" name="height" value="<?= $_SESSION['height']; ?>" /></td>
      </tr>
      <tr>
        <td>Width</td>
        <td><input class="input" type="text" name="width" value="<?= $_SESSION['width']; ?>" /></td>
      </tr>
      <tr>
        <td>Mines</td>
        <td><input class="input" type="text" name="mines" value="<?= $_SESSION['mines']; ?>" /></td>
      </tr>
      <tr>
        <td colspan="2"><input class="input" type="submit" value="Reload" /></td>
      </tr>
    </table>
    <input id="clock" type="text" value="00:00:0" style="text-align: center;" readonly><br> 
	<input id="startstopbutton" type="button" value="Start" onClick="startstop();"><br> 
	<input id="splitbutton" type="button" value="Split time" onClick="splittime();"><br> 
	<input id="resetbutton" type="button" value="Reset" onClick="resetclock();"><br> 
	<textarea id="output" style="height: 90%;"></textarea> 
    <br /><br /><br />
    
</div>