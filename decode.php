<?php
include_once './v1/api/auth.php';
$auth = new Auth();
$auth->decodeToken($_GET['token']);
