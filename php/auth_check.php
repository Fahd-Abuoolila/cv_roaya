<?php
include "session.php";
if (!isset($_SESSION['csrf_token'])) {
    header("Location: login");
    exit;
}
?>
