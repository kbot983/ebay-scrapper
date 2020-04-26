<?php
    include 'conn.php';
    $insert_query = $conn->prepare('UPDATE prod_info SET prod_title = ?, prod_price = ? WHERE prod_id = ?');
    $get_user_email_query = $conn->prepare('SELECT email FROM user_info WHERE id IN ( SELECT prod_owner FROM prod_relation WHERE prod = ?)');
    $sql = $conn->prepare('SELECT prod_id, prod_url FROM prod_info WHERE prod_title IS NULL AND prod_price IS NULL');
    $sql->execute();
    $query_res = $sql->get_result();
    if($query_res->num_rows > 0){
        while($row = $query_res->fetch_assoc()){
            $url = $row['prod_url'];
            $command_to_execute = "curl -X POST http://python:5000/getdata -H \"Content-Type: application/json\" -d '{\"url\": \"".$url."\"}'";
            $result = shell_exec($command_to_execute);
            $result = json_decode($result, true);
            echo $result['item-title']."<br/>".$result['item-price'];
            $insert_query->bind_param("sdi", $result['item-title'], $result['item-price'], $row['prod_id']);
            $insert_query->execute();
        }
    }
    $sql=$conn->prepare('SELECT * FROM prod_info');
    $sql->execute();
    $query_res = $sql->get_result();
    while($row = $query_res->fetch_assoc()){
        $url = $row['prod_url'];
        $command_to_execute = "curl -X POST http://python:5000/getdata -H \"Content-Type: application/json\" -d '{\"url\": \"".$url."\"}'";
        $result = shell_exec($command_to_execute);
        $result = json_decode($result, true);
        if($result['item-price'] < $row['prod_price']){
            $get_user_email_query->bind_param("i", $row['prod_id']);
            $get_user_email_query->execute();
            $user_details = $get_user_email_query->get_result();
            while($user_email = $user_details->fetch_assoc()){
                $content = "<!DOCTYPE html><html><body>Prices for your tracked product".$row['prod_title']."just went down<br/>Current price ".$result['item-price']." </body></html>";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                mail($user_email['email'], "Prices went down", $content);
            }
            $insert_query->bind_param("sdi", $result['item-title'], $result['item-price'], $row['prod_id']);
            $insert_query->execute();
        }
    }
?>