<?php

//action.php


require_once('db.php');

$query = "SELECT * FROM `subject`";

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		$query = "
		INSERT INTO subject (subject_name, categories) VALUES ('".$_POST["first_name"]."', '".$_POST["last_name"]."')
		";
		$statement = $conn->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		$query = "
		SELECT * FROM subject WHERE subject_id = '".$_POST["id"]."'
		";
		$statement = $conn->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['first_name'] = $row['subject_name'];
			$output['last_name'] = $row['categories'];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		$query = "
		UPDATE subject 
		SET subject_name = '".$_POST["first_name"]."', 
		categories = '".$_POST["last_name"]."' 
		WHERE subject_id = '".$_POST["hidden_id"]."'
		";
		$statement = $conn->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM subject WHERE subject_id = '".$_POST["id"]."'";
		$statement = $conn->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
}

?>