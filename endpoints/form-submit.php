<?php
if (isset($_POST['submitType'])) {
    include('../db/class.php');
    $db = new admin_class();
    if ($_POST['submitType'] == 'Login') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $login = $db->login($username, $password);
        if ($login->num_rows > 0) {
            $user = $login->fetch_assoc();
            session_start();
            $_SESSION['id'] = $user['ID'];
            echo 200;
        } else {
            echo 400;
        }
    }
}
