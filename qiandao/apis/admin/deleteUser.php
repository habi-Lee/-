<?php
include_once "../../models/core_mysql.php";
include_once "../../controllers/admin/deleteUser.php";

$uid = (int)$_GET['uid'];
deleteUser($mysqli,$uid);