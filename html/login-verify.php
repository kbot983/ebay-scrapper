<?php
    $email = $_POST['email'];
    $password = $_POST['password'];
    include 'conn.php';

    $sql = $conn->prepare("SELECT id, password FROM user_info WHERE email=?");
    $sql->bind_param('s',$email);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    if(password_verify($password, $row['password'])){
        echo "Password is valid";
    }
    else{
       ?> 
       <script type="text/javascript">
            alert("Email and password doesnt match. Please try again!");
            window.location.href = "index.php";
       </script>
       <?php
    }
?>