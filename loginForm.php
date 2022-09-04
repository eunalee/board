<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>게시판 로그인</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="/board/index.php">BOARD</a>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<a class="nav-link" href="/board/signupForm.php">회원가입</a>
					</div>
				</div>
			</div>
		</nav>
		<form class="row g-3" method="post" action="/board/login.php">
			<div class="mb-3">
				<input type="text" class="form-control" name="id" placeholder="아이디">
			</div>
			<div class="mb-3">
				<input type="password" class="form-control" name="password" placeholder="비밀번호">
			</div>
			<input type="hidden" name="url" value=<?php echo $_GET['url']; ?>>
			<div class="mb-3">
				<button type="submit" class="btn btn-primary" id="loginBtn">로그인</button>
			</div>
		</form>
		<footer></footer>
	</body>
</html>