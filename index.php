<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>게시판</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="/board/index.php">BOARD</a>
				<?php
				if(!isset($_SESSION['memberSeq'])) :
					$url = '/board/loginForm.php?url=' . urlencode($_SERVER['PHP_SELF']);
				?>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<a class="nav-link" href="<?php echo $url; ?>">로그인</a>
						<a class="nav-link" href="/board/signupForm.php">회원가입</a>
					</div>
				</div>
				<?php
				else :
					$id = $_SESSION['id'];
				?>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<span class="nav-link"><?php echo $id; ?>님</span>
						<a class="nav-link" href="/board/logout.php">로그아웃</a>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</nav>
		<body>
			<table border="1">
				<tr>
					<th>No</th>
					<th>제목</th>
					<th>작성자</th>
					<th>작성일</th>
					<th>조회</th>
				</tr>
				<tr>
					<td>1</td>
					<td><a href="">ㅋㅋㅋㅋ</a></td>
					<td>admin</td>
					<td>2022.09.03</td>
					<td>1</td>
				</tr>
			</table>
			<a href="/board/writeListForm.php">글쓰기</a>
		</body>
		<footer></footer>
	</body>
</html>
