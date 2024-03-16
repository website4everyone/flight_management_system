<?php
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function is_logged_in() {
    return isset($_SESSION["username"]);
}

function redirect_if_not_logged_in() {
    if (!is_logged_in()) {
        header("Location: index.php");
        exit;
    }
}
?>
