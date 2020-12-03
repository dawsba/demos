<?
define("MAP_WIDTH",61);
define("MAP_HEIGHT",54);
define("CELL_WIDTH",10);
define("CELL_HEIGHT",10);
define("DEBUG-EO",1);  // 1 shows extras, 0 hide extras
$cell_ref=1;
require_once('_inc/_map_cells/cell_refs.php');
asort($dead_map_cell);
asort($airports);
asort($water);
asort($motorway);

/*
foreach($airports as $k)
{
  //if(!in_array($k,$ignore)){
	  echo $k.",";//}
}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
var build;
build = '';
function addbuild(ref)
{
  build = build+','+ref;
  document.getElementById('cr'+ref).style.borderColor='red';
  //document.getElementById('cr'+ref).style.backgroundColor='transparent';
  //alert(ref+' added');
  sndReq('cell_detail','_inc/cell_detail.php?ref='+ref);
  return;	
}
function showbuild()
{
	document.getElementById('vararea').value = build;
	//alert(build);
}
</script>
<script>
	function toggleMe(a){
	  var e=document.getElementById(a);
	  if(!e)return true;
	  if(e.style.display=="none"){
		e.style.display=""
	  } else {
		e.style.display="none"
	  }
	  return true;
	}
	</script>
    <script>
	function createRequestObject() { 
	  var ro; 
	  var browser = navigator.appName; 
	  if(browser == "Microsoft Internet Explorer"){ 
		ro = new ActiveXObject("Microsoft.XMLHTTP"); 
	  }else{ 
		ro = new XMLHttpRequest(); 
	  } 
	  return ro; 
	} 
	var http = createRequestObject(); 
	var returnDiv 
	function sndReq(divRet,file) { 
	  //document.getElementById(divRet).style.display='block';
	  //alert("RUNNING");
	  document.getElementById(divRet).innerHTML = "<center><img style='border:none; width:150px;' src='http://imeinetwork.com/img/loaderB64.gif'></center>";
	  var date = new Date();
	  var timestamp = date.getTime();
	  returnDiv = divRet; 
	  http.open('get', file+'&time='+timestamp); 
	  http.onreadystatechange = handleResponse; 
	  http.send(null); 
	} 
	function handleResponse() { 
	  if(http.readyState == 4){ 
		var response = http.responseText; 
		document.getElementById(returnDiv).innerHTML = response; 
		var ob = document.getElementById(returnDiv).getElementsByTagName("script");
		  for(var i=0; i<ob.length-1; i++){
			  if(ob[i+1].text!=null) eval(ob[i+1].text);
			  alert(ob[i+1].text);
		  }
	  } 
	}
	function alertContentsInit(http_request, tag_target) {
	  if (http_request.readyState == 4) {
	    if (http_request.status == 200) {
	      result = http_request.responseText;
		  // with this I get all the response that a PHP page build
		  document.getElementById(tag_target).innerHTML = result;
		  // with this following two row, I try to get the script and execute it
		  var ob = document.getElementsByTagName("script");
		  for(var i=0; i<ob.length-1; i++){
			  if(ob[i+1].text!=null) eval(ob[i+1].text);
		  }
		}else{
		  alert('There was a problem... ');
		}
	  }
	}
	</script>
<style>
  .map_holder{
	  background-image:URL(_img/london1.jpg);
	  width:750px;
	  height:623px;
  }
  .map{
	  width:<?= CELL_WIDTH; ?>px;
	  height:<?= CELL_HEIGHT; ?>px;
  }
  .map_cell_active{
	  border:1px solid transparent;
  }
  .map_cell_dead{
	  background-color:#fff;
  }
  .map_cell_airport{
	  background-color:#993;
	  opacity:0.4;
	  filter:alpha(opacity=40);
  }
  .map_cell_water{
	  background-color:#06F;
	  opacity:0.4;
	  filter:alpha(opacity=40);
  }
  .map_cell_motorway{
	  background-color:#F00;
	  opacity:0.4;
	  filter:alpha(opacity=40);
  }
  #cell_detail{
	  width:300px;
	  height:630px;
	  border:1px solid #ccc;
  }
  .map_cell_zone{
	  background-color:#F00;
	  opacity:0.4;
	  filter:alpha(opacity=40);
  }
</style>
<title>MAP DEMO</title>
</head>

<body>
<table class="board">
  <tr>
    <td>
    <table class="map_holder" cellpadding="0" cellspacing="0">
      <?
        
        for($i=1;$i<=MAP_HEIGHT;$i++)
        {
          echo "<tr class=\"map_row\">";
          for($j=1;$j<=MAP_WIDTH;$j++)
          {
            $cell_ref++;
            $cell_type = "map_cell";
			if(in_array($cell_ref,$dead_map_cell))
            {
              $cell_type .= "_dead";
            }
			elseif(in_array($cell_ref,$airports))
			{
			  $cell_type .= "_airport";
			}
			elseif(in_array($cell_ref,$water))
			{
			  $cell_type .= "_water";
			}
			elseif(in_array($cell_ref,$motorway))
			{
			  $cell_type .= "_motorway";
			}
			elseif(in_array($cell_ref,$zone['HAVERING']))
			{
			  $cell_type .= "_zone";
			}
            else
            {
              $cell_type .= "_active";
            }
            echo "<td title=\"".$i.":".$j.":".$cell_ref."\" class=\"map ".$cell_type."\" id=\"cr".$cell_ref."\" onclick=\"addbuild(".$cell_ref.")\"></td>";
          }
          echo "</tr>";
        }
      ?>
    </table>
    </td>
    <td>
      <div id="cell_detail"></div>
    </td>
  </tr>
</table>
<input type="text" id="vararea" />
<input type="button" onclick="showbuild();" value="SHOW VALUES" />
</body>
</html>