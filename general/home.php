
<?php
include("../theme/req_function.php");
require_once('../settings/dbfunctions.php');
use Web\DB;
?>
<html>
<head>
	<title>MIS- Home</title>
    <?php
    include("../theme/req_css.html");
	?>
    
<style>
<link href="../style/homestyle.css" rel="stylesheet" type="text/css">
.quick ul li a 
		{
			display:block;

			text-decoration:none;
			width:120px;;
			
			height: 90px;
			vertical-align:middle;
			padding:8px;
			text-align:center;
			font-size:20px;
			color: #838383;
			font-family:"Courier New", Courier, monospace
			
			
		}
#menubar1 {
	display: block;
	padding: 5px;
	height: 75px;
	width: 100%;
	position: fixed;
	
	top: 0px;
	text-align:right;
	color: #000;
	left: 0 px;
	right: 0px;
	border: 1px inset #066;
	opacity:0.9;
	box-shadow:7px 10px 10px #999;
	
}
#menubar1 ul {
	margin-right: 10px;
	margin-left: 10px;
	list-style-type: none;
	font-size: medium;
	position: fixed;
	left: 20%;
	width:70%;
	right: ;
}


#menubar1 li
{
	
	display: block;
	float:left;
	height: 100px;
	width: 200px;
		margin: 10px;
	
	font-size:36px;
	padding: 10px;
	color: #000000;
		border-radius:8px;
	font-weight: bold;
}
</style>
</head>
<body >
	<?php
	include('../theme/banner_menu.php');
	
	?>
    
    <div id="center" style="z-index:-3">
   <br><br><br><br><br>
   <ul style="list-style:none;">
   <li style="display: block;
float: left;
width: 170px;
margin: 0 15px 0 0;
padding: 0;">
   <ul id="graph" style="list-style:none;text-align:left;width:250%;padding-left:10%">
  <?php
  $event=array();
 $querystring="select * from events order by eid";
		 $conn= DB\connect_db($config);
 $querystring="select * from events order by eid";
		 $conn= DB\connect_db($config);
	 //$conn= DB\connect_db($config);
	 //$conn=555;
			if ($conn) {
				$querystring1="select * from events order by eid";
											 $conn1= DB\connect_db($config);
										 //$conn= DB\connect_db($config);
										 //$conn=555;
										 $conn= DB\connect_db($config);
											if ($conn) {
												
												$results=DB\get_db("select eid,count(*) from participants group by eid",$conn);
												if($results)
												{	
											 
													foreach($results as $i)
													{

															$event[] =array($i[0]=>$i[1]);
														
													}
												}
											}								
					try
						{	
							
//							print_r($event);
							$resultspro=DB\get_db($querystring,$conn);
							if($resultspro)
								{$i=0;
								//$redemo=$resultspro;
									//print_r($results1);
									while($row = $resultspro->fetch(\PDO::FETCH_OBJ))
									{
										$redemo[]=array('eid'=>$row->eid,'exp'=>$row->expentries);
										$per=0;
										$ee=0;
										if(isset($event[$i][$row->eid]))
											$ee=$event[$i][$row->eid];
											
											if($ee==0)
												$per=0;
											else					
												$per=($ee/$row->expentries)*100;
											$i=$i+1;			
											$percentage[]=$per;		
															echo "<li style=\"margin-bottom:20px;\">".$row->name."<div id=\"pro".$row->eid."\" class='ui-progressbar' title=\"".$per."%\" style=\"margin-bottom:20px;height:20px;text-align:center;\"></div></li>";
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
	</li>
    <li class="quick" style="display: block;
float: right;

margin: 0 15px 0 0;
padding: 0;
">
    		 <ul style="list-style:none;margin-top:0px;
	float:right;
	list-style-type: none;
	width:120px;
	color:#CCC;">       <li><a href="../general/addentry.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-circle-plus white" style="background-image: url(../style/images/ui-icons_888888_256x240.png); -webkit-transform: scale(1.5); text-align: center;"></span></td></tr></table>Add</a></li>

     
      
      
 	  </ul>
    </li>
    
    
    
    
    
    <li style="display: block;
float: right;

margin: 0 15px 0 0;
padding: 0;
">
    		 <ul style="list-style:none;margin-top:0px;
	float:right;
	list-style-type: none;
	width:120px;
	color:#CCC;"> 
       <li><a href="search.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-search white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Search</a></li>
   
 	  </ul>
    </li>
    
    
    </ul>

   </div>
 
    
    
    
<br><br><br><br>
   <?php include("../theme/bottom.html");?>



<script src="../script/jquery.js" type="text/javascript"></script>
 <script src="../script/themejs.js" type="text/javascript"></script>
 
<script src="../script/jquery.ui.core.js" type="text/javascript"></script>
<script src="../script/jquery.ui.widget.js" type="text/javascript"></script>
<script src="../script/jquery.ui.progressbar.js" type="text/javascript"></script>
<script src="../script/themejs.js" type="text/javascript" type="text/javascript"></script>

<script>

$(document).ready(function(e) {

//$('#showpane').animate({left:'0.1px',},400);

	$('#shadow').animate({top:'-110px;'});
	//$('#shadow').animate({height:'100px'});
	
   $('#showpane').hide();
 
           
	$('#refresh').mouseover(function(e) {
        $('#main').addClass('shadow'); 
    });
  			       
  
	$('#refresh').mouseout(function(e) {
        $('#main').removeClass('shadow'); 
    });
  
  	
  	$('#dashboard li').mouseover(function(e) {
       $(this).addClass('menushadow'); 
    });
	$('#dashboard li').mouseout(function(e) {
       $(this).removeClass('menushadow'); 
    });
	



	

<?php
$qq=10;
$QQ="#pro"."17";
echo "$( \"".$QQ."\" ).progressbar({
			\"value\":".$percentage[0].",
				
		});";
	if(is_array($redemo))
		{
			
			$q=0;
			foreach($redemo as $qq)
				{
					
					$QQ="#pro".$qq['eid'];
					echo "$( \"".$QQ."\" ).progressbar({
								\"value\":".$percentage[$q].",
									
		});";
		//echo "$( \"".$QQ."\" ).css({
			//		\"background\": '#' + Math.floor( Math.random() * 16777215 ).toString( 16 )
				//});";

								
						$q=$q+1;
						
				}
		}
			
				
		
		//		

							
					
		echo "$( \"#graph div\" ).removeClass('ui-corner-all');";
		?>
});
</script>
</body>
</html>