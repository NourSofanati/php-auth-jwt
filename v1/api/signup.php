<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/users.php';
if (isset($_POST)) {
    $users = new Users();
    extract($_POST);
    $users->name = $name;
    $users->email = $email;
    $users->password = $password;
    $users->birthday = $birthday;
    $users->phonenum = $phonenum;
    $users->gender = $gender;
    $users->create();
}