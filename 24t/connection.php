<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "24t";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO student (stud_fname, stud_lname, stud_email, stud_usrn, stud_pass) 
    VALUES (:firstname, :lastname, :stud_email, :stud_usrn, :stud_pass )");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':stud_email', $s_email);
    $stmt->bindParam(':stud_usrn', $s_usrn);
    $stmt->bindParam(':stud_pass', $s_pass);

    // insert a row
    $firstname = "John";
    $lastname = "Doe";
    $s_email = "john@example.com";
    $s_usrn = "john123";
    $s_pass =  "password";
    $stmt->execute();

    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
?>