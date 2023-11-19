<?php
include_once "../../models/core_mysql.php";
$username =  $_GET["username"];
$uid = (int)$_GET["workNumber"];

//查询到用户的uid后返回，然后再更据返回的uid更新数据库信息
$rsUid = getUserIsExist($mysqli, $uid, $username);
$rsUid = (int)$rsUid;

updateSign($mysqli, $rsUid);

//查询是否存在该用户，如果存在则更新数据库显示今天已经完成签到
function getUserIsExist($mysqli, $uid, $username)
{
    $sql = "SELECT uid FROM users WHERE uid = ? and username = ?";
    $mysqli_stmt = $mysqli->prepare($sql);

    $mysqli_stmt->bind_param('is', $uid, $username);
    if ($mysqli_stmt->execute()) {
        //bind_result() 绑定结果集中的值到变量
        $mysqli_stmt->bind_result($uid);
        $res = $mysqli_stmt->fetch();
        //遍历结果集
        if ($res != null) {
            echo '学号: ' . $uid;
        } else {
            echo "<script>window.location.href='../../views/office/failed.html';</script>";
            return null;
        }
    }
    //释放结果集
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
    return $uid;
}

//执行云签到更新打卡时间和状态
function updateSign($mysqli, $uid)
{
    $isSign = 1;
    $sql = "UPDATE users SET is_sign = ? , sign_time = ? WHERE uid = ?";$isSign = 1; //表示今天打卡了
    date_default_timezone_set('Asia/Shanghai');
    $bj_time=new DateTime('now',new DateTimeZone('Asia/Shanghai'));
    $bj_time_str=$bj_time->format('Y-m-d H:i:s');

    $mysqli_stmt = $mysqli->prepare($sql);
    $mysqli_stmt->bind_param('isi', $isSign, $bj_time_str, $uid);
    if ($mysqli_stmt->execute()) {
        echo PHP_EOL;
        //window.location.href js控制跳转到新页面
        echo "<script>window.location.href='../../views/office/feedback.html';</script>";
    } else {
        echo $mysqli_stmt->error; //执行失败，错误信息
    }
}


$mysqli->close();
