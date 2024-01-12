<?php
require_once "../../app/config.php";
require_once MAIN_PATH . "views/dash/inc/header.php";
$categoris = $db->selectData(["tables" => ["categories"], "columns" => ["count(*)"]])[0];
$posts = $db->selectData(["tables" => ["posts"], "columns" => ["count(*)"]], "where p_approve=1")[0];
$posts_requests = $db->selectData(["tables" => ["posts"], "columns" => ["count(*)"]], "where p_approve=0")[0];
$comments = $db->selectData(["tables" => ["comments"], "columns" => ["count(*)"]])[0];
$users = $db->selectData(["tables" => ["users"], "columns" => ["count(*)"]])[0];
$helper->admin_view();
$dataArray = [
    "categories" => [
        "data" => $db->selectData(["tables" => ["categories"], "columns" => ["count(*)"]])[0],
        "path" => "views/dash/categories/"
    ],
    "posts" => [
        "data" => $db->selectData(["tables" => ["posts"], "columns" => ["count(*)"]], "where p_approve=1")[0],
        "path" => "views/dash/post/"
    ],
    "posts_requests" => [
        "data" => $db->selectData(["tables" => ["posts"], "columns" => ["count(*)"]], "where p_approve=0")[0],
        "path" => "views/dash/post/post_request.php"
    ],
    "comments" => [
        "data" => $db->selectData(["tables" => ["comments"], "columns" => ["count(*)"]])[0],
        "path" => "views/dash/comments/"
    ],
    "users" => [
        "data" => $db->selectData(["tables" => ["users"], "columns" => ["count(*)"]])[0],
        "path" => "views/dash/user/"
    ]
];
?>

<div class="container">
    <div class="row">
        <h1 class="text-center my-5 display-1 border-bottom p-3">Welcome
            <?php echo $_SESSION["user"]['u_name']; ?>
        </h1>

        <?php foreach ($dataArray as $key => $value): ?>
            <div class="col-6 mb-3">
                <a href="<?= URL . $value['path'] ?>" class="text-decoration-none">
                    <div class="card d-flex flex-column justify-content-center align-items-center p-5">
                        <h2 class="display-1 border-bottom pb-4">
                            <?php if ($key == "posts_requests"): ?>
                                <?= ucfirst(str_replace("_", " ", $key)) ?>
                            <?php else: ?>
                                <?= ucfirst($key) ?>
                            <?php endif ?>
                        </h2>
                        <p class="display-4">
                            <?= $value['data']["count(*)"] ?>
                        </p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>