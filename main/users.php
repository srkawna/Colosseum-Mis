<?php
include("../theme/req_function.php");
require_once('../settings/dbfunctions.php');
use Web\DB;
$resultedit="";
$msgdel="";
$msgadd="";
$msgup="";
 if(isset($_REQUEST['opt']))
 {
	 if(strcmp($_REQUEST['opt'],"del")==0)
		{	 //echo "uanme".$_POST['uid'];
				$conn= DB\connect_db($config);
		if ($conn) {
			$pid=101;
			$binding=array( //'pid'=>$pid,
							'uname' => $_POST['uid']
							);
							
				try
					{	
					$results=DB\select_db("delete from system_users where username=:uname",$binding,$conn);
					if($results)
							$msgdel= "user deleted successfully...";
			
				}catch(Exception $e)
				{
						$msgdel= 'some Server error encountered..';
					
				}
			
		}
		
		}
		if(strcmp($_REQUEST['opt'],"edit")==0)
		{	 //echo "uanme".$_POST['uid'];
				$conn= DB\connect_db($config);
		if ($conn) {
			
			$binding=array('uname' => $_POST['uid']	);
							
				try
					{	
					$resultedit=DB\query_db("select * from system_users where username=:uname",$binding,$conn);
					if($resultedit)
							echo "";
			
				}catch(Exception $e)
				{
						echo 'some Server error encountered..';
					
				}
			
		}
		
		}
		
		
		if(strcmp($_REQUEST['opt'],"addu")==0)
		{
			
			if(strcmp($_POST['password'],$_POST['conpassword']==0))
			{
				$conn= DB\connect_db($config);
						if ($conn) {
							
							$binding=array( //'pid'=>$pid,
											'name' => $_POST['name'],
											'email'=>$_POST['email'],
											'uname'=>$_POST['uname'],
											'password'=>$_POST['password'],
											'role'=>$_POST['role'],
											
											);
											
								try
									{	
									$results=DB\insert_db("insert into system_users(name,email,role,password,username) 					values(:name,:email,:role,:password,:uname)",$binding,$conn);
									if($results)
											$msgadd="User Added...";
							
								}catch(Exception $e)
								{
										$msgadd='some Server error encountered..';
										//$msg=$e->getMessage();
								}
							
						}
						
					

			}
			else
					$msgadd="passwords does not match";
			
					
						
		}
		
		
		if(strcmp($_REQUEST['opt'],"save")==0)
		{
					
						$conn= DB\connect_db($config);
						if ($conn) {
							
							$binding=array( 
											'name' => $_POST['name'],
											'email'=>$_POST['email'],
											'uname'=>$_POST['uname'],
											'password'=>$_POST['password'],
											'role'=>$_POST['role1'],
											);
											
								try
									{	
									$results=DB\insert_db("update system_users set 
									name=:name,email=:email,role=:role where username=:uname where password=:password",$binding,$conn);
									if($results)
										$msgup="User Updated ...";
							
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
      <span style=""> User Management</span>
  	<p style="display: block;float: right;width: 80px;margin: -5 -10;padding: 0;font-size: 12px;">
	<button id="listuser" style="padding-top:2px;padding-bottom:2px;">All Users</button>
	<button id="adduser" style="padding-top:2px;padding-bottom:2px;">Add User</button>
	</p>
  </div>
  <div id="tabs">
 
  	<div id="tab1" class="tab " >
    <form id="frmoptions" method="post">
    <input name="uid" type="hidden" id="uid">
    <table  id="resultpane" width="88%" style="padding-left:10%;">
    <tr>
    <td colspan="6" class="ui-widget-header">
    All Users
    </td>
    
  </tr>
  <tr style="border-bottom:2px;border-bottom-color:#666;margin-bottom:2px;" >
    <td style="background-color:#F0F0F0">Username</td>
    <td style="background-color:#F0F0F0">Name</td>
    <td style="background-color:#F0F0F0">Email Id</td>
    <td style="background-color:#F0F0F0">Role</td>
    <td style="background-color:#F0F0F0">Options</td>
    
        
    <td></td>
  </tr>
  <?php
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
				echo "<td style=\"border-bottom:1px;border-color:#666\">";
  				
				//echo "&nbsp;&nbsp;<a href=\"#\">      <span class=\"ui-icon ui-icon-trash\" style=\"-webkit-transform: scale(1.5);\"></span></a></td>";
				if(strcmp($_SESSION['username'],$row->username)==0)
				{
					echo "<ul>
    					<li style=\"float:right;position:absolute;margin: -15 -30;\"><a class=\"btnedit\"title=\"Edit User's Details\" href=\"#\" name=\"".$row->username."\" >      <span class=\"ui-icon ui-icon-pencil\" style=\"-webkit-transform: scale(1.5);\"></span></a></li>
    					<li style=\"float:right;position:absolute;margin: -15 20;\"><a name=\"".$row->username."\" class=\"btndel\"title=\"Delete this User\" href=\"#\" hidden>     <span class=\"ui-icon ui-icon-trash\" style=\"-webkit-transform: scale(1.5);\"></span></a></li>
    				</ul>";
				}
				else
				{	
					echo "<ul>
    					<li style=\"float:right;position:absolute;margin: -15 -30;\"><a class=\"btnedit\"title=\"Edit User's Details\" href=\"#\" name=\"".$row->username."\" >      <span class=\"ui-icon ui-icon-pencil\" style=\"-webkit-transform: scale(1.5);\"></span></a></li>
    					<li style=\"float:right;position:absolute;margin: -15 20;\"><a name=\"".$row->username."\" class=\"btndel\"title=\"Delete this User\" href=\"#\" >     <span class=\"ui-icon ui-icon-trash\" style=\"-webkit-transform: scale(1.5);\"></span></a></li>
    				</ul>";
				}
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
        <form id="formaddu" method="post" action="users.php?opt=addu" >
   <table  id="resultpane" width="88%" style="padding-left:15%;border:1px;border-color:#999;">
    <tr>
    <td colspan="9" class="ui-widget-header">
    Add User
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
      	<td> <input type="text" name="name" id="name" class="" style="width:250px" placeholder="name" onKeyPress="return isAlphabet(event)"></td>
        
  </tr>
  
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Email Id</td>
      	<td> <input type="text" name="email" id="email" class="" style="width:250px" placeholder="email" onKeyPress="return isEmailid(event)"></td>
       
  </tr>
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Username</td>
      	<td> <input type="text" name="uname" id="uname" class="" style="width:180px" placeholder="choose username"></td>
        
  </tr>
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Password</td>
      	<td><input type="password" name="password" id="password" class="" style="width:180px" placeholder="enter password" ></td>
        
  </tr><tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Confirm Password</td>
      	<td> <input type="password" name="conpassword" id="conpassword" class="" style="width:180px" placeholder="confirm password"></td>
        
  </tr><tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Role</td>
      	<td><input name="role" class="" type="radio" value="normal"  checked>Normal &nbsp;&nbsp;&nbsp;<input name="role" type="radio" value="admin">Administrator</td>
       
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
    <form id="formeditu" method="post" action="users.php?opt=save" >
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
      	<td> <input type="text" name="name" id="name" value="<?php 	echo "$resultedit->name";?>" class="" style="width:250px" placeholder="name" onKeyPress="return isAlphabet(event)"></td>
        
  </tr>
  
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Email Id</td>
      	<td> <input type="text" name="email" id="email" value="<?php 	echo "$resultedit->email";?>" class="" style="width:250px" placeholder="email" onKeyPress="return isEmailid(event)"></td>
       
  </tr>
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Username</td>
      	<td> <?php 	echo "$resultedit->username";?>
        <input name="uname" type="hidden" value="<?php 	echo "$resultedit->username";?>">
        </td>
        
  </tr>
  <tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Password</td>
      	<td><input type="password" name="password" id="password" class="" style="width:180px" placeholder="enter password" ></td>
        
  </tr><tr>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
    	<td>Role</td>
      	<td>
        <?php /*if(strcmp($resultedit->role,"normal"))
		        echo "<input name=\"role1\" class=\"\" type=\"radio\" value=\"normal\">Normal &nbsp;&nbsp;&nbsp;";
			else
        		echo"<input name=\"role1\" class=\"\" type=\"radio\" value=\"normal\" checked>Normal &nbsp;&nbsp;&nbsp;"
		 
		 
				if(strcmp($resultedit->role,"admin"))
       			 	echo"<input name=\"role1\" type=\"radio\" value=\"admin\" >Administrator";
        		else
                	echo"<input name=\"role1\" type=\"radio\" value=\"admin\" checked>Administrator";
    			 */?>   
                </td>
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
        <a href="#" id="btnedit" class="ui-state-default ui-corner-all" style="padding:5px;text-decoration:none;">
	    <!--<span class="ui-icon  ui-icon-circle-plus white"></span>-->&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
        <a href="#" id="btnecancel" class="ui-state-default ui-corner-all" style="padding:5px;text-decoration:none;">
	    <!--<span class="ui-icon  ui-icon-circle-plus white"></span>-->&nbsp;Cancel</a>
        </td>
      
       
  </tr>
  </table>
  <?php } ?>
  </form>
   
  <div>
</div>
   </div>
   <div id="dialogadd" class="tabhide mydialog" title="Message" style="font-size:12px">
	<p>Are you sure you want to add user</p>
</div>
<div id="dialogedit" title="Message" class="tabhide mydialog" style="font-size:12px">
	<p>Are you sure you want to save changes</p>
</div>
<div id="dialogdel" class="tabhide mydialog" title="Message" style="font-size:12px">
	<p>Are you sure you want to delete user</p>
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
		
		$( "#listuser" ).button({
			text: false,
			icons: {
				primary: "ui-icon-script"
			},
			click: function() {
					$("tab1").show();
				}
		});
		$( "#adduser" ).button({
			text: false,
			icons: {
				primary: "ui-icon-plus"
			},
			click: function() {
					$("tab2").show();
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
		
			colapseall(1,3);
		
		
		$( "#listuser" ).click(function(){
			colapseall(1,3);
			//$("#tab2").show();
		});
		$( "#adduser" ).click(function(){
			colapseall(2,3);
		});
	$( ".btnedit" ).click(function(){
		
						var nm=$(this).attr("name");
						$('#uid').attr("value",nm);
						$('#frmoptions').attr("action","users.php?opt=edit");
						$('#frmoptions').submit();
				
			
		});
			$( ".btndel" ).click(function(){
					var nm=$(this).attr("name");
					$('#uid').attr("value",nm);
					$('#frmoptions').attr("action","users.php?opt=del");
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
									echo("colapseall(3,3);");
									echo ("$(\"#tab3\").removeClass('tabhide');");
									echo ("$(\"#tab3\").addClass('tabshow');");
								}
							//echo ("$(\"#dialogadd\").addClass('tabshow');");
							echo ("$(\"#dialogedit\").addClass('tabshow');");
							//echo ("$(\"#dialogdel\").addClass('tabshow');");
					 }
		
		
		?>
		//$("#tab3").removeClass('tabhide');
		$("#tab3").addClass('tabshow');
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
					
												$('#formeditu').submit();
					
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
		$("#tab2").addClass('tabshow');
		$("#dialogadd").addClass('tabshow');
		$("#dialogdel").addClass('tabshow');
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