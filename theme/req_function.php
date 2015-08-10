<?php
session_start();
if(!isset($_SESSION['username']))
		header("location:../index.php");
		
require_once('../settings/dbfunctions.php');
	use Web\DB;
?>