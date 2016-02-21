<?php
const ACCESS = TRUE;
include_once "../config.php";
include_once "../core/model/Model_User.php";
include_once "../core/model/MySQL.php";
$ob = Model_User::get_instance();
echo json_encode($ob->get_sub_category((int)$_GET['id']));
