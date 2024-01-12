<?php
require_once "../../app/config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_name = $$sanitizer->sanitiz->sanitiz($_POST["c_name"]);
    $c_content = $$sanitizer->sanitiz->sanitiz($_POST["c_content"]);
    $pid = $$sanitizer->sanitiz->sanitiz($_POST["p_id"]);
    $c_date = date("Y-m-d H:i:a");
    $erorrs = [];

    if ($validation->required_input($c_name)) {
        $erorrs = "Please Enter Your Name";
    } elseif ($validation->min_length($c_name, 3)) {
        $erorrs = "Name Must Be At Least 3 Characters";
    } elseif ($validation->max_length($c_name, 50)) {
        $erorrs = "Name Must Be At Most 50 Characters";
    }

    if ($validation->required_input($c_content)) {
        $erorrs = "Please Enter Your Name";
    } elseif ($validation->min_length($c_content, 3)) {
        $erorrs = "Name Must Be At Least 3 Characters";
    } elseif ($validation->max_length($c_content, 200)) {
        $erorrs = "Name Must Be At Most 200 Characters";
    }

    if (empty($erorrs)) {
        $data = [
            "c_name" => $c_name,
            "c_content" => $c_content,
            "c_date" => $c_date,
            "c_post_id" => $pid,
        ];
        $result = $db->dbInsert("comments", $data);
        if ($result) {
            $_SESSION["success"] = ["Comment Added"];
        } else {
            $_SESSION["error"] = ["Something Went Wrong"];
        }

    } else {
        $_SESSION["error"] = $erorrs;
    }

    header("location:" . $_SERVER['HTTP_REFERER']);

}