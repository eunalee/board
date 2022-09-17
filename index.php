<?php
require_once './dbConnection.php';

session_start();
?>
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
		<?php 
			$conn = dbConnect('dbBoard');

			/**
			 * 페이징
			 */
			$pagePerList = 5;									// 한 페이지당 게시글 수
			$blockPerPage = 2;									// 한 블럭당 페이지 수
			$page = isset($_GET['page']) ? $_GET['page'] : 1;	// 현재 페이지

			// 게시글 전체 갯수 조회
			$query = 'SELECT COUNT(*) AS total FROM tBoardList';
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$totalCount = $row['total'];

			$totalPage = ceil($totalCount/$pagePerList);		// 전체 페이지 수
			$totalBlcok = ceil($totalPage/$blockPerPage);		// 전체 블럭 수
			$block = ceil($page/$blockPerPage);					// 현재 블럭
			$startPage = ($block - 1) * $blockPerPage + 1;		// 블럭당 시작 페이지 
			if($startPage <= 0) {
				$startPage = 1;
			}
			$endPage = $block*$blockPerPage;					// 블럭당 마지막 페이지
			if($endPage > $totalPage) {
				$endPage = $totalPage;
			}

			$prevBlock = $block - 1;							// 이전 블럭
			$prevBlockPage = $prevBlock * $blockPerPage;		// 이전 블럭 페이지

			$nextBlock = $block + 1;								// 다음 블럭
			$nextBlockPage = ($nextBlock - 1) * $blockPerPage + 1;	// 다음 블럭 페이지 


			// 게시글 조회
			$offset = ($page - 1) * $pagePerList;
			$query = "SELECT tb.nListSeq, tb.sTitle, tb.sContent, tb.dtCreateDate, tb.emDisplayYN, tb.nHit, tm.sId FROM tBoardList tb LEFT OUTER JOIN dbMember.tMember tm ON tb.nMemberSeq=tm.nMemberSeq WHERE tb.emDisplayYN='Y' ORDER BY nListSeq DESC limit $offset, $pagePerList";
			$result = mysqli_query($conn, $query);

		?>
		<ul class="list-group">
			<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) : ?>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold"><?php echo $row['sTitle']; ?></div>
					<?php echo $row['sId']; ?> | <?php echo date('Y.m.d.', strtotime($row['dtCreateDate'])); ?>
				</div>
				<span class="badge bg-primary rounded-pill"> <?php echo $row['nHit']; ?></span>
			</li>
			<?php endwhile; ?>
		</ul>
		<nav aria-label="Page navigation example">
			<ul class="pagination">
				<?php if($prevBlock > 0) : ?>
				<li class="page-item"><a class="page-link" href="/board/index.php?page=<?php echo $prevBlockPage; ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
				<?php endif; ?>

				<?php for($i=$startPage; $i<=$endPage; $i++) : ?>
				<li class="page-item<?php echo ($i == $page) ? ' active' : ''; ?>"><a class="page-link" href="/board/index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				<?php endfor; ?>

				<?php if($nextBlock <= $totalBlcok) : ?>
				<li class="page-item"><a class="page-link" href="/board/index.php?page=<?php echo $nextBlockPage; ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
				<?php endif; ?>
			</ul>
		</nav>
		<a class="btn btn-primary" href="/board/writeListForm.php" role="button">글쓰기</a>
		<footer></footer>
	</body>
</html>
