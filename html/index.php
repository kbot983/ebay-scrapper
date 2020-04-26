<?php   
    session_start();
    if(isset($_SESSION['userid'])){
        ?>
        <script type="text/javascript">
            alert("Login successful");
            window.location.replace("main.php");
        </script>
        <?php
        exit;
    }
?>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
            .input-field label {
                color: black;
            }
            /* label focus color */
            .input-field input[type=text]:focus + label {
                color: black;
            }
            
            /* icon prefix focus color */
            .input-field .prefix.active {
                color: #000;
            }
            .input-field {
                color:black;
            }
            .container {
                background: white;
                padding: 20px 25px;
                border: 5px solid #e43137;
                width: 550px;
                height: auto;
                box-sizing: border-box;
                position: relative;
            }
            .container {
                animation: showUp 0.5s cubic-bezier(0.18, 1.3, 1, 1) forwards;
            }

            @keyframes showUp {
                0% {
                    transform: scale(0);
                }
                100% {
                    transoform: scale(1);
                }
            }
            .row {margin-bottom: 10px;}

            .ngl {
                position: absolute;
                top: -20px;
                right: -20px;
            }  
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
        </style>
    </head>
  
    <body background="ecommerce.jpg">
        <div class="container">
        <div class="row">
            <form class="col s12" action="login-verify.php" method="post">
            
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate" required name="email">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <input id="password" type="password" class="validate" minlength="6" required name="password">
                <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                <button class="green btn btn-large btn-register waves-effect waves-light" type="submit" name="action">Login
                    <i class="material-icons right">done</i>
                </button>
                </div>
            </div>
            </form>
        </div>
        <a class="blue-text right" href="signup.php">Don't have a account? Set it up</a>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
      </body>
</html>