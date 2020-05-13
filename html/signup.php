<html>
    <head>
      <?php
        if(isset($_POST['first_name'])){
          include 'conn.php';
          $name = $_POST['first_name']." ".$_POST['last_name'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $gender = $_POST['gender'];
          $password = password_hash($password, PASSWORD_DEFAULT);
          $sql = $conn->prepare("INSERT INTO `user_info` (`email`, `name`, `password`, `gender`) VALUES (?, ?, ?, ?)");
          $sql->bind_param('sssi', $email, $name, $password, $gender);
          $sql->execute();
          $sql->close();
          $conn->close();
          echo '<script type="text/javascript">
           window.location = "index.php"
          </script>';
          die();
        } 
      ?>
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
            .col.s6 > .btn {
              width: 100%;
            }
        </style>
    </head>
  
    <body background="ecommerce.jpg">
    <div class="container">
<div class="row">
    <form class="col s12" method="post" action="signup.php" id="reg-form">
      Sign Up
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate" required name="first_name">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate" required name="last_name">
          <label for="last_name">Last Name</label>
        </div>
      </div>
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
        <select required name="gender" id="gender">
          <option value="">Choose your option</option>
          <option value="1">Male</option>
          <option value="2">Female</option>
          <option value="3">Other</option>
        </select>
        <label>Gender</label>
          <!-- <div class="gender-other">
            <input class="with-gap" name="gender" type="radio" id="other" required />
            <label for="female">Other</label>
          </div> -->
        </div>

        <div class="input-field col s6">
          <button class="green btn btn-large btn-register waves-effect waves-light" id="submit" type="submit" name="submit">Register
            <i class="material-icons right">done</i>
          </button>
        </div>
      </div>
    </form>
  </div>
  <a title="Login" class="ngl btn-floating btn-large waves-effect waves-light red" href="index.php"><i class="material-icons">input</i></a>
</div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('select').material_select();
          });
        </script>
      </body>
</html>