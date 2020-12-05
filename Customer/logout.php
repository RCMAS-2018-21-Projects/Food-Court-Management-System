<?php
session_start();
require('database.inc.php');
include('function.inc.php');
unset($_SESSION['USER_LOGIN']);
unset($_SESSION['USER_NAME']);
redirect('../login_register.php');
?>