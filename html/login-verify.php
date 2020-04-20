<?php
    $email = $_POST['email'];
    $passwrd = $_POST['password'];
    include 'conn.php';

    $sql = $conn->prepare("SELECT id, password FROM user_info WHERE email=?");
    $sql->bind_param('s',$email);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    $sql->close();
    $hash = $row['password'];
    if (password_verify($passwrd, $hash)) {
        session_start();
        $_SESSION['userid'] = $row['id'];
        ?>
        <script type="text/javascript">
            alert("Login successful");
            window.location.replace("main.php");
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert("Email and password doesnt match. Please try again!");
            window.location.href = "index.php";
        </script>
        <?php
    }
    $conn->close();
?>   