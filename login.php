<?php
require_once './dbConnection.php';

$id = $_POST['id'];
$password = $_POST['password'];
$url = $_POST['url'];

$conn = dbConnect('dbMember');
$query = "SELECT * FROM tMember WHERE sId='$id'";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

session_start();
if(password_verify($password, $row['sPassword'])) {		// 로그인 성공
	// 세션 생성
	$_SESSION['memberSeq'] = $row['nMemberSeq'];
	$_SESSION['id'] = $row['sId'];

	echo "<script>location.href='$url';</script>";
}
else {
	echo "<script>alert('로그인 실패'); location.href='/board/index.php';</script>";
}
?>