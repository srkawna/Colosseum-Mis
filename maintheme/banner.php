<?php
require_once('../settings/dbfunctions.php');
	use Web\DB;
		
?>
<style>
#slider a{
	font-size:14px;
	float:left;
	font-weight:bold;
	height:80px;
	}
	
#slider li{

}
</style>
  <link rel="stylesheet" href="../style/jquery.ui.all.css" type="text/css">
    <link rel="stylesheet" href="../style/jquery.ui.theme.css" type="text/css">
    <link rel="stylesheet" href="../style/jquery-ui.css" type="text/css">
    <link href="../style/jquery.ui.menu.css" rel="stylesheet" type="text/css">
    
    
    
<div class="ui-widget-header" id="menubar" >
    <div style="font-size: 32px; left: 25px;top:10px; font-family: 'CHE LIVES!', Starcraft;position:absolute;">COLOSSEUM
    
    <div style="font-size:15px;font-family:'Courier New', Courier, monospace;">Management System</div>
    </div>
    <p style="position:absolute;top:30px;left:49%">
   <a href="../main/home.php"> <span class="ui-icon  ui-icon-home" style="background-image: url(../style/images/ui-icons_222222_256x240.png);-webkit-transform: scale(1.5);" ></a>
   </p>
   
    </div>
    <?php /*
    $conn= DB\connect_db($config);
	if ($conn) {
		$results=DB\query_db("select * from system_users where username=:id",array('id' => $_SESSION['username']),$conn);
		if($results)	 
     	 $imagepath="../users/".$_SESSION['username']."/".$results->pro_pic;
		else
		 $imagepath="../users/images/defaultuser.jpg";
		
   }*/
    ?>
    <div id="pane" >
     <!--<img id="pane" src="users/<?php //echo $_SESSION['username']."/";echo $pic; ?>" width="10px" height="100%" >
     -->
    </div>
    <div id="showpane" >
 
    
   <!--slider menu-->
      <ul id="slider">
      <li><a href="../main/users.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-person white" style="background-image: url(../style/images/ui-icons_888888_256x240.png); -webkit-transform: scale(1.5); text-align: center;"></span></td></tr></table>Users</a></li>
      
	  <li><a href="vol.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-contact white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Volunteers</a></li>
      
      <li><a href="participants.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-flag white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Participants</a></li>
       <li><a href="events.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-star white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Events</a></li>
        <li><a href="notify.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-alert white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Notification<br />center</a></li>
         <li><a href="analytics.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-signal white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Analytics</a></li>
      
      <li><a href="../settings/logout.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-locked white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Logout</a></li>
 	  </ul>
    </div>