<?php
include_once 'resource/database.php';
include_once 'resource/utilities.php';

$id = $_GET['id'];

$removeQuery = 'DELETE FROM users WHERE id = :id';
$stmt = $db->prepare($removeQuery);
$stmt->execute(array('id' => $id));

redirectTo('users');

?>
