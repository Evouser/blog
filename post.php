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
        <link href="style.css" rel="stylesheet">
        <link href="/css/bootstrap.css" rel="stylesheet">
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
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <a class="navbar-brand" href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>">Блог</a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="hidden-xs">
                        <a href="#add_comment" class="btn btn-primary navbar-right" style="margin-top: 8px;">Добавить комментарий</a>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" style="text-align: right;">
                        <span id="comment"><a href="#add_comment" class="btn btn-primary navbar-right" style="margin-top: 8px;">Добавить <span class=' glyphicon glyphicon-comment' aria-hidden='true'></span></a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 75px;">
            <div class="row">
                <?php echo getPost($_GET['post']); ?>
            </div>
        </div>
        <div class="container" id="add_comment">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wp-block property list">
                        <div class="wp-block-body">
                            <div class="wp-block-content">
                                <h3 class="content-title">Добавить комментарий</h3>
                            </div>
                            <form action="info_proc.php" method="POST">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Введите ваше имя" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="textcom" class="form-control" placeholder="Текст комментария" style="min-height: 250px; max-height: 250px; max-width: 750px;" required=""></textarea>
                                </div>
                                <input type="text" hidden name="id_art" value="<?php echo $_GET['post']; ?>">
                                <button type="submit" class="btn btn-success">Отправить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#comment").on("click","a", function (event) {
                    //отменяем стандартную обработку нажатия по ссылке
                    event.preventDefault();
 
                    //забираем идентификатор бока с атрибута href
                    var id  = $(this).attr('href'),
 
                    //узнаем высоту от начала страницы до блока на который ссылается якорь
                    top = $(id).offset().top;
         
                    //анимируем переход на расстояние - top за 1500 мс
                    $('body,html').animate({scrollTop: top}, 1500);
                });
            });

        </script>
    </body>
</html>