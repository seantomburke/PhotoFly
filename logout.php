<?php
session_start();
require_once ('inc/global_fns.php');

unset($_SESSION);
$result_dest = session_destroy();

header("Location: index.php");
?>
