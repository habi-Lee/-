<?php
include_once "../../models/core_mysql.php";
unset($_SESSION['adminName']);
session_destroy();
echo "<script>alert('已经清除登录数据！');window.location.href='../../views/admin/index.html'</script>";