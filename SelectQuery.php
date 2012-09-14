<?php

$HostName = 'localhost';

$User = 'root';

$Password = 'root';

try 
{
	$pdoObject = ConnectToDatabase();
	$sql = "SELECT * FROM assessment";
	FetchArray($pdoObject,$sql);
	FetchAssociativeArray($pdoObject,$sql);
	FetchNumArray($pdoObject,$sql);
	FetchBothArray($pdoObject,$sql);

	//connection close
    	$pdoObject = null;

}
catch(PDOException $e)
{
	echo $e->getMessage();
}


function ConnectToDatabase()
{
	try
	{
		$pdoObject = new PDO("mysql:host=$hostname;dbname=test", $User, $Password);
		echo 'Connection established with MySQL<br/>';
		return $pdoObject;
    	}
   	catch(PDOException $e)
    	{
    		echo $e->getMessage();
    	}

}


function FetchArray($pdoObject,$sql)
{
	echo '<br/>';
	echo '<br/>';
	echo '<br/>';
	echo 'Array fetching<br/>';
	foreach ($pdoObject->query($sql) as $row)
        {
        	print $row['question'] .' => '. $row['answer'] . '<br />';
        }
	echo '<br/>';
	echo '<br/>';
	echo '<br/>';
}


function FetchAssociativeArray($pdoObject,$sql)
{
	echo 'Associative fetching<br/>';
	$statement = $pdoObject->query($sql);

	$AssociativeArr = $statement->fetch(PDO::FETCH_ASSOC);

	Display($AssociativeArr);
}

function FetchNumArray($pdoObject,$sql)
{
	echo 'FETCH_NUM<br/>';
	$statement = $pdoObject->query($sql);
	$NumArr = $statement->fetch(PDO::FETCH_NUM);

	Display($NumArr);

}

function FetchBothArray($pdoObject,$sql)
{
	echo 'FETCH_BOTH<br/>';
	$statement = $pdoObject->query($sql);
	$BothArr = $statement->fetch(PDO::FETCH_BOTH);
	Display($BothArr);
}



function Display($Array)
{
	foreach($Array as $index=>$value)
	{
		echo $index.' => '.$value.'<br />';
	}
	echo '<br/>';
	echo '<br/>';
	echo '<br/>';

}

?>
