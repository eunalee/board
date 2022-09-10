window.onload = () => {
	const form = document.getElementById('signupForm');
	form.addEventListener('focusout', (event) => {
		formValidate(event.target);
	});
}


// 폼 검증
const formValidate = (obj) => {
	obj.classList.remove('is-valid');
	console.log(obj.nextSibling);
	console.log(obj.previousSibling);
//	obj.parent().find('.invalid-feedback').text('');
	const formValue = obj.value;
	const formId = obj.id;
	
	/*const result = checkForm(formId, formValue);
	if(result != '') {
		obj.classList.add('is-invalid');
		obj.parent().find('.invalid-feedback').text(result);
	} else {
		obj.classList.remove('is-invalid').add('is-valid');
	}*/
	//const formId = obj.attr('id');
	/*obj.removeClass('is-valid');
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
	}*/
};

const checkForm = (id, value) => {
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