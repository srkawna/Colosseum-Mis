<?php
include("../theme/req_function.php");

require_once('../settings/dbfunctions.php');
use Web\DB;
$resultspro="";
$redemo="";
?>
<html>
<head>
	<title>MIS- Home</title>
	<?php
    include("../theme/req_css.html");
	?>
    <style>
		.query li
		{
			background-color:#CCC;
		}
		
		
		
	</style>
    <script>


</script>
</head>
<body >

	<?php
	include('../maintheme/banner.php');
	?>

 <div id="center" >
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
    <li style="display: block;
float: right;

margin: 0 15px 0 0;
padding: 0;
">
    		 <ul style="list-style:none"> <li><a href="../main/users.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-person white" style="background-image: url(../style/images/ui-icons_888888_256x240.png); -webkit-transform: scale(1.5); text-align: center;"></span></td></tr></table>Users</a></li>
      
	  <li><a href="vol.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-contact white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Volunteers</a></li>
      
      <li><a href="participants.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-flag white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Participants</a></li>
     
      
      
 	  </ul>
    </li>
    
    
    
    
    
    <li style="display: block;
float: right;

margin: 0 15px 0 0;
padding: 0;
">
    		 <ul style="list-style:none"> 
       <li><a href="events.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-star white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Events</a></li>
        <li><a href="notify.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-alert white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Notification<br />center</a></li>
         <li><a href="analytics.php"><br><table style="padding-left:45px;padding-bottom:5px;"><tr><td><span class="ui-icon  ui-icon-signal white" style="background-image: url(../style/images/ui-icons_888888_256x240.png);-webkit-transform: scale(1.5);"></span></td></tr></table>Analytics</a></li>
      
   
 	  </ul>
    </li>
    
    
    </ul>

   </div>
  
<script src="../script/jquery.js" type="text/javascript"></script>
<script src="../script/jquery.ui.core.js" type="text/javascript"></script>
<script src="../script/jquery.ui.widget.js" type="text/javascript"></script>
<script src="../script/jquery.ui.progressbar.js" type="text/javascript"></script>
<script src="../script/themejs.js" type="text/javascript" type="text/javascript"></script>

<script>
$(function() {
	

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


 <br>

   <?php include("../theme/bottom.html");?>
</body>
</html>