<?php
    include 'conn.php';
    $sql = $conn->prepare('SELECT prod_id, prod_url FROM prod_info');
    $sql->execute();
    $query_res = $sql->get_result();
    while($row = $query_res->fetch_assoc()){
        $url = $row['prod_url'];
        $command_to_execute = "curl -X POST http://python:5000/getdata -H \"Content-Type: application/json\" -d '{\"url\": \"".$url."\"}'";
        $result = shell_exec($command_to_execute);
        $result = json_decode($result, true);
        echo $result['item-title']."<br/>".$result['item-price'];
    }
?>