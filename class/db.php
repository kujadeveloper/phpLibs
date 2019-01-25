<?php
class db
{
	function db($host='',$dbname='',$user='',$psw='')
	{
		try 
		{	
	    	$db = new PDO("mysql:host=".$host.";dbname=".$dbname, $user, $psw,
	    		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_PERSISTENT=>false));
			$db->query("SET NAMES 'utf8'");
	    	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    	return $db;
		} 
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	function selectAll($sql,$array,$dbd)
	{
		$query = $dbd->prepare($sql);
		$query->execute($array);
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

}
?>