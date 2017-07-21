<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Blinov Blog</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    	<div class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <a class="navbar-brand" href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>">Блог</a>
            </div>
        </div>
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-8 col-lg-offset-2">
		    		<form action="info_proc.php" method="POST">
		    			<div class="form-group">
		    				<input type="text" name="title" class="form-control" placeholder="Заголовок" required>
		    			</div>
		    			<div class="form-group">
		    				<textarea name="text" class="form-control" placeholder="Текст записи" style="min-height: 250px; max-height: 400px; max-width: 750px;" required=""></textarea>
		    			</div>
		    			<button type="submit" class="btn btn-success">Добавить</button>
		    			<a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>" class="btn btn-default">Отмена</a>
		    		</form>	
		    	</div> 
	    	</div>  		
    	</div>

    	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.js"></script>
    </body>
</html>