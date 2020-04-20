<?php
$hash = '$2y$10$LO.JaB2hoDQ/YCtf9BsVpeoRVNNNnZAHQcA2ABWvPkoRB/4U5KpAe';
if (password_verify('kcb529', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

?>