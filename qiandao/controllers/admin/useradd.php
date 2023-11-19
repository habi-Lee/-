<?php
include_once "../../models/core_mysql.php";
//mysql 事务
header('content-type:text/html;charset=utf-8');


$uid = (int) $_GET["workNumber"];
$username = $_GET["username"];

//执行增加学生的操作
useradd($mysqli, $uid, $username);

//useradd() 新增学生
function useradd($mysqli, $uid, $username)
{

    $sql = "INSERT INTO users(uid , username) VALUES(?,?)";
    $mysqli_stmt = $mysqli->prepare($sql); //准备预处理语句

    if ($uid == null || $username == null) {
        //非空判断
        echo "<script>alert('学号或姓名不能为空！');window.location.href='../../views/admin/useradd.html'</script>";
        exit;
    } else {
        //s 代表 string 类型,i 代表 int
        $mysqli_stmt->bind_param('is', $uid, $username);
        //执行预处理语句
        if ($mysqli_stmt->execute()) {
            echo PHP_EOL;
            echo "<script>window.location.href='../../views/admin/feedback.html'</script>";
        } else {
            echo $mysqli_stmt->error; //执行失败，错误信息
        }
    }

}



$mysqli->close();
