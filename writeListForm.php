<?php
session_start();
if(!isset($_SESSION['memberSeq'])) :
	$url = '/board/loginForm.php?url=' . urlencode($_SERVER['PHP_SELF']);
	echo "<script>location.href='$url';</script>";
else :
	$id = $_SESSION['id'];
endif;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>게시판 글쓰기</title>
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
						<span class="nav-link"><?php echo $id; ?>님</span>
						<a class="nav-link" href="/board/logout.php">로그아웃</a>
					</div>
				</div>
			</div>
		</nav>
		<body>
			<form class="row g-3" method="post" action="">
				<div class="mb-3">
					<label for="formGroupExampleInput" class="form-label">제목</label>
					<input type="text" class="form-control" name="title" placeholder="제목을 입력해주세요.">
				</div>
				<div class="mb-3">
					<label for="formGroupExampleInput" class="form-label">내용</label>
					<textarea class="form-control is-invalid" id="validationTextarea" placeholder="내용을 입력해주세요." required></textarea>
					<div class="invalid-feedback">Please enter a message in the textarea.</div>
				</div>
				<div class="mb-3">
					<button type="reset" class="btn btn-primary">취소</button>
					<button type="submit" class="btn btn-primary">등록</button>
				</div>
			</form>
		</body>
		<footer></footer>
	</body>
</html>
