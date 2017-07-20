<?php

require("function.php");

?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Blinov Blog</title>

        <!-- Bootstrap -->
        <link href="/css/bootstrap.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <link href="/css/font-awesome.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                        <a class="navbar-brand" href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>">Блог</a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs" style="text-align: center;">
                        <ul class="pagination" style="padding-top: 8px; margin: 0px;">
                            <?php echo getPagination($_GET['page']); ?>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" style="text-align: right;">
                        <form action="add.php" class="navbar-form navbar-right" style="padding: 0px; border: 0px;">
                            <button type="submit" class="btn btn-primary">Добавить запись</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 75px;">
            <div class="row">
                <?php echo getPosts($_GET['page']); ?>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="hidden-lg hidden-md hidden-sm col-xs-8 col-xs-offset-2" style="text-align: center;">
                    <ul class="pagination" style="padding-top: 8px; margin: 0px;">
                        <?php echo getPagination($_GET['page']); ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.js"></script>
    </body>
</html>