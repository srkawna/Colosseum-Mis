<?php
session_start();
require_once('../settings/dbfunctions.php');
use Web\DB;
	$username=$_POST['uname'];
	$password=$_POST['passwd'];
	$conn= DB\connect_db($config);
	if ($conn) {
		$binding=array('id' => $username);
		$results=DB\query_db("select * from system_users where username=:id",$binding,$conn);
		if($results)
		{	
			if(strcmp($results->password,$password)==0)
			{	
			 	 	$_SESSION['username']=$username;
					if(strcmp($results->role,"normal")==0)
							header("location:../general/home.php");
					if(strcmp($results->role,"admin")==0)
							header("location:../main/home.php");
			 
			}else
			{
				session_destroy();
				header('location:../index.php?type=inpass');			
			}
		}
		else
		{
			session_destroy();
			header('location:../index.php?type=inuser');		
		}
			
	}
	else
	{
		echo "Connection lost";
		//die();
	}

?>

