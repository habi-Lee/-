<?php
include_once "../../models/core_mysql.php";

//管理员账户，密码
$adminName = $_POST['adminName'];
$adminPasswd = $_POST['adminPasswd'];

getAdmin($mysqli, $adminName, $adminPasswd);
//检查管理员的信息是否存在，用来判断登录是否成功
function getAdmin($mysqli, $adminName, $passwd)
{
    $sql = "SELECT admin_name FROM admins WHERE admin_name =  ? and passwd = ?";
    $mysqli_stmt = $mysqli->prepare($sql);

    $mysqli_stmt->bind_param('ss', $adminName, $passwd);
    if ($mysqli_stmt->execute()) {
        //bind_result() 绑定结果集中的值到变量
        $mysqli_stmt->bind_result($adminName);

        $res = $mysqli_stmt->fetch();

        //遍历结果集
        if ($res) {
            $_SESSION['adminName'] = $adminName;
            //登录成功就跳转
            echo "<script>window.location.href='../../views/admin/index.html'</script>";
        } else {
            echo "<script>alert('登录失败！');window.location.href='../../views/admin/login.html'</script>";
        }
    }
    //释放结果集
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}


$mysqli->close();
