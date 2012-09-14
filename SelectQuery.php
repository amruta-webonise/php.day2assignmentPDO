<?php

class Pdo_test
{



	public function __construct($host,$user,$pass)
	{
		echo 'in constructor</br>';
		$HostName = $host;
		$User = $user;
		$Password = $pass;
	}

	function ConnectToDatabase()
	{

	$HostName = 'localhost';
 
	$User = 'root';

	$Password = 'root';
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
		foreach($AssociativeArr as $index=>$value)
		{
			echo $index.' => '.$value.'<br />';
		}
		echo '<br/>';
		echo '<br/>';
		echo '<br/>';
		//$pdo_Oject->Display($AssociativeArr);
	}

	function FetchNumArray($pdoObject,$sql)
	{
		echo 'FETCH_NUM=><br/>';
		$statement = $pdoObject->query($sql);
		$NumArr = $statement->fetch(PDO::FETCH_NUM);

		foreach($NumArr as $index=>$value)
		{
			echo $index.' => '.$value.'<br />';
		}
		echo '<br/>';
		echo '<br/>';
		echo '<br/>';

	}

	function FetchBothArray($pdoObject,$sql)
	{
		echo 'FETCH_BOTH=><br/>';
		$statement = $pdoObject->query($sql);
		$BothArr = $statement->fetch(PDO::FETCH_BOTH);
		foreach($BothArr as $index=>$value)
		{
			echo $index.' => '.$value.'<br />';
		}
		echo '<br/>';
		echo '<br/>';
		echo '<br/>';
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

	function ErrorHandling($pdoObject)
	{

		try{
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
   		catch(PDOException $e)
    		{
    		echo $e->getMessage();
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

	function PrepareStatement($pdoObject)
	{
	
		$question_no = 1;

   		$PrepareStatement = $pdoObject->prepare("SELECT * FROM assessment WHERE question_no = :question_no");

    		$PrepareStatement->bindParam(':question_no', $question_no, PDO::PARAM_INT);
   		    
    		$PrepareStatement->execute();

      		$result = $PrepareStatement->fetchAll();
		echo '<br/>';
		echo '<br/>';
		echo '<br/>';
		echo 'Prepared statement where question_no=1 =><br/>';
        	foreach($result as $row)
        	{
        		echo $row['question_no'].'<br />';
        		echo $row['question'].'<br />';
        		echo $row['answer'];
        	}
		echo '<br/>';
		echo '<br/>';
		echo '<br/>';
	}

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


	$pdo_Oject = new Pdo_test();

	$pdoObject = $pdo_Oject->ConnectToDatabase();
	$sql = "SELECT * FROM assessment";

	$pdo_Oject->FetchArray($pdoObject,$sql);
	$pdo_Oject->FetchAssociativeArray($pdoObject,$sql);
	$pdo_Oject->FetchNumArray($pdoObject,$sql);
	$pdo_Oject->FetchBothArray($pdoObject,$sql);
	$pdo_Oject->FetchObject($pdoObject,$sql);
	$pdo_Oject->FetchClass($pdoObject,$sql);
	$pdo_Oject->ErrorHandling($pdoObject);
	$pdo_Oject->PrepareStatement($pdoObject);

	//connection close
    	$pdoObject = null;


?>
