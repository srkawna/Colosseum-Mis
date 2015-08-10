<?php
session_start();
if(!isset($_SESSION['username']))
		header("location:index.php");
		
//echo "welcome " .$_SESSION['username'];
?>
<html>
<head>
	<title>MIS- Home</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
       <link rel="stylesheet" href="style/jquery.ui.all.css" type="text/css">
    <link rel="stylesheet" href="style/jquery.ui.theme.css" type="text/css">
    <link rel="stylesheet" href="style/jquery-ui.css" type="text/css">

    <link href="style/jquery.ui.menu.css" rel="stylesheet" type="text/css">
    <script>
function loadXMLDoc()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //Sdocument.getElementById("main").innerHTML=xmlhttp.responseText;
	document.getElementById("main").text=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","srk.txt",true);
xmlhttp.send();
}
</script>
</head>
<body >
	<div id="menubar" >
    <?php
    require 'dbfunctions.php';

  $conn=new \PDO('mysql:host=localhost;dbname=EMSystem',
            $config['username'],
            $config['password']);

  if ($conn) {

    $stmt = $conn->prepare("select * from users where user=:id");
    $stmt->execute(array('id' => $_SESSION['username']));

    $results = $stmt->fetch(\PDO::FETCH_OBJ); 
    //echo is_object($results);
    if(is_object($results)==1)
    { 
      $pic=$results->pro_pic;
      
     } 
   }
    ?>
    <p style="margin-right:15px;">
     <img id="pane" src="users/<?php echo $_SESSION['username']."/";echo $pic; ?>" width="50px" height="40px" ">
    </p>
    <div id="showpane" style="">
      <img src="users/<?php echo $_SESSION['username']."/";echo $pic; ?>" width="150px" height="135px" style="margin:10px;
      box-shadow:7px 7px 12px 12px #000000 inset;" >
      <table id="tableshow" style="margin:10px;margin-top:0px;">
  <tr>
    <td><a href="#"  ><table>
          <tr>
            <td><span class="ui-icon  ui-icon-person"   ></span></td>
            <td>Profile</td>
          </tr>
        </table></a>
     </td>
    <td>|</td>
    <td><a href="logout.php"><table>
          <tr>
             <td><span class="ui-icon  ui-icon-key"   ></span></td>
            <td>Logout</td>
          </tr>
        </table></a>
     </td>
  </tr>
</table>

     
    </div>
   
    
    
	

     </div>
    <div id="main">
    	<div id="leftpane" style="" ></div><vr>
        <div id="centerpane"></div>
    
    </div>
    <p style="position:absolute;top:30px;left:49%">
   <a href="home.php"> <span class="ui-icon  ui-icon-home" style="-webkit-transform: scale(2);" ></a>
   </p>
   
<script src="script/jquery.js" type="text/javascript"></script>
<script>
$(document).ready(function(e) {

	$('#showpane').hide();
	$('#refresh').mouseover(function(e) {
        $('#main').addClass('shadow'); 
    });
  			       
  
	$('#refresh').mouseout(function(e) {
        $('#main').removeClass('shadow'); 
    });
  
  	
  	$('#menubar li').mouseover(function(e) {
       $(this).addClass('menushadow'); 
    });
	$('#menubar li').mouseout(function(e) {
       $(this).removeClass('menushadow'); 
    });
	$('#pane').click(function(e) {
        $('#showpane').fadeIn(1000);
    });
	//$('#refresh').click().select('#main').addClass('shadow');
  $('#showpane').mouseleave(function(e) {
    $('#showpane').fadeOut(1000);
});

});
</script>
</body>
</html>