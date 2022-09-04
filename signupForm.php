<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>게시판 사용자 등록</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	</head>
	<body>
		<script>
			$(document).ready(function() {
				$('input').last().focusout(function() {
					formValidate();
				});
			});

			// 폼 검증
			let formValidate = function() {
				let flag = false;
				if($('#id').val() != '') {
					flag = true;
				}
				if($('#password').val() != '') {
					flag = true;
				}
				if($('#passwordCheck').val() != '') {
					flag = true;
				}
				if($('#name').val() != '') {
					flag = true;
				}

				if(flag) {
					$('#joinBtn').attr('disabled', false);
				}
			};
		</script>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="/board/index.php">BOARD</a>
			</div>
		</nav>
		<body>
			<form class="row g-3" method="post" action="/board/signup.php">
				<div class="mb-3">
					<label for="formGroupExampleInput" class="form-label">아이디</label>
					<input type="text" class="form-control is-valid" name="id" placeholder="영문 4자 이상, 최대 20자">
				</div>
				<div class="mb-3">
					<label for="formGroupExampleInput" class="form-label">비밀번호</label>
					<input type="text" class="form-control is-invalid" name="password" placeholder="숫자, 영문, 특수문자 포함 최소 8자 이상">
					<div class="invalid-feedback">Please enter a message in the textarea.</div>
				</div>
				<div class="mb-3">
					<label for="formGroupExampleInput" class="form-label">비밀번호 확인</label>
					<input type="text" class="form-control" name="passwordCheck" placeholder="숫자, 영문, 특수문자 포함 최소 8자 이상">
				</div>
				<div class="mb-3">
					<label for="formGroupExampleInput" class="form-label">이름</label>
					<input type="text" class="form-control" name="name" placeholder="한글 8자, 영문 16자까지 가능">
				</div>
				<div class="mb-3">
					<button type="submit" class="btn btn-primary" id="joinBtn" disabled>회원가입</button>
				</div>
			</form>
		</body>
		<footer></footer>
	</body>
</html>