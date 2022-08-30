<?php
require_once './dbConnection.php';

$id = $_POST['id'];
$password = md5($_POST['password']);

$conn = dbConnect('dbMember');
$query = "select sPassword from tMember where sId='$id' and sPassword='$password'";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if(!empty($row)) {
	echo 'success';
} else {
	echo 'fail';
}
?>