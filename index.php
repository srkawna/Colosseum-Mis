<!DOCTYPE html>
<html >
<html lang="en">
<head>

  <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style/jquery.ui.all.css">
    <!--div {
  text-align: center;
  vertical-align: middle;
  -moz-background-clip: border;
  height: 300px;
  width: 500px;
  
  border: 3px ridge #CCC;
  visibility: visible;
  float: left;
  display: inherit;
  left: 30%;
  top: 23%;
}-->
<style type="text/css">
.toggler { width: 500px; height: 200px; position: relative; }
    #button { padding: .5em 1em; text-decoration: none; }
    #effect {
	width: 353px;
	height: 205px;
	padding: 0.4em;
	position: absolute;
	text-align: center;
	vertical-align: middle;
	float: left;
	display: inherit;
	left: 33%;
	top: 30%;
	box-shadow:0px 0px 10px 4px #666;
}
    #effect h3 { margin: 0; padding: 0.4em; text-align: center; }
    .ui-effects-transfer { border: 2px dotted gray; }
#button {
	text-decoration: none;
	height: 5px;
	padding-top: 0.5em;
	padding-right: 1em;
	padding-bottom: 0.5em;
	padding-left: 1em;
	margin-top: 1em;
	overflow: auto;
}

table {
	text-align:center
	
	position: relative;
	padding: 0px;
	padding-left:13%;
	margin: 10px;
	width: 320px;
	height: 110px;
	font-family:'Courier New', Courier, monospace;
}
</style>

</head>
<body>

<div id="effect" class="ui-widget-content ui-corner-all">
<div class="ui-dialog-titlebar ui-widget-header ui-corner-top" style="font-size: 28px;width:95%;margin:0px;font-family: 'CHE LIVES!', Starcraft;position:absolute;">COLOSSEUM
    
    <div style="font-size:15px;font-family:'Courier New', Courier, monospace;text-align:right;right:11px;">	Management System&nbsp;&nbsp;</div>
    </div>
    <br><br>
 
<form action="settings/login.php" method="post" id="frm1"> 
  <table width="349" height="111" border="0" align="center" >
    <tr >
      <td colspan="2">LOG-IN</td>
      
      </tr>
    <tr>
      <td style="text-align:right"><label>Username</label>&nbsp;</td>
      <td><label for="textfield"></label>
        <input type="text" name="uname" id="uname" tabindex="1" placeholder="username" requierd></td>
      </tr>
    <tr>
      <td style="text-align:right"><label>Password</label>&nbsp;</td>
      <td><input name="passwd" type="password" id="passwd" placeholder="password" tabindex="2" onKeyPress="return enterKey(event)"></td>
      </tr>
    <tr>
      <td colspan="2" >  
        <label id="showm" style="color: #F00; font-family: Arial, Helvetica, sans-serif; text-align: center; overflow: visible; margin-top: 5px; font-size: 14px; margin: 5px;"></label>
&nbsp;</td>
      </tr>
    <tr align="center" colspan="2">
      
      <td colspan="2">
        <a href="#" id="button" value="Login...!" tabindex="3" class="ui-state-default ui-corner-all">Login</a></td>
      </tr>
  </table>
  </form>

        
</div>


<script src="script/jquery.js"></script>
<script src="script/jquery.ui.effect.js"></script>
<script src="script/jquery.ui.effect-explode.js"></script>

<script>
  $(function() {

    // $('#showm').text("hi");
    
	
	
	
    function runEffect() {

      var options = {};
      
      $( "#effect" ).effect( "explode", options, 1000);
       //console.log('hi');
    };
    
    // set effect from select menu value
    $( "#button" ).click(function() {
      runEffect();
	  $('#frm1').delay(100000);
	  $('#frm1').submit();
	  
    });
	
	
	

  });

</script>
<script>
function enterKey(evt)
      {
 var charCode = (evt.which) ? evt.which : event.keyCode
  
         if (charCode==13)
             {
				 //alert(evt.which);
				 $('#button').click();
			 }
         else
            return true;
	  }
</script>
   
             <?php
						//echo is_null($_REQUEST);
             try {
                   //echo is_null($_REQUEST['type']);
            
            
                    if(isset($_REQUEST['type']))
                   { 
                               //echo similar_text($_REQUEST['type'],"inuser");
                                //echo similar_text($_REQUEST['type'],"inpass");
                               if(similar_text($_REQUEST['type'],"inuser")==6)
                                    { 
                                        echo "<script>$('#showm').text(\"Check that username is typed correctly\")</script>";
                                        die();
                                    }
                              if (similar_text($_REQUEST['type'],"inpass")==6)
                                    {
                                      echo "<script>$('#showm').text(\"Please check the entered password\")</script>";
                                      die();
                                    }
                   }   
               
                    
             } catch (Exception $e) {
            
             }
						                       
             ?>



</body>


</html>
