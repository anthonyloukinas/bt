<?php
  //init variables needed to connect to database
  $dsn = 'mysql:host=192.3.32.227; dbname=butler_tech';
  $db_user = 'lantech';
  $db_pass = 'lantech!';

  try{
    //create an instance of the PDO class with the required parameters
    $db = new PDO($dsn, $db_user, $db_pass);

    //set PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //display success message
    //echo "Successfully made connection to the database";
  }
  catch(PDOException $e){
    echo "Connection to the database failure " .$e->getMessage();
  }
?>
