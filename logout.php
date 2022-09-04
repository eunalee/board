<?php
session_start();
// 세션 제거
session_destroy();

echo "<script>location.href='/board/index.php';</script>";
?>