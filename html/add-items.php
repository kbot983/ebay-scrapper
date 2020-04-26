<?php
    session_start();
    include "conn.php";
    $url = $_POST['url'];
    $user_id = $_SESSION['userid'];
    // $sql = $conn->prepare("INSERT INTO `prod_info` (`prod_title`, `prod_price`, `prod_url`)
    // VALUES (NULL, NULL, ?);");
    $insert_relation_query = $conn->prepare("INSERT INTO `prod_relation`(`prod_owner`,`prod`) VALUES(?,?)");
    $sql = $conn->prepare("SELECT prod_id FROM prod_info WHERE prod_url = ?");
    $sql->bind_param('s', $url);
    $sql->execute();
    $result = $sql->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $insert_relation_query->bind_param('ii', $user_id, $row['prod_id']);
        $insert_relation_query->execute();
        echo "Inside if";
    } else {
        $sql = $conn->prepare("INSERT INTO `prod_info` (`prod_title`, `prod_price`, `prod_url`) VALUES (NULL, NULL, ?)");
        $sql->bind_param('s', $url);
        $sql->execute();
        $prod_id = $sql->insert_id;

        $insert_relation_query->bind_param('ii', $user_id, $prod_id);
        $insert_relation_query->execute();
        echo "Success";
    }
?>