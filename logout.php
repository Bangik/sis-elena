<?php

require_once "config/init.php";

session_destroy();
setcookie('hashenc','', time() - 604800);
setcookie('00keys','', time() - 604800);
header('Location: login.php');

?>
