<?php
class Helper
{
    public function admin_view()
    {
        if ($_SESSION["user"]["u_role"] != 1) {
            header("location:" . URL . "views/dash/login.php");
            die();
        }
    }

    public function checkUserRole()
    {
        $userRole = $_SESSION["user"]["u_role"];
        $allowedRoles = [1, 2];

        if (!in_array($userRole, $allowedRoles)) {
            session_destroy();
            header("location:" . URL . "views/dash/login.php");
            exit();
        }
    }

    public function alert_display($key, $class)
    {
        if (isset($_SESSION[$key])) {
            foreach ($_SESSION[$key] as $value) {
                echo "<div class='alert alert-$class'>$value</div>";
            }
            unset($_SESSION[$key]);
        }
    }



}

