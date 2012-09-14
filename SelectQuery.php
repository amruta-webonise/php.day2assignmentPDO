<?php

$HostName = 'localhost';

$User = 'root';

$Password = 'root';

try {

$pdoObject = ConnectToDatabase();

 $sql = "SELECT * FROM assessment";
 FetchArray($pdoObject,$sql);

   //connection close
    $pdoObject = null;
    }

	catch(PDOException $e)
    {
    echo $e->getMessage();
    }

function ConnectToDatabase()
{
try{
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
  echo 'Array fetching<br/>';
    foreach ($pdoObject->query($sql) as $row)
        {
        print $row['question'] .' - '. $row['answer'] . '<br />';
        }

    $stmt = $pdoObject->query($sql);
}
?>
