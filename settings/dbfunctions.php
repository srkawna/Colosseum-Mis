<?php namespace Web\DB;
require_once('../settings/config.php');
function connect_db($config)
{
	try {
		$conn = new \PDO($config['db_driver'].':host='.$config['hostname'].';dbname='.$config['database'],
						$config['username'],
						$config['password']);

		$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $conn;
	} catch(Exception $e) {
		return false;
	}
}


function query_db($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings);

	$results = $stmt->fetch(\PDO::FETCH_OBJ);

	return $results ? $results : false;
}
function select_db($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings);

	$results = $stmt;

	return $results ? $results : false;
}

function insert_db($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	
	$stmt->execute($bindings);
	
	return true;
}
function get_db($qry, $conn)
{
	try {
		$result = $conn->query($qry);

		return ( $result->rowCount() > 0 )
			? $result
			: false;
	} catch(Exception $e) {
		return false;
	}

}
