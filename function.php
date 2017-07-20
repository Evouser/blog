<?php

require("db/func.php");

function getPosts($page = 1, $size = 10) {
	$mysqli = getConnect();

	$result = "";

	$res = $mysqli->query("SELECT * FROM article");
	for ($i = 0; $i < $res->num_rows; $i++) { 
		$post = $res->fetch_assoc();
		$posts[] = $post;
	}

	if ($res->num_rows > 0) {
		rsort($posts);
		$posts = array_slice($posts, $page * $size - $size, $size);
		$count = count($posts);

		for ($i = 0; $i < $count; $i++) {
			$post = $posts[$i];
			$id = $post['id'];
			$title = $post['title'];
			$text = $post['text'];
			if (strlen($text) > 400) {
				$text = substr($text, 0, 400);
				$text .= " [...]";
			}
			$date = $post['date'];
			$res = $mysqli->query("SELECT * FROM comment WHERE id_art = '$id'");
			$c_comment = $res->num_rows;
			$views = $post['views'];
			$result .= "
				<div class='row'>
		    		<div class='col-lg-8 col-lg-offset-2'>
		      			<div class='wp-block property list'>
		       				<div class='wp-block-body'>
		       					<form action='info_proc.php' method='POST'>
		       						<input type='text' hidden name='delete_art_id' value='$id'>
		       						<input type='text' hidden name='delete_page' value='$page'>
		       						<input type='text' hidden name='page_posts' value='$count'>
			       					<button type='submit' class='close' title='Удалить запись'>
			          					<i class='fa fa-times fa-fw'></i>
			          				</button>
			          			</form>
		          				<div class='wp-block-content' style='width: 1%;'>
		            				<small>
										<span class='glyphicon glyphicon-calendar' aria-hidden='true'></span> $date</small>
		           						<h4 class='content-title'><a href='post.php?post=$id'>$title</a></h4>
		            					<p class='description'>$text</p>
		            					<span class='pull-right'>
		              						<span class='capacity'>
		                						<i class='fa fa-user'></i> Администратор
		              						</span>
		            					</span>
		          				</div>
		        			</div>
		        			<div class='wp-block-footer'>
		          				<ul class='aux-info'>
		            				<li><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> $views</li>
		            				<li><span class=' glyphicon glyphicon-comment' aria-hidden='true'></span> $c_comment</li>
		          				</ul>
		        			</div>
		      			</div>
					</div>
				</div>
			";
		}
	} else {
		$result .= "
			<div class='row'>
	    		<div class='col-lg-8 col-lg-offset-2'>
	      			<div class='wp-block property list'>
	       				<div class='wp-block-body'>
	       					<div class='wp-block-content' style='width: 1%;'>
	           					<h4 class='content-title'>В этом блоге пока нет записей.</h4>
	          				</div>
	        			</div>
	      			</div>
				</div>
			</div>
		";
	}

	$mysqli->close();

	return $result;
}

function getComments($id) {
	$mysqli = getConnect();

	$result = "";

	$res = $mysqli->query("SELECT * FROM comment WHERE id_art = '$id'");
	for ($i = 0; $i < $res->num_rows; $i++) { 
		$comment = $res->fetch_assoc();
		$comments[] = $comment;
	}
	
	if ($res->num_rows > 0) {
		rsort($comments);

		foreach ($comments as $key => $comment) {
			$id = $comment['id'];
			$id_art = $comment['id_art'];
			$name = $comment['name'];
			$text = $comment['text'];
			$date = $comment['date'];
			$result .= "
				<div class='row'>
		    		<div class='col-lg-8 col-lg-offset-2'>
		      			<div class='wp-block property list'>
		       				<div class='wp-block-body'>
		       					<form action='info_proc.php' method='POST'>
		       						<input type='text' hidden name='id_art' value='$id_art'>
		       						<input type='text' hidden name='id' value='$id'>
			       					<button type='submit' class='close' title='Удалить комментарий'>
			          					<i class='fa fa-times fa-fw'></i>
			          				</button>
			          			</form>
		          				<div class='wp-block-img'>
		              				<img src='images/control.png' alt=''>
		          				</div>
		          				<div class='wp-block-content' style='width: 70%;'>
	            					<p class='description'>$text</p>
	            					<span class='pull-left'>
		        						<small><span class='glyphicon glyphicon-calendar' aria-hidden='true'></span> $date</small>
		        					</span>
		        					<span class='pull-right'>
		          						<span class='capacity'>
		            						<i class='fa fa-user'></i> $name
		          						</span>
		        					</span>
		          				</div>
		        			</div>
		        			<div class='wp-block-footer'>

		        			</div>
		      			</div>
					</div>
				</div>
			";
		}
	}
	$mysqli->close();

	return $result;
}

function getPost($id) {
	$mysqli = getConnect();

	$res = $mysqli->query("SELECT * FROM article WHERE id = '$id'");
	$post = $res->fetch_assoc();

	$id = $post['id'];
	$title = $post['title'];
	$text = $post['text'];
	$date = $post['date'];
	$views = $post['views'];

	$views++;

	$mysqli->query("UPDATE article SET views = $views WHERE id = '$id'");

	$res = $mysqli->query("SELECT * FROM comment WHERE id_art = '$id'");
	$c_comment = $res->num_rows;

	$result = "
		<div class='row'>
    		<div class='col-lg-8 col-lg-offset-2'>
      			<div class='wp-block property list'>
       				<div class='wp-block-body'>
          				<div class='wp-block-content' style='width: 1%;'>
       						<h4 class='content-title'>$title</h4>
        					<p class='description'>$text</p>
        					<span class='pull-left'>
        						<small><span class='glyphicon glyphicon-calendar' aria-hidden='true'></span> $date</small>
        					</span>
        					<span class='pull-right'>
          						<span class='capacity'>
            						<i class='fa fa-user'></i> Администратор
          						</span>
        					</span>
          				</div>
        			</div>
        			<div class='wp-block-footer'>
          				<ul class='aux-info'>
            				<li><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> $views</li>
            				<li><span class=' glyphicon glyphicon-comment' aria-hidden='true'></span> $c_comment</li>
          				</ul>
        			</div>
      			</div>
			</div>
		</div>
	";

	$result .= getComments($id);

	$mysqli->close();

	return $result;
}

function getPagination($page = 1, $size = 10) {
	if (!isset($_GET['page'])) {
		$page = 1;
	}

	$mysqli = getConnect();

	$res = $mysqli->query("SELECT COUNT(1) FROM article");
	$res = $res->fetch_array();
	$count = $res[0];

	$count = ceil($count/$size);

	if ($page <= 1) {
		$result = "
			<li class='disabled'><a href='/?page=1'>«</a></li>
		";
	} else {
		$result = "
			<li><a href='/?page=1'>«</a></li>
		";
	}

	if ($count > 0) {
		for ($i = 1; $i < $count+1; $i++) {
			if ($i == $page) {
				$result .= "
					<li class='active'><a href='/?page=$i'>$i</a></li>
				";
			} else {
				$result .= "
					<li><a href='/?page=$i'>$i</a></li>
				";
			}
		}
	} else {
		$result .= "
					<li class='active'><a href='/?page=1'>1</a></li>
				";
	}

	if ($page >= $count) {
		if ($count > 0) {
			$result .= "
				<li class='disabled'><a href='/?page=$count'>»</a></li>
			";
		} else {
			$result .= "
				<li class='disabled'><a href='/?page=1'>»</a></li>
			";
		}
	} else {
		$result .= "
			<li><a href='/?page=$count'>»</a></li>
		";
	}

	$_GET['page'] = $page;

	return $result;
}

?>