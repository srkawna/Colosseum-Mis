<?php
include("../theme/req_function.php");
require_once('../settings/dbfunctions.php');
use Web\DB;
$resultedit="";
$results1="";
$msg="";
$msgdelete="";
$msgadd="";
$msgsave="";
$msgup="";

 if(isset($_REQUEST['opt']))
 {
	 if(strcmp($_REQUEST['opt'],"del")==0)
		{	 //echo "uanme".$_POST['uid'];
				$conn= DB\connect_db($config);
		if ($conn) {
			$pid=101;
			$binding=array( //'pid'=>$pid,
							'eid' => $_POST['eid']
							);
							
				try
					{	
					$results=DB\select_db("delete from events where eid=:eid",$binding,$conn);
					if($results)
							$msgdelete ="Event deleted ";
			
				}catch(Exception $e)
				{
						$msgdelete= 'some Server error encountered..';
					
				}
			
		}
		
		}
		if(strcmp($_REQUEST['opt'],"edit")==0)
		{	 //echo "uanme".$_POST['uid'];
				$conn= DB\connect_db($config);
		if ($conn) {
			
			$binding=array('eid' => $_POST['eid']	);
							
				try
					{	
					$resultedit=DB\query_db("select * from events where eid=:eid",$binding,$conn);
					if($resultedit)
							echo "";
			
				}catch(Exception $e)
				{
						$msgedit= 'some Server error encountered..';
					
				}
			
		}
		
		}
		if(strcmp($_REQUEST['opt'],"addu")==0)
		{
					
						$conn= DB\connect_db($config);
						if ($conn) {
							
							$binding=array( //'pid'=>$pid,
											'name' => $_POST['eventname'],
											'edate'=>$_POST['eventdate'],
											'efee'=>$_POST['entryfee'],
											'expentries'=>$_POST['expentry'],
											
											);
											
								try
									{	
									$results=DB\insert_db("insert into events(name,edate,efee,expentries) 					values(:name,:edate,:efee,:expentries)",$binding,$conn);
									if($results)
											$msgadd="Event Added...";
							
								}catch(Exception $e)
								{
										$msgadd='some Server error encountered..';
										//$msg=$e->getMessage();
								}
							
						}
						
					

		}
		if(strcmp($_REQUEST['opt'],"save")==0)
		{
					//print_r($_POST);
						$conn= DB\connect_db($config);
						if ($conn) {
						$binding=array( //'pid'=>$pid,
											'name' => $_POST['ename1'],
											'edate'=>$_POST['eventdate1'],
											'efee'=>$_POST['efee1'],
											'expentries'=>$_POST['expentry1'],
											'eid'=>$_POST['eid1']
											
											);
											
								try
									{	
									$results=DB\insert_db("update events set
									name=:name,edate=:edate,efee=:efee,expentries=:expentries where eid=:eid",$binding,$conn);
									if($results)
										$msgup="Information Updated ...";
							
								}catch(Exception $e)
								{
										$msgup='some Server error encountered..';
										//$msg=$e->getMessage();
								}
							
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
    <style>
	#ui-datepicker-div 
  {
	  font-size:12px;
	  font-family:"Courier New", Courier, monospace;
  }
	.mydialog
	{
		font-size:14px;
	}
		.tabhide{
			visibility:hidden;
		}
		.tabshow{
			visibility:visible;
		}
	
		.tab{
			
			
			border:10px;
			border-color:#000;
			padding-top:10px;
			round-radius:10px;
			
			}
		
	</style>
    <script>

</script>
</head>
<body >

	<?php
	include('../maintheme/banner.php');
	?>

 <div id="center" class="ui-corner-all" >
   <br><br><br><br><br><br/>
   <div id="toolbar" class="ui-widget-header ui-corner-all" style="font-weight:bolder;height:25px;padding:10px;text-align:left;"> 
      <span style="">Event </span>
  	<p style="display: block;float: right;width: 120px;margin: -5 -10;padding: 0;font-size: 12px;">
   	<button id="graphevent" style="padding-top:2px;padding-bottom:2px;">Participation Graph</button>
	<button id="listevents" style="padding-top:2px;padding-bottom:2px;">All Events</button>
	<button id="addevent" style="padding-top:2px;padding-bottom:2px;">Add User</button>
    
	</p>
  </div>
  <div id="tabs">
 
  	<div id="tab1" class="tab tabhide" >
    <form id="frmoptions" method="post">
    <input name="eid" type="hidden" id="uid">
    <table  id="resultpane" width="88%" style="padding-left:10%;">
    <tr>
    <td colspan="6" class="ui-widget-header">
    All Events
    </td>
    
  </tr>
  <tr style="border-bottom:2px;border-bottom-color:#666;margin-bottom:2px;" >
    <td style="background-color:#F0F0F0">Name</td>
    <td style="background-color:#F0F0F0">Date</td>
    <td style="background-color:#F0F0F0">Entry fee</td>
    <td style="background-color:#F0F0F0">Expected Entries</td>
    <td style="background-color:#F0F0F0">Options</td>
    
        
    <td></td>
  </tr>
  <?php
  require_once('../settings/dbfunctions.php');
	  $querystring="select * from events order by eid";
		 $conn= DB\connect_db($config);
	 //$conn= DB\connect_db($config);
	 //$conn=555;
			if ($conn) {
							
					try
						{	
							$results1=DB\get_db($querystring,$conn);
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
	if($results1)
	{
		//print_r($results1);
		while($row = $results1->fetch(\PDO::FETCH_OBJ))
		{
				echo "<tr style=\"border-bottom:2px;border-bottom-color:#666;background-color:#\">";
    			echo "<td>&nbsp;".$row->name."</td>";
				echo "<td>".$row->edate."</td>";
				echo "<td>".$row->efee."</td>";
				echo "<td>".$row->expentries."</td>";
				echo "<td style=\"border-bottom:1px;border-color:#666\">";
  				
				//echo "&nbsp;&nbsp;<a href=\"#\">      <span class=\"ui-icon ui-icon-trash\" style=\"-webkit-transform: scale(1.5);\"></span></a></td>";

				
				echo "<ul>
    					<li style=\"float:right;position:absolute;margin: -15 -30;\"><a class=\"btnedit\"title=\"Edit User's Details\" href=\"#\" name=\"".$row->eid."\" >      <span class=\"ui-icon ui-icon-pencil\" style=\"-webkit-transform: scale(1.5);\"></span></a></li>
    					<li style=\"float:right;position:absolute;margin: -15 20;\"><a name=\"".$row->eid."\" class=\"btndel\"title=\"Delete this User\" href=\"#\" >     <span class=\"ui-icon ui-icon-trash\" style=\"-webkit-transform: scale(1.5);\"></span></a></li>
    				</ul>";
			
  				echo "</td></tr>";
		}
	}
?>
    </table>
    
    </form>
    <table width="88%" style="padding-left:10%;">
      <tr>

        <td colspan="6">&nbsp;</td>
        
      </tr>
    </table>


    </div>
    <div id="tab2" class="tab tabhide">
    <form id="formaddu" method="post" action="events.php?opt=addu">
   <table  id="resultpane" width="88%" style="padding-left:15%;border:1px;border-color:#999;">
    <tr>
    <td colspan="9" class="ui-widget-header">
    Add Event
    </td>
    
  </tr>
  
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Name</td>
      	<td> <input type="text" name="eventname" id="eventname" class="" style="width:250px" placeholder="Event name" onKeyPress="return isAlphabet(event)"></td>
        
  </tr>
  
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Event Date</td>
      	<td> <input type="text" name="eventdate" id="eventdate" class="" style="width:180px" placeholder="Event Date" onKeyPress="return isEmailid(event)"></td>
       
  </tr>
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Entry Fee</td>
      	<td> <input type="text" name="entryfee" id="entryfee" class="" style="width:180px" placeholder="Entry fee"></td>
        
  </tr>
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Expected Entries</td>
      	<td><input type="text" name="expentry" id="expentry" class="" style="width:180px" placeholder="Enter value" ></td>
        
  </tr>
  <tr >
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
    	<td></td>
      	
        <td></td>
        
  </tr>
  <tr>
    <td colspan="8" align="center">&nbsp;</td>
  </tr>
  <tr>
  
    	<td colspan="8" align="center">
        <a href="#" id="btnadd" class="ui-state-default ui-corner-all" style="padding:5px;text-decoration:none;">
	    <!--<span class="ui-icon  ui-icon-circle-plus white"></span>-->&nbsp;Add</a>&nbsp;&nbsp;&nbsp;
        <a href="#" id="btnacancel" class="ui-state-default ui-corner-all" style="padding:5px;text-decoration:none;">
	    <!--<span class="ui-icon  ui-icon-circle-plus white"></span>-->&nbsp;Cancel</a>
        </td>
      
       
  </tr>
  <span class="ui-icon-signal-diag"></span>
  <?php
  /*
  require_once('../settings/dbfunctions.php');
	  $querystring="select * from system_users order by role,username";
		 $conn= DB\connect_db($config);
	 //$conn= DB\connect_db($config);
	 //$conn=555;
			if ($conn) {
							
					try
						{	
							$results1=DB\get_db($querystring,$conn);
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
	if($results1)
	{
		//print_r($results1);
		while($row = $results1->fetch(\PDO::FETCH_OBJ))
		{
				echo "<tr style=\"border-bottom:2px;border-bottom-color:#666;background-color:#\">";
    			echo "<td>&nbsp;".$row->username."</td>";
				echo "<td>".$row->name."</td>";
				echo "<td>".$row->email."</td>";
				echo "<td>".$row->role."</td>";
				echo "<td style=\"border-bottom:1px;border-color:#666\"><a href=\"#\">Edit</a></td>";
  				echo "</tr>";
		}
	}
*/?>
    </table>
    </form>
    </div>
    
    <div id="tab3" class="tab tabhide" >
    <form id="formeditu" method="post" action="events.php?opt=save" >
    <?php if($resultedit){?>
   <table  id="resultpane" width="88%" style="padding-left:15%;border:1px;border-color:#999;">
    <tr>
    <td colspan="9" class="ui-widget-header">
    Edit User Details
    </td>
    
  </tr>
  
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Name</td>
      	<td> <input type="text" name="ename1" id="ename1" value="<?php 	echo "$resultedit->name";?>" class="" style="width:250px" placeholder="Event name" onKeyPress="return isAlphabet(event)"></td>
        
  </tr>
  
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Event Date </td>
      	<td> <input type="text" name="eventdate1" id="eventdate1" value="<?php 	echo "$resultedit->edate";?>" class="" style="width:250px" placeholder="Event date" onKeyPress="return isEmailid(event)"></td>
       
  </tr>
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Entry Fee</td>
      	<td> <input type="text" name="efee1" id="efee1" class="" value="<?php 	echo "$resultedit->efee";?>" style="width:180px" placeholder="" ></td>
        
  </tr>
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Expected Entries</td>
      	<td><input type="text" name="expentry1" id="expentry1" class="" style="width:180px" value="<?php 	echo "$resultedit->expentries";?>" placeholder="enter password" ></td>
        
  <tr >
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
    	<td></td>
      	<input name="eid1" type="hidden" value="<?php 	echo "$resultedit->eid";?>">
        <td></td>
        
  </tr>
  <tr>
    <td colspan="8" align="center">&nbsp;</td>
  </tr>
  <tr>
  
    	<td colspan="8" align="center">
        <a href="#" id="btnedit" class="ui-state-default ui-corner-all" style="padding:5px;text-decoration:none;">
	    <!--<span class="ui-icon  ui-icon-circle-plus white"></span>-->&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
        <a href="#" id="btnecancel" class="ui-state-default ui-corner-all" style="padding:5px;text-decoration:none;">
	    <!--<span class="ui-icon  ui-icon-circle-plus white"></span>-->&nbsp;Cancel</a>
        </td>
      
       
  </tr>
  </table>
  <?php } ?>
  </form>
   
  </div>
</div>
<div id="tab4" class="tab tabhide" style="text-align:center">

<ul style="list-style:none;text-align:left;width:80%;padding-left:10%;z-index:-1;">
  <?php
 $querystring="select * from events order by eid";
		 $conn= DB\connect_db($config);
	 //$conn= DB\connect_db($config);
	 //$conn=555;
			if ($conn) {
							
					try
						{	
							$resultspro=DB\get_db($querystring,$conn);
							if($resultspro)
								{
									//print_r($results1);
									while($row = $resultspro->fetch(\PDO::FETCH_OBJ))
									{
										echo "<li style=\"margin-bottom:20px;\">".$row->name."<div class=\"progressbar\" style=\"height:20px;\"></div></li>";
									}
	} 
					}catch(Exception $e)
					{
						$exp=1;
						$msg='some Server error encountered..';
						//$msg=$e->getMessage();
					}
			
			}
	
  
  ?>
  
</ul>
<br><br><br>
</div>
</div>
   <div id="dialogadd" class="tabhide mydialog" title="Message" style="font-size:12px">
	<p>Are you sure you want to add new event</p>
</div>
<div id="dialogedit" title="Message" class="tabhide mydialog" style="font-size:12px">
	<p>Are you sure you want to save changes</p>
</div>
<div id="dialogdel" class="tabhide mydialog" title="Message" style="font-size:12px">
	<p>Are you sure you want to delete event</p>
</div>
<div id="dialog-modal" title="Message" style="font-size:12px">
	<p><?php 
	
	
		if(isset($_REQUEST['opt']))
			{
					if(strcmp($_REQUEST['opt'],"del")==0)
						echo $msgdelete;
					else if(strcmp($_REQUEST['opt'],"addu")==0)
						echo $msgadd;
					else if(strcmp($_REQUEST['opt'],"save")==0)
						echo $msgup;
								
				

			
			}
			
		
		
	
	?></p>
    
<br><br><br><br>
</div>
   <?php include("../theme/bottom.html");?>
<script src="../script/jquery.js" type="text/javascript"></script>
<script src="../script/jquery.ui.core.js" type="text/javascript"></script>
<script src="../script/jquery.ui.widget.js" type="text/javascript"></script>


<script src="../script/jquery.ui.mouse.js"></script>
	<script src="../script/jquery.ui.draggable.js"></script>
	<script src="../script/jquery.ui.position.js"></script>
	<script src="../script/jquery.ui.resizable.js"></script>
	<script src="../script/jquery.ui.button.js"></script>
	<script src="../script/jquery.ui.dialog.js"></script>
    	<script src="../script/jquery.ui.progressbar.js"></script>
<script src="../script/jquery.ui.datepicker.js" type="text/javascript"></script>
 <script src="../script/themejs.js" type="text/javascript"></script>
  <script src="../script/keyvalidations.js" type="text/javascript"></script>

<script>

	$(function() {
		$( "#dialog-modal" ).dialog({
		
			autoOpen: false,
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
				
			}
			
		});
		$( "#eventdate" ).datepicker({
			
			//minDate: -20,
			minDate: "+0D" ,
			
		});
		$( "#eventdate1" ).datepicker({
			
			//minDate: -20,
			minDate: "+0D" ,
			
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
		$( "#listevents" ).button({
			text: false,
			icons: {
				primary: "ui-icon-script"
			},
			click: function() {
					$("tab1").show();
				}
		});
		$( "#addevent" ).button({
			text: false,
			icons: {
				primary: "ui-icon-plus"
			},
			click: function() {
					$("tab2").show();
				}
		});
		$( "#graphevent" ).button({
			text: false,
			icons: {
				primary: "ui-icon-signal"
			},
			click: function() {
					$("tab4").show();
				}
		});
	
		//end of button setting
		
		function colapseall(aa,bb)
		{
			var i;
			for (i=1;i<=bb;i++)
			{
				var nm="#tab"+i;
				if(i!=aa)
						$(nm).hide();
			}
			var nm1="#tab"+aa;
			$(nm1).fadeIn();
		}
		//end of colapse
		
			colapseall(1,4);
		
		
		$( "#listevents" ).click(function(){
			colapseall(1,4);
			//$("#tab2").show();
		});
		$( "#addevent" ).click(function(){
			colapseall(2,4);
		});
		$( "#graphevent" ).click(function(){
			colapseall(4,4);
		});
	$( ".btnedit" ).click(function(){
		
						var nm=$(this).attr("name");
						$('#uid').attr("value",nm);
						$('#frmoptions').attr("action","events.php?opt=edit");
						$('#frmoptions').submit();
				
			
		});
			$( ".btndel" ).click(function(){
					var nm=$(this).attr("name");
					$('#uid').attr("value",nm);
					$('#frmoptions').attr("action","events.php?opt=del");
					$( "#dialogdel" ).dialog( "open" );
		});
			$( "#btnecancel" ).click(function(){
						colapseall(1,3);
			});
			$( "#btnacancel" ).click(function(){
								colapseall(1,3);
			});
					$( "#btnadd" ).click(function(){
						$( "#dialogadd" ).dialog( "open" );
			
			});		$( "#btnedit" ).click(function(){
					$( "#dialogedit" ).dialog( "open" );
			});	
	
	<?php
				 if(isset($_REQUEST['opt']))
					 {
	 						if(strcmp($_REQUEST['opt'],"edit")==0)
								{
									echo("colapseall(3,4);");
									echo ("$(\"#tab3\").removeClass('tabhide');");
									echo ("$(\"#tab3\").addClass('tabshow');");
								}
							//echo ("$(\"#dialogadd\").addClass('tabshow');");
							echo ("$(\"#dialogedit\").addClass('tabshow');");
							//echo ("$(\"#dialogdel\").addClass('tabshow');");
					 }
		
		
		?>
	
		
		$( "#dialogadd" ).dialog({
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
					
					$( "#formaddu" ).submit();	
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$( "#dialogedit" ).dialog({
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
										$( "#formeditu" ).submit();
							
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$( "#dialogdel" ).dialog({
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
					
					$('#frmoptions').submit();
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

		<?php
		if($resultspro)
		
		echo "$( \"#tab4 div\" ).progressbar({
			\"value\":50,
				
		});";
		?>
	
		$("#tab3").removeClass('tabhide');
		$("#tab3").addClass('tabshow');
		$("#tab2").removeClass('tabhide');
		$("#tab2").addClass('tabshow');
		$("#tab4").addClass('tabshow');
		$("#tab1").addClass('tabshow');
		$("#dialogadd").addClass('tabshow');
		$("#dialogdel").addClass('tabshow');
		//$( "#dialog-modal" ).dialog( "open" );
			<?php
	
	
	
		if(isset($_REQUEST['opt']))
			{
					if(strcmp($_REQUEST['opt'],"del")==0||strcmp($_REQUEST['opt'],"addu")==0||strcmp($_REQUEST['opt'],"save")==0)
										echo("$( \"#dialog-modal\" ).dialog( \"open\" );");
				

			
			}
			
		
		
	?>

	
	});
</script>
<script>

		
		
</script>
</body>
</html>