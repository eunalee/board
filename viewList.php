<?php
require_once './dbConnection.php';

session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>게시글</title>
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
					$memberSeq = $_SESSION['memberSeq'];
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
			<?php
				$listSeq = $_GET['listSeq'];
				$page = $_GET['page'];

				$conn = dbConnect('dbBoard');

				// 조회수 증가
				$query = "UPDATE tBoardList SET nHit = nHit + 1 WHERE nListSeq=$listSeq";
				mysqli_query($conn, $query);

				// 게시글 상세 노출
				$query = "SELECT tb.nListSeq, tb.nMemberSeq, tb.sTitle, tb.sContent, tb.dtCreateDate, tb.emDisplayYN, tb.nHit, tm.sId FROM tBoardList tb LEFT OUTER JOIN dbMember.tMember tm ON tb.nMemberSeq=tm.nMemberSeq WHERE tb.nListSeq=$listSeq";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			?>
			<div class="card">
				<div class="card-header">
					<h5><?php echo $row['sTitle']; ?></h5>
					<p class="card-text"><?php echo $row['sId']; ?> | <?php echo date('Y.m.d. H:i:s', strtotime($row['dtCreateDate'])); ?> | <?php echo $row['nHit']; ?></p>
				</div>
				<div class="card-body">
					<div class="card-title">
					<?php echo str_replace('&lt;br&gt;', '<br>', $row['sContent']); ?>
					</div>
				</div>
			</div>
			<a href="/board/index.php?page=<?php echo $page; ?>" class="btn btn-primary">목록</a>
			<?php if(isset($memberSeq) && in_array($memberSeq, array(1, $row['nMemberSeq']))) : ?>
			<a href="#" class="btn btn-primary">수정</a>
			<a href="#" class="btn btn-primary">삭제</a>
			<?php endif; ?>

			<p class="lead"></p>
			<div class="list-group">
				<a href="#" class="list-group-item list-group-item-action" aria-current="true">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">작성자</h5>
						<small>작성일자</small>
					</div>
					<p class="mb-1">This is the first item's accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables.</p>
				</a>
				<a href="#" class="list-group-item list-group-item-action" aria-current="true">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">작성자</h5>
						<small>작성일자</small>
					</div>
					<p class="mb-1">This is the first item's accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables.</p>
				</a>
				<form class="list-group-item list-group-item-action" method="post" action="/board/writeList.php" id="commentForm">
					<div class="mb-3">
						<label for="formGroupExampleInput" class="form-label">댓글</label>
						<textarea class="form-control" id="comment" name="comment" placeholder="댓글을 입력해주세요."></textarea>
					</div>
					<input type="hidden" id="memberSeq" name="memberSeq" value="<?php echo isset($memberSeq) ? $memberSeq : 0; ?>">
					<div class="mb-3">
						<button type="reset" class="btn btn-primary">취소</button>
						<button type="button" class="btn btn-primary" id="insertBtn">등록</button>
					</div>
				</form>
			</div>
		</body>
		<footer></footer>
	</body>
</html>