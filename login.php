<?php
require_once "./v1/api/auth.php";
if (isset($_POST)) {
    extract($_POST);
    if (isset($email) && isset($password)) :
        $auth = new Auth();
        $userData = array(
            'email' => $email,
            'password' => crypt($password,$auth->key),
        );
        $auth->login($userData);
    else:
        echo 'error2';
    endif;
} else {
    echo 'error';
}
