<?php
require_once './dbConnection.php';

date_default_timezone_set('Asia/Seoul');
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['memberSeq'] > 0) {
	$memberSeq = $_POST['memberSeq'];
	$title = filter($_POST['title']);
	$content = filter($_POST['content']);
	$createTime = date('Y-m-d H:i:s');
	$updateTime = date('Y-m-d H:i:s');
	$displayYN = 'Y';
	$hit = 0;

	$conn = dbConnect('dbBoard');
	// 데이터 입력 이스케이핑
	$title = mysqli_real_escape_string($conn, $title);
	$content = mysqli_real_escape_string($conn, $content);
	$query = "INSERT INTO tBoardList (nMemberSeq, sTitle, sContent, dtCreateDate, dtUpdateDate, emDisplayYN, nHit) VALUES ($memberSeq, '$title', '$content', '$createTime', '$updateTime', '$displayYN', '$hit')";
	$result = mysqli_query($conn, $query);

	if($result) {
		echo "<script>alert('게시글 등록 성공'); location.href='/board/index.php';</script>";
	}
}
else {
	echo "<script>alert('게시글 등록 실패'); location.href='/board/index.php';</script>";
}

function filter($data) {
	$data = trim($data);
	$data = htmlspecialchars($data);

	return $data;
}
?>