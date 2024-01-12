<?php
require_once "../../app/config.php";
$helper->admin_view();
if($_SERVER["REQUEST_METHOD"] == "GET") {
    $erorrs = [];
    $category = $sanitizer->sanitiz($_GET["cat_id"]);
    if(!$db->if_exists("categories" , "WHERE id = '$category'")){
        $erorrs[] = "category not found";
    }

    if(empty($erorrs)){
        if($db->deleteItem("categories",$category)){
            $_SESSION["success"] = ["Category deleted successfully"];
        }else{
            $_SESSION["errors"] = ["Something went wrong" . mysqli_error($conn) ];
        }
    }else{
        $_SESSION["errors"] = $erorrs;
    }
    print_r($_SESSION);
    header("location: ". URL . "views/dash/categories/index.php");

}