<?php
require_once "../../../app/config.php";
require_once MAIN_PATH . "views/dash/inc/header.php";
$helper->admin_view()
?>

<div class="container">
    <div class="row">
        <h1 class="text-center my-5">
            Edit Category
        </h1>
        <div class="col-6 mx-auto">
            <?php
            $helper->alert_display("success", "success");
            $helper->alert_display("erorrs", "danger");
            ?>
            <form action="<?= URL . "src/categories/update.php" ?>" class="mt-5 border p-5" method="POST">
                <div class="mb-3">
                    <label for="">Edit Category</label>
                    <input type="text" name="cat_name" class="form-control" value="<?= $_GET["cat_name"] ?>">
                    <input type="hidden" name="cat_id"  value="<?= $_GET["cat_id"] ?>">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>