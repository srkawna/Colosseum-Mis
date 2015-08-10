<?php
require_once('../settings/dbfunctions.php');
	use Web\DB;
		
?>
<div class="ui-widget-header" id="menubar" >
    <div style="font-size: 32px; left: 25px;top:10px; font-family: 'CHE LIVES!', Starcraft;position:absolute;">COLOSSEUM
    
    <div style="font-size:15px;font-family:'Courier New', Courier, monospace;">Management System</div>
    </div>
    <p style="position:absolute;top:30px;left:49%">
   <a href="../general/home.php"> <span class="ui-icon  ui-icon-home" style="background-image: url(../style/images/ui-icons_222222_256x240.png);-webkit-transform: scale(1.5);" ></a>
   </p>
   
    </div>
    <?php
	$imagepath="";
    $conn= DB\connect_db($config);
	if ($conn) {
		$results=DB\query_db("select * from system_users where username=:id",array('id' => $_SESSION['username']),$conn);
		if($results)	 
			if(strcmp($results->pro_pic,"")==0)
			$imagepath="../users/images/defaultuser.jpg";
			else
			$imagepath="../users/".$_SESSION['username']."/".$results->pro_pic;
		
		 
		
   }
    ?>
    <div id="pane" >
     <!--<img id="pane" src="users/<?php //echo $_SESSION['username']."/";echo $pic; ?>" width="10px" height="100%" >
     -->
    </div>
    <div id="showpane" >
      <img id="imgpro" src="<?php
		echo $imagepath;?>" width="100px" height="100px" style="box-shadow:1px 1px 35px 10px #383838 inset;opacity:0.9; z-index: 50;margin-top:10px"><br>
      
      
      <p id="shadow" style="top: -110px;
opacity: 1.0;
box-shadow: 1px 1px 30px 10px #383838 inset;
width: 100px;
height: 10px;
display: block;
position: relative;
background: none;
margin: 10px;
z-index: 100;"></p>
    
      <!--slider menu-->
      <ul>
      <li><a href="../general/addentry.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-circle-plus white" style="background-image: url(../style/images/ui-icons_888888_256x240.png); -webkit-transform: scale(1.5); text-align: center;"></span></td></tr></table>Add</a></li>
      
	  <li><a href="search.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-search white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Search</a></li>
      
      <li><a href="#"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-person white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Profile</a></li>
      
      <li><a href="../settings/logout.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-locked white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Logout</a></li>
 	  </ul>
    </div>