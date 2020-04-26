<?php session_start(); ?>
<html>
    <head>
        <?php
            include 'conn.php';
            $sql = $conn->prepare("SELECT * FROM prod_info WHERE prod_id IN ( SELECT prod FROM prod_relation WHERE prod_owner = ?);");
            $sql->bind_param('i', $_SESSION['userid']);
            $sql->execute();
            $result = $sql->get_result();
        ?>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
            .tabs .indicator {
                height: 2px;
                background-color: #2196f3;
            }
            body, .match-background {
                background-color: #243447;
            }
        </style>
    </head>

    <body>
        <div class="row">
            <nav>
                <div class="nav-wrapper cyan darken-4">
                <a href="main.php" class="brand-logo" style="margin-left:10px">Ebay Price Tracker</a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href=""></a></li>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li><a href=""></a></li>
                </ul>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s6 match-background"><a href="#test1" class="white-text"><b>Items you are currently tracking</b></a></li>
                    <li class="tab col s6 match-background"><a href="#test2" class="white-text"><b>Add new items</b></a></li>
                </ul>
                </div>
                <div id="test1" class="col s12">
                    <?php
                    if($result->num_rows > 0){
                    ?>
                        <ul class="collapsible popout" data-collapsible="accordion">
                            <?php 
                            while($row = $result->fetch_assoc()){
                                $prod_title = $row['prod_title'] ?? "Your product is parsed by our servers it will soon be updated";
                            ?>
                                <li>
                                    <div class="collapsible-header"><i class="material-icons">show_chart</i><?php echo $prod_title; ?></div>
                                    <div class="collapsible-body white"><span>Last updated price: <?php echo $row['prod_price']; ?><br/>Product Link: <a href="<?php echo $row['prod_url'];?>"><?php echo $row['prod_url']; ?></a></span></div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    <?php
                    } else {
                        ?>
                        <br/>
                        <center><div class="white"><b>
                            Looks like you have dont have any items for tracking <br/>
                            Try adding item from next tab 
                        </b></div</center>
                        <?php
                    }
                    ?>
                </div>
                <div id="test2" class="col s12">
                    
                    <div class="row white">
                        <form class="col s12" action="add-items.php" method="post">
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="url" type="url" class="validate" required name="url" placeholder="https://ebay.com/product_info">
                                <label for="email">Enter Ebay URL</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                            <button class="green btn btn-large btn-register waves-effect waves-light" type="submit" name="action">Add item
                                <i class="material-icons right">done</i>
                            </button>
                            </div>
                        </div>
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".button-collapse").sideNav();
                // $('ul.tabs').tabs({
                //     'swipeable': true
                // });
            });
        </script>
    </body>
</html>