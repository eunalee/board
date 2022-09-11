<?php
require_once './dbConnection.php';

$request = file_get_contents('php://input');
$param = json_decode($request, true);
$id = $param['id'];
//$id = $_POST['id'];

$conn = dbConnect('dbMember');
$query = "SELECT * FROM tMember WHERE sId='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$response = array('status' => 200, 'message' => '');
if(!empty($row)) {
	$response['message'] = '사용중이거나 탈퇴한 아이디입니다.';
}
echo json_encode($response);
?>