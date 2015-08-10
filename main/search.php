<?php
require_once('../settings/dbfunctions.php');
use Web\DB;

	$msg="gg";
	$pid="";
	$c1=0;
	$c2=0;
	$results1="";
	$exp=0;
	if(isset($_REQUEST['act']))
	{
		$case=0;
		if(strcmp($_POST['name'],"")==0)
		{
			$c1=1;
		}
		if(strcmp($_POST['event'],"0")==0)
		{
			$c2=1;
		}
		//echo $c1." ".$c2."ddd";
		$querystring="";
		$binding="";
		$flag=1;
		if($c1!=1 && $c2!=1)
		{
			//echo "1";
			$querystring="select * from participants where name like :name and eid=:eid";
				$binding=array( //'pid'=>$pid,
							'name' => "%".$_POST['name']."%",
							'eid'=>$_POST['event']
					
							);
		}else if($c1!=1){
			//echo "2";
			$querystring="select * from participants where name like :name ";
			///echo $querystring;
				$binding=array( 
							'name' => "%".$_POST['name']."%"	
							);
		}
		else if($c2!=1){
			//echo "3";
			$querystring="select * from participants where eid=:eid";
				$binding=array(
							'eid'=>$_POST['event']
					
							);
		}
		else
		{
			
			$msg="please enter name or event to search";
			$flag=0;
		
		}	
		if($flag!=0)
		{
		
			//echo $querystring;
			$conn= DB\connect_db($config);
			if ($conn) {
							
					try
						{	
							$results1=DB\select_db($querystring,$binding,$conn);
							if(($stat=$results1->rowCount())==0)
								$stat="No";
							$msg=$stat." records found..";
			
					}catch(Exception $e)
					{
						$exp=1;
						$msg='some Server error encountered..';
						//$msg=$e->getMessage();
					}
			
			}
		
		}
	}
?>
<html>
<head>
  <title>MIS- Home</title>
 

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
    <script >

</script>
</head>
<body >
  
<div id="center1">
  <p class="ui-widget-header ui-corner-all" style="font-weight:bolder;padding:10px;text-align:left;">Search Entry
  </p><form  id="formsearch" method="post" action="search.php?act=sub">
    <table width="75%"  border="0" style="padding-left:20%;">
  <tr>
    <td>&nbsp;</td>
    <td>Name</td>
    <td><input type="text" name="name" id="name" class="" style="width:250px" placeholder="participant name" onKeyPress="return isAlphabet(event)"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Event</td>
    <td><select name="event" id="event" class="ui-spinner ui-widget ui-widget-content ui-corner-all" style="width:150px;font-size:12px" placeholder="select event">
      <option value="0" style="color:#999">select</option>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="#" id="btnsubmit" class="ui-state-default ui-corner-all" style="padding:5px;text-decoration:none">Submit<a></td>
    <td>&nbsp;</td>
  </tr>
</table>

  </form>
  <table  id="resultpane" width="88%" style="padding-left:10%;">
    <tr>
    <td colspan="6" class="ui-widget-header">
    Search Results
    </td>
    
  </tr>
  <tr style="border-bottom:2px;border-bottom-color:#666;margin-bottom:2px;" >
    <td style="background-color:#CCC">Name</td>
    <td style="background-color:#CCC">College</td>
    <td style="background-color:#CCC">Mobile No.</td>
    <td style="background-color:#CCC">Event</td>
    <td style="background-color:#CCC">Amount paid</td>
    <td style="background-color:#CCC">Registration Date</td>
    <td></td>
  </tr>
  <?php
	if($results1)
	{
		//print_r($results1);
		while($row = $results1->fetch(\PDO::FETCH_OBJ))
		{
				echo "<tr style=\"border-bottom:2px;border-bottom-color:#666\">";
    			echo "<td>".$row->name."</td>";
				echo "<td>".$row->college."</td>";
				echo "<td>".$row->mobileno."</td>";
				echo "<td>".$row->eid."</td>";
				echo "<td>".$row->apaid."</td>";
    			echo "<td>".$row->rdate."</td>";
  				echo "</tr>";
		}
	}
?>
  <tr>
    <td colspan="6">&nbsp;</td>
    
  </tr>
</table>


</div>
<div id="dialog-modal" title="Message" style="font-size:12px;">
	<p><?php echo $msg ;?></p>
</div>


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
	$( "#resultpane" ).hide();
$( "#rdate" ).datepicker({
			
			minDate: -20,
			maxDate: "+0D" ,
			
		});
		$( "#dialog-modal" ).dialog({
		
			autoOpen: false,
			modal: true,
			buttons: {
				Ok: function() {
					<?php
					if(isset($_REQUEST['act']))
						if(strcmp($_REQUEST['act'],'sub')==0)
						{
							if($flag==1&& !is_null($results1)&&$exp==0)
								if($results1->rowCount()>0)
								echo("$( \"#resultpane\" ).fadeIn(100);");
							
								echo("$( this ).dialog( \"close\" );");	
						}
					?>
					
					
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
				$( "#resultpane" ).hide();
			$( "#formsearch" ).submit();
		});
		
		<?php 
	if(isset($_REQUEST['act']))
		if(strcmp($_REQUEST['act'],'sub')==0)
			{
				
					//if($results1->rowCount()>0)
							//echo("$( \"#resultpane\" ).fadeIn(100);");
						
									
					echo("$( \"#dialog-modal\" ).dialog( \"open\" )");
					
			}
		
			
		
		?>
//$( "#rdate" ).datepicker( "option", "showAnim", "bounce" );
});

</script>

</body>
</html>