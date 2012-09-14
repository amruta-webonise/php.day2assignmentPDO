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
	FetchObject($pdoObject,$sql);
	FetchClass($pdoObject,$sql);
	ErrorHandling($pdoObject);

	//connection close
    	$pdoObject = null;

}
catch(PDOException $Exception_name)
{
	echo $Exception_name->getMessage();
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
	echo 'Array fetching=><br/>';
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
	echo 'Associative fetching=><br/>';
	$statement = $pdoObject->query($sql);

	$AssociativeArr = $statement->fetch(PDO::FETCH_ASSOC);

	Display($AssociativeArr);
}

function FetchNumArray($pdoObject,$sql)
{
	echo 'FETCH_NUM=><br/>';
	$statement = $pdoObject->query($sql);
	$NumArr = $statement->fetch(PDO::FETCH_NUM);

	Display($NumArr);

}

function FetchBothArray($pdoObject,$sql)
{
	echo 'FETCH_BOTH=><br/>';
	$statement = $pdoObject->query($sql);
	$BothArr = $statement->fetch(PDO::FETCH_BOTH);
	Display($BothArr);
}

function FetchObject($pdoObject,$sql)
{  
	$statement = $pdoObject->query($sql);
	$AssessmentObject = $statement->fetch(PDO::FETCH_OBJ);
	echo 'FETCH_object=><br/>';
	echo $AssessmentObject->question_no;
	echo '<br/>';
	echo $AssessmentObject->question;
	echo '<br/>';
	echo $AssessmentObject->answer;
	echo '<br/>';
	echo '<br/>';
	echo '<br/>';
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

class Assessment
{

	public $question_no;

	public $question;

	public $answer;

	public function UpperCase()
	{
 		return strtoupper($this->question);
	}

}

function FetchClass($pdoObject,$sql)
{  

    $statement = $pdoObject->query($sql);

    $AssessmentObj = $statement->fetchALL(PDO::FETCH_CLASS, 'Assessment');
	echo 'FETCH_class=><br/>';
    foreach($AssessmentObj as $Assessment)
    {
        echo $Assessment->UpperCase();
	echo '<br/>';
    } 
	echo '<br/>';
	echo '<br/>';
	echo '<br/>';
}

function ErrorHandling($pdoObject)
{

	$pdoObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$ErrSQL = "SELECT hostname FROM assessment";
        foreach ($pdoObject->query($ErrSQL) as $row)
        {
        	print $row['question'] .' - '. $row['answer'] . '<br />';
        }
	echo '<br/>';
	echo '<br/>';
	echo '<br/>';

}


?>
