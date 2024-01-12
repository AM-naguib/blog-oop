<?php
require_once "../../app/config.php";
$helper->admin_view();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $sanitizer->sanitiz($_POST["category"]);
    $erorrs = [];
    if($validation->required_input($category)) {
        $erorrs[] = "Category is required";
    }elseif($validation->min_length($category, 3)) {
        $erorrs[] = "Category must be at least 3 characters";
    }elseif($validation->max_length($category, 100)) {
        $erorrs[] = "Category must be less than 100 characters";
    }
    $data = ["name" => $category];
    if(empty($erorrs)) {
        if($db->dbInsert("categories", $data)){
            $_SESSION["success"] = ["Category added successfully"];
        }else{
            $_SESSION["erorrs"] = ["Something went wrong"];
        }
    }else{
        $_SESSION["erorrs"] = $erorrs;
    }
    header("location: ". URL . "views/dash/categories/add.php");
    
}