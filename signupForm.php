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
				$('input').focusout(function() {
					formValidate($(this));
				});
			});

			// 폼 검증
			let formValidate = (obj) => {
				obj.removeClass('is-valid');
				obj.parent().find('.invalid-feedback').text('');

				let formValue = obj.val();
				let formId = obj.attr('id');
				let result = checkForm(formId, formValue);
				console.log(result);
				console.log(typeof result);

				if(result != '') {
					obj.addClass('is-invalid');
					obj.parent().find('.invalid-feedback').text(result);
				} else {
					obj.removeClass('is-invalid').addClass('is-valid');
				}

				// 모든 input 에 is-valid 클래스가 있는 경우에만 가입버튼 활성화
				let flag = false;
				let cnt = 0;
				$('input').each(function() {
					if($(this).hasClass('is-valid')) {
						cnt += 1;
					}

					flag = (cnt === $('input').length) ? true : false;
				});

				if(flag) {
					$('#joinBtn').attr('disabled', false);
				} else {
					$('#joinBtn').attr('disabled', true);
				}
			};

			let checkForm = (id, value) => {
				let message = '';

				if(id === 'id') {
					if(value === '') {
						message = '아이디를 입력해 주세요.';
					}
					else if(/[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/.test(value)) {
						message = '한글이 포함되어 있습니다.';
					}
					else if(value.length < 4 || value.length > 20) {
						message = '최소 4자 , 최대 20 자 입니다.';
					}
					else if(!/^[a-zA-Z]/.test(value)) {
						message = '첫글자는 영문이어야 합니다.';
					}
					else if(!/[a-zA-Z0-9~,./\\]{4,20}$/.test(value)) {
						message = '허용되지 않는 문자열이 포함되어 있습니다.';
					}
				}

				if(id === 'password') {
					if(value === '') {
						message = '비밀번호를 입력해 주세요.';
					}
					else if(value.length < 8) {
						message = '너무 짧습니다. 최소 8자 이상 입력하세요.';
					}
					else if(!/^(?=.*[a-zA-Z])(?=.*[!@#$%^&*])(?=.*[0-9]).{8,}$/.test(value)) {
						message = '영문과 숫자와 특수문자를 조합해서 입력해 주세요.';
					}
					else if(!/[!@#$%^&*]/.test(value)) {
						message = '특수문자는 !, @, #, $, %, ^, &, * 만 가능합니다.';
					}
				}

				if(id === 'passwordCheck') {
					if(value === '') {
						message = '비밀번호 확인을 입력해 주세요.';
					}
					else if($('#password').val() !== value) {
						message = '비밀번호가 일치하지 않습니다.';
					}
				}

				if(id === 'name') {
					if(value === '') {
						message = '이름을 입력해 주세요.';
					}
					else if(!/[a-zA-Z가-힣]/.test(value)) {
						message = '이름은 한글, 또는 영문만 입력할 수 있습니다.';
					}
					/*else if(!/[가-힣]{1,8}/.test(value) || !/[a-zA-Z]{1,16}/.test(value)) {
						message = '한글 8자, 영문 16자까지 가능합니다.';
					}*/
				}

				return message;
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
					<input type="text" class="form-control" id="id" name="id" placeholder="영문 4자 이상, 최대 20자">
					<div class="invalid-feedback"></div>
				</div>
				<div class="mb-3">
					<label for="formGroupExampleInput" class="form-label">비밀번호</label>
					<input type="text" class="form-control" id="password" name="password" placeholder="숫자, 영문, 특수문자 포함 최소 8자 이상">
					<div class="invalid-feedback"></div>
				</div>
				<div class="mb-3">
					<label for="formGroupExampleInput" class="form-label">비밀번호 확인</label>
					<input type="text" class="form-control" id="passwordCheck" name="passwordCheck" placeholder="숫자, 영문, 특수문자 포함 최소 8자 이상">
					<div class="invalid-feedback"></div>
				</div>
				<div class="mb-3">
					<label for="formGroupExampleInput" class="form-label">이름</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="한글 8자, 영문 16자까지 가능">
					<div class="invalid-feedback"></div>
				</div>
				<div class="mb-3">
					<button type="submit" class="btn btn-primary" id="joinBtn" disabled>회원가입</button>
				</div>
			</form>
		</body>
		<footer></footer>
	</body>
</html>