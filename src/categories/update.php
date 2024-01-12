<?php 

require_once "../../app/config.php";
$helper->admin_view();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $cat_id = $sanitizer->sanitiz($_POST["cat_id"]);
    $cat_name = $sanitizer->sanitiz($_POST["cat_name"]);
    $erorrs = [];
    if($validation->required_input($cat_name)) {
        $erorrs[] = "Category is required";
    }elseif($validation->min_length($cat_name, 3)) {
        $erorrs[] = "Category must be at least 3 characters";
    }elseif($validation->max_length($cat_name, 100)) {
        $erorrs[] = "Category must be less than 100 characters";
    }
    if(!$db->if_exists("categories" , "WHERE id = '$cat_id'")){
        $erorrs[] = "category not found";
    }
    if(empty($erorrs)) {
        $sql = "UPDATE categories SET name = '$cat_name' WHERE id = '$cat_id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $_SESSION["success"] = ["Category updated successfully"];
        }else{
            $_SESSION["errors"] = ["Something went wrong" . mysqli_error($conn) ];
        }
    }else{
        $_SESSION["errors"] = $erorrs;
    }
    header("location: ". URL . "views/dash/categories/index.php");
}