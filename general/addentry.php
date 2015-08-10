<?php
require_once('../settings/dbfunctions.php');
use Web\DB;
include("../theme/req_function.php");
	$msg="gg";
	$pid="";
	
	if(isset($_REQUEST['act']))
	{
		$conn= DB\connect_db($config);
		if ($conn) {
			$pid=101;
			$binding=array( //'pid'=>$pid,
							'name' => $_POST['name'],
							'email'=>$_POST['email'],
							'mob'=>$_POST['mob'],
							'eid'=>$_POST['event'],
							'amtpaid'=>$_POST['amountp'],
							'rdate'=>$_POST['rdate'],
							'clg'=>$_POST['colg']
							);
							
				try
					{	
					$results=DB\insert_db("insert into participants(name,email,mobileno,eid,apaid,rdate,college) 					values(:name,:email,:mob,:eid,:amtpaid,:rdate,:clg)",$binding,$conn);
					if($results)
							$msg="Data successfully entered";
			
				}catch(Exception $e)
				{
						$msg='some Server error encountered..';
						//$msg=$e->getMessage();
				}
			
		}
		
	}

?>
<html>
<head>
  <title>MIS- Home</title>
  <?php
    include("../theme/req_css.html");
	?>

    <style type="text/css" >


  #ui-datepicker-div 
  {
	  font-size:12px;
	  font-family:"Courier New", Courier, monospace;
  }
  .ui-dialog-title
  
  {
	  font-size:14px;
  }
  .ui-button-text
  {
	font-size:12px; 
  }
    
    
  </style>
    <script>

</script>
</head>
<body >
  <?php
	include('../theme/banner_menu.php');
	?>
<div id="center">
   <br><br><br><br><br><br>
  <p class="ui-widget-header ui-corner-all" style="font-weight:bolder;padding:10px;text-align:left;">Add Entry
   </p><form  id="formadd" method="post" action="addentry.php?act=sub">
    <table width="75%"  border="0" style="padding-left:20%">
  <tr>
    <td>Name</td>
    <td>
    
      <input type="text" name="name" id="name" class="" style="width:250px" placeholder="participant name" onKeyPress="return isAlphabet(event)">
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>College</td>
    <td><label for="colg"></label>
      <input type="text" name="colg" id="colg" style="width:250px" placeholder="college" onKeyPress="return isAlphabet(event)"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Mobile No.</td>
    <td><label for="mob"></label>
      <input type="text" name="mob" id="mob" placeholder="mobile no." onKeyPress="return isNumberKey(event)"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Email</td>
    <td><label for="email"></label>
      <input type="text" name="email" id="email" style="width:250px" placeholder="email-id" onKeyPress="return isEmailid(event)"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Registered Event</td>
    <td><label for="event"></label>
      <select name="event" id="event" class="ui-spinner ui-widget ui-widget-content ui-corner-all" style="width:150px;font-size:12px" placeholder="select event">
      
      <?php
	  $conn= DB\connect_db($config);
	if ($conn) {
		$binding=array();
		$results=DB\get_db("select eid,name from events",$conn);
		if($results)
		{	
		
			foreach($results as $i)
	  		{
      			echo("<option class=\"ui-spinner-input\" value=\"".$i[0]."\">". $i[1]." </option>");
	  		}
		}
	}
	 
	  ?></select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Amount Paid</td>
    <td><label for="amountp"></label>
      <input type="text" name="amountp" id="amountp" placeholder="amount paid" onKeyPress="return isNumberKey(event)"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Date</td>
    <td><label for="rdate"></label>
      <input type="text" name="rdate" id="rdate" style="font-size:12px" placeholder="registration date"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href="#" id="btnsubmit" class="ui-state-default ui-corner-all" style="padding:5px;text-decoration:none">Submit<a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

</div>
<div id="dialog-modal" title="Message" style="font-size:12px">
	<p><?php echo $msg;?></p>
</div>
<div id="dialog" title="Confirmation" style="font-size:12px">
	<p>Are you sure,you want to enter data</p>
</div>
<br><br><br><br>
   <?php include("../theme/bottom.html");?>
<script src="../script/jquery.js" type="text/javascript"></script>
<script src="../script/jquery.ui.core.js" type="text/javascript"></script>
<script src="../script/jquery.ui.widget.js" type="text/javascript"></script>
<script src="../script/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="../script/jquery.ui.mouse.js"></script>
	<script src="../script/jquery.ui.draggable.js"></script>
	<script src="../script/jquery.ui.position.js"></script>
	<script src="../script/jquery.ui.resizable.js"></script>
	<script src="../script/jquery.ui.button.js"></script>
	<script src="../script/jquery.ui.dialog.js"></script>
    <script src="../script/themejs.js" type="text/javascript"></script>
        <script src="../script/keyvalidations.js" type="text/javascript"></script>
<script>
$(document).ready(function(e) {
$( "#rdate" ).datepicker({
			
			minDate: -20,
			maxDate: "+0D" ,
			
		});
		$( "#dialog-modal" ).dialog({
		
			autoOpen: false,
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
				
			}
			
		});
		
	$( "#dialog" ).dialog({
			autoOpen: false,
			modal:true,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			},
			buttons: {
				Ok: function() {
					
					$( "#formadd" ).submit();	
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

		$( "#btnsubmit" ).click(function() {
			$( "#dialog" ).dialog( "open" );
		});
		
		<?php 
	
		if(isset($_REQUEST['act']))
			{
					echo("$( \"#dialog-modal\" ).dialog( \"open\" )");
			}
			
		
		?>
//$( "#rdate" ).datepicker( "option", "showAnim", "bounce" );
});

</script>

</body>
</html>