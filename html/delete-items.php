<?php
    session_start();
    include 'conn.php';
    echo $user_id = $_SESSION['userid'];
    echo $prod_id = $_GET['prod_id'];
    $sql = $conn->prepare("DELETE FROM prod_relation WHERE prod_owner = ? AND prod = ? LIMIT 1;");
    $sql->bind_param("ii", $user_id, $prod_id);
    $sql->execute();
    echo "done";
?>