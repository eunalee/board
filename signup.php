<?php
require_once './dbConnection.php';

$id = $_POST['id'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$name = $_POST['name'];

$conn = dbConnect('dbMember');
$query = "INSERT INTO tMember(sName, sId, sPassword) VALUES ('$name', '$id', '$password')";
$result = mysqli_query($conn, $query);

if($result) {	// 회원가입 성공
	echo "<script>alert('회원가입 성공'); location.href='/board/index.php';</script>";
}
else {
	echo "<script>alert('회원가입 실패'); location.href='/board/index.php';</script>";
}
?>