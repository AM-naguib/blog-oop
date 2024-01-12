<?php
require_once "../../app/config.php";
$helper->admin_view();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $c_id = $sanitizer->sanitiz($_GET['c_id']);
    $erorrs = [];
    if (!$db->if_exists("comments", "where id = '$c_id'")) {
        $erorrs[] = "comment not found";
    }

    if (empty($erorrs)) {
        if ($db->deleteItem("comments", $c_id)) {
            $_SESSION['success'] = ["comment deleted"];
        } else {
            $_SESSION['errors'] = ["something went wrong"];
        }
    } else {
        $_SESSION['errors'] = $erorrs;
    }
    header("location:" . $_SERVER['HTTP_REFERER']);

}