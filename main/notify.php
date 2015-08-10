<?php
include("../theme/req_function.php");
?>
<html>
<head>
	<title>MIS- Home</title>
	<?php
    include("../theme/req_css.html");
	?>
    <style>
	
		
		
		
	</style>
    <script>

</script>
</head>
<body >

	<?php
	include('../maintheme/banner.php');
	?>

 <div id="center">
   <br><br><br><br><br>
   <div id="toolbar" class="ui-widget-header ui-corner-all" style="font-weight:bolder;height:25px;padding:10px;text-align:left;"> 
      <span style=""> User Management</span>
  	<p style="display: block;float: right;width: 160px;margin: -5 -10;padding: 0;font-size: 12px;">
	<button id="listuser" style="padding-top:2px;padding-bottom:2px;">All Users</button>
	<button id="adduser" style="padding-top:2px;padding-bottom:2px;">Add User</button>
    <button id="searchuser" style="padding-top:2px;padding-bottom:2px;">Search User</button>
	<button id="deluser" style="padding-top:2px;padding-bottom:2px;">Delete User</button>
	</p>
  </div>
   </div>
<script src="../script/jquery.js" type="text/javascript"></script>
<script src="../script/jquery.ui.core.js" type="text/javascript"></script>
<script src="../script/jquery.ui.widget.js" type="text/javascript"></script>
<script src="../script/jquery.ui.button.js" type="text/javascript"></script>
 <script src="../script/themejs.js" type="text/javascript"></script>

<script>
$(function() {
		$( "#listuser" ).button({
			text: false,
			icons: {
				primary: "ui-icon-all"
			}
		});
		$( "#adduser" ).button({
			text: false,
			icons: {
				primary: "ui-icon-plus"
			}
		});
		$( "#deluser" ).button({
			text: false,
			icons: {
				primary: "ui-icon-trash"
			}
		});
		
		$( "#searchuser" ).button({
			text: false,
			icons: {
				primary: "ui-icon-search"
			}
		});
	});
</script>
</body>
</html>