<?php


function deleteUser($mysqli, $uid)
{
    $sql = "DELETE FROM `users` WHERE `uid` = ?";
    $mysqli_stmt = $mysqli->prepare($sql);
    $mysqli_stmt->bind_param('i', $uid);
    if ($mysqli_stmt->execute()) {
        echo "<script>alert('删除成功!');window.location.href='../../views/admin/index.html'</script>";
    }
}
