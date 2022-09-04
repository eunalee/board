<?php
require_once './dbConnection.php';

$id = $_POST['id'];
$password = md5($_POST['password']);
$name = $_POST['name'];

$conn = dbConnect('dbMember');
$query = "SELECT * FROM tMember WHERE sId='$id' and sPassword='$password'";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if(!empty($row)) {		// 로그인 성공
	echo "<script>alert('회원가입 성공! 로그인 필요'); location.href='/board/index.php';</script>";
}
else {
	echo "<script>alert('회원가입 실패'); location.href='/board/signupForm.php';</script>";
}
?>